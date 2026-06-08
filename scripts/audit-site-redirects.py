#!/usr/bin/env python3
"""Audit HTTP redirect chains for all published WP pages (via SSH + curl)."""

from __future__ import annotations

import re
import shlex
import subprocess
import sys
import time
from pathlib import Path
from urllib.parse import urlparse

import paramiko

ROOT = Path(__file__).resolve().parents[1]
sys.path.insert(0, str(ROOT / "shared"))

from credentials import get_credential, require_credential  # noqa: E402


def connect_ssh() -> paramiko.SSHClient:
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    client.connect(
        require_credential("SSH_HOST"),
        port=int(get_credential("SSH_PORT", "22") or "22"),
        username=require_credential("SSH_USER"),
        password=require_credential("SSH_PASSWORD"),
        timeout=30,
    )
    return client


def list_slugs(ssh: paramiko.SSHClient) -> list[str]:
    root = require_credential("REMOTE_SITE_ROOT")
    wp = get_credential("WP_CLI_BIN", "wp") or "wp"
    cmd = f"cd {shlex.quote(root)} && {shlex.quote(wp)} post list --post_type=page --post_status=publish --field=post_name"
    _, stdout, _ = ssh.exec_command(cmd, timeout=120)
    return [s.strip() for s in stdout.read().decode().splitlines() if s.strip()]


def trace(url: str) -> list[tuple[str, str, str]]:
    chain: list[tuple[str, str, str]] = []
    current = url
    for _ in range(10):
        proc = subprocess.run(
            ["curl", "-sI", "--max-time", "20", current],
            capture_output=True,
            text=True,
        )
        head = proc.stdout.split("\n\n")[0] if proc.stdout else ""
        m_code = re.search(r"^HTTP/\S+ (\d+)", head, re.M)
        code = m_code.group(1) if m_code else "?"
        m_loc = re.search(r"^[Ll]ocation:\s*(.+)$", head, re.M)
        loc = m_loc.group(1).strip() if m_loc else ""
        chain.append((current, code, loc))
        if code in {"301", "302", "303", "307", "308"} and loc:
            if loc.startswith("/"):
                p = urlparse(current)
                loc = f"{p.scheme}://{p.netloc}{loc}"
            current = loc
            continue
        break
    return chain


def main() -> int:
    site = require_credential("WP_SITE_URL").rstrip("/")
    ssh = connect_ssh()
    slugs = list_slugs(ssh)
    ssh.close()

    issues: list[tuple[str, list[tuple[str, str, str]]]] = []
    for slug in slugs:
        chain = trace(f"{site}/{slug}/")
        hops = len(chain) - 1
        final = chain[-1][1]
        if hops > 0 or final != "200":
            issues.append((slug, chain))
        time.sleep(0.04)

    print(f"Published pages: {len(slugs)}")
    print(f"With redirects or non-200: {len(issues)}\n")
    for slug, chain in issues:
        print(f"--- {slug} ---")
        for url, code, loc in chain:
            suffix = f" -> {loc}" if loc else ""
            print(f"  {code} {url}{suffix}")
        print()

    return 0 if not any(c[-1][1] not in {"200", "301"} for _, c in issues) else 1


if __name__ == "__main__":
    raise SystemExit(main())

#!/usr/bin/env python3
"""Upload Neurinix longread theme assets to active WordPress theme."""

from __future__ import annotations

import sys
from pathlib import Path

import paramiko

ROOT = Path(__file__).resolve().parents[1]
sys.path.insert(0, str(ROOT / "shared"))
from credentials import get_credential, require_credential  # noqa: E402
from deploy import connect_ssh, resolve_theme_directory, upload_via_sftp  # noqa: E402

ASSETS = [
    "longread-page-wordpress-bootstrap.inc.php",
    "nero-ai-floating-header.inc.php",
    "longread-page-kadence-layout.css",
    "nero-ai-floating-header.css",
    "nero-ai-floating-header.js",
    "longread-page-design-reference.css",
    "longread-page-reveal.js",
]


def main() -> int:
    src = ROOT / "wordpress" / "theme-includes"
    if not src.is_dir():
        src = ROOT / "shared"
    remote_root = require_credential("REMOTE_SITE_ROOT").rstrip("/")
    ssh = connect_ssh()
    try:
        theme_dir = resolve_theme_directory(ssh, remote_root)
        for name in ASSETS:
            local = src / name
            if not local.is_file():
                local = ROOT / "shared" / name
            if not local.is_file():
                print(f"SKIP missing: {name}")
                continue
            remote = f"{theme_dir}/{name}"
            print(f"Upload {name} -> {remote}")
            upload_via_sftp(ssh, local, remote)
    finally:
        ssh.close()
    print("Theme assets synced.")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())

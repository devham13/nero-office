#!/usr/bin/env python3
"""
Скрин первого экрана (1200×630) для og:image — Playwright + загрузка на сервер.

Требования: pip install playwright paramiko && python3 -m playwright install chromium

Примеры:
  python3 scripts/capture-page-og-screenshots.py --slug vnedrenie-ai-obrabotka-zayavok-s-sayta --apply
  python3 scripts/capture-page-og-screenshots.py --all --apply
"""

from __future__ import annotations

import argparse
import csv
import io
import shlex
import sys
import time
from pathlib import Path

import paramiko
from playwright.sync_api import sync_playwright

ROOT = Path(__file__).resolve().parents[1]
sys.path.insert(0, str(ROOT / "shared"))

from credentials import get_credential, require_credential  # noqa: E402

OG_WIDTH = 1200
OG_HEIGHT = 630
REMOTE_DIR = "nero-og-screenshots"
WAIT_MS = 2500


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


def wp_prefix(ssh: paramiko.SSHClient, remote_root: str) -> str:
    wp_cli = get_credential("WP_CLI_BIN", "wp") or "wp"
    return f"cd {shlex.quote(remote_root)} && {shlex.quote(wp_cli)}"


def run_ssh(ssh: paramiko.SSHClient, cmd: str) -> tuple[str, int]:
    _, stdout, _ = ssh.exec_command(cmd, timeout=300)
    out = stdout.read().decode("utf-8", errors="replace")
    code = stdout.channel.recv_exit_status()
    return out, code


def list_pages(ssh: paramiko.SSHClient, remote_root: str) -> list[dict[str, str]]:
    wpc = wp_prefix(ssh, remote_root)
    out, _ = run_ssh(
        ssh,
        f"{wpc} post list --post_type=page --post_status=publish --fields=ID,post_name --format=csv",
    )
    rows: list[dict[str, str]] = []
    for line in out.strip().splitlines()[1:]:
        reader = csv.reader(io.StringIO(line))
        for row in reader:
            if len(row) >= 2:
                rows.append({"id": row[0].strip(), "slug": row[1].strip()})
    return rows


def capture(url: str, dest: Path) -> None:
    dest.parent.mkdir(parents=True, exist_ok=True)
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        page = browser.new_page(viewport={"width": OG_WIDTH, "height": OG_HEIGHT})
        page.goto(url, wait_until="networkidle", timeout=120_000)
        for selector in (".nero-ai-hero", "main#primary", "main.site-main"):
            try:
                page.wait_for_selector(selector, timeout=15_000)
                break
            except Exception:
                continue
        page.wait_for_timeout(WAIT_MS)
        page.screenshot(path=str(dest), type="jpeg", quality=90, full_page=False)
        browser.close()


def upload_and_meta(
    ssh: paramiko.SSHClient,
    remote_root: str,
    site_url: str,
    post_id: str,
    slug: str,
    local_file: Path,
) -> str:
    upload = f"{remote_root}/wp-content/uploads/{REMOTE_DIR}"
    remote_file = f"{upload}/{slug}.jpg"
    public_url = f"{site_url.rstrip('/')}/wp-content/uploads/{REMOTE_DIR}/{slug}.jpg"

    run_ssh(ssh, f"mkdir -p {shlex.quote(upload)}")
    sftp = ssh.open_sftp()
    sftp.put(str(local_file), remote_file)
    sftp.close()

    wpc = wp_prefix(ssh, remote_root)
    run_ssh(ssh, f"{wpc} post meta update {shlex.quote(post_id)} _nero_og_image {shlex.quote(public_url)}")
    return public_url


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("--slug", action="append", help="Один или несколько slug")
    parser.add_argument("--all", action="store_true", help="Все опубликованные страницы")
    parser.add_argument("--apply", action="store_true", help="Загрузить на сервер и записать _nero_og_image")
    parser.add_argument("--local-dir", type=Path, default=ROOT / "shared" / "og-screenshots")
    args = parser.parse_args()

    if not args.slug and not args.all:
        parser.error("Укажите --slug или --all")

    site_url = require_credential("WP_SITE_URL")
    remote_root = require_credential("REMOTE_SITE_ROOT")
    ssh = connect_ssh()
    pages = list_pages(ssh, remote_root)

    if args.slug:
        wanted = set(args.slug)
        pages = [p for p in pages if p["slug"] in wanted]
        missing = wanted - {p["slug"] for p in pages}
        for slug in sorted(missing):
            print(f"[skip] slug not found: {slug}")

    print(f"Pages to capture: {len(pages)}")
    ok = 0
    for item in pages:
        slug = item["slug"]
        post_id = item["id"]
        url = f"{site_url.rstrip('/')}/{slug}/"
        local = args.local_dir / f"{slug}.jpg"
        print(f"[capture] {slug} <- {url}")
        try:
            capture(url, local)
        except Exception as exc:
            print(f"[error] {slug}: {exc}")
            continue

        if args.apply:
            public = upload_and_meta(ssh, remote_root, site_url, post_id, slug, local)
            print(f"[deploy] {public}")
        else:
            print(f"[dry-run] saved {local}")

        ok += 1
        time.sleep(0.3)

    if args.apply:
        wpc = wp_prefix(ssh, remote_root)
        run_ssh(ssh, f"{wpc} cache flush")

    ssh.close()
    print(f"Done: {ok}/{len(pages)}")
    return 0 if ok == len(pages) else 1


if __name__ == "__main__":
    raise SystemExit(main())

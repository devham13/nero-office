#!/usr/bin/env python3
"""
Deploy security and anti-fraud fixes to the production WordPress site via SSH + WP-CLI.

Run from a machine with Beget SSH/FTP IP whitelist (Cloud Agent IP is often blocked).

Usage:
  python3 scripts/security-fix-meta-journal.py --dry-run
  python3 scripts/security-fix-meta-journal.py --apply
"""

from __future__ import annotations

import argparse
import shlex
import sys
from datetime import datetime
from pathlib import Path

import paramiko

ROOT = Path(__file__).resolve().parents[1]
sys.path.insert(0, str(ROOT / "shared"))

from credentials import get_credential, require_credential  # noqa: E402

MU_PLUGINS_LOCAL = [
    ROOT / "wordpress" / "mu-plugins" / "nero-site-legal.php",
    ROOT / "wordpress" / "mu-plugins" / "nero-security-trust.php",
    ROOT / "wordpress" / "mu-plugins" / "nero-social-og.php",
]
TRUST_PAGES = {
    "politika-konfidentsialnosti": {
        "title": "Политика конфиденциальности",
        "content_file": ROOT / "security" / "pages" / "politika-konfidentsialnosti.html",
    },
    "kontakty": {
        "title": "Контакты",
        "content_file": ROOT / "security" / "pages" / "kontakty.html",
    },
    "o-kompanii": {
        "title": "О проекте",
        "content_file": ROOT / "security" / "pages" / "o-kompanii.html",
    },
    "usloviya-ispolzovaniya": {
        "title": "Условия использования",
        "content_file": ROOT / "security" / "pages" / "usloviya-ispolzovaniya.html",
    },
}


def connect_ssh() -> paramiko.SSHClient:
    host = require_credential("SSH_HOST")
    port = int(get_credential("SSH_PORT", "22") or "22")
    user = require_credential("SSH_USER")
    password = require_credential("SSH_PASSWORD")
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    client.connect(host, port=port, username=user, password=password, timeout=30)
    return client


def run(ssh: paramiko.SSHClient, cmd: str) -> tuple[str, str, int]:
    stdin, stdout, stderr = ssh.exec_command(cmd, timeout=300)
    code = stdout.channel.recv_exit_status()
    return stdout.read().decode("utf-8", errors="replace"), stderr.read().decode("utf-8", errors="replace"), code


def wp(remote_root: str) -> str:
    wp_cli = get_credential("WP_CLI_BIN", "wp") or "wp"
    php = get_credential("PHP_BIN", "")
    if php:
        wp_cli = f"{shlex.quote(php)} {shlex.quote(wp_cli)}"
    else:
        wp_cli = shlex.quote(wp_cli)
    return f"cd {shlex.quote(remote_root)} && {wp_cli}"


def backup(ssh: paramiko.SSHClient, remote_root: str, dry_run: bool) -> str:
    stamp = datetime.now().strftime("%Y-%m-%d-%H-%M")
    backup_dir = f"{remote_root}/security-backups/{stamp}"
    cmds = [
        f"mkdir -p {shlex.quote(backup_dir)}",
        f"cp -a {shlex.quote(remote_root)}/.htaccess {shlex.quote(backup_dir)}/ 2>/dev/null || true",
        f"cp -a {shlex.quote(remote_root)}/wp-config.php {shlex.quote(backup_dir)}/",
        f"cp -a {shlex.quote(remote_root)}/robots.txt {shlex.quote(backup_dir)}/ 2>/dev/null || true",
        f"{wp(remote_root)} db export {shlex.quote(backup_dir)}/database.sql --add-drop-table",
        f"{wp(remote_root)} plugin list --format=csv > {shlex.quote(backup_dir)}/plugins.csv",
        f"{wp(remote_root)} theme list --format=csv > {shlex.quote(backup_dir)}/themes.csv",
        f"{wp(remote_root)} user list --role=administrator --format=csv > {shlex.quote(backup_dir)}/admins.csv",
        f"{wp(remote_root)} option get siteurl > {shlex.quote(backup_dir)}/siteurl.txt",
        f"{wp(remote_root)} option get home > {shlex.quote(backup_dir)}/home.txt",
        f"tar -czf {shlex.quote(backup_dir)}/files-lite.tar.gz "
        f"--exclude=security-backups --exclude=wp-content/cache "
        f"-C {shlex.quote(remote_root)} wp-config.php .htaccess robots.txt wp-content/mu-plugins wp-content/themes/kadence",
    ]
    for c in cmds:
        print(f"[backup] {c[:100]}...")
        if not dry_run:
            out, err, code = run(ssh, c)
            if code != 0 and "db export" not in c:
                print(err or out)
    return backup_dir


def upload_mu_plugins(ssh: paramiko.SSHClient, remote_root: str, dry_run: bool) -> None:
    remote_mu = f"{remote_root}/wp-content/mu-plugins"
    if dry_run:
        for local in MU_PLUGINS_LOCAL:
            print(f"[deploy] MU plugin -> {remote_mu}/{local.name}")
        return
    run(ssh, f"mkdir -p {shlex.quote(remote_mu)}")
    sftp = ssh.open_sftp()
    for local in MU_PLUGINS_LOCAL:
        remote_file = f"{remote_mu}/{local.name}"
        content = local.read_text(encoding="utf-8")
        print(f"[deploy] MU plugin -> {remote_file}")
        with sftp.file(remote_file, "w") as f:
            f.write(content)
    sftp.close()


def ensure_wp_config_hardening(ssh: paramiko.SSHClient, remote_root: str, dry_run: bool) -> None:
    cfg = f"{remote_root}/wp-config.php"
    out, _, _ = run(ssh, f"grep -n DISALLOW_FILE_EDIT {shlex.quote(cfg)} || true")
    if "DISALLOW_FILE_EDIT" in out:
        print("[wp-config] DISALLOW_FILE_EDIT already set")
        return
    marker = "/* That's all, stop editing! Happy publishing. */"
    snippet = "\ndefine('DISALLOW_FILE_EDIT', true);\n"
    cmd = (
        f"python3 -c \"import pathlib; p=pathlib.Path({cfg!r}); t=p.read_text(); "
        f"m={marker!r}; "
        f"assert m in t, 'marker not found'; "
        f"p.write_text(t.replace(m, {snippet!r}+m)) if {not dry_run} else None\""
    )
    print("[wp-config] Adding DISALLOW_FILE_EDIT")
    if not dry_run:
        run(ssh, cmd)


def deactivate_yoast(ssh: paramiko.SSHClient, remote_root: str, dry_run: bool) -> None:
    wpc = wp(remote_root)
    out, _, _ = run(ssh, f"{wpc} plugin is-active wordpress-seo")
    if "yes" not in out.lower():
        print("[seo] Yoast not active")
        return
    print("[seo] Deactivating Yoast SEO (keeping AIOSEO)")
    if not dry_run:
        run(ssh, f"{wpc} plugin deactivate wordpress-seo")


def create_trust_pages(ssh: paramiko.SSHClient, remote_root: str, dry_run: bool) -> None:
    wpc = wp(remote_root)
    for slug, meta in TRUST_PAGES.items():
        content = meta["content_file"].read_text(encoding="utf-8")
        escaped = content.replace("'", "'\\''")
        check, _, _ = run(ssh, f"{wpc} post list --post_type=page --name={slug} --field=ID")
        if check.strip():
            print(f"[page] {slug} exists ID={check.strip()}, updating")
            if not dry_run:
                run(ssh, f"{wpc} post update {check.strip()} --post_content=$'{escaped}'")
            continue
        print(f"[page] Creating {slug}")
        if not dry_run:
            run(
                ssh,
                f"{wpc} post create --post_type=page --post_status=publish "
                f"--post_title={shlex.quote(meta['title'])} --post_name={slug} "
                f"--post_content=$'{escaped}'",
            )


def scan_server(ssh: paramiko.SSHClient, remote_root: str) -> None:
    wpc = wp(remote_root)
    checks = [
        f"{wpc} core version",
        f"{wpc} core verify-checksums 2>&1 | tail -5",
        f"find {shlex.quote(remote_root)}/wp-content/uploads -type f \\( -name '*.php' -o -name '*.phtml' \\) 2>/dev/null | head -20",
        f"grep -rEl 'eval\\(|base64_decode|gzinflate' {shlex.quote(remote_root)}/wp-content/themes/kadence --include='*.php' 2>/dev/null | head -10 || true",
    ]
    for c in checks:
        print(f"\n[scan] {c[:80]}...")
        out, err, code = run(ssh, c)
        print(out or err)


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("--apply", action="store_true")
    parser.add_argument("--dry-run", action="store_true", default=True)
    args = parser.parse_args()
    dry_run = not args.apply

    remote_root = require_credential("REMOTE_SITE_ROOT")
    print("Connecting SSH...")
    ssh = connect_ssh()
    print("Connected.")

    scan_server(ssh, remote_root)
    backup_dir = backup(ssh, remote_root, dry_run)
    print(f"Backup dir: {backup_dir}")

    upload_mu_plugins(ssh, remote_root, dry_run)
    ensure_wp_config_hardening(ssh, remote_root, dry_run)
    deactivate_yoast(ssh, remote_root, dry_run)
    create_trust_pages(ssh, remote_root, dry_run)

    print("\nDone. See security/instructions-nginx-security.txt for nginx readme blocking.")
    ssh.close()
    return 0


if __name__ == "__main__":
    raise SystemExit(main())

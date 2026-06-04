#!/usr/bin/env python3
"""Deploy a Nero Network page template via SFTP/SSH and WP-CLI."""

from __future__ import annotations

import argparse
import ftplib
import re
import shlex
import sys
import tempfile
import urllib.error
import urllib.request
from pathlib import Path

import paramiko

from credentials import get_credential, public_site_url, require_credential


ROOT = Path(__file__).resolve().parents[1]

THEME_ASSET_MAP: list[tuple[Path, str]] = [
    (ROOT / "shared" / "nero-ai-site-header.css", "assets/css/nero-ai-site-header.css"),
    (ROOT / "shared" / "nero-ai-home-shell.css", "assets/css/nero-ai-home-shell.css"),
    (ROOT / "shared" / "nero-ai-longread-ui-compat.css", "assets/css/nero-ai-longread-ui-compat.css"),
    (ROOT / "shared" / "nero-ai-site-header.js", "assets/js/nero-ai-site-header.js"),
    (ROOT / "wordpress" / "partials" / "nero-ai-longread-bootstrap.php", "partials/nero-ai-longread-bootstrap.php"),
    (ROOT / "wordpress" / "partials" / "nero-ai-longread-hero-shell.php", "partials/nero-ai-longread-hero-shell.php"),
    (ROOT / "wordpress" / "partials" / "nero-ai-site-header.php", "partials/nero-ai-site-header.php"),
    (ROOT / "wordpress" / "partials" / "nero-ai-cta-helpers.php", "partials/nero-ai-cta-helpers.php"),
]


def parse_args() -> argparse.Namespace:
    parser = argparse.ArgumentParser(description="Deploy a Nero Network page template safely.")
    parser.add_argument("--slug", required=True)
    parser.add_argument("--title", required=True)
    parser.add_argument("--description", required=True)
    parser.add_argument("--local-path", required=True)
    parser.add_argument(
        "--with-theme-assets",
        action="store_true",
        help="Upload shared CSS/JS and partials required by longread bootstrap.",
    )
    parser.add_argument("--skip-live-check", action="store_true")
    return parser.parse_args()


def ssh_host() -> str:
    return (
        get_credential("SSH_HOST")
        or get_credential("SFTP_HOST")
        or get_credential("FTP_HOST")
        or require_credential("WP_SITE_URL").replace("https://", "").replace("http://", "").strip("/")
    )


def ssh_port() -> int:
    return int(get_credential("SSH_PORT") or get_credential("SFTP_PORT") or "22")


def ssh_credentials() -> list[tuple[str, str]]:
    pairs: list[tuple[str, str]] = []
    for user_key, pass_key in (("SSH_USER", "SSH_PASSWORD"), ("SFTP_USER", "SFTP_PASSWORD")):
        user = get_credential(user_key)
        password = get_credential(pass_key)
        if user and password and (user, password) not in pairs:
            pairs.append((user, password))
    if not pairs:
        raise RuntimeError("Missing SSH/SFTP credentials.")
    return pairs


def connect_ssh() -> paramiko.SSHClient:
    host = ssh_host()
    port = ssh_port()
    last_error: Exception | None = None
    for user, password in ssh_credentials():
        client = paramiko.SSHClient()
        client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
        try:
            client.connect(host, port=port, username=user, password=password, timeout=20)
            print(f"SSH connected: {user}@{host}:{port}")
            return client
        except Exception as exc:
            last_error = exc
            client.close()
    raise RuntimeError(f"SSH connection failed for {host}:{port}") from last_error


def run_remote(ssh: paramiko.SSHClient, command: str) -> tuple[str, str, int]:
    stdin, stdout, stderr = ssh.exec_command(command)
    exit_code = stdout.channel.recv_exit_status()
    out = stdout.read().decode("utf-8", errors="ignore")
    err = stderr.read().decode("utf-8", errors="ignore")
    return out, err, exit_code


def wp_command(remote_site_root: str) -> str:
    wp_cli = get_credential("WP_CLI_BIN", "/usr/local/bin/wp") or "/usr/local/bin/wp"
    php_bin = get_credential("PHP_BIN", "")
    if php_bin and not wp_cli.startswith("/"):
        wp_cli = f"{shlex.quote(php_bin)} {shlex.quote(wp_cli)}"
    else:
        wp_cli = shlex.quote(wp_cli)
    return f"cd {shlex.quote(remote_site_root)} && {wp_cli}"


def resolve_theme_directory(ssh: paramiko.SSHClient, remote_site_root: str) -> str:
    wp_cmd = wp_command(remote_site_root)
    out, err, code = run_remote(ssh, f"{wp_cmd} eval 'echo get_stylesheet_directory();'")
    theme_dir = out.strip()
    if code == 0 and theme_dir.startswith("/"):
        print(f"Theme directory (runtime): {theme_dir}")
        return theme_dir

    fallback = get_credential("SSH_THEME_PATH")
    if fallback:
        print(f"Theme directory (fallback): {fallback}")
        return fallback.rstrip("/")

    theme_slug = require_credential("WP_THEME_SLUG")
    remote_themes = get_credential("REMOTE_WP_THEMES", "wp-content/themes").rstrip("/")
    if remote_themes.startswith("/"):
        return f"{remote_themes}/{theme_slug}"
    return f"{remote_site_root.rstrip('/')}/{remote_themes.strip('/')}/{theme_slug}"


def upload_via_sftp(ssh: paramiko.SSHClient, local_path: Path, remote_file: str) -> None:
    remote_dir = str(Path(remote_file).parent)
    run_remote(ssh, f"mkdir -p {shlex.quote(remote_dir)}")
    with ssh.open_sftp() as sftp:
        sftp.put(str(local_path), remote_file)
    run_remote(ssh, f"chmod 644 {shlex.quote(remote_file)}")


def upload_via_ftp(local_path: Path, remote_file: str, remote_site_root: str) -> None:
    host = get_credential("FTP_HOST") or ssh_host()
    port = int(get_credential("FTP_PORT", "21") or "21")
    user = require_credential("FTP_USER")
    password = require_credential("FTP_PASSWORD")

    if remote_file.startswith(remote_site_root):
        ftp_path = remote_file[len(remote_site_root) :].lstrip("/")
    else:
        ftp_path = remote_file.lstrip("/")

    print(f"Uploading via FTP to {ftp_path}...")
    with ftplib.FTP(timeout=20) as ftp:
        ftp.connect(host, port)
        ftp.login(user, password)
        parts = ftp_path.split("/")
        for part in parts[:-1]:
            try:
                ftp.cwd(part)
            except ftplib.error_perm:
                ftp.mkd(part)
                ftp.cwd(part)
        with local_path.open("rb") as handle:
            ftp.storbinary(f"STOR {parts[-1]}", handle)
    print("FTP upload successful.")


def create_or_update_page(
    ssh: paramiko.SSHClient,
    remote_site_root: str,
    slug: str,
    title: str,
    description: str,
) -> str:
    wp_cmd = wp_command(remote_site_root)
    check_cmd = f"{wp_cmd} post list --name={shlex.quote(slug)} --post_type=page --format=ids"
    out, err, code = run_remote(ssh, check_cmd)
    existing_id = out.strip()
    quoted_template = shlex.quote(f"page-{slug}.php")

    if existing_id:
        print(f"Page exists (ID: {existing_id}). Updating...")
        cmd = (
            f"{wp_cmd} post update {existing_id} "
            f"--post_title={shlex.quote(title)} "
            f"--post_excerpt={shlex.quote(description)} "
            f"--page_template={quoted_template} "
            f"--post_status=publish"
        )
    else:
        print("Page does not exist. Creating...")
        cmd = (
            f"{wp_cmd} post create --post_type=page "
            f"--post_title={shlex.quote(title)} "
            f"--post_name={shlex.quote(slug)} "
            f"--post_excerpt={shlex.quote(description)} "
            f"--post_status=publish "
            f"--page_template={quoted_template}"
        )

    out, err, code = run_remote(ssh, cmd)
    if code != 0:
        raise RuntimeError(err.strip() or out.strip() or f"WP-CLI failed with exit code {code}")
    print(out.strip() or err.strip())
    return existing_id or out.strip()


def php_quote(value: str) -> str:
    return "'" + value.replace("\\", "\\\\").replace("'", "\\'") + "'"


def bake_cta_env(content: str) -> str:
    """Replace deploy:cta-env block with literals from Cloud secrets (getenv often empty on host)."""
    start = "// deploy:cta-env"
    end = "// end:cta-env"
    if start not in content or end not in content:
        return content

    primary_url = get_credential("PRIMARY_CTA_URL")
    if not primary_url:
        print("CTA bake skipped: PRIMARY_CTA_URL not set.")
        return content

    primary_label = get_credential("PRIMARY_CTA_LABEL") or "Бесплатный аудит"
    secondary_label = get_credential("SECONDARY_CTA_LABEL") or "Что можно автоматизировать"
    secondary_url = get_credential("SECONDARY_CTA_URL")
    secondary_line = (
        f"$secondary_cta_url = {php_quote(secondary_url)};"
        if secondary_url
        else "$secondary_cta_url = home_url('/#services');"
    )

    baked = f"""{start}
$primary_cta_label = {php_quote(primary_label)};
$primary_cta_url = {php_quote(primary_url)};
$secondary_cta_label = {php_quote(secondary_label)};
{secondary_line}
{end}"""

    pattern = re.compile(re.escape(start) + r".*?" + re.escape(end), re.S)
    print("Baked PRIMARY_CTA_URL into template for live publish.")
    return pattern.sub(baked, content, count=1)


def prepare_template_for_deploy(local_path: Path) -> tuple[Path, Path | None]:
    original = local_path.read_text(encoding="utf-8")
    content = bake_cta_env(original)
    if content == original:
        return local_path, None

    tmp_path = Path(tempfile.mkstemp(suffix=local_path.suffix)[1])
    tmp_path.write_text(content, encoding="utf-8")
    return tmp_path, tmp_path


def verify_live(url: str, slug: str) -> None:
    import re

    required_markers = (
        'id="primary"',
        f"{slug}-page",
    )
    request = urllib.request.Request(url, headers={"User-Agent": "NeroNetworkDeploy/1.0"})
    with urllib.request.urlopen(request, timeout=20) as response:
        html = response.read().decode("utf-8", errors="ignore")

    missing = [marker for marker in required_markers if marker not in html]
    if missing:
        raise RuntimeError(f"Live page missing markers: {', '.join(missing)}")

    if re.search(r"<style>\s*<style>", html, re.I):
        raise RuntimeError("Live page has duplicate opening <style> (hero CSS will break)")

    if "padding-top: 0" not in html and "padding-top:0" not in html.replace(" ", ""):
        raise RuntimeError("Live page missing #primary padding reset in hero CSS")

    if not re.search(r"t\.me/|telegram\.me/", html, re.I):
        raise RuntimeError("Live page missing Telegram contact link (PRIMARY_CTA_URL)")

    print(f"Live check OK: {url}")


def upload_theme_assets(ssh: paramiko.SSHClient, theme_dir: str) -> None:
    theme_root = theme_dir.rstrip("/")
    uploaded = 0
    for local_path, relative_remote in THEME_ASSET_MAP:
        if not local_path.is_file():
            print(f"Skip missing theme asset: {local_path.relative_to(ROOT)}")
            continue
        remote_file = f"{theme_root}/{relative_remote}"
        print(f"Uploading theme asset: {relative_remote}")
        upload_via_sftp(ssh, local_path, remote_file)
        uploaded += 1
    print(f"Theme assets uploaded: {uploaded}")


def main() -> int:
    args = parse_args()
    local_path = Path(args.local_path)
    if not local_path.exists():
        print(f"Local template not found: {local_path}")
        return 1

    remote_site_root = require_credential("REMOTE_SITE_ROOT")
    slug = args.slug
    remote_filename = f"page-{slug}.php"

    deploy_path, tmp_path = prepare_template_for_deploy(local_path)
    ssh = connect_ssh()
    try:
        theme_dir = resolve_theme_directory(ssh, remote_site_root)
        remote_file = f"{theme_dir.rstrip('/')}/{remote_filename}"

        if args.with_theme_assets:
            upload_theme_assets(ssh, theme_dir)

        print(f"Uploading via SFTP to {remote_file}...")
        upload_via_sftp(ssh, deploy_path, remote_file)

        create_or_update_page(ssh, remote_site_root, slug, args.title, args.description)

        wp_cmd = wp_command(remote_site_root)
        run_remote(ssh, f"{wp_cmd} cache flush")
        print("Cache flushed.")
    finally:
        ssh.close()
        if tmp_path is not None:
            tmp_path.unlink(missing_ok=True)

    public_url = f"{public_site_url().rstrip('/')}/{slug}/"
    if not args.skip_live_check:
        try:
            verify_live(public_url, slug)
        except (urllib.error.URLError, RuntimeError) as exc:
            print(f"Live check warning: {exc}")

    print(f"Published: {public_url}")
    return 0


if __name__ == "__main__":
    try:
        raise SystemExit(main())
    except Exception as exc:
        print(f"Deploy failed: {exc}")
        raise SystemExit(1) from exc

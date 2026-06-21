#!/usr/bin/env python3
"""Publish VK wall post with mandatory photo attachment for Nero Network pages."""

from __future__ import annotations

import argparse
import json
import re
import sys
import tempfile
import urllib.error
import urllib.parse
import urllib.request
from pathlib import Path

sys.path.insert(0, str(Path(__file__).resolve().parent))

from credentials import canonical_public_site_url, get_credential, published_page_url  # noqa: E402

VK_API = "https://api.vk.com/method"
VK_VERSION = "5.199"
USER_AGENT = "NeroNetworkVKPublisher/1.0"


def _http_get(url: str, timeout: int = 25) -> bytes:
    request = urllib.request.Request(url, headers={"User-Agent": USER_AGENT})
    with urllib.request.urlopen(request, timeout=timeout) as response:
        return response.read()


def _http_post(url: str, data: dict[str, str], files: dict[str, tuple[str, bytes, str]] | None = None) -> bytes:
    if files:
        boundary = "----NeroNetworkVKBoundary"
        body_parts: list[bytes] = []
        for key, value in data.items():
            body_parts.append(f"--{boundary}\r\n".encode())
            body_parts.append(f'Content-Disposition: form-data; name="{key}"\r\n\r\n'.encode())
            body_parts.append(f"{value}\r\n".encode())
        for field, (filename, content, mime) in files.items():
            body_parts.append(f"--{boundary}\r\n".encode())
            body_parts.append(
                f'Content-Disposition: form-data; name="{field}"; filename="{filename}"\r\n'.encode()
            )
            body_parts.append(f"Content-Type: {mime}\r\n\r\n".encode())
            body_parts.append(content)
            body_parts.append(b"\r\n")
        body_parts.append(f"--{boundary}--\r\n".encode())
        body = b"".join(body_parts)
        headers = {"Content-Type": f"multipart/form-data; boundary={boundary}", "User-Agent": USER_AGENT}
    else:
        body = urllib.parse.urlencode(data).encode()
        headers = {"Content-Type": "application/x-www-form-urlencoded", "User-Agent": USER_AGENT}
    request = urllib.request.Request(url, data=body, headers=headers)
    with urllib.request.urlopen(request, timeout=60) as response:
        return response.read()


def _vk(method: str, params: dict[str, str | int]) -> dict:
    token = get_credential("VK_ACCESS_TOKEN")
    if not token:
        raise RuntimeError("Missing VK_ACCESS_TOKEN")
    payload = {**params, "access_token": token, "v": VK_VERSION}
    url = f"{VK_API}/{method}?{urllib.parse.urlencode(payload)}"
    raw = _http_get(url)
    data = json.loads(raw.decode("utf-8"))
    if "error" in data:
        raise RuntimeError(f"VK API {method}: {data['error']}")
    return data["response"]


def _extract_og_image(html: str, base_url: str) -> str | None:
    patterns = (
        r'<meta\s+property=["\']og:image(?::secure_url)?["\']\s+content=["\']([^"\']+)["\']',
        r'<meta\s+content=["\']([^"\']+)["\']\s+property=["\']og:image(?::secure_url)?["\']',
        r'<meta\s+name=["\']twitter:image["\']\s+content=["\']([^"\']+)["\']',
    )
    for pattern in patterns:
        match = re.search(pattern, html, flags=re.I)
        if match:
            image = match.group(1).strip()
            if image.startswith("//"):
                return f"https:{image}"
            if image.startswith("/"):
                parsed = urllib.parse.urlparse(base_url)
                return f"{parsed.scheme}://{parsed.netloc}{image}"
            if image.startswith("http://"):
                return "https://" + image.removeprefix("http://")
            return image
    return None


def resolve_image_url(public_url: str) -> str:
    explicit = get_credential("VK_POST_IMAGE_URL") or get_credential("VK_OG_IMAGE_FALLBACK")
    if explicit:
        return explicit

    try:
        html = _http_get(public_url).decode("utf-8", errors="ignore")
        image = _extract_og_image(html, public_url)
        if image:
            return image
    except urllib.error.URLError:
        pass

    home = f"{canonical_public_site_url()}/"
    html = _http_get(home).decode("utf-8", errors="ignore")
    image = _extract_og_image(html, home)
    if image:
        return image

    raise RuntimeError(
        "No image for VK post: set VK_POST_IMAGE_URL / VK_OG_IMAGE_FALLBACK or ensure og:image on page"
    )


def _owner_id() -> int:
    group = get_credential("VK_GROUP_ID")
    if group:
        gid = str(group).lstrip("-")
        return -int(gid)
    owner = get_credential("VK_OWNER_ID")
    if owner:
        return int(owner)
    raise RuntimeError("Missing VK_GROUP_ID or VK_OWNER_ID")


def _upload_photo_bytes(upload_url: str, image_bytes: bytes, filename: str, mime: str) -> dict:
    try:
        import requests  # type: ignore[import-untyped]

        response = requests.post(
            upload_url,
            files={"photo": (filename, image_bytes, mime)},
            timeout=60,
        )
        response.raise_for_status()
        upload_data = response.json()
    except ImportError:
        upload_raw = _http_post(
            upload_url,
            {},
            files={"photo": (filename, image_bytes, mime)},
        )
        upload_data = json.loads(upload_raw.decode("utf-8"))

    if not upload_data.get("photo"):
        raise RuntimeError("VK photo upload returned empty photo payload")
    return upload_data


def upload_wall_photo(group_id: int, image_url: str) -> str:
    image_bytes = _http_get(image_url)
    suffix = ".jpg"
    if ".png" in image_url.lower():
        suffix = ".png"
    elif ".webp" in image_url.lower():
        suffix = ".webp"
    mime = "image/jpeg" if suffix == ".jpg" else f"image/{suffix.lstrip('.')}"
    filename = f"post{suffix}"

    try:
        server = _vk("photos.getWallUploadServer", {"group_id": abs(group_id)})
        upload_data = _upload_photo_bytes(server["upload_url"], image_bytes, filename, mime)
        saved = _vk(
            "photos.saveWallPhoto",
            {
                "group_id": abs(group_id),
                "photo": upload_data["photo"],
                "server": upload_data["server"],
                "hash": upload_data["hash"],
            },
        )
    except RuntimeError as exc:
        error = str(exc)
        if "error_code': 27" not in error and "error_code\": 27" not in error:
            raise
        server = _vk("photos.getMessagesUploadServer", {"group_id": abs(group_id)})
        upload_data = _upload_photo_bytes(server["upload_url"], image_bytes, filename, mime)
        saved = _vk(
            "photos.saveMessagesPhoto",
            {
                "photo": upload_data["photo"],
                "server": upload_data["server"],
                "hash": upload_data["hash"],
            },
        )

    photo = saved[0]
    owner = photo["owner_id"]
    photo_id = photo["id"]
    return f"photo{owner}_{photo_id}"


def verify_public_url(public_url: str, slug: str) -> int:
    request = urllib.request.Request(public_url, method="HEAD", headers={"User-Agent": USER_AGENT})
    try:
        with urllib.request.urlopen(request, timeout=20) as response:
            status = response.status
    except urllib.error.HTTPError as exc:
        status = exc.code
    if status != 200:
        raise RuntimeError(f"public_url HTTP {status}: {public_url}")
    if f"/{slug.strip('/')}/" not in public_url:
        raise RuntimeError(f"public_url does not contain slug {slug}")
    return status


def publish_post(text: str, public_url: str, slug: str, dry_run: bool = False) -> dict:
    if public_url not in text:
        raise RuntimeError("Post text must contain public_url")

    verify_public_url(public_url, slug)
    image_url = resolve_image_url(public_url)
    owner_id = _owner_id()

    if dry_run:
        return {
            "status": "draft",
            "public_url": public_url,
            "image_url": image_url,
            "attachment": None,
            "post_url": None,
        }

    attachment = upload_wall_photo(owner_id, image_url)
    response = _vk(
        "wall.post",
        {
            "owner_id": owner_id,
            "from_group": 1 if owner_id < 0 else 0,
            "message": text,
            "attachments": attachment,
        },
    )
    post_id = response["post_id"]
    group_part = abs(owner_id)
    return {
        "status": "published",
        "public_url": public_url,
        "image_url": image_url,
        "attachment": attachment,
        "post_url": f"https://vk.com/wall-{group_part}_{post_id}",
        "post_id": post_id,
    }


def parse_args() -> argparse.Namespace:
    parser = argparse.ArgumentParser(description="Publish VK post with mandatory image.")
    parser.add_argument("--slug", required=True)
    parser.add_argument("--text-file", help="Path to post text file")
    parser.add_argument("--text", help="Post text inline")
    parser.add_argument("--public-url", help="Override public URL")
    parser.add_argument("--dry-run", action="store_true")
    return parser.parse_args()


def main() -> int:
    args = parse_args()
    public_url = args.public_url or published_page_url(args.slug)
    if args.text_file:
        text = Path(args.text_file).read_text(encoding="utf-8").strip()
    elif args.text:
        text = args.text.strip()
    else:
        text = sys.stdin.read().strip()
    if not text:
        raise RuntimeError("Post text is empty")

    result = publish_post(text, public_url, args.slug, dry_run=args.dry_run)
    print(json.dumps(result, ensure_ascii=False, indent=2))
    return 0


if __name__ == "__main__":
    try:
        raise SystemExit(main())
    except Exception as exc:
        print(f"VK publish failed: {exc}", file=sys.stderr)
        raise SystemExit(1) from exc

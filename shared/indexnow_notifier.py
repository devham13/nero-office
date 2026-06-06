#!/usr/bin/env python3
"""IndexNow notifier for Nero Network pipeline.

Uses only stdlib. Never logs full API keys.
"""

from __future__ import annotations

import json
import logging
import sys
import urllib.error
import urllib.parse
import urllib.request
from pathlib import Path

sys.path.insert(0, str(Path(__file__).resolve().parent))

from credentials import get_credential  # noqa: E402

INDEXNOW_ENDPOINT = "https://api.indexnow.org/indexnow"
logger = logging.getLogger(__name__)


def _mask_key(key: str | None) -> str:
    if not key:
        return "empty"
    if len(key) <= 4:
        return "set"
    return f"{key[:2]}…{key[-2:]}"


def _host_from_url(url: str) -> str:
    parsed = urllib.parse.urlparse(url)
    return parsed.netloc or ""


def notify_indexnow(url: str) -> bool:
    """Notify search engines about a published URL via IndexNow."""
    key = get_credential("INDEXNOW_KEY")
    if not key:
        logger.warning("IndexNow skipped: INDEXNOW_KEY not configured")
        return False

    host = get_credential("INDEXNOW_HOST") or _host_from_url(url)
    if not host:
        logger.warning("IndexNow skipped: cannot determine host for %s", url)
        return False

    key_location = f"https://{host}/{key}.txt"
    payload = {
        "host": host,
        "key": key,
        "keyLocation": key_location,
        "urlList": [url],
    }

    data = json.dumps(payload, ensure_ascii=False).encode("utf-8")
    request = urllib.request.Request(
        INDEXNOW_ENDPOINT,
        data=data,
        headers={"Content-Type": "application/json; charset=utf-8"},
        method="POST",
    )

    try:
        with urllib.request.urlopen(request, timeout=30) as response:
            status = response.getcode()
            if status in (200, 202):
                logger.info(
                    "IndexNow OK for %s (status=%s, key=%s)",
                    url,
                    status,
                    _mask_key(key),
                )
                return True
            logger.warning("IndexNow unexpected status %s for %s", status, url)
            return False
    except urllib.error.HTTPError as exc:
        logger.warning(
            "IndexNow HTTP error %s for %s (key=%s)",
            exc.code,
            url,
            _mask_key(key),
        )
        return False
    except urllib.error.URLError as exc:
        logger.warning("IndexNow request failed for %s: %s", url, exc.reason)
        return False
    except Exception as exc:
        logger.warning("IndexNow error for %s: %s", url, exc)
        return False


if __name__ == "__main__":
    logging.basicConfig(level=logging.INFO, format="%(levelname)s %(message)s")
    if len(sys.argv) < 2:
        print("Usage: python3 shared/indexnow_notifier.py <url>", file=sys.stderr)
        raise SystemExit(2)
    ok = notify_indexnow(sys.argv[1])
    raise SystemExit(0 if ok else 1)

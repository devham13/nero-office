"""Notify search engines about new URLs via IndexNow."""

from __future__ import annotations

import json
import logging
from urllib.error import HTTPError, URLError
from urllib.parse import urlparse
from urllib.request import Request, urlopen

from credentials import get_credential

logger = logging.getLogger(__name__)

INDEXNOW_ENDPOINT = "https://api.indexnow.org/indexnow"


def _host_from_url(url: str) -> str:
    parsed = urlparse(url)
    return parsed.netloc or ""


def notify_indexnow(url: str) -> bool:
    key = get_credential("INDEXNOW_KEY")
    if not key:
        logger.warning("IndexNow skipped: INDEXNOW_KEY is not set")
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

    request = Request(
        INDEXNOW_ENDPOINT,
        data=json.dumps(payload).encode("utf-8"),
        headers={"Content-Type": "application/json; charset=utf-8"},
        method="POST",
    )

    try:
        with urlopen(request, timeout=30) as response:
            status = response.getcode()
            if status in (200, 202):
                logger.info("IndexNow notified for %s (HTTP %s)", url, status)
                return True
            logger.warning("IndexNow unexpected status HTTP %s for %s", status, url)
            return False
    except HTTPError as exc:
        logger.warning("IndexNow HTTP error for %s: HTTP %s", url, exc.code)
        return False
    except URLError as exc:
        logger.warning("IndexNow request failed for %s: %s", url, exc.reason)
        return False
    except Exception as exc:
        logger.warning("IndexNow failed for %s: %s", url, exc)
        return False

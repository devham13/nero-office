#!/usr/bin/env python3
"""Google Sheets topic logger for Nero Network pipeline.

Supports webhook (preferred) and optional service-account read via gspread.
Never prints secret values.
"""

from __future__ import annotations

import argparse
import base64
import json
import re
import sys
import urllib.error
import urllib.request
from datetime import datetime, timezone
from pathlib import Path
from typing import Any

ROOT = Path(__file__).resolve().parents[1]
sys.path.insert(0, str(Path(__file__).resolve().parent))

from credentials import get_credential  # noqa: E402

LEDGER = ROOT / "shared" / "kirill-news-ledger.md"
PUBLISHED = ROOT / "shared" / "published-pages.md"

def _link_header() -> str:
    return get_credential("GOOGLE_SHEETS_LINK_COLUMN") or "link"


STATUS_RESERVED = "Не использовано"
PUBLISH_COMMENT = "Опубликовано через Nero Network pipeline"


def _mask(value: str | None) -> str:
    if not value:
        return "empty"
    return "set"


def _webhook_post(payload: dict[str, Any]) -> dict[str, Any]:
    url = get_credential("GOOGLE_SHEETS_WEBHOOK_URL")
    if not url:
        return {"ok": False, "error": "GOOGLE_SHEETS_WEBHOOK_URL not configured"}

    token = get_credential("GOOGLE_SHEETS_WEBHOOK_TOKEN")
    body = dict(payload)
    headers = {"Content-Type": "application/json", "User-Agent": "NeroGoogleSheetsLogger/1.0"}
    if token:
        headers["X-Webhook-Token"] = token
        body.setdefault("token", token)

    data = json.dumps(body, ensure_ascii=False).encode("utf-8")
    request = urllib.request.Request(url, data=data, headers=headers, method="POST")
    try:
        with urllib.request.urlopen(request, timeout=30) as response:
            raw = response.read().decode("utf-8", errors="ignore")
            try:
                parsed = json.loads(raw) if raw.strip() else {}
            except json.JSONDecodeError:
                parsed = {"raw": raw[:500]}
            return {"ok": True, "status": response.getcode(), "data": parsed}
    except urllib.error.URLError as exc:
        return {"ok": False, "error": str(exc)}


def _load_ledger_texts() -> set[str]:
    texts: set[str] = set()
    for path in (LEDGER, PUBLISHED):
        if not path.exists():
            continue
        content = path.read_text(encoding="utf-8").lower()
        for slug in re.findall(r"\|\s*([a-z0-9][a-z0-9-]{2,})\s*\|", content):
            texts.add(slug.strip())
        for url in re.findall(r"https?://[^\s|)]+", content):
            texts.add(url.strip().lower().rstrip("/"))
    return texts


def _sheet_tab() -> str:
    return (
        get_credential("GOOGLE_SHEETS_TAB")
        or get_credential("GOOGLE_SHEET_NAME")
        or get_credential("GOOGLE_SHEETS_DEFAULT_SHEET")
        or "Темы"
    )


def _read_rows_service_account() -> list[dict[str, Any]] | None:
    """Read sheet rows via gspread if installed and credentials present."""
    encoded = get_credential("GOOGLE_SERVICE_ACCOUNT_BASE64")
    sheet_id = get_credential("GOOGLE_SHEET_ID")
    if not encoded or not sheet_id:
        return None
    try:
        import gspread  # type: ignore
        from google.oauth2.service_account import Credentials  # type: ignore
    except ImportError:
        return None

    try:
        info = json.loads(base64.b64decode(encoded).decode("utf-8"))
        scopes = ["https://www.googleapis.com/auth/spreadsheets"]
        creds = Credentials.from_service_account_info(info, scopes=scopes)
        client = gspread.authorize(creds)
        worksheet = client.open_by_key(sheet_id).worksheet(_sheet_tab())
        return worksheet.get_all_records()
    except Exception as exc:
        return [{"_error": str(exc)}]


def _find_candidate(rows: list[dict[str, Any]]) -> dict[str, Any] | None:
    known = _load_ledger_texts()
    link_keys = [_link_header(), "link", "url", "Ссылка"]
    for index, row in enumerate(rows, start=2):
        if row.get("_error"):
            continue
        link_val = ""
        for key in link_keys:
            if key in row and str(row.get(key) or "").strip():
                link_val = str(row[key]).strip()
                break
        if link_val:
            continue
        topic = str(row.get("Узкая тема посадочной") or row.get("Тема") or row.get("topic") or "").strip()
        if not topic:
            continue
        slug_hint = re.sub(r"[^a-z0-9]+", "-", topic.lower()).strip("-")[:60]
        if slug_hint in known:
            continue
        return {"row": index, "topic": topic, "data": row}
    return None


def cmd_reserve() -> int:
    print(f"GOOGLE_SHEET_ID: {_mask(get_credential('GOOGLE_SHEET_ID'))}")
    print(f"GOOGLE_SHEETS_WEBHOOK_URL: {_mask(get_credential('GOOGLE_SHEETS_WEBHOOK_URL'))}")
    print(f"GOOGLE_SERVICE_ACCOUNT_BASE64: {_mask(get_credential('GOOGLE_SERVICE_ACCOUNT_BASE64'))}")

    webhook = _webhook_post(
        {
            "action": "reserve",
            "sheet": _sheet_tab(),
            "link_column": get_credential("GOOGLE_SHEETS_LINK_COLUMN") or _link_header(),
            "status": STATUS_RESERVED,
            "ledgers_checked": [str(LEDGER.name), str(PUBLISHED.name)],
        }
    )
    if webhook.get("ok") and isinstance(webhook.get("data"), dict) and webhook["data"].get("row"):
        print(json.dumps({"phase": "reserve", "source": "webhook", **webhook["data"]}, ensure_ascii=False, indent=2))
        return 0

    rows = _read_rows_service_account()
    if rows is None:
        print(
            json.dumps(
                {
                    "phase": "reserve",
                    "ok": False,
                    "warning": "Sheets API unavailable; webhook did not return row",
                    "webhook": {k: v for k, v in webhook.items() if k != "data"},
                },
                ensure_ascii=False,
                indent=2,
            )
        )
        return 1

    if rows and rows[0].get("_error"):
        print(json.dumps({"phase": "reserve", "ok": False, "error": rows[0]["_error"]}, ensure_ascii=False))
        return 1

    candidate = _find_candidate(rows)
    if not candidate:
        print(json.dumps({"phase": "reserve", "ok": False, "error": "no candidate row"}, ensure_ascii=False))
        return 1

    row_num = candidate["row"]
    status_result = _webhook_post(
        {
            "action": "set_status",
            "sheet": _sheet_tab(),
            "row": row_num,
            "status": STATUS_RESERVED,
        }
    )

    # Service-account status write via gspread if webhook failed
    if not status_result.get("ok"):
        try:
            import gspread  # type: ignore
            from google.oauth2.service_account import Credentials  # type: ignore

            encoded = get_credential("GOOGLE_SERVICE_ACCOUNT_BASE64")
            sheet_id = get_credential("GOOGLE_SHEET_ID")
            if encoded and sheet_id:
                info = json.loads(base64.b64decode(encoded).decode("utf-8"))
                creds = Credentials.from_service_account_info(
                    info, scopes=["https://www.googleapis.com/auth/spreadsheets"]
                )
                ws = gspread.authorize(creds).open_by_key(sheet_id).worksheet(_sheet_tab())
                headers = ws.row_values(1)
                if "Статус" in headers:
                    col = headers.index("Статус") + 1
                    ws.update_cell(row_num, col, STATUS_RESERVED)
                    status_result = {"ok": True, "source": "service_account"}
        except Exception as exc:
            status_result = {"ok": False, "error": str(exc)}

    out = {
        "phase": "reserve",
        "ok": True,
        "row": row_num,
        "sheet": _sheet_tab(),
        "topic": candidate["topic"],
        "status_written": STATUS_RESERVED if status_result.get("ok") else "failed",
        "row_data": candidate["data"],
        "warnings": [] if status_result.get("ok") else ["status write failed"],
    }
    print(json.dumps(out, ensure_ascii=False, indent=2, default=str))
    return 0 if out["ok"] else 1


def cmd_publish(row: int, url: str, slug: str) -> int:
    """Write publication URL/slug/date/comment. Does not update «Статус» column."""
    published_at = datetime.now(timezone.utc).strftime("%Y-%m-%d %H:%M UTC")
    payload = {
        "action": "publish",
        "sheet": _sheet_tab(),
        "row": row,
        "url": url,
        "slug": slug,
        "published_at": published_at,
        "comment": PUBLISH_COMMENT,
        "link_column": get_credential("GOOGLE_SHEETS_LINK_COLUMN") or _link_header(),
    }
    webhook = _webhook_post(payload)
    if webhook.get("ok"):
        print(
            json.dumps(
                {"phase": "publish", "ok": True, "source": "webhook", "row": row, "url": url},
                ensure_ascii=False,
                indent=2,
            )
        )
        return 0

    try:
        import gspread  # type: ignore
        from google.oauth2.service_account import Credentials  # type: ignore

        encoded = get_credential("GOOGLE_SERVICE_ACCOUNT_BASE64")
        sheet_id = get_credential("GOOGLE_SHEET_ID")
        if not encoded or not sheet_id:
            raise RuntimeError("No service account credentials")

        info = json.loads(base64.b64decode(encoded).decode("utf-8"))
        creds = Credentials.from_service_account_info(info, scopes=["https://www.googleapis.com/auth/spreadsheets"])
        ws = gspread.authorize(creds).open_by_key(sheet_id).worksheet(_sheet_tab())
        headers = ws.row_values(1)
        link_col = _link_header()
        # Do not update «Статус» on publish — it stays «Не использовано» from reserve.
        updates: dict[str, str] = {
            link_col: url,
            "Slug": slug,
            "Дата публикации": published_at,
            "Комментарий": PUBLISH_COMMENT,
        }
        for header, value in updates.items():
            if header in headers:
                ws.update_cell(row, headers.index(header) + 1, value)
        print(json.dumps({"phase": "publish", "ok": True, "source": "service_account", "row": row}, indent=2))
        return 0
    except Exception as exc:
        print(
            json.dumps(
                {
                    "phase": "publish",
                    "ok": False,
                    "warning": "publish on site succeeded but sheet update failed",
                    "error": str(exc),
                    "row": row,
                    "url": url,
                },
                ensure_ascii=False,
                indent=2,
            )
        )
        return 1


def main() -> int:
    parser = argparse.ArgumentParser(description="Google Sheets logger for Nero Network")
    sub = parser.add_subparsers(dest="command", required=True)

    sub.add_parser("reserve", help="Find and reserve first free topic row")
    pub = sub.add_parser("publish", help="Write published URL to sheet row")
    pub.add_argument("--row", type=int, required=True)
    pub.add_argument("--url", required=True)
    pub.add_argument("--slug", required=True)

    args = parser.parse_args()
    if args.command == "reserve":
        return cmd_reserve()
    if args.command == "publish":
        return cmd_publish(args.row, args.url, args.slug)
    return 1


if __name__ == "__main__":
    raise SystemExit(main())

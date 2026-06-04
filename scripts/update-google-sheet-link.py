#!/usr/bin/env python3
"""Write a published page URL to one row in the Nero Network Google Sheet."""

from __future__ import annotations

import argparse
import base64
import json
import os
import sys
from pathlib import Path


ROOT = Path(__file__).resolve().parents[1]


def col_letter(index: int) -> str:
    """Convert 0-based column index to A1 notation (A, B, …, AA)."""
    index += 1
    letters = ""
    while index:
        index, remainder = divmod(index - 1, 26)
        letters = chr(65 + remainder) + letters
    return letters


def load_env_file(path: Path) -> dict[str, str]:
    if not path.exists():
        return {}
    values: dict[str, str] = {}
    for raw_line in path.read_text(encoding="utf-8").splitlines():
        line = raw_line.strip()
        if not line or line.startswith("#") or "=" not in line:
            continue
        key, value = line.split("=", 1)
        values[key.strip()] = value.strip().strip('"').strip("'")
    return values


def config_value(name: str) -> str:
    env_file = load_env_file(ROOT / ".env")
    return os.environ.get(name, "") or env_file.get(name, "")


def build_sheets_service():
    try:
        from google.oauth2 import service_account
        from googleapiclient.discovery import build
    except ImportError as exc:
        raise RuntimeError(
            "google-auth and google-api-python-client are required: "
            "pip install google-auth google-api-python-client"
        ) from exc

    sa_b64 = config_value("GOOGLE_SERVICE_ACCOUNT_BASE64")
    sheet_id = config_value("GOOGLE_SHEET_ID")
    tab = config_value("GOOGLE_SHEETS_TAB") or config_value("GOOGLE_SHEETS_DEFAULT_SHEET")
    link_col = config_value("GOOGLE_SHEETS_LINK_COLUMN")

    missing = [name for name, value in (
        ("GOOGLE_SERVICE_ACCOUNT_BASE64", sa_b64),
        ("GOOGLE_SHEET_ID", sheet_id),
        ("GOOGLE_SHEETS_TAB or GOOGLE_SHEETS_DEFAULT_SHEET", tab),
        ("GOOGLE_SHEETS_LINK_COLUMN", link_col),
    ) if not value]
    if missing:
        raise RuntimeError("missing env: " + ", ".join(missing))

    sa_info = json.loads(base64.b64decode(sa_b64))
    creds = service_account.Credentials.from_service_account_info(
        sa_info,
        scopes=["https://www.googleapis.com/auth/spreadsheets"],
    )
    service = build("sheets", "v4", credentials=creds, cache_discovery=False)
    return service, sheet_id, tab, link_col


def read_header_index(service, sheet_id: str, tab: str, link_col: str) -> int:
    header_range = f"'{tab}'!1:1"
    headers = (
        service.spreadsheets()
        .values()
        .get(spreadsheetId=sheet_id, range=header_range)
        .execute()
        .get("values", [[]])[0]
    )
    for index, header in enumerate(headers):
        if header.strip() == link_col.strip():
            return index
    raise RuntimeError(f"link column not found: {link_col!r}")


def read_cell(service, sheet_id: str, tab: str, row: int, col_index: int) -> str:
    cell_range = f"'{tab}'!{col_letter(col_index)}{row}"
    values = (
        service.spreadsheets()
        .values()
        .get(spreadsheetId=sheet_id, range=cell_range)
        .execute()
        .get("values", [])
    )
    if not values or not values[0]:
        return ""
    return str(values[0][0]).strip()


def write_cell(service, sheet_id: str, tab: str, row: int, col_index: int, url: str) -> None:
    cell_range = f"'{tab}'!{col_letter(col_index)}{row}"
    service.spreadsheets().values().update(
        spreadsheetId=sheet_id,
        range=cell_range,
        valueInputOption="RAW",
        body={"values": [[url]]},
    ).execute()


def main() -> int:
    parser = argparse.ArgumentParser(
        description="Write published page URL to Google Sheet link column (single row)."
    )
    parser.add_argument("--row", type=int, required=True, help="Sheet row number (1 = header)")
    parser.add_argument("--url", required=True, help="Public https URL of the published page")
    parser.add_argument("--dry-run", action="store_true", help="Read current value only, do not write")
    parser.add_argument(
        "--force",
        action="store_true",
        help="Overwrite cell even if it already contains a URL (default: skip)",
    )
    args = parser.parse_args()

    if args.row < 2:
        print("FAIL: --row must be >= 2 (row 1 is the header)", file=sys.stderr)
        return 1

    url = args.url.strip()
    if not url.startswith("https://"):
        print("FAIL: --url must start with https://", file=sys.stderr)
        return 1

    try:
        service, sheet_id, tab, link_col = build_sheets_service()
        col_index = read_header_index(service, sheet_id, tab, link_col)
        current = read_cell(service, sheet_id, tab, args.row, col_index)

        if args.dry_run:
            print(f"OK dry-run row {args.row}: current={current or '(empty)'}")
            return 0

        if current and not args.force:
            if current.rstrip("/") == url.rstrip("/"):
                print(f"OK row {args.row}: already set to this URL")
                return 0
            print(
                f"FAIL row {args.row}: cell already has a URL; use --force to overwrite",
                file=sys.stderr,
            )
            return 1

        write_cell(service, sheet_id, tab, args.row, col_index, url)
        print(f"OK row {args.row}: updated link column")
        return 0
    except Exception as exc:
        print(f"FAIL: {exc}", file=sys.stderr)
        return 1


if __name__ == "__main__":
    raise SystemExit(main())

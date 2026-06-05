#!/usr/bin/env python3
"""Update one Google Sheet row after Nero Network page publication.

Writes the public URL to the link column and ``Не использовано`` to the Status column.
"""

from __future__ import annotations

import argparse
import base64
import json
import sys
from pathlib import Path

from credentials import get_credential, public_site_url, require_credential

STATUS_VALUE = "Не использовано"
STATUS_HEADER = "Статус"


def parse_args() -> argparse.Namespace:
    parser = argparse.ArgumentParser(description="Mark a Google Sheet row as published.")
    parser.add_argument("--row", type=int, required=True, help="Sheet row number (1-based, includes header)")
    parser.add_argument("--slug", required=True, help="Page slug (path segment)")
    parser.add_argument("--dry-run", action="store_true")
    return parser.parse_args()


def column_index(header: list[str], name: str | None, fallback_substrings: tuple[str, ...]) -> int:
    if name:
        target = name.strip().lower()
        for index, cell in enumerate(header):
            if cell.strip().lower() == target:
                return index
        for index, cell in enumerate(header):
            if target in cell.strip().lower():
                return index
    for index, cell in enumerate(header):
        lowered = cell.strip().lower()
        if any(part in lowered for part in fallback_substrings):
            return index
    raise RuntimeError(f"Column not found: {name or fallback_substrings}")


def open_worksheet():
    try:
        import gspread
        from google.oauth2.service_account import Credentials
    except ImportError as exc:
        raise RuntimeError("Install gspread and google-auth to update Google Sheets.") from exc

    sa_b64 = require_credential("GOOGLE_SERVICE_ACCOUNT_BASE64")
    sheet_id = require_credential("GOOGLE_SHEET_ID")
    tab = get_credential("GOOGLE_SHEETS_TAB") or get_credential("GOOGLE_SHEETS_DEFAULT_SHEET")

    info = json.loads(base64.b64decode(sa_b64))
    scopes = ["https://www.googleapis.com/auth/spreadsheets"]
    creds = Credentials.from_service_account_info(info, scopes=scopes)
    workbook = gspread.authorize(creds).open_by_key(sheet_id)
    return workbook.worksheet(tab) if tab else workbook.sheet1


def public_page_url(slug: str) -> str:
    base = public_site_url().rstrip("/")
    slug = slug.strip("/")
    return f"{base}/{slug}/"


def link_points_to_slug(link: str, slug: str) -> bool:
    normalized = link.strip()
    if not normalized:
        return False
    slug = slug.strip("/")
    return normalized.endswith(f"/{slug}/") or normalized.endswith(f"/{slug}")


def main() -> int:
    import gspread

    args = parse_args()
    if args.row < 2:
        print("Row must be >= 2 (row 1 is the header).", file=sys.stderr)
        return 2

    worksheet = open_worksheet()
    header = worksheet.row_values(1)
    link_col_name = get_credential("GOOGLE_SHEETS_LINK_COLUMN")
    link_idx = column_index(header, link_col_name, ("url", "ссылка", "страниц"))
    status_idx = column_index(header, STATUS_HEADER, ("статус",))

    if link_idx == status_idx:
        raise RuntimeError("Link column and Status column must be different.")

    url_value = public_page_url(args.slug)
    link_cell = gspread.utils.rowcol_to_a1(args.row, link_idx + 1)
    status_cell = gspread.utils.rowcol_to_a1(args.row, status_idx + 1)

    print(f"Sheet row: {args.row}")
    print(f"Link column ({header[link_idx]}): {link_cell} -> {url_value}")
    print(f"Status column ({header[status_idx]}): {status_cell} -> {STATUS_VALUE}")
    if abs(status_idx - link_idx) > 1:
        print("Note: link and status columns are not adjacent — updating cells separately.")

    if args.dry_run:
        print("Dry run: no changes written.")
        return 0

    existing_link = worksheet.cell(args.row, link_idx + 1).value or ""
    if existing_link.strip() and not link_points_to_slug(existing_link, args.slug):
        print(
            f"Refusing to overwrite existing link in {link_cell}: {existing_link!r}",
            file=sys.stderr,
        )
        return 3

    # Columns are not always adjacent (e.g. URL col 18, empty col 19, Статус col 20).
    worksheet.batch_update(
        [
            {"range": link_cell, "values": [[url_value]]},
            {"range": status_cell, "values": [[STATUS_VALUE]]},
        ],
        value_input_option="USER_ENTERED",
    )
    print("Google Sheet updated.")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())

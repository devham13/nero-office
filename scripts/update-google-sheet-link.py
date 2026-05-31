#!/usr/bin/env python3
"""Write published URL to Google Sheet column «Ссылка на сайт» for a topic row."""

from __future__ import annotations

import argparse
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
sys.path.insert(0, str(ROOT / "shared"))

from google_sheets import detect_sheet_row, try_update_site_link  # noqa: E402


def main() -> int:
    parser = argparse.ArgumentParser(description="Update Google Sheet site link for a topic row.")
    parser.add_argument("--url", required=True, help="Public page URL (https://…)")
    parser.add_argument("--row", type=int, default=None, help="Sheet row number (1-based, as in UI)")
    parser.add_argument("--handoff", default=None, help="Path to handoff for row autodetect")
    args = parser.parse_args()

    row = args.row
    if row is None:
        handoff = Path(args.handoff) if args.handoff else ROOT / ".cursor" / "nero-network-handoff.md"
        row = detect_sheet_row(handoff if handoff.is_file() else None)

    ok = try_update_site_link(row, args.url.rstrip("/") + ("" if args.url.endswith("/") else "/"))
    return 0 if ok else 1


if __name__ == "__main__":
    raise SystemExit(main())

#!/usr/bin/env python3
"""Backfill «Ссылка на сайт» for known published pages (manual row → URL map)."""

from __future__ import annotations

import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
sys.path.insert(0, str(ROOT / "shared"))

from google_sheets import try_update_site_link  # noqa: E402

# Номер строки = как в Google Sheets UI (строка 1 — заголовки)
BACKFILL = {
    2: "https://meta-journal.ru/ai-obrabotka-zayavok-s-sayta/",
    3: "https://meta-journal.ru/ai-kvalifikaciya-lidov/",
    # vnedrenie (если отдельная страница в той же строке таблицы):
    # 2: "https://meta-journal.ru/vnedrenie-ai-obrabotka-zayavok-s-sayta/",
}


def main() -> int:
    ok_all = True
    for row, url in sorted(BACKFILL.items()):
        if not try_update_site_link(row, url):
            ok_all = False
    return 0 if ok_all else 1


if __name__ == "__main__":
    raise SystemExit(main())

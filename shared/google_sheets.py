#!/usr/bin/env python3
"""Update Nero Network Google Sheet — column «Ссылка на сайт» for a topic row."""

from __future__ import annotations

import json
import re
from pathlib import Path
from typing import Any

from credentials import get_credential

DEFAULT_SPREADSHEET_ID = "10U4gH09L3uJqtxKdFM2_XH7LxRI39TNzEMGHWlCw-ls"
LINK_COLUMN_NAMES = (
    "ссылка на сайт",
    "ссылка на страницу",
    "url страницы",
    "url",
    "ссылка",
)


def spreadsheet_id() -> str:
    return (
        get_credential("GOOGLE_SHEETS_SPREADSHEET_ID")
        or get_credential("GOOGLE_SPREADSHEET_ID")
        or DEFAULT_SPREADSHEET_ID
    ).strip()


def sheet_tab_name() -> str:
    return (get_credential("GOOGLE_SHEETS_TAB") or get_credential("GOOGLE_SHEETS_SHEET") or "Лист1").strip()


def link_column_name() -> str:
    return (get_credential("GOOGLE_SHEETS_LINK_COLUMN") or "Ссылка на сайт").strip()


def _load_service_account_info() -> dict[str, Any]:
    inline = get_credential("GOOGLE_SERVICE_ACCOUNT_JSON")
    if inline:
        text = inline.strip()
        if Path(text).is_file():
            return json.loads(Path(text).read_text(encoding="utf-8"))
        return json.loads(text)

    path = get_credential("GOOGLE_APPLICATION_CREDENTIALS")
    if path and Path(path).is_file():
        return json.loads(Path(path).read_text(encoding="utf-8"))

    local = Path(__file__).resolve().parent / "google-service-account.json"
    if local.is_file():
        return json.loads(local.read_text(encoding="utf-8"))

    raise RuntimeError(
        "Нет учётных данных Google Sheets. Добавьте GOOGLE_SERVICE_ACCOUNT_JSON "
        "или GOOGLE_APPLICATION_CREDENTIALS (service account) и дайте редактору доступ к таблице."
    )


def _sheets_service():
    from google.oauth2 import service_account
    from googleapiclient.discovery import build

    info = _load_service_account_info()
    creds = service_account.Credentials.from_service_account_info(
        info,
        scopes=["https://www.googleapis.com/auth/spreadsheets"],
    )
    return build("sheets", "v4", credentials=creds, cache_discovery=False)


def column_letter(index: int) -> str:
    """0-based column index → A, B, …, AA."""
    n = index + 1
    letters = ""
    while n:
        n, rem = divmod(n - 1, 26)
        letters = chr(65 + rem) + letters
    return letters


def find_link_column_index(headers: list[str], preferred: str | None = None) -> int:
    normalized = [h.strip().lower() for h in headers]
    if preferred:
        pref = preferred.strip().lower()
        if pref in normalized:
            return normalized.index(pref)
        for i, h in enumerate(normalized):
            if pref in h or h in pref:
                return i

    for needle in LINK_COLUMN_NAMES:
        for i, h in enumerate(normalized):
            if needle in h:
                return i

    raise RuntimeError(
        f"Колонка «{preferred or link_column_name()}» не найдена. Заголовки: {headers!r}"
    )


def parse_sheet_row_from_text(text: str) -> int | None:
    """Extract 1-based Google Sheets row number (as in UI) from Kirill handoff / ledger."""

    m = re.search(r"GOOGLE_SHEET_ROW:\s*(\d+)", text, re.IGNORECASE)
    if m:
        return int(m.group(1))

    m = re.search(r"\(Google Таблица,\s*строка\s+(\d+)\)", text, re.IGNORECASE)
    if m:
        return int(m.group(1))

    m = re.search(r"строка\s+№?\s*(\d+)", text, re.IGNORECASE)
    if m:
        return int(m.group(1))

    m = re.search(r"Строка[/\s]*идентификатор[^:]*:\s*№?\s*(\d+)", text, re.IGNORECASE)
    if m:
        return int(m.group(1)) + 1

    m = re.search(r"Google Таблица[^,]*№\s*(\d+)", text, re.IGNORECASE)
    if m:
        return int(m.group(1)) + 1

    return None


def detect_sheet_row(handoff_path: Path | None = None) -> int | None:
    env_row = get_credential("GOOGLE_SHEETS_ROW")
    if env_row and env_row.isdigit():
        return int(env_row)

    paths: list[Path] = []
    if handoff_path and handoff_path.is_file():
        paths.append(handoff_path)
    root = Path(__file__).resolve().parents[1]
    paths.append(root / ".cursor" / "nero-network-handoff.md")
    paths.append(root / "shared" / "kirill-news-ledger.md")

    for path in paths:
        if not path.is_file():
            continue
        text = path.read_text(encoding="utf-8", errors="ignore")
        if "=== КИРИЛЛ" not in text and "Google Таблица" not in text:
            continue
        row = parse_sheet_row_from_text(text)
        if row:
            return row
    return None


def update_site_link(row: int, url: str, *, column_name: str | None = None) -> str:
    """
    Write public page URL into «Ссылка на сайт» for the given sheet row (1-based, as in UI).
    Returns A1 notation of updated cell.
    """
    if row < 2:
        raise ValueError("Номер строки должен быть ≥ 2 (строка 1 — заголовки таблицы).")

    service = _sheets_service()
    sid = spreadsheet_id()
    tab = sheet_tab_name()

    header_range = f"'{tab}'!1:1"
    result = (
        service.spreadsheets()
        .values()
        .get(spreadsheetId=sid, range=header_range)
        .execute()
    )
    rows = result.get("values") or []
    if not rows or not rows[0]:
        raise RuntimeError(f"Пустая первая строка в таблице {tab}")

    col_idx = find_link_column_index(rows[0], column_name or link_column_name())
    cell = f"'{tab}'!{column_letter(col_idx)}{row}"

    (
        service.spreadsheets()
        .values()
        .update(
            spreadsheetId=sid,
            range=cell,
            valueInputOption="USER_ENTERED",
            body={"values": [[url]]},
        )
        .execute()
    )
    return cell


def try_update_site_link(row: int | None, url: str) -> bool:
    if not row:
        print("Google Sheets: номер строки не задан (GOOGLE_SHEET_ROW / handoff Кирилла). Пропуск.")
        return False
    try:
        cell = update_site_link(row, url)
        print(f"Google Sheets OK: {cell} ← {url}")
        return True
    except Exception as exc:
        print(f"Google Sheets: не удалось обновить строку {row}: {exc}")
        return False

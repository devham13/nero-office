"""Log published pages to Google Sheets. Secrets via env only — never log credentials."""

from __future__ import annotations

import base64
import json
import logging
from datetime import datetime, timezone
from pathlib import Path

from google.oauth2 import service_account
from googleapiclient.discovery import build

from credentials import get_credential

logger = logging.getLogger(__name__)

SCOPES = ("https://www.googleapis.com/auth/spreadsheets",)
HEADERS = ("Дата", "Тема", "URL", "Slug", "Статус", "Агент", "Комментарий")


def _resolve_sheet_id() -> str | None:
    return get_credential("GOOGLE_SHEET_ID") or get_credential("GOOGLE_SHEETS_SPREADSHEET_ID")


def _resolve_sheet_name() -> str:
    return (
        get_credential("GOOGLE_SHEET_NAME")
        or get_credential("GOOGLE_SHEETS_TAB")
        or "Publications"
    )


def _load_service_account_info() -> dict:
    raw_b64 = get_credential("GOOGLE_SERVICE_ACCOUNT_BASE64")
    if raw_b64:
        return json.loads(base64.b64decode(raw_b64).decode("utf-8"))

    raw_json = get_credential("GOOGLE_SERVICE_ACCOUNT_JSON")
    if raw_json:
        return json.loads(raw_json)

    creds_path = get_credential("GOOGLE_APPLICATION_CREDENTIALS")
    if creds_path:
        path = Path(creds_path).expanduser()
        if path.is_file():
            return json.loads(path.read_text(encoding="utf-8"))
        raise RuntimeError(f"GOOGLE_APPLICATION_CREDENTIALS file not found: {creds_path}")

    raise RuntimeError(
        "Google service account is not set "
        "(GOOGLE_SERVICE_ACCOUNT_BASE64, GOOGLE_SERVICE_ACCOUNT_JSON, or GOOGLE_APPLICATION_CREDENTIALS)"
    )


def _sheets_service():
    sheet_id = _resolve_sheet_id()
    if not sheet_id:
        raise RuntimeError("GOOGLE_SHEET_ID or GOOGLE_SHEETS_SPREADSHEET_ID is not set")

    info = _load_service_account_info()
    creds = service_account.Credentials.from_service_account_info(info, scopes=SCOPES)
    service = build("sheets", "v4", credentials=creds, cache_discovery=False)
    return service, sheet_id


def _sheet_range(sheet_name: str, cell_range: str) -> str:
    escaped = sheet_name.replace("'", "''")
    return f"'{escaped}'!{cell_range}"


def _sheet_is_empty(service, spreadsheet_id: str, sheet_name: str) -> bool:
    result = (
        service.spreadsheets()
        .values()
        .get(spreadsheetId=spreadsheet_id, range=_sheet_range(sheet_name, "A1:G1"))
        .execute()
    )
    rows = result.get("values") or []
    if not rows:
        return True
    return not any(str(cell).strip() for row in rows for cell in row)


def _append_row(service, spreadsheet_id: str, sheet_name: str, row: list[str]) -> None:
    service.spreadsheets().values().append(
        spreadsheetId=spreadsheet_id,
        range=_sheet_range(sheet_name, "A:G"),
        valueInputOption="USER_ENTERED",
        insertDataOption="INSERT_ROWS",
        body={"values": [row]},
    ).execute()


def log_publication_to_google_sheet(
    topic: str,
    url: str,
    slug: str = "",
    status: str = "published",
    agent: str = "",
    comment: str = "",
) -> bool:
    """Append publication row to Google Sheet. Returns True on success; never raises."""
    sheet_name = _resolve_sheet_name()
    try:
        service, spreadsheet_id = _sheets_service()
        if _sheet_is_empty(service, spreadsheet_id, sheet_name):
            _append_row(service, spreadsheet_id, sheet_name, list(HEADERS))

        timestamp = datetime.now(timezone.utc).strftime("%Y-%m-%d %H:%M:%S UTC")
        row = [timestamp, topic, url, slug, status, agent, comment]
        _append_row(service, spreadsheet_id, sheet_name, row)
        logger.info("Google Sheets: logged publication slug=%s status=%s", slug or "(none)", status)
        return True
    except Exception as exc:
        logger.warning("Google Sheets log failed: %s", exc)
        return False

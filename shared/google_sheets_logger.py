"""Log published pages to Google Sheets. Secrets via env only — never log credentials."""

from __future__ import annotations

import base64
import json
import logging
from datetime import datetime, timezone

from google.oauth2 import service_account
from googleapiclient.discovery import build

from credentials import get_credential

logger = logging.getLogger(__name__)

SCOPES = ("https://www.googleapis.com/auth/spreadsheets",)
HEADERS = ("Дата", "Тема", "URL", "Slug", "Статус", "Агент", "Комментарий")


def _sheets_service():
    raw_b64 = get_credential("GOOGLE_SERVICE_ACCOUNT_BASE64")
    sheet_id = get_credential("GOOGLE_SHEET_ID")
    if not raw_b64 or not sheet_id:
        raise RuntimeError("GOOGLE_SERVICE_ACCOUNT_BASE64 or GOOGLE_SHEET_ID is not set")

    info = json.loads(base64.b64decode(raw_b64).decode("utf-8"))
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
    sheet_name = get_credential("GOOGLE_SHEET_NAME") or "Publications"
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

#!/usr/bin/env python3
"""Point meta-journal.ru A record to Beget (same IP as www). Requires Beget API account password."""

from __future__ import annotations

import json
import sys
import urllib.parse
import urllib.request

from credentials import get_credential, require_credential

BEGET_IP = "45.130.41.132"
FQDN = "meta-journal.ru"


def beget_api(method: str, **params: str) -> dict:
    login = require_credential("BEGET_API_LOGIN")
    passwd = require_credential("BEGET_API_PASSWORD")
    q = urllib.parse.urlencode({"login": login, "passwd": passwd, **params})
    url = f"https://api.beget.com/api/{method}?{q}"
    with urllib.request.urlopen(url, timeout=30) as response:
        return json.loads(response.read().decode())


def main() -> int:
    if not get_credential("BEGET_API_LOGIN") or not get_credential("BEGET_API_PASSWORD"):
        print(
            "Set BEGET_API_LOGIN and BEGET_API_PASSWORD (Beget panel → API) "
            f"then re-run to set {FQDN} A → {BEGET_IP}",
            file=sys.stderr,
        )
        return 2

    current = beget_api("dns/getData", fqdn=FQDN)
    if current.get("status") != "success":
        print(json.dumps(current, ensure_ascii=False, indent=2))
        return 1

    records = current.get("answer", {}).get("result", {}).get("records", {})
    if not records:
        records = {}

    records["A"] = [{"priority": 10, "value": BEGET_IP}]
    payload = json.dumps({"fqdn": FQDN, "records": records}, ensure_ascii=False)
    q = urllib.parse.urlencode(
        {
            "login": require_credential("BEGET_API_LOGIN"),
            "passwd": require_credential("BEGET_API_PASSWORD"),
            "input_format": "json",
            "output_format": "json",
            "input_data": payload,
        }
    )
    url = f"https://api.beget.com/api/dns/changeRecords?{q}"
    with urllib.request.urlopen(url, timeout=30) as response:
        result = json.loads(response.read().decode())
    print(json.dumps(result, ensure_ascii=False, indent=2))
    return 0 if result.get("status") == "success" else 1


if __name__ == "__main__":
    raise SystemExit(main())

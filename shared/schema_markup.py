#!/usr/bin/env python3
"""Schema.org JSON-LD graph builder for Nero Network pages.

Stdlib only. No secrets, no external APIs.
"""

from __future__ import annotations

import json
import re
import sys
from pathlib import Path
from typing import Any
from urllib.parse import urljoin, urlparse

sys.path.insert(0, str(Path(__file__).resolve().parent))

from credentials import get_credential  # noqa: E402

SCHEMA_CONTEXT = "https://schema.org"


def _normalize_url(url: str) -> str:
    parsed = urlparse(url.strip())
    path = parsed.path or "/"
    if not path.endswith("/"):
        path += "/"
    return f"{parsed.scheme}://{parsed.netloc}{path}"


def _site_origin(url: str) -> str:
    parsed = urlparse(url.strip())
    return f"{parsed.scheme}://{parsed.netloc}"


def _org_name(explicit: str | None = None) -> str:
    return (
        explicit
        or get_credential("SITE_BRAND")
        or get_credential("SITE_NICHE")
        or "Organization"
    )


def _site_url(page_url: str, explicit: str | None = None) -> str:
    return _normalize_url(
        explicit or get_credential("PUBLIC_SITE_URL") or get_credential("WP_SITE_URL") or _site_origin(page_url)
    )


def build_schema_graph(
    title: str,
    description: str,
    url: str,
    slug: str,
    page_type: str = "service",
    faq_items: list[dict[str, str]] | None = None,
    organization_name: str | None = None,
    site_url: str | None = None,
    h1: str | None = None,
) -> str:
    """Build a Schema.org @graph JSON-LD string (without <script> wrapper)."""
    if not title or not description or not url:
        raise ValueError("title, description and url are required")

    page_url = _normalize_url(url)
    origin = _site_url(page_url, site_url)
    org_name = _org_name(organization_name)
    page_name = h1 or title

    org_id = f"{origin}/#organization"
    website_id = f"{origin}/#website"
    webpage_id = f"{page_url}#webpage"

    graph: list[dict[str, Any]] = [
        {
            "@type": "Organization",
            "@id": org_id,
            "name": org_name,
            "url": origin,
        },
        {
            "@type": "WebSite",
            "@id": website_id,
            "url": origin,
            "name": org_name,
            "publisher": {"@id": org_id},
        },
        {
            "@type": "WebPage",
            "@id": webpage_id,
            "url": page_url,
            "name": page_name,
            "description": description,
            "isPartOf": {"@id": website_id},
            "about": {"@id": org_id},
        },
        {
            "@type": "BreadcrumbList",
            "@id": f"{page_url}#breadcrumb",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Главная",
                    "item": origin,
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": page_name,
                    "item": page_url,
                },
            ],
        },
    ]

    normalized_type = (page_type or "service").lower()
    if normalized_type in ("service", "commercial", "landing"):
        graph.append(
            {
                "@type": "Service",
                "@id": f"{page_url}#service",
                "name": page_name,
                "description": description,
                "url": page_url,
                "provider": {"@id": org_id},
            }
        )
    elif normalized_type in ("article", "news", "informational"):
        graph.append(
            {
                "@type": "Article",
                "@id": f"{page_url}#article",
                "headline": page_name,
                "description": description,
                "url": page_url,
                "mainEntityOfPage": {"@id": webpage_id},
                "publisher": {"@id": org_id},
            }
        )

    if faq_items:
        questions = []
        for item in faq_items:
            question = (item.get("question") or item.get("name") or "").strip()
            answer = (item.get("answer") or item.get("text") or "").strip()
            if not question or not answer:
                continue
            questions.append(
                {
                    "@type": "Question",
                    "name": question,
                    "acceptedAnswer": {"@type": "Answer", "text": answer},
                }
            )
        if questions:
            graph.append(
                {
                    "@type": "FAQPage",
                    "@id": f"{page_url}#faq",
                    "mainEntity": questions,
                }
            )

    payload = {"@context": SCHEMA_CONTEXT, "@graph": graph}
    return json.dumps(payload, ensure_ascii=False, indent=2)


def wrap_ld_json_script(json_ld: str) -> str:
    """Wrap JSON-LD in a safe script tag for PHP templates."""
    # Prevent accidental </script> breakouts in HTML
    safe = json_ld.replace("</", "<\\/")
    return f'<script type="application/ld+json">\n{safe}\n</script>'


def validate_json_ld(json_ld: str) -> tuple[bool, str]:
    """Parse and validate JSON-LD string."""
    try:
        data = json.loads(json_ld)
    except json.JSONDecodeError as exc:
        return False, str(exc)
    if not isinstance(data, dict):
        return False, "root must be object"
    if data.get("@context") != SCHEMA_CONTEXT and "@graph" not in data:
        return False, "missing @context or @graph"
    return True, "ok"


def build_future_page_url(slug: str, base_url: str | None = None) -> str:
    """Build canonical future URL before deploy."""
    origin = _site_url("https://example.invalid/", base_url).rstrip("/")
    slug_clean = re.sub(r"^/+|/+$", "", slug)
    return _normalize_url(urljoin(f"{origin}/", f"{slug_clean}/"))


if __name__ == "__main__":
    import argparse

    parser = argparse.ArgumentParser(description="Build Schema.org JSON-LD graph")
    parser.add_argument("--title", required=True)
    parser.add_argument("--description", required=True)
    parser.add_argument("--url", required=True)
    parser.add_argument("--slug", required=True)
    parser.add_argument("--page-type", default="service")
    parser.add_argument("--wrap", action="store_true", help="Wrap in script tag")
    args = parser.parse_args()

    raw = build_schema_graph(
        title=args.title,
        description=args.description,
        url=args.url,
        slug=args.slug,
        page_type=args.page_type,
    )
    ok, msg = validate_json_ld(raw)
    if not ok:
        raise SystemExit(f"Invalid JSON-LD: {msg}")
    print(wrap_ld_json_script(raw) if args.wrap else raw)

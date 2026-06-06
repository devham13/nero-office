#!/usr/bin/env python3
"""Mobile checklist utilities for Nero Network pipeline.

Stdlib only. No external APIs. No secrets. Read-only helpers.
"""

from __future__ import annotations

import re
from typing import Iterable

MOBILE_VIEWPORTS: tuple[int, ...] = (360, 390, 430)

FORBIDDEN_CSS_PATTERNS: tuple[str, ...] = (
    r"width\s*:\s*100vw",
    r"min-width\s*:\s*\d{3,}px",
    r"width\s*:\s*\d{4,}px",
    r"overflow-x\s*:\s*visible",
    r"white-space\s*:\s*nowrap",
)

LEGACY_DESIGN_MARKERS: tuple[str, ...] = (
    "amo-sticky-nav",
    "ym-sticky-nav",
    "nero-network-sticky",
    "class=\"sticky-nav\"",
)

RECOMMENDED_MOBILE_MEDIA = (
    "@media (max-width: 480px)",
    "@media (max-width: 768px)",
    "@media (max-width: 900px)",
)


def scan_css_for_risky_rules(css: str) -> list[str]:
    """Return human-readable warnings for risky CSS patterns."""
    warnings: list[str] = []
    for pattern in FORBIDDEN_CSS_PATTERNS:
        if re.search(pattern, css, re.IGNORECASE):
            warnings.append(f"Найден рискованный CSS-паттерн: /{pattern}/")
    if not any(m in css for m in RECOMMENDED_MOBILE_MEDIA):
        warnings.append("Нет явных @media для mobile (480/768/900px)")
    return warnings


def scan_html_for_legacy_markers(html: str) -> list[str]:
    """Detect legacy design markers that should not appear on new pages."""
    found: list[str] = []
    lower = html.lower()
    for marker in LEGACY_DESIGN_MARKERS:
        if marker.lower() in lower:
            found.append(marker)
    return found


def format_viewport_line(width: int, status: str, detail: str = "") -> str:
    """Format a single viewport check line for markdown reports."""
    suffix = f" — {detail}" if detail else ""
    return f"* {width}px: {status}{suffix}"


def format_mobile_report(
    *,
    url: str,
    status: str,
    viewport_results: dict[int, str],
    header: str = "OK",
    menu: str = "OK",
    hero: str = "OK",
    h1: str = "OK",
    cta: str = "OK",
    horizontal_scroll: str = "none",
    sections: str = "OK",
    faq: str = "N/A",
    internal_links: str = "N/A",
    fixes: Iterable[str] | None = None,
    warnings: Iterable[str] | None = None,
    blockers: Iterable[str] | None = None,
    slug: str = "",
    template: str = "",
) -> str:
    """Generate markdown fragment body for mobile-agent."""
    lines = [
        "=== MOBILE-AGENT ===",
        f"Статус: {status}",
        "",
        f"URL: {url}",
    ]
    if slug:
        lines.append(f"Slug: {slug}")
    if template:
        lines.append(f"Template: {template}")
    lines.extend(["", "Viewport checks:"])
    for w in MOBILE_VIEWPORTS:
        lines.append(format_viewport_line(w, viewport_results.get(w, "not checked")))
    lines.extend(
        [
            "",
            f"Header: {header}",
            f"Menu: {menu}",
            f"Hero: {hero}",
            f"H1: {h1}",
            f"CTA: {cta}",
            f"Horizontal scroll: {horizontal_scroll}",
            f"Sections: {sections}",
            f"FAQ: {faq}",
            f"Internal links: {internal_links}",
            "",
            "Fixes applied:",
        ]
    )
    fix_list = list(fixes or [])
    lines.extend(f"- {f}" for f in fix_list) if fix_list else lines.append("- (нет)")
    lines.extend(["", "Warnings:"])
    warn_list = list(warnings or [])
    lines.extend(f"- {w}" for w in warn_list) if warn_list else lines.append("- (нет)")
    lines.extend(["", "Blockers:"])
    block_list = list(blockers or [])
    lines.extend(f"- {b}" for b in block_list) if block_list else lines.append("- (нет)")
    lines.extend(["", "## Передача пайплайну", "Следующий шаг: qa (Макс)"])
    return "\n".join(lines) + "\n"


if __name__ == "__main__":
    demo = format_mobile_report(
        url="https://example.com/demo/",
        status="✅ ГОТОВО",
        viewport_results={360: "OK", 390: "OK", 430: "OK"},
        slug="demo",
        template="page-demo.php",
    )
    print(demo)

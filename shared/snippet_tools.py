#!/usr/bin/env python3
"""Snippet utilities for Nero Network pipeline.

Stdlib only. No external APIs. No secrets. Safe strings for HTML/PHP.
"""

from __future__ import annotations

import html
import re
from typing import TypedDict

TITLE_MIN = 45
TITLE_MAX = 65
TITLE_HARD_MAX = 70

DESCRIPTION_MIN = 120
DESCRIPTION_MAX = 160
DESCRIPTION_HARD_MAX = 170


class LengthValidation(TypedDict):
    ok: bool
    length: int
    message: str


def count_chars(text: str) -> int:
    """Count characters (Unicode code points), stripped."""
    return len(text.strip())


def normalize_snippet_text(text: str) -> str:
    """Collapse whitespace, strip edges, remove control chars."""
    cleaned = re.sub(r"[\x00-\x08\x0b\x0c\x0e-\x1f]", "", text)
    cleaned = re.sub(r"\s+", " ", cleaned).strip()
    return cleaned


def validate_title_length(
    title: str,
    *,
    min_len: int = TITLE_MIN,
    max_len: int = TITLE_MAX,
    hard_max: int = TITLE_HARD_MAX,
) -> LengthValidation:
    """Validate SEO title length."""
    text = normalize_snippet_text(title)
    length = count_chars(text)
    if not text:
        return {"ok": False, "length": 0, "message": "Title пустой"}
    if length > hard_max:
        return {
            "ok": False,
            "length": length,
            "message": f"Title слишком длинный ({length} > {hard_max})",
        }
    if length < min_len:
        return {
            "ok": False,
            "length": length,
            "message": f"Title короткий ({length} < {min_len})",
        }
    if length > max_len:
        return {
            "ok": True,
            "length": length,
            "message": f"Title чуть длиннее цели ({length} > {max_len}), допустимо до {hard_max}",
        }
    return {"ok": True, "length": length, "message": "OK"}


def validate_description_length(
    description: str,
    *,
    min_len: int = DESCRIPTION_MIN,
    max_len: int = DESCRIPTION_MAX,
    hard_max: int = DESCRIPTION_HARD_MAX,
) -> LengthValidation:
    """Validate meta description length."""
    text = normalize_snippet_text(description)
    length = count_chars(text)
    if not text:
        return {"ok": False, "length": 0, "message": "Description пустой"}
    if length > hard_max:
        return {
            "ok": False,
            "length": length,
            "message": f"Description слишком длинный ({length} > {hard_max})",
        }
    if length < min_len:
        return {
            "ok": False,
            "length": length,
            "message": f"Description короткий ({length} < {min_len})",
        }
    if length > max_len:
        return {
            "ok": True,
            "length": length,
            "message": f"Description чуть длиннее цели ({length} > {max_len}), допустимо до {hard_max}",
        }
    return {"ok": True, "length": length, "message": "OK"}


def build_meta_tags(
    *,
    title: str,
    description: str,
    og_url: str = "",
    og_type: str = "article",
    include_og_image: bool = False,
    og_image_url: str = "",
) -> str:
    """Return safe HTML meta tags for wp_head (escaped)."""
    t = normalize_snippet_text(title)
    d = normalize_snippet_text(description)
    lines = [
        f'<meta name="description" content="{html.escape(d, quote=True)}" />',
        f'<meta property="og:title" content="{html.escape(t, quote=True)}" />',
        f'<meta property="og:description" content="{html.escape(d, quote=True)}" />',
    ]
    if og_url:
        lines.append(
            f'<meta property="og:url" content="{html.escape(og_url, quote=True)}" />'
        )
    lines.append(
        f'<meta property="og:type" content="{html.escape(og_type, quote=True)}" />'
    )
    if include_og_image and og_image_url:
        lines.append(
            f'<meta property="og:image" content="{html.escape(og_image_url, quote=True)}" />'
        )
    return "\n".join(lines)


if __name__ == "__main__":
    sample_title = "AI-агент для amoCRM: внедрение и настройка под ключ"
    sample_desc = (
        "Как внедрить AI-агента в amoCRM: этапы, интеграции и типовые ошибки. "
        "Практический гайд для отдела продаж — без лишней теории."
    )
    print("Title:", validate_title_length(sample_title))
    print("Description:", validate_description_length(sample_desc))
    print(build_meta_tags(title=sample_title, description=sample_desc, og_url="https://example.com/slug/"))

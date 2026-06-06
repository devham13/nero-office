#!/usr/bin/env python3
"""Internal linking helpers for Nero Network pipeline.

Stdlib only. Read-only recommendations — does not modify files.
"""

from __future__ import annotations

import re
import sys
from dataclasses import dataclass
from pathlib import Path
from typing import Iterable
from urllib.parse import urlparse

sys.path.insert(0, str(Path(__file__).resolve().parent))

from credentials import get_credential  # noqa: E402

LEDGER = Path(__file__).resolve().parent / "kirill-news-ledger.md"
PUBLISHED = Path(__file__).resolve().parent / "published-pages.md"
WORDPRESS_PAGES = Path(__file__).resolve().parents[1] / "wordpress"

FORBIDDEN_PATH_FRAGMENTS = (
    "/wp-admin",
    "/wp-login.php",
    "?s=",
    "/search",
    "/feed",
    "/tag/",
    "/author/",
)

STOP_WORDS = {
    "для", "как", "что", "это", "при", "или", "без", "над", "под", "все", "ещё", "еще",
    "the", "and", "for", "with", "from", "your", "business", "бизнес", "услуга", "услуги",
}


@dataclass(frozen=True)
class PublishedPage:
    slug: str
    url: str
    title: str
    topic: str = ""


@dataclass(frozen=True)
class LinkSuggestion:
    url: str
    anchor: str
    placement: str
    reason: str
    score: float


def _site_origin() -> str:
    raw = get_credential("PUBLIC_SITE_URL") or get_credential("WP_SITE_URL") or ""
    parsed = urlparse(raw.strip())
    if parsed.scheme and parsed.netloc:
        return f"{parsed.scheme}://{parsed.netloc}"
    return ""


def _normalize_url(url: str) -> str:
    url = url.strip()
    if url.startswith("[REDACTED]"):
        origin = _site_origin()
        if origin:
            return origin.rstrip("/") + "/" + url.removeprefix("[REDACTED]").lstrip("/")
    if url.startswith("/") and _site_origin():
        return _site_origin().rstrip("/") + url
    if not url.endswith("/"):
        url += "/"
    return url


def _extract_slug(url: str) -> str:
    path = urlparse(url).path.strip("/")
    return path.split("/")[-1] if path else ""


def _tokenize(text: str) -> set[str]:
    tokens = re.findall(r"[a-zа-яё0-9]{3,}", text.lower())
    return {t for t in tokens if t not in STOP_WORDS}


def parse_published_pages(
    published_path: Path | None = None,
    ledger_path: Path | None = None,
) -> list[PublishedPage]:
    """Parse published pages from markdown journals."""
    published_path = published_path or PUBLISHED
    ledger_path = ledger_path or LEDGER
    pages: dict[str, PublishedPage] = {}

    if published_path.exists():
        for line in published_path.read_text(encoding="utf-8").splitlines():
            if not line.startswith("|") or "---" in line or "Slug" in line:
                continue
            cols = [c.strip() for c in line.strip("|").split("|")]
            if len(cols) < 4:
                continue
            slug, url, title = cols[1], _normalize_url(cols[2]), cols[3]
            if slug and url.startswith("http"):
                pages[slug] = PublishedPage(slug=slug, url=url, title=title)

    if ledger_path.exists():
        for line in ledger_path.read_text(encoding="utf-8").splitlines():
            if not line.startswith("|") or "---" in line or "Статус" in line:
                continue
            cols = [c.strip() for c in line.strip("|").split("|")]
            if len(cols) < 6:
                continue
            status, topic, url, slug = cols[1], cols[2], cols[3], cols[4]
            if status != "published":
                continue
            url = _normalize_url(url)
            if not url.startswith("http"):
                continue
            pages[slug] = PublishedPage(slug=slug, url=url, title=topic, topic=topic)

    # Local wordpress templates as fallback titles
    if WORDPRESS_PAGES.exists():
        for php in WORDPRESS_PAGES.glob("page-*.php"):
            slug = php.stem.removeprefix("page-")
            if slug in pages:
                continue
            origin = _site_origin()
            if origin:
                pages[slug] = PublishedPage(
                    slug=slug,
                    url=f"{origin}/{slug}/",
                    title=slug.replace("-", " "),
                )

    return sorted(pages.values(), key=lambda p: p.slug)


def validate_internal_url(url: str, allowed: Iterable[PublishedPage] | None = None) -> tuple[bool, str]:
    """Validate URL is internal and published."""
    normalized = _normalize_url(url)
    parsed = urlparse(normalized)
    if parsed.scheme not in ("http", "https"):
        return False, "not http(s)"
    origin = _site_origin()
    if origin and not normalized.startswith(origin):
        return False, "external host"
    lower = normalized.lower()
    for frag in FORBIDDEN_PATH_FRAGMENTS:
        if frag in lower:
            return False, f"forbidden path: {frag}"
    if allowed is not None:
        slugs = {_extract_slug(p.url) for p in allowed}
        if _extract_slug(normalized) not in slugs:
            return False, "not in published list"
    return True, "ok"


def score_relevance(
    new_topic: str,
    new_keywords: Iterable[str],
    candidate: PublishedPage,
) -> float:
    """Score 0..1 relevance between new page and candidate."""
    topic_tokens = _tokenize(new_topic)
    keyword_tokens = set()
    for kw in new_keywords:
        keyword_tokens |= _tokenize(kw)

    candidate_text = " ".join([candidate.title, candidate.topic, candidate.slug.replace("-", " ")])
    candidate_tokens = _tokenize(candidate_text)

    if not topic_tokens and not keyword_tokens:
        return 0.0
    if not candidate_tokens:
        return 0.0

    query = topic_tokens | keyword_tokens
    overlap = len(query & candidate_tokens)
    if overlap == 0:
        return 0.0

    # Jaccard-like score with bias toward keyword overlap
    union = len(query | candidate_tokens)
    return min(1.0, overlap / max(union, 1) + 0.1 * overlap)


def suggest_internal_links(
    new_topic: str,
    new_slug: str,
    new_keywords: Iterable[str] | None = None,
    min_links: int = 3,
    max_links: int = 7,
    min_score: float = 0.08,
) -> list[LinkSuggestion]:
    """Suggest outgoing internal links from new page to published pages."""
    pages = parse_published_pages()
    pages = [p for p in pages if p.slug != new_slug]
    keywords = list(new_keywords or [])

    scored: list[LinkSuggestion] = []
    for page in pages:
        score = score_relevance(new_topic, keywords, page)
        if score < min_score:
            continue
        ok, _ = validate_internal_url(page.url, pages)
        if not ok:
            continue
        anchor = _suggest_anchor(page, new_topic)
        scored.append(
            LinkSuggestion(
                url=page.url,
                anchor=anchor,
                placement="релевантный абзац в теле лонгрида (не hero)",
                reason=f"смысловое пересечение по теме «{page.title[:60]}»",
                score=score,
            )
        )

    scored.sort(key=lambda s: s.score, reverse=True)
    unique: list[LinkSuggestion] = []
    seen_urls: set[str] = set()
    seen_anchors: set[str] = set()
    for item in scored:
        if item.url in seen_urls:
            continue
        anchor_key = item.anchor.lower()
        if anchor_key in seen_anchors:
            continue
        seen_urls.add(item.url)
        seen_anchors.add(anchor_key)
        unique.append(item)
        if len(unique) >= max_links:
            break

    return unique[:max(max_links, min_links)] if len(unique) >= min_links else unique


def suggest_incoming_links(
    new_topic: str,
    new_url: str,
    new_slug: str,
    new_keywords: Iterable[str] | None = None,
    max_links: int = 5,
) -> list[LinkSuggestion]:
    """Suggest pages that should link TO the new page (recommendations only)."""
    pages = parse_published_pages()
    pages = [p for p in pages if p.slug != new_slug]
    keywords = list(new_keywords or [])

    fake_new = PublishedPage(slug=new_slug, url=new_url, title=new_topic, topic=new_topic)
    scored: list[LinkSuggestion] = []
    for page in pages:
        score = score_relevance(page.topic or page.title, keywords, fake_new)
        if score < 0.1:
            continue
        scored.append(
            LinkSuggestion(
                url=page.url,
                anchor=_suggest_anchor(fake_new, page.title),
                placement=f"абзац на странице {page.slug} про смежную тему",
                reason=f"обратная перелинковка: со страницы «{page.title[:50]}» на новую",
                score=score,
            )
        )
    scored.sort(key=lambda s: s.score, reverse=True)
    return scored[:max_links]


def _suggest_anchor(page: PublishedPage, context: str) -> str:
    title = page.title.strip()
    if len(title) <= 80:
        return title
    words = title.split()
    return " ".join(words[:8]) + "…"


if __name__ == "__main__":
    import argparse
    import json

    parser = argparse.ArgumentParser(description="Suggest internal links")
    parser.add_argument("--topic", required=True)
    parser.add_argument("--slug", required=True)
    parser.add_argument("--keyword", action="append", default=[])
    args = parser.parse_args()

    outgoing = suggest_internal_links(args.topic, args.slug, args.keyword)
    origin = _site_origin() or "https://example.invalid"
    incoming = suggest_incoming_links(
        args.topic, f"{origin.rstrip('/')}/{args.slug}/", args.slug, args.keyword
    )
    print(
        json.dumps(
            {
                "outgoing": [s.__dict__ for s in outgoing],
                "incoming": [s.__dict__ for s in incoming],
            },
            ensure_ascii=False,
            indent=2,
        )
    )

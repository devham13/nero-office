#!/usr/bin/env python3
"""Content humanizer analysis utilities for Nero Network pipeline.

Stdlib only. Read-only text analysis. No external APIs. No secrets.
"""

from __future__ import annotations

import re
from collections import Counter
from typing import Iterable

BANNED_PHRASES: tuple[str, ...] = (
    "в современном мире",
    "на сегодняшний день",
    "в условиях быстро меняющегося рынка",
    "является важным инструментом",
    "может помочь",
    "комплексный подход",
    "индивидуальные решения",
    "повышение эффективности",
    "уникальное предложение",
    "гарантируем",
    "гарантирован",
    "100%",
)

WEAK_CTA_PATTERNS: tuple[str, ...] = (
    r"\bузнать больше\b",
    r"\bподробнее\b",
    r"\bчитать далее\b",
    r"\bнажмите здесь\b",
    r"\bclick here\b",
)

RISKY_CLAIM_PATTERNS: tuple[str, ...] = (
    r"\b100\s*%",
    r"\bгарантир",
    r"\bточно\s+(получите|увелич)",
    r"\bвсегда\s+работает\b",
)


def detect_banned_phrases(text: str) -> list[str]:
    """Return banned phrases found in text (case-insensitive)."""
    lower = text.lower()
    return [p for p in BANNED_PHRASES if p in lower]


def detect_repeated_starts(text: str, *, min_words: int = 3, min_count: int = 3) -> list[str]:
    """Find sentence/paragraph starts repeated too often."""
    paragraphs = [p.strip() for p in re.split(r"\n\s*\n", text) if p.strip()]
    starts: list[str] = []
    for p in paragraphs:
        words = re.findall(r"\w+", p.lower())
        if len(words) >= min_words:
            starts.append(" ".join(words[:min_words]))
    counts = Counter(starts)
    return [s for s, c in counts.items() if c >= min_count]


def detect_weak_cta(text: str) -> list[str]:
    """Find weak CTA-like phrases."""
    found: list[str] = []
    lower = text.lower()
    for pattern in WEAK_CTA_PATTERNS:
        if re.search(pattern, lower, re.IGNORECASE):
            found.append(pattern.strip(r"\b"))
    return found


def detect_risky_claims(text: str) -> list[str]:
    """Find potentially unverified guarantee language."""
    found: list[str] = []
    for pattern in RISKY_CLAIM_PATTERNS:
        m = re.search(pattern, text, re.IGNORECASE)
        if m:
            found.append(m.group(0))
    return found


def generate_humanizer_report(text: str) -> str:
    """Generate markdown diagnostic report for humanizer agent."""
    banned = detect_banned_phrases(text)
    repeats = detect_repeated_starts(text)
    weak_cta = detect_weak_cta(text)
    risky = detect_risky_claims(text)

    lines = [
        "## Humanizer diagnostics",
        "",
        "### Banned phrases",
    ]
    lines.extend(f"- {b}" for b in banned) if banned else lines.append("- (нет)")
    lines.extend(["", "### Repeated starts"])
    lines.extend(f"- «{r}…»" for r in repeats) if repeats else lines.append("- (нет)")
    lines.extend(["", "### Weak CTA"])
    lines.extend(f"- {w}" for w in weak_cta) if weak_cta else lines.append("- (нет)")
    lines.extend(["", "### Risky claims"])
    lines.extend(f"- {r}" for r in risky) if risky else lines.append("- (нет)")
    return "\n".join(lines) + "\n"


if __name__ == "__main__":
    sample = (
        "В современном мире AI может помочь бизнесу. "
        "В современном мире важна автоматизация. "
        "Узнать больше — наша кнопка. Мы гарантируем 100% рост."
    )
    print(generate_humanizer_report(sample))

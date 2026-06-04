#!/usr/bin/env python3
"""Validate page-{slug}.php before publish (hero markup pitfalls)."""

from __future__ import annotations

import argparse
import re
import sys
from pathlib import Path


ROOT = Path(__file__).resolve().parents[1]


def validate(path: Path) -> list[str]:
    text = path.read_text(encoding="utf-8")
    errors: list[str] = []

    if re.search(r"<style>\s*<style>", text, re.I):
        errors.append("duplicate opening <style> tag (breaks hero CSS on live)")

    open_styles = len(re.findall(r"<style\b", text, re.I))
    close_styles = len(re.findall(r"</style>", text, re.I))
    if open_styles != close_styles:
        errors.append(f"unbalanced <style> tags: {open_styles} open vs {close_styles} close")

    if 'id="primary"' not in text and "id='primary'" not in text:
        errors.append("missing main#primary (skip-link target)")

    if "nero-ai-longread-bootstrap.php" not in text:
        errors.append("missing nero-ai-longread-bootstrap.php require before get_header()")

    if "nero-ai-longread-hero-shell.php" not in text:
        errors.append("missing nero-ai-longread-hero-shell.php hero partial")

    if "$nero_header_nav_links" not in text:
        errors.append("missing $nero_header_nav_links (page-specific menu)")

    if re.search(r"<canvas[^>]+vibe-factory|vibecoding-engine", text, re.I):
        errors.append("legacy canvas in hero area — use homepage hero shell without canvas")

    style_blocks = re.findall(r"<style[^>]*>(.*?)</style>", text, re.I | re.S)
    if style_blocks:
        first_style = style_blocks[0]
        head = first_style[:900]
        if not re.search(r"padding-top\s*:\s*0", head, re.I):
            errors.append(
                "first <style> block: move #primary padding reset immediately after opening <style>"
            )
        if (
            "nero-ai-hero-grid" not in first_style
            and "nero-ai-longread-hero-shell" in text
        ):
            errors.append("first <style> block: missing .nero-ai-hero-grid fallback for homepage hero")
        if re.search(r"\.nero-ai-home-page[^{]*\{[^}]*overflow-x\s*:\s*hidden", text, re.I | re.S):
            errors.append(
                "overflow-x:hidden on .nero-ai-home-page causes double scroll (use overflow:visible + shared ui-compat)"
            )

    return errors


def main() -> int:
    parser = argparse.ArgumentParser(description="Validate Nero longread page template.")
    parser.add_argument("path", type=Path, help="path to page-{slug}.php")
    args = parser.parse_args()

    path = args.path if args.path.is_absolute() else ROOT / args.path
    if not path.is_file():
        print(f"FAIL: file not found: {path}", file=sys.stderr)
        return 1

    errors = validate(path)
    if errors:
        print(f"FAIL {path.relative_to(ROOT) if path.is_relative_to(ROOT) else path}:")
        for err in errors:
            print(f"  - {err}")
        return 1

    print(f"OK {path.relative_to(ROOT) if path.is_relative_to(ROOT) else path}")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())

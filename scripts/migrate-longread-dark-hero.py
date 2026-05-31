#!/usr/bin/env python3
"""Migrate longread page templates from light fullscreen-white hero to dark nero-ai-hero."""

from __future__ import annotations

import re
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]

DARK_HERO_CSS = """
/* Neurinix dark page hero (canvas in dashboard shell) */
.nero-ai-page-hero {
  padding: clamp(40px, 7vw, 88px) 0 clamp(48px, 8vw, 96px);
  min-height: min(92vh, 920px);
}
.nero-ai-hero-canvas-host .nero-ai-window-body {
  position: relative;
  min-height: clamp(320px, 42vw, 460px);
  padding: 12px;
  overflow: hidden;
}
.nero-ai-hero-canvas-wrap {
  position: absolute;
  inset: 12px;
  border-radius: 16px;
  overflow: hidden;
  background: linear-gradient(145deg, rgba(8, 12, 24, 0.95), rgba(17, 24, 39, 0.92));
  border: 1px solid rgba(121, 242, 255, 0.12);
}
.nero-ai-hero-canvas-wrap canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.nero-ai-hero-stage-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 12px;
}
.nero-ai-hero-stage-chips .nero-ai-badge { font-size: 11px; padding: 6px 10px; }
"""

REMOVE_CSS = re.compile(
    r"/\* Hero Алины: не затемнять.*?\n\}\n\n",
    re.DOTALL,
)

REMOVE_LQ_CSS = re.compile(
    r"\.nero-ai-home-page \.fullscreen-white-office\.ai-intake-hero,\n.*?\n\}\n\n",
    re.DOTALL,
)

REMOVE_LQ_BLOCK = re.compile(
    r"#lead-qualify-hero\.lq-hero\.fullscreen-white-office \{[^}]+\}\n",
    re.DOTALL,
)

HERO_SECTION = re.compile(
    r"<section[^>]*(?:ai-intake-hero|lead-qualify-hero|lq-hero)[^>]*>.*?</section>\s*",
    re.DOTALL | re.IGNORECASE,
)


def strip_tags(html: str) -> str:
    return re.sub(r"<[^>]+>", "", html).strip()


def extract_hero_fields(hero_html: str) -> dict:
    section_m = re.search(r"<section([^>]*)>", hero_html, re.I)
    attrs = section_m.group(1) if section_m else ""
    sid = re.search(r'id="([^"]+)"', attrs)
    aria = re.search(r'aria-label="([^"]*)"', attrs)

    h1_m = re.search(r"<h1[^>]*class=\"giant-seo\"[^>]*>(.*?)</h1>", hero_html, re.DOTALL | re.I)
    h1_inner = h1_m.group(1).strip() if h1_m else "AI-внедрение для бизнеса"
    # Wrap trailing span content in gradient if plain span exists
    if "<span" in h1_inner and "nero-ai-gradient-text" not in h1_inner:
        h1_inner = re.sub(
            r"<span([^>]*)>",
            r'<span class="nero-ai-gradient-text"\1>',
            h1_inner,
            count=1,
        )

    sub_m = re.search(
        r"<p[^>]*class=\"(?:giant-seo-sub|ai-intake-sub|lq-sub)\"[^>]*>(.*?)</p>",
        hero_html,
        re.DOTALL | re.I,
    )
    sub = strip_tags(sub_m.group(1)) if sub_m else ""

    cta_m = re.search(
        r'<a[^>]*class="[^"]*telegram-button[^"]*"[^>]*href="([^"]*)"[^>]*>(.*?)</a>',
        hero_html,
        re.DOTALL | re.I,
    )
    cta_href = cta_m.group(1) if cta_m else "#audit"
    cta_label = strip_tags(cta_m.group(2)) if cta_m else "Обсудить внедрение"

    canvas_m = re.search(r'<canvas[^>]*id="([^"]+)"', hero_html, re.I)
    canvas_id = canvas_m.group(1) if canvas_m else "hero-canvas"

    badges = []
    for task in re.finditer(r'<div class="vl-ui-task"[^>]*>.*?<span>\d+</span>\s*(.*?)</div>', hero_html, re.DOTALL):
        label = strip_tags(task.group(1))
        if label:
            badges.append(label)
    for pill in re.finditer(r"<span>([^<]+)</span>", hero_html):
        t = pill.group(1).strip()
        if t and len(t) < 40 and t not in badges and not t.isdigit():
            if any(x in t for x in ("сек", "24/7", "CRM", "лид", "MQL", "SQL", "скоринг")):
                badges.append(t)

    return {
        "id": sid.group(1) if sid else "page-hero",
        "aria": aria.group(1) if aria else "Hero",
        "h1_inner": h1_inner,
        "sub": sub,
        "cta_href": cta_href,
        "cta_label": cta_label.replace("→", "").strip() or "Обсудить внедрение",
        "canvas_id": canvas_id,
        "badges": badges[:8],
    }


def build_dark_hero(data: dict) -> str:
    badges_html = ""
    if data["badges"]:
        items = "".join(f'<li class="nero-ai-badge">{b}</li>' for b in data["badges"])
        badges_html = f'<ul class="nero-ai-badges nero-ai-hero-stage-chips" aria-label="Этапы сценария">{items}</ul>'

    return f'''<section id="{data["id"]}" class="nero-ai-hero nero-ai-page-hero" aria-label="{data["aria"]}">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow">Meta Journal · внедрение AI</p>
      <h1 id="page-hero-title">{data["h1_inner"]}</h1>
      <p class="nero-ai-hero-lead">{data["sub"]}</p>
      {badges_html}
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="{data["cta_href"]}" target="_blank" rel="noopener noreferrer">{data["cta_label"]}</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Визуализация сценария">
      <div class="nero-ai-dashboard-shell nero-ai-hero-canvas-host">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">live-сценарий · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-hero-canvas-wrap" aria-hidden="true">
            <canvas id="{data["canvas_id"]}" width="1200" height="800"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

'''


def migrate(text: str) -> str:
    text = REMOVE_CSS.sub("", text)
    text = REMOVE_LQ_CSS.sub("", text)
    text = REMOVE_LQ_BLOCK.sub("", text)

    if DARK_HERO_CSS.strip() not in text:
        text = text.replace(
            "/* Intro после hero */",
            DARK_HERO_CSS + "\n/* Intro после hero */",
            1,
        )
        if "/* Intro после hero */" not in text:
            text = text.replace(
                ".ai-kvalifikaciya-intro-grid {",
                DARK_HERO_CSS + "\n.ai-kvalifikaciya-intro-grid {",
                1,
            )

    def replacer(m: re.Match[str]) -> str:
        return build_dark_hero(extract_hero_fields(m.group(0)))

    new_text, n = HERO_SECTION.subn(replacer, text, count=1)
    if n != 1:
        raise RuntimeError(f"Expected 1 hero section, replaced {n}")
    return new_text


def main(paths: list[str]) -> None:
    for p in paths:
        path = Path(p)
        original = path.read_text(encoding="utf-8")
        updated = migrate(original)
        path.write_text(updated, encoding="utf-8")
        print(f"OK {path} ({len(original)} -> {len(updated)} bytes)")


if __name__ == "__main__":
    targets = sys.argv[1:] or [
        str(ROOT / "wordpress/page-ai-obrabotka-zayavok-s-sayta.php"),
        str(ROOT / "wordpress/page-ai-kvalifikaciya-lidov.php"),
    ]
    main(targets)

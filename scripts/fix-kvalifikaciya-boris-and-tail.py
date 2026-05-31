#!/usr/bin/env python3
"""Fix Boris block layout and restore truncated kvalifikaciya page sections."""

from __future__ import annotations

import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
CURRENT = ROOT / "wordpress" / "page-ai-kvalifikaciya-lidov.php"
OLD = Path("/tmp/kval-old.php")
REF = ROOT / "wordpress" / "page-vnedrenie-ai-obrabotka-zayavok-s-sayta.php"

BORIS_HTML = """
<section
  id="ai-kvalifikaciya-lidov-boris-block"
  class="nero-ai-boris-block nero-ai-section nero-ai-section-alt nero-ai-reveal"
  aria-labelledby="boris-scoring-kicker"
>
  <div class="nero-ai-container">
    <div class="nero-ai-card nero-ai-boris-card">
      <div class="nero-ai-boris-grid">
        <div class="boris-copy">
          <span class="boris-eyebrow">Схема скоринга</span>
          <h3 id="boris-scoring-kicker" class="boris-kicker">Как заявка получает балл и статус до CRM</h3>
          <p class="boris-lead">Сигналы с формы, чата и поведения на сайте проходят через веса правил — на выходе один из четырёх статусов и порог передачи менеджеру.</p>
          <ul class="boris-points">
            <li><strong>Слой 1 — сигналы:</strong> бюджет, срок, роль, источник, повторные касания.</li>
            <li><strong>Слой 2 — скоринг:</strong> сумма весов и пороги «горячий / тёплый / холодный».</li>
            <li><strong>Слой 3 — маршрут:</strong> задача в CRM, эскалация или отсев нецелевого.</li>
          </ul>
          <div class="boris-pills" aria-hidden="true">
            <span class="boris-pill boris-pill--hot"><span class="boris-pill-dot"></span>Горячий ≥ 72</span>
            <span class="boris-pill boris-pill--warm"><span class="boris-pill-dot"></span>Тёплый 48–71</span>
            <span class="boris-pill boris-pill--cool"><span class="boris-pill-dot"></span>Холодный 25–47</span>
            <span class="boris-pill boris-pill--junk"><span class="boris-pill-dot"></span>Нецелевой &lt; 25</span>
          </div>
          <p class="boris-bridge">Дальше разберём, как задать пороги под вашу матрицу BANT / MEDDIC.</p>
        </div>
        <div class="boris-canvas-wrap" role="img" aria-label="Анимированная схема: сигналы лида проходят скоринг и распределяются по статусам">
          <canvas id="lead-scoring-matrix-canvas" width="640" height="480"></canvas>
          <p class="boris-canvas-caption">Демо-поток: веса правил, пороги статусов и маршрут в CRM</p>
        </div>
      </div>
    </div>
  </div>
{boris_script}
</section>
"""

PILL_CSS = """
.nero-ai-boris-block .boris-pill-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  flex-shrink: 0;
}
.nero-ai-boris-block .boris-pill--hot .boris-pill-dot { background: #ef4444; }
.nero-ai-boris-block .boris-pill--warm .boris-pill-dot { background: #f59e0b; }
.nero-ai-boris-block .boris-pill--cool .boris-pill-dot { background: #3b82f6; }
.nero-ai-boris-block .boris-pill--junk .boris-pill-dot { background: #94a3b8; }
"""


def main() -> None:
    current = CURRENT.read_text(encoding="utf-8")
    old = OLD.read_text(encoding="utf-8")
    ref = REF.read_text(encoding="utf-8")

    boris_start = old.find('<section id="ai-kvalifikaciya-lidov-boris-block"')
    next_sec = old.find('<section class="nero-ai-section', boris_start + 10)
    boris_chunk = old[boris_start:next_sec]
    script_m = re.search(r"<script>[\s\S]*?lead-scoring-matrix-canvas[\s\S]*?</script>", boris_chunk)
    boris_script = "\n" + (script_m.group(0) if script_m else "") + "\n"

    tail = old[next_sec : old.find("</div>\n\n<script>", next_sec)].strip()

    head_end = current.find('<section class="nero-ai-section nero-ai-section-tight')
    if head_end < 0:
        raise SystemExit("intro not found")
    head = current[:head_end]

    skoring_end = current.find('<section id="ai-kvalifikaciya-lidov-boris-block"')
    if skoring_end < 0:
        skoring_end = current.find("</main>")
    body = current[head_end:skoring_end].rstrip()

    footer_start = ref.find("</main>")
    footer = ref[footer_start:]

    out = head + body + "\n\n" + BORIS_HTML.format(boris_script=boris_script) + "\n\n" + tail + "\n\n" + footer

    css_path = ROOT / "shared" / "longread-page-design-reference.css"
    css = css_path.read_text(encoding="utf-8")
    if "boris-pill--hot" not in css:
        css = css.rstrip() + "\n" + PILL_CSS + "\n"
        css_path.write_text(css, encoding="utf-8")
        (ROOT / "wordpress" / "theme-includes" / "longread-page-design-reference.css").write_text(
            css, encoding="utf-8"
        )

    CURRENT.write_text(out, encoding="utf-8")
    theme_copy = ROOT / "wordpress-theme" / CURRENT.name
    theme_copy.parent.mkdir(exist_ok=True)
    theme_copy.write_text(out, encoding="utf-8")
    print(f"Fixed {CURRENT} ({len(out)} bytes)")


if __name__ == "__main__":
    main()

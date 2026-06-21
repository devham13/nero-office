#!/usr/bin/env python3
"""Assemble Natasha HTML for vnedrenie-ai-kontakt-centr."""
from __future__ import annotations

import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
HANDOFF = ROOT / ".cursor" / "nero-network-handoff.md"
AMOCRM = ROOT / "wordpress" / "page-vnedrenie-ai-amocrm.php"
REVEAL = ROOT / "shared" / "longread-page-reveal.js"

H2_IDS = {
    "Почему контакт-центры внедряют AI в 2026 году": "pochemu-2026",
    "Какие задачи решает AI для контакт-центра": "zadachi",
    "Внедрение AI в контакт-центр: этапы под ключ": "etapy",
    "Стоимость внедрения AI в контакт-центр": "stoimost",
    "AI контакт-центр под ключ или своими силами": "pod-klyuch",
    "Интеграция AI с телефонией, CRM и omnichannel": "integracii",
    "AI для контакт-центра по отраслям": "otrasli",
    "Кейсы и примеры внедрения AI в contact center": "keisy",
    "Риски, 152-ФЗ и качество ответов бота": "riski",
    "FAQ — частые вопросы о внедрении AI в контакт-центр": "faq",
    "Заказать внедрение AI для контакт-центра": "zakazat",
}

ALT_SECTIONS = {"pochemu-2026", "zadachi", "stoimost", "keisy", "faq"}


def extract_css() -> str:
    text = AMOCRM.read_text(encoding="utf-8")
    start = text.index("<style>") + len("<style>")
    end = text.index("</style>", start)
    css = text[start:end].lstrip("\n")
    extra = """
/* Hero vnkc — full viewport */
.vnkc-hero-cc{min-height:100vh;min-height:100dvh;position:relative;}
.vnedrenie-ai-kontakt-centr-page .ym-cta-block--secondary{
  background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;
}
.vnedrenie-ai-kontakt-centr-page .ym-link--accent{color:var(--vna-accent)!important;text-decoration:underline;}
.vna-prose{max-width:860px;margin:0 auto;}
.vna-prose h3{font-size:19px;margin:28px 0 12px;}
.vna-prose p{margin-bottom:1em;}
.vna-prose em{color:var(--vna-soft);font-style:normal;}
.vna-quote{
  border-left:3px solid var(--vna-violet);padding:12px 18px;margin:20px 0;
  background:rgba(139,92,246,.08);border-radius:0 12px 12px 0;font-size:14px;color:var(--vna-soft);
}
.vna-ol{counter-reset:vnkc;padding-left:0;list-style:none;margin:0 0 1em;}
.vna-ol li{
  counter-increment:vnkc;padding-left:28px;position:relative;margin-bottom:.5em;
  color:var(--vna-muted);font-size:14.5px;line-height:1.65;
}
.vna-ol li::before{
  content:counter(vnkc);position:absolute;left:0;top:0;
  width:20px;height:20px;border-radius:50%;background:rgba(121,242,255,.15);
  color:var(--vna-accent);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;
}
"""
    return css + extra


def extract_fragment(start_marker: str, end_line: str) -> str:
    lines = HANDOFF.read_text(encoding="utf-8").splitlines()
    start = next(i for i, l in enumerate(lines) if l.startswith(start_marker))
    end = next(
        i
        for i, l in enumerate(lines)
        if i > start + 50 and l.strip() == end_line
    )
    return "\n".join(lines[start : end + 1])


def inline_md(text: str) -> str:
    text = re.sub(
        r"\[([^\]]+)\]\(([^)]+)\)",
        r'<a href="\2" target="_blank" rel="noopener noreferrer">\1</a>',
        text,
    )
    text = re.sub(r"\*\*([^*]+)\*\*", r"<strong>\1</strong>", text)
    text = re.sub(r"\*([^*]+)\*", r"<em>\1</em>", text)
    return text


def md_table_to_html(block: str) -> str:
    rows = [r.strip() for r in block.strip().split("\n") if r.strip()]
    if len(rows) < 2:
        return f"<p>{inline_md(block)}</p>"
    cls = "vna-compare" if "Плюсы" in rows[0] or "Подход" in rows[0] else "vna-table"
    wrap_cls = "vna-compare-wrap" if cls == "vna-compare" else "vna-table-wrap"
    html = [f'<div class="{wrap_cls}"><table class="{cls}">']
    for i, row in enumerate(rows):
        if re.match(r"^\|[-: |]+\|$", row):
            continue
        cells = [c.strip() for c in row.strip("|").split("|")]
        tag = "th" if i == 0 else "td"
        html.append("<tr>" + "".join(f"<{tag}>{inline_md(c)}</{tag}>" for c in cells) + "</tr>")
    html.append("</table></div>")
    return "\n".join(html)


def block_to_html(block: str) -> str:
    block = block.strip()
    if not block:
        return ""
    if block.startswith("|"):
        return md_table_to_html(block)
    if block.startswith("1.") or re.match(r"^\d+\.", block):
        items = re.split(r"\n(?=\d+\.)", block)
        lis = "".join(f"<li>{inline_md(re.sub(r'^\\d+\\.\\s*', '', it.strip()))}</li>" for it in items if it.strip())
        return f'<ol class="vna-ol">{lis}</ol>'
    if block.startswith("- "):
        items = [ln[2:].strip() for ln in block.split("\n") if ln.startswith("- ")]
        lis = "".join(f"<li>{inline_md(it)}</li>" for it in items)
        return f"<ul>{lis}</ul>"
    if block.startswith("**Итог"):
        return f'<p class="vna-card nero-ai-reveal" style="padding:18px 22px;margin-top:20px;"><em>{inline_md(block)}</em></p>'
    if block.startswith("*Якорь"):
        return ""
    if block.startswith("---"):
        return ""
    if block.startswith("**Итог:**") or block.startswith("**Коротко:**"):
        return f"<p>{inline_md(block)}</p>"
    return f"<p>{inline_md(block)}</p>"


def parse_zhenya() -> tuple[str, dict[str, str]]:
    handoff = HANDOFF.read_text(encoding="utf-8")
    m = re.search(
        r"### Полный текст.*?\n\n(.*?)\n\n### GEO-чеклист",
        handoff,
        re.DOTALL,
    )
    md = m.group(1) if m else ""
    md = re.sub(r"^# .+\n\n", "", md)

    intro_parts = []
    sections: dict[str, str] = {}
    current_id = None
    current_blocks: list[str] = []

    def flush():
        nonlocal current_blocks, current_id
        if current_id:
            sections[current_id] = "\n".join(current_blocks)
        current_blocks = []

    for raw in re.split(r"\n(?=## )", md):
        raw = raw.strip()
        if not raw:
            continue
        if raw.startswith("## "):
            flush()
            title = raw.split("\n", 1)[0][3:].strip()
            current_id = H2_IDS.get(title)
            body = raw.split("\n", 1)[1] if "\n" in raw else ""
            current_blocks = [body] if body else []
        else:
            if current_id is None:
                intro_parts.append(raw)
            else:
                current_blocks.append(raw)

    flush()
    intro = "\n\n".join(intro_parts)
    return intro, sections


def render_section_body(body: str) -> str:
    parts = re.split(r"\n(?=### )", body)
    html_parts = []
    for part in parts:
        part = part.strip()
        if not part:
            continue
        if part.startswith("### "):
            lines = part.split("\n", 1)
            h3 = lines[0][4:].strip()
            rest = lines[1] if len(lines) > 1 else ""
            html_parts.append(f'<h3 id="{slugify(h3)}">{inline_md(h3)}</h3>')
            for blk in re.split(r"\n\n+", rest):
                b = blk.strip()
                if not b:
                    continue
                html_parts.append(block_to_html(b))
        else:
            for blk in re.split(r"\n\n+", part):
                b = blk.strip()
                if b:
                    html_parts.append(block_to_html(b))
    return "\n".join(html_parts)


def slugify(text: str) -> str:
    s = text.lower()[:40]
    s = re.sub(r"[^a-zа-яё0-9]+", "-", s, flags=re.I)
    return s.strip("-")


def cta_primary(id_: str, icon: str, headline: str, sub: str, dual: bool = False) -> str:
    dual_cls = " ym-cta-block--dual" if dual else ""
    actions = ""
    if dual:
        actions = """
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
    </div>"""
    else:
        actions = f"""
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>"""
    icon_html = f'  <div class="ym-cta-block__icon" aria-hidden="true">{icon}</div>\n' if icon else ""
    return f"""
<aside class="ym-cta-block ym-cta-block--primary{dual_cls}" id="{id_}">
{icon_html}  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">{headline}</p>
    <p class="ym-cta-block__sub">{sub}</p>{actions}
  </div>
</aside>"""


def cta_secondary() -> str:
    return """
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до пилота?</p>
    <p class="ym-cta-block__sub">Если супервизоры и IT хотят разобраться в n8n, промптах и human-in-the-loop до интеграции с телефонией — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'); ?></a>. Это ускоряет согласование пилота с руководством контакт-центра.</p>
  </div>
</aside>"""


def cta_footer() -> str:
    return """
<aside class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы снизить нагрузку на колл-центр?</p>
    <p class="ym-cta-block__sub">Маршрутизация, copilot оператору и автоответы под ключ — с интеграцией Voximplant, Mango, amoCRM, Bitrix24 и 1С. Первый шаг: бесплатный аудит нагрузки.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside>"""


def build_intro(intro_md: str) -> str:
  short = intro_md.split("\n\n")[0] if intro_md else ""
  rest = "\n\n".join(intro_md.split("\n\n")[1:]) if intro_md else ""
  p2 = rest.split("\n\n")[0] if rest else ""
  return f"""
  <section class="vna-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai контакт-центр</p>
          <p>{inline_md(short.replace('**Коротко:**', '').strip())}</p>
          <p>{inline_md(p2)}</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Бенчмарки контакт-центра">
          <div class="vna-kpi-card"><div class="kv">65%</div><div class="kl">обращений через ИИ</div><div class="ks">Сбер, 2026</div></div>
          <div class="vna-kpi-card"><div class="kv">70%</div><div class="kl">клиентов через conversational AI к 2028</div><div class="ks">Gartner / IBM</div></div>
          <div class="vna-kpi-card"><div class="kv">&gt;80%</div><div class="kl">FCR после замены IVR</div><div class="ks">Ростелеком КЦ</div></div>
          <div class="vna-kpi-card"><div class="kv">500К+</div><div class="kl">ориентир чека внедрения</div><div class="ks">пилот от 2 недель</div></div>
        </div>
      </div>
    </div>
  </section>"""


def build_toc() -> str:
    items = [
        ("#zadachi", "Задачи"),
        ("#etapy", "Этапы"),
        ("#stoimost", "Стоимость"),
        ("#keisy", "Кейсы"),
        ("#integracii", "Интеграции"),
        ("#faq", "FAQ"),
    ]
    links = "".join(f'<a href="{h}">{t}</a>' for h, t in items)
    return f"""
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc ym-toc" aria-label="Оглавление статьи">{links}</nav>
    </div>
  </div>"""


def section_html(sec_id: str, title: str, body_html: str, alt: bool = False) -> str:
    alt_cls = " vna-section-alt" if alt else ""
    eyebrow_map = {
        "pochemu-2026": "Тренды 2026",
        "zadachi": "Задачи AI",
        "etapy": "Под ключ",
        "stoimost": "Коммерция",
        "pod-klyuch": "Build vs Buy",
        "integracii": "Стек",
        "otrasli": "Отрасли",
        "keisy": "Кейсы",
        "riski": "Compliance",
        "faq": "Вопросы",
        "zakazat": "Оффер",
    }
    eb = eyebrow_map.get(sec_id, "AI контакт-центр")
    return f"""
  <section class="vna-section{alt_cls}" id="{sec_id}">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">{eb}</span>
        <h2>{inline_md(title)}</h2>
      </div>
      <div class="vna-prose nero-ai-reveal">
{body_html}
      </div>
    </div>
  </section>"""


def build_faq_section(body: str) -> str:
    parts = re.split(r"\n(?=### )", body)
    items = []
    for part in parts:
        part = part.strip()
        if not part.startswith("### "):
            continue
        lines = part.split("\n", 1)
        q = lines[0][4:].strip()
        a = inline_md(lines[1].strip()) if len(lines) > 1 else ""
        items.append(
            f'<div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0">{inline_md(q)}</div><div class="vna-faq-a"><p>{a}</p></div></div>'
        )
    faq_inner = "\n".join(items)
    return f"""
  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Вопросы</span>
        <h2>FAQ — частые вопросы о внедрении AI в контакт-центр</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">{faq_inner}</div>
    </div>
  </section>"""


def inject_cta_obuchenie(etapy_html: str) -> str:
    marker = '<h3 id="обучение-операторов-и-запуск-в-прод">'
    if marker not in etapy_html:
        return etapy_html + cta_secondary()
    idx = etapy_html.find(marker)
    end = etapy_html.find("</p>", etapy_html.find("<p>", idx)) + 4
    return etapy_html[:end] + cta_secondary() + etapy_html[end:]


def inject_internal_links(integracii_html: str) -> str:
    needle = "Связка с другими внедрениями Nero:"
    if needle in integracii_html:
        return integracii_html.replace(
            needle,
            "<!-- INTERNAL-LINKS:INSERT -->\n" + needle,
            1,
        )
    return "<!-- INTERNAL-LINKS:INSERT -->\n" + integracii_html


def main() -> None:
    hero = extract_fragment('<section class="nero-ai-hero vnkc-hero-cc"', "</section>")
    boris = extract_fragment(
        '<section id="vnedrenie-ai-kontakt-centr-boris-block"',
        "</section>",
    )
    intro_md, sections = parse_zhenya()
    css = extract_css()
    reveal_js = REVEAL.read_text(encoding="utf-8")

    titles = {v: k for k, v in H2_IDS.items()}

    content_parts = [build_intro(intro_md), build_toc()]

    order = [
        "pochemu-2026",
        "zadachi",
        "etapy",
        "stoimost",
        "pod-klyuch",
        "integracii",
        "otrasli",
        "keisy",
        "riski",
        "faq",
        "zakazat",
    ]

    for sec_id in order:
        body = sections.get(sec_id, "")
        if sec_id == "faq":
            content_parts.append(build_faq_section(body))
            continue
        if sec_id == "zadachi":
            body_html = render_section_body(body)
            content_parts.append(
                section_html(sec_id, titles[sec_id], body_html, sec_id in ALT_SECTIONS)
            )
            content_parts.append(boris)
            content_parts.append(
                '<div class="vna-cnt">'
                + cta_primary(
                    "cta-zadachi",
                    "📞",
                    "Узнайте, сколько обращений можно снять с операторов",
                    "Бесплатный аудит нагрузки контакт-центра: топ-20 интентов, карта deflection и прогноз ROI до старта проекта. Ориентир чека — 500 тыс.–4 млн ₽.",
                )
                + "</div>"
            )
            continue
        if sec_id == "etapy":
            body_html = inject_cta_obuchenie(render_section_body(body))
            content_parts.append(
                section_html(sec_id, titles[sec_id], body_html, sec_id in ALT_SECTIONS)
            )
            continue
        if sec_id == "stoimost":
            body_html = render_section_body(body)
            content_parts.append(
                section_html(sec_id, titles[sec_id], body_html, sec_id in ALT_SECTIONS)
            )
            content_parts.append(
                '<div class="vna-cnt">'
                + cta_primary(
                    "cta-stoimost",
                    "",
                    "Получите смету и прогноз ROI под ваш контакт-центр",
                    "На аудите нагрузки посчитаем deflection-потенциал, срок пилота (от 2 недель) и вилку бюджета 500 тыс.–4 млн ₽ — до подписания договора.",
                    dual=True,
                )
                + "</div>"
            )
            continue
        if sec_id == "integracii":
            body_html = inject_internal_links(render_section_body(body))
            content_parts.append(
                section_html(sec_id, titles[sec_id], body_html, sec_id in ALT_SECTIONS)
            )
            continue
        if sec_id == "zakazat":
            body_html = render_section_body(body)
            content_parts.append(
                section_html(sec_id, titles[sec_id], body_html, sec_id in ALT_SECTIONS)
            )
            content_parts.append('<div class="vna-cnt">' + cta_footer() + "</div>")
            continue

        body_html = render_section_body(body)
        content_parts.append(
            section_html(sec_id, titles[sec_id], body_html, sec_id in ALT_SECTIONS)
        )

    faq_script = """
<script>
document.querySelectorAll('.vna-faq-q').forEach(function(q){
  q.addEventListener('click',function(){q.parentElement.classList.toggle('open');});
  q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();q.parentElement.classList.toggle('open');}});
});
</script>"""

    page = f"""<style>
{css}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-kontakt-centr-page" role="main" tabindex="-1">

{hero}

<div class="vna-content">
{"".join(content_parts)}
</div>

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
{reveal_js}
</script>
{faq_script}
"""

    out = ROOT / ".cursor" / "nero-network-natasha-html.tmp"
    out.write_text(page, encoding="utf-8")
    print(f"Wrote {out} ({len(page)} chars)")

    # Update handoff
    handoff_text = HANDOFF.read_text(encoding="utf-8")
    natasha_block = f"""=== НАТАША (HTML СТРАНИЦЫ) ===
Статус: ✅ ГОТОВО
SLUG: vnedrenie-ai-kontakt-centr
ВНИМАНИЕ: контент содержит <script> и <canvas> — при публикации обернуть в <!-- wp:html -->

## Структура страницы (секции и якоря)

| id | Секция |
| --- | --- |
| hero | Hero (Алина, canvas vnkc-cc-hero-canvas) |
| intro | Введение после hero (лид + KPI) |
| pochemu-2026 | Почему контакт-центры внедряют AI в 2026 году |
| zadachi | Какие задачи решает AI для контакт-центра |
| vnedrenie-ai-kontakt-centr-boris-block | Блок Бориса (canvas bcc-contact-flow-canvas) |
| cta-zadachi | CTA аудит нагрузки |
| etapy | Этапы внедрения под ключ |
| cta-obuchenie | Вторичный CTA обучение |
| stoimost | Стоимость внедрения |
| cta-stoimost | CTA смета и ROI |
| pod-klyuch | Под ключ или своими силами |
| integracii | Интеграции (INTERNAL-LINKS:INSERT) |
| otrasli | По отраслям |
| keisy | Кейсы |
| riski | Риски и 152-ФЗ |
| faq | FAQ |
| zakazat | Заказать внедрение |
| cta-final | Финальный CTA |

**Меню шапки:** Задачи (#zadachi) · Этапы (#etapy) · Стоимость (#stoimost) · Кейсы (#keisy) · Интеграции (#integracii) · FAQ (#faq)

**Размер HTML:** {len(page)} символов

{page}

## Передача пайплайну
SLUG: vnedrenie-ai-kontakt-centr
JSON-LD готовит **schema-markup** после Наташи; оставлен `<!-- SCHEMA-MARKUP:INSERT -->` перед `</main>`.
Внутренние ссылки готовит **internal-linker**; оставлен `<!-- INTERNAL-LINKS:INSERT -->` в секции #integracii.
Контент содержит <script> (hero engine + boris engine + reveal + FAQ) и <canvas> (2 шт.).
ПАЙПЛАЙН: Наташа готов → следующий шаг: schema-markup
"""

    if "=== НАТАША (HTML СТРАНИЦЫ) ===" in handoff_text:
        handoff_text = re.sub(
            r"=== НАТАША \(HTML СТРАНИЦЫ\) ===.*",
            natasha_block.strip(),
            handoff_text,
            flags=re.DOTALL,
        )
    else:
        handoff_text = handoff_text.rstrip() + "\n\n" + natasha_block

    HANDOFF.write_text(handoff_text, encoding="utf-8")
    print("Updated handoff.md")


if __name__ == "__main__":
    main()

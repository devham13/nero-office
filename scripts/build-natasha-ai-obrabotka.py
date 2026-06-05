#!/usr/bin/env python3
"""Assemble Natasha HTML page for ai-obrabotka-zayavok-s-sayta."""
from __future__ import annotations

import os
import re
from pathlib import Path

ROOT = Path("/workspace")
HANDOFF = ROOT / ".cursor/nero-network-handoff.md"
ALINA = ROOT / ".cursor/nero-network-fragments/alina.md"
BORIS = ROOT / ".cursor/nero-network-fragments/boris.md"
CSS_REF = ROOT / "shared/longread-page-design-reference.css"
REVEAL_JS = ROOT / "shared/longread-page-reveal.js"
OUT_PHP = ROOT / "wordpress/page-ai-obrabotka-zayavok-s-sayta.php"
OUT_HTML = ROOT / ".cursor/nero-network-fragments/natasha-page.html"

SLUG = "ai-obrabotka-zayavok-s-sayta"
PAGE_CLASS = f"{SLUG}-page"
CONTENT_CLASS = f"{SLUG}-content"

PRIMARY_URL = "<?php echo esc_url($primary_cta_url); ?>"
PRIMARY_LABEL = "<?php echo esc_html($primary_cta_label); ?>"
SECONDARY_URL = "<?php echo esc_url($secondary_cta_url); ?>"
SECONDARY_LABEL = "<?php echo esc_html($secondary_cta_label); ?>"

SEO_TITLE = "AI-обработка заявок с сайта — внедрение агента под ключ"
SEO_DESC = (
    "Внедрим AI-агента для обработки заявок с сайта: ответ за 5–15 секунд, "
    "квалификация лида и передача в CRM. Под ключ для МСБ, услуг, школ и клиник. "
    "Аудит потерь заявок."
)

SECTION_IDS = {
    "Почему заявки с сайта остывают без быстрого ответа": "pochemu-zayavki-ostyvayut",
    "Что такое AI-обработка заявок с сайта": "chto-takoe-ai-obrabotka",
    "Как работает AI-агент на сайте: сценарий за 5–15 секунд": "kak-rabotaet-ai-agent",
    "Внедрение AI под ключ: этапы и сроки": "vnedrenie-ai-pod-klyuch",
    "Интеграция с CRM: amoCRM, Битрикс24 и вебхуки": "integraciya-crm",
    "Для кого подходит: МСБ, услуги, онлайн-школы и клиники": "dlya-kogo-podhodit",
    "Кейсы и примеры внедрения AI-агентов": "keisy-primery",
    "Стоимость внедрения и что входит в пакет": "stoimost-vnedreniya",
    "Риски: галлюцинации, ПДн и контроль качества": "riski-kontrol-kachestva",
    "FAQ по AI-обработке заявок": "faq-ai-obrabotka",
    "Проверить, сколько заявок вы теряете": "audit-cta",
}

TOC_ITEMS = [
    ("pochemu-zayavki-ostyvayut", "Почему заявки остывают"),
    ("chto-takoe-ai-obrabotka", "Что такое AI-обработка"),
    ("kak-rabotaet-ai-agent", "Сценарий за 5–15 секунд"),
    ("vnedrenie-ai-pod-klyuch", "Внедрение под ключ"),
    ("integraciya-crm", "Интеграция с CRM"),
    ("dlya-kogo-podhodit", "Для кого подходит"),
    ("keisy-primery", "Кейсы и примеры"),
    ("stoimost-vnedreniya", "Стоимость"),
    ("riski-kontrol-kachestva", "Риски и ПДн"),
    ("faq-ai-obrabotka", "FAQ"),
    ("audit-cta", "Аудит потерь заявок"),
]


def extract_html_block(path: Path, marker: str) -> str:
    text = path.read_text(encoding="utf-8")
    m = re.search(r"```html\n(.*?)```", text, re.DOTALL)
    if not m:
        raise RuntimeError(f"No html block in {path}")
    return m.group(1).strip()


def extract_artur_body() -> str:
    text = HANDOFF.read_text(encoding="utf-8")
    m = re.search(
        r"=== АРТУР \(CTA И РЕКЛАМА\) ===.*?### Полный текст\n(.*?)\n### Рекламные вставки",
        text,
        re.DOTALL,
    )
    if not m:
        raise RuntimeError("Artur body not found")
    body = m.group(1).strip()
    # drop duplicate H1 and intro lead (rendered in intro section)
    body = re.sub(r"^# .+\n\n", "", body, count=1)
    body = re.sub(
        r"^\*\*Коротко:\*\*.+?\n\n",
        "",
        body,
        count=1,
        flags=re.DOTALL,
    )
    return body


def inline_md(text: str) -> str:
    text = re.sub(r"\*\*(.+?)\*\*", r"<strong>\1</strong>", text)
    text = re.sub(r"`([^`]+)`", r"<code>\1</code>", text)
    return text


def md_table_to_html(lines: list[str]) -> str:
    rows = []
    for i, line in enumerate(lines):
        if not line.strip().startswith("|"):
            continue
        cells = [c.strip() for c in line.strip().strip("|").split("|")]
        if i == 1 and all(set(c) <= set("-: ") for c in cells):
            continue
        tag = "th" if i == 0 else "td"
        rows.append("<tr>" + "".join(f"<{tag}>{inline_md(c)}</{tag}>" for c in cells) + "</tr>")
    return '<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">' + "".join(rows) + "</table></div>"


def close_section(out: list[str]) -> None:
    if out and out[-1] != "</section>":
        out.append("</div></div></section>")


def parse_longread(md: str) -> str:
    lines = md.splitlines()
    out: list[str] = []
    i = 0
    section_alt = False
    open_section = False

    cta1 = f'''<aside class="nero-ai-inline-cta nero-ai-card nero-ai-reveal" aria-label="Аудит потерь заявок">
  <p class="nero-ai-eyebrow">Лид-магнит · 30 минут</p>
  <h3>Проверьте, сколько заявок вы теряете из-за медленного ответа</h3>
  <p>Замерим реальное время первого контакта по тестовым обращениям, разберём каналы (форма, чат, мессенджеры) и оценим готовность CRM к пилоту AI-агента на одном канале.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="{PRIMARY_URL}">{PRIMARY_LABEL}</a>
  </div>
</aside>'''

    cta2 = f'''<aside class="nero-ai-secondary-cta nero-ai-card nero-ai-reveal nero-ai-delay-1" aria-label="Материалы по внедрению AI">
  <p class="nero-ai-eyebrow">Для команды до старта проекта</p>
  <p>Если вы хотите сначала разобраться в архитектуре агента, RAG и интеграциях с CRM — посмотрите <a href="{SECONDARY_URL}" target="_blank" rel="noopener noreferrer">{SECONDARY_LABEL}</a>: практические материалы по внедрению AI-агентов и автоматизации без лишней теории.</p>
</aside>'''

    cta3 = f'''<div class="nero-ai-final-cta nero-ai-card nero-ai-reveal" id="audit-cta">
  <h2>Проверить, сколько заявок вы теряете</h2>
  <p>AI-обработка заявок под ключ начинается с диагностики: аудит потерь за 30 минут, пилот на одном канале, режим ассистента и автоответ за 5–15 секунд с передачей горячего лида в CRM.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="{PRIMARY_URL}">{PRIMARY_LABEL}</a>
    <a class="nero-ai-btn nero-ai-btn-secondary" href="{SECONDARY_URL}" target="_blank" rel="noopener noreferrer">{SECONDARY_LABEL}</a>
  </div>
</div>'''

    boris_block = extract_html_block(BORIS, "boris")

    while i < len(lines):
        line = lines[i]

        if line.startswith("<!-- ARТУР: CTA-1"):
            out.append(cta1)
            i += 1
            continue
        if line.startswith("<!-- ARТУР: CTA-2"):
            out.append(cta2)
            i += 1
            continue
        if line.startswith("<!-- ARТУР: CTA-3"):
            close_section(out)
            open_section = False
            out.append(cta3)
            i += 1
            continue

        if line.startswith("## "):
            title = line[3:].strip()

            if title.startswith("Как работает AI-агент"):
                close_section(out)
                open_section = False
                out.append(f'<div class="nero-ai-container">{boris_block}</div>')

            if open_section:
                close_section(out)

            sid = SECTION_IDS.get(title, re.sub(r"[^a-z0-9]+", "-", title.lower()).strip("-"))
            if title.startswith("Проверить, сколько заявок"):
                sid = "audit-cta-section"
            alt_class = " nero-ai-section-alt" if section_alt else ""
            section_alt = not section_alt
            out.append(
                f'<section class="nero-ai-section{alt_class}" id="{sid}">'
                f'<div class="nero-ai-container">'
                f'<div class="nero-ai-section-head nero-ai-left nero-ai-reveal">'
                f"<h2>{inline_md(title)}</h2>"
            )
            i += 1
            open_section = True
            if i < len(lines) and lines[i].startswith("**Коротко:**"):
                lead = inline_md(lines[i].replace("**Коротко:**", "").strip())
                out.append(f'<p class="nero-ai-section-lead">{lead}</p>')
                out.append("</div>")
                i += 1
            else:
                out.append("</div>")
            out.append('<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">')
            continue

        if line.startswith("### "):
            out.append(f"<h3>{inline_md(line[4:].strip())}</h3>")
            i += 1
            continue

        if line.startswith("|"):
            table_lines = []
            while i < len(lines) and lines[i].startswith("|"):
                table_lines.append(lines[i])
                i += 1
            out.append(md_table_to_html(table_lines))
            continue

        if re.match(r"^\d+\.\s", line):
            out.append("<ol>")
            while i < len(lines) and re.match(r"^\d+\.\s", lines[i]):
                out.append(f"<li>{inline_md(lines[i].split('. ', 1)[1])}</li>")
                i += 1
            out.append("</ol>")
            continue

        if line.startswith("- "):
            out.append("<ul>")
            while i < len(lines) and lines[i].startswith("- "):
                out.append(f"<li>{inline_md(lines[i][2:])}</li>")
                i += 1
            out.append("</ul>")
            continue

        if not line.strip():
            i += 1
            continue

        out.append(f"<p>{inline_md(line)}</p>")
        i += 1

    close_section(out)

    html = "\n".join(out)
    # FAQ as details
    html = re.sub(
        r"<h3>(Сколько времени занимает внедрение\?|Нужен ли отдельный разработчик\?|Можно ли подключить к существующей CRM\?|Можно ли обойтись без передачи ПДн в зарубежное облако\?|Чем AI-консультант на сайт отличается от обычного онлайн-чата\?)</h3>\s*<p>(.*?)</p>",
        r'<details class="nero-ai-faq-item"><summary>\1</summary><p>\2</p></details>',
        html,
        flags=re.DOTALL,
    )
    return html


def adapt_css() -> str:
    css = CSS_REF.read_text(encoding="utf-8")
    css = re.sub(r"/\*\*?\n \* Meta Journal.*?\*/\n", "", css, count=1, flags=re.DOTALL)
    css = css.replace("#primary.nero-ai-home-page,\n.nero-ai-home-page", f".{CONTENT_CLASS}.nero-ai-home-page")
    css = css.replace(".nero-ai-home-page ", f".{CONTENT_CLASS}.nero-ai-home-page ")
    extra = f"""
/* Hero-first template reset */
.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs, .yoast-breadcrumb,
.entry-header, .page-title-section {{ display: none !important; }}
#{SLUG}-primary, #primary, .site-main, .site-content, #content, .content-area {{
  padding-top: 0 !important;
  margin-top: 0 !important;
}}
.{PAGE_CLASS} {{ margin: 0; padding: 0; overflow-x: hidden; }}
#lead-dispatch-hero.fullscreen-white-office.ai-lead-hero {{
  position: relative;
  min-height: 100vh;
  min-height: 100dvh;
}}

/* Intro after hero */
.{SLUG}-intro {{
  padding: clamp(48px, 6vw, 72px) 0 clamp(28px, 4vw, 40px);
  background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 40%, #050711 85%);
}}
.{SLUG}-intro-grid {{
  display: grid;
  grid-template-columns: minmax(0, 1.15fr) minmax(280px, 0.85fr);
  gap: clamp(24px, 4vw, 40px);
  align-items: start;
}}
.{SLUG}-intro-copy {{
  text-align: left !important;
  border-left: 4px solid transparent;
  border-image: linear-gradient(180deg, #06b6d4, #8b5cf6) 1;
  padding-left: clamp(16px, 2.5vw, 24px);
}}
.{SLUG}-intro-copy p {{
  text-align: left !important;
  color: #0f172a;
  font-size: clamp(16px, 1.6vw, 18px);
  line-height: 1.65;
  margin: 0 0 14px;
}}
.{SLUG}-intro-terminal {{
  border-radius: 18px;
  border: 1px solid #e2e8f0;
  background: #0f172a;
  color: #e2e8f0;
  padding: 16px;
  box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
}}
.{SLUG}-intro-terminal-top {{
  display: flex; gap: 6px; margin-bottom: 12px;
}}
.{SLUG}-intro-terminal-top span {{
  width: 9px; height: 9px; border-radius: 50%; background: #64748b;
}}
.{SLUG}-intro-terminal-top span:nth-child(1) {{ background: #fb7185; }}
.{SLUG}-intro-terminal-top span:nth-child(2) {{ background: #fbbf24; }}
.{SLUG}-intro-terminal-top span:nth-child(3) {{ background: #34d399; }}
.{SLUG}-intro-terminal pre {{
  margin: 0; font: 12px/1.5 ui-monospace, monospace; white-space: pre-wrap;
}}
.{SLUG}-intro-chips {{
  display: flex; flex-wrap: wrap; gap: 8px; margin-top: 14px;
}}
.{SLUG}-intro-chip {{
  padding: 6px 12px; border-radius: 999px; font-size: 12px; font-weight: 700;
  background: rgba(6, 182, 212, 0.12); color: #0e7490; border: 1px solid rgba(6, 182, 212, 0.25);
}}
.{SLUG}-toc-wrap {{ text-align: center; padding: 8px 0 0; }}
.nero-ai-toc {{
  display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;
  margin: 24px auto 0; padding: 0; list-style: none; max-width: 980px;
}}
.nero-ai-toc a {{
  display: inline-flex; padding: 8px 14px; border-radius: 999px;
  border: 1px solid rgba(255,255,255,.14); color: #dce8f7 !important;
  text-decoration: none !important; font-size: 13px; font-weight: 700;
}}
.nero-ai-toc a:hover {{ border-color: rgba(121,242,255,.4); background: rgba(121,242,255,.08); }}
.nero-ai-prose {{ max-width: 820px; }}
.nero-ai-prose h3 {{ margin: 28px 0 12px; font-size: clamp(20px, 2.4vw, 24px); }}
.nero-ai-prose p, .nero-ai-prose li {{ font-size: 16px; line-height: 1.68; }}
.nero-ai-prose code {{
  padding: 2px 6px; border-radius: 6px; background: rgba(255,255,255,.08); color: #c7d2fe;
}}
.nero-ai-table-wrap {{ overflow-x: auto; margin: 20px 0; }}
.nero-ai-table {{
  width: 100%; border-collapse: collapse; font-size: 14px;
}}
.nero-ai-table th, .nero-ai-table td {{
  border: 1px solid rgba(255,255,255,.12); padding: 10px 12px; text-align: left;
}}
.nero-ai-table th {{ background: rgba(121,242,255,.08); color: #fff; }}
.nero-ai-faq-item {{
  border: 1px solid rgba(255,255,255,.10); border-radius: 18px;
  background: rgba(255,255,255,.045); margin-bottom: 12px; overflow: hidden;
}}
.nero-ai-faq-item summary {{
  padding: 18px 20px; cursor: pointer; font-weight: 800; color: #fff; list-style: none;
}}
.nero-ai-faq-item summary::-webkit-details-marker {{ display: none; }}
.nero-ai-faq-item p {{ margin: 0; padding: 0 20px 18px; }}
.nero-ai-inline-cta {{ margin: 28px 0; padding: clamp(24px, 4vw, 36px); }}
.nero-ai-inline-cta h3 {{ margin: 8px 0 12px; font-size: clamp(22px, 3vw, 28px); line-height: 1.15; }}
.nero-ai-secondary-cta {{ margin: 20px 0; padding: 20px 24px; }}
.nero-ai-secondary-cta a {{
  color: var(--nero-ai-primary, #79f2ff); font-weight: 700;
  text-decoration: underline; text-underline-offset: 3px;
}}
@media (max-width: 900px) {{
  .{SLUG}-intro-grid {{ grid-template-columns: 1fr; }}
}}
"""
    return css + extra


def intro_html() -> str:
    toc = "".join(f'<li><a href="#{sid}">{label}</a></li>' for sid, label in TOC_ITEMS)
    return f'''<section class="{SLUG}-intro" aria-label="Введение">
  <div class="nero-ai-container">
    <div class="{SLUG}-intro-grid">
      <div class="{SLUG}-intro-copy">
        <p><strong>Коротко:</strong> AI-агент для первичной обработки заявок — это слой автоматизации между формой, виджетом или мессенджером и CRM. Он отвечает за 5–15 секунд, уточняет детали, квалифицирует лид и передаёт горячую карточку менеджеру.</p>
        <p>Ниже — как это работает, для кого подходит, сколько стоит и какие риски учесть до запуска.</p>
      </div>
      <div class="{SLUG}-intro-terminal nero-ai-reveal" aria-hidden="true">
        <div class="{SLUG}-intro-terminal-top"><span></span><span></span><span></span></div>
        <pre>webhook → AI-агент → CRM
├─ ответ: 8 сек
├─ поля: имя, телефон, запрос
├─ статус: hot_lead
└─ задача: перезвонить</pre>
        <div class="{SLUG}-intro-chips">
          <span class="{SLUG}-intro-chip">5–15 сек</span>
          <span class="{SLUG}-intro-chip">human_review</span>
          <span class="{SLUG}-intro-chip">amoCRM / B24</span>
        </div>
      </div>
    </div>
    <div class="{SLUG}-toc-wrap">
      <nav aria-label="Оглавление">
        <ul class="nero-ai-toc">{toc}</ul>
      </nav>
    </div>
  </div>
</section>'''


def json_ld() -> str:
    return '''<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "AI-обработка заявок с сайта: внедрение агента под ключ",
  "description": "Внедрим AI-агента для обработки заявок с сайта: ответ за 5–15 секунд, квалификация лида и передача в CRM.",
  "author": {"@type": "Organization", "name": "Nero Network"},
  "mainEntityOfPage": {"@type": "WebPage"},
  "about": {"@type": "Service", "name": "AI-обработка заявок с сайта под ключ"}
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type": "Question", "name": "Сколько времени занимает внедрение?", "acceptedAnswer": {"@type": "Answer", "text": "Простой пилот на одном канале — от 2–4 недель. Типовой запуск виджета с CRM — 5–7 дней."}},
    {"@type": "Question", "name": "Нужен ли отдельный разработчик?", "acceptedAnswer": {"@type": "Answer", "text": "Для типового внедрения под ключ — нет. Нужны доступы к сайту, CRM и согласованные материалы."}},
    {"@type": "Question", "name": "Можно ли подключить к существующей CRM?", "acceptedAnswer": {"@type": "Answer", "text": "Да. Поддерживаются amoCRM, Битрикс24, RetailCRM, GetCourse."}}
  ]
}
</script>'''


def reveal_script() -> str:
    js = REVEAL_JS.read_text(encoding="utf-8")
    return js.replace("'.nero-ai-home-page'", f"'.{CONTENT_CLASS}.nero-ai-home-page'")


def split_hero(hero_html: str) -> tuple[str, str]:
    """Return section HTML and trailing script separately."""
    idx = hero_html.find("<script>")
    if idx == -1:
        return hero_html, ""
    return hero_html[:idx].strip(), hero_html[idx:].strip()


def build_page_html() -> str:
    hero_full = extract_html_block(ALINA, "hero")
    hero_section, hero_script = split_hero(hero_full)
    longread = parse_longread(extract_artur_body())

    parts = [
        "<style>",
        adapt_css(),
        "</style>",
        f'<main id="primary" class="site-main {PAGE_CLASS}" role="main" tabindex="-1">',
        hero_section,
        f'<div class="{CONTENT_CLASS} nero-ai-home-page">',
        intro_html(),
        longread,
        "</div>",
        "</main>",
        hero_script,
        reveal_script(),
        json_ld(),
    ]
    return "\n\n".join(parts)


def build_php(html: str) -> str:
    esc_title = SEO_TITLE.replace("'", "\\'")
    esc_desc = SEO_DESC.replace("'", "\\'")
    return f'''<?php
/**
 * Template Name: AI-обработка заявок с сайта
 */
$page_seo_title = '{esc_title}';
$page_seo_description = '{esc_desc}';
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить, сколько заявок вы теряете';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#audit-cta';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Материалы по внедрению AI';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {{
    $parts['title'] = $page_seo_title;
    return $parts;
}}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {{
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\\n";
    echo '<meta property="og:type" content="article" />' . "\\n";
}}, 1);

get_header();
?>

{html}

<?php get_footer(); ?>
'''


def append_handoff(html: str) -> None:
    text = HANDOFF.read_text(encoding="utf-8")
    if "=== НАТАША (HTML СТРАНИЦЫ) ===" in text:
        text = re.sub(
            r"\n=== НАТАША \(HTML СТРАНИЦЫ\) ===.*",
            "",
            text,
            flags=re.DOTALL,
        )
    block = f"""

=== НАТАША (HTML СТРАНИЦЫ) ===
Статус: ✅ ГОТОВО
SLUG: {SLUG}
ВНИМАНИЕ: контент содержит <script> и <canvas> — при публикации обернуть в <!-- wp:html -->

Структура: hero Алины (#lead-dispatch-hero) → intro + TOC → 11 секций лонгрида → блок Бориса (#ai-obrabotka-zayavok-boris-block) после «Что такое AI-обработка» → 3 CTA Артура → FAQ → финальный #audit-cta.

{html}

## Передача Юре
SLUG: {SLUG}
Контент содержит <script> (hero engine + Борис + reveal) и <canvas>. Обязательно обернуть в <!-- wp:html --> при публикации.
Локальный шаблон: wordpress/page-{SLUG}.php
"""
    HANDOFF.write_text(text.rstrip() + block, encoding="utf-8")


def main() -> None:
    html = build_page_html()
    OUT_HTML.write_text(html, encoding="utf-8")
    OUT_PHP.write_text(build_php(html), encoding="utf-8")
    append_handoff(html)
    print(f"HTML bytes: {len(html.encode('utf-8'))}")
    print(f"Written: {OUT_PHP}")
    print(f"Handoff updated")


if __name__ == "__main__":
    main()

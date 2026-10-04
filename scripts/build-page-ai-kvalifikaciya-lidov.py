#!/usr/bin/env python3
"""Assemble page-ai-kvalifikaciya-lidov.php from nero-network-handoff.md."""
from __future__ import annotations

import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
HANDOFF = ROOT / ".cursor/nero-network-handoff.md"
OUT = ROOT / "wordpress-theme/page-ai-kvalifikaciya-lidov.php"

PHP_HEAD = r'''<?php
/**
 * Template Name: AI-квалификация лидов: внедрение и скоринг под ключ
 * Description: Внедрение AI-скоринга лидов, матрица hot/warm/cold/junk, интеграция с CRM.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-квалификация лидов под ключ — внедрение и скоринг в CRM';
$page_seo_description = 'Внедрим AI-скоринг лидов до передачи менеджеру: статусы горячий, тёплый, холодный, нецелевой. Интеграция с CRM и мессенджерами. Получите матрицу квалификации.';

add_filter(
    'document_title_parts',
    static function (array $parts) use ($page_seo_title): array {
        $parts['title'] = $page_seo_title;
        return $parts;
    },
    20
);

add_action(
    'wp_head',
    static function () use ($page_seo_title, $page_seo_description): void {
        echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
    },
    1
);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Зачем', 'href' => '#zachem'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Получить карту квалификации';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}

?>

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

'''

PAGE_CSS = r'''<style>
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

.akl-content{
  --akl-bg:#050711;--akl-bg2:#080b17;
  --akl-surface:rgba(255,255,255,.072);
  --akl-text:#e6edf7;--akl-muted:#9aa8bd;--akl-soft:#c7d2e5;--akl-heading:#fff;
  --akl-border:rgba(255,255,255,.10);
  --akl-accent:#f97316;--akl-violet:#a78bfa;--akl-cyan:#38bdf8;--akl-green:#22c55e;
  --akl-btn-from:#ea580c;--akl-btn-to:#7c3aed;
  --akl-r:18px;--akl-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--akl-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.akl-content *,.akl-content *::before,.akl-content *::after{box-sizing:border-box;}
.akl-content a{color:inherit;}
.akl-content p{color:var(--akl-muted);line-height:1.72;margin:0 0 1em;text-align:left;}
.akl-content h2,.akl-content h3,.akl-content h4{color:var(--akl-heading);letter-spacing:-.04em;margin:0 0 .7em;}
.akl-content strong{color:var(--akl-soft);}
.akl-cnt{width:min(var(--akl-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.akl-section{padding:clamp(64px,8vw,100px) 0;position:relative;}
.akl-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);
}
.akl-sh{max-width:820px;margin:0 auto 40px;text-align:left;}
.akl-sh h2{font-size:clamp(26px,4vw,44px);line-height:1.08;}
.akl-sh p{font-size:clamp(15px,1.6vw,17px);}
.akl-eyebrow{
  display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;
  background:rgba(249,115,22,.1);border:1px solid rgba(249,115,22,.25);
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#fdba74;margin-bottom:14px;
}
.akl-intro-grid{display:grid;grid-template-columns:minmax(0,1.1fr) minmax(280px,.9fr);gap:clamp(28px,4vw,48px);align-items:start;}
.akl-intro-text{text-align:left!important;position:relative;padding-left:18px;}
.akl-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:3px;
  background:linear-gradient(180deg,var(--akl-accent),var(--akl-violet));
}
.akl-intro-text p{text-align:left!important;}
.akl-intro-kpi{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;}
.akl-kpi-card{
  padding:16px;border-radius:14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
}
.akl-kpi-card .kv{font-size:22px;font-weight:800;color:#fff;}
.akl-kpi-card .kl{font-size:12px;color:var(--akl-muted);margin-top:4px;line-height:1.4;}
.akl-toc-outer{padding:8px 0 32px;}
.akl-toc{
  display:flex;flex-wrap:wrap;gap:10px;justify-content:center;list-style:none;margin:0;padding:0;
}
.akl-toc a{
  display:inline-flex;padding:10px 16px;border-radius:999px;font-size:13px;font-weight:700;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);text-decoration:none!important;
  color:var(--akl-soft)!important;transition:border-color .2s,background .2s;
}
.akl-toc a:hover{border-color:rgba(249,115,22,.45);background:rgba(249,115,22,.08);}
.akl-prose{max-width:820px;}
.akl-prose-wide{max-width:960px;}
.akl-callout{
  padding:18px 20px;border-radius:14px;background:rgba(56,189,248,.08);
  border:1px solid rgba(56,189,248,.22);margin:20px 0;
}
.akl-callout strong{color:#7dd3fc;}
.akl-table-wrap{overflow-x:auto;margin:24px 0;border-radius:14px;border:1px solid var(--akl-border);}
.akl-table{width:100%;border-collapse:collapse;font-size:14px;}
.akl-table th,.akl-table td{padding:13px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.06);vertical-align:top;}
.akl-table th{background:rgba(255,255,255,.06);color:var(--akl-soft);font-weight:700;}
.akl-table tr:last-child td{border-bottom:none;}
.akl-bento{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin:28px 0;}
.akl-bento-card{
  padding:20px;border-radius:16px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
}
.akl-bento-card h3{font-size:17px;margin-bottom:8px;}
.akl-bento-card p{font-size:14px;margin:0;}
.akl-list{margin:0 0 1em;padding:0;list-style:none;}
.akl-list li{
  padding-left:20px;position:relative;margin-bottom:.5em;color:var(--akl-muted);font-size:15px;line-height:1.65;
}
.akl-list li::before{content:'›';position:absolute;left:0;color:var(--akl-accent);font-weight:700;}
.akl-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.akl-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.akl-faq-q{
  padding:18px 22px;font-size:16px;font-weight:700;color:var(--akl-heading);cursor:pointer;
  display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;
}
.akl-faq-q::after{content:'▾';font-size:13px;color:var(--akl-accent);transition:transform .25s;}
.akl-faq-item.open .akl-faq-q::after{transform:rotate(180deg);}
.akl-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--akl-muted);line-height:1.72;}
.akl-faq-item.open .akl-faq-a{max-height:800px;padding:0 22px 18px;}
.ym-cta-block{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(249,115,22,.14),rgba(167,139,250,.1));
  border:1px solid rgba(249,115,22,.28);text-align:center;
}
.ym-cta-block--secondary{
  background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;
}
.ym-cta-block--footer-final{
  background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(249,115,22,.1));
  border-color:rgba(167,139,250,.3);
}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--akl-muted);font-size:15px;margin:0 auto 22px;max-width:640px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:#fdba74!important;text-decoration:underline;text-underline-offset:3px;}
.ym-btn{display:inline-flex;align-items:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
@media(max-width:900px){
  .akl-intro-grid{grid-template-columns:1fr;}
  .akl-bento{grid-template-columns:1fr;}
  .akl-intro-kpi{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}.akl-intro-kpi{grid-template-columns:1fr;}}
</style>
'''

PHP_TAIL = r'''
<script>
(function(){
  document.querySelectorAll('.akl-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.akl-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.akl-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.akl-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){
        item.classList.add('open');
        btn.setAttribute('aria-expanded','true');
      }
    });
    btn.addEventListener('keydown', function(e){
      if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-kvalifikaciya-lidov-page');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -6% 0px' });
    items.forEach(function(item){ observer.observe(item); });
  } else {
    items.forEach(function(item){ item.classList.add('nero-ai-active'); });
  }
})();
</script>

<!-- SCHEMA-MARKUP:INSERT -->

<!-- INTERNAL-LINKS:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
'''


def extract_codeblock(text: str, start_marker: str, end_marker: str | None = None) -> str:
    idx = text.find(start_marker)
    if idx < 0:
        raise SystemExit(f"Marker not found: {start_marker}")
    rest = text[idx + len(start_marker) :]
    m = re.search(r"```html\n(.*?)```", rest, re.DOTALL)
    if not m:
        m = re.search(r"```\n(.*?)```", rest, re.DOTALL)
    if not m:
        raise SystemExit(f"No code block after {start_marker}")
    block = m.group(1)
    if end_marker and end_marker in block:
        block = block.split(end_marker)[0]
    return block.strip()


def md_inline(s: str) -> str:
    s = re.sub(r"\*\*(.+?)\*\*", r"<strong>\1</strong>", s)
    s = re.sub(r"\[([^\]]+)\]\(([^)]+)\)", r'<a href="\2" target="_blank" rel="noopener noreferrer">\1</a>', s)
    return s


def md_table(lines: list[str]) -> str:
    rows = [ln for ln in lines if ln.strip().startswith("|")]
    if len(rows) < 2:
        return ""
    header = [c.strip() for c in rows[0].strip("|").split("|")]
    body_rows = []
    for row in rows[2:]:
        cells = [md_inline(c.strip()) for c in row.strip("|").split("|")]
        body_rows.append(cells)
    html = ['<div class="akl-table-wrap"><table class="akl-table"><thead><tr>']
    for h in header:
        html.append(f"<th>{md_inline(h)}</th>")
    html.append("</tr></thead><tbody>")
    for cells in body_rows:
        html.append("<tr>")
        for c in cells:
            html.append(f"<td>{c}</td>")
        html.append("</tr>")
    html.append("</tbody></table></div>")
    return "".join(html)


def parse_zhenya_body(handoff: str) -> str:
    m = re.search(
        r"=== ЖЕНЯ \(ЛОНГРИД\) ===.*?### Полный текст\n\n(.*?)\n---\n\n### GEO-чеклист",
        handoff,
        re.DOTALL,
    )
    if not m:
        raise SystemExit("Zhenya body not found")
    raw = m.group(1)
    # Remove commercial placeholder block
    raw = re.sub(
        r"## Коммерческий блок \(место для Артура\).*?---\n\n",
        "",
        raw,
        flags=re.DOTALL,
    )
    sections: list[str] = []
    chunks = re.split(r"\n(?=## )", raw)
    section_ids = {
        "Определение: что такое AI-квалификация лидов": ("vvedenie", None),
        "Зачем отделу продаж AI-квалификация лидов": ("zachem", "zachem"),
        "Тренд 2026: продажи и AI-агенты": ("trend-2026", None),
        "Как работает скоринг лидов AI: статусы и правила": ("kak-rabotaet", "kak-rabotaet"),
        "Три слоя скоринга: что выбрать": ("tri-sloya", None),
        "Внедрение AI-квалификации лидов под ключ: этапы и сроки": ("etapy", "etapy"),
        "Интеграция с CRM и каналами лидогенерации": ("integracii", "integracii"),
        "AI для отдела продаж: роли менеджера и AI-агента": ("roli-op", None),
        "Стоимость и формат проекта": ("ceny", "ceny"),
        "Кейсы и примеры внедрения ai квалификация лидов": ("keisy", "keisy"),
        "152-ФЗ и хранение данных лида при LLM": ("pd-152", None),
        "FAQ: как внедрить ai квалификация лидов": ("faq", "faq"),
        "Итог": ("itog", None),
    }
    lead_para = ""
    for chunk in chunks:
        chunk = chunk.strip()
        if not chunk:
            continue
        if chunk.startswith("**Лид-абзац"):
            lead_para = re.sub(r"^\*\*Лид-абзац[^:]*:\*\*\s*", "", chunk.split("\n")[0])
            continue
        if not chunk.startswith("## "):
            continue
        title_line, *body_lines = chunk.split("\n")
        title = title_line[3:].strip()
        sid, anchor = section_ids.get(title, (None, None))
        body = "\n".join(body_lines).strip()
        html_parts: list[str] = []
        i = 0
        lines = body.split("\n")
        while i < len(lines):
            line = lines[i]
            if line.startswith("### "):
                html_parts.append(f'<h3 id="{anchor or sid}-h3">{md_inline(line[4:])}</h3>')
                i += 1
                continue
            if line.startswith("|"):
                table_lines = []
                while i < len(lines) and lines[i].startswith("|"):
                    table_lines.append(lines[i])
                    i += 1
                html_parts.append(md_table(table_lines))
                continue
            if line.startswith("**Коротко:**") or line.startswith("**Итог"):
                html_parts.append(f'<div class="akl-callout"><p>{md_inline(line)}</p></div>')
                i += 1
                continue
            if re.match(r"^\d+\.\s", line):
                html_parts.append('<ol class="akl-list">')
                while i < len(lines) and re.match(r"^\d+\.\s", lines[i]):
                    html_parts.append(f"<li>{md_inline(re.sub(r'^\\d+\\.\\s*', '', lines[i]))}</li>")
                    i += 1
                html_parts.append("</ol>")
                continue
            if line.startswith("- "):
                html_parts.append('<ul class="akl-list">')
                while i < len(lines) and lines[i].startswith("- "):
                    html_parts.append(f"<li>{md_inline(lines[i][2:])}</li>")
                    i += 1
                html_parts.append("</ul>")
                continue
            if line.strip() == "---":
                i += 1
                continue
            if line.strip():
                html_parts.append(f"<p>{md_inline(line)}</p>")
            i += 1
        inner = "\n".join(html_parts)
        alt = " akl-section-alt" if anchor in ("etapy", "integracii", "keisy", "faq") else ""
        id_attr = f' id="{anchor}"' if anchor else ""
        sec = f'''
<section class="akl-section{alt}"{id_attr}>
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>{md_inline(title)}</h2></div>
    <div class="akl-prose akl-prose-wide">{inner}</div>
  </div>
</section>'''
        sections.append((title, anchor, sec))

    intro = f'''
<section class="akl-section" id="vvedenie" aria-label="Введение">
  <div class="akl-cnt">
    <div class="akl-intro-grid nero-ai-reveal">
      <div class="akl-intro-text">
        <span class="akl-eyebrow">Лонгрид · AI-квалификация лидов</span>
        <p>{md_inline(lead_para)}</p>
      </div>
      <div class="akl-intro-kpi" aria-label="Ориентиры скоринга">
        <div class="akl-kpi-card"><div class="kv">hot</div><div class="kl">Горячий — эскалация менеджеру</div></div>
        <div class="akl-kpi-card"><div class="kv">warm</div><div class="kl">Тёплый — nurture и дожим</div></div>
        <div class="akl-kpi-card"><div class="kv">cold</div><div class="kl">Холодный — отложенный контакт</div></div>
        <div class="akl-kpi-card"><div class="kv">junk</div><div class="kl">Нецелевой — закрытие с причиной</div></div>
      </div>
    </div>
    <nav class="akl-toc-outer" aria-label="Оглавление">
      <ul class="akl-toc ym-toc">
        <li><a href="#zachem">Зачем</a></li>
        <li><a href="#kak-rabotaet">Как работает</a></li>
        <li><a href="#etapy">Этапы</a></li>
        <li><a href="#integracii">Интеграции</a></li>
        <li><a href="#ceny">Стоимость</a></li>
        <li><a href="#keisy">Кейсы</a></li>
        <li><a href="#faq">FAQ</a></li>
      </ul>
    </nav>
  </div>
</section>'''

    out: list[str] = [intro]
    cta_mid = '''
<div class="akl-cnt">
<div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
  <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получить карту квалификации</p>
    <p class="ym-cta-block__sub">Матрица квалификации лидов: критерии hot / warm / cold / junk, веса и эскалация — база для ai квалификация лидов под ключ. В Telegram обсудим ваши каналы, CRM и пороги до сметы проекта 150–450 тыс. ₽.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Получить карту квалификации'); ?></a>
  </div>
</div>
</div>'''
    cta_sec = '''
<div class="akl-cnt">
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать архитектуру до старта проекта?</p>
    <p class="ym-cta-block__sub">Если перед пилотом нужно разобрать оркестратор, промпты и human-in-the-loop — <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование матрицы с отделом продаж.</p>
  </div>
</aside>
</div>'''
    cta_final = '''
<section class="akl-section akl-section-alt" id="karta-kvalifikacii">
  <div class="akl-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-kvalifikacii">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Запросите карту квалификации лидов</p>
        <p class="ym-cta-block__sub">Пришлём шаблон матрицы hot / warm / cold / junk и пройдёмся по вашим каналам, amoCRM или Битрикс24 и режиму HITL на пилоте. Следующий шаг — аудит воронки, без обязательств по проекту.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить карту квалификации</a>
          <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Вопросы по внедрению →</a>
        </div>
      </div>
    </div>
  </div>
</section>'''

    for title, anchor, sec in sections:
        if anchor == "kak-rabotaet":
            boris_slot = (
                '\n<div class="akl-cnt">BORIS_PLACEHOLDER</div>\n'
                '<!-- INTERNAL-LINKS:INSERT -->\n'
            )
            sec = sec.replace(
                '<h3 id="kak-rabotaet-h3">Горячий, тёплый, холодный, нецелевой: критерии матрицы</h3>',
                boris_slot
                + '<h3 id="kak-rabotaet-h3">Горячий, тёплый, холодный, нецелевой: критерии матрицы</h3>',
                1,
            )
            out.append(sec)
        else:
            out.append(sec)
        if anchor == "etapy":
            out.append(cta_mid)
        if anchor == "integracii":
            out.append(cta_sec)
        if anchor == "pd-152":
            out.append(cta_final)

    return "\n".join(out)


def main() -> None:
    handoff = HANDOFF.read_text(encoding="utf-8")
    alina = extract_codeblock(handoff, "## HTML-фрагмент hero")
    # Hero includes style+section; script is separate block
    hero_script = extract_codeblock(handoff, "## JavaScript (canvas engine")
    boris = extract_codeblock(handoff, "**ВНИМАНИЕ для Наташи:**", None)
    # Boris block starts with section id
    boris_m = re.search(
        r"(<section id=\"ai-kvalifikaciya-lidov-boris-block\".*?</section>)",
        handoff,
        re.DOTALL,
    )
    if not boris_m:
        raise SystemExit("Boris section not found")
    boris_html = boris_m.group(1)

    content = parse_zhenya_body(handoff)
    # Insert Boris after first paragraph block in kak-rabotaet - after section header prose start
    content = content.replace("BORIS_PLACEHOLDER", boris_html, 1)

    # FAQ accordion conversion for FAQ section - wrap Q/A pairs
    faq_block = re.search(
        r'<section class="akl-section akl-section-alt" id="faq">(.*?)</section>',
        content,
        re.DOTALL,
    )
    if faq_block:
        inner = faq_block.group(1)
        qa_pairs = re.findall(
            r"<p><strong>(.+?)</strong>\s*</p>\s*<p>(.+?)</p>", inner, re.DOTALL
        )
        if qa_pairs:
            faq_html = ['<div class="akl-cnt"><div class="akl-sh"><h2>FAQ: как внедрить ai квалификация лидов</h2></div><div class="akl-faq">']
            for q, a in qa_pairs:
                faq_html.append(
                    f'<div class="akl-faq-item"><div class="akl-faq-q" role="button" tabindex="0" aria-expanded="false">{md_inline(q)}</div><div class="akl-faq-a"><p>{md_inline(a.strip())}</p></div></div>'
                )
            faq_html.append("</div></div>")
            content = (
                content[: faq_block.start()]
                + f'<section class="akl-section akl-section-alt" id="faq">{"".join(faq_html)}</section>'
                + content[faq_block.end() :]
            )

    php = (
        PHP_HEAD
        + alina.split("</style>")[0]
        + "</style>\n"
        + PAGE_CSS
        + '\n<main id="primary" class="site-main nero-ai-home-page ai-kvalifikaciya-lidov-page" role="main" tabindex="-1">\n\n'
        + alina.split("</style>", 1)[1].strip()
        + "\n\n<div class=\"akl-content\">\n"
        + content
        + "\n</div><!-- /.akl-content -->\n\n"
        + hero_script
        + "\n"
        + PHP_TAIL
    )
    OUT.write_text(php, encoding="utf-8")
    print(f"Wrote {OUT} ({len(php)} bytes)")


if __name__ == "__main__":
    main()

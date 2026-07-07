#!/usr/bin/env python3
"""Build page-vnedrenie-ai-baza-znanij-tehpodderzhka.php from handoff."""
import re
from pathlib import Path

handoff = Path("/workspace/.cursor/nero-network-handoff.md").read_text(encoding="utf-8")

alina_block = handoff[handoff.index("=== АЛИНА (HERO) ===") :]
hero_html = re.search(
    r"```html\n(<section class=\"nero-ai-hero.*?</section>)", alina_block, re.DOTALL
).group(1)
hero_script = re.search(
    r"(<script>\n/\*\*\n \* vnkbz-rag-support-engine.*?</script>)", alina_block, re.DOTALL
).group(1)

boris_block = handoff[handoff.index("=== БОРИС") :]
boris_html = re.search(
    r"```html\n(<section id=\"vnedrenie-ai-baza-znanij-tehpodderzhka-boris-block\".*?</section>)",
    boris_block,
    re.DOTALL,
).group(1)

artur_start = handoff.index("### Полный текст", handoff.index("=== АРТУР"))
artur_end = handoff.index("### Рекламные вставки для Наташи", artur_start)
artur_md = handoff[artur_start + len("### Полный текст\n") : artur_end].strip()


def md_inline(s: str) -> str:
    return re.sub(r"\*\*(.+?)\*\*", r"<strong>\1</strong>", s)


def fix_cta_html(block: str) -> str:
    block = re.sub(
        r'<a href="\[REDACTED\]" class="nero-ai-btn nero-ai-btn-primary([^"]*)"([^>]*)>\[REDACTED\]</a>',
        r'<a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary\1"\2<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>',
        block,
    )
    block = re.sub(
        r'<a href="\[REDACTED\]" class="ym-link ym-link--accent"[^>]*>\[REDACTED\]</a>',
        '<a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>',
        block,
    )
    return block


def md_to_html(md: str) -> str:
    lines = md.split("\n")
    out: list[str] = []
    i = 0
    in_ul = False
    in_ol = False
    in_table = False
    table_rows: list[str] = []

    def close_lists() -> None:
        nonlocal in_ul, in_ol
        if in_ul:
            out.append("</ul>")
            in_ul = False
        if in_ol:
            out.append("</ol>")
            in_ol = False

    def flush_table() -> None:
        nonlocal in_table, table_rows
        if not in_table:
            return
        if table_rows:
            out.append('<div class="vnkbz-table-wrap"><table class="vnkbz-table">')
            for ri, row in enumerate(table_rows):
                cells = [c.strip() for c in row.strip("|").split("|")]
                tag = "th" if ri == 0 else "td"
                out.append(
                    "<tr>"
                    + "".join(f"<{tag}>{md_inline(c)}</{tag}>" for c in cells)
                    + "</tr>"
                )
            out.append("</table></div>")
        table_rows = []
        in_table = False

    while i < len(lines):
        line = lines[i]

        if line.strip().startswith("<div class=\"ym-cta") or line.strip().startswith(
            "<aside class=\"ym-cta"
        ):
            close_lists()
            flush_table()
            html_block: list[str] = []
            depth = 0
            root = "aside" if line.strip().startswith("<aside") else "div"
            while i < len(lines):
                html_block.append(lines[i])
                depth += len(re.findall(r"<" + root + r"\b", lines[i]))
                depth -= lines[i].count(f"</{root}>")
                i += 1
                if depth <= 0:
                    break
            out.append(fix_cta_html("\n".join(html_block)))
            continue

        if line.strip().startswith("<!--"):
            close_lists()
            flush_table()
            out.append(line)
            i += 1
            continue

        if line.startswith("## "):
            close_lists()
            flush_table()
            out.append(f"<h2>{md_inline(line[3:].strip())}</h2>")
            i += 1
            continue

        if line.startswith("### "):
            close_lists()
            flush_table()
            out.append(f"<h3>{md_inline(line[4:].strip())}</h3>")
            i += 1
            continue

        if line.strip() == "---":
            close_lists()
            flush_table()
            out.append('<hr class="vnkbz-hr">')
            i += 1
            continue

        if line.strip().startswith("|"):
            close_lists()
            if not in_table:
                in_table = True
                table_rows = []
            table_rows.append(line)
            i += 1
            continue
        flush_table()

        if re.match(r"^- ", line):
            if not in_ul:
                close_lists()
                out.append("<ul>")
                in_ul = True
            out.append(f"<li>{md_inline(line[2:].strip())}</li>")
            i += 1
            continue

        if re.match(r"^\d+\. ", line):
            if not in_ol:
                close_lists()
                out.append("<ol>")
                in_ol = True
            out.append(f"<li>{md_inline(re.sub(r'^\\d+\\.\\s*', '', line))}</li>")
            i += 1
            continue

        if line.strip() == "":
            close_lists()
            i += 1
            continue

        close_lists()
        out.append(f"<p>{md_inline(line.strip())}</p>")
        i += 1

    close_lists()
    flush_table()
    return "\n".join(out)


def faq_to_accordion(html: str) -> str:
    tail = ""
    if "<hr class=\"vnkbz-hr\">" in html:
        html, tail = html.split("<hr class=\"vnkbz-hr\">", 1)
    chunks = re.split(r"(<h3>.*?</h3>)", html, flags=re.DOTALL)
    result: list[str] = []
    i = 0
    while i < len(chunks):
        chunk = chunks[i]
        if chunk.startswith("<h3>"):
            title = re.sub(r"</?h3>", "", chunk)
            i += 1
            body = chunks[i] if i < len(chunks) else ""
            body = body.strip()
            if body.startswith("<p>") and not body.startswith("<div class=\"ym-cta"):
                result.append(
                    f'<div class="vnkbz-faq-item nero-ai-reveal">'
                    f'<button type="button" class="vnkbz-faq-q" aria-expanded="false">{title}</button>'
                    f'<div class="vnkbz-faq-a">{body}</div></div>'
                )
            else:
                result.append(chunk)
                if body:
                    result.append(body)
            i += 1
        else:
            if chunk.strip():
                result.append(chunk)
            i += 1
    if tail.strip():
        result.append(tail.strip())
    return "\n".join(result)


EYEBROWS = {
    "pochemu": "Проблема",
    "kak-rabotaet": "RAG",
    "etapy": "Внедрение",
    "integracii": "Интеграции",
    "kpi": "Метрики",
    "ceny": "Цена",
    "dlya-kogo": "Сегменты",
    "keisy": "Кейсы",
    "riski": "Риски",
    "faq": "FAQ",
}


def section_html(sid: str, part_md: str, alt: bool = False) -> str:
    eyebrow = EYEBROWS.get(sid, sid)
    lines = part_md.split("\n")
    h2_title = lines[0].replace("## ", "").strip() if lines[0].startswith("## ") else ""
    body_md = "\n".join(lines[1:]) if lines[0].startswith("## ") else part_md
    alt_class = " vnkbz-section-alt" if alt else ""
    inner = md_to_html(body_md)
    if sid == "faq":
        inner = faq_to_accordion(inner)
        inner = re.sub(r"<hr class=\"vnkbz-hr\">", "", inner)
        return f"""  <section class="vnkbz-section{alt_class}" id="{sid}">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">FAQ</span>
        <h2>{md_inline(h2_title)}</h2>
      </div>
      <div class="vnkbz-faq nero-ai-reveal nero-ai-delay-1">
{inner}
      </div>
    </div>
  </section>"""

    return f"""  <section class="vnkbz-section{alt_class}" id="{sid}">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">{eyebrow}</span>
        <h2>{md_inline(h2_title)}</h2>
      </div>
      <div class="vnkbz-prose nero-ai-reveal nero-ai-delay-1">
{inner}
      </div>
    </div>
  </section>"""


parts = re.split(r"\n(?=## )", artur_md)
intro_md = parts[0]
sections = [
    ("pochemu", parts[1], False),
    ("kak-rabotaet", parts[2], True),
    ("etapy", parts[3], False),
    ("integracii", parts[4], True),
    ("kpi", parts[5], False),
    ("ceny", parts[6], True),
    ("dlya-kogo", parts[7], False),
    ("keisy", parts[8], True),
    ("riski", parts[9], False),
    ("faq", parts[10], False),
]

intro_html = md_to_html(intro_md)
content_sections: list[str] = []
for sid, part, alt in sections:
    content_sections.append(section_html(sid, part, alt=alt))
    if sid == "kak-rabotaet":
        content_sections.append("  <!-- INTERNAL-LINKS:INSERT -->")
        content_sections.append(boris_html)

email_page = Path("/workspace/wordpress/page-vnedrenie-ai-obrabotka-email-crm.php").read_text(
    encoding="utf-8"
)
css_start = email_page.index("/* Kadence reset")
content_css_start = email_page.index(".vnec-content{", css_start)
css_end = email_page.index("</style>", css_start)
base_css = email_page[css_start:content_css_start].replace("vnec-", "vnkbz-")
base_css += email_page[content_css_start:css_end].replace("vnec-", "vnkbz-").replace("vnec", "vnkbz")
base_css = base_css.replace("vnkbzbz", "vnkbz")

php_header = """<?php
/**
 * Template Name: AI-база знаний для техподдержки: внедрение под ключ
 * Description: Внедрим AI-базу знаний для техподдержки под ключ: единые ответы с цитатой из утверждённых инструкций, интеграция с CRM. Аудит базы знаний — бесплатно.
 */

$page_seo_title       = 'AI-база знаний для техподдержки: внедрение под ключ | Nero Network';
$page_seo_description = 'Внедрим AI-базу знаний для техподдержки под ключ: единые ответы с цитатой из утверждённых инструкций, интеграция с CRM. Аудит базы знаний — бесплатно.';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
\t$parts['title'] = $page_seo_title;
\treturn $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description ): void {
\techo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\\n";
\techo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\\n";
\techo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\\n";
\techo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\\n";
\techo '<meta property="og:type" content="article" />' . "\\n";
}, 1 );

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'KPI', 'href' => '#kpi'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать AI-базу знаний';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Курс по RAG';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}

?>
"""

footer_scripts = """
<script>
(function(){
  document.querySelectorAll('.vnkbz-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.vnkbz-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.vnkbz-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.vnkbz-faq-q');if(q)q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){item.classList.add('open');btn.setAttribute('aria-expanded','true');}
    });
    btn.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}});
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root=document.querySelector('.vnkbz-content');
  if(!root)return;
  var items=root.querySelectorAll('.nero-ai-reveal');
  if('IntersectionObserver' in window){
    var observer=new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){entry.target.classList.add('nero-ai-active');observer.unobserve(entry.target);}
      });
    },{threshold:0.1,rootMargin:'0px 0px -6% 0px'});
    items.forEach(function(item){observer.observe(item);});
  }else{items.forEach(function(item){item.classList.add('nero-ai-active');});}
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
"""

intro_section = f"""  <section class="vnkbz-intro vnkbz-section" id="intro" aria-label="Введение">
    <div class="vnkbz-cnt">
      <div class="vnkbz-intro-grid nero-ai-reveal">
        <div class="vnkbz-intro-text">
          <p class="vnkbz-eyebrow">Лонгрид / RAG / техподдержка</p>
{intro_html}
        </div>
        <div class="vnkbz-intro-kpi" aria-label="Ключевые метрики RAG-поддержки">
          <div class="vnkbz-kpi-card"><div class="kv">60→3 сек</div><div class="kl">поиск в wiki</div><div class="ks">Альфа-Банк / KTS</div></div>
          <div class="vnkbz-kpi-card"><div class="kv">96%</div><div class="kl">faithfulness</div><div class="ks">Timeweb Cloud</div></div>
          <div class="vnkbz-kpi-card"><div class="kv">100%</div><div class="kl">ответов с citation</div><div class="ks">grounded RAG</div></div>
          <div class="vnkbz-kpi-card"><div class="kv">6-10 нед</div><div class="kl">внедрение под ключ</div><div class="ks">Nero Network</div></div>
        </div>
      </div>
    </div>
  </section>"""

toc_block = """  <div class="vnkbz-toc-outer">
    <div class="vnkbz-cnt">
      <nav class="vnkbz-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu">Проблема</a>
        <a href="#kak-rabotaet">Как работает RAG</a>
        <a href="#etapy">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#kpi">KPI</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>"""

extra_css = """
.vnkbz-prose h3{font-size:17px;margin-top:1.4em}
.vnkbz-prose > h2{display:none}
.vnkbz-hr{border:none;border-top:1px solid rgba(255,255,255,.08);margin:28px 0}
"""

full_page = php_header
full_page += "\n<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>\n\n<style>\n"
full_page += base_css + extra_css + "\n</style>\n\n"
full_page += (
    '<main id="primary" class="site-main nero-ai-home-page '
    'vnedrenie-ai-baza-znanij-tehpodderzhka-page" role="main" tabindex="-1">\n\n'
)
full_page += hero_html + "\n\n<div class=\"vnkbz-content\">\n\n"
full_page += intro_section + "\n\n" + toc_block + "\n\n"
full_page += "\n\n".join(content_sections)
full_page += "\n\n  <!-- SCHEMA-MARKUP:INSERT -->\n\n</div>\n\n"
full_page += hero_script + "\n"
full_page += footer_scripts

out_path = Path("/workspace/wordpress/page-vnedrenie-ai-baza-znanij-tehpodderzhka.php")
out_path.write_text(full_page, encoding="utf-8")

# Post-process CTA placeholders → PHP env vars
text = out_path.read_text(encoding="utf-8")
text = re.sub(
    r'<a href="[^"]*" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn" target="_blank" rel="noopener noreferrer">[^<]*</a>',
    '<a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn" target="_blank" rel="noopener noreferrer"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>',
    text,
)
text = re.sub(
    r'<a href="[^"]*" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer">[^<]*</a>',
    '<a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>',
    text,
)
text = re.sub(
    r'<a href="[^"]*" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer">[^<]*</a>',
    '<a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>',
    text,
)
out_path.write_text(text, encoding="utf-8")
print(f"Written {out_path} ({out_path.stat().st_size} bytes)")

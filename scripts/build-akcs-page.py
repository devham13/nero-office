#!/usr/bin/env python3
"""Build page-ai-kontent-sistema-dlya-biznesa.php and handoff Natasha block."""
from __future__ import annotations

import re
from pathlib import Path

ROOT = Path("/workspace")
FRAG_ALINA = ROOT / ".cursor/nero-network-fragments/alina.md"
FRAG_BORIS = ROOT / ".cursor/nero-network-fragments/boris.md"
OUT_PHP = ROOT / "wordpress-theme/page-ai-kontent-sistema-dlya-biznesa.php"
HANDOFF = ROOT / ".cursor/nero-network-handoff.md"

def extract_html_block(path: Path) -> str:
    text = path.read_text(encoding="utf-8")
    m = re.search(r"```html\n(.*?)```", text, re.DOTALL)
    if not m:
        raise RuntimeError(f"No html block in {path}")
    return m.group(1).strip()


def php_header() -> str:
    return r'''<?php
/**
 * Template Name: AI-контент-система для бизнеса: внедрение под ключ
 * Description: AI-контент для бизнеса — темы, тексты, посты, рассылки и изображения в едином стиле. Внедрение под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-контент для бизнеса: внедрение системы под ключ';
$page_seo_description = 'Настроим AI-систему контента для бизнеса: темы, тексты, посты, рассылки и изображения в едином стиле. Внедрение под ключ — от консультации до контроля качества. Для блога, SEO и соцсетей.';

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
    ['label' => 'Система', 'href' => '#chto-takoe-sistema'],
    ['label' => 'Состав', 'href' => '#sostav-sistemy'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Настроить AI-контент';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#chto-takoe-sistema';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}

?>
'''


def page_css() -> str:
    return r'''
<style>
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

.akcs-content{
  --akcs-text:#e6edf7;--akcs-muted:#9aa8bd;--akcs-soft:#c7d2e5;--akcs-heading:#fff;
  --akcs-border:rgba(255,255,255,.10);--akcs-accent:#79f2ff;--akcs-violet:#8b5cf6;--akcs-green:#22c55e;
  --akcs-btn-from:#2563eb;--akcs-btn-to:#7c3aed;--akcs-container:1220px;
}
.akcs-content *,.akcs-content *::before,.akcs-content *::after{box-sizing:border-box}
.akcs-content a{color:inherit}
.akcs-content p{color:var(--akcs-muted);line-height:1.72;margin:0 0 1em}
.akcs-content p:last-child{margin-bottom:0}
.akcs-content h2,.akcs-content h3,.akcs-content h4{color:var(--akcs-heading);letter-spacing:-.045em;margin:0 0 .7em}
.akcs-content h3{font-size:clamp(17px,2vw,21px)}
.akcs-content strong{color:var(--akcs-soft)}
.akcs-content ul,.akcs-content ol{padding-left:0;list-style:none;margin:0 0 1em}
.akcs-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--akcs-muted);font-size:14.5px;line-height:1.65}
.akcs-content ul li::before{content:'›';position:absolute;left:0;color:var(--akcs-accent);font-weight:700}
.akcs-content ol.akcs-ol{counter-reset:akcsli}
.akcs-content ol.akcs-ol li{counter-increment:akcsli;padding-left:28px}
.akcs-content ol.akcs-ol li::before{content:counter(akcsli);font-size:11px;font-weight:800;color:var(--akcs-accent);left:0;top:1px}
.akcs-cnt{width:min(var(--akcs-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.akcs-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.akcs-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.akcs-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.akcs-sh.akcs-left{margin-left:0;text-align:left}
.akcs-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.akcs-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.akcs-sh.akcs-left p{margin-left:0}
.akcs-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--akcs-accent);margin-bottom:14px}
.akcs-gt{background:linear-gradient(92deg,#fff 0%,var(--akcs-accent) 44%,var(--akcs-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.akcs-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.akcs-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.akcs-intro-text{position:relative;padding-left:20px;text-align:left!important}
.akcs-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--akcs-accent),var(--akcs-violet))}
.akcs-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--akcs-muted);margin-bottom:1em}
.akcs-intro-text p:last-child{margin-bottom:0;color:var(--akcs-soft)}
.akcs-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.akcs-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.akcs-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--akcs-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.akcs-kpi-card .kl{font-size:11px;font-weight:600;color:var(--akcs-muted);line-height:1.4}
.akcs-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.akcs-intro-grid{grid-template-columns:1fr;gap:36px}.akcs-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.akcs-intro-kpi{grid-template-columns:1fr 1fr}}
.akcs-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.akcs-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.akcs-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.06);border:1px solid var(--akcs-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--akcs-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.akcs-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--akcs-accent);background:rgba(121,242,255,.08)}
.akcs-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--akcs-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);transition:border-color .22s,transform .22s}
.akcs-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.akcs-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.akcs-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.akcs-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
@media(max-width:960px){.akcs-grid-3,.akcs-grid-4{grid-template-columns:1fr 1fr}}
@media(max-width:768px){.akcs-grid-2,.akcs-grid-3,.akcs-grid-4{grid-template-columns:1fr}}
.akcs-pain-card{text-align:center;padding:22px 16px}
.akcs-pain-card .ico{font-size:28px;margin-bottom:10px}
.akcs-pain-card h3{font-size:15px;margin-bottom:8px}
.akcs-pain-card p{font-size:13px;margin:0}
.akcs-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.akcs-table{width:100%;border-collapse:collapse;font-size:14px}
.akcs-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--akcs-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.akcs-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--akcs-text);vertical-align:top}
.akcs-table tr:last-child td{border-bottom:none}
.akcs-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.akcs-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--akcs-accent);border:1px solid rgba(121,242,255,.2)}
.akcs-flow .arr{color:var(--akcs-muted);font-size:16px;padding:0 4px;background:none;border:none}
.akcs-timeline{position:relative;padding-left:40px}
.akcs-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--akcs-accent),var(--akcs-violet));opacity:.35;border-radius:2px}
.akcs-tl-item{position:relative;margin-bottom:32px}
.akcs-tl-item:last-child{margin-bottom:0}
.akcs-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--akcs-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.akcs-case-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}
@media(max-width:768px){.akcs-case-grid{grid-template-columns:1fr}}
.akcs-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px}
.akcs-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--akcs-green);margin-bottom:10px}
.akcs-price-badge{display:inline-flex;align-items:center;gap:10px;padding:12px 22px;border-radius:999px;background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.35);color:#bbf7d0;font-weight:800;font-size:15px;margin:20px 0}
.akcs-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.akcs-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.akcs-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--akcs-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.akcs-faq-q::after{content:'▾';font-size:13px;color:var(--akcs-accent);flex-shrink:0;transition:transform .25s}
.akcs-faq-item.open .akcs-faq-q::after{transform:rotate(180deg)}
.akcs-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--akcs-muted);line-height:1.72}
.akcs-faq-item.open .akcs-faq-a{max-height:900px;padding:0 24px 20px}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--akcs-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-link--accent{color:var(--akcs-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--akcs-btn-from),var(--akcs-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
</style>
'''


def hero_php(hero_raw: str, brand_var: str = "<?php echo esc_html($brand); ?> · AI-контент для бизнеса") -> str:
    h = hero_raw
    h = re.sub(
        r'<p class="nero-ai-eyebrow">.*?</p>',
        f'<p class="nero-ai-eyebrow">{brand_var}</p>',
        h,
        count=1,
    )
    h = h.replace(
        'href="${TELEGRAM_CHANNEL_URL}">${PRIMARY_CTA_LABEL}',
        'href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?>',
    )
    # Move inline hero style to page-level is OK — keep as in Alina fragment
    return h


def cta_primary_php() -> str:
    return r'''
<div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
  <div class="ym-cta-block__icon" aria-hidden="true">✍️</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Настроить AI-контент под ваши каналы</p>
    <p class="ym-cta-block__sub">Проведём экспресс-аудит блога, соцсетей, email и рекламы — и подготовим <strong>контент-план на AI</strong> с темами, форматами и приоритетами. Пилот 2–4 недели, первые материалы — уже на первой неделе.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>
'''


def cta_secondary_php() -> str:
    return r'''
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите сначала разобраться в AI-контенте своими силами?</p>
    <p class="ym-cta-block__sub">Перед заказом внедрения полезно понять n8n/Make, промпты, human-in-the-loop и RAG на данных бренда — так проще оценить DIY vs под ключ. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo nero_ai_external_link_attrs($secondary_cta_url); ?>><?php echo esc_html($secondary_cta_label); ?></a>.</p>
  </div>
</aside>
'''


def content_body(boris_html: str) -> str:
  return f'''
<div class="akcs-content">

  <section class="akcs-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="akcs-cnt">
      <div class="akcs-intro-grid nero-ai-reveal">
        <div class="akcs-intro-text">
          <p class="akcs-eyebrow">Лонгрид · AI-контент для бизнеса</p>
          <p>У большинства компаний с блогом, соцсетями, SEO, email и рекламой контент производится нерегулярно, в разном стиле и с непрозрачной стоимостью. <strong>AI-контент для бизнеса</strong> решает не задачу «написать один текст», а задачу <strong>управляемого конвейера</strong> — от темы до публикации в нескольких каналах.</p>
          <p><strong>Оффер Nero Network:</strong> настроим AI-систему контента под ключ — темы, тексты, посты, рассылки, изображения и контроль качества. Первый шаг — <strong>контент-план на AI</strong>; основной CTA — <strong>«Настроить AI-контент»</strong>.</p>
        </div>
        <div class="akcs-intro-kpi" aria-label="Ключевые метрики AI-контента">
          <div class="akcs-kpi-card"><div class="kv">62%</div><div class="kl">знают об AI-агентах</div><div class="ks">СберМаркетинг, 2026</div></div>
          <div class="akcs-kpi-card"><div class="kv">24%</div><div class="kl">реально используют</div><div class="ks">разрыв в РФ</div></div>
          <div class="akcs-kpi-card"><div class="kv">91%</div><div class="kl">маркетологов с AI</div><div class="ks">Jasper 2026</div></div>
          <div class="akcs-kpi-card"><div class="kv">−70%</div><div class="kl">цикл поста</div><div class="ks">кейс СберМаркетинг</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="akcs-toc-outer">
    <div class="akcs-cnt">
      <nav class="akcs-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-kontent">Почему «сыпется»</a>
        <a href="#chto-takoe-sistema">Система</a>
        <a href="#sostav-sistemy">Состав</a>
        <a href="#etapy">Этапы</a>
        <a href="#agenty">Агенты</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#integracii">Интеграции</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="akcs-section" id="pochemu-kontent">
    <div class="akcs-cnt">
      <div class="akcs-sh akcs-left nero-ai-reveal">
        <span class="akcs-eyebrow">Боль бизнеса</span>
        <h2>Почему контент «сыпется»: нерегулярность, разный стиль и высокая стоимость</h2>
        <p><strong>Коротко:</strong> у большинства компаний с блогом, соцсетями, SEO, email и рекламой контент производится нерегулярно, в разном стиле и с непрозрачной стоимостью. AI-контент для бизнеса решает задачу <strong>управляемого конвейера</strong>.</p>
      </div>
      <p class="nero-ai-reveal">По данным опроса СберМаркетинга (COSSA, 2026), <strong>62%</strong> российских маркетологов знают об AI-агентах, но только <strong>24%</strong> реально используют их в работе. При этом <strong>91%</strong> маркетологов в мире уже применяют AI (Jasper State of AI in Marketing 2026) — разрыв между знанием и внедрением в России особенно заметен.</p>
      <div class="akcs-grid-4 nero-ai-reveal" style="margin-top:28px" aria-label="Четыре боли контент-производства">
        <div class="akcs-card akcs-pain-card"><div class="ico">📅</div><h3>Нерегулярно</h3><p>Блог и соцсети обновляются «когда успеем»</p></div>
        <div class="akcs-card akcs-pain-card"><div class="ico">🎭</div><h3>Разный стиль</h3><p>Подрядчики и авторы дают разнородный голос</p></div>
        <div class="akcs-card akcs-pain-card"><div class="ico">⏳</div><h3>Долго</h3><p>От идеи до публикации — дни и недели</p></div>
        <div class="akcs-card akcs-pain-card"><div class="ico">💸</div><h3>Дорого</h3><p>Нет прозрачной цены единицы контента</p></div>
      </div>
      <div class="akcs-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="akcs-card">
          <h3>Когда ручное производство перестаёт масштабироваться</h3>
          <p>Типичная картина: блог обновляется «когда успеем», посты в VK и Telegram выходят рывками, email-рассылки откладываются. Ручной контент упирается в три потолка: <strong>скорость</strong>, <strong>стиль</strong> и <strong>стоимость</strong>.</p>
          <p>Исследование Microsoft Research по M365 Copilot (arXiv 2605.23958) показывает: в корпоративном AI доминируют задачи <strong>письма и коммуникаций</strong>. Нужна <strong>своя контент-операционная система</strong>, а не разовые запросы в ChatGPT.</p>
        </div>
        <div class="akcs-card">
          <h3>Скрытые расходы разрозненных подрядчиков</h3>
          <ul>
            <li><strong>Согласования</strong> — каждый исполнитель не знает тон бренда</li>
            <li><strong>Потери на передаче</strong> — бриф теряется между чатами</li>
            <li><strong>Дублирование</strong> — одна мысль переписывается с нуля</li>
            <li><strong>Нет аналитики</strong> — непонятна стоимость лида с блога</li>
          </ul>
          <p>Кейс PrivateSEO: стоимость контента <strong>−40%</strong>, конверсия с блога <strong>×2,1</strong>.</p>
        </div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>

  <section class="akcs-section akcs-section-alt" id="chto-takoe-sistema">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Определение</span>
        <h2>Что такое AI-контент-система для бизнеса</h2>
        <p><strong>Определение:</strong> сквозной конвейер контент-производства — от идеи и темы до черновика, редактуры, визуала, публикации и аналитики. Не подписка на ChatGPT, а управляемый процесс с единым tone of voice и QA.</p>
      </div>

      <div class="akcs-card nero-ai-reveal" style="margin-bottom:28px">
        <h3>От разовой генерации текста к управляемому контент-процессу</h3>
        <p>Разовая генерация: промпт → черновик → правки → копипаст в CMS. На следующий день — снова с нуля, без памяти бренда и SEO-кластера.</p>
        <div class="akcs-flow" aria-label="Семь шагов контент-пайплайна">
          <span>Вход</span><span class="arr">→</span>
          <span>План</span><span class="arr">→</span>
          <span>Генерация</span><span class="arr">→</span>
          <span>QA</span><span class="arr">→</span>
          <span>Человек</span><span class="arr">→</span>
          <span>Публикация</span><span class="arr">→</span>
          <span>Аналитика</span>
        </div>
        <p>По данным Forrester TEI для M365 Copilot, средняя экономия времени на <strong>content creation</strong> — <strong>34,2%</strong>. Система снимает рутину drafting, человек фокусируется на стратегии и финальной редактуре.</p>
      </div>

{boris_html}

      <div class="akcs-table-wrap nero-ai-reveal">
        <h3 style="padding:0 4px 12px">Чем система отличается от «просто ChatGPT для маркетолога»</h3>
        <table class="akcs-table" aria-label="Сравнение ChatGPT и AI-контент-системы">
          <thead><tr><th>Критерий</th><th>ChatGPT «вручную»</th><th>AI-контент-система</th></tr></thead>
          <tbody>
            <tr><td>Tone of voice</td><td>Зависит от промпта каждый раз</td><td>RAG на архиве бренда, гайдлайнах</td></tr>
            <tr><td>Качество</td><td>Риск галлюцинаций</td><td>QA-агент + human-in-the-loop</td></tr>
            <tr><td>Каналы</td><td>Один текст — один канал</td><td>Один смысл → блог, VK, email, реклама</td></tr>
            <tr><td>Интеграции</td><td>Копипаст</td><td>WordPress, amoCRM, Bitrix24, VK</td></tr>
            <tr><td>Аналитика</td><td>Нет</td><td>UTM, лиды, cost per piece</td></tr>
            <tr><td>Масштаб</td><td>Один человек</td><td>Конвейер для всей команды</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">Jasper State of AI in Marketing 2026: <strong>governance</strong> — барьер №1 при масштабировании AI (27% респондентов). Система с чеклистами и ролями редактора закрывает этот разрыв.</p>
    </div>
  </section>

  <section class="akcs-section" id="sostav-sistemy">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Архитектура</span>
        <h2>Из чего состоит AI-система контента</h2>
        <p>Темы, тексты, посты, рассылки, изображения и контроль качества — нейросети для контента лишь один слой в архитектуре.</p>
      </div>
      <div class="akcs-grid-3 nero-ai-reveal">
        <div class="akcs-card"><h3>Контент-план и кластеры</h3><p>AI мониторит тренды и SEO-семантику. Кейс СберМаркетинга: <strong>700→1200+</strong> публикаций в год, TTM <strong>×3,5</strong>.</p></div>
        <div class="akcs-card"><h3>Тексты для блога и SEO</h3><p>Структура H2/H3, SEO-кластер, RAG-база. GEO-блоки: определения, FAQ, цифры с источниками.</p></div>
        <div class="akcs-card"><h3>Посты и креативы</h3><p>Один смысл → VK, Telegram, рекламные заголовки. <strong>51%</strong> маркетологов — multi-asset generation (Jasper 2026).</p></div>
        <div class="akcs-card"><h3>Email-рассылки</h3><p>Цепочки welcome, nurture, реактивации с сегментацией из CRM. HubSpot 2026: <strong>~94%</strong> планируют AI в контенте.</p></div>
        <div class="akcs-card"><h3>Визуал</h3><p>Автогенерация обложек или ТЗ дизайнеру по утверждённому тексту — визуал не оторван от смысла.</p></div>
        <div class="akcs-card"><h3>QA и governance</h3><p>Факты, тон, CTA, запреты. Вычитка человеком <strong>10–15 мин</strong> на пост. Цитата Анны Тупикиной (СберМаркетинг).</p></div>
      </div>
    </div>
  </section>

  <section class="akcs-section akcs-section-alt" id="etapy">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Внедрение</span>
        <h2>Внедрение AI-контент-системы под ключ: этапы, сроки и роли</h2>
        <p><strong>Коротко:</strong> <strong>14–30 дней</strong>, ориентир чека <strong>100–600 тыс. ₽</strong>. Nero Network ведёт проект от аудита до передачи системы.</p>
      </div>
      <div class="akcs-timeline nero-ai-reveal">
        <div class="akcs-tl-item"><span class="akcs-tl-dot"></span><h3>Аудит каналов (3–5 дней)</h3><p>Каналы, tone of voice, узкие места. Архив контента 6–24 месяца, редакционная политика.</p></div>
        <div class="akcs-tl-item"><span class="akcs-tl-dot"></span><h3>Настройка пайплайна (7–14 дней)</h3><p>RAG-база, n8n/Make.com + LLM. Цепочка: тема → черновик → QA → статус в Notion/Bitrix24.</p></div>
        <div class="akcs-tl-item"><span class="akcs-tl-dot"></span><h3>Обучение команды (2–4 дня)</h3><p>Регламент human-in-the-loop: кто утверждает, редактирует, публикует. Олег Качалин (Rocket Tech): «ИИ приносит пользу, когда инструмент соответствует компетенциям команды».</p></div>
        <div class="akcs-tl-item"><span class="akcs-tl-dot"></span><h3>Пилот и масштабирование</h3><p><strong>2–4 недели:</strong> 20–50 единиц контента, калибровка промптов. Первые материалы — уже на первой неделе после настройки базы знаний.</p></div>
      </div>
      {cta_primary_php()}
    </div>
  </section>

  <section class="akcs-section" id="agenty">
    <div class="akcs-cnt">
      <div class="akcs-sh akcs-left nero-ai-reveal">
        <span class="akcs-eyebrow">AI-агенты</span>
        <h2>AI-автоматизация контента и AI-агенты в маркетинге</h2>
        <p>Контент-завод на AI — операционная модель: мониторинг тем, черновики, адаптация под канал, первичный фактчек по регламенту.</p>
      </div>
      <div class="akcs-grid-2 nero-ai-reveal">
        <div class="akcs-card"><h3>AI делает</h3><ul><li>Мониторинг 200+ источников</li><li>Черновики по каркасу H2/H3</li><li>Адаптация под канал и длину</li><li>Email-серии и рекламные варианты</li><li>ТЗ дизайнерам и фактчек по RAG</li></ul></div>
        <div class="akcs-card"><h3>Человек остаётся за</h3><ul><li>Стратегией и позиционированием</li><li>Финальной редактурой и юридикой</li><li>Утверждением публикаций (governance)</li><li>Интервью с экспертами</li><li>Кризисными и чувствительными темами</li></ul></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px">Типовой стек: <strong>GigaChat/YandexGPT</strong> + <strong>n8n/Make.com</strong> + <strong>WordPress</strong> + <strong>amoCRM/Bitrix24</strong>. MCP позволяет агентам обращаться к базе знаний и CMS без копипаста. MIT: <strong>95%</strong> AI-пилотов не доходят до масштабирования — системное внедрение с метриками — ответ на разрыв.</p>
    </div>
  </section>

  <section class="akcs-section akcs-section-alt" id="dlya-kogo">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит: блог, SEO, соцсети, email и реклама</h2>
        <p>Если у вас хотя бы два канала из списка, AI-контент для бизнеса окупается быстрее, чем при единичном канале.</p>
      </div>
      <div class="akcs-grid-2 nero-ai-reveal">
        <div class="akcs-card"><h3>Малый бизнес</h3><p>Заменяет хаос фрилансеров. PrivateSEO: команда 4→2, <strong>1 статья за 1 день</strong> вместо 5, бюджет <strong>~70 тыс. ₽/мес</strong> вместо 120.</p></div>
        <div class="akcs-card"><h3>Средний бизнес</h3><p>Единое ядро tone of voice при нескольких подрядчиках. СберМаркетинг: команда 6 чел., кратный прирост объёма без расширения штата.</p></div>
      </div>
    </div>
  </section>

  <section class="akcs-section" id="integracii">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Стек</span>
        <h2>Интеграции: CMS, CRM, email и SEO</h2>
      </div>
      <div class="akcs-grid-3 nero-ai-reveal">
        <div class="akcs-card"><h3>Блог и CMS</h3><p>WordPress, Tilda: черновик → редактура → публикация по расписанию. SEO-поля по шаблону, перелинковка по кластеру.</p></div>
        <div class="akcs-card"><h3>CRM и email</h3><p>amoCRM, Bitrix24: письма под стадию воронки, реактивация и промо с сегментацией.</p></div>
        <div class="akcs-card"><h3>SEO и GEO</h3><p>Мета, H2/H3, FAQ под кластер. Структурированные блоки для AI-цитирования в выдаче.</p></div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>

  <section class="akcs-section akcs-section-alt" id="stoimost">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Цена</span>
        <h2>Сколько стоит AI-контент для бизнеса</h2>
        <p>Ориентир внедрения под ключ — <strong>100–600 тыс. ₽</strong>. Точная смета зависит от каналов, интеграций и объёма пилота.</p>
        <div class="akcs-price-badge">100–600 тыс. ₽ · 14–30 дней</div>
      </div>
      <div class="akcs-grid-2 nero-ai-reveal">
        <div class="akcs-card">
          <h3>Факторы сметы</h3>
          <ul>
            <li>Число каналов (блог, соцсети, email, реклама)</li>
            <li>Интеграции CRM, CMS, аналитика</li>
            <li>Глубина RAG и объём базы знаний</li>
            <li>Визуал: автогенерация vs ТЗ дизайнерам</li>
            <li>Поддержка после пилота</li>
          </ul>
        </div>
        <div class="akcs-card">
          <h3>Что входит в «под ключ»</h3>
          <p><strong>Включено:</strong> аудит, пайплайн, RAG, промпты, пилот 20–50 единиц, обучение, документация.</p>
          <p><strong>Отдельно:</strong> подписки LLM API, индивидуальный дизайн, новые бренды, длительное сопровождение.</p>
          <p>Кейс СберМаркетинга: стоимость поста <strong>−41–52%</strong>, написание <strong>−95%</strong> — ориентир ROI, не гарантия.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="akcs-section" id="sravnenie">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Сравнение</span>
        <h2>Под ключ или своими силами</h2>
      </div>
      <div class="akcs-table-wrap nero-ai-reveal">
        <table class="akcs-table" aria-label="DIY vs внедрение под ключ">
          <thead><tr><th>Параметр</th><th>Своими силами</th><th>Под ключ (Nero Network)</th></tr></thead>
          <tbody>
            <tr><td>Срок до результатов</td><td>1–3 мес.</td><td>1–2 нед. (пилот)</td></tr>
            <tr><td>Tone of voice</td><td>Нестабильно</td><td>RAG + QA-чеклист</td></tr>
            <tr><td>Интеграции</td><td>Ручной копипаст</td><td>n8n/Make, автопубликация</td></tr>
            <tr><td>Governance</td><td>Часто отсутствует</td><td>Чеклисты, роли, регламент</td></tr>
            <tr><td>Риск масштабирования</td><td>95% пилотов не масштабируются</td><td>Пилот → метрики → масштаб</td></tr>
            <tr><td>Программист</td><td>Желателен</td><td>Не обязателен</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal"><strong>Эдуард Трубченинов</strong> (PrivateSEO): «ИИ не заменит мышление. Но уберёт рутину». Заказать внедрение стоит, если контент нужен в <strong>3+ каналах</strong>, подрядчики дают разный стиль, команда перегружена, нужны CRM/CMS-интеграции и SEO/GEO.</p>
      {cta_secondary_php()}
    </div>
  </section>

  <section class="akcs-section akcs-section-alt" id="keisy">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI-контента</h2>
      </div>
      <div class="akcs-case-grid nero-ai-reveal">
        <div class="akcs-case-card">
          <div class="akcs-case-tag">СберМаркетинг · GigaChat</div>
          <h3>Регулярный блог + соцсети</h3>
          <p>Публикации <strong>700→1200+</strong> в год, TTM <strong>×3,5</strong>, цикл поста <strong>−70%</strong>. Digital Communications Awards 2026 — «Лучшее контент-решение».</p>
        </div>
        <div class="akcs-case-card">
          <div class="akcs-case-tag">PrivateSEO · ChatGPT</div>
          <h3>SEO-конвейер для агентства</h3>
          <p>Конверсия с блога <strong>×2,1</strong>, 1 статья за 1 день вместо 5, контент-отдел 4→2 человека.</p>
        </div>
        <div class="akcs-case-card">
          <div class="akcs-case-tag">Международный паттерн</div>
          <h3>Email + реклама с единым стилем</h3>
          <p>Jasper в workflow 2X (B2B): ideation → editing в одной платформе. Cushman &amp; Wakefield — thousands of hours saved.</p>
        </div>
        <div class="akcs-case-card">
          <div class="akcs-case-tag">Nero Network</div>
          <h3>Один смысл → четыре канала</h3>
          <p>Email-блок + рекламный заголовок + пост VK + лонгрид SEO — единый tone of voice и QA перед публикацией.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="akcs-section" id="faq">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">FAQ</span>
        <h2>Частые вопросы об AI-контенте для бизнеса</h2>
      </div>
      <div class="akcs-faq nero-ai-reveal" id="akcs-faq-accordion">
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Как внедрить AI-контент для бизнеса пошагово?</div><div class="akcs-faq-a"><p>1) Аудит каналов (3–5 дней). 2) База знаний и ToV (5–7 дней). 3) Пайплайн и QA (7–14 дней). 4) Пилот 20–50 единиц (2–4 недели). 5) Обучение и масштабирование. Первый шаг — <strong>контент-план на AI</strong>.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Какие задачи решает AI-контент-система?</div><div class="akcs-faq-a"><p>Регулярный выпуск без расширения штата, единый стиль across каналов, сокращение цикла «идея → публикация», прозрачная стоимость единицы, SEO/GEO, интеграция с CRM.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Можно ли внедрить без программиста?</div><div class="akcs-faq-a"><p>Да. Nero Network настраивает n8n/Make.com, GigaChat/YandexGPT API, WordPress и CRM. Команда работает через интерфейс и регламент — без кода.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Сколько стоит AI-контент для бизнеса?</div><div class="akcs-faq-a"><p>Ориентир: <strong>100–600 тыс. ₽</strong> за внедрение под ключ. Подписки на LLM API — отдельно.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Как заказать консультацию?</div><div class="akcs-faq-a"><p>Через CTA <strong>«Настроить AI-контент»</strong> — экспресс-аудит каналов и контент-план на AI с темами и приоритетами.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Не забанит ли Google и Яндекс за AI-тексты?</div><div class="akcs-faq-a"><p>Penalize низкое качество, не AI как таковой. Human-in-the-loop, RAG, QA — стандарт системного подхода. Кейс СберМаркетинга: 1200+ публикаций в год при росте качества.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Как обеспечивается качество?</div><div class="akcs-faq-a"><p>Три уровня: RAG на данных бренда, QA-агент с чеклистом, финальная редактура человеком.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Что с персональными данными и 152-ФЗ?</div><div class="akcs-faq-a"><p>GigaChat, YandexGPT, отечественные облака. RAG на ваших данных без утечки в публичные модели. On-premise — по запросу.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Чем это отличается от Jasper или Copilot?</div><div class="akcs-faq-a"><p>Jasper — SaaS для англоязычного рынка. Copilot — enterprise Microsoft. Nero Network строит <strong>вашу систему</strong> на российском стеке с WordPress, amoCRM, VK, Telegram — под ключ.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Когда ждать первые результаты?</div><div class="akcs-faq-a"><p>Первые материалы — на <strong>первой неделе</strong> после настройки базы знаний. Пилот — <strong>2–4 недели</strong>.</p></div></div>
      </div>
    </div>
  </section>

</div>
'''


def faq_script() -> str:
    return r'''
<script>
(function(){
  var root = document.getElementById('akcs-faq-accordion');
  if (!root) return;
  root.querySelectorAll('.akcs-faq-q').forEach(function(q){
    function toggle(){ q.parentElement.classList.toggle('open'); }
    q.addEventListener('click', toggle);
    q.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); toggle(); }});
  });
})();
</script>
'''


def php_footer() -> str:
    return r'''
<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
'''


def build_php() -> str:
    hero = extract_html_block(FRAG_ALINA)
    boris = extract_html_block(FRAG_BORIS)
    parts = [
        php_header(),
        "<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>\n",
        page_css(),
        '\n<main id="primary" class="site-main nero-ai-home-page ai-kontent-sistema-dlya-biznesa-page" role="main" tabindex="-1">\n\n',
        hero_php(hero),
        "\n",
        content_body(boris),
        faq_script(),
        php_footer(),
    ]
    return "".join(parts)


def html_for_handoff(php_content: str) -> str:
    """Strip PHP for handoff artifact — replace with placeholders."""
    h = php_content
    # Remove PHP blocks
    h = re.sub(r"<\?php.*?\?>", "", h, flags=re.DOTALL)
    h = h.replace(
        'href="" target="_blank" rel="noopener noreferrer"',
        'href="${TELEGRAM_CHANNEL_URL}" target="_blank" rel="noopener noreferrer"',
    )
    # Extract from <style> through </main>
    m = re.search(r"(<style>.*?</main>)", h, re.DOTALL)
    return m.group(1) if m else h


def update_handoff(html: str, php_path: Path) -> None:
    block = f"""
=== НАТАША (HTML СТРАНИЦЫ) ===
Статус: ✅ ГОТОВО
SLUG: ai-kontent-sistema-dlya-biznesa

## Структура страницы
- Hero `#akcs-hero` (Алина, canvas `akcs-hero-canvas`)
- Введение `#intro` + оглавление `.ym-toc`
- `#pochemu-kontent` — боли + карточки 4 pain
- `#chto-takoe-sistema` — определение, 7 шагов, **блок Бориса** `#ai-kontent-sistema-dlya-biznesa-boris-block`, таблица ChatGPT vs система
- `#sostav-sistemy` — bento 6 модулей
- `#etapy` — таймлайн + CTA primary
- `#agenty`, `#dlya-kogo`, `#integracii`
- `#stoimost` — бейдж 100–600 тыс. ₽
- `#sravnenie` — таблица DIY vs под ключ + CTA secondary
- `#keisy` — 4 кейс-карточки
- `#faq` — аккордеон 10 вопросов
- Маркеры: `<!-- INTERNAL-LINKS:INSERT -->` (×2), `<!-- SCHEMA-MARKUP:INSERT -->`

## Меню шапки ($nero_ai_header_links)
Система (#chto-takoe-sistema) · Состав (#sostav-sistemy) · Этапы (#etapy) · Кейсы (#keisy) · Стоимость (#stoimost) · FAQ (#faq)

ВНИМАНИЕ: контент содержит <script> и <canvas> — при публикации обернуть в <!-- wp:html -->

{html}

## Передача пайплайну
SLUG: ai-kontent-sistema-dlya-biznesa
JSON-LD готовит **schema-markup** после Наташи; оставь `<!-- SCHEMA-MARKUP:INSERT -->` перед `</main>`.
Внутренние ссылки готовит **internal-linker** после schema-markup; оставь `<!-- INTERNAL-LINKS:INSERT -->` в теле лонгрида (1–2 места).
Контент содержит <script> (hero engine + boris canvas + reveal + FAQ) и <canvas> (hero + boris).
PHP-шаблон: `{php_path}`
"""
    handoff = HANDOFF.read_text(encoding="utf-8")
    if "=== НАТАША (HTML СТРАНИЦЫ) ===" in handoff:
        handoff = re.sub(
            r"\n=== НАТАША \(HTML СТРАНИЦЫ\) ===.*",
            block,
            handoff,
            flags=re.DOTALL,
        )
    else:
        handoff = handoff.rstrip() + "\n" + block
    HANDOFF.write_text(handoff, encoding="utf-8")


def main() -> None:
    php = build_php()
    OUT_PHP.parent.mkdir(parents=True, exist_ok=True)
    OUT_PHP.write_text(php, encoding="utf-8")
    html = html_for_handoff(php)
    update_handoff(html, OUT_PHP)
    print(f"PHP: {OUT_PHP} ({len(php)} bytes)")
    print(f"HTML handoff: {len(html)} chars")


if __name__ == "__main__":
    main()

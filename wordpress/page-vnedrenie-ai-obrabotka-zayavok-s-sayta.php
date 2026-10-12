<?php
/**
 * Template Name: AI-обработка заявок с сайта: внедрение агента под ключ
 * Description: SEO-лендинг — AI-агент для первичной обработки заявок с сайта. Кейсы, интеграции, цены. Аудит потерь за 30 минут.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-обработка заявок с сайта: внедрение агента под ключ';
$page_seo_description = 'Внедряем AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, уточняющие вопросы и передача горячего лида в CRM. Кейсы, интеграции, цены. Аудит потерь за 30 минут.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить, сколько заявок вы теряете';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}

?>

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

<style>
/* Скрыть шапку Kadence — используем nero-ai-floating-header как на главной */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header {
  display: none !important;
}
body.nero-ai-landing {
  padding-top: 0 !important;
}

/* =====================================================
   VNA PAGE — GLOBAL RESETS
   ===================================================== */
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

/* =====================================================
   VNA CONTENT ROOT — dark theme
   ===================================================== */
.vnz-content{
  --vnz-bg:#050711;--vnz-bg2:#080b17;--vnz-bg3:#0a0e1c;
  --vnz-surface:rgba(255,255,255,.072);--vnz-surface2:rgba(255,255,255,.108);
  --vnz-text:#e6edf7;--vnz-muted:#9aa8bd;--vnz-soft:#c7d2e5;--vnz-heading:#fff;
  --vnz-border:rgba(255,255,255,.10);--vnz-border-s:rgba(255,255,255,.18);
  --vnz-accent:#79f2ff;--vnz-violet:#8b5cf6;--vnz-green:#22c55e;--vnz-cyan:#79f2ff;
  --vnz-btn-from:#2563eb;--vnz-btn-to:#7c3aed;
  --vnz-shadow:0 24px 72px rgba(0,0,0,.4);
  --vnz-r:18px;--vnz-r-lg:24px;
  --vnz-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnz-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vnz-content *,.vnz-content *::before,.vnz-content *::after{box-sizing:border-box;}
.vnz-content a{color:inherit;text-decoration:none;}
.vnz-content p{color:var(--vnz-muted);line-height:1.72;margin:0 0 1em;}
.vnz-content p:last-child{margin-bottom:0;}
.vnz-content h2,.vnz-content h3,.vnz-content h4{
  color:var(--vnz-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.vnz-content strong{color:var(--vnz-soft);}
.vnz-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vnz-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--vnz-muted);font-size:14.5px;line-height:1.65;
}
.vnz-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--vnz-accent);font-weight:700;
}

/* Container */
.vnz-cnt{
  width:min(var(--vnz-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.vnz-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vnz-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.vnz-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vnz-sh.vnz-left{margin-left:0;text-align:left;}
.vnz-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vnz-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vnz-sh.vnz-left p{margin-left:0;}

/* Eyebrow */
.vnz-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vnz-accent);margin-bottom:14px;
}

/* Gradient text */
.vnz-gt{
  background:linear-gradient(92deg,#fff 0%,var(--vnz-accent) 44%,var(--vnz-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.vnz-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.vnz-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.vnz-intro-text{
  position:relative;padding-left:20px;
}
.vnz-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--vnz-accent),var(--vnz-violet));
}
.vnz-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--vnz-muted);margin-bottom:1em;
}
.vnz-intro-text p:last-child{margin-bottom:0;color:var(--vnz-soft);}
.vnz-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.vnz-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.vnz-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--vnz-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.vnz-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnz-muted);line-height:1.4;}
.vnz-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .vnz-intro-grid{grid-template-columns:1fr;gap:36px;}
  .vnz-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .vnz-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.vnz-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vnz-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.vnz-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--vnz-surface);border:1px solid var(--vnz-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--vnz-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.vnz-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--vnz-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.vnz-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--vnz-border);border-radius:var(--vnz-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.vnz-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.vnz-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vnz-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .vnz-grid-2{grid-template-columns:1fr;}
  .vnz-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .vnz-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .vnz-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.vnz-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vnz-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.vnz-level-card:hover{transform:translateY(-2px);}
.vnz-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--vnz-r) var(--vnz-r) 0 0;
}
.vnz-level-card.l1::before{background:var(--vnz-green);}
.vnz-level-card.l2::before{background:var(--vnz-accent);}
.vnz-level-card.l3::before{background:var(--vnz-violet);}
.vnz-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.vnz-level-card.l1 .vnz-level-badge{background:rgba(34,197,94,.15);color:var(--vnz-green);}
.vnz-level-card.l2 .vnz-level-badge{background:rgba(121,242,255,.15);color:var(--vnz-accent);}
.vnz-level-card.l3 .vnz-level-badge{background:rgba(139,92,246,.15);color:var(--vnz-violet);}
.vnz-level-card h3{font-size:17px;margin-bottom:10px;}
.vnz-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.vnz-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vnz-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.vnz-scenario:last-child{margin-bottom:0;}
.vnz-scenario:hover{border-color:rgba(121,242,255,.3);}
.vnz-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.vnz-scenario h3{font-size:17px;margin-bottom:8px;}
.vnz-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.vnz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vnz-table{width:100%;border-collapse:collapse;font-size:14px;}
.vnz-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--vnz-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.vnz-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--vnz-text);vertical-align:top;
}
.vnz-table tr:last-child td{border-bottom:none;}
.vnz-table tr:hover td{background:rgba(255,255,255,.03);}
.vnz-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.vnz-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.vnz-stack-layer:last-child{border-bottom:none;}
.vnz-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--vnz-accent);padding-top:2px;
}
.vnz-stack-val{font-size:14.5px;color:var(--vnz-text);}
.vnz-stack-desc{font-size:13px;color:var(--vnz-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.vnz-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vnz-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vnz-case-grid{grid-template-columns:1fr;}}
.vnz-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.vnz-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.vnz-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vnz-green);margin-bottom:10px;
}
.vnz-case-card h3{font-size:16px;margin-bottom:14px;}
.vnz-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.vnz-metric{display:flex;align-items:baseline;gap:8px;}
.vnz-metric .num{font-size:22px;font-weight:900;color:var(--vnz-accent);flex-shrink:0;letter-spacing:-.04em;}
.vnz-metric .lbl{font-size:13px;color:var(--vnz-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.vnz-timeline{position:relative;padding-left:40px;}
.vnz-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--vnz-accent),var(--vnz-violet));
  opacity:.35;border-radius:2px;
}
.vnz-tl-item{position:relative;margin-bottom:32px;}
.vnz-tl-item:last-child{margin-bottom:0;}
.vnz-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--vnz-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.vnz-tl-item h3{font-size:17px;margin-bottom:8px;}
.vnz-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.vnz-pricing-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:960px){.vnz-pricing-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vnz-pricing-grid{grid-template-columns:1fr;}}
.vnz-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.vnz-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.vnz-price-card.vnz-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.vnz-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vnz-accent);margin-bottom:10px;
}
.vnz-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.vnz-price-card .inc{font-size:13px;color:var(--vnz-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.vnz-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vnz-compare{width:100%;border-collapse:collapse;}
.vnz-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--vnz-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.vnz-compare td{
  padding:13px 16px;font-size:14px;color:var(--vnz-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.vnz-compare tr:last-child td{border-bottom:none;}
.vnz-good{color:var(--vnz-green);}
.vnz-neutral{color:var(--vnz-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.vnz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vnz-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.vnz-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnz-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.vnz-faq-q::after{
  content:'▾';font-size:13px;color:var(--vnz-accent);
  flex-shrink:0;transition:transform .25s;
}
.vnz-faq-item.open .vnz-faq-q::after{transform:rotate(180deg);}
.vnz-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--vnz-muted);line-height:1.72;
}
.vnz-faq-item.open .vnz-faq-a{max-height:600px;padding:0 24px 20px;}

/* =====================================================
   CTA BLOCKS (Artur's ym-* classes)
   ===================================================== */
.ym-cta-block{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border:1px solid rgba(121,242,255,.3);text-align:center;
}
.ym-cta-block--dual{
  background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));
  border-color:rgba(34,197,94,.3);
}
.ym-cta-block--footer-final{
  background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));
  border-color:rgba(139,92,246,.3);
}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{
  font-size:clamp(20px,2.8vw,28px);font-weight:800;
  color:#fff;margin:0 0 10px;
}
.ym-cta-block__sub{
  color:var(--vnz-muted);font-size:15px;
  margin:0 auto 22px;max-width:600px;line-height:1.7;
}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{
  display:inline-flex;align-items:center;justify-content:center;
  padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;
  text-decoration:none!important;transition:transform .2s,box-shadow .2s;
}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,
.nero-ai-home-page .ym-btn--accent{
  background:linear-gradient(135deg,var(--vnz-btn-from),var(--vnz-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(59,130,246,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--vnz-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(121,242,255,.4);background:rgba(59,130,246,.12);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* =====================================================
   CTA FINAL SECTION
   ===================================================== */
.vnz-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.vnz-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--vnz-muted);
}
.vnz-cta-checklist li::before{content:'✓';color:var(--vnz-green);font-weight:800;}

/* =====================================================
   REVEAL ANIMATION
   ===================================================== */
.nero-ai-reveal{
  opacity:0;transform:translateY(22px);
  transition:opacity .55s ease,transform .55s ease;
}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.nero-ai-delay-3{transition-delay:.36s;}

.vnz-callout{
  border-left:3px solid var(--vnz-accent);
  padding:16px 20px;margin:20px 0;
  background:rgba(121,242,255,.06);border-radius:0 14px 14px 0;
}
.vnz-callout p{margin:0;color:var(--vnz-soft)!important;text-align:left!important;}
.vnz-ol{padding-left:1.2em;margin:0 0 1em;color:var(--vnz-muted);}
.vnz-ol li{margin-bottom:.45em;line-height:1.65;}
.vnz-faq details{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;padding:0;margin-bottom:10px;
}
.vnz-faq details summary{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnz-heading);
  cursor:pointer;list-style:none;
}
.vnz-faq details summary::-webkit-details-marker{display:none;}
.vnz-faq details[open] summary{border-bottom:1px solid rgba(255,255,255,.08);}
.vnz-faq details .vnz-faq-a{padding:0 24px 20px;font-size:14.5px;color:var(--vnz-muted);line-height:1.72;}
.vnz-flow{
  display:grid;grid-template-columns:repeat(5,1fr);gap:10px;margin:28px 0;
}
.vnz-flow-step{
  text-align:center;padding:14px 10px;border-radius:14px;
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  font-size:12px;font-weight:700;color:var(--vnz-muted);
}
.vnz-flow-step strong{display:block;color:var(--vnz-accent);font-size:11px;margin-bottom:6px;}
@media(max-width:768px){.vnz-flow{grid-template-columns:1fr;}}
.ym-cta-block--secondary{
  background:linear-gradient(135deg,rgba(255,255,255,.06),rgba(121,242,255,.08));
  border-color:rgba(255,255,255,.15);text-align:left;
}
.ym-link--accent{color:var(--vnz-accent)!important;text-decoration:underline;}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-obrabotka-zayavok-s-sayta-page" role="main" tabindex="-1">

<style>
/* Hero vnz: премиальный тёмный стиль как главная meta-journal (.nero-ai-hero) */
.vnz-hero-zayavok {
  --vnz-cyan: #79f2ff;
  --vnz-amber: #fbbf24;
  --vnz-violet: #a78bfa;
  --vnz-green: #22c55e;
  --vnz-text: #e6edf7;
  --vnz-muted: #9aa8bd;
  --vnz-soft: #c7d2e5;
  --vnz-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnz-hero-zayavok.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnz-hero-zayavok::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.vnz-hero-zayavok::after {
  content: "";
  position: absolute;
  left: 58%;
  top: 12%;
  width: 760px;
  height: 760px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(251, 191, 36, .11), transparent 66%);
  filter: blur(8px);
  animation: vnzHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnzHeroGlow {
  from { opacity: .4; transform: translateX(-50%) scale(.94); }
  to { opacity: .82; transform: translateX(-50%) scale(1.05); }
}
.vnz-hero-zayavok .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnz-hero-zayavok .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnz-hero-zayavok .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.vnz-hero-zayavok .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnz-cyan) 42%, var(--vnz-amber) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnz-hero-zayavok .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnz-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnz-hero-zayavok .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--vnz-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnz-hero-zayavok .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnz-hero-zayavok .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.vnz-hero-zayavok .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnz-hero-zayavok .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 20px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  line-height: 1;
  text-decoration: none !important;
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.vnz-hero-zayavok .nero-ai-btn:hover { transform: translateY(-2px); }
.vnz-hero-zayavok .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnz-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnz-hero-zayavok .nero-ai-btn-secondary {
  color: var(--vnz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnz-hero-zayavok .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnz-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.vnz-hero-zayavok .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnz-hero-zayavok .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnz-hero-zayavok .nero-ai-dots { display: flex; gap: 7px; }
.vnz-hero-zayavok .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnz-hero-zayavok .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnz-hero-zayavok .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnz-hero-zayavok .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnz-hero-zayavok .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnz-hero-zayavok .nero-ai-window-body { padding: 16px; }
.vnz-hero-zayavok .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vnz-hero-zayavok .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnz-hero-zayavok .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.vnz-hero-zayavok .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnzPulse 1.6s infinite;
}
@keyframes vnzPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnz-hero-zayavok .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnz-hero-zayavok .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnz-hero-zayavok .nero-ai-metric span {
  display: block;
  color: var(--vnz-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnz-hero-zayavok .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnz-hero-zayavok .vnz-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(251, 191, 36, 0.16);
  background: radial-gradient(ellipse at 30% 45%, rgba(121,242,255,.09), rgba(6,10,24,.92) 72%);
}
.vnz-hero-zayavok #vnz-site-crm-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnz-hero-zayavok .nero-ai-task-stream { display: grid; gap: 8px; }
.vnz-hero-zayavok .nero-ai-task {
  display: grid;
  grid-template-columns: auto 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
  font-size: 12px;
  color: #dce8f7;
}
.vnz-hero-zayavok .nero-ai-task-icon {
  width: 28px;
  height: 28px;
  border-radius: 8px;
  display: grid;
  place-items: center;
  background: rgba(121,242,255,.12);
  font-size: 11px;
  font-weight: 800;
}
.vnz-hero-zayavok .nero-ai-task strong { display: block; color: #fff; font-size: 12px; }
.vnz-hero-zayavok .nero-ai-task span { color: var(--vnz-muted); font-size: 11px; }
.vnz-hero-zayavok .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.15);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
}
.vnz-hero-zayavok .nero-ai-status--hot {
  background: rgba(251,191,36,.18);
  color: #fde68a;
}
@media (max-width: 960px) {
  .vnz-hero-zayavok .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnz-hero-zayavok .nero-ai-dashboard { transform: none; }
  .vnz-hero-zayavok .nero-ai-metrics-grid { grid-template-columns: 1fr 1fr; }
}
</style>

<section class="nero-ai-hero vnz-hero-zayavok" id="vnz-hero-zayavok" aria-labelledby="vnz-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">AI обработка заявок · сайт → CRM</p>
      <h1 id="vnz-hero-title">AI-агент для первичной обработки заявок с сайта: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI отвечает за 5–15 секунд, уточняет запрос и передаёт горячий лид в CRM — без потерь ночных и выходных заявок</p>
      <ul class="nero-ai-badges" aria-label="Ключевые параметры">
        <li class="nero-ai-badge">SLA 5–15 сек</li>
        <li class="nero-ai-badge">amoCRM / Битрикс24</li>
        <li class="nero-ai-badge">Аудит 30 мин</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация обработки заявок с сайта">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Центр обработки заявок</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Медиана ответа</span>
              <strong>8 с</strong>
            </div>
            <div class="nero-ai-metric">
              <span>Приём заявок</span>
              <strong>24/7</strong>
            </div>
            <div class="nero-ai-metric">
              <span>Квалификация</span>
              <strong>Hot</strong>
            </div>
          </div>

          <div class="vnz-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnz-site-crm-canvas" role="img" aria-label="Анимация: заявка с сайта проходит webhook, диалог AI и попадает в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">①</span>
              <div><strong>Форма сайта → webhook</strong><span>Ночная заявка принята · 23:41</span></div>
              <span class="nero-ai-status">захват</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">②</span>
              <div><strong>Диалог AI · уточнение полей</strong><span>Услуга, срок, бюджет · confidence 0.91</span></div>
              <span class="nero-ai-status">квалиф.</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">③</span>
              <div><strong>Лид в amoCRM</strong><span>leads/complex · тег ai-qualified</span></div>
              <span class="nero-ai-status nero-ai-status--hot">crm</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">④</span>
              <div><strong>Задача менеджеру</strong><span>Telegram · позвонить за 15 мин</span></div>
              <span class="nero-ai-status">handoff</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vnz-content">

  <section class="vnz-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vnz-cnt nero-ai-container">
      <div class="vnz-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vnz-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">AI обработка заявок · сайт → CRM</p>
          <div class="vnz-callout"><p><strong>Коротко:</strong> Nero Network внедряет AI-агента между точкой входа на сайте (форма, виджет, чат) и вашей CRM. Целевой SLA первого ответа — <strong>5–15 секунд</strong>, уточняющие вопросы по вашим правилам квалификации и передача <strong>горячего лида</strong> в amoCRM или Битрикс24 с резюме диалога. Стартовый ориентир проекта — <strong>120–350 тыс. ₽</strong> плюс поддержка; первый шаг — <strong>аудит потерь заявок за 30 минут</strong>.</p></div>
<p>Заявка, оставленная в 23:40 в пятницу, не должна ждать понедельника. Пока менеджер спит, клиент сравнивает предложения конкурентов, уходит в мессенджер или просто забывает о вас. <strong>AI обработка заявок</strong> на сайте закрывает разрыв между «отправил форму» и «попал в воронку продаж» — без ручной прослойки и без потери контекста.</p>
        </div>
        <div class="vnz-intro-kpi" aria-label="Ключевые показатели SLA">
          <div class="vnz-kpi-card"><div class="kv">5–15 с</div><div class="kl">целевой SLA первого ответа</div><div class="ks">медиана на пилоте</div></div>
          <div class="vnz-kpi-card"><div class="kv">24/7</div><div class="kl">приём ночных и выходных заявок</div><div class="ks">без очереди в чате</div></div>
          <div class="vnz-kpi-card"><div class="kv">Hot</div><div class="kl">квалификация в CRM</div><div class="ks">amoCRM / Битрикс24</div></div>
          <div class="vnz-kpi-card"><div class="kv">30 мин</div><div class="kl">аудит потерь заявок</div><div class="ks">лид-магнит Nero Network</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vnz-toc-outer">
    <div class="vnz-cnt">
      <nav class="vnz-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-ostyvayut">Почему остывают</a>
        <a href="#chto-takoe-agent">Что такое агент</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta-final">Аудит</a>
      </nav>
    </div>
  </div>
<section class="vnz-section vnz-section-alt" id="pochemu-ostyvayut">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Лонгрид · ai заявки</span>
        <h2>Почему заявки с сайта остывают, пока менеджер спит</h2>
      </div>
      <div class="nero-ai-reveal nero-ai-delay-1">
        <div class="vnz-callout"><p><strong>Определение проблемы:</strong> «Остывший лид» — обращение, по которому первый содержательный контакт с компанией произошёл слишком поздно относительно момента интереса клиента. Для сайта это чаще всего ночные и выходные заявки, очередь в чате днём и форма без обратной связи.</p></div>
<p>Исследование <strong>Телфин и OkoCRM (2025)</strong> показывает: при ожидании ответа <strong>более 10 минут</strong> уходит <strong>около половины</strong> клиентов без заказа (отраслевые различия есть: в e-com B2B терпимость выше, в коммерческой медицине — до порядка часа). Источник: <a href="https://www.cnews.ru/news/line/2025-11-24_issledovanie_telfin_i" target="_blank" rel="noopener noreferrer">CNews, исследование Телфин</a>.</p>
<p>В медицине картина жёстче: по данным <strong>Callibri (2025, 605 компаний, более 1,15 млн обращений)</strong> в <strong>71%</strong> чатов ожидание ответа <strong>превышает 10 минут</strong>; средняя стоимость заявки за январь–июнь 2025 выросла с <strong>2472 до 2717 ₽</strong> (~+9,9%). Источник: <a href="https://callibri.ru/blog/issledovanie-klientskih-obrashchenij-rynka-mediciny-2025" target="_blank" rel="noopener noreferrer">Callibri, исследование рынка медицины</a>.</p>
<p>Классическое исследование <strong>speed-to-lead</strong> (MIT / InsideSales, часто цитируется агрегаторами): ответ <strong>в первые 5 минут</strong> против <strong>30 минут</strong> даёт порядка <strong>21×</strong> разницы в вероятности контакта с лидом. Это <strong>не российская выборка 2026 года</strong>, а устоявшийся ориентир для приоритизации скорости. См. пересказ: <a href="https://polza.digital/blog/skorost-otveta-na-zayavku/" target="_blank" rel="noopener noreferrer">Polza Digital</a>.</p>
<div class="vnz-callout"><p><strong>Итог:</strong> боль «потерянные заявки» — не абстракция. Она измеряется минутами ожидания, долей обращений вне рабочего времени и стоимостью лида в вашей нише.</p></div>
<h3>Сколько лидов теряет бизнес без ответа в первые минуты</h3>
<p>Точный процент для вашей компании без замера не назовёт никто честный подрядчик. Рабочая модель для <strong>аудита потерь за 30 минут</strong> (лид-магнит Nero Network):</p>
<ol class="vnz-ol">
<li>Сколько заявок приходит <strong>с 19:00 до 09:00</strong> и в выходные (доля от всех лидов с сайта).</li>
<li>Медиана времени <strong>первого ответа</strong> менеджера или робота (не «приняли заявку», а диалог).</li>
<li>Сколько карточек в CRM создаётся <strong>с пустыми полями</strong> квалификации (услуга, срок, бюджет, ЛПР).</li>
<li>Сколько лидов <strong>не получили звонок</strong> в тот же рабочий день.</li>
</ol>
<p>Даже при консервативной оценке «10% ночных заявок × половина не дождались ответа» вы получаете понятный денежный аргумент для <strong>внедрения ai в бизнес</strong> на первой линии продаж — особенно если средний чек выше стоимости одной потерянной заявки.</p>
<h3>Типичные ошибки: форма без обратной связи, чат «для галочки»</h3>
<div class="vnz-table-wrap"><table class="vnz-table"><thead><tr><th>Ошибка</th><th>Что видит клиент</th><th>Что происходит в CRM</th></tr></thead><tbody><tr><td>Только форма, автоответ «перезвоним»</td><td>Тишина после отправки</td><td>Лид без контекста, менеджер звонит «вслепую»</td></tr><tr><td>Чат без оператора ночью</td><td>«Операторы offline»</td><td>Заявка не создана или без квалификации</td></tr><tr><td>Скриптовый бот без CRM</td><td>Ответы по кнопкам</td><td>Диалог не попадает в воронку, нет задачи</td></tr><tr><td>Менеджер отвечает в мессенджере вручную</td><td>Долгое ожидание в пик</td><td>Дубли, потеря истории с сайта</td></tr></tbody></table></div>
<p><strong>Нейросеть для обработки лидов</strong> имеет смысл не как «ещё один виджет», а как <strong>слой между формой и CRM</strong> с измеримым SLA и полями квалификации — это и есть фокус услуги <strong>ai обработка заявок под ключ</strong> от Nero Network (отдельно от узких тем вроде только amoCRM, только почта+CRM или 1С/ERP).</p>
      </div>
    </div>
  </section>
<section class="vnz-section" id="chto-takoe-agent">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Лонгрид · ai заявки</span>
        <h2>Что такое AI-агент для первичной обработки заявок с сайта</h2>
      </div>
      <div class="nero-ai-reveal nero-ai-delay-1">
        <div class="vnz-callout"><p><strong>Определение:</strong> <strong>AI-агент для сайта</strong> — программный контур между точкой входа (форма, виджет чата, callback, мессенджер) и CRM. Он принимает обращение в свободной форме, отвечает в первые секунды, уточняет поля по чек-листу клиента, классифицирует лид и <strong>создаёт или обновляет карточку</strong> в CRM с резюме диалога, тегами и задачей менеджеру.</p></div>
<p>По опросу <strong>СберАналитика и Сбер Бизнес Софт (ноябрь 2025, n=559)</strong> <strong>70%</strong> компаний автоматизируют <strong>документооборот и обработку заявок</strong>; <strong>39%</strong> используют <strong>ИИ-агентов или ассистентов</strong>; CRM — у <strong>42%</strong>, чат-боты и голос — <strong>42%</strong>. Источник: <a href="https://www.sberbank.ru/ru/sberpress/all/article?newsID=8468544a-9499-4c31-96b3-442be4e798e4" target="_blank" rel="noopener noreferrer">СберПресс</a>. Рынок догоняет: для МСБ с сайтом и CRM окно конкуренции — в <strong>скорости первого касания</strong>, а не только в рекламе.</p>
<p>Тренд <strong>агентных сценариев</strong> (OpenAI for business, 2025–2026): агент выполняет <strong>действия</strong> — вызов API CRM, маршрутизация, handoff на человека — а не только генерирует текст. См. <a href="https://openai.com/business/guides-and-resources/a-practical-guide-to-building-ai-agents/" target="_blank" rel="noopener noreferrer">практический гайд OpenAI по агентам</a>.</p>
<h3>Чем агент отличается от простого чат-бота</h3>
<div class="vnz-table-wrap"><table class="vnz-table"><thead><tr><th>Уровень</th><th>Поведение</th><th>CRM</th></tr></thead><tbody><tr><td>Скрипт-бот</td><td>Ветки по кнопкам</td><td>Часто нет записи или только email</td></tr><tr><td>RAG-консультант</td><td>Ответы из базы знаний</td><td>Редко квалификация по вашим правилам</td></tr><tr><td><strong>AI-агент (agentic)</strong></td><td>Диалог + structured output + tools</td><td><strong>Создание лида/сделки</strong>, теги, задача</td></tr></tbody></table></div>
<p><strong>AI менеджер заявок</strong> в понимании Nero Network — третий уровень: <strong>ai лидогенерация</strong> начинается не с «поболтали», а с <strong>карточки в воронке</strong>, готовой к звонку.</p>
<p>Контраст с SaaS-виджетами (например, <a href="https://clora.ru/ii-bot-dlya-sayta" target="_blank" rel="noopener noreferrer">Clora</a>, <a href="https://bothelp.io/ru/chat-dlya-saita" target="_blank" rel="noopener noreferrer">BotHelp</a>): быстрый старт и база знаний уместны для простых сценариев; <strong>кастомный ai агент для сайта</strong> нужен, когда важны <strong>ваши</strong> поля квалификации, пороги Hot/Warm, интеграция с amoCRM/Битрикс24 без «универсального шаблона».</p>
<h3>Какие задачи закрывает на этапе «первый контакт»</h3>
<ul>
<li>Мгновенное подтверждение: «заявку приняли, уточню пару вопросов».</li>
<li>Сбор контакта и согласия на обработку ПДн (152-ФЗ до передачи в облако LLM).</li>
<li>Уточнение услуги, срока, бюджета, города, ЛПР — по матрице клиента, не жёсткой анкетой.</li>
<li>Скоринг и теги: горячий / тёплый / спам / эскалация.</li>
<li>Резюме диалога в примечании CRM; при Hot — задача «позвонить за N минут».</li>
<li>Эскалация на живого менеджера <strong>с полным контекстом</strong>, без повторных вопросов клиенту.</li>
</ul>
<p>Закрытие сделки, нестандартные скидки и юридически значимые обещания остаются за человеком.</p>
      </div>
    </div>
  </section>
<section
  id="vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block"
  class="bvz-root"
  aria-label="Анимация: ночная заявка с сайта — диалог AI, квалификация и передача Hot-лида в CRM"
>
<style>
/* === БОРИС: prefix bvz-, scoped внутри #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block === */
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block.bvz-root{
  padding:48px 0 56px;
  margin:40px 0;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 20px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:rgba(255,255,255,.04);
  box-shadow:0 12px 48px rgba(0,0,0,.35),0 0 0 1px rgba(121,242,255,.12);
  min-height:480px;
  backdrop-filter:blur(12px);
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-lft{
  padding:36px 32px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  background:linear-gradient(165deg,#f8fafc 0%,#f1f5f9 100%);
  border-right:1px solid rgba(148,163,184,.25);
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-lft{
    border-right:none;
    border-bottom:1px solid rgba(148,163,184,.25);
    padding:28px 22px;
  }
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0891b2;
  margin:0 0 12px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-ey::before{
  content:'';
  width:18px;height:2px;
  background:#06b6d4;
  border-radius:1px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-h3{
  font-size:clamp(19px,2.3vw,25px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 16px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-ul{
  list-style:none;
  margin:0 0 18px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:8px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(6,182,212,.12);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0e7490;
  margin-top:1px;
  font-style:normal;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:14px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-pl-g{
  background:rgba(34,197,94,.1);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.28);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-pl-c{
  background:rgba(6,182,212,.1);
  color:#0e7490;
  border:1.5px solid rgba(6,182,212,.28);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-pl-h{
  background:rgba(239,68,68,.08);
  color:#b91c1c;
  border:1.5px solid rgba(239,68,68,.25);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-rgt{
  position:relative;
  background:linear-gradient(145deg,#050711 0%,#0a1024 50%,#070b18 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bvz-rgt{min-height:360px;}
}
#bvz-lead-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bvz-cnt">
  <div class="bvz-card">
    <div class="bvz-lft">
      <span class="bvz-ey">Ночной сценарий · 23:40</span>
      <h3 class="bvz-h3">Пока офис спит: диалог, квалификация и Hot-лид уже в CRM</h3>
      <ul class="bvz-ul">
        <li><span class="bvz-ic">◎</span>Форма или виджет на сайте — webhook за доли секунды</li>
        <li><span class="bvz-ic">💬</span>AI уточняет услугу, срок и бюджет — не анкета из 15 полей</li>
        <li><span class="bvz-ic">⚡</span>Целевой ответ <strong>5–15 с</strong> — медиана, не обещание на каждый запрос</li>
        <li><span class="bvz-ic">📋</span>Карточка в amoCRM / Битрикс24 с тегом <code>ai-qualified</code> и задачей менеджеру</li>
      </ul>
      <div class="bvz-pills">
        <span class="bvz-pl bvz-pl-c">SLA 8 с · демо</span>
        <span class="bvz-pl bvz-pl-h">Hot · скоринг 86</span>
        <span class="bvz-pl bvz-pl-g">24/7 без выходных</span>
      </div>
      <p class="bvz-foot">Дальше — пошаговая схема «сайт → AI → CRM → менеджер» в разделе «Как работает» →</p>
    </div>
    <div class="bvz-rgt">
      <canvas
        id="bvz-lead-pipeline-canvas"
        role="img"
        aria-label="Анимация: ночная заявка с сайта проходит диалог с AI, получает скоринг Hot и попадает в карточку CRM с уведомлением менеджеру"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bvz-lead-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, fr = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    cyan:'#79f2ff',
    cyanD:function(a){ return 'rgba(121,242,255,'+a+')'; },
    viol:'#a78bfa',
    violD:function(a){ return 'rgba(167,139,250,'+a+')'; },
    hot:'#f87171',
    hotD:function(a){ return 'rgba(248,113,113,'+a+')'; },
    green:'#4ade80',
    text:'#e2e8f0',
    muted:'rgba(226,232,240,.45)',
    card:'rgba(255,255,255,.07)',
    bdr:'rgba(255,255,255,.14)',
    site:'#1e293b',
    widget:'#0f172a'
  };

  var LOOP = 640;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect){ ctx.roundRect(x,y,w,h,r); }
    else {
      ctx.moveTo(x+r,y); ctx.arcTo(x+w,y,x+w,y+h,r);
      ctx.arcTo(x+w,y+h,x,y+h,r); ctx.arcTo(x,y+h,x,y,r);
      ctx.arcTo(x,y,x+w,y,r); ctx.closePath();
    }
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawGrid(){
    ctx.strokeStyle='rgba(121,242,255,.04)';
    ctx.lineWidth=1;
    var step = 28;
    for(var gx=0;gx<W;gx+=step){
      ctx.beginPath(); ctx.moveTo(gx,0); ctx.lineTo(gx,H); ctx.stroke();
    }
    for(var gy=0;gy<H;gy+=step){
      ctx.beginPath(); ctx.moveTo(0,gy); ctx.lineTo(W,gy); ctx.stroke();
    }
  }

  function drawSitePanel(t){
    var sx = W*0.06, sy = H*0.12, sw = W*0.38, sh = H*0.76;
    rr(sx,sy,sw,sh,10,C.site,C.bdr);
    rr(sx,sy,sw,22,10,'#334155',null);
    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('ваш-сайт.ru · виджет', sx+10, sy+14);

    var wx = sx+sw*0.55, wy = sy+sh*0.52, ww = sw*0.4, wh = sh*0.42;
    rr(wx,wy,ww,wh,8,C.widget,C.cyanD(0.35));

    var phase = (t % LOOP) / LOOP;
    var bubbles = [
      {who:'v', text:'Запись на консультацию', at:0.05},
      {who:'a', text:'Приняли! Уточню срок?', at:0.18},
      {who:'v', text:'Нужно на этой неделе', at:0.32},
      {who:'a', text:'Бюджет в вилке 80–120?', at:0.46}
    ];
    var by = wy+14;
    bubbles.forEach(function(b){
      if(phase < b.at) return;
      var alpha = Math.min(1,(phase-b.at)*8);
      var isAi = b.who === 'a';
      var bw = Math.min(ww-16, ctx.measureText(b.text).width + (isAi?28:24));
      if(bw < 60) bw = 60;
      var bx = isAi ? wx+8 : wx+ww-bw-8;
      ctx.globalAlpha = alpha;
      rr(bx,by,bw,20,6,isAi?'rgba(6,182,212,.25)':'rgba(255,255,255,.12)',C.bdr);
      ctx.fillStyle=C.text;
      ctx.font='9px Inter,system-ui,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(b.text, bx+6, by+13);
      ctx.globalAlpha = 1;
      by += 26;
    });

    if(phase > 0.08){
      var pulse = 0.5+0.5*Math.sin(fr*0.12);
      rr(sx+12,sy+sh-36,sw-24,24,6,C.cyanD(0.08+0.06*pulse),C.cyanD(0.5));
      ctx.fillStyle=C.cyan;
      ctx.font='bold 9px Inter,system-ui,sans-serif';
      ctx.fillText('webhook → оркестратор', sx+20, sy+sh-20);
    }
  }

  function drawOrchestrator(t){
    var ox = W*0.48, oy = H*0.38, or = Math.min(W,H)*0.09;
    var phase = (t % LOOP) / LOOP;
    var glow = 0.15+0.12*Math.sin(fr*0.08);
    ctx.beginPath();
    ctx.arc(ox,oy,or+14,0,Math.PI*2);
    ctx.fillStyle=C.violD(glow);
    ctx.fill();
    ctx.beginPath();
    ctx.arc(ox,oy,or,0,Math.PI*2);
    ctx.fillStyle='rgba(139,92,246,.35)';
    ctx.fill();
    ctx.strokeStyle=C.viol;
    ctx.lineWidth=2;
    ctx.stroke();
    ctx.fillStyle=C.text;
    ctx.font='bold 10px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('LLM', ox, oy+4);

    var fields = ['Услуга','Срок','Бюджет','ЛПР'];
    fields.forEach(function(lbl,i){
      var show = phase > 0.35 + i*0.08;
      if(!show) return;
      var fx = ox - 52 + (i%2)*56;
      var fy = oy + or + 18 + Math.floor(i/2)*22;
      var a = Math.min(1,(phase-0.35-i*0.08)*6);
      ctx.globalAlpha = a;
      rr(fx,fy,48,16,4,C.card,C.bdr);
      ctx.fillStyle=C.muted;
      ctx.font='8px Inter,system-ui,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(lbl, fx+24, fy+11);
      ctx.globalAlpha = 1;
    });

    if(phase > 0.62){
      var score = Math.min(86, Math.floor((phase-0.62)*400));
      var sx2 = ox-30, sy2 = oy-or-28;
      rr(sx2,sy2,60,18,5,C.hotD(0.2),C.hot);
      ctx.fillStyle='#fecaca';
      ctx.font='bold 9px Inter,system-ui,sans-serif';
      ctx.fillText('Hot '+score, sx2+30, sy2+12);
    }
  }

  function drawCrmCard(t){
    var cx = W*0.72, cy = H*0.22, cw = W*0.24, ch = H*0.55;
    var phase = (t % LOOP) / LOOP;
    var slide = phase < 0.55 ? 0 : Math.min(1,(phase-0.55)*4);
    var ox = cx + (1-slide)*40;

    rr(ox,cy,cw,ch,10,C.card,C.bdr);
    ctx.fillStyle=C.text;
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('amoCRM · лид', ox+12, cy+20);

    if(slide > 0.2){
      var rows = [
        'Имя: Анна К.',
        'Тел: +7 ···',
        'Услуга: консультация',
        'Срок: эта неделя',
        'Тег: ai-qualified'
      ];
      rows.forEach(function(row,i){
        var ry = cy+36+i*22;
        rr(ox+10,ry,cw-20,16,4,'rgba(255,255,255,.05)',C.bdr);
        ctx.fillStyle=C.muted;
        ctx.font='8px Inter,system-ui,sans-serif';
        ctx.fillText(row, ox+16, ry+11);
      });
    }

    if(phase > 0.78){
      var ping = 0.5+0.5*Math.sin(fr*0.15);
      rr(ox+10,cy+ch-32,cw-20,22,6,'rgba(34,197,94,'+(0.12+0.1*ping)+')',C.green);
      ctx.fillStyle=C.green;
      ctx.font='bold 9px Inter,system-ui,sans-serif';
      ctx.fillText('Задача: позвонить за 15 мин', ox+18, cy+ch-17);
    }
  }

  function drawPacket(t){
    var phase = (t % LOOP) / LOOP;
    if(phase < 0.58 || phase > 0.88) return;
    var p = (phase-0.58)/0.3;
    var x0 = W*0.42, y0 = H*0.5, x1 = W*0.7, y1 = H*0.45;
    var px = x0 + (x1-x0)*p;
    var py = y0 + (y1-y0)*p - Math.sin(p*Math.PI)*30;
    ctx.beginPath();
    ctx.arc(px,py,6,0,Math.PI*2);
    ctx.fillStyle=C.hot;
    ctx.fill();
    ctx.strokeStyle=C.cyan;
    ctx.lineWidth=1.5;
    ctx.stroke();
  }

  function drawClock(){
    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,system-ui,sans-serif';
    ctx.textAlign='right';
    ctx.fillText('пт · 23:42 · офис offline', W-14, 22);
    ctx.beginPath();
    ctx.arc(W-28,18,5,0,Math.PI*2);
    ctx.fillStyle=C.cyanD(0.35);
    ctx.fill();
  }

  function drawConnectors(){
    ctx.strokeStyle=C.cyanD(0.25);
    ctx.lineWidth=1.5;
    ctx.setLineDash([4,6]);
    ctx.beginPath();
    ctx.moveTo(W*0.44,H*0.5);
    ctx.lineTo(W*0.48,H*0.42);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(W*0.56,H*0.42);
    ctx.lineTo(W*0.7,H*0.45);
    ctx.stroke();
    ctx.setLineDash([]);
  }

  function frame(){
    fr++;
    var t = fr;
    ctx.clearRect(0,0,W,H);
    drawGrid();
    drawClock();
    drawSitePanel(t);
    drawOrchestrator(t);
    drawCrmCard(t);
    drawPacket(t);
    drawConnectors();
    requestAnimationFrame(frame);
  }
  requestAnimationFrame(frame);
})();
</script>
</section>
<section class="vnz-section vnz-section-alt" id="kak-rabotaet">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Лонгрид · ai заявки</span>
        <h2>Как работает сценарий: сайт → AI → CRM → менеджер</h2>
      </div>
      <div class="nero-ai-reveal nero-ai-delay-1">
        <div class="vnz-flow nero-ai-reveal" aria-label="Схема: сайт → AI → CRM">
  <div class="vnz-flow-step"><strong>1</strong>Форма / чат</div>
  <div class="vnz-flow-step"><strong>2</strong>Webhook</div>
  <div class="vnz-flow-step"><strong>3</strong>Диалог AI</div>
  <div class="vnz-flow-step"><strong>4</strong>Запись в CRM</div>
  <div class="vnz-flow-step"><strong>5</strong>Задача менеджеру</div>
</div>
<div class="vnz-callout"><p><strong>Коротко:</strong> событие на сайте → webhook → оркестратор (n8n / Make / Python) → LLM с guardrails → API CRM → уведомление менеджеру.</p></div>
<p>Типовая цепочка (проектная модель Nero Network):</p>
<ol class="vnz-ol">
<li><strong>Событие:</strong> отправка формы или первое сообщение в виджете.</li>
<li><strong>Подтверждение пользователю</strong> (шаблон + персонализация).</li>
<li><strong>Диалог LLM</strong> с structured output (JSON Schema): поля квалификации, уверенность, следующий шаг.</li>
<li>При достаточности данных — <strong><code>POST /api/v4/leads/complex</code></strong> в amoCRM или <strong><code>crm.lead.add</code></strong> в Битрикс24 + тег <code>ai-qualified</code>.</li>
<li><strong>Уведомление</strong> ответственному (Telegram, email); для Hot — задача с дедлайном.</li>
<li>При низкой уверенности — статус «требует менеджера», без авто-цен и сроков вне базы знаний.</li>
</ol>
<p>Документация amoCRM по complex-сделкам: <a href="https://www.amocrm.ru/developers/content/crm_platform/leads-api" target="_blank" rel="noopener noreferrer">Leads API</a>. Практика OAuth и сценариев n8n: <a href="https://kalinkindev.ru/blog/n8n-scenario-leads-amocrm/" target="_blank" rel="noopener noreferrer">Kalinkindev</a>.</p>
<p>Международный паттерн (адаптируем под РФ): webhook → enrichment → scoring → CRM → Slack/Telegram — см. шаблон <a href="https://www.atherial.ai/how-to-build-an-ai-powered-lead-qualification-agent-with-n8n-free-template-dxpr2e" target="_blank" rel="noopener noreferrer">Atherial + n8n</a>. Квалификация с handoffs: <a href="https://callsphere.ai/blog/building-lead-qualification-chat-agent-openai" target="_blank" rel="noopener noreferrer">Callsphere, OpenAI Agents SDK</a>.</p>
<h3>Ответ за 5–15 секунд: что происходит внутри</h3>
<p>Целевой SLA <strong>5–15 секунд</strong> из коммерческого ТЗ достижим как <strong>медиана end-to-end</strong>, но не как гарантия на каждый запрос.</p>
<p><strong>Из чего складывается задержка:</strong></p>
<ol class="vnz-ol">
<li>Webhook с сайта — обычно <strong>менее 1 с</strong>.</li>
<li>Очередь (Redis, serverless cold start) — риск в пиках.</li>
<li>Вызов LLM (1–3 раунда на первый ответ) — <strong>2–10+ с</strong> (модель, длина промпта, rate limits).</li>
<li>Запись в CRM — <strong>0,5–3 с</strong>; обновление OAuth-токена может дать всплеск.</li>
<li>Уведомление менеджеру — параллельно с записью в CRM.</li>
</ol>
<p><strong>Риски:</strong> throttling API LLM; длинное первое сообщение пользователя; модерация (цены, сроки, медицина — только из KB или эскалация). Fallback: «заявку приняли, менеджер свяжется» + создание черновика лида.</p>
<p><strong>Метрики для договора (без выдуманных процентов ROI):</strong> медиана времени первого ответа, доля ответов &lt;15 с, доля эскалаций, доля лидов с заполненными обязательными полями CRM, время до первого звонка менеджера.</p>
<h3>Квалификация: вопросы, скоринг, теги лида</h3>
<p>Вместо анкеты из 15 полей — <strong>5–8 вопросов в логике диалога</strong> (проектный дизайн Nero Network). Пример порогов (адаптируется под нишу):</p>
<div class="vnz-table-wrap"><table class="vnz-table"><thead><tr><th>Статус</th><th>Условия (пример)</th><th>Действие в CRM</th></tr></thead><tbody><tr><td>Hot</td><td>Срок «срочно», бюджет в вилке, ЛПР на связи</td><td>Задача «позвонить за 15 мин», приоритет</td></tr><tr><td>Warm</td><td>Интерес есть, срок > месяца</td><td>Воронка nurture, звонок в SLA дня</td></tr><tr><td>Cold</td><td>Общий вопрос, нет контакта</td><td>Подписка / база, без обещаний скидки</td></tr><tr><td>Spam / эскалация</td><td>Оскорбления, юридический спор</td><td>human_review, без автоответов по цене</td></tr></tbody></table></div>
<p>Скоринг 0–100 и авто-handoff при Hot ≥80 — практика из европейских внедрений (см. <a href="https://techspheredynamics.com/2026/02/13/how-we-built-an-ai-agent-to-qualify-leads-in-business-central/" target="_blank" rel="noopener noreferrer">Tech Sphere Dynamics</a>); переносим логику в FAQ «как агент решает, кому звонить первым».</p>
<h3>Эскалация на живого менеджера без потери контекста</h3>
<p>Агент передаёт: полный текст диалога, извлечённые поля, причину эскалации («вопрос вне базы знаний», «клиент просит человека», «медицинский дисклеймер»). Менеджер видит карточку CRM, а не сырой чат на сайте. <strong>BitrixGPT в CRM</strong> (штатно) анализирует <strong>уже состоявшиеся</strong> чаты и звонки; он <strong>не заменяет</strong> ответ гостю на сайте в 3 ночи — см. <a href="https://helpdesk.bitrix24.ru/open/27045426/" target="_blank" rel="noopener noreferrer">справка Битрикс24</a>. Позиция Nero: штатный ИИ CRM <strong>дополняет</strong>, а не конкурирует с <strong>ai консультант на сайт</strong> для первого касания.</p>
      </div>
    </div>
  </section>
<div class="vnz-cnt"><aside class="ym-cta-block ym-cta-block--primary" id="cta-kak-rabotaet">
  <div class="ym-cta-block__icon" aria-hidden="true">⚡</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Проверьте SLA первого ответа на заявки с сайта</p>
    <p class="ym-cta-block__sub">За 30 минут разберём ночные и выходные лиды, медиану ответа и пробелы в CRM — без обязательства запускать пилот.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside></div>
<section class="vnz-section" id="scenarii">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Лонгрид · ai заявки</span>
        <h2>Где ставить агента: виджет, чат, форма заявки</h2>
      </div>
      <div class="nero-ai-reveal nero-ai-delay-1">
        <p><strong>Универсального победителя нет</strong> — каналы дополняют друг друга (обзоры YAGLA, Agent604, ЧБТ).</p>
<div class="vnz-table-wrap"><table class="vnz-table"><thead><tr><th>Сценарий</th><th>Форма</th><th>Чат / AI-виджет</th></tr></thead><tbody><tr><td>Клиент уже решил, нужен только контакт</td><td>Сильнее</td><td>Слабее</td></tr><tr><td>Вопрос до заявки («цена», «срок», «запись»)</td><td>Не закрывает</td><td>Сильнее</td></tr><tr><td>Ночь и выходные</td><td>Автоответ «перезвоним»</td><td><strong>AI-агент</strong> ведёт диалог и CRM</td></tr><tr><td>B2B услуги, клиники, школы</td><td>Pre-chat форма + диалог (гибрид)</td><td>Оптимум</td></tr></tbody></table></div>
<p><strong>Осторожно с цифрами конверсии:</strong> в материалах агентств встречаются оценки <strong>+33–50%</strong> лидов у чата против формы; Drift в пересказах QForm — <strong>8,2%</strong> против <strong>3,1%</strong> посетителей в лиды. Это <strong>вторичные источники</strong>, не норма для вашего трафика. Сравнивать нужно <strong>на своём</strong> сайте (A/B: форма vs AI-чат).</p>
<p><strong>Рекомендация внедрения под ключ:</strong> триггеры на <strong>форму (webhook)</strong>, <strong>виджет чата</strong> и при необходимости <strong>мессенджер</strong> → единый контур квалификации → одна воронка CRM. Так работает <strong>автоматизация через ai обработка заявок</strong> без разрозненных «островков» данных.</p>
<h3>Сравнение сценариев для МСБ (услуги, школы, клиники)</h3>
<div class="vnz-table-wrap"><table class="vnz-table"><thead><tr><th>Ниша</th><th>Точка входа</th><th>Поля в CRM (типовой набор)</th><th>Особенности</th></tr></thead><tbody><tr><td>Услуги B2B</td><td>Форма + чат</td><td>Услуга, объём, срок, бюджет, ЛПР</td><td>Длинный цикл, важен скоринг</td></tr><tr><td>Онлайн-школа</td><td>Виджет на лендинге курса</td><td>Курс, опыт, цель, мессенджер</td><td>Много однотипных FAQ</td></tr><tr><td>Клиника</td><td>Запись + чат</td><td>Услуга, врач/филиал, дата, телефон</td><td>Дисклеймеры, без мед. советов от AI</td></tr><tr><td>Производство B2B</td><td>Форма КП</td><td>Объём, номенклатура, регион</td><td>Кейс <a href="https://yunkis.ru/cases/chat-bot-integraciya-s-bitrix24" target="_blank" rel="noopener noreferrer">Юнкис ИИ + Битрикс24</a></td></tr></tbody></table></div>
<p>По данным интегратора Юнкис (без независимого аудита): к <strong>второму месяцу</strong> заявлен рост <strong>скорости обработки в 6 раз</strong> при передаче заявок из каналов сразу в CRM. Цифру используем как <strong>пример заявления подрядчика</strong>, не как гарантию для каждого проекта.</p>
      </div>
    </div>
  </section>
<section class="vnz-section vnz-section-alt" id="integracii">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Лонгрид · ai заявки</span>
        <h2>Интеграции с CRM и полями лида</h2>
      </div>
      <div class="nero-ai-reveal nero-ai-delay-1">
        <p>Страница <strong>не</strong> подменяет отдельные материалы про «только amoCRM», «почта + CRM» или «1С/ERP». Здесь фокус — <strong>заявка с сайта</strong> и <strong>интеграция ai обработка заявок с crm</strong> в типовом стеке МСБ.</p>
<p><strong>amoCRM:</strong> создание сделки с контактом через <strong><code>/api/v4/leads/complex</code></strong> (до 50 сделок за запрос, кастомные поля). Пример внедрения квалификации: <a href="https://mrboroai.ru/cases/ai-agent-lead-qualification-amocrm" target="_blank" rel="noopener noreferrer">MrBoro AI — кейс amoCRM</a> — ответ за секунды 24/7, поля объёма/сроков/бюджета, сделка через API; сроки первого контура у источника <strong>2–8 недель</strong>. Честный критерий входа у того же интегратора: агент не нужен, если менеджер <strong>стабильно</strong> отвечает за минуты.</p>
<p><strong>Битрикс24:</strong> REST <strong><code>crm.lead.add</code></strong>, задачи с контекстом; гибрид YandexGPT/GigaChat и зарубежных моделей в проектах — <a href="https://inteltek.ru/cases/integraciya-s-retailcrm-bitriks24-amocrm" target="_blank" rel="noopener noreferrer">Inteltek</a> (152-ФЗ, токены с ограниченными правами).</p>
<p>Оркестрация: <strong>Make</strong>, <strong>n8n</strong>, custom Python; телефония (UIS и др.) — опционально, как в кейсах MrBoro.</p>
<h3>Какие данные передаём в CRM автоматически</h3>
<ul>
<li>Контакт: телефон, email, имя, мессенджер.</li>
<li>Квалификация: услуга/продукт, срок, бюджет (если уместно), город, источник (UTM, страница).</li>
<li>Теги: <code>ai-qualified</code>, <code>hot</code> / <code>warm</code>, нишевые теги.</li>
<li>Текст: резюме диалога в примечании; ссылка на лог при необходимости.</li>
<li>Задача ответственному с дедлайном для Hot.</li>
<li>События аналитики: <code>ai_dialog_complete</code>, <code>crm_lead_created</code> в Яндекс.Метрике.</li>
</ul>
      </div>
    </div>
  </section>
<section class="vnz-section" id="etapy">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Лонгрид · ai заявки</span>
        <h2>Внедрение под ключ: этапы, сроки, что нужно от заказчика</h2>
      </div>
      <div class="nero-ai-reveal nero-ai-delay-1">
        <p><strong>Внедрение ai обработка заявок под ключ</strong> в Nero Network — это не «поставили виджет», а цикл: аудит → дизайн квалификации → база знаний → пилот → 24/7 → метрики.</p>
<div class="vnz-table-wrap"><table class="vnz-table"><thead><tr><th>Этап</th><th>Содержание</th><th>Срок (ориентир)</th></tr></thead><tbody><tr><td>1. Аудит</td><td>Карта входов, медиана ответа, воронка CRM</td><td><strong>30 минут</strong> (лид-магнит) + углубление</td></tr><tr><td>2. Дизайн</td><td>Вопросы, поля CRM, пороги Hot/Warm</td><td>3–5 рабочих дней</td></tr><tr><td>3. KB и guardrails</td><td>FAQ, прайс, запрет галлюцинаций</td><td>1–2 недели</td></tr><tr><td>4. Пилот</td><td>Один канал (например, форма «Записаться»)</td><td><strong>2–3 недели</strong></td></tr><tr><td>5. Масштаб</td><td>Виджет, мессенджеры, обучение менеджеров</td><td>1–2 недели</td></tr><tr><td>6. Поддержка</td><td>Донастройка промптов, SLA-дашборд</td><td>ongoing</td></tr></tbody></table></div>
<p>Сроки <strong>2–8 недель</strong> на первый контур совпадают с публичными кейсами интеграторов (MrBoro, <a href="https://mbk-agent.ru/vozmozhnosti/obrabotka-zayavok-ii" target="_blank" rel="noopener noreferrer">MBK-Agent</a> — пилот <strong>7–14 дней</strong> у источника). <strong>Как внедрить ai обработка заявок</strong> без остановки продаж: начать с одного канала и измеримых метрик, не «всё сразу».</p>
<p><strong>Что нужно от заказчика:</strong> доступ к CRM (OAuth), тексты FAQ и регламенты, матрица квалификации, ответственный за приёмку диалогов, политика ПДн для виджета.</p>
<p><strong>Барьеры внедрения ИИ в РФ (ВШЭ / Росстат, 2024):</strong> у крупных и средних пользователей ИИ — <strong>затраты (58%)</strong>, инфраструктура, кадры, данные; <strong>48%</strong> заявляют об отсутствии потребности. Источник: <a href="https://issek.hse.ru/news/1083541394.html" target="_blank" rel="noopener noreferrer">ИСИЭЗ ВШЭ</a>. Для МСБ аргумент проще: <strong>один</strong> измеримый процесс (заявка с сайта) и пилот с понятным чеком.</p>
<h3>Аудит текущего пути заявки (лид-магнит 30 минут)</h3>
<p>Чек-лист аудита:</p>
<ul>
<li>Все формы и чаты на сайте (включая лендинги).</li>
<li>Доля заявок вне рабочего времени.</li>
<li>Фактическая медиана ответа (не SLA в презентации).</li>
<li>Поля, которые менеджер дописывает вручную после звонка.</li>
<li>Дубли лидов (форма + звонок + чат).</li>
</ul>
<p>Результат — одна страница «карта потерь» и гипотеза ROI без магических процентов.</p>
<h3>Пилот, обучение на FAQ компании, запуск 24/7</h3>
<p>Пилот на <strong>реальных</strong> заявках (оффер в духе MBK-Agent и Nero): смотрим спорные диалоги, правим промпт и KB, фиксируем SLA. Менеджеры учатся читать карточку с резюме AI, а не переспрашивать клиента. После стабилизации — <strong>ai бот для сайта</strong> и webhook форм работают <strong>круглосуточно</strong>.</p>
<p><strong>Когда агент не нужен (честный фильтр Nero):</strong> стабильный ответ менеджеров за 1–2 минуты 24/7; мизерный поток заявок; достаточно CRM-робота без свободного диалога; нет CRM — сначала воронка, потом AI.</p>
      </div>
    </div>
  </section>
<div class="vnz-cnt"><aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать логику до старта пилота?</p>
    <p class="ym-cta-block__sub">На этапе «дизайн квалификации» полезно разобрать промпты, guardrails и human-in-the-loop — см. <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет приёмку сценария на сайте.</p>
  </div>
</aside></div>
<section class="vnz-section vnz-section-alt" id="ceny">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Лонгрид · ai заявки</span>
        <h2>Стоимость и состав работ</h2>
      </div>
      <div class="nero-ai-reveal nero-ai-delay-1">
        <p><strong>Ключевой запрос:</strong> ai обработка заявок цена. Публичный ориентир из ТЗ темы: <strong>120–350 тыс. ₽</strong> стартовое внедрение <strong>плюс поддержка</strong>. Итог зависит от числа каналов, глубины интеграции CRM, требований 152-ФЗ и выбора LLM (YandexGPT, GigaChat, гибрид).</p>
<h3>Ориентир чека 120–350 тыс. ₽ и что входит</h3>
<p>Типовой состав:</p>
<ul>
<li>Аудит и ТЗ на квалификацию.</li>
<li>Настройка оркестратора и webhook.</li>
<li>Промпт, JSON Schema, guardrails (цены/сроки только из KB).</li>
<li>Интеграция amoCRM или Битрикс24 (одна CRM в базе; вторая — по смете).</li>
<li>Виджет или подключение существующего чата.</li>
<li>Пилот и обучение команды.</li>
<li>Базовый дашборд SLA (медиана первого ответа).</li>
</ul>
<p>Сравнение «дорого» — со <strong>стоимостью потерянной заявки</strong> (рост CPL в медицине Callibri, отток при 10+ минутах ожидания Телфин), а не только с абоненткой SaaS-виджета.</p>
<h3>Поддержка и доработка сценариев</h3>
<p>Поддержка: мониторинг лимитов API, обновление KB, разбор эскалаций, сезонные правки (акции, новые услуги). <strong>Настройка ai обработка заявок</strong> — живой процесс: меняется прайс, меняется промпт.</p>
      </div>
    </div>
  </section>
<section class="vnz-section" id="keisy">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Лонгрид · ai заявки</span>
        <h2>Кейсы и примеры внедрения</h2>
      </div>
      <div class="nero-ai-reveal nero-ai-delay-1">
        <p><strong>Дисклеймер:</strong> цифры эффективности ниже — <strong>со стороны интеграторов и вендоров</strong>, без независимого аудита Nero Network, если не указано иное.</p>
<ol class="vnz-ol">
<li><strong>MrBoro AI + amoCRM</strong> — квалификация по объёму, срокам, бюджету; сделка через API; <a href="https://mrboroai.ru/cases/ai-agent-lead-qualification-amocrm" target="_blank" rel="noopener noreferrer">кейс</a>.</li>
<li><strong>Юнкис ИИ + Битрикс24</strong> — заявки из каналов в CRM без ручного ввода; заявлен рост скорости обработки <strong>в 6 раз</strong> к месяцу 2; <a href="https://yunkis.ru/cases/chat-bot-integraciya-s-bitrix24" target="_blank" rel="noopener noreferrer">кейс</a>.</li>
<li><strong>Inteltek</strong> — сайт и мессенджеры → RetailCRM / B24 / amoCRM; РФ-модели и compliance; <a href="https://inteltek.ru/cases/integraciya-s-retailcrm-bitriks24-amocrm" target="_blank" rel="noopener noreferrer">кейс</a>.</li>
<li><strong>Международный паттерн</strong> — BANT, structured output, handoffs sales/nurture; <a href="https://callsphere.ai/blog/building-lead-qualification-chat-agent-openai" target="_blank" rel="noopener noreferrer">Callsphere</a>.</li>
</ol>
<p><strong>Пример внедрения ai обработка заявок</strong> для вашей ниши на пилоте важнее чужого PDF: те же шаги webhook → AI → CRM, но <strong>ваши</strong> поля и <strong>ваш</strong> SLA.</p>
      </div>
    </div>
  </section>
<section class="vnz-section vnz-section-alt" id="dlya-kogo">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Лонгрид · ai заявки</span>
        <h2>Для кого подходит: малый и средний бизнес</h2>
      </div>
      <div class="nero-ai-reveal nero-ai-delay-1">
        <p>Запрос <strong>ai обработка заявок для малого бизнеса</strong> закрывается не «урезанной версией», а <strong>фокусом на одном канале</strong> и типовой CRM. <strong>Внедрение ai в бизнес процессы</strong> продаж начинается с узкого контура — заявка с сайта — без ERP и без замены всей телефонии.</p>
<h3>Услуги и запись</h3>
<p>Салоны, ремонт, B2B-услуги: ночные заявки, уточнение объёма работ, передача Hot в CRM к утру.</p>
<h3>Онлайн-школы</h3>
<p>Повторяющиеся вопросы о программе, рассрочке, старте потока; сбор мессенджера; тег курса в amoCRM/B24.</p>
<h3>Клиники и медицинские услуги</h3>
<p>Запись на приём, филиал, направление; <strong>без</strong> медицинских рекомендаций от модели — только регламент и эскалация; учёт исследования Callibri про долгие ответы в чатах.</p>
<p><strong>Внедрение нейросетей в бизнес</strong> на входящих заявках — практичный первый шаг при уже работающем сайте и CRM (<strong>42%</strong> компаний в опросе Сбера используют CRM — см. выше).</p>
      </div>
    </div>
  </section>
<section class="vnz-section" id="faq">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Лонгрид · ai заявки</span>
        <h2>FAQ по внедрению AI-обработки заявок</h2>
      </div>
      <div class="nero-ai-reveal nero-ai-delay-1">
        <div class="vnz-faq">
<details class="nero-ai-reveal"><summary>Сколько стоит ai обработка заявок?</summary><div class="vnz-faq-a"><p>Ориентир <strong>120–350 тыс. ₽</strong> за старт «под ключ» + поддержка; точная смета после аудита каналов и CRM.</p></div></details>
<details class="nero-ai-reveal"><summary>Как внедрить ai обработка заявок без риска для продаж?</summary><div class="vnz-faq-a"><p>Пилот 2–3 недели на одном входе, метрики SLA и доли заполненных полей CRM, эскалация на человека при низкой уверенности.</p></div></details>
<details class="nero-ai-reveal"><summary>Какая интеграция ai обработка заявок с crm поддерживается?</summary><div class="vnz-faq-a"><p>Типовой фокус: <strong>amoCRM</strong> (<code>leads/complex</code>) и <strong>Битрикс24</strong> (<code>crm.lead.add</code>). Другие системы — по ТЗ.</p></div></details>
<details class="nero-ai-reveal"><summary>Есть ли пример внедрения ai обработка заявок в моей нише?</summary><div class="vnz-faq-a"><p>Публичные кейсы интеграторов (MrBoro, Юнкис, Inteltek) — в разделе выше; ваш <strong>пример</strong> формируется на пилоте.</p></div></details>
<details class="nero-ai-reveal"><summary>Где посмотреть ai обработка заявок кейсы?</summary><div class="vnz-faq-a"><p>Ссылки на кейсы интеграторов в разделе «Кейсы»; цифры — с пометкой источника.</p></div></details>
<details class="nero-ai-reveal"><summary>Подходит ли это для малого бизнеса?</summary><div class="vnz-faq-a"><p>Да, при потоке заявок с сайта и готовности поддерживать KB; иначе сначала CRM и базовая форма.</p></div></details>
<details class="nero-ai-reveal"><summary>Чем это отличается от ai бот для сайта из коробки?</summary><div class="vnz-faq-a"><p>Кастомная квалификация, запись в <strong>вашу</strong> воронку, guardrails и SLA, а не только FAQ-виджет.</p></div></details>
<details class="nero-ai-reveal"><summary>Заменит ли BitrixGPT ваш агент?</summary><div class="vnz-faq-a"><p>Нет для <strong>первого ответа посетителю на сайте</strong>; BitrixGPT сильнее в пост-анализе уже состоявшихся чатов в CRM.</p></div></details>
<details class="nero-ai-reveal"><summary>Какие сроки внедрения ai агентов?</summary><div class="vnz-faq-a"><p>Первый рабочий контур часто <strong>2–8 недель</strong> (кейсы рынка); ускорение — узкий пилот на одной форме.</p></div></details>
<details class="nero-ai-reveal"><summary>Безопасны ли персональные данные?</summary><div class="vnz-faq-a"><p>Согласие в форме/виджете, 152-ФЗ, по возможности российский контур (Yandex Cloud, YandexGPT/GigaChat) — по политике клиента.</p></div></details>
<details class="nero-ai-reveal"><summary>Что если AI ошибётся в цене?</summary><div class="vnz-faq-a"><p>Цены и сроки — только из базы знаний или эскалация; запрет авто-обещаний вне KB.</p></div></details>
</div>
      </div>
    </div>
  </section>
<section class="vnz-section" id="cta-final" aria-label="Проверка потерь заявок">
  <div class="vnz-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Проверить, сколько заявок вы теряете</p>
        <p class="ym-cta-block__sub">Аудит потерь заявок за 30 минут: карта входов (форма, чат, виджет), доля ночных лидов и гипотеза внедрения AI-агента без обязательства покупать пилот.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>
</section>
  <!-- INTERNAL-LINKS:INSERT -->

  <!-- SCHEMA-MARKUP:INSERT -->
</div>
</main>

<script>
/**
 * vnz-site-lead-engine — Диспетчерская «Сайт → webhook → AI → CRM»
 * Классы сцены: WebhookPulseLanes, QualificationConsole, CrmVaultDock (не Conveyor / WebsiteTerminal)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnz-site-crm-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    scale = Math.min(cw / 440, ch / 280) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    panel: "#1e293b",
    cyan: "#79f2ff",
    amber: "#fbbf24",
    green: "#22c55e",
    violet: "#a78bfa",
    widget: "#0f172a",
    bubbleUser: "rgba(121,242,255,0.2)",
    bubbleAi: "rgba(167,139,250,0.25)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Импульсы по дугам webhook */
  function WebhookPulseLanes() {
    this.t = 0;
  }
  WebhookPulseLanes.prototype.draw = function (ctx) {
    this.t = (frame * 0.03) % (Math.PI * 2);
    var lanes = [
      { y0: -55, amp: 28, hue: C.cyan, label: "форма" },
      { y0: -15, amp: 22, hue: C.violet, label: "чат" },
      { y0: 25, amp: 18, hue: C.amber, label: "callback" }
    ];
    lanes.forEach(function (lane, idx) {
      ctx.strokeStyle = lane.hue;
      ctx.globalAlpha = 0.35;
      ctx.lineWidth = 1.5;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      for (var i = 0; i <= 24; i++) {
        var t = i / 24;
        var x = -170 + t * 200;
        var y = lane.y0 + Math.sin(t * Math.PI * 1.2 + idx) * lane.amp;
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
      }
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.globalAlpha = 1;

      var pulseT = (this.t + idx * 0.9) % (Math.PI * 2);
      var pt = pulseT / (Math.PI * 2);
      var px = -170 + pt * 200;
      var py = lane.y0 + Math.sin(pt * Math.PI * 1.2 + idx) * lane.amp;
      drawRR(ctx, px - 6, py - 5, 12, 10, 3, lane.hue, C.outline);
    }, this);

    /* Мини-виджет на сайте (слева) */
    drawRR(ctx, -165, -78, 52, 36, 6, C.widget, C.outline);
    drawRR(ctx, -158, -72, 38, 8, 2, C.cyan, null);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("сайт", -155, -64);
    drawRR(ctx, -158, -58, 30, 6, 2, "rgba(255,255,255,0.15)", null);
    drawRR(ctx, -158, -48, 22, 6, 2, "rgba(255,255,255,0.1)", null);
  };

  /* Центральная консоль квалификации */
  function QualificationConsole() {
    this.flash = 0;
  }
  QualificationConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    drawRR(ctx, -48, -70, 96, 130, 10, C.panel, C.outline);
    drawRR(ctx, -42, -64, 84, 18, 4, "rgba(255,255,255,0.06)", C.outline);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI · квалификация", 0, -52);

    /* SLA-секундомер */
    var sec = 5 + Math.floor((prg % 60) / 4);
    drawRR(ctx, 28, -68, 34, 14, 4, "rgba(251,191,36,0.2)", C.amber);
    ctx.fillStyle = C.amber;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.fillText(sec + " с", 45, -58);

    if (prg > 20 && prg < 140) {
      drawRR(ctx, -38, -38, 52, 14, 4, C.bubbleUser, C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("Нужна запись", -12, -28);
    }
    if (prg > 45 && prg < 160) {
      drawRR(ctx, -10, -20, 58, 14, 4, C.bubbleAi, C.outline);
      ctx.fillStyle = "#ede9fe";
      ctx.fillText("Уточню срок?", 19, -10);
    }
    if (prg > 70 && prg < 180) {
      var chips = ["Hot", "услуга", "тел."];
      chips.forEach(function (c, i) {
        drawRR(ctx, -36 + i * 28, 2, 24, 12, 3, i === 0 ? "rgba(251,191,36,0.35)" : "rgba(34,197,94,0.2)", C.outline);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.fillText(c, -24 + i * 28, 10);
      });
    }

    if (prg >= 140 && prg < 200) {
      this.flash = Math.sin((prg - 140) * 0.2) * 0.5 + 0.5;
      ctx.strokeStyle = "rgba(121,242,255," + (0.4 + this.flash * 0.4) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(48, 10);
      ctx.lineTo(95, 10);
      ctx.stroke();
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("CRM API", 72, 6);
    }
  };

  /* Док стыковки CRM + финал handoff */
  function CrmVaultDock() {
    this.cardY = 40;
    this.ping = 0;
  }
  CrmVaultDock.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    drawRR(ctx, 98, -55, 58, 100, 8, "rgba(15,23,42,0.95)", C.outline);
    ctx.fillStyle = C.green;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM", 127, -42);

    if (prg >= 155) {
      var local = Math.min(1, (prg - 155) / 25);
      this.cardY = 40 - local * 55;
      drawRR(ctx, 108, this.cardY, 38, 26, 5, "rgba(34,197,94,0.28)", C.green);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Лид", 127, this.cardY + 11);
      ctx.font = "6px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("#Hot", 127, this.cardY + 20);
    }

    if (prg >= 185 && prg < 215) {
      this.ping = (prg - 185) / 30;
      ctx.strokeStyle = "rgba(251,191,36," + (0.9 - this.ping * 0.85) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(127, this.cardY + 13, 8 + this.ping * 35, 0, Math.PI * 2);
      ctx.stroke();
      /* TelegramPingBeacon */
      drawRR(ctx, 118, -72, 22, 14, 4, "rgba(251,191,36,0.25)", C.amber);
      ctx.fillStyle = C.amber;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("TG", 129, -62);
    }
  };

  function NightShiftClock() {
    this.hour = 23;
  }
  NightShiftClock.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    if (prg > 10 && prg < 200) {
      drawRR(ctx, -155, 48, 40, 16, 4, "rgba(255,255,255,0.06)", C.outline);
      ctx.fillStyle = "#94a3b8";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("23:41", -135, 59);
    }
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var prg = (frame * 0.045) % 220;
    var targets = {
      "1_architect": { x: -105, y: 42 },
      "2_seo": { x: -55, y: 52 },
      "3_coder": { x: 0, y: 58 },
      "4_designer": { x: 55, y: 52 },
      "5_deployer": { x: 105, y: 42 }
    };
    var tgt = targets[this.role] || { x: 0, y: 50 };
    var isMoving = false;
    var faceDir = 1;

    if (prg >= this.stepTrig && prg < this.stepTrig + 20) {
      var local = prg - this.stepTrig;
      if (local < 10) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 10);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 10);
      } else if (local < 14) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 14) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 14) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 210 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 210);
    }

    var bob = Math.sin(this.timer * 1.4) * 1.1;
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -10, -8 - bob, 20, 14, 4, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -18 - bob, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.restore();
  };

  var bubbles = [];
  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 200, max: life || 200 });
  }

  var entities = [
    new WebhookPulseLanes(),
    new NightShiftClock(),
    new QualificationConsole(),
    new CrmVaultDock(),
    new Agent(-130, 72, C.agentYellow, "1_architect", 18, [
      "Webhook на форму…",
      "Три входа: форма, чат, callback",
      "Схема сайта → CRM ок"
    ]),
    new Agent(-75, 78, C.agentGreen, "2_seo", 52, [
      "Поля квалификации в CRM",
      "Ночной интент — запись",
      "LSI: ai обработка заявок"
    ]),
    new Agent(-20, 82, C.agentBlue, "3_coder", 88, [
      "POST /leads/complex",
      "Очередь < 1 с",
      "Guardrails на цену"
    ]),
    new Agent(35, 78, C.agentPink, "4_designer", 124, [
      "Ответ виджета за 8 с",
      "Тон диалога — деловой",
      "UX: без анкеты на 15 полей"
    ]),
    new Agent(90, 72, C.agentPurple, "5_deployer", 162, [
      "Тег ai-qualified",
      "Задача менеджеру в TG",
      "Handoff без потери контекста"
    ])
  ];

  if (frame === 1) {
    createBubble(-40, -90, "Заявка с лендинга в 23:41", 240);
    createBubble(0, -95, "Уточняю срок и услугу…", 240);
    createBubble(120, -30, "Hot → amoCRM", 240);
    createBubble(125, -75, "Менеджер: звонок за 15 мин", 240);
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cw / 2, ch / 2 + 8);
    ctx.scale(scale, scale);

    entities.forEach(function (e) { e.draw(ctx); });

    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = b.life / b.max;
      drawRR(ctx, b.x - 40, b.y - 18, 80, 16, 4, "rgba(15,23,42," + (0.85 * alpha) + ")", C.cyan);
      ctx.fillStyle = "rgba(226,232,240," + alpha + ")";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 6);
    }

    ctx.restore();
    requestAnimationFrame(loop);
  }
  loop();
});
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

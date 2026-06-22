<?php
/**
 * Template Name: Нейросети для amoCRM: квалификация лидов и автозаполнение сделок
 * Description: Внедрим AI в amoCRM: нейросеть квалифицирует лиды, автозаполняет карточки сделок и держит заявки под контролем.
 */

declare(strict_types=1);

$page_seo_title       = 'Нейросети для amoCRM: квалификация лидов под ключ';
$page_seo_description = 'Внедрим AI в amoCRM: нейросеть квалифицирует лиды, автозаполняет карточки сделок и держит заявки под контролем. Схема, кейсы, цена. Оценить amoCRM.';

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
    ['label' => 'Квалификация', 'href' => '#kvalifikaciya-lidov'],
    ['label' => 'Автозаполнение', 'href' => '#avtozapolnenie'],
    ['label' => 'Схема', 'href' => '#shema-vnedreniya'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Оценить amoCRM';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение по внедрению AI';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '';

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
.vna-content{
  --vna-bg:#050711;--vna-bg2:#080b17;--vna-bg3:#0a0e1c;
  --vna-surface:rgba(255,255,255,.072);--vna-surface2:rgba(255,255,255,.108);
  --vna-text:#e6edf7;--vna-muted:#9aa8bd;--vna-soft:#c7d2e5;--vna-heading:#fff;
  --vna-border:rgba(255,255,255,.10);--vna-border-s:rgba(255,255,255,.18);
  --vna-accent:#79f2ff;--vna-violet:#8b5cf6;--vna-green:#22c55e;--vna-cyan:#79f2ff;
  --vna-btn-from:#2563eb;--vna-btn-to:#7c3aed;
  --vna-shadow:0 24px 72px rgba(0,0,0,.4);
  --vna-r:18px;--vna-r-lg:24px;
  --vna-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vna-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vna-content *,.vna-content *::before,.vna-content *::after{box-sizing:border-box;}
.vna-content a{color:inherit;text-decoration:none;}
.vna-content p{color:var(--vna-muted);line-height:1.72;margin:0 0 1em;}
.vna-content p:last-child{margin-bottom:0;}
.vna-content h2,.vna-content h3,.vna-content h4{
  color:var(--vna-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.vna-content strong{color:var(--vna-soft);}
.vna-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vna-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--vna-muted);font-size:14.5px;line-height:1.65;
}
.vna-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--vna-accent);font-weight:700;
}

/* Container */
.vna-cnt{
  width:min(var(--vna-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.vna-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vna-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.vna-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vna-sh.vna-left{margin-left:0;text-align:left;}
.vna-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vna-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vna-sh.vna-left p{margin-left:0;}

/* Eyebrow */
.vna-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-accent);margin-bottom:14px;
}

/* Gradient text */
.vna-gt{
  background:linear-gradient(92deg,#fff 0%,var(--vna-accent) 44%,var(--vna-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.vna-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.vna-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.vna-intro-text{
  position:relative;padding-left:20px;
}
.vna-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--vna-accent),var(--vna-violet));
}
.vna-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--vna-muted);margin-bottom:1em;
}
.vna-intro-text p:last-child{margin-bottom:0;color:var(--vna-soft);}
.vna-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.vna-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.vna-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--vna-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.vna-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vna-muted);line-height:1.4;}
.vna-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .vna-intro-grid{grid-template-columns:1fr;gap:36px;}
  .vna-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .vna-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.vna-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vna-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.vna-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--vna-surface);border:1px solid var(--vna-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--vna-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.vna-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--vna-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.vna-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--vna-border);border-radius:var(--vna-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.vna-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.vna-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vna-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .vna-grid-2{grid-template-columns:1fr;}
  .vna-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .vna-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .vna-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.vna-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vna-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.vna-level-card:hover{transform:translateY(-2px);}
.vna-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--vna-r) var(--vna-r) 0 0;
}
.vna-level-card.l1::before{background:var(--vna-green);}
.vna-level-card.l2::before{background:var(--vna-accent);}
.vna-level-card.l3::before{background:var(--vna-violet);}
.vna-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.vna-level-card.l1 .vna-level-badge{background:rgba(34,197,94,.15);color:var(--vna-green);}
.vna-level-card.l2 .vna-level-badge{background:rgba(121,242,255,.15);color:var(--vna-accent);}
.vna-level-card.l3 .vna-level-badge{background:rgba(139,92,246,.15);color:var(--vna-violet);}
.vna-level-card h3{font-size:17px;margin-bottom:10px;}
.vna-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.vna-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vna-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.vna-scenario:last-child{margin-bottom:0;}
.vna-scenario:hover{border-color:rgba(121,242,255,.3);}
.vna-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.vna-scenario h3{font-size:17px;margin-bottom:8px;}
.vna-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.vna-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vna-table{width:100%;border-collapse:collapse;font-size:14px;}
.vna-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--vna-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.vna-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--vna-text);vertical-align:top;
}
.vna-table tr:last-child td{border-bottom:none;}
.vna-table tr:hover td{background:rgba(255,255,255,.03);}
.vna-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.vna-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.vna-stack-layer:last-child{border-bottom:none;}
.vna-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--vna-accent);padding-top:2px;
}
.vna-stack-val{font-size:14.5px;color:var(--vna-text);}
.vna-stack-desc{font-size:13px;color:var(--vna-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.vna-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vna-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vna-case-grid{grid-template-columns:1fr;}}
.vna-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.vna-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.vna-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-green);margin-bottom:10px;
}
.vna-case-card h3{font-size:16px;margin-bottom:14px;}
.vna-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.vna-metric{display:flex;align-items:baseline;gap:8px;}
.vna-metric .num{font-size:22px;font-weight:900;color:var(--vna-accent);flex-shrink:0;letter-spacing:-.04em;}
.vna-metric .lbl{font-size:13px;color:var(--vna-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.vna-timeline{position:relative;padding-left:40px;}
.vna-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--vna-accent),var(--vna-violet));
  opacity:.35;border-radius:2px;
}
.vna-tl-item{position:relative;margin-bottom:32px;}
.vna-tl-item:last-child{margin-bottom:0;}
.vna-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--vna-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.vna-tl-item h3{font-size:17px;margin-bottom:8px;}
.vna-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.vna-pricing-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:960px){.vna-pricing-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vna-pricing-grid{grid-template-columns:1fr;}}
.vna-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.vna-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.vna-price-card.vna-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.vna-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-accent);margin-bottom:10px;
}
.vna-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.vna-price-card .inc{font-size:13px;color:var(--vna-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.vna-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vna-compare{width:100%;border-collapse:collapse;}
.vna-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--vna-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.vna-compare td{
  padding:13px 16px;font-size:14px;color:var(--vna-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.vna-compare tr:last-child td{border-bottom:none;}
.vna-good{color:var(--vna-green);}
.vna-neutral{color:var(--vna-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.vna-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vna-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.vna-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--vna-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.vna-faq-q::after{
  content:'▾';font-size:13px;color:var(--vna-accent);
  flex-shrink:0;transition:transform .25s;
}
.vna-faq-item.open .vna-faq-q::after{transform:rotate(180deg);}
.vna-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--vna-muted);line-height:1.72;
}
.vna-faq-item.open .vna-faq-a{max-height:600px;padding:0 24px 20px;}

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
  color:var(--vna-muted);font-size:15px;
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
  background:linear-gradient(135deg,var(--vna-btn-from),var(--vna-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(59,130,246,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--vna-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(121,242,255,.4);background:rgba(59,130,246,.12);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* =====================================================
   CTA FINAL SECTION
   ===================================================== */
.vna-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.vna-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--vna-muted);
}
.vna-cta-checklist li::before{content:'✓';color:var(--vna-green);font-weight:800;}

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

/* Hero full viewport */
.nero-ai-hero{min-height:100vh;min-height:100dvh;position:relative;}
.ym-cta-block--secondary{
  background:rgba(255,255,255,.04);
  border:1px solid rgba(255,255,255,.12);
  text-align:left;
}
.ym-link--accent{color:var(--vna-accent);text-decoration:underline;}
.ym-link--accent:hover{color:#fff;}
.vna-content code{
  background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;
}
</style>

<main id="primary" class="site-main nero-ai-home-page nejroseti-kvalifikaciya-lidov-amocrm-page" role="main" tabindex="-1">

<section class="nero-ai-hero" id="hero" aria-labelledby="hero-nejroseti-amocrm-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · нейросети для amoCRM</p>
      <h1 id="hero-nejroseti-amocrm-title">Нейросети для amoCRM: <span class="nero-ai-gradient-text">квалификация лидов и автозаполнение сделок под ключ</span></h1>
      <p class="nero-ai-hero-lead">Заявки не зависают вручную: AI квалифицирует лиды, заполняет карточки и держит сделки под контролем в amoCRM</p>
      <ul class="nero-ai-badges" aria-label="Ключевые модули">
        <li class="nero-ai-badge">Квалификация лидов</li>
        <li class="nero-ai-badge">Автозаполнение</li>
        <li class="nero-ai-badge">Контроль SLA</li>
        <li class="nero-ai-badge">amoCRM API</li>
        <li class="nero-ai-badge">MAX/Telegram</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kvalifikaciya-lidov">Как квалифицирует AI</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: модуль квалификации amoCRM">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">amoCRM · модуль квалификации</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Квалификация и автозаполнение</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Заявки</span><strong>18</strong><small>сегодня</small></div>
            <div class="nero-ai-metric"><span>Ответ</span><strong>&lt;1 мин</strong><small>первичный</small></div>
            <div class="nero-ai-metric"><span>Поля</span><strong>94%</strong><small>автозаполнение</small></div>
            <div class="nero-ai-metric"><span>SLA</span><strong>0</strong><small>просрочек</small></div>
          </div>
          <div class="nero-ai-task-stream">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">IN</span>
              <div><strong>Заявка</strong><span>Telegram / форма сайта</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Квалификация BANT</strong><span>score 82 · горячий лид</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Поля сделки</strong><span>бюджет · срок · продукт</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">→</span>
              <div><strong>Задача менеджеру</strong><span>SLA 15 мин · переговоры</span></div>
              <span class="nero-ai-status nero-ai-status--new">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vna-content">

<!-- INTRO -->
  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · нейросети для amoCRM</p>
          <p><strong>Коротко:</strong> нейросети для amoCRM в узком смысле — это не «чат-бот на сайте», а операционный модуль: входящее обращение квалифицируется по правилам отдела продаж, поля сделки заполняются автоматически, а воронка остаётся под контролем SLA.</p>
          <p>amoCRM у вас уже есть. Но если заявки обрабатываются с задержками, карточки заполняются вручную, а менеджеры тратят время на однотипные уточнения — CRM превращается в архив незавершённых диалогов, а не в систему роста выручки.</p>
          <p><strong>Определение:</strong> <em>AI amocrm для бизнеса</em> в формате Nero Network — связка «квалификация лидов → автозаполнение карточек → контроль сделок», встроенная в вашу воронку, а не универсальный «AI-агент под ключ» на все случаи жизни.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые показатели скорости ответа">
          <div class="vna-kpi-card">
            <div class="kv">47 ч</div>
            <div class="kl">средний ответ на B2B-лид в мире</div>
            <div class="ks">Optifai, N=939</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">23%</div>
            <div class="kl">компаний отвечают в первые 5 минут</div>
            <div class="ks">Optifai, 2025–2026</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">×21</div>
            <div class="kl">шанс квалификации при ответе за 5 мин</div>
            <div class="ks">vs 30 минут</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">87%</div>
            <div class="kl">sales-организаций уже используют AI</div>
            <div class="ks">Salesforce State of Sales 2026</div>
          </div>
        </div>
      </div>
      <div class="vna-intro-text nero-ai-reveal" style="margin-top:28px;padding-left:20px;">
        <p>Глобальный контекст 2026 подтверждает сдвиг: в отчёте Salesforce State of Sales (7-е издание, n=4&nbsp;050) <strong>AI и AI-агенты названы тактикой №1 роста</strong>; продавцы с AI <strong>в 3,7 раза</strong> чаще выполняют квоту. В amoCRM официально развиваются AI-агент и ассистент «Амма» (релиз «Весна 2026»). Но без правил квалификации и SLA <strong>AI ускоряет хаос</strong>, а не продажи — поэтому мы продаём <strong>модуль дисциплины воронки</strong>.</p>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="smeshnye-materialy" aria-label="Смежные материалы по AI в CRM">
    <div class="vna-cnt">
      <div class="vna-card nero-ai-reveal" style="padding:22px 26px">
        <p style="margin:0;font-size:15px"><strong>Смежные материалы:</strong> этот лонгрид про узкий модуль квалификации и автозаполнения в amoCRM. Если нужен полный AI-слой на все процессы отдела продаж — смотрите <a href="/vnedrenie-ai-amocrm/" class="ym-link ym-link--accent">внедрение AI-агента в amoCRM под ключ</a>. Для компаний, где заявки уходят в учёт 1С и ERP, полезен сценарий <a href="/ai-1c-erp/" class="ym-link ym-link--accent">AI-агента для 1С и ERP</a>.</p>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#kvalifikaciya-lidov">Квалификация</a>
        <a href="#avtozapolnenie">Автозаполнение</a>
        <a href="#kontrol-sdelok">Контроль</a>
        <a href="#integracii">Интеграции</a>
        <a href="#sravnenie">Сравнение</a>
        <a href="#shema-vnedreniya">Схема</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- #kvalifikaciya-lidov -->
  <section class="vna-section" id="kvalifikaciya-lidov">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Квалификация</span>
        <h2>Как нейросеть квалифицирует лиды в amoCRM</h2>
        <p><strong>Определение:</strong> <em>Квалификация лидов amocrm</em> — автоматическое определение намерения, приоритета и готовности к покупке по заданным правилам отдела продаж, с фиксацией результата в полях CRM и передачей менеджеру «готовой» сделки.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <h3>Скоринг и приоритет заявок по правилам отдела продаж</h3>
        <p>Нейросеть не «угадывает» ценность лида — она применяет вашу матрицу: бюджет, срок, продукт, город, формат, источник. На выходе — score и тег: горячий, тёплый, нецелевой, спам.</p>
        <p>Методика NOVA для типового внедрения описывает правило «квалифицирован» = <strong>N из M обязательных полей + контакт</strong>. В кейсе автозапчастей конверсия «обращение → квалифицированный лид» выросла с <strong>22% до 33%</strong> при сокращении времени первого ответа с <strong>15 минут до 1 минуты</strong>.</p>
        <p>Скоринг лидов amocrm нейросетью особенно эффективен на входящем потоке. Salesforce внутри использует агентов для «неприкосновённых» лидов: за 4 месяца обработано <strong>130&nbsp;000 лидов</strong> и создано <strong>3&nbsp;200 opportunities</strong>.</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:20px;">
        <div class="vna-card">
          <h3>Автотеги, поля и этапы воронки</h3>
          <p>После диалога из 3–6 вопросов (BANT или ваш чек-лист) AI фиксирует:</p>
          <ul>
            <li>услугу / продукт, город и формат;</li>
            <li>срок и бюджет (диапазон);</li>
            <li>ЛПР или роль контакта;</li>
            <li>источник и намерение (купить / поддержка / нецелевой).</li>
          </ul>
          <p>Поля заполняются через API amoCRM (<code>custom_fields_values</code>) или виджет маркетплейса. В примечании — сводка диалога для менеджера.</p>
        </div>
        <div class="vna-card">
          <h3>Маршрутизация лида на менеджера по SLA</h3>
          <ul>
            <li>горячий лид → ответственный по продукту / региону;</li>
            <li>задача менеджеру с дедлайном SLA (например, 15 минут);</li>
            <li>при просрочке — эскалация РОПу;</li>
            <li>нецелевой — отдельная ветка воронки или nurture.</li>
          </ul>
          <p>Так отвечает на запрос «как ai квалифицирует лиды в amocrm»: <strong>сценарий + порог полей + маршрутизация</strong>.</p>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Чек-лист полей для квалификации (типовой SMB)</h3>
        <div class="vna-table-wrap">
          <table class="vna-table" aria-label="Чек-лист полей квалификации">
            <thead>
              <tr><th>Поле</th><th>Зачем</th></tr>
            </thead>
            <tbody>
              <tr><td>Продукт / услуга</td><td>Маршрутизация на нужного менеджера</td></tr>
              <tr><td>Город / регион</td><td>Географическое распределение</td></tr>
              <tr><td>Срок</td><td>Приоритет «горячих»</td></tr>
              <tr><td>Бюджет (диапазон)</td><td>Скоринг и фильтр нецелевых</td></tr>
              <tr><td>Формат (онлайн / офлайн)</td><td>Подготовка к встрече</td></tr>
              <tr><td>Роль контакта</td><td>B2B: ЛПР или не ЛПР</td></tr>
              <tr><td>Источник</td><td>Аналитика каналов</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- #avtozapolnenie -->
  <section class="vna-section vna-section-alt" id="avtozapolnenie">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Автозаполнение</span>
        <h2>Автозаполнение карточек сделок нейросетью</h2>
        <p><strong>Определение:</strong> <em>Автозаполнение карточек сделок amocrm нейросеть</em> — извлечение сущностей из текста, формы, звонка или мессенджера и запись в поля контакта/сделки без ручного ввода менеджером.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <h3>Из формы, звонка и мессенджера — в поля amoCRM</h3>
        <p>Каналы входа в 2026:</p>
        <ul>
          <li><strong>MAX</strong> — штатный канал amoCRM, автосоздание сделок из переписки;</li>
          <li>Telegram, WhatsApp, VK;</li>
          <li>формы сайта (amoForms, внешние webhook);</li>
          <li><strong>телефония</strong> — Voice AI (cmdf5) или исходящие ИИ-агенты SL Soft: STT → LLM-анализ → PATCH полей.</li>
        </ul>
        <p>Техническая цепочка: <strong>webhook → оркестратор (n8n / Make / Albato) → LLM → API <code>/api/v4/leads/{id}</code></strong> + note со сводкой.</p>
        <p>Паттерн из международной практики (Sybill): менеджер говорит или пишет — AI структурирует стадию, next steps, BANT/MEDDPICC. Экономия на CRM-админке — <strong>4–6 ч/нед</strong>.</p>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Контроль качества данных и единый формат карточки</h3>
        <p>Автозаполнение работает только при <strong>карте полей</strong>: какие <code>field_id</code> заполняет AI, какие — только человек, какие обязательны для перехода этапа.</p>
        <ul>
          <li>валидация формата (телефон, email, диапазон бюджета);</li>
          <li>human-in-the-loop / approval в n8n перед записью в CRM;</li>
          <li>тег «пустая карточка» для сделок без обязательных полей;</li>
          <li>единый тон и структура сводки в примечании.</li>
        </ul>
        <p>Без единого формата РОП не видит аналитику. AI закрывает разрыв между перепиской и CRM.</p>
      </div>
    </div>
  </section>

  <!-- #kontrol-sdelok -->
  <section class="vna-section" id="kontrol-sdelok">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Контроль воронки</span>
        <h2>Контроль сделок и просрочек с AI в amoCRM</h2>
        <p><strong>Коротко:</strong> контроль сделок amocrm — ежедневные сигналы: зависшие этапы, пустые поля, просроченные задачи, отсутствие следующего шага.</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3>Напоминания, задачи и сигналы</h3>
          <ul>
            <li><strong>Digital Pipeline / Salesbot</strong> — автозадачи при смене этапа;</li>
            <li>дедлайн SLA на первый контакт менеджера;</li>
            <li>эскалация РОПу при просрочке;</li>
            <li>теги «нет задачи», «пустые поля», «N дней в статусе»;</li>
            <li>дашборд: % автозаполнения, время в статусе, просрочки.</li>
          </ul>
        </div>
        <div class="vna-card">
          <h3>Роль AI и менеджера</h3>
          <p>Это отличает предложение Nero Network от типичных виджетов: cmdf5 ChatAI и NOVA сильны в диалоге, но <strong>редко продают контроль воронки для РОПа</strong> как единый пакет.</p>
          <ul>
            <li>сигнал о сделке без следующего шага;</li>
            <li>напоминание менеджеру до дедлайна;</li>
            <li>отчёт руководителю по дисциплине воронки.</li>
          </ul>
          <p>Человек закрывает сделку и ведёт переговоры. AI держит <strong>дисциплину процесса</strong>.</p>
        </div>
      </div>
    </div>
  </section>


  <!-- БОРИС: визуальный блок после #kontrol-sdelok -->
  <section id="boris-kvalifikaciya-viz" class="bai-root" aria-label="Визуализация потока квалификации лида: канал, BANT-поля, score, задача менеджеру">
<style>
.bai-root{padding:60px 0 72px;background:#f0f4fb;}
.bai-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
.bai-card{display:grid;grid-template-columns:42% 58%;border-radius:24px;overflow:hidden;box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(99,102,241,.15);min-height:500px;}
@media(max-width:960px){.bai-card{grid-template-columns:1fr;min-height:auto;}}
.bai-lft{background:#fff;padding:48px 40px;display:flex;flex-direction:column;justify-content:center;}
@media(max-width:600px){.bai-lft{padding:32px 24px;}}
.bai-ey{display:inline-flex;align-items:center;gap:7px;font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;color:#6366f1;margin:0 0 15px;}
.bai-ey::before{content:'';display:inline-block;width:20px;height:2px;background:#6366f1;border-radius:1px;}
.bai-h3{font-size:24px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 20px;}
.bai-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:10px;}
.bai-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14.5px;line-height:1.5;color:#334155;}
.bai-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(99,102,241,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#6366f1;margin-top:1px;font-style:normal;}
.bai-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;}
.bai-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
.bai-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
.bai-pl-b{background:rgba(99,102,241,.08);color:#4338ca;border:1.5px solid rgba(99,102,241,.22);}
.bai-pl-a{background:rgba(249,115,22,.08);color:#c2410c;border:1.5px solid rgba(249,115,22,.22);}
.bai-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
.bai-rgt{background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);position:relative;overflow:hidden;min-height:400px;}
@media(max-width:960px){.bai-rgt{min-height:380px;}}
#bai-kval-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bai-cnt">
<div class="bai-card">
  <div class="bai-lft">
    <span class="bai-ey">Поток квалификации</span>
    <h3 class="bai-h3">От сообщения в MAX/Telegram до задачи менеджеру — без ручного разбора</h3>
    <ul class="bai-ul">
      <li><span class="bai-ic">1</span>Канал входа → AI извлекает сущности из переписки или звонка</li>
      <li><span class="bai-ic">2</span>BANT-чеклист: бюджет, ЛПР, потребность, срок — заполняются по правилам</li>
      <li><span class="bai-ic">3</span>Score и тег: горячий / тёплый / нецелевой — маршрутизация по SLA</li>
      <li><span class="bai-ic">4</span>Задача менеджеру с дедлайном 15 мин и сводкой в примечании CRM</li>
    </ul>
    <div class="bai-pills">
      <span class="bai-pl bai-pl-g">22% → 33% SQL</span>
      <span class="bai-pl bai-pl-a">15 мин → 1 мин</span>
      <span class="bai-pl bai-pl-b">94% полей auto</span>
    </div>
    <p class="bai-foot">Дальше — интеграции с телефонией и мессенджерами →</p>
  </div>
  <div class="bai-rgt">
    <canvas id="bai-kval-canvas" aria-label="Анимация: лид проходит BANT-квалификацию, получает score и уходит менеджеру с SLA-таймером" role="img"></canvas>
  </div>
</div>
</div>
<script>
(function(){
  var cv=document.getElementById('bai-kval-canvas');
  if(!cv)return;
  var cx=cv.getContext('2d'),W=0,H=0,t=0;
  function resize(){
    var p=cv.parentElement;if(!p)return;
    cv.width=p.clientWidth||640;cv.height=p.clientHeight||500;
    W=cv.width;H=cv.height;
  }
  window.addEventListener('resize',resize);resize();
  var STAGES=['Канал','BANT','Score','Менеджер'];
  var FIELDS=['Budget','Authority','Need','Timeline'];
  var COL={acc:'#79f2ff',viol:'#a78bfa',green:'#4ade80',text:'#e2e8f0',muted:'rgba(226,232,240,.45)',line:'rgba(255,255,255,.08)'};
  function rr(x,y,w,h,r,fill,stroke){
    cx.beginPath();
    if(cx.roundRect)cx.roundRect(x,y,w,h,r);
    else{cx.moveTo(x+r,y);cx.arcTo(x+w,y,x+w,y+h,r);cx.arcTo(x+w,y+h,x,y+h,r);cx.arcTo(x,y+h,x,y,r);cx.arcTo(x,y,x+w,y,r);cx.closePath();}
    if(fill){cx.fillStyle=fill;cx.fill();}
    if(stroke){cx.strokeStyle=stroke;cx.lineWidth=1.5;cx.stroke();}
  }
  function loop(){
    t++;
    cx.clearRect(0,0,W,H);
    var pad=18,top=42,bot=H-36;
    cx.fillStyle=COL.text;cx.font='bold 12px Inter,system-ui,sans-serif';cx.textAlign='left';
    cx.fillText('amoCRM · поток квалификации',pad,24);
    var pulse=0.5+0.5*Math.sin(t*0.06);
    cx.beginPath();cx.arc(W-pad-8,20,5+pulse*2,0,Math.PI*2);
    cx.fillStyle='rgba(74,222,128,'+(0.25+0.15*pulse)+')';cx.fill();
    cx.beginPath();cx.arc(W-pad-8,20,4,0,Math.PI*2);cx.fillStyle=COL.green;cx.fill();
    var sw=(W-pad*2-36)/4;
    for(var i=0;i<4;i++){
      var x=pad+i*(sw+12),y=top,h=bot-top-20;
      rr(x,y,sw,h,12,'rgba(255,255,255,.05)','rgba(255,255,255,.1)');
      cx.fillStyle=i===1?COL.viol:i===2?COL.green:COL.acc;
      cx.font='bold 10px Inter,sans-serif';cx.textAlign='center';
      cx.fillText(STAGES[i],x+sw/2,y+18);
      if(i===0){
        var ly=y+36+((t*1.2)%((h-60)/3));
        rr(x+10,ly,sw-20,28,8,'rgba(96,165,250,.15)','rgba(96,165,250,.35)');
        cx.fillStyle=COL.text;cx.font='10px Inter,sans-serif';cx.textAlign='left';
        cx.fillText('Заявка #'+((t/40|0)%99+1),x+18,ly+18);
      }
      if(i===1){
        FIELDS.forEach(function(f,fi){
          var fy=y+34+fi*34,on=(t+fi*45)%360<220;
          rr(x+10,fy,sw-20,26,7,on?'rgba(167,139,250,.18)':'rgba(255,255,255,.04)',on?'rgba(167,139,250,.4)':'rgba(255,255,255,.08)');
          cx.fillStyle=on?COL.viol:COL.muted;cx.font='10px Inter,sans-serif';cx.textAlign='left';
          cx.fillText((on?'✓ ':'○ ')+f,x+18,fy+17);
        });
      }
      if(i===2){
        var sc=62+((t/8|0)%35);
        cx.fillStyle=COL.green;cx.font='bold 28px Inter,sans-serif';cx.textAlign='center';
        cx.fillText(sc,x+sw/2,y+h/2-8);
        cx.fillStyle=COL.muted;cx.font='10px Inter,sans-serif';
        cx.fillText(sc>80?'горячий':'тёплый',x+sw/2,y+h/2+16);
      }
      if(i===3){
        rr(x+10,y+40,sw-20,h-56,10,'rgba(74,222,128,.08)','rgba(74,222,128,.28)');
        cx.fillStyle=COL.text;cx.font='bold 11px Inter,sans-serif';cx.textAlign='left';
        cx.fillText('Задача менеджеру',x+18,y+58);
        var sla=Math.max(0,15-((t/30|0)%16));
        cx.fillStyle=sla<5?'#f87171':COL.green;cx.font='bold 18px Inter,sans-serif';
        cx.fillText(sla+' мин SLA',x+18,y+82);
        cx.fillStyle=COL.muted;cx.font='10px Inter,sans-serif';
        cx.fillText('Поля заполнены · note готов',x+18,y+102);
      }
      if(i<3){
        var ax=x+sw+2,ay=y+h/2;
        cx.strokeStyle='rgba(121,242,255,'+(0.3+0.4*pulse)+')';cx.lineWidth=2;
        cx.beginPath();cx.moveTo(ax,ay);cx.lineTo(ax+10,ay);cx.stroke();
        cx.beginPath();cx.moveTo(ax+7,ay-4);cx.lineTo(ax+10,ay);cx.lineTo(ax+7,ay+4);cx.fillStyle=COL.acc;cx.fill();
      }
    }
    requestAnimationFrame(loop);
  }
  document.fonts.ready.then(loop);
})();
</script>
  </section>

  <!-- #integracii -->
  <section class="vna-section vna-section-alt" id="integracii">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Интеграции</span>
        <h2>Интеграция AI с телефонией и мессенджерами amoCRM</h2>
        <p>Интеграция ai amocrm с телефонией и мессенджерами — обязательный слой для полного покрытия входящего потока.</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <div class="vna-table-wrap">
          <table class="vna-table" aria-label="Каналы и роль AI">
            <thead>
              <tr><th>Канал</th><th>Как AI участвует</th></tr>
            </thead>
            <tbody>
              <tr><td>MAX, Telegram, WhatsApp</td><td>Диалог квалификации, автозаполнение из переписки</td></tr>
              <tr><td>Сайт / формы</td><td>Webhook → LLM → поля сделки</td></tr>
              <tr><td>UIS, Mango, встроенная телефония</td><td>Voice AI: расшифровка, извлечение бюджета/потребности</td></tr>
              <tr><td>Исходящий обзвон (SL Soft)</td><td>Триггер из CRM → звонок → запись в карточку</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:18px;">Интеграция ai amocrm на практике требует тарифа amoCRM с API (Расширенный/Профессиональный), OAuth-интеграции и выбора модели: YandexGPT, GigaChat (152-ФЗ), GPT-4o/Claude (без ПДн или с обезличиванием).</p>
        <p><strong>Важно:</strong> обработка входящей почты в CRM — отдельная услуга Nero Network; на этой странице почта упоминается только как возможный канал входа.</p>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="vna-card nero-ai-reveal" style="margin-top:0">
      <p style="margin:0;font-size:15px">Входящая почта в CRM — отдельный сценарий Nero Network: <a href="/vnedrenie-ai-obrabotka-email-crm/" class="ym-link ym-link--accent">AI-обработка входящей почты в CRM под ключ</a>. На корпоративном масштабе те же принципы квалификации и SLA описаны в разборе <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" class="ym-link ym-link--accent">KPMG и Claude: уроки AI для бизнеса</a>.</p>
    </div>
  </div>

  <!-- #sravnenie -->
  <section class="vna-section" id="sravnenie">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Позиционирование</span>
        <h2>Чем модуль квалификации отличается от общего AI-агента в amoCRM</h2>
        <p>На сайте уже есть материал про полное внедрение AI-агента в amoCRM (см. блок «Смежные материалы» выше). <strong>Эта страница</strong> — про узкий операционный пакет: квалификация → автозаполнение → контроль.</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <div class="vna-table-wrap">
          <table class="vna-table" aria-label="Модуль квалификации vs общий AI-агент">
            <thead>
              <tr><th>Критерий</th><th>Модуль квалификации</th><th>Общий AI-агент</th></tr>
            </thead>
            <tbody>
              <tr><td>Фокус</td><td>Заявки, поля, SLA, воронка</td><td>Вся автоматизация ОП «под ключ»</td></tr>
              <tr><td>Боль</td><td>Заявки висят, карточки пустые</td><td>Нужен единый AI-слой на все процессы</td></tr>
              <tr><td>Срок входа</td><td>Пилот на одном канале за 1–2 недели</td><td>Проект 3–6 недель и шире</td></tr>
              <tr><td>Связка</td><td>3 модуля как единый процесс</td><td>Агент + интеграции + обучение</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Три пути внедрения (честное сравнение)</h3>
        <div class="vna-table-wrap">
          <table class="vna-table" aria-label="Три пути внедрения AI в amoCRM">
            <thead>
              <tr><th>Путь</th><th>Плюсы</th><th>Минусы</th><th>Когда выбрать</th></tr>
            </thead>
            <tbody>
              <tr><td>Встроенный AI-агент amoCRM</td><td>Нативно, быстрый старт</td><td>Меньше кастома под поля и SLA</td><td>Стандартная воронка</td></tr>
              <tr><td>Виджет (NOVA, ChatAI)</td><td>Готовый диалог, кейсы</td><td>Слабый контроль РОПа</td><td>Чат 24/7 без разработки</td></tr>
              <tr><td>Кастом n8n + API</td><td>Полный контроль, approval, SLA</td><td>Нужен интегратор</td><td>Нестандартная воронка, 152-ФЗ</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:16px;"><strong>amoAI на YandexGPT</strong> (~1&nbsp;699 ₽/пользователь/мес) — резюме чатов и помощь менеджеру, <strong>не</strong> замена модуля автоквалификации в диалоге с клиентом.</p>
      </div>
    </div>
  </section>


  <!-- #shema-vnedreniya -->
  <section class="vna-section vna-section-alt" id="shema-vnedreniya">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Лид-магнит</span>
        <h2>Схема внедрения AI-модуля в amoCRM</h2>
        <p><strong>Лид-магнит:</strong> схема «Схема AI для amoCRM» — цепочка <strong>канал → AI → поля → этап → задача → SLA</strong>.</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <h3>Этапы настройки ai amocrm (проектная модель Nero Network)</h3>
        <div class="vna-timeline">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>1. Аудит воронки (1–2 дня)</h3><p>Обязательные поля, SLA первого ответа, этапы, причины отказа.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>2. Карта полей</h3><p>Какие custom_fields заполняет AI (бюджет, срок, продукт, город, score).</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>3. Модуль квалификации</h3><p>Диалог 3–6 вопросов в чатах MAX/Telegram/WhatsApp/сайт.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>4. Модуль автозаполнения</h3><p>webhook/API → LLM → PATCH сделки + note.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>5. Модуль контроля</h3><p>Digital Pipeline, задачи, эскалация, теги «пустая карточка».</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>6. Пилот на одном канале</h3><p>Замер до/после: время ответа, % заполненных полей, конверсия в квалифицированный.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>7. Масштабирование</h3><p>Телефония и повторные касания по результатам метрик.</p></div>
        </div>
        <div style="margin-top:28px;">
          <h3>Сценарий BANT/MEDDIC-lite для промпта</h3>
          <ul>
            <li><strong>B</strong>udget — «Какой бюджет закладываете?»</li>
            <li><strong>A</strong>uthority — «Вы принимаете решение или нужно согласование?»</li>
            <li><strong>N</strong>eed — «Какую задачу хотите решить?»</li>
            <li><strong>T</strong>imeline — «К какому сроку нужен результат?»</li>
          </ul>
          <p>Разработка ai amocrm в этой модели — <strong>проектирование процесса</strong>, затем AI.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA-1: после #shema-vnedreniya -->
  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-shema">
      <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получить схему AI для вашей amoCRM</p>
        <p class="ym-cta-block__sub">На аудите разберём воронку, обязательные поля и SLA, соберём карту «канал → AI → поля → этап → задача» под ваш поток заявок. Без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <!-- #stoimost -->
  <section class="vna-section" id="stoimost">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Инвестиции</span>
        <h2>Стоимость и этапы внедрения нейросетей в amoCRM</h2>
        <p>Внедрение ai amocrm под ключ в формате модуля квалификации — проект с измеримым пилотом, а не подписка «вслепую».</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3>Что входит в аудит</h3>
          <ul>
            <li>разбор воронки и обязательных полей;</li>
            <li>карта интеграций (каналы, телефония, API);</li>
            <li>регламент квалификации (что считается SQL);</li>
            <li>выбор стека: встроенный агент / виджет / кастом.</li>
          </ul>
        </div>
        <div class="vna-card">
          <h3>Пилот</h3>
          <ul>
            <li>один канал (Telegram или форма сайта);</li>
            <li>один этап воронки;</li>
            <li>метрики до/после: время ответа, % заполненных полей, конверсия в SQL.</li>
          </ul>
        </div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Сроки и чек 180–900 тыс. ₽</h3>
        <p><strong>Ai amocrm цена</strong> и <strong>ai amocrm стоимость</strong> в проектах Nero Network для модуля «квалификация + автозаполнение + контроль» — коридор <strong>180–900 тыс. ₽</strong> в зависимости от числа каналов, кастомных полей, телефонии и требований 152-ФЗ.</p>
        <p>Рыночные якоря (2026): внедрение виджета ChatAI (cmdf5) — <strong>от ~79&nbsp;990 ₽</strong>; подписки виджетов и API LLM — отдельно.</p>
        <p><strong>Сколько стоит ai amocrm</strong> в пересчёте на бизнес-эффект: ручная квалификация одного лида — 10–20 минут менеджера; при потоке 100 заявок/мес это десятки часов.</p>
        <p>Чтобы <strong>ai amocrm заказать</strong> с прозрачной сметой — начните с оценки: CTA <strong>«Оценить amoCRM»</strong>.</p>
      </div>
    </div>
  </section>

  <!-- CTA-2: после #stoimost -->
  <div class="vna-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать стек до старта пилота?</p>
        <p class="ym-cta-block__sub">Если перед заказом интеграции нужно разобраться в n8n, промптах и human-in-the-loop — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование полей и сценария квалификации на аудите.</p>
      </div>
    </aside>
    <div class="ym-cta-block ym-cta-block--dual" id="cta-stoimost">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнать бюджет модуля квалификации</p>
        <p class="ym-cta-block__sub">Ориентир 180–900 тыс. ₽ за связку «квалификация + автозаполнение + контроль». На оценке amoCRM дадим смету пилота на одном канале и метрики до/после.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#shema-vnedreniya" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Схема внедрения →</a>
        </div>
      </div>
    </div>
  </div>

  <!-- #keisy -->
  <section class="vna-section vna-section-alt" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Результаты</span>
        <h2>Кейсы: квалификация лидов и автозаполнение для отдела продаж</h2>
        <p><strong>Ai amocrm кейсы</strong> с публичными цифрами в РФ пока немногочисленны; ниже — верифицированные референсы и проектная модель.</p>
      </div>
      <div class="vna-case-grid nero-ai-reveal">
        <div class="vna-case-card">
          <div class="vna-case-tag">NOVA · e-commerce</div>
          <h3>Интернет-магазин автозапчастей</h3>
          <p>AI-агент как «первый менеджер»: 5-этапный диалог, мини-квалификация, FAQ из БЗ. Каналы: чат, WhatsApp/Telegram, формы.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">1 мин</span><span class="lbl">первый ответ (было 15 мин)</span></div>
            <div class="vna-metric"><span class="num">33%</span><span class="lbl">конверсия в SQL (было 22%)</span></div>
            <div class="vna-metric"><span class="num">12,4 ч</span><span class="lbl">экономия менеджеров / нед</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Salesforce · global</div>
          <h3>Customer 360 AI-агенты</h3>
          <p>Квалификация, outreach, opportunities на масштабе enterprise.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">130K</span><span class="lbl">лидов за 4 месяца</span></div>
            <div class="vna-metric"><span class="num">3,2K</span><span class="lbl">opportunities создано</span></div>
            <div class="vna-metric"><span class="num">−34%</span><span class="lbl">время на research</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Nero Network · SMB</div>
          <h3>Проектная модель (типовой)</h3>
          <p>Услуги, 30–80 заявок/мес, amoCRM + Telegram; пилот: квалификация 4 полей, автозаполнение, SLA 15 мин.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">↑</span><span class="lbl">скорость первого ответа</span></div>
            <div class="vna-metric"><span class="num">↑</span><span class="lbl">доля заполненных карточек</span></div>
            <div class="vna-metric"><span class="num">↓</span><span class="lbl">просрочки задач</span></div>
          </div>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;"><strong>Ai amocrm кейсы для отдела продаж</strong> лучше смотреть в связке метрик: скорость, заполненность полей, конверсия в SQL — а не только «бот отвечает».</p>
    </div>
  </section>


  <!-- #faq -->
  <section class="vna-section" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Вопрос — ответ</span>
        <h2>FAQ по нейросетям и AI в amoCRM</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item" id="faq-kvalifikaciya">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как ai квалифицирует лиды в amocrm?</div>
          <div class="vna-faq-a"><p>По сценарию 3–6 вопросов (BANT или ваш чек-лист), извлекает сущности из текста/звонка, заполняет поля, присваивает score и маршрутизирует на менеджера с задачей и дедлайном SLA.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-stoimost">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит ai amocrm?</div>
          <div class="vna-faq-a"><p>Проекты модуля квалификации Nero Network — <strong>180–900 тыс. ₽</strong>; виджеты рынка — от ~30–80 тыс. ₽ внедрение плюс подписки. Точная смета — после аудита воронки.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-modul">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли внедрить только модуль без полного агента?</div>
          <div class="vna-faq-a"><p>Да. Эта страница как раз про узкий пакет: квалификация + автозаполнение + контроль. Полный AI-агент — отдельный проект; подробности — в блоке «Смежные материалы» и в секции сравнения выше.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-menedzhery">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли нейросеть менеджеров?</div>
          <div class="vna-faq-a"><p>Нет. AI закрывает рутину первой линии и подготовку карточки; переговоры, цена и нестандартные кейсы — за человеком.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-152fz">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Какая модель AI и 152-ФЗ?</div>
          <div class="vna-faq-a"><p>Для персональных данных — YandexGPT, GigaChat, обезличивание или хостинг без передачи ПДн за рубеж. Выбор фиксируется в ТЗ после аудита.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-pilot">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько дней до запуска пилота?</div>
          <div class="vna-faq-a"><p>Аудит 1–2 дня; пилот на одном канале — обычно <strong>1–2 недели</strong> после согласования полей и сценария.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-integracii">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Интеграция с телефонией и мессенджерами — что нужно?</div>
          <div class="vna-faq-a"><p>amoCRM API, подключённые каналы (MAX, Telegram, WhatsApp), при звонках — Voice AI или интеграция UIS/Mango; оркестратор n8n/Make при кастомной схеме.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-amma">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Чем это отличается от amoAI и Аммы?</div>
          <div class="vna-faq-a"><p>amoAI помогает менеджеру внутри CRM; Амма упрощает настройку. Модуль квалификации работает <strong>с клиентом в канале</strong> и <strong>пишет в поля</strong> по вашим правилам.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-gallyucinacii">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Бот будет галлюцинировать?</div>
          <div class="vna-faq-a"><p>Снижаем риск: база знаний, guardrails, эскалация на человека, human approval перед записью в CRM, запрет юридически значимых обещаний в автоматическом режиме.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-proval">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Уже внедряли бота — не сработало. Почему у вас получится?</div>
          <div class="vna-faq-a"><p>Частая причина провала — нет SLA, пустые поля воронки и отсутствие контроля просрочек. Мы начинаем с <strong>аудита процесса</strong>, затем AI.</p></div>
        </div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:32px;">
        <p><strong>Итог:</strong> нейросети для amoCRM в формате операционного модуля — квалификация лидов, автозаполнение карточек сделок и контроль воронки — закрывают боль «заявки висят, CRM пустая». Nero Network внедряет связку под ключ: от чек-листа полей до пилота с метриками. <strong>Оценить amoCRM</strong> — первый шаг к схеме внедрения и прозрачной смете.</p>
      </div>
    </div>
  </section>

  <!-- CTA-3: финальный перед footer -->
  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Заявки не должны зависать в amoCRM</p>
        <p class="ym-cta-block__sub">Квалификация, автозаполнение карточек и контроль SLA — один модуль под ключ. Первый шаг: оценка воронки и прозрачная смета пилота.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

</div><!-- /.vna-content -->


<script>
(function(){
  document.querySelectorAll('.vna-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.vna-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.vna-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.vna-faq-q');
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
  var root = document.querySelector('.nejroseti-kvalifikaciya-lidov-amocrm-page');
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


<?php
$__nero_ld_site = trailingslashit(home_url());
$__nero_ld_page = trailingslashit(get_permalink());
$__nero_ld_brand = $brand ?: get_bloginfo('name');
$__nero_ld_json = <<<'NERO_LD'
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "__SITE__/#organization",
      "name": "__BRAND__",
      "url": "__SITE__"
    },
    {
      "@type": "WebSite",
      "@id": "__SITE__/#website",
      "url": "__SITE__",
      "name": "__BRAND__",
      "publisher": {
        "@id": "__SITE__/#organization"
      }
    },
    {
      "@type": "WebPage",
      "@id": "__PAGE__#webpage",
      "url": "__PAGE__",
      "name": "Нейросети для amoCRM: квалификация лидов и автозаполнение сделок под ключ",
      "description": "Внедрим AI в amoCRM: нейросеть квалифицирует лиды, автозаполняет карточки сделок и держит заявки под контролем. Схема, кейсы, цена. Оценить amoCRM.",
      "isPartOf": {
        "@id": "__SITE__/#website"
      },
      "about": {
        "@id": "__SITE__/#organization"
      }
    },
    {
      "@type": "BreadcrumbList",
      "@id": "__PAGE__#breadcrumb",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Главная",
          "item": "__SITE__"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Нейросети для amoCRM: квалификация лидов и автозаполнение сделок под ключ",
          "item": "__PAGE__"
        }
      ]
    },
    {
      "@type": "Service",
      "@id": "__PAGE__#service",
      "name": "Нейросети для amoCRM: квалификация лидов и автозаполнение сделок под ключ",
      "description": "Внедрим AI в amoCRM: нейросеть квалифицирует лиды, автозаполняет карточки сделок и держит заявки под контролем. Схема, кейсы, цена. Оценить amoCRM.",
      "url": "__PAGE__",
      "provider": {
        "@id": "__SITE__/#organization"
      }
    },
    {
      "@type": "FAQPage",
      "@id": "__PAGE__#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Как ai квалифицирует лиды в amocrm?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "По сценарию 3–6 вопросов (BANT или ваш чек-лист), извлекает сущности из текста/звонка, заполняет поля, присваивает score и маршрутизирует на менеджера с задачей и дедлайном SLA."
          }
        },
        {
          "@type": "Question",
          "name": "Сколько стоит ai amocrm?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Проекты модуля квалификации Nero Network — 180–900 тыс. ₽; виджеты рынка — от ~30–80 тыс. ₽ внедрение плюс подписки. Точная смета — после аудита воронки."
          }
        },
        {
          "@type": "Question",
          "name": "Можно ли внедрить только модуль без полного агента?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да. Эта страница как раз про узкий пакет: квалификация + автозаполнение + контроль. Полный AI-агент — отдельный проект (/vnedrenie-ai-amocrm/)."
          }
        },
        {
          "@type": "Question",
          "name": "Заменит ли нейросеть менеджеров?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Нет. AI закрывает рутину первой линии и подготовку карточки; переговоры, цена и нестандартные кейсы — за человеком."
          }
        },
        {
          "@type": "Question",
          "name": "Какая модель AI и 152-ФЗ?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Для персональных данных — YandexGPT, GigaChat, обезличивание или хостинг без передачи ПДн за рубеж. Выбор фиксируется в ТЗ после аудита."
          }
        },
        {
          "@type": "Question",
          "name": "Сколько дней до запуска пилота?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Аудит 1–2 дня; пилот на одном канале — обычно 1–2 недели после согласования полей и сценария."
          }
        },
        {
          "@type": "Question",
          "name": "Интеграция с телефонией и мессенджерами — что нужно?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "amoCRM API, подключённые каналы (MAX, Telegram, WhatsApp), при звонках — Voice AI или интеграция UIS/Mango; оркестратор n8n/Make при кастомной схеме."
          }
        },
        {
          "@type": "Question",
          "name": "Чем это отличается от amoAI и Аммы?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "amoAI помогает менеджеру внутри CRM; Амма упрощает настройку. Модуль квалификации работает с клиентом в канале и пишет в поля по вашим правилам."
          }
        },
        {
          "@type": "Question",
          "name": "Бот будет галлюцинировать?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Снижаем риск: база знаний, guardrails, эскалация на человека, human approval перед записью в CRM, запрет юридически значимых обещаний в автоматическом режиме."
          }
        },
        {
          "@type": "Question",
          "name": "Уже внедряли бота — не сработало. Почему у вас получится?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Частая причина провала — нет SLA, пустые поля воронки и отсутствие контроля просрочек. Мы начинаем с аудита процесса, затем AI."
          }
        }
      ]
    }
  ]
}
NERO_LD;
$__nero_ld_json = str_replace(['__SITE__', '__PAGE__', '__BRAND__'], [$__nero_ld_site, $__nero_ld_page, $__nero_ld_brand], $__nero_ld_json);
echo '<script type="application/ld+json">' . $__nero_ld_json . '</script>';
?>


</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

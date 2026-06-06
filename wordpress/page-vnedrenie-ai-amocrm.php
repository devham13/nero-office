<?php
/**
 * Template Name: AI-агент для amoCRM: автоматизация продаж под ключ
 * Description: SEO-лендинг — внедрение AI-агента в amoCRM. Кейсы, стек, цены. Аудит бесплатно.
 */

$page_seo_title       = 'AI-агент для amoCRM: внедрение и настройка под ключ';
$page_seo_description = 'Интегрируем AI-агента с amoCRM: сделки создаются автоматически, задачи ставятся сами, итоги звонков пишет нейросеть. Кейсы, стек, цены. Аудит бесплатно.';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
	$parts['title'] = $page_seo_title;
	return $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description ): void {
	echo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";
	echo '<meta property="og:type" content="article" />' . "\n";
}, 1 );


$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Аудит amoCRM';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#cta';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#kak-rabotaet';

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Сценарии AI', 'href' => '#scenarii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}

?>

<?php nero_ai_echo_theme_styles(); ?>

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
  --vna-accent:#f97316;--vna-violet:#8b5cf6;--vna-green:#22c55e;--vna-cyan:#79f2ff;
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
  background:rgba(249,115,22,.09);border:1px solid rgba(249,115,22,.22);
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
  background:linear-gradient(180deg,#f8fafc 0%,#111827 100%);
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
  color:#475569;margin-bottom:1em;
}
.vna-intro-text p:last-child{margin-bottom:0;color:#334155;}
.vna-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.vna-kpi-card{
  background:#fff;border:1px solid #e2e8f0;border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 4px 18px rgba(15,23,42,.07);
}
.vna-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:#0f172a;letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.vna-kpi-card .kl{font-size:11px;font-weight:600;color:#64748b;line-height:1.4;}
.vna-kpi-card .ks{font-size:10px;color:#94a3b8;margin-top:4px;}
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
  border-color:rgba(249,115,22,.42);color:var(--vna-accent);
  background:rgba(249,115,22,.08);
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
.vna-card:hover{border-color:rgba(249,115,22,.28);transform:translateY(-2px);}
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
.vna-level-card.l2 .vna-level-badge{background:rgba(249,115,22,.15);color:var(--vna-accent);}
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
.vna-scenario:hover{border-color:rgba(249,115,22,.3);}
.vna-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(249,115,22,.12);border:1px solid rgba(249,115,22,.22);
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
  background:rgba(249,115,22,.1);color:var(--vna-accent);font-weight:700;
  border-bottom:1px solid rgba(249,115,22,.25);white-space:nowrap;
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
  box-shadow:0 0 0 4px rgba(249,115,22,.2);
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
.vna-price-card:hover{border-color:rgba(249,115,22,.35);transform:translateY(-3px);}
.vna-price-card.vna-featured{
  border-color:rgba(249,115,22,.45);background:rgba(249,115,22,.07);
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
  background:linear-gradient(135deg,rgba(249,115,22,.12),rgba(139,92,246,.1));
  border:1px solid rgba(249,115,22,.3);text-align:center;
}
.ym-cta-block--dual{
  background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(249,115,22,.1));
  border-color:rgba(34,197,94,.3);
}
.ym-cta-block--footer-final{
  background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(249,115,22,.08));
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
.ym-btn--accent{
  background:var(--vna-accent);color:#fff!important;
  box-shadow:0 8px 24px rgba(249,115,22,.3);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(249,115,22,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--vna-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(249,115,22,.4);background:rgba(249,115,22,.08);}
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
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-amocrm-page" role="main" tabindex="-1">

<!-- HERO: nero-ai shell (канонический дизайн главной) -->
  <section class="nero-ai-hero" id="hero" aria-labelledby="hero-amocrm-title">
    <div class="nero-ai-container nero-ai-hero-grid">
      <div class="nero-ai-hero-copy nero-ai-reveal">
        <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai amocrm</p>
        <h1 id="hero-amocrm-title">AI-агент для amoCRM: <span class="nero-ai-gradient-text">автоматизация продаж под ключ</span></h1>
        <p class="nero-ai-hero-lead">Внедрим AI в вашу amoCRM — сделки создаются сами, задачи ставятся автоматически, менеджеры только продают</p>
        <ul class="nero-ai-badges" aria-label="Ключевые возможности">
          <li class="nero-ai-badge">Сделки в CRM</li>
          <li class="nero-ai-badge">Задачи авто</li>
          <li class="nero-ai-badge">Итоги звонков</li>
          <li class="nero-ai-badge">Воронка 24/7</li>
        </ul>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
        </div>
      </div>
      <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI и amoCRM">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">amoCRM · демо</span>
          </div>
          <div class="nero-ai-window-body">
            <div class="nero-ai-dashboard-title"><h3>AI-операционный центр</h3><span class="nero-ai-live-pill">онлайн</span></div>
            <div class="nero-ai-metrics-grid">
              <div class="nero-ai-metric"><span>Лиды</span><strong>24</strong><small>входящих</small></div>
              <div class="nero-ai-metric"><span>Ответ</span><strong>5 сек</strong><small>первичный</small></div>
              <div class="nero-ai-metric"><span>CRM</span><strong>auto</strong><small>сделки</small></div>
              <div class="nero-ai-metric"><span>Рутина</span><strong>−38%</strong><small>меньше</small></div>
            </div>
            <div class="nero-ai-task-stream">
              <div class="nero-ai-task"><span class="nero-ai-task-icon">IN</span><div><strong>Заявка</strong><span>сайт / мессенджер</span></div><span class="nero-ai-status">готово</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Квалификация</strong><span>скоринг лида</span></div><span class="nero-ai-status">готово</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">CRM</span><div><strong>Сделка</strong><span>задача менеджеру</span></div><span class="nero-ai-status">новое</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


<!-- ====================================================
     КОНТЕНТНАЯ ЧАСТЬ СТРАНИЦЫ
     ==================================================== -->
<div class="vna-content">

  <!-- INTRO: первый контентный блок — левое выравнивание -->
  <section class="vna-intro" id="intro">
    <div class="vna-cnt">
      <div class="vna-intro-grid">
        <div class="vna-intro-text">
          <p>Согласно исследованию J'son & Partners Consulting (ноябрь 2025 — январь 2026, выборка — 1 000 компаний), до <strong>70% рабочего времени</strong> менеджеров по продажам уходит на рутину: внести контакт, обновить статус сделки, записать итоги звонка, поставить задачу на перезвон. При этом <strong>85% российских компаний</strong> уже видят ценность AI для CRM — но только <strong>19,2%</strong> используют AI-ассистентов регулярно.</p>
          <p>Разрыв между пониманием и реальным внедрением измеряется тысячами потерянных сделок ежемесячно. AI-агент для amoCRM закрывает этот разрыв на уровне архитектуры: система подключается к CRM через API, получает события через webhooks и самостоятельно выполняет задачи, которые раньше делали менеджеры вручную. Менеджеры переключаются на то, что действительно требует живого человека, — переговоры и закрытие сделок.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые показатели рынка">
          <div class="vna-kpi-card">
            <div class="kv">85%</div>
            <div class="kl">компаний видят ценность AI в CRM</div>
            <div class="ks">J'son & Partners, 2026</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">19%</div>
            <div class="kl">используют AI-ассистентов регулярно</div>
            <div class="ks">J'son & Partners, 2026</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">70%</div>
            <div class="kl">рабочего времени уходит на рутину</div>
            <div class="ks">отраслевое исследование, 2026</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">220К+</div>
            <div class="kl">компаний работают в amoCRM</div>
            <div class="ks">TAdviser / Cossa, 2026</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC: оглавление-пилюли -->
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что такое</a>
        <a href="#scenarii">Сценарии AI</a>
        <a href="#komu-nuzhno">Кому нужно</a>
        <a href="#stek">Стек</a>
        <a href="#keisy">Кейсы</a>
        <a href="#etapy">Этапы</a>
        <a href="#ceny">Цены</a>
        <a href="#sravnenie">Сравнение</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Аудит</a>
      </nav>
    </div>
  </div>

  <!-- ================================================
       РАЗДЕЛ 1: Что такое AI-агент
       ================================================ -->
  <section class="vna-section" id="chto-takoe">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Что это такое</span>
        <h2>Что такое AI-агент для amoCRM<br>и зачем он нужен</h2>
        <p>AI-агент — это языковая модель, подключённая к CRM через API и webhook-триггеры, которая самостоятельно принимает операционные решения без участия человека.</p>
      </div>

      <div class="vna-card nero-ai-reveal" id="kak-rabotaet">
        <h3 style="font-size:20px;margin-bottom:16px;">Как работает: webhook → AI-агент → API amoCRM</h3>
        <div class="vna-timeline">
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <h3>1. Событие в CRM</h3>
            <p>Новая заявка поступает из любого канала: форма на сайте, Telegram, WhatsApp, ВКонтакте, Авито. amoCRM фиксирует событие (<code>add_lead</code> или <code>add_talk</code>) и немедленно отправляет webhook на адрес AI-агента.</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <h3>2. Получение контекста</h3>
            <p>AI-агент читает карточку сделки через API amoCRM v4: поля контакта, источник лида, историю переписки, предыдущие сделки. API v4 поддерживает до 50 запросов в секунду — достаточно для обработки нескольких сотен заявок в день.</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <h3>3. Диалог и квалификация</h3>
            <p>Агент начинает переписку с потенциальным клиентом в течение 5–10 секунд после поступления заявки: задаёт квалификационные вопросы, отвечает на типовые вопросы по базе знаний компании.</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <h3>4. Запись в CRM</h3>
            <p>По ходу диалога агент через API amoCRM заполняет поля сделки (бюджет, источник, потребность, срочность), обновляет этап воронки, создаёт задачу для менеджера с чётким описанием и датой.</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <h3>5. Передача менеджеру</h3>
            <p>Менеджер открывает CRM и видит готовую карточку: заполненные поля, резюме разговора с клиентом, конкретная задача с датой и контекстом. Он не тратит 20 минут на «разбор входящих» — сразу приступает к продаже тёплого контакта.</p>
          </div>
        </div>
      </div>

      <div style="margin-top:40px;">
        <div class="vna-sh vna-left" id="tri-urovnya">
          <span class="vna-eyebrow">Три уровня</span>
          <h2>Три уровня AI для amoCRM:<br>от нативного до агентного</h2>
          <p>Ни один конкурент не объясняет разницу между уровнями автоматизации. Nero Network строит интеграции на трёх уровнях, и у каждого — своя ниша применения.</p>
        </div>
        <div class="vna-grid-3 nero-ai-reveal">
          <div class="vna-level-card l1">
            <div class="vna-level-badge">Уровень 1</div>
            <h3>Нативный amoAI</h3>
            <p>В 2026 году amoCRM запустил встроенного AI-агента на базе OpenAI или YandexGPT. Доступен на тарифах Профессиональный, Enterprise. Умеет создавать задачи, двигать сделки, управлять тегами. Подходит для простых сценариев — но ограничен возможностями интерфейса CRM без доступа к внешним системам.</p>
          </div>
          <div class="vna-level-card l2">
            <div class="vna-level-badge">Уровень 2</div>
            <h3>Виджетный стек</h3>
            <p>Webhook из amoCRM → Make.com или n8n → LLM (Claude, GPT-4o, GigaChat) → запись в amoCRM. Реализует транскрибацию звонков, суммаризацию переписки, автозаполнение карточек, постановку задач по договорённостям. Это стандартный промышленный стек 2026 года для большинства задач средней сложности.</p>
          </div>
          <div class="vna-level-card l3">
            <div class="vna-level-badge">Уровень 3</div>
            <h3>Агентный MCP</h3>
            <p>AI-агент получает прямой доступ к 36–39 инструментам amoCRM через стандартизированный MCP-протокол. Полная автономия: агент сам решает, какие методы API вызвать. Архитектура: OpenAI Agents SDK + amocrm-mcp сервер + RAG-база знаний. Это передовой стек 2026 года.</p>
          </div>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" id="vs-salesbot" style="margin-top:28px;">
        <h3 style="font-size:19px;margin-bottom:10px;">Чем AI-агент отличается от Salesbot и встроенного amoAI</h3>
        <p>Salesbot — конструктор жёстких сценариев без LLM: ветки «если / то», кнопки, фиксированные шаблоны ответов. Он не понимает контекст и не способен к диалогу вне заранее прописанных веток. Нативный amoAI лучше Salesbot, но ограничен возможностями встроенного тарифа и интерфейсом CRM. Внешний AI-агент на LLM работает с контекстом разговора, принимает операционные решения, интегрируется с любыми внешними данными и системами, поддерживает человекоподобный диалог по базе знаний компании.</p>
      </div>
    </div>
  </section>

  <!-- ================================================
       РАЗДЕЛ 2: 5 сценариев
       ================================================ -->
  <section class="vna-section vna-section-alt" id="scenarii">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Сценарии автоматизации</span>
        <h2>Что AI-агент делает вместо менеджера:<br>5 ключевых сценариев</h2>
        <p>Каждый сценарий — конкретный бизнес-процесс, который AI выполняет автономно, без участия человека.</p>
      </div>

      <div class="nero-ai-reveal" id="sozdayot-sdelki">
        <div class="vna-scenario">
          <div class="vna-sc-icon" aria-hidden="true">⚡</div>
          <div>
            <h3>1. Создаёт сделки автоматически по входящим заявкам</h3>
            <p><strong>Боль:</strong> форма с сайта пришла в 22:17 в пятницу. Менеджер увидит её в понедельник утром. К этому времени клиент уже купил у конкурента, который ответил за 30 минут.</p>
            <p>AI-агент получает webhook в момент подачи заявки и начинает переписку с клиентом в течение <strong>5–10 секунд</strong> — 24/7, без выходных и больничных. По данным кейса оптового продавца (SaleKit), время реакции сократилось с 68 минут до 4 минут 10 секунд. Результат за 9 месяцев: повторные заказы 27% → 46%, выручка ×2.</p>
          </div>
        </div>
      </div>

      <div class="nero-ai-reveal nero-ai-delay-1" id="stavit-zadachi">
        <div class="vna-scenario">
          <div class="vna-sc-icon" aria-hidden="true">✅</div>
          <div>
            <h3>2. Ставит задачи и назначает ответственных менеджеров</h3>
            <p>После квалификации диалога AI-агент создаёт задачу с конкретным описанием — не «позвонить клиенту», а «Перезвонить Иванову, бюджет 300–500 тыс. ₽, срок — до конца квартала, интересует пакет с интеграцией 1С». Задача назначается нужному менеджеру по заданным правилам: географии, специализации, текущей нагрузке. Устанавливается дата, уходит уведомление в Telegram или amoCRM.</p>
          </div>
        </div>
      </div>

      <div class="nero-ai-reveal nero-ai-delay-2" id="itogi-zvonkov">
        <div class="vna-scenario">
          <div class="vna-sc-icon" aria-hidden="true">🎙️</div>
          <div>
            <h3>3. Пишет итоги звонков в карточку сделки</h3>
            <p>Одна из самых недооценённых болей в продажах. Менеджер тратит <strong>15–30 минут после каждого звонка</strong> на заполнение карточки. При 10–15 звонках в день — 2,5–4 часа ежедневно.</p>
            <p>AI-агент транскрибирует запись через Yandex SpeechKit или Whisper, анализирует и записывает в примечание: о чём договорились, какие возражения, следующие шаги. Попутно создаёт задачи по договорённостям. Руководитель видит скоринг каждого звонка без прослушивания — контроль качества в <strong>5–8 раз быстрее</strong>.</p>
          </div>
        </div>
      </div>

      <div class="nero-ai-reveal nero-ai-delay-1" id="voronka">
        <div class="vna-scenario">
          <div class="vna-sc-icon" aria-hidden="true">🔄</div>
          <div>
            <h3>4. Двигает сделки по воронке по бизнес-правилам</h3>
            <p>AI-агент контролирует воронку по заданным правилам непрерывно. Если сделка не двигалась N дней — агент отправляет клиенту напоминание или ставит задачу на реактивацию. Если «да» — переводит в «Согласование». Если «не сейчас» — ставит задачу через 2 недели и добавляет в нурчинг.</p>
            <p><strong>Кейс Фабрики Переезда</strong> (Хабр): автоматизация 200+ заявок в день дала <strong>×4 скорость обработки сделок</strong> и <strong>+45% выручки</strong>. Система работает без сбоев с 2019 по 2026 год.</p>
          </div>
        </div>
      </div>

      <div class="nero-ai-reveal nero-ai-delay-2" id="kvalifikaciya">
        <div class="vna-scenario">
          <div class="vna-sc-icon" aria-hidden="true">🎯</div>
          <div>
            <h3>5. Квалифицирует лиды и скорирует по заданным критериям</h3>
            <p>AI-агент выступает первой линией: задаёт квалификационные вопросы по вашему сценарию (бюджет, срок, задача, кто ЛПР), оценивает ответы и присваивает скоринговый балл. «Горячие» лиды — менеджеру с пометкой «готов к покупке». «Холодные» — в нурчинг. «Нецелевые» — вежливый отказ.</p>
            <p><strong>Кейс iFabrique</strong> (стройкомпания, СПб): рост продаж <strong>+18%</strong>, рост визитов в офис <strong>+12%</strong>, стоимость квалифицированного лида снизилась в <strong>5 раз</strong> по сравнению с наймом менеджера первой линии.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA-1: после сценариев -->
  <div class="vna-cnt">
    <!-- CTA-1: PRIMARY — после блока сценариев -->
    <div class="ym-cta-block ym-cta-block--primary" id="cta-scenarii">
      <div class="ym-cta-block__icon" aria-hidden="true">🤖</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите AI-агента для своей amoCRM?</p>
        <p class="ym-cta-block__sub">Проверим вашу воронку, покажем, что можно автоматизировать прямо сейчас. Бесплатно, за 2–3 рабочих дня.</p>
        <a href="#cta" class="ym-btn ym-btn--accent ym-cta-block__btn">Получить бесплатный аудит</a>
      </div>
    </div>
  </div>

  <!-- ================================================
       РАЗДЕЛ 3: Кому нужна интеграция
       ================================================ -->
  <section class="vna-section" id="komu-nuzhno">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Целевая аудитория</span>
        <h2>Кому нужна интеграция AI с amoCRM</h2>
        <p>AI-агент окупается там, где есть регулярный поток лидов и ручные операции в CRM.</p>
      </div>

      <div class="vna-grid-3">
        <div class="vna-card nero-ai-reveal" id="potok-lidov">
          <div class="vna-eyebrow">30+ лидов в день</div>
          <h3>Компании с высоким потоком лидов</h3>
          <p>При потоке до 10–15 лидов в день менеджер физически справляется вручную. При 30+ — начинается хаос: часть заявок теряется, часть обрабатывается с задержкой в несколько часов. При 100+ лидах без AI-автоматизации невозможно обеспечить приемлемое качество первого контакта. AI-агент масштабируется без ограничений: 30 лидов или 3 000 — обрабатывает с одинаковой скоростью и качеством в любое время суток.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="manual-crm">
          <div class="vna-eyebrow">Ручное заполнение CRM</div>
          <h3>Бизнес с незаполненными карточками</h3>
          <p>Если в вашей amoCRM поля сделки заполнены на 40–60% — это симптом системной проблемы. Менеджеры не успевают, не понимают зачем или считают это лишней работой. Итог: руководитель не видит реальной картины воронки, аналитика неточна, прогнозы — угадайка.</p>
          <p>AI-агент переводит CRM на режим <strong>Zero Data Entry</strong>: поля заполняются автоматически из переписки и звонков. «В 2026 году стандарт CRM — Zero Data Entry. Человек вообще не должен касаться клавиатуры» — mayai.ru.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-2" id="zastrevayushchie">
          <div class="vna-eyebrow">Зависшие сделки</div>
          <h3>Отделы с «забытыми» лидами</h3>
          <p>«Зависший» лид — потерянные деньги. Сделка в статусе «Думает» два месяца без единого касания — нормальная ситуация для большинства CRM без автоматического контроля.</p>
          <p>AI-агент контролирует воронку 24/7: видит бездействие, автоматически запускает реактивацию, уведомляет руководителя. <strong>Кейс (РБК Компании):</strong> конверсия 8% → 27% (+238%), ROI за 3 месяца — 340%, экономия на зарплатах — 200 000 ₽/мес.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================
       БОРИС: БЛОК ПОСЛЕ #komu-nuzhno
       ================================================ -->
  <section id="boris-amocrm-viz" class="bai-root" aria-label="Результат работы AI-агента в amoCRM: CRM утром после ночной обработки">
<style>
/* === БОРИС: prefix bai-, scoped внутри #boris-amocrm-viz === */
.bai-root{padding:60px 0 72px;background:#f0f4fb;}
.bai-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
.bai-card{
  display:grid;
  grid-template-columns:42% 58%;
  border-radius:24px;
  overflow:hidden;
  box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(99,102,241,.15);
  min-height:520px;
}
@media(max-width:960px){.bai-card{grid-template-columns:1fr;min-height:auto;}}
.bai-lft{
  background:#ffffff;
  padding:48px 40px;
  display:flex;
  flex-direction:column;
  justify-content:center;
}
@media(max-width:600px){.bai-lft{padding:32px 24px;}}
.bai-ey{
  display:inline-flex;
  align-items:center;
  gap:7px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.11em;
  text-transform:uppercase;
  color:#6366f1;
  margin:0 0 15px;
}
.bai-ey::before{
  content:'';
  display:inline-block;
  width:20px;height:2px;
  background:#6366f1;
  border-radius:1px;
}
.bai-h3{
  font-size:25px;
  font-weight:800;
  color:#0f172a;
  line-height:1.3;
  margin:0 0 22px;
}
@media(max-width:600px){.bai-h3{font-size:20px;}}
.bai-ul{
  list-style:none;
  margin:0 0 26px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:10px;
}
.bai-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14.5px;
  line-height:1.5;
  color:#334155;
}
.bai-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(99,102,241,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#6366f1;
  margin-top:1px;
  font-style:normal;
}
.bai-pills{
  display:flex;
  flex-wrap:wrap;
  gap:7px;
  margin-bottom:22px;
}
.bai-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
.bai-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
.bai-pl-b{background:rgba(99,102,241,.08);color:#4338ca;border:1.5px solid rgba(99,102,241,.22);}
.bai-pl-c{background:rgba(6,182,212,.08);color:#0e7490;border:1.5px solid rgba(6,182,212,.22);}
.bai-foot{
  font-size:13.5px;
  color:#64748b;
  font-style:italic;
  margin:0;
  padding-top:2px;
}
.bai-rgt{
  background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);
  position:relative;
  overflow:hidden;
  min-height:400px;
}
@media(max-width:960px){.bai-rgt{min-height:380px;}}
#bai-crm-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bai-cnt">
<div class="bai-card">

  <!-- LEFT: редакционный текст -->
  <div class="bai-lft">
    <span class="bai-ey">Результат внедрения</span>
    <h3 class="bai-h3">CRM утром: всё заполнено, задачи стоят — менеджер только продаёт</h3>
    <ul class="bai-ul">
      <li><span class="bai-ic">★</span>Ночные заявки квалифицированы и распределены по менеджерам</li>
      <li><span class="bai-ic">✓</span>Карточки заполнены: бюджет, источник, ЛПР, потребность</li>
      <li><span class="bai-ic">◷</span>Задачи поставлены с конкретными датами и контекстом из диалога</li>
      <li><span class="bai-ic">↺</span>«Зависшие» сделки ушли на реактивацию автоматически</li>
    </ul>
    <div class="bai-pills">
      <span class="bai-pl bai-pl-g">⏱ 68 мин → 4 мин 10 сек</span>
      <span class="bai-pl bai-pl-c">24 / 7 без выходных</span>
      <span class="bai-pl bai-pl-b">ROI 340% за 3 мес.</span>
    </div>
    <p class="bai-foot">Дальше — технический стек и архитектура внедрения →</p>
  </div>

  <!-- RIGHT: canvas CRM-дашборд -->
  <div class="bai-rgt">
    <canvas
      id="bai-crm-canvas"
      aria-label="Анимация: CRM дашборд после ночной работы AI-агента — три колонки Канбан с обработанными сделками"
      role="img"
    ></canvas>
  </div>

</div>
</div>

<script>
(function(){
  var cv = document.getElementById('bai-crm-canvas');
  if (!cv) return;
  var cx = cv.getContext('2d');
  var W=0, H=0, fr=0, pulse=0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 520;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  /* ── Цвета ── */
  var C = {
    green:'#4ade80', greenD:function(a){return 'rgba(74,222,128,'+a+')';},
    blue:'#60a5fa',  blueD:function(a){return 'rgba(96,165,250,'+a+')';},
    viol:'#a78bfa',  violD:function(a){return 'rgba(167,139,250,'+a+')';},
    text:'#e2e8f0',
    muted:'rgba(226,232,240,.42)',
    card:'rgba(255,255,255,.065)',
    cardBdr:'rgba(255,255,255,.12)',
    line:'rgba(255,255,255,.07)',
    pulse:'#22c55e',
  };

  /* ── Три колонки ── */
  var COLS = [
    {label:'Входящие',   clr:C.blue,  dimFn:C.blueD},
    {label:'AI агент',   clr:C.viol,  dimFn:C.violD},
    {label:'Готово  \u2713', clr:C.green, dimFn:C.greenD},
  ];

  /* ── Карточки сделок ── */
  var CFGS = [
    {col:2, name:'\u041e\u041e\u041e \u041f\u0440\u043e\u0433\u0440\u0435\u0441\u0441', tag:'150 \u0442\u044b\u0441. \u20bd', delay:50},
    {col:2, name:'\u0418\u041f \u0421\u043c\u0438\u0440\u043d\u043e\u0432',   tag:'80 \u0442\u044b\u0441. \u20bd',  delay:120},
    {col:0, name:'\u0422\u0435\u0445\u041b\u0438\u0434\u0435\u0440',      tag:'\u043d\u043e\u0432\u0430\u044f \u0437\u0430\u044f\u0432\u043a\u0430', delay:195},
    {col:1, name:'\u041c\u0435\u0434\u0438\u0430 \u0413\u0440\u0443\u043f\u043f',   tag:'\u043a\u0432\u0430\u043b\u0438\u0444\u0438\u043a\u0430\u0446\u0438\u044f\u2026', delay:265},
    {col:2, name:'\u0410\u043b\u044c\u0444\u0430-\u0421\u0442\u0440\u043e\u0439',   tag:'340 \u0442\u044b\u0441. \u20bd',  delay:340},
    {col:0, name:'\u0411\u0438\u0437\u043d\u0435\u0441\u041f\u0440\u043e',     tag:'\u043d\u043e\u0432\u0430\u044f \u0437\u0430\u044f\u0432\u043a\u0430',  delay:415},
    {col:1, name:'\u0420\u0438\u0442\u043c \u041f\u0440\u043e\u0434\u0430\u0436',   tag:'\u043a\u0432\u0430\u043b\u0438\u0444\u0438\u043a\u0430\u0446\u0438\u044f\u2026', delay:490},
  ];

  var colCnt = [0,0,0];
  var cards = CFGS.map(function(cfg){
    var ord = colCnt[cfg.col]++;
    return {col:cfg.col, name:cfg.name, tag:cfg.tag, delay:cfg.delay,
            ord:ord, curY:-90, alpha:0, started:false, settled:false};
  });

  var LOOP = 720;

  function rr(x,y,w,h,r,fill,stroke,lw){
    cx.beginPath();
    if(cx.roundRect){cx.roundRect(x,y,w,h,r);}
    else{
      cx.moveTo(x+r,y);cx.arcTo(x+w,y,x+w,y+h,r);
      cx.arcTo(x+w,y+h,x,y+h,r);cx.arcTo(x,y+h,x,y,r);
      cx.arcTo(x,y,x+w,y,r);cx.closePath();
    }
    if(fill){cx.fillStyle=fill;cx.fill();}
    if(stroke){cx.strokeStyle=stroke;cx.lineWidth=lw||1.5;cx.stroke();}
  }

  function drawTopBar(){
    cx.fillStyle=C.text;
    cx.font='bold 13px Inter,system-ui,sans-serif';
    cx.textAlign='left';
    cx.fillText('amoCRM  \u2014  \u0441\u0435\u0433\u043e\u0434\u043d\u044f, 03:47',16,26);

    var gR = 8+Math.sin(pulse*0.07)*3;
    cx.beginPath();cx.arc(W-64,22,gR+4,0,Math.PI*2);
    cx.fillStyle='rgba(34,197,94,'+(0.1+0.08*Math.sin(pulse*0.07))+')';
    cx.fill();
    cx.beginPath();cx.arc(W-64,22,4,0,Math.PI*2);
    cx.fillStyle=C.pulse;cx.fill();
    cx.fillStyle=C.green;
    cx.font='11px Inter,system-ui,sans-serif';
    cx.textAlign='left';
    cx.fillText('AI active',W-52,26);

    cx.strokeStyle=C.line;cx.lineWidth=1;
    cx.beginPath();cx.moveTo(0,38);cx.lineTo(W,38);cx.stroke();
  }

  function getLayout(){
    var PAD=10,TOP=46,GAP=8;
    var colW=(W-PAD*2-GAP*2)/3;
    var colH=H-TOP-PAD-40;
    return {PAD:PAD,TOP:TOP,GAP:GAP,colW:colW,colH:colH};
  }

  function drawColumns(L){
    COLS.forEach(function(col,i){
      var x=L.PAD+i*(L.colW+L.GAP);
      rr(x,L.TOP,L.colW,L.colH,10,C.card,C.cardBdr,1.5);
      cx.fillStyle=col.clr;
      cx.font='bold 11px Inter,system-ui,sans-serif';
      cx.textAlign='center';
      cx.fillText(col.label,x+L.colW/2,L.TOP+20);
      var cnt=cards.filter(function(c){return c.col===i&&c.settled;}).length;
      if(cnt>0){
        rr(x+L.colW-28,L.TOP+8,22,18,9,col.dimFn(0.18),null,0);
        cx.fillStyle=col.clr;
        cx.font='bold 11px Inter,sans-serif';
        cx.textAlign='center';
        cx.fillText(cnt,x+L.colW-17,L.TOP+21);
      }
    });
  }

  function drawCards(L){
    var CH=60,CG=7;
    var CTOP=L.TOP+32;
    var sorted=cards.slice().sort(function(a,b){return (b.settled?1:0)-(a.settled?1:0);});
    sorted.forEach(function(card){
      if(!card.started) return;
      var i=card.col;
      var x=L.PAD+i*(L.colW+L.GAP)+7;
      var w=L.colW-14;
      var finalY=CTOP+card.ord*(CH+CG);

      if(!card.settled){
        card.curY+=( finalY-card.curY)*0.11;
        card.alpha=Math.min(1,card.alpha+0.07);
        if(Math.abs(card.curY-finalY)<1.5){card.settled=true;card.curY=finalY;}
      }
      cx.globalAlpha=card.settled?1:card.alpha;

      var bgFill=i===2?C.greenD(0.1):i===1?C.violD(0.08):C.blueD(0.06);
      var bdr   =i===2?C.greenD(0.28):i===1?C.violD(0.22):C.blueD(0.2);
      rr(x,card.curY,w,CH,8,bgFill,bdr,1.5);

      var maxCh=Math.max(8,Math.floor(w/10));
      var nm=card.name.length>maxCh?card.name.slice(0,maxCh-1)+'\u2026':card.name;
      cx.fillStyle=C.text;
      cx.font='bold 12px Inter,system-ui,sans-serif';
      cx.textAlign='left';
      cx.fillText(nm,x+10,card.curY+19);

      var tc=i===2?C.green:i===1?C.viol:C.blue;
      rr(x+8,card.curY+26,w-16,18,5,i===2?C.greenD(0.15):i===1?C.violD(0.13):C.blueD(0.12),null,0);
      cx.fillStyle=tc;
      cx.font='10px Inter,system-ui,sans-serif';
      cx.textAlign='center';
      var tag=card.tag.length>18?card.tag.slice(0,17)+'\u2026':card.tag;
      cx.fillText(tag,x+w/2,card.curY+38);

      if(i===2){
        cx.fillStyle=C.green;
        cx.font='bold 15px sans-serif';
        cx.textAlign='right';
        cx.fillText('\u2713',x+w-9,card.curY+18);
      } else if(i===1){
        for(var d=0;d<3;d++){
          var ang=(d/3)*Math.PI*2+pulse*0.09+card.delay*0.05;
          cx.beginPath();
          cx.arc(x+w-16+Math.cos(ang)*6,card.curY+18+Math.sin(ang)*6,2.5,0,Math.PI*2);
          cx.fillStyle=C.viol;cx.fill();
        }
      } else {
        rr(x+w-34,card.curY+8,28,14,7,C.blueD(0.2),null,0);
        cx.fillStyle=C.blue;
        cx.font='bold 9px Inter,sans-serif';
        cx.textAlign='center';
        cx.fillText('NEW',x+w-20,card.curY+18);
      }
      cx.globalAlpha=1;
    });
  }

  function drawBottomBar(){
    var barY=H-38;
    cx.strokeStyle=C.line;cx.lineWidth=1;
    cx.beginPath();cx.moveTo(0,barY);cx.lineTo(W,barY);cx.stroke();
    var done=cards.filter(function(c){return c.settled&&c.col===2;}).length;
    var inWork=cards.filter(function(c){return c.started&&c.col!==2;}).length;
    cx.fillStyle=C.muted;
    cx.font='11px Inter,system-ui,sans-serif';
    cx.textAlign='left';
    cx.fillText('\u041e\u0431\u0440\u0430\u0431\u043e\u0442\u0430\u043d\u043e \u0437\u0430 \u043d\u043e\u0447\u044c: '+done+' \u0441\u0434\u0435\u043b\u043e\u043a \u0433\u043e\u0442\u043e\u0432\u044b'+(inWork>0?',  '+inWork+' \u0432 \u0440\u0430\u0431\u043e\u0442\u0435':''),14,barY+19);
  }

  function loop(){
    fr++;pulse++;
    var loopFr=fr%LOOP;

    if(loopFr===0){
      cards.forEach(function(c){c.started=false;c.settled=false;c.curY=-90;c.alpha=0;});
    }

    cards.forEach(function(c){
      if(!c.started&&loopFr>=c.delay){
        c.started=true;c.curY=-90;c.alpha=0;c.settled=false;
      }
    });

    cx.clearRect(0,0,W,H);
    drawTopBar();
    var L=getLayout();
    drawColumns(L);
    drawCards(L);
    drawBottomBar();

    requestAnimationFrame(loop);
  }

  document.fonts.ready.then(function(){loop();});
})();
</script>
</section>

  <!-- ================================================
       РАЗДЕЛ 4: Технический стек
       ================================================ -->
  <section class="vna-section" id="stek">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Архитектура</span>
        <h2>Технический стек: как мы строим<br>AI-агента для amoCRM</h2>
        <p>Интеграция строится через официальный API amoCRM v4 (REST) и механизм webhooks. Внешний AI-сервис работает независимо от amoCRM и не ограничен возможностями виджетов.</p>
      </div>

      <div class="vna-card nero-ai-reveal" id="arhitektura">
        <h3 style="font-size:20px;margin-bottom:18px;">Архитектура: внешний AI-сервис + API amoCRM v4</h3>
        <p>Агент получает уведомления о событиях через REST-методы: <code style="background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;">leads</code>, <code style="background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;">contacts</code>, <code style="background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;">tasks</code>, <code style="background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;">notes</code>, <code style="background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;">pipelines</code>. Аутентификация — OAuth 2.0. API v4 поддерживает до 50 запросов в секунду на аккаунт. Webhooks настраиваются на любые события: <code style="background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;">add_lead</code>, <code style="background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;">update_lead</code>, <code style="background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;">add_contact</code>, <code style="background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;">update_task</code> и другие.</p>
      </div>

      <div style="margin-top:32px;" id="stek-2026">
        <h3 style="font-size:20px;margin-bottom:20px;color:#fff;">Стек 2026: Claude / GPT-4o + Make.com / n8n + amoCRM webhooks</h3>
        <div class="vna-stack-layer nero-ai-reveal">
          <div class="vna-stack-label">CRM</div>
          <div><div class="vna-stack-val">amoCRM API v4</div><div class="vna-stack-desc">Источник событий, хранилище данных, webhooks на любые события</div></div>
        </div>
        <div class="vna-stack-layer nero-ai-reveal nero-ai-delay-1">
          <div class="vna-stack-label">Оркестрация</div>
          <div><div class="vna-stack-val">Make.com / n8n / Albato</div><div class="vna-stack-desc">Маршрутизация событий, логика сценариев, визуальный конструктор</div></div>
        </div>
        <div class="vna-stack-layer nero-ai-reveal nero-ai-delay-1">
          <div class="vna-stack-label">AI-модель</div>
          <div><div class="vna-stack-val">GPT-4o / Claude 3.5/4 / GigaChat / YandexGPT</div><div class="vna-stack-desc">Генерация ответов, суммаризация, принятие решений, квалификация</div></div>
        </div>
        <div class="vna-stack-layer nero-ai-reveal nero-ai-delay-2">
          <div class="vna-stack-label">STT</div>
          <div><div class="vna-stack-val">Yandex SpeechKit / OpenAI Whisper / SaluteSpeech</div><div class="vna-stack-desc">Транскрибация звонков в текст; SaluteSpeech для ПДн по 152-ФЗ</div></div>
        </div>
        <div class="vna-stack-layer nero-ai-reveal nero-ai-delay-1">
          <div class="vna-stack-label">База знаний</div>
          <div><div class="vna-stack-val">Qdrant / pgvector (RAG)</div><div class="vna-stack-desc">Ответы по документам компании без галлюцинаций; обновление в реальном времени</div></div>
        </div>
        <div class="vna-stack-layer nero-ai-reveal">
          <div class="vna-stack-label">Телефония</div>
          <div><div class="vna-stack-val">Sipuni, Mango Office, Beeline Business, UIS, CallTouch</div><div class="vna-stack-desc">Запись и передача звонков на транскрибацию; CDR для скоринга</div></div>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" id="transkripciya" style="margin-top:32px;">
        <h3 style="font-size:19px;margin-bottom:14px;">Транскрипция звонков: Whisper / SpeechKit + автозаполнение карточки</h3>
        <div class="vna-timeline">
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <p>Звонок завершился → телефония (Sipuni, Mango, CallTouch) отправляет запись на сервер AI-агента.</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <p>STT-модель (Yandex SpeechKit или OpenAI Whisper) транскрибирует аудио в текст.</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <p>AI-агент анализирует транскрипт: выявляет договорённости, возражения, следующие шаги, упомянутые суммы и сроки.</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <p>В карточке сделки amoCRM появляется: <strong>резюме звонка</strong>, задача на следующий контакт, обновлённые поля (бюджет, срок, статус решения).</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <p>Руководитель получает <strong>скоринговую оценку каждого звонка</strong> по заданным критериям качества — без прослушивания.</p>
          </div>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" id="rag" style="margin-top:20px;">
        <h3 style="font-size:19px;margin-bottom:10px;">RAG и база знаний для точной квалификации лидов</h3>
        <p>RAG (Retrieval-Augmented Generation) — архитектура, при которой AI-агент перед каждым ответом обращается к базе знаний компании: прайсам, FAQ, скриптам продаж, регламентам. Это устраняет «галлюцинации» — AI отвечает только по содержимому вашей базы.</p>
        <p>Документы компании (Notion, Google Docs, PDF, Excel) → векторизация → база Qdrant или pgvector → AI-агент делает семантический поиск при каждом ответе. Обновление базы знаний не требует перенастройки: добавили новый прайс в Notion — агент начнёт отвечать по нему немедленно.</p>
      </div>
    </div>
  </section>

  <!-- ================================================
       РАЗДЕЛ 5: Кейсы
       ================================================ -->
  <section class="vna-section vna-section-alt" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Реальные результаты</span>
        <h2>Кейсы: реальные результаты<br>внедрения AI в amoCRM</h2>
        <p>Только публичные кейсы с конкретными цифрами до и после внедрения.</p>
      </div>

      <div class="vna-case-grid">
        <div class="vna-case-card nero-ai-reveal" id="keis-kvalifikaciya">
          <div class="vna-case-tag">Кейс · РБК Компании</div>
          <h3>Автоквалификация лидов — конверсия ×3</h3>
          <p style="font-size:14px;">Российская IT-компания. Конверсия упала с 15% до 8%, цикл сделки вырос с 45 до 78 дней. Причина: менеджеры не успевали обрабатывать входящий поток.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">+238%</span><span class="lbl">рост конверсии (8% → 27%)</span></div>
            <div class="vna-metric"><span class="num">340%</span><span class="lbl">ROI внедрения за 3 месяца</span></div>
            <div class="vna-metric"><span class="num">200К₽</span><span class="lbl">экономия на зарплатах / мес</span></div>
          </div>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-1" id="keis-kartochki">
          <div class="vna-case-tag">Кейс · Хабр</div>
          <h3>Автозаполнение карточек — экономия 2 часа/день</h3>
          <p style="font-size:14px;">Фабрика Переезда (Москва). 200+ заявок в день, хаос коммуникаций, менеджеры физически не справлялись с ручным вводом.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">×4</span><span class="lbl">скорость обработки сделок</span></div>
            <div class="vna-metric"><span class="num">+45%</span><span class="lbl">рост выручки</span></div>
            <div class="vna-metric"><span class="num">88%</span><span class="lbl">NPS клиентов (с 2019 по 2026)</span></div>
          </div>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-2" id="keis-voronka">
          <div class="vna-case-tag">Кейс · SaleKit</div>
          <h3>Контроль воронки — ноль «забытых» лидов</h3>
          <p style="font-size:14px;">Оптовый продавец, 180–220 заявок в день. Задача: сократить время реакции, поднять повторные заказы.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">4 мин</span><span class="lbl">время ответа (было 68 мин)</span></div>
            <div class="vna-metric"><span class="num">×2</span><span class="lbl">выручка за 9 месяцев</span></div>
            <div class="vna-metric"><span class="num">46%</span><span class="lbl">повторные заказы (было 27%)</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA-2: после кейсов -->
  <div class="vna-cnt">
    <!-- CTA-2: после кейсов — PRIMARY + SECONDARY -->
    <div class="ym-cta-block ym-cta-block--dual" id="cta-keisy">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите таких же результатов?</p>
        <p class="ym-cta-block__sub">ROI 340% за 3 месяца, ×2 выручки за 9 месяцев, ноль «забытых» лидов — это реальные кейсы наших клиентов. Следующий может быть ваш.</p>
        <div class="ym-cta-block__actions">
          <a href="#cta" class="ym-btn ym-btn--accent">Получить бесплатный аудит</a>
          <a href="#etapy" class="ym-btn ym-btn--ghost">Как проходит внедрение →</a>
        </div>
      </div>
    </div>
  </div>

  <!-- ================================================
       РАЗДЕЛ 6: Этапы внедрения
       ================================================ -->
  <section class="vna-section" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Процесс</span>
        <h2>Как проходит внедрение AI в amoCRM:<br>5 этапов</h2>
        <p>От первого контакта до работающей системы — прозрачный процесс без лишних слов.</p>
      </div>

      <div class="nero-ai-reveal">
        <div class="vna-timeline" id="audit">
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <h3>Этап 1. Аудит текущих процессов и воронки</h3>
            <p>Nero Network начинает с бесплатного аудита. Анализируем: текущую структуру воронок в amoCRM, качество заполнения полей (среднее в нашей практике — 40–60%), какие задачи теряются, источники лидов и реальное время первого ответа, интеграции с телефонией и мессенджерами. По итогам — конкретная карта автоматизации с приоритетами и ожидаемым эффектом. Без общих слов.</p>
          </div>
          <div class="vna-tl-item" id="proektirovanie">
            <div class="vna-tl-dot"></div>
            <h3>Этап 2. Проектирование сценариев AI-агента</h3>
            <p>На основе аудита определяем приоритетные сценарии: квалификация входящих, транскрибация звонков, реактивация «заснувших» сделок, контроль воронки. Прописываем логику работы агента: какие вопросы задаёт, как принимает решения, когда эскалирует к живому менеджеру. Готовим базу знаний: описание продуктов, прайс, скрипты продаж, FAQ с типовыми возражениями.</p>
          </div>
          <div class="vna-tl-item" id="razrabotka">
            <div class="vna-tl-dot"></div>
            <h3>Этап 3. Разработка и настройка интеграции (2–4 недели)</h3>
            <p>Стандартные сроки: <strong>базовый уровень</strong> (настройка amoAI + автозадачи) — 3–5 рабочих дней; <strong>виджетный стек</strong> (Make.com/n8n + LLM + транскрибация) — 2–3 недели; <strong>агентный уровень</strong> (MCP + AI Agents SDK + полная автоматизация) — 3–5 недель. Строим интеграции с телефонией и мессенджерами, настраиваем RAG-базу знаний, реализуем логику эскалации.</p>
          </div>
          <div class="vna-tl-item" id="testirovanie">
            <div class="vna-tl-dot"></div>
            <h3>Этап 4. Тестирование на реальном трафике</h3>
            <p>Запускаем агента на тестовой воронке — реальные входящие заявки, но с ручным контролем каждого решения агента. Смотрим на: точность квалификации, качество ответов, корректность переводов по воронке, случаи эскалации. Корректируем базу знаний, уточняем правила, настраиваем пороги принятия решений. Стандартный период тестирования — 1–2 недели.</p>
          </div>
          <div class="vna-tl-item" id="podderzhka">
            <div class="vna-tl-dot"></div>
            <h3>Этап 5. Обучение команды и постпроектная поддержка</h3>
            <p>Проводим обучение: как работать с аналитикой AI-агента, как читать скоринг звонков, как управлять базой знаний. Предоставляем документацию и видеоинструкции. Постпроектная поддержка — 3 месяца включены в стоимость. Обновление базы знаний: добавили новый прайс в Notion — агент начинает использовать новые данные без перенастройки.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================
       РАЗДЕЛ 7: Стоимость
       ================================================ -->
  <section class="vna-section vna-section-alt" id="ceny">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Инвестиции</span>
        <h2>Сколько стоит AI-агент для amoCRM</h2>
        <p>Прозрачные тарифы без скрытых платежей. Ежемесячные расходы — 7 000–23 000 ₽/мес на операционные нужды.</p>
      </div>

      <div class="vna-pricing-grid nero-ai-reveal" id="tarify">
        <div class="vna-price-card">
          <div class="tier">Базовый</div>
          <div class="amount">от 60 000 ₽</div>
          <div class="inc">Настройка amoAI + автозадачи + базовая квалификация. Срок: 3–5 дней.</div>
        </div>
        <div class="vna-price-card vna-featured">
          <div class="tier">Стандартный ★</div>
          <div class="amount">от 200 000 ₽</div>
          <div class="inc">Make.com/n8n + LLM + транскрибация звонков + RAG-база знаний. Срок: 2–3 недели.</div>
        </div>
        <div class="vna-price-card">
          <div class="tier">Комплексный</div>
          <div class="amount">от 450 000 ₽</div>
          <div class="inc">MCP + AI Agents SDK + полная автоматизация воронки. Срок: 3–5 недель.</div>
        </div>
        <div class="vna-price-card">
          <div class="tier">Enterprise</div>
          <div class="amount">от 700 000 ₽</div>
          <div class="inc">Кастомная архитектура + интеграция с 1С/ERP/BI. Индивидуальные сроки.</div>
        </div>
      </div>

      <div class="vna-grid-2" style="margin-top:28px;">
        <div class="vna-card nero-ai-reveal" id="mesyachnye-rashody">
          <h3 style="font-size:18px;margin-bottom:10px;">Ежемесячные расходы: 7 000–23 000 ₽/мес</h3>
          <ul>
            <li>API нейросети (GPT-4o / Claude): 5 000–15 000 ₽/мес в зависимости от объёма диалогов</li>
            <li>Инфраструктура (Make.com/n8n, STT, RAG-хостинг): 2 000–8 000 ₽/мес</li>
            <li>Итого: 7 000–23 000 ₽/мес — против зарплаты менеджера первой линии 40 000–60 000 ₽/мес</li>
          </ul>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="roi">
          <h3 style="font-size:18px;margin-bottom:10px;">ROI: типичная окупаемость 1–2 месяца</h3>
          <ul>
            <li><strong>Через экономию:</strong> AI высвобождает 2–3 менеджеров от рутины — экономия 80 000–180 000 ₽/мес. При стоимости внедрения 200 000 ₽ — окупаемость 2–3 месяца.</li>
            <li><strong>Через рост конверсии:</strong> при потоке 100 лидов/мес и росте конверсии с 10% до 15% — 5 дополнительных сделок. При среднем чеке 100 000 ₽ — +500 000 ₽ выручки/мес.</li>
            <li><strong>Реальный кейс (РБК):</strong> экономия 200 000 ₽/мес на зарплатах, ROI 340% за 3 месяца.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================
       РАЗДЕЛ 8: Сравнение
       ================================================ -->
  <section class="vna-section" id="sravnenie">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Сравнение</span>
        <h2>AI-агент в amoCRM vs Bitrix24 CoPilot</h2>
        <p>Когда amoCRM — лучший выбор для AI-автоматизации отдела продаж.</p>
      </div>

      <div class="vna-compare-wrap nero-ai-reveal" id="amocrm-vs-b24">
        <table class="vna-compare" aria-label="Сравнение amoCRM и Bitrix24 CoPilot">
          <thead>
            <tr>
              <th>Параметр</th>
              <th>amoCRM + AI-агент</th>
              <th>Bitrix24 CoPilot</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Фокус CRM</td>
              <td class="vna-good">Воронка продаж, B2C и B2B для МСБ</td>
              <td class="vna-neutral">Корпоративный портал + CRM</td>
            </tr>
            <tr>
              <td>API для интеграций</td>
              <td class="vna-good">Чистый REST v4, удобный для LLM</td>
              <td class="vna-neutral">Более сложный, много legacy</td>
            </tr>
            <tr>
              <td>Webhooks</td>
              <td class="vna-good">Гибкие, на любые события из коробки</td>
              <td class="vna-neutral">Ограничены в базовых тарифах</td>
            </tr>
            <tr>
              <td>AI из коробки</td>
              <td class="vna-good">amoAI (OpenAI/YandexGPT, тарифы Pro+)</td>
              <td class="vna-neutral">CoPilot (встроен, ограниченный)</td>
            </tr>
            <tr>
              <td>Кастомный AI-агент</td>
              <td class="vna-good">MCP + API v4 — отлично поддерживается</td>
              <td class="vna-neutral">Возможно, но сложнее в реализации</td>
            </tr>
            <tr>
              <td>Стоимость (5–15 чел.)</td>
              <td class="vna-good">Ниже при фокусе на продажи</td>
              <td class="vna-neutral">Выше за сопоставимый функционал</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="vna-card nero-ai-reveal" id="limity" style="margin-top:24px;">
        <h3 style="font-size:18px;margin-bottom:10px;">Ограничения API amoCRM и как мы их решаем</h3>
        <p>API amoCRM v4 имеет лимит — до 50 запросов в секунду на аккаунт. При высоком потоке лидов нужно управлять очередями запросов. Nero Network использует <strong>очереди (Redis / RabbitMQ)</strong> для бесперебойной работы при пиковой нагрузке, <strong>batch-операции</strong> для массовых обновлений полей, <strong>кэширование</strong> часто запрашиваемых данных. При правильной архитектуре 200–500 заявок в день обрабатываются без деградации производительности.</p>
      </div>
    </div>
  </section>

  <!-- ================================================
       РАЗДЕЛ 9: FAQ
       ================================================ -->
  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Вопрос — ответ</span>
        <h2>FAQ: частые вопросы об AI в amoCRM</h2>
      </div>

      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item" id="faq-vstroennyy">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Есть ли встроенный AI-агент в amoCRM из коробки?</div>
          <div class="vna-faq-a">
            <p>Да. В 2026 году amoCRM запустил amoAI — нативного AI-агента на базе OpenAI или YandexGPT, доступного на тарифах Профессиональный и Enterprise. Агент умеет создавать задачи, менять ответственного, двигать сделки по воронке, запускать Salesbot, управлять тегами, заполнять поля. Это хорошая отправная точка. Но для полной автоматизации (транскрибация звонков, мультиканальность, RAG на базе ваших документов, агентная архитектура с MCP) нужен кастомный внешний AI-агент — именно его и строит Nero Network.</p>
          </div>
        </div>
        <div class="vna-faq-item" id="faq-sroki">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как долго длится внедрение?</div>
          <div class="vna-faq-a">
            <p>Базовый уровень — 3–5 рабочих дней. Стандартный стек с транскрибацией звонков и Make.com/n8n — 2–3 недели. Полная агентная архитектура с MCP и RAG — 3–5 недель. Срок зависит от готовности базы знаний и сложности текущей воронки в amoCRM.</p>
          </div>
        </div>
        <div class="vna-faq-item" id="faq-programmist">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли программист для работы AI в amoCRM?</div>
          <div class="vna-faq-a">
            <p>Для управления системой после запуска — нет. Обновление базы знаний (прайс, FAQ, скрипты продаж) делается через Notion или Google Docs без кода. Настройка бизнес-правил воронки — через интерфейс Make.com/n8n. Для первоначального внедрения, доработок и изменений архитектуры нужна команда интеграторов с опытом работы с LLM и API amoCRM — именно это делает Nero Network.</p>
          </div>
        </div>
        <div class="vna-faq-item" id="faq-obem">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько лидов может обработать AI-агент в день?</div>
          <div class="vna-faq-a">
            <p>Без жёстких технических ограничений — тысячи. Практический предел определяется лимитами API amoCRM (50 req/s), лимитами телефонии при транскрибации и стоимостью API-токенов нейросети. При грамотной архитектуре с очередями система стабильно обрабатывает 500–2 000 лидов в день без деградации качества.</p>
          </div>
        </div>
        <div class="vna-faq-item" id="faq-dannye">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Какие данные видит AI-агент в amoCRM?</div>
          <div class="vna-faq-a">
            <p>Только то, на что выданы права через OAuth 2.0: сделки, контакты, задачи, примечания, воронки, история переписки в amoCRM. Агент не имеет доступа к файловой системе, email-ящикам менеджеров или внешним системам без явной интеграции. Набор прав настраивается при внедрении в соответствии с принципом минимально необходимого доступа. Персональные данные по 152-ФЗ обезличиваются до передачи в облачные LLM.</p>
          </div>
        </div>
        <div class="vna-faq-item" id="faq-rossiyskie-llm">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли подключить российские LLM (GigaChat, YandexGPT)?</div>
          <div class="vna-faq-a">
            <p>Да. Nero Network строит интеграции с GigaChat (СберБанк) и YandexGPT (Яндекс). Российские модели предпочтительны для данных, содержащих персональные данные по 152-ФЗ: они хранят данные в российской юрисдикции. Для задач без ПДн (квалификация по описанию продукта, суммаризация без имён) используются GPT-4o или Claude как более точные на сложных логических задачах.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================
       РАЗДЕЛ 10: Через 3 месяца
       ================================================ -->
  <section class="vna-section" id="cherez-3-mesyaca">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">После внедрения</span>
        <h2>Через 3 месяца после внедрения:<br>что видит руководитель</h2>
        <p>Картина, которую видит руководитель отдела продаж через 90 дней после запуска AI-агента.</p>
      </div>

      <div class="vna-grid-2">
        <div class="vna-card nero-ai-reveal">
          <h3 style="font-size:18px;margin-bottom:10px;">🌅 Утро в amoCRM</h3>
          <p>Все заявки, поступившие ночью и в выходные, — уже в CRM со статусами: квалифицирован / нецелевой / ждёт перезвона. Карточки заполнены: источник, бюджет, потребность, назначенный менеджер, задача с конкретной датой и описанием. Руководитель сразу видит приоритеты — без разбора хаоса входящих.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1">
          <h3 style="font-size:18px;margin-bottom:10px;">📊 Аналитика воронки</h3>
          <p>Видна реальная картина: откуда приходят качественные лиды, на каком этапе сделки чаще всего «зависают», какой менеджер закрывает лучший процент. Данных достаточно для конкретных управленческих решений — без ручного сбора статистики и Excel-таблиц.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1">
          <h3 style="font-size:18px;margin-bottom:10px;">🎙️ Контроль качества звонков</h3>
          <p>Без прослушивания сотен звонков руководитель видит скоринговую оценку каждого. Топ-10 «проблемных» звонков за неделю — перед глазами. Время на контроль качества сокращается <strong>в 5–8 раз</strong> при охвате 100% звонков. По результатам — точечный коучинг менеджеров.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-2">
          <h3 style="font-size:18px;margin-bottom:10px;">🔁 Нагрузка менеджеров</h3>
          <p>Вместо 40–70% времени на рутину — <strong>10–15%</strong>. Менеджеры проводят переговоры с подготовленными лидами, а не вводят данные. По опыту внедрений: <strong>15–25% «заснувших» клиентов</strong> возвращаются в диалог при автоматической реактивации через AI-агента.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================
       ФИНАЛЬНЫЙ CTA
       ================================================ -->
  <section class="vna-section" id="cta" style="background:linear-gradient(135deg,rgba(249,115,22,.08),rgba(139,92,246,.08));">
    <div class="vna-cnt" style="text-align:center;">
      <span class="vna-eyebrow">Первый шаг бесплатно</span>
      <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:700px;">
        Начать внедрение:<br>бесплатный аудит amoCRM
      </h2>
      <p style="max-width:580px;margin:0 auto 28px;font-size:16px;">
        Nero Network проверяет: текущее состояние воронок и качество заполнения CRM, какие процессы автоматизировать прямо сейчас, какой уровень AI-агента оптимален для вашего потока лидов, ориентировочный ROI и сроки окупаемости.
      </p>
      <ul class="vna-cta-checklist">
        <li>Аудит за 2–3 рабочих дня</li>
        <li>Конкретный план с приоритетами</li>
        <li>Стек и бюджет под ваш поток</li>
        <li>Без обязательств</li>
      </ul>
      <a href="#cta" class="ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;">
        Получить бесплатный аудит amoCRM
      </a>
    </div>
  </section>

  <!-- CTA-3: финальный блок перед footer (баннер партнёра не настроен) -->
  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы автоматизировать amoCRM?</p>
        <p class="ym-cta-block__sub">Бесплатный аудит — первый шаг. Покажем, что прямо сейчас теряет ваш отдел продаж, и как это исправить за 2–3 недели.</p>
        <a href="#cta" class="ym-btn ym-btn--accent">Проверить amoCRM бесплатно</a>
      </div>
    </div>
  </div>

</div><!-- /.vna-content -->

<!-- ====================================================
     FAQ ACCORDION
     ==================================================== -->
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

<!-- ====================================================
     REVEAL (IntersectionObserver)
     ==================================================== -->
<script>
(function(){
  'use strict';
  var root = document.querySelector('.vna-content');
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

<!-- ====================================================
     JSON-LD: FAQPage + Organization
     ==================================================== -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Есть ли встроенный AI-агент в amoCRM из коробки?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да. В 2026 году amoCRM запустил amoAI — нативного AI-агента на базе OpenAI или YandexGPT, доступного на тарифах Профессиональный и Enterprise. Для полной автоматизации (транскрибация звонков, RAG, MCP-архитектура) нужен кастомный внешний AI-агент — именно его строит Nero Network."
          }
        },
        {
          "@type": "Question",
          "name": "Как долго длится внедрение AI в amoCRM?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Базовый уровень — 3–5 рабочих дней. Стандартный стек с транскрибацией звонков и Make.com/n8n — 2–3 недели. Полная агентная архитектура с MCP и RAG — 3–5 недель."
          }
        },
        {
          "@type": "Question",
          "name": "Нужен ли программист для работы AI в amoCRM?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Для управления системой после запуска — нет. Обновление базы знаний делается через Notion или Google Docs без кода. Для первоначального внедрения и доработок нужна команда интеграторов с опытом LLM и API amoCRM."
          }
        },
        {
          "@type": "Question",
          "name": "Сколько лидов может обработать AI-агент в день?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "При грамотной архитектуре с очередями система стабильно обрабатывает 500–2 000 лидов в день. Практический предел определяется лимитами API amoCRM (50 req/s) и стоимостью API-токенов нейросети."
          }
        },
        {
          "@type": "Question",
          "name": "Какие данные видит AI-агент в amoCRM?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Только то, на что выданы права через OAuth 2.0: сделки, контакты, задачи, примечания, воронки, история переписки. Персональные данные по 152-ФЗ обезличиваются до передачи в облачные LLM."
          }
        },
        {
          "@type": "Question",
          "name": "Можно ли подключить российские LLM (GigaChat, YandexGPT) к amoCRM?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да. Nero Network строит интеграции с GigaChat (СберБанк) и YandexGPT (Яндекс). Российские модели предпочтительны для данных с персональными данными по 152-ФЗ: они хранят данные в российской юрисдикции."
          }
        }
      ]
    },
    {
      "@type": "Organization",
      "name": "Nero Network",
      "description": "Интегратор AI-агентов для amoCRM и автоматизации бизнес-процессов. Внедрение AI в CRM под ключ: кейсы, стек, цены.",
      "areaServed": "RU",
      "serviceType": [
        "Внедрение AI в amoCRM",
        "Интеграция AI-агентов с CRM",
        "Автоматизация отдела продаж",
        "Транскрибация звонков и автозаполнение CRM"
      ]
    }
  ]
}
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

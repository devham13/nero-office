<?php
/**
 * Template Name: AI follow-up менеджер: внедрение повторных касаний в CRM
 * Description: SEO-лонгрид — AI follow-up для зависших сделок в CRM. Сценарии, интеграции, KPI. Разбор воронки по запросу.
 */

$page_seo_title       = 'AI follow-up менеджер: внедрение повторных касаний в CRM';
$page_seo_description = 'Зависшие сделки в CRM? Внедрим AI follow-up: персональные повторные касания по сценарию — email, мессенджер, задачи менеджеру. Разбор воронки по запросу.';

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

$nero_ai_header_links = [
    ['label' => 'Проблема', 'href' => '#pochemu-zavisayut'],
    ['label' => 'Как работает', 'href' => '#chto-takoe'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'KPI', 'href' => '#kpi'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Разобрать зависшие сделки';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение n8n и промптам';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: 'https://t.me/nero_network';
$secondary_cta_attrs = (strpos($secondary_cta_url, 'http') === 0) ? ' target="_blank" rel="noopener noreferrer"' : '';

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
.vnfu-content{
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
  color:var(--vnfu-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vnfu-content *,.vnfu-content *::before,.vnfu-content *::after{box-sizing:border-box;}
.vnfu-content a{color:inherit;text-decoration:none;}
.vnfu-content p{color:var(--vnfu-muted);line-height:1.72;margin:0 0 1em;}
.vnfu-content p:last-child{margin-bottom:0;}
.vnfu-content h2,.vnfu-content h3,.vnfu-content h4{
  color:var(--vnfu-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.vnfu-content strong{color:var(--vnfu-soft);}
.vnfu-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vnfu-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--vnfu-muted);font-size:14.5px;line-height:1.65;
}
.vnfu-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--vnfu-accent);font-weight:700;
}

/* Container */
.vnfu-cnt{
  width:min(var(--vnfu-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.vnfu-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vnfu-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.vnfu-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vnfu-sh.vnfu-left{margin-left:0;text-align:left;}
.vnfu-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vnfu-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vnfu-sh.vnfu-left p{margin-left:0;}

/* Eyebrow */
.vnfu-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vnfu-accent);margin-bottom:14px;
}

/* Gradient text */
.vnfu-gt{
  background:linear-gradient(92deg,#fff 0%,var(--vnfu-accent) 44%,var(--vnfu-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.vnfu-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.vnfu-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.vnfu-intro-text{
  position:relative;padding-left:20px;
}
.vnfu-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--vnfu-accent),var(--vnfu-violet));
}
.vnfu-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--vnfu-muted);margin-bottom:1em;
}
.vnfu-intro-text p:last-child{margin-bottom:0;color:var(--vnfu-soft);}
.vnfu-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.vnfu-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.vnfu-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--vnfu-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.vnfu-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnfu-muted);line-height:1.4;}
.vnfu-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .vnfu-intro-grid{grid-template-columns:1fr;gap:36px;}
  .vnfu-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .vnfu-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.vnfu-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vnfu-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.vnfu-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--vnfu-surface);border:1px solid var(--vnfu-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--vnfu-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.vnfu-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--vnfu-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.vnfu-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--vnfu-border);border-radius:var(--vnfu-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.vnfu-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.vnfu-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vnfu-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .vnfu-grid-2{grid-template-columns:1fr;}
  .vnfu-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .vnfu-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .vnfu-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.vnfu-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vnfu-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.vnfu-level-card:hover{transform:translateY(-2px);}
.vnfu-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--vnfu-r) var(--vnfu-r) 0 0;
}
.vnfu-level-card.l1::before{background:var(--vnfu-green);}
.vnfu-level-card.l2::before{background:var(--vnfu-accent);}
.vnfu-level-card.l3::before{background:var(--vnfu-violet);}
.vnfu-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.vnfu-level-card.l1 .vnfu-level-badge{background:rgba(34,197,94,.15);color:var(--vnfu-green);}
.vnfu-level-card.l2 .vnfu-level-badge{background:rgba(121,242,255,.15);color:var(--vnfu-accent);}
.vnfu-level-card.l3 .vnfu-level-badge{background:rgba(139,92,246,.15);color:var(--vnfu-violet);}
.vnfu-level-card h3{font-size:17px;margin-bottom:10px;}
.vnfu-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.vnfu-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vnfu-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.vnfu-scenario:last-child{margin-bottom:0;}
.vnfu-scenario:hover{border-color:rgba(121,242,255,.3);}
.vnfu-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.vnfu-scenario h3{font-size:17px;margin-bottom:8px;}
.vnfu-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.vnfu-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vnfu-table{width:100%;border-collapse:collapse;font-size:14px;}
.vnfu-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--vnfu-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.vnfu-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--vnfu-text);vertical-align:top;
}
.vnfu-table tr:last-child td{border-bottom:none;}
.vnfu-table tr:hover td{background:rgba(255,255,255,.03);}
.vnfu-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.vnfu-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.vnfu-stack-layer:last-child{border-bottom:none;}
.vnfu-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--vnfu-accent);padding-top:2px;
}
.vnfu-stack-val{font-size:14.5px;color:var(--vnfu-text);}
.vnfu-stack-desc{font-size:13px;color:var(--vnfu-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.vnfu-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vnfu-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vnfu-case-grid{grid-template-columns:1fr;}}
.vnfu-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.vnfu-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.vnfu-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vnfu-green);margin-bottom:10px;
}
.vnfu-case-card h3{font-size:16px;margin-bottom:14px;}
.vnfu-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.vnfu-metric{display:flex;align-items:baseline;gap:8px;}
.vnfu-metric .num{font-size:22px;font-weight:900;color:var(--vnfu-accent);flex-shrink:0;letter-spacing:-.04em;}
.vnfu-metric .lbl{font-size:13px;color:var(--vnfu-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.vnfu-timeline{position:relative;padding-left:40px;}
.vnfu-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--vnfu-accent),var(--vnfu-violet));
  opacity:.35;border-radius:2px;
}
.vnfu-tl-item{position:relative;margin-bottom:32px;}
.vnfu-tl-item:last-child{margin-bottom:0;}
.vnfu-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--vnfu-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.vnfu-tl-item h3{font-size:17px;margin-bottom:8px;}
.vnfu-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.vnfu-pricing-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:960px){.vnfu-pricing-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vnfu-pricing-grid{grid-template-columns:1fr;}}
.vnfu-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.vnfu-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.vnfu-price-card.vnfu-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.vnfu-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vnfu-accent);margin-bottom:10px;
}
.vnfu-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.vnfu-price-card .inc{font-size:13px;color:var(--vnfu-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.vnfu-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vnfu-compare{width:100%;border-collapse:collapse;}
.vnfu-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--vnfu-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.vnfu-compare td{
  padding:13px 16px;font-size:14px;color:var(--vnfu-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.vnfu-compare tr:last-child td{border-bottom:none;}
.vnfu-good{color:var(--vnfu-green);}
.vnfu-neutral{color:var(--vnfu-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.vnfu-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vnfu-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.vnfu-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnfu-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.vnfu-faq-q::after{
  content:'▾';font-size:13px;color:var(--vnfu-accent);
  flex-shrink:0;transition:transform .25s;
}
.vnfu-faq-item.open .vnfu-faq-q::after{transform:rotate(180deg);}
.vnfu-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--vnfu-muted);line-height:1.72;
}
.vnfu-faq-item.open .vnfu-faq-a{max-height:600px;padding:0 24px 20px;}

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
  color:var(--vnfu-muted);font-size:15px;
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
  background:linear-gradient(135deg,var(--vnfu-btn-from),var(--vnfu-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(59,130,246,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--vnfu-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(121,242,255,.4);background:rgba(59,130,246,.12);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* =====================================================
   CTA FINAL SECTION
   ===================================================== */
.vnfu-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.vnfu-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--vnfu-muted);
}
.vnfu-cta-checklist li::before{content:'✓';color:var(--vnfu-green);font-weight:800;}

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
/* vnfu hero — самодостаточный блок (как главная meta-journal) */
.vnfu-hero-follow-up {
  --vnfu-bg: #050711;
  --vnfu-cyan: #79f2ff;
  --vnfu-violet: #8b5cf6;
  --vnfu-green: #22c55e;
  --vnfu-text: #e6edf7;
  --vnfu-muted: #9aa8bd;
  --vnfu-soft: #c7d2e5;
  --vnfu-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  --vnfu-red: #fb7185;
}
.vnfu-hero-follow-up.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: var(--vnfu-bg);
  color: var(--vnfu-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
.vnfu-hero-follow-up::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 45% 30%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: 0;
}
.vnfu-hero-follow-up::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .12), transparent 66%);
  filter: blur(6px);
  animation: vnfuHeroGlow 8s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes vnfuHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vnfu-hero-follow-up .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnfu-hero-follow-up .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnfu-hero-follow-up .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.6vw, 76px);
  line-height: .93;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnfu-hero-follow-up .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnfu-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnfu-hero-follow-up .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnfu-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnfu-hero-follow-up .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnfu-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnfu-hero-follow-up .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnfu-hero-follow-up .nero-ai-badge {
  display: inline-flex;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.vnfu-hero-follow-up .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 34px;
}
.vnfu-hero-follow-up .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 20px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  text-decoration: none !important;
  transition: transform .22s ease;
}
.vnfu-hero-follow-up .nero-ai-btn:hover { transform: translateY(-2px); }
.vnfu-hero-follow-up .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnfu-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnfu-hero-follow-up .nero-ai-btn-secondary {
  color: var(--vnfu-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnfu-hero-follow-up .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnfu-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnfu-hero-follow-up .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnfu-hero-follow-up .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnfu-hero-follow-up .nero-ai-dots { display: flex; gap: 7px; }
.vnfu-hero-follow-up .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnfu-hero-follow-up .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnfu-hero-follow-up .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnfu-hero-follow-up .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnfu-hero-follow-up .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnfu-hero-follow-up .nero-ai-window-body { padding: 16px; }
.vnfu-hero-follow-up .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 12px;
}
.vnfu-hero-follow-up .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  color: #fff;
  letter-spacing: -0.03em;
}
.vnfu-hero-follow-up .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(139,92,246,.14);
  color: #e9d5ff;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
}
.vnfu-hero-follow-up .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--vnfu-violet);
  box-shadow: 0 0 0 6px rgba(139,92,246,.18);
  animation: vnfuPulse 1.5s infinite;
}
@keyframes vnfuPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnfu-hero-follow-up .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnfu-hero-follow-up .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnfu-hero-follow-up .nero-ai-metric span {
  display: block;
  color: var(--vnfu-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnfu-hero-follow-up .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
}
.vnfu-hero-follow-up .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnfu-hero-follow-up .vnfu-kanban {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 8px;
  margin-bottom: 10px;
}
.vnfu-hero-follow-up .vnfu-kanban-col {
  padding: 8px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.03);
  min-height: 118px;
}
.vnfu-hero-follow-up .vnfu-kanban-col h4 {
  margin: 0 0 8px;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: .06em;
  text-transform: uppercase;
  color: var(--vnfu-muted);
}
.vnfu-hero-follow-up .vnfu-deal-card {
  padding: 8px;
  border-radius: 10px;
  border: 1px solid rgba(121,242,255,.22);
  background: rgba(121,242,255,.06);
  font-size: 11px;
  line-height: 1.35;
  color: #e2e8f0;
}
.vnfu-hero-follow-up .vnfu-deal-card--stuck {
  border-color: rgba(251,113,133,.45);
  background: rgba(251,113,133,.08);
  animation: vnfuStuckPulse 2.2s ease-in-out infinite;
}
@keyframes vnfuStuckPulse {
  0%, 100% { box-shadow: 0 0 0 0 rgba(251,113,133,.25); }
  50% { box-shadow: 0 0 0 6px rgba(251,113,133,0); }
}
.vnfu-hero-follow-up .vnfu-stale {
  display: inline-block;
  margin-top: 6px;
  padding: 3px 7px;
  border-radius: 999px;
  background: rgba(251,113,133,.18);
  color: #fecdd3;
  font-size: 10px;
  font-weight: 800;
}
.vnfu-hero-follow-up .vnfu-cadence {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 6px;
  margin-bottom: 10px;
  font-size: 11px;
  font-weight: 700;
  color: var(--vnfu-soft);
}
.vnfu-hero-follow-up .vnfu-cadence span {
  padding: 5px 9px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.1);
  background: rgba(255,255,255,.04);
}
.vnfu-hero-follow-up .vnfu-cadence .vnfu-step-active {
  border-color: rgba(139,92,246,.5);
  background: rgba(139,92,246,.2);
  color: #f3e8ff;
  animation: vnfuStepGlow 1.4s ease-in-out infinite;
}
@keyframes vnfuStepGlow {
  0%, 100% { opacity: .85; }
  50% { opacity: 1; box-shadow: 0 0 16px rgba(139,92,246,.35); }
}
.vnfu-hero-follow-up .vnfu-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin-bottom: 10px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 42%, rgba(121,242,255,.08), rgba(6,10,24,.92) 72%);
}
.vnfu-hero-follow-up #vnfu-follow-up-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnfu-hero-follow-up .nero-ai-task-stream { display: grid; gap: 8px; }
.vnfu-hero-follow-up .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  font-size: 12px;
}
.vnfu-hero-follow-up .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 10px;
  background: rgba(121,242,255,.12);
  color: var(--vnfu-cyan);
  font-size: 11px;
  font-weight: 800;
}
.vnfu-hero-follow-up .nero-ai-task strong { display: block; color: #f8fafc; font-size: 12px; }
.vnfu-hero-follow-up .nero-ai-task span { color: var(--vnfu-muted); font-size: 11px; }
.vnfu-hero-follow-up .nero-ai-status {
  padding: 5px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
}
@media (max-width: 1023px) {
  .vnfu-hero-follow-up .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnfu-hero-follow-up .nero-ai-dashboard { transform: none; }
}
</style>
.vnfu-callout{border-left:3px solid var(--vnfu-accent);background:rgba(121,242,255,.06);border-radius:0 14px 14px 0;padding:18px 22px;margin:0 0 28px;}
.vnfu-callout p{margin:0;color:var(--vnfu-soft);}
.vnfu-prose{max-width:920px;}
.vnfu-prose h3{font-size:clamp(18px,2.2vw,22px);margin-top:1.6em;}
.vnfu-section--boris{padding:0!important;background:transparent!important;border:none!important;}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-follow-up-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnfu-hero-follow-up" id="hero" aria-labelledby="hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · AI follow-up · CRM</p>
      <h1 id="hero-title">AI follow-up менеджер: внедрение повторных касаний по сделкам <span class="nero-ai-gradient-text">под ключ</span></h1>
      <p class="nero-ai-hero-lead">Находим зависшие сделки в CRM и запускаем персональные касания по сценарию — меньше ручных напоминаний, больше возвратов в воронку.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Зависшие сделки CRM</li>
        <li class="nero-ai-badge">Stop on reply</li>
        <li class="nero-ai-badge">amoCRM / Битрикс24</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>" <?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#chto-takoe">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо: AI follow-up и зависшие сделки">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Follow-up пульт</h3>
            <span class="nero-ai-live-pill">сценарий запущен</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Зависших</span><strong>18</strong><small>в открытой воронке</small></div>
            <div class="nero-ai-metric"><span>Без задачи</span><strong>6</strong><small>триггер SLA</small></div>
            <div class="nero-ai-metric"><span>Reactivation</span><strong>+4</strong><small>за 7 дней</small></div>
            <div class="nero-ai-metric"><span>Порог</span><strong>7 дн</strong><small>после КП</small></div>
          </div>

          <div class="vnfu-kanban" aria-hidden="true">
            <div class="vnfu-kanban-col">
              <h4>КП отправлено</h4>
              <div class="vnfu-deal-card">ООО «Север» · 420К</div>
            </div>
            <div class="vnfu-kanban-col">
              <h4>7 дней без ответа</h4>
              <div class="vnfu-deal-card vnfu-deal-card--stuck">ИП Романов · 180К<span class="vnfu-stale">12 дн. без активности</span></div>
            </div>
            <div class="vnfu-kanban-col">
              <h4>Реактивация</h4>
              <div class="vnfu-deal-card" style="border-color:rgba(34,197,94,.35);background:rgba(34,197,94,.08);">Ответ получен → в работу</div>
            </div>
          </div>

          <div class="vnfu-cadence" aria-label="Ветка сценария">
            <span>Email</span><span>→</span><span>Telegram</span><span>→</span><span>Задача РОПу</span><span class="vnfu-step-active">AI-черновик</span>
          </div>

          <div class="vnfu-dash-canvas-wrap">
            <canvas id="vnfu-follow-up-canvas" role="img" aria-label="Анимация: агенты на диспетчерской cadence запускают касания по зависшей сделке"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий follow-up">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⏱</span>
              <div><strong>Триггер: 12 дн. без активности</strong><span>Стадия «КП отправлено» · amoCRM</span></div>
              <span class="nero-ai-status">scan</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Черновик касания</strong><span>Контекст: встреча 08.10, возражение «сроки»</span></div>
              <span class="nero-ai-status">draft</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↩</span>
              <div><strong>Stop on reply</strong><span>Цепочка остановлена · задача менеджеру</span></div>
              <span class="nero-ai-status">ok</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="vnfu-content">
  <section class="vnfu-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vnfu-cnt">
      <div class="vnfu-intro-grid nero-ai-reveal">
        <div class="vnfu-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · AI follow-up</p>
          <p>Зависшие сделки в CRM — это не «ленивые менеджеры», а дырявая дисциплина следующего шага. Клиент уже получил КП или вышел со встречи — и пропал из поля зрения, пока воронка не напомнит о себе. <strong>AI follow-up</strong> закрывает разрыв: система видит сделки без активности и запускает персональные касания по правилам, а не по памяти.</p>
          <p>Nero Network внедряет слой follow-up <strong>под ключ</strong> — аудит зависших сделок, матрица триггеров, сценарии email / мессенджер / задача РОПу, human-in-the-loop и stop on reply. Первый шаг — <strong>«Разобрать зависшие сделки»</strong>: карта 20–50 «подвешенных» карточек без обязательств.</p>
        </div>
        <div class="vnfu-intro-kpi" aria-label="Метрики follow-up">
          <div class="vnfu-kpi-card"><div class="kv">87%</div><div class="kl">компаний с AI в продажах</div><div class="ks">Salesforce 2026</div></div>
          <div class="vnfu-kpi-card"><div class="kv">7 дн</div><div class="kl">типичный порог после КП</div><div class="ks">SLA воронки</div></div>
          <div class="vnfu-kpi-card"><div class="kv">+27%</div><div class="kl">конверсия после дожима</div><div class="ks">кейс Битрикс24</div></div>
          <div class="vnfu-kpi-card"><div class="kv">Stop</div><div class="kl">on reply в сценарии</div><div class="ks">обязательное правило</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vnfu-toc-outer">
    <div class="vnfu-cnt">
      <nav class="vnfu-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-zavisayut">Проблема</a>
        <a href="#chto-takoe">Как работает</a>
        <a href="#triggery">Триггеры</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#integracii">CRM</a>
        <a href="#etapy">Внедрение</a>
        <a href="#kpi">KPI</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Разбор сделок</a>
      </nav>
    </div>
  </div>
<section class="vnfu-section" id="pochemu-zavisayut">
    <div class="vnfu-cnt">
      <div class="vnfu-sh vnfu-left nero-ai-reveal">
        <span class="vnfu-eyebrow">Почему сделки «зависают» и теряются без </span>
        <h2>Почему сделки «зависают» и теряются без follow-up</h2>
      </div>
      <div class="vnfu-prose nero-ai-reveal">
      <div class="vnfu-callout nero-ai-reveal"><p><strong>Коротко:</strong> AI follow-up — слой поверх CRM: находит сделки без следующего шага и запускает персональные касания по сценарию.</p></div><h3>Цена забытых касаний для выручки</h3>
<p>Зависшие сделки в CRM — это не абстрактная «грязь в воронке», а прямая утечка выручки. Клиент уже проявил интерес: оставил заявку, получил коммерческое предложение, вышел на встречу — и замолчал. Без повторного касания конкурент или внутренняя «отложенность» забирают сделку без борьбы.</p>
<p>Тренд 2026 года подтверждает, что отделы продаж массово переходят от AI как «черновика письма» к агентным сценариям с контекстом CRM. По данным <strong>Salesforce State of Sales 2026</strong> (4 050 респондентов, опрос август–сентябрь 2025, анонс 3 февраля 2026), <strong>87% организаций уже используют AI в продажах</strong> — от проспектинга до черновиков email. <strong>54% продавцов</strong> уже работали с AI agents; почти <strong>9 из 10</strong> планируют это к 2027 году. При этом <strong>51% лидеров с AI</strong> указывают, что <strong>разрозненные системы</strong> тормозят инициативы; <strong>74%</strong> фокусируются на очистке данных в CRM — без качественной карточки сделки ни робот, ни LLM не спасут follow-up.</p>
<p>HubSpot в релизе Spring 2026 Spotlight формулирует боль иначе, но по сути о той же точке: команды теряют сделки, потому что тонут в админке продаж — в том числе в написании follow-up после звонков и встреч. Именно поэтому на рынке появляются продукты вроде Smart Deal Progression: AI анализирует транскрипт и историю сделки и предлагает черновик следующего касания — с обязательным approve менеджера.</p>
<div class="vnfu-callout nero-ai-reveal"><p><strong>Определение:</strong> <em>зависшая сделка</em> — сделка или лид в CRM, у которого нет запланированного следующего действия, превышен SLA по стадии или давность последней активности выше порога, принятого в вашей воронке (например, 7 дней после отправки КП без ответа).</p>
<h3>Типичные причины: загрузка менеджеров, нет единого cadence, размытые стадии CRM</h3>
<p>Почему менеджеры забывают повторные касания — почти всегда комбинация факторов:</p>
<ul>
<li><strong>Перегрузка входящим.</strong> Новые лиды вытесняют «старых думающих» с экрана; в карточке нет задачи — сделка визуально «спит».</li>
<li><strong>Нет единого cadence касаний.</strong> Один менеджер пишет три раза, другой — один и сдаётся; РОП не видит стандарта.</li>
<li><strong>Размытые стадии.</strong> «Переговоры» без обязательного поля «следующий шаг» и даты — идеальная почва для зависания.</li>
<li><strong>Нет эскалации.</strong> Просроченный follow-up не поднимается руководителю автоматически.</li>
</ul>
<p>Практика amoCRM без LLM уже показывает эффект от дисциплины задач: как отмечает Никита Бердников, <strong>сделка без запланированной задачи стоит на месте</strong> — автосценарии «нет задачи → автозадача» и контроль 30+ дней без активности возвращают зависшие сделки в работу.</p>
<p>Кейс оптовой компании из Екатеринбурга (интегратор ITPanda, Битрикс24): до автоматизации <strong>35% сделок обрывались после КП</strong> из‑за низкой дисциплины follow-up. После внедрения бизнес-процесса дожима — автозадачи на стадиях, напоминания к дедлайну, эскалация руководителю — команда получила измеримый рост конверсии (в материале кейса указано <strong>+27%</strong>). Это классическая CRM-автоматизация; AI follow-up добавляет поверх неё персонализацию текстов и контекст из переписки, а не заменяет правила.</p>
<p><strong>Итог блока:</strong> как не терять сделки в CRM — зафиксировать SLA по стадиям, обязать «следующий шаг», внедрить триггеры зависшей сделки и только затем подключать AI для текстов и маршрутизации каналов.</p>
      </div>
      
    </div>
  </section>
<section class="vnfu-section vnfu-section-alt" id="chto-takoe">
    <div class="vnfu-cnt">
      <div class="vnfu-sh vnfu-left nero-ai-reveal">
        <span class="vnfu-eyebrow">Что такое AI follow-up менеджер</span>
        <h2>Что такое AI follow-up менеджер</h2>
      </div>
      <div class="vnfu-prose nero-ai-reveal">
      <h3>Отличие от напоминаний в календаре и от «робота в CRM»</h3>
<div class="vnfu-table-wrap"><table class="vnfu-table"><thead><tr>
<th>Подход</th>
<th>Что делает</th>
<th>Ограничение</th>
</tr></thead><tbody>
<tr>
<td>Напоминание в календаре</td>
<td>Пингует менеджера</td>
<td>Не знает контекст сделки, не пишет клиенту</td>
</tr>
<tr>
<td>Робот CRM (шаблон)</td>
<td>Шлёт одно и то же письмо на стадии</td>
<td>Клиент видит шаблон; нет ветвления по ответу</td>
</tr>
<tr>
<td>Email-рассылка</td>
<td>Массовый поток</td>
<td>Не привязана к стадии конкретной сделки</td>
</tr>
<tr>
<td><strong>AI follow-up менеджер</strong></td>
<td>Мониторит CRM + генерирует касание из контекста</td>
<td>Требует настройки триггеров, ПДн и human-in-the-loop</td>
</tr>
</tbody></table></div>
<p><strong>AI follow up</strong> в коммерческом смысле — связка правил в CRM, оркестратора (Make, n8n или аналог), языковой модели и каналов коммуникации. Система отслеживает сделки без следующего шага, с просроченной активностью или «зависанием» на стадии вроде «КП отправлено — ждём ответа», подтягивает поля карточки и последние активности, формирует <strong>контекстное</strong> касание или черновик для менеджера, останавливает цепочку при ответе клиента и пишет результат обратно в CRM.</p>
<p>Это принципиально не то же самое, что <strong>полный AI-агент для amoCRM</strong> или «бот на всю воронку» (отдельная услуга Nero Network): здесь фокус на <strong>реактивации и дожиме</strong> уже существующих сделок, а не на квалификации с нуля или замене отдела продаж одним диалоговым агентом. Продукты вроде RepplyAI закрывают путь «от первого сообщения до сделки»; наш угол — этап после контакта, КП и встречи, когда сделка уже в CRM и молчит.</p>
<h3>Что делает AI-слой: мониторинг сделок + персонализация касания</h3>
<p>Типовой набор функций follow up менеджер ai:</p>
<ul>
<li><strong>Детектор зависших сделок</strong> — дни без активности, нет открытой задачи, истёк SLA стадии.</li>
<li><strong>Сбор контекста</strong> — стадия, сумма, последний звонок/письмо, заметки с возражениями, при наличии — транскрипт из телефонии.</li>
<li><strong>Генерация касания</strong> — тема и текст email, сообщение в мессенджер, формулировка задачи «позвонить с таким аргументом».</li>
<li><strong>Маршрутизация</strong> — автоотправка для низкого чека / только черновик + approve для крупных сделок.</li>
<li><strong>Stop on reply</strong> — входящий ответ классифицируется (интерес, отказ, автоответ «в отпуске»), цепочка останавливается, ответственный получает уведомление.</li>
</ul>
<p>Международные референсы задают планку ожиданий: Outsales читает переписку и планирует follow-up из inbox с остановкой при реальном ответе; Scurry строит цепочку из 3–15 писем после встречи с отсылками к транскрипту. Salesforce Agentforce описывает <strong>nudge</strong> при отсутствии ответа на предыдущие письма в nurture-сценариях. Для российского B2B тот же паттерн собирается на amoCRM / Битрикс24 + мессенджеры + YandexGPT / GigaChat при работе с персональными данными.</p>
<p><strong>Коротко:</strong> ai follow up для бизнеса — это не магия «нейросеть сама продаёт», а инженерия процесса: триггеры, сценарии, каналы, лог в CRM и человек на сложных ветках.</p>
      </div>
      
    </div>
  </section>
<section id="vnfu-boris-cadence-block" class="bfu-root vnfu-section vnfu-section--boris" aria-label="Анимация: оркестратор cadence AI follow-up — триггер, касания и stop on reply">
<style>
/* === БОРИС vnfu: prefix bfu-, scope #vnfu-boris-cadence-block === */
#vnfu-boris-cadence-block.bfu-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnfu-boris-cadence-block .bfu-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnfu-boris-cadence-block .bfu-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.2);
  min-height:500px;
}
@media(max-width:1023px){
  #vnfu-boris-cadence-block .bfu-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnfu-boris-cadence-block .bfu-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnfu-boris-cadence-block .bfu-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnfu-boris-cadence-block .bfu-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#7c3aed;
  margin:0 0 14px;
}
#vnfu-boris-cadence-block .bfu-ey::before{
  content:'';
  width:18px;height:2px;
  background:linear-gradient(90deg,#79f2ff,#8b5cf6);
  border-radius:1px;
}
#vnfu-boris-cadence-block .bfu-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnfu-boris-cadence-block .bfu-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnfu-boris-cadence-block .bfu-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnfu-boris-cadence-block .bfu-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(124,58,237,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#6d28d9;
  margin-top:1px;
  font-style:normal;
}
#vnfu-boris-cadence-block .bfu-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnfu-boris-cadence-block .bfu-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnfu-boris-cadence-block .bfu-pl-c{
  background:rgba(121,242,255,.12);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.35);
}
#vnfu-boris-cadence-block .bfu-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#vnfu-boris-cadence-block .bfu-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnfu-boris-cadence-block .bfu-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnfu-boris-cadence-block .bfu-rgt{
  position:relative;
  background:linear-gradient(145deg,#f0f9ff 0%,#ede9fe 42%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnfu-boris-cadence-block .bfu-rgt{min-height:360px;}
}
#vnfu-cadence-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bfu-cnt">
  <div class="bfu-card">

    <div class="bfu-lft">
      <span class="bfu-ey">Cadence · не hero</span>
      <h3 class="bfu-h3">Оркестратор повторных касаний: от триггера в CRM до stop on reply</h3>
      <ul class="bfu-ul">
        <li><span class="bfu-ic">⏱</span>Триггер: нет задачи или N дней без активности на стадии «КП отправлено»</li>
        <li><span class="bfu-ic">✦</span>LLM собирает черновик из карточки — сумма, возражение, последний контакт</li>
        <li><span class="bfu-ic">↗</span>Цепочка: email → мессенджер → задача РОПу с эскалацией по SLA</li>
        <li><span class="bfu-ic">⊘</span>Ответ клиента останавливает сценарий и пишет активность в CRM</li>
      </ul>
      <div class="bfu-pills">
        <span class="bfu-pl bfu-pl-c">Human gate</span>
        <span class="bfu-pl bfu-pl-v">Approve в Telegram</span>
        <span class="bfu-pl bfu-pl-g">Stop on reply</span>
      </div>
      <p class="bfu-foot">Дальше — триггеры и пороги под вашу воронку →</p>
    </div>

    <div class="bfu-rgt">
      <canvas
        id="vnfu-cadence-canvas"
        role="img"
        aria-label="Анимация: сделка с таймером дней без активности проходит по цепочке касаний AI follow-up и останавливается при ответе клиента"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('vnfu-cadence-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 440;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a',
    muted:'#64748b',
    cyan:'#06b6d4',
    cyanL:'rgba(6,182,212,.15)',
    viol:'#8b5cf6',
    violL:'rgba(139,92,246,.2)',
    green:'#22c55e',
    red:'#ef4444',
    card:'#ffffff',
    cardBdr:'#e2e8f0',
    line:'rgba(99,102,241,.35)',
    glow:'rgba(121,242,255,.45)'
  };

  var NODES = [];
  function layoutNodes(){
    var pad = Math.min(W * 0.06, 36);
    var yMid = H * 0.52;
    var x0 = pad + 40;
    var x1 = W * 0.32;
    var x2 = W * 0.52;
    var x3 = W * 0.72;
    var x4 = W - pad - 50;
    NODES = [
      {id:'crm',  x:x0,  y:yMid - 30, label:'CRM', sub:'триггер', icon:'⚡', color:C.cyan},
      {id:'llm',  x:x1,  y:yMid - 55, label:'AI', sub:'черновик', icon:'✦', color:C.viol},
      {id:'mail', x:x2,  y:yMid,      label:'Email', sub:'касание 1', icon:'✉', color:C.cyan},
      {id:'tg',   x:x3,  y:yMid,      label:'Telegram', sub:'касание 2', icon:'◉', color:C.viol},
      {id:'task', x:x4,  y:yMid + 8,  label:'Задача', sub:'РОПу', icon:'☑', color:C.green}
    ];
  }

  var traveler = { t: 0, phase: 0, stopFlash: 0 };
  var dealDays = 7;

  function rr(ctx,x,y,w,h,r,fill,stroke,wid){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle = fill; ctx.fill(); }
    if (stroke){
      ctx.strokeStyle = stroke;
      ctx.lineWidth = wid || 1.5;
      ctx.stroke();
    }
  }

  function drawDealCard(){
    var cx = W * 0.14;
    var cy = H * 0.22;
    var w = Math.min(150, W * 0.28);
    var h = 72;
    rr(ctx, cx - w/2, cy, w, h, 10, C.card, C.cardBdr);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.fillText('ООО «Север» · КП', cx - w/2 + 10, cy + 22);
    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.fillText('стадия: ждём ответ', cx - w/2 + 10, cy + 38);
    dealDays = 7 + Math.floor((frame / 90) % 6);
    ctx.fillStyle = C.red;
    ctx.font = 'bold 12px system-ui,sans-serif';
    ctx.fillText(dealDays + ' дн. без активности', cx - w/2 + 10, cy + 56);
    var pulse = 0.5 + 0.5 * Math.sin(frame * 0.08);
    ctx.strokeStyle = 'rgba(239,68,68,' + (0.25 + pulse * 0.35) + ')';
    ctx.lineWidth = 2;
    rr(ctx, cx - w/2 - 2, cy - 2, w + 4, h + 4, 12, null, ctx.strokeStyle, 2);
  }

  function drawNode(n, active){
    var r = active ? 28 : 24;
    ctx.save();
    if (active){
      ctx.shadowColor = n.color;
      ctx.shadowBlur = 18;
    }
    rr(ctx, n.x - r, n.y - r, r*2, r*2, r, n.color, null);
    ctx.shadowBlur = 0;
    ctx.fillStyle = '#fff';
    ctx.font = 'bold 14px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(n.icon, n.x, n.y);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.fillText(n.label, n.x, n.y + r + 14);
    ctx.fillStyle = C.muted;
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText(n.sub, n.x, n.y + r + 26);
    ctx.restore();
  }

  function drawEdges(progress){
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 2;
    ctx.setLineDash([6, 4]);
    for (var i = 0; i < NODES.length - 1; i++){
      var a = NODES[i], b = NODES[i+1];
      ctx.beginPath();
      ctx.moveTo(a.x + 26, a.y);
      ctx.lineTo(b.x - 26, b.y);
      ctx.stroke();
    }
    ctx.setLineDash([]);
    if (NODES.length < 2) return;
    var seg = Math.min(4, Math.floor(progress * 4));
    var local = (progress * 4) % 1;
    var from = NODES[Math.min(seg, NODES.length - 2)];
    var to = NODES[Math.min(seg + 1, NODES.length - 1)];
    var px = from.x + (to.x - from.x) * local;
    var py = from.y + (to.y - from.y) * local;
    var grd = ctx.createRadialGradient(px, py, 0, px, py, 14);
    grd.addColorStop(0, C.glow);
    grd.addColorStop(1, 'rgba(121,242,255,0)');
    ctx.fillStyle = grd;
    ctx.beginPath();
    ctx.arc(px, py, 14, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = C.viol;
    ctx.beginPath();
    ctx.arc(px, py, 5, 0, Math.PI * 2);
    ctx.fill();
  }

  function drawStopBanner(){
    if (traveler.stopFlash <= 0) return;
    var alpha = Math.min(1, traveler.stopFlash / 40);
    var bx = W * 0.5 - 110;
    var by = H * 0.82;
    rr(ctx, bx, by, 220, 36, 18, 'rgba(34,197,94,' + (0.12 * alpha) + ')', 'rgba(34,197,94,' + (0.5 * alpha) + ')');
    ctx.fillStyle = 'rgba(21,128,61,' + alpha + ')';
    ctx.font = 'bold 12px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('Stop on reply · цепочка остановлена', W * 0.5, by + 22);
    traveler.stopFlash--;
  }

  function drawHeader(){
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 13px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Cadence follow-up', 20, 28);
    ctx.fillStyle = C.muted;
    ctx.font = '11px system-ui,sans-serif';
    ctx.fillText('демо-сценарий · не продакшен CRM', 20, 44);
    var live = 0.6 + 0.4 * Math.sin(frame * 0.1);
    rr(ctx, W - 118, 16, 98, 26, 13, 'rgba(34,197,94,' + (0.08 + live * 0.06) + ')', 'rgba(34,197,94,.35)');
    ctx.fillStyle = '#15803d';
    ctx.font = 'bold 10px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('сценарий активен', W - 69, 32);
  }

  function loop(){
    frame++;
    ctx.clearRect(0, 0, W, H);
    layoutNodes();
    drawHeader();
    drawDealCard();

    traveler.t += 0.0042;
    if (traveler.t >= 1){
      traveler.t = 0;
      traveler.stopFlash = 55;
    }
    var prog = traveler.t;
    drawEdges(prog);

    var activeIdx = Math.min(4, Math.floor(prog * 5));
    for (var i = 0; i < NODES.length; i++){
      drawNode(NODES[i], i === activeIdx);
    }
    drawStopBanner();

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>
<div class="vnfu-cnt"><aside class="ym-cta-block ym-cta-block--primary" id="cta-posle-chto-takoe">
  <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Разобрать зависшие сделки в вашей CRM</p>
    <p class="ym-cta-block__sub">Выгрузим 20–50 «подвешенных» сделок, покажем триггеры (нет задачи, N дней без ответа, стадия КП) и приоритет сценариев follow-up — без обязательств.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside></div>
<section class="vnfu-section" id="triggery">
    <div class="vnfu-cnt">
      <div class="vnfu-sh vnfu-left nero-ai-reveal">
        <span class="vnfu-eyebrow">Признаки зависшей сделки</span>
        <h2>Признаки зависшей сделки: триггеры и правила</h2>
      </div>
      <div class="vnfu-prose nero-ai-reveal">
      <h3>Дни без активности, стадия, открытое КП, нет ответа на письмо</h3>
<p>Триггеры зависшей сделки, которые чаще всего закладывают в follow up автоматизацию crm:</p>
<ul>
<li><strong>Нет запланированной задачи</strong> на сделке или контакте — жёсткое правило из практики amoCRM.</li>
<li><strong>N дней без активности</strong> — типичные пороги: 48 часов после первичного контакта без ответа; 7 дней на стадии «КП отправлено»; 30 дней в «думает» без касания.</li>
<li><strong>Стадия + событие</strong> — «встреча проведена», но в карточке нет следующей встречи и нет исходящего письма в течение SLA.</li>
<li><strong>Открытое исходящее без открытия/ответа</strong> — письмо ушло, трекинг или интеграция почты показывает тишину X дней.</li>
<li><strong>Сегмент реанимации</strong> — сделки, закрытые в успех более 90 дней назад, без повторной покупки (модель кейса Sensei / «ИванычЪ GROUP»: 71 000 «спящих» контактов, воронка «Реанимация»).</li>
</ul>
<p>Для каждого триггера в проекте Nero Network фиксируют <strong>красные линии</strong>: юрлицо с крупным чеком, негатив в последней переписке, VIP-метка — только задача менеджеру и черновик в комментарии, без автосообщения клиенту.</p>
<h3>Настраиваемые пороги под вашу воронку</h3>
<p>Универсального «7 касаний для всех» не существует. Опрос RAIN Group (489 outbound-продавцов, <strong>2020</strong>) показывал в среднем <strong>около 8 касаний</strong> до первой встречи у топовых команд против ~5 у среднего уровня — цифра привязана к outbound и году опроса, её нельзя копировать в KPI без пересчёта. Агрегаторы вроде ZoomInfo часто цитируют правило «80% продаж требуют ≥5 follow-up» — перед публичной цитатой стоит сверять первоисточник. Практичный путь для B2B: посчитать <strong>медиану касаний</strong> по 50–100 закрытым сделкам в своей CRM (методология описана, в частности, на leadgenbot.ru).</p>
<p><strong><strong>Чек-лист аудита (фрагмент):</strong></strong></p>
<p>- Есть ли у каждой открытой сделки задача с датой?</p>
<p>- Совпадает ли SLA в регламенте с полями CRM?</p>
<p>- Сколько сделок на стадии «КП» дольше 7 дней?</p>
<p>- Есть ли согласия на email и мессенджеры у контактов в базе?</p>
      </div>
      
    </div>
  </section>
<section class="vnfu-section" id="scenarii">
    <div class="vnfu-cnt">
      <div class="vnfu-sh vnfu-left nero-ai-reveal">
        <span class="vnfu-eyebrow">Сценарии повторных касаний</span>
        <h2>Сценарии повторных касаний</h2>
      </div>
      <div class="vnfu-prose nero-ai-reveal">
      <h3>Email и цепочки писем</h3>
<p>Автоматизация повторных касаний чаще начинается с email: низкий порог входа, полный лог в CRM, проще согласования по 152-ФЗ при корпоративной почте. AI-слой не заменяет ESP, а генерирует <strong>вариативные</strong> тексты: отсылка к последнему разговору, конкретное КП, снятие одного возражения из заметок менеджера.</p>
<p>Сценарий «после встречи» (аналог Scurry / HubSpot): транскрипт или краткое резюме → цепочка из нескольких писем с разными углами → pre-send проверка карточки → очередь approve → отправка из ящика менеджера или общего sales@ с подписью ответственного.</p>
<p>Риски: репутация домена при массовых однотипных письмах; галлюцинации LLM в цифрах и сроках. Поэтому в промпт передают только проверенные поля, а факты из КП подтягивают через RAG по утверждённым документам.</p>
<h3>WhatsApp / Telegram (с оговорками по 152-ФЗ и согласиям)</h3>
<p>Повторные касания по сделкам в мессенджерах дают высокий open rate, но жёстче регуляторика и правила платформ. Для РФ типичен стек: WhatsApp Business API / Telegram через провайдеров (Wazzup, TextBack и аналоги), запись переписки в amoCRM или Битрикс24.</p>
<p>Кейс реанимации Sensei: цепочка <strong>WhatsApp → через 30 дней email → задача «позвонить»</strong>; ответ переводит сделку в основную воронку к <strong>тому же менеджеру</strong> — важное правило, чтобы клиент не попал в «чужой» диалог. За два месяца в публичном кейсе указан результат <strong>631 842 ₽</strong> выручки с сегмента «спящих» контактов.</p>
<p>AI здесь уместен для вариаций оффера и тона, но автосообщение без согласия на рассылку в мессенджер — зона юриста и политики ПДн, не только маркетинга.</p>
<h3>Задача менеджеру vs полуавтоматическое касание</h3>
<p>Два режима, которые Nero Network явно разводит в ТЗ:</p>
<div class="vnfu-table-wrap"><table class="vnfu-table"><thead><tr>
<th>Режим</th>
<th>Когда</th>
<th>Плюс</th>
<th>Минус</th>
</tr></thead><tbody>
<tr>
<td>Задача + AI-черновик</td>
<td>Крупный чек, сложные переговоры</td>
<td>Контроль, доверие</td>
<td>Скорость зависит от людей</td>
</tr>
<tr>
<td>Полуавто / авто в канале</td>
<td>Низкий чек, типовой дожим</td>
<td>Скорость, масштаб</td>
<td>Риск шаблонности без контекста</td>
</tr>
</tbody></table></div>
<p>Эскалация из кейса ITPanda: нерешённая задача по дедлайну уходит руководителю — тот же принцип применим к AI-сценарию: третье касание без ответа → задача РОПу «подключиться лично».</p>
<h3>Сколько касаний нужно лиду — методология cadence</h3>
<p><strong>FAQ-врезка.</strong> Жёстко фиксировать «ровно 8 писем» нельзя: длина B2B-пути в одном из исследований (HockeyStack Labs 2024, цитируется в отраслевых обзорах 2026) доходила в среднем до <strong>сотен взаимодействий</strong> в выборке — это не противоречит «8 касаниям до встречи», а показывает, что <strong>считать нужно свою медиану</strong>: касания до первой встречи, до КП, после КП до оплаты.</p>
<p>Рекомендуемый cadence в проекте:</p>
<ul>
<li>Посчитать медиану успешных сделок за 6–12 месяцев.</li>
<li>Задать максимум попыток по каналу (например, 3 email + 2 мессенджер + 2 звонка).</li>
<li>После исчерпания cadence — перевод в «парковку» или реанимацию через 90 дней, а не бесконечный спам.</li>
</ul>
      </div>
      
    </div>
  </section>
<section class="vnfu-section vnfu-section-alt" id="integracii">
    <div class="vnfu-cnt">
      <div class="vnfu-sh vnfu-left nero-ai-reveal">
        <span class="vnfu-eyebrow">Интеграции с CRM</span>
        <h2>Интеграции с CRM</h2>
      </div>
      <div class="vnfu-prose nero-ai-reveal">
      <h3>amoCRM, Битрикс24, HubSpot, Salesforce — что подключаем в кейсах Nero Network</h3>
<p><strong>amoCRM:</strong> Digital Pipeline, Salesbot, виджеты телефонии и почты; внешний AI-слой через webhooks в n8n/Make. Кейс ресторана «Дом Манула» (Emfy): схема касаний, автоматические ответы при отсутствии реакции — база, на которую ложится LLM-персонализация.</p>
<p><strong>Битрикс24:</strong> роботы и бизнес-процессы, CRM-формы, задачи и эскалация — как в кейсах ITPanda и MEGACAR (+48% повторных заказов, −53% время обработки заявок в публикации интегратора).</p>
<p><strong>HubSpot / Salesforce:</strong> для клиентов с глобальной CRM — ориентир на нативные AI-функции (Deal Progression, Agentforce) или гибрид: данные в Salesforce, оркестрация касаний на стороне интегратора с соблюдением политики данных.</p>
<p>Стек автоматизации: CRM → webhooks → оркестратор → RAG (КП, FAQ, скрипты) → YandexGPT / GigaChat / OpenAI по политике ПДн → канал отправки → запись активности в CRM.</p>
<h3>Отличие от страницы «AI-агент для amoCRM»</h3>
<div class="vnfu-table-wrap"><table class="vnfu-table"><thead><tr>
<th>Критерий</th>
<th>AI-агент amoCRM (полная воронка)</th>
<th>AI follow-up (эта страница)</th>
</tr></thead><tbody>
<tr>
<td>Охват</td>
<td>Лид с сайта → квалификация → сделка</td>
<td>Сделка уже в CRM «зависла»</td>
</tr>
<tr>
<td>Каналы</td>
<td>Часто чат, формы, первичный контакт</td>
<td>Email, мессенджер, задачи, звонок</td>
</tr>
<tr>
<td>Цель</td>
<td>Заменить/усилить первую линию</td>
<td>Реактивация, дожим, реанимация базы</td>
</tr>
<tr>
<td>Метрика</td>
<td>Скорость ответа на лид</td>
<td>% сделок с следующим шагом, reactivation rate</td>
</tr>
</tbody></table></div>
<p>Смежные материалы сети: на посадочной про <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--vnfu-accent);text-decoration:underline;text-underline-offset:3px">AI-обработку входящей почты в CRM</a> разобран входящий поток и triage писем; на этой странице — исходящие повторные касания по правилам стадии.</p>
<p>Если нужна автоматизация всей воронки в amoCRM (лид → квалификация → сделка), а не только reactivation, сравните с <a href="/vnedrenie-ai-amocrm/" style="color:var(--vnfu-accent);text-decoration:underline;text-underline-offset:3px">внедрением AI-агента в amoCRM под ключ</a> — таблица выше фиксирует отличия от follow-up.</p>
      </div>
      
    </div>
  </section>
<section class="vnfu-section" id="etapy">
    <div class="vnfu-cnt">
      <div class="vnfu-sh vnfu-left nero-ai-reveal">
        <span class="vnfu-eyebrow">Как мы внедряем AI follow-up под ключ</span>
        <h2>Как мы внедряем AI follow-up под ключ</h2>
      </div>
      <div class="vnfu-prose nero-ai-reveal">
      <h3>Аудит воронки и карта зависших сделок</h3>
<p>Внедрение ai follow up в Nero Network начинается с <strong>аудита CRM (ориентир 3–5 рабочих дней)</strong>:</p>
<p>- выгрузка сделок без задач и без активности 7–30 дней;</p>
<p>- топ стадий, где сделки «умирают»;</p>
<p>- медиана касаний по выборке закрытых сделок;</p>
<p>- проверка полей, без которых LLM не должен генерировать текст (сумма, продукт, последнее возражение).</p>
<p>Лид-магнит коммерческой страницы — <strong>разбор 20–50 зависших сделок</strong> из вашей CRM или чек-лист триггеров под ваш регламент (CTA: «Разобрать зависшие сделки»).</p>
<h3>Проектирование сценариев и контента касаний</h3>
<p>На основе аудита собирают матрицу <strong>«стадия × дни без активности × канал»</strong>. Для каждого шага — шаблон смысла (не обязательно фиксированный текст), источники RAG, условия ветвления, правила stop on reply.</p>
<p>Нужны от заказчика: 10–20 образцов удачных follow-up, скрипты возражений, FAQ, политика ПДн и согласия на рассылки.</p>
<h3>Запуск, обучение отдела, доработка по метрикам</h3>
<p><strong>Пилот 2–4 недели</strong> на одной воронке или сегменте (например, только B2B с чеком до N ₽). Дашборд пилота:</p>
<p>- доля сделок с запланированным следующим шагом;</p>
<p>- reactivation rate (вернулись в активную стадию);</p>
<p>- остановки цепочки по ответу клиента;</p>
<p>- доля касаний, ушедших через approve.</p>
<p>После приёмки пилота — второй сценарий (реанимация 90+ дней), подключение телефонии (Mango, UIS, Sipuni) с транскриптом в карточку. Когда сделка после дожима уходит в учётный контур, смежный кейс — <a href="/ai-1c-erp/" style="color:var(--vnfu-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP</a> (заказы и лимиты без двойного ввода).</p>
<p>Рыночные ориентиры стоимости у интеграторов на AI в продажах в РФ в открытых источниках — от порядка <strong>69–279 тыс. ₽</strong> до <strong>250 тыс. ₽+</strong> за пилот; итоговая смета Nero Network зависит от числа воронок, каналов и требований к ПДн — без обещания фиксированной цены в тексте без калькуляции.</p>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать процесс до пилота?</p>
    <p class="ym-cta-block__sub">Если РОПу и CRM-админу важно разобрать n8n, промпты и human-in-the-loop до старта follow-up — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo $secondary_cta_attrs; ?>><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование сценариев на этапе аудита.</p>
  </div>
</aside>
    </div>
  </section>
<section class="vnfu-section" id="kpi">
    <div class="vnfu-cnt">
      <div class="vnfu-sh vnfu-left nero-ai-reveal">
        <span class="vnfu-eyebrow">KPI и ROI</span>
        <h2>KPI и ROI: что измерять после запуска</h2>
      </div>
      <div class="vnfu-prose nero-ai-reveal">
      <h3>Доля сделок, возвращённых в активную стадию</h3>
<p>Главная метрика реактивации зависших лидов — не «сколько писем отправил AI», а <strong>сколько сделок снова сдвинулось по воронке</strong> в течение 14–30 дней после входа в сценарий. Вспомогательные показатели:</p>
<p>- время от «КП отправлено» до следующей активности (медиана);</p>
<p>- конверсия из «зависшей» стадии в оплату или в отказ (честный отказ лучше вечного «думает»).</p>
<p>Количественные кейсы для ориентира (не гарантия для всех): +27% конверсии после дожима в Битрикс24 (ITPanda); 631 842 ₽ за 2 месяца реанимации (Sensei); +48% повторных заказов (MEGACAR).</p>
<h3>Сокращение «мёртвого» времени на стадии</h3>
<p>РОП получает прозрачность: отчёт «зависшие сделки» срабатывания сценариев, а не сюрприз на планёрке. Salesforce в State of Sales 2026 указывает на ожидаемое сокращение времени на черновики email на <strong>36%</strong> и на research на <strong>34%</strong> после полного внедрения агентов — как рыночный вектор, не как обещание каждого пилота.</p>
<p>KPI для менеджеров настраивают на <strong>дисциплину следующего шага</strong>, а не на количество автописем — иначе саботаж и формальные клики.</p>
      </div>
      
    </div>
  </section>
<section class="vnfu-section vnfu-section-alt" id="riski">
    <div class="vnfu-cnt">
      <div class="vnfu-sh vnfu-left nero-ai-reveal">
        <span class="vnfu-eyebrow">Риски и ошибки внедрения</span>
        <h2>Риски и ошибки внедрения</h2>
      </div>
      <div class="vnfu-prose nero-ai-reveal">
      <h3>Спам и шаблонность</h3>
<p>Если LLM не получает контекст или RAG пустой, клиент видит generic follow-up — хуже, чем молчание. Решение: human gate на первых неделях, A/B формулировок, запрет автосообщений при пустых полях.</p>
<p>Окна отправки (send windows) и лимиты частоты — как у международных AI follow-up SaaS: не писать ночью, не дублировать канал, если вчера уже был звонок.</p>
<h3>Конфликт с ручной работой менеджера</h3>
<p>Опасение «менеджеров заменят» закрывают процессом: AI снимает забытые касания и рутину черновиков; переговоры по цене, нестандартные условия и юридические вопросы остаются за человеком. Approve исходящих для крупных сделок и «токсичных» диалогов — обязательный элемент архитектуры.</p>
<p>Технические риски: галлюцинации в суммах и сроках; утечка лишних ПДн в промпт; необходимость <strong>stop on reply</strong> и классификации OOO/bounce.</p>
<p><strong>Итог блока:</strong> внедрение ai в отдел продаж в узком смысле follow-up — это управляемый эксперимент с пилотом, а не «включили бота на всю базу».</p>
      </div>
      
    </div>
  </section>
<section class="vnfu-section" id="faq">
    <div class="vnfu-cnt">
      <div class="vnfu-sh vnfu-left nero-ai-reveal">
        <span class="vnfu-eyebrow">FAQ</span>
        <h2>FAQ</h2>
      </div>
      <div class="vnfu-prose nero-ai-reveal">
      
      </div>
      <div class="vnfu-faq nero-ai-reveal"><div class="vnfu-faq-item" id="faq-0">
      <div class="vnfu-faq-q" tabindex="0" role="button" aria-expanded="false">Чем AI follow-up отличается от email-рассылки?</div>
      <div class="vnfu-faq-a"><p>Рассылка идёт по списку и не смотрит на стадию сделки в CRM. AI follow-up срабатывает по триггерам карточки (нет задачи, N дней без ответа, стадия «КП»), подставляет контекст и останавливается при ответе клиента.</p></div>
    </div><div class="vnfu-faq-item" id="faq-1">
      <div class="vnfu-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли уже настроенный CRM?</div>
      <div class="vnfu-faq-a"><p>Да. Услуга рассчитана на компании, где воронка уже есть; мы не продаём CRM с нуля, а накладываем ai слой в crm. Минимум — стадии, ответственные, поля для генерации текста.</p></div>
    </div><div class="vnfu-faq-item" id="faq-2">
      <div class="vnfu-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI менеджеров?</div>
      <div class="vnfu-faq-a"><p>Нет. Заменяет пропущенные касания и ускоряет черновики; закрытие и переговоры — у команды. 94% лидеров с агентами в отчёте Salesforce называют их критичными для роста — как усиление, не как вывод штата.</p></div>
    </div><div class="vnfu-faq-item" id="faq-3">
      <div class="vnfu-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько длится внедрение?</div>
      <div class="vnfu-faq-a"><p>Аудит — несколько дней; пилот одного сценария — ориентир 2–4 недели; масштабирование зависит от числа воронок и каналов. Жёсткие сроки фиксируют в договоре после аудита.</p></div>
    </div><div class="vnfu-faq-item" id="faq-4">
      <div class="vnfu-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько касаний нужно лиду?</div>
      <div class="vnfu-faq-a"><p>Считайте медиану по своим закрытым сделкам; ориентиры из чужих опросов (5–8 до встречи) — только как фон, не как KPI.</p></div>
    </div><div class="vnfu-faq-item" id="faq-5">
      <div class="vnfu-faq-q" tabindex="0" role="button" aria-expanded="false">Опасно ли для персональных данных?</div>
      <div class="vnfu-faq-a"><p>При работе с ПДн граждан РФ — российские модели (YandexGPT, GigaChat), минимизация полей в промпте, договор обработки, согласия на каналы. Автосообщения в мессенджер — только при наличии правового основания.</p></div>
    </div><div class="vnfu-faq-item" id="faq-6">
      <div class="vnfu-faq-q" tabindex="0" role="button" aria-expanded="false">У нас уже есть роботы в CRM — зачем AI?</div>
      <div class="vnfu-faq-a"><p>Роботы шлют шаблон. AI добавляет вариативность и контекст из карточки при сохранении ваших правил и красных линий.</p></div>
    </div><div class="vnfu-faq-item" id="faq-7">
      <div class="vnfu-faq-q" tabindex="0" role="button" aria-expanded="false">Чем это отличается от AI-агента для amoCRM?</div>
      <div class="vnfu-faq-a"><p>Агент закрывает широкий путь от лида до сделки; follow-up менеджер — узкий фокус на зависших сделках и реактивации базы.</p></div>
    </div></div>
    </div>
  </section>
<section class="vnfu-section" id="cta">
    <div class="vnfu-cnt">
      <div class="vnfu-sh vnfu-left nero-ai-reveal">
        <span class="vnfu-eyebrow">Разобрать зависшие сделки</span>
        <h2>Разобрать зависшие сделки</h2>
      </div>
      <div class="vnfu-prose nero-ai-reveal">
      <p>Если в CRM накопились сделки без следующего шага, КП без ответа и лиды, о которых вспоминают только на отчёте — <strong>ai follow up для бизнеса</strong> имеет смысл начинать с диагностики, а не с покупки «ещё одного SaaS».</p>
<p>Nero Network предлагает <strong>разбор зависших сделок</strong>: выгрузка и карта триггеров, приоритет сценариев (после КП, после встречи, реанимация 90+ дней), рекомендация по режиму «задача + черновик» vs автокасание в мессенджер с учётом 152-ФЗ.</p>
<p><strong>Следующий шаг:</strong> оставьте заявку с указанием CRM (amoCRM, Битрикс24, другое) и примерного объёма открытых сделок в «подвешенных» стадиях — подготовим план внедрения ai follow up под ключ без смешения с полным агентом воронки.</p>
<p><em>Источники и кейсы, использованные в материале: Salesforce State of Sales 2026; HubSpot Spring 2026 Spotlight; кейсы ITPanda (Workspace.ru), Sensei (ivanych-case), MEGACAR (dm-marketing.pro), «Дом Манула» (Emfy); практика amoCRM (nikitaberdnikov.ru); международные референсы Outsales, Scurry, Salesforce Agentforce.</em></p>
      </div>
      <div class="ym-cta-block ym-cta-block--dual" id="cta-razbor-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">План внедрения AI follow-up под вашу воронку</p>
    <p class="ym-cta-block__sub">Укажите CRM (amoCRM, Битрикс24, другое) и примерный объём открытых сделок без следующего шага — подготовим карту триггеров и режим «задача + черновик» vs автокасание с учётом 152-ФЗ.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary">Сначала FAQ</a>
    </div>
  </div>
</div>
    </div>
  </section>
</div><!-- /.vnfu-content -->

<script>
/**
 * vnfu-follow-up-engine — Диспетчерская cadence
 * Классы: TouchTokenRibbon (транспорт), StuckDealRadar (центр), ReplyStopShield (финал)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnfu-follow-up-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  var bubbles = [];

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 240;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 440, ch / 260) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    radar: "#1e293b",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    red: "#fb7185",
    tokenMail: "#93c5fd",
    tokenTg: "#a7f3d0",
    tokenTask: "#fcd34d",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0"
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

  function createBubble(x, y, text) {
    bubbles.push({ x: x, y: y, text: text, life: 0, max: 140 });
  }

  function TouchTokenRibbon(y) {
    this.y = y;
    this.offset = 0;
  }
  TouchTokenRibbon.prototype.draw = function (ctx) {
    this.offset = (frame * 0.55) % 120;
    var colors = [C.tokenMail, C.tokenTg, C.tokenTask];
    var labels = ["✉", "TG", "✓"];
    for (var i = -1; i < 6; i++) {
      var tx = -180 + i * 55 + this.offset;
      var col = colors[i % 3];
      drawRR(ctx, tx, this.y, 38, 22, 6, col, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(labels[i % 3], tx + 19, this.y + 14);
    }
  };

  function StuckDealRadar() {
    this.colHighlight = 0;
  }
  StuckDealRadar.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    var phase = prg < 55 ? "scan" : prg < 110 ? "draft" : prg < 165 ? "route" : "reply";

    drawRR(ctx, -95, -72, 190, 145, 12, C.radar, C.outline);

    var cols = ["КП", "7д", "↻"];
    var colW = 52;
    for (var c = 0; c < 3; c++) {
      var cx0 = -78 + c * (colW + 6);
      var active = (phase === "scan" && c === 1) || (phase === "reply" && c === 2);
      drawRR(ctx, cx0, -58, colW, 90, 6, active ? "rgba(121,242,255,.12)" : "rgba(255,255,255,.04)", active ? C.cyan : "rgba(255,255,255,.08)");
      ctx.fillStyle = "#94a3b8";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(cols[c], cx0 + colW / 2, -48);
    }

    var cardX = -26;
    var cardY = -18 + (phase === "reply" ? -8 : 0);
    if (phase === "reply") cardX += 58;
    drawRR(ctx, cardX, cardY, 52, 36, 6, phase === "scan" ? "rgba(251,113,133,.2)" : "rgba(34,197,94,.18)", phase === "scan" ? C.red : C.green);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Сделка", cardX + 26, cardY + 14);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText(phase === "scan" ? "12 дн." : "ответ", cardX + 26, cardY + 26);

    if (phase === "draft" && prg % 55 < 8) createBubble(0, -95, "Персональный черновик");
    if (phase === "route" && prg % 55 < 8) createBubble(70, -40, "Канал: Telegram");
    if (phase === "reply" && prg % 55 < 8) createBubble(-60, -95, "Stop on reply");

    if (phase === "draft") {
      ctx.strokeStyle = "rgba(139,92,246,.5)";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, -95, 14 + Math.sin(frame * 0.12) * 3, 0, Math.PI * 2);
      ctx.stroke();
    }

    if (phase === "reply") {
      ctx.save();
      ctx.translate(55, -55);
      ctx.fillStyle = "rgba(34,197,94,.25)";
      ctx.beginPath();
      ctx.moveTo(0, -12);
      ctx.lineTo(10, 4);
      ctx.lineTo(-10, 4);
      ctx.closePath();
      ctx.fill();
      ctx.strokeStyle = C.green;
      ctx.stroke();
      ctx.restore();
    }

    return phase;
  };

  function SlaHourglass(x, y) {
    this.x = x;
    this.y = y;
  }
  SlaHourglass.prototype.draw = function (ctx) {
    var sand = (Math.sin(frame * 0.08) + 1) / 2;
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -8, -14, 16, 28, 3, "rgba(251,113,133,.15)", C.red);
    ctx.fillStyle = C.red;
    ctx.fillRect(-5, 2 + sand * 8, 10, 4);
    ctx.restore();
  };

  function Agent(role, color) {
    this.role = role;
    this.color = color;
    this.x = -120 + Math.random() * 240;
    this.y = 55;
    this.tx = this.x;
    this.ty = this.y;
    this.dir = 1;
    this.bubbleCd = 0;
    this.dialogs = [
      "Порог 7 дней на КП",
      "Тема из контекста встречи",
      "Webhook → cadence",
      "Тон без спама",
      "Активность в CRM"
    ];
  }
  Agent.prototype.step = function (phase) {
    var targets = {
      scan: { x: -70, y: 42 },
      draft: { x: 0, y: 38 },
      route: { x: 65, y: 42 },
      reply: { x: 85, y: 28 }
    };
    var t = targets[phase] || targets.scan;
    this.tx = t.x;
    this.ty = t.y;
    this.x += (this.tx - this.x) * 0.04;
    this.y += (this.ty - this.y) * 0.04;
    this.dir = this.tx > this.x ? 1 : -1;
    if (this.bubbleCd <= 0 && Math.random() < 0.012) {
      createBubble(this.x, this.y - 22, this.dialogs[this.role % 5]);
      this.bubbleCd = 90;
    }
    this.bubbleCd--;
  };
  Agent.prototype.draw = function (ctx) {
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.scale(this.dir, 1);
    drawRR(ctx, -7, -14, 14, 22, 4, this.color, C.outline);
    ctx.fillStyle = "#fff";
    ctx.beginPath();
    ctx.arc(0, -18, 6, 0, Math.PI * 2);
    ctx.fill();
    ctx.stroke();
    ctx.restore();
  };

  var ribbon = new TouchTokenRibbon(58);
  var radar = new StuckDealRadar();
  var hourglass = new SlaHourglass(-115, -35);
  var agents = [
    new Agent(0, C.agentYellow),
    new Agent(1, C.agentGreen),
    new Agent(2, C.agentBlue),
    new Agent(3, C.agentPink),
    new Agent(4, C.agentPurple)
  ];

  function drawBubbles(ctx) {
    bubbles = bubbles.filter(function (b) {
      b.life++;
      var a = 1 - b.life / b.max;
      if (a <= 0) return false;
      ctx.save();
      ctx.globalAlpha = a;
      ctx.font = "bold 9px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 18, tw, 16, 6, C.bubbleBg, C.cyan);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 6);
      ctx.restore();
      return true;
    });
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    ribbon.draw(ctx);
    var phase = radar.draw(ctx);
    hourglass.draw(ctx);
    agents.forEach(function (a) {
      a.step(phase);
      a.draw(ctx);
    });
    drawBubbles(ctx);

    ctx.restore();
    requestAnimationFrame(loop);
  }
  loop();
});
</script>

<script>
(function(){
  document.querySelectorAll('.vnfu-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.vnfu-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.vnfu-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.vnfu-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
    });
    btn.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();} });
  });
})();
</script>
<script>
(function(){
  'use strict';
  var root = document.querySelector('.vnfu-content');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){ entry.target.classList.add('nero-ai-active'); observer.unobserve(entry.target); }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -6% 0px' });
    items.forEach(function(item){ observer.observe(item); });
  } else { items.forEach(function(item){ item.classList.add('nero-ai-active'); }); }
})();
</script>
<?php
$vnfu_page_url  = trailingslashit( get_permalink() );
$vnfu_site_url  = trailingslashit( home_url( '/' ) );
$vnfu_brand     = $brand ?: 'Nero Network';
$vnfu_page_h1   = 'AI follow-up менеджер: внедрение повторных касаний по сделкам под ключ';
$vnfu_schema    = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $vnfu_site_url . '#organization',
			'name'  => $vnfu_brand,
			'url'   => $vnfu_site_url,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $vnfu_site_url . '#website',
			'url'       => $vnfu_site_url,
			'name'      => $vnfu_brand,
			'publisher' => [ '@id' => $vnfu_site_url . '#organization' ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $vnfu_page_url . '#webpage',
			'url'         => $vnfu_page_url,
			'name'        => $vnfu_page_h1,
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $vnfu_site_url . '#website' ],
			'about'       => [ '@id' => $vnfu_site_url . '#organization' ],
		],
		[
			'@type'           => 'BreadcrumbList',
			'@id'             => $vnfu_page_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vnfu_site_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => $vnfu_page_h1, 'item' => $vnfu_page_url ],
			],
		],
		[
			'@type'       => 'Service',
			'@id'         => $vnfu_page_url . '#service',
			'name'        => $vnfu_page_h1,
			'description' => $page_seo_description,
			'url'         => $vnfu_page_url,
			'provider'    => [ '@id' => $vnfu_site_url . '#organization' ],
		],
		[
			'@type'      => 'FAQPage',
			'@id'        => $vnfu_page_url . '#faq',
			'mainEntity' => [
				[
					'@type'          => 'Question',
					'name'           => 'Чем AI follow-up отличается от email-рассылки?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Рассылка идёт по списку и не смотрит на стадию сделки в CRM. AI follow-up срабатывает по триггерам карточки (нет задачи, N дней без ответа, стадия «КП»), подставляет контекст и останавливается при ответе клиента.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Нужен ли уже настроенный CRM?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Да. Услуга рассчитана на компании, где воронка уже есть; мы не продаём CRM с нуля, а накладываем ai слой в crm. Минимум — стадии, ответственные, поля для генерации текста.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Заменит ли AI менеджеров?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Нет. Заменяет пропущенные касания и ускоряет черновики; закрытие и переговоры — у команды. 94% лидеров с агентами в отчёте Salesforce называют их критичными для роста — как усиление, не как вывод штата.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Сколько длится внедрение?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Аудит — несколько дней; пилот одного сценария — ориентир 2–4 недели; масштабирование зависит от числа воронок и каналов. Жёсткие сроки фиксируют в договоре после аудита.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Сколько касаний нужно лиду?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Считайте медиану по своим закрытым сделкам; ориентиры из чужих опросов (5–8 до встречи) — только как фон, не как KPI.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Опасно ли для персональных данных?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'При работе с ПДн граждан РФ — российские модели (YandexGPT, GigaChat), минимизация полей в промпте, договор обработки, согласия на каналы. Автосообщения в мессенджер — только при наличии правового основания.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'У нас уже есть роботы в CRM — зачем AI?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Роботы шлют шаблон. AI добавляет вариативность и контекст из карточки при сохранении ваших правил и красных линий.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Чем это отличается от AI-агента для amoCRM?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Агент закрывает широкий путь от лида до сделки; follow-up менеджер — узкий фокус на зависших сделках и реактивации базы.',
					],
				],
			],
		],
	],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vnfu_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
?>
<p class="vnfu-related nero-ai-reveal" style="margin:clamp(32px,4vw,48px) auto 0;width:min(var(--vnfu-container),calc(100% - 40px));font-size:15px;line-height:1.65;color:var(--vnfu-muted)">Масштаб и governance AI в продажах на уровне enterprise — в разборе <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--vnfu-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude: уроки AI для бизнеса</a> (managed-агенты и цифровые шлюзы для тысяч сотрудников).</p>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

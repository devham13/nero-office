<?php
/**
 * Template Name: AI-контроль скриптов в продажах: внедрение под ключ
 * Description: SEO-лендинг — AI проверяет чаты и звонки по чек-листу, рейтинг нарушений для РОПа. Внедрение под ключ.
 */

$page_seo_title       = 'AI-контроль скриптов продаж: внедрение под ключ';
$page_seo_description = 'AI проверяет чаты и звонки менеджеров по чек-листу, формирует рейтинг нарушений и отчёты для РОПа. Внедрение под ключ, интеграция с CRM. Проверьте 20 диалогов бесплатно.';

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
    ['label' => 'Проблема',     'href' => '#bole'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы',        'href' => '#etapy'],
    ['label' => 'Интеграции',   'href' => '#integracii'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить 20 диалогов';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';
$ad_banner_url       = getenv('AD_BANNER_URL') ?: '';
$ad_banner_image     = getenv('AD_BANNER_IMAGE_URL') ?: '';
$ad_banner_alt       = getenv('AD_BANNER_ALT') ?: 'Партнёр';

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

/* Скрыть шапку Kadence */
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

/* Status badges for report table */
.aks-status{display:inline-flex;align-items:center;padding:3px 10px;border-radius:999px;font-size:12px;font-weight:700;}
.aks-status--ok{background:rgba(34,197,94,.15);color:#22c55e;}
.aks-status--warn{background:rgba(245,158,11,.15);color:#f59e0b;}
.aks-status--fail{background:rgba(239,68,68,.15);color:#ef4444;}

.aks-pipeline{display:grid;grid-template-columns:repeat(5,1fr);gap:12px;margin:28px 0;}
.aks-pipeline-step{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px;text-align:center;}
.aks-pipeline-step .num{font-size:11px;font-weight:800;color:var(--aks-accent);letter-spacing:.08em;}
.aks-pipeline-step p{font-size:13px;margin:8px 0 0;color:var(--aks-muted);line-height:1.5;}
@media(max-width:900px){.aks-pipeline{grid-template-columns:1fr 1fr;}}
@media(max-width:500px){.aks-pipeline{grid-template-columns:1fr;}}

.aks-scale-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:28px 0;}
.aks-scale-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:20px;text-align:center;}
.aks-scale-card strong{display:block;font-size:clamp(22px,3vw,32px);color:var(--aks-heading);font-weight:900;margin-bottom:6px;}
.aks-scale-card span{font-size:13px;color:var(--aks-muted);}
@media(max-width:700px){.aks-scale-grid{grid-template-columns:1fr;}}

.aks-ascii{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:14px;padding:20px;font-family:ui-monospace,monospace;font-size:13px;line-height:1.6;color:var(--aks-soft);white-space:pre-wrap;margin:24px 0;}

.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-link--accent{color:var(--aks-accent)!important;text-decoration:underline!important;}

.aks-checklist{columns:2;gap:32px;margin:24px 0;}
.aks-checklist h4{font-size:15px;margin:0 0 10px;color:var(--aks-heading);}
.aks-checklist ol{margin:0;padding-left:20px;color:var(--aks-muted);font-size:14px;line-height:1.65;}
.aks-checklist ol li{margin-bottom:4px;}
@media(max-width:768px){.aks-checklist{columns:1;}}

.aks-ad-banner-wrap{max-width:970px;margin:48px auto;padding:0 20px;text-align:center;}
.aks-content{
  --aks-bg:#050711;--aks-bg2:#080b17;--aks-bg3:#0a0e1c;
  --aks-surface:rgba(255,255,255,.072);--aks-surface2:rgba(255,255,255,.108);
  --aks-text:#e6edf7;--aks-muted:#9aa8bd;--aks-soft:#c7d2e5;--aks-heading:#fff;
  --aks-border:rgba(255,255,255,.10);--aks-border-s:rgba(255,255,255,.18);
  --aks-accent:#79f2ff;--aks-violet:#8b5cf6;--aks-green:#22c55e;--aks-cyan:#79f2ff;
  --aks-btn-from:#2563eb;--aks-btn-to:#7c3aed;
  --aks-shadow:0 24px 72px rgba(0,0,0,.4);
  --aks-r:18px;--aks-r-lg:24px;
  --aks-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aks-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aks-content *,.aks-content *::before,.aks-content *::after{box-sizing:border-box;}
.aks-content a{color:inherit;text-decoration:none;}
.aks-content p{color:var(--aks-muted);line-height:1.72;margin:0 0 1em;}
.aks-content p:last-child{margin-bottom:0;}
.aks-content h2,.aks-content h3,.aks-content h4{
  color:var(--aks-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.aks-content strong{color:var(--aks-soft);}
.aks-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aks-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--aks-muted);font-size:14.5px;line-height:1.65;
}
.aks-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--aks-accent);font-weight:700;
}

/* Container */
.aks-cnt{
  width:min(var(--aks-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.aks-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aks-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.aks-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aks-sh.aks-left{margin-left:0;text-align:left;}
.aks-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aks-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aks-sh.aks-left p{margin-left:0;}

/* Eyebrow */
.aks-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--aks-accent);margin-bottom:14px;
}

/* Gradient text */
.aks-gt{
  background:linear-gradient(92deg,#fff 0%,var(--aks-accent) 44%,var(--aks-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.aks-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.aks-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.aks-intro-text{
  position:relative;padding-left:20px;
}
.aks-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--aks-accent),var(--aks-violet));
}
.aks-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--aks-muted);margin-bottom:1em;
}
.aks-intro-text p:last-child{margin-bottom:0;color:var(--aks-soft);}
.aks-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.aks-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.aks-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--aks-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.aks-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aks-muted);line-height:1.4;}
.aks-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .aks-intro-grid{grid-template-columns:1fr;gap:36px;}
  .aks-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .aks-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.aks-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aks-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.aks-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--aks-surface);border:1px solid var(--aks-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--aks-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.aks-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--aks-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.aks-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--aks-border);border-radius:var(--aks-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.aks-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.aks-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aks-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .aks-grid-2{grid-template-columns:1fr;}
  .aks-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .aks-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .aks-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.aks-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--aks-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.aks-level-card:hover{transform:translateY(-2px);}
.aks-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--aks-r) var(--aks-r) 0 0;
}
.aks-level-card.l1::before{background:var(--aks-green);}
.aks-level-card.l2::before{background:var(--aks-accent);}
.aks-level-card.l3::before{background:var(--aks-violet);}
.aks-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.aks-level-card.l1 .aks-level-badge{background:rgba(34,197,94,.15);color:var(--aks-green);}
.aks-level-card.l2 .aks-level-badge{background:rgba(121,242,255,.15);color:var(--aks-accent);}
.aks-level-card.l3 .aks-level-badge{background:rgba(139,92,246,.15);color:var(--aks-violet);}
.aks-level-card h3{font-size:17px;margin-bottom:10px;}
.aks-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.aks-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--aks-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.aks-scenario:last-child{margin-bottom:0;}
.aks-scenario:hover{border-color:rgba(121,242,255,.3);}
.aks-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.aks-scenario h3{font-size:17px;margin-bottom:8px;}
.aks-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.aks-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.aks-table{width:100%;border-collapse:collapse;font-size:14px;}
.aks-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--aks-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.aks-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--aks-text);vertical-align:top;
}
.aks-table tr:last-child td{border-bottom:none;}
.aks-table tr:hover td{background:rgba(255,255,255,.03);}
.aks-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.aks-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.aks-stack-layer:last-child{border-bottom:none;}
.aks-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--aks-accent);padding-top:2px;
}
.aks-stack-val{font-size:14.5px;color:var(--aks-text);}
.aks-stack-desc{font-size:13px;color:var(--aks-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.aks-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.aks-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aks-case-grid{grid-template-columns:1fr;}}
.aks-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.aks-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.aks-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--aks-green);margin-bottom:10px;
}
.aks-case-card h3{font-size:16px;margin-bottom:14px;}
.aks-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.aks-metric{display:flex;align-items:baseline;gap:8px;}
.aks-metric .num{font-size:22px;font-weight:900;color:var(--aks-accent);flex-shrink:0;letter-spacing:-.04em;}
.aks-metric .lbl{font-size:13px;color:var(--aks-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.aks-timeline{position:relative;padding-left:40px;}
.aks-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--aks-accent),var(--aks-violet));
  opacity:.35;border-radius:2px;
}
.aks-tl-item{position:relative;margin-bottom:32px;}
.aks-tl-item:last-child{margin-bottom:0;}
.aks-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--aks-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.aks-tl-item h3{font-size:17px;margin-bottom:8px;}
.aks-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.aks-pricing-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:960px){.aks-pricing-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aks-pricing-grid{grid-template-columns:1fr;}}
.aks-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.aks-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.aks-price-card.aks-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.aks-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--aks-accent);margin-bottom:10px;
}
.aks-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.aks-price-card .inc{font-size:13px;color:var(--aks-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.aks-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.aks-compare{width:100%;border-collapse:collapse;}
.aks-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--aks-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.aks-compare td{
  padding:13px 16px;font-size:14px;color:var(--aks-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.aks-compare tr:last-child td{border-bottom:none;}
.aks-good{color:var(--aks-green);}
.aks-neutral{color:var(--aks-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.aks-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aks-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.aks-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--aks-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.aks-faq-q::after{
  content:'▾';font-size:13px;color:var(--aks-accent);
  flex-shrink:0;transition:transform .25s;
}
.aks-faq-item.open .aks-faq-q::after{transform:rotate(180deg);}
.aks-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--aks-muted);line-height:1.72;
}
.aks-faq-item.open .aks-faq-a{max-height:600px;padding:0 24px 20px;}

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
  color:var(--aks-muted);font-size:15px;
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
  background:linear-gradient(135deg,var(--aks-btn-from),var(--aks-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(59,130,246,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--aks-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(121,242,255,.4);background:rgba(59,130,246,.12);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* =====================================================
   CTA FINAL SECTION
   ===================================================== */
.aks-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.aks-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--aks-muted);
}
.aks-cta-checklist li::before{content:'✓';color:var(--aks-green);font-weight:800;}

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

<main id="primary" class="site-main nero-ai-home-page ai-kontrol-skriptov-page" role="main" tabindex="-1">

<style>
/* Hero ai-kontrol-skriptov — self-contained, scoped */
#hero.nero-ai-hero {
  --aks-hero-bg: #060812;
  --aks-hero-text: #e6edf7;
  --aks-hero-muted: #9aa8bd;
  --aks-hero-soft: #c7d2e5;
  --aks-hero-heading: #ffffff;
  --aks-hero-primary: #79f2ff;
  --aks-hero-violet: #8b5cf6;
  --aks-hero-green: #22c55e;
  --aks-hero-warn: #f59e0b;
  --aks-hero-border: rgba(255, 255, 255, 0.12);
  --aks-hero-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(108px, 14vh, 148px) 0 clamp(48px, 6vw, 72px);
  isolation: isolate;
  color: var(--aks-hero-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
#hero.nero-ai-hero::before {
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
#hero.nero-ai-hero::after {
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
  animation: aksHeroGlow 8s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes aksHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
#hero .nero-ai-container { width: min(1220px, calc(100% - 40px)); margin: 0 auto; position: relative; z-index: 1; }
#hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(320px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
#hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aks-hero-primary);
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
#hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 6.5vw, 82px);
  line-height: .92;
  letter-spacing: -0.065em;
  color: var(--aks-hero-heading);
}
#hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, var(--aks-hero-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}
#hero .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--aks-hero-soft);
  font-size: clamp(17px, 2vw, 21px);
  line-height: 1.58;
}
#hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
#hero .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
  white-space: nowrap;
}
#hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
#hero .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 22px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  line-height: 1;
  text-decoration: none;
  transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
}
#hero .nero-ai-btn:hover,
#hero .nero-ai-btn:focus-visible { transform: translateY(-2px); }
#hero .nero-ai-btn-primary {
  color: #031018;
  background: linear-gradient(135deg, var(--aks-hero-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
#hero .nero-ai-btn-secondary {
  color: var(--aks-hero-text);
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
#hero .nero-ai-btn-secondary:hover {
  border-color: rgba(121, 242, 255, 0.36);
  background: rgba(121, 242, 255, 0.08);
}
#hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aks-hero-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
#hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
#hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
#hero .nero-ai-dots { display: flex; gap: 7px; }
#hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,.22); }
#hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
#hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
#hero .nero-ai-dot:nth-child(3) { background: #34d399; }
#hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
#hero .nero-ai-window-body { padding: 18px; }
#hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
}
#hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -0.03em;
  color: var(--aks-hero-heading);
}
#hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
  white-space: nowrap;
}
#hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aksHeroPulse 1.6s infinite;
}
@keyframes aksHeroPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
#hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
#hero .nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease;
}
#hero .nero-ai-metric:hover { transform: translateY(-3px); border-color: rgba(121,242,255,.34); }
#hero .nero-ai-metric span { display: block; color: var(--aks-hero-muted); font-size: 12px; font-weight: 700; }
#hero .nero-ai-metric strong { display: block; margin-top: 7px; color: #fff; font-size: 24px; line-height: 1; }
#hero .nero-ai-metric small { display: block; margin-top: 6px; color: #9fb0c9; font-size: 12px; }
#hero .nero-ai-metric--score strong { color: var(--aks-hero-primary); }
#hero .nero-ai-metric--warn strong { color: var(--aks-hero-warn); }
#hero .nero-ai-task-stream { margin-top: 16px; display: grid; gap: 10px; }
#hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
  animation: aksTaskFloat 5s ease-in-out infinite;
}
#hero .nero-ai-task:nth-child(2) { animation-delay: .6s; }
#hero .nero-ai-task:nth-child(3) { animation-delay: 1.2s; }
@keyframes aksTaskFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-4px); }
}
#hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--aks-hero-primary);
  font-size: 11px;
  font-weight: 800;
}
#hero .nero-ai-task-icon--warn {
  background: rgba(245,158,11,.15);
  color: var(--aks-hero-warn);
}
#hero .nero-ai-task strong { display: block; color: #f8fafc; font-size: 13px; }
#hero .nero-ai-task .aks-task-sub { color: var(--aks-hero-muted); font-size: 12px; }
#hero .nero-ai-status {
  padding: 5px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
}
#hero .nero-ai-status--warn {
  background: rgba(245,158,11,.14);
  color: #fde68a;
}
#hero .nero-ai-reveal {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity .55s ease, transform .55s ease;
}
#hero .nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
#hero .nero-ai-delay-2 { transition-delay: .24s; }
@media (max-width: 960px) {
  #hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  #hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 600px) {
  #hero .nero-ai-btn-row { flex-direction: column; align-items: stretch; }
  #hero .nero-ai-btn { width: 100%; }
}
</style>

<section class="nero-ai-hero" id="hero" aria-labelledby="hero-aks-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai контроль скриптов</p>
      <h1 id="hero-aks-title">AI-контроль скриптов в продажах: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Менеджеры не соблюдают скрипт, а РОП не может слушать все звонки? AI проверит переписку и звонки по чек-листу и покажет рейтинг нарушений — без ручного контроля каждого диалога.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">100% диалогов</li>
        <li class="nero-ai-badge">Чек-лист QA</li>
        <li class="nero-ai-badge">CRM + телефония</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить 20 диалогов</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: контроль скриптов продаж">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">Контроль скриптов · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Рейтинг нарушений</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid" aria-label="Метрики контроля">
            <div class="nero-ai-metric">
              <span>Охват</span>
              <strong>100%</strong>
              <small>диалогов</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--score">
              <span>Score</span>
              <strong>62/100</strong>
              <small>средний</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--warn">
              <span>Нарушения</span>
              <strong>4</strong>
              <small>критичных</small>
            </div>
            <div class="nero-ai-metric">
              <span>Диалоги</span>
              <strong>847</strong>
              <small>/день</small>
            </div>
          </div>
          <div class="nero-ai-task-stream" aria-label="Лента событий">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">STT</span>
              <div>
                <strong>Звонок → STT → чек-лист</strong>
                <span class="aks-task-sub">Менеджер Иванова · 4:32</span>
              </div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div>
                <strong>Чат Telegram → анализ</strong>
                <span class="aks-task-sub">Открытые вопросы: 1 из 2</span>
              </div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--warn">!</span>
              <div>
                <strong>Compliance: нет уведомления о записи</strong>
                <span class="aks-task-sub">Приоритет для РОПа · fatal error</span>
              </div>
              <span class="nero-ai-status nero-ai-status--warn">алерт</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  var els = document.querySelectorAll('#hero .nero-ai-reveal');
  if (!els.length) return;
  if (!('IntersectionObserver' in window)) {
    els.forEach(function (el) { el.classList.add('nero-ai-active'); });
    return;
  }
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) {
        e.target.classList.add('nero-ai-active');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.15 });
  els.forEach(function (el) { io.observe(el); });
})();
</script>
<div class="aks-content">

  <section class="aks-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="aks-cnt nero-ai-container">
      <div class="aks-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="aks-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai контроль скриптов</p>
          <p><strong>Коротко:</strong> AI-контроль скриптов — автоматическая проверка 100% звонков и переписок менеджеров по вашему чек-листу с рейтингом нарушений, цитатами-доказательствами и отчётами для РОПа. Nero Network внедряет решение под ключ: от аудита скрипта до интеграции с CRM и телефонией. <strong>Проверьте 20 диалогов бесплатно</strong> — получите пример отчёта с рейтингом нарушений.</p>
          <p>Менеджеры не соблюдают скрипт, а РОП не может слушать все звонки — это не лень руководителя, а математика масштаба. AI переводит контроль качества из режима «2–5% на глаз» в режим 100% диалогов с объективным рейтингом нарушений.</p>
        </div>
        <div class="aks-intro-kpi" aria-label="Ключевые показатели рынка">
          <div class="aks-kpi-card"><div class="kv">46%</div><div class="kl">продавцов редко получают feedback</div><div class="ks">Salesforce 2026</div></div>
          <div class="aks-kpi-card"><div class="kv">2–5%</div><div class="kl">ручной QA покрывает диалоги</div><div class="ks">Rechka.ai</div></div>
          <div class="aks-kpi-card"><div class="kv">87%</div><div class="kl">организаций уже используют AI</div><div class="ks">Salesforce 2026</div></div>
          <div class="aks-kpi-card"><div class="kv">100%</div><div class="kl">охват при AI-контроле</div><div class="ks">цель внедрения</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aks-toc-outer">
    <div class="aks-cnt">
      <nav class="aks-toc" aria-label="Оглавление статьи">
        <a href="#bole">Проблема</a>
        <a href="#chto-eto">Что такое</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#etapy">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#cheklist">Чек-лист</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="aks-section" id="bole">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Боль РОПа</span>
        <h2>Менеджеры не соблюдают скрипт — а РОП не успевает слушать все звонки</h2>
        <p>Скрипт продаж лежит в Google Docs, проходит на планёрке — и растворяется в реальности. Руководитель знает, что стандарты «плывут», но физически не может прослушать каждый диалог.</p>
      </div>

      <div class="aks-scale-grid nero-ai-reveal" aria-label="Масштаб проблемы">
        <div class="aks-scale-card"><strong>10 000</strong><span>звонков в день при 50 операторов × 200 звонков</span></div>
        <div class="aks-scale-card"><strong>500</strong><span>записей при выборочной проверке 5%</span></div>
        <div class="aks-scale-card"><strong>1 день</strong><span>супервайзера на прослушивание выборки</span></div>
      </div>

      <div class="aks-card nero-ai-reveal">
        <h3 style="font-size:18px;margin-bottom:14px;">Сколько диалогов реально проверяет РОП</h3>
        <p>Ручной QA в отрасли покрывает <strong>2–5% коммуникаций</strong>. Остальные 95–98% диалогов остаются без контроля. По данным <strong>Salesforce State of Sales 2026</strong>, <strong>46% продавцов редко получают обратную связь</strong> по разговорам с клиентами.</p>
        <p>Когда скрипт не соблюдается, падают конверсия этапов воронки, compliance (152-ФЗ), единый стандарт бренда и скорость обучения. Кейс <strong>SalesAI</strong> в нефтегазовом B2B: после автоматического анализа 100% звонков заявлен <strong>рост конверсии на 15%</strong>.</p>
      </div>

      <div class="aks-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aks-table" aria-label="Сравнение ручного и AI-контроля">
          <thead><tr><th>Критерий</th><th>Ручной контроль</th><th>AI-контроль скриптов</th></tr></thead>
          <tbody>
            <tr><td>Охват диалогов</td><td>2–5%</td><td>До 100%</td></tr>
            <tr><td>Скорость отчёта</td><td>Дни–недели</td><td>Часы, алерты в реальном времени</td></tr>
            <tr><td>Субъективность</td><td>Высокая</td><td>Единые критерии + цитаты</td></tr>
            <tr><td>Масштабирование</td><td>+1 супервайзер на N операторов</td><td>Один контур на весь отдел</td></tr>
            <tr><td>Доказательная база</td><td>Заметки супервайзера</td><td>Цитата из диалога с таймкодом</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="chto-eto">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Определение</span>
        <h2>Что такое AI-контроль скриптов в переписке и звонках</h2>
        <p>Автоматизированная система оценки качества коммуникаций: звонков, чатов, email и других каналов — по вашему чек-листу, не по абстрактному «качеству разговора».</p>
      </div>

      <div class="aks-pipeline nero-ai-reveal" aria-label="5 шагов AI-контроля">
        <div class="aks-pipeline-step"><div class="num">01</div><p>Забирает записи из телефонии, CRM, мессенджеров</p></div>
        <div class="aks-pipeline-step"><div class="num">02</div><p>Транскрибирует аудио (STT) или анализирует текст</p></div>
        <div class="aks-pipeline-step"><div class="num">03</div><p>Сверяет диалог с чек-листом / скриптом</p></div>
        <div class="aks-pipeline-step"><div class="num">04</div><p>Выставляет score и рейтинг нарушений</p></div>
        <div class="aks-pipeline-step"><div class="num">05</div><p>Формирует отчёты для РОПа и задачи в CRM</p></div>
      </div>

      <div class="aks-grid-3 nero-ai-reveal">
        <div class="aks-card"><h3>Звонки</h3><p>Mango Office, UIS, Sipuni, Zadarma, Calltouch — записи через API/webhook.</p></div>
        <div class="aks-card"><h3>Мессенджеры</h3><p>Telegram, WhatsApp Business API, VK, открытые линии Bitrix24.</p></div>
        <div class="aks-card"><h3>CRM</h3><p>amoCRM, Bitrix24 — чаты и email в карточке сделки в едином контуре.</p></div>
      </div>
    </div>
  </section>

<section id="ai-kontrol-skriptov-boris-block" class="aks-root" aria-label="Анимация: омниканальные диалоги проходят AI-проверку по чек-листу и формируют рейтинг нарушений для РОПа">
<style>
/* === БОРИС: prefix aks-, scoped внутри #ai-kontrol-skriptov-boris-block === */
#ai-kontrol-skriptov-boris-block.aks-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-kontrol-skriptov-boris-block .aks-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-kontrol-skriptov-boris-block .aks-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-kontrol-skriptov-boris-block .aks-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-kontrol-skriptov-boris-block .aks-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-kontrol-skriptov-boris-block .aks-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-kontrol-skriptov-boris-block .aks-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0891b2;
  margin:0 0 14px;
}
#ai-kontrol-skriptov-boris-block .aks-ey::before{
  content:'';
  width:18px;height:2px;
  background:#79f2ff;
  border-radius:1px;
}
#ai-kontrol-skriptov-boris-block .aks-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-kontrol-skriptov-boris-block .aks-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-kontrol-skriptov-boris-block .aks-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-kontrol-skriptov-boris-block .aks-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(121,242,255,.14);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0e7490;
  margin-top:1px;
  font-style:normal;
}
#ai-kontrol-skriptov-boris-block .aks-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-kontrol-skriptov-boris-block .aks-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-kontrol-skriptov-boris-block .aks-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-kontrol-skriptov-boris-block .aks-pl-c{
  background:rgba(121,242,255,.12);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.35);
}
#ai-kontrol-skriptov-boris-block .aks-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-kontrol-skriptov-boris-block .aks-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-kontrol-skriptov-boris-block .aks-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfeff 0%,#f0f9ff 40%,#faf5ff 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-kontrol-skriptov-boris-block .aks-rgt{min-height:380px;}
}
#aks-script-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="aks-cnt">
  <div class="aks-card">

    <div class="aks-lft">
      <span class="aks-ey">Pipeline QA · ai контроль скриптов</span>
      <h3 class="aks-h3">Звонок, чат или письмо — AI сверяет каждый диалог с чек-листом и отдаёт рейтинг нарушений</h3>
      <ul class="aks-ul">
        <li><span class="aks-ic">1</span>Запись из телефонии, CRM или мессенджера попадает в очередь — 100% диалогов, не 2–5%</li>
        <li><span class="aks-ic">2</span>STT и diarization: кто менеджер, кто клиент; текст готов к анализу</li>
        <li><span class="aks-ic">3</span>LLM сверяет транскрипт с чек-листом — обязательные фразы, этапы воронки, fatal errors</li>
        <li><span class="aks-ic">4</span>Score 0–100, цитаты-доказательства и приоритеты для РОПа — в CRM и утренний брифинг</li>
      </ul>
      <div class="aks-pills">
        <span class="aks-pl aks-pl-c">100% охват</span>
        <span class="aks-pl aks-pl-g">&gt;90% точность</span>
        <span class="aks-pl aks-pl-v">Звонки + чаты</span>
      </div>
      <p class="aks-foot">Дальше — как устроена проверка по чек-листу и пример отчёта →</p>
    </div>

    <div class="aks-rgt">
      <canvas
        id="aks-script-pipeline-canvas"
        aria-label="Анимация: звонки и чаты проходят STT, сверку с чек-листом скрипта и формируют рейтинг нарушений для РОПа"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('aks-script-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
    layoutNodes();
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    cyan:'#79f2ff',
    cyanD:function(a){return 'rgba(121,242,255,'+a+')';},
    viol:'#8b5cf6',
    violD:function(a){return 'rgba(139,92,246,'+a+')';},
    green:'#22c55e',
    greenD:function(a){return 'rgba(34,197,94,'+a+')';},
    amber:'#f59e0b',
    red:'#ef4444',
    ink:'#0f172a',
    text:'#334155',
    muted:'#64748b',
    card:'rgba(255,255,255,.92)',
    cardBdr:'rgba(148,163,184,.35)',
    line:'rgba(14,165,233,.28)'
  };

  var nodes = {};
  function layoutNodes(){
    nodes = {
      phone:  {x: W*0.06, y: H*0.22, r: 22},
      chat:   {x: W*0.06, y: H*0.50, r: 22},
      mail:   {x: W*0.06, y: H*0.78, r: 22},
      stt:    {x: W*0.28, y: H*0.50, w: 56, h: 56},
      check:  {x: W*0.52, y: H*0.50, w: 72, h: 72},
      report: {x: W*0.82, y: H*0.50, w: 100, h: 130}
    };
  }

  var CHECK_ITEMS = [
    {label:'Представление', status:'ok'},
    {label:'Запись разговора', status:'fail'},
    {label:'Discovery ≥2', status:'warn'},
    {label:'Next step', status:'fail'},
    {label:'CRM обновлена', status:'ok'}
  ];

  var packets = [];
  var scanIdx = 0;
  var scanT = 0;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect){ctx.roundRect(x,y,w,h,r);}
    else{
      ctx.moveTo(x+r,y);ctx.arcTo(x+w,y,x+w,y+h,r);
      ctx.arcTo(x+w,y+h,x,y+h,r);ctx.arcTo(x,y+h,x,y,r);
      ctx.arcTo(x,y,x+w,y,r);ctx.closePath();
    }
    if(fill){ctx.fillStyle=fill;ctx.fill();}
    if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke();}
  }

  function statusColor(st){
    if(st==='ok') return C.green;
    if(st==='warn') return C.amber;
    return C.red;
  }

  function spawnPacket(fromKey){
    var from = nodes[fromKey];
    if(!from) return;
    packets.push({
      from: fromKey,
      x: from.x + from.r + 4,
      y: from.y,
      tx: nodes.stt.x - nodes.stt.w/2 - 8,
      ty: nodes.stt.y,
      t: 0,
      speed: 0.018 + Math.random()*0.008,
      alpha: 0,
      phase: 'toStt',
      color: fromKey==='phone'?C.cyan:(fromKey==='chat'?C.viol:'#38bdf8')
    });
  }

  function drawChannelIcon(x,y,r,type,pulse){
    var glow = 6 + Math.sin(pulse)*2;
    ctx.beginPath();
    ctx.arc(x,y,r+glow,0,Math.PI*2);
    ctx.fillStyle = type==='phone'?C.cyanD(0.12):C.violD(0.12);
    ctx.fill();

    rr(x-r,y-r,r*2,r*2,r*0.35,C.card,C.cardBdr,1.2);

    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';

    if(type==='phone'){
      ctx.beginPath();
      ctx.moveTo(x-5,y-8);ctx.lineTo(x+5,y-8);ctx.lineTo(x+7,y+2);
      ctx.lineTo(x-7,y+2);ctx.closePath();
      ctx.fillStyle = C.cyan;ctx.fill();
      ctx.fillStyle = C.muted;
      ctx.font = '9px Inter,sans-serif';
      ctx.fillText('Звонок', x, y+r+12);
    } else if(type==='chat'){
      rr(x-8,y-6,16,12,4,C.violD(0.25),C.viol,1);
      ctx.fillStyle = C.viol;
      ctx.font = 'bold 10px sans-serif';
      ctx.fillText('TG', x, y);
      ctx.fillStyle = C.muted;
      ctx.font = '9px Inter,sans-serif';
      ctx.fillText('Чат', x, y+r+12);
    } else {
      rr(x-9,y-5,18,11,2,'#fff','#94a3b8',1);
      ctx.strokeStyle = '#94a3b8';
      ctx.beginPath();ctx.moveTo(x-6,y-1);ctx.lineTo(x,y+3);ctx.lineTo(x+6,y-1);ctx.stroke();
      ctx.fillStyle = C.muted;
      ctx.font = '9px Inter,sans-serif';
      ctx.fillText('CRM', x, y+r+12);
    }
  }

  function drawSttBox(pulse){
    var n = nodes.stt;
    var x = n.x - n.w/2, y = n.y - n.h/2;
    rr(x,y,n.w,n.h,12,C.card,C.cyanD(0.5+0.15*Math.sin(pulse*0.08)),1.5);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('STT', n.x, n.y - 6);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText('diarization', n.x, n.y + 8);

    for(var i=0;i<4;i++){
      var bx = x+10 + i*10;
      var bh = 8 + Math.sin(pulse*0.12 + i)*6;
      rr(bx, y+n.h-14-bh, 6, bh, 2, C.cyanD(0.55), null);
    }
  }

  function drawChecklist(pulse){
    var n = nodes.check;
    var x = n.x - n.w/2, y = n.y - n.h/2;
    rr(x,y,n.w,n.h,14,C.card,C.violD(0.45),1.5);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('Чек-лист', n.x, y+14);

    var itemH = 14;
    var startY = y + 22;
    for(var i=0;i<CHECK_ITEMS.length;i++){
      var item = CHECK_ITEMS[i];
      var iy = startY + i*itemH;
      var active = (i === scanIdx);
      var sc = statusColor(item.status);
      if(active){
        rr(x+4, iy-2, n.w-8, itemH-2, 4, C.violD(0.15), null);
      }
      ctx.beginPath();
      ctx.arc(x+12, iy+4, 4, 0, Math.PI*2);
      ctx.fillStyle = sc;
      ctx.fill();
      ctx.fillStyle = active ? C.ink : C.muted;
      ctx.font = (active?'bold ':'')+'8px Inter,sans-serif';
      ctx.textAlign = 'left';
      var lbl = item.label.length>14 ? item.label.slice(0,13)+'…' : item.label;
      ctx.fillText(lbl, x+20, iy+7);
    }
  }

  function drawReport(pulse){
    var n = nodes.report;
    var x = n.x - n.w/2, y = n.y - n.h/2;
    rr(x,y,n.w,n.h,14,C.card,C.cardBdr,1.2);

    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Отчёт РОПа', x+10, y+16);

    ctx.fillStyle = C.ink;
    ctx.font = 'bold 22px Inter,sans-serif';
    ctx.fillText('62', x+10, y+42);
    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.fillText('/100', x+38, y+42);

    var barW = n.w - 20;
    var fillW = barW * 0.62;
    rr(x+10, y+50, barW, 6, 3, '#e2e8f0', null);
    rr(x+10, y+50, fillW, 6, 3, C.amber, null);

    var violations = [
      {label:'Нет уведомления о записи', pct:0.78, col:C.red},
      {label:'Next step без даты', pct:0.55, col:C.amber},
      {label:'Discovery 1 вопрос', pct:0.32, col:C.amber}
    ];
    for(var i=0;i<violations.length;i++){
      var v = violations[i];
      var vy = y + 68 + i*18;
      ctx.fillStyle = C.text;
      ctx.font = '8px Inter,sans-serif';
      ctx.fillText(v.label, x+10, vy);
      rr(x+10, vy+4, barW, 4, 2, '#e2e8f0', null);
      rr(x+10, vy+4, barW*v.pct, 4, 2, v.col, null);
    }

    var blink = 0.5 + 0.5*Math.sin(pulse*0.1);
    ctx.fillStyle = C.greenD(blink*0.35);
    rr(x+8, y+n.h-22, n.w-16, 16, 6, C.greenD(blink*0.2), C.green, 1);
    ctx.fillStyle = '#15803d';
    ctx.font = 'bold 8px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('4 нарушения · CRM', n.x, y+n.h-11);
  }

  function drawFlowLines(pulse){
    ctx.setLineDash([4,4]);
    ctx.lineDashOffset = -pulse*0.5;
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1.5;

    function line(x1,y1,x2,y2){
      ctx.beginPath();
      ctx.moveTo(x1,y1);
      ctx.lineTo(x2,y2);
      ctx.stroke();
    }

    line(nodes.phone.x+nodes.phone.r+2, nodes.phone.y, nodes.stt.x-nodes.stt.w/2, nodes.stt.y-12);
    line(nodes.chat.x+nodes.chat.r+2, nodes.chat.y, nodes.stt.x-nodes.stt.w/2, nodes.stt.y);
    line(nodes.mail.x+nodes.mail.r+2, nodes.mail.y, nodes.stt.x-nodes.stt.w/2, nodes.stt.y+12);
    line(nodes.stt.x+nodes.stt.w/2, nodes.stt.y, nodes.check.x-nodes.check.w/2, nodes.check.y);
    line(nodes.check.x+nodes.check.w/2, nodes.check.y, nodes.report.x-nodes.report.w/2, nodes.report.y);

    ctx.setLineDash([]);
  }

  function drawPackets(){
    for(var i=packets.length-1;i>=0;i--){
      var p = packets[i];
      p.t += p.speed;
      if(p.t>1) p.t=1;
      p.alpha = Math.min(1, p.t*2);

      var cx, cy;
      if(p.phase==='toStt'){
        cx = p.x + (p.tx - p.x)*p.t;
        cy = p.y + (p.ty - p.y)*p.t + Math.sin(p.t*Math.PI)*8;
        if(p.t>=1){
          p.phase='toCheck';
          p.x = nodes.stt.x + nodes.stt.w/2 + 4;
          p.y = nodes.stt.y;
          p.tx = nodes.check.x - nodes.check.w/2 - 6;
          p.ty = nodes.check.y;
          p.t = 0;
        }
      } else if(p.phase==='toCheck'){
        cx = p.x + (p.tx - p.x)*p.t;
        cy = p.y + (p.ty - p.y)*p.t;
        if(p.t>=1){
          p.phase='toReport';
          p.x = nodes.check.x + nodes.check.w/2 + 4;
          p.y = nodes.check.y;
          p.tx = nodes.report.x - nodes.report.w/2 - 6;
          p.ty = nodes.report.y;
          p.t = 0;
        }
      } else {
        cx = p.x + (p.tx - p.x)*p.t;
        cy = p.y + (p.ty - p.y)*p.t;
        if(p.t>=1) packets.splice(i,1);
      }

      if(packets[i]){
        ctx.globalAlpha = p.alpha;
        ctx.beginPath();
        ctx.arc(cx, cy, 5, 0, Math.PI*2);
        ctx.fillStyle = p.color;
        ctx.fill();
        ctx.globalAlpha = 1;
      }
    }
  }

  var spawnTimer = 0;
  var channels = ['phone','chat','mail'];
  var chIdx = 0;

  function tick(){
    frame++;
    ctx.clearRect(0,0,W,H);

    drawFlowLines(frame);
    drawChannelIcon(nodes.phone.x, nodes.phone.y, nodes.phone.r, 'phone', frame);
    drawChannelIcon(nodes.chat.x, nodes.chat.y, nodes.chat.r, 'chat', frame);
    drawChannelIcon(nodes.mail.x, nodes.mail.y, nodes.mail.r, 'mail', frame);
    drawSttBox(frame);
    drawChecklist(frame);
    drawReport(frame);
    drawPackets();

    spawnTimer++;
    if(spawnTimer % 55 === 0){
      spawnPacket(channels[chIdx % 3]);
      chIdx++;
    }

    scanT++;
    if(scanT > 45){
      scanT = 0;
      scanIdx = (scanIdx + 1) % CHECK_ITEMS.length;
    }

    requestAnimationFrame(tick);
  }
  tick();
})();
</script>
</section>
  <section class="aks-section" id="kak-rabotaet">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Проверка по чек-листу</span>
        <h2>Как AI проверяет диалоги по чек-листу</h2>
        <p>Pipeline: звонок → STT + diarization → LLM-сверка с чек-листом → score 0–100, рейтинг нарушений, алерты в CRM.</p>
      </div>

      <div class="aks-card nero-ai-reveal">
        <h3 style="font-size:18px;margin-bottom:12px;">Типовой чек-лист контроля скрипта</h3>
        <p>Открытие (представление, цель, уведомление о записи) · Discovery (открытые вопросы, квалификация) · Презентация (ценность к потребности) · Возражения · Закрытие (next step с датой) · Compliance · Документация в CRM.</p>
        <p>Система различает <strong>fatal errors</strong> (нет уведомления о записи, грубость, запретные обещания) и <strong>взвешенные навыки</strong> (глубина discovery, качество открытых вопросов).</p>
      </div>

      <div class="aks-sh aks-left" style="margin-top:40px;margin-bottom:24px;">
        <span class="aks-eyebrow">Демо-отчёт</span>
        <h2>Пример фрагмента отчёта</h2>
        <p>Звонок менеджера Ивановой, 12.08.2026, 4:32 — формат с цитатами и статусами.</p>
      </div>

      <div class="aks-table-wrap nero-ai-reveal">
        <table class="aks-table" aria-label="Пример отчёта AI-контроля скриптов">
          <thead>
            <tr><th>Пункт чек-листа</th><th>Статус</th><th>Цитата-доказательство</th></tr>
          </thead>
          <tbody>
            <tr><td>Представление</td><td><span class="aks-status aks-status--ok">✅ Выполнен</span></td><td>«Добрый день, меня зовут Анна, компания Nero Network»</td></tr>
            <tr><td>Уведомление о записи</td><td><span class="aks-status aks-status--fail">❌ Не выполнен</span></td><td>—</td></tr>
            <tr><td>Открытые вопросы (≥2)</td><td><span class="aks-status aks-status--warn">⚠️ Частично</span></td><td>«Расскажите, чем сейчас занимаетесь?» — 1 вопрос</td></tr>
            <tr><td>Next step с датой</td><td><span class="aks-status aks-status--fail">❌ Не выполнен</span></td><td>«Я вам перезвоню» — без даты</td></tr>
            <tr><td>CRM обновлена</td><td><span class="aks-status aks-status--ok">✅ Выполнен</span></td><td>Задача создана в amoCRM</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:16px;text-align:center;color:var(--aks-soft);"><strong>Итоговый score:</strong> 62/100. <strong>Приоритет для РОПа:</strong> уведомление о записи (compliance), фиксация next step.</p>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-demo">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить 20 диалогов — получить такой отчёт</p>
          <p class="ym-cta-block__sub">Подключим выборку ваших звонков и переписок, прогоним через AI-чек-лист и вернём рейтинг нарушений с цитатами из диалогов. Бесплатно, без обязательств по внедрению.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="dlya-kogo">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Сегменты</span>
        <h2>Для кого подходит: отдел продаж, колл-центр, франшиза</h2>
        <p>Критерий не размер, а наличие скрипта, CRM и регулярных диалогов с клиентами.</p>
      </div>
      <div class="aks-grid-3">
        <div class="aks-card nero-ai-reveal">
          <div class="aks-eyebrow">B2B</div>
          <h3>Длинный цикл сделки</h3>
          <p>Соблюдение квалификации на каждом касании, фиксация next step, единый стандарт презентации ценности. Process Mining тысяч диалогов → корректировка скрипта на данных.</p>
        </div>
        <div class="aks-card nero-ai-reveal nero-ai-delay-1">
          <div class="aks-eyebrow">Колл-центр</div>
          <h3>Высокий поток обращений</h3>
          <p>100% охват при 200+ звонках в день. LLM-подход понимает смысл, а не только ключевые слова — фильтр «только значимые диалоги».</p>
        </div>
        <div class="aks-card nero-ai-reveal nero-ai-delay-2">
          <div class="aks-eyebrow">Франшиза</div>
          <h3>Единый стандарт скрипта</h3>
          <p>Единый рейтинг нарушений по всем филиалам. Пилот на 20 диалогах показывает картину без найма супервайзера — даже для команд 3–5 менеджеров.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aks-section" id="etapy">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Внедрение под ключ</span>
        <h2>Внедрение AI-контроля скриптов: этапы и сроки</h2>
        <p>Полное внедрение — 2–4 недели от аудита до production. На стороне клиента программист не нужен.</p>
      </div>
      <div class="aks-timeline nero-ai-reveal">
        <div class="aks-tl-item">
          <div class="aks-tl-dot"></div>
          <h3>Аудит скриптов и чек-листа <span style="color:var(--aks-muted);font-weight:600;">(1–2 дня)</span></h3>
          <p>Анализ скриптов, карта каналов, юридическая база (152-ФЗ), сбор 20–50 записей для калибровки.</p>
        </div>
        <div class="aks-tl-item">
          <div class="aks-tl-dot"></div>
          <h3>Подключение CRM и телефонии <span style="color:var(--aks-muted);font-weight:600;">(3–7 дней)</span></h3>
          <p>Webhook/API → STT → LLM-анализ → CRM. amoCRM, Bitrix24, Mango Office, UIS, Sipuni, Calltouch.</p>
        </div>
        <div class="aks-tl-item">
          <div class="aks-tl-dot"></div>
          <h3>Обучение РОПа и пилот на 20 диалогах <span style="color:var(--aks-muted);font-weight:600;">(3–7 дней)</span></h3>
          <p>Калибровка промптов, замер false positive rate, ручная валидация выборки РОПом, корректировка fatal errors.</p>
        </div>
        <div class="aks-tl-item">
          <div class="aks-tl-dot"></div>
          <h3>Запуск отчётов и корректировка скрипта <span style="color:var(--aks-muted);font-weight:600;">(1–2 недели)</span></h3>
          <p>Дашборд РОПа, еженедельный разбор диалогов, Process Mining для обновления скрипта по конверсии.</p>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">РОП хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI-контроля скриптов полезно разобраться в промптах, human-in-the-loop и настройке чек-листов под воронку — это ускоряет калибровку на 20 диалогах. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="integracii">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Интеграции</span>
        <h2>Интеграция с CRM и телефонией</h2>
        <p>Без связки с CRM оценка диалога остаётся «красивым PDF», а не рабочим инструментом.</p>
      </div>
      <div class="aks-grid-2 nero-ai-reveal">
        <div class="aks-card">
          <h3>amoCRM и Bitrix24</h3>
          <p>Звонки и переписка в карточке → AI-оценка → поле score, комментарий, задача. Локальные LLM (GigaChat, YandexGPT) для 152-ФЗ.</p>
        </div>
        <div class="aks-card">
          <h3>Телефония</h3>
          <p>Mango Office, UIS, Sipuni, Calltouch — записи через API. STT → LLM → результат в CRM без программиста на стороне клиента.</p>
        </div>
      </div>
      <div class="aks-ascii nero-ai-reveal" aria-label="Схема интеграции">Телефония / мессенджеры / CRM
        ↓
   Модуль приёма данных
        ↓
   STT + diarization
        ↓
   LLM-оценка по чек-листу (JSON schema)
        ↓
   CRM (поля, задачи, комментарии)
        ↓
   Дашборд РОПа + алерты</div>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>

  <section class="aks-section" id="ceny">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Цена и ROI</span>
        <h2>Сколько стоит и какой ROI от контроля скриптов</h2>
        <p>Ориентир чека Nero Network: <strong>200–650 тыс. ₽</strong> — зависит от каналов, объёма диалогов и глубины интеграции.</p>
      </div>
      <div class="aks-table-wrap nero-ai-reveal">
        <table class="aks-table" aria-label="Компоненты стоимости внедрения">
          <thead><tr><th>Компонент</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Аудит и чек-лист</td><td>15–25 критериев, fatal errors, веса</td></tr>
            <tr><td>Интеграции</td><td>CRM + телефония + мессенджеры</td></tr>
            <tr><td>STT + LLM</td><td>YandexGPT/GigaChat (152-ФЗ) или согласованный контур</td></tr>
            <tr><td>Дашборд и алерты</td><td>Рейтинг, отчёты, утренний брифинг</td></tr>
            <tr><td>Пилот и калибровка</td><td>20+ диалогов, снижение false positives</td></tr>
            <tr><td>Обучение РОПа</td><td>1–2 сессии + документация</td></tr>
          </tbody>
        </table>
      </div>
      <div class="aks-table-wrap nero-ai-reveal" style="margin-top:24px;">
        <table class="aks-table" aria-label="KPI после внедрения">
          <thead><tr><th>KPI</th><th>До внедрения</th><th>Цель после</th></tr></thead>
          <tbody>
            <tr><td>Охват проверенных диалогов</td><td>2–5%</td><td>100%</td></tr>
            <tr><td>% соблюдения чек-листа</td><td>Неизвестен</td><td>+20–30% за 2–3 мес.</td></tr>
            <tr><td>Время реакции на нарушение</td><td>Дни</td><td>Часы</td></tr>
            <tr><td>False positive rate AI</td><td>—</td><td>&lt;10% после калибровки</td></tr>
          </tbody>
        </table>
      </div>
      <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте стоимость для вашего отдела</p>
          <p class="ym-cta-block__sub">Ориентир 200–650 тыс. ₽ за внедрение под ключ. На бесплатной проверке 20 диалогов дадим оценку каналов, CRM-совместимости и ROI — без обязательств.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Узнать стоимость для вашего отдела</a>
            <a href="#cheklist" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Скачать чек-лист качества</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="keisy">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения</h2>
      </div>
      <div class="aks-table-wrap nero-ai-reveal">
        <table class="aks-table" aria-label="Кейсы до и после">
          <thead><tr><th>Кейс</th><th>Что сделали</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>SalesAI, нефтегаз B2B</td><td>100% звонков, Process Mining</td><td>+15% конверсии</td></tr>
            <tr><td>NeuralOps, Bitrix24</td><td>AI-РОП, 1000+ лидов</td><td>~3000 звонков, ~600 задач</td></tr>
            <tr><td>EdUnit ScriptCheck</td><td>13 пунктов, 7+ филиалов</td><td>Контроль каждого звонка</td></tr>
            <tr><td>Яндекс YaCalls</td><td>LLM вместо 5% выборки</td><td>Точность &gt;90%, 100% охват</td></tr>
          </tbody>
        </table>
      </div>
      <div class="aks-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:18px;margin-bottom:12px;">Типовые ошибки, которые выявляет AI</h3>
        <ul>
          <li>Нет уведомления о записи — compliance, штрафы по 152-ФЗ</li>
          <li>«Я вам перезвоню» без даты — потеря сделки</li>
          <li>Монолог вместо discovery — менеджер говорит 80% времени</li>
          <li>Игнорирование возражения «дорого»</li>
          <li>Незаполненная CRM — сделка без следующего шага</li>
          <li>Запретные обещания и презентация каталога вместо боли клиента</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="aks-section" id="cheklist">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Лид-магнит</span>
        <h2>Чек-лист качества продаж — 18 пунктов</h2>
        <p>Сверьте свой отдел с контрольным списком скрипта продаж.</p>
      </div>
      <div class="aks-checklist nero-ai-reveal">
        <div><h4>Открытие (4)</h4><ol><li>Представление: имя + компания</li><li>Цель звонка</li><li>Уведомление о записи</li><li>Позитивный тон, удобство времени</li></ol></div>
        <div><h4>Discovery (4)</h4><ol><li>≥2 открытых вопросов</li><li>Выявлена боль</li><li>Квалификация (бюджет, сроки, ЛПР)</li><li>Резюме услышанного</li></ol></div>
        <div><h4>Презентация и возражения (4)</h4><ol><li>Ценность к потребности</li><li>Возражение отработано</li><li>Нет запретных формулировок</li><li>Не перебивает клиента</li></ol></div>
        <div><h4>Закрытие и CRM (6)</h4><ol><li>Next step с датой</li><li>Контакты подтверждены</li><li>Клиент понял шаг</li><li>CRM обновлена в день контакта</li><li>Задача follow-up</li><li>Итог в карточке сделки</li></ol></div>
      </div>
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверьте 20 диалогов бесплатно</p>
          <p class="ym-cta-block__sub">Получите пример отчёта с рейтингом нарушений, цитатами из ваших звонков и чатов — и поймёте, где отдел теряет конверсию. Пилот 3–7 дней, без подписания договора.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить 20 диалогов бесплатно</a>
        </div>
      </div>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="faq">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">FAQ</span>
        <h2>FAQ по AI-контролю скриптов</h2>
      </div>
      <div class="aks-faq nero-ai-reveal">
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Нужно ли согласие клиента на запись и анализ?</div><div class="aks-faq-a"><p>Да. Запись — обработка ПДн по 152-ФЗ. Обязательно уведомление в начале звонка. С 01.09.2025 согласие на ПДн — отдельный документ. Nero Network закладывает compliance с первого дня.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Заменяет ли AI живого РОПа?</div><div class="aks-faq-a"><p>Нет. AI сигнализирует — РОП принимает решения. 87% продавцов отмечают снижение стресса при прозрачных критериях оценки (Salesforce 2026).</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Как быстро виден результат?</div><div class="aks-faq-a"><p>Пилот 20 диалогов — 3–7 дней. Полное внедрение — 2–4 недели. Рост % соблюдения скрипта — 2–3 месяца (+20–30%). Влияние на конверсию — 1–2 квартала после Process Mining.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли настроить разные скрипты для отделов?</div><div class="aks-faq-a"><p>Да: inbound/outbound, B2B/B2C, новые/опытные менеджеры, филиалы — отдельные чек-листы с fatal errors и весами.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Чем Nero Network отличается от Bitrix24 CoPilot?</div><div class="aks-faq-a"><p>CoPilot — ограниченные квоты и слабая кастомизация. Nero Network: кастомный чек-лист, омниканал, автозадачи в CRM, калибровка false positives, 152-ФЗ.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от Oki-Toki и Rechka.ai?</div><div class="aks-faq-a"><p>Oki-Toki — keyword-based без глубокого LLM. Rechka.ai — фокус на звонки. Nero Network — омниканал + CRM + compliance под ключ.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Работает ли без программиста на стороне клиента?</div><div class="aks-faq-a"><p>Да. Интеграцию выполняет Nero Network. Клиент предоставляет доступ к API, скрипты и 20–50 записей для калибровки.</p></div></div>
        <div class="aks-faq-item"><div class="aks-faq-q" tabindex="0" role="button" aria-expanded="false">Что такое ai контроль скриптов простыми словами?</div><div class="aks-faq-a"><p>Автоматическая проверка каждого звонка и чата по вашему списку правил — с оценкой, цитатами и отчётом для руководителя вместо ручного прослушивания 5% звонков.</p></div></div>
      </div>
    </div>
  </section>

  <section class="aks-section" id="sravnenie">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Сравнение</span>
        <h2>Сравнение решений: что выбрать</h2>
      </div>
      <div class="aks-compare-wrap nero-ai-reveal">
        <table class="aks-compare" aria-label="Сравнение решений контроля скриптов">
          <thead><tr><th>Критерий</th><th>Ручной QA</th><th>Oki-Toki</th><th>Rechka.ai</th><th>Bitrix CoPilot</th><th>Gong</th><th>Nero Network</th></tr></thead>
          <tbody>
            <tr><td>Охват</td><td>2–5%</td><td>Высокий</td><td>Высокий</td><td>Средний</td><td>Высокий</td><td class="aks-good">До 100%</td></tr>
            <tr><td>LLM-смысл</td><td>Человек</td><td>Нет</td><td>Да</td><td>Частично</td><td>Да</td><td class="aks-good">Да</td></tr>
            <tr><td>Омниканал</td><td>Да</td><td>Звонки</td><td>Звонки</td><td>B24</td><td>Звонки</td><td class="aks-good">Звонки+чаты</td></tr>
            <tr><td>Под ключ</td><td>—</td><td>Нет</td><td>Частично</td><td>Встроен</td><td>Нет</td><td class="aks-good">Да</td></tr>
            <tr><td>152-ФЗ</td><td>—</td><td>РФ</td><td>РФ</td><td>РФ</td><td>Зарубеж</td><td class="aks-good">РФ</td></tr>
            <tr><td>Цена (ориентир)</td><td>FTE 80–120к/мес</td><td>Телефония+QA</td><td>от 60к</td><td>В B24</td><td>$20k+/год</td><td class="aks-good">200–650к ₽</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aks-section aks-section-alt" id="itog">
    <div class="aks-cnt">
      <div class="aks-sh">
        <span class="aks-eyebrow">Итог</span>
        <h2>100% диалогов с объективным рейтингом нарушений</h2>
      </div>
      <div class="aks-card nero-ai-reveal">
        <p><strong>Ai контроль скриптов</strong> переводит контроль качества из режима «2–5% на глаз» в режим 100% диалогов. Nero Network внедряет под ключ: аудит → чек-лист → интеграция → пилот на 20 диалогах → дашборд РОПа → Process Mining.</p>
        <p>Омниканал, 152-ФЗ, калибровка AI, цитаты-доказательства — без «магического 100%» и без армии супервайзеров. <strong>Проверьте 20 диалогов бесплатно</strong> — получите пример отчёта и поймёте, где отдел теряет конверсию.</p>
      </div>
    </div>
  </section>

<?php if ($ad_banner_url && $ad_banner_image) : ?>
  <div class="aks-ad-banner-wrap">
    <a href="<?php echo esc_url($ad_banner_url); ?>" target="_blank" rel="noopener noreferrer">
      <img src="<?php echo esc_url($ad_banner_image); ?>" width="970" height="90" alt="<?php echo esc_attr($ad_banner_alt); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;">
    </a>
  </div>
<?php endif; ?>

</div><!-- /.aks-content -->

<!-- SCHEMA-MARKUP:INSERT -->

<script>
(function(){
  document.querySelectorAll('.aks-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aks-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aks-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aks-faq-q');
        if (q) q.setAttribute('aria-expanded','false');
      });
      if (!isOpen) {
        item.classList.add('open');
        btn.setAttribute('aria-expanded','true');
      }
    });
    btn.addEventListener('keydown', function(e){
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
    });
  });
})();
</script>


</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

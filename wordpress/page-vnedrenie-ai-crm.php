<?php
/**
 * Template Name: Внедрение AI в CRM под ключ
 * Description: SEO-лендинг — интеграция AI с amoCRM, Битрикс24, RetailCRM. Анализ сделок, контроль заполнения, кейсы.
 */

$page_seo_title       = 'Внедрение AI в CRM под ключ — интеграция и контроль сделок';
$page_seo_description = 'Внедряем AI в CRM под ключ: анализ сделок, подсказки менеджеру и контроль заполнения в amoCRM, Битрикс24, RetailCRM. Кейсы, цены, бесплатный CRM-аудит.';

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
    ['label' => 'Задачи', 'href' => '#zadachi'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integraciya'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Подключить AI к CRM';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
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

.ym-link{color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px;}
.ym-link--accent{color:var(--vna-accent);font-weight:600;}
.ym-cta-block--secondary{text-align:left;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-bottom:0;}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-crm-page" role="main" tabindex="-1">

<style>
/* ── Hero vnedrenie-ai-crm: самодостаточные стили (без CSS темы) ── */
.vnaic-hero-crm {
  --vnaic-cyan: #79f2ff;
  --vnaic-violet: #8b5cf6;
  --vnaic-green: #22c55e;
  --vnaic-amber: #fbbf24;
  --vnaic-text: #e6edf7;
  --vnaic-muted: #9aa8bd;
  --vnaic-soft: #c7d2e5;
  --vnaic-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnaic-hero-crm.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnaic-hero-crm::before {
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
.vnaic-hero-crm::after {
  content: "";
  position: absolute;
  right: -8%;
  top: 10%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(8px);
  animation: vnaicHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnaicHeroGlow {
  from { opacity: .4; transform: scale(.94); }
  to { opacity: .82; transform: scale(1.05); }
}
.vnaic-hero-crm .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnaic-hero-crm .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnaic-hero-crm .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.vnaic-hero-crm .nero-ai-gradient-text {
  display: block;
  margin-top: .12em;
  background: linear-gradient(92deg, #fff 0%, var(--vnaic-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnaic-hero-crm .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.06);
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  color: var(--vnaic-cyan);
}
.vnaic-hero-crm .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--vnaic-soft) !important;
  font-size: clamp(16px, 1.8vw, 20px);
  line-height: 1.58;
}
.vnaic-hero-crm .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnaic-hero-crm .nero-ai-badge {
  padding: 8px 14px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.12);
  background: rgba(255,255,255,.05);
  font-size: 13px;
  font-weight: 600;
  color: var(--vnaic-muted);
}
.vnaic-hero-crm .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 30px;
}
.vnaic-hero-crm .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 22px;
  border-radius: 999px;
  font-size: 14px;
  font-weight: 700;
  text-decoration: none;
  transition: transform .2s ease, box-shadow .2s ease;
}
.vnaic-hero-crm .nero-ai-btn-primary {
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  color: #fff !important;
  box-shadow: 0 12px 32px rgba(37, 99, 235, .35);
}
.vnaic-hero-crm .nero-ai-btn-secondary {
  border: 1px solid rgba(255,255,255,.18);
  background: rgba(255,255,255,.04);
  color: var(--vnaic-text) !important;
}
.vnaic-hero-crm .nero-ai-btn:hover { transform: translateY(-2px); }
.vnaic-hero-crm .nero-ai-dashboard {
  transform: perspective(1200px) rotateY(-4deg);
}
.vnaic-hero-crm .nero-ai-dashboard-shell {
  border-radius: 20px;
  border: 1px solid rgba(255,255,255,.12);
  background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.03));
  box-shadow: var(--vnaic-shadow);
  overflow: hidden;
  backdrop-filter: blur(12px);
}
.vnaic-hero-crm .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(0,0,0,.22);
}
.vnaic-hero-crm .nero-ai-dots { display: flex; gap: 6px; }
.vnaic-hero-crm .nero-ai-dot {
  width: 10px; height: 10px; border-radius: 50%;
  background: rgba(255,255,255,.18);
}
.vnaic-hero-crm .nero-ai-window-title {
  font-size: 11px;
  color: var(--vnaic-muted);
  letter-spacing: .02em;
}
.vnaic-hero-crm .nero-ai-window-body { padding: 16px; }
.vnaic-hero-crm .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.vnaic-hero-crm .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 15px;
  font-weight: 800;
  color: #fff;
  letter-spacing: -.02em;
}
.vnaic-hero-crm .nero-ai-live-pill {
  padding: 4px 10px;
  border-radius: 999px;
  background: rgba(34, 197, 94, .14);
  border: 1px solid rgba(34, 197, 94, .35);
  font-size: 11px;
  font-weight: 700;
  color: var(--vnaic-green);
}
.vnaic-hero-crm .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnaic-hero-crm .nero-ai-metric {
  padding: 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(0,0,0,.22);
}
.vnaic-hero-crm .nero-ai-metric span {
  display: block;
  font-size: 11px;
  color: var(--vnaic-muted);
  margin-bottom: 4px;
}
.vnaic-hero-crm .nero-ai-metric strong {
  display: block;
  font-size: 22px;
  line-height: 1;
  color: #fff;
  letter-spacing: -.03em;
}
.vnaic-hero-crm .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  font-size: 10px;
  color: var(--vnaic-muted);
}
.vnaic-hero-crm .vnaic-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin: 0 0 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: radial-gradient(circle at 50% 42%, rgba(121,242,255,.08), rgba(0,0,0,.35));
  overflow: hidden;
}
.vnaic-hero-crm #vnaic-crm-discipline-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
}
.vnaic-hero-crm .nero-ai-task-stream { display: grid; gap: 8px; }
.vnaic-hero-crm .nero-ai-task {
  display: grid;
  grid-template-columns: auto 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,.07);
  background: rgba(0,0,0,.18);
}
.vnaic-hero-crm .nero-ai-task-icon {
  width: 30px; height: 30px;
  display: grid; place-items: center;
  border-radius: 8px;
  background: rgba(121,242,255,.12);
  font-size: 11px;
  font-weight: 800;
  color: var(--vnaic-cyan);
}
.vnaic-hero-crm .nero-ai-task strong {
  display: block;
  font-size: 12.5px;
  color: #fff;
}
.vnaic-hero-crm .nero-ai-task span {
  display: block;
  font-size: 11px;
  color: var(--vnaic-muted);
}
.vnaic-hero-crm .nero-ai-status {
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  color: var(--vnaic-green);
}
.vnaic-hero-crm .nero-ai-status--amber { color: var(--vnaic-amber); }
@media (max-width: 960px) {
  .vnaic-hero-crm .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnaic-hero-crm .nero-ai-dashboard { transform: none; }
}
</style>

<section class="nero-ai-hero vnaic-hero-crm" id="hero" aria-labelledby="vnaic-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai crm</p>
      <h1 id="vnaic-hero-title">Внедрение AI в CRM: <span class="nero-ai-gradient-text">интеграция, анализ сделок и контроль заполнения под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI анализирует сделки, подсказывает следующий шаг менеджеру и следит за качеством данных в amoCRM, Битрикс24, RetailCRM и вашей CRM</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Анализ сделок</li>
        <li class="nero-ai-badge">Next-best-action</li>
        <li class="nero-ai-badge">Контроль полей</li>
        <li class="nero-ai-badge">amoCRM · B24 · RetailCRM</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Подключить AI к CRM'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Этапы внедрения</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация дисциплины данных в CRM">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>CRM · дисциплина данных</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Заполнено</span><strong>78%</strong><small>обязательных полей</small></div>
            <div class="nero-ai-metric"><span>Next step</span><strong>12</strong><small>подсказок сегодня</small></div>
            <div class="nero-ai-metric"><span>Сделок AI</span><strong>156</strong><small>в контуре CRM</small></div>
            <div class="nero-ai-metric"><span>Прогноз</span><strong>−18%</strong><small>отклонение*</small></div>
          </div>

          <div class="vnaic-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnaic-crm-discipline-canvas" role="img" aria-label="Анимация: коммуникации стекаются к карточке сделки, AI заполняет поля и выдаёт next-best-action"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий CRM">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📞</span>
              <div><strong>Звонок · 14:32</strong><span>Бюджет и сроки извлечены из транскрипта</span></div>
              <span class="nero-ai-status">поля</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Поля карточки обновлены</strong><span>Бюджет · ЛПР · возражения</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Задача менеджеру</strong><span>Перезвонить завтра 10:00</span></div>
              <span class="nero-ai-status">новое</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ROP</span>
              <div><strong>Дисциплина +12%</strong><span>РОП видит сделки без next step</span></div>
              <span class="nero-ai-status nero-ai-status--amber">дашборд</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="vna-content">

  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai crm</p>
          <p><strong>Коротко:</strong> AI-интеграция с CRM — связка вашей CRM (amoCRM, Битрикс24, RetailCRM или собственной системы) с LLM-агентом и автоматизацией через API/webhook. Система анализирует сделки, подсказывает менеджеру следующий шаг и контролирует качество заполнения карточек.</p>
          <p>CRM покупают ради воронки, прогноза и дисциплины отдела продаж. На практике карточки заполняются наполовину, задачи не ставятся, а РОП узнаёт о проблеме, когда сделка уже «умерла». Внедрение AI в CRM закрывает этот разрыв: не чат-бот на сайте, а <strong>второй пилот менеджера</strong> внутри вашей воронки.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="5 признаков, что CRM врёт">
          <div class="vna-kpi-card"><div class="kv">1</div><div class="kl">Пустые обязательные поля</div><div class="ks">бюджет, ЛПР, сроки</div></div>
          <div class="vna-kpi-card"><div class="kv">2</div><div class="kl">Нет задач после контакта</div><div class="ks">тишина в timeline</div></div>
          <div class="vna-kpi-card"><div class="kv">3</div><div class="kl">Этап не менялся N дней</div><div class="ks">сделка «висит»</div></div>
          <div class="vna-kpi-card"><div class="kv">4</div><div class="kl">Источник и UTM потеряны</div><div class="ks">ROI канала не считается</div></div>
        </div>
      </div>
      <p class="vna-intro-foot nero-ai-reveal" style="margin-top:20px;font-size:14px;color:var(--vna-muted);text-align:left;padding-left:20px;border-left:3px solid var(--vna-accent);">Пятый признак: прогноз скачет — РОП закрывает квартал «на глаз», потому что воронка не отражает реальность.</p>
    </div>
  </section>

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zachem-ai-crm">Зачем AI в CRM</a>
        <a href="#zadachi">Задачи</a>
        <a href="#etapy">Этапы</a>
        <a href="#integraciya">Интеграции</a>
        <a href="#kontrol">Контроль полей</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#podklyuchit">Подключить</a>
      </nav>
    </div>
  </div>

  <p class="vna-related nero-ai-reveal" style="margin:0 auto clamp(28px,4vw,40px);max-width:820px;font-size:15px;color:var(--vna-muted);text-align:center;line-height:1.72;">Эта посадочная охватывает <strong>любую CRM</strong> — amoCRM, Битрикс24, RetailCRM и кастомные системы. Если вы работаете только в amoCRM, начните с узкого материала: <a href="/vnedrenie-ai-amocrm/" class="ym-link ym-link--accent">внедрение AI-агента в amoCRM под ключ</a>.</p>

  <section class="vna-section" id="zachem-ai-crm">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Контекст 2026</span>
        <h2>Зачем бизнесу AI в CRM в 2026 году</h2>
        <p><strong>AI CRM</strong> — проектная интеграция искусственного интеллекта с системой управления сделками: чтение коммуникаций, автозаполнение полей, next-best-action и контроль дисциплины.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <h3 style="font-size:19px;margin-bottom:12px;">Почему CRM без AI теряет сделки и искажает аналитику</h3>
        <p>По данным аудита B2B-компаний в России, <strong>30–50% полей</strong> в CRM не заполняются или заполнены «мусором» — в <strong>15 из 18</strong> проверенных компаний (b2bprofit.ru, 2026). Международные исследования подтверждают масштаб: <strong>80%</strong> компаний признают неточность данных в CRM, <strong>40%</strong> записей устаревает ежегодно (Landbase / WinPure, 2026).</p>
        <p>Рынок CRM в России превысил <strong>32 млрд ₽</strong> в 2024 году с ростом <strong>20–25% в год</strong> (METASAPIENS). Но только <strong>~27 из 100</strong> компаний активно пользуются купленной CRM уже через месяц после внедрения.</p>
        <p><strong>Искусственный интеллект для CRM</strong> не заменяет процессы. AI ускоряет дисциплину, когда регламент уже понятен: «Если 40% полей не заполняются — на новой CRM будет та же история» (b2bprofit.ru).</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">AI-агенты в enterprise-приложениях</h3>
          <p>Gartner прогнозирует: к концу <strong>2026 года 40% корпоративных приложений</strong> получат task-specific <strong>ai агентов</strong> — против менее <strong>5%</strong> в 2025-м. CRM — одно из первых полей боя: Salesforce Agentforce, HubSpot Breeze Agents, Microsoft Dynamics 365 Sales с MCP, Битрикс24 «Космос», amoCRM 2026 с Аммой. На корпоративном масштабе тот же тренд разобран в материале <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" class="ym-link ym-link--accent">KPMG и Claude: уроки AI для бизнеса</a> — цифровые шлюзы и managed-агенты для тысяч сотрудников.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Оговорка аналитиков</h3>
          <p><strong>Более 40% agentic AI-проектов</strong> могут быть отменены к концу <strong>2027</strong> из-за стоимости inference, неясного ROI и рисков (Gartner, 25.06.2025). Выигрывают проекты с <strong>узким пилотом</strong>, измеримыми метриками и human-in-the-loop.</p>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:28px;font-size:15px;color:var(--vna-soft);text-align:center;max-width:760px;margin-left:auto;margin-right:auto;"><strong>Итог:</strong> <strong>ai для бизнеса</strong> в CRM в 2026 — не хайп, а ответ на грязные данные и перегруженных менеджеров. Вопрос — <strong>как внедрить ai crm</strong> так, чтобы он работал с вашей воронкой, а не параллельно с ней.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="zadachi">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Функционал</span>
        <h2>Какие задачи решает AI-интеграция с CRM</h2>
        <p><strong>Ai решения для crm</strong> закрывают три слоя: <strong>анализ</strong>, <strong>действие</strong> и <strong>контроль</strong>. Ниже — сценарии, которые мы внедряем в Nero Network.</p>
      </div>

      <div class="vna-scenario nero-ai-reveal">
        <div class="vna-sc-icon" aria-hidden="true">📊</div>
        <div>
          <h3>Анализ сделок и next-best-action для менеджера</h3>
          <p>После звонка, чата или встречи AI расшифровывает коммуникацию, извлекает бюджет, сроки, ЛПР, возражения (BANT/MEDDIC), сравнивает с регламентом полей и предлагает <strong>next-best-action</strong>: «позвонить завтра», «отправить КП», «эскалировать РОПу».</p>
          <p>Кейс SalesAI: <strong>−60%</strong> времени на ручной ввод, <strong>−25%</strong> отклонение прогноза. Trigly + RetailCRM — подсказка по скидке при смене стадии сделки в Telegram.</p>
        </div>
      </div>

      <div class="vna-scenario nero-ai-reveal nero-ai-delay-1">
        <div class="vna-sc-icon" aria-hidden="true">✏️</div>
        <div>
          <h3>Автозаполнение полей и контроль дисциплины</h3>
          <p><strong>Нейросети для crm</strong> пишут в кастомные поля и notes, ставят задачи с дедлайном, тегируют сделки и проверяют чек-лист качества. Встроенный AI (CoPilot, RetailCRM AI) <strong>не знает ваш регламент</strong> — кастомная <strong>интеграция ai crm</strong> добавляет Rules Engine по этапам воронки.</p>
        </div>
      </div>

      <div class="vna-compare-wrap nero-ai-reveal" style="margin-top:32px;">
        <table class="vna-compare">
          <thead>
            <tr><th>Критерий</th><th>Чат-бот в мессенджере</th><th>AI-интеграция с CRM</th></tr>
          </thead>
          <tbody>
            <tr><td>Где работает</td><td class="vna-neutral">Канал общения с клиентом</td><td class="vna-good">Внутри воронки: карточка, задачи, этапы</td></tr>
            <tr><td>Главная цель</td><td class="vna-neutral">Ответить / квалифицировать лид</td><td class="vna-good">Качество данных + next-best-action</td></tr>
            <tr><td>Кто пользователь</td><td class="vna-neutral">Клиент</td><td class="vna-good">Менеджер, РОП, аналитик</td></tr>
            <tr><td>Контроль дисциплины</td><td class="vna-neutral">Нет</td><td class="vna-good">Пустые поля, просрочки, расхождение этапа</td></tr>
            <tr><td>Запись в CRM</td><td class="vna-neutral">Частичная</td><td class="vna-good">Поля, задачи, timeline, аудит-лог</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;font-size:15px;color:var(--vna-soft);"><strong>Итог:</strong> <strong>какие задачи решает ai crm</strong> — это не «ai менеджер 24/7 в чате», а <strong>прозрачная воронка</strong>, где каждый контакт превращается в структурированные данные и понятный следующий шаг. Для обработки входящей почты — отдельный кластер: <a href="/vnedrenie-ai-obrabotka-email-crm/" class="ym-link ym-link--accent">AI-обработка входящей почты в CRM под ключ</a>.</p>
    </div>
  </section>

<section id="vnedrenie-ai-crm-boris-block" class="vac-root" aria-label="Анимация: CRM утром после AI — заполненные поля и next-best-action на любой платформе">
<style>
/* === БОРИС: prefix vac-, scoped внутри #vnedrenie-ai-crm-boris-block === */
#vnedrenie-ai-crm-boris-block.vac-root{
  padding:56px 0 64px;
  background:#f0f4fb;
}
#vnedrenie-ai-crm-boris-block .vac-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-crm-boris-block .vac-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-ai-crm-boris-block .vac-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-crm-boris-block .vac-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-crm-boris-block .vac-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-crm-boris-block .vac-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#6366f1;
  margin:0 0 14px;
}
#vnedrenie-ai-crm-boris-block .vac-ey::before{
  content:'';
  width:18px;height:2px;
  background:#6366f1;
  border-radius:1px;
}
#vnedrenie-ai-crm-boris-block .vac-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-ai-crm-boris-block .vac-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-crm-boris-block .vac-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-crm-boris-block .vac-ic{
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
#vnedrenie-ai-crm-boris-block .vac-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnedrenie-ai-crm-boris-block .vac-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-crm-boris-block .vac-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-crm-boris-block .vac-pl-b{
  background:rgba(99,102,241,.08);
  color:#4338ca;
  border:1.5px solid rgba(99,102,241,.22);
}
#vnedrenie-ai-crm-boris-block .vac-pl-v{
  background:rgba(6,182,212,.08);
  color:#0e7490;
  border:1.5px solid rgba(6,182,212,.22);
}
#vnedrenie-ai-crm-boris-block .vac-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-crm-boris-block .vac-rgt{
  position:relative;
  background:linear-gradient(145deg,#f8fafc 0%,#eef2ff 48%,#f0f9ff 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-crm-boris-block .vac-rgt{min-height:380px;}
}
#vac-crm-morning-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="vac-cnt">
  <div class="vac-card">

    <div class="vac-lft">
      <span class="vac-ey">Результат в CRM</span>
      <h3 class="vac-h3">CRM утром: поля заполнены, next step у менеджера — на amoCRM, Битрикс24 или RetailCRM</h3>
      <ul class="vac-ul">
        <li><span class="vac-ic">☎</span>После звонка AI извлекает бюджет, ЛПР и договорённости в карточку</li>
        <li><span class="vac-ic">✓</span>Пустые обязательные поля подсвечиваются и дополняются из переписки</li>
        <li><span class="vac-ic">→</span>Next-best-action: «отправить КП», «перезвонить», «эскалация РОПу»</li>
        <li><span class="vac-ic">◎</span>Quality score растёт — РОП видит дисциплину без прослушивания всех звонков</li>
      </ul>
      <div class="vac-pills">
        <span class="vac-pl vac-pl-g">−60% ручного ввода</span>
        <span class="vac-pl vac-pl-b">4 CRM · 1 pipeline</span>
        <span class="vac-pl vac-pl-v">human-in-the-loop</span>
      </div>
      <p class="vac-foot">Дальше — этапы внедрения AI в CRM под ключ →</p>
    </div>

    <div class="vac-rgt">
      <canvas
        id="vac-crm-morning-canvas"
        aria-label="Анимация: после звонка AI заполняет поля сделки, предлагает следующий шаг и повышает quality score — amoCRM, Битрикс24, RetailCRM"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('vac-crm-morning-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

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
    ink:'#0f172a',
    muted:'#64748b',
    line:'#e2e8f0',
    card:'#ffffff',
    cardBdr:'#cbd5e1',
    ai:'#6366f1',
    aiGlow:'rgba(99,102,241,.18)',
    green:'#22c55e',
    greenBg:'rgba(34,197,94,.12)',
    cyan:'#0ea5e9',
    amber:'#f59e0b',
    fieldEmpty:'#f1f5f9',
    fieldFill:'#eef2ff',
    fieldBdr:'#c7d2fe'
  };

  var CRMS = [
    {short:'amo',  label:'amoCRM',    accent:'#3b82f6'},
    {short:'b24',  label:'Битрикс24', accent:'#06b6d4'},
    {short:'ret',  label:'RetailCRM', accent:'#8b5cf6'},
    {short:'cus',  label:'Custom API',accent:'#6366f1'}
  ];

  var FIELDS = [
    {key:'budget', label:'Бюджет',     value:'500 000 ₽', delay:90},
    {key:'lpr',    label:'ЛПР',        value:'Иванов А.С.', delay:150},
    {key:'step',   label:'След. шаг',  value:'Отправить КП', delay:210},
    {key:'task',   label:'Задача',     value:'Перезвон 22.06', delay:270}
  ];

  var LOOP = 640;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawTabs(activeIdx){
    var tabW = Math.min(88, (W - 48) / CRMS.length - 6);
    var startX = 16;
    var y = 14;
    CRMS.forEach(function(crm, i){
      var x = startX + i * (tabW + 6);
      var active = i === activeIdx;
      rr(x, y, tabW, 26, 8, active ? crm.accent : '#fff', active ? null : C.line, 1);
      ctx.fillStyle = active ? '#fff' : C.muted;
      ctx.font = (active ? 'bold ' : '') + '10px Inter,system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(crm.short, x + tabW/2, y + 17);
    });
    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,system-ui,sans-serif';
    ctx.textAlign = 'right';
    ctx.fillText(CRMS[activeIdx].label + ' · quality', W - 16, 28);
  }

  function drawEventStrip(loopFr){
    var y = 52;
    rr(16, y, W - 32, 32, 10, C.fieldFill, C.fieldBdr, 1);
    var pulse = 0.5 + 0.5 * Math.sin(frame * 0.08);
    ctx.fillStyle = C.ai;
    ctx.font = 'bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    var evt = loopFr < 70 ? '☎ Звонок завершён · 4:12' :
              loopFr < 130 ? '◎ AI анализирует транскрипт…' :
              '✓ Поля и задача готовы к подтверждению';
    ctx.fillText(evt, 28, y + 20);
    if(loopFr >= 70 && loopFr < 130){
      rr(W - 52, y + 8, 36, 16, 8, C.aiGlow, null, 0);
      ctx.fillStyle = C.ai;
      ctx.font = 'bold 9px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('AI', W - 34, y + 19);
      ctx.globalAlpha = pulse * 0.35;
      rr(W - 58, y + 4, 48, 24, 10, C.aiGlow, null, 0);
      ctx.globalAlpha = 1;
    }
  }

  function drawDealCard(loopFr){
    var cx = 16, cy = 96, cw = W - 32, ch = H - cy - 72;
    rr(cx, cy, cw, ch, 14, C.card, C.cardBdr, 1.5);

    ctx.fillStyle = C.ink;
    ctx.font = 'bold 13px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Сделка #1847 · ООО «Прогресс»', cx + 16, cy + 26);

    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.fillText('Этап: Согласование условий', cx + 16, cy + 42);

    var fy = cy + 56;
    var fh = 36;
    var gap = 8;
    FIELDS.forEach(function(f){
      var filled = loopFr >= f.delay;
      var prog = filled ? 1 : Math.max(0, (loopFr - f.delay + 20) / 25);
      rr(cx + 12, fy, cw - 24, fh, 8, filled ? C.fieldFill : C.fieldEmpty, filled ? C.fieldBdr : C.line, 1);
      ctx.fillStyle = C.muted;
      ctx.font = '9px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(f.label, cx + 20, fy + 14);
      if(prog > 0){
        ctx.fillStyle = C.ink;
        ctx.font = 'bold 11px Inter,sans-serif';
        var txt = f.value;
        if(!filled && prog < 1){
          var len = Math.floor(txt.length * prog);
          txt = txt.slice(0, len) + (len < txt.length ? '…' : '');
        }
        ctx.fillText(txt, cx + 20, fy + 28);
      } else {
        ctx.fillStyle = '#94a3b8';
        ctx.font = '10px Inter,sans-serif';
        ctx.fillText('— пусто —', cx + 20, fy + 28);
      }
      fy += fh + gap;
    });
  }

  function drawNba(loopFr){
    if(loopFr < 300) return;
    var alpha = Math.min(1, (loopFr - 300) / 40);
    var bob = Math.sin(frame * 0.06) * 3;
    var bx = W - 168, by = H - 118 + bob;
    ctx.globalAlpha = alpha;
    rr(bx, by, 152, 44, 12, C.ai, null, 0);
    ctx.fillStyle = '#fff';
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Next-best-action', bx + 12, by + 16);
    ctx.font = '11px Inter,sans-serif';
    ctx.fillText('Отправить КП до пятницы', bx + 12, by + 32);
    ctx.globalAlpha = 1;
  }

  function drawQuality(loopFr){
    var qy = H - 52;
    var pct = loopFr < 330 ? 42 : 42 + Math.min(36, (loopFr - 330) * 0.45);
    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Quality score', 16, qy);
    var barX = 100, barW = W - 180;
    rr(barX, qy - 10, barW, 10, 5, C.fieldEmpty, C.line, 1);
    var fillW = barW * (pct / 100);
    if(fillW > 0) rr(barX, qy - 10, fillW, 10, 5, C.green, null, 0);
    ctx.fillStyle = C.green;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.textAlign = 'right';
    ctx.fillText(Math.round(pct) + '%', W - 16, qy);
  }

  function loop(){
    frame++;
    var loopFr = frame % LOOP;
    ctx.clearRect(0, 0, W, H);

    var tabIdx = Math.floor(loopFr / 160) % CRMS.length;
    drawTabs(tabIdx);
    drawEventStrip(loopFr);
    drawDealCard(loopFr);
    drawNba(loopFr);
    drawQuality(loopFr);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>

  <section class="vna-section" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Методология</span>
        <h2>Внедрение AI в CRM под ключ: этапы, сроки, роли</h2>
        <p><strong>Внедрение ai crm под ключ</strong> — проект от CRM-аудита до пилота с метриками. Типовой срок: <strong>2–6 недель</strong>. Ориентир чека: <strong>200 тыс.–1,5 млн ₽</strong>.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <h3 style="font-size:18px;margin-bottom:12px;">CRM-аудит под AI (лид-магнит)</h3>
        <ul>
          <li>Выгрузка <strong>50–100 сделок</strong> из вашей CRM</li>
          <li>Отчёт: % пустых полей, просроченные задачи, сделки без следующего шага</li>
          <li>Карта: какие поля AI заполняет автоматически, какие — только предлагает менеджеру</li>
        </ul>
        <p>Бесплатный вход в проект — без аудита любая цифра по <strong>сколько стоит ai crm</strong> будет гаданием.</p>
      </div>

      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-table">
          <thead><tr><th>Этап</th><th>Срок</th><th>Что делаем</th></tr></thead>
          <tbody>
            <tr><td>Аудит и карта полей</td><td>3–5 дней</td><td>Регламент, эталонные карточки, схема воронки</td></tr>
            <tr><td>Интеграционный слой</td><td>5–10 дней</td><td>Webhooks, n8n/Make, LLM-сервис, CRM Writer</td></tr>
            <tr><td>Пилот на 1 отделе / 1 воронке</td><td>2–4 недели</td><td>1–2 сценария: пост-звонок, квалификация лида</td></tr>
            <tr><td>Обучение и донастройка</td><td>3–5 дней</td><td>Менеджеры, РОП, правки промптов</td></tr>
            <tr><td>Масштабирование</td><td>по плану</td><td>Новые воронки, CRM, каналы</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Human-in-the-loop</h3>
          <p><strong>Сразу (низкий риск):</strong> теги, черновики комментариев, задачи с дедлайном, напоминания о пустых полях.</p>
          <p><strong>С подтверждением:</strong> смена этапа, запись бюджета, отправка писем клиенту. Каждое действие AI — в <strong>аудит-логе</strong>.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">152-ФЗ и роли</h3>
          <p>Контур в РФ: <strong>n8n self-hosted</strong>, YandexGPT или GigaChat. <strong>Менеджер</strong> подтверждает автозаполнение, <strong>РОП</strong> видит дашборд дисциплины, <strong>IT</strong> — API и мониторинг, <strong>собственник</strong> — прогноз из чистых данных.</p>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации до старта пилота?</p>
          <p class="ym-cta-block__sub">Если команда хочет понимать n8n, промпты и human-in-the-loop до CRM-аудита — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование сценариев с РОПом и IT.</p>
        </div>
      </aside>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-audit">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получить CRM-аудит под AI — бесплатно</p>
        <p class="ym-cta-block__sub">Выгрузим 50–100 сделок, покажем % пустых полей, сделки без следующего шага и карту полей для автоматизации. Без обязательств — первый шаг к внедрению под ключ.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Подключить AI к CRM'); ?></a>
      </div>
    </div>
  </div>

  <section class="vna-section vna-section-alt" id="integraciya">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Стек</span>
        <h2>Интеграция AI с amoCRM, Битрикс24, RetailCRM и собственной CRM</h2>
        <p><strong>Интеграция ai crm</strong> строится на единой логике: событие в CRM → normalize-слой → LLM → обратная запись.</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">amoCRM</h3>
          <p>OAuth2, REST API v4, webhooks. В 2026 — встроенные <strong>AI-агенты</strong> и ассистент <strong>Амма</strong>, интеграция с MAX.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Битрикс24</h3>
          <p>REST API, <code>event.bind</code>, <strong>CoPilot/BitrixGPT</strong>, конструктор AI-агентов, <strong>MCP Hub</strong> для управления CRM из Cursor, ChatGPT, n8n.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">RetailCRM</h3>
          <p>API-ключ, webhooks, модуль «AI-инструменты и боты» — транскрипция, автотеги, оценка менеджеров.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Кастомная CRM</h3>
          <p>REST + webhooks; normalize-слой приводит все системы к единому JSON (телефон E.164, UTM, id сделки).</p>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:17px;margin-bottom:12px;">Типовой pipeline Nero Network</h3>
        <pre style="background:rgba(0,0,0,.35);border:1px solid rgba(121,242,255,.2);border-radius:14px;padding:18px 20px;font-size:13px;line-height:1.6;color:var(--vna-accent);overflow-x:auto;margin:0;">Событие CRM → webhook → n8n/Make → LLM (классификация + извлечение) → Rules Engine → CRM Writer → Dashboard</pre>
        <p style="margin-top:14px;">Кейс Wildbots: единый pipeline для <strong>Bitrix24 и amoCRM</strong> через n8n — до внедрения менеджеры тратили до <strong>30% времени</strong> на переключение между CRM. <strong>MCP</strong> становится стандартом: «USB-C для AI».</p>
        <p style="margin-top:14px;">Когда сделка из CRM уходит в учётный контур — заказ, отгрузка, оплата — смотрите смежный сценарий: <a href="/ai-1c-erp/" class="ym-link ym-link--accent">AI-агент для 1С и ERP под ключ</a>. Здесь фокус на воронке и дисциплине карточек; ERP-контур — отдельная посадочная.</p>
      </div>

      <div class="vna-compare-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-compare">
          <thead>
            <tr><th>Параметр</th><th>Встроенный AI</th><th>Кастомная интеграция Nero Network</th></tr>
          </thead>
          <tbody>
            <tr><td>Срок запуска</td><td>Часы–дни</td><td class="vna-good">2–6 недель</td></tr>
            <tr><td>Регламент ваших полей</td><td>Общий</td><td class="vna-good">Под вашу воронку</td></tr>
            <tr><td>Multi-CRM</td><td>Нет</td><td class="vna-good">Да (normalize-слой)</td></tr>
            <tr><td>Аудит-лог решений AI</td><td>Ограничен</td><td class="vna-good">Полный</td></tr>
            <tr><td>152-ФЗ / контур РФ</td><td>Зависит от тарифа</td><td class="vna-good">n8n on-prem, YandexGPT/GigaChat</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;font-size:14px;color:var(--vna-muted);">Узкая посадочная <strong>только под amoCRM</strong> — в отдельном материале. <strong>Эта страница</strong> — кластер «любая CRM» с единой методологией.</p>
    </div>
  </section>

  <section class="vna-section" id="kontrol">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Дисциплина данных</span>
        <h2>Контроль качества заполнения CRM</h2>
        <p><strong>Контроль заполнения crm</strong> — система правил и метрик: AI снимает рутину и показывает РОПу реальную картину, а не «наказывает» менеджера.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <h3 style="font-size:18px;margin-bottom:12px;">Правила заполнения карточек и напоминания</h3>
        <p>На этапе внедрения фиксируем карту полей: что обязательно на каждом этапе, что AI заполняет автоматически, что — только на подтверждение, что запрещено менять без РОПа.</p>
        <p>AI при каждом событии сверяет карточку с регламентом: дописывает сущности из коммуникации, создаёт задачу «Заполнить бюджет», уведомляет РОПа при N дней без активности.</p>
      </div>

      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-table">
          <thead><tr><th>Метрика</th><th>До AI</th><th>Цель после пилота</th></tr></thead>
          <tbody>
            <tr><td>% пустых обязательных полей</td><td>30–50% (типично B2B)</td><td><strong>−40%</strong> и ниже</td></tr>
            <tr><td>Сделки без задачи после контакта</td><td>фиксируем базу</td><td><strong>−60%</strong></td></tr>
            <tr><td>Время менеджера на ввод после звонка</td><td>5–15 мин</td><td><strong>−50%</strong></td></tr>
            <tr><td>Отклонение прогноза от факта</td><td>фиксируем</td><td><strong>−25%</strong></td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:16px;font-size:14px;color:var(--vna-muted);">Точные проценты зависят от ниши — <strong>не обещаем фиксированный ROI без аудита</strong>.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="ceny">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Бюджет</span>
        <h2>Стоимость внедрения AI в CRM</h2>
        <p><strong>Ai crm цена</strong> зависит от числа CRM, сценариев, каналов и требований к контуру (облако РФ / on-prem).</p>
      </div>

      <div class="vna-pricing-grid nero-ai-reveal">
        <div class="vna-price-card">
          <div class="tier">Малый бизнес</div>
          <div class="amount">от 200–350 тыс. ₽</div>
          <div class="inc">1 CRM, 1–2 сценария: аудит, пилот пост-звонок, обучение</div>
        </div>
        <div class="vna-price-card vna-featured">
          <div class="tier">Средний бизнес</div>
          <div class="amount">400–800 тыс. ₽</div>
          <div class="inc">1–2 CRM, 3–5 сценариев: normalize-слой, дашборд, интеграции</div>
        </div>
        <div class="vna-price-card">
          <div class="tier">Multi-CRM + RAG</div>
          <div class="amount">800 тыс.–1,5 млн ₽</div>
          <div class="inc">Несколько отделов, полный контур, масштабирование</div>
        </div>
        <div class="vna-price-card">
          <div class="tier">Рынок РФ</div>
          <div class="amount">от 80 000 ₽</div>
          <div class="inc">Минимальный сценарий до 900 000+ ₽ за комплекс (ориентиры рынка)</div>
        </div>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Под ключ</h3>
          <p>Аудит, интеграция, пилот, обучение, документация в одном проекте — предсказуемый срок <strong>2–6 недель</strong>.</p>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Поэтапно</h3>
          <p>Сначала CRM-аудит и один сценарий, затем дополнительные воронки по метрикам. Чтобы <strong>заказать ai crm</strong> — достаточно заявки на аудит.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI CRM</h2>
      </div>

      <div class="vna-case-grid nero-ai-reveal">
        <div class="vna-case-card">
          <div class="vna-case-tag">SalesAI · Россия</div>
          <h3>Малый и средний бизнес</h3>
          <p>Нейросеть слушает звонки, заполняет amoCRM/Битрикс24/RetailCRM, создаёт задачи.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">−60%</span><span class="lbl">время на ввод</span></div>
            <div class="vna-metric"><span class="num">−25%</span><span class="lbl">отклонение прогноза</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Wildbots · n8n</div>
          <h3>Bitrix24 + amoCRM</h3>
          <p>GPT-агент: классификация лидов, черновик ответа, запись в обе CRM. Self-hosted в РФ, human-in-the-loop.</p>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Enterprise</div>
          <h3>Несколько CRM в контуре</h3>
          <p>Salesforce Agentforce, HubSpot Breeze — паттерн один: <strong>агент действует в CRM</strong>, а не только советует в чате.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;color:var(--vna-muted);font-size:14px;"><strong>Ai crm кейсы</strong> в вашей нише — часть CRM-аудита: подбираем сценарий, ближайший к вашей воронке.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Вопросы</span>
        <h2>FAQ: как внедрить AI в CRM без хаоса</h2>
      </div>

      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai crm, если нет программиста в штате?</div>
          <div class="vna-faq-a">
            <p><strong>Ai crm без программиста</strong> — реальность при <strong>внедрении под ключ</strong>: интегратор настраивает n8n/Make, webhooks и промпты. В Битрикс24 — конструктор AI-агентов без кода. Ваше участие: регламент полей и обратная связь на пилоте.</p>
          </div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Ai crm под ключ или самостоятельно?</div>
          <div class="vna-faq-a">
            <p>Самостоятельно — дешевле на старте, но риск галлюцинаций и «сломанной» воронки. Под ключ — предсказуемый срок 2–6 недель, human-in-the-loop, CRM-аудит → метрики до/после.</p>
          </div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает интеграция?</div>
          <div class="vna-faq-a">
            <p>Типовой пилот: <strong>2–4 недели</strong> на одну воронку. Полный контур multi-CRM: <strong>4–6 недель</strong>. Первые результаты по заполняемости — часто на <strong>2-й неделе</strong> пилота.</p>
          </div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Что если уже есть CoPilot / Амма / RetailCRM AI?</div>
          <div class="vna-faq-a">
            <p>Встроенный AI не знает <strong>ваш регламент</strong> и не связывает <strong>несколько CRM</strong>. Мы настраиваем слой поверх API: ваши поля, этапы, аудит-лог. CoPilot остаётся для расшифровки — кастомный агент для дисциплины и next-best-action.</p>
          </div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Риски: галлюцинации, ПДн, качество исходных данных</div>
          <div class="vna-faq-a">
            <p><strong>Галлюцинации:</strong> strict JSON schema, human-in-the-loop. <strong>ПДн:</strong> контур в РФ, YandexGPT/GigaChat, n8n on-prem. <strong>Garbage in — garbage out:</strong> аудит показывает это до старта. Gartner: &gt;40% отмен agentic AI к 2027 — лечится узким пилотом.</p>
          </div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Ai crm для малого бизнеса vs среднего бизнеса</div>
          <div class="vna-faq-a">
            <p><strong>Малый (3–7 менеджеров):</strong> один сценарий пост-звонок, одна CRM, от 200 тыс. ₽. <strong>Средний (10–50):</strong> несколько воронок, дашборд РОПа, 400–800 тыс. ₽. В обоих случаях стартуем с <strong>CRM-аудита</strong>.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section ym-cta-block ym-cta-block--footer-final" id="podklyuchit">
    <div class="vna-cnt" style="text-align:center;">
      <span class="vna-eyebrow">Коммерческий оффер</span>
      <h2 style="font-size:clamp(28px,4.2vw,48px);margin:14px auto 16px;max-width:760px;">Подключить AI к CRM</h2>
      <p style="max-width:620px;margin:0 auto 24px;font-size:16px;">AI анализирует сделки, подсказывает следующий шаг менеджеру и контролирует заполнение CRM — в amoCRM, Битрикс24, RetailCRM или вашей системе.</p>
      <ul class="vna-cta-checklist">
        <li>CRM-аудит под AI — бесплатно</li>
        <li>Пилот на одной воронке — 2–4 недели</li>
        <li>Интеграция под ключ — webhooks, n8n, human-in-the-loop</li>
        <li>Масштабирование по метрикам</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;"<?php echo $primary_cta_attrs; ?>>Подключить AI к CRM</a>
      <p style="margin-top:20px;font-size:14px;color:var(--vna-muted);max-width:680px;margin-left:auto;margin-right:auto;">Мы не продаём «чат-бота» — внедряем <strong>ai crm для бизнеса</strong>, где данные в воронке совпадают с реальностью.</p>
    </div>
  </section>

</div><!-- /.vna-content -->


<script>
(function () {
  var canvas = document.getElementById("vnaic-crm-discipline-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  var phase = 0;
  var phaseTimer = 0;
  var qualityRing = 0;
  var bubbles = [];

  var C = {
    outline: "#0f172a",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    amber: "#fbbf24",
    pink: "#ec4899",
    blue: "#3b82f6",
    yellow: "#eab308",
    purple: "#8b5cf6",
    cardBg: "rgba(255,255,255,.95)",
    muted: "#64748b"
  };

  var dialogs = [
    "Регламент полей на этапе «КП»",
    "Пустое поле «Бюджет» — подсказка",
    "amoCRM webhook принят",
    "Next step: позвонить завтра",
    "RetailCRM API — запись в карточку",
    "Human-in-the-loop: подтвердить бюджет"
  ];

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 240;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
    scale = Math.min(cw / 420, ch / 260) * 1.1;
  }

  function roundRect(x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fillStyle = fill;
    ctx.fill();
    if (stroke) {
      ctx.strokeStyle = stroke;
      ctx.lineWidth = 1.5;
      ctx.stroke();
    }
  }

  function createBubble(x, y, text, color) {
    bubbles.push({ x: x, y: y, text: text, life: 0, max: 140, color: color || C.cyan });
  }

  class DealIntegrityCore {
    constructor(x, y) { this.x = x; this.y = y; this.fill = 0.42; this.pulse = 0; }
    draw(ctx) {
      this.pulse += 0.04;
      var w = 92 * scale, h = 64 * scale;
      var x = this.x - w / 2, y = this.y - h / 2;
      roundRect(x, y, w, h, 10 * scale, C.cardBg, C.outline);
      ctx.fillStyle = C.muted;
      ctx.font = (9 * scale) + "px Inter, sans-serif";
      ctx.fillText("Сделка #1847", x + 10 * scale, y + 16 * scale);
      var barW = w - 20 * scale;
      roundRect(x + 10 * scale, y + 24 * scale, barW, 8 * scale, 4, "#e2e8f0");
      roundRect(x + 10 * scale, y + 24 * scale, barW * this.fill, 8 * scale, 4, C.green);
      ctx.fillStyle = C.outline;
      ctx.font = (8 * scale) + "px Inter, sans-serif";
      ctx.fillText("Заполнено " + Math.round(this.fill * 100) + "%", x + 10 * scale, y + 46 * scale);
      if (phase >= 3) {
        ctx.fillStyle = C.violet;
        ctx.font = (700) + " " + (8.5 * scale) + "px Inter, sans-serif";
        ctx.fillText("→ Позвонить завтра 10:00", x + 10 * scale, y + 58 * scale);
      }
      ctx.strokeStyle = C.cyan;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(this.x, this.y, 58 * scale + Math.sin(this.pulse) * 3, 0, Math.PI * 2 * qualityRing);
      ctx.stroke();
    }
  }

  class CommLinkArcs {
    constructor(x, y, r) {
      this.x = x; this.y = y; this.r = r;
      this.packets = [
        { angle: -2.1, t: 0, label: "📞", color: C.cyan },
        { angle: 0.4, t: 0.3, label: "💬", color: C.violet },
        { angle: 2.3, t: 0.6, label: "✉", color: C.amber }
      ];
    }
    draw(ctx) {
      var self = this;
      this.packets.forEach(function (p, i) {
        p.t = (p.t + 0.004 + i * 0.0005) % 1;
        var a = p.angle + Math.sin(frame * 0.02 + i) * 0.08;
        var startR = self.r * 1.35;
        var endR = self.r * 0.55;
        var rr = startR + (endR - startR) * p.t;
        var px = self.x + Math.cos(a) * rr;
        var py = self.y + Math.sin(a) * rr * 0.72;
        ctx.strokeStyle = "rgba(121,242,255,.18)";
        ctx.lineWidth = 1.5;
        ctx.beginPath();
        ctx.ellipse(self.x, self.y, startR, startR * 0.72, a, 0, Math.PI * 0.55);
        ctx.stroke();
        roundRect(px - 10 * scale, py - 8 * scale, 20 * scale, 16 * scale, 6, p.color, C.outline);
        ctx.fillStyle = "#fff";
        ctx.font = (10 * scale) + "px sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(p.label, px, py + 4 * scale);
        ctx.textAlign = "left";
      });
    }
  }

  class FieldGapScanner {
    constructor(x, y) { this.x = x; this.y = y; this.scan = 0; }
    draw(ctx) {
      this.scan = (this.scan + 0.03) % 1;
      roundRect(this.x - 28 * scale, this.y - 14 * scale, 56 * scale, 28 * scale, 8, "rgba(251,191,36,.15)", C.amber);
      ctx.fillStyle = C.amber;
      ctx.font = (8 * scale) + "px Inter, sans-serif";
      ctx.fillText("Пустые поля", this.x - 22 * scale, this.y + 3 * scale);
      ctx.strokeStyle = "rgba(251,191,36,.5)";
      ctx.beginPath();
      ctx.moveTo(this.x - 20 * scale, this.y + 8 * scale);
      ctx.lineTo(this.x - 20 * scale + 40 * scale * this.scan, this.y + 8 * scale);
      ctx.stroke();
    }
  }

  class PlatformBadgeRow {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(ctx) {
      var labels = ["amo", "B24", "Retail"];
      var px = this.x, py = this.y;
      labels.forEach(function (lb, i) {
        var bx = px - 48 * scale + i * 34 * scale;
        roundRect(bx, py - 10 * scale, 30 * scale, 18 * scale, 6, "rgba(139,92,246,.2)", C.violet);
        ctx.fillStyle = "#e9d5ff";
        ctx.font = (7 * scale) + "px Inter, sans-serif";
        ctx.fillText(lb, bx + 5 * scale, py + 2 * scale);
      });
    }
  }

  class Agent {
    constructor(role, color, tx, ty) {
      this.role = role;
      this.color = color;
      this.x = tx + (Math.random() - 0.5) * 40;
      this.y = ty + 40;
      this.tx = tx;
      this.ty = ty;
      this.dir = 1;
      this.bob = Math.random() * Math.PI * 2;
      this.bubbleCd = 80 + Math.random() * 120;
    }
    update() {
      this.x += (this.tx - this.x) * 0.04;
      this.y += (this.ty - this.y) * 0.04;
      this.bob += 0.06;
      this.bubbleCd--;
      if (this.bubbleCd <= 0) {
        createBubble(this.x, this.y - 22 * scale, dialogs[Math.floor(Math.random() * dialogs.length)], this.color);
        this.bubbleCd = 140 + Math.random() * 100;
      }
    }
    draw(ctx) {
      var s = 11 * scale;
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(this.x, this.y + Math.sin(this.bob) * 2, s, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1.5;
      ctx.stroke();
      ctx.fillStyle = "#fff";
      ctx.beginPath();
      ctx.arc(this.x + 3 * scale, this.y - 2 * scale, 2.5 * scale, 0, Math.PI * 2);
      ctx.fill();
    }
  }

  var core, arcs, scanner, badges, agents;

  function initScene() {
    core = new DealIntegrityCore(cx, cy);
    arcs = new CommLinkArcs(cx, cy, 70 * scale);
    scanner = new FieldGapScanner(cx - 95 * scale, cy + 52 * scale);
    badges = new PlatformBadgeRow(cx + 88 * scale, cy - 58 * scale);
    agents = [
      new Agent("1_architect", C.yellow, cx - 110 * scale, cy - 20 * scale),
      new Agent("2_analyst", C.green, cx + 105 * scale, cy - 10 * scale),
      new Agent("3_integrator", C.blue, cx - 95 * scale, cy + 45 * scale),
      new Agent("4_ux", C.pink, cx + 95 * scale, cy + 40 * scale),
      new Agent("5_deploy", C.purple, cx, cy + 78 * scale)
    ];
  }

  function updatePhases() {
    phaseTimer++;
    if (phase === 0 && phaseTimer > 90) { phase = 1; phaseTimer = 0; createBubble(cx, cy - 70 * scale, "Звонок → транскрипт в CRM", C.cyan); }
    if (phase === 1 && phaseTimer > 110) { phase = 2; phaseTimer = 0; core.fill = 0.62; createBubble(cx, cy - 50 * scale, "AI извлёк бюджет и ЛПР", C.green); }
    if (phase === 2 && phaseTimer > 110) { phase = 3; phaseTimer = 0; core.fill = 0.78; qualityRing = 0.85; createBubble(cx, cy - 30 * scale, "Поля проверены по регламенту", C.amber); }
    if (phase === 3 && phaseTimer > 130) { phase = 4; phaseTimer = 0; qualityRing = 1; createBubble(cx, cy, "Next-best-action для менеджера", C.violet); }
    if (phase === 4 && phaseTimer > 160) { phase = 0; phaseTimer = 0; core.fill = 0.42; qualityRing = 0; }
    qualityRing += (phase >= 3 ? 0.008 : -0.01);
    qualityRing = Math.max(0, Math.min(1, qualityRing));
  }

  function drawBubbles() {
    bubbles = bubbles.filter(function (b) {
      b.life++;
      b.y -= 0.35;
      var alpha = 1 - b.life / b.max;
      if (alpha <= 0) return false;
      ctx.globalAlpha = alpha;
      roundRect(b.x - 4, b.y - 12 * scale, Math.min(150 * scale, b.text.length * 5.2 * scale), 18 * scale, 8, "#fff", b.color);
      ctx.fillStyle = C.outline;
      ctx.font = (7.5 * scale) + "px Inter, sans-serif";
      ctx.fillText(b.text, b.x, b.y);
      ctx.globalAlpha = 1;
      return true;
    });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.fillStyle = "rgba(5,7,17,.15)";
    ctx.fillRect(0, 0, cw, ch);
    updatePhases();
    arcs.draw(ctx);
    scanner.draw(ctx);
    badges.draw(ctx);
    core.draw(ctx);
    agents.forEach(function (a) { a.update(); a.draw(ctx); });
    drawBubbles();
    requestAnimationFrame(engineLoop);
  }

  window.addEventListener("resize", function () { resizeCanvas(); initScene(); });
  resizeCanvas();
  initScene();
  createBubble(cx, cy - 80 * scale, "Диспетчерская дисциплины CRM", C.cyan);
  engineLoop();
})();
</script>

<!-- FAQ ACCORDION -->
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

<!-- REVEAL -->
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

<?php
$vnaic_page_url = trailingslashit( get_permalink() );
$vnaic_site_url = trailingslashit( home_url( '/' ) );
$vnaic_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$vnaic_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $vnaic_site_url . '#organization',
      'name'  => $vnaic_brand,
      'url'   => $vnaic_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $vnaic_site_url . '#website',
      'url'       => $vnaic_site_url,
      'name'      => $vnaic_brand,
      'publisher' => [ '@id' => $vnaic_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $vnaic_page_url . '#webpage',
      'url'         => $vnaic_page_url,
      'name'        => 'Внедрение AI в CRM: интеграция, анализ сделок и контроль заполнения под ключ',
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $vnaic_site_url . '#website' ],
      'about'       => [ '@id' => $vnaic_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $vnaic_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vnaic_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => 'Внедрение AI в CRM: интеграция, анализ сделок и контроль заполнения под ключ', 'item' => $vnaic_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $vnaic_page_url . '#service',
      'name'        => 'Внедрение AI в CRM: интеграция, анализ сделок и контроль заполнения под ключ',
      'description' => $page_seo_description,
      'url'         => $vnaic_page_url,
      'provider'    => [ '@id' => $vnaic_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $vnaic_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить ai crm, если нет программиста в штате?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ai crm без программиста — реальность при внедрении под ключ: интегратор настраивает n8n/Make, webhooks и промпты. В Битрикс24 — конструктор AI-агентов без кода. Ваше участие: регламент полей и обратная связь на пилоте.' ] ],
        [ '@type' => 'Question', 'name' => 'Ai crm под ключ или самостоятельно?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Самостоятельно — дешевле на старте, но риск галлюцинаций и «сломанной» воронки. Под ключ — предсказуемый срок 2–6 недель, human-in-the-loop, CRM-аудит → метрики до/после.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько времени занимает интеграция?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Типовой пилот: 2–4 недели на одну воронку. Полный контур multi-CRM: 4–6 недель. Первые результаты по заполняемости — часто на 2-й неделе пилота.' ] ],
        [ '@type' => 'Question', 'name' => 'Что если уже есть CoPilot / Амма / RetailCRM AI?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Встроенный AI не знает ваш регламент и не связывает несколько CRM. Мы настраиваем слой поверх API: ваши поля, этапы, аудит-лог. CoPilot остаётся для расшифровки — кастомный агент для дисциплины и next-best-action.' ] ],
        [ '@type' => 'Question', 'name' => 'Риски: галлюцинации, ПДн, качество исходных данных', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Галлюцинации: strict JSON schema, human-in-the-loop. ПДн: контур в РФ, YandexGPT/GigaChat, n8n on-prem. Garbage in — garbage out: аудит показывает это до старта. Gartner: >40% отмен agentic AI к 2027 — лечится узким пилотом.' ] ],
        [ '@type' => 'Question', 'name' => 'Ai crm для малого бизнеса vs среднего бизнеса', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Малый (3–7 менеджеров): один сценарий пост-звонок, одна CRM, от 200 тыс. ₽. Средний (10–50): несколько воронок, дашборд РОПа, 400–800 тыс. ₽. В обоих случаях стартуем с CRM-аудита.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vnaic_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>


<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

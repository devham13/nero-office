<?php
/**
 * Template Name: AI-обзвон клиентов: подтверждение записей и напоминания под ключ
 * Description: SEO-лендинг — внедрение AI-обзвона клиентов. Калькулятор потерь от неявок, кейсы, интеграции CRM.
 */

$page_seo_title       = 'AI-обзвон клиентов под ключ — подтверждение записей';
$page_seo_description = 'Внедрение AI-обзвона клиентов: голосовой бот подтверждает запись, напоминает о визите и переносит время без менеджера. Калькулятор потерь от неявок для клиник, школ и сервисов.';

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
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Снизить неявки';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#cta';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Материалы по AI';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#';

$nero_ai_header_links = [
    ['label' => 'Проблема',     'href' => '#pochemu-nevyavki'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Калькулятор',  'href' => '#kalkulyator-nevyavok'],
    ['label' => 'Сценарии',     'href' => '#scenarii'],
    ['label' => 'Внедрение',    'href' => '#vnedrenie'],
    ['label' => 'FAQ',          'href' => '#faq'],
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

.vna-card--soft{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.08);}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-obzvon-klientov-page" role="main" tabindex="-1">

<style>
/* Hero ai-obzvon-klientov — самодостаточный блок первого экрана */
.ai-obzvon-klientov-page {
  --nero-ai-bg: #060812;
  --nero-ai-text: #e6edf7;
  --nero-ai-muted: #9aa8bd;
  --nero-ai-soft: #c7d2e5;
  --nero-ai-heading: #ffffff;
  --nero-ai-border: rgba(255, 255, 255, 0.12);
  --nero-ai-primary: #79f2ff;
  --nero-ai-accent: #22c55e;
  --nero-ai-warn: #f59e0b;
  --nero-ai-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  --nero-ai-container: 1220px;
}

.ai-obzvon-klientov-page .nero-ai-hero {
  position: relative;
  min-height: min(920px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(88px, 11vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background:
    radial-gradient(circle at 14% 8%, rgba(121, 242, 255, 0.16), transparent 28rem),
    radial-gradient(circle at 88% 14%, rgba(139, 92, 246, 0.18), transparent 32rem),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}

.ai-obzvon-klientov-page .nero-ai-hero::before {
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

.ai-obzvon-klientov-page .nero-ai-hero::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 14%;
  width: 760px;
  height: 760px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(34, 197, 94, .10), transparent 66%);
  filter: blur(8px);
  animation: obzvonHeroGlow 8s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}

@keyframes obzvonHeroGlow {
  from { opacity: .4; transform: translateX(-50%) scale(.96); }
  to   { opacity: .82; transform: translateX(-50%) scale(1.05); }
}

.ai-obzvon-klientov-page .nero-ai-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.ai-obzvon-klientov-page .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(320px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}

.ai-obzvon-klientov-page .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--nero-ai-primary) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}

.ai-obzvon-klientov-page .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 6.2vw, 72px);
  line-height: .92;
  letter-spacing: -0.06em;
  color: var(--nero-ai-heading);
}

.ai-obzvon-klientov-page .nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, var(--nero-ai-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}

.ai-obzvon-klientov-page .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--nero-ai-soft) !important;
  font-size: clamp(17px, 2vw, 21px);
  line-height: 1.58;
}

.ai-obzvon-klientov-page .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}

.ai-obzvon-klientov-page .nero-ai-badge {
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

.ai-obzvon-klientov-page .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}

.ai-obzvon-klientov-page .nero-ai-btn {
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
  text-decoration: none !important;
  transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
}

.ai-obzvon-klientov-page .nero-ai-btn:hover,
.ai-obzvon-klientov-page .nero-ai-btn:focus-visible {
  transform: translateY(-2px);
}

.ai-obzvon-klientov-page .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--nero-ai-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}

.ai-obzvon-klientov-page .nero-ai-btn-secondary {
  color: var(--nero-ai-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}

.ai-obzvon-klientov-page .nero-ai-btn-secondary:hover {
  border-color: rgba(121, 242, 255, 0.36);
  background: rgba(121, 242, 255, 0.08);
}

.ai-obzvon-klientov-page .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--nero-ai-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}

.ai-obzvon-klientov-page .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}

.ai-obzvon-klientov-page .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}

.ai-obzvon-klientov-page .nero-ai-dots { display: flex; gap: 7px; }
.ai-obzvon-klientov-page .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.ai-obzvon-klientov-page .nero-ai-dot:nth-child(1) { background: #fb7185; }
.ai-obzvon-klientov-page .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.ai-obzvon-klientov-page .nero-ai-dot:nth-child(3) { background: #34d399; }

.ai-obzvon-klientov-page .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}

.ai-obzvon-klientov-page .nero-ai-window-body { padding: 18px; }

.ai-obzvon-klientov-page .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
}

.ai-obzvon-klientov-page .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -0.03em;
  color: var(--nero-ai-heading);
}

.ai-obzvon-klientov-page .nero-ai-live-pill {
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

.ai-obzvon-klientov-page .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: obzvonPulse 1.6s infinite;
}

@keyframes obzvonPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}

.ai-obzvon-klientov-page .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}

.ai-obzvon-klientov-page .nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease;
}

.ai-obzvon-klientov-page .nero-ai-metric:hover {
  transform: translateY(-3px);
  border-color: rgba(121,242,255,.34);
}

.ai-obzvon-klientov-page .nero-ai-metric span {
  display: block;
  color: var(--nero-ai-muted);
  font-size: 12px;
  font-weight: 700;
}

.ai-obzvon-klientov-page .nero-ai-metric strong {
  display: block;
  margin-top: 7px;
  color: #fff;
  font-size: 24px;
  line-height: 1;
}

.ai-obzvon-klientov-page .nero-ai-metric small {
  display: block;
  margin-top: 6px;
  color: #9fb0c9;
  font-size: 11px;
}

.ai-obzvon-klientov-page .nero-ai-metric--accent strong { color: #86efac; }

.ai-obzvon-klientov-page #obzvon-hero-wave {
  display: block;
  width: 100%;
  height: 56px;
  margin: 14px 0 4px;
  border-radius: 14px;
  background: rgba(255,255,255,.03);
  border: 1px solid rgba(255,255,255,.06);
}

.ai-obzvon-klientov-page .nero-ai-task-stream {
  margin-top: 12px;
  display: grid;
  gap: 10px;
}

.ai-obzvon-klientov-page .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
  animation: obzvonTaskFloat 5s ease-in-out infinite;
}

.ai-obzvon-klientov-page .nero-ai-task:nth-child(2) { animation-delay: .6s; }
.ai-obzvon-klientov-page .nero-ai-task:nth-child(3) { animation-delay: 1.2s; }

@keyframes obzvonTaskFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-4px); }
}

.ai-obzvon-klientov-page .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--nero-ai-primary);
  font-size: 11px;
  font-weight: 800;
}

.ai-obzvon-klientov-page .nero-ai-task-icon--out { background: rgba(34,197,94,.14); color: #86efac; }
.ai-obzvon-klientov-page .nero-ai-task-icon--warn { background: rgba(245,158,11,.14); color: #fcd34d; }

.ai-obzvon-klientov-page .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 13px;
}

.ai-obzvon-klientov-page .nero-ai-task .nero-ai-task-sub {
  color: var(--nero-ai-muted);
  font-size: 12px;
}

.ai-obzvon-klientov-page .nero-ai-status {
  padding: 5px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
}

.ai-obzvon-klientov-page .nero-ai-status--queue {
  background: rgba(121,242,255,.11);
  color: #bae6fd;
}

.ai-obzvon-klientov-page .nero-ai-status--fallback {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}

.ai-obzvon-klientov-page .nero-ai-reveal {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity .55s ease, transform .55s ease;
}

.ai-obzvon-klientov-page .nero-ai-reveal.nero-ai-active {
  opacity: 1;
  transform: none;
}

.ai-obzvon-klientov-page .nero-ai-delay-2 { transition-delay: .24s; }

@media (max-width: 1024px) {
  .ai-obzvon-klientov-page .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .ai-obzvon-klientov-page .nero-ai-dashboard { transform: none; }
}

@media (max-width: 600px) {
  .ai-obzvon-klientov-page .nero-ai-metrics-grid { grid-template-columns: 1fr; }
  .ai-obzvon-klientov-page .nero-ai-btn-row { flex-direction: column; align-items: stretch; }
  .ai-obzvon-klientov-page .nero-ai-btn { width: 100%; }
}
</style>

<section class="nero-ai-hero" id="hero" aria-labelledby="hero-obzvon-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · голосовой AI и обзвон</p>
      <h1 id="hero-obzvon-title">AI-обзвон клиентов: подтверждение записей и напоминания <span class="nero-ai-gradient-text">под ключ</span></h1>
      <p class="nero-ai-hero-lead">Голосовой AI обзванивает клиентов, подтверждает визит и переносит запись — менеджеры перестают тратить часы на рутинные звонки, а неявки падают</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Подтверждение записи</li>
        <li class="nero-ai-badge">Напоминания</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">No-show</li>
        <li class="nero-ai-badge">Под ключ</li>
        <li class="nero-ai-badge">24/7</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kalkulyator-nevyavok">Рассчитать потери</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: центр исходящего обзвона">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true">
            <span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span>
          </div>
          <span class="nero-ai-window-title">исходящий обзвон · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Центр исходящего обзвона</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--accent">
              <span>Подтверждено сегодня</span>
              <strong id="obzvon-metric-confirmed">127</strong>
              <small>записей закрыто</small>
            </div>
            <div class="nero-ai-metric">
              <span>Неявки</span>
              <strong>−22%</strong>
              <small>после пилота</small>
            </div>
            <div class="nero-ai-metric">
              <span>Звонков в очереди</span>
              <strong id="obzvon-metric-queue">18</strong>
              <small>исходящих</small>
            </div>
            <div class="nero-ai-metric">
              <span>Дозвон</span>
              <strong>94%</strong>
              <small>за 24 ч</small>
            </div>
          </div>
          <canvas id="obzvon-hero-wave" width="640" height="112" aria-hidden="true"></canvas>
          <div class="nero-ai-task-stream" id="obzvon-call-feed" aria-live="polite">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--out">OUT</span>
              <div>
                <strong>Исходящий звонок</strong>
                <span class="nero-ai-task-sub">клиника · запись на завтра 10:30</span>
              </div>
              <span class="nero-ai-status">подтверждено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div>
                <strong>Перенос записи</strong>
                <span class="nero-ai-task-sub">новый слот забронирован в amoCRM</span>
              </div>
              <span class="nero-ai-status nero-ai-status--queue">в CRM</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--warn">SMS</span>
              <div>
                <strong>SMS fallback</strong>
                <span class="nero-ai-task-sub">после недозвона · ссылка на перенос</span>
              </div>
              <span class="nero-ai-status nero-ai-status--fallback">отправлено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  'use strict';

  /* Reveal */
  var reveals = document.querySelectorAll('.ai-obzvon-klientov-page .nero-ai-reveal');
  if (reveals.length && 'IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.classList.add('nero-ai-active');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.12 });
    reveals.forEach(function (el) { io.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add('nero-ai-active'); });
  }

  /* Voice waveform — исходящий звонок */
  var canvas = document.getElementById('obzvon-hero-wave');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var dpr = window.devicePixelRatio || 1;
  var t = 0;

  function resizeWave() {
    var rect = canvas.getBoundingClientRect();
    canvas.width = Math.floor(rect.width * dpr);
    canvas.height = Math.floor(rect.height * dpr);
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function drawWave() {
    var w = canvas.clientWidth;
    var h = canvas.clientHeight;
    ctx.clearRect(0, 0, w, h);
    ctx.strokeStyle = 'rgba(121, 242, 255, 0.55)';
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var x = 0; x <= w; x += 3) {
      var y = h / 2 + Math.sin((x + t) * 0.04) * 8 + Math.sin((x + t) * 0.09) * 4;
      if (x === 0) ctx.moveTo(x, y);
      else ctx.lineTo(x, y);
    }
    ctx.stroke();
    ctx.fillStyle = 'rgba(34, 197, 94, 0.35)';
    ctx.beginPath();
    ctx.arc(w * 0.12, h / 2, 6 + Math.sin(t * 0.08) * 2, 0, Math.PI * 2);
    ctx.fill();
    t += 2.2;
    requestAnimationFrame(drawWave);
  }

  resizeWave();
  window.addEventListener('resize', resizeWave);
  drawWave();

  /* Живая лента исходящих звонков */
  var feed = document.getElementById('obzvon-call-feed');
  var queueEl = document.getElementById('obzvon-metric-queue');
  var confirmedEl = document.getElementById('obzvon-metric-confirmed');
  var events = [
    { icon: 'OUT', iconClass: 'nero-ai-task-icon--out', title: 'Исходящий звонок', sub: 'стоматология · напоминание за 24 ч', status: 'подтверждено', statusClass: '' },
    { icon: 'CRM', iconClass: '', title: 'Перенос записи', sub: 'слот 14:00 → 16:30 в YCLIENTS', status: 'в CRM', statusClass: 'nero-ai-status--queue' },
    { icon: 'SMS', iconClass: 'nero-ai-task-icon--warn', title: 'SMS fallback', sub: 'недозвон · ссылка на подтверждение', status: 'отправлено', statusClass: 'nero-ai-status--fallback' },
    { icon: 'OUT', iconClass: 'nero-ai-task-icon--out', title: 'Исходящий звонок', sub: 'доставка · подтверждение заказа', status: 'подтверждено', statusClass: '' },
    { icon: 'OUT', iconClass: 'nero-ai-task-icon--out', title: 'Исходящий звонок', sub: 'школа · пробный урок в субботу', status: 'перенос', statusClass: 'nero-ai-status--queue' }
  ];
  var idx = 0;

  function renderFeedRow(ev) {
    return '<div class="nero-ai-task">' +
      '<span class="nero-ai-task-icon ' + ev.iconClass + '">' + ev.icon + '</span>' +
      '<div><strong>' + ev.title + '</strong><span class="nero-ai-task-sub">' + ev.sub + '</span></div>' +
      '<span class="nero-ai-status ' + ev.statusClass + '">' + ev.status + '</span></div>';
  }

  if (feed) {
    setInterval(function () {
      idx = (idx + 1) % events.length;
      feed.insertAdjacentHTML('afterbegin', renderFeedRow(events[idx]));
      while (feed.children.length > 3) feed.removeChild(feed.lastChild);
      if (queueEl) {
        var q = parseInt(queueEl.textContent, 10) || 18;
        queueEl.textContent = String(Math.max(8, q + (Math.random() > 0.5 ? 1 : -1)));
      }
      if (confirmedEl && events[idx].status === 'подтверждено') {
        var c = parseInt(confirmedEl.textContent, 10) || 127;
        confirmedEl.textContent = String(c + 1);
      }
    }, 4200);
  }
})();
</script>
<!-- ====================================================
     КОНТЕНТНАЯ ЧАСТЬ: ai-obzvon-klientov (Борис → Наташа)
     Обёртка .vna-content — стили из page template (как amoCRM)
     ==================================================== -->
<div class="vna-content" id="obzvon-content">

  <!-- INTRO -->
  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai обзвон клиентов</p>
          <p><strong>Коротко:</strong> AI-обзвон клиентов — исходящая голосовая автоматизация, которая подтверждает запись, напоминает о визите и переносит время в диалоге без участия менеджера. Nero Network внедряет такие системы под ключ: от аудита процесса записи до интеграции с CRM и телефонией.</p>
          <p>Клиент записался — и забыл. Администратор потратил полчаса на обзвон — и не дозвонился. Слот остался пустым, выручка ушла, а менеджер снова садится за список номеров. В медицине, образовании, сервисных центрах и доставках эта схема повторяется ежедневно: по отраслевым данным, неявки в частных клиниках России составляют <strong>10–25%</strong> (YCLIENTS, 2023), в крупных городах — <strong>18–20%</strong> (ProDoctorov, 2023). SMS-напоминания игнорируют до <strong>60%</strong> получателей (YCLIENTS, 2023). Ручной обзвон не масштабируется, а каждая пропущенная запись стоит от <strong>2 500 до 7 500 ₽</strong> (Medesk, 2023).</p>
          <p><strong>AI-обзвон клиентов</strong> решает задачу иначе: голосовой агент звонит по расписанию, озвучивает детали визита, распознаёт ответ и фиксирует результат в CRM. Менеджеры освобождаются от рутины, неявки снижаются, освободившиеся слоты заполняются быстрее. В 2026 году это уже не эксперимент — IBM и Gartner фиксируют переход от IVR-скриптов к <strong>agentic voice AI</strong>, а российские клиники и сервисы показывают окупаемость в первые месяцы после запуска.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые показатели no-show">
          <div class="vna-kpi-card">
            <div class="kv">10–25%</div>
            <div class="kl">неявки в частных клиниках РФ</div>
            <div class="ks">YCLIENTS, 2023</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">60%</div>
            <div class="kl">игнорируют SMS-напоминания</div>
            <div class="ks">YCLIENTS, 2023</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">6 ₽</div>
            <div class="kl">минута AI vs ~26 ₽ оператор</div>
            <div class="ks">кейс «Элегра»</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">85%</div>
            <div class="kl">исходящих звонков на роботе</div>
            <div class="ks">Robovoice, 2022</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-cnt" style="margin-bottom:1.5rem;">
    <p class="nero-ai-reveal">Голосовой обзвон встраивается в общую стратегию автоматизации: крупные компании, как в кейсе <a href="<?php echo esc_url( home_url( '/kpmg-claude-vnedrenie-ai-276-tysyach/' ) ); ?>">KPMG и Claude для 276 000 сотрудников</a>, масштабируют AI-агентов на сотни тысяч контактов — средний бизнес решает аналогичную задачу через исходящие звонки с подтверждением записи.</p>
  </div>

  <!-- TOC -->
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-nevyavki">Проблема</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#kalkulyator-nevyavok">Калькулятор</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#integraciya">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#risiki">Риски</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Заказать</a>
      </nav>
    </div>
  </div>

  <!-- §1 ПРОБЛЕМА -->
  <section class="vna-section" id="pochemu-nevyavki">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Боль бизнеса</span>
        <h2>Почему клиенты не приходят и менеджеры «тонут» в обзвоне</h2>
        <p>Неявка — системный сбой в цепочке записи: человек забыл, перепутал время, не увидел SMS или не успел отменить визит.</p>
      </div>

      <div class="vna-card nero-ai-reveal" id="stoimost-nevyavok">
        <h3>Сколько стоят пропущенные записи в вашей нише</h3>
        <p><strong>Определение:</strong> no-show (неявка) — ситуация, когда клиент записан на услугу, но не приходит и не отменяет визит заблаговременно.</p>
        <div class="vna-table-wrap">
          <table class="vna-table">
            <thead><tr><th>Ниша</th><th>Доля неявок</th><th>Ориентир ущерба</th></tr></thead>
            <tbody>
              <tr><td>Частные клиники РФ</td><td>10–25%</td><td>2 500–7 500 ₽ за одну неявку</td></tr>
              <tr><td>Стоматология (800 приёмов/мес, 15% no-show, чек 4 000 ₽)</td><td>~120 пустых слотов</td><td><strong>~480 000 ₽/мес</strong> (LoyalMed, 2024)</td></tr>
              <tr><td>Салоны красоты</td><td>10–30%</td><td>потеря слота + простой мастера</td></tr>
              <tr><td>Доставки и e-commerce</td><td>зависит от подтверждения</td><td>отмена заказа после сборки</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:1em;">Глобально средний показатель no-show в здравоохранении — <strong>23%</strong> (Dantas et al., Health Policy, 2018). Формула для российского бизнеса: <strong>количество приёмов × процент неявок × средний чек = упущенная выручка в месяц</strong>.</p>
        <p>Поздний обзвон усугубляет ситуацию. В кейсе e-commerce косметики: «когда звонили через 40 минут, клиент уже не брал трубку» (UniTalk). Чем раньше срабатывает автоматическое подтверждение — тем выше шанс заполнить слот.</p>
      </div>

      <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="operator-ne-masshtabiruetsya" style="margin-top:24px;">
        <h3>Почему живой оператор не масштабируется на напоминания</h3>
        <ul>
          <li><strong>Время.</strong> До <strong>1 000 пациентов в день</strong> вручную — кейс «Элегра» (Robovoice).</li>
          <li><strong>Стоимость.</strong> ~<strong>26 ₽/мин</strong> оператор vs от <strong>6 ₽/мин</strong> робот.</li>
          <li><strong>Скорость.</strong> Робот обрабатывает объём <strong>в 6 раз быстрее</strong>.</li>
          <li><strong>Покрытие.</strong> AI-обзвон доступен <strong>24/7</strong> без переработок.</li>
          <li><strong>SMS не спасает.</strong> До 60% напоминаний без реакции; нет интерактивного переноса.</li>
        </ul>
        <p>Живой оператор незаменим для сложных диалогов и VIP-клиентов. Но на рутинное <strong>подтверждение записи</strong> и <strong>напоминания клиентам</strong> штат не масштабируется экономически.</p>
      </div>
    </div>
  </section>

  <!-- §2 КАК РАБОТАЕТ -->
  <section class="vna-section vna-section-alt" id="kak-rabotaet">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Голосовой AI</span>
        <h2>AI-обзвон клиентов — что это и как работает голосовой агент</h2>
        <p>Исходящая автоматизация на базе ASR + TTS + LLM: не старый IVR с «нажмите 1», а диалог на естественном языке.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <p><strong>Определение:</strong> AI-обзвон клиентов — исходящая голосовая автоматизация на базе ASR (распознавание речи) + TTS (синтез речи) + LLM или сценарной логики. Система по триггеру из CRM или МИС звонит клиенту, озвучивает детали записи, распознаёт ответ и фиксирует результат.</p>
        <h3 style="margin-top:20px;">Как работает цепочка (5 шагов)</h3>
        <div class="vna-timeline">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>1. Запись в CRM</h3><p>Клиент оставляет заявку → данные в amoCRM, Битрикс24, YCLIENTS, Medesk.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>2. Триггер обзвона</h3><p>За N часов до визита (24 ч, 3 ч, 2 ч) срабатывает исходящий обзвон.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>3. AI-звонок</h3><p>Агент называет имя, услугу, дату, время и адрес.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>4. Распознавание намерения</h3><p>Подтвердить / перенести / отменить / «перезвоните позже».</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>5. Запись в CRM</h3><p>Статус, транскрипт, запись звонка; при сложном кейсе — эскалация на человека.</p></div>
        </div>
        <p style="margin-top:1em;">Gartner: к <strong>2028</strong> не менее <strong>70%</strong> клиентов начнут путь в сервисе через conversational AI (IBM, 2026).</p>
      </div>

      <div class="vna-grid-2" style="margin-top:28px;">
        <div class="vna-card nero-ai-reveal" id="podtverzhdenie-golosom">
          <h3>Подтверждение записи голосом без участия менеджера</h3>
          <p>Сценарий <strong>ai подтверждение записи</strong> — базовый и самый окупаемый. Кейс «Элегра»: <strong>85%</strong> исходящих на роботе, <strong>30 000+</strong> звонков/мес. Кейс igooods: пилот <strong>5 дней</strong>, <strong>−87%</strong> нагрузки, затем <strong>95%</strong> без оператора.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="napominaniya-perenos">
          <h3>Напоминания о визите и перенос времени в диалоге</h3>
          <p><strong>AI напоминания клиентам</strong> — активный диалог с переносом через CRM API. Fallback: голос → SMS → оператор (Amniss). SMS снижает no-show на <strong>23–38%</strong>, голосовой обзвон — на <strong>20–30%</strong> с мгновенным переносом.</p>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-cnt" style="margin-bottom:1.5rem;">
    <p class="nero-ai-reveal">Триггеры обзвона и запись результатов в CRM — ключевой этап цепочки. Для amoCRM сценарии «подтвердить / перенести / отменить» настраиваются через вебхуки и Digital Pipeline; подробный разбор стека — в материале <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-amocrm/' ) ); ?>">AI-агент для amoCRM под ключ</a>.</p>
  </div>

  <!-- ================================================
       БОРИС: визуальный блок (контраст к hero Алины)
       ================================================ -->
  <section id="boris-obzvon-viz" class="bov-root" aria-label="Визуализация потерь от неявок: календарь записей и пустые слоты">
<style>
/* === БОРИС obzvon: prefix bov-, scoped в #boris-obzvon-viz === */
.bov-root{padding:clamp(48px,6vw,72px) 0;background:linear-gradient(180deg,#f0f4fb 0%,#e8eef8 100%);}
.bov-cnt{width:min(1160px,calc(100% - 40px));margin:0 auto;}
.bov-card{
  display:grid;grid-template-columns:42% 58%;
  border-radius:24px;overflow:hidden;
  box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(14,165,233,.18);
  min-height:480px;
}
@media(max-width:960px){.bov-card{grid-template-columns:1fr;min-height:auto;}}
.bov-lft{background:#fff;padding:clamp(28px,4vw,48px) clamp(24px,3vw,40px);display:flex;flex-direction:column;justify-content:center;}
.bov-ey{display:inline-flex;align-items:center;gap:7px;font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;color:#0ea5e9;margin:0 0 14px;}
.bov-ey::before{content:'';width:20px;height:2px;background:#0ea5e9;border-radius:1px;}
.bov-h3{font-size:clamp(20px,2.4vw,25px);font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 18px;}
.bov-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
.bov-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14.5px;line-height:1.5;color:#334155;}
.bov-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(14,165,233,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0ea5e9;font-style:normal;}
.bov-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;}
.bov-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
.bov-pl-r{background:rgba(239,68,68,.08);color:#b91c1c;border:1.5px solid rgba(239,68,68,.22);}
.bov-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
.bov-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
.bov-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
.bov-rgt{background:linear-gradient(145deg,#0c1222 0%,#111827 55%,#0a0f1a 100%);position:relative;overflow:hidden;min-height:380px;}
#bov-noshow-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bov-cnt"><div class="bov-card">
  <div class="bov-lft">
    <span class="bov-ey">Счётчик no-show</span>
    <h3 class="bov-h3">Пока менеджер обзванивает вручную — слоты пустеют и деньги утекают</h3>
    <ul class="bov-ul">
      <li><span class="bov-ic">✕</span>Красные ячейки — неявки: клиент не пришёл, слот не перепродан</li>
      <li><span class="bov-ic">✓</span>Зелёные — подтверждённые AI-звонком записи</li>
      <li><span class="bov-ic">↻</span>Синие — переносы, зафиксированные в CRM в диалоге</li>
      <li><span class="bov-ic">₽</span>Счётчик справа — накопленные потери за неделю</li>
    </ul>
    <div class="bov-pills">
      <span class="bov-pl bov-pl-r">−18% выручки</span>
      <span class="bov-pl bov-pl-g">+25% при напоминаниях</span>
      <span class="bov-pl bov-pl-b">6× быстрее обзвон</span>
    </div>
    <p class="bov-foot">Дальше — посчитайте свои потери в калькуляторе ↓</p>
  </div>
  <div class="bov-rgt">
    <canvas id="bov-noshow-canvas" aria-label="Анимация: календарь записей с пустыми слотами no-show и растущим счётчиком потерь" role="img"></canvas>
  </div>
</div></div>
<script>
(function(){
  var cv=document.getElementById('bov-noshow-canvas');if(!cv)return;
  var cx=cv.getContext('2d'),W=0,H=0,t=0,loss=0;
  function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;W=cv.width;H=cv.height;}
  window.addEventListener('resize',resize);resize();
  var COLS=7,ROWS=4,PAD=16,TOP=52;
  function cell(i,j){var gw=(W-PAD*2)/COLS,gh=(H-TOP-PAD-36)/ROWS;return{x:PAD+j*gw,y:TOP+i*gh,w:gw-6,h:gh-6};}
  var slots=[];for(var r=0;r<ROWS;r++)for(var c=0;c<COLS;c++){var st=Math.random();slots.push({r:r,c:c,state:st<.22?'miss':st<.55?'ok':st<.75?'move':'wait',phase:Math.random()*6.28});}
  function rr(x,y,w,h,r,fill,stroke){cx.beginPath();if(cx.roundRect)cx.roundRect(x,y,w,h,r);else{cx.moveTo(x+r,y);cx.arcTo(x+w,y,x+w,y+h,r);cx.arcTo(x+w,y+h,x,y+h,r);cx.arcTo(x,y+h,x,y,r);cx.arcTo(x,y,x+w,y,r);}if(fill){cx.fillStyle=fill;cx.fill();}if(stroke){cx.strokeStyle=stroke;cx.lineWidth=1.5;cx.stroke();}}
  function loop(){
    t++;if(t%90===0){loss+=Math.floor(2500+Math.random()*4000);var s=slots[Math.floor(Math.random()*slots.length)];if(s.state==='wait'||s.state==='ok')s.state=Math.random()<.35?'miss':'ok';}
    cx.clearRect(0,0,W,H);
    cx.fillStyle='#e2e8f0';cx.font='bold 13px Inter,system-ui,sans-serif';cx.textAlign='left';
    cx.fillText('Расписание записей · неделя',PAD,28);
    cx.fillStyle='rgba(226,232,240,.5)';cx.font='11px Inter,sans-serif';
    cx.textAlign='right';cx.fillText('Потери: '+loss.toLocaleString('ru-RU')+' ₽',W-PAD,28);
    cx.strokeStyle='rgba(255,255,255,.08)';cx.beginPath();cx.moveTo(0,42);cx.lineTo(W,42);cx.stroke();
    slots.forEach(function(s){
      var c=cell(s.r,s.c),col;
      if(s.state==='miss')col='rgba(239,68,68,.75)';
      else if(s.state==='ok')col='rgba(34,197,94,.7)';
      else if(s.state==='move')col='rgba(14,165,233,.65)';
      else col='rgba(255,255,255,.12)';
      var pulse=s.state==='miss'?1+Math.sin(t*.08+s.phase)*.06:1;
      rr(c.x,c.y,c.w*pulse,c.h,c.h*.2,col,'rgba(255,255,255,.15)');
      if(s.state==='miss'){cx.fillStyle='#fecaca';cx.font='bold 14px sans-serif';cx.textAlign='center';cx.fillText('✕',c.x+c.w/2,c.y+c.h/2+5);}
      else if(s.state==='ok'){cx.fillStyle='#bbf7d0';cx.font='bold 14px sans-serif';cx.textAlign='center';cx.fillText('✓',c.x+c.w/2,c.y+c.h/2+5);}
    });
    requestAnimationFrame(loop);
  }
  document.fonts.ready.then(loop);
})();
</script>
  </section>

  <!-- §3 КАЛЬКУЛЯТОР -->
  <section class="vna-section" id="kalkulyator-nevyavok">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Лид-магнит</span>
        <h2>Калькулятор потерь от неявок</h2>
        <p>Прежде чем считать бюджет на внедрение, посчитайте, сколько денег бизнес теряет на неявках каждый месяц.</p>
      </div>

      <div class="vna-card nero-ai-reveal obz-calc-wrap" id="obz-calc">
<style>
.obz-calc-wrap .obz-calc-grid{display:grid;grid-template-columns:1fr 1fr;gap:32px;align-items:start;}
@media(max-width:900px){.obz-calc-wrap .obz-calc-grid{grid-template-columns:1fr;}}
.obz-calc-form label{display:block;font-size:13px;font-weight:600;color:var(--vna-soft);margin-bottom:6px;}
.obz-calc-form input[type=number],.obz-calc-form input[type=range]{
  width:100%;padding:12px 14px;border-radius:12px;border:1px solid rgba(255,255,255,.14);
  background:rgba(255,255,255,.06);color:var(--vna-heading);font-size:16px;margin-bottom:18px;
}
.obz-calc-form input:focus{outline:none;border-color:rgba(121,242,255,.45);}
.obz-calc-form input[type=range]{padding:0;height:8px;-webkit-appearance:none;background:rgba(121,242,255,.2);}
.obz-calc-form input[type=range]::-webkit-slider-thumb{-webkit-appearance:none;width:20px;height:20px;border-radius:50%;background:var(--vna-accent);cursor:pointer;}
.vna-formula{display:block;padding:14px 18px;border-radius:12px;background:rgba(0,0,0,.25);border:1px solid rgba(121,242,255,.2);font-family:ui-monospace,monospace;font-size:14px;color:var(--vna-accent);margin:16px 0;}
.obz-calc-result{text-align:center;padding:24px;border-radius:16px;background:linear-gradient(135deg,rgba(239,68,68,.12),rgba(121,242,255,.08));border:1px solid rgba(239,68,68,.25);}
.obz-calc-result .obz-loss-val{font-size:clamp(28px,4vw,42px);font-weight:900;color:#f87171;letter-spacing:-.04em;line-height:1.1;}
.obz-calc-result .obz-save-val{font-size:clamp(18px,2.5vw,24px);font-weight:800;color:var(--vna-green);margin-top:12px;}
#obz-calc-canvas{width:100%;height:220px;display:block;border-radius:14px;background:rgba(0,0,0,.2);margin-top:16px;}
.obz-calc-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:16px;}
@media(max-width:600px){.obz-calc-stats{grid-template-columns:1fr;}}
.obz-stat{padding:12px;border-radius:12px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);text-align:center;}
.obz-stat strong{display:block;font-size:20px;color:var(--vna-accent);}
.obz-stat span{font-size:12px;color:var(--vna-muted);}
</style>
        <div class="obz-calc-grid">
          <div class="obz-calc-form" id="kak-poschitat">
            <h3>Как посчитать упущенную выручку от no-show</h3>
            <code class="vna-formula">Потери в месяц = Приёмов/записей × % неявок × Средний чек</code>
            <label for="obz-in-appts">Приёмов/записей в месяц</label>
            <input type="number" id="obz-in-appts" value="200" min="1" max="50000" step="1" aria-describedby="obz-hint-appts">
            <label for="obz-in-noshow">% неявок (no-show)</label>
            <input type="range" id="obz-in-noshow" value="18" min="1" max="50" step="1" aria-describedby="obz-noshow-val">
            <p id="obz-noshow-val" style="margin:-10px 0 18px;font-size:14px;color:var(--vna-accent);"><strong>18%</strong></p>
            <label for="obz-in-check">Средний чек, ₽</label>
            <input type="number" id="obz-in-check" value="9800" min="100" max="1000000" step="100">
            <p id="obz-hint-appts" style="font-size:13px;color:var(--vna-muted);">Пример: стоматология 200 приёмов, 18% no-show, чек 9 800 ₽</p>
          </div>
          <div>
            <div class="obz-calc-result" aria-live="polite" aria-atomic="true">
              <p style="margin:0 0 8px;font-size:14px;color:var(--vna-muted);">Упущенная выручка в месяц</p>
              <div class="obz-loss-val" id="obz-out-monthly">352 800 ₽</div>
              <p style="margin:12px 0 0;font-size:14px;color:var(--vna-muted);">В год: <strong id="obz-out-yearly">4 233 600 ₽</strong></p>
              <div class="obz-save-val" id="obz-out-save">Возврат при −25% no-show: ~88 200 ₽/мес</div>
            </div>
            <canvas id="obz-calc-canvas" aria-label="Диаграмма: потери от неявок и потенциальный возврат выручки" role="img"></canvas>
            <div class="obz-calc-stats">
              <div class="obz-stat"><strong id="obz-out-slots">36</strong><span>пустых слотов/мес</span></div>
              <div class="obz-stat"><strong id="obz-out-operator">~5 000 ₽</strong><span>трудозатраты обзвона</span></div>
              <div class="obz-stat"><strong>80–90%</strong><span>звонков закроет AI</span></div>
            </div>
          </div>
        </div>

        <div style="margin-top:32px;" id="obzvony-ai-vmesto-shtata">
          <h3>Сколько обзвонов можно закрыть AI вместо штата</h3>
          <div class="vna-table-wrap">
            <table class="vna-table">
              <thead><tr><th>Показатель</th><th>Оператор</th><th>AI-обзвон</th></tr></thead>
              <tbody>
                <tr><td>Стоимость минуты</td><td>~26 ₽</td><td>от ~6 ₽</td></tr>
                <tr><td>1 000 звонков/день</td><td>узкое горлышко</td><td>до 1 000+ одновременных</td></tr>
                <tr><td>Доля автоматизации</td><td>100%, но дорого</td><td>55–95%</td></tr>
                <tr><td>Скорость 1 000 записей</td><td>базовая</td><td><strong>в 6 раз быстрее</strong></td></tr>
              </tbody>
            </table>
          </div>
          <p style="margin-top:1em;">Если администратор тратит <strong>2 часа в день</strong> на обзвон — это <strong>~5 000 ₽/мес</strong> прямых трудозатрат без учёта пустых слотов.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ARTUR-CTA-1 -->
  <div class="vna-cnt">
    <!-- ARTUR-CTA-1:INSERT -->
    <div class="ym-cta-block ym-cta-block--primary" id="cta-kalkulyator">
      <div class="ym-cta-block__icon" aria-hidden="true">📞</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Посчитали потери — пора их остановить</p>
        <p class="ym-cta-block__sub">Закажите аудит процесса записи: покажем, сколько обзвонов можно передать голосовому AI, и запустим пилот с метриками no-show до/после за 2–4 недели.</p>
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>
  </div>

  <!-- §4 СЦЕНАРИИ -->
  <section class="vna-section vna-section-alt" id="scenarii">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Отрасли</span>
        <h2>Сценарии AI-обзвона для бизнеса</h2>
        <p>Автоматический обзвон AI универсален по механике, но сценарии различаются по отраслям.</p>
      </div>
      <div class="vna-grid-2">
        <div class="vna-card nero-ai-reveal" id="kliniki">
          <div class="vna-eyebrow">Медицина</div>
          <h3>Клиники и медицинские центры</h3>
          <p>Кейсы: «Элегра», «Норма», AG Experts. Исходящий обзвон накануне приёма → подтверждение/отмена → запись в МИС. Emirates Health Services: no-show <strong>−50,7%</strong> с AI-предиктивом.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="shkoly">
          <div class="vna-eyebrow">Образование</div>
          <h3>Школы, курсы и мероприятия</h3>
          <p>Обзвон за 24 ч и 2 ч до начала. Подтверждение, перенос, отмена. Интеграция amoCRM / Google Таблицы через Make/n8n. Fallback: SMS с ссылкой на перенос.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-2" id="servis-dostavki">
          <div class="vna-eyebrow">Сервис · Доставка</div>
          <h3>Сервисные центры и доставки</h3>
          <p>igooods: <strong>95%</strong> без оператора. UniTalk: звонок через 30–60 сек, <strong>55%</strong> автоподтверждений, <strong>+9%</strong> к чеку. Автосервисы: обзвон за день до визита мастера.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-3">
          <div class="vna-eyebrow">E-commerce</div>
          <h3>Подтверждение заказов</h3>
          <p>Триггер из CRM сразу после «Купить». TTS озвучивает заказ, клиент подтверждает/отменяет. При недозвоне — SMS-каскад.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §5 ВНЕДРЕНИЕ -->
  <section class="vna-section" id="vnedrenie">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Под ключ</span>
        <h2>Внедрение AI-обзвона клиентов под ключ</h2>
        <p>Рабочий процесс: сценарий + CRM + телефония + compliance. Бюджет: <strong>150–400 тыс. ₽</strong>.</p>
      </div>

      <div class="vna-card nero-ai-reveal" id="etapy-vnedreniya">
        <h3>Этапы: аудит → сценарии → пилот → запуск</h3>
        <div class="vna-timeline">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>1. Аудит (1–2 нед.)</h3><p>Объём записей, % no-show, CRM/МИС, согласия, телефония.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>2. Сценарии</h3><p>Подтверждение → перенос → отмена → эскалация. FAQ, fallback.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>3. Интеграция</h3><p>CRM webhook → Make/n8n → голосовая платформа → статус в CRM.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>4. Пилот (2–4 нед.)</h3><p>Один филиал. Замер no-show до/после, дозвон, автоматизация.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>5. Масштабирование</h3><p>Все филиалы, дашборд метрик, QA записей.</p></div>
        </div>
      </div>

      <div class="vna-grid-2" style="margin-top:28px;">
        <div class="vna-card nero-ai-reveal" id="sroki-budzhet">
          <h3>Сроки и ориентир бюджета (150–400 тыс. ₽)</h3>
          <div class="vna-table-wrap">
            <table class="vna-table">
              <tbody>
                <tr><td>Базовый пилот (1 сценарий, 1 CRM)</td><td>от ~150 тыс. ₽</td></tr>
                <tr><td>Несколько филиалов, МИС</td><td>250–400 тыс. ₽</td></tr>
                <tr><td>Премиум-голос (ElevenLabs)</td><td>доп. модуль</td></tr>
              </tbody>
            </table>
          </div>
          <p style="margin-top:1em;">Окупаемость: при потерях 350 000 ₽/мес снижение no-show на 20% возвращает <strong>70 000 ₽/мес</strong> — проект окупается за <strong>2–6 месяцев</strong>.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="chto-vhodit">
          <h3>Что входит в услугу «под ключ»</h3>
          <ul>
            <li>Аудит процесса записи и расчёт ROI</li>
            <li>Проектирование голосовых сценариев</li>
            <li>Интеграция CRM и телефонии</li>
            <li>Юридический блок: согласие, 152-ФЗ</li>
            <li>Пилот с метриками до/после</li>
            <li>Обучение администраторов и документация</li>
            <li>Панель аналитики и техподдержка</li>
          </ul>
          <!-- ARTUR-SECONDARY:INSERT -->
          <aside class="vna-card vna-card--soft" style="margin-top:24px;padding:18px;">
            <p style="margin:0;font-size:14px;"><strong>Нужно разобраться в AI до старта проекта?</strong> Посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $secondary_cta_label ); ?></a> — материалы помогут команде понять логику голосовых агентов.</p>
          </aside>
        </div>
      </div>
    </div>
  </section>

  <!-- §6 ИНТЕГРАЦИИ -->
  <section class="vna-section vna-section-alt" id="integraciya">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">CRM · Телефония</span>
        <h2>Интеграция с CRM и телефонией</h2>
        <p><strong>Интеграция ai обзвон клиентов с CRM</strong> — обязательный элемент внедрения.</p>
      </div>
      <div class="vna-grid-2">
        <div class="vna-card nero-ai-reveal" id="amocrm-bitrix">
          <h3>amoCRM, Битрикс24 и учёт записей</h3>
          <p>amoCRM, Битрикс24, YCLIENTS, Medesk, RetailCRM, 1С. Триггер — событие в CRM. Данные: телефон, имя, дата, услуга, филиал. Оркестрация: <strong>Make.com</strong> или <strong>n8n</strong>.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="zvonki-logi-crm">
          <h3>Исходящие звонки, логи и статусы в CRM</h3>
          <p>Телефония: MANGO OFFICE, МТТ/VoiceBox, Voximplant, SIP. STT/TTS: Yandex SpeechKit, SaluteSpeech. В CRM: статус дозвона, результат, транскрипт, попытки. Каскад: повтор → SMS → оператор.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §7 КЕЙСЫ -->
  <section class="vna-section" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI-обзвона</h2>
      </div>
      <div class="vna-case-grid">
        <div class="vna-case-card nero-ai-reveal" id="do-posle">
          <div class="vna-case-tag">Элегра · медицина</div>
          <h3>До и после</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">85%</span><span class="lbl">звонков на роботе</span></div>
            <div class="vna-metric"><span class="num">6×</span><span class="lbl">быстрее обзвон</span></div>
            <div class="vna-metric"><span class="num">6 ₽</span><span class="lbl">vs 26 ₽/мин</span></div>
          </div>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vna-case-tag">igooods · доставка</div>
          <h3>Пилот за 5 дней</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">−87%</span><span class="lbl">нагрузки</span></div>
            <div class="vna-metric"><span class="num">95%</span><span class="lbl">без оператора</span></div>
          </div>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vna-case-tag">UniTalk · e-commerce</div>
          <h3>Быстрый контакт</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">55%</span><span class="lbl">автоподтверждений</span></div>
            <div class="vna-metric"><span class="num">+9%</span><span class="lbl">к среднему чеку</span></div>
          </div>
        </div>
      </div>
      <div class="vna-card nero-ai-reveal" id="kogda-ai-ustupaet" style="margin-top:28px;">
        <h3>Когда AI уступает живому оператору</h3>
        <p>Эскалация обязательна при: жалобах, нестандартных запросах, медконсультациях, VIP-клиентах, плохой связи. Оптимальная модель — <strong>гибрид</strong>: AI закрывает 80–90% рутины.</p>
        <div class="vna-table-wrap" style="margin-top:16px;">
          <table class="vna-table">
            <thead><tr><th>Критерий</th><th>AI-обзвон</th><th>Оператор</th></tr></thead>
            <tbody>
              <tr><td>Рутинное подтверждение</td><td class="vna-good">✅ оптимально</td><td>дорого, медленно</td></tr>
              <tr><td>Сложные диалоги</td><td>эскалация</td><td class="vna-good">✅ сильная сторона</td></tr>
              <tr><td>24/7</td><td class="vna-good">✅</td><td>смены</td></tr>
              <tr><td>Перенос в CRM</td><td class="vna-good">✅ автоматически</td><td>вручную</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- ARTUR-CTA-2 -->
  <div class="vna-cnt">
    <!-- ARTUR-CTA-2:INSERT -->
    <div class="ym-cta-block ym-cta-block--dual" id="cta-keisy">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите таких же цифр в своей нише?</p>
        <p class="ym-cta-block__sub">85% звонков на роботе, обзвон в 6 раз быстрее, −87% нагрузки — реальные кейсы. Следующий пилот может быть вашим: от 150 тыс. ₽.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"><?php echo esc_html( $primary_cta_label ); ?></a>
          <a href="#vnedrenie" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
        </div>
      </div>
    </div>
  </div>

  <!-- §8 РИСКИ -->
  <section class="vna-section vna-section-alt" id="risiki">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Legal-by-design</span>
        <h2>Риски, качество речи и 152-ФЗ</h2>
        <p>Согласие, хранение данных и разделение сервисных/рекламных звонков — конкурентное преимущество.</p>
      </div>
      <div class="vna-grid-2">
        <div class="vna-card nero-ai-reveal" id="soglasie-obzvon">
          <h3>🛡 Согласие на обзвон и хранение данных</h3>
          <p><strong>126-ФЗ, ст. 44.1-1:</strong> массовые вызовы — только с предварительным согласием. С <strong>01.09.2025</strong> — отдельное согласие.</p>
          <p><strong>152-ФЗ:</strong> запись звонка = ПД; хранение в РФ.</p>
          <p><strong>38-ФЗ:</strong> рекламный обзвон без согласия — штраф до <strong>1,6 млн ₽</strong>. Напоминание о записи по договору — информационное.</p>
          <ul>
            <li>Чекбокс при онлайн-записи</li>
            <li>Пункт в договоре оказания услуг</li>
            <li>Устное подтверждение с фиксацией в CRM</li>
          </ul>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="asr-eskalaciya">
          <h3>Распознавание речи и эскалация на человека</h3>
          <ul>
            <li>Короткий сценарий (30–60 сек)</li>
            <li>Natural voice TTS (SpeechKit, SaluteSpeech)</li>
            <li>Fallback: DTMF, SMS, оператор</li>
            <li>QA выборки записей</li>
            <li>Opt-out в сценарии</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- §9 FAQ -->
  <section class="vna-section" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Вопросы</span>
        <h2>FAQ по AI-обзвону клиентов</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item" id="kak-vnedrit">
          <div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai обзвон клиентов в уже работающий процесс записи?</div>
          <div class="vna-faq-a"><p>Подключите триггер к CRM → настройте расписание → пилот на одном филиале → сравните no-show за 2–4 недели → масштабируйте. YCLIENTS, amoCRM, Битрикс24 — без замены учётной системы.</p></div>
        </div>
        <div class="vna-faq-item" id="malyj-biznes">
          <div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли ai обзвон клиентов для малого бизнеса?</div>
          <div class="vna-faq-a"><p>Да. При 100 записях, 15% no-show и чеке 5 000 ₽ потери — 75 000 ₽/мес. Снижение на 25% возвращает ~19 000 ₽/мес. Бюджет от ~150 тыс. ₽.</p></div>
        </div>
        <div class="vna-faq-item" id="skolko-stoit">
          <div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai обзвон клиентов?</div>
          <div class="vna-faq-a"><p>Внедрение: 150–400 тыс. ₽. Эксплуатация: от ~6 ₽/мин + телефония. Окупаемость: 2–6 месяцев при no-show от 10% и чеке от 3 000 ₽.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Клиент поймёт, что это робот?</div>
          <div class="vna-faq-a"><p>Современный TTS звучит естественно. Сервисный сценарий 30–60 сек воспринимается нейтрально — кейс «Норма» фиксирует позитивное восприятие.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Что если не дозвонились?</div>
          <div class="vna-faq-a"><p>Повтор через 2–4 ч → SMS → задача оператору. Каскад настраивается под бизнес.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">SMS дешевле — зачем голос?</div>
          <div class="vna-faq-a"><p>SMS не даёт интерактивного переноса и игнорируется до 60%. Голос — подтверждение и перенос в одном касании.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Это законно?</div>
          <div class="vna-faq-a"><p>Сервисный обзвон по договору + отдельное согласие (126-ФЗ). Nero Network готовит юридические тексты и чекбоксы.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- §10 ФИНАЛЬНЫЙ CTA -->
  <section class="vna-section vna-section-alt" id="cta">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Следующий шаг</span>
        <h2>Снизить неявки — заказать внедрение AI-обзвона</h2>
        <p>Каждый пустой слот — деньги, которые уже «записаны», но не пришли. <strong>AI-обзвон клиентов под ключ</strong> — возврат выручки, а не «ещё один робот».</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <ul>
          <li>Голосовой агент подтверждает запись и переносит время в диалоге</li>
          <li>Интеграция с CRM и телефонией</li>
          <li>Юридически корректный запуск (126-ФЗ, 152-ФЗ)</li>
          <li>Пилот с метриками до/после за 2–4 недели</li>
          <li>Бюджет: 150–400 тыс. ₽, окупаемость 2–6 месяцев</li>
        </ul>
      </div>
      <!-- ARTUR-CTA-3:INSERT -->
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Снизить неявки с AI-обзвоном под ключ</p>
          <p class="ym-cta-block__sub">Аудит, демо-звонок, интеграция CRM и телефонии, запуск по 126-ФЗ и 152-ФЗ. Бюджет: 150–400 тыс. ₽.</p>
          <ul class="vna-cta-checklist">
            <li>Калькулятор потерь от неявок</li>
            <li>Пилот 2–4 недели с метриками</li>
            <li>amoCRM, Битрикс24, YCLIENTS</li>
            <li>Демо-звонок по вашему сценарию</li>
          </ul>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"><?php echo esc_html( $primary_cta_label ); ?></a>
        </div>
      </div>
      <!-- ARTUR-BANNER:INSERT -->
    </div>
  </section>

</div><!-- /.vna-content -->

<script>
/* Калькулятор потерь от неявок + canvas-диаграмма */
(function(){
  var appts=document.getElementById('obz-in-appts');
  var noshow=document.getElementById('obz-in-noshow');
  var check=document.getElementById('obz-in-check');
  var cv=document.getElementById('obz-calc-canvas');
  if(!appts||!noshow||!check)return;
  var outM=document.getElementById('obz-out-monthly');
  var outY=document.getElementById('obz-out-yearly');
  var outS=document.getElementById('obz-out-save');
  var outSl=document.getElementById('obz-out-slots');
  var noshowLbl=document.getElementById('obz-noshow-val');
  function fmt(n){return Math.round(n).toLocaleString('ru-RU')+' ₽';}
  function recalc(){
    var a=Math.max(1,parseInt(appts.value,10)||0);
    var p=Math.max(1,Math.min(50,parseFloat(noshow.value)||0));
    var c=Math.max(100,parseInt(check.value,10)||0);
    noshowLbl.innerHTML='<strong>'+p+'%</strong>';
    var slots=Math.round(a*p/100);
    var monthly=slots*c;
    var yearly=monthly*12;
    var save=monthly*0.25;
    outM.textContent=fmt(monthly);
    outY.textContent=fmt(yearly);
    outS.textContent='Возврат при −25% no-show: ~'+fmt(save).replace(' ₽','')+'/мес';
    outSl.textContent=slots;
    drawChart(monthly,save);
  }
  function drawChart(loss,save){
    if(!cv)return;
    var cx=cv.getContext('2d');
    var W=cv.width=cv.clientWidth||400;
    var H=cv.height=cv.clientHeight||220;
    cx.clearRect(0,0,W,H);
    var barW=Math.min(120,(W-80)/2);
    var max=Math.max(loss,save,1);
    var h1=(loss/max)*(H-60);
    var h2=(save/max)*(H-60);
    var x1=W/2-barW-20,x2=W/2+20,y0=H-30;
    function bar(x,h,col,label){
      cx.fillStyle=col;cx.fillRect(x,y0-h,barW,h);
      cx.fillStyle='#9aa8bd';cx.font='12px Inter,sans-serif';cx.textAlign='center';
      cx.fillText(label,x+barW/2,y0+16);
      cx.fillStyle='#e6edf7';cx.font='bold 14px Inter,sans-serif';
      cx.fillText(fmt(h===h1?loss:save).replace(' ₽',''),x+barW/2,y0-h-8);
    }
    bar(x1,h1,'rgba(239,68,68,.75)','Потери/мес');
    bar(x2,h2,'rgba(34,197,94,.75)','Возврат −25%');
  }
  ['input','change'].forEach(function(ev){
    appts.addEventListener(ev,recalc);
    noshow.addEventListener(ev,recalc);
    check.addEventListener(ev,recalc);
  });
  window.addEventListener('resize',recalc);
  recalc();
})();

/* FAQ accordion */
(function(){
  document.querySelectorAll('.vna-faq-q').forEach(function(q){
    q.addEventListener('click',function(){
      var item=q.parentElement;
      var open=item.classList.contains('open');
      item.parentElement.querySelectorAll('.vna-faq-item').forEach(function(i){i.classList.remove('open');i.querySelector('.vna-faq-q').setAttribute('aria-expanded','false');});
      if(!open){item.classList.add('open');q.setAttribute('aria-expanded','true');}
    });
    q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();q.click();}});
  });
})();
</script>
<!-- REVEAL (IntersectionObserver) для контента -->
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
$obzvon_schema_base = rtrim( home_url(), '/' );
$obzvon_schema_page = trailingslashit( get_permalink() );
$obzvon_schema_org  = $obzvon_schema_base . '/#organization';
$obzvon_schema_web  = $obzvon_schema_base . '/#website';
$obzvon_schema_ld   = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $obzvon_schema_org,
			'name'  => 'Nero Network',
			'url'   => $obzvon_schema_base . '/',
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $obzvon_schema_web,
			'url'       => $obzvon_schema_base . '/',
			'name'      => 'Nero Network',
			'publisher' => [ '@id' => $obzvon_schema_org ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $obzvon_schema_page . '#webpage',
			'url'         => $obzvon_schema_page,
			'name'        => 'AI-обзвон клиентов: подтверждение записей и напоминания под ключ',
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $obzvon_schema_web ],
			'about'       => [ '@id' => $obzvon_schema_org ],
		],
		[
			'@type'           => 'BreadcrumbList',
			'@id'             => $obzvon_schema_page . '#breadcrumb',
			'itemListElement' => [
				[
					'@type'    => 'ListItem',
					'position' => 1,
					'name'     => 'Главная',
					'item'     => $obzvon_schema_base . '/',
				],
				[
					'@type'    => 'ListItem',
					'position' => 2,
					'name'     => 'AI-обзвон клиентов: подтверждение записей и напоминания под ключ',
					'item'     => $obzvon_schema_page,
				],
			],
		],
		[
			'@type'        => 'Service',
			'@id'          => $obzvon_schema_page . '#service',
			'name'         => 'AI-обзвон клиентов: подтверждение записей и напоминания под ключ',
			'description'  => $page_seo_description,
			'url'          => $obzvon_schema_page,
			'provider'     => [ '@id' => $obzvon_schema_org ],
		],
		[
			'@type'            => 'Article',
			'@id'              => $obzvon_schema_page . '#article',
			'headline'         => 'AI-обзвон клиентов: подтверждение записей и напоминания под ключ',
			'description'      => $page_seo_description,
			'url'              => $obzvon_schema_page,
			'mainEntityOfPage' => [ '@id' => $obzvon_schema_page . '#webpage' ],
			'publisher'        => [ '@id' => $obzvon_schema_org ],
		],
		[
			'@type'      => 'FAQPage',
			'@id'        => $obzvon_schema_page . '#faq',
			'mainEntity' => [
				[
					'@type'          => 'Question',
					'name'           => 'Как внедрить ai обзвон клиентов в уже работающий процесс записи?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Подключите триггер к CRM → настройте расписание → пилот на одном филиале → сравните no-show за 2–4 недели → масштабируйте. YCLIENTS, amoCRM, Битрикс24 — без замены учётной системы.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Подходит ли ai обзвон клиентов для малого бизнеса?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Да. При 100 записях, 15% no-show и чеке 5 000 ₽ потери — 75 000 ₽/мес. Снижение на 25% возвращает ~19 000 ₽/мес. Бюджет от ~150 тыс. ₽.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Сколько стоит ai обзвон клиентов?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Внедрение: 150–400 тыс. ₽. Эксплуатация: от ~6 ₽/мин + телефония. Окупаемость: 2–6 месяцев при no-show от 10% и чеке от 3 000 ₽.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Клиент поймёт, что это робот?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Современный TTS звучит естественно. Сервисный сценарий 30–60 сек воспринимается нейтрально — кейс «Норма» фиксирует позитивное восприятие.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Что если не дозвонились?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Повтор через 2–4 ч → SMS → задача оператору. Каскад настраивается под бизнес.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'SMS дешевле — зачем голос?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'SMS не даёт интерактивного переноса и игнорируется до 60%. Голос — подтверждение и перенос в одном касании.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Это законно?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Сервисный обзвон по договору + отдельное согласие (126-ФЗ). Nero Network готовит юридические тексты и чекбоксы.',
					],
				],
			],
		],
	],
];
?>
<script type="application/ld+json"><?php echo wp_json_encode( $obzvon_schema_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

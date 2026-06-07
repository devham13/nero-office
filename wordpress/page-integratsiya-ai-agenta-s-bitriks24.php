<?php
/**
 * Template Name: AI-агент для Битрикс24: интеграция и настройка под ключ
 * Description: SEO-лендинг — внедрение AI-агента в Битрикс24. Кейсы, стек, цены. Аудит бесплатно.
 */

$page_seo_title       = 'AI-агент для Битрикс24: интеграция и настройка под ключ';
$page_seo_description = 'Внедрим AI-агента в Битрикс24: лиды, сделки, задачи и чаты без ручной рутины. REST API, webhooks, кейсы, этапы и цены. Аудит Битрикс24 бесплатно.';

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

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: '');
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить аудит Битрикс24';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#cta';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Курс по автоматизации';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#';

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
.vna-cta-lead-magnet{font-size:15px;color:var(--vna-soft);margin:0 auto 20px;max-width:640px;}
.vna-cta-footnote{font-size:13.5px;color:var(--vna-muted);margin:24px auto 0;max-width:620px;line-height:1.65;}
.vna-inline-cta{
  color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px;
  text-decoration-color:rgba(121,242,255,.35);transition:color .2s;
}
.vna-inline-cta:hover{color:#fff;text-decoration-color:var(--vna-accent);}

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

<main id="primary" class="site-main nero-ai-home-page integratsiya-ai-agenta-s-bitriks24-page" role="main" tabindex="-1">

  <section class="nero-ai-hero" id="hero" aria-labelledby="hero-bitrix24-title">
<style>
#hero.nero-ai-hero{position:relative;padding:clamp(72px,9vw,120px) 0 clamp(48px,6vw,80px);}
#hero .nero-ai-hero-grid{display:grid;grid-template-columns:1fr 1.05fr;gap:clamp(32px,4vw,56px);align-items:center;}
#hero .nero-ai-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(47,198,246,.1);border:1px solid rgba(47,198,246,.28);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#2fc6f6;margin:0 0 18px;}
#hero .nero-ai-h1,#hero h1{font-size:clamp(30px,4.2vw,52px);line-height:1.08;letter-spacing:-.045em;color:#fff;margin:0 0 18px;font-weight:800;}
#hero .nero-ai-gradient-text{background:linear-gradient(92deg,#fff 0%,#2fc6f6 42%,#8b5cf6 100%);-webkit-background-clip:text;background-clip:text;color:transparent;}
#hero .nero-ai-hero-lead{font-size:clamp(15px,1.65vw,18px);line-height:1.65;color:#9aa8bd;margin:0 0 22px;max-width:540px;}
#hero .nero-ai-badges{display:flex;flex-wrap:wrap;gap:8px;list-style:none;margin:0 0 28px;padding:0;}
#hero .nero-ai-badge{padding:7px 14px;border-radius:999px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);font-size:12.5px;font-weight:600;color:#c7d2e5;}
#hero .nero-ai-btn-row{display:flex;flex-wrap:wrap;gap:12px;}
#hero .nero-ai-btn{display:inline-flex;align-items:center;justify-content:center;padding:14px 24px;border-radius:12px;font-size:14.5px;font-weight:700;text-decoration:none;transition:transform .2s,box-shadow .2s;}
#hero .nero-ai-btn-primary{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff;box-shadow:0 12px 32px rgba(37,99,235,.35);}
#hero .nero-ai-btn-secondary{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.16);color:#e6edf7;}
#hero .nero-ai-btn:hover{transform:translateY(-2px);}
#hero .nero-ai-dashboard{position:relative;}
#hero .nero-ai-dashboard-shell{border-radius:20px;overflow:hidden;background:linear-gradient(165deg,rgba(255,255,255,.09),rgba(255,255,255,.03));border:1px solid rgba(255,255,255,.12);box-shadow:0 28px 72px rgba(0,0,0,.45);}
#hero .nero-ai-window-top{display:flex;align-items:center;gap:12px;padding:12px 16px;background:rgba(0,0,0,.35);border-bottom:1px solid rgba(255,255,255,.08);}
#hero .nero-ai-dots{display:flex;gap:6px;}
#hero .nero-ai-dot{width:10px;height:10px;border-radius:50%;background:rgba(255,255,255,.18);}
#hero .nero-ai-dot:nth-child(1){background:#ff5f57;}
#hero .nero-ai-dot:nth-child(2){background:#febc2e;}
#hero .nero-ai-dot:nth-child(3){background:#28c840;}
#hero .nero-ai-window-title{font-size:12px;font-weight:600;color:#9aa8bd;margin-left:auto;}
#hero .nero-ai-window-body{position:relative;min-height:320px;padding:18px;}
#b24-hero-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;opacity:.55;pointer-events:none;}
#hero .nero-ai-dash-overlay{position:relative;z-index:2;}
#hero .nero-ai-dashboard-title{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;}
#hero .nero-ai-dashboard-title h3{font-size:15px;font-weight:700;color:#fff;margin:0;}
#hero .nero-ai-live-pill{padding:4px 10px;border-radius:999px;background:rgba(34,197,94,.15);border:1px solid rgba(34,197,94,.35);font-size:10px;font-weight:700;color:#4ade80;text-transform:uppercase;letter-spacing:.06em;}
#hero .nero-ai-metrics-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-bottom:14px;}
#hero .nero-ai-metric{padding:10px 8px;border-radius:12px;background:rgba(0,0,0,.35);border:1px solid rgba(255,255,255,.08);text-align:center;}
#hero .nero-ai-metric span{display:block;font-size:9px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:4px;}
#hero .nero-ai-metric strong{display:block;font-size:17px;font-weight:800;color:#fff;line-height:1;}
#hero .nero-ai-metric small{display:block;font-size:9px;color:#64748b;margin-top:3px;}
#hero .nero-ai-task-stream{display:flex;flex-direction:column;gap:8px;}
#hero .nero-ai-task{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:12px;background:rgba(0,0,0,.4);border:1px solid rgba(255,255,255,.08);}
#hero .nero-ai-task-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;color:#0f172a;background:linear-gradient(135deg,#2fc6f6,#38bdf8);flex-shrink:0;}
#hero .nero-ai-task div{flex:1;min-width:0;}
#hero .nero-ai-task strong{display:block;font-size:12.5px;color:#e6edf7;}
#hero .nero-ai-task span{display:block;font-size:10.5px;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
#hero .nero-ai-status{font-size:10px;font-weight:700;padding:3px 8px;border-radius:999px;background:rgba(34,197,94,.15);color:#4ade80;flex-shrink:0;}
#hero .nero-ai-task:nth-child(2) .nero-ai-task-icon{background:linear-gradient(135deg,#8b5cf6,#a78bfa);}
#hero .nero-ai-task:nth-child(3) .nero-ai-task-icon{background:linear-gradient(135deg,#22c55e,#4ade80);}
#hero .nero-ai-task:nth-child(3) .nero-ai-status{background:rgba(47,198,246,.15);color:#2fc6f6;}
@media(max-width:960px){#hero .nero-ai-hero-grid{grid-template-columns:1fr;}#hero .nero-ai-metrics-grid{grid-template-columns:repeat(2,1fr);}}
</style>
    <div class="nero-ai-container nero-ai-hero-grid">
      <div class="nero-ai-hero-copy nero-ai-reveal">
        <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai битрикс24</p>
        <h1 id="hero-bitrix24-title">AI-агент для Битрикс24: <span class="nero-ai-gradient-text">интеграция и настройка под ключ</span></h1>
        <p class="nero-ai-hero-lead">Внедрим AI в ваш Битрикс24 — продажи, задачи, напоминания и контроль сделок без ручной рутины</p>
        <ul class="nero-ai-badges" aria-label="Ключевые возможности">
          <li class="nero-ai-badge">Лиды в CRM</li>
          <li class="nero-ai-badge">Задачи авто</li>
          <li class="nero-ai-badge">Открытые линии</li>
          <li class="nero-ai-badge">Воронка 24/7</li>
        </ul>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
        </div>
      </div>
      <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-агент и Битрикс24">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">Битрикс24 · демо</span>
          </div>
          <div class="nero-ai-window-body">
            <canvas id="b24-hero-canvas" aria-hidden="true" role="presentation"></canvas>
            <div class="nero-ai-dash-overlay">
              <div class="nero-ai-dashboard-title">
                <h3>REST-хаб AI-агента</h3>
                <span class="nero-ai-live-pill">онлайн</span>
              </div>
              <div class="nero-ai-metrics-grid">
                <div class="nero-ai-metric"><span>Лиды</span><strong>24</strong><small>входящих</small></div>
                <div class="nero-ai-metric"><span>Ответ</span><strong>1:42</strong><small>средний</small></div>
                <div class="nero-ai-metric"><span>CRM</span><strong>auto</strong><small>поля</small></div>
                <div class="nero-ai-metric"><span>Рутина</span><strong>−38%</strong><small>меньше</small></div>
              </div>
              <div class="nero-ai-task-stream">
                <div class="nero-ai-task"><span class="nero-ai-task-icon">IN</span><div><strong>Заявка</strong><span>сайт · открытая линия</span></div><span class="nero-ai-status">готово</span></div>
                <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>AI-квалификация</strong><span>скоринг · поля CRM</span></div><span class="nero-ai-status">готово</span></div>
                <div class="nero-ai-task"><span class="nero-ai-task-icon">B24</span><div><strong>Сделка в Б24</strong><span>задача менеджеру</span></div><span class="nero-ai-status">новое</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<script>
(function(){
  var cv=document.getElementById('b24-hero-canvas');
  if(!cv)return;
  var cx=cv.getContext('2d'),W=0,H=0,t=0;
  var B24='#2fc6f6',VIO='#8b5cf6',GRN='#22c55e';
  var nodes=[
    {id:'lead',label:'crm.lead',x:.12,y:.28,color:B24},
    {id:'deal',label:'crm.deal',x:.12,y:.52,color:VIO},
    {id:'task',label:'tasks.*',x:.12,y:.76,color:GRN},
    {id:'hub',label:'AI',x:.5,y:.5,color:'#fff'},
    {id:'f1',label:'Новый',x:.82,y:.22,color:B24},
    {id:'f2',label:'В работе',x:.82,y:.5,color:VIO},
    {id:'f3',label:'Успех',x:.82,y:.78,color:GRN}
  ];
  var packets=[];
  function resize(){
    var b=cv.parentElement.getBoundingClientRect();
    W=b.width;H=b.height;
    cv.width=W*devicePixelRatio;cv.height=H*devicePixelRatio;
    cx.setTransform(devicePixelRatio,0,0,devicePixelRatio,0,0);
  }
  function spawn(){
    var src=nodes[Math.floor(Math.random()*3)];
    var dst=nodes[4+Math.floor(Math.random()*3)];
    packets.push({sx:src.x*W,sy:src.y*H,tx:dst.x*W,ty:dst.y*H,p:0,sp:.006+Math.random()*.008,hubX:nodes[3].x*W,hubY:nodes[3].y*H,col:src.color});
    if(packets.length>18)packets.shift();
  }
  function drawHex(x,y,r,fill,stroke,a){
    cx.save();cx.globalAlpha=a||1;cx.beginPath();
    for(var i=0;i<6;i++){var ang=Math.PI/3*i-Math.PI/6;var px=x+r*Math.cos(ang),py=y+r*Math.sin(ang);i?cx.lineTo(px,py):cx.moveTo(px,py);}
    cx.closePath();if(fill){cx.fillStyle=fill;cx.fill();}if(stroke){cx.strokeStyle=stroke;cx.lineWidth=1.5;cx.stroke();}cx.restore();
  }
  function frame(){
    t++;cx.clearRect(0,0,W,H);
    cx.strokeStyle='rgba(47,198,246,.06)';cx.lineWidth=1;
    for(var g=0;g<W;g+=28){cx.beginPath();cx.moveTo(g,0);cx.lineTo(g,H);cx.stroke();}
    for(var g2=0;g2<H;g2+=28){cx.beginPath();cx.moveTo(0,g2);cx.lineTo(W,g2);cx.stroke();}
    var hub=nodes[3],hx=hub.x*W,hy=hub.y*H;
    var pulse=0.5+0.5*Math.sin(t*.04);
    drawHex(hx,hy,38+pulse*6,'rgba(47,198,246,.12)','rgba(47,198,246,.45)',1);
    drawHex(hx,hy,22,'rgba(139,92,246,.18)','rgba(139,92,246,.5)',1);
    cx.fillStyle='#fff';cx.font='bold 11px Inter,sans-serif';cx.textAlign='center';cx.fillText('REST',hx,hy-4);
    cx.fillStyle=B24;cx.font='9px Inter,sans-serif';cx.fillText('webhook',hx,hy+10);
    nodes.forEach(function(n){
      var x=n.x*W,y=n.y*H,r=n.id==='hub'?0:16;
      if(!r)return;
      cx.beginPath();cx.arc(x,y,r,0,Math.PI*2);
      cx.fillStyle=n.color+'33';cx.fill();
      cx.strokeStyle=n.color;cx.lineWidth=1.5;cx.stroke();
      cx.fillStyle='#c7d2e5';cx.font='8px Inter,sans-serif';cx.textAlign='center';
      cx.fillText(n.label,x,y+r+11);
      cx.beginPath();cx.moveTo(x,y);cx.lineTo(hx,hy);
      cx.strokeStyle='rgba(255,255,255,.08)';cx.lineWidth=1;cx.stroke();
    });
    if(t%25===0)spawn();
    packets.forEach(function(p){
      p.p+=p.sp;
      if(p.p>1)p.p=1;
      var q=p.p<.5?p.p*2:1;
      var u=p.p<.5?0:(p.p-.5)*2;
      var x1=p.sx+(p.hubX-p.sx)*q,y1=p.sy+(p.hubY-p.sy)*q;
      var x2=p.hubX+(p.tx-p.hubX)*u,y2=p.hubY+(p.ty-p.hubY)*u;
      var x=p.p<.5?x1:x2,y=p.p<.5?y1:y2;
      cx.beginPath();cx.arc(x,y,4,0,Math.PI*2);cx.fillStyle=p.col;cx.fill();
      cx.shadowColor=p.col;cx.shadowBlur=8;cx.fill();cx.shadowBlur=0;
    });
    requestAnimationFrame(frame);
  }
  resize();window.addEventListener('resize',resize);frame();
})();
</script>
  </section>

<div class="vna-content">

  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai битрикс24</p>
          <p>Битрикс24 уже стоит у компании. Воронки настроены, открытые линии подключены — но CRM живёт своей жизнью: пустые карточки, потерянные напоминания, лиды между чатами и почтой. <strong>Интеграция AI с Битрикс24</strong> закрывает разрыв: агент квалифицирует лид, создаёт сделку, ставит задачу и отвечает в открытой линии — без ручной рутины.</p>
          <p>Nero Network внедряет AI-агентов <strong>под ключ</strong>: REST API, webhooks, human-in-the-loop и измеримый KPI на каждом сценарии. CoPilot в подписке — хороший старт. Кастомный агент — когда CRM должна работать по <em>вашим</em> правилам, а не по шаблону вендора.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые показатели">
          <div class="vna-kpi-card"><div class="kv">49%</div><div class="kl">CRM №1 в России</div><div class="ks">J'son &amp; Partners, 2026</div></div>
          <div class="vna-kpi-card"><div class="kv">69%</div><div class="kl">ежедневно в CRM</div><div class="ks">J'son &amp; Partners, 2026</div></div>
          <div class="vna-kpi-card"><div class="kv">200–700К</div><div class="kl">проект под ключ</div><div class="ks">ориентир Nero Network</div></div>
          <div class="vna-kpi-card"><div class="kv">5</div><div class="kl">сценариев с KPI</div><div class="ks">старт внедрения</div></div>
        </div>
      </div>
    </div>
  </section>

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
        <a href="#tri-urovnya">CoPilot vs агент</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Аудит</a>
      </nav>
    </div>
  </div>

  <section class="vna-section" id="chto-takoe">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Что это такое</span>
        <h2>Что такое AI-агент для Битрикс24<br>и зачем он нужен</h2>
        <p>AI-агент — программный помощник, подключённый к CRM через REST API, webhooks и бизнес-процессы. Он получает контекст и <strong>выполняет действия</strong> в системе — в отличие от ChatGPT в браузере, который напишет письмо, но не запишет его в таймлайн сделки.</p>
      </div>
      <div class="vna-card nero-ai-reveal" id="kak-rabotaet">
        <h3 style="font-size:20px;margin-bottom:16px;">Как AI-агент работает внутри Битрикс24</h3>
        <div class="vna-timeline">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>1. Триггер</h3><p>Новый лид, входящее письмо, сообщение в открытой линии, просроченная задача или webhook с сайта.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>2. Сбор контекста</h3><p>Агент читает карточку (<code>crm.deal.get</code>, <code>crm.lead.get</code>), историю переписки (<code>imbot.v2.*</code>), таймлайн активностей.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>3. Решение LLM</h3><p>Квалифицировать, ответить клиенту, эскалировать менеджеру, создать задачу, обновить поля.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>4. Действие в CRM</h3><p><code>crm.lead.update</code>, <code>tasks.task.add</code>, <code>crm.activity.add</code>, отправка сообщения в чат.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>5. Контроль</h3><p>При низкой уверенности, крупной сумме сделки или нестандартном запросе агент передаёт кейс человеку с готовой сводкой.</p></div>
        </div>
      </div>
      <div style="margin-top:40px;" id="tri-urovnya">
        <div class="vna-sh vna-left">
          <span class="vna-eyebrow">CoPilot vs агент</span>
          <h2>Три уровня AI для Битрикс24:<br>от CoPilot до агентного</h2>
          <p>CoPilot — быстрый старт. Кастомный агент — когда CRM должна работать по <strong>вашим</strong> правилам.</p>
        </div>
        <div class="vna-table-wrap nero-ai-reveal" style="margin-top:24px;">
          <table class="vna-table" aria-label="Сравнение CoPilot и кастомного AI-агента">
            <thead><tr><th>Критерий</th><th>CoPilot / штатные AI Б24</th><th>Кастомный агент Nero Network</th></tr></thead>
            <tbody>
              <tr><td>Настройка под уникальные БП</td><td>Ограничена шаблонами платформы</td><td>Полная: промты, ветвления, свои поля</td></tr>
              <tr><td>Действия в CRM</td><td>Базовые</td><td>Любые REST-методы: лиды, сделки, ОЛ, БП</td></tr>
              <tr><td>Каналы</td><td>Внутри экосистемы Б24</td><td>Авито, Telegram, email, телефония, сайт</td></tr>
              <tr><td>Модель ИИ</td><td>BitrixGPT (встроенная)</td><td>YandexGPT / Claude / OpenAI — выбор под задачу</td></tr>
              <tr><td>Стоимость входа</td><td>В подписке Б24</td><td>Проект 200–700 тыс. ₽</td></tr>
              <tr><td>Поддержка</td><td>Вендор</td><td>Nero Network: аудит, доработка, обучение</td></tr>
            </tbody>
          </table>
        </div>
        <div class="vna-grid-3 nero-ai-reveal" style="margin-top:28px;">
          <div class="vna-level-card l1"><div class="vna-level-badge">Уровень 1</div><h3>Штатный CoPilot</h3><p>Тексты, резюме переписки, базовые подсказки. BitrixGPT 5.5, Вайбкод, MCP Hub — быстрый старт без разработки.</p></div>
          <div class="vna-level-card l2"><div class="vna-level-badge">Уровень 2</div><h3>REST + webhooks</h3><p><code>crm.lead.*</code>, <code>crm.deal.*</code>, <code>tasks.*</code>, открытые линии. Оркестрация на n8n, Make, Python/FastAPI.</p></div>
          <div class="vna-level-card l3"><div class="vna-level-badge">Уровень 3</div><h3>Агентный MCP</h3><p>Каждое действие — tool. OpenAI Agents SDK, namespace <code>crm</code>, официальный MCP <code>mcp.bitrix24.com</code>.</p></div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="scenarii">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Сценарии автоматизации</span>
        <h2>Что AI-агент делает вместо менеджера:<br>5 ключевых сценариев</h2>
      </div>
      <div class="vna-scenario nero-ai-reveal"><div class="vna-sc-icon" aria-hidden="true">⚡</div><div><h3>Квалификация лидов и создание сделок</h3><p>Входящее письмо, заявка с сайта, сообщение из Авито — агент извлекает намерение, заполняет поля CRM, создаёт сделку и уведомляет ответственного в Telegram.</p></div></div>
      <div class="vna-scenario nero-ai-reveal nero-ai-delay-1"><div class="vna-sc-icon" aria-hidden="true">✅</div><div><h3>Постановка задач и напоминания</h3><p>Агент отслеживает просроченные сделки, пустые поля, отсутствие активности N дней. Ставит задачу менеджеру с контекстом из диалога.</p></div></div>
      <div class="vna-scenario nero-ai-reveal nero-ai-delay-2"><div class="vna-sc-icon" aria-hidden="true">📊</div><div><h3>Контроль сделок и подсказки менеджеру</h3><p>Перед звонком — сводка: история переписки, риски оттока, рекомендация по следующему шагу. После встречи — черновик комментария в таймлайн.</p></div></div>
      <div class="vna-scenario nero-ai-reveal nero-ai-delay-1"><div class="vna-sc-icon" aria-hidden="true">💬</div><div><h3>Ответы в чатах и открытых линиях</h3><p>Сообщение → webhook → LLM ведёт диалог по базе знаний → создаёт карточку без дублей → подключает менеджера на готовом лиде. Кейс «Петродом»: время обработки лидов ×5 быстрее.</p></div></div>
      <div class="vna-scenario nero-ai-reveal nero-ai-delay-2"><div class="vna-sc-icon" aria-hidden="true">📈</div><div><h3>Сводки и отчёты по воронке</h3><p>Раз в день агент формирует сводку: лиды без ответа, зависшие сделки, просевшие конверсии — с предложением действий.</p></div></div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-scenarii">
      <div class="ym-cta-block__icon" aria-hidden="true">🤖</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Какие сценарии AI дадут эффект в вашем Битрикс24?</p>
        <p class="ym-cta-block__sub">Разберём вашу воронку и покажем, какие 2–3 из пяти сценариев дадут максимальный эффект. Бесплатный аудит — за 3–5 рабочих дней.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn">Получить аудит Битрикс24</a>
      </div>
    </div>
  </div>

  <section class="vna-section" id="komu-nuzhno">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Целевая аудитория</span>
        <h2>Кому нужна интеграция AI с Битрикс24</h2>
      </div>
      <div class="vna-grid-3">
        <div class="vna-card nero-ai-reveal"><div class="vna-eyebrow">Поток лидов</div><h3>Отдел продаж</h3><p>Если лиды приходят из сайта, рекламы, мессенджеров и маркетплейсов одновременно — агент закрывает «мёртвые часы» и первичную квалификацию.</p></div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1"><div class="vna-eyebrow">Ручные процессы</div><h3>Операции в CRM</h3><p>Длинные цепочки согласований, смарт-процессы, контроль качества. Кейс дистрибьютора: YandexGPT в 20+ бизнес-процессах.</p></div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-2"><div class="vna-eyebrow">SMB</div><h3>Растущий бизнес на Б24</h3><p>При штате 5–15 менеджеров один агент заменяет рутину оператора и аналитика: сортировка почты, напоминания, первичные ответы. Масштабируется на несколько воронок без роста ФОТ.</p></div>
      </div>
      <p class="nero-ai-reveal vna-related-links" style="text-align:center;margin-top:28px;font-size:14.5px;">Уже внедряли AI в другую CRM? Сравните с <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-amocrm/' ) ); ?>" class="vna-inline-cta">AI-агентом для amoCRM</a> — та же агентная логика, другая платформа.</p>
    </div>
  </section>

  <!-- ================================================
       БОРИС: архитектура агента — после #komu-nuzhno
       ================================================ -->
  <section id="boris-bitrix24-viz" class="bbi-root" aria-label="Архитектура AI-агента для Битрикс24: триггер, контекст, LLM, REST, эскалация">
<style>
/* === БОРИС: prefix bbi-, scoped внутри #boris-bitrix24-viz === */
.bbi-root{padding:60px 0 72px;background:#f0f4fb;}
.bbi-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
.bbi-card{
  display:grid;
  grid-template-columns:44% 56%;
  border-radius:24px;
  overflow:hidden;
  box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(47,198,246,.18);
  min-height:500px;
}
@media(max-width:960px){.bbi-card{grid-template-columns:1fr;min-height:auto;}}
.bbi-lft{
  background:#ffffff;
  padding:44px 38px;
  display:flex;
  flex-direction:column;
  justify-content:center;
}
@media(max-width:600px){.bbi-lft{padding:30px 22px;}}
.bbi-ey{
  display:inline-flex;align-items:center;gap:7px;
  font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;
  color:#0e7490;margin:0 0 14px;
}
.bbi-ey::before{content:'';display:inline-block;width:20px;height:2px;background:#2fc6f6;border-radius:1px;}
.bbi-h3{font-size:24px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 20px;}
@media(max-width:600px){.bbi-h3{font-size:20px;}}
.bbi-steps{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
.bbi-steps li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
.bbi-num{
  flex-shrink:0;width:24px;height:24px;border-radius:50%;
  background:rgba(47,198,246,.12);color:#0891b2;
  display:flex;align-items:center;justify-content:center;
  font-size:11px;font-weight:800;margin-top:1px;
}
.bbi-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;}
.bbi-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
.bbi-pl-b{background:rgba(47,198,246,.1);color:#0e7490;border:1.5px solid rgba(47,198,246,.28);}
.bbi-pl-o{background:rgba(255,102,51,.08);color:#c2410c;border:1.5px solid rgba(255,102,51,.22);}
.bbi-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
.bbi-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
.bbi-rgt{
  background:linear-gradient(145deg,#07091a 0%,#0a1220 55%,#080d18 100%);
  position:relative;overflow:hidden;min-height:420px;
}
@media(max-width:960px){.bbi-rgt{min-height:360px;}}
#bbi-agent-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="bbi-cnt">
<div class="bbi-card">
  <div class="bbi-lft">
    <span class="bbi-ey">Архитектура агента</span>
    <h3 class="bbi-h3">Пять шагов: от webhook до действия в CRM — с эскалацией человеку</h3>
    <ol class="bbi-steps">
      <li><span class="bbi-num">1</span><span><strong>Триггер</strong> — лид, письмо, открытая линия или просроченная задача</span></li>
      <li><span class="bbi-num">2</span><span><strong>Контекст</strong> — <code>crm.deal.get</code>, история чата, таймлайн</span></li>
      <li><span class="bbi-num">3</span><span><strong>LLM</strong> — квалификация, ответ, решение о следующем шаге</span></li>
      <li><span class="bbi-num">4</span><span><strong>REST</strong> — <code>crm.lead.update</code>, <code>tasks.task.add</code>, активности</span></li>
      <li><span class="bbi-num">5</span><span><strong>Контроль</strong> — human-in-the-loop при низкой уверенности</span></li>
    </ol>
    <div class="bbi-pills">
      <span class="bbi-pl bbi-pl-b">REST API Б24</span>
      <span class="bbi-pl bbi-pl-o">MCP Hub 2026</span>
      <span class="bbi-pl bbi-pl-g">24/7 очередь</span>
    </div>
    <p class="bbi-foot">Дальше — технический стек и методы интеграции →</p>
  </div>
  <div class="bbi-rgt">
    <canvas id="bbi-agent-canvas" aria-label="Анимация: поток данных AI-агента через REST API Битрикс24" role="img"></canvas>
  </div>
</div>
</div>

<script>
(function(){
  var cv=document.getElementById('bbi-agent-canvas');
  if(!cv)return;
  var cx=cv.getContext('2d'),W=0,H=0,t=0;

  function resize(){
    var p=cv.parentElement;if(!p)return;
    cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;
    W=cv.width;H=cv.height;
  }
  window.addEventListener('resize',resize);resize();

  var CYAN='#2fc6f6',ORNG='#ff6633',GREEN='#4ade80',VIOL='#a78bfa';
  var NODES=[
    {id:0,label:'Триггер',sub:'webhook',x:0.10,color:ORNG},
    {id:1,label:'Контекст',sub:'crm.*.get',x:0.28,color:CYAN},
    {id:2,label:'LLM',sub:'YandexGPT / Claude',x:0.50,color:VIOL},
    {id:3,label:'REST',sub:'crm.lead.update',x:0.72,color:CYAN},
    {id:4,label:'Эскалация',sub:'human loop',x:0.90,color:GREEN}
  ];
  var packets=[];

  function rr(x,y,w,h,r,fill,stroke,lw){
    cx.beginPath();
    if(cx.roundRect)cx.roundRect(x,y,w,h,r);
    else{cx.moveTo(x+r,y);cx.arcTo(x+w,y,x+w,y+h,r);cx.arcTo(x+w,y+h,x,y+h,r);cx.arcTo(x,y+h,x,y,r);cx.arcTo(x,y,x+w,y,r);cx.closePath();}
    if(fill){cx.fillStyle=fill;cx.fill();}
    if(stroke){cx.strokeStyle=stroke;cx.lineWidth=lw||1.5;cx.stroke();}
  }

  function nodePos(n){return{x:n.x*W,y:H*0.52,r:34};}

  function spawnPacket(){
    if(packets.length>6)return;
    packets.push({seg:0,prog:0,speed:0.012+Math.random()*0.008});
  }

  function drawGrid(){
    cx.strokeStyle='rgba(255,255,255,.04)';cx.lineWidth=1;
    for(var gx=0;gx<W;gx+=28){cx.beginPath();cx.moveTo(gx,0);cx.lineTo(gx,H);cx.stroke();}
    for(var gy=0;gy<H;gy+=28){cx.beginPath();cx.moveTo(0,gy);cx.lineTo(W,gy);cx.stroke();}
  }

  function drawHeader(){
    cx.fillStyle='#e2e8f0';cx.font='bold 12px Inter,system-ui,sans-serif';cx.textAlign='left';
    cx.fillText('Битрикс24 · архитектура AI-агента',16,24);
    var pulse=8+Math.sin(t*0.08)*3;
    cx.beginPath();cx.arc(W-70,20,pulse,0,Math.PI*2);
    cx.fillStyle='rgba(47,198,246,'+(0.12+0.08*Math.sin(t*0.08))+')';cx.fill();
    cx.beginPath();cx.arc(W-70,20,4,0,Math.PI*2);cx.fillStyle=CYAN;cx.fill();
    cx.fillStyle=CYAN;cx.font='10px Inter,sans-serif';cx.fillText('agent live',W-58,24);
    cx.strokeStyle='rgba(255,255,255,.08)';cx.beginPath();cx.moveTo(0,36);cx.lineTo(W,36);cx.stroke();
  }

  function drawEdges(){
    cx.lineWidth=2;
    for(var i=0;i<NODES.length-1;i++){
      var a=nodePos(NODES[i]),b=nodePos(NODES[i+1]);
      var grad=cx.createLinearGradient(a.x,a.y,b.x,b.y);
      grad.addColorStop(0,NODES[i].color);grad.addColorStop(1,NODES[i+1].color);
      cx.strokeStyle=grad;cx.globalAlpha=0.35;
      cx.beginPath();cx.moveTo(a.x+36,a.y);cx.lineTo(b.x-36,b.y);cx.stroke();
      cx.globalAlpha=1;
      var dash=(t*1.2+i*40)%24;
      cx.setLineDash([6,10]);cx.lineDashOffset=-dash;
      cx.strokeStyle='rgba(255,255,255,.18)';cx.lineWidth=1;
      cx.beginPath();cx.moveTo(a.x+36,a.y);cx.lineTo(b.x-36,b.y);cx.stroke();
      cx.setLineDash([]);
    }
  }

  function drawNodes(){
    NODES.forEach(function(n,idx){
      var p=nodePos(n);
      var glow=n.color.replace(')',',0.18)').replace('rgb','rgba').replace('#','');
      if(n.color[0]==='#'){
        var r=parseInt(n.color.slice(1,3),16),g=parseInt(n.color.slice(3,5),16),b=parseInt(n.color.slice(5,7),16);
        glow='rgba('+r+','+g+','+b+',0.15)';
      }
      cx.beginPath();cx.arc(p.x,p.y,42+Math.sin(t*0.05+idx)*2,0,Math.PI*2);
      cx.fillStyle=glow;cx.fill();
      rr(p.x-34,p.y-34,68,68,16,'rgba(255,255,255,.06)',n.color,2);
      if(idx===2){
        for(var d=0;d<3;d++){
          var ang=(d/3)*Math.PI*2+t*0.06;
          cx.beginPath();cx.arc(p.x+Math.cos(ang)*14,p.y+Math.sin(ang)*14,3,0,Math.PI*2);
          cx.fillStyle=VIOL;cx.fill();
        }
      }
      cx.fillStyle='#f8fafc';cx.font='bold 11px Inter,sans-serif';cx.textAlign='center';
      cx.fillText(n.label,p.x,p.y-2);
      cx.fillStyle='rgba(226,232,240,.55)';cx.font='9px Inter,sans-serif';
      cx.fillText(n.sub,p.x,p.y+12);
    });
  }

  function drawPackets(){
    packets.forEach(function(pk){
      pk.prog+=pk.speed;
      if(pk.prog>=1){pk.seg++;pk.prog=0;}
      if(pk.seg>=NODES.length-1){pk.dead=true;return;}
      var a=nodePos(NODES[pk.seg]),b=nodePos(NODES[pk.seg+1]);
      var x=a.x+36+(b.x-a.x-72)*pk.prog;
      var y=a.y+Math.sin(pk.prog*Math.PI)*-8;
      cx.beginPath();cx.arc(x,y,5,0,Math.PI*2);
      cx.fillStyle=NODES[pk.seg+1].color;cx.fill();
      cx.beginPath();cx.arc(x,y,10,0,Math.PI*2);
      cx.fillStyle='rgba(255,255,255,.12)';cx.fill();
    });
    packets=packets.filter(function(p){return!p.dead;});
  }

  function drawFooter(){
    var barY=H-32;
    cx.strokeStyle='rgba(255,255,255,.07)';cx.beginPath();cx.moveTo(0,barY);cx.lineTo(W,barY);cx.stroke();
    cx.fillStyle='rgba(226,232,240,.45)';cx.font='10px Inter,sans-serif';cx.textAlign='left';
    cx.fillText('OpenAI Agents SDK · namespace crm · HostedMCPTool · mcp.bitrix24.com',14,barY+18);
  }

  function loop(){
    t++;
    if(t%45===0)spawnPacket();
    cx.clearRect(0,0,W,H);
    drawGrid();drawHeader();drawEdges();drawNodes();drawPackets();drawFooter();
    requestAnimationFrame(loop);
  }
  document.fonts.ready.then(function(){loop();});
})();
</script>
</section>

  <section class="vna-section" id="stek">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">REST API</span>
        <h2>Технический стек: как мы строим<br>AI-агента для Битрикс24</h2>
      </div>
      <div class="vna-card nero-ai-reveal">
        <h3 style="font-size:19px;margin-bottom:14px;">REST API Битрикс24 (crm.lead, crm.deal, tasks, im)</h3>
        <ul>
          <li><strong>CRM:</strong> <code>crm.lead.add/update/get</code>, <code>crm.deal.add/update</code>, смарт-процессы</li>
          <li><strong>Задачи:</strong> <code>tasks.task.add</code>, напоминания, чек-листы</li>
          <li><strong>Коммуникации:</strong> <code>imbot.v2.*</code>, открытые линии, CRM Mail</li>
          <li><strong>Активности:</strong> <code>crm.activity.add</code> — звонки, письма, встречи в таймлайне</li>
        </ul>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:20px;">
        <h3 style="font-size:19px;margin-bottom:10px;">Webhooks, Make/n8n, OpenAI / Claude</h3>
        <p>Триггеры — исходящие webhooks Битрикс24. Оркестрация — n8n или Make для SMB, Python/FastAPI для сложных сценариев. LLM: YandexGPT, GigaChat, OpenAI/Claude. Официальный MCP: <code>https://mcp.bitrix24.com/mcp/</code>.</p>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:20px;">
        <h3 style="font-size:19px;margin-bottom:10px;">Безопасность и права доступа</h3>
        <p>OAuth-токены, права по ролям, YandexGPT/GigaChat для ПДн, коробка или on-premise LLM. Human-in-the-loop: эскалация при низкой уверенности, логи каждого действия в CRM.</p>
      </div>
      <p class="nero-ai-reveal vna-related-links" style="margin-top:24px;font-size:14.5px;color:var(--vna-text-muted,#64748b);">При проектировании LLM-слоя ориентируйтесь на корпоративные практики: <a href="<?php echo esc_url( home_url( '/kpmg-claude-vnedrenie-ai-276-tysyach/' ) ); ?>" class="vna-inline-cta">кейс KPMG и Claude для 276&nbsp;000 сотрудников</a> — managed agents, human-in-the-loop и безопасность данных на масштабе.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Реальные результаты</span>
        <h2>Кейсы: реальные результаты<br>внедрения AI в Битрикс24</h2>
      </div>
      <div class="vna-case-grid">
        <div class="vna-case-card nero-ai-reveal"><div class="vna-case-tag">Off Group</div><h3>Дистрибьютор: 20+ БП с YandexGPT</h3><p>Администраторы редактируют промты без разработчиков; сценарии «анализ отказа», нормализация адресов.</p></div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-1"><div class="vna-case-tag">Петродом</div><h3>n8n + AI, лиды с Авито</h3><p>Время обработки лидов сократилось в <strong>5 раз</strong>; менеджер подключается на готовой карточке.</p></div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-2"><div class="vna-case-tag">vc.ru</div><h3>Квалификация лидов из почты</h3><p>n8n + OpenAI, webhook, классификация намерения, автоматическая маршрутизация и обновление лида.</p></div>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-keisy">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите похожий результат в своём Битрикс24?</p>
        <p class="ym-cta-block__sub">Кейсы Off Group, vc.ru и международные ориентиры — та же архитектура: REST, webhooks, human-in-the-loop. Следующий пилот может быть вашим.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent">Получить аудит Битрикс24</a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
        </div>
      </div>
    </div>
  </div>

  <section class="vna-section" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Процесс</span>
        <h2>Как проходит внедрение AI в Битрикс24:<br>5 этапов</h2>
      </div>
      <div class="vna-timeline nero-ai-reveal">
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Аудит процессов и CRM</h3><p>3–5 рабочих дней. Карта из 3–5 сценариев с KPI и приоритетом запуска.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Проектирование сценариев агента</h3><p>Промты, ветвления, правила эскалации, база знаний, few-shot примеры переписок.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Интеграция и настройка</h3><p>Function tools → REST Битрикс24, webhooks, n8n/Make, тестовый портал.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Пилот и обучение команды</h3><p>2–4 недели на одной воронке. Команда учится подтверждать действия агента, а не дублировать его рутину. Для самостоятельного погружения можно начать с <a href="<?php echo esc_url($secondary_cta_url); ?>" class="vna-inline-cta"><?php echo esc_html($secondary_cta_label); ?></a> — параллельно с проектом под ключ от Nero Network.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Масштабирование и поддержка</h3><p>Новые каналы, сценарии, филиалы. Сопровождение: лимиты API, обновление моделей.</p></div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="ceny">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Инвестиции</span>
        <h2>Стоимость внедрения AI в Битрикс24</h2>
        <p>Коридор <strong>200–700 тыс. ₽</strong> — с полным циклом: аудит, разработка, пилот, обучение, документация. Ориентир рынка: AI-боты в Битрикс24 у конкурентов — от 190 000 ₽ без полного цикла сопровождения.</p>
      </div>
      <div class="vna-card nero-ai-reveal vna-featured" style="max-width:720px;margin:0 auto;">
        <h3 style="font-size:20px;margin-bottom:14px;">Что входит в «под ключ»</h3>
        <ul>
          <li>Аудит Битрикс24 и карта автоматизации</li>
          <li>3–5 рабочих AI-сценариев с KPI</li>
          <li>Интеграция REST + webhooks + оркестратор</li>
          <li>Пилот на одной воронке</li>
          <li>Обучение администраторов и менеджеров</li>
          <li>30 дней сопровождения после запуска</li>
          <li>Документация промтов и регламент эскалации</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="vna-section" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Вопрос — ответ</span>
        <h2>FAQ: интеграция AI-агента с Битрикс24</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI в Битрикс24?</div><div class="vna-faq-a"><p>Начните с аудита: какие 3–5 процессов дают максимум ручной работы. Запустите пилот на одном канале. Nero Network проводит внедрение под ключ — от аудита до масштабирования.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Чем кастомный агент отличается от CoPilot?</div><div class="vna-faq-a"><p>CoPilot генерирует текст и базовые подсказки. Кастомный агент выполняет действия в CRM по вашим правилам, работает с внешними каналами и масштабируется на десятки бизнес-процессов.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает внедрение?</div><div class="vna-faq-a"><p>Аудит — 3–5 дней. Пилот одного сценария — 2–4 недели. Полное внедрение с несколькими каналами — 1,5–3 месяца.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Нужны ли программисты на стороне клиента?</div><div class="vna-faq-a"><p>Нет для типовых сценариев на n8n. Для сложных смарт-процессов достаточно администратора Битрикс24. Разработку берёт Nero Network.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Безопасны ли данные при интеграции?</div><div class="vna-faq-a"><p>OAuth-токены, права по ролям, YandexGPT/GigaChat для ПДн, коробка или on-premise LLM. Каждое действие агента логируется в CRM.</p></div></div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-cta-final" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="vna-cnt vna-sh" style="text-align:center;">
      <span class="vna-eyebrow">Бесплатный аудит</span>
      <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:760px;">Битрикс24 — CRM №1 в России.<br>AI-агент — дисциплина CRM без рутины</h2>
      <p style="max-width:620px;margin:0 auto 16px;font-size:16px;">CoPilot и MCP Hub — шаг вперёд. Но если сотрудники по-прежнему не заполняют карточки, а лиды теряются между чатами и почтой — нужен <strong>ai агент битрикс</strong>, который работает по правилам вашего бизнеса.</p>
      <p class="vna-cta-lead-magnet"><strong>Лид-магнит: Чек-лист AI-возможностей Битрикс24</strong> — 25 пунктов при заявке на аудит</p>
      <ul class="vna-cta-checklist" aria-label="Чек-лист AI-возможностей Битрикс24">
        <li>CoPilot: тексты и резюме переписки</li>
        <li>CoPilot: задачи по запросу</li>
        <li>CoPilot: CRM Mail</li>
        <li>BitrixGPT 5.5 в подписке</li>
        <li>MCP Hub и mcp.bitrix24.com</li>
        <li>Штатные AI-агенты Б24</li>
        <li>Ограничения шаблонных сценариев</li>
        <li>Кастом: crm.lead.* REST</li>
        <li>Кастом: crm.deal.* REST</li>
        <li>Кастом: tasks.task.add</li>
        <li>Открытые линии + imbot.v2</li>
        <li>Webhooks на новый лид</li>
        <li>Квалификация лидов 24/7</li>
        <li>Автозаполнение полей CRM</li>
        <li>Напоминания по просрочкам</li>
        <li>Подсказки менеджеру перед звонком</li>
        <li>Ответы в чатах по базе знаний</li>
        <li>Human-in-the-loop эскалация</li>
        <li>YandexGPT / GigaChat под 152-ФЗ</li>
        <li>n8n / Make для SMB</li>
        <li>Python/FastAPI для нагрузки</li>
        <li>Пилот на одной воронке</li>
        <li>KPI: скорость ответа</li>
        <li>KPI: заполнение CRM</li>
        <li>Ориентир бюджета 200–700К</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;">Получить аудит Битрикс24</a>
      <p class="vna-cta-footnote">За 3–5 дней покажем, какие процессы автоматизировать первыми и какой бюджет заложить на пилот. Nero Network — <strong>внедрение ai в бизнес</strong> через CRM, которую вы уже используете. Без смены платформы.</p>
    </div>
  </section>

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
      if(!isOpen){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
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
$nero_schema_site = trailingslashit( home_url( '/' ) );
$nero_schema_page = trailingslashit( home_url( '/integratsiya-ai-agenta-s-bitriks24/' ) );
$nero_schema_org  = $nero_schema_site . '#organization';
$nero_schema_web  = $nero_schema_site . '#website';
$nero_schema_ld   = array(
	'@context' => 'https://schema.org',
	'@graph'   => array(
		array(
			'@type' => 'Organization',
			'@id'   => $nero_schema_org,
			'name'  => 'Nero Network',
			'url'   => untrailingslashit( $nero_schema_site ),
		),
		array(
			'@type'     => 'WebSite',
			'@id'       => $nero_schema_web,
			'url'       => untrailingslashit( $nero_schema_site ),
			'name'      => 'Nero Network',
			'publisher' => array( '@id' => $nero_schema_org ),
		),
		array(
			'@type'       => 'WebPage',
			'@id'         => $nero_schema_page . '#webpage',
			'url'         => $nero_schema_page,
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'isPartOf'    => array( '@id' => $nero_schema_web ),
			'about'       => array( '@id' => $nero_schema_org ),
		),
		array(
			'@type'           => 'BreadcrumbList',
			'@id'             => $nero_schema_page . '#breadcrumb',
			'itemListElement' => array(
				array(
					'@type'    => 'ListItem',
					'position' => 1,
					'name'     => 'Главная',
					'item'     => untrailingslashit( $nero_schema_site ),
				),
				array(
					'@type'    => 'ListItem',
					'position' => 2,
					'name'     => $page_seo_title,
					'item'     => $nero_schema_page,
				),
			),
		),
		array(
			'@type'        => 'Service',
			'@id'          => $nero_schema_page . '#service',
			'name'         => $page_seo_title,
			'description'  => $page_seo_description,
			'url'          => $nero_schema_page,
			'provider'     => array( '@id' => $nero_schema_org ),
		),
		array(
			'@type'      => 'FAQPage',
			'@id'        => $nero_schema_page . '#faq',
			'mainEntity' => array(
				array(
					'@type'          => 'Question',
					'name'           => 'Как внедрить AI в Битрикс24?',
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => 'Начните с аудита: какие 3–5 процессов дают максимум ручной работы. Запустите пилот на одном канале. Nero Network проводит внедрение под ключ — от аудита до масштабирования.',
					),
				),
				array(
					'@type'          => 'Question',
					'name'           => 'Чем кастомный агент отличается от CoPilot?',
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => 'CoPilot генерирует текст и базовые подсказки. Кастомный агент выполняет действия в CRM по вашим правилам, работает с внешними каналами и масштабируется на десятки бизнес-процессов.',
					),
				),
				array(
					'@type'          => 'Question',
					'name'           => 'Сколько времени занимает внедрение?',
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => 'Аудит — 3–5 дней. Пилот одного сценария — 2–4 недели. Полное внедрение с несколькими каналами — 1,5–3 месяца.',
					),
				),
				array(
					'@type'          => 'Question',
					'name'           => 'Нужны ли программисты на стороне клиента?',
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => 'Нет для типовых сценариев на n8n. Для сложных смарт-процессов достаточно администратора Битрикс24. Разработку берёт Nero Network.',
					),
				),
				array(
					'@type'          => 'Question',
					'name'           => 'Безопасны ли данные при интеграции?',
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => 'OAuth-токены, права по ролям, YandexGPT/GigaChat для ПДн, коробка или on-premise LLM. Каждое действие агента логируется в CRM.',
					),
				),
			),
		),
	),
);
?>
<script type="application/ld+json">
<?php echo wp_json_encode( $nero_schema_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?>
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

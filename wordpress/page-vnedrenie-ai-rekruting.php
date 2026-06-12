<?php
/**
 * Template Name: AI-рекрутинг: скрининг резюме и первичный отбор под ключ
 * Description: SEO-лендинг — внедрение AI-рекрутинга: скрининг резюме, интеграция с ATS, 152-ФЗ. Тестовый разбор 30 резюме.
 */

$page_seo_title       = 'AI-рекрутинг под ключ: скрининг резюме и первичный отбор';
$page_seo_description = 'Внедряем AI-рекрутинг под ключ: нейросеть сортирует резюме и готовит вопросы для интервью. Экономия часов HR, интеграция с ATS. Тестовый разбор 30 резюме.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы',       'href' => '#etapy'],
    ['label' => 'Доверие',     'href' => '#doverie'],
    ['label' => 'Кейсы',       'href' => '#keisy'],
    ['label' => 'Стоимость',   'href' => '#ceny'],
    ['label' => 'FAQ',         'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить резюме AI';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';
$secondary_cta_attrs = nero_ai_external_link_attrs($secondary_cta_url);

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
</style>
/* Secondary CTA (Artur) */
.vna-secondary-cta{
  font-size:15px;color:var(--vna-muted);line-height:1.72;
  margin:28px 0 0;padding:18px 22px;
  background:rgba(255,255,255,.04);
  border-left:3px solid var(--vna-violet);
  border-radius:0 12px 12px 0;
}
.vna-secondary-cta a{color:var(--vna-accent);text-decoration:underline;}
.vna-callout{
  background:rgba(251,191,36,.08);border:1px solid rgba(251,191,36,.25);
  border-radius:var(--vna-r);padding:20px 24px;margin:24px 0;
}
.vna-callout p{margin:0;font-size:14.5px;}
.vna-pipeline{display:grid;gap:14px;margin:24px 0;}
.vna-pipe-step{
  display:flex;gap:16px;align-items:flex-start;
  padding:18px 20px;background:rgba(255,255,255,.05);
  border:1px solid rgba(255,255,255,.09);border-radius:14px;
}
.vna-pipe-num{
  flex-shrink:0;width:32px;height:32px;border-radius:50%;
  background:rgba(121,242,255,.15);color:var(--vna-accent);
  font-weight:800;font-size:14px;display:flex;align-items:center;justify-content:center;
}
.vna-pipe-step h4{margin:0 0 6px;font-size:16px;color:#fff;}
.vna-pipe-step p{margin:0;font-size:14px;}
.vna-roi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
@media(max-width:768px){.vna-roi-grid{grid-template-columns:1fr;}}
.vna-roi-card{
  text-align:center;padding:28px 20px;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);
  border-radius:18px;
}
.vna-roi-card .num{font-size:clamp(28px,3vw,40px);font-weight:900;color:var(--vna-accent);letter-spacing:-.04em;}
.vna-roi-card .lbl{font-size:13px;color:var(--vna-muted);margin-top:8px;line-height:1.5;}
.vna-segment-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
@media(max-width:768px){.vna-segment-grid{grid-template-columns:1fr;}}
</style>


<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-rekruting-page" role="main" tabindex="-1">

<style>
/* ── Hero AI-рекрутинг: самодостаточные стили (без CSS темы) ── */
.vnr-hero-rekruting {
  --vnr-cyan: #79f2ff;
  --vnr-violet: #8b5cf6;
  --vnr-green: #22c55e;
  --vnr-amber: #fbbf24;
  --vnr-text: #e6edf7;
  --vnr-muted: #9aa8bd;
  --vnr-soft: #c7d2e5;
  --vnr-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnr-hero-rekruting.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  color: var(--vnr-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
.vnr-hero-rekruting::before {
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
  z-index: -2;
}
.vnr-hero-rekruting::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(34, 197, 94, .11), rgba(121, 242, 255, .08) 40%, transparent 66%);
  filter: blur(6px);
  animation: vnrHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnrHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vnr-hero-rekruting .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnr-hero-rekruting .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnr-hero-rekruting .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(40px, 6.8vw, 88px);
  line-height: .92;
  letter-spacing: -0.07em;
  color: #fff;
  font-weight: 800;
}
.vnr-hero-rekruting .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #fff 0%, var(--vnr-cyan) 42%, var(--vnr-violet) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.vnr-hero-rekruting .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  border-radius: 999px;
  background: rgba(121, 242, 255, .08);
  border: 1px solid rgba(121, 242, 255, .22);
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--vnr-cyan);
  margin: 0 0 16px;
}
.vnr-hero-rekruting .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--vnr-soft) !important;
  font-size: clamp(17px, 2vw, 22px);
  line-height: 1.58;
}
.vnr-hero-rekruting .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 24px 0 0;
  padding: 0;
  list-style: none;
}
.vnr-hero-rekruting .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 12px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
  white-space: nowrap;
}
.vnr-hero-rekruting .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 32px;
}
.vnr-hero-rekruting .nero-ai-btn {
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
.vnr-hero-rekruting .nero-ai-btn-primary {
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  color: #fff !important;
  box-shadow: 0 12px 32px rgba(37, 99, 235, .35);
}
.vnr-hero-rekruting .nero-ai-btn-secondary {
  border: 1px solid rgba(255,255,255,.18);
  background: rgba(255,255,255,.06);
  color: var(--vnr-text) !important;
}
.vnr-hero-rekruting .nero-ai-btn:hover { transform: translateY(-2px); }

.vnr-hero-rekruting .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnr-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnr-hero-rekruting .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnr-hero-rekruting .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnr-hero-rekruting .nero-ai-dots { display: flex; gap: 7px; }
.vnr-hero-rekruting .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnr-hero-rekruting .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnr-hero-rekruting .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnr-hero-rekruting .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnr-hero-rekruting .nero-ai-window-title {
  font-size: 11px;
  font-weight: 600;
  color: var(--vnr-muted);
  letter-spacing: .02em;
}
.vnr-hero-rekruting .nero-ai-window-body { padding: 16px; }
.vnr-hero-rekruting .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.vnr-hero-rekruting .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 15px;
  font-weight: 700;
  color: #fff;
}
.vnr-hero-rekruting .nero-ai-live-pill {
  padding: 4px 10px;
  border-radius: 999px;
  background: rgba(34, 197, 94, .15);
  border: 1px solid rgba(34, 197, 94, .35);
  color: #86efac;
  font-size: 11px;
  font-weight: 700;
}
.vnr-hero-rekruting .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 8px;
  margin-bottom: 12px;
}
.vnr-hero-rekruting .nero-ai-metric {
  padding: 10px 8px;
  border-radius: 14px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.08);
  text-align: center;
}
.vnr-hero-rekruting .nero-ai-metric span {
  display: block;
  font-size: 9px;
  color: var(--vnr-muted);
  text-transform: uppercase;
  letter-spacing: .06em;
}
.vnr-hero-rekruting .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  font-size: 18px;
  color: #fff;
  line-height: 1;
}
.vnr-hero-rekruting .nero-ai-metric small {
  display: block;
  margin-top: 2px;
  font-size: 9px;
  color: var(--vnr-muted);
}
.vnr-hero-rekruting .vnr-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  background: radial-gradient(ellipse at 50% 40%, rgba(34,197,94,.08), rgba(15,23,42,.6) 70%);
  border: 1px solid rgba(255,255,255,.06);
}
.vnr-hero-rekruting #vnr-hr-screening-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnr-hero-rekruting .nero-ai-task-stream { display: flex; flex-direction: column; gap: 8px; }
.vnr-hero-rekruting .nero-ai-task {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.07);
  font-size: 12px;
}
.vnr-hero-rekruting .nero-ai-task-icon {
  flex-shrink: 0;
  width: 28px;
  height: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  background: rgba(121, 242, 255, .12);
  color: var(--vnr-cyan);
  font-size: 10px;
  font-weight: 800;
}
.vnr-hero-rekruting .nero-ai-task div { flex: 1; min-width: 0; }
.vnr-hero-rekruting .nero-ai-task strong { display: block; color: #fff; font-size: 12px; }
.vnr-hero-rekruting .nero-ai-task span { display: block; color: var(--vnr-muted); font-size: 11px; margin-top: 2px; }
.vnr-hero-rekruting .nero-ai-status {
  flex-shrink: 0;
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34, 197, 94, .15);
  color: #86efac;
  font-size: 10px;
  font-weight: 700;
}
.vnr-hero-rekruting .nero-ai-status--new {
  background: rgba(251, 191, 36, .15);
  color: #fde68a;
}
@media (max-width: 960px) {
  .vnr-hero-rekruting .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnr-hero-rekruting .nero-ai-dashboard { transform: none; }
  .vnr-hero-rekruting .nero-ai-metrics-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>

<section class="nero-ai-hero vnr-hero-rekruting" id="hero" aria-labelledby="vnr-hero-rekruting-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai рекрутинг</p>
      <h1 id="vnr-hero-rekruting-title">AI-рекрутинг: <span class="nero-ai-gradient-text">скрининг резюме и первичный отбор под ключ</span></h1>
      <p class="nero-ai-hero-lead">Внедрим AI, который сортирует резюме и готовит вопросы для интервью — HR перестаёт тратить часы на неподходящих кандидатов</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Скоринг резюме</li>
        <li class="nero-ai-badge">Вопросы к интервью</li>
        <li class="nero-ai-badge">152-ФЗ</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Проверить резюме AI'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-скрининг резюме">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>HR · скрининг резюме · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Отклики</span><strong>187</strong><small>на вакансию</small></div>
            <div class="nero-ai-metric"><span>Скоринг</span><strong>4 мин</strong><small>весь поток</small></div>
            <div class="nero-ai-metric"><span>Shortlist</span><strong>12</strong><small>топ кандидаты</small></div>
            <div class="nero-ai-metric"><span>Экономия</span><strong>−68%</strong><small>часов HR</small></div>
          </div>

          <div class="vnr-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnr-hr-screening-canvas" role="img" aria-label="Анимация: резюме по каскаду проходят AI-скоринг и попадают в shortlist с вопросами к интервью"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий скрининга">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CV</span>
              <div><strong>Импорт резюме</strong><span>hh.ru + ATS · 187 откликов</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Скоринг 0–100 + explain</strong><span>gaps, red flags, веса JD</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">HR</span>
              <div><strong>7 вопросов к интервью</strong><span>персонализировано по профилю</span></div>
              <span class="nero-ai-status nero-ai-status--new">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * vnr-hr-screening-engine — Диспетчерская HR-скрининга
 * Мир: каскад резюме → AI-скоринг → explain → shortlist + вопросы к интервью
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnr-hr-screening-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 420, ch / 280) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    cvBg: "#f8fafc",
    cvLine: "#cbd5e1",
    chute: "rgba(121,242,255,0.18)",
    deckBase: "#1e293b",
    deckAccent: "#79f2ff",
    scoreGreen: "#22c55e",
    scoreAmber: "#fbbf24",
    scoreRed: "#fb7185",
    rejectBin: "rgba(251,113,133,0.2)",
    gold: "#fcd34d",
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

  function drawResumeCard(ctx, x, y, w, h, score, tint) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -w / 2, -h / 2, w, h, 3, tint || C.cvBg, C.outline);
    ctx.fillStyle = C.cvLine;
    for (var i = 0; i < 3; i++) {
      drawRR(ctx, -w / 2 + 4, -h / 2 + 6 + i * 7, w - 8, 4, 1, C.cvLine, null);
    }
    if (score !== null && score !== undefined) {
      var col = score >= 75 ? C.scoreGreen : score >= 45 ? C.scoreAmber : C.scoreRed;
      drawRR(ctx, w / 2 - 16, -h / 2 - 6, 18, 12, 4, col, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(String(score), w / 2 - 7, -h / 2 + 2);
    }
    ctx.restore();
  }

  /* Вертикальный каскад резюме — транспорт (не конвейер) */
  function ResumeCascadeChute() {
    this.slideOffset = 0;
  }
  ResumeCascadeChute.prototype.draw = function (ctx) {
    this.slideOffset = (frame * 0.55) % 120;
    drawRR(ctx, -175, -85, 28, 170, 6, "rgba(15,23,42,0.5)", C.chute);
    ctx.strokeStyle = C.chute;
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 6]);
    ctx.lineDashOffset = -frame * 0.35;
    for (var lane = 0; lane < 3; lane++) {
      var lx = -162 + lane * 8;
      ctx.beginPath();
      ctx.moveTo(lx, -80);
      ctx.lineTo(lx + 6, 80);
      ctx.stroke();
    }
    ctx.setLineDash([]);

    for (var i = 0; i < 4; i++) {
      var sy = -70 + ((this.slideOffset + i * 30) % 120) - 20;
      var sc = i === 1 ? 82 : i === 3 ? 31 : null;
      var tint = i === 3 ? "rgba(251,113,133,0.35)" : C.cvBg;
      if (sy > -75 && sy < 75) drawResumeCard(ctx, -158, sy, 18, 24, sc, tint);
    }
  };

  /* Центральный пульт скоринга — вместо WebsiteTerminal */
  function ShortlistCommandDeck() {
    this.approvePulse = 0;
  }
  ShortlistCommandDeck.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -58, -78, 116, 155, 10, C.deckBase, C.outline);

    /* JD-панель */
    drawRR(ctx, -48, -68, 96, 22, 5, "rgba(121,242,255,0.12)", C.deckAccent);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("JD: Middle Python", 0, -54);

    /* Фаза SCORE — шкала 0–100 */
    if (prg >= 55) {
      var scoreVal = prg < 120 ? Math.min(100, 40 + (prg - 55) * 0.9) : 87;
      drawRR(ctx, -44, -38, 88, 10, 4, "rgba(255,255,255,0.08)", C.outline);
      drawRR(ctx, -42, -36, 84 * (scoreVal / 100), 6, 3, C.scoreGreen, null);
      ctx.fillStyle = "#86efac";
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.fillText(Math.round(scoreVal) + " баллов", 0, -22);
    }

    /* Фаза EXPLAIN */
    if (prg >= 120 && prg < 195) {
      var lines = ["+ Django 4y", "− нет CI/CD", "red flag: скачок"];
      lines.forEach(function (ln, i) {
        var col = ln.indexOf("red") === 0 ? C.scoreRed : ln.indexOf("+") === 0 ? C.scoreGreen : C.scoreAmber;
        drawRR(ctx, -46, -8 + i * 16, 92, 12, 3, "rgba(255,255,255,0.06)", col);
        ctx.fillStyle = "#e2e8f0";
        ctx.font = "7px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(ln, -42, 2 + i * 16);
      });
    }

    /* Фаза SHORTLIST — золотая карточка + approve */
    if (prg >= 195) {
      var lift = Math.min(1, (prg - 195) / 20);
      var cardY = 48 - lift * 28;
      drawRR(ctx, -32, cardY, 64, 36, 6, "rgba(252,211,77,0.28)", C.gold);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("★ Shortlist", 0, cardY + 14);
      ctx.font = "7px Inter,sans-serif";
      ctx.fillStyle = "#fde68a";
      ctx.fillText("Иван К. · 87", 0, cardY + 26);

      if (prg > 215 && prg < 250) {
        this.approvePulse = (prg - 215) / 35;
        ctx.strokeStyle = "rgba(34,197,94," + (0.85 - this.approvePulse * 0.75) + ")";
        ctx.lineWidth = 2.5;
        ctx.beginPath();
        ctx.arc(0, cardY + 18, 22 + this.approvePulse * 38, 0, Math.PI * 2);
        ctx.stroke();
        ctx.fillStyle = C.scoreGreen;
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.fillText("HR approve ✓", 0, cardY + 44);
      }
    }
  };

  /* Корзина отсева — уникальный объект */
  function RejectTriageBin() {
    this.shake = 0;
  }
  RejectTriageBin.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 118, 25, 42, 34, 6, C.rejectBin, C.scoreRed);
    ctx.fillStyle = C.scoreRed;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ОТСЕВ", 139, 46);

    if (prg > 48 && prg < 85) {
      this.shake = Math.sin(frame * 0.25) * 2;
      var rx = 100 + ((prg - 48) / 37) * 45;
      drawResumeCard(ctx, rx, 15 + this.shake, 14, 18, 28, "rgba(251,113,133,0.4)");
    }
  };

  /* Всплеск вопросов к интервью — финал цикла */
  function InterviewQuestionBurst() {
    this.questions = ["Опыт Django?", "CI/CD?", "Команда?", "Зарплата?", "Релокация?", "Пет-проекты?", "Soft skills?"];
  }
  InterviewQuestionBurst.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 200) return;
    var burst = (prg - 200) / 55;
    this.questions.forEach(function (q, i) {
      var ang = (i / 7) * Math.PI * 2 - Math.PI / 2;
      var dist = 55 + burst * 35;
      var qx = Math.cos(ang) * dist;
      var qy = -15 + Math.sin(ang) * dist * 0.55;
      var alpha = Math.min(1, burst * 1.4) * (prg < 248 ? 1 : 1 - (prg - 248) / 12);
      ctx.globalAlpha = alpha;
      drawRR(ctx, qx - 28, qy - 7, 56, 14, 4, "rgba(139,92,246,0.35)", C.deckAccent);
      ctx.fillStyle = "#e9d5ff";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(q, qx, qy + 2);
      ctx.globalAlpha = 1;
    });
  };

  /* Шкала match + governance shield */
  function MatchScoreMeter() {
    this.val = 0.5;
  }
  MatchScoreMeter.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 55) this.val = 0.35 + (prg / 55) * 0.25;
    else if (prg < 120) this.val = 0.6 + ((prg - 55) / 65) * 0.22;
    else this.val = 0.87;

    drawRR(ctx, -175, -72, 48, 14, 4, "rgba(255,255,255,0.08)", C.outline);
    drawRR(ctx, -173, -70, 44 * this.val, 10, 3, C.scoreGreen, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("match " + Math.round(this.val * 100) + "%", -172, -61);
  };

  function BiasShieldBadge() {
    this.pulse = 0;
  }
  BiasShieldBadge.prototype.draw = function (ctx) {
    this.pulse = 0.5 + Math.sin(frame * 0.06) * 0.25;
    drawRR(ctx, 108, -72, 52, 18, 5, "rgba(34,197,94," + (0.08 + this.pulse * 0.08) + ")", C.scoreGreen);
    ctx.fillStyle = "#86efac";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("🛡 152-ФЗ", 134, -60);
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
    var prg = (frame * 0.038) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    /* Агенты идут к станциям скоринга по дуге сверху */
    var stations = {
      "1_architect": { x: -120, y: -55 },
      "2_seo": { x: -55, y: -62 },
      "3_coder": { x: 0, y: -68 },
      "4_designer": { x: 55, y: -62 },
      "5_deployer": { x: 120, y: -55 }
    };
    var tgt = stations[this.role] || { x: 0, y: -60 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 17) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 10 ? this.color : null;
    }

    if (!isMoving && frame % 240 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 230);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.2;
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 6;
      legL = Math.sin(wp) * 4;
      legR = Math.sin(wp + Math.PI) * 4;
    }
    drawRR(ctx, -8, -4 + Math.max(0, legL), 7, 12, 2, C.outline, null);
    drawRR(ctx, 0, -4 + Math.max(0, legR), 7, 12, 2, C.outline, null);
    drawRR(ctx, -12, -10 - bob, 24, 16, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -22 - bob, 9, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    if (carryType) drawRR(ctx, -16, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new ResumeCascadeChute());
  entities.push(new RejectTriageBin());
  entities.push(new ShortlistCommandDeck());
  entities.push(new MatchScoreMeter());
  entities.push(new BiasShieldBadge());
  entities.push(new InterviewQuestionBurst());
  entities.push(new Agent(-150, 88, C.agentYellow, "1_architect", 20, [
    "Веса JD настроены", "Пилот: 30 резюме", "Стоп-факторы в правилах"
  ]));
  entities.push(new Agent(-75, 95, C.agentGreen, "2_seo", 68, [
    "Обязательный Django", "Gaps по CI/CD", "Не подходит — в отсев"
  ]));
  entities.push(new Agent(0, 98, C.agentBlue, "3_coder", 118, [
    "LLM скоринг 0–100", "Explain JSON готов", "temperature=0.1"
  ]));
  entities.push(new Agent(75, 95, C.agentPink, "4_designer", 162, [
    "Карточка shortlist", "7 вопросов к звонку", "Шаблон отказа"
  ]));
  entities.push(new Agent(150, 88, C.agentPurple, "5_deployer", 205, [
    "Huntflow API ✓", "Audit log записан", "HR уведомлён в Telegram"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.038) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(-130, -30, "1. Резюме в каскад");
    if (prg >= 72 && prg < 72.05) createBubble(-40, -45, "2. Скоринг 0–100");
    if (prg >= 128 && prg < 128.05) createBubble(10, -15, "3. Explain: gaps");
    if (prg >= 185 && prg < 185.05) createBubble(50, 20, "4. Вопросы к интервью");
    if (prg >= 222 && prg < 222.05) createBubble(120, -25, "5. HR shortlist ✓");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.deckAccent);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 11);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(engineloop);
  } else {
    engineloop();
  }
});
</script>

<div class="vna-content">

  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai рекрутинг</p>
          <p><strong>Коротко:</strong> AI-рекрутинг — это автоматизация первичного отбора: нейросеть сопоставляет резюме с требованиями вакансии, ранжирует кандидатов, объясняет решение и готовит вопросы для интервью. HR работает только с сильными соискателями, а не с сотнями неподходящих откликов. Nero Network внедряет такой AI-агент под ключ — с интеграцией в ATS, соблюдением 152-ФЗ и правом вето у рекрутера на каждом этапе.</p>
          <p>Поток откликов на одну вакансию легко переваливает за 150–200 резюме. Ручной просмотр занимает часы, а сильные кандидаты уходят к конкурентам, пока рекрутер разбирает «шум». <strong>Внедрение AI в рекрутинг</strong> снимает эту рутину: система сортирует резюме за минуты, а не за полдня.</p>
          <p class="vna-related nero-ai-reveal" style="margin-top:16px;font-size:15px">HR-директору полезно сопоставить скоринг резюме с опытом <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">масштабного внедрения AI в бизнес</a> у крупных компаний — те же принципы governance и human-in-the-loop работают и в подборе персонала.</p>
          <p class="vna-related nero-ai-reveal" style="margin-top:12px;font-size:15px">В enterprise-контуре, где кадровый учёт связан с ERP, смежный сценарий — <a href="/ai-1c-erp/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP под ключ</a>: автоматизация заявок и документооборота до этапа согласования с HR.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые показатели">
          <div class="vna-kpi-card"><div class="kv">200</div><div class="kl">откликов на вакансию</div><div class="ks">типичный поток</div></div>
          <div class="vna-kpi-card"><div class="kv">4+ ч</div><div class="kl">ручной скрининг</div><div class="ks">без AI</div></div>
          <div class="vna-kpi-card"><div class="kv">+26%</div><div class="kl">скорость найма с AI</div><div class="ks">SmartRecruiters 2025–2026</div></div>
          <div class="vna-kpi-card"><div class="kv">30</div><div class="kl">резюме в пилоте</div><div class="ks">лид-магнит бесплатно</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#ob-ai-rekruting">Что такое</a>
        <a href="#bole-hr">Боль HR</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Этапы</a>
        <a href="#doverie">Доверие</a>
        <a href="#roi">ROI</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="vna-section" id="ob-ai-rekruting">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Определение</span>
        <h2>Что такое AI-рекрутинг и зачем он HR-отделу</h2>
        <p><strong>AI-рекрутинг</strong> — использование нейросетей и ML-моделей для автоматизации этапов подбора персонала: от скрининга резюме и ранжирования откликов до генерации вопросов для интервью и первичного чат-скрининга. Это не замена финального найма, а снятие рутины «просмотреть 200 откликов вручную».</p>
      </div>
      <div class="vna-grid-3 nero-ai-reveal nero-ai-delay-1" style="margin-top:32px;">
        <div class="vna-level-card l1">
          <div class="vna-level-badge">Уровень 1</div>
          <h3>AI-скрининг резюме</h3>
          <p>Сопоставление текста резюме с JD, скоринг, объяснение «почему подходит / не подходит».</p>
        </div>
        <div class="vna-level-card l2">
          <div class="vna-level-badge">Уровень 2</div>
          <h3>AI-интервью</h3>
          <p>Диалоговый или голосовой бот, который уточняет стоп-факторы до звонка рекрутера.</p>
        </div>
        <div class="vna-level-card l3">
          <div class="vna-level-badge">Уровень 3</div>
          <h3>AI-sourcing</h3>
          <p>Поиск кандидатов в базе или на job-бордах по семантическому профилю вакансии.</p>
        </div>
      </div>
      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vna-card" id="nejroset-hr">
          <h3>Как нейросеть для HR помогает в подборе персонала</h3>
          <p><strong>Нейросеть для HR</strong> анализирует текст вакансии и резюме, выделяет обязательные и желательные требования, присваивает балл релевантности и формирует короткое пояснение для рекрутера. По данным Skillaz, при массовом найме ручной скоринг «съедает до половины рабочего времени» рекрутера — ИИ возвращает этот ресурс на работу с топ-кандидатами.</p>
          <p>Типичный стек: ATS или CRM рекрутинга (Huntflow, Potok, Skillaz) + LLM-скоринг + интеграции с hh.ru. <strong>AI подбор персонала</strong> в модели Nero Network — кастомный агент под вашу логику отсева.</p>
        </div>
        <div class="vna-card" id="skrining-bez-rutiny">
          <h3>Скрининг резюме и первичный отбор без рутины</h3>
          <p><strong>Скрининг резюме автоматически</strong> работает по принципу assistive AI: система ранжирует и рекомендует, финальное решение принимает человек. Greenhouse формулирует это прямо: «Talent Matching is assistive AI, not automated decision-making».</p>
          <p>Для HR-отдела это означает: вместо хаотичного inbox — упорядоченный shortlist с объяснениями и готовыми вопросами к интервью.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="bole-hr">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Боль рынка</span>
        <h2>Почему HR тратит часы на неподходящие резюме</h2>
        <p>Главная боль: <strong>HR тратит часы на неподходящие резюме</strong>, хотя ценность создаётся на этапе интервью и оффера, а не при пролистывании откликов.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card" id="massovyy-podor">
          <h3>Массовый подбор и перегруз рекрутеров</h3>
          <p>На массовые вакансии откликов приходит в разы больше, чем рекрутер успевает разобрать за день. Skillaz описывает типичный сценарий: из ~200 откликов формируется приоритизированный список ~30 кандидатов.</p>
          <p>Сергей Попов, Product Owner ATS Skillaz: «В массовом подборе рекрутер тратит значительную часть времени на ручную обработку потока вместо работы с наиболее подходящими кандидатами».</p>
          <p><strong>AI сортировка резюме</strong> переносит механическую работу на машину: рекрутер открывает уже отранжированный список.</p>
        </div>
        <div class="vna-card" id="skrytye-poteri">
          <h3>Скрытые потери: время на вакансию и cost-per-hire</h3>
          <p>Ручной скрининг удлиняет <strong>time-to-shortlist</strong>. Глобальный медианный time-to-hire — <strong>38 дней</strong>; с AI найм идёт <strong>на 26% быстрее</strong> (SmartRecruiters 2025–2026).</p>
          <div class="vna-callout">
            <p>Скрытая метрика — <strong>cost-per-hire</strong>: каждый лишний час рекрутера на нецелевые резюме увеличивает стоимость закрытия вакансии. <strong>AI оценка кандидатов</strong> на первом этапе сокращает время просмотра — ориентир сокращения до 50–75% на этапе screen.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

<section id="boris-rekruting-viz" class="vnr-root" aria-label="Анимация: воронка AI-скрининга резюме — от 200 откликов до shortlist и вопросов к интервью">
<style>
/* === БОРИС: prefix vnr-, scoped внутри #boris-rekruting-viz === */
#boris-rekruting-viz.vnr-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#boris-rekruting-viz .vnr-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#boris-rekruting-viz .vnr-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #boris-rekruting-viz .vnr-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#boris-rekruting-viz .vnr-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #boris-rekruting-viz .vnr-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#boris-rekruting-viz .vnr-ey{
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
#boris-rekruting-viz .vnr-ey::before{
  content:'';
  width:18px;height:2px;
  background:#7c3aed;
  border-radius:1px;
}
#boris-rekruting-viz .vnr-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#boris-rekruting-viz .vnr-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#boris-rekruting-viz .vnr-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#boris-rekruting-viz .vnr-ic{
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
#boris-rekruting-viz .vnr-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#boris-rekruting-viz .vnr-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#boris-rekruting-viz .vnr-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#boris-rekruting-viz .vnr-pl-v{
  background:rgba(124,58,237,.08);
  color:#6d28d9;
  border:1.5px solid rgba(124,58,237,.22);
}
#boris-rekruting-viz .vnr-pl-b{
  background:rgba(59,130,246,.08);
  color:#1d4ed8;
  border:1.5px solid rgba(59,130,246,.22);
}
#boris-rekruting-viz .vnr-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#boris-rekruting-viz .vnr-rgt{
  position:relative;
  background:linear-gradient(135deg,#faf5ff 0%,#ede9fe 40%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #boris-rekruting-viz .vnr-rgt{min-height:380px;}
}
#vnr-scoring-funnel-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="vnr-cnt">
  <div class="vnr-card">

    <div class="vnr-lft">
      <span class="vnr-ey">Воронка отбора</span>
      <h3 class="vnr-h3">200 откликов → AI-скоринг → 12 в shortlist — HR видит только сильных</h3>
      <ul class="vnr-ul">
        <li><span class="vnr-ic">↓</span>Поток резюме сужается: неподходящие уходят в «hold» с explain</li>
        <li><span class="vnr-ic">◎</span>Каждому кандидату — балл 0–100 и текстовое обоснование</li>
        <li><span class="vnr-ic">✓</span>Shortlist формируется за минуты, не за полдня ручного просмотра</li>
        <li><span class="vnr-ic">?</span>К топ-кандидатам — 5–7 персонализированных вопросов к интервью</li>
      </ul>
      <div class="vnr-pills">
        <span class="vnr-pl vnr-pl-g">200 → 12 shortlist</span>
        <span class="vnr-pl vnr-pl-v">скоринг ~4 мин</span>
        <span class="vnr-pl vnr-pl-b">human-in-the-loop</span>
      </div>
      <p class="vnr-foot">Дальше разберём механику AI-скрининга под ключ →</p>
    </div>

    <div class="vnr-rgt">
      <canvas
        id="vnr-scoring-funnel-canvas"
        aria-label="Анимация: резюме проходят AI-скоринг, отсекаются по порогу и попадают в shortlist с вопросами к интервью"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('vnr-scoring-funnel-canvas');
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
    resume:'#ffffff',
    resumeBdr:'#cbd5e1',
    resumeLine:'#e2e8f0',
    reject:'#94a3b8',
    rejectBg:'rgba(148,163,184,.12)',
    ai:'#7c3aed',
    aiGlow:'rgba(124,58,237,.22)',
    pass:'#22c55e',
    passBg:'rgba(34,197,94,.12)',
    short:'#0ea5e9',
    qBubble:'#f0fdf4',
    qBdr:'#86efac',
    funnel:'rgba(124,58,237,.08)',
    arrow:'rgba(124,58,237,.35)'
  };

  var resumes = [];
  var shortlist = [];
  var questions = [];
  var rejected = 0;
  var processed = 0;
  var totalIn = 200;
  var shortTarget = 12;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawResumeCard(x,y,w,h,score,state,alpha){
    if(alpha < 0.02) return;
    ctx.globalAlpha = alpha;
    var border = state === 'pass' ? C.pass : (state === 'reject' ? C.reject : C.resumeBdr);
    var bg = state === 'pass' ? '#f0fdf4' : (state === 'reject' ? C.rejectBg : C.resume);
    rr(ctx,x,y,w,h,5,bg,border);
    ctx.fillStyle = C.resumeLine;
    ctx.fillRect(x+8,y+10,w-16,3);
    ctx.fillRect(x+8,y+18,w*0.65,2);
    ctx.fillRect(x+8,y+24,w*0.5,2);
    if(score !== null){
      ctx.fillStyle = state === 'pass' ? C.pass : (state === 'reject' ? C.reject : C.ai);
      ctx.font = 'bold 9px system-ui,sans-serif';
      ctx.textAlign = 'right';
      ctx.fillText(score, x+w-6, y+h-6);
    }
    ctx.globalAlpha = 1;
  }

  function spawnResume(){
    resumes.push({
      x: W*0.04,
      y: H*0.18 + Math.random()*H*0.55,
      w: 36 + Math.random()*8,
      h: 44,
      phase: 0,
      score: null,
      state: 'pending',
      speed: 0.9 + Math.random()*0.5,
      alpha: 0,
      wobble: Math.random()*Math.PI*2
    });
  }

  function addToShortlist(r){
    if(shortlist.length >= shortTarget) return;
    shortlist.push({
      name: ['А. Иванов','М. Петров','Е. Соколова','Д. Козлов','К. Новикова'][shortlist.length % 5],
      score: r.score,
      y: H*0.22 + shortlist.length * (Math.min(28, H*0.055)),
      alpha: 0,
      pulse: 0
    });
    if(shortlist.length <= 3 && questions.length < 4){
      questions.push({
        x: W*0.88,
        y: H*0.25 + questions.length * 42,
        text: ['Опыт в HR-tech?','Готовность к релокации?','Стек: Python + LLM?','Управление командой?'][questions.length],
        t: 0,
        alpha: 0
      });
    }
  }

  function drawFunnel(fx, fy, fw, fh){
    ctx.fillStyle = C.funnel;
    ctx.beginPath();
    ctx.moveTo(fx, fy);
    ctx.lineTo(fx + fw, fy);
    ctx.lineTo(fx + fw*0.55, fy + fh);
    ctx.lineTo(fx + fw*0.45, fy + fh);
    ctx.closePath();
    ctx.fill();
    ctx.strokeStyle = 'rgba(124,58,237,.15)';
    ctx.lineWidth = 1;
    ctx.stroke();
  }

  function drawAiScorer(cx, cy, r, pulse){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
    g.addColorStop(0, C.aiGlow);
    g.addColorStop(1, 'rgba(124,58,237,0)');
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(cx,cy,r*1.8,0,Math.PI*2);
    ctx.fill();

    rr(ctx,cx-r,cy-r,r*2,r*2,r*0.4,'#faf5ff',C.ai);
    ctx.fillStyle = C.ai;
    ctx.font = 'bold ' + Math.max(12,r*0.28) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('AI', cx, cy-4);
    ctx.font = Math.max(8,r*0.16) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('скоринг 0–100', cx, cy+r*0.35);

    ctx.strokeStyle = C.ai;
    ctx.lineWidth = 2 + pulse*2;
    ctx.globalAlpha = 0.25 + pulse*0.35;
    ctx.beginPath();
    ctx.arc(cx,cy,r+5+pulse*6,0,Math.PI*2);
    ctx.stroke();
    ctx.globalAlpha = 1;
  }

  function drawCounter(x,y,label,val,color){
    rr(ctx,x,y,72,42,8,'rgba(255,255,255,.9)',color);
    ctx.fillStyle = C.muted;
    ctx.font = '9px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(label, x+36, y+14);
    ctx.fillStyle = color;
    ctx.font = 'bold 16px system-ui,sans-serif';
    ctx.fillText(String(val), x+36, y+32);
  }

  function tick(){
    frame++;
    if(frame % 55 === 0 && processed < totalIn) spawnResume();

    var hubX = W*0.48, hubY = H*0.5;
    var hubR = Math.min(W,H)*0.085;
    var pulse = 0.5 + 0.5*Math.sin(frame*0.07);

    ctx.clearRect(0,0,W,H);

    /* подписи зон */
    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Входящие отклики', W*0.04, H*0.08);
    ctx.textAlign = 'center';
    ctx.fillText('AI-скоринг', hubX, H*0.08);
    ctx.textAlign = 'right';
    ctx.fillText('Shortlist + вопросы', W*0.96, H*0.08);

    drawFunnel(W*0.38, H*0.14, W*0.22, H*0.72);

    /* стрелки */
    ctx.strokeStyle = C.arrow;
    ctx.lineWidth = 2;
    ctx.setLineDash([5,4]);
    ctx.beginPath();
    ctx.moveTo(W*0.18, H*0.5);
    ctx.lineTo(hubX - hubR - 6, hubY);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(hubX + hubR + 6, hubY);
    ctx.lineTo(W*0.68, H*0.5);
    ctx.stroke();
    ctx.setLineDash([]);

    drawAiScorer(hubX, hubY, hubR, pulse);

    /* счётчики */
    drawCounter(W*0.04, H*0.88, 'Отклики', totalIn, C.muted);
    drawCounter(W*0.22, H*0.88, 'Обработано', Math.min(processed, totalIn), C.ai);
    drawCounter(W*0.68, H*0.88, 'Shortlist', shortlist.length, C.pass);
    drawCounter(W*0.84, H*0.88, 'Отсечено', rejected, C.reject);

    /* резюме в потоке */
    for(var i = resumes.length - 1; i >= 0; i--){
      var r = resumes[i];
      r.alpha = Math.min(1, r.alpha + 0.04);
      r.wobble += 0.03;
      var targetX = hubX - hubR - 20;

      if(r.phase === 0){
        r.x += r.speed;
        r.y += Math.sin(r.wobble)*0.3;
        if(r.x >= targetX){
          r.phase = 1;
          r.score = Math.floor(Math.random()*100);
          r.state = r.score >= 72 ? 'pass' : 'reject';
          processed++;
        }
      } else if(r.phase === 1){
        r.x += 0.6;
        if(r.state === 'reject'){
          r.y += 1.2;
          r.alpha -= 0.02;
          if(r.alpha <= 0){
            rejected++;
            resumes.splice(i,1);
            continue;
          }
        } else {
          r.y += (H*0.35 - r.y)*0.04;
          r.x += 1.1;
          if(r.x > W*0.62){
            addToShortlist(r);
            resumes.splice(i,1);
            continue;
          }
        }
      }
      drawResumeCard(r.x, r.y, r.w, r.h, r.score, r.state, r.alpha);
    }

    /* shortlist карточки */
    shortlist.forEach(function(s, idx){
      s.alpha = Math.min(1, s.alpha + 0.03);
      s.pulse = 0.5 + 0.5*Math.sin(frame*0.05 + idx);
      var sx = W*0.7, sy = s.y;
      ctx.globalAlpha = s.alpha;
      rr(ctx,sx,sy,W*0.24,Math.min(26,H*0.06),6,'#fff',C.pass);
      ctx.fillStyle = C.pass;
      ctx.font = 'bold 10px system-ui,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(s.name, sx+8, sy+12);
      ctx.fillStyle = C.muted;
      ctx.font = '9px system-ui,sans-serif';
      ctx.fillText('скор ' + s.score, sx+8, sy+22);
      ctx.globalAlpha = 1;
    });

    /* вопросы к интервью */
    questions.forEach(function(q, qi){
      q.t++;
      q.alpha = Math.min(1, q.alpha + 0.025);
      if(q.alpha < 0.05) return;
      ctx.globalAlpha = q.alpha;
      var qw = Math.min(110, W*0.18);
      rr(ctx,q.x - qw, q.y, qw, 28, 8, C.qBubble, C.qBdr);
      ctx.fillStyle = '#166534';
      ctx.font = '8px system-ui,sans-serif';
      ctx.textAlign = 'right';
      var lines = q.text.length > 18 ? [q.text.slice(0,18)+'…'] : [q.text];
      ctx.fillText(lines[0], q.x - 6, q.y + 17);
      ctx.globalAlpha = 1;
    });

    /* сброс цикла */
    if(processed >= totalIn && resumes.length === 0){
      if(frame % 180 === 0){
        processed = 0;
        rejected = 0;
        shortlist = [];
        questions = [];
      }
    }

    requestAnimationFrame(tick);
  }
  tick();
})();
</script>
</section>

  <section class="vna-section" id="kak-rabotaet">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Механика</span>
        <h2>AI-скрининг резюме под ключ: что делает система</h2>
        <p><strong>AI рекрутинг под ключ</strong> от Nero Network — проект: аудит воронки, калибровка на пилотной вакансии, сборка агента, интеграции и governance. <strong>Автоматизация через AI рекрутинг</strong> закрывает цепочку от отклика до shortlist.</p>
      </div>
      <div class="vna-card nero-ai-reveal" id="avto-sortirovka">
        <h3>Автоматическая сортировка и отсев неподходящих</h3>
        <div class="vna-pipeline">
          <div class="vna-pipe-step"><span class="vna-pipe-num">1</span><div><h4>Импорт и нормализация</h4><p>Отклик или импорт резюме → парсинг PDF/DOCX.</p></div></div>
          <div class="vna-pipe-step"><span class="vna-pipe-num">2</span><div><h4>Скоринг 0–100 + explain</h4><p>AI сопоставляет резюме с JD и весами → скор, сильные стороны, gaps, red flags.</p></div></div>
          <div class="vna-pipe-step"><span class="vna-pipe-num">3</span><div><h4>Порог отсечения</h4><p>Ниже X — hold или шаблонный отказ; выше Y — shortlist.</p></div></div>
          <div class="vna-pipe-step"><span class="vna-pipe-num">4</span><div><h4>Human approve</h4><p>Рекрутер видит топ-N, правит вердикт; система учитывает feedback.</p></div></div>
        </div>
        <p>Potok заявляет точность pairwise-скоринга <strong>92%</strong>. Skillaz использует балл <strong>1–10</strong> с настраиваемыми весовыми группами. Уникальный угол Nero: <strong>«AI-скрининг с правом вето у HR»</strong> — скор + explain + audit log.</p>
      </div>
      <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="voprosy-intervyu" style="margin-top:24px;">
        <h3>Подготовка вопросов для интервью по профилю кандидата</h3>
        <p>Второй модуль — <strong>генератор вопросов к интервью</strong>: 5–7 персонализированных вопросов по hard skills и уточнению выявленных gaps. Skillaz и Potok уже встроили GPT-ассистентов на базе Yandex GPT (релизы февраль 2026).</p>
        <p>Для рекрутера это экономия 15–20 минут на каждого кандидата в shortlist: система готовит черновик — человек редактирует и проводит интервью.</p>
      </div>
      <div class="vna-cnt" style="width:100%;max-width:100%;padding:0;">
        <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-skrining">
          <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
          <div class="ym-cta-block__body">
            <p class="ym-cta-block__headline">Проверьте AI-скрининг на своих резюме</p>
            <p class="ym-cta-block__sub">Бесплатный тестовый разбор 30 резюме на одной вакансии: скоринг, explain и вопросы к интервью — до решения о пилоте.</p>
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить резюме AI</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Внедрение</span>
        <h2>Как внедрить AI-рекрутинг в бизнес</h2>
        <p><strong>Внедрение AI рекрутинг</strong> — поэтапный проект. <strong>Внедрение AI в бизнес</strong> на стороне HR требует согласования с HRD, ИТ и юристом по персональным данным.</p>
      </div>
      <div class="vna-timeline nero-ai-reveal" id="etapy-vnedreniya">
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>1. Аудит (3–5 дней)</h3><p>Воронка найма, объём откликов, текущая ATS, критерии отсева, требования 152-ФЗ.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>2. Калибровка (1 вакансия-пилот)</h3><p>Обязательные и желательные требования, веса; тест на 30 резюме (лид-магнит).</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>3. Сборка агента</h3><p>LLM-скоринг (Yandex GPT / GigaChat) + стоп-факторы + генерация вопросов.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>4. Интеграции</h3><p>hh.ru API, импорт из ATS, webhook, опционально Telegram-бот.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>5. Governance</h3><p>Лог решений, human approve на shortlist, политика хранения ПДн на РФ-серверах.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>6. Масштабирование</h3><p>Шаблоны по типам вакансий (массовый / middle / IT).</p></div>
      </div>
      <p class="vna-secondary-cta nero-ai-reveal">Если HR-команда хочет понимать LLM-скоринг, human-in-the-loop и интеграции с ATS до старта пилота — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo $secondary_cta_attrs; ?>><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование с HRD и юристом по 152-ФЗ.</p>
      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:36px;" id="integracii-ats">
        <table class="vna-table">
          <thead><tr><th>Платформа</th><th>Встроенный ИИ</th><th>Когда нужен кастомный агент Nero</th></tr></thead>
          <tbody>
            <tr><td>Huntflow AI</td><td>Рекомендации из базы, холодные письма</td><td>Кастомная логика скоринга входящего потока, вопросы к интервью</td></tr>
            <tr><td>Potok</td><td>Скоринг 92%, ИИ-рекрутер Just AI</td><td>Интеграции вне экосистемы Potok, 152-ФЗ под ваш контур</td></tr>
            <tr><td>Skillaz</td><td>Оценка 1–10, GPT-ассистент</td><td>Тонкая настройка весов под нишевые вакансии</td></tr>
            <tr><td>hh.ru ИИ-помощник</td><td>Сортировка откликов на площадке (бета)</td><td>Единая логика для всех каналов + CRM + audit log</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:28px;" id="integracii-crm">
        <h3>Интеграция AI-рекрутинга с CRM рекрутинга</h3>
        <p>Для рекрутинговых агентств критична связка: отклик → скоринг → карточка в CRM → задача рекрутеру. Nero настраивает webhook и поля под вашу воронку. Стек: Make, n8n; AI: Yandex GPT, GigaChat; коммуникации: email, Telegram.</p>
        <p class="vna-related nero-ai-reveal" style="margin-top:16px;font-size:15px">Если воронка кандидатов ведётся в amoCRM, смежный сценарий — <a href="/vnedrenie-ai-amocrm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a>: автоматизация карточек, задач и коммуникаций без ручного переноса откликов.</p>
        <p class="vna-related nero-ai-reveal" style="margin-top:12px;font-size:15px">Когда отклики приходят на корпоративную почту, до CRM помогает дойти <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI-обработка входящей почты в CRM</a> — классификация писем и маршрутизация в воронку рекрутера.</p>
      </div>
    </div>
  </section>

  <section class="vna-section" id="doverie">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Trust &amp; compliance</span>
        <h2>Доверие, прозрачность и законность AI-отбора</h2>
        <p>Тренд 2026 — не «насколько точна модель», а <strong>кто отвечает, когда система действует</strong>. McKinsey State of AI Trust 2026: зрелость Responsible AI выросла с <strong>2.0</strong> до <strong>~2.3 из 4.0</strong>.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card" id="explain-bias">
          <h3>Объяснимость решений и снижение bias</h3>
          <p>Эталон — <strong>Lever Talent Fit</strong>: LLM ранжирует резюме, даёт объяснения match/gap, анонимизирует PII перед оценкой; ежедневный bias-assessment.</p>
          <p>Антипримеры: Amazon recruiting AI (2018), HireVue/Intuit (2025), Mobley v. Workday (2025). Урок: без governance скоринг воспроизводит перекосы. Nero закладывает human-in-the-loop и explain на каждый балл.</p>
        </div>
        <div class="vna-card" id="pdn-152">
          <h3>Персональные данные кандидатов и требования регуляторов</h3>
          <p><strong>152-ФЗ</strong>: усиленная ответственность с 30.05.2025; запрет хранения ПДн за рубежом с 01.07.2025; отдельное согласие с 01.09.2025. Запрет загрузки резюме в публичные LLM с обучением на пользовательских данных.</p>
          <p>Nero разворачивает скоринг на <strong>РФ-серверах</strong>, оформляет договор обработки ПДн, добавляет уведомление об использовании AI.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="roi">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Метрики</span>
        <h2>ROI внедрения: метрики для HR и бизнеса</h2>
        <p><strong>AI рекрутинг для бизнеса</strong> окупается измеримой экономией времени и ускорением воронки.</p>
      </div>
      <div class="vna-roi-grid nero-ai-reveal">
        <div class="vna-roi-card"><div class="num">−50–75%</div><div class="lbl">время на screen (ориентир вендоров)</div></div>
        <div class="vna-roi-card"><div class="num">+26%</div><div class="lbl">скорость найма с AI (SmartRecruiters)</div></div>
        <div class="vna-roi-card"><div class="num">×2</div><div class="lbl">закрытие вакансий (пилоты Huntflow AI)</div></div>
      </div>
      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:32px;">
        <div class="vna-card"><h3>Экономия часов HR на вакансию</h3><p>Ключевые метрики: time-to-shortlist, часы рекрутера на скрининг, conversion resume→interview. 67% TA-профессионалов уже используют AI в hiring workflow.</p></div>
        <div class="vna-card"><h3>Ускорение закрытия вакансий и снижение cost-per-hire</h3><p>Каждый день открытой вакансии — потерянная выручка. Сокращение time-to-hire напрямую влияет на cost-per-hire.</p></div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Практика</span>
        <h2>Кейсы и примеры внедрения AI в рекрутинг</h2>
      </div>
      <div class="vna-case-grid nero-ai-reveal">
        <div class="vna-case-card">
          <div class="vna-case-tag">Ритейл</div>
          <h3>Skillaz + «Ашан Ритейл Россия»</h3>
          <p>200+ точек в 100 городах; ИИ-оценка на Yandex GPT: из ~200 откликов — ~30 приоритетных.</p>
          <div class="vna-metrics"><div class="vna-metric"><span class="num">200→30</span><span class="lbl">приоритетный shortlist</span></div></div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Агентства</div>
          <h3>Potok + Just AI (фев. 2026)</h3>
          <p>AI-рекрутер для скрининга и обзвона — диалог 24/7, вердикт в ATS.</p>
          <div class="vna-metrics"><div class="vna-metric"><span class="num">92%</span><span class="lbl">pairwise-скоринг Potok</span></div></div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Международный</div>
          <h3>Greenhouse Talent Matching</h3>
          <p>Ранжирование до 800 CV; бакеты Strong/Good/Partial — рекрутер принимает все решения.</p>
          <div class="vna-metrics"><div class="vna-metric"><span class="num">800</span><span class="lbl">резюме в воронке</span></div></div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="dlya-biznesa">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Сегменты</span>
        <h2>AI-рекрутинг для малого бизнеса и агентств</h2>
        <p>Пилот на одной вакансии — коридор <strong>150–500 тыс. ₽</strong> вместо enterprise-лицензии от 1 млн ₽.</p>
      </div>
      <div class="vna-segment-grid nero-ai-reveal">
        <div class="vna-card"><h3>SMB</h3><p>1–2 рекрутера, 5–20 вакансий в год; максимальный эффект на массовых ролях.</p></div>
        <div class="vna-card"><h3>Агентства</h3><p>Скоринг под каждого заказчика, white-label отчёты, интеграция с CRM агентства.</p></div>
        <div class="vna-card"><h3>Корпоративный HR</h3><p>Интеграция в Huntflow/Skillaz, governance по McKinsey 2026.</p></div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="ceny">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Оффер</span>
        <h2>Стоимость внедрения AI-рекрутинга</h2>
        <p>Ориентир Nero Network — <strong>150–500 тыс. ₽</strong> за пилот «под ключ»: аудит, тест 30 резюме, скоринг + explain + вопросы, базовые интеграции, governance.</p>
      </div>
      <div class="vna-pricing-grid nero-ai-reveal">
        <div class="vna-price-card vna-featured"><div class="tier">Пилот</div><div class="amount">150–500 тыс. ₽</div><div class="inc">Аудит + калибровка на 1 вакансии, тест 30 резюме, скоринг, интеграции, 152-ФЗ</div></div>
        <div class="vna-price-card"><div class="tier">SaaS-альтернатива</div><div class="amount">подписка</div><div class="inc">Potok, Skillaz, Huntflow — универсальная логика внутри экосистемы</div></div>
        <div class="vna-price-card"><div class="tier">Enterprise</div><div class="amount">от 1 млн ₽</div><div class="inc">Крупные вендоры ИИ-рекрутинга — для корпораций</div></div>
        <div class="vna-price-card"><div class="tier">Лид-магнит</div><div class="amount">бесплатно</div><div class="inc">Тестовый разбор 30 резюме на одной вакансии — без обязательств</div></div>
      </div>
      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Пилот 150–500 тыс. ₽ или сначала тест на 30 резюме?</p>
          <p class="ym-cta-block__sub">Начните с бесплатного разбора откликов — оцените качество скоринга на вашей вакансии без обязательств.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить резюме AI</a>
            <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Вопросы</span>
        <h2>FAQ — частые вопросы об AI-рекрутинге</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item" id="faq-s-nulya"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI-рекрутинг в компании с нуля?</div><div class="vna-faq-a"><p>Начните с одной вакансии и 20–50 размеченных резюме. Проведите аудит: откуда отклики, какая ATS, какие стоп-факторы. Nero калибрует агента за 3–5 недель: аудит → тест 30 резюме → сборка → запуск.</p></div></div>
        <div class="vna-faq-item" id="faq-ats"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли интегрировать AI-рекрутинг с существующей ATS?</div><div class="vna-faq-a"><p>Да. Поддерживаются Huntflow API, Potok, Skillaz, выгрузки CSV, hh.ru API. Кастомный агент Nero дополняет встроенный ИИ в ATS: единая логика, вопросы к интервью, audit log.</p></div></div>
        <div class="vna-faq-item" id="faq-bezopasnost"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Насколько безопасно доверять нейросети оценку кандидатов?</div><div class="vna-faq-a"><p>Безопасно в режиме assistive AI: нейросеть ранжирует и объясняет, рекрутер утверждает shortlist. Обязательны калибровка, explain, запрет публичных LLM для ПДн, уведомление кандидата.</p></div></div>
        <div class="vna-faq-item" id="faq-obem"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько резюме может обработать система в день?</div><div class="vna-faq-a"><p>LLM-скоринг одного резюме — секунды; пакет из 200 откликов — минуты. Для потока 500+ резюме настраивается очередь и пакетная обработка.</p></div></div>
        <div class="vna-faq-item" id="faq-zamenit"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI рекрутера?</div><div class="vna-faq-a"><p>Нет. AI забирает рутину скрининга; оценка soft skills, культурный fit и оффер остаются за рекрутером.</p></div></div>
        <div class="vna-faq-item" id="faq-zakon"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Законно ли использовать AI при отборе кандидатов в России?</div><div class="vna-faq-a"><p>Да, при соблюдении 152-ФЗ: согласие, информирование об AI-анализе, хранение в РФ. Модель Nero — human approve.</p></div></div>
        <div class="vna-faq-item" id="faq-otlichie"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Чем кастомный агент Nero отличается от ИИ в Huntflow или hh.ru?</div><div class="vna-faq-a"><p>SaaS даёт универсальную логику внутри экосистемы. Nero строит агента под ваши веса, стоп-факторы, интеграции и compliance — с лид-магнитом «30 резюме».</p></div></div>
        <div class="vna-faq-item" id="faq-kachestvo"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как проверить качество скоринга до полного внедрения?</div><div class="vna-faq-a"><p>Закажите тестовый разбор 30 резюме: вы присылаете JD и выборку откликов, Nero возвращает ранжированный список с explain и вопросами. Сверяете с оценкой HR — корректируете веса.</p></div></div>
      </div>
    </div>
  </section>

  <!-- AD_BANNER: не настроен в env — баннер не вставлять -->


</div><!-- /.vna-content -->

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
$vnr_page_url = trailingslashit( get_permalink() );
$vnr_site_url = trailingslashit( home_url( '/' ) );
$vnr_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$vnr_schema   = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $vnr_site_url . '#organization',
			'name'  => $vnr_brand,
			'url'   => $vnr_site_url,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $vnr_site_url . '#website',
			'url'       => $vnr_site_url,
			'name'      => $vnr_brand,
			'publisher' => [ '@id' => $vnr_site_url . '#organization' ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $vnr_page_url . '#webpage',
			'url'         => $vnr_page_url,
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $vnr_site_url . '#website' ],
			'about'       => [ '@id' => $vnr_site_url . '#organization' ],
		],
		[
			'@type' => 'BreadcrumbList',
			'@id'   => $vnr_page_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vnr_site_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vnr_page_url ],
			],
		],
		[
			'@type'       => 'Service',
			'@id'         => $vnr_page_url . '#service',
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'url'         => $vnr_page_url,
			'provider'    => [ '@id' => $vnr_site_url . '#organization' ],
		],
		[
			'@type' => 'FAQPage',
			'@id'   => $vnr_page_url . '#faq',
			'mainEntity' => [
				[ '@type' => 'Question', 'name' => 'Как внедрить AI-рекрутинг в компании с нуля?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Начните с одной вакансии и 20–50 размеченных резюме. Проведите аудит: откуда отклики, какая ATS, какие стоп-факторы. Nero калибрует агента за 3–5 недель: аудит → тест 30 резюме → сборка → запуск.' ] ],
				[ '@type' => 'Question', 'name' => 'Можно ли интегрировать AI-рекрутинг с существующей ATS?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Поддерживаются Huntflow API, Potok, Skillaz, выгрузки CSV, hh.ru API. Кастомный агент Nero дополняет встроенный ИИ в ATS: единая логика, вопросы к интервью, audit log.' ] ],
				[ '@type' => 'Question', 'name' => 'Насколько безопасно доверять нейросети оценку кандидатов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Безопасно в режиме assistive AI: нейросеть ранжирует и объясняет, рекрутер утверждает shortlist. Обязательны калибровка, explain, запрет публичных LLM для ПДн, уведомление кандидата.' ] ],
				[ '@type' => 'Question', 'name' => 'Сколько резюме может обработать система в день?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'LLM-скоринг одного резюме — секунды; пакет из 200 откликов — минуты. Для потока 500+ резюме настраивается очередь и пакетная обработка.' ] ],
				[ '@type' => 'Question', 'name' => 'Заменит ли AI рекрутера?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. AI забирает рутину скрининга; оценка soft skills, культурный fit и оффер остаются за рекрутером.' ] ],
				[ '@type' => 'Question', 'name' => 'Законно ли использовать AI при отборе кандидатов в России?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, при соблюдении 152-ФЗ: согласие, информирование об AI-анализе, хранение в РФ. Модель Nero — human approve.' ] ],
				[ '@type' => 'Question', 'name' => 'Чем кастомный агент Nero отличается от ИИ в Huntflow или hh.ru?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'SaaS даёт универсальную логику внутри экосистемы. Nero строит агента под ваши веса, стоп-факторы, интеграции и compliance — с лид-магнитом «30 резюме».' ] ],
				[ '@type' => 'Question', 'name' => 'Как проверить качество скоринга до полного внедрения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Закажите тестовый разбор 30 резюме: вы присылаете JD и выборку откликов, Nero возвращает ранжированный список с explain и вопросами. Сверяете с оценкой HR — корректируете веса.' ] ],
			],
		],
	],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vnr_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

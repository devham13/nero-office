<?php
/**
 * Template Name: AI-куратор для онлайн-школы: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI-куратора для онлайн-школ. Домашки, напоминания, прогресс, снижение оттока.
 */

$page_seo_title       = 'AI-куратор для онлайн-школы: внедрение и настройка под ключ';
$page_seo_description = 'Внедрим AI-куратора для онлайн-школы: напоминания о домашках, ответы по материалам курса и раннее выявление оттока. Интеграция с LMS/CRM, кейсы, цены. Карта точек выпадения — бесплатно.';

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
    ['label' => 'Сценарии',     'href' => '#scenarii'],
    ['label' => 'Кейсы',        'href' => '#keisy'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Снизить недоходимость';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение AI-автоматизации';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

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
   AKOS PAGE — GLOBAL RESETS
   ===================================================== */
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

/* =====================================================
   AKOS CONTENT ROOT — dark theme
   ===================================================== */
.akos-content{
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
.akos-content *,.akos-content *::before,.akos-content *::after{box-sizing:border-box;}
.akos-content a{color:inherit;text-decoration:none;}
.akos-content p{color:var(--vna-muted);line-height:1.72;margin:0 0 1em;}
.akos-content p:last-child{margin-bottom:0;}
.akos-content h2,.akos-content h3,.akos-content h4{
  color:var(--vna-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.akos-content strong{color:var(--vna-soft);}
.akos-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.akos-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--vna-muted);font-size:14.5px;line-height:1.65;
}
.akos-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--vna-accent);font-weight:700;
}

/* Container */
.akos-cnt{
  width:min(var(--vna-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.akos-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.akos-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.akos-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.akos-sh.akos-left{margin-left:0;text-align:left;}
.akos-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.akos-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.akos-sh.akos-left p{margin-left:0;}

/* Eyebrow */
.akos-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-accent);margin-bottom:14px;
}

/* Gradient text */
.akos-gt{
  background:linear-gradient(92deg,#fff 0%,var(--vna-accent) 44%,var(--vna-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.akos-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.akos-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.akos-intro-text{
  position:relative;padding-left:20px;
}
.akos-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--vna-accent),var(--vna-violet));
}
.akos-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--vna-muted);margin-bottom:1em;
}
.akos-intro-text p:last-child{margin-bottom:0;color:var(--vna-soft);}
.akos-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.akos-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.akos-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--vna-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.akos-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vna-muted);line-height:1.4;}
.akos-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .akos-intro-grid{grid-template-columns:1fr;gap:36px;}
  .akos-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .akos-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.akos-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.akos-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.akos-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--vna-surface);border:1px solid var(--vna-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--vna-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.akos-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--vna-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.akos-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--vna-border);border-radius:var(--vna-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.akos-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.akos-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.akos-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .akos-grid-2{grid-template-columns:1fr;}
  .akos-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .akos-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .akos-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.akos-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vna-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.akos-level-card:hover{transform:translateY(-2px);}
.akos-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--vna-r) var(--vna-r) 0 0;
}
.akos-level-card.l1::before{background:var(--vna-green);}
.akos-level-card.l2::before{background:var(--vna-accent);}
.akos-level-card.l3::before{background:var(--vna-violet);}
.akos-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.akos-level-card.l1 .akos-level-badge{background:rgba(34,197,94,.15);color:var(--vna-green);}
.akos-level-card.l2 .akos-level-badge{background:rgba(121,242,255,.15);color:var(--vna-accent);}
.akos-level-card.l3 .akos-level-badge{background:rgba(139,92,246,.15);color:var(--vna-violet);}
.akos-level-card h3{font-size:17px;margin-bottom:10px;}
.akos-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.akos-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vna-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.akos-scenario:last-child{margin-bottom:0;}
.akos-scenario:hover{border-color:rgba(121,242,255,.3);}
.akos-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.akos-scenario h3{font-size:17px;margin-bottom:8px;}
.akos-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.akos-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.akos-table{width:100%;border-collapse:collapse;font-size:14px;}
.akos-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--vna-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.akos-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--vna-text);vertical-align:top;
}
.akos-table tr:last-child td{border-bottom:none;}
.akos-table tr:hover td{background:rgba(255,255,255,.03);}
.akos-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.akos-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.akos-stack-layer:last-child{border-bottom:none;}
.akos-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--vna-accent);padding-top:2px;
}
.akos-stack-val{font-size:14.5px;color:var(--vna-text);}
.akos-stack-desc{font-size:13px;color:var(--vna-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.akos-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.akos-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.akos-case-grid{grid-template-columns:1fr;}}
.akos-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.akos-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.akos-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-green);margin-bottom:10px;
}
.akos-case-card h3{font-size:16px;margin-bottom:14px;}
.akos-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.akos-metric{display:flex;align-items:baseline;gap:8px;}
.akos-metric .num{font-size:22px;font-weight:900;color:var(--vna-accent);flex-shrink:0;letter-spacing:-.04em;}
.akos-metric .lbl{font-size:13px;color:var(--vna-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.akos-timeline{position:relative;padding-left:40px;}
.akos-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--vna-accent),var(--vna-violet));
  opacity:.35;border-radius:2px;
}
.akos-tl-item{position:relative;margin-bottom:32px;}
.akos-tl-item:last-child{margin-bottom:0;}
.akos-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--vna-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.akos-tl-item h3{font-size:17px;margin-bottom:8px;}
.akos-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.akos-pricing-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:960px){.akos-pricing-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.akos-pricing-grid{grid-template-columns:1fr;}}
.akos-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.akos-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.akos-price-card.akos-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.akos-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-accent);margin-bottom:10px;
}
.akos-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.akos-price-card .inc{font-size:13px;color:var(--vna-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.akos-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.akos-compare{width:100%;border-collapse:collapse;}
.akos-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--vna-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.akos-compare td{
  padding:13px 16px;font-size:14px;color:var(--vna-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.akos-compare tr:last-child td{border-bottom:none;}
.akos-good{color:var(--vna-green);}
.akos-neutral{color:var(--vna-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.akos-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.akos-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.akos-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--vna-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.akos-faq-q::after{
  content:'▾';font-size:13px;color:var(--vna-accent);
  flex-shrink:0;transition:transform .25s;
}
.akos-faq-item.open .akos-faq-q::after{transform:rotate(180deg);}
.akos-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--vna-muted);line-height:1.72;
}
.akos-faq-item.open .akos-faq-a{max-height:600px;padding:0 24px 20px;}

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
.akos-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.akos-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--vna-muted);
}
.akos-cta-checklist li::before{content:'✓';color:var(--vna-green);font-weight:800;}

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

/* Hero AI-куратор — scoped overrides */
.akos-hero-kurator.nero-ai-hero {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
  --akos-accent: #79f2ff;
  --akos-violet: #8b5cf6;
  --akos-amber: #fbbf24;
}
.akos-hero-kurator .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--akos-accent) 42%, var(--akos-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
}
.akos-hero-kurator .nero-ai-badge::before {
  content: "";
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--akos-accent);
  box-shadow: 0 0 8px rgba(121, 242, 255, 0.45);
}
.akos-hero-kurator .nero-ai-dashboard {
  transform: perspective(1100px) rotateY(-2deg) rotateX(1.5deg);
}
.akos-hero-kurator .nero-ai-metric strong {
  background: linear-gradient(135deg, #fff 30%, var(--akos-accent) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
}
.akos-hero-kurator .nero-ai-task-icon {
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 0.04em;
}
.akos-hero-kurator .nero-ai-status--sent { color: #94a3b8; background: rgba(148, 163, 184, 0.12); }
.akos-hero-kurator .nero-ai-status--done { color: #86efac; background: rgba(34, 197, 94, 0.12); }
.akos-hero-kurator .nero-ai-status--new  { color: #fde68a; background: rgba(251, 191, 36, 0.14); }
@media (max-width: 900px) {
  .akos-hero-kurator .nero-ai-dashboard { transform: none; }
}
.ym-cta-block--secondary {
  background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(121, 242, 255, 0.08));
  border-color: rgba(139, 92, 246, 0.28);
  text-align: left;
}
.ym-link--accent { color: var(--akos-accent); text-decoration: underline; }
.ym-link--accent:hover { color: #fff; }
</style>

<main id="primary" class="site-main nero-ai-home-page ai-kurator-onlayn-shkoly-page" role="main" tabindex="-1">

<section class="nero-ai-hero akos-hero-kurator" id="hero" aria-labelledby="hero-kurator-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai куратор edtech</p>
      <h1 id="hero-kurator-title">AI-куратор для онлайн-школы: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Ученики не сдают домашки и «молчат» после первого урока — AI-куратор напоминает о дедлайнах, отвечает по материалам курса и заранее показывает риск оттока. Снижайте недоходимость без роста штата кураторов.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Напоминания ДЗ</li>
        <li class="nero-ai-badge">Ответы по курсу</li>
        <li class="nero-ai-badge">Risk score</li>
        <li class="nero-ai-badge">GetCourse + CRM</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-куратор онлайн-школы">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">EdTech · AI-куратор</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Дашборд прогресса</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>1-е ДЗ</span><strong>78%</strong><small>сдано за 7 дней</small></div>
            <div class="nero-ai-metric"><span>Ответ AI</span><strong>12 сек</strong><small>медиана</small></div>
            <div class="nero-ai-metric"><span>Risk</span><strong>3</strong><small>ученика</small></div>
            <div class="nero-ai-metric"><span>Доходимость</span><strong>+14%</strong><small>к пилоту</small></div>
          </div>
          <div class="nero-ai-task-stream">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">DZ</span>
              <div><strong>Напоминание</strong><span>урок 3 · ДЗ не сдано</span></div>
              <span class="nero-ai-status nero-ai-status--sent">отправлено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Ответ по курсу</strong><span>«как сдать задание?»</span></div>
              <span class="nero-ai-status nero-ai-status--done">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Risk alert</strong><span>куратору · молчание D+3</span></div>
              <span class="nero-ai-status nero-ai-status--new">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="akos-content">

<section class="akos-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
  <div class="akos-cnt nero-ai-container">
    <div class="akos-intro-grid nero-ai-intro-grid nero-ai-reveal">
      <div class="akos-intro-text nero-ai-intro-text">
        <p class="nero-ai-eyebrow">Лонгрид · ai куратор edtech</p>
        <p>До <strong>87%</strong> покупателей онлайн-курсов не доходят до финала (ИнфоХит, отраслевые данные). Критичны <strong>первые две недели</strong>: ученик оплатил поток, открыл урок — и не сдал первое ДЗ. Без касания он выпадает, а школа теряет LTV и сжигает рекламный бюджет.</p>
        <p>EdTech и коммерческие воронки пересекаются там, где школе важно не потерять клиента после оплаты: по опыту <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">масштабного внедрения AI в бизнес</a> управляемые AI-агенты работают только при чётких триггерах и контроле качества — те же принципы мы переносим в сопровождение учеников.</p>
        <p>AI-куратор для онлайн-школы — не «чат-бот с FAQ», а связка LLM, базы знаний курса (RAG) и триггеров из LMS/CRM. Nero Network внедряет такие системы <strong>под ключ</strong>: от карты точек выпадения до пилота на одном потоке с измеримым ROI за <strong>4–6 недель</strong>.</p>
      </div>
      <div class="akos-intro-kpi" aria-label="Ключевые показатели EdTech">
        <div class="akos-kpi-card">
          <div class="kv">87%</div>
          <div class="kl">не завершают онлайн-курсы</div>
          <div class="ks">ИнфоХит</div>
        </div>
        <div class="akos-kpi-card">
          <div class="kv">12,6%</div>
          <div class="kl">медианная доходимость MOOC</div>
          <div class="ks">Jordan, IRRODL</div>
        </div>
        <div class="akos-kpi-card">
          <div class="kv">154 млрд ₽</div>
          <div class="kl">выручка топ-100 EdTech РФ, 2025</div>
          <div class="ks">Smart Ranking</div>
        </div>
        <div class="akos-kpi-card">
          <div class="kv">150–450 тыс. ₽</div>
          <div class="kl">ориентир внедрения под ключ</div>
          <div class="ks">Nero Network</div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="akos-toc-outer">
  <div class="akos-cnt">
    <nav class="akos-toc ym-toc" aria-label="Оглавление статьи">
      <a href="#pochemu-ottok">Почему выпадают</a>
      <a href="#chto-takoe">Что такое AI-куратор</a>
      <a href="#kak-rabotaet">Как работает</a>
      <a href="#scenarii">Сценарии</a>
      <a href="#integracii">Интеграции</a>
      <a href="#keisy">Кейсы</a>
      <a href="#etapy">Этапы</a>
      <a href="#ceny">Стоимость</a>
      <a href="#roi">ROI</a>
      <a href="#faq">FAQ</a>
      <a href="#zakazat">Заказать</a>
    </nav>
  </div>
</div>

<section class="akos-section" id="pochemu-ottok">
  <div class="akos-cnt">
    <div class="akos-sh">
      <span class="akos-eyebrow">Боль EdTech</span>
      <h2>Почему ученики выпадают из онлайн-школы</h2>
      <p>Домашние задания без контроля и «молчание» после первого урока — главные точки отвала в 2026 году.</p>
    </div>
    <div class="akos-grid-2 nero-ai-reveal">
      <div class="akos-card">
        <h3>Домашние задания без контроля — главная точка отвала</h3>
        <p><strong>Определение:</strong> точка отвала — этап воронки обучения, на котором ученик перестаёт взаимодействовать с курсом и с высокой вероятностью не доходит до финала.</p>
        <p>По данным ИнфоХит, до <strong>87%</strong> покупателей онлайн-курсов не завершают обучение. Для MOOC медианная доходимость — <strong>12,6%</strong>; критичны <strong>первые две недели</strong> (Jordan, IRRODL). Roistat: только ~<strong>20%</strong> школ доводят до конца <strong>71–100%</strong> учеников.</p>
        <p>Первая домашняя работа — самый уязвимый момент. Ученик оплатил курс, открыл урок, но не сдал задание. Через три дня молчания вернуть его в разы сложнее, чем удержать в первые 48 часов.</p>
      </div>
      <div class="akos-card">
        <h3>Сколько стоит недоходимость для онлайн-школы</h3>
        <p><strong>Коротко:</strong> каждый «молчащий» ученик — потерянный LTV, негативные отзывы и сгоревший рекламный бюджет.</p>
        <p>Если поток из 200 человек теряет 30–40% на первом модуле, школа оплачивает трафик за тех, кто не получит результат. Удержание <strong>5–10 учеников</strong> в одном потоке окупает пилот AI-куратора (ориентир <strong>150–450 тыс. ₽</strong>).</p>
        <p>Кураторы тонут в однотипных вопросах «где урок?», «как сдать ДЗ?» — до 50–80% рабочего времени по данным интеграторов EdTech (Noltis, PapAI Soft).</p>
      </div>
    </div>
  </div>
</section>

<section class="akos-section akos-section-alt" id="chto-takoe">
  <div class="akos-cnt">
    <div class="akos-sh">
      <span class="akos-eyebrow">Определение</span>
      <h2>Что такое AI-куратор для онлайн-школы</h2>
      <p><strong>AI-куратор</strong> — связка LLM + база знаний курса (RAG) + триггеры из LMS/CRM, которая сопровождает ученика и эскалирует сложные случаи живому специалисту.</p>
    </div>
    <div class="akos-card nero-ai-reveal" style="margin-bottom:28px;">
      <h3>Чем AI-куратор отличается от живого куратора и чат-бота</h3>
      <div class="akos-table-wrap">
        <table class="akos-table">
          <thead><tr><th>Критерий</th><th>Живой куратор</th><th>Шаблонный чат-бот</th><th>AI-куратор</th></tr></thead>
          <tbody>
            <tr><td>Доступность</td><td>Рабочие часы</td><td>24/7</td><td>24/7</td></tr>
            <tr><td>Ответы по материалам курса</td><td>Да, но медленно</td><td>Только сценарии</td><td>RAG по урокам и FAQ</td></tr>
            <tr><td>Персонализация</td><td>Высокая</td><td>Низкая</td><td>Контекстная (прогресс, дедлайны)</td></tr>
            <tr><td>Масштаб</td><td>Ограничен штатом</td><td>Высокий</td><td>Высокий</td></tr>
            <tr><td>Проверка ДЗ</td><td>Полная</td><td>Нет</td><td>Первичная + эскалация</td></tr>
            <tr><td>Стоимость на 200 учеников</td><td>2–3 ФОТ</td><td>Низкая, слабый UX</td><td>Проект + сопровождение</td></tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="akos-grid-2 nero-ai-reveal">
      <div class="akos-card">
        <h3>Что автоматизируется</h3>
        <ul>
          <li>Персонализированные напоминания о ДЗ и дедлайнах</li>
          <li>Ответы только по материалам курса (RAG)</li>
          <li>Первичная проверка структурированных ДЗ</li>
          <li>Risk score по неактивности</li>
          <li>Summary для куратора при эскалации</li>
        </ul>
      </div>
      <div class="akos-card">
        <h3>Что остаётся за человеком</h3>
        <ul>
          <li>Финальная оценка творческих и спорных ДЗ</li>
          <li>Конфликты, возвраты, мотивационные разговоры</li>
          <li>Методические решения и правки программы</li>
          <li>Утверждение спорных AI-ответов на пилоте</li>
        </ul>
        <p style="margin-top:14px;">Модель <strong>«ИИ готовит — человек утверждает»</strong> — стандарт School-master для GetCourse.</p>
      </div>
    </div>
  </div>
</section>
<section id="ai-kurator-onlayn-shkoly-boris-block" class="baks-root" aria-label="Анимация: карта пути ученика и проактивные касания AI-куратора">
<style>
/* === БОРИС: prefix baks-, scoped внутри #ai-kurator-onlayn-shkoly-boris-block === */
#ai-kurator-onlayn-shkoly-boris-block.baks-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-kurator-onlayn-shkoly-boris-block .baks-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-kurator-onlayn-shkoly-boris-block .baks-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-kurator-onlayn-shkoly-boris-block .baks-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-kurator-onlayn-shkoly-boris-block .baks-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-kurator-onlayn-shkoly-boris-block .baks-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-kurator-onlayn-shkoly-boris-block .baks-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0d9488;
  margin:0 0 14px;
}
#ai-kurator-onlayn-shkoly-boris-block .baks-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0d9488;
  border-radius:1px;
}
#ai-kurator-onlayn-shkoly-boris-block .baks-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-kurator-onlayn-shkoly-boris-block .baks-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-kurator-onlayn-shkoly-boris-block .baks-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-kurator-onlayn-shkoly-boris-block .baks-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(13,148,136,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0f766e;
  margin-top:1px;
  font-style:normal;
}
#ai-kurator-onlayn-shkoly-boris-block .baks-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-kurator-onlayn-shkoly-boris-block .baks-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-kurator-onlayn-shkoly-boris-block .baks-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-kurator-onlayn-shkoly-boris-block .baks-pl-t{
  background:rgba(13,148,136,.08);
  color:#0f766e;
  border:1.5px solid rgba(13,148,136,.22);
}
#ai-kurator-onlayn-shkoly-boris-block .baks-pl-a{
  background:rgba(245,158,11,.08);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.22);
}
#ai-kurator-onlayn-shkoly-boris-block .baks-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-kurator-onlayn-shkoly-boris-block .baks-rgt{
  position:relative;
  background:linear-gradient(145deg,#ecfeff 0%,#f0fdf4 35%,#f8fafc 70%,#eef2ff 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-kurator-onlayn-shkoly-boris-block .baks-rgt{min-height:380px;}
}
#baks-curator-path-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="baks-cnt">
  <div class="baks-card">

    <div class="baks-lft">
      <span class="baks-ey">Карта пути ученика</span>
      <h3 class="baks-h3">От оплаты до модуля 2: AI ловит «молчунов» до оттока</h3>
      <ul class="baks-ul">
        <li><span class="baks-ic">D0</span>Welcome в Telegram после оплаты — ученик не теряется в LMS</li>
        <li><span class="baks-ic">D+1</span>Контекстное напоминание о 1-м ДЗ, если урок открыт, а работа не сдана</li>
        <li><span class="baks-ic">AI</span>RAG-ответ по материалам курса; при низкой уверенности — эскалация куратору</li>
        <li><span class="baks-ic">!</span>Risk alert на D+3/D+7: молчание + пропуск дедлайна → персональное касание</li>
      </ul>
      <div class="baks-pills">
        <span class="baks-pl baks-pl-t">87% не доходят</span>
        <span class="baks-pl baks-pl-g">1-е ДЗ — точка отвала</span>
        <span class="baks-pl baks-pl-a">Risk score D+3</span>
      </div>
      <p class="baks-foot">Дальше — сценарии по дням, напоминания и дашборд риска →</p>
    </div>

    <div class="baks-rgt">
      <canvas
        id="baks-curator-path-canvas"
        aria-label="Анимация: путь ученика по этапам обучения с проактивными касаниями AI-куратора и сигналами риска оттока"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('baks-curator-path-canvas');
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
    line:'rgba(15,23,42,.12)',
    teal:'#0d9488',
    tealL:'rgba(13,148,136,.15)',
    green:'#22c55e',
    greenL:'rgba(34,197,94,.12)',
    amber:'#f59e0b',
    amberL:'rgba(245,158,11,.15)',
    red:'#ef4444',
    redL:'rgba(239,68,68,.12)',
    indigo:'#6366f1',
    indigoL:'rgba(99,102,241,.12)',
    card:'#ffffff',
    cardBdr:'rgba(148,163,184,.35)',
    tg:'#229ed9',
    bubble:'#ffffff'
  };

  var STAGES = [
    {label:'Оплата', short:'D0'},
    {label:'Урок 1', short:'D+1'},
    {label:'1-е ДЗ', short:'⚠'},
    {label:'Модуль 2', short:'D+7'},
    {label:'Финал', short:'✓'}
  ];

  var STUDENTS = [
    {name:'А', color:C.teal,   path:[0,1,2,3,4], stallAt:2, rescued:true,  delay:0},
    {name:'М', color:C.indigo, path:[0,1,2],     stallAt:2, rescued:false, delay:80},
    {name:'К', color:C.green,  path:[0,1,2,3],   stallAt:-1,rescued:false,delay:40},
    {name:'С', color:C.amber,  path:[0,1],       stallAt:1, rescued:true,  delay:120}
  ];

  var LOOP = 680;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function getLayout(){
    var pad = Math.max(14, W * 0.04);
    var top = 52;
    var bot = H - 88;
    var trackY = top + (bot - top) * 0.42;
    var left = pad + 8;
    var right = W - pad - 8;
    var step = (right - left) / (STAGES.length - 1);
    return {pad:pad, top:top, bot:bot, trackY:trackY, left:left, right:right, step:step};
  }

  function stageX(L, idx){ return L.left + idx * L.step; }

  function drawHeader(L){
    rr(L.pad, 12, W - L.pad*2, 32, 8, C.card, C.cardBdr, 1);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('GetCourse → AI-куратор · карта выпадения', L.pad + 12, 32);

    var pulse = 6 + Math.sin(frame * 0.08) * 2;
    ctx.beginPath();
    ctx.arc(W - L.pad - 28, 28, pulse, 0, Math.PI * 2);
    ctx.fillStyle = C.redL;
    ctx.fill();
    ctx.beginPath();
    ctx.arc(W - L.pad - 28, 28, 4, 0, Math.PI * 2);
    ctx.fillStyle = C.red;
    ctx.fill();
    ctx.fillStyle = C.red;
    ctx.font = '10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Risk: 3', W - L.pad - 18, 32);
  }

  function drawTrack(L){
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 3;
    ctx.setLineDash([]);
    ctx.beginPath();
    ctx.moveTo(stageX(L,0), L.trackY);
    ctx.lineTo(stageX(L, STAGES.length-1), L.trackY);
    ctx.stroke();

    STAGES.forEach(function(st, i){
      var x = stageX(L, i);
      var isRisk = (i === 2);
      var r = isRisk ? 16 : 13;
      var fill = isRisk ? C.amberL : C.indigoL;
      var stroke = isRisk ? C.amber : C.indigo;

      ctx.beginPath();
      ctx.arc(x, L.trackY, r + 4 + (isRisk ? Math.sin(frame*0.1)*2 : 0), 0, Math.PI*2);
      ctx.fillStyle = isRisk ? 'rgba(245,158,11,.18)' : 'rgba(99,102,241,.12)';
      ctx.fill();

      ctx.beginPath();
      ctx.arc(x, L.trackY, r, 0, Math.PI*2);
      ctx.fillStyle = fill;
      ctx.fill();
      ctx.strokeStyle = stroke;
      ctx.lineWidth = 2;
      ctx.stroke();

      ctx.fillStyle = C.ink;
      ctx.font = 'bold 9px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(st.short, x, L.trackY + 3);

      ctx.fillStyle = C.muted;
      ctx.font = '9px Inter,sans-serif';
      ctx.fillText(st.label, x, L.trackY + 28);
    });
  }

  function studentProgress(s, t){
    var maxStage = s.path.length - 1;
    if(s.stallAt >= 0 && t > s.stallAt + 0.35){
      if(s.rescued && t > s.stallAt + 0.55) return Math.min(maxStage, s.stallAt + (t - s.stallAt - 0.55) * 1.8);
      return s.stallAt + 0.12 + Math.sin(frame * 0.06) * 0.04;
    }
    return Math.min(maxStage, t);
  }

  function drawStudents(L){
    var t = ((frame - 60) % LOOP) / (LOOP * 0.72);
    if(t < 0) t = 0;

    STUDENTS.forEach(function(s, si){
      var prog = studentProgress(s, t);
      var x = stageX(L, 0) + prog * L.step;
      var yOff = (si - 1.5) * 22;
      var y = L.trackY - 52 + yOff;

      ctx.beginPath();
      ctx.arc(x, y, 11, 0, Math.PI*2);
      ctx.fillStyle = s.color;
      ctx.fill();
      ctx.strokeStyle = C.card;
      ctx.lineWidth = 2;
      ctx.stroke();

      ctx.fillStyle = '#fff';
      ctx.font = 'bold 9px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(s.name, x, y + 3);

      if(s.stallAt >= 0 && prog >= s.stallAt - 0.05 && prog <= s.stallAt + 0.4){
        var bubbleAlpha = 0.55 + 0.45 * Math.sin(frame * 0.12 + si);
        drawBubble(x + 18, y - 28, s.rescued ? 'Напоминание отправлено' : 'Молчание D+3', bubbleAlpha, s.rescued ? C.green : C.amber);
      }
    });
  }

  function drawBubble(bx, by, text, alpha, accent){
    ctx.globalAlpha = alpha;
    var tw = ctx.measureText(text).width;
    var bw = Math.min(tw + 20, W * 0.42);
    var bh = 26;
    rr(bx, by, bw, bh, 8, C.bubble, accent || C.cardBdr, 1.5);
    ctx.fillStyle = accent || C.teal;
    ctx.font = 'bold 8px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(text, bx + 8, by + 16);
    ctx.globalAlpha = 1;
  }

  function drawTelegramPanel(L){
    var pw = Math.min(200, W * 0.38);
    var ph = 118;
    var px = L.pad;
    var py = L.bot - ph + 8;

    rr(px, py, pw, ph, 12, C.card, C.cardBdr, 1);

    ctx.fillStyle = C.tg;
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Telegram · AI-куратор', px + 10, py + 18);

    var msgs = [
      {t:'Добро пожаловать! Урок 1 уже открыт →', d:0},
      {t:'Осталось: ДЗ в уроке 3 (~15 мин)', d:180},
      {t:'Ответ по курсу: «как сдать задание?»', d:320}
    ];

    var slotY = py + 30;
    msgs.forEach(function(m){
      if(frame < m.d) return;
      var a = Math.min(1, (frame - m.d) / 40);
      ctx.globalAlpha = a;
      rr(px + 8, slotY, pw - 16, 22, 6, C.tealL, null, 0);
      ctx.fillStyle = C.ink;
      ctx.font = '8px Inter,sans-serif';
      ctx.textAlign = 'left';
      var txt = m.t.length > 34 ? m.t.slice(0, 32) + '…' : m.t;
      ctx.fillText(txt, px + 14, slotY + 14);
      ctx.globalAlpha = 1;
      slotY += 26;
    });
  }

  function drawRiskDashboard(L){
    var pw = Math.min(210, W * 0.4);
    var ph = 100;
    var px = W - L.pad - pw;
    var py = L.bot - ph + 14;

    rr(px, py, pw, ph, 12, C.card, C.cardBdr, 1);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Дашборд куратора', px + 10, py + 18);

    var metrics = [
      {l:'1-е ДЗ', v:'78%', c:C.green},
      {l:'Silent D+3', v:'12%', c:C.amber},
      {l:'Risk', v:'3', c:C.red}
    ];
    var mw = (pw - 24) / 3;
    metrics.forEach(function(m, i){
      var mx = px + 8 + i * (mw + 4);
      var my = py + 28;
      rr(mx, my, mw, 58, 8, 'rgba(248,250,252,.9)', C.cardBdr, 1);
      ctx.fillStyle = C.muted;
      ctx.font = '8px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(m.l, mx + mw/2, my + 16);
      ctx.fillStyle = m.c;
      ctx.font = 'bold 16px Inter,sans-serif';
      ctx.fillText(m.v, mx + mw/2, my + 40);
    });
  }

  function drawAiPulse(L){
    var cx = stageX(L, 2);
    var cy = L.trackY;
    if(frame < 100) return;
    var pulse = (frame % 90) / 90;
    ctx.beginPath();
    ctx.arc(cx, cy - 70, 18 + pulse * 12, 0, Math.PI*2);
    ctx.strokeStyle = 'rgba(13,148,136,' + (0.35 - pulse*0.3) + ')';
    ctx.lineWidth = 2;
    ctx.stroke();

    if(frame > 200 && frame < 420){
      drawBubble(cx - 40, cy - 95, 'RAG · ответ по уроку 3', 0.85, C.teal);
    }
    if(frame > 440){
      drawBubble(cx + 10, cy - 88, 'Эскалация куратору', 0.7 + 0.3*Math.sin(frame*0.08), C.amber);
    }
  }

  function loop(){
    frame++;
    ctx.clearRect(0, 0, W, H);

    var L = getLayout();
    drawHeader(L);
    drawTrack(L);
    drawStudents(L);
    drawAiPulse(L);
    drawTelegramPanel(L);
    drawRiskDashboard(L);

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>
<section class="akos-section" id="kak-rabotaet">
  <div class="akos-cnt">
    <div class="akos-sh">
      <span class="akos-eyebrow">Функционал</span>
      <h2>Как AI-куратор снижает отток: домашки, напоминания, прогресс</h2>
    </div>
    <div class="akos-scenario nero-ai-reveal">
      <div class="akos-sc-icon" aria-hidden="true">⏰</div>
      <div>
        <h3>Автонапоминания о дедлайнах и несданных работах</h3>
        <p>GetCourse уже шлёт напоминания за сутки и 12 часов до урока — это <strong>базовый слой</strong>. AI добавляет контекст («осталось: задание в уроке 3, ~15 мин»), тон школы и реактивацию «отстал и стыдно».</p>
        <p><strong>Сценарий:</strong> D0 онбординг → D+1 контекстное напоминание → D+3 повтор + подсказка → D+7 risk alert куратору.</p>
      </div>
    </div>
    <div class="akos-scenario nero-ai-reveal">
      <div class="akos-sc-icon" aria-hidden="true">💬</div>
      <div>
        <h3>Ответы по материалам курса в рамках программы</h3>
        <p>RAG ищет ответ в базе знаний; при низкой уверенности — эскалация с draft-ответом. Coursera Coach: +~10% pass quiz с первой попытки. <strong>Анти-кейс Khanmigo:</strong> только ~15% eligible students пользовались AI — нужны проактивные триггеры в LMS.</p>
      </div>
    </div>
    <div class="akos-scenario nero-ai-reveal">
      <div class="akos-sc-icon" aria-hidden="true">📊</div>
      <div>
        <h3>Дашборд прогресса и раннее выявление риска оттока</h3>
        <p>Risk score по сигналам: нет активности 3+ дня, пропуск дедлайна, не открывал урок N дней. Дашборд в CRM показывает объяснимые факторы — что ученик не сделал и что делать дальше.</p>
      </div>
    </div>
  </div>
</section>

<div class="akos-cnt">
  <div class="ym-cta-block ym-cta-block--primary" id="cta-kak-rabotaet">
    <div class="ym-cta-block__icon" aria-hidden="true">🎓</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Хотите снизить недоходимость в вашей онлайн-школе?</p>
      <p class="ym-cta-block__sub">Подготовим бесплатную <strong>Карту точек выпадения учеников</strong>: онбординг → 1-е ДЗ → модуль 2. Покажем, где теряются ученики и как AI-куратор закроет разрыв за 4–6 недель пилота.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </div>
</div>

<section class="akos-section akos-section-alt" id="scenarii">
  <div class="akos-cnt">
    <div class="akos-sh">
      <span class="akos-eyebrow">EdTech-сегменты</span>
      <h2>Сценарии внедрения AI-куратора в EdTech</h2>
    </div>
    <div class="akos-grid-3">
      <div class="akos-card nero-ai-reveal">
        <h3>Онлайн-школы и авторские курсы</h3>
        <p>GetCourse → webhooks → n8n/Make → Telegram → RAG (YandexGPT / GigaChat) → amoCRM. Пилот <strong>4–6 недель</strong> на потоке 50–200 учеников.</p>
      </div>
      <div class="akos-card nero-ai-reveal nero-ai-delay-1">
        <h3>Репетиторские центры и мини-группы</h3>
        <p>Кейс DigitalKir («Мелодия»): бот-учитель 24/7 в Telegram, эскалация на преподавателя. AI снимает рутину «где ноты?», «как сдать?».</p>
      </div>
      <div class="akos-card nero-ai-reveal nero-ai-delay-2">
        <h3>Корпоративное обучение</h3>
        <p>LMS (Moodle, кастом) + CRM + мессенджер. AI отслеживает обязательные модули, напоминает о сертификации, эскалирует HR при риске.</p>
      </div>
    </div>
  </div>
</section>

<section class="akos-section" id="integracii">
  <div class="akos-cnt">
    <div class="akos-sh">
      <span class="akos-eyebrow">LMS + CRM</span>
      <h2>Интеграция с LMS и CRM: GetCourse, Moodle и другие</h2>
      <p>Миграция с GetCourse не требуется — AI-куратор подключается через API и webhooks.</p>
    </div>
    <p class="akos-related nero-ai-reveal" style="margin-bottom:20px;font-size:15px">Для воронки «лид → оплата → обучение» часто уже используется amoCRM: <a href="/vnedrenie-ai-amocrm/">AI-агент для amoCRM под ключ</a> закрывает смежный контур — автоматические задачи и заметки при эскалации от AI-куратора.</p>
    <p class="akos-related nero-ai-reveal" style="margin-bottom:24px;font-size:15px">Если школа получает заявки и вопросы по email, имеет смысл сразу связать канал с CRM: <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработка входящей почты в CRM</a> маршрутизирует письма до того, как ученик «зависнет» без ответа.</p>
    <p class="akos-related nero-ai-reveal" style="margin-bottom:24px;font-size:15px">В корпоративном обучении с учётом в ERP добавьте к LMS-контуру <a href="/ai-1c-erp/">AI-агента для 1С и ERP</a> — согласование заявок на обучение и отчётность без двойного ввода.</p>
    <div class="akos-card nero-ai-reveal" style="margin-bottom:24px;">
      <h3>Подключение к существующей LMS без смены платформы</h3>
      <ol style="padding-left:20px;color:var(--akos-muted);line-height:1.8;">
        <li>LMS отправляет события через API/webhooks</li>
        <li>n8n / Make / Albato обрабатывает триггеры</li>
        <li>AI формирует ответ или напоминание</li>
        <li>Доставка: Telegram, email, VK</li>
      </ol>
    </div>
    <div class="akos-table-wrap nero-ai-reveal">
      <table class="akos-table">
        <thead><tr><th>Функция</th><th>Штатный GetCourse</th><th>+ AI-слой Nero Network</th></tr></thead>
        <tbody>
          <tr><td>Напоминания о ДЗ</td><td>Шаблонные</td><td>Персонализированные, контекстные</td></tr>
          <tr><td>Ответы на вопросы</td><td>Нет</td><td>RAG по материалам курса</td></tr>
          <tr><td>Проверка ДЗ</td><td>Ручная / тесты</td><td>Первичная AI + эскалация</td></tr>
          <tr><td>Risk scoring</td><td>Нет</td><td>Дашборд с объяснимыми факторами</td></tr>
          <tr><td>Тон</td><td>Формальный</td><td>Тон школы</td></tr>
        </tbody>
      </table>
    </div>
    <div class="akos-card nero-ai-reveal" style="margin-top:28px;">
      <h3>Синхронизация с CRM и воронкой обучения</h3>
      <p>amoCRM, Bitrix24: заметки при эскалации, смена ответственного при risk score, связка лид → оплата → онбординг → удержание. Настройку выполняет интегратор — <strong>без программиста на стороне школы</strong>.</p>
    </div>
  </div>
</section>

<section class="akos-section akos-section-alt" id="keisy">
  <div class="akos-cnt">
    <div class="akos-sh">
      <span class="akos-eyebrow">Примеры</span>
      <h2>Кейсы и примеры внедрения AI-куратора</h2>
    </div>
    <div class="akos-case-grid">
      <div class="akos-case-card nero-ai-reveal">
        <div class="akos-case-tag">РФ · School-master</div>
        <h3>ИИ-куратор внутри GetCourse</h3>
        <p>Проверка ДЗ, ответы в уроке, автопополнение KB. Модель «ИИ готовит — человек утверждает».</p>
      </div>
      <div class="akos-case-card nero-ai-reveal nero-ai-delay-1">
        <div class="akos-case-tag">Международный · Coursera</div>
        <h3>Coursera Coach</h3>
        <div class="akos-metrics">
          <div class="akos-metric"><span class="num">+10%</span><span class="lbl">pass quiz с 1-й попытки</span></div>
          <div class="akos-metric"><span class="num">2,6 млн</span><span class="lbl">learners с Coach</span></div>
        </div>
      </div>
      <div class="akos-case-card nero-ai-reveal nero-ai-delay-2">
        <div class="akos-case-tag">Урок · Khanmigo</div>
        <h3>15% adoption без триггеров</h3>
        <p>Доступ к AI ≠ использование. Нужен проактивный UX внутри LMS.</p>
      </div>
    </div>
    <div class="akos-card nero-ai-reveal" style="margin-top:32px;">
      <h3>Типовые ошибки при запуске</h3>
      <ul>
        <li>«Голый чат» без триггеров LMS</li>
        <li>RAG без границ — AI отвечает вне программы</li>
        <li>Нет baseline-метрик для ROI</li>
        <li>Игнорирование 152-ФЗ</li>
        <li>Полная замена кураторов вместо гибрида</li>
        <li>Пилот на всём каталоге вместо одного потока</li>
      </ul>
    </div>
  </div>
</section>

<section class="akos-section" id="etapy">
  <div class="akos-cnt">
    <div class="akos-sh">
      <span class="akos-eyebrow">Под ключ</span>
      <h2>Этапы внедрения AI-куратора под ключ</h2>
    </div>
    <div class="akos-timeline nero-ai-reveal">
      <div class="akos-tl-item">
        <div class="akos-tl-dot"></div>
        <h3>Аудит точек выпадения (лид-магнит)</h3>
        <p><strong>Карта точек выпадения</strong> — бесплатный артефакт: онбординг → 1-е ДЗ → 1-й вебинар → модуль 2 → финал. Для каждой точки — % прохождения и текущие процессы.</p>
      </div>
      <div class="akos-tl-item">
        <div class="akos-tl-dot"></div>
        <h3>Настройка сценариев и обучение на материалах курса</h3>
        <p>RAG-база из 5–10 ключевых уроков, FAQ, критерии ДЗ. Модули: онбординг-бот, напоминания, RAG-ассистент, проверка ДЗ, risk scoring, дашборд, модерация.</p>
      </div>
      <div class="akos-tl-item">
        <div class="akos-tl-dot"></div>
        <h3>Пилот, замер ROI, масштабирование</h3>
        <p>4–6 недель на одном потоке. Метрики: % 1-го ДЗ, silent rate D+3/D+7, доходимость до модуля 2, доля AI-закрытых обращений, NPS.</p>
      </div>
    </div>
  </div>
</section>

<div class="akos-cnt">
  <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации EdTech сами?</p>
      <p class="ym-cta-block__sub">Перед запуском пилота полезно понимать n8n, RAG, human-in-the-loop и интеграцию с GetCourse — это ускоряет согласование сценариев с методистами. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
    </div>
  </aside>
</div>

<section class="akos-section akos-section-alt" id="ceny">
  <div class="akos-cnt">
    <div class="akos-sh">
      <span class="akos-eyebrow">Цена</span>
      <h2>Стоимость внедрения AI-куратора для онлайн-школы</h2>
    </div>
    <div class="akos-grid-2 nero-ai-reveal">
      <div class="akos-card">
        <h3>Что входит в проект под ключ</h3>
        <ul>
          <li>Аудит и карта точек выпадения</li>
          <li>LMS + CRM + мессенджер</li>
          <li>RAG-база и сценарии</li>
          <li>Дашборд куратора и обучение команды</li>
          <li>Пилот с отчётом по метрикам</li>
          <li>Compliance 152-ФЗ, YandexGPT/GigaChat</li>
        </ul>
      </div>
      <div class="akos-card">
        <h3>От чего зависит цена</h3>
        <div class="akos-table-wrap">
          <table class="akos-table">
            <thead><tr><th>Фактор</th><th>Влияние</th></tr></thead>
            <tbody>
              <tr><td>Потоки и курсы</td><td>Больше KB и сценариев</td></tr>
              <tr><td>Сложность ДЗ</td><td>Больше эскалаций</td></tr>
              <tr><td>Интеграции</td><td>LMS + CRM + каналы</td></tr>
              <tr><td>LLM</td><td>РФ vs зарубежные</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:16px;"><strong>Ориентиры 2026:</strong> пилот <strong>150–300 тыс. ₽</strong>, полный контур <strong>150–450 тыс. ₽</strong> (Nero Network) до <strong>900 тыс. ₽</strong> на рынке.</p>
      </div>
    </div>
  </div>
</section>

<div class="akos-cnt">
  <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Узнайте бюджет под ваш поток учеников</p>
      <p class="ym-cta-block__sub">Ориентир 150–450 тыс. ₽ за внедрение под ключ. На аудите дадим карту точек выпадения, оценку сроков и ROI — бесплатно.</p>
      <div class="ym-cta-block__actions">
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
      </div>
    </div>
  </div>
</div>

<section class="akos-section" id="roi">
  <div class="akos-cnt">
    <div class="akos-sh">
      <span class="akos-eyebrow">Окупаемость</span>
      <h2>ROI: как измерить снижение недоходимости</h2>
    </div>
    <div class="akos-grid-2 nero-ai-reveal">
      <div class="akos-card">
        <h3>KPI пилота</h3>
        <ul>
          <li><strong>Доходимость</strong> — % до модуля/финала</li>
          <li><strong>1-е ДЗ</strong> — доля сдавших в первую неделю</li>
          <li><strong>Silent rate</strong> — «молчащие» D+3 / D+7</li>
          <li><strong>Время ответа</strong> — медиана первого касания</li>
          <li><strong>Доля AI-закрытых обращений</strong></li>
        </ul>
      </div>
      <div class="akos-table-wrap">
        <table class="akos-table">
          <thead><tr><th>Масштаб</th><th>Поток</th><th>Эффект</th><th>Окупаемость</th></tr></thead>
          <tbody>
            <tr><td>Малый</td><td>30–50</td><td>Удержание 3–5 чел.</td><td>1–2 потока</td></tr>
            <tr><td>Средний</td><td>100–200</td><td>Удержание 5–10 чел.</td><td>1 поток</td></tr>
            <tr><td>Крупный</td><td>500+</td><td>−ФОТ на рутину + удержание</td><td>Пилот</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<section class="akos-section akos-section-alt" id="faq">
  <div class="akos-cnt">
    <div class="akos-sh">
      <span class="akos-eyebrow">FAQ</span>
      <h2>FAQ по AI-куратору для онлайн-школ</h2>
    </div>
    <div class="akos-faq">
      <div class="akos-faq-item">
        <div class="akos-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить AI-куратора без программиста?</div>
        <div class="akos-faq-a"><p>На стороне школы программист не нужен. Nero Network настраивает LMS → n8n/Make → Telegram → LLM → CRM. Срок пилота — <strong>4–6 недель</strong>.</p></div>
      </div>
      <div class="akos-faq-item">
        <div class="akos-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит AI-куратор для онлайн-школы?</div>
        <div class="akos-faq-a"><p>Пилот — от <strong>150 тыс. ₽</strong>, полный контур — <strong>150–450 тыс. ₽</strong> (Nero Network) до <strong>900 тыс. ₽</strong> на рынке. Точная смета — после аудита.</p></div>
      </div>
      <div class="akos-faq-item">
        <div class="akos-faq-q" role="button" tabindex="0" aria-expanded="false">Безопасны ли персональные данные учеников (152-ФЗ)?</div>
        <div class="akos-faq-a"><p>С 01.09.2025 согласие — отдельный документ. Nero Network использует YandexGPT / GigaChat для данных в РФ, серверы Albato в РФ, оформляет политику — в т.ч. для несовершеннолетних.</p></div>
      </div>
      <div class="akos-faq-item">
        <div class="akos-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли решение для малого бизнеса?</div>
        <div class="akos-faq-a"><p>Да. Пилот на одном потоке (50–100 учеников). MVP возможен за 2–3 недели — дешевле найма куратора на полную ставку.</p></div>
      </div>
      <div class="akos-faq-item">
        <div class="akos-faq-q" role="button" tabindex="0" aria-expanded="false">Заменит ли AI живого куратора?</div>
        <div class="akos-faq-a"><p>Нет. AI закрывает рутину; человек — творческие ДЗ, конфликты, мотивацию. Гибридная модель — стандарт рынка.</p></div>
      </div>
      <div class="akos-faq-item">
        <div class="akos-faq-q" role="button" tabindex="0" aria-expanded="false">Бот будет «врать» ученикам?</div>
        <div class="akos-faq-a"><p>RAG ограничен материалами курса. При низкой уверенности — эскалация. На пилоте спорные ответы проходят модерацию.</p></div>
      </div>
      <div class="akos-faq-item">
        <div class="akos-faq-q" role="button" tabindex="0" aria-expanded="false">GetCourse и так умеет напоминать — зачем AI?</div>
        <div class="akos-faq-a"><p>Штатные напоминания шаблонные и не отвечают на вопросы. AI добавляет контекст, язык, проверку ДЗ и risk score — второй слой поверх процессов LMS.</p></div>
      </div>
    </div>
  </div>
</section>

<section class="akos-section" id="zakazat">
  <div class="akos-cnt">
    <div class="akos-sh">
      <span class="akos-eyebrow">CTA</span>
      <h2>Заказать внедрение AI-куратора</h2>
      <p>Nero Network запускает <strong>измеримый пилот</strong> с картой точек выпадения, baseline и дашбордом риска — не «ещё одного бота».</p>
    </div>
    <ul class="akos-cta-checklist">
      <li>Напоминания о домашках и ответы по курсу</li>
      <li>GetCourse, Moodle, amoCRM, Telegram</li>
      <li>Compliance 152-ФЗ</li>
      <li>Отчёт: 1-е ДЗ, silent rate, доходимость</li>
    </ul>
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-zakazat">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Снизить недоходимость в вашей онлайн-школе</p>
        <p class="ym-cta-block__sub">Подготовим <strong>Карту точек выпадения учеников</strong> и расчёт стоимости внедрения AI-куратора под ключ.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>
</section>

</div><!-- /.akos-content -->

<script>
(function(){
  document.querySelectorAll('.akos-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.akos-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.akos-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.akos-faq-q');
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
  var root = document.querySelector('.akos-content');
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
$schema_origin  = untrailingslashit(home_url('/'));
$schema_page    = untrailingslashit(get_permalink());
$schema_org_id  = $schema_origin . '/#organization';
$schema_site_id = $schema_origin . '/#website';
$schema_graph   = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type' => 'Organization',
            '@id'   => $schema_org_id,
            'name'  => $brand ?: 'Nero Network',
            'url'   => $schema_origin . '/',
        ],
        [
            '@type'     => 'WebSite',
            '@id'       => $schema_site_id,
            'url'       => $schema_origin . '/',
            'name'      => $brand ?: 'Nero Network',
            'publisher' => ['@id' => $schema_org_id],
        ],
        [
            '@type'       => 'WebPage',
            '@id'         => $schema_page . '#webpage',
            'url'         => $schema_page . '/',
            'name'        => $page_seo_title,
            'description' => $page_seo_description,
            'isPartOf'    => ['@id' => $schema_site_id],
            'about'       => ['@id' => $schema_org_id],
        ],
        [
            '@type'           => 'BreadcrumbList',
            '@id'             => $schema_page . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $schema_origin . '/'],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $schema_page . '/'],
            ],
        ],
        [
            '@type'       => 'Service',
            '@id'         => $schema_page . '#service',
            'name'        => $page_seo_title,
            'description' => $page_seo_description,
            'url'         => $schema_page . '/',
            'provider'    => ['@id' => $schema_org_id],
        ],
        [
            '@type'      => 'FAQPage',
            '@id'        => $schema_page . '#faq',
            'mainEntity' => [
                ['@type' => 'Question', 'name' => 'Как внедрить AI-куратора без программиста?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'На стороне школы программист не нужен. Nero Network настраивает LMS → n8n/Make → Telegram → LLM → CRM. Срок пилота — 4–6 недель.']],
                ['@type' => 'Question', 'name' => 'Сколько стоит AI-куратор для онлайн-школы?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Пилот — от 150 тыс. ₽, полный контур — 150–450 тыс. ₽ (Nero Network) до 900 тыс. ₽ на рынке. Точная смета — после аудита.']],
                ['@type' => 'Question', 'name' => 'Безопасны ли персональные данные учеников (152-ФЗ)?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'С 01.09.2025 согласие — отдельный документ. Nero Network использует YandexGPT / GigaChat для данных в РФ, серверы Albato в РФ, оформляет политику — в т.ч. для несовершеннолетних.']],
                ['@type' => 'Question', 'name' => 'Подходит ли решение для малого бизнеса?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Да. Пилот на одном потоке (50–100 учеников). MVP возможен за 2–3 недели — дешевле найма куратора на полную ставку.']],
                ['@type' => 'Question', 'name' => 'Заменит ли AI живого куратора?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Нет. AI закрывает рутину; человек — творческие ДЗ, конфликты, мотивацию. Гибридная модель — стандарт рынка.']],
                ['@type' => 'Question', 'name' => 'Бот будет «врать» ученикам?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'RAG ограничен материалами курса. При низкой уверенности — эскалация. На пилоте спорные ответы проходят модерацию.']],
                ['@type' => 'Question', 'name' => 'GetCourse и так умеет напоминать — зачем AI?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Штатные напоминания шаблонные и не отвечают на вопросы. AI добавляет контекст, язык, проверку ДЗ и risk score — второй слой поверх процессов LMS.']],
            ],
        ],
    ],
];
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema_graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>


</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

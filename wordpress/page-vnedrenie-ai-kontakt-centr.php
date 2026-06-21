<?php
/**
 * Template Name: AI для контакт-центра: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI в контакт-центр. Кейсы, интеграции, цены. Аудит нагрузки бесплатно.
 */

$page_seo_title       = 'AI для контакт-центра: внедрение и настройка под ключ';
$page_seo_description = 'Внедрим AI для контакт-центра: маршрутизация обращений, подсказки оператору и автоответы. Снизим нагрузку на операторов и затраты поддержки. Бесплатный аудит нагрузки колл-центра.';

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
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Снизить нагрузку';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Какие задачи решает AI';
$secondary_cta_url = '#zadachi';
$secondary_training_url = nero_ai_resolve_env('SECONDARY_CTA_URL');
if ($secondary_training_url === '' || nero_ai_is_placeholder_cta_url($secondary_training_url)) {
    $secondary_training_url = nero_ai_primary_cta_url();
}
$secondary_training_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI';
$secondary_training_attrs = nero_ai_external_link_attrs($secondary_training_url);

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

/* Hero vnkc — full viewport */
.vnkc-hero-cc{min-height:100vh;min-height:100dvh;position:relative;}
.vnedrenie-ai-kontakt-centr-page .ym-cta-block--secondary{
  background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;
}
.vnedrenie-ai-kontakt-centr-page .ym-link--accent{color:var(--vna-accent)!important;text-decoration:underline;}
.vna-prose{max-width:860px;margin:0 auto;}
.vna-prose h3{font-size:19px;margin:28px 0 12px;}
.vna-prose p{margin-bottom:1em;}
.vna-prose em{color:var(--vna-soft);font-style:normal;}
.vna-quote{
  border-left:3px solid var(--vna-violet);padding:12px 18px;margin:20px 0;
  background:rgba(139,92,246,.08);border-radius:0 12px 12px 0;font-size:14px;color:var(--vna-soft);
}
.vna-ol{counter-reset:vnkc;padding-left:0;list-style:none;margin:0 0 1em;}
.vna-ol li{
  counter-increment:vnkc;padding-left:28px;position:relative;margin-bottom:.5em;
  color:var(--vna-muted);font-size:14.5px;line-height:1.65;
}
.vna-ol li::before{
  content:counter(vnkc);position:absolute;left:0;top:0;
  width:20px;height:20px;border-radius:50%;background:rgba(121,242,255,.15);
  color:var(--vna-accent);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;
}

</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-kontakt-centr-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnkc-hero-cc" id="hero" aria-labelledby="hero-kontakt-centr-title">
<style>
/* === vnkc-hero-cc — self-contained hero (nero-ai-home-page dark) === */
.vnkc-hero-cc {
  --vnkc-cyan: #79f2ff;
  --vnkc-violet: #8b5cf6;
  --vnkc-green: #22c55e;
  --vnkc-amber: #fbbf24;
  --vnkc-text: #e6edf7;
  --vnkc-soft: #c7d2e5;
  --vnkc-muted: #9aa8bd;
  --vnkc-shadow: 0 24px 72px rgba(0,0,0,.4);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnkc-hero-cc::before {
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
.vnkc-hero-cc::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(56, 189, 248, .14), transparent 66%);
  filter: blur(6px);
  animation: vnkcHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnkcHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vnkc-hero-cc .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnkc-hero-cc .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnkc-hero-cc .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnkc-hero-cc .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnkc-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnkc-hero-cc .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(56, 189, 248, 0.22);
  border-radius: 999px;
  background: rgba(56, 189, 248, 0.08);
  color: var(--vnkc-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnkc-hero-cc .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnkc-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnkc-hero-cc .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnkc-hero-cc .nero-ai-badge {
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
.vnkc-hero-cc .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnkc-hero-cc .nero-ai-btn {
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
.vnkc-hero-cc .nero-ai-btn:hover { transform: translateY(-2px); }
.vnkc-hero-cc .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnkc-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(56, 189, 248, 0.22);
}
.vnkc-hero-cc .nero-ai-btn-secondary {
  color: var(--vnkc-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnkc-hero-cc .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnkc-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnkc-hero-cc .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnkc-hero-cc .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnkc-hero-cc .nero-ai-dots { display: flex; gap: 7px; }
.vnkc-hero-cc .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,.22); }
.vnkc-hero-cc .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnkc-hero-cc .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnkc-hero-cc .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnkc-hero-cc .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnkc-hero-cc .nero-ai-window-body { padding: 18px; }
.vnkc-hero-cc .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
}
.vnkc-hero-cc .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnkc-hero-cc .nero-ai-live-pill {
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
.vnkc-hero-cc .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnkcPulse 1.6s infinite;
}
@keyframes vnkcPulse {
  0%, 100% { box-shadow: 0 0 0 6px rgba(34,197,94,.14); }
  50% { box-shadow: 0 0 0 10px rgba(34,197,94,.06); }
}
.vnkc-hero-cc .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
  margin-bottom: 12px;
}
.vnkc-hero-cc .nero-ai-metric {
  padding: 12px;
  border-radius: 16px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.vnkc-hero-cc .nero-ai-metric span {
  display: block;
  color: var(--vnkc-muted);
  font-size: 11px;
  font-weight: 600;
  margin-bottom: 4px;
}
.vnkc-hero-cc .nero-ai-metric strong {
  display: block;
  color: #f8fafc;
  font-size: 22px;
  font-weight: 900;
  letter-spacing: -0.04em;
  line-height: 1;
}
.vnkc-hero-cc .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #64748b;
  font-size: 10px;
}
.vnkc-hero-cc .vnkc-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(56, 189, 248, 0.16);
  background: radial-gradient(ellipse at 50% 20%, rgba(56,189,248,.08), rgba(6,10,24,.92) 72%);
}
.vnkc-hero-cc #vnkc-cc-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnkc-hero-cc .nero-ai-task-stream { display: grid; gap: 8px; }
.vnkc-hero-cc .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnkc-hero-cc .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(56,189,248,.12);
  color: var(--vnkc-cyan);
  font-size: 11px;
  font-weight: 800;
}
.vnkc-hero-cc .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnkc-hero-cc .nero-ai-task span {
  color: var(--vnkc-muted);
  font-size: 11px;
}
.vnkc-hero-cc .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnkc-hero-cc .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
.vnkc-hero-cc .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vnkc-hero-cc .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnkc-hero-cc .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vnkc-hero-cc .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnkc-hero-cc .nero-ai-window-body { padding: 12px; }
  .vnkc-hero-cc .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnkc-hero-cc .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow"><?php echo esc_html(($brand ?? get_bloginfo('name')) ?: 'Nero Network'); ?> · ai контакт-центр</p>
    <h1 id="hero-kontakt-centr-title">AI для контакт-центра: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
    <p class="nero-ai-hero-lead">Маршрутизация обращений, подсказки оператору и автоответы — снизьте нагрузку на колл-центр без роста штата</p>
    <ul class="nero-ai-badges" aria-label="Ключевые возможности">
      <li class="nero-ai-badge">Маршрутизация</li>
      <li class="nero-ai-badge">Copilot оператору</li>
      <li class="nero-ai-badge">Автоответы</li>
      <li class="nero-ai-badge">Аудит бесплатно</li>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="#zadachi">Как это работает</a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация AI-обработки обращений контакт-центра">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3>Contact Center · демо</h3>
          <span class="nero-ai-live-pill">онлайн</span>
        </div>
        <div class="nero-ai-metrics-grid">
          <div class="nero-ai-metric">
            <span>Deflection</span>
            <strong>65%</strong>
            <small>бенчмарк Сбер, 2026</small>
          </div>
          <div class="nero-ai-metric">
            <span>AHT</span>
            <strong>−6%</strong>
            <small>IBM / McKinsey</small>
          </div>
          <div class="nero-ai-metric">
            <span>FCR</span>
            <strong>&gt;80%</strong>
            <small>Ростелеком КЦ</small>
          </div>
          <div class="nero-ai-metric">
            <span>Очередь</span>
            <strong>live</strong>
            <small>маршрутизация AI</small>
          </div>
        </div>

        <div class="vnkc-dash-canvas-wrap" aria-hidden="false">
          <canvas id="vnkc-cc-hero-canvas" role="img" aria-label="Анимация: обращения из каналов каскадом маршрутизируются — бот закрывает типовые, оператор получает copilot-подсказки"></canvas>
        </div>

        <div class="nero-ai-task-stream" aria-label="Лента событий контакт-центра">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">IN</span>
            <div><strong>Входящий звонок · VIP</strong><span>Канал: голос · очередь «Продажи»</span></div>
            <span class="nero-ai-status nero-ai-status--amber">вход</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">AI</span>
            <div><strong>Маршрутизация интента</strong><span>«Статус заказа» · confidence 0.94</span></div>
            <span class="nero-ai-status nero-ai-status--violet">router</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">BOT</span>
            <div><strong>Автоответ без оператора</strong><span>Deflection · CRM обновлена</span></div>
            <span class="nero-ai-status">закрыто</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">OP</span>
            <div><strong>Copilot оператору</strong><span>Подсказка: next best action · саммари диалога</span></div>
            <span class="nero-ai-status">assist</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
/**
 * vnkc-cc-hero-engine — Диспетчерский мост «Омниканальный водопад очередей»
 * Мир: каналы → каскад тикетов → маршрутизатор → бот / оператор+copilot → FCR
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnkc-cc-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 300) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    hubBase: "#1e293b",
    hubScreen: "#0f172a",
    copilot: "#8b5cf6",
    botPod: "#0ea5e9",
    ticket: "#f8fafc",
    ticketUrgent: "#fde68a",
    routeLine: "rgba(139,92,246,0.45)",
    deflectGreen: "#22c55e",
    queueHot: "#f97316",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    bubbleAccent: "#38bdf8"
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

  /* Вертикальный каскад тикетов — транспорт (не Conveyor) */
  function TicketCascadeStream() {
    this.wave = 0;
  }
  TicketCascadeStream.prototype.draw = function (ctx) {
    this.wave = Math.sin(frame * 0.06) * 3;
    var prg = (frame * 0.035) % 280;

    /* Водопадные линии */
    for (var lane = -1; lane <= 1; lane++) {
      var lx = lane * 55;
      ctx.strokeStyle = "rgba(56,189,248," + (0.12 + lane * 0.02) + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.6;
      ctx.beginPath();
      ctx.moveTo(lx, -95);
      ctx.lineTo(lx + this.wave, 75);
      ctx.stroke();
      ctx.setLineDash([]);
    }

    /* Падающие тикеты по фазам */
    var tickets = [
      { phase: 0, lane: -1, color: C.ticket },
      { phase: 35, lane: 0, color: C.ticketUrgent },
      { phase: 70, lane: 1, color: C.ticket },
      { phase: 140, lane: -1, color: C.ticket },
      { phase: 175, lane: 1, color: C.ticketUrgent }
    ];
    tickets.forEach(function (t) {
      var local = (prg - t.phase + 280) % 280;
      if (local < 0 || local > 90) return;
      var ty = -90 + (local / 90) * 120;
      var tx = t.lane * 55 + Math.sin(local * 0.12 + t.lane) * 6;
      drawTicket(ctx, tx, ty, 16, 12, t.color);
    });
  };

  function drawTicket(ctx, x, y, w, h, color) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -w / 2, -h / 2, w, h, 3, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("?", 0, 3);
    ctx.restore();
  }

  /* Входные каналы — телефон, чат, email */
  function ChannelIngressGate() {
    this.pulse = 0;
  }
  ChannelIngressGate.prototype.draw = function (ctx) {
    var channels = [
      { x: -70, icon: "☎", label: "voice" },
      { x: 0, icon: "💬", label: "chat" },
      { x: 70, icon: "✉", label: "email" }
    ];
    channels.forEach(function (ch, i) {
      var glow = 0.35 + Math.sin(frame * 0.08 + i) * 0.2;
      ctx.fillStyle = "rgba(56,189,248," + glow + ")";
      ctx.beginPath();
      ctx.arc(ch.x, -108, 14 + glow * 4, 0, Math.PI * 2);
      ctx.fill();
      drawRR(ctx, ch.x - 16, -122, 32, 22, 8, "rgba(15,23,42,0.85)", C.outline);
      ctx.font = "12px sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(ch.icon, ch.x, -107);
      ctx.fillStyle = "#94a3b8";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText(ch.label, ch.x, -88);
    });
  };

  /* Ромб-классификатор интентов */
  function IntentRouterNode() {
    this.spin = 0;
  }
  IntentRouterNode.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 280;
    this.spin = (frame * 0.02) % (Math.PI * 2);
    ctx.save();
    ctx.translate(0, -35);
    ctx.rotate(this.spin * 0.15);
    ctx.fillStyle = prg >= 55 && prg < 115 ? "rgba(139,92,246,0.35)" : "rgba(139,92,246,0.15)";
    ctx.strokeStyle = C.copilot;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(0, -22);
    ctx.lineTo(22, 0);
    ctx.lineTo(0, 22);
    ctx.lineTo(-22, 0);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ROUTER", 0, 3);
    ctx.restore();

    if (prg >= 60 && prg < 110) {
      ctx.strokeStyle = C.routeLine;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(-18, -30);
      ctx.quadraticCurveTo(-55, 10, -75, 45);
      ctx.stroke();
      ctx.beginPath();
      ctx.moveTo(18, -30);
      ctx.quadraticCurveTo(55, 5, 0, 55);
      ctx.stroke();
    }
  };

  /* Под ботом — автоответ */
  function BotDeflectionPod() {
    this.flash = 0;
  }
  BotDeflectionPod.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 280;
    drawRR(ctx, -95, 28, 48, 38, 8, "rgba(14,165,233,0.18)", C.botPod);
    ctx.fillStyle = C.botPod;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("BOT", -71, 42);
    ctx.font = "6px Inter,sans-serif";
    ctx.fillStyle = "#bae6fd";
    ctx.fillText("deflect", -71, 52);

    if (prg >= 110 && prg < 165) {
      var t = (prg - 110) / 55;
      drawTicket(ctx, -71 + t * 5, -10 + t * 45, 14, 10, C.ticket);
    }
    if (prg >= 155 && prg < 175) {
      this.flash = (prg - 155) / 20;
      ctx.strokeStyle = "rgba(34,197,94," + (0.9 - this.flash * 0.7) + ")";
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.arc(-71, 48, 18 + this.flash * 28, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = C.deflectGreen;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("✓ авто", -71, 50);
    }
  };

  /* Центральный хаб оператора + copilot */
  function OperatorCopilotHub() {
    this.hintAlpha = 0;
    this.fcrRipple = 0;
  }
  OperatorCopilotHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 280;

    drawRR(ctx, -48, 38, 96, 72, 10, C.hubBase, C.outline);
    drawRR(ctx, -40, 46, 38, 28, 4, C.hubScreen, C.outline);
    drawRR(ctx, 2, 46, 38, 28, 4, C.hubScreen, C.outline);

    /* Гарнитура оператора */
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, 42, 10, Math.PI, 0);
    ctx.stroke();

    /* Copilot-панель */
    drawRR(ctx, 52, 40, 42, 58, 6, "rgba(139,92,246,0.2)", C.copilot);
    ctx.fillStyle = "#ddd6fe";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI", 73, 52);
    ctx.fillText("copilot", 73, 62);

    if (prg >= 160 && prg < 215) {
      this.hintAlpha = Math.min(1, (prg - 160) / 20);
      var hints = ["Статус заказа", "Next Q", "Саммари"];
      hints.forEach(function (h, i) {
        ctx.globalAlpha = this.hintAlpha;
        drawRR(ctx, 54, 66 + i * 14, 38, 11, 3, "rgba(255,255,255,0.12)", null);
        ctx.fillStyle = "#e9d5ff";
        ctx.font = "6px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(h, 57, 74 + i * 14);
        ctx.globalAlpha = 1;
      }, this);

      if (prg > 175 && prg < 210) {
        var ticketT = (prg - 175) / 35;
        drawTicket(ctx, 20 - ticketT * 35, -5 + ticketT * 55, 14, 10, C.ticketUrgent);
      }
    }

    if (prg >= 215) {
      var fprg = prg - 215;
      this.fcrRipple = fprg / 65;
      ctx.strokeStyle = "rgba(34,197,94," + (0.85 - this.fcrRipple * 0.8) + ")";
      ctx.lineWidth = 2.5;
      ctx.beginPath();
      ctx.arc(0, 72, 12 + this.fcrRipple * 45, 0, Math.PI * 2);
      ctx.stroke();
      if (fprg > 25 && fprg < 55) {
        ctx.fillStyle = C.deflectGreen;
        ctx.font = "bold 9px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("FCR ✓", 0, 28);
      }
    }
  };

  /* Полоса нагрузки очередей */
  function QueueHeatmapStrip() {
    this.levels = [0.4, 0.65, 0.3, 0.8];
  }
  QueueHeatmapStrip.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 280;
    this.levels = this.levels.map(function (lv, i) {
      return 0.25 + 0.55 * (0.5 + 0.5 * Math.sin(frame * 0.04 + i * 1.7));
    });
    drawRR(ctx, -155, -75, 28, 90, 4, "rgba(255,255,255,0.05)", C.outline);
    this.levels.forEach(function (lv, i) {
      var h = lv * 18;
      var col = lv > 0.7 ? C.queueHot : C.deflectGreen;
      drawRR(ctx, -151, -5 - i * 22, 20, h, 2, col, null);
    });
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.save();
    ctx.translate(-141, -82);
    ctx.rotate(-Math.PI / 2);
    ctx.fillText("QUEUE", 0, 0);
    ctx.restore();
  };

  /* Рампа эскалации */
  function EscalationHandoffRamp() {
    this.active = false;
  }
  EscalationHandoffRamp.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 280;
    drawRR(ctx, 108, 15, 36, 55, 6, "rgba(251,191,36,0.12)", "#fbbf24");
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("HUMAN", 126, 35);
    ctx.fillText("esc", 126, 45);

    if (prg >= 165 && prg < 200) {
      this.active = true;
      ctx.strokeStyle = "rgba(251,191,36,0.6)";
      ctx.lineWidth = 2;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(90, 5);
      ctx.lineTo(50, 50);
      ctx.stroke();
      ctx.setLineDash([]);
    } else {
      this.active = false;
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
    var prg = (frame * 0.035) % 280;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -120, y: -55 },
      "2_seo": { x: -50, y: -48 },
      "3_coder": { x: -80, y: 15 },
      "4_designer": { x: 35, y: 8 },
      "5_deployer": { x: 115, y: -20 }
    };
    var tgt = targets[this.role] || { x: 0, y: 0 };

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

    if (!isMoving && frame % 240 === 0 && Math.random() < 0.11) {
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
  entities.push(new TicketCascadeStream());
  entities.push(new ChannelIngressGate());
  entities.push(new QueueHeatmapStrip());
  entities.push(new IntentRouterNode());
  entities.push(new BotDeflectionPod());
  entities.push(new EscalationHandoffRamp());
  entities.push(new OperatorCopilotHub());
  entities.push(new Agent(-145, 98, C.agentYellow, "1_architect", 20, [
    "Карта очередей готова", "VIP → приоритет", "IVR заменим на AI"
  ]));
  entities.push(new Agent(-85, 105, C.agentGreen, "2_seo", 58, [
    "Интент: статус заказа", "Таксономия 20 тем", "Confidence 0.94"
  ]));
  entities.push(new Agent(-25, 108, C.agentBlue, "3_coder", 105, [
    "Порог эскалации 0.7", "RAG по FAQ", "Human-in-the-loop"
  ]));
  entities.push(new Agent(45, 105, C.agentPink, "4_designer", 155, [
    "Подсказка оператору", "Next best action", "Панель copilot"
  ]));
  entities.push(new Agent(120, 98, C.agentPurple, "5_deployer", 205, [
    "Пилот на линии 2", "Voximplant подключён", "AHT −6% на демо"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 250, maxLife: life || 250 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.035) % 280;
    if (prg >= 18 && prg < 18.05) createBubble(-60, -100, "1. Канал: звонок");
    if (prg >= 62 && prg < 62.05) createBubble(0, -40, "2. Router AI");
    if (prg >= 118 && prg < 118.05) createBubble(-75, 35, "3. Бот: deflection");
    if (prg >= 172 && prg < 172.05) createBubble(70, 30, "4. Copilot подсказка");
    if (prg >= 228 && prg < 228.05) createBubble(0, 15, "5. FCR закрыт");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.bubbleAccent);
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
</section>

<div class="vna-content">

  <section class="vna-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai контакт-центр</p>
          <p>AI для контакт-центра — это не виджет-чат на сайте, а связка технологий для обработки обращений в голосе, чате, email и мессенджерах: маршрутизация, автоответы, подсказки оператору, речевая аналитика и post-call automation. Nero Network внедряет такие решения под ключ: от аудита нагрузки до интеграции с телефонией и CRM.</p>
          <p>Операторы перегружены однотипными вопросами, а cost per contact растёт быстрее выручки. При этом 65% обращений в лидирующих банках уже закрываются с помощью ИИ — и рынок не ждёт. Если вы ищете <strong>внедрение AI в контакт-центр</strong> без раздувания штата, ниже — практическая карта: задачи, этапы, цены, кейсы Сбера, ВТБ, ОТП, Ростелекома и урок Klarna о гибридной модели.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Бенчмарки контакт-центра">
          <div class="vna-kpi-card"><div class="kv">65%</div><div class="kl">обращений через ИИ</div><div class="ks">Сбер, 2026</div></div>
          <div class="vna-kpi-card"><div class="kv">70%</div><div class="kl">клиентов через conversational AI к 2028</div><div class="ks">Gartner / IBM</div></div>
          <div class="vna-kpi-card"><div class="kv">&gt;80%</div><div class="kl">FCR после замены IVR</div><div class="ks">Ростелеком КЦ</div></div>
          <div class="vna-kpi-card"><div class="kv">500К+</div><div class="kl">ориентир чека внедрения</div><div class="ks">пилот от 2 недель</div></div>
        </div>
      </div>
    </div>
  </section>
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc ym-toc" aria-label="Оглавление статьи"><a href="#zadachi">Задачи</a><a href="#etapy">Этапы</a><a href="#stoimost">Стоимость</a><a href="#keisy">Кейсы</a><a href="#integracii">Интеграции</a><a href="#faq">FAQ</a></nav>
    </div>
  </div>
  <section class="vna-section vna-section-alt" id="pochemu-2026">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Тренды 2026</span>
        <h2>Почему контакт-центры внедряют AI в 2026 году</h2>
      </div>
      <div class="vna-prose nero-ai-reveal">
<p>Контакт-центр перестал быть «залом с гарнитурами». Сегодня это омниканальный хаб: телефон, чат на сайте, Telegram, VK, email, соцсети. Клиент ожидает ответ за секунды, а оператор тратит 40–60% смены на статус заказа, смену тарифа и повтор объяснений политики возврата. <strong>AI автоматизация бизнеса</strong> в поддержке — не хайп, а ответ на измеримую экономику: рост объёма при том же ФОТ.</p>
<h3 id="тренд-автоматизации-по-данным-ibm">Тренд автоматизации по данным IBM</h3>
<p>В январе 2026 года IBM опубликовала обзор <a href="https://www.ibm.com/think/insights/contact-center-automation-trends" target="_blank" rel="noopener noreferrer">Contact Center Automation Trends</a>. Ключевой сдвиг — от rule-based ботов к <strong>agentic AI</strong>: системам, которые не просто отвечают по скрипту, а ведут многошаговый диалог, вызывают API, оркестрируют несколько агентов и передают контекст человеку.</p>
<p>IBM выделяет пять приоритетных сценариев:</p>
<ol class="vna-ol"><li>1. <strong>Self-service агенты</strong> — закрытие типовых интентов без оператора.</li><li>2. <strong>Copilot для оператора</strong> — подсказки, саммари, next best action в реальном времени.</li><li>3. <strong>Auto-QA</strong> — оценка 100% диалогов вместо выборочного контроля.</li><li>4. <strong>Intelligent routing</strong> — маршрутизация по теме, навыкам, загрузке очереди.</li><li>5. <strong>Post-call automation</strong> — заполнение CRM, теги, задачи после разговора.</li></ol>
<p>Gartner (цитируется в материале IBM) прогнозирует: к <strong>2028 году не менее 70%</strong> клиентов начнут путь в сервисе через conversational AI. Для <strong>ai для бизнеса</strong> в сфере поддержки это означает: откладывать внедрение — значит проигрывать по скорости и стоимости контакта конкурентам, которые уже считают ROI в кварталах, а не в годах.</p>
<p>IBM подчёркивает: «Successfully deploying automation tools isn't about replacing human workers with technology—it's about intelligently optimizing processes». То есть <strong>ai контакт центр</strong> — это collaboration человека и машины, а не замена всей линии роботом.</p>
<h3 id="перегрузка-операторов-и-рост-затрат-на-п">Перегрузка операторов и рост затрат на поддержку</h3>
<p>Типовые боли in-house contact center и аутсорсинговой линии:</p>
<ul><li><strong>Повторяющиеся интенты</strong> — «где заказ», «как оформить возврат», «статус заявки» съедают до половины AHT.</li><li><strong>Длинный AHT</strong> — оператор ищет ответ в Confluence, переключается между CRM и телефонией, теряет контекст при переводе.</li><li><strong>Низкий FCR</strong> — клиент перезванивает, потому что первый ответ не решил проблему.</li><li><strong>QA по выборке</strong> — супервизор слушает 3–5% звонков; жалобы и нарушения скрипта всплывают постфактум.</li><li><strong>Разрыв каналов</strong> — клиент написал в чат, позвонил — оператор не видит историю.</li></ul>
<p>По бенчмаркам IBM/McKinsey (цит. в обзоре IBM): внедрение AI-агентов может дать <strong>снижение cost per call до 50%</strong> при росте CSAT; у банка с virtual assistant AHT сократился на <strong>6%</strong> за счёт «next best question».</p>
<p>В России картина ускоряется: по данным Банка России, <strong>две трети</strong> финорганизаций уже используют или планируют ИИ в горизонте трёх лет. Лидеры — страхование и крупнейшие банки. Для среднего <strong>контакт-центра</strong> вывод простой: технология перестала быть экзотикой enterprise — пилот на 1–2 сценариях доступен при чеке от 500 тыс. ₽.</p>
      </div>
    </div>
  </section>
  <section class="vna-section vna-section-alt" id="zadachi">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Задачи AI</span>
        <h2>Какие задачи решает AI для контакт-центра</h2>
      </div>
      <div class="vna-prose nero-ai-reveal">
<p><strong>Определение:</strong> AI для контакт-центра — набор технологий, которые автоматизируют и ускоряют обработку обращений в голосовых и цифровых каналах. Отличие от «чат-бота на сайте»: интеграция с телефонией, CRM, базой знаний, очередями, аналитикой KPI и регламентами эскалации. <strong>Нейросети для контакт-центра</strong> работают на всём пути обращения — от входа до записи в CRM.</p>
<div class="vna-table-wrap"><table class="vna-table">
<tr><th>Сценарий</th><th>Что делает AI</th><th>Метрика</th></tr>
<tr><td>Маршрутизация</td><td>Классифицирует обращение, направляет в нужную очередь</td><td>Сокращение переводов, время до ответа</td></tr>
<tr><td>Автоответ</td><td>Закрывает типовой интент в чате/голосе</td><td>Deflection rate, cost per contact</td></tr>
<tr><td>Copilot</td><td>Подсказки оператору, саммари, черновик ответа</td><td>AHT, FCR, CSAT</td></tr>
<tr><td>Речевая аналитика / QA</td><td>Оценка 100% диалогов, тренды жалоб</td><td>CSI, обращения в регулятор</td></tr>
<tr><td>Post-call</td><td>Автозаполнение CRM, теги, задачи</td><td>Время постобработки</td></tr>
</table></div>
<h3 id="маршрутизация-и-приоритизация-обращений">Маршрутизация и приоритизация обращений</h3>
<p>Интеллектуальная маршрутизация определяет <strong>интент</strong>, язык, срочность, VIP-статус по CRM и направляет обращение оператору с нужным навыком или в очередь бота.</p>
<p>Кейс СТД «Петрович» (интегратор «Обит», <a href="https://www.cnews.ru/news/line/2026-03-05_obit_pomogaet_avtomatizirovat" target="_blank" rel="noopener noreferrer">CNews, март 2026</a>): речевая аналитика + LLM-классификация <strong>20 тыс. звонков</strong>, трёхуровневая таксономия. Точность классификации — <strong>89,03%</strong>, срок проекта — <strong>около 3 недель</strong>. Это пример <strong>ai контакт центр для среднего бизнеса</strong>: не год разработки, а быстрый пилот на звонках.</p>
<p>Ростелеком Контакт-центр (<a href="https://www.cnews.ru/news/line/2026-04-06_rostelekom_kontakt-tsentr" target="_blank" rel="noopener noreferrer">CNews, апрель 2026</a>) комбинирует мультиагентную систему и RPA: агенты обрабатывают сложные кейсы параллельно, робот заменяет классический IVR. Результат — <strong>FCR более 80%</strong> после замены IVR на conversational AI.</p>
<h3 id="подсказки-оператору-ai-copilot-в-реаль">Подсказки оператору (AI copilot) в реальном времени</h3>
<p><strong>AI-assist / copilot</strong> — подсказки в реальном времени: поиск по базе знаний, «следующий лучший вопрос», суммаризация диалога, черновик ответа в чате.</p>
<p>ВТБ на конференции ЦИПР 2026 (<a href="https://www.mk.ru/economics/2026/05/20/vtb-na-konferencii-cipr-rasskazal-o-vnedrenii-generativnogo-ii.html" target="_blank" rel="noopener noreferrer">МК</a>) представил GenAI-помощника операторам в чате и по телефону. ИИ <strong>сохраняет контекст при переводе между операторами</strong> — клиенту не нужно повторять историю. Прогноз банка: экономия <strong>более 50 000 часов</strong> работы контакт-центра за 2026 год.</p>
<p>Сергей Безбогов, ВТБ: «Внедрение генеративного ИИ обеспечивает существенную экономию времени обслуживания пользователей при обращении в контакт-центр: за весь 2026 год она должна превысить 50 тыс. часов».</p>
<p>Для Nero Network copilot — второй слой после маршрутизации: даже если бот не закрыл обращение, оператор получает готовый контекст и подсказки — AHT падает без потери качества.</p>
<h3 id="автоответы-на-типовые-запросы-и-deflecti">Автоответы на типовые запросы и deflection rate</h3>
<p><strong>Deflection rate</strong> — доля обращений, решённых без участия оператора. На узких сценариях (статус заказа, FAQ по доставке, смена тарифа) реалистичный ориентир — <strong>20–40%</strong> deflection при корректной базе знаний и порогах confidence.</p>
<p>Сбер (<a href="https://vedom.ru/news/2026/06/15/79834-ii-na-linii-sber-avtomatiziroval-rassmotrenie-bolee" target="_blank" rel="noopener noreferrer">Ведомости, Q1 2026</a>): <strong>65%</strong> всех обращений решаются с помощью ИИ; в голосе — <strong>66%</strong>, в чатах — <strong>71%</strong>. Для сравнения: среднерыночные показатели по Frank RG — 23% в голосе и 67% в чатах. <strong>95%</strong> клиентов получают ответ сразу на звонке.</p>
<p>Ozon запустил «Умный ассистент» на Qwen 3.5 в ЛК продавца (<a href="https://www.cnews.ru/news/line/2026-04-28_ozon_zapustil_ii-assistenta" target="_blank" rel="noopener noreferrer">CNews, апрель 2026</a>): до <strong>20%</strong> вопросов, ранее уходивших в техподдержку, закрываются без оператора. Для маркетплейсов и B2B2C это прямая метрика разгрузки линии.</p>
<h3 id="ai-агенты-в-голосовом-и-текстовом-канале">AI-агенты в голосовом и текстовом канале</h3>
<p><strong>AI агенты</strong> — автономные системы, ведущие многошаговый диалог: проверяют статус в CRM, меняют тариф через API, записывают на услугу. При низкой уверенности, негативе или юридическом риске — эскалация на человека с собранным саммари.</p>
<p>IBM фиксирует переход к <strong>agentic AI</strong>: проактивные решения, оркестрация нескольких агентов (watsonx Orchestrate). В России стандарт — гибрид <strong>ML + LLM</strong> (кейс ОТП Банка + Naumen): ML для массовой классификации, LLM — для контекста и эмоций.</p>
<p class="vna-card nero-ai-reveal" style="padding:18px 22px;margin-top:20px;"><em><strong>Итог блока:</strong> три слоя AI в одном внедрении — маршрутизация → автоответ → copilot — дают максимальный эффект. Только голосовой бот без аналитики и подсказок оператору закрывает часть боли, но не ROI целиком.</em></p>

      </div>
    </div>
  </section><section id="vnedrenie-ai-kontakt-centr-boris-block" class="bcc-root" aria-label="Анимация: поток обращения в контакт-центре — канал, AI-маршрутизация, бот или оператор">
<style>
/* === БОРИС: prefix bcc-, scoped внутри #vnedrenie-ai-kontakt-centr-boris-block === */
#vnedrenie-ai-kontakt-centr-boris-block.bcc-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 8px 40px rgba(15,23,42,.1),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #vnedrenie-ai-kontakt-centr-boris-block .bcc-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-kontakt-centr-boris-block .bcc-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.1em;
  text-transform:uppercase;
  color:#0ea5e9;
  margin:0 0 14px;
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0ea5e9;
  border-radius:1px;
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(14,165,233,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:10px;
  color:#0284c7;
  margin-top:1px;
  font-style:normal;
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-kontakt-centr-boris-block .bcc-rgt{
  position:relative;
  background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 40%,#f8fafc 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-kontakt-centr-boris-block .bcc-rgt{min-height:360px;}
}
#bcc-contact-flow-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bcc-cnt">
  <div class="bcc-card">

    <div class="bcc-lft">
      <span class="bcc-ey">Поток обращения</span>
      <h3 class="bcc-h3">Канал → маршрутизация → бот или оператор с copilot</h3>
      <ul class="bcc-ul">
        <li><span class="bcc-ic">1</span>Омниканальный вход: звонок, чат, email, мессенджер — единый Router AI</li>
        <li><span class="bcc-ic">2</span>Классификация интента, VIP-статус и срочность по данным CRM</li>
        <li><span class="bcc-ic">3</span>Типовой запрос уходит в ИИ-агента; сложный — оператору с готовым контекстом</li>
        <li><span class="bcc-ic">4</span>Copilot подсказывает ответ; post-call заполняет CRM без ручного ввода</li>
      </ul>
      <div class="bcc-pills">
        <span class="bcc-pl bcc-pl-g">Deflection до 65%</span>
        <span class="bcc-pl bcc-pl-b">FCR &gt;80%</span>
        <span class="bcc-pl bcc-pl-v">Copilot live</span>
      </div>
      <p class="bcc-foot">Дальше — этапы внедрения AI в контакт-центр под ключ →</p>
    </div>

    <div class="bcc-rgt">
      <canvas
        id="bcc-contact-flow-canvas"
        aria-label="Схема: обращения из каналов проходят AI-маршрутизацию и направляются в автоответ бота или к оператору с подсказками"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script id="bcc-contact-flow-engine">
(function(){
  var cv = document.getElementById('bcc-contact-flow-canvas');
  if (!cv) return;
  var cx = cv.getContext('2d');
  var W = 0, H = 0, fr = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    var w = p.clientWidth || 640;
    var h = p.clientHeight || 420;
    cv.width = Math.floor(w * dpr);
    cv.height = Math.floor(h * dpr);
    cv.style.width = w + 'px';
    cv.style.height = h + 'px';
    cx.setTransform(dpr, 0, 0, dpr, 0, 0);
    W = w; H = h;
  }
  window.addEventListener('resize', resize);
  resize();

  var COL = {
    sky:'#0ea5e9', skyA:function(a){return 'rgba(14,165,233,'+a+')';},
    grn:'#22c55e', grnA:function(a){return 'rgba(34,197,94,'+a+')';},
    vio:'#8b5cf6', vioA:function(a){return 'rgba(139,92,246,'+a+')';},
    slt:'#64748b', sltA:function(a){return 'rgba(100,116,139,'+a+')';},
    ink:'#0f172a', mut:'#475569',
    line:'rgba(148,163,184,.35)',
    card:'rgba(255,255,255,.88)',
    cardB:'rgba(148,163,184,.25)'
  };

  var CHANNELS = [
    {id:'phone', label:'Звонок', icon:'\u260E', y:0.18, color:COL.sky},
    {id:'chat',  label:'Чат',    icon:'\u25AC', y:0.38, color:COL.vio},
    {id:'email', label:'Email',  icon:'\u2709', y:0.58, color:COL.slt},
    {id:'tg',    label:'TG/VK',  icon:'\u25C9', y:0.78, color:COL.grn}
  ];

  var TICKETS = [];
  var LOOP = 900;

  function spawnTicket(){
    var ch = CHANNELS[Math.floor(Math.random() * CHANNELS.length)];
    var conf = 0.55 + Math.random() * 0.4;
    var toBot = conf > 0.78;
    TICKETS.push({
      ch: ch.id,
      phase: 0,
      speed: 0.008 + Math.random() * 0.006,
      conf: conf,
      toBot: toBot,
      label: toBot ? 'FAQ / статус' : 'эскалация',
      born: fr
    });
  }

  function rr(x,y,w,h,r,fill,stroke,lw){
    cx.beginPath();
    if(cx.roundRect){ cx.roundRect(x,y,w,h,r); }
    else {
      cx.moveTo(x+r,y); cx.arcTo(x+w,y,x+w,y+h,r);
      cx.arcTo(x+w,y+h,x,y+h,r); cx.arcTo(x,y+h,x,y,r);
      cx.arcTo(x,y,x+w,y,r); cx.closePath();
    }
    if(fill){ cx.fillStyle=fill; cx.fill(); }
    if(stroke){ cx.strokeStyle=stroke; cx.lineWidth=lw||1.5; cx.stroke(); }
  }

  function drawGrid(){
    cx.strokeStyle='rgba(14,165,233,.06)';
    cx.lineWidth=1;
    for(var gx=0;gx<W;gx+=28){
      cx.beginPath(); cx.moveTo(gx,0); cx.lineTo(gx,H); cx.stroke();
    }
    for(var gy=0;gy<H;gy+=28){
      cx.beginPath(); cx.moveTo(0,gy); cx.lineTo(W,gy); cx.stroke();
    }
  }

  function drawHeader(){
    cx.fillStyle=COL.ink;
    cx.font='bold 13px Inter,system-ui,sans-serif';
    cx.textAlign='left';
    cx.fillText('Contact Center \u00B7 Router AI', 16, 24);
    var pulse = 0.5 + 0.5 * Math.sin(fr * 0.08);
    cx.beginPath(); cx.arc(W-72, 20, 5, 0, Math.PI*2);
    cx.fillStyle=COL.grnA(0.25 + pulse*0.2); cx.fill();
    cx.beginPath(); cx.arc(W-72, 20, 3, 0, Math.PI*2);
    cx.fillStyle=COL.grn; cx.fill();
    cx.fillStyle=COL.mut;
    cx.font='11px Inter,system-ui,sans-serif';
    cx.fillText('live', W-58, 24);
    cx.strokeStyle=COL.line; cx.lineWidth=1;
    cx.beginPath(); cx.moveTo(0,36); cx.lineTo(W,36); cx.stroke();
  }

  function nodePos(){
    var top = 48;
    var h = H - top - 24;
    return {
      top: top,
      h: h,
      chX: W * 0.12,
      routerX: W * 0.46,
      routerY: top + h * 0.5,
      botX: W * 0.82,
      botY: top + h * 0.32,
      opX: W * 0.82,
      opY: top + h * 0.72
    };
  }

  function drawChannelNodes(P){
    CHANNELS.forEach(function(ch){
      var y = P.top + P.h * ch.y;
      var r = 22;
      var glow = 0.12 + 0.08 * Math.sin(fr * 0.05 + ch.y * 10);
      cx.beginPath(); cx.arc(P.chX, y, r+6, 0, Math.PI*2);
      cx.fillStyle = ch.color === COL.sky ? COL.skyA(glow) :
        ch.color === COL.vio ? COL.vioA(glow) :
        ch.color === COL.grn ? COL.grnA(glow) : COL.sltA(glow);
      cx.fill();
      rr(P.chX-r, y-r, r*2, r*2, 10, COL.card, ch.color, 2);
      cx.fillStyle=ch.color;
      cx.font='16px Inter,system-ui,sans-serif';
      cx.textAlign='center'; cx.textBaseline='middle';
      cx.fillText(ch.icon, P.chX, y-2);
      cx.fillStyle=COL.mut;
      cx.font='10px Inter,system-ui,sans-serif';
      cx.fillText(ch.label, P.chX, y + r + 12);
    });
  }

  function drawRouter(P){
    var rx = P.routerX, ry = P.routerY, sz = 36;
    var spin = fr * 0.03;
    cx.save();
    cx.translate(rx, ry);
    cx.rotate(spin);
    for(var i=0;i<6;i++){
      cx.rotate(Math.PI/3);
      cx.fillStyle=COL.vioA(0.15);
      cx.fillRect(-4, -sz-8, 8, 16);
    }
    cx.restore();
    rr(rx-sz, ry-sz, sz*2, sz*2, 14, COL.card, COL.vio, 2.5);
    cx.fillStyle=COL.vio;
    cx.font='bold 11px Inter,system-ui,sans-serif';
    cx.textAlign='center'; cx.textBaseline='middle';
    cx.fillText('Router', rx, ry-6);
    cx.fillText('AI', rx, ry+8);
    cx.fillStyle=COL.mut;
    cx.font='9px Inter,system-ui,sans-serif';
    cx.fillText('интент \u00B7 CRM', rx, ry+sz+14);
  }

  function drawDestinations(P){
  /* BOT branch */
    rr(P.botX-52, P.botY-28, 104, 56, 12, COL.grnA(0.08), COL.grn, 2);
    cx.fillStyle=COL.grn;
    cx.font='bold 12px Inter,system-ui,sans-serif';
    cx.textAlign='center';
    cx.fillText('\u0418\u0418-\u0430\u0433\u0435\u043d\u0442', P.botX, P.botY-8);
    cx.fillStyle=COL.mut;
    cx.font='10px Inter,system-ui,sans-serif';
    cx.fillText('\u0430\u0432\u0442\u043e\u043e\u0442\u0432\u0435\u0442', P.botX, P.botY+10);
    var bPulse = Math.sin(fr*0.1)*2;
    cx.beginPath(); cx.arc(P.botX+38, P.botY-18+bPulse, 8, 0, Math.PI*2);
    cx.fillStyle=COL.grnA(0.2); cx.fill();
    cx.fillStyle=COL.grn; cx.font='bold 10px sans-serif';
    cx.textAlign='center'; cx.textBaseline='middle';
    cx.fillText('\u2713', P.botX+38, P.botY-18+bPulse);

  /* OPERATOR branch */
    rr(P.opX-52, P.opY-28, 104, 56, 12, COL.skyA(0.08), COL.sky, 2);
    cx.fillStyle=COL.sky;
    cx.font='bold 12px Inter,system-ui,sans-serif';
    cx.textAlign='center';
    cx.fillText('\u041e\u043f\u0435\u0440\u0430\u0442\u043e\u0440', P.opX, P.opY-8);
    cx.fillStyle=COL.mut;
    cx.font='10px Inter,system-ui,sans-serif';
    cx.fillText('+ copilot', P.opX, P.opY+10);
    var hintY = P.opY - 38 + Math.sin(fr*0.07)*3;
    rr(P.opX-44, hintY, 88, 18, 6, COL.vioA(0.12), COL.vioA(0.4), 1);
    cx.fillStyle=COL.vio;
    cx.font='9px Inter,system-ui,sans-serif';
    cx.fillText('\u043f\u043e\u0434\u0441\u043a\u0430\u0437\u043a\u0430\u2026', P.opX, hintY+12);
  }

  function drawPipes(P){
    CHANNELS.forEach(function(ch){
      var y = P.top + P.h * ch.y;
      cx.strokeStyle=COL.line; cx.lineWidth=1.5; cx.setLineDash([4,6]);
      cx.beginPath();
      cx.moveTo(P.chX+24, y);
      cx.bezierCurveTo(P.chX+60, y, P.routerX-50, P.routerY, P.routerX-38, P.routerY);
      cx.stroke();
    });
    cx.setLineDash([]);
    cx.strokeStyle=COL.grnA(0.5); cx.lineWidth=2;
    cx.beginPath();
    cx.moveTo(P.routerX+38, P.routerY-8);
    cx.bezierCurveTo(P.routerX+70, P.routerY-20, P.botX-70, P.botY, P.botX-54, P.botY);
    cx.stroke();
    cx.strokeStyle=COL.skyA(0.5);
    cx.beginPath();
    cx.moveTo(P.routerX+38, P.routerY+8);
    cx.bezierCurveTo(P.routerX+70, P.routerY+20, P.opX-70, P.opY, P.opX-54, P.opY);
    cx.stroke();
  }

  function ticketPath(tk, P){
    var ch = CHANNELS.filter(function(c){return c.id===tk.ch;})[0];
    var y0 = P.top + P.h * ch.y;
    var p = tk.phase;
    if(p < 0.45){
      var t = p / 0.45;
      var x = P.chX + 24 + (P.routerX - P.chX - 24) * t;
      var y = y0 + (P.routerY - y0) * t;
      return {x:x, y:y, alpha: Math.min(1, p*3)};
    }
    var t2 = (p - 0.45) / 0.55;
    var destX = tk.toBot ? P.botX - 54 : P.opX - 54;
    var destY = tk.toBot ? P.botY : P.opY;
  var x1 = P.routerX + 38, y1 = P.routerY;
    var x = x1 + (destX - x1) * t2;
    var y = y1 + (destY - y1) * t2;
    return {x:x, y:y, alpha: 1 - t2*0.3};
  }

  function drawTickets(P){
    TICKETS.forEach(function(tk){
      var pos = ticketPath(tk, P);
      var col = tk.toBot ? COL.grn : COL.sky;
      cx.globalAlpha = Math.max(0, pos.alpha);
      cx.beginPath(); cx.arc(pos.x, pos.y, 5, 0, Math.PI*2);
      cx.fillStyle=col; cx.fill();
      cx.strokeStyle='#fff'; cx.lineWidth=1.5; cx.stroke();
      if(tk.phase > 0.5){
        cx.fillStyle=COL.mut;
        cx.font='8px Inter,system-ui,sans-serif';
        cx.textAlign='left';
        cx.fillText(Math.round(tk.conf*100)+'%', pos.x+8, pos.y+3);
      }
      cx.globalAlpha=1;
      tk.phase += tk.speed;
    });
    TICKETS = TICKETS.filter(function(tk){ return tk.phase < 1.05; });
  }

  function drawLegend(P){
    cx.fillStyle=COL.mut;
    cx.font='10px Inter,system-ui,sans-serif';
    cx.textAlign='left';
    cx.fillText('\u0437\u0435\u043b\u0451\u043d\u0430\u044f \u0432\u0435\u0442\u043a\u0430 \u2192 \u0431\u043e\u0442', 16, H-14);
    cx.textAlign='right';
    cx.fillText('\u0441\u0438\u043d\u044f\u044f \u2192 \u043e\u043f\u0435\u0440\u0430\u0442\u043e\u0440', W-16, H-14);
  }

  function frame(){
    fr++;
    cx.clearRect(0,0,W,H);
    drawGrid();
    drawHeader();
    var P = nodePos();
    drawPipes(P);
    drawChannelNodes(P);
    drawRouter(P);
    drawDestinations(P);
    drawTickets(P);
    drawLegend(P);
    if(fr % 55 === 0 && TICKETS.length < 8) spawnTicket();
    if(fr >= LOOP){ fr = 0; TICKETS = []; }
    requestAnimationFrame(frame);
  }

  for(var i=0;i<4;i++) setTimeout(spawnTicket, i*120);
  requestAnimationFrame(frame);
})();
</script>
</section><div class="vna-cnt">
<aside class="ym-cta-block ym-cta-block--primary" id="cta-zadachi">
  <div class="ym-cta-block__icon" aria-hidden="true">📞</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Узнайте, сколько обращений можно снять с операторов</p>
    <p class="ym-cta-block__sub">Бесплатный аудит нагрузки контакт-центра: топ-20 интентов, карта deflection и прогноз ROI до старта проекта. Ориентир чека — 500 тыс.–4 млн ₽.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside></div>
  <section class="vna-section" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Под ключ</span>
        <h2>Внедрение AI в контакт-центр: этапы под ключ</h2>
      </div>
      <div class="vna-prose nero-ai-reveal">
<p><strong>Внедрение ai контакт центр</strong> под ключ — это не покупка лицензии «с полки», а проект с измеримыми этапами. Nero Network работает по модели: аудит → пилот → интеграция → масштаб. Срок пилота на 1–2 сценария — от <strong>2–6 недель</strong> (бенчмарк рынка); полный омниканал — <strong>2–4 месяца</strong>.</p>
<h3 id="аудит-нагрузки-и-карта-сценариев">Аудит нагрузки и карта сценариев</h3>
<p>Лид-магнит Nero Network — <strong>аудит нагрузки контакт-центра</strong>. Методология:</p>
<ol class="vna-ol"><li>1. Выгрузка обращений за <strong>2–4 недели</strong> (звонки, чаты, тикеты).</li><li>2. Кластеризация топ-20 интентов: что повторяется, сколько минут съедает каждый.</li><li>3. Карта «зелёной зоны» для бота: confidence, риск, наличие API в CRM.</li><li>4. Расчёт deflection-потенциала и прогноз ROI до подписания договора.</li></ol>
<p>Нужны данные: <strong>200–500</strong> реальных диалогов (обезличенных), регламенты, FAQ, скрипты, baseline KPI за 4–8 недель — AHT, FCR, объём по темам, cost per contact.</p>
<h3 id="пилот-на-одном-канале-или-линии">Пилот на одном канале или линии</h3>
<p>Пилот — 1–2 сценария: например, «статус заказа» + «FAQ по доставке» в чате и/или голосе. Петрович показал: <strong>~3 недели</strong> от старта до маршрутизации на звонках. MCN Telecom в логистике (<a href="https://telcojournal.mcn.ru/100-prinyatyh-zvonkov-kak-omnikanalnyj-kontakt-czentr-s-ii-izmenil-rabotu-logisticheskoj-kompanii/" target="_blank" rel="noopener noreferrer">TelcoJournal</a>): внедрение <strong>~4 месяца</strong>, <strong>100%</strong> входящих приняты без потерь.</p>
<p>На пилоте включают <strong>human-in-the-loop</strong>: супервизор модерирует ответы бота, настраивает пороги эскалации. Auto-QA на 100% пилотных диалогов — донастройка промптов до выхода в прод.</p>
<h3 id="интеграция-с-телефонией-и-crm">Интеграция с телефонией и CRM</h3>
<p><strong>Настройка ai контакт центр</strong> включает канальный слой: Voximplant Kit, Mango Office, Asterisk, UIS — событие обращения уходит в оркестратор (n8n, Make, custom API). Router AI определяет маршрут; ИИ-агент дергает API CRM, 1С, склада.</p>
<p>Типовой стек Nero Network:</p>
<ul><li>STT/TTS: Yandex SpeechKit, SaluteSpeech.</li><li>LLM: YandexGPT, GigaChat, локальный контур (по политике ПДн).</li><li>CRM: amoCRM, Bitrix24, retailCRM, 1С.</li><li>База знаний → RAG по регламентам.</li></ul>
<h3 id="обучение-операторов-и-запуск-в-прод">Обучение операторов и запуск в прод</h3>
<p>Операторы учатся работать с copilot: принимать подсказки, эскалировать с контекстом, корректировать базу знаний. Запуск в прод — поэтапно: сначала чат, затем голос; сначала одна линия, затем омниканал (VK, Telegram, email).</p>
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до пилота?</p>
    <p class="ym-cta-block__sub">Если супервизоры и IT хотят разобраться в n8n, промптах и human-in-the-loop до интеграции с телефонией — посмотрите <a href="<?php echo esc_url($secondary_training_url); ?>" class="ym-link ym-link--accent"<?php echo $secondary_training_attrs; ?>><?php echo esc_html($secondary_training_label); ?></a>. Это ускоряет согласование пилота с руководством контакт-центра.</p>
  </div>
</aside>
<p class="vna-card nero-ai-reveal" style="padding:18px 22px;margin-top:20px;"><em><strong>Итог:</strong> <strong>ai контакт центр под ключ</strong> — это измеримый проект с KPI на каждом этапе, а не «включили бота и забыли».</em></p>
      </div>
    </div>
  </section>
  <section class="vna-section vna-section-alt" id="stoimost">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Коммерция</span>
        <h2>Стоимость внедрения AI в контакт-центр</h2>
      </div>
      <div class="vna-prose nero-ai-reveal">
<p>Вопрос «<strong>сколько стоит ai контакт центр</strong>» не имеет одной цифры: чек зависит от каналов, глубины интеграций и объёма обращений. Ориентир Nero Network по данным Google Таблицы и рыночным проектам — <strong>500 тыс.–4 млн ₽</strong>.</p>
<h3 id="от-чего-зависит-чек-500-тыс-4-млн">От чего зависит чек (500 тыс.–4 млн ₽)</h3>
<div class="vna-table-wrap"><table class="vna-table">
<tr><th>Фактор</th><th>Влияние на стоимость</th></tr>
<tr><td>Количество каналов</td><td>Голос дороже чата (STT/TTS, телефония)</td></tr>
<tr><td>Глубина интеграций</td><td>CRM, 1С, склад, биллинг — API и тесты</td></tr>
<tr><td>Число сценариев / интентов</td><td>Каждый интент — RAG, промпты, эскалация</td></tr>
<tr><td>Объём обращений</td><td>Нагрузка на LLM, лицензии, мониторинг</td></tr>
<tr><td>Compliance</td><td>152-ФЗ, локализация, on-prem — доп. архитектура</td></tr>
<tr><td>Copilot + QA</td><td>Второй контур поверх бота увеличивает scope</td></tr>
</table></div>
<p><strong>Нижняя граница (~500 тыс. ₽):</strong> пилот на чате, 1–2 интента, интеграция с amoCRM/Bitrix24, базовый copilot.</p>
<p><strong>Верхняя (~4 млн ₽):</strong> омниканал (голос + чат + мессенджеры), ML+LLM аналитика, auto-QA, несколько CRM/API, панель супервизора.</p>
<p>Готовые CCaaS (Genesys, Talkdesk) — <strong>$75–240/seat</strong>, внедрение <strong>8–16 недель</strong>. Для РФ аналог — <strong>Naumen + Voximplant + кастомный AI-слой</strong>; гибрид часто дешевле западного CCaaS на масштабе 15–80 операторов.</p>
<h3 id="roi-aht-fcr-csat-стоимость-контакта">ROI: AHT, FCR, CSAT, стоимость контакта</h3>
<p>Метрики для бизнес-кейса:</p>
<ul><li><strong>AHT</strong> (Average Handle Time) — среднее время обработки. ОТП Банк: <strong>−5 сек</strong>; IBM/McKinsey: <strong>−6%</strong> у банка с virtual assistant; при связке front-AI + post-call — до <strong>−25–50%</strong>.</li><li><strong>FCR</strong> (First Contact Resolution) — решение с первого обращения. Ростелеком: <strong>>80%</strong>; ОТП: <strong>+1,7 п.п.</strong></li><li><strong>CSAT / CSI</strong> — удовлетворённость. ОТП: CSI <strong>+0,3</strong>; IBM: рост CSAT при <strong>−50%</strong> cost per call.</li><li><strong>Deflection rate</strong> — доля без оператора. Сбер: <strong>65%</strong>; Ozon: <strong>20%</strong> на узком сценарии.</li><li><strong>Cost per contact / resolution</strong> — AI: <strong>$0,62–2,00</strong> vs human <strong>$7–17+</strong> (отраслевые обзоры 2026).</li></ul>
<p>ROI AI в customer service: в среднем <strong>$3,50 на $1</strong> вложений (IDC/Microsoft, цит. Avaya). Payback — <strong>3–6 месяцев</strong>. Реалистичное net-снижение затрат в первый год — <strong>20–35%</strong>, не 60–80% из вендорских заголовков.</p>
<p><strong>ai контакт центр цена</strong> окупается, когда считаете не лицензию бота, а экономию на cost per contact и рост FCR. Закажите <strong>аудит нагрузки</strong> — получите прогноз ROI до старта проекта.</p>
      </div>
    </div>
  </section><div class="vna-cnt">
<aside class="ym-cta-block ym-cta-block--primary ym-cta-block--dual" id="cta-stoimost">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получите смету и прогноз ROI под ваш контакт-центр</p>
    <p class="ym-cta-block__sub">На аудите нагрузки посчитаем deflection-потенциал, срок пилота (от 2 недель) и вилку бюджета 500 тыс.–4 млн ₽ — до подписания договора.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
    </div>
  </div>
</aside></div>
  <section class="vna-section" id="pod-klyuch">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Build vs Buy</span>
        <h2>AI контакт-центр под ключ или своими силами</h2>
      </div>
      <div class="vna-prose nero-ai-reveal">
<p>Вопрос «<strong>ai контакт центр под ключ или самостоятельно</strong>» сводится к трём моделям: купить платформу, собрать на API, гибрид. Для большинства компаний с 15–80 операторами оптимален <strong>гибрид</strong> — телефония/CCaaS + кастомный AI-слой.</p>
<h3 id="готовые-платформы-vs-кастомные-llm-агент">Готовые платформы vs кастомные LLM-агенты</h3>
<div class="vna-compare-wrap"><table class="vna-compare">
<tr><th>Подход</th><th>Плюсы</th><th>Минусы</th></tr>
<tr><td><strong>Buy (Naumen, Voximplant CCaaS)</strong></td><td>Быстрый старт, сертификации, per-seat</td><td>Ограниченная кастомизация агентов</td></tr>
<tr><td><strong>Build (API + LLM + RAG)</strong></td><td>Контроль данных, уникальные сценарии</td><td>Нужна команда, дольше time-to-market</td></tr>
<tr><td><strong>Hybrid (Nero Network)</strong></td><td>Баланс скорости и гибкости</td><td>Требует интегратора с опытом КЦ</td></tr>
</table></div>
<p>Genesys/Talkdesk — эталон для США; в России эквивалент — <strong>Naumen Erudite + Voximplant/Mango + кастомные агенты</strong> на YandexGPT/GigaChat. Nero не продаёт монолитный Genesys — мы настраиваем <strong>AI-слой поверх</strong> вашей телефонии.</p>
<h3 id="когда-нужна-разработка-и-интеграция-под">Когда нужна разработка и интеграция под ваш стек</h3>
<p><strong>Разработка ai контакт центр</strong> нужна, если:</p>
<ul><li>Уникальные API (1С, WMS, медицинская MIS, биллинг).</li><li>Жёсткие требования 152-ФЗ и on-prem LLM.</li><li>Нестандартные сценарии: мультиагентная оркестрация, как у Ростелекома.</li><li>Интеграция copilot + QA + post-call в единый дашборд.</li></ul>
<p><strong>ai контакт центр без программиста</strong> — частичный миф: no-code (Make, n8n) закрывает оркестрацию, но промпты, RAG, пороги эскалации и тесты QA требуют экспертизы. Под ключ — это как раз «без вашего штата разработчиков», а не «без разработки вообще».</p>
<p>Урок <strong>Klarna</strong> (<a href="https://www.customerexperiencedive.com/news/klarna-says-ai-agent-work-853-employees/805987/" target="_blank" rel="noopener noreferrer">Customer Experience Dive</a>): AI-агент закрыл <strong>2/3</strong> обращений, эквивалент <strong>853 FTE</strong>, экономия <strong>$60 млн</strong>, время ответа <strong>−82%</strong>. Но в 2025 Klarna <strong>вернулась к гибриду</strong> — humans для сложных и эмоциональных кейсов. CEO Sebastian Siemiatkowski: «Cost was a predominant evaluation factor… resulting in lower quality». Вывод для РФ: <strong>ai контакт центр для бизнеса</strong> строится как AI + эскалация, не AI-only.</p>
      </div>
    </div>
  </section>
  <section class="vna-section" id="integracii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Стек</span>
        <h2>Интеграция AI с телефонией, CRM и omnichannel</h2>
      </div>
      <div class="vna-prose nero-ai-reveal">
<p><strong>Интеграция ai контакт центр</strong> — критический фактор ROI. Бот без CRM видит обращение вслепую; оператор без единого окна теряет контекст между каналами.</p>
<h3 id="телефония-asterisk-voximplant-mango-и">Телефония (Asterisk, Voximplant, Mango и аналоги)</h3>
<p>События входящего звонка → STT → Router AI → бот или очередь оператора. Исходящие — обзвон с voicebot для напоминаний и NPS.</p>
<ul><li><strong>Voximplant Kit</strong> — облачный contact center, API для ботов.</li><li><strong>Mango Office</strong> — популярен у SMB, интеграция с CRM.</li><li><strong>Asterisk</strong> — on-prem, гибкость для кастомных схем.</li><li><strong>UIS</strong> — аналитика звонков + маршрутизация.</li></ul>
<p>Ростелеком удвоил точность ASR за год; <strong>>15%</strong> клиентов оценили синтез речи «как у человека». Замена IVR на conversational voice bot — тренд 2026.</p>
<h3 id="чаты-email-мессенджеры-и-единое-окно-о">Чаты, email, мессенджеры и единое окно оператора</h3>
<p>Омниканальность: рост чата при снижении голоса (Ростелеком: звонки <strong>−9%</strong>, чаты <strong>+7%</strong>). Единый интерфейс оператора — Telegram, VK, WhatsApp Business API (через провайдера), виджет на сайте, email.</p>
<p>Логика Nero: канал передаёт событие в оркестратор → единый Router AI → тот же ИИ-агент и copilot независимо от точки входа.</p>
<h3 id="база-знаний-и-сценарии-эскалации">База знаний и сценарии эскалации</h3>
<p>RAG по Notion, Confluence, Google Docs, регламентам. Триггеры эскалации: низкий confidence, негатив, ключевые слова («суд», «прокуратура», «медицинская ошибка»), VIP-клиент.</p>
<p><strong>ai контакт центр с CRM</strong> — обязательная связка: amoCRM, Bitrix24, retailCRM, 1С. После диалога — post-call: саммари, теги, задача менеджеру. Типовые CRM-связки мы оформляем отдельными проектами: <a href="/vnedrenie-ai-amocrm/">внедрение AI-агента в amoCRM</a> (post-call в сделку и задачи менеджеру), <a href="/ai-1c-erp/">AI-агент для 1С и ERP</a> (заявки и документы из диалога) и <a href="/vnedrenie-ai-obrabotka-email-crm/">автоматизация входящей почты в CRM</a> (омниканальный email рядом с голосом и чатом).</p>
      </div>
    </div>
  </section>
  <section class="vna-section" id="otrasli">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Отрасли</span>
        <h2>AI для контакт-центра по отраслям</h2>
      </div>
      <div class="vna-prose nero-ai-reveal">
<p><strong>ai контакт центр для бизнеса</strong> и <strong>ai контакт центр для компании</strong> любого масштаба — с разной глубиной, но одной логикой: снять рутину, оставить человеку сложное.</p>
<h3 id="банки-и-финтех">Банки и финтех</h3>
<p>Регуляторика, ПДн, высокий объём типовых операций. Сбер — <strong>65%</strong> AI-резолюции; ВТБ — GenAI copilot, <strong>>50 000 часов</strong> экономии; ОТП + Naumen — ML+LLM QA, FCR <strong>+1,7 п.п.</strong>, конверсия <strong>+3,3 п.п.</strong>, обращения в ЦБ <strong>−25%</strong>.</p>
<p>Для банков критичны: отдельное согласие на запись (152-ФЗ с 01.09.2025), локализация ПДн, эскалация при финансовых спорах.</p>
<h3 id="e-commerce-и-ритейл">E-commerce и ритейл</h3>
<p>Статус заказа, возврат, доставка, акции — топ интентов. Ozon: <strong>20%</strong> deflection в ЛК продавца. Петрович: маршрутизация звонков за <strong>3 недели</strong>. Логистика (MCN): <strong>100%</strong> входящих без потерь.</p>
<h3 id="телеком-и-in-house-contact-center">Телеком и in-house contact center</h3>
<p>Ростелеком: <strong>>23 млн</strong> обращений через речевую аналитику в 2025, мультиагентная система, FCR <strong>>80%</strong>. Александр Святец: «Количество вопросов, решённых с первого обращения, впервые превысило 80%».</p>
<p>Телеком — эталон для тяжёлого голоса + чата + QA на LLM.</p>
<h3 id="ai-контакт-центр-для-малого-и-среднего-б">ai контакт центр для малого и среднего бизнеса</h3>
<p><strong>ai контакт центр для малого бизнеса</strong> — пилот на чате, 1–2 интента, Mango/Voximplant + amoCRM, чек от <strong>500 тыс. ₽</strong>.</p>
<p><strong>ai контакт центр для среднего бизнеса</strong> — голос + чат, copilot, 15–80 операторов, 3 000–30 000 обращений/мес. Кейс Петрович — ориентир: <strong>89%</strong> точности маршрутизации, <strong>3 недели</strong> до результата.</p>
<p>Enterprise (Сбер, ВТБ) — другой масштаб, но методология та же: аудит → пилот → масштаб.</p>
      </div>
    </div>
  </section>
  <section class="vna-section vna-section-alt" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI в contact center</h2>
      </div>
      <div class="vna-prose nero-ai-reveal">
<p><strong>ai контакт центр кейсы</strong> и <strong>ai контакт центр примеры внедрения</strong> — лучший аргумент против «боты не работают в России». Ниже — сводка публичных цифр.</p>
<h3 id="метрики-до-и-после-таблица">Метрики до и после (таблица)</h3>
<div class="vna-table-wrap"><table class="vna-table">
<tr><th>Компания</th><th>Сценарий</th><th>Ключевые метрики</th><th>Источник</th></tr>
<tr><td>Сбер</td><td>Голос + чат, AI-резолюция</td><td>65% обращений через ИИ; 95% ответ сразу на звонке</td><td><a href="https://vedom.ru/news/2026/06/15/79834-ii-na-linii-sber-avtomatiziroval-rassmotrenie-bolee" target="_blank" rel="noopener noreferrer">Ведомости, 2026</a></td></tr>
<tr><td>ВТБ</td><td>GenAI copilot</td><td>>50 000 часов экономии в 2026</td><td><a href="https://www.mk.ru/economics/2026/05/20/vtb-na-konferencii-cipr-rasskazal-o-vnedrenii-generativnogo-ii.html" target="_blank" rel="noopener noreferrer">МК, ЦИПР 2026</a></td></tr>
<tr><td>ОТП Банк</td><td>ML+LLM речевая аналитика</td><td>AHT −5 сек; FCR +1,7 п.п.; продажи +3,3 п.п.; разбор 7 мин → 20 сек</td><td><a href="https://www.cnews.ru/news/line/2026-03-26_rechevaya_analitika_naumen_c_genai" target="_blank" rel="noopener noreferrer">CNews, 2026</a></td></tr>
<tr><td>Ростелеком КЦ</td><td>ИИ-агенты, замена IVR</td><td>FCR >80%; >23 млн обращений в аналитике</td><td><a href="https://www.cnews.ru/news/line/2026-04-06_rostelekom_kontakt-tsentr" target="_blank" rel="noopener noreferrer">CNews, 2026</a></td></tr>
<tr><td>Петрович</td><td>LLM-маршрутизация</td><td>Точность 89,03%; ~3 недели</td><td><a href="https://www.cnews.ru/news/line/2026-03-05_obit_pomogaet_avtomatizirovat" target="_blank" rel="noopener noreferrer">CNews, 2026</a></td></tr>
<tr><td>Ozon</td><td>ИИ-ассистент продавцов</td><td>До 20% вопросов без поддержки</td><td><a href="https://www.cnews.ru/news/line/2026-04-28_ozon_zapustil_ii-assistenta" target="_blank" rel="noopener noreferrer">CNews, 2026</a></td></tr>
<tr><td>Klarna (межд.)</td><td>AI-агент в чате</td><td>2/3 через AI; −82% время ответа; гибрид с 2025</td><td><a href="https://www.customerexperiencedive.com/news/klarna-says-ai-agent-work-853-employees/805987/" target="_blank" rel="noopener noreferrer">CX Dive</a></td></tr>
</table></div>
<h3 id="типовые-ошибки-при-запуске">Типовые ошибки при запуске</h3>
<ol class="vna-ol"><li>1. <strong>AI-only без эскалации</strong> — деградация качества на сложных кейсах (урок Klarna).</li><li>2. <strong>Нет RAG по регламентам</strong> — галлюцинации, неверные суммы и сроки.</li><li>3. <strong>Пилот без baseline KPI</strong> — невозможно доказать ROI руководству.</li><li>4. <strong>Игнор 152-ФЗ</strong> — записи без отдельного согласия, трансграничная передача в зарубежный LLM.</li><li>5. <strong>Только голосовой бот</strong> — без copilot и QA операторы остаются перегруженными на «серой зоне».</li><li>6. <strong>Нет модерации на старте</strong> — бот в прод без human-in-the-loop.</li></ol>
      </div>
    </div>
  </section>
  <section class="vna-section" id="riski">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Compliance</span>
        <h2>Риски, 152-ФЗ и качество ответов бота</h2>
      </div>
      <div class="vna-prose nero-ai-reveal">
<p><strong>Искусственный интеллект для контакт-центра</strong> и <strong>нейросети контакт-центр</strong> несут репутационные и юридические риски. Их закрывают архитектурой, а не отказом от AI.</p>
<h3 id="галлюцинации-и-контроль-качества">Галлюцинации и контроль качества</h3>
<p>Меры контроля:</p>
<ul><li><strong>RAG</strong> строго по утверждённым регламентам, не по «интернету».</li><li><strong>Пороги confidence</strong> — ниже порога → эскалация на оператора.</li><li><strong>Human-in-the-loop</strong> на пилоте: супервизор одобряет ответы бота.</li><li><strong>Auto-QA 100%</strong> диалогов — как у ОТП: корректность оценки <strong>>99%</strong> по 7 из 8 критериев.</li><li><strong>Запрет свободных обещаний</strong> — бот не компенсирует вне регламента без оператора.</li></ul>
<p>Возражение «бот будет грубить» закрывается тональностью, триггерами негатива и мгновенной передачей человеку с контекстом (кейс ВТБ).</p>
<h3 id="хранение-записей-разговоров-и-персональн">Хранение записей разговоров и персональные данные</h3>
<p><strong>152-ФЗ:</strong> записи звонков — персональные данные. С <strong>1 сентября 2025</strong> согласие на обработку ПДн — <strong>отдельным документом</strong>, нельзя прятать в пользовательскую оферту (<a href="https://companies.rbc.ru/news/BSZ231iAod/kak-rabotat-s-personalnyimi-dannyimi-v-2025-godu-izmeneniya-s-1-sentyabrya/" target="_blank" rel="noopener noreferrer">RBC</a>).</p>
<p><strong>Локализация:</strong> первичный сбор и хранение ПДн граждан РФ — на территории РФ. Для LLM — YandexGPT, GigaChat, on-prem; OpenAI/Claude — только при допустимости трансграничной передачи и договоре поручения.</p>
<p>Источник по записям в КЦ: <a href="https://ic-tech.ru/blog/faq/questions-152fz/nuzhno-li-soglasie-na-zapis-razgovorov-v-koll-tsentre/" target="_blank" rel="noopener noreferrer">ic-tech.ru</a>.</p>
<p>Для аутсорсингового контакт-центра — договор поручения на обработку ПДн с оператором и интегратором AI.</p>
      </div>
    </div>
  </section>
  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Вопросы</span>
        <h2>FAQ — частые вопросы о внедрении AI в контакт-центр</h2>
      </div>
      <div class="vna-faq nero-ai-reveal"><div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0">Как внедрить ai контакт центр?</div><div class="vna-faq-a"><p>Пошагово: (1) аудит нагрузки и топ интентов; (2) выбор 1–2 сценариев для пилота; (3) интеграция с CRM и каналом (чат/голос); (4) RAG по базе знаний; (5) запуск с human-in-the-loop; (6) замер AHT, FCR, deflection; (7) масштаб на омниканал. Nero Network ведёт проект под ключ от аудита до прода.</p></div></div>
<div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0">Сколько стоит ai контакт центр?</div><div class="vna-faq-a"><p>Ориентир: <strong>500 тыс.–4 млн ₽</strong> в зависимости от каналов, интеграций и числа сценариев. Пилот на чате — ближе к нижней границе; омниканал с голосом, copilot и QA — к верхней. Точную смету даёт аудит нагрузки с прогнозом ROI.</p></div></div>
<div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0">AI заменит операторов?</div><div class="vna-faq-a"><p>Нет — разгрузит от рутины. Сбер закрывает 65% обращений AI, но 35% — люди. Klarna вернула humans на сложные кейсы. ОТП показал рост <strong>продаж +3,3 п.п.</strong> — операторы фокусируются на конверсии, а не на FAQ. Цель — <strong>снизить нагрузку</strong>, не сократить штат без плана.</p></div></div>
<div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0">Можно ли ai контакт центр с CRM amoCRM / Bitrix24?</div><div class="vna-faq-a"><p>Да. Типовая интеграция: статус заказа, карточка клиента, post-call саммари, теги. AI-агент дергает API CRM; copilot подставляет данные в ответ. Связанные материалы: внедрение AI в amoCRM, AI для 1С.</p></div></div>
<div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0">ai контакт центр под ключ или самостоятельно — что выбрать?</div><div class="vna-faq-a"><p>Самостоятельно — если есть in-house ML/интеграторы и время 3–6 месяцев. Под ключ — если нужен результат за 2–6 недель на пилоте без найма команды. Гибрид Nero: ваша телефония + наш AI-слой.</p></div></div>
<div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0">Какие задачи решает ai контакт центр?</div><div class="vna-faq-a"><p>Маршрутизация, автоответы, copilot оператору, речевая аналитика, auto-QA, post-call automation в CRM. Полный список — в таблице сценариев выше.</p></div></div>
<div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0">Как заказать ai контакт центр консультация?</div><div class="vna-faq-a"><p>Оставьте заявку на <strong>аудит нагрузки контакт-центра</strong> — бесплатный первичный разбор топ интентов и потенциала deflection. CTA: <strong>Снизить нагрузку</strong>.</p></div></div></div>
    </div>
  </section>
  <section class="vna-section" id="zakazat">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Оффер</span>
        <h2>Заказать внедрение AI для контакт-центра</h2>
      </div>
      <div class="vna-prose nero-ai-reveal">
<p>Nero Network — <strong>ai контакт центр решение для бизнеса</strong> с фокусом на измеримый ROI, а не на «бота ради бота».</p>
<p><strong>Что входит в оффер:</strong></p>
<ul><li><strong>Аудит нагрузки</strong> — топ-20 интентов, карта deflection, прогноз экономии.</li><li><strong>Маршрутизация обращений</strong> — как у Петровича и Ростелекома, за недели, не месяцы.</li><li><strong>Подсказки оператору (copilot)</strong> — контекст без потери при переводе, как у ВТБ.</li><li><strong>Автоответы</strong> на типовые запросы — deflection 20–65% в зависимости от сценария.</li><li><strong>Интеграция</strong> с Voximplant, Mango, Asterisk, amoCRM, Bitrix24, 1С.</li><li><strong>Compliance</strong> — 152-ФЗ, локализация, эскалация.</li></ul>
<p><strong>Ориентир чека:</strong> 500 тыс.–4 млн ₽. <strong>Срок пилота:</strong> от 2 недель.</p>
<p><strong>ai контакт центр заказать</strong> — через заявку на сайте. Первый шаг: <strong>аудит нагрузки контакт-центра</strong>. CTA: <strong>Снизить нагрузку</strong> на колл-центр без роста штата.</p>

<p class="vna-card nero-ai-reveal" style="padding:18px 22px;margin-top:20px;"><em><strong>Итог:</strong> <strong>Внедрение искусственного интеллекта</strong> в контакт-центр в 2026 году — стандарт для банков, e-commerce и телекома. Российские кейсы доказывают: 65–80% автоматизации достижимы при гибридной модели AI + человек. Nero Network внедряет <strong>ai решения для контакт-центр</strong> под ключ — от аудита до интеграции с вашей телефонией и CRM.</em></p>
      </div>
    </div>
  </section><div class="vna-cnt">
<aside class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы снизить нагрузку на колл-центр?</p>
    <p class="ym-cta-block__sub">Маршрутизация, copilot оператору и автоответы под ключ — с интеграцией Voximplant, Mango, amoCRM, Bitrix24 и 1С. Первый шаг: бесплатный аудит нагрузки.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside></div>
</div>

<?php
$vnkc_page_url = trailingslashit( get_permalink() );
$vnkc_site_url = trailingslashit( home_url( '/' ) );
$vnkc_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$vnkc_schema   = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $vnkc_site_url . '#organization',
			'name'  => $vnkc_brand,
			'url'   => $vnkc_site_url,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $vnkc_site_url . '#website',
			'url'       => $vnkc_site_url,
			'name'      => $vnkc_brand,
			'publisher' => [ '@id' => $vnkc_site_url . '#organization' ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $vnkc_page_url . '#webpage',
			'url'         => $vnkc_page_url,
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $vnkc_site_url . '#website' ],
			'about'       => [ '@id' => $vnkc_site_url . '#organization' ],
		],
		[
			'@type' => 'BreadcrumbList',
			'@id'   => $vnkc_page_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vnkc_site_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vnkc_page_url ],
			],
		],
		[
			'@type'       => 'Service',
			'@id'         => $vnkc_page_url . '#service',
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'url'         => $vnkc_page_url,
			'provider'    => [ '@id' => $vnkc_site_url . '#organization' ],
		],
		[
			'@type' => 'FAQPage',
			'@id'   => $vnkc_page_url . '#faq',
			'mainEntity' => [
		[ '@type' => 'Question', 'name' => 'Как внедрить ai контакт центр?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Пошагово: (1) аудит нагрузки и топ интентов; (2) выбор 1–2 сценариев для пилота; (3) интеграция с CRM и каналом (чат/голос); (4) RAG по базе знаний; (5) запуск с human-in-the-loop; (6) замер AHT, FCR, deflection; (7) масштаб на омниканал. Nero Network ведёт проект под ключ от аудита до прода.' ] ],
		[ '@type' => 'Question', 'name' => 'Сколько стоит ai контакт центр?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир: 500 тыс.–4 млн ₽ в зависимости от каналов, интеграций и числа сценариев. Пилот на чате — ближе к нижней границе; омниканал с голосом, copilot и QA — к верхней. Точную смету даёт аудит нагрузки с прогнозом ROI.' ] ],
		[ '@type' => 'Question', 'name' => 'AI заменит операторов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет — разгрузит от рутины. Сбер закрывает 65% обращений AI, но 35% — люди. Klarna вернула humans на сложные кейсы. ОТП показал рост продаж +3,3 п.п. — операторы фокусируются на конверсии, а не на FAQ. Цель — снизить нагрузку, не сократить штат без плана.' ] ],
		[ '@type' => 'Question', 'name' => 'Можно ли ai контакт центр с CRM amoCRM / Bitrix24?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Типовая интеграция: статус заказа, карточка клиента, post-call саммари, теги. AI-агент дергает API CRM; copilot подставляет данные в ответ. Связанные материалы: внедрение AI в amoCRM, AI для 1С.' ] ],
		[ '@type' => 'Question', 'name' => 'ai контакт центр под ключ или самостоятельно — что выбрать?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Самостоятельно — если есть in-house ML/интеграторы и время 3–6 месяцев. Под ключ — если нужен результат за 2–6 недель на пилоте без найма команды. Гибрид Nero: ваша телефония + наш AI-слой.' ] ],
		[ '@type' => 'Question', 'name' => 'Какие задачи решает ai контакт центр?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Маршрутизация, автоответы, copilot оператору, речевая аналитика, auto-QA, post-call automation в CRM. Полный список — в таблице сценариев выше.' ] ],
		[ '@type' => 'Question', 'name' => 'Как заказать ai контакт центр консультация?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Оставьте заявку на аудит нагрузки контакт-центра — бесплатный первичный разбор топ интентов и потенциала deflection. CTA: Снизить нагрузку.' ] ],
		],
		],
	],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vnkc_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
(function () {
  'use strict';

  var root = document.querySelector('.nero-ai-home-page');
  if (!root) return;

  var revealItems = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

    revealItems.forEach(function (item) { observer.observe(item); });
  } else {
    revealItems.forEach(function (item) { item.classList.add('nero-ai-active'); });
  }

  var tooltipItems = root.querySelectorAll('[data-nero-tooltip]');
  tooltipItems.forEach(function (item) {
    if (!item.hasAttribute('tabindex')) item.setAttribute('tabindex', '0');

    item.addEventListener('click', function (event) {
      var isActive = item.classList.contains('nero-ai-tooltip-active');
      tooltipItems.forEach(function (other) { other.classList.remove('nero-ai-tooltip-active'); });
      if (!isActive) item.classList.add('nero-ai-tooltip-active');
      event.stopPropagation();
    });
  });

  document.addEventListener('click', function () {
    tooltipItems.forEach(function (item) { item.classList.remove('nero-ai-tooltip-active'); });
  });

  var counters = root.querySelectorAll('[data-nero-count]');
  function animateCounter(el) {
    var target = parseFloat(el.getAttribute('data-nero-count') || '0');
    var suffix = el.getAttribute('data-nero-suffix') || '';
    var prefix = el.getAttribute('data-nero-prefix') || '';
    var duration = 850;
    var start = performance.now();

    function frame(now) {
      var progress = Math.min((now - start) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      var value = Math.round(target * eased);
      el.textContent = prefix + value + suffix;
      if (progress < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  if ('IntersectionObserver' in window) {
    var counterObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting && !entry.target.dataset.neroDone) {
          entry.target.dataset.neroDone = '1';
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.35 });
    counters.forEach(function (counter) { counterObserver.observe(counter); });
  } else {
    counters.forEach(animateCounter);
  }
})();

</script>

<script>
document.querySelectorAll('.vna-faq-q').forEach(function(q){
  q.addEventListener('click',function(){q.parentElement.classList.toggle('open');});
  q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();q.parentElement.classList.toggle('open');}});
});
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

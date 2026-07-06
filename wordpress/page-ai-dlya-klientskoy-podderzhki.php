<?php
/**
 * Template Name: AI-поддержка клиентов: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI-поддержки 24/7. Чат-боты, RAG, интеграции CRM/helpdesk. Аудит поддержки бесплатно.
 */

$page_seo_title       = 'AI-поддержка клиентов: внедрение и настройка под ключ';
$page_seo_description = 'Внедрим AI-поддержку 24/7: чат-боты и агенты по базе знаний, интеграция с CRM и хелпдеском, эскалация сложных обращений операторам. Аудит поддержки — бесплатно.';

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
    ['label' => 'Боли', 'href' => '#boli-podderzhki'],
    ['label' => 'Что это', 'href' => '#chto-takoe'],
    ['label' => 'Под ключ', 'href' => '#pod-klyuch'],
    ['label' => 'Как внедряем', 'href' => '#kak-vnedryaem'],
    ['label' => 'Агенты', 'href' => '#agenty'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Для кого', 'href' => '#dlya-kogo'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
    ['label' => 'CTA', 'href' => '#avtomatizirovat'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Автоматизировать поддержку';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: nero_ai_primary_cta_url('');

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
.csai-content{
  --csai-bg:#050711;--csai-bg2:#080b17;--csai-bg3:#0a0e1c;
  --csai-surface:rgba(255,255,255,.072);--csai-surface2:rgba(255,255,255,.108);
  --csai-text:#e6edf7;--csai-muted:#9aa8bd;--csai-soft:#c7d2e5;--csai-heading:#fff;
  --csai-border:rgba(255,255,255,.10);--csai-border-s:rgba(255,255,255,.18);
  --csai-accent:#79f2ff;--csai-violet:#8b5cf6;--csai-green:#22c55e;--csai-cyan:#79f2ff;
  --csai-btn-from:#2563eb;--csai-btn-to:#7c3aed;
  --csai-shadow:0 24px 72px rgba(0,0,0,.4);
  --csai-r:18px;--csai-r-lg:24px;
  --csai-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--csai-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.csai-content *,.csai-content *::before,.csai-content *::after{box-sizing:border-box;}
.csai-content a{color:inherit;text-decoration:none;}
.csai-content p{color:var(--csai-muted);line-height:1.72;margin:0 0 1em;}
.csai-content p:last-child{margin-bottom:0;}
.csai-content h2,.csai-content h3,.csai-content h4{
  color:var(--csai-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.csai-content strong{color:var(--csai-soft);}
.csai-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.csai-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--csai-muted);font-size:14.5px;line-height:1.65;
}
.csai-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--csai-accent);font-weight:700;
}

/* Container */
.csai-cnt{
  width:min(var(--csai-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.csai-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.csai-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.csai-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.csai-sh.csai-left{margin-left:0;text-align:left;}
.csai-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.csai-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.csai-sh.csai-left p{margin-left:0;}

/* Eyebrow */
.csai-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--csai-accent);margin-bottom:14px;
}

/* Gradient text */
.csai-gt{
  background:linear-gradient(92deg,#fff 0%,var(--csai-accent) 44%,var(--csai-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.csai-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.csai-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.csai-intro-text{
  position:relative;padding-left:20px;
}
.csai-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--csai-accent),var(--csai-violet));
}
.csai-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--csai-muted);margin-bottom:1em;
}
.csai-intro-text p:last-child{margin-bottom:0;color:var(--csai-soft);}
.csai-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.csai-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.csai-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--csai-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.csai-kpi-card .kl{font-size:11px;font-weight:600;color:var(--csai-muted);line-height:1.4;}
.csai-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .csai-intro-grid{grid-template-columns:1fr;gap:36px;}
  .csai-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .csai-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.csai-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.csai-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.csai-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--csai-surface);border:1px solid var(--csai-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--csai-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.csai-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--csai-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.csai-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--csai-border);border-radius:var(--csai-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.csai-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.csai-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.csai-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .csai-grid-2{grid-template-columns:1fr;}
  .csai-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .csai-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .csai-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.csai-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--csai-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.csai-level-card:hover{transform:translateY(-2px);}
.csai-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--csai-r) var(--csai-r) 0 0;
}
.csai-level-card.l1::before{background:var(--csai-green);}
.csai-level-card.l2::before{background:var(--csai-accent);}
.csai-level-card.l3::before{background:var(--csai-violet);}
.csai-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.csai-level-card.l1 .csai-level-badge{background:rgba(34,197,94,.15);color:var(--csai-green);}
.csai-level-card.l2 .csai-level-badge{background:rgba(121,242,255,.15);color:var(--csai-accent);}
.csai-level-card.l3 .csai-level-badge{background:rgba(139,92,246,.15);color:var(--csai-violet);}
.csai-level-card h3{font-size:17px;margin-bottom:10px;}
.csai-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.csai-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--csai-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.csai-scenario:last-child{margin-bottom:0;}
.csai-scenario:hover{border-color:rgba(121,242,255,.3);}
.csai-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.csai-scenario h3{font-size:17px;margin-bottom:8px;}
.csai-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.csai-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.csai-table{width:100%;border-collapse:collapse;font-size:14px;}
.csai-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--csai-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.csai-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--csai-text);vertical-align:top;
}
.csai-table tr:last-child td{border-bottom:none;}
.csai-table tr:hover td{background:rgba(255,255,255,.03);}
.csai-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.csai-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.csai-stack-layer:last-child{border-bottom:none;}
.csai-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--csai-accent);padding-top:2px;
}
.csai-stack-val{font-size:14.5px;color:var(--csai-text);}
.csai-stack-desc{font-size:13px;color:var(--csai-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.csai-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.csai-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.csai-case-grid{grid-template-columns:1fr;}}
.csai-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.csai-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.csai-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--csai-green);margin-bottom:10px;
}
.csai-case-card h3{font-size:16px;margin-bottom:14px;}
.csai-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.csai-metric{display:flex;align-items:baseline;gap:8px;}
.csai-metric .num{font-size:22px;font-weight:900;color:var(--csai-accent);flex-shrink:0;letter-spacing:-.04em;}
.csai-metric .lbl{font-size:13px;color:var(--csai-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.csai-timeline{position:relative;padding-left:40px;}
.csai-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--csai-accent),var(--csai-violet));
  opacity:.35;border-radius:2px;
}
.csai-tl-item{position:relative;margin-bottom:32px;}
.csai-tl-item:last-child{margin-bottom:0;}
.csai-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--csai-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.csai-tl-item h3{font-size:17px;margin-bottom:8px;}
.csai-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.csai-pricing-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
@media(max-width:960px){.csai-pricing-grid{grid-template-columns:1fr;}}
@media(max-width:600px){.csai-pricing-grid{grid-template-columns:1fr;}}
.csai-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.csai-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.csai-price-card.csai-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.csai-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--csai-accent);margin-bottom:10px;
}
.csai-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.csai-price-card .inc{font-size:13px;color:var(--csai-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.csai-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.csai-compare{width:100%;border-collapse:collapse;}
.csai-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--csai-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.csai-compare td{
  padding:13px 16px;font-size:14px;color:var(--csai-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.csai-compare tr:last-child td{border-bottom:none;}
.csai-good{color:var(--csai-green);}
.csai-neutral{color:var(--csai-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.csai-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.csai-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.csai-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--csai-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.csai-faq-q::after{
  content:'▾';font-size:13px;color:var(--csai-accent);
  flex-shrink:0;transition:transform .25s;
}
.csai-faq-item.open .csai-faq-q::after{transform:rotate(180deg);}
.csai-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--csai-muted);line-height:1.72;
}
.csai-faq-item.open .csai-faq-a{max-height:600px;padding:0 24px 20px;}

/* =====================================================
   CTA BLOCKS (Artur's ym-* classes)
   ===================================================== */
.ym-cta-block{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border:1px solid rgba(121,242,255,.3);text-align:center;
}
.ym-cta-block--secondary{
  background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;
}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-link--accent{color:var(--csai-accent)!important;text-decoration:underline!important;}
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
  color:var(--csai-muted);font-size:15px;
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
  background:linear-gradient(135deg,var(--csai-btn-from),var(--csai-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(59,130,246,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--csai-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(121,242,255,.4);background:rgba(59,130,246,.12);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* =====================================================
   CTA FINAL SECTION
   ===================================================== */
.csai-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.csai-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--csai-muted);
}
.csai-cta-checklist li::before{content:'✓';color:var(--csai-green);font-weight:800;}

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

<main id="primary" class="site-main nero-ai-home-page ai-dlya-klientskoy-podderzhki-page" role="main" tabindex="-1">

<section class="nero-ai-hero aics-hero-support" id="hero" aria-labelledby="aics-hero-title">
<style>
/* ── Hero ai-dlya-klientskoy-podderzhki: самодостаточные стили ── */
.aics-hero-support {
  --aics-cyan: #79f2ff;
  --aics-violet: #8b5cf6;
  --aics-green: #22c55e;
  --aics-amber: #fbbf24;
  --aics-text: #e6edf7;
  --aics-muted: #9aa8bd;
  --aics-soft: #c7d2e5;
  --aics-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aics-hero-support::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.aics-hero-support::after {
  content: "";
  position: absolute;
  right: 8%;
  top: 12%;
  width: 640px;
  height: 640px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .12), transparent 66%);
  filter: blur(8px);
  animation: aicsHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aicsHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.aics-hero-support .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aics-hero-support .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aics-hero-support .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aics-hero-support .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aics-cyan) 38%, var(--aics-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aics-hero-support .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aics-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aics-hero-support .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aics-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aics-hero-support .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aics-hero-support .nero-ai-badge {
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
.aics-hero-support .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aics-hero-support .nero-ai-btn {
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
.aics-hero-support .nero-ai-btn:hover { transform: translateY(-2px); }
.aics-hero-support .nero-ai-btn-primary {
  color: #050711 !important;
  background: linear-gradient(135deg, var(--aics-cyan), #a78bfa);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aics-hero-support .nero-ai-btn-secondary {
  color: var(--aics-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aics-hero-support .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aics-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.aics-hero-support .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aics-hero-support .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aics-hero-support .nero-ai-dots { display: flex; gap: 7px; }
.aics-hero-support .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aics-hero-support .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aics-hero-support .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aics-hero-support .nero-ai-dot:nth-child(3) { background: #34d399; }
.aics-hero-support .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aics-hero-support .nero-ai-window-body { padding: 16px; }
.aics-hero-support .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aics-hero-support .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aics-hero-support .nero-ai-live-pill {
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
.aics-hero-support .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aicsPulse 1.6s infinite;
}
@keyframes aicsPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aics-hero-support .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aics-hero-support .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aics-hero-support .nero-ai-metric span {
  display: block;
  color: var(--aics-muted);
  font-size: 11px;
  font-weight: 700;
}
.aics-hero-support .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aics-hero-support .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aics-hero-support .aics-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 30% 45%, rgba(139,92,246,.10), rgba(6,10,24,.92) 72%);
}
.aics-hero-support #aics-support-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aics-hero-support .nero-ai-task-stream { display: grid; gap: 8px; }
.aics-hero-support .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aics-hero-support .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--aics-cyan);
  font-size: 11px;
  font-weight: 800;
}
.aics-hero-support .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aics-hero-support .nero-ai-task span {
  color: var(--aics-muted);
  font-size: 11px;
}
.aics-hero-support .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aics-hero-support .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
.aics-hero-support .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
@media (max-width: 1100px) {
  .aics-hero-support .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aics-hero-support .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aics-hero-support .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aics-hero-support .nero-ai-window-body { padding: 12px; }
  .aics-hero-support .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aics-hero-support .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand !== '' ? $brand : 'Meta Journal'); ?> · customer service</p>
      <h1 id="aics-hero-title">AI-поддержка клиентов: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Внедрим AI-поддержку 24/7 — быстрые ответы, единое качество сервиса и передача сложных обращений операторам</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">RAG по базе знаний</li>
        <li class="nero-ai-badge">24/7</li>
        <li class="nero-ai-badge">Эскалация оператору</li>
        <li class="nero-ai-badge">Аудит бесплатно</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-vnedryaem">Как внедряем</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-центра поддержки">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-центр поддержки</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>FRT</span>
              <strong>&lt;2 мин</strong>
              <small>первый ответ</small>
            </div>
            <div class="nero-ai-metric">
              <span>Deflection</span>
              <strong>35%</strong>
              <small>без оператора</small>
            </div>
            <div class="nero-ai-metric">
              <span>CSAT</span>
              <strong>+12 п.п.</strong>
              <small>после пилота</small>
            </div>
            <div class="nero-ai-metric">
              <span>Cost/ticket</span>
              <strong>↓4×</strong>
              <small>vs только оператор</small>
            </div>
          </div>

          <div class="aics-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aics-support-hero-canvas" role="img" aria-label="Анимация: тикеты по орбитам проходят RAG-поиск, ответ клиенту или эскалация оператору"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий поддержки">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">#</span>
              <div><strong>Тикет #4821 · статус заказа</strong><span>Виджет · интент: delivery_status</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">вход</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">KB</span>
              <div><strong>RAG: 3 фрагмента KB</strong><span>FAQ доставка, SLA, трекинг</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">поиск</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Ответ клиенту · цитата FAQ</strong><span>confidence 0.91 · заказ в пути</span></div>
              <span class="nero-ai-status">отправлен</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">→</span>
              <div><strong>Эскалация · summary оператору</strong><span>низкий confidence 0.42 · возврат</span></div>
              <span class="nero-ai-status nero-ai-status--violet">handoff</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="csai-content">

  <section class="csai-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="csai-cnt nero-ai-container">
      <div class="csai-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="csai-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · customer service</p>
          <p>Служба поддержки — лицо бизнеса, но в 2026 году <strong>91% руководителей customer experience</strong> работают под давлением руководства внедрить AI (Gartner, октябрь 2025). При этом большинство компаний всё ещё на стадии пилотов: чат-бот отвечает шаблонами, база знаний пылится в Confluence, а клиент ждёт ответа в очереди.</p>
          <p><strong>AI поддержка клиентов</strong> в зрелом варианте — связка <strong>клиентского агента 24/7</strong>, <strong>copilot для операторов</strong>, <strong>RAG по корпоративным документам</strong> и <strong>умной эскалации</strong> с сохранением контекста в CRM. Nero Network внедряет такие системы <strong>под ключ</strong>: от аудита обращений до пилота и масштабирования. Ориентир по проекту — <strong>200 тыс.–1,5 млн ₽</strong>.</p>
          <p><strong>Коротко:</strong> оживляем базу знаний, автоматизируем типовые обращения и передаём сложные кейсы операторам — без потери контекста и без обещаний «заменить весь отдел за неделю».</p>
        </div>
        <div class="csai-intro-kpi" aria-label="Ключевые метрики">
          <div class="csai-kpi-card"><div class="kv">91%</div><div class="kl">лидеров CX под давлением AI</div><div class="ks">Gartner 2025</div></div>
          <div class="csai-kpi-card"><div class="kv">25–45%</div><div class="kl">deflection в пилоте</div><div class="ks">mid-market</div></div>
          <div class="csai-kpi-card"><div class="kv">×20</div><div class="kl">быстрее поиск в KB</div><div class="ks">Альфа-Банк</div></div>
          <div class="csai-kpi-card"><div class="kv">24/7</div><div class="kl">клиентский агент</div><div class="ks">без очереди</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT — внутренние ссылки из === INTERNAL-LINKER === -->

  <div class="csai-toc-outer"><div class="csai-cnt">
    <nav class="csai-toc" aria-label="Оглавление статьи">
      <a href="#boli-podderzhki">Боли</a>
      <a href="#chto-takoe">Что это</a>
      <a href="#pod-klyuch">Под ключ</a>
      <a href="#kak-vnedryaem">Как внедряем</a>
      <a href="#agenty">Агенты</a>
      <a href="#integracii">Интеграции</a>
      <a href="#dlya-kogo">Для кого</a>
      <a href="#stoimost">Стоимость</a>
      <a href="#keisy">Кейсы</a>
      <a href="#faq">FAQ</a>
      <a href="#avtomatizirovat">CTA</a>
    </nav>
  </div></div>

  <section class="csai-section" id="boli-podderzhki">
    <div class="csai-cnt">
      <div class="csai-sh csai-left">
        <span class="csai-eyebrow">Customer service</span>
        <h2>Когда поддержка тормозит бизнес</h2>
        <p>Три боли из практики SaaS, e-commerce, сервисных компаний, банков и edtech-проектов — и как <strong>внедрение AI в бизнес-процессы</strong> поддержки закрывает их через FRT, CSAT и deflection rate.</p>
      </div>
      <div class="csai-grid-3 nero-ai-reveal">
        <div class="csai-card">
          <h3>Долгое время первого ответа</h3>
          <p><strong>FRT</strong> в B2B SaaS без AI часто измеряется минутами и часами. Usedesk до AI-агента фиксировал <strong>14 минут</strong> на первый ответ. Пиковые нагрузки множат очередь — живые операторы не масштабируются линейно.</p>
        </div>
        <div class="csai-card">
          <h3>Качество зависит от смены</h3>
          <p>CSAT скачет от <strong>68–74%</strong> при бот-ответах до <strong>82–86%</strong> с человеком. Разрыв сужается до <strong>~5 пунктов</strong>, если AI готовит черновик, а оператор финализирует ответ.</p>
        </div>
        <div class="csai-card">
          <h3>База знаний не используется</h3>
          <p>FAQ и wiki написаны, но клиенты их не получают. Кейс Альфа-Банка: on-premise RAG ускорил поиск по KB <strong>в 20 раз</strong> (60 сек → 3 сек), сократил время ответа на <strong>40 секунд</strong>, <strong>93%</strong> положительных оценок от операторов.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:28px;max-width:820px;font-size:15px;color:var(--csai-soft);">Если поддержка отвечает долго, качество плавает, а KB мёртва — <strong>AI для бизнеса</strong> в customer service даёт быстрый ROI, а не «игрушку для маркетинга».</p>
    </div>
  </section>

  <section class="csai-section csai-section-alt" id="chto-takoe">
    <div class="csai-cnt">
      <div class="csai-sh">
        <span class="csai-eyebrow">RAG</span>
        <h2>Что такое AI-поддержка клиентов</h2>
        <p><strong>AI-поддержка клиентов</strong> (ai customer service) — система на базе LLM и RAG, которая отвечает по корпоративным документам, маршрутизирует тикеты, подсказывает операторам и эскалирует сложные кейсы с полным контекстом.</p>
      </div>
      <div class="csai-table-wrap nero-ai-reveal">
        <table class="csai-table" aria-label="Чат-бот vs AI-поддержка с RAG">
          <thead><tr><th>Критерий</th><th>Классический чат-бот</th><th>AI-поддержка с RAG</th></tr></thead>
          <tbody>
            <tr><td>Источник ответа</td><td>Зашитые сценарии</td><td>FAQ, wiki, регламенты, история тикетов</td></tr>
            <tr><td>Галлюцинации</td><td>Мало, но и гибкости нет</td><td>Цитата источника, порог confidence</td></tr>
            <tr><td>Оператор</td><td>Отдельный контур</td><td>Copilot из той же базы знаний</td></tr>
            <tr><td>Эскалация</td><td>«Позовите оператора» без контекста</td><td>Summary + теги + transcript в CRM</td></tr>
            <tr><td>Метрики</td><td>% кликов по кнопкам</td><td>FRT, deflection, resolution rate, CSAT</td></tr>
          </tbody>
        </table>
      </div>
      <div class="csai-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:19px;margin-bottom:10px;">Двухконтурная архитектура: клиент + оператор</h3>
        <p>Зрелые внедрения используют <strong>единую базу знаний</strong> для клиентского AI-агента (сайт, Telegram, WhatsApp) и copilot оператора. Cloud.ru сократил AHT сложных запросов <strong>в 2 раза</strong>, автоматизировал <strong>55%</strong> задач первой линии, поднял CSAT с <strong>89% до 92–93%</strong>.</p>
      </div>
    </div>
  </section>


  <!-- БОРИС: после #chto-takoe -->
  <section id="ai-dlya-klientskoy-podderzhki-boris-block" class="bcsp-root" aria-label="Анимация: путь обращения — тикет, RAG по базе знаний, ответ клиенту и эскалация оператору">
<style>
#ai-dlya-klientskoy-podderzhki-boris-block.bcsp-root{padding:56px 0 64px;background:#f8fafc;}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;
  box-shadow:0 8px 48px rgba(15,23,42,.1),0 0 0 1.5px rgba(14,165,233,.12);
  min-height:500px;background:#fff;
}
@media(max-width:1023px){
  #ai-dlya-klientskoy-podderzhki-boris-block .bcsp-card{grid-template-columns:1fr;min-height:auto;}
}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-dlya-klientskoy-podderzhki-boris-block .bcsp-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:#0ea5e9;margin:0 0 14px;
}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-ey::before{content:'';width:18px;height:2px;background:#0ea5e9;border-radius:1px;}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14.5px;line-height:1.5;color:#334155;}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(14,165,233,.1);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#0ea5e9;margin-top:1px;font-style:normal;
}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-rgt{
  position:relative;background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 45%,#f8fafc 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){#ai-dlya-klientskoy-podderzhki-boris-block .bcsp-rgt{min-height:380px;}}
#bcsp-support-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bcsp-cnt"><div class="bcsp-card">
  <div class="bcsp-lft">
    <span class="bcsp-ey">Поток обращения</span>
    <h3 class="bcsp-h3">Тикет → RAG по KB → ответ с цитатой или эскалация с summary</h3>
    <ul class="bcsp-ul">
      <li><span class="bcsp-ic">1</span>Клиент пишет в виджет, Telegram или email — AI классифицирует интент</li>
      <li><span class="bcsp-ic">2</span>Hybrid-поиск находит 2–4 релевантных фрагмента в базе знаний</li>
      <li><span class="bcsp-ic">3</span>При confidence ≥ порога — ответ с цитатой FAQ; иначе — handoff оператору</li>
      <li><span class="bcsp-ic">↗</span>Оператор получает copilot-черновик и transcript без повторения вопроса</li>
    </ul>
    <div class="bcsp-pills">
      <span class="bcsp-pl bcsp-pl-g">FRT &lt;2 мин</span>
      <span class="bcsp-pl bcsp-pl-b">Deflection 35%</span>
      <span class="bcsp-pl bcsp-pl-v">CSAT +12 п.п.</span>
    </div>
    <p class="bcsp-foot">Дальше — что входит во внедрение AI-поддержки под ключ →</p>
  </div>
  <div class="bcsp-rgt">
    <canvas id="bcsp-support-pipeline-canvas" aria-label="Анимация: тикет проходит RAG-поиск по базе знаний, AI отвечает клиенту или эскалирует оператору" role="img"></canvas>
  </div>
</div></div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bcsp-support-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W=0,H=0,frame=0;
  function resize(){
    var p=cv.parentElement;if(!p)return;
    cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;
    W=cv.width;H=cv.height;
  }
  window.addEventListener('resize',resize);resize();
  var C={
    ink:'#0f172a',muted:'#64748b',ticket:'#0ea5e9',ticketBg:'rgba(14,165,233,.12)',
    rag:'#8b5cf6',ragBg:'rgba(139,92,246,.12)',green:'#22c55e',greenBg:'rgba(34,197,94,.12)',
    orange:'#f59e0b',line:'rgba(14,165,233,.25)',card:'#ffffff',cardBdr:'#cbd5e1'
  };
  var STEPS=[
    {label:'Тикет #4821',sub:'статус заказа',x:0.12,delay:0,color:C.ticket},
    {label:'RAG',sub:'3 фрагмента KB',x:0.42,delay:90,color:C.rag},
    {label:'Ответ клиенту',sub:'цитата FAQ',x:0.68,delay:200,color:C.green},
    {label:'Эскалация',sub:'summary оператору',x:0.88,delay:320,color:C.orange}
  ];
  var LOOP=520;
  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);
    if(fill){ctx.fillStyle=fill;ctx.fill();}
    if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke();}
  }
  function drawNode(cx,cy,w,h,step,alpha,pulse){
    ctx.globalAlpha=alpha||1;
    rr(cx-w/2,cy-h/2,w,h,10,C.card,step.color,2);
    ctx.fillStyle=step.color;
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(step.label,cx,cy-4);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText(step.sub,cx,cy+12);
    if(pulse){
      ctx.beginPath();ctx.arc(cx,cy-h/2-6,4+Math.sin(frame*0.1)*2,0,Math.PI*2);
      ctx.fillStyle=step.color;ctx.fill();
    }
    ctx.globalAlpha=1;
  }
  function drawKbFragments(cx,cy,alpha){
    ctx.globalAlpha=alpha||0.7;
    ['FAQ','Wiki','Регламент'].forEach(function(t,i){
      var fx=cx-40+i*28,fy=cy+30+i*8;
      rr(fx,fy,52,18,6,C.ragBg,C.rag,1);
      ctx.fillStyle=C.rag;ctx.font='8px Inter,sans-serif';ctx.textAlign='center';
      ctx.fillText(t,fx+26,fy+12);
    });
    ctx.globalAlpha=1;
  }
  function loop(){
    frame++;
    var t=frame%LOOP;
    ctx.clearRect(0,0,W,H);
    var cy=H*0.46,nodeW=Math.min(108,W*0.18),nodeH=52;
    ctx.strokeStyle=C.line;ctx.lineWidth=2;ctx.setLineDash([5,5]);
    ctx.beginPath();ctx.moveTo(W*0.08,cy);ctx.lineTo(W*0.92,cy);ctx.stroke();
    ctx.setLineDash([]);
    STEPS.forEach(function(step){
      var localT=(t-step.delay+LOOP)%LOOP;
      var alpha=localT<40?localT/40:(localT>LOOP-50?(LOOP-localT)/50:1);
      var nx=W*step.x;
      var active=localT>30&&localT<LOOP-60;
      drawNode(nx,cy,nodeW,nodeH,step,alpha,active&&step.label.indexOf('RAG')>=0);
      if(step.label.indexOf('RAG')>=0&&active)drawKbFragments(nx,cy-50,alpha);
    });
    var dotT=(t*1.2)%LOOP;
    var seg=Math.floor(dotT/130)%3;
    var segProg=(dotT%130)/130;
    var x1=STEPS[seg].x*W,x2=STEPS[seg+1].x*W;
    var dotX=x1+(x2-x1)*segProg;
    ctx.beginPath();ctx.arc(dotX,cy,5,0,Math.PI*2);
    ctx.fillStyle=C.ticket;ctx.fill();
    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
  </section>


  <section class="csai-section" id="pod-klyuch">
    <div class="csai-cnt">
      <div class="csai-sh">
        <span class="csai-eyebrow">Под ключ</span>
        <h2>Что входит во внедрение AI-поддержки под ключ</h2>
        <p>Срок типового пилота — <strong>4–8 недель</strong>; масштабирование — по roadmap после измеримых метрик.</p>
      </div>
      <div class="csai-grid-2 nero-ai-reveal">
        <div class="csai-scenario"><div class="csai-sc-icon">📋</div><div><h3>Аудит обращений</h3><p>Бесплатный аудит 200–500 тикетов: матрица интентов — автоматизируемо 25–45%, copilot 30–40%, только человек 15–25%.</p></div></div>
        <div class="csai-scenario"><div class="csai-sc-icon">📚</div><div><h3>RAG и FAQ</h3><p>Semantic chunking, авто-переиндексация, цитирование источника, temperature 0,1–0,2, ответ «нет данных в базе» при низком confidence.</p></div></div>
        <div class="csai-scenario"><div class="csai-sc-icon">↗</div><div><h3>Эскалация к оператору</h3><p>Handoff AI → оператор → CRM: summary, теги, transcript. Клиент не повторяет вопрос — контекст сохранён.</p></div></div>
        <div class="csai-scenario"><div class="csai-sc-icon">✓</div><div><h3>QA и контроль качества</h3><p>Confidence threshold, еженедельный разбор «плохих» ответов, red-team тесты, дашборд FRT/deflection/CSAT.</p></div></div>
      </div>
    </div>
  </section>

  <div class="csai-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-audit-pod-klyuch">
      <div class="ym-cta-block__icon" aria-hidden="true">🎧</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте, сколько обращений можно автоматизировать</p>
        <p class="ym-cta-block__sub">Бесплатный аудит 200–500 тикетов: матрица интентов, прогноз deflection и roadmap пилота за 4–8 недель. Без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Получить аудит обращений</a>
      </div>
    </div>
  </div>

  <section class="csai-section csai-section-alt" id="kak-vnedryaem">
    <div class="csai-cnt">
      <div class="csai-sh">
        <span class="csai-eyebrow">Процесс</span>
        <h2>Как мы внедряем AI в службу поддержки</h2>
      </div>
      <div class="csai-timeline nero-ai-reveal">
        <div class="csai-tl-item"><div class="csai-tl-dot"></div><h3>Диагностика каналов</h3><p>Каналы, объём 500/1000/5000 обращений в месяц, стек Zendesk/Intercom/amoCRM/Битрикс24, требования 152-ФЗ. Результат — ТЗ и прогноз deflection <strong>25–45%</strong>.</p></div>
        <div class="csai-tl-item"><div class="csai-tl-dot"></div><h3>Проектирование</h3><p>Ingestion pipeline, vector DB + reranker, LLM-оркестратор, канальные адаптеры, admin-панель. Сравнение готовых платформ vs custom n8n/Make + RAG.</p></div>
        <div class="csai-tl-item"><div class="csai-tl-dot"></div><h3>Пилот и масштабирование</h3><p>Один канал + copilot для 2–3 операторов. Обучение команды, масштабирование на остальные каналы, переиндексация KB по gap-анализу.</p></div>
      </div>
      <div class="csai-table-wrap nero-ai-reveal" style="margin-top:32px;">
        <table class="csai-table" aria-label="Сравнение стеков внедрения">
          <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы</th><th>Когда выбирать</th></tr></thead>
          <tbody>
            <tr><td>Готовая платформа</td><td>Быстрый старт</td><td>Vendor lock-in</td><td>Уже на Zendesk/Intercom</td></tr>
            <tr><td>Custom n8n + RAG</td><td>Гибкость, 152-ФЗ</td><td>Дольше внедрение</td><td>Банк, edtech, сложные интеграции</td></tr>
            <tr><td>Гибрид</td><td>Баланс</td><td>Две системы</td><td>Средний бизнес с amoCRM</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <div class="csai-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie-support">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
        <p class="ym-cta-block__sub">Если хотите разобраться в RAG, промптах и human-in-the-loop до проекта — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование пилота с руководством поддержки.</p>
      </div>
    </aside>
  </div>

  <section class="csai-section" id="agenty">
    <div class="csai-cnt">
      <div class="csai-sh">
        <span class="csai-eyebrow">AI агенты</span>
        <h2>AI-агенты, чат-боты и автоматизация customer service</h2>
      </div>
      <div class="csai-grid-2 nero-ai-reveal">
        <div class="csai-card"><h3>Что делает AI-агент</h3><ul><li>Отвечает на типовые вопросы по KB</li><li>Маршрутизирует и тегирует обращения</li><li>Генерирует черновик оператору (copilot)</li><li>Суммаризирует диалог при эскалации</li><li>Выявляет пробелы в базе знаний</li></ul></div>
        <div class="csai-card"><h3>Что остаётся за человеком</h3><ul><li>Споры, возвраты, нестандартные кейсы</li><li>Негатив и токсичные обращения</li><li>Юридически значимые формулировки</li><li>Финальное одобрение в regulated-отраслях</li><li>Обновление и валидация контента KB</li></ul></div>
      </div>
      <div class="csai-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="csai-table" aria-label="Метрики автоматизации поддержки">
          <thead><tr><th>Метрика</th><th>Расшифровка</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td><strong>FRT</strong></td><td>Время первого ответа</td><td>С минут/часов до секунд–минут</td></tr>
            <tr><td><strong>Deflection</strong></td><td>% без оператора</td><td>25–45% (пилот), до 50–65% (зрелость)</td></tr>
            <tr><td><strong>CSAT</strong></td><td>Удовлетворённость</td><td>+5–17 п. при гибридной модели</td></tr>
            <tr><td><strong>Cost/ticket</strong></td><td>Стоимость обработки</td><td>↓ в 3–5 раз</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="csai-section csai-section-alt" id="integracii">
    <div class="csai-cnt">
      <div class="csai-sh">
        <span class="csai-eyebrow">Интеграции</span>
        <h2>Интеграции: CRM, хелпдеск и мессенджеры</h2>
      </div>
      <div class="csai-grid-3 nero-ai-reveal">
        <div class="csai-card"><h3>Zendesk, Intercom, Freshdesk</h3><p>Нативный AI + custom RAG по внутренним регламентам. Intercom Fin: <strong>65% resolution rate</strong> на 36M+ диалогов.</p></div>
        <div class="csai-card"><h3>amoCRM, Битрикс24</h3><p>Создание лида/сделки из диалога, теги по интенту, transcript, webhook-цепочки через n8n/Make.</p></div>
        <div class="csai-card"><h3>Telegram, WhatsApp, виджет</h3><p>Омниканальность: виджет для пилота, Telegram Bot API, WhatsApp Business API, email parser с эскалацией в тикет.</p></div>
      </div>
    </div>
  </section>

  <section class="csai-section" id="dlya-kogo">
    <div class="csai-cnt">
      <div class="csai-sh">
        <span class="csai-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит AI-поддержка</h2>
        <p>Окупается при <strong>от 500 обращений в месяц</strong> и наличии структурированной базы знаний.</p>
      </div>
      <div class="csai-grid-3 nero-ai-reveal">
        <div class="csai-case-card"><div class="csai-case-tag">SaaS</div><h3>Сервисные компании</h3><p>Usedesk: FRT <strong>14 мин → 1,1 мин</strong>, <strong>27%</strong> без человека, cost per ticket <strong>↓ в 5 раз</strong>.</p></div>
        <div class="csai-case-card"><div class="csai-case-tag">E-commerce</div><h3>Маркетплейсы и магазины</h3><p>Статус заказа, возвраты (эскалация), доставка. AI держит линию в пик без найма временных операторов.</p></div>
        <div class="csai-case-card"><div class="csai-case-tag">Банки · EdTech</div><h3>Regulated-отрасли</h3><p>152-ФЗ, on-prem RAG, regulatory handoff. Зерокодер: <strong>60%</strong> автоматизации, <strong>~600 тыс. ₽/мес</strong> экономии.</p></div>
      </div>
    </div>
  </section>

  <section class="csai-section csai-section-alt" id="stoimost">
    <div class="csai-cnt">
      <div class="csai-sh">
        <span class="csai-eyebrow">Стоимость</span>
        <h2>Стоимость внедрения AI-поддержки клиентов</h2>
        <p>Ориентир Nero Network: <strong>200 тыс.–1,5 млн ₽</strong> — точная смета после аудита. Окупаемость при 1 000+ обращений в месяц — <strong>3–6 месяцев</strong>; реалистичное снижение затрат в первый год — <strong>20–35%</strong>, не маркетинговые 60–80%.</p>
      </div>
      <div class="csai-pricing-grid nero-ai-reveal">
        <div class="csai-price-card"><div class="tier">Пилот</div><div class="amount">200–400 тыс. ₽</div><div class="inc">Один канал, базовый RAG, 1 CRM, до 500 документов KB</div></div>
        <div class="csai-price-card csai-featured"><div class="tier">Production</div><div class="amount">400–800 тыс. ₽</div><div class="inc">Омниканальность, copilot, аналитика, QA-модуль</div></div>
        <div class="csai-price-card"><div class="tier">Enterprise</div><div class="amount">800 тыс.–1,5 млн ₽</div><div class="inc">On-prem, ACL, телефония, несколько языков, SLA</div></div>
      </div>
      <div class="csai-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="csai-table" aria-label="ROI по объёму обращений">
          <thead><tr><th>Объём/мес</th><th>Автоматизация</th><th>Экономия FTE</th></tr></thead>
          <tbody>
            <tr><td>500</td><td>25–35%</td><td>0,25–0,5 оператора</td></tr>
            <tr><td>1 000</td><td>30–40%</td><td>0,5–1 оператор</td></tr>
            <tr><td>5 000</td><td>35–50%</td><td>2–4 оператора</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="csai-section" id="keisy">
    <div class="csai-cnt">
      <div class="csai-sh">
        <span class="csai-eyebrow">Метрики</span>
        <h2>Кейсы и метрики: FRT, CSAT и deflection rate</h2>
      </div>
      <div class="csai-table-wrap nero-ai-reveal">
        <table class="csai-table" aria-label="Сводная таблица кейсов">
          <thead><tr><th>Компания</th><th>Вертикаль</th><th>Ключевая метрика</th></tr></thead>
          <tbody>
            <tr><td>Альфа-Банк + KTS</td><td>Банк</td><td>Поиск в KB ×20; 85k запросов/сутки; 93% оценок</td></tr>
            <tr><td>Сбербанк</td><td>Банк</td><td>65% обращений с AI; 71% в чатах</td></tr>
            <tr><td>Ростелеком</td><td>Телеком</td><td>50% автоматизации; до 300k запросов/сутки</td></tr>
            <tr><td>Usedesk</td><td>SaaS</td><td>FRT 14→1,1 мин; 27% без человека; cost ↓5×</td></tr>
            <tr><td>Cloud.ru</td><td>B2B облако</td><td>AHT ↓2×; CSAT 89→92–93%</td></tr>
            <tr><td>Зерокодер</td><td>EdTech</td><td>60% автоматизации; ~600 тыс. ₽/мес экономии</td></tr>
            <tr><td>Intercom Fin</td><td>SaaS (глобально)</td><td>65% resolution rate, 36M+ диалогов</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <div class="csai-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-keisy-support">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите таких же метрик в своей поддержке?</p>
        <p class="ym-cta-block__sub">FRT с минут до секунд, deflection 25–45%, единая база знаний для клиента и оператора — начните с бесплатного аудита обращений.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#stoimost" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Смотреть стоимость</a>
        </div>
      </div>
    </div>
  </div>

  <section class="csai-section csai-section-alt" id="faq">
    <div class="csai-cnt">
      <div class="csai-sh">
        <span class="csai-eyebrow">FAQ</span>
        <h2>FAQ по внедрению AI-поддержки</h2>
      </div>
      <div class="csai-faq nero-ai-reveal">
        <div class="csai-faq-item"><div class="csai-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai поддержка клиентов без программиста?</div><div class="csai-faq-a"><p>Реальна при модели «под ключ»: Nero Network берёт ingestion KB, промпты, интеграции через n8n/Make. Пилот за 2–4 недели без найма разработчика.</p></div></div>
        <div class="csai-faq-item"><div class="csai-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит ai поддержка клиентов?</div><div class="csai-faq-a"><p>Ориентир: <strong>200 тыс.–1,5 млн ₽</strong> в зависимости от каналов и объёма KB. Точная стоимость — после аудита 200–500 тикетов. Пилоты «от 9 900 ₽» без прозрачных метрик FRT/deflection и без copilot для операторов редко окупаются.</p></div></div>
        <div class="csai-faq-item"><div class="csai-faq-q" tabindex="0" role="button" aria-expanded="false">Под ключ или самостоятельно — что выбрать?</div><div class="csai-faq-a"><p>При 500+ обращений и helpdesk под ключ быстрее окупается: 4–8 недель vs 3–6 мес. проб, RAG без галлюцинаций, единая KB для клиента и оператора.</p></div></div>
        <div class="csai-faq-item"><div class="csai-faq-q" tabindex="0" role="button" aria-expanded="false">Какие задачи решает ai поддержка клиентов?</div><div class="csai-faq-a"><p>Сокращение FRT, единое качество, активация KB через RAG, deflection 25–45%, снижение cost per ticket в 3–5 раз, copilot для операторов.</p></div></div>
        <div class="csai-faq-item"><div class="csai-faq-q" tabindex="0" role="button" aria-expanded="false">Как AI передаёт сложные обращения оператору?</div><div class="csai-faq-a"><p>При низком confidence, негативе или запросе «хочу человека» — summary, теги, фрагменты KB, тикет в helpdesk. Клиент видит «подключаю специалиста» без повторения истории.</p></div></div>
        <div class="csai-faq-item"><div class="csai-faq-q" tabindex="0" role="button" aria-expanded="false">Бот будет врать?</div><div class="csai-faq-a"><p>RAG + цитирование + порог confidence + ответ «нет в базе». При сомнении — эскалация, не выдумка. Еженедельный QA и red-team — часть контракта.</p></div></div>
        <div class="csai-faq-item"><div class="csai-faq-q" tabindex="0" role="button" aria-expanded="false">Уволят ли поддержку?</div><div class="csai-faq-a"><p>Gartner: только 20% организаций сократили штат. 80% переобучают, 84% расширяют навыки. AI забирает рутину.</p></div></div>
        <div class="csai-faq-item"><div class="csai-faq-q" tabindex="0" role="button" aria-expanded="false">У нас уже есть FAQ — зачем AI?</div><div class="csai-faq-a"><p>FAQ без RAG не используется операторами. AI превращает KB в рабочий инструмент: клиент получает ответ за секунды, оператор — copilot из тех же статей.</p></div></div>
      </div>
    </div>
  </section>

  <section class="csai-section" id="avtomatizirovat" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="csai-cnt" style="text-align:center;">
      <span class="csai-eyebrow">Первый шаг</span>
      <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px;">Автоматизировать поддержку</h2>
      <p style="max-width:620px;margin:0 auto 28px;font-size:16px;">Бесплатный аудит обращений, пилот за 4–8 недель, прозрачные KPI: FRT, deflection, CSAT, cost per ticket. Единая база знаний для клиента и оператора.</p>
      <ul class="csai-cta-checklist">
        <li>Аудит обращений — бесплатно</li>
        <li>Пилот: один канал + copilot</li>
        <li>Roadmap без vendor lock-in</li>
        <li>200 тыс.–1,5 млн ₽ по брифу</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </section>

</div><!-- /.csai-content -->

<script>
/**
 * aics-support-hero-engine — «Орбитальная диспетчерская AI-поддержки»
 * Мир: тикеты по орбитам → RAG-консоль → ответ клиенту / эскалация оператору
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aics-support-hero-canvas");
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
    cy = ch / 2 + 6;
    scale = Math.min(cw / 420, ch / 280) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    ticketBlue: "#dbeafe",
    ticketViolet: "#ede9fe",
    ticketGreen: "#d1fae5",
    orbit: "rgba(121,242,255,0.22)",
    consoleBase: "#1e293b",
    consoleCyan: "#79f2ff",
    consoleViolet: "#8b5cf6",
    kbTower: "#334155",
    gaugeGreen: "#22c55e",
    gaugeAmber: "#fbbf24",
    bridgePurple: "#a78bfa",
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

  function drawTicket(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 4, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    if (label) ctx.fillText(label, x, y + 2);
  }

  /* Орбитальный поток тикетов — вместо Conveyor */
  function TicketOrbitStream() {
    this.tickets = [
      { orbit: 0, offset: 0, color: C.ticketBlue, label: "#4821" },
      { orbit: 1, offset: 90, color: C.ticketViolet, label: "?" },
      { orbit: 2, offset: 180, color: C.ticketGreen, label: "FAQ" }
    ];
  }
  TicketOrbitStream.prototype.draw = function (ctx) {
    var orbits = [
      { rx: 95, ry: 42, tilt: -0.12 },
      { rx: 72, ry: 32, tilt: 0.08 },
      { rx: 52, ry: 22, tilt: -0.05 }
    ];
    orbits.forEach(function (o, idx) {
      ctx.save();
      ctx.rotate(o.tilt);
      ctx.strokeStyle = C.orbit;
      ctx.lineWidth = 1;
      ctx.setLineDash([4, 6]);
      ctx.beginPath();
      ctx.ellipse(0, 0, o.rx, o.ry, 0, 0, Math.PI * 2);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();
    });

    this.tickets.forEach(function (t) {
      var o = orbits[t.orbit];
      var ang = ((frame * 0.028 + t.offset) % 360) * Math.PI / 180;
      var dx = Math.cos(ang) * o.rx;
      var dy = Math.sin(ang) * o.ry * 0.55;
      if (ang < Math.PI * 1.85) drawTicket(ctx, dx, dy, 18, 14, t.color, t.label);
    });
  };

  /* Башня базы знаний */
  function KnowledgeBaseTower() {
    this.pulse = 0;
  }
  KnowledgeBaseTower.prototype.draw = function (ctx) {
    drawRR(ctx, -168, -72, 36, 88, 6, "rgba(51,65,85,0.55)", C.outline);
    for (var i = 0; i < 5; i++) {
      drawRR(ctx, -162, -64 + i * 14, 24, 10, 2, i % 2 ? "rgba(121,242,255,0.12)" : "rgba(255,255,255,0.06)", null);
    }
    ctx.fillStyle = C.consoleCyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("KB", -164, -78);
    var prg = (frame * 0.04) % 250;
    if (prg > 55 && prg < 130) {
      this.pulse = Math.sin(frame * 0.1) * 0.3 + 0.7;
      ctx.strokeStyle = "rgba(121,242,255," + this.pulse + ")";
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.moveTo(-130, -20);
      ctx.quadraticCurveTo(-60, -40, -20, -10);
      ctx.stroke();
    }
  };

  /* RAG-консоль — вместо WebsiteTerminal */
  function RagAnswerConsole() {
    this.fragments = 0;
    this.draftAlpha = 0;
  }
  RagAnswerConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 250;
    drawRR(ctx, -55, -82, 118, 148, 10, C.consoleBase, C.outline);

    drawRR(ctx, -48, -74, 104, 16, [6, 6, 0, 0], "rgba(121,242,255,0.18)", null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("RAG · Support Console", -42, -63);

    /* Чат-пузыри */
    if (prg >= 12) {
      drawRR(ctx, -42, -52, 72, 18, 6, "rgba(255,255,255,0.08)", C.outline);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("Где мой заказ #4821?", -36, -40);
    }

    /* Фаза RAG: фрагменты KB */
    if (prg >= 58 && prg < 145) {
      var frags = ["FAQ доставка", "SLA 24ч", "Трекинг"];
      frags.forEach(function (f, i) {
        var pop = Math.min(1, (prg - 62 - i * 12) / 10);
        if (pop > 0) {
          drawRR(ctx, -40 + i * 2, -28 + i * 16, 78, 12, 3, "rgba(139,92,246,0.22)", C.consoleViolet);
          ctx.fillStyle = "#ddd6fe";
          ctx.globalAlpha = pop;
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.fillText(f, -34, -18 + i * 16);
          ctx.globalAlpha = 1;
        }
      });
    }

    /* Черновик ответа */
    if (prg >= 145 && prg < 200) {
      this.draftAlpha = Math.min(1, (prg - 145) / 15);
      ctx.globalAlpha = this.draftAlpha;
      drawRR(ctx, -42, 8, 88, 28, 6, "rgba(34,197,94,0.15)", C.gaugeGreen);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("Заказ в пути · цитата FAQ", -36, 22);
      ctx.globalAlpha = 1;
    }

    /* Финал: resolved или escalate */
    if (prg >= 200) {
      var fin = prg < 225;
      var col = fin ? C.gaugeGreen : C.bridgePurple;
      var txt = fin ? "✓ Решено" : "→ Оператору";
      ctx.strokeStyle = col;
      ctx.lineWidth = 2;
      ctx.strokeRect(-30, 42, 68, 22);
      ctx.fillStyle = col;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(txt, 4, 57);
    }
  };

  /* Кольцо confidence */
  function ConfidenceGaugeRing() {
    this.angle = 0;
  }
  ConfidenceGaugeRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 250;
    if (prg < 58 || prg > 210) return;
    var conf = prg < 145 ? 0.45 + (prg - 58) / 200 : prg < 200 ? 0.91 : 0.42;
    this.angle = conf * Math.PI * 2;
    ctx.strokeStyle = "rgba(255,255,255,0.08)";
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.arc(52, 30, 22, 0, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = conf > 0.7 ? C.gaugeGreen : C.gaugeAmber;
    ctx.beginPath();
    ctx.arc(52, 30, 22, -Math.PI / 2, -Math.PI / 2 + this.angle);
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(conf * 100) + "%", 52, 33);
  };

  /* Мост эскалации к оператору */
  function OperatorHandoffBridge() {
    this.glow = 0;
  }
  OperatorHandoffBridge.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 250;
    drawRR(ctx, 118, -48, 44, 56, 6, "rgba(139,92,246,0.12)", C.outline);
    ctx.fillStyle = "#ddd6fe";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Оператор", 140, -36);

    if (prg >= 218) {
      this.glow = (prg - 218) / 32;
      ctx.strokeStyle = "rgba(167,139,250," + Math.min(1, this.glow) + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(10, 50);
      ctx.lineTo(118, -10);
      ctx.stroke();
      ctx.setLineDash([]);
      drawRR(ctx, 124, 2, 32, 14, 3, "rgba(167,139,250,0.25)", C.bridgePurple);
      ctx.fillStyle = "#ede9fe";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("summary", 140, 12);
    }
  };

  /* Каналы: виджет / Telegram / email */
  function ChannelBadgeRow() {
    this.blink = 0;
  }
  ChannelBadgeRow.prototype.draw = function (ctx) {
    var badges = ["Web", "TG", "@"];
    badges.forEach(function (b, i) {
      drawRR(ctx, -155 + i * 22, 58, 18, 12, 3, "rgba(255,255,255,0.06)", C.outline);
      ctx.fillStyle = "#94a3b8";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b, -146 + i * 22, 67);
    });
    if (frame % 90 < 45) {
      ctx.fillStyle = C.consoleCyan;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("омниканал", -155, 78);
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
    var prg = (frame * 0.04) % 250;
    var isMoving = false;
    var faceDir = 1;

    var supportTargets = {
      "1_architect": { x: -145, y: -5 },
      "2_seo": { x: -70, y: 55 },
      "3_coder": { x: 0, y: 62 },
      "4_designer": { x: 70, y: 55 },
      "5_deployer": { x: 130, y: -5 }
    };
    var tgt = supportTargets[this.role] || { x: 0, y: 50 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        var ease = local / 11;
        this.x = this.baseX + (tgt.x - this.baseX) * ease;
        this.y = this.baseY + (tgt.y - this.baseY) * ease - Math.sin(ease * Math.PI) * 8;
      } else if (local < 16) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        var back = (local - 16) / 6;
        this.x = tgt.x - (tgt.x - this.baseX) * back;
        this.y = tgt.y - (tgt.y - this.baseY) * back;
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 230);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.1;
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
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var orbit = new TicketOrbitStream();
  var kbTower = new KnowledgeBaseTower();
  var ragConsole = new RagAnswerConsole();
  var gauge = new ConfidenceGaugeRing();
  var bridge = new OperatorHandoffBridge();
  var channels = new ChannelBadgeRow();

  entities.push(channels);
  entities.push(kbTower);
  entities.push(orbit);
  entities.push(ragConsole);
  entities.push(gauge);
  entities.push(bridge);
  entities.push(new Agent(-130, 92, C.agentYellow, "1_architect", 18, [
    "Матрица интентов", "Аудит 200 тикетов", "Карта FAQ-пробелов"
  ]));
  entities.push(new Agent(-65, 98, C.agentGreen, "2_seo", 62, [
    "Релевантность чанка 0.89", "Цитата из KB обязательна", "Deflection 35%"
  ]));
  entities.push(new Agent(0, 100, C.agentBlue, "3_coder", 112, [
    "Hybrid vector+keyword", "Webhook в Zendesk", "Порог confidence 0.75"
  ]));
  entities.push(new Agent(65, 98, C.agentPink, "4_designer", 162, [
    "Ответ с цитатой FAQ", "Тон бренда в промпте", "CSAT +12 п.п."
  ]));
  entities.push(new Agent(130, 92, C.agentPurple, "5_deployer", 212, [
    "Handoff + summary", "Copilot оператору", "FRT < 2 мин"
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

    var prg = (frame * 0.04) % 250;
    if (prg >= 14 && prg < 14.05) createBubble(-100, -30, "1. Тикет на орбите");
    if (prg >= 68 && prg < 68.05) createBubble(-20, -60, "2. RAG: 3 фрагмента KB");
    if (prg >= 152 && prg < 152.05) createBubble(10, 5, "3. Черновик с цитатой");
    if (prg >= 205 && prg < 205.05) createBubble(50, 35, "4. Решено или handoff");
    if (prg >= 232 && prg < 232.05) createBubble(120, -20, "5. Summary оператору");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      drawRR(ctx, b.x - (ctx.measureText(b.text).width + 14) / 2, b.y - 22, ctx.measureText(b.text).width + 14, 18, 5, C.bubbleBg, C.consoleCyan);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
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

<script>
(function(){
  document.querySelectorAll('.csai-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.csai-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.csai-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.csai-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
    });
    btn.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); btn.click(); } });
  });
})();
</script>

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

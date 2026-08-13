<?php
/**
 * Template Name: AI-сегментация клиентской базы для повторных продаж
 * Description: Внедрение AI-сегментации клиентской базы под ключ — персональные сценарии касаний, интеграция CRM.
 */

$page_seo_title       = 'AI-сегментация клиентов под ключ — повторные продажи';
$page_seo_description = 'Внедрение AI-сегментации клиентской базы под ключ: персональные сценарии касаний вместо массовых рассылок. Интеграция с CRM, карта сегментов, рост LTV. Аудит — бесплатно.';

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

$brand = get_bloginfo( 'name' ) ?: ( getenv( 'SITE_BRAND' ) ?: '' ); // pragma: allowlist secret

$nero_ai_header_links = [
	[ 'label' => 'Как работает', 'href' => '#kak-rabotaet' ],
	[ 'label' => 'CRM', 'href' => '#crm' ],
	[ 'label' => 'Этапы', 'href' => '#etapy' ],
	[ 'label' => 'Кейсы', 'href' => '#keisy' ],
	[ 'label' => 'Стоимость', 'href' => '#ceny' ],
	[ 'label' => 'FAQ', 'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Найти повторные продажи';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '';
$ad_banner_url       = getenv( 'AD_BANNER_URL' ) ?: '';
$ad_banner_image     = getenv( 'AD_BANNER_IMAGE_URL' ) ?: '';
$ad_banner_alt       = getenv( 'AD_BANNER_ALT' ) ?: 'Рекламный баннер партнёра';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if ( ! is_readable( $nero_ai_floating ) ) {
	require dirname( __DIR__ ) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
	require $nero_ai_floating;
}


<?php nero_ai_echo_theme_styles( [ 'nero-ai-longread-ui-compat.css' ] ); ?>

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
   ASEG PAGE — GLOBAL RESETS
   ===================================================== */
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

/* =====================================================
   ASEG CONTENT ROOT — dark theme
   ===================================================== */
.aseg-content{
  --aseg-bg:#050711;--aseg-bg2:#080b17;--aseg-bg3:#0a0e1c;
  --aseg-surface:rgba(255,255,255,.072);--aseg-surface2:rgba(255,255,255,.108);
  --aseg-text:#e6edf7;--aseg-muted:#9aa8bd;--aseg-soft:#c7d2e5;--aseg-heading:#fff;
  --aseg-border:rgba(255,255,255,.10);--aseg-border-s:rgba(255,255,255,.18);
  --aseg-accent:#79f2ff;--aseg-violet:#8b5cf6;--aseg-green:#22c55e;--aseg-cyan:#79f2ff;
  --aseg-btn-from:#2563eb;--aseg-btn-to:#7c3aed;
  --aseg-shadow:0 24px 72px rgba(0,0,0,.4);
  --aseg-r:18px;--aseg-r-lg:24px;
  --aseg-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aseg-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aseg-content *,.aseg-content *::before,.aseg-content *::after{box-sizing:border-box;}
.aseg-content a{color:inherit;text-decoration:none;}
.aseg-content p{color:var(--aseg-muted);line-height:1.72;margin:0 0 1em;}
.aseg-content p:last-child{margin-bottom:0;}
.aseg-content h2,.aseg-content h3,.aseg-content h4{
  color:var(--aseg-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.aseg-content strong{color:var(--aseg-soft);}
.aseg-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aseg-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--aseg-muted);font-size:14.5px;line-height:1.65;
}
.aseg-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--aseg-accent);font-weight:700;
}

/* Container */
.aseg-cnt{
  width:min(var(--aseg-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.aseg-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aseg-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.aseg-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aseg-sh.aseg-left{margin-left:0;text-align:left;}
.aseg-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aseg-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aseg-sh.aseg-left p{margin-left:0;}

/* Eyebrow */
.aseg-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--aseg-accent);margin-bottom:14px;
}

/* Gradient text */
.aseg-gt{
  background:linear-gradient(92deg,#fff 0%,var(--aseg-accent) 44%,var(--aseg-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.aseg-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.aseg-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.aseg-intro-text{
  position:relative;padding-left:20px;
}
.aseg-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--aseg-accent),var(--aseg-violet));
}
.aseg-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--aseg-muted);margin-bottom:1em;
}
.aseg-intro-text p:last-child{margin-bottom:0;color:var(--aseg-soft);}
.aseg-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.aseg-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.aseg-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--aseg-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.aseg-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aseg-muted);line-height:1.4;}
.aseg-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .aseg-intro-grid{grid-template-columns:1fr;gap:36px;}
  .aseg-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .aseg-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.aseg-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aseg-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.aseg-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--aseg-surface);border:1px solid var(--aseg-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--aseg-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.aseg-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--aseg-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.aseg-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--aseg-border);border-radius:var(--aseg-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.aseg-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.aseg-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aseg-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .aseg-grid-2{grid-template-columns:1fr;}
  .aseg-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .aseg-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .aseg-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.aseg-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--aseg-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.aseg-level-card:hover{transform:translateY(-2px);}
.aseg-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--aseg-r) var(--aseg-r) 0 0;
}
.aseg-level-card.l1::before{background:var(--aseg-green);}
.aseg-level-card.l2::before{background:var(--aseg-accent);}
.aseg-level-card.l3::before{background:var(--aseg-violet);}
.aseg-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.aseg-level-card.l1 .aseg-level-badge{background:rgba(34,197,94,.15);color:var(--aseg-green);}
.aseg-level-card.l2 .aseg-level-badge{background:rgba(121,242,255,.15);color:var(--aseg-accent);}
.aseg-level-card.l3 .aseg-level-badge{background:rgba(139,92,246,.15);color:var(--aseg-violet);}
.aseg-level-card h3{font-size:17px;margin-bottom:10px;}
.aseg-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.aseg-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--aseg-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.aseg-scenario:last-child{margin-bottom:0;}
.aseg-scenario:hover{border-color:rgba(121,242,255,.3);}
.aseg-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.aseg-scenario h3{font-size:17px;margin-bottom:8px;}
.aseg-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.aseg-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.aseg-table{width:100%;border-collapse:collapse;font-size:14px;}
.aseg-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--aseg-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.aseg-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--aseg-text);vertical-align:top;
}
.aseg-table tr:last-child td{border-bottom:none;}
.aseg-table tr:hover td{background:rgba(255,255,255,.03);}
.aseg-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.aseg-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.aseg-stack-layer:last-child{border-bottom:none;}
.aseg-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--aseg-accent);padding-top:2px;
}
.aseg-stack-val{font-size:14.5px;color:var(--aseg-text);}
.aseg-stack-desc{font-size:13px;color:var(--aseg-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.aseg-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.aseg-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aseg-case-grid{grid-template-columns:1fr;}}
.aseg-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.aseg-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.aseg-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--aseg-green);margin-bottom:10px;
}
.aseg-case-card h3{font-size:16px;margin-bottom:14px;}
.aseg-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.aseg-metric{display:flex;align-items:baseline;gap:8px;}
.aseg-metric .num{font-size:22px;font-weight:900;color:var(--aseg-accent);flex-shrink:0;letter-spacing:-.04em;}
.aseg-metric .lbl{font-size:13px;color:var(--aseg-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.aseg-timeline{position:relative;padding-left:40px;}
.aseg-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--aseg-accent),var(--aseg-violet));
  opacity:.35;border-radius:2px;
}
.aseg-tl-item{position:relative;margin-bottom:32px;}
.aseg-tl-item:last-child{margin-bottom:0;}
.aseg-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--aseg-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.aseg-tl-item h3{font-size:17px;margin-bottom:8px;}
.aseg-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.aseg-pricing-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:960px){.aseg-pricing-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aseg-pricing-grid{grid-template-columns:1fr;}}
.aseg-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.aseg-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.aseg-price-card.aseg-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.aseg-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--aseg-accent);margin-bottom:10px;
}
.aseg-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.aseg-price-card .inc{font-size:13px;color:var(--aseg-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.aseg-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.aseg-compare{width:100%;border-collapse:collapse;}
.aseg-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--aseg-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.aseg-compare td{
  padding:13px 16px;font-size:14px;color:var(--aseg-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.aseg-compare tr:last-child td{border-bottom:none;}
.aseg-good{color:var(--aseg-green);}
.aseg-neutral{color:var(--aseg-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.aseg-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aseg-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.aseg-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--aseg-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.aseg-faq-q::after{
  content:'▾';font-size:13px;color:var(--aseg-accent);
  flex-shrink:0;transition:transform .25s;
}
.aseg-faq-item.open .aseg-faq-q::after{transform:rotate(180deg);}
.aseg-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--aseg-muted);line-height:1.72;
}
.aseg-faq-item.open .aseg-faq-a{max-height:600px;padding:0 24px 20px;}

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
  color:var(--aseg-muted);font-size:15px;
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
  background:linear-gradient(135deg,var(--aseg-btn-from),var(--aseg-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(59,130,246,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--aseg-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(121,242,255,.4);background:rgba(59,130,246,.12);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* =====================================================
   CTA FINAL SECTION
   ===================================================== */
.aseg-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.aseg-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--aseg-muted);
}
.aseg-cta-checklist li::before{content:'✓';color:var(--aseg-green);font-weight:800;}

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

.aseg-hero{min-height:100vh;min-height:100dvh;}
.ym-cta-block--primary{background:linear-gradient(135deg,rgba(121,242,255,.14),rgba(139,92,246,.12));border-color:rgba(121,242,255,.35);}
.ym-cta-block--secondary{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);text-align:left;}
.ym-link--accent{color:var(--aseg-accent)!important;text-decoration:underline;}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-segmentaciya-klientov-page" role="main" tabindex="-1">

<section class="nero-ai-hero aseg-hero" id="hero" aria-labelledby="aseg-hero-title">
<style>
/* === АЛИНА: self-contained hero (.aseg-hero) === */
.aseg-hero {
  --aseg-bg: #050711;
  --aseg-text: #e6edf7;
  --aseg-muted: #9aa8bd;
  --aseg-cyan: #79f2ff;
  --aseg-violet: #8b5cf6;
  --aseg-green: #22c55e;
  --aseg-amber: #f59e0b;
  --aseg-border: rgba(255, 255, 255, 0.12);
  position: relative;
  padding: clamp(48px, 8vw, 96px) 0 clamp(56px, 7vw, 88px);
  overflow: hidden;
}
.aseg-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background:
    radial-gradient(circle at 18% 12%, rgba(121, 242, 255, 0.14), transparent 32rem),
    radial-gradient(circle at 88% 8%, rgba(139, 92, 246, 0.18), transparent 36rem);
  pointer-events: none;
}
.aseg-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aseg-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(320px, 0.95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aseg-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aseg-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.aseg-hero .nero-ai-h1,
.aseg-hero h1 {
  margin: 0;
  font-size: clamp(34px, 5vw, 58px);
  font-weight: 900;
  line-height: 1.04;
  letter-spacing: -0.045em;
  color: #fff;
}
.aseg-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, var(--aseg-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aseg-hero .nero-ai-hero-lead,
.aseg-hero .nero-ai-lead {
  margin: 18px 0 0;
  max-width: 640px;
  font-size: clamp(16px, 1.7vw, 19px);
  line-height: 1.65;
  color: var(--aseg-muted);
}
.aseg-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 22px 0 0;
  padding: 0;
  list-style: none;
}
.aseg-hero .nero-ai-badge {
  padding: 8px 14px;
  border-radius: 999px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: rgba(255, 255, 255, 0.06);
  color: var(--aseg-text);
  font-size: 13px;
  font-weight: 650;
}
.aseg-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 28px;
  align-items: center;
}
.aseg-hero .nero-ai-btn {
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
  transition: transform 0.22s ease, border-color 0.22s ease, background 0.22s ease;
}
.aseg-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.aseg-hero .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--aseg-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aseg-hero .nero-ai-btn-secondary {
  color: var(--aseg-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aseg-hero .nero-ai-dashboard {
  padding: 14px;
  border-radius: 28px;
  border: 1px solid var(--aseg-border);
  background: linear-gradient(180deg, rgba(255, 255, 255, 0.09), rgba(255, 255, 255, 0.04));
  box-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  backdrop-filter: blur(18px);
}
.aseg-hero .nero-ai-dashboard-shell {
  border-radius: 22px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(6, 10, 24, 0.92);
  overflow: hidden;
}
.aseg-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.04);
}
.aseg-hero .nero-ai-dots { display: flex; gap: 6px; }
.aseg-hero .nero-ai-dot {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(255, 255, 255, 0.22);
}
.aseg-hero .nero-ai-window-title {
  font-size: 11px;
  font-weight: 650;
  color: var(--aseg-muted);
  letter-spacing: 0.04em;
}
.aseg-hero .nero-ai-window-body { padding: 16px; }
.aseg-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aseg-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aseg-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.1);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.aseg-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px; height: 7px; border-radius: 50%;
  background: var(--aseg-green);
  box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.14);
  animation: asegPulse 1.6s infinite;
}
@keyframes asegPulse {
  0%, 100% { transform: scale(0.86); opacity: 0.65; }
  50% { transform: scale(1); opacity: 1; }
}
.aseg-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aseg-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255, 255, 255, 0.09);
  border-radius: 16px;
  background: rgba(255, 255, 255, 0.055);
}
.aseg-hero .nero-ai-metric span {
  display: block;
  color: var(--aseg-muted);
  font-size: 11px;
  font-weight: 700;
}
.aseg-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aseg-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aseg-hero .aseg-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 35%, rgba(139, 92, 246, 0.12), rgba(6, 10, 24, 0.92) 72%);
}
.aseg-hero #aseg-segment-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aseg-hero .aseg-phase-pills {
  position: absolute;
  left: 10px;
  bottom: 10px;
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  z-index: 2;
  pointer-events: none;
}
.aseg-hero .aseg-phase-pill {
  padding: 5px 10px;
  border-radius: 999px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: rgba(15, 23, 42, 0.82);
  color: #cbd5e1;
  font-size: 10px;
  font-weight: 700;
}
.aseg-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.aseg-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.04);
}
.aseg-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px; height: 28px;
  border-radius: 12px;
  background: rgba(121, 242, 255, 0.12);
  color: var(--aseg-cyan);
  font-size: 11px;
  font-weight: 800;
}
.aseg-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aseg-hero .nero-ai-task span {
  color: var(--aseg-muted);
  font-size: 11px;
}
.aseg-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aseg-hero .nero-ai-status--amber {
  background: rgba(245, 158, 11, 0.12);
  color: #fde68a;
}
.aseg-hero .nero-ai-status--violet {
  background: rgba(139, 92, 246, 0.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .aseg-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
}
@media (max-width: 520px) {
  .aseg-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aseg-hero .nero-ai-window-body { padding: 12px; }
  .aseg-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aseg-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <?php echo '<p class="nero-ai-eyebrow">' . esc_html( $brand ) . ' · ai сегментация</p>'; ?>
      <h1 id="aseg-hero-title">AI-сегментация клиентской базы для <span class="nero-ai-gradient-text">повторных продаж</span></h1>
      <p class="nero-ai-hero-lead">AI делит клиентскую базу на сегменты и запускает персональные сценарии касаний — вместо одинаковых рассылок, которые плохо продают</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Сегменты RFM</li>
        <li class="nero-ai-badge">Персональные сценарии</li>
        <li class="nero-ai-badge">amoCRM / Mindbox</li>
        <li class="nero-ai-badge">Повторные продажи</li>
      </ul>
      <div class="nero-ai-btn-row">
        <?php echo '<a class="nero-ai-btn nero-ai-btn-primary" href="' . esc_url( $primary_cta_url ) . '"' . $primary_cta_attrs . '>' . esc_html( $primary_cta_label ) . '</a>'; ?>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-сегментации клиентской базы">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-сегментация · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Сегментов</span><strong>11</strong><small>RFM + поведение</small></div>
            <div class="nero-ai-metric"><span>Open rate</span><strong>+28%</strong><small>vs массовая</small></div>
            <div class="nero-ai-metric"><span>Repeat</span><strong>+22%</strong><small>повторные</small></div>
            <div class="nero-ai-metric"><span>CRM-канал</span><strong>16,2%</strong><small>выручки</small></div>
          </div>
          <div class="aseg-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aseg-segment-hero-canvas" role="img" aria-label="Анимация: AI делит базу на сегменты и запускает персональные касания вместо массовой рассылки"></canvas>
            <div class="aseg-phase-pills" aria-hidden="true">
              <span class="aseg-phase-pill">blast</span>
              <span class="aseg-phase-pill">score</span>
              <span class="aseg-phase-pill">assign</span>
              <span class="aseg-phase-pill">touch</span>
            </div>
          </div>
          <div class="nero-ai-task-stream" aria-label="Лента сценариев касаний">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">VIP</span>
              <div><strong>VIP → upsell</strong><span>Персональный бандл без демпинга</span></div>
              <span class="nero-ai-status">запущен</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ZZ</span>
              <div><strong>Засыпающий → winback</strong><span>Индивидуальный оффер 60+ дней</span></div>
              <span class="nero-ai-status nero-ai-status--amber">триггер</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">NEW</span>
              <div><strong>Новый → onboarding</strong><span>Серия касаний, не дайджест</span></div>
              <span class="nero-ai-status nero-ai-status--violet">сценарий</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * aseg-segment-engine — Сегментационный RFM-радар
 * Мир: массовый blast → AI-score → кластеры → персональные касания
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aseg-segment-hero-canvas");
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
    blast: "#64748b",
    blastDim: "rgba(100,116,139,0.35)",
    vip: "#fbbf24",
    active: "#34d399",
    sleep: "#f59e0b",
    newSeg: "#79f2ff",
    hubBase: "#1e293b",
    hubGlow: "rgba(121,242,255,0.35)",
    ring: "rgba(139,92,246,0.45)",
    touchEmail: "#93c5fd",
    touchPush: "#c4b5fd",
    touchTask: "#f472b6",
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

  /* Серое облако массовой рассылки — уникальный объект */
  function MassBlastCloud() {
    this.pulse = 0;
  }
  MassBlastCloud.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    this.pulse = Math.sin(frame * 0.06) * 0.08 + 0.92;
    var alpha = prg < 140 ? 0.55 + this.pulse * 0.25 : Math.max(0.15, 0.55 - (prg - 140) / 120);

    ctx.save();
    ctx.globalAlpha = alpha;
    for (var i = 0; i < 14; i++) {
      var bx = -55 + (i % 7) * 16 + Math.sin(frame * 0.04 + i) * 3;
      var by = -95 + Math.floor(i / 7) * 14;
      drawRR(ctx, bx, by, 12, 9, 2, C.blastDim, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("−15%", bx + 6, by + 7);
    }
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("МАССОВАЯ РАССЫЛКА", 0, -108);
    ctx.restore();
  };

  /* Меридианные потоки клиентов — замена Conveyor */
  function ClientMeridianStream() {
    this.dots = [];
    for (var i = 0; i < 12; i++) {
      this.dots.push({
        lane: i % 4,
        t: i * 0.18,
        color: C.blast,
        assigned: false
      });
    }
  }
  ClientMeridianStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    var lanes = [
      { tx: -58, ty: 28, color: C.vip, label: "VIP" },
      { tx: 58, ty: 28, color: C.active, label: "Актив" },
      { tx: -48, ty: 62, color: C.sleep, label: "ZZ" },
      { tx: 48, ty: 62, color: C.newSeg, label: "NEW" }
    ];

    lanes.forEach(function (lane, idx) {
      ctx.save();
      ctx.strokeStyle = idx % 2 === 0 ? "rgba(121,242,255,0.2)" : "rgba(139,92,246,0.22)";
      ctx.lineWidth = 1.5;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.moveTo(0, -75);
      ctx.bezierCurveTo(lane.tx * 0.3, -20, lane.tx * 0.7, 10, lane.tx, lane.ty);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();
    });

    if (prg >= 70) {
      this.dots.forEach(function (d, i) {
        var lane = lanes[d.lane];
        var assignPrg = Math.min(1, (prg - 70 - i * 4) / 55);
        if (assignPrg <= 0) {
          d.color = C.blast;
          var swirl = Math.sin(frame * 0.05 + i) * 8;
          var sx = -40 + (i % 6) * 14 + swirl;
          var sy = -88 + Math.floor(i / 6) * 12;
          ctx.fillStyle = d.color;
          ctx.beginPath();
          ctx.arc(sx, sy, 4, 0, Math.PI * 2);
          ctx.fill();
        } else {
          d.color = lane.color;
          var startX = 0, startY = -75;
          var t = assignPrg;
          var cx1 = lane.tx * 0.3, cy1 = -20;
          var cx2 = lane.tx * 0.7, cy2 = 10;
          var ex = lane.tx, ey = lane.ty;
          var px = (1 - t) * (1 - t) * (1 - t) * startX + 3 * (1 - t) * (1 - t) * t * cx1 + 3 * (1 - t) * t * t * cx2 + t * t * t * ex;
          var py = (1 - t) * (1 - t) * (1 - t) * startY + 3 * (1 - t) * (1 - t) * t * cy1 + 3 * (1 - t) * t * t * cy2 + t * t * t * ey;
          ctx.fillStyle = d.color;
          ctx.beginPath();
          ctx.arc(px, py, 5, 0, Math.PI * 2);
          ctx.fill();
          ctx.strokeStyle = C.outline;
          ctx.lineWidth = 1;
          ctx.stroke();
        }
      });
    }
  };

  /* RFM-кольцо — вспомогательная анимация */
  function RFMRingGauge() {
    this.angle = 0;
  }
  RFMRingGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    if (prg < 55 || prg > 200) return;
    this.angle = frame * 0.02;
    ctx.save();
    ctx.strokeStyle = C.ring;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, 18, 72, this.angle, this.angle + Math.PI * 1.4);
    ctx.stroke();
    ["R", "F", "M"].forEach(function (lbl, i) {
      var a = this.angle + i * 1.1;
      var rx = Math.cos(a) * 72;
      var ry = 18 + Math.sin(a) * 72;
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(lbl, rx, ry);
    }, this);
    ctx.restore();
  };

  /* Центральный хаб сегментов — замена WebsiteTerminal */
  function SegmentRadarHub() {
    this.glow = 0;
  }
  SegmentRadarHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    this.glow = prg > 70 && prg < 200 ? Math.sin(frame * 0.08) * 0.15 + 0.85 : 0.4;

    drawRR(ctx, -62, -8, 124, 88, 14, C.hubBase, C.outline);

    /* Квадранты сегментов */
    var quads = [
      { x: -52, y: 2, w: 48, h: 32, color: "rgba(251,191,36,0.22)", label: "VIP" },
      { x: 4, y: 2, w: 48, h: 32, color: "rgba(52,211,153,0.2)", label: "Актив" },
      { x: -52, y: 38, w: 48, h: 32, color: "rgba(245,158,11,0.22)", label: "ZZ" },
      { x: 4, y: 38, w: 48, h: 32, color: "rgba(121,242,255,0.18)", label: "NEW" }
    ];
    quads.forEach(function (q, i) {
      var lit = prg > 80 + i * 18;
      ctx.fillStyle = lit ? q.color : "rgba(255,255,255,0.04)";
      drawRR(ctx, q.x, q.y, q.w, q.h, 6, ctx.fillStyle, lit ? C.outline : null);
      ctx.fillStyle = lit ? "#fff" : "#94a3b8";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(q.label, q.x + q.w / 2, q.y + 20);
    });

    if (prg > 70 && prg < 145) {
      ctx.strokeStyle = "rgba(121,242,255," + this.glow + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, 36, 38 + Math.sin(frame * 0.1) * 4, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* Импульсы churn на засыпающем сегменте */
  function ChurnRiskSpark() {
    this.sparks = [];
  }
  ChurnRiskSpark.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    if (prg < 100 || prg > 220) return;
    if (frame % 18 === 0) {
      this.sparks.push({ x: -28 + Math.random() * 12, y: 50 + Math.random() * 8, life: 30 });
    }
    this.sparks.forEach(function (s) {
      s.life--;
      ctx.fillStyle = "rgba(245,158,11," + (s.life / 30) + ")";
      ctx.beginPath();
      ctx.arc(s.x, s.y, 3, 0, Math.PI * 2);
      ctx.fill();
    });
    this.sparks = this.sparks.filter(function (s) { return s.life > 0; });
  };

  /* Персональные лучи касаний — финал цикла */
  function TouchRouteLauncher() {
    this.beams = [];
  }
  TouchRouteLauncher.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    if (prg < 195) return;

    var routes = [
      { from: [-28, 18], to: [-95, -15], color: C.touchEmail, icon: "✉" },
      { from: [28, 18], to: [95, -10], color: C.touchPush, icon: "◎" },
      { from: [-28, 54], to: [-90, 95], color: C.touchTask, icon: "✓" },
      { from: [28, 54], to: [88, 92], color: C.newSeg, icon: "★" }
    ];

    routes.forEach(function (r, i) {
      var local = Math.min(1, (prg - 195 - i * 6) / 20);
      if (local <= 0) return;
      ctx.strokeStyle = r.color.replace(")", "," + local * 0.85 + ")").replace("rgb", "rgba").replace("#", "");
      /* hex to rgba fallback */
      ctx.strokeStyle = local < 1 ? "rgba(121,242,255," + local * 0.7 + ")" : C.hubGlow;
      if (i === 0) ctx.strokeStyle = "rgba(147,197,253," + local * 0.85 + ")";
      if (i === 1) ctx.strokeStyle = "rgba(196,181,253," + local * 0.85 + ")";
      if (i === 2) ctx.strokeStyle = "rgba(244,114,182," + local * 0.85 + ")";
      if (i === 3) ctx.strokeStyle = "rgba(121,242,255," + local * 0.85 + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([4, 4]);
      ctx.beginPath();
      ctx.moveTo(r.from[0], r.from[1]);
      ctx.lineTo(r.from[0] + (r.to[0] - r.from[0]) * local, r.from[1] + (r.to[1] - r.from[1]) * local);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 10px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(r.icon, r.to[0], r.to[1]);
    });
  };

  /* Метрика repeat — не деньги/ракета */
  function RepeatLiftBadge() {
    this.lift = 0;
  }
  RepeatLiftBadge.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    if (prg < 210) return;
    this.lift = Math.min(1, (prg - 210) / 25);
    var y = 108 - this.lift * 18;
    ctx.save();
    ctx.globalAlpha = this.lift;
    drawRR(ctx, -42, y, 84, 22, 8, "rgba(34,197,94,0.22)", C.active);
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("+22% repeat", 0, y + 14);
    ctx.restore();
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
    var prg = (frame * 0.045) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: 0, y: -42 },
      "2_seo": { x: -75, y: 8 },
      "3_coder": { x: 75, y: 8 },
      "4_designer": { x: -70, y: 78 },
      "5_deployer": { x: 70, y: 78 }
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

  entities.push(new MassBlastCloud());
  entities.push(new ClientMeridianStream());
  entities.push(new RFMRingGauge());
  entities.push(new SegmentRadarHub());
  entities.push(new ChurnRiskSpark());
  entities.push(new TouchRouteLauncher());
  entities.push(new RepeatLiftBadge());
  entities.push(new Agent(-125, 95, C.agentYellow, "1_architect", 22, [
    "RFM: 5×5×5", "Карта сегментов", "Правила входа/выхода"
  ]));
  entities.push(new Agent(-55, 108, C.agentGreen, "2_seo", 68, [
    "VIP ≠ новичок", "Intent по сегменту", "LSI для winback"
  ]));
  entities.push(new Agent(55, 108, C.agentBlue, "3_coder", 112, [
    "Триггер CRM", "Webhook сегмента", "Динамическое поле"
  ]));
  entities.push(new Agent(-95, 118, C.agentPink, "4_designer", 156, [
    "3 шаблона касаний", "Не один дайджест", "VIP без скидки"
  ]));
  entities.push(new Agent(95, 118, C.agentPurple, "5_deployer", 198, [
    "Winback в прод", "Upsell VIP live", "Onboarding NEW"
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

    var prg = (frame * 0.045) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(0, -100, "1. Массовый blast");
    if (prg >= 78 && prg < 78.05) createBubble(0, -30, "2. AI-score RFM");
    if (prg >= 138 && prg < 138.05) createBubble(-40, 40, "3. Кластер VIP/ZZ");
    if (prg >= 198 && prg < 198.05) createBubble(50, 50, "4. Персональные касания");
    if (prg >= 218 && prg < 218.05) createBubble(0, 100, "+22% repeat");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.hubGlow);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 11);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  document.fonts.ready.then(function () { engineloop(); });
});
</script>

<div class="aseg-content">

  <section class="aseg-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="aseg-cnt nero-ai-container">
      <div class="aseg-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="aseg-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai сегментация</p>
          <p><strong>Коротко:</strong> одна и та же рассылка на всю базу перестала работать как инструмент повторных продаж. Клиенты ждут релевантности; CRM-канал без сегментации съедает маржу на спам и отписки.</p>
          <p>Боль из практики Nero Network звучит просто: <strong>одинаковые рассылки уходят всей базе и плохо продают</strong>. Маркетинг тратит бюджет на охват, а повторные продажи растут слабо или только за счёт демпинга.</p>
        </div>
        <div class="aseg-intro-kpi" aria-label="Ключевые показатели">
          <div class="aseg-kpi-card"><div class="kv">73%</div><div class="kl">B2B избегают нерелевантных касаний</div><div class="ks">Salesforce 2026</div></div>
          <div class="aseg-kpi-card"><div class="kv">51%</div><div class="kl">лидеров: разрозненные системы тормозят AI</div><div class="ks">Salesforce 2026</div></div>
          <div class="aseg-kpi-card"><div class="kv">×6</div><div class="kl">выручка на получателя vs ручные рассылки</div><div class="ks">EKONIKA / Mindbox</div></div>
          <div class="aseg-kpi-card"><div class="kv">150–450К</div><div class="kl">ориентир чека внедрения под ключ</div><div class="ks">проект Nero Network</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aseg-toc-outer">
    <div class="aseg-cnt">
      <nav class="aseg-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#problem">Проблема</a>
        <a href="#chto-takoe">Что такое</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#crm">CRM</a>
        <a href="#etapy">Этапы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Аудит</a>
      </nav>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <section class="aseg-section" id="problem">
    <div class="aseg-cnt">
      <div class="aseg-sh nero-ai-reveal">
        <span class="aseg-eyebrow">Боль CRM-канала</span>
        <h2>Почему массовые рассылки не дают повторных продаж</h2>
        <p>Типичная картина: в CRM 5 000–50 000 контактов, раз в неделю уходит «общая» email- или push-рассылка. Для части аудитории это уместно. Для остальных — шум.</p>
      </div>
      <div class="aseg-card nero-ai-reveal">
        <h3 id="problem-mass">Когда вся база получает одно и то же предложение</h3>
        <p>По данным Salesforce State of Sales 2026, <strong>73% B2B-покупателей</strong> сознательно избегают продавцов с нерелевантными касаниями. В e-commerce и подписках та же логика: человек только купил — и получает winback. VIP с пятью заказами — и видит оффер «первый заказ −15%». Одинаковые рассылки не «немного неэффективны» — они <strong>смещают</strong> клиента в сегмент «не читаю ваши письма».</p>
        <p>Кейс «Акушерство» (Mindbox): после отказа от массовых push и перехода на сегментацию доля выручки от CRM-канала выросла с <strong>8,7% до 16,2%</strong> в 2023 году.</p>
      </div>
      <div class="aseg-card nero-ai-reveal nero-ai-delay-1" style="margin-top:24px;">
        <h3 id="problem-metrics">Что теряет бизнес: open rate, repeat purchase, LTV</h3>
        <ul>
          <li><strong>Open rate и click rate</strong> — падают, когда контент не соответствует стадии клиента.</li>
          <li><strong>Repeat purchase rate</strong> — без сегментации reactivation откладывается «до следующей массовой рассылки».</li>
          <li><strong>LTV по сегментам</strong> — VIP и «засыпающие» получают одинаковое давление.</li>
        </ul>
        <p>Salesforce в отчёте 2026 называет AI и AI-агенты <strong>тактикой №1</strong> для роста продаж (опрос <strong>4 050</strong> sales professionals). Но <strong>51%</strong> лидеров продаж указывают: разрозненные системы тормозят AI и персонализацию.</p>
      </div>
    </div>
  </section>

  <section class="aseg-section aseg-section-alt" id="chto-takoe">
    <div class="aseg-cnt">
      <div class="aseg-sh nero-ai-reveal">
        <span class="aseg-eyebrow">Определение</span>
        <h2>Что такое AI-сегментация клиентской базы</h2>
        <p><strong>Определение:</strong> AI-сегментация клиентской базы — связка CRM/CDP, правил сегментации и ML/LLM, которая автоматически делит покупателей на группы и запускает <strong>разные сценарии касаний</strong> вместо одной рассылки «на всю базу».</p>
      </div>
      <div class="aseg-card nero-ai-reveal">
        <h3>Чем AI-сегментация отличается от ручных фильтров в CRM</h3>
        <p>Ручной фильтр отвечает на вопрос «кто купил X за последние N дней». AI-сегментация добавляет динамическое обновление, прогноз оттока и next-best-action, персонализацию оффера и канала, генерацию контента под сегмент.</p>
        <p>Ручные фильтры — фундамент. AI-сегментация — <strong>слой</strong>, который сокращает ручной скрининг базы и масштабирует персональные касания.</p>
      </div>
      <div class="aseg-card nero-ai-reveal nero-ai-delay-1" style="margin-top:24px;">
        <h3>Какие данные нужны для старта (CRM, рассылки, покупки)</h3>
        <div class="aseg-table-wrap">
          <table class="aseg-table">
            <thead><tr><th>Данные</th><th>Зачем</th><th>Минимум</th></tr></thead>
            <tbody>
              <tr><td>История заказов</td><td>RFM, циклы покупки</td><td>50–100 заказов для RFM; 500+ для ML</td></tr>
              <tr><td>Контакты и согласия</td><td>Легальные рассылки (152-ФЗ)</td><td>Актуальные opt-in</td></tr>
              <tr><td>Каталог товаров/услуг</td><td>Офферы, replenishment</td><td>SKU или услуги с циклом</td></tr>
              <tr><td>CRM-поля</td><td>Теги, этапы, средний чек</td><td>amoCRM, Битрикс24, RetailCRM</td></tr>
              <tr><td>Поведение на сайте</td><td>Корзина, просмотры</td><td>Желательно для e-commerce</td></tr>
              <tr><td>Логи рассылок</td><td>Open/click по сегментам</td><td>Для метрик «до/после»</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:16px;">Не нужен «идеальный CDP с первого дня». Старт с транзакций в CRM + одного канала — нормальная траектория для <strong>ai сегментация клиентов для малого бизнеса</strong>.</p>
      </div>
    </div>
  </section>

<section id="ai-segmentaciya-klientov-boris-block" class="asbg-root" aria-label="Анимация: карта RFM-сегментов — от массовой рассылки к персональным сценариям">
<style>
/* === БОРИС: prefix asbg-, scoped внутри #ai-segmentaciya-klientov-boris-block === */
#ai-segmentaciya-klientov-boris-block.asbg-root{
  padding:56px 0 64px;
  background:linear-gradient(180deg,#f8fafc 0%,#f1f5f9 100%);
}
#ai-segmentaciya-klientov-boris-block .asbg-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 20px;
}
#ai-segmentaciya-klientov-boris-block .asbg-card{
  display:grid;
  grid-template-columns:42% 58%;
  border-radius:22px;
  overflow:hidden;
  box-shadow:0 10px 40px rgba(15,23,42,.10),0 0 0 1px rgba(15,23,42,.06);
  min-height:480px;
  background:#fff;
}
@media(max-width:1023px){
  #ai-segmentaciya-klientov-boris-block .asbg-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-segmentaciya-klientov-boris-block .asbg-lft{
  padding:40px 36px 40px 40px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid rgba(15,23,42,.06);
}
@media(max-width:1023px){
  #ai-segmentaciya-klientov-boris-block .asbg-lft{
    border-right:none;
    border-bottom:1px solid rgba(15,23,42,.06);
    padding:32px 24px;
  }
}
#ai-segmentaciya-klientov-boris-block .asbg-ey{
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
#ai-segmentaciya-klientov-boris-block .asbg-ey::before{
  content:'';
  display:inline-block;
  width:18px;
  height:2px;
  background:#0d9488;
  border-radius:1px;
}
#ai-segmentaciya-klientov-boris-block .asbg-h3{
  font-size:24px;
  font-weight:800;
  color:#0f172a;
  line-height:1.32;
  margin:0 0 18px;
}
@media(max-width:600px){
  #ai-segmentaciya-klientov-boris-block .asbg-h3{font-size:20px;}
}
#ai-segmentaciya-klientov-boris-block .asbg-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:10px;
}
#ai-segmentaciya-klientov-boris-block .asbg-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.52;
  color:#334155;
}
#ai-segmentaciya-klientov-boris-block .asbg-ic{
  flex-shrink:0;
  width:22px;
  height:22px;
  border-radius:50%;
  background:rgba(13,148,136,.10);
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:11px;
  color:#0d9488;
  margin-top:1px;
  font-style:normal;
}
#ai-segmentaciya-klientov-boris-block .asbg-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-segmentaciya-klientov-boris-block .asbg-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:11.5px;
  font-weight:700;
  white-space:nowrap;
}
#ai-segmentaciya-klientov-boris-block .asbg-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-segmentaciya-klientov-boris-block .asbg-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-segmentaciya-klientov-boris-block .asbg-pl-a{
  background:rgba(245,158,11,.08);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.28);
}
#ai-segmentaciya-klientov-boris-block .asbg-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-segmentaciya-klientov-boris-block .asbg-rgt{
  position:relative;
  background:linear-gradient(145deg,#f0fdfa 0%,#ecfeff 40%,#f8fafc 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-segmentaciya-klientov-boris-block .asbg-rgt{min-height:380px;}
}
#aseg-rfm-map-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="asbg-cnt">
  <div class="asbg-card">

    <div class="asbg-lft">
      <span class="asbg-ey">Карта сегментов · RFM</span>
      <h3 class="asbg-h3">Одна рассылка на всех — или персональный сценарий для каждого кластера</h3>
      <ul class="asbg-ul">
        <li><span class="asbg-ic">1</span>AI читает историю заказов, частоту и давность покупки — строит 5–11 сегментов</li>
        <li><span class="asbg-ic">2</span>VIP получает upsell без скидки, засыпающий — winback в своё окно</li>
        <li><span class="asbg-ic">3</span>Новый клиент уходит в onboarding, а не в общий дайджест</li>
        <li><span class="asbg-ic">↻</span>Сегменты обновляются динамически — клиент «переезжает» между кластерами</li>
      </ul>
      <div class="asbg-pills">
        <span class="asbg-pl asbg-pl-v">11 сегментов</span>
        <span class="asbg-pl asbg-pl-g">+28% open</span>
        <span class="asbg-pl asbg-pl-a">Карта за 48 ч</span>
      </div>
      <p class="asbg-foot">Дальше — типовые сегменты и сценарии касаний по нишам →</p>
    </div>

    <div class="asbg-rgt">
      <canvas
        id="aseg-rfm-map-canvas"
        aria-label="Анимация: клиентская база делится на RFM-сегменты — VIP, активные, засыпающие, новые — с персональными сценариями касаний"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  var cv = document.getElementById('aseg-rfm-map-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, fr = 0, t = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
    initLayout();
  }
  window.addEventListener('resize', resize);

  var C = {
    ink:'#0f172a',
    muted:'#64748b',
    grid:'rgba(15,23,42,.06)',
    mass:'#94a3b8',
    ai:'#0d9488',
    aiGlow:'rgba(13,148,136,.25)',
    newC:'#3b82f6',
    actC:'#22c55e',
    vipC:'#eab308',
    sleepC:'#f59e0b',
    lostC:'#ef4444'
  };

  var SEGMENTS = [];
  var particles = [];
  var pulses = [];
  var massX = 0, massY = 0, aiX = 0, aiY = 0;

  function initLayout(){
    SEGMENTS = [
      { id:'vip',    label:'VIP',        color:C.vipC,   rx:.72, ry:.18, r:.11, scenario:'Upsell' },
      { id:'active', label:'Активный',   color:C.actC,   rx:.82, ry:.42, r:.10, scenario:'Бандл' },
      { id:'new',    label:'Новый',      color:C.newC,   rx:.22, ry:.22, r:.09, scenario:'Onboard' },
      { id:'sleep',  label:'Засыпающий', color:C.sleepC, rx:.18, ry:.62, r:.10, scenario:'Winback' },
      { id:'lost',   label:'Потерянный', color:C.lostC,  rx:.78, ry:.78, r:.09, scenario:'Reactivation' }
    ].map(function(s){
      return Object.assign(s, {
        x: s.rx * W,
        y: s.ry * H,
        rad: s.r * Math.min(W, H)
      });
    });
    massX = W * 0.5;
    massY = H * 0.48;
    aiX = W * 0.5;
    aiY = H * 0.38;
    if (particles.length === 0) spawnParticles();
  }

  function spawnParticles(){
    particles = [];
    for (var i = 0; i < 48; i++){
      var seg = SEGMENTS[i % SEGMENTS.length];
      particles.push({
        seg: seg.id,
        phase: (i / 48) * 180 + Math.random() * 40,
        speed: 0.35 + Math.random() * 0.25,
        size: 2.5 + Math.random() * 2,
        jitter: Math.random() * Math.PI * 2
      });
    }
  }

  function lerp(a, b, k){ return a + (b - a) * k; }

  function easeOutCubic(x){ return 1 - Math.pow(1 - x, 3); }

  function drawRoundRect(x, y, w, h, r, fill, stroke){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else { ctx.moveTo(x+r,y); ctx.arcTo(x+w,y,x+w,y+h,r); ctx.arcTo(x+w,y+h,x,y+h,r); ctx.arcTo(x,y+h,x,y,r); ctx.arcTo(x,y,x+w,y,r); }
    if (fill){ ctx.fillStyle = fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function drawGrid(){
    ctx.strokeStyle = C.grid;
    ctx.lineWidth = 1;
    var step = Math.max(28, Math.min(W, H) / 14);
    for (var gx = step; gx < W; gx += step){
      ctx.beginPath(); ctx.moveTo(gx, 0); ctx.lineTo(gx, H); ctx.stroke();
    }
    for (var gy = step; gy < H; gy += step){
      ctx.beginPath(); ctx.moveTo(0, gy); ctx.lineTo(W, gy); ctx.stroke();
    }
  }

  function drawMassBroadcast(){
    var pulse = 0.5 + 0.5 * Math.sin(fr * 0.04);
    var bw = Math.min(120, W * 0.22);
    var bh = 36;
    var bx = massX - bw/2;
    var by = massY - bh/2 - 8;

    drawRoundRect(bx, by, bw, bh, 8, 'rgba(148,163,184,.18)', C.mass);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold ' + Math.max(10, W * 0.024) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('Одна рассылка', massX, by + bh * 0.62);

    ctx.strokeStyle = 'rgba(148,163,184,.35)';
    ctx.lineWidth = 2;
    ctx.setLineDash([6, 6]);
    ctx.beginPath();
    ctx.moveTo(massX, by + bh);
    ctx.lineTo(aiX, aiY - 28);
    ctx.stroke();
    ctx.setLineDash([]);
  }

  function drawAIHub(){
    var r = Math.min(34, W * 0.055) + Math.sin(fr * 0.06) * 2;
    var grd = ctx.createRadialGradient(aiX, aiY, 4, aiX, aiY, r + 20);
    grd.addColorStop(0, C.aiGlow);
    grd.addColorStop(1, 'rgba(13,148,136,0)');
    ctx.fillStyle = grd;
    ctx.beginPath();
    ctx.arc(aiX, aiY, r + 18, 0, Math.PI * 2);
    ctx.fill();

    ctx.fillStyle = C.ai;
    ctx.beginPath();
    ctx.arc(aiX, aiY, r, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = '#0f766e';
    ctx.lineWidth = 2;
    ctx.stroke();

    ctx.fillStyle = '#fff';
    ctx.font = 'bold ' + Math.max(9, W * 0.018) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI', aiX, aiY + 4);

    ctx.fillStyle = C.muted;
    ctx.font = Math.max(9, W * 0.016) + 'px system-ui,sans-serif';
    ctx.fillText('RFM + прогноз', aiX, aiY + r + 16);
  }

  function drawSegment(seg, highlight){
    var alpha = highlight ? 1 : 0.85;
    ctx.globalAlpha = alpha;
    var grd = ctx.createRadialGradient(seg.x, seg.y, 4, seg.x, seg.y, seg.rad);
    grd.addColorStop(0, seg.color + '33');
    grd.addColorStop(1, seg.color + '08');
    ctx.fillStyle = grd;
    ctx.beginPath();
    ctx.arc(seg.x, seg.y, seg.rad, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = seg.color;
    ctx.lineWidth = highlight ? 2.5 : 1.5;
    ctx.stroke();

    ctx.fillStyle = C.ink;
    ctx.font = 'bold ' + Math.max(10, W * 0.022) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(seg.label, seg.x, seg.y - 6);

    drawRoundRect(seg.x - 34, seg.y + 8, 68, 20, 10, seg.color + '22', seg.color);
    ctx.fillStyle = seg.color;
    ctx.font = Math.max(8, W * 0.016) + 'px system-ui,sans-serif';
    ctx.fillText(seg.scenario, seg.x, seg.y + 22);
    ctx.globalAlpha = 1;
  }

  function drawParticle(p){
    var cycle = 220;
    var local = (fr * p.speed + p.phase) % cycle;
    var seg = SEGMENTS.find(function(s){ return s.id === p.seg; });
    if (!seg) return;

    var x, y, alpha = 1;
    if (local < 50){
      var k = easeOutCubic(local / 50);
      x = lerp(massX + Math.sin(p.jitter + fr * 0.02) * 12, aiX, k);
      y = lerp(massY + Math.cos(p.jitter + fr * 0.02) * 8, aiY, k);
    } else if (local < 90){
      var k2 = easeOutCubic((local - 50) / 40);
      x = lerp(aiX, seg.x, k2);
      y = lerp(aiY, seg.y, k2);
    } else {
      var orbit = (local - 90) * 0.04 + p.jitter;
      x = seg.x + Math.cos(orbit) * (seg.rad * 0.45);
      y = seg.y + Math.sin(orbit) * (seg.rad * 0.35);
      if (local > 200) alpha = 1 - (local - 200) / 20;
    }

    ctx.globalAlpha = Math.max(0, alpha);
    ctx.fillStyle = seg.color;
    ctx.beginPath();
    ctx.arc(x, y, p.size, 0, Math.PI * 2);
    ctx.fill();
    ctx.globalAlpha = 1;
  }

  function drawFlowLines(){
    SEGMENTS.forEach(function(seg, i){
      var phase = (fr * 0.02 + i * 0.4) % 1;
      ctx.strokeStyle = seg.color + '44';
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.moveTo(aiX, aiY);
      ctx.lineTo(seg.x, seg.y);
      ctx.stroke();

      var px = lerp(aiX, seg.x, phase);
      var py = lerp(aiY, seg.y, phase);
      ctx.fillStyle = seg.color;
      ctx.beginPath();
      ctx.arc(px, py, 3, 0, Math.PI * 2);
      ctx.fill();
    });
  }

  function drawLegend(){
    var lx = 12, ly = H - 28;
    ctx.fillStyle = 'rgba(255,255,255,.75)';
    drawRoundRect(lx, ly, Math.min(200, W - 24), 22, 6, 'rgba(255,255,255,.75)', 'rgba(15,23,42,.08)');
    ctx.fillStyle = C.muted;
    ctx.font = Math.max(9, W * 0.017) + 'px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Клиенты → AI-кластер → персональный сценарий', lx + 10, ly + 14);
  }

  function frame(){
    fr++;
    ctx.clearRect(0, 0, W, H);
    drawGrid();
    drawMassBroadcast();
    drawFlowLines();
    drawAIHub();
    var hi = Math.floor(fr / 90) % SEGMENTS.length;
    SEGMENTS.forEach(function(seg, i){ drawSegment(seg, i === hi); });
    particles.forEach(drawParticle);
    drawLegend();
    requestAnimationFrame(frame);
  }

  resize();
  requestAnimationFrame(frame);
})();
</script>
</section>


  <section class="aseg-section" id="kak-rabotaet">
    <div class="aseg-cnt">
      <div class="aseg-sh nero-ai-reveal">
        <span class="aseg-eyebrow">Механика</span>
        <h2>Как AI делит клиентов на сегменты и предлагает сценарии касаний</h2>
        <p><strong>Коротко:</strong> данные → RFM и поведение → AI обогащает прогноз и текст → триггер запускает сценарий только для сегмента → метрики возвращаются в CRM.</p>
      </div>
      <div class="aseg-card nero-ai-reveal">
        <h3>Типовые сегменты для e-commerce, услуг, образования и подписок</h3>
        <div class="aseg-table-wrap">
          <table class="aseg-table">
            <thead><tr><th>Сегмент</th><th>E-commerce</th><th>Услуги</th><th>Образование</th><th>Подписки</th></tr></thead>
            <tbody>
              <tr><td>Новый</td><td>1 заказ, onboarding</td><td>Первичная заявка</td><td>Пробный курс</td><td>Trial / первый месяц</td></tr>
              <tr><td>Активный</td><td>2–3 заказа</td><td>Регулярные визиты</td><td>Проходит модуль</td><td>Автопродление</td></tr>
              <tr><td>VIP</td><td>Высокий M, частый F</td><td>Долгий LTV</td><td>Доп. курсы</td><td>Годовой план</td></tr>
              <tr><td>Засыпающий</td><td>R растёт, F падает</td><td>Нет визитов N дней</td><td>Не открывает уроки</td><td>Не заходит в продукт</td></tr>
              <tr><td>Потерянный</td><td>R &gt; 90–180 дней</td><td>Контракт закончился</td><td>Не завершил курс</td><td>Отмена автопродления</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:16px;">EKONIKA (Mindbox): <strong>19 параметров</strong> → <strong>132 микросегмента</strong>; выручка на получателя выросла <strong>в 6 раз</strong>. Ceremonia (Retentics): replenishment-flow дал <strong>12,2×</strong> выручки vs стандартная модель.</p>
      </div>
      <div class="aseg-card nero-ai-reveal nero-ai-delay-1" style="margin-top:24px;">
        <h3>Персональные сценарии вместо «одной рассылки на всех»</h3>
        <ul>
          <li><strong>Reactivation</strong> — засыпающие 60–90+ дней без покупки.</li>
          <li><strong>Upsell VIP</strong> — персональный бандл без скидки для «чемпионов».</li>
          <li><strong>Winback</strong> — индивидуальное время и размер скидки.</li>
          <li><strong>Replenishment</strong> — AI-прогноз расхода SKU (L'Occitane + Replenit: <strong>+235%</strong> post-purchase revenue).</li>
          <li><strong>Onboarding</strong> — серия касаний по продукту.</li>
          <li><strong>Задача менеджеру</strong> — Bitrix24 «Повторные продажи с AI».</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="aseg-section aseg-section-alt" id="crm">
    <div class="aseg-cnt">
      <div class="aseg-sh nero-ai-reveal">
        <span class="aseg-eyebrow">Интеграции</span>
        <h2>AI-сегментация в CRM: amoCRM, Битрикс24, RetailCRM, Mindbox</h2>
        <p>Ключевой запрос: <strong>ai сегментация клиентов интеграция crm</strong> без замены уже работающей системы.</p>
      </div>
      <div class="aseg-card nero-ai-reveal">
        <h3>Что передаётся между AI и CRM</h3>
        <div class="aseg-table-wrap">
          <table class="aseg-table">
            <thead><tr><th>Направление</th><th>Примеры данных</th></tr></thead>
            <tbody>
              <tr><td>CRM → AI</td><td>Заказы, контакты, теги, этапы, визиты, корзина</td></tr>
              <tr><td>AI → CRM</td><td>Поле «сегмент», churn-score, next-best-action, тексты офферов</td></tr>
              <tr><td>Триггеры</td><td>Вход в сегмент → задача, email, Salesbot, webhook</td></tr>
              <tr><td>Аналитика</td><td>Open/click, repeat purchase, LTV по сегментам</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="aseg-card nero-ai-reveal nero-ai-delay-1" style="margin-top:24px;">
        <h3>Сравнительная матрица платформ</h3>
        <div class="aseg-table-wrap">
          <table class="aseg-table">
            <thead><tr><th>Платформа</th><th>Сильная сторона</th><th>Доп. слой Nero Network</th></tr></thead>
            <tbody>
              <tr><td><strong>amoCRM</strong></td><td>Динамические сегменты, триггеры, AI-агент</td><td>RFM-поле, Make/n8n, LLM-тексты</td></tr>
              <tr><td><strong>Битрикс24</strong></td><td>BitrixGPT, автосделки</td><td>Кастомные сегменты, каскады</td></tr>
              <tr><td><strong>RetailCRM</strong></td><td>Динамическая сегментация e-commerce</td><td>ML next-purchase, replenishment</td></tr>
              <tr><td><strong>Mindbox</strong></td><td>CDP, ML-микросегменты</td><td>Стратегия сегментов, пилоты</td></tr>
              <tr><td><strong>Sendsay</strong></td><td>CDP + AI-персонализация</td><td>50 вариантов в одном письме</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="aseg-card nero-ai-reveal nero-ai-delay-2" style="margin-top:24px;" id="crm-nocode">
        <h3>AI-сегментация клиентов без программиста (no-code + AI)</h3>
        <p>Путь для SMB: <strong>Make / n8n</strong> + кастомное поле сегмента в amoCRM или Битрикс24.</p>
        <ol style="padding-left:20px;color:var(--aseg-muted);line-height:1.7;">
          <li>Выгрузка транзакций (или webhook заказа).</li>
          <li>Расчёт R/F/M в сценарии no-code.</li>
          <li>Запись тега или поля «AI-сегмент» в CRM.</li>
          <li>Нативные триггеры CRM запускают рассылку или задачу.</li>
          <li>LLM генерирует текст письма по шаблону сегмента.</li>
        </ol>
        <p>Медиана роста повторных продаж <strong>15–30% за квартал</strong> — ориентир при дисциплине метрик, не гарантия.</p>
      </div>

<?php if ( $secondary_cta_url !== '' ) : ?>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите запустить no-code пилот сами?</p>
          <p class="ym-cta-block__sub">Если команда хочет разобраться в Make/n8n, промпты и human-in-the-loop до внедрения сегментации — посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer">обучение по внедрению AI в бизнес-процессы</a>. Это ускоряет запуск пилотов reactivation и VIP-upsell.</p>
        </div>
      </aside>
<?php endif; ?>

    </div>
  </section>

  <section class="aseg-section" id="etapy">
    <div class="aseg-cnt">
      <div class="aseg-sh nero-ai-reveal">
        <span class="aseg-eyebrow">Под ключ</span>
        <h2>Внедрение AI-сегментации под ключ: этапы, сроки, результат</h2>
        <p><strong>Внедрение ai сегментация клиентов</strong> в модели Nero Network — проект с чеком <strong>150–450 тыс. ₽</strong>.</p>
      </div>
      <div class="aseg-timeline nero-ai-reveal">
        <div class="aseg-tl-item">
          <div class="aseg-tl-dot"></div>
          <h3>Аудит базы и карта сегментов (лид-магнит)</h3>
          <p>Выгрузка 6–12 месяцев транзакций, расчёт RFM, визуализация 5–11 сегментов. Уникальный угол: <strong>«Карта сегментов за 48 часов»</strong> на чистых данных.</p>
        </div>
        <div class="aseg-tl-item">
          <div class="aseg-tl-dot"></div>
          <h3>Настройка сегментов и запуск персональных касаний</h3>
          <p>1–2 пилотных сценария, динамические сегменты, AI-слой для текстов, оркестрация касаний, human-in-the-loop. Срок пилота: <strong>2–6 недель</strong> после аудита.</p>
        </div>
        <div class="aseg-tl-item">
          <div class="aseg-tl-dot"></div>
          <h3>Метрики до/после</h3>
          <p>Open/click по сегментам, repeat purchase rate, LTV, конверсия пилота vs массовая рассылка. Референсы: «Улыбка радуги» — конверсии до <strong>25%</strong>; Ionio MicroSegments — кампании за <strong>&lt;45 мин</strong>.</p>
        </div>
      </div>
    </div>
  </section>

  <div class="aseg-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
      <div class="ym-cta-block__icon" aria-hidden="true">🎯</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получить Карту сегментов базы — бесплатно</p>
        <p class="ym-cta-block__sub">Выгрузим 6–12 месяцев транзакций, разложим базу на 5–11 сегментов RFM и покажем, сколько повторных продаж «спит» в засыпающих и VIP без точных касаний. Карта сегментов — за 48 часов на чистых данных.</p>
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>
  </div>

  <section class="aseg-section aseg-section-alt" id="ceny">
    <div class="aseg-cnt">
      <div class="aseg-sh nero-ai-reveal">
        <span class="aseg-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI-сегментация клиентов</h2>
        <p>Запрос <strong>ai сегментация клиентов цена</strong> — с честной вилкой без скрытых доплат.</p>
      </div>
      <div class="aseg-card nero-ai-reveal">
        <h3>Из чего складывается стоимость</h3>
        <div class="aseg-table-wrap">
          <table class="aseg-table">
            <thead><tr><th>Фактор</th><th>Влияние на чек</th></tr></thead>
            <tbody>
              <tr><td>Объём и качество базы</td><td>Выгрузки, очистка дублей, 152-ФЗ</td></tr>
              <tr><td>CRM / CDP</td><td>amoCRM+no-code vs Mindbox enterprise</td></tr>
              <tr><td>Число сценариев и каналов</td><td>1 пилот vs 5+ каскадов</td></tr>
              <tr><td>ML-прогнозы</td><td>Нужны данные и сопровождение модели</td></tr>
              <tr><td>Интеграции</td><td>Сайт, мессенджеры, BI</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="aseg-pricing-grid nero-ai-reveal nero-ai-delay-1" style="margin-top:28px;">
        <div class="aseg-price-card">
          <div class="tier">Старт</div>
          <div class="amount">150–250 тыс. ₽</div>
          <div class="inc">Аудит + карта сегментов + 1 пилотный сценарий (no-code + CRM)</div>
        </div>
        <div class="aseg-price-card aseg-featured">
          <div class="tier">Расширенный</div>
          <div class="amount">250–450 тыс. ₽</div>
          <div class="inc">Несколько сценариев, ML-слой, дашборд, интеграции с сайтом и мессенджерами</div>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;">Окупаемость считают через <strong>reactivation и LTV</strong>, не через новый трафик. Формат <strong>двух пилотов, не big bang</strong> снижает риск.</p>
    </div>
  </section>

  <div class="aseg-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте бюджет под вашу базу</p>
        <p class="ym-cta-block__sub">Ориентир 150–450 тыс. ₽ за внедрение под ключ. На аудите «Найти повторные продажи» дадим оценку сроков, CRM-совместимости и потенциала reactivation — бесплатно.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        </div>
      </div>
    </div>
  </div>

  <section class="aseg-section" id="keisy">
    <div class="aseg-cnt">
      <div class="aseg-sh nero-ai-reveal">
        <span class="aseg-eyebrow">E-E-A-T</span>
        <h2>Кейсы и примеры внедрения AI-сегментации</h2>
        <p>Верифицируемые источники, без «+393% всем».</p>
      </div>
      <div class="aseg-case-grid">
        <div class="aseg-case-card nero-ai-reveal">
          <div class="aseg-case-tag">E-commerce</div>
          <h3>EKONIKA / Mindbox</h3>
          <div class="aseg-metrics"><div class="aseg-metric"><span class="num">×6</span><span class="lbl">выручка на получателя vs ручные рассылки</span></div></div>
        </div>
        <div class="aseg-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="aseg-case-tag">Replenishment</div>
          <h3>L'Occitane / Replenit</h3>
          <div class="aseg-metrics"><div class="aseg-metric"><span class="num">+235%</span><span class="lbl">post-purchase revenue без скидок</span></div></div>
        </div>
        <div class="aseg-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="aseg-case-tag">Микросегменты</div>
          <h3>Ceremonia / Retentics</h3>
          <div class="aseg-metrics"><div class="aseg-metric"><span class="num">12,2×</span><span class="lbl">replenishment-flow vs стандарт</span></div></div>
        </div>
        <div class="aseg-case-card nero-ai-reveal">
          <div class="aseg-case-tag">Услуги</div>
          <h3>«Акушерство» / Mindbox</h3>
          <div class="aseg-metrics"><div class="aseg-metric"><span class="num">16,2%</span><span class="lbl">CRM-канал выручки (было 8,7%)</span></div></div>
        </div>
        <div class="aseg-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="aseg-case-tag">SMB</div>
          <h3>amoCRM + Make/n8n</h3>
          <div class="aseg-metrics"><div class="aseg-metric"><span class="num">15–30%</span><span class="lbl">рост repeat за квартал (ориентир RFM)</span></div></div>
        </div>
        <div class="aseg-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="aseg-case-tag">Winback</div>
          <h3>Weezie Towels + Monocle</h3>
          <div class="aseg-metrics"><div class="aseg-metric"><span class="num">+51%</span><span class="lbl">CVR winback-flow</span></div></div>
        </div>
      </div>
    </div>
  </section>

  <section class="aseg-section aseg-section-alt" id="faq">
    <div class="aseg-cnt">
      <div class="aseg-sh nero-ai-reveal">
        <span class="aseg-eyebrow">FAQ</span>
        <h2>Ответы на частые вопросы</h2>
      </div>
      <div class="aseg-faq nero-ai-reveal">
        <div class="aseg-faq-item"><div class="aseg-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI-сегментацию клиентов?</div><div class="aseg-faq-a">Аудит CRM → карта сегментов → 1–2 пилотных сценария → настройка триггеров → AI-слой → запуск и A/B.</div></div>
        <div class="aseg-faq-item"><div class="aseg-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает внедрение?</div><div class="aseg-faq-a">Карта сегментов — <strong>2–5 рабочих дней</strong>. Пилот — <strong>2–6 недель</strong> после аудита.</div></div>
        <div class="aseg-faq-item"><div class="aseg-faq-q" tabindex="0" role="button" aria-expanded="false">Нужны ли программисты?</div><div class="aseg-faq-a">Для пилота — не обязательно: динамические сегменты amoCRM, Bitrix24, RetailCRM, Make/n8n.</div></div>
        <div class="aseg-faq-item"><div class="aseg-faq-q" tabindex="0" role="button" aria-expanded="false">Какие CRM поддерживаются?</div><div class="aseg-faq-a">amoCRM, Битрикс24, RetailCRM, Mindbox, Sendsay, Unisender CDP — типовой стек.</div></div>
        <div class="aseg-faq-item"><div class="aseg-faq-q" tabindex="0" role="button" aria-expanded="false">Как измерить эффект?</div><div class="aseg-faq-a">Open/click по сегментам, repeat purchase rate, доля выручки CRM-канала, LTV VIP vs засыпающие.</div></div>
        <div class="aseg-faq-item"><div class="aseg-faq-q" tabindex="0" role="button" aria-expanded="false">У нас мало данных — можно начать?</div><div class="aseg-faq-a">RFM от <strong>50–100 заказов</strong>. ML-прогнозы — при <strong>500+</strong> заказов.</div></div>
        <div class="aseg-faq-item"><div class="aseg-faq-q" tabindex="0" role="button" aria-expanded="false">AI придумает неуместные офферы?</div><div class="aseg-faq-a">Human-in-the-loop: шаблоны, модерация текстов, лимиты скидок, запрет демпинга для VIP.</div></div>
        <div class="aseg-faq-item"><div class="aseg-faq-q" tabindex="0" role="button" aria-expanded="false">Это же общее внедрение AI в бизнес?</div><div class="aseg-faq-a">Фокус страницы — <strong>сегментация базы</strong> и <strong>повторные продажи</strong>, не общая автоматизация процессов.</div></div>
        <div class="aseg-faq-item"><div class="aseg-faq-q" tabindex="0" role="button" aria-expanded="false">Юридически: можно слать всем из базы?</div><div class="aseg-faq-a">Нужны согласия (<strong>152-ФЗ</strong>). AI помогает не слать нерелевантно, а не без разрешения.</div></div>
      </div>
    </div>
  </section>

  <section class="aseg-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="aseg-cnt" style="text-align:center;">
      <span class="aseg-eyebrow">Первый шаг бесплатно</span>
      <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px;">Найти повторные продажи в вашей базе</h2>
      <p style="max-width:580px;margin:0 auto 28px;font-size:16px;">AI-сегментация переводит CRM из режима «одна рассылка на всех» в персональные сценарии касаний. Начните с карты сегментов и двух пилотов.</p>
      <ul class="aseg-cta-checklist">
        <li>Аудит за 2–5 дней</li>
        <li>Карта 5–11 сегментов</li>
        <li>Метрики до/после</li>
        <li>Без обязательств</li>
      </ul>
      <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
    </div>
  </section>


<?php if ( $ad_banner_url !== '' && $ad_banner_image !== '' ) : ?>
  <div class="aseg-partner-banner" style="text-align:center;padding:24px 0 8px;">
    <a href="<?php echo esc_url( $ad_banner_url ); ?>" target="_blank" rel="noopener noreferrer">
      <img src="<?php echo esc_url( $ad_banner_image ); ?>" width="970" height="90" alt="<?php echo esc_attr( $ad_banner_alt ); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;box-shadow:var(--aseg-shadow-sm,0 8px 28px rgba(0,0,0,.25));">
    </a>
  </div>
<?php endif; ?>

</div><!-- /.aseg-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.aseg-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aseg-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aseg-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aseg-faq-q');
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
  var root = document.querySelector('.aseg-content');
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

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

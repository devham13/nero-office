<?php
/**
 * Template Name: AI для интернет-магазина: внедрение поиска, рекомендаций и поддержки под ключ
 * Description: Внедрим AI для интернет-магазина: умный поиск, рекомендации, описания карточек и поддержка 24/7.
 */

$page_seo_title       = 'AI для интернет-магазина: внедрение поиска и поддержки под ключ';
$page_seo_description = 'Внедрим AI для интернет-магазина: умный поиск, рекомендации, описания карточек и поддержка 24/7. Интеграция с CRM и маркетплейсами. Аудит и расчёт под ваш каталог.';

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
    ['label' => 'Зачем AI', 'href' => '#zachem-ai-2026'],
    ['label' => 'Проблемы', 'href' => '#problemy'],
    ['label' => 'Поиск', 'href' => '#poisk-rekomendacii'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
    ['label' => 'Заказать', 'href' => '#cta'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Увеличить конверсию магазина';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение по AI';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#vnedrenie';

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
/* AIM ECOM HERO */
/* ===== AIM ECOM HERO — self-contained dark shell ===== */
.aim-ecom-hero {
  --aim-bg: #050711;
  --aim-bg2: #080b17;
  --aim-text: #e6edf7;
  --aim-soft: #c7d2e5;
  --aim-muted: #9aa8bd;
  --aim-accent: #79f2ff;
  --aim-violet: #8b5cf6;
  --aim-green: #22c55e;
  --aim-border: rgba(255,255,255,.10);
  --aim-shadow: 0 24px 72px rgba(0,0,0,.42);
  --aim-container: min(1220px, calc(100% - 40px));
  position: relative;
  isolation: isolate;
  font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}
.aim-ecom-hero *, .aim-ecom-hero *::before, .aim-ecom-hero *::after { box-sizing: border-box; }

.aim-ecom-hero.nero-ai-hero {
  min-height: min(920px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(88px, 11vw, 132px) 0 clamp(48px, 7vw, 80px);
  background:
    radial-gradient(ellipse 70% 55% at 72% 18%, rgba(121,242,255,.14), transparent 62%),
    radial-gradient(ellipse 55% 45% at 8% 82%, rgba(139,92,246,.12), transparent 58%),
    linear-gradient(180deg, var(--aim-bg) 0%, var(--aim-bg2) 100%);
}
.aim-ecom-hero.nero-ai-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: 0;
}
.aim-ecom-hero .nero-ai-container {
  width: var(--aim-container);
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aim-ecom-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(340px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aim-ecom-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 6px 14px;
  border-radius: 999px;
  background: rgba(121,242,255,.08);
  border: 1px solid rgba(121,242,255,.22);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--aim-accent);
}
.aim-ecom-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 6.2vw, 78px);
  line-height: .92;
  letter-spacing: -.065em;
  font-weight: 800;
  color: #fff;
}
.aim-ecom-hero .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #fff 0%, var(--aim-accent) 42%, var(--aim-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aim-ecom-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 700px;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
  color: var(--aim-soft) !important;
}
.aim-ecom-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aim-ecom-hero .nero-ai-badge {
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
.aim-ecom-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 32px;
}
.aim-ecom-hero .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 24px;
  border-radius: 14px;
  font-size: 15px;
  font-weight: 700;
  text-decoration: none;
  transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease, background .2s ease;
}
.aim-ecom-hero .nero-ai-btn-primary {
  color: #fff !important;
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  box-shadow: 0 12px 36px rgba(37,99,235,.32);
  border: 1px solid rgba(255,255,255,.08);
}
.aim-ecom-hero .nero-ai-btn-primary:hover { transform: translateY(-2px); }
.aim-ecom-hero .nero-ai-btn-secondary {
  color: var(--aim-text) !important;
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.14);
}
.aim-ecom-hero .nero-ai-btn-secondary:hover {
  border-color: rgba(121,242,255,.36);
  background: rgba(121,242,255,.08);
}

/* Dashboard */
.aim-ecom-hero .nero-ai-dashboard {
  position: relative;
  padding: 16px;
  border-radius: 30px;
  background: rgba(2,6,23,.44);
  border: 1px solid rgba(255,255,255,.10);
  box-shadow: var(--aim-shadow);
  transform: perspective(1100px) rotateY(-2.5deg) rotateX(1.5deg);
}
.aim-ecom-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 22px;
  background: linear-gradient(180deg, rgba(15,23,42,.96), rgba(6,10,24,.98));
}
.aim-ecom-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 12px 14px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.aim-ecom-hero .nero-ai-dots { display: flex; gap: 6px; }
.aim-ecom-hero .nero-ai-dot { width: 9px; height: 9px; border-radius: 50%; }
.aim-ecom-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aim-ecom-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aim-ecom-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.aim-ecom-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aim-ecom-hero .nero-ai-window-body { padding: 16px; }
.aim-ecom-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.aim-ecom-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -.03em;
  color: #f8fafc;
}
.aim-ecom-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
}
.aim-ecom-hero .nero-ai-live-pill::before {
  content: "";
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--aim-green);
  box-shadow: 0 0 0 5px rgba(34,197,94,.14);
  animation: aimEcomPulse 1.6s infinite;
}
@keyframes aimEcomPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aim-ecom-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
}
.aim-ecom-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.05);
}
.aim-ecom-hero .nero-ai-metric span {
  display: block;
  color: var(--aim-muted);
  font-size: 11px;
  font-weight: 700;
}
.aim-ecom-hero .nero-ai-metric strong {
  display: block;
  margin-top: 6px;
  color: #fff;
  font-size: 20px;
  line-height: 1;
}
.aim-ecom-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aim-ecom-hero .nero-ai-metric--green strong { color: var(--aim-green); }
.aim-ecom-hero .nero-ai-metric--cyan strong { color: var(--aim-accent); }

.aim-ecom-hero .aim-ecom-canvas-wrap {
  margin-top: 12px;
  height: 128px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: radial-gradient(circle at 50% 40%, rgba(121,242,255,.08), rgba(2,6,23,.2) 70%);
  overflow: hidden;
}
.aim-ecom-hero #aim-ecom-hero-canvas {
  display: block;
  width: 100%;
  height: 128px;
}

.aim-ecom-hero .nero-ai-task-stream {
  margin-top: 12px;
  display: grid;
  gap: 8px;
}
.aim-ecom-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 32px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aim-ecom-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 32px;
  height: 32px;
  border-radius: 10px;
  background: rgba(121,242,255,.12);
  color: var(--aim-accent);
  font-size: 10px;
  font-weight: 800;
  letter-spacing: .04em;
}
.aim-ecom-hero .nero-ai-task-icon--violet { background: rgba(139,92,246,.14); color: #c4b5fd; }
.aim-ecom-hero .nero-ai-task-icon--green { background: rgba(34,197,94,.12); color: #86efac; }
.aim-ecom-hero .nero-ai-task-icon--amber { background: rgba(251,191,36,.12); color: #fde68a; }
.aim-ecom-hero .nero-ai-task strong { display: block; color: #f8fafc; font-size: 12px; }
.aim-ecom-hero .nero-ai-task span { color: var(--aim-muted); font-size: 11px; }
.aim-ecom-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aim-ecom-hero .nero-ai-status--live {
  background: rgba(121,242,255,.12);
  color: #bae6fd;
}

/* Intro KPI strip (второй экран) */
.aim-ecom-intro {
  --aim-bg: #050711;
  --aim-bg2: #080b17;
  --aim-text: #e6edf7;
  --aim-soft: #c7d2e5;
  --aim-muted: #9aa8bd;
  --aim-accent: #79f2ff;
  --aim-violet: #8b5cf6;
  --aim-container: min(1220px, calc(100% - 40px));
  padding: clamp(40px, 5vw, 72px) 0 clamp(40px, 5vw, 64px);
  background: linear-gradient(180deg, rgba(255,255,255,.03), transparent);
  border-bottom: 1px solid rgba(255,255,255,.06);
  font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}
.aim-ecom-intro .nero-ai-container { width: var(--aim-container); margin: 0 auto; }
.aim-ecom-intro-grid {
  display: grid;
  grid-template-columns: 1fr 360px;
  gap: clamp(32px, 5vw, 56px);
  align-items: center;
}
.aim-ecom-intro-text {
  position: relative;
  padding-left: 20px;
}
.aim-ecom-intro-text::before {
  content: '';
  position: absolute;
  left: 0;
  top: 4px;
  bottom: 4px;
  width: 3px;
  border-radius: 2px;
  background: linear-gradient(180deg, var(--aim-accent), var(--aim-violet));
}
.aim-ecom-intro-text .nero-ai-eyebrow { margin-bottom: 12px; }
.aim-ecom-intro-text p {
  margin: 0 0 1em;
  font-size: clamp(14.5px, 1.55vw, 16.5px);
  line-height: 1.78;
  color: var(--aim-muted);
  text-align: left;
}
.aim-ecom-intro-text p:last-child { margin-bottom: 0; color: var(--aim-soft); }
.aim-ecom-intro-text strong { color: var(--aim-soft); }
.aim-ecom-intro-kpi {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}
.aim-ecom-kpi-card {
  padding: 16px 14px;
  text-align: center;
  border-radius: 14px;
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.10);
  box-shadow: 0 8px 28px rgba(0,0,0,.25);
  backdrop-filter: blur(12px);
}
.aim-ecom-kpi-card .kv {
  font-size: clamp(20px, 2.5vw, 26px);
  font-weight: 900;
  color: #fff;
  letter-spacing: -.04em;
  line-height: 1;
  margin-bottom: 5px;
}
.aim-ecom-kpi-card .kv--cyan { color: var(--aim-accent); }
.aim-ecom-kpi-card .kv--green { color: #22c55e; }
.aim-ecom-kpi-card .kl {
  font-size: 11px;
  font-weight: 600;
  color: var(--aim-muted);
  line-height: 1.4;
}
.aim-ecom-kpi-card .ks {
  font-size: 10px;
  color: #64748b;
  margin-top: 4px;
}

@media (max-width: 960px) {
  .aim-ecom-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aim-ecom-hero .nero-ai-dashboard { transform: none; order: -1; }
  .aim-ecom-intro-grid { grid-template-columns: 1fr; }
  .aim-ecom-intro-kpi { grid-template-columns: repeat(4, 1fr); }
}
@media (max-width: 640px) {
  .aim-ecom-intro-kpi { grid-template-columns: 1fr 1fr; }
  .aim-ecom-hero .nero-ai-hero-copy h1 { font-size: clamp(32px, 9vw, 44px); }
}
.ym-cta-block--primary{
  background:linear-gradient(135deg,rgba(121,242,255,.14),rgba(139,92,246,.12));
  border-color:rgba(121,242,255,.35);
}
.ym-cta-block--secondary{
  background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;
}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-link--accent{color:var(--vna-accent)!important;text-decoration:underline!important;}
.vna-def{
  margin:24px 0;padding:20px 24px;border-left:3px solid var(--vna-accent);
  background:rgba(121,242,255,.06);border-radius:0 12px 12px 0;
}
.vna-def em{color:var(--vna-soft);font-style:normal;font-weight:600;}
.aim-ecom-intro .kv--cyan{color:#79f2ff;}
.aim-ecom-intro .kv--green{color:#22c55e;}

</style>

<main id="primary" class="site-main nero-ai-home-page aim-ecom-page" role="main" tabindex="-1">

<!-- HERO -->
<section class="nero-ai-hero aim-ecom-hero" id="hero" aria-labelledby="hero-ecom-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai e-commerce</p>
      <h1 id="hero-ecom-title">AI для интернет-магазина: <span class="nero-ai-gradient-text">внедрение поиска, рекомендаций и поддержки под ключ</span></h1>
      <p class="nero-ai-hero-lead">Умный поиск, персонализация и AI-поддержка снимают нагрузку с менеджеров и поднимают конверсию — внедрим под ваш каталог, CRM и маркетплейсы</p>
      <ul class="nero-ai-badges" aria-label="Ключевые модули AI">
        <li class="nero-ai-badge">Умный поиск</li>
        <li class="nero-ai-badge">Рекомендации</li>
        <li class="nero-ai-badge">Карточки AI</li>
        <li class="nero-ai-badge">Поддержка 24/7</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#vnedrenie">Как внедряем</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо: AI-контур e-commerce">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">E-commerce · AI-контур</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Омниканальный торговый узел</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--green">
              <span>Zero-result</span>
              <strong>8%→2%</strong>
              <small>семантический поиск</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--cyan">
              <span>Ответ</span>
              <strong>30 сек</strong>
              <small>первый в чате</small>
            </div>
            <div class="nero-ai-metric">
              <span>Поиск CVR</span>
              <strong>+24%</strong>
              <small>после пилота</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--green">
              <span>Тикеты AI</span>
              <strong>60%</strong>
              <small>без оператора</small>
            </div>
          </div>

          <div class="aim-ecom-canvas-wrap" aria-hidden="true">
            <canvas id="aim-ecom-hero-canvas" width="480" height="128"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Поток событий AI-контура">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">SRCH</span>
              <div><strong>Семантический запрос</strong><span>«чехол айфон 15 про матовый»</span></div>
              <span class="nero-ai-status nero-ai-status--live">match</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--violet">RCM</span>
              <div><strong>Рекомендация</strong><span>похожие SKU + комплект</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--green">CRM</span>
              <div><strong>Заказ в RetailCRM</strong><span>остатки из 1С · статус</span></div>
              <span class="nero-ai-status">новое</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--amber">BOT</span>
              <div><strong>Эскалация</strong><span>сложный возврат → оператор</span></div>
              <span class="nero-ai-status">handoff</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- INTRO KPI (второй экран) -->
<section class="aim-ecom-intro vna-intro" id="intro" aria-label="Почему AI для e-commerce сейчас">
  <div class="nero-ai-container">
    <div class="aim-ecom-intro-grid">
      <div class="aim-ecom-intro-text">
        <p class="nero-ai-eyebrow">Лонгрид · ai e-commerce</p>
        <p>Покупатель уже приходит из AI-поиска и мессенджеров — не только из рекламы. По данным Adobe (май 2026), AI-referred трафик на retail-сайты вырос на <strong>+138% год к году</strong>; конверсия таких сессий выше обычной на <strong>54%</strong>. В июне 2026 Meta вывела Business Agent Platform с действиями в Shopify и Zendesk — ритейл переходит от скриптовых ботов к агентам, которые <strong>совершают действия</strong>: подбирают товар, оформляют заказ, создают тикет.</p>
        <p>В России Ozon и Wildberries встроили генераторы карточек, но не закрывают связку <strong>сайт + CRM + Telegram/VK + 152-ФЗ</strong>. Nero Network внедряет AI для интернет-магазина под ключ: семантический поиск, рекомендации, контент и поддержка в одном контуре с вашим каталогом и маркетплейсами.</p>
      </div>
      <div class="aim-ecom-intro-kpi" aria-label="Ключевые показатели рынка">
        <div class="aim-ecom-kpi-card">
          <div class="kv kv--cyan">+138%</div>
          <div class="kl">AI-трафик на retail YoY</div>
          <div class="ks">Adobe, май 2026</div>
        </div>
        <div class="aim-ecom-kpi-card">
          <div class="kv">80%+</div>
          <div class="kl">ритейлеров пилотируют generative AI</div>
          <div class="ks">Presenc AI, 2026</div>
        </div>
        <div class="aim-ecom-kpi-card">
          <div class="kv kv--cyan">5–20%</div>
          <div class="kl">zero-result без умного поиска</div>
          <div class="ks">RBMsoft / Wizzy</div>
        </div>
        <div class="aim-ecom-kpi-card">
          <div class="kv kv--green">60%</div>
          <div class="kl">тикетов закрывает AI без человека</div>
          <div class="ks">CaseUp, GPTmag</div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="aim-ecom-content vna-content">

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#zachem-ai-2026">Зачем AI в 2026</a>
        <a href="#problemy">Проблемы</a>
        <a href="#poisk-rekomendacii">Поиск и рекомендации</a>
        <a href="#kartochki">Карточки товаров</a>
        <a href="#podderzhka">AI-поддержка</a>
        <a href="#vnedrenie">Внедрение под ключ</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#riski">Риски</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Заказать</a>
      </nav>
    </div>
  </div>

  <section class="vna-section" id="zachem-ai-2026">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Тренд 2026</span>
        <h2>Зачем интернет-магазину AI в 2026 году</h2>
        <p>Покупатель приходит из AI-поиска, мессенджеров и ассистентов — магазин без AI-контура теряет сегмент с высоким intent.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <p>E-commerce вышел на этап, когда покупатель приходит не только из Яндекса и рекламы, но и из AI-поиска, мессенджеров и ассистентов. По данным Adobe (май 2026), AI-referred трафик на retail-сайты вырос на <strong>138% год к году</strong>; с октября 2024 — более чем в <strong>14 раз</strong>. Конверсия таких сессий выше обычной на <strong>54%</strong> (Adobe), средний чек — на <strong>14%</strong> (Shopify, Q1 2026).</p>
        <p>Глобальный ритейл подтверждает тренд: по оценке Presenc AI (2026), <strong>более 80%</strong> ритейлеров уже пилотируют или внедряют generative AI. В июне 2026 Meta представила <strong>Business Agent Platform</strong> — enterprise-агентов с действиями в <strong>Shopify</strong>, <strong>Zendesk</strong>, Shopee и сотнях систем. Более <strong>1 млн</strong> бизнесов используют ранние версии; в WhatsApp, Messenger и Instagram ежедневно идёт свыше <strong>1 млрд</strong> тредов с компаниями.</p>
        <p>В России Ozon и Wildberries встроили генераторы описаний и визуала; <strong>37%</strong> селлеров WB и Ozon уже используют нейросети для контента (AI-Journal / Data Insight, 2025). Но встроенный AI площадки не закрывает связку <strong>сайт + CRM + мессенджеры + 152-ФЗ</strong> — здесь нужен интегратор, а не коробочный SaaS.</p>
        <div class="vna-def"><em>AI для интернет-магазина</em> — набор модулей под коммерческий результат: поиск по смыслу, рекомендации, карточки, поддержка и аналитика, связанные с каталогом и CRM.</div>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vna-card">
          <h3>Почему ритейл переходит на AI-агентов вместо ручной поддержки</h3>
          <p>Классический чат-бот отвечает по дереву решений. <strong>AI-агент</strong> понимает намерение, обращается к каталогу и CRM, выполняет действие и при необходимости передаёт диалог человеку с полным контекстом. По данным Presenc AI, <strong>96%</strong> брендов с conversational AI используют его для поддержки; среди внедривших <strong>93%</strong> вопросов решаются без оператора.</p>
        </div>
        <div class="vna-card">
          <h3>Какие задачи решает ai для интернет магазина</h3>
          <div class="vna-table-wrap">
            <table class="vna-table">
              <thead><tr><th>Задача</th><th>Что делает AI</th><th>Эффект</th></tr></thead>
              <tbody>
                <tr><td>Семантический поиск</td><td>Синонимы, опечатки, транслит</td><td>Меньше нулевых выдач</td></tr>
                <tr><td>Рекомендации</td><td>Похожие, комплекты, допродажи</td><td>Рост AOV</td></tr>
                <tr><td>Генерация карточек</td><td>SEO-тексты под площадку</td><td>Быстрый вывод SKU</td></tr>
                <tr><td>AI-поддержка</td><td>Ответы 24/7, статус заказа</td><td>Разгрузка саппорта</td></tr>
                <tr><td>Персонализация</td><td>Блоки витрины по сегментам</td><td>+5–15% revenue lift</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="problemy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Боли e-commerce</span>
        <h2>Проблемы, которые снимает внедрение AI</h2>
        <p>Внедрение AI в бизнес-процессы e-commerce начинается не с технологии, а с боли. Три типовые точки у D2C-брендов, розницы и маркетплейс-селлеров.</p>
      </div>

      <div class="vna-scenario nero-ai-reveal">
        <div class="vna-sc-icon" aria-hidden="true">🔍</div>
        <div>
          <h3>Покупатели не находят товар в каталоге</h3>
          <p>Стандартный поиск по точному совпадению даёт <strong>5–20%</strong> запросов с нулевой выдачей (RBMsoft, Wizzy, 2025–2026). У топ-магазинов цель — <strong>менее 2–3%</strong>. По Prefixbox Search Benchmark 2024, пользователи поиска генерируют <strong>в 2–6 раз</strong> больше выручки; <strong>16%</strong> шоперов дают около <strong>55%</strong> онлайн-выручки.</p>
        </div>
      </div>
      <div class="vna-scenario nero-ai-reveal nero-ai-delay-1">
        <div class="vna-sc-icon" aria-hidden="true">📦</div>
        <div>
          <h3>Слабые карточки и низкая конверсия</h3>
          <p>Шаблонные описания и разный текст на сайте и маркетплейсе снижают доверие. OzonGenerator (май 2025) — до <strong>50</strong> описаний в месяц, но только внутри площадки. Кастомный конвейер карточек (сайт + WB + Ozon + единый tone of voice) — конкурентное преимущество.</p>
        </div>
      </div>
      <div class="vna-scenario nero-ai-reveal nero-ai-delay-2">
        <div class="vna-sc-icon" aria-hidden="true">💬</div>
        <div>
          <h3>Перегруженная поддержка и потеря заказов</h3>
          <p>Кейс CaseUp (аксессуары, Екатеринбург): до внедрения AI-бота на YandexGPT + RetailCRM первый ответ — <strong>11–12 минут</strong>, <strong>0%</strong> тикетов без человека. После пилота: ответ — <strong>30 секунд</strong>, <strong>60%</strong> тикетов закрывает AI, CSAT вырос с <strong>3,8</strong> до <strong>4,5</strong>, окупаемость — <strong>4 месяца</strong> (GPTmag).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <section id="ai-dlya-internet-magazina-boris-block" class="becm-root" aria-label="Анимация: путь покупателя от поиска к рекомендациям и AI-поддержке в интернет-магазине">
<style>
/* === БОРИС: prefix becm-, scoped внутри #ai-dlya-internet-magazina-boris-block === */
#ai-dlya-internet-magazina-boris-block.becm-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-dlya-internet-magazina-boris-block .becm-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-dlya-internet-magazina-boris-block .becm-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-dlya-internet-magazina-boris-block .becm-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-dlya-internet-magazina-boris-block .becm-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-dlya-internet-magazina-boris-block .becm-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-dlya-internet-magazina-boris-block .becm-ey{
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
#ai-dlya-internet-magazina-boris-block .becm-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0891b2;
  border-radius:1px;
}
#ai-dlya-internet-magazina-boris-block .becm-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-dlya-internet-magazina-boris-block .becm-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-dlya-internet-magazina-boris-block .becm-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-dlya-internet-magazina-boris-block .becm-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(8,145,178,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0e7490;
  margin-top:1px;
  font-style:normal;
}
#ai-dlya-internet-magazina-boris-block .becm-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-dlya-internet-magazina-boris-block .becm-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-dlya-internet-magazina-boris-block .becm-pl-c{
  background:rgba(8,145,178,.08);
  color:#0e7490;
  border:1.5px solid rgba(8,145,178,.22);
}
#ai-dlya-internet-magazina-boris-block .becm-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-dlya-internet-magazina-boris-block .becm-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-dlya-internet-magazina-boris-block .becm-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-dlya-internet-magazina-boris-block .becm-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfeff 0%,#f0f9ff 28%,#faf5ff 72%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-dlya-internet-magazina-boris-block .becm-rgt{min-height:380px;}
}
#becm-shopper-journey-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="becm-cnt">
  <div class="becm-card">

    <div class="becm-lft">
      <span class="becm-ey">Путь покупателя</span>
      <h3 class="becm-h3">От «ничего не нашёл» к корзине: семантический поиск, рекомендации и чат 24/7</h3>
      <ul class="becm-ul">
        <li><span class="becm-ic">🔍</span>Покупатель вводит запрос на русском — AI понимает синонимы, опечатки и транслит</li>
        <li><span class="becm-ic">✦</span>Семантика подсвечивает релевантные SKU вместо пустой выдачи (zero-result ↓)</li>
        <li><span class="becm-ic">＋</span>Блок рекомендаций поднимает средний чек: похожие товары и комплекты</li>
        <li><span class="becm-ic">💬</span>Сложный вопрос — handoff в поддержку с контекстом заказа из CRM</li>
      </ul>
      <div class="becm-pills">
        <span class="becm-pl becm-pl-c">8% → 2% zero-result</span>
        <span class="becm-pl becm-pl-g">+24% search CVR</span>
        <span class="becm-pl becm-pl-v">AOV +14%</span>
      </div>
      <p class="becm-foot">Дальше — как устроены AI-поиск и рекомендации для e-commerce →</p>
    </div>

    <div class="becm-rgt">
      <canvas
        id="becm-shopper-journey-canvas"
        aria-label="Анимация: покупатель ищет товар, AI находит совпадения, предлагает рекомендации и подключает чат поддержки"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('becm-shopper-journey-canvas');
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
    paper:'#ffffff',
    paperBdr:'#cbd5e1',
    cyan:'#06b6d4',
    cyanGlow:'rgba(6,182,212,.25)',
    violet:'#8b5cf6',
    violetGlow:'rgba(139,92,246,.2)',
    green:'#22c55e',
    greenGlow:'rgba(34,197,94,.2)',
    orange:'#f97316',
    red:'#ef4444',
    gray:'#e2e8f0',
    grayText:'#94a3b8',
    line:'rgba(6,182,212,.35)',
    chat:'#f0f9ff',
    chatBdr:'#7dd3fc'
  };

  var QUERY = 'чехол айфон 15 про матовый';
  var PRODUCTS = [
    {name:'Чехол Pro Matte', match:true, col:0, row:0},
    {name:'Стекло 15 Pro', match:true, col:1, row:0},
    {name:'Кабель USB-C', match:false, col:2, row:0},
    {name:'Чехол Slim', match:true, col:0, row:1},
    {name:'Подставка', match:false, col:1, row:1},
    {name:'Пленка 15', match:false, col:2, row:1}
  ];

  var RECS = ['Чехол + стекло', 'Матовый комплект', 'Доставка завтра'];
  var LOOP = 720;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawSearchBar(x,y,w,typed){
    rr(x,y,w,36,18,C.paper,C.paperBdr,1.5);
    ctx.fillStyle=C.muted;
    ctx.font='14px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('🔍',x+12,y+23);
    var show = QUERY.slice(0, Math.min(QUERY.length, Math.floor(typed)));
    ctx.fillStyle=C.ink;
    ctx.font='12px Inter,sans-serif';
    ctx.fillText(show || 'Поиск по каталогу…',x+34,y+23);
    if(Math.floor(typed/12)%2===0 && typed < QUERY.length+20){
      ctx.fillStyle=C.cyan;
      ctx.fillRect(x+34+ctx.measureText(show).width+2,y+14,1.5,14);
    }
  }

  function drawProductCard(x,y,w,h,prod,highlight,alpha){
    ctx.globalAlpha = alpha || 1;
    var bg = highlight ? 'rgba(6,182,212,.08)' : C.paper;
    var bdr = highlight ? C.cyan : C.paperBdr;
    rr(x,y,w,h,10,bg,bdr,highlight?2:1);
    rr(x+8,y+8,w-16,h*0.45,6,highlight?'rgba(6,182,212,.15)':C.gray,null,0);
    if(highlight){
      ctx.strokeStyle=C.cyanGlow;
      ctx.lineWidth=3;
      ctx.strokeRect(x-1,y-1,w+2,h+2);
    }
    ctx.fillStyle=highlight?C.ink:C.grayText;
    ctx.font=(highlight?'bold ':'')+'9px Inter,sans-serif';
    ctx.textAlign='center';
    var lines = prod.name.split(' ');
    ctx.fillText(lines[0],x+w/2,y+h*0.62);
    if(lines[1]) ctx.fillText(lines.slice(1).join(' '),x+w/2,y+h*0.72);
    if(!prod.match && !highlight){
      ctx.fillStyle=C.red;
      ctx.font='bold 16px sans-serif';
      ctx.fillText('∅',x+w-12,y+16);
    }
    if(highlight){
      ctx.fillStyle=C.green;
      ctx.font='bold 10px sans-serif';
      ctx.fillText('✓ match',x+w/2,y+h-8);
    }
    ctx.globalAlpha=1;
  }

  function drawSemanticHub(cx,cy,r,pulse){
    ctx.beginPath();
    ctx.arc(cx,cy,r+pulse*2,0,Math.PI*2);
    ctx.fillStyle=C.violetGlow;
    ctx.fill();
    rr(cx-r,cy-r,r*2,r*2,r,C.paper,C.violet,2);
    ctx.fillStyle=C.violet;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('AI',cx,cy-4);
    ctx.font='8px Inter,sans-serif';
    ctx.fillText('семантика',cx,cy+10);
  }

  function drawRecStrip(x,y,w,phase){
    rr(x,y,w,52,12,'rgba(139,92,246,.06)',C.violet,1.5);
    ctx.fillStyle=C.violet;
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Рекомендации',x+12,y+16);
    var chipW = (w-40)/3;
    RECS.forEach(function(lbl,i){
      var cx = x+12+i*(chipW+8);
      var on = phase > 400 + i*40;
      rr(cx,y+24,chipW,22,11,on?'rgba(139,92,246,.12)':C.paper,on?C.violet:C.paperBdr,1);
      ctx.fillStyle=on?C.violet:C.muted;
      ctx.font='8px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(lbl,cx+chipW/2,y+38);
    });
  }

  function drawChatBubble(x,y,open,alpha){
    ctx.globalAlpha=alpha||1;
    rr(x,y,120,44,14,C.chat,C.chatBdr,1.5);
    ctx.fillStyle=C.cyan;
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('💬 AI-поддержка',x+10,y+16);
    ctx.fillStyle=C.ink;
    ctx.font='8px Inter,sans-serif';
    if(open){
      ctx.fillText('Доставка завтра ✓',x+10,y+30);
      ctx.fillStyle=C.green;
      ctx.fillText('· CRM online',x+10,y+40);
    } else {
      ctx.fillText('Статус заказа…',x+10,y+30);
    }
    ctx.globalAlpha=1;
  }

  function drawCart(x,y,items,pulse){
    rr(x,y,44,44,12,C.paper,C.green,2);
    ctx.fillStyle=C.green;
    ctx.font='18px sans-serif';
    ctx.textAlign='center';
    ctx.fillText('🛒',x+22,y+30);
    if(items>0){
      var n = items;
      rr(x+28,y-4,18,18,9,C.green,null,0);
      ctx.fillStyle='#fff';
      ctx.font='bold 10px sans-serif';
      ctx.fillText(String(n),x+37,y+8);
    }
    if(pulse>0){
      ctx.beginPath();
      ctx.arc(x+22,y+22,24+pulse*3,0,Math.PI*2);
      ctx.strokeStyle=C.greenGlow;
      ctx.lineWidth=2;
      ctx.stroke();
    }
  }

  function drawConnection(x1,y1,x2,y2,prog){
    ctx.beginPath();
    ctx.moveTo(x1,y1);
    var mx=(x1+x2)/2, my=(y1+y2)/2-20;
    ctx.quadraticCurveTo(mx,my,x1+(x2-x1)*prog,y1+(y2-y1)*prog);
    ctx.strokeStyle=C.line;
    ctx.lineWidth=2;
    ctx.setLineDash([4,4]);
    ctx.stroke();
    ctx.setLineDash([]);
    if(prog>=1){
      ctx.beginPath();
      ctx.arc(x2,y2,4,0,Math.PI*2);
      ctx.fillStyle=C.cyan;
      ctx.fill();
    }
  }

  function render(){
    ctx.clearRect(0,0,W,H);
    var phase = frame % LOOP;
    var pad = Math.max(16, W*0.04);

    drawSearchBar(pad, pad, W-pad*2, phase*0.35);

    var gridTop = pad + 52;
    var cols = 3, cardW = (W - pad*2 - 20) / cols, cardH = cardW * 0.85;
    var hubX = W/2, hubY = gridTop + cardH + 36;
    var hubShow = phase > 80;

    PRODUCTS.forEach(function(p,i){
      var cx = pad + (p.col)*(cardW+10);
      var cy = gridTop + p.row*(cardH+10);
      var hl = p.match && phase > 120 + p.col*30;
      var fade = phase < 60 ? 0.4 : 1;
      drawProductCard(cx,cy,cardW,cardH,p,hl,fade);
      if(hl && hubShow){
        var prog = Math.min(1, (phase-120-p.col*30)/60);
        drawConnection(cx+cardW/2,cy+cardH,hubX,hubY-16,prog);
      }
    });

    if(hubShow) drawSemanticHub(hubX, hubY, 28, Math.sin(frame*0.08)*3);

    if(phase > 280) drawRecStrip(pad, hubY+44, W-pad*2, phase);

    var chatAlpha = Math.min(1, (phase-480)/80);
    if(phase > 480) drawChatBubble(W-pad-130, gridTop+8, phase>560, chatAlpha);

    var cartItems = phase > 620 ? 1 : 0;
    var cartPulse = phase > 640 && phase < 680 ? (phase-640)/40 : 0;
    drawCart(pad, hubY+110, cartItems, cartPulse);

    if(phase > 100 && phase < 200){
      ctx.fillStyle='rgba(239,68,68,.85)';
      ctx.font='bold 11px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('Без AI: 12% zero-result',W/2,gridTop-8);
    }
    if(phase > 200){
      ctx.fillStyle='rgba(34,197,94,.9)';
      ctx.font='bold 11px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('С AI: релевантная выдача',W/2,gridTop-8);
    }

    frame++;
    requestAnimationFrame(render);
  }
  render();
})();
</script>
</section>

  <section class="vna-section" id="poisk-rekomendacii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Поиск и AOV</span>
        <h2>AI-поиск и рекомендации для e-commerce</h2>
        <p>Нейросети для e-commerce в блоке поиска и рекомендаций — первый модуль с измеримым ROI. Это семантический слой поверх каталога, а не «умный фильтр».</p>
      </div>
      <div class="vna-grid-3">
        <div class="vna-card nero-ai-reveal">
          <h3>Семантический поиск по каталогу на русском языке</h3>
          <p>AI-поиск понимает запросы вроде «чехол на айфон 15 про матовый» — даже если в карточке другие формулировки. В России есть модули для 1С-Битрикс: <strong>Сотбит: Умный поиск</strong> (от 14 990 ₽), <strong>Верба</strong>, <strong>ResoSearch</strong>. Nero Network внедряет поиск под ваш каталог: индексация, аналитика zero-result, связка с CRM.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1">
          <h3>Персонализированные рекомендации и рост AOV</h3>
          <p>Рекомендательный блок на карточке, в корзине и на странице «ничего не найдено» поднимает средний чек. По Triple Whale / McKinsey, персонализация даёт <strong>+5–15%</strong> revenue lift; у лидеров — до <strong>25%</strong>.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-2">
          <h3>Связка с CRM и историей покупок</h3>
          <p>Рекомендации сильнее с RetailCRM, Битрикс24, amoCRM или 1С: остатки, цены, статус заказа, сегмент клиента. Кейс Botseller: ИИ-бот на <strong>45 000 SKU</strong> с 1С в реальном времени — <strong>1 369</strong> диалогов в месяц; заявленный рост выручки <strong>+320%</strong> (vendor case study).</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="kartochki">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Контент SKU</span>
        <h2>Генерация и улучшение карточек товаров</h2>
        <p>Искусственный интеллект для e-commerce в контенте — ускоритель вывода SKU и единый стандарт качества.</p>
      </div>
      <div class="vna-grid-2">
        <div class="vna-card nero-ai-reveal">
          <h3>Массовое описание без галлюцинаций и шаблонов</h3>
          <p>AI создаёт SEO-тексты, буллеты и характеристики по шаблонам площадок. Критично: <strong>human-in-the-loop</strong> — утверждение перед публикацией, валидация specs, запрет на выдуманные параметры.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1">
          <h3>Атрибуты, FAQ в карточке и микроразметка</h3>
          <p>Структурированные атрибуты, FAQ и schema.org повышают видимость в классической и AI-выдаче. Shopify: <strong>более 50%</strong> AI-сессий начинаются с карточки товара против <strong>20%</strong> у organic search.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="podderzhka">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">AI-агенты</span>
        <h2>AI-поддержка покупателей и ai агенты</h2>
        <p>Клиентский контур: сайт, Telegram, VK, WhatsApp Business API. Логика как у Meta Business Agent, но под российский стек.</p>
      </div>
      <div class="vna-grid-2">
        <div class="vna-card nero-ai-reveal">
          <h3>Ответы 24/7 по наличию, доставке и возвратам</h3>
          <p>Агент обращается к каталогу и CRM/OMS: проверяет остатки, статус заказа (с согласием), отвечает по FAQ. RAG по вашим документам — без «общих знаний» о политике возврата, которой у вас нет.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1">
          <h3>Эскалация сложных кейсов менеджеру без потери контекста</h3>
          <p>Handoff в один клик: оператор видит историю диалога, рекомендации AI и данные клиента в CRM. Спорные возвраты и B2B-сделки остаются за человеком.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="vnedrenie">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Под ключ</span>
        <h2>Внедрение AI для интернет-магазина под ключ</h2>
        <p>Проект с этапами, KPI и интеграцией в ваш стек. Nero Network работает по модели «аудит → пилот → масштаб».</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <h3>Аудит каталога, CRM и каналов продаж</h3>
        <p><strong>Лид-магнит:</strong> бесплатный аудит AI-возможностей магазина. Смотрим каталог, поиск, CRM, мессенджеры, маркетплейсы, политику ПДн. На выходе — матрица приоритетов: быстрые деньги vs стратегия.</p>
      </div>

      <div class="vna-card nero-ai-reveal nero-ai-delay-1" style="margin-top:20px;">
        <h3>Проектирование сценариев: поиск, рекомендации, поддержка</h3>
        <p>Фиксируем сценарии: какие интенты обрабатывает агент, когда эскалирует, какие KPI пилота (zero-result rate, % автозакрытия саппорта, время первого ответа). Разделяем операции магазина и клиентский агент — полезная рамка для российского стека.</p>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением поиска и AI-агента полезно разобраться в промптах, RAG и human-in-the-loop — это ускоряет согласование сценариев с маркетингом и IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>

      <div class="vna-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Интеграция, обучение на данных магазина, запуск и сопровождение</h3>
        <p>Каталог (YML/API/1С) → AI-слой (YandexGPT, GigaChat, RAG) → CRM + мессенджеры + аналитика. Модерация промптов, compliance 152-ФЗ, логи и маскирование ПДн.</p>
      </div>

      <div class="vna-card nero-ai-reveal nero-ai-delay-1" style="margin-top:20px;">
        <h3>Сроки и этапы</h3>
        <div class="vna-timeline">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Аудит</h3><p>3–5 рабочих дней.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Пилот одного модуля</h3><p>2–4 недели с измеримым KPI.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Полная интеграция</h3><p>От нескольких недель до 2–3 месяцев в зависимости от каталога, каналов и CRM.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Сопровождение</h3><p>По SLA. Ориентир чека: <strong>200 000 – 2 000 000 ₽</strong> (финальная смета после аудита).</p></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-vnedrenie">
      <div class="ym-cta-block__icon" aria-hidden="true">🛒</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Бесплатный аудит AI-возможностей магазина</p>
        <p class="ym-cta-block__sub">Разберём каталог, поиск, CRM, маркетплейсы и каналы поддержки. На выходе — матрица «быстрый win / средний срок / стратегия» и ориентир сметы под ваш стек. Без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <section class="vna-section" id="integracii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Стек</span>
        <h2>Интеграция AI с платформами и маркетплейсами</h2>
        <p>Разработка и интеграция учитывает вашу CMS, CRM и площадки — без привязки к одному вендору.</p>
      </div>
      <div class="vna-grid-3">
        <div class="vna-card nero-ai-reveal">
          <h3>InSales, 1С-Битрикс, WooCommerce, OpenCart</h3>
          <p>Каталог через API, выгрузки или 1С. На Битрикс — связка с модулями умного поиска или кастомный векторный индекс. InSales — типичный стек D2C в РФ.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1">
          <h3>Ozon, Wildberries и единый каталог</h3>
          <p>Единый конвейер описаний с адаптацией под правила ЛК. Встроенный AI Ozon (50 описаний/мес) и WB — точечные инструменты; кастомный пайплайн даёт масштаб, единый tone и связь с сайтом.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-2">
          <h3>ai для интернет магазина с CRM</h3>
          <p>RetailCRM, Битрикс24, amoCRM, 1С — статус заказа, сегменты, история для рекомендаций. Фокус на e-commerce-контуре: каталог, поиск, карточки, поддержка.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Результаты</span>
        <h2>Кейсы и результат внедрения</h2>
        <p>Цифры ROI — из публичных источников; ваш результат зависит от каталога, трафика и выбранных модулей.</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Кейс</th><th>Что внедрено</th><th>Метрики</th></tr></thead>
          <tbody>
            <tr><td>CaseUp (аксессуары, РФ)</td><td>YandexGPT 5 + RetailCRM, WhatsApp, чат сайта</td><td>60% тикетов без человека; ответ 30 сек; CSAT 4,5; окупаемость 4 мес.</td></tr>
            <tr><td>Botseller (стройматериалы)</td><td>ИИ-бот + 1С, 45 000 SKU, мультиканал</td><td>1 369 диалогов/мес; заявленный рост выручки +320%</td></tr>
            <tr><td>Adobe / Shopify (глобально)</td><td>AI-discovery трафик</td><td>+138% AI-трафика YoY; конверсия AI-сессий +50–54%; AOV +14%</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:28px;">
        <h3>ai для интернет магазина для малого и среднего бизнеса</h3>
        <p>Малый бизнес стартует с одного модуля: AI-поддержка или семантический поиск. Средний — пакет «поиск + рекомендации + карточки» при каталоге от 500 SKU. Селлеры с сайтом и маркетплейсами получают единый контур вместо разрозненных генераторов в ЛК.</p>
      </div>
    </div>
  </section>

  <section class="vna-section" id="stoimost">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Бюджет</span>
        <h2>Стоимость и что входит в проект</h2>
        <p>Ориентир <strong>200 000 – 2 000 000 ₽</strong>. Точная смета — после аудита.</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Фактор</th><th>Влияние на цену</th></tr></thead>
          <tbody>
            <tr><td>Размер каталога (SKU)</td><td>Индексация, генерация, нагрузка</td></tr>
            <tr><td>Число модулей</td><td>Поиск, рекомендации, карточки, агент, аналитика</td></tr>
            <tr><td>Интеграции</td><td>CMS, CRM, 1С, маркетплейсы, мессенджеры</td></tr>
            <tr><td>Каналы</td><td>Сайт, Telegram, VK, WhatsApp</td></tr>
            <tr><td>Compliance</td><td>152-ФЗ, хостинг, аудит ПДн</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vna-card">
          <h3>Под ключ или самостоятельно: когда что выгоднее</h3>
          <p><strong>Самостоятельно</strong> — если есть сильная in-house команда и один канал. <strong>Под ключ</strong> — когда нужна связка каталог + CRM + маркетплейсы + compliance и измеримый пилот.</p>
        </div>
        <div class="vna-card">
          <h3>Бесплатный аудит AI-возможностей магазина</h3>
          <p>Первый шаг — аудит с матрицей «быстрый win / средний срок / стратегия». Без обязательств.</p>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-stoimost">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте бюджет под ваш каталог и каналы</p>
        <p class="ym-cta-block__sub">Ориентир 200 000 – 2 000 000 ₽ за внедрение под ключ. На аудите дадим расчёт по модулям, интеграциям и пилоту с KPI — бесплатно.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#vnedrenie" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
        </div>
      </div>
    </div>
  </div>

  <section class="vna-section vna-section-alt" id="riski">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">E-E-A-T</span>
        <h2>Риски и требования (152-ФЗ, качество поиска)</h2>
        <p>Внедрение искусственного интеллекта в e-commerce требует контроля качества и соблюдения закона о персональных данных.</p>
      </div>
      <div class="vna-grid-2">
        <div class="vna-card nero-ai-reveal">
          <h3>Галлюцинации в описаниях и контроль качества</h3>
          <p>Шаблоны промптов, валидация характеристик по эталону, запрет на выдуманные specs, обязательное утверждение карточек человеком. Логи генераций для разбора инцидентов.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1">
          <h3>Персонализация и персональные данные</h3>
          <p>С 1 сентября 2025 ужесточены согласия и локализация ПДн (152-ФЗ). AI с персонализацией — зона compliance: российский хостинг, согласия, маскирование в логах, RAG без слива ПДн в публичные API.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">FAQ</span>
        <h2>Частые вопросы о AI для интернет-магазина</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai для интернет магазина?</div><div class="vna-faq-a">Начните с аудита: каталог, поиск, CRM, каналы. Выберите один модуль для пилота (поиск или поддержка), зафиксируйте KPI на 2–4 недели, затем масштабируйте. Nero Network ведёт проект под ключ.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai для интернет магазина?</div><div class="vna-faq-a">Ориентир: 200 000 – 2 000 000 ₽ в зависимости от каталога, модулей и интеграций. Точная смета — после аудита. Пилот одного модуля снижает входной порог.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Какие задачи решает ai для интернет магазина?</div><div class="vna-faq-a">Семантический поиск, рекомендации, генерация карточек, поддержка 24/7, персонализация, аналитика zero-result и диалогов. Связка с CRM и маркетплейсами.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">ai для интернет магазина без программиста — возможно?</div><div class="vna-faq-a">При внедрении под ключ — да: интеграцию и настройку берёт на себя команда Nero Network. Вам нужны доступы к каталогу, CRM и согласование сценариев.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">ai для интернет магазина под ключ или самостоятельно?</div><div class="vna-faq-a">Под ключ выгодно при нескольких каналах, 1С/CRM, маркетплейсах и требованиях 152-ФЗ. Самостоятельно — при узком сценарии и сильной IT-команде.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">ai для интернет магазина с CRM — что даёт связка?</div><div class="vna-faq-a">Актуальные остатки и цены, статус заказа в чате, сегменты для рекомендаций, единая история клиента при эскалации на оператора.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">ai для интернет магазина кейсы — есть ли в России?</div><div class="vna-faq-a">Да: поддержка (CaseUp + YandexGPT + RetailCRM), большой каталог + 1С (Botseller), платформенный AI Ozon/WB. Полных публичных enterprise-кейсов «всё в одном» мало — типична проектная модель интегратора.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">ai для интернет магазина для малого бизнеса — с чего начать?</div><div class="vna-faq-a">С AI-поддержки или умного поиска — быстрый измеримый эффект при умеренном бюджете. Аудит покажет приоритет.</div></div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-cta-final" id="cta" aria-labelledby="cta-ecom-title">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Следующий шаг</span>
        <h2 id="cta-ecom-title">Увеличить конверсию магазина с AI</h2>
        <p>AI для интернет-магазина под ключ — поиск, рекомендации, карточки и поддержка в одном контуре с CRM и маркетплейсами. Глобальный тренд agentic commerce подтверждает: покупатель ждёт действий, а не скриптов.</p>
      </div>
      <ul class="vna-cta-checklist nero-ai-reveal" aria-label="Что вы получите">
        <li>Аудит за 3–5 рабочих дней</li>
        <li>Пилот одного модуля с KPI</li>
        <li>Интеграция с CRM и маркетплейсами</li>
        <li>Смета без скрытых работ</li>
      </ul>
      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Закажите аудит AI-возможностей магазина</p>
          <p class="ym-cta-block__sub">Получите матрицу приоритетов и расчёт под ваш каталог, CRM и Ozon/Wildberries. YandexGPT + RetailCRM/1С + Telegram/VK + 152-ФЗ.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.aim-ecom-content -->

<!-- SCHEMA-MARKUP:INSERT -->

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

<script>
(function () {
  const canvas = document.getElementById('aim-ecom-hero-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let cw = 0, ch = 0, frame = 0;

  function resize() {
    const wrap = canvas.parentElement;
    if (!wrap) return;
    cw = wrap.clientWidth || 480;
    ch = 128;
    canvas.width = cw;
    canvas.height = ch;
  }
  window.addEventListener('resize', resize);
  resize();

  const C = {
    outline: 'rgba(148,163,184,.35)',
    hub: '#0f172a',
    hubLight: '#1e293b',
    stream: '#79f2ff',
    stream2: '#8b5cf6',
    green: '#22c55e',
    card: 'rgba(255,255,255,.08)',
    agentYellow: '#eab308',
    agentGreen: '#10b981',
    agentBlue: '#3b82f6',
    agentPink: '#ec4899',
    agentPurple: '#8b5cf6',
    bubble: 'rgba(255,255,255,.92)'
  };

  function rr(ctx, x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1; ctx.stroke(); }
  }

  /* IntentStream — дугообразный поток запросов (не конвейер) */
  class IntentStream {
    constructor() {
      this.particles = Array.from({ length: 5 }, (_, i) => ({
        t: i * 0.18,
        hue: i % 2 ? C.stream : C.stream2
      }));
    }
    draw(ctx, cx, cy) {
      ctx.save();
      ctx.strokeStyle = 'rgba(121,242,255,.18)';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(24, ch - 18);
      ctx.quadraticCurveTo(cx * 0.55, 12, cx, cy + 40);
      ctx.quadraticCurveTo(cx * 1.45, ch - 8, cw - 24, cy + 20);
      ctx.stroke();
      this.particles.forEach((p) => {
        p.t = (p.t + 0.004) % 1;
        const t = p.t;
        const x = (1 - t) * (1 - t) * 24 + 2 * (1 - t) * t * (cx * 0.55) + t * t * cx;
        const y = (1 - t) * (1 - t) * (ch - 18) + 2 * (1 - t) * t * 12 + t * t * (cy + 40);
        ctx.fillStyle = p.hue;
        ctx.globalAlpha = 0.55 + Math.sin(frame * 0.08 + t * 10) * 0.25;
        rr(ctx, x - 5, y - 3, 10, 6, 3, p.hue, null);
        ctx.globalAlpha = 1;
      });
      ctx.restore();
    }
  }

  /* CheckoutNexus — хаб витрины (не WebsiteTerminal) */
  class CheckoutNexus {
    constructor(x, y) {
      this.x = x;
      this.y = y;
      this.phase = 0;
      this.pulse = 0;
    }
    draw(ctx) {
      this.phase = (frame * 0.04) % 160;
      this.pulse = Math.sin(frame * 0.06) * 0.5 + 0.5;
      const w = Math.min(168, cw * 0.38);
      const h = 78;
      const x = this.x - w / 2;
      const y = this.y - h / 2;
      rr(ctx, x, y, w, h, 10, C.hub, C.outline);
      rr(ctx, x + 8, y + 8, w - 16, 18, 6, C.hubLight, C.outline);
      ctx.fillStyle = 'rgba(121,242,255,.55)';
      ctx.fillRect(x + 14, y + 14, (w - 28) * Math.min(1, this.phase / 30), 6);

      if (this.phase > 35) {
        rr(ctx, x + 10, y + 34, 52, 34, 6, C.card, C.outline);
        rr(ctx, x + 18, y + 40, 36, 6, 2, 'rgba(148,163,184,.4)', null);
        rr(ctx, x + 18, y + 50, 28, 4, 2, 'rgba(148,163,184,.25)', null);
      }
      if (this.phase > 70) {
        rr(ctx, x + 68, y + 34, 40, 34, 6, 'rgba(139,92,246,.18)', C.outline);
        ctx.fillStyle = C.stream2;
        ctx.font = 'bold 9px Inter,sans-serif';
        ctx.fillText('+AOV', x + 76, y + 54);
      }
      if (this.phase > 105) {
        rr(ctx, x + w - 58, y + 34, 48, 34, 6, 'rgba(34,197,94,.14)', C.outline);
        ctx.fillStyle = C.green;
        ctx.font = 'bold 10px Inter,sans-serif';
        ctx.fillText('CRM ✓', x + w - 50, y + 54);
      }
      if (this.phase > 130) {
        ctx.strokeStyle = `rgba(34,197,94,${0.35 + this.pulse * 0.45})`;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(this.x, this.y, w * 0.55, 0, Math.PI * 2);
        ctx.stroke();
      }
    }
  }

  class Agent {
    constructor(x, y, color, role, dialogs, tx, ty) {
      this.x = x; this.y = y; this.color = color; this.role = role;
      this.dialogs = dialogs; this.tx = tx; this.ty = ty;
      this.stepTrig = Math.random() * 200;
      this.bubble = null;
    }
    draw(ctx) {
      this.stepTrig = (this.stepTrig + 0.6) % 200;
      const prog = this.stepTrig / 200;
      const ax = this.x + (this.tx - this.x) * Math.min(1, prog * 1.4);
      const ay = this.y + (this.ty - this.y) * Math.min(1, prog * 1.4);
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(ax, ay - 10, 5, 0, Math.PI * 2);
      ctx.fill();
      rr(ctx, ax - 7, ay - 4, 14, 12, 5, 'rgba(255,255,255,.22)', C.outline);
      if (this.stepTrig > 150 && Math.random() < 0.012) {
        this.bubble = { text: this.dialogs[Math.floor(Math.random() * this.dialogs.length)], life: 90, x: ax, y: ay - 22 };
      }
      if (this.bubble) {
        this.bubble.life--;
        const bw = Math.min(110, this.bubble.text.length * 5.5 + 16);
        rr(ctx, this.bubble.x - bw / 2, this.bubble.y - 18, bw, 16, 6, C.bubble, C.outline);
        ctx.fillStyle = '#0f172a';
        ctx.font = '8px Inter,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText(this.bubble.text, this.bubble.x, this.bubble.y - 6);
        if (this.bubble.life <= 0) this.bubble = null;
      }
    }
  }

  const stream = new IntentStream();
  let nexus = null;
  const agents = [];

  function initScene() {
    const cx = cw / 2;
    const cy = ch / 2 - 4;
    nexus = new CheckoutNexus(cx, cy);
    agents.length = 0;
    agents.push(
      new Agent(28, ch - 24, C.agentBlue, '1_search', ['синоним найден', 'опечатка исправлена', 'транслит ок'], cx - 50, cy + 8),
      new Agent(cw - 30, ch - 20, C.agentPurple, '2_reco', ['похожий SKU', 'комплект +1', 'upsell в корзине'], cx + 40, cy - 6),
      new Agent(cx, ch - 12, C.agentGreen, '4_support', ['ответ 30 сек', 'статус заказа', 'handoff оператору'], cx, cy + 22),
      new Agent(40, 18, C.agentYellow, '3_content', ['описание SKU', 'атрибуты WB', 'FAQ в карточке'], cx - 20, cy - 10),
      new Agent(cw - 36, 16, C.agentPink, '5_analytics', ['zero-result −6%', 'поиск CVR +24%', 'интент в отчёт'], cx + 24, cy + 14)
    );
  }

  const bubbles = [];
  function maybeBubble(text, x, y) {
    if (frame % 95 === 0) bubbles.push({ text, x, y, life: 80 });
  }

  function drawBubbles(ctx) {
    for (let i = bubbles.length - 1; i >= 0; i--) {
      const b = bubbles[i];
      b.life--;
      ctx.globalAlpha = Math.min(1, b.life / 30);
      rr(ctx, b.x, b.y, 90, 14, 5, 'rgba(15,23,42,.85)', 'rgba(121,242,255,.35)');
      ctx.fillStyle = '#e2e8f0';
      ctx.font = '8px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(b.text, b.x + 6, b.y + 10);
      ctx.globalAlpha = 1;
      if (b.life <= 0) bubbles.splice(i, 1);
    }
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    if (!nexus) initScene();
    stream.draw(ctx, cw / 2, ch / 2 - 4);
    nexus.draw(ctx);
    agents.forEach((a) => a.draw(ctx));
    if (frame % 110 === 0) maybeBubble('запрос → match → заказ', 12, 8);
    if (frame % 140 === 35) maybeBubble('152-ФЗ · RAG без слива ПДн', cw - 168, 8);
    drawBubbles(ctx);
    requestAnimationFrame(loop);
  }

  resize();
  initScene();
  loop();
})();
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

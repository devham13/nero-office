<?php
/**
 * Template Name: AI-прогноз вероятности сделки в CRM: внедрение под ключ
 * Description: Внедрим AI-модуль прогноза вероятности закрытия сделки в CRM: scoring, риски срыва, next best step. Аудит прогноза — бесплатно.
 */

declare(strict_types=1);

$page_seo_title       = 'Внедрение AI-прогноза вероятности сделки в CRM под ключ';
$page_seo_description = 'Внедрим AI-модуль прогноза вероятности закрытия сделки в CRM: scoring лидов, риски срыва, следующий шаг. Аудит прогноза продаж — бесплатно.';

add_filter(
    'document_title_parts',
    static function (array $parts) use ($page_seo_title): array {
        $parts['title'] = $page_seo_title;
        return $parts;
    },
    20
);

add_action(
    'wp_head',
    static function () use ($page_seo_title, $page_seo_description): void {
        echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
    },
    1
);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Проблема', 'href' => '#problema'],
    ['label' => 'Решение', 'href' => '#reshenie'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Калькулятор', 'href' => '#kalkulyator'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = 'Оценить воронку';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = 'Как работает scoring';
$secondary_cta_url   = '#kak-rabotaet';

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

.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-link--accent{color:var(--vna-accent)!important;text-decoration:underline!important;}

/* ===== APS CRM HERO — self-contained (nero-ai-home-page) ===== */
.aps-crm-hero-page {
  --nero-ai-bg: #050711;
  --nero-ai-bg-2: #080b17;
  --nero-ai-text: #e6edf7;
  --nero-ai-soft: #c7d2e5;
  --nero-ai-muted: #9aa8bd;
  --nero-ai-primary: #79f2ff;
  --nero-ai-violet: #8b5cf6;
  --nero-ai-green: #22c55e;
  --nero-ai-amber: #fbbf24;
  --nero-ai-red: #fb7185;
  --nero-ai-shadow: 0 24px 72px rgba(0,0,0,.45);
  --nero-ai-container: 1220px;
  background: radial-gradient(1200px 600px at 18% -10%, rgba(121,242,255,.10), transparent 55%),
              radial-gradient(900px 500px at 82% 0%, rgba(139,92,246,.12), transparent 50%),
              linear-gradient(180deg, #050711 0%, #080b17 48%, #050711 100%);
  color: var(--nero-ai-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  overflow-x: clip;
}
.aps-crm-hero-page .nero-ai-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
}
.aps-crm-hero-page .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 14px;
  padding: 6px 14px;
  border-radius: 999px;
  border: 1px solid rgba(121,242,255,.22);
  background: rgba(121,242,255,.08);
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--nero-ai-primary);
}
.aps-crm-hero-page .nero-ai-gradient-text {
  display: inline;
  background: linear-gradient(92deg, #fff 0%, var(--nero-ai-primary) 44%, var(--nero-ai-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aps-crm-hero-page .nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100vh - 1px));
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aps-crm-hero-page .nero-ai-hero::before {
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
.aps-crm-hero-page .nero-ai-hero::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121,242,255,.12), transparent 66%);
  filter: blur(6px);
  animation: apsCrmGlow 8s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes apsCrmGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.aps-crm-hero-page .nero-ai-hero-grid {
  position: relative;
  z-index: 1;
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aps-crm-hero-page .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 6.2vw, 82px);
  line-height: .92;
  letter-spacing: -.075em;
  color: #fff;
}
.aps-crm-hero-page .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--nero-ai-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aps-crm-hero-page .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aps-crm-hero-page .nero-ai-badge {
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
.aps-crm-hero-page .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 34px;
}
.aps-crm-hero-page .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  min-height: 48px;
  padding: 0 22px;
  border-radius: 999px;
  font-size: 14px;
  font-weight: 800;
  text-decoration: none !important;
  transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
}
.aps-crm-hero-page .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--nero-ai-primary), #5eead4);
  box-shadow: 0 14px 40px rgba(121,242,255,.22);
}
.aps-crm-hero-page .nero-ai-btn-primary:hover { transform: translateY(-2px); }
.aps-crm-hero-page .nero-ai-btn-secondary {
  color: var(--nero-ai-soft) !important;
  border: 1px solid rgba(255,255,255,.14);
  background: rgba(255,255,255,.05);
}
.aps-crm-hero-page .nero-ai-btn-secondary:hover {
  border-color: rgba(121,242,255,.34);
  background: rgba(121,242,255,.08);
}
.aps-crm-hero-page .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2,6,23,.42);
  box-shadow: var(--nero-ai-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.aps-crm-hero-page .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15,23,42,.95), rgba(6,10,24,.96));
}
.aps-crm-hero-page .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aps-crm-hero-page .nero-ai-dots { display: flex; gap: 7px; }
.aps-crm-hero-page .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,.22); }
.aps-crm-hero-page .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aps-crm-hero-page .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aps-crm-hero-page .nero-ai-dot:nth-child(3) { background: #34d399; }
.aps-crm-hero-page .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aps-crm-hero-page .nero-ai-window-body { padding: 18px; }
.aps-crm-hero-page .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aps-crm-hero-page .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -.03em;
  color: #fff;
}
.aps-crm-hero-page .nero-ai-live-pill {
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
.aps-crm-hero-page .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--nero-ai-green);
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: apsCrmPulse 1.6s infinite;
}
@keyframes apsCrmPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aps-crm-hero-page .nero-ai-dashboard-note {
  margin: 0 0 10px;
  font-size: 11px;
  color: var(--nero-ai-muted);
  letter-spacing: .04em;
}
.aps-crm-hero-page .aps-crm-canvas-wrap {
  position: relative;
  height: clamp(120px, 18vw, 168px);
  margin-bottom: 14px;
  border-radius: 18px;
  border: 1px solid rgba(255,255,255,.08);
  background:
    radial-gradient(circle at 50% 55%, rgba(121,242,255,.08), transparent 58%),
    rgba(255,255,255,.03);
  overflow: hidden;
}
.aps-crm-hero-page #aps-crm-hero-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.aps-crm-hero-page .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
.aps-crm-hero-page .nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease;
}
.aps-crm-hero-page .nero-ai-metric:hover { transform: translateY(-3px); border-color: rgba(121,242,255,.34); }
.aps-crm-hero-page .nero-ai-metric span { display: block; color: var(--nero-ai-muted); font-size: 12px; font-weight: 700; }
.aps-crm-hero-page .nero-ai-metric strong { display: block; margin-top: 7px; color: #fff; font-size: clamp(18px, 2.4vw, 24px); line-height: 1; }
.aps-crm-hero-page .nero-ai-metric small { display: block; margin-top: 6px; color: #9fb0c9; font-size: 11px; }
.aps-crm-hero-page .nero-ai-task-stream { margin-top: 16px; display: grid; gap: 10px; }
.aps-crm-hero-page .nero-ai-task {
  display: grid;
  grid-template-columns: 10px 1fr;
  align-items: start;
  gap: 10px;
  padding: 11px 12px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
  font-size: 12.5px;
  line-height: 1.45;
  color: var(--nero-ai-soft);
  animation: apsCrmTaskFloat 5s ease-in-out infinite;
}
.aps-crm-hero-page .nero-ai-task:nth-child(2) { animation-delay: .6s; }
.aps-crm-hero-page .nero-ai-task:nth-child(3) { animation-delay: 1.2s; }
.aps-crm-hero-page .nero-ai-task:nth-child(4) { animation-delay: 1.8s; }
@keyframes apsCrmTaskFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-4px); }
}
.aps-crm-hero-page .nero-ai-dash-dot {
  width: 8px;
  height: 8px;
  margin-top: 5px;
  border-radius: 50%;
  flex-shrink: 0;
}
.aps-crm-hero-page .nero-ai-dash-dot--amber { background: var(--nero-ai-amber); box-shadow: 0 0 12px rgba(251,191,36,.45); }
.aps-crm-hero-page .nero-ai-dash-dot--red { background: var(--nero-ai-red); box-shadow: 0 0 12px rgba(251,113,133,.45); }
.aps-crm-hero-page .nero-ai-dash-dot--green { background: var(--nero-ai-green); box-shadow: 0 0 12px rgba(34,197,94,.45); }
.aps-crm-hero-page .nero-ai-dash-dot--blue { background: var(--nero-ai-primary); box-shadow: 0 0 12px rgba(121,242,255,.45); }
.aps-crm-hero-page .nero-ai-reveal {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity .55s ease, transform .55s ease;
}
.aps-crm-hero-page .nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
.aps-crm-hero-page .nero-ai-delay-2 { transition-delay: .24s; }
@media (max-width: 1024px) {
  .aps-crm-hero-page .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aps-crm-hero-page .nero-ai-dashboard { transform: none; }
}
@media (max-width: 600px) {
  .aps-crm-hero-page .nero-ai-hero { min-height: auto; padding-top: 88px; }
  .aps-crm-hero-page .nero-ai-btn-row { flex-direction: column; }
  .aps-crm-hero-page .nero-ai-btn { width: 100%; }
  .aps-crm-hero-page .nero-ai-metrics-grid { grid-template-columns: 1fr; }
}

</style>

<main id="primary" class="site-main nero-ai-home-page aps-crm-hero-page ai-prognoz-sdelki-crm-page" role="main" tabindex="-1">

<section class="nero-ai-hero aps-crm-hero" id="hero" aria-labelledby="hero-aps-crm-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai прогноз crm</p>
      <h1 id="hero-aps-crm-title">AI-прогноз вероятности сделки в CRM: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Менеджеры завышают прогноз — собственник не видит реальную выручку. AI оценивает вероятность закрытия сделки, риски срыва и следующий лучший шаг прямо в вашей CRM.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Вероятность сделки</li>
        <li class="nero-ai-badge">Риски срыва</li>
        <li class="nero-ai-badge">Next best step</li>
        <li class="nero-ai-badge">Weighted forecast</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Оценить воронку</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает scoring</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-прогноз pipeline">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true">
            <span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span>
          </div>
          <span class="nero-ai-window-title">CRM · deal scoring</span>
        </div>
        <div class="nero-ai-window-body">
          <p class="nero-ai-dashboard-note">пример deal scoring · демонстрационные данные</p>
          <div class="nero-ai-dashboard-title">
            <h3>AI-прогноз pipeline</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>

          <div class="aps-crm-canvas-wrap">
            <canvas id="aps-crm-hero-canvas" role="img" aria-label="Анимация: сигналы сделок стекаются в AI-орб вероятности, завышенный прогноз менеджера схлопывается в weighted forecast"></canvas>
          </div>

          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>AI-weighted</span>
              <strong>4,2 млн ₽</strong>
              <small>pipeline</small>
            </div>
            <div class="nero-ai-metric">
              <span>At-risk</span>
              <strong>12</strong>
              <small>сделок</small>
            </div>
            <div class="nero-ai-metric">
              <span>Точность</span>
              <strong>78%</strong>
              <small>прогноза (мес.)</small>
            </div>
            <div class="nero-ai-metric">
              <span>Воронка</span>
              <strong>156</strong>
              <small>открытых</small>
            </div>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий по сделкам">
            <div class="nero-ai-task">
              <span class="nero-ai-dash-dot nero-ai-dash-dot--amber" aria-hidden="true"></span>
              <span>Сделка #1842: 72% → 45% · close date slip</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-dash-dot nero-ai-dash-dot--red" aria-hidden="true"></span>
              <span>At-risk: нет активности 21 дней · silent deal</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-dash-dot nero-ai-dash-dot--green" aria-hidden="true"></span>
              <span>Next step: звонок ЛПР · задача в CRM</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-dash-dot nero-ai-dash-dot--blue" aria-hidden="true"></span>
              <span>Forecast обновлён: committed / best case / AI-weighted</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  document.addEventListener('DOMContentLoaded', function () {
    var root = document.querySelector('.aps-crm-hero-page, .nero-ai-home-page');
    if (root) {
      root.querySelectorAll('.nero-ai-reveal').forEach(function (el, i) {
        setTimeout(function () { el.classList.add('nero-ai-active'); }, 80 + i * 90);
      });
    }

    var canvas = document.getElementById('aps-crm-hero-canvas');
    if (!canvas) return;
    var ctx = canvas.getContext('2d');
    var cw = 0, ch = 0, cx = 0, cy = 0, frame = 0, scale = 1;

    var C = {
      outline: 'rgba(255,255,255,.35)',
      orbCore: '#79f2ff',
      orbViolet: '#8b5cf6',
      orbGreen: '#22c55e',
      orbAmber: '#fbbf24',
      orbRed: '#fb7185',
      chipBg: 'rgba(255,255,255,.12)',
      ghost: 'rgba(251,191,36,.55)',
      arc: 'rgba(121,242,255,.25)',
      agentYellow: '#eab308',
      agentGreen: '#10b981',
      agentBlue: '#3b82f6',
      agentPink: '#ec4899',
      agentPurple: '#8b5cf6',
      bubbleBg: 'rgba(15,23,42,.92)'
    };

    function resize() {
      var wrap = canvas.parentElement;
      if (!wrap) return;
      cw = wrap.clientWidth;
      ch = wrap.clientHeight;
      canvas.width = cw;
      canvas.height = ch;
      cx = cw * 0.52;
      cy = ch * 0.54;
      scale = Math.min(cw / 420, ch / 160, 1.15);
    }
    window.addEventListener('resize', resize);
    resize();

    function rr(x, y, w, h, r, fill, stroke) {
      ctx.beginPath();
      if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
      else { ctx.moveTo(x + r, y); ctx.arcTo(x + w, y, x + w, y + h, r); ctx.arcTo(x + w, y + h, x, y + h, r); ctx.arcTo(x, y + h, x, y, r); ctx.arcTo(x, y, x + w, y, r); ctx.closePath(); }
      if (fill) { ctx.fillStyle = fill; ctx.fill(); }
      if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.2; ctx.stroke(); }
    }

  /* SignalArc — дуговые потоки вместо конвейера */
    function SignalArc() {
      this.draw = function () {
        for (var i = 0; i < 3; i++) {
          var off = (frame * 0.4 + i * 40) % 120;
          ctx.save();
          ctx.strokeStyle = C.arc;
          ctx.lineWidth = 1.5;
          ctx.setLineDash([6, 10]);
          ctx.lineDashOffset = -off;
          ctx.beginPath();
          ctx.arc(cx, cy, (48 + i * 18) * scale, Math.PI * 0.15, Math.PI * 1.35);
          ctx.stroke();
          ctx.restore();
        }
      };
    }

  /* DealChip — карточки сделок по орбитам */
    function DealChip(angle, dist, label, col) {
      this.a = angle; this.d = dist; this.label = label; this.col = col || C.orbCore;
      this.speed = 0.012 + Math.random() * 0.008;
      this.draw = function () {
        this.a += this.speed;
        var x = cx + Math.cos(this.a) * this.d * scale;
        var y = cy + Math.sin(this.a) * this.d * scale * 0.55;
        rr(x - 14 * scale, y - 8 * scale, 28 * scale, 16 * scale, 4 * scale, C.chipBg, this.col);
        ctx.fillStyle = '#e2e8f0';
        ctx.font = (8 * scale) + 'px Inter, sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText(this.label, x, y + 3 * scale);
      };
    }

  /* ManagerEstimateGhost — завышенная оценка менеджера */
    function ManagerEstimateGhost() {
      this.yOff = 0;
      this.draw = function (phase) {
        var bob = Math.sin(frame * 0.06) * 4 * scale;
        this.yOff = -22 * scale + bob - (phase > 160 ? (phase - 160) * 0.8 * scale : 0);
        var gx = cx + 72 * scale;
        var gy = cy + this.yOff;
        ctx.globalAlpha = phase > 160 ? Math.max(0, 1 - (phase - 160) / 35) : 0.85;
        rr(gx - 22 * scale, gy - 12 * scale, 44 * scale, 24 * scale, 8 * scale, C.ghost, C.orbAmber);
        ctx.fillStyle = '#fff';
        ctx.font = 'bold ' + (9 * scale) + 'px Inter,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('90% менеджер', gx, gy + 3 * scale);
        ctx.globalAlpha = 1;
      };
    }

  /* RiskBeacon — at-risk маяк */
    function RiskBeacon() {
      this.draw = function (active) {
        if (!active) return;
        var bx = cx - 78 * scale;
        var by = cy - 34 * scale;
        var pulse = 0.5 + Math.sin(frame * 0.14) * 0.5;
        ctx.fillStyle = 'rgba(251,113,133,' + (0.25 + pulse * 0.35) + ')';
        ctx.beginPath();
        ctx.arc(bx, by, (10 + pulse * 6) * scale, 0, Math.PI * 2);
        ctx.fill();
        rr(bx - 6 * scale, by - 6 * scale, 12 * scale, 12 * scale, 3 * scale, C.orbRed, null);
      };
    }

  /* ProbabilityOrb — центральный score вместо WebsiteTerminal */
    function ProbabilityOrb() {
      this.phase = 0;
      this.score = 45;
      this.draw = function () {
        this.phase = (frame * 0.06) % 200;
        var p = this.phase;
        if (p < 80) this.score = 45 + (p / 80) * 27;
        else if (p < 140) this.score = 72 - ((p - 80) / 60) * 27;
        else this.score = 45 + Math.sin((p - 140) * 0.2) * 3;

        var r = 34 * scale;
        ctx.strokeStyle = 'rgba(255,255,255,.08)';
        ctx.lineWidth = 6 * scale;
        ctx.beginPath();
        ctx.arc(cx, cy, r, 0, Math.PI * 2);
        ctx.stroke();

        var grad = ctx.createLinearGradient(cx - r, cy, cx + r, cy);
        grad.addColorStop(0, C.orbCore);
        grad.addColorStop(1, C.orbViolet);
        ctx.strokeStyle = grad;
        ctx.lineWidth = 5 * scale;
        ctx.lineCap = 'round';
        ctx.beginPath();
        ctx.arc(cx, cy, r, -Math.PI / 2, -Math.PI / 2 + (Math.PI * 2) * (this.score / 100));
        ctx.stroke();

        if (p > 155) {
          var glow = (p - 155) / 45;
          ctx.strokeStyle = 'rgba(121,242,255,' + (0.15 + glow * 0.35) + ')';
          ctx.lineWidth = 10 * scale;
          ctx.beginPath();
          ctx.arc(cx, cy, r + 8 * scale, 0, Math.PI * 2);
          ctx.stroke();
        }

        rr(cx - 18 * scale, cy - 10 * scale, 36 * scale, 20 * scale, 6 * scale, 'rgba(255,255,255,.06)', C.outline);
        ctx.fillStyle = '#fff';
        ctx.font = 'bold ' + (14 * scale) + 'px Inter,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText(Math.round(this.score) + '%', cx, cy + 5 * scale);

        /* ForecastGauge */
        var gx = cx - 55 * scale;
        var gy = cy + 42 * scale;
        rr(gx, gy, 110 * scale, 8 * scale, 4 * scale, 'rgba(255,255,255,.08)', null);
        var wAI = 0.45 + (p > 160 ? 0.12 : 0);
        ctx.fillStyle = C.orbCore;
        rr(gx, gy, 110 * scale * wAI, 8 * scale, 4 * scale, C.orbCore, null);
        ctx.fillStyle = C.orbAmber;
        rr(gx + 110 * scale * wAI + 2, gy, 28 * scale, 8 * scale, 4 * scale, C.orbAmber, null);
      };
      this.phaseIndex = function () { return this.phase; };
    }

    function Agent(x, y, color, role, dialogs) {
      this.x = x; this.y = y; this.color = color; this.role = role;
      this.dialogs = dialogs;
      this.dir = 1; this.bubble = null; this.bubbleTimer = Math.random() * 200;
      this.tx = cx; this.ty = cy + 30 * scale;
      this.draw = function () {
        var dx = this.tx - this.x;
        var dy = this.ty - this.y;
        var dist = Math.sqrt(dx * dx + dy * dy);
        if (dist > 8) {
          this.x += (dx / dist) * 0.35;
          this.y += (dy / dist) * 0.35;
        }
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(this.x, this.y - 10 * scale, 5 * scale, 0, Math.PI * 2);
        ctx.fill();
        rr(this.x - 6 * scale, this.y - 4 * scale, 12 * scale, 14 * scale, 4 * scale, this.color, C.outline);
        this.bubbleTimer--;
        if (this.bubbleTimer <= 0 && !this.bubble) {
          this.bubble = { text: this.dialogs[Math.floor(Math.random() * this.dialogs.length)], life: 90 };
          this.bubbleTimer = 180 + Math.random() * 120;
        }
        if (this.bubble) {
          this.bubble.life--;
          var bw = Math.min(120, this.bubble.text.length * 5.5) * scale;
          rr(this.x - bw / 2, this.y - 38 * scale, bw, 18 * scale, 6 * scale, C.bubbleBg, C.outline);
          ctx.fillStyle = '#e2e8f0';
          ctx.font = (7.5 * scale) + 'px Inter,sans-serif';
          ctx.textAlign = 'center';
          ctx.fillText(this.bubble.text, this.x, this.y - 25 * scale);
          if (this.bubble.life <= 0) this.bubble = null;
        }
      };
    }

    function createBubble(text, x, y) {
      if (frame % 90 !== 0) return;
      ctx.fillStyle = 'rgba(121,242,255,.12)';
      rr(x - 50 * scale, y - 12 * scale, 100 * scale, 22 * scale, 8 * scale, 'rgba(121,242,255,.12)', 'rgba(121,242,255,.35)');
      ctx.fillStyle = '#cfe3f9';
      ctx.font = (7 * scale) + 'px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(text, x, y + 3 * scale);
    }

    var signalArc = new SignalArc();
    var orb = new ProbabilityOrb();
    var ghost = new ManagerEstimateGhost();
    var risk = new RiskBeacon();
    var chips = [
      new DealChip(0.2, 62, '#1842', C.orbAmber),
      new DealChip(2.1, 70, '#902', C.orbRed),
      new DealChip(4.3, 58, '#331', C.orbGreen)
    ];
    var agents = [
      new Agent(24, ch - 20, C.agentYellow, '1_data_auditor', ['Гигиена CRM: 74% чистят данные', 'Стадии воронки не сходятся', 'Аудит полей BANT']),
      new Agent(48, ch - 28, C.agentGreen, '2_scoring_ml', ['ML на won/lost', 'Feature store обновлён', 'Score пересчитан']),
      new Agent(cw - 40, ch - 24, C.agentBlue, '3_risk_watch', ['Silent deal 21 день', 'Close date slip', 'At-risk флаг']),
      new Agent(cw - 68, ch - 18, C.agentPink, '4_sales_rep', ['Клиент думает — 90%', 'Точно закроем в квартале', 'Стадия КП = высокий шанс']),
      new Agent(cw - 24, ch - 36, C.agentPurple, '5_owner', ['Weighted pipeline 4,2 млн', 'Реальная выручка, не план', 'Forecast call готов'])
    ];

    function loop() {
      ctx.clearRect(0, 0, cw, ch);
      signalArc.draw();
      chips.forEach(function (c) { c.draw(); });
      var ph = orb.phaseIndex();
      ghost.draw(ph);
      risk.draw(ph > 100 && ph < 175);
      orb.draw();
      agents.forEach(function (a) {
        a.tx = cx + (a.role === '4_sales_rep' ? 55 : a.role === '5_owner' ? -50 : 0) * scale;
        a.ty = cy + (a.role === '1_data_auditor' ? 38 : 28) * scale;
        a.draw();
      });
      if (ph > 50 && ph < 55) createBubble('Сигналы CRM → scoring engine', cx, cy - 52 * scale);
      if (ph > 105 && ph < 110) createBubble('Риск: нет активности 21 день', cx - 60 * scale, cy - 20 * scale);
      if (ph > 130 && ph < 135) createBubble('Next step: звонок ЛПР', cx + 55 * scale, cy + 10 * scale);
      if (ph > 165 && ph < 170) createBubble('AI-weighted forecast синхронизирован', cx, cy + 58 * scale);
      frame++;
      requestAnimationFrame(loop);
    }
  resize();
    loop();
  });
})();
</script>

<div class="vna-content">

  <!-- INTRO -->
  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai прогноз сделки</p>
          <p><strong>Коротко:</strong> AI-прогноз вероятности закрытия сделки в CRM — модуль предиктивной аналитики (deal scoring), который для каждой открытой сделки рассчитывает объективную вероятность выигрыша, риски срыва и следующий лучший шаг. Nero Network внедряет такой модуль под ключ в amoCRM, Битрикс24 и другие CRM — с аудитом данных, обучением модели на вашей истории won/lost и дашбордом для собственника.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые ориентиры">
          <div class="vna-kpi-card">
            <div class="kv">7%</div>
            <div class="kl">команд с точностью прогноза ≥90%</div>
            <div class="ks">Gartner Sales AI</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">74%</div>
            <div class="kl">команд с AI приоритизируют data hygiene</div>
            <div class="ks">Salesforce 2026</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">200+</div>
            <div class="kl">закрытых сделок — минимум для ML-пилота</div>
            <div class="ks">порог Einstein</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">250–900К</div>
            <div class="kl">ориентир чека внедрения под ключ</div>
            <div class="ks">проект Nero Network</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#problema">Проблема</a>
        <a href="#reshenie">Решение</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#integraciya">Интеграции</a>
        <a href="#etapy">Внедрение</a>
        <a href="#kalkulyator">Калькулятор</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Аудит</a>
      </nav>
    </div>
  </div>

  <!-- БЛОК 1: ПРОБЛЕМА -->
  <section class="vna-section" id="problema">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Боль ЦА</span>
        <h2>Почему прогноз продаж в CRM не сходится с реальной выручкой</h2>
        <p>Если у компании есть CRM и длинный цикл продаж, почти всегда есть одна и та же сцена: на совете директоров менеджеры показывают «оптимистичную» воронку, а через квартал выручка не дотягивает до плана.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <p><strong>Определение:</strong> точность прогноза продаж — насколько прогнозируемая выручка (pipeline forecast) совпадает с фактическим закрытием сделок в отчётном периоде. По данным Gartner, только <strong>7%</strong> sales-организаций достигают точности прогноза <strong>≥90%</strong>; медиана — <strong>70–79%</strong> (<a href="https://www.gartner.com/en/sales/topics/sales-ai" target="_blank" rel="noopener noreferrer">Gartner Sales AI</a>). <strong>69%</strong> sales ops leaders отмечают: прогнозировать сегодня <strong>сложнее</strong>, чем три года назад.</p>
      </div>

      <div class="vna-grid-2" style="margin-top:28px;">
        <div class="vna-card nero-ai-reveal" id="subektivnye-ocenki">
          <h3>Субъективные оценки менеджеров и «оптимистичная» воронка</h3>
          <p>Менеджеры завышают прогноз — не из злого умысла, а из логики «сделка жива, клиент думает». В CRM это выглядит как высокая вероятность на стадии «Коммерческое предложение» или сделки, которые месяцами не двигаются, но не переводятся в lost.</p>
          <p>Встроенный скоринг amoCRM — <strong>детерминированная формула</strong> по этапам и полям, а не нейросеть на вашей истории (<a href="https://www.amocrm.ru/support/digitalpipeline/scoring" target="_blank" rel="noopener noreferrer">amoCRM support</a>).</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="sobstvennik-plan">
          <h3>Собственник видит план, а не вероятность закрытия сделок</h3>
          <p>Для собственника и CFO прогноз выручки — основа для ФОТ, закупок и инвестиций. Когда менеджеры завышают прогноз, собственник не видит реальную выручку: weighted pipeline считается по «ощущениям» reps, а не по поведению клиента.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="dlinnyj-cikl">
          <h3>Длинный цикл продаж: сделки «висят» без сигнала о риске срыва</h3>
          <p>В длинном цикле критичны давность контакта, вовлечение ЛПР, сдвиги close date, упоминание конкурента. Без AI-прогноза сделки «висят» без сигнала: silent deal, close date slip, no economic buyer.</p>
          <p>Salesforce State of Sales 2026: <strong>46%</strong> sales pros с AI-агентами отмечают, что проблемы качества данных <strong>вредят продажам</strong>; <strong>19%</strong> данных <strong>недоступны</strong> из-за silos (<a href="https://www.salesforce.com/en-us/wp-content/uploads/sites/4/documents/reports/sales/salesforce-state-of-sales-report-2026.pdf" target="_blank" rel="noopener noreferrer">PDF отчёта</a>).</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-2">
          <p><strong>Итог блока:</strong> боль не в «нет CRM», а в том, что прогноз строится по стадии воронки, хотя реальная динамика у сделок разная. AI-прогноз сделки в CRM закрывает разрыв между «планом менеджера» и вероятностью закрытия.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- БЛОК 2: РЕШЕНИЕ -->
  <section class="vna-section vna-section-alt" id="reshenie">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Оффер</span>
        <h2>AI-прогноз вероятности сделки в CRM: что получает бизнес</h2>
        <p>Модуль predictive analytics / deal scoring: вероятность won (0–100%) на основе исторических паттернов и текущих сигналов, а не субъективной оценки менеджера.</p>
      </div>

      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card" id="veroyatnost-realtime">
          <h3>Вероятность закрытия по каждой сделке в реальном времени</h3>
          <p>AI-вероятность пересчитывается при изменении воронки: смена стадии, новый звонок, сдвиг close date. Поле <code>AI_Probability</code> — score, обученный на ваших won/lost. Weighted pipeline: Σ(сумма × AI_Probability).</p>
          <p>Аналог: Salesforce Einstein Opportunity Scoring — score <strong>1–99</strong> с positive/negative factors (<a href="https://c1.sfdcstatic.com/content/dam/web/en_us/www/documents/datasheets/Sales-Cloud-Einstein-Datasheets.pdf" target="_blank" rel="noopener noreferrer">Einstein datasheet</a>).</p>
        </div>
        <div class="vna-card nero-ai-delay-1" id="riski-sryva">
          <h3>Риски срыва и факторы, которые «тянут» прогноз вниз</h3>
          <p>Risk Monitor: silent deal, close date slip, competitor mention, отсутствие economic buyer. Explainability — top-3 факторы (+ и −) для каждого score.</p>
        </div>
        <div class="vna-card nero-ai-delay-2" id="next-best-step">
          <h3>Следующий лучший шаг для менеджера и РОПа</h3>
          <p>Next Best Action — звонок ЛПР, отправка кейса, эскалация. При падении score &gt;15 п.п. за 7 дней — автозадача и алерт РОПу. <strong>91%</strong> sales pros в State of Sales 2026: AI помогает в sales planning.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;color:var(--vna-muted);"><strong>Итог:</strong> ai прогноз продаж перестаёт быть «отчётом на совете» — он живёт в CRM и обновляется с каждым касанием клиента.</p>
    </div>
  </section>

  <!-- CTA-1: после #reshenie (Артур) -->
  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-reshenie">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Проверьте, насколько ваша воронка «врёт»</p>
        <p class="ym-cta-block__sub">Бесплатный <strong>аудит прогноза продаж</strong>: сравним прогноз менеджеров с фактом закрытия, оценим качество данных CRM и скажем, готовы ли вы к AI scoring. Deliverable — отчёт за 3–5 дней.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Оценить воронку</a>
      </div>
    </div>
  </div>

  <!-- ================================================
       БОРИС: визуальный блок воронки / deal scoring (НЕ HERO)
       ================================================ -->
  <section id="ai-prognoz-sdelki-crm-boris-block" class="aps-root" aria-label="Анимация: воронка сделок и расхождение прогноза менеджера vs AI-weighted pipeline">
<style>
/* === БОРИС: prefix aps-, scoped внутри #ai-prognoz-sdelki-crm-boris-block === */
#ai-prognoz-sdelki-crm-boris-block.aps-root{
  padding:clamp(48px,6vw,72px) 0;
  background:linear-gradient(180deg,rgba(255,255,255,.02),rgba(121,242,255,.04));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}
#ai-prognoz-sdelki-crm-boris-block .aps-cnt{
  width:min(1160px,calc(100% - 40px));
  margin:0 auto;
}
#ai-prognoz-sdelki-crm-boris-block .aps-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:24px;
  overflow:hidden;
  box-shadow:0 8px 48px rgba(0,0,0,.35),0 0 0 1px rgba(121,242,255,.12);
  min-height:min(520px,70vh);
  background:#f8fafc;
}
@media(max-width:1024px){
  #ai-prognoz-sdelki-crm-boris-block .aps-card{grid-template-columns:1fr;min-height:auto;}
}
#ai-prognoz-sdelki-crm-boris-block .aps-lft{
  padding:clamp(32px,4vw,48px) clamp(24px,3vw,40px);
  display:flex;
  flex-direction:column;
  justify-content:center;
  background:#fff;
}
#ai-prognoz-sdelki-crm-boris-block .aps-ey{
  display:inline-flex;align-items:center;gap:7px;
  font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;
  color:#0e7490;margin:0 0 14px;
}
#ai-prognoz-sdelki-crm-boris-block .aps-ey::before{
  content:'';display:inline-block;width:20px;height:2px;background:#22d3ee;border-radius:1px;
}
#ai-prognoz-sdelki-crm-boris-block .aps-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;
  line-height:1.28;margin:0 0 18px;
}
#ai-prognoz-sdelki-crm-boris-block .aps-ul{
  list-style:none;margin:0 0 22px;padding:0;
  display:flex;flex-direction:column;gap:10px;
}
#ai-prognoz-sdelki-crm-boris-block .aps-ul li{
  display:flex;align-items:flex-start;gap:10px;
  font-size:14.5px;line-height:1.55;color:#334155;
}
#ai-prognoz-sdelki-crm-boris-block .aps-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(14,165,233,.12);color:#0369a1;
  display:flex;align-items:center;justify-content:center;
  font-size:11px;font-weight:700;font-style:normal;margin-top:1px;
}
#ai-prognoz-sdelki-crm-boris-block .aps-pills{
  display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;
}
#ai-prognoz-sdelki-crm-boris-block .aps-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-prognoz-sdelki-crm-boris-block .aps-pl-g{background:rgba(34,197,94,.1);color:#15803d;border:1.5px solid rgba(34,197,94,.25);}
#ai-prognoz-sdelki-crm-boris-block .aps-pl-a{background:rgba(245,158,11,.1);color:#b45309;border:1.5px solid rgba(245,158,11,.28);}
#ai-prognoz-sdelki-crm-boris-block .aps-pl-c{background:rgba(6,182,212,.1);color:#0e7490;border:1.5px solid rgba(6,182,212,.25);}
#ai-prognoz-sdelki-crm-boris-block .aps-foot{
  font-size:13.5px;color:#64748b;font-style:italic;margin:0;
}
#ai-prognoz-sdelki-crm-boris-block .aps-rgt{
  position:relative;min-height:380px;
  background:linear-gradient(145deg,#f0f9ff 0%,#e0f2fe 45%,#f8fafc 100%);
  border-left:1px solid rgba(14,165,233,.15);
}
@media(max-width:1024px){
  #ai-prognoz-sdelki-crm-boris-block .aps-rgt{border-left:none;border-top:1px solid rgba(14,165,233,.15);min-height:360px;}
}
#aps-deal-funnel-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>

<div class="aps-cnt">
  <div class="aps-card">
    <div class="aps-lft">
      <span class="aps-ey">Воронка в цифрах</span>
      <h3 class="aps-h3">Менеджер видит план — AI видит вероятность закрытия по каждой сделке</h3>
      <ul class="aps-ul">
        <li><span class="aps-ic">1</span>Сделки движутся по стадиям воронки — у каждой свой AI-score, не «60% для всех на КП»</li>
        <li><span class="aps-ic">2</span>Красные метки — at-risk: silent deal, сдвиг close date, нет ЛПР</li>
        <li><span class="aps-ic">3</span>Синяя полоса — weighted pipeline (Σ сумма × probability)</li>
        <li><span class="aps-ic">≠</span>Серая полоса — «оптимистичный» прогноз менеджеров — разрыв виден сразу</li>
      </ul>
      <div class="aps-pills">
        <span class="aps-pl aps-pl-c">AI-weighted 4,2 млн ₽</span>
        <span class="aps-pl aps-pl-a">12 at-risk</span>
        <span class="aps-pl aps-pl-g">78% точность (мес.)</span>
      </div>
      <p class="aps-foot">Дальше разберём, какие данные CRM нужны для обучения модели →</p>
    </div>
    <div class="aps-rgt">
      <canvas id="aps-deal-funnel-canvas" aria-label="Анимация воронки: сделки со score вероятности, сравнение прогноза менеджера и AI-weighted pipeline" role="img"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('aps-deal-funnel-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, t = 0;

  var STAGES = ['Лид','Квалиф.','КП','Переговоры','Закрытие'];
  var STAGE_COLORS = ['#94a3b8','#60a5fa','#8b5cf6','#22d3ee','#22c55e'];

  var deals = [];
  function seedDeals(){
    deals = [];
    for (var i = 0; i < 14; i++) {
      deals.push({
        stage: Math.floor(Math.random() * 4),
        yOff: Math.random(),
        score: 0.35 + Math.random() * 0.55,
        risk: Math.random() < 0.22,
        speed: 0.003 + Math.random() * 0.004,
        amt: (80 + Math.random() * 420) | 0
      });
    }
  }
  seedDeals();

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle = fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle = stroke; ctx.lineWidth = 1.2; ctx.stroke(); }
  }

  function scoreColor(s, risk){
    if (risk) return '#ef4444';
    if (s >= 0.65) return '#22c55e';
    if (s >= 0.4) return '#f59e0b';
    return '#94a3b8';
  }

  function drawFunnel(fx, fy, fw, fh){
    var stepH = fh / STAGES.length;
    for (var i = 0; i < STAGES.length; i++) {
      var inset = i * (fw * 0.06);
      var sw = fw - inset * 2;
      var sy = fy + i * stepH;
      rr(fx + inset, sy + 4, sw, stepH - 8, 8, 'rgba(255,255,255,.75)', STAGE_COLORS[i]);
      ctx.fillStyle = '#0f172a';
      ctx.font = 'bold 10px system-ui,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(STAGES[i], fx + inset + 10, sy + stepH * 0.55);
    }
  }

  function drawBars(bx, by, bw, bh){
    var mgr = 0.82 + Math.sin(t * 0.02) * 0.03;
    var ai = 0.58 + Math.sin(t * 0.015 + 1) * 0.02;
    ctx.fillStyle = '#64748b';
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Прогноз менеджеров', bx, by - 4);
    rr(bx, by, bw * mgr, 14, 4, '#cbd5e1', '#94a3b8');
    ctx.fillStyle = '#0e7490';
    ctx.fillText('AI-weighted', bx, by + 28);
    rr(bx, by + 34, bw * ai, 14, 4, '#22d3ee', '#0891b2');
    var gap = (mgr - ai) * 100;
    ctx.fillStyle = '#b45309';
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.fillText('Разрыв ~' + gap.toFixed(0) + '%', bx + bw * ai + 8, by + 44);
  }

  function tick(){
    t++;
    ctx.clearRect(0, 0, W, H);

    var funnelW = W * 0.42;
    var funnelH = H * 0.72;
    var fx = W * 0.06;
    var fy = H * 0.12;
    drawFunnel(fx, fy, funnelW, funnelH);

    var stepH = funnelH / STAGES.length;
    deals.forEach(function(d){
      d.stage += d.speed;
      if (d.stage >= 3.8) { d.stage = 0; d.score = 0.3 + Math.random() * 0.6; d.risk = Math.random() < 0.2; }
      var si = Math.min(4, Math.floor(d.stage));
      var inset = si * (funnelW * 0.06);
      var sw = funnelW - inset * 2;
      var px = fx + inset + 12 + (sw - 24) * d.yOff;
      var py = fy + si * stepH + stepH * 0.35 + Math.sin(t * 0.05 + d.yOff * 10) * 3;
      var r = 9;
      var col = scoreColor(d.score, d.risk);
      ctx.beginPath();
      ctx.arc(px, py, r, 0, Math.PI * 2);
      ctx.fillStyle = col;
      ctx.fill();
      if (d.risk) {
        ctx.strokeStyle = 'rgba(239,68,68,.5)';
        ctx.lineWidth = 2 + Math.sin(t * 0.1) * 1;
        ctx.stroke();
      }
      ctx.fillStyle = '#fff';
      ctx.font = 'bold 8px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      ctx.fillText(Math.round(d.score * 100) + '%', px, py);
    });

    drawBars(W * 0.55, H * 0.2, W * 0.38, 60);

    ctx.fillStyle = '#0f172a';
    ctx.font = 'bold 12px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Сделки в воронке', fx, fy - 8);
    ctx.fillStyle = '#64748b';
    ctx.font = '10px system-ui,sans-serif';
    ctx.fillText('Демо · deal scoring', W * 0.55, H * 0.88);

    requestAnimationFrame(tick);
  }
  tick();
})();
</script>
  </section>

  <!-- БЛОК 3: КАК РАБОТАЕТ -->
  <section class="vna-section" id="kak-rabotaet">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Механика</span>
        <h2>Как работает AI scoring лидов и сделок в CRM</h2>
        <p>Deal scoring / opportunity scoring — оценка вероятности закрытия уже открытой сделки. Для B2B с длинным циклом критичен второй уровень.</p>
      </div>

      <div class="vna-card nero-ai-reveal" id="dannye-crm">
        <h3>Какие данные CRM нужны для обучения модели</h3>
        <ul>
          <li><strong>200+</strong> закрытых сделок за 12 месяцев (не менее 20% won и 20% lost)</li>
          <li>единые определения стадий воронки; история смены стадий (audit log)</li>
          <li>сумма, источник, ответственный, даты создания и закрытия</li>
        </ul>
        <p>Желательно: 12–24 месяца данных, логи звонков и переписок, BANT/MEDDIC, win/loss reason. AI не исправляет грязные данные — он <strong>масштабирует ошибку</strong> (<a href="https://www.oliv.ai/blog/ai-crm-trust-governance-risk-revops-evaluation" target="_blank" rel="noopener noreferrer">Oliv.ai</a>). <strong>74%</strong> команд с AI приоритизируют data hygiene.</p>
      </div>

      <div class="vna-grid-2" style="margin-top:24px;">
        <div class="vna-card nero-ai-reveal" id="signaly-modeli">
          <h3>Сигналы модели: стадия, давность контакта, источник, сумма, история коммуникаций</h3>
          <p><strong>Структурные:</strong> стадия и время на стадии; сумма, маржа; источник; сдвиги close date; заполненность BANT/MEDDIC.</p>
          <p><strong>Поведенческие:</strong> давность контакта; касания за 14 дней; вовлечённость ЛПР; следующий шаг с датой.</p>
          <p><strong>Коммуникационные:</strong> конкурент, бюджет, тональность, возражения по цене (NLP).</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="pereсchet">
          <h3>Как AI пересчитывает вероятность при изменении воронки</h3>
          <ol style="padding-left:1.2em;color:var(--vna-muted);line-height:1.7;font-size:14.5px;">
            <li>Сбор данных: CRM webhooks + активность</li>
            <li>Feature store: таблица «сделка × день»</li>
            <li>Scoring engine: ML или гибрид ML + LLM</li>
            <li>Explainability: top-3 факторы</li>
            <li>Action layer: next best action</li>
            <li>Forecast layer: агрегация по менеджерам</li>
            <li>Feedback loop: won/lost дообучает модель</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- БЛОК 4: ИНТЕГРАЦИИ -->
  <section class="vna-section vna-section-alt" id="integraciya">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">CRM</span>
        <h2>Интеграция AI-прогноза сделки с вашей CRM</h2>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead>
            <tr><th>CRM</th><th>Что из коробки</th><th>Кастомный AI-модуль Nero Network</th></tr>
          </thead>
          <tbody>
            <tr><td>amoCRM</td><td>Rule-based скоринг по формуле</td><td>ML на won/lost + NLP по коммуникациям</td></tr>
            <tr><td>Битрикс24</td><td>CoPilot, формулы, детерминированный скоринг</td><td>Поля AI_Probability, Risk_Flags, Next_Step</td></tr>
            <tr><td>Salesforce</td><td>Einstein Opportunity Scoring (при лицензии)</td><td>Кастом для среднего B2B без enterprise-ценника</td></tr>
            <tr><td>BPMSoft, 1С:CRM</td><td>Базовая аналитика</td><td>REST API + score в карточку</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-grid-2" style="margin-top:28px;">
        <div class="vna-card nero-ai-reveal">
          <h3>Что входит в интеграцию</h3>
          <p>Поля <code>AI_Probability</code>, <code>AI_Risk_Flags</code>, <code>AI_Next_Step</code>; webhooks; дашборд committed / best case / AI-weighted; Telegram-алерты РОПу.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1">
          <h3>Внедрение без остановки отдела продаж</h3>
          <p>Пилот на исторических сделках — score в read-only, затем workflow. Human override с комментарием — governance, не диктатура алгоритма.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- БЛОК 5: ЭТАПЫ -->
  <section class="vna-section" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Под ключ</span>
        <h2>Внедрение AI-прогноза сделки под ключ: этапы и сроки</h2>
      </div>
      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card" id="audit-faza">
          <div class="vna-eyebrow">Фаза 0 · 3–5 дней</div>
          <h3>Аудит данных CRM и качества воронки</h3>
          <p>Выгрузка 6–24 мес. сделок; сравнение прогноз vs факт; индекс качества данных. Лид-магнит <strong>«Аудит прогноза продаж»</strong>.</p>
        </div>
        <div class="vna-card nero-ai-delay-1" id="mvp-faza">
          <div class="vna-eyebrow">Фаза 1 · 4–6 недель</div>
          <h3>Обучение модели и пилот</h3>
          <p>CRM API; baseline на 500+ закрытых сделках; поля score + дашборд weighted pipeline для собственника.</p>
        </div>
        <div class="vna-card nero-ai-delay-2" id="governance-faza">
          <div class="vna-eyebrow">Фаза 2–3</div>
          <h3>Запуск, обогащение, сопровождение</h3>
          <p>Телефония, NLP; MAPE vs факт; ретрейн раз в квартал. MVP у интеграторов — 2–4 недели; полный контур — 8–12 недель.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA-2: после #etapy (Артур) -->
  <div class="vna-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать scoring до старта проекта?</p>
        <p class="ym-cta-block__sub">Перед внедрением AI-прогноза полезно разобраться в data hygiene, n8n и human-in-the-loop — так РОП и собственник быстрее валидируют модель на forecast call. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
      </div>
    </aside>
  </div>

  <!-- БЛОК 6: КАЛЬКУЛЯТОР -->
  <section class="vna-section vna-section-alt" id="kalkulyator">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Оценка воронки</span>
        <h2>Калькулятор: оцените потенциал точности прогноза в вашей CRM</h2>
        <p>Ориентир потенциала точности и <strong>стоимость ошибки</strong> — если завышение прогноза ведёт к перерасходу ФОТ и закупок.</p>
      </div>

      <div class="vna-card nero-ai-reveal" id="aps-forecast-calc">
<style>
#aps-forecast-calc .aps-calc-grid{
  display:grid;grid-template-columns:1fr 1fr;gap:28px;align-items:start;
}
@media(max-width:768px){#aps-forecast-calc .aps-calc-grid{grid-template-columns:1fr;}}
#aps-forecast-calc .aps-calc-field{margin-bottom:18px;}
#aps-forecast-calc label{display:block;font-size:13px;font-weight:600;color:var(--vna-soft);margin-bottom:6px;}
#aps-forecast-calc input,#aps-forecast-calc select{
  width:100%;padding:12px 14px;border-radius:12px;
  border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);
  color:var(--vna-heading);font-size:15px;
}
#aps-forecast-calc input:focus,#aps-forecast-calc select:focus{
  outline:none;border-color:rgba(121,242,255,.45);box-shadow:0 0 0 3px rgba(121,242,255,.12);
}
#aps-forecast-calc .aps-calc-result{
  background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));
  border:1px solid rgba(121,242,255,.2);border-radius:18px;padding:24px;
}
#aps-forecast-calc .aps-calc-kpi{
  font-size:clamp(28px,4vw,40px);font-weight:900;color:var(--vna-heading);
  letter-spacing:-.04em;line-height:1.1;margin:8px 0 4px;
}
#aps-forecast-calc .aps-calc-note{font-size:13px;color:var(--vna-muted);line-height:1.6;}
#aps-forecast-calc .aps-calc-bar-wrap{margin:16px 0;}
#aps-forecast-calc .aps-calc-bar-label{font-size:12px;color:var(--vna-muted);margin-bottom:4px;}
#aps-forecast-calc .aps-calc-bar{height:10px;border-radius:99px;background:rgba(255,255,255,.08);overflow:hidden;}
#aps-forecast-calc .aps-calc-bar span{display:block;height:100%;border-radius:99px;transition:width .4s ease;}
</style>

        <div class="aps-calc-grid">
          <form class="aps-calc-form" id="aps-calc-form" onsubmit="return false;">
            <div class="aps-calc-field">
              <label for="aps-deals">Число открытых сделок в pipeline</label>
              <input type="number" id="aps-deals" name="deals" min="5" max="5000" value="120" required>
            </div>
            <div class="aps-calc-field">
              <label for="aps-pipeline">Сумма воронки, млн ₽ (прогноз менеджеров)</label>
              <input type="number" id="aps-pipeline" name="pipeline" min="0.1" max="500" step="0.1" value="8.5" required>
            </div>
            <div class="aps-calc-field">
              <label for="aps-crm">CRM</label>
              <select id="aps-crm" name="crm">
                <option value="amocrm">amoCRM</option>
                <option value="bitrix24" selected>Битрикс24</option>
                <option value="salesforce">Salesforce</option>
                <option value="other">Другая CRM с API</option>
              </select>
            </div>
            <div class="aps-calc-field">
              <label for="aps-cycle">Средний цикл сделки, дней</label>
              <input type="number" id="aps-cycle" name="cycle" min="7" max="540" value="90" required>
            </div>
            <div class="aps-calc-field">
              <label for="aps-stale">Доля сделок без активности &gt;30 дней, %</label>
              <input type="number" id="aps-stale" name="stale" min="0" max="100" value="35" required>
            </div>
            <div class="aps-calc-field">
              <label for="aps-gap">Завышение прогноза vs факт за квартал, %</label>
              <input type="number" id="aps-gap" name="gap" min="0" max="80" value="22" required>
            </div>
          </form>

          <div class="aps-calc-result" aria-live="polite" id="aps-calc-result">
            <p class="aps-calc-note">Результат (ориентир, не гарантия):</p>
            <p class="aps-calc-kpi" id="aps-calc-error-cost">—</p>
            <p class="aps-calc-note" id="aps-calc-error-label">Стоимость ошибки прогноза за квартал</p>
            <div class="aps-calc-bar-wrap">
              <div class="aps-calc-bar-label">Потенциал точности с AI-weighted (ориентир)</div>
              <div class="aps-calc-bar"><span id="aps-calc-accuracy-bar" style="width:72%;background:linear-gradient(90deg,#22d3ee,#8b5cf6);"></span></div>
              <p class="aps-calc-note" id="aps-calc-accuracy-text">~72% — при гигиене данных и 200+ закрытых сделках</p>
            </div>
            <div class="aps-calc-bar-wrap">
              <div class="aps-calc-bar-label">AI-weighted pipeline vs прогноз менеджеров</div>
              <div class="aps-calc-bar"><span id="aps-calc-weighted-bar" style="width:65%;background:#22c55e;"></span></div>
              <p class="aps-calc-note" id="aps-calc-weighted-text">—</p>
            </div>
            <p style="margin-top:20px;">
              <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Оценить воронку</a>
            </p>
          </div>
        </div>
      </div>

<script>
(function(){
  var form = document.getElementById('aps-calc-form');
  if (!form) return;
  var ids = ['aps-deals','aps-pipeline','aps-crm','aps-cycle','aps-stale','aps-gap'];
  function num(id){ return parseFloat(document.getElementById(id).value) || 0; }
  function recalc(){
    var deals = num('aps-deals');
    var pipeline = num('aps-pipeline');
    var cycle = num('aps-cycle');
    var stale = num('aps-stale') / 100;
    var gap = num('aps-gap') / 100;
    var crm = document.getElementById('aps-crm').value;
    var errorMln = pipeline * gap;
    var errorCost = errorMln * 1000000;
    var fmt = errorCost >= 1e6
      ? (errorCost / 1e6).toFixed(1).replace('.', ',') + ' млн ₽'
      : Math.round(errorCost / 1000) + ' тыс. ₽';
    document.getElementById('aps-calc-error-cost').textContent = fmt;
    document.getElementById('aps-calc-error-label').textContent =
      'Ориентир перерасхода из-за завышения прогноза на ' + Math.round(gap * 100) + '% (ФОТ, закупки, план)';
    var baseAcc = 68;
    if (deals >= 200) baseAcc += 6;
    if (stale < 0.25) baseAcc += 4;
    if (cycle > 120) baseAcc -= 3;
    if (crm === 'salesforce' || crm === 'bitrix24') baseAcc += 2;
    baseAcc = Math.min(82, Math.max(58, baseAcc));
    document.getElementById('aps-calc-accuracy-bar').style.width = baseAcc + '%';
    document.getElementById('aps-calc-accuracy-text').textContent =
      '~' + baseAcc + '% — ориентир при data hygiene; медиана рынка 70–79% (Gartner)';
    var weighted = pipeline * (1 - gap * 0.65);
    var wPct = pipeline > 0 ? Math.round((weighted / pipeline) * 100) : 0;
    document.getElementById('aps-calc-weighted-bar').style.width = wPct + '%';
    document.getElementById('aps-calc-weighted-text').textContent =
      'AI-weighted ~' + weighted.toFixed(1).replace('.', ',') + ' млн ₽ vs ' + pipeline.toFixed(1).replace('.', ',') + ' млн ₽ у менеджеров';
  }
  ids.forEach(function(id){
    var el = document.getElementById(id);
    if (el) el.addEventListener('input', recalc);
    if (el && el.tagName === 'SELECT') el.addEventListener('change', recalc);
  });
  recalc();
})();
</script>
    </div>
  </section>

  <!-- БЛОК 7: СТОИМОСТЬ -->
  <section class="vna-section" id="stoimost">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Коммерция</span>
        <h2>Сколько стоит внедрение AI-прогноза сделки в CRM</h2>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Компонент</th><th>Что включено</th></tr></thead>
          <tbody>
            <tr><td>Аудит данных и воронки</td><td>Выгрузка, анализ won/lost, индекс качества</td></tr>
            <tr><td>Интеграция CRM</td><td>API, webhooks, кастомные поля, дашборд</td></tr>
            <tr><td>Модель ML + NLP</td><td>Обучение, explainability, ретрейн</td></tr>
            <tr><td>Телефония / мессенджеры</td><td>Транскрипция, NLP по коммуникациям</td></tr>
            <tr><td>Governance</td><td>MAPE, версионирование, сопровождение</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-grid-2" style="margin-top:28px;">
        <div class="vna-card nero-ai-reveal">
          <h3>Ориентир чека: 250–900 тыс. ₽</h3>
          <p>MVP без телефонии — нижняя часть диапазона; полный контур с governance — верхняя. Gartner: медиана точности <strong>70–79%</strong>; AI-augmented forecasting улучшает actionability, но не даёт 99% без данных.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1">
          <h3>AI-прогноз сделки для малого бизнеса и среднего B2B</h3>
          <p>&lt;200 закрытых сделок — rule-based + пилот на сегменте. Основная ЦА: собственник с CRM, 200+ сделок, боль «не вижу реальную выручку». Заказать через CTA «Оценить воронку».</p>
        </div>
      </div>
    </div>
  </section>

  <!-- БЛОК 8: КЕЙСЫ -->
  <section class="vna-section vna-section-alt" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Эффекты</span>
        <h2>Примеры внедрения AI-прогноза сделки: кейсы и эффекты</h2>
        <p>Публичных независимых кейсов на российском рынке мало — ниже проверенные ориентиры и честная рамка.</p>
      </div>
      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card"><h3>Снижение «пустых» сделок</h3><p>После 1–2 циклов pipeline review с AI-score менеджеры закрывают lost или активируют at-risk.</p></div>
        <div class="vna-card"><h3>Прогноз ближе к факту</h3><p>Обзоры указывают на <strong>15–40%</strong> улучшение vs ручной roll-up — <strong>при чистых данных</strong>.</p></div>
        <div class="vna-card"><h3>Дисциплина без микроменеджмента</h3><p>Score + explainability + next step; reps тратят <strong>&gt;50%</strong> на non-selling (State of Sales 2026).</p></div>
      </div>
      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-table">
          <thead><tr><th>Метод</th><th>Плюсы</th><th>Минусы</th></tr></thead>
          <tbody>
            <tr><td>Прогноз менеджера</td><td>Учитывает контекст</td><td>Завышение, субъективность</td></tr>
            <tr><td>Стадия воронки</td><td>Простой roll-up</td><td>Все на КП = 60%</td></tr>
            <tr><td>Rule-based скоринг CRM</td><td>Быстрый старт</td><td>Не учится на истории</td></tr>
            <tr><td><strong>AI-weighted (ML)</strong></td><td>Объективный, explainable</td><td>Нужны данные и аудит</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- БЛОК 9: ТРЕНД 2026 -->
  <section class="vna-section" id="trend-2026">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">2026</span>
        <h2>Почему в 2026 AI-прогноз в CRM — не опция, а гигиена продаж</h2>
      </div>
      <div class="vna-card nero-ai-reveal">
        <p>State of Sales 2026: <strong>4 050</strong> sales professionals, <strong>22</strong> страны. <strong>54%</strong> уже используют AI-агентов; <strong>51%</strong> leaders: silos тормозят AI; <strong>84%</strong> планируют консолидацию стека.</p>
        <p><em>«The secret sauce for sales AI agents is unified data… Otherwise, you get garbage outputs.»</em> — Adam Alfano, Salesforce.</p>
        <p>Тренд: data readiness → agentic actions → единый прогноз в CRM. Рынок CRM в СНГ ~44,1 млрд ₽ (+25% г/г); AI в продажах — драйвер №1.</p>
      </div>
    </div>
  </section>

  <!-- БЛОК 10: РИСКИ -->
  <section class="vna-section vna-section-alt" id="riski">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Честно о рисках</span>
        <h2>Риски внедрения: грязные данные, сопротивление команды, переобучение модели</h2>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3>Минимальные требования к истории сделок</h3>
          <p>200+ закрытых сделок за 12 мес.; единые стадии; audit log. Мало данных — rule-based + пилот на сегменте.</p>
        </div>
        <div class="vna-card">
          <h3>Внедрение без штата разработчиков</h3>
          <p>Nero Network: Make/n8n + amoCRM/Bitrix24 + YandexGPT/OpenAI + телефония; n8n self-hosted в РФ, 152-ФЗ.</p>
        </div>
      </div>
      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:24px;">
        <table class="vna-table">
          <thead><tr><th>Возражение</th><th>Ответ</th></tr></thead>
          <tbody>
            <tr><td>«У нас и так скоринг в CRM»</td><td>Встроенный — формула; AI учится на won/lost</td></tr>
            <tr><td>«Менеджеры не заполняют CRM»</td><td>AI снижает ручной ввод через транскрипцию</td></tr>
            <tr><td>«AI выдумает цифры»</td><td>Explainability + human override</td></tr>
            <tr><td>«Данные уйдут в облако»</td><td>n8n self-hosted в РФ, 152-ФЗ</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- БЛОК 11: FAQ -->
  <section class="vna-section" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">FAQ</span>
        <h2>Частые вопросы об AI-прогнозе вероятности сделки в CRM</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item" id="faq-chto-takoe">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Что такое AI-прогноз вероятности сделки в CRM?</div>
          <div class="vna-faq-a"><p>Модуль deal scoring: ML рассчитывает вероятность won на основе паттернов и сигналов (стадия, активность, коммуникации). Результат — score в карточке и weighted forecast для собственника.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-scoring-vs-deal">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Чем AI scoring лидов отличается от прогноза сделки?</div>
          <div class="vna-faq-a"><p>Scoring лидов — конверсия лида в сделку. Deal scoring — вероятность закрытия открытой opportunity. Для длинного цикла критичен второй уровень.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-kak-vnedrit">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI-прогноз сделки в существующую CRM?</div>
          <div class="vna-faq-a"><p>Аудит → API → обучение на won/lost → поля score + дашборд → пилот read-only → workflow → governance. MVP — 4–6 недель.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-skolko-stoit">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит внедрение AI-прогноза сделки?</div>
          <div class="vna-faq-a"><p>Ориентир <strong>250–900 тыс. ₽</strong> в зависимости от интеграций и NLP. Точная смета после аудита воронки.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-bez-programmistov">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли внедрить без программистов в штате?</div>
          <div class="vna-faq-a"><p>Да. Интеграция, модель и дашборд — на стороне Nero Network. Клиент: доступ к CRM, валидация стадий, обучение менеджеров.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-crm-support">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Какие CRM поддерживают deal scoring?</div>
          <div class="vna-faq-a"><p>amoCRM, Битрикс24, Salesforce, HubSpot, BPMSoft, 1С:CRM — через REST API и кастомные поля.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-sobstvennik">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как AI помогает собственнику видеть реальную выручку?</div>
          <div class="vna-faq-a"><p>Weighted pipeline: Σ(сумма × AI_Probability) вместо roll-up по стадиям. Дашборд committed / best case / AI-weighted.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-audit">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Что входит в аудит прогноза продаж?</div>
          <div class="vna-faq-a"><p>Выгрузка 6–24 мес.; прогноз vs факт; индекс качества данных; рекомендация ML / rule-based / гигиена. Отчёт за 3–5 дней.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- БЛОК 12: ФИНАЛЬНЫЙ CTA (Артур) -->
  <section class="vna-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="vna-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Закажите аудит прогноза продаж и оценку воронки</p>
          <p class="ym-cta-block__sub">Первый шаг — не заказывать ML «сразу», а показать разрыв «прогноз менеджеров vs факт». Созвон 30 мин → аудит → коммерческое предложение по фазам (250–900 тыс. ₽).</p>
          <ul class="vna-cta-checklist" aria-label="Что входит в аудит">
            <li>Выгрузка 6–24 мес. сделок</li>
            <li>Индекс качества данных CRM</li>
            <li>Рекомендация: ML / rule-based / гигиена</li>
          </ul>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Оценить воронку</a>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.vna-content -->


<!-- INTERNAL-LINKS:INSERT — внутренние ссылки из === INTERNAL-LINKER === (Юра) -->
<!-- SCHEMA-MARKUP:INSERT — JSON-LD вставит schema-markup → Юра -->

<!-- ====================================================
     FAQ ACCORDION
     ==================================================== -->
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

<!-- ====================================================
     REVEAL (IntersectionObserver)
     ==================================================== -->
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

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

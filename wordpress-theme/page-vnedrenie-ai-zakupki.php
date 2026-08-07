<?php
/**
 * Template Name: AI для закупок и снабжения: внедрение под ключ
 * Description: Внедрение AI в закупки — сравнение КП, анализ поставщиков, этапы, кейсы, ROI.
 */

declare(strict_types=1);

$page_seo_title       = 'AI для закупок и снабжения: внедрение под ключ';
$page_seo_description = 'Внедрение AI в закупки: сравнение КП поставщиков, анализ цен и сроков, подготовка закупочных решений. Этапы, кейсы, цена и ROI для производства и торговых компаний.';

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

$brand               = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: '');
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Оптимизировать закупки';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#etapy';

$nero_ai_header_links = [
    ['label' => 'Задачи',    'href' => '#chto-takoe-ai'],
    ['label' => 'Этапы',     'href' => '#etapy'],
    ['label' => 'Кейсы',     'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ',       'href' => '#faq'],
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

/* Zakupki page accents */
.vnedrenie-ai-zakupki-page .vna-content{--vna-accent:#fbbf24;}
.vna-callout{background:rgba(251,191,36,.08);border-left:3px solid #fbbf24;border-radius:0 14px 14px 0;padding:18px 22px;margin:24px 0;}
.vna-callout p{margin:0;color:var(--vna-soft);font-size:15px;line-height:1.72;}
.vna-callout strong{color:#fde68a;}
.vna-h3{font-size:clamp(17px,2vw,20px);margin:28px 0 12px;color:var(--vna-heading);}
.vna-subsection{margin-top:36px;}
.ym-cta-block--primary{background:linear-gradient(135deg,rgba(251,191,36,.14),rgba(34,197,94,.1));border-color:rgba(251,191,36,.35);text-align:left;display:flex;gap:20px;align-items:flex-start;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.12);border-radius:16px;padding:24px 28px;margin:28px 0;text-align:left;}
.ym-link--accent{color:var(--vna-accent)!important;text-decoration:underline;}
.ym-link--accent:hover{color:#fff!important;}
@media(max-width:600px){.ym-cta-block--primary{flex-direction:column;}}
.vazak-hero-zakupki.nero-ai-hero{min-height:100vh;min-height:100dvh;position:relative;}

</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-zakupki-page" role="main" tabindex="-1">

<style>
/* ── Hero закупки: самодостаточные стили (.nero-ai-home-page канон) ── */
.vazak-hero-zakupki {
  --vazak-cyan: #79f2ff;
  --vazak-violet: #8b5cf6;
  --vazak-green: #22c55e;
  --vazak-amber: #fbbf24;
  --vazak-text: #e6edf7;
  --vazak-muted: #9aa8bd;
  --vazak-soft: #c7d2e5;
  --vazak-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vazak-hero-zakupki.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vazak-hero-zakupki::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.vazak-hero-zakupki::after {
  content: "";
  position: absolute;
  left: 38%;
  top: 12%;
  width: 760px;
  height: 760px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(251, 191, 36, .10), transparent 66%);
  filter: blur(8px);
  animation: vazakHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vazakHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.vazak-hero-zakupki .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vazak-hero-zakupki .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vazak-hero-zakupki .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vazak-hero-zakupki .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vazak-amber) 38%, var(--vazak-cyan) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vazak-hero-zakupki .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(251, 191, 36, 0.22);
  border-radius: 999px;
  background: rgba(251, 191, 36, 0.08);
  color: var(--vazak-amber) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vazak-hero-zakupki .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vazak-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vazak-hero-zakupki .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vazak-hero-zakupki .nero-ai-badge {
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
.vazak-hero-zakupki .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vazak-hero-zakupki .nero-ai-btn {
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
.vazak-hero-zakupki .nero-ai-btn:hover { transform: translateY(-2px); }
.vazak-hero-zakupki .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vazak-amber), #a7f3d0);
  box-shadow: 0 18px 42px rgba(251, 191, 36, 0.22);
}
.vazak-hero-zakupki .nero-ai-btn-secondary {
  color: var(--vazak-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vazak-hero-zakupki .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vazak-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vazak-hero-zakupki .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vazak-hero-zakupki .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vazak-hero-zakupki .nero-ai-dots { display: flex; gap: 7px; }
.vazak-hero-zakupki .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vazak-hero-zakupki .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vazak-hero-zakupki .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vazak-hero-zakupki .nero-ai-dot:nth-child(3) { background: #34d399; }
.vazak-hero-zakupki .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vazak-hero-zakupki .nero-ai-window-body { padding: 16px; }
.vazak-hero-zakupki .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vazak-hero-zakupki .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vazak-hero-zakupki .nero-ai-live-pill {
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
.vazak-hero-zakupki .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vazakPulse 1.6s infinite;
}
@keyframes vazakPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vazak-hero-zakupki .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vazak-hero-zakupki .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vazak-hero-zakupki .nero-ai-metric span {
  display: block;
  color: var(--vazak-muted);
  font-size: 11px;
  font-weight: 700;
}
.vazak-hero-zakupki .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vazak-hero-zakupki .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vazak-hero-zakupki .vazak-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(251, 191, 36, 0.16);
  background: radial-gradient(ellipse at 50% 20%, rgba(251,191,36,.07), rgba(6,10,24,.92) 72%);
}
.vazak-hero-zakupki #vazak-procurement-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vazak-hero-zakupki .nero-ai-task-stream { display: grid; gap: 8px; }
.vazak-hero-zakupki .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vazak-hero-zakupki .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(251,191,36,.12);
  color: var(--vazak-amber);
  font-size: 11px;
  font-weight: 800;
}
.vazak-hero-zakupki .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vazak-hero-zakupki .nero-ai-task span {
  color: var(--vazak-muted);
  font-size: 11px;
}
.vazak-hero-zakupki .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vazak-hero-zakupki .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vazak-hero-zakupki .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vazak-hero-zakupki .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vazak-hero-zakupki .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vazak-hero-zakupki .nero-ai-window-body { padding: 12px; }
  .vazak-hero-zakupki .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vazak-hero-zakupki .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai закупки</p>
    <h1 id="vazak-hero-title">AI для закупок и снабжения: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
    <p class="nero-ai-hero-lead">Сравниваем предложения поставщиков, анализируем цены и сроки, готовим закупочные решения — без ручного хаоса в Excel и переписке</p>
    <ul class="nero-ai-badges" aria-label="Ключевые этапы">
      <li class="nero-ai-badge">Сравнение КП</li>
      <li class="nero-ai-badge">Анализ поставщиков</li>
      <li class="nero-ai-badge">Supplier comms</li>
      <li class="nero-ai-badge">1С / ERP</li>
      <li class="nero-ai-badge">Human-in-the-loop</li>
      <li class="nero-ai-badge">Аудит процесса</li>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Оптимизировать закупки'); ?></a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Этапы внедрения</a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация закупочного AI-центра">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3>Закупочный AI-центр</h3>
          <span class="nero-ai-live-pill">онлайн</span>
        </div>
        <div class="nero-ai-metrics-grid">
          <div class="nero-ai-metric">
            <span>КП в очереди</span>
            <strong>7</strong>
            <small>3 поставщика · 1 RFQ</small>
          </div>
          <div class="nero-ai-metric">
            <span>Автосверка</span>
            <strong>92%</strong>
            <small>ТЗ vs КП</small>
          </div>
          <div class="nero-ai-metric">
            <span>Писем поставщиков</span>
            <strong>18</strong>
            <small>классифицировано AI</small>
          </div>
          <div class="nero-ai-metric">
            <span>Экономия</span>
            <strong>−4.2 ч/нед</strong>
            <small>на сверке КП</small>
          </div>
        </div>

        <div class="vazak-dash-canvas-wrap" aria-hidden="false">
          <canvas id="vazak-procurement-canvas" role="img" aria-label="Анимация: коммерческие предложения по маршрутам поставщиков сравниваются в матрице и утверждаются приказом на закупку"></canvas>
        </div>

        <div class="nero-ai-task-stream" aria-label="Лента закупочных событий">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">RFQ</span>
            <div><strong>RFQ → ТЗ сгенерировано</strong><span>12 позиций · категория «сырьё»</span></div>
            <span class="nero-ai-status">готово</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">PDF</span>
            <div><strong>PDF КП → позиции извлечены</strong><span>Поставщик B · OCR + LLM</span></div>
            <span class="nero-ai-status">готово</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">≠</span>
            <div><strong>Сравнение → 2 отклонения</strong><span>цена +12% · срок +5 дн.</span></div>
            <span class="nero-ai-status nero-ai-status--amber">review</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">✓</span>
            <div><strong>Shortlist → готов к согласованию</strong><span>3 КП · рекомендация A</span></div>
            <span class="nero-ai-status">согласование</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<script>
/**
 * vazak-procurement-engine — Диспетчерская «Закупочный коридор»
 * Мир: маршруты поставщиков → матрица сравнения → флаги отклонений → PO в 1С
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vazak-procurement-canvas");
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
    scale = Math.min(cw / 440, ch / 290) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    route: "rgba(251,191,36,0.28)",
    routeGlow: "rgba(121,242,255,0.32)",
    matrixBg: "#1e293b",
    matrixRow: "rgba(255,255,255,0.06)",
    matrixOk: "#22c55e",
    matrixWarn: "#fbbf24",
    matrixBad: "#fb7185",
    docBg: "#f8fafc",
    docAccent: "#fde68a",
    radar: "rgba(139,92,246,0.35)",
    sealGreen: "#22c55e",
    erpBeam: "#79f2ff",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#fde68a"
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

  function drawQuotePacket(ctx, x, y, w, h, label) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -w / 2, -h / 2, w, h, 3, C.docBg, C.outline);
    drawRR(ctx, -w / 2 + 3, -h / 2 + 3, w - 6, 5, 1, C.docAccent, null);
    ctx.fillStyle = "#0f172a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(label || "КП", 0, h / 2 - 2);
    ctx.restore();
  }

  /* Ветвящиеся маршруты поставщиков — не конвейер, не орбиты */
  function SupplierRouteNetwork() {
    this.wave = 0;
    this.routes = [
      { sx: -120, sy: -95, cx1: -80, cy1: -40, cx2: -40, cy2: -10, ex: -20, ey: 15, color: C.routeGlow },
      { sx: 0, sy: -105, cx1: 0, cy1: -50, cx2: 0, cy2: -15, ex: 0, ey: 15, color: C.route },
      { sx: 120, sy: -95, cx1: 80, cy1: -40, cx2: 40, cy2: -10, ex: 20, ey: 15, color: C.routeGlow }
    ];
  }
  SupplierRouteNetwork.prototype.draw = function (ctx) {
    this.wave = (frame * 0.03) % (Math.PI * 2);
    var self = this;
    this.routes.forEach(function (r, idx) {
      ctx.save();
      ctx.strokeStyle = r.color;
      ctx.lineWidth = idx === 1 ? 2 : 1.5;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.5;
      ctx.beginPath();
      ctx.moveTo(r.sx, r.sy);
      ctx.bezierCurveTo(r.cx1, r.cy1, r.cx2, r.cy2, r.ex, r.ey);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();

      /* Узел поставщика */
      ctx.fillStyle = "rgba(255,255,255,0.12)";
      ctx.beginPath();
      ctx.arc(r.sx, r.sy, 10 + Math.sin(self.wave + idx) * 2, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1;
      ctx.stroke();
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(String.fromCharCode(65 + idx), r.sx, r.sy + 3);

      /* Пакет КП по кривой */
      var prg = ((frame * 0.022 + idx * 0.33) % 1);
      var t = prg;
      var mt = 1 - t;
      var px = mt * mt * mt * r.sx + 3 * mt * mt * t * r.cx1 + 3 * mt * t * t * r.cx2 + t * t * t * r.ex;
      var py = mt * mt * mt * r.sy + 3 * mt * mt * t * r.cy1 + 3 * mt * t * t * r.cy2 + t * t * t * r.ey;
      if (prg > 0.05 && prg < 0.92) drawQuotePacket(ctx, px, py, 16, 12, "КП");
    });

    /* Волна по сетке коридора */
    for (var i = -3; i <= 3; i++) {
      var ly = -70 + i * 22 + Math.sin(this.wave + i * 0.8) * 3;
      ctx.strokeStyle = "rgba(121,242,255," + (0.04 + Math.abs(Math.sin(this.wave + i)) * 0.06) + ")";
      ctx.lineWidth = 1;
      ctx.beginPath();
      ctx.moveTo(-150, ly);
      ctx.lineTo(150, ly);
      ctx.stroke();
    }
  };

  /* Центральная матрица сравнения — вместо WebsiteTerminal */
  function ComparisonMatrixHub() {
    this.rowsLit = 0;
  }
  ComparisonMatrixHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    var mx = -70, my = -5, mw = 140, mh = 88;
    drawRR(ctx, mx, my, mw, mh, 8, C.matrixBg, C.outline);

    ctx.fillStyle = "rgba(121,242,255,0.85)";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ТЗ ↔ КП", 0, my + 12);

    var suppliers = ["A", "B", "C"];
    var cols = [mx + 38, mx + 72, mx + 106];
    suppliers.forEach(function (s, i) {
      ctx.fillStyle = "#94a3b8";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText(s, cols[i], my + 24);
    });

    var rows = ["Поз. 1", "Поз. 2", "Поз. 3"];
    rows.forEach(function (row, ri) {
      var ry = my + 34 + ri * 18;
      drawRR(ctx, mx + 6, ry, 28, 14, 3, C.matrixRow, null);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(row, mx + 9, ry + 10);

      if (prg >= 55 + ri * 22) {
        cols.forEach(function (cx, ci) {
          var val = ci === 1 && ri === 1 ? "+12%" : ci === 2 && ri === 2 ? "+5д" : "OK";
          var col = val === "OK" ? C.matrixOk : (val.indexOf("+") === 0 ? C.matrixBad : C.matrixWarn);
          drawRR(ctx, cx - 12, ry, 24, 14, 3, "rgba(255,255,255,0.08)", col);
          ctx.fillStyle = col;
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.textAlign = "center";
          ctx.fillText(val, cx, ry + 10);
        });
      }
    });

    if (prg >= 130 && prg < 195) {
      ctx.strokeStyle = "rgba(251,113,133,0.55)";
      ctx.lineWidth = 2;
      ctx.strokeRect(mx + 58, my + 50, 28, 16);
    }
  };

  /* Приём RFQ слева */
  function RfqIntakeDock() {
    this.blink = 0;
  }
  RfqIntakeDock.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -155, -25, 42, 50, 6, "rgba(59,130,246,0.15)", C.outline);
    ctx.fillStyle = C.erpBeam;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("RFQ", -134, -8);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("из 1С", -134, 2);

    if (prg < 60) {
      var intake = prg / 60;
      drawRR(ctx, -148, -18 + intake * 28, 28, 18, 3, C.docBg, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("ТЗ", -134, -6 + intake * 28);
    }
    if (prg > 8 && prg < 12) this.blink = 1;
    else this.blink = 0;
    if (this.blink) {
      ctx.fillStyle = "rgba(59,130,246,0.35)";
      ctx.beginPath();
      ctx.arc(-134, 8, 22, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  /* Маяк отклонений */
  function DeviationFlagBeacon() {
    this.pulse = 0;
  }
  DeviationFlagBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 118, -30, 36, 52, 6, "rgba(251,113,133,0.12)", C.matrixBad);
    ctx.fillStyle = C.matrixBad;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Δ", 136, -10);

    if (prg >= 130 && prg < 200) {
      this.pulse = Math.sin((prg - 130) * 0.12) * 0.5 + 0.5;
      ctx.fillStyle = "rgba(251,113,133," + (0.2 + this.pulse * 0.4) + ")";
      ctx.beginPath();
      ctx.moveTo(136, -18);
      ctx.lineTo(128, 2);
      ctx.lineTo(144, 2);
      ctx.closePath();
      ctx.fill();
      ctx.fillStyle = "#fecaca";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("цена", 136, 14);
      ctx.fillText("срок", 136, 22);
    }
  };

  /* Радар надёжности поставщика */
  function SupplierScoreRadar() {
    this.angle = 0;
  }
  SupplierScoreRadar.prototype.draw = function (ctx) {
    this.angle = (frame * 0.04) % (Math.PI * 2);
    var prg = (frame * 0.038) % 260;
    if (prg < 100) return;
    ctx.save();
    ctx.translate(136, 42);
    ctx.strokeStyle = C.radar;
    ctx.lineWidth = 1;
    for (var i = 0; i < 3; i++) {
      ctx.beginPath();
      ctx.arc(0, 0, 8 + i * 5, 0, Math.PI * 2);
      ctx.stroke();
    }
    ctx.strokeStyle = "#c4b5fd";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(0, 0);
    ctx.lineTo(Math.cos(this.angle) * 16, Math.sin(this.angle) * 16);
    ctx.stroke();
    ctx.fillStyle = "#e9d5ff";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("score", 0, 24);
    ctx.restore();
  };

  /* Штамп приказа на закупку — финал цикла */
  function PoSealEmitter() {
    this.sealY = 0;
  }
  PoSealEmitter.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 195) return;

    var local = (prg - 195) / 65;
    this.sealY = 55 - Math.min(1, local * 1.4) * 30;

    drawRR(ctx, -32, this.sealY, 64, 36, 6, "rgba(34,197,94,0.2)", C.sealGreen);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Приказ", 0, this.sealY + 14);
    ctx.font = "7px Inter,sans-serif";
    ctx.fillStyle = "#bbf7d0";
    ctx.fillText("на закупку", 0, this.sealY + 24);

    if (prg > 215) {
      var beam = Math.min(1, (prg - 215) / 20);
      ctx.strokeStyle = "rgba(121,242,255," + beam * 0.8 + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(0, this.sealY + 36);
      ctx.lineTo(0, 95);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = C.erpBeam;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("1С OData →", 0, 108);

      if (prg > 230 && prg < 250) {
        ctx.strokeStyle = "rgba(34,197,94," + (0.7 - (prg - 230) / 28) + ")";
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.arc(0, this.sealY + 18, 18 + (prg - 230) * 2, 0, Math.PI * 2);
        ctx.stroke();
      }
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
    var prg = (frame * 0.038) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    /* Полукруг у матрицы — другая геометрия */
    var tableTargets = {
      "1_architect": { x: -95, y: 72 },
      "2_seo": { x: -48, y: 82 },
      "3_coder": { x: 0, y: 86 },
      "4_designer": { x: 48, y: 82 },
      "5_deployer": { x: 95, y: 72 }
    };
    var tgt = tableTargets[this.role] || { x: 0, y: 80 };

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
  var routes = new SupplierRouteNetwork();
  var matrix = new ComparisonMatrixHub();
  var rfqDock = new RfqIntakeDock();
  var deviation = new DeviationFlagBeacon();
  var radar = new SupplierScoreRadar();
  var poSeal = new PoSealEmitter();

  entities.push(routes);
  entities.push(rfqDock);
  entities.push(matrix);
  entities.push(deviation);
  entities.push(radar);
  entities.push(poSeal);
  entities.push(new Agent(-130, 100, C.agentYellow, "1_architect", 20, [
    "RFQ из 1С готов", "ТЗ нормализовано", "Категория: сырьё", "ГОСТ подтянут"
  ]));
  entities.push(new Agent(-65, 108, C.agentGreen, "2_seo", 58, [
    "3 КП в очереди", "Позиции извлечены", "Автосверка 92%", "Отказное КП отсечено"
  ]));
  entities.push(new Agent(0, 112, C.agentBlue, "3_coder", 98, [
    "OCR PDF готов", "JSON → матрица", "Парсер КП v2", "Structured output"
  ]));
  entities.push(new Agent(65, 108, C.agentPink, "4_designer", 138, [
    "Флаг: цена +12%", "Shortlist A/B/C", "2 отклонения", "Таблица для CFO"
  ]));
  entities.push(new Agent(130, 100, C.agentPurple, "5_deployer", 178, [
    "PO → 1С OData", "Human review ✓", "Протокол сравнения", "Поставщику: черновик"
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
    if (prg >= 18 && prg < 18.05) createBubble(-120, -50, "1. RFQ от поставщика");
    if (prg >= 62 && prg < 62.05) createBubble(-50, 0, "2. Парсинг КП");
    if (prg >= 108 && prg < 108.05) createBubble(0, -20, "3. Матрица ТЗ vs цена");
    if (prg >= 152 && prg < 152.05) createBubble(90, 10, "4. Флаг отклонения");
    if (prg >= 202 && prg < 202.05) createBubble(0, 60, "5. Приказ в 1С");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.matrixWarn);
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
          <p class="nero-ai-eyebrow" style="margin-bottom:14px;">Лонгрид · ai закупки</p>
          <div class="vna-callout"><p><strong>Коротко:</strong> AI для закупок — это цифровой ассистент закупочного отдела, который сравнивает коммерческие предложения, анализирует поставщиков, нормализует техзадания и готовит закупочные решения. Внедрение под ключ в Nero Network начинается с аудита процесса и пилота на одном сценарии — без замены ERP и без ручного хаоса в Excel.</p></div>
          <p>Закупки и снабжение — одна из самых «ручных» зон B2B: поставщики, цены, сроки и документы ежедневно проходят через десятки писем, таблиц и согласований. По данным The Hackett Group (2025), 49% закупочных команд уже пилотировали генеративный AI, но только 4% вышли на крупномасштабное внедрение. Разрыв между экспериментом и результатом — главный вызов 2026 года.</p>
          <p>Этот материал — практический гид по <strong>внедрению AI в закупки</strong>: от определения и сценариев до стоимости, кейсов и FAQ.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые показатели">
          <div class="vna-kpi-card"><div class="kv">49%</div><div class="kl">пилотировали GenAI</div><div class="ks">Hackett Group, 2025</div></div>
          <div class="vna-kpi-card"><div class="kv">4%</div><div class="kl">масштабировали</div><div class="ks">Hackett Group, 2025</div></div>
          <div class="vna-kpi-card"><div class="kv">300К–2М ₽</div><div class="kl">ориентир чека</div><div class="ks">пилот → контур</div></div>
          <div class="vna-kpi-card"><div class="kv">−30%</div><div class="kl">кейс «Вкусно — и точка»</div><div class="ks">Bidzaar</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe-ai">Что такое AI</a>
        <a href="#problemy-processa">Проблемы</a>
        <a href="#kak-pomogaet">Как помогает</a>
        <a href="#nejroseti-agenty">Агенты</a>
        <a href="#etapy">Этапы</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="vna-section" id="chto-takoe-ai">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Определение</span>
        <h2>Что такое AI для закупок и снабжения</h2>
      </div>
      <div class="vna-card nero-ai-reveal">
        <p><strong>Определение:</strong> AI для закупок и снабжения — набор инструментов на базе больших языковых моделей (LLM), OCR, RPA и предиктивной аналитики, которые автоматизируют рутину закупочного цикла: от заявки и техзадания до сравнения коммерческих предложений (КП), переписки с поставщиками, контроля цен и сроков и подготовки решения для согласования.</p>
        <p>В отличие от классической автоматизации, <strong>искусственный интеллект для закупки</strong> работает с неструктурированными данными: PDF, Word, Excel, email, мессенджеры. Это не замена ERP или SRM, а интеллектуальный слой поверх них — <strong>procurement ai</strong>, который понимает контекст и снижает нагрузку на закупщика.</p>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Отличие AI от классической автоматизации ERP и Excel</h3>
        <p>ERP и Excel решают учёт: фиксируют заявки, остатки, договоры. Но они не «читают» КП в свободной форме, не сопоставляют позиции ТЗ с предложением поставщика и не классифицируют письмо «подтверждение / изменение срока / отказ».</p>
        <div class="vna-table-wrap">
          <table class="vna-table">
            <thead><tr><th>Критерий</th><th>ERP / Excel</th><th>AI для закупок</th></tr></thead>
            <tbody>
              <tr><td>Формат данных</td><td>Структурированные поля</td><td>PDF, Word, email, сканы</td></tr>
              <tr><td>Сравнение КП</td><td>Ручная сверка</td><td>Автоматическая матрица ТЗ vs КП</td></tr>
              <tr><td>Переписка с поставщиками</td><td>Вручную</td><td>Классификация, черновики, follow-up</td></tr>
              <tr><td>Прогноз</td><td>Ограничен правилами</td><td>ML-модели спроса и цен</td></tr>
              <tr><td>Решения</td><td>Человек</td><td>Human-in-the-loop: AI готовит, человек утверждает</td></tr>
            </tbody>
          </table>
        </div>
        <p><strong>AI снабжение</strong> не отменяет регламенты 44-ФЗ/223-ФЗ и внутренние политики — он ускоряет подготовку материалов для решений, которые остаются за закупщиком.</p>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Какие задачи закрывает: поставщики, цены, сроки, документы</h3>
        <p>Пять ключевых сценариев <strong>ai решений для закупки</strong> (по карте ELMA365 и AGORA):</p>
        <ol style="padding-left:1.2em;color:var(--vna-muted);line-height:1.72;">
          <li><strong>Нормализация заявок и генерация ТЗ</strong> — из свободного текста в структурированное техзадание с ГОСТами и параметрами.</li>
          <li><strong>Приём и сравнение КП</strong> — извлечение позиций, цен, сроков из PDF/Excel; матрица соответствия.</li>
          <li><strong>Анализ поставщиков</strong> — скоринг надёжности, аномалии цен, история исполнения.</li>
          <li><strong>Supplier communications</strong> — классификация писем, напоминания по неподтверждённым заказам, черновики ответов.</li>
          <li><strong>Прогноз спроса и бюджета</strong> — предиктивные модели на истории закупок 12–24 месяцев.</li>
        </ol>
        <p>Каждый сценарий даёт измеримый эффект отдельно — и именно так Nero Network рекомендует начинать <strong>внедрение ai закупки</strong>: один процесс, один KPI, затем масштабирование.</p>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="problemy-processa">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Боли процесса</span>
        <h2>Проблемы ручного закупочного процесса</h2>
        <div class="vna-callout"><p><strong>Коротко:</strong> ручной закупочный процесс теряет время на сверку документов, создаёт риски при выборе поставщика и не даёт прозрачности для руководства. <strong>Оптимизация закупок</strong> без цифрового слоя упирается в человеческий фактор.</p></div>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Хаос в Excel, переписка и потеря данных</h3>
        <p>Типичная картина закупочного отдела среднего бизнеса:</p>
        <ul>
          <li>заявки в Excel или Google Sheets, версии файлов «КП_финал_v3_правки»;</li>
          <li>КП от поставщиков в PDF, Word и Excel — сравнение занимает часы;</li>
          <li>переписка в почте и мессенджерах без связи с заявкой в 1С;</li>
          <li>изменения от поставщика (сдвиг срока, количества) не видны в контексте склада или производства.</li>
        </ul>
        <p>По оценке AGORA, до 7 процессов в закупках критично автоматизировать в первую очередь: от заявки до оплаты. Без <strong>закупочный процесс автоматизация</strong> на уровне документов и коммуникаций даже зрелая SRM остаётся «пустой оболочкой» — данные в неё не попадают автоматически.</p>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Риски при выборе поставщика и согласовании сроков</h3>
        <p>Ручной контроль создаёт системные риски:</p>
        <ul>
          <li><strong>Размытые ТЗ</strong> → слабый отклик поставщиков, затягивание тендеров (кейс «Акрон Холдинг», <a href="https://www.retail.ru/cases/kak-akron-kholding-sokratil-podgotovku-tekhzadaniya-na-zakupki-s-neskolkikh-dney-do-minut-s-pomoshch/" target="_blank" rel="noopener noreferrer">Retail.ru</a>).</li>
          <li><strong>Ошибки сверки</strong> → выбор «отказного» КП или пропуск отклонений по цене (кейс ТГК-16, <a href="https://www.content-review.com/articles/75472/" target="_blank" rel="noopener noreferrer">Content-Review</a>).</li>
          <li><strong>Email как «второй ERP»</strong> → письма поставщиков не связаны с заказом; последствия сдвига поставки для производства не просчитываются.</li>
          <li><strong>Зависимость от старого поставщика</strong> → слабая конкуренция, переплата (кейс «Вкусно — и точка»: −30%, <a href="https://bidzaar.com/cases/vkusno-i-tochka-zakupki" target="_blank" rel="noopener noreferrer">Bidzaar</a>).</li>
        </ul>
        <p><strong>Итог:</strong> боль «поставщики, цены, сроки и документы контролируются вручную» — не абстракция, а ежедневная операционная реальность. AI закрывает её точечно, без «большого взрыва» в IT-ландшафте.</p>
      </div>
    </div>
  </section>

  <section id="vnedrenie-ai-zakupki-boris-block" class="bzak-root" aria-label="Анимация: сравнение коммерческих предложений поставщиков с техзаданием">
<style>
/* === БОРИС: prefix bzak-, scoped внутри #vnedrenie-ai-zakupki-boris-block === */
#vnedrenie-ai-zakupki-boris-block.bzak-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnedrenie-ai-zakupki-boris-block .bzak-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-zakupki-boris-block .bzak-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-ai-zakupki-boris-block .bzak-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-zakupki-boris-block .bzak-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-zakupki-boris-block .bzak-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-zakupki-boris-block .bzak-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#059669;
  margin:0 0 14px;
}
#vnedrenie-ai-zakupki-boris-block .bzak-ey::before{
  content:'';
  width:18px;height:2px;
  background:#059669;
  border-radius:1px;
}
#vnedrenie-ai-zakupki-boris-block .bzak-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-ai-zakupki-boris-block .bzak-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-zakupki-boris-block .bzak-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-zakupki-boris-block .bzak-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(5,150,105,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#047857;
  margin-top:1px;
  font-style:normal;
}
#vnedrenie-ai-zakupki-boris-block .bzak-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnedrenie-ai-zakupki-boris-block .bzak-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-zakupki-boris-block .bzak-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-zakupki-boris-block .bzak-pl-a{
  background:rgba(245,158,11,.08);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.22);
}
#vnedrenie-ai-zakupki-boris-block .bzak-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#vnedrenie-ai-zakupki-boris-block .bzak-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-zakupki-boris-block .bzak-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfdf5 0%,#f0fdf4 40%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-zakupki-boris-block .bzak-rgt{min-height:380px;}
}
#bzak-procurement-matrix-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bzak-cnt">
  <div class="bzak-card">

    <div class="bzak-lft">
      <span class="bzak-ey">Сверка КП · в статье</span>
      <h3 class="bzak-h3">Три КП в разных форматах — одна матрица соответствия ТЗ</h3>
      <ul class="bzak-ul">
        <li><span class="bzak-ic">PDF</span>КП-парсер извлекает позиции, цены и сроки из PDF, Word и Excel</li>
        <li><span class="bzak-ic">≡</span>LLM сопоставляет каждую строку с техзаданием и строит матрицу</li>
        <li><span class="bzak-ic">!</span>Отклонения по цене и сроку подсвечиваются — финальное решение за закупщиком</li>
        <li><span class="bzak-ic">✓</span>Human-in-the-loop: AI готовит shortlist, человек утверждает</li>
      </ul>
      <div class="bzak-pills">
        <span class="bzak-pl bzak-pl-g">автосверка 92%</span>
        <span class="bzak-pl bzak-pl-a">2 отклонения</span>
        <span class="bzak-pl bzak-pl-b">ТГК-16: ≥95%</span>
      </div>
      <p class="bzak-foot">Дальше разберём, как AI сравнивает предложения и анализирует поставщиков →</p>
    </div>

    <div class="bzak-rgt">
      <canvas
        id="bzak-procurement-matrix-canvas"
        aria-label="Анимация: коммерческие предложения поставщиков превращаются в сравнительную матрицу с флагами отклонений"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bzak-procurement-matrix-canvas');
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
    grid:'#e2e8f0',
    ai:'#059669',
    aiGlow:'rgba(5,150,105,.22)',
    ok:'#22c55e',
    warn:'#f59e0b',
    bad:'#ef4444',
    pdf:'#fef2f2',
    pdfBdr:'#fca5a5',
    xls:'#ecfdf5',
    xlsBdr:'#6ee7b7',
    doc:'#eff6ff',
    docBdr:'#93c5fd',
    rowA:'#ffffff',
    rowB:'#f8fafc',
    hdr:'#f1f5f9',
    scan:'rgba(5,150,105,.35)'
  };

  var SUPPLIERS = ['Пост. A','Пост. B','Пост. C'];
  var ROWS = [
    {tz:'Болт М8×40', vals:['12 ₽','14 ₽','11 ₽'], flags:[0,1,0]},
    {tz:'Шайба DIN',  vals:['2 ₽','2 ₽','3 ₽'], flags:[0,0,1]},
    {tz:'Срок, дн.',  vals:['14','21','12'], flags:[0,1,0]},
    {tz:'Условия',    vals:['30%','50%','30%'], flags:[0,1,0]}
  ];

  var DOCS = [
    {type:'pdf', label:'КП_A.pdf', x:0, y:0, phase:0},
    {type:'xls', label:'КП_B.xlsx', x:0, y:0, phase:0.15},
    {type:'doc', label:'КП_C.docx', x:0, y:0, phase:0.3}
  ];

  function rr(ctx,x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function docStyle(type){
    if(type==='pdf') return {bg:C.pdf, bdr:C.pdfBdr, tag:'PDF'};
    if(type==='xls') return {bg:C.xls, bdr:C.xlsBdr, tag:'XLS'};
    return {bg:C.doc, bdr:C.docBdr, tag:'DOC'};
  }

  function drawDoc(d, x, y, s, alpha){
    var st = docStyle(d.type);
    ctx.save();
    ctx.globalAlpha = alpha;
    rr(ctx, x, y, s*1.1, s*1.35, 6, st.bg, st.bdr);
    rr(ctx, x+s*0.12, y+s*0.1, s*0.35, s*0.18, 3, st.bdr, null);
    ctx.fillStyle = st.bdr;
    ctx.font = 'bold ' + Math.max(9, s*0.14) + 'px system-ui,sans-serif';
    ctx.fillText(st.tag, x+s*0.12, y+s*0.38);
    ctx.fillStyle = C.ink;
    ctx.font = Math.max(8, s*0.11) + 'px system-ui,sans-serif';
    ctx.fillText(d.label, x+s*0.1, y+s*1.05);
    ctx.restore();
  }

  function ease(t){ return t<0.5 ? 2*t*t : 1-Math.pow(-2*t+2,2)/2; }

  function drawMatrix(mx, my, mw, mh, progress){
    var cols = 4;
    var rowH = mh / (ROWS.length + 1);
    var colW = mw / cols;

    rr(ctx, mx, my, mw, mh, 10, '#fff', C.grid);

    ctx.fillStyle = C.hdr;
    ctx.fillRect(mx+1, my+1, mw-2, rowH-1);
    var headers = ['Позиция ТЗ'].concat(SUPPLIERS);
    ctx.font = 'bold ' + Math.max(9, colW*0.09) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.ink;
    headers.forEach(function(h,i){
      ctx.fillText(h, mx + colW*i + 8, my + rowH*0.62);
    });

    ROWS.forEach(function(row, ri){
      var ry = my + rowH*(ri+1);
      var bg = ri%2 ? C.rowB : C.rowA;
      ctx.fillStyle = bg;
      ctx.fillRect(mx+1, ry+1, mw-2, rowH-1);

      var reveal = Math.max(0, Math.min(1, (progress - ri*0.18) / 0.35));
      ctx.globalAlpha = 0.25 + reveal*0.75;

      ctx.fillStyle = C.ink;
      ctx.font = Math.max(8, colW*0.085) + 'px system-ui,sans-serif';
      ctx.fillText(row.tz, mx + 8, ry + rowH*0.62);

      row.vals.forEach(function(v, ci){
        var cx = mx + colW*(ci+1) + 8;
        ctx.fillStyle = C.ink;
        ctx.fillText(v, cx, ry + rowH*0.62);
        if(reveal > 0.85 && row.flags[ci]){
          var fx = mx + colW*(ci+1) + colW - 22;
          var fy = ry + rowH*0.28;
          rr(ctx, fx, fy, 16, 16, 4, C.warn, null);
          ctx.fillStyle = '#fff';
          ctx.font = 'bold 10px system-ui,sans-serif';
          ctx.fillText('!', fx+5, fy+12);
        }
      });
      ctx.globalAlpha = 1;
    });

    if(progress > 0.75){
      var barW = mw - 24;
      var barX = mx + 12;
      var barY = my + mh + 14;
      rr(ctx, barX, barY, barW, 8, 4, C.grid, null);
      var pct = 0.92 * ease((progress-0.75)/0.25);
      rr(ctx, barX, barY, barW*pct, 8, 4, C.ai, null);
      ctx.fillStyle = C.muted;
      ctx.font = Math.max(9, mw*0.028) + 'px system-ui,sans-serif';
      ctx.fillText('Автосверка: ' + Math.round(pct*100) + '%', barX, barY + 22);
    }
  }

  function drawScanBeam(x, y, h, t){
    var w = 28;
    var gx = x + Math.sin(t*0.04)*4;
    var grd = ctx.createLinearGradient(gx, y, gx+w, y);
    grd.addColorStop(0, 'rgba(5,150,105,0)');
    grd.addColorStop(0.5, C.scan);
    grd.addColorStop(1, 'rgba(5,150,105,0)');
    ctx.fillStyle = grd;
    ctx.fillRect(gx, y, w, h);
    ctx.strokeStyle = C.ai;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(gx+w*0.5, y);
    ctx.lineTo(gx+w*0.5, y+h);
    ctx.stroke();
  }

  function drawAICore(cx, cy, r, pulse){
    var g = ctx.createRadialGradient(cx, cy, 0, cx, cy, r*1.8);
    g.addColorStop(0, C.aiGlow);
    g.addColorStop(1, 'rgba(5,150,105,0)');
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(cx, cy, r*1.8, 0, Math.PI*2);
    ctx.fill();
    rr(ctx, cx-r, cy-r, r*2, r*2, r*0.35, C.ai, C.ink, 2);
    ctx.fillStyle = '#fff';
    ctx.font = 'bold ' + (r*0.55) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI', cx, cy + r*0.2);
    ctx.textAlign = 'left';
    if(pulse > 0.3){
      ctx.strokeStyle = 'rgba(255,255,255,' + (0.4*pulse) + ')';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(cx, cy, r + 6 + pulse*8, 0, Math.PI*2);
      ctx.stroke();
    }
  }

  function loop(){
    frame++;
    ctx.clearRect(0, 0, W, H);

    var cycle = (frame % 420) / 420;
    var phaseIn = cycle < 0.55 ? cycle/0.55 : 1;
    var phaseMerge = cycle < 0.55 ? 0 : (cycle-0.55)/0.25;
    var phaseTable = cycle < 0.8 ? 0 : (cycle-0.8)/0.2;

    var pad = Math.max(16, W*0.04);
    var isNarrow = W < 520;
    var docZoneW = isNarrow ? W*0.38 : W*0.34;
    var matrixX = pad + docZoneW + (isNarrow ? 8 : 20);
    var matrixW = W - matrixX - pad;
    var matrixH = H - pad*2 - 36;
    var matrixY = pad;

    var aiX = pad + docZoneW*0.55;
    var aiY = H*0.48;
    var aiR = Math.min(22, docZoneW*0.14);

    DOCS.forEach(function(d, i){
      var startX = pad + (i%2)*docZoneW*0.42;
      var startY = pad + 20 + i*docZoneW*0.38;
      var orbit = Math.sin(frame*0.03 + i*2)*4;
      var mergeT = ease(Math.min(1, phaseMerge*1.2));
      var tx = startX + (aiX - startX - 20)*mergeT;
      var ty = startY + (aiY - startY)*mergeT + orbit*(1-mergeT);
      var alpha = 1 - mergeT*0.55;
      var scale = Math.min(docZoneW*0.42, 72);
      drawDoc(d, tx, ty, scale, alpha);

      if(mergeT < 1 && mergeT > 0.05){
        ctx.strokeStyle = 'rgba(5,150,105,' + (0.25*mergeT) + ')';
        ctx.lineWidth = 1.5;
        ctx.setLineDash([4,4]);
        ctx.beginPath();
        ctx.moveTo(tx + scale*0.55, ty + scale*0.7);
        ctx.lineTo(aiX, aiY);
        ctx.stroke();
        ctx.setLineDash([]);
      }
    });

    if(phaseIn > 0.15 && phaseMerge < 0.95){
      drawScanBeam(pad, pad, H - pad*2, frame);
    }

    var pulse = 0.5 + 0.5*Math.sin(frame*0.08);
    drawAICore(aiX, aiY, aiR, pulse);

    var tableProgress = Math.max(phaseTable, phaseMerge > 0.9 ? (phaseMerge-0.9)/0.1 : 0);
    if(tableProgress > 0 || phaseMerge > 0.7){
      drawMatrix(matrixX, matrixY, matrixW, matrixH, Math.min(1, tableProgress + phaseMerge*0.5));
    }

    if(phaseTable > 0.5){
      ctx.fillStyle = C.ok;
      ctx.font = 'bold ' + Math.max(10, W*0.022) + 'px system-ui,sans-serif';
      ctx.fillText('Shortlist готов → review', matrixX, matrixY + matrixH + 38);
    }

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>

  <section class="vna-section" id="kak-pomogaet">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Сценарии</span>
        <h2>Как AI помогает в закупках: сравнение, анализ и решения</h2>
        <div class="vna-callout"><p><strong>Коротко:</strong> AI автоматизирует <strong>анализ поставщиков</strong>, <strong>сравнение предложений поставщиков</strong> и подготовку закупочных решений — с обязательной проверкой человеком.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin:0 0 24px;font-size:15px;line-height:1.72;color:var(--vna-soft);">Переписка с поставщиками — отдельное узкое место: классификация intent, извлечение полей КП и маршрутизация в SRM. Если входящий поток идёт через почту и CRM, полезно сравнить сценарий <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI-обработки входящей почты в CRM</a> — тот же принцип human-in-the-loop до финального закупочного решения.</p>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Автоматическое сравнение коммерческих предложений</h3>
        <p>Модуль «КП-парсер» извлекает из документов позиции, единицы измерения, цены, сроки поставки и условия оплаты. LLM сопоставляет каждую строку КП с позициями ТЗ и строит сравнительную матрицу.</p>
        <p><strong>Кейс ТГК-16 + МТС (MWS GPT):</strong> два ИИ-модуля — «Ценовой анализ» и «Технический анализ» — обрабатывают PDF/Word/Excel, выявляют «отказные» КП и проверяют обоснованность НМЦК. Точность анализа ≥95% (<a href="https://www.content-review.com/articles/75472/" target="_blank" rel="noopener noreferrer">Content-Review</a>). Финальная верификация — за закупщиком.</p>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Анализ надёжности и рисков поставщиков</h3>
        <p>AI оценивает поставщика по истории исполнения, ценовым аномалиям, комплаенсу (ЕГРЮЛ, санкционные списки) и рейтингу в SRM.</p>
        <p><strong>Кейс «Вкусно — и точка»:</strong> ИИ-подбор релевантных поставщиков из базы &gt;170 000 контрагентов на Bidzaar — кратный рост числа участников торгов, цикл закупок почти вдвое короче (<a href="https://bidzaar.com/cases/vkusno-i-tochka-zakupki" target="_blank" rel="noopener noreferrer">Bidzaar</a>).</p>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Прогноз цен, сроков и потребности в снабжении</h3>
        <p>ML-модели на истории закупок 12–24 месяцев прогнозируют потребность в сырье, сезонные колебания цен и риск дефицита при сдвиге сроков поставки.</p>
        <p>Walmart в 2025 году масштабирует predictive sorting и agentic AI для цепочки поставок (<a href="https://corporate.walmart.com/news/2025/07/17/walmarts-us-supply-chain-playbook-goes-global-and-its-reinventing-retail-at-scale" target="_blank" rel="noopener noreferrer">Walmart Corporate</a>). Для среднего бизнеса в России достаточно пилота на top-SKU.</p>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Подготовка закупочных решений для отдела</h3>
        <p>AI формирует пакет для согласования: сравнительная таблица КП с флагами отклонений, резюме для руководителя, черновик протокола сравнения, рекомендация shortlist (не финальный выбор).</p>
        <p>Принцип ELMA365: «Закупки — очень чувствительная система… главный принцип: не навреди» — <strong>Андрей Брындин</strong>, Product Owner ELMA365 Закупки (<a href="https://elma365.com/ru/articles/ai-procurement/" target="_blank" rel="noopener noreferrer">elma365.com</a>).</p>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="nejroseti-agenty">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Тренд 2026</span>
        <h2>Нейросети и AI-агенты в procurement</h2>
        <div class="vna-callout"><p><strong>Коротко:</strong> <strong>нейросети для закупки</strong> и <strong>ai агенты закупки</strong> — главный тренд 2026: от чат-ботов к автономным агентам, которые ведут переписку, анализируют последствия и готовят решения.</p></div>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">AI-агенты для supplier communications</h3>
        <p><strong>AI-агенты</strong> выполняют многошаговые задачи: читают почту, классифицируют intent, извлекают поля, сопоставляют с заказом в ERP и готовят черновик ответа.</p>
        <p>Microsoft Procurement Agent в Dynamics 365 SCM: исходящие follow-up, классификация входящих email, impact analysis downstream-эффекта изменений. Обязательный human review (<a href="https://learn.microsoft.com/en-us/dynamics365/supply-chain/faq-supplier-communications-agent" target="_blank" rel="noopener noreferrer">Microsoft Learn</a>).</p>
        <p><strong>Российский аналог от Nero Network:</strong> тот же сценарий на стеке <strong>1С + почта/IMAP + Make/n8n + GigaChat/YandexGPT/MWS GPT</strong>.</p>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">ML-модели прогнозирования demand и бюджета</h3>
        <p>Нейросети закупки применяются для прогноза спроса, категорийной аналитики spend (кейс Coca-Cola + IBM: &gt;$40 млн эффекта, <a href="https://www.ibm.com/case-studies/coca-cola-europacific-partners" target="_blank" rel="noopener noreferrer">IBM</a>) и оптимизации запасов.</p>
        <p>По Deloitte Global CPO Survey 2025: 67,7% CPO видят главную ценность GenAI в аналитике и решениях (<a href="https://artofprocurement.com/blog/state-of-ai-in-procurement" target="_blank" rel="noopener noreferrer">Art of Procurement</a>).</p>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Тренд 2026: Copilot Studio и корпоративные агенты</h3>
        <p>Microsoft вывела Procurement Agent как часть экосистемы <strong>Copilot Studio</strong> (<a href="https://adoption.microsoft.com/en-us/ai-agents/copilot-studio/" target="_blank" rel="noopener noreferrer">adoption.microsoft.com</a>). В России тренд смещается к <strong>закрытому контуру</strong>: локальные LLM, требования ФСТЭК, интеграция ERP+SRM (<a href="https://www.agora.ru/blog/ai-v-zakupkakh-i-snabzhenii-modnyi-trend-ili-prakticheskaia-polza-dlia-biznesa/" target="_blank" rel="noopener noreferrer">AGORA, 2026</a>).</p>
        <p><strong>Уникальный угол Nero Network:</strong> «Российский Procurement Agent» — supplier communications + сравнение КП + impact analysis на вашем стеке.</p>
      </div>
    </div>
  </section>

  <section class="vna-section" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Методология</span>
        <h2>Этапы внедрения AI в закупки</h2>
        <div class="vna-callout"><p><strong>Коротко:</strong> <strong>как внедрить ai закупки</strong> — поэтапно: аудит → пилот 4–8 недель → интеграция → обучение. Не «всё сразу», а один измеримый сценарий.</p></div>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Аудит закупочного процесса (лид-магнит)</h3>
        <p>Первый шаг — <strong>аудит закупочного процесса</strong>: карта потоков «заявка → ТЗ → RFQ → КП → сравнение → договор → приёмка → оплата». Nero Network предлагает чек-лист «12 вопросов аудита» + карту узких мест. Результат — приоритизированный список сценариев и ориентир бюджета.</p>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Пилот на одном типе закупок</h3>
        <div class="vna-table-wrap">
          <table class="vna-table">
            <thead><tr><th>Сценарий</th><th>Срок пилота</th><th>KPI</th></tr></thead>
            <tbody>
              <tr><td>Сравнение 3–5 КП с ТЗ</td><td>4–6 нед.</td><td>Время сверки, % автосверки</td></tr>
              <tr><td>Генерация ТЗ из заявки</td><td>4–6 нед.</td><td>Время подготовки, % без правок</td></tr>
              <tr><td>Классификация писем поставщиков</td><td>6–8 нед.</td><td>% корректной классификации</td></tr>
            </tbody>
          </table>
        </div>
        <p>Кейс «Акрон Холдинг»: &gt;400 ТЗ за 4 месяца; ~80% без правок (<a href="https://www.retail.ru/cases/kak-akron-kholding-sokratil-podgotovku-tekhzadaniya-na-zakupki-s-neskolkikh-dney-do-minut-s-pomoshch/" target="_blank" rel="noopener noreferrer">Retail.ru</a>).</p>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Интеграция с ERP, CRM и документооборотом</h3>
        <p><strong>Внедрение ai в бизнес процессы</strong> требует связки с учётом: <a href="/ai-1c-erp/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP</a> (OData), <strong>Битрикс24</strong>, SRM (ELMA365, AGORA, Bidzaar), документооборот (Контур.Диадок, СБИС), почта (IMAP → n8n/Make), Telegram Bot API.</p>
        <p>Когда заявка или RFQ приходит из CRM до учётного контура, полезен соседний сценарий — <a href="/vnedrenie-ai-amocrm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a>: автоматизация сделок и задач без двойного ввода данных.</p>
        <p>Кейс Группы «Эталон» + Синтека: &gt;97% заявок в цифре; сроки обработки −25–30% (<a href="https://cynteka.ru/keisy/tsifrovizatsiya-zakupok-gruppy-etalon/" target="_blank" rel="noopener noreferrer">Cynteka</a>).</p>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Обучение закупочного отдела</h3>
        <p>AI — ассистент, не замена. Обучение включает работу с интерфейсом review, понимание ограничений модели и новые KPI: время цикла, % автосверки, экономия часов.</p>
        <p>«ИИ — помощник, а не замена эксперта» — <strong>Антон Николаев</strong>, «Акрон Холдинг» (<a href="https://www.retail.ru/cases/kak-akron-kholding-sokratil-podgotovku-tekhzadaniya-na-zakupki-s-neskolkikh-dney-do-minut-s-pomoshch/" target="_blank" rel="noopener noreferrer">Retail.ru</a>).</p>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie-zakupki">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI в закупки полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с 1С — это ускоряет согласование сценариев с закупщиками и IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-audit-zakupki">
      <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Аудит закупочного процесса — бесплатно</p>
        <p class="ym-cta-block__sub">За 1–2 недели составим карту потоков: заявки, ТЗ, КП, сравнение, переписка с поставщиками. На выходе — приоритет сценариев AI, узкие места и ориентир бюджета 300 тыс.–2 млн ₽ без обязательств по внедрению.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <section class="vna-section vna-section-alt" id="pod-klyuch">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Модель внедрения</span>
        <h2>Внедрение под ключ или самостоятельно</h2>
        <div class="vna-callout"><p><strong>Коротко:</strong> <strong>ai закупки под ключ или самостоятельно</strong> — зависит от зрелости IT, объёма закупок и требований ИБ. Для большинства среднего B2B оптимален гибрид: аудит + пилот под ключ, затем развитие своими силами.</p></div>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card"><h3 class="vna-h3" style="margin-top:0;">Когда нужна разработка и интеграция</h3>
          <p>Под ключ нужен, если КП приходят в 5+ форматах, сверка &gt;4 часов/нед., есть 1С/SRM без связки с почтой, требуется закрытый контур или отдел &gt;3 человек и &gt;100 заявок/мес.</p></div>
        <div class="vna-card"><h3 class="vna-h3" style="margin-top:0;">Low-code и готовые платформы</h3>
          <p>Готовые SRM дают встроенный ИИ, но ограничивают кастомизацию и интеграцию с «чужим» 1С. Nero Network собирает промежуточный слой: low-code + кастомные модули extraction и скоринга.</p></div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:20px;">
        <h3 class="vna-h3" style="margin-top:0;">ai закупки для малого и среднего бизнеса</h3>
        <p><strong>Малый бизнес:</strong> пилот на Excel-шлюзе + Telegram + GigaChat — без полной SRM. <strong>Средний бизнес:</strong> интеграция с 1С/Битрикс, 2–3 AI-сценария, закрытый контур. Чек 500 тыс.–1,5 млн ₽.</p>
      </div>
    </div>
  </section>

  <section class="vna-section" id="stoimost">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">ROI</span>
        <h2>Стоимость внедрения AI в закупки и ROI</h2>
        <div class="vna-callout"><p><strong>Коротко:</strong> <strong>сколько стоит ai закупки</strong> — от 300 тыс. до 2 млн ₽. ROI считается по времени закупщиков, ошибкам и росту конкуренции поставщиков.</p></div>
      </div>
      <div class="vna-pricing-grid nero-ai-reveal">
        <div class="vna-price-card"><div class="tier">Аудит + пилот</div><div class="amount">300–500К ₽</div><div class="inc">1 сценарий, карта процесса, MVP сравнения КП</div></div>
        <div class="vna-price-card vna-featured"><div class="tier">Пилот + 1С</div><div class="amount">500К–1М ₽</div><div class="inc">2 сценария, почта, human-in-the-loop</div></div>
        <div class="vna-price-card"><div class="tier">Полный контур</div><div class="amount">1–2М ₽</div><div class="inc">4+ сценария, supplier comms, обучение</div></div>
      </div>
      <div class="vna-subsection nero-ai-reveal">
        <h3 class="vna-h3">Как считать экономию: время, ошибки, скидки</h3>
        <p>Формула ROI: время закупщика × ставка; стоимость ошибок; экономия 3–7% при росте конкуренции; сокращение согласований на 30–60%. Кейс «Акрон»: экономия времени &gt;2 млн ₽ за 4 месяца. MIT: 95% enterprise GenAI pilots не дают ROI без масштабирования.</p>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;font-size:15px;line-height:1.72;color:var(--vna-soft);">На корпоративном масштабе те же закономерности видны в разборе <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude — уроки AI для бизнеса</a>: цифровые шлюзы и managed-агенты, которые можно адаптировать к закупочным потокам и расчёту ROI.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Практика</span>
        <h2>Кейсы: производство, торговля и закупочные отделы</h2>
      </div>
      <div class="vna-case-grid nero-ai-reveal">
        <div class="vna-case-card"><div class="vna-case-tag">Производство</div><h3>«Акрон Холдинг»</h3><p>Генерация и проверка ТЗ; &gt;400 ТЗ за 4 месяца; ~80% без правок.</p></div>
        <div class="vna-case-card"><div class="vna-case-tag">Стройматериалы</div><h3>Группа «Эталон»</h3><p>До 1000 заявок/мес; &gt;97% в цифре; −25–30% сроков обработки.</p></div>
        <div class="vna-case-card"><div class="vna-case-tag">Энергетика</div><h3>ТГК-16</h3><p>Анализ КП на MWS GPT; точность ≥95%; премия «ВЕХА» (май 2026).</p></div>
        <div class="vna-case-card"><div class="vna-case-tag">Торговля</div><h3>«Вкусно — и точка»</h3><p>AI-подбор поставщиков; −30% на услугах; цикл закупок почти вдвое короче.</p></div>
        <div class="vna-case-card"><div class="vna-case-tag">Международный</div><h3>Walmart + Pactum AI</h3><p>AI-переговоры с tail-end поставщиками; ~3% экономии на контракте (референс).</p></div>
        <div class="vna-case-card"><div class="vna-case-tag">CRM-контур</div><h3>Единый контур данных</h3><p>Битрикс24 / amoCRM → AI → 1С через Make/n8n и MCP-серверы.</p></div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="v-kontekste-biznesa">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Контекст</span>
        <h2>AI автоматизация бизнеса: закупки в общей картине</h2>
        <div class="vna-callout"><p><strong>Коротко:</strong> <strong>внедрение ai в бизнес</strong> часто начинают с маркетинга или HR, но <strong>закупки — узкое горлышко</strong> операционной эффективности.</p></div>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card"><h3 class="vna-h3" style="margin-top:0;">Узкое горлышко эффективности</h3>
          <p>64% лидеров закупок ожидают трансформацию роли из-за AI (Hackett Group). Закупки влияют на себестоимость, сроки производства, cash flow и compliance.</p></div>
        <div class="vna-card"><h3 class="vna-h3" style="margin-top:0;">Связка с финансами и логистикой</h3>
          <p>AI даёт данные для бюджета закупок, планирования производства (impact analysis) и логистики. Российский аналог — связка AI с остатками и заказами в 1С.</p></div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="itog">
    <div class="vna-cnt nero-ai-reveal">
      <div class="vna-card">
        <p><strong>Итог:</strong> <strong>AI для закупок и снабжения</strong> — практичный инструмент 2026 года для компаний, которые устали от ручной сверки КП и потерянных писем поставщиков. <strong>Внедрение ai закупки</strong> под ключ в Nero Network начинается с аудита, пилота на одном сценарии и интеграции с вашим 1С/CRM — без замены закупщиков и без обещаний «магического ROI». Следующий шаг — <strong>аудит закупочного процесса</strong> и выбор первого сценария пилота.</p>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final-zakupki">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы оптимизировать закупки с AI?</p>
        <p class="ym-cta-block__sub">Следующий шаг — аудит процесса и пилот на одном сценарии: сравнение КП, генерация ТЗ или supplier communications. 4–8 недель, human-in-the-loop, интеграция с вашим 1С/CRM.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary">Этапы внедрения</a>
        </div>
      </div>
    </div>
  </div>

  <section class="vna-section" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">FAQ</span>
        <h2>FAQ по внедрению AI в закупки</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai закупки пошагово?</div><div class="vna-faq-a"><p>1) Аудит процесса. 2) Один сценарий пилота. 3) Данные: номенклатура, шаблоны ТЗ, история 12 мес. 4) Пилот 4–8 недель с KPI. 5) Интеграция с 1С/CRM. 6) Обучение и масштабирование.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит ai закупки?</div><div class="vna-faq-a"><p>Ориентир: <strong>300 тыс.–2 млн ₽</strong>. Аудит + пилот — от 300 тыс. ₽. Полный контур — до 2 млн ₽. Точная стоимость — после аудита.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Нужны ли программисты?</div><div class="vna-faq-a"><p>Для MVP — частично (Make, n8n + LLM API). Для 1С, закрытого контура и журнала решений AI нужна разработка или внедрение под ключ. Nero Network закрывает техническую часть.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как интегрировать с CRM и ERP?</div><div class="vna-faq-a"><p>Типовой стек: 1С (OData) ↔ Make/n8n ↔ LLM ↔ почта/Telegram ↔ Битрикс24. AI — слой между каналами и учётом, не замена ERP.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Под ключ или своими силами — что выбрать?</div><div class="vna-faq-a"><p>Под ключ оправдан при &gt;100 заявок/мес. и требовании быстрого ROI. Своими силами — если есть разработчик 1С и горизонт 3–6 мес. на MVP.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI закупщика?</div><div class="vna-faq-a"><p>Нет. AI готовит материалы, сравнивает, классифицирует. Выбор поставщика, переговоры и ответственность за 44-ФЗ/223-ФЗ — за человеком. «Цифровые агенты усиливают компетенции» — <strong>Эдуард Галеев</strong>, ТГК-16.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Какие риски у AI в закупках?</div><div class="vna-faq-a"><p>Галлюцинации LLM → human review. Утечка данных → on-prem LLM. Регуляторика → AI не принимает финальное решение. Пилот без scale → 1 сценарий, измеримый KPI.</p></div></div>
      </div>
    </div>
  </section>

</div>

</main>

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
$vazak_page_url = trailingslashit(get_permalink());
$vazak_site_url = trailingslashit(home_url('/'));
$vazak_brand    = $brand ?: 'Nero Network';
$vazak_schema   = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type' => 'Organization',
            '@id'   => $vazak_site_url . '#organization',
            'name'  => $vazak_brand,
            'url'   => $vazak_site_url,
        ],
        [
            '@type'     => 'WebSite',
            '@id'       => $vazak_site_url . '#website',
            'url'       => $vazak_site_url,
            'name'      => $vazak_brand,
            'publisher' => ['@id' => $vazak_site_url . '#organization'],
        ],
        [
            '@type'       => 'WebPage',
            '@id'         => $vazak_page_url . '#webpage',
            'url'         => $vazak_page_url,
            'name'        => $page_seo_title,
            'description' => $page_seo_description,
            'isPartOf'    => ['@id' => $vazak_site_url . '#website'],
            'about'       => ['@id' => $vazak_site_url . '#organization'],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id'   => $vazak_page_url . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vazak_site_url],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vazak_page_url],
            ],
        ],
        [
            '@type'       => 'Service',
            '@id'         => $vazak_page_url . '#service',
            'name'        => $page_seo_title,
            'description' => $page_seo_description,
            'url'         => $vazak_page_url,
            'provider'    => ['@id' => $vazak_site_url . '#organization'],
        ],
        [
            '@type' => 'FAQPage',
            '@id'   => $vazak_page_url . '#faq',
            'mainEntity' => [
                ['@type' => 'Question', 'name' => 'Как внедрить ai закупки пошагово?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => '1) Аудит процесса. 2) Один сценарий пилота. 3) Данные: номенклатура, шаблоны ТЗ, история 12 мес. 4) Пилот 4–8 недель с KPI. 5) Интеграция с 1С/CRM. 6) Обучение и масштабирование.']],
                ['@type' => 'Question', 'name' => 'Сколько стоит ai закупки?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Ориентир: 300 тыс.–2 млн ₽. Аудит + пилот — от 300 тыс. ₽. Полный контур — до 2 млн ₽. Точная стоимость — после аудита.']],
                ['@type' => 'Question', 'name' => 'Нужны ли программисты?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Для MVP — частично (Make, n8n + LLM API). Для 1С, закрытого контура и журнала решений AI нужна разработка или внедрение под ключ. Nero Network закрывает техническую часть.']],
                ['@type' => 'Question', 'name' => 'Как интегрировать с CRM и ERP?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Типовой стек: 1С (OData) ↔ Make/n8n ↔ LLM ↔ почта/Telegram ↔ Битрикс24. AI — слой между каналами и учётом, не замена ERP.']],
                ['@type' => 'Question', 'name' => 'Под ключ или своими силами — что выбрать?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Под ключ оправдан при >100 заявок/мес. и требовании быстрого ROI. Своими силами — если есть разработчик 1С и горизонт 3–6 мес. на MVP.']],
                ['@type' => 'Question', 'name' => 'Заменит ли AI закупщика?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Нет. AI готовит материалы, сравнивает, классифицирует. Выбор поставщика, переговоры и ответственность за 44-ФЗ/223-ФЗ — за человеком. «Цифровые агенты усиливают компетенции» — Эдуард Галеев, ТГК-16.']],
                ['@type' => 'Question', 'name' => 'Какие риски у AI в закупках?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Галлюцинации LLM → human review. Утечка данных → on-prem LLM. Регуляторика → AI не принимает финальное решение. Пилот без scale → 1 сценарий, измеримый KPI.']],
            ],
        ],
    ],
];
echo '<script type="application/ld+json">' . wp_json_encode($vazak_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
?>

</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

<?php
/**
 * Template Name: AI-поиск товаров для интернет-магазина: внедрение под ключ
 * Description: Внедрение AI-поиска товаров — нейросеть понимает запрос на естественном языке. Демо на 20 запросах. От 300 тыс. ₽.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-поиск товаров для интернет-магазина — внедрение под ключ';
$page_seo_description = 'Внедрение AI-поиска товаров для интернет-магазина и B2B-каталога: нейросеть понимает запрос на естественном языке и находит товары без точного названия. Демо на 20 запросах. От 300 тыс. ₽.';

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
    ['label' => 'Проблема', 'href' => '#pochemu-ne-nahodyat'],
    ['label' => 'Как работает', 'href' => '#chto-takoe-ai-poisk'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie-pod-klyuch'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#cena-i-roi'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить поиск по 20 запросам';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#chto-takoe-ai-poisk';

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

<main id="primary" class="site-main nero-ai-home-page ai-poisk-tovarov-page" role="main" tabindex="-1">

<section class="nero-ai-hero apt-hero-poisk" id="hero" aria-labelledby="hero-poisk-title">
<style>
/* apt-hero-poisk — самодостаточный hero (канон meta-journal.ru / .nero-ai-home-page) */
.apt-hero-poisk {
  --apt-cyan: #79f2ff;
  --apt-violet: #8b5cf6;
  --apt-green: #22c55e;
  --apt-text: #e6edf7;
  --apt-muted: #9aa8bd;
  --apt-soft: #c7d2e5;
  --apt-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  color: var(--apt-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
.apt-hero-poisk::before {
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
.apt-hero-poisk::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .12), transparent 66%);
  filter: blur(6px);
  animation: aptPoiskGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aptPoiskGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.apt-hero-poisk .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.apt-hero-poisk .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.apt-hero-poisk .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--apt-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.apt-hero-poisk h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(44px, 7.2vw, 94px);
  line-height: .89;
  letter-spacing: -0.075em;
  color: #fff;
}
.apt-hero-poisk .nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, var(--apt-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.apt-hero-poisk .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--apt-soft) !important;
  font-size: clamp(18px, 2vw, 22px);
  line-height: 1.58;
}
.apt-hero-poisk .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.apt-hero-poisk .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.apt-hero-poisk .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.apt-hero-poisk .nero-ai-btn {
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
.apt-hero-poisk .nero-ai-btn:hover { transform: translateY(-2px); }
.apt-hero-poisk .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--apt-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.apt-hero-poisk .nero-ai-btn-secondary {
  color: var(--apt-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.apt-hero-poisk .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--apt-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.apt-hero-poisk .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.apt-hero-poisk .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.apt-hero-poisk .nero-ai-dots { display: flex; gap: 7px; }
.apt-hero-poisk .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.apt-hero-poisk .nero-ai-dot:nth-child(1) { background: #fb7185; }
.apt-hero-poisk .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.apt-hero-poisk .nero-ai-dot:nth-child(3) { background: #34d399; }
.apt-hero-poisk .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.apt-hero-poisk .nero-ai-window-body { padding: 16px; }
.apt-hero-poisk .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.apt-hero-poisk .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.apt-hero-poisk .nero-ai-live-pill {
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
.apt-hero-poisk .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aptPoiskPulse 1.6s infinite;
}
@keyframes aptPoiskPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.apt-hero-poisk .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.apt-hero-poisk .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.apt-hero-poisk .nero-ai-metric span {
  display: block;
  color: var(--apt-muted);
  font-size: 11px;
  font-weight: 700;
}
.apt-hero-poisk .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.apt-hero-poisk .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.apt-hero-poisk .apt-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: radial-gradient(ellipse at 40% 40%, rgba(121,242,255,.08), rgba(6,10,24,.92) 72%);
}
.apt-hero-poisk #apt-poisk-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.apt-hero-poisk .nero-ai-task-stream { display: grid; gap: 8px; }
.apt-hero-poisk .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  animation: aptTaskFloat 5s ease-in-out infinite;
}
.apt-hero-poisk .nero-ai-task:nth-child(2) { animation-delay: .6s; }
.apt-hero-poisk .nero-ai-task:nth-child(3) { animation-delay: 1.2s; }
@keyframes aptTaskFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-4px); }
}
.apt-hero-poisk .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--apt-cyan);
  font-size: 10px;
  font-weight: 800;
}
.apt-hero-poisk .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.apt-hero-poisk .nero-ai-task span {
  color: var(--apt-muted);
  font-size: 11px;
}
.apt-hero-poisk .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.apt-hero-poisk .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
@media (max-width: 1100px) {
  .apt-hero-poisk .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .apt-hero-poisk .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .apt-hero-poisk .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .apt-hero-poisk .nero-ai-window-body { padding: 12px; }
  .apt-hero-poisk .nero-ai-task { grid-template-columns: 28px 1fr; }
  .apt-hero-poisk .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai поиск товаров</p>
      <h1 id="hero-poisk-title">AI-поиск товаров для интернет-магазина: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть понимает запрос клиента человеческим языком и находит нужные товары в каталоге — даже если покупатель не знает точное название или артикул</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности AI-поиска">
        <li class="nero-ai-badge">Семантика</li>
        <li class="nero-ai-badge">Опечатки</li>
        <li class="nero-ai-badge">B2B-каталог</li>
        <li class="nero-ai-badge">Zero-result ↓</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить поиск по 20 запросам</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#chto-takoe-ai-poisk">Как работает AI-поиск</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо AI-поиска по каталогу">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">поиск · демо · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-поиск по каталогу</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Zero-result</span>
              <strong>6,3% → 1,2%</strong>
              <small>после внедрения</small>
            </div>
            <div class="nero-ai-metric">
              <span>Релевантность top-3</span>
              <strong>94%</strong>
              <small>на 20 запросах</small>
            </div>
            <div class="nero-ai-metric">
              <span>Запросов/день</span>
              <strong>1 240</strong>
              <small>демо-каталог</small>
            </div>
            <div class="nero-ai-metric">
              <span>Конверсия поиска</span>
              <strong>×2,5</strong>
              <small>vs keyword</small>
            </div>
          </div>

          <div class="apt-dash-canvas-wrap">
            <canvas id="apt-poisk-hero-canvas" role="img" aria-label="Анимация: запрос на естественном языке проходит embeddings и BM25, выдача показывает 12 релевантных SKU"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий поиска">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">IN</span>
              <div><strong>«перфоратор для бетона до 15 кг»</strong><span>запрос без артикула</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">принят</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Embeddings + BM25</strong><span>гибридный fusion · синонимы</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">OUT</span>
              <div><strong>12 SKU в выдаче</strong><span>релевантность top-3 · 94%</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * apt-poisk-hero-engine — «Семантическая обсерватория каталога»
 * Цикл: QueryIntentStream → EmbeddingVectorField → Bm25KeywordRing → SemanticResultGrid → ZeroResultGauge
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("apt-poisk-hero-canvas");
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
    scale = Math.min(cw / 420, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    red: "#fb7185",
    panel: "#0f172a",
    panelEdge: "#1e293b",
    chip: "#dbeafe",
    sku: "#ecfccb",
    bubbleBg: "#0b1220",
    bubbleText: "#e2e8f0",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Search-bar источник запросов */
  function SearchBarDock() {
    this.pulse = 0;
  }
  SearchBarDock.prototype.draw = function (ctx) {
    drawRR(ctx, -185, -88, 95, 22, 8, "rgba(255,255,255,0.08)", C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("🔍 поиск...", -178, -74);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillText("NL query", -185, -94);
  };

  /* Поток intent-запросов — вместо Conveyor */
  function QueryIntentStream() {
    this.queries = [
      { text: "перфоратор 15кг", offset: 0, color: C.chip },
      { text: "молоток бетон", offset: 70, color: "#fbcfe8" },
      { text: "bosch gbh", offset: 140, color: C.sku }
    ];
  }
  QueryIntentStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    this.queries.forEach(function (q, i) {
      var t = ((frame * 0.55 + q.offset) % 110) / 110;
      if (t > 0.88) return;
      var x = -175 + t * 120;
      var y = -55 + Math.sin(t * Math.PI * 2 + i) * 6;
      var w = ctx.measureText(q.text).width + 10;
      drawRR(ctx, x, y, w, 14, 5, q.color, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(q.text, x + 5, y + 10);
    });
    if (prg >= 8 && prg < 55) {
      ctx.strokeStyle = "rgba(121,242,255,0.35)";
      ctx.lineWidth = 1.5;
      ctx.setLineDash([4, 3]);
      ctx.beginPath();
      ctx.moveTo(-80, -48);
      ctx.quadraticCurveTo(-20, -70, 35, -35);
      ctx.stroke();
      ctx.setLineDash([]);
    }
  };

  /* Поле embeddings — сетка точек */
  function EmbeddingVectorField() {
    this.dots = [];
    for (var i = 0; i < 36; i++) {
      this.dots.push({ gx: i % 6, gy: Math.floor(i / 6), phase: Math.random() * 6 });
    }
  }
  EmbeddingVectorField.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var ox = -15, oy = -42, step = 14;
    drawRR(ctx, ox - 8, oy - 8, 92, 72, 6, "rgba(121,242,255,0.04)", C.outline);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("vectors", ox - 4, oy - 12);

    this.dots.forEach(function (d) {
      var lit = prg > 45 && prg < 165 && (d.gx + d.gy + frame * 0.04 + d.phase) % 3 < 1.2;
      var px = ox + d.gx * step;
      var py = oy + d.gy * step;
      ctx.fillStyle = lit ? C.cyan : "rgba(100,116,139,0.45)";
      ctx.beginPath();
      ctx.arc(px, py, lit ? 2.8 : 1.8, 0, Math.PI * 2);
      ctx.fill();
      if (lit && d.gx < 5) {
        ctx.strokeStyle = "rgba(121,242,255,0.25)";
        ctx.lineWidth = 0.8;
        ctx.beginPath();
        ctx.moveTo(px, py);
        ctx.lineTo(px + step, py + (d.gy % 2 ? -4 : 4));
        ctx.stroke();
      }
    });
  };

  /* Кольцо BM25-ключей */
  function Bm25KeywordRing() {
    this.angle = 0;
  }
  Bm25KeywordRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 70 || prg > 175) return;
    this.angle += 0.018;
    var keys = ["перфоратор", "15 кг", "бетон", "Bosch"];
    keys.forEach(function (k, i) {
      var a = this.angle + (i / keys.length) * Math.PI * 2;
      var rx = 58 + Math.cos(a) * 28;
      var ry = 8 + Math.sin(a) * 18;
      drawRR(ctx, rx - 18, ry - 6, 36, 12, 4, "rgba(139,92,246,0.22)", C.violet);
      ctx.fillStyle = "#e9d5ff";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(k, rx, ry + 3);
    }, this);
    ctx.fillStyle = "#c4b5fd";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("BM25", 58, -8);
  };

  /* Расширитель синонимов */
  function SynonymExpander() {
    this.flash = 0;
  }
  SynonymExpander.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 90 || prg > 140) return;
    var pairs = [["перфоратор", "отбойный"], ["15 кг", "лёгкий"]];
    pairs.forEach(function (p, i) {
      var alpha = Math.min(1, (prg - 92 - i * 12) / 10);
      if (alpha <= 0) return;
      ctx.globalAlpha = alpha;
      drawRR(ctx, -95 + i * 8, 18 + i * 14, 52, 12, 4, "rgba(34,197,94,0.15)", C.green);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(p[0] + "↔" + p[1], -69 + i * 8, 27 + i * 14);
      ctx.globalAlpha = 1;
    });
  };

  /* Центральная панель выдачи — вместо WebsiteTerminal */
  function SemanticResultGrid() {
    this.cards = 0;
  }
  SemanticResultGrid.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, 95, -72, 118, 138, 10, C.panel, C.panelEdge);
    drawRR(ctx, 102, -64, 104, 16, [6, 6, 0, 0], "rgba(121,242,255,0.18)", null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Выдача · SKU", 108, -54);

    var cardCount = prg < 155 ? 0 : Math.min(4, Math.floor((prg - 155) / 12));
    this.cards = cardCount;
    for (var c = 0; c < cardCount; c++) {
      var cx = 108 + (c % 2) * 52;
      var cy = -38 + Math.floor(c / 2) * 38;
      drawRR(ctx, cx, cy, 46, 32, 5, C.sku, C.outline);
      ctx.fillStyle = "#365314";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("SKU " + (c + 1), cx + 23, cy + 12);
      ctx.fillStyle = C.green;
      ctx.fillText(Math.round(94 - c * 3) + "%", cx + 23, cy + 24);
    }

    if (prg >= 200) {
      var pop = Math.min(1, (prg - 200) / 15);
      ctx.save();
      ctx.globalAlpha = pop;
      drawRR(ctx, 108, 42, 96, 18, 5, "rgba(34,197,94,0.22)", C.green);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("12 SKU · готово", 156, 54);
      ctx.restore();
    }

    if (prg >= 155 && prg < 200) {
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ranking…", 154, 8);
    }
  };

  /* Gauge zero-result */
  function ZeroResultGauge() {
    this.val = 6.3;
  }
  ZeroResultGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -175, 42, 58, 36, 6, "rgba(255,255,255,0.05)", C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("zero-result", -146, 50);
    var target = prg >= 210 ? 1.2 : 6.3;
    this.val += (target - this.val) * 0.06;
    var pct = (6.3 - this.val) / (6.3 - 1.2);
    ctx.fillStyle = this.val > 3 ? C.red : C.green;
    ctx.font = "bold 10px Inter,sans-serif";
    ctx.fillText(this.val.toFixed(1) + "%", -146, 68);
    drawRR(ctx, -168, 72, 44, 4, 2, "rgba(255,255,255,0.1)", null);
    drawRR(ctx, -168, 72, 44 * Math.max(0, Math.min(1, pct)), 4, 2, this.val > 3 ? C.red : C.green, null);
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
    var prg = (frame * 0.042) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var hubTargets = {
      "1_architect": { x: 25, y: 55 },
      "2_seo": { x: -35, y: 62 },
      "3_coder": { x: 85, y: 58 },
      "4_designer": { x: 140, y: 52 },
      "5_deployer": { x: 55, y: 78 }
    };
    var tgt = hubTargets[this.role] || { x: 40, y: 60 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 15) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 15) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 15) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.5) * 1;
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
  entities.push(new SearchBarDock());
  entities.push(new QueryIntentStream());
  entities.push(new EmbeddingVectorField());
  entities.push(new Bm25KeywordRing());
  entities.push(new SynonymExpander());
  entities.push(new SemanticResultGrid());
  entities.push(new ZeroResultGauge());
  entities.push(new Agent(-150, 92, C.agentYellow, "1_architect", 18, [
    "Схема гибридного индекса", "RRF fusion BM25+vec", "Аудит 20 запросов"
  ]));
  entities.push(new Agent(-70, 98, C.agentGreen, "2_seo", 62, [
    "Синоним: молоток↔перфоратор", "LSI из логов поиска", "Опечатка bosch→bosh"
  ]));
  entities.push(new Agent(10, 100, C.agentBlue, "3_coder", 108, [
    "Qdrant + Meilisearch", "nDCG@60 мониторинг", "Webhook переиндекса"
  ]));
  entities.push(new Agent(90, 96, C.agentPink, "4_designer", 158, [
    "Карточка SKU в виджете", "Фасеты категорий", "Zero-result → форма"
  ]));
  entities.push(new Agent(155, 90, C.agentPurple, "5_deployer", 208, [
    "Staging: 12 SKU OK", "A/B vs keyword", "Rollout на Bitrix"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 230, maxLife: life || 230 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.042) % 260;
    if (prg >= 12 && prg < 12.05) createBubble(-160, -60, "1. Intent из search-bar");
    if (prg >= 58 && prg < 58.05) createBubble(-10, -50, "2. Embeddings + синонимы");
    if (prg >= 118 && prg < 118.05) createBubble(55, 5, "3. BM25 hybrid fusion");
    if (prg >= 168 && prg < 168.05) createBubble(150, -20, "4. Rank top-12 SKU");
    if (prg >= 228 && prg < 228.05) createBubble(-145, 55, "5. Zero-result ↓ 1,2%");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 16, 5, C.bubbleBg, C.cyan);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
      ctx.fillText(b.text, b.x, b.y - 10);
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

<!-- ====================================================
     КОНТЕНТНАЯ ЧАСТЬ СТРАНИЦЫ ai-poisk-tovarov
     Борис: полный article-блок (не hero)
     ==================================================== -->
<div class="vna-content">

  <!-- INTRO -->
  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai поиск товаров</p>
          <p><strong>Коротко:</strong> AI-поиск товаров — поисковый слой на сайте интернет-магазина или B2B-каталога, который понимает запрос покупателя по смыслу, а не только по точному совпадению слов. Nero Network внедряет такие системы под ключ: от аудита текущего поиска до интеграции с CMS, CRM и аналитикой.</p>
          <p>Клиент не находит нужный товар обычным поиском — и это системная боль e-commerce. Покупатель знает, <em>что</em> ему нужно, но не знает точного названия или артикула в вашем каталоге. AI-поиск закрывает разрыв между человеческим языком и SKU.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые метрики поиска">
          <div class="vna-kpi-card">
            <div class="kv">6–18%</div>
            <div class="kl">zero-result без оптимизации</div>
            <div class="ks">Luigi's Box / Hello Retail</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">×2,5</div>
            <div class="kl">конверсия поисковиков</div>
            <div class="ks">Constructor, 2024</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">44%</div>
            <div class="kl">выручки с 24% трафика</div>
            <div class="ks">Constructor</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">40%</div>
            <div class="kl">enterprise-apps с AI-агентами к 2026</div>
            <div class="ks">Gartner, 2025</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-ne-nahodyat">Проблема</a>
        <a href="#chto-takoe-ai-poisk">Как работает</a>
        <a href="#dlya-magazina-i-b2b">Сегменты</a>
        <a href="#vnedrenie-pod-klyuch">Внедрение</a>
        <a href="#integraciya">Интеграции</a>
        <a href="#cena-i-roi">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#saas-vs-kastom">SaaS vs кастом</a>
        <a href="#faq">FAQ</a>
        <a href="#demo-20-zaprosov">Демо</a>
      </nav>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- СЕКЦИЯ 1: Почему не находят -->
  <section class="vna-section" id="pochemu-ne-nahodyat">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Проблема</span>
        <h2>Почему клиенты не находят товар обычным поиском</h2>
        <p>От 6% до 18% поисковых запросов в e-commerce заканчиваются «нулевым результатом». Поиск — канал продаж с прямым влиянием на P&amp;L, а не IT-фича в шапке сайта.</p>
      </div>

      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card">
          <h3>Keyword-поиск</h3>
          <p>BM25, LIKE, простые синонимы. Хорошо находит артикулы, плохо — разговорные формулировки и опечатки.</p>
        </div>
        <div class="vna-card nero-ai-delay-1">
          <h3>Запрос «человеческим языком»</h3>
          <p>«Перфоратор для бетона до 15 кг», «фильтр на Kia Rio 2018» — покупатель знает задачу, не SKU.</p>
        </div>
        <div class="vna-card nero-ai-delay-2">
          <h3>AI-поиск</h3>
          <p>Нейросеть векторизует запрос и карточки, сравнивает по смыслу — даже без точного совпадения слов.</p>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:28px;" id="keyword-vs-ai">
        <h3 style="font-size:19px;margin-bottom:14px;">Сколько конверсии теряет магазин</h3>
        <p>По Constructor (609 млн поисков, 113 ритейлеров): поисковики — <strong>24%</strong> посетителей, но <strong>44%</strong> выручки; конверсия поисковиков — в <strong>2,5 раза</strong> выше. При пустой выдаче треть пользователей уходит сразу (Luigi's Box).</p>
      </div>

      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-table">
          <thead>
            <tr>
              <th>Проблема</th>
              <th>Что видит покупатель</th>
              <th>Бизнес-эффект</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Пустая выдача (zero-result)</td>
              <td>«Ничего не найдено»</td>
              <td>Уход с сайта, звонок в поддержку</td>
            </tr>
            <tr>
              <td>Нерелевантная выдача</td>
              <td>Товары «не те»</td>
              <td>Низкий CTR, недоверие к каталогу</td>
            </tr>
            <tr>
              <td>Опечатка / синоним</td>
              <td>Пусто или мусор</td>
              <td>Потеря горячего спроса</td>
            </tr>
            <tr>
              <td>Сложный запрос по атрибутам</td>
              <td>Нужно вручную фильтровать</td>
              <td>Отказ от покупки</td>
            </tr>
            <tr>
              <td>Пустая карточка в индексе</td>
              <td>Товар есть, поиск не видит</td>
              <td>Скрытый ассортимент</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- CTA Артура #1 -->
      <div class="vna-cnt" style="width:100%;max-width:none;padding:0;">
        <div class="ym-cta-block ym-cta-block--primary" id="cta-zero-result">
          <div class="ym-cta-block__icon" aria-hidden="true">🔍</div>
          <div class="ym-cta-block__body">
            <p class="ym-cta-block__headline">Сколько запросов на вашем сайте заканчиваются пустой выдачей?</p>
            <p class="ym-cta-block__sub">Закажите проверку поиска по 20 запросам — бесплатный аудит с таблицей «до/после» и процентом zero-result.</p>
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить поиск по 20 запросам</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- СЕКЦИЯ 2: Что такое AI-поиск -->
  <section class="vna-section vna-section-alt" id="chto-takoe-ai-poisk">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Архитектура</span>
        <h2>Что такое AI-поиск товаров и как работает нейросеть в каталоге</h2>
        <p>Гибридная архитектура 2025–2026: BM25/keyword + vector embeddings + бизнес-правила (наличие, цена, регион, маржинальность).</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <h3 style="font-size:20px;margin-bottom:16px;">Пять шагов от запроса до покупки</h3>
        <div class="vna-timeline">
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <h3>1. Query understanding</h3>
            <p>Нормализация, исправление опечаток, извлечение фильтров (категория, цена, характеристики).</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <h3>2. Retrieval</h3>
            <p>Параллельно keyword-поиск (артикулы) + semantic search (embeddings).</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <h3>3. Fusion &amp; ranking</h3>
            <p>Объединение результатов (RRF / weighted fusion), ML-ранжирование по кликам и конверсиям.</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <h3>4. Выдача</h3>
            <p>Автоподсказки → страница результатов с фасетами → карточка товара.</p>
          </div>
          <div class="vna-tl-item">
            <div class="vna-tl-dot"></div>
            <h3>5. Feedback loop</h3>
            <p>Логирование кликов и покупок, очередь zero-result на доработку синонимов.</p>
          </div>
        </div>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vna-card">
          <h3>Embeddings и синонимы</h3>
          <p>Запрос «маршрутизатор Wi-Fi для квартиры 80 кв.м» и карточка «роутер TP-Link Archer AX73» получают высокий семантический скор. Keyword-слой ловит точные артикулы и бренды.</p>
        </div>
        <div class="vna-card">
          <h3>RAG по каталогу</h3>
          <p>AI извлекает товары из <strong>вашей</strong> базы, не придумывает SKU. Retrieval → ранжирование → бизнес-правила. Lamoda Tech: ~25% выручки с поиска.</p>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;font-size:15px;color:var(--vna-soft);"><strong>Коротко:</strong> AI-поиск не заменяет каталог — он делает его доступным для человеческого языка.</p>
    </div>
  </section>

  <!-- ====================================================
       БОРИС: визуальный блок (после 2-го H2)
       ==================================================== -->
  <section id="ai-poisk-tovarov-boris-block" class="bapt-root" aria-label="Анимация: семантическое сопоставление запроса с карточками каталога">
<style>
/* === БОРИС: prefix bapt-, scoped внутри #ai-poisk-tovarov-boris-block === */
#ai-poisk-tovarov-boris-block.bapt-root{
  padding:56px 0 64px;
  background:#f1f5f9;
}
#ai-poisk-tovarov-boris-block .bapt-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-poisk-tovarov-boris-block .bapt-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:520px;
}
@media(max-width:1023px){
  #ai-poisk-tovarov-boris-block .bapt-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-poisk-tovarov-boris-block .bapt-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-poisk-tovarov-boris-block .bapt-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-poisk-tovarov-boris-block .bapt-ey{
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
#ai-poisk-tovarov-boris-block .bapt-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0891b2;
  border-radius:1px;
}
#ai-poisk-tovarov-boris-block .bapt-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-poisk-tovarov-boris-block .bapt-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-poisk-tovarov-boris-block .bapt-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-poisk-tovarov-boris-block .bapt-ic{
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
#ai-poisk-tovarov-boris-block .bapt-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-poisk-tovarov-boris-block .bapt-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-poisk-tovarov-boris-block .bapt-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-poisk-tovarov-boris-block .bapt-pl-b{background:rgba(37,99,235,.08);color:#1d4ed8;border:1.5px solid rgba(37,99,235,.22);}
#ai-poisk-tovarov-boris-block .bapt-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#ai-poisk-tovarov-boris-block .bapt-foot{
  font-size:13.5px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-poisk-tovarov-boris-block .bapt-rgt{
  background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);
  position:relative;
  overflow:hidden;
  min-height:400px;
}
@media(max-width:1023px){
  #ai-poisk-tovarov-boris-block .bapt-rgt{min-height:380px;}
}
#bapt-semantic-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bapt-cnt">
  <div class="bapt-card">
    <div class="bapt-lft">
      <span class="bapt-ey">Семантика в действии</span>
      <h3 class="bapt-h3">Запрос без артикула → embeddings → top-3 SKU из вашего каталога</h3>
      <ul class="bapt-ul">
        <li><span class="bapt-ic">1</span>Query understanding: «перфоратор для бетона до 15 кг»</li>
        <li><span class="bapt-ic">2</span>BM25 ловит бренды и артикулы, embeddings — смысл</li>
        <li><span class="bapt-ic">3</span>RRF fusion объединяет кандидатов в единый рейтинг</li>
        <li><span class="bapt-ic">✓</span>Выдача: релевантные карточки, даже без точных слов в названии</li>
      </ul>
      <div class="bapt-pills">
        <span class="bapt-pl bapt-pl-b">BM25 + vectors</span>
        <span class="bapt-pl bapt-pl-v">top-3 · 94%</span>
        <span class="bapt-pl bapt-pl-g">zero-result ↓</span>
      </div>
      <p class="bapt-foot">Дальше — сегменты e-commerce и B2B-каталогов →</p>
    </div>
    <div class="bapt-rgt">
      <canvas id="bapt-semantic-canvas" role="img" aria-label="Анимация: запрос проходит через векторное пространство и ранжирует карточки товаров"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  var cv = document.getElementById('bapt-semantic-canvas');
  if (!cv) return;
  var cx = cv.getContext('2d');
  var W = 0, H = 0, fr = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 520;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    cyan:'#38bdf8', cyanD:function(a){return 'rgba(56,189,248,'+a+')';},
    viol:'#a78bfa', violD:function(a){return 'rgba(167,139,250,'+a+')';},
    green:'#4ade80', greenD:function(a){return 'rgba(74,222,128,'+a+')';},
    text:'#e2e8f0', muted:'rgba(226,232,240,.45)',
    card:'rgba(255,255,255,.07)', cardBdr:'rgba(255,255,255,.12)',
    line:'rgba(255,255,255,.06)'
  };

  var QUERY = '\u00ab\u043f\u0435\u0440\u0444\u043e\u0440\u0430\u0442\u043e\u0440 \u0434\u043b\u044f \u0431\u0435\u0442\u043e\u043d\u0430 \u0434\u043e 15 \u043a\u0433\u00bb';
  var PRODUCTS = [
    {name:'Bosch GBH 2-26', score:0.96, y:0},
    {name:'Makita HR2470', score:0.91, y:0},
    {name:'DeWalt D25133K', score:0.87, y:0}
  ];

  var dots = [];
  for (var i = 0; i < 48; i++) {
    dots.push({
      x: 0.35 + Math.random() * 0.35,
      y: 0.15 + Math.random() * 0.7,
      r: 2 + Math.random() * 3,
      phase: Math.random() * Math.PI * 2,
      hue: Math.random() > 0.5 ? 'cyan' : 'viol'
    });
  }

  function lerp(a,b,t){ return a + (b-a)*t; }

  function drawGrid(){
    cx.strokeStyle = C.line;
    cx.lineWidth = 1;
    for (var gx = 0.2; gx <= 0.8; gx += 0.1) {
      cx.beginPath();
      cx.moveTo(gx*W, H*0.1);
      cx.lineTo(gx*W, H*0.92);
      cx.stroke();
    }
    for (var gy = 0.15; gy <= 0.85; gy += 0.1) {
      cx.beginPath();
      cx.moveTo(W*0.18, gy*H);
      cx.lineTo(W*0.82, gy*H);
      cx.stroke();
    }
  }

  function drawLabel(txt, x, y, col, sz){
    cx.fillStyle = col;
    cx.font = '600 ' + (sz||11) + 'px Inter,system-ui,sans-serif';
    cx.fillText(txt, x, y);
  }

  function drawCard(px, py, pw, ph, prod, rank, alpha){
    cx.globalAlpha = alpha;
    cx.fillStyle = C.card;
    cx.strokeStyle = rank === 0 ? C.greenD(0.6) : C.cardBdr;
    cx.lineWidth = rank === 0 ? 1.5 : 1;
    var rad = 10;
    cx.beginPath();
    cx.moveTo(px+rad, py);
    cx.lineTo(px+pw-rad, py);
    cx.quadraticCurveTo(px+pw, py, px+pw, py+rad);
    cx.lineTo(px+pw, py+ph-rad);
    cx.quadraticCurveTo(px+pw, py+ph, px+pw-rad, py+ph);
    cx.lineTo(px+rad, py+ph);
    cx.quadraticCurveTo(px, py+ph, px, py+ph-rad);
    cx.lineTo(px, py+rad);
    cx.quadraticCurveTo(px, py, px+rad, py);
    cx.fill();
    cx.stroke();

    cx.fillStyle = rank === 0 ? C.green : C.cyan;
    cx.font = '700 10px Inter,system-ui,sans-serif';
    cx.fillText('#' + (rank+1), px+10, py+16);
    cx.fillStyle = C.text;
    cx.font = '600 12px Inter,system-ui,sans-serif';
    cx.fillText(prod.name, px+10, py+34);
    cx.fillStyle = C.muted;
    cx.font = '10px Inter,system-ui,sans-serif';
    cx.fillText('score ' + prod.score.toFixed(2), px+10, py+50);
    cx.globalAlpha = 1;
  }

  function loop(){
    fr++;
    var cycle = fr % 360;
    var t = cycle / 360;

    cx.fillStyle = '#07091a';
    cx.fillRect(0, 0, W, H);
    drawGrid();

    /* zones */
    drawLabel('QUERY', W*0.06, H*0.08, C.cyan, 10);
    drawLabel('EMBEDDINGS', W*0.38, H*0.08, C.viol, 10);
    drawLabel('TOP SKU', W*0.72, H*0.08, C.green, 10);

    /* query box */
    var qAlpha = Math.min(1, t * 4);
    cx.globalAlpha = qAlpha;
    cx.fillStyle = C.cyanD(0.12);
    cx.strokeStyle = C.cyanD(0.45);
    cx.lineWidth = 1;
    var qx = W*0.05, qy = H*0.14, qw = W*0.22, qh = 44;
    cx.beginPath();
    cx.roundRect(qx, qy, qw, qh, 8);
    cx.fill();
    cx.stroke();
    cx.fillStyle = C.text;
    cx.font = '11px Inter,system-ui,sans-serif';
    var qShow = QUERY.substring(0, Math.floor(lerp(8, QUERY.length, Math.min(1, t*2.5))));
    cx.fillText(qShow, qx+10, qy+26);
    cx.globalAlpha = 1;

    /* vector dots */
    var pulse = 0.5 + 0.5 * Math.sin(fr * 0.04);
    dots.forEach(function(d){
      var dx = d.x * W + Math.sin(fr*0.02 + d.phase) * 4;
      var dy = d.y * H + Math.cos(fr*0.018 + d.phase) * 3;
      var col = d.hue === 'cyan' ? C.cyanD(0.35 + pulse*0.25) : C.violD(0.3 + pulse*0.2);
      cx.beginPath();
      cx.fillStyle = col;
      cx.arc(dx, dy, d.r, 0, Math.PI*2);
      cx.fill();
    });

    /* flowing particle query → embeddings */
    if (t > 0.15 && t < 0.85) {
      var pt = (t - 0.15) / 0.7;
      var px = lerp(W*0.28, W*0.55, pt);
      var py = H*0.36 + Math.sin(pt * Math.PI) * -30;
      cx.beginPath();
      cx.fillStyle = C.cyan;
      cx.arc(px, py, 5, 0, Math.PI*2);
      cx.fill();
      cx.strokeStyle = C.cyanD(0.4);
      cx.lineWidth = 2;
      cx.beginPath();
      cx.moveTo(W*0.28, H*0.36);
      cx.quadraticCurveTo(W*0.42, H*0.2, px, py);
      cx.stroke();
    }

    /* fusion badge */
    if (t > 0.45) {
      var fa = Math.min(1, (t-0.45)*4);
      cx.globalAlpha = fa;
      cx.fillStyle = C.violD(0.2);
      cx.strokeStyle = C.violD(0.5);
      var fx = W*0.44, fy = H*0.78, fw = 88, fh = 22;
      cx.beginPath();
      cx.roundRect(fx, fy, fw, fh, 11);
      cx.fill();
      cx.stroke();
      cx.fillStyle = C.viol;
      cx.font = '700 9px Inter,system-ui,sans-serif';
      cx.fillText('BM25 + RRF', fx+14, fy+14);
      cx.globalAlpha = 1;
    }

    /* product cards */
    var cardX = W * 0.68;
    var cardW = W * 0.26;
    var cardH = 58;
    PRODUCTS.forEach(function(prod, i){
      var delay = 0.55 + i * 0.12;
      var ca = t > delay ? Math.min(1, (t-delay)*5) : 0;
      var cy = H * (0.18 + i * 0.24);
      drawCard(cardX, cy, cardW, cardH, prod, i, ca);
      if (ca > 0.3) {
        cx.strokeStyle = C.greenD(0.25);
        cx.lineWidth = 1;
        cx.beginPath();
        cx.moveTo(W*0.58, H*0.36);
        cx.quadraticCurveTo(W*0.63, cy+cardH/2, cardX, cy+cardH/2);
        cx.stroke();
      }
    });

    /* scan line */
    var scanY = H * (0.12 + (fr % 200) / 200 * 0.78);
    cx.strokeStyle = C.cyanD(0.08);
    cx.lineWidth = 1;
    cx.beginPath();
    cx.moveTo(W*0.18, scanY);
    cx.lineTo(W*0.82, scanY);
    cx.stroke();

    requestAnimationFrame(loop);
  }

  if (typeof cx.roundRect !== 'function') {
    CanvasRenderingContext2D.prototype.roundRect = function(x,y,w,h,r){
      this.moveTo(x+r,y); this.lineTo(x+w-r,y);
      this.quadraticCurveTo(x+w,y,x+w,y+r);
      this.lineTo(x+w,y+h-r);
      this.quadraticCurveTo(x+w,y+h,x+w-r,y+h);
      this.lineTo(x+r,y+h);
      this.quadraticCurveTo(x,y+h,x,y+h-r);
      this.lineTo(x,y+r);
      this.quadraticCurveTo(x,y,x+r,y);
    };
  }

  loop();
})();
</script>
  </section>

  <!-- СЕКЦИЯ 3: Сегменты -->
  <section class="vna-section" id="dlya-magazina-i-b2b">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Сегменты</span>
        <h2>AI-поиск для интернет-магазина и B2B-каталога</h2>
        <p>E-commerce B2C и B2B-каталоги решают одну задачу — сократить путь от намерения к SKU. Требования различаются: в B2B критичны артикулы аналогов, совместимость и CRM.</p>
      </div>

      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card">
          <h3>Запчасти и артикулы</h3>
          <p>«Тормозные колодки Rio 2018», «фильтр аналог Mann W 712/75» — сопоставление по совместимости и синонимам брендов.</p>
        </div>
        <div class="vna-card nero-ai-delay-1">
          <h3>Стройматериалы</h3>
          <p>Десятки атрибутов: «гипсокартон влагостойкий для ванной 12 мм» находит товар без точного названия.</p>
        </div>
        <div class="vna-card nero-ai-delay-2">
          <h3>Малый бизнес</h3>
          <p>От 500–1 000 SKU — модуль Bitrix или SaaS-виджет. Кастом оправдан при B2B-логике и 1С/CRM.</p>
        </div>
      </div>

      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-table">
          <thead>
            <tr>
              <th>Сегмент</th>
              <th>Типичная боль</th>
              <th>Рекомендуемый подход</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>E-commerce B2C</td><td>zero-result, опечатки</td><td>SaaS или гибридный MVP</td></tr>
            <tr><td>B2B-каталог</td><td>артикулы, аналоги, опт</td><td>Кастом + CRM</td></tr>
            <tr><td>Запчасти</td><td>совместимость</td><td>RAG + CRM-лиды</td></tr>
            <tr><td>Стройматериалы</td><td>сложные атрибуты</td><td>Кастом + PIM/1С</td></tr>
            <tr><td>Малый бизнес</td><td>бюджет, простой каталог</td><td>Модуль Bitrix / SaaS</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- СЕКЦИЯ 4: Внедрение -->
  <section class="vna-section vna-section-alt" id="vnedrenie-pod-klyuch">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Этапы</span>
        <h2>Внедрение AI-поиска товаров под ключ: этапы и сроки</h2>
        <p>Фазовая модель Nero Network: от аудита по 20 запросам до полного rollout с A/B-тестом. Сроки: 3–4 недели (MVP) — 8–12 недель (полный проект).</p>
      </div>

      <div class="vna-timeline nero-ai-reveal">
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Фаза 0 — аудит (3–5 дней)</h3>
          <p>Топ-500/1 000 запросов из Метрики/GA4, ручная проверка 20–50 запросов, карта zero-result и synonym gaps. Лид-магнит «Проверка поиска по 20 запросам».</p>
        </div>
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Фаза 1 — MVP (3–4 недели)</h3>
          <p>Индексация каталога, гибрид BM25 + embeddings, виджет + автоподсказки, базовая аналитика zero-result rate и CTR.</p>
        </div>
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Фаза 2 — доработка (4–8 недель)</h3>
          <p>Синонимы из логов, ранжирование по конверсии, интеграция CRM (лид при «не нашёл»), A/B против старого поиска.</p>
        </div>
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Фаза 3 — AI-ассистент (опционально)</h3>
          <p>Чат-виджет с уточняющими вопросами, RAG по FAQ и совместимости.</p>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:32px;text-align:center;">
        <span class="vna-badge">Gartner · август 2025</span>
        <p style="margin-top:12px;font-size:16px;"><strong>40%</strong> enterprise-приложений получат task-specific AI-агентов к концу 2026 (против &lt;5% в 2025). Algolia: &gt;60% B2C планируют agentic AI в поиск за 12 месяцев.</p>
      </div>

      <!-- CTA Артура #2 -->
      <div class="ym-cta-block ym-cta-block--primary" id="cta-pilot" style="margin-top:32px;">
        <div class="ym-cta-block__icon" aria-hidden="true">🚀</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы к пилоту AI-поиска?</p>
          <p class="ym-cta-block__sub">Начнём с аудита по 20 запросам, затем MVP на части каталога за 3–4 недели. <a href="<?php echo esc_url($secondary_cta_url); ?>"<?php echo nero_ai_external_link_attrs($secondary_cta_url); ?>><?php echo esc_html($secondary_cta_label); ?></a> — если нужно разобраться в архитектуре до старта проекта.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Заказать внедрение AI-поиска</a>
        </div>
      </div>
    </div>
  </section>

  <!-- СЕКЦИЯ 5: Интеграции -->
  <section class="vna-section" id="integraciya">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">CMS · CRM · PIM</span>
        <h2>Разработка и интеграция AI-поиска с CMS, CRM и PIM</h2>
        <p>Без интеграций AI-поиск останется демо-виджетом. Индексатор обновляется по cron или webhook при изменении товара.</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3>1С-Битрикс · WooCommerce</h3>
          <ul>
            <li>Модули: Сотбит, Верба (Qdrant + Yandex Embeddings), ResoSearch</li>
            <li>WooCommerce: JS-виджет + API, индексация по фиду</li>
            <li>Кастом: Qdrant/pgvector + гибрид BM25, &lt;100 мс на 10K+ SKU</li>
          </ul>
        </div>
        <div class="vna-card">
          <h3>CRM и аналитика</h3>
          <ul>
            <li>zero-result → форма «помогите найти» → лид в amoCRM / Bitrix24</li>
            <li>Яндекс Метрика / GA4: search → view → add_to_cart → purchase</li>
            <li>Контекст запроса передаётся менеджеру с выдачей</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- СЕКЦИЯ 6: Цена и ROI -->
  <section class="vna-section vna-section-alt" id="cena-i-roi">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Бюджет</span>
        <h2>Сколько стоит AI-поиск товаров: цена, сроки и ROI</h2>
        <p>Ориентир Nero Network: <strong>300 000–1 200 000 ₽</strong> в зависимости от фаз, размера каталога и глубины интеграций.</p>
      </div>

      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead>
            <tr>
              <th>Фаза</th>
              <th>Срок</th>
              <th>Бюджет</th>
              <th>Что входит</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Аудит</td><td>3–5 дней</td><td>50–80 тыс. ₽</td><td>20–50 тестовых запросов, карта zero-result</td></tr>
            <tr><td>MVP</td><td>3–4 недели</td><td>250–450 тыс. ₽</td><td>Гибридный поиск, виджет, базовая аналитика</td></tr>
            <tr><td>Доработка</td><td>4–8 недель</td><td>+300–600 тыс. ₽</td><td>Синонимы, CRM, A/B, ранжирование по конверсии</td></tr>
            <tr><td>AI-ассистент</td><td>опционально</td><td>+400–700 тыс. ₽</td><td>Чат-виджет, RAG по FAQ</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vna-case-grid nero-ai-reveal" style="margin-top:32px;">
        <div class="vna-case-card">
          <div class="vna-case-tag">Дом Фарфора</div>
          <h3>AnyQuery</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">×2</span><span class="lbl">конверсия с поиска</span></div>
            <div class="vna-metric"><span class="num">1,7%</span><span class="lbl">zero-result</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Fissman</div>
          <h3>SearchBooster</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">63%</span><span class="lbl">покупок через поиск</span></div>
            <div class="vna-metric"><span class="num">0,68%</span><span class="lbl">zero-result за 3 мес.</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">123.ru</div>
          <h3>150K+ SKU</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">+12,75%</span><span class="lbl">конверсия поиска</span></div>
            <div class="vna-metric"><span class="num">+7%</span><span class="lbl">конверсия сайта</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- СЕКЦИЯ 7: Кейсы -->
  <section class="vna-section" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Результаты</span>
        <h2>Кейсы и примеры внедрения AI-поиска товаров</h2>
        <p>Реальные проекты, где замена keyword-поиска дала измеримый бизнес-результат.</p>
      </div>

      <div class="vna-case-grid nero-ai-reveal">
        <div class="vna-case-card">
          <div class="vna-case-tag">E-commerce</div>
          <h3>Технопарк + AnyQuery</h3>
          <p>nDCG +5,8%, конверсия в заказ +9%, переходы в карточки +4%.</p>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Обувь · США</div>
          <h3>Lucchese + Nobi AI</h3>
          <p>Shopify keyword не понимал сленг → <strong>$1M+</strong> инкрементальной выручки, ROI 33×.</p>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">B2B · Lamoda Tech</div>
          <h3>Внутренняя разработка</h3>
          <p>25% выручки с поиска, ML-ранжирование + LLM-as-a-judge для QA качества.</p>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Каталог 150K+</div>
          <h3>123.ru</h3>
          <p>Было 25% запросов с пустым результатом → +12,75% конверсии поисковых сессий за месяц.</p>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Посуда</div>
          <h3>Дом Фарфора</h3>
          <p>Внедрение за 1 день, через полгода конверсия с поиска ×2, zero-result 1,7%.</p>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Международный</div>
          <h3>Valentino + Zoovu</h3>
          <p>Search CVR +72%, Revenue Per User +56% за 30 дней A/B.</p>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:28px;text-align:center;">Constructor: 24% трафика → 44% выручки. Поиск окупает внедрение быстрее большинства маркетинговых экспериментов.</p>
    </div>
  </section>

  <!-- СЕКЦИЯ 8: SaaS vs кастом -->
  <section class="vna-section vna-section-alt" id="saas-vs-kastom">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Выбор стека</span>
        <h2>AI-поиск vs готовые решения: Algolia, Elasticsearch, Yandex Search API</h2>
        <p>Нет «лучшего» AI-поиска для всех — есть подходящий под каталог, бюджет и интеграции.</p>
      </div>

      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead>
            <tr>
              <th>Подход</th>
              <th>Плюсы</th>
              <th>Минусы</th>
              <th>Когда подходит</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>SaaS (AnyQuery, SearchBooster)</td>
              <td>Быстрый старт, кейсы, аналитика</td>
              <td>Абонплата, меньше кастомизации</td>
              <td>Средний e-commerce</td>
            </tr>
            <tr>
              <td>Модуль Bitrix (Сотбит, Верба)</td>
              <td>Низкий порог на Bitrix</td>
              <td>Привязка к CMS</td>
              <td>Магазин на 1С-Битрикс</td>
            </tr>
            <tr>
              <td>Algolia / Elasticsearch Cloud</td>
              <td>Enterprise-масштаб, NLP</td>
              <td>Стоимость в $, нюансы в РФ</td>
              <td>Крупный каталог</td>
            </tr>
            <tr>
              <td>Кастом (Nero Network)</td>
              <td>Гибрид под нишу, CRM, self-hosted</td>
              <td>4–12 недель, нужен фид/API</td>
              <td>Запчасти, стройматериалы, 1С/CRM</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vna-card">
          <h3>Достаточно SaaS или модуля</h3>
          <ul>
            <li>Каталог до 50–100 тыс. SKU с типовыми атрибутами</li>
            <li>Магазин на Bitrix, результат за 1–7 дней</li>
            <li>Нет сложной B2B-логики цен и аналогов</li>
          </ul>
        </div>
        <div class="vna-card">
          <h3>Нужна кастомная разработка</h3>
          <ul>
            <li>Запчасти, стройматериалы, промышленные каталоги</li>
            <li>Интеграция с 1С, PIM, CRM обязательна</li>
            <li>Self-hosted и российские embeddings (Yandex Cloud)</li>
          </ul>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:20px;">
        <p><strong>Важно:</strong> в корректной архитектуре AI только <em>извлекает</em> товары из вашего каталога (retrieval), не генерирует несуществующие SKU. Синонимы модерирует человек.</p>
      </div>
    </div>
  </section>

  <!-- СЕКЦИЯ 9: FAQ -->
  <section class="vna-section" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Вопрос — ответ</span>
        <h2>FAQ — частые вопросы про AI-поиск товаров</h2>
      </div>

      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item" id="faq-kak-vnedrit">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI-поиск товаров?</div>
          <div class="vna-faq-a"><p>Аудит (20 тестовых запросов) → выбор архитектуры (SaaS / модуль / кастом) → MVP на части каталога → A/B-тест → полный rollout. Срок MVP — от 3–4 недель. Nero Network ведёт проект под ключ.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-skolko-stoit">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит AI-поиск товаров?</div>
          <div class="vna-faq-a"><p>Ориентир: <strong>300 000–1 200 000 ₽</strong> за проект. Аудит — от 50–80 тыс. ₽, MVP — 250–450 тыс. ₽. Точная смета — после проверки каталога и 20 запросов.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-bez-programmista">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли внедрить без программиста?</div>
          <div class="vna-faq-a"><p>Да, при SaaS-виджете (SearchBooster, AnyQuery) или модуле Bitrix — подключение через фид и JS. Кастом с 1С/CRM: код пишет подрядчик, с вашей стороны — доступы и фид.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-pereindeks">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Нужно ли переиндексировать весь каталог?</div>
          <div class="vna-faq-a"><p>Да. AI-поиск строит индекс по фиду: названия, описания, атрибуты, артикулы. При изменении товара индекс обновляется автоматически (webhook/cron). Первичная индексация — 1–3 дня.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-kachestvo">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как проверить качество до запуска?</div>
          <div class="vna-faq-a"><p>Лид-магнит: проверка по 20 запросам, таблица «до/после». Офлайн-метрика nDCG на Golden Set из 100–200 запросов — для технического QA.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-cms">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Работает ли с нашей CMS?</div>
          <div class="vna-faq-a"><p>Да: 1С-Битрикс, WooCommerce, OpenCart, кастомные решения. Формат — API + виджет или модуль.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-umnyj-poisk">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от «умного поиска»?</div>
          <div class="vna-faq-a"><p>«Умный поиск» — маркетинговый зонтик. AI-поиск — гибрид keyword + embeddings + ранжирование. Семантический поиск — ключевой компонент.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-bezopasnost">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Безопасны ли данные каталога?</div>
          <div class="vna-faq-a"><p>При self-hosted (Qdrant, Meilisearch) и российских embeddings (Yandex Cloud) данные не уходят к зарубежным вендорам. SaaS — данные у провайдера; читайте DPA.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-sroki-rezultat">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Когда ожидать первые результаты?</div>
          <div class="vna-faq-a"><p>SaaS — от 1 дня. Кастомный MVP — 3–4 недели. Измеримый эффект в A/B — от 2–4 недель после запуска.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-malyj-katalog">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли для каталога &lt;1 000 товаров?</div>
          <div class="vna-faq-a"><p>При &lt;500 SKU боль слабее; при 500–1 000 уже заметна. Для малых каталогов — модуль Bitrix или SaaS с минимальным бюджетом.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- СЕКЦИЯ 10: Демо (финальный CTA Артура #3) -->
  <section class="vna-section nero-ai-section" id="demo-20-zaprosov" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="vna-cnt" style="text-align:center;">
      <span class="vna-eyebrow">Лид-магнит</span>
      <h2>Проверьте поиск по 20 запросам — бесплатное демо</h2>
      <p style="max-width:640px;margin:0 auto 20px;">Пришлите URL магазина и 20 реальных запросов — покажем zero-result «до/после» на прототипе AI-поиска.</p>
      <ul class="vna-cta-checklist">
        <li>Таблица релевантности top-3</li>
        <li>Процент пустой выдачи</li>
        <li>Демо на ваших запросах</li>
        <li>КП по фазам: аудит → MVP → rollout</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;"<?php echo $primary_cta_attrs; ?>>Улучшить поиск</a>
    </div>
  </section>

  <!-- Итоговая таблица -->
  <section class="vna-section vna-section-alt" id="itog" aria-label="Итог">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Итог</span>
        <h2>AI-поиск товаров — в двух словах</h2>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead>
            <tr><th>Вопрос</th><th>Ответ</th></tr>
          </thead>
          <tbody>
            <tr><td>Что это?</td><td>Поиск по смыслу запроса, не только по словам</td></tr>
            <tr><td>Для кого?</td><td>E-commerce, B2B-каталоги, запчасти, стройматериалы</td></tr>
            <tr><td>Сколько стоит?</td><td>300 тыс.–1,2 млн ₽, фазы от 50 тыс. ₽</td></tr>
            <tr><td>Сроки</td><td>MVP — 3–4 недели</td></tr>
            <tr><td>Первый шаг</td><td>Проверка поиска по 20 запросам</td></tr>
            <tr><td>CTA</td><td>Улучшить поиск</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

</div><!-- /.vna-content -->

<!-- FAQ accordion (для Наташи — внизу шаблона) -->
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

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

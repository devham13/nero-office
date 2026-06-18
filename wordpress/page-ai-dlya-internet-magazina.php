<?php
/**
 * Template Name: AI для интернет-магазина: поддержка заказов, возвратов и статусов под ключ
 * Description: Внедрение AI-агента поддержки e-commerce — статус заказа, возвраты 54-ФЗ, подбор размера, CRM + СДЭК.
 */

declare(strict_types=1);

$page_seo_title       = 'AI для интернет-магазина: заказы, возвраты и статусы под ключ';
$page_seo_description = 'Внедряем AI-агента поддержки для интернет-магазина: ответы по статусу заказа, возвратам, размеру и доставке. Интеграция с CRM, снижение нагрузки на операторов. Аудит сценариев бесплатно.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Боли',      'href' => '#bole'],
    ['label' => 'Сценарии',  'href' => '#scenarii'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Кейсы',     'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ',       'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить поддержку магазина';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение AI';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#';

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

/* Hero full viewport */
.ai-dlya-internet-magazina-page .aim-hero-root,
.ai-dlya-internet-magazina-page .nero-ai-hero#hero{
  min-height:100vh;min-height:100dvh;position:relative;
}

/* Pain cards */
.vna-pain-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vna-pain-grid{grid-template-columns:1fr;}}
.vna-pain-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.vna-pain-card:hover{border-color:rgba(121,242,255,.32);transform:translateY(-2px);}
.vna-pain-icon{font-size:28px;margin-bottom:12px;}
.vna-pain-card h3{font-size:17px;margin-bottom:10px;}
.vna-pain-card p{font-size:14px;margin:0;}

/* Scenario cards grid */
.vna-sc-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px;margin-top:36px;}
@media(max-width:768px){.vna-sc-grid{grid-template-columns:1fr;}}
.vna-sc-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:18px;padding:24px;transition:border-color .2s,transform .2s;
}
.vna-sc-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-2px);}
.vna-sc-card .ic{font-size:26px;margin-bottom:10px;}
.vna-sc-card h3{font-size:16px;margin-bottom:8px;}
.vna-sc-card p{font-size:14px;margin:0;}

/* Integration tags */
.vna-tags{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-top:28px;}
.vna-tag{
  padding:10px 18px;border-radius:999px;font-size:13px;font-weight:600;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:var(--vna-soft);
}
.vna-tag--note{border-style:dashed;color:var(--vna-muted);font-size:12px;}

/* Risk alert cards */
.vna-risk-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
@media(max-width:900px){.vna-risk-grid{grid-template-columns:1fr;}}
.vna-risk-card{
  border-radius:16px;padding:24px;
  background:rgba(239,68,68,.06);border:1px solid rgba(239,68,68,.22);
}
.vna-risk-card h3{font-size:16px;margin-bottom:8px;color:#fca5a5;}
.vna-risk-card p{font-size:14px;margin:0;}

/* Steps list */
.vna-steps{counter-reset:step;max-width:760px;margin:0 auto;}
.vna-step{
  position:relative;padding:0 0 28px 48px;counter-increment:step;
}
.vna-step::before{
  content:counter(step);position:absolute;left:0;top:0;
  width:32px;height:32px;border-radius:50%;
  background:rgba(121,242,255,.15);border:1px solid rgba(121,242,255,.35);
  color:var(--vna-accent);font-weight:800;font-size:14px;
  display:flex;align-items:center;justify-content:center;
}
.vna-step h3{font-size:17px;margin-bottom:6px;}
.vna-step p{font-size:14px;margin:0;}

/* Pricing 3-col */
.vna-pricing-3{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
@media(max-width:900px){.vna-pricing-3{grid-template-columns:1fr;}}

/* Boris inside dark section - light card stands out */
#scenarii #ai-dlya-internet-magazina-boris-block{margin:36px 0 8px;padding:0;background:transparent;}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlya-internet-magazina-page" role="main" tabindex="-1">

<section class="nero-ai-hero aim-hero-root" id="hero" aria-labelledby="hero-aim-title">
<style>
/* === АЛИНА: self-contained hero styles (prefix aim-) === */
.aim-hero-root{
  --aim-bg:#060a12;
  --aim-surface:rgba(15,23,42,.78);
  --aim-border:rgba(148,163,184,.14);
  --aim-heading:#f8fafc;
  --aim-muted:#94a3b8;
  --aim-accent:#79f2ff;
  --aim-violet:#8b5cf6;
  position:relative;
  overflow:hidden;
  padding:clamp(108px,14vh,148px) 0 clamp(64px,8vw,80px);
  background:
    radial-gradient(ellipse 80% 50% at 70% 20%,rgba(59,130,246,.18),transparent),
    radial-gradient(ellipse 60% 40% at 10% 80%,rgba(139,92,246,.12),transparent),
    var(--aim-bg);
  color:var(--aim-muted);
  font-family:Inter,system-ui,-apple-system,sans-serif;
}
.aim-hero-root *,.aim-hero-root *::before,.aim-hero-root *::after{box-sizing:border-box;}
.aim-hero-cnt{width:min(1200px,92vw);margin:0 auto;}
.aim-hero-grid{
  display:grid;
  grid-template-columns:1fr 1.08fr;
  gap:clamp(32px,5vw,56px);
  align-items:center;
}
.aim-eyebrow{
  display:inline-block;
  font-size:11px;
  font-weight:700;
  letter-spacing:.14em;
  text-transform:uppercase;
  color:#93c5fd;
  margin:0 0 14px;
}
.aim-h1{
  font-size:clamp(34px,5vw,56px);
  font-weight:800;
  line-height:1.08;
  letter-spacing:-.03em;
  color:var(--aim-heading);
  margin:0 0 20px;
}
.aim-gradient-text{
  background:linear-gradient(92deg,#fff 0%,var(--aim-accent) 44%,var(--aim-violet) 100%);
  -webkit-background-clip:text;
  background-clip:text;
  color:transparent!important;
}
.aim-lead{
  font-size:clamp(17px,2vw,20px);
  line-height:1.6;
  color:var(--aim-muted);
  margin:0 0 28px;
  max-width:640px;
}
.aim-badges{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin:0 0 28px;
  padding:0;
  list-style:none;
}
.aim-badge{
  padding:8px 14px;
  border-radius:999px;
  font-size:12px;
  font-weight:600;
  background:rgba(59,130,246,.12);
  border:1px solid rgba(59,130,246,.25);
  color:#bfdbfe;
}
.aim-btn-row{display:flex;flex-wrap:wrap;gap:14px;}
.aim-btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  padding:14px 26px;
  border-radius:12px;
  font-weight:700;
  font-size:15px;
  text-decoration:none;
  transition:transform .2s,box-shadow .2s;
}
.aim-btn-primary{
  background:linear-gradient(135deg,#2563eb,#7c3aed);
  color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.aim-btn-secondary{
  background:transparent;
  color:#e2e8f0!important;
  border:1px solid var(--aim-border);
}
.aim-btn:hover{transform:translateY(-2px);}

.aim-dashboard{
  background:var(--aim-surface);
  border:1px solid var(--aim-border);
  border-radius:20px;
  padding:18px;
  backdrop-filter:blur(12px);
  box-shadow:0 24px 64px rgba(0,0,0,.45);
}
.aim-dash-note{
  font-size:11px;
  color:#64748b;
  margin:0 0 12px;
  text-align:center;
}
.aim-dash-head{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:14px;
  padding-bottom:10px;
  border-bottom:1px solid var(--aim-border);
}
.aim-dash-title{font-size:14px;font-weight:700;color:var(--aim-heading);}
.aim-dash-live{
  font-size:11px;
  color:#4ade80;
  display:flex;
  align-items:center;
  gap:6px;
}
.aim-dash-live::before{
  content:'';
  width:6px;height:6px;border-radius:50%;
  background:#4ade80;
  animation:aim-pulse 2s infinite;
}
@keyframes aim-pulse{0%,100%{opacity:1}50%{opacity:.4}}
.aim-metrics{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:8px;
  margin-bottom:12px;
}
.aim-metric{
  background:rgba(30,41,59,.65);
  border:1px solid var(--aim-border);
  border-radius:12px;
  padding:10px 8px;
  text-align:center;
}
.aim-metric strong{
  display:block;
  font-size:clamp(16px,2vw,20px);
  color:var(--aim-heading);
  line-height:1.1;
}
.aim-metric span{font-size:10px;color:#94a3b8;line-height:1.3;display:block;margin-top:2px;}
.aim-canvas-wrap{
  position:relative;
  height:clamp(180px,22vw,240px);
  border-radius:14px;
  overflow:hidden;
  margin-bottom:12px;
  background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);
  border:1px solid rgba(121,242,255,.12);
}
#aim-hero-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
.aim-feed{margin-top:4px;}
.aim-feed-row{
  display:flex;
  align-items:center;
  gap:10px;
  padding:9px 0;
  border-bottom:1px solid rgba(148,163,184,.08);
  font-size:12px;
  color:#cbd5e1;
}
.aim-feed-row:last-child{border-bottom:none;}
.aim-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0;}
.aim-dot--blue{background:#3b82f6;}
.aim-dot--green{background:#22c55e;}
.aim-dot--amber{background:#f59e0b;}
@media(max-width:960px){
  .aim-hero-grid{grid-template-columns:1fr;}
  .aim-metrics{grid-template-columns:repeat(2,1fr);}
}
</style>

  <div class="aim-hero-cnt">
    <div class="aim-hero-grid">
      <div class="aim-hero-copy">
        <p class="aim-eyebrow"><?php echo esc_html($brand); ?> · ai ecommerce support</p>
        <h1 id="hero-aim-title" class="aim-h1">AI для интернет-магазина: <span class="aim-gradient-text">поддержка заказов, возвратов и статусов под ключ</span></h1>
        <p class="aim-lead">Внедрим AI-агента, который отвечает на «где заказ», «как вернуть» и «какой размер» — без перегрузки операторов поддержки</p>
        <ul class="aim-badges" aria-label="Ключевые сценарии">
          <li class="aim-badge">Статус заказа</li>
          <li class="aim-badge">Возвраты 54-ФЗ</li>
          <li class="aim-badge">Подбор размера</li>
          <li class="aim-badge">CRM + СДЭК</li>
        </ul>
        <div class="aim-btn-row">
          <a class="aim-btn aim-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a class="aim-btn aim-btn-secondary" href="#scenarii">Какие сценарии закрывает AI</a>
        </div>
      </div>

      <div class="aim-dashboard" aria-label="Демонстрация AI-поддержки магазина">
        <p class="aim-dash-note">пример логики AI-системы · демонстрационные данные</p>
        <div class="aim-dash-head">
          <span class="aim-dash-title">AI-поддержка магазина</span>
          <span class="aim-dash-live">онлайн</span>
        </div>
        <div class="aim-metrics" aria-label="Метрики поддержки">
          <div class="aim-metric"><strong>47</strong><span>входящих/час</span></div>
          <div class="aim-metric"><strong>28 сек</strong><span>первый ответ</span></div>
          <div class="aim-metric"><strong>62%</strong><span>без оператора</span></div>
          <div class="aim-metric"><strong>−41%</strong><span>нагрузка*</span></div>
        </div>
        <div class="aim-canvas-wrap">
          <canvas id="aim-hero-canvas" aria-label="Анимация: омниканальная диспетчерская поддержки — тикеты заказов, возвратов и размеров обрабатываются AI-агентом" role="img"></canvas>
        </div>
        <div class="aim-feed" aria-label="Лента обработки обращений">
          <div class="aim-feed-row"><span class="aim-dot aim-dot--blue" aria-hidden="true"></span>«Где заказ?» → CRM+СДЭК → ответ</div>
          <div class="aim-feed-row"><span class="aim-dot aim-dot--amber" aria-hidden="true"></span>«Как вернуть?» → 54-ФЗ → инструкция</div>
          <div class="aim-feed-row"><span class="aim-dot aim-dot--green" aria-hidden="true"></span>«Какой размер?» → RAG → рекомендация</div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function(){
  var canvas = document.getElementById('aim-hero-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var cw = 0, ch = 0, frame = 0, scale = 1;
  var cx = 0, cy = 0;
  var phaseLabel = 'intake';
  var resolvedCount = 0;

  function resizeCanvas(){
    var p = canvas.parentElement;
    if (!p) return;
    canvas.width = p.clientWidth || 640;
    canvas.height = p.clientHeight || 220;
    cw = canvas.width; ch = canvas.height;
    cx = cw * 0.58; cy = ch * 0.48;
    scale = Math.min(cw / 520, ch / 220) * 0.95;
  }
  window.addEventListener('resize', resizeCanvas);
  resizeCanvas();

  var C = {
    outline: '#1e293b',
    hubBg: '#0f172a',
    hubBorder: '#334155',
    river: '#1d4ed8',
    riverGlow: 'rgba(121,242,255,0.25)',
    parcel: '#f97316',
    returnSlip: '#fbbf24',
    sizeTile: '#a78bfa',
    text: '#e2e8f0',
    muted: '#64748b',
    green: '#22c55e',
    agentYellow: '#eab308',
    agentGreen: '#10b981',
    agentBlue: '#3b82f6',
    agentPink: '#ec4899',
    agentPurple: '#8b5cf6',
    bubbleBg: '#ffffff'
  };

  function rr(ctx, x, y, w, h, r, fill, stroke){
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke){ ctx.lineWidth = 1.5; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  /* TicketRiver — изогнутые потоки тикетов (не конвейер) */
  function TicketRiver(){
    this.offset = 0;
  }
  TicketRiver.prototype.draw = function(ctx){
    this.offset = (frame * 0.6) % 120;
    ctx.save();
    ctx.strokeStyle = C.riverGlow;
    ctx.lineWidth = 3;
    for (var lane = 0; lane < 3; lane++){
      var baseY = ch * (0.22 + lane * 0.22);
      ctx.beginPath();
      ctx.moveTo(8, baseY);
      ctx.bezierCurveTo(cw * 0.25, baseY - 18, cw * 0.42, baseY + 22, cx - 70, cy - 10 + lane * 8);
      ctx.stroke();
      ctx.fillStyle = lane === 0 ? '#3b82f6' : (lane === 1 ? '#f59e0b' : '#22c55e');
      for (var t = -20; t < 140; t += 28){
        var prog = ((t + this.offset + lane * 14) % 140) / 140;
        var px = 8 + prog * (cx - 90);
        var py = baseY + Math.sin(prog * Math.PI) * (lane === 1 ? 14 : -10);
        ctx.globalAlpha = 0.55 + Math.sin(frame * 0.08 + t) * 0.15;
        ctx.beginPath();
        ctx.arc(px, py, 4 * scale, 0, Math.PI * 2);
        ctx.fill();
      }
    }
    ctx.globalAlpha = 1;
    ctx.restore();
  };

  /* SupportInboxHub — центральный хаб диалогов (не WebsiteTerminal) */
  function SupportInboxHub(x, y){
    this.x = x; this.y = y;
    this.cycle = 0;
    this.flash = 0;
    this.activeCard = 0;
  }
  SupportInboxHub.prototype.draw = function(ctx){
    this.cycle = (frame * 0.04) % 240;
    var w = 150 * scale, h = 120 * scale;
    rr(ctx, this.x - w/2, this.y - h/2, w, h, 10, C.hubBg, C.hubBorder);

    ctx.fillStyle = C.muted;
    ctx.font = (9 * scale) + 'px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Support Inbox', this.x - w/2 + 10, this.y - h/2 + 16);

    var cards = [
      {label: 'WISMO #4821', sub: 'СДЭК: в пути', clr: '#3b82f6'},
      {label: 'Возврат кроссовок', sub: '54-ФЗ: ок', clr: '#f59e0b'},
      {label: 'Размер L или XL?', sub: 'RAG: таблица', clr: '#a78bfa'}
    ];
    var active = Math.floor(this.cycle / 80) % 3;
    this.activeCard = active;

    for (var i = 0; i < 3; i++){
      var cy2 = this.y - h/2 + 28 + i * 30 * scale;
      var alpha = i === active ? 1 : 0.45;
      ctx.globalAlpha = alpha;
      rr(ctx, this.x - w/2 + 8, cy2, w - 16, 24 * scale, 6, 'rgba(30,41,59,0.9)', cards[i].clr);
      ctx.fillStyle = C.text;
      ctx.font = 'bold ' + (8 * scale) + 'px Inter,sans-serif';
      ctx.fillText(cards[i].label, this.x - w/2 + 14, cy2 + 10 * scale);
      ctx.fillStyle = C.muted;
      ctx.font = (7 * scale) + 'px Inter,sans-serif';
      ctx.fillText(cards[i].sub, this.x - w/2 + 14, cy2 + 18 * scale);
    }
    ctx.globalAlpha = 1;

    if (this.cycle > 200){
      this.flash = Math.min(20, this.flash + 1);
      var fa = 1 - this.flash / 20;
      ctx.fillStyle = 'rgba(34,197,94,' + (fa * 0.35) + ')';
      rr(ctx, this.x - w/2, this.y - h/2, w, h, 10, 'rgba(34,197,94,' + (fa * 0.35) + ')', C.green);
      if (this.flash === 1) resolvedCount++;
    } else {
      this.flash = 0;
    }

    if (this.cycle < 60) phaseLabel = 'intake';
    else if (this.cycle < 110) phaseLabel = 'classify';
    else if (this.cycle < 170) phaseLabel = 'api_lookup';
    else if (this.cycle < 200) phaseLabel = 'draft_reply';
    else phaseLabel = 'resolved';
  };

  function OrderParcel(x, y, spd){
    this.x = x; this.y = y; this.spd = spd;
    this.t = Math.random() * 100;
  }
  OrderParcel.prototype.draw = function(ctx){
    this.t += this.spd;
    var ox = this.x + Math.sin(this.t * 0.03) * 12;
    var oy = this.y + Math.cos(this.t * 0.04) * 6;
    rr(ctx, ox - 14, oy - 10, 28, 20, 4, C.parcel, C.outline);
    ctx.fillStyle = '#fff';
    ctx.font = 'bold 7px sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('TRACK', ox, oy + 2);
  };

  function ReturnSlip(x, y){
    this.x = x; this.y = y;
    this.wave = Math.random() * 6;
  }
  ReturnSlip.prototype.draw = function(ctx){
    this.wave += 0.04;
    var dy = Math.sin(this.wave) * 3;
    rr(ctx, this.x - 12, this.y + dy - 14, 24, 28, 3, '#fffbeb', C.returnSlip);
    ctx.fillStyle = C.returnSlip;
    ctx.font = '6px sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('54-ФЗ', this.x, this.y + dy);
  };

  function SizeGuideTile(x, y){
    this.x = x; this.y = y;
    this.pulse = 0;
  }
  SizeGuideTile.prototype.draw = function(ctx){
    this.pulse = (Math.sin(frame * 0.06) + 1) * 0.5;
    rr(ctx, this.x - 16, this.y - 12, 32, 24, 4, 'rgba(167,139,250,0.15)', C.sizeTile);
    for (var r = 0; r < 3; r++){
      for (var c = 0; c < 3; c++){
        ctx.fillStyle = (r === 1 && c === 1) ? C.sizeTile : 'rgba(148,163,184,0.35)';
        ctx.fillRect(this.x - 12 + c * 9, this.y - 8 + r * 6, 7, 4);
      }
    }
  };

  function CdekPing(x, y){
    this.x = x; this.y = y;
    this.angle = 0;
  }
  CdekPing.prototype.draw = function(ctx){
    this.angle += 0.02;
    ctx.strokeStyle = 'rgba(121,242,255,0.35)';
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.arc(this.x, this.y, 18 + Math.sin(frame * 0.05) * 3, 0, Math.PI * 2);
    ctx.stroke();
    ctx.fillStyle = C.riverGlow;
    ctx.beginPath();
    ctx.arc(this.x + Math.cos(this.angle) * 14, this.y + Math.sin(this.angle) * 8, 3, 0, Math.PI * 2);
    ctx.fill();
  };

  function HandoffBell(x, y){
    this.x = x; this.y = y;
    this.ring = 0;
  }
  HandoffBell.prototype.draw = function(ctx){
    if (phaseLabel === 'draft_reply' && frame % 90 < 12) this.ring = 1;
    var shake = this.ring ? Math.sin(frame * 0.8) * 2 : 0;
    ctx.fillStyle = '#fbbf24';
    ctx.beginPath();
    ctx.arc(this.x + shake, this.y, 7, Math.PI, 0);
    ctx.lineTo(this.x + 9 + shake, this.y + 4);
    ctx.lineTo(this.x - 9 + shake, this.y + 4);
    ctx.closePath();
    ctx.fill();
    if (this.ring){
      ctx.strokeStyle = 'rgba(251,191,36,0.4)';
      ctx.beginPath();
      ctx.arc(this.x, this.y, 12 + (frame % 12), 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  function Agent(x, y, color, role, dialogs){
    this.homeX = x; this.homeY = y;
    this.x = x; this.y = y;
    this.color = color;
    this.role = role;
    this.dialogs = dialogs;
    this.dir = 1;
    this.bubble = null;
    this.stepTrig = Math.random() * 200;
    this.targetX = cx - 100;
    this.targetY = cy + 40;
  }
  Agent.prototype.draw = function(ctx){
    this.stepTrig = (this.stepTrig + 0.35) % 200;
    var destX = this.targetX + (this.role === '3_coder' ? -30 : (this.role === '4_designer' ? 20 : 0));
    var destY = this.targetY + (this.role === '1_architect' ? -25 : 10);
    if (this.stepTrig > 40 && this.stepTrig < 160){
      this.x += (destX - this.x) * 0.04;
      this.y += (destY - this.y) * 0.04;
    } else {
      this.x += (this.homeX - this.x) * 0.05;
      this.y += (this.homeY - this.y) * 0.05;
    }
    if (Math.random() < 0.004) this.bubble = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
    if (this.bubble) createBubble(ctx, this.x, this.y - 22, this.bubble, this.color);

    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y, 7 * scale, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath();
    ctx.arc(this.x, this.y - 9 * scale, 5 * scale, 0, Math.PI * 2);
    ctx.fill();
    var leg = Math.sin(frame * 0.12 + this.stepTrig) * 3;
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(this.x, this.y + 6);
    ctx.lineTo(this.x - 4 + leg, this.y + 14);
    ctx.moveTo(this.x, this.y + 6);
    ctx.lineTo(this.x + 4 - leg, this.y + 14);
    ctx.stroke();
  };

  function createBubble(ctx, x, y, text, accent){
    var pad = 6, maxW = 110 * scale;
    ctx.font = (8 * scale) + 'px Inter,sans-serif';
    var words = text.split(' ');
    var lines = [], line = '';
    for (var i = 0; i < words.length; i++){
      var test = line + words[i] + ' ';
      if (ctx.measureText(test).width > maxW && line){ lines.push(line); line = words[i] + ' '; }
      else line = test;
    }
    if (line) lines.push(line);
    var bh = lines.length * 11 * scale + pad * 2;
    var bw = Math.min(maxW, Math.max.apply(null, lines.map(function(l){ return ctx.measureText(l).width; })) + pad * 2);
    rr(ctx, x - bw/2, y - bh - 4, bw, bh, 6, C.bubbleBg, accent);
    ctx.fillStyle = '#0f172a';
    ctx.textAlign = 'center';
    for (var j = 0; j < lines.length; j++){
      ctx.fillText(lines[j].trim(), x, y - bh + pad + 8 + j * 11 * scale);
    }
  }

  var river = new TicketRiver();
  var hub = new SupportInboxHub(cx, cy);
  var decor = [
    new OrderParcel(cw * 0.12, ch * 0.72, 0.5),
    new ReturnSlip(cw * 0.88, ch * 0.28),
    new SizeGuideTile(cw * 0.1, ch * 0.25),
    new CdekPing(cw * 0.86, ch * 0.72),
    new HandoffBell(cx + 80 * scale, cy - 50 * scale)
  ];
  var agents = [
    new Agent(36, ch - 36, C.agentYellow, '1_architect', [
      'Карта сценариев: статус → возврат → размер',
      'Приоритет WISMO — 40% тикетов',
      'Пилот начинаем с одного канала'
    ]),
    new Agent(36, ch * 0.55, C.agentGreen, '2_seo', [
      'Интент: «где посылка СДЭК»',
      'Кластер НЧ: ai статус заказа',
      'GEO: ответ в первом экране'
    ]),
    new Agent(36, ch * 0.32, C.agentBlue, '3_coder', [
      'API RetailCRM: статус только из CRM',
      'СДЭК v2: трек без галлюцинаций',
      'Handoff при низкой уверенности'
    ]),
    new Agent(cw - 36, ch * 0.32, C.agentPink, '4_designer', [
      'Тон бренда в ответе про возврат',
      'Инструкция 54-ФЗ человеческим языком',
      'Таблица размеров в пузыре RAG'
    ]),
    new Agent(cw - 36, ch - 36, C.agentPurple, '5_deployer', [
      'Deflection 62% на пилоте',
      'FRT: 28 сек вместо 12 мин',
      'Омниканал: Telegram + виджет'
    ])
  ];

  function drawGrid(){
    ctx.strokeStyle = 'rgba(148,163,184,0.06)';
    ctx.lineWidth = 1;
    for (var gx = 0; gx < cw; gx += 24){
      ctx.beginPath(); ctx.moveTo(gx, 0); ctx.lineTo(gx, ch); ctx.stroke();
    }
    for (var gy = 0; gy < ch; gy += 24){
      ctx.beginPath(); ctx.moveTo(0, gy); ctx.lineTo(cw, gy); ctx.stroke();
    }
  }

  function engineloop(){
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    drawGrid();
    river.draw(ctx);
    decor.forEach(function(d){ d.draw(ctx); });
    hub.draw(ctx);
    agents.forEach(function(a){ a.draw(ctx); });

    if (frame % 140 === 0) createBubble(ctx, cx, cy - 70, 'Тикет закрыт без оператора', C.green);
    if (frame % 200 === 50) createBubble(ctx, cw * 0.5, ch * 0.15, 'CRM + СДЭК: статус из API', C.riverGlow);
    if (frame % 180 === 90) createBubble(ctx, cw * 0.2, ch * 0.5, 'Возврат: консультация по 54-ФЗ', C.returnSlip);
    if (phaseLabel === 'api_lookup' && frame % 60 === 0) createBubble(ctx, cx + 40, cy, 'Запрос трека…', '#79f2ff');

    ctx.fillStyle = 'rgba(15,23,42,0.75)';
    rr(ctx, 8, 8, 92, 18, 6, 'rgba(15,23,42,0.75)', C.hubBorder);
    ctx.fillStyle = '#94a3b8';
    ctx.font = '8px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('фаза: ' + phaseLabel, 14, 20);
    ctx.textAlign = 'right';
    ctx.fillText('закрыто: ' + resolvedCount, cw - 12, 20);

    requestAnimationFrame(engineloop);
  }
  engineloop();
})();
</script>
<div class="vna-content">

  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Коротко · ai ecommerce</p>
          <p><strong>AI для интернет-магазина</strong> — не виджет с FAQ, а гибрид: языковая модель + доступ к заказу в CRM/OMS + база знаний + эскалация на оператора. Мы внедряем таких агентов под ключ — от разбора тикетов до связки с RetailCRM, Bitrix и СДЭК.</p>
          <p>Покупатель пишет «где заказ» и ждёт ответ за секунды. Возврат, размер, доставка — те же ожидания. Когда поддержка не успевает, растут отказы и падают повторные покупки. <strong>Внедрение AI для интернет-магазина</strong> бьёт в рутину: статус, возвраты по 54-ФЗ, подбор размера — без перегрузки команды.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Показатели рынка e-commerce">
          <div class="vna-kpi-card">
            <div class="kv">+30%</div>
            <div class="kl">письменных обращений за 3 года</div>
            <div class="ks">RetailCRM, 55 млн диалогов</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">46%</div>
            <div class="kl">пишут в чат при проблеме с заказом</div>
            <div class="ks">Retail.ru, 2026</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">30–50%</div>
            <div class="kl">типовых тикетов в поддержке</div>
            <div class="ks">Open.cx / Gorgias</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">25–45%</div>
            <div class="kl">обращений — «где заказ»</div>
            <div class="ks">WISMO-кластер</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc ym-toc" aria-label="Оглавление">
        <a href="#bole">Боли</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="vna-section" id="bole">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Почему горит поддержка</span>
        <h2>Почему поддержка интернет-магазина<br>тонет в одних и тех же вопросах</h2>
        <p>Операторы тратят смену на повторяющиеся сценарии вместо сложных претензий. Автоматизация через <strong>ai для интернет магазина</strong> бьёт именно в этот пласт — измеримо и по цифрам.</p>
      </div>
      <div class="vna-pain-grid nero-ai-reveal">
        <div class="vna-pain-card">
          <div class="vna-pain-icon" aria-hidden="true">📦</div>
          <h3>«Где мой заказ» — до 45% тикетов</h3>
          <p>WISMO — главный триггер обращений. Покупатель уже оплатил: каждая минута ожидания — риск отмены. <strong>AI статус заказа</strong> тянет факты из CRM и API перевозчика за секунды, не из «памяти» модели.</p>
        </div>
        <div class="vna-pain-card">
          <div class="vna-pain-icon" aria-hidden="true">↩️</div>
          <h3>Возвраты и размеры — ещё 30–40%</h3>
          <p>Возвраты — 15–25% обращений, вопросы по товару — ~15%. Каждый диалог требует сверки с политикой, 54-ФЗ и статусом заказа. <strong>AI возвраты интернет магазин</strong> и <strong>ai подбор размера</strong> закрывают консультацию; оператор — только в спорных случаях.</p>
        </div>
        <div class="vna-pain-card">
          <div class="vna-pain-icon" aria-hidden="true">⏱️</div>
          <h3>Задержка ответа бьёт по LTV</h3>
          <p>30% покупателей не могут достучаться до поддержки (Retail.ru, 2026). Средний чек в чатах выше телефона, но планка ожиданий тоже выше. Медленный ответ режет повторные заказы сильнее, чем кажется на первый взгляд.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:32px;text-align:center;max-width:720px;margin-left:auto;margin-right:auto;font-size:15px;color:var(--vna-soft);">Итог: +30% письменных обращений за три года (RetailCRM) и концентрация типовых сценариев в половине нагрузки — не тренд, а измеримая боль.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="scenarii">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Сценарии AI-агента</span>
        <h2>Что делает AI-агент поддержки<br>для интернет-магазина</h2>
        <p>Гибрид LLM и бизнес-логики: для статуса и сумм — только API, модель формулирует ответ человеческим языком. Это <strong>ai для интернет магазина для бизнеса</strong>, а не виджет с заготовками.</p>
      </div>

      <section id="ai-dlya-internet-magazina-boris-block" class="bshop-root" aria-label="Анимация: маршрут обращения покупателя через AI-агента к CRM и службе доставки">
<style>
/* === БОРИС: prefix bshop-, scoped внутри #ai-dlya-internet-magazina-boris-block === */
#ai-dlya-internet-magazina-boris-block.bshop-root{
  padding:48px 0 56px;
  background:linear-gradient(180deg,rgba(121,242,255,.04) 0%,transparent 100%);
}
#ai-dlya-internet-magazina-boris-block .bshop-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-dlya-internet-magazina-boris-block .bshop-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.16);
  min-height:480px;
}
@media(max-width:1023px){
  #ai-dlya-internet-magazina-boris-block .bshop-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-dlya-internet-magazina-boris-block .bshop-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-dlya-internet-magazina-boris-block .bshop-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-dlya-internet-magazina-boris-block .bshop-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#06b6d4;
  margin:0 0 14px;
}
#ai-dlya-internet-magazina-boris-block .bshop-ey::before{
  content:'';
  width:18px;height:2px;
  background:#06b6d4;
  border-radius:1px;
}
#ai-dlya-internet-magazina-boris-block .bshop-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-dlya-internet-magazina-boris-block .bshop-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-dlya-internet-magazina-boris-block .bshop-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-dlya-internet-magazina-boris-block .bshop-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(6,182,212,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0891b2;
  margin-top:1px;
  font-style:normal;
}
#ai-dlya-internet-magazina-boris-block .bshop-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-dlya-internet-magazina-boris-block .bshop-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-dlya-internet-magazina-boris-block .bshop-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-dlya-internet-magazina-boris-block .bshop-pl-c{
  background:rgba(6,182,212,.08);
  color:#0e7490;
  border:1.5px solid rgba(6,182,212,.22);
}
#ai-dlya-internet-magazina-boris-block .bshop-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-dlya-internet-magazina-boris-block .bshop-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-dlya-internet-magazina-boris-block .bshop-rgt{
  position:relative;
  background:linear-gradient(135deg,#f0fdfa 0%,#ecfeff 40%,#f8fafc 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-dlya-internet-magazina-boris-block .bshop-rgt{min-height:360px;}
}
#bshop-support-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bshop-cnt">
  <div class="bshop-card">

    <div class="bshop-lft">
      <span class="bshop-ey">Схема в действии</span>
      <h3 class="bshop-h3">Покупатель спрашивает «где заказ» — AI берёт факты из CRM и СДЭК, не из «памяти» модели</h3>
      <ul class="bshop-ul">
        <li><span class="bshop-ic">1</span>Классификатор определяет намерение: статус, возврат, размер или доставка</li>
        <li><span class="bshop-ic">2</span>Для статуса — API CRM + трек СДЭК/Boxberry; ответ только из учётных систем</li>
        <li><span class="bshop-ic">3</span>LLM формулирует ответ человеческим языком с треком и ETA</li>
        <li><span class="bshop-ic">?</span>Низкая уверенность или негатив — handoff оператору с полным контекстом</li>
      </ul>
      <div class="bshop-pills">
        <span class="bshop-pl bshop-pl-c">25–45% тикетов — статус</span>
        <span class="bshop-pl bshop-pl-g">88% resolution (Searchlab)</span>
        <span class="bshop-pl bshop-pl-v">API-first</span>
      </div>
      <p class="bshop-foot">Дальше — четыре сценария, которые закрывает агент →</p>
    </div>

    <div class="bshop-rgt">
      <canvas
        id="bshop-support-pipeline-canvas"
        aria-label="Анимация: сообщение покупателя проходит через AI-агента к CRM и службе доставки, возвращается ответ или эскалация оператору"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bshop-support-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0, cycle = 0;

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
    buyer:'#3b82f6',
    buyerBg:'#eff6ff',
    ai:'#8b5cf6',
    aiGlow:'rgba(139,92,246,.22)',
    crm:'#06b6d4',
    crmBg:'#ecfeff',
    ship:'#22c55e',
    shipBg:'#f0fdf4',
    op:'#f59e0b',
    opBg:'#fffbeb',
    bubble:'#ffffff',
    bubbleBdr:'#cbd5e1',
    line:'rgba(6,182,212,.4)',
    lineDash:'rgba(139,92,246,.35)',
    packet:'#79f2ff',
    text:'#1e293b'
  };

  var SCENARIOS = [
    {key:'status', label:'Статус', color:C.crm, msg:'Где мой заказ?'},
    {key:'return', label:'Возврат', color:C.op, msg:'Как вернуть?'},
    {key:'size', label:'Размер', color:C.ai, msg:'Какой размер?'}
  ];

  var packets = [];
  var bubbles = [];
  var activeScenario = 0;
  var phase = 0;
  var phaseT = 0;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function layout(){
    return {
      buyer: {x: W*0.1, y: H*0.5, r: Math.min(W,H)*0.07},
      ai:    {x: W*0.42, y: H*0.5, r: Math.min(W,H)*0.085},
      crm:   {x: W*0.72, y: H*0.28, w: W*0.22, h: H*0.22},
      ship:  {x: W*0.72, y: H*0.62, w: W*0.22, h: H*0.2},
      op:    {x: W*0.88, y: H*0.5, r: Math.min(W,H)*0.055}
    };
  }

  function drawNode(x,y,r,fill,stroke,icon,label,sub){
    var g = ctx.createRadialGradient(x,y,0,x,y,r*2);
    g.addColorStop(0, fill.replace(')',',.15)').replace('rgb','rgba').replace('#',''));
    ctx.fillStyle = 'rgba(255,255,255,.6)';
    ctx.beginPath(); ctx.arc(x,y,r*1.5,0,Math.PI*2); ctx.fill();

    rr(x-r,y-r,r*2,r*2,r*0.35,'#fff',stroke,2);
    ctx.fillStyle = stroke;
    ctx.font = 'bold ' + Math.max(14,r*0.45) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(icon, x, y-2);
    ctx.fillStyle = C.text;
    ctx.font = 'bold ' + Math.max(10,r*0.22) + 'px system-ui,sans-serif';
    ctx.fillText(label, x, y+r+14);
    if(sub){
      ctx.fillStyle = C.muted;
      ctx.font = Math.max(8,r*0.16) + 'px system-ui,sans-serif';
      ctx.fillText(sub, x, y+r+28);
    }
  }

  function drawBox(x,y,w,h,title,rows,color,bg){
    rr(x,y,w,h,10,bg,color,2);
    ctx.fillStyle = color;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(title, x+10, y+18);
    ctx.fillStyle = C.text;
    ctx.font = '9px system-ui,sans-serif';
    for(var i=0;i<rows.length;i++){
      rr(x+8,y+24+i*20,w-16,16,4,'#fff',color,1);
      ctx.fillText(rows[i], x+14, y+36+i*20);
    }
  }

  function drawBubble(b){
    if(b.alpha < 0.02) return;
    ctx.globalAlpha = b.alpha;
    var bw = Math.min(120, W*0.28);
    var bh = 28;
    rr(b.x-bw/2,b.y-bh/2,bw,bh,8,C.bubble,C.bubbleBdr,1.5);
    ctx.fillStyle = C.text;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(b.text, b.x, b.y);
    ctx.globalAlpha = 1;
  }

  function spawnPacket(fromX,fromY,toX,toY,color,delay){
    packets.push({x:fromX,y:fromY,tx:toX,ty:toY,t:0,delay:delay||0,color:color,speed:0.018+Math.random()*0.008});
  }

  function resetCycle(){
    cycle++;
    phase = 0;
    phaseT = 0;
    packets = [];
    bubbles = [];
    activeScenario = cycle % SCENARIOS.length;
  }

  function tick(){
    frame++;
    phaseT++;
    var L = layout();
    var sc = SCENARIOS[activeScenario];
    var pulse = 0.5 + 0.5*Math.sin(frame*0.07);

    /* фазы цикла ~480 кадров */
    var LOOP = 480;
    if(phaseT > LOOP) resetCycle();

    if(phaseT === 30){
      bubbles.push({x:L.buyer.x+40,y:L.buyer.y-20,text:sc.msg,alpha:0,t:0});
    }
    if(phaseT === 60){
      spawnPacket(L.buyer.x+30,L.buyer.y,L.ai.x-L.ai.r,L.ai.y,C.buyer,0);
    }
    if(phaseT === 120){
      spawnPacket(L.ai.x+L.ai.r,L.ai.y-10,L.crm.x,L.crm.y+L.crm.h/2,C.crm,0);
      if(sc.key === 'status'){
        spawnPacket(L.ai.x+L.ai.r,L.ai.y+10,L.ship.x,L.ship.y+L.ship.h/2,C.ship,15);
      }
    }
    if(phaseT === 200){
      spawnPacket(L.crm.x+L.crm.w/2,L.crm.y+L.crm.h,L.ai.x,L.ai.y-L.ai.r,C.packet,0);
      if(sc.key === 'status'){
        spawnPacket(L.ship.x+L.ship.w/2,L.ship.y,L.ai.x,L.ai.y+L.ai.r,C.packet,10);
      }
    }
    if(phaseT === 280){
      var reply = sc.key === 'status' ? 'В пути, трек СДЭК…' :
                  sc.key === 'return' ? 'Инструкция 54-ФЗ' : 'Размер M, по таблице';
      bubbles.push({x:L.buyer.x+50,y:L.buyer.y+35,text:reply,alpha:0,t:0});
      spawnPacket(L.ai.x-L.ai.r,L.ai.y,L.buyer.x+20,L.buyer.y,C.ship,0);
    }
    if(phaseT === 380 && sc.key === 'return'){
      spawnPacket(L.ai.x+L.ai.r,L.ai.y,L.op.x-L.op.r,L.op.y,C.op,0);
      bubbles.push({x:L.op.x,y:L.op.y-30,text:'Оператор',alpha:0,t:0});
    }

    ctx.clearRect(0,0,W,H);

    /* подписи зон */
    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Покупатель', L.buyer.x-20, H*0.08);
    ctx.textAlign = 'center';
    ctx.fillText('AI-агент', L.ai.x, H*0.08);
    ctx.textAlign = 'right';
    ctx.fillText('CRM + логистика', W*0.94, H*0.08);

    /* пунктирные маршруты */
    ctx.strokeStyle = C.lineDash;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([5,5]);
    ctx.beginPath();
    ctx.moveTo(L.buyer.x+L.buyer.r,L.buyer.y);
    ctx.lineTo(L.ai.x-L.ai.r,L.ai.y);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(L.ai.x+L.ai.r,L.ai.y-8);
    ctx.lineTo(L.crm.x,L.crm.y+L.crm.h/2);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(L.ai.x+L.ai.r,L.ai.y+8);
    ctx.lineTo(L.ship.x,L.ship.y+L.ship.h/2);
    ctx.stroke();
    ctx.setLineDash([]);

    /* узлы */
    drawNode(L.buyer.x,L.buyer.y,L.buyer.r,C.buyerBg,C.buyer,'🛒','Покупатель','чат / Telegram');
    drawNode(L.ai.x,L.ai.y,L.ai.r,'#f5f3ff',C.ai,'AI','Классификатор',sc.label);

    /* пульс AI */
    ctx.strokeStyle = C.ai;
    ctx.lineWidth = 2 + pulse*2;
    ctx.globalAlpha = 0.25 + pulse*0.35;
    ctx.beginPath();
    ctx.arc(L.ai.x,L.ai.y,L.ai.r+8+pulse*10,0,Math.PI*2);
    ctx.stroke();
    ctx.globalAlpha = 1;

    drawBox(L.crm.x,L.crm.y,L.crm.w,L.crm.h,'RetailCRM / Bitrix',
      ['Заказ #48291','Статус: отгружен','Оплата: ✓'],C.crm,C.crmBg);
    drawBox(L.ship.x,L.ship.y,L.ship.w,L.ship.h,'СДЭК / Boxberry',
      ['Трек: 1234567890','Статус: в пути','ETA: завтра'],C.ship,C.shipBg);
    drawNode(L.op.x,L.op.y,L.op.r,C.opBg,C.op,'👤','Оператор','handoff');

    /* пакеты данных */
    packets.forEach(function(p){
      if(p.delay > 0){ p.delay--; return; }
      p.t += p.speed;
      if(p.t > 1) p.t = 1;
      var px = p.x + (p.tx-p.x)*p.t;
      var py = p.y + (p.ty-p.y)*p.t;
      ctx.fillStyle = p.color;
      ctx.beginPath();
      ctx.arc(px,py,5,0,Math.PI*2);
      ctx.fill();
      ctx.fillStyle = '#fff';
      ctx.beginPath();
      ctx.arc(px,py,2,0,Math.PI*2);
      ctx.fill();
    });
    packets = packets.filter(function(p){ return p.t < 1 || p.delay > 0; });

    /* пузыри сообщений */
    bubbles.forEach(function(b){
      b.t += 0.04;
      b.alpha = Math.min(1, b.t);
      if(b.t > 0.5 && b.t < 0.55) b.alpha = 1;
      if(b.t > 3.5) b.alpha = Math.max(0, 1-(b.t-3.5)*0.5);
      drawBubble(b);
    });
    bubbles = bubbles.filter(function(b){ return b.t < 5; });

    /* легенда сценария */
    ctx.fillStyle = sc.color;
    ctx.font = 'bold 10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Сценарий: ' + sc.label, 12, H-12);

    requestAnimationFrame(tick);
  }

  resetCycle();
  requestAnimationFrame(tick);
})();
</script>
</section>

      <div class="vna-sc-grid nero-ai-reveal">
        <div class="vna-sc-card" id="scenarii-status">
          <div class="ic" aria-hidden="true">📦</div>
          <h3>Статус заказа и трекинг</h3>
          <p>Идентификация по телефону или номеру заказа → API CRM + СДЭК/Boxberry → ответ с треком и ETA. Resolution по статусу — до 88%, среднее время 25 сек (Searchlab 2026).</p>
        </div>
        <div class="vna-sc-card" id="scenarii-vozvrat">
          <div class="ic" aria-hidden="true">↩️</div>
          <h3>Возвраты по 54-ФЗ</h3>
          <p>Проверка срока, категории товара, маркировки — пошаговая инструкция или тикет в CRM. Чек «Возврат прихода» остаётся зоной кассы и оператора.</p>
        </div>
        <div class="vna-sc-card" id="scenarii-razmer">
          <div class="ic" aria-hidden="true">📏</div>
          <h3>Подбор размера через RAG</h3>
          <p>Размерные сетки бренда, уточняющие вопросы по росту и посадке. Снижает возвраты «не подошло» и разгружает <strong>ai поддержка заказов</strong> в смежных сценариях.</p>
        </div>
        <div class="vna-sc-card" id="scenarii-dostavka">
          <div class="ic" aria-hidden="true">🚚</div>
          <h3>FAQ по доставке и оплате</h3>
          <p>Зоны, ПВЗ, оплата при получении, рассрочка — 24/7 на сайте, в Telegram, WhatsApp, VK. При негативе или низкой уверенности — handoff с полным контекстом.</p>
        </div>
      </div>

      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:40px;">
        <table class="vna-table">
          <thead>
            <tr><th>Сценарий</th><th>Что делает AI</th><th>Что остаётся человеку</th></tr>
          </thead>
          <tbody>
            <tr><td>Статус заказа</td><td>Трек, ETA, уведомления</td><td>Спор по факту доставки</td></tr>
            <tr><td>Возврат</td><td>Консультация, инструкция, тикет</td><td>Спорные суммы, б/у товар</td></tr>
            <tr><td>Размер</td><td>Подбор по таблице, FAQ</td><td>Индивидуальный крой</td></tr>
            <tr><td>Доставка</td><td>Зоны, сроки, ПВЗ</td><td>Форс-мажор, утеря груза</td></tr>
            <tr><td>Претензии</td><td>Классификация, эскалация</td><td>Ведение диалога, компенсация</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="smeshannye-resheniya" aria-label="Смежные решения">
    <div class="vna-cnt">
      <p class="nero-ai-reveal" style="max-width:820px;margin:0 auto;font-size:15px;text-align:center;color:var(--vna-soft);">Часть обращений в магазин приходит по email до попадания в чат поддержки — на отдельной посадочной разобрана <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI-обработка входящей почты в CRM</a>: классификация писем, извлечение данных заказа и маршрутизация без ручного разбора ящика.</p>
    </div>
  </section>

  <section class="vna-section" id="vnedrenie">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Под ключ</span>
        <h2>Внедрение AI для интернет-магазина под ключ</h2>
        <p>Проект из фаз: аудит → пилот «статус заказа» → возвраты и размеры → омниканал. Ориентир <strong>180–600 тыс. ₽</strong> для магазина 500–5000 заказов/мес.</p>
      </div>
      <div class="vna-timeline nero-ai-reveal">
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Фаза 0: аудит (3–5 дней)</h3>
          <p>Выгрузка 2–3 месяцев тикетов, кластеризация по статус / возврат / размер / доставка. Результат — <strong>список вопросов магазина для автоматизации</strong> и бесплатный разбор 50 последних обращений.</p>
        </div>
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Фаза 1: пилот статуса (7–10 дней)</h3>
          <p>RAG-база политик, API к CRM, виджет + Telegram. <strong>Настройка ai для интернет магазина</strong> включает тон бренда, шаблоны эскалации, запретные темы.</p>
        </div>
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Фаза 2–3: расширение и омниканал</h3>
          <p>Возвраты, размеры, WhatsApp, VK. Hybrid human-in-the-loop: бот для рутины 24/7, человек — для сложного. Кнопка «Связаться с оператором» обязательна.</p>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-audit">
      <div class="ym-cta-block__icon" aria-hidden="true">🛒</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Проверить поддержку вашего магазина</p>
        <p class="ym-cta-block__sub">Бесплатный аудит 50 последних тикетов: покажем % автоматизируемых обращений, карту интеграций и сроки пилота. Плюс чеклист «Список вопросов магазина для автоматизации».</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <section class="vna-section vna-section-alt" id="integracii">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Интеграции</span>
        <h2>Интеграция AI с CRM, OMS<br>и каналами продаж</h2>
        <p>Без связки с учётными системами агент превращается в чат-бот с галлюцинациями. <strong>Интеграция ai для интернет магазина</strong> — технический фундамент доверия.</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <h3 style="font-size:18px;margin-bottom:14px;">CRM и OMS</h3>
        <p>API-шлюз заказов: RetailCRM, Bitrix24, <a href="/vnedrenie-ai-amocrm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM</a>, МойСклад, 1С:УТ, InSales, CS-Cart. <strong>AI для интернет магазина с crm</strong> получает статус, оплату, состав заказа, историю покупок.</p>
        <h3 style="font-size:18px;margin:28px 0 14px;">Логистика и каналы</h3>
        <p>СДЭК API v2, Boxberry, Почта России — статусы из трекинга, проактивные уведомления. Омниканал: виджет, Telegram, WhatsApp, VK, email.</p>
        <div class="vna-tags" aria-label="Поддерживаемые системы">
          <span class="vna-tag">RetailCRM</span>
          <span class="vna-tag">Bitrix24</span>
          <span class="vna-tag">amoCRM</span>
          <span class="vna-tag">1С:УТ</span>
          <span class="vna-tag">СДЭК</span>
          <span class="vna-tag">Boxberry</span>
          <span class="vna-tag">Telegram</span>
          <span class="vna-tag">WhatsApp</span>
          <span class="vna-tag vna-tag--note">WB / Ozon — отдельный контур</span>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Кейсы и метрики</span>
        <h2>Кейсы и метрики внедрения AI<br>в e-commerce</h2>
        <p>Только верифицируемые источники — без выдуманных цифр. <strong>Пример внедрения ai для интернет магазина</strong> и <strong>ai кейсы внедрения</strong> с пометкой источника.</p>
      </div>
      <div class="vna-case-grid nero-ai-reveal">
        <div class="vna-case-card">
          <div class="vna-case-tag">CaseUp · GPTmag, 2026</div>
          <h3>Аксессуары, Екатеринбург</h3>
          <p>YandexGPT 5 + RAG (500 FAQ) + RetailCRM. 60% обращений без оператора, FRT с 11–12 мин до 30 сек. ФОТ поддержки: 280 000 → 145 000 ₽/мес.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">60%</span><span class="lbl">deflection</span></div>
            <div class="vna-metric"><span class="num">4 мес</span><span class="lbl">окупаемость 80К ₽</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Trove Brands · Gorgias</div>
          <h3>США, AI Agent</h3>
          <p>45% automation rate, $23K экономии за месяц, response time 25 сек. Модель «skills + actions» — отдельные навыки для статуса, возврата, отмены.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">45%</span><span class="lbl">automation</span></div>
            <div class="vna-metric"><span class="num">25 сек</span><span class="lbl">ответ</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">«Твой Дом» · RetailCRM</div>
          <h3>CRM-автоматизация + AI-слой</h3>
          <p>Не чистый LLM, а автоматизация поверх OMS: скорость обработки ×2, отказы −50%, 60+ триггеров. AI строится поверх нормального CRM, а не вместо него.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">×2</span><span class="lbl">скорость</span></div>
            <div class="vna-metric"><span class="num">−50%</span><span class="lbl">отказы</span></div>
          </div>
        </div>
      </div>
      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:36px;">
        <table class="vna-table">
          <thead>
            <tr><th>Метрика</th><th>Что показывает</th><th>Ориентир</th></tr>
          </thead>
          <tbody>
            <tr><td>Deflection rate</td><td>% закрытых без оператора</td><td>30–60%; WISMO до 60–80%</td></tr>
            <tr><td>FRT</td><td>Время первого ответа</td><td>Секунды vs минуты</td></tr>
            <tr><td>Handoff rate</td><td>Доля эскалаций</td><td>Рост = дыры в базе знаний</td></tr>
            <tr><td>Hallucination flags</td><td>Ошибки по фактам</td><td>Цель — 0 на статусах</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="ceny">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Стоимость и ROI</span>
        <h2>Стоимость AI для интернет-магазина<br>и окупаемость</h2>
        <p><strong>Ai для интернет магазина цена</strong> зависит от фаз и интеграций. Окупаемость при 500+ тикетов/мес — часто 2–4 месяца.</p>
      </div>
      <div class="vna-pricing-3 nero-ai-reveal">
        <div class="vna-price-card">
          <div class="tier">Старт</div>
          <div class="amount">180–250 тыс. ₽</div>
          <div class="inc">Аудит + пилот «статус заказа»<br>CRM + 1–2 канала<br>30 дней сопровождения</div>
        </div>
        <div class="vna-price-card vna-featured">
          <div class="tier">Рекомендуем</div>
          <div class="amount">300–450 тыс. ₽</div>
          <div class="inc">+ возвраты, размеры, RAG<br>3–4 канала<br>QA-панель и обучение</div>
        </div>
        <div class="vna-price-card">
          <div class="tier">Омниканал</div>
          <div class="amount">450–600 тыс. ₽</div>
          <div class="inc">Сложные интеграции (<a href="/ai-1c-erp/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI для 1С и ERP</a>, несколько ТК)<br>Аналитика, проактивные уведомления</div>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:28px;text-align:center;font-size:15px;"><strong>Ai для интернет магазина для малого бизнеса:</strong> старт с одного канала и сценария «статус» — 7–10 дней при готовом API CRM.</p>
    </div>
  </section>

  <section class="vna-section" id="riski">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Риски</span>
        <h2>Риски AI-поддержки<br>и как их закрываем</h2>
        <p><strong>Внедрение ai агентов</strong> без контроля рисков — главная причина провалов. Архитектура API-first закрывает типовые дыры.</p>
      </div>
      <div class="vna-risk-grid nero-ai-reveal">
        <div class="vna-risk-card">
          <h3>Галлюцинации по статусу</h3>
          <p>RAG + API-only для фактов, детерминированные tool calls, еженедельный QA. Статус, сумма, трек — только из CRM и ТК.</p>
        </div>
        <div class="vna-risk-card">
          <h3>152-ФЗ и ПДн</h3>
          <p>Хранение в РФ, маскирование в логах, договор с оператором LLM. YandexGPT / GigaChat — предсказуемее для compliance.</p>
        </div>
        <div class="vna-risk-card">
          <h3>Обязательный handoff</h3>
          <p>Низкая уверенность, негатив, спорные возвраты, маркированные товары, маркетплейс-чаты WB/Ozon — всегда оператор с контекстом.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Этапы</span>
        <h2>Как внедрить AI для интернет-магазина: этапы проекта</h2>
        <p><strong>Как внедрить ai для интернет магазина</strong> без «большого взрыва»: пилот → метрики → масштабирование.</p>
      </div>
      <div class="vna-steps nero-ai-reveal">
        <div class="vna-step">
          <h3>Диагностика (3–5 дней)</h3>
          <p>Тикеты, системы, FAQ, API-доступы. Карта интеграций и приоритет сценариев.</p>
        </div>
        <div class="vna-step">
          <h3>Пилот «статус заказа» (7–10 дней)</h3>
          <p>Один канал, жёсткий API-first, замер deflection и FRT.</p>
        </div>
        <div class="vna-step">
          <h3>Расширение (10–14 дней)</h3>
          <p>Возвраты, размеры, дополнительные каналы, RAG по политикам.</p>
        </div>
        <div class="vna-step">
          <h3>Омниканал и масштабирование</h3>
          <p>WhatsApp, VK, дашборд метрик, сезонные сценарии, проактивные уведомления.</p>
        </div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:36px;">
        <h3 style="font-size:17px;margin-bottom:12px;">Фрагмент чеклиста (лид-магнит)</h3>
        <ul>
          <li>Где мой заказ / трек-номер?</li>
          <li>Как оформить возврат? В течение какого срока?</li>
          <li>Какой размер выбрать (рост/вес)?</li>
          <li>Сколько стоит доставка в мой город?</li>
          <li>Как отследить посылку СДЭК/Boxberry?</li>
        </ul>
        <p style="margin-top:12px;font-size:14px;">Полный список из 30 вопросов — при заявке «Проверить поддержку магазина».</p>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите разобраться в AI-поддержке до старта проекта?</p>
        <p class="ym-cta-block__sub">На этапе диагностики команда магазина понимает сценарии и метрики — это ускоряет пилот. Если нужен структурированный разбор внедрения AI в бизнес-процессы, смотрите материалы по обучению.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="<?php echo esc_url($secondary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </div>

  <section class="vna-section" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">FAQ</span>
        <h2>FAQ по AI-поддержке<br>интернет-магазина</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Подойдёт ли AI для малого интернет-магазина?</div>
          <div class="vna-faq-a"><p>Да, при 200+ обращениях в месяц и API к CRM. Старт с одного сценария «статус заказа» — 7–10 дней. Окупается при типовом ФОТ от 2 операторов.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Нужна ли CRM для запуска AI-агента?</div>
          <div class="vna-faq-a"><p>Желательна. Интеграция ai для интернет магазина с crm — основа для статусов и возвратов. Без CRM возможен режим «только FAQ», но deflection будет низким.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает внедрение?</div>
          <div class="vna-faq-a"><p>Пилот — 2–3 недели. Полный проект под ключ — 4–6 недель. При готовом API и базе FAQ — быстрее.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли начать с одного канала?</div>
          <div class="vna-faq-a"><p>Да. Рекомендация: начать с одной задачи — чаще всего статус доставки. Затем Telegram, WhatsApp, VK.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит AI для интернет-магазина?</div>
          <div class="vna-faq-a"><p>Ориентир 180–600 тыс. ₽ в зависимости от фаз и интеграций. Точная смета — после аудита тикетов.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли бот всех операторов?</div>
          <div class="vna-faq-a"><p>Нет. Целевой hybrid: 30–60% автоматизации типовых сценариев. CaseUp: с 4 до 2 операторов, не до нуля.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Работает ли AI с Wildberries и Ozon?</div>
          <div class="vna-faq-a"><p>Частично. Маркетплейсы — отдельный контур с ограничениями API. Бот закрывает D2C-сайт, мессенджеры бренда, email.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как избежать галлюцинаций?</div>
          <div class="vna-faq-a"><p>API-first: статус и суммы только из CRM/ТК. LLM — для формулировки. QA выборки, hallucination flags, handoff при низкой уверенности.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Что с 54-ФЗ и маркировкой при возврате?</div>
          <div class="vna-faq-a"><p>AI консультирует и создаёт тикет. Чек «Возврат прихода» и код маркировки — в CRM/кассе по правилам ФФД 1.2.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">YandexGPT или ChatGPT?</div>
          <div class="vna-faq-a"><p>Для русского e-commerce и 152-ФЗ — YandexGPT / GigaChat предсказуемее по договору и хранению ПДн в РФ. CaseUp использует YandexGPT 5 + RAG.</p></div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-sh">
        <h2>Готовы снять нагрузку с поддержки магазина?</h2>
        <p>Аудит тикетов, пилот «статус заказа» за 7–10 дней, честные границы автоматизации. Проекты 180–600 тыс. ₽ под ключ.</p>
      </div>
      <ul class="vna-cta-checklist">
        <li>50 последних тикетов — бесплатный разбор</li>
        <li>Чеклист 30 вопросов для автоматизации</li>
        <li>Интеграция CRM, СДЭК, мессенджеры</li>
        <li>API-first: статус только из учётных систем</li>
      </ul>
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить поддержку магазина</p>
          <p class="ym-cta-block__sub">Напишите в Telegram — разберём ваши сценарии и покажем, что можно автоматизировать в первую очередь.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

</div>

<?php
$aim_page_url = trailingslashit( get_permalink() );
$aim_site_url = trailingslashit( home_url( '/' ) );
$aim_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$aim_faq = [
    [ 'Подойдёт ли AI для малого интернет-магазина?', 'Да, при 200+ обращениях в месяц и API к CRM. Старт с одного сценария «статус заказа» — 7–10 дней. Окупается при типовом ФОТ от 2 операторов.' ],
    [ 'Нужна ли CRM для запуска AI-агента?', 'Желательна. Интеграция ai для интернет магазина с crm — основа для статусов и возвратов. Без CRM возможен режим «только FAQ», но deflection будет низким.' ],
    [ 'Сколько времени занимает внедрение?', 'Пилот — 2–3 недели. Полный проект под ключ — 4–6 недель. При готовом API и базе FAQ — быстрее.' ],
    [ 'Можно ли начать с одного канала?', 'Да. Рекомендация: начать с одной задачи — чаще всего статус доставки. Затем Telegram, WhatsApp, VK.' ],
    [ 'Сколько стоит AI для интернет-магазина?', 'Ориентир 180–600 тыс. ₽ в зависимости от фаз и интеграций. Точная смета — после аудита тикетов.' ],
    [ 'Заменит ли бот всех операторов?', 'Нет. Целевой hybrid: 30–60% автоматизации типовых сценариев. CaseUp: с 4 до 2 операторов, не до нуля.' ],
    [ 'Работает ли AI с Wildberries и Ozon?', 'Частично. Маркетплейсы — отдельный контур с ограничениями API. Бот закрывает D2C-сайт, мессенджеры бренда, email.' ],
    [ 'Как избежать галлюцинаций?', 'API-first: статус и суммы только из CRM/ТК. LLM — для формулировки. QA выборки, hallucination flags, handoff при низкой уверенности.' ],
    [ 'Что с 54-ФЗ и маркировкой при возврате?', 'AI консультирует и создаёт тикет. Чек «Возврат прихода» и код маркировки — в CRM/кассе по правилам ФФД 1.2.' ],
    [ 'YandexGPT или ChatGPT?', 'Для русского e-commerce и 152-ФЗ — YandexGPT / GigaChat предсказуемее по договору и хранению ПДн в РФ. CaseUp использует YandexGPT 5 + RAG.' ],
];
$aim_faq_entities = [];
foreach ( $aim_faq as $pair ) {
    $aim_faq_entities[] = [
        '@type' => 'Question',
        'name'  => $pair[0],
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $pair[1] ],
    ];
}
$aim_schema = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $aim_site_url . '#organization',
      'name'  => $aim_brand,
      'url'   => $aim_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $aim_site_url . '#website',
      'url'       => $aim_site_url,
      'name'      => $aim_brand,
      'publisher' => [ '@id' => $aim_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $aim_page_url . '#webpage',
      'url'         => $aim_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $aim_site_url . '#website' ],
      'about'       => [ '@id' => $aim_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $aim_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $aim_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $aim_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $aim_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $aim_page_url,
      'provider'    => [ '@id' => $aim_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $aim_page_url . '#faq',
      'mainEntity' => $aim_faq_entities,
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $aim_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
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
(function(){
  var items = document.querySelectorAll('.vna-faq-item');
  items.forEach(function(item){
    var q = item.querySelector('.vna-faq-q');
    if(!q) return;
    function toggle(){
      var open = item.classList.contains('open');
      items.forEach(function(i){ i.classList.remove('open'); i.querySelector('.vna-faq-q').setAttribute('aria-expanded','false'); });
      if(!open){ item.classList.add('open'); q.setAttribute('aria-expanded','true'); }
    }
    q.addEventListener('click', toggle);
    q.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); toggle(); }});
  });
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

<?php
/**
 * Template Name: AI-аналитика для бизнеса: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-аналитики под ключ. NLQ, CRM, 1С, BI, кейсы, цены. Аудит отчётности бесплатно.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-аналитика для бизнеса: внедрение под ключ — цена и сроки';
$page_seo_description = 'Внедрим AI-аналитику под ключ: вопросы к данным на естественном языке, автовыводы, прогнозы и управленческие отчёты вместо ручного Excel. Интеграция CRM, 1С, BI. Закажите аудит отчётности.';

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
    ['label' => 'Что это',       'href' => '#chto-takoe'],
    ['label' => 'Услуга',        'href' => '#vnedrenie'],
    ['label' => 'Как работает',  'href' => '#kak-rabotaet'],
    ['label' => 'Стоимость',     'href' => '#stoimost'],
    ['label' => 'Кейсы',         'href' => '#keisy'],
    ['label' => 'FAQ',           'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Получить AI-отчёт';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
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
.vnaa-content{
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
.vnaa-content *,.vnaa-content *::before,.vnaa-content *::after{box-sizing:border-box;}
.vnaa-content a{color:inherit;text-decoration:none;}
.vnaa-content p{color:var(--vna-muted);line-height:1.72;margin:0 0 1em;}
.vnaa-content p:last-child{margin-bottom:0;}
.vnaa-content h2,.vnaa-content h3,.vnaa-content h4{
  color:var(--vna-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.vnaa-content strong{color:var(--vna-soft);}
.vnaa-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vnaa-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--vna-muted);font-size:14.5px;line-height:1.65;
}
.vnaa-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--vna-accent);font-weight:700;
}

/* Container */
.vnaa-cnt{
  width:min(var(--vna-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.vnaa-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vnaa-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.vnaa-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vnaa-sh.vnaa-left{margin-left:0;text-align:left;}
.vnaa-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vnaa-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vnaa-sh.vnaa-left p{margin-left:0;}

/* Eyebrow */
.vnaa-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-accent);margin-bottom:14px;
}

/* Gradient text */
.vnaa-gt{
  background:linear-gradient(92deg,#fff 0%,var(--vna-accent) 44%,var(--vna-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.vnaa-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.vnaa-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.vnaa-intro-text{
  position:relative;padding-left:20px;
}
.vnaa-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--vna-accent),var(--vna-violet));
}
.vnaa-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--vna-muted);margin-bottom:1em;
}
.vnaa-intro-text p:last-child{margin-bottom:0;color:var(--vna-soft);}
.vnaa-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.vnaa-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.vnaa-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--vna-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.vnaa-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vna-muted);line-height:1.4;}
.vnaa-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .vnaa-intro-grid{grid-template-columns:1fr;gap:36px;}
  .vnaa-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .vnaa-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.vnaa-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vnaa-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.vnaa-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--vna-surface);border:1px solid var(--vna-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--vna-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.vnaa-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--vna-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.vnaa-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--vna-border);border-radius:var(--vna-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.vnaa-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.vnaa-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vnaa-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .vnaa-grid-2{grid-template-columns:1fr;}
  .vnaa-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .vnaa-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .vnaa-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.vnaa-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vna-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.vnaa-level-card:hover{transform:translateY(-2px);}
.vnaa-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--vna-r) var(--vna-r) 0 0;
}
.vnaa-level-card.l1::before{background:var(--vna-green);}
.vnaa-level-card.l2::before{background:var(--vna-accent);}
.vnaa-level-card.l3::before{background:var(--vna-violet);}
.vnaa-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.vnaa-level-card.l1 .vnaa-level-badge{background:rgba(34,197,94,.15);color:var(--vna-green);}
.vnaa-level-card.l2 .vnaa-level-badge{background:rgba(121,242,255,.15);color:var(--vna-accent);}
.vnaa-level-card.l3 .vnaa-level-badge{background:rgba(139,92,246,.15);color:var(--vna-violet);}
.vnaa-level-card h3{font-size:17px;margin-bottom:10px;}
.vnaa-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.vnaa-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vna-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.vnaa-scenario:last-child{margin-bottom:0;}
.vnaa-scenario:hover{border-color:rgba(121,242,255,.3);}
.vnaa-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.vnaa-scenario h3{font-size:17px;margin-bottom:8px;}
.vnaa-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.vnaa-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vnaa-table{width:100%;border-collapse:collapse;font-size:14px;}
.vnaa-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--vna-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.vnaa-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--vna-text);vertical-align:top;
}
.vnaa-table tr:last-child td{border-bottom:none;}
.vnaa-table tr:hover td{background:rgba(255,255,255,.03);}
.vnaa-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.vnaa-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.vnaa-stack-layer:last-child{border-bottom:none;}
.vnaa-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--vna-accent);padding-top:2px;
}
.vnaa-stack-val{font-size:14.5px;color:var(--vna-text);}
.vnaa-stack-desc{font-size:13px;color:var(--vna-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.vnaa-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vnaa-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vnaa-case-grid{grid-template-columns:1fr;}}
.vnaa-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.vnaa-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.vnaa-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-green);margin-bottom:10px;
}
.vnaa-case-card h3{font-size:16px;margin-bottom:14px;}
.vnaa-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.vnaa-metric{display:flex;align-items:baseline;gap:8px;}
.vnaa-metric .num{font-size:22px;font-weight:900;color:var(--vna-accent);flex-shrink:0;letter-spacing:-.04em;}
.vnaa-metric .lbl{font-size:13px;color:var(--vna-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.vnaa-timeline{position:relative;padding-left:40px;}
.vnaa-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--vna-accent),var(--vna-violet));
  opacity:.35;border-radius:2px;
}
.vnaa-tl-item{position:relative;margin-bottom:32px;}
.vnaa-tl-item:last-child{margin-bottom:0;}
.vnaa-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--vna-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.vnaa-tl-item h3{font-size:17px;margin-bottom:8px;}
.vnaa-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.vnaa-pricing-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:960px){.vnaa-pricing-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vnaa-pricing-grid{grid-template-columns:1fr;}}
.vnaa-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.vnaa-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.vnaa-price-card.vnaa-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.vnaa-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-accent);margin-bottom:10px;
}
.vnaa-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.vnaa-price-card .inc{font-size:13px;color:var(--vna-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.vnaa-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vnaa-compare{width:100%;border-collapse:collapse;}
.vnaa-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--vna-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.vnaa-compare td{
  padding:13px 16px;font-size:14px;color:var(--vna-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.vnaa-compare tr:last-child td{border-bottom:none;}
.vnaa-good{color:var(--vna-green);}
.vnaa-neutral{color:var(--vna-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.vnaa-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vnaa-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.vnaa-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--vna-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.vnaa-faq-q::after{
  content:'▾';font-size:13px;color:var(--vna-accent);
  flex-shrink:0;transition:transform .25s;
}
.vnaa-faq-item.open .vnaa-faq-q::after{transform:rotate(180deg);}
.vnaa-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--vna-muted);line-height:1.72;
}
.vnaa-faq-item.open .vnaa-faq-a{max-height:600px;padding:0 24px 20px;}

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
.vnaa-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.vnaa-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--vna-muted);
}
.vnaa-cta-checklist li::before{content:'✓';color:var(--vna-green);font-weight:800;}

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
.ym-cta-block--primary{background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border-color:rgba(121,242,255,.3);}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-link--accent{color:var(--vnaa-accent)!important;text-decoration:underline!important;}
.ym-ad-banner-wrap{margin:32px auto 48px;text-align:center;}
.vnaa-questions{display:grid;gap:12px;margin:28px 0;}
.vnaa-q-item{display:flex;gap:14px;align-items:flex-start;padding:16px 18px;border-radius:14px;background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);}
.vnaa-q-num{flex-shrink:0;width:28px;height:28px;border-radius:50%;background:rgba(121,242,255,.15);color:var(--vnaa-accent);font-weight:800;font-size:13px;display:flex;align-items:center;justify-content:center;}
.vnaa-q-item p{margin:0;font-size:14.5px;}
.vnaa-q-item em{color:var(--vnaa-soft);font-style:normal;font-weight:700;}
.vnaa-def-box{padding:18px 20px;border-left:3px solid var(--vnaa-accent);background:rgba(121,242,255,.06);border-radius:0 12px 12px 0;margin-bottom:24px;}
.vnaa-def-box strong{color:var(--vnaa-heading);}
.vnaa-summary-box{padding:16px 20px;border-radius:14px;background:rgba(139,92,246,.1);border:1px solid rgba(139,92,246,.25);margin-bottom:24px;}


</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-analitika-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnaa-hero-analitika" id="hero" aria-labelledby="vnaa-hero-title">
<style>
/* ── Hero vnedrenie-ai-analitika: самодостаточные стили ── */
.vnaa-hero-analitika {
  --vnaa-cyan: #79f2ff;
  --vnaa-violet: #8b5cf6;
  --vnaa-green: #22c55e;
  --vnaa-amber: #fbbf24;
  --vnaa-text: #e6edf7;
  --vnaa-muted: #9aa8bd;
  --vnaa-soft: #c7d2e5;
  --vnaa-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnaa-hero-analitika::before {
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
.vnaa-hero-analitika::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 680px;
  height: 680px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .11), transparent 66%);
  filter: blur(8px);
  animation: vnaaHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnaaHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.vnaa-hero-analitika .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnaa-hero-analitika .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnaa-hero-analitika .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.vnaa-hero-analitika .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnaa-cyan) 44%, var(--vnaa-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnaa-hero-analitika .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnaa-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.vnaa-hero-analitika .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--vnaa-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnaa-hero-analitika .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnaa-hero-analitika .nero-ai-badge {
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
.vnaa-hero-analitika .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnaa-hero-analitika .nero-ai-btn {
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
.vnaa-hero-analitika .nero-ai-btn:hover { transform: translateY(-2px); }
.vnaa-hero-analitika .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--vnaa-cyan), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnaa-hero-analitika .nero-ai-btn-secondary {
  color: var(--vnaa-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnaa-hero-analitika .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnaa-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.vnaa-hero-analitika .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnaa-hero-analitika .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnaa-hero-analitika .nero-ai-dots { display: flex; gap: 7px; }
.vnaa-hero-analitika .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnaa-hero-analitika .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnaa-hero-analitika .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnaa-hero-analitika .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnaa-hero-analitika .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnaa-hero-analitika .nero-ai-window-body { padding: 16px; }
.vnaa-hero-analitika .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vnaa-hero-analitika .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnaa-hero-analitika .nero-ai-live-pill {
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
.vnaa-hero-analitika .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnaaPulse 1.6s infinite;
}
@keyframes vnaaPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnaa-hero-analitika .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnaa-hero-analitika .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnaa-hero-analitika .nero-ai-metric span {
  display: block;
  color: var(--vnaa-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnaa-hero-analitika .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnaa-hero-analitika .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnaa-hero-analitika .vnaa-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 50% 55%, rgba(121,242,255,.08), rgba(6,10,24,.94) 72%);
}
.vnaa-hero-analitika #vnaa-insight-observatory-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnaa-hero-analitika .nero-ai-task-stream { display: grid; gap: 8px; }
.vnaa-hero-analitika .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnaa-hero-analitika .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vnaa-cyan);
  font-size: 11px;
  font-weight: 800;
}
.vnaa-hero-analitika .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnaa-hero-analitika .nero-ai-task span {
  color: var(--vnaa-muted);
  font-size: 11px;
}
.vnaa-hero-analitika .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnaa-hero-analitika .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.vnaa-hero-analitika .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .vnaa-hero-analitika .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnaa-hero-analitika .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vnaa-hero-analitika .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnaa-hero-analitika .nero-ai-window-body { padding: 12px; }
  .vnaa-hero-analitika .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnaa-hero-analitika .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai аналитика</p>
      <h1 id="vnaa-hero-title">AI-аналитика для бизнеса: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Задавайте вопросы к данным на естественном языке — получайте выводы, прогнозы и управленческие отчёты без ручной аналитики</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">NLQ-чат</li>
        <li class="nero-ai-badge">CRM+1С</li>
        <li class="nero-ai-badge">Дашборды</li>
        <li class="nero-ai-badge">Прогнозы</li>
        <li class="nero-ai-badge">Telegram</li>
        <li class="nero-ai-badge">Trust-layer</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-аналитики: chat with data">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-аналитика · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Запросов NLQ</span>
              <strong>47</strong>
              <small>сегодня</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ответ</span>
              <strong>12 сек</strong>
              <small>вопрос → вывод</small>
            </div>
            <div class="nero-ai-metric">
              <span>Источники</span>
              <strong>6</strong>
              <small>CRM · 1С · BI</small>
            </div>
            <div class="nero-ai-metric">
              <span>Экономия</span>
              <strong>−32%</strong>
              <small>времени на отчёты</small>
            </div>
          </div>

          <div class="vnaa-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnaa-insight-observatory-canvas" role="img" aria-label="Анимация: радиальные потоки данных сходятся к NLQ-консоли, SQL верифицируется и инсайт уходит в Telegram-дайджест"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий AI-аналитики">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">Q</span>
              <div><strong>QUERY: «Почему упала маржа?»</strong><span>NLQ → semantic layer</span></div>
              <span class="nero-ai-status nero-ai-status--violet">запрос</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">SQL</span>
              <div><strong>SELECT margin BY channel</strong><span>1 247 строк · read-only</span></div>
              <span class="nero-ai-status">верифицировано</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↗</span>
              <div><strong>Вывод: канал Директ −18%</strong><span>прогноз: восстановление за 2 нед.</span></div>
              <span class="nero-ai-status">инсайт</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Telegram-дайджест CEO</strong><span>3 цифры + вывод + риск · 09:00</span></div>
              <span class="nero-ai-status nero-ai-status--amber">отправлено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * vnaa-insight-observatory-engine — Диспетчерская NLQ-аналитики
 * Мир: радиальные потоки данных → InsightQueryConsole → trust-layer → Telegram
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnaa-insight-observatory-canvas");
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
    hubBase: "#1e293b",
    hubAccent: "#79f2ff",
    hubViolet: "#8b5cf6",
    streamGlow: "rgba(121,242,255,0.28)",
    streamDim: "rgba(139,92,246,0.18)",
    packetCrm: "#a7f3d0",
    packet1c: "#fde68a",
    packetBi: "#93c5fd",
    packetAds: "#fbcfe8",
    sqlGreen: "#22c55e",
    anomaly: "#f97316",
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

  /* Радиальные каналы данных — замена Conveyor */
  function RadialDataStreams() {
    this.spokes = [
      { angle: -2.4, color: C.packetCrm, label: "CRM" },
      { angle: -0.9, color: C.packet1c, label: "1С" },
      { angle: 0.6, color: C.packetBi, label: "BI" },
      { angle: 2.1, color: C.packetAds, label: "Ads" }
    ];
  }
  RadialDataStreams.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.spokes.forEach(function (spoke, idx) {
      var len = 115;
      var ex = Math.cos(spoke.angle) * len;
      var ey = Math.sin(spoke.angle) * len * 0.55 - 15;
      ctx.strokeStyle = idx % 2 ? C.streamDim : C.streamGlow;
      ctx.lineWidth = 2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.moveTo(ex, ey);
      ctx.lineTo(0, 5);
      ctx.stroke();
      ctx.setLineDash([]);

      var t = ((frame * 0.022 + idx * 0.65) % 1);
      var px = ex * (1 - t);
      var py = ey * (1 - t) + 5 * t;
      drawRR(ctx, px - 7, py - 5, 14, 10, 3, spoke.color, C.outline);

      if (t < 0.08) {
        ctx.fillStyle = "rgba(255,255,255,0.5)";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(spoke.label, ex * 0.92, ey * 0.92 - 8);
      }
    });

    /* Пульсация ядра при INGEST */
    if (prg < 70) {
      var pulse = 0.5 + Math.sin(frame * 0.12) * 0.25;
      ctx.strokeStyle = "rgba(121,242,255," + pulse * 0.35 + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, 5, 28 + pulse * 6, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* NLQ-консоль — замена WebsiteTerminal */
  function InsightQueryConsole() {
    this.queryText = "";
    this.sqlRows = 0;
  }
  InsightQueryConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -62, -72, 124, 148, 10, C.hubBase, C.outline);

    var wx = -52, wy = -62, ww = 104, wh = 128;
    drawRR(ctx, wx, wy, ww, wh, 6, "#0b1224", C.hubAccent);

    /* Фаза QUESTION */
    if (prg >= 55 && prg < 115) {
      var qPrg = (prg - 55) / 60;
      drawRR(ctx, wx + 6, wy + 10, ww - 12, 22, 5, "rgba(121,242,255,0.15)", C.hubAccent);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "left";
      var q = "Почему упала маржа?";
      ctx.fillText(q.substring(0, Math.floor(q.length * Math.min(1, qPrg * 1.4))), wx + 10, wy + 23);
    }

    /* Фаза VERIFY — мини-график */
    if (prg >= 115 && prg < 175) {
      drawRR(ctx, wx + 6, wy + 10, ww - 12, 18, 4, "rgba(139,92,246,0.2)", C.hubViolet);
      ctx.fillStyle = "#ddd6fe";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("NLQ → SQL", wx + 10, wy + 21);

      ctx.strokeStyle = C.hubAccent;
      ctx.lineWidth = 2;
      ctx.beginPath();
      var chartW = ww - 20;
      for (var i = 0; i <= chartW; i += 4) {
        var t = i / chartW;
        var v = wy + 95 - Math.sin(t * 4 + frame * 0.04) * 12 - t * 18;
        if (i === 0) ctx.moveTo(wx + 10 + i, v);
        else ctx.lineTo(wx + 10 + i, v);
      }
      ctx.stroke();

      /* Аномалия */
      var ax = wx + 10 + chartW * 0.62;
      ctx.fillStyle = C.anomaly;
      ctx.beginPath();
      ctx.arc(ax, wy + 72, 4 + Math.sin(frame * 0.2) * 1.5, 0, Math.PI * 2);
      ctx.fill();
    }

    /* Фаза DELIVER — карточка инсайта */
    if (prg >= 175) {
      var dPrg = Math.min(1, (prg - 175) / 30);
      var cardY = wy + 38 - dPrg * 8;
      drawRR(ctx, wx + 6, cardY, ww - 12, 52, 6, "rgba(34,197,94,0.18)", C.sqlGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Маржа −12%: Директ", wx + 12, cardY + 16);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("прогноз: +6% за 14 дн.", wx + 12, cardY + 28);
      ctx.fillStyle = C.hubAccent;
      ctx.fillText("✓ human review", wx + 12, cardY + 40);
    }

    /* Заголовок окна */
    drawRR(ctx, wx, wy, ww, 14, [6, 6, 0, 0], "rgba(255,255,255,0.06)", null);
    ctx.fillStyle = C.hubAccent;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("NLQ · chat with data", wx + ww / 2, wy + 9);
  };

  /* Кольцо semantic layer */
  function SemanticLayerRing() {
    this.rot = 0;
  }
  SemanticLayerRing.prototype.draw = function (ctx) {
    this.rot = (frame * 0.008) % (Math.PI * 2);
    var labels = ["маржа", "ROMI", "LTV", "CAC"];
    labels.forEach(function (lbl, i) {
      var a = this.rot + (i / labels.length) * Math.PI * 2;
      var rx = Math.cos(a) * 95;
      var ry = Math.sin(a) * 48 - 20;
      drawRR(ctx, rx - 18, ry - 7, 36, 14, 5, "rgba(255,255,255,0.07)", C.outline);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(lbl, rx, ry + 3);
    }, this);
  };

  /* Панель SQL trust-layer */
  function SqlTrustPanel() {
    this.alpha = 0;
  }
  SqlTrustPanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 110 || prg > 200) return;
    this.alpha = prg < 125 ? (prg - 110) / 15 : prg > 185 ? 1 - (prg - 185) / 15 : 1;
    ctx.globalAlpha = this.alpha;
    drawRR(ctx, 72, -58, 58, 42, 6, "rgba(15,23,42,0.92)", C.sqlGreen);
    ctx.fillStyle = C.sqlGreen;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("SQL trust", 78, -48);
    ctx.fillStyle = "#86efac";
    ctx.font = "5px monospace";
    ctx.fillText("SELECT channel,", 78, -38);
    ctx.fillText("  margin_pct", 78, -32);
    ctx.fillText("FROM marts.sales", 78, -26);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillText("1 247 rows", 78, -14);
    ctx.globalAlpha = 1;
  };

  /* Маяк аномалии */
  function AnomalyBeacon() {
    this.flash = 0;
  }
  AnomalyBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 120 || prg > 170) return;
    this.flash = Math.sin(frame * 0.25) * 0.4 + 0.6;
    ctx.strokeStyle = "rgba(249,115,22," + this.flash * 0.7 + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(-95, 35);
    ctx.lineTo(-75, -5);
    ctx.stroke();
    ctx.fillStyle = C.anomaly;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("!", -82, 8);
  };

  /* Дуга прогноза */
  function ForecastArc() {
    this.progress = 0;
  }
  ForecastArc.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 165) return;
    this.progress = Math.min(1, (prg - 165) / 40);
    ctx.strokeStyle = "rgba(34,197,94,0.55)";
    ctx.lineWidth = 2.5;
    ctx.setLineDash([3, 4]);
    ctx.beginPath();
    ctx.arc(25, 45, 42, Math.PI * 1.1, Math.PI * 1.1 + Math.PI * 0.55 * this.progress);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle = "#86efac";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("forecast +6%", 58, 38);
  };

  /* Telegram-дайджест — финальный всплеск */
  function TelegramDigestBurst() {
    this.y = 0;
    this.alpha = 0;
  }
  TelegramDigestBurst.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 200) {
      this.y = 0;
      this.alpha = 0;
      return;
    }
    var local = prg - 200;
    this.y = -local * 2.2;
    this.alpha = local < 15 ? local / 15 : Math.max(0, 1 - (local - 15) / 45);
    ctx.save();
    ctx.globalAlpha = this.alpha;
    drawRR(ctx, -22, -90 + this.y, 44, 28, 8, "rgba(59,130,246,0.35)", C.hubAccent);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("TG дайджест", 0, -78 + this.y);
    ctx.fillStyle = "#bae6fd";
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("CEO · 09:00", 0, -68 + this.y);
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
    var prg = (frame * 0.038) % 260;
    var isMoving = false;
    var carryType = null;

    /* Станции вокруг обсерватории — радиальная геометрия */
    var stations = {
      "1_architect": { x: -110, y: 70 },
      "2_seo": { x: -55, y: 88 },
      "3_coder": { x: 55, y: 88 },
      "4_designer": { x: 110, y: 70 },
      "5_deployer": { x: 0, y: 98 }
    };
    var tgt = stations[this.role] || { x: 0, y: 85 };

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
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 10 ? this.color : null;
    }

    if (!isMoving && frame % 230 === 0 && Math.random() < 0.11) {
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
  var streams = new RadialDataStreams();
  var consoleHub = new InsightQueryConsole();
  var semantic = new SemanticLayerRing();
  var sqlPanel = new SqlTrustPanel();
  var anomaly = new AnomalyBeacon();
  var forecast = new ForecastArc();
  var telegram = new TelegramDigestBurst();

  entities.push(semantic);
  entities.push(streams);
  entities.push(anomaly);
  entities.push(consoleHub);
  entities.push(sqlPanel);
  entities.push(forecast);
  entities.push(telegram);
  entities.push(new Agent(-130, 100, C.agentYellow, "1_architect", 20, [
    "Витрина marts готова", "Semantic layer: маржа", "CRM + 1С связаны"
  ]));
  entities.push(new Agent(-65, 108, C.agentGreen, "2_seo", 68, [
    "Почему упала маржа?", "ROMI по каналам", "Chat with data"
  ]));
  entities.push(new Agent(0, 110, C.agentBlue, "3_coder", 118, [
    "SQL read-only", "1 247 строк", "temperature=0"
  ]));
  entities.push(new Agent(65, 108, C.agentPink, "4_designer", 162, [
    "Дашборд DataLens", "Прогноз +6%", "Аномалия подсвечена"
  ]));
  entities.push(new Agent(130, 100, C.agentPurple, "5_deployer", 208, [
    "Дайджест в Telegram", "3 цифры + риск", "CEO получил в 09:00"
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
    if (prg >= 18 && prg < 18.05) createBubble(-80, -30, "1. Потоки CRM/1С/BI");
    if (prg >= 72 && prg < 72.05) createBubble(-40, 10, "2. NLQ-вопрос");
    if (prg >= 128 && prg < 128.05) createBubble(30, -20, "3. SQL + 1 247 строк");
    if (prg >= 182 && prg < 182.05) createBubble(0, 20, "4. Инсайт + прогноз");
    if (prg >= 218 && prg < 218.05) createBubble(90, -40, "5. Дайджест в Telegram");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.hubAccent);
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

<div class="vnaa-content">

  <section class="vnaa-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vnaa-cnt">
      <div class="vnaa-intro-grid nero-ai-reveal">
        <div class="vnaa-intro-text">
          <p class="vnaa-eyebrow">Лонгрид · ai аналитика</p>
          <p><strong>Коротко:</strong> AI-аналитика — слой поверх BI и хранилища данных, который позволяет задавать вопросы к корпоративным данным на естественном языке и получать выводы, прогнозы и управленческие отчёты без ручной подготовки Excel и дашбордов. Nero Network внедряет AI-аналитику под ключ: от аудита отчётности до Telegram-дайджестов для руководителя.</p>
          <p>Данные в компании уже есть — в CRM, 1С, рекламных кабинетах, таблицах. Но отчёты по-прежнему собираются вручную, аналитик уходит в отпуск — и решения откладываются. По данным DataBase Intelligence, около <strong>половины</strong> российских компаний в 2025 году уже внедряют генеративный ИИ в системы бизнес-аналитики.</p>
          <p>Если вы ищете <strong>внедрение AI-аналитики</strong> с понятным чеком, сроками и результатом — начните с <strong>бесплатного аудита отчётности</strong> или закажите <strong>AI-отчёт</strong> по вашим данным.</p>
        </div>
        <div class="vnaa-intro-kpi" aria-label="Ключевые показатели рынка AI-аналитики">
          <div class="vnaa-kpi-card"><div class="kv">58 млрд ₽</div><div class="kl">рынок GenAI в РФ, 2025</div><div class="ks">рост ×4,5–5</div></div>
          <div class="vnaa-kpi-card"><div class="kv">~50%</div><div class="kl">компаний внедряют GenAI в BI</div><div class="ks">DataBase Intelligence</div></div>
          <div class="vnaa-kpi-card"><div class="kv">78%</div><div class="kl">объёма GenAI — B2B</div><div class="ks">рынок РФ, 2025</div></div>
          <div class="vnaa-kpi-card"><div class="kv">30%</div><div class="kl">ускорение отчётов в DataLens</div><div class="ks">Яндекс Нейроаналитик</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vnaa-toc-outer">
    <div class="vnaa-cnt">
      <nav class="vnaa-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что это</a>
        <a href="#vnedrenie">Услуга</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#integracii">Интеграции</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="vnaa-section" id="chto-takoe">
    <div class="vnaa-cnt">
      <div class="vnaa-sh nero-ai-reveal">
        <h2>Что такое AI-аналитика и какие задачи решает для бизнеса</h2>
      </div>
      <div class="vnaa-def-box nero-ai-reveal"><p><strong>Определение:</strong> AI-аналитика для бизнеса — интеллектуальный слой поверх BI-платформы или хранилища данных. Он соединяет LLM с корпоративными витринами и позволяет получать ответы на вопросы к данным на русском языке — без SQL и без ожидания аналитика.</p></div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Чем AI-аналитика отличается от классического BI и Excel-отчётов</h3>
<div class="vnaa-table-wrap"><table class="vnaa-table"><thead><tr><th>Подход</th><th>Как задаётся вопрос</th><th>Кто готовит отчёт</th><th>Скорость</th></tr></thead><tbody><tr><td>Excel</td><td>Формулы, сводные таблицы</td><td>Аналитик или бухгалтер</td><td>Часы–дни</td></tr><tr><td>Классический BI</td><td>Фильтры, дашборды</td><td>Аналитик настраивает, пользователь смотрит</td><td>Минуты–часы</td></tr><tr><td>AI-аналитика</td><td>Естественный язык («Почему упала маржа в марте?»)</td><td>LLM + semantic layer, ревью человека</td><td>Секунды–минуты</td></tr></tbody></table></div>
<p>Классический BI (Power BI, Yandex DataLens, Metabase) отвечает на вопрос «покажи метрику X за период Y» — но только если вы знаете, где искать, как фильтровать и как интерпретировать график. Excel добавляет гибкость, но превращается в хрупкую сеть формул, которую поддерживает один сотрудник.</p>
<p>AI-аналитика закрывает разрыв между данными и решениями:</p>
<p>Яндекс в документации к Нейроаналитику DataLens прямо указывает: ИИ-агент <strong>не заменяет</strong> эксперта — верификация остаётся за человеком. Nero Network строит внедрение по принципу <strong>гибридного интеллекта</strong>: AI готовит вывод, аналитик или руководитель утверждает критичные решения.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Вопросы к данным на естественном языке вместо ручной аналитики</h3>
<ul><li>«Какой канал дал лучший ROMI в Q1?»</li><li>«Сколько сделок зависло на этапе «Счёт выставлен» больше 14 дней?»</li><li>«Сравни дебиторку по топ-5 клиентам с прошлым кварталом»</li></ul>
<p>Технология NLQ (Natural Language Query) — ядро современной AI-аналитики. Пользователь пишет в чате, в Telegram или в интерфейсе BI:</p>
<p>Система переводит вопрос в SQL-запрос к витрине данных, выполняет его и формулирует ответ на русском. В Metabase Metabot каждый ответ привязан к SQL — «no black boxes». В Nero Network мы делаем то же самое: <strong>показываем запрос и число строк</strong> рядом с выводом AI.</p>
<p>Исследование Microsoft по M365 Copilot (arXiv 2605.23958, 5,5 млн сессий) фиксирует сдвиг: сотрудники всё чаще используют AI не для поиска, а для <strong>анализа, принятия решений и стратегии</strong>. Для малого и среднего бизнеса без enterprise-бюджета на Copilot тот же интент закрывается стеком DataLens или Metabase + GigaChat/YandexGPT.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Автоматические выводы, прогнозы и управленческие дашборды</h3>
<ul><li><strong>Генерирует управленческие отчёты</strong> — еженедельные дайджесты с ключевыми метриками и комментариями;</li><li><strong>Выявляет аномалии</strong> — «отклонение +12% к прошлой неделе из-за канала X»;</li><li><strong>Строит прогнозы</strong> — скользящее среднее, сезонность; ML-модели подключаются на этапе масштабирования;</li><li><strong>Объясняет тренды</strong> — связывает цифры с бизнес-контекстом.</li></ul>
<p><strong>5 вопросов, которые можно задать AI-аналитике уже на пилоте:</strong></p>
<ol style="padding-left:20px;color:var(--vnaa-muted);"><li><em>Маркетинг:</em> «Какой рекламный канал дал наименьший CAC при сохранении конверсии?»</li><li><em>Финансы:</em> «Где отклонение факта от бюджета превысило 15%?»</li><li><em>Продажи:</em> «Какие менеджеры не выполнили план по новым сделкам в этом месяце?»</li><li><em>Склад/операции:</em> «Какие SKU заморозили оборотные средства дольше 60 дней?»</li><li><em>HR/операции:</em> «Сколько рутинных запросов сотрудников можно автоматизировать по тематикам?»</li></ol>
<p>AI-аналитика не ограничивается ответами на вопросы. Она:</p>
<p>По данным Яндекса, Нейроаналитик в DataLens ускоряет создание отчётов и проверку гипотез <strong>в среднем на 30%</strong>. ОТП Банк с Yandex SpeechSense проанализировал 29 000+ диалогов за 7 дней пилота — <strong>в 30 раз быстрее</strong>, чем вручную тремя сотрудниками.</p>
</div>
    </div>
  </section>

  <section class="vnaa-section vnaa-section-alt" id="vnedrenie">
    <div class="vnaa-cnt">
      <div class="vnaa-sh nero-ai-reveal">
        <h2>Внедрение AI-аналитики под ключ: что входит в услугу</h2>
      </div>
      <div class="vnaa-def-box nero-ai-reveal"><p><strong>AI-аналитика под ключ</strong> — проектная модель: аудит, архитектура, разработка, интеграции и обучение. Вы получаете систему «вопросы к данным → выводы → отчёты», а не лицензию «попробуйте сами».</p></div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Аудит данных и текущей отчётности (лид-магнит)</h3>
<ul><li>какие источники данных есть: 1С, amoCRM, Битрикс24, Google Sheets, рекламные кабинеты, PostgreSQL;</li><li>кто готовит какие отчёты, сколько часов в неделю уходит на рутину;</li><li>какие решения принимаются на основе этих отчётов — и где возникает задержка.</li></ul>
<p>Первый шаг — <strong>бесплатный аудит отчётности</strong> (3–5 рабочих дней). Мы фиксируем:</p>
<p>Результат аудита — карта «данные → отчёты → решения» и рекомендация по 1–2 пилотным метрикам (маржа по каналам, воронка продаж, дебиторка). Это лид-магнит Nero Network: вы получаете конкретную картину, мы — основу для коммерческого предложения.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Проектирование архитектуры и выбор AI/BI-стека</h3>
<div class="vnaa-table-wrap"><table class="vnaa-table"><thead><tr><th>Стек</th><th>AI-слой</th><th>Плюсы для РФ</th><th>Ограничения</th></tr></thead><tbody><tr><td><strong>Yandex DataLens + Нейроаналитик</strong></td><td>Встроенный ИИ-агент</td><td>Облако РФ, 152-ФЗ, русский язык</td><td>Привязка к Yandex Cloud</td></tr><tr><td><strong>Metabase + Metabot</strong></td><td>NLQ, SQL, MCP</td><td>Open-source, self-hosted, BYOK</td><td>Нужна настройка semantic layer</td></tr><tr><td><strong>Power BI + Copilot</strong></td><td>NLQ, DAX-помощник</td><td>Зрелый продукт Microsoft</td><td>Лицензии, данные в Azure, английский; в РФ — барьеры</td></tr><tr><td><strong>ClickHouse/PostgreSQL + MCP-агент</strong></td><td>GigaChat/YandexGPT + RAG</td><td>Полный контроль, on-prem</td><td>Требует разработки витрин</td></tr></tbody></table></div>
<p>На основе аудита проектируем архитектуру. Типовые стеки 2025–2026 для российского бизнеса:</p>
<p>Для большинства SMB-клиентов Nero Network рекомендует <strong>Metabase или DataLens + российский LLM</strong> — без санкционных рисков Power BI Copilot и с прозрачным trust-layer.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Разработка, настройка и интеграция с вашими системами</h3>
<ul><li>ETL-пайплайны (n8n, Make, Airflow — по масштабу);</li><li>витрины данных в PostgreSQL или ClickHouse;</li><li>semantic layer с утверждёнными определениями метрик;</li><li>NLQ-слой: GigaChat API, YandexGPT или Metabot;</li><li>интерфейсы: веб-чат, Telegram-бот, email-дайджест.</li></ul>
<p>Этап включает:</p>
<p>Интеграции: <strong>amoCRM, Битрикс24, 1С, Google Sheets, Яндекс Директ, VK Ads, Telegram</strong>. По оценкам рынка, <strong>30–50%</strong> бюджета AI-проекта уходит на подготовку данных — мы закладываем это в план с первого дня.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Обучение команды и сопровождение после запуска</h3>
<p>После запуска проводим обучение: как формулировать вопросы, как читать SQL рядом с ответом, когда эскалировать на аналитика. Сопровождение включает мониторинг качества ответов, доработку витрин, настройку лимитов токенов и аудит логов запросов.</p>
</div>
    </div>
  </section>

<section id="vnedrenie-ai-analitika-boris-block" class="bvia-root" aria-label="Архитектура потока данных AI-аналитики: от источников к управленческому выводу">
<style>
/* === БОРИС: prefix bvia-, scoped внутри #vnedrenie-ai-analitika-boris-block === */
#vnedrenie-ai-analitika-boris-block.bvia-root{padding:56px 0 68px;background:#f8fafc;}
#vnedrenie-ai-analitika-boris-block .bvia-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
#vnedrenie-ai-analitika-boris-block .bvia-card{
  display:grid;
  grid-template-columns:44% 56%;
  border-radius:22px;
  overflow:hidden;
  box-shadow:0 10px 40px rgba(15,23,42,.10),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
  background:#fff;
}
@media(max-width:960px){
  #vnedrenie-ai-analitika-boris-block .bvia-card{grid-template-columns:1fr;min-height:auto;}
}
#vnedrenie-ai-analitika-boris-block .bvia-lft{
  padding:44px 38px;
  display:flex;
  flex-direction:column;
  justify-content:center;
}
@media(max-width:600px){#vnedrenie-ai-analitika-boris-block .bvia-lft{padding:30px 22px;}}
#vnedrenie-ai-analitika-boris-block .bvia-ey{
  display:inline-flex;align-items:center;gap:7px;
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:#0d9488;margin:0 0 14px;
}
#vnedrenie-ai-analitika-boris-block .bvia-ey::before{
  content:'';display:inline-block;width:18px;height:2px;background:#0d9488;border-radius:1px;
}
#vnedrenie-ai-analitika-boris-block .bvia-h3{
  font-size:24px;font-weight:800;color:#0f172a;line-height:1.32;margin:0 0 18px;
}
@media(max-width:600px){#vnedrenie-ai-analitika-boris-block .bvia-h3{font-size:20px;}}
#vnedrenie-ai-analitika-boris-block .bvia-ul{
  list-style:none;margin:0 0 22px;padding:0;
  display:flex;flex-direction:column;gap:9px;
}
#vnedrenie-ai-analitika-boris-block .bvia-ul li{
  display:flex;align-items:flex-start;gap:10px;
  font-size:14.5px;line-height:1.5;color:#334155;
}
#vnedrenie-ai-analitika-boris-block .bvia-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(13,148,136,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#0d9488;margin-top:1px;font-style:normal;
}
#vnedrenie-ai-analitika-boris-block .bvia-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;}
#vnedrenie-ai-analitika-boris-block .bvia-pl{
  padding:5px 11px;border-radius:99px;font-size:11.5px;font-weight:700;white-space:nowrap;
}
#vnedrenie-ai-analitika-boris-block .bvia-pl-t{background:rgba(13,148,136,.08);color:#0f766e;border:1.5px solid rgba(13,148,136,.22);}
#vnedrenie-ai-analitika-boris-block .bvia-pl-b{background:rgba(59,130,246,.08);color:#1d4ed8;border:1.5px solid rgba(59,130,246,.2);}
#vnedrenie-ai-analitika-boris-block .bvia-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.2);}
#vnedrenie-ai-analitika-boris-block .bvia-foot{
  font-size:13px;color:#64748b;font-style:italic;margin:0;
}
#vnedrenie-ai-analitika-boris-block .bvia-rgt{
  background:linear-gradient(145deg,#060a14 0%,#0c1222 50%,#080d18 100%);
  position:relative;overflow:hidden;min-height:420px;
}
@media(max-width:960px){#vnedrenie-ai-analitika-boris-block .bvia-rgt{min-height:360px;}}
#vnedrenie-ai-analitika-boris-block #bvia-pipeline-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>

<div class="bvia-cnt">
<div class="bvia-card">

  <div class="bvia-lft">
    <span class="bvia-ey">Архитектура под капотом</span>
    <h3 class="bvia-h3">Не магия чата — связанный поток: источники → витрина → AI → вывод с SQL</h3>
    <ul class="bvia-ul">
      <li><span class="bvia-ic">①</span>CRM, 1С и таблицы синхронизируются в хранилище по расписанию</li>
      <li><span class="bvia-ic">②</span>Semantic layer фиксирует метрики — AI не «угадывает» определения</li>
      <li><span class="bvia-ic">③</span>Каждый ответ сопровождается запросом и числом строк (trust-layer)</li>
      <li><span class="bvia-ic">④</span>Утверждённый вывод уходит в дашборд и Telegram-дайджест руководителю</li>
    </ul>
    <div class="bvia-pills">
      <span class="bvia-pl bvia-pl-t">6 источников</span>
      <span class="bvia-pl bvia-pl-b">SQL виден</span>
      <span class="bvia-pl bvia-pl-v">Human-in-the-loop</span>
    </div>
    <p class="bvia-foot">Дальше — пошаговый путь от сырых данных к решению руководителя →</p>
  </div>

  <div class="bvia-rgt">
    <canvas
      id="bvia-pipeline-canvas"
      aria-label="Анимация: поток данных от CRM, 1С и таблиц через витрину и semantic layer к AI-выводу и Telegram-дайджесту"
      role="img"
    ></canvas>
  </div>

</div>
</div>

<script>
(function(){
  var cv = document.getElementById('bvia-pipeline-canvas');
  if (!cv) return;
  var cx = cv.getContext('2d');
  var W=0, H=0, fr=0, pulse=0;

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
    teal:'#2dd4bf', tealD:function(a){return 'rgba(45,212,191,'+a+')';},
    blue:'#60a5fa', blueD:function(a){return 'rgba(96,165,250,'+a+')';},
    viol:'#a78bfa', violD:function(a){return 'rgba(167,139,250,'+a+')';},
    green:'#4ade80', greenD:function(a){return 'rgba(74,222,128,'+a+')';},
    amber:'#fbbf24',
    text:'#e2e8f0', muted:'rgba(226,232,240,.45)',
    line:'rgba(255,255,255,.08)', card:'rgba(255,255,255,.06)', cardBdr:'rgba(255,255,255,.11)'
  };

  var SOURCES = [
    {id:'crm', label:'CRM', sub:'amoCRM', x:0.08, clr:C.blue, dim:C.blueD},
    {id:'1c',  label:'1С',  sub:'учёт',  x:0.08, yOff:1, clr:C.amber, dim:function(a){return 'rgba(251,191,36,'+a+')';}},
    {id:'gs',  label:'Sheets', sub:'таблицы', x:0.08, yOff:2, clr:C.green, dim:C.greenD}
  ];

  var particles = [];
  for (var i=0;i<28;i++){
    particles.push({
      t:Math.random(), lane:Math.floor(Math.random()*3),
      spd:0.003+Math.random()*0.004, alpha:0.4+Math.random()*0.5, sz:2+Math.random()*2
    });
  }

  var barHeights = [0.35,0.55,0.42,0.68,0.5,0.62];
  var barTarget  = [0.35,0.55,0.42,0.68,0.5,0.62];
  var digestAlpha = 0;
  var sqlReveal = 0;
  var LOOP = 900;

  function rr(x,y,w,h,r,fill,stroke,lw){
    cx.beginPath();
    if(cx.roundRect){cx.roundRect(x,y,w,h,r);}
    else{
      cx.moveTo(x+r,y);cx.arcTo(x+w,y,x+w,y+h,r);
      cx.arcTo(x+w,y+h,x,y+h,r);cx.arcTo(x,y+h,x,y,r);
      cx.arcTo(x,y,x+w,y,r);cx.closePath();
    }
    if(fill){cx.fillStyle=fill;cx.fill();}
    if(stroke){cx.strokeStyle=stroke;cx.lineWidth=lw||1.5;cx.stroke();}
  }

  function drawTopBar(){
    cx.fillStyle=C.text;
    cx.font='bold 12px Inter,system-ui,sans-serif';
    cx.textAlign='left';
    cx.fillText('Data pipeline · live', 14, 22);
    var gR = 5+Math.sin(pulse*0.08)*2;
    cx.beginPath();cx.arc(W-58,18,gR+3,0,Math.PI*2);
    cx.fillStyle='rgba(74,222,128,'+(0.12+0.1*Math.sin(pulse*0.08))+')';cx.fill();
    cx.beginPath();cx.arc(W-58,18,4,0,Math.PI*2);
    cx.fillStyle=C.green;cx.fill();
    cx.fillStyle=C.green;
    cx.font='10px Inter,sans-serif';
    cx.fillText('ETL sync', W-46, 22);
    cx.strokeStyle=C.line;cx.lineWidth=1;
    cx.beginPath();cx.moveTo(0,32);cx.lineTo(W,32);cx.stroke();
  }

  function nodePos(lane){
    var top = 52;
    var rowH = (H - top - 50) / 3.2;
    return {x:W*0.10, y:top + lane*rowH + rowH*0.35};
  }

  function drawSources(){
    SOURCES.forEach(function(s, i){
      var p = nodePos(i);
      s.px = p.x; s.py = p.y;
      rr(p.x-4, p.y-22, 72, 44, 10, C.card, s.clr+'55', 1.5);
      cx.fillStyle=s.clr;
      cx.font='bold 11px Inter,sans-serif';cx.textAlign='left';
      cx.fillText(s.label, p.x+6, p.y-4);
      cx.fillStyle=C.muted;
      cx.font='9px Inter,sans-serif';
      cx.fillText(s.sub, p.x+6, p.y+10);
      var dot = 0.5+0.5*Math.sin(pulse*0.06+i*1.2);
      cx.beginPath();cx.arc(p.x+58, p.y-10, 3+dot, 0, Math.PI*2);
      cx.fillStyle=s.dim(0.5+dot*0.4);cx.fill();
    });
  }

  function drawWarehouse(){
    var wx = W*0.36, wy = H*0.38, ww = W*0.16, wh = H*0.28;
    rr(wx, wy, ww, wh, 12, C.card, C.teal+'44', 1.5);
    cx.fillStyle=C.teal;
    cx.font='bold 11px Inter,sans-serif';cx.textAlign='center';
    cx.fillText('PostgreSQL', wx+ww/2, wy+22);
    cx.fillStyle=C.muted;cx.font='9px Inter,sans-serif';
    cx.fillText('витрины marts', wx+ww/2, wy+36);
    for(var r=0;r<3;r++){
      rr(wx+10, wy+48+r*16, ww-20, 10, 4, C.tealD(0.12), null, 0);
      var fillW = (ww-24)*(0.55+0.35*Math.sin(pulse*0.04+r*0.8));
      rr(wx+12, wy+50+r*16, fillW, 6, 3, C.tealD(0.35), null, 0);
    }
    return {x:wx+ww, y:wy+wh/2, lx:wx, ly:wy+wh/2};
  }

  function drawSemantic(wh){
    var sx = W*0.56, sy = H*0.32, sw = W*0.13, sh = H*0.36;
    rr(sx, sy, sw, sh, 50, C.violD(0.08), C.viol+'55', 1.5);
    cx.fillStyle=C.viol;
    cx.font='bold 10px Inter,sans-serif';cx.textAlign='center';
    cx.fillText('semantic', sx+sw/2, sy+sh/2-6);
    cx.fillText('layer', sx+sw/2, sy+sh/2+8);
    for(var i=0;i<4;i++){
      var ang = (i/4)*Math.PI*2 + pulse*0.03;
      cx.beginPath();
      cx.arc(sx+sw/2+Math.cos(ang)*sw*0.35, sy+sh/2+Math.sin(ang)*sh*0.28, 2.5, 0, Math.PI*2);
      cx.fillStyle=C.violD(0.6);cx.fill();
    }
    return {x:sx, y:sy+sh/2, rx:sx+sw, ry:sy+sh/2};
  }

  function drawAI(sem){
    var ax = W*0.74, ay = H*0.36, aw = W*0.11, ah = H*0.22;
    rr(ax, ay, aw, ah, 14, C.blueD(0.1), C.blue+'55', 1.5);
    cx.fillStyle=C.blue;
    cx.font='bold 12px Inter,sans-serif';cx.textAlign='center';
    cx.fillText('AI', ax+aw/2, ay+ah/2-2);
    cx.font='9px Inter,sans-serif';cx.fillStyle=C.muted;
    cx.fillText('NLQ', ax+aw/2, ay+ah/2+12);
    var glow = 0.3+0.2*Math.sin(pulse*0.1);
    cx.beginPath();cx.arc(ax+aw/2, ay+ah/2, aw*0.55+glow*4, 0, Math.PI*2);
    cx.strokeStyle=C.blueD(glow);cx.lineWidth=2;cx.stroke();
    return {x:ax, y:ay+ah/2};
  }

  function drawOutputs(ai){
    var ox = W*0.88, oy = H*0.28;

    /* mini chart */
    var cw2 = W*0.10, ch2 = H*0.22;
    rr(ox-cw2, oy, cw2, ch2, 8, C.card, C.cardBdr, 1);
    cx.fillStyle=C.muted;cx.font='8px Inter,sans-serif';cx.textAlign='left';
    cx.fillText('дашборд', ox-cw2+6, oy+14);
    var bw = (cw2-16)/barHeights.length;
    for(var b=0;b<barHeights.length;b++){
      var bh = barHeights[b]*ch2*0.55;
      var bx = ox-cw2+8+b*bw;
      var by = oy+ch2-10-bh;
      rr(bx, by, bw-3, bh, 3, C.tealD(0.5), null, 0);
    }

    /* telegram digest */
    var ty = oy+ch2+14, tw = W*0.11, th = H*0.18;
    rr(ox-tw, ty, tw, th, 10, C.greenD(0.1), C.green+'44', 1.5);
    cx.globalAlpha = digestAlpha;
    cx.fillStyle=C.green;
    cx.font='bold 9px Inter,sans-serif';cx.textAlign='left';
    cx.fillText('Telegram 09:00', ox-tw+8, ty+16);
    cx.fillStyle=C.text;cx.font='8px Inter,sans-serif';
    cx.fillText('Маржа −4%: канал X', ox-tw+8, ty+32);
    cx.fillText('Дебиторка +12%', ox-tw+8, ty+44);
    cx.fillStyle=C.muted;
    cx.fillText('✓ SQL проверен', ox-tw+8, ty+58);
    cx.globalAlpha = 1;
  }

  function drawSQLPanel(){
    var phase = (fr % LOOP) / LOOP;
    sqlReveal = phase > 0.45 && phase < 0.85 ? Math.min(1, (phase-0.45)*5) : phase >= 0.85 ? Math.max(0, 1-(phase-0.85)*6) : 0;
    if(sqlReveal < 0.05) return;
    var sx = W*0.30, sy = H*0.72, sw = W*0.42, sh = 36;
    cx.globalAlpha = sqlReveal * 0.95;
    rr(sx, sy, sw, sh, 8, 'rgba(15,23,42,.85)', C.teal+'66', 1);
    cx.fillStyle=C.teal;
    cx.font='9px ui-monospace,monospace';cx.textAlign='left';
    cx.fillText('SELECT channel, margin_pct FROM marts.sales', sx+10, sy+14);
    cx.fillStyle=C.muted;
    cx.fillText('→ 1 247 строк · trust-layer', sx+10, sy+28);
    cx.globalAlpha = 1;
  }

  function drawFlows(wh, sem, ai){
    var midX = wh.x;
    SOURCES.forEach(function(s, i){
      var p = nodePos(i);
      cx.strokeStyle = s.dim(0.25);
      cx.lineWidth = 1.5;
      cx.beginPath();
      cx.moveTo(p.x+68, p.y);
      cx.bezierCurveTo(midX-30, p.y, midX-30, wh.y, wh.x-8, wh.y);
      cx.stroke();
    });
    cx.strokeStyle = C.tealD(0.35);cx.lineWidth = 2;
    cx.beginPath();cx.moveTo(wh.x, wh.y);cx.lineTo(sem.x, sem.y);cx.stroke();
    cx.strokeStyle = C.violD(0.35);
    cx.beginPath();cx.moveTo(sem.rx, sem.ry);cx.lineTo(ai.x, ai.y);cx.stroke();
    cx.strokeStyle = C.blueD(0.3);
    cx.beginPath();cx.moveTo(ai.x+W*0.11, ai.y);cx.lineTo(W*0.82, ai.y-20);cx.stroke();
    cx.beginPath();cx.moveTo(ai.x+W*0.11, ai.y);cx.lineTo(W*0.82, ai.y+40);cx.stroke();
  }

  function drawParticles(wh){
    particles.forEach(function(pt){
      pt.t += pt.spd;
      if(pt.t > 1) pt.t = 0;
      var p = nodePos(pt.lane);
      var t = pt.t;
      var x = p.x+68 + (wh.x-8-p.x-68)*t;
      var y = p.y + (wh.y-p.y)*t + Math.sin(t*Math.PI)*8;
      cx.beginPath();cx.arc(x, y, pt.sz, 0, Math.PI*2);
      cx.fillStyle = SOURCES[pt.lane].dim(pt.alpha);cx.fill();
    });
  }

  function tick(){
    fr++; pulse++;
    var phase = (fr % LOOP) / LOOP;
    digestAlpha = phase > 0.55 ? Math.min(1, (phase-0.55)*4) : phase < 0.1 ? phase*10 : 0.85;
    if(fr % 120 === 0){
      for(var b=0;b<barHeights.length;b++){
        barTarget[b] = 0.25+Math.random()*0.5;
      }
    }
    for(var b=0;b<barHeights.length;b++){
      barHeights[b] += (barTarget[b]-barHeights[b])*0.06;
    }
    cx.clearRect(0,0,W,H);
    drawTopBar();
    drawSources();
    var wh = drawWarehouse();
    var sem = drawSemantic(wh);
    var ai = drawAI(sem);
    drawFlows(wh, sem, ai);
    drawParticles(wh);
    drawOutputs(ai);
    drawSQLPanel();
    requestAnimationFrame(tick);
  }
  tick();
})();
</script>
</section>

      <aside class="ym-cta-block ym-cta-block--primary" id="cta-audit">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Бесплатный аудит отчётности за 3–5 дней</p>
          <p class="ym-cta-block__sub">Разберём ваши источники данных, карту отчётов и узкие места. Покажем, какие метрики вынести в AI-дайджест и NLQ-чат — без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </aside>

  <aside class="vnaa-card nero-ai-reveal" style="margin:0 0 32px;border-color:rgba(121,242,255,.22);" aria-label="Смежные материалы по AI-внедрению">
    <h3>Данные для аналитики: от входящих заявок к отчётам</h3>
    <p>Часть управленческих метрик начинается не в BI, а во входящем потоке: письма, заявки, лиды. Если отчёты «сыпятся» из почты, имеет смысл сначала настроить <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI-обработку входящей почты в CRM</a> — классификация и маршрутизация до того, как данные попадут в витрину для NLQ.</p>
  </aside>

  <section class="vnaa-section" id="kak-rabotaet">
    <div class="vnaa-cnt">
      <div class="vnaa-sh nero-ai-reveal">
        <h2>Как это работает: от сырых данных к решениям руководителя</h2>
      </div>
      <div class="vnaa-summary-box nero-ai-reveal"><p><strong>Итог:</strong> пять шагов от вопроса руководителя до верифицированного ответа — ETL → semantic layer → NLQ-вопрос → SQL + вывод → ревью человека.</p></div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Подключение источников: CRM, 1С, таблицы, БД</h3>
<ul><li><strong>CRM</strong> (amoCRM, Битрикс24) — сделки, воронка, менеджеры, источники лидов;</li><li><strong>1С</strong> — выручка, себестоимость, дебиторка (выгрузка OData/REST/файлы);</li><li><strong>Google Sheets</strong> — быстрый старт для SMB, пока не готово хранилище;</li><li><strong>PostgreSQL / ClickHouse</strong> — если данные уже централизованы.</li></ul>
<p>Минимальный набор для старта пилота:</p>
<p>Нужна история <strong>6–12 месяцев</strong> по 1–2 ключевым процессам и справочники: продукты, клиенты, каналы, менеджеры.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>RAG и безопасный доступ к корпоративным данным</h3>
<p>RAG (Retrieval-Augmented Generation) позволяет LLM отвечать на основе ваших документов и метаданных витрин, а не «общих знаний» из обучения. ClickHouse в концепции Agentic Data Stack рекомендует: <strong>expose only curated data marts</strong>, read-only роль для LLM, medallion architecture (raw → staging → marts).</p>
<p>В Nero Network AI не получает прямой доступ к сырым таблицам — только к подготовленным витринам с RBAC. Персональные данные обезличиваются или обрабатываются в контуре РФ (GigaChat, YandexGPT) в соответствии с <strong>152-ФЗ</strong>.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Telegram-дайджесты и отчёты для маркетинга, финансов, продаж</h3>
<ul><li><em>Маркетинг:</em> ROMI по каналам, CPL, конверсия воронки;</li><li><em>Финансы:</em> cash flow, отклонения от бюджета, дебиторка;</li><li><em>Продажи:</em> план/факт, зависшие сделки, прогноз закрытия месяца.</li></ul>
<p>Уникальный угол Nero Network — <strong>не «ещё один дашборд», а «3 цифры + 1 вывод + 1 риск в 9:00»</strong> в Telegram руководителя:</p>
<p>АТБ с GigaChat Enterprise сократил время на рутинные запросы сотрудников на <strong>78,5%</strong>; финансовый эффект первого этапа — <strong>75 млн ₽</strong>. Для SMB масштаб другой, но логика та же: руководитель получает ответы без ожидания аналитика.</p>
</div>
    </div>
  </section>

  <section class="vnaa-section vnaa-section-alt" id="integracii">
    <div class="vnaa-cnt">
      <div class="vnaa-sh nero-ai-reveal">
        <h2>Интеграция AI-аналитики с CRM, 1С и BI</h2>
      </div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>amoCRM, Битрикс24 и воронки продаж</h3>
<ul><li>конверсия по этапам и менеджерам;</li><li>средний цикл сделки по сегментам;</li><li>прогноз закрытия месяца на основе текущего pipeline.</li></ul>
<p>Интеграция <strong>AI-аналитики с CRM</strong> даёт ответы по воронке в реальном времени — смежный сценарий: <a href="/vnedrenie-ai-amocrm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a> для автоматизации сделок и задач до слоя аналитики:</p>
<p>Данные синхронизируются в витрину; AI не ходит напрямую в API CRM при каждом запросе — это снижает нагрузку и повышает предсказуемость ответов.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>1С и учётные данные</h3>
<p>1С — основной источник финансовой правды для российского SMB и среднего бизнеса. Подключаем через OData, REST или регламентную выгрузку; для учётного контура отдельно разбираем <a href="/ai-1c-erp/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI-агента для 1С и ERP под ключ</a>. AI-аналитика отвечает на вопросы по выручке, марже, себестоимости, дебиторке — с привязкой к справочникам номенклатуры и контрагентов.</p>
<p>Важно: определения метрик в 1С и в Excel часто расходятся. Semantic layer на этапе внедрения <strong>синхронизирует</strong> «как считаем выручку» для всей компании.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Power BI, Yandex DataLens, Metabase, ClickHouse + LLM</h3>
<ul><li><strong>Power BI + Copilot</strong> — мощно, но в РФ нужны лицензии Fabric F2+/Premium P1+, данные уходят в Azure OpenAI, Q&A выводится из эксплуатации в декабре 2026 → переход на Copilot;</li><li><strong>DataLens + Нейроаналитик</strong> — встроенный агент, данные в контуре Yandex Cloud, ускорение отчётов ~30%;</li><li><strong>Metabase + Metabot</strong> — AI во всех редакциях, включая open-source (Metabase 60, апрель 2026);</li><li><strong>ClickHouse + MCP-агент</strong> — максимальная гибкость для кастомной архитектуры.</li></ul>
<p>Если у вас уже есть BI — AI-слой ставится <strong>поверх</strong>, а не вместо:</p>
<p>Nero Network помогает выбрать стек под ваш бюджет, требования 152-ФЗ и существующую инфраструктуру.</p>
</div>
    </div>
  </section>

  <section class="vnaa-section" id="smb">
    <div class="vnaa-cnt">
      <div class="vnaa-sh nero-ai-reveal">
        <h2>AI-аналитика для малого и среднего бизнеса</h2>
      </div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Для руководителей и собственников</h3>
<p>Собственнику не нужен ещё один дашборд, который некогда смотреть. Нужны ответы: «Можем ли мы позволить себе расширение штата?», «Какой продукт тянет маржу вниз?», «Где теряем деньги в воронке?». AI-аналитика для малого бизнеса даёт эти ответы в Telegram — без найма штатного BI-аналитика.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Для маркетинга, финансов, продаж и продуктовых команд</h3>
<ul><li><strong>Маркетинг</strong> — ROMI, атрибуция, A/B-гипотезы;</li><li><strong>Финансы</strong> — бюджет, cash flow, прогноз;</li><li><strong>Продажи</strong> — pipeline, план/факт, эффективность менеджеров;</li><li><strong>Продукт</strong> — когорты, retention, unit-экономика.</li></ul>
<p>Каждая функция получает свой набор вопросов и дайджестов:</p>
<p>71% крупных компаний в России используют GenAI хотя бы в одной функции (Яков и Партнёры + Яндекс, 2025). Тренд спускается в средний бизнес: те, кто внедрит AI-аналитику раньше, получат преимущество в скорости решений.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>AI-аналитика без программиста: когда это реально</h3>
<p><strong>AI-аналитика без программиста</strong> возможна на этапе <strong>использования</strong> — руководитель и маркетолог задают вопросы в чате. Но <strong>внедрение</strong> требует настройки витрин, интеграций и semantic layer. Именно поэтому модель «под ключ» от Nero Network выгоднее, чем попытка собрать стек силами офис-менеджера по туториалам.</p>
<p>Пилот за 4–6 недель с одним интегратором заменяет месяцы проб и ошибок. После запуска — обучение команды за 2–3 сессии.</p>
</div>
    </div>
  </section>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите понимать AI-аналитику до старта проекта?</p>
          <p class="ym-cta-block__sub">Если команда хочет разобраться в semantic layer, промптах, интеграции CRM/1С и human-in-the-loop до пилота — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование метрик с финансами и IT.</p>
        </div>
      </aside>

  <section class="vnaa-section vnaa-section-alt" id="stoimost">
    <div class="vnaa-cnt">
      <div class="vnaa-sh nero-ai-reveal">
        <h2>Стоимость внедрения AI-аналитики</h2>
      </div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Из чего складывается цена: объём данных, интеграции, кастомизация</h3>
<ul><li>количества источников данных (1–2 на пилоте, 5+ на продакшене);</li><li>глубины интеграций (файловая выгрузка vs real-time API);</li><li>требований к безопасности (облако vs on-prem);</li><li>кастомизации отчётов и дайджестов;</li><li>объёма исторических данных и качества «на входе».</li></ul>
<p><strong>AI-аналитика цена</strong> зависит от:</p>
<p>По данным flysk.ru и ai-rate.ru, лёгкий аудит AI стоит <strong>250–600 тыс. ₽</strong>, пилот с интеграциями — <strong>300 тыс.–1,5 млн ₽</strong>.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Ориентиры по чеку: от 250 тыс. до 2 млн ₽</h3>
<div class="vnaa-table-wrap"><table class="vnaa-table"><thead><tr><th>Фаза</th><th>Срок</th><th>Ориентир стоимости</th><th>Что входит</th></tr></thead><tbody><tr><td>Аудит отчётности</td><td>3–5 дней</td><td>Бесплатно (лид-магнит)</td><td>Карта данных и отчётов</td></tr><tr><td>Пилот</td><td>4–6 недель</td><td>250–600 тыс. ₽</td><td>1–2 источника, 3–5 дашбордов, NLQ, Telegram-бот</td></tr><tr><td>Продакшен</td><td>6–12 недель</td><td>600 тыс.–2 млн ₽</td><td>Масштабирование, прогнозы, governance, обучение</td></tr></tbody></table></div>
<p>Чек Nero Network <strong>250 тыс.–2 млн ₽</strong> совпадает с рыночными пилотами AI-агентов с интеграциями. ROI окупается за 3–6 месяцев при сравнении со штатным аналитиком (зарплата + время руководителя на ожидание отчётов).</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Под ключ или своими силами: сравнение подходов</h3>
<div class="vnaa-table-wrap"><table class="vnaa-table"><thead><tr><th>Критерий</th><th>Под ключ (Nero Network)</th><th>Своими силами</th></tr></thead><tbody><tr><td>Срок до первого результата</td><td>4–6 недель</td><td>3–6 месяцев</td></tr><tr><td>Риск ошибок в SQL и метриках</td><td>Снижен semantic layer + ревью</td><td>Высокий без опыта</td></tr><tr><td>152-ФЗ и безопасность</td><td>Встроена в архитектуру</td><td>На вашей ответственности</td></tr><tr><td>Поддержка</td><td>Сопровождение после запуска</td><td>Внутренний ресурс</td></tr><tr><td>Стоимость</td><td>250 тыс.–2 млн ₽ (предсказуемо)</td><td>Зарплаты + лицензии + простой</td></tr></tbody></table></div>
</div>
    </div>
  </section>

  <section class="vnaa-section" id="keisy">
    <div class="vnaa-cnt">
      <div class="vnaa-sh nero-ai-reveal">
        <h2>Примеры внедрения и кейсы AI-аналитики</h2>
      </div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>До и после: ручные отчёты vs автоматические выводы</h3>
<p><strong>До:</strong> Маркетолог каждую пятницу 4 часа собирает отчёт по каналам из рекламных кабинетов, CRM и Excel. К понедельнику цифры устарели. Руководитель принимает решения на интуиции.</p>
<p><strong>После:</strong> Витрина обновляется ежедневно. В 9:00 в Telegram — дайджест: 3 ключевые цифры, вывод, риск. По запросу — «Почему вырос CPL в Директе?» с SQL и ссылкой на данные. Время на подготовку отчёта — минуты вместо часов.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Сценарии для ритейла, услуг, B2B и внутренней аналитики</h3>
<ul><li><strong>Ритейл:</strong> анализ продаж по SKU, оборачиваемость, прогноз закупок;</li><li><strong>Услуги:</strong> загрузка специалистов, конверсия заявок, LTV по сегментам;</li><li><strong>B2B:</strong> воронка длинного цикла, дебиторка, план/факт по менеджерам;</li><li><strong>Внутренняя аналитика:</strong> HR-запросы, тикеты поддержки, операционные KPI.</li></ul>
<p>ОТП Банк автоматизировал анализ <strong>400 000+</strong> текстовых обращений в месяц по 260 тематикам. McKinsey Lilli обрабатывает <strong>500 000+</strong> промптов в месяц; <strong>72%</strong> сотрудников активны, экономия до <strong>30%</strong> времени на поиске и синтезе знаний. На корпоративном масштабе смотрите разбор <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude: уроки AI для бизнеса</a> — цифровые шлюзы и managed-агенты как ориентир для governance аналитики.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Что можно внедрить без enterprise-бюджета</h3>
<ul><li>пилот на amoCRM + 1С за <strong>250–600 тыс. ₽</strong>;</li><li>Telegram-дайджест для руководителя;</li><li>NLQ на 3–5 ключевых метриках;</li><li>trust-layer с SQL и ревью.</li></ul>
<p>Enterprise-кейсы (Сбер: 700+ GenAI-инициатив, эффект <strong>50 млрд ₽</strong>) — ориентир для тренда, не для копирования. SMB реально получает:</p>
<p>Публичных детальных кейсов «chat with data для SMB» в России мало — больше вендорские анонсы (DataLens) и интеграторские проекты. Nero Network закрывает этот пробел проектной моделью с измеримым пилотом.</p>
<div class="vnaa-card nero-ai-reveal" style="margin-top:20px;border-color:rgba(34,197,94,.3);"><p><strong>Кейс-нарратив (проектная модель Nero Network):</strong> Компания в сфере B2B-услуг, 40 сотрудников, amoCRM + 1С + Яндекс Директ. Аналитик один, отчёт для CEO — 6 часов в неделю. После аудита выбрали метрики: маржа по каналам и воронка продаж. За 5 недель — витрина в PostgreSQL, Metabase, GigaChat NLQ, Telegram-дайджест. CEO первый вопрос задал в понедельник утром: «Где потеряли маржу в марте?» — ответ за 40 секунд с SQL.</p></div>
</div>
    </div>
  </section>

  <section class="vnaa-section vnaa-section-alt" id="etapy">
    <div class="vnaa-cnt">
      <div class="vnaa-sh nero-ai-reveal">
        <h2>Этапы внедрения AI-аналитики: сроки и результат</h2>
      </div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Диагностика и ТЗ (1–2 недели)</h3>
<p>Инвентаризация источников, интервью с владельцами отчётов, выбор пилотных метрик, согласование архитектуры и требований 152-ФЗ. На выходе — ТЗ и коммерческое предложение с фиксированным чеком пилота.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Пилот на одном источнике данных</h3>
<p>Подключение 1–2 источников → витрина → 3–5 дашбордов → NLQ-слой → Telegram-бот. Срок: <strong>4–6 недель</strong>. Критерий успеха: руководитель получает дайджест и задаёт 10 тестовых вопросов с корректными ответами (с ревью аналитика).</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Масштабирование и передача в эксплуатацию</h3>
<p>Расширение источников, роли доступа, прогнозные метрики, аудит логов, обучение команды, документация. Срок: <strong>6–12 недель</strong>. Передача в эксплуатацию с SLA на сопровождение.</p>
</div>
    </div>
  </section>

  <section class="vnaa-section" id="riski">
    <div class="vnaa-cnt">
      <div class="vnaa-sh nero-ai-reveal">
        <h2>Риски, безопасность и качество ответов AI</h2>
      </div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Галлюцинации в цифрах: как снижаем ошибки</h3>
<ul><li><strong>Semantic layer</strong> — AI работает только с утверждёнными метриками;</li><li><strong>Показ SQL</strong> рядом с каждым ответом;</li><li><strong>Human-in-the-loop</strong> — критичные выводы на ревью до рассылки;</li><li><strong>Логирование</strong> — кто спросил, какой запрос, сколько токенов.</li></ul>
<p>Basedash и IBM фиксируют три слоя галлюцинаций в AI BI: <strong>SQL, графики, нарратив</strong>. Митигация Nero Network:</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Доступ к чувствительным данным и 152-ФЗ</h3>
<p>Персональные данные граждан РФ обрабатываются на серверах в РФ (GigaChat, YandexGPT) или в on-prem контуре. Зарубежные LLM с ПДн — риск нарушения 152-ФЗ. Мы настраиваем RBAC, обезличивание, реестр «что можно/нельзя отдавать в облачный LLM».</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Стоимость токенов на больших датасетах</h3>
<p>На больших объёмах данных растут затраты на токены LLM. Решение: pre-aggregation в витринах, кэширование частых запросов, лимиты на пользователя, мониторинг расхода. AI не сканирует сырые таблицы — только агрегированные marts.</p>
</div>
    </div>
  </section>

  <section class="vnaa-section vnaa-section-alt" id="faq">
    <div class="vnaa-cnt">
      <div class="vnaa-sh"><h2>FAQ по AI-аналитике для бизнеса</h2></div>
      <div class="vnaa-faq nero-ai-reveal">
        <div class="vnaa-faq-item">
          <div class="vnaa-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит AI-аналитика под ключ?</div>
          <div class="vnaa-faq-a"><p>Пилот — от <strong>250 тыс. ₽</strong>, полное внедрение — до <strong>2 млн ₽</strong>. Точная <strong>стоимость AI-аналитики</strong> зависит от числа интеграций и требований к безопасности. Начните с <strong>бесплатного аудита отчётности</strong> — получите смету под ваши данные.</p></div>
        </div>
        <div class="vnaa-faq-item">
          <div class="vnaa-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли внедрить AI-аналитику без своего BI?</div>
          <div class="vnaa-faq-a"><p>Да. На пилоте мы разворачиваем Metabase или подключаем DataLens. Если BI уже есть — AI-слой ставится поверх. Excel и Google Sheets — допустимый старт для быстрого пилота.</p></div>
        </div>
        <div class="vnaa-faq-item">
          <div class="vnaa-faq-q" role="button" tabindex="0" aria-expanded="false">AI-аналитика под ключ или самостоятельно — что выбрать?</div>
          <div class="vnaa-faq-a"><p>Если нет штатного data engineer и аналитика с опытом LLM — <strong>под ключ</strong> быстрее и безопаснее. Самостоятельный путь оправдан при наличии внутренней команды и готовности потратить 3–6 месяцев на эксперименты.</p></div>
        </div>
        <div class="vnaa-faq-item">
          <div class="vnaa-faq-q" role="button" tabindex="0" aria-expanded="false">Какие данные нужны для старта?</div>
          <div class="vnaa-faq-a"><p>Минимум: 6–12 месяцев истории по 1–2 процессам, справочники (продукты, клиенты, каналы), описание метрик «как считаем сейчас». Аудит покажет пробелы, если данных недостаточно.</p></div>
        </div>
        <div class="vnaa-faq-item">
          <div class="vnaa-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-аналитика отличается от ChatGPT?</div>
          <div class="vnaa-faq-a"><p>ChatGPT не знает ваших данных и может «придумать» цифры. AI-аналитика Nero Network работает <strong>только</strong> с вашими витринами, показывает SQL и не отвечает без данных.</p></div>
        </div>
        <div class="vnaa-faq-item">
          <div class="vnaa-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли программист после внедрения?</div>
          <div class="vnaa-faq-a"><p>Для ежедневного использования — нет. Для доработки витрин и новых интеграций — желателен сопровождающий партнёр или внутренний специалист. Nero Network предлагает сопровождение после запуска.</p></div>
        </div>
        <div class="vnaa-faq-item">
          <div class="vnaa-faq-q" role="button" tabindex="0" aria-expanded="false">Что если AI ошибётся в цифрах?</div>
          <div class="vnaa-faq-a"><p>Trust-by-design: SQL виден, критичные ответы проходят ревью, аномалии логируются. Один неверный ответ не должен доходить до совета директоров без проверки.</p></div>
        </div>
        <div class="vnaa-faq-item">
          <div class="vnaa-faq-q" role="button" tabindex="0" aria-expanded="false">Какие задачи решает AI-аналитика?</div>
          <div class="vnaa-faq-a"><p>Ускорение управленческих отчётов, ответы на вопросы к данным без аналитика, прогнозы, выявление аномалий, Telegram-дайджесты, снижение ошибок ручного копирования между системами.</p></div>
        </div>
      </div>
    </div>
  </section>

  <section class="vnaa-section" id="zakazat">
    <div class="vnaa-cnt">
      <div class="vnaa-sh nero-ai-reveal">
        <h2>Заказать внедрение AI-аналитики</h2>
      </div>
      <p class="nero-ai-reveal" style="max-width:820px;margin:0 auto 24px;text-align:center;color:var(--vnaa-muted);">Nero Network внедряет <strong>AI-аналитику для бизнеса</strong> под ключ: от аудита до Telegram-дайджестов. Российский стек (DataLens, Metabase, GigaChat, YandexGPT), интеграции с amoCRM, Битрикс24, 1С, честный чек <strong>250 тыс.–2 млн ₽</strong>, trust-by-design с SQL и ревью.</p>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Бесплатный аудит отчётности</h3>
<p>За 3–5 дней мы разберём ваши источники данных, карту отчётов и узкие места. Вы получите конкретные рекомендации — без обязательств.</p>
</div>
      <div class="vnaa-card nero-ai-reveal" style="margin-top:24px;"><h3>Консультация и коммерческое предложение</h3>
<p>После аудита — пилот с фиксированным сроком и чеком. Первый <strong>AI-отчёт</strong> по вашим данным — уже на этапе пилота.</p>
<p><strong>→ Получить AI-отчёт</strong> — оставьте заявку, и мы свяжемся в течение рабочего дня.</p>
<p><strong>→ Аудит отчётности</strong> — бесплатно, 3–5 дней, результат на вашу почту.</p>
</div>
    </div>
  </section>

  <div class="vnaa-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получить AI-отчёт по вашим данным</p>
        <p class="ym-cta-block__sub">Аудит отчётности бесплатно · пилот от 250 тыс. ₽ · первый вывод в Telegram уже на этапе пилота. Напишите — ответим в рабочий день.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить AI-отчёт</a>
          <a href="#stoimost" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Смотреть цены</a>
        </div>
      </div>
    </div>
<?php
$ad_banner_url = getenv('AD_BANNER_URL') ?: '';
$ad_banner_image = getenv('AD_BANNER_IMAGE_URL') ?: '';
$ad_banner_alt = getenv('AD_BANNER_ALT') ?: 'Рекламный баннер партнёра';
if ($ad_banner_url && $ad_banner_image) : ?>
    <div class="ym-ad-banner-wrap" id="partner-banner">
      <a href="<?php echo esc_url($ad_banner_url); ?>" target="_blank" rel="noopener noreferrer">
        <img src="<?php echo esc_url($ad_banner_image); ?>" width="970" height="90" alt="<?php echo esc_attr($ad_banner_alt); ?>" loading="lazy" decoding="async" style="max-width:100%; height:auto; border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,.25);">
      </a>
    </div>
<?php endif; ?>
  </div>

</div><!-- /.vnaa-content -->

<?php
$vnaa_page_url = trailingslashit( get_permalink() );
$vnaa_site_url = trailingslashit( home_url( '/' ) );
$vnaa_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$vnaa_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $vnaa_site_url . '#organization',
      'name'  => $vnaa_brand,
      'url'   => $vnaa_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $vnaa_site_url . '#website',
      'url'       => $vnaa_site_url,
      'name'      => $vnaa_brand,
      'publisher' => [ '@id' => $vnaa_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $vnaa_page_url . '#webpage',
      'url'         => $vnaa_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $vnaa_site_url . '#website' ],
      'about'       => [ '@id' => $vnaa_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $vnaa_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vnaa_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vnaa_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $vnaa_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $vnaa_page_url,
      'provider'    => [ '@id' => $vnaa_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $vnaa_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Сколько стоит AI-аналитика под ключ?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Пилот — от 250 тыс. ₽, полное внедрение — до 2 млн ₽. Точная стоимость AI-аналитики зависит от числа интеграций и требований к безопасности. Начните с бесплатного аудита отчётности — получите смету под ваши данные.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли внедрить AI-аналитику без своего BI?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. На пилоте мы разворачиваем Metabase или подключаем DataLens. Если BI уже есть — AI-слой ставится поверх. Excel и Google Sheets — допустимый старт для быстрого пилота.' ] ],
        [ '@type' => 'Question', 'name' => 'AI-аналитика под ключ или самостоятельно — что выбрать?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Если нет штатного data engineer и аналитика с опытом LLM — под ключ быстрее и безопаснее. Самостоятельный путь оправдан при наличии внутренней команды и готовности потратить 3–6 месяцев на эксперименты.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие данные нужны для старта?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Минимум: 6–12 месяцев истории по 1–2 процессам, справочники (продукты, клиенты, каналы), описание метрик «как считаем сейчас». Аудит покажет пробелы, если данных недостаточно.' ] ],
        [ '@type' => 'Question', 'name' => 'Чем AI-аналитика отличается от ChatGPT?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'ChatGPT не знает ваших данных и может «придумать» цифры. AI-аналитика Nero Network работает только с вашими витринами, показывает SQL и не отвечает без данных.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужен ли программист после внедрения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Для ежедневного использования — нет. Для доработки витрин и новых интеграций — желателен сопровождающий партнёр или внутренний специалист. Nero Network предлагает сопровождение после запуска.' ] ],
        [ '@type' => 'Question', 'name' => 'Что если AI ошибётся в цифрах?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Trust-by-design: SQL виден, критичные ответы проходят ревью, аномалии логируются. Один неверный ответ не должен доходить до совета директоров без проверки.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие задачи решает AI-аналитика?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ускорение управленческих отчётов, ответы на вопросы к данным без аналитика, прогнозы, выявление аномалий, Telegram-дайджесты, снижение ошибок ручного копирования между системами.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vnaa_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>


<script>
(function(){
  document.querySelectorAll('.vnaa-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.vnaa-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.vnaa-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.vnaa-faq-q');
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
  var root = document.querySelector('.vnaa-content');
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

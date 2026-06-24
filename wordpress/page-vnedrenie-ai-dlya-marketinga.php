<?php
/**
 * Template Name: AI для маркетинга: внедрение под ключ
 * Description: Внедрение AI в контент, аналитику, сегментацию, рекламу и персонализацию маркетинга.
 */

declare(strict_types=1);

$page_seo_title       = 'AI для маркетинга: внедрение под ключ — контент и аналитика';
$page_seo_description = 'Внедряем AI для маркетинга: контент, аналитика, сегментация, реклама и персонализация. Кейсы, цена, интеграция с CRM. Аудит и внедрение под ключ для МСБ и e-commerce.';

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

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = 'Ускорить маркетинг';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#etapy';

$nero_ai_header_links = [
    ['label' => 'Задачи', 'href' => '#zadachi'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

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
.vna-related-card{color:inherit;text-decoration:none;display:block;}
.vna-related-card h3{margin:0 0 10px;font-size:18px;}
.vna-related-card p{margin:0;font-size:14px;color:var(--vna-muted);line-height:1.55;}
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
/* ── Hero AI-маркетинг: самодостаточные стили (без CSS темы) ── */
.vnam-hero-marketing {
  --vnam-cyan: #79f2ff;
  --vnam-violet: #8b5cf6;
  --vnam-green: #22c55e;
  --vnam-amber: #f59e0b;
  --vnam-text: #e6edf7;
  --vnam-muted: #9aa8bd;
  --vnam-soft: #c7d2e5;
  --vnam-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnam-hero-marketing.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnam-hero-marketing::before {
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
.vnam-hero-marketing::after {
  content: "";
  position: absolute;
  left: 58%;
  top: 12%;
  width: 760px;
  height: 760px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(6px);
  animation: vnamHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnamHeroGlow {
  from { opacity: .4; transform: translateX(-50%) scale(.94); }
  to { opacity: .82; transform: translateX(-50%) scale(1.05); }
}
.vnam-hero-marketing .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnam-hero-marketing .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnam-hero-marketing .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnam-hero-marketing .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnam-cyan) 38%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnam-hero-marketing .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnam-cyan);
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
}
.vnam-hero-marketing .nero-ai-hero-lead {
  margin: 18px 0 0;
  max-width: 640px;
  font-size: clamp(16px, 1.8vw, 20px);
  line-height: 1.55;
  color: var(--vnam-muted);
}
.vnam-hero-marketing .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 22px 0 0;
  padding: 0;
  list-style: none;
}
.vnam-hero-marketing .nero-ai-badge {
  padding: 8px 14px;
  border-radius: 999px;
  border: 1px solid rgba(148, 163, 184, 0.18);
  background: rgba(255, 255, 255, 0.06);
  color: var(--vnam-soft);
  font-size: 12.5px;
  font-weight: 700;
}
.vnam-hero-marketing .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 28px;
}
.vnam-hero-marketing .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 26px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 15px;
  text-decoration: none !important;
  transition: transform 0.2s, box-shadow 0.2s;
  border: 1px solid transparent;
  min-height: 48px;
}
.vnam-hero-marketing .nero-ai-btn:hover,
.vnam-hero-marketing .nero-ai-btn:focus-visible {
  transform: translateY(-2px);
}
.vnam-hero-marketing .nero-ai-btn-primary {
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  color: #fff !important;
  box-shadow: 0 8px 32px rgba(59, 130, 246, 0.35);
}
.vnam-hero-marketing .nero-ai-btn-secondary {
  background: transparent;
  color: #e2e8f0 !important;
  border-color: rgba(148, 163, 184, 0.14);
}
.vnam-hero-marketing .nero-ai-btn-secondary:hover {
  border-color: rgba(59, 130, 246, 0.35);
}
.vnam-hero-marketing .nero-ai-dashboard {
  padding: 14px;
  border-radius: 28px;
  background: linear-gradient(180deg, rgba(255,255,255,.09), rgba(255,255,255,.04));
  border: 1px solid rgba(255,255,255,.12);
  box-shadow: var(--vnam-shadow);
  transform: perspective(1200px) rotateY(-4deg);
}
.vnam-hero-marketing .nero-ai-dashboard-shell {
  border-radius: 22px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(6, 10, 24, .88);
}
.vnam-hero-marketing .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.vnam-hero-marketing .nero-ai-dots {
  display: flex;
  gap: 6px;
}
.vnam-hero-marketing .nero-ai-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: rgba(148,163,184,.35);
}
.vnam-hero-marketing .nero-ai-dot:nth-child(1) { background: #f87171; }
.vnam-hero-marketing .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnam-hero-marketing .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnam-hero-marketing .nero-ai-window-title {
  color: var(--vnam-muted);
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnam-hero-marketing .nero-ai-window-body { padding: 16px; }
.vnam-hero-marketing .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vnam-hero-marketing .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnam-hero-marketing .nero-ai-live-pill {
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
.vnam-hero-marketing .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnamPulse 1.6s infinite;
}
@keyframes vnamPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnam-hero-marketing .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnam-hero-marketing .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnam-hero-marketing .nero-ai-metric span {
  display: block;
  color: var(--vnam-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnam-hero-marketing .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnam-hero-marketing .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnam-hero-marketing .vnam-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(139, 92, 246, 0.18);
  background: radial-gradient(ellipse at 50% 42%, rgba(139,92,246,.10), rgba(6,10,24,.92) 72%);
}
.vnam-hero-marketing #vnam-marketing-ops-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnam-hero-marketing .nero-ai-task-stream {
  display: grid;
  gap: 8px;
}
.vnam-hero-marketing .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnam-hero-marketing .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(139,92,246,.14);
  color: #c4b5fd;
  font-size: 11px;
  font-weight: 800;
}
.vnam-hero-marketing .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnam-hero-marketing .nero-ai-task span {
  color: var(--vnam-muted);
  font-size: 11px;
}
.vnam-hero-marketing .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnam-hero-marketing .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vnam-hero-marketing .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnam-hero-marketing .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vnam-hero-marketing .nero-ai-metrics-grid { grid-template-columns: 1fr 1fr; }
  .vnam-hero-marketing .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnam-hero-marketing .nero-ai-window-body { padding: 12px; }
  .vnam-hero-marketing .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnam-hero-marketing .nero-ai-status { grid-column: 2; width: fit-content; }
}

/* Hero viewport (agent-pipeline-pitfalls) */
.vnam-hero-marketing.nero-ai-hero{
  min-height:100vh;min-height:100dvh;position:relative;
}

/* Secondary CTA block */
.ym-cta-block--secondary{
  text-align:left;
  background:rgba(255,255,255,.04);
  border-color:rgba(255,255,255,.14);
}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-link{color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px;}
.ym-link--accent:hover{color:#fff;}

/* MSB stack flow */
.vna-flow{
  display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:10px;
  padding:22px 20px;border-radius:16px;
  background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);
}
.vna-flow span{
  font-size:13px;font-weight:700;color:var(--vna-soft);
  padding:8px 14px;border-radius:10px;background:rgba(255,255,255,.06);
}
.vna-flow .arr{color:var(--vna-accent);background:none;padding:0;font-size:16px;}

</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-dlya-marketinga-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnam-hero-marketing" id="vnam-hero-marketing" aria-labelledby="vnam-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow">Внедрение под ключ · 2026</p>
      <h1 id="vnam-hero-title">AI для маркетинга: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Контент, аналитика, сегментация и реклама — без рутины и долгих циклов гипотез</p>
      <ul class="nero-ai-badges" aria-label="Ключевые модули">
        <li class="nero-ai-badge">Контент</li>
        <li class="nero-ai-badge">Аналитика</li>
        <li class="nero-ai-badge">Сегментация</li>
        <li class="nero-ai-badge">Реклама</li>
        <li class="nero-ai-badge">Персонализация</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Ускорить маркетинг</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Этапы внедрения</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демонстрация AI-маркетинга">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-маркетинг · операционный центр</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Контент</span>
              <strong>−70%</strong>
              <small>время на черновики</small>
            </div>
            <div class="nero-ai-metric">
              <span>ROI</span>
              <strong>3,2×</strong>
              <small>median AI-маркетинг</small>
            </div>
            <div class="nero-ai-metric">
              <span>Команды</span>
              <strong>45%</strong>
              <small>с AI-агентами</small>
            </div>
          </div>

          <div class="vnam-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnam-marketing-ops-canvas" role="img" aria-label="Анимация: данные из каналов проходят через AI-хаб маркетинга и запускают кампанию с метрикой ROI"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий маркетинга">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📊</span>
              <div><strong>Отчёт Директ за неделю</strong><span>Аналитический агент · 2 мин</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✍</span>
              <div><strong>Черновик поста VK</strong><span>Brand book · human review</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">◎</span>
              <div><strong>Сегмент RFM «спящие»</strong><span>1 240 контактов · CRM</span></div>
              <span class="nero-ai-status nero-ai-status--amber">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vna-content">

  <!-- INTRO -->
  <section class="vna-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vna-cnt">
      <div class="vna-intro-grid nero-ai-reveal">
        <div class="vna-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai для маркетинга</p>
          <p>В 2026-м маркетинг генерирует больше контента, отчётов и гипотез, а штат почти не растёт. Ручные сводки по рекламе, черновики постов, сегментация в Excel и недельные циклы A/B-тестов съедают бюджет времени раньше, чем появляется измеримый результат. <strong>AI для маркетинга</strong> — не подписка на чат-бот, а связка модулей поверх вашего стека: CRM, рекламные кабинеты, аналитика, email и CDP. Nero Network собирает такой контур под ключ: от AI-карты маркетинга до обучения команды.</p>
          <p><strong>Коротко:</strong> искусственный интеллект для маркетинга автоматизирует контент, аналитику, сегментацию, рекламу и персонализацию. По данным исследований 2026 года, 45% маркетинговых команд уже используют минимум один AI-агент (было 15% в 2024 году). Медианный ROI AI-маркетинга — 3,2×. Российский рынок корпоративных ИИ-помощников оценивается в ~30 млрд ₽ к концу 2026 года.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые показатели">
          <div class="vna-kpi-card"><div class="kv">45%</div><div class="kl">команд с AI-агентами</div><div class="ks">Digital Applied, 2026</div></div>
          <div class="vna-kpi-card"><div class="kv">3,2×</div><div class="kl">медианный ROI AI-маркетинга</div><div class="ks">Presenc AI, 2026</div></div>
          <div class="vna-kpi-card"><div class="kv">−70%</div><div class="kl">время на контент (кейс)</div><div class="ks">СберМаркетинг</div></div>
          <div class="vna-kpi-card"><div class="kv">30 млрд ₽</div><div class="kl">рынок корп. ИИ к 2026</div><div class="ks">оценка MWS AI</div></div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-related" aria-label="Смежные материалы: CRM и коммуникации">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Экосистема внедрений</span>
        <h2>AI рядом с маркетингом: CRM и коммуникации</h2>
        <p>Маркетинговый контур часто стыкуется с продажами и входящими обращениями — эти материалы дополняют картину внедрения.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <a class="vna-card vna-related-card" href="<?php echo esc_url( get_site_url( null, '/vnedrenie-ai-amocrm/' ) ); ?>">
          <h3>AI-агент для amoCRM под ключ</h3>
          <p>Сделки, сегменты и рекомендации в CRM — связка с маркетинговыми воронками и персонализацией офферов.</p>
        </a>
        <a class="vna-card vna-related-card" href="<?php echo esc_url( get_site_url( null, '/vnedrenie-ai-obrabotka-email-crm/' ) ); ?>">
          <h3>Автоматизация входящей почты в CRM</h3>
          <p>AI-разбор писем и маршрутизация в CRM ускоряет ответы и подпитывает email-канал данными о клиентах.</p>
        </a>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#zadachi">Задачи AI</a>
        <a href="#etapy">Внедрение</a>
        <a href="#pod-klyuch">Под ключ</a>
        <a href="#neyroseti">Нейросети</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#msb">МСБ</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- H2 #1 -->
  <section class="vna-section" id="zadachi">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Модули</span>
        <h2>Что такое AI для маркетинга и какие задачи он закрывает</h2>
        <p><strong>Определение.</strong> AI для маркетинга — программный слой из LLM, ML-моделей и AI-агентов для повторяемых операций: контент, отчёты, сегментация, реклама, персонализация. Стратегия и финальное утверждение — за людьми.</p>
      </div>

      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Модуль</th><th>Что автоматизирует</th><th>Типичный стек</th></tr></thead>
          <tbody>
            <tr><td>Контент</td><td>ТЗ, черновики, адаптация под каналы, брифы дизайнерам</td><td>LLM + brand book + CMS</td></tr>
            <tr><td>Аналитика</td><td>Отчёты, сводки по кампаниям, ad-hoc вопросы</td><td>BI + рекламные API + Telegram</td></tr>
            <tr><td>Сегментация</td><td>RFM, look-alike, скоринг, когорты</td><td>CDP/CRM + ML</td></tr>
            <tr><td>Реклама</td><td>Нейрообъявления, автозапуск, оптимизация ставок</td><td>Яндекс Директ, VK Реклама</td></tr>
            <tr><td>Персонализация</td><td>Офферы, SMS/email, рекомендации на сайте</td><td>CDP + LLM + email/SMS</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vna-grid-3" style="margin-top:32px">
        <div class="vna-card nero-ai-reveal">
          <h3>Контент, креативы и контент-пайплайны</h3>
          <p><strong>Ai контент маркетинг</strong> закрывает конвейер: фактура → черновик → ТЗ дизайнеру → адаптация под Telegram, VK, Дзен. Кейс СберМаркетинга: цикл поста <strong>−70%</strong>, объём публикаций <strong>×2</strong>, стоимость поста <strong>−52%</strong> без просадки вовлечённости.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1">
          <h3>Аналитика кампаний и маркетинговые отчёты</h3>
          <p><strong>Ai аналитика маркетинга</strong>: кейс Epsilon Metrics — no-code агент за 7 дней, <strong>90%</strong> запросов в Telegram, отчёт <strong>4 ч → 2 мин</strong>, экономия <strong>7,2 млн ₽/год</strong>. Агент работает только по verified data sources.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-2">
          <h3>Сегментация, персонализация и рекламные гипотезы</h3>
          <p>Альфа-Банк: LLM-аргументы — <strong>+16% конверсия</strong>. «Лента»: цифровой клон покупателя — <strong>до +30% отклика</strong>. Яндекс Директ: ИИ-помощник <strong>+30%</strong> конверсий, нейрообъявления <strong>+17%</strong>.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #2 -->
  <section class="vna-section vna-section-alt" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Этапы</span>
        <h2>Внедрение AI для маркетинга: этапы и сценарии</h2>
        <p><strong>Внедрение ai для маркетинга</strong> — проект 6–8 недель. Nero Network строит путь от аудита до передачи на поддержку.</p>
      </div>

      <div class="vna-timeline nero-ai-reveal">
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Аудит процессов и AI-карта маркетинга</h3>
          <p>Диагностика пяти модулей. Результат — <strong>AI-карта маркетинга</strong> (лид-магнит): приоритеты, оценка ROI, roadmap. Для МСБ — пофункциональная карта агентов, а не один чат-бот.</p>
        </div>
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Пилот, метрики и масштабирование</h3>
          <p><strong>Roi ai маркетинг</strong> считают по модулям. Пилот: контент-конвейер + аналитический агент — <strong>−50–70%</strong> время на отчёты и черновики. Gartner: к концу 2026 — <strong>40%</strong> корпоративных приложений со спец. AI-агентами.</p>
        </div>
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Интеграция с CRM, CDP и рекламными кабинетами</h3>
          <p>Контур: сбор данных (amoCRM/Bitrix24, Метрика, Директ/VK) → сегментация → контент → реклама → аналитика в Telegram → feedback loop. <strong>Ai для маркетинга с CRM</strong>: Битрикс24 — >200 тыс. предложений в Q1 2026. Тренд: agentic CDP (Databricks CustomerLake).</p>
        </div>
      </div>

      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px">
        <table class="vna-table">
          <thead><tr><th>Неделя</th><th>Этап</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>1</td><td>Аудит: контент, отчёты, CRM, реклама, email</td><td>AI-карта маркетинга</td></tr>
            <tr><td>2</td><td>Приоритизация 2–3 сценариев с быстрым ROI</td><td>Roadmap + KPI</td></tr>
            <tr><td>3–4</td><td>Пилот: контент + аналитический агент</td><td>−50–70% время на отчёты/черновики</td></tr>
            <tr><td>5–6</td><td>Сегментация + персонализация</td><td>1–2 автоворонки</td></tr>
            <tr><td>7–8</td><td>Обучение, регламенты, QA-гейты</td><td>Передача «под ключ»</td></tr>
          </tbody>
        </table>
      </div>

      
<aside class="ym-cta-block ym-cta-block--primary" id="cta-aikarta">
  <div class="ym-cta-block__icon" aria-hidden="true">🗺️</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получите AI-карту маркетинга</p>
    <p class="ym-cta-block__sub">Аудит пяти модулей — контент, аналитика, сегментация, реклама, персонализация. Приоритеты, roadmap и оценка ROI за 3–5 рабочих дней. Лид-магнит Nero Network — бесплатно, без обязательств.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Ускорить маркетинг</a>
  </div>
</aside>

    </div>
  </section>

  
<!-- БОРИС: визуальный блок после #etapy -->
<section id="vnedrenie-ai-dlya-marketinga-boris-block" class="bmk-root" aria-label="Анимация: поток данных через пять модулей AI-маркетинга">
<style>
/* === БОРИС: prefix bmk-, scoped внутри #vnedrenie-ai-dlya-marketinga-boris-block === */
#vnedrenie-ai-dlya-marketinga-boris-block.bmk-root{
  padding:56px 0 64px;
  background:#f1f5f9;
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-card{
  display:grid;
  grid-template-columns:minmax(0,44%) minmax(0,56%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.09),0 0 0 1px rgba(148,163,184,.2);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-ai-dlya-marketinga-boris-block .bmk-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-dlya-marketinga-boris-block .bmk-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#7c3aed;margin:0 0 14px;
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-ey::before{
  content:'';width:18px;height:2px;background:#7c3aed;border-radius:1px;
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;
  line-height:1.28;margin:0 0 18px;
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-ul{
  list-style:none;margin:0 0 22px;padding:0;
  display:flex;flex-direction:column;gap:9px;
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-ul li{
  display:flex;align-items:flex-start;gap:10px;
  font-size:14px;line-height:1.5;color:#334155;
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(124,58,237,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#6d28d9;margin-top:1px;font-style:normal;
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-pills{
  display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-pl-v{background:rgba(124,58,237,.08);color:#6d28d9;border:1.5px solid rgba(124,58,237,.22);}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-pl-c{background:rgba(6,182,212,.08);color:#0e7490;border:1.5px solid rgba(6,182,212,.22);}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-foot{
  font-size:13px;color:#64748b;font-style:italic;margin:0;
}
#vnedrenie-ai-dlya-marketinga-boris-block .bmk-rgt{
  position:relative;
  background:linear-gradient(145deg,#faf5ff 0%,#f0f9ff 50%,#f8fafc 100%);
  min-height:420px;overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-dlya-marketinga-boris-block .bmk-rgt{min-height:360px;}
}
#bmk-marketing-pipeline-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>
<div class="bmk-cnt">
  <div class="bmk-card">
    <div class="bmk-lft">
      <span class="bmk-ey">Поток данных · 5 модулей</span>
      <h3 class="bmk-h3">CRM, реклама и аналитика сходятся в AI-хаб — агенты раздают задачи по каналам</h3>
      <ul class="bmk-ul">
        <li><span class="bmk-ic">◎</span>Источники: amoCRM, Директ, Метрика, email — единый слой данных</li>
        <li><span class="bmk-ic">⚡</span>AI-хаб маршрутизирует: контент, отчёты, сегменты, креативы, офферы</li>
        <li><span class="bmk-ic">↻</span>Feedback loop: метрики кампаний дообучают промпты и сегменты</li>
        <li><span class="bmk-ic">✓</span>Human review на выходе — стратегия и compliance остаются за людьми</li>
      </ul>
      <div class="bmk-pills">
        <span class="bmk-pl bmk-pl-g">5 модулей</span>
        <span class="bmk-pl bmk-pl-v">agentic CDP</span>
        <span class="bmk-pl bmk-pl-c">4 ч → 2 мин отчёт</span>
      </div>
      <p class="bmk-foot">Дальше — состав услуги «под ключ» и пакеты внедрения →</p>
    </div>
    <div class="bmk-rgt">
      <canvas id="bmk-marketing-pipeline-canvas" role="img" aria-label="Анимация: данные из CRM и рекламных кабинетов проходят через AI-хаб маркетинга к пяти модулям автоматизации"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bmk-marketing-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, fr = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    hub:'#7c3aed', hubGlow:'rgba(124,58,237,.2)',
    src:'#0ea5e9', mod:'#22c55e', out:'#f59e0b',
    line:'rgba(124,58,237,.35)', pkt:'#8b5cf6',
    text:'#1e293b', muted:'#64748b', card:'#ffffff', bdr:'#e2e8f0'
  };

  var sources = [
    {label:'CRM', x:0.12, y:0.22, col:C.src},
    {label:'Директ', x:0.12, y:0.42, col:C.src},
    {label:'Метрика', x:0.12, y:0.62, col:C.src},
    {label:'Email', x:0.12, y:0.82, col:C.src}
  ];
  var modules = [
    {label:'Контент', x:0.78, y:0.18, col:'#10b981'},
    {label:'Аналитика', x:0.78, y:0.36, col:'#3b82f6'},
    {label:'Сегменты', x:0.78, y:0.54, col:'#8b5cf6'},
    {label:'Реклама', x:0.78, y:0.72, col:'#f59e0b'},
    {label:'Персонал.', x:0.78, y:0.90, col:'#ec4899'}
  ];

  var packets = [];
  for (var i = 0; i < 14; i++) {
    packets.push({
      src: i % 4,
      mod: i % 5,
      t: (i * 37) % 360,
      spd: 0.8 + (i % 5) * 0.15
    });
  }

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else { ctx.moveTo(x+r,y); ctx.arcTo(x+w,y,x+w,y+h,r); ctx.arcTo(x+w,y+h,x,y+h,r); ctx.arcTo(x,y+h,x,y,r); ctx.arcTo(x,y,x+w,y,r); ctx.closePath(); }
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1.5; ctx.stroke(); }
  }

  function drawNode(nx, ny, label, col, w, h){
    var x = nx * W - w/2, y = ny * H - h/2;
    rr(x, y, w, h, 10, C.card, col, 2);
    ctx.fillStyle = col;
    ctx.font = 'bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(label, nx * W, ny * H + 4);
  }

  function drawHub(){
    var hx = W * 0.46, hy = H * 0.52, r = 36 + Math.sin(fr * 0.04) * 4;
    ctx.beginPath();
    ctx.arc(hx, hy, r + 12, 0, Math.PI * 2);
    ctx.fillStyle = C.hubGlow;
    ctx.fill();
    ctx.beginPath();
    ctx.arc(hx, hy, r, 0, Math.PI * 2);
    ctx.fillStyle = C.hub;
    ctx.fill();
    ctx.strokeStyle = '#6d28d9';
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.fillStyle = '#fff';
    ctx.font = 'bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI', hx, hy - 4);
    ctx.font = '10px Inter,system-ui,sans-serif';
    ctx.fillText('хаб', hx, hy + 10);
    return {x: hx, y: hy};
  }

  function bez(p0, p1, p2, t){
    var u = 1 - t;
    return {
      x: u*u*p0.x + 2*u*t*p1.x + t*t*p2.x,
      y: u*u*p0.y + 2*u*t*p1.y + t*t*p2.y
    };
  }

  function loop(){
    fr++;
    ctx.clearRect(0, 0, W, H);

    sources.forEach(function(s){
      drawNode(s.x, s.y, s.label, s.col, 68, 30);
    });
    modules.forEach(function(m){
      drawNode(m.x, m.y, m.label, m.col, 76, 30);
    });

    var hub = drawHub();

    packets.forEach(function(p){
      p.t = (p.t + p.spd) % 360;
      var phase = p.t / 360;
      var sx = sources[p.src].x * W, sy = sources[p.src].y * H;
      var mx = modules[p.mod].x * W, my = modules[p.mod].y * H;
      var mid1 = {x: hub.x - 20, y: (sy + hub.y) / 2};
      var mid2 = {x: hub.x + 20, y: (my + hub.y) / 2};
      var pos;
      if (phase < 0.45) {
        pos = bez({x:sx,y:sy}, mid1, hub, phase / 0.45);
      } else {
        pos = bez(hub, mid2, {x:mx,y:my}, (phase - 0.45) / 0.55);
      }
      ctx.beginPath();
      ctx.arc(pos.x, pos.y, 5, 0, Math.PI * 2);
      ctx.fillStyle = modules[p.mod].col;
      ctx.fill();
    });

  ctx.fillStyle = C.muted;
  ctx.font = '10px Inter,system-ui,sans-serif';
  ctx.textAlign = 'center';
  ctx.fillText('данные → AI → каналы', W * 0.46, H - 14);

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>


  <!-- H2 #3 -->
  <section class="vna-section" id="pod-klyuch">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Услуга</span>
        <h2>AI для маркетинга под ключ: состав услуги</h2>
        <p><strong>Ai для маркетинга под ключ</strong> — внедрённая система с интеграциями, регламентами и обученной командой. Ориентир чека: <strong>150 тыс.–1 млн ₽</strong>.</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3>AI-агенты и автоматизация рутины</h3>
          <p><strong>Ai агенты для маркетинга</strong> — специализированные помощники с доступом к данным. 45% команд используют ≥1 AI-агента (Digital Applied, 2026). Модули: контент-ассистент, аналитический агент, сегментатор, персонализатор, рекламный ассистент, QA/compliance-фильтр.</p>
        </div>
        <div class="vna-card">
          <h3>Настройка контент- и аналитических сценариев</h3>
          <p><strong>Настройка ai для маркетинга</strong>: промпты под brand book, шаблоны отчётов, триггеры сегментации, связки CRM → email → реклама. Стек: YandexGPT/GigaChat, Make.com, n8n.</p>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:20px">
        <h3>Обучение команды и передача на поддержку</h3>
        <p>Передача под ключ: регламенты human review, политика данных (152-ФЗ), библиотека разрешённых формулировок, лимиты автопубликации. Гибридная модель: «команды состоят не только из людей, но и из AI-агентов» — Владислав Крейнин, Сбер.</p>
      </div>

      
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите разобраться в AI-маркетинге до старта проекта?</p>
    <p class="ym-cta-block__sub">Если команда хочет понимать промпты, интеграции с CRM и human-in-the-loop до пилота — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование сценариев с руководством и маркетингом.</p>
  </div>
</aside>

    </div>
  </section>

  <!-- H2 #4 -->
  <section class="vna-section vna-section-alt" id="neyroseti">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Риски</span>
        <h2>Нейросети в маркетинге: возможности и ограничения</h2>
        <p><strong>Нейросети маркетинг</strong> — мощный инструмент с чёткими границами. Честный разбор рисков отстраивает от обещаний «AI всё сделает сам».</p>
      </div>
      <div class="vna-grid-3">
        <div class="vna-card nero-ai-reveal">
          <h3>Качество AI-контента и бренд-голос</h3>
          <p>Митигация: brand book, human review, A/B. СберМаркетинг: −52% стоимости поста <strong>без просадки вовлечённости</strong> при едином tone of voice.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1">
          <h3>Риски галлюцинаций в аналитике и compliance</h3>
          <p>Агент отвечает только по verified data sources. Compliance: ФЗ-38, ФАС, legal review gate. Персональные данные: 152-ФЗ, российские модели, политика промптов.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-2">
          <h3>Когда нейросети не заменяют стратегию</h3>
          <p>AI не заменяет стратегию, креатив высокого риска, B2B-переговоры, юридическую проверку. «Главным критерием становится измеримый эффект» — Грачья Алексанян, WIN Solutions.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #5 -->
  <section class="vna-section" id="ceny">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">ROI</span>
        <h2>Сколько стоит AI для маркетинга и как считать окупаемость</h2>
        <p><strong>Ai для маркетинга цена</strong> зависит от модулей, интеграций и глубины. Пакеты: «пилот 1 модуль» / «3 модуля» / «полный контур».</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Метрика</th><th>Ориентиры</th><th>Где применять</th></tr></thead>
          <tbody>
            <tr><td>Время на контент/отчёт</td><td>−70% (СберМаркетинг); 4 ч → 2 мин (Epsilon)</td><td>Контент, аналитика</td></tr>
            <tr><td>Конверсия персонализации</td><td>+16% (Альфа-Банк); +30% (Лента)</td><td>Email, SMS, CRM</td></tr>
            <tr><td>Конверсия рекламы</td><td>+30% (Директ); +17% (нейрообъявления)</td><td>Performance</td></tr>
            <tr><td>ROI платформы</td><td>139% / 1 мес. (Garlyn+Mindbox)</td><td>E-commerce CDP</td></tr>
            <tr><td>Median AI marketing ROI</td><td>3,2× (Presenc AI, 2026)</td><td>Бенчмарк C-level</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px"><strong>Сколько стоит ai для маркетинга</strong> для МСБ: пилот одного модуля — от 150 тыс. ₽; полный контур — до 1 млн ₽. Окупаемость: <strong>1–3 месяца</strong> (Garlyn — 1 мес., Epsilon — 3 мес.).</p>
    </div>
  </section>

  <!-- H2 #6 -->
  <section class="vna-section vna-section-alt" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Доказательная база</span>
        <h2>Кейсы и примеры внедрения AI для маркетинга</h2>
        <p><strong>Ai для маркетинга кейсы</strong> — то, чего не хватает большинству конкурентов в выдаче.</p>
      </div>
      <div class="vna-case-grid">
        <div class="vna-case-card nero-ai-reveal">
          <div class="vna-case-tag">E-commerce</div>
          <h3>Garlyn + Mindbox</h3>
          <p>ROI <strong>139%</strong>, окупаемость <strong>1 месяц</strong>, email-выручка <strong>+82% г/г</strong>.</p>
          <div class="vna-metric"><span class="num">×10</span><span class="lbl">выручка рассылки (PizzaMan + Mindbox AI)</span></div>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vna-case-tag">Контент</div>
          <h3>СберМаркетинг</h3>
          <p>Цикл поста <strong>−70%</strong>, объём <strong>×2</strong>, стоимость поста <strong>−52%</strong>.</p>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vna-case-tag">Аналитика</div>
          <h3>Epsilon Metrics</h3>
          <p>Агент за 7 дней без программистов. Экономия <strong>7,2 млн ₽/год</strong>.</p>
        </div>
        <div class="vna-case-card nero-ai-reveal">
          <div class="vna-case-tag">Персонализация</div>
          <h3>Альфа-Банк</h3>
          <p>LLM-аргументы в телемаркетинге — <strong>+16% конверсия</strong>.</p>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vna-case-tag">Реклама</div>
          <h3>Яндекс Директ</h3>
          <p>ИИ-помощник <strong>+30%</strong> конверсий на 50 тыс. бизнесов.</p>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vna-case-tag">Enterprise</div>
          <h3>Детский мир + Т1</h3>
          <p>&gt;100 промокампаний/сутки для 25 млн клиентов.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-related" aria-label="Смежные материалы: корпоративное внедрение AI">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Смежные материалы</span>
        <h2>Внедрение AI в смежных процессах бизнеса</h2>
        <p>Для полной картины ROI полезно смотреть корпоративные и операционные сценарии рядом с маркетингом.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <a class="vna-card vna-related-card" href="<?php echo esc_url( get_site_url( null, '/kpmg-claude-vnedrenie-ai-276-tysyach/' ) ); ?>">
          <h3>Уроки масштабного внедрения AI в корпорации</h3>
          <p>Кейс KPMG и Claude для 276&nbsp;000 сотрудников — как масштабировать AI-агентов и не потерять контроль качества.</p>
        </a>
        <a class="vna-card vna-related-card" href="<?php echo esc_url( get_site_url( null, '/ai-1c-erp/' ) ); ?>">
          <h3>AI-агент для 1С и ERP</h3>
          <p>Автоматизация учёта и операционных процессов дополняет маркетинговую аналитику единым контуром данных.</p>
        </a>
      </div>
    </div>
  </section>

  <!-- H2 #7 -->
  <section class="vna-section" id="msb">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">МСБ</span>
        <h2>AI для маркетинга для малого и среднего бизнеса</h2>
        <p><strong>Ai для маркетинга для малого бизнеса</strong> и среднего — основная ЦА Nero Network.</p>
      </div>
      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card">
          <h3>Под ключ или самостоятельно</h3>
          <p>Самостоятельно — для 1–2 задач. Для связки CRM + реклама + аналитика нужна <strong>разработка ai для маркетинга</strong> с интеграциями.</p>
        </div>
        <div class="vna-card">
          <h3>Внедрение без программиста</h3>
          <p>Make/n8n + коннекторы CRM и рекламы + LLM. Epsilon: 90% запросов — самообслуживание маркетологов.</p>
        </div>
        <div class="vna-card">
          <h3>Типовой стек для МСБ</h3>
          <p>amoCRM, Bitrix24, Директ, VK, Метрика, UniSender, Mindbox, Make, YandexGPT/GigaChat. AI-слой <strong>поверх</strong> стека.</p>
        </div>
      </div>
      <div class="vna-flow nero-ai-reveal" style="margin-top:28px" aria-label="Российский стек">
        <span>CRM</span><span class="arr">→</span>
        <span>Make/n8n</span><span class="arr">→</span>
        <span>LLM-агенты</span><span class="arr">→</span>
        <span>Директ/VK</span><span class="arr">→</span>
        <span>Метрика</span>
      </div>
    </div>
  </section>

  <!-- H2 #8 FAQ -->
  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">FAQ</span>
        <h2>FAQ: внедрение AI для маркетинга</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item">
          <div class="vna-faq-q">С чего начать и сколько занимает внедрение?</div>
          <div class="vna-faq-a"><p><strong>Как внедрить ai для маркетинга:</strong> начните с AI-карты — аудит 5 модулей и приоритизация 2–3 сценариев. Типовой срок: <strong>6–8 недель</strong>. Пилот одного модуля — от 2–3 недель.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q">Какие интеграции нужны в первую очередь?</div>
          <div class="vna-faq-a"><p>Минимум: CRM + Яндекс Метрика + Директ/VK. Следующий уровень: email/SMS, CDP (Mindbox). Нужны: brand book, история кампаний 3–6 мес., доступ к API.</p></div>
        </div>
        <div class="vna-faq-item">
          <div class="vna-faq-q">Как заказать аудит и внедрение?</div>
          <div class="vna-faq-a"><p>Nero Network предлагает <strong>AI-карту маркетинга</strong> и <strong>внедрение под ключ</strong>. CTA: <strong>Ускорить маркетинг</strong> — аудит, roadmap, пилот с измеримым ROI.</p></div>
        </div>
      </div>
    </div>
  </section>

  
<section class="vna-section" id="cta-final" aria-label="Призыв к действию" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
  <div class="vna-cnt" style="text-align:center">
    <span class="vna-eyebrow">Первый шаг</span>
    <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px">Ускорить маркетинг:<br>AI-карта и внедрение под ключ</h2>
    <p style="max-width:580px;margin:0 auto 28px;font-size:16px;color:var(--vna-muted)">Ориентир 150 тыс.–1 млн ₽ за внедрение. Nero Network проведёт аудит процессов, соберёт roadmap по 5 модулям и запустит пилот с измеримым ROI за 6–8 недель.</p>
    <ul class="vna-cta-checklist">
      <li>AI-карта маркетинга за 3–5 дней</li>
      <li>Пилот 1–3 модуля с KPI</li>
      <li>Интеграция CRM, Директ, Метрика</li>
      <li>Без обязательств на аудите</li>
    </ul>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px"<?php echo $primary_cta_attrs; ?>>Ускорить маркетинг</a>
  </div>
</section>


</div>

<?php
$vnam_schema_origin   = trailingslashit(get_site_url());
$vnam_schema_page_url = trailingslashit(get_permalink());
$vnam_schema_org_name = get_bloginfo('name') ?: 'Organization';
$vnam_schema_graph    = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        ['@type' => 'Organization', '@id' => $vnam_schema_origin . '#organization', 'name' => $vnam_schema_org_name, 'url' => $vnam_schema_origin],
        ['@type' => 'WebSite', '@id' => $vnam_schema_origin . '#website', 'url' => $vnam_schema_origin, 'name' => $vnam_schema_org_name, 'publisher' => ['@id' => $vnam_schema_origin . '#organization']],
        ['@type' => 'WebPage', '@id' => $vnam_schema_page_url . '#webpage', 'url' => $vnam_schema_page_url, 'name' => 'AI для маркетинга: внедрение под ключ', 'description' => $page_seo_description, 'isPartOf' => ['@id' => $vnam_schema_origin . '#website'], 'about' => ['@id' => $vnam_schema_origin . '#organization']],
        ['@type' => 'BreadcrumbList', '@id' => $vnam_schema_page_url . '#breadcrumb', 'itemListElement' => [['@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vnam_schema_origin], ['@type' => 'ListItem', 'position' => 2, 'name' => 'AI для маркетинга: внедрение под ключ', 'item' => $vnam_schema_page_url]]],
        ['@type' => 'Service', '@id' => $vnam_schema_page_url . '#service', 'name' => 'AI для маркетинга: внедрение под ключ', 'description' => $page_seo_description, 'url' => $vnam_schema_page_url, 'provider' => ['@id' => $vnam_schema_origin . '#organization']],
        ['@type' => 'FAQPage', '@id' => $vnam_schema_page_url . '#faq', 'mainEntity' => [
            ['@type' => 'Question', 'name' => 'С чего начать и сколько занимает внедрение?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Как внедрить ai для маркетинга: начните с AI-карты — аудит 5 модулей и приоритизация 2–3 сценариев. Типовой срок: 6–8 недель. Пилот одного модуля — от 2–3 недель.']],
            ['@type' => 'Question', 'name' => 'Какие интеграции нужны в первую очередь?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Минимум: CRM + Яндекс Метрика + Директ/VK. Следующий уровень: email/SMS, CDP (Mindbox). Нужны: brand book, история кампаний 3–6 мес., доступ к API.']],
            ['@type' => 'Question', 'name' => 'Как заказать аудит и внедрение?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Nero Network предлагает AI-карту маркетинга и внедрение под ключ. CTA: Ускорить маркетинг — аудит, roadmap, пилот с измеримым ROI.']],
        ]],
    ],
];
?>
<script type="application/ld+json">
<?php echo wp_json_encode($vnam_schema_graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
</script>

</main>

<script>
/**
 * vnam-marketing-ops-engine — Маркетинговая диспетчерская
 * Мир: ChannelPulseStreams → CampaignOrchestratorHub → LaunchPulse (ROI)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnam-marketing-ops-canvas");
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
    hubBase: "#1e293b",
    hubGlow: "rgba(121,242,255,0.35)",
    pulseLine: "rgba(139,92,246,0.45)",
    contentChip: "#fde68a",
    analyticsChip: "#a7f3d0",
    segmentChip: "#93c5fd",
    adChip: "#fbcfe8",
    persChip: "#ddd6fe",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    roiGreen: "#22c55e"
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

  /* Диагональные импульсы данных — вместо Conveyor */
  function ChannelPulseStreams() {
    this.phase = 0;
  }
  ChannelPulseStreams.prototype.draw = function (ctx) {
    this.phase = (frame * 0.028) % 1;
    var streams = [
      { y0: -70, y1: -10, color: C.contentChip, label: "CRM" },
      { y0: -30, y1: 20, color: C.analyticsChip, label: "Директ" },
      { y0: 10, y1: 55, color: C.segmentChip, label: "Метрика" }
    ];
    streams.forEach(function (s, idx) {
      ctx.strokeStyle = C.pulseLine;
      ctx.lineWidth = 1.5;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.6;
      ctx.beginPath();
      ctx.moveTo(-160, s.y0);
      ctx.bezierCurveTo(-60, s.y0 - 8, 40, s.y1 + 8, 120, s.y1);
      ctx.stroke();
      ctx.setLineDash([]);

      var t = (this.phase + idx * 0.28) % 1;
      var px = -160 + t * 280;
      var py = s.y0 + (s.y1 - s.y0) * t + Math.sin(t * Math.PI) * 12;
      drawRR(ctx, px - 8, py - 5, 16, 10, 2, s.color, C.outline);
    }, this);
  };

  /* Центральный хаб кампаний — вместо WebsiteTerminal */
  function CampaignOrchestratorHub() {
    this.launchRing = 0;
  }
  CampaignOrchestratorHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var modules = ["Контент", "Аналитика", "Сегмент", "Реклама", "Персонал"];

    /* Кольцо хаба */
    ctx.strokeStyle = C.hubGlow;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, 0, 52, 0, Math.PI * 2);
    ctx.stroke();
    drawRR(ctx, -38, -38, 76, 76, 38, C.hubBase, C.outline);

    /* Сектора модулей */
    modules.forEach(function (m, i) {
      var ang = (i / 5) * Math.PI * 2 - Math.PI / 2;
      var mx = Math.cos(ang) * 38;
      var my = Math.sin(ang) * 38;
      var lit = prg >= 70 + i * 18 && prg < 200;
      ctx.fillStyle = lit ? "rgba(121,242,255,0.55)" : "rgba(255,255,255,0.18)";
      ctx.beginPath();
      ctx.arc(mx, my, 5, 0, Math.PI * 2);
      ctx.fill();
      if (lit) {
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.fillStyle = "#e2e8f0";
        ctx.textAlign = "center";
        ctx.fillText(m, mx, my + 14);
      }
    });

    /* Фаза COLLECT: чипы входят */
    if (prg < 80) {
      var collectT = prg / 80;
      drawRR(ctx, -90 + collectT * 70, -55, 28, 16, 3, C.contentChip, C.outline);
      drawRR(ctx, -100 + collectT * 80, 5, 24, 14, 3, C.analyticsChip, C.outline);
    }

    /* Фаза ORCHESTRATE: donut + sparkline + ad strip */
    if (prg >= 80 && prg < 175) {
      var orch = (prg - 80) / 95;
      /* SegmentDonutRing */
      ctx.strokeStyle = C.segmentChip;
      ctx.lineWidth = 5;
      ctx.beginPath();
      ctx.arc(72, -35, 16, 0, Math.PI * 2 * Math.min(1, orch * 1.2));
      ctx.stroke();
      /* AnalyticsSparkline */
      ctx.strokeStyle = C.analyticsChip;
      ctx.lineWidth = 2;
      ctx.beginPath();
      for (var si = 0; si < 6; si++) {
        var sx = 68 + si * 8;
        var sy = 28 - Math.sin(si * 1.1 + frame * 0.06) * 8 * orch;
        if (si === 0) ctx.moveTo(sx, sy);
        else ctx.lineTo(sx, sy);
      }
      ctx.stroke();
      /* AdVariantStrip */
      [0, 1, 2].forEach(function (ai) {
        drawRR(ctx, -78 + ai * 22, 48, 18, 22, 3, C.adChip, C.outline);
      });
      /* ContentDraftChip */
      drawRR(ctx, -55, -72, 36, 20, 4, C.contentChip, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("VK пост", -37, -60);
    }

    /* Фаза ACTIVATE: LaunchPulse + ROI badge */
    if (prg >= 175) {
      var act = Math.min(1, (prg - 175) / 30);
      this.launchRing = act;
      ctx.strokeStyle = "rgba(34,197,94," + (0.75 - act * 0.5) + ")";
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.arc(0, 0, 55 + act * 45, 0, Math.PI * 2);
      ctx.stroke();

      if (prg > 195) {
        var badgeY = -95 - Math.min(18, (prg - 195) * 0.8);
        var alpha = prg < 235 ? 1 : 1 - (prg - 235) / 25;
        ctx.globalAlpha = Math.max(0, alpha);
        drawRR(ctx, -34, badgeY, 68, 24, 8, "rgba(34,197,94,0.22)", C.roiGreen);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 11px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("ROI 3,2×", 0, badgeY + 15);
        ctx.globalAlpha = 1;
      }
    }

    /* TelegramReportPing */
    if (prg >= 120 && prg < 200) {
      var ping = Math.sin(frame * 0.12) * 3;
      drawRR(ctx, 88 + ping, 42, 14, 14, 7, C.hubBase, C.outline);
      ctx.fillStyle = C.roiGreen;
      ctx.beginPath();
      ctx.arc(95 + ping, 49, 3, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  function Agent(x, y, color, role, phaseTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.phaseTrig = phaseTrig;
    this.dialogs = dialogs;
    this.spokeAngle = phaseTrig * 0.05;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var prg = (frame * 0.042) % 260;
    var isMoving = false;
    var carryType = null;
    var faceDir = 1;

    var hubX = Math.cos(this.spokeAngle) * 70;
    var hubY = Math.sin(this.spokeAngle) * 50;

    if (prg >= this.phaseTrig && prg < this.phaseTrig + 28) {
      var local = prg - this.phaseTrig;
      if (local < 12) {
        isMoving = true;
        faceDir = hubX > this.baseX ? 1 : -1;
        carryType = this.color;
        var t = local / 12;
        this.x = this.baseX + (hubX - this.baseX) * t;
        this.y = this.baseY + (hubY - this.baseY) * t;
      } else if (local < 18) {
        this.x = hubX; this.y = hubY;
      } else {
        isMoving = true;
        faceDir = -faceDir;
        var t2 = (local - 18) / 10;
        this.x = hubX + (this.baseX - hubX) * t2;
        this.y = hubY + (this.baseY - hubY) * t2;
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
      carryType = prg >= this.phaseTrig - 12 ? this.color : null;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 18, rnd, 240);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.5);
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.lineJoin = "round";

    var legL = isMoving ? Math.sin(this.timer * 6) * 5 : 0;
    var legR = isMoving ? Math.sin(this.timer * 6 + Math.PI) * 5 : 0;
    drawRR(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
    drawRR(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
    drawRR(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
    drawRR(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);
    drawRR(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);

    var hx = 0, hy = -28 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(hx, hy, 12, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 2;
    ctx.strokeStyle = C.outline;
    ctx.stroke();

    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(hx + 5, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    ctx.restore();

    if (carryType) {
      drawRR(ctx, -18 * faceDir, -18 - bob, 14, 14, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var pulses = new ChannelPulseStreams();
  var hub = new CampaignOrchestratorHub();
  entities.push(pulses);
  entities.push(hub);
  entities.push(new Agent(-115, -45, C.agentYellow, "1_architect", 85, ["Черновик поста готов", "Brand book ок", "ТЗ дизайнеру"]));
  entities.push(new Agent(-125, 35, C.agentGreen, "2_analytics", 105, ["CPL −18% за неделю", "Отчёт: 2 мин", "Директ API sync"]));
  entities.push(new Agent(-55, 75, C.agentBlue, "3_segment", 125, ["RFM: 1 240 спящих", "Look-alike готов", "Когорта VIP"]));
  entities.push(new Agent(55, 70, C.agentPink, "4_ads", 145, ["Нейрообъявление №7", "+17% конверсия", "A/B гипотеза"]));
  entities.push(new Agent(110, -20, C.agentPurple, "5_personalize", 165, ["SMS под профиль", "Жду human review", "Оффер адаптирован"]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 260, maxLife: customLife || 260 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.042) % 260;
    if (prg >= 20 && prg < 20.05) createBubble(-100, -30, "1. Сбор CRM+Директ");
    if (prg >= 90 && prg < 90.05) createBubble(0, -60, "2. AI-карта модулей");
    if (prg >= 130 && prg < 130.05) createBubble(-40, 20, "3. Контент-конвейер");
    if (prg >= 155 && prg < 155.05) createBubble(50, -10, "4. Сегмент готов");
    if (prg >= 185 && prg < 185.05) createBubble(0, -80, "5. Кампания в эфире!");

    ctx.font = "bold 10px Inter, sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 12) alpha = (bub.maxLife - bub.life) / 12;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var bx = bub.x;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 6, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2 + 1);
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
  document.querySelectorAll('.vna-faq-q').forEach(function(btn){
    btn.setAttribute('role','button');
    btn.setAttribute('tabindex','0');
    btn.setAttribute('aria-expanded','false');
    btn.addEventListener('click', function(){
      var item = btn.closest('.vna-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.vna-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.vna-faq-q');
        if (q) q.setAttribute('aria-expanded','false');
      });
      if (!isOpen) {
        item.classList.add('open');
        btn.setAttribute('aria-expanded','true');
      }
    });
    btn.addEventListener('keydown', function(e){
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.vnedrenie-ai-dlya-marketinga-page');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if (entry.isIntersecting) {
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

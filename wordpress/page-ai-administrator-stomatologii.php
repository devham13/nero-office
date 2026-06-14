<?php
/**
 * Template Name: AI-администратор для стоматологии: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-администратора для стоматологии. Запись, звонки, МИС, ROI. Сценарий бесплатно.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-администратор для стоматологии: внедрение под ключ';
$page_seo_description = 'Внедрение AI-администратора для стоматологии под ключ: ответы на вопросы, запись пациентов, звонки, напоминания и интеграция с CRM. Получите сценарий внедрения.';

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
    ['label' => 'Что это',      'href' => '#chto-eto'],
    ['label' => 'Зачем сейчас', 'href' => '#pochemu-seychas'],
    ['label' => 'Сценарии',     'href' => '#scenarii'],
    ['label' => 'Интеграции',   'href' => '#integraciya'],
    ['label' => 'Этапы',        'href' => '#etapy'],
    ['label' => 'Стоимость',    'href' => '#cena-roi'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = 'Получить сценарий';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#chto-eto';

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

/* Secondary CTA + links */
.ym-cta-block--primary{
  display:flex;align-items:flex-start;gap:20px;text-align:left;
}
.ym-cta-block--primary .ym-cta-block__icon{flex-shrink:0;margin:0;font-size:40px;}
.ym-cta-block--secondary{
  background:rgba(255,255,255,.04);
  border-color:rgba(255,255,255,.12);
  text-align:left;
}
.ym-link{color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px;}
.ym-link--accent{font-weight:700;}
.ym-link:hover{color:#fff;}
@media(max-width:600px){
  .ym-cta-block--primary{flex-direction:column;text-align:center;}
}
/* Kadence reset — как на page-vnedrenie-ai-amocrm.php */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section { display: none !important; }
#primary,.site-main,.site-content,#content,.content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}

/* Hero стоматология — самодостаточный блок */
.naas-hero-stomatologii {
  --naas-cyan: #79f2ff;
  --naas-mint: #6ee7b7;
  --naas-violet: #a78bfa;
  --naas-text: #e6edf7;
  --naas-muted: #9aa8bd;
  --naas-soft: #c7d2e5;
  --naas-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.naas-hero-stomatologii.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.naas-hero-stomatologii::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 70%);
  opacity: .5;
  pointer-events: none;
  z-index: -2;
}
.naas-hero-stomatologii::after {
  content: "";
  position: absolute;
  right: -8%;
  top: 8%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(110, 231, 183, .14), transparent 68%);
  filter: blur(8px);
  animation: naasHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes naasHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .85; transform: scale(1.05); }
}
.naas-hero-stomatologii .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.naas-hero-stomatologii .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.naas-hero-stomatologii .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: 1.02;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.naas-hero-stomatologii .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--naas-cyan) 40%, var(--naas-mint) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.naas-hero-stomatologii .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(110, 231, 183, 0.22);
  border-radius: 999px;
  background: rgba(110, 231, 183, 0.08);
  color: var(--naas-mint) !important;
  font-size: 12px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.naas-hero-stomatologii .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 700px;
  color: var(--naas-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.naas-hero-stomatologii .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.naas-hero-stomatologii .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 12px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.naas-hero-stomatologii .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 32px;
}
.naas-hero-stomatologii .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 22px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  text-decoration: none !important;
  transition: transform .22s ease, box-shadow .22s ease;
}
.naas-hero-stomatologii .nero-ai-btn:hover { transform: translateY(-2px); }
.naas-hero-stomatologii .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--naas-cyan), var(--naas-mint));
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.naas-hero-stomatologii .nero-ai-btn-secondary {
  color: var(--naas-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.naas-hero-stomatologii .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--naas-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.naas-hero-stomatologii .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.naas-hero-stomatologii .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.naas-hero-stomatologii .nero-ai-dots { display: flex; gap: 7px; }
.naas-hero-stomatologii .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.naas-hero-stomatologii .nero-ai-dot:nth-child(1) { background: #fb7185; }
.naas-hero-stomatologii .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.naas-hero-stomatologii .nero-ai-dot:nth-child(3) { background: #34d399; }
.naas-hero-stomatologii .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.naas-hero-stomatologii .nero-ai-window-body { padding: 16px; }
.naas-hero-stomatologii .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.naas-hero-stomatologii .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 15px;
  font-weight: 800;
  color: #fff;
}
.naas-hero-stomatologii .nero-ai-live-pill {
  padding: 4px 10px;
  border-radius: 999px;
  background: rgba(34, 197, 94, .15);
  border: 1px solid rgba(34, 197, 94, .35);
  color: #86efac;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: .06em;
  text-transform: uppercase;
}
.naas-hero-stomatologii .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.naas-hero-stomatologii .nero-ai-metric {
  padding: 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.08);
}
.naas-hero-stomatologii .nero-ai-metric span {
  display: block;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: .06em;
  text-transform: uppercase;
  color: #94a3b8;
  margin-bottom: 4px;
}
.naas-hero-stomatologii .nero-ai-metric strong {
  display: block;
  font-size: 22px;
  font-weight: 900;
  color: #fff;
  letter-spacing: -.04em;
  line-height: 1;
}
.naas-hero-stomatologii .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  font-size: 11px;
  color: #64748b;
}
.naas-hero-stomatologii .naas-dash-canvas-wrap {
  position: relative;
  height: 168px;
  margin: 10px 0 12px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, .12);
  background: radial-gradient(circle at 50% 40%, rgba(121,242,255,.08), rgba(2,6,23,.6));
}
#naas-reception-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.naas-hero-stomatologii .nero-ai-task-stream { display: grid; gap: 8px; }
.naas-hero-stomatologii .nero-ai-task {
  display: grid;
  grid-template-columns: 36px 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 12px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.07);
  font-size: 12px;
}
.naas-hero-stomatologii .nero-ai-task-icon {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(121, 242, 255, .12);
  border: 1px solid rgba(121, 242, 255, .22);
  font-size: 11px;
  font-weight: 800;
  color: var(--naas-cyan);
}
.naas-hero-stomatologii .nero-ai-task strong {
  display: block;
  color: #e2e8f0;
  font-size: 12px;
  margin-bottom: 2px;
}
.naas-hero-stomatologii .nero-ai-task span {
  color: #94a3b8;
  font-size: 11px;
}
.naas-hero-stomatologii .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .04em;
  color: #86efac;
  background: rgba(34, 197, 94, .12);
  border: 1px solid rgba(34, 197, 94, .28);
  white-space: nowrap;
}
.naas-hero-stomatologii .nero-ai-status--amber {
  color: #fcd34d;
  background: rgba(245, 158, 11, .12);
  border-color: rgba(245, 158, 11, .28);
}
@media (max-width: 960px) {
  .naas-hero-stomatologii .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .naas-hero-stomatologii .nero-ai-dashboard { transform: none; }
}
@media (max-width: 600px) {
  .naas-hero-stomatologii .nero-ai-metrics-grid { grid-template-columns: 1fr; }
  .naas-hero-stomatologii .nero-ai-task { grid-template-columns: 32px 1fr; }
  .naas-hero-stomatologii .nero-ai-status { grid-column: 2; justify-self: start; }
}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-admin-stomatologii-page" role="main" tabindex="-1">

<section class="nero-ai-hero naas-hero-stomatologii" id="hero" aria-labelledby="naas-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai для стоматологии</p>
      <h1 id="naas-hero-title">AI-администратор для стоматологии: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Отвечает на вопросы, записывает пациентов и возвращает не дошедших — пока администратор занят приёмом</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Запись 24/7</li>
        <li class="nero-ai-badge">AI-звонки</li>
        <li class="nero-ai-badge">Telegram/VK</li>
        <li class="nero-ai-badge">МИС</li>
        <li class="nero-ai-badge">Напоминания</li>
        <li class="nero-ai-badge">No-show</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#chto-eto">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-регистратура стоматологии">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">регистратура клиники · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-администратор · ночная смена</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Входящие сегодня</span>
              <strong>18</strong>
              <small>TG · звонки · сайт</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ответ</span>
              <strong>28 сек</strong>
              <small>первичный</small>
            </div>
            <div class="nero-ai-metric">
              <span>Записи</span>
              <strong>7</strong>
              <small>в МИС</small>
            </div>
            <div class="nero-ai-metric">
              <span>No-show</span>
              <strong>−12%*</strong>
              <small>напоминания</small>
            </div>
          </div>

          <div class="naas-dash-canvas-wrap" aria-hidden="false">
            <canvas id="naas-reception-canvas" role="img" aria-label="Анимация: обращения пациентов стекаются к AI-консоли МИС, слот бронируется и уходит напоминание"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий регистратуры">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>«Хочу на чистку в субботу»</strong><span>Интент: запись · канал Telegram</span></div>
              <span class="nero-ai-status">принято</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">МИС</span>
              <div><strong>Слот 11:30 забронирован</strong><span>YCLIENTS · кресло №2</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Подтверждение отправлено</strong><span>Пациенту в мессенджер</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Напоминание за 48 ч</strong><span>Цепочка против no-show</span></div>
              <span class="nero-ai-status nero-ai-status--amber">в очереди</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  var canvas = document.getElementById('naas-reception-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var dpr = Math.min(window.devicePixelRatio || 1, 2);
  var W = 0, H = 0, t = 0, phase = 0;

  function resize() {
    var rect = canvas.parentElement.getBoundingClientRect();
    W = rect.width; H = rect.height;
    canvas.width = W * dpr; canvas.height = H * dpr;
    canvas.style.width = W + 'px'; canvas.style.height = H + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function Agent(x, y, color, role) {
  this.x = x; this.y = y; this.tx = x; this.ty = y; this.color = color; this.role = role; this.bubble = 0;
  }
  Agent.prototype.step = function () {
    this.x += (this.tx - this.x) * 0.06;
    this.y += (this.ty - this.y) * 0.06;
    if (this.bubble > 0) this.bubble--;
  };
  Agent.prototype.draw = function () {
    ctx.fillStyle = this.color;
    ctx.beginPath(); ctx.arc(this.x, this.y, 5, 0, Math.PI * 2); ctx.fill();
    if (this.bubble > 0) {
      ctx.fillStyle = 'rgba(255,255,255,.9)';
      ctx.font = '9px Inter, sans-serif';
      var lines = this.bubbleText || [];
      var bw = 72, bh = 14 + lines.length * 11;
      ctx.fillRect(this.x - bw/2, this.y - 34 - bh, bw, bh);
      ctx.fillStyle = '#0f172a';
      lines.forEach(function (ln, i) { ctx.fillText(ln, this.x - bw/2 + 6, this.y - 28 - bh + 12 + i * 11); }.bind(this));
    }
  };

  function DentalMISConsole(cx, cy) {
    this.cx = cx; this.cy = cy; this.pulse = 0; this.slots = [1, 0, 1];
  }
  DentalMISConsole.prototype.draw = function () {
    var g = ctx.createLinearGradient(this.cx - 70, this.cy - 40, this.cx + 70, this.cy + 40);
    g.addColorStop(0, 'rgba(121,242,255,.18)'); g.addColorStop(1, 'rgba(110,231,183,.12)');
    ctx.fillStyle = g;
    ctx.strokeStyle = 'rgba(121,242,255,.35)'; ctx.lineWidth = 1.2;
    roundRect(this.cx - 78, this.cy - 42, 156, 84, 12); ctx.fill(); ctx.stroke();
    ctx.fillStyle = '#e2e8f0'; ctx.font = 'bold 10px Inter,sans-serif';
    ctx.fillText('МИС · расписание', this.cx - 52, this.cy - 24);
    for (var i = 0; i < 3; i++) {
      ctx.fillStyle = this.slots[i] ? 'rgba(34,197,94,.55)' : 'rgba(148,163,184,.25)';
      roundRect(this.cx - 60 + i * 42, this.cy - 8, 34, 22, 6); ctx.fill();
    }
    if (this.pulse > 0) {
      ctx.strokeStyle = 'rgba(110,231,183,' + (this.pulse * 0.5) + ')';
      ctx.lineWidth = 2;
      ctx.beginPath(); ctx.arc(this.cx, this.cy, 50 + (1 - this.pulse) * 18, 0, Math.PI * 2); ctx.stroke();
      this.pulse -= 0.02;
    }
  };

  function PatientIntentStream() {
    this.items = [
      { a: 0, ch: 'TG', color: '#38bdf8' },
      { a: 2.1, ch: '☎', color: '#a78bfa' },
      { a: 4.2, ch: 'web', color: '#6ee7b7' }
    ];
  }
  PatientIntentStream.prototype.draw = function (cx, cy, tick) {
    this.items.forEach(function (it) {
      var ang = it.a + tick * 0.012;
      var r = 58 + Math.sin(tick * 0.03 + it.a) * 6;
      var x = cx + Math.cos(ang) * r - 55;
      var y = cy + Math.sin(ang) * 0.55 * r;
      ctx.fillStyle = it.color;
      ctx.beginPath(); ctx.arc(x, y, 4, 0, Math.PI * 2); ctx.fill();
      ctx.fillStyle = 'rgba(255,255,255,.75)'; ctx.font = '8px Inter,sans-serif';
      ctx.fillText(it.ch, x - 8, y - 8);
    });
  };

  function roundRect(x, y, w, h, r) {
    ctx.beginPath();
    ctx.moveTo(x + r, y);
    ctx.arcTo(x + w, y, x + w, y + h, r);
    ctx.arcTo(x + w, y + h, x, y + h, r);
    ctx.arcTo(x, y + h, x, y, r);
    ctx.arcTo(x, y, x + w, y, r);
    ctx.closePath();
  }

  var consoleObj, stream, agents, dialogs;

  function initScene() {
    var cx = W * 0.58, cy = H * 0.52;
    consoleObj = new DentalMISConsole(cx, cy);
    stream = new PatientIntentStream();
    agents = [
      new Agent(W * 0.12, H * 0.72, '#f97316', 1),
      new Agent(W * 0.22, H * 0.28, '#8b5cf6', 2),
      new Agent(W * 0.78, H * 0.24, '#06b6d4', 3),
      new Agent(W * 0.86, H * 0.68, '#22c55e', 4),
      new Agent(W * 0.48, H * 0.82, '#ec4899', 5)
    ];
    dialogs = [
      'Слот 11:30 свободен',
      'Пациент спрашивает цену чистки',
      'Синхронизация с YCLIENTS',
      'Отправляю подтверждение в TG',
      'Напоминание за 48 часов'
    ];
  }

  function setPhase(p) {
    phase = p;
    var cx = W * 0.58, cy = H * 0.52;
    if (p === 0) {
      agents[3].tx = W * 0.2; agents[3].ty = H * 0.45;
      agents[3].bubble = 90; agents[3].bubbleText = [dialogs[1]];
    }
    if (p === 1) {
      agents[2].tx = cx - 30; agents[2].ty = cy + 10;
      agents[2].bubble = 90; agents[2].bubbleText = [dialogs[2]];
      consoleObj.slots = [0, 1, 1];
    }
    if (p === 2) {
      agents[4].tx = cx + 20; agents[4].ty = cy - 5;
      agents[4].bubble = 90; agents[4].bubbleText = [dialogs[3]];
      consoleObj.pulse = 1;
    }
    if (p === 3) {
      agents[1].tx = W * 0.7; agents[1].ty = H * 0.5;
      agents[1].bubble = 90; agents[1].bubbleText = [dialogs[4]];
    }
  }

  function loop() {
    t++;
    ctx.clearRect(0, 0, W, H);
    ctx.fillStyle = 'rgba(2,6,23,.15)';
    ctx.fillRect(0, 0, W, H);
    if (!consoleObj) initScene();
    stream.draw(consoleObj.cx, consoleObj.cy, t);
    consoleObj.draw();
    agents.forEach(function (a) { a.step(); a.draw(); });
    if (t % 180 === 0) setPhase((phase + 1) % 4);
    requestAnimationFrame(loop);
  }

  resize();
  window.addEventListener('resize', function () { resize(); initScene(); });
  loop();
})();
</script>

<div class="vna-content ym-longread" id="ai-admin-stomatologii-article">

  <!-- INTRO: второй экран после hero -->
  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai для стоматологии</p>
          <p>Пациент сравнивает три клиники в 21:00, пишет в Telegram и ждёт ответа пять минут. Там, где ответили первыми — запись. Там, где молчат — ушёл к конкуренту. <strong>AI-администратор для стоматологии</strong> закрывает этот разрыв: отвечает за секунды, записывает в расписание, напоминает о визите и возвращает тех, кто не дошёл. Nero Network внедряет такие системы под ключ — с интеграцией в вашу МИС, а не «ботом ради бота».</p>
          <p><strong>Коротко:</strong> AI-администратор — цифровой слой регистратуры, который принимает звонки, чаты и заявки с сайта 24/7, ведёт диалог на естественном языке, создаёт записи в МИС/CRM и сопровождает пациента до приёма. Сложные медицинские вопросы передаёт живому администратору.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые метрики стоматологии">
          <div class="vna-kpi-card">
            <div class="kv">40–45%</div>
            <div class="kl">обращений вне рабочего времени</div>
            <div class="ks">vc.ru, аудит Москва 2026</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">23%</div>
            <div class="kl">конверсия звонка в запись</div>
            <div class="ks">Crimson Media Group</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">~300</div>
            <div class="kl">пропущенных звонков в месяц</div>
            <div class="ks">Resonate AI / rechka.ai</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#chto-eto">Что это</a>
        <a href="#pochemu-seychas">Зачем сейчас</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#integraciya">Интеграции</a>
        <a href="#etapy">Этапы</a>
        <a href="#cena-roi">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#poluchit-scenariy">Сценарий</a>
      </nav>
    </div>
  </div>

  <!-- H2 #1: chto-eto -->
  <section class="vna-section" id="chto-eto">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Определение</span>
        <h2>AI-администратор для стоматологии: что это и зачем клинике</h2>
        <p><strong>Определение.</strong> AI-администратор для стоматологии — это не кнопочный чат-бот с меню «1 — запись, 2 — цены». Это диалоговая система на базе больших языковых моделей (agentic AI), которая понимает запрос пациента в свободной форме, сверяется с базой знаний клиники, запрашивает свободные слоты в МИС в реальном времени и выполняет действия: запись, перенос, отмена, подтверждение, напоминание.</p>
      </div>
      <p class="nero-ai-reveal">По данным IBM (2026), контакт-центры смещаются от rule-based автоматизации к <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">урокам масштабного внедрения AI-агентов в бизнес</a> — agentic AI, способным вести многошаговые диалоги и интегрироваться с корпоративными системами. В стоматологии это особенно заметно: телефон остаётся главным каналом конверсии — <strong>68%</strong> обращений, по обзору Sixth City Marketing (цитируется в rechka.ai), приходят через звонок.</p>

      <div class="vna-card nero-ai-reveal" id="otlichie-ot-bota">
        <h3>Чем AI-администратор отличается от обычного администратора и чат-бота</h3>
        <div class="vna-table-wrap">
          <table class="vna-table" aria-label="Сравнение живого администратора, бота и AI-администратора">
            <thead>
              <tr>
                <th>Критерий</th>
                <th>Живой администратор</th>
                <th>Кнопочный бот</th>
                <th>AI-администратор</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Скорость ответа</td><td>Зависит от загрузки</td><td>Мгновенно, но шаблонно</td><td>Секунды, диалог «как с человеком»</td></tr>
              <tr><td>Параллельные обращения</td><td>1–2 одновременно</td><td>Десятки и сотни</td><td>Десятки и сотни</td></tr>
              <tr><td>Работа вне смены</td><td>Нет (или дорогая смена)</td><td>Да</td><td>Да — звонки и чаты 24/7</td></tr>
              <tr><td>Запись в МИС</td><td>Вручную</td><td>Часто без интеграции</td><td>Автоматически через API</td></tr>
              <tr><td>Сложные мед. вопросы</td><td>Да</td><td>Нет</td><td>Handoff на человека</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:18px">Как отмечают в разборе vc.ru: <strong>«бот без интеграции с МИС — бесполезная игрушка»</strong>. Коробочный виджет на сайте, который собирает имя и телефон, но не создаёт запись в расписании, не решает боль клиники — он лишь перекладывает работу на администратора.</p>
        <p>AI-администратор закрывает рутину: FAQ по услугам и ценам, запись к конкретному врачу, перенос, отмена, напоминания, возврат no-show. Администратор остаётся для очного сервиса, VIP-пациентов, конфликтов и клинических ситуаций.</p>
      </div>

      <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="zadachi-ai-admin">
        <h3>Какие задачи закрывает: FAQ, запись, звонки, напоминания</h3>
        <p>Типовой набор функций при <strong>внедрении AI для стоматологии</strong>:</p>
        <ul>
          <li>приём звонков и чатов круглосуточно;</li>
          <li>ответы на частые вопросы: цены, адрес, подготовка к процедуре, парковка;</li>
          <li><strong>AI запись к стоматологу</strong> с проверкой «безопасных окон» врача;</li>
          <li>перенос и отмена приёма;</li>
          <li><strong>AI напоминания пациентам</strong> за 48 часов и за 2 часа до визита;</li>
          <li>возврат не дошедших и «забытых» пациентов;</li>
          <li>сбор первичных данных до визита;</li>
          <li>аналитика: пропущенные обращения, конверсия, причины отказов.</li>
        </ul>
        <p>Dentist Plus в блоге об ИИ в стоматологии формулирует принцип так: <strong>«ИИ — не замена врачу, а инструмент усиления клиники»</strong>. Тот же подход применим к регистратуре.</p>
      </div>
    </div>
  </section>

  <!-- H2 #2: pochemu-seychas -->
  <section class="vna-section vna-section-alt" id="pochemu-seychas">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Боль клиники</span>
        <h2>Почему клинике нужно внедрение AI для стоматологии уже сейчас</h2>
        <p>Рынок не ждёт. Пациенты сравнивают клиники по скорости ответа не меньше, чем по цене импланта. Если вы не ответили — ответил конкурент.</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card" id="bol-skorost-otveta">
          <h3>Пациент сравнивает цены и уходит без быстрого ответа</h3>
          <p>Сценарий из практики: человек ищет «чистка зубов цена» вечером, открывает три клиники в 2ГИС, пишет в мессенджеры. Две молчат до утра. Третья — AI-администратор — отвечает за 30 секунд, называет ориентир по стоимости, предлагает слот на субботу. Запись закрыта.</p>
          <p>Независимый аудит семи стоматологий Москвы (vc.ru, 2026) показал: только <strong>две из семи</strong> имели полноценные каналы записи — звонок, форма и мессенджер/бот. Остальные теряют до <strong>5–7 млн ₽ LTV в год</strong> из-за «сломанных» каналов. При этом <strong>40–45%</strong> обращений приходится на нерабочее время.</p>
          <p>По оценке rechka.ai (данные Resonate AI, 2026), средняя стоматология пропускает около <strong>300 звонков в месяц</strong>; <strong>80%</strong> пропусков связаны с записью. Только <strong>14%</strong> оставивших сообщение на автоответчик дозваниваются повторно.</p>
        </div>
        <div class="vna-card" id="bol-propuski">
          <h3>Пропущенные звонки и незакрытые заявки в мессенджерах</h3>
          <p>Конверсия звонка в запись в стоматологии — в среднем <strong>23%</strong> (анализ более 10 000 звонков, Crimson Media Group, цитируется в rechka.ai). Это значит: из каждых четырёх дозвонившихся трое уходят без записи. Часть — из-за занятой линии, часть — из-за долгого ожидания ответа в чате.</p>
          <p>Маркетинговые исследования 2026 года (vc.ru) указывают: до <strong>30–40%</strong> рекламного бюджета «сливается», если клиника не отвечает на звонки вечером и в выходные. Пациент пришёл с контекстной рекламы — а регистратура молчит.</p>
          <p><strong>68%</strong> пациентов до 35 лет предпочитают запись через мессенджеры (данные DentalPRO, обзор medbusiness.space, 2026). Если у вас есть Telegram-канал, но никто не отвечает в нём в 22:00 — канал работает против вас.</p>
          <p><strong>Итог:</strong> внедрение AI для стоматологии — не про «модный тренд», а про закрытие дыры в воронке, через которую утекают деньги с рекламы и органики.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- БОРИС: визуальный блок после 2-го H2 -->
  <section id="ai-administrator-stomatologii-boris-block" class="bas-root" aria-label="Анимация: путь обращения пациента через каналы к записи в МИС">
<style>
/* === БОРИС: prefix bas-, scoped внутри #ai-administrator-stomatologii-boris-block === */
#ai-administrator-stomatologii-boris-block.bas-root{
  padding:clamp(48px,6vw,72px) 0;
  background:#f0f4fb;
}
#ai-administrator-stomatologii-boris-block .bas-cnt{
  max-width:1160px;margin:0 auto;padding:0 20px;
}
#ai-administrator-stomatologii-boris-block .bas-card{
  display:grid;grid-template-columns:42% 58%;
  border-radius:24px;overflow:hidden;
  box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(14,165,233,.15);
  min-height:480px;
}
@media(max-width:960px){
  #ai-administrator-stomatologii-boris-block .bas-card{grid-template-columns:1fr;min-height:auto;}
}
#ai-administrator-stomatologii-boris-block .bas-lft{
  background:#fff;padding:44px 38px;
  display:flex;flex-direction:column;justify-content:center;
}
@media(max-width:600px){
  #ai-administrator-stomatologii-boris-block .bas-lft{padding:30px 22px;}
}
#ai-administrator-stomatologii-boris-block .bas-ey{
  display:inline-flex;align-items:center;gap:7px;
  font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;
  color:#0ea5e9;margin:0 0 14px;
}
#ai-administrator-stomatologii-boris-block .bas-ey::before{
  content:'';display:inline-block;width:20px;height:2px;
  background:#0ea5e9;border-radius:1px;
}
#ai-administrator-stomatologii-boris-block .bas-h3{
  font-size:24px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 20px;
}
@media(max-width:600px){
  #ai-administrator-stomatologii-boris-block .bas-h3{font-size:20px;}
}
#ai-administrator-stomatologii-boris-block .bas-ul{
  list-style:none;margin:0 0 22px;padding:0;
  display:flex;flex-direction:column;gap:9px;
}
#ai-administrator-stomatologii-boris-block .bas-ul li{
  display:flex;align-items:flex-start;gap:10px;
  font-size:14.5px;line-height:1.5;color:#334155;
}
#ai-administrator-stomatologii-boris-block .bas-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(14,165,233,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#0ea5e9;margin-top:1px;font-style:normal;
}
#ai-administrator-stomatologii-boris-block .bas-pills{
  display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;
}
#ai-administrator-stomatologii-boris-block .bas-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-administrator-stomatologii-boris-block .bas-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-administrator-stomatologii-boris-block .bas-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-administrator-stomatologii-boris-block .bas-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#ai-administrator-stomatologii-boris-block .bas-foot{
  font-size:13.5px;color:#64748b;font-style:italic;margin:0;
}
#ai-administrator-stomatologii-boris-block .bas-rgt{
  background:linear-gradient(145deg,#071018 0%,#0c1528 55%,#080f1e 100%);
  position:relative;overflow:hidden;min-height:400px;
}
@media(max-width:960px){
  #ai-administrator-stomatologii-boris-block .bas-rgt{min-height:360px;}
}
#bas-patient-flow-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>

<div class="bas-cnt">
  <div class="bas-card">
    <div class="bas-lft">
      <span class="bas-ey">Путь пациента</span>
      <h3 class="bas-h3">От «Хочу на чистку» до слота в МИС — за минуты, не часы</h3>
      <ul class="bas-ul">
        <li><span class="bas-ic">📱</span>Пациент пишет в Telegram, звонит или оставляет заявку на сайте</li>
        <li><span class="bas-ic">🤖</span>AI определяет интент, уточняет услугу и запрашивает слоты из МИС</li>
        <li><span class="bas-ic">📅</span>Запись фиксируется в расписании — подтверждение уходит в выбранный канал</li>
        <li><span class="bas-ic">🔔</span>Цепочка напоминаний снижает no-show и возвращает не дошедших</li>
      </ul>
      <div class="bas-pills">
        <span class="bas-pl bas-pl-g">ответ 28 сек</span>
        <span class="bas-pl bas-pl-b">запись за 3 мин</span>
        <span class="bas-pl bas-pl-v">24/7 без смены</span>
      </div>
      <p class="bas-foot">Дальше разберём четыре ключевых сценария AI-администратора →</p>
    </div>
    <div class="bas-rgt">
      <canvas id="bas-patient-flow-canvas" role="img" aria-label="Анимация: обращения пациента из каналов проходят через AI-оркестратор к слоту в МИС и напоминанию"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bas-patient-flow-canvas');
  if (!cv) return;
  var cx = cv.getContext('2d');
  var W = 0, H = 0, t = 0;

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
    cyan:'#38bdf8', green:'#4ade80', viol:'#a78bfa',
    text:'#e2e8f0', muted:'rgba(226,232,240,.45)',
    line:'rgba(255,255,255,.08)', card:'rgba(255,255,255,.06)'
  };

  var nodes = [
    {id:'phone', label:'Звонок', x:0.12, y:0.28, clr:C.cyan},
    {id:'tg',    label:'Telegram', x:0.12, y:0.50, clr:C.cyan},
    {id:'web',   label:'Сайт', x:0.12, y:0.72, clr:C.cyan},
    {id:'ai',    label:'AI-админ', x:0.48, y:0.50, clr:C.viol},
    {id:'mis',   label:'МИС', x:0.82, y:0.38, clr:C.green},
    {id:'rem',   label:'Напомин.', x:0.82, y:0.64, clr:C.green}
  ];

  var packets = [
    {from:0, to:3, delay:0, spd:0.018},
    {from:1, to:3, delay:80, spd:0.02},
    {from:2, to:3, delay:160, spd:0.017},
    {from:3, to:4, delay:240, spd:0.022},
    {from:4, to:5, delay:360, spd:0.019}
  ].map(function(p){
    return {from:p.from, to:p.to, delay:p.delay, spd:p.spd, prog:-0.2, active:false};
  });

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

  function drawNode(n, pulse){
    var x = n.x * W, y = n.y * H;
    var r = 28 + (n.id==='ai' ? 6*Math.sin(pulse*0.08) : 0);
    cx.beginPath();cx.arc(x,y,r+8,0,Math.PI*2);
    cx.fillStyle=n.id==='ai' ? 'rgba(167,139,250,'+(0.12+0.06*Math.sin(pulse*0.08))+')' : 'rgba(56,189,248,.08)';
    cx.fill();
    rr(x-r,y-r,r*2,r*2,12,C.card,'rgba(255,255,255,.14)',1.2);
    cx.fillStyle=n.clr;
    cx.font='bold 11px Inter,system-ui,sans-serif';
    cx.textAlign='center';cx.textBaseline='middle';
    var icon = n.id==='phone'?'📞':n.id==='tg'?'✈':n.id==='web'?'🌐':n.id==='ai'?'AI':n.id==='mis'?'📅':'🔔';
    cx.font=(n.id==='ai'?'bold 14px':'16px')+' Inter,system-ui,sans-serif';
    cx.fillText(icon,x,y-2);
    cx.fillStyle=C.text;
    cx.font='10px Inter,system-ui,sans-serif';
    cx.fillText(n.label,x,y+r+14);
  }

  function drawEdges(){
    cx.strokeStyle=C.line;cx.lineWidth=1.5;
    [[0,3],[1,3],[2,3],[3,4],[4,5]].forEach(function(e){
      cx.beginPath();
      cx.moveTo(nodes[e[0]].x*W, nodes[e[0]].y*H);
      cx.lineTo(nodes[e[1]].x*W, nodes[e[1]].y*H);
      cx.stroke();
    });
  }

  function drawPackets(frame){
    packets.forEach(function(pk){
      if(frame < pk.delay) return;
      pk.active = true;
      pk.prog += pk.spd;
      if(pk.prog > 1.15){pk.prog = -0.15; pk.delay = frame + 40;}
      if(pk.prog < 0 || pk.prog > 1) return;
      var a = nodes[pk.from], b = nodes[pk.to];
      var px = a.x*W + (b.x-a.x)*W*pk.prog;
      var py = a.y*H + (b.y-a.y)*H*pk.prog;
      cx.beginPath();cx.arc(px,py,5,0,Math.PI*2);
      cx.fillStyle=C.green;cx.fill();
      cx.beginPath();cx.arc(px,py,9,0,Math.PI*2);
      cx.fillStyle='rgba(74,222,128,.25)';cx.fill();
    });
  }

  function drawHeader(){
    cx.fillStyle=C.text;
    cx.font='bold 12px Inter,system-ui,sans-serif';
    cx.textAlign='left';
    cx.fillText('канал → AI → МИС → напоминание',16,22);
    var pulse = 6+Math.sin(t*0.07)*2;
    cx.beginPath();cx.arc(W-56,18,pulse,0,Math.PI*2);
    cx.fillStyle='rgba(74,222,128,.12)';cx.fill();
    cx.beginPath();cx.arc(W-56,18,4,0,Math.PI*2);
    cx.fillStyle=C.green;cx.fill();
    cx.fillStyle=C.green;cx.font='10px Inter,system-ui,sans-serif';
    cx.fillText('live',W-44,22);
    cx.strokeStyle=C.line;cx.beginPath();cx.moveTo(0,34);cx.lineTo(W,34);cx.stroke();
  }

  function loop(){
    t++;
    cx.clearRect(0,0,W,H);
    drawHeader();
    drawEdges();
    drawPackets(t);
    nodes.forEach(function(n){drawNode(n,t);});
    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
  </section>

  <!-- H2 #3: scenarii -->
  <section class="vna-section" id="scenarii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Сценарии</span>
        <h2>Сценарии AI-администратора: запись, звонки, чат-бот и напоминания</h2>
        <p>Четыре сценария закрывают 80% типовых обращений в регистратуру. Именно их Nero Network закладывает в <strong>Сценарий AI-администратора стоматологии</strong> — лид-магнит для клиник.</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" aria-label="Четыре сценария AI-администратора">
        <div class="vna-card" id="scenariy-zapis">
          <div class="vna-sc-icon" aria-hidden="true">📅</div>
          <h3>Онлайн-запись к стоматологу 24/7</h3>
          <p>Пациент пишет: «Хочу на чистку в субботу к женщине-врачу». AI уточняет параметры, запрашивает свободные слоты из МИС, предлагает 2–3 варианта, фиксирует запись, отправляет подтверждение. В тесте vc.ru (2026) простой Telegram-бот записал пациента <strong>за 3 минуты</strong> без звонка — при условии интеграции с расписанием.</p>
        </div>
        <div class="vna-card" id="scenariy-zvonki">
          <div class="vna-sc-icon" aria-hidden="true">📞</div>
          <h3>Обработка входящих звонков и чатов</h3>
          <p><strong>AI звонки стоматология</strong> — голосовой агент на базе Yandex SpeechKit, Voximplant или SIP-телефонии. Параллельно обрабатываются десятки звонков. Мультиканальность: Telegram, VK, Max, веб-чат. <strong>AI бот стоматология</strong> в чатах работает по той же логике: единая база знаний и оркестратор сценариев.</p>
        </div>
        <div class="vna-card" id="scenariy-chat">
          <div class="vna-sc-icon" aria-hidden="true">💬</div>
          <h3>Чат-бот и мессенджеры</h3>
          <p>МедАссист (Suppline) и DentalPRO DentalBOT показывают рынок: до <strong>100+</strong> параллельных диалогов — норма для зрелого решения. WhatsApp в РФ в 2026 году ограничен — в проектах Nero Network акцент на российских каналах: Telegram, VK, Max, сайт, голос.</p>
        </div>
        <div class="vna-card" id="scenariy-napominaniya">
          <div class="vna-sc-icon" aria-hidden="true">🔔</div>
          <h3>Напоминания о визите и возврат не дошедших</h3>
          <p>Цепочка: подтверждение за 5 минут → напоминание за 48 ч → за 2 ч → дожим no-show через 24 ч. Модуль «Нулевая неявка» у голосового AI «Ольга» (Кереметь-ИТ) — <strong>AI напоминания пациентам</strong> встроены в продуктовую логику, а не добавлены «сбоку».</p>
        </div>
      </div>

      <div class="vna-scenario nero-ai-reveal nero-ai-delay-1" id="scenariy-detali">
        <div class="vna-sc-icon" aria-hidden="true">🦷</div>
        <div>
          <h3>Цепочка против no-show</h3>
          <p>1. Запись создана → подтверждение в течение 5 минут. 2. Напоминание за 48 часов → предложение переноса при отказе. 3. Напоминание за 2 часа → ссылка на маршрут. 4. No-show → через 24 часа мягкий дожим с новыми слотами. Кейс сети «Красивая улыбка» (vc.ru, данные интегратора): заявлено <strong>+44% явки</strong> при автоматизации подтверждений.</p>
        </div>
      </div>
    </div>

    <div class="vna-cnt" style="margin-top:8px">
      <div class="ym-cta-block ym-cta-block--primary" id="cta-scenarii">
        <div class="ym-cta-block__icon" aria-hidden="true">🦷</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Получите сценарий AI-администратора для стоматологии</p>
          <p class="ym-cta-block__sub">Восемь готовых диалогов: запись, цена, острая боль, перенос, отмена, no-show, возражение «дорого», повторный визит. Пришлём PDF и предложим бесплатный экспресс-аудит каналов записи.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Получить сценарий</a>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #4: integraciya -->
  <section class="vna-section vna-section-alt" id="integraciya">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Архитектура</span>
        <h2>Интеграция AI для стоматологии с CRM, телефонией и МИС</h2>
        <p>Без связки с учётной системой клиники любой <strong>AI для стоматологии</strong> остаётся витриной. Nero Network проектирует архитектуру «канал → AI → МИС → аналитика».</p>
      </div>

      <div class="vna-card nero-ai-reveal" id="integraciya-mis">
        <h3>Связка с CRM клиники и расписанием врачей</h3>
        <p>Поддерживаемые контуры (по опыту проектов и документации вендоров):</p>
        <div class="vna-mis-badges" style="display:flex;flex-wrap:wrap;gap:10px;margin:18px 0 22px" aria-label="Поддерживаемые МИС">
          <span class="vna-badge">YCLIENTS</span>
          <span class="vna-badge">IDENT</span>
          <span class="vna-badge">DentalPRO</span>
          <span class="vna-badge">Dentist Plus</span>
          <span class="vna-badge">1С:Медицина</span>
        </div>
        <ul>
          <li><strong>YCLIENTS</strong> — популярен у клиник с 2–5 креслами;</li>
          <li><strong>IDENT</strong> — мессенджеры через UIS ОМНИ, запись из «Активных чатов»;</li>
          <li><strong>DentalPRO</strong> — нативный DentalBOT, до 100+ диалогов;</li>
          <li><strong>Dentist Plus</strong> — интеграция AURA System для чатов и сайта;</li>
          <li><strong>1С:Медицина</strong> — для сетей с бухгалтерским контуром.</li>
        </ul>
        <p>Для сетей с бухгалтерским контуром на базе 1С смежный сценарий — <a href="/ai-1c-erp/">AI-агент для 1С и ERP</a>: учёт, документы и связка с внешними каналами записи.</p>
        <p>Двусторонняя синхронизация — обязательный критерий. <strong>Интеграция AI для стоматологии с CRM</strong> включает: создание карточки пациента, привязку к источнику (коллтрекинг, UTM), фиксацию причины отказа, теги для маркетинга. Для типового CRM-контура смотрите <a href="/vnedrenie-ai-amocrm/">внедрение AI-агента в CRM под ключ</a>.</p>
      </div>

      <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="integraciya-kanaly">
        <h3>WhatsApp, Telegram и другие каналы обращений</h3>
        <p>Карта каналов, которую Nero Network собирает на этапе диагностики:</p>
        <ul>
          <li>телефон (Манго Офис, Ростелеком, UIS, Asterisk);</li>
          <li>сайт и формы (WordPress, Tilda, виджет);</li>
          <li>Telegram, VK, Max;</li>
          <li>карты и агрегаторы (2ГИС, Яндекс.Карты — через ссылки на мессенджер);</li>
          <li>email — для подтверждений и документов; автоматизация входящих писем в CRM — в материале про <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработку входящей почты в CRM</a></li>
        </ul>
        <p>Все каналы сходятся в единый оркестратор (Make, n8n или custom), который передаёт контекст в AI и фиксирует результат в МИС. Администратор видит полную переписку в одном окне — как в кейсе Dentist Plus + AURA.</p>
      </div>
    </div>
  </section>

  <!-- H2 #5: etapy -->
  <section class="vna-section" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Под ключ</span>
        <h2>Внедрение AI для стоматологии под ключ: этапы и сроки</h2>
        <p><strong>AI для стоматологии под ключ</strong> у Nero Network — проектная модель, не подписка на коробку. Срок от диагностики до пилота: <strong>2–4 недели</strong>; полный запуск с аналитикой — до 6–8 недель для клиник с нестандартной МИС.</p>
      </div>

      <div class="vna-timeline nero-ai-reveal" aria-label="Этапы внедрения">
        <div class="vna-tl-item" id="etap-audit">
          <div class="vna-tl-dot"></div>
          <h3>Аудит обращений и сценариев клиники</h3>
          <p><strong>День 1–2.</strong> Карта каналов, подсчёт пропущенных звонков, разбор записей разговоров (если есть), интервью с администраторами. Выход: матрица «обращение → сценарий → интеграция → KPI». Фиксируем боли: no-show, ночные звонки, перегруз в пик, слабая конверсия из мессенджеров.</p>
        </div>
        <div class="vna-tl-item" id="etap-proekt">
          <div class="vna-tl-dot"></div>
          <h3>Проектирование 8–12 диалоговых веток</h3>
          <p><strong>День 3–7.</strong> Запись, цена, острая боль (с эскалацией), перенос, отмена, повторный визит, возражение «дорого», возврат no-show.</p>
        </div>
        <div class="vna-tl-item" id="etap-integracii">
          <div class="vna-tl-dot"></div>
          <h3>Интеграции и база знаний</h3>
          <p><strong>Неделя 2–3.</strong> API МИС, телефония, мессенджеры. База знаний: прайс, услуги, врачи, правила записи — тексты без нарушения рекламы медуслуг.</p>
        </div>
        <div class="vna-tl-item" id="etap-pilot">
          <div class="vna-tl-dot"></div>
          <h3>Настройка, обучение на FAQ клиники, пилот и запуск</h3>
          <p><strong>Неделя 3–4.</strong> Пилот: AI обрабатывает <strong>60–80%</strong> типовых обращений, сложное — handoff на администратора. Корректировка скриптов по реальным диалогам. Масштабирование: напоминания, возврат, дашборд ROI.</p>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:28px;font-size:14.5px">Для сравнения: SaaS-вендоры вроде МедАссист обещают запуск «за 1 день» — но сценарии шаблонные. Nero контрастирует <strong>кастомной интеграцией под МИС клиента</strong> и владением логикой сценариев.</p>
    </div>

    <div class="vna-cnt" style="margin-top:8px">
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите понимать логику внедрения до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед интеграцией с МИС полезно разобраться в сценариях AI-агентов, human-in-the-loop и no-code-связках — это ускоряет согласование с администраторами и IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo (strpos($secondary_cta_url, 'http') === 0) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- H2 #6: cena-roi -->
  <section class="vna-section vna-section-alt" id="cena-roi">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Бюджет и ROI</span>
        <h2>Сколько стоит AI для стоматологии и какой ROI ждать</h2>
        <p>Вопрос <strong>«ai для стоматологии цена»</strong> — один из первых в коммерческих запросах. Ответ зависит от каналов, МИС и глубины интеграции.</p>
      </div>

      <div class="vna-card nero-ai-reveal" id="cena-sostav">
        <h3>Ориентир чека 220–700 тыс. ₽ и из чего складывается стоимость</h3>
        <p>Ориентир из проектной таблицы Nero Network: <strong>220–700 тыс. ₽</strong> за внедрение под ключ. Рынок подтверждает порядок: NIKTA — простые AI-проекты от <strong>350–400 тыс. ₽</strong>; aibotmanager — базовые пакеты бот+голос <strong>60–120 тыс. ₽</strong> (нижний сегмент, меньше кастомизации).</p>
        <div class="vna-table-wrap" style="margin-top:20px">
          <table class="vna-table" aria-label="Состав стоимости внедрения AI для стоматологии">
            <thead>
              <tr><th>Статья</th><th>Что входит</th></tr>
            </thead>
            <tbody>
              <tr><td>Диагностика и проектирование</td><td>Аудит каналов, 8–12 сценариев, ТЗ</td></tr>
              <tr><td>Интеграции</td><td>МИС, телефония, мессенджеры, CRM</td></tr>
              <tr><td>База знаний и RAG</td><td>Прайс, FAQ, регламенты, compliance</td></tr>
              <tr><td>Голосовой модуль</td><td>SpeechKit, SIP, маршрутизация</td></tr>
              <tr><td>Пилот и обучение</td><td>2–4 недели, донастройка по диалогам</td></tr>
              <tr><td>Аналитика и handoff</td><td>Дашборд, панель администратора</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:16px">SaaS-подписки (10–60 тыс. ₽/мес) дешевле на старте, но ограничены шаблонами. Кастом окупается, если клиника теряет сотни обращений в месяц.</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal nero-ai-delay-1" id="roi-metriki">
        <div class="vna-card">
          <h3>Метрики: время ответа, конверсия в запись, снижение no-show</h3>
          <p>Что измерять до и после <strong>автоматизации через AI для стоматологии</strong>:</p>
          <ul>
            <li><strong>Время первого ответа</strong> — с часов до секунд;</li>
            <li><strong>Доля обработанных обращений вне смены</strong> — рост на 40–45% потенциала;</li>
            <li><strong>Пропущенные звонки</strong> — снижение (бенчмарк: ~300/мес);</li>
            <li><strong>Конверсия «обращение → запись»</strong> — отталкиваться от 23%, цель — рост на 5–15 п.п.;</li>
            <li><strong>No-show</strong> — снижение за счёт цепочки напоминаний.</li>
          </ul>
        </div>
        <div class="vna-card">
          <h3>ROI без завышенных обещаний</h3>
          <p>ROI считается честно: (дополнительные записи + сохранённый LTV от no-show) − (проект + сопровождение). Сравните с ФОТ 1–2 администраторов (<strong>80–160 тыс. ₽/мес</strong> в регионах) и с <strong>30–40%</strong> рекламного бюджета, уходящего в пустоту из-за неответа.</p>
          <div class="vna-metrics" style="margin-top:18px">
            <div class="vna-metric"><span class="num">23%</span><span class="lbl">базовая конверсия звонка в запись</span></div>
            <div class="vna-metric"><span class="num">300</span><span class="lbl">пропусков/мес у средней клиники</span></div>
            <div class="vna-metric"><span class="num">60–80%</span><span class="lbl">типовых обращений на пилоте</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #7: keisy -->
  <section class="vna-section" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Кейсы</span>
        <h2>Примеры внедрения AI для стоматологии и кейсы</h2>
        <p>Публичных независимых аудитов мало; ниже — проверенные референсы рынка. Цифры интеграторов помечены.</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card" id="keis-2-5-kresel">
          <h3>Типовой сценарий для клиники с 2–5 креслами</h3>
          <p>Клиника на YCLIENTS, один администратор, Telegram + звонки. Проблема: в пик не берут трубку, ночью — автоответчик.</p>
          <p><strong>Решение Nero Network (проектная модель):</strong></p>
          <ol style="padding-left:20px;color:var(--vna-muted);font-size:14.5px;line-height:1.65">
            <li>AI-чат в Telegram и на сайте — запись, FAQ, цены.</li>
            <li>Голосовой агент на входящей — в нерабочие часы.</li>
            <li>Напоминания за 48 ч и 2 ч.</li>
            <li>Возврат no-show через 24 ч.</li>
          </ol>
          <p>Ожидаемый эффект: обработка <strong>60–80%</strong> типовых обращений без участия администратора.</p>
        </div>
        <div class="vna-card" id="keis-malyj-biznes">
          <h3>AI для стоматологии для малого бизнеса</h3>
          <p>Кабинет с одним-двумя врачами часто откладывает автоматизацию: «у нас мало звонков». Но <strong>40–45%</strong> из них — вне рабочего времени. Один пропущенный имплант перекрывает стоимость внедрения.</p>
          <p><strong>Минимальный контур:</strong> Telegram-бот с записью в YCLIENTS; FAQ по 15–20 услугам; напоминания; handoff в один клик. Бюджет — ближе к нижней границе (<strong>220–350 тыс. ₽</strong>). Срок пилота — <strong>2–3 недели</strong>.</p>
          <p>Кейс DentalPRO DentalBOT: нативный модуль МИС без ручного переноса заявок — хороший ориентир для клиник на этой системе.</p>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="keis-sravnenie">
        <h3>Чем Nero Network отличается от SaaS-бота</h3>
        <div class="vna-table-wrap">
          <table class="vna-table" aria-label="Сравнение SaaS-бота и Nero Network под ключ">
            <thead>
              <tr><th>Параметр</th><th>SaaS-бот</th><th>Nero Network под ключ</th></tr>
            </thead>
            <tbody>
              <tr><td>Срок запуска</td><td>1–14 дней</td><td>4–8 недель</td></tr>
              <tr><td>Сценарии</td><td>Шаблонные</td><td>Под вашу клинику</td></tr>
              <tr><td>МИС</td><td>Ограниченный список</td><td>Кастомная интеграция</td></tr>
              <tr><td>Голос</td><td>Опция</td><td>Полноценный модуль</td></tr>
              <tr><td>Владение логикой</td><td>У вендора</td><td>У клиники</td></tr>
              <tr><td>No-show и возврат</td><td>Базово</td><td>Цепочки под ваш LTV</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #8: faq -->
  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">FAQ</span>
        <h2>FAQ: как внедрить AI-администратора в стоматологическую клинику</h2>
      </div>

      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item" id="faq-admin">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли живой администратор после внедрения?</div>
          <div class="vna-faq-a">
            <p>Да. AI не заменяет команду — он снимает рутину. Живой администратор нужен для конфликтов, VIP, нестандартных скидок и клинических ситуаций. Handoff должен занимать секунды, не часы.</p>
          </div>
        </div>
        <div class="vna-faq-item" id="faq-pdn">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Персональные данные, медицинская реклама и передача на человека</div>
          <div class="vna-faq-a">
            <p>Медицинские данные — <strong>спецкатегория ПДн</strong> (152-ФЗ). Облачный ChatGPT «как есть» для клиники — риск. Требования: согласие на обработку ПДн; российский контур данных (YandexGPT, GigaChat, on-prem); разделение FAQ и медконсультаций; тексты без нарушения закона о рекламе медуслуг; эскалация при жалобах и острой боли.</p>
          </div>
        </div>
        <div class="vna-card nero-ai-reveal" id="compliance-152fz" style="margin:20px 0;border-color:rgba(239,68,68,.35)">
          <h3 style="font-size:17px;margin-bottom:10px">⚖️ Compliance: 152-ФЗ и граница FAQ vs медконсультация</h3>
          <p style="font-size:14.5px;margin:0">AI-администратор отвечает на цену, адрес, запись и подготовку к процедуре. Диагнозы, лечение и острая боль — только врач или живой администратор. Усиление ответственности по 152-ФЗ в 2025–2026: фиксированные штрафы и оборотные санкции за утечки.</p>
        </div>
        <div class="vna-faq-item" id="faq-sroki">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает внедрение?</div>
          <div class="vna-faq-a">
            <p>Диагностика — 1–2 дня. Проектирование — 3–5 дней. Интеграции — 1–2 недели. Пилот — 2–4 недели. Итого до устойчивого запуска: <strong>4–8 недель</strong> в зависимости от МИС.</p>
          </div>
        </div>
        <div class="vna-faq-item" id="faq-zamena">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI администратора полностью?</div>
          <div class="vna-faq-a">
            <p>Нет — и это не цель. Цель — чтобы ни одно обращение не осталось без ответа, а администратор работал с пациентами в клинике, а не с десятым параллельным чатом.</p>
          </div>
        </div>
        <div class="vna-faq-item" id="faq-mis">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Какие МИС поддерживаются?</div>
          <div class="vna-faq-a">
            <p>YCLIENTS, IDENT, DentalPRO, Dentist Plus, 1С:Медицина — наиболее частые. Для редких систем — разработка коннектора по API или webhook.</p>
          </div>
        </div>
        <div class="vna-faq-item" id="faq-oshibka">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Что если AI ошибётся в записи?</div>
          <div class="vna-faq-a">
            <p>На пилоте — правило: спорные слоты согласует администратор. Логи всех диалогов хранятся. Пациент в любой момент может попросить человека. Ошибка фиксируется в аналитике → корректировка сценария.</p>
          </div>
        </div>
        <div class="vna-faq-item" id="faq-nero-vs-saas">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Чем Nero Network отличается от SaaS-бота?</div>
          <div class="vna-faq-a">
            <p>Кастомные сценарии под вашу клинику, полноценный голосовой модуль, интеграция с вашей МИС, цепочки no-show и возврата, владение логикой у клиники — в отличие от шаблонных коробок с ограниченным списком МИС.</p>
          </div>
        </div>
        <div class="vna-faq-item" id="faq-start">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI для стоматологии: с чего начать?</div>
          <div class="vna-faq-a">
            <p>1. Запросите <strong>Сценарий AI-администратора стоматологии</strong> — 8 готовых диалоговых веток. 2. Проведите мини-аудит: сколько звонков пропускаете, какие каналы «молчат». 3. Выберите пилотный канал (обычно Telegram + звонки в нерабочее время). 4. Подключите МИС — без этого шаг 3 бессмысленен.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #9: poluchit-scenariy -->
  <section class="vna-section" id="poluchit-scenariy">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Следующий шаг</span>
        <h2>Получить сценарий AI-администратора для вашей клиники</h2>
        <p>Вы дочитали до конца — значит, вопрос не «нужен ли AI», а «как внедрить без риска для пациентов и ПДн». Nero Network собирает <strong>AI-администратора под ключ</strong>: диагностика, интеграция с вашей МИС, 8–12 сценариев, пилот, аналитика ROI.</p>
        <p><strong>Лид-магнит:</strong> PDF «Сценарий AI-администратора стоматологии» — восемь диалогов (запись, цена, острая боль, перенос, отмена, no-show, возражение «дорого», повторный визит). Готовые формулировки для вашей команды.</p>
        <p>Пациент звонит в 21:00. Пока конкуренты молчат — ваш AI-администратор уже записывает.</p>
      </div>

      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Пациент звонит в 21:00 — ваш AI-администратор уже записывает</p>
          <p class="ym-cta-block__sub">Сценарий AI-администратора стоматологии + экспресс-аудит каналов записи — бесплатно.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить сценарий</a>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.vna-content -->

<script>
(function(){
  document.querySelectorAll('.vna-faq-q').forEach(function(btn){
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
  var root = document.querySelector('.vna-content');
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
  var heroReveals = document.querySelectorAll('.naas-hero-stomatologii .nero-ai-reveal');
  heroReveals.forEach(function(item){ item.classList.add('nero-ai-active'); });
})();
</script>

<?php
$nero_schema_site = rtrim(home_url(), '/');
$nero_schema_page = get_permalink();
$nero_schema_graph = [
  '@context' => 'https://schema.org',
  '@graph' => [
    [
      '@type' => 'Organization',
      '@id' => $nero_schema_site . '#organization',
      'name' => 'Nero Network',
      'url' => $nero_schema_site,
    ],
    [
      '@type' => 'WebSite',
      '@id' => $nero_schema_site . '#website',
      'url' => $nero_schema_site,
      'name' => 'Nero Network',
      'publisher' => ['@id' => $nero_schema_site . '#organization'],
    ],
    [
      '@type' => 'WebPage',
      '@id' => $nero_schema_page . '#webpage',
      'url' => $nero_schema_page,
      'name' => 'AI-администратор для стоматологии: внедрение и настройка под ключ',
      'description' => 'Внедрение AI-администратора для стоматологии под ключ: ответы на вопросы, запись пациентов, звонки, напоминания и интеграция с CRM. Получите сценарий внедрения.',
      'isPartOf' => ['@id' => $nero_schema_site . '#website'],
      'about' => ['@id' => $nero_schema_site . '#organization'],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id' => $nero_schema_page . '#breadcrumb',
      'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $nero_schema_site],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'AI-администратор для стоматологии: внедрение и настройка под ключ', 'item' => $nero_schema_page],
      ],
    ],
    [
      '@type' => 'Service',
      '@id' => $nero_schema_page . '#service',
      'name' => 'AI-администратор для стоматологии: внедрение и настройка под ключ',
      'description' => 'Внедрение AI-администратора для стоматологии под ключ: ответы на вопросы, запись пациентов, звонки, напоминания и интеграция с CRM. Получите сценарий внедрения.',
      'url' => $nero_schema_page,
      'provider' => ['@id' => $nero_schema_site . '#organization'],
    ],
    [
      '@type' => 'FAQPage',
      '@id' => $nero_schema_page . '#faq',
      'mainEntity' => [
        ['@type' => 'Question', 'name' => 'Нужен ли живой администратор после внедрения?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Да. AI не заменяет команду — он снимает рутину. Живой администратор нужен для конфликтов, VIP, нестандартных скидок и клинических ситуаций. Handoff должен занимать секунды, не часы.']],
        ['@type' => 'Question', 'name' => 'Персональные данные, медицинская реклама и передача на человека', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Медицинские данные — спецкатегория ПДн (152-ФЗ). Облачный ChatGPT «как есть» для клиники — риск. Требования: согласие на обработку ПДн; российский контур данных (YandexGPT, GigaChat, on-prem); разделение FAQ и медконсультаций; тексты без нарушения закона о рекламе медуслуг; эскалация при жалобах и острой боли.']],
        ['@type' => 'Question', 'name' => 'Сколько времени занимает внедрение?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Диагностика — 1–2 дня. Проектирование — 3–5 дней. Интеграции — 1–2 недели. Пилот — 2–4 недели. Итого до устойчивого запуска: 4–8 недель в зависимости от МИС.']],
        ['@type' => 'Question', 'name' => 'Заменит ли AI администратора полностью?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Нет — и это не цель. Цель — чтобы ни одно обращение не осталось без ответа, а администратор работал с пациентами в клинике, а не с десятым параллельным чатом.']],
        ['@type' => 'Question', 'name' => 'Какие МИС поддерживаются?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'YCLIENTS, IDENT, DentalPRO, Dentist Plus, 1С:Медицина — наиболее частые. Для редких систем — разработка коннектора по API или webhook.']],
        ['@type' => 'Question', 'name' => 'Что если AI ошибётся в записи?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'На пилоте — правило: спорные слоты согласует администратор. Логи всех диалогов хранятся. Пациент в любой момент может попросить человека. Ошибка фиксируется в аналитике → корректировка сценария.']],
        ['@type' => 'Question', 'name' => 'Чем Nero Network отличается от SaaS-бота?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Кастомные сценарии под вашу клинику, полноценный голосовой модуль, интеграция с вашей МИС, цепочки no-show и возврата, владение логикой у клиники — в отличие от шаблонных коробок с ограниченным списком МИС.']],
        ['@type' => 'Question', 'name' => 'Как внедрить AI для стоматологии: с чего начать?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => '1. Запросите Сценарий AI-администратора стоматологии — 8 готовых диалоговых веток. 2. Проведите мини-аудит: сколько звонков пропускаете, какие каналы «молчат». 3. Выберите пилотный канал (обычно Telegram + звонки в нерабочее время). 4. Подключите МИС — без этого шаг 3 бессмысленен.']],
      ],
    ],
  ],
];
?>
<script type="application/ld+json">
<?php echo wp_json_encode($nero_schema_graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

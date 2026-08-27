<?php
/**
 * Template Name: AI адаптация сотрудников: внедрение AI-агента под ключ
 * Description: SEO-лендинг — AI-агент адаптации сотрудников: onboarding, RAG, дашборд рисков. Кейсы, интеграции, цены.
 */

$page_seo_title       = 'AI адаптация сотрудников: внедрение AI-агента под ключ';
$page_seo_description = 'Внедряем AI-агент адаптации сотрудников: ведёт новичка по чек-листу onboarding, отвечает на вопросы по регламентам и показывает HR статус адаптации и риски. Кейсы, интеграции, цены. Проверить onboarding.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Для кого',     'href' => '#dlya-kogo'],
    ['label' => 'Интеграции',   'href' => '#integracii'],
    ['label' => 'Кейсы',        'href' => '#keisy'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = 'Проверить onboarding';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = '#kak-rabotaet';
$secondary_cta_link  = getenv('SECONDARY_CTA_URL') ?: '';
$secondary_cta_attrs = $secondary_cta_link ? nero_ai_external_link_attrs($secondary_cta_link) : '';

$ad_banner_url   = getenv('AD_BANNER_URL') ?: '';
$ad_banner_image = getenv('AD_BANNER_IMAGE_URL') ?: '';
$ad_banner_alt   = getenv('AD_BANNER_ALT') ?: 'Партнёрское предложение';

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

/* Boris light block inside dark longread */
.vna-content #ai-adaptatsiya-sotrudnikov-boris-block.bas-root{color:#0f172a;}
.vna-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-top:28px;}
@media(max-width:900px){.vna-steps{grid-template-columns:1fr 1fr;}}
@media(max-width:560px){.vna-steps{grid-template-columns:1fr;}}
.vna-step-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:20px;}
.vna-step-num{font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--vna-accent);margin-bottom:8px;}
.vna-step-card h3{font-size:15px;margin-bottom:8px;}
.vna-step-card p{font-size:13.5px;margin:0;}
.vna-callout{border-left:3px solid var(--vna-green);padding:16px 20px;background:rgba(34,197,94,.08);border-radius:0 12px 12px 0;margin:24px 0;}
.vna-callout p{margin:0;font-size:14.5px;}
.vna-arch-flow{display:flex;flex-wrap:wrap;align-items:center;gap:8px;justify-content:center;margin:24px 0;}
.vna-arch-flow span{padding:8px 14px;border-radius:999px;background:rgba(121,242,255,.1);border:1px solid rgba(121,242,255,.25);font-size:13px;font-weight:600;color:var(--vna-soft);}
.vna-arch-flow .arr{color:var(--vna-muted);font-size:18px;}
.vna-flags{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-top:20px;}
@media(max-width:600px){.vna-flags{grid-template-columns:1fr;}}
.vna-flag{padding:14px 16px;border-radius:12px;background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.22);font-size:13.5px;color:#fecaca;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-link--accent{color:var(--vna-accent)!important;text-decoration:underline!important;}
.vna-price-band{display:inline-block;padding:6px 16px;border-radius:999px;background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.3);font-size:14px;font-weight:800;color:var(--vna-accent);margin-bottom:16px;}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-adaptatsiya-sotrudnikov-page" role="main" tabindex="-1">

<section class="nero-ai-hero aas-hero-adaptatsiya" id="aas-hero-adaptatsiya" aria-labelledby="aas-hero-title">
<style>
.aas-hero-adaptatsiya {
  --aas-cyan: #79f2ff;
  --aas-violet: #8b5cf6;
  --aas-green: #22c55e;
  --aas-amber: #fbbf24;
  --aas-soft: #c7d2e5;
  --aas-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aas-hero-adaptatsiya::before {
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
.aas-hero-adaptatsiya::after {
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
  animation: aasHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aasHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.aas-hero-adaptatsiya .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aas-hero-adaptatsiya .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aas-hero-adaptatsiya .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.aas-hero-adaptatsiya .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aas-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aas-hero-adaptatsiya .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aas-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.aas-hero-adaptatsiya .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--aas-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aas-hero-adaptatsiya .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aas-hero-adaptatsiya .nero-ai-badge {
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
.aas-hero-adaptatsiya .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 34px;
}
.aas-hero-adaptatsiya .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 14px 22px;
  border-radius: 999px;
  font-size: 15px;
  font-weight: 800;
  text-decoration: none;
  transition: transform .2s ease, box-shadow .2s ease;
}
.aas-hero-adaptatsiya .nero-ai-btn-primary {
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  color: #fff !important;
  box-shadow: 0 14px 40px rgba(37, 99, 235, 0.35);
}
.aas-hero-adaptatsiya .nero-ai-btn-secondary {
  border: 1px solid rgba(255,255,255,.16);
  background: rgba(255,255,255,.06);
  color: #e6edf7 !important;
}
.aas-hero-adaptatsiya .nero-ai-btn:hover { transform: translateY(-2px); }
.aas-hero-adaptatsiya .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aas-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.aas-hero-adaptatsiya .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aas-hero-adaptatsiya .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aas-hero-adaptatsiya .nero-ai-dots { display: flex; gap: 7px; }
.aas-hero-adaptatsiya .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aas-hero-adaptatsiya .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aas-hero-adaptatsiya .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aas-hero-adaptatsiya .nero-ai-dot:nth-child(3) { background: #34d399; }
.aas-hero-adaptatsiya .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aas-hero-adaptatsiya .nero-ai-window-body { padding: 18px; }
.aas-hero-adaptatsiya .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
}
.aas-hero-adaptatsiya .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aas-hero-adaptatsiya .nero-ai-live-pill {
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
.aas-hero-adaptatsiya .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aasPulse 1.6s infinite;
}
@keyframes aasPulse {
  0%, 100% { box-shadow: 0 0 0 6px rgba(34,197,94,.14); }
  50% { box-shadow: 0 0 0 10px rgba(34,197,94,.06); }
}
.aas-hero-adaptatsiya .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 10px;
  margin-bottom: 14px;
}
.aas-hero-adaptatsiya .nero-ai-metric {
  padding: 10px;
  border-radius: 14px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.08);
}
.aas-hero-adaptatsiya .nero-ai-metric span {
  display: block;
  font-size: 10px;
  color: #9aa8bd;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .06em;
}
.aas-hero-adaptatsiya .nero-ai-metric strong {
  display: block;
  font-size: 18px;
  color: #fff;
  letter-spacing: -.03em;
  margin-top: 4px;
}
.aas-hero-adaptatsiya .aas-dash-canvas-wrap {
  position: relative;
  height: 220px;
  margin: 0 0 14px;
  border-radius: 16px;
  overflow: hidden;
  background: linear-gradient(180deg, rgba(121,242,255,.06), rgba(139,92,246,.04));
  border: 1px solid rgba(255,255,255,.08);
}
.aas-hero-adaptatsiya #aas-onboarding-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aas-hero-adaptatsiya .aas-stage-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 14px;
  padding: 0;
  list-style: none;
}
.aas-hero-adaptatsiya .aas-stage-pills li {
  padding: 6px 12px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.1);
  background: rgba(255,255,255,.04);
  color: #c7d2e5;
  font-size: 11px;
  font-weight: 700;
}
.aas-hero-adaptatsiya .nero-ai-task-stream { display: grid; gap: 8px; }
.aas-hero-adaptatsiya .nero-ai-task {
  display: grid;
  grid-template-columns: auto 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.07);
}
.aas-hero-adaptatsiya .nero-ai-task-icon {
  width: 32px;
  height: 32px;
  border-radius: 10px;
  display: grid;
  place-items: center;
  background: rgba(121,242,255,.12);
  color: var(--aas-cyan);
  font-size: 11px;
  font-weight: 800;
}
.aas-hero-adaptatsiya .nero-ai-task strong {
  display: block;
  color: #e6edf7;
  font-size: 13px;
}
.aas-hero-adaptatsiya .nero-ai-task span {
  display: block;
  color: #9aa8bd;
  font-size: 11px;
}
.aas-hero-adaptatsiya .nero-ai-status {
  font-size: 11px;
  font-weight: 800;
  color: #86efac;
  text-transform: uppercase;
}
.aas-hero-adaptatsiya .nero-ai-status--amber { color: #fcd34d; }
@media (max-width: 1023px) {
  .aas-hero-adaptatsiya .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aas-hero-adaptatsiya .nero-ai-metrics-grid { grid-template-columns: repeat(2, 1fr); }
  .aas-hero-adaptatsiya .aas-dash-canvas-wrap { height: 200px; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai onboarding</p>
      <h1 id="aas-hero-title">AI-агент адаптации сотрудников: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI ведёт новичка по чек-листу onboarding, отвечает на вопросы по регламентам и показывает руководителю статус адаптации — до того, как сотрудник «потеряется»</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Чек-лист 30/60/90</li>
        <li class="nero-ai-badge">RAG Q&amp;A</li>
        <li class="nero-ai-badge">Дашборд рисков</li>
        <li class="nero-ai-badge">Bitrix24 / Huntflow</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить onboarding</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо: AI-агент адаптации сотрудников">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">Onboarding · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Пульт адаптации</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Новички</span><strong>12</strong></div>
            <div class="nero-ai-metric"><span>Чек-лист</span><strong>78%</strong></div>
            <div class="nero-ai-metric"><span>Риски</span><strong>2</strong></div>
            <div class="nero-ai-metric"><span>HR</span><strong>−40%</strong></div>
          </div>

          <ul class="aas-stage-pills" aria-label="Этапы цикла адаптации">
            <li>День 1</li>
            <li>Чек-лист</li>
            <li>RAG-ответ</li>
            <li>Риск → HR</li>
          </ul>

          <div class="aas-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aas-onboarding-hero-canvas" role="img" aria-label="Анимация: новичок проходит таймлайн адаптации, AI отвечает по регламентам и сигналит о риске HR"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий onboarding">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">D3</span>
              <div><strong>День 3 · чек-лист</strong><span>Документы ✓ · доступы в процессе</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">Q&amp;A</span>
              <div><strong>Ответ по регламенту</strong><span>RAG · ссылка на PDF · confidence 0.94</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⚠</span>
              <div><strong>Эскалация HR</strong><span>2 просроченных шага · уведомление руководителю</span></div>
              <span class="nero-ai-status nero-ai-status--amber">риск</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vna-content">

  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai onboarding</p>
          <p><strong>Коротко:</strong> AI-агент адаптации сотрудников ведёт новичка по чек-листу onboarding, отвечает на вопросы по регламентам 24/7 и показывает HR и руководителю статус адаптации с ранними сигналами риска — до того, как сотрудник «потеряется» между welcome-тренингом и первой самостоятельной задачей.</p>
          <p><?php echo esc_html($brand); ?> внедряет такие агенты под ключ: от аудита процесса до пилота на реальных новичках. Ориентир чека — <strong>120–350 тыс. ₽</strong> за фокусный MVP (1–2 роли, Telegram или Bitrix24, RAG-база знаний, чек-лист, дашборд статуса). Следующий шаг — <strong>проверить onboarding</strong> и получить «Карту адаптации сотрудника».</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые метрики onboarding">
          <div class="vna-kpi-card"><div class="kv">33%</div><div class="kl">ищут работу в первые 6 мес.</div><div class="ks">FirstHR</div></div>
          <div class="vna-kpi-card"><div class="kv">3,4%</div><div class="kl">90-day turnover (медиана)</div><div class="ks">HRBench</div></div>
          <div class="vna-kpi-card"><div class="kv">82%</div><div class="kl">удержание при структурном onboarding</div><div class="ks">Brandon Hall</div></div>
          <div class="vna-kpi-card"><div class="kv">−40%</div><div class="kl">нагрузка HR (кейс)</div><div class="ks">Открытая Линия</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#bolez">Проблема</a>
        <a href="#chto-takoe">Что это</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#integracii">Интеграции</a>
        <a href="#arhitektura">Архитектура</a>
        <a href="#kpi">KPI</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Цены</a>
        <a href="#etapy">Этапы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="vna-section" id="bolez">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Проблема</span>
        <h2>Почему новички «теряются» и руководитель не видит статус адаптации</h2>
        <p><strong>Определение боли:</strong> между официальным welcome и первой продуктивной задачей новичок остаётся без системного сопровождения — регламенты разбросаны, наставник перегружен, руководитель узнаёт о проблеме post factum.</p>
      </div>
      <div class="vna-grid-3 nero-ai-reveal" style="margin-bottom:32px;">
        <div class="vna-kpi-card"><div class="kv">33%</div><div class="kl">новых сотрудников ищут работу в первые 6 месяцев</div></div>
        <div class="vna-kpi-card"><div class="kv">3,4%</div><div class="kl">медиана 90-day new hire turnover</div></div>
        <div class="vna-kpi-card"><div class="kv">82%</div><div class="kl">удержание при структурированном onboarding</div></div>
      </div>
      <div class="vna-card nero-ai-reveal">
        <h3>Типовые провалы onboarding в сетях и франшизах</h3>
        <ul>
          <li><strong>Разрозненные источники знаний</strong> — FAQ в чате, wiki, PDF, LMS. Новичок не знает, где искать ответ.</li>
          <li><strong>Нестандартизированный путь</strong> — в одном филиале адаптация за 5 дней, в другом за 3 недели.</li>
          <li><strong>Ручная координация</strong> — HR напоминает о документах, IT о доступах; один пропущенный шаг тормозит цепочку.</li>
          <li><strong>Нет «пульта» для руководителя</strong> — статус в Excel или «на словах». Риски видны, когда новичок уже отстаёт.</li>
        </ul>
        <div class="vna-timeline" style="margin-top:28px;">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>День 1–7</h3><p>Эмоциональный пик, но информационный шок. Новичок получает десятки ссылок и не понимает приоритеты.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>День 8–30</h3><p>«Пустота» между тренингом и реальной работой. Вопросы к HR повторяются.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>День 31–90</h3><p>Критический период удержания. Без структурированного сопровождения компании теряют недавно нанятых людей.</p></div>
        </div>
        <p style="margin-top:20px;"><strong>Итог:</strong> руководитель не видит статус адаптации в реальном времени; HR тратит время на рутину; новички теряются — измеримая бизнес-проблема.</p>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="chto-takoe">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Определение</span>
        <h2>Что такое AI-агент адаптации сотрудников</h2>
        <p><strong>Определение:</strong> AI-агент адаптации сотрудников — оркестратор процесса onboarding. Он ведёт новичка по ролевому чек-листу, отвечает на вопросы по регламентам через RAG, фиксирует прогресс и эскалирует риски HR и руководителю.</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal" style="margin-bottom:24px;">
        <table class="vna-table">
          <thead><tr><th>Критерий</th><th>Классический наставник</th><th>AI-наставник сотрудника</th></tr></thead>
          <tbody>
            <tr><td>Доступность</td><td>Рабочие часы, очно</td><td>24/7 в Telegram / корпоративном чате</td></tr>
            <tr><td>Одинаковые вопросы</td><td>Наставник отвечает снова</td><td>RAG отвечает по документам с ссылкой на источник</td></tr>
            <tr><td>Масштаб</td><td>1 наставник = N новичков</td><td>Один агент — сотни параллельных адаптаций</td></tr>
            <tr><td>Статус для руководителя</td><td>Субъективно, «на словах»</td><td>Дашборд: % чек-листа, просрочки, красные флаги</td></tr>
            <tr><td>Эскалация</td><td>Наставник сам решает</td><td>Правила: 2+ просрочки → уведомление HR</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-callout nero-ai-reveal">
        <p><strong>Кейс «Открытая Линия»</strong> (400+ сотрудников): нейроассистент Oline Наставник ускорил адаптацию <strong>в 2 раза</strong> и освободил HR <strong>~40%</strong> рабочего времени. AI не заменяет живое наставничество — снимает рутину и даёт единый стандарт.</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <h3>AI-наставник: чек-лист, Q&A по регламентам, сигналы риска</h3>
        <ol style="padding-left:20px;color:var(--vna-muted);line-height:1.7;font-size:14.5px;">
          <li>Персональный план адаптации по должности и филиалу (30/60/90 дней).</li>
          <li>Ответы 24/7 со ссылками на первоисточник в базе знаний регламентов.</li>
          <li>Напоминания о дедлайнах и невыполненных шагах.</li>
          <li>Мини-тесты и проверка усвоения регламентов.</li>
          <li>Сигналы риска для HR/руководителя: просрочки, повторяющиеся вопросы, негатив в опросе.</li>
          <li>Аналитика: time-to-productivity, % прохождения чек-листа, топ-5 вопросов новичков.</li>
        </ol>
      </div>
    </div>
  </section>

  <section id="ai-adaptatsiya-sotrudnikov-boris-block" class="bas-root" aria-label="Дашборд контроля адаптации: статус новичков, риски и эскалация для HR">
<style>
/* === БОРИС: prefix bas-, scoped внутри #ai-adaptatsiya-sotrudnikov-boris-block === */
#ai-adaptatsiya-sotrudnikov-boris-block.bas-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-adaptatsiya-sotrudnikov-boris-block .bas-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-adaptatsiya-sotrudnikov-boris-block .bas-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#7c3aed;
  margin:0 0 14px;
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-ey::before{
  content:'';
  width:18px;height:2px;
  background:#7c3aed;
  border-radius:1px;
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(124,58,237,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#6d28d9;
  margin-top:1px;
  font-style:normal;
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-pl-v{
  background:rgba(124,58,237,.08);
  color:#6d28d9;
  border:1.5px solid rgba(124,58,237,.22);
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-pl-a{
  background:rgba(245,158,11,.08);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.22);
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-adaptatsiya-sotrudnikov-boris-block .bas-rgt{
  position:relative;
  background:linear-gradient(135deg,#faf5ff 0%,#ede9fe 35%,#f0f9ff 70%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-adaptatsiya-sotrudnikov-boris-block .bas-rgt{min-height:380px;}
}
#bas-onboarding-control-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bas-cnt">
  <div class="bas-card">

    <div class="bas-lft">
      <span class="bas-ey">Контроль адаптации</span>
      <h3 class="bas-h3">Пульт HR: статус каждого новичка — до того, как он «потеряется»</h3>
      <ul class="bas-ul">
        <li><span class="bas-ic">◎</span>Прогресс чек-листа 30/60/90 по ролям и филиалам на одном экране</li>
        <li><span class="bas-ic">?</span>RAG-ответы новичкам 24/7 — HR видит топ вопросов и пробелы в регламентах</li>
        <li><span class="bas-ic">⚠</span>Красные флаги: просрочки, повторяющиеся вопросы, низкий NPS — эскалация с контекстом</li>
        <li><span class="bas-ic">↗</span>Руководитель не ждёт Excel: дашборд рисков вместо «на словах у наставника»</li>
      </ul>
      <div class="bas-pills">
        <span class="bas-pl bas-pl-g">78% чек-лист</span>
        <span class="bas-pl bas-pl-v">12 новичков</span>
        <span class="bas-pl bas-pl-a">2 риска</span>
      </div>
      <p class="bas-foot">Дальше — пошаговая схема работы агента →</p>
    </div>

    <div class="bas-rgt">
      <canvas
        id="bas-onboarding-control-canvas"
        aria-label="Анимация: дашборд HR с прогрессом адаптации новичков, RAG-ответом и сигналом эскалации при риске"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bas-onboarding-control-canvas');
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
    line:'rgba(148,163,184,.35)',
    card:'#ffffff',
    cardBdr:'rgba(148,163,184,.45)',
    violet:'#7c3aed',
    violetSoft:'rgba(124,58,237,.12)',
    green:'#22c55e',
    greenSoft:'rgba(34,197,94,.15)',
    amber:'#f59e0b',
    amberSoft:'rgba(245,158,11,.18)',
    red:'#ef4444',
    redSoft:'rgba(239,68,68,.2)',
    blue:'#3b82f6',
    bubble:'#ffffff'
  };

  var ZONES = [
    {label:'День 1–7',   sub:'документы · доступы'},
    {label:'День 8–30',  sub:'обучение · buddy'},
    {label:'День 31–90', sub:'первая смена · KPI'}
  ];

  var HIRES = [
    {name:'Анна К.',  role:'Продавец',   zone:0, prog:0.92, risk:false, color:'#8b5cf6'},
    {name:'Игорь М.', role:'Курьер',     zone:0, prog:0.64, risk:true,  color:'#3b82f6'},
    {name:'Мария С.', role:'Админ',      zone:1, prog:0.78, risk:false, color:'#10b981'},
    {name:'Павел Р.', role:'Оператор',   zone:2, prog:0.55, risk:false, color:'#f59e0b'}
  ];

  var LOOP = 720;
  var qaPhase = 0;
  var escPhase = 0;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawTopBar(){
    rr(12,10,W-24,36,10,'rgba(255,255,255,.85)',C.cardBdr);
    ctx.fillStyle=C.ink;
    ctx.font='bold 13px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Onboarding · дашборд HR',24,32);

    var pulse = 6 + Math.sin(frame*0.08)*2;
    ctx.beginPath();
    ctx.arc(W-72,28,pulse+3,0,Math.PI*2);
    ctx.fillStyle='rgba(34,197,94,'+(0.12+0.06*Math.sin(frame*0.08))+')';
    ctx.fill();
    ctx.beginPath();
    ctx.arc(W-72,28,5,0,Math.PI*2);
    ctx.fillStyle=C.green;
    ctx.fill();
    ctx.fillStyle=C.green;
    ctx.font='11px Inter,system-ui,sans-serif';
    ctx.fillText('live',W-58,32);
  }

  function zoneLayout(){
    var top = 58, pad = 14, gap = 10;
    var zw = (W - pad*2 - gap*2) / 3;
    return {top:top, pad:pad, gap:gap, zw:zw, zh:H-top-pad-52};
  }

  function drawZones(L){
    ZONES.forEach(function(z,i){
      var x = L.pad + i*(L.zw+L.gap);
      rr(x,L.top,L.zw,28,8,C.violetSoft,C.cardBdr,1);
      ctx.fillStyle=C.violet;
      ctx.font='bold 11px Inter,system-ui,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(z.label,x+L.zw/2,L.top+12);
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,system-ui,sans-serif';
      ctx.fillText(z.sub,x+L.zw/2,L.top+23);

      rr(x,L.top+34,L.zw,L.zh-34,12,'rgba(255,255,255,.55)',C.line,1);
    });
  }

  function drawHireCard(h, L, idx){
    var col = h.zone;
    var x = L.pad + col*(L.zw+L.gap) + 8;
    var baseY = L.top + 48 + idx*52;
    var w = L.zw - 16;
    var hCard = 46;
    var slide = Math.sin((frame + idx*40)*0.03)*1.5;

    rr(x, baseY+slide, w, hCard, 10, C.card, C.cardBdr);

    ctx.beginPath();
    ctx.arc(x+18, baseY+slide+23, 12, 0, Math.PI*2);
    ctx.fillStyle=h.color;
    ctx.fill();
    ctx.fillStyle='#fff';
    ctx.font='bold 10px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(h.name.charAt(0),x+18,baseY+slide+27);

    ctx.fillStyle=C.ink;
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText(h.name,x+36,baseY+slide+18);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,system-ui,sans-serif';
    ctx.fillText(h.role,x+36,baseY+slide+32);

    var prog = h.prog + Math.sin(frame*0.02+idx)*0.02;
    if(prog>1) prog=1;
    var bx = x+36, by = baseY+slide+36, bw = w-44, bh = 5;
    rr(bx,by,bw,bh,3,'#e2e8f0');
    rr(bx,by,bw*prog,bh,3,h.risk?C.amber:C.green);

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,system-ui,sans-serif';
    ctx.textAlign='right';
    ctx.fillText(Math.round(prog*100)+'%',x+w-8,baseY+slide+18);

    if(h.risk){
      var rp = 0.5+0.5*Math.sin(frame*0.12);
      ctx.beginPath();
      ctx.arc(x+w-12,baseY+slide+12,7+rp*2,0,Math.PI*2);
      ctx.fillStyle='rgba(239,68,68,'+(0.15+0.1*rp)+')';
      ctx.fill();
      ctx.fillStyle=C.red;
      ctx.font='bold 10px Inter,system-ui,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('!',x+w-12,baseY+slide+16);
    }
  }

  function drawQaBubble(L){
    var t = (frame % LOOP);
    if(t < 180 || t > 420) return;
    var alpha = t<210 ? (t-180)/30 : (t>390 ? (420-t)/30 : 1);
    var bx = L.pad + L.zw + L.gap + 12;
    var by = L.top + 90;

    ctx.globalAlpha = alpha;
    rr(bx,by, L.zw-8, 52, 10, C.bubble, C.violet, 1.5);
    ctx.fillStyle=C.violet;
    ctx.font='bold 9px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('RAG · вопрос новичка',bx+10,by+14);
    ctx.fillStyle=C.ink;
    ctx.font='10px Inter,system-ui,sans-serif';
    ctx.fillText('«Где оформить возврат?»',bx+10,by+28);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,system-ui,sans-serif';
    ctx.fillText('→ регламент §4.2 · уверенность 94%',bx+10,by+42);
    ctx.globalAlpha = 1;
  }

  function drawEscalation(L){
    var t = (frame % LOOP);
    if(t < 480) return;
    var slide = Math.min(1,(t-480)/40);
    var ex = W - 14 - (L.zw*0.9)*(1-slide);
    var ey = H - 58;

    rr(ex,ey, L.zw*0.9, 44, 10, '#fef2f2', C.red, 1.5);
    ctx.fillStyle=C.red;
    ctx.font='bold 10px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('⚠ Эскалация HR',ex+12,ey+16);
    ctx.fillStyle='#991b1b';
    ctx.font='9px Inter,system-ui,sans-serif';
    ctx.fillText('Игорь М. · 2 просрочки · день 5',ex+12,ey+30);
  }

  function drawLegend(){
    var ly = H - 38;
    rr(14,ly,W-28,28,8,'rgba(255,255,255,.7)',C.line,1);
    var items = [
      {c:C.green, t:'в норме'},
      {c:C.amber, t:'риск'},
      {c:C.violet,t:'RAG Q&A'}
    ];
    var lx = 24;
    items.forEach(function(it){
      ctx.beginPath();
      ctx.arc(lx+6,ly+14,5,0,Math.PI*2);
      ctx.fillStyle=it.c;
      ctx.fill();
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,system-ui,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(it.t,lx+16,ly+17);
      lx += 72;
    });
  }

  function loop(){
    frame++;
    ctx.clearRect(0,0,W,H);

    var L = zoneLayout();
    drawTopBar();
    drawZones(L);
    HIRES.forEach(function(h,i){ drawHireCard(h,L,i%2); });
    drawQaBubble(L);
    drawEscalation(L);
    drawLegend();

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>

  <section class="vna-section" id="kak-rabotaet">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Процесс</span>
        <h2>Как работает AI-агент onboarding по шагам</h2>
        <p><strong>Коротко:</strong> событие «новый сотрудник» в HRIS → персональный чек-лист → RAG-ответы и напоминания → эскалация рисков → отчёт на 30/60/90 день.</p>
      </div>
      <div class="vna-steps nero-ai-reveal">
        <div class="vna-step-card"><div class="vna-step-num">Шаг 1</div><h3>Чек-лист по роли</h3><p>Документы, доступы IT, обучение, встречи с buddy, первая смена — новичок видит «следующий шаг».</p></div>
        <div class="vna-step-card"><div class="vna-step-num">Шаг 2</div><h3>RAG по регламентам</h3><p>Ответ только по вашим документам — со ссылкой и датой. При уверенности &lt;85% — эскалация HR.</p></div>
        <div class="vna-step-card"><div class="vna-step-num">Шаг 3</div><h3>Эскалация рисков</h3><p>2+ просрочки, 3+ одинаковых вопроса, негатив NPS — уведомление HR и руководителю с контекстом.</p></div>
        <div class="vna-step-card"><div class="vna-step-num">Шаг 4</div><h3>Дашборд статуса</h3><p>% чек-листа, красные флаги, топ-5 вопросов — руководитель видит статус без Excel.</p></div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Дашборд статуса адаптации для руководителя и HR</h3>
        <p>Главный дифференциатор против «просто чат-бота». На одном экране: статус каждого новичка, просроченные шаги, топ вопросов, сравнение филиалов и ролей.</p>
      </div>
    </div>
  </section>

  <aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-onboarding-check">
    <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Проверьте onboarding до того, как новичок «потеряется»</p>
      <p class="ym-cta-block__sub">Разберём ваш процесс по 1–2 ролям, покажем демо дашборда статуса адаптации и оценим, что закроет AI-агент в первом пилоте. Ориентир — 120–350 тыс. ₽ за MVP. Без обязательств.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить onboarding</a>
    </div>
  </aside>

  <section class="vna-section vna-section-alt" id="dlya-kogo">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Аудитория</span>
        <h2>Для кого: HR, франшизы, розница и сервисные сети</h2>
        <p>HR-департаменты, франшизы, розница, контакт-центры, медицина — везде, где нанимают линейный персонал массово и onboarding повторяемый.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card"><h3>Масштаб без роста штата наставников</h3><p>Формула: <strong>больше найма × тот же штат наставников = провал без автоматизации</strong>. AI-агент даёт единый стандарт и снимает 40–60% типовых обращений к HR. MVP на 1 роли и Telegram — без корпоративного портала.</p></div>
        <div class="vna-card"><h3>Единый стандарт адаптации в филиалах</h3><p>Для франшиз критичен единый стандарт в 10, 50, 200 точках. RBAC: новичок в Москве видит московские регламенты; в Казани — казанские. AI-слой ставится поверх Bitrix24/Huntflow — не с нуля.</p></div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="integracii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Стек</span>
        <h2>Интеграция AI-адаптации с CRM и HRIS</h2>
        <p>Агент должен знать, кто пришёл, на какую роль и в какой филиал — webhook из HRIS запускает агента; статус возвращается в CRM.</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Система</th><th>Роль в onboarding</th></tr></thead>
          <tbody>
            <tr><td><strong>Huntflow</strong></td><td>Воронка найма → событие «принят на работу»</td></tr>
            <tr><td><strong>Bitrix24 HRM</strong></td><td>Карточка сотрудника, задачи, смарт-процессы, Open Lines</td></tr>
            <tr><td><strong>amoCRM</strong></td><td>CRM для сетей с amo-стеком, webhook при найме</td></tr>
            <tr><td><strong>iSpring / Bitrix24 «Курсы»</strong></td><td>LMS-модули в чек-листе</td></tr>
            <tr><td><strong>Telegram / VK</strong></td><td>Канал для полевых сотрудников</td></tr>
            <tr><td><strong>1С:ЗУП</strong></td><td>Учёт персонала через API/коннектор</td></tr>
            <tr><td><strong>Confluence / Google Drive</strong></td><td>Источники для RAG-базы знаний</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="arhitektura">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Архитектура</span>
        <h2>Архитектура решения: от базы знаний до дашборда</h2>
      </div>
      <div class="vna-arch-flow nero-ai-reveal" aria-label="Схема архитектуры">
        <span>HRIS webhook</span><span class="arr">→</span>
        <span>Оркестратор</span><span class="arr">→</span>
        <span>RAG</span><span class="arr">→</span>
        <span>Канал общения</span><span class="arr">→</span>
        <span>Дашборд HR</span>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card"><h3>152-ФЗ и ПДн сотрудников</h3><ul>
          <li>YandexGPT / GigaChat — данные в контуре РФ</li>
          <li>On-prem для строгих политик</li>
          <li>Маскирование ФИО при облачных API</li>
          <li>RBAC в RAG: новичок видит только документы своей роли</li>
        </ul></div>
        <div class="vna-card"><h3>Модули решения <?php echo esc_html($brand); ?></h3><ul>
          <li>Онбординг-оркестратор (state machine)</li>
          <li>RAG с цитированием источника</li>
          <li>Эскалация и human-in-the-loop</li>
          <li>Дашборд HR/руководителя + NPS 7/30/90</li>
          <li>Админка для HR без программиста</li>
        </ul></div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="kpi">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Метрики</span>
        <h2>KPI onboarding: time-to-productivity, текучесть и NPS новичка</h2>
        <p>Измеряйте до и после внедрения — без KPI ai адаптация сотрудников остаётся «ещё одним пилотом».</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>KPI</th><th>Что показывает</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td>Time-to-productivity</td><td>Дней до первой продуктивной задачи</td><td>Кейс Открытой Линии: ×2 быстрее</td></tr>
            <tr><td>90-day turnover</td><td>% ухода в первые 90 дней</td><td>Медиана 3,4%; CC до 14%</td></tr>
            <tr><td>NPS новичка</td><td>Удовлетворённость onboarding</td><td>Опросы на 7/30/90 день</td></tr>
            <tr><td>% чек-листа</td><td>Полнота прохождения шагов</td><td>Цель: 95%+ без просрочек</td></tr>
            <tr><td>Обращения к HR</td><td>Снижение рутины</td><td>−40% в кейсе Открытой Линии</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-flags nero-ai-reveal">
        <div class="vna-flag">2+ просроченных шага в чек-листе</div>
        <div class="vna-flag">3+ одинаковых вопроса — пробел в регламенте</div>
        <div class="vna-flag">Негатив в опросе NPS на 7/30/90 день</div>
        <div class="vna-flag">Молчание: не открывает материалы, не проходит квизы</div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI-адаптации</h2>
      </div>
      <div class="vna-case-grid nero-ai-reveal">
        <div class="vna-case-card"><div class="vna-case-tag">Якорный кейс</div><h3>«Открытая Линия»</h3><p>Oline Наставник на GPT + ML: адаптация <strong>×2</strong>, HR <strong>−40%</strong> нагрузки.</p></div>
        <div class="vna-case-card"><div class="vna-case-tag">RAG</div><h3>Ресторанный холдинг</h3><p>HR-бот на RAG с ролевой изоляцией — ответы со ссылкой на документ, аналитика запросов.</p></div>
        <div class="vna-case-card"><div class="vna-case-tag">Обучение</div><h3>«Купер» + Cleverbots</h3><p>Голосовые AI-тренажёры в треках обучения для линейного персонала в доставке.</p></div>
      </div>
      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-table">
          <thead><tr><th>Решение</th><th>Что делает</th><th>Чего не делает</th></tr></thead>
          <tbody>
            <tr><td>LMS (Поток, iSpring)</td><td>Курсы, треки, геймификация</td><td>Q&A по регламентам, дашборд рисков</td></tr>
            <tr><td>Чат-бот FAQ</td><td>Ответы на типовые вопросы</td><td>Чек-лист, эскалация, KPI</td></tr>
            <tr><td>HRIS (Bitrix24 HRM)</td><td>Карточка, задачи, процессы</td><td>Интеллектуальные ответы 24/7</td></tr>
            <tr><td><strong>AI-агент адаптации</strong></td><td>Оркестрация + RAG + контроль</td><td>Замена HR и наставников</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="vna-section" id="ceny">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Стоимость</span>
        <h2>Стоимость внедрения AI-агента адаптации</h2>
      </div>
      <div class="vna-card nero-ai-reveal" style="text-align:center;max-width:720px;margin:0 auto;">
        <span class="vna-price-band">120–350 тыс. ₽</span>
        <h3>Фокусный MVP</h3>
        <p>1–2 роли · Telegram или Bitrix24 · RAG на регламентах · чек-лист 30/60/90 · дашборд рисков · пилот на 10–20 новичках.</p>
        <p style="margin-top:16px;font-size:14px;">ROI: −40% нагрузки HR, ×2 time-to-productivity, снижение 90-day turnover. Ниже turnkey-рынка 1,5–4 млн ₽ у крупных интеграторов.</p>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Внедрение</span>
        <h2>Этапы внедрения под ключ</h2>
        <p><strong>Срок:</strong> 4–8 недель. <strong>Сложность:</strong> 6/10.</p>
      </div>
      <div class="vna-timeline nero-ai-reveal">
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Дни 1–5: Аудит</h3><p>Карта адаптации по 2–3 ролям; список систем; KPI «как сейчас».</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Дни 6–20: Настройка</h3><p>RAG, ролевые чек-листы, правила эскалации; HR редактирует БЗ без программиста.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Дни 21–35: Пилот</h3><p>10–20 новичков; калибровка промптов; human-in-the-loop.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Дни 36–56: Передача</h3><p>Runbook, обучение HR-админа, <strong>30 дней warranty</strong>.</p></div>
      </div>
    </div>
  </section>

  <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie-hr">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">HR-админу проще сопровождать агента, если команда понимает основы</p>
      <p class="ym-cta-block__sub">Перед пилотом полезно разобраться в RAG, чек-листах и human-in-the-loop — посмотрите <?php if ($secondary_cta_link) : ?><a href="<?php echo esc_url($secondary_cta_link); ?>" class="ym-link ym-link--accent"<?php echo $secondary_cta_attrs; ?>>обучение по внедрению AI в бизнес-процессы</a><?php else : ?>обучение по внедрению AI в бизнес-процессы<?php endif; ?>. Это ускоряет приёмку на этапе «без программиста на стороне клиента».</p>
    </div>
  </aside>

  <section class="vna-section" id="karta-adaptacii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Лид-магнит</span>
        <h2>Карта адаптации сотрудника — лид-магнит</h2>
        <p>Шаблон 30/60/90 по ролям: что должен знать и уметь новичок в каждый период.</p>
      </div>
      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-karta-adaptacii">
        <div class="ym-cta-block__icon" aria-hidden="true">🗺️</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Скачайте «Карту адаптации сотрудника»</p>
          <p class="ym-cta-block__sub">Шаблон 30/60/90 по ролям: чек-лист, контрольные точки руководителя, KPI успешной адаптации. Заполните до аудита — мы покажем, как AI-агент «оживляет» карту в дашборде.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить карту адаптации</a>
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost"<?php echo $primary_cta_attrs; ?>>Проверить onboarding</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">FAQ</span>
        <h2>FAQ по AI-адаптации сотрудников</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai адаптацию сотрудников?</div><div class="vna-faq-a"><p>Аудит onboarding → оцифровка регламентов в RAG → чек-листы по ролям → интеграция с HRIS → пилот на 10–20 новичках → масштабирование. <?php echo esc_html($brand); ?> ведёт все этапы под ключ.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai адаптация сотрудников?</div><div class="vna-faq-a"><p>Ориентир <strong>120–350 тыс. ₽</strong> за MVP (1–2 роли, Telegram/Bitrix24, RAG, чек-лист, дашборд). Расширенные проекты — по смете после аудита.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли для малого бизнеса?</div><div class="vna-faq-a"><p>Да. MVP на одной роли и Telegram — без корпоративного портала. Критично: повторяемый onboarding и хотя бы 5–10 новичков в квартал.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли программист для интеграции?</div><div class="vna-faq-a"><p>На этапе сопровождения — нет: HR редактирует чек-листы и БЗ в админке. Первичная интеграция (webhook, CRM) — на стороне <?php echo esc_html($brand); ?>.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Как защищаются персональные данные сотрудников?</div><div class="vna-faq-a"><p>152-ФЗ: YandexGPT/GigaChat в контуре РФ, on-prem, маскирование ПДн, RBAC в RAG, политика логов. Согласие на обработку ПДн — в пакете документов при внедрении.</p></div></div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="cta-final">
    <div class="vna-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final-block">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить onboarding — следующий шаг</p>
          <p class="ym-cta-block__sub">Аудит процесса, демо дашборда рисков, расчёт ROI. Внедрение под ключ от 120 тыс. ₽, 4–8 недель, warranty 30 дней. <strong>62%</strong> компаний экспериментируют с AI-агентами; HR onboarding — окно раннего входа.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить onboarding</a>
        </div>
      </div>
    </div>
  </section>

<?php if ($ad_banner_url && $ad_banner_image) : ?>
  <div class="vna-cnt" style="padding-bottom:48px;text-align:center;">
    <a href="<?php echo esc_url($ad_banner_url); ?>" target="_blank" rel="noopener noreferrer">
      <img src="<?php echo esc_url($ad_banner_image); ?>" width="970" height="90" alt="<?php echo esc_attr($ad_banner_alt); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;">
    </a>
  </div>
<?php endif; ?>

</div><!-- /.vna-content -->


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
  var root = document.querySelector('.ai-adaptatsiya-sotrudnikov-page');
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
/**
 * aas-onboarding-hero-engine — «Мостик адаптации» HR Navigation Bridge
 * Мир: таймлайн 30/60/90 → пульт статуса → RAG-орбита → эскалация риска HR
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aas-onboarding-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 220;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 440, ch / 240) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    deckBase: "#1e293b",
    deckAccent: "#79f2ff",
    deckGreen: "#22c55e",
    deckAmber: "#fbbf24",
    deckRed: "#fb7185",
    arcLine: "rgba(121,242,255,0.28)",
    arcGlow: "rgba(139,92,246,0.38)",
    chipBg: "#a7f3d0",
    ragOrb: "rgba(139,92,246,0.55)",
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

  /* Дуговой таймлайн — транспорт чек-лист-токенов */
  function MilestoneArcBridge() {
    this.phase = 0;
  }
  MilestoneArcBridge.prototype.draw = function (ctx) {
    this.phase = (frame * 0.022) % (Math.PI * 2);
    var milestones = ["D1", "D7", "D30", "D90"];
    ctx.save();
    ctx.strokeStyle = C.arcGlow;
    ctx.lineWidth = 2.5;
    ctx.setLineDash([5, 7]);
    ctx.lineDashOffset = -frame * 0.35;
    ctx.beginPath();
    ctx.arc(-30, 10, 115, Math.PI * 0.15, Math.PI * 0.85);
    ctx.stroke();
    ctx.strokeStyle = C.arcLine;
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.arc(-30, 10, 85, Math.PI * 0.2, Math.PI * 0.8);
    ctx.stroke();
    ctx.setLineDash([]);
    milestones.forEach(function (label, i) {
      var t = 0.2 + i * 0.2;
      var ang = Math.PI * (0.15 + t * 0.7);
      var mx = -30 + Math.cos(ang) * 100;
      var my = 10 + Math.sin(ang) * 55;
      drawRR(ctx, mx - 14, my - 8, 28, 16, 5, "rgba(255,255,255,0.08)", C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, mx, my + 3);
    });
    ctx.restore();

    for (var j = 0; j < 4; j++) {
      var tp = (this.phase + j * 1.57) % (Math.PI * 2);
      var norm = (tp / (Math.PI * 2)) * 0.7 + 0.15;
      var a = Math.PI * (0.15 + norm * 0.7);
      var tx = -30 + Math.cos(a) * 92;
      var ty = 10 + Math.sin(a) * 48;
      drawRR(ctx, tx - 8, ty - 6, 16, 12, 3, j === 3 ? C.deckAmber : C.chipBg, C.outline);
    }
  };

  /* Центральный пульт — вместо WebsiteTerminal */
  function AdaptationCommandDeck() {
    this.progress = 0.78;
    this.riskFlash = 0;
  }
  AdaptationCommandDeck.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -48, -58, 96, 118, 10, C.deckBase, C.outline);

    /* Кольцо прогресса */
    ctx.strokeStyle = "rgba(255,255,255,0.1)";
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.arc(0, -18, 28, 0, Math.PI * 2);
    ctx.stroke();
    var progAng = Math.PI * 2 * this.progress;
    if (prg < 160) this.progress = 0.45 + (prg / 160) * 0.33;
    else this.progress = 0.78 + Math.sin(frame * 0.05) * 0.02;
    ctx.strokeStyle = C.deckGreen;
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.arc(0, -18, 28, -Math.PI / 2, -Math.PI / 2 + progAng);
    ctx.stroke();

    ctx.fillStyle = "#fff";
    ctx.font = "bold 11px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(this.progress * 100) + "%", 0, -14);

    /* Карточка новичка */
    drawRR(ctx, -32, 8, 64, 38, 6, "rgba(121,242,255,0.12)", C.deckAccent);
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.fillText("Анна К. · продавец", 0, 22);
    ctx.font = "7px Inter,sans-serif";
    ctx.fillStyle = "#94a3b8";
    ctx.fillText("День 3 · филиал #12", 0, 34);

    /* Фазы: GUIDE → RAG → SYNC */
    if (prg >= 50 && prg < 110) {
      drawRR(ctx, -70, -45, 36, 14, 4, "rgba(34,197,94,0.2)", C.deckGreen);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("чек-лист", -52, -35);
    }
    if (prg >= 110 && prg < 170) {
      ctx.fillStyle = "rgba(139,92,246,0.35)";
      ctx.beginPath();
      ctx.arc(55, -35, 14 + Math.sin(frame * 0.12) * 2, 0, Math.PI * 2);
      ctx.fill();
    }
    if (prg >= 170 && prg < 220) {
      drawRR(ctx, -28, 52, 56, 14, 4, "rgba(34,197,94,0.18)", C.deckGreen);
      ctx.fillStyle = "#86efac";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("статус → CRM", 0, 62);
    }
  };

  /* RAG-орбита знаний */
  function RegulationRagOrb() {
    this.orbit = 0;
  }
  RegulationRagOrb.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.orbit = (frame * 0.03) % (Math.PI * 2);
    if (prg < 100) return;
    var ox = 62 + Math.cos(this.orbit) * 18;
    var oy = -42 + Math.sin(this.orbit) * 10;
    ctx.fillStyle = C.ragOrb;
    ctx.beginPath();
    ctx.arc(ox, oy, 12, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.deckAccent;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("RAG", ox, oy + 3);
    if (prg > 115 && prg < 155) {
      drawRR(ctx, ox - 42, oy - 28, 84, 16, 5, C.bubbleBg, C.deckAccent);
      ctx.fillStyle = C.bubbleText;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("по регламенту §4.2", ox, oy - 17);
    }
  };

  /* Маяк риска — финал цикла */
  function RiskPulseBeacon() {
    this.pulse = 0;
  }
  RiskPulseBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 88, 18, 34, 26, 6, "rgba(251,113,133,0.12)", C.deckRed);
    ctx.fillStyle = C.deckRed;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("RISK", 105, 35);

    if (prg >= 200) {
      this.pulse = Math.min(1, (prg - 200) / 30);
      var alpha = 0.85 - this.pulse * 0.6;
      ctx.strokeStyle = "rgba(251,113,133," + alpha + ")";
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.arc(0, -18, 34 + this.pulse * 38, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* Панель HR-уведомления */
  function HrNotifierPanel() {
    this.show = 0;
  }
  HrNotifierPanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 210) { this.show = 0; return; }
    this.show = Math.min(1, (prg - 210) / 20);
    var slideY = 70 - this.show * 55;
    ctx.globalAlpha = this.show;
    drawRR(ctx, -58, slideY, 116, 28, 7, "rgba(251,113,133,0.22)", C.deckRed);
    ctx.fillStyle = "#fecdd3";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("⚠ Эскалация HR · просрочка", 0, slideY + 18);
    ctx.globalAlpha = 1;
  };

  /* NPS-бейдж */
  function NpsSurveyBadge() {
    this.tick = 0;
  }
  NpsSurveyBadge.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 130 || prg > 175) return;
    var bounce = Math.sin((prg - 130) * 0.2) * 3;
    drawRR(ctx, -155, -20 + bounce, 40, 18, 5, "rgba(251,191,36,0.18)", C.deckAmber);
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("NPS D7", -135, -8 + bounce);
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

    var nodeTargets = {
      "1_architect": { x: -115, y: 42 },
      "2_seo": { x: -55, y: 58 },
      "3_coder": { x: 5, y: 62 },
      "4_designer": { x: 65, y: 58 },
      "5_deployer": { x: 115, y: 42 }
    };
    var tgt = nodeTargets[this.role] || { x: 0, y: 50 };

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
  entities.push(new MilestoneArcBridge());
  entities.push(new NpsSurveyBadge());
  entities.push(new AdaptationCommandDeck());
  entities.push(new RegulationRagOrb());
  entities.push(new RiskPulseBeacon());
  entities.push(new HrNotifierPanel());
  entities.push(new Agent(-150, 88, C.agentYellow, "1_architect", 20, [
    "Карта 30/60/90 готова", "Роли по филиалам", "Аудит onboarding"
  ]));
  entities.push(new Agent(-85, 98, C.agentGreen, "2_seo", 58, [
    "Чек-лист продавца", "День 7: доступы IT", "Buddy назначен"
  ]));
  entities.push(new Agent(-15, 102, C.agentBlue, "3_coder", 102, [
    "RAG по регламентам", "Цитата из PDF", "RBAC: роль=новичок"
  ]));
  entities.push(new Agent(55, 98, C.agentPink, "4_designer", 148, [
    "Пульс прогресса 78%", "Дашборд для HR", "NPS опрос D7"
  ]));
  entities.push(new Agent(130, 88, C.agentPurple, "5_deployer", 198, [
    "Webhook Huntflow ✓", "Пилот: 10 новичков", "Эскалация в Bitrix24"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 250, maxLife: life || 250 });
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
    if (prg >= 18 && prg < 18.05) createBubble(-110, -30, "1. Новичок в системе");
    if (prg >= 62 && prg < 62.05) createBubble(-60, 10, "2. Чек-лист День 3");
    if (prg >= 118 && prg < 118.05) createBubble(20, -25, "3. Ответ по регламенту");
    if (prg >= 168 && prg < 168.05) createBubble(0, 35, "4. Риск: просрочка");
    if (prg >= 218 && prg < 218.05) createBubble(90, -10, "5. HR уведомлён");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.deckAccent);
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

<!-- SCHEMA-MARKUP:INSERT -->
<!-- INTERNAL-LINKS:INSERT -->

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

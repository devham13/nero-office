<?php
/**
 * Template Name: AI-база знаний для сотрудников: внедрение под ключ
 * Description: SEO-лендинг — корпоративная AI-база знаний с RAG по документам. Кейсы, этапы, цены. Аудит базы знаний бесплатно.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-база знаний для сотрудников: внедрение под ключ';
$page_seo_description = 'Создадим корпоративного AI-помощника по регламентам и документам компании: ответы за секунды вместо поиска по папкам. Кейсы, этапы, цены. Аудит базы знаний бесплатно.';

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
    ['label' => 'Зачем',        'href' => '#intro'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Сценарии',     'href' => '#scenarii'],
    ['label' => 'Кейсы',        'href' => '#keisy'],
    ['label' => 'Этапы',        'href' => '#etapy'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать AI-базу знаний';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Канал про AI и автоматизацию';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: (function_exists('nero_ai_telegram_channel_url') ? nero_ai_telegram_channel_url() : '');

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
.akb-content{
  --akb-bg:#050711;--akb-bg2:#080b17;--akb-bg3:#0a0e1c;
  --akb-surface:rgba(255,255,255,.072);--akb-surface2:rgba(255,255,255,.108);
  --akb-text:#e6edf7;--akb-muted:#9aa8bd;--akb-soft:#c7d2e5;--akb-heading:#fff;
  --akb-border:rgba(255,255,255,.10);--akb-border-s:rgba(255,255,255,.18);
  --akb-accent:#79f2ff;--akb-violet:#8b5cf6;--akb-green:#22c55e;--akb-cyan:#79f2ff;
  --akb-btn-from:#2563eb;--akb-btn-to:#7c3aed;
  --akb-shadow:0 24px 72px rgba(0,0,0,.4);
  --akb-r:18px;--akb-r-lg:24px;
  --akb-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--akb-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.akb-content *,.akb-content *::before,.akb-content *::after{box-sizing:border-box;}
.akb-content a{color:inherit;text-decoration:none;}
.akb-content p{color:var(--akb-muted);line-height:1.72;margin:0 0 1em;}
.akb-content p:last-child{margin-bottom:0;}
.akb-content h2,.akb-content h3,.akb-content h4{
  color:var(--akb-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.akb-content strong{color:var(--akb-soft);}
.akb-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.akb-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--akb-muted);font-size:14.5px;line-height:1.65;
}
.akb-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--akb-accent);font-weight:700;
}

/* Container */
.akb-cnt{
  width:min(var(--akb-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.akb-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.akb-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.akb-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.akb-sh.akb-left{margin-left:0;text-align:left;}
.akb-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.akb-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.akb-sh.akb-left p{margin-left:0;}

/* Eyebrow */
.akb-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--akb-accent);margin-bottom:14px;
}

/* Gradient text */
.akb-gt{
  background:linear-gradient(92deg,#fff 0%,var(--akb-accent) 44%,var(--akb-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.akb-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.akb-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.akb-intro-text{
  position:relative;padding-left:20px;
}
.akb-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--akb-accent),var(--akb-violet));
}
.akb-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--akb-muted);margin-bottom:1em;
}
.akb-intro-text p:last-child{margin-bottom:0;color:var(--akb-soft);}
.akb-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.akb-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.akb-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--akb-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.akb-kpi-card .kl{font-size:11px;font-weight:600;color:var(--akb-muted);line-height:1.4;}
.akb-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .akb-intro-grid{grid-template-columns:1fr;gap:36px;}
  .akb-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .akb-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.akb-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.akb-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.akb-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--akb-surface);border:1px solid var(--akb-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--akb-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.akb-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--akb-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.akb-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--akb-border);border-radius:var(--akb-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.akb-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.akb-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.akb-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .akb-grid-2{grid-template-columns:1fr;}
  .akb-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .akb-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .akb-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.akb-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--akb-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.akb-level-card:hover{transform:translateY(-2px);}
.akb-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--akb-r) var(--akb-r) 0 0;
}
.akb-level-card.l1::before{background:var(--akb-green);}
.akb-level-card.l2::before{background:var(--akb-accent);}
.akb-level-card.l3::before{background:var(--akb-violet);}
.akb-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.akb-level-card.l1 .akb-level-badge{background:rgba(34,197,94,.15);color:var(--akb-green);}
.akb-level-card.l2 .akb-level-badge{background:rgba(121,242,255,.15);color:var(--akb-accent);}
.akb-level-card.l3 .akb-level-badge{background:rgba(139,92,246,.15);color:var(--akb-violet);}
.akb-level-card h3{font-size:17px;margin-bottom:10px;}
.akb-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.akb-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--akb-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.akb-scenario:last-child{margin-bottom:0;}
.akb-scenario:hover{border-color:rgba(121,242,255,.3);}
.akb-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.akb-scenario h3{font-size:17px;margin-bottom:8px;}
.akb-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.akb-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.akb-table{width:100%;border-collapse:collapse;font-size:14px;}
.akb-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--akb-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.akb-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--akb-text);vertical-align:top;
}
.akb-table tr:last-child td{border-bottom:none;}
.akb-table tr:hover td{background:rgba(255,255,255,.03);}
.akb-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.akb-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.akb-stack-layer:last-child{border-bottom:none;}
.akb-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--akb-accent);padding-top:2px;
}
.akb-stack-val{font-size:14.5px;color:var(--akb-text);}
.akb-stack-desc{font-size:13px;color:var(--akb-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.akb-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.akb-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.akb-case-grid{grid-template-columns:1fr;}}
.akb-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.akb-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.akb-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--akb-green);margin-bottom:10px;
}
.akb-case-card h3{font-size:16px;margin-bottom:14px;}
.akb-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.akb-metric{display:flex;align-items:baseline;gap:8px;}
.akb-metric .num{font-size:22px;font-weight:900;color:var(--akb-accent);flex-shrink:0;letter-spacing:-.04em;}
.akb-metric .lbl{font-size:13px;color:var(--akb-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.akb-timeline{position:relative;padding-left:40px;}
.akb-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--akb-accent),var(--akb-violet));
  opacity:.35;border-radius:2px;
}
.akb-tl-item{position:relative;margin-bottom:32px;}
.akb-tl-item:last-child{margin-bottom:0;}
.akb-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--akb-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.akb-tl-item h3{font-size:17px;margin-bottom:8px;}
.akb-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.akb-pricing-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:960px){.akb-pricing-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.akb-pricing-grid{grid-template-columns:1fr;}}
.akb-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.akb-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.akb-price-card.akb-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.akb-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--akb-accent);margin-bottom:10px;
}
.akb-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.akb-price-card .inc{font-size:13px;color:var(--akb-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.akb-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.akb-compare{width:100%;border-collapse:collapse;}
.akb-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--akb-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.akb-compare td{
  padding:13px 16px;font-size:14px;color:var(--akb-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.akb-compare tr:last-child td{border-bottom:none;}
.akb-good{color:var(--akb-green);}
.akb-neutral{color:var(--akb-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.akb-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.akb-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.akb-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--akb-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.akb-faq-q::after{
  content:'▾';font-size:13px;color:var(--akb-accent);
  flex-shrink:0;transition:transform .25s;
}
.akb-faq-item.open .akb-faq-q::after{transform:rotate(180deg);}
.akb-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--akb-muted);line-height:1.72;
}
.akb-faq-item.open .akb-faq-a{max-height:600px;padding:0 24px 20px;}

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
  color:var(--akb-muted);font-size:15px;
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
  background:linear-gradient(135deg,var(--akb-btn-from),var(--akb-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(59,130,246,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--akb-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(121,242,255,.4);background:rgba(59,130,246,.12);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* =====================================================
   CTA FINAL SECTION
   ===================================================== */
.akb-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.akb-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--akb-muted);
}
.akb-cta-checklist li::before{content:'✓';color:var(--akb-green);font-weight:800;}

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

.akb-hero-kb{min-height:100vh;min-height:100dvh;position:relative;}
.akb-inline-cta{font-size:14.5px;color:var(--akb-muted);margin-top:12px;line-height:1.7;}
.ym-link--accent{color:var(--akb-accent)!important;text-decoration:underline!important;}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-baza-znanii-page" role="main" tabindex="-1">

<section class="nero-ai-hero akb-hero-kb" id="hero" aria-labelledby="akb-hero-title">
<style>
/* ── Hero ai-baza-znanii: самодостаточные стили (без CSS темы) ── */
.akb-hero-kb {
  --akb-cyan: #79f2ff;
  --akb-violet: #8b5cf6;
  --akb-green: #22c55e;
  --akb-text: #e6edf7;
  --akb-muted: #9aa8bd;
  --akb-soft: #c7d2e5;
  --akb-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.akb-hero-kb::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.akb-hero-kb::after {
  content: "";
  position: absolute;
  right: 8%;
  top: 12%;
  width: 640px;
  height: 640px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .12), transparent 66%);
  filter: blur(8px);
  animation: akbHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes akbHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.akb-hero-kb .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.akb-hero-kb .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.akb-hero-kb .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.akb-hero-kb .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--akb-cyan) 42%, var(--akb-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.akb-hero-kb .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--akb-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.akb-hero-kb .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--akb-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.akb-hero-kb .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.akb-hero-kb .nero-ai-badge {
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
.akb-hero-kb .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.akb-hero-kb .nero-ai-btn {
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
.akb-hero-kb .nero-ai-btn:hover { transform: translateY(-2px); }
.akb-hero-kb .nero-ai-btn-primary {
  color: #fff !important;
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  box-shadow: 0 18px 42px rgba(59, 130, 246, 0.28);
}
.akb-hero-kb .nero-ai-btn-secondary {
  color: var(--akb-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.akb-hero-kb .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--akb-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.akb-hero-kb .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.akb-hero-kb .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.akb-hero-kb .nero-ai-dots { display: flex; gap: 7px; }
.akb-hero-kb .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.akb-hero-kb .nero-ai-dot:nth-child(1) { background: #fb7185; }
.akb-hero-kb .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.akb-hero-kb .nero-ai-dot:nth-child(3) { background: #34d399; }
.akb-hero-kb .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.akb-hero-kb .nero-ai-window-body { padding: 16px; }
.akb-hero-kb .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.akb-hero-kb .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.akb-hero-kb .nero-ai-live-pill {
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
.akb-hero-kb .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: akbPulse 1.6s infinite;
}
@keyframes akbPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.akb-hero-kb .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.akb-hero-kb .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.akb-hero-kb .nero-ai-metric span {
  display: block;
  color: var(--akb-muted);
  font-size: 11px;
  font-weight: 700;
}
.akb-hero-kb .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.akb-hero-kb .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.akb-hero-kb .akb-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: radial-gradient(ellipse at 30% 45%, rgba(121,242,255,.08), rgba(6,10,24,.92) 72%);
}
.akb-hero-kb #akb-kb-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.akb-hero-kb .nero-ai-task-stream { display: grid; gap: 8px; }
.akb-hero-kb .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.akb-hero-kb .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--akb-cyan);
  font-size: 11px;
  font-weight: 800;
}
.akb-hero-kb .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.akb-hero-kb .nero-ai-task span {
  color: var(--akb-muted);
  font-size: 11px;
}
.akb-hero-kb .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.akb-hero-kb .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
@media (max-width: 1100px) {
  .akb-hero-kb .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .akb-hero-kb .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .akb-hero-kb .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .akb-hero-kb .nero-ai-window-body { padding: 12px; }
  .akb-hero-kb .nero-ai-task { grid-template-columns: 28px 1fr; }
  .akb-hero-kb .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai база знаний</p>
      <h1 id="akb-hero-title">AI-база знаний для сотрудников: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Корпоративный AI-помощник по вашим регламентам и документам — сотрудники находят ответы за секунды, без поиска по папкам и повторных вопросов</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">RAG · по документам</li>
        <li class="nero-ai-badge">Confluence · Drive</li>
        <li class="nero-ai-badge">Bitrix24 · amoCRM</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Собрать AI-базу знаний'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демонстрация корпоративной AI-базы знаний">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-база знаний · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Время ответа</span>
              <strong>~3 сек</strong>
              <small>RAG + rerank</small>
            </div>
            <div class="nero-ai-metric">
              <span>Faithfulness</span>
              <strong>0.89</strong>
              <small>по документам</small>
            </div>
            <div class="nero-ai-metric">
              <span>Документов</span>
              <strong>1000+</strong>
              <small>Confluence · PDF</small>
            </div>
            <div class="nero-ai-metric">
              <span>Поиск</span>
              <strong>−40%</strong>
              <small>времени сотрудников</small>
            </div>
          </div>

          <div class="akb-dash-canvas-wrap" aria-hidden="false">
            <canvas id="akb-kb-hero-canvas" role="img" aria-label="Анимация: вопрос сотрудника проходит RAG-поиск по архиву регламентов и возвращает ответ с цитатой"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий AI-базы знаний">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">?</span>
              <div><strong>Вопрос сотрудника</strong><span>«Как оформить командировку?»</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">получен</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">RAG</span>
              <div><strong>RAG-поиск</strong><span>Hybrid BM25 + dense · top-3 фрагмента</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">поиск</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">§</span>
              <div><strong>Ответ с цитатой регламента</strong><span>§ 4.2 HR-политики · faithfulness 0.89</span></div>
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
 * akb-kb-hero-engine — «Семантический архив знаний»
 * Мир: полки wiki → дуговой поток вопросов → RAG-хаб → карточка ответа с цитатой
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("akb-kb-hero-canvas");
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
    outline: "#94a3b8",
    docWhite: "#f1f5f9",
    docCyan: "#cffafe",
    docViolet: "#ede9fe",
    docGreen: "#d1fae5",
    shelf: "#1e293b",
    hubBase: "#0f172a",
    hubCyan: "#79f2ff",
    hubViolet: "#8b5cf6",
    hubGreen: "#22c55e",
    queryGlow: "rgba(121,242,255,0.65)",
    chunkAmber: "#fde68a",
    gateRed: "rgba(239,68,68,0.55)",
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

  function drawDoc(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, color, C.outline);
    ctx.strokeStyle = "rgba(148,163,184,0.45)";
    ctx.lineWidth = 0.7;
    for (var i = 0; i < 3; i++) {
      ctx.beginPath();
      ctx.moveTo(x - w / 2 + 3, y - h / 2 + 5 + i * 4);
      ctx.lineTo(x + w / 2 - 3, y - h / 2 + 5 + i * 4);
      ctx.stroke();
    }
    if (label) {
      ctx.fillStyle = C.outline;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, x, y + 2);
    }
  }

  /* Полки корпоративных wiki-документов */
  function WikiDocumentShelf() {}
  WikiDocumentShelf.prototype.draw = function (ctx) {
    drawRR(ctx, -168, -72, 52, 88, 5, "rgba(30,41,59,0.55)", C.outline);
    var docs = [
      { x: -152, y: -58, c: C.docCyan, l: "CF" },
      { x: -142, y: -48, c: C.docWhite, l: "" },
      { x: -152, y: -38, c: C.docViolet, l: "HR" },
      { x: -142, y: -28, c: C.docGreen, l: "" },
      { x: -152, y: -18, c: C.docWhite, l: "PDF" }
    ];
    docs.forEach(function (d) { drawDoc(ctx, d.x, d.y, 14, 18, d.c, d.l); });
    ctx.fillStyle = C.hubCyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Wiki", -165, -78);

    var prg = (frame * 0.035) % 260;
    if (prg >= 8 && prg < 55) {
      var glow = 0.25 + Math.sin(frame * 0.1) * 0.15;
      ctx.strokeStyle = "rgba(121,242,255," + glow + ")";
      ctx.lineWidth = 1.2;
      ctx.strokeRect(-166, -74, 48, 84);
    }
  };

  /* Дуговой поток вопросов — вместо Conveyor */
  function SemanticQueryStream() {
    this.queries = [
      { t0: 0, text: "?" },
      { t0: 85, text: "?" },
      { t0: 170, text: "?" }
    ];
  }
  SemanticQueryStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    var paths = [
      { sx: -155, sy: 20, cx: -60, cy: -35, ex: -8, ey: -5 },
      { sx: -155, sy: 35, cx: -40, cy: 10, ex: 0, ey: 0 },
      { sx: -155, sy: 50, cx: -50, cy: 45, ex: 8, ey: 8 }
    ];
    paths.forEach(function (p, idx) {
      ctx.strokeStyle = "rgba(121,242,255,0.18)";
      ctx.lineWidth = 1;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(p.sx, p.sy);
      ctx.quadraticCurveTo(p.cx, p.cy, p.ex, p.ey);
      ctx.stroke();
      ctx.setLineDash([]);
    });

    this.queries.forEach(function (q, i) {
      var local = (prg + q.t0) % 260;
      if (local > 75) return;
      var t = local / 75;
      var p = paths[i % paths.length];
      var bx = (1 - t) * (1 - t) * p.sx + 2 * (1 - t) * t * p.cx + t * t * p.ex;
      var by = (1 - t) * (1 - t) * p.sy + 2 * (1 - t) * t * p.cy + t * t * p.ey;
      ctx.fillStyle = C.queryGlow;
      ctx.beginPath();
      ctx.arc(bx, by, 5 + Math.sin(frame * 0.08) * 1.5, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("?", bx, by + 2);
    });
  };

  /* RBAC-шлюз доступа */
  function AccessControlGate() {}
  AccessControlGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    drawRR(ctx, -58, 28, 22, 38, 4, "rgba(15,23,42,0.7)", C.outline);
    ctx.fillStyle = prg >= 25 && prg < 240 ? C.hubGreen : C.gateRed;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("RBAC", -47, 42);
    if (prg >= 30 && prg < 235) {
      ctx.strokeStyle = "rgba(34,197,94,0.45)";
      ctx.lineWidth = 1;
      ctx.strokeRect(-56, 30, 18, 34);
    }
  };

  /* Центральный RAG-хаб — вместо WebsiteTerminal */
  function RagRetrievalHub() {
    this.pulse = 0;
    this.chunks = [];
  }
  RagRetrievalHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    this.pulse = 0.5 + Math.sin(frame * 0.06) * 0.25;

    /* Шестигранник-хаб */
    ctx.save();
    ctx.translate(0, -8);
    ctx.beginPath();
    for (var i = 0; i < 6; i++) {
      var ang = (Math.PI / 3) * i - Math.PI / 6;
      var hx = Math.cos(ang) * 38;
      var hy = Math.sin(ang) * 38;
      if (i === 0) ctx.moveTo(hx, hy);
      else ctx.lineTo(hx, hy);
    }
    ctx.closePath();
    ctx.fillStyle = C.hubBase;
    ctx.fill();
    ctx.strokeStyle = C.hubCyan;
    ctx.lineWidth = 1.8;
    ctx.stroke();

    /* Ядро */
    ctx.fillStyle = "rgba(121,242,255," + (0.15 + this.pulse * 0.2) + ")";
    ctx.beginPath();
    ctx.arc(0, 0, 14 + this.pulse * 4, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("RAG", 0, 3);
    ctx.restore();

    /* Фаза retrieve: фрагменты летят в хаб */
    if (prg >= 55 && prg < 145) {
      var chunks = [
        { ox: -120, oy: -20, delay: 0 },
        { ox: -100, oy: 10, delay: 12 },
        { ox: -130, oy: 35, delay: 24 }
      ];
      chunks.forEach(function (ch) {
        var cp = Math.min(1, Math.max(0, (prg - 55 - ch.delay) / 35));
        if (cp <= 0) return;
        var fx = ch.ox + (0 - ch.ox) * cp;
        var fy = ch.oy + (-8 - ch.oy) * cp;
        drawRR(ctx, fx - 10, fy - 6, 20, 12, 2, C.chunkAmber, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("chunk", fx, fy + 2);
      });
    }

    /* Фаза generate: орбита embeddings */
    if (prg >= 120 && prg < 210) {
      for (var e = 0; e < 8; e++) {
        var ea = (frame * 0.04 + e * (Math.PI / 4));
        var er = 52 + Math.sin(frame * 0.05 + e) * 6;
        ctx.fillStyle = "rgba(139,92,246," + (0.35 + Math.sin(ea) * 0.2) + ")";
        ctx.beginPath();
        ctx.arc(Math.cos(ea) * er, -8 + Math.sin(ea) * er * 0.55, 2.5, 0, Math.PI * 2);
        ctx.fill();
      }
    }
  };

  /* Гибридный луч BM25 + dense */
  function HybridSearchBeam() {}
  HybridSearchBeam.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    if (prg < 50 || prg > 130) return;
    var alpha = prg < 90 ? (prg - 50) / 40 : 1 - (prg - 90) / 40;
    ctx.strokeStyle = "rgba(121,242,255," + (alpha * 0.6) + ")";
    ctx.lineWidth = 1.5;
    ctx.setLineDash([4, 3]);
    ctx.beginPath();
    ctx.moveTo(-145, 0);
    ctx.lineTo(-12, -8);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle = C.hubCyan;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.globalAlpha = alpha;
    ctx.fillText("BM25+dense", -78, -12);
    ctx.globalAlpha = 1;
  };

  /* Карточка ответа с цитатой — финал цикла */
  function CitationAnswerCard() {}
  CitationAnswerCard.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    if (prg < 185) return;
    var pop = Math.min(1, (prg - 185) / 22);
    ctx.save();
    ctx.globalAlpha = pop;
    ctx.translate(118, -12);

    drawRR(ctx, -52, -42, 104, 78, 8, "rgba(15,23,42,0.92)", C.hubCyan);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Ответ AI", -44, -28);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("Командировка: заявка", -44, -16);
    ctx.fillText("за 5 дней до выезда", -44, -8);

    drawRR(ctx, -44, 4, 88, 14, 3, "rgba(121,242,255,0.15)", C.hubCyan);
    ctx.fillStyle = C.hubCyan;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillText("§ 4.2 HR-регламент", -40, 14);

    if (prg >= 210) {
      ctx.strokeStyle = C.hubGreen;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(38, -32, 8, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = C.hubGreen;
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("✓", 38, -29);
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.fillText("0.89", 38, -18);
    }
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
    var prg = (frame * 0.035) % 260;
    var isMoving = false;
    var orbitTargets = {
      "1_architect": { x: -95, y: 55, angle: 0 },
      "2_seo": { x: -35, y: 62, angle: 1.2 },
      "3_coder": { x: 35, y: 62, angle: 2.4 },
      "4_designer": { x: 95, y: 55, angle: 3.6 },
      "5_deployer": { x: 0, y: 72, angle: 4.8 }
    };
    var tgt = orbitTargets[this.role] || { x: 0, y: 60 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
      var local = prg - this.stepTrig;
      var orbitR = 8;
      var ox = tgt.x + Math.cos(this.timer * 2 + tgt.angle) * orbitR;
      var oy = tgt.y + Math.sin(this.timer * 2 + tgt.angle) * orbitR * 0.5;
      if (local < 14) {
        isMoving = true;
        this.x = this.baseX + (ox - this.baseX) * (local / 14);
        this.y = this.baseY + (oy - this.baseY) * (local / 14);
      } else if (local < 22) {
        this.x = ox; this.y = oy;
      } else {
        isMoving = true;
        this.x = ox - (ox - this.baseX) * ((local - 22) / 6);
        this.y = oy - (oy - this.baseY) * ((local - 22) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 230);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.1;
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
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new WikiDocumentShelf());
  entities.push(new SemanticQueryStream());
  entities.push(new AccessControlGate());
  entities.push(new HybridSearchBeam());
  entities.push(new RagRetrievalHub());
  entities.push(new CitationAnswerCard());
  entities.push(new Agent(-125, 88, C.agentYellow, "1_architect", 15, [
    "Инвентаризация Confluence", "Карта регламентов HR", "Аудит дублей wiki"
  ]));
  entities.push(new Agent(-62, 92, C.agentGreen, "2_seo", 55, [
    "Chunking 512 токенов", "Метаданные отдела", "Версия регламента v3"
  ]));
  entities.push(new Agent(0, 95, C.agentBlue, "3_coder", 105, [
    "BM25 + e5-large", "Rerank top-3", "Faithfulness eval"
  ]));
  entities.push(new Agent(62, 92, C.agentPink, "4_designer", 155, [
    "UI цитаты источника", "RBAC до поиска", "Zero-result alert"
  ]));
  entities.push(new Agent(125, 88, C.agentPurple, "5_deployer", 205, [
    "Webhook Bitrix24", "Telegram-бот запущен", "Analytics 👍/👎"
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

    var prg = (frame * 0.035) % 260;
    if (prg >= 12 && prg < 12.05) createBubble(-130, -40, "1. Индекс wiki");
    if (prg >= 58 && prg < 58.05) createBubble(-40, -50, "2. Hybrid retrieval");
    if (prg >= 128 && prg < 128.05) createBubble(10, -45, "3. Embeddings rerank");
    if (prg >= 188 && prg < 188.05) createBubble(90, -20, "4. Ответ с цитатой");
    if (prg >= 228 && prg < 228.05) createBubble(0, 65, "5. Faithfulness 0.89 ✓");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      drawRR(ctx, b.x - (ctx.measureText(b.text).width + 14) / 2, b.y - 22, ctx.measureText(b.text).width + 14, 18, 5, C.bubbleBg, C.hubCyan);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
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

<!-- ====================================================
     КОНТЕНТНАЯ ЧАСТЬ (после hero Алины) — prefix akb-
     Переменные: $primary_cta_url, $primary_cta_label, $primary_cta_attrs
     Опционально: $secondary_cta_url, $secondary_cta_label (SECONDARY_CTA_* env)
     ==================================================== -->
<div class="akb-content">

  <!-- INTRO -->
  <section class="akb-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="akb-cnt nero-ai-container">
      <div class="akb-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="akb-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai база знаний</p>
          <p><strong>Коротко:</strong> AI-база знаний — корпоративный AI-помощник, который отвечает сотрудникам по регламентам, инструкциям и внутренним документам компании на основе RAG. Сотрудник задаёт вопрос на естественном языке — система находит релевантный фрагмент и формирует ответ с цитатой или ссылкой на источник.</p>
          <p>Если в компании накопились регламенты и папки с инструкциями, знакомая картина неизбежна: человек ищет ответ в Confluence, SharePoint, Google Drive, чатах и у коллег — и всё равно не уверен, что нашёл актуальную версию. Nero Network создаёт <strong>корпоративного AI-помощника по документам компании</strong> — с внедрением под ключ, интеграцией в Telegram, Bitrix24, amoCRM и опорой на российские LLM при требованиях 152-ФЗ.</p>
          <!-- INTERNAL-LINKS:INSERT -->
        </div>
        <div class="akb-intro-kpi" aria-label="Ключевые показатели">
          <div class="akb-kpi-card">
            <div class="kv">20%</div>
            <div class="kl">рабочего времени на поиск</div>
            <div class="ks">McKinsey, цит. РБК</div>
          </div>
          <div class="akb-kpi-card">
            <div class="kv">30–40%</div>
            <div class="kl">повторных вопросов</div>
            <div class="ks">Epsilon Metrics</div>
          </div>
          <div class="akb-kpi-card">
            <div class="kv"><span class="akb-gt">~3 сек</span></div>
            <div class="kl">ответ по регламенту</div>
            <div class="ks">кейс RAG + Bitrix24</div>
          </div>
          <div class="akb-kpi-card">
            <div class="kv"><span class="akb-gt">0.89</span></div>
            <div class="kl">faithfulness ответов</div>
            <div class="ks">production RAG</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="akb-toc-outer">
    <div class="akb-cnt">
      <nav class="akb-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что такое</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#keisy">Кейсы</a>
        <a href="#etapy">Этапы</a>
        <a href="#ceny">Цены</a>
        <a href="#faq">FAQ</a>
        <a href="#cta-final">Заказать</a>
      </nav>
    </div>
  </div>

  <!-- ЧТО ТАКОЕ -->
  <section class="akb-section" id="chto-takoe">
    <div class="akb-cnt">
      <div class="akb-sh">
        <span class="akb-eyebrow">Определение</span>
        <h2>Что такое AI-база знаний и чем она отличается от обычной wiki</h2>
        <p><strong>AI-база знаний для компании</strong> — система, где языковая модель отвечает на вопросы строго по внутренним документам, а не «из головы». Это слой поверх wiki: сотрудник спрашивает — AI находит фрагмент и формулирует ответ.</p>
      </div>

      <div class="akb-table-wrap nero-ai-reveal">
        <table class="akb-table">
          <thead>
            <tr>
              <th>Критерий</th>
              <th>Обычная wiki / SharePoint</th>
              <th>AI-база знаний (RAG)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Поиск</td>
              <td>По ключевым словам, нужно читать статьи</td>
              <td>Вопрос на естественном языке → готовый ответ</td>
            </tr>
            <tr>
              <td>Скорость</td>
              <td>Минуты и часы</td>
              <td>Секунды (в кейсах — ~3 сек.)</td>
            </tr>
            <tr>
              <td>Актуальность</td>
              <td>Зависит от дисциплины авторов</td>
              <td>Индексация + контроль версий</td>
            </tr>
            <tr>
              <td>Онбординг</td>
              <td>«Иди читай 50 статей»</td>
              <td>Ответы по конкретным сценариям</td>
            </tr>
            <tr>
              <td>Риск ошибки</td>
              <td>Устаревший документ</td>
              <td>Ответ с цитатой + «данных недостаточно»</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="akb-grid-2 nero-ai-reveal" style="margin-top:32px;">
        <div class="akb-card">
          <h3>Как AI отвечает по вашим документам (RAG)</h3>
          <p><strong>RAG (Retrieval-Augmented Generation)</strong> — стандартная архитектура AI-базы знаний в 2026 году:</p>
          <ul>
            <li>Документы загружаются из Confluence, Drive, PDF и др.</li>
            <li>Текст разбивается на фрагменты (chunking) и индексируется (embeddings)</li>
            <li>По запросу — гибридный поиск (semantic + keyword + rerank)</li>
            <li>LLM формирует ответ только на основе найденных фрагментов — с цитатой</li>
          </ul>
          <p>Схема для сотрудника: <strong>вопрос → поиск по индексу → ответ с цитатой из регламента</strong>.</p>
        </div>
        <div class="akb-card">
          <h3>Кому нужна AI-база знаний: HR, поддержка, продажи, операции</h3>
          <p>Особенно полезна компаниям от <strong>30–50+ сотрудников</strong> с большим объёмом регламентов:</p>
          <ul>
            <li><strong>HR</strong> — ТК, политики, онбординг, отпуска</li>
            <li><strong>IT и поддержка</strong> — доступы, типовые инциденты</li>
            <li><strong>Продажи</strong> — скрипты, продукты, возражения</li>
            <li><strong>Операции</strong> — технические регламенты, compliance</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ПРОБЛЕМЫ -->
  <section class="akb-section akb-section-alt" id="problemy">
    <div class="akb-cnt">
      <div class="akb-sh">
        <span class="akb-eyebrow">Боли бизнеса</span>
        <h2>Почему сотрудники теряют время на поиск информации</h2>
        <p>Классическая корпоративная база знаний без AI решает задачу хранения, но не задачу быстрого получения ответа.</p>
      </div>

      <div class="nero-ai-reveal">
        <div class="akb-scenario">
          <div class="akb-sc-icon" aria-hidden="true">💬</div>
          <div>
            <h3>Повторяющиеся вопросы коллегам и в чаты</h3>
            <p><strong>30–40% обращений</strong> — одни и те же вопросы (Epsilon Metrics). Сотрудники пишут в общие чаты, отвлекают экспертов, ждут ответа часами. AI-автоматизация закрывает типовые запросы за секунды — с ссылкой на пункт регламента.</p>
          </div>
        </div>
        <div class="akb-scenario">
          <div class="akb-sc-icon" aria-hidden="true">📁</div>
          <div>
            <h3>Устаревшие регламенты и разрозненные папки</h3>
            <p>Знания живут в Confluence, SharePoint, Notion, Drive и «головах» ключевых людей. Без единого источника ROI от GenAI «буксует». Эксперты Minervasoft: <em>«Если сотрудник не может быстро найти ответ, то ИИ-помощник тем более не справится»</em> (TAdviser, 2025).</p>
          </div>
        </div>
        <div class="akb-scenario">
          <div class="akb-sc-icon" aria-hidden="true">🎓</div>
          <div>
            <h3>Долгий онбординг новых сотрудников</h3>
            <p>Новый сотрудник неделями «раскапывает» документацию. AI-онбординг даёт ответы по конкретным сценариям: «как оформить командировку», «какой SLA у клиента X» — без чтения десятков статей.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- КАК РАБОТАЕТ -->
  <section class="akb-section" id="kak-rabotaet">
    <div class="akb-cnt">
      <div class="akb-sh">
        <span class="akb-eyebrow">Архитектура</span>
        <h2>Как работает корпоративная AI-база знаний</h2>
        <p>Внедрение и настройка AI-базы знаний в Nero Network строятся на проверенной production-архитектуре.</p>
      </div>

      <div class="akb-card nero-ai-reveal">
        <h3 style="font-size:20px;margin-bottom:16px;">Подключение источников: Confluence, SharePoint, Google Drive, Notion, wiki, 1С</h3>
        <div class="akb-stack">
          <div class="akb-stack-layer">
            <span class="akb-stack-label">Wiki</span>
            <div>
              <div class="akb-stack-val">Confluence, SharePoint, Яндекс Вики, Notion</div>
              <div class="akb-stack-desc">Корпоративные статьи и регламенты через API</div>
            </div>
          </div>
          <div class="akb-stack-layer">
            <span class="akb-stack-label">Файлы</span>
            <div>
              <div class="akb-stack-val">Google Drive, локальные папки, PDF, DOCX</div>
              <div class="akb-stack-desc">OCR для сканов, метаданные: отдел, версия</div>
            </div>
          </div>
          <div class="akb-stack-layer">
            <span class="akb-stack-label">CRM / ERP</span>
            <div>
              <div class="akb-stack-val">Bitrix24, amoCRM, 1С-выгрузки</div>
              <div class="akb-stack-desc">Скрипты продаж, карточки, справочники</div>
            </div>
          </div>
        </div>
      </div>

      <div class="akb-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="akb-card">
          <h3>Chunking, embeddings и права доступа</h3>
          <ul>
            <li><strong>Chunking</strong> — разбиение с сохранением контекста</li>
            <li><strong>Embeddings</strong> — GigaChat, BGE-M3, e5 для семантики</li>
            <li><strong>RBAC</strong> — фильтрация документов до поиска (permission-aware retrieval)</li>
          </ul>
          <p>Данные <strong>не используются для обучения</strong> публичных моделей — только inference в вашем контуре.</p>
        </div>
        <div class="akb-card">
          <h3>Актуализация документов и контроль версий</h3>
          <ul>
            <li>Автопереиндексация через Make/n8n + webhook из Drive/Confluence</li>
            <li>Владельцы знаний по отделам (KCS-подход)</li>
            <li>Мониторинг zero-result queries — сигнал нехватки регламента</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- СЦЕНАРИИ -->
  <section class="akb-section akb-section-alt" id="scenarii">
    <div class="akb-cnt">
      <div class="akb-sh">
        <span class="akb-eyebrow">Сценарии использования</span>
        <h2>5 сценариев AI-базы знаний в компании</h2>
        <p>AI-база знаний работает там, где сотрудник уже задаёт вопросы — не в отдельном «ещё одном портале».</p>
      </div>

      <div class="nero-ai-reveal">
        <div class="akb-scenario">
          <div class="akb-sc-icon" aria-hidden="true">👥</div>
          <div>
            <h3>HR и онбординг: ответы по регламентам</h3>
            <p>Новый сотрудник спрашивает про отпуск, ДМС, политики — AI отвечает по актуальным HR-документам. Снижает нагрузку на HR-менеджеров и ускоряет адаптацию.</p>
          </div>
        </div>
        <div class="akb-scenario">
          <div class="akb-sc-icon" aria-hidden="true">🛠</div>
          <div>
            <h3>Поддержка сотрудников и IT-helpdesk</h3>
            <p>Типовые запросы по доступам, VPN, оборудованию закрываются автоматически. При низкой уверенности — эскалация в Service Desk с черновиком ответа.</p>
          </div>
        </div>
        <div class="akb-scenario">
          <div class="akb-sc-icon" aria-hidden="true">📈</div>
          <div>
            <h3>Продажи: скрипты, продукты, возражения</h3>
            <p>Менеджер в amoCRM или Bitrix24 получает подсказку по продукту и регламенту скидок — по аналогии с кейсом Jivo + GigaChat (~90% точность подсказок).</p>
          </div>
        </div>
        <div class="akb-scenario">
          <div class="akb-sc-icon" aria-hidden="true">⚙️</div>
          <div>
            <h3>Операции и compliance: инструкции без ошибок</h3>
            <p>Инженеры получают ответ по техническим документам. В кейсе Epsilon Metrics — ~1000 документов из 7 источников, ответ <strong>за ~3 секунды</strong> с ссылкой на источник.</p>
          </div>
        </div>
        <div class="akb-scenario">
          <div class="akb-sc-icon" aria-hidden="true">↗</div>
          <div>
            <h3>Эскалация к человеку, если AI не уверен</h3>
            <p>Production-система не «выдумывает»: при низкой релевантности — «данных недостаточно» + маршрутизация эксперту. Faithfulness в кейсе Epsilon Metrics — <strong>0.89</strong>.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA после сценариев -->
  <div class="akb-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-scenarii">
      <div class="ym-cta-block__icon" aria-hidden="true">📚</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Нужна AI-база знаний для вашей команды?</p>
        <p class="ym-cta-block__sub">Подключим Confluence, Drive, Bitrix24 или amoCRM — сотрудники получат ответы по регламентам за секунды, с цитатой источника. PoC за 2–3 недели.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <!-- ИНТЕГРАЦИИ -->
  <section class="akb-section" id="integracii">
    <div class="akb-cnt">
      <div class="akb-sh">
        <span class="akb-eyebrow">Интеграции</span>
        <h2>Интеграция AI-базы знаний с CRM и Service Desk</h2>
        <p>Ключ к adoption: сотрудник не идёт в «ещё один сервис».</p>
      </div>

      <div class="akb-table-wrap nero-ai-reveal">
        <table class="akb-table">
          <thead>
            <tr>
              <th>Канал / система</th>
              <th>Сценарий</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>amoCRM, Bitrix24</strong></td>
              <td>Подсказки по регламентам продаж в карточке сделки</td>
            </tr>
            <tr>
              <td><strong>Telegram, VK Teams, MAX</strong></td>
              <td>Вопрос в мессенджере → ответ с цитатой</td>
            </tr>
            <tr>
              <td><strong>Service Desk / Jira</strong></td>
              <td>Автоответ + эскалация тикета</td>
            </tr>
            <tr>
              <td><strong>Intranet / виджет</strong></td>
              <td>Поиск + AI-ответ на портале</td>
            </tr>
            <tr>
              <td><strong>Телефония / Jivo</strong></td>
              <td>Подсказки оператору по базе знаний</td>
            </tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;">Nero Network использует <strong>Make/n8n</strong> как слой автоматизации: переиндексация, webhook, маршрутизация — без «ручного DevOps» на каждое изменение документа.</p>
    </div>
  </section>

  <!-- ПЛАТФОРМЫ VS CUSTOM -->
  <section class="akb-section akb-section-alt" id="platformy-vs-custom">
    <div class="akb-cnt">
      <div class="akb-sh">
        <span class="akb-eyebrow">Выбор подхода</span>
        <h2>Готовое решение или разработка AI-базы знаний под ключ</h2>
        <p>Зависит от зрелости контента, IT-команды и требований безопасности.</p>
      </div>

      <div class="akb-table-wrap nero-ai-reveal">
        <table class="akb-table">
          <thead>
            <tr>
              <th>Подход</th>
              <th>Плюсы</th>
              <th>Минусы</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Готовая платформа</strong> (Яндекс 360, GigaChat Enterprise)</td>
              <td>Быстрый старт, облако</td>
              <td>Ограниченная кастомизация</td>
            </tr>
            <tr>
              <td><strong>SaaS RAG</strong></td>
              <td>Меньше разработки</td>
              <td>Зависимость от вендора, слабый RBAC</td>
            </tr>
            <tr>
              <td><strong>Разработка под ключ</strong> (Nero Network)</td>
              <td>Ваши источники, каналы, 152-ФЗ, метрики</td>
              <td>Проект 1–2 месяца, нужен аудит контента</td>
            </tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;"><strong>Уникальный подход Nero Network:</strong> сначала <strong>аудит базы знаний</strong> (лид-магнит), потом PoC, потом production — контраст с «скормить ChatGPT все PDF».</p>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>

  <!-- БОРИС: RAG-визуализация -->
  <section id="boris-ai-kb-viz" class="bak-root" aria-label="Анимация: сотрудник задаёт вопрос — RAG находит фрагмент регламента — ответ с цитатой">
<style>
/* === БОРИС: prefix bak-, scoped внутри #boris-ai-kb-viz === */
#boris-ai-kb-viz.bak-root{
  padding:clamp(48px,6vw,72px) 0;
  background:#f0f4fb;
}
#boris-ai-kb-viz .bak-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#boris-ai-kb-viz .bak-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:24px;
  overflow:hidden;
  box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(121,242,255,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #boris-ai-kb-viz .bak-card{grid-template-columns:1fr;min-height:auto;}
}
#boris-ai-kb-viz .bak-lft{
  background:#fff;
  padding:44px 40px;
  display:flex;
  flex-direction:column;
  justify-content:center;
}
@media(max-width:600px){#boris-ai-kb-viz .bak-lft{padding:32px 24px;}}
#boris-ai-kb-viz .bak-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;
  color:#0891b2;margin:0 0 14px;
}
#boris-ai-kb-viz .bak-ey::before{
  content:'';display:inline-block;width:20px;height:2px;background:#0891b2;border-radius:1px;
}
#boris-ai-kb-viz .bak-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 20px;
}
#boris-ai-kb-viz .bak-ul{
  list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:10px;
}
#boris-ai-kb-viz .bak-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14.5px;line-height:1.5;color:#334155;
}
#boris-ai-kb-viz .bak-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(8,145,178,.1);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#0891b2;margin-top:1px;font-style:normal;
}
#boris-ai-kb-viz .bak-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;}
#boris-ai-kb-viz .bak-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#boris-ai-kb-viz .bak-pl-c{background:rgba(8,145,178,.08);color:#0e7490;border:1.5px solid rgba(8,145,178,.22);}
#boris-ai-kb-viz .bak-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#boris-ai-kb-viz .bak-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#boris-ai-kb-viz .bak-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
#boris-ai-kb-viz .bak-rgt{
  background:linear-gradient(145deg,#050711 0%,#0a0e1c 55%,#080b17 100%);
  position:relative;overflow:hidden;min-height:420px;
}
@media(max-width:1023px){#boris-ai-kb-viz .bak-rgt{min-height:380px;}}
#bak-kb-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="bak-cnt">
  <div class="bak-card">
    <div class="bak-lft">
      <span class="bak-ey">RAG в действии</span>
      <h3 class="bak-h3">Вопрос сотрудника → фрагмент регламента → ответ за секунды</h3>
      <ul class="bak-ul">
        <li><span class="bak-ic">?</span>Сотрудник спрашивает в Telegram или на портале — на естественном языке</li>
        <li><span class="bak-ic">⌕</span>Hybrid search находит top-K фрагментов с учётом прав доступа</li>
        <li><span class="bak-ic">§</span>LLM формирует ответ только по найденным фрагментам — с цитатой</li>
        <li><span class="bak-ic">↗</span>При низкой уверенности — эскалация эксперту, не галлюцинация</li>
      </ul>
      <div class="bak-pills">
        <span class="bak-pl bak-pl-c">~3 сек ответ</span>
        <span class="bak-pl bak-pl-g">faithfulness 0.89</span>
        <span class="bak-pl bak-pl-v">RBAC до поиска</span>
      </div>
      <p class="bak-foot">Дальше — кейсы внедрения и метрики ROI →</p>
    </div>
    <div class="bak-rgt">
      <canvas id="bak-kb-canvas" role="img" aria-label="Анимация RAG: вопрос сотрудника, поиск по документам, ответ с цитатой регламента"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  var cv = document.getElementById('bak-kb-canvas');
  if (!cv) return;
  var cx = cv.getContext('2d');
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
    cyan:'#79f2ff', green:'#22c55e', viol:'#8b5cf6',
    text:'#e6edf7', muted:'rgba(230,237,247,.45)',
    card:'rgba(255,255,255,.07)', cardB:'rgba(255,255,255,.14)',
    line:'rgba(121,242,255,.25)'
  };

  var DOCS = [
    {x:.18,y:.42,w:.22,h:.14,title:'HR регламент',sub:'§ 4.2 Отпуск'},
    {x:.42,y:.28,w:.22,h:.14,title:'IT wiki',sub:'VPN доступ'},
    {x:.68,y:.38,w:.22,h:.14,title:'Продажи',sub:'Скидки 2026'},
    {x:.32,y:.58,w:.22,h:.14,title:'Compliance',sub:'SLA клиентов'},
    {x:.58,y:.62,w:.22,h:.14,title:'Confluence',sub:'Онбординг'}
  ];
  var hitIdx = 0;
  var LOOP = 540;

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

  function drawDoc(d,i,highlight){
    var x = d.x*W, y = d.y*H, w = d.w*W, h = d.h*H;
    var a = highlight ? 1 : 0.55 + 0.15*Math.sin(fr*.04 + i);
    rr(x,y,w,h,8,'rgba(255,255,255,'+(0.06*a)+')',highlight?'rgba(121,242,255,.55)':'rgba(255,255,255,.12)',highlight?2:1);
    cx.fillStyle = highlight ? C.cyan : C.text;
    cx.font = 'bold 11px Inter,system-ui,sans-serif';
    cx.textAlign = 'left';
    cx.fillText(d.title, x+10, y+18);
    cx.fillStyle = C.muted;
    cx.font = '10px Inter,system-ui,sans-serif';
    cx.fillText(d.sub, x+10, y+32);
  }

  function drawQuestion(alpha){
    var q = 'Как оформить отпуск без ошибок?';
    var bw = Math.min(W-40, 280), bh = 36;
    var bx = 16, by = 14 + (1-alpha)*-8;
    rr(bx,by,bw,bh,10,'rgba(121,242,255,'+(0.12*alpha)+')','rgba(121,242,255,'+(0.35*alpha)+')',1);
    cx.fillStyle = 'rgba(230,237,247,'+alpha+')';
    cx.font = '12px Inter,system-ui,sans-serif';
    cx.textAlign = 'left';
    cx.fillText(q, bx+12, by+22);
  }

  function drawSearchBeam(t){
    var sx = 40, sy = 50;
    var d = DOCS[hitIdx];
    var tx = (d.x + d.w/2)*W, ty = (d.y + d.h/2)*H;
    var prog = Math.min(1, Math.max(0, (t-80)/60));
    cx.strokeStyle = 'rgba(121,242,255,'+(0.15+0.35*prog)+')';
    cx.lineWidth = 2;
    cx.setLineDash([6,6]);
    cx.beginPath();
    cx.moveTo(sx,sy);
    cx.lineTo(sx+(tx-sx)*prog, sy+(ty-sy)*prog);
    cx.stroke();
    cx.setLineDash([]);
    if(prog > 0.85){
      cx.beginPath();
      cx.arc(tx,ty,8+4*Math.sin(fr*.1),0,Math.PI*2);
      cx.fillStyle = 'rgba(121,242,255,.25)';
      cx.fill();
    }
  }

  function drawAnswer(alpha){
    if(alpha <= 0) return;
    var ax = 16, ay = H - 88, aw = Math.min(W-32, 340), ah = 72;
    rr(ax,ay,aw,ah,12,'rgba(34,197,94,'+(0.1*alpha)+')','rgba(34,197,94,'+(0.4*alpha)+')',1.5);
    cx.fillStyle = 'rgba(230,237,247,'+alpha+')';
    cx.font = 'bold 11px Inter,system-ui,sans-serif';
    cx.textAlign = 'left';
    cx.fillText('Ответ AI:', ax+12, ay+18);
    cx.font = '11px Inter,system-ui,sans-serif';
    cx.fillStyle = 'rgba(200,230,247,'+alpha+')';
    var lines = ['Заявление за 14 дней до отпуска.', 'Источник: HR регламент § 4.2'];
    lines.forEach(function(ln,i){ cx.fillText(ln, ax+12, ay+36+i*16); });
  }

  function drawStatus(){
    cx.fillStyle = C.muted;
    cx.font = '10px Inter,system-ui,sans-serif';
    cx.textAlign = 'right';
    cx.fillText('RAG · hybrid search · rerank', W-14, H-12);
  }

  function frame(){
    fr = (fr + 1) % LOOP;
    cx.clearRect(0,0,W,H);

    var phase = fr;
    var qA = phase < 60 ? phase/60 : 1;
    var searchT = phase;
    var ansA = phase > 320 ? Math.min(1,(phase-320)/50) : 0;
    hitIdx = phase > 140 && phase < 400 ? 0 : (phase >= 400 ? 0 : 0);

    DOCS.forEach(function(d,i){ drawDoc(d,i, i===hitIdx && phase > 130 && phase < 420); });
    drawQuestion(qA);
    if(phase > 70 && phase < 420) drawSearchBeam(phase);
    drawAnswer(ansA);
    drawStatus();

    requestAnimationFrame(frame);
  }
  requestAnimationFrame(frame);
})();
</script>
  </section>

  <!-- КЕЙСЫ -->
  <section class="akb-section" id="keisy">
    <div class="akb-cnt">
      <div class="akb-sh">
        <span class="akb-eyebrow">Кейсы РФ</span>
        <h2>Кейсы AI-базы знаний: результаты для бизнеса</h2>
        <p>Примеры внедрения в России подтверждают ROI корпоративного RAG.</p>
      </div>

      <div class="akb-case-grid nero-ai-reveal">
        <div class="akb-case-card">
          <div class="akb-case-tag">Инфраструктура · Epsilon Metrics</div>
          <h3>Снижение повторных обращений</h3>
          <p>RAG по ~1000 техническим документам, интеграция в Bitrix24. Инженеры тратили до 40% времени на поиск — «Петрович-эффект» устранён.</p>
          <div class="akb-metrics">
            <div class="akb-metric"><span class="num akb-gt">~3 сек</span><span class="lbl">ответ с цитатой</span></div>
            <div class="akb-metric"><span class="num akb-gt">0.89</span><span class="lbl">faithfulness</span></div>
            <div class="akb-metric"><span class="num">2–3 мес.</span><span class="lbl">окупаемость (10 инженеров)</span></div>
          </div>
        </div>
        <div class="akb-case-card">
          <div class="akb-case-tag">Девелопмент · А101</div>
          <h3>Ускорение онбординга</h3>
          <p>Единая индексированная база знаний по корпоративным документам девелопера. Платформа масштабируется на новые подразделения.</p>
          <div class="akb-metrics">
            <div class="akb-metric"><span class="num">~40%</span><span class="lbl">проекта — подготовка данных</span></div>
            <div class="akb-metric"><span class="num">RAG</span><span class="lbl">только по вашим документам</span></div>
          </div>
        </div>
        <div class="akb-case-card">
          <div class="akb-case-tag">Финтех · M365 Copilot</div>
          <h3>Метрики ROI: время поиска</h3>
          <p>Тренд Microsoft (arxiv 2605.23958): enterprise AI смещается к встроенному ассистенту; company-specific search остаётся ключевым сценарием.</p>
          <div class="akb-metrics">
            <div class="akb-metric"><span class="num">−35%</span><span class="lbl">время поиска (отрасл. оценки)</span></div>
            <div class="akb-metric"><span class="num">40%</span><span class="lbl">enterprise apps с AI-агентами к 2026 (Gartner)</span></div>
          </div>
        </div>
      </div>

      <div class="akb-card nero-ai-reveal" style="margin-top:28px;">
        <h3>ROI-калькулятор (ориентир)</h3>
        <p>Число сотрудников × часы поиска в неделю × ставка часа = стоимость «потерянного» времени. При 50 сотрудниках и 4 часах поиска в неделю на человека — сотни тысяч рублей ФОТ ежемесячно.</p>
      </div>
    </div>
  </section>

  <!-- CTA после кейсов -->
  <div class="akb-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-keisy">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите такие же результаты?</p>
        <p class="ym-cta-block__sub">−40% времени на поиск, faithfulness 0.89, окупаемость 2–3 месяца — реальные кейсы в РФ. Начните с бесплатного аудита базы знаний.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Бесплатный аудит базы знаний</a>
        </div>
      </div>
    </div>
  </div>

  <!-- ЭТАПЫ -->
  <section class="akb-section akb-section-alt" id="etapy">
    <div class="akb-cnt">
      <div class="akb-sh">
        <span class="akb-eyebrow">Внедрение под ключ</span>
        <h2>Как проходит внедрение AI-базы знаний: 5 этапов</h2>
        <p>Поэтапная модель без «big bang» — от аудита до сопровождения.</p>
      </div>

      <div class="akb-timeline nero-ai-reveal">
        <div class="akb-tl-item">
          <div class="akb-tl-dot"></div>
          <h3>1. Аудит базы знаний (лид-магнит)</h3>
          <p>Инвентаризация источников: папки, Confluence, Bitrix, 1С, Notion. Оценка качества, дублей, «мёртвых» статей. Карта ролей и типовых вопросов. <strong>Бесплатный аудит базы знаний</strong> — вход в воронку.</p>
        </div>
        <div class="akb-tl-item">
          <div class="akb-tl-dot"></div>
          <h3>2. Сбор и подготовка документов</h3>
          <p>Минимум 100–300 актуальных файлов для MVP. Реестр документов, org-structure для RBAC, 50–100 реальных вопросов из helpdesk и чатов.</p>
        </div>
        <div class="akb-tl-item">
          <div class="akb-tl-dot"></div>
          <h3>3. Настройка RAG и тестовые сценарии</h3>
          <p>PoC за 2–3 недели: 200–500 ключевых документов, один канал (Telegram или виджет). Baseline: время ответа, % ответов с цитатой, faithfulness на 50–100 эталонных вопросах.</p>
        </div>
        <div class="akb-tl-item">
          <div class="akb-tl-dot"></div>
          <h3>4. Пилот и обучение сотрудников</h3>
          <p>Production за 4–8 недель: полный ingestion, hybrid search + rerank, RBAC, интеграция с 1–2 системами. Обучение: как задавать вопросы, когда эскалировать.</p>
          <?php
          $secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: (function_exists('nero_ai_telegram_channel_url') ? nero_ai_telegram_channel_url() : '');
          $secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Канал про AI и автоматизацию';
          if ($secondary_cta_url !== '') :
          ?>
          <p class="akb-inline-cta">Хотите разобраться в RAG и автоматизации самостоятельно? <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a> — а мы возьмём на себя внедрение под ключ.</p>
          <?php endif; ?>
        </div>
        <div class="akb-tl-item">
          <div class="akb-tl-dot"></div>
          <h3>5. Запуск и сопровождение</h3>
          <p>Регламент обновления документов, ежемесячный eval, доработка промптов и chunking. Analytics: топ вопросов, zero-result rate, 👍/👎 feedback.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ЦЕНЫ -->
  <section class="akb-section" id="ceny">
    <div class="akb-cnt">
      <div class="akb-sh">
        <span class="akb-eyebrow">Бюджет проекта</span>
        <h2>Сколько стоит AI-база знаний для компании</h2>
        <p>Ориентир Nero Network: <span class="akb-gt">250 тыс.–1,8 млн ₽</span> (MVP → mid → enterprise).</p>
      </div>

      <div class="akb-table-wrap nero-ai-reveal">
        <table class="akb-table">
          <thead>
            <tr>
              <th>Фактор</th>
              <th>Влияние на бюджет</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Объём и качество документов</td>
              <td>Аудит, OCR, структурирование (~40% проекта у крупных кейсов)</td>
            </tr>
            <tr>
              <td>Число источников</td>
              <td>Confluence + Drive + CRM + 1С — сложнее ingestion</td>
            </tr>
            <tr>
              <td>Интеграции</td>
              <td>Bitrix24, amoCRM, Service Desk, мессенджеры</td>
            </tr>
            <tr>
              <td>LLM-стек</td>
              <td>YandexGPT / GigaChat (152-ФЗ) vs on-premise GPU</td>
            </tr>
            <tr>
              <td>SLA и сопровождение</td>
              <td>Ежемесячный eval, доработка промптов</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="akb-pricing-grid nero-ai-reveal" style="margin-top:32px;">
        <div class="akb-price-card">
          <div class="tier">PoC</div>
          <div class="amount">250–400 тыс. ₽</div>
          <div class="inc">2–3 недели · 200–500 документов · один канал</div>
        </div>
        <div class="akb-price-card akb-featured">
          <div class="tier">Production</div>
          <div class="amount">800 тыс.–1,8 млн ₽</div>
          <div class="inc">4–8 недель · hybrid RAG · RBAC · CRM</div>
        </div>
        <div class="akb-price-card">
          <div class="tier">SMB</div>
          <div class="amount">от 250 тыс. ₽</div>
          <div class="inc">Telegram + один источник · 200–500 док.</div>
        </div>
        <div class="akb-price-card">
          <div class="tier">Enterprise</div>
          <div class="amount">1,5–5 млн ₽</div>
          <div class="inc">on-premise · Graph/Agentic RAG · multi-hop</div>
        </div>
      </div>

      <div class="akb-card nero-ai-reveal" style="margin-top:28px;">
        <h3>AI-база знаний для малого и среднего бизнеса</h3>
        <p><strong>Малый бизнес</strong> — PoC на 200–500 документов, один канал (Telegram), один источник. <strong>Средний бизнес</strong> — несколько отделов, CRM, RBAC, hybrid search. <strong>Enterprise</strong> — on-premise (кейс Reg.ru/Runity), Graph/Agentic RAG для multi-hop запросов.</p>
        <p><strong>152-ФЗ:</strong> YandexGPT/GigaChat + pgvector в Yandex Cloud / Selectel — для большинства SMB достаточно облака в РФ; для регулируемых отраслей — on-premise.</p>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="akb-section akb-section-alt" id="faq">
    <div class="akb-cnt">
      <div class="akb-sh">
        <span class="akb-eyebrow">FAQ</span>
        <h2>Частые вопросы об AI-базе знаний</h2>
      </div>

      <div class="akb-faq nero-ai-reveal">
        <div class="akb-faq-item">
          <div class="akb-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI-базу знаний без программиста?</div>
          <div class="akb-faq-a">
            <p>Реалистичный сценарий при внедрении под ключ: Nero Network берёт на себя разработку, интеграцию и настройку. С вашей стороны — владелец контента, список источников, эталонные вопросы и участие в приёмке PoC. Low-code слой (Make/n8n) снижает зависимость от постоянного DevOps.</p>
          </div>
        </div>
        <div class="akb-faq-item">
          <div class="akb-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли подключить Confluence / SharePoint / Notion?</div>
          <div class="akb-faq-a">
            <p>Да. Стандартные коннекторы через API: Confluence, SharePoint, Google Drive, Notion, Яндекс Вики, Bitrix24, локальные папки, 1С-выгрузки. Кейс Reg.ru/Runity — RAG по Confluence + GitLab с учётом прав доступа.</p>
          </div>
        </div>
        <div class="akb-faq-item">
          <div class="akb-faq-q" tabindex="0" role="button" aria-expanded="false">Как обеспечивается безопасность и доступ к документам?</div>
          <div class="akb-faq-a">
            <p>RBAC — фильтрация документов по роли до поиска. Данные не идут в обучение публичных моделей. Российские LLM (YandexGPT, GigaChat) и облако в РФ для 152-ФЗ. Audit log запросов. On-premise для регулируемых отраслей.</p>
          </div>
        </div>
        <div class="akb-faq-item">
          <div class="akb-faq-q" tabindex="0" role="button" aria-expanded="false">Чем AI-база знаний отличается от ChatGPT для компании?</div>
          <div class="akb-faq-a">
            <p>ChatGPT не знает ваших регламентов, создаёт риск утечки при загрузке документов и может галлюцинировать. RAG отвечает только по проиндексированным фрагментам, показывает источник, при неуверенности — отказывает.</p>
          </div>
        </div>
        <div class="akb-faq-item">
          <div class="akb-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает запуск?</div>
          <div class="akb-faq-a">
            <p>PoC: 2–3 недели. Production: 4–8 недель. Первые ответы по пилотному набору документов — уже на этапе PoC.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ФИНАЛЬНЫЙ CTA -->
  <div class="akb-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Собрать AI-базу знаний под ключ</p>
        <p class="ym-cta-block__sub">Аудит документов бесплатно → PoC за 2–3 недели → production с RBAC и интеграциями. Ориентир: 250 тыс.–1,8 млн ₽.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Бесплатный аудит базы знаний</a>
        </div>
      </div>
    </div>
  </div>

</div><!-- /.akb-content -->

<script>
(function(){
  document.querySelectorAll('.akb-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.akb-faq-item');
      var open = item.classList.contains('open');
      document.querySelectorAll('.akb-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.akb-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!open){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
    });
    btn.addEventListener('keydown', function(e){
      if(e.key==='Enter'||e.key===' '){ e.preventDefault(); btn.click(); }
    });
  });
})();
</script>

<!-- REVEAL (IntersectionObserver) -->
<script>
(function(){
  'use strict';
  var root = document.querySelector('.akb-content');
  if (!root) return;
  var items = document.querySelectorAll('.nero-ai-reveal');
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

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

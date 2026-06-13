<?php
/**
 * Template Name: AI-регламенты и инструкции для бизнеса: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-регламентов и базы знаний под ключ. Шаблон регламента отдела продаж.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-регламенты для бизнеса: внедрение и база знаний под ключ';
$page_seo_description = 'Внедряем AI-регламенты и инструкции под ключ: оцифруем знания сотрудников, создадим базу знаний и стандарты работы. Шаблон для отдела продаж — бесплатно.';

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
    ['label' => 'Проблема', 'href' => '#problem'],
    ['label' => 'Услуга', 'href' => '#paket'],
    ['label' => 'Этапы', 'href' => '#kak-rabotaem'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Описать первый процесс';
$primary_cta_url   = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);

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


/* ── Hero AI-регламенты: самодостаточные стили (без CSS темы) ── */
.regl-hero-kb {
  --regl-cyan: #79f2ff;
  --regl-violet: #8b5cf6;
  --regl-green: #22c55e;
  --regl-amber: #fbbf24;
  --regl-text: #e6edf7;
  --regl-muted: #9aa8bd;
  --regl-soft: #c7d2e5;
  --regl-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.regl-hero-kb.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.regl-hero-kb::before {
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
.regl-hero-kb::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 14%;
  width: 780px;
  height: 780px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(6px);
  animation: reglHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes reglHeroGlow {
  from { opacity: .4; transform: translateX(-50%) scale(.95); }
  to { opacity: .82; transform: translateX(-50%) scale(1.05); }
}
.regl-hero-kb .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.regl-hero-kb .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.regl-hero-kb .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.regl-hero-kb .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--regl-cyan) 40%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.regl-hero-kb .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--regl-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.regl-hero-kb .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--regl-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.regl-hero-kb .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.regl-hero-kb .nero-ai-badge {
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
.regl-hero-kb .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.regl-hero-kb .nero-ai-btn {
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
.regl-hero-kb .nero-ai-btn:hover { transform: translateY(-2px); }
.regl-hero-kb .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--regl-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.regl-hero-kb .nero-ai-btn-secondary {
  color: var(--regl-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.regl-hero-kb .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--regl-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.regl-hero-kb .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.regl-hero-kb .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.regl-hero-kb .nero-ai-dots { display: flex; gap: 7px; }
.regl-hero-kb .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.regl-hero-kb .nero-ai-dot:nth-child(1) { background: #fb7185; }
.regl-hero-kb .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.regl-hero-kb .nero-ai-dot:nth-child(3) { background: #34d399; }
.regl-hero-kb .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.regl-hero-kb .nero-ai-window-body { padding: 16px; }
.regl-hero-kb .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.regl-hero-kb .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.regl-hero-kb .nero-ai-live-pill {
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
.regl-hero-kb .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: reglPulse 1.6s infinite;
}
@keyframes reglPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.regl-hero-kb .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.regl-hero-kb .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.regl-hero-kb .nero-ai-metric span {
  display: block;
  color: var(--regl-muted);
  font-size: 11px;
  font-weight: 700;
}
.regl-hero-kb .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.regl-hero-kb .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.regl-hero-kb .regl-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(139, 92, 246, 0.18);
  background: radial-gradient(ellipse at 50% 42%, rgba(139,92,246,.10), rgba(6,10,24,.92) 72%);
}
.regl-hero-kb #reglamenty-kb-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.regl-hero-kb .nero-ai-task-stream { display: grid; gap: 8px; }
.regl-hero-kb .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.regl-hero-kb .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(139,92,246,.14);
  color: var(--regl-violet);
  font-size: 11px;
  font-weight: 800;
}
.regl-hero-kb .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.regl-hero-kb .nero-ai-task span {
  color: var(--regl-muted);
  font-size: 11px;
}
.regl-hero-kb .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.regl-hero-kb .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.regl-hero-kb .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .regl-hero-kb .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .regl-hero-kb .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .regl-hero-kb .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .regl-hero-kb .nero-ai-window-body { padding: 12px; }
  .regl-hero-kb .nero-ai-task { grid-template-columns: 28px 1fr; }
  .regl-hero-kb .nero-ai-status { grid-column: 2; width: fit-content; }
}

.vna-pull-quote{
  max-width:720px;margin:0 auto 28px;padding:24px 28px;
  border-left:4px solid var(--vna-accent);
  background:rgba(121,242,255,.06);border-radius:0 16px 16px 0;
}
.vna-pull-quote p{font-size:18px;color:var(--vna-soft);margin:0 0 8px;}
.vna-pull-quote footer{font-size:14px;color:var(--vna-muted);}
.vna-checklist{list-style:none;padding:0;margin:0 0 1.5em;max-width:720px;}
.vna-checklist li{
  padding:10px 0 10px 32px;position:relative;
  border-bottom:1px solid rgba(255,255,255,.06);color:var(--vna-muted);
}
.vna-checklist li::before{
  content:'✓';position:absolute;left:0;color:var(--vna-green);font-weight:800;font-size:16px;
}

.ym-cta-block--primary{
  display:flex;align-items:flex-start;gap:20px;text-align:left;
  background:linear-gradient(135deg,rgba(121,242,255,.14),rgba(139,92,246,.1));
}
.ym-cta-block--primary .ym-cta-block__body{flex:1;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-link--accent{color:var(--vna-accent)!important;text-decoration:underline!important;}
.regl-hero-kb.nero-ai-hero{min-height:100dvh;min-height:100vh;}

/* Internal links block */
.vna-related-section{padding-top:clamp(48px,6vw,80px);padding-bottom:clamp(48px,6vw,80px);}
.vna-related-section .vna-card h3{font-size:17px;margin-bottom:10px;}
.vna-related-section .vna-card p{font-size:14.5px;margin:0;}
.vna-related-section a{color:var(--vna-accent)!important;text-decoration:underline;text-underline-offset:3px;}
.vna-related-section a:hover{color:#fff!important;}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-reglamenty-dlya-biznesa-page" role="main" tabindex="-1">

<section class="nero-ai-hero regl-hero-kb" id="hero-reglamenty" aria-labelledby="hero-reglamenty-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai регламенты</p>
      <h1 id="hero-reglamenty-title">AI-регламенты и инструкции для бизнеса: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI описывает процессы, создаёт регламенты и базу знаний — чтобы знания не жили только в головах сотрудников</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Интервью</li>
        <li class="nero-ai-badge">Черновик SOP</li>
        <li class="nero-ai-badge">Ревью владельца</li>
        <li class="nero-ai-badge">База знаний</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#chto-eto">Что входит в пакет</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация цикла AI-регламентов">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">KB · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-база регламентов</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Оцифровано</span>
              <strong>3 SOP</strong>
              <small>продажи · сервис · франшиза</small>
            </div>
            <div class="nero-ai-metric">
              <span>Черновик</span>
              <strong>60 мин</strong>
              <small>после интервью</small>
            </div>
            <div class="nero-ai-metric">
              <span>Статус KB</span>
              <strong>live</strong>
              <small>Notion · approved</small>
            </div>
            <div class="nero-ai-metric">
              <span>Онбординг</span>
              <strong>−70%</strong>
              <small>время до нормы</small>
            </div>
          </div>

          <div class="regl-dash-canvas-wrap" aria-hidden="false">
            <canvas id="reglamenty-kb-canvas" role="img" aria-label="Анимация: знания из голов сотрудников превращаются в утверждённые регламенты и публикуются в базе знаний"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента цикла SOP">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">INT</span>
              <div><strong>Интервью с РОПом</strong><span>45 мин · воронка продаж</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Черновик регламента</strong><span>12 разделов · CRM-поля</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">SME</span>
              <div><strong>Ревью владельца</strong><span>Human-in-the-loop</span></div>
              <span class="nero-ai-status nero-ai-status--amber">в работе</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">KB</span>
              <div><strong>Публикация в Notion</strong><span>v1.0 · RAG-индекс</span></div>
              <span class="nero-ai-status nero-ai-status--violet">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vna-content">
<!-- ====================================================
     INTRO: второй экран
     ==================================================== -->
<section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
  <div class="vna-cnt nero-ai-container">
    <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
      <div class="vna-intro-text nero-ai-intro-text">
        <p class="nero-ai-eyebrow">Лонгрид · ai регламенты</p>
        <p><strong>Коротко:</strong> Nero Network внедряет <strong>AI-регламенты под ключ</strong> — от интервью с владельцем процесса до опубликованной базы знаний, инструкций для сотрудников и (опционально) RAG-ассистента. Первый шаг — <strong>описать один процесс</strong>: отдел продаж, сервис или франшиза.</p>
        <p>Когда компания растёт, главная операционная боль звучит одинаково: знания живут в головах, а не в системе. AI-регламенты переводят tacit knowledge в проверяемые документы — с human-in-the-loop и интеграцией в CRM.</p>
      </div>
      <div class="vna-intro-kpi" aria-label="Ключевые показатели">
        <div class="vna-kpi-card">
          <div class="kv">70–80%</div>
          <div class="kl">знаний неоформлены (tacit)</div>
          <div class="ks">McKinsey / Atlan</div>
        </div>
        <div class="vna-kpi-card">
          <div class="kv">19%</div>
          <div class="kl">времени на поиск информации</div>
          <div class="ks">вместо работы по стандарту</div>
        </div>
        <div class="vna-kpi-card">
          <div class="kv">2–3 нед</div>
          <div class="kl">до рабочей базы знаний</div>
          <div class="ks">1–3 процесса</div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- TOC -->
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#problem">Проблема</a>
        <a href="#chto-eto">Что это</a>
        <a href="#paket">Пакет</a>
        <a href="#kak-rabotaem">Этапы</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#shablon">Шаблон</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Контакт</a>
      </nav>
    </div>
  </div>

<!-- ================================================
     #problem
     ================================================ -->
<section class="vna-section" id="problem">
  <div class="vna-cnt">
    <div class="vna-sh">
      <span class="vna-eyebrow">Проблема</span>
      <h2>Знания в головах сотрудников — главный тормоз роста</h2>
      <p>Новый менеджер неделю «висит» на старшем коллеге. Франчайзи получает PDF, который никто не обновлял полгода. РОП уходит — вместе с ним уходят скрипты и негласные правила.</p>
    </div>

    <blockquote class="vna-pull-quote nero-ai-reveal" cite="https://atlan.com">
      <p><strong>70–80% корпоративных знаний</strong> остаются неоформленными — tacit knowledge, которое не попало в документы.</p>
      <footer>Сотрудники тратят до <strong>19% рабочего времени</strong> на поиск информации вместо работы по стандарту.</footer>
    </blockquote>

    <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
      <div class="vna-kpi-card" style="text-align:left;padding:22px;">
        <div class="kv" style="font-size:32px;">70–80%</div>
        <div class="kl" style="font-size:13px;">tacit knowledge не в документах</div>
      </div>
      <div class="vna-kpi-card" style="text-align:left;padding:22px;">
        <div class="kv" style="font-size:32px;">19%</div>
        <div class="kl" style="font-size:13px;">рабочего времени — поиск вместо стандарта</div>
      </div>
    </div>

    <div class="vna-card nero-ai-reveal" style="margin-top:32px;">
      <p><strong>Определение:</strong> <em>AI-регламенты</em> — это не один промпт в ChatGPT, а цикл: сбор знаний → структурирование нейросетью → проверка владельцем процесса → публикация в базе знаний → поиск ответов сотрудниками.</p>
    </div>

    <div class="vna-sh vna-left" style="margin-top:48px;">
      <span class="vna-eyebrow">Почему не работают</span>
      <h3>Почему регламенты «лежат в папке», а не работают</h3>
    </div>
    <ul class="nero-ai-reveal">
      <li>формулировки вроде «качественно общаться с клиентом» без привязки к CRM-полям и измеримым действиям;</li>
      <li>нет владельца документа и даты следующего ревью;</li>
      <li>регламент не связан с этапами воронки, SLA тикетов или чек-листом смены;</li>
      <li>сотруднику проще спросить коллегу в чате, чем искать в 40 страницах.</li>
    </ul>
    <p class="nero-ai-reveal">Как отмечают эксперты по стандартам продаж (rechka.ai), <strong>регламент работает, когда вместо «качественно общаться» написано измеримое действие в CRM</strong> — звонок, поле, срок, критерий перехода на следующий этап.</p>

    <div class="vna-sh vna-left" style="margin-top:40px;">
      <span class="vna-eyebrow">Масштабирование</span>
      <h3>Что ломается при масштабировании отдела продаж и сервиса</h3>
    </div>
    <div class="vna-grid-3 nero-ai-reveal">
      <div class="vna-card">
        <h4>Отдел продаж</h4>
        <p>Без единых скриптов и правил воронки каждый менеджер продаёт «по-своему». CRM заполняется формально. Прогноз срывается из-за разного понимания этапов сделки.</p>
      </div>
      <div class="vna-card">
        <h4>Клиентский сервис</h4>
        <p>При текучке линии поддержки растёт время ответа, эскалации идут «на ощущение». SLA существует на бумаге, но не в операционке.</p>
      </div>
      <div class="vna-card">
        <h4>Франшиза и сеть точек</h4>
        <p>Стандарты открытия смены, приёмки, работы с рекламацией не тиражируются. Масштабирование превращается в борьбу с хаосом.</p>
      </div>
    </div>
    <p class="nero-ai-reveal" style="margin-top:24px;">Именно здесь пересекается родовой кластер <strong>внедрение AI в бизнес-процессы</strong> и узкая задача <strong>ai регламенты для бизнеса</strong>: нейросеть ускоряет перевод знаний из голов в проверяемые документы.</p>
  </div>
</section>

<!-- ================================================
     #chto-eto
     ================================================ -->
<section class="vna-section vna-section-alt" id="chto-eto">
  <div class="vna-cnt">
    <div class="vna-sh">
      <span class="vna-eyebrow">Услуга</span>
      <h2>AI-генератор регламентов и инструкций — что это и кому подходит</h2>
      <p><strong>AI-генератор регламентов</strong> — связка технологий и методики: LLM, интервью, screen-capture, публикация в Notion / Confluence / Google Docs, опционально RAG.</p>
    </div>

    <p class="nero-ai-reveal" style="max-width:820px;margin:0 auto 28px;text-align:center;">OpenAI развивает <strong>Company knowledge</strong> и <strong>workspace agents</strong> — ответы по Slack, SharePoint, Google Drive с отсылкой к документу (<a href="https://openai.com/business/" target="_blank" rel="noopener noreferrer">openai.com/business</a>). Gartner связывает зрелость knowledge management с качеством GenAI.</p>

    <div class="vna-sh vna-left">
      <span class="vna-eyebrow">Целевая аудитория</span>
      <h3>МСП, франшизы и сервисные команды</h3>
    </div>
    <div class="vna-table-wrap nero-ai-reveal">
      <table class="vna-table" aria-label="Сегменты и выгоды AI-регламентов">
        <thead>
          <tr><th>Сегмент</th><th>Типичная боль</th><th>Что дают AI-регламенты</th></tr>
        </thead>
        <tbody>
          <tr><td>МСП 20–100 человек</td><td>Знания у основателя и ключевых сотрудников</td><td>1–3 процесса в базе за 2–3 недели</td></tr>
          <tr><td>Франшиза / сеть</td><td>Стандарты не копируются</td><td>Единые SOP для точек + версионирование</td></tr>
          <tr><td>Отдел продаж</td><td>CRM и скрипты расходятся</td><td>Регламент с полями amoCRM / Bitrix24</td></tr>
          <tr><td>Клиентский сервис</td><td>SLA «на словах»</td><td>Инструкции эскалации и шаблоны ответов</td></tr>
        </tbody>
      </table>
    </div>

    <p class="nero-ai-reveal" style="margin-top:24px;"><strong>AI регламенты для малого бизнеса</strong> — реалистичный формат: не «оцифровать всё», а начать с процесса, который чаще всего ломается при росте — обычно продажи или первая линия поддержки.</p>

    <div class="vna-sh vna-left" style="margin-top:40px;">
      <span class="vna-eyebrow">Сравнение</span>
      <h3>Чем отличается от «просто ChatGPT»</h3>
    </div>
    <div class="vna-table-wrap nero-ai-reveal">
      <table class="vna-table" aria-label="Сравнение подходов к AI-регламентам">
        <thead>
          <tr><th>Подход</th><th>Результат</th><th>Риск</th></tr>
        </thead>
        <tbody>
          <tr><td>Промпт в чате без контекста</td><td>Красивый текст</td><td>Галлюцинации, нет связи с CRM</td></tr>
          <tr><td>SaaS-генератор (шаблон)</td><td>Быстрый черновик</td><td>Нет внедрения, нет RAG, нет владельца</td></tr>
          <tr><td>Классический консалтинг</td><td>Документ «под печать»</td><td>6–10 часов на один SOP вручную (GPTmag)</td></tr>
          <tr><td><strong>Пакет Nero Network</strong></td><td>Интервью → AI → ревью → KB → (опц.) бот</td><td>Human-in-the-loop, версии, интеграции</td></tr>
        </tbody>
      </table>
    </div>
    <p class="nero-ai-reveal" style="margin-top:20px;">Один SOP вручную — <strong>6–10 часов</strong>; цепочка «интервью → расшифровка → LLM → ревью владельцем» — <strong>50–90 минут</strong> на документ. За рабочую неделю реально оформить <strong>до 24 регламентов</strong> при наличии владельцев процессов.</p>
  </div>
</section>

<!-- ================================================
     БОРИС: визуальный блок (после #chto-eto)
     ================================================ -->
<section id="ai-reglamenty-dlya-biznesa-boris-block" class="brg-root" aria-label="Анимация: tacit knowledge превращается в SOP и публикуется в базе знаний">
<style>
/* === БОРИС: prefix brg-, scoped внутри #ai-reglamenty-dlya-biznesa-boris-block === */
#ai-reglamenty-dlya-biznesa-boris-block.brg-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-reglamenty-dlya-biznesa-boris-block .brg-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-reglamenty-dlya-biznesa-boris-block .brg-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#059669;margin:0 0 14px;
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-ey::before{
  content:'';width:18px;height:2px;background:#059669;border-radius:1px;
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;
  line-height:1.28;margin:0 0 18px;
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-ul{
  list-style:none;margin:0 0 22px;padding:0;
  display:flex;flex-direction:column;gap:9px;
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-ul li{
  display:flex;align-items:flex-start;gap:10px;
  font-size:14px;line-height:1.5;color:#334155;
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(5,150,105,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#047857;margin-top:1px;font-style:normal;
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-pills{
  display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-pl-g{
  background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-pl-v{
  background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-pl-b{
  background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-foot{
  font-size:13px;color:#64748b;font-style:italic;margin:0;
}
#ai-reglamenty-dlya-biznesa-boris-block .brg-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfdf5 0%,#f0fdf4 28%,#f5f3ff 72%,#f8fafc 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){
  #ai-reglamenty-dlya-biznesa-boris-block .brg-rgt{min-height:380px;}
}
#brg-sop-knowledge-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>

<div class="brg-cnt">
  <div class="brg-card">
    <div class="brg-lft">
      <span class="brg-ey">Цикл оцифровки</span>
      <h3 class="brg-h3">Из «головы Пети» — в SOP с владельцем и поиском в базе знаний</h3>
      <ul class="brg-ul">
        <li><span class="brg-ic">1</span>Интервью с владельцем процесса + CRM, записи, screen-capture</li>
        <li><span class="brg-ic">2</span>LLM структурирует шаги, поля CRM и критерии этапов</li>
        <li><span class="brg-ic">3</span>SME-ревью: владелец утверждает, юрист/HR — при необходимости</li>
        <li><span class="brg-ic">✓</span>Публикация в KB + RAG-бот «спроси регламент» для линейных</li>
      </ul>
      <div class="brg-pills">
        <span class="brg-pl brg-pl-g">50–90 мин / SOP</span>
        <span class="brg-pl brg-pl-v">human-in-the-loop</span>
        <span class="brg-pl brg-pl-b">KB + CRM</span>
      </div>
      <p class="brg-foot">Дальше — что входит во внедрение AI-регламентов под ключ →</p>
    </div>
    <div class="brg-rgt">
      <canvas id="brg-sop-knowledge-canvas" aria-label="Анимация: знания из голов сотрудников структурируются AI и публикуются в базе знаний" role="img"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('brg-sop-knowledge-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

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
    ink:'#0f172a', muted:'#64748b', paper:'#ffffff', paperBdr:'#cbd5e1',
    tacit:'#f59e0b', tacitGlow:'rgba(245,158,11,.25)',
    ai:'#8b5cf6', aiGlow:'rgba(139,92,246,.22)',
    sop:'#22c55e', kb:'#0ea5e9', kbDark:'#0284c7',
    line:'rgba(14,165,233,.35)', bubble:'#fffbeb', bubbleBdr:'#fcd34d'
  };

  var heads = [
    {x:0.12, y:0.28, label:'РОП', bubble:'скрипт скидок'},
    {x:0.10, y:0.52, label:'Сервис', bubble:'эскалация L2'},
    {x:0.14, y:0.72, label:'Точка', bubble:'чек-лист смены'}
  ];

  var sops = [];
  var searchPulse = 0;
  var LOOP = 520;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawHead(hx, hy, r, label, bubble, alpha, phase){
    ctx.globalAlpha = alpha;
    ctx.fillStyle = C.tacitGlow;
    ctx.beginPath(); ctx.arc(hx,hy,r*1.4,0,Math.PI*2); ctx.fill();
    rr(hx-r, hy-r, r*2, r*2, r, '#fef3c7', C.tacit, 2);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold ' + Math.max(9,r*0.35) + 'px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center'; ctx.textBaseline = 'middle';
    ctx.fillText(label.charAt(0), hx, hy);
    if(phase > 0.15){
      var bx = hx + r*1.8, by = hy - r*2.2;
      var bw = ctx.measureText(bubble).width + 16;
      rr(bx, by, bw, 22, 6, C.bubble, C.bubbleBdr, 1);
      ctx.fillStyle = '#92400e';
      ctx.font = '10px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(bubble, bx+8, by+14);
    }
    ctx.globalAlpha = 1;
  }

  function drawAiHub(cx, cy, r, pulse){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
    g.addColorStop(0, C.aiGlow); g.addColorStop(1, 'rgba(139,92,246,0)');
    ctx.fillStyle = g;
    ctx.beginPath(); ctx.arc(cx,cy,r*1.8,0,Math.PI*2); ctx.fill();
    rr(cx-r, cy-r, r*2, r*2, r*0.35, '#f5f3ff', C.ai, 2);
    ctx.fillStyle = C.ai;
    ctx.font = 'bold ' + Math.max(11,r*0.22) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center'; ctx.textBaseline = 'middle';
    ctx.fillText('LLM', cx, cy-2);
    ctx.font = Math.max(8,r*0.14) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('структура SOP', cx, cy+r*0.38);
    ctx.strokeStyle = C.ai;
    ctx.lineWidth = 2 + pulse*2;
    ctx.globalAlpha = 0.25 + pulse*0.35;
    ctx.beginPath(); ctx.arc(cx,cy,r+5+pulse*6,0,Math.PI*2); ctx.stroke();
    ctx.globalAlpha = 1;
  }

  function drawSopCard(x,y,w,h,title,alpha){
    if(alpha < 0.05) return;
    ctx.globalAlpha = alpha;
    rr(x,y,w,h,8,C.paper,C.sop,1.5);
    ctx.fillStyle = C.sop;
    ctx.font = 'bold 10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('SOP · ' + title, x+10, y+18);
    for(var i=0;i<3;i++){
      rr(x+10, y+26+i*14, w-20, 10, 3, '#ecfdf5', '#86efac', 1);
    }
    ctx.globalAlpha = 1;
  }

  function drawKb(x,y,w,h,alpha,pulse){
    if(alpha < 0.05) return;
    ctx.globalAlpha = alpha;
    rr(x,y,w,h,12,'#f0f9ff',C.kb,2);
    ctx.fillStyle = C.kbDark;
    ctx.font = 'bold 12px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('База знаний', x+14, y+22);
    ctx.font = '10px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('Notion · Confluence · Bitrix24', x+14, y+38);
    var sx = x+w-90, sy = y+14;
    rr(sx,sy,76,26,8,'#fff',C.kb,1);
    ctx.fillStyle = C.muted;
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText('🔍 спроси регламент', sx+8, sy+16);
    if(pulse > 0.3){
      ctx.strokeStyle = C.kb;
      ctx.lineWidth = 1.5;
      ctx.globalAlpha = 0.4 + pulse*0.3;
      ctx.strokeRect(sx-2,sy-2,80,30);
    }
    ctx.globalAlpha = 1;
  }

  function tick(){
    frame++;
    var t = frame % LOOP;
    var pulse = 0.5 + 0.5*Math.sin(frame*0.08);
    searchPulse = 0.5 + 0.5*Math.sin(frame*0.12);

    ctx.clearRect(0,0,W,H);

    var aiX = W*0.48, aiY = H*0.5, aiR = Math.min(W,H)*0.09;

    heads.forEach(function(h,i){
      var hx = W*h.x + Math.sin(frame*0.03+i)*4;
      var hy = H*h.y;
      var phase = Math.min(1, t/(80+i*30));
      var fade = t > 400 ? Math.max(0, 1-(t-400)/80) : 1;
      drawHead(hx, hy, aiR*0.55, h.label, h.bubble, fade*phase, phase);
      if(t > 60+i*25 && t < 380){
        ctx.strokeStyle = C.tacit;
        ctx.lineWidth = 1.5;
        ctx.globalAlpha = 0.35;
        ctx.setLineDash([4,4]);
        ctx.beginPath();
        ctx.moveTo(hx+aiR*0.6, hy);
        ctx.lineTo(aiX-aiR, aiY + (i-1)*12);
        ctx.stroke();
        ctx.setLineDash([]);
        ctx.globalAlpha = 1;
      }
    });

    if(t > 100) drawAiHub(aiX, aiY, aiR, pulse);

    if(t > 180){
      var sopA = Math.min(1,(t-180)/60);
      drawSopCard(W*0.62, H*0.22, W*0.28, H*0.18, 'Воронка', sopA);
      drawSopCard(W*0.62, H*0.44, W*0.28, H*0.18, 'SLA сервис', Math.min(1,(t-220)/60));
      drawSopCard(W*0.62, H*0.66, W*0.28, H*0.18, 'Смена точки', Math.min(1,(t-260)/60));
    }

    if(t > 320){
      var kbA = Math.min(1,(t-320)/80);
      drawKb(W*0.08, H*0.12, W*0.84, H*0.76, kbA*0.15, 0);
      drawKb(W*0.55, H*0.78, W*0.38, H*0.16, kbA, searchPulse);
    }

    requestAnimationFrame(tick);
  }
  tick();
})();
</script>
</section>

<!-- ================================================
     #paket
     ================================================ -->
<section class="vna-section" id="paket">
  <div class="vna-cnt">
    <div class="vna-sh">
      <span class="vna-eyebrow">Пакет</span>
      <h2>Что входит во внедрение AI-регламентов под ключ</h2>
      <p><strong>Разработка и настройка AI-регламентов</strong> в Nero Network — проектный пакет <strong>100–300 тыс. ₽</strong> (ориентир; точная смета после аудита 1–3 процессов).</p>
    </div>

    <ul class="vna-checklist nero-ai-reveal" aria-label="Итог пакета под ключ">
      <li>описанные и утверждённые <strong>ai стандарты работы</strong> по выбранным процессам;</li>
      <li><strong>ai инструкции</strong> для сотрудников — короткие SOP, а не «толстый PDF»;</li>
      <li><strong>ai база знаний компании</strong> в согласованном хранилище;</li>
      <li>корпоративная <strong>AI-политика</strong> (white list, классификация данных, верификация черновиков);</li>
      <li>обучение РОПа / линейных и чек-лист квартального обновления.</li>
    </ul>

    <div class="vna-grid-2 nero-ai-reveal" style="margin-top:32px;">
      <div class="vna-card">
        <h3>Описание процессов и стандарты работы</h3>
        <p>На этапе <strong>ai описание процессов</strong> фиксируем «как есть»: триггер, входы, шаги, выходы, ответственные, KPI. <strong>Нейросеть для регламентов</strong> — структуризатор, не источник истины. Истина — интервью, CRM, записи звонков, screen-capture.</p>
      </div>
      <div class="vna-card">
        <h3>Пошаговые инструкции для сотрудников</h3>
        <p><strong>AI инструкции для сотрудников</strong> оформляются блоками: цель → когда применять → шаги → частые ошибки → связь с CRM. Документ читается за 3–7 минут. Сотрудник в CRM видит ссылку на нужный пункт регламента.</p>
      </div>
    </div>

    <div class="vna-card nero-ai-reveal" style="margin-top:20px;">
      <h3>Корпоративная база знаний на AI</h3>
      <p><strong>AI база знаний компании</strong> — единая точка входа: Notion, Google Docs, Confluence или KB в Bitrix24. Опционально — RAG-чат в Telegram. В кейсе LighTech для производственной компании с <strong>12 филиалами</strong> и <strong>500+ сотрудниками</strong> время поиска сократилось <strong>с 20–40 минут до нескольких секунд</strong> (<a href="https://thelightech.ru/projects/ai/ii-baza-znaniy-dlya-proizvodstvennoy-kompanii/" target="_blank" rel="noopener noreferrer">thelightech.ru</a>).</p>
      <p><strong>Автоматизация через AI-регламенты</strong> — связка: утверждённый документ → индекс → ассистент только по approved-контенту.</p>
    </div>
  </div>
</section>

<!-- CTA-2: обучение (после #paket) -->
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до старта проекта?</p>
    <p class="ym-cta-block__sub">Перед внедрением регламентов полезно разобраться в промптах, human-in-the-loop и связке с CRM — это ускоряет ревью черновиков и согласование с РОПом. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
  </div>
</aside>

<!-- ================================================
     #kak-rabotaem
     ================================================ -->
<section class="vna-section vna-section-alt" id="kak-rabotaem">
  <div class="vna-cnt">
    <div class="vna-sh">
      <span class="vna-eyebrow">Процесс</span>
      <h2>Как мы работаем: от первого процесса до готовой базы</h2>
      <p>Проектная модель Nero Network — <strong>2–3 недели</strong> до рабочей базы по 1–3 процессам.</p>
    </div>

    <div class="vna-table-wrap nero-ai-reveal" style="margin-bottom:36px;">
      <table class="vna-table" aria-label="Этапы внедрения AI-регламентов">
        <thead>
          <tr><th>Этап</th><th>Срок</th><th>Действия</th></tr>
        </thead>
        <tbody>
          <tr><td>Аудит</td><td>дни 1–2</td><td>Выбор процессов, интервью 45–60 мин, выгрузка CRM</td></tr>
          <tr><td>Генерация</td><td>дни 3–7</td><td>LLM по шаблону, AI-политика (7 блоков)</td></tr>
          <tr><td>Валидация</td><td>дни 8–10</td><td>Ревью владельца, HR/юрист для ЛНА</td></tr>
          <tr><td>Публикация</td><td>дни 11–15</td><td>KB, опционально RAG-бот</td></tr>
          <tr><td>Обучение</td><td>дни 16–20</td><td>Воркшоп, чек-лист квартального ревью</td></tr>
        </tbody>
      </table>
    </div>

    <div class="vna-card nero-ai-reveal">
      <div class="vna-timeline">
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Аудит и приоритизация процессов</h3>
          <p>Первые кандидаты: <strong>отдел продаж</strong> (воронка, скрипты, поля CRM), <strong>клиентский сервис</strong> (SLA, эскалации), <strong>франшиза</strong> (стандарты точки, чек-листы смены). Не начинаем с «всех регламентов» — только с процесса с быстрым эффектом.</p>
        </div>
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Генерация, согласование и версионирование</h3>
          <p>AI формирует черновик; <strong>владелец процесса утверждает</strong> финал. В индексе RAG — метаданные <code>valid_from</code> / <code>valid_until</code>, ACL по ролям. Точность типового корпоративного RAG — <strong>85–95%</strong> при правильном чанкинге (<a href="https://prem.agmind.dev/blog/rag-dlya-korporativnoy-bazy-znaniy/" target="_blank" rel="noopener noreferrer">prem.agmind.dev</a>).</p>
        </div>
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Обучение команды и контроль качества</h3>
          <p>Обучение — 60–90 минут с РОПом: где искать, как обновлять, кто владелец. Контроль — через CRM (обязательные поля) и выборочный разбор звонков/тикетов по чек-листу из регламента.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA-1: primary (после #kak-rabotaem) -->
<div class="ym-cta-block ym-cta-block--primary" id="cta-pervyj-process">
  <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Опишите первый процесс — начнём с экспресс-аудита</p>
    <p class="ym-cta-block__sub">Достаточно одного сценария: отдел продаж, сервис или франшиза. За 2–3 недели оформим регламент, инструкции и базу знаний по human-in-the-loop — без обязательств по полному пакету.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>

<!-- ================================================
     #scenarii
     ================================================ -->
<section class="vna-section" id="scenarii">
  <div class="vna-cnt">
    <div class="vna-sh">
      <span class="vna-eyebrow">Сценарии</span>
      <h2>Сценарии: отдел продаж, клиентский сервис, франшиза</h2>
    </div>

    <div class="vna-grid-3 nero-ai-reveal">
      <div class="vna-card">
        <div class="vna-sc-icon" aria-hidden="true">📈</div>
        <h3>Регламенты продаж и скрипты</h3>
        <p><strong>AI регламенты с CRM</strong> — этапы воронки, критерии перехода, скрипты, возражения, обязательные поля и сроки касаний. Менеджер открывает SOP и поля в карточке.</p>
      </div>
      <div class="vna-card">
        <div class="vna-sc-icon" aria-hidden="true">🎧</div>
        <h3>Инструкции для поддержки и SLA</h3>
        <p>Категории обращений, время первого ответа, эскалация L1→L2→руководитель, шаблоны писем, запретные формулировки. Связка с обработкой email в CRM.</p>
      </div>
      <div class="vna-card">
        <div class="vna-sc-icon" aria-hidden="true">🏪</div>
        <h3>Единые стандарты для сети точек</h3>
        <p>Кейс на vc.ru: сеть <strong>10+ заведений</strong>, <strong>1000+ страниц</strong> документов — Notion → векторный слой (Qdrant) → ролевой доступ; все AI-сервисы питаются одной базой (<a href="https://vc.ru/life/2619674-pochemu-vnedrenie-ai-bez-rag-obrecheno-na-proval" target="_blank" rel="noopener noreferrer">vc.ru</a>).</p>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     #integracii
     ================================================ -->
<section class="vna-section vna-section-alt" id="integracii">
  <div class="vna-cnt">
    <div class="vna-sh">
      <span class="vna-eyebrow">Интеграции</span>
      <h2>Интеграция с CRM, документами и внутренними системами</h2>
      <p><strong>Интеграция AI-регламентов</strong> — то, чего не хватает у дешёвых генераторов и текстовых консультантов.</p>
    </div>

    <div class="vna-card nero-ai-reveal">
      <h3>Связка регламентов с amoCRM и воронкой</h3>
      <p>Этапы сделки в CRM = якоря регламента. При смене этапа менеджер видит чек-лист действий. Обязательные поля в amoCRM / Bitrix24 сверяются с текстом SOP.</p>
    </div>

    <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px;">
      <table class="vna-table" aria-label="Стек Notion + LLM + RAG">
        <thead>
          <tr><th>Компонент</th><th>Роль</th></tr>
        </thead>
        <tbody>
          <tr><td>Notion / Docs / Confluence</td><td>Редактируемая база, владелец, история</td></tr>
          <tr><td>LLM</td><td>Черновики, синхронизация терминологии</td></tr>
          <tr><td>Qdrant / pgvector</td><td>Векторный индекс утверждённых документов</td></tr>
          <tr><td>Make / n8n</td><td>Reindex при правке документа</td></tr>
          <tr><td>Telegram-бот</td><td>«Спроси регламент» для линейных</td></tr>
        </tbody>
      </table>
    </div>
    <p class="nero-ai-reveal" style="margin-top:20px;"><strong>Внедрение нейросетей в рабочие процессы</strong> на этом уровне — продолжение уже оцифрованных операций (CRM, ERP), а не параллельная «игрушка в чате».</p>
  </div>
</section>

<!-- ================================================
     #riski (без пункта меню)
     ================================================ -->
<section class="vna-section" id="riski">
  <div class="vna-cnt">
    <div class="vna-sh">
      <span class="vna-eyebrow">Риски</span>
      <h2>Риски и как мы их закрываем</h2>
    </div>

    <div class="vna-table-wrap nero-ai-reveal">
      <table class="vna-table" aria-label="Риски AI-регламентов и меры">
        <thead>
          <tr><th>Риск</th><th>Как закрываем</th></tr>
        </thead>
        <tbody>
          <tr><td>Галлюцинации в инструкциях</td><td><span class="vna-badge" style="background:rgba(34,197,94,.15);color:#4ade80;">SME-ревью</span> RAG только по approved, чек-лист валидации</td></tr>
          <tr><td>Устаревание документов</td><td>Владелец, квартальный ревью, авто-reindex</td></tr>
          <tr><td>ПДн и внешние LLM</td><td>Классификация данных, YandexGPT/GigaChat, no-train тарифы</td></tr>
          <tr><td>Юридика и ЛНА</td><td>Отдельный проход HR/юриста, AI не подменяет экспертизу</td></tr>
          <tr><td>«Регламент никто не читает»</td><td>Короткие SOP + поиск в боте + CRM-этапы</td></tr>
        </tbody>
      </table>
    </div>

    <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
      <div class="vna-card">
        <h3>Галлюцинации в инструкциях</h3>
        <p>Нейросеть не знает ваших скидочных политик, пока вы их не зафиксировали. Цикл <strong>evidence → draft → validate</strong> (Clearwork, 2026) — обязателен. AI предлагает структуру; владелец правит доменные термины и юридически значимые фразы.</p>
      </div>
      <div class="vna-card">
        <h3>Юридические и HR-ограничения</h3>
        <p>Для кадровых и дисциплинарных процедур — отдельный контур согласования. AI ускоряет черновик, не снимает ответственность с работодателя. <strong>Законопроект об ИИ (ID 166424):</strong> ориентир вступления — 1 сентября 2027; рекомендация — внутренний регламент использования ИИ.</p>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     #keisy
     ================================================ -->
<section class="vna-section vna-section-alt" id="keisy">
  <div class="vna-cnt">
    <div class="vna-sh">
      <span class="vna-eyebrow">Кейсы</span>
      <h2>Кейсы и примеры внедрения AI-регламентов</h2>
      <p>Подтверждённые примеры смежных внедрений — без выдуманных цифр.</p>
    </div>

    <div class="vna-case-grid nero-ai-reveal">
      <div class="vna-case-card">
        <div class="vna-case-tag">Кейс 1</div>
        <h3>Производство, 12 филиалов, 500+ сотрудников</h3>
        <p>Единая ИИ-база знаний, поиск <strong>с 20–40 минут до секунд</strong>.</p>
        <div class="vna-metrics">
          <div class="vna-metric"><span class="num">LighTech</span><span class="lbl"><a href="https://thelightech.ru/projects/ai/ii-baza-znaniy-dlya-proizvodstvennoy-kompanii/" target="_blank" rel="noopener noreferrer">thelightech.ru</a></span></div>
        </div>
      </div>
      <div class="vna-case-card">
        <div class="vna-case-tag">Кейс 2</div>
        <h3>Сеть ресторанов, 10+ точек</h3>
        <p>Notion + RAG (Qdrant), ролевой доступ, один векторный слой для всех AI-сервисов.</p>
        <div class="vna-metrics">
          <div class="vna-metric"><span class="num">1000+</span><span class="lbl">страниц документов</span></div>
        </div>
      </div>
      <div class="vna-case-card">
        <div class="vna-case-tag">Кейс 3</div>
        <h3>Производственный SOP через нейросеть</h3>
        <p><strong>24 регламента за рабочую неделю</strong>; один SOP — <strong>50–60 мин</strong> vs <strong>6–10 ч</strong> вручную.</p>
        <div class="vna-metrics">
          <div class="vna-metric"><span class="num">GPTmag</span><span class="lbl">интервью + LLM + ревью</span></div>
        </div>
      </div>
      <div class="vna-case-card">
        <div class="vna-case-tag">Кейс 4</div>
        <h3>Корпоративный RAG</h3>
        <p>Точность <strong>85–95%</strong> на типовых задачах; версионирование регламентов в метаданных индекса.</p>
        <div class="vna-metrics">
          <div class="vna-metric"><span class="num">AGmind</span><span class="lbl">корпоративный RAG</span></div>
        </div>
      </div>
    </div>
    <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;"><strong>Пример внедрения AI-регламентов</strong> для вашей компании начинается с одного процесса — не с копирования чужого кейса один в один.</p>
  </div>
</section>

<!-- ================================================
     #ceny
     ================================================ -->
<section class="vna-section" id="ceny">
  <div class="vna-cnt">
    <div class="vna-sh">
      <span class="vna-eyebrow">Стоимость</span>
      <h2>Стоимость внедрения AI-регламентов</h2>
      <p><strong>AI регламенты цена</strong> в модели Nero Network — ориентир <strong>100–300 тыс. ₽</strong> за пакет с 1–3 процессами, публикацией в KB и обучением.</p>
    </div>

    <div class="vna-table-wrap nero-ai-reveal">
      <table class="vna-table" aria-label="Сравнение стоимости вариантов">
        <thead>
          <tr><th>Вариант</th><th>Ориентир стоимости</th><th>Что получаете</th></tr>
        </thead>
        <tbody>
          <tr><td>SaaS-генератор</td><td>от ~$99/мес</td><td>Текст без внедрения и CRM</td></tr>
          <tr><td>Западный Trainual</td><td>~$250/мес</td><td>Onboarding без локализации и RAG</td></tr>
          <tr><td>Классический консалтинг</td><td>«индивидуально», часто выше</td><td>Документы без AI и бота</td></tr>
          <tr><td><strong>Nero Network под ключ</strong></td><td><strong>100–300 тыс. ₽</strong> разово</td><td>Интервью → AI → KB → интеграции</td></tr>
        </tbody>
      </table>
    </div>

    <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
      <div class="vna-card">
        <h3>Из чего складывается цена</h3>
        <ul>
          <li>количество процессов и глубина интервью;</li>
          <li>объём интеграций (CRM, RAG, Telegram);</li>
          <li>контур данных (облачный LLM vs YandexGPT/GigaChat);</li>
          <li>участие юриста/HR в согласовании ЛНА;</li>
          <li>обучение и сопровождение после запуска.</li>
        </ul>
      </div>
      <div class="vna-card">
        <h3>Что входит в пакет «под ключ»</h3>
        <p>Аудит → генерация <strong>ai регламенты</strong> и инструкций → валидация → публикация <strong>ai база знаний компании</strong> → AI-политика → обучение → чек-лист обновлений. Опционально — RAG-ассистент и <strong>интеграция ai регламенты с crm</strong>.</p>
      </div>
    </div>
    <p class="nero-ai-reveal" style="margin-top:20px;">ROI считается через онбординг и текучку: меньше «переспросов» у старших, быстрее выход новичка на норму, единые стандарты во филиалах — без обещания выдуманных процентов без замеров у вас.</p>
  </div>
</section>

<!-- ================================================
     #shablon
     ================================================ -->
<section class="vna-section vna-section-alt" id="shablon">
  <div class="vna-cnt">
    <div class="vna-sh">
      <span class="vna-eyebrow">Лид-магнит</span>
      <h2>Шаблон регламента отдела продаж</h2>
      <p>Скачиваемый шаблон — основа для <strong>настройки ai регламенты</strong> под ваш отдел.</p>
    </div>

    <div class="ym-lead-magnet nero-ai-reveal" style="border:2px solid rgba(34,197,94,.35);border-radius:20px;padding:28px 32px;background:rgba(34,197,94,.06);max-width:820px;margin:0 auto;">
      <p style="font-weight:700;color:#4ade80;margin-bottom:16px;">📋 10 блоков шаблона регламента отдела продаж</p>
      <ol style="margin:0;padding-left:20px;color:var(--vna-muted);line-height:1.8;">
        <li>Общие положения (цель, область, термины)</li>
        <li>Организационная структура и роли</li>
        <li>Обязанности по должностям</li>
        <li>Нормативы активности (звонки, встречи, SLA на заявку)</li>
        <li>Этапы воронки продаж + критерии перехода</li>
        <li>Скрипты и стандарты коммуникации</li>
        <li>Правила работы в CRM (обязательные поля, сроки)</li>
        <li>KPI и мотивация</li>
        <li>Обучение и адаптация новичков</li>
        <li>Контроль, отчётность, <strong>история версий</strong></li>
      </ol>
      <p style="margin-top:16px;font-size:14px;"><strong>Приложения:</strong> чек-листы, шаблоны КП/договоров, алгоритмы возражений.</p>
    </div>

    <div class="vna-grid-2 nero-ai-reveal" style="margin-top:32px;">
      <div class="vna-card">
        <h3>Структура блоков шаблона</h3>
        <p>Каждый раздел в AI-генерации заполняется из интервью с РОПом и выгрузки CRM. Блок «Как обновлять регламент»: владелец, квартальный ревью, связь с RAG-индексом при изменении процесса.</p>
      </div>
      <div class="vna-card">
        <h3>Как адаптировать под свой отдел</h3>
        <p>Замените нормативы активности на свои цифры. Привяжите этапы воронки к полям amoCRM/Bitrix24. Удалите лишнее — лучше короткий рабочий SOP, чем энциклопедия. Nero Network при внедрении заполняет шаблон вместе с вами.</p>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     #faq
     ================================================ -->
<section class="vna-section" id="faq">
  <div class="vna-cnt">
    <div class="vna-sh">
      <span class="vna-eyebrow">Вопрос — ответ</span>
      <h2>FAQ по AI-регламентам и базе знаний</h2>
    </div>

    <div class="vna-faq nero-ai-reveal">
      <div class="vna-faq-item" id="faq-kak-vnedrit">
        <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai регламенты в компании?</div>
        <div class="vna-faq-a">
          <p>Короткий путь: (1) выбрать один процесс с максимальной болью; (2) интервью с владельцем 45–60 мин; (3) AI-черновик по шаблону; (4) ревью и утверждение; (5) публикация в KB; (6) обучение и привязка к CRM. Полный цикл с Nero Network — <strong>2–3 недели</strong> на стартовый пакет.</p>
        </div>
      </div>
      <div class="vna-faq-item" id="faq-srok">
        <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает первый процесс?</div>
        <div class="vna-faq-a">
          <p>От аудита до публикации одного приоритетного SOP — <strong>около 1–2 недель</strong> внутри проекта; генерация черновика после интервью — <strong>50–90 минут</strong> машинного времени плюс ревью владельца.</p>
        </div>
      </div>
      <div class="vna-faq-item" id="faq-msp">
        <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли для малого бизнеса?</div>
        <div class="vna-faq-a">
          <p>Да, если есть повторяющийся процесс и хотя бы один «носитель знаний», готовый к интервью. Формат <strong>ai регламенты для малого бизнеса</strong> — 1–2 процесса, Notion/Docs, без тяжёлого RAG на старте.</p>
        </div>
      </div>
      <div class="vna-faq-item" id="faq-crm">
        <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли связать с уже внедрённым AI в CRM?</div>
        <div class="vna-faq-a">
          <p>Да. <strong>Интеграция ai регламенты с crm</strong> логично стыкуется с проектами внедрения AI в amoCRM, обработке email в CRM, ERP — регламенты описывают <em>как</em> работать в уже настроенных системах.</p>
        </div>
      </div>
      <div class="vna-faq-item" id="faq-gallyucinacii">
        <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">AI напишет ерунду?</div>
        <div class="vna-faq-a">
          <p>Возможно — в черновике. Поэтому human-in-the-loop: владелец утверждает, RAG отвечает только по approved-документам, юридика проходит отдельно.</p>
        </div>
      </div>
      <div class="vna-faq-item" id="faq-pdn">
        <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Что с персональными данными?</div>
        <div class="vna-faq-a">
          <p>Классификация данных, запрет выгрузки ПДн во внешние модели без согласия, on-prem или российские модели по контуру клиента.</p>
        </div>
      </div>
      <div class="vna-faq-item" id="faq-ustarevanie">
        <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Потом всё устареет?</div>
        <div class="vna-faq-a">
          <p>Без владельца документа любая база устаревает — с AI или без. Мы закладываем владельца, квартальный ревью и авто-reindex при правках.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     #cta
     ================================================ -->
<section class="vna-section vna-section-alt" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
  <div class="vna-cnt" style="text-align:center;">
    <span class="vna-eyebrow">Первый шаг</span>
    <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px;">Опишите первый процесс — начнём с аудита</h2>
    <p style="max-width:620px;margin:0 auto 24px;font-size:16px;"><strong>Внедрение AI в бизнес</strong> перестаёт быть абстракцией, когда первый регламент реально работает в CRM и в базе знаний. Не нужно оцифровывать всю компанию сразу — достаточно одного процесса, который сейчас держится на «Пете в голове».</p>
    <p style="max-width:620px;margin:0 auto 28px;"><strong>Опишите первый процесс</strong> — отдел продаж, сервис или франшиза: Nero Network проведёт экспресс-аудит, предложит состав пакета <strong>ai регламенты под ключ</strong> и отдаст <strong>шаблон регламента отдела продаж</strong> для старта.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</section>

<!-- CTA-3: footer-final -->
<div class="vna-cnt">
  <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Готовы оцифровать знания команды?</p>
      <p class="ym-cta-block__sub">Экспресс-аудит одного процесса, состав пакета ai регламенты под ключ и шаблон регламента отдела продаж — бесплатно на старте.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </div>
</div>
<section class="vna-section vna-section-alt vna-related-section" id="related" aria-label="Смежные материалы по внедрению AI">
  <div class="vna-cnt">
    <div class="vna-sh vna-left nero-ai-reveal">
      <span class="vna-eyebrow">Смежные материалы</span>
      <h2>Читайте также: внедрение AI в операционные процессы</h2>
      <p>AI-регламенты описывают <em>как</em> работать в уже настроенных системах — эти посадочные закрывают смежные задачи автоматизации.</p>
    </div>
    <div class="vna-grid-3 nero-ai-reveal">
      <div class="vna-card">
        <h3>CRM и воронка продаж</h3>
        <p>Регламенты этапов сделки логично стыкуются с <a href="/vnedrenie-ai-amocrm/">внедрением AI-агента в amoCRM под ключ</a> — когда CRM автоматизирует сделки, SOP фиксирует скрипты, поля и критерии перехода.</p>
      </div>
      <div class="vna-card">
        <h3>Сервис и входящая почта</h3>
        <p>Для первой линии поддержки полезно сопоставить инструкции эскалации с <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработкой входящей почты в CRM</a> — triage писем и SLA в одном контуре.</p>
      </div>
      <div class="vna-card">
        <h3>Учёт и ERP-процессы</h3>
        <p>Когда регламенты затрагивают заказы, счета и документооборот, рядом стоит <a href="/ai-1c-erp/">AI-агент для 1С и ERP под ключ</a> — оцифрованные операции в учётной системе.</p>
      </div>
    </div>
  </div>
</section>
</div><!-- /.vna-content -->

<script>
/**
 * reglamenty-kb-engine — Мастерская оцифровки знаний
 * Мир: tacit thoughts → interview → SOP draft → SME stamp → KB publish
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("reglamenty-kb-canvas");
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
    pageBg: "#f8fafc",
    pageLine: "#cbd5e1",
    spiral: "rgba(139,92,246,0.28)",
    spiralGlow: "rgba(121,242,255,0.35)",
    hubBase: "#1e293b",
    hubAccent: "#79f2ff",
    hubGreen: "#22c55e",
    thought: "rgba(251,191,36,0.35)",
    stamp: "#8b5cf6",
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

  /* Облака tacit knowledge — зона «в головах» */
  function TacitThoughtCloud() {
    this.pulse = 0;
  }
  TacitThoughtCloud.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.pulse = Math.sin(frame * 0.06) * 0.15 + 0.85;
    var clouds = [
      { x: -145, y: -55, r: 22 },
      { x: -125, y: 15, r: 18 },
      { x: -155, y: 45, r: 16 }
    ];
    clouds.forEach(function (cl, i) {
      var alpha = 0.25 + Math.sin(frame * 0.05 + i) * 0.1;
      ctx.fillStyle = "rgba(251,191,36," + alpha + ")";
      ctx.beginPath();
      ctx.arc(cl.x, cl.y, cl.r * (prg < 80 ? 1 + Math.sin(frame * 0.08) * 0.08 : 1), 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1;
      ctx.stroke();
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("?", cl.x, cl.y + 3);
    });
    if (prg < 70) {
      ctx.fillStyle = "rgba(251,191,36,0.5)";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("tacit", -175, -72);
    }
  };

  /* Спиральный поток документов — не конвейер */
  function DocumentSpiralConduit() {
    this.phase = 0;
  }
  DocumentSpiralConduit.prototype.draw = function (ctx) {
    this.phase = (frame * 0.022) % (Math.PI * 2);
    var spirals = [
      { cx: -90, cy: -10, r: 55, turns: 1.2 },
      { cx: -70, cy: 20, r: 40, turns: 0.9 }
    ];
    spirals.forEach(function (sp, idx) {
      ctx.save();
      ctx.strokeStyle = idx === 0 ? C.spiralGlow : C.spiral;
      ctx.lineWidth = idx === 0 ? 2 : 1;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      for (var a = 0; a <= sp.turns * Math.PI * 2; a += 0.12) {
        var rad = (a / (sp.turns * Math.PI * 2)) * sp.r;
        var sx = sp.cx + Math.cos(a + Math.PI) * rad;
        var sy = sp.cy + Math.sin(a + Math.PI) * rad * 0.55;
        if (a === 0) ctx.moveTo(sx, sy);
        else ctx.lineTo(sx, sy);
      }
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();
    });

    for (var i = 0; i < 4; i++) {
      var t = (this.phase + i * 1.4) % (Math.PI * 2);
      var rad = (t / (Math.PI * 2)) * 55;
      var px = -90 + Math.cos(t + Math.PI) * rad;
      var py = -10 + Math.sin(t + Math.PI) * rad * 0.55;
      drawDocFragment(ctx, px, py, 10, 12, i % 2 === 0 ? C.pageBg : "#e0e7ff");
    }
  };

  function drawDocFragment(ctx, x, y, w, h, color) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -w / 2, -h / 2, w, h, 2, color, C.outline);
    ctx.strokeStyle = C.pageLine;
    ctx.lineWidth = 1;
    for (var ln = 0; ln < 3; ln++) {
      ctx.beginPath();
      ctx.moveTo(-w / 2 + 2, -h / 2 + 4 + ln * 3);
      ctx.lineTo(w / 2 - 2, -h / 2 + 4 + ln * 3);
      ctx.stroke();
    }
    ctx.restore();
  }

  /* Центральный хаб сборки SOP */
  function SopCompilationHub() {
    this.layers = 0;
    this.publishRipple = 0;
  }
  SopCompilationHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -58, -72, 116, 148, 10, C.hubBase, C.outline);

    /* Слои документа по фазам */
    var layerCount = 0;
    if (prg >= 55) layerCount = 1;
    if (prg >= 95) layerCount = 2;
    if (prg >= 135) layerCount = 3;
    if (prg >= 175) layerCount = 4;

    for (var L = 0; L < layerCount; L++) {
      var off = L * 3;
      drawRR(ctx, -42 + off, -58 + off, 84, 100, 4, C.pageBg, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "left";
      var titles = ["§1 Цель", "§5 Воронка", "§7 CRM", "§10 Версии"];
      ctx.fillText(titles[L] || "SOP", -36 + off, -48 + off);
      for (var ln = 0; ln < 4; ln++) {
        drawRR(ctx, -36 + off, -38 + off + ln * 14, 70 - ln * 8, 6, 1, C.pageLine, null);
      }
    }

    /* Фаза VALIDATE — штамп SME */
    if (prg >= 140 && prg < 200) {
      var stampAlpha = Math.min(1, (prg - 140) / 20);
      ctx.save();
      ctx.globalAlpha = stampAlpha;
      ctx.translate(25, 15);
      ctx.rotate(-0.35);
      ctx.strokeStyle = C.stamp;
      ctx.lineWidth = 2;
      ctx.strokeRect(-22, -10, 44, 20);
      ctx.fillStyle = "rgba(139,92,246,0.2)";
      ctx.fillRect(-22, -10, 44, 20);
      ctx.fillStyle = C.stamp;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("УТВЕРЖДЕНО", 0, 4);
      ctx.restore();
      ctx.globalAlpha = 1;
    }

    /* Фаза PUBLISH — импульс синхронизации KB */
    if (prg >= 195) {
      this.publishRipple = Math.min(1, (prg - 195) / 30);
      ctx.strokeStyle = "rgba(34,197,94," + (0.85 - this.publishRipple * 0.75) + ")";
      ctx.lineWidth = 2.5;
      ctx.beginPath();
      ctx.arc(0, -10, 18 + this.publishRipple * 55, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = C.hubGreen;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("KB sync", 0, 78);
    }

    /* RAG-луч после публикации */
    if (prg >= 210 && prg < 250) {
      var beamA = Math.min(1, (prg - 210) / 15) * (prg < 235 ? 1 : 1 - (prg - 235) / 15);
      ctx.strokeStyle = "rgba(121,242,255," + beamA * 0.75 + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(0, 55);
      ctx.lineTo(0, 95);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = C.hubAccent;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("RAG · поиск", 0, 108);
    }
  };

  /* Микрофон интервью */
  function InterviewMicStand() {
    this.glow = 0;
  }
  InterviewMicStand.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -175, -35, 4, 50, 2, C.outline, null);
    drawRR(ctx, -182, 12, 18, 10, 4, "#64748b", C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.beginPath();
    ctx.arc(-172, -38, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();

    if (prg >= 10 && prg < 65) {
      this.glow = Math.sin((prg - 10) * 0.12) * 0.5 + 0.5;
      ctx.fillStyle = "rgba(121,242,255," + (0.15 + this.glow * 0.25) + ")";
      ctx.beginPath();
      ctx.arc(-172, -38, 14 + this.glow * 6, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("INT", -172, -60);
    }
  };

  /* Стеллаж версий KB */
  function VersionLedger() {
    this.tagY = 0;
  }
  VersionLedger.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 118, -50, 42, 110, 6, "rgba(255,255,255,0.06)", C.outline);
    var versions = ["v0.9", "v1.0", "v1.1"];
    versions.forEach(function (v, i) {
      drawRR(ctx, 124, -42 + i * 32, 30, 22, 4, i === 1 && prg >= 200 ? "rgba(34,197,94,0.25)" : "rgba(255,255,255,0.08)", C.outline);
      ctx.fillStyle = i === 1 && prg >= 200 ? "#bbf7d0" : "#94a3b8";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(v, 139, -28 + i * 32);
    });

    if (prg >= 205 && prg < 240) {
      this.tagY = Math.min(1, (prg - 205) / 20);
      var ty = 30 - this.tagY * 45;
      drawRR(ctx, 108, ty, 24, 14, 3, C.hubGreen, C.outline);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("live", 120, ty + 10);
    }
  };

  /* Agent — радиальное движение к хабу */
  function Agent(x, y, color, role, stepTrig, dialogs, targetAngle) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.targetAngle = targetAngle;
    this.hitAnimation = 0;
  }
  Agent.prototype.draw = function (ctx) {
    this.timer += 0.032;
    var isMoving = false;
    var carryType = null;
    var faceDir = 1;
    var prg = (frame * 0.038) % 260;
    var hubDist = 55;
    var targetX = Math.cos(this.targetAngle) * hubDist;
    var targetY = -15 + Math.sin(this.targetAngle) * hubDist * 0.6;

    if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
      var localPrg = prg - this.stepTrig;
      if (localPrg < 12) {
        isMoving = true;
        faceDir = targetX > this.baseX ? 1 : -1;
        carryType = this.color;
        var t = localPrg / 12;
        this.x = this.baseX + (targetX - this.baseX) * t;
        this.y = this.baseY + (targetY - this.baseY) * t;
      } else if (localPrg < 16) {
        isMoving = false;
        this.x = targetX;
        this.y = targetY;
      } else {
        isMoving = true;
        faceDir = targetX > this.baseX ? -1 : 1;
        var t2 = (localPrg - 16) / 12;
        this.x = targetX - (targetX - this.baseX) * t2;
        this.y = targetY - (targetY - this.baseY) * t2;
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 18, rnd, 240);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 4)) * 2 : Math.sin(this.timer * 1.4) * 1;
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.lineJoin = "round";

    var legL = 0, legR = 0;
    if (isMoving) {
      var walkPhase = this.timer * 5.5;
      legL = Math.sin(walkPhase) * 4;
      legR = Math.sin(walkPhase + Math.PI) * 4;
    }
    drawRR(ctx, -8, -4 + Math.max(0, legL), 7, 12, 2, C.outline, null);
    drawRR(ctx, -10, 4 + Math.max(0, legL), 10, 5, 2, C.outline, null);
    drawRR(ctx, 1, -4 + Math.max(0, legR), 7, 12, 2, C.outline, null);
    drawRR(ctx, -1, 4 + Math.max(0, legR), 10, 5, 2, C.outline, null);
    drawRR(ctx, -12, -10 - bob, 24, 16, 5, this.color, C.outline);

    var hx = 0, hy = -24 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(hx, hy, 10, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 1.5;
    ctx.strokeStyle = C.outline;
    ctx.stroke();

    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 2, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
    ctx.restore();

    if (carryType) {
      drawDocFragment(ctx, -14 * faceDir, -14 - bob, 9, 11, carryType === C.agentYellow ? "#fef3c7" : C.pageBg);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new TacitThoughtCloud());
  entities.push(new DocumentSpiralConduit());
  entities.push(new InterviewMicStand());
  entities.push(new SopCompilationHub());
  entities.push(new VersionLedger());

  entities.push(new Agent(-165, 55, C.agentYellow, "1_architect", 18, [
    "Как у вас сейчас?", "Фиксирую шаги", "Интервью 45 мин", "Процесс в CRM?"
  ], -2.4));
  entities.push(new Agent(-55, 75, C.agentGreen, "2_seo", 58, [
    "Оглавление SOP", "Блоки для FAQ", "Структура §1–10", "LSI в регламент"
  ], -1.6));
  entities.push(new Agent(15, 70, C.agentBlue, "3_coder", 98, [
    "Поля amoCRM", "Чек-лист этапа", "Связка с CRM", "Обязательные поля"
  ], -0.5));
  entities.push(new Agent(75, 45, C.agentPink, "4_designer", 138, [
    "Убираю воду", "SOP на 5 мин", "Короткий блок", "Читаемо линейным"
  ], 0.6));
  entities.push(new Agent(130, 20, C.agentPurple, "5_deployer", 178, [
    "Публикуем в Notion", "KB live!", "Reindex RAG", "v1.0 в стеллаже"
  ], 1.4));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife, maxLife: customLife });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.038) % 260;
    if (prg >= 16 && prg < 16.05) createBubble(-165, 20, "1. Интервью");
    if (prg >= 56 && prg < 56.05) createBubble(-55, 40, "2. Структура SOP");
    if (prg >= 96 && prg < 96.05) createBubble(15, 35, "3. CRM-поля");
    if (prg >= 136 && prg < 136.05) createBubble(75, 15, "4. Короткий SOP");
    if (prg >= 176 && prg < 176.05) createBubble(130, -5, "5. Публикация KB");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 25);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var bx = bub.x;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2);
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
$reg_page_url = trailingslashit( get_permalink() );
$reg_site_url = trailingslashit( home_url( '/' ) );
$reg_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$reg_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $reg_site_url . '#organization',
      'name'  => $reg_brand,
      'url'   => $reg_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $reg_site_url . '#website',
      'url'       => $reg_site_url,
      'name'      => $reg_brand,
      'publisher' => [ '@id' => $reg_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $reg_page_url . '#webpage',
      'url'         => $reg_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $reg_site_url . '#website' ],
      'about'       => [ '@id' => $reg_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $reg_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $reg_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $reg_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $reg_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $reg_page_url,
      'provider'    => [ '@id' => $reg_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $reg_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить ai регламенты в компании?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Короткий путь: (1) выбрать один процесс с максимальной болью; (2) интервью с владельцем 45–60 мин; (3) AI-черновик по шаблону; (4) ревью и утверждение; (5) публикация в KB; (6) обучение и привязка к CRM. Полный цикл с Nero Network — 2–3 недели на стартовый пакет.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько времени занимает первый процесс?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'От аудита до публикации одного приоритетного SOP — около 1–2 недель внутри проекта; генерация черновика после интервью — 50–90 минут машинного времени плюс ревью владельца.' ] ],
        [ '@type' => 'Question', 'name' => 'Подходит ли для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, если есть повторяющийся процесс и хотя бы один «носитель знаний», готовый к интервью. Формат ai регламенты для малого бизнеса — 1–2 процесса, Notion/Docs, без тяжёлого RAG на старте.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли связать с уже внедрённым AI в CRM?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Интеграция ai регламенты с crm логично стыкуется с проектами внедрения AI в amoCRM, обработке email в CRM, ERP — регламенты описывают как работать в уже настроенных системах.' ] ],
        [ '@type' => 'Question', 'name' => 'AI напишет ерунду?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Возможно — в черновике. Поэтому human-in-the-loop: владелец утверждает, RAG отвечает только по approved-документам, юридика проходит отдельно.' ] ],
        [ '@type' => 'Question', 'name' => 'Что с персональными данными?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Классификация данных, запрет выгрузки ПДн во внешние модели без согласия, on-prem или российские модели по контуру клиента.' ] ],
        [ '@type' => 'Question', 'name' => 'Потом всё устареет?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Без владельца документа любая база устаревает — с AI или без. Мы закладываем владельца, квартальный ревью и авто-reindex при правках.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $reg_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

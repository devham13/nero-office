<?php
/**
 * Template Name: AI-квалификация лидов: внедрение и настройка под ключ
 * Description: Внедрение AI-квалификации лидов: скоринг, статусы hot/warm/cold, интеграция с CRM. Карта квалификации — бесплатно.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-квалификация лидов под ключ — скоринг и CRM';
$page_seo_description = 'Внедрение AI-квалификации лидов: статусы горячий, тёплый, холодный, нецелевой до менеджера. Скоринг, интеграция с CRM, кейсы. Карта квалификации — бесплатно.';

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
    ['label' => 'Зачем', 'href' => '#zachem'],
    ['label' => 'Скоринг', 'href' => '#chto-takoe'],
    ['label' => 'Воронка', 'href' => '#voronka'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'CRM', 'href' => '#crm'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить карту квалификации';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
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
.akl-content{
  --akl-bg:#050711;--akl-bg2:#080b17;--akl-bg3:#0a0e1c;
  --akl-surface:rgba(255,255,255,.072);--akl-surface2:rgba(255,255,255,.108);
  --akl-text:#e6edf7;--akl-muted:#9aa8bd;--akl-soft:#c7d2e5;--akl-heading:#fff;
  --akl-border:rgba(255,255,255,.10);--akl-border-s:rgba(255,255,255,.18);
  --akl-accent:#79f2ff;--akl-violet:#8b5cf6;--akl-green:#22c55e;--akl-cyan:#79f2ff;
  --akl-btn-from:#2563eb;--akl-btn-to:#7c3aed;
  --akl-shadow:0 24px 72px rgba(0,0,0,.4);
  --akl-r:18px;--akl-r-lg:24px;
  --akl-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--akl-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.akl-content *,.akl-content *::before,.akl-content *::after{box-sizing:border-box;}
.akl-content a{color:inherit;text-decoration:none;}
.akl-content p{color:var(--akl-muted);line-height:1.72;margin:0 0 1em;}
.akl-content p:last-child{margin-bottom:0;}
.akl-content h2,.akl-content h3,.akl-content h4{
  color:var(--akl-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.akl-content strong{color:var(--akl-soft);}
.akl-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.akl-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--akl-muted);font-size:14.5px;line-height:1.65;
}
.akl-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--akl-accent);font-weight:700;
}

/* Container */
.akl-cnt{
  width:min(var(--akl-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.akl-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.akl-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.akl-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.akl-sh.akl-left{margin-left:0;text-align:left;}
.akl-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.akl-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.akl-sh.akl-left p{margin-left:0;}

/* Eyebrow */
.akl-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--akl-accent);margin-bottom:14px;
}

/* Gradient text */
.akl-gt{
  background:linear-gradient(92deg,#fff 0%,var(--akl-accent) 44%,var(--akl-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.akl-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.akl-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.akl-intro-text{
  position:relative;padding-left:20px;
}
.akl-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--akl-accent),var(--akl-violet));
}
.akl-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--akl-muted);margin-bottom:1em;
}
.akl-intro-text p:last-child{margin-bottom:0;color:var(--akl-soft);}
.akl-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.akl-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.akl-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--akl-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.akl-kpi-card .kl{font-size:11px;font-weight:600;color:var(--akl-muted);line-height:1.4;}
.akl-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .akl-intro-grid{grid-template-columns:1fr;gap:36px;}
  .akl-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .akl-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.akl-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.akl-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.akl-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--akl-surface);border:1px solid var(--akl-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--akl-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.akl-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--akl-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.akl-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--akl-border);border-radius:var(--akl-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.akl-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.akl-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.akl-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .akl-grid-2{grid-template-columns:1fr;}
  .akl-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .akl-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .akl-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.akl-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--akl-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.akl-level-card:hover{transform:translateY(-2px);}
.akl-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--akl-r) var(--akl-r) 0 0;
}
.akl-level-card.l1::before{background:var(--akl-green);}
.akl-level-card.l2::before{background:var(--akl-accent);}
.akl-level-card.l3::before{background:var(--akl-violet);}
.akl-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.akl-level-card.l1 .akl-level-badge{background:rgba(34,197,94,.15);color:var(--akl-green);}
.akl-level-card.l2 .akl-level-badge{background:rgba(121,242,255,.15);color:var(--akl-accent);}
.akl-level-card.l3 .akl-level-badge{background:rgba(139,92,246,.15);color:var(--akl-violet);}
.akl-level-card h3{font-size:17px;margin-bottom:10px;}
.akl-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.akl-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--akl-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.akl-scenario:last-child{margin-bottom:0;}
.akl-scenario:hover{border-color:rgba(121,242,255,.3);}
.akl-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.akl-scenario h3{font-size:17px;margin-bottom:8px;}
.akl-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.akl-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.akl-table{width:100%;border-collapse:collapse;font-size:14px;}
.akl-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--akl-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.akl-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--akl-text);vertical-align:top;
}
.akl-table tr:last-child td{border-bottom:none;}
.akl-table tr:hover td{background:rgba(255,255,255,.03);}
.akl-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.akl-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.akl-stack-layer:last-child{border-bottom:none;}
.akl-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--akl-accent);padding-top:2px;
}
.akl-stack-val{font-size:14.5px;color:var(--akl-text);}
.akl-stack-desc{font-size:13px;color:var(--akl-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.akl-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.akl-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.akl-case-grid{grid-template-columns:1fr;}}
.akl-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.akl-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.akl-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--akl-green);margin-bottom:10px;
}
.akl-case-card h3{font-size:16px;margin-bottom:14px;}
.akl-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.akl-metric{display:flex;align-items:baseline;gap:8px;}
.akl-metric .num{font-size:22px;font-weight:900;color:var(--akl-accent);flex-shrink:0;letter-spacing:-.04em;}
.akl-metric .lbl{font-size:13px;color:var(--akl-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.akl-timeline{position:relative;padding-left:40px;}
.akl-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--akl-accent),var(--akl-violet));
  opacity:.35;border-radius:2px;
}
.akl-tl-item{position:relative;margin-bottom:32px;}
.akl-tl-item:last-child{margin-bottom:0;}
.akl-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--akl-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.akl-tl-item h3{font-size:17px;margin-bottom:8px;}
.akl-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.akl-pricing-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:960px){.akl-pricing-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.akl-pricing-grid{grid-template-columns:1fr;}}
.akl-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.akl-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.akl-price-card.akl-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.akl-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--akl-accent);margin-bottom:10px;
}
.akl-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.akl-price-card .inc{font-size:13px;color:var(--akl-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.akl-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.akl-compare{width:100%;border-collapse:collapse;}
.akl-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--akl-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.akl-compare td{
  padding:13px 16px;font-size:14px;color:var(--akl-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.akl-compare tr:last-child td{border-bottom:none;}
.akl-good{color:var(--akl-green);}
.akl-neutral{color:var(--akl-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.akl-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.akl-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.akl-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--akl-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.akl-faq-q::after{
  content:'▾';font-size:13px;color:var(--akl-accent);
  flex-shrink:0;transition:transform .25s;
}
.akl-faq-item.open .akl-faq-q::after{transform:rotate(180deg);}
.akl-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--akl-muted);line-height:1.72;
}
.akl-faq-item.open .akl-faq-a{max-height:600px;padding:0 24px 20px;}

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
  color:var(--akl-muted);font-size:15px;
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
  background:linear-gradient(135deg,var(--akl-btn-from),var(--akl-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(59,130,246,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--akl-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(121,242,255,.4);background:rgba(59,130,246,.12);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* =====================================================
   CTA FINAL SECTION
   ===================================================== */
.akl-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.akl-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--akl-muted);
}
.akl-cta-checklist li::before{content:'✓';color:var(--akl-green);font-weight:800;}

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
.ym-cta-block--secondary{
  background:rgba(255,255,255,.05);
  border-color:rgba(255,255,255,.14);
  text-align:left;
}
.ym-link--accent{color:var(--akl-accent)!important;text-decoration:underline;}
.akl-prose{max-width:920px;margin:0 auto;}
.akl-prose p{text-align:left!important;}
.akl-h3{font-size:clamp(17px,2vw,22px);margin:1.6em 0 .75em;color:var(--akl-heading);}
.akl-checklist{list-style:none;padding:0;margin:1em 0;}
.akl-checklist li{padding-left:24px;position:relative;margin-bottom:.5em;color:var(--akl-muted);}
.akl-checklist li::before{content:'☐';position:absolute;left:0;color:var(--akl-accent);}
.akl-ol{margin:1em 0;padding-left:1.2em;color:var(--akl-muted);}
.akl-cta-btn-wrap{text-align:center;margin-top:28px;}
.akl-faq{display:flex;flex-direction:column;gap:10px;}
.akl-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:0;}
.akl-faq-item summary{padding:19px 24px;font-size:16px;font-weight:700;color:var(--akl-heading);cursor:pointer;list-style:none;}
.akl-faq-item summary::-webkit-details-marker{display:none;}
.akl-faq-a{padding:0 24px 20px;font-size:14.5px;color:var(--akl-muted);}
.akl-link{color:var(--akl-accent);}
.akl-hero-qualify{min-height:min(980px,calc(100dvh - 1px))!important;position:relative!important;}

</style>


<main id="primary" class="site-main nero-ai-home-page ai-kvalifikaciya-lidov-page" role="main" tabindex="-1">
<span id="main" class="screen-reader-text" tabindex="-1"></span>

<section class="nero-ai-hero akl-hero-qualify" id="akl-hero-qualify" aria-labelledby="akl-hero-title">
<style>
/* ——— Hero ai-kvalifikaciya-lidov: самодостаточные стили ——— */
.akl-hero-qualify {
  --akl-bg: #050711;
  --akl-cyan: #79f2ff;
  --akl-violet: #8b5cf6;
  --akl-green: #22c55e;
  --akl-amber: #fbbf24;
  --akl-rose: #fb7185;
  --akl-soft: #c7d2e5;
  --akl-muted: #9aa8bd;
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
  color: #e6edf7;
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
.akl-hero-qualify::before {
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
  z-index: 0;
}
.akl-hero-qualify::after {
  content: "";
  position: absolute;
  left: 58%;
  top: 12%;
  width: 720px;
  height: 720px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(8px);
  animation: aklHeroGlow 9s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes aklHeroGlow {
  from { opacity: .4; transform: translateX(-50%) scale(.94); }
  to { opacity: .9; transform: translateX(-50%) scale(1.05); }
}
.akl-hero-qualify .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.akl-hero-qualify .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.akl-hero-qualify .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--akl-cyan);
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.akl-hero-qualify h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: 0.98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.akl-hero-qualify .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--akl-cyan) 42%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.akl-hero-qualify .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--akl-soft);
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.akl-hero-qualify .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.akl-hero-qualify .nero-ai-badge {
  display: inline-flex;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.akl-hero-qualify .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 34px;
}
.akl-hero-qualify .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 22px;
  border-radius: 999px;
  font-size: 15px;
  font-weight: 800;
  text-decoration: none;
  transition: transform .2s, box-shadow .2s;
}
.akl-hero-qualify .nero-ai-btn-primary {
  color: #fff;
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  box-shadow: 0 12px 32px rgba(37, 99, 235, .35);
}
.akl-hero-qualify .nero-ai-btn-secondary {
  color: #e2e8f0;
  border: 1px solid rgba(255,255,255,.16);
  background: rgba(255,255,255,.06);
}
.akl-hero-qualify .nero-ai-btn:hover { transform: translateY(-2px); }

.akl-hero-qualify .nero-ai-dashboard { position: relative; }
.akl-hero-qualify .nero-ai-dashboard-shell {
  border-radius: 22px;
  border: 1px solid rgba(255,255,255,.12);
  background: rgba(255,255,255,.04);
  box-shadow: 0 24px 72px rgba(0,0,0,.45);
  overflow: hidden;
  backdrop-filter: blur(14px);
}
.akl-hero-qualify .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(0,0,0,.25);
}
.akl-hero-qualify .nero-ai-dots { display: flex; gap: 6px; }
.akl-hero-qualify .nero-ai-dot {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(255,255,255,.18);
}
.akl-hero-qualify .nero-ai-window-title {
  font-size: 11px;
  font-weight: 600;
  color: var(--akl-muted);
  letter-spacing: .04em;
}
.akl-hero-qualify .nero-ai-window-body { padding: 16px 16px 14px; }
.akl-hero-qualify .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 12px;
}
.akl-hero-qualify .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 15px;
  font-weight: 800;
  color: #fff;
  letter-spacing: -.02em;
}
.akl-hero-qualify .nero-ai-live-pill {
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .08em;
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34, 197, 94, .15);
  color: #86efac;
  border: 1px solid rgba(34, 197, 94, .35);
}
.akl-hero-qualify .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 8px;
  margin-bottom: 12px;
}
.akl-hero-qualify .nero-ai-metric {
  padding: 10px 12px;
  border-radius: 12px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.08);
}
.akl-hero-qualify .nero-ai-metric span {
  display: block;
  font-size: 10px;
  font-weight: 600;
  color: var(--akl-muted);
  margin-bottom: 4px;
}
.akl-hero-qualify .nero-ai-metric strong {
  font-size: 20px;
  font-weight: 900;
  color: #fff;
  letter-spacing: -.04em;
}
.akl-hero-qualify .nero-ai-metric small {
  display: block;
  font-size: 9px;
  color: #64748b;
  margin-top: 2px;
}
.akl-hero-qualify .akl-dash-canvas-wrap {
  position: relative;
  height: 220px;
  margin: 0 0 12px;
  border-radius: 14px;
  overflow: hidden;
  background: linear-gradient(180deg, rgba(15,23,42,.55), rgba(8,11,23,.85));
  border: 1px solid rgba(121,242,255,.12);
}
.akl-hero-qualify #akl-lead-qualify-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.akl-hero-qualify .nero-ai-task-stream { display: flex; flex-direction: column; gap: 8px; }
.akl-hero-qualify .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 12px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.07);
  font-size: 12px;
}
.akl-hero-qualify .nero-ai-task-icon {
  width: 28px; height: 28px;
  display: flex; align-items: center; justify-content: center;
  border-radius: 8px;
  background: rgba(255,255,255,.08);
  font-size: 11px;
  font-weight: 800;
}
.akl-hero-qualify .nero-ai-task strong { display: block; color: #f1f5f9; font-size: 12px; }
.akl-hero-qualify .nero-ai-task span { color: var(--akl-muted); font-size: 10px; }
.akl-hero-qualify .nero-ai-status {
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .06em;
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.15);
  color: #86efac;
  border: 1px solid rgba(34,197,94,.3);
}
.akl-hero-qualify .nero-ai-status--hot {
  background: rgba(251, 113, 133, .18);
  color: #fda4af;
  border-color: rgba(251, 113, 133, .35);
}
.akl-hero-qualify .nero-ai-status--warm {
  background: rgba(251, 191, 36, .15);
  color: #fde68a;
  border-color: rgba(251, 191, 36, .35);
}
.akl-hero-qualify .nero-ai-status--cold {
  background: rgba(121, 242, 255, .12);
  color: #a5f3fc;
  border-color: rgba(121, 242, 255, .28);
}
.akl-hero-qualify .nero-ai-status--dq {
  background: rgba(148, 163, 184, .15);
  color: #cbd5e1;
  border-color: rgba(148, 163, 184, .3);
}
@media (max-width: 960px) {
  .akl-hero-qualify .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .akl-hero-qualify { min-height: auto; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">AI для отдела продаж</p>
      <h1 id="akl-hero-title">AI-квалификация лидов: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI присваивает лиду статус до передачи менеджеру — меньше ручного отсева, выше конверсия в сделку</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Аудит воронки</li>
        <li class="nero-ai-badge">Пилот 1 канал</li>
        <li class="nero-ai-badge">CRM + скоринг</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Получить карту квалификации</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Этапы внедрения</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо очереди квалификации лидов">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-скоринга · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Очередь лидов → CRM</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>В очереди</span>
              <strong>12</strong>
              <small>форма + чат</small>
            </div>
            <div class="nero-ai-metric">
              <span>Средний ai_score</span>
              <strong>74</strong>
              <small>0–100</small>
            </div>
            <div class="nero-ai-metric">
              <span>Hot сегодня</span>
              <strong>5</strong>
              <small>SLA 15 мин</small>
            </div>
            <div class="nero-ai-metric">
              <span>Webhook ACK</span>
              <strong>&lt;3 с</strong>
              <small>async queue</small>
            </div>
          </div>

          <div class="akl-dash-canvas-wrap">
            <canvas id="akl-lead-qualify-canvas" role="img" aria-label="Анимация: лиды по импульсным дорожкам проходят AI-скоринг и получают статус до передачи менеджеру"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента квалификации">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">H</span>
              <div><strong>Заявка: внедрение под ключ</strong><span>BANT ok · confidence 0.94</span></div>
              <span class="nero-ai-status nero-ai-status--hot">hot</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">W</span>
              <div><strong>Общий запрос без бюджета</strong><span>nurture · повторный скоринг</span></div>
              <span class="nero-ai-status nero-ai-status--warm">warm</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">C</span>
              <div><strong>Исследование рынка</strong><span>низкий приоритет</span></div>
              <span class="nero-ai-status nero-ai-status--cold">cold</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⊘</span>
              <div><strong>test@test · анти-ICP</strong><span>disqualify_reason: спам</span></div>
              <span class="nero-ai-status nero-ai-status--dq">disq</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="akl-content">

<section class="akl-intro nero-ai-reveal" id="vvedenie">
  <div class="akl-cnt">
    <div class="akl-intro-grid">
      <div class="akl-intro-text">
<p><strong>Коротко:</strong> AI-квалификация лидов — это автоматическая оценка заявки до handoff в отдел продаж: система присваивает статус (горячий, тёплый, холодный, нецелевой), счёт и краткое резюме в CRM, чтобы менеджер не тратил время на отсев и быстрее выходил на приоритетные сделки.</p>
<p>Nero Network внедряет <strong>ai квалификацию лидов под ключ</strong> для B2B-услуг, агентств, девелоперов и команд с amoCRM, Битрикс24 или смешанным стеком: от аудита воронки до пилота на одном канале и масштабирования на почту, мессенджеры и телефонию.</p>
      </div>
      <div class="akl-intro-kpi" aria-hidden="true">
        <div class="akl-kpi-card"><div class="kv">4</div><div class="kl">статуса до менеджера</div><div class="ks">hot · warm · cold · disq</div></div>
        <div class="akl-kpi-card"><div class="kv">&lt;3 с</div><div class="kl">webhook ACK</div><div class="ks">async queue</div></div>
        <div class="akl-kpi-card"><div class="kv">150–450k</div><div class="kl">коридор внедрения</div><div class="ks">₽ под ключ</div></div>
        <div class="akl-kpi-card"><div class="kv">BANT</div><div class="kl">матрица лид-магнит</div><div class="ks">+ MEDDIC</div></div>
      </div>
    </div>
  </div>
</section>

<div class="akl-toc-outer">
  <nav class="akl-toc" aria-label="Оглавление">
    <a href="#zachem">Зачем</a>
    <a href="#chto-takoe">Скоринг</a>
    <a href="#voronka">Воронка</a>
    <a href="#etapy">Этапы</a>
    <a href="#crm">CRM</a>
    <a href="#keisy">Кейсы</a>
    <a href="#ceny">Цена</a>
    <a href="#faq">FAQ</a>
    <a href="#cta">Карта квалификации</a>
  </nav>
</div>

<div class="akl-cnt nero-ai-reveal" style="margin:0 auto 28px;max-width:920px;padding:0 24px;">
<p class="akl-related" style="font-size:15px;color:var(--akl-muted);margin:0 0 14px;line-height:1.55;">Лиды приходят не только с форм сайта: если первичный поток — <strong>входящая почта</strong>, имеет смысл сначала закрыть triage в CRM — см. посадочную про <a href="/vnedrenie-ai-obrabotka-email-crm/" class="akl-link">AI-обработку входящей почты в CRM под ключ</a>, а уже затем накладывать скоринг и статусы hot/warm/cold.</p>
<p class="akl-related" style="font-size:15px;color:var(--akl-muted);margin:0 0 14px;line-height:1.55;">После квалификации частый следующий шаг — учётный контур: <a href="/ai-1c-erp/" class="akl-link">внедрение AI-агента для 1С и ERP</a> связывает сделку в amoCRM или Битрикс24 с заказом и документами без двойного ввода.</p>
<p class="akl-related" style="font-size:15px;color:var(--akl-muted);margin:0;line-height:1.55;">На фоне <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" class="akl-link">корпоративного масштаба внедрения AI</a> (цифровые шлюзы, managed-агенты) скоринг лидов в CRM — та же дисциплина маршрутизации, только ближе к отделу продаж и SLA первого касания.</p>
</div>

<section class="akl-section nero-ai-reveal" id="zachem">
  <div class="akl-cnt">
    <header class="akl-sh"><h2>Зачем квалифицировать лиды до менеджера</h2></header>
    <div class="akl-prose">
<p><strong>Определение:</strong> Квалификация лида — проверка, соответствует ли обращение вашему ICP, есть ли бюджет, срок и полномочия у контакта, и стоит ли передавать его в активные продажи сейчас.</p>
<p>В типичном отделе продаж первичный отсев «съедает» часы: менеджеры открывают CRM, читают формы, отвечают на однотипные вопросы и вручную помечают «мусор». Пока это происходит, <strong>горячие</strong> заявки стоят в общей очереди — и остывают. Боль из практики Nero Network совпадает с формулировкой из вашей воронки: <strong>менеджеры тратят время на нецелевых клиентов</strong>, а целевые не получают SLA первого контакта.</p>
<p><strong>Автоматизация квалификации клиентов</strong> и <strong>ai для отдела продаж</strong> решают не «заменить продавца», а <strong>разделить труд</strong>: машина — первичный скоринг и маршрутизация, человек — переговоры и закрытие. По данным Salesforce *State of Sales 2026*, <strong>87%</strong> организаций продаж уже используют AI (в том числе lead scoring), <strong>54%</strong> продавцов пробовали агентов, а лидеры рынка <strong>1,7×</strong> чаще применяют prospecting AI agents (<a href="https://www.salesforce.com/news/stories/state-of-sales-report-announcement-2026/" class="akl-link" target="_blank" rel="noopener noreferrer">анонс отчёта 2026</a>). В России параллельно растёт связка «CRM + webhook + LLM» с требованиями к <strong>152-ФЗ</strong> и размещению данных.</p>
<p><strong>Итог блока:</strong> квалификация до менеджера — это контроль качества входящего потока и скорости реакции, а не модный чат-бот на сайте.</p>
<h3 class="akl-h3">Сколько стоит «холодный» лид для отдела продаж</h3>
<p>Точную «цену одного холодного лида» в рублях без вашей CRM посчитать нельзя — зависят чек, зарплата менеджера, доля нецелевых и канал. Но порядок величины виден из публичных внедрений:</p>
<div class="akl-table-wrap"><table class="akl-table">
<thead><tr><th>Ситуация (из публикаций интеграторов)</th><th>До</th><th>После автоматизации</th><th>Источник</th></tr></thead><tbody>
<tr><td>~400 лидов/мес, ~70% нецелевые; ответ 2–3 ч</td><td>Ручной отсев, потери hot</td><td>Ответ <strong>30–40 с</strong>, квалифицированные лиды <strong>+35%</strong>, ~<strong>50 ч/мес</strong> экономии менеджеров</td><td>Velmi, Habr 2025</td></tr>
<tr><td>80 лидов/мес, <strong>4 ч/день</strong> на первичку двух менеджеров</td><td>Конверсия в договор 8%</td><td>Первичка <strong>20 мин/день</strong>, первый звонок <strong>до 15 мин</strong>, конверсия <strong>13%</strong></td><td>AX Digital, amoCRM + Claude</td></tr>
</tbody></table></div>
<p>Классические исследования <strong>speed-to-lead</strong> (ответ в первый час vs сутки) в кейсах ссылаются на HBR и legacy MIT Lead Response Management — в лонгриде мы опираемся на них как на аргумент «скорость = шанс квалификации», без выдуманных цифр 2026 года.</p>
<p><strong>Микроконверсия:</strong> запросите <strong>аудит воронки</strong> — разберём источники, долю нецелевых и SLA первого касания под ваш объём лидов.</p>

<aside class="ym-cta-block ym-cta-block--primary" id="cta-audit">
  <div class="ym-cta-block__icon" aria-hidden="true">🎯</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получить карту квалификации лидов — бесплатно</p>
    <p class="ym-cta-block__sub">Матрица BANT с расширением для B2B-услуг, чек-лист полей <code>ai_status</code> / <code>ai_score</code> / <code>qualification_summary</code> и примеры триггеров hot. На коротком созвоне разберём долю нецелевых в вашей CRM — без обязательств.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Получить карту квалификации'); ?></a>
  </div>
</aside>
    </div>
  </div>
</section>

<section class="akl-section akl-section-alt nero-ai-reveal" id="chto-takoe">
  <div class="akl-cnt">
    <header class="akl-sh"><h2>Что такое AI-квалификация и AI-скоринг лидов</h2></header>
    <div class="akl-prose">
<p><strong>Определение:</strong> <strong>AI-квалификация лидов</strong> — автоматическая оценка входящей заявки по заданным критериям (скрипт BANT/MEDDIC, ICP, источник, текст формы, переписка, UTM) с присвоением <strong>статуса и приоритета</strong> до того, как менеджер откроет карточку.</p>
<p><strong>AI лид скоринг</strong> и <strong>скоринг лидов ai</strong> — близкие формулировки одного процесса: модель или правила выставляют <strong>ai_score</strong> (например, 0–100) и пояснение «почему», а не только тег «интересно».</p>
<p>Технически решение — связка: <strong>триггер CRM</strong> (webhook, робот, Salesbot) → <strong>оркестратор</strong> (n8n, FastAPI, Make) → <strong>LLM или ML-скоринг</strong> → <strong>запись в CRM</strong> (поля, теги, задача, стадия, маршрутизация). Модель отвечает за язык и резюме; <strong>детерминированный код</strong> — за статусы, пороги и запрет «hot» на тестовых данных (урок публичного кейса Velmi на Habr).</p>
<p><strong>Чем это не является:</strong></p>
<p>- Не «виджет с FAQ» без записи в CRM.</p>
<p>- Не замена <strong>Salesbot</strong> amoCRM или <strong>BitrixGPT</strong> — встроенные инструменты закрывают сценарии и первое касание; <strong>настройка ai квалификация лидов</strong> под ваш ICP и матрицу BANT — отдельный слой скоринга и маршрутизации.</p>
<p>- Не black-box «вероятность сделки» без workflow: у HubSpot predictive score — это <strong>вероятность</strong>, а не автоматическая передача менеджеру; нужны workflows и SLA (<a href="https://flowrunner.ai/blog/predictive-lead-scoring-hubspot" class="akl-link" target="_blank" rel="noopener noreferrer">обзор ограничений HubSpot scoring</a>).</p>
<h3 class="akl-h3">Статусы: горячий, тёплый, холодный, нецелевой</h3>
<p>Стандарт Nero Network для handoff в продажи — <strong>четыре статуса до менеджера</strong>:</p>
<div class="akl-table-wrap"><table class="akl-table">
<thead><tr><th>Статус</th><th>Смысл для отдела продаж</th><th>Типичные сигналы (примеры)</th><th>Действие в CRM</th></tr></thead><tbody>
<tr><td><strong>Горячий (hot)</strong></td><td>Готов к звонку сейчас, ICP совпадает</td><td>Бюджет/срок названы, ЛПР или сильный champion, запрос на КП/демо</td><td>Задача менеджеру <strong>15 мин</strong>, приоритет в списке</td></tr>
<tr><td><strong>Тёплый (warm)</strong></td><td>Интерес есть, данных мало или срок «позже»</td><td>Общий запрос, нет бюджета в форме, нужен nurturing</td><td>Серия касаний, контент, повторный скоринг через N дней</td></tr>
<tr><td><strong>Холодный (cold)</strong></td><td>Формально целевой сегмент, низкий приоритет</td><td>Долгий горизонт, исследование рынка</td><td>Очередь низкого приоритета или агент nurture (как в кейсах Salesforce по «низким» лидам)</td></tr>
<tr><td><strong>Нецелевой (disqualified)</strong></td><td>Не ваш продукт/регион/антииCP</td><td>Спам, конкурент, ошибка формы, «тест»</td><td>Стадия «отказ», без задачи менеджеру</td></tr>
</tbody></table></div>
<p>В расширенных внедрениях (dual CRM, высокий поток) добавляют категории duplicate, spam, b2b/irrelevant — как в кейсе Wildbots (n8n + GPT), но для посадочной под ключ достаточно <strong>прозрачной четвёрки</strong> плюс поле <code>disqualify_reason</code>.</p>
<p><strong>Правило из практики amoCRM:</strong> при малом объёме данных в заявке — <strong>тёплый, не холодный</strong> (кейс AX Digital): лучше уточнить, чем потерять сделку.</p>
<h3 class="akl-h3">Отличие скоринга от ручной квалификации</h3>
<div class="akl-table-wrap"><table class="akl-table">
<thead><tr><th>Критерий</th><th>Ручная квалификация</th><th>AI-скоринг + правила</th></tr></thead><tbody>
<tr><td>Скорость</td><td>Минуты–часы</td><td>Секунды–десятки секунд после webhook</td></tr>
<tr><td>Единообразие</td><td>Зависит от смены менеджера</td><td>Одна матрица BANT/MEDDIC в промпте и коде</td></tr>
<tr><td>Объяснимость</td><td>Устно</td><td><code>qualification_summary</code> + reasoning в примечании CRM</td></tr>
<tr><td>Масштаб</td><td>Линейно растёт штат</td><td>Очередь и идемпотентность (Redis и аналоги)</td></tr>
<tr><td>Ошибки</td><td>Усталость, субъективность</td><td>Ложный hot → порог confidence, human-in-the-loop</td></tr>
</tbody></table></div>
<p><strong>Итог:</strong> <strong>ai квалификация лидов</strong> не отменяет РОПа — он задаёт ICP, пороги и раз в неделю разбирает спорные карточки.</p>

    </div>
  </div>
</section>

<section id="ai-kvalifikaciya-lidov-boris-block" class="bql-root" aria-label="Анимация: webhook, очередь и AI-скоринг лида до записи в CRM">
<style>
/* === БОРИС: prefix bql-, scoped внутри #ai-kvalifikaciya-lidov-boris-block === */
#ai-kvalifikaciya-lidov-boris-block.bql-root{
  padding:clamp(48px,6vw,72px) 0;
  background:#f1f5f9;
}
#ai-kvalifikaciya-lidov-boris-block .bql-cnt{
  width:min(1160px,calc(100% - 40px));
  margin:0 auto;
}
#ai-kvalifikaciya-lidov-boris-block .bql-card{
  display:grid;
  grid-template-columns:44% 56%;
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 12px 48px rgba(15,23,42,.09),0 0 0 1px rgba(148,163,184,.22);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-kvalifikaciya-lidov-boris-block .bql-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-kvalifikaciya-lidov-boris-block .bql-lft{
  padding:44px 40px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-kvalifikaciya-lidov-boris-block .bql-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-kvalifikaciya-lidov-boris-block .bql-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.11em;
  text-transform:uppercase;
  color:#0891b2;
  margin:0 0 14px;
}
#ai-kvalifikaciya-lidov-boris-block .bql-ey::before{
  content:'';
  width:20px;height:2px;
  background:#0891b2;
  border-radius:1px;
}
#ai-kvalifikaciya-lidov-boris-block .bql-h3{
  font-size:clamp(20px,2.2vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-kvalifikaciya-lidov-boris-block .bql-ul{
  list-style:none;
  margin:0 0 20px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-kvalifikaciya-lidov-boris-block .bql-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.52;
  color:#334155;
}
#ai-kvalifikaciya-lidov-boris-block .bql-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(8,145,178,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0891b2;
  margin-top:1px;
  font-style:normal;
}
#ai-kvalifikaciya-lidov-boris-block .bql-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:16px;
}
#ai-kvalifikaciya-lidov-boris-block .bql-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:11.5px;
  font-weight:700;
  white-space:nowrap;
}
#ai-kvalifikaciya-lidov-boris-block .bql-pl-hot{
  background:rgba(239,68,68,.08);color:#b91c1c;border:1.5px solid rgba(239,68,68,.22);
}
#ai-kvalifikaciya-lidov-boris-block .bql-pl-warm{
  background:rgba(245,158,11,.1);color:#b45309;border:1.5px solid rgba(245,158,11,.25);
}
#ai-kvalifikaciya-lidov-boris-block .bql-pl-cold{
  background:rgba(59,130,246,.08);color:#1d4ed8;border:1.5px solid rgba(59,130,246,.22);
}
#ai-kvalifikaciya-lidov-boris-block .bql-pl-dq{
  background:rgba(100,116,139,.1);color:#475569;border:1.5px solid rgba(100,116,139,.25);
}
#ai-kvalifikaciya-lidov-boris-block .bql-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-kvalifikaciya-lidov-boris-block .bql-rgt{
  position:relative;
  background:linear-gradient(145deg,#ecfeff 0%,#e0f2fe 42%,#f8fafc 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-kvalifikaciya-lidov-boris-block .bql-rgt{min-height:360px;}
}
#ai-kvalifikaciya-lidov-boris-block #bql-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bql-cnt">
  <div class="bql-card">
    <div class="bql-lft">
      <span class="bql-ey">Контур скоринга</span>
      <h3 class="bql-h3">От заявки до статуса в CRM — за секунды, не за часы менеджера</h3>
      <ul class="bql-ul">
        <li><span class="bql-ic">1</span>CRM отвечает на webhook <strong>&lt;3 с</strong> и кладёт job в очередь</li>
        <li><span class="bql-ic">2</span>LLM возвращает JSON: BANT, <code>ai_score</code>, reasoning</li>
        <li><span class="bql-ic">3</span>Код (не модель) ставит hot/warm/cold/disqualified и задачу менеджеру</li>
        <li><span class="bql-ic">↺</span>Низкий confidence → ручная проверка, не ложный hot</li>
      </ul>
      <div class="bql-pills" aria-hidden="true">
        <span class="bql-pl bql-pl-hot">hot · 15 мин</span>
        <span class="bql-pl bql-pl-warm">warm · nurture</span>
        <span class="bql-pl bql-pl-cold">cold · очередь</span>
        <span class="bql-pl bql-pl-dq">disqualified</span>
      </div>
      <p class="bql-foot">Дальше — как устроена воронка от источников до эскалации →</p>
    </div>
    <div class="bql-rgt">
      <canvas
        id="bql-pipeline-canvas"
        role="img"
        aria-label="Схема: заявка проходит webhook, очередь, AI-скоринг и попадает в CRM с цветным статусом лида"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  var cv = document.getElementById('bql-pipeline-canvas');
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

  var nodes = [
    { id: 'in',  label: 'Заявка', sub: 'форма / чат' },
    { id: 'wh',  label: 'Webhook', sub: '200 OK' },
    { id: 'q',   label: 'Очередь', sub: 'Redis' },
    { id: 'llm', label: 'AI + BANT', sub: 'JSON' },
    { id: 'crm', label: 'CRM', sub: 'поля + задача' }
  ];

  var statusCycle = [
    { key: 'hot', label: 'hot', color: '#ef4444', score: 92 },
    { key: 'warm', label: 'warm', color: '#f59e0b', score: 68 },
    { key: 'cold', label: 'cold', color: '#3b82f6', score: 41 },
    { key: 'dq', label: 'disq.', color: '#94a3b8', score: 12 }
  ];

  var packets = [];
  var spawnAcc = 0;
  var LOOP = 900;

  function nodePos(i){
    var padX = 36;
    var usable = W - padX * 2;
    var x = padX + (usable * i) / (nodes.length - 1);
    var y = H * 0.48;
    return { x: x, y: y };
  }

  function rr(x, y, w, h, r, fill, stroke, lw){
    cx.beginPath();
    if (cx.roundRect) cx.roundRect(x, y, w, h, r);
    else {
      cx.moveTo(x + r, y);
      cx.arcTo(x + w, y, x + w, y + h, r);
      cx.arcTo(x + w, y + h, x, y + h, r);
      cx.arcTo(x, y + h, x, y, r);
      cx.arcTo(x, y, x + w, y, r);
      cx.closePath();
    }
    if (fill) { cx.fillStyle = fill; cx.fill(); }
    if (stroke) { cx.strokeStyle = stroke; cx.lineWidth = lw || 1.5; cx.stroke(); }
  }

  function drawGrid(){
    cx.strokeStyle = 'rgba(14,165,233,.08)';
    cx.lineWidth = 1;
    for (var gx = 24; gx < W; gx += 28) {
      cx.beginPath(); cx.moveTo(gx, 0); cx.lineTo(gx, H); cx.stroke();
    }
    for (var gy = 24; gy < H; gy += 28) {
      cx.beginPath(); cx.moveTo(0, gy); cx.lineTo(W, gy); cx.stroke();
    }
  }

  function drawNodes(pulse){
    var nw = Math.min(108, W * 0.17);
    var nh = 58;
    for (var i = 0; i < nodes.length; i++) {
      var p = nodePos(i);
      var glow = (i === 3) ? 0.12 + 0.08 * Math.sin(pulse * 0.09) : 0.06;
      rr(p.x - nw / 2, p.y - nh / 2, nw, nh, 12,
        'rgba(255,255,255,.92)',
        'rgba(8,145,178,.35)', 1.5);
      if (i === 3) {
        rr(p.x - nw / 2 - 4, p.y - nh / 2 - 4, nw + 8, nh + 8, 14,
          'rgba(6,182,212,' + glow + ')', null);
      }
      cx.fillStyle = '#0f172a';
      cx.font = 'bold 12px Inter,system-ui,sans-serif';
      cx.textAlign = 'center';
      cx.fillText(nodes[i].label, p.x, p.y - 4);
      cx.fillStyle = '#64748b';
      cx.font = '10px Inter,system-ui,sans-serif';
      cx.fillText(nodes[i].sub, p.x, p.y + 14);
      if (i < nodes.length - 1) {
        var p2 = nodePos(i + 1);
        cx.strokeStyle = 'rgba(14,165,233,.35)';
        cx.lineWidth = 2;
        cx.setLineDash([6, 6]);
        cx.beginPath();
        cx.moveTo(p.x + nw / 2 + 4, p.y);
        cx.lineTo(p2.x - nw / 2 - 4, p.y);
        cx.stroke();
        cx.setLineDash([]);
      }
    }
  }

  function spawnPacket(){
    var st = statusCycle[Math.floor(Math.random() * statusCycle.length)];
    packets.push({
      seg: 0,
      prog: 0,
      speed: 0.004 + Math.random() * 0.0025,
      status: st,
      name: ['ООО Прогресс', 'ИП Смирнов', 'Тест форма', 'Медиа Групп'][Math.floor(Math.random() * 4)]
    });
  }

  function drawPackets(){
    for (var i = packets.length - 1; i >= 0; i--) {
      var pk = packets[i];
      pk.prog += pk.speed;
      if (pk.prog >= 1) {
        pk.seg++;
        pk.prog = 0;
      }
      if (pk.seg >= nodes.length - 1) {
        packets.splice(i, 1);
        continue;
      }
      var a = nodePos(pk.seg);
      var b = nodePos(pk.seg + 1);
      var x = a.x + (b.x - a.x) * pk.prog;
      var y = a.y + Math.sin(pk.prog * Math.PI) * -18;
      cx.beginPath();
      cx.arc(x, y, 9, 0, Math.PI * 2);
      cx.fillStyle = pk.status.color;
      cx.fill();
      cx.strokeStyle = 'rgba(255,255,255,.9)';
      cx.lineWidth = 2;
      cx.stroke();
    }
  }

  function drawCrmPanel(fr){
    var st = statusCycle[Math.floor((fr / 180) % statusCycle.length)];
    var pw = Math.min(200, W * 0.32);
    var ph = 118;
    var px = W - pw - 20;
    var py = H - ph - 22;
    rr(px, py, pw, ph, 14, 'rgba(255,255,255,.95)', 'rgba(148,163,184,.35)', 1.2);
    cx.fillStyle = '#0f172a';
    cx.font = 'bold 11px Inter,system-ui,sans-serif';
    cx.textAlign = 'left';
    cx.fillText('qualification_summary', px + 14, py + 22);
    cx.fillStyle = '#475569';
    cx.font = '10px Inter,system-ui,sans-serif';
    cx.fillText('Бюджет + срок в форме, ЛПР уточнить', px + 14, py + 40);
    cx.fillStyle = '#64748b';
    cx.fillText('ai_score: ' + st.score + ' · confidence OK', px + 14, py + 56);
    rr(px + 14, py + 68, 72, 22, 8, st.color, null);
    cx.fillStyle = '#fff';
    cx.font = 'bold 10px Inter,system-ui,sans-serif';
    cx.textAlign = 'center';
    cx.fillText(st.label, px + 50, py + 83);
    cx.textAlign = 'left';
    cx.fillStyle = '#0891b2';
    cx.font = 'bold 10px Inter,system-ui,sans-serif';
    cx.fillText('Задача менеджеру · 15 мин', px + 94, py + 83);
  }

  function drawJsonFlash(fr){
    var p = nodePos(3);
    var alpha = 0.35 + 0.25 * Math.sin(fr * 0.08);
    cx.fillStyle = 'rgba(6,182,212,' + alpha + ')';
    cx.font = '9px ui-monospace,monospace';
    cx.textAlign = 'center';
    cx.fillText('{ status, bant, reasoning }', p.x, p.y - 42);
  }

  function frame(){
    t++;
    if (t > LOOP) t = 0;
    cx.clearRect(0, 0, W, H);
    drawGrid();
    drawNodes(t);
    drawJsonFlash(t);
    spawnAcc++;
    if (spawnAcc > 55) {
      spawnAcc = 0;
      if (packets.length < 6) spawnPacket();
    }
    drawPackets();
    drawCrmPanel(t);
    requestAnimationFrame(frame);
  }
  requestAnimationFrame(frame);
})();
</script>
</section>

<section class="akl-section nero-ai-reveal" id="voronka">
  <div class="akl-cnt">
    <header class="akl-sh"><h2>Как работает воронка: от заявки до передачи в CRM</h2></header>
    <div class="akl-prose">
<p><strong>Определение:</strong> <strong>AI воронка продаж</strong> в контексте квалификации — цепочка «источник → единые правила оценки → статус в CRM → задача или nurture» до этапа активной сделки.</p>
<h3 class="akl-h3">Источники лидов и единые правила оценки</h3>
<p>Один и тот же ICP может прийти с сайта (Tilda, WordPress), из <strong>amoCRM</strong> Salesbot, с почты (модуль обработки писем в Битрикс24), из Telegram/VK или телефонии (транскрипт в поле). Без <strong>единой матрицы</strong> менеджер в одном канале видит «горячего», в другом — «непонятно».</p>
<p>Nero Network на этапе аудита фиксирует:</p>
<p>- карту полей и стадий;</p>
<p>- анти-ICP (кто <strong>нецелевой</strong> всегда);</p>
<p>- обязательные сигналы для hot (например, бюджет + срок + тип услуги).</p>
<p>Детерминированный слой до LLM: регион, чёрный список email, UTM «тест», дубликаты — снижают риск, что модель «придумает» hot.</p>
<h3 class="akl-h3">Триггеры эскалации менеджеру</h3>
<p>Эскалация — не «любой лид», а события:</p>
<ol class="akl-ol"><li>Статус <strong>hot</strong> и confidence выше порога.</li><li>Запрос цены/договора в тексте (извлечение сущностей LLM).</li><li>Повторное обращение warm → hot по изменению полей.</li><li>Исключение: confidence ниже порога или шаблон «test@test» → стадия <strong>ручная проверка</strong> (кейс Velmi).</li></ol>
<p>Параллельно: робот «создать задачу hot — 15 мин», уведомление РОПу, сортировка списка по <code>ai_score</code>.</p>
<p><strong>Схема потока (логика Nero Network):</strong></p>
<ol class="akl-ol"><li>Лид создан (форма, чат, почта, звонок).</li><li>CRM шлёт webhook; оркестратор отвечает <strong>200 OK за &amp;lt;3 с</strong>, кладёт job в очередь.</li><li>Сбор контекста: поля, UTM, текст, история, ICP-правила.</li><li>LLM возвращает JSON: статус, BANT-оценки, reasoning, next_action, confidence.</li><li>Обновление полей, теги, маршрутизация или nurture для cold.</li><li>Аналитика: доля статусов, время до первого звонка, конверсия hot→сделка.</li></ol>
<p><strong>Микроконверсия:</strong> закажите <strong>демо скоринга</strong> на 5–10 обезличенных заявках из вашей CRM.</p>

    </div>
  </div>
</section>

<section class="akl-section akl-section-alt nero-ai-reveal" id="etapy">
  <div class="akl-cnt">
    <header class="akl-sh"><h2>Внедрение AI-квалификации лидов под ключ — этапы</h2></header>
    <div class="akl-prose">
<p><strong>Определение:</strong> <strong>Внедрение ai в бизнес процессы</strong> продаж в формате Nero — проект с пилотом на одном канале, калибровкой и масштабированием, а не разовая «настройка промпта».</p>
<p><strong>Как внедрить ai квалификация лидов</strong> по шагам (модель реализации Nero Network):</p>
<div class="akl-table-wrap"><table class="akl-table">
<thead><tr><th>Этап</th><th>Срок (ориентир)</th><th>Результат</th></tr></thead><tbody>
<tr><td>1. Аудит воронки</td><td>2–3 дня</td><td>ICP, объём лидов/мес, SLA, поля CRM</td></tr>
<tr><td>2. Матрица квалификации (лид-магнит)</td><td>3–5 дней</td><td>BANT для SMB; элементы MEDDIC для чеков &amp;gt;500k ₽</td></tr>
<tr><td>3. Пилот 1 канал</td><td>1–2 недели</td><td>hot/warm/cold/disqualified + ai_score + summary</td></tr>
<tr><td>4. Интеграция CRM</td><td>параллельно пилоту</td><td>webhook → очередь → LLM → API CRM</td></tr>
<tr><td>5. Калибровка</td><td>~2 недели</td><td>пороги, anti-test-data, разбор ошибок</td></tr>
<tr><td>6. Масштаб</td><td>по согласованию</td><td>почта, мессенджеры, звонки, вторая CRM</td></tr>
</tbody></table></div>
<p>Чек-лист этапов для РОПа (GEO-блок):</p>
<ul class="akl-checklist"><li>Описан ICP и анти-ICP  </li><li>20–50 обезличенных примеров лидов (hot/cold)  </li><li>Карта полей: <code>ai_status</code>, <code>ai_score</code>, <code>qualification_summary</code>, <code>disqualify_reason</code>  </li><li>Регламент SLA (hot — звонок за N минут)  </li><li>Контур ПДн: YandexGPT / GigaChat / on-prem n8n при необходимости  </li></ul>
<h3 class="akl-h3">Аудит текущей квалификации (BANT / MEDDIC как рамка матрицы)</h3>
<p><strong>BANT</strong> (Budget, Authority, Need, Timeline) — быстрый фильтр на ранней стадии; удобен для <strong>ai квалификация лидов для малого бизнеса</strong> и услуг с коротким циклом. <strong>MEDDIC/MEDDICC</strong> — непрерывная квалификация в сложных B2B-сделках (девелопмент, интеграции с чеком выше среднего) — <a href="https://meddicc.com/resources/meddicc-versus-other-qualification-frameworks-like-bant" class="akl-link" target="_blank" rel="noopener noreferrer">сравнение фреймворков MEDDICC</a>.</p>
<p><strong>Матрица квалификации лидов</strong> (лид-магнит страницы) — скачиваемый шаблон: вопросы BANT + расширение для агентств и B2B-услуг. Это ядро CTA «<strong>Получить карту квалификации</strong>».</p>
<h3 class="akl-h3">Настройка модели и порогов скоринга</h3>
<p>- Промпт с JSON-schema (status, score, reasoning, next_action).</p>
<p>- Порог confidence: ниже — ручная проверка.</p>
<p>- Двухслойная модель (дешёвая классификация + мощная для ответов) — паттерн из кейса Wildbots для экономии токенов.</p>
<p>- Fallback rule-based при недоступности API.</p>
<p>Для «мини-Einstein» на истории сделок нужны десятки/сотни конверсий — иначе опираемся на LLM+правила, как в документации Salesforce Einstein для ML на исторических лидах (<a href="https://c1.sfdcstatic.com/content/dam/web/en_us/www/documents/datasheets/sales-cloud-einstein-leadscoring.pdf" class="akl-link" target="_blank" rel="noopener noreferrer">Lead Scoring datasheet</a>).</p>
<h3 class="akl-h3">Пилот и масштабирование</h3>
<p>Пилот — одна форма или один мессенджер. Успех пилота: стабильная доля статусов, согласие РОПа с разметкой, сокращение времени до первого звонка на hot (качественно и по вашим метрикам). Масштаб: email → CRM (кейс PVSM), dual CRM (Wildbots), телефония через SpeechKit/Whisper.</p>
<p><strong>Внедрение ai агентов</strong> в продажах здесь — точечно: агент nurture для cold, не «один агент на всё».</p>

<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать скоринг до старта пилота?</p>
    <p class="ym-cta-block__sub">Если РОПу и интегратору важно разобраться в webhook, промптах, JSON-schema и human-in-the-loop до подписания ТЗ — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>. Это ускоряет согласование порогов и полей CRM на этапе калибровки.</p>
  </div>
</aside>
    </div>
  </div>
</section>

<section class="akl-section nero-ai-reveal" id="crm">
  <div class="akl-cnt">
    <header class="akl-sh"><h2>Интеграция с CRM: amoCRM, Bitrix24, HubSpot</h2></header>
    <p class="akl-related nero-ai-reveal" style="max-width:920px;margin:0 auto 22px;padding:0 24px;font-size:15px;color:var(--akl-muted);line-height:1.55;">Если ваша воронка завязана на amoCRM, отдельная посадочная Nero — <a href="/vnedrenie-ai-amocrm/" class="akl-link">внедрение AI-агента в amoCRM под ключ</a>: webhook, Salesbot и кастомные поля дополняют квалификацию до передачи менеджеру и сокращают ручной перенос из чатов.</p>
    <div class="akl-prose">
<p><strong>Определение:</strong> <strong>Интеграция ai квалификация лидов с crm</strong> — запись статусов, счёта и резюме в нативные поля и запуск роботов без ручного копирования из чата.</p>
<h3 class="akl-h3">Поля, статусы и автоматизации в CRM</h3>
<p>Рекомендуемый минимум полей (названия согласуются с вашей воронкой):</p>
<div class="akl-table-wrap"><table class="akl-table">
<thead><tr><th>Поле</th><th>Назначение</th></tr></thead><tbody>
<tr><td><code>ai_status</code></td><td>hot / warm / cold / disqualified</td></tr>
<tr><td><code>ai_score</code></td><td>0–100</td></tr>
<tr><td><code>qualification_summary</code></td><td>2–4 предложения для менеджера</td></tr>
<tr><td><code>disqualify_reason</code></td><td>причина отсева</td></tr>
<tr><td><code>ai_confidence</code></td><td>для маршрутизации на ручную проверку</td></tr>
</tbody></table></div>
<p><strong>amoCRM:</strong> webhook, API v4 leads + notes; Salesbot для анкетирования (<a href="https://www.amocrm.ru/support/digitalpipeline/salesbot" class="akl-link" target="_blank" rel="noopener noreferrer">документация Salesbot</a>). Пример потока: webhook → FastAPI → Claude → теги и примечание за ~30 с (кейс AX Digital).</p>
<p><strong>Битрикс24:</strong> роботы CRM, webhook &amp;lt;3 с + очередь (Velmi); BitrixGPT для анализа первого обращения (<a href="https://helpdesk.bitrix24.ru/open/27045426/" class="akl-link" target="_blank" rel="noopener noreferrer">справка Bitrix24</a>) — можно комбинировать с кастомным скорингом Nero, если встроенного BANT по вашей матрице недостаточно.</p>
<p><strong>HubSpot:</strong> predictive и AI scores требуют объёма контактов и отдельных workflows (<a href="https://knowledge.hubspot.com/scoring/build-lead-scores-with-ai" class="akl-link" target="_blank" rel="noopener noreferrer">Build scores with AI</a>) — для российского SMB чаще релевантен перенос логики в amo/Битрикс.</p>
<p><strong>Микроконверсия:</strong> скачайте <strong>чек-лист интеграции с CRM</strong> в составе карты квалификации.</p>
<p><strong>152-ФЗ:</strong> при передаче ПДн в облачные LLM — псевдонимизация, российские модели (YandexGPT, GigaChat), self-hosted n8n на VPS в РФ (мотив из кейса Wildbots).</p>

    </div>
  </div>
</section>

<section class="akl-section akl-section-alt nero-ai-reveal" id="keisy">
  <div class="akl-cnt">
    <header class="akl-sh"><h2>Кейсы и примеры внедрения</h2></header>
    <div class="akl-prose">
<p><strong>Определение:</strong> <strong>AI квалификация лидов кейсы</strong> в открытых источниках — в основном блоги интеграторов и Habr; цифры ниже <strong>из публикаций</strong>, без независимого аудита Nero Network.</p>
<h3 class="akl-h3">B2B-услуги и агентства</h3>
<p><strong>Velmi + Bitrix24</strong> (<a href="https://habr.com/ru/articles/1045026/" class="akl-link" target="_blank" rel="noopener noreferrer">Habr, июнь 2025</a>): ~400 лидов/мес, ~70% нецелевые; архитектура webhook → FastAPI → Redis → LLM → статусы в CRM; ответ <strong>2–3 ч → 30–40 с</strong>, квалифицированные <strong>+35%</strong>, ~<strong>50 ч/мес</strong> менеджеров.</p>
<p><strong>AX Digital + amoCRM + Claude</strong> (<a href="https://axdigital.ru/blog/ii-kvalifikaciya-lidov-amocrm-claude/" class="akl-link" target="_blank" rel="noopener noreferrer">блог</a>): 80 лидов/мес, BANT в JSON; первичка <strong>4 ч/день → 20 мин/день</strong>, конверсия <strong>8% → 13%</strong>.</p>
<p><strong>Wildbots, dual CRM + n8n + GPT</strong> (<a href="https://wildbots.ru/ru/blog/integratsiya-bitrix24-i-amocrm-s-gpt-agentom-cherez-n8n-realnii-" class="akl-link" target="_blank" rel="noopener noreferrer">статья</a>): нормализация потоков, двухслойная модель, 152-ФЗ.</p>
<p>Глобальный ориентир: <strong>Salesforce Einstein Lead Scoring</strong> — ML на исторических конверсиях, пересчёт score, факторы на карточке (<a href="https://help.salesforce.com/s/articleView?id=sf.einstein_sales_setup_enable_lead_insights.htm" class="akl-link" target="_blank" rel="noopener noreferrer">справка Salesforce</a>). Для РФ это аргумент «объяснимый скоринг в своей CRM», а не обязательность Enterprise Salesforce.</p>
<p>McKinsey отмечает: <strong>19%</strong> B2B уже внедряют gen AI в buying/selling, <strong>23%</strong> в процессе (<a href="https://www.mckinsey.com/capabilities/growth-marketing-and-sales/our-insights/unlocking-profitable-b2b-growth-through-gen-ai" class="akl-link" target="_blank" rel="noopener noreferrer">Gen AI in B2B sales</a>, 2025).</p>
<h3 class="akl-h3">AI квалификация лидов для малого бизнеса</h3>
<p>При <strong>мало лидов</strong> (десятки в месяц) окупаемость — не в «тысячах отсеянных», а в <strong>приоритете и SLA</strong>: не пропустить hot, не держать двух менеджеров на первичке. Продуктовые пакеты «квалификатор от $500 / 7–14 дней» (например, <a href="https://chigrinov.ru/products/ai-qualifier" class="akl-link" target="_blank" rel="noopener noreferrer">CHIGRINOV AI-Квалификатор</a>) — контраст с проектом Nero <strong>150–450 тыс. ₽</strong>: глубина интеграции, матрица под ваш ICP, калибровка с РОПом, несколько каналов.</p>
<p>Минимальный стек МСБ: одна CRM, один канал, Salesbot <strong>или</strong> LLM-скоринг — выбор после аудита («когда хватит роботов без LLM»).</p>
<p><strong>Пример внедрения ai квалификация лидов</strong> в одном абзаце для AI-цитирования: форма на сайте → webhook amoCRM → очередь → модель по BANT → поле hot → задача менеджеру за 15 минут → еженедельный разбор ошибок с РОПом две недели.</p>

    </div>
  </div>
</section>

<section class="akl-section nero-ai-reveal" id="ceny">
  <div class="akl-cnt">
    <header class="akl-sh"><h2>Стоимость и сроки</h2></header>
    <div class="akl-prose">
<p><strong>Определение:</strong> <strong>AI квалификация лидов цена</strong> в проектах Nero Network укладывается в коридор <strong>150–450 тыс. ₽</strong> (из брифа темы) и зависит от каналов, CRM и требований к ПДн — без публичного прайса «в вакууме».</p>
<h3 class="akl-h3">Из чего складывается чек 150–450 тыс. ₽</h3>
<div class="akl-table-wrap"><table class="akl-table">
<thead><tr><th>Компонент</th><th>Влияние на бюджет</th></tr></thead><tbody>
<tr><td>Аудит + матрица BANT/MEDDIC</td><td>Базовый слой, лид-магнит</td></tr>
<tr><td>Пилот 1 канал + webhook &amp;lt;3 с</td><td>Средний сегмент</td></tr>
<tr><td>Несколько каналов (почта, чаты, звонки)</td><td>Верх коридора</td></tr>
<tr><td>Dual CRM, кастомные отчёты РОПу</td><td>Верх коридора</td></tr>
<tr><td>On-prem, российские LLM, комплаенс</td><td>Доп. интеграционные часы</td></tr>
</tbody></table></div>
<p>Для сравнения рынка (не оферта Nero): NeuralOps/Neuron Group указывают пилоты <strong>от 250 000 ₽</strong>, пакеты <strong>139–279 тыс. ₽</strong> + токены; CMDF5 — <strong>от 79 990 ₽</strong> разово + подписка (<a href="https://neuralops.ru/sales-ai" class="akl-link" target="_blank" rel="noopener noreferrer">страницы услуг конкурентов в research Артёма</a>). Позиция Nero: <strong>прозрачные этапы</strong>, разделение LLM и кода, готовая <strong>матрица квалификации</strong>, а не только «подключили ChatGPT».</p>
<p><strong>Сроки:</strong> типовой пилот — порядка <strong>2–4 недель</strong> до стабильных статусов на одном канале; масштаб — по roadmap после калибровки.</p>

<div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Оценить бюджет 150–450 тыс. ₽ под ваши каналы</p>
    <p class="ym-cta-block__sub">Коридор из брифа темы: пилот на одном канале, интеграция amoCRM или Битрикс24, калибровка с РОПом. В составе <strong>карты квалификации</strong> — ориентир сроков и состав работ.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Получить карту квалификации'); ?></a>
      <a href="#faq" class="nero-ai-btn nero-ai-btn--ghost ym-btn ym-btn--ghost">Сначала FAQ</a>
    </div>
  </div>
</div>
    </div>
  </div>
</section>

<section class="akl-section akl-section-alt nero-ai-reveal" id="faq">
  <div class="akl-cnt">
    <header class="akl-sh"><h2>FAQ</h2></header>
    <div class="akl-prose">
<div class="akl-faq"><details class="akl-faq-item nero-ai-reveal"><summary>Что такое ai лид скоринг простыми словами?</summary><div class="akl-faq-a"><p>Автоматическая оценка заявки по вашим правилам и тексту обращения с числовым баллом и статусом до работы менеджера.</p></div></details><details class="akl-faq-item nero-ai-reveal"><summary>Чем ai квалификация лидов отличается от чат-бота?</summary><div class="akl-faq-a"><p>Чат-бот ведёт диалог; квалификация <strong>обязательно</strong> пишет результат в CRM и маршрутизирует задачи. Диалог — опция, не ядро.</p></div></details><details class="akl-faq-item nero-ai-reveal"><summary>Нужен ли отдельный ai-агент?</summary><div class="akl-faq-a"><p>Не всегда. Salesbot закрывает сценарные ветки; агент с LLM нужен, когда важен свободный текст, BANT из одной формы и объяснимый reasoning.</p></div></details><details class="akl-faq-item nero-ai-reveal"><summary>Заменит ли AI менеджеров?</summary><div class="akl-faq-a"><p>Нет. AI снимает первичный отсев и черновики; закрытие, нестандартные условия и юридические обещания — за человеком (модель Nero Network).</p></div></details><details class="akl-faq-item nero-ai-reveal"><summary>AI ошибётся и отдаст мусор в hot?</summary><div class="akl-faq-a"><p>Снижается порогами confidence, правилами anti-test-data, human-in-the-loop для спорных лидов (практика Velmi).</p></div></details><details class="akl-faq-item nero-ai-reveal"><summary>Как внедрить ai квалификация лидов при 152-ФЗ?</summary><div class="akl-faq-a"><p>Минимизировать ПДн в промпте, российские модели, self-hosted оркестратор, договор с обработчиком.</p></div></details><details class="akl-faq-item nero-ai-reveal"><summary>Какой минимальный объём лидов для окупаемости?</summary><div class="akl-faq-a"><p>Формального порога нет; при малом потоке ценность — скорость реакции на hot и освобождение часов (см. кейс 80 лидов/мес).</p></div></details><details class="akl-faq-item nero-ai-reveal"><summary>Только CRM-роботы vs LLM vs ML на истории?</summary><div class="akl-faq-a"><p>Роботы — жёсткие ветки; LLM — неструктурированный текст; ML как Einstein — нужна история конверсий. Часто оптимален гибрид LLM + правила.</p></div></details><details class="akl-faq-item nero-ai-reveal"><summary>Сколько длится внедрение под ключ?</summary><div class="akl-faq-a"><p>Пилот на одном канале обычно недели, не месяцы; полный контур — по количеству каналов и CRM.</p></div></details><details class="akl-faq-item nero-ai-reveal"><summary>Что входит в «карту квалификации»?</summary><div class="akl-faq-a"><p>Матрица BANT/MEDDIC под ваш сегмент, чек-лист полей CRM, примеры статусов — бесплатно по CTA на этой странице.</p></div></details><details class="akl-faq-item nero-ai-reveal"><summary>Подходит ли для девелоперов и агентств?</summary><div class="akl-faq-a"><p>Да, целевая аудитория темы — B2B-услуги, агентства, девелоперы с отделом продаж и CRM.</p></div></details><details class="akl-faq-item nero-ai-reveal"><summary>Как связано с ai для crm?</summary><div class="akl-faq-a"><p>CRM — система записи; AI-квалификация — сервис, который заполняет поля и запускает автоматизации внутри неё.

---</p></div></details></div>

    </div>
  </div>
</section>

<section class="akl-section nero-ai-reveal" id="cta">
  <div class="akl-cnt">
    <header class="akl-sh"><h2>Получить карту и матрицу квалификации лидов</h2></header>
    <div class="akl-prose">
<p>Вы дошли до практического шага: без общей матрицы <strong>ai квалификация лидов под ключ</strong> расползается по головам менеджеров, а скоринг превращается в «ещё один тег».</p>
<p><strong>Nero Network</strong> предлагает:</p>
<ol class="akl-ol"><li><strong>Получить карту квалификации</strong> — матрица BANT с расширением для сложных B2B-сделок, чек-лист полей <code>ai_status</code> / <code>ai_score</code> / <code>qualification_summary</code>, примеры триггеров hot и anti-ICP.  </li><li><strong>Консультацию по внедрению</strong> — аудит воронки, оценка коридора <strong>150–450 тыс. ₽</strong> под ваши каналы и CRM.  </li><li><strong>Пилот</strong> — один канал, webhook с ответом за секунды, калибровка две недели с РОПом.</li></ol>
<p><strong>Коммерческий офер:</strong> AI присваивает лиду статус <strong>горячий, тёплый, холодный или нецелевой</strong> до передачи менеджеру — меньше ручного отсева, выше конверсия в сделку за счёт SLA на hot.</p>
<p>Оставьте заявку на <strong>«Получить карту квалификации»</strong> — это лид-магнит «<strong>Матрица квалификации лидов</strong>» и вход в проект <strong>настройка ai квалификация лидов</strong> с интеграцией в amoCRM или Битрикс24.</p>
<p><strong>Итог страницы:</strong> в 2026 году <strong>ai для отдела продаж</strong> — уже норма глобального рынка (87% организаций с AI в Salesforce State of Sales 2026); в России выигрывают те, кто связывает скоринг с CRM, объяснимостью и регламентом первого звонка. Nero Network закрывает этот контур под ключ — от матрицы до пилота и масштаба.</p>
<p class="akl-cta-btn-wrap"><a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Получить карту квалификации'); ?></a></p>

    </div>
  </div>
</section>

</div>

<?php
$akl_page_url = trailingslashit( get_permalink() );
$akl_site_url = trailingslashit( home_url( '/' ) );
$akl_brand    = get_bloginfo( 'name' ) ?: ( getenv( 'SITE_BRAND' ) ?: 'Nero Network' ); // pragma: allowlist secret
$akl_h1       = 'AI-квалификация лидов: внедрение и настройка под ключ';
$akl_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $akl_site_url . '#organization',
      'name'  => $akl_brand,
      'url'   => $akl_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $akl_site_url . '#website',
      'url'       => $akl_site_url,
      'name'      => $akl_brand,
      'publisher' => [ '@id' => $akl_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $akl_page_url . '#webpage',
      'url'         => $akl_page_url,
      'name'        => $akl_h1,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $akl_site_url . '#website' ],
      'about'       => [ '@id' => $akl_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $akl_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $akl_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $akl_h1, 'item' => $akl_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $akl_page_url . '#service',
      'name'        => $akl_h1,
      'description' => $page_seo_description,
      'url'         => $akl_page_url,
      'provider'    => [ '@id' => $akl_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $akl_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Что такое ai лид скоринг простыми словами?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Автоматическая оценка заявки по вашим правилам и тексту обращения с числовым баллом и статусом до работы менеджера.' ] ],
        [ '@type' => 'Question', 'name' => 'Чем ai квалификация лидов отличается от чат-бота?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Чат-бот ведёт диалог; квалификация обязательно пишет результат в CRM и маршрутизирует задачи. Диалог — опция, не ядро.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужен ли отдельный ai-агент?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Не всегда. Salesbot закрывает сценарные ветки; агент с LLM нужен, когда важен свободный текст, BANT из одной формы и объяснимый reasoning.' ] ],
        [ '@type' => 'Question', 'name' => 'Заменит ли AI менеджеров?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. AI снимает первичный отсев и черновики; закрытие, нестандартные условия и юридические обещания — за человеком (модель Nero Network).' ] ],
        [ '@type' => 'Question', 'name' => 'AI ошибётся и отдаст мусор в hot?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Снижается порогами confidence, правилами anti-test-data, human-in-the-loop для спорных лидов (практика Velmi).' ] ],
        [ '@type' => 'Question', 'name' => 'Как внедрить ai квалификация лидов при 152-ФЗ?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Минимизировать ПДн в промпте, российские модели, self-hosted оркестратор, договор с обработчиком.' ] ],
        [ '@type' => 'Question', 'name' => 'Какой минимальный объём лидов для окупаемости?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Формального порога нет; при малом потоке ценность — скорость реакции на hot и освобождение часов (см. кейс 80 лидов/мес).' ] ],
        [ '@type' => 'Question', 'name' => 'Только CRM-роботы vs LLM vs ML на истории?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Роботы — жёсткие ветки; LLM — неструктурированный текст; ML как Einstein — нужна история конверсий. Часто оптимален гибрид LLM + правила.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько длится внедрение под ключ?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Пилот на одном канале обычно недели, не месяцы; полный контур — по количеству каналов и CRM.' ] ],
        [ '@type' => 'Question', 'name' => 'Что входит в «карту квалификации»?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Матрица BANT/MEDDIC под ваш сегмент, чек-лист полей CRM, примеры статусов — бесплатно по CTA на этой странице.' ] ],
        [ '@type' => 'Question', 'name' => 'Подходит ли для девелоперов и агентств?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, целевая аудитория темы — B2B-услуги, агентства, девелоперы с отделом продаж и CRM.' ] ],
        [ '@type' => 'Question', 'name' => 'Как связано с ai для crm?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'CRM — система записи; AI-квалификация — сервис, который заполняет поля и запускает автоматизации внутри неё.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $akl_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
/**
 * akl-lead-qualify-engine — Диспетчерская «Скоринг-шлюз»
 * Фазы: INTAKE → BANT_SCAN → MATRIX_ROUTE → MANAGER_HANDOFF
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("akl-lead-qualify-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var frame = 0, cw = 0, ch = 0, cx = 0, cy = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 220;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    lane: "rgba(121,242,255,0.2)",
    laneHot: "rgba(251,113,133,0.35)",
    hub: "#1e293b",
    hot: "#fb7185",
    warm: "#fbbf24",
    cold: "#38bdf8",
    dq: "#94a3b8",
    green: "#22c55e",
    violet: "#8b5cf6",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6"
  };

  function rr(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.strokeStyle = stroke;
      ctx.lineWidth = 1.2;
      ctx.stroke();
    }
  }

  function LeadCardPulseLanes() {
    this.phase = 0;
  }
  LeadCardPulseLanes.prototype.draw = function (ctx) {
    this.phase = (frame * 0.028) % (Math.PI * 2);
    var lanes = [
      { r: 118, y: -8, col: C.lane },
      { r: 92, y: 12, col: C.laneHot },
      { r: 68, y: 28, col: "rgba(139,92,246,0.25)" }
    ];
    lanes.forEach(function (ln, i) {
      ctx.strokeStyle = ln.col;
      ctx.lineWidth = i === 1 ? 2 : 1;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.ellipse(0, ln.y, ln.r, ln.r * 0.38, 0, Math.PI * 0.15, Math.PI * 0.85);
      ctx.stroke();
      ctx.setLineDash([]);
    });
    for (var k = 0; k < 4; k++) {
      var ln = lanes[k % 3];
      var t = (this.phase * (1 + k * 0.15) + k * 1.4) % (Math.PI * 0.7);
      var ang = Math.PI * 0.15 + t;
      var lx = Math.cos(ang) * ln.r;
      var ly = ln.y + Math.sin(ang) * ln.r * 0.38;
      drawLeadChip(ctx, lx, ly, k);
    }
  };

  function drawLeadChip(ctx, x, y, idx) {
    var colors = [C.hot, C.warm, C.cold, C.dq];
    ctx.save();
    ctx.translate(x, y);
    rr(ctx, -11, -7, 22, 14, 3, "#f8fafc", C.outline);
    ctx.fillStyle = colors[idx % 4];
    ctx.beginPath();
    ctx.arc(8, 0, 3, 0, Math.PI * 2);
    ctx.fill();
    ctx.restore();
  }

  function QualificationMatrixHub() {
    this.sector = 0;
  }
  QualificationMatrixHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    rr(ctx, -58, -62, 116, 124, 12, C.hub, C.outline);
    var sectors = [
      { label: "HOT", col: C.hot, x: -52, y: -52 },
      { label: "WARM", col: C.warm, x: 4, y: -52 },
      { label: "COLD", col: C.cold, x: -52, y: -8 },
      { label: "DISQ", col: C.dq, x: 4, y: -8 }
    ];
    sectors.forEach(function (s, i) {
      var active = Math.floor(prg / 65) === i || (prg > 195 && i === 0);
      rr(ctx, s.x, s.y, 48, 36, 6, active ? s.col + "44" : "rgba(255,255,255,0.06)", active ? s.col : C.outline);
      ctx.fillStyle = active ? "#fff" : "#94a3b8";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(s.label, s.x + 24, s.y + 22);
    });

    if (prg >= 70 && prg < 130) {
      ctx.strokeStyle = "rgba(139,92,246,0.5)";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, -30, 38 + Math.sin(frame * 0.12) * 4, 0, Math.PI * 2);
      ctx.stroke();
    }

    if (prg >= 130 && prg < 195) {
      ctx.fillStyle = "#fff";
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ai_score 87", 0, 42);
      rr(ctx, -40, 48, 80, 8, 4, "rgba(255,255,255,0.1)", null);
      rr(ctx, -40, 48, 70, 8, 4, C.green, null);
    }

    if (prg >= 200) {
      var h = Math.min(1, (prg - 200) / 30);
      rr(ctx, 62, -20 - h * 25, 44, 28, 6, "rgba(34,197,94,0.3)", C.green);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Задача", 84, -8 - h * 25);
      ctx.fillText("15 мин", 84, 2 - h * 25);
    }
  };

  function WebhookAckChip() {
    this.blink = 0;
  }
  WebhookAckChip.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    rr(ctx, -150, -48, 52, 22, 5, "rgba(121,242,255,0.12)", C.lane);
    ctx.fillStyle = "#79f2ff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("200 OK", -124, -34);
    if (prg < 25) {
      this.blink = Math.sin(frame * 0.2) * 0.5 + 0.5;
      ctx.fillStyle = "rgba(121,242,255," + (0.3 + this.blink * 0.4) + ")";
      ctx.beginPath();
      ctx.arc(-124, -40, 8 + this.blink * 6, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  function DisqualifiedTrap() {
    this.open = 0;
  }
  DisqualifiedTrap.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    rr(ctx, 118, 18, 40, 30, 6, "rgba(148,163,184,0.12)", C.dq);
    ctx.fillStyle = C.dq;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ANTI", 138, 30);
    ctx.fillText("ICP", 138, 40);
    if (prg > 45 && prg < 75) {
      var dx = 100 + (prg - 45) * 1.2;
      drawLeadChip(ctx, dx, 32, 3);
    }
  };

  function BantScannerRing() {
    this.angle = 0;
  }
  BantScannerRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    if (prg < 70 || prg > 125) return;
    this.angle += 0.08;
    ctx.strokeStyle = "rgba(251,191,36,0.55)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, -30, 44, this.angle, this.angle + 1.2);
    ctx.stroke();
    ["B", "A", "N", "T"].forEach(function (ch, i) {
      var a = this.angle + i * 0.35;
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText(ch, Math.cos(a) * 50 - 4, -30 + Math.sin(a) * 50);
    }, this);
  };

  var bubbles = [];
  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, max: life });
  }

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 80;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }
  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var prg = (frame * 0.045) % 260;
    var targets = {
      "1_architect": { x: -95, y: 58 },
      "2_seo": { x: -35, y: 68 },
      "3_coder": { x: 25, y: 68 },
      "4_designer": { x: 85, y: 58 },
      "5_deployer": { x: 0, y: 78 }
    };
    var tgt = targets[this.role] || { x: 0, y: 65 };
    var isMoving = false;
    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      var t = local < 12 ? local / 12 : 1 - (local - 12) / 12;
      if (local < 12 || local >= 18) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local < 12 ? t : 1 - t);
        this.y = this.baseY + (tgt.y - this.baseY) * (local < 12 ? t : 1 - t);
      } else {
        this.x = tgt.x; this.y = tgt.y;
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }
    if (!isMoving && frame % 180 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 200);
    }
    var bob = Math.sin(this.timer * 1.4) * 1.1;
    ctx.save();
    ctx.translate(this.x, this.y);
    rr(ctx, -10, -8 - bob, 20, 14, 4, this.color, C.outline);
    ctx.beginPath();
    ctx.arc(0, -18 - bob, 7, 0, Math.PI * 2);
    ctx.fillStyle = this.color;
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [
    new LeadCardPulseLanes(),
    new WebhookAckChip(),
    new DisqualifiedTrap(),
    new BantScannerRing(),
    new QualificationMatrixHub(),
    new Agent(-130, 92, C.agentYellow, "1_architect", 22, [
      "Матрица BANT в CRM",
      "Поля ai_status согласованы",
      "ICP и анти-ICP зафиксированы",
      "Аудит воронки: 12 источников"
    ]),
    new Agent(-65, 98, C.agentGreen, "2_seo", 68, [
      "Intent: коммерция",
      "UTM не тестовый",
      "Запрос на КП — сигнал hot",
      "Мало данных → warm"
    ]),
    new Agent(0, 100, C.agentBlue, "3_coder", 112, [
      "Webhook 200 за 2.1 с",
      "JSON-schema валидна",
      "Очередь Redis: job #884",
      "confidence &lt; порога → review"
    ]),
    new Agent(65, 98, C.agentPink, "4_designer", 156, [
      "Порог hot: score ≥ 82",
      "Цвета статусов в CRM",
      "Human-in-the-loop включён",
      "Anti test@test правило"
    ]),
    new Agent(130, 92, C.agentPurple, "5_deployer", 198, [
      "Задача менеджеру 15 мин",
      "Hot в топ списка amo",
      "Nurture для cold",
      "Handoff без копипаста"
    ])
  ];

  function drawBubbles(ctx) {
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / b.max);
      ctx.font = "bold 8px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 14;
      rr(ctx, b.x - tw / 2, b.y - 22, tw, 18, 6, "rgba(15,23,42," + (0.92 * alpha) + ")", C.outline);
      ctx.fillStyle = "rgba(226,232,240," + alpha + ")";
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 10);
    }
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    var prg = (frame * 0.045) % 260;
    if (prg > 8 && prg < 18) createBubble(-120, -55, "Лид из формы · webhook", 160);
    if (prg > 78 && prg < 88) createBubble(0, -75, "BANT: бюджет + срок", 160);
    if (prg > 138 && prg < 148) createBubble(10, -20, "Статус HOT · score 87", 160);
    if (prg > 208 && prg < 218) createBubble(90, -35, "Менеджеру · SLA 15 мин", 160);
    entities.forEach(function (e) { e.draw(ctx); });
    drawBubbles(ctx);
    ctx.restore();
    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
});
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

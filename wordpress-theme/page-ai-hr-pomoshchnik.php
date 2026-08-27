<?php
/**
 * Template Name: AI HR-помощник для сотрудников: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI HR-помощника по регламентам компании. RAG, кейсы, цены.
 */

declare(strict_types=1);

$page_seo_title       = 'AI HR-помощник для сотрудников: внедрение под ключ';
$page_seo_description = 'Внедряем AI HR-помощника по регламентам компании: ответы сотрудникам по отпускам, выплатам и правилам. Нестандарные вопросы — в заявку HR. Кейсы, цены.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet-rag'],
    ['label' => 'Сценарии', 'href' => '#nagruzka-hr'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать HR-бота';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet-rag';

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
/* HR page specific */
.ym-cta-block--primary{
  background:linear-gradient(135deg,rgba(121,242,255,.14),rgba(139,92,246,.12));
  border-color:rgba(121,242,255,.35);
}
.ym-cta-block--secondary{
  background:rgba(255,255,255,.04);
  border-color:rgba(255,255,255,.12);
  text-align:left;
}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-link--accent{color:var(--vna-accent)!important;text-decoration:underline!important;}
.vna-highlight-col{background:rgba(121,242,255,.08)!important;border-left:3px solid var(--vna-accent);}
.vna-compare .vna-highlight-col{color:var(--vna-accent)!important;}
.vna-bad{color:#f87171!important;}
.vna-tl-item h4{font-size:15px;margin-bottom:6px;color:var(--vna-heading);}

.vna-badge{display:inline-block;padding:3px 10px;border-radius:99px;font-size:11px;font-weight:700;}
.vna-badge--ok{background:rgba(34,197,94,.12);color:#4ade80;border:1px solid rgba(34,197,94,.25);}
.vna-badge--warn{background:rgba(245,158,11,.12);color:#fbbf24;border:1px solid rgba(245,158,11,.28);}
.vna-highlight-col{background:rgba(121,242,255,.06)!important;}
.vna-compare--scenarios td,.vna-compare--scenarios th{font-size:13px;}
.vna-steps-list{counter-reset:step;margin:0;padding:0;list-style:none;}
.vna-steps-list li{counter-increment:step;padding-left:36px;position:relative;margin-bottom:12px;color:var(--vna-muted);}
.vna-steps-list li::before{
  content:counter(step);position:absolute;left:0;top:0;
  width:24px;height:24px;border-radius:50%;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.3);
  color:var(--vna-accent);font-size:12px;font-weight:800;
  display:flex;align-items:center;justify-content:center;
}
.vna-rag-demo{
  margin-top:32px;padding:28px;border-radius:var(--vna-r-lg);
  background:rgba(255,255,255,.04);border:1px solid rgba(121,242,255,.18);
}
.vna-rag-demo__grid{display:grid;grid-template-columns:240px 1fr;gap:20px;margin-top:20px;}
@media(max-width:768px){.vna-rag-demo__grid{grid-template-columns:1fr;}}
.vna-rag-q{
  display:block;width:100%;text-align:left;padding:12px 14px;margin-bottom:8px;
  border-radius:12px;border:1px solid rgba(255,255,255,.12);
  background:rgba(255,255,255,.04);color:var(--vna-soft);font-size:13px;cursor:pointer;
  transition:border-color .2s,background .2s;
}
.vna-rag-q:hover,.vna-rag-q.is-active{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.08);color:#fff;
}
.vna-rag-demo__answer{display:flex;flex-direction:column;gap:12px;}
.vna-rag-demo__bubble{padding:16px 18px;border-radius:16px;font-size:14px;line-height:1.6;}
.vna-rag-demo__bubble--user{background:rgba(139,92,246,.12);border:1px solid rgba(139,92,246,.25);align-self:flex-end;max-width:85%;}
.vna-rag-demo__bubble--bot{background:rgba(255,255,255,.06);border:1px solid rgba(121,242,255,.22);align-self:flex-start;max-width:95%;}
.vna-rag-demo__who{display:block;font-size:10px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--vna-accent);margin-bottom:8px;}
.vna-rag-demo__conf{color:var(--vna-green);margin-left:8px;}
.vna-rag-demo__cite{
  display:flex;gap:12px;margin-top:14px;padding:12px;border-radius:12px;
  background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.2);font-size:12px;color:var(--vna-muted);
}
.vna-rag-demo__cite strong{color:var(--vna-soft);}
.vna-stack-row{display:flex;flex-wrap:wrap;gap:10px;}
.vna-stack-pill{
  padding:8px 16px;border-radius:99px;font-size:13px;font-weight:600;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:var(--vna-soft);
}
.vna-stack-pill--link:hover{border-color:rgba(121,242,255,.4);color:var(--vna-accent);}
.vna-stack-pill--active{background:rgba(121,242,255,.12);border-color:rgba(121,242,255,.35);color:var(--vna-accent);}
.vna-card--violet{border-color:rgba(139,92,246,.25)!important;}
.vna-metric-chip{
  display:inline-block;padding:4px 10px;border-radius:99px;font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:var(--vna-accent);margin-bottom:12px;
}
.vna-good{color:var(--vna-green)!important;}
.vna-bad{color:#f87171!important;}
.vna-neutral{color:var(--vna-muted)!important;}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-hr-pomoshchnik-page" role="main" tabindex="-1">

<section class="nero-ai-hero aihr-hero-block" id="hr-hero" aria-labelledby="aihr-hero-title">
<style>
/* ===== AI HR hero — самодостаточные стили (тёмная система .nero-ai-home-page) ===== */
.aihr-hero-block {
  --aihr-bg: #050711;
  --aihr-bg2: #080b17;
  --aihr-cyan: #79f2ff;
  --aihr-violet: #8b5cf6;
  --aihr-green: #22c55e;
  --aihr-amber: #f59e0b;
  --aihr-muted: #9aa8bd;
  --aihr-soft: #c7d2e5;
  --aihr-text: #e6edf7;
  --aihr-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  background:
    radial-gradient(ellipse 80% 55% at 72% 18%, rgba(121, 242, 255, 0.14), transparent 58%),
    radial-gradient(ellipse 55% 42% at 12% 82%, rgba(139, 92, 246, 0.12), transparent 62%),
    linear-gradient(180deg, var(--aihr-bg) 0%, var(--aihr-bg2) 100%);
  isolation: isolate;
}
.aihr-hero-block::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 30%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: 0;
}
.aihr-hero-block::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .12), transparent 66%);
  filter: blur(8px);
  animation: aihrHeroGlow 9s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes aihrHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .85; transform: scale(1.05); }
}
.aihr-hero-block .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aihr-hero-block .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aihr-hero-block .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aihr-hero-block .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aihr-cyan) 44%, var(--aihr-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aihr-hero-block .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aihr-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aihr-hero-block .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aihr-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aihr-hero-block .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aihr-hero-block .nero-ai-badge {
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
.aihr-hero-block .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aihr-hero-block .nero-ai-btn {
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
.aihr-hero-block .nero-ai-btn:hover { transform: translateY(-2px); }
.aihr-hero-block .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--aihr-cyan), #38bdf8);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aihr-hero-block .nero-ai-btn-secondary {
  color: var(--aihr-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aihr-hero-block .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aihr-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.aihr-hero-block .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aihr-hero-block .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aihr-hero-block .nero-ai-dots { display: flex; gap: 7px; }
.aihr-hero-block .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aihr-hero-block .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aihr-hero-block .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aihr-hero-block .nero-ai-dot:nth-child(3) { background: #34d399; }
.aihr-hero-block .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aihr-hero-block .nero-ai-window-body { padding: 16px; }
.aihr-hero-block .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aihr-hero-block .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aihr-hero-block .nero-ai-live-pill {
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
.aihr-hero-block .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aihrPulse 1.6s infinite;
}
@keyframes aihrPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aihr-hero-block .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aihr-hero-block .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aihr-hero-block .nero-ai-metric span {
  display: block;
  color: var(--aihr-muted);
  font-size: 11px;
  font-weight: 700;
}
.aihr-hero-block .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aihr-hero-block .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aihr-hero-block .aihr-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: radial-gradient(ellipse at 35% 40%, rgba(121,242,255,.08), rgba(6,10,24,.94) 72%);
}
.aihr-hero-block #aihr-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aihr-hero-block .nero-ai-task-stream { display: grid; gap: 8px; }
.aihr-hero-block .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aihr-hero-block .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--aihr-cyan);
  font-size: 11px;
  font-weight: 800;
}
.aihr-hero-block .nero-ai-task-icon--amber {
  background: rgba(245,158,11,.12);
  color: var(--aihr-amber);
}
.aihr-hero-block .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aihr-hero-block .nero-ai-task span {
  color: var(--aihr-muted);
  font-size: 11px;
}
.aihr-hero-block .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aihr-hero-block .nero-ai-status--cyan {
  background: rgba(121,242,255,.11);
  color: #a5f3fc;
}
.aihr-hero-block .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .aihr-hero-block .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aihr-hero-block .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aihr-hero-block .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aihr-hero-block .nero-ai-window-body { padding: 12px; }
  .aihr-hero-block .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aihr-hero-block .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai hr помощник</p>
      <h1 id="aihr-hero-title">AI HR-помощник для сотрудников: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI отвечает по вашим регламентам об отпусках, выплатах и правилах — а нестандартные вопросы автоматически превращает в заявку для HR</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">RAG-ответы</li>
        <li class="nero-ai-badge">Цитаты из регламентов</li>
        <li class="nero-ai-badge">Эскалация в CRM</li>
        <li class="nero-ai-badge">Telegram</li>
        <li class="nero-ai-badge">152-ФЗ</li>
        <li class="nero-ai-badge">Под ключ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet-rag">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо: AI HR-ассистент по регламентам">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">HR-ассистент · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI HR-центр</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Тикеты HR</span>
              <strong>−35%</strong>
              <small>deflection</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ответ</span>
              <strong>8 сек</strong>
              <small>типовой вопрос</small>
            </div>
            <div class="nero-ai-metric">
              <span>С цитатой</span>
              <strong>94%</strong>
              <small>approved docs</small>
            </div>
            <div class="nero-ai-metric">
              <span>Заявки</span>
              <strong>auto</strong>
              <small>эскалация CRM</small>
            </div>
          </div>
          <div class="aihr-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aihr-hero-canvas" role="img" aria-label="Анимация: вопрос сотрудника проходит RAG-поиск по регламенту, ответ с цитатой или эскалация в CRM"></canvas>
          </div>
          <div class="nero-ai-task-stream">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">?</span>
              <div><strong>Вопрос</strong><span>«Когда отпускные?»</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">вход</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">RAG</span>
              <div><strong>Поиск</strong><span>Положение об оплате труда</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">chunk</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Ответ</strong><span>Цитата: за 3 дня до отпуска</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--amber">CRM</span>
              <div><strong>Заявка HR</strong><span>нестандартный кейс</span></div>
              <span class="nero-ai-status nero-ai-status--amber">эскалация</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * aihr-hero-engine — «HR-диспетчерская знаний»
 * Мир: дуговой поток вопросов → RAG-консоль → цитата или тикет в CRM
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aihr-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 290) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    consoleBg: "#0f172a",
    consoleTop: "#1e293b",
    chatUser: "rgba(121,242,255,0.22)",
    chatBot: "rgba(34,197,94,0.18)",
    cite: "#79f2ff",
    docAmber: "#fef3c7",
    docBlue: "#dbeafe",
    docViolet: "#ede9fe",
    portalAmber: "#f59e0b",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    orbCyan: "rgba(121,242,255,0.75)"
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

  /* Дуговой поток вопросов — вместо Conveyor */
  function QuestionPulseStream() {
    this.orbs = [
      { angle: 0, label: "?", color: C.orbCyan },
      { angle: 2.1, label: "отпуск", color: "rgba(139,92,246,0.65)" },
      { angle: 4.2, label: "ДМС", color: "rgba(34,197,94,0.55)" }
    ];
  }
  QuestionPulseStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    var hubX = -55;
    var hubY = 8;
    var radius = 72;

    ctx.strokeStyle = "rgba(121,242,255,0.12)";
    ctx.lineWidth = 1.2;
    ctx.setLineDash([4, 6]);
    ctx.beginPath();
    ctx.arc(hubX, hubY, radius, Math.PI * 0.15, Math.PI * 1.35);
    ctx.stroke();
    ctx.setLineDash([]);

    this.orbs.forEach(function (orb, i) {
      var t = ((frame * 0.018 + orb.angle) % (Math.PI * 1.2));
      var a = Math.PI * 0.15 + t;
      var ox = hubX + Math.cos(a) * radius;
      var oy = hubY + Math.sin(a) * radius * 0.55;
      var pulse = 1 + Math.sin(frame * 0.08 + i) * 0.12;
      if (prg < 75 || prg > 250) {
        ctx.fillStyle = orb.color;
        ctx.beginPath();
        ctx.arc(ox, oy, 7 * pulse, 0, Math.PI * 2);
        ctx.fill();
        ctx.strokeStyle = C.cite;
        ctx.lineWidth = 1;
        ctx.stroke();
        if (orb.label !== "?") {
          ctx.fillStyle = "#e2e8f0";
          ctx.font = "bold 5px Inter,sans-serif";
          ctx.textAlign = "center";
          ctx.fillText(orb.label, ox, oy + 14);
        }
      }
    });

    if (prg >= 8 && prg < 70) {
      var intake = (prg - 8) / 62;
      var ix = -130 + intake * 75;
      var iy = -35 + Math.sin(intake * Math.PI) * -18;
      drawRR(ctx, ix - 28, iy - 10, 56, 20, 8, C.chatUser, C.cite);
      ctx.fillStyle = "#a5f3fc";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Когда отпускные?", ix - 22, iy + 2);
    }
  };

  /* Стеллаж регламентов */
  function RegulationArchiveShelf() {
    this.glow = 0;
  }
  RegulationArchiveShelf.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    drawRR(ctx, -168, -72, 36, 88, 5, "rgba(30,41,59,0.65)", C.outline);
    var docs = [C.docAmber, C.docBlue, C.docViolet, C.docAmber];
    docs.forEach(function (col, i) {
      drawRR(ctx, -162, -64 + i * 14, 24, 18, 2, col, C.outline);
    });
    ctx.fillStyle = C.cite;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Регламенты", -165, -78);

    if (prg >= 72 && prg < 155) {
      this.glow = Math.min(1, (prg - 72) / 30);
      var chunks = ["§4.2", "§7.1", "ТК РФ"];
      chunks.forEach(function (ch, i) {
        var pop = Math.min(1, (prg - 80 - i * 12) / 14);
        if (pop > 0) {
          var fx = -120 + i * 22;
          var fy = -50 - i * 8 + (1 - pop) * 20;
          ctx.globalAlpha = pop;
          drawRR(ctx, fx, fy, 28, 12, 3, "rgba(121,242,255,0.2)", C.cite);
          ctx.fillStyle = "#a5f3fc";
          ctx.font = "bold 5px Inter,sans-serif";
          ctx.textAlign = "center";
          ctx.fillText(ch, fx + 14, fy + 8);
          ctx.globalAlpha = 1;
        }
      });
    }
  };

  /* Луч подсветки цитаты */
  function CitationBeam() {
    this.alpha = 0;
  }
  CitationBeam.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg < 145 || prg > 210) return;
    this.alpha = Math.min(1, (prg - 145) / 20);
    ctx.save();
    ctx.globalAlpha = this.alpha * (0.35 + Math.sin(frame * 0.1) * 0.15);
    ctx.strokeStyle = C.cite;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(-100, -20);
    ctx.lineTo(15, -5);
    ctx.stroke();
    ctx.fillStyle = C.cite;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("цитата", -42, -28);
    ctx.restore();
  };

  /* RAG-консоль ответа — вместо WebsiteTerminal */
  function RagAnswerConsole() {
    this.phase = 0;
    this.ticketY = 0;
  }
  RagAnswerConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    var bx = 20;
    var by = -82;
    drawRR(ctx, bx, by, 130, 155, 10, C.consoleBg, C.outline);
    drawRR(ctx, bx + 6, by + 6, 118, 16, [6, 6, 0, 0], C.consoleTop, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("HR-чат · RAG", bx + 10, by + 16);

  /* Фаза 1: intake */
    if (prg >= 12) {
      drawRR(ctx, bx + 8, by + 28, 72, 18, 6, C.chatUser, C.cite);
      ctx.fillStyle = "#a5f3fc";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.fillText("Когда отпускные?", bx + 12, by + 39);
    }
  /* Фаза 2: retrieval spinner */
    if (prg >= 78 && prg < 148) {
      var spin = (prg - 78) * 0.15;
      ctx.strokeStyle = C.cite;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(bx + 100, by + 50, 8, spin, spin + Math.PI * 1.4);
      ctx.stroke();
      ctx.fillStyle = "#94a3b8";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("поиск…", bx + 100, by + 64);
    }
  /* Фаза 3: answer + citation */
    if (prg >= 148 && prg < 218) {
      var ansPop = Math.min(1, (prg - 148) / 18);
      ctx.globalAlpha = ansPop;
      drawRR(ctx, bx + 8, by + 52, 108, 32, 6, C.chatBot, "#22c55e");
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Отпускные — не позднее", bx + 12, by + 64);
      ctx.fillText("чем за 3 кален. дня", bx + 12, by + 74);
      drawRR(ctx, bx + 8, by + 88, 108, 14, 4, "rgba(121,242,255,0.15)", C.cite);
      ctx.fillStyle = C.cite;
      ctx.fillText("Положение об оплате §4.2", bx + 12, by + 98);
      ctx.globalAlpha = 1;
    }
  /* Фаза 4a: success check OR 4b: low confidence → escalate */
    if (prg >= 218) {
      var cycle = Math.floor(prg / 280) % 2;
      if (cycle === 0 || prg < 250) {
        ctx.fillStyle = C.agentGreen;
        ctx.font = "bold 10px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("✓ 94%", bx + 65, by + 125);
      }
    }
  };

  /* Портал эскалации в CRM */
  function EscalationTicketPortal() {
    this.ticketX = 0;
    this.ticketAlpha = 0;
  }
  EscalationTicketPortal.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    drawRR(ctx, 118, 18, 52, 70, 8, "rgba(245,158,11,0.12)", C.portalAmber);
    ctx.fillStyle = C.portalAmber;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM", 144, 30);
    ctx.fillText("HR", 144, 40);

    if (prg >= 238 && prg < 278) {
      this.ticketAlpha = Math.min(1, (prg - 238) / 12);
      this.ticketX = Math.min(1, (prg - 238) / 35);
      var tx = 55 + this.ticketX * 58;
      var ty = 35 - this.ticketX * 8;
      ctx.save();
      ctx.globalAlpha = this.ticketAlpha;
      drawRR(ctx, tx - 22, ty - 12, 44, 24, 5, "rgba(245,158,11,0.35)", C.portalAmber);
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Заявка HR", tx, ty + 2);
      ctx.fillText("нестандарт", tx, ty + 10);
      ctx.restore();
    }
  };

  /* Шкала уверенности */
  function ConfidenceOrb() {
    this.level = 0.94;
  }
  ConfidenceOrb.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg < 150 || prg > 265) return;
    var lv = prg < 235 ? 0.94 : 0.41;
    this.level += (lv - this.level) * 0.08;
    var cxo = 95;
    var cyo = 55;
    ctx.strokeStyle = "rgba(255,255,255,0.15)";
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(cxo, cyo, 14, 0, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = this.level > 0.7 ? C.agentGreen : C.portalAmber;
    ctx.beginPath();
    ctx.arc(cxo, cyo, 14, -Math.PI / 2, -Math.PI / 2 + Math.PI * 2 * this.level);
    ctx.stroke();
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(this.level * 100) + "%", cxo, cyo + 2);
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
    var prg = (frame * 0.042) % 280;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var hubTargets = {
      "1_architect": { x: -30, y: 55 },
      "2_seo": { x: 5, y: 62 },
      "3_coder": { x: 40, y: 62 },
      "4_designer": { x: 70, y: 55 },
      "5_deployer": { x: 100, y: 48 }
    };
    var tgt = hubTargets[this.role] || { x: 20, y: 58 };

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

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.1) {
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
    ctx.fillStyle = "#fff";
    ctx.beginPath();
    ctx.arc(3, -24 - bob, 2.5, 0, Math.PI * 2);
    ctx.fill();
    ctx.beginPath();
    ctx.arc(-3, -24 - bob, 2.5, 0, Math.PI * 2);
    ctx.fill();
    if (carryType) {
      drawRR(ctx, -16, -18 - bob, 12, 12, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new QuestionPulseStream());
  entities.push(new RegulationArchiveShelf());
  entities.push(new RagAnswerConsole());
  entities.push(new CitationBeam());
  entities.push(new EscalationTicketPortal());
  entities.push(new ConfidenceOrb());

  entities.push(new Agent(-145, 72, C.agentYellow, "1_architect", 18, [
    "Карта регламентов готова",
    "Раздел «Отпуск» — 12 chunk",
    "RBAC: офис ≠ цех"
  ]));
  entities.push(new Agent(-95, 88, C.agentGreen, "2_seo", 58, [
    "FAQ: отпускные, ДМС",
    "LSI: больничный 2026",
    "Топ-запрос: 2-НДФЛ"
  ]));
  entities.push(new Agent(-40, 92, C.agentBlue, "3_coder", 98, [
    "Гибридный поиск + rerank",
    "Confidence 0.94 — отвечаем",
    "Low conf → отказ + тикет"
  ]));
  entities.push(new Agent(15, 88, C.agentPink, "4_designer", 138, [
    "Кнопка «Позвать HR»",
    "Цитата под ответом",
    "Telegram UX ок"
  ]));
  entities.push(new Agent(75, 78, C.agentPurple, "5_deployer", 178, [
    "Webhook → Bitrix24",
    "Summary диалога в CRM",
    "Пилот: 50 сотрудников"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 240, maxLife: customLife || 240 });
  }

  var stepBubblesFired = {};

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.042) % 280;
    if (prg >= 10 && prg < 10.05 && !stepBubblesFired.a) { stepBubblesFired.a = true; createBubble(-90, -20, "Сотрудник: когда отпускные?", 260); }
    if (prg >= 80 && prg < 80.05 && !stepBubblesFired.b) { stepBubblesFired.b = true; createBubble(-130, -40, "RAG: ищем в Положении…", 260); }
    if (prg >= 155 && prg < 155.05 && !stepBubblesFired.c) { stepBubblesFired.c = true; createBubble(55, -30, "Цитата: за 3 дня до отпуска", 260); }
    if (prg >= 245 && prg < 245.05 && !stepBubblesFired.d) { stepBubblesFired.d = true; createBubble(120, 25, "Эскалация → CRM HR", 260); }
    if (prg < 5) { stepBubblesFired = {}; }

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
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
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 6, C.bubbleBg, C.cite);
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

<div class="vna-content ai-hr-pomoshchnik-content">

  <!-- INTRO: KPI второго экрана -->
  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai hr помощник</p>
          <p><strong>Коротко:</strong> AI HR-помощник — внутренний ассистент, который отвечает сотрудникам по вашим регламентам (отпуск, выплаты, правила, ДМС, командировки) с цитатой из документа. Нестандартные и чувствительные вопросы автоматически превращаются в заявку для HR с полным контекстом диалога.</p>
          <p>Nero Network внедряет такие системы под ключ: от аудита регламентов до пилота и запуска в Telegram, Teams или на корпоративном портале. Ориентир чека — <strong>180–500 тыс. ₽</strong> — mid-market коридор между маркетплейсом за 50 тыс. ₽ и банковским контуром.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые показатели HR AI">
          <div class="vna-kpi-card">
            <div class="kv">39%</div>
            <div class="kl">организаций уже используют AI в HR</div>
            <div class="ks">SHRM, 2026</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">30–45%</div>
            <div class="kl">снижение HR-тикетов при AI self-service</div>
            <div class="ks">Gartner</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">90%</div>
            <div class="kl">точность RAG-ответов (пилот ВТБ)</div>
            <div class="ks">osp.ru, 2025</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">180–500К</div>
            <div class="kl">внедрение под ключ</div>
            <div class="ks">Nero Network</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- TOC -->
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что такое</a>
        <a href="#nagruzka-hr">Сценарии</a>
        <a href="#kak-rabotaet-rag">RAG-демо</a>
        <a href="#kanaly">Каналы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#bezopasnost">Безопасность</a>
        <a href="#etapy">Этапы</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#pod-klyuch-vs-saas">vs SaaS</a>
        <a href="#vnedrenie-ai">AI-агенты</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- §1 Что такое -->
  <section class="vna-section" id="chto-takoe">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Определение</span>
        <h2>Что такое AI HR-помощник и зачем он компании</h2>
        <p>Корпоративный hr ассистент для сотрудников: conversational-интерфейс, который отвечает на HR-вопросы <strong>строго по утверждённым документам</strong> через RAG — с цитатой и ссылкой на первоисточник.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <p>Это не «ещё один ChatGPT для офиса» и не рекрутинговый бот. Внутренний <strong>ai hr помощник</strong> закрывает employee self-service: сотрудник спрашивает «когда придут отпускные» — и получает ответ по правилам <strong>именно вашей</strong> компании.</p>
        <p>В 2026 году McKinsey фиксирует переход к <strong>agentic AI</strong>: агенты создают заявки и маршрутизируют обращения. Для HR-систем базовое требование — <strong>доверие, источники и контроль</strong>. Цитата из регламента важнее красивой формулировки.</p>
      </div>

      <div class="vna-sh vna-left" style="margin-top:48px;">
        <span class="vna-eyebrow">Сравнение</span>
        <h3>Чем отличается от обычного HR-чата и от рекрутингового бота</h3>
      </div>
      <div class="vna-compare-wrap nero-ai-reveal">
        <table class="vna-compare" aria-label="Сравнение FAQ-бота, рекрутингового бота и RAG HR-помощника">
          <thead>
            <tr>
              <th>Критерий</th>
              <th>Сценарный FAQ-бот</th>
              <th>Рекрутинговый AI HR-бот</th>
              <th class="vna-highlight-col">AI HR-помощник на RAG</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Источник ответа</td>
              <td>Зашитые ветки диалога</td>
              <td>Вакансии, скрининг резюме</td>
              <td class="vna-good">Ваши регламенты, PDF, Notion</td>
            </tr>
            <tr>
              <td>Свободная формулировка</td>
              <td>Нет — только кнопки</td>
              <td>Частично</td>
              <td class="vna-good">Семантический поиск</td>
            </tr>
            <tr>
              <td>Цитата и ссылка</td>
              <td>Нет</td>
              <td>Не требуется</td>
              <td class="vna-good">Обязательна</td>
            </tr>
            <tr>
              <td>Эскалация в CRM</td>
              <td>Редко</td>
              <td>Не применимо</td>
              <td class="vna-good">Summary + цитаты + ID</td>
            </tr>
            <tr>
              <td>Обновление регламентов</td>
              <td>Ручная перепрошивка</td>
              <td>Отдельный контур</td>
              <td class="vna-good">Re-index + regression</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:28px;" id="dlya-kogo">
        <h3>Для кого подходит: компании от 50 сотрудников</h3>
        <p>Оптимальный профиль — <strong>50–500 сотрудников</strong> с HR-отделом 1–5 человек, накопленными регламентами и распределённой структурой. Для enterprise референсы: Совкомбанк «Сова» (~36 000 сотрудников), ВТБ (пилот 3 000).</p>
        <p><strong>Итог:</strong> ai hr помощник для компании окупается, когда стоимость часов HR на рутину превышает стоимость внедрения.</p>
      </div>
    </div>
  </section>

  <!-- §2 Нагрузка на HR -->
  <section class="vna-section vna-section-alt" id="nagruzka-hr">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Боль и сценарии</span>
        <h2>Какую нагрузку снимает с HR</h2>
        <p><strong>HR отвечает на одинаковые вопросы</strong> про отпуск, выплаты и правила. Gartner указывает <strong>30–45% снижение HR-тикетов</strong> при AI chatbots для benefits, leave и policy.</p>
      </div>

      <div class="vna-sh vna-left">
        <h3>Типовые вопросы сотрудников (отпуск, ДМС, командировки)</h3>
      </div>
      <div class="vna-compare-wrap nero-ai-reveal">
        <table class="vna-compare vna-compare--scenarios" aria-label="Типовой вопрос — регламент — ответ бота — эскалация">
          <thead>
            <tr>
              <th>Типовой вопрос</th>
              <th>Регламент</th>
              <th>Что делает бот</th>
              <th>Эскалация?</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Когда выплатят отпускные?</td>
              <td>Положение об оплате труда</td>
              <td>Цитирует: не позднее <strong>3 календарных дней</strong> до отпуска</td>
              <td><span class="vna-badge vna-badge--ok">Нет</span></td>
            </tr>
            <tr>
              <td>Сколько дней отпуска осталось?</td>
              <td>ЛНА + 1С:ЗУП API</td>
              <td>Остаток <strong>из учётной системы</strong></td>
              <td><span class="vna-badge vna-badge--warn">Если нет ERP</span></td>
            </tr>
            <tr>
              <td>Как оформить больничный в 2026?</td>
              <td>Инструкция по ЭЛН, СФР</td>
              <td>Электронный больничный; проактивный расчёт СФР</td>
              <td><span class="vna-badge vna-badge--warn">Индивидуальный кейс</span></td>
            </tr>
            <tr>
              <td>Где взять справку 2-НДФЛ?</td>
              <td>Регламент КДП</td>
              <td>Пошаговая инструкция + ссылка на портал</td>
              <td><span class="vna-badge vna-badge--ok">Нет</span></td>
            </tr>
            <tr>
              <td>Покрывает ли ДМС стоматологию?</td>
              <td>Договор ДМС</td>
              <td>Ответ по пакету с цитатой</td>
              <td><span class="vna-badge vna-badge--warn">Индивидуальный полис</span></td>
            </tr>
            <tr>
              <td>Как оформить командировку?</td>
              <td>Положение о командировках</td>
              <td>Чек-лист + сроки аванса</td>
              <td><span class="vna-badge vna-badge--ok">Нет / по сложности</span></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:32px;" id="eskalaciya-lyudi">
        <h3>Что остаётся за людьми: нестандартные кейсы и эскалация</h3>
        <p>AI HR-помощник <strong>не заменяет</strong> HR-директора. <strong>44% сотрудников</strong> (Gartner) предпочитают живого HR по компенсации и льготам — для этого встроена эскалация.</p>
        <p>Ключевой дифференциатор — <strong>автоматическая заявка</strong>: summary вопроса, цитаты из регламентов, ID сотрудника, приоритет — в CRM или Service Desk. Шаблон проверен на Coca-Cola Andina (агент Andi): кнопка «написать HR» → тикет с контекстом.</p>
      </div>
    </div>
  </section>

  <!-- ================================================
       БОРИС: визуальный блок RAG-пайплайна
       ================================================ -->
  <section id="ai-hr-pomoshchnik-boris-block" class="bhr-root" aria-label="Анимация: RAG-пайплайн HR-помощника — от регламентов к цитате и заявке">
<style>
/* === БОРИС: prefix bhr-, scoped внутри #ai-hr-pomoshchnik-boris-block === */
#ai-hr-pomoshchnik-boris-block.bhr-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-hr-pomoshchnik-boris-block .bhr-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-hr-pomoshchnik-boris-block .bhr-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  box-shadow:0 8px 48px rgba(15,23,42,.10),0 0 0 1.5px rgba(121,242,255,.18);
  min-height:500px;
  background:#fff;
}
@media(max-width:1023px){
  #ai-hr-pomoshchnik-boris-block .bhr-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-hr-pomoshchnik-boris-block .bhr-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-hr-pomoshchnik-boris-block .bhr-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-hr-pomoshchnik-boris-block .bhr-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;
  color:#0891b2;margin:0 0 14px;
}
#ai-hr-pomoshchnik-boris-block .bhr-ey::before{
  content:'';width:18px;height:2px;background:#0891b2;border-radius:1px;
}
#ai-hr-pomoshchnik-boris-block .bhr-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;
  line-height:1.28;margin:0 0 18px;
}
#ai-hr-pomoshchnik-boris-block .bhr-ul{
  list-style:none;margin:0 0 22px;padding:0;
  display:flex;flex-direction:column;gap:9px;
}
#ai-hr-pomoshchnik-boris-block .bhr-ul li{
  display:flex;align-items:flex-start;gap:10px;
  font-size:14.5px;line-height:1.5;color:#334155;
}
#ai-hr-pomoshchnik-boris-block .bhr-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(8,145,178,.1);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#0891b2;margin-top:1px;font-style:normal;
}
#ai-hr-pomoshchnik-boris-block .bhr-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-hr-pomoshchnik-boris-block .bhr-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-hr-pomoshchnik-boris-block .bhr-pl-c{background:rgba(121,242,255,.12);color:#0e7490;border:1.5px solid rgba(121,242,255,.35);}
#ai-hr-pomoshchnik-boris-block .bhr-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-hr-pomoshchnik-boris-block .bhr-pl-a{background:rgba(245,158,11,.10);color:#b45309;border:1.5px solid rgba(245,158,11,.28);}
#ai-hr-pomoshchnik-boris-block .bhr-foot{
  font-size:13px;color:#64748b;font-style:italic;margin:0;
}
#ai-hr-pomoshchnik-boris-block .bhr-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfeff 0%,#e0f2fe 40%,#f0f9ff 70%,#f8fafc 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){
  #ai-hr-pomoshchnik-boris-block .bhr-rgt{min-height:380px;}
}
#bhr-rag-pipeline-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>

<div class="bhr-cnt">
  <div class="bhr-card">
    <div class="bhr-lft">
      <span class="bhr-ey">RAG-пайплайн · под капотом</span>
      <h3 class="bhr-h3">От регламента к цитате: как бот отвечает без «догадок»</h3>
      <ul class="bhr-ul">
        <li><span class="bhr-ic">1</span>Регламенты индексируются с metadata: роль, филиал, дата версии</li>
        <li><span class="bhr-ic">2</span>Гибридный поиск находит релевантный chunk по смыслу запроса</li>
        <li><span class="bhr-ic">3</span>Ответ генерируется <strong>только</strong> с обязательной цитатой и ссылкой</li>
        <li><span class="bhr-ic">4</span>Низкий confidence или sensitive-тема → ветка эскалации в CRM</li>
      </ul>
      <div class="bhr-pills">
        <span class="bhr-pl bhr-pl-c">94% с цитатой</span>
        <span class="bhr-pl bhr-pl-g">8 сек ответ</span>
        <span class="bhr-pl bhr-pl-a">auto-заявка HR</span>
      </div>
      <p class="bhr-foot">Дальше — интерактивное RAG-демо и этапы внедрения →</p>
    </div>
    <div class="bhr-rgt">
      <canvas id="bhr-rag-pipeline-canvas" aria-label="Анимация RAG-пайплайна: документы → поиск → ответ с цитатой → эскалация в заявку" role="img"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  var cv = document.getElementById('bhr-rag-pipeline-canvas');
  if (!cv) return;
  var cx = cv.getContext('2d');
  var W=0,H=0,t=0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var CYAN='#22d3ee', CYAN_D=function(a){return 'rgba(34,211,238,'+a+')';};
  var GREEN='#4ade80', GREEN_D=function(a){return 'rgba(74,222,128,'+a+')';};
  var AMBER='#fbbf24', AMBER_D=function(a){return 'rgba(251,191,36,'+a+')';};
  var VIO='#a78bfa', VIO_D=function(a){return 'rgba(167,139,250,'+a+')';};
  var SLATE='#64748b', CARD='rgba(255,255,255,.88)', BDR='rgba(15,23,42,.10)';

  var DOCS=[
    {x:.12,y:.22,label:'Отпуск',w:.14,h:.09},
    {x:.12,y:.42,label:'Выплаты',w:.14,h:.09},
    {x:.12,y:.62,label:'ДМС',w:.14,h:.09},
  ];

  function rrect(x,y,w,h,r,fill,stroke){
    cx.beginPath();
  cx.moveTo(x+r,y);cx.lineTo(x+w-r,y);cx.quadraticCurveTo(x+w,y,x+w,y+r);
  cx.lineTo(x+w,y+h-r);cx.quadraticCurveTo(x+w,y+h,x+w-r,y+h);
  cx.lineTo(x+r,y+h);cx.quadraticCurveTo(x,y+h,x,y+h-r);
  cx.lineTo(x,y+r);cx.quadraticCurveTo(x,y,x+r,y);cx.closePath();
    if(fill){cx.fillStyle=fill;cx.fill();}
    if(stroke){cx.strokeStyle=stroke;cx.lineWidth=1.5;cx.stroke();}
  }

  function drawDoc(d, pulse){
    var x=d.x*W,y=d.y*H,w=d.w*W,h=d.h*H;
    rrect(x,y,w,h,6,CARD,BDR);
    cx.fillStyle=CYAN;cx.fillRect(x+8,y+8,w-16,3);
    cx.fillStyle='#0f172a';cx.font='bold 11px Inter,sans-serif';cx.textAlign='center';
    cx.fillText(d.label,x+w/2,y+h/2+4);
    if(pulse>0){
      cx.strokeStyle=CYAN_D(pulse*.5);cx.lineWidth=2;
      rrect(x-3,y-3,w+6,h+6,8,null,CYAN_D(pulse*.6));
    }
  }

  function drawArrow(x1,y1,x2,y2,prog,color){
    var x=x1+(x2-x1)*prog, y=y1+(y2-y1)*prog;
    cx.strokeStyle=color||CYAN_D(.5);cx.lineWidth=2;cx.setLineDash([4,4]);
    cx.beginPath();cx.moveTo(x1,y1);cx.lineTo(x,y);cx.stroke();cx.setLineDash([]);
    if(prog>.85){
      cx.fillStyle=color||CYAN;
      cx.beginPath();cx.arc(x2,y2,4,0,Math.PI*2);cx.fill();
    }
  }

  function drawSearchBox(phase){
    var x=W*.34,y=H*.38,w=W*.22,h=H*.24;
    rrect(x,y,w,h,10,'rgba(255,255,255,.95)',CYAN_D(.4));
    cx.fillStyle='#0891b2';cx.font='bold 10px Inter,sans-serif';cx.textAlign='left';
    cx.fillText('RETRIEVAL',x+12,y+18);
    cx.fillStyle=SLATE;cx.font='10px Inter,sans-serif';
    cx.fillText('«Когда отпускные?»',x+12,y+36);
    var bars=3;
    for(var i=0;i<bars;i++){
      var bw=(w-24)/bars-4;
      var bh=8+Math.sin(t*.08+i)*4+(phase>i*.3?12:0);
      cx.fillStyle=phase>i*.25?CYAN_D(.7):'rgba(148,163,184,.3)';
      cx.fillRect(x+12+i*(bw+4),y+50,bw,bh);
    }
  }

  function drawAnswerCard(alpha){
    var x=W*.62,y=H*.28,w=W*.30,h=H*.36;
    rrect(x,y,w,h,12,CARD,BDR);
    cx.globalAlpha=alpha;
    cx.fillStyle=GREEN;cx.font='bold 10px Inter,sans-serif';cx.textAlign='left';
    cx.fillText('✓ ОТВЕТ С ЦИТАТОЙ',x+14,y+22);
    cx.fillStyle='#0f172a';cx.font='11px Inter,sans-serif';
    cx.fillText('Отпускные — не позднее',x+14,y+42);
    cx.fillText('чем за 3 кал. дня до отпуска',x+14,y+58);
    cx.fillStyle=SLATE;cx.font='9px Inter,sans-serif';
    cx.fillText('📄 Положение об оплате труда, п.4.2',x+14,y+78);
    cx.fillText('версия 12.01.2026',x+14,y+92);
    cx.strokeStyle=GREEN_D(.4);cx.lineWidth=1;
    rrect(x+10,y+100,w-20,28,6,'rgba(34,197,94,.06)',GREEN_D(.35));
    cx.fillStyle='#15803d';cx.font='bold 9px Inter,sans-serif';
    cx.fillText('confidence: 96%',x+18,y+118);
    cx.globalAlpha=1;
  }

  function drawTicket(alpha){
    var x=W*.62,y=H*.72,w=W*.30,h=H*.14;
    rrect(x,y,w,h,10,'rgba(254,243,199,.95)',AMBER_D(.5));
    cx.globalAlpha=alpha;
    cx.fillStyle='#b45309';cx.font='bold 10px Inter,sans-serif';cx.textAlign='left';
    cx.fillText('⚡ ЗАЯВКА HR',x+14,y+22);
    cx.fillStyle='#92400e';cx.font='9px Inter,sans-serif';
    cx.fillText('Нестандарт · индивидуальный кейс',x+14,y+38);
    cx.globalAlpha=1;
  }

  function loop(){
    t++;
    cx.clearRect(0,0,W,H);

    /* grid bg */
    cx.strokeStyle='rgba(148,163,184,.12)';cx.lineWidth=1;
    for(var gx=0;gx<W;gx+=28){cx.beginPath();cx.moveTo(gx,0);cx.lineTo(gx,H);cx.stroke();}
    for(var gy=0;gy<H;gy+=28){cx.beginPath();cx.moveTo(0,gy);cx.lineTo(W,gy);cx.stroke();}

    var cycle=t%480;
    var phase1=Math.min(1,cycle/80);
    var phase2=Math.min(1,Math.max(0,(cycle-80)/100));
    var phase3=Math.min(1,Math.max(0,(cycle-200)/120));
    var phase4=Math.min(1,Math.max(0,(cycle-340)/100));

    DOCS.forEach(function(d,i){
      var pulse=Math.max(0,Math.sin((t+i*40)*.06)*.5);
      if(cycle<120) drawDoc(d, pulse*phase1);
      else drawDoc(d, .15);
    });

    if(cycle>=40 && cycle<200){
      DOCS.forEach(function(d,i){
        drawArrow(d.x*W+d.w*W,d.y*H+d.h*H/2, W*.34, H*.50, Math.min(1,phase1-i*.15), CYAN_D(.45));
      });
    }

    drawSearchBox(phase2);

    if(cycle>=200) drawAnswerCard(phase3);
    if(cycle>=340) drawTicket(phase4);

  /* labels */
    cx.fillStyle=SLATE;cx.font='9px Inter,sans-serif';cx.textAlign='center';
    cx.fillText('INGEST',W*.19,H*.88);
    cx.fillText('RETRIEVE',W*.45,H*.88);
    cx.fillText('GENERATE',W*.77,H*.22);
    if(cycle>=340) cx.fillText('ESCALATE',W*.77,H*.90);

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
  </section>

  <!-- §3 RAG -->
  <section class="vna-section" id="kak-rabotaet-rag">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Технология</span>
        <h2>Как работает AI HR-помощник на ваших регламентах (RAG)</h2>
        <p><strong>rag hr бот</strong> — нейросеть каждый раз ищет актуальный фрагмент в базе документов, генерирует ответ и прикладывает цитату. Галлюцинация без источника архитектурно запрещена.</p>
      </div>

      <div class="vna-card nero-ai-reveal" id="zagruzka-reglamentov">
        <h3>Загрузка и версионирование регламентов</h3>
        <ol class="vna-steps-list">
          <li><strong>Сбор документов:</strong> отпуска, больничные, ДМС, командировки, IT-политики.</li>
          <li><strong>Нормализация:</strong> единый формат, пометка «approved for AI».</li>
          <li><strong>Chunking:</strong> разбивка с metadata — роль, филиал, <strong>дата версии</strong>.</li>
          <li><strong>Индексация:</strong> vector store + keyword-индекс.</li>
          <li><strong>Обновление:</strong> re-index и regression-тесты при смене регламента.</li>
        </ol>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:24px;" id="otvet-po-istochnikam">
        <h3>Ответ только по источникам: ссылки на документ</h3>
        <div class="vna-timeline">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h4>1. Авторизация</h4><p>Корп. аккаунт / Telegram с верификацией.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h4>2. Вопрос</h4><p>Свободная формулировка сотрудника.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h4>3. Intent</h4><p>policy Q&A / transaction / sensitive.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h4>4. Retrieval</h4><p>Фильтр по роли + гибридный поиск + rerank.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h4>5. Генерация</h4><p>Ответ с <strong>обязательной цитатой</strong> и датой версии.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h4>6. Confidence</h4><p>Ниже порога — отказ + эскалация.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h4>7. Audit log</h4><p>Что спросили, какие chunks, что ответил бот.</p></div>
        </div>
        <p style="margin-top:16px;">ВТБ: точность <strong>90%</strong> vs <strong>70–80%</strong> у операционистов под нагрузкой; время поиска <strong>−9×</strong>.</p>
      </div>

      <!-- RAG DEMO -->
      <div class="vna-rag-demo nero-ai-reveal" id="rag-demo" aria-label="Интерактивное демо RAG HR-помощника">
        <div class="vna-rag-demo__head">
          <span class="vna-eyebrow">RAG-демо</span>
          <h3>Попробуйте: вопрос → ответ с цитатой из регламента</h3>
          <p>Нажмите типовой вопрос сотрудника — увидите, как бот отвечает по документу компании (mock-демо на лендинге).</p>
        </div>
        <div class="vna-rag-demo__grid">
          <div class="vna-rag-demo__questions" role="list">
            <button type="button" class="vna-rag-q is-active" data-q="otpusknye" role="listitem">Когда выплатят отпускные?</button>
            <button type="button" class="vna-rag-q" data-q="bolnichny" role="listitem">Как оформить больничный в 2026?</button>
            <button type="button" class="vna-rag-q" data-q="dms" role="listitem">Покрывает ли ДМС стоматологию?</button>
            <button type="button" class="vna-rag-q" data-q="otpusk" role="listitem">Сколько дней отпуска у меня осталось?</button>
          </div>
          <div class="vna-rag-demo__answer" id="rag-demo-answer" aria-live="polite">
            <div class="vna-rag-demo__bubble vna-rag-demo__bubble--user">
              <span class="vna-rag-demo__who">Сотрудник</span>
              <p>Когда выплатят отпускные?</p>
            </div>
            <div class="vna-rag-demo__bubble vna-rag-demo__bubble--bot">
              <span class="vna-rag-demo__who">AI HR-помощник <span class="vna-rag-demo__conf">confidence 96%</span></span>
              <p>Отпускные выплачиваются <strong>не позднее чем за 3 календарных дня</strong> до начала отпуска (ст. 136 ТК РФ, п. 4.2 Положения об оплате труда).</p>
              <div class="vna-rag-demo__cite">
                <span class="vna-rag-demo__cite-icon" aria-hidden="true">📄</span>
                <div>
                  <strong>Положение об оплате труда</strong>, п. 4.2<br>
                  <span>версия от 12.01.2026 · approved for AI</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:28px;" id="zayavka-nestandart">
        <h3>Создание заявки при нестандартном вопросе</h3>
        <div class="vna-compare-wrap">
          <table class="vna-compare" aria-label="Матрица эскалации">
            <thead><tr><th>Условие</th><th>Действие бота</th></tr></thead>
            <tbody>
              <tr><td>Confidence ниже порога</td><td>«Не уверен» → заявка HR</td></tr>
              <tr><td>Тема в deny-list</td><td>Немедленная эскалация</td></tr>
              <tr><td>Персональное исключение</td><td>Заявка «индивидуальный кейс»</td></tr>
              <tr><td>Запрос «позови HR»</td><td>Тикет без попытки ответа</td></tr>
              <tr><td>Транзакция (справка)</td><td>Маршрут в 1С/HRIS</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:14px;"><strong>Лид-магнит:</strong> FAQ сотрудников на базе ваших регламентов — без полного бота на первом этапе.</p>
      </div>
    </div>
  </section>

  <!-- CTA #1 после RAG -->
  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-rag-faq">
      <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Соберём FAQ сотрудников на базе ваших регламентов</p>
        <p class="ym-cta-block__sub">Первый шаг без полного бота: на аудите соберём топ-вопросы HR, покажем RAG-ответ с цитатой из вашего документа и оценим сроки внедрения. Бесплатно, до подписания договора.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Собрать HR-бота'); ?></a>
      </div>
    </div>
  </div>

  <!-- §4 Каналы -->
  <section class="vna-section vna-section-alt" id="kanaly">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Каналы</span>
        <h2>Каналы для сотрудников</h2>
        <p>Внутренний чат бот для сотрудников должен жить там, где люди уже работают. Adoption Slack/Teams — <strong>85–92%</strong>, web-портал — <strong>45–55%</strong>.</p>
      </div>
      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card" id="kanal-telegram">
          <div class="vna-eyebrow">Telegram</div>
          <h3>Корпоративный мессенджер</h3>
          <p>Кейс «Велесстрой» — бот для <strong>25 000+</strong> сотрудников с 1С:ЗУП. Gradient: <strong>70%</strong> возвращаются к боту. Низкий порог, push-уведомления.</p>
        </div>
        <div class="vna-card nero-ai-delay-1" id="kanal-portal">
          <div class="vna-eyebrow">Портал / HRIS</div>
          <h3>Виджет на intranet или в LMS</h3>
          <p>Уместен, если портал — точка входа. Как <strong>единственный</strong> канал adoption ниже — лучше дублировать в мессенджере.</p>
        </div>
        <div class="vna-card nero-ai-delay-2" id="kanal-edinaya-bz">
          <div class="vna-eyebrow">Единая БЗ</div>
          <h3>Один RAG-core — много каналов</h3>
          <p>Сотрудник в Telegram, HR в админке, заявки в Bitrix24 — источник правды один. Исключает «в Wiki одно, в чате другое».</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §5 Интеграции -->
  <section class="vna-section" id="integracii">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Интеграции</span>
        <h2>Интеграции и эскалация в заявки</h2>
        <p>Интеграция ai hr помощник — часть workflow. Без CRM эскалация превращается в скриншот в чат HR.</p>
      </div>
      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card"><h3>CRM и тикеты</h3><p>Bitrix24, amoCRM, Jira Service Management, Naumen, ServiceNow. Заявка: тема ← intent; описание ← summary; вложения ← цитаты.</p></div>
        <div class="vna-card nero-ai-delay-1"><h3>Маршрутизация</h3><p>Кадровые → HR; IT → Service Desk; ДМС → ответственный; командировки → travel.</p></div>
        <div class="vna-card nero-ai-delay-2"><h3>Аудит и 1С</h3><p>Audit log, дашборд аналитики, eval harness. 1С:ЗУП — остаток отпуска <strong>через API</strong>, не через LLM.</p></div>
      </div>
      <div class="vna-stack-row nero-ai-reveal" style="margin-top:28px;" aria-label="Поддерживаемые системы">
        <span class="vna-stack-pill">Bitrix24</span>
        <span class="vna-stack-pill">amoCRM</span>
        <span class="vna-stack-pill">Jira</span>
        <span class="vna-stack-pill">1С:ЗУП</span>
        <span class="vna-stack-pill">ServiceNow</span>
        <span class="vna-stack-pill">Telegram</span>
      </div>
    </div>
  </section>

  <!-- §6 Безопасность -->
  <section class="vna-section vna-section-alt" id="bezopasnost">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Governance 2026</span>
        <h2>Безопасность, доверие и персональные данные</h2>
        <p>McKinsey AI Trust 2026: <strong>agentic AI governance</strong> — фундамент, не дополнение.</p>
      </div>
      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card vna-card--violet" id="rbac">
          <h3>RBAC и роли</h3>
          <p>Офис и производство видят разные фрагменты. Филиалы — фильтр по локации. Руководители — расширенный доступ.</p>
        </div>
        <div class="vna-card vna-card--violet nero-ai-delay-1" id="galucinacii">
          <h3>Защита от галлюцинаций</h3>
          <p>Только approved docs, mandatory citations, confidence threshold, deny-lists, guardrail-слой, regression-тесты.</p>
        </div>
        <div class="vna-card vna-card--violet nero-ai-delay-2" id="yuridicheskaya">
          <h3>Юридическая значимость</h3>
          <p>Бот объясняет правила и создаёт заявку. Не принимает юридически значимых решений. Ответ — справочная информация.</p>
        </div>
      </div>
      <div class="vna-compare-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vna-compare vna-compare--security" aria-label="Матрица 152-ФЗ">
          <thead><tr><th>Данные</th><th>Облако РФ</th><th>On-prem</th><th>В промпт LLM</th></tr></thead>
          <tbody>
            <tr><td>Обезличенные регламенты</td><td class="vna-good">✓</td><td class="vna-good">✓</td><td>—</td></tr>
            <tr><td>ФИО + должность (SSO)</td><td class="vna-good">✓ с DPA</td><td class="vna-good">✓</td><td>—</td></tr>
            <tr><td>Зарплата, остаток отпуска</td><td>Только API</td><td class="vna-good">✓</td><td class="vna-bad">✗</td></tr>
            <tr><td>Медицинские данные</td><td class="vna-bad">✗</td><td class="vna-bad">✗</td><td class="vna-bad">✗</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- §7 Этапы -->
  <section class="vna-section" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Внедрение под ключ</span>
        <h2>Внедрение AI HR-помощника под ключ: этапы и сроки</h2>
        <p>Проект <strong>4–8 недель</strong>. Ai hr помощник без программиста у заказчика — интеграции на стороне Nero Network.</p>
      </div>
      <div class="vna-timeline nero-ai-reveal">
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Аудит регламентов и FAQ</h3><p>Discovery 3–5 дней: топ-30 вопросов HR, карта документов, eval-набор 30–50 вопросов. <strong>Бесплатный первый шаг.</strong></p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Пилот на одном отделе</h3><p>2 недели: HR + 20–50 сотрудников. Eval на 50–150 вопросов. Метрики: accuracy, CSAT, % эскалаций.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Масштабирование</h3><p>Все каналы, роли, филиалы. Интеграция 1С/CRM. SLA на доработку промптов <strong>30 дней</strong>.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Обучение HR и администраторов</h3><p>Runbook: загрузка регламента, re-index, аналитика пробелов, обработка эскалаций.</p></div>
      </div>
    </div>
  </section>

  <!-- CTA #2 после этапов -->
  <div class="vna-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">HR-администраторам: как управлять базой знаний бота?</p>
        <p class="ym-cta-block__sub">Перед пилотом полезно разобраться в RAG, промптах, human-in-the-loop и работе с deny-lists — это ускоряет eval и согласование с IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url ?? '#kak-rabotaet-rag'); ?>" class="ym-link ym-link--accent"<?php echo (str_starts_with($secondary_cta_url ?? '', 'http') ? $primary_cta_attrs : ''); ?>><?php echo esc_html($secondary_cta_label ?? 'Как работает RAG'); ?></a>.</p>
      </div>
    </aside>
  </div>

  <!-- §8 Стоимость -->
  <section class="vna-section vna-section-alt" id="stoimost">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Цена</span>
        <h2>Стоимость внедрения AI HR-помощника</h2>
        <p>Ориентир Nero Network: <strong>180–500 тыс. ₽</strong> — кастомное внедрение с вашими регламентами, интеграциями и audit trail.</p>
      </div>
      <div class="vna-compare-wrap nero-ai-reveal">
        <table class="vna-compare" aria-label="Факторы цены">
          <thead><tr><th>Фактор</th><th>Влияние</th></tr></thead>
          <tbody>
            <tr><td>Объём документов (10 vs 100+)</td><td>Подготовка базы, chunking, тесты</td></tr>
            <tr><td>Каналы (Telegram + Teams + портал)</td><td>Адаптеры каналов</td></tr>
            <tr><td>Интеграции (1С, Bitrix24, SSO)</td><td>API, безопасность</td></tr>
            <tr><td>RBAC (роли, филиалы)</td><td>Фильтры retrieval</td></tr>
            <tr><td>On-prem vs облако РФ</td><td>Инфраструктура</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Что входит в «под ключ»</h3>
        <ul>
          <li>Discovery и аудит регламентов</li>
          <li>RAG-пайплайн и база знаний</li>
          <li>Эскалация в CRM/тикет-систему</li>
          <li>Один канал + админ-панель</li>
          <li>Пилот, eval, обучение HR, 30 дней поддержки</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- §9 Кейсы -->
  <section class="vna-section" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения</h2>
      </div>
      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card">
          <div class="vna-metric-chip">−9× время поиска</div>
          <h3>ВТБ (RAG)</h3>
          <p>Пилот 3 000 сотрудников. Точность <strong>90%</strong> vs 70–80% вручную. Прогноз экономии <strong>2,5 млн ₽</strong>.</p>
        </div>
        <div class="vna-card nero-ai-delay-1">
          <div class="vna-metric-chip">&gt;90 000 запросов</div>
          <h3>Совкомбанк «Сова»</h3>
          <p>~36 000 сотрудников. <strong>310 000 ч/год</strong> экономии. Точность с 72% до 89% за 5 мес.</p>
        </div>
        <div class="vna-card nero-ai-delay-2">
          <div class="vna-metric-chip">24/7 FAQ</div>
          <h3>Ресторанный холдинг</h3>
          <p>RAG + Notion + PostgreSQL. Ответы по смыслу с цитатой. Было 10–20 мин на поиск.</p>
        </div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:28px;" id="roi">
        <h3>ROI: экономия часов HR</h3>
        <p>200 обращений/мес × 15 мин = <strong>50 ч/мес</strong> только на FAQ → <strong>600 ч/год</strong>. Время ответа: с часов до секунд. Меньше ошибок за счёт цитат. Прозрачный audit trail.</p>
      </div>
    </div>
  </section>

  <!-- §10 vs SaaS -->
  <section class="vna-section vna-section-alt" id="pod-klyuch-vs-saas">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Сравнение</span>
        <h2>AI HR-помощник под ключ vs готовые SaaS-платформы</h2>
      </div>
      <div class="vna-compare-wrap nero-ai-reveal">
        <table class="vna-compare" aria-label="Маркетплейс vs SaaS vs Nero Network">
          <thead>
            <tr><th>Критерий</th><th>Маркетплейс (~50К)</th><th>SaaS HR</th><th class="vna-highlight-col">Nero под ключ</th></tr>
          </thead>
          <tbody>
            <tr><td>Ваши регламенты</td><td>Частично</td><td>Ограничено</td><td class="vna-good">Полная</td></tr>
            <tr><td>RAG с цитатами</td><td>Редко на демо</td><td>Зависит</td><td class="vna-good">Демо на лендинге</td></tr>
            <tr><td>Эскалация в CRM</td><td>«Напишите HR»</td><td>Без диалога</td><td class="vna-good">Summary + цитаты</td></tr>
            <tr><td>152-ФЗ / on-prem</td><td>Заявлено</td><td>Зависит</td><td class="vna-good">YandexGPT/GigaChat</td></tr>
            <tr><td>Чек</td><td>50–100К</td><td>Подписка</td><td class="vna-good">180–500К</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Когда SaaS достаточно, а когда нужен RAG-агент</h3>
        <p><strong>SaaS:</strong> &lt;30 сотрудников, 5–10 вопросов, нет филиалов. <strong>RAG под ключ:</strong> 50+ сотрудников, разветвлённые регламенты, 1С/CRM, 152-ФЗ, audit log, онбординг + policy Q&A.</p>
      </div>
    </div>
  </section>

  <!-- §11 Связь с AI -->
  <section class="vna-section" id="vnedrenie-ai">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Экосистема</span>
        <h2>Связь с внедрением AI-агентов в бизнес</h2>
        <p>AI HR-помощник — модуль воронки <strong>внедрение ai агентов</strong> и <strong>внедрение ai в бизнес процессы</strong>.</p>
      </div>
      <div class="vna-stack-row nero-ai-reveal" aria-label="Смежные услуги">
        <a href="/vnedrenie-ai-amocrm/" class="vna-stack-pill vna-stack-pill--link">AI для amoCRM</a>
        <a href="/ai-1c-erp/" class="vna-stack-pill vna-stack-pill--link">AI для 1С и ERP</a>
        <span class="vna-stack-pill vna-stack-pill--active">AI HR-помощник</span>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:24px;">
        <p>Workday Sana (2026): <strong>90% adoption за 40 дней</strong> — тренд governed platform vs shadow ChatGPT. Внутренний бот закрывает запрос «почему бы не спросить ChatGPT» — легально, с цитатами и контролем.</p>
        <!-- INTERNAL-LINKS:INSERT -->
      </div>
    </div>
  </section>

  <!-- §12 FAQ -->
  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Вопрос — ответ</span>
        <h2>FAQ по AI HR-помощнику</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item" id="faq-kak-vnedrit">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai hr помощник в нашей компании?</div>
          <div class="vna-faq-a"><p>Аудит → eval-набор → подготовка базы → RAG → пилот → масштабирование. Срок <strong>4–8 недель</strong>.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-skolko">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит ai hr помощник?</div>
          <div class="vna-faq-a"><p>Ориентир <strong>180–500 тыс. ₽</strong> под ключ. Точная цена — после аудита. Первый шаг бесплатный.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-zamenit">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли бот HR-отдел?</div>
          <div class="vna-faq-a"><p>Нет. Бот снимает рутину. <strong>44%</strong> предпочитают человека по компенсации — встроена эскалация.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-galucinacii">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как вы защищаете от галлюцинаций?</div>
          <div class="vna-faq-a"><p>Approved docs, цитаты, confidence threshold, deny-lists, regression-тесты. При низкой уверенности — отказ.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-programmist">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Нужны ли программисты на нашей стороне?</div>
          <div class="vna-faq-a"><p>Нет. Nero Network делает интеграции. От вас — регламенты, доступы, участие HR в eval.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-malyj-biznes">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли для малого бизнеса?</div>
          <div class="vna-faq-a"><p>При 15–20+ повторяющихся HR-вопросах в месяц — да. Оптимум от 50 сотрудников.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-1c-crm">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли интегрировать с 1С и CRM?</div>
          <div class="vna-faq-a"><p>Да: Bitrix24, amoCRM, Jira, 1С:ЗУП через API. Персональные расчёты — не через LLM.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-152">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Где хранятся данные и 152-ФЗ?</div>
          <div class="vna-faq-a"><p>Облако РФ или on-prem. ПДн в промпт не передаются. Диалоги шифруются.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-reglamenty">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Что если регламенты в разных файлах?</div>
          <div class="vna-faq-a"><p>Discovery включает нормализацию. Настраиваем versioning и re-index при изменениях.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-uspeh">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как измерить успех внедрения?</div>
          <div class="vna-faq-a"><p>KPI: deflection, time-to-answer, CSAT, % citation, repeat usage, пробелы в базе.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA #3 финальный -->
  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Собрать HR-бота под ваши регламенты</p>
        <p class="ym-cta-block__sub">Ориентир 180–500 тыс. ₽ под ключ. На аудите соберём FAQ сотрудников, покажем RAG с цитатой из регламента и дадим точную оценку сроков и интеграций — без обязательств.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Собрать HR-бота'); ?></a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
        </div>
      </div>
    </div>
  </div>

</div><!-- /.vna-content -->

<?php
$aihr_page_url = trailingslashit( get_permalink() );
$aihr_site_url = trailingslashit( home_url( '/' ) );
$aihr_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$aihr_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $aihr_site_url . '#organization',
      'name'  => $aihr_brand,
      'url'   => $aihr_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $aihr_site_url . '#website',
      'url'       => $aihr_site_url,
      'name'      => $aihr_brand,
      'publisher' => [ '@id' => $aihr_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $aihr_page_url . '#webpage',
      'url'         => $aihr_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $aihr_site_url . '#website' ],
      'about'       => [ '@id' => $aihr_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $aihr_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $aihr_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $aihr_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $aihr_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $aihr_page_url,
      'provider'    => [ '@id' => $aihr_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $aihr_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить ai hr помощник в нашей компании?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит → eval-набор → подготовка базы → RAG → пилот → масштабирование. Срок 4–8 недель.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит ai hr помощник?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир 180–500 тыс. ₽ под ключ. Точная цена — после аудита. Первый шаг бесплатный.' ] ],
        [ '@type' => 'Question', 'name' => 'Заменит ли бот HR-отдел?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. Бот снимает рутину. 44% предпочитают человека по компенсации — встроена эскалация.' ] ],
        [ '@type' => 'Question', 'name' => 'Как вы защищаете от галлюцинаций?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Approved docs, цитаты, confidence threshold, deny-lists, regression-тесты. При низкой уверенности — отказ.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужны ли программисты на нашей стороне?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. Nero Network делает интеграции. От вас — регламенты, доступы, участие HR в eval.' ] ],
        [ '@type' => 'Question', 'name' => 'Подходит ли для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'При 15–20+ повторяющихся HR-вопросах в месяц — да. Оптимум от 50 сотрудников.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли интегрировать с 1С и CRM?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да: Bitrix24, amoCRM, Jira, 1С:ЗУП через API. Персональные расчёты — не через LLM.' ] ],
        [ '@type' => 'Question', 'name' => 'Где хранятся данные и 152-ФЗ?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Облако РФ или on-prem. ПДн в промпт не передаются. Диалоги шифруются.' ] ],
        [ '@type' => 'Question', 'name' => 'Что если регламенты в разных файлах?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Discovery включает нормализацию. Настраиваем versioning и re-index при изменениях.' ] ],
        [ '@type' => 'Question', 'name' => 'Как измерить успех внедрения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'KPI: deflection, time-to-answer, CSAT, % citation, repeat usage, пробелы в базе.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $aihr_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>


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
  var demos={
    otpusknye:{
      user:'Когда выплатят отпускные?',
      bot:'Отпускные выплачиваются <strong>не позднее чем за 3 календарных дня</strong> до начала отпуска (ст. 136 ТК РФ, п. 4.2 Положения об оплате труда).',
      cite:'Положение об оплате труда', citeMeta:'п. 4.2 · версия 12.01.2026', conf:'96%'
    },
    bolnichny:{
      user:'Как оформить больничный в 2026?',
      bot:'Больничный оформляется в электронном виде (ЭЛН). С <strong>1 июля 2026</strong> СФР может рассчитать пособие проактивно при полном наборе данных от работодателя.',
      cite:'Инструкция по ЭЛН и пособиям', citeMeta:'раздел 3 · версия 05.02.2026', conf:'91%'
    },
    dms:{
      user:'Покрывает ли ДМС стоматологию?',
      bot:'По пакету «Стандарт+» стоматология покрывается <strong>в экстренных случаях</strong> (боль, травма). Плановое лечение — по отдельному допсоглашению.',
      cite:'Договор ДМС, приложение 2', citeMeta:'п. 7.3 · версия 01.12.2025', conf:'88%'
    },
    otpusk:{
      user:'Сколько дней отпуска у меня осталось?',
      bot:'Остаток отпуска: <strong>14 календарных дней</strong> (данные 1С:ЗУП на 27.08.2026). Для переноса или исключений — создам заявку HR.',
      cite:'1С:ЗУП КОРП · API', citeMeta:'запрос #ERP-4421 · не LLM', conf:'99%', escalate:true
    }
  };
  var btns=document.querySelectorAll('.vna-rag-q');
  var box=document.getElementById('rag-demo-answer');
  if(!btns.length||!box)return;
  function render(key){
    var d=demos[key];if(!d)return;
    var escHtml=function(s){return s;};
    box.innerHTML=
      '<div class="vna-rag-demo__bubble vna-rag-demo__bubble--user"><span class="vna-rag-demo__who">Сотрудник</span><p>'+d.user+'</p></div>'+
      '<div class="vna-rag-demo__bubble vna-rag-demo__bubble--bot"><span class="vna-rag-demo__who">AI HR-помощник <span class="vna-rag-demo__conf">confidence '+d.conf+'</span></span><p>'+d.bot+'</p>'+
      '<div class="vna-rag-demo__cite"><span aria-hidden="true">📄</span><div><strong>'+d.cite+'</strong><br><span>'+d.citeMeta+'</span></div></div>'+
      (d.escalate?'<p style="margin-top:12px;font-size:12px;color:#fbbf24;">⚡ Нестандарт → заявка HR создана автоматически</p>':'')+
      '</div>';
  }
  btns.forEach(function(b){
    b.addEventListener('click',function(){
      btns.forEach(function(x){x.classList.remove('is-active');});
      b.classList.add('is-active');
      render(b.getAttribute('data-q'));
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-hr-pomoshchnik-page');
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

<?php get_footer(); ?>

<?php
/**
 * Template Name: AI-онбординг клиентов после покупки — внедрение под ключ
 * Description: SEO-лендинг — AI-онбординг post-sale: ведём клиента после оплаты до первого результата. SaaS, онлайн-школы, CRM-интеграция.
 */

$page_seo_title       = 'AI-онбординг клиентов после покупки — внедрение под ключ';
$page_seo_description = 'AI-онбординг под ключ: ведём клиента после оплаты до первого результата. SaaS, онлайн-школы, CRM-интеграция — рост доходимости и удержания.';

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
    ['label' => 'Проблема',    'href' => '#problema'],
    ['label' => 'Решение',     'href' => '#chto-takoe'],
    ['label' => 'Сценарий',    'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение',   'href' => '#vnedrenie'],
    ['label' => 'Кейсы',       'href' => '#keisy'],
    ['label' => 'Стоимость',   'href' => '#ceny'],
    ['label' => 'FAQ',         'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Построить AI-онбординг';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Карта онбординга';
$secondary_cta_url = '#karta-onboarding';

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
   VNAO PAGE — GLOBAL RESETS
   ===================================================== */
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

/* =====================================================
   VNAO CONTENT ROOT — dark theme
   ===================================================== */
.vnao-content{
  --vnao-bg:#050711;--vnao-bg2:#080b17;--vnao-bg3:#0a0e1c;
  --vnao-surface:rgba(255,255,255,.072);--vnao-surface2:rgba(255,255,255,.108);
  --vnao-text:#e6edf7;--vnao-muted:#9aa8bd;--vnao-soft:#c7d2e5;--vnao-heading:#fff;
  --vnao-border:rgba(255,255,255,.10);--vnao-border-s:rgba(255,255,255,.18);
  --vnao-accent:#79f2ff;--vnao-violet:#8b5cf6;--vnao-green:#22c55e;--vnao-cyan:#79f2ff;
  --vnao-btn-from:#2563eb;--vnao-btn-to:#7c3aed;
  --vnao-shadow:0 24px 72px rgba(0,0,0,.4);
  --vnao-r:18px;--vnao-r-lg:24px;
  --vnao-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnao-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vnao-content *,.vnao-content *::before,.vnao-content *::after{box-sizing:border-box;}
.vnao-content a{color:inherit;text-decoration:none;}
.vnao-content p{color:var(--vnao-muted);line-height:1.72;margin:0 0 1em;}
.vnao-content p:last-child{margin-bottom:0;}
.vnao-content h2,.vnao-content h3,.vnao-content h4{
  color:var(--vnao-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.vnao-content strong{color:var(--vnao-soft);}
.vnao-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vnao-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--vnao-muted);font-size:14.5px;line-height:1.65;
}
.vnao-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--vnao-accent);font-weight:700;
}
.vnao-content ol{margin:0 0 1em;padding-left:24px;}
.vnao-content ol li{
  color:var(--vnao-muted);font-size:14.5px;line-height:1.65;margin-bottom:.45em;
}

/* Container */
.vnao-cnt{
  width:min(var(--vnao-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.vnao-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vnao-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.vnao-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vnao-sh.vnao-left{margin-left:0;text-align:left;}
.vnao-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vnao-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vnao-sh.vnao-left p{margin-left:0;}

/* Eyebrow */
.vnao-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vnao-accent);margin-bottom:14px;
}

/* Cards */
.vnao-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--vnao-border);border-radius:var(--vnao-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.vnao-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.vnao-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vnao-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.vnao-grid-2{grid-template-columns:1fr;}}
@media(max-width:960px){.vnao-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vnao-grid-3{grid-template-columns:1fr;}}

/* KPI cards */
.vnao-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.vnao-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--vnao-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.vnao-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnao-muted);line-height:1.4;}
.vnao-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}

/* Tables */
.vnao-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vnao-table{width:100%;border-collapse:collapse;font-size:14px;}
.vnao-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--vnao-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.vnao-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--vnao-text);vertical-align:top;
}
.vnao-table tr:last-child td{border-bottom:none;}
.vnao-table tr:hover td{background:rgba(255,255,255,.03);}

/* Timeline */
.vnao-timeline{position:relative;padding-left:40px;}
.vnao-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--vnao-accent),var(--vnao-violet));
  opacity:.35;border-radius:2px;
}
.vnao-tl-item{position:relative;margin-bottom:32px;}
.vnao-tl-item:last-child{margin-bottom:0;}
.vnao-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--vnao-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.vnao-tl-item h3{font-size:17px;margin-bottom:8px;}
.vnao-tl-item p{font-size:14.5px;margin:0;}

/* Case cards */
.vnao-case-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;}
@media(max-width:768px){.vnao-case-grid{grid-template-columns:1fr;}}
.vnao-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.vnao-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.vnao-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vnao-green);margin-bottom:10px;
}
.vnao-case-card h3{font-size:16px;margin-bottom:14px;}
.vnao-metric{display:flex;align-items:baseline;gap:8px;margin-top:14px;}
.vnao-metric .num{font-size:22px;font-weight:900;color:var(--vnao-accent);flex-shrink:0;letter-spacing:-.04em;}
.vnao-metric .lbl{font-size:13px;color:var(--vnao-muted);}

/* Track cards */
.vnao-track-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;padding:20px;
}
.vnao-track-tag{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:10px;background:rgba(121,242,255,.12);color:var(--vnao-accent);
}
.vnao-track-card p{font-size:14px;margin:0;color:var(--vnao-muted);}

/* Flow */
.vnao-flow{
  display:flex;flex-wrap:wrap;align-items:center;gap:10px;
  padding:20px 24px;background:rgba(255,255,255,.04);
  border:1px solid rgba(255,255,255,.08);border-radius:14px;
  margin-top:24px;
}
.vnao-flow span{
  padding:8px 14px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.18);
  border-radius:999px;font-size:12px;font-weight:700;color:var(--vnao-accent);
}
.vnao-flow .arr{background:transparent;border:none;color:var(--vnao-muted);font-size:16px;padding:0 4px;}

/* Disclaimer */
.vnao-disclaimer{
  padding:20px 24px;border-radius:14px;
  background:rgba(245,158,11,.06);border:1px solid rgba(245,158,11,.2);
  font-size:14px;color:var(--vnao-muted);margin-bottom:32px;
}
.vnao-disclaimer strong{color:#fcd34d;}

/* Compare blocks */
.vnao-compare{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
@media(max-width:600px){.vnao-compare{grid-template-columns:1fr;}}
.vnao-compare-col{
  padding:18px;border-radius:12px;
  background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);
}
.vnao-compare-col--accent{
  background:rgba(121,242,255,.06);border-color:rgba(121,242,255,.2);
}
.vnao-compare-label{
  display:inline-block;margin-bottom:8px;
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vnao-accent);
}
.vnao-compare-col:first-child .vnao-compare-label{color:var(--vnao-muted);}

/* FAQ */
.vnao-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vnao-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.vnao-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnao-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.vnao-faq-q::after{
  content:'▾';font-size:13px;color:var(--vnao-accent);
  flex-shrink:0;transition:transform .25s;
}
.vnao-faq-item.open .vnao-faq-q::after{transform:rotate(180deg);}
.vnao-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--vnao-muted);line-height:1.72;
}
.vnao-faq-item.open .vnao-faq-a{max-height:600px;padding:0 24px 20px;}

/* Ordered list */
.vnao-ol{margin:0 0 1em;padding-left:20px;}
.vnao-ol li{color:var(--vnao-muted);font-size:14.5px;line-height:1.65;margin-bottom:.5em;}

/* =====================================================
   CTA BLOCKS (Artur's ym-* classes)
   ===================================================== */
.ym-cta-block{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border:1px solid rgba(121,242,255,.3);text-align:center;
}
.ym-cta-block--primary{
  background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border-color:rgba(121,242,255,.3);
}
.ym-cta-block--secondary{
  background:linear-gradient(135deg,rgba(255,255,255,.04),rgba(139,92,246,.06));
  border-color:rgba(139,92,246,.25);
}
.ym-cta-block--dual{
  background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));
  border-color:rgba(34,197,94,.3);
}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{
  font-size:clamp(20px,2.8vw,28px);font-weight:800;
  color:#fff;margin:0 0 10px;
}
.ym-cta-block__sub{
  color:var(--vnao-muted);font-size:15px;
  margin:0 auto 22px;max-width:600px;line-height:1.7;
}
.ym-cta-block__sub a{color:var(--vnao-accent);text-decoration:underline;}
.ym-cta-block__sub a:hover{color:#fff;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{
  display:inline-flex;align-items:center;justify-content:center;
  padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;
  text-decoration:none!important;transition:transform .2s,box-shadow .2s;
}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,
.nero-ai-home-page .ym-btn--accent{
  background:linear-gradient(135deg,var(--vnao-btn-from),var(--vnao-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(59,130,246,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--vnao-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(121,242,255,.4);background:rgba(59,130,246,.12);}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* link accent */
.ym-link--accent{color:var(--vnao-accent)!important;text-decoration:underline;}
.ym-link--accent:hover{color:#fff!important;}

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

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-onboarding-page" role="main" tabindex="-1">

<!-- ===== HERO АЛИНЫ (с canvas, не модифицировать) ===== -->
<section class="nero-ai-hero vna-onboarding-hero" id="hero" aria-labelledby="hero-onboarding-title">
<style>
.vna-onboarding-hero {
  --nero-ai-bg: #060812;
  --nero-ai-primary: #79f2ff;
  --nero-ai-muted: #9aa8bd;
  --nero-ai-soft: #c7d2e5;
  --nero-ai-heading: #ffffff;
  --nero-ai-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  --nero-ai-container: 1220px;
  position: relative;
  min-height: min(920px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(108px, 14vh, 148px) 0 clamp(64px, 8vw, 80px);
  isolation: isolate;
  color: var(--nero-ai-soft);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  background:
    radial-gradient(circle at 12% 7%, rgba(121, 242, 255, 0.14), transparent 28rem),
    radial-gradient(circle at 86% 12%, rgba(139, 92, 246, 0.18), transparent 34rem),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.vna-onboarding-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 45% 30%, #000 0%, transparent 72%);
  opacity: .5;
  pointer-events: none;
  z-index: 0;
}
.vna-onboarding-hero .nero-ai-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vna-onboarding-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(340px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vna-onboarding-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--nero-ai-primary) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vna-onboarding-hero h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(40px, 6.5vw, 82px);
  line-height: .92;
  letter-spacing: -0.06em;
  color: var(--nero-ai-heading);
  font-weight: 900;
}
.vna-onboarding-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, var(--nero-ai-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vna-onboarding-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--nero-ai-soft) !important;
  font-size: clamp(17px, 2vw, 21px);
  line-height: 1.58;
}
.vna-onboarding-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 24px 0 0;
  padding: 0;
  list-style: none;
}
.vna-onboarding-hero .nero-ai-badge {
  display: inline-flex;
  padding: 8px 12px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.vna-onboarding-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 32px;
}
.vna-onboarding-hero .nero-ai-btn {
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
.vna-onboarding-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.vna-onboarding-hero .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--nero-ai-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vna-onboarding-hero .nero-ai-btn-secondary {
  color: var(--nero-ai-soft) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vna-onboarding-hero .nero-ai-dashboard {
  position: relative;
  padding: 16px;
  border-radius: 32px;
  background: rgba(2, 6, 23, 0.42);
  border: 1px solid rgba(255,255,255,.1);
  box-shadow: var(--nero-ai-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(1.5deg);
}
.vna-onboarding-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 24px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vna-onboarding-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 12px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.vna-onboarding-hero .nero-ai-dots { display: flex; gap: 7px; }
.vna-onboarding-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vna-onboarding-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vna-onboarding-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vna-onboarding-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.vna-onboarding-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vna-onboarding-hero .nero-ai-window-body { padding: 16px; }
.vna-onboarding-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.vna-onboarding-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  color: #fff;
  letter-spacing: -0.03em;
}
.vna-onboarding-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.1);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
}
.vna-onboarding-hero .nero-ai-live-pill::before {
  content: "";
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #22c55e;
  animation: vnaPulse 1.6s infinite;
}
@keyframes vnaPulse { 0%,100%{opacity:1} 50%{opacity:.35} }
.vna-onboarding-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
}
.vna-onboarding-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 14px;
  background: rgba(255,255,255,.05);
}
.vna-onboarding-hero .nero-ai-metric span {
  display: block;
  color: var(--nero-ai-muted);
  font-size: 11px;
  font-weight: 700;
}
.vna-onboarding-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 20px;
  line-height: 1;
}
.vna-onboarding-hero .nero-ai-metric small {
  display: block;
  margin-top: 3px;
  color: #64748b;
  font-size: 10px;
}
.vna-onboarding-hero .vna-onboarding-canvas-wrap {
  margin: 12px 0;
  border: 1px solid rgba(121,242,255,.12);
  border-radius: 14px;
  background: rgba(0,0,0,.25);
  overflow: hidden;
  height: 168px;
}
.vna-onboarding-hero #vna-onboarding-canvas {
  display: block;
  width: 100%;
  height: 168px;
}
.vna-onboarding-hero .nero-ai-task-stream {
  margin-top: 10px;
  display: grid;
  gap: 8px;
}
.vna-onboarding-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 8px;
  padding: 9px 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 12px;
  background: rgba(255,255,255,.04);
  font-size: 12px;
}
.vna-onboarding-hero .nero-ai-task-icon {
  width: 28px;
  height: 28px;
  display: grid;
  place-items: center;
  border-radius: 8px;
  background: rgba(121,242,255,.12);
  color: var(--nero-ai-primary);
  font-size: 10px;
  font-weight: 800;
}
.vna-onboarding-hero .nero-ai-task strong {
  display: block;
  color: #e2e8f0;
  font-size: 12px;
}
.vna-onboarding-hero .nero-ai-task span:not(.nero-ai-task-icon):not(.nero-ai-status) {
  color: #64748b;
  font-size: 11px;
}
.vna-onboarding-hero .nero-ai-status {
  padding: 3px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #86efac;
  font-size: 10px;
  font-weight: 700;
}
.vna-onboarding-hero .nero-ai-status--warn {
  background: rgba(245,158,11,.12);
  color: #fcd34d;
}
.vna-onboarding-hero .nero-ai-status--new {
  background: rgba(121,242,255,.12);
  color: #79f2ff;
}
@media (max-width: 1100px) {
  .vna-onboarding-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vna-onboarding-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 820px) {
  .vna-onboarding-hero { min-height: auto; padding-top: 88px; }
  .vna-onboarding-hero .nero-ai-btn { width: 100%; }
  .vna-onboarding-hero .nero-ai-metrics-grid { grid-template-columns: 1fr; }
}
@media (prefers-reduced-motion: reduce) {
  .vna-onboarding-hero * { animation: none !important; transition: none !important; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai onboarding</p>
      <h1 id="hero-onboarding-title">AI-онбординг клиентов после покупки: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Клиент оплатил, но не доходит до результата? AI ведёт его по сценарию после покупки — повышаем доходимость, удержание и снижаем нагрузку на поддержку</p>
      <ul class="nero-ai-badges" aria-label="Ключевые направления">
        <li class="nero-ai-badge">Post-sale</li>
        <li class="nero-ai-badge">SaaS</li>
        <li class="nero-ai-badge">Edtech</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">Telegram</li>
        <li class="nero-ai-badge">Customer Success</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Построить AI-онбординг</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#karta-onboarding">Карта онбординга</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо post-sale AI-онбординга">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">post-sale · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-онбординг post-sale · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Доходимость</span><strong>61%</strong><small>completion rate</small></div>
            <div class="nero-ai-metric"><span>TTFV</span><strong>9 дн.</strong><small>time-to-value</small></div>
            <div class="nero-ai-metric"><span>Activation</span><strong>71%</strong><small>core action</small></div>
            <div class="nero-ai-metric"><span>Эскалации</span><strong>−63%</strong><small>нагрузка CSM</small></div>
          </div>
          <div class="vna-onboarding-canvas-wrap" aria-hidden="true">
            <canvas id="vna-onboarding-canvas" width="480" height="168"></canvas>
          </div>
          <div class="nero-ai-task-stream" aria-label="Поток post-sale онбординга">
            <div class="nero-ai-task"><span class="nero-ai-task-icon">₽</span><div><strong>Оплата в CRM</strong><span>webhook · статус «оплачено»</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Welcome AI</strong><span>квалификация · чеклист</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">✓</span><div><strong>Первый результат</strong><span>activation event</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">D+3</span><div><strong>Напоминание</strong><span>неактивность 72 ч</span></div><span class="nero-ai-status nero-ai-status--warn">отправлено</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">CSM</span><div><strong>Эскалация CSM</strong><span>контекст диалога</span></div><span class="nero-ai-status nero-ai-status--new">новое</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /HERO -->

<!-- ===== КОНТЕНТ БОРИСА (секции статьи + canvas) ===== -->
<div class="vnao-content" id="vnao-article-body">

  <!-- ===== СЕКЦИЯ 1: ПРОБЛЕМА ===== -->
  <section class="vnao-section" id="problema">
    <div class="vnao-cnt">
      <div class="vnao-sh vnao-left nero-ai-reveal">
        <span class="vnao-eyebrow">Post-sale · боль</span>
        <h2>Почему клиенты не доходят до результата после оплаты</h2>
        <p>Оплата — не финал сделки. Это начало критического окна, в котором клиент решает: продукт работает или он зря потратил деньги. По отраслевым бенчмаркам, 60–70% оттока в SaaS приходится на первые 30 дней после покупки. В онлайн-школах доходимость курсов редко превышает 40–55%. В сервисных компаниях клиент «застревает» на этапе брифа и не получает первый результат неделями.</p>
        <p><strong>Проблема не в качестве продукта. Проблема — в разрыве между оплатой и первым успехом.</strong></p>
      </div>

      <div class="vnao-grid-3 nero-ai-reveal" aria-label="KPI боли post-sale">
        <div class="vnao-kpi-card">
          <div class="kv">60–70%</div>
          <div class="kl">churn SaaS в первые 30 дней</div>
          <div class="ks">отраслевые бенчмарки</div>
        </div>
        <div class="vnao-kpi-card">
          <div class="kv">38–55%</div>
          <div class="kl">доходимость edtech</div>
          <div class="ks">норма 55–70%</div>
        </div>
        <div class="vnao-kpi-card">
          <div class="kv">4:600</div>
          <div class="kl">CSM на клиентов</div>
          <div class="ks">типичный B2B SaaS</div>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;font-size:15px">Разрыв между оплатой и первым результатом часто начинается в CRM: сделка закрыта, а статус «новый клиент» никто не обрабатывает. Если post-sale уже завязан на amoCRM, логично смотреть <a href="/vnedrenie-ai-amocrm/" style="color:var(--vnao-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a> — webhook на «оплачено» запускает welcome-сценарий без ручного перевода лида в задачу поддержки.</p>
      <p class="nero-ai-reveal" style="margin-top:16px;font-size:15px">Масштабирование AI-онбординга на сотни менеджеров — не только продуктовая задача: KPMG выкатила Claude на 276&nbsp;000 сотрудников, и там же видны типичные блокеры — governance, обучение, контроль качества ответов. Обзор <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--vnao-accent);text-decoration:underline;text-underline-offset:3px">уроков массового внедрения AI в крупной компании</a> пригодится, если вы планируете пилот на 50+ CSM одновременно.</p>

      <div class="vnao-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="vnao-card">
          <h3>Типичные точки отвала в SaaS, онлайн-школах и сервисах</h3>
          <ul>
            <li><strong>SaaS:</strong> пользователь зарегистрировался, но не настроил интеграцию, не загрузил данные, не увидел первый отчёт. Activation rate типичного B2B-продукта — 25–40% (Perspective AI, 2026).</li>
            <li><strong>Онлайн-школы:</strong> студент оплатил курс, прошёл 1–2 урока — и пропал. Куратор не успевает дотянуться до каждого. Доходимость флагманов опускается до 38% при норме 55–70% (AiBotManager).</li>
            <li><strong>Сервисные услуги:</strong> клиент заплатил, но не отправил бриф, не подключил доступы, не ответил на уточнения. Проект простаивает, уходит время и доверие.</li>
          </ul>
          <p>Общий паттерн: клиент не понимает «с чего начать», и чем дольше он бездействует — тем выше вероятность churn или refund.</p>
        </div>
        <div class="vnao-card">
          <h3>Скрытая цена низкой доходимости: churn, LTV и нагрузка на поддержку</h3>
          <ul>
            <li><strong>Прямые потери:</strong> churn и refund в первый месяц уничтожают маржу привлечения. AgencyDesk фиксировала 38% churn в первые 60 дней (GPTmag).</li>
            <li><strong>Деградация LTV:</strong> клиент без первого результата не продлевает подписку и не покупает допродажи.</li>
            <li><strong>Перегрузка CSM:</strong> четыре CSM на 600 клиентов — типичная ситуация; поддержка тонет в «где кнопка» и «что дальше».</li>
          </ul>
          <p>По OnRamp (150 CS-лидеров, 2026), только 36% компаний умеют связать онбординг с revenue-метриками.</p>
        </div>
      </div>

      <div class="vnao-card nero-ai-reveal" style="margin-top:24px">
        <h3>Чем AI-онбординг отличается от «писем и инструкций»</h3>
        <div class="vnao-compare">
          <div class="vnao-compare-col">
            <span class="vnao-compare-label">Классика</span>
            <p>Email-цепочки, PDF, FAQ-боты с меню — клиент читает и делает сам.</p>
          </div>
          <div class="vnao-compare-col vnao-compare-col--accent">
            <span class="vnao-compare-label">AI-онбординг</span>
            <p>Ведёт по сценарию, выполняет шаги в продукте, реагирует на бездействие, эскалирует к человеку при блокерах.</p>
          </div>
        </div>
        <p style="margin-top:16px">Ключевая формулировка из кейса AgencyDesk: «Ты — не справочник, ты — стажёр-помощник. Когда клиент спрашивает "как сделать X" — ты делаешь X». AI-агент не ссылается на документацию — он выполняет действия через function calling.</p>
      </div>
    </div>
  </section>

  <!-- ===== СЕКЦИЯ 2: ЧТО ТАКОЕ ===== -->
  <section class="vnao-section vnao-section-alt" id="chto-takoe">
    <div class="vnao-cnt">
      <div class="vnao-sh nero-ai-reveal">
        <span class="vnao-eyebrow">Определение</span>
        <h2>Что такое AI-онбординг клиентов после покупки</h2>
        <p><strong>AI-онбординг после покупки</strong> — связка AI-агента, сценариев и интеграций, которая ведёт уже оплатившего клиента от момента покупки до первого измеримого результата (activation event).</p>
      </div>

      <div class="vnao-disclaimer nero-ai-reveal" role="note">
        <strong>Не путать с HR-онбордингом.</strong> Платформы вроде Поток и Personik адаптируют <em>сотрудников</em>, а не покупателей. AI-онбординг post-sale — про клиента, который уже оплатил продукт или услугу.
      </div>

      <div class="vnao-timeline nero-ai-reveal">
        <div class="vnao-tl-item">
          <div class="vnao-tl-dot"></div>
          <h3>Сценарий post-sale: welcome → первый результат → активация</h3>
          <p><strong>Welcome (D+0):</strong> приветствие, квалификационный диалог, персональный чеклист. <strong>Первый шаг (D+0–1):</strong> AI помогает выполнить стартовое действие. <strong>Первый результат (D+1–7):</strong> aha-момент — первый отчёт, оценка, лид. <strong>Активация (D+7–14):</strong> расширение использования. <strong>Checkpoint D+14–30:</strong> NPS/CSAT, отчёт для CSM. Conversational onboarding сокращает median TTFV с 42 до 15 минут (−64%, Perspective AI, 2026).</p>
        </div>
        <div class="vnao-tl-item">
          <div class="vnao-tl-dot"></div>
          <h3>AI-подсказки, напоминания и эскалация в поддержку</h3>
          <p><strong>Подсказки:</strong> in-app по триггерам. <strong>Напоминания:</strong> при неактивности 48–72 ч — персональное сообщение с конкретным шагом. <strong>Эскалация:</strong> при 2+ неудачах — передача CSM с полным контекстом. В AgencyDesk проактивные D+3/D+7/D+30 снизили нагрузку на CSM на 63%.</p>
        </div>
      </div>

      <div class="vnao-table-wrap nero-ai-reveal" style="margin-top:40px">
        <table class="vnao-table" aria-label="Сегменты ЦА и activation event">
          <thead>
            <tr><th>Сегмент</th><th>Боль</th><th>Activation event</th></tr>
          </thead>
          <tbody>
            <tr><td><strong>SaaS</strong></td><td>Не настроил продукт, не увидел value</td><td>Первый отчёт / первая интеграция</td></tr>
            <tr><td><strong>Онлайн-школы</strong></td><td>Бросает после 1–2 уроков</td><td>Первый выполненный урок / ДЗ</td></tr>
            <tr><td><strong>Сервисные услуги</strong></td><td>Не отправил бриф, проект простаивает</td><td>Заполненный бриф / старт работ</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ===== СЕКЦИЯ 3: КАК РАБОТАЕТ ===== -->
  <section class="vnao-section" id="kak-rabotaet">
    <div class="vnao-cnt">
      <div class="vnao-sh nero-ai-reveal">
        <span class="vnao-eyebrow">Сценарий</span>
        <h2>Как работает AI-сценарий: от оплаты до первого результата</h2>
        <p>Триггер в CRM/LMS → сегментация → персональный чеклист → agent actions → мониторинг неактивности → эскалация или checkpoint.</p>
      </div>

      <div class="vnao-flow nero-ai-reveal" aria-label="Поток post-sale онбординга">
        <span>Оплата в CRM</span><span class="arr">→</span>
        <span>Welcome AI</span><span class="arr">→</span>
        <span>Первый шаг</span><span class="arr">→</span>
        <span>Первый результат</span><span class="arr">→</span>
        <span>Activation</span><span class="arr">→</span>
        <span>Checkpoint D+7</span>
      </div>
    </div>

    <!-- ===== БОРИС: визуальный блок (canvas) ===== -->
    <section id="vnedrenie-ai-onboarding-boris-block" class="vnao-b-root" aria-label="Анимация: путь клиента от оплаты до первого результата и эскалации в CSM">
      <style>
      #vnedrenie-ai-onboarding-boris-block.vnao-b-root{
        padding:56px 0 64px;
        background:#f8fafc;
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-cnt{
        max-width:1160px;
        margin:0 auto;
        padding:0 24px;
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-card{
        display:grid;
        grid-template-columns:minmax(0,42%) minmax(0,58%);
        border-radius:22px;
        overflow:hidden;
        background:#fff;
        box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
        min-height:480px;
      }
      @media(max-width:1023px){
        #vnedrenie-ai-onboarding-boris-block .vnao-b-card{
          grid-template-columns:1fr;
          min-height:auto;
        }
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-lft{
        padding:40px 36px;
        display:flex;
        flex-direction:column;
        justify-content:center;
        border-right:1px solid #e2e8f0;
      }
      @media(max-width:1023px){
        #vnedrenie-ai-onboarding-boris-block .vnao-b-lft{
          border-right:none;
          border-bottom:1px solid #e2e8f0;
          padding:32px 24px;
        }
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-ey{
        display:inline-flex;align-items:center;gap:8px;
        font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
        color:#0ea5e9;margin:0 0 14px;
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-ey::before{
        content:'';width:18px;height:2px;background:#0ea5e9;border-radius:1px;
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-h3{
        font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;
        line-height:1.28;margin:0 0 18px;
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-ul{
        list-style:none;margin:0 0 22px;padding:0;
        display:flex;flex-direction:column;gap:9px;
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-ul li{
        display:flex;align-items:flex-start;gap:10px;
        font-size:14px;line-height:1.5;color:#334155;
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-ul li::before{content:none;}
      #vnedrenie-ai-onboarding-boris-block .vnao-b-ic{
        flex-shrink:0;width:22px;height:22px;border-radius:50%;
        background:rgba(14,165,233,.1);display:flex;align-items:center;justify-content:center;
        font-size:11px;color:#0284c7;margin-top:1px;font-style:normal;
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-pills{
        display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-pl{
        padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
      #vnedrenie-ai-onboarding-boris-block .vnao-b-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
      #vnedrenie-ai-onboarding-boris-block .vnao-b-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
      #vnedrenie-ai-onboarding-boris-block .vnao-b-foot{
        font-size:13px;color:#64748b;font-style:italic;margin:0;
      }
      #vnedrenie-ai-onboarding-boris-block .vnao-b-rgt{
        position:relative;
        background:linear-gradient(135deg,#f0fdf4 0%,#e0f2fe 45%,#faf5ff 100%);
        min-height:420px;overflow:hidden;
      }
      @media(max-width:1023px){
        #vnedrenie-ai-onboarding-boris-block .vnao-b-rgt{min-height:360px;}
      }
      #vnao-onboarding-path-canvas{
        position:absolute;inset:0;width:100%;height:100%;display:block;
      }
      </style>

      <div class="vnao-b-cnt">
        <div class="vnao-b-card">
          <div class="vnao-b-lft">
            <span class="vnao-b-ey">Путь клиента · live</span>
            <h3 class="vnao-b-h3">От оплаты до activation event — AI ведёт, человек подключается вовремя</h3>
            <ul class="vnao-b-ul">
              <li><span class="vnao-b-ic">₽</span>Webhook из CRM/LMS запускает welcome-сценарий в Telegram или in-app</li>
              <li><span class="vnao-b-ic">✓</span>Agent actions: создать проект, назначить урок, заполнить бриф — не «инструкция», а действие</li>
              <li><span class="vnao-b-ic">⏱</span>При паузе 48–72 ч — персональное напоминание с конкретным следующим шагом</li>
              <li><span class="vnao-b-ic">↑</span>2+ блокера — эскалация CSM с полной историей диалога</li>
            </ul>
            <div class="vnao-b-pills">
              <span class="vnao-b-pl vnao-b-pl-g">TTFV −64%</span>
              <span class="vnao-b-pl vnao-b-pl-b">activation +27 п.п.</span>
              <span class="vnao-b-pl vnao-b-pl-v">CSM −63%</span>
            </div>
            <p class="vnao-b-foot">Дальше — карта онбординга по трём трекам и лид-магнит ↓</p>
          </div>
          <div class="vnao-b-rgt">
            <canvas id="vnao-onboarding-path-canvas" role="img" aria-label="Анимация: клиент проходит этапы post-sale онбординга от оплаты до activation и эскалации в CSM"></canvas>
          </div>
        </div>
      </div>
    </section>
    <!-- /БОРИС -->

    <div class="vnao-cnt">
      <div class="vnao-sh vnao-left nero-ai-reveal" style="margin-top:48px">
        <h3>In-app подсказки и персональные ветки сценария</h3>
        <p>AI не ведёт всех по одному маршруту. На основе CRM (роль, тариф, цель) и поведения в продукте формируются ветки: новичок с базовым тарифом — минимальный путь; enterprise — расширенный онбординг; возвращённый — пропуск пройденных шагов. Кейс Leadl: вместо 7 шагов в рекламе — 3–4 вопроса AI → aha-момент (zamesin.ru).</p>
      </div>

      <div class="vnao-card nero-ai-reveal">
        <h3>Автоматизация через AI onboarding без перегруза команды</h3>
        <p>По OnRamp (2026), 88% компаний с AI в онбординге масштабируют процесс без расширения команды.</p>
        <ul>
          <li><strong>Оркестратор (Make/n8n/FastAPI):</strong> маршрутизация триггеров, логика ветвлений</li>
          <li><strong>LLM-агент:</strong> диалог, function calling, персональные рекомендации</li>
          <li><strong>RAG-база знаний:</strong> FAQ, инструкции — с версионированием</li>
          <li><strong>Agent actions:</strong> создание проекта, импорт CSV, назначение урока, обновление CRM</li>
          <li><strong>Аналитика:</strong> PostHog/Amplitude — TTFV, completion rate</li>
        </ul>
      </div>

      <div class="vnao-sh vnao-left nero-ai-reveal" style="margin-top:48px" id="karta-onboarding">
        <h3>Пошаговая карта онбординга</h3>
        <p>Карта онбординга — пошаговый сценарий от оплаты до activation event. Для каждого сегмента ЦА она выглядит по-разному:</p>
      </div>

      <div class="vnao-grid-3 nero-ai-reveal" aria-label="Три трека онбординга">
        <div class="vnao-track-card">
          <span class="vnao-track-tag">SaaS</span>
          <p>Оплата → welcome → AI создаёт проект → импорт данных → первый отчёт за 15 мин → интеграция → checkpoint</p>
        </div>
        <div class="vnao-track-card">
          <span class="vnao-track-tag">Edtech</span>
          <p>Оплата курса → AI-тьютор в Telegram → первый урок + микро-практика → проверка ДЗ → напоминание при паузе → еженедельный фидбэк</p>
        </div>
        <div class="vnao-track-card">
          <span class="vnao-track-tag">Услуги</span>
          <p>Оплата → AI помогает заполнить бриф → уточняющие вопросы → передача менеджеру с контекстом → контроль дедлайнов</p>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:20px;font-size:15px">Артефакт «<strong>Карта онбординга клиента</strong>» — визуальная схема для каждого сегмента, адаптируемая под конкретный продукт на диагностике.</p>

      <!-- CTA-1: лид-магнит -->
      <aside class="ym-cta-block ym-cta-block--primary" id="cta-karta">
        <div class="ym-cta-block__icon" aria-hidden="true">🗺️</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Карта онбординга клиента</p>
          <p class="ym-cta-block__sub">Пошаговая схема post-sale для SaaS, онлайн-школы и сервиса: welcome → первый результат → activation → checkpoint D+7 → эскалация в поддержку. Адаптируем под ваш продукт на диагностике — бесплатно.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить карту онбординга</a>
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost"<?php echo $primary_cta_attrs; ?>>Построить AI-онбординг</a>
          </div>
        </div>
      </aside>
    </div>
  </section>

  <!-- ===== СЕКЦИЯ 4: ВНЕДРЕНИЕ ===== -->
  <section class="vnao-section vnao-section-alt" id="vnedrenie">
    <div class="vnao-cnt">
      <div class="vnao-sh nero-ai-reveal">
        <span class="vnao-eyebrow">Под ключ</span>
        <h2>Внедрение AI onboarding под ключ для бизнеса</h2>
        <p>Проектная работа под специфику продукта, ЦА и текущих процессов — не коробочное решение.</p>
      </div>

      <div class="vnao-grid-2 nero-ai-reveal">
        <div class="vnao-card">
          <h3>Разработка и настройка AI onboarding под ваш продукт</h3>
          <ul>
            <li>Аудит воронки post-sale: от оплаты до первого результата</li>
            <li>Выгрузка 30–50 типовых вопросов и блокеров из чатов поддержки</li>
            <li>Определение activation event — момента первого value</li>
            <li>Проектирование сценариев по сегментам</li>
            <li>Настройка промптов, RAG-базы, agent actions</li>
            <li>Тестирование на пилотной группе</li>
          </ul>
        </div>
        <div class="vnao-card">
          <h3>Интеграция AI onboarding с CRM, LMS, чатом и email</h3>
          <div class="vnao-table-wrap">
            <table class="vnao-table" aria-label="Интеграции">
              <thead><tr><th>Категория</th><th>Инструменты</th></tr></thead>
              <tbody>
                <tr><td>CRM</td><td>amoCRM, Bitrix24, RetailCRM, HubSpot</td></tr>
                <tr><td>LMS / edtech</td><td>GetCourse, Антитренинги, собственные LMS</td></tr>
                <tr><td>In-app</td><td>Carrot quest, собственный виджет, Product Fruits</td></tr>
                <tr><td>Мессенджеры</td><td>Telegram, MAX, VK, WhatsApp Business</td></tr>
                <tr><td>AI-модели</td><td>YandexGPT, GigaChat (ПДн), Claude/GPT (логика)</td></tr>
                <tr><td>Автоматизация</td><td>Make, n8n, FastAPI backend</td></tr>
              </tbody>
            </table>
          </div>
          <p style="margin-top:14px;font-size:14px">152-ФЗ: гибридная модель — зарубежная LLM для обезличенной логики, GigaChat/YandexGPT для текстов с ПДн.</p>
        </div>
      </div>

      <div class="vnao-timeline nero-ai-reveal" style="margin-top:40px">
        <div class="vnao-tl-item">
          <div class="vnao-tl-dot"></div>
          <h3>Фаза 1 — Диагностика (3–5 дней)</h3>
          <p>Аудит воронки post-sale, карта «оплата → первый результат», анализ 50–100 диалогов поддержки, определение activation event и aha-момента.</p>
        </div>
        <div class="vnao-tl-item">
          <div class="vnao-tl-dot"></div>
          <h3>Фаза 2 — Сценарий (5–7 дней)</h3>
          <p>Карта онбординга по сегментам: welcome → первый шаг → первый результат → активация → checkpoint D+7 → эскалация.</p>
        </div>
        <div class="vnao-tl-item">
          <div class="vnao-tl-dot"></div>
          <h3>Фаза 3 — MVP (2–3 недели)</h3>
          <p>AI-агент в 1–2 каналах + CRM/LMS webhook + RAG по 20–50 статьям + 3–5 agent actions.</p>
        </div>
        <div class="vnao-tl-item">
          <div class="vnao-tl-dot"></div>
          <h3>Фаза 4 — Пилот (2 недели)</h3>
          <p>50–200 новых клиентов, A/B vs текущий онбординг, дашборд метрик в реальном времени.</p>
        </div>
        <div class="vnao-tl-item">
          <div class="vnao-tl-dot"></div>
          <h3>Фаза 5 — Масштабирование</h3>
          <p>Проактивные триггеры, предиктивные churn-флаги, доработка промптов по логам раз в 2 недели. Общий срок до пилота — 4–6 недель.</p>
        </div>
      </div>

      <!-- CTA-2: обучение -->
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понять AI до старта проекта?</p>
          <p class="ym-cta-block__sub">Если customer success или продукт хотят разобраться в промптах, сценариях Make/n8n и human-in-the-loop до пилота — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#'); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'); ?></a>. Это ускоряет согласование activation event и интеграций с CRM.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- ===== СЕКЦИЯ 5: РЕЗУЛЬТАТЫ ===== -->
  <section class="vnao-section" id="rezultaty">
    <div class="vnao-cnt">
      <div class="vnao-sh nero-ai-reveal">
        <span class="vnao-eyebrow">Метрики</span>
        <h2>Результаты внедрения: доходимость, удержание, customer success</h2>
        <p>Опубликованные кейсы дают ориентиры (результаты зависят от baseline, продукта и качества базы знаний).</p>
      </div>

      <div class="vnao-table-wrap nero-ai-reveal">
        <table class="vnao-table" aria-label="Метрики до и после AI-онбординга">
          <thead>
            <tr><th>Метрика</th><th>До</th><th>После</th><th>Источник</th></tr>
          </thead>
          <tbody>
            <tr><td>Churn 60 дней</td><td>38%</td><td>25%</td><td>AgencyDesk (GPTmag)</td></tr>
            <tr><td>Time-to-value</td><td>21 день</td><td>9 дней</td><td>AgencyDesk (GPTmag)</td></tr>
            <tr><td>Activation rate</td><td>42%</td><td>71%</td><td>AgencyDesk (GPTmag)</td></tr>
            <tr><td>Доходимость курса</td><td>38%</td><td>61%</td><td>AiBotManager (edtech)</td></tr>
            <tr><td>Отток 30 дней (edtech)</td><td>22%</td><td>14%</td><td>EngFlow (GPTmag)</td></tr>
            <tr><td>Retention 6 месяцев</td><td>38%</td><td>58%</td><td>EngFlow (GPTmag)</td></tr>
            <tr><td>NPS</td><td>41</td><td>64</td><td>EngFlow (GPTmag)</td></tr>
            <tr><td>Самостоятельные активации</td><td>2%</td><td>15% (×7,5)</td><td>Leadl (zamesin.ru)</td></tr>
            <tr><td>Resolution rate (AI-агент)</td><td>—</td><td>67%</td><td>Intercom Fin (2026)</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;font-size:15px">Снижение нагрузки на CSM частично идёт из входящего потока: пока клиент не дошёл до activation, в поддержку приходят письма «что дальше?». Автоматизация на стороне CRM — <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--vnao-accent);text-decoration:underline;text-underline-offset:3px">AI-обработка входящей почты в CRM</a> — разгружает очередь и не смешивает pre-sale заявки с post-sale эскалациями.</p>
      <p class="nero-ai-reveal" style="margin-top:16px;font-size:15px">В B2B SaaS с учётным контуром 1С онбординг не ограничивается чатом: нужны счета, акты, статусы заказов. Смежный сценарий — <a href="/ai-1c-erp/" style="color:var(--vnao-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP</a>: те же webhook-триггеры, но фокус на синхронизации сделки и документооборота после оплаты.</p>

      <div class="vnao-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="vnao-card">
          <h3>AI customer success: снижение нагрузки на поддержку</h3>
          <ul>
            <li>78% типовых обращений закрываются без оператора (AiBotManager, e-com)</li>
            <li>Нагрузка на CSM снижается на 50–63% (AgencyDesk, sales-ai.tech)</li>
            <li>Эскалации идут с полным контекстом: история шагов, блокер, классификация</li>
          </ul>
          <p>89% CS-лидеров фиксируют снижение трения при AI-онбординге (OnRamp, 2026).</p>
        </div>
        <div class="vnao-card">
          <h3>AI удержание клиента и рост LTV</h3>
          <ul>
            <li>Снижение раннего churn: value в первую неделю → продление в 2–3 раза чаще</li>
            <li>Рост допродаж: активация → старший тариф, команда, модули</li>
            <li>Рекомендации: NPS +15–25 п.п. (EngFlow: 41→64)</li>
          </ul>
          <p>EngFlow: MRR 5,2→6,9 млн ₽ за 5 месяцев (+33%, GPTmag).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== СЕКЦИЯ 6: КЕЙСЫ ===== -->
  <section class="vnao-section vnao-section-alt" id="keisy">
    <div class="vnao-cnt">
      <div class="vnao-sh nero-ai-reveal">
        <span class="vnao-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI onboarding</h2>
      </div>

      <div class="vnao-case-grid">
        <div class="vnao-case-card nero-ai-reveal">
          <div class="vnao-case-tag">SaaS · B2B</div>
          <h3>AgencyDesk</h3>
          <p>In-app AI-аватар с контекстной памятью. Function calling: проекты, импорт amoCRM. D+3/D+7/D+30. Churn 38%→25%, TTV 21→9 дн., activation 42%→71% (GPTmag).</p>
          <div class="vnao-metric"><span class="num">−63%</span><span class="lbl">нагрузка CSM</span></div>
        </div>
        <div class="vnao-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vnao-case-tag">Edtech</div>
          <h3>EngFlow</h3>
          <p>AI-тьютор в Telegram: голосовая практика 24/7, напоминания. Отток 22%→14%, retention 6m 38%→58%, MRR +33% (GPTmag).</p>
          <div class="vnao-metric"><span class="num">NPS 64</span><span class="lbl">было 41</span></div>
        </div>
        <div class="vnao-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vnao-case-tag">Edtech</div>
          <h3>AiBotManager</h3>
          <p>AI-куратор: напоминания о ДЗ, разбор ошибок, триггеры неактивности. Доходимость 38%→61%, оборот 1,2→2,7 млн ₽/мес.</p>
          <div class="vnao-metric"><span class="num">+61%</span><span class="lbl">доходимость</span></div>
        </div>
        <div class="vnao-case-card nero-ai-reveal">
          <div class="vnao-case-tag">Методология</div>
          <h3>Leadl</h3>
          <p>AJTBD (15 интервью) → AI-сценарий вместо ручных пресейлов. 3–4 вопроса → aha-момент. Активации ×7,5, выручка +30% (zamesin.ru). Методология переносится на post-sale.</p>
          <div class="vnao-metric"><span class="num">×7,5</span><span class="lbl">самоактивации</span></div>
        </div>
      </div>

      <div class="vnao-card nero-ai-reveal" style="margin-top:32px">
        <h3>Пример внедрения AI onboarding: типовой сценарий (SaaS, 300–500 клиентов/мес)</h3>
        <ol class="vnao-ol">
          <li><strong>Неделя 1:</strong> аудит 50 диалогов, activation event (первый отчёт), 3 типовых блокера</li>
          <li><strong>Неделя 2:</strong> welcome-агент в Telegram: квалификация → чеклист → agent action «создать проект»</li>
          <li><strong>Недели 3–4:</strong> MVP Telegram + webhook amoCRM, RAG 30 статей, тест на 50 клиентах</li>
          <li><strong>Недели 5–6:</strong> пилот 200 клиентов, A/B vs email-онбординг</li>
          <li><strong>Неделя 7+:</strong> масштабирование, in-app, предиктивные триггеры</li>
        </ol>
        <p style="margin-top:14px">На пилоте: TTFV, activation rate, completion rate, эскалации, CSAT/NPS D+14, cost per onboarded user. Без baseline и A/B — «−35% churn» остаётся маркетингом.</p>
      </div>
    </div>
  </section>

  <!-- ===== СЕКЦИЯ 7: СТОИМОСТЬ ===== -->
  <section class="vnao-section" id="ceny">
    <div class="vnao-cnt">
      <div class="vnao-sh nero-ai-reveal">
        <span class="vnao-eyebrow">Бюджет</span>
        <h2>Стоимость AI-онбординга и окупаемость</h2>
        <p>Ориентировочная вилка проектов Nero Network: <strong>120–350 тыс. ₽</strong> за полный цикл от аудита до пилота.</p>
      </div>

      <div class="vnao-grid-2 nero-ai-reveal">
        <div class="vnao-card">
          <h3>От чего зависит цена ai onboarding</h3>
          <ul>
            <li>Количество сценариев и сегментов (1 трек vs 3 трека)</li>
            <li>Интеграции: amoCRM + Telegram — база; LMS + in-app + email — сложнее</li>
            <li>Agent actions: чем больше действий AI в продукте — тем выше объём</li>
            <li>RAG-база: объём документации, версионирование, модерация</li>
          </ul>
          <p>Поддержка и доработка промптов — от 25–50 тыс. ₽/мес.</p>
        </div>
        <div class="vnao-card">
          <h3>AI onboarding для малого бизнеса: когда пилот оправдан</h3>
          <ul>
            <li>Поток от 50–100 новых клиентов в месяц</li>
            <li>Измеримый activation event в продукте</li>
            <li>База знаний или скрипты поддержки для RAG</li>
            <li>Ранний churn дороже стоимости пилота</li>
          </ul>
          <p>Стартовый пилот Make/n8n + Telegram за 120–150 тыс. ₽ — метрики за 4–6 недель.</p>
        </div>
      </div>

      <div class="vnao-card nero-ai-reveal" style="margin-top:24px">
        <h3>ROI: связь доходимости с выручкой и churn</h3>
        <ul>
          <li><strong>Сохранённая выручка:</strong> churn −10–15 п.п. при чеке 5–15 тыс. ₽/мес и 300 клиентах → 150–675 тыс. ₽/мес MRR</li>
          <li><strong>Экономия на CSM:</strong> 300–500 тыс. ₽/мес на менеджера; AI снижает нагрузку на 50–63%</li>
          <li><strong>Рост LTV:</strong> активированный клиент покупает на 20–40% больше</li>
        </ul>
        <p>Окупаемость типового проекта — <strong>1,5–4 месяца</strong> при качественной базе знаний и agent actions.</p>
      </div>

      <!-- CTA-3: финал -->
      <div class="ym-cta-block ym-cta-block--dual" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы поднять доходимость после оплаты?</p>
          <p class="ym-cta-block__sub">Ориентир 120–350 тыс. ₽ за внедрение под ключ. На диагностике определим activation event, соберём карту онбординга и запустим пилот за 4–6 недель.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Построить AI-онбординг</a>
            <a href="#vnedrenie" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== СЕКЦИЯ 8: FAQ ===== -->
  <section class="vnao-section vnao-section-alt" id="faq">
    <div class="vnao-cnt">
      <div class="vnao-sh nero-ai-reveal">
        <span class="vnao-eyebrow">Вопрос — ответ</span>
        <h2>FAQ — как внедрить AI onboarding</h2>
      </div>

      <div class="vnao-faq nero-ai-reveal">
        <div class="vnao-faq-item">
          <div class="vnao-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai onboarding в существующий продукт</div>
          <div class="vnao-faq-a"><p>Начинается с диагностики: аудит воронки post-sale, activation event, анализ диалогов поддержки. AI-онбординг работает поверх инфраструктуры через webhook-интеграции с CRM, LMS и мессенджерами. Минимальный стек: Make/n8n + LLM-агент + Telegram-бот + webhook из CRM при смене статуса сделки.</p></div>
        </div>
        <div class="vnao-faq-item">
          <div class="vnao-faq-q" tabindex="0" role="button" aria-expanded="false">Интеграция ai onboarding с CRM: что нужно на старте</div>
          <div class="vnao-faq-a"><p>Webhook на «оплата прошла», поля: имя, тариф, email, Telegram, дата оплаты. API-токен для обновления статусов и задач. 30–50 статей базы знаний для RAG. Подключение — 2–5 дней на этапе MVP.</p></div>
        </div>
        <div class="vnao-faq-item">
          <div class="vnao-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько длится настройка ai onboarding</div>
          <div class="vnao-faq-a"><p>Полный цикл до пилота — 4–6 недель: диагностика 3–5 дней, сценарии 5–7 дней, MVP 2–3 недели, пилот 2 недели. Масштабирование — ещё 2–4 недели на каналы и agent actions.</p></div>
        </div>
        <div class="vnao-faq-item">
          <div class="vnao-faq-q" tabindex="0" role="button" aria-expanded="false">Чем AI-онбординг дополняет классический customer success</div>
          <div class="vnao-faq-a"><p>AI берёт типовые вопросы, напоминания, первичные шаги, мониторинг активности. Человек получает сложные переговоры, эмоциональные кейсы, enterprise-сопровождение — с полным контекстом диалога и классификацией блокера.</p></div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.vnao-content -->

<?php
$vnao_page_url = trailingslashit( get_permalink() );
$vnao_site_url = trailingslashit( home_url( '/' ) );
$vnao_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$vnao_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $vnao_site_url . '#organization',
      'name'  => $vnao_brand,
      'url'   => $vnao_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $vnao_site_url . '#website',
      'url'       => $vnao_site_url,
      'name'      => $vnao_brand,
      'publisher' => [ '@id' => $vnao_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $vnao_page_url . '#webpage',
      'url'         => $vnao_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $vnao_site_url . '#website' ],
      'about'       => [ '@id' => $vnao_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $vnao_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vnao_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vnao_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $vnao_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $vnao_page_url,
      'provider'    => [ '@id' => $vnao_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $vnao_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить ai onboarding в существующий продукт', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Начинается с диагностики: аудит воронки post-sale, activation event, анализ диалогов поддержки. AI-онбординг работает поверх инфраструктуры через webhook-интеграции с CRM, LMS и мессенджерами. Минимальный стек: Make/n8n + LLM-агент + Telegram-бот + webhook из CRM при смене статуса сделки.' ] ],
        [ '@type' => 'Question', 'name' => 'Интеграция ai onboarding с CRM: что нужно на старте', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Webhook на «оплата прошла», поля: имя, тариф, email, Telegram, дата оплаты. API-токен для обновления статусов и задач. 30–50 статей базы знаний для RAG. Подключение — 2–5 дней на этапе MVP.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько длится настройка ai onboarding', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Полный цикл до пилота — 4–6 недель: диагностика 3–5 дней, сценарии 5–7 дней, MVP 2–3 недели, пилот 2 недели. Масштабирование — ещё 2–4 недели на каналы и agent actions.' ] ],
        [ '@type' => 'Question', 'name' => 'Чем AI-онбординг дополняет классический customer success', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'AI берёт типовые вопросы, напоминания, первичные шаги, мониторинг активности. Человек получает сложные переговоры, эмоциональные кейсы, enterprise-сопровождение — с полным контекстом диалога и классификацией блокера.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vnao_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
?>
</main>

<!-- ===== HERO CANVAS ENGINE (Алина) ===== -->
<script id="vna-onboarding-engine">
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("vna-onboarding-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");
  let cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    const wrap = canvas.parentElement;
    if (!wrap) return;
    cw = wrap.clientWidth || 480;
    ch = wrap.clientHeight || 168;
    canvas.width = cw;
    canvas.height = ch;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 520, ch / 200) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  const C = {
    outline: "#94a3b8",
    hubBg: "#0f172a",
    hubBorder: "#79f2ff",
    stream: "#1e3a5f",
    tokenPay: "#22c55e",
    tokenWelcome: "#3b82f6",
    tokenResult: "#a78bfa",
    beacon: "#fb7185",
    bridge: "#fbbf24",
    bubbleBg: "rgba(15,23,42,0.95)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6"
  };

  function roundRect(ctx, x, y, w, h, r, fill, stroke) {
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

  class MilestoneStream {
    constructor(x, y, h) { this.x = x; this.y = y; this.h = h; }
    draw(ctx) {
      const grad = ctx.createLinearGradient(this.x, this.y, this.x, this.y + this.h);
      grad.addColorStop(0, "rgba(59,130,246,0.15)");
      grad.addColorStop(1, "rgba(139,92,246,0.08)");
      roundRect(ctx, this.x - 18, this.y, 36, this.h, 10, grad, C.outline);
      const offset = (frame * 0.45) % (this.h + 40);
      const tokens = [
        { color: C.tokenPay, label: "₽" },
        { color: C.tokenWelcome, label: "Hi" },
        { color: C.tokenResult, label: "✓" }
      ];
      tokens.forEach((tok, i) => {
        const ty = this.y + 20 + ((offset + i * 55) % (this.h - 10));
        roundRect(ctx, this.x - 12, ty, 24, 18, 5, tok.color, C.outline);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 9px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(tok.label, this.x, ty + 12);
      });
    }
  }

  class OnboardingCommandHub {
    constructor(x, y) { this.x = x; this.y = y; this.phase = 0; }
    draw(ctx) {
      const prg = (frame * 0.035) % 260;
      this.phase = prg;
      roundRect(ctx, this.x - 70, this.y - 55, 140, 110, 10, C.hubBg, C.hubBorder);
      const steps = ["Оплата", "Welcome", "Результат", "D+7", "CSM"];
      steps.forEach((label, i) => {
        const done = prg > 20 + i * 42;
        const active = prg > 10 + i * 42 && prg < 30 + i * 42;
        roundRect(ctx, this.x - 58, this.y - 42 + i * 18, 10, 10, 3,
          done ? C.tokenPay : active ? C.hubBorder : "#334155", null);
        ctx.fillStyle = done ? "#86efac" : active ? C.hubBorder : "#64748b";
        ctx.font = "9px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(label, this.x - 42, this.y - 34 + i * 18);
      });
      if (prg > 200 && prg < 240) {
        const pulse = 0.6 + Math.sin(frame * 0.12) * 0.4;
        ctx.globalAlpha = pulse;
        roundRect(ctx, this.x - 50, this.y + 38, 100, 16, 8, "rgba(34,197,94,0.35)", C.tokenPay);
        ctx.fillStyle = "#bbf7d0";
        ctx.font = "bold 9px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("Activation ✓", this.x, this.y + 49);
        ctx.globalAlpha = 1;
      }
    }
  }

  class ChurnRiskBeacon {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(ctx) {
      const prg = (frame * 0.035) % 260;
      if (prg < 130 || prg > 195) return;
      const blink = Math.sin(frame * 0.2) * 0.3 + 0.7;
      ctx.globalAlpha = blink;
      ctx.fillStyle = C.beacon;
      ctx.beginPath();
      ctx.arc(this.x, this.y, 8, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1;
      ctx.stroke();
      ctx.globalAlpha = 1;
    }
  }

  class ReminderWaveRing {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(ctx) {
      const prg = (frame * 0.035) % 260;
      if (prg < 140 || prg > 200) return;
      const r = 12 + ((prg - 140) % 30) * 1.2;
      ctx.strokeStyle = "rgba(251,191,36,0.5)";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(this.x, this.y, r, 0, Math.PI * 2);
      ctx.stroke();
    }
  }

  class EscalationBridge {
    constructor(x1, y1, x2, y2) { this.x1 = x1; this.y1 = y1; this.x2 = x2; this.y2 = y2; }
    draw(ctx) {
      const prg = (frame * 0.035) % 260;
      if (prg < 195) return;
      const t = Math.min(1, (prg - 195) / 25);
      ctx.strokeStyle = C.bridge;
      ctx.lineWidth = 2;
      ctx.setLineDash([4, 4]);
      ctx.beginPath();
      ctx.moveTo(this.x1, this.y1);
      ctx.lineTo(this.x1 + (this.x2 - this.x1) * t, this.y1 + (this.y2 - this.y1) * t);
      ctx.stroke();
      ctx.setLineDash([]);
      if (t > 0.8) {
        roundRect(ctx, this.x2 - 14, this.y2 - 12, 28, 24, 6, C.agentPurple, C.outline);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 8px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("CSM", this.x2, this.y2 + 4);
      }
    }
  }

  class Agent {
    constructor(x, y, color, role, stepTrig, dialogs) {
      this.x = x; this.y = y; this.baseX = x; this.baseY = y;
      this.color = color; this.role = role;
      this.timer = Math.random() * 100;
      this.stepTrig = stepTrig;
      this.dialogs = dialogs;
    }
    draw(ctx) {
      this.timer += 0.04;
      const prg = (frame * 0.035) % 260;
      let isMoving = false;
      const hubX = 40;
      const hubY = -20 + this.stepTrig * 0.08;
      if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
        const local = prg - this.stepTrig;
        isMoving = local < 12 || local > 18;
        const t = local < 14 ? local / 14 : (local - 18) / 10;
        this.x = local < 14
          ? this.baseX + (hubX - this.baseX) * t
          : hubX - (hubX - this.baseX) * Math.min(1, t);
        this.y = local < 14
          ? this.baseY + (hubY - this.baseY) * t
          : hubY - (hubY - this.baseY) * Math.min(1, t);
      } else {
        this.x = this.baseX;
        this.y = this.baseY;
      }
      if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
      }
      const bob = isMoving ? Math.abs(Math.sin(this.timer * 4)) * 2 : Math.sin(this.timer * 1.2);
      ctx.save();
      ctx.translate(this.x, this.y);
      roundRect(ctx, -12, -8 - bob, 24, 16, 5, this.color, C.outline);
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(0, -18 - bob, 9, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1.5;
      ctx.stroke();
      ctx.restore();
    }
  }

  const entities = [];
  const bubbles = [];
  const stream = new MilestoneStream(-120, -70, 140);
  const hub = new OnboardingCommandHub(40, -10);
  const beacon = new ChurnRiskBeacon(95, -50);
  const wave = new ReminderWaveRing(-60, 30);
  const bridge = new EscalationBridge(70, 20, 130, -35);
  entities.push(stream, hub, beacon, wave, bridge);
  entities.push(new Agent(-150, 50, C.agentYellow, "1_architect", 18,
    ["Карта онбординга...", "Ветка SaaS готова", "Activation event найден"]));
  entities.push(new Agent(-100, -40, C.agentGreen, "2_seo", 55,
    ["Webhook из CRM!", "Статус «оплачено»", "Сегмент определён"]));
  entities.push(new Agent(-50, 60, C.agentBlue, "3_coder", 95,
    ["Создаю проект...", "Импорт CSV готов", "Первый отчёт!"]));
  entities.push(new Agent(0, -55, C.agentPink, "4_designer", 135,
    ["Подсказка in-app", "Напоминание в TG", "Персональный трек"]));
  entities.push(new Agent(50, 45, C.agentPurple, "5_deployer", 175,
    ["2 блокера — эскалация", "Бриф для CSM", "Контекст передан"]));

  function createBubble(x, y, text, life = 280) {
    bubbles.push({ x, y, text, life, maxLife: life });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);
    entities.sort((a, b) => (a.y || 0) - (b.y || 0));
    entities.forEach((e) => e.draw(ctx));

    const prg = (frame * 0.035) % 260;
    if (prg >= 8 && prg < 8.05) createBubble(-120, -50, "CRM: оплата ✓", 200);
    if (prg >= 48 && prg < 48.05) createBubble(-100, -20, "Welcome-диалог", 200);
    if (prg >= 88 && prg < 88.05) createBubble(40, -30, "Первый результат", 200);
    if (prg >= 148 && prg < 148.05) createBubble(-60, 10, "Напоминание D+3", 200);
    if (prg >= 198 && prg < 198.05) createBubble(100, -20, "→ CSM с контекстом", 220);

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (let i = bubbles.length - 1; i >= 0; i--) {
      const b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      let alpha = Math.min(1, b.life / 25);
      if (b.life > b.maxLife - 8) alpha = (b.maxLife - b.life) / 8;
      ctx.globalAlpha = alpha;
      const tw = ctx.measureText(b.text).width + 14;
      roundRect(ctx, b.x - tw / 2, b.y - 16 - (b.maxLife - b.life) * 0.04, tw, 16, 5, C.bubbleBg, C.hubBorder);
      ctx.fillStyle = "#e2e8f0";
      ctx.fillText(b.text, b.x, b.y - 7 - (b.maxLife - b.life) * 0.04);
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

<!-- ===== БОРИС CANVAS ENGINE ===== -->
<script>
(function(){
  'use strict';
  var cv = document.getElementById('vnao-onboarding-path-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0, traveler = 0;

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
    ink:'#0f172a', muted:'#64748b', line:'rgba(14,165,233,.35)',
    pay:'#22c55e', welcome:'#3b82f6', step:'#8b5cf6',
    result:'#0ea5e9', act:'#f59e0b', csm:'#ef4444',
    glow:'rgba(34,197,94,.2)', client:'#0f172a'
  };

  var NODES = [
    {id:'pay', label:'Оплата', sub:'CRM webhook', color:C.pay, x:0},
    {id:'wel', label:'Welcome', sub:'D+0', color:C.welcome, x:0},
    {id:'stp', label:'Шаг 1', sub:'agent action', color:C.step, x:0},
    {id:'res', label:'Результат', sub:'aha-момент', color:C.result, x:0},
    {id:'act', label:'Activation', sub:'D+7', color:C.act, x:0},
    {id:'csm', label:'CSM', sub:'эскалация', color:C.csm, x:0}
  ];

  function layout(){
    var pad = W * 0.08;
    var span = W - pad * 2;
    for (var i = 0; i < NODES.length; i++) {
      NODES[i].x = pad + (span / (NODES.length - 1)) * i;
    }
  }

  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle=fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  function drawNode(n, y, active, pulse){
    var r = Math.min(W,H)*0.038;
    var glow = active ? 0.35 + pulse*0.25 : 0.08;
    ctx.globalAlpha = glow;
    ctx.fillStyle = n.color;
    ctx.beginPath();
    ctx.arc(n.x, y, r*2.2, 0, Math.PI*2);
    ctx.fill();
    ctx.globalAlpha = 1;

    rr(n.x-r, y-r, r*2, r*2, r*0.4, active ? '#fff' : 'rgba(255,255,255,.9)', n.color);
    ctx.fillStyle = active ? n.color : C.muted;
    ctx.font = 'bold ' + Math.max(10,r*0.55) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    var icon = n.id==='pay'?'₽':(n.id==='csm'?'↑':'●');
    ctx.fillText(icon, n.x, y);

    ctx.fillStyle = C.ink;
    ctx.font = 'bold ' + Math.max(9,W*0.022) + 'px system-ui,sans-serif';
    ctx.textBaseline = 'alphabetic';
    ctx.fillText(n.label, n.x, y + r + 16);
    ctx.fillStyle = C.muted;
    ctx.font = Math.max(8,W*0.018) + 'px system-ui,sans-serif';
    ctx.fillText(n.sub, n.x, y + r + 30);
  }

  function tick(){
    frame++;
    traveler = (frame * 0.004) % (NODES.length - 0.01);
    var pulse = 0.5 + 0.5 * Math.sin(frame * 0.07);
    layout();

    var cy = H * 0.42;
    ctx.clearRect(0,0,W,H);

    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.textBaseline = 'alphabetic';
    ctx.fillText('Post-sale путь клиента', W*0.06, H*0.12);
    ctx.textAlign = 'right';
    ctx.fillText('activation event', W*0.94, H*0.12);

    ctx.strokeStyle = C.line;
    ctx.lineWidth = 3;
    ctx.setLineDash([]);
    ctx.beginPath();
    ctx.moveTo(NODES[0].x, cy);
    for (var j = 1; j < NODES.length; j++) ctx.lineTo(NODES[j].x, cy);
    ctx.stroke();

    var progIdx = Math.floor(traveler);
    var progT = traveler - progIdx;
    if (progIdx < NODES.length - 1) {
      var px = NODES[progIdx].x + (NODES[progIdx+1].x - NODES[progIdx].x) * progT;
      ctx.strokeStyle = C.pay;
      ctx.lineWidth = 4;
      ctx.beginPath();
      ctx.moveTo(NODES[0].x, cy);
      ctx.lineTo(px, cy);
      ctx.stroke();

      ctx.fillStyle = C.client;
      ctx.beginPath();
      ctx.arc(px, cy, 8 + pulse*3, 0, Math.PI*2);
      ctx.fill();
      ctx.strokeStyle = '#fff';
      ctx.lineWidth = 2;
      ctx.stroke();
    }

    for (var k = 0; k < NODES.length; k++) {
      drawNode(NODES[k], cy, k <= progIdx, pulse);
    }

    var tracks = [
      {label:'SaaS', color:C.result, y:H*0.72},
      {label:'Edtech', color:C.step, y:H*0.82},
      {label:'Услуги', color:C.act, y:H*0.92}
    ];
    tracks.forEach(function(tr, ti){
      rr(W*0.06, tr.y-12, W*0.88, 22, 6, 'rgba(255,255,255,.75)', tr.color);
      ctx.fillStyle = tr.color;
      ctx.font = 'bold 10px system-ui,sans-serif';
      ctx.textAlign = 'left';
      ctx.textBaseline = 'middle';
      ctx.fillText(tr.label, W*0.09, tr.y+4);
      var fillW = (W*0.55) * (0.3 + 0.7 * ((frame*0.01 + ti*0.3) % 1));
      rr(W*0.22, tr.y-8, fillW, 14, 4, tr.color, null);
      ctx.fillStyle = '#fff';
      ctx.font = '9px system-ui,sans-serif';
      ctx.textAlign = 'right';
      ctx.fillText(Math.round(40+ti*15 + pulse*10)+'%', W*0.22+fillW-6, tr.y+3);
    });

    if (Math.sin(frame*0.03) > 0.6) {
      rr(W*0.55, H*0.18, W*0.32, 36, 8, 'rgba(245,158,11,.12)', C.act);
      ctx.fillStyle = C.act;
      ctx.font = 'bold 10px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'alphabetic';
      ctx.fillText('⏱ Напоминание D+3', W*0.71, H*0.28);
      ctx.fillStyle = C.muted;
      ctx.font = '9px system-ui,sans-serif';
      ctx.fillText('клиент не завершил шаг 1', W*0.71, H*0.34);
    }

    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>

<!-- ===== REVEAL IntersectionObserver ===== -->
<script>
(function(){
  'use strict';
  var reveals = document.querySelectorAll('.nero-ai-reveal');
  if (!reveals.length) return;
  if (!('IntersectionObserver' in window)) {
    reveals.forEach(function(el){ el.classList.add('nero-ai-active'); });
    return;
  }
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if (e.isIntersecting) {
        e.target.classList.add('nero-ai-active');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
  reveals.forEach(function(el){ io.observe(el); });
})();
</script>

<!-- ===== FAQ TOGGLE ===== -->
<script>
(function(){
  'use strict';
  document.querySelectorAll('.vnao-faq-q').forEach(function(q){
    q.addEventListener('click', function(){
      var item = this.closest('.vnao-faq-item');
      if (!item) return;
      var isOpen = item.classList.contains('open');
      item.classList.toggle('open');
      this.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
    });
    q.addEventListener('keydown', function(e){
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); this.click(); }
    });
  });
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

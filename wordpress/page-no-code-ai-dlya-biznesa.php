<?php
/**
 * Template Name: No-code AI для бизнеса: внедрение под ключ
 * Description: Внедряем no-code AI для малого и среднего бизнеса — заявки, тексты, CRM, отчёты и боты без дорогой разработки.
 */

declare(strict_types=1);

$page_seo_title       = 'No-code AI для бизнеса: внедрение под ключ без программистов';
$page_seo_description = 'Внедряем no-code AI для малого и среднего бизнеса: заявки, тексты, CRM, отчёты и боты без дорогой разработки. Под ключ, с интеграциями и расчётом стоимости. Закажите консультацию.';

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
    ['label' => 'Сценарии',  'href' => '#zadachi'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Кейсы',     'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ',       'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать быстрое решение';
$primary_cta_url     = nero_ai_primary_cta_url();
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
/* Hero scoped (Алина) */
/* === NCAI HERO — самодостаточные стили (scoped) === */
.ncai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.ncai-hero::before {
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
.ncai-hero::after {
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
  animation: ncaiGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes ncaiGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.ncai-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.ncai-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.ncai-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: #79f2ff !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.ncai-hero .nero-ai-h1,
.ncai-hero h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 6.2vw, 82px);
  line-height: .92;
  letter-spacing: -0.065em;
  color: #ffffff;
}
.ncai-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, #79f2ff 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.ncai-hero .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: #c7d2e5 !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.ncai-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.ncai-hero .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
  white-space: nowrap;
}
.ncai-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.ncai-hero .nero-ai-btn {
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
.ncai-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.ncai-hero .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, #79f2ff, #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.ncai-hero .nero-ai-btn-secondary {
  color: #e6edf7 !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.ncai-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.ncai-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.ncai-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.ncai-hero .nero-ai-dots { display: flex; gap: 7px; }
.ncai-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.ncai-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.ncai-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.ncai-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.ncai-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.ncai-hero .nero-ai-window-body { padding: 16px; }
.ncai-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.ncai-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.ncai-hero .nero-ai-live-pill {
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
.ncai-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: ncaiPulse 1.6s infinite;
}
@keyframes ncaiPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.ncai-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.ncai-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.ncai-hero .nero-ai-metric span {
  display: block;
  color: #9aa8bd;
  font-size: 11px;
  font-weight: 700;
}
.ncai-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.ncai-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.ncai-hero .ncai-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background:
    radial-gradient(ellipse at 25% 40%, rgba(121,242,255,.09), transparent 55%),
    radial-gradient(ellipse at 75% 60%, rgba(139,92,246,.08), transparent 50%),
    linear-gradient(180deg, rgba(248,250,252,.92) 0%, rgba(241,245,249,.88) 100%);
}
.ncai-hero #ncai-no-code-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.ncai-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.ncai-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.ncai-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: #79f2ff;
  font-size: 11px;
  font-weight: 800;
}
.ncai-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.ncai-hero .nero-ai-task span {
  color: #9aa8bd;
  font-size: 11px;
}
.ncai-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.ncai-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .ncai-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .ncai-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .ncai-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .ncai-hero .nero-ai-window-body { padding: 12px; }
  .ncai-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .ncai-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}

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
.ncai-content{
  --ncai-bg:#050711;--ncai-bg2:#080b17;--ncai-bg3:#0a0e1c;
  --ncai-surface:rgba(255,255,255,.072);--ncai-surface2:rgba(255,255,255,.108);
  --ncai-text:#e6edf7;--ncai-muted:#9aa8bd;--ncai-soft:#c7d2e5;--ncai-heading:#fff;
  --ncai-border:rgba(255,255,255,.10);--ncai-border-s:rgba(255,255,255,.18);
  --ncai-accent:#79f2ff;--ncai-violet:#8b5cf6;--ncai-green:#22c55e;--ncai-cyan:#79f2ff;
  --ncai-btn-from:#2563eb;--ncai-btn-to:#7c3aed;
  --ncai-shadow:0 24px 72px rgba(0,0,0,.4);
  --ncai-r:18px;--ncai-r-lg:24px;
  --ncai-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--ncai-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.ncai-content *,.ncai-content *::before,.ncai-content *::after{box-sizing:border-box;}
.ncai-content a{color:inherit;text-decoration:none;}
.ncai-content p{color:var(--ncai-muted);line-height:1.72;margin:0 0 1em;}
.ncai-content p:last-child{margin-bottom:0;}
.ncai-content h2,.ncai-content h3,.ncai-content h4{
  color:var(--ncai-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.ncai-content strong{color:var(--ncai-soft);}
.ncai-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.ncai-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--ncai-muted);font-size:14.5px;line-height:1.65;
}
.ncai-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--ncai-accent);font-weight:700;
}

/* Container */
.ncai-cnt{
  width:min(var(--ncai-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.ncai-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.ncai-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.ncai-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.ncai-sh.ncai-left{margin-left:0;text-align:left;}
.ncai-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.ncai-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.ncai-sh.ncai-left p{margin-left:0;}

/* Eyebrow */
.ncai-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--ncai-accent);margin-bottom:14px;
}

/* Gradient text */
.ncai-gt{
  background:linear-gradient(92deg,#fff 0%,var(--ncai-accent) 44%,var(--ncai-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.ncai-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.ncai-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.ncai-intro-text{
  position:relative;padding-left:20px;
}
.ncai-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--ncai-accent),var(--ncai-violet));
}
.ncai-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--ncai-muted);margin-bottom:1em;
}
.ncai-intro-text p:last-child{margin-bottom:0;color:var(--ncai-soft);}
.ncai-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.ncai-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.ncai-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--ncai-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.ncai-kpi-card .kl{font-size:11px;font-weight:600;color:var(--ncai-muted);line-height:1.4;}
.ncai-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .ncai-intro-grid{grid-template-columns:1fr;gap:36px;}
  .ncai-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .ncai-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.ncai-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.ncai-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.ncai-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--ncai-surface);border:1px solid var(--ncai-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--ncai-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.ncai-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--ncai-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.ncai-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--ncai-border);border-radius:var(--ncai-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.ncai-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.ncai-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.ncai-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .ncai-grid-2{grid-template-columns:1fr;}
  .ncai-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .ncai-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .ncai-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.ncai-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--ncai-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.ncai-level-card:hover{transform:translateY(-2px);}
.ncai-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--ncai-r) var(--ncai-r) 0 0;
}
.ncai-level-card.l1::before{background:var(--ncai-green);}
.ncai-level-card.l2::before{background:var(--ncai-accent);}
.ncai-level-card.l3::before{background:var(--ncai-violet);}
.ncai-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.ncai-level-card.l1 .ncai-level-badge{background:rgba(34,197,94,.15);color:var(--ncai-green);}
.ncai-level-card.l2 .ncai-level-badge{background:rgba(121,242,255,.15);color:var(--ncai-accent);}
.ncai-level-card.l3 .ncai-level-badge{background:rgba(139,92,246,.15);color:var(--ncai-violet);}
.ncai-level-card h3{font-size:17px;margin-bottom:10px;}
.ncai-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.ncai-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--ncai-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.ncai-scenario:last-child{margin-bottom:0;}
.ncai-scenario:hover{border-color:rgba(121,242,255,.3);}
.ncai-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.ncai-scenario h3{font-size:17px;margin-bottom:8px;}
.ncai-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.ncai-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.ncai-table{width:100%;border-collapse:collapse;font-size:14px;}
.ncai-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--ncai-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.ncai-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--ncai-text);vertical-align:top;
}
.ncai-table tr:last-child td{border-bottom:none;}
.ncai-table tr:hover td{background:rgba(255,255,255,.03);}
.ncai-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.ncai-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.ncai-stack-layer:last-child{border-bottom:none;}
.ncai-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--ncai-accent);padding-top:2px;
}
.ncai-stack-val{font-size:14.5px;color:var(--ncai-text);}
.ncai-stack-desc{font-size:13px;color:var(--ncai-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.ncai-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.ncai-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.ncai-case-grid{grid-template-columns:1fr;}}
.ncai-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.ncai-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.ncai-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--ncai-green);margin-bottom:10px;
}
.ncai-case-card h3{font-size:16px;margin-bottom:14px;}
.ncai-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.ncai-metric{display:flex;align-items:baseline;gap:8px;}
.ncai-metric .num{font-size:22px;font-weight:900;color:var(--ncai-accent);flex-shrink:0;letter-spacing:-.04em;}
.ncai-metric .lbl{font-size:13px;color:var(--ncai-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.ncai-timeline{position:relative;padding-left:40px;}
.ncai-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--ncai-accent),var(--ncai-violet));
  opacity:.35;border-radius:2px;
}
.ncai-tl-item{position:relative;margin-bottom:32px;}
.ncai-tl-item:last-child{margin-bottom:0;}
.ncai-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--ncai-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.ncai-tl-item h3{font-size:17px;margin-bottom:8px;}
.ncai-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.ncai-pricing-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
@media(max-width:960px){.ncai-pricing-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.ncai-pricing-grid{grid-template-columns:1fr;}}
.ncai-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.ncai-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.ncai-price-card.ncai-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.ncai-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--ncai-accent);margin-bottom:10px;
}
.ncai-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.ncai-price-card .inc{font-size:13px;color:var(--ncai-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.ncai-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.ncai-compare{width:100%;border-collapse:collapse;}
.ncai-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--ncai-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.ncai-compare td{
  padding:13px 16px;font-size:14px;color:var(--ncai-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.ncai-compare tr:last-child td{border-bottom:none;}
.ncai-good{color:var(--ncai-green);}
.ncai-neutral{color:var(--ncai-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.ncai-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.ncai-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.ncai-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--ncai-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.ncai-faq-q::after{
  content:'▾';font-size:13px;color:var(--ncai-accent);
  flex-shrink:0;transition:transform .25s;
}
.ncai-faq-item.open .ncai-faq-q::after{transform:rotate(180deg);}
.ncai-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--ncai-muted);line-height:1.72;
}
.ncai-faq-item.open .ncai-faq-a{max-height:600px;padding:0 24px 20px;}

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
  color:var(--ncai-muted);font-size:15px;
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
  background:linear-gradient(135deg,var(--ncai-btn-from),var(--ncai-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(59,130,246,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--ncai-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(121,242,255,.4);background:rgba(59,130,246,.12);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* =====================================================
   CTA FINAL SECTION
   ===================================================== */
.ncai-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.ncai-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--ncai-muted);
}
.ncai-cta-checklist li::before{content:'✓';color:var(--ncai-green);font-weight:800;}

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

.ncai-cta-card{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border:1px solid rgba(121,242,255,.3);
}
.ncai-cta-card .nero-ai-h3{font-size:clamp(20px,2.8vw,26px);font-weight:800;color:#fff;margin:0 0 12px;}
.ncai-cta-card p{color:var(--ncai-muted);font-size:15px;line-height:1.7;margin:0 0 20px;}
.ncai-inline-cta{text-align:center;font-size:15px;color:var(--ncai-muted);margin:28px 0 0;}
.ncai-inline-cta a{color:var(--ncai-accent);font-weight:700;text-decoration:underline!important;}
.ncai-scenario-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:14px;margin-top:28px;}
.ncai-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:16px;padding:22px;
}
.ncai-scenario h3{font-size:16px;margin-bottom:8px;}
.ncai-scenario p{font-size:14px;margin:0;}
.ncai-hitl-callout{
  margin-top:24px;padding:20px 24px;border-radius:16px;
  background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.28);
}
.ncai-hitl-callout strong{color:var(--ncai-green);}
.ncai-hero.ncai-hero,.ncai-hero{
  position:relative;min-height:100vh;min-height:100dvh;
}

</style>

<main id="primary" class="site-main nero-ai-home-page no-code-ai-dlya-biznesa-page ncai-page" role="main" tabindex="-1">


<!-- HERO: Алина -->
<section class="nero-ai-hero ncai-hero" id="ncai-hero" aria-labelledby="ncai-hero-title">
<div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · No-code AI</p>
      <h1 id="ncai-hero-title">No-code внедрение AI для бизнеса: <span class="nero-ai-gradient-text">автоматизация под ключ без программистов</span></h1>
      <p class="nero-ai-hero-lead">Соберём AI-автоматизацию на no-code: заявки, тексты, CRM, отчёты и боты — быстро и без дорогой разработки</p>
      <ul class="nero-ai-badges" aria-label="Ключевые параметры">
        <li class="nero-ai-badge">2–6 недель</li>
        <li class="nero-ai-badge">80–500 тыс. ₽</li>
        <li class="nero-ai-badge">Без программистов</li>
        <li class="nero-ai-badge">amoCRM · Bitrix24</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#zadachi">Сценарии</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация no-code AI: канал → AI → CRM → человек">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">демо · канал → AI → CRM → человек</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>No-code AI · операционный центр</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Срок пилота</span>
              <strong>2–6 нед</strong>
              <small>от аудита до запуска</small>
            </div>
            <div class="nero-ai-metric">
              <span>Бюджет под ключ</span>
              <strong>80–500К</strong>
              <small>пилот → мультиагент</small>
            </div>
            <div class="nero-ai-metric">
              <span>МСП с ИИ</span>
              <strong>53%</strong>
              <small>ПСБ · RSBI 2026</small>
            </div>
            <div class="nero-ai-metric">
              <span>Без оператора</span>
              <strong>55%</strong>
              <small>deflection rate</small>
            </div>
          </div>

          <div class="ncai-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ncai-no-code-hero-canvas" role="img" aria-label="Анимация: триггеры из мессенджеров собираются в no-code сценарий, AI-агент квалифицирует лид и создаёт карточку в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий no-code AI">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Telegram: новая заявка</strong><span>канал входящих обращений</span></div>
              <span class="nero-ai-status">получено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>AI: квалификация лида</strong><span>бюджет, срок, потребность</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>amoCRM: карточка и задача</strong><span>поля заполнены из диалога</span></div>
              <span class="nero-ai-status">создано</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">H</span>
              <div><strong>Менеджер: эскалация</strong><span>сложный кейс — human-in-the-loop</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="ncai-content">

  <section class="ncai-intro nero-ai-section nero-ai-section-tight" id="ncai-vvedenie" aria-label="Введение">
    <div class="ncai-cnt nero-ai-container">
      <div class="ncai-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="ncai-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">No-code AI · лонгрид</p>
          <p><strong>Коротко:</strong> No-code AI для бизнеса — сборка рабочих AI-сценариев через визуальные конструкторы без кода с нуля. Заявки, тексты, CRM, отчёты и боты — за дни, а не месяцы, без найма разработчиков.</p>
          <p>По данным ПСБ и «Опоры России» (RSBI, август 2026), доля МСП с нейросетями выросла с 17% до <strong>53%</strong> за год. 79% предпринимателей применяют ИИ постоянно (Точка Банк, май 2026). Вопрос уже не «нужен ли AI», а <strong>как внедрить быстро и без дорогой разработки</strong>.</p>
          <p>Nero Network собирает решения под ключ: аудит → запуск за 2–6 недель, бюджет <strong>80–500 тыс. ₽</strong>, российский стек и human-in-the-loop.</p>
          <!-- INTERNAL-LINKS:INSERT -->
        </div>
        <div class="ncai-intro-kpi" aria-label="Ключевые показатели">
          <div class="ncai-kpi-card"><div class="kv">53%</div><div class="kl">МСП используют нейросети</div><div class="ks">ПСБ · RSBI 2026</div></div>
          <div class="ncai-kpi-card"><div class="kv">79%</div><div class="kl">предпринимателей с ИИ постоянно</div><div class="ks">Точка Банк 2026</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="ncai-toc-outer">
    <div class="ncai-cnt">
      <nav class="ncai-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#chto-eto">Что это</a>
        <a href="#zadachi">Сценарии</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#sravnenie">Сравнение</a>
        <a href="#instrumenty">Инструменты</a>
        <a href="#faq">FAQ</a>
        <a href="#zakaz">Заказать</a>
      </nav>
    </div>
  </div>

  <section class="ncai-section" id="chto-eto">
    <div class="ncai-cnt">
      <div class="ncai-sh">
        <span class="ncai-eyebrow">Определение</span>
        <h2>No-code AI для бизнеса — что это и кому подходит</h2>
        <p><strong>Определение:</strong> внедрение ИИ через визуальные конструкторы и готовые платформы без разработки с нуля. Low-code допускает минимальный код, но логика собирается мышкой: триггеры, условия, промпты, webhook'и.</p>
      </div>
      <div class="ncai-card nero-ai-reveal">
        <h3 style="font-size:18px;margin-bottom:14px;">Чем no-code AI отличается от классической разработки</h3>
        <div class="ncai-table-wrap">
          <table class="ncai-table" aria-label="Сравнение классической разработки и no-code AI">
            <thead><tr><th>Критерий</th><th>Классическая разработка</th><th>No-code / low-code AI</th></tr></thead>
            <tbody>
              <tr><td>Срок запуска</td><td>3–12 месяцев</td><td>2–6 недель (пилот)</td></tr>
              <tr><td>Команда</td><td>Разработчики, DevOps, аналитик</td><td>Интегратор + владелец бизнеса</td></tr>
              <tr><td>Бюджет старта</td><td>от 300 тыс.–1,5 млн ₽</td><td>80–500 тыс. ₽ под ключ</td></tr>
              <tr><td>Изменения</td><td>ТЗ, спринты, деплой</td><td>Правка промпта за часы</td></tr>
              <tr><td>Масштаб</td><td>Любой, но дорого</td><td>Типовые SMB-сценарии — оптимально</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="ncai-card nero-ai-reveal" style="margin-top:24px;">
        <h3 style="font-size:18px;margin-bottom:12px;">Для кого: малый бизнес, сервисные компании, предприниматели</h3>
        <ul>
          <li><strong>Малый бизнес</strong> (5–50 сотрудников): нет IT-отдела, владелец тянет продажи и операционку</li>
          <li><strong>Сервисные компании</strong>: пики обращений, нужен ответ 24/7</li>
          <li><strong>E-commerce и retail</strong>: каталог, остатки, статусы — AI видит данные точнее FAQ-бота</li>
          <li><strong>HoReCa, образование, B2B</strong>: бронирование, консультации, квалификация лидов</li>
        </ul>
        <p style="margin-top:12px;">Средний чек DIY у малого бизнеса — около <strong>6 000 ₽</strong> (подписки), под ключ у интегратора — <strong>80–500 тыс. ₽</strong> с готовыми интеграциями.</p>
      </div>
    </div>
  </section>

  <section class="ncai-section ncai-section-alt" id="zadachi">
    <div class="ncai-cnt">
      <div class="ncai-sh">
        <span class="ncai-eyebrow">Сценарии</span>
        <h2>Какие задачи решает no-code AI в бизнесе</h2>
        <p><strong>Коротко:</strong> AI автоматизация бизнеса на no-code закрывает заявки, тексты, CRM, отчёты и боты. Старт с одной зоны — нормальная стратегия.</p>
      </div>
      <div class="ncai-scenario-grid nero-ai-reveal">
        <div class="ncai-scenario"><h3>Заявки и лиды</h3><p>Квалификация из Telegram, WhatsApp, сайта; карточка в amoCRM/Bitrix24; уведомление менеджеру. Ответ — секунды, не минуты.</p></div>
        <div class="ncai-scenario"><h3>Тексты и контент</h3><p>КП, email, посты по tone of voice бренда. Human-in-the-loop: маркетолог утверждает перед публикацией.</p></div>
        <div class="ncai-scenario"><h3>CRM и отчёты</h3><p>Автозаполнение полей, суммаризация переписки, еженедельные сводки в Sheets или DataLens.</p></div>
        <div class="ncai-scenario"><h3>Боты и AI-агенты</h3><p>Агент с действиями в CRM — не FAQ-бот 2019 года. Мультиагент закрывает до 55% диалогов без оператора.</p></div>
      </div>
      <div class="ncai-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:18px;margin-bottom:14px;">FAQ-бот vs AI-агент vs мультиагент</h3>
        <div class="ncai-table-wrap">
          <table class="ncai-table" aria-label="Сравнение типов ботов">
            <thead><tr><th>Тип</th><th>Что умеет</th><th>Срок</th><th>Ориентир цены</th></tr></thead>
            <tbody>
              <tr><td>FAQ-бот</td><td>Отвечает по скрипту</td><td>3–7 дней</td><td>50–150 тыс. ₽</td></tr>
              <tr><td>AI-агент</td><td>Отвечает + действия в CRM</td><td>2–4 недели</td><td>150–350 тыс. ₽</td></tr>
              <tr><td>Мультиагент</td><td>Оркестратор + субагенты</td><td>4–8 недель</td><td>300–500 тыс. ₽</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>


<!-- ================================================
     БОРИС: вставка после #zadachi, до #vnedrenie
     id="ncai-flow" — не дублировать ncai-hero
     ================================================ -->
<section id="ncai-flow" class="ncf-root nero-ai-section" aria-label="Схема no-code AI: канал → AI-агент → CRM → человек при эскалации">
<style>
/* === БОРИС: prefix ncf-, scoped внутри #ncai-flow === */
#ncai-flow.ncf-root{
  padding:clamp(48px,6vw,72px) 0;
  background:linear-gradient(180deg,#f8fafc 0%,#f1f5f9 100%);
}
#ncai-flow .ncf-cnt{
  width:min(1160px,calc(100% - 40px));
  margin:0 auto;
}
#ncai-flow .ncf-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:24px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 12px 48px rgba(15,23,42,.10),0 0 0 1px rgba(148,163,184,.16);
  min-height:min(560px,70vh);
}
@media(max-width:1023px){
  #ncai-flow .ncf-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ncai-flow .ncf-lft{
  padding:clamp(32px,4vw,48px) clamp(24px,3vw,40px);
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ncai-flow .ncf-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
  }
}
#ncai-flow .ncf-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#6366f1;
  margin:0 0 14px;
}
#ncai-flow .ncf-ey::before{
  content:'';
  width:20px;height:2px;
  background:linear-gradient(90deg,#6366f1,#79f2ff);
  border-radius:1px;
}
#ncai-flow .ncf-h3{
  font-size:clamp(20px,2.5vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
  letter-spacing:-.03em;
}
#ncai-flow .ncf-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:10px;
}
#ncai-flow .ncf-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14.5px;
  line-height:1.55;
  color:#334155;
  margin:0;
}
#ncai-flow .ncf-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(99,102,241,.10);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#6366f1;
  margin-top:1px;
  font-style:normal;
}
#ncai-flow .ncf-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:20px;
}
#ncai-flow .ncf-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ncai-flow .ncf-pl-c{background:rgba(121,242,255,.12);color:#0e7490;border:1.5px solid rgba(121,242,255,.35);}
#ncai-flow .ncf-pl-v{background:rgba(139,92,246,.10);color:#6d28d9;border:1.5px solid rgba(139,92,246,.28);}
#ncai-flow .ncf-pl-g{background:rgba(34,197,94,.10);color:#15803d;border:1.5px solid rgba(34,197,94,.25);}
#ncai-flow .ncf-foot{
  font-size:13.5px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ncai-flow .ncf-rgt{
  position:relative;
  background:linear-gradient(145deg,#050711 0%,#0a0e1c 55%,#080b17 100%);
  min-height:400px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ncai-flow .ncf-rgt{min-height:360px;}
}
#ncai-flow #ncf-flow-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="ncf-cnt">
  <div class="ncf-card nero-ai-reveal">

    <div class="ncf-lft">
      <span class="ncf-ey">AI-операционный центр</span>
      <h3 class="ncf-h3">Как no-code связка ведёт заявку от канала до CRM — и когда звать человека</h3>
      <ul class="ncf-ul">
        <li><span class="ncf-ic">①</span><strong>Канал</strong> — сайт, Telegram, WhatsApp или Авито принимает обращение 24/7</li>
        <li><span class="ncf-ic">②</span><strong>AI-агент</strong> — классифицирует запрос, отвечает из базы знаний, квалифицирует лида</li>
        <li><span class="ncf-ic">③</span><strong>CRM</strong> — Make/n8n создаёт карточку, заполняет поля, ставит задачу менеджеру</li>
        <li><span class="ncf-ic">④</span><strong>Человек</strong> — подключается только при эскалации: скидка, нестандарт, спор</li>
      </ul>
      <div class="ncf-pills">
        <span class="ncf-pl ncf-pl-c">секунды, не минуты</span>
        <span class="ncf-pl ncf-pl-v">55% без оператора</span>
        <span class="ncf-pl ncf-pl-g">human-in-the-loop</span>
      </div>
      <p class="ncf-foot">Дальше — как мы внедряем это под ключ → <a href="#vnedrenie">этапы внедрения</a></p>
    </div>

    <div class="ncf-rgt">
      <canvas
        id="ncf-flow-canvas"
        aria-label="Анимация: поток заявки через канал, AI-агента, CRM и эскалацию к менеджеру"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('ncf-flow-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, fr = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 680;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    cyan:'#79f2ff', cyanA:function(a){return 'rgba(121,242,255,'+a+')';},
    viol:'#8b5cf6', violA:function(a){return 'rgba(139,92,246,'+a+')';},
    green:'#22c55e', greenA:function(a){return 'rgba(34,197,94,'+a+')';},
    amber:'#fbbf24', amberA:function(a){return 'rgba(251,191,36,'+a+')';},
    text:'#e6edf7', muted:'rgba(230,237,247,.45)',
    line:'rgba(255,255,255,.12)', card:'rgba(255,255,255,.06)',
    cardBdr:'rgba(255,255,255,.14)'
  };

  var NODES = [
    {id:'ch',  label:'Канал',      sub:'Telegram · сайт',  clr:C.cyan,  dimFn:C.cyanA,  icon:'\u2709'},
    {id:'ai',  label:'AI-агент',   sub:'квалификация',     clr:C.viol,  dimFn:C.violA,  icon:'\u2726'},
    {id:'crm', label:'CRM',        sub:'amoCRM · Bitrix',  clr:C.green, dimFn:C.greenA, icon:'\u25A3'},
    {id:'hum', label:'Человек',    sub:'эскалация',        clr:C.amber, dimFn:C.amberA, icon:'\u263A'}
  ];

  var LOOP = 480;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect){ctx.roundRect(x,y,w,h,r);}
    else{
      ctx.moveTo(x+r,y);ctx.arcTo(x+w,y,x+w,y+h,r);
      ctx.arcTo(x+w,y+h,x,y+h,r);ctx.arcTo(x,y+h,x,y,r);
      ctx.arcTo(x,y,x+w,y,r);ctx.closePath();
    }
    if(fill){ctx.fillStyle=fill;ctx.fill();}
    if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke();}
  }

  function nodeLayout(){
    var padX = Math.max(24, W * 0.04);
    var usable = W - padX * 2;
    var gap = usable / (NODES.length - 1);
    var cy = H * 0.46;
    var nw = Math.min(108, usable * 0.19);
    var nh = Math.min(88, H * 0.22);
    return NODES.map(function(n, i){
      return {
        x: padX + gap * i - nw / 2,
        y: cy - nh / 2,
        w: nw, h: nh,
        cx: padX + gap * i,
        cy: cy,
        meta: n
      };
    });
  }

  var packets = [
    {t0:0,   stage:0, label:'новая заявка'},
    {t0:90,  stage:1, label:'квалификация'},
    {t0:180, stage:2, label:'карточка CRM'},
    {t0:270, stage:3, label:'эскалация'}
  ];

  function drawGrid(){
    ctx.strokeStyle='rgba(255,255,255,.04)';
    ctx.lineWidth=1;
    var step=28;
    for(var gx=0;gx<W;gx+=step){
      ctx.beginPath();ctx.moveTo(gx,0);ctx.lineTo(gx,H);ctx.stroke();
    }
    for(var gy=0;gy<H;gy+=step){
      ctx.beginPath();ctx.moveTo(0,gy);ctx.lineTo(W,gy);ctx.stroke();
    }
  }

  function drawHeader(){
    ctx.fillStyle=C.text;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('No-code AI \u00b7 поток заявки', 18, 26);
    var pulse = 6 + Math.sin(fr * 0.08) * 2;
    ctx.beginPath();ctx.arc(W-52, 20, pulse+5, 0, Math.PI*2);
    ctx.fillStyle=C.greenA(0.12 + 0.06*Math.sin(fr*0.08));
    ctx.fill();
    ctx.beginPath();ctx.arc(W-52, 20, 5, 0, Math.PI*2);
    ctx.fillStyle=C.green;ctx.fill();
    ctx.fillStyle=C.muted;
    ctx.font='600 10px Inter,system-ui,sans-serif';
    ctx.textAlign='right';
    ctx.fillText('live \u00b7 демо', W-18, 24);
  }

  function drawConnectors(nodes){
    for(var i=0;i<nodes.length-1;i++){
      var a=nodes[i], b=nodes[i+1];
      var x1=a.cx+a.w/2+6, x2=b.cx-b.w/2-6, y=a.cy;
      var grad=ctx.createLinearGradient(x1,y,x2,y);
      grad.addColorStop(0,a.meta.clr);
      grad.addColorStop(1,b.meta.clr);
      ctx.strokeStyle=grad;
      ctx.lineWidth=2;
      ctx.setLineDash([6,8]);
      ctx.lineDashOffset=-(fr*1.2);
      ctx.beginPath();ctx.moveTo(x1,y);ctx.lineTo(x2,y);ctx.stroke();
      ctx.setLineDash([]);
      var prog=((fr*1.8)%(x2-x1))/(x2-x1);
      var dotX=x1+(x2-x1)*prog;
      ctx.beginPath();ctx.arc(dotX,y,4,0,Math.PI*2);
      ctx.fillStyle=a.meta.clr;ctx.fill();
    }
  }

  function drawNode(n, active){
    var m=n.meta;
    var glow=active?0.22:0.08;
    ctx.shadowColor=m.clr;
    ctx.shadowBlur=active?18:0;
    rr(n.x,n.y,n.w,n.h,14,C.card,C.cardBdr,1.5);
    ctx.shadowBlur=0;
    if(active){
      rr(n.x,n.y,n.w,n.h,14,m.dimFn(glow),m.clr,1);
    }
    ctx.fillStyle=m.clr;
    ctx.font='bold 16px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(m.icon, n.cx, n.y+28);
    ctx.fillStyle=C.text;
    ctx.font='bold 11.5px Inter,system-ui,sans-serif';
    ctx.fillText(m.label, n.cx, n.y+48);
    ctx.fillStyle=C.muted;
    ctx.font='500 9.5px Inter,system-ui,sans-serif';
    ctx.fillText(m.sub, n.cx, n.y+62);
  }

  function drawPacket(nodes, pkt){
    var t=(fr-pkt.t0+LOOP)%LOOP;
    if(t<0||t>200) return;
    var stage=Math.min(3, Math.floor(t/50));
    var local=(t%50)/50;
    var from=Math.min(stage,3);
    var to=Math.min(from+1,3);
    var a=nodes[from], b=nodes[to];
    var px=a.cx+(b.cx-a.cx)*local;
    var py=a.cy-18+Math.sin(local*Math.PI)*-12;
    var alpha=Math.min(1,t/20)*Math.min(1,(200-t)/30);
    ctx.globalAlpha=alpha;
    rr(px-52,py-11,104,22,8,m.dimFn(0.18),m.clr,1);
    ctx.fillStyle=C.text;
    ctx.font='600 10px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(pkt.label, px, py+4);
    ctx.globalAlpha=1;
  }

  function drawLegend(){
    ctx.fillStyle=C.muted;
    ctx.font='500 10px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Make / n8n \u2192 webhook \u2192 CRM \u2192 Telegram-группа менеджеров', 18, H-16);
  }

  function frame(){
    fr++;
    ctx.clearRect(0,0,W,H);
    drawGrid();
    drawHeader();
    var nodes=nodeLayout();
    drawConnectors(nodes);
    var activeStage=Math.floor((fr*0.6)%LOOP/120)%4;
    nodes.forEach(function(n,i){drawNode(n,i===activeStage);});
    packets.forEach(function(p){drawPacket(nodes,p);});
    drawLegend();
    requestAnimationFrame(frame);
  }
  requestAnimationFrame(frame);
})();
</script>
</section>

  <section class="ncai-section" id="vnedrenie">
    <div class="ncai-cnt">
      <div class="ncai-sh">
        <span class="ncai-eyebrow">Процесс</span>
        <h2>Как мы внедряем AI в бизнес-процессы на no-code</h2>
        <p><strong>Коротко:</strong> аудит → пилот на одном канале → интеграция → запуск с метриками. Один сценарий за 2–6 недель.</p>
      </div>
      <div class="nero-ai-reveal">
        <div class="ncai-timeline">
          <div class="ncai-tl-item"><div class="ncai-tl-dot"></div><h3>1. Аудит и «Карта no-code AI»</h3><p>Матрица «сценарий × инструмент × срок × бюджет». 2–3 дня: конкретный план, не презентация «про AI вообще».</p></div>
          <div class="ncai-tl-item"><div class="ncai-tl-dot"></div><h3>2. Сборка и интеграция</h3><p>YandexGPT/GigaChat + Make/n8n + amoCRM/Bitrix24 + Telegram. Webhook-триггеры, RAG, тест на реальных диалогах — 1–2 недели.</p></div>
          <div class="ncai-tl-item"><div class="ncai-tl-dot"></div><h3>3. Запуск и обучение</h3><p>Инструкция, дашборд метрик, регламент эскалации. 2–4 недели модерации ответов AI.</p></div>
          <div class="ncai-tl-item"><div class="ncai-tl-dot"></div><h3>4. Поддержка 30 дней</h3><p>Правки по реальным диалогам. Окупаемость при правильном процессе — 3–6 месяцев.</p></div>
        </div>
      </div>
      <aside class="ncai-cta-card nero-ai-cta-card nero-ai-reveal" aria-label="Заказать no-code AI под ключ">
        <p class="nero-ai-eyebrow">Следующий шаг</p>
        <h3 class="nero-ai-h3">Соберите пилот за 2–6 недель — с «Картой no-code AI» на аудите</h3>
        <p>За один созвон определим сценарий с быстрым ROI, стек под вашу CRM и реалистичный бюджет 80–500 тыс. ₽.</p>
        <div class="nero-ai-btn-row">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#stoimost" class="nero-ai-btn nero-ai-btn-secondary">Смотреть уровни и цены</a>
        </div>
      </aside>
    </div>
  </section>

  <section class="ncai-section ncai-section-alt" id="stoimost">
    <div class="ncai-cnt">
      <div class="ncai-sh">
        <span class="ncai-eyebrow">Инвестиции</span>
        <h2>Стоимость и сроки внедрения no-code AI</h2>
        <p>От <strong>80 тыс. ₽</strong> (пилот) до <strong>500 тыс. ₽</strong> (мультиагент). Срок — 2–6 недель.</p>
      </div>
      <div class="ncai-pricing-grid nero-ai-reveal">
        <div class="ncai-price-card"><div class="tier">Старт</div><div class="amount">80–150 тыс. ₽</div><div class="inc">1 канал + FAQ/квалификация + CRM · 2–3 недели</div></div>
        <div class="ncai-price-card ncai-featured"><div class="tier">Рабочий ★</div><div class="amount">150–300 тыс. ₽</div><div class="inc">AI-агент с действиями, 2 канала, отчёты · 3–5 недель</div></div>
        <div class="ncai-price-card"><div class="tier">Масштаб</div><div class="amount">300–500 тыс. ₽</div><div class="inc">Мультиагент, склад, телефония · 4–6 недель</div></div>
      </div>
      <div class="ncai-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:18px;margin-bottom:14px;">От чего зависит цена</h3>
        <div class="ncai-table-wrap">
          <table class="ncai-table" aria-label="Факторы цены">
            <thead><tr><th>Фактор</th><th>Влияние</th></tr></thead>
            <tbody>
              <tr><td>Количество каналов</td><td>+30–50% за каждый дополнительный</td></tr>
              <tr><td>Глубина CRM-интеграции</td><td>API vs webhook, кастомные поля</td></tr>
              <tr><td>Тип агента</td><td>FAQ vs агент с действиями vs мультиагент</td></tr>
              <tr><td>Требования к данным</td><td>Облако РФ, on-premise, 152-ФЗ</td></tr>
            </tbody>
          </table>
        </div>
        <p class="ncai-inline-cta nero-ai-inline-cta nero-ai-reveal">Хотите сначала разобраться сами? <a href="<?php echo esc_url($secondary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a> — пошаговый путь к no-code AI без программистов.</p>
      </div>
    </div>
  </section>

  <section class="ncai-section" id="keisy">
    <div class="ncai-cnt">
      <div class="ncai-sh">
        <span class="ncai-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения no-code AI</h2>
        <p>Один сценарий → интеграция с CRM → human-in-the-loop.</p>
      </div>
      <div class="ncai-case-grid">
        <div class="ncai-case-card nero-ai-reveal">
          <div class="ncai-case-tag">E-commerce · pickTech</div>
          <h3>Acolyte Wear — 55% без оператора</h3>
          <p style="font-size:14px;">Мультиагент: каталог + сервис. Остатки в «МойСклад», заказы в RetailCRM, Telegram.</p>
          <div class="ncai-metrics">
            <div class="ncai-metric"><span class="num">11 000+</span><span class="lbl">диалогов</span></div>
            <div class="ncai-metric"><span class="num">55%</span><span class="lbl">закрыты без оператора</span></div>
          </div>
        </div>
        <div class="ncai-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="ncai-case-tag">Производство · Дзен</div>
          <h3>«Нестарица» — 70 ч/мес экономии</h3>
          <p style="font-size:14px;">Владелица настраивала сценарии на подписках без IT-отдела.</p>
          <div class="ncai-metrics">
            <div class="ncai-metric"><span class="num">70 ч</span><span class="lbl">экономия в месяц</span></div>
          </div>
        </div>
        <div class="ncai-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="ncai-case-tag">HoReCa · GPTmag</div>
          <h3>Сеть ресторанов — ответ за 12 сек</h3>
          <p style="font-size:14px;">8 точек, Казань. Бронь, меню, аналитика отзывов.</p>
          <div class="ncai-metrics">
            <div class="ncai-metric"><span class="num">−85%</span><span class="lbl">время ответа на бронь</span></div>
            <div class="ncai-metric"><span class="num">4 мес</span><span class="lbl">окупаемость</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ncai-section ncai-section-alt" id="sravnenie">
    <div class="ncai-cnt">
      <div class="ncai-sh">
        <span class="ncai-eyebrow">Выбор</span>
        <h2>No-code AI vs разработка с нуля: что выбрать</h2>
        <p>No-code без программиста — для типовых SMB-задач. Разработка — для уникальной логики и enterprise.</p>
      </div>
      <div class="ncai-card nero-ai-reveal">
        <div class="ncai-table-wrap">
          <table class="ncai-table" aria-label="Риски и как их закрываем">
            <thead><tr><th>Риск</th><th>Как закрываем</th></tr></thead>
            <tbody>
              <tr><td>Галлюцинации AI</td><td>База знаний, ограничение тем, модерация</td></tr>
              <tr><td>Утечка данных</td><td>Российские облака, 152-ФЗ, on-premise</td></tr>
              <tr><td>Рост счёта за токены</td><td>Лимиты, кэширование, выбор модели</td></tr>
              <tr><td>«Бот не работал»</td><td>AI-агент с CRM ≠ FAQ-бот 2019 года</td></tr>
            </tbody>
          </table>
        </div>
        <div class="ncai-hitl-callout nero-ai-reveal">
          <p><strong>Human-in-the-loop</strong> — стандарт качества: AI снимает до 55% рутины, человек закрывает скидки, нестандарт и споры.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ncai-section" id="instrumenty">
    <div class="ncai-cnt">
      <div class="ncai-sh">
        <span class="ncai-eyebrow">Стек <span class="ncai-badge">2026</span></span>
        <h2>Инструменты и платформы no-code AI в 2026</h2>
        <p>Agentic automation: Yandex AI Studio, Make, n8n 2.0, Bitrix24 CoPilot, amoAI, NextBot.</p>
      </div>
      <div class="ncai-grid-2 nero-ai-reveal">
        <div class="ncai-card">
          <h3 style="font-size:17px;margin-bottom:12px;">Оркестраторы</h3>
          <div class="ncai-table-wrap">
            <table class="ncai-table"><thead><tr><th>Платформа</th><th>Сильная сторона</th></tr></thead>
            <tbody>
              <tr><td>Make</td><td>Визуальная логика, воронки SMB</td></tr>
              <tr><td>n8n 2.0</td><td>Self-host, 70+ AI nodes, 152-ФЗ</td></tr>
              <tr><td>Zapier</td><td>Быстрый старт, 7000+ интеграций</td></tr>
            </tbody></table>
          </div>
        </div>
        <div class="ncai-card">
          <h3 style="font-size:17px;margin-bottom:12px;">Российские платформы</h3>
          <div class="ncai-table-wrap">
            <table class="ncai-table"><thead><tr><th>Платформа</th><th>Особенность</th></tr></thead>
            <tbody>
              <tr><td>Yandex AI Studio</td><td>Агенты на YandexGPT, облако РФ</td></tr>
              <tr><td>NextBot</td><td>Managed launch от 5 дней</td></tr>
              <tr><td>amoAI / Bitrix24 CoPilot</td><td>AI внутри CRM</td></tr>
            </tbody></table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ncai-section ncai-section-alt" id="faq">
    <div class="ncai-cnt">
      <div class="ncai-sh">
        <span class="ncai-eyebrow">FAQ</span>
        <h2>FAQ по внедрению no-code AI для бизнеса</h2>
      </div>
      <div class="ncai-faq nero-ai-reveal">
        <div class="ncai-faq-item"><div class="ncai-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить no code ai для бизнеса?</div><div class="ncai-faq-a"><p>Аудит 1–2 процессов → FAQ и 20–50 диалогов → пилот на одном канале + CRM → метрики 2–4 недели → масштабирование. Под ключ: 2–6 недель.</p></div></div>
        <div class="ncai-faq-item"><div class="ncai-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит no code ai для бизнеса?</div><div class="ncai-faq-a"><p>DIY от 3–10 тыс. ₽/мес; пилот 80–150 тыс. ₽; рабочий агент 150–350 тыс. ₽; мультиагент 300–500 тыс. ₽.</p></div></div>
        <div class="ncai-faq-item"><div class="ncai-faq-q" tabindex="0" role="button" aria-expanded="false">Под ключ или самостоятельно?</div><div class="ncai-faq-a"><p>DIY — если есть время на эксперименты. Под ключ — если нужен результат, интеграции и метрики с первого дня.</p></div></div>
        <div class="ncai-faq-item"><div class="ncai-faq-q" tabindex="0" role="button" aria-expanded="false">No-code AI с CRM — как связать?</div><div class="ncai-faq-a"><p>Канал → AI-агент → webhook Make/n8n → amoCRM/Bitrix24 (лид, задача, поля). Для e-commerce: + RetailCRM, «МойСклад».</p></div></div>
        <div class="ncai-faq-item"><div class="ncai-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли программист?</div><div class="ncai-faq-a"><p>Нет для типовых сценариев. Low-code — точечный код для сложных API; основная сборка визуальная.</p></div></div>
        <div class="ncai-faq-item"><div class="ncai-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли начать с одного канала?</div><div class="ncai-faq-a"><p>Да — рекомендуемая стратегия: Telegram + CRM + база знаний за 2–3 недели, затем масштаб по метрикам.</p></div></div>
      </div>
    </div>
  </section>

  <section class="ncai-section" id="zakaz">
    <div class="ncai-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal">
        <p class="ym-cta-block__headline">Собрать быстрое no-code AI-решение</p>
        <p class="ym-cta-block__sub">Карта no-code AI, аудит за 2–3 дня, запуск за 2–6 недель. YandexGPT, amoCRM/Bitrix24, Telegram, 152-ФЗ, human-in-the-loop.</p>
        <ul class="ncai-cta-checklist">
          <li>Карта сценариев 80 / 200 / 500 тыс. ₽</li>
          <li>Аудит за 2–3 дня</li>
          <li>Запуск с метриками</li>
          <li>Российский стек</li>
        </ul>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#stoimost" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Уровни и цены</a>
        </div>
        <p style="margin-top:18px;font-size:14px;color:var(--ncai-muted);">Лид-магнит: <strong>Карта no-code AI</strong> — после заявки увидите, что собрать за 80, 200 и 500 тыс. ₽ без программистов.</p>
      </div>
    </div>
  </section>

</div><!-- .ncai-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * ncai-no-code-hero-engine — «Диспетчерская no-code оркестрации AI-агентов»
 * Мир: триггеры по кривой → модульный хаб → запуск сценария → CRM + эскалация
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ncai-no-code-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 290) * 1.08;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#334155",
    soft: "#64748b",
    panel: "#f1f5f9",
    panelEdge: "#e2e8f0",
    triggerTg: "#38bdf8",
    triggerWa: "#22c55e",
    triggerWeb: "#a78bfa",
    wire: "#8b5cf6",
    wireGlow: "rgba(139,92,246,0.35)",
    hubBase: "#0f172a",
    hubAccent: "#79f2ff",
    blockGreen: "#a7f3d0",
    blockBlue: "#93c5fd",
    blockPink: "#fbcfe8",
    crmCard: "#dbeafe",
    launchGreen: "#22c55e",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#ffffff",
    bubbleText: "#0f172a"
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

  function drawMiniCard(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 4, color, C.outline);
    if (label) {
      ctx.fillStyle = C.outline;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, x, y + 2);
    }
  }

  /* Каналы входа — док-станция слева */
  function ChannelIngressDock() {}
  ChannelIngressDock.prototype.draw = function (ctx) {
    drawRR(ctx, -168, -72, 42, 88, 8, C.panel, C.outline);
    var icons = [
      { y: -58, c: C.triggerTg, t: "TG" },
      { y: -28, c: C.triggerWa, t: "WA" },
      { y: 2, c: C.triggerWeb, t: "WEB" }
    ];
    icons.forEach(function (ic) {
      drawRR(ctx, -158, ic.y, 22, 18, 4, ic.c, C.outline);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(ic.t, -147, ic.y + 12);
    });
    ctx.fillStyle = C.soft;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Каналы", -165, -80);
  };

  /* Кривая no-code «река» — вместо Conveyor */
  function WorkflowBezierStream() {
    this.cards = [
      { t0: 0, color: C.triggerTg, label: "лид" },
      { t0: 55, color: C.triggerWa, label: "FAQ" },
      { t0: 110, color: C.triggerWeb, label: "отчёт" }
    ];
  }
  WorkflowBezierStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    ctx.strokeStyle = "rgba(100,116,139,0.35)";
    ctx.lineWidth = 2;
    ctx.setLineDash([4, 5]);
    ctx.beginPath();
    ctx.moveTo(-145, -20);
    ctx.bezierCurveTo(-90, -55, -40, 35, 5, 10);
    ctx.stroke();
    ctx.setLineDash([]);

    if (prg < 95) {
      var pulse = 0.5 + Math.sin(frame * 0.08) * 0.25;
      ctx.strokeStyle = "rgba(139,92,246," + pulse + ")";
      ctx.lineWidth = 2.5;
      ctx.beginPath();
      ctx.moveTo(-145, -20);
      var midT = Math.min(1, prg / 95);
      for (var s = 0; s <= midT; s += 0.04) {
        var px = bezierPt(-145, -90, -40, 5, -20, -55, 35, 10, s).x;
        var py = bezierPt(-145, -90, -40, 5, -20, -55, 35, 10, s).y;
        if (s === 0) ctx.moveTo(px, py);
        else ctx.lineTo(px, py);
      }
      ctx.stroke();
    }

    this.cards.forEach(function (card) {
      var t = ((frame * 0.35 + card.t0) % 130) / 130;
      if (t > 0.88) return;
      var p = bezierPt(-145, -90, -40, 5, -20, -55, 35, 10, t);
      drawMiniCard(ctx, p.x, p.y, 18, 14, card.color, card.label);
    });
  };

  function bezierPt(x0, x1, x2, x3, y0, y1, y2, y3, t) {
    var u = 1 - t;
    return {
      x: u*u*u*x0 + 3*u*u*t*x1 + 3*u*t*t*x2 + t*t*t*x3,
      y: u*u*u*y0 + 3*u*u*t*y1 + 3*u*t*t*y2 + t*t*t*y3
    };
  }

  /* Мост Make/n8n */
  function MakeN8nBridge() {}
  MakeN8nBridge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -28, 28, 56, 14, 4, "rgba(139,92,246,0.12)", C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Make / n8n", 0, 38);
    if (prg >= 88 && prg < 175) {
      var w = Math.min(1, (prg - 88) / 40);
      ctx.strokeStyle = C.wireGlow;
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.moveTo(0, 10);
      ctx.lineTo(0, 28);
      ctx.stroke();
      ctx.globalAlpha = w;
      ctx.fillStyle = C.wire;
      ctx.fillRect(-2, 18, 4, 8);
      ctx.globalAlpha = 1;
    }
  };

  /* Центральный хаб — вместо WebsiteTerminal */
  function AgentOrchestratorHub() {
    this.blocks = [false, false, false, false];
    this.launchPulse = 0;
  }
  AgentOrchestratorHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -8, -68, 130, 118, 12, C.hubBase, C.outline);

    drawRR(ctx, 0, -60, 114, 16, [8, 8, 0, 0], "rgba(121,242,255,0.2)", null);
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("AI-агент · no-code", 6, -50);

    var blockDefs = [
      { x: 4, y: -38, w: 48, h: 22, color: C.blockBlue, label: "Триггер", phase: 95 },
      { x: 58, y: -38, w: 48, h: 22, color: C.blockGreen, label: "AI", phase: 115 },
      { x: 4, y: -10, w: 48, h: 22, color: C.blockPink, label: "CRM", phase: 135 },
      { x: 58, y: -10, w: 48, h: 22, color: "#fcd34d", label: "HITL", phase: 155 }
    ];

    blockDefs.forEach(function (b, i) {
      var on = prg >= b.phase;
      this.blocks[i] = on;
      drawRR(ctx, b.x, b.y, b.w, b.h, 5, on ? b.color : "rgba(255,255,255,0.08)", C.outline);
      ctx.fillStyle = on ? C.outline : C.soft;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.label, b.x + b.w / 2, b.y + 14);
    }, this);

    if (prg >= 100 && prg < 175) {
      ctx.strokeStyle = C.wire;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.moveTo(28, -16);
      ctx.lineTo(82, -16);
      ctx.lineTo(82, 2);
      ctx.lineTo(28, 2);
      ctx.stroke();
    }

    if (prg >= 175) {
      this.launchPulse = (prg - 175) / 30;
      var alpha = 0.4 + Math.sin(frame * 0.15) * 0.3;
      ctx.strokeStyle = "rgba(34,197,94," + alpha + ")";
      ctx.lineWidth = 2;
      ctx.strokeRect(-4, -70, 122, 122);
      drawRR(ctx, 18, 18, 74, 20, 6, "rgba(34,197,94,0.25)", C.launchGreen);
      ctx.fillStyle = "#166534";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("▶ Сценарий запущен", 55, 31);

      if (prg >= 200) {
        var defl = Math.min(1, (prg - 200) / 20);
        ctx.globalAlpha = defl;
        ctx.fillStyle = C.launchGreen;
        ctx.font = "bold 9px Inter,sans-serif";
        ctx.fillText("55% без оператора", 55, 52);
        ctx.globalAlpha = 1;
      }
    }
  };

  /* CRM-тикер справа */
  function CrmDealTicker() {}
  CrmDealTicker.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, 118, -58, 52, 70, 8, C.panel, C.outline);
    ctx.fillStyle = C.soft;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("amoCRM", 144, -48);

    if (prg >= 145) {
      drawRR(ctx, 124, -38, 40, 36, 5, C.crmCard, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Лид #847", 128, -28);
      ctx.fillStyle = C.soft;
      ctx.fillText("бюджет ✓", 128, -18);
      ctx.fillText("задача ✓", 128, -10);
    }
    if (prg >= 220) {
      drawRR(ctx, 124, 2, 40, 14, 4, "rgba(245,158,11,0.2)", C.outline);
      ctx.fillStyle = "#b45309";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("→ менеджер", 144, 12);
    }
  };

  /* Слот human-in-the-loop */
  function HumanEscalationSlot() {}
  HumanEscalationSlot.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 210) return;
    drawRR(ctx, 118, 22, 52, 28, 6, "rgba(254,243,199,0.5)", C.outline);
    ctx.fillStyle = "#92400e";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("HITL review", 144, 38);
  };

  /* Орбита AI-модели */
  function ModelBrainOrb() {
    this.angle = 0;
  }
  ModelBrainOrb.prototype.draw = function (ctx) {
    this.angle += 0.018;
    var prg = (frame * 0.042) % 260;
    if (prg < 60) return;
    var ox = 55 + Math.cos(this.angle) * 22;
    var oy = -78 + Math.sin(this.angle) * 10;
    ctx.fillStyle = "rgba(121,242,255,0.35)";
    ctx.beginPath();
    ctx.arc(ox, oy, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.hubAccent;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.fillStyle = C.outline;
    ctx.font = "bold 5px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("GPT", ox, oy + 2);
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
    var prg = (frame * 0.042) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var hubTargets = {
      "1_architect": { x: -40, y: 55 },
      "2_seo": { x: 10, y: 62 },
      "3_coder": { x: 50, y: 62 },
      "4_designer": { x: 90, y: 55 },
      "5_deployer": { x: 25, y: 72 }
    };
    var tgt = hubTargets[this.role] || { x: 25, y: 60 };

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

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
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
    if (carryType) drawRR(ctx, -16 * faceDir, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var dock = new ChannelIngressDock();
  var stream = new WorkflowBezierStream();
  var bridge = new MakeN8nBridge();
  var hub = new AgentOrchestratorHub();
  var crm = new CrmDealTicker();
  var hitl = new HumanEscalationSlot();
  var orb = new ModelBrainOrb();

  entities.push(dock);
  entities.push(stream);
  entities.push(bridge);
  entities.push(hub);
  entities.push(crm);
  entities.push(hitl);
  entities.push(orb);
  entities.push(new Agent(-120, 78, C.agentYellow, "1_architect", 22, [
    "Карта no-code AI", "Триггер Telegram", "Сценарий за 2 недели"
  ]));
  entities.push(new Agent(-55, 85, C.agentGreen, "2_seo", 72, [
    "Квалификация лида", "Поля CRM из диалога", "LSI в промпте"
  ]));
  entities.push(new Agent(10, 88, C.agentBlue, "3_coder", 122, [
    "Webhook Make", "n8n AI node", "JSON → amoCRM"
  ]));
  entities.push(new Agent(75, 85, C.agentPink, "4_designer", 172, [
    "Tone of voice бота", "Шаблон КП", "FAQ из Notion"
  ]));
  entities.push(new Agent(135, 78, C.agentPurple, "5_deployer", 222, [
    "Запуск без кода", "Human-in-the-loop", "Метрики с дня 1"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 220, maxLife: life || 220 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.042) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(-130, -30, "1. Триггер из Telegram");
    if (prg >= 78 && prg < 78.05) createBubble(-50, 20, "2. Make связывает блоки");
    if (prg >= 128 && prg < 128.05) createBubble(30, -20, "3. AI квалифицирует");
    if (prg >= 178 && prg < 178.05) createBubble(90, 10, "4. Карточка в CRM");
    if (prg >= 228 && prg < 228.05) createBubble(140, -10, "5. Эскалация человеку");

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
  document.querySelectorAll('.ncai-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.parentElement,isOpen=item.classList.contains('open');
      document.querySelectorAll('.ncai-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.ncai-faq-q');if(q)q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){item.classList.add('open');btn.setAttribute('aria-expanded','true');}
    });
    btn.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}});
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root=document.querySelector('.ncai-content');
  if(!root)return;
  var items=root.querySelectorAll('.nero-ai-reveal');
  if('IntersectionObserver'in window){
    var observer=new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){entry.target.classList.add('nero-ai-active');observer.unobserve(entry.target);}
      });
    },{threshold:0.1,rootMargin:'0px 0px -6% 0px'});
    items.forEach(function(item){observer.observe(item);});
  }else{items.forEach(function(item){item.classList.add('nero-ai-active');});}
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

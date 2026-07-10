<?php
/**
 * Template Name: AI-агент для ответов на отзывы: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-агента для ответов на отзывы в Яндекс, 2ГИС и на маркетплейсах.
 */

$page_seo_title       = 'AI-агент для ответов на отзывы: внедрение под ключ';
$page_seo_description = 'Внедрение AI-агента для ответов на отзывы в Яндекс, 2ГИС и на маркетплейсах. Классификация, тон бренда, эскалация спорных случаев. Цена, кейсы, демо.';

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
    ['label' => 'Площадки',   'href' => '#ploshchadki'],
    ['label' => 'Внедрение',  'href' => '#etapy'],
    ['label' => 'Кейсы',      'href' => '#keisy'],
    ['label' => 'Стоимость',  'href' => '#ceny'],
    ['label' => 'FAQ',        'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить репутацию';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#';

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
/* vnaotz-hero-reviews — самодостаточный hero, канон главной meta-journal.ru */
.vnaotz-hero-reviews {
  --vnaotz-cyan: #79f2ff;
  --vnaotz-violet: #8b5cf6;
  --vnaotz-green: #22c55e;
  --vnaotz-amber: #fbbf24;
  --vnaotz-red: #fb7185;
  --vnaotz-text: #e6edf7;
  --vnaotz-muted: #9aa8bd;
  --vnaotz-soft: #c7d2e5;
  --vnaotz-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnaotz-hero-reviews.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnaotz-hero-reviews::before {
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
.vnaotz-hero-reviews::after {
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
  animation: vnaotzHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnaotzHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vnaotz-hero-reviews .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnaotz-hero-reviews .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnaotz-hero-reviews .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnaotz-hero-reviews .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnaotz-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnaotz-hero-reviews .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnaotz-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnaotz-hero-reviews .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnaotz-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnaotz-hero-reviews .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnaotz-hero-reviews .nero-ai-badge {
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
.vnaotz-hero-reviews .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnaotz-hero-reviews .nero-ai-btn {
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
.vnaotz-hero-reviews .nero-ai-btn:hover { transform: translateY(-2px); }
.vnaotz-hero-reviews .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnaotz-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnaotz-hero-reviews .nero-ai-btn-secondary {
  color: var(--vnaotz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnaotz-hero-reviews .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnaotz-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnaotz-hero-reviews .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnaotz-hero-reviews .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnaotz-hero-reviews .nero-ai-dots { display: flex; gap: 7px; }
.vnaotz-hero-reviews .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnaotz-hero-reviews .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnaotz-hero-reviews .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnaotz-hero-reviews .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnaotz-hero-reviews .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnaotz-hero-reviews .nero-ai-window-body { padding: 16px; }
.vnaotz-hero-reviews .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vnaotz-hero-reviews .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnaotz-hero-reviews .nero-ai-live-pill {
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
.vnaotz-hero-reviews .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnaotzPulse 1.6s infinite;
}
@keyframes vnaotzPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnaotz-hero-reviews .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnaotz-hero-reviews .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease;
}
.vnaotz-hero-reviews .nero-ai-metric:hover {
  transform: translateY(-2px);
  border-color: rgba(121,242,255,.28);
}
.vnaotz-hero-reviews .nero-ai-metric span {
  display: block;
  color: var(--vnaotz-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnaotz-hero-reviews .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnaotz-hero-reviews .nero-ai-metric small {
  display: block;
  margin-top: 5px;
  color: #9fb0c9;
  font-size: 10px;
}
.vnaotz-hero-reviews .vnaotz-dash-canvas-wrap {
  position: relative;
  height: 200px;
  margin: 10px 0 12px;
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.08);
  background: linear-gradient(180deg, rgba(8,12,28,.9), rgba(4,8,20,.95));
}
.vnaotz-hero-reviews #vnaotz-reputation-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.vnaotz-hero-reviews .nero-ai-task-stream { display: grid; gap: 8px; }
.vnaotz-hero-reviews .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  animation: vnaotzTaskFloat 5s ease-in-out infinite;
}
.vnaotz-hero-reviews .nero-ai-task:nth-child(2) { animation-delay: .6s; }
.vnaotz-hero-reviews .nero-ai-task:nth-child(3) { animation-delay: 1.2s; }
.vnaotz-hero-reviews .nero-ai-task:nth-child(4) { animation-delay: 1.8s; }
@keyframes vnaotzTaskFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-3px); }
}
.vnaotz-hero-reviews .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vnaotz-cyan);
  font-size: 13px;
  font-weight: 800;
}
.vnaotz-hero-reviews .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnaotz-hero-reviews .nero-ai-task span {
  color: var(--vnaotz-muted);
  font-size: 11px;
}
.vnaotz-hero-reviews .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnaotz-hero-reviews .nero-ai-status--amber {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
.vnaotz-hero-reviews .nero-ai-status--red {
  background: rgba(251,113,133,.12);
  color: #fecdd3;
}
@media (max-width: 900px) {
  .vnaotz-hero-reviews .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnaotz-hero-reviews .nero-ai-dashboard { transform: none; }
}

.vnaotz-hero-reviews.nero-ai-hero{min-height:100vh;min-height:100dvh;position:relative;}

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

.ym-cta-block--primary{background:linear-gradient(135deg,rgba(121,242,255,.14),rgba(139,92,246,.12));border-color:rgba(121,242,255,.35)}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3)}
.ym-link--accent{color:var(--vna-accent)!important;text-decoration:underline!important}

</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-otvety-na-otzyvy-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnaotz-hero-reviews" id="hero" aria-labelledby="vnaotz-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai отзывы</p>
      <h1 id="vnaotz-hero-title">AI-агент для ответов на отзывы: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Классифицируем отзывы, отвечаем в тоне бренда на Яндекс, 2ГИС и маркетплейсах — спорные случаи передаём менеджеру</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Яндекс · 2ГИС · WB/Ozon</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить репутацию</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-агент для ответов на отзывы">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Репутация · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Отзывы без ответа</span>
              <strong>12</strong>
              <small>из 47 за неделю</small>
            </div>
            <div class="nero-ai-metric">
              <span>Среднее время</span>
              <strong>38 сек</strong>
              <small>генерация черновика</small>
            </div>
            <div class="nero-ai-metric">
              <span>Покрытие</span>
              <strong>94%</strong>
              <small>ответов / skip</small>
            </div>
            <div class="nero-ai-metric">
              <span>Негатив в очереди</span>
              <strong>3</strong>
              <small>эскалация менеджеру</small>
            </div>
          </div>

          <div class="vnaotz-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnaotz-reputation-canvas" role="img" aria-label="Анимация: отзывы с площадок классифицируются, получают ответ в тоне бренда или эскалируются менеджеру"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий репутации">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">★</span>
              <div><strong>Яндекс: 5★ «Отличный сервис»</strong><span>Тон: позитив · автоответ</span></div>
              <span class="nero-ai-status">опубликован</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">2G</span>
              <div><strong>2ГИС: вопрос о парковке</strong><span>Класс: нейтрал · ToV черновик</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">WB</span>
              <div><strong>Wildberries: 2★ брак упаковки</strong><span>Risk score 0.87 · human-in-the-loop</span></div>
              <span class="nero-ai-status nero-ai-status--red">эскалация</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↗</span>
              <div><strong>Ozon: ответ отправлен в API</strong><span>Модерация площадки · ожидание</span></div>
              <span class="nero-ai-status">модерация</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====================================================
     КОНТЕНТНАЯ ЧАСТЬ (НЕ HERO) — Борис / vna-content
     Вставить в main#primary после hero Алины
     ==================================================== -->
<div class="vna-content">

  <!-- INTRO -->
  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai ответы на отзывы</p>
          <p><strong>Определение:</strong> AI-агент для ответов на отзывы — связка мониторинга площадок, классификации по тональности и риску, генерации ответа в tone of voice бренда и публикации через официальные API либо передачи спорного случая менеджеру. Nero Network внедряет таких агентов под ключ: от аудита репутации до интеграции с CRM и Telegram.</p>
          <p>Отзывы давно перестали быть «приятным бонусом». По данным ADPASS и BrightLocal (2026), <strong>97% потребителей</strong> читают отзывы перед покупкой. На маркетплейсах, по исследованию Ozon и Retail.ru (май 2026), <strong>70% россиян</strong> считают отзывы решающим фактором. При этом у ресторана, клиники, салона или селлера отзывы сыпятся сразу с нескольких площадок — а отвечать вручную на всё физически некому.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые показатели">
          <div class="vna-kpi-card">
            <div class="kv">97%</div>
            <div class="kl">читают отзывы перед покупкой</div>
            <div class="ks">ADPASS / BrightLocal 2026</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">70%</div>
            <div class="kl">рейтинг решает на маркетплейсах</div>
            <div class="ks">Ozon / Retail.ru 2026</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">86%</div>
            <div class="kl">меняют решение из-за отзывов</div>
            <div class="ks">AMDG × RQ</div>
          </div>
          <div class="vna-kpi-card">
            <div class="kv">7,6%</div>
            <div class="kl">конверсия после блока отзывов</div>
            <div class="ks">PowerReviews</div>
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
        <a href="#zachem">Зачем AI</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#ploshchadki">Площадки</a>
        <a href="#etapy">Внедрение</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#riski">Риски</a>
        <a href="#faq">FAQ</a>
        <a href="#cta-final">Проверить репутацию</a>
      </nav>
    </div>
  </div>

  <!-- H2: Зачем -->
  <section class="vna-section" id="zachem">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Боль и ROI</span>
        <h2>Зачем бизнесу AI-агент для ответов на отзывы</h2>
        <p>Если отзывы остаются без ответа, падает доверие, рейтинг и конверсия. AI-агент закрывает разрыв между объёмом обратной связи и ресурсом команды.</p>
      </div>

      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card" id="bez-otveta">
          <h3>Что происходит, когда отзывы остаются без ответа</h3>
          <p>Менеджер отвечает на Яндекс.Картах, но забывает про 2ГИС; селлер тонет в потоке WB, а Ozon копит необработанные отзывы. Клиент видит молчание бренда и читает это как безразличие.</p>
          <p>Негатив без реакции закрепляется в карточке; позитив без благодарности не работает на лояльность; нейтральные вопросы остаются без ответа — и следующий покупатель не находит информации.</p>
        </div>
        <div class="vna-card nero-ai-delay-1">
          <h3>Как AI влияет на рейтинг и доверие клиентов</h3>
          <p>AI не «рисует» пятую звезду — он обеспечивает <strong>регулярность и качество реакции</strong>. Практический эффект: 100% покрытие, единый тон бренда, приоритизация негатива, аналитика повторяющихся жалоб.</p>
          <p>В кейсе Epsilon Metrics своевременные ответы выросли с <strong>30–40% до 90+%</strong>, время реакции — с минут до <strong>20–40 секунд</strong> на генерацию черновика.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2: Как работает -->
  <section class="vna-section vna-section-alt" id="kak-rabotaet">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Технология</span>
        <h2>Как работает AI-агент: классификация, тон бренда, human-in-the-loop</h2>
        <p><strong>Определение human-in-the-loop:</strong> AI готовит и частично публикует ответы, но спорные, медицинские и юридические случаи обязательно проходят через человека.</p>
      </div>

      <div class="vna-card nero-ai-reveal" id="klassifikaciya">
        <h3 style="font-size:19px;margin-bottom:14px;">Классификация отзывов: позитив, нейтрал, негатив, спорные</h3>
        <div class="vna-table-wrap">
          <table class="vna-table">
            <thead>
              <tr><th>Категория</th><th>Признаки</th><th>Маршрут</th></tr>
            </thead>
            <tbody>
              <tr><td>Позитив (4–5★)</td><td>благодарность, рекомендация</td><td>автоответ или быстрый approve</td></tr>
              <tr><td>Нейтрал (3★, вопрос)</td><td>уточнение, смешанная оценка</td><td>черновик → approve в Telegram</td></tr>
              <tr><td>Негатив (1–2★)</td><td>претензия к качеству, сервису</td><td>эскалация менеджеру</td></tr>
              <tr><td>Юридический / медицинский</td><td>ПДн, диагнозы, угрозы</td><td>только человек</td></tr>
              <tr><td>Подозрение на накрутку</td><td>шаблонный текст, аномалии</td><td>черновик жалобы на площадку</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="vna-card">
          <h3>Генерация ответа в тоне бренда</h3>
          <p>Генератор работает поверх RAG-базы: регламенты, FAQ, скрипты негатива, 10–20 эталонных ответов. Промпт учитывает лимит символов площадки и стоп-слова.</p>
          <p>Для РФ рекомендуем <strong>YandexGPT</strong> или <strong>GigaChat</strong> — данные в юрисдикции РФ, согласование с <strong>152-ФЗ</strong>.</p>
        </div>
        <div class="vna-card nero-ai-delay-1">
          <h3>Когда AI отвечает сам, а когда передаёт менеджеру</h3>
          <p>На старте — <strong>две недели премодерации</strong> всех ответов. Далее: авто для 4–5★ и типовых вопросов; 1–3★ с претензией, угрозы, медицина — <strong>только менеджер</strong>.</p>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal" style="margin-top:24px;" id="pipeline-7">
        <h3 style="font-size:19px;margin-bottom:16px;">Семишаговый пайплайн Nero Network</h3>
        <div class="vna-timeline">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>1. Триггер</h3><p>Webhook или polling API, email-уведомление Яндекс Бизнес.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>2. Нормализация</h3><p>Единая карточка отзыва: площадка, рейтинг, текст, филиал/SKU.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>3. Классификация</h3><p>Тональность + тема + risk score.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>4. Генерация</h3><p>Текст в ToV с учётом лимитов площадки.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>5. Ветвление</h3><p>Низкий risk → автопубликация; высокий → черновик в Telegram/CRM.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>6. Публикация</h3><p>Только официальный API; лог статуса модерации.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>7. Аналитика</h3><p>Покрытие, SLA, топ-жалобы, динамика рейтинга.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================
       БОРИС: визуальный блок (НЕ hero)
       ================================================ -->
  <section id="vnedrenie-ai-otvety-boris-block" class="vot-root" aria-label="Демо: отзыв проходит классификацию, генерацию ответа и ветвление на автоответ или эскалацию">
<style>
/* === БОРИС: prefix vot-, scoped внутри #vnedrenie-ai-otvety-boris-block === */
#vnedrenie-ai-otvety-boris-block.vot-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnedrenie-ai-otvety-boris-block .vot-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-otvety-boris-block .vot-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-ai-otvety-boris-block .vot-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-otvety-boris-block .vot-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-otvety-boris-block .vot-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-otvety-boris-block .vot-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0ea5e9;
  margin:0 0 14px;
}
#vnedrenie-ai-otvety-boris-block .vot-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0ea5e9;
  border-radius:1px;
}
#vnedrenie-ai-otvety-boris-block .vot-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-ai-otvety-boris-block .vot-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-otvety-boris-block .vot-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-otvety-boris-block .vot-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(14,165,233,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0369a1;
  margin-top:1px;
  font-style:normal;
}
#vnedrenie-ai-otvety-boris-block .vot-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnedrenie-ai-otvety-boris-block .vot-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-otvety-boris-block .vot-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-otvety-boris-block .vot-pl-o{
  background:rgba(249,115,22,.08);
  color:#c2410c;
  border:1.5px solid rgba(249,115,22,.22);
}
#vnedrenie-ai-otvety-boris-block .vot-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#vnedrenie-ai-otvety-boris-block .vot-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-otvety-boris-block .vot-rgt{
  position:relative;
  background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 35%,#fef3c7 70%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-otvety-boris-block .vot-rgt{min-height:380px;}
}
#vot-reviews-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="vot-cnt">
  <div class="vot-card">
    <div class="vot-lft">
      <span class="vot-ey">Демо ответов</span>
      <h3 class="vot-h3">Один отзыв — классификация, ToV и ветка: публикация или эскалация</h3>
      <ul class="vot-ul">
        <li><span class="vot-ic">1</span>Отзыв с Яндекс, 2ГИС или WB нормализуется в единую карточку</li>
        <li><span class="vot-ic">2</span>LLM определяет тональность, тему и risk score (юрид / мед / ПДн)</li>
        <li><span class="vot-ic">3</span>Генератор готовит ответ в tone of voice бренда с лимитом площадки</li>
        <li><span class="vot-ic">?</span>4–5★ и низкий risk → API; 1–3★ и спорные → Telegram менеджеру</li>
      </ul>
      <div class="vot-pills">
        <span class="vot-pl vot-pl-g">20–40 сек генерация</span>
        <span class="vot-pl vot-pl-o">human-in-the-loop</span>
        <span class="vot-pl vot-pl-b">Яндекс · 2ГИС · WB</span>
      </div>
      <p class="vot-foot">Дальше — правила и API каждой площадки →</p>
    </div>
    <div class="vot-rgt">
      <canvas
        id="vot-reviews-pipeline-canvas"
        aria-label="Анимация: отзывы с площадок проходят классификатор AI, генерацию ответа и ветвление на автопубликацию или эскалацию в Telegram"
        role="img"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('vot-reviews-pipeline-canvas');
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
    sky:'#0ea5e9', skyD:function(a){return 'rgba(14,165,233,'+a+')';},
    grn:'#22c55e', grnD:function(a){return 'rgba(34,197,94,'+a+')';},
    org:'#f97316', orgD:function(a){return 'rgba(249,115,22,'+a+')';},
    viol:'#8b5cf6', violD:function(a){return 'rgba(139,92,246,'+a+')';},
    txt:'#0f172a', muted:'#64748b',
    card:'#ffffff', cardBdr:'rgba(148,163,184,.35)',
    line:'rgba(100,116,139,.25)'
  };

  var PLATFORMS = [
    {label:'Яндекс', x:0.12, color:C.sky},
    {label:'2ГИС',   x:0.12, color:C.viol},
    {label:'WB',     x:0.12, color:C.org}
  ];

  var REVIEWS = [
    {plat:0, stars:5, text:'Отличный сервис!', route:'auto', delay:0},
    {plat:1, stars:3, text:'Долго ждали заказ', route:'draft', delay:90},
    {plat:2, stars:1, text:'Брак в упаковке', route:'esc', delay:180},
    {plat:0, stars:4, text:'Рекомендую клинику', route:'auto', delay:270},
    {plat:2, stars:5, text:'Быстрая доставка', route:'auto', delay:360}
  ];

  function starStr(n){
    var s = '';
    for (var i = 0; i < 5; i++) s += i < n ? '\u2605' : '\u2606';
    return s;
  }

  function drawRoundedRect(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    ctx.moveTo(x+r,y);
    ctx.arcTo(x+w,y,x+w,y+h,r);
    ctx.arcTo(x+w,y+h,x,y+h,r);
    ctx.arcTo(x,y+h,x,y,r);
    ctx.arcTo(x,y,x+w,y,r);
    ctx.closePath();
    if (fill){ ctx.fillStyle = fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  function drawNode(cx, cy, w, h, label, sub, color, pulse){
    var x = cx - w/2, y = cy - h/2;
    var glow = pulse ? color.replace(')',',.18)').replace('rgb','rgba').replace('#','') : null;
    if (pulse && typeof color === 'string' && color.charAt(0)==='#'){
      var r = parseInt(color.slice(1,3),16), g = parseInt(color.slice(3,5),16), b = parseInt(color.slice(5,7),16);
      ctx.shadowColor = 'rgba('+r+','+g+','+b+',.35)';
      ctx.shadowBlur = 18;
    }
    drawRoundedRect(x,y,w,h,10,C.card,C.cardBdr);
    ctx.shadowBlur = 0;
    ctx.fillStyle = color;
    ctx.font = 'bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(label, cx, cy - 4);
    if (sub){
      ctx.fillStyle = C.muted;
      ctx.font = '10px Inter,system-ui,sans-serif';
      ctx.fillText(sub, cx, cy + 12);
    }
  }

  function drawReviewCard(rx, ry, rw, rh, rev, alpha, offsetX){
    var x = rx + (offsetX || 0);
    ctx.globalAlpha = alpha;
    var platColor = [C.sky, C.viol, C.org][rev.plat];
    drawRoundedRect(x, ry, rw, rh, 8, C.card, C.cardBdr);
    ctx.fillStyle = platColor;
    ctx.font = 'bold 9px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(['Яндекс','2ГИС','WB'][rev.plat], x+8, ry+14);
    ctx.fillStyle = '#eab308';
    ctx.font = '10px Inter,system-ui,sans-serif';
    ctx.fillText(starStr(rev.stars), x+8, ry+28);
    ctx.fillStyle = C.txt;
    ctx.font = '10px Inter,system-ui,sans-serif';
  var txt = rev.text.length > 18 ? rev.text.slice(0,16)+'\u2026' : rev.text;
    ctx.fillText(txt, x+8, ry+42);
    ctx.globalAlpha = 1;
  }

  function loop(){
    frame++;
    ctx.clearRect(0,0,W,H);

    var pad = Math.min(W,H)*0.04;
    var leftX = pad + 50;
    var midX = W * 0.48;
    var rightAutoX = W * 0.78;
    var rightEscX = W * 0.78;
    var topY = H * 0.18;
    var classY = H * 0.48;
    var genY = H * 0.68;
    var outY = H * 0.82;

    /* platform labels */
    ctx.fillStyle = C.muted;
    ctx.font = 'bold 10px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('ПЛОЩАДКИ', pad, topY - 20);

    for (var pi = 0; pi < 3; pi++){
      var py = topY + pi * (H*0.11);
      drawNode(leftX, py, 72, 36, ['Яндекс','2ГИС','WB'][pi], '', [C.sky,C.viol,C.org][pi], false);
      ctx.strokeStyle = C.line;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.moveTo(leftX + 36, py);
      ctx.bezierCurveTo(leftX+80, py, midX-60, classY-20+pi*8, midX-55, classY);
      ctx.stroke();
    }

    var pulseClass = 0.5 + 0.5*Math.sin(frame*0.06);
    drawNode(midX, classY, 110, 44, 'Классификатор', 'тон + risk', C.viol, pulseClass > 0.85);

    ctx.strokeStyle = C.line;
    ctx.beginPath();
    ctx.moveTo(midX, classY+22);
    ctx.lineTo(midX, genY-22);
    ctx.stroke();

    drawNode(midX, genY, 100, 40, 'Генератор ToV', 'RAG + лимиты', C.sky, false);

    ctx.beginPath();
    ctx.moveTo(midX+50, genY);
    ctx.bezierCurveTo(midX+80, genY, rightAutoX-40, outY-30, rightAutoX-35, outY);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(midX+50, genY);
    ctx.bezierCurveTo(midX+80, genY+10, rightEscX-40, outY+20, rightEscX-35, outY+50);
    ctx.stroke();

    drawNode(rightAutoX, outY, 95, 38, 'API публикация', '4–5\u2605 авто', C.grn, false);
    drawNode(rightEscX, outY+50, 95, 38, 'Telegram', 'эскалация', C.org, frame%120<60);

    /* animated review cards */
    var cycle = 420;
    var t = frame % cycle;
    for (var ri = 0; ri < REVIEWS.length; ri++){
      var rev = REVIEWS[ri];
      var localT = (t - rev.delay + cycle) % cycle;
      if (localT < 0 || localT > 300) continue;
      var prog = localT / 300;
      var startY = topY + rev.plat * (H*0.11);
      var x, y, alpha = 1;
      if (prog < 0.35){
        var p = prog/0.35;
        x = leftX + 90 + p*(midX-leftX-100);
        y = startY + p*(classY-startY);
      } else if (prog < 0.65){
        var p = (prog-0.35)/0.3;
        x = midX - 10 + p*10;
        y = classY + p*(genY-classY);
      } else {
        var p = (prog-0.65)/0.35;
        var targetX = rev.route === 'esc' ? rightEscX-60 : rightAutoX-60;
        var targetY = rev.route === 'esc' ? outY+30 : outY-10;
        x = midX + 20 + p*(targetX-midX);
        y = genY + p*(targetY-genY);
        if (p > 0.85) alpha = 1 - (p-0.85)/0.15;
      }
      drawReviewCard(x, y-20, 88, 52, rev, alpha, 0);
    }

    /* legend */
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,system-ui,sans-serif';
    ctx.textAlign = 'right';
    ctx.fillText('human-in-the-loop \u00b7 официальный API', W-pad, H-pad);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
  </section>

  <!-- CTA 1: после kak-rabotaet -->
  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-kak-rabotaet">
      <div class="ym-cta-block__icon" aria-hidden="true">⭐</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Проверьте, сколько отзывов остаётся без ответа</p>
        <p class="ym-cta-block__sub">Бесплатный разбор 30 последних отзывов с Яндекс, 2ГИС и маркетплейсов: % без ответа, среднее время реакции, топ-жалобы и три демо-ответа в tone of voice вашего бренда.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить репутацию</a>
      </div>
    </div>
  </div>

  <!-- ПЛОЩАДКИ: обёртка -->
  <section class="vna-section" id="ploshchadki">
    <div class="vna-cnt">

      <section class="vna-section-alt" id="yandex" style="border-radius:var(--vna-r-lg);padding:clamp(48px,6vw,72px) 0;">
        <div class="vna-sh vna-left">
          <span class="vna-eyebrow">Яндекс · ai ответы на отзывы яндекс</span>
          <h2>Ответы на отзывы в Яндекс.Бизнес</h2>
          <p>AI ускоряет подготовку ответа; публикация проходит модерацию площадки (~3 дня в среднем).</p>
        </div>
        <div class="vna-grid-2 nero-ai-reveal">
          <div class="vna-card">
            <h3>Правила площадки, модерация и лимиты</h3>
            <ul>
              <li>один комментарий на отзыв — переписки нет;</li>
              <li>модерация ~3 дня, лимит <strong>2500 знаков</strong>;</li>
              <li>запрещены: телефон, email, оскорбления, ПДн, капслок;</li>
              <li>в кабинете видны последние <strong>600 отзывов</strong>.</li>
            </ul>
          </div>
          <div class="vna-card">
            <h3>Примеры автоответов для локального бизнеса</h3>
            <p><strong>Позитив, стоматология:</strong> «Анна, спасибо за тёплые слова о приёме у доктора Ивановой…»</p>
            <p><strong>Негатив → эскалация:</strong> AI не публикует сам — формирует черновик для менеджера в CRM.</p>
          </div>
        </div>
      </section>

      <section class="vna-section" id="dva-gis" style="padding:clamp(48px,6vw,72px) 0;">
        <div class="vna-sh vna-left">
          <span class="vna-eyebrow">2ГИС · ai ответы на отзывы 2гис</span>
          <h2>AI-ответы на отзывы в 2ГИС</h2>
          <p>Публичный Places API отдаёт <strong>только статистику</strong> — текстовые отзывы через API получить нельзя. Внедрение: партнёрский канал, полуавтомат или middleware — без эмуляции браузера.</p>
        </div>
        <div class="vna-grid-3 nero-ai-reveal">
          <div class="vna-card">
            <h3>Ресторан</h3>
            <p>Мониторинг Яндекс + 2ГИС, автопубликация позитива, эскалация негатива администратору точки.</p>
          </div>
          <div class="vna-card nero-ai-delay-1">
            <h3>Клиника</h3>
            <p>Отзывы с диагнозом или лечением — медицинская эскалация; AI готовит нейтральный черновик без медсоветов.</p>
          </div>
          <div class="vna-card nero-ai-delay-2">
            <h3>Салон</h3>
            <p>Быстрые ответы на 5★ с упоминанием мастера; на 1–2★ с жалобой на аллергию — к управляющему и юристу.</p>
          </div>
        </div>
      </section>

      <section class="vna-section-alt" id="marketplejsy" style="border-radius:var(--vna-r-lg);padding:clamp(48px,6vw,72px) 0;">
        <div class="vna-sh">
          <span class="vna-eyebrow">E-commerce · ai ответы на отзывы маркетплейс</span>
          <h2>Маркетплейсы: Wildberries, Ozon, Яндекс Маркет</h2>
        </div>
        <div class="vna-table-wrap nero-ai-reveal" style="margin-bottom:28px;">
          <table class="vna-table">
            <thead>
              <tr><th>Площадка</th><th>API ответов</th><th>Модерация</th><th>Ограничения</th></tr>
            </thead>
            <tbody>
              <tr><td>Wildberries</td><td>Да</td><td>Да</td><td>Встроенный AI в ЛК с 02.2026</td></tr>
              <tr><td>Ozon</td><td>Да (Premium Plus)</td><td>Да</td><td>~3000 символов, до 200 req/min</td></tr>
              <tr><td>Яндекс Маркет</td><td>Да</td><td>Да</td><td>Scope communication, webhook</td></tr>
            </tbody>
          </table>
        </div>
        <div class="vna-card nero-ai-reveal">
          <h3>Риски негатива и скорость реакции</h3>
          <p>Кейс «Сибирская Клетчатка»: рост от <strong>50 до 2000 отзывов/мес</strong>, <strong>10 000</strong> необработанных на Ozon до автоматизации. AI снимает рутину на 4–5★; негатив с претензией к безопасности — эскалация с готовым черновиком.</p>
        </div>
        <div class="vna-table-wrap nero-ai-reveal" style="margin-top:24px;">
          <table class="vna-table">
            <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы</th></tr></thead>
            <tbody>
              <tr><td>Встроенный AI WB</td><td>Бесплатно, быстрый старт</td><td>Только WB, шаблонная логика</td></tr>
              <tr><td>SaaS (Spix, Otveto)</td><td>Подключение за 10–20 мин</td><td>Мало кастомной эскалации</td></tr>
              <tr><td>Внедрение под ключ</td><td>Все площадки + CRM + своя логика</td><td>Проект 80–250 тыс. ₽, 2–6 недель</td></tr>
            </tbody>
          </table>
        </div>
      </section>

    </div>
  </section>

  <!-- H2: Внедрение -->
  <section class="vna-section vna-section-alt" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Внедрение · внедрение ai агентов</span>
        <h2>Внедрение под ключ: этапы, сроки, интеграции</h2>
        <p>Фиксированный проект с аудитом, настройкой агента, интеграциями и обучением команды — в отличие от SaaS-подписки 15–30 тыс. ₽/мес.</p>
      </div>

      <div class="vna-card nero-ai-reveal">
        <div class="vna-timeline">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Этап 0 — разбор 30 отзывов (лид-магнит)</h3><p>% без ответа, среднее время, топ негатива, три демо-ответа в ToV.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Этап 1 — подключение (1–2 недели)</h3><p>API WB/Ozon/Я.Маркет; Яндекс Бизнес OAuth; 2ГИС — согласованный канал; CRM — карточка эскалации.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Этап 2 — логика агента</h3><p>Классификация, маршрутизация, RAG, YandexGPT/GigaChat.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Этап 3 — запуск</h3><p>2 недели премодерации → расширение автономии AI. MVP — 2–3 недели, полный цикл — 4–6 недель.</p></div>
        </div>
      </div>

      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vna-card">
          <h3>Интеграция с CRM, уведомления и дашборд</h3>
          <p>amoCRM, Bitrix24 — задача «разобрать негатив»; Telegram approve/veto; Make.com, n8n; дашборд покрытия и SLA.</p>
        </div>
        <div class="vna-card nero-ai-delay-1">
          <h3>Внедрение без программиста</h3>
          <p>Клиент даёт доступы, ToV и регламенты; подрядчик настраивает коннекторы, классификатор, human-in-the-loop и дашборд.</p>
        </div>
      </div>

      <!-- CTA 2 -->
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите понимать логику агента до старта проекта?</p>
          <p class="ym-cta-block__sub">Если команда хочет разобраться в human-in-the-loop, промптах, n8n и интеграции с CRM до заказа внедрения — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>. Это ускоряет согласование сценариев эскалации и тона бренда.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- H2: Цена -->
  <section class="vna-section" id="ceny">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Цена и ROI · ai ответы на отзывы цена</span>
        <h2>Сколько стоит внедрение AI для ответов на отзывы</h2>
        <p>Ориентир Nero Network: <strong>80–250 тыс. ₽</strong> за проект под ключ.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3>Что входит в чек 80–250 тыс. ₽</h3>
          <ul>
            <li>аудит и разбор 30 последних отзывов;</li>
            <li>классификатор и генератор в ToV;</li>
            <li>коннекторы к площадкам по согласованию;</li>
            <li>human-in-the-loop: Telegram/CRM;</li>
            <li>2 недели премодерации и обучение;</li>
            <li>дашборд репутации на запуске.</li>
          </ul>
        </div>
        <div class="vna-card">
          <h3>ROI: рейтинг, конверсия, экономия времени</h3>
          <p>Экономия 60–80% рутинных ответов; покрытие с 30–40% до 90+%; конверсия после блока отзывов — 7,6% vs 3,4%. Окупаемость — ориентир <strong>3–6 месяцев</strong>.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2: Кейсы -->
  <section class="vna-section vna-section-alt" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Кейсы · ai ответы на отзывы кейсы</span>
        <h2>Кейсы и примеры внедрения</h2>
      </div>
      <div class="vna-case-grid nero-ai-reveal">
        <div class="vna-case-card">
          <div class="vna-case-tag">Локальный бизнес</div>
          <h3>Ресторан / клиника / салон</h3>
          <p>Мониторинг Яндекс + 2ГИС, позитив за минуты, негатив — в Telegram с черновиком.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">100%</span><span class="lbl">покрытие ответами</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Spix · Сибирская Клетчатка</div>
          <h3>WB и Ozon</h3>
          <p>6 мес. премодерации → 81% на ИИ; медвопросы — врачу.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">2000</span><span class="lbl">отзывов/мес</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Epsilon Metrics</div>
          <h3>Косметика · маркетплейсы</h3>
          <p>Единая лента, корпоративная база знаний, критичные — в R&D.</p>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">90+%</span><span class="lbl">своевременных ответов</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- H2: Риски -->
  <section class="vna-section" id="riski">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">E-E-A-T</span>
        <h2>Риски и ограничения: негатив, юридические формулировки, модерация</h2>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3>Когда нельзя публиковать автоответ без проверки</h3>
          <ul>
            <li>1–3★ с претензией к качеству и безопасности;</li>
            <li>персональные данные третьих лиц, угрозы;</li>
            <li>медицинские и юридические формулировки;</li>
            <li>обещания возврата и компенсации — решение менеджера;</li>
            <li>первые 2 недели — премодерация всех ответов.</li>
          </ul>
        </div>
        <div class="vna-card">
          <h3>Запреты площадок и этика</h3>
          <p><strong>Яндекс:</strong> без телефона, email, капслока. <strong>WB/Ozon:</strong> без ссылок и промокодов за отзыв. Только <strong>официальный API</strong> — без эмуляции браузера. <strong>152-ФЗ:</strong> YandexGPT/GigaChat для данных в РФ.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2: Заказать -->
  <section class="vna-section vna-section-alt" id="zakazat">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Заказать · ai ответы на отзывы заказать</span>
        <h2>Как заказать внедрение AI-агента для ответов на отзывы</h2>
        <p>Первый шаг — CTA «Проверить репутацию»: команда смотрит текущее состояние отзывов и готовит разбор.</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <h3>Лид-магнит: разбор 30 последних отзывов</h3>
        <ul>
          <li>сколько остались без ответа;</li>
          <li>среднее время реакции;</li>
          <li>топ-3 повторяющихся жалобы;</li>
          <li>три примера ответа в вашем tone of voice.</li>
        </ul>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Чек-лист подготовки к запуску</h3>
        <ol style="padding-left:20px;color:var(--vna-muted);line-height:1.72;">
          <li>Доступы к кабинетам площадок.</li>
          <li>10–20 лучших ответов менеджеров за год.</li>
          <li>Регламент: что обещать публично, что только в личке.</li>
          <li>Ответственный за эскалации (Telegram + CRM).</li>
          <li>Premium Plus на Ozon для API (если нужен Ozon).</li>
          <li>Список филиалов / SKU для контекста.</li>
          <li>2 недели на премодерацию в календаре запуска.</li>
        </ol>
      </div>

      <!-- CTA 3 -->
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы перестать терять репутацию в молчании?</p>
          <p class="ym-cta-block__sub">Начните с диагностики: разбор 30 отзывов, демо-ответы в вашем тоне, оценка сроков и бюджета 80–250 тыс. ₽ — без обязательств на полный проект.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить репутацию</a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Частые вопросы</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="vna-section" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">FAQ</span>
        <h2>Частые вопросы про AI-ответы на отзывы</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item" id="faq-kak-vnedrit">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai ответы на отзывы?</div>
          <div class="vna-faq-a"><p>Аудит → API площадок → классификатор и ToV → CRM/Telegram → 2 недели премодерации → расширение автономии AI. Nero Network — цикл под ключ за 2–6 недель.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-skolko">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит ai ответы на отзывы?</div>
          <div class="vna-faq-a"><p>Проектное внедрение — <strong>80–250 тыс. ₽</strong>. SaaS — от ~15 000 ₽/мес за точку, но без единого агента на карты + маркетплейсы + CRM.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-crm">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Нужна ли интеграция с CRM?</div>
          <div class="vna-faq-a"><p>Не обязательна для MVP, но рекомендуется при негативе и мультилокации: задачи на менеджера, история по филиалу.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-malyj-biznes">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли решение для малого бизнеса?</div>
          <div class="vna-faq-a"><p>Да, при стабильном потоке с 2+ площадок. Для одной точки с 5 отзывами в месяц достаточно SaaS; для клиники, ресторана или селлера с десятками отзывов в неделю — под ключ окупается быстрее.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-ban">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Забанят ли за автоответы?</div>
          <div class="vna-faq-a"><p>Нет, если публикация через <strong>официальный API</strong> и соблюдение правил модерации. Эмуляция браузера — главный риск бана.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-wb-ai">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">У Wildberries уже есть AI — зачем отдельный агент?</div>
          <div class="vna-faq-a"><p>Встроенный AI WB работает только внутри WB. Кастомный агент покрывает все площадки, CRM, мед/юрид эскалацию и корпоративную базу знаний.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-2gis">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как отвечать в 2ГИС без публичного API?</div>
          <div class="vna-faq-a"><p>Кабинет 2ГИС + полуавтомат (AI готовит черновик, человек публикует) или партнёрский канал. Не обещаем то, чего нет в открытом API.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-ozon-premium">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли Premium Plus на Ozon?</div>
          <div class="vna-faq-a"><p>Да, для Review API (<code>review.getList</code>, <code>review.createComment</code>) нужна подписка <strong>Premium Plus</strong> на Ozon.</p></div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.vna-content -->

<script>
/* FAQ accordion — вставить перед get_footer или в общий скрипт страницы */
document.addEventListener('DOMContentLoaded', function(){
  var root = document.querySelector('.vna-content');
  if (!root) return;
  root.querySelectorAll('.vna-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.vna-faq-item');
      if (!item) return;
      var wasOpen = item.classList.contains('open');
      root.querySelectorAll('.vna-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.vna-faq-q');
        if (q) q.setAttribute('aria-expanded','false');
      });
      if (!wasOpen){
        item.classList.add('open');
        btn.setAttribute('aria-expanded','true');
      }
    });
  });
});
</script>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- SCHEMA-MARKUP:INSERT -->

<script>
/**
 * vnaotz-reputation-engine — Диспетчерская репутации
 * Мир: рукава площадок → SentimentRing → ReputationResponseHub → публикация / эскалация
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnaotz-reputation-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 200;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 400, ch / 220) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    starGold: "#fbbf24",
    starEmpty: "#334155",
    posGreen: "#22c55e",
    negRed: "#fb7185",
    neuAmber: "#f59e0b",
    hubBase: "#1e293b",
    hubAccent: "#79f2ff",
    hubViolet: "#8b5cf6",
    replyCard: "#a7f3d0",
    platformYandex: "#fc3f1d",
    platform2gis: "#19aa1e",
    platformWb: "#cb11ab",
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

  function drawStar(ctx, x, y, size, filled, color) {
    ctx.save();
    ctx.translate(x, y);
    ctx.fillStyle = filled ? (color || C.starGold) : C.starEmpty;
    ctx.beginPath();
    for (var i = 0; i < 5; i++) {
      var a = (i * 4 * Math.PI) / 5 - Math.PI / 2;
      var r = i % 2 === 0 ? size : size * 0.42;
      var px = Math.cos(a) * r;
      var py = Math.sin(a) * r;
      if (i === 0) ctx.moveTo(px, py);
      else ctx.lineTo(px, py);
    }
    ctx.closePath();
    ctx.fill();
    if (filled) {
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 0.8;
      ctx.stroke();
    }
    ctx.restore();
  }

  /* Транспорт: дуговые рукава площадок сверху */
  function PlatformTributaryStreams() {
    this.phase = 0;
  }
  PlatformTributaryStreams.prototype.draw = function (ctx) {
    this.phase = (frame * 0.03) % (Math.PI * 2);
    var tributaries = [
      { x: -95, color: C.platformYandex, label: "Я", angle: -0.55 },
      { x: 0, color: C.platform2gis, label: "2G", angle: -1.57 },
      { x: 95, color: C.platformWb, label: "WB", angle: -2.6 }
    ];
    tributaries.forEach(function (t, idx) {
      ctx.save();
      ctx.strokeStyle = t.color + "55";
      ctx.lineWidth = 2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.moveTo(t.x, -95);
      ctx.quadraticCurveTo(t.x * 0.4, -35, 0, 5);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();

      var cardPhase = (this.phase + idx * 2.1) % (Math.PI * 2);
      var tNorm = (Math.sin(cardPhase) + 1) / 2;
      var px = t.x + (0 - t.x) * tNorm;
      var py = -95 + (5 - (-95)) * tNorm * tNorm;
      drawRR(ctx, px - 14, py - 10, 28, 20, 4, "rgba(255,255,255,0.92)", C.outline);
      for (var s = 0; s < 3; s++) drawStar(ctx, px - 8 + s * 8, py - 2, 3, s < (idx === 2 ? 2 : 3), C.starGold);
      ctx.fillStyle = t.color;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(t.label, px, py + 7);
    }, this);
  };

  /* Кольцо сканера тональности */
  function SentimentRingScanner() {
    this.pulse = 0;
  }
  SentimentRingScanner.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    this.pulse = Math.sin(frame * 0.08) * 0.15 + 0.85;
    ctx.strokeStyle = "rgba(121,242,255," + (0.25 * this.pulse) + ")";
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(0, -5, 52, 0, Math.PI * 2);
    ctx.stroke();

    if (prg >= 40 && prg < 100) {
      var scanAngle = ((prg - 40) / 60) * Math.PI * 2;
      ctx.strokeStyle = C.hubAccent;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, -5, 48, scanAngle - 0.4, scanAngle);
      ctx.stroke();
      var labels = ["позитив", "нейтрал", "негатив"];
      var li = Math.floor(((prg - 40) / 60) * 3) % 3;
      ctx.fillStyle = li === 2 ? C.negRed : li === 1 ? C.neuAmber : C.posGreen;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(labels[li], 0, -62);
    }
  };

  /* Центральный хаб ответа — вместо WebsiteTerminal */
  function ReputationResponseHub() {
    this.replyY = 0;
    this.publishRipple = 0;
  }
  ReputationResponseHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;

    drawRR(ctx, -48, -35, 96, 88, 10, C.hubBase, C.outline);

    /* Карточка отзыва */
    drawRR(ctx, -38, -28, 76, 28, 5, "rgba(255,255,255,0.1)", C.outline);
    for (var i = 0; i < 4; i++) drawStar(ctx, -30 + i * 10, -18, 3.5, i < 3, i < 2 ? C.negRed : C.starGold);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("«Долго ждали заказ…»", -32, -6);

    /* Фаза DRAFT — панель ToV */
    if (prg >= 100 && prg < 170) {
      var draftProg = (prg - 100) / 70;
      drawRR(ctx, -38, 2, 76, 22 * draftProg, 4, "rgba(167,243,208,0.2)", C.posGreen);
      if (draftProg > 0.4) {
        ctx.fillStyle = "#ecfdf5";
        ctx.font = "6px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText("Спасибо за обратную связь…", -32, 14);
      }
    }

    /* Фаза PUBLISH — ответ поднимается */
    if (prg >= 170) {
      var pubPrg = Math.min(1, (prg - 170) / 35);
      this.replyY = -28 - pubPrg * 55;
      drawRR(ctx, -30, this.replyY, 60, 18, 4, C.replyCard, C.posGreen);
      ctx.fillStyle = "#064e3b";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Ответ опубликован", 0, this.replyY + 11);

      if (prg > 195 && prg < 230) {
        this.publishRipple = (prg - 195) / 35;
        ctx.strokeStyle = "rgba(34,197,94," + (0.7 - this.publishRipple * 0.65) + ")";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(0, this.replyY + 9, 12 + this.publishRipple * 35, 0, Math.PI * 2);
        ctx.stroke();
        ctx.fillStyle = C.posGreen;
        ctx.font = "bold 8px Inter,sans-serif";
        ctx.fillText("+0.1★", 42, this.replyY - 4);
      }
    }

    /* Фаза ESCALATE — негатив уходит в красный коридор */
    if (prg >= 55 && prg < 95 && prg % 260 < 95) {
      var escPrg = (prg - 55) / 40;
      var ex = 38 + escPrg * 55;
      var ey = -10 + escPrg * 15;
      drawRR(ctx, ex - 10, ey - 8, 20, 16, 3, "rgba(251,113,133,0.35)", C.negRed);
      drawStar(ctx, ex, ey, 4, false, C.negRed);
    }
  };

  /* Боковой коридор эскалации */
  function EscalationRedLane() {
    this.blink = 0;
  }
  EscalationRedLane.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    drawRR(ctx, 108, -20, 28, 70, 6, "rgba(251,113,133,0.12)", C.negRed);
    ctx.fillStyle = C.negRed;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("HITL", 122, -8);
    ctx.fillText("менеджер", 122, 2);

    if (prg > 70 && prg < 110) {
      this.blink = Math.sin(frame * 0.2) * 0.3 + 0.7;
      ctx.fillStyle = "rgba(251,113,133," + this.blink + ")";
      ctx.beginPath();
      ctx.arc(122, 25, 5, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("!", 122, 27);
    }
  };

  /* Таймер модерации площадки */
  function ModerationTimer() {
    this.days = 3;
  }
  ModerationTimer.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    if (prg < 170) return;
    drawRR(ctx, -118, -55, 44, 16, 4, "rgba(255,255,255,0.06)", C.outline);
    ctx.fillStyle = C.neuAmber;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("модерация ~" + this.days + "д", -96, -44);
  };

  /* Колонка бейджей площадок */
  function PlatformBadgeColumn() {
    this.highlight = 0;
  }
  PlatformBadgeColumn.prototype.draw = function (ctx) {
    var badges = [
      { x: -115, y: 30, c: C.platformYandex, t: "Я" },
      { x: -115, y: 52, c: C.platform2gis, t: "2G" },
      { x: -115, y: 74, c: C.platformWb, t: "WB" }
    ];
    var prg = (frame * 0.045) % 260;
    var active = prg >= 170 ? Math.floor((prg - 170) / 20) % 3 : -1;
    badges.forEach(function (b, i) {
      drawRR(ctx, b.x, b.y, 22, 16, 4, i === active ? b.c + "44" : "rgba(255,255,255,0.06)", b.c);
      ctx.fillStyle = b.c;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.t, b.x + 11, b.y + 11);
    });
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
    var prg = (frame * 0.045) % 260;
    var isMoving = false;
    var hubSeats = {
      "1_architect": { x: -75, y: 58 },
      "2_seo": { x: -25, y: 68 },
      "3_coder": { x: 25, y: 68 },
      "4_designer": { x: 75, y: 58 },
      "5_deployer": { x: 0, y: 78 }
    };
    var tgt = hubSeats[this.role] || { x: 0, y: 65 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 20) {
      var local = prg - this.stepTrig;
      if (local < 10) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 10);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 10);
      } else if (local < 14) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 14) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 14) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 200);
    }

    var bob = Math.sin(this.timer * 1.4) * 1;
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 5.5;
      legL = Math.sin(wp) * 3.5;
      legR = Math.sin(wp + Math.PI) * 3.5;
    }
    drawRR(ctx, -7, -3 + Math.max(0, legL), 6, 10, 2, C.outline, null);
    drawRR(ctx, 1, -3 + Math.max(0, legR), 6, 10, 2, C.outline, null);
    drawRR(ctx, -10, -9 - bob, 20, 14, 4, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -20 - bob, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new PlatformTributaryStreams());
  entities.push(new PlatformBadgeColumn());
  entities.push(new SentimentRingScanner());
  entities.push(new ReputationResponseHub());
  entities.push(new EscalationRedLane());
  entities.push(new ModerationTimer());
  entities.push(new Agent(-130, 92, C.agentYellow, "1_architect", 12, [
    "Порог эскалации 0.8", "ToV из 20 эталонов", "Аудит 30 отзывов"
  ]));
  entities.push(new Agent(-65, 98, C.agentGreen, "2_seo", 48, [
    "Тон: негатив 2★", "Тема: доставка", "Risk score 0.87"
  ]));
  entities.push(new Agent(0, 100, C.agentBlue, "3_coder", 92, [
    "Лимит 2500 знаков", "Без телефона в ответе", "YandexGPT + RAG"
  ]));
  entities.push(new Agent(65, 98, C.agentPink, "4_designer", 128, [
    "Тон бренда: тёплый", "Персонализация по филиалу", "Стоп-слова площадки"
  ]));
  entities.push(new Agent(130, 92, C.agentPurple, "5_deployer", 178, [
    "POST answer → WB API", "Telegram: черновик", "Модерация ~3 дня"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 200, maxLife: life || 200 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.045) % 260;
    if (prg >= 8 && prg < 8.05) createBubble(-80, -70, "1. Отзыв с Яндекс");
    if (prg >= 52 && prg < 52.05) createBubble(-20, -50, "2. Классификация тона");
    if (prg >= 108 && prg < 108.05) createBubble(10, 0, "3. Черновик в ToV");
    if (prg >= 72 && prg < 72.05) createBubble(100, 10, "Негатив → менеджеру");
    if (prg >= 185 && prg < 185.05) createBubble(0, -40, "4. Ответ опубликован");
    if (prg >= 215 && prg < 215.05) createBubble(50, -60, "5. Рейтинг +0.1★");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 18, tw, 16, 4, C.bubbleBg, C.hubAccent);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 8);
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

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

<?php
/**
 * Template Name: AI-наставник для адаптации сотрудников — внедрение под ключ
 * Description: SEO-лендинг — AI-наставник для адаптации новых сотрудников. RAG, кейсы, этапы, цены.
 */

$page_seo_title       = 'AI-наставник для адаптации сотрудников — внедрение под ключ';
$page_seo_description = 'Внедрим AI-наставника для адаптации новых сотрудников: ответы по регламентам, продуктам и процессам 24/7. Снимаем нагрузку с наставников, ускоряем выход на продуктивность. Демо и карта адаптации.';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
	$parts['title'] = $page_seo_title;
	return $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description ): void {
	echo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";
	echo '<meta property="og:type" content="article" />' . "\n";
}, 1 );

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать AI-наставника';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

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
/* === АЛИНА: hero ai-nastavnik === */
/* === АЛИНА: hero ai-nastavnik, prefix vna-hero-onboard — самодостаточные стили === */
.vna-hero-onboard {
  --vna-bg: #050711;
  --vna-cyan: #79f2ff;
  --vna-violet: #8b5cf6;
  --vna-green: #22c55e;
  --vna-muted: #9aa8bd;
  --vna-btn-from: #2563eb;
  --vna-btn-to: #7c3aed;
  padding: clamp(108px, 14vh, 148px) 0 clamp(64px, 8vw, 80px);
  background:
    radial-gradient(ellipse 75% 55% at 72% 18%, rgba(121, 242, 255, 0.14), transparent 58%),
    radial-gradient(ellipse 55% 45% at 8% 82%, rgba(139, 92, 246, 0.12), transparent 55%),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
  color: #e6edf7;
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  position: relative;
  overflow: hidden;
}
.vna-hero-onboard *,
.vna-hero-onboard *::before,
.vna-hero-onboard *::after { box-sizing: border-box; }
.vna-hero-onboard .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
}
.vna-hero-onboard .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1fr) minmax(0, 1.08fr);
  gap: clamp(28px, 5vw, 56px);
  align-items: center;
}
.vna-hero-onboard .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  border: 1px solid rgba(121, 242, 255, 0.22);
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--vna-cyan);
  margin: 0 0 16px;
}
.vna-hero-onboard h1 {
  margin: 0 0 18px;
  font-size: clamp(32px, 4.8vw, 54px);
  font-weight: 800;
  line-height: 1.08;
  letter-spacing: -0.03em;
  color: #fff;
}
.vna-hero-onboard .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vna-cyan) 44%, var(--vna-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vna-hero-onboard .nero-ai-hero-lead {
  margin: 0 0 22px;
  max-width: 640px;
  font-size: clamp(16px, 1.9vw, 19px);
  line-height: 1.62;
  color: var(--vna-muted);
}
.vna-hero-onboard .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 26px;
  padding: 0;
  list-style: none;
}
.vna-hero-onboard .nero-ai-badge {
  padding: 8px 14px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.12);
  color: #c7d2e5;
}
.vna-hero-onboard .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}
.vna-hero-onboard .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 13px 26px;
  border-radius: 999px;
  font-size: 15px;
  font-weight: 700;
  text-decoration: none !important;
  transition: transform 0.2s, box-shadow 0.2s;
}
.vna-hero-onboard .nero-ai-btn-primary {
  background: linear-gradient(135deg, var(--vna-btn-from), var(--vna-btn-to));
  color: #fff !important;
  box-shadow: 0 8px 32px rgba(59, 130, 246, 0.35);
}
.vna-hero-onboard .nero-ai-btn-secondary {
  background: transparent;
  color: #e2e8f0 !important;
  border: 1px solid rgba(255, 255, 255, 0.16);
}
.vna-hero-onboard .nero-ai-btn:hover { transform: translateY(-2px); }
.vna-hero-onboard .nero-ai-dashboard {
  padding: 14px;
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(255, 255, 255, 0.09), rgba(255, 255, 255, 0.04));
  border: 1px solid rgba(255, 255, 255, 0.12);
  box-shadow: 0 24px 72px rgba(0, 0, 0, 0.45);
  backdrop-filter: blur(16px);
}
.vna-hero-onboard .nero-ai-dashboard-shell {
  border-radius: 20px;
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(6, 10, 24, 0.85);
}
.vna-hero-onboard .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.03);
}
.vna-hero-onboard .nero-ai-dots { display: flex; gap: 6px; }
.vna-hero-onboard .nero-ai-dot {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(255, 255, 255, 0.18);
}
.vna-hero-onboard .nero-ai-dot:first-child { background: #f87171; }
.vna-hero-onboard .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vna-hero-onboard .nero-ai-dot:nth-child(3) { background: #4ade80; }
.vna-hero-onboard .nero-ai-window-title {
  font-size: 11px;
  color: #64748b;
  font-weight: 750;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}
.vna-hero-onboard .nero-ai-window-body { padding: 16px; }
.vna-hero-onboard .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vna-hero-onboard .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vna-hero-onboard .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.1);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.vna-hero-onboard .nero-ai-live-pill::before {
  content: "";
  width: 7px; height: 7px; border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.14);
  animation: vnaHeroPulse 1.6s infinite;
}
@keyframes vnaHeroPulse {
  0%, 100% { transform: scale(0.86); opacity: 0.65; }
  50% { transform: scale(1); opacity: 1; }
}
.vna-hero-onboard .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vna-hero-onboard .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255, 255, 255, 0.09);
  border-radius: 16px;
  background: rgba(255, 255, 255, 0.055);
}
.vna-hero-onboard .nero-ai-metric span {
  display: block;
  color: var(--vna-muted);
  font-size: 11px;
  font-weight: 700;
}
.vna-hero-onboard .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vna-hero-onboard .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vna-hero-onboard .vna-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 42%, rgba(121, 242, 255, 0.08), rgba(6, 10, 24, 0.92) 72%);
}
.vna-hero-onboard #vna-onboard-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vna-hero-onboard .vna-hero-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 12px;
}
.vna-hero-onboard .vna-hero-pill {
  padding: 6px 12px;
  border-radius: 999px;
  font-size: 11px;
  font-weight: 700;
  background: rgba(121, 242, 255, 0.08);
  border: 1px solid rgba(121, 242, 255, 0.2);
  color: #a5f3fc;
}
.vna-hero-onboard .nero-ai-task-stream { display: grid; gap: 8px; }
.vna-hero-onboard .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.04);
}
.vna-hero-onboard .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px; height: 28px;
  border-radius: 12px;
  background: rgba(121, 242, 255, 0.12);
  color: var(--vna-cyan);
  font-size: 13px;
  font-weight: 800;
}
.vna-hero-onboard .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vna-hero-onboard .nero-ai-task span {
  color: var(--vna-muted);
  font-size: 11px;
}
.vna-hero-onboard .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vna-hero-onboard .nero-ai-status--amber {
  background: rgba(245, 158, 11, 0.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vna-hero-onboard .nero-ai-hero-grid { grid-template-columns: 1fr; }
}
@media (max-width: 520px) {
  .vna-hero-onboard .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vna-hero-onboard .nero-ai-window-body { padding: 12px; }
  .vna-hero-onboard .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vna-hero-onboard .nero-ai-status { grid-column: 2; width: fit-content; }
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
/* Hero full viewport */
.vna-hero-onboard.nero-ai-hero{min-height:100vh;min-height:100dvh;position:relative;display:grid;align-items:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-link--accent{color:var(--vna-accent)!important;text-decoration:underline!important}
.vna-compare-wrap{border:1px solid rgba(121,242,255,.2)}
.vna-compare th.col-ai,.vna-compare td.col-ai{background:rgba(121,242,255,.08);box-shadow:inset 0 0 24px rgba(121,242,255,.06)}
.vna-compare td.col-ai strong{color:var(--vna-accent)}
.vna-roi-num{color:var(--vna-accent);font-weight:900}
.vna-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vna-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vna-accent);border:1px solid rgba(121,242,255,.2)}
.vna-flow .arr{color:var(--vna-muted);font-size:16px;padding:0 4px;background:none;border:none}
.vna-risk-card{border:1px solid rgba(251,191,36,.25)!important;background:rgba(251,191,36,.05)!important}
.vna-leadmag{display:flex;gap:20px;align-items:flex-start;padding:24px;border-radius:20px;border:1px solid rgba(121,242,255,.25);background:rgba(121,242,255,.06);margin-top:24px}
.vna-leadmag-icon{font-size:32px;flex-shrink:0}
.vna-etapy-table tr.row-pilot td{background:rgba(34,197,94,.06);border-left:3px solid var(--vna-green)}
.vna-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--vna-r);padding:26px;margin-bottom:14px}
.vna-scenario:last-child{margin-bottom:0}
.vna-scenario h3{font-size:17px;margin-bottom:8px}
.vna-scenario p{font-size:14.5px;margin:0}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-nastavnik-adaptaciya-sotrudnikov-page" role="main" tabindex="-1">

<section class="nero-ai-hero vna-hero-onboard" id="hero" aria-labelledby="vna-hero-title">
<div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai адаптация сотрудников</p>
      <h1 id="vna-hero-title">AI-наставник для адаптации сотрудников: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Соберём AI, который отвечает новичкам по регламентам, продуктам и процессам — наставники перестают повторять одно и то же, а команда выходит на результат быстрее</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">RAG по регламентам</li>
        <li class="nero-ai-badge">Telegram 24/7</li>
        <li class="nero-ai-badge">Bitrix24</li>
        <li class="nero-ai-badge">Эскалация наставнику</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-наставника для адаптации">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики адаптации · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-наставник онлайн</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>вопросов новичков сегодня</span>
              <strong>47</strong>
              <small>ритейл + L1</small>
            </div>
            <div class="nero-ai-metric">
              <span>среднее время ответа</span>
              <strong>&lt;3 сек</strong>
              <small>RAG по регламентам</small>
            </div>
            <div class="nero-ai-metric">
              <span>закрыто без эскалации</span>
              <strong>78%</strong>
              <small>типовые FAQ</small>
            </div>
            <div class="nero-ai-metric">
              <span>нагрузка на наставников</span>
              <strong>−40%*</strong>
              <small>пилот 30 дней</small>
            </div>
          </div>

          <div class="vna-hero-pills" aria-label="Этапы внедрения">
            <span class="vna-hero-pill">1 · Аудит</span>
            <span class="vna-hero-pill">2 · RAG-индекс</span>
            <span class="vna-hero-pill">3 · Пилот</span>
            <span class="vna-hero-pill">4 · Метрики HR</span>
          </div>

          <div class="vna-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vna-onboard-hero-canvas" role="img" aria-label="Анимация: вопросы новичков поднимаются по этапам адаптации, RAG-наставник отвечает с цитатой регламента или эскалирует наставнику"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий адаптации">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">🟢</span>
              <div><strong>Новичок (ритейл): «Какой скрипт при возврате?»</strong><span>RAG: фрагмент регламента возвратов</span></div>
              <span class="nero-ai-status">ответ</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">🔵</span>
              <div><strong>Ответ с цитатой источника</strong><span>Ссылка на документ в Bitrix24 Диск</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">🟡</span>
              <div><strong>Низкая уверенность RAG</strong><span>Тикет наставнику с контекстом диалога</span></div>
              <span class="nero-ai-status nero-ai-status--amber">эскалация</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📊</span>
              <div><strong>HR-дашборд обновлён</strong><span>Прогресс адаптации 30/60/90</span></div>
              <span class="nero-ai-status">метрики</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vna-content">

  <section class="vna-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vna-cnt">
      <div class="vna-intro-grid nero-ai-reveal">
        <div class="vna-intro-text">
          <p class="vna-eyebrow">Лонгрид · ai адаптация сотрудников</p>
          <p>Новичок в первую неделю задаёт одни и те же вопросы: где регламент, как оформить пропуск, какой скрипт продаж, к кому идти с возвратом. Наставник отвечает в пятый раз. HR тонет в рутине вместо стратегии. <strong>AI-наставник</strong> — корпоративный ассистент на базе нейросети и ваших документов, который отвечает новичкам по регламентам, продуктам и процессам круглосуточно.</p>
          <p><strong>Коротко:</strong> Nero Network внедряет <strong>ai адаптация сотрудников под ключ</strong> — от аудита адаптации до RAG-чата в Telegram или Bitrix24. AI-наставник не заменяет людей, а снимает повторяющуюся нагрузку и даёт HR прозрачную аналитику по первым 30–90 дням.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые метрики онбординга">
          <div class="vna-kpi-card"><div class="kv">12%</div><div class="kl">считают онбординг хорошим</div><div class="ks">Gallup / Everworker</div></div>
          <div class="vna-kpi-card"><div class="kv">41%</div><div class="kl">планируют ИИ в адаптации</div><div class="ks">Поток, 102 завода</div></div>
          <div class="vna-kpi-card"><div class="kv">120–400</div><div class="kl">тыс. ₽ коридор проекта</div><div class="ks">под ключ</div></div>
          <div class="vna-kpi-card"><div class="kv">−16 д</div><div class="kl">срок адаптации (кейс)</div><div class="ks">QSOFT / Habr</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#chto-eto">Что это</a>
        <a href="#pochemu">Зачем бизнесу</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#riski">Риски</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="vna-section" id="chto-eto">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Продукт</span>
        <h2>AI-наставник для адаптации сотрудников — что это и какую задачу решает</h2>
        <p><strong>Определение.</strong> AI-наставник (ai наставник, ai помощник новичка) — корпоративный AI-ассистент на внутренних материалах: регламентах, инструкциях, скриптах, FAQ. В отличие от публичного ChatGPT, он отвечает <strong>только по вашим документам</strong> через RAG и указывает источник каждого ответа.</p>
      </div>
      <div class="vna-compare-wrap nero-ai-reveal" style="margin-top:32px">
        <table class="vna-compare" aria-label="Сравнение LMS, чат-бота и AI-наставника">
          <thead>
            <tr><th>Критерий</th><th>LMS / курс</th><th>Обычный чат-бот</th><th class="col-ai">AI-наставник (RAG)</th></tr>
          </thead>
          <tbody>
            <tr><td>Формат</td><td>Линейные модули</td><td>Прописанные сценарии</td><td class="col-ai">Диалог на естественном языке</td></tr>
            <tr><td>Актуальность</td><td>Пересборка курса</td><td>Обновление веток вручную</td><td class="col-ai"><strong>Переиндексация документов</strong></td></tr>
            <tr><td>Ответ на вопрос</td><td>«Смотри урок 3»</td><td>Только если в сценарии</td><td class="col-ai"><strong>Поиск по всей базе</strong></td></tr>
            <tr><td>Источник</td><td>Не показывает</td><td>Не показывает</td><td class="col-ai"><strong>Цитата регламента</strong></td></tr>
            <tr><td>Риск «выдумки»</td><td>Нет</td><td>Низкий</td><td class="col-ai"><strong>RAG + порог уверенности</strong></td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="vna-card">
          <h3>Чем отличается от LMS и обычного чат-бота</h3>
          <p>LMS хороша для обязательного обучения, но плохо закрывает ситуативные вопросы. Обычный чат-бот ответит только на заложенные сценарии. <strong>AI корпоративное обучение</strong> нового типа — чек-листы 30/60/90 плюс свободный диалог по базе знаний.</p>
          <p style="margin-top:12px;font-size:14px">Олег Демченко (QSOFT): ИИ работает как «безопасный наставник» — новичок получает ответы без страха показаться некомпетентным.</p>
        </div>
        <div class="vna-card">
          <h3>Какие вопросы закрывает система</h3>
          <ul>
            <li><strong>Организационные:</strong> пропуск, график, отпуск, внутренние сервисы</li>
            <li><strong>Продуктовые:</strong> характеристики, акции, лимиты скидок</li>
            <li><strong>Процессные:</strong> возврат, эскалация жалобы, чек-лист смены</li>
            <li><strong>Инструментальные:</strong> шаблоны, CRM, заявки в IT</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="pochemu">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Боль бизнеса</span>
        <h2>Почему бизнесу нужна AI-адаптация новых сотрудников</h2>
        <p>Цель — сократить time-to-productivity и разгрузить HR, наставников и линейных руководителей. Только <strong>12%</strong> сотрудников считают онбординг качественным (Gallup); <strong>41%</strong> производственных предприятий планируют ИИ в адаптации (Поток, 2025).</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="vna-card">
          <h3>Долгий выход на продуктивность</h3>
          <ul>
            <li>Новичок 2–3 месяца «раскачивается» до плановых показателей</li>
            <li>Наставник тратит до 30–40% времени на однотипные ответы</li>
            <li>База знаний есть, но в ней сложно найти нужный абзац</li>
            <li>В сети стандарты расходятся: устные инструкции ≠ регламент</li>
          </ul>
          <p style="margin-top:14px;font-size:14px">NEXTANT: онбординг — проблема <strong>доступа к знаниям</strong>, а не нехватки контента.</p>
        </div>
        <div class="vna-card">
          <h3>Метрики ROI</h3>
          <div class="vna-table-wrap">
            <table class="vna-table" aria-label="Метрики ROI адаптации">
              <thead><tr><th>Метрика</th><th>Ориентир из кейсов</th></tr></thead>
              <tbody>
                <tr><td>Time-to-productivity</td><td><span class="vna-roi-num">QSOFT: −16 дней</span>; ритейл: <span class="vna-roi-num">−40%</span></td></tr>
                <tr><td>Часы наставника</td><td>62,5 ч/день на поиск до AI (QSOFT)</td></tr>
                <tr><td>Эскалации к HR</td><td>Снижение нагрузки (Insight AI)</td></tr>
                <tr><td>Топ FAQ</td><td>Дашборд AI-наставника</td></tr>
              </tbody>
            </table>
          </div>
          <p style="margin-top:14px;font-size:14px">Формула ROI: (дни адаптации × стоимость дня) + (часы наставника × ставка) − проект. QSOFT: <strong>~13,1 млн ₽/год</strong> на 83 разработчиков.</p>
        </div>
      </div>
    </div>
  </section>

<section id="ai-nastavnik-adaptaciya-sotrudnikov-boris-block" class="bna-root" aria-label="Анимация: поток знаний RAG от регламентов к ответу новичку и эскалации наставнику">
<style>
/* === БОРИС: prefix bna-, scoped внутри #ai-nastavnik-adaptaciya-sotrudnikov-boris-block === */
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block.bna-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-ey{
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
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0ea5e9;
  border-radius:1px;
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(14,165,233,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0284c7;
  margin-top:1px;
  font-style:normal;
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-pl-a{
  background:rgba(251,191,36,.1);
  color:#b45309;
  border:1.5px solid rgba(251,191,36,.28);
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-rgt{
  position:relative;
  background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 45%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-nastavnik-adaptaciya-sotrudnikov-boris-block .bna-rgt{min-height:380px;}
}
#bna-rag-knowledge-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bna-cnt">
  <div class="bna-card">

    <div class="bna-lft">
      <span class="bna-ey">Карта знаний · RAG</span>
      <h3 class="bna-h3">От регламента до ответа новичку — без «выдуманных» инструкций</h3>
      <ul class="bna-ul">
        <li><span class="bna-ic">📄</span>Регламенты, скрипты и FAQ индексируются в векторную базу с версиями</li>
        <li><span class="bna-ic">🔍</span>RAG находит фрагмент документа по вопросу новичка в Telegram</li>
        <li><span class="bna-ic">💬</span>Ответ приходит с цитатой источника — не «из головы» нейросети</li>
        <li><span class="bna-ic">👤</span>Низкая уверенность или чувствительная тема — эскалация наставнику с контекстом</li>
      </ul>
      <div class="bna-pills">
        <span class="bna-pl bna-pl-g">70%+ без эскалации</span>
        <span class="bna-pl bna-pl-b">&lt;3 сек ответ</span>
        <span class="bna-pl bna-pl-a">human-in-the-loop</span>
      </div>
      <p class="bna-foot">Дальше разберём сценарии по отраслям: ритейл, франшизы, продажи и L1 →</p>
    </div>

    <div class="bna-rgt">
      <canvas
        id="bna-rag-knowledge-canvas"
        aria-label="Анимация: документы регламентов проходят через RAG-индекс, формируют ответ новичку в мессенджере или эскалируются наставнику"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bna-rag-knowledge-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0, cycleT = 0;

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
    doc:'#ffffff',
    docBdr:'#cbd5e1',
    docAccent:'#0ea5e9',
    rag:'#8b5cf6',
    ragGlow:'rgba(139,92,246,.22)',
    index:'#e0e7ff',
    indexBdr:'#a5b4fc',
    chat:'#22c55e',
    chatBg:'#f0fdf4',
    chatBdr:'#86efac',
    mentor:'#f59e0b',
    mentorBg:'#fffbeb',
    line:'rgba(14,165,233,.32)',
    muted:'#64748b',
    text:'#1e293b',
    bubbleUser:'#dbeafe',
    bubbleAi:'#ffffff'
  };

  var docs = [];
  var chunks = [];
  var bubbles = [];
  var escalations = [];

  var DOC_TYPES = [
    {label:'Регламент', color:'#0ea5e9', short:'PDF'},
    {label:'Скрипт продаж', color:'#22c55e', short:'DOC'},
    {label:'FAQ наставника', color:'#8b5cf6', short:'Wiki'}
  ];

  function rr(ctx,x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  function spawnDoc(){
    var t = DOC_TYPES[Math.floor(Math.random()*DOC_TYPES.length)];
    docs.push({
      x: W*0.06,
      y: H*0.18 + Math.random()*H*0.35,
      type: t,
      phase: 0,
      speed: 1.1 + Math.random()*0.5,
      wobble: Math.random()*Math.PI*2
    });
  }

  function spawnChunk(hx, hy){
    var labels = ['§4.2 Возврат','Скрипт скидки','Пропуск офис'];
    chunks.push({
      x: hx, y: hy,
      tx: W*0.72, ty: H*0.42,
      label: labels[chunks.length % 3],
      t: 0, alpha: 0
    });
  }

  function spawnBubble(x, y, text, isUser){
    bubbles.push({
      x: x, y: y,
      text: text,
      isUser: isUser,
      alpha: 0,
      t: 0,
      maxLife: 180
    });
  }

  function spawnEscalation(hx, hy){
    escalations.push({
      x: hx, y: hy,
      tx: W*0.5, ty: H*0.12,
      t: 0, alpha: 0
    });
  }

  function drawDocIcon(x, y, s, type, rot){
    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(rot || 0);
    rr(ctx, -s*0.42, -s*0.5, s*0.84, s, 5, C.doc, type.color);
    ctx.fillStyle = type.color;
    ctx.font = 'bold ' + Math.max(8, s*0.18) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(type.short, 0, -s*0.08);
    ctx.fillStyle = C.muted;
    ctx.font = Math.max(7, s*0.12) + 'px system-ui,sans-serif';
    var lw = type.label.length > 12 ? type.label.slice(0,11)+'…' : type.label;
    ctx.fillText(lw, 0, s*0.22);
    ctx.restore();
  }

  function drawRagHub(cx, cy, r, pulse){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*1.9);
    g.addColorStop(0, C.ragGlow);
    g.addColorStop(1, 'rgba(139,92,246,0)');
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(cx, cy, r*1.7, 0, Math.PI*2);
    ctx.fill();

    rr(ctx, cx-r, cy-r*1.1, r*2, r*2.2, r*0.3, '#f5f3ff', C.rag);
    ctx.fillStyle = C.rag;
    ctx.font = 'bold ' + Math.max(11, r*0.2) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('RAG', cx, cy - r*0.15);
    ctx.font = Math.max(8, r*0.13) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('индекс знаний', cx, cy + r*0.25);

    for(var i=0;i<3;i++){
      var a = frame*0.04 + i*2.1;
      var ix = cx + Math.cos(a)*r*0.55;
      var iy = cy + Math.sin(a)*r*0.4;
      rr(ctx, ix-14, iy-8, 28, 16, 4, C.index, C.indexBdr);
    }

    ctx.strokeStyle = C.rag;
    ctx.lineWidth = 2 + pulse*2;
    ctx.globalAlpha = 0.25 + pulse*0.35;
    ctx.beginPath();
    ctx.arc(cx, cy, r+8+pulse*6, 0, Math.PI*2);
    ctx.stroke();
    ctx.globalAlpha = 1;
  }

  function drawTelegramChat(x, y, w, h){
    rr(ctx, x, y, w, h, 12, C.chatBg, C.chatBdr);
    ctx.fillStyle = C.chat;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Telegram · новичок', x+12, y+18);
    ctx.fillStyle = C.muted;
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText('онлайн', x+w-42, y+18);
    ctx.fillStyle = C.chat;
    ctx.beginPath();
    ctx.arc(x+w-28, y+14, 4, 0, Math.PI*2);
    ctx.fill();
  }

  function drawMentorBadge(x, y, alpha){
    if(alpha < 0.05) return;
    ctx.globalAlpha = alpha;
    rr(ctx, x, y, 120, 36, 8, C.mentorBg, C.mentor);
    ctx.fillStyle = C.mentor;
    ctx.font = 'bold 10px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('→ Наставник', x+60, y+22);
    ctx.globalAlpha = 1;
  }

  function tick(){
    frame++;
    cycleT++;
    if(frame % 100 === 0) spawnDoc();

    var hubX = W*0.44, hubY = H*0.5, hubR = Math.min(W,H)*0.1;
    var pulse = 0.5 + 0.5*Math.sin(frame*0.06);
    var chatX = W*0.62, chatY = H*0.22, chatW = W*0.32, chatH = H*0.62;

    ctx.clearRect(0, 0, W, H);

    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('База знаний', W*0.06, H*0.08);
    ctx.textAlign = 'center';
    ctx.fillText('RAG-индекс', hubX, H*0.08);
    ctx.textAlign = 'right';
    ctx.fillText('Новичок', W*0.94, H*0.08);

    ctx.strokeStyle = C.line;
    ctx.lineWidth = 2;
    ctx.setLineDash([5,4]);
    ctx.beginPath();
    ctx.moveTo(W*0.18, H*0.35);
    ctx.lineTo(hubX - hubR - 6, hubY);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(hubX + hubR + 6, hubY);
    ctx.lineTo(chatX + 20, chatY + chatH*0.45);
    ctx.stroke();
    ctx.setLineDash([]);

    drawRagHub(hubX, hubY, hubR, pulse);
    drawTelegramChat(chatX, chatY, chatW, chatH);

    var mentorAlpha = 0;

    docs = docs.filter(function(d){
      d.phase += d.speed;
      if(d.phase < 130){
        d.x += d.speed*1.3;
        d.y += Math.sin(frame*0.07 + d.wobble)*0.35;
      } else if(d.phase < 210){
        var dx = hubX - d.x, dy = hubY - d.y;
        d.x += dx*0.045;
        d.y += dy*0.045;
        if(d.phase === 131) spawnChunk(hubX, hubY);
      } else {
        return false;
      }
      drawDocIcon(d.x, d.y, 28, d.type, Math.sin(frame*0.04)*0.06);
      return true;
    });

    chunks = chunks.filter(function(ch){
      ch.t += 0.028;
      ch.alpha = Math.min(1, ch.t*2.2);
      var ease = ch.t*ch.t*(3-2*ch.t);
      var cx = ch.x + (ch.tx - ch.x)*ease;
      var cy = ch.y + (ch.ty - ch.y)*ease;
      ctx.globalAlpha = ch.alpha;
      rr(ctx, cx-38, cy-9, 76, 18, 5, C.index, C.indexBdr);
      ctx.fillStyle = C.text;
      ctx.font = '8px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(ch.label, cx, cy+4);
      ctx.globalAlpha = 1;
      if(ch.t >= 1){
        if(ch.label.indexOf('скидки') >= 0){
          spawnBubble(chatX+14, chatY+chatH*0.55, 'Какой лимит скидки?', true);
          setTimeout(function(){
            spawnBubble(chatX+14, chatY+chatH*0.68, 'По регламенту §4.2 — до 10%', false);
          }, 0);
        } else if(ch.label.indexOf('Пропуск') >= 0){
          spawnEscalation(hubX, hubY);
        } else {
          spawnBubble(chatX+14, chatY+chatH*0.38, 'Как оформить возврат?', true);
          setTimeout(function(){
            spawnBubble(chatX+14, chatY+chatH*0.52, 'См. регламент §4.2 + ссылка', false);
          }, 0);
        }
        return false;
      }
      return true;
    });

    bubbles = bubbles.filter(function(b){
      b.t++;
      b.alpha = Math.min(1, b.t/25);
      if(b.t > b.maxLife) return false;
      var by = b.y + (b.isUser ? 0 : 0);
      ctx.globalAlpha = b.alpha * (b.t > b.maxLife - 30 ? (b.maxLife - b.t)/30 : 1);
      var bw = Math.min(chatW - 28, b.text.length*6.5 + 20);
      rr(ctx, b.x, by, bw, 22, 8, b.isUser ? C.bubbleUser : C.bubbleAi, b.isUser ? '#93c5fd' : C.chatBdr);
      ctx.fillStyle = C.text;
      ctx.font = '9px system-ui,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(b.text, b.x+8, by+14);
      ctx.globalAlpha = 1;
      return true;
    });

    escalations = escalations.filter(function(e){
      e.t += 0.03;
      e.alpha = Math.min(1, e.t*1.8);
      var ease = e.t*e.t*(3-2*e.t);
      var ex = e.x + (e.tx - e.x)*ease;
      var ey = e.y + (e.ty - e.y)*ease;
      ctx.globalAlpha = e.alpha;
      ctx.strokeStyle = C.mentor;
      ctx.lineWidth = 2;
      ctx.setLineDash([4,3]);
      ctx.beginPath();
      ctx.moveTo(e.x, e.y);
      ctx.lineTo(ex, ey);
      ctx.stroke();
      ctx.setLineDash([]);
      mentorAlpha = Math.max(mentorAlpha, e.alpha);
      ctx.globalAlpha = 1;
      return e.t < 1.2;
    });

    drawMentorBadge(W*0.38, H*0.06, mentorAlpha);

    if(cycleT > 480){
      cycleT = 0;
      docs = [];
      chunks = [];
      bubbles = [];
      escalations = [];
    }

    requestAnimationFrame(tick);
  }
  tick();
})();
</script>
</section>

  <section class="vna-section" id="scenarii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Отрасли</span>
        <h2>Сценарии по отраслям: ритейл, франшизы, продажи, техподдержка</h2>
        <p><strong>AI адаптация сотрудников для бизнеса</strong> — не один шаблон. Собираем пакет под роль и отрасль.</p>
      </div>
      <div class="vna-scenario nero-ai-reveal">
        <h3>Ритейл и франшизы — единые стандарты для сети точек</h3>
        <p>Продавец в новой точке знает ассортимент, акции и правила возврата одинаково — Москва или регион. AI отвечает по продуктам, проводит мини-тесты, фиксирует пробелы. Кейс Insight AI: <span class="vna-roi-num">−40%</span> времени адаптации, <span class="vna-roi-num">+15%</span> удовлетворённости.</p>
      </div>
      <div class="vna-scenario nero-ai-reveal nero-ai-delay-1">
        <h3>Отдел продаж и техподдержка L1</h3>
        <p>Связка <strong>наставник + тренажёр</strong>: скрипты, возражения, эскалация, регламент CRM. Альфа-Банк: ИИ-тренажёры — время звонка <span class="vna-roi-num">−6,4%</span>, оценка клиентов <span class="vna-roi-num">+13%</span>. Для SMB: RAG по скриптам + чек-лист 30 дней + эскалация старшему.</p>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
      <div class="ym-cta-block ym-cta-block--primary" id="cta-scenarii">
        <div class="ym-cta-block__icon" aria-hidden="true">🎓</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Соберём AI-наставника под вашу отрасль</p>
          <p class="ym-cta-block__sub">Ритейл, франшиза, продажи или L1-поддержка — на аудите разберём топ-вопросы новичков и покажем демо RAG-ответа по вашим регламентам. Без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="kak-rabotaet">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">RAG</span>
        <h2>Как работает AI-наставник: база знаний, RAG и контроль ответов</h2>
        <p><strong>Автоматизация через ai адаптация сотрудников</strong> строится на трёх слоях: документы → индекс → диалог с контролем качества.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="vna-card">
          <h3>Загрузка регламентов и материалов</h3>
          <p>PDF, DOCX, Wiki, Confluence, Bitrix24 Диск, скрипты, FAQ наставников за 3–6 месяцев. Процесс: аудит → версионирование → индексация → LLM (OpenAI, Claude, GigaChat, YandexGPT).</p>
        </div>
        <div class="vna-card">
          <h3>Контроль галлюцинаций</h3>
          <ul>
            <li>Порог уверенности — при низком score «перевожу наставнику»</li>
            <li>Обязательная ссылка на источник</li>
            <li>Версионирование документов</li>
            <li>Запретные темы → только эскалация</li>
            <li>Логирование для HR</li>
          </ul>
        </div>
      </div>
      <div class="vna-flow nero-ai-reveal" aria-label="Схема RAG за 5 шагов">
        <span>1 · Вопрос в Telegram</span><span class="arr">→</span>
        <span>2 · Поиск в индексе</span><span class="arr">→</span>
        <span>3 · Ответ + цитата</span><span class="arr">→</span>
        <span>4 · Эскалация?</span><span class="arr">→</span>
        <span>5 · Дашборд HR</span>
      </div>
    </div>
  </section>

  <section class="vna-section" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Под ключ</span>
        <h2>Внедрение AI-наставника под ключ — этапы проекта</h2>
        <p><strong>Внедрение ai адаптация сотрудников</strong> — проект с фиксированными этапами, не бесконечная подписка.</p>
      </div>
      <div class="vna-timeline nero-ai-reveal">
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Аудит адаптации и карта знаний (1–3 дня)</h3>
          <p>Топ-20 вопросов новичков, ревизия документов, карта ролей, точки эскалации. На выходе — <strong>Карта адаптации новичка</strong> (лид-магнит).</p>
        </div>
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Сбор базы и RAG MVP (2–3 недели)</h3>
          <p>Индексация, чат в Telegram / Bitrix24, сценарии 30/60/90, мини-тесты.</p>
        </div>
        <div class="vna-tl-item">
          <div class="vna-tl-dot"></div>
          <h3>Пилот и масштабирование</h3>
          <p>10–20 новичков, метрики, доработка промптов. Полный цикл — <strong>6–10 недель</strong>.</p>
        </div>
      </div>
      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:28px">
        <table class="vna-table vna-etapy-table" aria-label="Этапы внедрения AI-наставника">
          <thead><tr><th>Этап</th><th>Содержание</th><th>Срок</th></tr></thead>
          <tbody>
            <tr><td>Сбор базы знаний</td><td>Регламенты, скрипты, FAQ</td><td>1–2 недели</td></tr>
            <tr><td>RAG-наставник MVP</td><td>Индексация, чат Telegram / Bitrix24</td><td>2–3 недели</td></tr>
            <tr class="row-pilot"><td><strong>Пилот</strong></td><td>10–20 новичков, сбор метрик</td><td>2–4 недели</td></tr>
            <tr><td>Масштабирование</td><td>Все точки / отделы, обучение HR</td><td>по плану</td></tr>
          </tbody>
        </table>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите понимать AI до старта проекта?</p>
          <p class="ym-cta-block__sub">Если HR или руководитель хочет разобраться в RAG, промптах и human-in-the-loop до пилота — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование внедрения с командой.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="integracii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Стек</span>
        <h2>Интеграция с CRM, HRIS, LMS и мессенджерами</h2>
        <p><strong>Интеграция ai адаптация сотрудников с crm</strong> даёт сквозной процесс: найм → адаптация → продуктивность.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3>Telegram, Slack, Teams</h3>
          <p>Для российского SMB приоритет — <strong>Telegram</strong>. Паттерн IT-Solution: Study-bot + прогресс в Bitrix24 + отчёты Power BI. Альтернативы: Bitrix24 Open Lines, корпоративный Slack/Teams, веб-виджет на HR-портале.</p>
        </div>
        <div class="vna-card">
          <h3>CRM и кадровые системы</h3>
          <ul>
            <li><strong>Bitrix24 / amoCRM</strong> — карточка сотрудника, webhook при приёме</li>
            <li><strong>HRIS</strong> — статус этапов, напоминания</li>
            <li><strong>LMS</strong> — дополняет курсы, не заменяет</li>
            <li><strong>n8n / Make</strong> — автоматизация эскалаций</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI для адаптации персонала</h2>
      </div>
      <div class="vna-case-grid">
        <div class="vna-case-card nero-ai-reveal">
          <div class="vna-case-tag">кейс РФ · Q</div>
          <h3>QSOFT (~250 сотрудников)</h3>
          <p>AI-поиск по базе знаний для онбординга разработчиков.</p>
          <div class="vna-metric"><span class="num">−16</span><span class="lbl">рабочих дней адаптации</span></div>
          <div class="vna-metric"><span class="num">13,1</span><span class="lbl">млн ₽/год экономии</span></div>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vna-case-tag">кейс РФ · R</div>
          <h3>Федеральный ритейлер (Insight AI)</h3>
          <p>AI-бот первой линии, персональные траектории, сертификация продавцов.</p>
          <div class="vna-metric"><span class="num">−40%</span><span class="lbl">время адаптации</span></div>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vna-case-tag">кейс РФ · A</div>
          <h3>Альфа-Банк</h3>
          <p>ИИ-тренажёры на Alfa AI: 14 сценариев в 5 направлениях.</p>
          <div class="vna-metric"><span class="num">+13%</span><span class="lbl">оценка клиентов</span></div>
        </div>
        <div class="vna-case-card nero-ai-reveal">
          <div class="vna-case-tag">Telegram + CRM</div>
          <h3>IT-Solution</h3>
          <p>Study-bot в Telegram, синхронизация Bitrix24, отчёты Power BI.</p>
          <div class="vna-metric"><span class="num">MVP</span><span class="lbl">2–4 недели до бота</span></div>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vna-case-tag">международный</div>
          <h3>PetroLedger / Sphere</h3>
          <p>Time-to-productivity: 8–12 мес. → 3–5 мес.; $1,2M/год экономии.</p>
        </div>
        <div class="vna-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vna-case-tag">SMB</div>
          <h3>Nero Network</h3>
          <p>Telegram + Bitrix24 + RAG за <strong>120–400 тыс. ₽</strong> без enterprise-лицензий.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;font-size:14.5px">Эффект виден на пилоте из 10–20 человек — не нужно ждать год. Цель пилота: <strong>70%+</strong> вопросов закрыто AI без эскалации.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="ceny">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Бюджет</span>
        <h2>Стоимость внедрения AI-наставника и что входит в проект</h2>
        <p>Коридор <strong>120–400 тыс. ₽</strong> за проект <strong>ai адаптация сотрудников под ключ</strong>.</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table" aria-label="Факторы стоимости AI-наставника">
          <thead><tr><th>Фактор</th><th>Влияние на цену</th></tr></thead>
          <tbody>
            <tr><td>Объём базы знаний</td><td>До 50 документов vs сотни регламентов</td></tr>
            <tr><td>Каналы</td><td>Только Telegram vs Telegram + Bitrix24 + виджет</td></tr>
            <tr><td>Роли и сценарии</td><td>Одна роль vs франшиза с 5 должностями</td></tr>
            <tr><td>Контур данных</td><td>Облако vs on-prem / GigaChat Enterprise</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-leadmag nero-ai-reveal">
        <div class="vna-leadmag-icon" aria-hidden="true">📋</div>
        <div>
          <h3 style="margin-bottom:8px">Лид-магнит: карта адаптации новичка</h3>
          <p style="margin:0;font-size:14.5px">Чек-лист первого дня, недели, месяца; типовые вопросы по ролям; матрица «кто за что отвечает». Карта — вход в воронку: вы видите пробелы, мы предлагаем <strong>собрать AI-наставника</strong> под вашу специфику.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="margin-top:16px"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="riski">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Compliance</span>
        <h2>Риски, безопасность и персональные данные</h2>
        <p><strong>Внедрение ai в бизнес процессы</strong> с ПДн требует дисциплины — закладываем compliance в архитектуру.</p>
      </div>
      <div class="vna-card vna-risk-card nero-ai-reveal" style="margin-top:28px">
        <ul>
          <li><strong>152-ФЗ:</strong> ПДн новичков не попадают в промпты обучения; логи — в РФ или контуре заказчика</li>
          <li><strong>Ролевой доступ:</strong> кассир не видит регламенты закупок; RAG фильтрует по правам</li>
          <li><strong>Логирование:</strong> кто спросил, что ответила система, была ли эскалация</li>
          <li><strong>Маскирование:</strong> ФИО, телефоны, зарплата — вне индекса</li>
          <li><strong>Актуальность:</strong> устаревший регламент опаснее его отсутствия</li>
        </ul>
        <p style="margin-top:16px;font-size:14px">Возражение «AI врёт» закрывается архитектурой: RAG только по вашим файлам, цитата обязательна, при сомнении — перевод на человека.</p>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Вопрос — ответ</span>
        <h2>FAQ — частые вопросы про AI-адаптацию сотрудников</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько длится внедрение?</div><div class="vna-faq-a"><p>MVP в Telegram — <strong>2–4 недели</strong>. Полный проект — <strong>6–10 недель</strong>. Аудит — от 1 дня.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли свой IT-отдел?</div><div class="vna-faq-a"><p>Нет для типового пакета Telegram + Bitrix24. Нужен контакт со стороны HR: доступ к регламентам, тестовые новички, обратная связь.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли начать с одного отдела?</div><div class="vna-faq-a"><p>Да — рекомендуемый путь. Пилот на 10–20 новичках в одном отделе → метрики → масштабирование.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить, если документы в хаосе?</div><div class="vna-faq-a"><p>Начинаем с аудита: нужны <strong>20–30 ключевых документов</strong> и FAQ наставников. AI покажет, какие темы спрашивают чаще всего.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли для малого бизнеса?</div><div class="vna-faq-a"><p>Основной сегмент — 50–300 человек. Telegram + PDF + Bitrix24 закрывают 80% задач. Чек от <strong>120 тыс. ₽</strong>.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI живого наставника?</div><div class="vna-faq-a"><p>Нет. Гибридная модель — стандарт 2026: AI снимает рутину 24/7, человек — сложные кейсы и аттестацию. Наставник получает аналитику вместо десятого однотипного ответа.</p></div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от Personik, Lubava и HR-платформ?</div><div class="vna-faq-a"><p>SaaS даёт готовый продукт с ограниченной кастомизацией. Nero Network собирает <strong>ваш</strong> AI-наставник: RAG с цитатами, анти-галлюцинации, прозрачный ROI — проект под ключ, не подписка «как есть».</p></div></div>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы ускорить адаптацию новичков?</p>
        <p class="ym-cta-block__sub">Скачайте карту адаптации, посмотрите демо на типовых вопросах ритейла и поддержки — и соберём AI-наставника под ваши роли за 6–10 недель.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#ceny" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Стоимость и состав проекта →</a>
        </div>
      </div>
    </div>
  </div>

</div><!-- /.vna-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * vna-onboard-hero-engine — «Диспетчерская онбординга / Мост знаний HR»
 * Центр: RagMentorCore · Транспорт: CurvedQuestionRamp · Финал: ProductivitySeal или MentorEscalationBridge
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vna-onboard-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  var LOOP = 280;

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
    ramp: "rgba(121,242,255,0.2)",
    rampGlow: "rgba(139,92,246,0.32)",
    coreBase: "#1e293b",
    coreAccent: "#79f2ff",
    coreGreen: "#22c55e",
    coreAmber: "#fbbf24",
    chipBg: "#a7f3d0",
    ticket: "#fde68a",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    question: "#f8fafc"
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

  /* Трёхступенчатая дуга вопросов — не конвейер */
  function CurvedQuestionRamp() {
    this.phase = 0;
  }
  CurvedQuestionRamp.prototype.draw = function (ctx) {
    this.phase = (frame * 0.028) % (Math.PI * 2);
    var steps = [
      { x: -155, y: 55, label: "30" },
      { x: -95, y: 15, label: "60" },
      { x: -35, y: -25, label: "90" }
    ];
    ctx.lineWidth = 2;
    ctx.strokeStyle = C.rampGlow;
    ctx.setLineDash([5, 7]);
    ctx.lineDashOffset = -frame * 0.35;
    ctx.beginPath();
    ctx.moveTo(steps[0].x, steps[0].y);
    ctx.quadraticCurveTo(-120, -10, steps[1].x, steps[1].y);
    ctx.quadraticCurveTo(-70, -45, steps[2].x, steps[2].y);
    ctx.stroke();
    ctx.setLineDash([]);

    steps.forEach(function (s) {
      drawRR(ctx, s.x - 14, s.y - 10, 28, 20, 6, "rgba(255,255,255,0.06)", C.outline);
      ctx.fillStyle = C.coreAccent;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Д" + s.label, s.x, s.y + 4);
    });

    for (var i = 0; i < 4; i++) {
      var t = (this.phase + i * 1.4) % (Math.PI * 2);
      var prog = t / (Math.PI * 2);
      var qx = -155 + prog * 120;
      var qy = 55 - Math.sin(prog * Math.PI) * 70;
      drawRR(ctx, qx - 10, qy - 7, 20, 14, 4, C.question, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("?", qx, qy + 3);
    }
  };

  /* Ядро RAG-наставника — вместо WebsiteTerminal */
  function RagMentorCore() {
    this.pulse = 0;
    this.mode = "answer";
  }
  RagMentorCore.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % LOOP;
    this.pulse = Math.sin(frame * 0.06) * 0.5 + 0.5;

    drawRR(ctx, -58, -72, 116, 148, 12, C.coreBase, C.outline);

    /* Чат-окно наставника */
    drawRR(ctx, -48, -62, 96, 88, 8, "rgba(255,255,255,0.95)", C.outline);
    drawRR(ctx, -48, -62, 96, 18, [8, 8, 0, 0], "rgba(121,242,255,0.2)", C.outline);
    ctx.fillStyle = "#0f172a";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("AI-наставник", -42, -50);

    /* Фазы: rag_digest → answer_cite → mentor_fork */
    if (prg >= 50 && prg < 110) {
      var fragCount = Math.floor((prg - 50) / 12);
      for (var f = 0; f < fragCount; f++) {
        var ang = f * 1.2 + frame * 0.04;
        var fx = Math.cos(ang) * (22 + f * 4);
        var fy = -20 + Math.sin(ang) * 12;
        drawRR(ctx, fx - 8, fy - 5, 16, 10, 3, C.chipBg, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("PDF", fx, fy + 2);
      }
    }

    if (prg >= 110 && prg < 175) {
      drawRR(ctx, -40, -38, 80, 22, 5, "rgba(121,242,255,0.15)", C.coreAccent);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Скрипт возврата — п. 4.2", -36, -24);
      ctx.font = "6px Inter,sans-serif";
      ctx.fillStyle = "#475569";
      ctx.fillText("источник: регламент_ритейл.pdf", -36, -14);
    }

    if (prg >= 175) {
      this.mode = prg % 56 < 28 ? "escalate" : "success";
      if (this.mode === "escalate") {
        drawRR(ctx, -40, -36, 80, 24, 5, "rgba(251,191,36,0.2)", C.coreAmber);
        ctx.fillStyle = "#92400e";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.fillText("Уверенность 42% → наставник", -36, -20);
      } else {
        drawRR(ctx, -40, -36, 80, 24, 5, "rgba(34,197,94,0.2)", C.coreGreen);
        ctx.fillStyle = "#166534";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.fillText("Ответ с цитатой · 96%", -36, -20);
      }
    }

    /* Нижняя панель прогресса */
    drawRR(ctx, -48, 30, 96, 36, 6, "rgba(255,255,255,0.06)", C.outline);
    ["30", "60", "90"].forEach(function (d, i) {
      var filled = prg > 40 + i * 45;
      drawRR(ctx, -42 + i * 32, 40, 24, 8, 3, filled ? C.coreGreen : "rgba(255,255,255,0.12)", null);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(d, -30 + i * 32, 52);
    });
  };

  /* Шкала уверенности RAG */
  function ConfidenceArcMeter() {
    this.val = 0.5;
  }
  ConfidenceArcMeter.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % LOOP;
    if (prg < 70) this.val = 0.38 + (prg / 70) * 0.25;
    else if (prg < 140) this.val = 0.63 + ((prg - 70) / 70) * 0.22;
    else if (prg < 200) this.val = 0.85 + ((prg - 140) / 60) * 0.1;
    else this.val = prg % 56 < 28 ? 0.42 : 0.96;

    drawRR(ctx, 88, -58, 54, 14, 4, "rgba(255,255,255,0.08)", C.outline);
    drawRR(ctx, 90, -56, 50 * this.val, 10, 3, this.val > 0.7 ? C.coreGreen : C.coreAmber, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText(Math.round(this.val * 100) + "% RAG", 90, -46);
  };

  /* Мост эскалации к наставнику */
  function MentorEscalationBridge() {
    this.ticketY = 0;
  }
  MentorEscalationBridge.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % LOOP;
    drawRR(ctx, 105, 8, 42, 34, 6, "rgba(251,191,36,0.12)", C.coreAmber);
    ctx.fillStyle = C.coreAmber;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("HR", 126, 22);
    ctx.fillText("наставник", 126, 32);

    if (prg > 178 && prg < 215 && prg % 56 < 28) {
      this.ticketY = Math.min(1, (prg - 178) / 20);
      var ty = 20 - this.ticketY * 35;
      var tx = 30 + this.ticketY * 70;
      drawRR(ctx, tx - 12, ty, 24, 16, 4, C.ticket, C.outline);
      ctx.fillStyle = "#92400e";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("тикет", tx, ty + 10);
      ctx.strokeStyle = "rgba(251,191,36,0.5)";
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(0, 10);
      ctx.lineTo(tx, ty + 8);
      ctx.stroke();
      ctx.setLineDash([]);
    }
  };

  /* Штамп продуктивности — финал вместо ракеты */
  function ProductivitySeal() {
    this.scale = 0;
  }
  ProductivitySeal.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % LOOP;
    if (prg < 200 || prg % 56 >= 28) {
      this.scale = 0;
      return;
    }
    var local = (prg - 200) / 30;
    this.scale = Math.min(1, local);
    var s = this.scale;
    ctx.save();
    ctx.translate(0, 78);
    ctx.globalAlpha = s;
    var pulseR = 28 + Math.sin(frame * 0.12) * 4;
    ctx.strokeStyle = "rgba(34,197,94," + (0.5 * s) + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, 0, pulseR, 0, Math.PI * 2);
    ctx.stroke();
    drawRR(ctx, -38, -14, 76, 28, 8, "rgba(34,197,94,0.22)", C.coreGreen);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("TTM −16 д", 0, 4);
    ctx.restore();
  };

  /* Рельса чек-листа 30/60/90 */
  function OnboardingMilestoneRail() {
    this.highlight = 0;
  }
  OnboardingMilestoneRail.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % LOOP;
    this.highlight = Math.floor(prg / 70) % 3;
    [-1, 0, 1].forEach(function (off, i) {
      var active = i === this.highlight;
      drawRR(ctx, -170 + i * 18, -75 + off * 0, 14, 14, 4, active ? "rgba(121,242,255,0.25)" : "rgba(255,255,255,0.05)", C.outline);
    }, this);
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
    var prg = (frame * 0.035) % LOOP;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var hubTargets = {
      "1_architect": { x: -75, y: 48 },
      "2_seo": { x: -25, y: 58 },
      "3_coder": { x: 25, y: 58 },
      "4_designer": { x: 75, y: 48 },
      "5_deployer": { x: 0, y: 68 }
    };
    var tgt = hubTargets[this.role] || { x: 0, y: 55 };

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
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
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
  entities.push(new CurvedQuestionRamp());
  entities.push(new OnboardingMilestoneRail());
  entities.push(new RagMentorCore());
  entities.push(new ConfidenceArcMeter());
  entities.push(new MentorEscalationBridge());
  entities.push(new ProductivitySeal());
  entities.push(new Agent(-130, 98, C.agentYellow, "1_architect", 20, [
    "Карта адаптации 30/60/90", "Топ-20 вопросов новичков", "Аудит регламентов за 2 дня"
  ]));
  entities.push(new Agent(-65, 108, C.agentGreen, "2_seo", 58, [
    "Индексирую PDF регламенты", "FAQ наставников в вектор", "Версия документа v3.2"
  ]));
  entities.push(new Agent(0, 112, C.agentBlue, "3_coder", 102, [
    "RAG-порог 0.72", "Telegram webhook готов", "Цитата обязательна"
  ]));
  entities.push(new Agent(65, 108, C.agentPink, "4_designer", 148, [
    "Чат для новичка в TG", "Ответ + ссылка на источник", "Чек-лист первой смены"
  ]));
  entities.push(new Agent(130, 98, C.agentPurple, "5_deployer", 196, [
    "Пилот на 15 новичках", "Дашборд HR включён", "Эскалация в Bitrix24"
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

    var prg = (frame * 0.035) % LOOP;
    if (prg >= 18 && prg < 18.05) createBubble(-120, 30, "1. Вопрос на рампе");
    if (prg >= 62 && prg < 62.05) createBubble(-60, -5, "2. Поиск в базе RAG");
    if (prg >= 118 && prg < 118.05) createBubble(0, -35, "3. Цитата регламента");
    if (prg >= 182 && prg < 182.05) createBubble(90, 5, "4. Эскалация HR");
    if (prg >= 228 && prg < 228.05) createBubble(0, 70, "5. TTM −16 д");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.coreAccent);
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
      if(!isOpen){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
    });
    btn.addEventListener('keydown', function(e){
      if(e.key==='Enter'||e.key===' '){ e.preventDefault(); btn.click(); }
    });
  });
})();
</script>

<script>
(function () {
  'use strict';

  var root = document.querySelector('.nero-ai-home-page');
  if (!root) return;

  var revealItems = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

    revealItems.forEach(function (item) { observer.observe(item); });
  } else {
    revealItems.forEach(function (item) { item.classList.add('nero-ai-active'); });
  }

  var tooltipItems = root.querySelectorAll('[data-nero-tooltip]');
  tooltipItems.forEach(function (item) {
    if (!item.hasAttribute('tabindex')) item.setAttribute('tabindex', '0');

    item.addEventListener('click', function (event) {
      var isActive = item.classList.contains('nero-ai-tooltip-active');
      tooltipItems.forEach(function (other) { other.classList.remove('nero-ai-tooltip-active'); });
      if (!isActive) item.classList.add('nero-ai-tooltip-active');
      event.stopPropagation();
    });
  });

  document.addEventListener('click', function () {
    tooltipItems.forEach(function (item) { item.classList.remove('nero-ai-tooltip-active'); });
  });

  var counters = root.querySelectorAll('[data-nero-count]');
  function animateCounter(el) {
    var target = parseFloat(el.getAttribute('data-nero-count') || '0');
    var suffix = el.getAttribute('data-nero-suffix') || '';
    var prefix = el.getAttribute('data-nero-prefix') || '';
    var duration = 850;
    var start = performance.now();

    function frame(now) {
      var progress = Math.min((now - start) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      var value = Math.round(target * eased);
      el.textContent = prefix + value + suffix;
      if (progress < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  if ('IntersectionObserver' in window) {
    var counterObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting && !entry.target.dataset.neroDone) {
          entry.target.dataset.neroDone = '1';
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.35 });
    counters.forEach(function (counter) { counterObserver.observe(counter); });
  } else {
    counters.forEach(animateCounter);
  }
})();

</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

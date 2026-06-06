<?php
/**
 * Template Name: AI-маршрутизация обращений: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-маршрутизации обращений. КЦ, медицина, техподдержка. Карта маршрутов бесплатно.
 */

$page_seo_title       = 'AI-маршрутизация обращений: внедрение и настройка под ключ';
$page_seo_description = 'Внедряем AI-маршрутизацию обращений: голос, чат, заявки. AI направляет в нужный отдел без переключений. КЦ, медицина, техподдержка. Карта маршрутов бесплатно.';

add_filter(
    'document_title_parts',
    static function ( array $parts ) use ( $page_seo_title ): array {
        $parts['title'] = $page_seo_title;
        return $parts;
    },
    20
);

add_action(
    'wp_head',
    static function () use ( $page_seo_title, $page_seo_description ): void {
        echo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
    },
    1
);

$brand               = get_bloginfo( 'name' ) ?: ( getenv( 'SITE_BRAND' ) ?: '' ); // pragma: allowlist secret
$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Собрать карту маршрутов';
$primary_cta_url     = getenv( 'PRIMARY_CTA_URL' ) ?: '#cta';
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'Курс по AI';
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '#';
$schema_site_url   = trailingslashit( home_url() );
$schema_page_url   = trailingslashit( get_permalink() );

$nero_ai_header_links = [
    [ 'label' => 'Проблема',     'href' => '#pochemu-perekidyvayut' ],
    [ 'label' => 'Что это',      'href' => '#chto-takoe-ai-marshrutizaciya' ],
    [ 'label' => 'Как работает', 'href' => '#kak-rabotaet' ],
    [ 'label' => 'Сценарии',     'href' => '#scenarii-otrasli' ],
    [ 'label' => 'Интеграции',   'href' => '#integracii' ],
    [ 'label' => 'Внедрение',    'href' => '#etapy-vnedreniya' ],
    [ 'label' => 'Rule vs ML',   'href' => '#rule-based-ili-ml' ],
    [ 'label' => 'Стоимость',    'href' => '#stoimost' ],
    [ 'label' => 'Кейсы',        'href' => '#keisy' ],
    [ 'label' => 'Метрики',      'href' => '#metriki' ],
    [ 'label' => 'FAQ',          'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
    $nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if ( ! is_readable( $nero_ai_floating ) ) {
    require dirname( __DIR__ ) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}

?>

<?php nero_ai_echo_theme_styles( [ 'nero-ai-longread-ui-compat.css' ] ); ?>

<style>
/* Hero ai-marshrutizaciya — самодостаточные стили (scoped) */
.ai-marshrut-page {
  --nero-ai-bg: #060812;
  --nero-ai-text: #e6edf7;
  --nero-ai-muted: #9aa8bd;
  --nero-ai-soft: #c7d2e5;
  --nero-ai-heading: #ffffff;
  --nero-ai-primary: #79f2ff;
  --nero-ai-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  --nero-ai-container: 1220px;
}
.ai-marshrut-page .nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.ai-marshrut-page .nero-ai-hero::before {
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
.ai-marshrut-page .nero-ai-hero::after {
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
  animation: marshrutHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes marshrutHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to   { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.ai-marshrut-page .nero-ai-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.ai-marshrut-page .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.ai-marshrut-page .nero-ai-eyebrow {
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
.ai-marshrut-page .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(40px, 6.8vw, 88px);
  line-height: .91;
  letter-spacing: -0.075em;
  color: var(--nero-ai-heading);
}
.ai-marshrut-page .nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, var(--nero-ai-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.ai-marshrut-page .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--nero-ai-soft) !important;
  font-size: clamp(18px, 2vw, 22px);
  line-height: 1.58;
}
.ai-marshrut-page .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.ai-marshrut-page .nero-ai-badge {
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
.ai-marshrut-page .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.ai-marshrut-page .nero-ai-btn {
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
  transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
}
.ai-marshrut-page .nero-ai-btn:hover,
.ai-marshrut-page .nero-ai-btn:focus-visible { transform: translateY(-2px); }
.ai-marshrut-page .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--nero-ai-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.ai-marshrut-page .nero-ai-btn-secondary {
  color: var(--nero-ai-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.ai-marshrut-page .nero-ai-btn-secondary:hover {
  border-color: rgba(121, 242, 255, 0.36);
  background: rgba(121, 242, 255, 0.08);
}
.ai-marshrut-page .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--nero-ai-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.ai-marshrut-page .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.ai-marshrut-page .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.ai-marshrut-page .nero-ai-dots { display: flex; gap: 7px; }
.ai-marshrut-page .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.ai-marshrut-page .nero-ai-dot:nth-child(1) { background: #fb7185; }
.ai-marshrut-page .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.ai-marshrut-page .nero-ai-dot:nth-child(3) { background: #34d399; }
.ai-marshrut-page .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.ai-marshrut-page .nero-ai-window-body { padding: 18px; }
.ai-marshrut-page .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
}
.ai-marshrut-page .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -0.03em;
  color: #fff;
}
.ai-marshrut-page .nero-ai-live-pill {
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
.ai-marshrut-page .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: marshrutPulse 1.6s infinite;
}
@keyframes marshrutPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.ai-marshrut-page #hero-marshrutizaciya-canvas {
  display: block;
  width: 100%;
  height: 110px;
  margin-bottom: 14px;
  border-radius: 16px;
  border: 1px solid rgba(121,242,255,.14);
  background: radial-gradient(circle at 50% 50%, rgba(121,242,255,.08), rgba(6,10,24,.6));
}
.ai-marshrut-page .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
.ai-marshrut-page .nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease;
}
.ai-marshrut-page .nero-ai-metric:hover { transform: translateY(-3px); border-color: rgba(121,242,255,.34); }
.ai-marshrut-page .nero-ai-metric span { display: block; color: var(--nero-ai-muted); font-size: 12px; font-weight: 700; }
.ai-marshrut-page .nero-ai-metric strong { display: block; margin-top: 7px; color: #fff; font-size: 24px; line-height: 1; }
.ai-marshrut-page .nero-ai-metric small { display: block; margin-top: 6px; color: #9fb0c9; font-size: 12px; }
.ai-marshrut-page .nero-ai-task-stream { margin-top: 16px; display: grid; gap: 10px; }
.ai-marshrut-page .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
  animation: marshrutTaskFloat 5s ease-in-out infinite;
}
.ai-marshrut-page .nero-ai-task:nth-child(2) { animation-delay: .6s; }
.ai-marshrut-page .nero-ai-task:nth-child(3) { animation-delay: 1.2s; }
.ai-marshrut-page .nero-ai-task:nth-child(4) { animation-delay: 1.8s; }
@keyframes marshrutTaskFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-4px); }
}
.ai-marshrut-page .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--nero-ai-primary);
  font-size: 11px;
  font-weight: 800;
}
.ai-marshrut-page .nero-ai-task strong { display: block; color: #f8fafc; font-size: 13px; }
.ai-marshrut-page .nero-ai-task span { color: var(--nero-ai-muted); font-size: 12px; }
.ai-marshrut-page .nero-ai-status {
  padding: 5px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
}
.ai-marshrut-page .nero-ai-status.is-new {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
.ai-marshrut-page .nero-ai-reveal {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity .55s ease, transform .55s ease;
}
.ai-marshrut-page .nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
.ai-marshrut-page .nero-ai-delay-2 { transition-delay: .24s; }
@media (max-width: 1024px) {
  .ai-marshrut-page .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .ai-marshrut-page .nero-ai-dashboard { transform: none; }
}
@media (max-width: 640px) {
  .ai-marshrut-page .nero-ai-hero { min-height: auto; padding-top: 56px; }
  .ai-marshrut-page .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
}
</style>
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

.vna-link-accent{color:var(--vna-accent)!important;font-weight:700;text-decoration:underline;text-underline-offset:3px;}
.vna-link-accent:hover{color:#fff!important;}
.vna-secondary-cta{font-size:14.5px;color:var(--vna-muted);line-height:1.65;}
.vna-secondary-cta a{color:var(--vna-accent);text-decoration:underline;}
.ym-cta-block--primary{display:flex;align-items:flex-start;gap:20px;text-align:left;}
.ym-cta-block--primary .ym-cta-block__body{flex:1;}
@media(max-width:600px){.ym-cta-block--primary{flex-direction:column;text-align:center;}}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-marshrut-page" role="main" tabindex="-1">
<span id="main" class="screen-reader-text" tabindex="-1"></span>

<section class="nero-ai-hero ai-marshrut-hero" id="hero" aria-labelledby="hero-marshrutizaciya-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · маршрутизация обращений</p>
      <h1 id="hero-marshrutizaciya-title">
        AI-маршрутизация обращений:
        <span class="nero-ai-gradient-text">внедрение под ключ</span>
      </h1>
      <p class="nero-ai-hero-lead">AI определяет проблему и сразу направляет обращение в нужный отдел — без «перекидывания» клиента между сотрудниками</p>
      <ul class="nero-ai-badges" aria-label="Каналы и сценарии">
        <li class="nero-ai-badge">Голос</li>
        <li class="nero-ai-badge">Чат</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">КЦ</li>
        <li class="nero-ai-badge">Медицина</li>
        <li class="nero-ai-badge">Triage</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-маршрутизация обращений">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true">
            <span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span>
          </div>
          <span class="nero-ai-window-title">маршрутизация обращений · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-маршрутизатор онлайн</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <canvas id="hero-marshrutizaciya-canvas" width="480" height="110" aria-hidden="true"></canvas>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Transfer rate</span>
              <strong>&lt;10%</strong>
              <small>цель после AI</small>
            </div>
            <div class="nero-ai-metric">
              <span>Intent</span>
              <strong>18</strong>
              <small>категорий</small>
            </div>
            <div class="nero-ai-metric">
              <span>Маршрут</span>
              <strong>18 сек</strong>
              <small>до оператора</small>
            </div>
            <div class="nero-ai-metric">
              <span>Авторазрешение</span>
              <strong>52%</strong>
              <small>типовых запросов</small>
            </div>
          </div>
          <div class="nero-ai-task-stream" aria-label="Лента маршрутизации">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">IN</span>
              <div><strong>Входящий звонок</strong><span>NLP-классификация</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Intent «возврат товара»</strong><span>отдел претензий</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Тикет с контекстом</strong><span>оператору</span></div>
              <span class="nero-ai-status is-new">новое</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↳</span>
              <div><strong>Handoff</strong><span>без повторения истории</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  var canvas = document.getElementById('hero-marshrutizaciya-canvas');
  if (!canvas || !canvas.getContext) return;
  var ctx = canvas.getContext('2d');
  var dpr = Math.min(window.devicePixelRatio || 1, 2);
  var hubs = [
    { x: 0.5, y: 0.5, label: 'AI' },
    { x: 0.14, y: 0.28, label: 'КЦ' },
    { x: 0.86, y: 0.28, label: 'CRM' },
    { x: 0.14, y: 0.78, label: 'Мед' },
    { x: 0.86, y: 0.78, label: 'ТП' }
  ];
  var packets = [];
  var t = 0;

  function resize() {
    var rect = canvas.getBoundingClientRect();
    canvas.width = Math.floor(rect.width * dpr);
    canvas.height = Math.floor(rect.height * dpr);
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function spawnPacket() {
    var from = hubs[0];
    var target = hubs[1 + Math.floor(Math.random() * 4)];
    packets.push({ from: from, to: target, p: 0, speed: 0.012 + Math.random() * 0.01 });
  }

  function drawHub(h, active) {
    var w = canvas.getBoundingClientRect().width;
    var hgt = canvas.getBoundingClientRect().height;
    var x = h.x * w;
    var y = h.y * hgt;
    ctx.beginPath();
    ctx.arc(x, y, active ? 16 : 13, 0, Math.PI * 2);
    ctx.fillStyle = active ? 'rgba(121,242,255,0.22)' : 'rgba(255,255,255,0.08)';
    ctx.fill();
    ctx.strokeStyle = active ? 'rgba(121,242,255,0.75)' : 'rgba(255,255,255,0.18)';
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.fillStyle = '#e6edf7';
    ctx.font = '600 10px Inter, system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(h.label, x, y + 4);
  }

  function frame() {
    var w = canvas.getBoundingClientRect().width;
    var hgt = canvas.getBoundingClientRect().height;
    ctx.clearRect(0, 0, w, hgt);
    hubs.forEach(function (hub, i) { drawHub(hub, i === 0); });
    hubs.slice(1).forEach(function (hub) {
      ctx.beginPath();
      ctx.moveTo(hubs[0].x * w, hubs[0].y * hgt);
      ctx.lineTo(hub.x * w, hub.y * hgt);
      ctx.strokeStyle = 'rgba(121,242,255,0.12)';
      ctx.lineWidth = 1;
      ctx.stroke();
    });
    packets.forEach(function (pkt) {
      pkt.p += pkt.speed;
      var x = pkt.from.x * w + (pkt.to.x - pkt.from.x) * w * pkt.p;
      var y = pkt.from.y * hgt + (pkt.to.y - pkt.from.y) * hgt * pkt.p;
      ctx.beginPath();
      ctx.arc(x, y, 4, 0, Math.PI * 2);
      ctx.fillStyle = '#79f2ff';
      ctx.fill();
    });
    packets = packets.filter(function (p) { return p.p < 1; });
    if (t % 45 === 0) spawnPacket();
    t++;
    requestAnimationFrame(frame);
  }

  resize();
  window.addEventListener('resize', resize);
  requestAnimationFrame(frame);

  document.querySelectorAll('.ai-marshrut-page .nero-ai-reveal').forEach(function (el) {
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (entries, obs) {
        entries.forEach(function (e) {
          if (e.isIntersecting) { e.target.classList.add('nero-ai-active'); obs.unobserve(e.target); }
        });
      }, { threshold: 0.12 }).observe(el);
    } else {
      el.classList.add('nero-ai-active');
    }
  });
})();
</script>

<div class="vna-content">

<!-- CONTENT SECTION — ai-marshrutizaciya-obrashchenij-pod-klyuch (не hero) -->

  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vna-intro-text nero-ai-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai маршрутизация обращений</p>
          <p><strong>Коротко:</strong> AI-маршрутизация обращений — система, которая на входе любого канала (голос, чат, форма, мессенджер) анализирует суть запроса, определяет намерение и направляет клиента в нужный отдел или к компетентному специалисту без лишних переключений. Nero Network внедряет такие решения под ключ: от карты маршрутов до интеграции с CRM и телефонией.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые метрики">
          <div class="vna-kpi-card"><div class="kv">20–30%</div><div class="kl">transfer rate у IVR</div><div class="ks">отраслевые оценки</div></div>
          <div class="vna-kpi-card"><div class="kv">&lt;10%</div><div class="kl">цель после AI</div><div class="ks">Teneo, Transcom</div></div>
          <div class="vna-kpi-card"><div class="kv">−54%</div><div class="kl">hunting time</div><div class="ks">Natterbox 2026</div></div>
          <div class="vna-kpi-card"><div class="kv">250–700К</div><div class="kl">чек под ключ</div><div class="ks">КЦ 15–80 оп.</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление">
        <a href="#pochemu-perekidyvayut">Проблема</a>
        <a href="#chto-takoe-ai-marshrutizaciya">Что это</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#scenarii-otrasli">Сценарии</a>
        <a href="#integracii">Интеграции</a>
        <a href="#etapy-vnedreniya">Внедрение</a>
        <a href="#rule-based-ili-ml">Rule vs ML</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#metriki">Метрики</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- H2 1 -->
  <section class="vna-section" id="pochemu-perekidyvayut">
    <div class="vna-cnt">
      <div class="vna-sh vna-left">
        <span class="vna-eyebrow">Боль клиента</span>
        <h2>Почему клиентов «перекидывают» между отделами — и сколько это стоит бизнесу</h2>
      </div>
      <div class="vna-card nero-ai-reveal">
        <p>Знакомый сценарий: клиент звонит в сервис, объясняет проблему первому оператору — и слышит: «Сейчас переведу вас на другого специалиста». Потом ещё раз. И ещё. К третьему сотруднику человек уже повторяет одно и то же с нарастающим раздражением.</p>
        <p>В отрасли это <strong>transfer rate</strong> — доля обращений, которые уходят не тому агенту или не в тот отдел. У компаний с классическим IVR transfer rate достигает <strong>20–30%</strong>. У tech-лидера до conversational routing <strong>37% звонков</strong> уходили не тому агенту (Teneo); после AI — <strong>менее 10%</strong>.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="vna-card"><h3 style="font-size:17px;">Время клиента</h3><p>По Natterbox 2026 (58,2 млн звонков) hunting time сократился с 5,15 мин (2024) до 2,37 мин (2025) — на <strong>54%</strong>.</p></div>
        <div class="vna-card"><h3 style="font-size:17px;">Лояльность и FCR</h3><p>Каждое лишнее переключение снижает FCR и бьёт по CSAT/NPS. Операторы тратят минуты на переспрос вместо решения.</p></div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:24px;">
        <p>IBM в обзоре Contact Center Automation Trends 2026 называет intelligent routing одним из самых измеримых сценариев AI в сервисе: эффект виден в transfer rate, hunting time, AHT и FCR уже в первые недели пилота.</p>
        <p><strong>Вывод:</strong> боль «клиента перекидывают» — управляемая метрика. Её можно снизить, если AI на входе определяет проблему и направляет в нужный отдел.</p>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-pain">
      <div class="ym-cta-block__icon" aria-hidden="true">🗺️</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Устали от «перекидывания» клиентов?</p>
        <p class="ym-cta-block__sub">Соберём карту маршрутов: бесплатный аудит 15–25 категорий обращений, матрица intent → отдел → SLA и оценка текущего transfer rate.</p>
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>
  </div>

  <!-- H2 2 -->
  <section class="vna-section vna-section-alt" id="chto-takoe-ai-marshrutizaciya">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Определение</span>
        <h2>Что такое AI-маршрутизация обращений</h2>
        <p>Система автоматической классификации и распределения входящих запросов по всем каналам.</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <p><strong>Определение:</strong> AI-маршрутизация обращений определяет намерение (intent), приоритет и целевой отдел, затем закрывает типовой запрос или передаёт человеку с полным контекстом.</p>
        <p>В отличие от IVR «нажмите 1, нажмите 2», система работает с <strong>естественной речью и текстом</strong> — это <strong>ai triage support</strong> и <strong>ai routing customer service</strong>.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Типовой стек</h3>
          <ul>
            <li>ASR или текст → NLP/LLM-классификация intent</li>
            <li>Движок: правила + ML + skills-based routing</li>
            <li>Интеграция CRM, АТС, helpdesk</li>
            <li>Human handoff с транскриптом и confidence</li>
            <li>Аналитика: transfer rate, FCR, AHT, CSAT</li>
          </ul>
        </div>
        <div class="vna-card">
          <h3 style="font-size:17px;margin-bottom:10px;">Для бизнеса в 2026</h3>
          <p>Типовой сценарий <strong>внедрения AI в бизнес-процессы</strong> сервиса. Gartner: к 2028 ≥<strong>70% клиентов</strong> начнут путь через conversational AI.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================
       БОРИС: визуальный блок — карта маршрутов
       ================================================ -->
  <section id="boris-marshrutizaciya-viz" class="bmt-root" aria-label="Карта маршрутизации обращений: intent → отдел → SLA">
<style>
/* === БОРИС bmt-*, scoped #boris-marshrutizaciya-viz === */
.bmt-root{padding:clamp(48px,6vw,72px) 0;background:#f0f4fb;}
.bmt-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
.bmt-card{
  display:grid;grid-template-columns:42% 58%;
  border-radius:24px;overflow:hidden;
  box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(6,182,212,.18);
  min-height:520px;
}
@media(max-width:960px){.bmt-card{grid-template-columns:1fr;min-height:auto;}}
.bmt-lft{background:#fff;padding:48px 40px;display:flex;flex-direction:column;justify-content:center;}
@media(max-width:600px){.bmt-lft{padding:32px 24px;}}
.bmt-ey{display:inline-flex;align-items:center;gap:7px;font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;color:#0891b2;margin:0 0 15px;}
.bmt-ey::before{content:'';display:inline-block;width:20px;height:2px;background:#0891b2;border-radius:1px;}
.bmt-h3{font-size:25px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 22px;}
@media(max-width:600px){.bmt-h3{font-size:20px;}}
.bmt-ul{list-style:none;margin:0 0 26px;padding:0;display:flex;flex-direction:column;gap:10px;}
.bmt-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14.5px;line-height:1.5;color:#334155;}
.bmt-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(8,145,178,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0891b2;margin-top:1px;font-style:normal;}
.bmt-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:22px;}
.bmt-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
.bmt-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
.bmt-pl-b{background:rgba(8,145,178,.08);color:#0e7490;border:1.5px solid rgba(8,145,178,.22);}
.bmt-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
.bmt-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
.bmt-rgt{background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);position:relative;overflow:hidden;min-height:400px;}
@media(max-width:960px){.bmt-rgt{min-height:380px;}}
#bmt-routing-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bmt-cnt"><div class="bmt-card">
  <div class="bmt-lft">
    <span class="bmt-ey">Карта маршрутов · лид-магнит</span>
    <h3 class="bmt-h3">Intent → отдел → SLA: как выглядит маршрутизация на ваших данных</h3>
    <ul class="bmt-ul">
      <li><span class="bmt-ic">1</span>15–25 intent-категорий из реальных обращений</li>
      <li><span class="bmt-ic">2</span>Матрица: намерение → целевой отдел → порог эскалации</li>
      <li><span class="bmt-ic">3</span>Выявление «перекидных» сценариев (≥2 transfer)</li>
      <li><span class="bmt-ic">↳</span>Основа для пилота: один канал, CRM, human handoff</li>
    </ul>
    <div class="bmt-pills">
      <span class="bmt-pl bmt-pl-g">89% точность · Петрович</span>
      <span class="bmt-pl bmt-pl-b">18 сек маршрут · Сбер</span>
      <span class="bmt-pl bmt-pl-v">18 intent · Ренессанс</span>
    </div>
    <p class="bmt-foot">Дальше — как работает маршрутизация от обращения до специалиста →</p>
  </div>
  <div class="bmt-rgt">
    <canvas id="bmt-routing-canvas" aria-label="Анимация карты маршрутизации: обращения из каналов направляются в отделы по intent" role="img"></canvas>
  </div>
</div></div>
<script>
(function(){
  var cv=document.getElementById('bmt-routing-canvas');if(!cv)return;
  var cx=cv.getContext('2d'),W=0,H=0,t=0;
  function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||520;W=cv.width;H=cv.height;}
  window.addEventListener('resize',resize);resize();
  var nodes=[
    {id:'in',label:'Вход',x:.12,y:.5,r:28,clr:'#60a5fa'},
    {id:'ai',label:'AI intent',x:.38,y:.5,r:32,clr:'#a78bfa'},
    {id:'d1',label:'Претензии',x:.72,y:.18,r:24,clr:'#f472b6'},
    {id:'d2',label:'Техподдержка',x:.72,y:.42,r:24,clr:'#4ade80'},
    {id:'d3',label:'Продажи',x:.72,y:.66,r:24,clr:'#fbbf24'},
    {id:'d4',label:'Медицина',x:.72,y:.88,r:24,clr:'#22d3ee'}
  ];
  var edges=[[0,1],[1,2],[1,3],[1,4],[1,5]];
  var packets=[
    {e:0,prog:0,spd:.004,clr:'#60a5fa'},
    {e:1,prog:.2,spd:.003,clr:'#f472b6'},
    {e:2,prog:.5,spd:.0035,clr:'#4ade80'},
    {e:3,prog:.7,spd:.003,clr:'#fbbf24'},
    {e:4,prog:.35,spd:.0028,clr:'#22d3ee'}
  ];
  function lerp(a,b,p){return a+(b-a)*p;}
  function drawNode(n,a){
    var x=n.x*W,y=n.y*H;
    cx.beginPath();cx.arc(x,y,n.r,0,Math.PI*2);
    cx.fillStyle=n.clr+'33';cx.fill();
    cx.strokeStyle=n.clr;cx.lineWidth=2;cx.stroke();
    cx.fillStyle='#e2e8f0';cx.font='bold 11px Inter,sans-serif';cx.textAlign='center';
    cx.fillText(n.label,x,y+4);
    if(n.id==='ai'){
      var p=.5+.5*Math.sin(t*.05);
      cx.beginPath();cx.arc(x,y,n.r+6+p*4,0,Math.PI*2);
      cx.strokeStyle='rgba(167,139,250,'+(0.15+p*0.2)+')';cx.lineWidth=1;cx.stroke();
    }
  }
  function drawEdge(a,b){
    var na=nodes[a],nb=nodes[b];
    cx.beginPath();cx.moveTo(na.x*W,na.y*H);cx.lineTo(nb.x*W,nb.y*H);
    cx.strokeStyle='rgba(255,255,255,.12)';cx.lineWidth=1.5;cx.stroke();
  }
  function drawPacket(pk){
    var e=edges[pk.e],na=nodes[e[0]],nb=nodes[e[1]];
    pk.prog+=pk.spd;if(pk.prog>1)pk.prog=0;
    var x=lerp(na.x*W,nb.x*W,pk.prog),y=lerp(na.y*H,nb.y*H,pk.prog);
    cx.beginPath();cx.arc(x,y,5,0,Math.PI*2);cx.fillStyle=pk.clr;cx.fill();
    cx.beginPath();cx.arc(x,y,9,0,Math.PI*2);cx.strokeStyle=pk.clr+'55';cx.stroke();
  }
  function frame(){
    t++;cx.clearRect(0,0,W,H);
    cx.fillStyle='rgba(255,255,255,.03)';cx.font='10px Inter,sans-serif';cx.textAlign='left';
    cx.fillText('маршрутизация · live',14,18);
    edges.forEach(function(e){drawEdge(e[0],e[1]);});
    nodes.forEach(function(n){drawNode(n);});
    packets.forEach(drawPacket);
    requestAnimationFrame(frame);
  }
  frame();
})();
</script>
  </section>


  <!-- H2 3 -->
  <section class="vna-section" id="kak-rabotaet">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Процесс</span>
        <h2>Как работает AI-маршрутизация: от обращения до нужного специалиста</h2>
        <p>Шесть шагов, которые проходит каждое обращение в системе Nero Network.</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <div class="vna-timeline">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>1. Поступление</h3><p>Звонок, чат, форма, Telegram, email.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>2. Идентификация</h3><p>По телефону или email подтягивается история из CRM.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>3. Анализ</h3><p>ASR или текст → intent, сущности, тональность, срочность.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>4. Маршрут</h3><p>Автоответ / очередь / специалист / эскалация.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>5. Handoff</h3><p>Оператор видит транскрипт, intent, confidence, скрипт.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>6. Аналитика</h3><p>Дашборд; нарушения SLA → алерт супервайзеру.</p></div>
        </div>
      </div>

      <div class="vna-scenario nero-ai-reveal" style="margin-top:28px;" id="nlp-asr">
        <div class="vna-sc-icon" aria-hidden="true">🎯</div>
        <div>
          <h3>Распознавание намерения (NLP/ASR): AI определяет отдел</h3>
          <p><strong>Классификация обращений AI</strong> превращает свободную формулировку в intent. Для голоса — ASR (Yandex SpeechKit); для текста — NLP/LLM. Выделяются тематика, сущности (заказ, регион), приоритет и тональность.</p>
          <p>Кейс СТД «Петрович»: LLM-классификация 20 тыс. звонков — точность <strong>89,03%</strong> по трёхуровневой таксономии.</p>
        </div>
      </div>

      <div class="vna-scenario nero-ai-reveal nero-ai-delay-1" id="raspredelenie">
        <div class="vna-sc-icon" aria-hidden="true">📞</div>
        <div>
          <h3>Маршрут в отдел: AI распределение звонков и заявок</h3>
          <p><strong>AI распределение звонков</strong> — skills-based очередь. <strong>AI распределение заявок</strong> — тикет/лид в CRM с intent и priority. Типовые запросы закрываются без оператора.</p>
          <p>Сбер: AI маршрутизирует <strong>87%</strong> корпоративных клиентов; время маршрутизации ↓ в <strong>3,5 раза</strong> (до 18 сек); точность <strong>77%</strong>.</p>
        </div>
      </div>

      <div class="vna-scenario nero-ai-reveal nero-ai-delay-2" id="handoff">
        <div class="vna-sc-icon" aria-hidden="true">🤝</div>
        <div>
          <h3>Эскалация и передача человеку (human handoff)</h3>
          <p>Срабатывает при низком confidence, эмоциональном запросе, просьбе оператора или «запрещённых» сценариях (медицина, финансы). Оператор получает <strong>context pack</strong> — клиент не повторяет историю с нуля.</p>
          <p><a href="<?php echo esc_url( $primary_cta_url ); ?>" class="vna-link-accent"><?php echo esc_html( $primary_cta_label ); ?></a> — получите матрицу intent → отдел → SLA на основе ваших обращений.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 4 -->
  <section class="vna-section vna-section-alt" id="scenarii-otrasli">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Отрасли</span>
        <h2>Сценарии внедрения по отраслям</h2>
      </div>
      <div class="vna-scenario nero-ai-reveal">
        <div class="vna-sc-icon">☎️</div>
        <div><h3>Контакт-центры</h3>
        <p><strong>Маршрутизация обращений контакт-центр</strong> — conversational AI вместо DTMF. Ростелеком Омнибот: до <strong>50%</strong> автоматизации чатов, до 300 тыс. запросов/сутки.</p></div>
      </div>
      <div class="vna-scenario nero-ai-reveal nero-ai-delay-1">
        <div class="vna-sc-icon">🔧</div>
        <div><h3>Техподдержка и сервис</h3>
        <p><strong>AI для техподдержки маршрутизация</strong> через skills-based routing. CallTraffic: <strong>70%</strong> авто, FCR <strong>85%</strong>, CSAT <strong>92%</strong>, отклик −40%.</p></div>
      </div>
      <div class="vna-scenario nero-ai-reveal nero-ai-delay-2">
        <div class="vna-sc-icon">🏥</div>
        <div><h3>Медицина</h3>
        <p><strong>Маршрутизация обращений в медицине AI</strong> — терминология, ДМС, запись. МЕДСИ: &gt;3,5 млн звонков/год, <strong>95%</strong> положительных оценок. «Доктор Плюс»: <strong>44%</strong> автономно, SL +15%.</p></div>
      </div>
      <div class="vna-scenario nero-ai-reveal nero-ai-delay-1">
        <div class="vna-sc-icon">💬</div>
        <div><h3>Голос, чат и формы: единая карта</h3>
        <p><strong>Голосовая маршрутизация AI</strong> и <strong>маршрутизация обращений в чате AI</strong> — один intent-слой. «Ренессанс страхование»: 18 тематик, <strong>52%</strong> автоматизации, AHT 100 сек.</p></div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:24px;">
        <p><strong>Итог:</strong> независимо от ниши, AI определяет суть и направляет к компетентному специалисту. Меняются таксономия, интеграции и пороги эскалации.</p>
      </div>
    </div>
  </section>

  <!-- H2 5 -->
  <section class="vna-section" id="integracii">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Интеграции</span>
        <h2>Интеграция AI-маршрутизации с CRM, телефонией и helpdesk</h2>
        <p>Без интеграций маршрутизация остаётся «умным меню». С CRM и АТС — управляемым бизнес-процессом.</p>
      </div>
      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card" id="integraciya-crm">
          <span class="vna-eyebrow">CRM</span>
          <h3>amoCRM, Битрикс24</h3>
          <p><strong>Интеграция ai маршрутизация обращений с crm</strong>: лид/тикет с intent, priority, история клиента, skills-очереди. amoCRM, Битрикс24, retailCRM, 1С.</p>
          <p style="margin-top:12px;font-size:14px;">Смежный сценарий: <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-amocrm/' ) ); ?>" style="color:var(--vna-accent);">внедрение AI-агента в amoCRM</a> — маршрутизация лидов, skills-очереди и handoff в одной CRM.</p>
        </div>
        <div class="vna-card nero-ai-delay-1" id="integraciya-ats">
          <span class="vna-eyebrow">Телефония</span>
          <h3>АТС и голос</h3>
          <p><strong>Интеграция ai с телефонией</strong>: Mango, Zadarma, Sipuni, Ростелеком ВАТС. Звонок → ASR → intent → очередь. Транскрипт в CRM.</p>
        </div>
        <div class="vna-card nero-ai-delay-2" id="integraciya-helpdesk">
          <span class="vna-eyebrow">Helpdesk</span>
          <h3>Тикеты и мессенджеры</h3>
          <p><strong>AI маршрутизация helpdesk</strong>: Naumen, Okdesk, Telegram, WhatsApp. Email parser — кейс «Наносемантика» + Минюст РФ.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 6 -->
  <section class="vna-section vna-section-alt" id="etapy-vnedreniya">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Под ключ</span>
        <h2>Этапы внедрения AI-маршрутизации под ключ</h2>
        <p>Типовой цикл для КЦ 15–80 операторов: <strong>1–3 месяца</strong>.</p>
      </div>
      <div class="vna-timeline nero-ai-reveal">
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Фаза 0 (1 нед.) — Карта маршрутов</h3><p>200–500 обращений → 15–25 intent → PDF «Карта маршрутизации» + матрица intent → отдел → SLA.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Фаза 1 (2–3 нед.) — Пилот в одном канале</h3><p>Голос или чат; ASR + LLM + webhook в CRM.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Фаза 2 (2–4 нед.) — Омниканал + handoff</h3><p>Единая очередь; skills-based routing; дашборд метрик.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Фаза 3 — Обучение и MLOps-lite</h3><p>Разбор ошибок раз в 2 недели; новые intent без остановки линии.</p></div>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-etapy">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Начните с фазы 0 — карта маршрутов</p>
        <p class="ym-cta-block__sub">200–500 исторических обращений → 15–25 intent-категорий → PDF с матрицей маршрутизации. Подход «Петровича»: 89% точности за 3 недели.</p>
        <ul class="vna-cta-checklist">
          <li>Аудит «перекидных» сценариев</li>
          <li>Матрица intent → отдел → SLA</li>
          <li>Оценка transfer rate до пилота</li>
        </ul>
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>
  </div>

  <!-- H2 7 -->
  <section class="vna-section" id="rule-based-ili-ml">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Архитектура</span>
        <h2>Rule-based или ML: какой подход выбрать</h2>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Критерий</th><th>Rule-based / DTMF IVR</th><th>ML / LLM маршрутизация</th></tr></thead>
          <tbody>
            <tr><td>Вход</td><td>Кнопки, ключевые слова</td><td>Естественная речь и текст</td></tr>
            <tr><td>Гибкость</td><td>Низкая</td><td>Адаптация к новым формулировкам</td></tr>
            <tr><td>Transfer rate</td><td>20–30%</td><td>Целевой &lt;10%</td></tr>
            <tr><td>Контекст CRM</td><td>Часто нет</td><td>История в момент маршрута</td></tr>
            <tr><td>Время внедрения</td><td>Быстро, но устаревает</td><td>Пилот 2–4 нед., цикл 1–3 мес.</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:24px;">
        <p><strong>Когда достаточно rules:</strong> менее 5 стабильных сценариев, один канал. <strong>Когда нужен AI:</strong> более 10 intent, омниканал, высокий transfer.</p>
        <p>Оптимальная архитектура Nero Network — <strong>гибрид</strong>: LLM + rule-based fallback + пороги confidence.</p>
        <p class="vna-secondary-cta" style="margin-top:16px;padding:16px 20px;background:rgba(255,255,255,.04);border-radius:12px;border:1px solid rgba(255,255,255,.08);">Команда должна понимать логику маршрутизации и пороги confidence — <a href="<?php echo esc_url( $secondary_cta_url ); ?>" target="_blank" rel="noopener noreferrer" style="color:var(--vna-accent);text-decoration:underline;"><?php echo esc_html( $secondary_cta_label ); ?></a> поможет супервайзерам и IT быстрее войти в проект.</p>
      </div>
    </div>
  </section>

  <!-- H2 8 -->
  <section class="vna-section vna-section-alt" id="stoimost">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Бюджет</span>
        <h2>Стоимость внедрения AI-маршрутизации обращений</h2>
      </div>
      <div class="vna-kpi-card nero-ai-reveal" style="max-width:420px;margin:0 auto 32px;text-align:center;padding:28px;">
        <div class="kv" style="font-size:32px;">250–700 тыс. ₽</div>
        <div class="kl">ориентир проекта под ключ</div>
        <div class="ks">КЦ 15–80 операторов</div>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Фактор</th><th>Влияние на цену</th></tr></thead>
          <tbody>
            <tr><td>Каналы (голос, чат, email, мессенджеры)</td><td>+за каждый омниканальный канал</td></tr>
            <tr><td>Число intent (15–25 vs 50+)</td><td>+разметка и обучение</td></tr>
            <tr><td>Интеграции (CRM, АТС, helpdesk)</td><td>+API, кастомные коннекторы</td></tr>
            <tr><td>Объём обращений и SLA</td><td>+инфраструктура ASR/LLM</td></tr>
            <tr><td>Отрасль (медицина, финансы)</td><td>+комплаенс, on-prem</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:24px;">
        <h3 style="font-size:17px;">Что входит в типовой проект</h3>
        <ul>
          <li>Аудит и карта маршрутов</li>
          <li>Пилот на одном канале + интеграция CRM и телефонии</li>
          <li>Human handoff, дашборд, обучение, 2 недели поддержки</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- H2 9 -->
  <section class="vna-section" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Результаты</span>
        <h2>Кейсы и примеры внедрения</h2>
        <p>Российские пилоты ниже дополняют <a href="<?php echo esc_url( home_url( '/kpmg-claude-vnedrenie-ai-276-tysyach/' ) ); ?>" style="color:var(--vna-accent);">глобальные кейсы внедрения AI в бизнес</a> — в том числе опыт KPMG с Claude для 276&nbsp;000 сотрудников.</p>
      </div>
      <div class="vna-case-grid nero-ai-reveal">
        <div class="vna-case-card">
          <div class="vna-case-tag">Сбер · КЦ</div>
          <h3>Корпоративная маршрутизация</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">3,5×</span><span class="lbl">быстрее маршрутизация</span></div>
            <div class="vna-metric"><span class="num">87%</span><span class="lbl">клиентов через AI</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Петрович · ритейл</div>
          <h3>LLM-классификация звонков</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">89%</span><span class="lbl">точность intent</span></div>
            <div class="vna-metric"><span class="num">3 нед.</span><span class="lbl">срок пилота</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Ренессанс · страхование</div>
          <h3>LLM на горячей линии</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">52%</span><span class="lbl">автоматизация</span></div>
            <div class="vna-metric"><span class="num">60→30%</span><span class="lbl">отказ от бота</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">МЕДСИ · медицина</div>
          <h3>Голосовой агент 1-й линии</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">3,5M+</span><span class="lbl">звонков/год</span></div>
            <div class="vna-metric"><span class="num">95%</span><span class="lbl">положительных оценок</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">CallTraffic · логистика</div>
          <h3>Telegram + NLP triage</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">70%</span><span class="lbl">авто</span></div>
            <div class="vna-metric"><span class="num">92%</span><span class="lbl">CSAT</span></div>
          </div>
        </div>
        <div class="vna-case-card">
          <div class="vna-case-tag">Teneo · global</div>
          <h3>Intelligent routing</h3>
          <div class="vna-metrics">
            <div class="vna-metric"><span class="num">37→&lt;10%</span><span class="lbl">transfer rate</span></div>
            <div class="vna-metric"><span class="num">7M</span><span class="lbl">обращений/мес</span></div>
          </div>
        </div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:28px;text-align:center;">
        <p><a href="<?php echo esc_url( $primary_cta_url ); ?>" style="color:var(--vna-accent);font-weight:700;"><?php echo esc_html( $primary_cta_label ); ?></a> — первый шаг к пилоту на ваших данных.</p>
      </div>
    </div>
  </section>

  <!-- H2 10 -->
  <section class="vna-section vna-section-alt" id="metriki">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">KPI</span>
        <h2>Метрики до и после: что измерять</h2>
        <p>Без метрик маршрутизация — «внедрили нейросеть». С метриками — управляемый проект.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3>Transfer rate</h3>
          <p>Главный KPI боли. Цель — <strong>&lt;10%</strong> (Teneo, Transcom). Доля обращений с ≥1 переводом не в тот отдел.</p>
        </div>
        <div class="vna-card">
          <h3>FCR, AHT, CSAT/NPS</h3>
          <p>Рост FCR = меньше повторных обращений. «Ренессанс»: AHT 100 сек при 52% авто. CallTraffic: CSAT <strong>92%</strong>.</p>
        </div>
        <div class="vna-card">
          <h3>Hunting time</h3>
          <p>Время до нужной очереди: 5,15 → 2,37 мин (−54%, Natterbox 2026). Connection rate: 52,5% → 60,6%.</p>
        </div>
        <div class="vna-card">
          <h3>Дашборд Nero Network</h3>
          <p>Transfer rate · FCR · AHT · % авто · intent distribution · SLA breaches · confidence errors.</p>
        </div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:24px;">
        <p><strong>Итог:</strong> измеряйте до пилота и через 4–6 недель после — так виден эффект <strong>внедрения нейросетей в рабочие процессы</strong> сервиса.</p>
      </div>
    </div>
  </section>

  <!-- H2 11 FAQ -->
  <section class="vna-section" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Вопрос — ответ</span>
        <h2>FAQ по AI-маршрутизации обращений</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item" id="faq-cena">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит AI-маршрутизация обращений?</div>
          <div class="vna-faq-a"><p>Ориентир <strong>250–700 тыс. ₽</strong> под ключ для КЦ 15–80 операторов. Точная <strong>ai маршрутизация обращений цена</strong> — после аудита: зависит от каналов, числа intent и отрасли. Пилот на одном канале — нижняя граница.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-kak-vnedrit">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI-маршрутизацию в своей компании?</div>
          <div class="vna-faq-a"><p>Аудит 200–500 обращений → карта маршрутов → пилот на одном канале → интеграция CRM/АТС → омниканал + handoff → обучение модели. Срок <strong>1–3 месяца</strong>. Начните с CTA «<?php echo esc_html( $primary_cta_label ); ?>».</p></div>
        </div>
        <div class="vna-faq-item" id="faq-malyj-biznes">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли решение малому бизнесу?</div>
          <div class="vna-faq-a"><p><strong>AI маршрутизация обращений для малого бизнеса</strong> — да, при потоке от ~50 обращений/день и боли переключений. Пилот с 15 intent — минимальный вход. При &lt;5 сценариях достаточно rule-based без LLM.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-crm">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли интегрировать с существующей CRM?</div>
          <div class="vna-faq-a"><p>Да. <strong>Интеграция ai маршрутизация обращений с crm</strong> — стандартный блок: amoCRM, Битрикс24, retailCRM, 1С. Webhook создаёт лид/тикет с intent и контекстом.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-ivr">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от обычной IVR?</div>
          <div class="vna-faq-a"><p>IVR — меню на кнопках; AI понимает естественную речь, видит CRM, снижает transfer rate с 20–30% до &lt;10%. IVR не передаёт контекст — AI делает через human handoff.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-zamenit-operatorov">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI операторов контакт-центра?</div>
          <div class="vna-faq-a"><p>Нет. AI закрывает типовые запросы и маршрутизирует сложные — оператор получает готовый контекст. IBM: intelligent routing направляет сложные запросы к квалифицированным агентам быстрее.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-oshibka">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Что если AI ошибётся и отправит не в тот отдел?</div>
          <div class="vna-faq-a"><p>Три уровня защиты: порог confidence, rule-based fallback, обучение раз в 2 недели. Клиент всегда может запросить оператора.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-bezopasnost">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Как обеспечивается безопасность данных (152-ФЗ)?</div>
          <div class="vna-faq-a"><p>On-prem или российские облака, YandexGPT/GigaChat, обезличивание логов. Медицина и финансы — отдельные списки запрещённых автоответов.</p></div>
        </div>
        <div class="vna-faq-item" id="faq-pilot">
          <div class="vna-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько длится пилот?</div>
          <div class="vna-faq-a"><p><strong>2–4 недели</strong> на одном канале. «Петрович» — классификация 20 тыс. звонков за ~3 недели. Полный омниканал — <strong>1–3 месяца</strong>.</p></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы убрать лишние переключения?</p>
        <p class="ym-cta-block__sub">Соберём карту маршрутов бесплатно: 15–25 категорий intent, матрица intent → отдел → SLA, оценка transfer rate. Следующий шаг — пилот на одном канале с интеграцией в вашу CRM.</p>
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>
  </div>

  <?php if (getenv('AD_BANNER_URL') && getenv('AD_BANNER_IMAGE_URL')) : ?>
  <div class="vna-cnt" style="margin-top:32px;text-align:center;">
    <a href="<?php echo esc_url(getenv('AD_BANNER_URL')); ?>" target="_blank" rel="noopener noreferrer">
      <img src="<?php echo esc_url(getenv('AD_BANNER_IMAGE_URL')); ?>" width="970" height="90" alt="<?php echo esc_attr(getenv('AD_BANNER_ALT') ?: 'Реклама'); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;">
    </a>
  </div>
  <?php endif; ?>

<!-- FAQ ACCORDION -->
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

</div><!-- /.vna-content -->


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


<script type="application/ld+json">
<?php
$schema_org_id = $schema_site_url . '#organization';
$schema_web_id = $schema_site_url . '#website';
$schema_page_id = $schema_page_url . '#webpage';
$schema_breadcrumb_id = $schema_page_url . '#breadcrumb';
$schema_service_id = $schema_page_url . '#service';
$schema_faq_id = $schema_page_url . '#faq';
$schema_ld = [
  '@context' => 'https://schema.org',
  '@graph' => [
    [
      '@type' => 'Organization',
      '@id' => $schema_org_id,
      'name' => 'Nero Network',
      'url' => $schema_site_url,
    ],
    [
      '@type' => 'WebSite',
      '@id' => $schema_web_id,
      'url' => $schema_site_url,
      'name' => 'Nero Network',
      'publisher' => [ '@id' => $schema_org_id ],
    ],
    [
      '@type' => 'WebPage',
      '@id' => $schema_page_id,
      'url' => $schema_page_url,
      'name' => 'AI-маршрутизация обращений: внедрение под ключ',
      'description' => 'Внедряем AI-маршрутизацию обращений: голос, чат, заявки. AI направляет в нужный отдел без переключений. КЦ, медицина, техподдержка. Карта маршрутов бесплатно.',
      'isPartOf' => [ '@id' => $schema_web_id ],
      'about' => [ '@id' => $schema_org_id ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id' => $schema_breadcrumb_id,
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $schema_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => 'AI-маршрутизация обращений: внедрение под ключ', 'item' => $schema_page_url ],
      ],
    ],
    [
      '@type' => 'Service',
      '@id' => $schema_service_id,
      'name' => 'AI-маршрутизация обращений: внедрение под ключ',
      'description' => 'Внедряем AI-маршрутизацию обращений: голос, чат, заявки. AI направляет в нужный отдел без переключений. КЦ, медицина, техподдержка. Карта маршрутов бесплатно.',
      'url' => $schema_page_url,
      'provider' => [ '@id' => $schema_org_id ],
    ],
    [
      '@type' => 'FAQPage',
      '@id' => $schema_faq_id,
      'mainEntity' => json_decode(<<<'FAQJSON'
[
        {
          "@type": "Question",
          "name": "Сколько стоит AI-маршрутизация обращений?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Ориентир 250–700 тыс. ₽ под ключ для КЦ 15–80 операторов. Точная ai маршрутизация обращений цена — после аудита: зависит от каналов, числа intent и отрасли. Пилот на одном канале — нижняя граница."
          }
        },
        {
          "@type": "Question",
          "name": "Как внедрить AI-маршрутизацию в своей компании?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Аудит 200–500 обращений → карта маршрутов → пилот на одном канале → интеграция CRM/АТС → омниканал + handoff → обучение модели. Срок 1–3 месяца. Начните с CTA «Собрать карту маршрутов»."
          }
        },
        {
          "@type": "Question",
          "name": "Подходит ли решение малому бизнесу?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "AI маршрутизация обращений для малого бизнеса — да, при потоке от ~50 обращений/день и боли переключений. Пилот с 15 intent — минимальный вход. При <5 сценариях достаточно rule-based без LLM."
          }
        },
        {
          "@type": "Question",
          "name": "Можно ли интегрировать с существующей CRM?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да. Интеграция ai маршрутизация обращений с crm — стандартный блок: amoCRM, Битрикс24, retailCRM, 1С. Webhook создаёт лид/тикет с intent и контекстом."
          }
        },
        {
          "@type": "Question",
          "name": "Чем отличается от обычной IVR?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "IVR — меню на кнопках; AI понимает естественную речь, видит CRM, снижает transfer rate с 20–30% до <10%. IVR не передаёт контекст — AI делает через human handoff."
          }
        },
        {
          "@type": "Question",
          "name": "Заменит ли AI операторов контакт-центра?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Нет. AI закрывает типовые запросы и маршрутизирует сложные — оператор получает готовый контекст. IBM: intelligent routing направляет сложные запросы к квалифицированным агентам быстрее."
          }
        },
        {
          "@type": "Question",
          "name": "Что если AI ошибётся и отправит не в тот отдел?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Три уровня защиты: порог confidence, rule-based fallback, обучение раз в 2 недели. Клиент всегда может запросить оператора."
          }
        },
        {
          "@type": "Question",
          "name": "Как обеспечивается безопасность данных (152-ФЗ)?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "On-prem или российские облака, YandexGPT/GigaChat, обезличивание логов. Медицина и финансы — отдельные списки запрещённых автоответов."
          }
        },
        {
          "@type": "Question",
          "name": "Сколько длится пилот?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "2–4 недели на одном канале. «Петрович» — классификация 20 тыс. звонков за ~3 недели. Полный омниканал — 1–3 месяца."
          }
        }
      ]
FAQJSON
      , true),
    ],
  ],
];
echo wp_json_encode( $schema_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
?>
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

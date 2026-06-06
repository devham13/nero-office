<?php
/**
 * Template Name: AI-транскрибация звонков с резюме в CRM: внедрение под ключ
 * Description: AI-транскрибация звонков с резюме в CRM под ключ: расшифровка, протокол, задачи в amoCRM и Битрикс24.
 */

$page_seo_title       = 'AI-транскрибация звонков с резюме в CRM — под ключ';
$page_seo_description = 'AI-транскрибация звонков с резюме в CRM под ключ: расшифровка, протокол, задачи в amoCRM и Битрикс24. Получите пример AI-отчёта по звонку.';

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
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить пример отчёта';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#cta-demo-report';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Материалы по внедрению AI';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#vnedrenie-pod-klyuch';

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'CRM', 'href' => '#integraciya-crm'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

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
/* TRZK PAGE — global resets */
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}

.trzk-hero.nero-ai-hero{
  min-height:100vh;min-height:100dvh;position:relative;
}

.trzk-content{
  --trzk-bg:#050711;--trzk-bg2:#080b17;
  --trzk-surface:rgba(255,255,255,.072);
  --trzk-text:#e6edf7;--trzk-muted:#9aa8bd;--trzk-soft:#c7d2e5;--trzk-heading:#fff;
  --trzk-border:rgba(255,255,255,.10);
  --trzk-accent:#79f2ff;--trzk-violet:#8b5cf6;--trzk-green:#22c55e;
  --trzk-btn-from:#2563eb;--trzk-btn-to:#7c3aed;
  --trzk-container:1220px;--trzk-r:18px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--trzk-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.trzk-content *,.trzk-content *::before,.trzk-content *::after{box-sizing:border-box;}
.trzk-content p{color:var(--trzk-muted);line-height:1.72;margin:0 0 1em;text-align:left;}
.trzk-content p:last-child{margin-bottom:0;}
.trzk-content h2,.trzk-content h3,.trzk-content h4{color:var(--trzk-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.trzk-content strong{color:var(--trzk-soft);}
.trzk-content ul,.trzk-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.trzk-content ul li,.trzk-content ol li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--trzk-muted);font-size:14.5px;line-height:1.65;text-align:left;
}
.trzk-content ul li::before{content:'›';position:absolute;left:0;color:var(--trzk-accent);font-weight:700;}
.trzk-content ol{counter-reset:trzk-ol;}
.trzk-content ol li{counter-increment:trzk-ol;padding-left:28px;}
.trzk-content ol li::before{
  content:counter(trzk-ol);position:absolute;left:0;
  width:20px;height:20px;border-radius:50%;
  background:rgba(121,242,255,.12);color:var(--trzk-accent);
  font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;
}
.trzk-cnt{width:min(var(--trzk-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.trzk-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.trzk-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);
}
.trzk-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.trzk-sh.trzk-left{margin-left:0;text-align:left;}
.trzk-sh h2{font-size:clamp(26px,4vw,46px);line-height:1.08;margin-bottom:14px;}
.trzk-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;text-align:left;}
.trzk-sh.trzk-left p{margin-left:0;}
.trzk-eyebrow{
  display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--trzk-accent);margin-bottom:14px;
}
.trzk-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--trzk-border);border-radius:24px;padding:26px;
  backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);
}
.trzk-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.trzk-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.trzk-grid-2,.trzk-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.trzk-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.trzk-grid-3{grid-template-columns:1fr;}}

.trzk-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.trzk-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.trzk-intro-text{position:relative;padding-left:20px;}
.trzk-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--trzk-accent),var(--trzk-violet));
}
.trzk-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.trzk-intro-text p:last-child{color:var(--trzk-soft);}
.trzk-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.trzk-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;backdrop-filter:blur(12px);
}
.trzk-kpi-card .kv{font-size:clamp(18px,2.2vw,24px);font-weight:900;color:var(--trzk-heading);margin-bottom:5px;}
.trzk-kpi-card .kl{font-size:11px;font-weight:600;color:var(--trzk-muted);line-height:1.4;}
@media(max-width:900px){.trzk-intro-grid{grid-template-columns:1fr;gap:36px;}}

.trzk-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.trzk-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.trzk-toc a{
  display:inline-block;padding:9px 18px;background:var(--trzk-surface);
  border:1px solid var(--trzk-border);border-radius:999px;
  font-size:13px;font-weight:600;color:var(--trzk-muted);text-decoration:none!important;
  transition:border-color .2s,color .2s,background .2s;
}
.trzk-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--trzk-accent);background:rgba(121,242,255,.08);}

.trzk-table-wrap{overflow-x:auto;margin:24px 0;border-radius:16px;border:1px solid var(--trzk-border);}
.trzk-table{width:100%;border-collapse:collapse;font-size:14px;}
.trzk-table th{
  padding:13px 16px;text-align:left;font-size:12px;font-weight:700;
  text-transform:uppercase;letter-spacing:.06em;color:var(--trzk-accent);
  background:rgba(121,242,255,.08);border-bottom:1px solid var(--trzk-border);
}
.trzk-table td{padding:13px 16px;color:var(--trzk-text);border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;}
.trzk-table tr:last-child td{border-bottom:none;}

.trzk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.trzk-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.trzk-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--trzk-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
}
.trzk-faq-q::after{content:'▾';font-size:13px;color:var(--trzk-accent);transition:transform .25s;}
.trzk-faq-item.open .trzk-faq-q::after{transform:rotate(180deg);}
.trzk-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;}
.trzk-faq-item.open .trzk-faq-a{max-height:600px;padding:0 24px 20px;}

.trzk-demo-box{
  background:rgba(121,242,255,.06);border:1px solid rgba(121,242,255,.2);
  border-radius:16px;padding:24px;margin:20px 0;
}
.trzk-demo-box p{margin-bottom:.6em;}

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
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--trzk-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-btn{
  display:inline-flex;align-items:center;justify-content:center;
  padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;
  text-decoration:none!important;transition:transform .2s,box-shadow .2s;
}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent{background:linear-gradient(135deg,var(--trzk-btn-from),var(--trzk-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--trzk-text)!important;border:1.5px solid rgba(255,255,255,.18);}
</style>
<main id="primary" class="site-main nero-ai-home-page trzk-page ai-transkribatsiya-zvonkov-s-rezyume-v-crm-page" role="main" tabindex="-1">
<section class="nero-ai-hero trzk-hero" id="hero" aria-labelledby="hero-transkrib-title">
<style>
.trzk-hero {
  --nero-ai-bg: #060812;
  --nero-ai-bg-2: #0b1020;
  --nero-ai-surface: rgba(255, 255, 255, 0.072);
  --nero-ai-text: #e6edf7;
  --nero-ai-muted: #9aa8bd;
  --nero-ai-soft: #c7d2e5;
  --nero-ai-heading: #ffffff;
  --nero-ai-border: rgba(255, 255, 255, 0.12);
  --nero-ai-primary: #79f2ff;
  --nero-ai-primary-2: #8b5cf6;
  --nero-ai-accent: #22c55e;
  --nero-ai-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  --nero-ai-container: 1220px;
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  color: var(--nero-ai-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
.trzk-hero *, .trzk-hero *::before, .trzk-hero *::after { box-sizing: border-box; }
.trzk-hero::before {
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
.trzk-hero::after {
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
  animation: trzkGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes trzkGlow { from { opacity: .45; transform: translateX(-50%) scale(.96); } to { opacity: .86; transform: translateX(-50%) scale(1.06); } }
.trzk-hero .nero-ai-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.trzk-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.trzk-hero .nero-ai-eyebrow {
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
.trzk-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: 1.02;
  letter-spacing: -0.06em;
  color: var(--nero-ai-heading);
}
.trzk-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, var(--nero-ai-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.trzk-hero .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--nero-ai-soft) !important;
  font-size: clamp(17px, 2vw, 21px);
  line-height: 1.58;
}
.trzk-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.trzk-hero .nero-ai-badge {
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
.trzk-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.trzk-hero .nero-ai-btn {
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
.trzk-hero .nero-ai-btn:hover,
.trzk-hero .nero-ai-btn:focus-visible { transform: translateY(-2px); }
.trzk-hero .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--nero-ai-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.trzk-hero .nero-ai-btn-secondary {
  color: var(--nero-ai-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.trzk-hero .nero-ai-btn-secondary:hover { border-color: rgba(121, 242, 255, 0.36); background: rgba(121, 242, 255, 0.08); }
.trzk-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--nero-ai-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.trzk-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.trzk-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.trzk-hero .nero-ai-dots { display: flex; gap: 7px; }
.trzk-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,.22); }
.trzk-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.trzk-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.trzk-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.trzk-hero .nero-ai-window-title { color: #cfe3f9; font-size: 12px; font-weight: 750; letter-spacing: .08em; text-transform: uppercase; }
.trzk-hero .nero-ai-window-body { padding: 16px 18px 18px; }
.trzk-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.trzk-hero .nero-ai-dashboard-title h3 { margin: 0; font-size: 18px; letter-spacing: -0.03em; color: #fff; }
.trzk-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
  white-space: nowrap;
}
.trzk-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: trzkPulse 1.6s infinite;
}
@keyframes trzkPulse { 0%, 100% { transform: scale(.86); opacity: .65; } 50% { transform: scale(1); opacity: 1; } }
.trzk-hero .trzk-canvas-wrap {
  position: relative;
  width: 100%;
  height: clamp(220px, 32vw, 300px);
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.08);
  background: radial-gradient(ellipse 80% 70% at 50% 40%, rgba(121,242,255,.06), rgba(6,10,24,.9));
  margin-bottom: 14px;
}
.trzk-hero #transkrib-crm-hero-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.trzk-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
}
.trzk-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.trzk-hero .nero-ai-metric span { display: block; color: var(--nero-ai-muted); font-size: 11px; font-weight: 700; }
.trzk-hero .nero-ai-metric strong { display: block; margin-top: 5px; color: #fff; font-size: 20px; line-height: 1; }
.trzk-hero .nero-ai-metric small { display: block; margin-top: 4px; color: #9fb0c9; font-size: 11px; }
.trzk-hero .nero-ai-task-stream { margin-top: 12px; display: grid; gap: 8px; }
.trzk-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.trzk-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--nero-ai-primary);
  font-size: 12px;
  font-weight: 800;
}
.trzk-hero .nero-ai-task strong { display: block; color: #f8fafc; font-size: 12px; }
.trzk-hero .nero-ai-task span { color: var(--nero-ai-muted); font-size: 11px; }
.trzk-hero .nero-ai-status {
  padding: 4px 7px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.trzk-hero .nero-ai-status--wait { background: rgba(251,191,36,.12); color: #fde68a; }
@media (max-width: 960px) {
  .trzk-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .trzk-hero .nero-ai-dashboard { transform: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Голос · транскрибация · CRM</p>
      <h1 id="hero-transkrib-title">AI-транскрибация звонков с резюме в CRM: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Превращаем каждый звонок в резюме, задачи и следующий шаг в CRM — без ручного протокола и потерянных договорённостей</p>
      <ul class="nero-ai-badges" aria-label="Этапы пайплайна">
        <li class="nero-ai-badge">Запись звонка</li>
        <li class="nero-ai-badge">STT + спикеры</li>
        <li class="nero-ai-badge">AI-резюме</li>
        <li class="nero-ai-badge">Задачи в CRM</li>
        <li class="nero-ai-badge">Риск сделки</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="#cta-demo-report">Получить пример отчёта</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает пайплайн</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо: AI-транскрибация звонков в CRM">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">звонок → STT → CRM · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Центр обработки звонков</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>
          <div class="trzk-canvas-wrap" aria-hidden="true">
            <canvas id="transkrib-crm-hero-canvas" width="600" height="280"></canvas>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Охват QA</span><strong>100%</strong><small>звонков</small></div>
            <div class="nero-ai-metric"><span>Резюме</span><strong>2:40</strong><small>после звонка</small></div>
            <div class="nero-ai-metric"><span>CRM</span><strong>auto</strong><small>поля + задачи</small></div>
            <div class="nero-ai-metric"><span>Протокол</span><strong>−85%</strong><small>ручного ввода</small></div>
          </div>
          <div class="nero-ai-task-stream" aria-label="Лента обработки звонка">
            <div class="nero-ai-task"><span class="nero-ai-task-icon">📞</span><div><strong>Звонок завершён</strong><span>Mango · deal #1842</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">STT</span><div><strong>Транскрипт + спикеры</strong><span>SpeechKit async</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Резюме и риск сделки</strong><span>5 пунктов + next step</span></div><span class="nero-ai-status nero-ai-status--wait">в CRM</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="trzk-content">

  <section class="trzk-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="trzk-cnt">
      <div class="trzk-intro-grid nero-ai-reveal">
        <div class="trzk-intro-text">
          <p class="trzk-eyebrow">Лонгрид · голос · CRM</p>
          <p><strong>Коротко:</strong> Nero Network внедряет агентный пайплайн «запись → транскрипт → резюме, задачи, риск сделки → автозапись в CRM» для amoCRM, Битрикс24, HubSpot и других систем. Не виджет за минуты, а кастомная логика под ваш процесс продаж — с учётом 152-ФЗ и демо-отчётом до старта.</p>
          <p>Менеджер положил трубку — а в CRM пусто. Договорённости остались в голове, следующий шаг не зафиксирован, РОП видит лишь 2–5% звонков при ручном контроле качества. <strong>AI-транскрибация звонков с резюме в CRM</strong> закрывает этот разрыв: каждый разговор превращается в структурированный <strong>ai протокол разговора</strong>, <strong>ai итоги звонка</strong>, задачи и сигнал риска сделки — без ручного переписывания.</p>
        </div>
        <div class="trzk-intro-kpi" aria-label="Метрики пайплайна">
          <div class="trzk-kpi-card"><div class="kv">100%</div><div class="kl">охват звонков для QA</div></div>
          <div class="trzk-kpi-card"><div class="kv">2–3 мин</div><div class="kl">до резюме в CRM</div></div>
          <div class="trzk-kpi-card"><div class="kv">−85%</div><div class="kl">ручного протокола</div></div>
          <div class="trzk-kpi-card"><div class="kv">152-ФЗ</div><div class="kl">контур хранения в РФ</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="trzk-toc-outer">
    <div class="trzk-cnt">
      <nav class="trzk-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-teryayutsya-itogi">Почему теряются итоги</a>
        <a href="#chto-daet-ai-transkribatsiya">Выгоды</a>
        <a href="#kak-rabotaet">Пайплайн</a>
        <a href="#integraciya-crm">CRM</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#vnedrenie-pod-klyuch">Внедрение</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#primer-otcheta">Пример отчёта</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="trzk-section trzk-section-alt" id="smzhnye-materialy-intro" aria-label="Смежные материалы">
    <div class="trzk-cnt">
      <div class="trzk-card nero-ai-reveal">
        <p>Транскрибация — один из слоёв AI в воронке: если вам нужна более широкая <a href="/vnedrenie-ai-amocrm/">внедрение AI-агента в amoCRM</a> (сделки, задачи, follow-up без ручного ввода), смотрите отдельный разбор автоматизации CRM. На этой странице фокус — голос, резюме звонка и запись результата в карточку сделки.</p>
      </div>
    </div>
  </section>

  <section class="trzk-section" id="pochemu-teryayutsya-itogi">
    <div class="trzk-cnt">
      <div class="trzk-sh trzk-left nero-ai-reveal">
        <span class="trzk-eyebrow">Боль бизнеса</span>
        <h2>Почему после звонка теряются итоги, задачи и следующий шаг</h2>
        <p><strong>Определение проблемы:</strong> после телефонного разговора менеджеры редко заполняют CRM вовремя и полно. Договорённости теряются, прогноз продаж строится на неполных данных, а руководитель отдела продаж контролирует лишь 2–5% звонков вручную.</p>
      </div>
      <div class="trzk-grid-2 nero-ai-reveal">
        <div class="trzk-card">
          <h3>Сколько времени уходит на ручной протокол</h3>
          <p>Менеджер после звонка тратит время на переслушивание записи, выписывание договорённостей, создание задач и обновление полей сделки. В кейсе логистической компании с 15 менеджерами и до 500 звонков в день время на CRM сократилось с 1,5 часа в день до 15 минут после внедрения автоматической расшифровки (AutoBIT24, 2026).</p>
          <p>Ручной <strong>ai протокол разговора</strong> в голове менеджера не масштабируется: при 30–50 звонках в день качество фиксации падает к концу смены.</p>
        </div>
        <div class="trzk-card">
          <h3>Что ломается в воронке без фиксации договорённостей</h3>
          <p>Без <strong>ai итогов звонка</strong> в CRM ломается цепочка: follow-up уходит «когда-нибудь», этап сделки не обновляется, риск потери клиента не виден до закрытия в минус.</p>
          <p>Речевая аналитика: при ручном QA охватывается 2–5% звонков, автоматизация даёт 100% охват (Rechka). Revenue Intelligence анализирует процесс продажи — что менеджер говорит на звонках (vc.ru/SalesAI 2026).</p>
        </div>
      </div>
    </div>
  </section>

  <section class="trzk-section trzk-section-alt" id="chto-daet-ai-transkribatsiya">
    <div class="trzk-cnt">
      <div class="trzk-sh nero-ai-reveal">
        <span class="trzk-eyebrow">Выгоды</span>
        <h2>Что даёт AI-транскрибация звонков бизнесу</h2>
        <p><strong>Коротко:</strong> <strong>AI-транскрибация звонков для бизнеса</strong> — это не просто <strong>ai расшифровка звонков</strong>. Это автоматическое извлечение резюме, задач, следующего шага и оценки риска сделки с записью результата в CRM.</p>
      </div>
      <div class="trzk-grid-3 nero-ai-reveal">
        <div class="trzk-card">
          <h3>Резюме звонка вместо длинного транскрипта</h3>
          <p>Сырой транскрипт на 20 минут мало кто читает. <strong>AI резюме звонка</strong> — структурированный блок: договорённости, возражения, сроки, суммы, конкуренты. Nero Network идёт дальше встроенного CoPilot: кастомные промпты, amoCRM, внешняя телефония, поле «риск сделки».</p>
        </div>
        <div class="trzk-card">
          <h3>Задачи, следующий шаг и риск сделки</h3>
          <p>Агентный слой вызывает CRM tools: <code>update_deal_fields</code>, <code>create_task</code>, <code>add_note</code>, <code>set_risk_flag</code>. Спорные поля получают статус «требует подтверждения» — human-in-the-loop.</p>
        </div>
        <div class="trzk-card">
          <h3>Контроль качества продаж и поддержки</h3>
          <p>Виджеты дают транскрипт и саммари за 2–3 минуты. Nero Network объединяет QA с кастомной логикой: еженедельный отчёт РОПу, топ-ошибки, % заполнения CRM, потерянные next steps.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="boris-transkrib-pipeline-viz" class="btp-root" aria-label="Анимация пайплайна: звонок, транскрипт, резюме и запись в CRM">
<style>
/* === БОРИС: prefix btp-, scoped внутри #boris-transkrib-pipeline-viz === */
#boris-transkrib-pipeline-viz.btp-root{
  padding:56px 0 64px;
  background:linear-gradient(180deg,#f8fafc 0%,#ffffff 100%);
}
#boris-transkrib-pipeline-viz .btp-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 20px;
}
#boris-transkrib-pipeline-viz .btp-card{
  display:grid;
  grid-template-columns:42% 58%;
  border-radius:22px;
  overflow:hidden;
  background:#ffffff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1024px){
  #boris-transkrib-pipeline-viz .btp-card{grid-template-columns:1fr;min-height:auto;}
}
#boris-transkrib-pipeline-viz .btp-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1024px){
  #boris-transkrib-pipeline-viz .btp-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#boris-transkrib-pipeline-viz .btp-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.1em;
  text-transform:uppercase;
  color:#0d9488;
  margin:0 0 14px;
}
#boris-transkrib-pipeline-viz .btp-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0d9488;
  border-radius:1px;
}
#boris-transkrib-pipeline-viz .btp-h3{
  font-size:24px;
  font-weight:800;
  color:#0f172a;
  line-height:1.32;
  margin:0 0 18px;
}
@media(max-width:600px){
  #boris-transkrib-pipeline-viz .btp-h3{font-size:20px;}
}
#boris-transkrib-pipeline-viz .btp-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#boris-transkrib-pipeline-viz .btp-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#boris-transkrib-pipeline-viz .btp-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(13,148,136,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0d9488;
  font-style:normal;
  margin-top:1px;
}
#boris-transkrib-pipeline-viz .btp-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#boris-transkrib-pipeline-viz .btp-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#boris-transkrib-pipeline-viz .btp-pl-a{background:rgba(13,148,136,.08);color:#0f766e;border:1.5px solid rgba(13,148,136,.22);}
#boris-transkrib-pipeline-viz .btp-pl-b{background:rgba(59,130,246,.08);color:#1d4ed8;border:1.5px solid rgba(59,130,246,.22);}
#boris-transkrib-pipeline-viz .btp-pl-c{background:rgba(234,88,12,.08);color:#c2410c;border:1.5px solid rgba(234,88,12,.22);}
#boris-transkrib-pipeline-viz .btp-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#boris-transkrib-pipeline-viz .btp-rgt{
  position:relative;
  background:linear-gradient(145deg,#f1f5f9 0%,#e8f4f8 50%,#f0fdf4 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1024px){
  #boris-transkrib-pipeline-viz .btp-rgt{min-height:360px;}
}
#boris-transkrib-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="btp-cnt">
  <div class="btp-card">
    <div class="btp-lft">
      <span class="btp-ey">Пайплайн после звонка</span>
      <h3 class="btp-h3">От записи разговора до полей в CRM — без ручного протокола</h3>
      <ul class="btp-ul">
        <li><span class="btp-ic">1</span>Телефония отдаёт аудио и metadata сразу после завершения звонка</li>
        <li><span class="btp-ic">2</span>STT с диаризацией превращает речь в текст с ролями спикеров</li>
        <li><span class="btp-ic">3</span>AI-агент извлекает резюме, задачи, next step и риск сделки</li>
        <li><span class="btp-ic">4</span>CRM tools записывают итог в карточку — менеджер только подтверждает спорное</li>
      </ul>
      <div class="btp-pills">
        <span class="btp-pl btp-pl-a">⏱ 2–3 мин до CRM</span>
        <span class="btp-pl btp-pl-b">100% охват звонков</span>
        <span class="btp-pl btp-pl-c">human-in-the-loop</span>
      </div>
      <p class="btp-foot">Дальше разберём каждый этап пайплайна и стек технологий →</p>
    </div>
    <div class="btp-rgt">
      <canvas
        id="boris-transkrib-pipeline-canvas"
        aria-label="Анимация: звонок превращается в транскрипт, резюме и автозапись в CRM"
        role="img"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  var cv = document.getElementById('boris-transkrib-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;
  var LOOP = 600;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    outline: '#0f172a',
    line: '#94a3b8',
    pipe: '#cbd5e1',
    pipeAct: '#0d9488',
    phone: '#3b82f6',
    stt: '#8b5cf6',
    sum: '#f59e0b',
    crm: '#10b981',
    card: '#ffffff',
    text: '#334155',
    muted: '#64748b',
    dot: '#0d9488',
    wave: '#60a5fa'
  };

  var STAGES = [
    {id:'call', label:'Звонок', sub:'запись + metadata', color:C.phone, icon:'\u260E'},
    {id:'stt', label:'Транскрипт', sub:'STT + спикеры', color:C.stt, icon:'\u2261'},
    {id:'sum', label:'Резюме', sub:'задачи, риск', color:C.sum, icon:'\u2605'},
    {id:'crm', label:'CRM', sub:'поля и задачи', color:C.crm, icon:'\u25A3'}
  ];

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

  function getLayout(){
    var padX = Math.max(16, W * 0.04);
    var topY = H * 0.18;
    var botY = H * 0.82;
    var usable = W - padX * 2;
    var gap = usable / (STAGES.length - 1);
    var nodes = STAGES.map(function(s,i){
      return {x: padX + gap * i, y: (topY + botY) / 2, r: Math.min(36, W * 0.055), stage: s};
    });
    return {padX:padX, topY:topY, botY:botY, nodes:nodes, gap:gap};
  }

  function drawPipe(L){
    var y = (L.topY + L.botY) / 2;
    ctx.lineCap = 'round';
    ctx.strokeStyle = C.pipe;
    ctx.lineWidth = 6;
    ctx.beginPath();
    ctx.moveTo(L.nodes[0].x, y);
    ctx.lineTo(L.nodes[L.nodes.length-1].x, y);
    ctx.stroke();

    var prog = (frame % LOOP) / LOOP;
  var activeLen = L.nodes[L.nodes.length-1].x - L.nodes[0].x;
    ctx.strokeStyle = C.pipeAct;
    ctx.lineWidth = 4;
    ctx.globalAlpha = 0.35 + 0.25 * Math.sin(frame * 0.04);
    ctx.beginPath();
    ctx.moveTo(L.nodes[0].x, y);
    ctx.lineTo(L.nodes[0].x + activeLen * prog, y);
    ctx.stroke();
    ctx.globalAlpha = 1;

    for(var i=0;i<3;i++){
      var t = ((frame * 1.2 + i * 180) % LOOP) / LOOP;
      var px = L.nodes[0].x + activeLen * t;
      var pulse = 4 + Math.sin(frame * 0.08 + i) * 2;
      ctx.beginPath();
      ctx.arc(px, y, pulse, 0, Math.PI * 2);
      ctx.fillStyle = C.dot;
      ctx.globalAlpha = 0.5 + 0.5 * Math.sin(frame * 0.06 + i * 2);
      ctx.fill();
      ctx.globalAlpha = 1;
    }
  }

  function drawNode(n, idx, L){
    var s = n.stage;
    var glow = 0.15 + 0.1 * Math.sin(frame * 0.05 + idx * 1.2);
    ctx.beginPath();
    ctx.arc(n.x, n.y, n.r + 10, 0, Math.PI * 2);
    ctx.fillStyle = s.color.replace(')',',' + glow + ')').replace('rgb','rgba').replace('#', '');
    /* fallback glow */
    ctx.fillStyle = 'rgba(13,148,136,' + glow + ')';
    ctx.fill();

    rr(n.x - n.r, n.y - n.r, n.r * 2, n.r * 2, n.r, C.card, s.color, 2.5);

    ctx.fillStyle = s.color;
    ctx.font = 'bold ' + Math.round(n.r * 0.7) + 'px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(s.icon, n.x, n.y - 2);

    ctx.fillStyle = C.outline;
    ctx.font = 'bold ' + Math.max(11, Math.round(W * 0.028)) + 'px Inter,system-ui,sans-serif';
    ctx.fillText(s.label, n.x, n.y + n.r + 18);

    ctx.fillStyle = C.muted;
    ctx.font = Math.max(9, Math.round(W * 0.022)) + 'px Inter,system-ui,sans-serif';
    ctx.fillText(s.sub, n.x, n.y + n.r + 34);
  }

  function drawCallPreview(n){
    var bx = n.x - 52, by = L_cache.topY - 8;
    if(bx < 8) bx = 8;
    rr(bx, by, 104, 56, 8, C.card, C.line, 1);
    ctx.strokeStyle = C.wave;
    ctx.lineWidth = 2;
    ctx.beginPath();
    for(var i=0;i<40;i++){
      var wx = bx + 8 + i * 2.2;
      var wy = by + 28 + Math.sin(frame * 0.12 + i * 0.35) * (6 + Math.sin(frame*0.03)*3);
      if(i===0) ctx.moveTo(wx,wy); else ctx.lineTo(wx,wy);
    }
    ctx.stroke();
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('00:04:12', bx + 8, by + 48);
  }

  function drawTranscriptPreview(n){
    var bx = n.x - 58, by = L_cache.topY - 4;
    rr(bx, by, 116, 62, 8, C.card, C.line, 1);
    var lines = ['М: срок до конца квартала', 'К: бюджет согласован', 'М: отправлю КП завтра'];
    ctx.textAlign = 'left';
    for(var j=0;j<3;j++){
      var vis = Math.min(1, Math.max(0, ((frame % LOOP) / LOOP * 4) - j * 0.35));
      ctx.fillStyle = 'rgba(51,65,85,' + (0.25 + vis * 0.75) + ')';
      ctx.font = '8.5px Inter,system-ui,sans-serif';
      var txt = lines[j].substring(0, Math.floor(lines[j].length * vis));
      ctx.fillText(txt, bx + 8, by + 16 + j * 16);
    }
  }

  function drawSummaryPreview(n){
    var bx = n.x - 54, by = L_cache.botY - 58;
    rr(bx, by, 108, 58, 8, C.card, C.line, 1);
    var items = ['\u2022 Next step: КП', '\u2022 Риск: средний', '\u2713 Задача в CRM'];
    ctx.textAlign = 'left';
    for(var k=0;k<3;k++){
      var a = Math.min(1, Math.max(0, ((frame % LOOP) / LOOP * 4) - 1.2 - k * 0.3));
      ctx.fillStyle = k===2 ? 'rgba(16,185,129,' + a + ')' : 'rgba(51,65,85,' + (0.3 + a * 0.7) + ')';
      ctx.font = (k===2 ? 'bold ' : '') + '8.5px Inter,system-ui,sans-serif';
      ctx.fillText(items[k], bx + 8, by + 16 + k * 15);
    }
  }

  function drawCrmPreview(n){
    var bx = n.x - 50, by = L_cache.botY - 62;
    rr(bx, by, 100, 64, 8, C.card, C.crm, 1.5);
    ctx.fillStyle = C.crm;
    ctx.font = 'bold 9px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('amoCRM \u2014 сделка', bx + 8, by + 14);
    var fields = [['Бюджет','280 тыс.'],['Этап','КП'],['Задача','\u2713']];
    for(var f=0;f<3;f++){
      var fa = Math.min(1, Math.max(0, ((frame % LOOP) / LOOP * 4) - 2 - f * 0.25));
      ctx.fillStyle = 'rgba(100,116,139,' + (0.4 + fa * 0.6) + ')';
      ctx.font = '8px Inter,system-ui,sans-serif';
      ctx.fillText(fields[f][0] + ':', bx + 8, by + 28 + f * 14);
      ctx.fillStyle = 'rgba(15,23,42,' + fa + ')';
      ctx.font = 'bold 8px Inter,system-ui,sans-serif';
      ctx.fillText(fields[f][1], bx + 52, by + 28 + f * 14);
    }
  }

  var L_cache = {topY:0, botY:0};

  function draw(){
    ctx.clearRect(0,0,W,H);
    var L = getLayout();
    L_cache = L;

    ctx.fillStyle = C.muted;
    ctx.font = 'bold ' + Math.max(10, Math.round(W*0.024)) + 'px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('запись \u2192 транскрипт \u2192 резюме \u2192 CRM', W/2, 28);

    drawPipe(L);
    for(var i=0;i<L.nodes.length;i++){
      drawNode(L.nodes[i], i, L);
    }
    if(W > 280){
      drawCallPreview(L.nodes[0]);
      drawTranscriptPreview(L.nodes[1]);
      drawSummaryPreview(L.nodes[2]);
      drawCrmPreview(L.nodes[3]);
    }
    frame++;
    requestAnimationFrame(draw);
  }
  draw();
})();
</script>
</section>

  <section class="trzk-section" id="kak-rabotaet">
    <div class="trzk-cnt">
      <div class="trzk-sh trzk-left nero-ai-reveal">
        <span class="trzk-eyebrow">Механика</span>
        <h2>Как работает пайплайн: запись → транскрипт → резюме → CRM</h2>
        <p><strong>Определение:</strong> <strong>AI-транскрибация звонков</strong> в модели Nero Network — автоматический конвейер из 7 шагов, где каждый этап имеет чёткий вход и выход.</p>
      </div>
      <div class="trzk-card nero-ai-reveal">
        <h3>Схема пайплайна (7 шагов)</h3>
        <ol>
          <li>Звонок завершён → телефония отправляет URL записи и metadata (номер, менеджер, deal_id).</li>
          <li>Оркестратор (n8n / Make / агент) ставит задачу STT.</li>
          <li>STT-сервис возвращает транскрипт с таймкодами и ролями спикеров.</li>
          <li>LLM-цепочка: summary → extraction JSON (резюме, задачи, риск, теги).</li>
          <li>AI-агент вызывает CRM tools: обновление полей, примечание, задача, смена этапа.</li>
          <li>Уведомление менеджеру: «итоги готовы, проверьте 2 поля».</li>
          <li>Аналитика: еженедельный отчёт РОПу по скрипту и потерянным next steps.</li>
        </ol>
      </div>
      <div class="trzk-grid-3 nero-ai-reveal nero-ai-delay-1" style="margin-top:24px;">
        <div class="trzk-card"><h3>Распознавание речи</h3><p>Yandex SpeechKit: асинхронное распознавание, диаризация, мультиканал. SpeechKit async API v3 для отраслевых словарей, on-prem ASR при жёстких требованиях к контуру.</p></div>
        <div class="trzk-card"><h3>AI-агент и отчёт</h3><p>Транскрипт → промпт-цепочка → JSON. Агент извлекает сущности, оценивает риск, генерирует follow-up. <strong>Автоматизация через ai транскрибация звонков</strong> как операционная система после звонка.</p></div>
        <div class="trzk-card"><h3>Триггеры после звонка</h3><p>Триггер — завершение звонка в телефонии (Mango, Sipuni, Телфин, UIS) или событие в CRM. Спорные поля не перезаписывают CRM молча — менеджер подтверждает.</p></div>
      </div>
    </div>
  </section>

  <section class="trzk-section trzk-section-alt" id="integraciya-crm">
    <div class="trzk-cnt">
      <div class="trzk-sh nero-ai-reveal">
        <span class="trzk-eyebrow">Интеграции</span>
        <h2>Интеграция AI-транскрибации звонков с CRM</h2>
        <p><strong>Интеграция ai транскрибация звонков</strong> — запись <strong>ai резюме звонка</strong>, транскрипта, задач и риска в карточку сделки через API.</p>
      </div>
      <div class="trzk-grid-3 nero-ai-reveal">
        <div class="trzk-card"><h3>amoCRM</h3><p>Экосистема виджетов: транскрипт + саммари за 2–3 минуты. Nero Network строит <strong>ai запись звонка crm</strong> глубже виджета: кастомная схема полей, риск сделки, 152-ФЗ. Чек 100–300 тыс. ₽.</p></div>
        <div class="trzk-card"><h3>Битрикс24</h3><p>BitrixGPT расшифровывает звонки и автозаполняет поля. Nero Network дополняет нативные интеграции: отраслевые поля, amoCRM в гибридных стеках, агентный слой Make/n8n.</p></div>
        <div class="trzk-card"><h3>HubSpot и API / Make</h3><p>HubSpot по REST API. Шаблоны Make и n8n: webhook → STT → LLM → обновление CRM — адаптируем под вашу телефонию и политику данных.</p></div>
      </div>
      <div class="trzk-table-wrap nero-ai-reveal nero-ai-delay-1">
        <table class="trzk-table">
          <thead><tr><th>Подход</th><th>Плюсы</th><th>Ограничения</th></tr></thead>
          <tbody>
            <tr><td>SaaS-виджет</td><td>Старт за минуты, от ~0,5–8,5 ₽/мин</td><td>Мало кастомной логики, слабый 152-ФЗ</td></tr>
            <tr><td>Встроенный AI CRM</td><td>Нативно в Битрикс24</td><td>Ограничен amoCRM, внешней телефонией</td></tr>
            <tr><td>Nero Network под ключ</td><td>Кастом, агент + tools, 152-ФЗ</td><td>100–300 тыс. ₽, 1–4 недели</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="trzk-section" id="dlya-kogo">
    <div class="trzk-cnt">
      <div class="trzk-sh nero-ai-reveal">
        <span class="trzk-eyebrow">Сегменты</span>
        <h2>Для кого подходит внедрение: продажи, поддержка, медицина, юристы, консалтинг</h2>
      </div>
      <div class="trzk-grid-3 nero-ai-reveal">
        <div class="trzk-card"><h3>Отдел продаж и колл-центр</h3><p>BANT, MEDDIC, скрипт квалификации. Кейс логистики: конверсия 22% → 31%, окупаемость 2,5 месяца (AutoBIT24).</p></div>
        <div class="trzk-card"><h3>Клиентская поддержка</h3><p>100% охват вместо 2–5%. AI формирует резюме инцидента, теги, задачу на вторую линию — без переслушивания 15-минутного звонка.</p></div>
        <div class="trzk-card"><h3>Регулируемые отрасли</h3><p>Медицина, юристы, консалтинг — 152-ФЗ, локализация в РФ, согласие на запись (126-ФЗ), DPA с подрядчиками.</p></div>
      </div>
    </div>
  </section>

  <section class="trzk-section trzk-section-alt" id="vnedrenie-pod-klyuch">
    <div class="trzk-cnt">
      <div class="trzk-sh trzk-left nero-ai-reveal">
        <span class="trzk-eyebrow">Под ключ</span>
        <h2>Внедрение AI-транскрибации звонков под ключ: этапы и сроки</h2>
        <p><strong>Внедрение ai транскрибация звонков</strong> — проект с фиксированным чеком. <strong>Настройка</strong> и <strong>разработка</strong> под вашу воронку — 1–4 недели.</p>
      </div>
      <div class="trzk-grid-3 nero-ai-reveal">
        <div class="trzk-card"><h3>Аудит звонков и CRM</h3><p>Телефония, CRM, объём минут, 152-ФЗ. Схема полей, скрипт, 20–50 образцов звонков для калибровки.</p></div>
        <div class="trzk-card"><h3>Пилот на одном отделе</h3><p>Webhook → STT → LLM-агент → CRM-коннектор. Human-in-the-loop: подтверждение спорных полей, аудит-лог.</p></div>
        <div class="trzk-card"><h3>Масштабирование</h3><p>Раскатка на всех менеджеров, дашборд РОПа, обучение команды работе с AI-отчётом.</p></div>
      </div>
      <div class="ym-cta-block ym-cta-block--dual" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда готова к AI-транскрибации?</p>
    <p class="ym-cta-block__sub">После пилота важно обучить менеджеров и РОПа работе с AI-отчётами. Посмотрите материалы по внедрению и автоматизации — чтобы масштабирование прошло без сопротивления.</p>
    <a href="<?php echo esc_url($secondary_cta_url); ?>" class="nero-ai-btn ym-btn ym-btn--ghost ym-cta-block__btn" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>
  </div>
</div>
      <p class="nero-ai-reveal" style="margin-top:20px;"><strong>Основные модули:</strong> приём записей, STT, LLM-анализатор, CRM-коннектор, агентный слой (OpenAI Agents SDK / Make / n8n), панель QA.</p>
    </div>
  </section>

  <section class="trzk-section" id="keisy">
    <div class="trzk-cnt">
      <div class="trzk-sh nero-ai-reveal">
        <span class="trzk-eyebrow">Доверие</span>
        <h2>Кейсы и примеры внедрения AI-транскрибации звонков</h2>
        <p><strong>AI-транскрибация звонков кейсы</strong> — цифры из публичных источников, не обещание Nero Network.</p>
      </div>
      <div class="trzk-table-wrap nero-ai-reveal">
        <table class="trzk-table">
          <thead><tr><th>Показатель</th><th>До</th><th>После</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>Время на CRM</td><td>1,5 ч/день</td><td>15 мин/день</td><td>AutoBIT24</td></tr>
            <tr><td>Охват QA</td><td>2–5%</td><td>100%</td><td>Rechka</td></tr>
            <tr><td>Заполнение полей</td><td>Ручное</td><td>17 полей из звонка</td><td>SalesAI + amoCRM</td></tr>
          </tbody>
        </table>
      </div>
      <div class="trzk-card nero-ai-reveal nero-ai-delay-1" style="margin-top:24px;">
        <h3>KPI: конверсия, follow-up, скрипт</h3>
        <p>Конверсия +36–68% — кейсы SalesAI/ADPASS. Конверсия 22% → 31% — логистика (AutoBIT24). Окупаемость 1–3 месяца для колл-центров от 5 операторов (Rechka). KPI зависит от отрасли и дисциплины follow-up.</p>
      </div>
    </div>
  </section>

  <section class="trzk-section trzk-section-alt" id="ceny">
    <div class="trzk-cnt">
      <div class="trzk-sh nero-ai-reveal">
        <span class="trzk-eyebrow">Коммерция</span>
        <h2>Стоимость и формат работы</h2>
        <p><strong>AI-транскрибация звонков цена</strong> — проект <strong>ai транскрибация звонков под ключ</strong>, не только поминутная подписка.</p>
      </div>
      <div class="trzk-grid-2 nero-ai-reveal">
        <div class="trzk-card">
          <h3>Ориентир чека 100–300 тыс. ₽</h3>
          <p>Аудит, телефония, STT, LLM-промпты, CRM-поля, 152-ФЗ, демо-отчёт, пилот и масштабирование. ROI по рынку — 1–3 месяца для колл-центров.</p>
        </div>
        <div class="trzk-card">
          <h3>Что входит в проект</h3>
          <ul>
            <li>Аудит звонков, CRM, телефонии и 152-ФЗ</li>
            <li>STT (SpeechKit / on-prem ASR)</li>
            <li>LLM-агент: резюме, задачи, риск, скрипт</li>
            <li>Интеграция amoCRM / Битрикс24 / HubSpot</li>
            <li>Human-in-the-loop и дашборд РОПа</li>
            <li>Демо-отчёт и обучение команды</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="trzk-section" id="primer-otcheta">
    <div class="trzk-cnt">
      <div class="trzk-sh nero-ai-reveal">
        <span class="trzk-eyebrow">Лид-магнит</span>
        <h2>Пример AI-отчёта по звонку</h2>
        <p>Конкретный формат <strong>ai резюме звонка</strong> и <strong>ai протокол разговора</strong> под вашу воронку — до подписания договора.</p>
      </div>
      <div class="trzk-demo-box nero-ai-reveal">
        <p><strong>Резюме (5 пунктов):</strong></p>
        <ol>
          <li>Клиент интересуется AI-транскрибацией для отдела из 12 менеджеров.</li>
          <li>CRM — amoCRM, телефония Mango Office, ~200 звонков/день.</li>
          <li>Боль: менеджеры не фиксируют возражения по цене, РОП слушает 3% звонков.</li>
          <li>Срок решения — до конца квартала, бюджет согласован.</li>
          <li>Конкурент: виджет с поминутной оплатой без кастомных полей.</li>
        </ol>
        <p><strong>Следующий шаг:</strong> КП с пилотом на 2 недели; созвон с РОП в четверг 15:00.</p>
        <p><strong>Задача в CRM:</strong> «Подготовить КП + пример отчёта» — дедлайн завтра 12:00.</p>
        <p><strong>Риск сделки:</strong> средний. <strong>Цитата (08:42):</strong> «Нам нужен не просто транскрипт, а чтобы задачи сами падали в amo».</p>
      </div>
      <div class="nero-ai-reveal nero-ai-delay-1">
        <h3>CTA: «Получить пример отчёта»</h3>
        <p>Запросите <strong>пример AI-отчёта по звонку</strong> — Nero Network подготовит демо под вашу отрасль.</p>
      </div>
      <div class="ym-cta-block ym-cta-block--primary" id="cta-demo-report">
  <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Увидьте AI-отчёт по звонку до старта пилота</p>
    <p class="ym-cta-block__sub">Подготовим демо под вашу отрасль: резюме, задачи, риск сделки и цитаты с таймкодами — в формате вашей CRM (amoCRM, Битрикс24, HubSpot).</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn" target="_blank" rel="noopener noreferrer"><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>
    </div>
  </section>

  <section class="trzk-section trzk-section-alt" id="faq">
    <div class="trzk-cnt">
      <div class="trzk-sh nero-ai-reveal">
        <span class="trzk-eyebrow">FAQ</span>
        <h2>Как внедрить AI-транскрибацию звонков в CRM</h2>
      </div>
      <div class="trzk-faq nero-ai-reveal">
        <div class="trzk-faq-item">
          <div class="trzk-faq-q" tabindex="0" role="button" aria-expanded="false">Нужна ли отдельная телефония</div>
          <div class="trzk-faq-a"><p>Не обязательна, если есть Mango, Sipuni, Телфин, UIS, OnlinePBX, Beeline или запись через CRM. Подключение через webhook, SIPREC или CRM-триггер.</p></div>
        </div>
        <div class="trzk-faq-item">
          <div class="trzk-faq-q" tabindex="0" role="button" aria-expanded="false">152-ФЗ и хранение записей</div>
          <div class="trzk-faq-a"><p>Записи — персональные данные; голос — уникальный идентификатор. Локализация в РФ с 01.09.2025. Nero Network: согласие, хранение в РФ, гибридный STT/LLM без неправомерной трансграничной передачи.</p></div>
        </div>
        <div class="trzk-faq-item">
          <div class="trzk-faq-q" tabindex="0" role="button" aria-expanded="false">Точность распознавания и доработка промптов</div>
          <div class="trzk-faq-a"><p>STT растёт с отраслевым словарём. Промпты калибруются на 20–50 звонках на пилоте. Спорные поля не перезаписывают CRM автоматически — human-in-the-loop.</p></div>
        </div>
        <div class="trzk-faq-item">
          <div class="trzk-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько занимает запуск</div>
          <div class="trzk-faq-a"><p>Типично <strong>1–4 недели</strong>: аудит (3–5 дней), пилот (1–2 недели), масштабирование (3–7 дней). <strong>Как внедрить ai транскрибация звонков:</strong> заявка → аудит → демо → пилот → масштабирование.</p></div>
        </div>
      </div>
    </div>
  </section>

  <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы внедрить AI-транскрибацию звонков в CRM?</p>
    <p class="ym-cta-block__sub">Аудит телефонии и CRM → демо-отчёт → пилот на одном отделе → масштабирование. Проект под ключ с учётом 152-ФЗ, ориентир 100–300 тыс. ₽.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>

  <section class="trzk-section" id="itog">
    <div class="trzk-cnt">
      <div class="trzk-card nero-ai-reveal">
        <p><strong>Итог:</strong> <strong>AI-транскрибация звонков с резюме в CRM</strong> в 2026 году — агентный пайплайн с tools, а не кнопка «расшифровать». Nero Network внедряет цепочку под ваш процесс: телефония → SpeechKit/ASR → AI-агент → резюме + задачи + риск в amoCRM/Битрикс24 — с 152-ФЗ, демо-отчётом и чеком 100–300 тыс. ₽. <strong>Получите пример AI-отчёта по звонку</strong> до старта пилота.</p>
      </div>
    </div>
  </section>

  <section class="trzk-section" id="chitayte-takzhe" aria-label="Читайте также">
    <div class="trzk-cnt">
      <div class="trzk-sh trzk-left nero-ai-reveal">
        <span class="trzk-eyebrow">Экспертиза Nero Network</span>
        <h2>Читайте также по теме AI-внедрения</h2>
      </div>
      <div class="trzk-card nero-ai-reveal">
        <h3>Масштаб корпоративного AI</h3>
        <p>После пилота на одном отделе полезно смотреть на <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">корпоративное внедрение AI в бизнес-процессы</a> — уроки масштабирования агентных сценариев в крупных компаниях и перенос voice-to-CRM пайплайна на другие отделы.</p>
      </div>
    </div>
  </section>

<?php
$nero_schema_site = trailingslashit( home_url() );
$nero_schema_page = trailingslashit( get_permalink() );
$nero_schema_brand = get_bloginfo( 'name' ) ?: 'Nero Network';
$nero_schema_graph = [
  [
    '@type' => 'Organization',
    '@id' => $nero_schema_site . '#organization',
    'name' => $nero_schema_brand,
    'url' => $nero_schema_site,
  ],
  [
    '@type' => 'WebSite',
    '@id' => $nero_schema_site . '#website',
    'url' => $nero_schema_site,
    'name' => $nero_schema_brand,
    'publisher' => [ '@id' => $nero_schema_site . '#organization' ],
  ],
  [
    '@type' => 'WebPage',
    '@id' => $nero_schema_page . '#webpage',
    'url' => $nero_schema_page,
    'name' => 'AI-транскрибация звонков с резюме в CRM: внедрение под ключ',
    'description' => 'AI-транскрибация звонков с резюме в CRM под ключ: расшифровка, протокол, задачи в amoCRM и Битрикс24. Получите пример AI-отчёта по звонку.',
    'isPartOf' => [ '@id' => $nero_schema_site . '#website' ],
    'about' => [ '@id' => $nero_schema_site . '#organization' ],
  ],
  [
    '@type' => 'BreadcrumbList',
    '@id' => $nero_schema_page . '#breadcrumb',
    'itemListElement' => [
      [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $nero_schema_site ],
      [ '@type' => 'ListItem', 'position' => 2, 'name' => 'AI-транскрибация звонков с резюме в CRM: внедрение под ключ', 'item' => $nero_schema_page ],
    ],
  ],
  [
    '@type' => 'Service',
    '@id' => $nero_schema_page . '#service',
    'name' => 'AI-транскрибация звонков с резюме в CRM: внедрение под ключ',
    'description' => 'AI-транскрибация звонков с резюме в CRM под ключ: расшифровка, протокол, задачи в amoCRM и Битрикс24. Получите пример AI-отчёта по звонку.',
    'url' => $nero_schema_page,
    'provider' => [ '@id' => $nero_schema_site . '#organization' ],
  ],
  [
    '@type' => 'FAQPage',
    '@id' => $nero_schema_page . '#faq',
    'mainEntity' => [
      [ '@type' => 'Question', 'name' => 'Нужна ли отдельная телефония', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Не обязательна, если есть Mango, Sipuni, Телфин, UIS, OnlinePBX, Beeline или запись через CRM. Подключение через webhook, SIPREC или CRM-триггер.' ] ],
      [ '@type' => 'Question', 'name' => '152-ФЗ и хранение записей', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Записи — персональные данные; голос — уникальный идентификатор. Локализация в РФ с 01.09.2025. Nero Network: согласие, хранение в РФ, гибридный STT/LLM без неправомерной трансграничной передачи.' ] ],
      [ '@type' => 'Question', 'name' => 'Точность распознавания и доработка промптов', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'STT растёт с отраслевым словарём. Промпты калибруются на 20–50 звонках на пилоте. Спорные поля не перезаписывают CRM автоматически — human-in-the-loop.' ] ],
      [ '@type' => 'Question', 'name' => 'Сколько занимает запуск', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Типично 1–4 недели: аудит (3–5 дней), пилот (1–2 недели), масштабирование (3–7 дней). Как внедрить ai транскрибация звонков: заявка → аудит → демо → пилот → масштабирование.' ] ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( [ '@context' => 'https://schema.org', '@graph' => $nero_schema_graph ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>';
?>

</div>

</main>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("transkrib-crm-hero-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");
  let cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    const wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 600;
    canvas.height = wrap.clientHeight || 280;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 10;
    scale = Math.min(cw / 520, ch / 260) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  const C = {
    outline: "#cbd5e1",
    dim: "#64748b",
    phone: "#38bdf8",
    waveA: "#79f2ff",
    waveB: "#a78bfa",
    transcript: "#e2e8f0",
    crmBg: "#0f172a",
    crmCard: "#1e293b",
    crmAccent: "#22c55e",
    riskMid: "#fbbf24",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#1e293b"
  };

  function drawPolyRound(ctx, x, y, w, h, radius, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, radius);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) { ctx.lineWidth = 1.5; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  class VoiceArcPipeline {
    constructor() {
      this.nodes = [
        { t: 0.08, label: "REC" },
        { t: 0.32, label: "STT" },
        { t: 0.58, label: "AI" },
        { t: 0.86, label: "CRM" }
      ];
    }
    getPoint(t) {
      const x0 = -210, x1 = 210, y0 = 55, y1 = -75;
      const x = x0 + (x1 - x0) * t;
      const y = y0 + (y1 - y0) * t + Math.sin(t * Math.PI) * -35;
      return { x, y };
    }
    draw(ctx) {
      ctx.lineWidth = 2;
      ctx.strokeStyle = "rgba(121,242,255,.25)";
      ctx.beginPath();
      for (let i = 0; i <= 40; i++) {
        const p = this.getPoint(i / 40);
        if (i === 0) ctx.moveTo(p.x, p.y);
        else ctx.lineTo(p.x, p.y);
      }
      ctx.stroke();
      const prg = (frame * 0.04) % 240;
      this.nodes.forEach((n, i) => {
        const p = this.getPoint(n.t);
        const lit = prg > i * 50 + 20;
        drawPolyRound(ctx, p.x - 18, p.y - 10, 36, 20, 6, lit ? "rgba(121,242,255,.18)" : "rgba(255,255,255,.06)", C.outline);
        ctx.fillStyle = lit ? C.waveA : C.dim;
        ctx.font = "bold 8px Inter, sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(n.label, p.x, p.y + 3);
      });
      const pulse = (frame * 0.06) % 1;
      const pkt = this.getPoint(pulse);
      drawPolyRound(ctx, pkt.x - 8, pkt.y - 8, 16, 16, 4, C.waveA, C.outline);
    }
  }

  class PhoneBeacon {
    draw(ctx, prg) {
      const x = -220, y = 50;
      const ring = prg < 45 ? Math.sin(frame * 0.25) * 4 : 0;
      drawPolyRound(ctx, x - 22, y - 30 + ring, 44, 58, 10, C.crmCard, C.outline);
      ctx.fillStyle = C.phone;
      ctx.beginPath();
      ctx.arc(x, y + ring, 14, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1.5;
      ctx.stroke();
      if (prg < 45) {
        ctx.strokeStyle = "rgba(56,189,248,.35)";
        for (let r = 1; r <= 3; r++) {
          ctx.beginPath();
          ctx.arc(x, y + ring, 18 + r * 8 + (frame % 20), 0, Math.PI * 2);
          ctx.stroke();
        }
      }
    }
  }

  class CrmSummaryConsole {
    constructor(x, y) {
      this.x = x; this.y = y;
      this.syncFlash = 0;
      this.taskFly = 0;
    }
    draw(ctx, prg) {
      if (prg > 175 && prg < 195) this.syncFlash = (prg - 175) / 20;
      else if (prg >= 195) this.syncFlash = Math.max(0, 1 - (prg - 195) / 15);
      if (prg > 168) this.taskFly = Math.min(1, (prg - 168) / 12);

      drawPolyRound(ctx, this.x, this.y, 200, 150, 10, C.crmBg, C.outline);
      drawPolyRound(ctx, this.x + 8, this.y + 8, 184, 22, 6, "#334155", null);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 9px Inter, sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Сделка #1842 · amoCRM", this.x + 14, this.y + 22);

      if (prg > 55) {
        drawPolyRound(ctx, this.x + 10, this.y + 38, 180, 28, 4, "rgba(121,242,255,.12)", C.outline);
        ctx.fillStyle = C.transcript;
        ctx.font = "8px Inter, sans-serif";
        ctx.fillText("Резюме: бюджет согласован, срок — квартал", this.x + 16, this.y + 55);
      }
      if (prg > 95) {
        drawPolyRound(ctx, this.x + 10, this.y + 72, 85, 36, 4, "rgba(34,197,94,.15)", C.outline);
        ctx.fillStyle = "#bbf7d0";
        ctx.font = "bold 8px Inter, sans-serif";
        ctx.fillText("Задача", this.x + 16, this.y + 88);
        ctx.fillStyle = C.transcript;
        ctx.font = "7px Inter, sans-serif";
        ctx.fillText("КП до 12:00", this.x + 16, this.y + 100);
      }
      if (prg > 120) {
        drawPolyRound(ctx, this.x + 105, this.y + 72, 85, 36, 4, "rgba(251,191,36,.15)", C.outline);
        ctx.fillStyle = C.riskMid;
        ctx.font = "bold 8px Inter, sans-serif";
        ctx.fillText("Риск", this.x + 112, this.y + 88);
        ctx.fillStyle = C.transcript;
        ctx.fillText("средний", this.x + 112, this.y + 100);
      }
      if (prg > 140) {
        drawPolyRound(ctx, this.x + 10, this.y + 114, 180, 24, 4, "rgba(139,92,246,.14)", C.outline);
        ctx.fillStyle = "#ddd6fe";
        ctx.font = "7px Inter, sans-serif";
        ctx.fillText("Next: созвон с РОП · чт 15:00", this.x + 16, this.y + 129);
      }
      if (this.syncFlash > 0) {
        ctx.save();
        ctx.globalAlpha = this.syncFlash * 0.45;
        drawPolyRound(ctx, this.x - 4, this.y - 4, 208, 158, 12, C.crmAccent, null);
        ctx.restore();
      }
      if (this.taskFly > 0 && this.taskFly < 1) {
        const tx = this.x + 50 - this.taskFly * 120;
        const ty = this.y + 90 - this.taskFly * 60;
        drawPolyRound(ctx, tx, ty, 40, 18, 4, C.crmAccent, C.outline);
        ctx.fillStyle = "#052e16";
        ctx.font = "bold 7px Inter, sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("SYNC", tx + 20, ty + 12);
      }
    }
  }

  class SpeakerTag {
    draw(ctx, prg) {
      if (prg < 50 || prg > 130) return;
      const tags = ["Менеджер", "Клиент"];
      tags.forEach((t, i) => {
        const alpha = Math.min(1, (prg - 50 - i * 15) / 20);
        if (alpha <= 0) return;
        ctx.globalAlpha = alpha;
        drawPolyRound(ctx, -120 + i * 70, -55, 58, 16, 4, i ? "rgba(167,139,250,.2)" : "rgba(56,189,248,.2)", C.outline);
        ctx.fillStyle = C.transcript;
        ctx.font = "7px Inter, sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(t, -91 + i * 70, -44);
        ctx.globalAlpha = 1;
      });
    }
  }

  class TaskOrbit {
    draw(ctx, prg) {
      if (prg < 160) return;
      for (let i = 0; i < 5; i++) {
        const a = frame * 0.04 + i * 1.2;
        const ox = 175 + Math.cos(a) * 28;
        const oy = -55 + Math.sin(a) * 18;
        ctx.fillStyle = "rgba(34,197,94,.5)";
        ctx.beginPath();
        ctx.arc(ox, oy, 3, 0, Math.PI * 2);
        ctx.fill();
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
    draw(ctx, prg) {
      this.timer += 0.03;
      let isMoving = false, faceDir = 1, carryType = null;
      const pipeline = arcPipe;
      const nodeIdx = Math.floor(this.stepTrig / 55);
      const target = pipeline.getPoint([0.08, 0.32, 0.58, 0.86, 0.72][nodeIdx] || 0.5);
      const targetX = target.x;
      const targetY = target.y + 35;

      if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
        const local = prg - this.stepTrig;
        if (local < 11) {
          isMoving = true;
          this.x = this.baseX + (targetX - this.baseX) * (local / 11);
          this.y = this.baseY + (targetY - this.baseY) * (local / 11);
        } else if (local < 16) {
          this.x = targetX; this.y = targetY;
        } else {
          isMoving = true; faceDir = -1;
          const back = (local - 16) / 6;
          this.x = targetX - (targetX - this.baseX) * back;
          this.y = targetY - (targetY - this.baseY) * back;
        }
      } else {
        this.x = this.baseX; this.y = this.baseY;
        carryType = prg >= this.stepTrig - 8 ? this.color : null;
      }

      if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
      }

      const bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.5);
      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.lineJoin = "round";
      let legL = 0, legR = 0;
      if (isMoving) {
        const wp = this.timer * 6;
        legL = Math.sin(wp) * 4; legR = Math.sin(wp + Math.PI) * 4;
      }
      drawPolyRound(ctx, -8, -4 + Math.max(0, legL), 7, 12, 2, C.outline, null);
      drawPolyRound(ctx, 1, -4 + Math.max(0, legR), 7, 12, 2, C.outline, null);
      drawPolyRound(ctx, -13, -10 - bob, 26, 18, 5, this.color, C.outline);
      const hx = 0, hy = -24 - bob;
      ctx.fillStyle = this.color;
      ctx.beginPath(); ctx.arc(hx, hy, 10, 0, Math.PI * 2); ctx.fill();
      ctx.strokeStyle = C.outline; ctx.lineWidth = 1.5; ctx.stroke();
      ctx.save();
      ctx.scale(faceDir, 1);
      ctx.fillStyle = "#fff";
      ctx.beginPath(); ctx.arc(hx + 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
      ctx.fillStyle = C.outline;
      ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(hx - 2, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
      if (this.role === "1_architect") {
        ctx.strokeStyle = C.outline; ctx.strokeRect(hx, hy - 4, 5, 5);
      } else if (this.role === "3_coder") {
        ctx.fillStyle = C.outline;
        ctx.fillRect(hx - 6, hy - 6, 12, 2);
      } else if (this.role === "5_deployer") {
        ctx.strokeStyle = C.outline;
        ctx.beginPath(); ctx.arc(hx, hy, 11, Math.PI, Math.PI * 2); ctx.stroke();
      }
      ctx.restore();
      if (carryType) drawPolyRound(ctx, -16 * faceDir, -14 - bob, 12, 12, 2, carryType, C.outline);
      ctx.restore();
    }
  }

  const arcPipe = new VoiceArcPipeline();
  const phone = new PhoneBeacon();
  const crm = new CrmSummaryConsole(70, -95);
  const speakers = new SpeakerTag();
  const orbit = new TaskOrbit();
  const bubbles = [];

  const agents = [
    new Agent(-250, 75, C.agentYellow, "1_architect", 18, ["Webhook телефонии", "Метаданные звонка", "deal_id в payload"]),
    new Agent(-180, 20, C.agentGreen, "2_seo", 58, ["Ключи в транскрипте", "Возражение по цене", "LSI в резюме"]),
    new Agent(-100, 85, C.agentBlue, "3_coder", 98, ["SpeechKit async", "Диаризация готова", "Таймкоды спикеров"]),
    new Agent(-20, 15, C.agentPink, "4_designer", 138, ["5 пунктов резюме", "Блок next step", "Цитата 08:42"]),
    new Agent(40, 70, C.agentPurple, "5_deployer", 178, ["Задача в CRM", "Риск: средний", "Поля обновлены"])
  ];

  function createBubble(x, y, text, customLife = 260) {
    bubbles.push({ x, y, text, life: customLife, maxLife: customLife });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    const prg = (frame * 0.04) % 240;

    arcPipe.draw(ctx);
    phone.draw(ctx, prg);
    speakers.draw(ctx, prg);
    crm.draw(ctx, prg);
    orbit.draw(ctx, prg);

    agents.sort((a, b) => a.y - b.y);
    agents.forEach(a => a.draw(ctx, prg));

    if (prg >= 16 && prg < 16.08) createBubble(-220, 20, "1. Запись звонка");
    if (prg >= 56 && prg < 56.08) createBubble(-80, -20, "2. STT + спикеры");
    if (prg >= 96 && prg < 96.08) createBubble(0, 30, "3. AI-резюме");
    if (prg >= 136 && prg < 136.08) createBubble(60, -10, "4. Поля CRM");
    if (prg >= 176 && prg < 176.08) createBubble(120, -70, "5. Задача в CRM");

    ctx.font = "bold 10px Inter, sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (let i = bubbles.length - 1; i >= 0; i--) {
      const bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      let alpha = Math.min(1, bub.life / 25);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      const tw = ctx.measureText(bub.text).width + 14;
      const th = 18;
      const bx = bub.x;
      const by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawPolyRound(ctx, bx - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.transcript;
      ctx.fillText(bub.text, bx, by - th / 2);
      ctx.globalAlpha = 1;
    }
    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  document.fonts.ready.then(() => engineloop());
});
</script>


<script>
document.addEventListener('DOMContentLoaded',function(){
  document.querySelectorAll('.trzk-faq-q').forEach(function(q){
    function toggle(){
      var item=q.closest('.trzk-faq-item');
      var open=item.classList.contains('open');
      document.querySelectorAll('.trzk-faq-item').forEach(function(i){i.classList.remove('open');i.querySelector('.trzk-faq-q').setAttribute('aria-expanded','false');});
      if(!open){item.classList.add('open');q.setAttribute('aria-expanded','true');}
    }
    q.addEventListener('click',toggle);
    q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();toggle();}});
  });
});
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

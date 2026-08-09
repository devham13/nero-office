<?php
/**
 * Template Name: AI для недвижимости и риелторов: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI для агентств недвижимости и риелторов.
 */

$page_seo_title       = 'AI для недвижимости и риелторов: внедрение под ключ';
$page_seo_description = 'Внедрение AI для агентств недвижимости и риелторов: квалификация лидов, подбор объектов, ответы клиентам 24/7 и интеграция с CRM. Цена, кейсы, аудит воронки — заказать под ключ.';

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
    ['label' => 'Задачи', 'href' => '#zadachi'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'CRM', 'href' => '#integracii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Подключить AI к продажам';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Какие задачи закрывает AI';
$secondary_cta_url = '#zadachi';

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

/* === ANED PAGE — GLOBAL RESETS === */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important;}
.aned-hero-nedvizh.nero-ai-hero{min-height:100vh;min-height:100dvh;position:relative;}
.aned-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aned-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aned-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid rgba(255,255,255,.10);border-radius:999px;font-size:13px;font-weight:600;color:#9aa8bd;transition:border-color .2s,color .2s,background .2s;}
.aned-toc a:hover{border-color:rgba(121,242,255,.42);color:#79f2ff;background:rgba(121,242,255,.08);}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--primary{background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border-color:rgba(121,242,255,.3);}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:#9aa8bd;font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-cta-block__btn{margin-top:4px;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:#e6edf7!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:#79f2ff!important;text-decoration:underline!important;}
.aned-ad-slot{margin:32px 0;text-align:center;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
.ai-dlya-nedvizhimosti-page .aned-content .nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.ai-dlya-nedvizhimosti-page .aned-content .nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.ai-dlya-nedvizhimosti-page .nero-ai-delay-1{transition-delay:.12s;}
.ai-dlya-nedvizhimosti-page .nero-ai-delay-2{transition-delay:.24s;}


/* ANED HERO — самодостаточный блок первого экрана (nero-ai-home-page) */
.aned-hero-nedvizh {
  --aned-bg: #050711;
  --aned-bg2: #080b17;
  --aned-text: #e6edf7;
  --aned-muted: #9aa8bd;
  --aned-soft: #c7d2e5;
  --aned-accent: #79f2ff;
  --aned-violet: #8b5cf6;
  --aned-green: #22c55e;
  --aned-amber: #f59e0b;
  --aned-shadow: 0 24px 72px rgba(0, 0, 0, 0.42);
  position: relative;
  padding: clamp(72px, 10vw, 120px) 0 clamp(48px, 7vw, 88px);
  background:
    radial-gradient(ellipse 80% 55% at 15% 0%, rgba(121, 242, 255, 0.14), transparent 58%),
    radial-gradient(ellipse 60% 50% at 88% 12%, rgba(139, 92, 246, 0.16), transparent 55%),
    linear-gradient(180deg, var(--aned-bg) 0%, var(--aned-bg2) 52%, var(--aned-bg) 100%);
  color: var(--aned-text);
  overflow: hidden;
}
.aned-hero-nedvizh::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
  background-size: 48px 48px;
  mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.55), transparent 85%);
  pointer-events: none;
}
.aned-hero-nedvizh .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aned-hero-nedvizh .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, 0.95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aned-hero-nedvizh .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: 0.96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aned-hero-nedvizh .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aned-accent) 44%, var(--aned-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aned-hero-nedvizh .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aned-accent) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aned-hero-nedvizh .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aned-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aned-hero-nedvizh .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aned-hero-nedvizh .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 8px 11px;
  border: 1px solid rgba(255, 255, 255, 0.11);
  border-radius: 999px;
  background: rgba(255, 255, 255, 0.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.aned-hero-nedvizh .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aned-hero-nedvizh .nero-ai-btn {
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
  transition: transform 0.22s ease, border-color 0.22s ease, background 0.22s ease;
}
.aned-hero-nedvizh .nero-ai-btn:hover { transform: translateY(-2px); }
.aned-hero-nedvizh .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--aned-accent), #38bdf8);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aned-hero-nedvizh .nero-ai-btn-secondary {
  color: var(--aned-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aned-hero-nedvizh .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aned-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.aned-hero-nedvizh .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, 0.95), rgba(6, 10, 24, 0.96));
}
.aned-hero-nedvizh .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.045);
}
.aned-hero-nedvizh .nero-ai-dots { display: flex; gap: 7px; }
.aned-hero-nedvizh .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aned-hero-nedvizh .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aned-hero-nedvizh .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aned-hero-nedvizh .nero-ai-dot:nth-child(3) { background: #34d399; }
.aned-hero-nedvizh .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}
.aned-hero-nedvizh .nero-ai-window-body { padding: 16px; }
.aned-hero-nedvizh .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aned-hero-nedvizh .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aned-hero-nedvizh .nero-ai-live-pill {
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
.aned-hero-nedvizh .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.14);
  animation: anedPulse 1.6s infinite;
}
@keyframes anedPulse {
  0%, 100% { transform: scale(0.86); opacity: 0.65; }
  50% { transform: scale(1); opacity: 1; }
}
.aned-hero-nedvizh .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aned-hero-nedvizh .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255, 255, 255, 0.09);
  border-radius: 16px;
  background: rgba(255, 255, 255, 0.055);
}
.aned-hero-nedvizh .nero-ai-metric span {
  display: block;
  color: var(--aned-muted);
  font-size: 11px;
  font-weight: 700;
}
.aned-hero-nedvizh .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aned-hero-nedvizh .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aned-hero-nedvizh .aned-dash-canvas-wrap {
  position: relative;
  height: 220px;
  margin-bottom: 12px;
  border-radius: 16px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  background: linear-gradient(180deg, rgba(15, 23, 42, 0.55), rgba(2, 6, 23, 0.85));
  overflow: hidden;
}
.aned-hero-nedvizh #aned-nedvizh-hero-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.aned-hero-nedvizh .nero-ai-task-stream { display: flex; flex-direction: column; gap: 8px; }
.aned-hero-nedvizh .nero-ai-task {
  display: grid;
  grid-template-columns: 36px 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.04);
}
.aned-hero-nedvizh .nero-ai-task-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: rgba(121, 242, 255, 0.12);
  color: var(--aned-accent);
  font-size: 10px;
  font-weight: 900;
}
.aned-hero-nedvizh .nero-ai-task strong {
  display: block;
  color: #fff;
  font-size: 13px;
  font-weight: 800;
}
.aned-hero-nedvizh .nero-ai-task span {
  display: block;
  color: var(--aned-muted);
  font-size: 11px;
}
.aned-hero-nedvizh .nero-ai-status {
  padding: 5px 9px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.12);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aned-hero-nedvizh .nero-ai-status--amber {
  background: rgba(245, 158, 11, 0.12);
  color: #fde68a;
}
.aned-hero-nedvizh .nero-ai-reveal {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity 0.55s ease, transform 0.55s ease;
}
.aned-hero-nedvizh .nero-ai-reveal.nero-ai-active {
  opacity: 1;
  transform: none;
}
.aned-hero-nedvizh .nero-ai-delay-2 { transition-delay: 0.24s; }
@media (max-width: 1100px) {
  .aned-hero-nedvizh .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aned-hero-nedvizh .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aned-hero-nedvizh .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aned-hero-nedvizh .nero-ai-window-body { padding: 12px; }
  .aned-hero-nedvizh .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aned-hero-nedvizh .nero-ai-status { grid-column: 2; width: fit-content; }
  .aned-hero-nedvizh .aned-dash-canvas-wrap { height: 190px; }
}

/* === ANED CONTENT ROOT — тёмная тема, префикс aned- === */
.aned-content{
  --aned-bg:#050711;--aned-bg2:#080b17;--aned-bg3:#0a0e1c;
  --aned-surface:rgba(255,255,255,.072);--aned-surface2:rgba(255,255,255,.108);
  --aned-text:#e6edf7;--aned-muted:#9aa8bd;--aned-soft:#c7d2e5;--aned-heading:#fff;
  --aned-border:rgba(255,255,255,.10);--aned-border-s:rgba(255,255,255,.18);
  --aned-accent:#79f2ff;--aned-violet:#8b5cf6;--aned-green:#22c55e;--aned-cyan:#79f2ff;
  --aned-r:18px;--aned-r-lg:24px;--aned-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aned-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aned-content *,.aned-content *::before,.aned-content *::after{box-sizing:border-box;}
.aned-content a{color:inherit;text-decoration:none;}
.aned-content p{color:var(--aned-muted);line-height:1.72;margin:0 0 1em;}
.aned-content p:last-child{margin-bottom:0;}
.aned-content h2,.aned-content h3,.aned-content h4{color:var(--aned-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.aned-content strong{color:var(--aned-soft);}
.aned-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aned-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aned-muted);font-size:14.5px;line-height:1.65;}
.aned-content ul li::before{content:'›';position:absolute;left:0;color:var(--aned-accent);font-weight:700;}
.aned-cnt{width:min(var(--aned-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aned-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aned-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aned-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aned-sh.aned-left{margin-left:0;text-align:left;}
.aned-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aned-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aned-sh.aned-left p{margin-left:0;}
.aned-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aned-accent);margin-bottom:14px;}
.aned-gt{background:linear-gradient(92deg,#fff 0%,var(--aned-accent) 44%,var(--aned-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.aned-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.aned-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.aned-intro-text{position:relative;padding-left:20px;}
.aned-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aned-accent),var(--aned-violet));}
.aned-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--aned-muted);margin-bottom:1em;}
.aned-intro-text p:last-child{margin-bottom:0;color:var(--aned-soft);}
.aned-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aned-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.aned-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aned-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.aned-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aned-muted);line-height:1.4;}
.aned-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.aned-intro-grid{grid-template-columns:1fr;gap:36px;}.aned-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.aned-intro-kpi{grid-template-columns:1fr 1fr;}}
.aned-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aned-border);border-radius:var(--aned-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.aned-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.aned-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aned-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.aned-grid-2,.aned-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.aned-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aned-grid-3{grid-template-columns:1fr;}}
.aned-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--aned-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.aned-scenario:last-child{margin-bottom:0;}
.aned-scenario:hover{border-color:rgba(121,242,255,.3);}
.aned-scenario h3{font-size:17px;margin-bottom:8px;}
.aned-scenario p{font-size:14.5px;margin:0 0 .6em;}
.aned-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aned-table{width:100%;border-collapse:collapse;font-size:14px;}
.aned-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--aned-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.aned-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aned-text);vertical-align:top;}
.aned-table tr:last-child td{border-bottom:none;}
.aned-table tr:hover td{background:rgba(255,255,255,.03);}
.aned-timeline{position:relative;padding-left:40px;}
.aned-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aned-accent),var(--aned-violet));opacity:.35;border-radius:2px;}
.aned-tl-item{position:relative;margin-bottom:32px;}
.aned-tl-item:last-child{margin-bottom:0;}
.aned-tl-dot{position:absolute;left:-34px;top:6px;width:12px;height:12px;border-radius:50%;background:var(--aned-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.aned-tl-item h3{font-size:17px;margin-bottom:6px;}
.aned-tl-item p{font-size:14.5px;margin:0;}
.aned-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aned-faq-item{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:var(--aned-r);overflow:hidden;}
.aned-faq-q{padding:18px 24px;font-weight:700;color:var(--aned-heading);cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:12px;}
.aned-faq-q::after{content:'▾';color:var(--aned-accent);transition:transform .2s;}
.aned-faq-item.open .aned-faq-q::after{transform:rotate(180deg);}
.aned-faq-a{max-height:0;overflow:hidden;padding:0 24px;color:var(--aned-muted);font-size:14.5px;line-height:1.65;transition:max-height .3s,padding .3s;}
.aned-faq-item.open .aned-faq-a{max-height:600px;padding:0 24px 20px;}
.aned-quote{border-left:3px solid var(--aned-accent);padding:16px 20px;margin:24px 0;background:rgba(121,242,255,.06);border-radius:0 12px 12px 0;}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlya-nedvizhimosti-page" role="main" tabindex="-1">

<section class="nero-ai-hero aned-hero-nedvizh" id="hero" aria-labelledby="hero-nedvizh-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai недвижимость</p>
      <h1 id="hero-nedvizh-title">AI для недвижимости и риелторов: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Квалифицируем лиды, подбираем объекты и отвечаем на вопросы 24/7 — без потери заявок в CRM</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Квалификация лидов</li>
        <li class="nero-ai-badge">Подбор объектов</li>
        <li class="nero-ai-badge">Авито/ЦИАН/Домклик</li>
        <li class="nero-ai-badge">CRM auto</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Подключить AI к продажам'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#zadachi">Какие задачи закрывает AI</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI в воронке недвижимости">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">недвижимость · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Воронка лидов · AI-агент</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Заявки сегодня</span>
              <strong>18</strong>
              <small>Авито/ЦИАН</small>
            </div>
            <div class="nero-ai-metric">
              <span>Первый ответ</span>
              <strong>&lt;1 мин</strong>
              <small>24/7</small>
            </div>
            <div class="nero-ai-metric">
              <span>Квалифицировано</span>
              <strong>12</strong>
              <small>в CRM</small>
            </div>
            <div class="nero-ai-metric">
              <span>Рутина агента</span>
              <strong>−30%</strong>
              <small>меньше</small>
            </div>
          </div>

          <div class="aned-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aned-nedvizh-hero-canvas" role="img" aria-label="Анимация: лиды с Авито и ЦИАН квалифицируются, объекты подбираются и передаются риелтору в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий воронки">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">IN</span>
              <div><strong>Заявка с Авито</strong><span>квалификация лида</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Бюджет и район собраны</strong><span>BANT в диалоге</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Подбор 3 объектов</strong><span>из фида в карточку</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Задача риелтору: показ</strong><span>слот 18:00</span></div>
              <span class="nero-ai-status nero-ai-status--amber">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="aned-content">

  <!-- INTRO #intro -->
  <section class="aned-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="aned-cnt">
      <div class="aned-intro-grid nero-ai-reveal">
        <div class="aned-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai недвижимость</p>
          <p>Заявки с Авито, ЦИАН и Домклик приходят вечером и в выходные. Риелтор отвечает через час — клиент уже написал трём конкурентам. CRM пустая, потому что параметры запроса так и не внесли в карточку. <strong>AI для недвижимости</strong> в 2026 году — связка: входящие каналы → AI-агент первой линии → CRM → живой риелтор на показе и сделке.</p>
          <p><strong>Коротко:</strong> искусственный интеллект для недвижимости закрывает первичный контакт, квалификацию, подбор объектов и follow-up — 24/7, без потери заявок в CRM.</p>
        </div>
        <div class="aned-intro-kpi" aria-label="Ключевые метрики">
          <div class="aned-kpi-card"><div class="kv">54%</div><div class="kl">уже использовали AI-агентов</div><div class="ks">Salesforce 2026</div></div>
          <div class="aned-kpi-card"><div class="kv">+20%</div><div class="kl">заявок до сделки</div><div class="ks">Самолёт Плюс</div></div>
          <div class="aned-kpi-card"><div class="kv">&lt;1 мин</div><div class="kl">целевой первый ответ</div><div class="ks">пилот Nero Network</div></div>
          <div class="aned-kpi-card"><div class="kv">−30%</div><div class="kl">рутины агента</div><div class="ks">Жилфонд, оценка</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Оглавление -->
  <div class="aned-cnt aned-toc-outer nero-ai-reveal" id="toc">
    <nav class="aned-toc" aria-label="Оглавление страницы">
      <a href="#chto-takoe">Что такое AI</a>
      <a href="#zadachi">Задачи</a>
      <a href="#scenarii">Сценарии</a>
      <a href="#vnedrenie">Внедрение</a>
      <a href="#integracii">CRM</a>
      <a href="#ceny">Цена</a>
      <a href="#keisy">Кейсы</a>
      <a href="#faq">FAQ</a>
    </nav>
  </div>

  <aside class="aned-card nero-ai-reveal" style="margin:28px 0;" aria-label="См. также">
    <p style="margin:0 0 10px;font-weight:700;color:#e6edf7;">См. также по внедрению AI</p>
    <ul style="margin:0;padding:0;list-style:none;display:flex;flex-wrap:wrap;gap:10px;">
      <li><a class="ym-link--accent" href="/vnedrenie-ai-amocrm/">AI-агент для amoCRM</a></li>
      <li><a class="ym-link--accent" href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработка почты в CRM</a></li>
      <li><a class="ym-link--accent" href="/ai-1c-erp/">AI для 1С и ERP</a></li>
    </ul>
  </aside>

  <!-- H2 #1 #chto-takoe -->
  <section class="aned-section" id="chto-takoe">
    <div class="aned-cnt">
      <div class="aned-sh aned-left">
        <span class="aned-eyebrow">Определение</span>
        <h2>Что такое AI для недвижимости и зачем он агентству в 2026 году</h2>
        <p>AI для недвижимости — связанная система: чаты и формы, мессенджеры, API площадок → <strong>AI-агент</strong> → CRM → задача риелтору. Нейросети здесь ведут диалог по сценарию, заполняют поля сделки и маршрутизируют лид.</p>
      </div>

      <div class="aned-card nero-ai-reveal">
        <p>По данным <strong>Salesforce State of Sales 2026</strong> (4 050 sales professionals), инвестиции в AI — главная тактика роста: 54% уже использовали AI-агентов, ~9 из 10 планируют к 2027; 94% руководителей с агентами называют их критичными.</p>
        <ul>
          <li>заявки не остывают в нерабочее время;</li>
          <li>первичная квалификация без ручного ввода;</li>
          <li>подбор объектов по фиду CRM;</li>
          <li>follow-up и реактивация «спящей» базы.</li>
        </ul>
      </div>

      <div class="aned-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="aned-card">
          <h3>От ручной обработки к AI-агентам</h3>
          <p>Типовой путь: заявка → сделка в CRM → AI уточняет 4–6 параметров → подбор по фиду → статус «квалифицирован» → задача риелтору. При сложном вопросе — <strong>тихая эскалация</strong> в том же чате (модель «Самолёт Плюс»).</p>
        </div>
        <div class="aned-card nero-ai-delay-1">
          <h3>Кому подходит</h3>
          <p><strong>Агентство</strong> — квалификация с классифайдов. <strong>Застройщик</strong> — книга продаж и фид планировок. <strong>Риелтор в сети</strong> — единый стандарт первичного контакта, −30–40% админвремени (оценка «Жилфонд»).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #2 #zadachi -->
  <section class="aned-section aned-section-alt" id="zadachi">
    <div class="aned-cnt">
      <div class="aned-sh">
        <span class="aned-eyebrow">Боли отдела продаж</span>
        <h2>Какие задачи решает AI в отделе продаж недвижимости</h2>
        <p>Заявки, показы, подбор объектов и ответы клиентам занимают слишком много времени — AI убирает рутину до сделки.</p>
      </div>

      <div class="aned-table-wrap nero-ai-reveal">
        <table class="aned-table">
          <thead><tr><th>Задача</th><th>Без AI</th><th>С AI-агентом</th></tr></thead>
          <tbody>
            <tr><td>Первый ответ</td><td>Часы, особенно ночью</td><td>Минуты, 24/7</td></tr>
            <tr><td>Квалификация</td><td>Менеджер по скрипту</td><td>BANT / своя матрица в диалоге</td></tr>
            <tr><td>Подбор объектов</td><td>Ручной поиск в CRM</td><td>Поиск по фиду + правила</td></tr>
            <tr><td>CRM</td><td>Пустые карточки</td><td>Автозаполнение полей</td></tr>
            <tr><td>Follow-up</td><td>Забытые лиды</td><td>Сценарии по расписанию</td></tr>
          </tbody>
        </table>
      </div>

      <div class="aned-grid-3 nero-ai-reveal" style="margin-top:28px;">
        <div class="aned-card">
          <h3>Квалификация лидов 24/7</h3>
          <p>Бюджет, район, тип, срок, ипотека, цель. Кейс Agentmelt (США): первый ответ с 4+ ч до &lt;2 мин; qualified showings ×3 на агента в неделю — <em>кейс другой компании</em>.</p>
        </div>
        <div class="aned-card nero-ai-delay-1">
          <h3>Подбор и FAQ</h3>
          <p>Сопоставление с фидом CRM, ответы только из базы знаний. «Самолёт Плюс»: подбор быстрее в 5–10 раз; &gt;10 ч/нед экономии на агента.</p>
        </div>
        <div class="aned-card nero-ai-delay-2">
          <h3>Показ и follow-up</h3>
          <p>Запись на показ, напоминания, реактивация лидов 3/7/14 дней. Риелтор получает карточку с резюме диалога, а не сырой лид.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA-1 после #zadachi (из Артура) -->
  <div class="aned-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-audit">
      <div class="ym-cta-block__icon" aria-hidden="true">🏠</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Аудит воронии недвижимости — бесплатно</p>
        <p class="ym-cta-block__sub">Разберём каналы (Авито, ЦИАН, Домклик, сайт, мессенджеры), этапы CRM и узкие места: где остывают заявки ночью и не попадают в карточку сделки. На выходе — карта воронии и приоритет сценария для пилота.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Заказать аудит воронии</a>
      </div>
    </div>
  </div>

  <!-- ===== БОРИС: визуализация воронии (не в меню) ===== -->
  <section id="ai-dlya-nedvizhimosti-boris-block" class="bned-root" aria-label="Анимация: путь лида от площадки через AI-квалификацию в CRM и к риелтору">
<style>
/* === БОРИС: prefix bned-, scoped внутри #ai-dlya-nedvizhimosti-boris-block === */
#ai-dlya-nedvizhimosti-boris-block.bned-root{padding:56px 0 64px;background:#eef2f8;}
#ai-dlya-nedvizhimosti-boris-block .bned-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-dlya-nedvizhimosti-boris-block .bned-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-dlya-nedvizhimosti-boris-block .bned-card{grid-template-columns:1fr;min-height:auto;}
}
#ai-dlya-nedvizhimosti-boris-block .bned-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-dlya-nedvizhimosti-boris-block .bned-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#ai-dlya-nedvizhimosti-boris-block .bned-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:#0891b2;margin:0 0 14px;
}
#ai-dlya-nedvizhimosti-boris-block .bned-ey::before{content:'';width:18px;height:2px;background:#0891b2;border-radius:1px;}
#ai-dlya-nedvizhimosti-boris-block .bned-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#ai-dlya-nedvizhimosti-boris-block .bned-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-dlya-nedvizhimosti-boris-block .bned-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#ai-dlya-nedvizhimosti-boris-block .bned-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(8,145,178,.1);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#0e7490;margin-top:1px;font-style:normal;
}
#ai-dlya-nedvizhimosti-boris-block .bned-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-dlya-nedvizhimosti-boris-block .bned-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-dlya-nedvizhimosti-boris-block .bned-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-dlya-nedvizhimosti-boris-block .bned-pl-c{background:rgba(8,145,178,.08);color:#0e7490;border:1.5px solid rgba(8,145,178,.22);}
#ai-dlya-nedvizhimosti-boris-block .bned-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#ai-dlya-nedvizhimosti-boris-block .bned-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-dlya-nedvizhimosti-boris-block .bned-rgt{
  position:relative;background:linear-gradient(135deg,#ecfeff 0%,#f0f9ff 35%,#faf5ff 70%,#f8fafc 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){#ai-dlya-nedvizhimosti-boris-block .bned-rgt{min-height:380px;}}
#bned-funnel-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="bned-cnt">
  <div class="bned-card">
    <div class="bned-lft">
      <span class="bned-ey">Ворония недвижимости</span>
      <h3 class="bned-h3">Авито, ЦИАН или Telegram — лид квалифицируется и попадает в CRM до звонка риелтора</h3>
      <ul class="bned-ul">
        <li><span class="bned-ic">1</span>Заявка с площадки или мессенджера → сделка в amoCRM / Битрикс24</li>
        <li><span class="bned-ic">2</span>AI собирает бюджет, район, срок, ипотеку — ответ &lt;1 мин</li>
        <li><span class="bned-ic">3</span>Подбор 2–3 объектов из фида, без «придуманных» квартир</li>
        <li><span class="bned-ic">→</span>Статус «квалифицирован» + задача риелтору: показ</li>
      </ul>
      <div class="bned-pills">
        <span class="bned-pl bned-pl-c">Авито · ЦИАН · Домклик</span>
        <span class="bned-pl bned-pl-g">24/7 первый ответ</span>
        <span class="bned-pl bned-pl-v">CRM auto-fill</span>
      </div>
      <p class="bned-foot">Дальше — сценарии AI-агентов по каналам и сегментам →</p>
    </div>
    <div class="bned-rgt">
      <canvas id="bned-funnel-pipeline-canvas" role="img" aria-label="Анимация: лиды с площадок проходят AI-квалификацию, заполняют CRM и передаются риелтору на показ"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bned-funnel-pipeline-canvas');
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
    ink:'#0f172a', muted:'#64748b', paper:'#ffffff', line:'rgba(8,145,178,.25)',
    avito:'#00aaff', cian:'#0468ff', dom:'#7c3aed', tg:'#229ed9',
    ai:'#8b5cf6', aiGlow:'rgba(139,92,246,.18)',
    crm:'#1e293b', crmAccent:'#79f2ff', green:'#22c55e', amber:'#f59e0b',
    realtor:'#0ea5e9'
  };

  var CHANNELS = [
    {label:'Авито', color:C.avito, delay:0},
    {label:'ЦИАН', color:C.cian, delay:90},
    {label:'TG', color:C.tg, delay:180},
    {label:'Домклик', color:C.dom, delay:270}
  ];
  var STAGES = ['Новый','Квалиф.','Показ','Сделка'];
  var LOOP = 720;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle=fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawChannelHub(x,y,w,h){
    ctx.fillStyle=C.muted;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('КАНАЛЫ', x+w/2, y-6);
    CHANNELS.forEach(function(ch,i){
      var cy = y + i * (h/4) + 8;
      rr(x,cy,w, h/4 - 10, 8, C.paper, ch.color, 2);
      ctx.fillStyle=ch.color;
      ctx.font='bold 11px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(ch.label, x+12, cy + (h/4 - 10)/2 + 4);
    });
  }

  function drawAiHub(cx,cy,r,pulse){
    var g = ctx.createRadialGradient(cx,cy,4,cx,cy,r+20);
    g.addColorStop(0, C.aiGlow);
    g.addColorStop(1, 'rgba(139,92,246,0)');
    ctx.fillStyle=g;
    ctx.beginPath(); ctx.arc(cx,cy,r+18,0,Math.PI*2); ctx.fill();
    rr(cx-r,cy-r,r*2,r*2,r,C.paper,C.ai,2.5);
    ctx.fillStyle=C.ai;
    ctx.font='bold 12px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('AI', cx, cy-4);
    ctx.font='9px Inter,sans-serif';
    ctx.fillStyle=C.muted;
    ctx.fillText('квалификация', cx, cy+10);
    for (var i=0;i<4;i++){
      var a = (i/4)*Math.PI*2 + pulse*0.05;
      ctx.beginPath();
      ctx.arc(cx+Math.cos(a)*(r+10), cy+Math.sin(a)*(r+10), 3, 0, Math.PI*2);
      ctx.fillStyle=C.ai; ctx.fill();
    }
  }

  function drawCrmBoard(x,y,w,h,doneStage,pulse){
    rr(x,y,w,h,12,C.crm,'#334155',2);
    ctx.fillStyle=C.crmAccent;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('CRM · ворония', x+12, y+20);
    var colW = (w-24)/4, top = y+32;
    STAGES.forEach(function(st,i){
      var sx = x+12+i*colW;
      var filled = i <= doneStage;
      rr(sx, top, colW-6, h-44, 6, filled?'rgba(34,197,94,.15)':'rgba(255,255,255,.05)', filled?C.green:'rgba(255,255,255,.12)',1);
      ctx.fillStyle=filled?C.green:'rgba(226,232,240,.7)';
      ctx.font=(filled?'bold ':'')+'9px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(st, sx+(colW-6)/2, top+28);
    });
    if (doneStage < 3){
      var prog = (pulse%50)/50;
      var lx = x+12+doneStage*colW+(colW-6)*prog;
      ctx.beginPath();
      ctx.arc(lx, top+(h-44)/2, 5, 0, Math.PI*2);
      ctx.fillStyle=C.amber; ctx.fill();
    }
  }

  function drawRealtor(x,y){
    rr(x,y,72,56,10,C.paper,C.realtor,2);
    ctx.fillStyle=C.realtor;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Риелтор', x+36, y+22);
    ctx.font='9px Inter,sans-serif';
    ctx.fillStyle=C.muted;
    ctx.fillText('показ', x+36, y+38);
  }

  function drawLead(x,y,color,alpha){
    ctx.globalAlpha=alpha||1;
    ctx.beginPath();
    ctx.arc(x,y,6,0,Math.PI*2);
    ctx.fillStyle=color;
    ctx.fill();
    ctx.globalAlpha=1;
  }

  function drawArrow(x1,y1,x2,y2,alpha){
    ctx.globalAlpha=alpha||0.45;
    ctx.strokeStyle=C.line;
    ctx.lineWidth=1.5;
    ctx.setLineDash([5,4]);
    ctx.beginPath();
    ctx.moveTo(x1,y1); ctx.lineTo(x2,y2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t = frame % LOOP;
    ctx.clearRect(0,0,W,H);

    var pad = 16;
    var chW = Math.min(100, W*0.16);
    var chH = Math.min(200, H*0.72);
    var chX = pad;
    var chY = H*0.5 - chH/2;

    var aiR = Math.min(36, W*0.05);
    var aiX = W*0.42;
    var aiY = H*0.5;

    var crmW = Math.min(200, W*0.32);
    var crmH = Math.min(160, H*0.42);
    var crmX = W*0.58;
    var crmY = H*0.5 - crmH/2;

    var relX = W - pad - 72;
    var relY = H*0.5 - 28;

    drawChannelHub(chX, chY, chW, chH);
    drawAiHub(aiX, aiY, aiR, frame);
    var doneStage = Math.min(3, Math.floor(t/160));
    drawCrmBoard(crmX, crmY, crmW, crmH, doneStage, frame);
    drawRealtor(relX, relY);

    drawArrow(chX+chW, chY+chH/2, aiX-aiR, aiY, 0.5);
    drawArrow(aiX+aiR, aiY, crmX, crmY+crmH/2, 0.5);
    if (doneStage >= 2) drawArrow(crmX+crmW, crmY+crmH/2, relX, relY+28, 0.6);

    CHANNELS.forEach(function(ch){
      var localT = (t - ch.delay + LOOP) % LOOP;
      if (localT > LOOP - 60) return;
      var prog = Math.min(1, localT / 280);
      var startY = chY + CHANNELS.indexOf(ch) * (chH/4) + (chH/4 - 10)/2 + 8;
      var x = chX + chW + (aiX - aiR - chX - chW) * Math.min(1, prog*1.2);
      var y = startY + (aiY - startY) * Math.min(1, prog);
      var alpha = prog < 0.92 ? 1 : Math.max(0, 1 - (localT - 250)/20);
      if (prog > 0.35 && prog < 0.85){
        x = aiX + (crmX - aiX) * ((prog - 0.35) / 0.5);
        y = aiY;
      } else if (prog >= 0.85){
        x = crmX + (crmW * 0.3);
        y = crmY + crmH/2;
      }
      drawLead(x, y, ch.color, alpha);
    });

    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Площадки', pad, H-10);
    ctx.textAlign='center';
    ctx.fillText('AI-агент', aiX, H-10);
    ctx.textAlign='right';
    ctx.fillText('CRM → риелтор', W-pad, H-10);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>

  <!-- H2 #3 #scenarii -->
  <section class="aned-section" id="scenarii">
    <div class="aned-cnt">
      <div class="aned-sh">
        <span class="aned-eyebrow">AI-агенты</span>
        <h2>AI-агенты и сценарии для риелторов и агентств</h2>
        <p>Автономные сценарии с доступом к CRM, календарю и базе объектов — не коробочный FAQ-бот.</p>
      </div>

      <div class="aned-card nero-ai-reveal">
        <h3>Единая архитектура каналов</h3>
        <ul>
          <li><strong>Сайт:</strong> виджет, формы, онлайн-консультант</li>
          <li><strong>Мессенджеры:</strong> Telegram, WhatsApp, MAX</li>
          <li><strong>Площадки:</strong> Авито, ЦИАН, Домклик, Яндекс.Недвижимость</li>
          <li><strong>Телефония (опц.):</strong> голосовой бот на входящих</li>
        </ul>
      </div>

      <div class="aned-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aned-table">
          <thead><tr><th>Сегмент</th><th>Фокус AI</th><th>Источник данных</th></tr></thead>
          <tbody>
            <tr><td>Агентство вторички</td><td>Объекты в CRM, район, торг</td><td>Фид + карточки сделок</td></tr>
            <tr><td>Застройщик / ЖК</td><td>Лоты, планировки, акции</td><td>Книга продаж + фид</td></tr>
            <tr><td>Коммерция</td><td>BTS, аренда, окупаемость</td><td>Отдельная матрица</td></tr>
          </tbody>
        </table>
      </div>

      <div class="aned-table-wrap nero-ai-reveal" style="margin-top:20px;">
        <table class="aned-table">
          <thead><tr><th></th><th>Коробочный бот</th><th>Кастомный AI под ключ</th></tr></thead>
          <tbody>
            <tr><td>Интеграция CRM</td><td>Шаблонная</td><td>Под ваши поля и этапы</td></tr>
            <tr><td>Площадки</td><td>1–2 канала</td><td>Авито + ЦИАН + Домклик + сайт</td></tr>
            <tr><td>Подбор объекта</td><td>FAQ</td><td>Поиск по фиду</td></tr>
            <tr><td>152-ФЗ / LLM</td><td>Часто не раскрыто</td><td>Российский контур</td></tr>
            <tr><td>Чек</td><td>от 15 000 ₽</td><td>200 тыс.–1,5 млн ₽</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- H2 #4 #vnedrenie -->
  <section class="aned-section aned-section-alt" id="vnedrenie">
    <div class="aned-cnt">
      <div class="aned-sh aned-left">
        <span class="aned-eyebrow">Под ключ</span>
        <h2>Внедрение AI для недвижимости под ключ</h2>
        <p>Аудит → проектирование → пилот → обучение → масштабирование. Не покупка «ещё одного SaaS».</p>
      </div>

      <div class="aned-card nero-ai-reveal">
        <div class="aned-timeline">
          <div class="aned-tl-item"><div class="aned-tl-dot"></div><h3>1. Аудит воронии</h3><p>Карта каналов → CRM → этапы → где теряются заявки (ночь, площадки, медленный ввод).</p></div>
          <div class="aned-tl-item"><div class="aned-tl-dot"></div><h3>2. Проектирование</h3><p>Матрица квалификации, база знаний, эскалация, LLM-контур (YandexGPT, GigaChat для ПДн).</p></div>
          <div class="aned-tl-item"><div class="aned-tl-dot"></div><h3>3. Пилот 2–4 недели</h3><p>Один канал (Telegram или Авито), QA на галлюцинации и юридику.</p></div>
          <div class="aned-tl-item"><div class="aned-tl-dot"></div><h3>4. Запуск и масштаб</h3><p>Обучение РОП и риелторов, остальные площадки, follow-up.</p></div>
        </div>
      </div>

      <div class="aned-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="aned-card">
          <h3>Под ключ или самостоятельно?</h3>
          <p>Зависит от интегратора в штате, числа каналов и требований к ПДн. Сборка на n8n + amoCRM возможна, но без эскалации и тестов — «бот ради бота».</p>
        </div>
        <div class="aned-card nero-ai-delay-1">
          <h3>Без программиста в штате</h3>
          <p>На эксплуатации риелторы работают в CRM. Слой webhooks, фидов и согласий закрывает команда внедрения Nero Network.</p>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie" style="margin-top:32px;">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с CRM. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
        </div>
      </aside>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-vnedrenie" style="margin-top:16px;">
        <div class="ym-cta-block__icon" aria-hidden="true">🤖</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Подключить AI к продажам недвижимости</p>
          <p class="ym-cta-block__sub">Начните с аудита воронии и пилота на одном канале: квалификация, подбор объектов, автозаполнение CRM и эскалация без смены чата. Ориентир пилота — 2–4 недели.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Подключить AI к продажам</a>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #5 #integracii -->
  <section class="aned-section" id="integracii">
    <div class="aned-cnt">
      <div class="aned-sh">
        <span class="aned-eyebrow">Интеграции</span>
        <h2>Интеграция AI с CRM и площадками недвижимости</h2>
        <p>Клиент остаётся в своей CRM; AI — слой первой линии и автозаполнения.</p>
      </div>

      <div class="aned-grid-2 nero-ai-reveal">
        <div class="aned-card">
          <h3>amoCRM, Битрикс24, CRM застройщика</h3>
          <p>Создание сделок, кастомные поля (бюджет, район, ипотека), смена этапов («Новый» → «Квалифицирован» → «Показ»), задачи риелтору с текстом диалога, теги источника.</p>
        </div>
        <div class="aned-card nero-ai-delay-1">
          <h3>Авито, ЦИАН, Домклик</h3>
          <p>По кейсу «Самолёт Плюс» ИИ отвечает в чатах классифайдов, собирает параметры и передаёт диалог риелтору без смены чата.</p>
        </div>
      </div>

      <div class="aned-card nero-ai-reveal" style="margin-top:28px;">
        <h3>152-ФЗ и передача данных</h3>
        <p>С 01.07.2025 ужесточены требования к ПДн (штрафы до 15 млн ₽). Паспорт, ЕГРН, ИНН — не в публичные зарубежные LLM; использовать <strong>YandexGPT, GigaChat</strong> или обезличивание. Тексты согласий в точках входа.</p>
      </div>
    </div>
  </section>

  <!-- H2 #6 #ceny -->
  <section class="aned-section aned-section-alt" id="ceny">
    <div class="aned-cnt">
      <div class="aned-sh">
        <span class="aned-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI для недвижимости и что входит в стоимость</h2>
      </div>

      <div class="aned-table-wrap nero-ai-reveal">
        <table class="aned-table">
          <thead><tr><th>Уровень</th><th>Ориентир</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Старт / пилот</td><td>200–400 тыс. ₽</td><td>1–2 канала, CRM, базовая квалификация</td></tr>
            <tr><td>Стандарт</td><td>400–800 тыс. ₽</td><td>Площадки + мессенджеры + подбор + follow-up</td></tr>
            <tr><td>Enterprise</td><td>800 тыс.–1,5 млн ₽</td><td>Несколько офисов, кастом CRM, аналитика, голос</td></tr>
          </tbody>
        </table>
      </div>

      <div class="aned-card nero-ai-reveal" style="margin-top:28px;">
        <h3>ROI: три рычага</h3>
        <ul>
          <li><strong>Время агентов:</strong> «Самолёт Плюс» — −50% на контент, +10 ч/нед на агента</li>
          <li><strong>Конверсия:</strong> +20% заявок до сделки (Самолёт Плюс); Agentforce CRE 3,4× квалифицированных лидов — <em>кейсы других компаний</em></li>
          <li><strong>Потери от медленного ответа:</strong> AI закрывает ночные и выходные без ночной смены</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- H2 #7 #keisy -->
  <section class="aned-section" id="keisy">
    <div class="aned-cnt">
      <div class="aned-sh">
        <span class="aned-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI в недвижимости</h2>
        <p>Публичные источники — не выдуманные цифры.</p>
      </div>

      <div class="aned-scenario nero-ai-reveal">
        <h3>«Самолёт Плюс», AI Plus</h3>
        <p>Пилот 2000+ агентов: контент −50%, заявки до сделки +20%, подбор объекта быстрее в 5–10 раз. ИИ в чатах Авито, ЦИАН, Домклик.</p>
      </div>
      <div class="aned-scenario nero-ai-reveal nero-ai-delay-1">
        <h3>Artsofte Digital — застройщики</h3>
        <p>Подбор по книге продаж и фиду; срок внедрения до 2 недель после передачи материалов.</p>
      </div>
      <div class="aned-scenario nero-ai-reveal nero-ai-delay-2">
        <h3>ГК ССК, Lead2Key</h3>
        <p>Мультиагентный анализ мотивов покупателя — продвинутый этап после базовой квалификации.</p>
      </div>

      <div class="aned-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aned-table">
          <thead><tr><th>Риск</th><th>Митигация</th></tr></thead>
          <tbody>
            <tr><td>Неверная цена/площадь</td><td>Только данные из фида; запрет «додумывать»</td></tr>
            <tr><td>Юридические советы</td><td>Эскалация на риелтора</td></tr>
            <tr><td>Недоверие к боту</td><td>Тихая эскалация без смены чата</td></tr>
            <tr><td>ПДн</td><td>Российский контур LLM, согласия</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- H2 #8 #biznes -->
  <section class="aned-section aned-section-alt" id="biznes">
    <div class="aned-cnt">
      <div class="aned-sh">
        <span class="aned-eyebrow">Сегменты</span>
        <h2>AI для малого и среднего бизнеса в недвижимости</h2>
      </div>
      <div class="aned-grid-2 nero-ai-reveal">
        <div class="aned-card">
          <h3>Небольшое агентство (3–15 агентов)</h3>
          <p>Один канал с макс. потоком (часто Авито или Telegram) + amoCRM/Битрикс24. Пилот 2–4 недели. Чек 200–400 тыс. ₽.</p>
        </div>
        <div class="aned-card nero-ai-delay-1">
          <h3>Сеть офисов и девелопер</h3>
          <p>Единая матрица квалификации, маршрутизация по району, дашборд воронии по каналам, речевая аналитика (опц.).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #9 #faq -->
  <section class="aned-section" id="faq">
    <div class="aned-cnt">
      <div class="aned-sh">
        <span class="aned-eyebrow">FAQ</span>
        <h2>Частые вопросы про AI для недвижимости</h2>
      </div>

      <div class="aned-faq nero-ai-reveal">
        <div class="aned-faq-item">
          <div class="aned-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI для недвижимости пошагово?</div>
          <div class="aned-faq-a">Аудит воронии → матрица квалификации → выбор LLM под 152-ФЗ → пилот на одном канале 2–4 недели → QA → масштабирование на площадки и follow-up.</div>
        </div>
        <div class="aned-faq-item">
          <div class="aned-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает запуск?</div>
          <div class="aned-faq-a">Пилот на одном канале — 2–4 недели. Полная связка «сайт + 3 площадки + CRM» — обычно 4–8 недель.</div>
        </div>
        <div class="aned-faq-item">
          <div class="aned-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли свой IT-отдел?</div>
          <div class="aned-faq-a">На эксплуатации — нет. Интеграцию закрывает команда Nero Network при формате под ключ.</div>
        </div>
        <div class="aned-faq-item">
          <div class="aned-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI риелторов?</div>
          <div class="aned-faq-a">Нет. AI — первая линия; показ, переговоры, торг и сделка — зона живого эксперта.</div>
        </div>
        <div class="aned-faq-item">
          <div class="aned-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли без программиста в штате?</div>
          <div class="aned-faq-a">Да, при заказе ai для недвижимости под ключ. Для CRM + площадок нужна проектная настройка.</div>
        </div>
        <div class="aned-faq-item">
          <div class="aned-faq-q" tabindex="0" role="button" aria-expanded="false">Как заказать консультацию и аудит воронии?</div>
          <div class="aned-faq-a">Оставьте заявку — проведём аудит, покажем схему интеграций и ориентир цены под ваши каналы.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #10 #podklyuchit -->
  <section class="aned-section aned-section-alt" id="podklyuchit">
    <div class="aned-cnt">
      <div class="aned-sh aned-left">
        <span class="aned-eyebrow">Следующий шаг</span>
        <h2>Подключить AI к продажам недвижимости</h2>
        <p>Не шаблонный чат-бот, а внедрение в вашу воронку: от заявки на Авито до задачи риелтору с готовой карточкой.</p>
      </div>
      <div class="aned-card nero-ai-reveal">
        <ul>
          <li>аудит воронии недвижимости (лид-магнит);</li>
          <li>план внедрения под CRM и площадки;</li>
          <li>пилот с измеримыми метриками;</li>
          <li>политика ПДн и эскалация «без смены чата»;</li>
          <li>обучение команды и масштабирование.</li>
        </ul>
        <p><strong>Ориентир:</strong> 200 тыс.–1,5 млн ₽ · пилот 2–4 недели.</p>
      </div>
    </div>
  </section>

  <!-- CTA-final + ad slot (из Артура) -->
  <div class="aned-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы убрать потери заявок в недвижимости?</p>
        <p class="ym-cta-block__sub">Следующий шаг — аудит воронии и план внедрения под amoCRM, Битрикс24, Авито, ЦИАН или Домклик.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Подключить AI к продажам</a>
          <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Частые вопросы</a>
        </div>
      </div>
    </div>
    <div class="aned-ad-slot" id="aned-ad-banner" aria-label="Рекламный баннер">
      <!-- AD_BANNER_* не настроены — блок не выводить -->
    </div>
  </div>

</div><!-- /.aned-content -->


<script>
/* FAQ accordion — вставить перед get_footer() вместе с reveal.js */
document.querySelectorAll('.aned-faq-q').forEach(function(btn){
  btn.addEventListener('click', function(){
    var item = btn.closest('.aned-faq-item');
    var open = item.classList.contains('open');
    document.querySelectorAll('.aned-faq-item.open').forEach(function(el){
      el.classList.remove('open');
      var q = el.querySelector('.aned-faq-q');
      if (q) q.setAttribute('aria-expanded','false');
    });
    if (!open){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
  });
});
</script>

<?php
$aned_page_url = trailingslashit( get_permalink() );
$aned_site_url = trailingslashit( home_url( '/' ) );
$aned_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$aned_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $aned_site_url . '#organization',
      'name'  => $aned_brand,
      'url'   => $aned_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $aned_site_url . '#website',
      'url'       => $aned_site_url,
      'name'      => $aned_brand,
      'publisher' => [ '@id' => $aned_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $aned_page_url . '#webpage',
      'url'         => $aned_page_url,
      'name'        => 'AI для недвижимости и риелторов: внедрение и настройка под ключ',
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $aned_site_url . '#website' ],
      'about'       => [ '@id' => $aned_site_url . '#organization' ],
    ],
    [
      '@type'           => 'BreadcrumbList',
      '@id'             => $aned_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $aned_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $aned_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $aned_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $aned_page_url,
      'provider'    => [ '@id' => $aned_site_url . '#organization' ],
    ],
    [
      '@type'      => 'FAQPage',
      '@id'        => $aned_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить AI для недвижимости пошагово?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит воронии → матрица квалификации → выбор LLM под 152-ФЗ → пилот на одном канале 2–4 недели → QA → масштабирование на площадки и follow-up.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько времени занимает запуск?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Пилот на одном канале — 2–4 недели. Полная связка «сайт + 3 площадки + CRM» — обычно 4–8 недель.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужен ли свой IT-отдел?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'На эксплуатации — нет. Интеграцию закрывает команда Nero Network при формате под ключ.' ] ],
        [ '@type' => 'Question', 'name' => 'Заменит ли AI риелторов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. AI — первая линия; показ, переговоры, торг и сделка — зона живого эксперта.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли без программиста в штате?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, при заказе ai для недвижимости под ключ. Для CRM + площадок нужна проектная настройка.' ] ],
        [ '@type' => 'Question', 'name' => 'Как заказать консультацию и аудит воронии?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Оставьте заявку — проведём аудит, покажем схему интеграций и ориентир цены под ваши каналы.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $aned_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
/**
 * aned-nedvizh-hero-engine — «Диспетчерская риелторского агентства»
 * LeadChannelStream → PropertyMatchHub → CrmDealCardEmitter + ShowingSlotCalendar
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aned-nedvizh-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, cx = 0, cy = 0, frame = 0;
  var bubbles = [];

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
    grid: "rgba(121,242,255,0.08)",
    avito: "#00aaff",
    cian: "#7c3aed",
    domklik: "#22c55e",
    card: "#1e293b",
    cardHi: "#334155",
    accent: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    amber: "#fbbf24",
    text: "#e2e8f0",
    muted: "#94a3b8",
    bubbleBg: "#0f172a"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, max: life });
  }

  /* Фон: сетка районов */
  function DistrictMapGrid() {}
  DistrictMapGrid.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    for (var gx = -160; gx <= 160; gx += 32) {
      ctx.strokeStyle = C.grid;
      ctx.lineWidth = 0.6;
      ctx.beginPath();
      ctx.moveTo(gx, -95);
      ctx.lineTo(gx, 75);
      ctx.stroke();
    }
    for (var gy = -90; gy <= 70; gy += 28) {
      ctx.beginPath();
      ctx.moveTo(-165, gy);
      ctx.lineTo(165, gy);
      ctx.stroke();
    }
    if (prg > 40 && prg < 120) {
      var pulse = Math.sin(frame * 0.08) * 0.15 + 0.35;
      ctx.fillStyle = "rgba(121,242,255," + pulse + ")";
      ctx.beginPath();
      ctx.arc(-45, -12, 22, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = C.accent;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Химки", -45, -10);
    }
  };

  /* Узлы платформ — Авито / ЦИАН */
  function PlatformIngestNode(x, y, label, color) {
    this.x = x; this.y = y; this.label = label; this.color = color;
  }
  PlatformIngestNode.prototype.draw = function (ctx) {
    drawRR(ctx, this.x - 28, this.y - 14, 56, 28, 6, "rgba(15,23,42,0.9)", this.color);
    ctx.fillStyle = this.color;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(this.label, this.x, this.y + 4);
  };

  /* Изогнутые потоки лидов — вместо Conveyor */
  function LeadChannelStream() {
    this.particles = [
      { path: 0, t: 0, color: C.avito },
      { path: 1, t: 40, color: C.cian },
      { path: 2, t: 80, color: C.domklik }
    ];
  }
  LeadChannelStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    var paths = [
      { x0: -150, y0: -70, cx1: -90, cy1: -20, x1: -20, y1: 5 },
      { x0: -150, y0: 10, cx1: -70, cy1: 25, x1: -15, y1: 15 },
      { x0: -150, y0: 55, cx1: -80, cy1: 40, x1: -10, y1: 28 }
    ];
    paths.forEach(function (p, idx) {
      ctx.strokeStyle = idx === 0 ? "rgba(0,170,255,0.35)" : idx === 1 ? "rgba(124,58,237,0.35)" : "rgba(34,197,94,0.35)";
      ctx.lineWidth = 2;
      ctx.setLineDash([4, 4]);
      ctx.beginPath();
      ctx.moveTo(p.x0, p.y0);
      ctx.quadraticCurveTo(p.cx1, p.cy1, p.x1, p.y1);
      ctx.stroke();
      ctx.setLineDash([]);
    });
    if (prg < 75) {
      this.particles.forEach(function (pt) {
        var path = paths[pt.path];
        var t = ((frame * 0.6 + pt.t) % 90) / 90;
        var mt = 1 - t;
        var px = mt * mt * path.x0 + 2 * mt * t * path.cx1 + t * t * path.x1;
        var py = mt * mt * path.y0 + 2 * mt * t * path.cy1 + t * t * path.y1;
        ctx.fillStyle = pt.color;
        ctx.beginPath();
        ctx.arc(px, py, 4, 0, Math.PI * 2);
        ctx.fill();
      });
    }
  };

  /* Центральная витрина объектов — вместо WebsiteTerminal */
  function PropertyMatchHub() {
    this.matchIdx = 0;
  }
  PropertyMatchHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    drawRR(ctx, 25, -55, 110, 95, 10, C.card, "rgba(255,255,255,0.12)");
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Подбор объектов", 32, -42);

    var cards = [
      { label: "2к · 62м²", price: "11.8M", y: -28 },
      { label: "3к · 78м²", price: "14.2M", y: -8 },
      { label: "2к · 55м²", price: "10.5M", y: 12 }
    ];
    cards.forEach(function (c, i) {
      var show = prg > 130 + i * 18;
      if (!show) return;
      var hi = prg > 175 && i === 1;
      drawRR(ctx, 32, c.y - 10, 96, 22, 5, hi ? "rgba(121,242,255,0.18)" : "rgba(255,255,255,0.06)", hi ? C.accent : C.muted);
      ctx.fillStyle = hi ? C.accent : C.text;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(c.label + " · " + c.price, 38, c.y + 2);
      if (hi && prg > 185) {
        ctx.fillStyle = C.green;
        ctx.fillText("✓ match", 100, c.y + 2);
      }
    });

    if (prg > 200 && prg < 248) {
      var ring = (prg - 200) / 48;
      ctx.strokeStyle = "rgba(139,92,246," + (0.5 - ring * 0.4) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(80, 0, 38 + ring * 12, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* Слот показа */
  function ShowingSlotCalendar() {}
  ShowingSlotCalendar.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    drawRR(ctx, 118, -72, 52, 58, 6, "rgba(15,23,42,0.85)", C.muted);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Показ", 154, -58);
    if (prg > 205) {
      drawRR(ctx, 124, -48, 40, 14, 3, prg > 215 ? "rgba(34,197,94,0.25)" : "rgba(255,255,255,0.06)", C.green);
      ctx.fillStyle = prg > 215 ? "#bbf7d0" : C.muted;
      ctx.fillText("18:00", 154, -37);
    }
    if (prg > 220) {
      ctx.fillStyle = C.amber;
      ctx.fillText("забронирован", 154, -22);
    }
  };

  /* Карточка CRM — финал цикла */
  function CrmDealCardEmitter() {}
  CrmDealCardEmitter.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    if (prg < 210) return;
    var slide = Math.min(1, (prg - 210) / 20);
    ctx.save();
    ctx.translate(0, 55 - slide * 8);
    ctx.globalAlpha = slide;
    drawRR(ctx, 20, 38, 118, 32, 6, "rgba(34,197,94,0.2)", C.green);
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM · квалифицирован · задача риелтору", 79, 58);
    ctx.restore();
  };

  var platformNodes = [
    new PlatformIngestNode(-150, -56, "Авито", C.avito),
    new PlatformIngestNode(-150, 8, "ЦИАН", C.cian),
    new PlatformIngestNode(-150, 52, "Домклик", C.domklik)
  ];
  var districtMap = new DistrictMapGrid();
  var leadStream = new LeadChannelStream();
  var matchHub = new PropertyMatchHub();
  var showingSlot = new ShowingSlotCalendar();
  var crmEmitter = new CrmDealCardEmitter();

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var prg = (frame * 0.04) % 260;
    var targets = {
      "1_architect": { x: -55, y: -35 },
      "2_seo": { x: -35, y: 45 },
      "3_coder": { x: 15, y: 50 },
      "4_designer": { x: 55, y: 35 },
      "5_deployer": { x: 95, y: 48 }
    };
    var tgt = targets[this.role] || { x: 0, y: 40 };
    var isMoving = false;
    var faceDir = 1;

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 16) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 16) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 16) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y, 5, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = C.text;
    ctx.beginPath();
    ctx.arc(this.x + faceDir * 3, this.y - 1, 2.5, 0, Math.PI * 2);
    ctx.fill();
    if (isMoving) {
      ctx.strokeStyle = this.color;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.moveTo(this.x - 4, this.y + 6);
      ctx.lineTo(this.x + 4, this.y + 6);
      ctx.stroke();
    }
  };

  var agents = [
    new Agent(-95, 68, C.amber, "1_architect", 48, ["Район: северо-запад", "Отметил Химки на карте", "Клиент ищет у метро"]),
    new Agent(-55, 72, C.accent, "2_seo", 72, ["Бюджет 12 млн?", "Ипотека или наличные?", "Срок сделки — 2 месяца"]),
    new Agent(-10, 74, C.violet, "3_coder", 98, ["Сопоставил с фидом", "3 объекта по параметрам", "Площадь и этаж из CRM"]),
    new Agent(40, 72, "#ec4899", "4_designer", 125, ["Подборка на витрине", "Вид из окна — ок", "Фото из базы, не AI"]),
    new Agent(85, 70, C.green, "5_deployer", 215, ["Задача риелтору в TG", "Показ 18:00 в календарь", "Карточка amoCRM готова"])
  ];

  if (frame === 75) createBubble(-30, -20, "Лид с Авито · ответ <1 мин", 240);
  if (frame === 140) createBubble(50, -10, "Match: 3к · 78м² · 14.2M", 240);
  if (frame === 218) createBubble(90, 40, "Эскалация без смены чата", 240);
  if (frame === 235) createBubble(75, 55, "Риелтор получил резюме", 240);

  function drawBubbles(ctx) {
    bubbles = bubbles.filter(function (b) {
      b.life--;
      if (b.life <= 0) return false;
      var a = b.life / b.max;
      ctx.globalAlpha = a;
      ctx.fillStyle = C.bubbleBg;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 18, tw, 16, 4, C.bubbleBg, C.accent);
      ctx.fillStyle = C.text;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 6);
      ctx.globalAlpha = 1;
      return true;
    });
  }

  function loop() {
    frame++;
    ctx.save();
    ctx.translate(cx, cy);
    ctx.clearRect(-cx, -cy, cw, ch);
    districtMap.draw(ctx);
    platformNodes.forEach(function (n) { n.draw(ctx); });
    leadStream.draw(ctx);
    matchHub.draw(ctx);
    showingSlot.draw(ctx);
    crmEmitter.draw(ctx);
    agents.forEach(function (a) { a.draw(ctx); });
    drawBubbles(ctx);
    ctx.restore();
    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);

  document.querySelectorAll(".aned-hero-nedvizh .nero-ai-reveal").forEach(function (el) {
    el.classList.add("nero-ai-active");
  });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  if (!('IntersectionObserver' in window)) {
    document.querySelectorAll('.aned-content .nero-ai-reveal').forEach(function (el) { el.classList.add('nero-ai-active'); });
    return;
  }
  var obs = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) { entry.target.classList.add('nero-ai-active'); obs.unobserve(entry.target); }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.aned-content .nero-ai-reveal').forEach(function (el) { obs.observe(el); });
});
</script>
<?php get_footer(); ?>

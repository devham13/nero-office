<?php
/**
 * Template Name: Интеграция AI с 1С и ERP: отчёты, поиск и подсказки
 * Description: SEO-лендинг — conversational analytics поверх 1С/ERP: NL-отчёты, поиск, read-only пилот.
 */

$page_seo_title       = 'Интеграция AI с 1С и ERP: отчёты, поиск и подсказки';
$page_seo_description = 'Подключим AI к 1С и ERP: отчёты на естественном языке, поиск по базе и подсказки без ручных выгрузок. Для производства, торговли, склада и бухгалтерии.';

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
    ['label' => 'Зачем AI', 'href' => '#zachem-ai'],
    ['label' => 'Отчёты', 'href' => '#otchety'],
    ['label' => 'Поиск', 'href' => '#poisk'],
    ['label' => 'Архитектура', 'href' => '#arhitektura'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Цена', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Оценить интеграцию с 1С';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#zachem-ai';

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
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

.a1r-content{
  --a1r-bg:#050711;--a1r-bg2:#080b17;
  --a1r-surface:rgba(255,255,255,.072);--a1r-text:#e6edf7;--a1r-muted:#9aa8bd;--a1r-soft:#c7d2e5;--a1r-heading:#fff;
  --a1r-border:rgba(255,255,255,.10);
  --a1r-accent:#f5c518;--a1r-violet:#8b5cf6;--a1r-green:#22c55e;--a1r-cyan:#79f2ff;
  --a1r-btn-from:#2563eb;--a1r-btn-to:#7c3aed;
  --a1r-r:18px;--a1r-r-lg:24px;--a1r-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--a1r-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.a1r-content *,.a1r-content *::before,.a1r-content *::after{box-sizing:border-box;}
.a1r-content a{color:inherit;}
.a1r-content p{color:var(--a1r-muted);line-height:1.72;margin:0 0 1em;}
.a1r-content h2,.a1r-content h3{color:var(--a1r-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.a1r-content strong{color:var(--a1r-soft);}
.a1r-content ul,.a1r-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.a1r-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--a1r-muted);font-size:14.5px;line-height:1.65;}
.a1r-content ul li::before{content:'›';position:absolute;left:0;color:var(--a1r-accent);font-weight:700;}
.a1r-flow-list{counter-reset:a1rflow;}
.a1r-flow-list li{counter-increment:a1rflow;padding-left:28px;}
.a1r-flow-list li::before{content:counter(a1rflow);width:20px;height:20px;border-radius:50%;background:rgba(121,242,255,.15);color:var(--a1r-cyan);font-size:11px;font-weight:800;display:inline-flex;align-items:center;justify-content:center;position:absolute;left:0;top:2px;}
.a1r-cnt{width:min(var(--a1r-container),calc(100% - 40px));margin:0 auto;}
.a1r-section{padding:clamp(64px,8vw,112px) 0;}
.a1r-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.a1r-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.a1r-sh.a1r-left{margin-left:0;text-align:left;}
.a1r-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.a1r-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.a1r-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--a1r-accent);margin-bottom:14px;}
.a1r-intro{padding:clamp(40px,5vw,72px) 0;}
.a1r-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.a1r-intro-text{position:relative;padding-left:20px;}
.a1r-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--a1r-accent),var(--a1r-violet));}
.a1r-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.a1r-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.a1r-kpi-card .kv{font-size:clamp(18px,2.2vw,24px);font-weight:900;color:var(--a1r-heading);}
.a1r-kpi-card .kl{font-size:11px;color:var(--a1r-muted);}
.a1r-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
.a1r-toc-outer{padding:0 0 48px;}
.a1r-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.a1r-toc a{display:inline-block;padding:9px 18px;background:var(--a1r-surface);border:1px solid var(--a1r-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--a1r-muted);text-decoration:none;}
.a1r-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--a1r-accent);}
.a1r-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--a1r-border);border-radius:var(--a1r-r-lg);padding:26px;backdrop-filter:blur(16px);}
.a1r-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.a1r-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.a1r-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.a1r-table{width:100%;border-collapse:collapse;font-size:14px;}
.a1r-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--a1r-accent);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);}
.a1r-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--a1r-text);vertical-align:top;}
.a1r-timeline{position:relative;padding-left:40px;}
.a1r-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--a1r-accent),var(--a1r-violet));opacity:.35;}
.a1r-tl-item{position:relative;margin-bottom:32px;}
.a1r-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--a1r-accent);}
.a1r-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.a1r-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.a1r-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--a1r-heading);cursor:pointer;}
.a1r-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease;}
.a1r-faq-item.open .a1r-faq-a{max-height:800px;padding:0 24px 20px;}
@media(max-width:900px){.a1r-intro-grid,.a1r-grid-2,.a1r-grid-3{grid-template-columns:1fr;}}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--a1r-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--a1r-btn-from),var(--a1r-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-link--accent{color:var(--a1r-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.a1r-faq-q{cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.a1r-faq-q::after{content:'▾';font-size:13px;color:var(--a1r-accent);flex-shrink:0;transition:transform .25s;}
.a1r-faq-item.open .a1r-faq-q::after{transform:rotate(180deg);}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-otchety-poisk-1c-erp-page" role="main" tabindex="-1">

<section class="nero-ai-hero a1c-hero-reports" id="a1c-hero-reports" aria-labelledby="a1c-hero-reports-title">
<style>
/* ── Hero ai-otchety-poisk-1c-erp: самодостаточные стили ── */
.a1c-hero-reports {
  --a1c-gold: #f5c518;
  --a1c-erp-red: #d71920;
  --a1c-cyan: #79f2ff;
  --a1c-cyan-dim: #38bdf8;
  --a1c-green: #22c55e;
  --a1c-violet: #8b5cf6;
  --a1c-text: #e6edf7;
  --a1c-muted: #9aa8bd;
  --a1c-soft: #c7d2e5;
  --a1c-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.a1c-hero-reports::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 62% 32%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.a1c-hero-reports::after {
  content: "";
  position: absolute;
  left: 6%;
  top: 14%;
  width: 580px;
  height: 580px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .12), transparent 66%);
  filter: blur(8px);
  animation: a1cReportsGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes a1cReportsGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.a1c-hero-reports .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.a1c-hero-reports .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.a1c-hero-reports .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.a1c-hero-reports .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--a1c-cyan) 38%, var(--a1c-gold) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.a1c-hero-reports .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.28);
  border-radius: 999px;
  background: rgba(56, 189, 248, 0.1);
  color: var(--a1c-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.a1c-hero-reports .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--a1c-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.a1c-hero-reports .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.a1c-hero-reports .nero-ai-badge {
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
.a1c-hero-reports .nero-ai-badge--green {
  border-color: rgba(34,197,94,.35);
  background: rgba(34,197,94,.08);
  color: #bbf7d0;
}
.a1c-hero-reports .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.a1c-hero-reports .nero-ai-btn {
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
.a1c-hero-reports .nero-ai-btn:hover { transform: translateY(-2px); }
.a1c-hero-reports .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--a1c-cyan), #38bdf8);
  box-shadow: 0 18px 42px rgba(56, 189, 248, 0.28);
}
.a1c-hero-reports .nero-ai-btn-secondary {
  color: var(--a1c-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.a1c-hero-reports .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--a1c-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.a1c-hero-reports .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.a1c-hero-reports .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.a1c-hero-reports .nero-ai-dots { display: flex; gap: 7px; }
.a1c-hero-reports .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.a1c-hero-reports .nero-ai-dot:nth-child(1) { background: #38bdf8; }
.a1c-hero-reports .nero-ai-dot:nth-child(2) { background: #f5c518; }
.a1c-hero-reports .nero-ai-dot:nth-child(3) { background: #22c55e; }
.a1c-hero-reports .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.a1c-hero-reports .nero-ai-window-body { padding: 16px; }
.a1c-hero-reports .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.a1c-hero-reports .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.a1c-hero-reports .nero-ai-live-pill {
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
.a1c-hero-reports .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: a1cReportsPulse 1.6s infinite;
}
@keyframes a1cReportsPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.a1c-hero-reports .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.a1c-hero-reports .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.a1c-hero-reports .nero-ai-metric span {
  display: block;
  color: var(--a1c-muted);
  font-size: 11px;
  font-weight: 700;
}
.a1c-hero-reports .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.a1c-hero-reports .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.a1c-hero-reports .a1c-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(56, 189, 248, 0.22);
  background: radial-gradient(ellipse at 28% 42%, rgba(56,189,248,.09), rgba(6,10,24,.94) 72%);
}
.a1c-hero-reports #ai1c-reports-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.a1c-hero-reports .nero-ai-task-stream { display: grid; gap: 8px; }
.a1c-hero-reports .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.a1c-hero-reports .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(56,189,248,.14);
  color: var(--a1c-cyan);
  font-size: 11px;
  font-weight: 800;
}
.a1c-hero-reports .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.a1c-hero-reports .nero-ai-task span {
  color: var(--a1c-muted);
  font-size: 11px;
}
.a1c-hero-reports .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
@media (max-width: 1100px) {
  .a1c-hero-reports .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .a1c-hero-reports .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .a1c-hero-reports .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .a1c-hero-reports .nero-ai-window-body { padding: 12px; }
  .a1c-hero-reports .nero-ai-task { grid-template-columns: 28px 1fr; }
  .a1c-hero-reports .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">1С / ERP · conversational analytics</p>
      <h1 id="a1c-hero-reports-title">Интеграция AI с 1С и ERP: <span class="nero-ai-gradient-text">отчёты, поиск и подсказки под ключ</span></h1>
      <p class="nero-ai-hero-lead">Сотрудники спрашивают 1С на естественном языке — AI собирает отчёты, находит данные в ERP и отвечает без ручных выгрузок</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">NL-отчёты</li>
        <li class="nero-ai-badge">Поиск по ERP</li>
        <li class="nero-ai-badge nero-ai-badge--green">Read-only</li>
        <li class="nero-ai-badge">OData / MCP</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#zachem-ai">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация conversational AI поверх 1С/ERP">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Conversational AI → 1С/ERP</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>NL-запросов сегодня</span>
              <strong>847</strong>
              <small>отчёты и поиск</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ответ из 1С</span>
              <strong>100%</strong>
              <small>returnDirect</small>
            </div>
            <div class="nero-ai-metric">
              <span>Среднее время</span>
              <strong>2.4 сек</strong>
              <small>вопрос → таблица</small>
            </div>
            <div class="nero-ai-metric">
              <span>Запросов в аудите</span>
              <strong>847</strong>
              <small>журнал RBAC</small>
            </div>
          </div>

          <div class="a1c-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ai1c-reports-hero-canvas" role="img" aria-label="Анимация: NL-вопрос проходит read-only шлюз и возвращает таблицу из 1С с записью в аудит"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента NL-запросов к ERP">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ДБ</span>
              <div><strong>Дебиторка топ-10</strong><span>Март · просрочка · контрагенты</span></div>
              <span class="nero-ai-status">из 1С</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ОС</span>
              <div><strong>Остатки по складу</strong><span>Группа X · все склады · сегодня</span></div>
              <span class="nero-ai-status">из 1С</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">P&L</span>
              <div><strong>P&L по направлению</strong><span>Квартал · управленческий отчёт</span></div>
              <span class="nero-ai-status">из 1С</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * ai1c-reports-hero-engine — «Диспетчерская NL-аналитики 1С»
 * Мир: NL-чат → read-only шлюз → регистры ERP → таблица returnDirect → аудит
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ai1c-reports-hero-canvas");
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
    scale = Math.min(cw / 420, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    chatBg: "#0f172a",
    chatUser: "#1e3a5f",
    chatAi: "rgba(56,189,248,0.22)",
    cyan: "#38bdf8",
    cyanGlow: "rgba(121,242,255,0.45)",
    gold: "#f5c518",
    erpRed: "#d71920",
    erpBase: "#1e293b",
    green: "#22c55e",
    violet: "#8b5cf6",
    tableRow: "rgba(255,255,255,0.08)",
    packetA: "#7dd3fc",
    packetB: "#fde68a",
    packetC: "#a7f3d0",
    shield: "rgba(34,197,94,0.35)",
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

  /* NL-чат консоль — центральный объект */
  function NlQueryConsole() {
    this.typed = 0;
    this.fullQ = "Покажи дебиторку топ-10 за март";
  }
  NlQueryConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 280;
    var wx = -118, wy = -72, ww = 118, wh = 88;
    drawRR(ctx, wx, wy, ww, wh, 8, C.chatBg, C.outline);
    drawRR(ctx, wx + 4, wy + 4, ww - 8, 14, [5, 5, 0, 0], C.erpRed, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("NL · 1С", wx + 10, wy + 14);

    if (prg < 75) {
      var chars = Math.floor((prg / 75) * this.fullQ.length);
      this.typed = chars;
      drawRR(ctx, wx + 8, wy + 26, ww - 16, 22, 5, C.chatUser, C.cyan);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(this.fullQ.slice(0, chars), wx + 12, wy + 40);
      if (prg > 8 && frame % 14 < 7) {
        ctx.fillStyle = C.cyan;
        ctx.fillRect(wx + 12 + ctx.measureText(this.fullQ.slice(0, chars)).width + 2, wy + 32, 2, 10);
      }
    } else {
      drawRR(ctx, wx + 8, wy + 26, ww - 16, 22, 5, C.chatUser, C.outline);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(this.fullQ, wx + 12, wy + 40);
      if (prg > 78) {
        drawRR(ctx, wx + 8, wy + 54, ww - 16, 18, 5, C.chatAi, C.cyan);
        ctx.fillStyle = C.cyan;
        ctx.fillText("Intent: дебиторка · март", wx + 12, wy + 66);
      }
    }
  };

  /* Горизонтальный поток метрик — вместо конвейера */
  function MetricDataRiver() {
    this.packets = [
      { label: "Σ", color: C.packetA, offset: 0 },
      { label: "Δ", color: C.packetB, offset: 55 },
      { label: "#", color: C.packetC, offset: 110 },
      { label: "62", color: C.packetA, offset: 165 }
    ];
  }
  MetricDataRiver.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 280;
    if (prg < 70 || prg > 200) return;
    var alpha = prg < 90 ? (prg - 70) / 20 : prg > 185 ? 1 - (prg - 185) / 15 : 1;
    ctx.globalAlpha = alpha;
    ctx.strokeStyle = "rgba(56,189,248,0.25)";
    ctx.lineWidth = 2;
    ctx.setLineDash([4, 4]);
    ctx.beginPath();
    ctx.moveTo(-40, 8);
    ctx.quadraticCurveTo(20, -18, 75, 8);
    ctx.stroke();
    ctx.setLineDash([]);

    this.packets.forEach(function (p) {
      var t = ((frame * 0.55 + p.offset) % 100) / 100;
      var px = -50 + t * 130;
      var py = 8 + Math.sin(t * Math.PI) * -12;
      drawRR(ctx, px - 10, py - 8, 20, 16, 4, p.color, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(p.label, px, py + 2);
    });
    ctx.globalAlpha = 1;
  };

  /* Read-only шлюз с щитом */
  function ReadOnlyShieldGate() {
    this.pulse = 0;
  }
  ReadOnlyShieldGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 280;
    if (prg < 65 || prg > 210) return;
    this.pulse = 0.5 + Math.sin(frame * 0.1) * 0.25;
    var gx = 42, gy = -8;
    ctx.save();
    ctx.globalAlpha = 0.35 + this.pulse * 0.4;
    ctx.fillStyle = C.shield;
    ctx.beginPath();
    ctx.moveTo(gx, gy - 28);
    ctx.lineTo(gx + 22, gy - 18);
    ctx.lineTo(gx + 22, gy + 6);
    ctx.quadraticCurveTo(gx + 22, gy + 28, gx, gy + 36);
    ctx.quadraticCurveTo(gx - 22, gy + 28, gx - 22, gy + 6);
    ctx.lineTo(gx - 22, gy - 18);
    ctx.closePath();
    ctx.fill();
    ctx.strokeStyle = C.green;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.restore();
    ctx.fillStyle = C.green;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("READ", gx, gy + 2);
    ctx.fillStyle = "#94a3b8";
    ctx.fillText("ONLY", gx, gy + 10);
    if (prg > 95) {
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("OData", gx, gy + 48);
    }
  };

  /* Семантический глоссарий — орбита синонимов */
  function SemanticGlossaryOrb() {
    this.angle = 0;
  }
  SemanticGlossaryOrb.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 280;
    if (prg < 40 || prg > 160) return;
    var ox = -55, oy = 42;
    this.angle += 0.04;
    drawRR(ctx, ox - 14, oy - 14, 28, 28, 14, "rgba(139,92,246,0.2)", C.violet);
    var tags = ["деб.", "62", "ОСВ"];
    tags.forEach(function (t, i) {
      var a = this.angle + i * 2.1;
      var tx = ox + Math.cos(a) * 22;
      var ty = oy + Math.sin(a) * 14;
      drawRR(ctx, tx - 14, ty - 6, 28, 12, 3, "rgba(139,92,246,0.35)", C.violet);
      ctx.fillStyle = "#e9d5ff";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(t, tx, ty + 3);
    }, this);
  };

  /* Хаб регистров ERP */
  function ErpRegisterHub() {
    this.flash = 0;
  }
  ErpRegisterHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 280;
    var hx = 108, hy = -58;
    for (var s = 0; s < 3; s++) {
      drawRR(ctx, hx, hy + s * 22, 52, 20, 4, C.erpBase, C.outline);
      if (prg > 130 + s * 12) {
        ctx.fillStyle = "rgba(255,255,255,0.12)";
        ctx.fillRect(hx + 6, hy + s * 22 + 8, 28 + s * 8, 3);
      }
    }
    drawRR(ctx, hx, hy - 8, 52, 10, [4, 4, 0, 0], C.erpRed, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("1С ERP", hx + 26, hy - 1);
    if (prg > 145) {
      this.flash = Math.min(1, (prg - 145) / 20);
      ctx.strokeStyle = "rgba(56,189,248," + (this.flash * 0.8) + ")";
      ctx.lineWidth = 2;
      ctx.strokeRect(hx - 2, hy - 10, 56, 78);
    }
  };

  /* Таблица returnDirect */
  function ReturnDirectTable() {
    this.rows = ["ООО Альфа", "2.4 млн", "12 дн.", "из 1С"];
  }
  ReturnDirectTable.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 280;
    if (prg < 140) return;
    var tx = 72, ty = 18, tw = 108, th = 72;
    drawRR(ctx, tx, ty, tw, th, 6, "rgba(15,23,42,0.85)", C.cyan);
    var headers = ["Клиент", "Сумма", "Дней"];
    headers.forEach(function (h, i) {
      ctx.fillStyle = C.gold;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(h, tx + 8 + i * 34, ty + 12);
    });
    for (var r = 0; r < 3; r++) {
      if (prg > 150 + r * 14) {
        drawRR(ctx, tx + 4, ty + 16 + r * 16, tw - 8, 12, 2, C.tableRow, null);
        ctx.fillStyle = "#e2e8f0";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.fillText(this.rows[r] || "—", tx + 8, ty + 26 + r * 16);
      }
    }
    if (prg > 195) {
      var stamp = Math.min(1, (prg - 195) / 15);
      ctx.save();
      ctx.globalAlpha = stamp;
      drawRR(ctx, tx + tw - 44, ty + th - 22, 38, 14, 3, "rgba(34,197,94,0.25)", C.green);
      ctx.fillStyle = C.green;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("из 1С", tx + tw - 26, ty + th - 12);
      ctx.restore();
    }
  };

  /* Журнал аудита — тикер внизу */
  function AuditTrailTicker() {
    this.offset = 0;
  }
  AuditTrailTicker.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 280;
    if (prg < 210) return;
    this.offset = (frame * 0.8) % 180;
    drawRR(ctx, -165, 58, 330, 22, 5, "rgba(34,197,94,0.12)", C.green);
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    var line = "audit · user:fd@co · query:дебиторка · rows:10 · read-only · " + Math.floor(frame / 30);
    ctx.fillText(line, -165 + 8 - this.offset, 72);
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
    var prg = (frame * 0.034) % 280;
    var isMoving = false;
    var targets = {
      "1_architect": { x: -90, y: 52 },
      "2_seo": { x: -45, y: 58 },
      "3_coder": { x: 35, y: 52 },
      "4_designer": { x: 95, y: 48 },
      "5_deployer": { x: 0, y: 68 }
    };
    var tgt = targets[this.role] || { x: 0, y: 55 };

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
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 16) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 16) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.1;
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
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new NlQueryConsole());
  entities.push(new MetricDataRiver());
  entities.push(new SemanticGlossaryOrb());
  entities.push(new ReadOnlyShieldGate());
  entities.push(new ErpRegisterHub());
  entities.push(new ReturnDirectTable());
  entities.push(new AuditTrailTicker());
  entities.push(new Agent(-125, 92, C.agentYellow, "1_architect", 18, [
    "дебиторка → регистр 62", "глоссарий метрик", "семантический слой"
  ]));
  entities.push(new Agent(-70, 98, C.agentGreen, "2_seo", 58, [
    "intent: дебиторка март", "фильтр топ-10", "синонимы в RAG"
  ]));
  entities.push(new Agent(-15, 100, C.agentBlue, "3_coder", 108, [
    "OData GET read-only", "returnDirect=true", "MCP describe → query"
  ]));
  entities.push(new Agent(60, 96, C.agentPink, "4_designer", 158, [
    "таблица без пересказа", "цифры как в 1С", "формат для директора"
  ]));
  entities.push(new Agent(125, 90, C.agentPurple, "5_deployer", 218, [
    "журнал аудита RBAC", "пилот на копии базы", "152-ФЗ on-prem"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.034) % 280;
    if (prg >= 12 && prg < 12.05) createBubble(-100, -55, "1. Вопрос на языке");
    if (prg >= 72 && prg < 72.05) createBubble(-40, -20, "2. Intent + RAG");
    if (prg >= 118 && prg < 118.05) createBubble(42, -5, "3. Read-only шлюз");
    if (prg >= 168 && prg < 168.05) createBubble(110, 30, "4. Таблица из 1С");
    if (prg >= 228 && prg < 228.05) createBubble(0, 75, "5. Журнал аудита");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.cyan);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
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

<div class="a1r-content">

  <section class="a1r-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="a1r-cnt">
      <div class="a1r-intro-grid nero-ai-reveal">
        <div class="a1r-intro-text">
          <p class="a1r-eyebrow">Лонгрид · ai 1с erp</p>
          <p><strong>Коротко:</strong> интеграция AI с 1С и ERP — это слой conversational analytics поверх уже работающей учётной системы. Сотрудник задаёт вопрос на естественном языке, а AI формирует контролируемый запрос к базе и возвращает отчёт, остаток или сводку — без выгрузки в Excel и без очереди к программисту.</p>
          <p>Данные в компании уже живут в 1С:УТ, 1С:БП, 1С:ERP, SAP или Microsoft Dynamics. Но ответы на операционные вопросы по-прежнему собирают вручную. По оценке ЦБ РФ (мониторинг, июнь 2026), каждое седьмое предприятие в России уже применяет ИИ. Расходы бизнеса на искусственный интеллект в 2025 году достигли <strong>257 млрд ₽</strong> (TAdviser, Data Fusion).</p>
        </div>
        <div class="a1r-intro-kpi" aria-label="Ключевые метрики">
          <div class="a1r-kpi-card"><div class="kv">1 из 7</div><div class="kl">компаний уже с ИИ</div><div class="ks">ЦБ РФ, 2026</div></div>
          <div class="a1r-kpi-card"><div class="kv">257 млрд ₽</div><div class="kl">расходы бизнеса на ИИ</div><div class="ks">TAdviser, 2025</div></div>
          <div class="a1r-kpi-card"><div class="kv">500 тыс.+</div><div class="kl">старт пилота read-only</div><div class="ks">Nero Network</div></div>
          <div class="a1r-kpi-card"><div class="kv">4–8 нед.</div><div class="kl">до первого сценария</div><div class="ks">типовой пилот</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="a1r-toc-outer">
    <div class="a1r-cnt">
      <nav class="a1r-toc" aria-label="Оглавление статьи">
        <a href="#zachem-ai">Зачем AI</a>
        <a href="#otchety">Отчёты</a>
        <a href="#poisk">Поиск</a>
        <a href="#arhitektura">Архитектура</a>
        <a href="#etapy">Внедрение</a>
        <a href="#stoimost">Цена</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- H2 #1 -->
  <section class="a1r-section" id="zachem-ai">
    <div class="a1r-cnt">
      <div class="a1r-sh">
        <span class="a1r-eyebrow">Зачем бизнесу</span>
        <h2>Зачем подключать AI к 1С и ERP</h2>
        <p>Данные живут в ERP, но отчёты и ответы сотрудники получают вручную — conversational AI закрывает разрыв без замены учётной системы.</p>
      </div>

      <div class="a1r-grid-3 nero-ai-reveal">
        <div class="a1r-card" id="kogda-net-otvetov">
          <h3>Когда данные есть, а ответы — нет</h3>
          <p>ERP настроена, регистры заполнены — но доступ к отчётам требует навыков 1С или времени разработчика. Руководитель ждёт дебиторку два дня; склад ищет номенклатуру в десятках справочников.</p>
          <p>В типовой 1С нет штатного режима «спросил — получил отчёт» на естественном языке (SlavVer, 2026). РПД, прогноз, речь, Напарник решают другие задачи.</p>
        </div>
        <div class="a1r-card nero-ai-delay-1" id="chto-menyaetsya">
          <h3>Что меняется после интеграции</h3>
          <p>Сотрудник формулирует вопрос в Telegram, веб-чате или Teams. Система классифицирует намерение, обращается к read-only шлюзу, получает цифры напрямую из ERP и возвращает таблицу или краткий комментарий.</p>
          <p>Мировой рынок ERP движется к формуле «chatbots explain, agents execute» (Bruno Digital, 2026): SAP Joule, D365 ERP MCP (GA январь 2026), NetSuite Ask Oracle — для 1С аналог создаётся интеграцией под ключ.</p>
        </div>
        <div class="a1r-card nero-ai-delay-2">
          <h3>AI для бизнеса в 2026</h3>
          <p>Внедрение AI в бизнес-процессы — вопрос скорости решений, не эксперимента. AI-агенты должны безопасно извлекать информацию из CRM, HR и финансовых баз с контролируемым доступом.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #2 -->
  <section class="a1r-section a1r-section-alt" id="otchety">
    <div class="a1r-cnt">
      <div class="a1r-sh">
        <span class="a1r-eyebrow">NL-отчёты</span>
        <h2>Отчёты из 1С и ERP на естественном языке</h2>
        <p>AI-отчёты из 1С — центральный сценарий: conversational AI переводит вопрос в детерминированный запрос к учётной системе без ручных выгрузок.</p>
      </div>

      <div class="a1r-card nero-ai-reveal" style="margin-bottom:28px;">
        <p>Платформа ИИ ПРОсковья (1С ПРО Консалтинг, реестр российского ПО) — зрелый референс NL-отчётности. В сети «Конкор Оптика» ИИ-ассистент по складским запасам помог увеличить годовую выручку на <strong>25%</strong> (dsmedia.pro, Бизнес-форум 1С:ERP). Это аналитика поверх живых данных ERP, не OCR.</p>
      </div>

      <div class="a1r-grid-2 nero-ai-reveal" id="ostatki-debitorka">
        <div class="a1r-card">
          <h3>Остатки, дебиторка, P&amp;L и сводки без выгрузок</h3>
          <ul>
            <li>«Покажи остатки по группе X на всех складах на сегодня»</li>
            <li>«Топ-10 клиентов по просроченной дебиторке за квартал»</li>
            <li>«Выручка по менеджерам за март в сравнении с февралём»</li>
            <li>«ОСВ по счёту 62 с расшифровкой по контрагентам»</li>
            <li>«Себестоимость выпуска по номенклатуре за прошлую неделю»</li>
          </ul>
          <p>Ключевой принцип — паттерн <strong>returnDirect</strong>: цифры из 1С возвращаются напрямую, LLM не пересказывает суммы. «ИИ — отличный диспетчер, но ужасный секретарь-референт» (Habr).</p>
        </div>
        <div class="a1r-card nero-ai-delay-1" id="kesh-otchetov">
          <h3>Кэш отчётов и типовые NL-запросы</h3>
          <p>Частые запросы — остатки на утро, дебиторка, выручка за вчера — кэшируются по расписанию. Утренний дайджест в Telegram эволюционирует в полноценный NL-интерфейс: сначала фиксированные сводки, затем свободный вопрос к той же базе.</p>
          <p>Nero Network на пилоте фиксирует 10–20 эталонных вопросов и строит семантический слой метрик — чтобы «выручка» не путалась с «отгрузкой».</p>
        </div>
      </div>
    </div>
  </section>

  <section id="ai-otchety-poisk-1c-erp-boris-block" class="a1r-boris-root" aria-label="Анимация: NL-запрос проходит read-only шлюз и возвращает таблицу из 1С без пересказа LLM">
  <style>
  /* === БОРИС: prefix a1r-b-, scoped внутри #ai-otchety-poisk-1c-erp-boris-block === */
  #ai-otchety-poisk-1c-erp-boris-block.a1r-boris-root{
    padding:56px 0 64px;
    background:#f8fafc;
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-cnt{
    max-width:1160px;
    margin:0 auto;
    padding:0 24px;
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-card{
    display:grid;
    grid-template-columns:minmax(0,42%) minmax(0,58%);
    border-radius:22px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
    min-height:500px;
  }
  @media(max-width:1023px){
    #ai-otchety-poisk-1c-erp-boris-block .a1r-b-card{
      grid-template-columns:1fr;
      min-height:auto;
    }
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-lft{
    padding:40px 36px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    border-right:1px solid #e2e8f0;
  }
  @media(max-width:1023px){
    #ai-otchety-poisk-1c-erp-boris-block .a1r-b-lft{
      border-right:none;
      border-bottom:1px solid #e2e8f0;
      padding:32px 24px;
    }
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-ey{
    display:inline-flex;
    align-items:center;
    gap:8px;
    font-size:11px;
    font-weight:700;
    letter-spacing:.12em;
    text-transform:uppercase;
    color:#0891b2;
    margin:0 0 14px;
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-ey::before{
    content:'';width:18px;height:2px;background:#0891b2;border-radius:1px;
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-h3{
    font-size:clamp(20px,2.4vw,26px);
    font-weight:800;
    color:#0f172a;
    line-height:1.28;
    margin:0 0 18px;
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-ul{
    list-style:none;margin:0 0 22px;padding:0;
    display:flex;flex-direction:column;gap:9px;
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-ul li{
    display:flex;align-items:flex-start;gap:10px;
    font-size:14px;line-height:1.5;color:#334155;
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-ic{
    flex-shrink:0;width:22px;height:22px;border-radius:50%;
    background:rgba(8,145,178,.1);display:flex;align-items:center;justify-content:center;
    font-size:11px;color:#0e7490;font-style:normal;margin-top:1px;
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-pills{
    display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-pl{
    padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-pl-c{
    background:rgba(8,145,178,.08);color:#0e7490;border:1.5px solid rgba(8,145,178,.22);
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-pl-g{
    background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-pl-v{
    background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-foot{
    font-size:13px;color:#64748b;font-style:italic;margin:0;
  }
  #ai-otchety-poisk-1c-erp-boris-block .a1r-b-rgt{
    position:relative;
    background:linear-gradient(135deg,#ecfeff 0%,#e0f2fe 32%,#f5f3ff 72%,#f8fafc 100%);
    min-height:440px;
    overflow:hidden;
  }
  @media(max-width:1023px){
    #ai-otchety-poisk-1c-erp-boris-block .a1r-b-rgt{min-height:380px;}
  }
  #a1r-nl-analytics-canvas{
    position:absolute;inset:0;width:100%;height:100%;display:block;
  }
  </style>

  <div class="a1r-b-cnt">
    <div class="a1r-b-card">
      <div class="a1r-b-lft">
        <span class="a1r-b-ey">returnDirect · read-only</span>
        <h3 class="a1r-b-h3">Вопрос на языке → шлюз → цифры из 1С без пересказа LLM</h3>
        <ul class="a1r-b-ul">
          <li><span class="a1r-b-ic">1</span>Сотрудник: «Просроченная дебиторка топ-10 за март»</li>
          <li><span class="a1r-b-ic">2</span>LLM классифицирует намерение; RAG подтягивает метаданные регистров</li>
          <li><span class="a1r-b-ic">3</span>Read-only шлюз (OData / MCP) формирует детерминированный запрос</li>
          <li><span class="a1r-b-ic">✓</span>Таблица возвращается напрямую из 1С — LLM только форматирует</li>
        </ul>
        <div class="a1r-b-pills">
          <span class="a1r-b-pl a1r-b-pl-c">NL-запрос</span>
          <span class="a1r-b-pl a1r-b-pl-g">из 1С</span>
          <span class="a1r-b-pl a1r-b-pl-v">журнал аудита</span>
        </div>
        <p class="a1r-b-foot">Дальше — AI-поиск по справочникам и read-only безопасность →</p>
      </div>
      <div class="a1r-b-rgt">
        <canvas id="a1r-nl-analytics-canvas" role="img" aria-label="Анимация: чат-вопрос проходит AI-шлюз и превращается в таблицу дебиторки из 1С с пометкой returnDirect"></canvas>
      </div>
    </div>
  </div>

  <script>
  (function(){
    'use strict';
    var cv = document.getElementById('a1r-nl-analytics-canvas');
    if (!cv) return;
    var ctx = cv.getContext('2d');
    var W = 0, H = 0, frame = 0;
    var LOOP = 720;

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
      cyan:'#0891b2', cyanGlow:'rgba(8,145,178,.2)',
      violet:'#7c3aed', violetGlow:'rgba(124,58,237,.18)',
      onec:'#ffdd2d', onecDark:'#e8b800', onecPanel:'#1a1f2e',
      green:'#22c55e', line:'rgba(8,145,178,.35)', rowAlt:'rgba(8,145,178,.06)'
    };

    function rr(x,y,w,h,r,fill,stroke,lw){
      ctx.beginPath();
      if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
      else ctx.rect(x,y,w,h);
      if(fill){ ctx.fillStyle=fill; ctx.fill(); }
      if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
    }

    function drawChatBubble(x,y,w,h,text,alpha){
      ctx.globalAlpha = alpha || 1;
      rr(x,y,w,h,12,C.paper,C.paperBdr,1.5);
      ctx.fillStyle=C.cyan;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText('Сотрудник · Telegram',x+12,y+16);
      ctx.fillStyle=C.ink;
      ctx.font='10px Inter,sans-serif';
      var words=text.split(' '), line='', ly=y+32, maxW=w-24;
      words.forEach(function(w){
        var test=line+w+' ';
        if(ctx.measureText(test).width>maxW && line){ ctx.fillText(line,x+12,ly); line=w+' '; ly+=14; }
        else line=test;
      });
      if(line) ctx.fillText(line,x+12,ly);
      ctx.globalAlpha=1;
    }

    function drawGateway(cx,cy,w,h,pulse){
      rr(cx,cy,w,h,14,'rgba(124,58,237,.07)',C.violet,2);
      ctx.fillStyle=C.violet;
      ctx.font='bold 11px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('AI-шлюз · read-only',cx+w/2,cy+18);
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,sans-serif';
      ctx.fillText('OData / MCP · returnDirect',cx+w/2,cy+32);
      for(var i=0;i<4;i++){
        var ang=(i/4)*Math.PI*2+pulse*0.05;
        ctx.beginPath();
        ctx.arc(cx+w/2+Math.cos(ang)*28,cy+h/2+Math.sin(ang)*16,3,0,Math.PI*2);
        ctx.fillStyle=C.violet;ctx.fill();
      }
    }

    function drawTable(x,y,w,h,rows,alpha,highlightRow){
      ctx.globalAlpha=alpha||1;
      rr(x,y,w,h,10,C.onecPanel,'#334155',2);
      rr(x,y,w,26,10,C.onec,C.onecDark,0);
      ctx.fillStyle=C.ink;
      ctx.font='bold 10px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText('1С:ERP · дебиторка',x+10,y+17);
      ctx.fillStyle=C.green;
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='right';
      ctx.fillText('returnDirect',x+w-10,y+17);
      var rh=22, top=y+34;
      rows.forEach(function(row,i){
        var ry=top+i*(rh+4);
        if(i===highlightRow) rr(x+6,ry,w-12,rh,4,C.rowAlt,C.cyan,1);
        else rr(x+6,ry,w-12,rh,4,'rgba(255,255,255,.04)','rgba(255,255,255,.08)',1);
        ctx.fillStyle='rgba(226,232,240,.85)';
        ctx.font='9px Inter,sans-serif';
        ctx.textAlign='left';
        ctx.fillText(row[0],x+12,ry+14);
        ctx.textAlign='right';
        ctx.fillStyle=i===highlightRow?C.green:'#94a3b8';
        ctx.fillText(row[1],x+w-12,ry+14);
      });
      ctx.globalAlpha=1;
    }

    function drawAuditLog(x,y,w,h,alpha){
      ctx.globalAlpha=alpha||1;
      rr(x,y,w,h,8,'rgba(34,197,94,.08)',C.green,1);
      ctx.fillStyle='#15803d';
      ctx.font='bold 8px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText('Журнал аудита',x+8,y+14);
      ctx.fillStyle=C.muted;
      ctx.font='8px Inter,sans-serif';
      ctx.fillText('user: fin_dir · query logged',x+8,y+26);
      ctx.globalAlpha=1;
    }

    var ROWS=[
      ['ООО Альфа','1 240 000 ₽'],
      ['ИП Бета','890 500 ₽'],
      ['ООО Гамма','654 200 ₽'],
      ['ООО Дельта','421 000 ₽'],
      ['ООО Эпсилон','318 750 ₽']
    ];

    function loop(){
      frame++;
      var t=frame%LOOP;
      ctx.clearRect(0,0,W,H);

      var pad=16;
      var chatW=Math.min(155,W*0.28);
      var chatH=72;
      var chatX=pad;
      var chatY=H*0.42-chatH/2;

      var gw=Math.min(120,W*0.2);
      var gh=Math.min(90,H*0.22);
      var gx=W*0.38-gw/2;
      var gy=H*0.42-gh/2;

      var tw=Math.min(170,W*0.3);
      var th=Math.min(175,H*0.42);
      var tx=W-tw-pad;
      var ty=H*0.42-th/2;

      var phase=t/LOOP;

      if(phase<0.22){
        var a=Math.min(1,t/80);
        drawChatBubble(chatX,chatY,chatW,chatH,'Просроченная дебиторка топ-10 за март',a);
      } else if(phase<0.48){
        drawChatBubble(chatX,chatY,chatW,chatH,'Просроченная дебиторка топ-10 за март',0.55);
        drawGateway(gx,gy,gw,gh,frame);
        ctx.strokeStyle=C.line;ctx.lineWidth=1.5;ctx.setLineDash([4,4]);
        ctx.beginPath();ctx.moveTo(chatX+chatW,chatY+chatH/2);ctx.lineTo(gx,gy+gh/2);ctx.stroke();
        ctx.setLineDash([]);
      } else if(phase<0.78){
        drawGateway(gx,gy,gw,gh,frame);
        var ta=Math.min(1,(t-LOOP*0.48)/60);
        var hi=Math.floor((t/40)%ROWS.length);
        drawTable(tx,ty,tw,th,ROWS,ta,hi);
        ctx.strokeStyle=C.line;ctx.lineWidth=1.5;ctx.setLineDash([4,4]);
        ctx.beginPath();ctx.moveTo(gx+gw,gy+gh/2);ctx.lineTo(tx,ty+th/2);ctx.stroke();
        ctx.setLineDash([]);
        if(ta>0.5) drawAuditLog(tx,ty+th+8,tw,36,(ta-0.5)*2);
      } else {
        var fa=1-(t-LOOP*0.78)/(LOOP*0.22);
        drawTable(tx,ty,tw,th,ROWS,fa,0);
        drawAuditLog(tx,ty+th+8,tw,36,fa*0.6);
      }

      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='left';ctx.fillText('NL-вопрос',pad,H-10);
      ctx.textAlign='center';ctx.fillText('Шлюз',W/2,H-10);
      ctx.textAlign='right';ctx.fillText('Таблица из 1С',W-pad,H-10);

      requestAnimationFrame(loop);
    }
    requestAnimationFrame(loop);
  })();
  </script>
  </section>

  <!-- CTA #1 Артур -->
  <div class="a1r-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-audit-otchety">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Оценить интеграцию с 1С — экспресс-аудит отчётов</p>
        <p class="ym-cta-block__sub">За 1–2 недели разберём, какие сводки, остатки и дебиторку вы собираете вручную, какие конфигурации 1С/ERP задействованы и с чего начать read-only пилот без риска для учёта. На выходе — схема AI + 1С и ориентир сроков.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <!-- H2 #3 -->
  <section class="a1r-section" id="poisk">
    <div class="a1r-cnt">
      <div class="a1r-sh">
        <span class="a1r-eyebrow">Поиск по ERP</span>
        <h2>AI-поиск и подсказки по данным ERP</h2>
        <p>Когда нужна не сводка, а конкретная сущность: контрагент, номенклатура, заказ, договор — с контекстом роли сотрудника.</p>
      </div>

      <div class="a1r-grid-2 nero-ai-reveal">
        <div class="a1r-card" id="poisk-spravochniki">
          <h3>Поиск по справочникам и регистрам</h3>
          <p>Вместо дерева справочников сотрудник пишет: «Найди контрагента ООО Ромашка с договором поставки» или «Какой артикул у товара с штрихкодом 4607…». AI через RAG по метаданным 1С формирует OData-запрос и возвращает карточку со ссылкой на источник в ERP.</p>
          <p>MCP-серверы для 1С (RSV Data, ARQA): инструменты <code>query</code>, <code>describe</code>, <code>get_structure</code> — только чтение, анонимизация ПДн.</p>
        </div>
        <div class="a1r-card nero-ai-delay-1" id="podskazki-sklad">
          <h3>Контекстные подсказки для склада и финансов</h3>
          <p>На складе: «На складе №2 остаток ниже минимума — оформить заявку поставщику?» Финансисту: «По контрагенту три непроведённых платежа — показать детали?» Подсказки на read-only данных, без изменения учёта без подтверждения человека.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #4 (доп. id bezopasnost) -->
  <section class="a1r-section a1r-section-alt" id="bezopasnost">
    <div class="a1r-cnt">
      <div class="a1r-sh a1r-left">
        <span class="a1r-eyebrow">Безопасность B2B</span>
        <h2>Безопасное read-only подключение к 1С</h2>
        <p>Система читает регистры и справочники, но не проводит документы без отдельного этапа с human approval. Пилот — на копии базы, не на боевой.</p>
      </div>

      <div class="a1r-grid-2 nero-ai-reveal">
        <div class="a1r-card" id="audit-zaprosov">
          <h3>Аудит запросов AI к базе</h3>
          <p>Каждый вопрос фиксируется в журнале: кто спросил, когда, какой запрос сформирован, какие данные возвращены. Закрывает внутренний контроль и 152-ФЗ.</p>
        </div>
        <div class="a1r-card nero-ai-delay-1" id="razgranichenie-prav">
          <h3>Кто видит какие регистры</h3>
          <p>Матрица ролей: директор — управленческая отчётность, бухгалтер — бухрегистры, кладовщик — остатки без P&amp;L. RBAC на уровне шлюза. On-prem LLM: GigaChat, YandexGPT, Qwen — данные не уходят в публичное облако.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #5 -->
  <section class="a1r-section" id="arhitektura">
    <div class="a1r-cnt">
      <div class="a1r-sh">
        <span class="a1r-eyebrow">Схема AI + 1С</span>
        <h2>Архитектура интеграции: 1С, LLM, MCP и REST</h2>
        <p>Пользователь → NL-интерфейс → AI-оркестратор → read-only шлюз (OData / MCP / HTTP) → 1С → ответ + журнал аудита.</p>
      </div>

      <div class="a1r-card nero-ai-reveal" id="shema-ai-1c" style="margin-bottom:28px;border-color:rgba(121,242,255,.28);">
        <p class="a1r-eyebrow" style="margin-bottom:10px;">Лид-магнит</p>
        <h3 style="font-size:19px;margin-bottom:12px;">Схема AI + 1С: поток данных без галлюцинаций</h3>
        <ol class="a1r-flow-list">
          <li>Вопрос на естественном языке в чат / Telegram / Teams</li>
          <li>LLM классифицирует намерение; RAG подтягивает метаданные 1С</li>
          <li>Шлюз формирует детерминированный OData/HTTP-запрос</li>
          <li>Данные возвращаются напрямую (<strong>returnDirect</strong>)</li>
          <li>LLM форматирует таблицу + ссылка на источник; запись в журнал аудита</li>
        </ol>
      </div>

      <div class="a1r-table-wrap nero-ai-reveal" id="tochki-vhoda">
        <table class="a1r-table">
          <thead><tr><th>Конфигурация</th><th>Точка входа</th><th>Типовые сценарии</th></tr></thead>
          <tbody>
            <tr><td>1С:УТ / 1С:ERP</td><td>OData, HTTP-сервисы</td><td>Остатки, продажи, заказы, дебиторка</td></tr>
            <tr><td>1С:БП</td><td>OData, внешние обработки</td><td>ОСВ, P&amp;L, налоговые регистры</td></tr>
            <tr><td>1С:КА</td><td>OData, COM</td><td>Производство, себестоимость</td></tr>
            <tr><td>SAP</td><td>RFC, OData, Joule API</td><td>NL-аналитика (аналог для 1С)</td></tr>
            <tr><td>Microsoft Dynamics 365</td><td>ERP MCP + Copilot Studio</td><td>Агенты поверх финансов и склада (GA 27.01.2026)</td></tr>
          </tbody>
        </table>
      </div>

      <div class="a1r-card nero-ai-reveal" style="margin-top:28px;" id="vektor-poisk">
        <h3>Векторный поиск по справочникам</h3>
        <p>RAG по метаданным 1С и бизнес-глоссарию: «дебиторка» → конкретный регистр, «выручка» → отчёт с фильтрами. DSL-агент внутри 1С (Infostart) снижает галлюцинации ограниченным набором действий.</p>
      </div>
    </div>
  </section>

  <!-- H2 #6 -->
  <section class="a1r-section a1r-section-alt" id="scenarii">
    <div class="a1r-cnt">
      <div class="a1r-sh">
        <span class="a1r-eyebrow">По отраслям</span>
        <h2>Сценарии для производства, торговли, склада и бухгалтерии</h2>
        <p>Интеграция AI с 1С и ERP для бизнеса адаптируется под отрасль и роль пользователя.</p>
      </div>

      <div class="a1r-grid-3 nero-ai-reveal">
        <div class="a1r-card" id="proizvodstvo">
          <h3>Производство и себестоимость</h3>
          <p>«Какая фактическая себестоимость партии №12345?» «Где узкое место по загрузке цеха за неделю?» — данные из регистров выпуска без ожидания отчёта от экономиста.</p>
        </div>
        <div class="a1r-card nero-ai-delay-1" id="torgovlya">
          <h3>Торговля и остатки</h3>
          <p>«Какие SKU не продавались 30 дней при остатке выше нормы?» Кейс «Конкор Оптика»: AI-аналитика по товарной матрице напрямую влияет на выручку (+25%).</p>
        </div>
        <div class="a1r-card nero-ai-delay-2" id="finansy">
          <h3>Финансы и бухгалтерия</h3>
          <p>«ОСВ по счёту 60 с группировкой по контрагентам». «Cash flow прогноз на основе дебиторки и кредиторки». Ответы без постановки задачи программисту.</p>
        </div>
      </div>

      <div class="a1r-table-wrap nero-ai-reveal" style="margin-top:32px;">
        <table class="a1r-table">
          <thead><tr><th>Возможность</th><th>1С:РПД, прогноз, речь</th><th>AI-отчёты Nero Network</th></tr></thead>
          <tbody>
            <tr><td>Распознавание сканов и первички</td><td>Да</td><td>Нет (см. <a href="/ai-1c-erp/">ai-1c-erp</a>)</td></tr>
            <tr><td>NL-запрос «покажи дебиторку»</td><td>Нет штатно</td><td>Да</td></tr>
            <tr><td>Поиск по справочникам на языке</td><td>Ограниченно</td><td>Да, с RAG</td></tr>
            <tr><td>Read-only пилот</td><td>—</td><td>Да, 4–8 недель</td></tr>
            <tr><td>Аудит запросов</td><td>—</td><td>Да</td></tr>
            <tr><td>Telegram / Teams</td><td>—</td><td>Да</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- H2 #7 -->
  <section class="a1r-section" id="otlichie">
    <div class="a1r-cnt">
      <div class="a1r-sh">
        <span class="a1r-eyebrow">Не путать с OCR</span>
        <h2>Чем это отличается от OCR и документооборота в 1С</h2>
        <p>На странице <a href="/ai-1c-erp/">интеграции AI с 1С для документов</a> — OCR, счета, УПД и первичка. <strong>Здесь</strong> — conversational analytics, отчёты, поиск и подсказки.</p>
      </div>

      <div class="a1r-table-wrap nero-ai-reveal">
        <table class="a1r-table">
          <thead><tr><th>Задача</th><th>Документооборот (ai-1c-erp)</th><th>Отчёты и поиск (эта страница)</th></tr></thead>
          <tbody>
            <tr><td>Входящий счёт от поставщика</td><td>OCR → проведение</td><td>—</td></tr>
            <tr><td>Просроченная дебиторка топ-10</td><td>—</td><td>NL-запрос → таблица</td></tr>
            <tr><td>Поиск контрагента по ИНН</td><td>Частично</td><td>AI-поиск по базе</td></tr>
            <tr><td>P&amp;L по направлению</td><td>—</td><td>Отчёт на языке</td></tr>
            <tr><td>Заявка на закупку из PDF</td><td>Да</td><td>—</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;text-align:center;color:var(--a1r-muted);">Сначала — аналитика и поиск (низкий риск, read-only), затем — автоматизация документов с human approval.</p>
    </div>
  </section>

  <!-- H2 #8 -->
  <section class="a1r-section a1r-section-alt" id="etapy">
    <div class="a1r-cnt">
      <div class="a1r-sh a1r-left">
        <span class="a1r-eyebrow">Под ключ</span>
        <h2>Как внедряем AI в 1С и ERP под ключ</h2>
        <p>От аудита до промышленной эксплуатации: шлюз, семантический слой, интерфейс и политики безопасности.</p>
      </div>

      <div class="a1r-card nero-ai-reveal">
        <div class="a1r-timeline">
          <div class="a1r-tl-item" id="audit-dannyh">
            <div class="a1r-tl-dot"></div>
            <h3>Аудит данных и сценариев (1–2 недели)</h3>
            <p>Конфигурация (УТ, БП, ERP), болевые отчёты, роли, OData/HTTP, качество данных. 10–20 эталонных вопросов. Облачная LLM или on-prem (152-ФЗ, КИИ).</p>
          </div>
          <div class="a1r-tl-item" id="pilot-masshtab">
            <div class="a1r-tl-dot"></div>
            <h3>Пилот, обучение, масштабирование (4–8 недель)</h3>
            <p>Один сценарий — «дебиторка и топ клиентов» — на копии базы. NL-интерфейс в Telegram, веб-чате или Teams. Запись документов — отдельный этап только с human approval.</p>
          </div>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением conversational analytics полезно разобраться в OData, MCP, human-in-the-loop и настройке read-only шлюза — это ускоряет согласование сценариев с бухгалтерией и IT. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- H2 #9 -->
  <section class="a1r-section" id="stoimost">
    <div class="a1r-cnt">
      <div class="a1r-sh">
        <span class="a1r-eyebrow">Коммерция</span>
        <h2>Стоимость и сроки интеграции AI с 1С</h2>
        <p>Ориентир чека Nero Network: <strong>500 тыс.–4 млн ₽</strong> — зависит от глубины сценариев, конфигураций и требований к on-prem.</p>
      </div>

      <div class="a1r-grid-3 nero-ai-reveal" id="ot-chego-zavisit">
        <div class="a1r-card">
          <h3>От ~500 тыс. ₽</h3>
          <p>Пилот read-only, один сценарий, одна конфигурация 1С, облачная LLM, Telegram-интерфейс.</p>
        </div>
        <div class="a1r-card nero-ai-delay-1">
          <h3>1–2,5 млн ₽</h3>
          <p>3–5 сценариев, семантический слой, аудит, кэш отчётов, несколько ролей.</p>
        </div>
        <div class="a1r-card nero-ai-delay-2">
          <h3>До 4 млн ₽</h3>
          <p>On-prem LLM, несколько баз, MCP-интеграция, SLA, SAP/Dynamics, связка с CRM.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;">Часы финдиректора и 1С-программиста на ad-hoc отчёты за год часто превышают стоимость пилота.</p>
    </div>
  </section>

  <!-- H2 #10 -->
  <section class="a1r-section a1r-section-alt" id="faq">
    <div class="a1r-cnt">
      <div class="a1r-sh">
        <span class="a1r-eyebrow">FAQ</span>
        <h2>FAQ: внедрение AI в 1С и ERP</h2>
      </div>

      <div class="a1r-faq nero-ai-reveal">
        <div class="a1r-faq-item" id="faq-bez-programmista">
          <div class="a1r-faq-q" role="button" tabindex="0">Можно ли без программиста?</div>
          <div class="a1r-faq-a"><p>Да — для ежедневной работы. Вопросы на естественном языке без знания языка запросов 1С. Программист нужен на этапе настройки шлюза — это делает Nero Network при внедрении под ключ.</p></div>
        </div>
        <div class="a1r-faq-item" id="faq-pod-klyuch">
          <div class="a1r-faq-q" role="button" tabindex="0">Под ключ или своими силами?</div>
          <div class="a1r-faq-a">
            <div class="a1r-table-wrap" style="margin:0;">
              <table class="a1r-table">
                <thead><tr><th>Критерий</th><th>Под ключ</th><th>Своими силами</th></tr></thead>
                <tbody>
                  <tr><td>Срок до пилота</td><td>4–8 недель</td><td>3–6 месяцев</td></tr>
                  <tr><td>Безопасность</td><td>Встроена</td><td>Нужно проектировать</td></tr>
                  <tr><td>Риск галлюцинаций</td><td>returnDirect, шлюз</td><td>Зависит от архитектуры</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="a1r-faq-item" id="faq-keisy">
          <div class="a1r-faq-q" role="button" tabindex="0">Примеры внедрения и кейсы</div>
          <div class="a1r-faq-a">
            <ul>
              <li><strong>ПРОсковья</strong> — NL-отчёты и RAG-поиск в 1С, реестр российского ПО</li>
              <li><strong>Конкор Оптика</strong> — рост выручки на 25% через AI-аналитику запасов</li>
              <li><strong>MCP-серверы (ARQA, RSV Data)</strong> — NL-запросы к остаткам, дебиторке, ОСВ</li>
              <li><strong>Microsoft D365 ERP MCP</strong> — GA январь 2026</li>
              <li><strong>SAP Joule</strong> — NL-аналитика (~80% меньше шагов по заявлению SAP)</li>
            </ul>
          </div>
        </div>
        <div class="a1r-faq-item" id="faq-crm">
          <div class="a1r-faq-q" role="button" tabindex="0">Совместимость с CRM</div>
          <div class="a1r-faq-a"><p>AI-слой над 1С/ERP дополняет CRM. При связке с amoCRM агент отвечает на вопросы из обеих систем: «Какой клиент из CRM задолжал больше всех по данным 1С?»</p></div>
        </div>
      </div>
    </div>
  </section>

  <div class="a1r-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы спрашивать 1С на естественном языке?</p>
        <p class="ym-cta-block__sub">Следующий шаг — экспресс-аудит отчётов и поиска по ERP. Пилот read-only на одном сценарии за 4–8 недель, цифры из 1С напрямую, без ломки конфигурации.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

</div><!-- /.a1r-content -->

  <!-- INTERNAL-LINKS:INSERT -->
  <!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.a1r-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.a1r-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.a1r-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.a1r-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
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
  var root = document.querySelector('.ai-otchety-poisk-1c-erp-page') || document.querySelector('.a1r-content');
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

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

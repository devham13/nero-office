<?php
/**
 * Template Name: AI-мониторинг конкурентов и трендов: внедрение под ключ
 * Description: SEO-лендинг — AI-мониторинг конкурентов, social listening, тренды контента, внедрение под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-мониторинг конкурентов и трендов: внедрение под ключ';
$page_seo_description = 'Внедряем AI-систему мониторинга конкурентов и трендов контента: social listening, анализ форматов, готовые гипотезы для SMM. Кейсы, CRM, отчёт по 5 конкурентам.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Тренды', 'href' => '#trendy-kontenta'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить конкурентов';
$primary_cta_url   = nero_ai_primary_cta_url();
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

.amk-content{
  --amk-bg:#050711;--amk-bg2:#080b17;
  --amk-surface:rgba(255,255,255,.072);--amk-text:#e6edf7;--amk-muted:#9aa8bd;
  --amk-soft:#c7d2e5;--amk-heading:#fff;--amk-border:rgba(255,255,255,.10);
  --amk-accent:#79f2ff;--amk-violet:#8b5cf6;--amk-green:#22c55e;
  --amk-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--amk-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.amk-content *,.amk-content *::before,.amk-content *::after{box-sizing:border-box;}
.amk-content a{color:inherit;}
.amk-content p{color:var(--amk-muted);line-height:1.72;margin:0 0 1em;}
.amk-content p:last-child{margin-bottom:0;}
.amk-content h2,.amk-content h3,.amk-content h4{color:var(--amk-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.amk-content strong{color:var(--amk-soft);}
.amk-cnt{width:min(var(--amk-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.amk-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.amk-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);
}
.amk-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.amk-sh h2{font-size:clamp(26px,4vw,48px);line-height:1.08;margin-bottom:14px;}
.amk-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.amk-eyebrow{
  display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--amk-accent);margin-bottom:14px;
}
.amk-h3{font-size:clamp(18px,2.2vw,22px);margin:28px 0 14px;}
.amk-ul,.amk-ol{margin:0 0 1.2em;padding-left:0;list-style:none;}
.amk-ul li,.amk-ol li{
  padding-left:20px;position:relative;margin-bottom:.5em;color:var(--amk-muted);
  font-size:14.5px;line-height:1.65;
}
.amk-ul li::before{content:'›';position:absolute;left:0;color:var(--amk-accent);font-weight:700;}
.amk-ol{counter-reset:amk-ol;}
.amk-ol li{counter-increment:amk-ol;padding-left:28px;}
.amk-ol li::before{
  content:counter(amk-ol);position:absolute;left:0;width:20px;height:20px;border-radius:6px;
  background:rgba(121,242,255,.12);color:var(--amk-accent);font-size:11px;font-weight:800;
  display:grid;place-items:center;
}
.amk-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.amk-table{width:100%;border-collapse:collapse;font-size:14px;}
.amk-table th{
  padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--amk-accent);
  font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.amk-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--amk-text);vertical-align:top;}
.amk-table tr:last-child td{border-bottom:none;}
.amk-table tr:hover td{background:rgba(255,255,255,.03);}
.amk-checklist{
  display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin-top:28px;
  list-style:none;padding:0;
}
.amk-checklist li{
  padding:12px 14px 12px 36px;border-radius:12px;background:rgba(255,255,255,.05);
  border:1px solid rgba(255,255,255,.08);position:relative;color:var(--amk-muted);font-size:13.5px;
}
.amk-checklist li::before{
  content:'✓';position:absolute;left:12px;color:var(--amk-green);font-weight:800;
}
@media(max-width:768px){.amk-checklist{grid-template-columns:1fr;}}

.amk-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.amk-intro-grid{display:grid;grid-template-columns:1fr 320px;gap:48px;align-items:center;}
.amk-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.amk-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--amk-accent),var(--amk-violet));
}
.amk-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.amk-intro-deco{
  display:grid;gap:10px;padding:18px;border-radius:16px;
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:12px;
}
.amk-intro-deco .amk-chip{
  display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border-radius:8px;
  background:rgba(59,130,246,.12);border:1px solid rgba(59,130,246,.25);color:#93c5fd;
  font-size:11px;font-weight:650;
}
.amk-intro-deco .amk-pipe{color:#64748b;line-height:1.5;}
@media(max-width:900px){.amk-intro-grid{grid-template-columns:1fr;}}

.amk-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.amk-toc,.ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.amk-toc a,.ym-toc a{
  display:inline-block;padding:9px 18px;background:var(--amk-surface);border:1px solid var(--amk-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--amk-muted);
  text-decoration:none;transition:border-color .2s,color .2s,background .2s;
}
.amk-toc a:hover,.ym-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--amk-accent);background:rgba(121,242,255,.08);
}

.ym-cta-block{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border:1px solid rgba(121,242,255,.3);text-align:center;
}
.ym-cta-block--secondary{
  background:linear-gradient(135deg,rgba(34,197,94,.08),rgba(121,242,255,.08));
  border-color:rgba(34,197,94,.28);text-align:left;
}
.ym-cta-block--footer-final{
  margin:0 0 clamp(48px,6vw,80px);
  background:linear-gradient(135deg,rgba(59,130,246,.14),rgba(139,92,246,.12));
}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(18px,2.4vw,24px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{font-size:15px;color:var(--amk-muted);margin:0 0 18px;line-height:1.65;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:var(--amk-accent)!important;text-decoration:underline;}
.ym-btn--ghost{background:transparent!important;}

.amk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.amk-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.amk-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--amk-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
}
.amk-faq-q::after{content:'▾';font-size:13px;color:var(--amk-accent);transition:transform .25s;}
.amk-faq-item.open .amk-faq-q::after{transform:rotate(180deg);}
.amk-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--amk-muted);line-height:1.72;
}
.amk-faq-item.open .amk-faq-a{max-height:800px;padding:0 24px 20px;}

.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-monitoring-konkurentov-page" role="main" tabindex="-1">

<section class="nero-ai-hero amk-hero-monitoring" id="hero" aria-labelledby="hero-monitoring-title">
<style>
/* ── Hero ai-monitoring-konkurentov: самодостаточные стили ── */
.amk-hero-monitoring {
  --amk-bg: #060a12;
  --amk-surface: rgba(15, 23, 42, 0.72);
  --amk-border: rgba(148, 163, 184, 0.14);
  --amk-text: #cbd5e1;
  --amk-heading: #f8fafc;
  --amk-muted: #94a3b8;
  --amk-accent: #3b82f6;
  --amk-violet: #8b5cf6;
  --amk-green: #22c55e;
  --amk-cyan: #38bdf8;
  --amk-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(920px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(108px, 14vh, 148px) 0 clamp(64px, 8vw, 80px);
  isolation: isolate;
  background:
    radial-gradient(ellipse 80% 50% at 70% 20%, rgba(59, 130, 246, 0.18), transparent),
    radial-gradient(ellipse 60% 40% at 10% 80%, rgba(139, 92, 246, 0.12), transparent),
    var(--amk-bg);
  font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}
.amk-hero-monitoring::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(circle at 35% 30%, #000 0%, transparent 70%);
  opacity: .45;
  pointer-events: none;
  z-index: 0;
}
.amk-hero-monitoring .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.amk-hero-monitoring .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.amk-hero-monitoring .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(59, 130, 246, 0.25);
  border-radius: 999px;
  background: rgba(59, 130, 246, 0.1);
  color: #93c5fd !important;
  font-size: 11px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.amk-hero-monitoring h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(34px, 5vw, 56px);
  line-height: 1.06;
  letter-spacing: -0.04em;
  color: var(--amk-heading);
  font-weight: 800;
}
.amk-hero-monitoring .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--amk-cyan) 42%, var(--amk-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.amk-hero-monitoring .nero-ai-hero-lead {
  margin: 20px 0 0;
  max-width: 720px;
  color: var(--amk-muted) !important;
  font-size: clamp(16px, 1.9vw, 20px);
  line-height: 1.58;
}
.amk-hero-monitoring .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 24px 0 0;
  padding: 0;
  list-style: none;
}
.amk-hero-monitoring .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 12px;
  border: 1px solid rgba(59, 130, 246, 0.22);
  border-radius: 999px;
  background: rgba(59, 130, 246, 0.1);
  color: #bfdbfe;
  font-size: 12px;
  font-weight: 700;
}
.amk-hero-monitoring .amk-phase-strip {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 22px 0 0;
  padding: 0;
  list-style: none;
}
.amk-hero-monitoring .amk-phase-strip li {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 14px;
  border-radius: 12px;
  border: 1px solid rgba(148, 163, 184, 0.16);
  background: rgba(15, 23, 42, 0.55);
  color: #e2e8f0;
  font-size: 12px;
  font-weight: 650;
}
.amk-hero-monitoring .amk-phase-strip li span {
  width: 22px;
  height: 22px;
  border-radius: 7px;
  background: linear-gradient(135deg, var(--amk-accent), var(--amk-violet));
  color: #fff;
  font-size: 10px;
  font-weight: 800;
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.amk-hero-monitoring .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 30px;
}
.amk-hero-monitoring .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 22px;
  border-radius: 12px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 700;
  line-height: 1;
  text-decoration: none !important;
  transition: transform .22s ease, box-shadow .22s ease;
}
.amk-hero-monitoring .nero-ai-btn:hover { transform: translateY(-2px); }
.amk-hero-monitoring .nero-ai-btn-primary {
  color: #fff !important;
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  box-shadow: 0 12px 36px rgba(59, 130, 246, 0.28);
}
.amk-hero-monitoring .nero-ai-btn-secondary {
  color: var(--amk-text) !important;
  background: rgba(255, 255, 255, 0.06);
  border-color: var(--amk-border);
}
.amk-hero-monitoring .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 22px;
  background: var(--amk-surface);
  border: 1px solid var(--amk-border);
  box-shadow: var(--amk-shadow);
  backdrop-filter: blur(12px);
  transform: perspective(1100px) rotateY(-2deg) rotateX(1.5deg);
}
.amk-hero-monitoring .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 18px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .96), rgba(6, 10, 24, .98));
}
.amk-hero-monitoring .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 12px 14px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.amk-hero-monitoring .nero-ai-dots { display: flex; gap: 7px; }
.amk-hero-monitoring .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.amk-hero-monitoring .nero-ai-dot:nth-child(1) { background: #fb7185; }
.amk-hero-monitoring .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.amk-hero-monitoring .nero-ai-dot:nth-child(3) { background: #34d399; }
.amk-hero-monitoring .nero-ai-window-title {
  color: #94a3b8;
  font-size: 10px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.amk-hero-monitoring .nero-ai-window-body { padding: 14px; }
.amk-hero-monitoring .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 10px;
}
.amk-hero-monitoring .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 16px;
  letter-spacing: -0.03em;
  color: #fff;
}
.amk-hero-monitoring .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 5px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.1);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
}
.amk-hero-monitoring .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 5px rgba(34,197,94,.14);
  animation: amkPulse 1.6s infinite;
}
@keyframes amkPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.amk-hero-monitoring .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 8px;
  margin-bottom: 10px;
}
.amk-hero-monitoring .nero-ai-metric {
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.045);
}
.amk-hero-monitoring .nero-ai-metric span {
  display: block;
  color: var(--amk-muted);
  font-size: 10px;
  font-weight: 700;
}
.amk-hero-monitoring .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  color: #fff;
  font-size: 20px;
  line-height: 1;
}
.amk-hero-monitoring .nero-ai-metric small {
  display: block;
  margin-top: 3px;
  color: #64748b;
  font-size: 10px;
}
.amk-hero-monitoring .amk-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 280px);
  margin: 0 0 10px;
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid rgba(56, 189, 248, 0.18);
  background: radial-gradient(ellipse at 50% 42%, rgba(56,189,248,.09), rgba(6,10,24,.95) 72%);
}
.amk-hero-monitoring #amk-monitoring-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.amk-hero-monitoring .amk-metric-pill {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 10px;
}
.amk-hero-monitoring .amk-metric-pill span {
  padding: 6px 12px;
  border-radius: 999px;
  border: 1px solid rgba(148, 163, 184, 0.14);
  background: rgba(255,255,255,.04);
  color: #cbd5e1;
  font-size: 11px;
  font-weight: 650;
}
.amk-hero-monitoring .nero-ai-task-stream { display: grid; gap: 7px; }
.amk-hero-monitoring .nero-ai-task {
  display: grid;
  grid-template-columns: 26px 1fr auto;
  align-items: center;
  gap: 9px;
  padding: 9px;
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 12px;
  background: rgba(255,255,255,.035);
}
.amk-hero-monitoring .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 26px;
  height: 26px;
  border-radius: 10px;
  background: rgba(56,189,248,.12);
  color: var(--amk-cyan);
  font-size: 10px;
  font-weight: 800;
}
.amk-hero-monitoring .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 11px;
}
.amk-hero-monitoring .nero-ai-task span {
  color: var(--amk-muted);
  font-size: 10px;
}
.amk-hero-monitoring .nero-ai-status {
  padding: 3px 7px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 9px;
  font-weight: 800;
  white-space: nowrap;
}
.amk-hero-monitoring .nero-ai-status--violet {
  background: rgba(139,92,246,.12);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .amk-hero-monitoring .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .amk-hero-monitoring .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .amk-hero-monitoring .nero-ai-dashboard { padding: 10px; }
  .amk-hero-monitoring .nero-ai-window-body { padding: 10px; }
  .amk-hero-monitoring .nero-ai-task { grid-template-columns: 26px 1fr; }
  .amk-hero-monitoring .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai мониторинг конкурентов</p>
      <h1 id="hero-monitoring-title">AI-мониторинг конкурентов и трендов контента: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI отслеживает конкурентов, выделяет работающие форматы и темы и формирует безопасные контент-гипотезы для вашей команды — без ручного скроллинга и хаотичных таблиц</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Social listening</li>
        <li class="nero-ai-badge">Тренды контента</li>
        <li class="nero-ai-badge">Безопасные гипотезы</li>
        <li class="nero-ai-badge">VK · Telegram</li>
      </ul>
      <ol class="amk-phase-strip" aria-label="Этапы мониторинга">
        <li><span>1</span>Сбор сигналов</li>
        <li><span>2</span>Кластер трендов</li>
        <li><span>3</span>Безопасные гипотезы</li>
        <li><span>4</span>Алерт в Telegram</li>
      </ol>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-мониторинг конкурентов">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">конкуренты · демо · evidence URL</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Дашборд разведки</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Конкуренты</span><strong>5</strong><small>в отчёте</small></div>
            <div class="nero-ai-metric"><span>ER</span><strong>+18%</strong><small>тренд недели</small></div>
            <div class="nero-ai-metric"><span>Гипотезы</span><strong>12</strong><small>на ревью</small></div>
            <div class="nero-ai-metric"><span>Алерты</span><strong>3</strong><small>новых</small></div>
          </div>

          <div class="amk-dash-canvas-wrap">
            <canvas id="amk-monitoring-hero-canvas" role="img" aria-label="Анимация: сигналы конкурентов по орбитам кластеризуются на радаре и превращаются в безопасные контент-гипотезы"></canvas>
          </div>

          <div class="amk-metric-pill" aria-hidden="true">
            <span>5 конкурентов</span>
            <span>ER +18%</span>
            <span>VK · Telegram</span>
            <span>gap-анализ</span>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий разведки">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">VK</span>
              <div><strong>Конкурент A</strong><span>reels · ER 4,2% · hook «цифры»</span></div>
              <span class="nero-ai-status">тренд</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Конкурент B</strong><span>карусель · тема «кейсы»</span></div>
              <span class="nero-ai-status nero-ai-status--violet">гипотеза</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Gap-анализ</strong><span>3 темы без вас · URL прикреплён</span></div>
              <span class="nero-ai-status">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  'use strict';
  var canvas = document.getElementById('amk-monitoring-hero-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var cw = 0, ch = 0, cx = 0, cy = 0, scale = 1, frame = 0;
  var LOOP = 220;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw * 0.52;
    cy = ch * 0.54;
    scale = Math.min(cw / 420, ch / 280) * 1.15;
  }
  window.addEventListener('resize', resizeCanvas);
  resizeCanvas();

  var C = {
    outline: '#e2e8f0',
    hub: '#0f172a',
    hubRing: '#38bdf8',
    orbit: 'rgba(148,163,184,0.22)',
    vk: '#4f46e5',
    tg: '#0ea5e9',
    yt: '#ef4444',
    trend: '#22c55e',
    hypo: '#a78bfa',
    warn: '#f59e0b',
    agentYellow: '#eab308',
    agentGreen: '#10b981',
    agentBlue: '#3b82f6',
    agentPink: '#ec4899',
    agentPurple: '#8b5cf6',
    bubbleBg: 'rgba(15,23,42,0.92)'
  };

  function rr(x, y, w, h, r, fill, stroke, lw) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else { ctx.rect(x, y, w, h); }
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1.5; ctx.stroke(); }
  }

  function drawPolyRound(x, y, w, h, radius, fill, stroke) {
    rr(x, y, w, h, radius, fill, stroke, 2);
  }

  /* ── Орбитальные пути (вместо Conveyor) ── */
  class SignalOrbit {
    constructor(radius, tilt, speed, color) {
      this.r = radius; this.tilt = tilt; this.speed = speed; this.color = color;
    }
    draw() {
      ctx.save();
      ctx.translate(cx, cy);
      ctx.scale(1, this.tilt);
      ctx.strokeStyle = this.color;
      ctx.lineWidth = 1.2;
      ctx.setLineDash([4, 8]);
      ctx.beginPath();
      ctx.arc(0, 0, this.r * scale, 0, Math.PI * 2);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();
    }
    pointAt(t) {
      var ang = t * this.speed + frame * 0.018;
      return {
        x: cx + Math.cos(ang) * this.r * scale,
        y: cy + Math.sin(ang) * this.r * scale * this.tilt
      };
    }
  }

  /* ── Центральный радар (вместо WebsiteTerminal) ── */
  class TrendRadarHub {
    constructor() {
      this.pulse = 0;
      this.clusterAlpha = 0;
    }
    phase() { return (frame * 0.045) % LOOP; }
    draw() {
      var prg = this.phase();
      this.pulse = 0.5 + Math.sin(frame * 0.08) * 0.15;
      if (prg > 95 && prg < 165) this.clusterAlpha = Math.min(1, this.clusterAlpha + 0.03);
      else if (prg < 20) this.clusterAlpha = Math.max(0, this.clusterAlpha - 0.04);

      var r = 46 * scale;
      ctx.save();
      ctx.translate(cx, cy);

      for (var i = 0; i < 3; i++) {
        ctx.strokeStyle = 'rgba(56,189,248,' + (0.08 + i * 0.05) + ')';
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.arc(0, 0, r + i * 14 * scale, 0, Math.PI * 2);
        ctx.stroke();
      }

      var sweep = (frame * 0.04) % (Math.PI * 2);
      ctx.fillStyle = 'rgba(56,189,248,0.12)';
      ctx.beginPath();
      ctx.moveTo(0, 0);
      ctx.arc(0, 0, r + 18 * scale, sweep - 0.5, sweep);
      ctx.closePath();
      ctx.fill();

      drawPolyRound(-r, -r, r * 2, r * 2, r, C.hub, C.hubRing);

      if (this.clusterAlpha > 0) {
        ctx.globalAlpha = this.clusterAlpha;
        [['#22c55e', -18, -8], ['#f59e0b', 8, -14], ['#8b5cf6', -4, 12]].forEach(function (cl, idx) {
          drawPolyRound(cl[1] * scale - 10, cl[2] * scale - 6, 20 * scale, 12 * scale, 4, cl[0], C.outline);
        });
        ctx.globalAlpha = 1;
      }

      ctx.fillStyle = C.outline;
      ctx.font = 'bold ' + Math.max(8, 9 * scale) + 'px Inter, sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('CI', 0, 4 * scale);

      if (prg > 155 && prg < 210) {
        var burst = (prg - 155) / 55;
        ctx.strokeStyle = 'rgba(167,139,250,' + (1 - burst) + ')';
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(0, 0, (r + 10 * scale) + burst * 30 * scale, 0, Math.PI * 2);
        ctx.stroke();
      }
      ctx.restore();
    }
  }

  class PlatformBeacon {
    constructor(x, y, label, color) {
      this.x = x; this.y = y; this.label = label; this.color = color;
      this.blink = Math.random() * 100;
    }
    draw() {
      this.blink += 0.05;
      var a = 0.55 + Math.sin(this.blink) * 0.25;
      ctx.save();
      ctx.globalAlpha = a;
      drawPolyRound(this.x - 11, this.y - 8, 22, 16, 5, this.color, C.outline);
      ctx.fillStyle = '#fff';
      ctx.font = 'bold 8px Inter, sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(this.label, this.x, this.y + 3);
      ctx.restore();
    }
  }

  class ContentBlip {
    constructor(orbit, offset, color, label) {
      this.orbit = orbit;
      this.offset = offset;
      this.color = color;
      this.label = label;
      this.ingested = false;
    }
    draw(prg) {
      var t = this.offset + (prg > 45 ? (prg - 45) * 0.004 : 0);
      var p = this.orbit.pointAt(t);
      if (prg > 45 && prg < 105) {
        var pull = (prg - 45) / 60;
        p.x += (cx - p.x) * pull * 0.35;
        p.y += (cy - p.y) * pull * 0.35;
      }
      drawPolyRound(p.x - 7, p.y - 7, 14, 14, 3, this.color, C.outline);
      if (prg > 88 && prg < 92 && !this.ingested) {
        this.ingested = true;
        createBubble(p.x, p.y - 12, this.label, 180);
      }
      if (prg < 25) this.ingested = false;
    }
  }

  class HypothesisCard {
    constructor(angle, delay) {
      this.angle = angle;
      this.delay = delay;
      this.y = 0;
      this.alpha = 0;
    }
    draw(prg) {
      if (prg < this.delay || prg > this.delay + 45) return;
      var local = (prg - this.delay) / 45;
      this.alpha = local < 0.15 ? local / 0.15 : (local > 0.8 ? (1 - local) / 0.2 : 1);
      this.y = local * -55 * scale;
      var x = cx + Math.cos(this.angle) * 38 * scale;
      var y = cy + this.y + Math.sin(this.angle) * 12 * scale;
      ctx.save();
      ctx.globalAlpha = this.alpha;
      drawPolyRound(x - 34, y - 10, 68, 20, 5, 'rgba(167,139,250,0.85)', C.outline);
      ctx.fillStyle = '#fff';
      ctx.font = 'bold 8px Inter, sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('безопасная гипотеза', x, y + 3);
      ctx.restore();
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
    draw(prg) {
      this.timer += 0.035;
      var isMoving = false;
      var faceDir = 1;
      var targetX = cx - 70 * scale;
      var targetY = cy + 35 * scale + (this.stepTrig * 0.15);

      if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
        var local = prg - this.stepTrig;
        if (local < 11) {
          isMoving = true; faceDir = 1;
          this.x = this.baseX + (targetX - this.baseX) * (local / 11);
          this.y = this.baseY + (targetY - this.baseY) * (local / 11);
        } else if (local < 14) {
          this.x = targetX; this.y = targetY;
        } else {
          isMoving = true; faceDir = -1;
          this.x = targetX - (targetX - this.baseX) * ((local - 14) / 8);
          this.y = targetY - (targetY - this.baseY) * ((local - 14) / 8);
        }
      } else {
        this.x = this.baseX; this.y = this.baseY;
      }

      if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 200);
      }

      var bob = Math.sin(this.timer * 1.6) * 1.2;
      ctx.save();
      ctx.translate(this.x, this.y);
      drawPolyRound(-9, 4, 8, 12, 2, C.outline, null);
      drawPolyRound(1, 4, 8, 12, 2, C.outline, null);
      drawPolyRound(-13, -10 - bob, 26, 18, 5, this.color, C.outline);
      ctx.fillStyle = this.color;
      ctx.beginPath(); ctx.arc(0, -24 - bob, 10, 0, Math.PI * 2); ctx.fill();
      ctx.strokeStyle = C.outline; ctx.lineWidth = 1.5; ctx.stroke();
      ctx.fillStyle = '#fff';
      ctx.beginPath(); ctx.arc(3, -26 - bob, 3, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(-3, -26 - bob, 3, 0, Math.PI * 2); ctx.fill();
      ctx.restore();
    }
  }

  var orbits = [
    new SignalOrbit(95, 0.55, 0.7, C.orbit),
    new SignalOrbit(72, 0.48, 1.1, C.orbit),
    new SignalOrbit(118, 0.62, 0.5, C.orbit)
  ];
  var hub = new TrendRadarHub();
  var blips = [
    new ContentBlip(orbits[0], 0.1, C.vk, 'VK · ER 4,2%'),
    new ContentBlip(orbits[1], 0.45, C.tg, 'TG · hook'),
    new ContentBlip(orbits[2], 0.78, C.yt, 'Shorts ↑'),
    new ContentBlip(orbits[0], 1.2, C.warn, 'аномалия ER')
  ];
  var hypos = [
    new HypothesisCard(-0.8, 158),
    new HypothesisCard(0.2, 164),
    new HypothesisCard(1.1, 170)
  ];
  var beacons = [
    new PlatformBeacon(cx - 120 * scale, cy + 55 * scale, 'VK', C.vk),
    new PlatformBeacon(cx + 105 * scale, cy - 48 * scale, 'TG', C.tg),
    new PlatformBeacon(cx - 30 * scale, cy - 78 * scale, 'YT', C.yt)
  ];
  var agents = [
    new Agent(28, ch - 36, C.agentYellow, '1_architect', 12, ['Добавляю источник VK…', 'White-list доменов', 'Реестр: 5 конкурентов']),
    new Agent(58, ch - 58, C.agentGreen, '2_seo', 48, ['Кластер: reels растут', 'ER выше медианы', 'Тренд «кейсы с цифрами»']),
    new Agent(88, ch - 34, C.agentBlue, '3_coder', 82, ['NLP: hook извлечён', 'Парсинг без галлюцинаций', 'URL в evidence']),
    new Agent(cw - 72, ch - 52, C.agentPink, '4_designer', 118, ['Формат: carousel', 'Сравниваю hooks', 'Gap: 3 темы']),
    new Agent(cw - 42, ch - 30, C.agentPurple, '5_deployer', 152, ['Гипотеза в CRM', 'Алерт в Telegram', 'На human review'])
  ];
  var bubbles = [];
  var bubbleFired = {};

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, max: life });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    var prg = (frame * 0.045) % LOOP;

    orbits.forEach(function (o) { o.draw(); });
    beacons.forEach(function (b) { b.draw(); });
    hub.draw();
    blips.forEach(function (b) { b.draw(prg); });
    hypos.forEach(function (h) { h.draw(prg); });
    agents.forEach(function (a) { a.draw(prg); });

    if (prg >= 10 && prg < 10.05 && !bubbleFired.s1) { bubbleFired.s1 = true; createBubble(cx - 80 * scale, cy - 40 * scale, 'Скан соцсетей…', 160); }
    if (prg >= 52 && prg < 52.05 && !bubbleFired.s2) { bubbleFired.s2 = true; createBubble(cx, cy - 55 * scale, 'Кластер трендов', 160); }
    if (prg >= 108 && prg < 108.05 && !bubbleFired.s3) { bubbleFired.s3 = true; createBubble(cx + 20 * scale, cy, 'ER vs ниша', 160); }
    if (prg >= 162 && prg < 162.05 && !bubbleFired.s4) { bubbleFired.s4 = true; createBubble(cx, cy - 70 * scale, 'Гипотеза готова', 180); }
    if (prg >= 198 && prg < 198.05 && !bubbleFired.s5) { bubbleFired.s5 = true; createBubble(cx + 60 * scale, cy + 20 * scale, 'Telegram-алерт', 160); }
    if (prg < 8) { bubbleFired = {}; }

    ctx.font = 'bold 10px Inter, sans-serif';
    ctx.textAlign = 'center';
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      if (b.life > b.max - 8) alpha = (b.max - b.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawPolyRound(b.x - tw / 2, b.y - 18, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.outline;
      ctx.fillText(b.text, b.x, b.y - 7);
      ctx.globalAlpha = 1;
    }

    requestAnimationFrame(engineloop);
  }

  document.fonts.ready.then(engineloop).catch(engineloop);
})();
</script>

<div class="amk-content">

  <section class="amk-intro" id="intro" aria-label="Введение">
    <div class="amk-cnt">
      <div class="amk-intro-grid nero-ai-reveal">
        <div class="amk-intro-text">
          <p class="amk-eyebrow">Лонгрид · ai мониторинг</p>
          <p><strong>Коротко:</strong> AI-мониторинг конкурентов — это система, которая автоматически собирает публичные сигналы конкурентов в соцсетях, на сайтах и в рекламных каналах, анализирует форматы и темы с реальными метриками engagement и выдаёт команде SMM <strong>безопасные контент-гипотезы</strong> с ссылкой на источник — вместо ручного скроллинга и хаотичных таблиц.</p>
          <p>Nero Network проектирует и внедряет такие системы под ключ: от реестра конкурентов и AI-пайплайна до дашборда гипотез, интеграции с CRM и обучения команды. Ориентир проекта — <strong>100–300 тыс. ₽</strong>; стартовый шаг — <strong>бесплатный отчёт по 5 конкурентам</strong>.</p>
        </div>
        <div class="amk-intro-deco" aria-hidden="true">
          <div class="amk-pipe">collect → normalize → enrich → cluster → recommend</div>
          <div>
            <span class="amk-chip">VK · ER 4,2%</span>
            <span class="amk-chip">TG · hook</span>
            <span class="amk-chip">gap-анализ</span>
          </div>
          <div class="amk-pipe">5 конкурентов · +18% ER · human review</div>
        </div>
      </div>
    </div>
  </section>

  <div class="amk-toc-outer">
    <div class="amk-cnt">
      <nav class="amk-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#trendy-kontenta">Тренды контента</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>
  <section class="amk-section" id="chto-takoe">
    <div class="amk-cnt">
      <div class="amk-sh">
        <span class="amk-eyebrow">chto takoe</span>
        <h2>Что такое AI-мониторинг конкурентов и зачем он маркетингу в 2026</h2>
      </div>
      <div class="amk-prose nero-ai-reveal"><p><strong>Определение.</strong> AI-мониторинг конкурентов и трендов контента — не «ещё один дашборд с лайками» и не парсинг цен с маркетплейсов. Это связка из трёх слоёв: <strong>сбор</strong> публичных сигналов → <strong>анализ</strong> NLP/vision-моделями → <strong>действие</strong> в виде гипотез, алертов и задач для SMM. От классического ORM (упоминания бренда, тональность) система отличается фокусом на <strong>контент-разведку</strong>: какие темы, hooks и форматы реально «заходят» у конкурентов и как это адаптировать под ваш бренд без слепого копирования.</p>
      <p>По данным McKinsey State of AI 2025, <strong>~88%</strong> организаций уже используют AI хотя бы в одной функции, но только <strong>~39%</strong> видят измеримый EBIT-эффект. Разрыв между «пилотом» и «встроенным в процесс» особенно болезнен в маркетинге: данных много, решения нужны еженедельно, а команда по-прежнему тратит часы на ручной просмотр лент конкурентов.</p>
      <h3 class="amk-h3">Ручной мониторинг vs AI: почему таблицы и скроллинг не масштабируются</h3>
      <p>Типичный сценарий без автоматизации: SMM-специалист открывает 8–12 аккаунтов конкурентов, делает скриншоты «удачных» постов, заносит их в Google Таблицу без единой методики ER, раз в месяц пытается увидеть тренд — и всё равно упускает всплески. При росте числа конкурентов и площадок (VK, Telegram, YouTube, Shorts, блог, рекламные креативы) ручной подход <strong>не масштабируется</strong>.</p>
      <p>Кейс СКЭНД (ИИ-агент для B2B-агентства) наглядно показывает предел ручного труда: <strong>40+</strong> источников, <strong>200+</strong> новых или изменённых страниц в неделю — при ручной проверке команда пропускала важные сигналы. После внедрения агента с Crawl4AI и LLM-классификатором ручной мониторинг сократился <strong>более чем на 80%</strong>, фильтрация нерелевантного — <strong>&gt;70%</strong> (источник: <a href="https://scand.com/ru/portfolio/projects/competitor-tracker-ai-agent/" target="_blank" rel="noopener noreferrer">scand.com</a>).</p>
      <p>AI-система решает другую задачу: не заменить креатив, а дать <strong>системную картину</strong> — нормализованные метрики, кластеры трендов, diff по истории публикаций и пометку риска для каждой гипотезы.</p>
      <h3 class="amk-h3">Кому нужен AI-мониторинг: SMM, бренды, агентства, e-commerce</h3>
      <div class="amk-table-wrap"><table class="amk-table"><thead><tr><th>Сегмент</th><th>Типичная боль</th><th>Что даёт AI-мониторинг</th></tr></thead><tbody><tr><td>SMM-команды и агентства</td><td>5–15 клиентских ниш, нет единого дашборда</td><td>Единый контур разведки по конкурентам с экспортом в контент-план</td></tr><tr><td>In-house маркетологи брендов</td><td>«Кажется, у них зашли рилсы» — без цифр</td><td>ER, форматы, hooks с бенчмарком ниши</td></tr><tr><td>E-commerce</td><td>Конкуренты тестируют форматы быстрее</td><td>Алерты на аномалии engagement и новые креативы</td></tr><tr><td>Edtech / перформанс-ниши</td><td>Причины просадки «за пределами» кабинетов</td><td>Смежная разведка по рекламе и контенту (кейс Skyeng — ниже)</td></tr></tbody></table></div>
      <h3 class="amk-h3">Что AI отслеживает: соцсети, сайты, реклама, рассылки</h3>
      <p>Полноценный контур <strong>ai конкурентной разведки</strong> покрывает публичные источники:</p>
      <div class="amk-table-wrap"><table class="amk-table"><thead><tr><th>Площадка</th><th>Что собираем</th><th>Метод</th></tr></thead><tbody><tr><td>VK, Telegram</td><td>Посты, частота, ER, форматы</td><td>API / легальные коннекторы</td></tr><tr><td>YouTube, Shorts</td><td>Видео, просмотры, engagement</td><td>YouTube Data API</td></tr><tr><td>Сайты и блоги конкурентов</td><td>Статьи, лендинги, продуктовые страницы</td><td>RSS, краулер (Crawl4AI, Apify)</td></tr><tr><td>Рекламные креативы</td><td>Объявления, офферы, визуал</td><td>Кабинеты + внешние сервисы</td></tr><tr><td>Отзовики, СМИ</td><td>Упоминания, сравнения</td><td>Social listening / web search</td></tr></tbody></table></div>
      <p>Для российского рынка Nero Network ставит <strong>VK и Telegram</strong> в приоритет first-class источников — в отличие от западных SaaS, ориентированных на X и Threads.</p></div>
    </div>
  </section>

  <section class="amk-section amk-section-alt" id="kak-rabotaet">
    <div class="amk-cnt">
      <div class="amk-sh">
        <span class="amk-eyebrow">kak rabotaet</span>
        <h2>Как работает AI-разведка: от сбора данных до контент-гипотез</h2>
      </div>
      <div class="amk-prose nero-ai-reveal"><p><strong>Коротко:</strong> пайплайн идёт по цепочке Collect → Normalize → Enrich → Cluster → Recommend → Alert → Review. Каждый инсайт привязан к URL — это защита от галлюцинаций LLM.</p>
      <h3 class="amk-h3">Источники данных и пайплайн сбора (RSS, API, парсинг, алерты)</h3>
      <ol class="amk-ol">
      <li><strong>Source Registry</strong> — реестр 5–15 конкурентов: аккаунты, домены, каналы.</li>
      <li><strong>Ingestion Workers</strong> — по расписанию (1–6 ч для «горячих» соцсетей, 1×/день для сайтов) агенты захватывают новые публикации.</li>
      <li><strong>Нормализация</strong> — единая схема: `platform, url, text, format, posted_at, likes, comments, shares, views, author, competitor_id`.</li>
      <li><strong>Дедупликация и diff</strong> — сравнение с прошлой версией; история постов хранится в Content Store (БД или Google Sheets).</li>
      </ol>
      <p>Just AI на Habr описывает типичную проблему RSS-мониторинга: «грязные данные» и невозможность быстро масштабировать объекты. Переход на real-time search API (Tavily) + мультиагентную архитектуру решил задачу гибкой смены ключевых слов без переписывания логики (<a href="https://habr.com/ru/companies/just_ai/articles/1022972/" target="_blank" rel="noopener noreferrer">habr.com</a>).</p>
      <p>Для DIY-сценариев существуют шаблоны n8n + Apify + GPT-4: ежедневный скрапинг → LLM-анализ → отчёт в Slack/Sheets при инфраструктурных затратах порядка <strong>$35–45/мес</strong> против <strong>$300–2000/мес</strong> у enterprise CI (<a href="https://n8n.io/workflows/6672-ai-driven-competitor-and-market-intelligence-with-gpt-4-and-apify/" target="_blank" rel="noopener noreferrer">n8n.io</a>). Nero Network берёт на себя проектирование такого контура «под ключ», чтобы команда не собирала его месяцами на коленке.</p>
      <h3 class="amk-h3">NLP и vision-анализ: форматы, hooks, engagement, темы</h3>
      <p><strong>AI анализ контента конкурентов</strong> на слое Enrich извлекает:</p>
      <ul class="amk-ul">
      <li>тему и подтему публикации;</li>
      <li>формат (reels, shorts, carousel, лонгрид, сторис);</li>
      <li>hook — первые 1–3 секунды или строки;</li>
      <li>CTA и оффер;</li>
      <li>эмоциональный тон;</li>
      <li>гипотезу «почему могло зайти» (с пометкой: гипотеза, не факт).</li>
      </ul>
      <p>Fistashki в кейсе T2 показали, зачем нужен LLM не «для красивых summary», а для <strong>смыслов и контекста</strong>: пять моделей размечали иронию и нюансы в миллионах упоминаний — классический keyword-ORM не масштабировался (<a href="https://workspace.ru/cases/obrabotka-gigantskogo-chisla-upominaniy-mobilnogo-operatora-t2-i-konkurentov/" target="_blank" rel="noopener noreferrer">workspace.ru</a>).</p>
      <p>Vision-модели дополняют текст там, где важен визуал: композиция креатива, наличие лица в кадре, стиль монтажа short-form.</p>
      <h3 class="amk-h3">Кластеризация трендов и «безопасные» гипотезы для команды</h3>
      <p>На этапе Cluster система формирует еженедельные кластеры: «образовательные карусели», «кейсы с цифрами», «провокационные hooks». Hypothesis Generator выдаёт <strong>5–10 безопасных гипотез</strong> с полями:</p>
      <ul class="amk-ul">
      <li>источник-референс (URL);</li>
      <li>риск копирования (низкий / средний / высокий);</li>
      <li>идея адаптации под бренд клиента;</li>
      <li>brand fit и юридические ограничения.</li>
      </ul>
      <p><strong>Безопасные контент-гипотезы</strong> — ключевой угол Nero Network: мы не предлагаем копипаст, а даём адаптированные идеи с оценкой риска. SMM-лид утверждает гипотезы в human-in-the-loop перед попаданием в контент-план.</p>
      <p>McKinsey фиксирует: high performers в <strong>2,8 раза</strong> чаще перестраивают workflow end-to-end; <strong>65%</strong> лидеров vs <strong>23%</strong> остальных имеют формализованный human-validation для выходов моделей — это стандарт, который Nero закладывает в регламент с первого дня.</p></div>
    </div>
  </section>


  <!-- INTERNAL-LINKS:INSERT -->

<section id="ai-monitoring-konkurentov-boris-block" class="amk-root" aria-label="Анимация: пайплайн AI-разведки от сигналов конкурентов до безопасных гипотез">
<style>
/* === БОРИС: prefix amk-, scoped внутри #ai-monitoring-konkurentov-boris-block === */
#ai-monitoring-konkurentov-boris-block.amk-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-monitoring-konkurentov-boris-block .amk-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 20px;
}
#ai-monitoring-konkurentov-boris-block .amk-card{
  display:grid;
  grid-template-columns:42% 58%;
  border-radius:22px;
  overflow:hidden;
  background:#ffffff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #ai-monitoring-konkurentov-boris-block .amk-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-monitoring-konkurentov-boris-block .amk-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-monitoring-konkurentov-boris-block .amk-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-monitoring-konkurentov-boris-block .amk-ey{
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
#ai-monitoring-konkurentov-boris-block .amk-ey::before{
  content:'';
  display:inline-block;
  width:18px;
  height:2px;
  background:#6366f1;
  border-radius:1px;
}
#ai-monitoring-konkurentov-boris-block .amk-h3{
  font-size:23px;
  font-weight:800;
  color:#0f172a;
  line-height:1.32;
  margin:0 0 18px;
}
@media(max-width:600px){
  #ai-monitoring-konkurentov-boris-block .amk-h3{font-size:19px;}
}
#ai-monitoring-konkurentov-boris-block .amk-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-monitoring-konkurentov-boris-block .amk-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-monitoring-konkurentov-boris-block .amk-ic{
  flex-shrink:0;
  width:22px;
  height:22px;
  border-radius:50%;
  background:rgba(99,102,241,.1);
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:10px;
  color:#6366f1;
  margin-top:1px;
  font-style:normal;
  font-weight:700;
}
#ai-monitoring-konkurentov-boris-block .amk-pills{
  display:flex;
  flex-wrap:wrap;
  gap:7px;
  margin-bottom:18px;
}
#ai-monitoring-konkurentov-boris-block .amk-pl{
  padding:5px 11px;
  border-radius:99px;
  font-size:11.5px;
  font-weight:700;
  white-space:nowrap;
}
#ai-monitoring-konkurentov-boris-block .amk-pl-g{
  background:rgba(34,197,94,.09);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-monitoring-konkurentov-boris-block .amk-pl-b{
  background:rgba(99,102,241,.09);
  color:#4338ca;
  border:1.5px solid rgba(99,102,241,.22);
}
#ai-monitoring-konkurentov-boris-block .amk-pl-a{
  background:rgba(245,158,11,.09);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.25);
}
#ai-monitoring-konkurentov-boris-block .amk-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-monitoring-konkurentov-boris-block .amk-rgt{
  position:relative;
  background:linear-gradient(160deg,#f1f5f9 0%,#e8eef7 45%,#f8fafc 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-monitoring-konkurentov-boris-block .amk-rgt{min-height:360px;}
}
#amk-signal-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="amk-cnt">
  <div class="amk-card">
    <div class="amk-lft">
      <span class="amk-ey">Пайплайн разведки</span>
      <h3 class="amk-h3">От ленты конкурентов — к проверяемым гипотезам с URL</h3>
      <ul class="amk-ul">
        <li><span class="amk-ic">1</span><strong>Collect</strong> — VK, Telegram, Shorts и сайты в единый поток сигналов</li>
        <li><span class="amk-ic">2</span><strong>Enrich</strong> — NLP выделяет формат, hook и engagement по каждому посту</li>
        <li><span class="amk-ic">3</span><strong>Cluster</strong> — AI группирует тренды недели и отсекает шум</li>
        <li><span class="amk-ic">4</span><strong>Recommend</strong> — безопасные гипотезы с риском и ссылкой на источник</li>
      </ul>
      <div class="amk-pills">
        <span class="amk-pl amk-pl-g">Evidence: URL на каждый инсайт</span>
        <span class="amk-pl amk-pl-b">Human review перед планом</span>
        <span class="amk-pl amk-pl-a">Алерт при аномалии ER</span>
      </div>
      <p class="amk-foot">Дальше — метрики social listening и сравнение с SaaS →</p>
    </div>
    <div class="amk-rgt">
      <canvas
        id="amk-signal-pipeline-canvas"
        role="img"
        aria-label="Анимация: сигналы с площадок конкурентов проходят через AI-хаб и превращаются в карточки контент-гипотез с оценкой риска"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function amkSignalPipelineEngine(){
  var cv = document.getElementById('amk-signal-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, fr = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width;
    H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a',
    muted:'#64748b',
    line:'rgba(99,102,241,.18)',
    hub:'#6366f1',
    hubGlow:'rgba(99,102,241,.22)',
    vk:'#0077ff',
    tg:'#229ed9',
    yt:'#ef4444',
    web:'#10b981',
    card:'#ffffff',
    cardBdr:'rgba(15,23,42,.1)',
    safe:'#22c55e',
    warn:'#f59e0b',
    risk:'#ef4444'
  };

  var sources = [
    {id:'VK', color:C.vk, angle:2.35, r:0.34},
    {id:'TG', color:C.tg, angle:3.55, r:0.34},
    {id:'YT', color:C.yt, angle:4.75, r:0.34},
    {id:'WEB', color:C.web, angle:5.95, r:0.34}
  ];

  var packets = [];
  var hypotheses = [
    {label:'Reels · hook «цифры»', risk:'low', delay:0},
    {label:'Карусель · кейс', risk:'low', delay:90},
    {label:'Shorts · тренд', risk:'mid', delay:180},
    {label:'Gap: 3 темы', risk:'low', delay:270}
  ];
  var outCards = hypotheses.map(function(h){
    return {label:h.label, risk:h.risk, delay:h.delay, prog:0, alpha:0};
  });

  function hubPos(){
    return {x: W * 0.38, y: H * 0.5};
  }
  function srcPos(s){
    var hp = hubPos();
    var rad = Math.min(W, H) * s.r;
    return {x: hp.x + Math.cos(s.angle) * rad, y: hp.y + Math.sin(s.angle) * rad};
  }
  function outZone(){
    return {x: W * 0.72, y: H * 0.18, w: W * 0.22, h: H * 0.64};
  }

  function spawnPacket(){
    var s = sources[Math.floor(Math.random() * sources.length)];
    var from = srcPos(s);
    var to = hubPos();
    packets.push({
      x: from.x, y: from.y,
      tx: to.x, ty: to.y,
      t: 0,
      speed: 0.012 + Math.random() * 0.01,
      color: s.color,
      src: s.id
    });
  }

  function riskColor(r){
    if (r === 'low') return C.safe;
    if (r === 'mid') return C.warn;
    return C.risk;
  }
  function riskLabel(r){
    if (r === 'low') return 'низкий риск';
    if (r === 'mid') return 'средний';
    return 'высокий';
  }

  function roundRect(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle = fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function drawHub(hp){
    var pulse = 0.5 + 0.5 * Math.sin(fr * 0.04);
    var r = Math.min(W,H) * 0.09 + pulse * 4;
    var g = ctx.createRadialGradient(hp.x, hp.y, r*0.2, hp.x, hp.y, r*2.2);
    g.addColorStop(0, C.hubGlow);
    g.addColorStop(1, 'rgba(99,102,241,0)');
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(hp.x, hp.y, r*2.2, 0, Math.PI*2);
    ctx.fill();

    roundRect(hp.x - r, hp.y - r, r*2, r*2, r*0.35, '#ffffff', C.hub);
    ctx.fillStyle = C.hub;
    ctx.font = 'bold ' + Math.max(11, r*0.38) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('AI', hp.x, hp.y - r*0.15);
    ctx.font = Math.max(9, r*0.22) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('cluster', hp.x, hp.y + r*0.28);

    var ring = r + 8 + pulse * 3;
    ctx.strokeStyle = 'rgba(99,102,241,' + (0.25 + pulse*0.2) + ')';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(hp.x, hp.y, ring, 0, Math.PI*2);
    ctx.stroke();
  }

  function drawSource(s){
    var p = srcPos(s);
    var sz = Math.max(28, Math.min(W,H)*0.055);
    roundRect(p.x - sz/2, p.y - sz/2, sz, sz, 10, '#fff', s.color);
    ctx.fillStyle = s.color;
    ctx.font = 'bold ' + Math.max(9, sz*0.28) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(s.id, p.x, p.y);

    var hp = hubPos();
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([5,6]);
    ctx.beginPath();
    ctx.moveTo(p.x, p.y);
    ctx.lineTo(hp.x, hp.y);
    ctx.stroke();
    ctx.setLineDash([]);
  }

  function drawOutPanel(oz){
    roundRect(oz.x, oz.y, oz.w, oz.h, 14, 'rgba(255,255,255,.72)', 'rgba(148,163,184,.35)');
    ctx.fillStyle = C.ink;
    ctx.font = 'bold ' + Math.max(10, oz.w*0.09) + 'px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Гипотезы', oz.x + 12, oz.y + 22);
    ctx.fillStyle = C.muted;
    ctx.font = Math.max(8, oz.w*0.07) + 'px system-ui,sans-serif';
    ctx.fillText('на ревью', oz.x + 12, oz.y + 36);

    var cardH = (oz.h - 52) / outCards.length - 6;
    outCards.forEach(function(card, i){
      if (fr < card.delay) return;
      card.prog = Math.min(1, card.prog + 0.02);
      card.alpha = Math.min(1, card.alpha + 0.03);
      var cy = oz.y + 48 + i * (cardH + 6);
      var slide = (1 - card.prog) * 24;
      ctx.globalAlpha = card.alpha;
      roundRect(oz.x + 10 - slide, cy, oz.w - 20, cardH, 8, C.card, C.cardBdr);
      var rc = riskColor(card.risk);
      roundRect(oz.x + 14 - slide, cy + 6, 4, cardH - 12, 2, rc, rc);
      ctx.fillStyle = C.ink;
      ctx.font = Math.max(9, oz.w*0.075) + 'px system-ui,sans-serif';
      ctx.fillText(card.label, oz.x + 22 - slide, cy + cardH*0.42);
      ctx.fillStyle = rc;
      ctx.font = Math.max(7.5, oz.w*0.065) + 'px system-ui,sans-serif';
      ctx.fillText(riskLabel(card.risk), oz.x + 22 - slide, cy + cardH*0.78);
      ctx.globalAlpha = 1;
    });
  }

  function drawBeam(hp, oz){
    ctx.strokeStyle = 'rgba(99,102,241,.35)';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(hp.x + Math.min(W,H)*0.09, hp.y);
    ctx.bezierCurveTo(hp.x + W*0.15, hp.y - 20, oz.x - 20, oz.y + oz.h*0.5, oz.x, oz.y + oz.h*0.5);
    ctx.stroke();
    var dotT = (fr * 0.02) % 1;
    var bx = hp.x + (oz.x - hp.x) * dotT;
    var by = hp.y + (oz.y + oz.h*0.5 - hp.y) * dotT;
    ctx.fillStyle = C.hub;
    ctx.beginPath();
    ctx.arc(bx, by, 4, 0, Math.PI*2);
    ctx.fill();
  }

  function tick(){
    fr++;
    ctx.clearRect(0, 0, W, H);

    if (fr % 38 === 0) spawnPacket();

    var hp = hubPos();
    var oz = outZone();

    sources.forEach(drawSource);
    drawHub(hp);
    drawBeam(hp, oz);
    drawOutPanel(oz);

    packets = packets.filter(function(p){
      p.t += p.speed;
      p.x += (p.tx - p.x) * p.speed * 1.8;
      p.y += (p.ty - p.y) * p.speed * 1.8;
      if (p.t >= 1) return false;
      ctx.fillStyle = p.color;
      ctx.beginPath();
      ctx.arc(p.x, p.y, 4, 0, Math.PI*2);
      ctx.fill();
      ctx.fillStyle = 'rgba(255,255,255,.9)';
      ctx.beginPath();
      ctx.arc(p.x, p.y, 2, 0, Math.PI*2);
      ctx.fill();
      return true;
    });

    if (fr > 420){
      outCards.forEach(function(c){ c.prog = 0; c.alpha = 0; c.delay = fr + Math.random()*60; });
      fr = 0;
    }

    requestAnimationFrame(tick);
  }
  tick();
})();
</script>
</section>


  <section class="amk-section" id="social-listening">
    <div class="amk-cnt">
      <div class="amk-sh">
        <span class="amk-eyebrow">social listening</span>
        <h2>AI social listening и мониторинг конкурентов в соцсетях</h2>
      </div>
      <div class="amk-prose nero-ai-reveal"><p><strong>AI social listening</strong> в контексте конкурентной разведки — не только упоминания вашего бренда, а системное отслеживание <strong>контент-стратегии конкурентов</strong>: что публикуют, как часто, в каких форматах и с каким engagement.</p>
      <h3 class="amk-h3">Метрики «что заходит»: ER, частота, форматы (reels, shorts, carousel)</h3>
      <div class="amk-table-wrap"><table class="amk-table"><thead><tr><th>Метрика</th><th>Зачем</th><th>Ориентиры по нише</th></tr></thead><tbody><tr><td>Engagement Rate (ER)</td><td>Сравнение постов и аккаунтов</td><td>TikTok ~2,5%, Instagram ~0,5% (Socialinsider, 2023–2024)</td></tr><tr><td>Частота публикаций</td><td>Ритм и «окна» для тестов</td><td>Бенчмарк по 5 конкурентам</td></tr><tr><td>Формат</td><td>Reels / Shorts / carousel / текст</td><td>Short-form: рост ~70% у пользователей Metricool (2025, 5+ млн видео)</td></tr><tr><td>Hook и тема</td><td>Что цепляет в первые секунды</td><td>LLM-извлечение + ручная валидация</td></tr><tr><td>Share of voice</td><td>Доля обсуждений в нише</td><td>Для брендов с ORM-контуром</td></tr></tbody></table></div>
      <p>YouTube Shorts в обзорах 2025 показывает ER порядка <strong>~5,9%</strong> — сильный игрок в short-form наряду с Reels и TikTok. <strong>~66%</strong> маркетологов уже используют AI для задач в соцсетях (расписание, подписи, аналитика) — но ChatGPT сам по себе <strong>не видит</strong> live ER конкурентов и не хранит историю их постов.</p>
      <h3 class="amk-h3">Сравнение с ручным social listening и дашбордами</h3>
      <p>Зрелые платформы — Brand Analytics, YouScan, IQBuzz в РФ; Brandwatch, Sprout Social глобально — дают мощный ORM и дашборды. Sprout Social в мае 2026 представил Trellis: conversational AI поверх listening — вопрос на естественном языке («какие темы дали engagement конкуренту X в квартале?») и готовый ответ (<a href="https://sproutsocial.com/insights/press/sprout-social-unveils-its-ai-powered-social-intelligence-platform-and-the-expansion-of-its-proprietary-ai-agent-trellis/" target="_blank" rel="noopener noreferrer">sproutsocial.com</a>).</p>
      <p><strong>Где SaaS не закрывает задачу SMM целиком:</strong></p>
      <ul class="amk-ul">
      <li>фокус на упоминаниях бренда, а не на <strong>контент-гипотезах</strong> для вашего календаря;</li>
      <li>слабая связка «тренд → задача в CRM → замер результата»;</li>
      <li>для РФ — приоритет VK/Telegram и закрытый контур (YandexGPT/GigaChat) часто требуют кастомного внедрения.</li>
      </ul>
      <p>Кейс Brand Analytics + «Лемана ПРО» (AdIndex, 2026): аналитические теги «Сравнение с конкурентом», контентные теги UGC/ESG — рост охвата упоминаний, в <strong>2,5 раза</strong> больше ESG-упоминаний за счёт системной работы (<a href="https://adindex.ru/case/2026/04/8/344031.phtml" target="_blank" rel="noopener noreferrer">adindex.ru</a>). Это образец структуры тегов «конкурент / тема / формат», которую Nero адаптирует под контент-план клиента.</p>
      <h3 class="amk-h3">Ограничения ToS соцсетей и юридические рамки сбора</h3>
      <p>Публичный скрапинг соцсетей — зона юридических рисков. Nero Network:</p>
      <ul class="amk-ul">
      <li>приоритизирует <strong>официальные API</strong> и rate limits;</li>
      <li>не обещает «обход блокировок»;</li>
      <li>проводит legal-check на этапе брифа;</li>
      <li>не тащит лишние персональные данные из комментариев в отчёты.</li>
      </ul>
      <p><em>Instagram/Meta — продукты Meta; в РФ доступ и реклама ограничены — учитываем при проектировании источников.</em></p></div>
    </div>
  </section>

  <section class="amk-section amk-section-alt" id="trendy-kontenta">
    <div class="amk-cnt">
      <div class="amk-sh">
        <span class="amk-eyebrow">trendy kontenta</span>
        <h2>AI тренды контента и идеи для SMM на основе конкурентов</h2>
      </div>
      <div class="amk-prose nero-ai-reveal"><p><strong>AI тренды контента</strong> — это не модные слова из ChatGPT, а кластеры тем с измеримой динамикой engagement у конкурентов за выбранный период. <strong>AI идеи контента</strong> рождаются на стыке тренда, gap-анализа и brand guidelines клиента.</p>
      <h3 class="amk-h3">Как AI выделяет растущие темы и угасающие форматы</h3>
      <p>Алгоритм сравнивает неделю N с неделей N−1 и N−4:</p>
      <ul class="amk-ul">
      <li>растущие темы — рост числа постов и median ER выше медианы ниши;</li>
      <li>угасающие форматы — падение ER при сохранении частоты (сигнал «аудитория устала»);</li>
      <li>аномалии — единичный вирусный пост (отдельный алерт, не автоматический тренд).</li>
      </ul>
      <p>BuzzSumo позиционирует датасет <strong>500M+</strong> материалов как анти-галлюцинационный слой: AI-подсказки углов и заголовков строятся на <strong>реальных</strong> performance-данных, а не на generic LLM (<a href="https://buzzsumo.com/" target="_blank" rel="noopener noreferrer">buzzsumo.com</a>).</p>
      <h3 class="amk-h3">От тренда к контент-плану: дашборд гипотез и приоритизация</h3>
      <p>Типовой дашборд Nero Network содержит:</p>
      <ol class="amk-ol">
      <li><strong>Тренды недели</strong> — 3 растущие, 2 угасающие темы.</li>
      <li><strong>Топ-посты конкурентов</strong> — с ER, hook, гипотезой.</li>
      <li><strong>Gap-анализ</strong> — темы у конкурентов, которых нет у клиента.</li>
      <li><strong>Очередь гипотез</strong> — приоритет по impact × ease × риск.</li>
      <li><strong>Статус</strong> — черновик / на ревью / в продакшне / опубликовано.</li>
      </ol>
      <p>Еженедельный Telegram-дайджест: «что тестировать на этой неделе» — проактивная модель по аналогии с Klue Compete Agent и Crayon Sparks (автодоставка CI в Slack/CRM с human oversight).</p>
      <h3 class="amk-h3">Пример структуры отчёта по 5 конкурентам (лид-магнит)</h3>
      <p>Бесплатный <strong>отчёт по 5 конкурентам</strong> — лид-магнит Nero Network. Структура, которая убеждает заказчика без перегруза:</p>
      <div class="amk-table-wrap"><table class="amk-table"><thead><tr><th>Блок</th><th>Содержание</th></tr></thead><tbody><tr><td>Executive summary</td><td>3 инсайта недели + 1 риск</td></tr><tr><td>Карта конкурентов</td><td>5 профилей: частота, топ-формат, средний ER</td></tr><tr><td>Топ-3 поста каждого</td><td>ссылка, ER, тема, hook, гипотеза «почему зашло»</td></tr><tr><td>Тренды</td><td>3 растущие темы, 2 угасающие</td></tr><tr><td>Gap-анализ</td><td>темы конкурентов без вас</td></tr><tr><td>Безопасные гипотезы</td><td>5 идей с адаптацией под бренд</td></tr><tr><td>Следующий шаг</td><td>CTA «Проверить конкурентов»</td></tr></tbody></table></div>
          <aside class="ym-cta-block ym-cta-block--primary" id="cta-otchet">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получите отчёт по 5 конкурентам бесплатно</p>
        <p class="ym-cta-block__sub">За 7 дней подготовим карту ER, топ-посты, тренды недели и 5 безопасных контент-гипотез с адаптацией под ваш бренд — тот же формат, что станет ядром полного внедрения.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить конкурентов</a>
      </div>
    </aside>
      <p>Конкуренты в топе выдачи по запросу «ai мониторинг конкурентов» редко показывают <strong>живой пример</strong> такого отчёта — для Nero это сознательное отличие.</p></div>
    </div>
  </section>

  <section class="amk-section" id="vnedrenie">
    <div class="amk-cnt">
      <div class="amk-sh">
        <span class="amk-eyebrow">vnedrenie</span>
        <h2>Внедрение AI-мониторинга конкурентов под ключ: этапы и сроки</h2>
      </div>
      <div class="amk-prose nero-ai-reveal"><p><strong>Внедрение ai мониторинг конкурентов</strong> в Nero Network — проект на <strong>4–6 недель</strong> от брифа до пилота с обучением команды. Ниже — реалистичная модель под чек <strong>100–300 тыс. ₽</strong> (проектная схема Nero Network, не публичный кейс).</p>
      <h3 class="amk-h3">Аудит конкурентов и постановка KPI разведки</h3>
      <p><strong>Фаза 0 (1–2 дня):</strong> бриф — ниша, 5–15 конкурентов, площадки, KPI (охват, ER, лиды — не vanity metrics). Legal-check публичных данных. Согласование этических границ: кого не отслеживаем.</p>
      <p><strong>Фаза 1 (неделя 1):</strong> инвентаризация источников, white-list доменов и аккаунтов, расписание сбора.</p>
      <h3 class="amk-h3">Проектирование AI-пайплайна и выбор стека (LLM, Make/n8n, дашборд)</h3>
      <p><strong>Фаза 2 (недели 2–3):</strong> пайплайн сбора (API → RSS → Apify/краулер), нормализация, Content Store.</p>
      <p><strong>Фаза 3 (недели 3–4):</strong> AI-слой — embedding-кластеризация, scoring безопасности гипотез, RAG только по собранным постам клиента (не «общие знания» модели).</p>
      <p>Стек типового проекта:</p>
      <ul class="amk-ul">
      <li>оркестрация: <strong>Make.com</strong> или <strong>n8n</strong>;</li>
      <li>скрапинг/API: <strong>Apify</strong>, VK API, YouTube Data API;</li>
      <li>AI: Claude/GPT для анализа; YandexGPT/GigaChat для ПДн и закрытого контура;</li>
      <li>дашборд: Google Sheets, Notion или лёгкий web;</li>
      <li>уведомления: Telegram-бот.</li>
      </ul>
      <p>Прозрачный стек снижает страх «чёрного ящика» — один из пробелов конкурентов в выдаче.</p>
      <h3 class="amk-h3">Пилот → масштабирование: обучение команды и регламенты</h3>
      <p><strong>Фаза 4 (недели 4–5):</strong> дашборд + Telegram-дайджест + интеграция с контент-планом; обучение SMM; SLA на human review.</p>
      <p><strong>Фаза 5:</strong> пилот 2–4 недели, калибровка порогов алертов, handoff документации.</p>
      <p><strong>Что нужно от клиента для старта:</strong> список конкурентов, brand guidelines, 3–6 месяцев собственной статистики для baseline, контакт SMM-лида для калибровки «безопасных» тем.</p>
          <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите разобраться в AI-разведке до старта проекта?</p>
        <p class="ym-cta-block__sub">Если команда планирует собирать мониторинг на Make/n8n самостоятельно — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#'); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer">обучение по внедрению AI в бизнес-процессы</a>. Это ускоряет бриф, пилот и human-in-the-loop на этапе калибровки гипотез.</p>
      </div>
    </aside></div>
    </div>
  </section>

    <!-- INTERNAL-LINKS:INSERT -->

<section class="amk-section amk-section-alt" id="integraciya">
    <div class="amk-cnt">
      <div class="amk-sh">
        <span class="amk-eyebrow">integraciya</span>
        <h2>Интеграция с CRM, таблицами и автоматизация Make/n8n</h2>
      </div>
      <div class="amk-prose nero-ai-reveal"><p><strong>Интеграция ai мониторинг конкурентов с crm</strong> превращает разведку из «красивого PDF» в рабочий процесс: гипотеза → задача → публикация → замер.</p>
      <h3 class="amk-h3">Выгрузка гипотез в CRM, Notion, Google Sheets</h3>
      <p>Поддерживаемые контуры:</p>
      <ul class="amk-ul">
      <li><strong>amoCRM, Bitrix24</strong> — задачи «снять референс», «запустить тест поста», дедлайн и ответственный;</li>
      <li><strong>Google Sheets / Notion</strong> — дашборд гипотез с фильтрами по статусу и риску;</li>
      <li><strong>Trello, Asana</strong> — через webhook из Make/n8n.</li>
      </ul>
      <p>Каждая запись содержит URL источника, скрин/превью, ER, текст гипотезы, пометку риска.</p>
      <h3 class="amk-h3">Триггеры и сценарии: алерты, еженедельные дайджесты, таски SMM</h3>
      <p>Типовые сценарии автоматизации:</p>
      <ol class="amk-ol">
      <li><strong>Аномалия ER</strong> у конкурента → Telegram-алерт SMM-лиду в течение 1–6 ч.</li>
      <li><strong>Понедельник 09:00</strong> → еженедельный дайджест «5 гипотез на неделю».</li>
      <li><strong>Утверждённая гипотеза</strong> → задача в CRM с дедлайном и шаблоном брифа для дизайнера.</li>
      <li><strong>Новый формат</strong> у конкурента (первый reels с ER &gt;2× медианы) → эскалация на маркетинг-директора.</li>
      </ol>
      <h3 class="amk-h3">Связка с внедрением ai в бизнес-процессы маркетинга</h3>
      <p>AI-мониторинг конкурентов — точечное <strong>внедрение ai в бизнес процессы</strong> маркетинга с измеримым ROI: не «нейросеть ради нейросети», а закрытый цикл «сигнал → гипотеза → контент → метрика». Это согласуется с трендом <strong>внедрение ai агентов</strong> в операционные workflow — по данным McKinsey, <strong>~72%</strong> организаций используют gen AI, но почти <strong>2/3</strong> ещё не масштабировали AI на всю компанию. Мониторинг конкурентов — понятная «первая победа» с быстрым payback для SMM-команды.</p></div>
    </div>
  </section>

  <section class="amk-section" id="stoimost">
    <div class="amk-cnt">
      <div class="amk-sh">
        <span class="amk-eyebrow">stoimost</span>
        <h2>Стоимость и ROI: AI-мониторинг конкурентов для бизнеса</h2>
      </div>
      <div class="amk-prose nero-ai-reveal"><p><strong>AI мониторинг конкурентов цена</strong> зависит от числа источников, глубины AI-анализа и интеграций — не от «количества нейросетей в презентации».</p>
      <h3 class="amk-h3">Из чего складывается чек 100–300 тыс. ₽ (источники, интеграции, поддержка)</h3>
      <div class="amk-table-wrap"><table class="amk-table"><thead><tr><th>Компонент</th><th>Что входит</th><th>Влияние на бюджет</th></tr></thead><tbody><tr><td>Аудит и проектирование</td><td>Конкуренты, KPI, legal</td><td>База</td></tr><tr><td>Пайплайн сбора</td><td>5–15 конкурентов, 3–6 площадок</td><td>+за каждый источник</td></tr><tr><td>AI-слой</td><td>Классификация, кластеры, гипотезы</td><td>Ядро проекта</td></tr><tr><td>Дашборд и отчёты</td><td>Sheets/Notion/web + PDF</td><td>Стандарт</td></tr><tr><td>Интеграции CRM</td><td>amoCRM, Bitrix24, Make/n8n</td><td>+15–30%</td></tr><tr><td>Обучение и пилот</td><td>2–4 недели, регламенты</td><td>Включено</td></tr><tr><td>Поддержка (опционально)</td><td>Калибровка, новые конкуренты</td><td>Ежемесячно</td></tr></tbody></table></div>
      <p>Для сравнения: российские SaaS конкурентной разведки (Signum.AI и аналоги) стартуют от <strong>~25 000 ₽/мес</strong> по заявлениям агрегаторов — за год это сопоставимо с разовым внедрением, но без кастомизации под ваши VK/Telegram-источники и CRM-процесс.</p>
      <h3 class="amk-h3">Экономия часов SMM и снижение риска «слепого» копирования</h3>
      <p>Качественные эффекты (без выдуманных цифр для Nero):</p>
      <ul class="amk-ul">
      <li>сокращение ручного «скроллинга» конкурентов;</li>
      <li>системный контент-план на данных, а не интуиции;</li>
      <li>быстрее реакция на вирусные форматы;</li>
      <li>меньше «слепых» тестов и копипаста без адаптации.</li>
      </ul>
      <p>Осторожные ориентиры из чужих кейсов: СКЭНД — <strong>−80%</strong> ручного мониторинга; Skyeng + «НАУМ» — <strong>−32%</strong> CPC и <strong>−41%</strong> недельного бюджета в Директе при сохранении выкупа (<a href="https://adindex.ru/case/2026/04/21/344389.phtml" target="_blank" rel="noopener noreferrer">adindex.ru</a>).</p>
      <h3 class="amk-h3">Когда достаточно пилота, а когда нужен полный контур</h3>
      <div class="amk-table-wrap"><table class="amk-table"><thead><tr><th>Ситуация</th><th>Рекомендация</th></tr></thead><tbody><tr><td>3–5 конкурентов, 1–2 площадки</td><td>Пилот + отчёт (лид-магнит)</td></tr><tr><td>Агентство, 10+ ниш</td><td>Полный контур с мульти-дашбордом</td></tr><tr><td>E-commerce + перформанс</td><td>Расширение на рекламную разведку</td></tr><tr><td><strong>AI мониторинг конкурентов для малого бизнеса</strong></td><td>Пакет «5 конкурентов», Sheets + Telegram</td></tr></tbody></table></div></div>
    </div>
  </section>

  <section class="amk-section amk-section-alt" id="keisy">
    <div class="amk-cnt">
      <div class="amk-sh">
        <span class="amk-eyebrow">keisy</span>
        <h2>Кейсы и примеры внедрения AI-мониторинга конкурентов</h2>
      </div>
      <div class="amk-prose nero-ai-reveal"><p><strong>AI мониторинг конкурентов кейсы</strong> в России чаще связаны с ORM, мониторингом сайтов и рекламой, чем с чистым SMM-контентом — поэтому Nero опирается на проверенные паттерны и адаптирует их под контент-гипотезы.</p>
      <h3 class="amk-h3">Кейс агентства: единый дашборд по клиентским нишам</h3>
      <p><strong>Паттерн:</strong> B2B-агентство (аналог СКЭНД) — <strong>40+</strong> источников, LLM фильтрует <strong>&gt;70%</strong> шума, алерты в Telegram с историей diff. Для SMM-агентства Nero масштабирует модель: отдельный workspace на клиента, единый шаблон отчёта, white-label для презентаций заказчику.</p>
      <p><strong>Результат:</strong> реакция на изменения у конкурентов ускоряется <strong>~60%</strong> (метрика из кейса СКЭНД).</p>
      <h3 class="amk-h3">Кейс бренда/e-commerce: от разведки к контент-календарю</h3>
      <p><strong>Паттерн Skyeng + «НАУМ»:</strong> внешний сервис собирает сигналы аукциона и активности конкурентов вне кабинетов Директа — команда принимает решения по ставкам и стратегии. Для e-commerce Nero добавляет слой <strong>контент-разведки</strong>: какие креативы и темы поддерживают перформанс у конкурентов.</p>
      <p><strong>Результат:</strong> −32% CPC, −41% недельного бюджета при сохранении выкупа.</p>
      <p><strong>Паттерн Brand Analytics + «Лемана ПРО»:</strong> конкурентные теги в соцмедиа → контент-инсайты и UGC-истории. Nero переносит логику на <strong>идеи для контента на основе конкурентов</strong> с привязкой к календарю.</p>
      <h3 class="amk-h3">Чек-лист «готовности» к внедрению</h3>
      <p><strong>Международные аналоги</strong> для ориентира: Sprout Trellis (conversational CI), BuzzSumo (content benchmarking), Crayon Sparks и Klue Compete Agent (proactive CI в Slack/CRM). Nero адаптирует UX «спросил — получил гипотезу» под VK/Telegram и российский контур.</p>
      <ul class="amk-checklist"><li>Есть список 5–15 конкурентов с URL/аккаунтами</li><li>Определены 2–3 KPI (ER, охват, лиды — не «лайки ради лайков»)</li><li>Есть SMM-ответственный для human review</li><li>Brand guidelines доступны для scoring «безопасности»</li><li>Согласованы юридические границы сбора данных</li><li>Контент-план или рубрикатор — куда лягут гипотезы</li><li>CRM или таблица — куда экспортировать задачи</li></ul></div>
    </div>
  </section>

  <section class="amk-section" id="faq">
    <div class="amk-cnt">
      <div class="amk-sh">
        <span class="amk-eyebrow">faq</span>
        <h2>FAQ: как внедрить, риски LLM и отличие от SaaS-платформ</h2>
      </div>
      <div class="amk-faq nero-ai-reveal"><div class="amk-faq-item">
          <div class="amk-faq-q" tabindex="0" role="button" aria-expanded="false">AI-мониторинг vs Brandwatch / BuzzSumo / Mention — что автоматизируется</div>
          <div class="amk-faq-a"><div class="amk-table-wrap"><table class="amk-table"><thead><tr><th>Критерий</th><th>SaaS (Brandwatch, BuzzSumo, Signum)</th><th>Внедрение Nero под ключ</th></tr></thead><tbody><tr><td>Запуск</td><td>Подписка, self-service</td><td>4–6 недель, под ваш процесс</td></tr><tr><td>Источники РФ</td><td>Ограничения у западных</td><td>VK, Telegram first-class</td></tr><tr><td>Контент-гипотезы</td><td>Частично / generic AI</td><td>Scoring риска + brand adaptation</td></tr><tr><td>CRM-задачи</td><td>Редко нативно</td><td>amoCRM, Bitrix24, Make/n8n</td></tr><tr><td>Evidence layer</td><td>Зависит от продукта</td><td>URL на каждый инсайт — стандарт</td></tr><tr><td>Закрытый контур</td><td>Облако вендора</td><td>YandexGPT/GigaChat по запросу</td></tr></tbody></table></div>
      <p>Signum.AI добавляет свежий слой — <strong>видимость в AI-поиске</strong> (ChatGPT, Perplexity). Nero может включить GEO-мониторинг конкурентов как опцию.</p></div>
        </div><div class="amk-faq-item">
          <div class="amk-faq-q" tabindex="0" role="button" aria-expanded="false">Галлюцинации LLM при суммаризации и как их снижать</div>
          <div class="amk-faq-a"><p>Metrivant (2026): «Verified signal traces back to a specific before/after page diff. Unverified signal provides a summary and confidence score with no traceable source» (<a href="https://metrivant.blog/2026/04/02/the-ai-hallucination-problem-in-competitive-intelligence-2026/" target="_blank" rel="noopener noreferrer">metrivant.blog</a>).</p>
      <p><strong>Как снижает Nero:</strong></p>
      <ol class="amk-ol">
      <li>RAG <strong>только</strong> по собранным постам — не «общие знания» модели.</li>
      <li>Каждая рекомендация с <strong>URL</strong> и цитатой.</li>
      <li>Diff-история — сравнение с прошлой версией страницы/поста.</li>
      <li>Human-in-the-loop перед попаданием в контент-план.</li>
      <li>Confidence score; инсайты без источника — в карантин.</li>
      </ol></div>
        </div><div class="amk-faq-item">
          <div class="amk-faq-q" tabindex="0" role="button" aria-expanded="false">CTA: проверить конкурентов — бесплатный отчёт по 5 игрокам</div>
          <div class="amk-faq-a"><p><strong>Как внедрить ai мониторинг конкурентов</strong> без риска: начните с демо. Nero Network подготовит <strong>отчёт по 5 конкурентам</strong> за 7 дней — с картой ER, топ-постами, трендами и безопасными гипотезами. Это тот же формат, который станет ядром полного внедрения.</p>
      <p><strong>Ответы на частые вопросы:</strong></p>
      <p><strong>Сколько длится внедрение?</strong> 4–6 недель до пилота; лид-магнит — 7 дней.</p>
      <p><strong>Можно ли собрать самим на n8n?</strong> Да, шаблоны есть ($35–45/мес инфраструктура). Nero экономит 1–2 месяца настройки и закладывает governance с первого дня.</p>
      <p><strong>Подходит ли малый бизнес?</strong> Да — пакет «5 конкурентов», Sheets + Telegram без тяжёлого enterprise-стека.</p>
      <p><strong>Нужна ли интеграция с CRM?</strong> Не обязательна на старте, но даёт максимальный ROI: гипотеза сразу становится задачей.</p>
      <p><strong>Чем отличается от ChatGPT?</strong> ChatGPT не видит live ER конкурентов, не хранит историю их постов и не шлёт алерты при аномалиях.</p>
      <p><strong>Итог.</strong> AI-мониторинг конкурентов и трендов контента — практичное <strong>внедрение нейросетей в бизнес</strong> маркетинга: меньше ручного скроллинга, больше проверяемых гипотез, быстрее реакция на форматы, которые реально работают в вашей нише. Nero Network проектирует систему под ваши источники, процессы и CRM — с evidence-first подходом и человеком в контуре принятия решений.</p>
      <p><strong>Следующий шаг:</strong> оставьте заявку на <strong>бесплатный отчёт по 5 конкурентам</strong> — «Проверить конкурентов».</p></div>
        </div></div>
    </div>
  </section>

  <div class="amk-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы перестать скроллить конкурентов вручную?</p>
        <p class="ym-cta-block__sub">Начните с бесплатного отчёта по 5 конкурентам — или спроектируем полный контур мониторинга под ключ за 4–6 недель.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить конкурентов</a>
          <a href="#vnedrenie" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
        </div>
      </div>
    </div>
  </div>

  <!-- SCHEMA-MARKUP:INSERT -->

</div><!-- /.amk-content -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>

<script>
(function(){
  document.querySelectorAll('.amk-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.amk-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.amk-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.amk-faq-q');
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
  'use strict';
  var root = document.querySelector('.amk-content');
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
    }, {rootMargin:'0px 0px -8% 0px', threshold:0.12});
    items.forEach(function(el){ observer.observe(el); });
  } else {
    items.forEach(function(el){ el.classList.add('nero-ai-active'); });
  }
})();
</script>

<?php get_footer(); ?>

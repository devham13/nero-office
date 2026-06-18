<?php
/**
 * Template Name: AI-стратегия компании на 2026 год
 * Description: Разработка AI-стратегии для бизнеса — roadmap, бюджет, KPI, внедрение под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-стратегия для бизнеса: roadmap и внедрение под ключ';
$page_seo_description = 'Разработка AI-стратегии для бизнеса на 2026 год: приоритеты процессов, бюджет, KPI, риски и дорожная карта внедрения нейросетей и агентов. Консультация и внедрение под ключ.';

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
    ['label' => 'Суть', 'href' => '#chto-takoe'],
    ['label' => 'Roadmap', 'href' => '#etapy'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Под ключ', 'href' => '#pod-klyuch'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать AI-стратегию';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Этапы roadmap';
$secondary_cta_url   = '#etapy';

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

body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
.ais26-hero-strategy{min-height:100vh;min-height:100dvh;position:relative}
.ais26-content{--ais26-bg:#050711;--ais26-bg2:#080b17;--ais26-surface:rgba(255,255,255,.072);--ais26-text:#e6edf7;--ais26-muted:#9aa8bd;--ais26-soft:#c7d2e5;--ais26-heading:#fff;--ais26-border:rgba(255,255,255,.10);--ais26-accent:#8b5cf6;--ais26-violet:#8b5cf6;--ais26-cyan:#79f2ff;--ais26-green:#22c55e;--ais26-orange:#f97316;--ais26-container:1220px;background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);color:var(--ais26-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden}
.ais26-content *,.ais26-content *::before,.ais26-content *::after{box-sizing:border-box}
.ais26-cnt{width:min(var(--ais26-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.ais26-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.ais26-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.ais26-sh{max-width:820px;margin:0 auto 40px;text-align:center}
.ais26-sh h2{font-size:clamp(26px,4vw,48px);line-height:1.08;color:var(--ais26-heading);letter-spacing:-.04em;margin:0}
.ais26-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(139,92,246,.1);border:1px solid rgba(139,92,246,.25);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ais26-violet);margin-bottom:14px}
.ais26-h3{font-size:clamp(18px,2.2vw,22px);font-weight:800;color:var(--ais26-heading);margin:36px 0 14px;letter-spacing:-.03em}
.ais26-p{color:var(--ais26-muted);font-size:15px;line-height:1.75;margin:0 0 1.1em;text-align:left!important}
.ais26-p strong{color:var(--ais26-soft)}
.ais26-ul{margin:0 0 1.2em;padding:0;list-style:none}
.ais26-ul li{position:relative;padding-left:20px;margin-bottom:.5em;color:var(--ais26-muted);font-size:14.5px;line-height:1.65;text-align:left!important}
.ais26-ul li::before{content:'›';position:absolute;left:0;color:var(--ais26-violet);font-weight:700}
.ais26-ol{margin:0 0 1.2em;padding-left:22px;color:var(--ais26-muted);font-size:14.5px;line-height:1.65}
.ais26-ol li{margin-bottom:.45em;text-align:left!important}
.ais26-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.ais26-table{width:100%;border-collapse:collapse;font-size:14px}
.ais26-table th{padding:13px 16px;text-align:left;background:rgba(139,92,246,.12);color:var(--ais26-violet);font-weight:700;border-bottom:1px solid rgba(139,92,246,.25)}
.ais26-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--ais26-text);vertical-align:top}
.ais26-table tr:last-child td{border-bottom:none}
.ais26-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:28px;margin-top:24px}
.ais26-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.ais26-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.ais26-intro-text{position:relative;padding-left:20px;text-align:left!important}
.ais26-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--ais26-orange),var(--ais26-violet))}
.ais26-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--ais26-muted);margin-bottom:1em}
.ais26-intro-text p:last-child{margin-bottom:0;color:var(--ais26-soft)}
.ais26-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.ais26-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center}
.ais26-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--ais26-heading);line-height:1;margin-bottom:5px}
.ais26-kpi-card .kl{font-size:11px;font-weight:600;color:var(--ais26-muted);line-height:1.4}
.ais26-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
.ais26-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.ais26-toc,.ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.ais26-toc a,.ym-toc a{display:inline-block;padding:9px 18px;background:var(--ais26-surface);border:1px solid var(--ais26-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--ais26-muted);text-decoration:none;transition:border-color .2s,color .2s}
.ais26-toc a:hover{border-color:rgba(139,92,246,.42);color:var(--ais26-violet)}
.ais26-faq{display:flex;flex-direction:column;gap:10px;max-width:860px;margin:0 auto}
.ais26-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:20px 24px}
.ais26-faq-item h3{font-size:16px;margin:0 0 10px;color:var(--ais26-heading)}
.ais26-faq-item p{margin:0;font-size:14.5px}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(139,92,246,.14),rgba(121,242,255,.1));border:1px solid rgba(139,92,246,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(139,92,246,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block--final{background:linear-gradient(135deg,rgba(139,92,246,.16),rgba(249,115,22,.08));border-color:rgba(139,92,246,.35)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--ais26-muted);font-size:15px;margin:0 auto 22px;max-width:640px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--ais26-cyan)!important;text-decoration:underline}
.reveal{opacity:0;transform:translateY(22px);transition:opacity .6s ease,transform .6s ease}
.reveal.visible{opacity:1;transform:none}
.delay-1{transition-delay:.1s}.delay-2{transition-delay:.2s}.delay-3{transition-delay:.3s}
@media(max-width:900px){.ais26-intro-grid{grid-template-columns:1fr;gap:36px}.ais26-intro-kpi{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}

</style>

<main id="primary" class="site-main ai-strategiya-kompanii-na-2026-god-page" role="main" tabindex="-1">

<section class="nero-ai-hero ais26-hero-strategy" id="hero" aria-labelledby="ais26-hero-title">
<style>
/* === АЛИНА: ais26-hero-strategy — светлая самодостаточная hero-секция === */
.ais26-hero-strategy {
  --ais26-bg: #f8fafc;
  --ais26-grid: rgba(15, 23, 42, 0.06);
  --ais26-text: #0f172a;
  --ais26-muted: rgba(15, 23, 42, 0.72);
  --ais26-border: #e2e8f0;
  --ais26-accent: #8b5cf6;
  --ais26-orange: #f97316;
  --ais26-green: #10b981;
  --ais26-card: #ffffff;
  --ais26-shadow: 0 24px 64px rgba(15, 23, 42, 0.08);
  position: relative;
  overflow: hidden;
  min-height: min(920px, calc(100dvh - 1px));
  padding: clamp(72px, 8vw, 120px) 0 clamp(48px, 6vw, 80px);
  background: var(--ais26-bg);
  isolation: isolate;
}
.ais26-hero-strategy::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(var(--ais26-grid) 1px, transparent 1px),
    linear-gradient(90deg, var(--ais26-grid) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(ellipse 80% 70% at 50% 40%, #000 20%, transparent 75%);
  pointer-events: none;
  z-index: 0;
}
.ais26-hero-strategy::after {
  content: "";
  position: absolute;
  right: -8%;
  top: 8%;
  width: 520px;
  height: 520px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(139, 92, 246, 0.1), transparent 68%);
  pointer-events: none;
  z-index: 0;
}
.ais26-hero-strategy .nero-ai-container {
  width: min(1180px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.ais26-hero-strategy .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(340px, 0.95fr);
  gap: clamp(28px, 4vw, 52px);
  align-items: center;
}
.ais26-hero-strategy .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 14px;
  padding: 7px 12px;
  border: 1px solid var(--ais26-border);
  border-radius: 999px;
  background: #fff;
  color: var(--ais26-accent);
  font-size: 12px;
  font-weight: 800;
  letter-spacing: 0.1em;
  text-transform: uppercase;
}
.ais26-hero-strategy .nero-ai-h1,
.ais26-hero-strategy h1 {
  margin: 0;
  max-width: 720px;
  font-size: clamp(34px, 4.8vw, 58px);
  line-height: 1.06;
  letter-spacing: -0.04em;
  font-weight: 900;
  color: var(--ais26-text);
}
.ais26-hero-strategy .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, var(--ais26-orange), var(--ais26-accent));
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  color: transparent;
}
.ais26-hero-strategy .nero-ai-lead {
  margin: 20px 0 0;
  max-width: 640px;
  font-size: clamp(16px, 1.8vw, 20px);
  line-height: 1.58;
  color: var(--ais26-muted);
}
.ais26-hero-strategy .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 22px 0 0;
  padding: 0;
  list-style: none;
}
.ais26-hero-strategy .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 12px;
  border: 1px solid var(--ais26-border);
  border-radius: 999px;
  background: #fff;
  color: #334155;
  font-size: 13px;
  font-weight: 700;
  box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
}
.ais26-hero-strategy .nero-ai-cta-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 28px;
}
.ais26-hero-strategy .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 13px 22px;
  border-radius: 999px;
  font-size: 14px;
  font-weight: 800;
  text-decoration: none !important;
  transition: transform 0.2s, box-shadow 0.2s;
}
.ais26-hero-strategy .nero-ai-btn--primary,
.ais26-hero-strategy .nero-ai-btn-primary {
  background: var(--ais26-text);
  color: #fff !important;
  box-shadow: 0 8px 24px rgba(15, 23, 42, 0.18);
}
.ais26-hero-strategy .nero-ai-btn--primary:hover,
.ais26-hero-strategy .nero-ai-btn-primary:hover {
  transform: translateY(-2px);
}
.ais26-hero-strategy .nero-ai-btn--ghost,
.ais26-hero-strategy .nero-ai-btn-secondary {
  background: #fff;
  color: var(--ais26-text) !important;
  border: 1px solid var(--ais26-border);
}
.ais26-hero-strategy .ais26-phase-strip {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 24px;
  padding: 0;
  list-style: none;
}
.ais26-hero-strategy .ais26-phase-strip li {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 14px;
  border: 1px solid var(--ais26-border);
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.92);
  font-size: 13px;
  font-weight: 600;
  color: #334155;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
}
.ais26-hero-strategy .ais26-phase-strip li span {
  width: 26px;
  height: 26px;
  border-radius: 8px;
  background: linear-gradient(135deg, var(--ais26-orange), var(--ais26-accent));
  color: #fff;
  font-size: 11px;
  font-weight: 900;
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.ais26-hero-strategy .nero-ai-dashboard {
  position: relative;
  border-radius: 22px;
  padding: 14px;
  background: linear-gradient(145deg, #fff 0%, #f1f5f9 100%);
  border: 1px solid var(--ais26-border);
  box-shadow: var(--ais26-shadow);
}
.ais26-hero-strategy .nero-ai-dashboard-shell {
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid var(--ais26-border);
  background: var(--ais26-card);
}
.ais26-hero-strategy .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  background: #f8fafc;
  border-bottom: 1px solid var(--ais26-border);
}
.ais26-hero-strategy .nero-ai-dots {
  display: flex;
  gap: 5px;
}
.ais26-hero-strategy .nero-ai-dot {
  width: 9px;
  height: 9px;
  border-radius: 50%;
  background: #cbd5e1;
}
.ais26-hero-strategy .nero-ai-dot:first-child { background: #f87171; }
.ais26-hero-strategy .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.ais26-hero-strategy .nero-ai-dot:nth-child(3) { background: #34d399; }
.ais26-hero-strategy .nero-ai-window-title,
.ais26-hero-strategy .nero-ai-dashboard-note {
  font-size: 11px;
  color: #64748b;
  font-weight: 600;
}
.ais26-hero-strategy .nero-ai-window-body {
  padding: 14px;
}
.ais26-hero-strategy .nero-ai-dash-header,
.ais26-hero-strategy .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  margin-bottom: 12px;
}
.ais26-hero-strategy .nero-ai-dash-title,
.ais26-hero-strategy .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 15px;
  font-weight: 800;
  color: var(--ais26-text);
}
.ais26-hero-strategy .nero-ai-dash-status,
.ais26-hero-strategy .nero-ai-live-pill {
  padding: 4px 10px;
  border-radius: 999px;
  background: rgba(16, 185, 129, 0.12);
  color: #047857;
  font-size: 11px;
  font-weight: 800;
}
.ais26-hero-strategy .nero-ai-dash-grid,
.ais26-hero-strategy .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 8px;
  margin-bottom: 12px;
}
.ais26-hero-strategy .nero-ai-dash-card,
.ais26-hero-strategy .nero-ai-metric {
  padding: 10px;
  border-radius: 12px;
  border: 1px solid var(--ais26-border);
  background: #f8fafc;
}
.ais26-hero-strategy .nero-ai-dash-card strong,
.ais26-hero-strategy .nero-ai-metric strong {
  display: block;
  font-size: 18px;
  font-weight: 900;
  color: var(--ais26-text);
  line-height: 1.1;
}
.ais26-hero-strategy .nero-ai-dash-card span,
.ais26-hero-strategy .nero-ai-metric span {
  display: block;
  font-size: 11px;
  color: #64748b;
  margin-bottom: 2px;
}
.ais26-hero-strategy .nero-ai-metric small {
  font-size: 10px;
  color: #94a3b8;
}
.ais26-hero-strategy .ais26-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin: 0 0 10px;
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid var(--ais26-border);
  background:
    radial-gradient(ellipse at 50% 55%, rgba(139, 92, 246, 0.06), transparent 70%),
    linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
}
.ais26-hero-strategy #ais26-strategy-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.ais26-hero-strategy .nero-ai-dash-feed,
.ais26-hero-strategy .nero-ai-task-stream {
  display: grid;
  gap: 7px;
}
.ais26-hero-strategy .nero-ai-dash-row,
.ais26-hero-strategy .nero-ai-task {
  display: grid;
  grid-template-columns: 10px 1fr auto;
  align-items: center;
  gap: 8px;
  padding: 8px 10px;
  border-radius: 10px;
  border: 1px solid var(--ais26-border);
  background: #fff;
  font-size: 12px;
  color: #334155;
}
.ais26-hero-strategy .nero-ai-dash-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}
.ais26-hero-strategy .nero-ai-dash-dot--green { background: var(--ais26-green); }
.ais26-hero-strategy .nero-ai-dash-dot--amber { background: #f59e0b; }
.ais26-hero-strategy .nero-ai-dash-dot--blue { background: #3b82f6; }
.ais26-hero-strategy .nero-ai-status {
  padding: 3px 8px;
  border-radius: 999px;
  background: rgba(16, 185, 129, 0.12);
  color: #047857;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.ais26-hero-strategy .nero-ai-status--amber {
  background: rgba(245, 158, 11, 0.14);
  color: #b45309;
}
@media (max-width: 1024px) {
  .ais26-hero-strategy .nero-ai-hero-grid { grid-template-columns: 1fr; }
}
@media (max-width: 520px) {
  .ais26-hero-strategy .nero-ai-dash-grid,
  .ais26-hero-strategy .nero-ai-metrics-grid { grid-template-columns: 1fr; }
  .ais26-hero-strategy .ais26-phase-strip li { flex: 1 1 calc(50% - 8px); }
}
</style>

  <div class="nero-ai-container">
    <div class="nero-ai-hero-grid">
      <div class="nero-ai-hero-copy">
        <span class="nero-ai-eyebrow">AI-стратегия · roadmap 2026</span>
        <h1 id="ais26-hero-title" class="nero-ai-h1">AI-стратегия компании на 2026 год: <span class="nero-ai-gradient-text">разработка дорожной карты и внедрение под ключ</span></h1>
        <p class="nero-ai-lead">От разрозненных пилотов к управляемой AI-трансформации — приоритеты, бюджет, KPI и ответственность команды</p>
        <div class="nero-ai-badges" aria-label="Ключевые блоки стратегии">
          <span class="nero-ai-badge">Диагностика</span>
          <span class="nero-ai-badge">Приоритеты</span>
          <span class="nero-ai-badge">Roadmap</span>
          <span class="nero-ai-badge">Governance</span>
          <span class="nero-ai-badge">KPI</span>
        </div>
        <div class="nero-ai-cta-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Собрать AI-стратегию</a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Этапы roadmap →</a>
        </div>
        <ol class="ais26-phase-strip" aria-label="Этапы AI-стратегии">
          <li><span>1</span> Аудит зрелости</li>
          <li><span>2</span> Матрица приоритетов</li>
          <li><span>3</span> Бюджет 12 мес.</li>
          <li><span>4</span> Agentic governance</li>
          <li><span>5</span> Печать roadmap</li>
        </ol>
      </div>

      <div class="nero-ai-dashboard" aria-label="Демонстрация AI-стратегии и roadmap">
        <p class="nero-ai-dashboard-note">пример логики AI-системы · демонстрационные данные</p>
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">AI Strategy Command · демо roadmap</span>
          </div>
          <div class="nero-ai-window-body">
            <div class="nero-ai-dashboard-title">
              <h3>Roadmap 2026 · governance</h3>
              <span class="nero-ai-live-pill">онлайн</span>
            </div>
            <div class="nero-ai-metrics-grid">
              <div class="nero-ai-metric"><span>Со стратегией</span><strong>26%</strong><small>рынок РФ</small></div>
              <div class="nero-ai-metric"><span>Эксперименты</span><strong>97%</strong><small>крупный бизнес</small></div>
              <div class="nero-ai-metric"><span>RAI maturity</span><strong>2,3/4</strong><small>McKinsey 2026</small></div>
              <div class="nero-ai-metric"><span>Срок проекта</span><strong>4–8</strong><small>недель</small></div>
            </div>

            <div class="ais26-dash-canvas-wrap">
              <canvas id="ais26-strategy-hero-canvas" role="img" aria-label="Анимация: хаотичные AI-пилоты выстраиваются в дорожную карту 2026 с governance и KPI"></canvas>
            </div>

            <div class="nero-ai-task-stream" aria-label="Лента событий стратегии">
              <div class="nero-ai-task">
                <span class="nero-ai-dash-dot nero-ai-dash-dot--amber" aria-hidden="true"></span>
                <span>Shadow AI в 4 отделах — без единого KPI</span>
                <span class="nero-ai-status nero-ai-status--amber">аудит</span>
              </div>
              <div class="nero-ai-task">
                <span class="nero-ai-dash-dot nero-ai-dash-dot--blue" aria-hidden="true"></span>
                <span>Матрица «эффект × риск» — 3 quick wins</span>
                <span class="nero-ai-status">приоритет</span>
              </div>
              <div class="nero-ai-task">
                <span class="nero-ai-dash-dot nero-ai-dash-dot--green" aria-hidden="true"></span>
                <span>Decision rights matrix для AI-агентов</span>
                <span class="nero-ai-status">governance</span>
              </div>
              <div class="nero-ai-task">
                <span class="nero-ai-dash-dot nero-ai-dash-dot--green" aria-hidden="true"></span>
                <span>Roadmap 2026 утверждён · бюджет 12 мес.</span>
                <span class="nero-ai-status">sealed</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="ais26-content">
  <section class="ais26-intro" id="intro" aria-label="Введение">
    <div class="ais26-cnt">
      <div class="ais26-intro-grid reveal">
        <div class="ais26-intro-text">
          <p class="ais26-eyebrow">AI-стратегия · 2026</p>
          <p>В 2026 году вопрос для среднего и крупного бизнеса звучит не «нужен ли нам искусственный интеллект», а «как превратить разрозненные эксперименты в управляемую AI-трансформацию с понятным бюджетом, KPI и ответственностью». <strong>AI-стратегия для бизнеса</strong> — это управленческий документ и операционная модель: какие процессы автоматизировать, в каком порядке, с какими рисками и кто отвечает за результат. Без неё компании тратят миллионы на пилоты, которые не доходят до промышленного эффекта.</p>
<p><strong>Коротко:</strong> по данным исследования «Яков и Партнёры» (март 2026, цитата зампреда Сбербанка А. Попова), <strong>97%</strong> крупных компаний внедряют или планируют внедрение ИИ, но <strong>только 26%</strong> имеют формализованную стратегию. Разрыв между экспериментами и системным подходом — главная боль C-level в 2026 году.</p>

        </div>
        <div class="ais26-intro-kpi" aria-label="Ключевые метрики рынка">
          <div class="ais26-kpi-card"><div class="kv">97%</div><div class="kl">крупных компаний в ИИ</div><div class="ks">Яков и Партнёры, 2026</div></div>
          <div class="ais26-kpi-card"><div class="kv">26%</div><div class="kl">имеют формальную стратегию</div><div class="ks">рынок РФ</div></div>
          <div class="ais26-kpi-card"><div class="kv">2,3/4</div><div class="kl">RAI maturity McKinsey</div><div class="ks">State of AI Trust 2026</div></div>
          <div class="ais26-kpi-card"><div class="kv">4–8</div><div class="kl">недель до roadmap</div><div class="ks">Nero Network</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="ais26-toc-outer">
    <div class="ais26-cnt">
      <nav class="ais26-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что такое</a>
        <a href="#etapy">Этапы roadmap</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#pod-klyuch">Под ключ</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#riski">Риски</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="ais26-section" id="chto-takoe">
    <div class="ais26-cnt">
      <div class="ais26-sh reveal">
        <span class="ais26-eyebrow">AI-стратегия</span>
        <h2>Что такое AI-стратегия для бизнеса и почему без неё теряют бюджет в 2026 году</h2>
      </div>
      <p class="ais26-p reveal"><strong>Определение.</strong> AI-стратегия для бизнеса — не покупка «ещё одной нейросети», а план AI-трансформации: приоритеты процессов, бюджет на 12 месяцев, KPI, привязанные к P&L, роли (CDO, AI lead, бизнес-владелец процесса), governance и этапы масштабирования от пилота к production.</p>
      <h3 class="ais26-h3 reveal" id="-----ai-">От разрозненных пилотов к управляемой AI-трансформации</h3>
      <p class="ais26-p reveal">Типичная картина 2025–2026: отделы подключают ChatGPT, GigaChat и корпоративные LLM без единых стандартов. Исследование Билайн × Ассоциация менеджеров (опрос <strong>70+</strong> компаний с оборотом от <strong>800 млн ₽</strong>, январь–февраль 2026) показывает: <strong>37%</strong> используют ИИ ситуативно, <strong>17%</strong> только оценивают потенциал. При этом <strong>24%</strong> уже интегрировали ИИ в коммерческие операции, а <strong>22%</strong> разрабатывают стратегии — то есть <strong>46%</strong> рынка в активной фазе, но без единого плана растёт риск повторить чужие ошибки.</p>
      <p class="ais26-p reveal">По данным опроса «Интеллектуальная аналитика» (~50 организаций, 2025), <strong>~90%</strong> AI-проектов не дошли до промышленного эффекта, <strong>~40%</strong> свернуты на этапе пилота. Пилотные бюджеты в корпоративном сегменте часто составляют <strong>5–15 млн ₽</strong> (Onside / Just AI, по вторичным источникам 2025) — и уходят в тень, если нет roadmap с критериями перехода в production.</p>
      <p class="ais26-p reveal"><strong>Итог:</strong> AI-стратегия закрывает боль «внедрение точечно, без приоритетов, бюджета и ответственности» — формулировку, с которой приходят управляющие команды и совет директоров.</p>
      <h3 class="ais26-h3 reveal" id="-agentic-ai---mckinsey-state-of-ai-trust">Доверие, agentic AI и тренд McKinsey State of AI Trust 2026</h3>
      <p class="ais26-p reveal">В 2026 году индустрия переходит к <strong>agentic-эре</strong>: AI-системы не только генерируют текст, но и выполняют цепочки действий в CRM, ERP и финансовых контурах. Отчёт McKinsey «State of AI Trust in 2026: Shifting to the Agentic Era» (опрос <strong>~500</strong> организаций, декабрь 2025 – январь 2026) фиксирует сдвиг вопроса с «точна ли модель» на «кто ответственен, когда система действует». Как отмечает Rich Isenberg (McKinsey): <em>«Agency isn't a feature — it's a transfer of decision rights»</em> — автономия агента означает передачу прав на принятие решений.</p>
      <p class="ais26-p reveal">Модель зрелости responsible AI (RAI) McKinsey включает <strong>5 измерений</strong>: strategy, risk management, data & technology, governance и <strong>agentic AI governance and controls</strong> (новое измерение 2026). Средний балл RAI — <strong>2,3 из 4</strong> (было 2,0 в 2025). Только <strong>~⅓ организаций</strong> достигли уровня 3+ по стратегии, governance и agentic controls. Главный барьер масштабирования agentic AI — <strong>security/risk</strong> (у <strong>~⅔</strong> респондентов); <strong>~60%</strong> указывают на нехватку знаний и обучения по responsible AI.</p>
      <p class="ais26-p reveal">Для российского бизнеса это означает: AI-стратегия на 2026 год обязана включать блок governance агентов — до того, как автономные сценарии попадут в критичные процессы.</p>
      <h3 class="ais26-h3 reveal" id="--------">Кому нужна стратегия: средний и крупный бизнес, совет директоров</h3>
      <p class="ais26-p reveal">Целевая аудитория AI-стратегии — <strong>средний и крупный бизнес</strong>, управляющие команды и совет директоров. По MTS Web Services («Технологические стратегии бизнеса»), лишь <strong>26%</strong> российских компаний с бюджетом на ИИ имеют утверждённую AI-стратегию.</p>
      <p class="ais26-p reveal">Стратегия нужна, если:</p>
      <ul class="ais26-ul reveal"><li>пилоты запущены в нескольких подразделениях, но нет единых метрик ROI;</li><li>руководство требует обоснования бюджета на 2026–2027;</li><li>планируется масштабирование AI-агентов в коммерции, логистике или клиентском сервисе;</li><li>регуляторика и персональные данные (152-ФЗ) ограничивают свободу экспериментов.</li></ul>
      <p class="ais26-p reveal">Малый бизнес может обойтись упрощённым roadmap из 3–5 use cases; для компаний с оборотом от сотен миллионов рублей отсутствие стратегии — управленческий риск, а не «IT-роскошь».</p>
    </div>
  </section>

  <section class="ais26-section ais26-section-alt" id="etapy">
    <div class="ais26-cnt">
      <div class="ais26-sh reveal">
        <span class="ais26-eyebrow">Roadmap 2026</span>
        <h2>Как разработать AI-стратегию компании: этапы и дорожная карта</h2>
      </div>
      <p class="ais26-p reveal">Разработка AI-стратегии — последовательность от диагностики к приоритизации, бюджету и governance. Ниже — этапы, синтезированные из отраслевых практик и проектной модели Nero Network.</p>
      <div class="ais26-table-wrap reveal"><table class="ais26-table"><thead><tr><th>Этап</th><th>Содержание</th><th>Горизонт</th></tr></thead><tbody><tr><td>1. Аудит</td><td>Процессы, данные, текущие пилоты, shadow AI</td><td>Нед. 1–2</td></tr><tr><td>2. Цели и KPI</td><td>Привязка к P&L, quick wins + стратегические кейсы</td><td>Нед. 2–3</td></tr><tr><td>3. Roadmap</td><td>Приоритеты, бюджет 12 мес., интеграции CRM/ERP</td><td>Нед. 3–4</td></tr><tr><td>4. Governance</td><td>Decision rights, agentic controls, обучение</td><td>Нед. 4–5</td></tr><tr><td>5. Пилот</td><td>Один кейс с замером KPI</td><td>1–3 мес.</td></tr><tr><td>6. Масштаб</td><td>Платформа, MLOps/LLMOps, амбассадоры</td><td>6–12 мес.</td></tr><tr><td>7. Оптимизация</td><td>Непрерывное улучшение, AI-first процессы</td><td>12+ мес.</td></tr></tbody></table></div>
      <section id="ai-strategiya-kompanii-na-2026-god-boris-block" class="bas-root" aria-label="Анимация: дорожная карта AI-трансформации с этапами и горизонтами 2026">
<style>
/* === БОРИС: prefix bas-, scoped внутри #ai-strategiya-kompanii-na-2026-god-boris-block === */
#ai-strategiya-kompanii-na-2026-god-boris-block.bas-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-strategiya-kompanii-na-2026-god-boris-block .bas-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-strategiya-kompanii-na-2026-god-boris-block .bas-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#7c3aed;
  margin:0 0 14px;
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-ey::before{
  content:'';
  width:18px;height:2px;
  background:#7c3aed;
  border-radius:1px;
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(124,58,237,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#6d28d9;
  margin-top:1px;
  font-style:normal;
  font-weight:700;
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-pl-v{
  background:rgba(124,58,237,.08);
  color:#6d28d9;
  border:1.5px solid rgba(124,58,237,.22);
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-strategiya-kompanii-na-2026-god-boris-block .bas-rgt{
  position:relative;
  background:linear-gradient(135deg,#faf5ff 0%,#ede9fe 22%,#f0f9ff 58%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-strategiya-kompanii-na-2026-god-boris-block .bas-rgt{min-height:380px;}
}
#bas-roadmap-timeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bas-cnt">
  <div class="bas-card">

    <div class="bas-lft">
      <span class="bas-ey">AI-roadmap · 2026</span>
      <h3 class="bas-h3">Шесть этапов трансформации: от аудита пилотов до масштабирования агентов</h3>
      <ul class="bas-ul">
        <li><span class="bas-ic">1</span>Диагностика зрелости: процессы, данные, shadow AI и текущие эксперименты</li>
        <li><span class="bas-ic">2</span>Цели и KPI, привязанные к P&L — quick wins + один стратегический кейс</li>
        <li><span class="bas-ic">3</span>Roadmap с горизонтами 0–3 / 3–6 / 6–12 мес., бюджет и интеграции CRM/ERP</li>
        <li><span class="bas-ic">4</span>Governance agentic AI: decision rights, human-in-the-loop, обучение</li>
      </ul>
      <div class="bas-pills">
        <span class="bas-pl bas-pl-v">4–8 нед. стратегия</span>
        <span class="bas-pl bas-pl-g">RAI 2,3 → 3+</span>
        <span class="bas-pl bas-pl-b">пилот → production</span>
      </div>
      <p class="bas-foot">Дальше — роли CDO, AI lead и шаблон AI-roadmap как лид-магнит →</p>
    </div>

    <div class="bas-rgt">
      <canvas
        id="bas-roadmap-timeline-canvas"
        aria-label="Анимация: навигатор проходит по дорожной карте AI-трансформации — диагностика, KPI, roadmap, governance, пилот, масштаб"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bas-roadmap-timeline-canvas');
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
    ink:'#0f172a',
    muted:'#64748b',
    path:'#cbd5e1',
    pathActive:'#8b5cf6',
    pathGlow:'rgba(139,92,246,.18)',
    nav:'#7c3aed',
    navGlow:'rgba(124,58,237,.35)',
    band1:'rgba(124,58,237,.06)',
    band2:'rgba(14,165,233,.06)',
    band3:'rgba(34,197,94,.06)',
    bandBdr:'rgba(148,163,184,.25)',
    nodeOff:'#e2e8f0',
    nodeOn:'#8b5cf6',
    green:'#22c55e',
    blue:'#0ea5e9',
    amber:'#f59e0b',
    rose:'#f43f5e',
    teal:'#14b8a6',
    white:'#ffffff'
  };

  var STAGES = [
    {label:'Диагностика', short:'Аудит', color:C.amber, band:0, week:'нед. 1–2'},
    {label:'KPI', short:'Цели', color:C.blue, band:0, week:'нед. 2–3'},
    {label:'Roadmap', short:'План', color:C.nodeOn, band:1, week:'нед. 3–4'},
    {label:'Governance', short:'RAI', color:C.rose, band:1, week:'нед. 4–5'},
    {label:'Пилот', short:'MVP', color:C.teal, band:2, week:'1–3 мес.'},
    {label:'Масштаб', short:'Prod', color:C.green, band:2, week:'6–12 мес.'}
  ];

  var BANDS = [
    {label:'0–3 мес.', sub:'стратегия'},
    {label:'3–6 мес.', sub:'пилоты'},
    {label:'6–12 мес.', sub:'масштаб'}
  ];

  var LOOP = 720;
  var SEG = LOOP / STAGES.length;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function pathPoints(pad, top, bottom){
    var n = STAGES.length;
    var xs = [];
    for(var i=0;i<n;i++){
      xs.push(pad + (W - pad*2) * (i / (n-1)));
    }
    var ys = [];
    for(var j=0;j<n;j++){
      var wave = Math.sin(j * 0.85) * (bottom - top) * 0.22;
      ys.push((top + bottom) / 2 + wave);
    }
    return {xs:xs, ys:ys};
  }

  function drawBands(pad, topY, bandH){
    var bandW = (W - pad*2) / 3;
    var fills = [C.band1, C.band2, C.band3];
    BANDS.forEach(function(b,i){
      var bx = pad + i * bandW;
      rr(bx, topY, bandW - 4, bandH, 10, fills[i], C.bandBdr, 1);
      ctx.fillStyle=C.muted;
      ctx.font='bold 9px Inter,system-ui,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(b.label, bx + 10, topY + 16);
      ctx.font='9px Inter,sans-serif';
      ctx.fillText(b.sub, bx + 10, topY + 28);
    });
  }

  function drawPathLine(pts, progress){
    ctx.lineCap='round';
    ctx.lineJoin='round';
    for(var i=0;i<pts.xs.length-1;i++){
      var segStart = i / (pts.xs.length-1);
      var segEnd = (i+1) / (pts.xs.length-1);
      var lit = progress >= segEnd;
      var partial = progress > segStart && progress < segEnd;
      ctx.beginPath();
      ctx.moveTo(pts.xs[i], pts.ys[i]);
      ctx.lineTo(pts.xs[i+1], pts.ys[i+1]);
      ctx.strokeStyle = lit ? C.pathActive : C.path;
      ctx.lineWidth = lit ? 4 : 2.5;
      ctx.stroke();
      if(partial){
        var t = (progress - segStart) / (segEnd - segStart);
        var mx = pts.xs[i] + (pts.xs[i+1]-pts.xs[i])*t;
        var my = pts.ys[i] + (pts.ys[i+1]-pts.ys[i])*t;
        ctx.beginPath();
        ctx.moveTo(pts.xs[i], pts.ys[i]);
        ctx.lineTo(mx, my);
        ctx.strokeStyle = C.pathActive;
        ctx.lineWidth = 4;
        ctx.stroke();
      }
    }
  }

  function drawNode(x,y,r,stage,active,done,pulse){
    var scale = active ? 1 + Math.sin(pulse*0.12)*0.08 : 1;
    var rad = r * scale;
    if(done){
      rr(x-rad,y-rad,rad*2,rad*2,rad,C.white,stage.color,2.5);
      ctx.fillStyle=stage.color;
      ctx.font='bold 11px sans-serif';
      ctx.textAlign='center';
      ctx.textBaseline='middle';
      ctx.fillText('✓',x,y+1);
    } else if(active){
      ctx.beginPath();
      ctx.arc(x,y,rad+6,0,Math.PI*2);
      ctx.fillStyle=C.pathGlow;
      ctx.fill();
      rr(x-rad,y-rad,rad*2,rad*2,rad,stage.color,C.white,2);
      ctx.fillStyle=C.white;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.textBaseline='middle';
      ctx.fillText(stage.short,x,y+1);
    } else {
      rr(x-rad,y-rad,rad*2,rad*2,rad,C.nodeOff,C.bandBdr,1.5);
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.textBaseline='middle';
      ctx.fillText(String(STAGES.indexOf(stage)+1),x,y+1);
    }

    ctx.fillStyle = done || active ? C.ink : C.muted;
    ctx.font = (active?'bold ':'') + '10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.textBaseline='top';
    ctx.fillText(stage.label, x, y + rad + 8);

    if(active){
      ctx.fillStyle=stage.color;
      ctx.font='8px Inter,sans-serif';
      ctx.fillText(stage.week, x, y + rad + 22);
    }
  }

  function drawNavigator(x,y,pulse){
    ctx.beginPath();
    ctx.arc(x,y,14+Math.sin(pulse*0.1)*2,0,Math.PI*2);
    ctx.fillStyle=C.navGlow;
    ctx.fill();
    ctx.beginPath();
    ctx.arc(x,y,8,0,Math.PI*2);
    ctx.fillStyle=C.nav;
    ctx.fill();
    ctx.strokeStyle=C.white;
    ctx.lineWidth=2;
    ctx.stroke();
    ctx.fillStyle=C.white;
    ctx.font='bold 8px sans-serif';
    ctx.textAlign='center';
    ctx.textBaseline='middle';
    ctx.fillText('AI',x,y+1);
  }

  function drawKpiSpark(x,y,w,h,alpha){
    ctx.globalAlpha=alpha||1;
    rr(x,y,w,h,6,'rgba(255,255,255,.85)',C.bandBdr,1);
    ctx.fillStyle=C.ink;
    ctx.font='bold 8px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('KPI-дашборд',x+8,y+14);
    var bars=[0.4,0.65,0.5,0.85,0.7];
    bars.forEach(function(b,i){
      var bh=b*(h-28);
      rr(x+8+i*14,y+h-8-bh,10,bh,2,C.blue,null,0);
    });
    ctx.globalAlpha=1;
  }

  function drawGovernanceShield(x,y,s,alpha){
    ctx.globalAlpha=alpha||1;
    ctx.beginPath();
    ctx.moveTo(x,y-s);
    ctx.lineTo(x+s*0.7,y-s*0.3);
    ctx.lineTo(x+s*0.7,y+s*0.5);
    ctx.lineTo(x,y+s);
    ctx.lineTo(x-s*0.7,y+s*0.5);
    ctx.lineTo(x-s*0.7,y-s*0.3);
    ctx.closePath();
    ctx.fillStyle='rgba(244,63,94,.15)';
    ctx.fill();
    ctx.strokeStyle=C.rose;
    ctx.lineWidth=1.5;
    ctx.stroke();
    ctx.fillStyle=C.rose;
    ctx.font='bold 7px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.textBaseline='middle';
    ctx.fillText('HITL',x,y+2);
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t = frame % LOOP;
    var stageIdx = Math.floor(t / SEG);
    var segT = (t % SEG) / SEG;
    var progress = (stageIdx + segT * 0.92) / (STAGES.length - 1);
    if(progress > 1) progress = 1;

    ctx.clearRect(0,0,W,H);

    var pad = Math.max(16, W * 0.04);
    var bandTop = pad + 8;
    var bandH = Math.min(44, H * 0.12);
    var pathTop = bandTop + bandH + 24;
    var pathBot = H - pad - 52;

    drawBands(pad, bandTop, bandH);

    var pts = pathPoints(pad, pathTop, pathBot);
    drawPathLine(pts, progress);

    STAGES.forEach(function(st,i){
      var done = i < stageIdx;
      var active = i === stageIdx;
      drawNode(pts.xs[i], pts.ys[i], 16, st, active, done, frame);
    });

    var navIdx = Math.min(stageIdx, STAGES.length-2);
    var nx = pts.xs[navIdx] + (pts.xs[navIdx+1]-pts.xs[navIdx]) * segT * 0.92;
    var ny = pts.ys[navIdx] + (pts.ys[navIdx+1]-pts.ys[navIdx]) * segT * 0.92;
    if(stageIdx >= STAGES.length-1){
      nx = pts.xs[STAGES.length-1];
      ny = pts.ys[STAGES.length-1];
    }
    drawNavigator(nx, ny - 18, frame);

    if(stageIdx >= 1) drawKpiSpark(pad, pathBot + 8, 78, 36, Math.min(1, segT+0.3));
    if(stageIdx >= 3) drawGovernanceShield(W - pad - 36, pathTop - 6, 14, Math.min(1, segT+0.2));

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='right';
    ctx.fillText('Шаблон AI-roadmap · Nero Network', W - pad, H - pad + 4);

    requestAnimationFrame(loop);
  }

  requestAnimationFrame(loop);
})();
</script>
</section>
      <h3 class="ais26-h3 reveal" id="----">Диагностика зрелости и аудит процессов</h3>
      <p class="ais26-p reveal">Первый шаг разработки AI-стратегии — аудит: карта ключевых процессов, инвентарь текущих AI-экспериментов, оценка качества данных (CRM, ERP, документы), выявление shadow AI. McKinsey предлагает оценивать зрелость по пяти блокам RAI; на практике достаточно упрощённой матрицы: стратегия, данные, технологии, governance, готовность команд.</p>
      <p class="ais26-p reveal">Барьеры, которые фиксирует исследование Билайн: неопределённый ROI, сложность интеграции, нехватка готовых решений под конкретную задачу. Диагностика отвечает на вопрос «с чего начать внедрение AI в бизнес-процессы», а не «какой LLM купить».</p>
      <h3 class="ais26-h3 reveal" id="----kpi">Приоритизация кейсов, бюджет и KPI</h3>
      <p class="ais26-p reveal">После аудита формируется матрица «эффект × сложность × риск». Рекомендуемый портфель: <strong>2–3 quick wins</strong> (быстрое доказательство ROI руководству) + <strong>1 стратегический кейс</strong> с горизонтом 6–12 месяцев. KPI привязываются к операционным метрикам: время обработки заявки, конверсия, стоимость контакта, точность прогноза — а не к «количеству внедрённых нейросетей».</p>
      <p class="ais26-p reveal">Бюджет на 12 месяцев включает: лицензии LLM/SaaS, интеграции, обучение, пилоты, резерв на governance. Для сравнения: стоимость одного корпоративного пилота <strong>5–15 млн ₽</strong> без стратегии часто не окупается; документ стратегии (ориентир <strong>250 тыс.–1,5 млн ₽</strong> у Nero Network) задаёт рамки до крупных трат.</p>
      <h3 class="ais26-h3 reveal" id="-ai-roadmap--">Шаблон AI-roadmap (лид-магнит)</h3>
      <p class="ais26-p reveal">Практический артефакт AI-стратегии — <strong>шаблон AI-roadmap</strong>: таблица этапов с горизонтами <strong>0–3 / 3–6 / 6–12 / 12+</strong> месяцев (по аналогии с фреймворком Forrester AEGIS для agentic AI). В roadmap фиксируются: use cases, владельцы, бюджет, KPI, риски, критерии перехода пилот → production.</p>
      <p class="ais26-p reveal">Nero Network передаёт шаблон AI-roadmap как лид-магнит: его можно заполнить самостоятельно для первичной приоритизации или получить в составе консалтинга «под ключ» с адаптацией под отрасль и ИТ-ландшафт клиента.</p>
      <div class="ym-cta-block ym-cta-block--primary" id="cta-roadmap">
  <div class="ym-cta-block__icon" aria-hidden="true">🗺️</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получите шаблон AI-roadmap и экспресс-диагностику</p>
    <p class="ym-cta-block__sub">Заполните дорожную карту с горизонтами 0–3 / 3–6 / 6–12 месяцев: use cases, владельцы, бюджет, KPI и критерии перехода пилот → production. Команда Nero Network адаптирует шаблон под ваш отраслевой контур и ИТ-ландшафт.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Собрать AI-стратегию</a>
  </div>
</div>
      <h3 class="ais26-h3 reveal" id="-cdo-ai-lead--">Роли: CDO, AI lead, внешний интегратор</h3>
      <p class="ais26-p reveal">Оргмодель AI-трансформации — <strong>hub-and-spoke</strong> (центр компетенций + амбассадоры в подразделениях). Ключевые роли:</p>
      <ul class="ais26-ul reveal">
      <li><strong>CDO / директор по данным</strong> — стратегия, data governance, связка с советом директоров.</li>
      <li><strong>AI lead</strong> — портфель инициатив, техническая архитектура, MLOps/LLMOps.</li>
      <li><strong>Бизнес-владелец процесса</strong> — KPI и принятие решений о масштабировании; по данным vc.ru (2026), лишь <strong>~7%</strong> ответственности за AI-трансформацию лежит на коммерческом директоре — это организационная ошибка.</li>
      <li><strong>Внешний интегратор</strong> (Nero Network) — roadmap, пилот на Make/n8n, amoCRM/Bitrix24, RAG, AI-агенты с передачей компетенций внутренней команде.</li>
      </ul>
      <p class="ais26-p reveal">Опыт «Северстали»: <strong>~500 ИИ-амбассадоров</strong>, платформа <strong>ДаВинчи</strong>, библиотека ИИ-решений и сообщество «ГенИИ» — модель, где стратегия поддерживается change management, а не только IT-департаментом.</p>
    </div>
  </section>

  <section class="ais26-section" id="vnedrenie">
    <div class="ais26-cnt">
      <div class="ais26-sh reveal">
        <span class="ais26-eyebrow">AI-стратегия</span>
        <h2>Внедрение AI в бизнес-процессы: от плана к масштабированию</h2>
      </div>
        <!-- INTERNAL-LINKS:INSERT -->
      <p class="ais26-p reveal">Стратегия без внедрения — презентация. Внедрение AI в бизнес-процессы следует roadmap: пилоты с измеримым эффектом, затем масштабирование по единым стандартам.</p>
      <h3 class="ais26-h3 reveal" id="--production--">Пилоты → production: критерии перехода</h3>
      <p class="ais26-p reveal">Эталон системного подхода — <strong>X5 Group</strong> и контур <strong>AI Core</strong>: инфраструктура, MLOps, A/B-тестирование (ABsalute), доступ к LLM (AI-Run), агентные сценарии. Успешные пилоты переводятся в промышленную эксплуатацию по единым стандартам качества, безопасности и оценки эффекта. Результат: <strong>~5 млрд ₽</strong> дополнительной операционной прибыли за 2025 год; план 2026–2027 — системное встраивание AI в операционную модель.</p>
      <p class="ais26-p reveal">Критерии перехода пилот → production:</p>
      <ul class="ais26-ul reveal"><li>подтверждённый ROI (финмодель, A/B где возможно);</li><li>мониторинг качества и дрейфа модели;</li><li>регламенты безопасности и логирование действий;</li><li>назначенный бизнес-владелец и план обучения пользователей.</li></ul>
      <h3 class="ais26-h3 reveal" id="ai----ai-">AI-автоматизация бизнеса и AI-агенты</h3>
      <p class="ais26-p reveal"><strong>AI-автоматизация бизнеса</strong> в 2026 году включает классические сценарии (документы, поддержка, квалификация лидов) и <strong>AI-агентов</strong> — систем, которые рассуждают и выполняют цепочки действий. По обзору it-institute.ru (со ссылкой на ВШЭ), <strong>59%</strong> российских компаний рассматривают AI-агентов в 2026, при этом лишь <strong>6%</strong> имеют формализованную стратегию их внедрения.</p>
      <p class="ais26-p reveal">Агенты требуют <strong>decision rights matrix</strong>: какие действия автономны, где обязателен human-in-the-loop, какие лимиты API и stop-controls действуют. Фреймворк Forrester <strong>AEGIS</strong> (governance, identity, data, application security, threat response, Zero Trust) задаёт поэтапное внедрение guardrails на <strong>0–3 / 3–6 / 6–12 / 12+</strong> месяцев — статические политики недостаточны для систем, которые рассуждают и действуют.</p>
      <h3 class="ais26-h3 reveal" id="---crmerp-ai-----crm">Связка стратегии с CRM/ERP (<code>ai стратегия для бизнеса с CRM</code>)</h3>
      <p class="ais26-p reveal">AI-стратегия не существует в вакууме: она связывает точечные внедрения в <strong>CRM</strong> (amoCRM, Bitrix24 — квалификация лидов, агенты продаж), <strong>ERP</strong>, телефонию и мессенджеры (Telegram, WhatsApp, VK) в единый план. Оркестрация — через Make.com, n8n; модели — YandexGPT, GigaChat, OpenAI/Claude по политике данных клиента; база знаний — RAG по регламентам и CRM.</p>
      <p class="ais26-p reveal">Кейс <strong>Ингосстраха</strong>: платформа <strong>Kolmogorov AI</strong> + <strong>Data Ocean Nova</strong> — полный цикл данных и моделей (скоринг, риски, персонализация). Для финсектора и регулируемых отраслей стратегия начинается с data governance и model ops, а не с «чат-бота для сайта».</p>
      <p class="ais26-p reveal">Узкие интеграции (amoCRM, 1С/ERP, email+CRM) — <strong>этапы после стратегии</strong>, а не замена ей.</p>
      <h3 class="ais26-h3 reveal" id="------">Внедрение без программиста: когда возможно, когда нет</h3>
      <p class="ais26-p reveal"><strong>Внедрение AI без программиста</strong> возможно на уровне: no-code автоматизации (Make, n8n), готовых SaaS с AI, корпоративных чатов с LLM, простых RAG по документам. Этого достаточно для quick wins в маркетинге, HR-скрининге, базовой поддержке.</p>
      <p class="ais26-p reveal">Программисты и data-инженеры нужны, когда: кастомные модели, интеграция с ERP/1С, agentic-сценарии с необратимыми действиями, MLOps-платформа уровня X5 AI Core или Ингосстраха. AI-стратегия честно разделяет оба контура и не обещает «полную автоматизацию без IT» там, где это технически и регуляторно невозможно.</p>
    </div>
  </section>

  <section class="ais26-section ais26-section-alt" id="pod-klyuch">
    <div class="ais26-cnt">
      <div class="ais26-sh reveal">
        <span class="ais26-eyebrow">AI-стратегия</span>
        <h2>AI-стратегия для бизнеса под ключ: услуга Nero Network</h2>
      </div>
      <p class="ais26-p reveal">Nero Network разрабатывает <strong>AI-стратегию для бизнеса под ключ</strong> для среднего и крупного сегмента: от диагностики до пилота с измеримым KPI. Срок проекта — <strong>4–8 недель</strong>; на выходе — документ стратегии, приоритизированный backlog use cases, бюджет на 12 месяцев, KPI-дашборд, шаблон AI-roadmap, карта рисков agentic AI.</p>
      <h3 class="ais26-h3 reveal" id="-----kpi-">Что входит: процессы, риски, бюджет, KPI, этапы</h3>
      <p class="ais26-p reveal"><strong>Модули услуги:</strong></p>
      <ol class="ais26-ol reveal"><li><strong>Карта процессов и data readiness</strong> — аудит узких мест и качества данных.</li><li><strong>Портфель AI-инициатив с ROI-моделью</strong> — матрица приоритетов.</li><li><strong>Оргмодель</strong> — AI CoE, амбассадоры, роли CDO / AI lead / бизнес-владелец.</li><li><strong>Risk & compliance</strong> — в том числе agentic AI, 152-ФЗ, политики использования нейросетей.</li><li><strong>Технологическая архитектура</strong> — интеграции, MLOps/LLMOps lite.</li><li><strong>Change management и обучение</strong> — закрытие gap McKinsey: 60% организаций не хватает обучения по responsible AI.</li></ol>
      <p class="ais26-p reveal"><strong>Логика по неделям:</strong> диагностика (1–2) → стратегия и приоритеты (2–3) → roadmap и бюджет (3–4) → governance agentic AI (4–5) → пилот и передача (5–8).</p>
      <h3 class="ais26-h3 reveal" id="-----">Под ключ или самостоятельно: сравнение подходов</h3>
      <div class="ais26-table-wrap reveal"><table class="ais26-table"><thead><tr><th>Критерий</th><th>Самостоятельно</th><th>Под ключ с Nero Network</th></tr></thead><tbody><tr><td>Срок до roadmap</td><td>2–4 мес. (если нет экспертизы)</td><td>4–8 недель</td></tr><tr><td>Риск повторить ошибки 90% пилотов</td><td>Высокий</td><td>Снижается за счёт эталонов (X5, Северсталь)</td></tr><tr><td>Agentic governance</td><td>Часто пропускается</td><td>Включён в стратегию</td></tr><tr><td>Пилот</td><td>Отдельный проект</td><td>Один пилот в составе услуги</td></tr><tr><td>Стоимость ошибки</td><td>Пилот 5–15 млн ₽ без плана</td><td>Стратегия 250 тыс.–1,5 млн ₽ до крупных трат</td></tr></tbody></table></div>
      <div class="ym-cta-block ym-cta-block--dual" id="cta-pod-klyuch">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">AI-стратегия под ключ за 4–8 недель</p>
    <p class="ym-cta-block__sub">Диагностика → приоритеты и бюджет → governance agentic AI → пилот с KPI. На выходе: документ стратегии, backlog use cases, KPI-дашборд, карта рисков и шаблон roadmap. Ориентир чека: 250 тыс.–1,5 млн ₽ — до бюджетов на пилоты 5–15 млн ₽ без плана.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Собрать AI-стратегию</a>
      <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы разработки →</a>
    </div>
  </div>
</div>
      <h3 class="ais26-h3 reveal" id="cta---ai-">CTA — «Собрать AI-стратегию»</h3>
      <p class="ais26-p reveal">Оставьте заявку на <strong>разработку AI-стратегии</strong> — команда Nero Network проведёт экспресс-диагностику, предложит формат (консультация / полный roadmap / внедрение под ключ) и передаст <strong>шаблон AI-roadmap</strong> для старта приоритизации. <strong>CTA: Собрать AI-стратегию.</strong></p>
    </div>
  </section>

  <section class="ais26-section" id="ceny">
    <div class="ais26-cnt">
      <div class="ais26-sh reveal">
        <span class="ais26-eyebrow">AI-стратегия</span>
        <h2>Сколько стоит AI-стратегия для бизнеса: цена и ориентиры чека</h2>
      </div>
      <p class="ais26-p reveal">Прямых публичных прайсов «заказали AI-стратегию у интегратора за X ₽» в открытых источниках мало — чаще публикуют платформы и результаты. Nero Network ориентируется на чек <strong>250 тыс.–1,5 млн ₽</strong> в зависимости от масштаба компании и глубины внедрения.</p>
      <h3 class="ais26-h3 reveal" id="-250-15-----">Диапазон 250 тыс.–1,5 млн ₽: от чего зависит</h3>
      <p class="ais26-p reveal"><strong>Факторы стоимости AI-стратегии:</strong></p>
      <ul class="ais26-ul reveal"><li>количество бизнес-направлений и процессов в аудите;</li><li>зрелость данных и число существующих пилотов;</li><li>необходимость отраслевого compliance (финансы, страхование, промышленность);</li><li>включение пилота (Make/n8n, CRM, RAG, агент);</li><li>формат: документ + roadmap vs стратегия с сопровождением 3–6 месяцев.</li></ul>
      <p class="ais26-p reveal">Для сравнения с рынком: у конкурентов корпоративные пилоты — <strong>2–10 млн ₽</strong> (addamant.ru), MVP от 1 недели (umbrellait.ru). <strong>AI-стратегия по цене 250 тыс.–1,5 млн ₽</strong> — инвестиция в план до бюджетов на пилоты <strong>5–15 млн ₽</strong>.</p>
      <h3 class="ais26-h3 reveal" id="-----">Для малого, среднего и крупного бизнеса</h3>
      <ul class="ais26-ul reveal">
      <li><strong>Малый бизнес:</strong> упрощённая консультация и roadmap на 3–5 use cases; нижняя граница чека; фокус на SaaS и no-code.</li>
      <li><strong>Средний бизнес</strong> (оборот от ~800 млн ₽): полная стратегия по модели Билайн-выборки — приоритеты, KPI, связка с CRM, 1–2 пилота.</li>
      <li><strong>Крупный бизнес:</strong> расширенный аудит, org model с амбассадорами (модель Северстали), интеграция с корпоративными платформами, agentic governance по McKinsey/Forrester; верхняя граница чека и опция сопровождения.</li>
      </ul>
    </div>
  </section>

  <section class="ais26-section ais26-section-alt" id="keisy">
    <div class="ais26-cnt">
      <div class="ais26-sh reveal">
        <span class="ais26-eyebrow">AI-стратегия</span>
        <h2>Кейсы и примеры внедрения AI-стратегии</h2>
      </div>
      <p class="ais26-p reveal">Публичные кейсы редко называются «заказали стратегию», но показывают, <strong>какие задачи решает AI-стратегия</strong> на практике.</p>
      <h3 class="ais26-h3 reveal" id="----roadmap----">Типовой сценарий: диагностика → roadmap → пилоты → масштаб</h3>
      <p class="ais26-p reveal"><strong>Сценарий Nero Network</strong> (проектная модель, не публичный кейс клиента):</p>
      <ol class="ais26-ol reveal"><li>Диагностика shadow AI и пилотов (нед. 1–2).</li><li>Матрица приоритетов и бюджет 12 мес. (нед. 2–4).</li><li>Пилот: AI-агент квалификации лидов в amoCRM + RAG по регламентам (нед. 5–8).</li><li>Замер KPI, план масштабирования на смежные процессы.</li></ol>
      <p class="ais26-p reveal"><strong>Эталоны из российской практики:</strong></p>
      <ul class="ais26-ul reveal"><li><strong>X5 Group</strong> — платформа AI Core, единые стандарты, <strong>~5 млрд ₽</strong> операционной прибыли за 2025 г.</li><li><strong>Северсталь</strong> — ДаВинчи, библиотека решений, <strong>500</strong> амбассадоров, <strong>429</strong> заявок на конкурс GenAI-проектов.</li><li><strong>Ингосстрах</strong> — Kolmogorov AI, десятки моделей в prod с мониторингом.</li></ul>
      <h3 class="ais26-h3 reveal" id="---roi">Метрики успеха и ROI</h3>
      <p class="ais26-p reveal">KPI AI-стратегии привязываются к бизнесу, а не к IT:</p>
      <ul class="ais26-ul reveal"><li>операционная прибыль / экономия FTE (X5: финмодели и A/B);</li><li>время цикла «идея → промышленная модель» (Ингосстрах);</li><li>доля процессов с измеримым AI-эффектом;</li><li>зрелость RAI по 5 измерениям McKinsey (целевой рост с 2,3 к 3+);</li><li>снижение shadow AI за счёт официальных инструментов и обучения.</li></ul>
      <p class="ais26-p reveal">Денис Филиппов (MWS AI, ComNews, апр. 2026): <em>«2026 может стать годом масштабирования: те, кто получил результат в одном кейсе, будут искать новые точки»</em> — стратегия как карта этих «новых точек».</p>
    </div>
  </section>

  <section class="ais26-section" id="riski">
    <div class="ais26-cnt">
      <div class="ais26-sh reveal">
        <span class="ais26-eyebrow">AI-стратегия</span>
        <h2>Риски, compliance и ответственность при внедрении AI</h2>
      </div>
      <p class="ais26-p reveal"><strong>Управление рисками AI</strong> в 2026 году — обязательный раздел стратегии, особенно при внедрении нейросетей и агентов в регулируемых контурах.</p>
      <h3 class="ais26-h3 reveal" id="-----">Данные, галлюцинации, ответственность за решения агентов</h3>
      <p class="ais26-p reveal"><strong>ICO (UK)</strong> в отчёте Tech Futures: Agentic AI фиксирует риски для персональных данных — controller/processor в цепочке, избыточный доступ к БД, отсутствие мониторинга и stop-controls. В российском контексте аналог — <strong>152-ФЗ</strong>: ответственность за compliance остаётся у организации, разворачивающей агента.</p>
      <p class="ais26-p reveal"><strong>Галлюцинации</strong> LLM в сочетании с автономными действиями в CRM/ERP (Forrester AEGIS, ICO) требуют: human-in-the-loop для необратимых операций, логирование, лимиты автономии. Как предупреждает РБК Компании: <em>«Нельзя сначала автоматизировать, а потом думать, кто отвечает»</em>.</p>
      <p class="ais26-p reveal">McKinsey: перенос decision rights без accountability — ключевой организационный риск agentic AI. В стратегии фиксируется <strong>decision rights matrix</strong>: кто утверждает, кто мониторит, кто останавливает агента.</p>
      <h3 class="ais26-h3 reveal" id="governance----">Governance и политики использования нейросетей</h3>
      <p class="ais26-p reveal">Блок governance включает:</p>
      <ul class="ais26-ul reveal"><li>политику допустимых данных для LLM (корпоративный контур vs публичные сервисы);</li><li>классификацию сценариев по уровню риска;</li><li>обучение сотрудников (закрытие 60% gap по McKinsey);</li><li>реагирование на инциденты и аудит действий агентов.</li></ul>
      <p class="ais26-p reveal">Shadow AI — использование нейросетей без согласования — выше официального внедрения (Билайн, ЦИПР 2026). Стратегия легализует инструменты и снижает репутационные и правовые риски.</p>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда не готова к agentic AI без обучения?</p>
    <p class="ym-cta-block__sub">По данным McKinsey State of AI Trust 2026, ~60% организаций не хватает знаний по responsible AI. Перед масштабированием агентов полезно разобраться в governance, human-in-the-loop и no-code автоматизации — это ускоряет согласование стратегии с советом директоров. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
  </div>
</aside>
    </div>
  </section>

  <section class="ais26-section ais26-section-alt" id="faq">
    <div class="ais26-cnt">
      <div class="ais26-sh reveal">
        <span class="ais26-eyebrow">FAQ</span>
        <h2>FAQ — частые вопросы об AI-стратегии</h2>
      </div>
      <div class="ais26-faq"></div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <section class="ais26-section ais26-section-alt" id="itog">
    <div class="ais26-cnt">
      <div class="ym-cta-block ym-cta-block--primary ym-cta-block--final" id="cta-final">
  <div class="ym-cta-block__icon" aria-hidden="true">🎯</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы перейти от пилотов к управляемой AI-трансформации?</p>
    <p class="ym-cta-block__sub">97% крупных компаний экспериментируют с ИИ, но только 26% имеют формализованную стратегию. Оставьте заявку — проведём экспресс-диагностику, предложим формат (консультация / roadmap / внедрение под ключ) и передадим шаблон AI-roadmap.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?> style="font-size:16px;padding:16px 36px">Собрать AI-стратегию</a>
  </div>
</div>
      <div class="ais26-card reveal">
        <p class="ais26-p"><strong>Итог.</strong> AI-стратегия компании на 2026 год — это переход от хаотичных пилотов к управляемой трансформации: доверие, agentic governance, российские эталоны (X5, Северсталь, Ингосстрах) и честная статистика рынка (97%/26%, 90% провалов пилотов). Nero Network помогает <strong>собрать AI-стратегию</strong> за 4–8 недель — с roadmap, бюджетом, KPI и пилотом.</p>
      </div>
    </div>
  </section>
</div>

<script>
/**
 * ais26-strategy-hero-engine — «Комната AI-roadmap 2026»
 * Центр: RoadmapRoundTable · Поток: PilotChaosStream · Финал: печать ROADMAP 2026 + KpiPulseBeacon
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ais26-strategy-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 240;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
    scale = Math.min(cw / 440, ch / 260) * 1.08;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#334155",
    soft: "#94a3b8",
    table: "#e2e8f0",
    tableActive: "#c4b5fd",
    q1: "#fef3c7",
    q2: "#dbeafe",
    q3: "#d1fae5",
    q4: "#ede9fe",
    pilotChaos: "#f97316",
    pilotOrder: "#8b5cf6",
    govern: "#10b981",
    budget: "#3b82f6",
    kpi: "#22c55e",
    stamp: "#7c3aed",
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
      ctx.lineWidth = 1.4;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Внешняя орбита хаотичных пилотов — вместо Conveyor */
  function PilotChaosStream() {
    this.sparks = [];
    for (var i = 0; i < 9; i++) {
      this.sparks.push({
        angle: (i / 9) * Math.PI * 2 + Math.random(),
        radius: 118 + (i % 3) * 8,
        speed: 0.018 + (i % 4) * 0.004,
        chaos: 0.4 + (i % 5) * 0.12,
        lane: i % 4
      });
    }
  }
  PilotChaosStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    var order = prg > 95 ? Math.min(1, (prg - 95) / 45) : 0;

    this.sparks.forEach(function (s, i) {
      var wobble = Math.sin(frame * 0.07 + i) * s.chaos * (1 - order);
      var ang = s.angle + frame * s.speed + wobble;
      var rad = s.radius - order * 42;
      var x = Math.cos(ang) * rad;
      var y = Math.sin(ang) * rad * 0.72;

      if (order > 0.65) {
        var targets = [
          { x: -38, y: -18 },
          { x: 38, y: -18 },
          { x: 38, y: 22 },
          { x: -38, y: 22 }
        ];
        var t = targets[s.lane];
        x = x * (1 - order) + t.x * order;
        y = y * (1 - order) + t.y * order;
      }

      var col = order < 0.5 ? C.pilotChaos : C.pilotOrder;
      ctx.fillStyle = col;
      ctx.beginPath();
      ctx.arc(x, y, 4 + order * 1.5, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1;
      ctx.stroke();
    });
  };

  /* Пятиугольник RAI maturity */
  function RaiMaturityRadar() {
    this.fill = 0;
  }
  RaiMaturityRadar.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    var cx0 = -118, cy0 = -52;
    var pts = 5;
    var maxR = 28;
    this.fill = prg > 42 && prg < 200 ? Math.min(1, (prg - 42) / 50) : prg >= 200 ? 1 : 0;

    ctx.strokeStyle = "rgba(148,163,184,0.45)";
    ctx.lineWidth = 1;
    for (var ring = 1; ring <= 3; ring++) {
      ctx.beginPath();
      for (var p = 0; p <= pts; p++) {
        var a = -Math.PI / 2 + (p / pts) * Math.PI * 2;
        var rr = maxR * (ring / 3);
        var px = cx0 + Math.cos(a) * rr;
        var py = cy0 + Math.sin(a) * rr;
        if (p === 0) ctx.moveTo(px, py);
        else ctx.lineTo(px, py);
      }
      ctx.stroke();
    }

    if (this.fill > 0) {
      var values = [0.55, 0.7, 0.62, 0.48, 0.58];
      ctx.fillStyle = "rgba(139,92,246,0.22)";
      ctx.strokeStyle = C.pilotOrder;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      for (var v = 0; v <= pts; v++) {
        var ai = -Math.PI / 2 + (v / pts) * Math.PI * 2;
        var val = values[v % pts] * this.fill;
        var rx = cx0 + Math.cos(ai) * maxR * val;
        var ry = cy0 + Math.sin(ai) * maxR * val;
        if (v === 0) ctx.moveTo(rx, ry);
        else ctx.lineTo(rx, ry);
      }
      ctx.fill();
      ctx.stroke();
      ctx.fillStyle = C.outline;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("RAI", cx0, cy0 + 3);
    }
  };

  /* Кольцо agentic governance */
  function GovernanceOrbitRing() {
    this.spin = 0;
  }
  GovernanceOrbitRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 148) return;
    this.spin = (prg - 148) * 0.04;
    var alpha = Math.min(1, (prg - 148) / 25);
    ctx.save();
    ctx.globalAlpha = alpha;
    ctx.strokeStyle = C.govern;
    ctx.lineWidth = 2;
    ctx.setLineDash([6, 5]);
    ctx.beginPath();
    ctx.ellipse(0, 0, 92, 64, 0, 0, Math.PI * 2);
    ctx.stroke();
    ctx.setLineDash([]);
    for (var n = 0; n < 6; n++) {
      var na = this.spin + (n / 6) * Math.PI * 2;
      var nx = Math.cos(na) * 92;
      var ny = Math.sin(na) * 64;
      drawRR(ctx, nx - 5, ny - 5, 10, 10, 3, "rgba(16,185,129,0.25)", C.govern);
    }
    ctx.restore();
  };

  /* Дуга бюджета 12 мес. */
  function BudgetGaugeArc() {
    this.level = 0;
  }
  BudgetGaugeArc.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 155) return;
    this.level = Math.min(1, (prg - 155) / 35);
    var gx = 108, gy = 8;
    ctx.strokeStyle = "#e2e8f0";
    ctx.lineWidth = 6;
    ctx.beginPath();
    ctx.arc(gx, gy, 26, Math.PI, 0);
    ctx.stroke();
    ctx.strokeStyle = C.budget;
    ctx.beginPath();
    ctx.arc(gx, gy, 26, Math.PI, Math.PI + Math.PI * this.level);
    ctx.stroke();
    ctx.fillStyle = C.outline;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("12м", gx, gy + 4);
  };

  /* Матрица decision rights */
  function DecisionRightsMatrix() {
    this.lit = 0;
  }
  DecisionRightsMatrix.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 162) return;
    this.lit = Math.min(1, (prg - 162) / 28);
    var mx = 102, my = -58;
    for (var r = 0; r < 3; r++) {
      for (var c = 0; c < 3; c++) {
        var on = (r + c) < Math.floor(this.lit * 6);
        drawRR(ctx, mx + c * 14, my + r * 14, 11, 11, 2,
          on ? "rgba(59,130,246,0.35)" : "rgba(226,232,240,0.8)", C.soft);
      }
    }
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("rights", mx, my - 5);
  };

  /* Круглый стол roadmap — вместо WebsiteTerminal */
  function RoadmapRoundTable() {
    this.stamp = 0;
  }
  RoadmapRoundTable.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    var quarters = [C.q1, C.q2, C.q3, C.q4];
    var labels = ["Q1", "Q2", "Q3", "Q4"];

    ctx.fillStyle = C.table;
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.ellipse(0, 4, 78, 52, 0, 0, Math.PI * 2);
    ctx.fill();
    ctx.stroke();

    for (var q = 0; q < 4; q++) {
      var start = -Math.PI / 2 + (q / 4) * Math.PI * 2;
      var end = start + Math.PI / 2;
      var active = prg > 98 + q * 12;
      ctx.fillStyle = active ? quarters[q] : "rgba(255,255,255,0.5)";
      ctx.beginPath();
      ctx.moveTo(0, 4);
      ctx.arc(0, 4, 70, start, end);
      ctx.closePath();
      ctx.fill();
      if (active) {
        var mid = (start + end) / 2;
        ctx.fillStyle = C.outline;
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(labels[q], Math.cos(mid) * 42, 4 + Math.sin(mid) * 30);
      }
    }

    drawRR(ctx, -16, -10, 32, 26, 6, "#fff", C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("2026", 0, 6);

    if (prg >= 198) {
      this.stamp = Math.min(1, (prg - 198) / 16);
      ctx.save();
      ctx.translate(0, 4);
      ctx.rotate(-0.12 * this.stamp);
      ctx.globalAlpha = this.stamp;
      ctx.strokeStyle = C.stamp;
      ctx.lineWidth = 2;
      ctx.strokeRect(-34, -14, 68, 28);
      ctx.fillStyle = C.stamp;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("ROADMAP", 0, -2);
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("SEALED", 0, 10);
      ctx.restore();
    }
  };

  /* Финальный KPI-маяк — вместо ракеты */
  function KpiPulseBeacon() {
    this.wave = 0;
  }
  KpiPulseBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 210) return;
    this.wave = (prg - 210) / 30;
    var alpha = 1 - this.wave;
    ctx.save();
    ctx.globalAlpha = alpha * 0.55;
    for (var w = 0; w < 3; w++) {
      var rr = 20 + this.wave * 55 + w * 12;
      ctx.strokeStyle = C.kpi;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(0, -62, rr, 0, Math.PI * 2);
      ctx.stroke();
    }
    ctx.fillStyle = C.kpi;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.globalAlpha = Math.min(1, alpha + 0.3);
    ctx.fillText("KPI ✓", 0, -58);
    ctx.restore();
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
    var prg = (frame * 0.04) % 240;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var tableTargets = {
      "1_architect": { x: -95, y: 8 },
      "2_seo": { x: -32, y: -58 },
      "3_coder": { x: 48, y: -48 },
      "4_designer": { x: 82, y: 18 },
      "5_deployer": { x: -70, y: 52 }
    };
    var tgt = tableTargets[this.role] || { x: 0, y: 0 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        var ease = local / 11;
        this.x = this.baseX + (tgt.x - this.baseX) * ease;
        this.y = this.baseY + (tgt.y - this.baseY) * ease;
      } else if (local < 15) {
        this.x = tgt.x;
        this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        var back = (local - 15) / 7;
        this.x = tgt.x - (tgt.x - this.baseX) * back;
        this.y = tgt.y - (tgt.y - this.baseY) * back;
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.4) * 1;
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 6;
      legL = Math.sin(wp) * 4;
      legR = Math.sin(wp + Math.PI) * 4;
    }
    drawRR(ctx, -8, -3 + Math.max(0, legL), 7, 11, 2, C.outline, null);
    drawRR(ctx, 1, -3 + Math.max(0, legR), 7, 11, 2, C.outline, null);
    drawRR(ctx, -11, -9 - bob, 22, 14, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -20 - bob, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.3;
    ctx.stroke();
    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath();
    ctx.arc(3, -21 - bob, 3, 0, Math.PI * 2);
    ctx.arc(-3, -21 - bob, 3, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath();
    ctx.arc(4, -21 - bob, 1.5, 0, Math.PI * 2);
    ctx.arc(-2, -21 - bob, 1.5, 0, Math.PI * 2);
    ctx.fill();
    ctx.restore();
    if (carryType) {
      drawRR(ctx, -14 * faceDir, -16 - bob, 12, 12, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new PilotChaosStream());
  entities.push(new RaiMaturityRadar());
  entities.push(new GovernanceOrbitRing());
  entities.push(new BudgetGaugeArc());
  entities.push(new DecisionRightsMatrix());
  entities.push(new RoadmapRoundTable());
  entities.push(new KpiPulseBeacon());

  entities.push(new Agent(-125, 42, C.agentYellow, "1_architect", 18,
    ["Shadow AI в 4 отделах", "Карта процессов готова", "Аудит зрелости RAI"]));
  entities.push(new Agent(-105, -28, C.agentGreen, "2_seo", 52,
    ["Матрица эффект×риск", "3 quick wins в портфель", "KPI к P&L"]));
  entities.push(new Agent(108, -22, C.agentBlue, "3_coder", 88,
    ["CRM + агенты в roadmap", "Make/n8n оркестрация", "Пилот → production"]));
  entities.push(new Agent(118, 48, C.agentPink, "4_designer", 122,
    ["KPI-дашборд для C-level", "Шаблон roadmap", "RAI 2,3 → 3+"]));
  entities.push(new Agent(-108, 68, C.agentPurple, "5_deployer", 168,
    ["Decision rights matrix", "Governance до пилота", "Печать roadmap 2026"]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.04) % 240;
    if (prg >= 16 && prg < 16.05) createBubble(-118, -70, "1. Аудит зрелости", 200);
    if (prg >= 56 && prg < 56.05) createBubble(-32, -72, "2. Приоритеты use cases", 200);
    if (prg >= 96 && prg < 96.05) createBubble(0, -8, "3. Бюджет 12 мес.", 200);
    if (prg >= 152 && prg < 152.05) createBubble(70, -10, "4. Agentic governance", 200);
    if (prg >= 205 && prg < 205.05) createBubble(0, -75, "5. Roadmap sealed!", 200);

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var bx = bub.x;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2 + 1);
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

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

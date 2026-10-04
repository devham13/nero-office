<?php
/**
 * Template Name: AI-квалификация лидов: внедрение и скоринг под ключ
 * Description: Внедрение AI-скоринга лидов, матрица hot/warm/cold/junk, интеграция с CRM.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-квалификация лидов под ключ — внедрение и скоринг в CRM';
$page_seo_description = 'Внедрим AI-скоринг лидов до передачи менеджеру: статусы горячий, тёплый, холодный, нецелевой. Интеграция с CRM и мессенджерами. Получите матрицу квалификации.';

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
    ['label' => 'Зачем', 'href' => '#zachem'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Получить карту квалификации';
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
/* ── Hero ai-kvalifikaciya-lidov: самодостаточные стили (Kadence / .nero-ai-home) ── */
.akl-hero-qual {
  --akl-cyan: #38bdf8;
  --akl-orange: #f97316;
  --akl-violet: #a78bfa;
  --akl-green: #22c55e;
  --akl-rose: #fb7185;
  --akl-text: #e8eef8;
  --akl-muted: #9aa8bd;
  --akl-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.akl-hero-qual.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.akl-hero-qual::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.akl-hero-qual::after {
  content: "";
  position: absolute;
  right: -8%;
  top: 8%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(249, 115, 22, .14), transparent 66%);
  filter: blur(8px);
  animation: aklHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aklHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .85; transform: scale(1.05); }
}
.akl-hero-qual .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.akl-hero-qual .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.akl-hero-qual .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: 1.02;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.akl-hero-qual .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--akl-orange) 42%, var(--akl-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.akl-hero-qual .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(249, 115, 22, 0.25);
  border-radius: 999px;
  background: rgba(249, 115, 22, 0.1);
  color: #fdba74 !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.akl-hero-qual .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--akl-muted) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.akl-hero-qual .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.akl-hero-qual .nero-ai-badge {
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
.akl-hero-qual .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.akl-hero-qual .nero-ai-btn {
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
.akl-hero-qual .nero-ai-btn:hover { transform: translateY(-2px); }
.akl-hero-qual .nero-ai-btn-primary {
  color: #1a0a02 !important;
  background: linear-gradient(135deg, var(--akl-orange), #fbbf24);
  box-shadow: 0 18px 42px rgba(249, 115, 22, 0.28);
}
.akl-hero-qual .nero-ai-btn-secondary {
  color: var(--akl-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.akl-hero-qual .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--akl-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.akl-hero-qual .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.akl-hero-qual .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.akl-hero-qual .nero-ai-dots { display: flex; gap: 7px; }
.akl-hero-qual .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.akl-hero-qual .nero-ai-dot:nth-child(1) { background: #fb7185; }
.akl-hero-qual .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.akl-hero-qual .nero-ai-dot:nth-child(3) { background: #34d399; }
.akl-hero-qual .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: 0.04em;
  opacity: .85;
}
.akl-hero-qual .nero-ai-window-body { padding: 16px 16px 14px; }
.akl-hero-qual .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.akl-hero-qual .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 15px;
  font-weight: 800;
  color: #e8eef8;
}
.akl-hero-qual .nero-ai-live-pill {
  padding: 5px 10px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.15);
  border: 1px solid rgba(34, 197, 94, 0.35);
  color: #86efac;
  font-size: 11px;
  font-weight: 800;
}
.akl-hero-qual .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.akl-hero-qual .nero-ai-metric {
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.akl-hero-qual .nero-ai-metric span {
  display: block;
  font-size: 10px;
  color: var(--akl-muted);
  margin-bottom: 4px;
}
.akl-hero-qual .nero-ai-metric strong {
  display: block;
  font-size: 20px;
  color: #fff;
  line-height: 1.1;
}
.akl-hero-qual .nero-ai-metric small {
  display: block;
  margin-top: 2px;
  font-size: 10px;
  color: #7c8aa3;
}
.akl-hero-qual .akl-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin: 4px 0 12px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.08);
  background: radial-gradient(circle at 50% 45%, rgba(56,189,248,.08), rgba(2,6,23,.6));
}
.akl-hero-qual #akl-lead-qual-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.akl-hero-qual .nero-ai-task-stream { display: flex; flex-direction: column; gap: 8px; }
.akl-hero-qual .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 12px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.06);
  font-size: 12px;
}
.akl-hero-qual .nero-ai-task-icon {
  width: 28px;
  height: 28px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(249,115,22,.15);
  color: #fdba74;
  font-size: 11px;
  font-weight: 800;
}
.akl-hero-qual .nero-ai-task strong { display: block; color: #e8eef8; font-size: 12px; }
.akl-hero-qual .nero-ai-task span { color: #8b9bb3; font-size: 11px; }
.akl-hero-qual .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 800;
  background: rgba(34,197,94,.15);
  color: #86efac;
  border: 1px solid rgba(34,197,94,.3);
}
.akl-hero-qual .nero-ai-status--hot {
  background: rgba(249,115,22,.18);
  color: #fdba74;
  border-color: rgba(249,115,22,.35);
}
.akl-hero-qual .nero-ai-status--cold {
  background: rgba(56,189,248,.12);
  color: #7dd3fc;
  border-color: rgba(56,189,248,.3);
}
.akl-hero-qual .nero-ai-status--junk {
  background: rgba(251,113,133,.12);
  color: #fda4af;
  border-color: rgba(251,113,133,.3);
}
@media (max-width: 960px) {
  .akl-hero-qual .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .akl-hero-qual .nero-ai-dashboard { transform: none; }
}
</style>
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

.akl-content{
  --akl-bg:#050711;--akl-bg2:#080b17;
  --akl-surface:rgba(255,255,255,.072);
  --akl-text:#e6edf7;--akl-muted:#9aa8bd;--akl-soft:#c7d2e5;--akl-heading:#fff;
  --akl-border:rgba(255,255,255,.10);
  --akl-accent:#f97316;--akl-violet:#a78bfa;--akl-cyan:#38bdf8;--akl-green:#22c55e;
  --akl-btn-from:#ea580c;--akl-btn-to:#7c3aed;
  --akl-r:18px;--akl-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--akl-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.akl-content *,.akl-content *::before,.akl-content *::after{box-sizing:border-box;}
.akl-content a{color:inherit;}
.akl-content p{color:var(--akl-muted);line-height:1.72;margin:0 0 1em;text-align:left;}
.akl-content h2,.akl-content h3,.akl-content h4{color:var(--akl-heading);letter-spacing:-.04em;margin:0 0 .7em;}
.akl-content strong{color:var(--akl-soft);}
.akl-cnt{width:min(var(--akl-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.akl-section{padding:clamp(64px,8vw,100px) 0;position:relative;}
.akl-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);
}
.akl-sh{max-width:820px;margin:0 auto 40px;text-align:left;}
.akl-sh h2{font-size:clamp(26px,4vw,44px);line-height:1.08;}
.akl-sh p{font-size:clamp(15px,1.6vw,17px);}
.akl-eyebrow{
  display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;
  background:rgba(249,115,22,.1);border:1px solid rgba(249,115,22,.25);
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#fdba74;margin-bottom:14px;
}
.akl-intro-grid{display:grid;grid-template-columns:minmax(0,1.1fr) minmax(280px,.9fr);gap:clamp(28px,4vw,48px);align-items:start;}
.akl-intro-text{text-align:left!important;position:relative;padding-left:18px;}
.akl-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:3px;
  background:linear-gradient(180deg,var(--akl-accent),var(--akl-violet));
}
.akl-intro-text p{text-align:left!important;}
.akl-intro-kpi{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;}
.akl-kpi-card{
  padding:16px;border-radius:14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
}
.akl-kpi-card .kv{font-size:22px;font-weight:800;color:#fff;}
.akl-kpi-card .kl{font-size:12px;color:var(--akl-muted);margin-top:4px;line-height:1.4;}
.akl-toc-outer{padding:8px 0 32px;}
.akl-toc{
  display:flex;flex-wrap:wrap;gap:10px;justify-content:center;list-style:none;margin:0;padding:0;
}
.akl-toc a{
  display:inline-flex;padding:10px 16px;border-radius:999px;font-size:13px;font-weight:700;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);text-decoration:none!important;
  color:var(--akl-soft)!important;transition:border-color .2s,background .2s;
}
.akl-toc a:hover{border-color:rgba(249,115,22,.45);background:rgba(249,115,22,.08);}
.akl-prose{max-width:820px;}
.akl-prose-wide{max-width:960px;}
.akl-callout{
  padding:18px 20px;border-radius:14px;background:rgba(56,189,248,.08);
  border:1px solid rgba(56,189,248,.22);margin:20px 0;
}
.akl-callout strong{color:#7dd3fc;}
.akl-table-wrap{overflow-x:auto;margin:24px 0;border-radius:14px;border:1px solid var(--akl-border);}
.akl-table{width:100%;border-collapse:collapse;font-size:14px;}
.akl-table th,.akl-table td{padding:13px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.06);vertical-align:top;}
.akl-table th{background:rgba(255,255,255,.06);color:var(--akl-soft);font-weight:700;}
.akl-table tr:last-child td{border-bottom:none;}
.akl-bento{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin:28px 0;}
.akl-bento-card{
  padding:20px;border-radius:16px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
}
.akl-bento-card h3{font-size:17px;margin-bottom:8px;}
.akl-bento-card p{font-size:14px;margin:0;}
.akl-list{margin:0 0 1em;padding:0;list-style:none;}
.akl-list li{
  padding-left:20px;position:relative;margin-bottom:.5em;color:var(--akl-muted);font-size:15px;line-height:1.65;
}
.akl-list li::before{content:'›';position:absolute;left:0;color:var(--akl-accent);font-weight:700;}
.akl-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.akl-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.akl-faq-q{
  padding:18px 22px;font-size:16px;font-weight:700;color:var(--akl-heading);cursor:pointer;
  display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;
}
.akl-faq-q::after{content:'▾';font-size:13px;color:var(--akl-accent);transition:transform .25s;}
.akl-faq-item.open .akl-faq-q::after{transform:rotate(180deg);}
.akl-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--akl-muted);line-height:1.72;}
.akl-faq-item.open .akl-faq-a{max-height:800px;padding:0 22px 18px;}
.ym-cta-block{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(249,115,22,.14),rgba(167,139,250,.1));
  border:1px solid rgba(249,115,22,.28);text-align:center;
}
.ym-cta-block--secondary{
  background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;
}
.ym-cta-block--footer-final{
  background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(249,115,22,.1));
  border-color:rgba(167,139,250,.3);
}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--akl-muted);font-size:15px;margin:0 auto 22px;max-width:640px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:#fdba74!important;text-decoration:underline;text-underline-offset:3px;}
.ym-btn{display:inline-flex;align-items:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
@media(max-width:900px){
  .akl-intro-grid{grid-template-columns:1fr;}
  .akl-bento{grid-template-columns:1fr;}
  .akl-intro-kpi{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}.akl-intro-kpi{grid-template-columns:1fr;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-kvalifikaciya-lidov-page" role="main" tabindex="-1">

<section class="akl-hero-qual nero-ai-hero nero-ai-section" id="top" aria-labelledby="akl-hero-title">
  <div class="nero-ai-container">
    <div class="nero-ai-hero-grid">
      <div class="nero-ai-hero-copy">
        <span class="nero-ai-eyebrow">Продажи / лиды · 2026</span>
        <h1 id="akl-hero-title">AI-квалификация лидов: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
        <p class="nero-ai-hero-lead">AI присваивает лиду статус — горячий, тёплый, холодный или нецелевой — до передачи менеджеру в CRM</p>
        <ul class="nero-ai-badges" aria-label="Ключевые этапы">
          <li class="nero-ai-badge">Скоринг hot / warm / cold / junk</li>
          <li class="nero-ai-badge">Матрица BANT</li>
          <li class="nero-ai-badge">amoCRM / Битрикс24</li>
          <li class="nero-ai-badge">HITL на пилоте</li>
        </ul>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Получить карту квалификации</a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Этапы внедрения</a>
        </div>
      </div>

      <div class="nero-ai-dashboard" aria-label="Демонстрация AI-квалификации лидов">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">пример логики AI-скоринга · демонстрационные данные</span>
          </div>
          <div class="nero-ai-window-body">
            <div class="nero-ai-dashboard-title">
              <h3>Центр квалификации лидов</h3>
              <span class="nero-ai-live-pill">онлайн</span>
            </div>
            <div class="nero-ai-metrics-grid">
              <div class="nero-ai-metric">
                <span>Входящих за смену</span>
                <strong>128</strong>
                <small>сайт · TG · звонок</small>
              </div>
              <div class="nero-ai-metric">
                <span>До статуса в CRM</span>
                <strong>38 сек</strong>
                <small>webhook → скоринг</small>
              </div>
              <div class="nero-ai-metric">
                <span>Горячих эскалировано</span>
                <strong>19</strong>
                <small>менеджеру с брифом</small>
              </div>
              <div class="nero-ai-metric">
                <span>Нецелевых отсечено</span>
                <strong>41</strong>
                <small>без звонка в ОП</small>
              </div>
            </div>
            <div class="akl-dash-canvas-wrap">
              <canvas id="akl-lead-qual-canvas" role="img" aria-label="Анимация: заявки с каналов проходят AI-скоринг и получают статус до передачи менеджеру"></canvas>
            </div>
            <div class="nero-ai-task-stream" aria-label="Лента квалификации">
              <div class="nero-ai-task">
                <span class="nero-ai-task-icon">TG</span>
                <div><strong>Заявка: внедрение под ключ</strong><span>BANT: бюджет ✓ · срок 3 нед</span></div>
                <span class="nero-ai-status nero-ai-status--hot">горячий</span>
              </div>
              <div class="nero-ai-task">
                <span class="nero-ai-task-icon">☎</span>
                <div><strong>Звонок: «интересно, но позже»</strong><span>Низкий приоритет · nurture</span></div>
                <span class="nero-ai-status nero-ai-status--cold">холодный</span>
              </div>
              <div class="nero-ai-task">
                <span class="nero-ai-task-icon">◎</span>
                <div><strong>Форма сайта: спам-оффер</strong><span>Анти-портрет ICP</span></div>
                <span class="nero-ai-status nero-ai-status--junk">нецелевой</span>
              </div>
              <div class="nero-ai-task">
                <span class="nero-ai-task-icon">✓</span>
                <div><strong>HITL: согласие с AI 94%</strong><span>пилот · неделя 2</span></div>
                <span class="nero-ai-status">контроль</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="akl-content">

<section class="akl-section" id="vvedenie" aria-label="Введение">
  <div class="akl-cnt">
    <div class="akl-intro-grid nero-ai-reveal">
      <div class="akl-intro-text">
        <span class="akl-eyebrow">Лонгрид · AI-квалификация лидов</span>
        <p>Менеджеры открывают CRM и видят десятки одинаковых заявок «оставил контакты» — без бюджета, срока и понимания, кто перед ними: ЛПР или студент. <strong>AI-квалификация лидов</strong> снимает этот слой рутины: система собирает данные из формы, чата, почты или звонка, присваивает статус <strong>горячий / тёплый / холодный / нецелевой</strong> и передаёт в отдел продаж только то, что стоит времени. Nero Network внедряет <strong>скоринг лидов AI</strong> и <strong>автоматизацию квалификации клиентов</strong> под ключ — с матрицей критериев, интеграцией с amoCRM и Битрикс24 и режимом контроля качества (HITL).</p>
      </div>
      <div class="akl-intro-kpi" aria-label="Ориентиры скоринга">
        <div class="akl-kpi-card"><div class="kv">hot</div><div class="kl">Горячий — эскалация менеджеру</div></div>
        <div class="akl-kpi-card"><div class="kv">warm</div><div class="kl">Тёплый — nurture и дожим</div></div>
        <div class="akl-kpi-card"><div class="kv">cold</div><div class="kl">Холодный — отложенный контакт</div></div>
        <div class="akl-kpi-card"><div class="kv">junk</div><div class="kl">Нецелевой — закрытие с причиной</div></div>
      </div>
    </div>
    <nav class="akl-toc-outer" aria-label="Оглавление">
      <ul class="akl-toc ym-toc">
        <li><a href="#zachem">Зачем</a></li>
        <li><a href="#kak-rabotaet">Как работает</a></li>
        <li><a href="#etapy">Этапы</a></li>
        <li><a href="#integracii">Интеграции</a></li>
        <li><a href="#ceny">Стоимость</a></li>
        <li><a href="#keisy">Кейсы</a></li>
        <li><a href="#faq">FAQ</a></li>
      </ul>
    </nav>
  </div>
</section>

<section class="akl-section">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>Определение: что такое AI-квалификация лидов</h2></div>
    <div class="akl-prose akl-prose-wide"><div class="akl-callout"><p><strong>Коротко:</strong> это автоматизированная первичная оценка входящего обращения <strong>до</strong> работы менеджера.</p></div>
<p><strong>AI-квалификация лидов</strong> — не «чат-бот ради чат-бота», а связка процессов: приём обращения из канала → уточнение или анализ текста → сопоставление с ICP и методикой (<strong>BANT</strong>: бюджет, полномочия, потребность, сроки; или <strong>MQL/SQL</strong>) → запись структурированного контекста в CRM → <strong>маршрутизация</strong> (горячий — ответственный или слот в календаре; тёплый — nurture; холодный — отложенный контакт; нецелевой — закрытие с причиной).</p>
<p>Отличие от классического lead scoring в CRM: встроенный <strong>скоринг лидов</strong> в amoCRM или <strong>AI-скоринг</strong> в Битрикс24 опирается на поля, действия и историю сделок. <strong>AI лид скоринг</strong> на LLM закрывает <strong>неструктурированный</strong> текст — переписку в Telegram, письмо, транскрипт звонка, сообщение с Авито — и может вести короткий диалог из 3–5 вопросов по согласованному скрипту.</p></div>
  </div>
</section>

<section class="akl-section" id="zachem">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>Зачем отделу продаж AI-квалификация лидов</h2></div>
    <div class="akl-prose akl-prose-wide"><p>Боль, с которой приходят B2B-услуги, агентства, девелоперы и внутренние отделы продаж: <strong>менеджеры тратят время на нецелевых клиентов</strong>. Заявка формально есть, а сделки нет — из-за несовпадения бюджета, географии, продукта или отсутствия ЛПР.</p>
<h3 id="zachem-h3">Сколько времени уходит на «холодных» без скоринга</h3>
<p>Без <strong>автоматизации квалификации клиентов</strong> каждый входящий попадает в одну очередь. Менеджер вручную выясняет одно и то же: чем занимаетесь, какой объём, когда нужно, кто принимает решение. При потоке от 50–100 обращений в месяц это уже полноценная нагрузка на 1–2 FTE, при этом <strong>горячие</strong> лиды ждут ответа часами — а в B2B скорость первого контакта напрямую бьёт по конверсии.</p>
<p>По данным кейса Velmi (публикация на Habr, Bitrix24): время ответа сократилось с <strong>2–3 часов до 30–40 секунд</strong>; доля квалифицированных лидов выросла на <strong>35%</strong>; экономия порядка <strong>50 ч/мес</strong> на менеджеров. Это ориентир одного внедрения, не универсальная гарантия — но показывает, где лежит выигрыш: в SLA первого касания и в отсечении мусора до CRM.</p>
<h3 id="zachem-h3">Чем отличается ручная квалификация от ai лид скоринг</h3>
<div class="akl-table-wrap"><table class="akl-table"><thead><tr><th>Критерий</th><th>Ручная квалификация</th><th>AI-скоринг и диалог</th></tr></thead><tbody><tr><td>Скорость первого ответа</td><td>Зависит от графика менеджера</td><td>Секунды–минуты, 24/7 на подключённых каналах</td></tr><tr><td>Единообразие вопросов</td><td>Разный стиль, пропуск полей</td><td>Скрипт и матрица критериев</td></tr><tr><td>Неструктурированные каналы</td><td>Слабо</td><td>Почта, звонок, мессенджеры, маркетплейсы</td></tr><tr><td>Прозрачность для РОПа</td><td>В голове у менеджера</td><td>Статус, балл, цитата-обоснование в карточке</td></tr><tr><td>Риск ошибки</td><td>Человеческий фактор, усталость</td><td>Нужны пороги, HITL и запрет автодействий на «спорных»</td></tr></tbody></table></div>
<div class="akl-callout"><p><strong>Итог блока:</strong> <strong>ai квалификация лидов для бизнеса</strong> — это способ вернуть менеджерам время на сделки, а не на первичный опрос.</p></div></div>
  </div>
</section>

<section class="akl-section">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>Тренд 2026: продажи и AI-агенты</h2></div>
    <div class="akl-prose akl-prose-wide"><p>По отчёту <strong>Salesforce State of Sales, 7-е издание (2026)</strong> (опрос <strong>4 050</strong> sales professionals, <strong>22 страны</strong>): <strong>87%</strong> организаций уже используют AI в продажах, в том числе для <strong>lead scoring</strong>; AI и агенты названы <strong>главной тактикой роста</strong> на 2026; <strong>54%</strong> продавцов уже использовали агентов, <strong>~9 из 10</strong> планируют к 2027. Ожидаемая экономия времени после внедрения агентов: <strong>−34%</strong> на research, <strong>−36%</strong> на черновики писем.</p>
<p>Adam Alfano, EVP Sales, Salesforce, формулирует задачу так: убрать busywork, чтобы команды фокусировались на том, что двигает сделки вперёд — и подчёркивает, что для агентов критичны <strong>единые данные в CRM</strong>, иначе «на выходе мусор». Для <strong>внедрения ai квалификация лидов</strong> это прямой аргумент: скоринг должен видеть форму, переписку и стадию в <strong>ai для crm</strong>, а не только последнее поле «имя».</p>
<p>Gartner рекомендует переходить от статических правил к <strong>AI-enabled dynamic scoring</strong> и управлять AI SDR-агентами как «цифровыми сотрудниками» с guardrails. McKinsey относит ML-приоритизацию лидов к базовым блокам автоматизации GTM. Для российского рынка важно не копировать глобальные проценты HubSpot, а опираться на <strong>примеры внедрения ai</strong> с именованными интеграторами и своей CRM.</p></div>
  </div>
</section>

<section class="akl-section" id="kak-rabotaet">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>Как работает скоринг лидов AI: статусы и правила</h2></div>
    <div class="akl-prose akl-prose-wide"><p>Оффер услуги Nero Network (из продуктовой матрицы): AI присваивает лиду статус <strong>горячий, тёплый, холодный, нецелевой</strong> — <strong>до</strong> передачи менеджеру. Ниже — рабочая логика <strong>матрицы квалификации лидов</strong> (лид-магнит «Получить карту квалификации» — блок для Артура).</p>

<div class="akl-cnt"><section id="ai-kvalifikaciya-lidov-boris-block" class="akl-root" aria-label="Анимация: пайплайн AI-квалификации лидов от webhook до CRM">
<style>
/* === БОРИС: prefix akl-, scoped внутри #ai-kvalifikaciya-lidov-boris-block === */
#ai-kvalifikaciya-lidov-boris-block.akl-root{
  padding:48px 0 56px;
  background:#f8fafc;
}
#ai-kvalifikaciya-lidov-boris-block .akl-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-kvalifikaciya-lidov-boris-block .akl-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:460px;
}
@media(max-width:1023px){
  #ai-kvalifikaciya-lidov-boris-block .akl-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-kvalifikaciya-lidov-boris-block .akl-lft{
  padding:36px 32px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-kvalifikaciya-lidov-boris-block .akl-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:28px 22px;
  }
}
#ai-kvalifikaciya-lidov-boris-block .akl-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#2563eb;
  margin:0 0 12px;
}
#ai-kvalifikaciya-lidov-boris-block .akl-ey::before{
  content:'';
  width:18px;height:2px;
  background:#2563eb;
  border-radius:1px;
}
#ai-kvalifikaciya-lidov-boris-block .akl-h3{
  font-size:clamp(19px,2.3vw,25px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 16px;
}
#ai-kvalifikaciya-lidov-boris-block .akl-ul{
  list-style:none;
  margin:0 0 18px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:8px;
}
#ai-kvalifikaciya-lidov-boris-block .akl-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.48;
  color:#334155;
}
#ai-kvalifikaciya-lidov-boris-block .akl-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(37,99,235,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:10px;
  font-weight:800;
  color:#1d4ed8;
  margin-top:1px;
  font-style:normal;
}
#ai-kvalifikaciya-lidov-boris-block .akl-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:14px;
}
#ai-kvalifikaciya-lidov-boris-block .akl-pl{
  padding:5px 11px;
  border-radius:99px;
  font-size:11px;
  font-weight:700;
  white-space:nowrap;
  border:1.5px solid transparent;
}
#ai-kvalifikaciya-lidov-boris-block .akl-pl-hot{
  background:rgba(239,68,68,.08);
  color:#b91c1c;
  border-color:rgba(239,68,68,.25);
}
#ai-kvalifikaciya-lidov-boris-block .akl-pl-warm{
  background:rgba(245,158,11,.1);
  color:#b45309;
  border-color:rgba(245,158,11,.28);
}
#ai-kvalifikaciya-lidov-boris-block .akl-pl-cold{
  background:rgba(59,130,246,.08);
  color:#1d4ed8;
  border-color:rgba(59,130,246,.22);
}
#ai-kvalifikaciya-lidov-boris-block .akl-pl-junk{
  background:rgba(148,163,184,.12);
  color:#475569;
  border-color:rgba(148,163,184,.35);
}
#ai-kvalifikaciya-lidov-boris-block .akl-foot{
  font-size:13px;
  color:#64748b;
  margin:0;
  line-height:1.45;
}
#ai-kvalifikaciya-lidov-boris-block .akl-foot a{
  color:#2563eb;
  text-decoration:underline;
  text-underline-offset:3px;
}
#ai-kvalifikaciya-lidov-boris-block .akl-rgt{
  position:relative;
  background:linear-gradient(145deg,#eff6ff 0%,#dbeafe 42%,#f8fafc 100%);
  min-height:400px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-kvalifikaciya-lidov-boris-block .akl-rgt{min-height:340px;}
}
#akl-scoring-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="akl-cnt">
  <div class="akl-card">
    <div class="akl-lft">
      <span class="akl-ey">Пайплайн квалификации</span>
      <h3 class="akl-h3">Один скоринг для сайта, мессенджеров, почты и звонка</h3>
      <ul class="akl-ul">
        <li><span class="akl-ic">1</span><strong>Webhook</strong> — лид из формы, Telegram или телефонии попадает в шину событий</li>
        <li><span class="akl-ic">2</span><strong>Очередь</strong> — асинхронная обработка (критично для Bitrix24 ≤3 с на webhook)</li>
        <li><span class="akl-ic">3</span><strong>LLM</strong> — диалог BANT, JSON со статусом и цитатой-обоснованием</li>
        <li><span class="akl-ic">4</span><strong>CRM</strong> — тег, стадия и бриф менеджеру до первого звонка</li>
      </ul>
      <div class="akl-pills" aria-hidden="false">
        <span class="akl-pl akl-pl-hot">Горячий</span>
        <span class="akl-pl akl-pl-warm">Тёплый</span>
        <span class="akl-pl akl-pl-cold">Холодный</span>
        <span class="akl-pl akl-pl-junk">Нецелевой</span>
      </div>
      <p class="akl-foot">Дальше — <a href="#etapy">этапы внедрения под ключ</a> и пилот HITL на одном канале.</p>
    </div>
    <div class="akl-rgt">
      <canvas
        id="akl-scoring-pipeline-canvas"
        role="img"
        aria-label="Анимация: лиды проходят webhook, очередь и LLM-скоринг и получают статус в CRM"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('akl-scoring-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a',
    muted:'#64748b',
    line:'rgba(37,99,235,.28)',
    node:'#ffffff',
    nodeBdr:'#93c5fd',
    queue:'#8b5cf6',
    llm:'#2563eb',
    crm:'#0ea5e9',
    hot:'#ef4444',
    warm:'#f59e0b',
    cold:'#3b82f6',
    junk:'#94a3b8',
    packet:'#fef3c7',
    packetBdr:'#f59e0b'
  };

  var STAGES = [
    {key:'in',   label:'Каналы', x:0, y:0},
    {key:'hook', label:'Webhook', x:0, y:0},
    {key:'q',    label:'Очередь', x:0, y:0},
    {key:'llm',  label:'LLM', x:0, y:0},
    {key:'crm',  label:'CRM', x:0, y:0}
  ];

  var STATUS = [
    {key:'hot',  label:'Горячий', color:C.hot},
    {key:'warm', label:'Тёплый', color:C.warm},
    {key:'cold', label:'Холодный', color:C.cold},
    {key:'junk', label:'Junk', color:C.junk}
  ];

  function rr(ctx,x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  function layoutStages(){
    var y = H * 0.52;
    var xs = [0.08, 0.26, 0.44, 0.62, 0.82];
    for(var i=0;i<STAGES.length;i++){
      STAGES[i].x = W * xs[i];
      STAGES[i].y = y;
    }
  }

  var leads = [];
  var crmPulse = 0;

  function spawnLead(){
    var st = STATUS[Math.floor(Math.random()*STATUS.length)];
    leads.push({
      t: 0,
      speed: 0.004 + Math.random()*0.002,
      status: st,
      channel: ['TG','Сайт','Почта','Звонок'][Math.floor(Math.random()*4)]
    });
  }

  function drawNode(s, r, accent){
    rr(ctx, s.x-r, s.y-r, r*2, r*2, r*0.32, C.node, accent || C.nodeBdr);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold ' + Math.max(10,r*0.26) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(s.label, s.x, s.y - 2);
    if(s.key === 'q'){
      ctx.fillStyle = C.queue;
      for(var i=0;i<3;i++){
        var ox = (i-1)*6;
        ctx.beginPath();
        ctx.arc(s.x+ox, s.y+r*0.35, 3, 0, Math.PI*2);
        ctx.fill();
      }
    }
    if(s.key === 'llm'){
      var pulse = 0.5+0.5*Math.sin(frame*0.07);
      ctx.strokeStyle = C.llm;
      ctx.lineWidth = 1.5 + pulse;
      ctx.globalAlpha = 0.25 + pulse*0.35;
      ctx.beginPath();
      ctx.arc(s.x, s.y, r+5+pulse*6, 0, Math.PI*2);
      ctx.stroke();
      ctx.globalAlpha = 1;
    }
  }

  function drawConnectors(){
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 2;
    ctx.setLineDash([5,4]);
    for(var i=0;i<STAGES.length-1;i++){
      ctx.beginPath();
      ctx.moveTo(STAGES[i].x + 28, STAGES[i].y);
      ctx.lineTo(STAGES[i+1].x - 28, STAGES[i+1].y);
      ctx.stroke();
    }
    ctx.setLineDash([]);
  }

  function drawPacket(x, y, ch, st){
    rr(ctx, x-18, y-11, 36, 22, 5, C.packet, C.packetBdr);
    ctx.fillStyle = C.ink;
    ctx.font = '9px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(ch, x, y+1);
    rr(ctx, x-22, y-22, 44, 14, 4, st.color, st.color);
    ctx.fillStyle = '#fff';
    ctx.font = 'bold 8px system-ui,sans-serif';
    ctx.fillText(st.label, x, y-14);
  }

  function drawCrmCard(alpha){
    if(alpha < 0.05) return;
    var x = W*0.72, y = H*0.14, w = W*0.22, h = H*0.32;
    ctx.globalAlpha = alpha;
    rr(ctx,x,y,w,h,10,'#fff',C.crm);
    ctx.fillStyle = C.crm;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Карточка лида', x+10, y+18);
    var rows = [
      {t:'BANT заполнен', c:C.hot},
      {t:'SLA: 38 сек', c:C.warm},
      {t:'HITL: согласовано', c:C.cold}
    ];
    for(var i=0;i<rows.length;i++){
      rr(ctx,x+8,y+26+i*24,w-16,18,4,'#f1f5f9','#e2e8f0');
      ctx.fillStyle = rows[i].c;
      ctx.fillRect(x+10,y+30+i*24,4,10);
      ctx.fillStyle = C.ink;
      ctx.font = '9px system-ui,sans-serif';
      ctx.fillText(rows[i].t, x+18, y+38+i*24);
    }
    ctx.globalAlpha = 1;
  }

  function posAlongPipeline(t){
    var seg = t * (STAGES.length - 1);
    var i = Math.min(STAGES.length - 2, Math.floor(seg));
    var f = seg - i;
    var a = STAGES[i], b = STAGES[i+1];
    var x = a.x + (b.x - a.x) * f;
    var y = a.y + Math.sin(f * Math.PI) * (-H*0.12);
    return {x:x, y:y};
  }

  function tick(){
    frame++;
    layoutStages();
    if(frame % 110 === 0) spawnLead();

    ctx.clearRect(0,0,W,H);

    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Единый скоринг · демо-поток', W*0.06, H*0.08);

    drawConnectors();
    var r = Math.min(W,H)*0.055;
    STAGES.forEach(function(s){ drawNode(s, r, s.key==='crm'?C.crm:C.nodeBdr); });

    leads = leads.filter(function(ld){
      ld.t += ld.speed;
      if(ld.t >= 1){
        crmPulse = Math.min(1, crmPulse + 0.08);
        return false;
      }
      var p = posAlongPipeline(ld.t);
      if(ld.t > 0.72) drawPacket(p.x, p.y, ld.channel, ld.status);
      else {
        rr(ctx,p.x-14,p.y-10,28,20,4,'#fff','#cbd5e1');
        ctx.fillStyle = C.muted;
        ctx.font = '8px system-ui,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText(ld.channel, p.x, p.y+2);
      }
      return true;
    });

    drawCrmCard(crmPulse * (0.65 + 0.35*Math.sin(frame*0.04)));

    if(crmPulse >= 1 && leads.length === 0){
      crmPulse = 0.3;
    }

    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
</section></div>
<!-- INTERNAL-LINKS:INSERT -->
<h3 id="kak-rabotaet-h3">Горячий, тёплый, холодный, нецелевой: критерии матрицы</h3>
<div class="akl-table-wrap"><table class="akl-table"><thead><tr><th>Статус</th><th>Типичные сигналы</th><th>Действие в CRM</th></tr></thead><tbody><tr><td><strong>Горячий</strong></td><td>ICP совпал, бюджет/объём выше порога, срок ≤ N недель, ЛПР подтверждён или высокая уверенность</td><td>Задача ответственному, уведомление, слот в календаре</td></tr><tr><td><strong>Тёплый</strong></td><td>Потребность есть, бюджет/срок неясны, не ЛПР</td><td>Nurture, серия касаний, повторный диалог AI или SDR</td></tr><tr><td><strong>Холодный</strong></td><td>Интерес слабый, срок «когда-нибудь», низкий приоритет</td><td>Отложенный контакт, тег, без звонка в первые 24 ч</td></tr><tr><td><strong>Нецелевой</strong></td><td>Анти-портрет: гео, продукт, спам, конкурент, нет бюджета</td><td>Автозакрытие или стадия «отказ» с <strong>причиной</strong> в карточке</td></tr></tbody></table></div>
<p>Веса критериев (бюджет, срок, роль, продукт, канал) фиксируются на этапе аудита — не «в голове у бота», а в документе, который вы согласуете с продажами. Это и есть <strong>настройка ai квалификация лидов</strong> в прикладном смысле.</p>
<h3 id="kak-rabotaet-h3">Автоматизация квалификации клиентов на сайте, в мессенджерах и по звонку</h3>
<p><strong>Единый скоринг</strong> — сильная сторона зрелого <strong>внедрения ai в бизнес процессы</strong> вокруг воронки:</p>
<ol class="akl-list">
<li>1. <strong>Сайт и формы</strong> — webhook при создании лида; поля формы + при необходимости уточняющий чат.</li>
<li>2. <strong>Telegram / WhatsApp</strong> — диалог по скрипту, извлечение BANT из текста.</li>
<li>3. <strong>Email</strong> — классификация темы, намерения, бюджета (кейс ENTERSALES: n8n + ИИ + роботы Bitrix24).</li>
<li>4. <strong>Звонок</strong> — транскрибация → тот же JSON-статус, что и для чата.</li>
<li>5. <strong>Авито и маркетплейсы</strong> — фильтр по объёму/категории (кейс BESTERS: <strong>6 500+</strong> сообщений обработано ИИ, <strong>1 263</strong> квалифицированных диалога, <strong>95%</strong> без участия человека на потоке).</li>
</ol>
<p>Технологическая цепочка (эталон для РФ): <strong>каналы</strong> → <strong>оркестратор</strong> (n8n, Make, FastAPI) → <strong>очередь</strong> (критично для Bitrix24: лимит webhook ~<strong>3 с</strong>, иначе обрыв — паттерн Velmi: Redis) → <strong>LLM / классификатор</strong> (JSON-схема, function calling) → <strong>CRM + телефония</strong> → <strong>дашборд качества</strong> (согласие менеджера с оценкой AI).</p>
<div class="akl-callout"><p><strong>Коротко:</strong> <strong>скоринг лидов ai</strong> — это один «язык статусов» для всех каналов <strong>ai воронка продаж</strong>, а не пять разных правил в пяти мессенджерах.</p></div></div>
  </div>
</section>

<section class="akl-section">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>Три слоя скоринга: что выбрать</h2></div>
    <div class="akl-prose akl-prose-wide"><p>Уникальный угол материала Nero Network — не сводить всё к одному боту:</p>
<ol class="akl-list">
<li>1. <strong>Правила и баллы CRM</strong> — amoCRM Professional scoring, роботы Битрикс24. Плюс: предсказуемость. Минус: нужны заполненные поля и действия.</li>
<li>2. <strong>ML-скоринг CRM</strong> — «Лаборатория AI» в Битрикс24 на исторических сделках; для обучения часто нужен порядок <strong>~2000 закрытых сделок</strong> (ориентир интеграторов).</li>
<li>3. <strong>LLM-агент</strong> — диалог, почта, звонок, неструктурированный текст; гибрид с (1)–(2): AI заполняет поля, CRM считает балл.</li>
</ol>
<div class="akl-callout"><p><strong>Итог:</strong> если у вас уже есть <strong>ai для crm</strong> scoring, <strong>интеграция ai квалификация лидов с crm</strong> дополняет его там, где текст не ложится в чекбоксы.</p></div></div>
  </div>
</section>

<section class="akl-section akl-section-alt" id="etapy">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>Внедрение AI-квалификации лидов под ключ: этапы и сроки</h2></div>
    <div class="akl-prose akl-prose-wide"><p><strong>ai квалификация лидов под ключ</strong> в Nero Network — проект с измеримыми этапами, а не «подписка на токены».</p>
<h3 id="etapy-h3">Аудит воронки и ai воронка продаж</h3>
<p><strong>3–5 рабочих дней:</strong> карта каналов, полей CRM, ICP и анти-портрета, доля «мусорных» лидов, текущий SLA ответа, скрипты менеджеров. На выходе — список узких мест и приоритет канала для пилота (часто Telegram или форма сайта).</p>
<h3 id="etapy-h3">Настройка ai квалификация лидов: данные, промпты, эскалация менеджеру</h3>
<ol class="akl-list">
<li>1. <strong>Матрица квалификации</strong> — критерии, веса, пороги hot/warm/cold/junk, правила эскалации (что AI делает сам, что только предлагает).</li>
<li>2. <strong>Пилот на одном канале</strong> с режимом <strong>HITL</strong>: 1–2 недели каждая оценка AI видна супервайзеру; метрика «% согласия менеджеров с AI».</li>
<li>3. <strong>Подключение остальных каналов</strong> + звонки.</li>
<li>4. <strong>Аналитика</strong> — доля нецелевых до менеджера, time-to-first-touch.</li>
</ol>
<p>Ориентир рынка по сроку до прода при похожем scope: <strong>3–4 недели</strong> (практика интеграторов, один канал). <strong>Как внедрить ai квалификация лидов</strong> без хаоса: поэтапный rollout (аналог подхода Noltis: 10% → 100% трафика), а не «включить на всё сразу».</p>
<p><strong>Что нужно от заказчика:</strong> ICP, 20–50 примеров реальных диалогов/заявок, карта полей CRM, политика ПДн, выбор модели (РФ/зарубеж).</p></div>
  </div>
</section>

<div class="akl-cnt">
<div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
  <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получить карту квалификации</p>
    <p class="ym-cta-block__sub">Матрица квалификации лидов: критерии hot / warm / cold / junk, веса и эскалация — база для ai квалификация лидов под ключ. В Telegram обсудим ваши каналы, CRM и пороги до сметы проекта 150–450 тыс. ₽.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Получить карту квалификации'); ?></a>
  </div>
</div>
</div>

<section class="akl-section akl-section-alt" id="integracii">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>Интеграция с CRM и каналами лидогенерации</h2></div>
    <div class="akl-prose akl-prose-wide"><h3 id="integracii-h3">amoCRM, Битрикс24, HubSpot, формы и телефония</h3>
<p>Для РФ-внедрений фокус — <strong>amoCRM</strong> и <strong>Битрикс24</strong>; HubSpot уместен в блоке сравнения для компаний с глобальным стеком.</p>
<ul class="akl-list">
<li><strong>amoCRM:</strong> webhook (в т.ч. form-urlencoded — см. разбор axdigital + Claude), теги, примечание с BANT <strong>до</strong> открытия карточки менеджером; кейс Aspirity: <strong>244</strong> обращения за пилот, <strong>134</strong> квалифицированных лида менеджерам, <strong>61</strong> нерелевантных отсеяно, цикл сделки с <strong>8 до 2,6</strong> дня (кейс интегратора, ниша на странице кейса).</li>
<li><strong>Битрикс24:</strong> роботы, стадии, AI-скоринг; асинхронная очередь обязательна при тяжёлом LLM.</li>
<li><strong>Телефония:</strong> ATS + SpeechKit или иной STT по политике данных.</li>
<li><strong>Формы:</strong> Tilda, WordPress, custom webhook.</li>
</ul>
<h3 id="integracii-h3">Интеграция ai квалификация лидов с crm без потери истории лида</h3>
<p>Принципы:</p>
<ul class="akl-list">
<li>Один <strong>lead_id</strong> / сделка — все касания в таймлайне.</li>
<li>AI пишет <strong>структурированное резюме</strong> и статус, не затирая исходные сообщения.</li>
<li>Спорные кейсы — стадия «на проверку» (модель трёх корзин ICP / не цель / review из международной практики Eventus + HubSpot).</li>
</ul>
<p>Связка с другими сценариями Nero Network (агент в amoCRM, обработка почты в CRM) — <strong>следующий шаг одной воронки</strong>, без подмены этой услуги.</p></div>
  </div>
</section>

<div class="akl-cnt">
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать архитектуру до старта проекта?</p>
    <p class="ym-cta-block__sub">Если перед пилотом нужно разобрать оркестратор, промпты и human-in-the-loop — <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование матрицы с отделом продаж.</p>
  </div>
</aside>
</div>

<section class="akl-section">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>AI для отдела продаж: роли менеджера и AI-агента</h2></div>
    <div class="akl-prose akl-prose-wide"><p><strong>ai для отдела продаж</strong> не заменяет closers. AI-агент закрывает top-of-funnel:</p>
<p><strong>Делает AI:</strong> классификация намерения, уточняющие вопросы, извлечение бюджета/срока/роли, присвоение статуса, маршрутизация, первый ответ в SLA.</p>
<p><strong>Остаётся за человеком:</strong> переговоры, нестандартные сделки, юридически значимые обещания, спорные статусы, утверждение матрицы.</p>
<p>Salesforce в анонсе 2026 приводит внутренний пример: за 4 месяца агенты обработали <strong>130 000</strong> лидов и создали <strong>3 200</strong> opportunities — масштаб корпорации, но иллюстрация роли агентов в потоке.</p>
<p><strong>Возражение «AI ошибётся»:</strong> автозакрываем только <strong>junk</strong> с высокой уверенностью; hot — уведомление, не автоматический договор; обязательный HITL на пилоте.</p></div>
  </div>
</section>

<section class="akl-section" id="ceny">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>Стоимость и формат проекта</h2></div>
    <div class="akl-prose akl-prose-wide"><p>Коммерческий ориентир из продуктовой матрицы Nero Network: <strong>150–450 тыс. ₽</strong> за проект <strong>внедрение ai квалификация лидов</strong> (не фиксированный прайс в сниппете — смета после аудита).</p>
<h3 id="ceny-h3">Из чего складывается смета ai квалификация лидов цена</h3>
<div class="akl-table-wrap"><table class="akl-table"><thead><tr><th>Компонент</th><th>Что входит</th></tr></thead><tbody><tr><td>Аудит и матрица</td><td>Воркшоп с продажами, документ критериев, лид-магнит</td></tr><tr><td>Интеграции</td><td>CRM, 1–N каналов, телефония, очередь</td></tr><tr><td>LLM-слой</td><td>Промпты, JSON-схема, логирование, выбор YandexGPT/GigaChat vs обезличивание</td></tr><tr><td>Пилот HITL</td><td>Дашборд согласия, правки порогов</td></tr><tr><td>Запуск и обучение</td><td>Регламент для менеджеров, РОП</td></tr></tbody></table></div>
<p>На рынке встречается подписочная модель от <strong>~20 000 ₽/мес</strong> за пакет квалификаций (отдельные интеграторы) — проектный формат Nero Network ориентирован на <strong>артефакт матрицы</strong> и интеграцию в вашу CRM, а не на абстрактный «чат».</p>
<p>Сравнение с ФОТ: <strong>50 ч/мес</strong> менеджеров (кейс Velmi) — это уже сопоставимый порядок затрат с нижней границей проекта при стабильном потоке.</p>
<p><strong>Когда не нужен проект:</strong> если стабильно <strong><30–50</strong> целевых обращений в месяц и один менеджер успевает квалифицировать вручную — ROI <strong>автоматизации через ai квалификация лидов</strong> может не сойтись; честный отсев на пресейле.</p></div>
  </div>
</section>

<section class="akl-section akl-section-alt" id="keisy">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>Кейсы и примеры внедрения ai квалификация лидов</h2></div>
    <div class="akl-prose akl-prose-wide"><h3 id="keisy-h3">Россия</h3>
<p><strong>Aspirity + AmoCRM</strong> — BANT-диалог, запись на просмотр, передача менеджеру (<a href="https://aspirity.ru/cases/crm-ai-integration-sales" target="_blank" rel="noopener noreferrer">кейс</a>).</p>
<p><strong>Velmi + Bitrix24</strong> — FastAPI, Redis, GPT; ответ <strong>30–40 с</strong> (<a href="https://habr.com/ru/articles/1045026/" target="_blank" rel="noopener noreferrer">Habr</a>).</p>
<p><strong>BESTERS, завод, Авито</strong> — фильтр по объёму, <strong>15 ₽</strong> за квалифицированный диалог в публикации (<a href="https://workspace.ru/cases/avtomatizaciya-prodazh-na-avito-s-pomoschyu-ii-keys-zavoda-s-95-razgruzkoy-otdela-prodazh/" target="_blank" rel="noopener noreferrer">workspace.ru</a>).</p>
<p><strong>ENTERSALES</strong> — почта и телефония, n8n, лиды только по «хорошим» обращениям (<a href="https://entersales.ru/articles/avtomatizatsiya/keys-kak-my-avtomatizirovali-obrabotku-lidov-v-bitriks24-s-pomoshchyu-ii-i-n8n/" target="_blank" rel="noopener noreferrer">статья</a>).</p>
<h3 id="keisy-h3">Международный контекст (с оговоркой)</h3>
<p>HubSpot Customer Agent: на странице продукта указаны <strong>средние</strong> +90% лидов, +60% MQL у клиентов с агентом — агрегат, не гарантия для каждого внедрения. Aerotech: win rate <strong>15% → 25%</strong>, время закрытия <strong>309 → 135</strong> дней. Использовать как фон тренда, не как обещание на лендинге.</p>
<p><strong>ai кейсы внедрения</strong> в кластере квалификации в РФ уже позволяют блок доказательности без выдуманных метрик Nero Network.</p></div>
  </div>
</section>

<section class="akl-section">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>152-ФЗ и хранение данных лида при LLM</h2></div>
    <div class="akl-prose akl-prose-wide"><p>Текст заявки (ФИО, телефон) — <strong>персональные данные</strong>. Передача в облачную LLM требует основания, <strong>договора поручения</strong>, учёта локализации (ст. 18 152-ФЗ), при трансграничной передаче — уведомления РКН (ст. 12).</p>
<p><strong>Практики 2025–2026:</strong></p>
<ul class="akl-list">
<li>Чувствительные потоки — <strong>YandexGPT / GigaChat</strong>, российский хостинг.</li>
<li>Зарубежный API — <strong>обезличивание</strong>, запрет обучения на данных клиента, отдельная политика для записей звонков.</li>
</ul>
<p>Юридический блок — частый пробел у конкурентов; для B2B с ПДн это аргумент в пользу <strong>внедрение ai решений</strong> с compliance-by-design.</p></div>
  </div>
</section>

<section class="akl-section akl-section-alt" id="faq"><div class="akl-cnt"><div class="akl-sh"><h2>FAQ: как внедрить ai квалификация лидов</h2></div><div class="akl-faq"><div class="akl-faq-item"><div class="akl-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько длится внедрение?</div><div class="akl-faq-a"><p>Пилот на одном канале — ориентир <strong>3–4 недели</strong> до промышленного режима при готовой CRM и примерах диалогов.</p></div></div><div class="akl-faq-item"><div class="akl-faq-q" role="button" tabindex="0" aria-expanded="false">Заменит ли AI менеджеров?</div><div class="akl-faq-a"><p>Нет. Снимает первичный опрос и маршрутизацию; закрытие и переговоры — у людей.</p></div></div><div class="akl-faq-item"><div class="akl-faq-q" role="button" tabindex="0" aria-expanded="false">Какая точность скоринга?</div><div class="akl-faq-a"><p>Зависит от матрицы и данных обучения на ваших примерах; на пилоте измеряем <strong>согласие менеджеров с AI</strong> и правим пороги. Обзоры рынка (The Starr Conspiracy, 2025) указывают медианный рост конверсии MQL→SQL <strong>~28%</strong> при AI-скоринге vs rule-based — вторичный бенчмарк, не обещание проекта.</p></div></div><div class="akl-faq-item"><div class="akl-faq-q" role="button" tabindex="0" aria-expanded="false">Что если AI ошибся?</div><div class="akl-faq-a"><p>HITL, стадия «на проверку», запрет автодействий на hot; junk автозакрываем только при высокой уверенности.</p></div></div><div class="akl-faq-item"><div class="akl-faq-q" role="button" tabindex="0" aria-expanded="false">ai квалификация лидов для малого бизнеса</strong> — имеет смысл при потоке, где менеджер физически не успевает отвечать в SLA; иначе достаточно матрицы и полуавтоматики в CRM.</p>
<p><strong>Нужен ли HubSpot?</div><div class="akl-faq-a"><p>Нет. Типовой стек — amoCRM / Битрикс24 + оркестратор + LLM по политике ПДн.</p></div></div><div class="akl-faq-item"><div class="akl-faq-q" role="button" tabindex="0" aria-expanded="false">Чем отличается от «просто внедрение ai в бизнес»?</div><div class="akl-faq-a"><p>Здесь узкий KPI: статус лида до менеджера, единый скоринг каналов, матрица — не общий консалтинг по нейросетям.</p></div></div><div class="akl-faq-item"><div class="akl-faq-q" role="button" tabindex="0" aria-expanded="false">Интеграция с уже настроенным amo-агентом Nero?</div><div class="akl-faq-a"><p>Квалификация — логичный следующий модуль после захвата лида в CRM (внутренняя перелинковка — задача internal-linker).</p></div></div></div></div></section>

<section class="akl-section">
  <div class="akl-cnt nero-ai-reveal">
    <div class="akl-sh"><h2>Итог</h2></div>
    <div class="akl-prose akl-prose-wide"><p><strong>AI-квалификация лидов</strong> переводит хаос входящих в управляемую <strong>ai воронка продаж</strong>: понятные статусы, быстрый первый ответ, меньше нецелевых в очереди менеджера. <strong>Внедрение ai квалификация лидов</strong> под ключ в Nero Network опирается на <strong>матрицу квалификации</strong>, три слоя скоринга (CRM / ML / LLM), российские <strong>примеры внедрения ai</strong> с цифрами из публичных кейсов, compliance по <strong>152-ФЗ</strong> и режим <strong>HITL</strong> на старте.</p>
<p><strong>Следующий шаг:</strong> запросите <strong>карту квалификации</strong> — и разберём ваши каналы, CRM и пороги hot/warm/cold/junk до сметы проекта.</p></div>
  </div>
</section>
</div><!-- /.akl-content -->

<script id="akl-lead-qual-engine">
/**
 * akl-lead-qual-engine — Диспетчерская квалификации лидов
 * Классы: ChannelPulseStream, QualScoreOrrery, BantCrystal, JunkFilterGate, HitlReviewLens, ManagerDock
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("akl-lead-qual-canvas");
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
    cy = ch / 2 + 8;
    scale = Math.min(cw / 420, ch / 280) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    hot: "#f97316",
    warm: "#fbbf24",
    cold: "#38bdf8",
    junk: "#fb7185",
    hub: "#1e293b",
    hubRing: "#a78bfa",
    pulse: "#fde68a",
    crmGreen: "#22c55e",
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

  function ChannelPulseStream() {
    this.phase = 0;
  }
  ChannelPulseStream.prototype.draw = function (ctx) {
    this.phase = (frame * 0.032) % (Math.PI * 2);
    var channels = [
      { angle: -2.4, label: "web", color: C.cold },
      { angle: -0.6, label: "tg", color: C.warm },
      { angle: 1.1, label: "call", color: C.hot }
    ];
    channels.forEach(function (ch, i) {
      var len = 95;
      var sx = Math.cos(ch.angle) * len;
      var sy = Math.sin(ch.angle) * len * 0.55 - 25;
      ctx.strokeStyle = "rgba(167,139,250,0.25)";
      ctx.lineWidth = 1.5;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.moveTo(sx, sy);
      ctx.lineTo(0, -15);
      ctx.stroke();
      ctx.setLineDash([]);

      var t = (this.phase + i * 2.1) % (Math.PI * 2);
      var pr = t / (Math.PI * 2);
      var px = sx * (1 - pr);
      var py = sy * (1 - pr) + (-15 - sy) * pr;
      ctx.fillStyle = ch.color;
      ctx.beginPath();
      ctx.arc(px, py, 5 + Math.sin(frame * 0.15 + i) * 1.5, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1;
      ctx.stroke();
    }, this);
  };

  function BantCrystal() {
    this.glow = 0;
  }
  BantCrystal.prototype.draw = function (ctx) {
    var labels = ["B", "A", "N", "T"];
    var colors = [C.hot, C.warm, C.cold, C.hubRing];
    labels.forEach(function (lab, i) {
      var a = (i / 4) * Math.PI * 2 + frame * 0.02;
      var rx = -95 + Math.cos(a) * 22;
      var ry = 55 + Math.sin(a) * 14;
      drawRR(ctx, rx, ry, 18, 18, 4, colors[i], C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(lab, rx + 9, ry + 12);
    });
  };

  function JunkFilterGate() {
    this.shake = 0;
  }
  JunkFilterGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg > 50 && prg < 75) this.shake = Math.sin(frame * 0.5) * 2;
    else this.shake = 0;
    drawRR(ctx, -118 + this.shake, 8, 22, 36, 4, "rgba(251,113,133,0.2)", C.junk);
    ctx.fillStyle = C.junk;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("junk", -107 + this.shake, 28);
  };

  function HitlReviewLens() {
    this.pulse = 0;
  }
  HitlReviewLens.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg >= 140 && prg < 175) {
      this.pulse = Math.sin((prg - 140) * 0.2) * 0.5 + 0.5;
      ctx.strokeStyle = "rgba(251,191,36," + (0.3 + this.pulse * 0.5) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(95, 45, 16 + this.pulse * 6, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("HITL", 95, 48);
    }
  };

  function QualScoreOrrery() {
    this.activeSegment = 0;
    this.handoffY = 0;
  }
  QualScoreOrrery.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    var segments = [
      { label: "hot", color: C.hot },
      { label: "warm", color: C.warm },
      { label: "cold", color: C.cold },
      { label: "junk", color: C.junk }
    ];

    if (prg < 70) this.activeSegment = 0;
    else if (prg < 110) this.activeSegment = 1;
    else if (prg < 150) this.activeSegment = 2;
    else if (prg < 190) this.activeSegment = 3;
    else this.activeSegment = 0;

    drawRR(ctx, -48, -58, 96, 96, 48, C.hub, C.outline);
    ctx.strokeStyle = C.hubRing;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, -10, 38, 0, Math.PI * 2);
    ctx.stroke();

    segments.forEach(function (seg, i) {
      var a0 = (i / 4) * Math.PI * 2 + frame * 0.015;
      var a1 = a0 + Math.PI / 2 - 0.15;
      ctx.fillStyle = i === this.activeSegment ? seg.color : "rgba(255,255,255,0.08)";
      ctx.beginPath();
      ctx.moveTo(0, -10);
      ctx.arc(0, -10, 32, a0, a1);
      ctx.closePath();
      ctx.fill();
    }, this);

    ctx.fillStyle = "#fff";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(segments[this.activeSegment].label, 0, -6);

    if (prg >= 70 && prg < 110) {
      createBubble(-20, -45, "Скоринг: ICP + BANT", 180);
    }
    if (prg >= 110 && prg < 150) {
      createBubble(10, -50, "Тёплый → nurture", 180);
    }
    if (prg >= 190) {
      this.handoffY = Math.min(28, (prg - 190) * 1.2);
      drawRR(ctx, 52, -5 + this.handoffY, 44, 26, 6, "rgba(34,197,94,0.22)", C.crmGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("→ менеджер", 74, 12 + this.handoffY);
      if (prg > 205 && prg < 215) {
        createBubble(74, -20 + this.handoffY, "Handoff в CRM", 200);
      }
    }
  };

  function ManagerDock() {
    this.ring = 0;
  }
  ManagerDock.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    drawRR(ctx, 78, 62, 52, 34, 8, "rgba(15,23,42,0.9)", C.outline);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ОП", 104, 82);
    if (prg >= 200) {
      this.ring = Math.min(1, (prg - 200) / 20);
      ctx.strokeStyle = "rgba(34,197,94," + (0.7 - this.ring * 0.5) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(104, 79, 18 + this.ring * 22, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  function Agent(x, y, color, role, phaseTrig, dialogs) {
    this.x = x;
    this.y = y;
    this.baseX = x;
    this.baseY = y;
    this.color = color;
    this.role = role;
    this.phaseTrig = phaseTrig;
    this.dialogs = dialogs;
    this.timer = Math.random() * 100;
  }
  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var prg = (frame * 0.04) % 240;
    var isMoving = false;
    var faceDir = 1;
    var targetX = -35;
    var targetY = -5;
    if (this.role === "5_deployer") {
      targetX = 70;
      targetY = 50;
    }

    if (prg >= this.phaseTrig && prg < this.phaseTrig + 22) {
      var local = prg - this.phaseTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (targetX - this.baseX) * (local / 11);
        this.y = this.baseY + (targetY - this.baseY) * (local / 11);
      } else {
        isMoving = true;
        faceDir = -1;
        var back = (local - 11) / 11;
        this.x = targetX - (targetX - this.baseX) * back;
        this.y = targetY - (targetY - this.baseY) * back;
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 18, rnd, 240);
    }

    var bob = Math.sin(this.timer * 1.5) * (isMoving ? 2 : 1);
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -12, -8 - bob, 24, 16, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -18 - bob, 10, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new ChannelPulseStream());
  entities.push(new BantCrystal());
  entities.push(new JunkFilterGate());
  entities.push(new QualScoreOrrery());
  entities.push(new HitlReviewLens());
  entities.push(new ManagerDock());

  entities.push(new Agent(-75, 78, C.agentYellow, "1_architect", 25, [
    "Веса матрицы согласованы",
    "Порог hot: бюджет от 300к",
    "ICP: B2B услуги"
  ]));
  entities.push(new Agent(-25, 88, C.agentGreen, "2_seo", 75, [
    "Лид из Telegram — целевой",
    "Анти-портрет: отсекаем",
    "Скоринг по 12 полям"
  ]));
  entities.push(new Agent(25, 82, C.agentBlue, "3_coder", 115, [
    "JSON-схема ответа LLM",
    "Webhook amoCRM ок",
    "Очередь Redis — 1.2 с"
  ]));
  entities.push(new Agent(55, 72, C.agentPink, "4_designer", 155, [
    "Карточка с брифом BANT",
    "Тег hot перед звонком",
    "Цитата из диалога в CRM"
  ]));
  entities.push(new Agent(90, 88, C.agentPurple, "5_deployer", 198, [
    "HITL: супервайзер ок",
    "Эскалация менеджеру",
    "junk не трогаем вручную"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, maxLife: life });
  }

  if (frame === 0) {
    createBubble(0, -70, "Захват с 3 каналов", 260);
    createBubble(-90, 30, "Фильтр нецелевых", 260);
    createBubble(60, -30, "Статус до звонка", 260);
    createBubble(100, 60, "SLA первого касания", 260);
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.forEach(function (e) { e.draw(ctx); });

    bubbles.forEach(function (b, i) {
      b.life--;
      if (b.life <= 0) {
        bubbles.splice(i, 1);
        return;
      }
      var alpha = Math.min(1, b.life / 40);
      ctx.globalAlpha = alpha;
      ctx.font = "bold 9px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 6, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 10);
      ctx.globalAlpha = 1;
    });

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
  document.querySelectorAll('.akl-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.akl-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.akl-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.akl-faq-q');
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
  var root = document.querySelector('.ai-kvalifikaciya-lidov-page');
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

<!-- SCHEMA-MARKUP:INSERT -->

<!-- INTERNAL-LINKS:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

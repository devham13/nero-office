<?php
/**
 * Template Name: AI для финансового отдела: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI для финансового отдела. Отчёты, сверки, cash flow, интеграции с 1С и ERP.
 */

$page_seo_title       = 'AI для финансового отдела — внедрение и настройка под ключ';
$page_seo_description = 'Внедрение AI для финансового отдела под ключ: отчёты, сверки, прогноз cash flow и проверка данных. Аудит рутины, интеграция с 1С и ERP. Для CFO и бухгалтерии.';

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
    ['label' => 'Зачем AI',      'href' => '#zachem-ai'],
    ['label' => 'Внедрение',     'href' => '#vnedrenie'],
    ['label' => 'Отчётность',    'href' => '#otchetnost'],
    ['label' => 'Интеграции',    'href' => '#integracii'],
    ['label' => 'Цена',          'href' => '#ceny'],
    ['label' => 'Кейсы',         'href' => '#keisy'],
    ['label' => 'FAQ',           'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Автоматизировать финансы';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Какие задачи решает';
$secondary_cta_url = '#zachem-ai';

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
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
.fin-hero{min-height:100vh;min-height:100dvh;position:relative;}
.fin-content{
  --fin-bg:#050711;--fin-bg2:#080b17;--fin-surface:rgba(255,255,255,.072);
  --fin-text:#e6edf7;--fin-muted:#9aa8bd;--fin-soft:#c7d2e5;--fin-heading:#fff;
  --fin-border:rgba(255,255,255,.10);--fin-emerald:#10b981;--fin-cyan:#22d3ee;
  --fin-gold:#f5c518;--fin-violet:#8b5cf6;--fin-btn-from:#059669;--fin-btn-to:#10b981;
  --fin-r:18px;--fin-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--fin-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.fin-content *,.fin-content *::before,.fin-content *::after{box-sizing:border-box;}
.fin-content a{color:inherit;}
.fin-content p{color:var(--fin-muted);line-height:1.72;margin:0 0 1em;}
.fin-content p:last-child{margin-bottom:0;}
.fin-content h2,.fin-content h3,.fin-content h4{color:var(--fin-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.fin-content strong{color:var(--fin-soft);}
.fin-cnt{width:min(var(--fin-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.fin-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.fin-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.fin-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.fin-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.fin-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#6ee7b7;margin-bottom:14px;}
.fin-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.fin-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.fin-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.fin-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--fin-emerald),var(--fin-cyan));}
.fin-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.fin-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.fin-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.fin-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--fin-heading);}
.fin-kpi-card .kl{font-size:11px;font-weight:600;color:var(--fin-muted);}
.fin-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.fin-intro-grid{grid-template-columns:1fr;gap:36px;}.fin-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.fin-intro-kpi{grid-template-columns:1fr 1fr;}}
.fin-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.fin-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.fin-toc a{display:inline-block;padding:9px 18px;background:var(--fin-surface);border:1px solid var(--fin-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--fin-muted);transition:border-color .2s,color .2s;}
.fin-toc a:hover{border-color:rgba(16,185,129,.42);color:#6ee7b7;}
.fin-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--fin-r);padding:26px;margin-bottom:14px;}
.fin-scenario h3{font-size:17px;}
.fin-scenario p{font-size:14.5px;}
.fin-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.fin-table{width:100%;border-collapse:collapse;font-size:14px;}
.fin-table th{padding:13px 16px;text-align:left;background:rgba(16,185,129,.1);color:#6ee7b7;font-weight:700;border-bottom:1px solid rgba(16,185,129,.25);}
.fin-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--fin-text);vertical-align:top;}
.fin-table tr:last-child td{border-bottom:none;}
.fin-ul,.fin-ol{margin:0 0 1em;padding-left:20px;color:var(--fin-muted);}
.fin-ul li,.fin-ol li{margin-bottom:.45em;line-height:1.65;font-size:14.5px;}
.fin-code{background:rgba(0,0,0,.35);border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:20px;overflow-x:auto;font-size:12px;line-height:1.6;color:var(--fin-soft);margin:20px 0;}
.fin-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.fin-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.fin-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--fin-heading);cursor:pointer;display:flex;justify-content:space-between;gap:16px;user-select:none;}
.fin-faq-q::after{content:'▾';color:var(--fin-emerald);}
.fin-faq-item.open .fin-faq-q::after{transform:rotate(180deg);}
.fin-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease;font-size:14.5px;color:var(--fin-muted);}
.fin-faq-item.open .fin-faq-a{max-height:800px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(16,185,129,.12),rgba(34,211,238,.1));border:1px solid rgba(16,185,129,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(16,185,129,.1),rgba(245,197,24,.08));border-color:rgba(16,185,129,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--fin-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--fin-btn-from),var(--fin-btn-to));color:#042f1a!important;box-shadow:0 8px 32px rgba(16,185,129,.28);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--fin-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:#6ee7b7!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlya-finansovogo-otdela-page" role="main" tabindex="-1">


<section class="nero-ai-hero fin-hero" id="fin-hero" aria-labelledby="fin-hero-title">
<style>
/* ── Hero fin-dept: самодостаточные стили (без CSS темы) ── */
.fin-hero {
  --fin-emerald: #10b981;
  --fin-cyan: #22d3ee;
  --fin-gold: #f5c518;
  --fin-violet: #8b5cf6;
  --fin-text: #e6edf7;
  --fin-muted: #9aa8bd;
  --fin-soft: #c7d2e5;
  --fin-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background:
    radial-gradient(ellipse 70% 55% at 18% 22%, rgba(16, 185, 129, 0.14), transparent 58%),
    radial-gradient(ellipse 55% 45% at 82% 78%, rgba(34, 211, 238, 0.1), transparent 62%),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.fin-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(circle at 42% 32%, #000 0%, transparent 74%);
  opacity: .5;
  pointer-events: none;
  z-index: -2;
}
.fin-hero::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(16, 185, 129, .1), transparent 68%);
  filter: blur(10px);
  animation: finHeroGlow 11s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes finHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.fin-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.fin-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.fin-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 64px);
  line-height: .98;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.fin-hero .nero-ai-gradient-text {
  display: block;
  margin-top: 6px;
  background: linear-gradient(92deg, #6ee7b7 0%, var(--fin-cyan) 38%, var(--fin-gold) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.fin-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(16, 185, 129, 0.28);
  border-radius: 999px;
  background: rgba(16, 185, 129, 0.1);
  color: #6ee7b7 !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.fin-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--fin-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.fin-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.fin-hero .nero-ai-badge {
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
.fin-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.fin-hero .nero-ai-btn {
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
.fin-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.fin-hero .nero-ai-btn-primary {
  color: #042f1a !important;
  background: linear-gradient(135deg, #34d399, #6ee7b7);
  box-shadow: 0 18px 42px rgba(16, 185, 129, 0.24);
}
.fin-hero .nero-ai-btn-secondary {
  color: var(--fin-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.fin-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--fin-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.fin-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.fin-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.fin-hero .nero-ai-dots { display: flex; gap: 7px; }
.fin-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.fin-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.fin-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.fin-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.fin-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.fin-hero .nero-ai-window-body { padding: 16px; }
.fin-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.fin-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.fin-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(16,185,129,.12);
  color: #a7f3d0;
  font-size: 12px;
  font-weight: 800;
}
.fin-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--fin-emerald);
  box-shadow: 0 0 0 6px rgba(16,185,129,.14);
  animation: finPulse 1.6s infinite;
}
@keyframes finPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.fin-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.fin-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.fin-hero .nero-ai-metric span {
  display: block;
  color: var(--fin-muted);
  font-size: 11px;
  font-weight: 700;
}
.fin-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 20px;
  line-height: 1;
}
.fin-hero .fin-dash-canvas-wrap {
  position: relative;
  height: clamp(210px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(16, 185, 129, 0.18);
  background: radial-gradient(ellipse at 50% 40%, rgba(16,185,129,.08), rgba(6,10,24,.94) 72%);
}
.fin-hero #fin-dept-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.fin-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.fin-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.fin-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(16,185,129,.12);
  color: #6ee7b7;
  font-size: 11px;
  font-weight: 800;
}
.fin-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.fin-hero .nero-ai-task span {
  color: var(--fin-muted);
  font-size: 11px;
}
.fin-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(16,185,129,.11);
  color: #a7f3d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.fin-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.fin-hero .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
.fin-hero .fin-hero-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 10px;
}
.fin-hero .fin-hero-pill {
  padding: 6px 10px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.1);
  background: rgba(255,255,255,.04);
  color: #94a3b8;
  font-size: 10px;
  font-weight: 700;
}
@media (max-width: 1100px) {
  .fin-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .fin-hero .nero-ai-dashboard { transform: none; }
  .fin-hero .nero-ai-metrics-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 520px) {
  .fin-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .fin-hero .nero-ai-window-body { padding: 12px; }
  .fin-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .fin-hero .nero-ai-status { grid-column: 2; width: fit-content; }
  .fin-hero .nero-ai-metrics-grid { grid-template-columns: 1fr; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Финансы · AI-агенты под ключ</p>
      <h1 id="fin-hero-title">AI для финансового отдела:<span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Отчёты, сверки и прогноз cash flow без ручного ввода — AI-агенты для финансового блока вашей компании</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Отчётность</li>
        <li class="nero-ai-badge">Сверки</li>
        <li class="nero-ai-badge">Cash flow</li>
        <li class="nero-ai-badge">1С + банки</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Автоматизировать финансы'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#zachem-ai">Какие задачи решает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI для финансового отдела: сверки, отчёты и cash flow">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Финотдел → отчёты и cash flow</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Сверок сегодня</span>
              <strong>47</strong>
            </div>
            <div class="nero-ai-metric">
              <span>Авто без правок</span>
              <strong>91%</strong>
            </div>
            <div class="nero-ai-metric">
              <span>Прогноз 90д</span>
              <strong>+12%</strong>
            </div>
          </div>

          <div class="fin-dash-canvas-wrap" aria-hidden="false">
            <canvas id="fin-dept-hero-canvas" role="img" aria-label="Анимация: поток банковских выписок сверяется с 1С, AI прогнозирует cash flow и ловит аномалии"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий финотдела">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↔</span>
              <div><strong>Выписка ↔ 1С сверена</strong><span>47 операций · 0 расхождений</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Аномалия: оплата по закрытому договору</strong><span>1,1 млн ₽ · эскалация CFO</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">P&L</span>
              <div><strong>Черновик P&L готов</strong><span>variance-комментарии · human-in-the-loop</span></div>
              <span class="nero-ai-status nero-ai-status--violet">черновик</span>
            </div>
          </div>

          <div class="fin-hero-pills" aria-label="Этапы внедрения">
            <span class="fin-hero-pill">1 · Аудит рутины</span>
            <span class="fin-hero-pill">2 · Пилот сверки</span>
            <span class="fin-hero-pill">3 · Cash flow 90д</span>
            <span class="fin-hero-pill">4 · Продакшен</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * fin-dept-hero-engine — «Казначейская диспетчерская потоков»
 * Мир: BankStatementRiver → ReconciliationMatchBridge → CashFlowForecastHub → DeviationAlertPulse
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("fin-dept-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 270) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    river: "rgba(34,211,238,0.12)",
    riverEdge: "#0e7490",
    tileBank: "#dbeafe",
    tile1c: "#d1fae5",
    tileWarn: "#fef3c7",
    hubBase: "#0f172a",
    hubRing: "#10b981",
    curveUp: "#34d399",
    curveDn: "#f87171",
    bridge: "#94a3b8",
    spotlight: "rgba(251,191,36,0.45)",
    alertRed: "#ef4444",
    journal: "rgba(139,92,246,0.2)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#a7f3d0",
    plGreen: "#6ee7b7"
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

  /* Горизонтальная река выписок — вместо Conveyor */
  function BankStatementRiver() {
    this.tiles = [
      { offset: 0, color: C.tileBank, label: "Банк" },
      { offset: 55, color: C.tile1c, label: "1С" },
      { offset: 110, color: C.tileBank, label: "₽" },
      { offset: 165, color: C.tileWarn, label: "!" }
    ];
  }
  BankStatementRiver.prototype.draw = function (ctx) {
    var wave = Math.sin(frame * 0.04) * 3;
    ctx.fillStyle = C.river;
    ctx.beginPath();
    ctx.moveTo(-200, 42 + wave);
    ctx.bezierCurveTo(-80, 28 + wave, 40, 56 + wave, 200, 38 + wave);
    ctx.lineTo(200, 58 + wave);
    ctx.bezierCurveTo(40, 76 + wave, -80, 48 + wave, -200, 62 + wave);
    ctx.closePath();
    ctx.fill();
    ctx.strokeStyle = C.riverEdge;
    ctx.lineWidth = 1;
    ctx.stroke();

    this.tiles.forEach(function (t) {
      var px = -190 + ((frame * 0.55 + t.offset) % 380);
      drawRR(ctx, px - 14, 36 + wave, 28, 18, 4, t.color, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(t.label, px, 49 + wave);
    });
  };

  /* Мост сверки банк ↔ 1С */
  function ReconciliationMatchBridge() {
    this.matches = 0;
  }
  ReconciliationMatchBridge.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 280;
    drawRR(ctx, -42, -8, 84, 22, 6, "rgba(255,255,255,0.05)", C.bridge);
    ctx.strokeStyle = C.bridge;
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.moveTo(-38, 3);
    ctx.lineTo(38, 3);
    ctx.stroke();

    if (prg >= 45 && prg < 120) {
      var m = Math.min(3, Math.floor((prg - 45) / 22));
      for (var i = 0; i <= m; i++) {
        ctx.fillStyle = C.hubRing;
        ctx.font = "bold 8px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("✓", -24 + i * 24, 6);
      }
    }
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("сверка", 0, 16);
  };

  /* Центральный хаб прогноза cash flow — вместо WebsiteTerminal */
  function CashFlowForecastHub() {
    this.curvePhase = 0;
    this.recalcFlash = 0;
  }
  CashFlowForecastHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 280;
    this.curvePhase = prg;

    drawRR(ctx, -58, -72, 116, 116, 999, C.hubBase, C.hubRing);
    ctx.strokeStyle = "rgba(16,185,129,0.35)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, -14, 46, 0, Math.PI * 2);
    ctx.stroke();

    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Cash flow", 0, -58);
    ctx.fillStyle = "#6ee7b7";
    ctx.font = "bold 14px Inter,sans-serif";
    ctx.fillText("90д", 0, -38);

    /* Кривая прогноза */
    var pts = [];
    for (var i = 0; i <= 8; i++) {
      var t = i / 8;
      var bx = -40 + t * 80;
      var by = -10 + Math.sin(t * Math.PI * 1.2 + frame * 0.02) * 12;
      if (prg >= 200) by -= (prg - 200) * 0.08;
      pts.push({ x: bx, y: by });
    }
    ctx.strokeStyle = prg >= 200 ? C.curveUp : C.curveUp;
    ctx.lineWidth = 2.5;
    ctx.beginPath();
    pts.forEach(function (p, idx) {
      if (idx === 0) ctx.moveTo(p.x, p.y);
      else ctx.lineTo(p.x, p.y);
    });
    ctx.stroke();

  };

  /* Луч на отклонение */
  function VarianceSpotlight() {
    this.angle = 0;
  }
  VarianceSpotlight.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 280;
    if (prg < 130 || prg > 195) return;
    var intensity = prg < 150 ? (prg - 130) / 20 : 1 - (prg - 175) / 20;
    ctx.save();
    ctx.globalAlpha = Math.max(0, intensity) * 0.55;
    ctx.fillStyle = C.spotlight;
    ctx.beginPath();
    ctx.moveTo(55, -20);
    ctx.lineTo(95, -55);
    ctx.lineTo(105, -45);
    ctx.lineTo(65, -10);
    ctx.closePath();
    ctx.fill();
    ctx.restore();

    if (prg >= 140 && prg < 185) {
      drawRR(ctx, 88, -58, 36, 22, 4, C.tileWarn, C.alertRed);
      ctx.fillStyle = C.alertRed;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("АНОМАЛИЯ", 106, -48);
      ctx.fillText("договор", 106, -40);
    }
  };

  /* Эмиттер черновика P&L */
  function PlDraftEmitter() {
    this.y = 55;
  }
  PlDraftEmitter.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 280;
    if (prg < 210) return;
    var rise = Math.min(1, (prg - 210) / 25);
    drawRR(ctx, -28, 48 - rise * 18, 56, 28, 5, "rgba(16,185,129,0.15)", C.plGreen);
    ctx.fillStyle = C.plGreen;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.globalAlpha = rise;
    ctx.fillText("P&L черновик", 0, 62 - rise * 18);
    ctx.globalAlpha = 1;
  };

  /* Журнал audit trail */
  function AuditJournalStrip() {
    this.entries = 0;
  }
  AuditJournalStrip.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 280;
    drawRR(ctx, -175, 52, 350, 28, 6, C.journal, C.outline);
    if (prg >= 230) {
      ctx.fillStyle = "#ddd6fe";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("журнал: сверка #47 · аномалия #1 · P&L v3", -168, 70);
    }
  };

  /* Финал: пульс алерта и пересчёт */
  function DeviationAlertPulse() {
    this.r = 0;
  }
  DeviationAlertPulse.prototype.draw = function (ctx) {
    var prg = (frame * 0.032) % 280;
    if (prg < 155 || prg > 215) return;
    this.r = 8 + Math.sin((prg - 155) * 0.35) * 6;
    ctx.strokeStyle = "rgba(239,68,68," + (0.4 + Math.sin(frame * 0.2) * 0.2) + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(106, -49, this.r, 0, Math.PI * 2);
    ctx.stroke();
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
    var prg = (frame * 0.032) % 280;
    var isMoving = false;
    var carryType = null;

    /* Дуга вокруг хаба — иная геометрия, не к сканеру */
    var arcTargets = {
      "1_architect": { x: -95, y: -35 },
      "2_seo": { x: -55, y: -58 },
      "3_coder": { x: 0, y: -68 },
      "4_designer": { x: 55, y: -58 },
      "5_deployer": { x: 95, y: -35 }
    };
    var tgt = arcTargets[this.role] || { x: 0, y: -50 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
      var local = prg - this.stepTrig;
      if (local < 14) {
        isMoving = true;
        var ease = local / 14;
        this.x = this.baseX + (tgt.x - this.baseX) * ease;
        this.y = this.baseY + (tgt.y - this.baseY) * ease;
      } else if (local < 20) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        var back = (local - 20) / 8;
        this.x = tgt.x + (this.baseX - tgt.x) * back;
        this.y = tgt.y + (this.baseY - tgt.y) * back;
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      if (prg >= this.stepTrig - 8 && prg < this.stepTrig + 5) carryType = this.color;
    }

    if (!isMoving && frame % 195 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.4) * 1.2;
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 5.5;
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
    if (carryType) drawRR(ctx, -14, -18 - bob, 11, 11, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new BankStatementRiver());
  entities.push(new ReconciliationMatchBridge());
  entities.push(new CashFlowForecastHub());
  entities.push(new VarianceSpotlight());
  entities.push(new PlDraftEmitter());
  entities.push(new AuditJournalStrip());
  entities.push(new DeviationAlertPulse());
  entities.push(new Agent(-120, 72, C.agentYellow, "1_architect", 22, [
    "Карта источников CFO", "Baseline часов до пилота", "Схема 1С + банк + BI"
  ]));
  entities.push(new Agent(-70, 78, C.agentGreen, "2_seo", 58, [
    "Контрагент сопоставлен", "Fuzzy match 0.94", "Дубль платежа отклонён"
  ]));
  entities.push(new Agent(-15, 82, C.agentBlue, "3_coder", 98, [
    "OData к 1С", "MCP агент-сверяльщик", "Порог confidence 0.85"
  ]));
  entities.push(new Agent(40, 78, C.agentPink, "4_designer", 138, [
    "Аномалия → review CFO", "Закрытый договор!", "Human-in-the-loop"
  ]));
  entities.push(new Agent(95, 72, C.agentPurple, "5_deployer", 178, [
    "Журнал решений AI", "Прогноз 90д обновлён", "Алерт в Telegram"
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

    var prg = (frame * 0.032) % 280;
    if (prg >= 20 && prg < 20.05) createBubble(-130, 8, "1. Выписка в поток");
    if (prg >= 65 && prg < 65.05) createBubble(-20, -2, "2. Сверка банк ↔ 1С");
    if (prg >= 125 && prg < 125.05) createBubble(70, -30, "3. Аномалия в spotlight");
    if (prg >= 185 && prg < 185.05) createBubble(0, -45, "4. Cash flow пересчитан");
    if (prg >= 235 && prg < 235.05) createBubble(0, 58, "5. P&L → журнал audit");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 16, 5, C.bubbleBg, C.hubRing);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
      ctx.fillText(b.text, b.x, b.y - 9);
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

<div class="fin-content">

  <section class="fin-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="fin-cnt">
      <div class="fin-intro-grid nero-ai-reveal">
        <div class="fin-intro-text">
          <p class="fin-eyebrow">Лонгрид · AI для финансов</p>
          <p>Финансовый блок компании живёт в режиме постоянного дедлайна: управленческие отчёты, сверки с банком, закрытие месяца, прогноз кассовых разрывов. Большая часть этих задач до сих пор держится на ручном вводе, выгрузках в Excel и переписке между бухгалтерией, казначейством и операционными подразделениями. <strong>AI для финансов</strong> в 2026 году — это уже не эксперимент с чат-ботом, а <strong>внедрение AI-агентов под ключ</strong>: оркестрация поверх 1С, ERP, банков и BI, где человек остаётся на утверждении, комплаенсе и нестандартных решениях.

Nero Network проектирует такие контуры для малого и среднего бизнеса: от аудита финансовой рутины до пилота на одном сценарии и вывода в продакшен. Ниже — как устроено <strong>внедрение AI для финансов</strong>, какие задачи закрываются в первую очередь, сколько это стоит и на каких кейсах опирается рынок.</p>
          <p class="fin-short"><strong>Коротко:</strong> AI для финансового отдела автоматизирует сбор данных, сверки, черновики отчётов и прогноз cash flow. Критичные решения — за CFO и главбухом. Старт — с аудита рутины и одного пилотного процесса.</p>
        </div>
        <div class="fin-intro-kpi" aria-label="Ключевые метрики финотдела">
          <div class="fin-kpi-card"><div class="kv">75%+</div><div class="kl">CFO используют AI</div><div class="ks">KPMG 2026</div></div>
          <div class="fin-kpi-card"><div class="kv">91%</div><div class="kl">сверок без правок</div><div class="ks">пилот</div></div>
          <div class="fin-kpi-card"><div class="kv">90д</div><div class="kl">прогноз cash flow</div><div class="ks">типовой горизонт</div></div>
          <div class="fin-kpi-card"><div class="kv">300к–2м</div><div class="kl">вилка внедрения</div><div class="ks">под ключ</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="fin-toc-outer">
    <div class="fin-cnt">
      <nav class="fin-toc" aria-label="Оглавление статьи">
        <a href="#zachem-ai">Зачем AI</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#otchetnost">Отчётность</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#vybor">Под ключ vs своими силами</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

<section class="fin-section" id="zachem-ai"><div class="fin-cnt">
<div class="fin-sh"><span class="fin-eyebrow">Зачем AI</span><h2>Зачем финансовому отделу AI в 2026 году</h2></div>
<p>Рынок сместился от пилотов к измеримому ROI. По данным опроса KPMG Global AI in Finance 2026 (1013 CFO в 20 странах), более 75% уже используют AI в planning и reporting, а 71% получают ROI не ниже ожиданий. Организации с audit evidence по AI-решениям в 3–6 раз чаще фиксируют улучшения по ключевым метрикам. Agentic AI даёт дополнительно до 32 процентных пунктов к показателям — сильнее всего на точности прогнозов и скорости закрытия отчётности.</p>
<p>В России тренд тот же, но с акцентом на учётный контур: интеграция через API и MCP к 1С и SAP, RAG по регламентам, журнал решений. Microsoft задаёт мировой ориентир через Finance Agent и Copilot Studio: reconciliation в Excel, variance analysis, ERP Q&A, governance через Agent 365. Для российского mid-market аналог — не копия западного SaaS, а <strong>связка 1С + банк + ЭДО + Power BI или Google Sheets</strong> с human-in-the-loop.</p>
<div class="fin-scenario nero-ai-reveal"><h3>Какие задачи решает AI для финансов</h3>
</div>
<div class="fin-table-wrap nero-ai-reveal"><table class="fin-table"><thead><tr>
<th>Задача финотдела</th>
<th>Что делает AI</th>
<th>Что остаётся за человеком</th>
</tr></thead><tbody>
<tr>
<td>Управленческая и регламентная отчётность</td>
<td>Сбор данных из источников, черновик P&L, комментарии к отклонениям</td>
<td>Утверждение цифр, подпись отчётности</td>
</tr>
<tr>
<td>Сверки (банк, контрагенты, ЭДО)</td>
<td>Fuzzy match, флаги расхождений и дублей</td>
<td>Разбор спорных операций</td>
</tr>
<tr>
<td>Прогноз cash flow</td>
<td>Модель на истории 30/60/90 дней, сценарии</td>
<td>Решения по финансированию и лимитам</td>
</tr>
<tr>
<td>Первичные документы</td>
<td>OCR/LLM, извлечение полей, черновики проводок</td>
<td>Проверка реквизитов, нестандартные договоры</td>
</tr>
<tr>
<td>Контроль аномалий</td>
<td>Подсветка оплат по закрытым договорам, всплесков статей</td>
<td>Расследование и корректировки</td>
</tr>
<tr>
<td>Комплаенс и валютный контроль</td>
<td>RAG по нормам, проверка полей договора</td>
<td>Юридические выводы, подпись</td>
</tr>
</tbody></table></div>
<p>Это ответ на запрос <strong>«какие задачи решает ai для финансов»</strong>: не замена финдиректора, а снятие рутины с цепочки «данные → сверка → черновик → контроль».</p>
<div class="fin-scenario nero-ai-reveal"><h3>Отчёты, сверки и прогнозы без ручного ввода</h3>
<p>Боль, которую фиксируют CFO и бухгалтерия, одна и та же: отчёты, сверки и прогнозы занимают слишком много времени и зависят от ручного переноса данных между системами. В кейсе Epsilon Metrics для производственной компании на 9 юрлицах в контуре 1С:УПП ввод 50 счетов в день сократился с 2,5–4 часов до 25 минут; формирование платежей в пять банк-клиентах — с 1–2 часов до 15 минут. Раньше бухгалтер тратил 5–6 часов в день на ввод; после внедрения — на проверку и утверждение.</p>
<p>У дистрибьютора около 400 сотрудников (материал NeoGraph на РБК Компании) ИИ-модуль для сверок и прогноза кассы высвободил порядка 1,5 ставки и дал экономию финотдела около 2,9 млн ₽ в год; одна пойманная аномалия — 1,1 млн ₽. При этом на стыке продаж и склада компания теряла около 19 млн ₽ в год — внутренний финИИ эти разрывы не видел. Вывод для внедрения: <strong>ИИ внутри финотдела работает, когда есть карта стыков с операциями</strong>, а не только «магия внутри бухгалтерии».</p>
</div>
<div class="fin-scenario nero-ai-reveal"><h3>AI-агенты в корпоративных финансах</h3>
<p><strong>AI-агенты</strong> — автономные или полуавтономные модули с доступом к системам и регламентам. ОТП Банк (публикация на Habr, 2025) строит изолированных мини-агентов под конкретные «ручные разрывы»: миграция данных, верификация источников, документы по шаблонам. Суммарный эффект ИИ за 2025 год — 1,03 млрд ₽, но универсальной формулы ROI нет: микс FTE, скорости, рисков и NPS. Дмитрий Маркосьянц, ОТП Банк: «Это не революция за ночь — находим ручной разрыв, закрываем мини-агентом».</p>
<p>Альфа-Банк с GlowByte внедрил ИИ-агента валютного контроля: 90 полей договора, RAG для актуализации норм, заключение за около минуты вместо до двух часов, точность 80% при плане 60%, до 2700 контрактов в сутки. Для SMB и mid-market эталон масштаба — Сбер (700+ GenAI-инициатив, 900+ агентов в production, эффект GenAI 50 млрд ₽ по итогам 2025), но проектная модель Nero Network сознательно другая: <strong>один сценарий на старте</strong>, чек 300 тыс.–2 млн ₽, без гонки за сотнями агентов.</p>
</div>
</div></section>
<section class="fin-section fin-section-alt" id="vnedrenie"><div class="fin-cnt">
<div class="fin-sh"><span class="fin-eyebrow">Внедрение</span><h2>Что входит во внедрение AI для финансов под ключ</h2></div>
<p><strong>Внедрение AI для финансов под ключ</strong> — это не покупка лицензии на нейросеть, а цепочка: диагностика → проектирование → интеграция → пилот → продакшен → сопровождение. <strong>Настройка AI для финансов</strong> привязана к вашим регламентам, ролям и лимитам, а не к универсальному промпту.</p>
<div class="fin-scenario nero-ai-reveal"><h3>Аудит финансовой рутины</h3>
<p>Лид-магнит Nero Network — <strong>аудит финансовой рутины</strong> (1–2 недели). На выходе:</p>
</div>
<ul class="fin-ul nero-ai-reveal">
<li>карта процессов: отчёты, сверки, закрытие месяца, cash flow;</li>
<li>замер часов и типовых ошибок;</li>
<li>приоритет одного сценария для пилота (например, «выписка ↔ 1С ↔ управленческий отчёт» или «счёт → сверка → черновик проводки»).</li>
</ul>
<div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-audit-rutiny">
  <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Аудит финансовой рутины — бесплатно</p>
    <p class="ym-cta-block__sub">За 1–2 недели составим карту процессов: отчёты, сверки, закрытие месяца, cash flow. Замерим часы и типовые ошибки, выберем один приоритетный сценарий для пилота — без обязательств по внедрению.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Автоматизировать финансы'); ?></a>
  </div>
</div>
<p>Без baseline до старта ROI превращается в «ловушку активности»: процент сотрудников, открывших чат, не равен экономии часов. Методология vesfinteh.ru и KPMG 2026 сходятся: сначала измеряем, потом автоматизируем 30% потока, потом масштабируем.</p>
<div class="fin-scenario nero-ai-reveal"><h3>Проектирование и настройка AI под ваши процессы</h3>
<p><strong>Разработка AI для финансов</strong> в модели Nero Network — это оркестрация агентов на стеке Make/n8n, MCP-серверы к 1С, RAG-база регламентов, reconciliation engine, report builder. Типовая логика:</p>
</div>
<ol class="fin-ol nero-ai-reveal">
<li><strong>Агент-сборщик</strong> — данные из 1С (OData/REST), банка, ЭДО (Диадок/СБИС), CRM, Google Sheets/Power BI.</li>
<li><strong>Агент-нормализатор</strong> — единая схема контрагентов, дат, сумм.</li>
<li><strong>Агент-сверяльщик</strong> — выписки, акты, реестры; флаги расхождений.</li>
<li><strong>Агент-отчётник</strong> — P&L, cash flow, variance-комментарии на естественном языке.</li>
<li><strong>Агент-контролёр</strong> — журнал каждого решения; эскалация при confidence ниже порога или сумме выше лимита.</li>
</ol>
<p><strong>Определение:</strong> human-in-the-loop — обязательное утверждение платежей, проводок и публичной отчётности человеком; AI готовит черновик и обоснование.</p>
<div class="fin-scenario nero-ai-reveal"><h3>Обучение команды и сопровождение</h3>
<p>Финдиректор, главбух и казначей получают не «инструкцию к чату», а регламент: пороги уверенности, матрица ролей, SLA на точность пилота, сценарии эскалации. Сопровождение включает донастройку после первого закрытия месяца в новом контуре — именно там всплывают краевые кейсы, которых не было в эталонной выборке из 50–200 документов.</p>
</div>
<aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
    <p class="ym-cta-block__sub">Перед внедрением AI в финансовый контур полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с 1С — это ускоряет согласование сценариев с CFO и бухгалтерией. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
  </div>
</aside>
</div></section>

<section id="ai-dlya-finansovogo-otdela-boris-block" class="bfin-root" aria-label="Анимация: оркестрация AI-агентов финотдела — сбор данных, сверка и прогноз cash flow">
<style>
/* === БОРИС: prefix bfin-, scoped внутри #ai-dlya-finansovogo-otdela-boris-block === */
#ai-dlya-finansovogo-otdela-boris-block.bfin-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-dlya-finansovogo-otdela-boris-block .bfin-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-dlya-finansovogo-otdela-boris-block .bfin-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#059669;
  margin:0 0 14px;
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-ey::before{
  content:'';
  width:18px;height:2px;
  background:#059669;
  border-radius:1px;
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(5,150,105,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#047857;
  margin-top:1px;
  font-style:normal;
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-pl-a{
  background:rgba(245,158,11,.08);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.22);
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-dlya-finansovogo-otdela-boris-block .bfin-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfdf5 0%,#f0f9ff 38%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-dlya-finansovogo-otdela-boris-block .bfin-rgt{min-height:380px;}
}
#bfin-finance-orchestra-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bfin-cnt">
  <div class="bfin-card">

    <div class="bfin-lft">
      <span class="bfin-ey">Оркестрация агентов</span>
      <h3 class="bfin-h3">1С, банк и ЭДО сходятся в одном контуре — сверка, отчёт и прогноз кассы</h3>
      <ul class="bfin-ul">
        <li><span class="bfin-ic">1</span>Агент-сборщик тянет выписки, проводки и акты из 1С, банка и ЭДО</li>
        <li><span class="bfin-ic">2</span>Агент-сверяльщик сопоставляет контрагентов и суммы, ловит дубли и расхождения</li>
        <li><span class="bfin-ic">3</span>Агент-прогноз строит cash flow 30/60/90 дней и подсвечивает аномалии</li>
        <li><span class="bfin-ic">✓</span>Черновик P&amp;L и журнал решений — на review CFO, не автоподпись</li>
      </ul>
      <div class="bfin-pills">
        <span class="bfin-pl bfin-pl-g">47 сверок/день</span>
        <span class="bfin-pl bfin-pl-b">91% без правок</span>
        <span class="bfin-pl bfin-pl-a">Make / n8n + MCP</span>
      </div>
      <p class="bfin-foot">Дальше — отчётность, cash flow и контроль отклонений →</p>
    </div>

    <div class="bfin-rgt">
      <canvas
        id="bfin-finance-orchestra-canvas"
        aria-label="Анимация: потоки данных из 1С, банка и ЭДО проходят через AI-агентов к сверке, прогнозу cash flow и черновику отчёта"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bfin-finance-orchestra-canvas');
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
    line:'rgba(14,165,233,.35)',
    onec:'#ffdd2d',
    onecDark:'#ca8a04',
    bank:'#0ea5e9',
    edo:'#8b5cf6',
    hub:'#059669',
    hubGlow:'rgba(5,150,105,.18)',
    agent:'#ffffff',
    agentBdr:'#cbd5e1',
    green:'#22c55e',
    amber:'#f59e0b',
    red:'#ef4444',
    chart:'#10b981',
    chartFill:'rgba(16,185,129,.12)',
    particle:'#0ea5e9'
  };

  var SOURCES = [
    {id:'1c', label:'1С', sub:'OData', color:C.onec, dark:C.onecDark, x:0.12, y:0.22},
    {id:'bank', label:'Банк', sub:'API', color:C.bank, dark:'#0369a1', x:0.12, y:0.50},
    {id:'edo', label:'ЭДО', sub:'Диадок', color:C.edo, dark:'#6d28d9', x:0.12, y:0.78}
  ];

  var AGENTS = [
    {label:'Сбор', icon:'↓'},
    {label:'Сверка', icon:'≈'},
    {label:'Прогноз', icon:'↗'},
    {label:'Контроль', icon:'✓'}
  ];

  var PARTICLES = [];
  var LOOP = 480;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function spawnParticle(fromIdx, phase){
    PARTICLES.push({
      sx:SOURCES[fromIdx].x * W + 52,
      sy:SOURCES[fromIdx].y * H,
      t:0,
      speed:0.008 + Math.random()*0.006,
      hue:fromIdx,
      phase:phase || 0
    });
  }

  function drawSourceNode(s, pulse){
    var x = s.x * W, y = s.y * H;
    var w = Math.min(88, W * 0.14), h = 52;
    var nx = x - w/2, ny = y - h/2;

    ctx.globalAlpha = 0.35 + Math.sin(pulse*0.05 + s.y*10)*0.15;
    ctx.beginPath();
    ctx.arc(x + w*0.55, y, 18 + Math.sin(pulse*0.08)*3, 0, Math.PI*2);
    ctx.fillStyle = s.color;
    ctx.globalAlpha = 0.12;
    ctx.fill();
    ctx.globalAlpha = 1;

    rr(nx, ny, w, h, 10, C.agent, s.dark, 2);
    rr(nx+6, ny+6, 18, 18, 5, s.color, null, 0);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(s.label, nx+28, ny+18);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText(s.sub, nx+28, ny+32);
  }

  function drawHub(cx, cy, r, pulse){
    ctx.beginPath();
    ctx.arc(cx, cy, r + 8 + Math.sin(pulse*0.06)*4, 0, Math.PI*2);
    ctx.fillStyle = C.hubGlow;
    ctx.fill();

    rr(cx-r, cy-r, r*2, r*2, r*0.4, '#ecfdf5', C.hub, 2);
    ctx.fillStyle = C.hub;
    ctx.font = 'bold 12px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('Оркестратор', cx, cy-6);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText('Make · n8n · MCP', cx, cy+10);

    var orbit = r + 22;
    AGENTS.forEach(function(ag, i){
      var ang = (i/AGENTS.length)*Math.PI*2 - Math.PI/2 + pulse*0.012;
      var ax = cx + Math.cos(ang)*orbit;
      var ay = cy + Math.sin(ang)*orbit;
      rr(ax-24, ay-14, 48, 28, 8, C.agent, C.agentBdr, 1.5);
      ctx.fillStyle = C.ink;
      ctx.font = 'bold 9px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(ag.label, ax, ay+1);
      ctx.fillStyle = C.hub;
      ctx.font = 'bold 11px sans-serif';
      ctx.fillText(ag.icon, ax, ay-22);
    });
  }

  function drawFlowPath(x1,y1,x2,y2,alpha){
    var mx = (x1+x2)/2;
    ctx.globalAlpha = alpha || 0.45;
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([5,5]);
    ctx.beginPath();
    ctx.moveTo(x1,y1);
    ctx.quadraticCurveTo(mx, y1, mx, (y1+y2)/2);
    ctx.quadraticCurveTo(mx, y2, x2, y2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.globalAlpha = 1;
  }

  function drawParticle(p){
    var hubX = W*0.48, hubY = H*0.5;
    var outX = W*0.82, outY = H*0.42;
    var t = p.t;
    var x, y;

    if(t < 0.55){
      var prog = t/0.55;
      var sx = p.sx, sy = p.sy;
      x = sx + (hubX - sx)*prog;
      y = sy + (hubY - sy)*prog;
      ctx.fillStyle = SOURCES[p.hue].color;
    } else {
      var prog2 = (t-0.55)/0.45;
      x = hubX + (outX - hubX)*prog2;
      y = hubY + (outY - hubY)*prog2;
      ctx.fillStyle = C.green;
    }
    ctx.beginPath();
    ctx.arc(x, y, 4, 0, Math.PI*2);
    ctx.fill();
    ctx.fillStyle = 'rgba(255,255,255,.9)';
    ctx.beginPath();
    ctx.arc(x, y, 2, 0, Math.PI*2);
    ctx.fill();
  }

  function drawCashChart(x, y, w, h, pulse){
    rr(x, y, w, h, 12, '#ffffff', '#e2e8f0', 1.5);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Cash flow · 90 дней', x+12, y+20);
    ctx.fillStyle = C.green;
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'right';
    ctx.fillText('+12%', x+w-12, y+20);

    var pts = [];
    var base = y + h - 28;
    var span = w - 32;
    for(var i=0;i<=12;i++){
      var px = x + 16 + (span/12)*i;
      var wave = Math.sin(i*0.7 + pulse*0.04)*14 + Math.cos(i*0.4)*8;
      var trend = -i*2.2;
      pts.push({x:px, y: base - 40 - wave + trend});
    }
    ctx.beginPath();
    ctx.moveTo(pts[0].x, base);
    pts.forEach(function(p,i){ ctx.lineTo(p.x, p.y); });
    ctx.lineTo(pts[pts.length-1].x, base);
    ctx.closePath();
    ctx.fillStyle = C.chartFill;
    ctx.fill();
    ctx.beginPath();
    ctx.moveTo(pts[0].x, pts[0].y);
    for(var j=1;j<pts.length;j++) ctx.lineTo(pts[j].x, pts[j].y);
    ctx.strokeStyle = C.chart;
    ctx.lineWidth = 2.5;
    ctx.stroke();

    var dot = pts[pts.length-1];
    ctx.beginPath();
    ctx.arc(dot.x, dot.y, 5, 0, Math.PI*2);
    ctx.fillStyle = C.chart;
    ctx.fill();
  }

  function drawReconcileCard(x, y, w, h, matched, pulse){
    rr(x, y, w, h, 10, matched ? 'rgba(34,197,94,.08)' : 'rgba(245,158,11,.08)', matched ? C.green : C.amber, 1.5);
    ctx.fillStyle = matched ? '#15803d' : '#b45309';
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(matched ? 'Выписка ↔ 1С сверена' : 'Аномалия: закрытый договор', x+10, y+18);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText(matched ? '47 операций · 0 расхождений' : '1,1 млн ₽ · на review CFO', x+10, y+32);

    if(!matched && (pulse%90)<45){
      ctx.fillStyle = C.red;
      ctx.beginPath();
      ctx.arc(x+w-14, y+14, 5, 0, Math.PI*2);
      ctx.fill();
    }
  }

  function drawReportDraft(x, y, w, h){
    rr(x, y, w, h, 8, '#f8fafc', '#cbd5e1', 1);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.textAlign = 'left';
    var lines = ['P&L черновик', 'Variance: −3,2%', 'Комментарий AI'];
    lines.forEach(function(ln,i){
      rr(x+8, y+10+i*16, w-16, 10, 3, i===0 ? 'rgba(5,150,105,.12)' : '#e2e8f0', null, 0);
      ctx.fillStyle = i===0 ? '#047857' : C.muted;
      ctx.fillText(ln, x+12, y+18+i*16);
    });
  }

  function loop(){
    frame++;
    var t = frame % LOOP;
    ctx.clearRect(0,0,W,H);

    var hubX = W*0.48, hubY = H*0.5;
    var hubR = Math.min(42, W*0.07);

    if(frame % 28 === 0) spawnParticle(frame % 3, 0);
    if(frame % 40 === 7) spawnParticle((frame+1) % 3, 1);

    SOURCES.forEach(function(s){
      drawSourceNode(s, frame);
      drawFlowPath(s.x*W+52, s.y*H, hubX-hubR, hubY, 0.35);
    });

    drawHub(hubX, hubY, hubR, frame);

  drawFlowPath(hubX+hubR, hubY, W*0.72, H*0.42, 0.4);

    PARTICLES.forEach(function(p){ drawParticle(p); p.t += p.speed; });
    PARTICLES = PARTICLES.filter(function(p){ return p.t < 1; });

    var chartW = Math.min(200, W*0.32);
    var chartH = Math.min(110, H*0.28);
    var chartX = W - chartW - 16;
    var chartY = H*0.12;
    drawCashChart(chartX, chartY, chartW, chartH, frame);

    var recW = Math.min(200, W*0.32);
    var recH = 44;
    var showAnomaly = (Math.floor(frame/LOOP*2)%2)===1;
    drawReconcileCard(chartX, chartY+chartH+12, recW, recH, !showAnomaly, frame);

    drawReportDraft(chartX, H - recH - 24, recW, recH + 8);

    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Источники данных', 12, H-10);
    ctx.textAlign = 'center';
    ctx.fillText('Цепочка агентов', hubX, H-10);
    ctx.textAlign = 'right';
    ctx.fillText('Отчёт и cash flow', chartX+chartW, H-10);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>

<section class="fin-section" id="otchetnost"><div class="fin-cnt">
<div class="fin-sh"><span class="fin-eyebrow">Отчётность</span><h2>AI для отчётности, cash flow и контроля отклонений</h2></div>
<p>Это ядро коммерческого оффера: отчёты, поиск отклонений, прогноз cash flow, проверка данных.</p>
<div class="fin-scenario nero-ai-reveal"><h3>Автоматизация отчётов и управленческой отчётности</h3>
<p>По Global CFO Survey 2026, 59% CFO фокусируются на automated reporting. Microsoft Finance Agent в Excel подключается к ERP, готовит reconciliation report, объясняет отклонения, сохраняет action items для аудита. В российском контуре Nero Network собирает аналог: выгрузка из 1С + агент-отчётник + дашборд в Power BI, Google Sheets или DataLens. RAG по прошлым отчётам и политикам учёта позволяет генерировать пояснения к variance в том же стиле, что и предыдущие периоды — эксперты Generation AI отмечают, что RAG в закрытом контуре становится полноценным поисковым агентом; в перспективе — участие в сборке годового отчёта.</p>
</div>
<div class="fin-scenario nero-ai-reveal"><h3>Прогноз cash flow и поиск аномалий в данных</h3>
<p>64% CFO в глобальном опросе 2026 называют приоритетом predictive cash forecasting. Агент прогноза строит горизонты 30/60/90 дней на истории 6–12 месяцев, подсвечивает риск кассового разрыва до того, как он станет кризисом. Параллельно модуль аномалий ловит дубли платежей, операции по закрытым договорам, нетипичные всплески статей — как в кейсе дистрибьютора NeoGraph.</p>
<p><strong>Важно:</strong> точность прогноза зависит от качества истории и чистоты первички. Agentic AI по KPMG даёт до ~40 п.п. прироста к точности прогнозов у зрелых контуров с governance — не у всех с первого дня.</p>
</div>
<div class="fin-scenario nero-ai-reveal"><h3>Проверка данных, сверки и снижение ошибок ручного ввода</h3>
<p>Financial Reconciliation — один из флагманских сценариев Microsoft Finance Agent. В 1С-контуре Epsilon Metrics пять подсистем ИИ закрывают распознавание счетов, платежи в банк-клиентах, рассылку подтверждений, ввод договоров, проведение закрывающих из ЭДО. OCR и LLM извлекают поля из PDF и фото → сверка с контрагентами и дублями → черновики в 1С → бухгалтер на review. Окупаемость полного комплекта при ФОТ бухгалтера 120–150 тыс. ₽/мес — 9–12 месяцев по данным интегратора.</p>
</div>
</div></section>
<section class="fin-section fin-section-alt" id="integracii">
<div class="fin-cnt">
<div class="fin-scenario nero-ai-reveal"><p>Практический разбор <a href="/ai-1c-erp/">внедрения AI-агента для 1С и ERP</a> — от OCR и первички до черновиков в учётной системе; на этой странице акцент смещён на cash flow, CFO-отчётность и сквозной процесс до управленческого отчёта.</p></div>
<div class="fin-sh"><span class="fin-eyebrow">Интеграции</span><h2>Интеграция AI с 1С, ERP, CRM и банками</h2></div>
<p>36% CFO в отчёте KPMG 2026 называют главным барьером <strong>интеграцию систем</strong>. Без связки с учётом AI остаётся островом в Excel.</p>
<div class="fin-scenario nero-ai-reveal"><h3>Подключение к учётным и ERP-системам</h3>
<p><strong>Интеграция AI для финансов</strong> с 1С (Бухгалтерия, ERP, УТ, УПП) — через OData, REST, MCP-серверы без снятия конфигурации с поддержки. Иногда встречается SAP; принцип тот же: агент читает и пишет черновики, не подменяя ядро учёта. Конкуренты вроде [REDACTED]/ai-1c-erp/ сильны в OCR и документообороте, но слабее в cash flow и CFO-отчётности — угол Nero Network шире: <strong>сквозной процесс до оплаты и управленческого отчёта</strong>, не только первичка.</p>
</div>
<div class="fin-scenario nero-ai-reveal"><h3>Связка с CRM и банк-клиентами</h3>
<p><strong>AI для финансов с CRM</strong> (amoCRM, Битрикс24) нужен, когда выручка и дебиторка живут в CRM, а деньги — в 1С и банке. Агент тянет воронку, счета, оплаты в единую картину для прогноза и сверки. Банки подключаются через API и выписки — набор зависит от банка; в кейсе Epsilon Metrics — пять банк-клиентов в одном контуре.</p>
</div>
<div class="fin-scenario nero-ai-reveal"><h3>BI и дашборды (Power BI, Google Sheets)</h3>
<p>Управленческий слой — Power BI, Google Sheets, Yandex DataLens. Агент-отчётник отдаёт не только PDF, но и обновляемые листы с комментариями к отклонениям. Это закрывает разрыв между «бухгалтерия закрыла месяц» и «финдиректор увидел смысл в цифрах в тот же день».</p>
<p><strong>Схема архитектуры (текстово):</strong></p>
</div>
<pre class="fin-code nero-ai-reveal"><code>Источники: 1С / ERP | Банк | ЭДО | CRM | Почта
        ↓
Агенты: сбор → нормализация → сверка → отчёт / прогноз → контроль
        ↓
Выход: 1С (черновики) | BI-дашборд | Журнал решений
        ↓
Человек: утверждение | комплаенс | нестандарт</code></pre>
</div></section>
<section class="fin-section" id="ceny"><div class="fin-cnt">
<div class="fin-sh"><span class="fin-eyebrow">Стоимость</span><h2>Сколько стоит AI для финансов и как заказать внедрение</h2></div>
<p>Коммерческий кластер «<strong>ai для финансов цена</strong>» и «<strong>сколько стоит ai для финансов</strong>» требует честных вилок без выдуманных скидок.</p>
<div class="fin-scenario nero-ai-reveal"><h3>Из чего складывается стоимость</h3>
<p>Ориентир по чеку из брифа и рынка РФ: <strong>300 тыс.–2 млн ₽</strong> в зависимости от числа юрлиц, интеграций, on-prem требований и глубины сценариев. Состав:</p>
</div>
<div class="fin-table-wrap nero-ai-reveal"><table class="fin-table"><thead><tr>
<th>Этап</th>
<th>Срок</th>
<th>Что входит</th>
</tr></thead><tbody>
<tr>
<td>Аудит рутины</td>
<td>1–2 недели</td>
<td>Карта процессов, baseline часов, приоритет пилота</td>
</tr>
<tr>
<td>Пилот 30% потока</td>
<td>4–8 недель</td>
<td>Один контур, KPI точности, обучение</td>
</tr>
<tr>
<td>Продакшен</td>
<td>по смете</td>
<td>Оркестрация агентов, SLA, дашборд</td>
</tr>
<tr>
<td>Сопровождение</td>
<td>ежемесячно</td>
<td>Донастройка, мониторинг, обновления регламентов</td>
</tr>
</tbody></table></div>
<p>Конкуренты: пилоты от 150 тыс. ₽ (dodigital.ru), документооборот 1С 300 тыс.–1,5 млн ([REDACTED]). Nero Network не обещает «шесть агентов заменят финдеп» — продаём <strong>измеримый сценарий</strong> с окупаемостью по часам (кейсы 2–12 месяцев при типовой нагрузке).</p>
<div class="fin-scenario nero-ai-reveal"><h3>Этапы внедрения под ключ</h3>
</div>
<ol class="fin-ol nero-ai-reveal">
<li><strong>Консультация и бриф</strong> — цели CFO, стек систем, ограничения 152-ФЗ.</li>
<li><strong>Аудит финансовой рутины</strong> — baseline.</li>
<li><strong>Пилот</strong> — один процесс на 30% объёма.</li>
<li><strong>Продакшен</strong> — Make/n8n + MCP, governance, роли.</li>
<li><strong>Масштабирование</strong> — второй и третий сценарии по дорожной карте.</li>
</ol>
<p><strong>Формула ROI (качественно):</strong> экономия = (часы до − часы после) × ставка × 12 − стоимость внедрения и сопровождения. Без замера «до» цифра не продаётся и не защищается на совет директоров.</p>
<div class="fin-scenario nero-ai-reveal"><h3>Консультация и первый шаг</h3>
<p><strong>AI для финансов консультация</strong> в Nero Network — разбор одного приоритетного разрыва: что автоматизировать первым, какие данные нужны, реалистичный горизонт пилота. CTA страницы: <strong>«Автоматизировать финансы»</strong> и <strong>«Заказать аудит рутины»</strong>.</p>
</div>
</div><div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-ceny">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Узнайте бюджет и ROI под ваш финансовый контур</p>
    <p class="ym-cta-block__sub">Ориентир внедрения: 300 тыс.–2 млн ₽ в зависимости от юрлиц и интеграций. На консультации разберём один приоритетный разрыв — сверка, отчётность или cash flow — и дадим реалистичный горизонт пилота.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Автоматизировать финансы'); ?></a>
      <a href="#vnedrenie" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
    </div>
  </div>
</div>
</section>
<section class="fin-section fin-section-alt" id="keisy"><div class="fin-cnt">
<div class="fin-sh"><span class="fin-eyebrow">Кейсы</span><h2>AI для финансов: кейсы и сегменты бизнеса</h2></div>
<p>Публичных детальных кейсов «финотдел SMB без банковского контура» меньше, чем кейсов 1С и банков — опираемся на верифицированные материалы и проектную модель.</p>
<div class="fin-scenario nero-ai-reveal"><h3>Малый бизнес: быстрый старт без штатного разработчика</h3>
<p><strong>AI для финансов для малого бизнеса</strong> — один юрлицо, 1С:Бухгалтерия, один банк, Google Sheets для управленки. Пилот «входящие счета → сверка → черновик» или «выписка → сверка с 1С» укладывается в нижнюю вилку бюджета. <strong>AI для финансов без программиста</strong> на стороне клиента возможен: интеграцию и настройку делает подрядчик, команда финансов — регламенты и приёмку.</p>
</div>
<div class="fin-scenario nero-ai-reveal"><p>На фоне <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">масштабного внедрения AI в крупной компании</a> — 276 тысяч сотрудников KPMG — SMB и mid-market берут те же принципы governance и human-in-the-loop, но с меньшим горизонтом пилота.</p></div>
<div class="fin-scenario nero-ai-reveal"><p>Если дебиторка и воронка в CRM, а деньги в 1С, смотрите <a href="/vnedrenie-ai-amocrm/">интеграцию AI с amoCRM под ключ</a> как соседний сценарий до финансовой сверки.</p></div>
<div class="fin-scenario nero-ai-reveal"><h3>Средний бизнес и финансовый блок</h3>
<p><strong>AI для финансов для среднего бизнеса</strong> — несколько юрлиц, УТ/ERP, ЭДО, CRM, казначейство. Здесь критичны стыки: кейс NeoGraph показал, что 19 млн ₽/год терялись между продажами и складом — финИИ внутри отдела их не увидел. Nero Network закладывает в проект <strong>карту стыков</strong> с операциями, не только автоматизацию внутри бухгалтерии.</p>
</div>
<div class="fin-scenario nero-ai-reveal"><h3>Роль финдиректора и бухгалтерии</h3>
<p>ЦА страницы — финдиректора, бухгалтерия, управленческий учёт. CFO задаёт политики, лимиты и KPI пилота; главбух — эталонные документы и контроль первички; казначей — платёжный контур. AI не снимает с CFO ответственность за подпись — рамка COSO (Feb 2026) для GenAI в reporting-significant процессах: human validation, audit trail, segregation of duties. В РФ параллель — 152-ФЗ, политика ПДн, для regulated — ФСТЭК №117.</p>
<p><strong>Верифицированные цифры для ориентира (с оговорками):</strong></p>
</div>
<div class="fin-table-wrap nero-ai-reveal"><table class="fin-table"><thead><tr>
<th>Кейс</th>
<th>Эффект</th>
<th>Источник</th>
</tr></thead><tbody>
<tr>
<td>9 юрлиц, 1С:УПП</td>
<td>Ввод 50 сч/день: 2,5–4 ч → 25 мин</td>
<td>Epsilon Metrics</td>
</tr>
<tr>
<td>Дистрибьютор ~400 чел.</td>
<td>~2,9 млн ₽/год экономии финотдела</td>
<td>NeoGraph / РБК</td>
</tr>
<tr>
<td>Альфа-Банк, валютный контроль</td>
<td>До 2700 контрактов/сутки, ~1 мин на заключение</td>
<td>РБК Компании</td>
</tr>
<tr>
<td>ОТП Банк</td>
<td>1,03 млрд ₽ суммарный эффект ИИ за 2025</td>
<td>Habr</td>
</tr>
</tbody></table></div>
</div></section>
<section class="fin-section" id="vybor"><div class="fin-cnt">
<div class="fin-sh"><span class="fin-eyebrow">Выбор</span><h2>Под ключ или своими силами: что выбрать</h2></div>
<p>Запрос <strong>«ai для финансов под ключ или самостоятельно»</strong> — один из частых в FAQ.</p>
<div class="fin-scenario nero-ai-reveal"><h3>Когда достаточно готовых инструментов</h3>
<p>Достаточно, если один сотрудник, мало интеграций, нет жёсткого 152-ФЗ/on-prem, задача — черновик письма или разовый анализ выгрузки. Microsoft Finance Agent, Copilot в Excel, встроенные сценарии 1С:РПД — старт для знакомства, не для сквозного «счёт → оплата → отчёт».</p>
</div>
<div class="fin-scenario nero-ai-reveal"><h3>Когда нужна настройка и интеграция под компанию</h3>
<p>Нужна, когда несколько систем, юрлиц, банков, ЭДО; когда CFO хочет cash flow и variance, а не только OCR; когда аудитор или совет директоров спросит про журнал решений ИИ. 78% executives по Grant Thornton 2026 (цит. в отраслевых обзорах) не уверены, что пройдут независимый AI governance audit за 90 дней — <strong>интеграция + governance</strong> продаётся вместе с моделью.</p>
</div>
<div class="fin-scenario nero-ai-reveal"><h3>Риски самостоятельного внедрения</h3>
</div>
<div class="fin-table-wrap nero-ai-reveal"><table class="fin-table"><thead><tr>
<th>Риск</th>
<th>Проявление</th>
<th>Как закрывает подрядчик</th>
</tr></thead><tbody>
<tr>
<td>Галлюцинации в цифрах</td>
<td>Неверные проводки</td>
<td>Confidence thresholds, human review</td>
</tr>
<tr>
<td>Silent failure</td>
<td>Агент молча пропускает ошибку</td>
<td>Агент-контролёр, алерты</td>
</tr>
<tr>
<td>Утечка ПДн</td>
<td>Данные в публичный LLM</td>
<td>On-prem, GigaChat/YandexGPT, 152-ФЗ</td>
</tr>
<tr>
<td>Нет audit trail</td>
<td>Невозможно доказать решение</td>
<td>Журнал каждого действия</td>
</tr>
<tr>
<td>«Ловушка активности»</td>
<td>KPI «открыли чат»</td>
<td>Baseline часов до пилота</td>
</tr>
</tbody></table></div>
<p><strong>Где ИИ не нужен:</strong> жёсткие регламенты без исключений, уникальные судебные споры, налоговые позиции без прецедента — только человек.</p>
</div></section>
<section class="fin-section fin-section-alt" id="faq"><div class="fin-cnt">
<div class="fin-sh"><span class="fin-eyebrow">FAQ</span><h2>FAQ: как внедрить AI для финансов</h2></div>
<div class="fin-faq nero-ai-reveal"><div class="fin-faq-item"><div class="fin-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai для финансов пошагово</div><div class="fin-faq-a">1. Зафиксировать baseline: часы на отчёты, сверки, закрытие месяца. 2. Выбрать один сценарий с максимальной болью. 3. Собрать 50–200 эталонных документов и регламенты. 4. Подключить источники (1С, банк, ЭДО) через API/MCP. 5. Запустить пилот на 30% потока с KPI точности. 6. Обучить финкоманду human-in-the-loop. 7. Вынести в продакшен с журналом и SLA. 8. Масштабировать второй сценарий по карте стыков.</div></div><div class="fin-faq-item"><div class="fin-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai для финансов</div><div class="fin-faq-a">Вилка <strong>300 тыс.–2 млн ₽</strong> за внедрение под ключ: аудит, пилот, продакшен. Точная смета — после аудита рутины и перечня интеграций. Сопровождение — отдельной строкой.</div></div><div class="fin-faq-item"><div class="fin-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли программист для внедрения</div><div class="fin-faq-a">На стороне клиента — не обязателен при работе с интегратором. Nero Network настраивает Make/n8n, MCP, RAG; от финансов нужны доступы, регламенты и приёмка результатов.</div></div><div class="fin-faq-item"><div class="fin-faq-q" role="button" tabindex="0" aria-expanded="false">Какие задачи решает ai для финансов в первую очередь</div><div class="fin-faq-a">Приоритет 1 в типовых проектах: сверка банка с 1С, входящие счета и первичка, черновик управленческого отчёта, прогноз cash flow на 30–90 дней. Второй волной — стыки с CRM и операционными разрывами.</div></div><div class="fin-faq-item"><div class="fin-faq-q" role="button" tabindex="0" aria-expanded="false">Заменит ли AI бухгалтера</div><div class="fin-faq-a">Нет. AI снимает рутину ввода и черновиков; утверждение, комплаенс, нестандарт и подпись — за главбухом и CFO. KPMG формулирует: AI в finance — decision-engine, не просто cost lever.</div></div><div class="fin-faq-item"><div class="fin-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли оставить 1С на поддержке</div><div class="fin-faq-a">Да. Интеграция через OData/REST и MCP без модификации ядра конфигурации — стандартный подход рынка РФ.</div></div>
</div>
</div></section>
<section class="fin-section" id="itog"><div class="fin-cnt">
<div class="fin-sh"><h2>Итог</h2></div>
<p><strong>AI для финансового отдела</strong> в 2026 году — это оркестрированные агенты поверх 1С, банков, ЭДО и BI с журналом решений и измеримым baseline. Nero Network ведёт <strong>внедрение и настройку под ключ</strong>: аудит рутины, пилот одного сценария, продакшен на Make/n8n и MCP, честный governance под 152-ФЗ. Рынок уже показал окупаемость на сверках и первичке (от месяцев до года при типовой нагрузке); главное — не маркетинговый ROI, а карта процессов, стыков и контроля.</p>
<p><strong>Следующий шаг:</strong> заказать <a href="<?php echo esc_url($primary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo $primary_cta_attrs; ?>><strong>аудит финансовой рутины</strong></a> или перейти к CTA <a href="<?php echo esc_url($primary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo $primary_cta_attrs; ?>><strong>«Автоматизировать финансы»</strong></a> — разбор вашего контура и приоритетного сценария без обязательства на полный продакшен.</p>
</div></section>

</div>


<?php
$fin_page_url = trailingslashit( get_permalink() );
$fin_site_url = trailingslashit( home_url( '/' ) );
$fin_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$fin_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $fin_site_url . '#organization',
      'name'  => $fin_brand,
      'url'   => $fin_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $fin_site_url . '#website',
      'url'       => $fin_site_url,
      'name'      => $fin_brand,
      'publisher' => [ '@id' => $fin_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $fin_page_url . '#webpage',
      'url'         => $fin_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $fin_site_url . '#website' ],
      'about'       => [ '@id' => $fin_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $fin_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $fin_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $fin_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $fin_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $fin_page_url,
      'provider'    => [ '@id' => $fin_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $fin_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить ai для финансов пошагово', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '1. Зафиксировать baseline: часы на отчёты, сверки, закрытие месяца. 2. Выбрать один сценарий с максимальной болью. 3. Собрать 50–200 эталонных документов и регламенты. 4. Подключить источники (1С, банк, ЭДО) через API/MCP. 5. Запустить пилот на 30% потока с KPI точности. 6. Обучить финкоманду human-in-the-loop. 7. Вынести в продакшен с журналом и SLA. 8. Масштабировать второй сценарий по карте стыков.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит ai для финансов', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Вилка 300 тыс.–2 млн ₽ за внедрение под ключ: аудит, пилот, продакшен. Точная смета — после аудита рутины и перечня интеграций. Сопровождение — отдельной строкой.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужен ли программист для внедрения', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'На стороне клиента — не обязателен при работе с интегратором. Nero Network настраивает Make/n8n, MCP, RAG; от финансов нужны доступы, регламенты и приёмка результатов.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие задачи решает ai для финансов в первую очередь', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Приоритет 1 в типовых проектах: сверка банка с 1С, входящие счета и первичка, черновик управленческого отчёта, прогноз cash flow на 30–90 дней. Второй волной — стыки с CRM и операционными разрывами.' ] ],
        [ '@type' => 'Question', 'name' => 'Заменит ли AI бухгалтера', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. AI снимает рутину ввода и черновиков; утверждение, комплаенс, нестандарт и подпись — за главбухом и CFO. KPMG формулирует: AI в finance — decision-engine, не просто cost lever.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли оставить 1С на поддержке', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Интеграция через OData/REST и MCP без модификации ядра конфигурации — стандартный подход рынка РФ.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $fin_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>


</main>

<script>
(function(){
  document.querySelectorAll('.fin-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.fin-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.fin-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.fin-faq-q');
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
  var root = document.querySelector('.ai-dlya-finansovogo-otdela-page') || document.querySelector('.fin-content');
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

<?php
/**
 * Template Name: AI-ассистент патентного бюро: внедрение под ключ
 * Description: Внедрение AI-ассистента для первичного разбора заявок в патентном бюро: обозначение, МКТУ, риски. Интеграция в CRM, разработка под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-ассистент патентного бюро: внедрение под ключ';
$page_seo_description = 'Внедрение AI-ассистента для первичного разбора заявок в патентном бюро: обозначение, МКТУ, риски. Интеграция в CRM, разработка под ключ. Заказать оценку проекта.';

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
    ['label' => 'Зачем AI',    'href' => '#zachem'],
    ['label' => 'Сценарий',    'href' => '#scenariy'],
    ['label' => 'Внедрение',   'href' => '#vnedrenie'],
    ['label' => 'Интеграции',  'href' => '#integracii'],
    ['label' => 'Цена',        'href' => '#ceny'],
    ['label' => 'FAQ',         'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать IP-ассистента';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#';

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

.pap-content,.ai-patentnyy-pomoshchnik-page{
  --pap-bg:#050711;--pap-bg2:#080b17;--pap-text:#e6edf7;--pap-muted:#9aa8bd;--pap-soft:#c7d2e5;--pap-heading:#fff;
  --pap-border:rgba(255,255,255,.10);--pap-accent:#79f2ff;--pap-violet:#8b5cf6;--pap-green:#22c55e;--pap-amber:#f59e0b;
  --pap-btn-from:#2563eb;--pap-btn-to:#7c3aed;--pap-container:1220px;--pap-r:18px;--pap-r-lg:24px;
}
.pap-content{background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);color:var(--pap-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden}
.pap-content *,.pap-content *::before,.pap-content *::after{box-sizing:border-box}
.pap-content a{color:var(--pap-accent)}
.pap-content p{color:var(--pap-muted);line-height:1.72;margin:0 0 1em}
.pap-content h2,.pap-content h3{color:var(--pap-heading);letter-spacing:-.045em;margin:0 0 .7em}
.pap-content strong{color:var(--pap-soft)}
.pap-cnt{width:min(var(--pap-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.pap-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.pap-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.pap-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.pap-sh.pap-left{margin-left:0;text-align:left}
.pap-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.pap-prose{max-width:820px}
.pap-prose h3{font-size:clamp(18px,2.2vw,22px);margin-top:1.6em}
.pap-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.pap-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.pap-intro-text{position:relative;padding-left:20px;text-align:left!important}
.pap-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--pap-accent),var(--pap-violet))}
.pap-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--pap-muted);margin-bottom:1em}
.pap-intro-text p:last-child{color:var(--pap-soft)}
.pap-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.pap-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.pap-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--pap-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.pap-kpi-card .kl{font-size:11px;font-weight:600;color:var(--pap-muted)}
.pap-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.pap-intro-grid{grid-template-columns:1fr;gap:36px}.pap-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.pap-intro-kpi{grid-template-columns:1fr 1fr}}
.pap-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.pap-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.pap-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid var(--pap-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--pap-muted);text-decoration:none;transition:border-color .2s,color .2s}
.pap-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--pap-accent)}
.pap-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.pap-table{width:100%;border-collapse:collapse;font-size:14px}
.pap-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--pap-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.pap-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--pap-text);vertical-align:top}
.pap-table tr:last-child td{border-bottom:none}
.pap-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.pap-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.pap-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--pap-heading);cursor:pointer;list-style:none}
.pap-faq-item summary::-webkit-details-marker{display:none}
.pap-faq-a{padding:0 24px 20px;font-size:14.5px;color:var(--pap-muted);line-height:1.72}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--pap-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--pap-accent)!important;text-decoration:underline}
.ym-btn--ghost{background:rgba(255,255,255,.08)!important;color:var(--pap-text)!important;border:1.5px solid rgba(255,255,255,.18)!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-patentnyy-pomoshchnik-page" role="main" tabindex="-1">

<style>
/* Hero ai-patentnyy-pomoshchnik — самодостаточные стили первого экрана */
.pap-hero-root {
  --pap-bg: #050711;
  --pap-bg2: #080b17;
  --pap-text: #e6edf7;
  --pap-muted: #9aa8bd;
  --pap-soft: #c7d2e5;
  --pap-heading: #ffffff;
  --pap-border: rgba(255,255,255,.10);
  --pap-accent: #79f2ff;
  --pap-violet: #8b5cf6;
  --pap-green: #22c55e;
  --pap-amber: #f59e0b;
  --pap-red: #ef4444;
  --pap-shadow: 0 24px 72px rgba(0,0,0,.4);
  --pap-container: 1220px;
  --pap-radius: 18px;
  --pap-radius-lg: 24px;
  color: var(--pap-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}
.pap-hero-root *, .pap-hero-root *::before, .pap-hero-root *::after { box-sizing: border-box; }
.pap-hero-root a { color: inherit; text-decoration: none; }

.pap-hero-root .nero-ai-container {
  width: min(var(--pap-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.pap-hero-root .nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: linear-gradient(180deg, var(--pap-bg) 0%, var(--pap-bg2) 52%, var(--pap-bg) 100%);
}
.pap-hero-root .nero-ai-hero::before {
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
.pap-hero-root .nero-ai-hero::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121,242,255,.12), transparent 66%);
  filter: blur(6px);
  animation: papHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes papHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}

.pap-hero-root .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}

.pap-hero-root .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121,242,255,.2);
  border-radius: 999px;
  background: rgba(121,242,255,.08);
  color: var(--pap-accent);
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: .11em;
}

.pap-hero-root .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 6.2vw, 82px);
  line-height: .92;
  letter-spacing: -.06em;
  color: var(--pap-heading);
}
.pap-hero-root .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #fff 0%, var(--pap-accent) 44%, var(--pap-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}

.pap-hero-root .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--pap-soft);
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}

.pap-hero-root .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.pap-hero-root .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 12px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}

.pap-hero-root .pap-hero-steps {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 18px 0 0;
  padding: 0;
  list-style: none;
}
.pap-hero-root .pap-hero-step {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 12px;
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,.09);
  background: rgba(255,255,255,.04);
  font-size: 12px;
  font-weight: 700;
  color: var(--pap-muted);
}
.pap-hero-root .pap-hero-step span {
  width: 22px;
  height: 22px;
  border-radius: 7px;
  display: grid;
  place-items: center;
  background: linear-gradient(135deg, var(--pap-accent), var(--pap-violet));
  color: #031018;
  font-size: 11px;
  font-weight: 900;
}

.pap-hero-root .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 32px;
}
.pap-hero-root .nero-ai-btn {
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
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.pap-hero-root .nero-ai-btn:hover { transform: translateY(-2px); }
.pap-hero-root .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--pap-accent), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121,242,255,.22);
}
.pap-hero-root .nero-ai-btn-secondary {
  color: var(--pap-text) !important;
  background: rgba(255,255,255,.07);
  border-color: rgba(255,255,255,.14);
}

.pap-hero-root .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2,6,23,.42);
  box-shadow: var(--pap-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.pap-hero-root .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15,23,42,.95), rgba(6,10,24,.96));
}
.pap-hero-root .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.pap-hero-root .nero-ai-dots { display: flex; gap: 7px; }
.pap-hero-root .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.pap-hero-root .nero-ai-dot:nth-child(1) { background: #fb7185; }
.pap-hero-root .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.pap-hero-root .nero-ai-dot:nth-child(3) { background: #34d399; }
.pap-hero-root .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.pap-hero-root .nero-ai-window-body { padding: 18px; }

.pap-hero-root .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 14px;
}
.pap-hero-root .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -.03em;
  color: var(--pap-heading);
}
.pap-hero-root .nero-ai-live-pill {
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
.pap-hero-root .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--pap-green);
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: papPulse 1.6s infinite;
}
@keyframes papPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}

.pap-hero-root .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
}
.pap-hero-root .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.pap-hero-root .nero-ai-metric span { display: block; color: var(--pap-muted); font-size: 11px; font-weight: 700; }
.pap-hero-root .nero-ai-metric strong { display: block; margin-top: 5px; color: #fff; font-size: 20px; line-height: 1; }
.pap-hero-root .nero-ai-metric small { display: block; margin-top: 4px; color: #9fb0c9; font-size: 11px; }

.pap-hero-root .pap-canvas-wrap {
  position: relative;
  margin-top: 12px;
  height: 168px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.08);
  background: linear-gradient(145deg, #07091a 0%, #0d1224 55%, #090d1f 100%);
}
.pap-hero-root #pap-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}

.pap-hero-root .nero-ai-task-stream { margin-top: 12px; display: grid; gap: 8px; }
.pap-hero-root .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.pap-hero-root .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--pap-accent);
  font-size: 11px;
  font-weight: 800;
}
.pap-hero-root .nero-ai-task strong { display: block; color: #f8fafc; font-size: 12px; }
.pap-hero-root .nero-ai-task em { display: block; color: var(--pap-muted); font-size: 11px; font-style: normal; }
.pap-hero-root .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.pap-hero-root .nero-ai-status--amber { background: rgba(245,158,11,.12); color: #fde68a; }
.pap-hero-root .nero-ai-status--violet { background: rgba(139,92,246,.14); color: #ddd6fe; }

@media (max-width: 960px) {
  .pap-hero-root .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .pap-hero-root .nero-ai-dashboard { transform: none; }
  .pap-hero-root .nero-ai-hero { min-height: auto; padding-top: 56px; }
}
</style>

<div class="pap-hero-root" id="hero">
  <section class="nero-ai-hero nero-ai-section" aria-labelledby="pap-hero-title">
    <div class="nero-ai-container nero-ai-hero-grid">
      <div class="nero-ai-hero-copy">
        <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai патентный помощник</p>
        <h1 id="pap-hero-title">AI-ассистент патентного бюро: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
        <p class="nero-ai-hero-lead">Первичный разбор обозначения, классов МКТУ и рисков до консультации патентного специалиста</p>
        <ul class="nero-ai-badges" aria-label="Ключевые возможности">
          <li class="nero-ai-badge">МКТУ</li>
          <li class="nero-ai-badge">Risk Brief</li>
          <li class="nero-ai-badge">CRM</li>
          <li class="nero-ai-badge">152-ФЗ</li>
        </ul>
        <ol class="pap-hero-steps" aria-label="Этапы первичного разбора">
          <li class="pap-hero-step"><span>1</span> Intake</li>
          <li class="pap-hero-step"><span>2</span> МКТУ</li>
          <li class="pap-hero-step"><span>3</span> ФИПС</li>
          <li class="pap-hero-step"><span>4</span> Risk Brief</li>
          <li class="pap-hero-step"><span>5</span> CRM</li>
        </ol>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="#scenariy">Как работает</a>
        </div>
      </div>

      <div class="nero-ai-dashboard" aria-label="Демо Risk Brief патентного бюро">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">Патентное бюро · Risk Brief</span>
          </div>
          <div class="nero-ai-window-body">
            <div class="nero-ai-dashboard-title">
              <h3>IP-ассистент первичного приёма</h3>
              <span class="nero-ai-live-pill">онлайн</span>
            </div>
            <div class="nero-ai-metrics-grid">
              <div class="nero-ai-metric"><span>Обращения</span><strong>48</strong><small>неделя</small></div>
              <div class="nero-ai-metric"><span>Ответ</span><strong>3 мин</strong><small>первичный</small></div>
              <div class="nero-ai-metric"><span>Бриф</span><strong>94%</strong><small>полный</small></div>
              <div class="nero-ai-metric"><span>Риск</span><strong>auto</strong><small>скоринг</small></div>
            </div>
            <div class="pap-canvas-wrap" aria-hidden="true">
              <canvas id="pap-hero-canvas" role="img" aria-label="Анимация: заявка проходит intake, МКТУ, ФИПС и уходит в CRM как Risk Brief"></canvas>
            </div>
            <div class="nero-ai-task-stream">
              <div class="nero-ai-task">
                <span class="nero-ai-task-icon">IN</span>
                <div><strong>Заявка ТЗ</strong><em>обозначение + описание услуг</em></div>
                <span class="nero-ai-status">готово</span>
              </div>
              <div class="nero-ai-task">
                <span class="nero-ai-task-icon">AI</span>
                <div><strong>МКТУ 35, 42</strong><em>предварительный подбор классов</em></div>
                <span class="nero-ai-status nero-ai-status--amber">проверка</span>
              </div>
              <div class="nero-ai-task">
                <span class="nero-ai-task-icon">AI</span>
                <div><strong>Экспресс ФИПС</strong><em>скрининг сходств</em></div>
                <span class="nero-ai-status nero-ai-status--violet">скан</span>
              </div>
              <div class="nero-ai-task">
                <span class="nero-ai-task-icon">CRM</span>
                <div><strong>Бриф → сделка</strong><em>задача патентному поверенному</em></div>
                <span class="nero-ai-status">новое</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<section class="pap-intro" id="intro">
  <div class="pap-cnt">
    <div class="pap-intro-grid nero-ai-reveal">
      <div class="pap-intro-text">
        <p><strong>Коротко:</strong> AI патентный помощник — это не замена патентного поверенного, а воронка первичного разбора заявки. Ассистент собирает обозначение, предварительные классы МКТУ и оценку рисков, формирует бриф для специалиста и передаёт лид в CRM патентного бюро — до платной консультации.</p>
        <p>Рынок товарных знаков в России растёт рекордными темпами: в 2025 году Роспатент принял <strong>156 тыс. заявок</strong> на товарные знаки — почти вдвое больше, чем 60–70 тыс. пять лет назад (<a href="https://rg.ru/2026/02/08/eto-znak.html" target="_blank" rel="noopener noreferrer">РГ</a>). Более <strong>50%</strong> заявок подают физлица и самозанятые. Поток первичных обращений в патентные бюро и IP-фирмы увеличивается, а конверсия в платную экспертизу часто остаётся низкой: менеджеры и поверенные тратят часы на «холодные» лиды, которые не готовы к оплате.</p>
        <p>Nero Network внедряет <strong>AI-ассистент патентного бюро</strong> под ключ: от аудита воронки до интеграции с amoCRM, Битрикс24 и специализированными IP-системами. Результат — структурированный Risk Brief и готовый бриф для патентного специалиста за минуты, а не за дни.</p>
        <p><strong>Собрать IP-ассистента</strong> — первый шаг к автоматизации первичного приёма без потери юридической ответственности.</p>
      </div>
      <div class="pap-intro-kpi" aria-label="Ключевые метрики рынка">
        <div class="pap-kpi-card"><div class="kv">156 тыс.</div><div class="kl">заявок на ТЗ</div><div class="ks">2025, Роспатент</div></div>
        <div class="pap-kpi-card"><div class="kv">50%+</div><div class="kl">физлица</div><div class="ks">подают сами</div></div>
        <div class="pap-kpi-card"><div class="kv">1 млн+</div><div class="kl">знаков в РФ</div><div class="ks">действующих</div></div>
        <div class="pap-kpi-card"><div class="kv">20 млрд ₽</div><div class="kl">LegalTech</div><div class="ks">рынок 2026</div></div>
      </div>
    </div>
  </div>
</section>
<div class="pap-toc-outer"><div class="pap-cnt"><nav class="pap-toc" aria-label="Оглавление">
<a href="#zachem">Зачем AI</a>
<a href="#funkcii">Функции</a>
<a href="#scenariy">Сценарий</a>
<a href="#vnedrenie">Внедрение</a>
<a href="#integracii">Интеграции</a>
<a href="#ceny">Цена</a>
<a href="#zakaz">Заказ</a>
<a href="#compliance">Compliance</a>
<a href="#sravnenie">Сравнение</a>
<a href="#faq">FAQ</a>
</nav></div></div>
<div class="pap-content">
<section class="pap-section pap-section-alt" id="zachem">
  <div class="pap-cnt">
    <div class="pap-sh pap-left nero-ai-reveal"><h2>Зачем патентному бюро AI для первичного разбора заявок</h2></div>
    <div class="pap-prose nero-ai-reveal">
      <h3>Боль: много обращений и низкая конверсия в платную консультацию</h3>
      <p>Типичная IP-фирма получает десятки первичных обращений в неделю: через сайт, мессенджеры, звонки, партнёрские каналы. Часть клиентов приходит с неготовым обозначением, неверными ожиданиями по срокам и бюджету или без понимания классов МКТУ. Менеджер вручную задаёт одни и те же вопросы, поверенный проводит бесплатную консультацию — и только потом выясняется, что лид нецелевой.</p>
      <p>Проблема <strong>много первичных обращений патентное бюро</strong> масштабируется вместе с рынком: в стране уже действует <strong>свыше 1 млн</strong> зарегистрированных товарных знаков (<a href="https://vc.ru/legal/2722753-rospatent-2025-rekordy-registracii-tovarnyh-znakov" target="_blank" rel="noopener noreferrer">vc.ru</a>). Только за семь месяцев 2026 года подано <strong>16+ тыс.</strong> заявок на личные бренды (+17% год к году, <a href="https://1prime.ru/20260818/rospatent-872451402.html" target="_blank" rel="noopener noreferrer">ПРАЙМ</a>). Каждый такой запрос — потенциальное обращение в бюро.</p>
      <p><strong>Конверсия в платную консультацию патент</strong> падает, когда:</p>
      <p>- ответ на первичный запрос занимает часы или дни;</p>
      <p>- клиент не понимает ценность платной экспертизы после «бесплатного разговора»;</p>
      <p>- бриф неполный — поверенный начинает сбор данных с нуля на платной встрече.</p>
      <h3>Что клиент получает до встречи с патентным поверенным</h3>
      <p><strong>Определение:</strong> первичный разбор заявки патентное бюро — это структурированный сбор данных по обозначению, описанию товаров и услуг, предварительному подбору классов МКТУ и экспресс-оценке рисков <strong>до</strong> юридического заключения специалиста.</p>
      <p>До консультации клиент бюро (ваш лид) получает:</p>
      <p>- понятный сценарий: что нужно подготовить и какие шаги дальше;</p>
      <p>- предварительные классы МКТУ с пояснением «требует проверки поверенным»;</p>
      <p>- экспресс-проверку обозначения по открытым реестрам ФИПС;</p>
      <p>- уровень риска (низкий / средний / высокий) с дисклеймером «предварительная оценка»;</p>
      <p>- рекомендацию следующего шага: бесплатный звонок, платная экспертиза или отказ с объяснением.</p>
      <p>Для патентного бюро это означает: к консультации приходит лид с заполненным брифом, а не с фразой «хочу зарегистрировать название».</p>
      <p><strong>Собрать IP-ассистента</strong> — значит закрыть разрыв между бесплатным первичным контактом и продажей углублённой экспертизы.</p>
    </div>
  </div>
</section>
  <div class="pap-cnt"><aside class="ym-cta-block ym-cta-block--primary" id="cta-zachem">
  <div class="ym-cta-block__icon" aria-hidden="true">⚖️</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Собрать IP-ассистента для вашего бюро</p>
    <p class="ym-cta-block__sub">Покажем, как автоматизировать первичный разбор заявок: обозначение, МКТУ и экспресс-риски — с брифом в CRM до платной консультации. Оценка проекта за 1–2 дня.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside></div>
<section class="pap-section" id="funkcii">
  <div class="pap-cnt">
    <div class="pap-sh pap-left nero-ai-reveal"><h2>Что делает AI патентный помощник на первом этапе</h2></div>
    <div class="pap-prose nero-ai-reveal">
      <p><strong>Коротко:</strong> AI патентный помощник автоматизирует intake — сбор данных, классификацию обращения, экспресс-скрининг и формирование брифа. Юридическое заключение всегда остаётся за патентным поверенным.</p>
      <h3>Сбор данных по обозначению и описанию товара/услуги</h3>
      <p>Ассистент работает как структурированная анкета с диалоговым интерфейсом (сайт, Telegram, WhatsApp, виджет в CRM). Он уточняет:</p>
      <div class="pap-table-wrap"><table class="pap-table"><thead><tr><th>Поле</th><th>Зачем нужно</th></tr></thead><tbody><tr><td>Тип объекта</td><td>товарный знак, патент, программа для ЭВМ</td></tr><tr><td>Словесное обозначение / описание логотипа</td><td>база для экспресс-поиска</td></tr><tr><td>Описание товаров и услуг</td><td>подбор классов МКТУ</td></tr><tr><td>Цель регистрации</td><td>защита бренда, лицензирование, выход на маркетплейс</td></tr><tr><td>Юрисдикция и срочность</td><td>ветвление сценария</td></tr><tr><td>Бюджет и планы использования</td><td>квалификация лида (hot / warm / cold)</td></tr></tbody></table></div>
      <p>Международный аналог — Lexi AI для IP-фирм: система собирает proposed mark, goods/services, use status и географию, затем передаёт данные в docketing system (<a href="https://www.lexi.law/solutions/intellectual-property" target="_blank" rel="noopener noreferrer">lexi.law</a>). Российский <strong>ai товарный знак</strong>-сценарий строится по той же логике, но с учётом МКТУ и реестров ФИПС.</p>
      <h3>Предварительный подбор классов МКТУ</h3>
      <p><strong>Автоматизация подбора классов МКТУ</strong> — один из самых востребованных модулей. LLM (YandexGPT, GigaChat) в связке со справочником Nice/МКТУ предлагает предварительные классы с обоснованием. Каждая рекомендация сопровождается пометкой: «требует проверки патентным поверенным».</p>
      <p>Контекст рынка: в марте 2026 года USPTO запустила AI-агента <strong>Class ACT</strong> для автоматического присвоения классов Nice — по заявлению ведомства подготовка классификации сокращается с <strong>~5 месяцев до ~5 минут</strong>, результат проверяется человеком (<a href="https://www.uspto.gov/about-us/news-updates/trademark-classification-goes-agentic-usptos-announcement-class-act-assistant" target="_blank" rel="noopener noreferrer">USPTO</a>). Директор USPTO John A. Squires: «Classification takes five months? How about five minutes or even five seconds». Если государственное ведомство автоматизирует классификацию, патентному бюро на входе нужен сопоставимый инструмент.</p>
      <h3>Оценка рисков и «красных флагов» без юридического заключения</h3>
      <p><strong>Риски регистрации товарного знака автоматически</strong> система оценивает через экспресс-поиск по открытым реестрам ФИПС (словесная часть; для логотипа — флаг «нужна углублённая проверка»). Risk scoring engine присваивает уровень: низкий / средний / высокий.</p>
      <p>Важно: это <strong>не юридическая консультация</strong>. Corsearch фиксирует, что около <strong>60%</strong> предлагаемых названий брендов отклоняются из-за конфликтов на раннем этапе (<a href="https://corsearch.com/trademark-solutions/trademark-screening" target="_blank" rel="noopener noreferrer">corsearch.com</a>) — AI помогает выявить такие случаи до того, как поверенный потратит час на бесплатный разбор.</p>
      <p>Красные флаги, которые ассистент отмечает в брифе:</p>
      <p>- сходство со знаками из реестра;</p>
      <p>- описательность / отсутствие различительной способности;</p>
      <p>- совпадение с известными брендами;</p>
      <p>- AI-сгенерированный логотип без доработки (риск отказа Роспатента, <a href="https://vc.ru/legal/2843959-kak-zaregistrirovat-logotip-sozdannyi-ii-v-rospatente" target="_blank" rel="noopener noreferrer">vc.ru</a>);</p>
      <p>- спорные классы МКТУ на стыке категорий.</p>
    </div>
  </div>
</section>
<section class="pap-section pap-section-alt" id="scenariy">
  <div class="pap-cnt">
    <div class="pap-sh pap-left nero-ai-reveal"><h2>Как устроен сценарий первичного разбора заявки</h2></div>
    <div class="pap-prose nero-ai-reveal">
      <h3>Воронка: обращение → AI-анкета → бриф для специалиста</h3>
      <p><strong>Первичный разбор заявки до консультации</strong> выглядит как линейная воронка:</p>
      <p>1. Клиент оставляет обращение (сайт, мессенджер, ссылка менеджера).</p>
      <p>2. AI-ассистент уточняет тип объекта и собирает данные по сценарию.</p>
      <p>3. Система подбирает предварительные классы МКТУ и запускает экспресс-проверку.</p>
      <p>4. Формируется <strong>Risk Brief</strong>: риск, сходства, рекомендуемый шаг.</p>
      <p>5. Бриф и транскрипт диалога попадают в CRM; поверенный получает уведомление.</p>
      <p>6. Клиенту — CTA на консультацию с пониманием, что его запрос уже разобран.</p>
      <h3>Какие поля и документы собирает ассистент</h3>
      <p>Помимо таблицы полей выше, ассистент может запросить:</p>
      <p>- макет логотипа (файл или ссылка);</p>
      <p>- примеры использования обозначения (сайт, соцсети);</p>
      <p>- информацию о предыдущих попытках регистрации;</p>
      <p>- данные о целевых рынках (РФ, ЕАЭС, Мадридская система — с флагом «нужна экспертная оценка»).</p>
      <p>Для патентов на изобретения — описание технического решения, область применения, сведения о раскрытии (без замены патентного поиска; аналог POSINT: AI-поиск по 100+ млн документов за ~15 минут, <a href="https://posint.ru/" target="_blank" rel="noopener noreferrer">posint.ru</a>).</p>
      <h3>Где заканчивается автоматизация и начинается работа поверенного</h3>
      <p><strong>Итог:</strong> AI заканчивается на предварительном скрининге и структурированном брифе. Поверенный начинает там, где нужна юридическая экспертиза.</p>
      <div class="pap-table-wrap"><table class="pap-table"><thead><tr><th>Этап</th><th>AI</th><th>Патентный поверенный</th></tr></thead><tbody><tr><td>Сбор данных intake</td><td>✓</td><td>модерация спорных случаев</td></tr><tr><td>Предварительный МКТУ</td><td>✓</td><td>финальный подбор и обоснование</td></tr><tr><td>Экспресс-поиск ФИПС</td><td>✓</td><td>углублённый поиск (фонетика, изобразительный)</td></tr><tr><td>Оценка риска</td><td>✓ (предварительная)</td><td>юридическое заключение</td></tr><tr><td>Подготовка документов</td><td>✗</td><td>✓</td></tr><tr><td>Подача в Роспатент</td><td>✗</td><td>✓</td></tr><tr><td>Переговоры и договор</td><td>✗</td><td>✓</td></tr></tbody></table></div>
      <p><strong>Проверка обозначения товарного знака ai</strong> на этом этапе — screening, а не clearance. Углублённый поиск в патентных бюро стоит от <strong>4 000–13 000 ₽</strong> (<a href="https://smartpatent.ru/stoimost-patentnyh-uslug" target="_blank" rel="noopener noreferrer">smartpatent.ru</a>); AI готовит клиента к этой платной услуге.</p>
    </div>
  </div>
</section>
<section id="ai-patentnyy-pomoshchnik-boris-block" class="bip-root pap-section" aria-label="Анимация: воронка первичного разбора заявки — от обращения до Risk Brief в CRM">
<style>
/* === БОРИС: prefix bip-, scoped внутри #ai-patentnyy-pomoshchnik-boris-block === */
#ai-patentnyy-pomoshchnik-boris-block.bip-root{
  padding:clamp(48px,6vw,72px) 0;
  position:relative;
}
#ai-patentnyy-pomoshchnik-boris-block .bip-cnt{
  width:min(1160px,calc(100% - 40px));
  margin:0 auto;
}
#ai-patentnyy-pomoshchnik-boris-block .bip-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:rgba(255,255,255,.045);
  border:1px solid rgba(255,255,255,.10);
  box-shadow:0 24px 64px rgba(0,0,0,.35),inset 0 1px 0 rgba(255,255,255,.06);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-patentnyy-pomoshchnik-boris-block .bip-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-patentnyy-pomoshchnik-boris-block .bip-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid rgba(255,255,255,.08);
}
@media(max-width:1023px){
  #ai-patentnyy-pomoshchnik-boris-block .bip-lft{
    border-right:none;
    border-bottom:1px solid rgba(255,255,255,.08);
    padding:32px 24px;
  }
}
#ai-patentnyy-pomoshchnik-boris-block .bip-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#79f2ff;
  margin:0 0 14px;
}
#ai-patentnyy-pomoshchnik-boris-block .bip-ey::before{
  content:'';
  width:18px;height:2px;
  background:#79f2ff;
  border-radius:1px;
}
#ai-patentnyy-pomoshchnik-boris-block .bip-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#fff;
  line-height:1.28;
  margin:0 0 18px;
  letter-spacing:-.02em;
}
#ai-patentnyy-pomoshchnik-boris-block .bip-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-patentnyy-pomoshchnik-boris-block .bip-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.55;
  color:#9aa8bd;
}
#ai-patentnyy-pomoshchnik-boris-block .bip-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(121,242,255,.12);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#79f2ff;
  margin-top:1px;
  font-style:normal;
}
#ai-patentnyy-pomoshchnik-boris-block .bip-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-patentnyy-pomoshchnik-boris-block .bip-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-patentnyy-pomoshchnik-boris-block .bip-pl-c{
  background:rgba(121,242,255,.10);
  color:#79f2ff;
  border:1.5px solid rgba(121,242,255,.28);
}
#ai-patentnyy-pomoshchnik-boris-block .bip-pl-v{
  background:rgba(139,92,246,.10);
  color:#a78bfa;
  border:1.5px solid rgba(139,92,246,.28);
}
#ai-patentnyy-pomoshchnik-boris-block .bip-pl-g{
  background:rgba(34,197,94,.10);
  color:#4ade80;
  border:1.5px solid rgba(34,197,94,.28);
}
#ai-patentnyy-pomoshchnik-boris-block .bip-pl-a{
  background:rgba(245,158,11,.10);
  color:#fbbf24;
  border:1.5px solid rgba(245,158,11,.28);
}
#ai-patentnyy-pomoshchnik-boris-block .bip-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-patentnyy-pomoshchnik-boris-block .bip-rgt{
  position:relative;
  background:linear-gradient(145deg,#07091a 0%,#0d1224 48%,#090d1f 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-patentnyy-pomoshchnik-boris-block .bip-rgt{min-height:380px;}
}
#bip-intake-funnel-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bip-cnt">
  <div class="bip-card">

    <div class="bip-lft">
      <span class="bip-ey">Воронка intake</span>
      <h3 class="bip-h3">От обращения до Risk Brief в CRM — за минуты, не за дни</h3>
      <ul class="bip-ul">
        <li><span class="bip-ic">1</span>Клиент оставляет заявку — сайт, Telegram или ссылка менеджера</li>
        <li><span class="bip-ic">2</span>AI-анкета собирает обозначение, описание товаров/услуг и цель регистрации</li>
        <li><span class="bip-ic">3</span>Предварительные классы МКТУ + экспресс-проверка по реестрам ФИПС</li>
        <li><span class="bip-ic">→</span>Risk Brief и транскрипт попадают в CRM — поверенный получает готовый бриф</li>
      </ul>
      <div class="bip-pills">
        <span class="bip-pl bip-pl-c">⏱ 3 мин · первичный ответ</span>
        <span class="bip-pl bip-pl-v">МКТУ 35 · 42</span>
        <span class="bip-pl bip-pl-a">риск · средний</span>
        <span class="bip-pl bip-pl-g">94% · полный бриф</span>
      </div>
      <p class="bip-foot">Дальше — этапы внедрения AI патентного помощника под ключ →</p>
    </div>

    <div class="bip-rgt">
      <canvas
        id="bip-intake-funnel-canvas"
        aria-label="Анимация воронки: обращение клиента проходит AI-анкету, подбор МКТУ, проверку ФИПС и формирует Risk Brief в CRM"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bip-intake-funnel-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0, pulse = 0;

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
    text:'#e2e8f0',
    muted:'rgba(226,232,240,.45)',
    cyan:'#79f2ff',
    cyanD:function(a){return 'rgba(121,242,255,'+a+')';},
    viol:'#a78bfa',
    violD:function(a){return 'rgba(167,139,250,'+a+')';},
    green:'#4ade80',
    greenD:function(a){return 'rgba(74,222,128,'+a+')';},
    amber:'#fbbf24',
    amberD:function(a){return 'rgba(251,191,36,'+a+')';},
    red:'#f87171',
    card:'rgba(255,255,255,.065)',
    cardBdr:'rgba(255,255,255,.12)',
    line:'rgba(255,255,255,.08)',
    glow:'rgba(121,242,255,.15)'
  };

  var STAGES = [
    {id:'in',   label:'IN',      sub:'Заявка ТЗ',     xR:.08,  clr:C.cyan,  dimFn:C.cyanD},
    {id:'ai',   label:'AI',      sub:'Анкета',        xR:.26,  clr:C.viol,  dimFn:C.violD},
    {id:'mktu', label:'МКТУ',    sub:'35 · 42',       xR:.44,  clr:C.cyan,  dimFn:C.cyanD},
    {id:'fips', label:'ФИПС',    sub:'Экспресс',      xR:.62,  clr:C.viol,  dimFn:C.violD},
    {id:'brief',label:'Brief',   sub:'Risk Brief',    xR:.80,  clr:C.amber, dimFn:C.amberD},
    {id:'crm',  label:'CRM',     sub:'Сделка',        xR:.94,  clr:C.green, dimFn:C.greenD}
  ];

  var TOKEN = {x:-40, y:0, alpha:0, stage:0};
  var LOOP = 780;
  var BRIEF_ALPHA = 0;
  var SCAN_Y = 0;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawTopBar(){
    ctx.fillStyle=C.text;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Патентное бюро · intake pipeline', 14, 22);

    var gR = 6 + Math.sin(pulse * 0.08) * 2;
    ctx.beginPath(); ctx.arc(W - 58, 18, gR + 3, 0, Math.PI * 2);
    ctx.fillStyle = 'rgba(74,222,128,' + (0.12 + 0.08 * Math.sin(pulse * 0.08)) + ')';
    ctx.fill();
    ctx.beginPath(); ctx.arc(W - 58, 18, 4, 0, Math.PI * 2);
    ctx.fillStyle = C.green; ctx.fill();
    ctx.fillStyle = C.green;
    ctx.font = '10px Inter,sans-serif';
    ctx.fillText('live', W - 48, 22);

    ctx.strokeStyle = C.line; ctx.lineWidth = 1;
    ctx.beginPath(); ctx.moveTo(0, 34); ctx.lineTo(W, 34); ctx.stroke();
  }

  function stagePos(i){
    var top = 52;
    var bot = H - 28;
    var midY = (top + bot) / 2;
    var boxW = Math.min(72, W * 0.11);
    var boxH = 56;
    var x = STAGES[i].xR * W - boxW / 2;
    return {x:x, y:midY - boxH/2, w:boxW, h:boxH, midY:midY};
  }

  function drawStages(activeIdx){
    STAGES.forEach(function(st, i){
      var p = stagePos(i);
      var isActive = i === activeIdx;
      var isPast = i < activeIdx;

      if(isActive){
        ctx.shadowColor = st.clr;
        ctx.shadowBlur = 14;
      }
      rr(p.x, p.y, p.w, p.h, 10,
        isActive ? st.dimFn(0.18) : (isPast ? st.dimFn(0.10) : C.card),
        isActive ? st.clr : C.cardBdr, isActive ? 2 : 1);
      ctx.shadowBlur = 0;

      ctx.fillStyle = isActive || isPast ? st.clr : C.muted;
      ctx.font = 'bold 11px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(st.label, p.x + p.w/2, p.y + 22);

      ctx.fillStyle = C.muted;
      ctx.font = '9px Inter,sans-serif';
      ctx.fillText(st.sub, p.x + p.w/2, p.y + 38);

      if(i < STAGES.length - 1){
        var p2 = stagePos(i + 1);
        var x1 = p.x + p.w + 4;
        var x2 = p2.x - 4;
        var y = p.midY;
        ctx.strokeStyle = isPast ? st.dimFn(0.35) : C.line;
        ctx.lineWidth = isPast ? 2 : 1;
        ctx.setLineDash(isPast ? [] : [4, 4]);
        ctx.beginPath(); ctx.moveTo(x1, y); ctx.lineTo(x2, y); ctx.stroke();
        ctx.setLineDash([]);

        if(isPast){
          ctx.fillStyle = st.clr;
          ctx.beginPath();
          ctx.moveTo(x2 - 6, y - 4);
          ctx.lineTo(x2, y);
          ctx.lineTo(x2 - 6, y + 4);
          ctx.closePath();
          ctx.fill();
        }
      }
    });
  }

  function drawToken(t){
    if(t.alpha <= 0) return;
    ctx.globalAlpha = t.alpha;
    var r = 10;
    var grd = ctx.createRadialGradient(t.x, t.y, 0, t.x, t.y, r * 2);
    grd.addColorStop(0, C.cyan);
    grd.addColorStop(1, 'rgba(121,242,255,0)');
    ctx.fillStyle = grd;
    ctx.beginPath(); ctx.arc(t.x, t.y, r * 2, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.cyan;
    ctx.beginPath(); ctx.arc(t.x, t.y, r, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = '#050711';
    ctx.font = 'bold 8px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('TZ', t.x, t.y + 3);
    ctx.globalAlpha = 1;
  }

  function drawBriefCard(alpha){
    if(alpha <= 0) return;
    var bw = Math.min(200, W * 0.32);
    var bh = 110;
    var bx = W * 0.72 - bw / 2;
    var by = H - bh - 36;
    ctx.globalAlpha = alpha;
    rr(bx, by, bw, bh, 12, 'rgba(15,23,42,.85)', C.amber, 1.5);
    ctx.fillStyle = C.text;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Risk Brief · предварительно', bx + 12, by + 20);

    var chips = [
      {t:'МКТУ 35', c:C.cyan},
      {t:'МКТУ 42', c:C.cyan},
      {t:'средний риск', c:C.amber}
    ];
    var cx = bx + 12;
    chips.forEach(function(ch){
      var tw = ctx.measureText(ch.t).width + 16;
      rr(cx, by + 30, tw, 20, 10, ch.c === C.amber ? C.amberD(0.15) : C.cyanD(0.12), ch.c, 1);
      ctx.fillStyle = ch.c;
      ctx.font = '9px Inter,sans-serif';
      ctx.fillText(ch.t, cx + 8, by + 44);
      cx += tw + 6;
    });

    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText('Сходство: 2 знака в реестре', bx + 12, by + 72);
    ctx.fillStyle = C.green;
    ctx.fillText('→ платная экспертиза', bx + 12, by + 88);
    ctx.globalAlpha = 1;
  }

  function drawFipsScan(progress){
    if(progress <= 0 || progress >= 1) return;
    var p = stagePos(3);
    var scanH = p.h + 20;
    SCAN_Y = p.y - 10 + progress * (scanH + 20);
    ctx.strokeStyle = C.cyanD(0.6);
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(p.x - 8, SCAN_Y);
    ctx.lineTo(p.x + p.w + 8, SCAN_Y);
    ctx.stroke();
    ctx.fillStyle = C.cyanD(0.08);
    ctx.fillRect(p.x - 8, p.y - 10, p.w + 16, SCAN_Y - p.y + 10);
  }

  function updateToken(f){
    var phase = f % LOOP;
    var travelStart = 40;
    var travelEnd = 620;
    var t = (phase - travelStart) / (travelEnd - travelStart);
    t = Math.max(0, Math.min(1, t));

    if(phase < 20){ TOKEN.alpha = 0; TOKEN.stage = 0; BRIEF_ALPHA = 0; return; }
    TOKEN.alpha = Math.min(1, (phase - 20) / 30);

    var seg = t * (STAGES.length - 1);
    var si = Math.floor(seg);
    var st = seg - si;
    si = Math.min(si, STAGES.length - 2);
    TOKEN.stage = si;

    var p1 = stagePos(si);
    var p2 = stagePos(si + 1);
    TOKEN.x = p1.x + p1.w/2 + (p2.x + p2.w/2 - p1.x - p1.w/2) * st;
    TOKEN.y = p1.midY;

    if(phase > 520) BRIEF_ALPHA = Math.min(1, (phase - 520) / 80);
    else BRIEF_ALPHA = 0;
  }

  function loop(){
    frame++;
    pulse++;
    ctx.clearRect(0, 0, W, H);

    var bg = ctx.createLinearGradient(0, 0, W, H);
    bg.addColorStop(0, '#07091a');
    bg.addColorStop(1, '#0d1224');
    ctx.fillStyle = bg;
    ctx.fillRect(0, 0, W, H);

    drawTopBar();
    updateToken(frame);
    drawStages(TOKEN.stage);
    drawFipsScan((frame % LOOP > 280 && frame % LOOP < 380) ? ((frame % LOOP) - 280) / 100 : -1);
    drawToken(TOKEN);
    drawBriefCard(BRIEF_ALPHA);

    requestAnimationFrame(loop);
  }

  var paused = false;
  document.addEventListener('visibilitychange', function(){
    paused = document.hidden;
  });

  function safeLoop(){
    if(!paused) loop();
    else requestAnimationFrame(safeLoop);
  }
  safeLoop();
})();
</script>
</section>

<section class="pap-section" id="vnedrenie">
  <div class="pap-cnt">
    <div class="pap-sh pap-left nero-ai-reveal"><h2>Внедрение AI патентного помощника под ключ</h2></div>
    <div class="pap-prose nero-ai-reveal">
      <p><strong>Коротко:</strong> внедрение ai патентный помощник под ключ в Nero Network занимает 2–6 недель: аудит → проектирование → разработка → интеграция CRM → пилот → запуск.</p>
      <h3>Аудит текущего приёма заявок в бюро</h3>
      <p>Этап 1–2 дня. Карта каналов лидов (сайт, WhatsApp, Telegram, звонки, email), поля первичной заявки, SLA ответа, <strong>конверсия в платную консультацию</strong>. Анализ 20–50 анонимизированных обращений для калибровки сценариев.</p>
      <h3>Проектирование сценариев и базы знаний IP-фирмы</h3>
      <p>3–5 дней. Ветки для товарного знака / патента / ПО; обязательные и опциональные поля; дисклеймеры; RAG по FAQ бюро, шаблонам рисков, прайс-листу. Регламент: что AI может и не может говорить.</p>
      <h3>Разработка, тестирование и запуск</h3>
      <p>1–2 недели на сборку ассистента: LLM (YandexGPT / GigaChat для 152-ФЗ) + модуль МКТУ + экспресс-скрининг ФИПС + генератор брифа. Пилот 2–4 недели на 50–100 реальных обращениях; калибровка промптов; отчёт по конверсии.</p>
      <p><strong>Разработка ai патентный помощник</strong> в Nero Network — не покупка универсального чат-бота, а кастомный IP-ассистент под процессы конкретного бюро. Публичных прямых кейсов B2B-внедрения «ассистент первичного приёма в патентное бюро» в открытых источниках России <strong>не найдено</strong> — это нишевое преимущество для ранних внедренцев.</p>
      <p><strong>Собрать IP-ассистента</strong> — заказать аудит и проектную оценку.</p>
    </div>
  </div>
</section>
  <div class="pap-cnt"><aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до старта проекта?</p>
    <p class="ym-cta-block__sub">Перед внедрением IP-ассистента полезно разобраться в промптах, human-in-the-loop и интеграции с CRM — это ускоряет согласование сценариев с патентными поверенными. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
  </div>
</aside></div>
<section class="pap-section pap-section-alt" id="integracii">
  <div class="pap-cnt">
    <div class="pap-sh pap-left nero-ai-reveal"><h2>Интеграция с CRM и внутренними системами патентного бюро</h2></div>
    <div class="pap-prose nero-ai-reveal">
      <h3>amoCRM, Битрикс24 и внутренние реестры заявок</h3>
      <p><strong>Ai патентный помощник интеграция crm</strong> — обязательный блок внедрения. Типовой стек:</p>
      <p>- <strong>amoCRM / Битрикс24</strong> — создание лида, сделки, задачи поверенному, теги риска;</p>
      <p>- <strong>CODE9</strong> (кейс патентного бюро): парсинг писем Роспатента, привязка к делам, автосмена этапов — матчинг до 100%, снижение ручного поиска на 90%+ (<a href="https://codenine.ru/case-patent-bureau" target="_blank" rel="noopener noreferrer">codenine.ru</a>);</p>
      <p>- <strong>VERMIK Patent, CRMPATENT, АПБ</strong> — учёт заявок, сроков, синхронизация с Роспатентом (<a href="https://1vermik.com/" target="_blank" rel="noopener noreferrer">1vermik.com</a>, <a href="https://crmpatent.ru/site/" target="_blank" rel="noopener noreferrer">crmpatent.ru</a>, <a href="http://docpatent.ru/" target="_blank" rel="noopener noreferrer">docpatent.ru</a>).</p>
      <p>AI-ассистент <strong>не заменяет</strong> специализированные IP-системы — он подаёт в них структурированные лиды и брифы.</p>
      <h3>Передача лида с заполненным брифом патентному специалисту</h3>
      <p>После завершения диалога в CRM создаётся карточка с полями:</p>
      <p>- обозначение и описание;</p>
      <p>- предварительные классы МКТУ;</p>
      <p>- уровень риска и найденные сходства;</p>
      <p>- приоритет лида (hot / warm / cold);</p>
      <p>- транскрипт диалога и сгенерированный PDF-бриф;</p>
      <p>- рекомендуемый следующий шаг.</p>
      <p>Менеджер или поверенный получает push-уведомление. Время от обращения до готового брифа — <strong>минуты</strong> вместо часов.</p>
      <h3>Связка с базами Роспатента и справочниками МКТУ (обзорно)</h3>
      <p><strong>Интеграция ai роспатент база</strong> реализуется через:</p>
      <p>- открытые реестры fips.ru (экспресс-поиск);</p>
      <p>- платный модуль new.fips.ru (от ~<strong>3 500 ₽/мес</strong>, <a href="https://vitvet.com/articles/tovarnyj-znak/registraciya/proverka-rospatent/" target="_blank" rel="noopener noreferrer">vitvet.com</a>);</p>
      <p>- внутренние справочники МКТУ в RAG-базе ассистента.</p>
      <p>Гардиум.Про обрабатывает <strong>10 000+ проверок брендов в месяц</strong> с эвристическими алгоритмами ранжирования (<a href="https://gardium.pro/" target="_blank" rel="noopener noreferrer">gardium.pro</a>) — ориентир масштаба для screening-модуля.</p>
    </div>
  </div>
</section>
<section class="pap-section" id="ceny">
  <div class="pap-cnt">
    <div class="pap-sh pap-left nero-ai-reveal"><h2>Сколько стоит AI патентный помощник и из чего складывается цена</h2></div>
    <div class="pap-prose nero-ai-reveal">
      <h3>Ориентир чека 150–500 тыс. ₽: факторы сметы</h3>
      <p><strong>Ai патентный помощник цена</strong> зависит от объёма:</p>
      <div class="pap-table-wrap"><table class="pap-table"><thead><tr><th>Фактор</th><th>Влияние на смету</th></tr></thead><tbody><tr><td>Количество сценариев (ТЗ / патент / ПО)</td><td>+30–50% за каждый новый тип</td></tr><tr><td>Каналы (сайт + 2–3 мессенджера)</td><td>+20–40%</td></tr><tr><td>Интеграция CRM + IP-система</td><td>+50–100 тыс. ₽</td></tr><tr><td>Платный модуль ФИПС</td><td>от 3 500 ₽/мес (подписка)</td></tr><tr><td>On-prem / 152-ФЗ контур</td><td>+20–30% к разработке</td></tr><tr><td>Панель модерации и аналитика</td><td>входит в расширенную версию</td></tr></tbody></table></div>
      <p><strong>Стоимость внедрения ai в патентное бюро</strong> в Nero Network: ориентир <strong>150–500 тыс. ₽</strong> за проект под ключ (данные Google Таблицы, строка 137).</p>
      <p>Для сравнения: B2C-бот IPbot берёт <strong>5 000 ₽</strong> за расширенную заявку (<a href="https://ipbot.ru/" target="_blank" rel="noopener noreferrer">ipbot.ru</a>) — но это продукт для заявителя, а не внедрение в бюро. <strong>Сколько стоит ai патентный помощник</strong> для IP-фирмы — вопрос ROI: один менеджер на рутинном intake стоит дороже годового обслуживания ассистента.</p>
      <h3>Что входит в MVP и что — в расширенную версию</h3>
      <p><strong>MVP (2–3 недели, от ~150 тыс. ₽):</strong></p>
      <p>- один сценарий (товарный знак);</p>
      <p>- один канал (виджет на сайте или Telegram);</p>
      <p>- подбор МКТУ + экспресс-скрининг ФИПС;</p>
      <p>- интеграция с одной CRM;</p>
      <p>- дисклеймеры и панель модерации.</p>
      <p><strong>Расширенная версия (4–6 недель, до 500 тыс. ₽):</strong></p>
      <p>- несколько типов объектов (ТЗ, патент, ПО);</p>
      <p>- мультиканальность (сайт, WhatsApp, VK);</p>
      <p>- связка с VERMIK / CRMPATENT / АПБ;</p>
      <p>- аналитика воронки (источник → риск → конверсия);</p>
      <p>- A/B тесты сценариев intake;</p>
      <p>- обучение команды и регламент compliance.</p>
      <h3>Сроки и этапы оплаты</h3>
      <p>Типовая схема:</p>
      <p>1. <strong>30%</strong> — после брифа и согласования ТЗ (1–2 дня);</p>
      <p>2. <strong>40%</strong> — после сборки MVP и внутреннего тестирования;</p>
      <p>3. <strong>30%</strong> — после пилота и запуска в продакшн.</p>
      <p>Международный ориентир ROI: кейс PatentAI Assistant (120+ attorneys) — окупаемость за <strong>6 месяцев</strong>, −65% времени на document review (<a href="https://www.atomicdata.com/wp-content/uploads/2025/12/Case-Study-Agentic-AI.pdf" target="_blank" rel="noopener noreferrer">atomicdata.com</a>). Для intake-ассистента точные проценты конверсии даёт пилот на ваших данных.</p>
    </div>
  </div>
</section>
  <div class="pap-cnt"><aside class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Узнайте бюджет внедрения под ваше бюро</p>
    <p class="ym-cta-block__sub">Ориентир <strong>150–500 тыс. ₽</strong> за проект под ключ: MVP от ~150 тыс. ₽, расширенная версия — до 500 тыс. ₽. На брифе за 1–2 дня дадим смету, сроки и состав пилота.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a href="#zakaz" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как заказать</a>
    </div>
  </div>
</aside></div>
<section class="pap-section pap-section-alt" id="zakaz">
  <div class="pap-cnt">
    <div class="pap-sh pap-left nero-ai-reveal"><h2>Как заказать разработку и внедрение</h2></div>
    <div class="pap-prose nero-ai-reveal">
      <h3>Бриф и оценка проекта за 1–2 дня</h3>
      <p><strong>Ai патентный помощник заказать</strong> в Nero Network:</p>
      <p>1. Оставьте заявку с описанием бюро и текущей воронки.</p>
      <p>2. Получите чек-лист данных для оценки (каналы, CRM, объёмы обращений).</p>
      <p>3. Через 1–2 дня — смета, сроки, состав MVP.</p>
      <h3>Пилот на одном типе заявок (товарный знак / патент)</h3>
      <p>Рекомендуем начать с <strong>товарного знака</strong> — максимальный поток обращений (156 тыс. заявок в 2025). Пилот 2–4 недели на 50–100 реальных диалогах; калибровка промптов; отчёт: доля лидов с полным брифом, конверсия в платную экспертизу, время ответа.</p>
      <h3>Масштабирование на всё патентное бюро</h3>
      <p>После пилота — подключение патентов, ПО, дополнительных каналов и филиалов. <strong>Ai патентный помощник для бизнеса</strong> и <strong>ai патентный помощник для компании</strong> с сетью IP-фирм получают единую аналитику по рискам и источникам лидов.</p>
      <p><strong>Ai патентный помощник внедрение под ключ</strong> — от аудита до обучения команды. CTA: <strong>Собрать IP-ассистента</strong>.</p>
    </div>
  </div>
</section>
<section class="pap-section" id="compliance">
  <div class="pap-cnt">
    <div class="pap-sh pap-left nero-ai-reveal"><h2>Compliance: AI-помощник и границы юридической консультации</h2></div>
    <div class="pap-prose nero-ai-reveal">
      <h3>Дисклеймеры и ответственность IP-фирмы</h3>
      <p><strong>Граница ai помощника и юридической консультации</strong> — ключевой compliance-блок. По Национальной стратегии развития ИИ: «ответственность за все последствия работы систем искусственного интеллекта всегда несёт физическое или юридическое лицо» (<a href="https://harant.ru/blog/drugoe/avtomatizirovannye-yuridicheskie-konsultaczii-neset-li-praktikuyushhij-yurist-otvetstvennost/" target="_blank" rel="noopener noreferrer">HARANT</a>).</p>
      <p>Каждый ответ ассистента сопровождается дисклеймером: «предварительная информационная оценка, не является юридической консультацией». Ответственность за заключение — на патентном бюро и поверенном.</p>
      <h3>Что можно автоматизировать безопасно, а что — только эксперт</h3>
      <p><strong>Безопасно для AI:</strong></p>
      <p>- сбор структурированных данных;</p>
      <p>- предварительный подбор МКТУ с пометкой «требует проверки»;</p>
      <p>- экспресс-поиск по открытым реестрам;</p>
      <p>- оценка уровня риска с human-in-the-loop;</p>
      <p>- суммаризация переписки для поверенного.</p>
      <p><strong>Только эксперт:</strong></p>
      <p>- юридическое заключение об охраноспособности;</p>
      <p>- рекомендации по изменению обозначения (до approve поверенного);</p>
      <p>- решение о подаче / отказе;</p>
      <p>- работа с иностранными юрисдикциями;</p>
      <p>- ответы на запросы Роспатента.</p>
      <p>Модель USPTO Class ACT: AI готовит классификацию за минуты, <strong>человек проверяет результат</strong> — эталон human-in-the-loop для <strong>legal tech для патентного бюро</strong>.</p>
      <h3>Хранение персональных данных и коммерческой тайны клиентов</h3>
      <p>Российский LegalTech в 2026 оценивается в <strong>~20 млрд ₽</strong>; <strong>95%+</strong> решений — отечественные (<a href="https://www.cnews.ru/news/line/2026-06-10_rossijskij_rynok_legaltech_v" target="_blank" rel="noopener noreferrer">CNews</a>). Для IP-фирм критичен российский контур данных:</p>
      <p>- YandexGPT, GigaChat — обработка в РФ;</p>
      <p>- NDA и политика хранения;</p>
      <p>- опция on-prem развёртывания;</p>
      <p>- модерация: любой вывод «высокий риск» — после approve поверенного или с явным дисклеймером.</p>
    </div>
  </div>
</section>
<section class="pap-section pap-section-alt" id="sravnenie">
  <div class="pap-cnt">
    <div class="pap-sh pap-left nero-ai-reveal"><h2>AI в патентных процессах vs ручной приём и готовые legal tech</h2></div>
    <div class="pap-prose nero-ai-reveal">
      <h3>Сравнение с чат-ботом «вопрос-ответ»</h3>
      <p>Шаблонный <strong>чат-бот патентное бюро первичная консультация</strong> отвечает на FAQ, но не собирает структурированный бриф, не подбирает МКТУ и не запускает screening. AI-ассистент Nero Network — <strong>сценарный intake-агент</strong> с Risk Brief и CRM-интеграцией.</p>
      <h3>Отличие кастомного IP-ассистента от универсальной нейросети для юристов</h3>
      <p><strong>Нейросеть для юристов</strong> и <strong>ai ассистент для юриста</strong> generic-формата не знают МКТУ, специфику ФИПС и воронку патентного бюро. Кастомный ассистент обучен на FAQ, прайсе и регламентах конкретной IP-фирмы.</p>
      <div class="pap-table-wrap"><table class="pap-table"><thead><tr><th>Критерий</th><th>Универсальная нейросеть</th><th>IP-ассистент Nero Network</th></tr></thead><tbody><tr><td>Подбор МКТУ</td><td>общие ответы</td><td>RAG + справочник Nice</td></tr><tr><td>Поиск ФИПС</td><td>нет</td><td>экспресс-скрининг</td></tr><tr><td>CRM-интеграция</td><td>нет</td><td>amoCRM, Битрикс24, IP-системы</td></tr><tr><td>Compliance</td><td>нет дисклеймеров</td><td>human-in-the-loop</td></tr><tr><td>Модель</td><td>B2C</td><td>B2B внедрение в бюро</td></tr></tbody></table></div>
      <h3>Когда достаточно шаблонной формы, а когда нужен AI-агент</h3>
      <p>Шаблонная форма на сайте подойдёт, если обращений <5 в неделю и менеджер успевает обрабатывать вручную. <strong>Автоматизация патентного бюро</strong> с AI-агентом нужна, когда:</p>
      <p>- поток первичных заявок растёт (тренд 156 тыс./год на рынке);</p>
      <p>- бесплатные консультации съедают время поверенных;</p>
      <p>- нужна единая воронка из нескольких каналов;</p>
      <p>- важна аналитика: источник → риск → конверсия.</p>
      <p>B2C-аналог IPbot (<a href="https://ipbot.ru/" target="_blank" rel="noopener noreferrer">ipbot.ru</a>) — freemium-бот для заявителя (подбор МКТУ + экспресс-проверка бесплатно, расширенная заявка 5 000 ₽). Он <strong>конкурирует</strong> с бюро, а не внедряется в него. Nero Network делает обратное: ассистент <strong>внутри</strong> вашего бюро, под вашим брендом.</p>
    </div>
  </div>
</section>
<div class="pap-cnt"><aside class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы масштабировать первичный приём без потери качества?</p>
    <p class="ym-cta-block__sub">На фоне 156 тыс. заявок на товарные знаки в 2025 году AI-ассистент — практичный шаг для IP-фирмы. Первый шаг — оценка проекта.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside></div>
<section class="pap-section" id="faq">
  <div class="pap-cnt">
    <div class="pap-sh nero-ai-reveal"><h2>FAQ — частые вопросы о внедрении AI в патентное бюро</h2></div>
    <div class="pap-faq nero-ai-reveal">
      <details class="pap-faq-item">
        <summary class="pap-faq-q">Подходит ли решение для малого бюро и сети IP-фирм?</summary>
        <div class="pap-faq-a"><p>Да. MVP для малого бюро (1–3 поверенных) — один сценарий ТЗ и Telegram-бот. Для сети IP-фирм — единая аналитика, мультиканальность и интеграция с корпоративной CRM. <strong>Ai патентное бюро</strong> любого масштаба получает стандартизацию первичного приёма.</p></div>
      </details>
      <details class="pap-faq-item">
        <summary class="pap-faq-q">Можно ли начать только с товарных знаков?</summary>
        <div class="pap-faq-a"><p>Да, это рекомендуемый пилот. Товарные знаки — основной поток обращений; сценарий отработан на рынке (IPbot, Гардиум.Про, Patentcore). Патенты и ПО подключаются на втором этапе.</p></div>
      </details>
      <details class="pap-faq-item">
        <summary class="pap-faq-q">Как измерить ROI после внедрения?</summary>
        <div class="pap-faq-a"><p>Метрики пилота: - время от обращения до готового брифа (цель: минуты); - доля лидов с полным брифом до звонка; - конверсия в платную экспертизу; - часы поверенных на «пустых» консультациях (до/после); - источники лидов и типовые риски. Точные проценты — после пилота на ваших данных. Международный ориентир: −60% времени на intake prep (Lexi AI), окупаемость 6 месяцев (PatentAI Assistant).</p></div>
      </details>
      <details class="pap-faq-item">
        <summary class="pap-faq-q">Нужна ли доработка при смене редакции МКТУ?</summary>
        <div class="pap-faq-a"><p>Справочник МКТУ обновляется в RAG-базе ассистента. Типовая доработка — 1–2 дня. WIPO запустила AI Infrastructure Interchange (AIII) в марте 2026 (<a href="https://legalblogs.wolterskluwer.com/trademark-blog/trademark-news-what-flew-under-the-radar-in-april-2026/" target="_blank" rel="noopener noreferrer">Kluwer Trademark Blog</a>) — тренд на стандартизацию IP-данных для AI.</p></div>
      </details>
      <details class="pap-faq-item">
        <summary class="pap-faq-q">Заменит ли AI патентного поверенного?</summary>
        <div class="pap-faq-a"><p>Нет. AI — инструмент intake и screening. Юридическое заключение, подготовка документов, переговоры и ответы Роспатенту — зона поверенного. Как формулирует практика: «ИИ — отличный инструмент, но финальный результат должен пройти через человеческий контроль и экспертизу» (<a href="https://vc.ru/legal/2843959-kak-zaregistrirovat-logotip-sozdannyi-ii-v-rospatente" target="_blank" rel="noopener noreferrer">vc.ru</a>).</p></div>
      </details>
      <details class="pap-faq-item">
        <summary class="pap-faq-q">Насколько точен автоматический подбор МКТУ?</summary>
        <div class="pap-faq-a"><p>Предварительный подбор точен для типовых случаев; спорные классы на стыке категорий требуют проверки поверенным. USPTO Class ACT показывает: AI сокращает классификацию с месяцев до минут, но <strong>результат проверяется человеком</strong>.</p></div>
      </details>
      <details class="pap-faq-item">
        <summary class="pap-faq-q">Соответствует ли решение 152-ФЗ?</summary>
        <div class="pap-faq-a"><p>Да, при использовании российского контура (YandexGPT, GigaChat), NDA, политики хранения и опции on-prem. Персональные данные клиентов обрабатываются по регламенту бюро.</p></div>
      </details>
      <details class="pap-faq-item">
        <summary class="pap-faq-q">Что если AI ошибётся в оценке риска?</summary>
        <div class="pap-faq-a"><p>Любой вывод risk scoring — предварительный, с дисклеймером. Панель модерации позволяет поверенному approve/reject рекомендации до отправки клиенту. Ответственность — на IP-фирме, не на алгоритме.</p></div>
      </details>
      <details class="pap-faq-item">
        <summary class="pap-faq-q">Можно ли интегрировать с уже установленной CRM?</summary>
        <div class="pap-faq-a"><p>Да. <strong>Внедрение ai в бизнес процессы</strong> патентного бюро предполагает встраивание в amoCRM, Битрикс24, VERMIK, CRMPATENT, АПБ — без замены существующих систем.</p></div>
      </details>
      <details class="pap-faq-item">
        <summary class="pap-faq-q">Чем отличается от IPbot и других B2C-решений?</summary>
        <div class="pap-faq-a"><p>IPbot, POSINT, Гардиум.Про — продукты для заявителя или self-service платформы. Nero Network внедряет ассистент <strong>внутрь патентного бюро</strong>: ваш бренд, ваша воронка, ваш CRM, ваш compliance.</p></div>
      </details>
    </div>
    <div class="pap-prose nero-ai-reveal" style="margin-top:32px;max-width:820px;margin-left:auto;margin-right:auto;text-align:center">
      <p><strong>Итог:</strong> AI-ассистент патентного бюро — это мост между потоком первичных обращений и платной экспертизой. Он собирает обозначение, МКТУ и риски, формирует бриф для поверенного и передаёт квалифицированный лид в CRM. На фоне рекордных 156 тыс. заявок на товарные знаки в 2025 году и тренда USPTO на AI-классификацию внедрение <strong>ai патентный помощник под ключ</strong> — практичный шаг для IP-фирмы, которая хочет масштабировать приём без потери качества.</p>
      <p><strong>Собрать IP-ассистента</strong> — оставьте заявку на оценку проекта. Ориентир внедрения: 150–500 тыс. ₽, срок 2–6 недель.</p>
    </div>
  </div>
</section>
<!-- INTERNAL-LINKS:INSERT -->
</div>
<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function () {
  const canvas = document.getElementById('pap-hero-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let cw = 0, ch = 0, scale = 1, frame = 0;
  let cx = 0, cy = 0;

  function resizeCanvas() {
    const p = canvas.parentElement;
    if (!p) return;
    canvas.width = p.clientWidth || 400;
    canvas.height = p.clientHeight || 168;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 520, ch / 200) * 1.15;
  }
  window.addEventListener('resize', resizeCanvas);
  resizeCanvas();

  const C = {
    outline: '#94a3b8',
    dark: '#0f172a',
    panel: '#1e293b',
    panelLight: '#334155',
    accent: '#79f2ff',
    violet: '#8b5cf6',
    green: '#22c55e',
    amber: '#f59e0b',
    red: '#ef4444',
    doc: '#e2e8f0',
    docSeal: '#fbbf24',
    agentYellow: '#eab308',
    agentGreen: '#10b981',
    agentBlue: '#3b82f6',
    agentPink: '#ec4899',
    agentPurple: '#8b5cf6',
    bubbleBg: 'rgba(15,23,42,.92)',
    bubbleText: '#e2e8f0'
  };

  function rr(x, y, w, h, r, fill, stroke, lw) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else { ctx.rect(x, y, w, h); }
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1.5; ctx.stroke(); }
  }

  class DocumentChute {
    constructor(x, y, w, h) { this.x = x; this.y = y; this.w = w; this.h = h; }
    draw() {
      ctx.save();
      ctx.strokeStyle = 'rgba(121,242,255,.25)';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(this.x, this.y);
      ctx.quadraticCurveTo(this.x + this.w * .35, this.y + this.h * .15, this.x + this.w * .75, this.y + this.h * .55);
      ctx.lineTo(this.x + this.w * .9, this.y + this.h * .72);
      ctx.stroke();
      const off = (frame * 0.45) % 40;
      for (let i = 0; i < 4; i++) {
        const t = ((off + i * 10) % 40) / 40;
        const px = this.x + this.w * (.1 + t * .75);
        const py = this.y + this.h * (.05 + t * .65);
        rr(px, py, 14, 10, 2, C.doc, C.outline, 1);
      }
      ctx.restore();
    }
  }

  class RiskBriefTerminal {
    constructor(x, y) {
      this.x = x; this.y = y;
      this.phase = 0;
      this.stampY = 0;
      this.briefFly = 0;
    }
    draw() {
      this.phase = (frame * 0.06) % 180;
      rr(this.x, this.y, 210, 150, 10, C.panel, C.outline, 1.5);
      rr(this.x + 8, this.y + 8, 194, 22, 6, C.panelLight, null);
      ctx.fillStyle = C.accent;
      ctx.font = 'bold 9px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText('RISK BRIEF · ТЗ «NeroBrand»', this.x + 14, this.y + 22);

      if (this.phase > 12) {
        rr(this.x + 12, this.y + 38, 90, 28, 5, 'rgba(121,242,255,.12)', C.accent, 1);
        ctx.fillStyle = C.bubbleText;
        ctx.font = 'bold 8px Inter,sans-serif';
        ctx.fillText('Обозначение', this.x + 18, this.y + 50);
        ctx.fillStyle = C.outline;
        ctx.font = '8px Inter,sans-serif';
        ctx.fillText('словесный знак', this.x + 18, this.y + 60);
      }

      if (this.phase > 38) {
        const chips = ['35', '42'];
        chips.forEach((n, i) => {
          rr(this.x + 110 + i * 34, this.y + 40, 28, 18, 6, 'rgba(139,92,246,.18)', C.violet, 1);
          ctx.fillStyle = '#ddd6fe';
          ctx.font = 'bold 9px Inter,sans-serif';
          ctx.textAlign = 'center';
          ctx.fillText(n, this.x + 124 + i * 34, this.y + 52);
        });
      }

      if (this.phase > 72) {
        const scanX = this.x + 20 + ((frame * 2) % 150);
        ctx.save();
        ctx.globalAlpha = .35 + Math.sin(frame * .12) * .15;
        ctx.fillStyle = C.accent;
        ctx.fillRect(scanX, this.y + 72, 18, 34);
        ctx.restore();
        ctx.fillStyle = C.outline;
        ctx.font = '8px Inter,sans-serif';
        ctx.textAlign = 'left';
        ctx.fillText('ФИПС: экспресс-поиск', this.x + 18, this.y + 82);
      }

      if (this.phase > 108) {
        const risk = this.phase > 140 ? .72 : .45;
        const col = risk > .6 ? C.amber : C.green;
        rr(this.x + 12, this.y + 92, 120, 10, 5, 'rgba(255,255,255,.08)', null);
        rr(this.x + 12, this.y + 92, 120 * risk, 10, 5, col, null);
        ctx.fillStyle = col;
        ctx.font = 'bold 8px Inter,sans-serif';
        ctx.fillText(risk > .6 ? 'риск: средний' : 'риск: низкий', this.x + 140, this.y + 100);
      }

      if (this.phase > 155) {
        if (this.phase < 156) this.stampY = 0;
        this.stampY += 1.2;
        ctx.save();
        ctx.translate(this.x + 95, this.y + 118 + Math.min(this.stampY, 8));
        ctx.rotate(-.08);
        rr(-22, -10, 44, 20, 4, 'rgba(34,197,94,.15)', C.green, 1.5);
        ctx.fillStyle = C.green;
        ctx.font = 'bold 7px Inter,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('BRIEF OK', 0, 4);
        ctx.restore();

        this.briefFly += 1.5;
        const fy = this.y + 70 - this.briefFly;
        if (this.briefFly < 55) {
          rr(this.x + 175, fy, 24, 16, 3, C.doc, C.green, 1);
        }
      } else {
        this.briefFly = 0;
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
    draw() {
      this.timer += 0.04;
      const prg = (frame * 0.06) % 180;
      let isMoving = false;
      let faceDir = 1;
      const targetX = 20;
      const targetY = -18 + (this.stepTrig * 0.08);

      if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
        const local = prg - this.stepTrig;
        if (local < 11) {
          isMoving = true; faceDir = 1;
          this.x = this.baseX + (targetX - this.baseX) * (local / 11);
          this.y = this.baseY + (targetY - this.baseY) * (local / 11);
        } else if (local < 14) {
          this.x = targetX; this.y = targetY;
        } else {
          isMoving = true; faceDir = -1;
          const back = (local - 14) / 8;
          this.x = targetX - (targetX - this.baseX) * back;
          this.y = targetY - (targetY - this.baseY) * back;
        }
      } else {
        this.x = this.baseX; this.y = this.baseY;
      }

      if (!isMoving && frame % 220 === 0 && Math.random() < .12) {
        createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
      }

      const bob = isMoving ? Math.abs(Math.sin(this.timer * 4)) * 2 : Math.sin(this.timer * 1.4);
      ctx.save();
      ctx.translate(this.x, this.y);
      rr(-8, 2, 6, 10, 2, C.dark, null);
      rr(-9, 10, 10, 5, 2, C.dark, null);
      rr(2, 2, 6, 10, 2, C.dark, null);
      rr(1, 10, 10, 5, 2, C.dark, null);
      rr(-12, -10 - bob, 24, 16, 5, this.color, C.outline, 1);
      ctx.fillStyle = this.color;
      ctx.beginPath(); ctx.arc(0, -22 - bob, 9, 0, Math.PI * 2); ctx.fill();
      ctx.strokeStyle = C.outline; ctx.lineWidth = 1; ctx.stroke();
      ctx.restore();
    }
  }

  const entities = [];
  const bubbles = [];
  const chute = new DocumentChute(-200, -55, 260, 120);
  const terminal = new RiskBriefTerminal(10, -35);
  entities.push(chute, terminal);
  entities.push(new Agent(-170, 42, C.agentYellow, '1_architect', 10, ['Какое обозначение?', 'Тип: товарный знак', 'Intake начат']));
  entities.push(new Agent(-120, 58, C.agentGreen, '2_seo', 42, ['Класс 35 подходит', 'МКТУ на стыке', 'Nice: 35, 42']));
  entities.push(new Agent(-70, 36, C.agentBlue, '3_coder', 74, ['Сканирую ФИПС…', 'Сходство найдено', 'Реестр открыт']));
  entities.push(new Agent(-20, 54, C.agentPink, '4_designer', 106, ['Риск средний — флаг', 'Предварительная оценка', 'Risk Brief UI']));
  entities.push(new Agent(30, 40, C.agentPurple, '5_deployer', 138, ['Бриф в CRM', 'Поверенный уведомлён', 'Сделка создана']));

  function createBubble(x, y, text, life) {
    bubbles.push({ x, y, text, life, maxLife: life });
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort((a, b) => (a.y || 0) - (b.y || 0));
    entities.forEach(e => e.draw());

    const prg = (frame * 0.06) % 180;
    if (prg >= 8 && prg < 8.06) createBubble(-120, -20, 'Заявка ТЗ', 200);
    if (prg >= 44 && prg < 44.06) createBubble(-40, -28, 'МКТУ 35, 42', 200);
    if (prg >= 78 && prg < 78.06) createBubble(30, -32, 'ФИПС: сходство', 200);
    if (prg >= 112 && prg < 112.06) createBubble(60, -18, 'Risk Brief', 200);
    if (prg >= 156 && prg < 156.06) createBubble(120, -40, '→ CRM сделка', 200);

    ctx.font = 'bold 9px Inter,sans-serif';
    ctx.textAlign = 'center';
    for (let i = bubbles.length - 1; i >= 0; i--) {
      const b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      let alpha = Math.min(1, b.life / 24);
      if (b.life > b.maxLife - 8) alpha = (b.maxLife - b.life) / 8;
      ctx.globalAlpha = alpha;
      const tw = ctx.measureText(b.text).width + 14;
      rr(b.x - tw / 2, b.y - 16, tw, 16, 5, C.bubbleBg, C.accent, 1);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 6);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(loop);
  }

  if (document.fonts && document.fonts.ready) document.fonts.ready.then(loop);
  else loop();
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

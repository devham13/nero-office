<?php
/**
 * Template Name: AI-администратор для фитнес-клуба: внедрение под ключ
 * Description: SEO-лендинг — AI-администратор для фитнес-клуба: продления, заморозки, CRM 24/7.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-администратор для фитнес-клуба: внедрение и настройка под ключ';
$page_seo_description = 'Внедряем AI-администратора в фитнес-клуб: напоминания о продлении абонемента, заморозки, ответы 24/7 и запись на тренировку. Интеграция с CRM, кейсы, цены.';

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
    ['label' => 'Проблема', 'href' => '#pochemu-teryayut'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Увеличить продления';
$primary_cta_url   = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#vnedrenie';

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

/* Kadence reset */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,
.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

.afk-hero-fitnes{min-height:100vh;min-height:100dvh;position:relative}

.afk-content{
  --afk-bg:#050711;--afk-bg2:#080b17;--afk-text:#e6edf7;--afk-muted:#9aa8bd;--afk-soft:#c7d2e5;
  --afk-heading:#fff;--afk-border:rgba(255,255,255,.10);--afk-accent:#22c55e;--afk-cyan:#79f2ff;
  --afk-violet:#8b5cf6;--afk-orange:#f97316;--afk-btn-from:#16a34a;--afk-btn-to:#059669;
  --afk-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--afk-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.afk-content *,.afk-content *::before,.afk-content *::after{box-sizing:border-box}
.afk-content a{color:inherit;text-decoration:none}
.afk-content p{color:var(--afk-muted);line-height:1.72;margin:0 0 1em;text-align:left}
.afk-content p:last-child{margin-bottom:0}
.afk-content h2,.afk-content h3,.afk-content h4{color:var(--afk-heading);letter-spacing:-.045em;margin:0 0 .7em}
.afk-content strong{color:var(--afk-soft)}
.afk-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.afk-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--afk-muted);font-size:14.5px;line-height:1.65;text-align:left}
.afk-content ul li::before{content:'›';position:absolute;left:0;color:var(--afk-accent);font-weight:700}
.afk-cnt{width:min(var(--afk-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.afk-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.afk-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.afk-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.afk-sh.afk-left{margin-left:0;text-align:left}
.afk-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.afk-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;text-align:left}
.afk-sh.afk-left p{margin-left:0}
.afk-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--afk-accent);margin-bottom:14px}
.afk-gt{background:linear-gradient(92deg,#fff 0%,var(--afk-accent) 44%,var(--afk-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.afk-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.afk-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.afk-intro-text{position:relative;padding-left:20px;text-align:left!important}
.afk-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--afk-accent),var(--afk-violet))}
.afk-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8}
.afk-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.afk-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.afk-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--afk-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.afk-kpi-card .kl{font-size:11px;font-weight:600;color:var(--afk-muted);line-height:1.4}
.afk-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.afk-intro-grid{grid-template-columns:1fr;gap:36px}.afk-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.afk-intro-kpi{grid-template-columns:1fr 1fr}}
.afk-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.afk-toc,.ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.afk-toc a,.ym-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid var(--afk-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--afk-muted);transition:border-color .2s,color .2s,background .2s}
.afk-toc a:hover,.ym-toc a:hover{border-color:rgba(34,197,94,.42);color:var(--afk-accent);background:rgba(34,197,94,.08)}
.afk-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--afk-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22)}
.afk-stat-callout{display:inline-flex;align-items:baseline;gap:8px;padding:16px 24px;border-radius:16px;background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.25);margin:24px 0}
.afk-stat-callout strong{font-size:clamp(28px,4vw,42px);font-weight:900;color:var(--afk-accent)}
.afk-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.afk-table{width:100%;border-collapse:collapse;font-size:14px}
.afk-table th{padding:13px 16px;text-align:left;background:rgba(34,197,94,.1);color:var(--afk-accent);font-weight:700;border-bottom:1px solid rgba(34,197,94,.25);white-space:nowrap}
.afk-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--afk-text);vertical-align:top;text-align:left}
.afk-table tr:last-child td{border-bottom:none}
.afk-table tr:hover td{background:rgba(255,255,255,.03)}
.afk-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:18px;padding:26px;margin-bottom:14px}
.afk-scenario h3{font-size:17px;margin-bottom:8px}
.afk-scenario p{font-size:14.5px}
.afk-case-highlight{background:linear-gradient(135deg,rgba(34,197,94,.12),rgba(121,242,255,.08));border:1px solid rgba(34,197,94,.3);border-radius:20px;padding:28px;margin:24px 0}
.afk-case-highlight h3{font-size:20px;margin-bottom:12px}
.afk-metrics{display:flex;flex-wrap:wrap;gap:16px;margin-top:16px}
.afk-metric .num{font-size:24px;font-weight:900;color:var(--afk-accent)}
.afk-metric .lbl{font-size:13px;color:var(--afk-muted)}
.afk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.afk-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.afk-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--afk-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.afk-faq-q::after{content:'▾';font-size:13px;color:var(--afk-accent);flex-shrink:0;transition:transform .25s}
.afk-faq-item.open .afk-faq-q::after{transform:rotate(180deg)}
.afk-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--afk-muted);line-height:1.72;text-align:left}
.afk-faq-item.open .afk-faq-a{max-height:800px;padding:0 24px 20px}
.afk-checklist{list-style:none;padding:0;margin:20px 0}
.afk-checklist li{padding-left:28px;position:relative;margin-bottom:10px;color:var(--afk-muted)}
.afk-checklist li::before{content:'☐';position:absolute;left:0;color:var(--afk-accent)}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(34,197,94,.12),rgba(121,242,255,.1));border:1px solid rgba(34,197,94,.3);text-align:center}
.ym-cta-block--secondary{background:linear-gradient(135deg,rgba(139,92,246,.1),rgba(121,242,255,.08));border-color:rgba(139,92,246,.28);text-align:left}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(34,197,94,.14),rgba(139,92,246,.1));border-color:rgba(34,197,94,.35)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--afk-muted);font-size:15px;margin:0 auto 22px;max-width:640px;line-height:1.7;text-align:left}
.ym-cta-block--primary .ym-cta-block__sub,.ym-cta-block--footer-final .ym-cta-block__sub{text-align:center;margin-left:auto;margin-right:auto}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--afk-cyan)!important;text-decoration:underline}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}
.nero-ai-delay-2{transition-delay:.24s}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-fitnes-klub-page afk-page" role="main" tabindex="-1">

<section class="nero-ai-hero afk-hero-fitnes" id="hero" aria-labelledby="afk-hero-title">
<style>
/* ── Hero ai-fitnes-klub: самодостаточные стили (без CSS темы) ── */
.afk-hero-fitnes {
  --afk-green: #22c55e;
  --afk-orange: #f97316;
  --afk-cyan: #38bdf8;
  --afk-violet: #8b5cf6;
  --afk-text: #e6edf7;
  --afk-muted: #9aa8bd;
  --afk-soft: #c7d2e5;
  --afk-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.afk-hero-fitnes::before {
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
.afk-hero-fitnes::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(34, 197, 94, .12), transparent 66%);
  filter: blur(8px);
  animation: afkHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes afkHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.04); }
}
.afk-hero-fitnes .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.afk-hero-fitnes .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.afk-hero-fitnes .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 64px);
  line-height: 1.02;
  letter-spacing: -0.05em;
  color: #fff;
  font-weight: 900;
}
.afk-hero-fitnes .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--afk-green) 38%, var(--afk-orange) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.afk-hero-fitnes .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(34, 197, 94, 0.24);
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.08);
  color: #86efac !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.afk-hero-fitnes .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--afk-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.afk-hero-fitnes .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.afk-hero-fitnes .nero-ai-badge {
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
.afk-hero-fitnes .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.afk-hero-fitnes .nero-ai-btn {
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
.afk-hero-fitnes .nero-ai-btn:hover { transform: translateY(-2px); }
.afk-hero-fitnes .nero-ai-btn-primary {
  color: #052e16 !important;
  background: linear-gradient(135deg, var(--afk-green), #86efac);
  box-shadow: 0 18px 42px rgba(34, 197, 94, 0.22);
}
.afk-hero-fitnes .nero-ai-btn-secondary {
  color: var(--afk-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.afk-hero-fitnes .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--afk-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.afk-hero-fitnes .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.afk-hero-fitnes .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.afk-hero-fitnes .nero-ai-dots { display: flex; gap: 7px; }
.afk-hero-fitnes .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.afk-hero-fitnes .nero-ai-dot:nth-child(1) { background: #fb7185; }
.afk-hero-fitnes .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.afk-hero-fitnes .nero-ai-dot:nth-child(3) { background: #34d399; }
.afk-hero-fitnes .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.afk-hero-fitnes .nero-ai-window-body { padding: 16px; }
.afk-hero-fitnes .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.afk-hero-fitnes .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.afk-hero-fitnes .nero-ai-live-pill {
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
.afk-hero-fitnes .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: afkPulse 1.6s infinite;
}
@keyframes afkPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.afk-hero-fitnes .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.afk-hero-fitnes .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.afk-hero-fitnes .nero-ai-metric span {
  display: block;
  color: var(--afk-muted);
  font-size: 11px;
  font-weight: 700;
}
.afk-hero-fitnes .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 20px;
  line-height: 1;
}
.afk-hero-fitnes .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 10px;
}
.afk-hero-fitnes .afk-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(34, 197, 94, 0.18);
  background: radial-gradient(ellipse at 50% 80%, rgba(34,197,94,.08), rgba(6,10,24,.94) 70%);
}
.afk-hero-fitnes #afk-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.afk-hero-fitnes .nero-ai-task-stream { display: grid; gap: 8px; }
.afk-hero-fitnes .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.afk-hero-fitnes .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(34,197,94,.12);
  color: var(--afk-green);
  font-size: 11px;
  font-weight: 800;
}
.afk-hero-fitnes .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.afk-hero-fitnes .nero-ai-task span {
  color: var(--afk-muted);
  font-size: 11px;
}
.afk-hero-fitnes .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.afk-hero-fitnes .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.afk-hero-fitnes .nero-ai-status--blue {
  background: rgba(56,189,248,.12);
  color: #bae6fd;
}
@media (max-width: 1100px) {
  .afk-hero-fitnes .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .afk-hero-fitnes .nero-ai-dashboard { transform: none; }
  .afk-hero-fitnes .nero-ai-metrics-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 520px) {
  .afk-hero-fitnes .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .afk-hero-fitnes .nero-ai-window-body { padding: 12px; }
  .afk-hero-fitnes .nero-ai-task { grid-template-columns: 28px 1fr; }
  .afk-hero-fitnes .nero-ai-status { grid-column: 2; width: fit-content; }
  .afk-hero-fitnes .nero-ai-metrics-grid { grid-template-columns: 1fr; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · фитнес · удержание</p>
      <h1 id="afk-hero-title"><span class="nero-ai-gradient-text">AI-администратор</span> для фитнес-клуба: внедрение и настройка под ключ</h1>
      <p class="nero-ai-hero-lead">Напоминания о продлении, ответы на вопросы и запись на тренировку — возвращаем повторные продажи, которые теряет ресепшен</p>
      <ul class="nero-ai-badges" aria-label="Ключевые сценарии">
        <li class="nero-ai-badge">Продления</li>
        <li class="nero-ai-badge">Заморозки</li>
        <li class="nero-ai-badge">CRM 24/7</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#scenarii">Сценарии работы</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-администратора фитнес-клуба">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Retention-центр клуба</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Продления*</span>
              <strong>+47%</strong>
              <small>кейс DDX</small>
            </div>
            <div class="nero-ai-metric">
              <span>Контактность*</span>
              <strong>71%</strong>
              <small>кейс DDX</small>
            </div>
            <div class="nero-ai-metric">
              <span>Триггер</span>
              <strong>T-7</strong>
              <small>напоминание</small>
            </div>
          </div>

          <div class="afk-dash-canvas-wrap" aria-hidden="false">
            <canvas id="afk-hero-canvas" role="img" aria-label="Анимация: карточки абонементов едут по дорожкам к терминалу CRM, AI оформляет заморозку и продление"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий AI-администратора">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">T-3</span>
              <div><strong>Абонемент истекает через 3 дня</strong><span>Персональное сообщение → ссылка СБП</span></div>
              <span class="nero-ai-status nero-ai-status--amber">отправлено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">❄</span>
              <div><strong>Заморозка на 14 дней</strong><span>Лимит CRM проверен · оформлено в 1С:Фитнес</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">🧘</span>
              <div><strong>Запись на йогу подтверждена</strong><span>Среда 19:00 · слот в FitBase</span></div>
              <span class="nero-ai-status nero-ai-status--blue">запись</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<div class="afk-content">

<section class="afk-intro" id="intro" aria-label="Введение">
  <div class="afk-cnt">
    <div class="afk-intro-grid nero-ai-reveal">
      <div class="afk-intro-text">
        <p><strong>Коротко:</strong> AI-администратор — это связка диалогового агента, автоматизации и интеграции с CRM клуба, которая напоминает о продлении абонемента, оформляет заморозку, отвечает на типовые вопросы и записывает на тренировку 24/7. Nero Network внедряет такое решение под ключ для клубов, студий и спортшкол — с фокусом на возврат «потерянных продлений», которые ресепшен не успевает дожимать.</p>
        <p>Российский рынок фитнес-услуг в 2025 году оценивается примерно в <strong>316,5 млрд ₽</strong> (+20% к предыдущему году). Удержание и операционная эффективность становятся ключевыми задачами. <strong>AI фитнес клуб</strong> в этом контексте — не модный термин, а инструмент, который закрывает рутину ресепшена и возвращает повторную выручку.</p>
      </div>
      <div class="afk-intro-kpi" aria-label="Ключевые показатели">
        <div class="afk-kpi-card"><div class="kv">316,5</div><div class="kl">млрд ₽ рынок фитнеса 2025</div><div class="ks">CRE.ru / FitnessData</div></div>
        <div class="afk-kpi-card"><div class="kv">66,4%</div><div class="kl">удержание в индустрии (бенчмарк)</div><div class="ks">HFA Global 2025</div></div>
        <div class="afk-kpi-card"><div class="kv">T-7</div><div class="kl">триггер напоминания</div><div class="ks">воронка продления</div></div>
        <div class="afk-kpi-card"><div class="kv">24/7</div><div class="kl">ответы и запись</div><div class="ks">без очереди на ресепшен</div></div>
      </div>
    </div>
  </div>
</section>

<div class="afk-toc-outer">
  <div class="afk-cnt">
    <nav class="ym-toc afk-toc" aria-label="Оглавление статьи">
      <a href="#pochemu-teryayut">Проблема</a>
      <a href="#chto-takoe">Что такое AI</a>
      <a href="#scenarii">Сценарии</a>
      <a href="#vnedrenie">Внедрение</a>
      <a href="#integraciya">CRM</a>
      <a href="#keisy">Кейсы</a>
      <a href="#ceny">Стоимость</a>
      <a href="#faq">FAQ</a>
      <a href="#karta-uderzhaniya">Карта удержания</a>
      <a href="#cta">CTA</a>
    </nav>
  </div>
</div>

<p class="afk-cnt nero-ai-reveal" style="font-size:14.5px;color:var(--afk-muted);padding:0 0 clamp(16px,2.5vw,28px);margin:0 auto;max-width:820px;text-align:left">Фитнес-клубы часто уже ведут клиентов в CRM — если у вас amoCRM, полезно сравнить сценарии <a href="/vnedrenie-ai-amocrm/" class="ym-link ym-link--accent">внедрения AI-агента в amoCRM под ключ</a> до запуска AI-администратора на ресепшене.</p>

<section class="afk-section" id="pochemu-teryayut">
  <div class="afk-cnt">
    <div class="afk-sh afk-left nero-ai-reveal">
      <span class="afk-eyebrow">Проблема</span>
      <h2>Почему фитнес-клубы теряют продления абонементов</h2>
      <p><strong>«Потерянное продление»</strong> — ситуация, когда абонемент клиента истёк, а клуб не получил ни оплату, ни явного отказа. Клиент просто перестал ходить.</p>
    </div>
    <div class="afk-stat-callout nero-ai-reveal">
      <strong>66,4%</strong>
      <span>глобальный бенчмарк удержания в год — треть членов клубов уходит (HFA Global Report 2025)</span>
    </div>
    <div class="afk-card nero-ai-reveal">
      <h3>Сколько клиентов уходит без продления и почему администратор не успевает</h3>
      <p>На ресепшене ежедневно звучат одни и те же запросы: «до скольки работаете», «можно заморозить на две недели», «запишите на йогу в среду», «сколько стоит продление». Администратор параллельно встречает гостей, принимает оплату и отвечает в мессенджерах. <strong>AI продление абонемента</strong> через CRM-триггер «за 3 дня до окончания» часто превращается в безликое SMS — клиент не отвечает, абонемент истекает.</p>
      <ul>
        <li><strong>Нет персонального касания</strong> — шаблонное напоминание без контекста (тариф, любимое направление, история посещений)</li>
        <li><strong>Неправильный канал</strong> — SMS игнорируют, звонок в неудобное время раздражает</li>
        <li><strong>Заморозка только через ресепшен</strong> — клиент уезжает, не доезжает до клуба, абонемент сгорает</li>
        <li><strong>«Спящая» база</strong> — человек не был 2–3 недели, никто не написал первым</li>
      </ul>
      <p><strong>Удержание клиентов фитнес клуб</strong> напрямую зависит от того, успеет ли клуб поговорить с клиентом <strong>до</strong> истечения срока. Именно здесь <strong>ai клиентский сервис фитнес</strong> даёт измеримый эффект.</p>
    </div>
  </div>
</section>

<section class="afk-section afk-section-alt" id="chto-takoe">
  <div class="afk-cnt">
    <div class="afk-sh nero-ai-reveal">
      <span class="afk-eyebrow">Продукт</span>
      <h2>Что такое <span class="afk-gt">AI-администратор</span> для фитнес-клуба</h2>
      <p>Не «чат-бот с кнопками», а связка <strong>AI-агента + оркестратор сценариев + интеграция с учётной системой</strong> (1С:Фитнес, FitBase, Mobifitness, YCLIENTS и др.).</p>
    </div>
    <div class="afk-card nero-ai-reveal" style="margin-bottom:24px">
      <ul>
        <li>Напоминания о продлении за 14 / 7 / 3 дня до окончания</li>
        <li>Оформление заморозки и разморозки по правилам клуба</li>
        <li>Ответы на типовые вопросы (расписание, цены, парковка, детский клуб)</li>
        <li>Запись на групповые и персональные тренировки</li>
        <li>Реактивация «спящих» клиентов по триггеру непосещения</li>
        <li>Эскалация нестандартных кейсов живому администратору с полной историей диалога</li>
      </ul>
      <p><strong>Ключевой тезис:</strong> AI-администратор отличается от CRM-рассылки тем, что <strong>ведёт диалог</strong>, проверяет лимиты в базе и <strong>совершает действие</strong> (заморозка, запись, ссылка на оплату).</p>
    </div>
    <div class="afk-sh afk-left nero-ai-reveal" style="margin-top:40px">
      <h3>Чем AI-администратор отличается от обычного чат-бота</h3>
    </div>
    <div class="afk-table-wrap nero-ai-reveal">
      <table class="afk-table">
        <thead><tr><th>Критерий</th><th>Обычный чат-бот</th><th>AI-администратор</th></tr></thead>
        <tbody>
          <tr><td>Диалог</td><td>Кнопки и жёсткие ветки</td><td>Свободная речь + понимание намерения</td></tr>
          <tr><td>Данные клуба</td><td>Статичный FAQ</td><td>Чтение статуса абонемента, слотов, лимитов заморозки из CRM</td></tr>
          <tr><td>Действия</td><td>Ссылка «позвоните в клуб»</td><td>Оформление заморозки, запись, отправка ссылки на оплату</td></tr>
          <tr><td>Продления</td><td>Одно SMS</td><td>Воронка T-14 → T-7 → T-3 → T-0 → T+7 с персонализацией</td></tr>
          <tr><td>Эскалация</td><td>«Оператор не доступен»</td><td>Передача администратору с контекстом в CRM или Telegram-чат сотрудников</td></tr>
        </tbody>
      </table>
    </div>
    <p class="nero-ai-reveal" style="margin-top:20px;max-width:820px"><strong>Внедрение ai в бизнес</strong> в фитнес-нише — один из самых понятных кейсов: результат считается в продлениях и снижении нагрузки на фронт-деск. На enterprise-масштабе похожие принципы orchestration уже разобраны в материале <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" class="ym-link ym-link--accent">KPMG и Claude — уроки AI для бизнеса</a>.</p>
  </div>
</section>

<section id="ai-fitnes-klub-boris-block" class="afk-boris-root" aria-label="Воронка продления абонемента: AI-администратор в мессенджере и CRM">
<style>
/* === БОРИС: prefix afk-, scoped внутри #ai-fitnes-klub-boris-block === */
#ai-fitnes-klub-boris-block.afk-boris-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-fitnes-klub-boris-block .afk-boris-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-fitnes-klub-boris-block .afk-boris-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-fitnes-klub-boris-block .afk-boris-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-fitnes-klub-boris-block .afk-boris-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-fitnes-klub-boris-block .afk-boris-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-fitnes-klub-boris-block .afk-boris-ey{
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
#ai-fitnes-klub-boris-block .afk-boris-ey::before{
  content:'';
  width:18px;height:2px;
  background:#059669;
  border-radius:1px;
}
#ai-fitnes-klub-boris-block .afk-boris-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-fitnes-klub-boris-block .afk-boris-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-fitnes-klub-boris-block .afk-boris-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-fitnes-klub-boris-block .afk-boris-ic{
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
#ai-fitnes-klub-boris-block .afk-boris-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-fitnes-klub-boris-block .afk-boris-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-fitnes-klub-boris-block .afk-boris-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-fitnes-klub-boris-block .afk-boris-pl-t{
  background:rgba(20,184,166,.08);
  color:#0f766e;
  border:1.5px solid rgba(20,184,166,.22);
}
#ai-fitnes-klub-boris-block .afk-boris-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#ai-fitnes-klub-boris-block .afk-boris-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-fitnes-klub-boris-block .afk-boris-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfdf5 0%,#f0fdfa 35%,#f8fafc 70%,#fff 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-fitnes-klub-boris-block .afk-boris-rgt{min-height:380px;}
}
#afk-retention-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="afk-boris-cnt">
  <div class="afk-boris-card">

    <div class="afk-boris-lft">
      <span class="afk-boris-ey">Воронка удержания</span>
      <h3 class="afk-boris-h3">От T-14 до T+7: AI ведёт диалог, CRM фиксирует продление</h3>
      <ul class="afk-boris-ul">
        <li><span class="afk-boris-ic">T</span>Оркестратор проверяет согласие 152-ФЗ и лимиты заморозки перед каждым касанием</li>
        <li><span class="afk-boris-ic">💬</span>Персонализация: имя, тариф, любимое направление — не шаблонное SMS</li>
        <li><span class="afk-boris-ic">✓</span>Клиент отвечает «продлить» или «заморозить» — AI оформляет в CRM</li>
        <li><span class="afk-boris-ic">↗</span>Нестандартный запрос уходит администратору с полной историей диалога</li>
      </ul>
      <div class="afk-boris-pills">
        <span class="afk-boris-pl afk-boris-pl-g">T-7 напоминание</span>
        <span class="afk-boris-pl afk-boris-pl-t">Заморозка в чате</span>
        <span class="afk-boris-pl afk-boris-pl-b">Telegram · VK · CRM</span>
      </div>
      <p class="afk-boris-foot">Дальше — пять сценариев AI-администратора в деталях →</p>
    </div>

    <div class="afk-boris-rgt">
      <canvas
        id="afk-retention-pipeline-canvas"
        aria-label="Анимация: воронка продления абонемента T-14 до T+7 — сообщения в мессенджере и триггеры CRM фитнес-клуба"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('afk-retention-pipeline-canvas');
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
    green:'#10b981',
    greenD:'#059669',
    teal:'#14b8a6',
    blue:'#0ea5e9',
    orange:'#f59e0b',
    red:'#ef4444',
    white:'#ffffff',
    card:'rgba(255,255,255,.92)',
    cardBdr:'rgba(148,163,184,.35)',
    line:'rgba(5,150,105,.25)',
    glow:'rgba(16,185,129,.18)',
    phone:'#1e293b',
    phoneScr:'#f8fafc',
    bubbleOut:'#d1fae5',
    bubbleOutBdr:'#6ee7b7',
    bubbleIn:'#ffffff',
    bubbleInBdr:'#cbd5e1',
    crm:'#6366f1',
    crmLight:'rgba(99,102,241,.12)'
  };

  var STAGES = [
    {id:'T-14', label:'T-14', msg:'Привет, Анна! Через 2 недели заканчивается абонемент. Актуальные тарифы — в сообщении.', color:C.teal, delay:0},
    {id:'T-7',  label:'T-7',  msg:'Напоминаем: осталось 7 дней. Йога по средам — ваше любимое направление?', color:C.green, delay:110},
    {id:'T-3',  label:'T-3',  msg:'Оплатить продление можно по ссылке СБП — займёт 30 секунд.', color:C.greenD, delay:220},
    {id:'T-0',  label:'T-0',  msg:'Абонемент заканчивается сегодня. Продлить сейчас?', color:C.orange, delay:330},
    {id:'T+7',  label:'T+7',  msg:'Мы скучаем! Вернитесь со спецусловием — напишите «вернуться».', color:C.blue, delay:440}
  ];

  var LOOP = 620;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawTimeline(y, activeIdx, pulse){
    var pad = 24;
    var trackW = W - pad * 2 - 140;
    var startX = pad;
    var step = trackW / (STAGES.length - 1);

    ctx.strokeStyle=C.line;
    ctx.lineWidth=3;
    ctx.beginPath();
    ctx.moveTo(startX, y);
    ctx.lineTo(startX + trackW, y);
    ctx.stroke();

    for(var i=0;i<STAGES.length;i++){
      var sx = startX + i * step;
      var st = STAGES[i];
      var isActive = i === activeIdx;
      var isPast = i < activeIdx;
      var r = isActive ? 14 + Math.sin(pulse*0.08)*2 : 11;

      if(isActive){
        ctx.beginPath();
        ctx.arc(sx, y, r+10, 0, Math.PI*2);
        ctx.fillStyle=C.glow;
        ctx.fill();
      }

      ctx.beginPath();
      ctx.arc(sx, y, r, 0, Math.PI*2);
      ctx.fillStyle = isPast || isActive ? st.color : '#e2e8f0';
      ctx.fill();
      if(isPast || isActive){
        ctx.strokeStyle='#fff';
        ctx.lineWidth=2;
        ctx.stroke();
      }

      ctx.fillStyle = isActive ? C.ink : C.muted;
      ctx.font = (isActive ? 'bold ' : '') + '10px Inter,system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(st.label, sx, y + 28);
    }

    rr(pad + trackW + 16, y - 18, 108, 36, 8, C.crmLight, C.crm, 1.5);
    ctx.fillStyle = C.crm;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('CRM клуба', pad + trackW + 70, y + 4);
  }

  function drawPhone(x, y, w, h, bubbleAlpha, bubbleText, replyAlpha, replyText){
    rr(x, y, w, h, 22, C.phone, null, 0);
    rr(x+8, y+10, w-16, h-20, 16, C.phoneScr, C.cardBdr, 1);

    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('Telegram · AI-администратор', x + w/2, y + 26);

    var bx = x + 14;
    var by = y + 38;
    var bw = w - 28;

    if(bubbleAlpha > 0.01){
      ctx.globalAlpha = bubbleAlpha;
      var lines = wrapText(bubbleText, bw - 16, 10);
      var bh = 14 + lines.length * 13;
      rr(bx, by, bw, bh, 10, C.bubbleOut, C.bubbleOutBdr, 1);
      ctx.fillStyle = C.ink;
      ctx.font = '10px Inter,sans-serif';
      ctx.textAlign = 'left';
      for(var li=0;li<lines.length;li++){
        ctx.fillText(lines[li], bx + 8, by + 16 + li * 13);
      }
      ctx.globalAlpha = 1;
    }

    if(replyAlpha > 0.01){
      ctx.globalAlpha = replyAlpha;
      var rbx = x + 28;
      var rby = by + 70;
      var rbw = bw - 28;
      rr(rbx, rby, rbw, 28, 10, C.bubbleIn, C.bubbleInBdr, 1);
      ctx.fillStyle = C.ink;
      ctx.font = '10px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(replyText, rbx + 8, rby + 18);
      ctx.globalAlpha = 1;
    }

    var homeY = y + h - 14;
    ctx.fillStyle = '#94a3b8';
    ctx.beginPath();
    ctx.arc(x + w/2, homeY, 5, 0, Math.PI*2);
    ctx.fill();
  }

  function wrapText(text, maxW, fontSize){
    ctx.font = fontSize + 'px Inter,sans-serif';
    var words = text.split(' ');
    var lines = [];
    var line = '';
    for(var wi=0;wi<words.length;wi++){
      var test = line ? line + ' ' + words[wi] : words[wi];
      if(ctx.measureText(test).width > maxW && line){
        lines.push(line);
        line = words[wi];
      } else {
        line = test;
      }
    }
    if(line) lines.push(line);
    return lines.slice(0, 3);
  }

  function drawCrmEvent(x, y, label, alpha, color){
    ctx.globalAlpha = alpha;
    rr(x, y, 130, 32, 8, C.white, color, 1.5);
    ctx.fillStyle = color;
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('✓ ' + label, x + 10, y + 20);
    ctx.globalAlpha = 1;
  }

  function draw(){
    ctx.clearRect(0, 0, W, H);
    frame++;

    var t = frame % LOOP;
    var activeIdx = 0;
    for(var si=STAGES.length-1;si>=0;si--){
      if(t >= STAGES[si].delay){ activeIdx = si; break; }
    }
    var st = STAGES[activeIdx];
    var stageProg = Math.min(1, (t - st.delay) / 70);

    var timelineY = H * 0.22;
    drawTimeline(timelineY, activeIdx, frame);

    var phoneW = Math.min(200, W * 0.38);
    var phoneH = phoneW * 1.55;
    var phoneX = W * 0.08;
    var phoneY = H * 0.38;

    var replies = ['Продлить', 'Заморозить на 10 дней', 'Оплачено ✓', 'Вернуться'];
    var replyIdx = activeIdx % replies.length;
    var replyShow = stageProg > 0.55 ? (stageProg - 0.55) / 0.45 : 0;

    drawPhone(phoneX, phoneY, phoneW, phoneH, stageProg, st.msg, replyShow, replies[replyIdx]);

    var crmX = W * 0.55;
    var crmY = H * 0.42;
    var crmLabels = ['Триггер T-7', 'Персонализация', 'Ссылка СБП', 'Продление', 'Реактивация'];
    drawCrmEvent(crmX, crmY, crmLabels[activeIdx], stageProg, st.color);

    if(stageProg > 0.75 && activeIdx >= 2){
      drawCrmEvent(crmX, crmY + 44, 'Абонемент продлён', (stageProg-0.75)/0.25, C.green);
    }

    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.textAlign = 'right';
    ctx.fillText('FitBase · 1С:Фитнес · Mobifitness', W - 20, H - 14);

    requestAnimationFrame(draw);
  }

  draw();
})();
</script>
</section>


<section class="afk-section" id="scenarii">
  <div class="afk-cnt">
    <div class="afk-sh nero-ai-reveal">
      <span class="afk-eyebrow">Сценарии</span>
      <h2>Сценарии работы AI-администратора</h2>
      <p><strong>Автоматизация фитнес клуба</strong> через AI-администратора строится вокруг пяти ключевых сценариев.</p>
    </div>

    <div class="afk-scenario nero-ai-reveal" id="prodlenie">
      <h3>Напоминания о продлении абонемента</h3>
      <div class="afk-table-wrap">
        <table class="afk-table">
          <thead><tr><th>Этап</th><th>Когда</th><th>Что делает AI</th></tr></thead>
          <tbody>
            <tr><td>T-14</td><td>За 14 дней</td><td>Мягкое напоминание + актуальные тарифы продления</td></tr>
            <tr><td>T-7</td><td>За 7 дней</td><td>Персонализация: любимое направление, тренер, остаток посещений</td></tr>
            <tr><td>T-3</td><td>За 3 дня</td><td>Конкретное предложение + ссылка на оплату / СБП</td></tr>
            <tr><td>T-0</td><td>День окончания</td><td>«Абонемент заканчивается сегодня» + быстрый способ продлить</td></tr>
            <tr><td>T+7</td><td>Через 7 дней после</td><td>Реактивация: «мы скучаем», спецусловие возврата</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="afk-scenario nero-ai-reveal nero-ai-delay-1">
      <h3>Заморозка и разморозка абонемента</h3>
      <p><strong>Заморозка абонемента фитнес</strong> — один из самых частых запросов на ресепшене. AI проводит клиента по шагам: уточняет срок, проверяет лимиты в CRM, оформляет заморозку или объясняет отказ, напоминает о дате разморозки.</p>
    </div>

    <div class="afk-scenario nero-ai-reveal nero-ai-delay-2">
      <h3>Ответы на типовые вопросы клиентов 24/7</h3>
      <p>Топ-15 вопросов ресепшена: режим работы, стоимость абонементов, заморозка, запись на групповые, парковка, гостевой визит, продление, смена тарифа, возврат (эскалация). Споры, возвраты и конфликты остаются за живым администратором.</p>
    </div>

    <div class="afk-scenario nero-ai-reveal">
      <h3>Запись на тренировку и групповые занятия</h3>
      <p>AI проверяет свободные слоты в CRM, предлагает ближайшие варианты, записывает клиента и отправляет подтверждение. Сценарий особенно ценен вечером и в выходные.</p>
      <p><strong>Итог:</strong> напоминание, заморозка, FAQ, запись — покрывают до 60–70% типовых обращений на фронт-деск.</p>
    </div>
  </div>
</section>

<div class="afk-cnt">
<div class="ym-cta-block ym-cta-block--primary" id="cta-scenarii">
  <div class="ym-cta-block__icon" aria-hidden="true">🏋️</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Верните продления, которые теряет ресепшен</p>
    <p class="ym-cta-block__sub">За 2–3 дня проведём аудит CRM и retention-триггеров клуба. На выходе — <strong>Карта удержания клиентов клуба</strong> и расчёт внедрения AI-администратора в коридоре 120–350 тыс. ₽. Без обязательств.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>
</div>

<section class="afk-section afk-section-alt" id="vnedrenie">
  <div class="afk-cnt">
    <div class="afk-sh nero-ai-reveal">
      <span class="afk-eyebrow">Внедрение</span>
      <h2>Как мы внедряем AI-администратора под ключ</h2>
      <p><strong>Внедрение ai фитнес клуб</strong> — проектная модель. Срок <strong>3–4 недели</strong> от аудита до промышленного запуска.</p>
    </div>
    <div class="afk-table-wrap nero-ai-reveal">
      <table class="afk-table">
        <thead><tr><th>№</th><th>Этап</th><th>Срок</th><th>Содержание</th></tr></thead>
        <tbody>
          <tr><td>1</td><td>Аудит</td><td>2–3 дня</td><td>CRM, правила абонементов и заморозок, каналы, текущие SMS/email-триггеры</td></tr>
          <tr><td>2</td><td>Интеграция</td><td>5–10 дней</td><td>API CRM: чтение статуса абонемента, дат окончания, лимитов; запись действий</td></tr>
          <tr><td>3</td><td>База знаний</td><td>3–5 дней</td><td>FAQ, тарифы, расписание, скрипты продления → RAG</td></tr>
          <tr><td>4</td><td>AI-агент</td><td>5–7 дней</td><td>LLM + сценарии: продление, заморозка, запись, эскалация</td></tr>
          <tr><td>5</td><td>Автоматизации</td><td>3–5 дней</td><td>Триггеры T-14/7/3, непосещение N дней, «заморозка истекает»</td></tr>
          <tr><td>6</td><td>Пилот</td><td>7–14 дней</td><td>A/B с ручными напоминаниями, донастройка</td></tr>
          <tr><td>7</td><td>Запуск</td><td>1–2 дня</td><td>Обучение ресепшена: когда бот передаёт человеку</td></tr>
        </tbody>
      </table>
    </div>
    <div class="afk-card nero-ai-reveal" style="margin-top:28px">
      <h3>Сроки и что нужно от клуба (ai фитнес клуб без программиста)</h3>
      <p>Клуб <strong>не нанимает программиста</strong> — достаточно экспорта базы, правил абонементов, доступа к API CRM и согласий на рассылки (152-ФЗ). Если часть обращений приходит из почты, на этапе triage помогает <a href="/vnedrenie-ai-obrabotka-email-crm/" class="ym-link ym-link--accent">AI-обработка входящей почты в CRM</a>.</p>
      <ul class="afk-checklist">
        <li>Неделя 1: аудит + доступы CRM + правила абонементов</li>
        <li>Неделя 2: интеграция API + база знаний + черновые сценарии</li>
        <li>Неделя 3: AI-агент + автоматизации + тест на команде клуба</li>
        <li>Неделя 4: пилот 10–15% базы → корректировка → полный запуск</li>
      </ul>
    </div>
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать AI до запуска пилота?</p>
        <p class="ym-cta-block__sub">Перед внедрением AI-администратора полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с CRM. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
      </div>
    </aside>
  </div>
</section>

<section class="afk-section" id="integraciya">
  <div class="afk-cnt">
    <div class="afk-sh nero-ai-reveal">
      <span class="afk-eyebrow">Интеграция</span>
      <h2>Интеграция с CRM и учётными системами</h2>
      <p><strong>Интеграция ai фитнес клуб</strong> с учётной системой — обязательное условие: без чтения статуса абонемента AI превращается в обычный FAQ-бот.</p>
    </div>
    <div class="afk-table-wrap nero-ai-reveal">
      <table class="afk-table">
        <thead><tr><th>CRM / система</th><th>Что автоматизируется</th><th>Примечание</th></tr></thead>
        <tbody>
          <tr><td><strong>1С:Фитнес клуб</strong></td><td>Триггеры активации, заморозки, непосещения, окончания срока</td><td>Каждый четвёртый клуб в РФ на 1С:Фитнес</td></tr>
          <tr><td><strong>FitBase</strong></td><td>Абонементы, заморозки, расписание, клиент</td><td>Документированный REST API</td></tr>
          <tr><td><strong>Mobifitness</strong></td><td>Запись, статус абонемента, клиентская карточка</td><td>Популярен у студий и малых сетей</td></tr>
          <tr><td><strong>YCLIENTS</strong></td><td>Запись, продление, заморозка в боте, оплата СБП</td><td>Сильная экосистема API</td></tr>
        </tbody>
      </table>
    </div>
    <div class="afk-card nero-ai-reveal" style="margin-top:24px">
      <h3>Когда хватит триггеров 1С:Фитнес, а когда нужен AI-администратор</h3>
      <p><strong>Достаточно CRM-триггеров</strong>, если клуб шлёт только шаблонные SMS. <strong>Нужен AI</strong>, если нужен диалог, оформление заморозки в переписке, ответы на FAQ в свободной форме и единое окно Telegram/VK. Клубы на <strong>1С:Фитнес</strong> могут расширить учётный контур — см. <a href="/ai-1c-erp/" class="ym-link ym-link--accent">AI-агента для 1С и ERP</a>.</p>
    </div>
  </div>
</section>

<section class="afk-section afk-section-alt" id="keisy">
  <div class="afk-cnt">
    <div class="afk-sh nero-ai-reveal">
      <span class="afk-eyebrow">Кейсы</span>
      <h2>Результаты и кейсы внедрения</h2>
    </div>
    <div class="afk-case-highlight nero-ai-reveal">
      <h3>Кейс DDX Fitness + targetai (Россия)</h3>
      <p>Крупнейшая сеть РФ (160 клубов, 900+ тыс. клиентов). Внедрён LLM-агент для исходящих обзвонов по пролонгации подписок.</p>
      <div class="afk-metrics">
        <div class="afk-metric"><span class="num">71%</span><span class="lbl">контактность</span></div>
        <div class="afk-metric"><span class="num">47%</span><span class="lbl">конверсия в продление</span></div>
        <div class="afk-metric"><span class="num">+25%</span><span class="lbl">к производительности менеджера</span></div>
      </div>
      <p style="margin-top:16px;font-size:13px"><em>Оговорка: сетевая модель с голосовым AI — для студии 200 членов достаточно мессенджера без обзвона.</em></p>
    </div>
    <div class="afk-card nero-ai-reveal" style="margin-top:24px">
      <h3>Другие ориентиры рынка</h3>
      <ul>
        <li><strong>FitnessKit</strong> — ИИ в админке 1С:Фитнес / КлабИС, запуск «под ключ» за ~2 недели</li>
        <li><strong>Wellfit (ОАЭ) + Keepme</strong> — ML-скоринг риска оттока, dormancy с 28–30% до ~21%</li>
        <li><strong>Fitness SF (США) + AltaDX</strong> — GenAI-консьерж 24/7, &gt;4000 часов сэкономлено на фронт-деск</li>
      </ul>
      <p><strong>Ai фитнес клуб примеры внедрения</strong> для малого бизнеса — Telegram-бот + API CRM; Nero Network закрывает пробел проектной моделью под чек <strong>120–350 тыс. ₽</strong>.</p>
    </div>
  </div>
</section>

<section class="afk-section" id="ceny">
  <div class="afk-cnt">
    <div class="afk-sh nero-ai-reveal">
      <span class="afk-eyebrow">Стоимость</span>
      <h2>Стоимость внедрения AI для фитнес-клуба</h2>
      <p>Nero Network работает в коридоре <strong>120–350 тыс. ₽</strong> за <strong>ai фитнес клуб под ключ</strong>.</p>
    </div>
    <div class="afk-table-wrap nero-ai-reveal">
      <table class="afk-table">
        <thead><tr><th>Компонент</th><th>Содержание</th></tr></thead>
        <tbody>
          <tr><td>Аудит и ТЗ</td><td>CRM, правила, каналы, карта retention-триггеров</td></tr>
          <tr><td>Интеграция CRM</td><td>API / webhook, чтение и запись абонементов, заморозок, записи</td></tr>
          <tr><td>База знаний + RAG</td><td>FAQ, тарифы, скрипты продления</td></tr>
          <tr><td>AI-агент</td><td>Диалог в Telegram / VK / виджет на сайте</td></tr>
          <tr><td>Автоматизации</td><td>Воронка T-14/7/3/0/+7, непосещение, заморозка</td></tr>
          <tr><td>Пилот и A/B</td><td>10–15% базы, отчёт</td></tr>
          <tr><td>Обучение ресепшена</td><td>Эскалации, модерация первые 2–4 недели</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="afk-section afk-section-alt" id="faq">
  <div class="afk-cnt">
    <div class="afk-sh nero-ai-reveal">
      <span class="afk-eyebrow">FAQ</span>
      <h2>FAQ: ответы на частые вопросы</h2>
    </div>
    <div class="afk-faq nero-ai-reveal" id="afk-faq-accordion">
      <div class="afk-faq-item"><div class="afk-faq-q">Как внедрить AI в фитнес-клуб без программиста?</div><div class="afk-faq-a"><p>Заказать <strong>внедрение ai фитнес клуб под ключ</strong> у интегратора. Клуб предоставляет доступ к CRM, правила абонементов и FAQ — программирование на стороне подрядчика. Срок — 3–4 недели.</p></div></div>
      <div class="afk-faq-item"><div class="afk-faq-q">Сколько стоит AI-администратор для клуба?</div><div class="afk-faq-a"><p>Ориентир Nero Network: <strong>120–350 тыс. ₽</strong> за проект «под ключ». SaaS от <strong>5 тыс. ₽/мес</strong> возможны, но часто без глубокой заморозки и сквозной воронки.</p></div></div>
      <div class="afk-faq-item"><div class="afk-faq-q">Подходит ли решение для студии и малого бизнеса?</div><div class="afk-faq-a"><p>Да. Пилот на 15% базы, один канал (Telegram), интеграция с YCLIENTS / FitBase / Mobifitness.</p></div></div>
      <div class="afk-faq-item"><div class="afk-faq-q">Как AI работает с заморозками и продлениями?</div><div class="afk-faq-a"><p>AI читает лимиты в CRM, проводит клиента через диалог, оформляет заморозку или отправляет ссылку на оплату. Нестандартные перерасчёты — эскалация администратору.</p></div></div>
      <div class="afk-faq-item"><div class="afk-faq-q">Заменит ли AI живого администратора?</div><div class="afk-faq-a"><p>Нет. AI закрывает рутину 24/7; человек — споры, возвраты, дорогие допродажи, конфликты.</p></div></div>
      <div class="afk-faq-item"><div class="afk-faq-q">У нас уже есть CRM с напоминаниями — зачем AI?</div><div class="afk-faq-a"><p>CRM шлёт шаблон. AI отвечает на «а можно на 10 дней?», оформляет заморозку в переписке и реактивирует «спящих» с персонализацией.</p></div></div>
      <div class="afk-faq-item"><div class="afk-faq-q">Клиенты не любят роботов — что делать?</div><div class="afk-faq-a"><p>Один timely message в мессенджере, естественный диалог, мгновенная эскалация человеку. Кейс DDX: 47% конверсии в продление после диалога с AI.</p></div></div>
      <div class="afk-faq-item"><div class="afk-faq-q">А если AI ошибётся?</div><div class="afk-faq-a"><p>Модерация первые 2–4 недели, жёсткие лимиты действий, полное логирование. AI не выдаёт скидки вне политики клуба.</p></div></div>
      <div class="afk-faq-item"><div class="afk-faq-q">Нужно ли заказать демо перед внедрением?</div><div class="afk-faq-a"><p>Да, рекомендуем короткий созвон и демо сценария «продление + заморозка» на ваших правилах — до подписания договора.</p></div></div>
    </div>
  </div>
</section>

<section class="afk-section" id="karta-uderzhaniya">
  <div class="afk-cnt">
    <div class="afk-sh nero-ai-reveal">
      <span class="afk-eyebrow">Лид-магнит</span>
      <h2>Карта удержания клиентов клуба</h2>
      <p>Визуальная схема триггеров по дням жизненного цикла клиента и распределение ролей <strong>CRM vs AI vs человек</strong>.</p>
    </div>
    <div class="afk-table-wrap nero-ai-reveal">
      <table class="afk-table">
        <thead><tr><th>День / событие</th><th>Действие</th><th>Кто выполняет</th></tr></thead>
        <tbody>
          <tr><td>День 1 после покупки</td><td>Welcome-сообщение</td><td>AI + CRM</td></tr>
          <tr><td>День 7</td><td>Проверка первого визита</td><td>AI</td></tr>
          <tr><td>Непосещение 14 дней</td><td>«Мы скучаем»</td><td>AI</td></tr>
          <tr><td>T-14 / T-7 / T-3</td><td>Воронка продления</td><td>AI + CRM-триггер</td></tr>
          <tr><td>Запрос заморозки</td><td>Диалог + оформление в CRM</td><td>AI</td></tr>
          <tr><td>T+7 после истечения</td><td>Реактивация со спецусловием</td><td>AI</td></tr>
          <tr><td>Спор / возврат</td><td>Эскалация</td><td>Человек</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="afk-section afk-section-alt" id="cta">
  <div class="afk-cnt">
    <div class="afk-sh nero-ai-reveal">
      <h2>Увеличить продления</h2>
      <p><strong>Главная боль:</strong> клиенты забывают продлить абонемент — вы теряете повторные продажи. <strong>Главная метрика</strong> — возврат потерянных продлений и разгрузка ресепшена.</p>
    </div>
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Увеличить продления в вашем клубе</p>
        <p class="ym-cta-block__sub">Аудит CRM за 2–3 дня · внедрение под ключ за 3–4 недели · интеграция 1С:Фитнес, FitBase, Mobifitness, YCLIENTS · воронка T-14→T+7 и заморозка без очереди на ресепшене.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#karta-uderzhaniya" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Карта удержания →</a>
        </div>
      </div>
    </div>
  </div>
</section>

</div><!-- .afk-content -->

<?php
$afk_page_url = trailingslashit( get_permalink() );
$afk_site_url = trailingslashit( home_url( '/' ) );
$afk_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$afk_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $afk_site_url . '#organization',
      'name'  => $afk_brand,
      'url'   => $afk_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $afk_site_url . '#website',
      'url'       => $afk_site_url,
      'name'      => $afk_brand,
      'publisher' => [ '@id' => $afk_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $afk_page_url . '#webpage',
      'url'         => $afk_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $afk_site_url . '#website' ],
      'about'       => [ '@id' => $afk_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $afk_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $afk_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $afk_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $afk_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $afk_page_url,
      'provider'    => [ '@id' => $afk_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $afk_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить AI в фитнес-клуб без программиста?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Заказать внедрение ai фитнес клуб под ключ у интегратора. Клуб предоставляет доступ к CRM, правила абонементов и FAQ — программирование на стороне подрядчика. Срок — 3–4 недели.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит AI-администратор для клуба?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир Nero Network: 120–350 тыс. ₽ за проект «под ключ». SaaS от 5 тыс. ₽/мес возможны, но часто без глубокой заморозки и сквозной воронки.' ] ],
        [ '@type' => 'Question', 'name' => 'Подходит ли решение для студии и малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Пилот на 15% базы, один канал (Telegram), интеграция с YCLIENTS / FitBase / Mobifitness.' ] ],
        [ '@type' => 'Question', 'name' => 'Как AI работает с заморозками и продлениями?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'AI читает лимиты в CRM, проводит клиента через диалог, оформляет заморозку или отправляет ссылку на оплату. Нестандартные перерасчёты — эскалация администратору.' ] ],
        [ '@type' => 'Question', 'name' => 'Заменит ли AI живого администратора?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. AI закрывает рутину 24/7; человек — споры, возвраты, дорогие допродажи, конфликты.' ] ],
        [ '@type' => 'Question', 'name' => 'У нас уже есть CRM с напоминаниями — зачем AI?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'CRM шлёт шаблон. AI отвечает на «а можно на 10 дней?», оформляет заморозку в переписке и реактивирует «спящих» с персонализацией.' ] ],
        [ '@type' => 'Question', 'name' => 'Клиенты не любят роботов — что делать?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Один timely message в мессенджере, естественный диалог, мгновенная эскалация человеку. Кейс DDX: 47% конверсии в продление после диалога с AI.' ] ],
        [ '@type' => 'Question', 'name' => 'А если AI ошибётся?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Модерация первые 2–4 недели, жёсткие лимиты действий, полное логирование. AI не выдаёт скидки вне политики клуба.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужно ли заказать демо перед внедрением?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, рекомендуем короткий созвон и демо сценария «продление + заморозка» на ваших правилах — до подписания договора.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $afk_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

<script>
/**
 * afk-hero-engine — «Retention Deck» фитнес-клуба
 * Классы: TreadmillLane, MembershipHub, FreezeCrystal, HeartRateArc, YogaSlot
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("afk-hero-canvas");
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
    cy = ch / 2;
    scale = Math.min(cw / 520, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#cbd5e1",
    dark: "#0f172a",
    lane: "#1e293b",
    laneStripe: "#334155",
    hubBg: "#0c1220",
    hubScreen: "#111827",
    card: "#f8fafc",
    cardWarn: "#fde68a",
    cardOk: "#86efac",
    green: "#22c55e",
    orange: "#f97316",
    cyan: "#38bdf8",
    violet: "#8b5cf6",
    ice: "#bae6fd",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "rgba(15,23,42,0.92)"
  };

  function roundRect(x, y, w, h, r, fill, stroke) {
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

  /* Транспорт: беговые дорожки с карточками абонементов */
  function TreadmillLane(x, y, w) {
    this.x = x; this.y = y; this.w = w;
    this.draw = function () {
      roundRect(this.x, this.y, this.w, 28, 6, C.lane, C.outline);
      var off = (frame * 0.45) % 24;
      ctx.save();
      ctx.beginPath();
      if (ctx.roundRect) ctx.roundRect(this.x + 4, this.y + 4, this.w - 8, 20, 4);
      else ctx.rect(this.x + 4, this.y + 4, this.w - 8, 20);
      ctx.clip();
      ctx.fillStyle = C.laneStripe;
      for (var i = this.x - 20; i < this.x + this.w + 30; i += 18) {
        ctx.fillRect(i - off, this.y + 10, 8, 8);
      }
      ctx.restore();
    };
  }

  /* Центральный киоск CRM */
  function MembershipHub(x, y) {
    this.x = x; this.y = y;
    this.phase = 0;
    this.pulse = 0;
    this.draw = function () {
      this.phase = (frame * 0.04) % 220;
      roundRect(this.x - 70, this.y - 90, 140, 110, 10, C.hubBg, C.outline);
      roundRect(this.x - 58, this.y - 78, 116, 70, 6, C.hubScreen, C.cyan);

      if (this.phase < 45) {
        roundRect(this.x - 48, this.y - 68, 96, 12, 3, C.cardWarn, C.outline);
        ctx.fillStyle = C.orange;
        ctx.font = "bold 8px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("T-7 · осталось 7 дн.", this.x, this.y - 60);
      } else if (this.phase < 95) {
        roundRect(this.x - 48, this.y - 68, 96, 12, 3, C.ice, C.outline);
        ctx.fillStyle = C.cyan;
        ctx.font = "bold 8px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("Заморозка 14 дн.", this.x, this.y - 60);
      } else if (this.phase < 145) {
        ctx.fillStyle = C.cyan;
        ctx.font = "bold 8px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("Йога · ср 19:00", this.x, this.y - 62);
        roundRect(this.x - 20, this.y - 48, 40, 8, 2, C.violet, null);
      } else if (this.phase < 185) {
        ctx.fillStyle = C.green;
        ctx.font = "bold 9px Inter,sans-serif";
        ctx.fillText("СБП · продление", this.x, this.y - 62);
      } else {
        this.pulse = Math.sin(frame * 0.12) * 6;
        ctx.strokeStyle = C.green;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(this.x, this.y - 30, 22 + this.pulse, 0, Math.PI * 2);
        ctx.stroke();
        ctx.fillStyle = C.green;
        ctx.font = "bold 10px Inter,sans-serif";
        ctx.fillText("✓ продлено", this.x, this.y - 28);
      }

      roundRect(this.x - 58, this.y - 2, 116, 18, 4, "rgba(34,197,94,0.15)", C.green);
      ctx.fillStyle = "#86efac";
      ctx.font = "7px Inter,sans-serif";
      ctx.fillText("CRM · FitBase · Telegram", this.x, this.y + 8);
    };
  }

  function FreezeCrystal(x, y) {
    this.x = x; this.y = y;
    this.draw = function () {
      var prg = (frame * 0.04) % 220;
      if (prg < 50 || prg > 100) return;
      var bob = Math.sin(frame * 0.08) * 3;
      ctx.save();
      ctx.translate(this.x, this.y + bob);
      ctx.fillStyle = C.ice;
      ctx.strokeStyle = C.cyan;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.moveTo(0, -10); ctx.lineTo(8, 0); ctx.lineTo(0, 10); ctx.lineTo(-8, 0);
      ctx.closePath();
      ctx.fill();
      ctx.stroke();
      ctx.restore();
    };
  }

  function HeartRateArc(x, y) {
    this.x = x; this.y = y;
    this.draw = function () {
      var prg = (frame * 0.04) % 220;
      if (prg < 180) return;
      ctx.strokeStyle = C.green;
      ctx.lineWidth = 2;
      ctx.beginPath();
      for (var i = 0; i < 40; i++) {
        var t = i / 40;
        var px = this.x - 50 + t * 100;
        var py = this.y + Math.sin(t * Math.PI * 4 + frame * 0.15) * 8;
        if (i === 0) ctx.moveTo(px, py);
        else ctx.lineTo(px, py);
      }
      ctx.stroke();
    };
  }

  function YogaSlot(x, y) {
    this.x = x; this.y = y;
    this.draw = function () {
      var prg = (frame * 0.04) % 220;
      if (prg < 100 || prg > 150) return;
      roundRect(this.x - 18, this.y - 6, 36, 12, 3, C.violet, C.outline);
      ctx.fillStyle = "#e9d5ff";
      ctx.font = "7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("йога", this.x, this.y + 3);
    };
  }

  function ReminderOrb(x, y) {
    this.x = x; this.y = y;
    this.draw = function () {
      var prg = (frame * 0.04) % 220;
      if (prg > 60) return;
      var r = 10 + Math.sin(frame * 0.1) * 2;
      ctx.strokeStyle = C.orange;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(this.x, this.y, r, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = C.orange;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("T-7", this.x, this.y + 3);
    };
  }

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.draw = function () {
      this.timer += 0.035;
      var prg = (frame * 0.04) % 220;
      var isMoving = false;
      var faceDir = 1;
      var targetX = 0;
      var targetY = -55;

      if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
        var local = prg - this.stepTrig;
        isMoving = local < 11;
        faceDir = local < 11 ? 1 : -1;
        var t = local < 11 ? local / 11 : (local - 11) / 11;
        this.x = isMoving || local >= 11
          ? this.baseX + (targetX - this.baseX) * (local < 11 ? t : 1 - t)
          : targetX;
        this.y = isMoving || local >= 11
          ? this.baseY + (targetY - this.baseY) * (local < 11 ? t : 1 - t)
          : targetY;
      } else {
        this.x = this.baseX;
        this.y = this.baseY;
      }

      if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
      }

      var bob = Math.sin(this.timer * 1.6) * 1.5;
      ctx.save();
      ctx.translate(this.x, this.y);
      roundRect(-12, -8 - bob, 24, 16, 5, this.color, C.outline);
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(0, -18 - bob, 9, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1.5;
      ctx.stroke();
      ctx.restore();
    };
  }

  var entities = [];
  var bubbles = [];
  var lane = new TreadmillLane(-120, 55, 240);
  var hub = new MembershipHub(0, -10);
  entities.push(lane);
  entities.push(hub);
  entities.push(new ReminderOrb(-90, -30));
  entities.push(new FreezeCrystal(55, -25));
  entities.push(new YogaSlot(-55, 15));
  entities.push(new HeartRateArc(0, 35));
  entities.push(new Agent(-100, 30, C.agentYellow, "1_architect", 12, ["Сканирую абонемент", "Дата окончания — 7 дн.", "Клиент в зоне риска"]));
  entities.push(new Agent(-55, 48, C.agentGreen, "2_seo", 42, ["T-7 отправлено", "Пуш в Telegram", "Открыли 68%"]));
  entities.push(new Agent(10, 42, C.agentBlue, "3_coder", 72, ["Лимит заморозки ОК", "14 дней в CRM", "1С обновлена"]));
  entities.push(new Agent(60, 28, C.agentPink, "4_designer", 102, ["Слот йоги свободен", "Запись подтверждена", "Напомню за час"]));
  entities.push(new Agent(95, 45, C.agentPurple, "5_deployer", 152, ["Ссылка СБП ушла", "Оплата получена", "Пульс продления!"]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, maxLife: life });
  }

  function drawCards() {
    var colors = [C.card, C.cardWarn, C.cardOk];
    for (var n = 0; n < 3; n++) {
      var prog = ((frame * 0.35 + n * 70) % 200) / 200;
      var cardX = -110 + prog * 180;
      var cardY = 48 - prog * 95;
      if (cardY < -40) continue;
      roundRect(cardX - 10, cardY - 7, 20, 14, 3, colors[n], C.outline);
      ctx.fillStyle = C.dark;
      ctx.font = "6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("VIP", cardX, cardY + 2);
    }
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.forEach(function (e) { e.draw(); });
    drawCards();

    var prg = (frame * 0.04) % 220;
    if (prg >= 10 && prg < 10.05) createBubble(-95, 5, "1. Скан карточки", 200);
    if (prg >= 40 && prg < 40.05) createBubble(-50, 20, "2. Напоминание T-7", 200);
    if (prg >= 75 && prg < 75.05) createBubble(5, 15, "3. Заморозка в CRM", 200);
    if (prg >= 105 && prg < 105.05) createBubble(55, 5, "4. Запись на йогу", 200);
    if (prg >= 155 && prg < 155.05) createBubble(90, 18, "5. СБП · продление", 200);
    if (prg >= 190 && prg < 190.05) createBubble(0, -50, "Пульс удержания ✓", 240);

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      roundRect(b.x - tw / 2, b.y - 18, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.fillText(b.text, b.x, b.y - 7);
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
  document.querySelectorAll('.afk-faq-q').forEach(function(q){
    q.addEventListener('click',function(){
      var item=q.parentElement;
      var open=item.classList.contains('open');
      document.querySelectorAll('.afk-faq-item.open').forEach(function(el){el.classList.remove('open');});
      if(!open) item.classList.add('open');
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

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

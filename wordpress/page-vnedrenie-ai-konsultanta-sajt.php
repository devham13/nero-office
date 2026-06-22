<?php
/**
 * Template Name: AI-консультант на сайте: подбор услуги и внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-консультанта для подбора услуги на сайте. Квиз, CRM, кейсы, цены.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-консультант на сайте: подбор услуги и внедрение под ключ';
$page_seo_description = 'Внедрим AI-консультанта на сайт: 3–7 вопросов, подбор услуги, тарифа или специалиста. Интеграция с CRM, кейсы, цены. Прототип квиза — бесплатно.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать консультанта';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = 'Как это работает';
$secondary_cta_url   = '#kak-rabotaet';

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
/* Kadence hide */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
.vnks-hero-konsultant.nero-ai-hero{min-height:100vh;min-height:100dvh;position:relative}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--soft{background:linear-gradient(135deg,rgba(34,197,94,.08),rgba(121,242,255,.08));border-color:rgba(34,197,94,.25)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vnks-muted,#9aa8bd);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn:hover{transform:translateY(-2px)}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:#e6edf7!important;border:1.5px solid rgba(255,255,255,.18)}
.ym-cta-block__btn{margin-top:4px}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}.nero-ai-delay-3{transition-delay:.36s}
.vnks-intro-text p{text-align:left!important}

/* ── VNKS Hero: самодостаточные стили (без CSS темы) ── */
.vnks-hero-konsultant {
  --vnks-cyan: #79f2ff;
  --vnks-violet: #8b5cf6;
  --vnks-green: #22c55e;
  --vnks-amber: #fbbf24;
  --vnks-text: #e6edf7;
  --vnks-muted: #9aa8bd;
  --vnks-soft: #c7d2e5;
  --vnks-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnks-hero-konsultant.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnks-hero-konsultant::before {
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
.vnks-hero-konsultant::after {
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
  animation: vnksHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnksHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vnks-hero-konsultant .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnks-hero-konsultant .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnks-hero-konsultant .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnks-hero-konsultant .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnks-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnks-hero-konsultant .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnks-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnks-hero-konsultant .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnks-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnks-hero-konsultant .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnks-hero-konsultant .nero-ai-badge {
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
.vnks-hero-konsultant .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnks-hero-konsultant .nero-ai-btn {
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
.vnks-hero-konsultant .nero-ai-btn:hover { transform: translateY(-2px); }
.vnks-hero-konsultant .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnks-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnks-hero-konsultant .nero-ai-btn-secondary {
  color: var(--vnks-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnks-hero-konsultant .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnks-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnks-hero-konsultant .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnks-hero-konsultant .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnks-hero-konsultant .nero-ai-dots { display: flex; gap: 7px; }
.vnks-hero-konsultant .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnks-hero-konsultant .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnks-hero-konsultant .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnks-hero-konsultant .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnks-hero-konsultant .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnks-hero-konsultant .nero-ai-window-body { padding: 16px; }
.vnks-hero-konsultant .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 14px;
}
.vnks-hero-konsultant .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnks-hero-konsultant .nero-ai-live-pill {
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
.vnks-hero-konsultant .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnksPulse 1.6s infinite;
}
@keyframes vnksPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnks-hero-konsultant .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnks-hero-konsultant .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease;
}
.vnks-hero-konsultant .nero-ai-metric:hover {
  transform: translateY(-2px);
  border-color: rgba(121,242,255,.34);
}
.vnks-hero-konsultant .nero-ai-metric span {
  display: block;
  color: var(--vnks-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnks-hero-konsultant .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnks-hero-konsultant .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 10px;
}
.vnks-hero-konsultant .vnks-dash-canvas-wrap {
  position: relative;
  height: 200px;
  margin: 0 0 12px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.08);
  background: radial-gradient(circle at 50% 40%, rgba(121,242,255,.08), rgba(2,6,23,.6));
}
.vnks-hero-konsultant #vnks-quiz-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnks-hero-konsultant .nero-ai-task-stream { display: grid; gap: 8px; }
.vnks-hero-konsultant .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  animation: vnksTaskFloat 5s ease-in-out infinite;
}
.vnks-hero-konsultant .nero-ai-task:nth-child(2) { animation-delay: .6s; }
.vnks-hero-konsultant .nero-ai-task:nth-child(3) { animation-delay: 1.2s; }
@keyframes vnksTaskFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-3px); }
}
.vnks-hero-konsultant .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 10px;
  background: rgba(121,242,255,.12);
  color: var(--vnks-cyan);
  font-size: 11px;
  font-weight: 900;
}
.vnks-hero-konsultant .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnks-hero-konsultant .nero-ai-task span {
  color: var(--vnks-muted);
  font-size: 11px;
}
.vnks-hero-konsultant .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnks-hero-konsultant .nero-ai-status--progress {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
.vnks-hero-konsultant .nero-ai-status--new {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
.vnks-hero-konsultant .nero-ai-reveal {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity .55s ease, transform .55s ease;
}
.vnks-hero-konsultant .nero-ai-reveal.nero-ai-active {
  opacity: 1;
  transform: none;
}
.vnks-hero-konsultant .nero-ai-delay-2 { transition-delay: .16s; }
@media (max-width: 1100px) {
  .vnks-hero-konsultant .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnks-hero-konsultant .nero-ai-dashboard { transform: none; }
}
@media (max-width: 820px) {
  .vnks-hero-konsultant .nero-ai-container { width: min(100% - 28px, 1220px); }
  .vnks-hero-konsultant.nero-ai-hero { min-height: auto; padding-top: 56px; }
  .vnks-hero-konsultant .nero-ai-metrics-grid { grid-template-columns: 1fr 1fr; }
  .vnks-hero-konsultant .nero-ai-btn { width: 100%; }
  .vnks-hero-konsultant .nero-ai-btn-row { align-items: stretch; }
}
@media (max-width: 520px) {
  .vnks-hero-konsultant .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnks-hero-konsultant .vnks-dash-canvas-wrap { height: 170px; }
  .vnks-hero-konsultant .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnks-hero-konsultant .nero-ai-status { grid-column: 2; width: fit-content; }
}
@media (prefers-reduced-motion: reduce) {
  .vnks-hero-konsultant *, .vnks-hero-konsultant *::before, .vnks-hero-konsultant *::after {
    animation: none !important;
    transition: none !important;
  }
  .vnks-hero-konsultant .nero-ai-reveal { opacity: 1; transform: none; }
}

/* === VNKS CONTENT ROOT (scoped) === */
.vnks-content{
  --vnks-bg:#050711;--vnks-bg2:#080b17;
  --vnks-surface:rgba(255,255,255,.072);--vnks-text:#e6edf7;--vnks-muted:#9aa8bd;
  --vnks-soft:#c7d2e5;--vnks-heading:#fff;--vnks-border:rgba(255,255,255,.10);
  --vnks-accent:#79f2ff;--vnks-violet:#8b5cf6;--vnks-green:#22c55e;
  --vnks-btn-from:#2563eb;--vnks-btn-to:#7c3aed;--vnks-r:18px;--vnks-r-lg:24px;
  --vnks-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnks-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vnks-content *,.vnks-content *::before,.vnks-content *::after{box-sizing:border-box;}
.vnks-content p{color:var(--vnks-muted);line-height:1.72;margin:0 0 1em;}
.vnks-content h2,.vnks-content h3,.vnks-content h4{color:var(--vnks-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.vnks-content strong{color:var(--vnks-soft);}
.vnks-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vnks-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vnks-muted);font-size:14.5px;line-height:1.65;}
.vnks-content ul li::before{content:'›';position:absolute;left:0;color:var(--vnks-accent);font-weight:700;}
.vnks-cnt{width:min(var(--vnks-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.vnks-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vnks-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.vnks-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vnks-sh.vnks-left{margin-left:0;text-align:left;}
.vnks-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vnks-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vnks-sh.vnks-left p{margin-left:0;}
.vnks-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnks-accent);margin-bottom:14px;}
.vnks-gt{background:linear-gradient(92deg,#fff 0%,var(--vnks-accent) 44%,var(--vnks-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.vnks-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.vnks-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.vnks-intro-text{position:relative;padding-left:20px;}
.vnks-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vnks-accent),var(--vnks-violet));}
.vnks-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.vnks-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.vnks-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vnks-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.vnks-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnks-muted);line-height:1.4;}
.vnks-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.vnks-intro-grid{grid-template-columns:1fr;gap:36px;}.vnks-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.vnks-intro-kpi{grid-template-columns:1fr 1fr;}}
.vnks-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vnks-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.vnks-toc a{display:inline-block;padding:9px 18px;background:var(--vnks-surface);border:1px solid var(--vnks-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vnks-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none;}
.vnks-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vnks-accent);background:rgba(121,242,255,.08);}
.vnks-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vnks-border);border-radius:var(--vnks-r-lg);padding:26px;backdrop-filter:blur(16px);}
.vnks-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vnks-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.vnks-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;}
@media(max-width:960px){.vnks-grid-3,.vnks-grid-4{grid-template-columns:1fr 1fr;}}
@media(max-width:768px){.vnks-grid-2,.vnks-grid-3,.vnks-grid-4{grid-template-columns:1fr;}}
.vnks-table-wrap,.vnks-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vnks-table,.vnks-compare{width:100%;border-collapse:collapse;font-size:14px;}
.vnks-table th,.vnks-compare th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vnks-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);}
.vnks-compare th.vnks-col-featured{background:rgba(139,92,246,.22);color:#c4b5fd;}
.vnks-table td,.vnks-compare td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vnks-text);vertical-align:top;}
.vnks-table tr:last-child td,.vnks-compare tr:last-child td{border-bottom:none;}
.vnks-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--vnks-r);padding:26px;display:flex;gap:18px;align-items:flex-start;margin-bottom:14px;}
.vnks-sc-icon{flex-shrink:0;width:44px;height:44px;border-radius:12px;background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);display:flex;align-items:center;justify-content:center;font-size:20px;}
.vnks-timeline{position:relative;padding-left:40px;}
.vnks-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vnks-accent),var(--vnks-violet));opacity:.35;}
.vnks-tl-item{position:relative;margin-bottom:32px;}
.vnks-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vnks-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.vnks-step-num{display:inline-flex;width:32px;height:32px;border-radius:50%;background:rgba(121,242,255,.15);border:1px solid rgba(121,242,255,.35);align-items:center;justify-content:center;font-size:13px;font-weight:800;color:var(--vnks-accent);margin-bottom:10px;}
.vnks-range-bar{margin:28px 0;padding:24px;border-radius:var(--vnks-r-lg);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);text-align:center;}
.vnks-range-bar .vnks-range-track{height:8px;border-radius:99px;background:linear-gradient(90deg,rgba(121,242,255,.2),var(--vnks-accent) 45%,var(--vnks-violet) 75%,rgba(139,92,246,.2));margin:16px 0;}
.vnks-range-bar .vnks-range-label{font-size:clamp(22px,3vw,34px);font-weight:900;color:#fff;}
.vnks-metric-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:24px;}
.vnks-metric-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:16px;padding:20px;}
.vnks-metric-card .num{font-size:22px;font-weight:900;color:var(--vnks-accent);}
.vnks-metric-card .src{font-size:11px;color:#64748b;margin-top:8px;}
@media(max-width:768px){.vnks-metric-cards{grid-template-columns:1fr;}}
.vnks-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vnks-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.vnks-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnks-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.vnks-faq-q::after{content:'▾';font-size:13px;color:var(--vnks-accent);transition:transform .25s;}
.vnks-faq-item.open .vnks-faq-q::after{transform:rotate(180deg);}
.vnks-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;}
.vnks-faq-item.open .vnks-faq-a{max-height:800px;padding:0 24px 20px;}
.vnks-cta-list{list-style:none;padding:0;margin:0 0 24px;text-align:left;max-width:480px;margin-left:auto;margin-right:auto;}
.vnks-cta-list li{padding-left:24px;position:relative;margin-bottom:8px;color:var(--vnks-soft);}
.vnks-cta-list li::before{content:'✓';position:absolute;left:0;color:var(--vnks-green);font-weight:700;}
.vnks-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.vnks-content .ym-cta-block--soft{background:linear-gradient(135deg,rgba(34,197,94,.08),rgba(121,242,255,.08));border-color:rgba(34,197,94,.25);}
.vnks-content .ym-cta-block--dual .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.vnks-content a.ym-link--accent{color:var(--vnks-accent);text-decoration:underline;}
.bqk-root{padding:60px 0 72px;background:#f0f4fb;}
.bqk-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
.bqk-card{display:grid;grid-template-columns:42% 58%;border-radius:24px;overflow:hidden;box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(99,102,241,.15);min-height:480px;}
@media(max-width:960px){.bqk-card{grid-template-columns:1fr;min-height:auto;}}
.bqk-lft{background:#fff;padding:44px 36px;display:flex;flex-direction:column;justify-content:center;}
.bqk-ey{font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;color:#6366f1;margin:0 0 14px;display:flex;align-items:center;gap:8px;}
.bqk-ey::before{content:'';width:18px;height:2px;background:#6366f1;border-radius:1px;}
.bqk-h3{font-size:24px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 20px;}
.bqk-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:10px;}
.bqk-ul li{display:flex;gap:10px;font-size:14px;color:#334155;line-height:1.5;}
.bqk-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(99,102,241,.1);color:#6366f1;font-size:11px;display:flex;align-items:center;justify-content:center;font-style:normal;}
.bqk-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;}
.bqk-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;}
.bqk-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
.bqk-pl-b{background:rgba(99,102,241,.08);color:#4338ca;border:1.5px solid rgba(99,102,241,.22);}
.bqk-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
.bqk-rgt{background:linear-gradient(145deg,#07091a,#0d1224 55%,#090d1f);position:relative;min-height:400px;}
#vnks-quiz-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-konsultanta-sajt-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnks-hero-konsultant" id="hero" aria-labelledby="vnks-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai консультант на сайт</p>
      <h1 id="vnks-hero-title">AI-консультант для подбора услуги на сайте: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI задаёт 3–7 вопросов и подбирает услугу, тариф или специалиста — посетитель не уходит без понятного следующего шага</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Подбор услуги</li>
        <li class="nero-ai-badge">3–7 вопросов</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">Конверсия</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Собрать консультанта'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-консультант на сайте">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">AI-консультант · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Квиз-подбор услуги</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid" aria-label="Демо-метрики">
            <div class="nero-ai-metric">
              <span>Посетителей</span>
              <strong>847</strong>
              <small>в каталоге</small>
            </div>
            <div class="nero-ai-metric">
              <span>Прошли квиз</span>
              <strong>42%</strong>
              <small>completion</small>
            </div>
            <div class="nero-ai-metric">
              <span>Конверсия</span>
              <strong>×3,2</strong>
              <small>vs каталог</small>
            </div>
            <div class="nero-ai-metric">
              <span>До рекомендации</span>
              <strong>15 сек</strong>
              <small>среднее</small>
            </div>
          </div>

          <div class="vnks-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnks-quiz-hero-canvas" role="img" aria-label="Анимация: посетитель проходит квиз, AI подбирает услугу и передаёт заявку в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий квиза">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">Q</span>
              <div><strong>Вопрос 2 из 5</strong><span>ситуация клиента</span></div>
              <span class="nero-ai-status nero-ai-status--progress">в процессе</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Подбор услуги</strong><span>«Тариф Бизнес»</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Заявка</strong><span>задача менеджеру</span></div>
              <span class="nero-ai-status nero-ai-status--new">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====================================================
     КОНТЕНТНАЯ ЧАСТЬ — Борис (не hero)
     Обёртка: .vnks-content внутри main.site-main
     ==================================================== -->
<div class="vnks-content">

<!-- INTRO -->
  <section class="vnks-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vnks-cnt nero-ai-container">
      <div class="vnks-intro-grid nero-ai-reveal">
        <div class="vnks-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai консультант на сайт</p>
          <p><strong>Коротко:</strong> AI-консультант на сайте — виджет, который за 3–7 вопросов подбирает услугу, тариф или специалиста и доводит посетителя до заявки в CRM. Nero Network внедряет таких агентов под ключ: от аудита каталога до интеграции с amoCRM и Bitrix24.</p>
          <p>Посетитель заходит на сайт с десятком услуг, листает прайс, открывает три вкладки — и уходит. На сайтах услуг средняя конверсия часто держится в коридоре <strong>1–3%</strong>: из тысячи визитов заявку оставляют 10–30 человек. Для B2B типичны 2–5%, для медицины — 3–7%.</p>
          <p>По прогнозу Gartner, к концу 2026 года до <strong>40% enterprise-приложений</strong> получат task-specific AI-агентов — узких помощников с конкретной задачей, а не «ещё один чат с FAQ». Подбор услуги на сайте — как раз такой агент.</p>
          <!-- INTERNAL-LINKS:INSERT -->
        </div>
        <div class="vnks-intro-kpi" aria-label="Ключевые показатели">
          <div class="vnks-kpi-card"><div class="kv">1–3%</div><div class="kl">средняя CR сайтов услуг</div><div class="ks">отраслевые бенчмарки</div></div>
          <div class="vnks-kpi-card"><div class="kv">40%</div><div class="kl">приложений с AI-агентами к 2026</div><div class="ks">Gartner, 2025</div></div>
          <div class="vnks-kpi-card"><div class="kv">40,1%</div><div class="kl">конверсия квиза старт → лид</div><div class="ks">Interact, 80+ млн лидов</div></div>
          <div class="vnks-kpi-card"><div class="kv">120–300К</div><div class="kl">ориентир чека внедрения</div><div class="ks">Nero Network</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA-1 -->
  <div class="vnks-cnt">
    <div class="ym-cta-block ym-cta-block--primary vnks-cta vnks-cta--intro" id="cta-intro">
      <div class="ym-cta-block__icon" aria-hidden="true">💬</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Соберём AI-консультанта под ваш каталог услуг</p>
        <p class="ym-cta-block__sub">Прототип AI-квиза для вашей услуги — <strong>бесплатно за 48 часов</strong>. 3–7 вопросов, персональная рекомендация, заявка в CRM.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <!-- TOC -->
  <div class="vnks-toc-outer">
    <div class="vnks-cnt">
      <nav class="vnks-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что такое</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#keisy">Кейсы</a>
        <a href="#etapy">Этапы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta-final">CTA</a>
      </nav>
    </div>
  </div>

  <!-- #chto-takoe -->
  <section class="vnks-section" id="chto-takoe">
    <div class="vnks-cnt">
      <div class="vnks-sh">
        <span class="vnks-eyebrow">Определение</span>
        <h2>Что такое AI-консультант на сайте<br>и зачем он бизнесу</h2>
        <p>Интеллектуальный виджет, который ведёт посетителя по короткому сценарию и рекомендует конкретную услугу, тариф или специалиста — с фокусом на навигации по каталогу, а не на FAQ.</p>
      </div>

      <div class="vnks-card nero-ai-reveal" id="otlichie-ot-chata">
        <h3 style="font-size:20px;margin-bottom:16px;">Чем отличается от обычного чат-бота и статичного квиза</h3>
        <div class="vnks-table-wrap">
          <table class="vnks-table" aria-label="Сравнение FAQ-бота, квиза и AI-консультанта">
            <thead><tr><th>Критерий</th><th>FAQ-чат-бот</th><th>Статичный квиз</th><th>AI-консультант</th></tr></thead>
            <tbody>
              <tr><td>Главная задача</td><td>Ответить на вопросы</td><td>Провести по веткам</td><td>Подобрать услугу из каталога</td></tr>
              <tr><td>Свободные вопросы</td><td>Да, без привязки к каталогу</td><td>Нет</td><td>Да, через RAG</td></tr>
              <tr><td>Логика подбора</td><td>Нет</td><td>Жёсткая матрица</td><td>Decision tree + LLM</td></tr>
              <tr><td>Передача в CRM</td><td>Базовая</td><td>Ответы квиза</td><td>Услуга + бюджет + бриф</td></tr>
              <tr><td>Каталог 15+ услуг</td><td>Теряется</td><td>Ручная матрица</td><td>Масштабируется через RAG</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="vnks-card nero-ai-reveal nero-ai-delay-1" id="paradoks-vybora" style="margin-top:24px;">
        <h3 style="font-size:19px;margin-bottom:10px;">Какую боль закрывает: посетитель теряется в каталоге услуг</h3>
        <p>Это <strong>парадокс выбора</strong>: чем шире линейка, тем ниже конверсия. Универсальная форма «расскажите о задаче» в 70% случаев приводит к разговору не о той услуге. AI-консультант задаёт правильные вопросы <strong>до</strong> звонка и не отпускает посетителя без понятного следующего шага.</p>
      </div>
    </div>
  </section>

  <!-- #kak-rabotaet -->
  <section class="vnks-section vnks-section-alt" id="kak-rabotaet">
    <div class="vnks-cnt">
      <div class="vnks-sh">
        <span class="vnks-eyebrow">Воронка</span>
        <h2>Как работает квиз-консультант:<br>3–7 вопросов → подбор услуги</h2>
        <p>Посетитель проходит короткий сценарий за 30–60 секунд, получает рекомендацию и оставляет контакт уже понимая, зачем ему звонят.</p>
      </div>
      <div class="vnks-card nero-ai-reveal">
        <div class="vnks-timeline">
          <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><h3>1. Триггер</h3><p>Попап «Не знаете, с чего начать? 3 вопроса — подберём услугу» или встроенный блок на странице каталога.</p></div>
          <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><h3>2. Структурированные вопросы</h3><p>Ситуация → объект/ниша → бюджет или срок → предпочтения. Прогресс-бар «шаг 2 из 5» снижает отказы.</p></div>
          <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><h3>3. Свободные уточнения</h3><p>«Чем отличается тариф А от Б?» — ответ через RAG по страницам сайта и прайсу.</p></div>
          <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><h3>4. Результат</h3><p>Одна главная рекомендация + альтернатива + ориентир цены/срока.</p></div>
          <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><h3>5. Контакт после ценности</h3><p>Телефон и имя — только когда посетитель видит персональный результат.</p></div>
          <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><h3>6. CRM</h3><p>Сделка с полями «услуга», «бюджет», «срочность», «ответы квиза», UTM-метки.</p></div>
        </div>
      </div>
      <div class="vnks-grid-2" style="margin-top:28px;">
        <div class="vnks-card nero-ai-reveal" id="podbor-rezhimy">
          <h3 style="font-size:18px;">Подбор тарифа, услуги или специалиста</h3>
          <p>Один движок работает в трёх режимах: <strong>услуга</strong> (процедура, тип дела, пакет), <strong>тариф</strong> (Старт / Бизнес / Корпоративный), <strong>специалист</strong> (врач, эксперт, бригада). Ветвление — по боли клиента, а не по названиям в прайсе.</p>
        </div>
        <div class="vnks-card nero-ai-reveal nero-ai-delay-1" id="sleduyushchiy-shag">
          <h3 style="font-size:18px;">Следующий шаг: заявка, звонок, запись</h3>
          <p>Рекомендация без действия — мёртвый лид. AI-консультант завершает сценарий CTA: перезвон за 15 минут, запись на приём, расчёт, КП. Горячие лиды — задача менеджеру в CRM в течение минут.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ====================================================
       БОРИС: визуальный блок (не hero)
       ==================================================== -->
  <section id="vnks-boris-block" class="bqk-root" aria-label="Анимация пути посетителя через AI-квиз к заявке в CRM">
<div class="bqk-cnt"><div class="bqk-card">
  <div class="bqk-lft">
    <span class="bqk-ey">Путь посетителя</span>
    <h3 class="bqk-h3">От «не знаю, что выбрать» до заявки в CRM за 60 секунд</h3>
    <ul class="bqk-ul">
      <li><span class="bqk-ic">1</span>Посетитель отвечает на 3–7 вопросов по ситуации, а не по названиям услуг</li>
      <li><span class="bqk-ic">AI</span>Нейросеть сопоставляет ответы с каталогом через RAG — без выдуманных цен</li>
      <li><span class="bqk-ic">✓</span>На выходе — одна рекомендация + альтернатива и понятный CTA</li>
      <li><span class="bqk-ic">CRM</span>Контакт и бриф уходят в amoCRM / Bitrix24 до звонка менеджера</li>
    </ul>
    <div class="bqk-pills">
      <span class="bqk-pl bqk-pl-g">42% completion</span>
      <span class="bqk-pl bqk-pl-b">×3,2 vs каталог</span>
      <span class="bqk-pl bqk-pl-g">15 сек до результата</span>
    </div>
    <p class="bqk-foot">Дальше — кому подойдёт AI-консультант по отраслям ↓</p>
  </div>
  <div class="bqk-rgt">
    <canvas id="vnks-quiz-canvas" aria-label="Анимация: посетитель проходит квиз из 5 шагов к рекомендации услуги и заявке в CRM" role="img"></canvas>
  </div>
</div></div>
<script>
(function(){
  var cv=document.getElementById('vnks-quiz-canvas');if(!cv)return;
  var cx=cv.getContext('2d'),W=0,H=0,fr=0;
  function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;W=cv.width;H=cv.height;}
  window.addEventListener('resize',resize);resize();
  var C={acc:'#79f2ff',viol:'#a78bfa',grn:'#4ade80',txt:'#e2e8f0',mut:'rgba(226,232,240,.45)',card:'rgba(255,255,255,.07)',bdr:'rgba(255,255,255,.14)'};
  var nodes=[
    {x:.12,y:.55,label:'Посетитель',icon:'👤'},
    {x:.28,y:.35,label:'Q1',icon:'?'},
    {x:.44,y:.55,label:'Q2',icon:'?'},
    {x:.58,y:.35,label:'Q3',icon:'?'},
    {x:.74,y:.55,label:'Тариф Бизнес',icon:'★'},
    {x:.90,y:.35,label:'CRM',icon:'✓'}
  ];
  var LOOP=480,prog=0;
  function rr(x,y,w,h,r,f,s){cx.beginPath();if(cx.roundRect)cx.roundRect(x,y,w,h,r);else cx.rect(x,y,w,h);if(f){cx.fillStyle=f;cx.fill();}if(s){cx.strokeStyle=s;cx.lineWidth=1.5;cx.stroke();}}
  function draw(){
    fr++;prog=(fr%LOOP)/LOOP;
    cx.clearRect(0,0,W,H);
    cx.fillStyle=C.mut;cx.font='11px Inter,sans-serif';cx.textAlign='left';
    cx.fillText('AI-квиз · шаг '+Math.min(5,Math.floor(prog*6)+1)+' из 5',14,22);
    var barW=W-28;rr(14,H-28,barW,6,3,'rgba(255,255,255,.08)',null);
    rr(14,H-28,barW*prog,6,3,C.acc,null);
    for(var i=0;i<nodes.length-1;i++){
      var a=nodes[i],b=nodes[i+1];
      cx.strokeStyle='rgba(121,242,255,.25)';cx.lineWidth=2;cx.setLineDash([6,4]);
      cx.beginPath();cx.moveTo(a.x*W,a.y*H);cx.lineTo(b.x*W,b.y*H);cx.stroke();cx.setLineDash([]);
    }
    nodes.forEach(function(n,i){
      var x=n.x*W,y=n.y*H,active=prog*nodes.length>=i;
      var glow=active?0.22:0.08;
      cx.beginPath();cx.arc(x,y,28+Math.sin(fr*.05+i)*2,0,Math.PI*2);
      cx.fillStyle=i===nodes.length-1?C.grn+'33':C.viol+'33';cx.fill();
      rr(x-36,y-22,72,44,12,C.card,C.bdr);
      cx.fillStyle=active?C.txt:C.mut;cx.font='bold 11px Inter,sans-serif';cx.textAlign='center';
      cx.fillText(n.label,x,y+4);
      if(i===nodes.length-1&&prog>.85){cx.fillStyle=C.grn;cx.font='9px Inter,sans-serif';cx.fillText('заявка',x,y+16);}
    });
    var t=prog*(nodes.length-1),idx=Math.floor(t),local=t-idx;
    if(idx<nodes.length-1){
      var p1=nodes[idx],p2=nodes[idx+1];
      var px=(p1.x+(p2.x-p1.x)*local)*W,py=(p1.y+(p2.y-p1.y)*local)*H;
      cx.beginPath();cx.arc(px,py,7,0,Math.PI*2);cx.fillStyle=C.acc;cx.fill();
      cx.beginPath();cx.arc(px,py,12+Math.sin(fr*.12)*3,0,Math.PI*2);
      cx.strokeStyle='rgba(121,242,255,.35)';cx.lineWidth=2;cx.stroke();
    }
    requestAnimationFrame(draw);
  }
  draw();
})();
</script>
  </section>

  <!-- #komu-nuzhno -->
  <section class="vnks-section" id="komu-nuzhno">
    <div class="vnks-cnt">
      <div class="vnks-sh">
        <span class="vnks-eyebrow">Аудитория</span>
        <h2>Кому нужен AI-консультант на сайте</h2>
        <p>Решение окупается там, где каталог шире трёх позиций, а менеджер не успевает квалифицировать каждого посетителя.</p>
      </div>
      <div class="vnks-grid-4">
        <div class="vnks-card nero-ai-reveal" id="komu-meditsina">
          <div class="vnks-eyebrow">Медицина</div>
          <h3>Клиники и медцентры</h3>
          <p>Пациент не знает, к какому врачу записаться. AI-ассистент даёт ответ за секунды; записи могут вырасти в 1,6 раза при 72% обращений без администраторов (кейс V-AI Labs).</p>
        </div>
        <div class="vnks-card nero-ai-reveal nero-ai-delay-1" id="komu-yuristy">
          <div class="vnks-eyebrow">Юристы</div>
          <h3>Юристы и консалтинг</h3>
          <p>Тип дела, срочность, бюджет — четыре вопроса отсекают нецелевые обращения. Менеджер получает в CRM готовый бриф, а не «хочу проконсультироваться».</p>
        </div>
        <div class="vnks-card nero-ai-reveal nero-ai-delay-2" id="komu-obrazovanie">
          <div class="vnks-eyebrow">Образование</div>
          <h3>Онлайн-школы</h3>
          <p>Подбор курса, формата и уровня подготовки. Снижается доля возвратов после покупки «не того» тарифа.</p>
        </div>
        <div class="vnks-card nero-ai-reveal nero-ai-delay-3" id="komu-b2b">
          <div class="vnks-eyebrow">B2B</div>
          <h3>Сервисные компании</h3>
          <p>Каталоги по 10–30 услуг. AI-консультант квалифицирует лида до формы — по той же логике, что ИИ-оператор Jivo (92% чатов без человека), но с фокусом на подбор услуги.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA-2 -->
  <div class="vnks-cnt">
    <div class="ym-cta-block ym-cta-block--soft vnks-cta vnks-cta--audience" id="cta-audience">
      <div class="ym-cta-block__icon" aria-hidden="true">🎯</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Не уверены, подойдёт ли AI-консультант вашему бизнесу?</p>
        <p class="ym-cta-block__sub">Пришлите ссылку на каталог — за 48 часов соберём прототип квиза и покажем, как посетитель дойдёт до заявки.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Получить прототип квиза</a>
      </div>
    </div>
  </div>

  <!-- #scenarii -->
  <section class="vnks-section vnks-section-alt" id="scenarii">
    <div class="vnks-cnt">
      <div class="vnks-sh">
        <span class="vnks-eyebrow">Сценарии</span>
        <h2>Что AI-консультант делает вместо менеджера</h2>
        <p>AI-агент берёт на себя навигацию, первичную квалификацию и подбор пакета — менеджер подключается к готовому брифу.</p>
      </div>
      <div class="vnks-scenario nero-ai-reveal" id="scenarii-navigaciya">
        <div class="vnks-sc-icon" aria-hidden="true">🗂️</div>
        <div><h3>Навигация по каталогу из 10+ услуг</h3><p>Вместо 15 карточек — один вход: «Что у вас за ситуация?». Система сопоставляет ответы с каталогом через RAG и правила исключений.</p></div>
      </div>
      <div class="vnks-scenario nero-ai-reveal nero-ai-delay-1" id="scenarii-kvalifikaciya">
        <div class="vnks-sc-icon" aria-hidden="true">🌡️</div>
        <div><h3>Квалификация лида до формы</h3><p>До контакта собираются бюджет, срочность, география, тип задачи. Менеджер видит «температуру» лида в CRM.</p></div>
      </div>
      <div class="vnks-scenario nero-ai-reveal nero-ai-delay-2" id="scenarii-paket">
        <div class="vnks-sc-icon" aria-hidden="true">📦</div>
        <div><h3>Рекомендация пакета / тарифа</h3><p>После 4–5 вопросов посетитель видит: «Вам подходит тариф „Бизнес"». Участники product quiz конвертируются в 4% против 0,5% у остальных (+3,5 п.п., Okendo).</p></div>
      </div>
    </div>
  </section>

  <!-- #sravnenie -->
  <section class="vnks-section" id="sravnenie">
    <div class="vnks-cnt">
      <div class="vnks-sh">
        <span class="vnks-eyebrow">Сравнение</span>
        <h2>AI-консультант vs готовый виджет vs кастом</h2>
        <p>Честно разделяем, когда достаточно SaaS, а когда нужен кастом под каталог и CRM.</p>
      </div>
      <div class="vnks-compare-wrap nero-ai-reveal">
        <table class="vnks-compare" aria-label="Marquiz vs Jivo vs кастомный AI-консультант">
          <thead>
            <tr><th>Параметр</th><th>Marquiz / квиз</th><th>Jivo + SaluteBot</th><th class="vnks-col-featured">Кастом (Nero Network)</th></tr>
          </thead>
          <tbody>
            <tr><td>Срок запуска</td><td>1–3 дня</td><td>3–14 дней</td><td>1–3 недели</td></tr>
            <tr><td>Свободный диалог</td><td>Нет</td><td>Да</td><td>Да + структура 3–7 вопросов</td></tr>
            <tr><td>Каталог 20+ услуг</td><td>Ручная матрица</td><td>Ограниченно</td><td>RAG + decision tree</td></tr>
            <tr><td>Интеграция CRM</td><td>Базовая</td><td>amoCRM, Bitrix24</td><td>Поля, теги, воронка</td></tr>
            <tr><td>Цена</td><td>от ~700 ₽/мес</td><td>от 9 900 ₽ пилот</td><td>120–300 тыс. ₽ под ключ</td></tr>
            <tr><td>Когда выбрать</td><td>До 8 услуг</td><td>FAQ + чат</td><td>Каталог, квалификация, CRM</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- #crm -->
  <section class="vnks-section vnks-section-alt" id="crm">
    <div class="vnks-cnt">
      <div class="vnks-sh">
        <span class="vnks-eyebrow">CRM</span>
        <h2>Интеграция с CRM: заявка не теряется</h2>
        <p>Лид без контекста в воронке = потерянный маркетинговый бюджет.</p>
      </div>
      <div class="vnks-grid-2">
        <div class="vnks-card nero-ai-reveal" id="crm-polya">
          <h3 style="font-size:18px;">Передача ответов квиза и контактов в CRM</h3>
          <ul>
            <li>Имя, телефон, email</li>
            <li>Рекомендованная услуга / тариф / специалист</li>
            <li>Ответы на все вопросы квиза (текстом или JSON)</li>
            <li>Бюджет, срочность, география, UTM</li>
            <li>Текст итоговой рекомендации</li>
          </ul>
        </div>
        <div class="vnks-card nero-ai-reveal nero-ai-delay-1" id="crm-voronka">
          <h3 style="font-size:18px;">Теги, воронка, задача менеджеру</h3>
          <ul>
            <li>Теги: «горячий», «нужен расчёт», «B2B-корпоративный»</li>
            <li>Лид попадает на нужную стадию воронки</li>
            <li>Задача: «перезвонить в 15 минут, контекст: арбитраж, бюджет 5–15 млн»</li>
            <li>Make/n8n для уведомлений в Telegram</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- #etapy -->
  <section class="vnks-section" id="etapy">
    <div class="vnks-cnt">
      <div class="vnks-sh">
        <span class="vnks-eyebrow">Внедрение</span>
        <h2>Этапы внедрения AI-консультанта под ключ</h2>
        <p>1–3 недели от аудита до пилота. Семь этапов.</p>
      </div>
      <div class="vnks-timeline nero-ai-reveal">
        <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><span class="vnks-step-num">1</span><h3>Аудит каталога услуг и воронки</h3><p>1–2 дня. Карта услуг, тарифов, FAQ, «мёртвые» страницы с низкой конверсией.</p></div>
        <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><span class="vnks-step-num">2</span><h3>Прототип вопросов и логики подбора</h3><p>2–3 дня. Дерево 3–7 вопросов + ветвления. <strong>Лид-магнит:</strong> прототип AI-квиза для вашей услуги.</p></div>
        <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><span class="vnks-step-num">3</span><h3>База знаний + RAG</h3><p>3–5 дней. Индексация страниц услуг и прайса. Ответ только из каталога.</p></div>
        <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><span class="vnks-step-num">4</span><h3>Виджет и встройка на сайт</h3><p>3–5 дней. WordPress, Tilda, Bitrix. Мобильная вёрстка, fallback на оператора.</p></div>
        <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><span class="vnks-step-num">5</span><h3>Интеграция CRM и аналитики</h3><p>2–4 дня. Webhook в amoCRM/Bitrix24. Цели Метрики / GA4.</p></div>
        <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><span class="vnks-step-num">6</span><h3>Тест и запуск</h3><p>Пилот 2–4 недели. A/B «каталог vs AI-консультант».</p></div>
        <div class="vnks-tl-item"><div class="vnks-tl-dot"></div><span class="vnks-step-num">7</span><h3>Донастройка по метрикам</h3><p>Доработка формулировок вопросов. Контроль качества ответов раз в 1–2 недели.</p></div>
      </div>
    </div>
  </section>

  <!-- CTA-3 -->
  <div class="vnks-cnt">
    <div class="ym-cta-block ym-cta-block--primary vnks-cta vnks-cta--etapy" id="cta-etapy">
      <div class="ym-cta-block__icon" aria-hidden="true">⚙️</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">AI-консультант на сайт — внедрение под ключ от 120 тыс. ₽</p>
        <p class="ym-cta-block__sub">Закажите аудит каталога и получите схему вопросов. Если команда хочет разобраться в логике квиз-агентов до старта — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Заказать аудит каталога</a>
      </div>
    </div>
  </div>

  <!-- #keisy -->
  <section class="vnks-section vnks-section-alt" id="keisy">
    <div class="vnks-cnt">
      <div class="vnks-sh">
        <span class="vnks-eyebrow">Кейсы</span>
        <h2>Кейсы и метрики конверсии до/после</h2>
        <p>Цифры из публичных источников — не обещаем такой же результат каждому, но показываем, что интерактивный подбор бьёт статичный каталог.</p>
      </div>
      <div class="vnks-table-wrap nero-ai-reveal">
        <table class="vnks-table" aria-label="Российские кейсы квизов и AI-консультантов">
          <thead><tr><th>Кейс</th><th>Что сделали</th><th>Метрика</th></tr></thead>
          <tbody>
            <tr><td>ООО «Ориентир»</td><td>Квиз 3 вопроса, 16 услуг</td><td>Квиз убирает развилку до звонка</td></tr>
            <tr><td>Агентство «Лайка» / Marquiz</td><td>Квиз для услуг</td><td>CR <strong>с 0,18% до 5%</strong> за 6 недель</td></tr>
            <tr><td>«Крепёж Восток» / Jivo</td><td>ИИ-оператор B2B</td><td><strong>92%</strong> чатов без человека</td></tr>
            <tr><td>Клиника / V-AI Labs</td><td>AI-ассистент + CRM</td><td>Записи <strong>×1,6</strong>, 72% без админов</td></tr>
            <tr><td>Lectric eBikes / Okendo</td><td>Product quiz</td><td>4% CR vs 0,5% у остальных</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vnks-metric-cards nero-ai-reveal" style="margin-top:24px;">
        <div class="vnks-metric-card"><div class="num">+388%</div><p>conversion lift (Digioh / Whisker, 30 дней)</p><div class="src">источник: Digioh</div></div>
        <div class="vnks-metric-card"><div class="num">65%</div><p>completion rate квизов (Interact)</p><div class="src">80+ млн лидов</div></div>
        <div class="vnks-metric-card"><div class="num">2,9→7%</div><p>CR CrazyBulk после квиза</p><div class="src">Digioh case</div></div>
      </div>
    </div>
  </section>

  <!-- #ceny -->
  <section class="vnks-section" id="ceny">
    <div class="vnks-cnt">
      <div class="vnks-sh">
        <span class="vnks-eyebrow">Инвестиции</span>
        <h2>Стоимость внедрения AI-консультанта</h2>
      </div>
      <div class="vnks-range-bar nero-ai-reveal">
        <p style="font-size:14px;color:var(--vnks-muted);margin-bottom:8px;">Между SaaS-подпиской и корпоративным RAG</p>
        <div class="vnks-range-label">120 — 300 тыс. ₽</div>
        <div class="vnks-range-track" aria-hidden="true"></div>
        <p style="font-size:13px;color:#64748b;">~700 ₽/мес квиз-платформы ← → 500 000+ ₽ корпоративный RAG</p>
      </div>
      <div class="vnks-grid-2" style="margin-top:28px;">
        <div class="vnks-card nero-ai-reveal" id="ceny-sostav">
          <h3 style="font-size:18px;">Что входит в чек 120–300 тыс. ₽</h3>
          <ul>
            <li>Аудит каталога и дерево подбора</li>
            <li>База знаний + RAG</li>
            <li>Виджет AI-квиза на сайт</li>
            <li>Интеграция amoCRM или Bitrix24</li>
            <li>Аналитика Метрика / GA4</li>
            <li>Пилот 2–4 недели с донастройкой</li>
          </ul>
        </div>
        <div class="vnks-card nero-ai-reveal nero-ai-delay-1" id="ceny-faktory">
          <h3 style="font-size:18px;">От чего зависит цена</h3>
          <div class="vnks-table-wrap" style="border:none;">
            <table class="vnks-table">
              <tbody>
                <tr><td>Размер каталога (5 vs 30+ услуг)</td><td>Сложность RAG и дерева</td></tr>
                <tr><td>CRM-поля и автоматизации</td><td>+Make/n8n, мессенджеры</td></tr>
                <tr><td>On-premise / 152-ФЗ</td><td>Доп. инфраструктура</td></tr>
                <tr><td>Кастомный дизайн виджета</td><td>UI сверх стандарта</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- #faq -->
  <section class="vnks-section vnks-section-alt" id="faq">
    <div class="vnks-cnt">
      <div class="vnks-sh">
        <span class="vnks-eyebrow">FAQ</span>
        <h2>Частые вопросы об AI-консультанте на сайте</h2>
      </div>
      <div class="vnks-faq nero-ai-reveal vnks-faq" id="vnks-faq-accordion">
        <div class="vnks-faq-item open" id="faq-kak-vnedrit">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="true">Как внедрить AI-консультант на сайт?</div>
          <div class="vnks-faq-a"><p>Аудит каталога → прототип 3–7 вопросов → RAG → виджет → CRM → пилот с A/B. Срок 1–3 недели. Прототип квиза — за 48 часов до договора.</p></div>
        </div>
        <div class="vnks-faq-item" id="faq-skolko-stoit">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит AI-консультант на сайт?</div>
          <div class="vnks-faq-a"><p>Ориентир <strong>120–300 тыс. ₽</strong> под ключ: виджет, логика, CRM, аналитика, пилот. Точная смета — после аудита.</p></div>
        </div>
        <div class="vnks-faq-item" id="faq-bez-programmista">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли без программиста?</div>
          <div class="vnks-faq-a"><p>Для владельца бизнеса — да, внедряем под ключ. SaaS вроде Atolko — быстрый старт, но сложный каталог потребует кастомной настройки.</p></div>
        </div>
        <div class="vnks-faq-item" id="faq-malyj-biznes">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="false">Для малого бизнеса — не слишком дорого?</div>
          <div class="vnks-faq-a"><p>При каталоге от 5 услуг и платном трафике потерянные заявки стоят дороже пилота. Marquiz-кейсы показывают рост CR в разы.</p></div>
        </div>
        <div class="vnks-faq-item" id="faq-skolko-voprosov">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько вопросов нужно в квизе?</div>
          <div class="vnks-faq-a"><p>Оптимум <strong>3–7</strong>. Меньше трёх — мало данных. Больше семи — падает completion rate.</p></div>
        </div>
        <div class="vnks-faq-item" id="faq-crm-chto">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="false">Что передаётся в CRM?</div>
          <div class="vnks-faq-a"><p>Услуга/тариф, ответы квиза, бюджет, срочность, контакты, UTM, текст рекомендации.</p></div>
        </div>
        <div class="vnks-faq-item" id="faq-gallyucinacii">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="false">AI наврёт про цены?</div>
          <div class="vnks-faq-a"><p>При правильной настройке — нет. RAG только по утверждённому каталогу. На нестандартные запросы — fallback «уточнит менеджер».</p></div>
        </div>
        <div class="vnks-faq-item" id="faq-jivo">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от чат-бота Jivo?</div>
          <div class="vnks-faq-a"><p>Jivo — саппорт и омниканальность. AI-консультант ведёт к конкретной рекомендации из каталога. Можно совмещать.</p></div>
        </div>
        <div class="vnks-faq-item" id="faq-marquiz">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="false">Достаточно ли Marquiz?</div>
          <div class="vnks-faq-a"><p>Для простого каталога до 8 услуг — часто да. Marquiz не отвечает на произвольные вопросы. AI-консультант = квиз + NLU + CRM.</p></div>
        </div>
        <div class="vnks-faq-item" id="faq-izmerit">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="false">Как измерить результат?</div>
          <div class="vnks-faq-a"><p>Старт квиза, завершение (%), CR в заявку, CPL, конверсия в сделку. A/B: каталог vs AI-консультант.</p></div>
        </div>
        <div class="vnks-faq-item" id="faq-152fz">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="false">Соблюдается ли 152-ФЗ?</div>
          <div class="vnks-faq-a"><p>По политике клиента. Возможны on-premise и российские LLM (YandexGPT, GigaChat). Согласие — в форме заявки.</p></div>
        </div>
        <div class="vnks-faq-item" id="faq-menedzher">
          <div class="vnks-faq-q" tabindex="0" role="button" aria-expanded="false">Когда нужен живой менеджер?</div>
          <div class="vnks-faq-a"><p>Нестандартные сделки, индивидуальные КП, юридически значимые консультации, сложная смета. AI передаёт контекст — не заменяет эксперта.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- #cta-final -->
  <section class="vnks-section vnks-cta-final" id="cta-final" aria-labelledby="cta-final-title">
    <div class="vnks-cnt nero-ai-container">
      <div class="ym-cta-block ym-cta-block--dual ym-cta-block--footer-final vnks-cta vnks-cta--final">
        <div class="ym-cta-block__body">
          <h2 id="cta-final-title">Собрать AI-консультанта для вашего сайта</h2>
          <p class="ym-cta-block__sub">Посетитель не должен уходить, потому что не понял, какую услугу выбрать. Внедрим квиз-консультанта с интеграцией amoCRM / Bitrix24 и измеримой воронкой.</p>
          <ul class="vnks-cta-list">
            <li>Прототип AI-квиза — бесплатно за 48 часов</li>
            <li>Внедрение под ключ от 120 тыс. ₽</li>
            <li>Пилот с A/B-тестом и донастройкой</li>
          </ul>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#kak-rabotaet" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как это работает</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.vnks-content -->


<!-- INTERNAL-LINKS:INSERT -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * vnks-quiz-hero-engine — Лаборатория квиз-подбора
 * Мир: ветвящиеся намерения → ServiceMatchHub → рекомендация → CRM
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnks-quiz-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 200;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 400, ch / 200) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    hubBase: "#1e293b",
    hubAccent: "#79f2ff",
    hubViolet: "#8b5cf6",
    branch: "rgba(121,242,255,0.28)",
    branchGlow: "rgba(139,92,246,0.4)",
    mazeWall: "rgba(148,163,184,0.35)",
    cardBg: "#a7f3d0",
    cardAlt: "#c4b5fd",
    crmGreen: "#22c55e",
    lostDot: "#fb7185",
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

  /* Y-ветвления намерений — не конвейер */
  function IntentBranchFlow() {
    this.phase = 0;
  }
  IntentBranchFlow.prototype.draw = function (ctx) {
    this.phase = (frame * 0.03) % (Math.PI * 2);
    var branches = [
      { sx: -120, sy: 40, ex: 0, ey: -35, curve: -0.4 },
      { sx: -100, sy: 55, ex: 0, ey: -35, curve: 0 },
      { sx: -80, sy: 70, ex: 0, ey: -35, curve: 0.35 }
    ];
    branches.forEach(function (b, i) {
      ctx.strokeStyle = i === 1 ? C.branchGlow : C.branch;
      ctx.lineWidth = i === 1 ? 2 : 1;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.moveTo(b.sx, b.sy);
      var cpx = (b.sx + b.ex) / 2;
      var cpy = (b.sy + b.ey) / 2 + b.curve * 60;
      ctx.quadraticCurveTo(cpx, cpy, b.ex, b.ey);
      ctx.stroke();
    });
    ctx.setLineDash([]);

    for (var j = 0; j < 4; j++) {
      var br = branches[j % 3];
      var t = (this.phase + j * 1.6) % (Math.PI * 2);
      var prog = (Math.sin(t) + 1) / 2;
      var px = br.sx + (br.ex - br.sx) * prog;
      var py = br.sy + (br.ey - br.sy) * prog + Math.sin(prog * Math.PI) * br.curve * 40;
      ctx.fillStyle = j === 0 ? C.hubAccent : "rgba(255,255,255,0.7)";
      ctx.beginPath();
      ctx.arc(px, py, 4, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  /* Лабиринт каталога — посетитель теряется */
  function CatalogConfusionMaze() {
    this.wanderX = -130;
  }
  CatalogConfusionMaze.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    var walls = [[-155,-50,-155,-10],[-155,-10,-115,-10],[-115,-10,-115,30],[-155,30,-95,30]];
    ctx.strokeStyle = C.mazeWall;
    ctx.lineWidth = 2;
    walls.forEach(function (w) {
      ctx.beginPath();
      ctx.moveTo(w[0], w[1]);
      ctx.lineTo(w[2], w[3]);
      ctx.stroke();
    });
    ctx.fillStyle = "rgba(251,113,133,0.2)";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("15 услуг", -125, -58);

    if (prg < 65) {
      this.wanderX = -140 + Math.sin(frame * 0.06) * 18;
      var wy = -20 + Math.cos(frame * 0.08) * 12;
      drawVisitorDot(ctx, this.wanderX, wy, C.lostDot, "?");
    }
  };

  function drawVisitorDot(ctx, x, y, color, label) {
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.arc(x, y, 6, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1;
    ctx.stroke();
    if (label) {
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, x, y + 3);
    }
  }

  /* Центральный хаб подбора — вместо WebsiteTerminal */
  function ServiceMatchHub() {
    this.step = 0;
    this.lockCard = false;
  }
  ServiceMatchHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    drawRR(ctx, -48, -58, 96, 116, 12, C.hubBase, C.outline);

    /* Кольцо шагов квиза */
    for (var s = 0; s < 5; s++) {
      var ang = -Math.PI / 2 + s * (Math.PI * 2 / 5);
      var sx = Math.cos(ang) * 38;
      var sy = -10 + Math.sin(ang) * 28;
      var active = prg >= 65 && prg < 155 && s <= Math.floor((prg - 65) / 18);
      drawRR(ctx, sx - 8, sy - 8, 16, 16, 4, active ? C.hubAccent : "rgba(255,255,255,0.12)", C.outline);
      ctx.fillStyle = active ? "#0f172a" : "#94a3b8";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(String(s + 1), sx, sy + 3);
    }

    /* Экран виджета */
    drawRR(ctx, -32, -42, 64, 48, 6, "rgba(15,23,42,0.9)", C.hubAccent);
    if (prg < 65) {
      ctx.fillStyle = "#94a3b8";
      ctx.font = "7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Каталог…", 0, -18);
    } else if (prg < 155) {
      var qNum = Math.min(5, Math.floor((prg - 65) / 18) + 1);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("Вопрос " + qNum + "/5", 0, -26);
      ctx.fillStyle = "#a5f3fc";
      ctx.font = "7px Inter,sans-serif";
      ctx.fillText("Ситуация клиента", 0, -14);
    } else if (prg < 210) {
      ctx.fillStyle = C.cardBg;
      drawRR(ctx, -24, -30, 48, 28, 4, C.cardBg, C.crmGreen);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Тариф Бизнес", 0, -16);
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("рекомендация AI", 0, -6);
    } else {
      drawRR(ctx, -24, -30, 48, 28, 4, "rgba(34,197,94,0.3)", C.crmGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Заявка ✓", 0, -16);
    }

    /* Фаза HANDOFF — импульс в CRM */
    if (prg >= 210) {
      var pulse = (prg - 210) / 50;
      ctx.strokeStyle = "rgba(34,197,94," + (0.9 - pulse * 0.8) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, 10, 12 + pulse * 35, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = C.crmGreen;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("→ CRM", 0, 52);
    }
  };

  /* Дуга прогресса квиза */
  function QuizProgressArc() {
    this.val = 0;
  }
  QuizProgressArc.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    if (prg < 65) this.val = 0.08;
    else if (prg < 155) this.val = 0.15 + ((prg - 65) / 90) * 0.7;
    else if (prg < 210) this.val = 0.92;
    else this.val = 1;

    ctx.strokeStyle = "rgba(255,255,255,0.1)";
    ctx.lineWidth = 4;
    ctx.beginPath();
    ctx.arc(95, -45, 28, Math.PI * 0.75, Math.PI * 2.25);
    ctx.stroke();
    ctx.strokeStyle = C.hubViolet;
    ctx.beginPath();
    ctx.arc(95, -45, 28, Math.PI * 0.75, Math.PI * 0.75 + Math.PI * 1.5 * this.val);
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(this.val * 100) + "%", 95, -42);
  };

  /* Карусель карточек услуг */
  function ServiceCardCarousel() {
    this.idx = 0;
  }
  ServiceCardCarousel.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    if (prg < 120 || prg > 220) return;
    var cards = ["Старт", "Бизнес", "Про"];
    var sel = Math.floor((prg - 120) / 30) % 3;
    cards.forEach(function (name, i) {
      var ox = 108 + i * 22 - sel * 8;
      var oy = 25 + (i === sel ? -4 : 0);
      drawRR(ctx, ox, oy, 36, 22, 4, i === sel ? C.cardBg : C.cardAlt, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(name, ox + 18, oy + 14);
    });
  };

  function Agent(x, y, color, role, targetStep, dialogs) {
    this.x = x; this.y = y; this.color = color; this.role = role;
    this.targetStep = targetStep; this.dialogs = dialogs;
    this.timer = Math.random() * 100;
    this.hitAnimation = 0;
    this.homeX = x; this.homeY = y;
  }
  Agent.prototype.update = function (prg) {
    var targets = {
      0: { x: -125, y: 45 },
      1: { x: -55, y: -55 },
      2: { x: 55, y: -50 },
      3: { x: 70, y: 35 },
      4: { x: -20, y: 55 }
    };
    var phase = prg < 65 ? 0 : prg < 120 ? 1 : prg < 170 ? 2 : prg < 210 ? 3 : 4;
    var t = targets[phase] || targets[0];
    this.x += (t.x - this.x) * 0.04;
    this.y += (t.y - this.y) * 0.04;
    this.timer += 0.02;
  };
  Agent.prototype.draw = function (ctx) {
    var isMoving = Math.abs(this.x - this.homeX) > 2;
    if (frame % 180 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }
    var bob = Math.sin(this.timer * 2) * (isMoving ? 1 : 2);
    ctx.save();
    ctx.translate(this.x, this.y + bob);
    drawRR(ctx, -12, -10, 24, 18, 5, this.color, C.outline);
    ctx.fillStyle = "#fff";
    ctx.beginPath();
    ctx.arc(0, -16, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new IntentBranchFlow());
  entities.push(new CatalogConfusionMaze());
  entities.push(new ServiceMatchHub());
  entities.push(new QuizProgressArc());
  entities.push(new ServiceCardCarousel());
  entities.push(new Agent(-145, 50, C.agentYellow, "1_architect", 0, ["Карта услуг готова", "Ветка по боли", "16 позиций → 3 вопроса"]));
  entities.push(new Agent(-60, -60, C.agentGreen, "2_seo", 1, ["Шаг 2: ситуация", "Completion 42%", "Не больше 7 вопросов"]));
  entities.push(new Agent(60, -55, C.agentBlue, "3_coder", 2, ["RAG по прайсу", "Тариф Бизнес", "Без галлюцинаций"]));
  entities.push(new Agent(75, 40, C.agentPink, "4_designer", 3, ["Виджет на каталог", "Результат до формы", "Мобильный квиз"]));
  entities.push(new Agent(-15, 60, C.agentPurple, "5_deployer", 4, ["Сделка в amoCRM", "Задача за 15 мин", "UTM + ответы квиза"]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
  }

  function engineLoop() {
    frame++;
    var prg = (frame * 0.035) % 260;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.forEach(function (ent) {
      if (ent instanceof Agent) ent.update(prg);
      ent.draw(ctx);
    });

    if (prg >= 68 && prg < 72) createBubble(-55, -70, "Квиз запущен", 200);
    if (prg >= 130 && prg < 134) createBubble(0, -75, "Сопоставляю каталог", 200);
    if (prg >= 175 && prg < 179) createBubble(0, -5, "Тариф Бизнес — лучший матч", 220);
    if (prg >= 215 && prg < 219) createBubble(0, 45, "Лид в CRM · задача менеджеру", 240);

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 18 - (b.maxLife - b.life) * 0.04, tw, 16, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 10 - (b.maxLife - b.life) * 0.04);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineLoop);
  }

  document.fonts.ready.then(function () { engineLoop(); });

  /* Reveal hero copy */
  var reveals = document.querySelectorAll(".vnks-hero-konsultant .nero-ai-reveal");
  if (reveals.length && "IntersectionObserver" in window) {
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add("nero-ai-active"); obs.unobserve(e.target); }
      });
    }, { threshold: 0.12 });
    reveals.forEach(function (el) { obs.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add("nero-ai-active"); });
  }
});
</script>


<script>
(function(){
  document.querySelectorAll('.vnks-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.vnks-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.vnks-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.vnks-faq-q');if(q)q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){item.classList.add('open');btn.setAttribute('aria-expanded','true');}
    });
    btn.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}});
  });
})();
</script>


<script>
(function(){
  'use strict';
  var root = document.querySelector('.vnks-content');
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

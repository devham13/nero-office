<?php
/**
 * Template Name: AI-квалификация лидов: внедрение и настройка под ключ
 * Description: SEO-лендинг — AI-квалификация и скоринг лидов, интеграция с CRM, кейсы, цены.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-квалификация лидов под ключ — внедрение и скоринг в CRM';
$page_seo_description = 'Внедрим AI-квалификацию лидов: статус горячий, тёплый, холодный или нецелевой до передачи менеджеру. Интеграция с CRM, настройка под B2B. Получите карту квалификации.';

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
    ['label' => 'Зачем', 'href' => '#statusy-lidov'],
    ['label' => 'Матрица', 'href' => '#matrica-statusov'],
    ['label' => 'Скоринг', 'href' => '#skoring'],
    ['label' => 'Внедрение', 'href' => '#etapy-vnedreniya'],
    ['label' => 'CRM', 'href' => '#crm'],
    ['label' => 'Кейсы', 'href' => '#keis'],
    ['label' => 'Цена', 'href' => '#cena'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Написать в Telegram';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#etapy-vnedreniya';

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

.akl-hero-leads {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.akl-toc {
  max-width: 720px;
  margin: 36px auto 0;
  text-align: center;
}
.akl-toc-title {
  margin: 0 0 14px;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: #79f2ff;
}
.akl-toc-list {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
  list-style: none;
  margin: 0;
  padding: 0;
}
.akl-toc-list a {
  display: inline-flex;
  padding: 8px 14px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.12);
  background: rgba(255,255,255,.05);
  color: #c7d2e5 !important;
  font-size: 13px;
  font-weight: 600;
  text-decoration: none !important;
  transition: border-color .2s ease, background .2s ease;
}
.akl-toc-list a:hover {
  border-color: rgba(121,242,255,.35);
  background: rgba(121,242,255,.08);
  color: #fff !important;
}
.akl-internal-links a { color: #79f2ff !important; text-decoration: underline !important; }

.nero-ai-reveal{
  opacity:0;transform:translateY(22px);
  transition:opacity .55s ease,transform .55s ease;
}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}

.akl-content .ym-cta-block__icon{font-size:32px;margin-bottom:8px;}
</style>

<style>

/* === БОРИС: стили контента akl- (влить в <style> page-ai-kvalifikaciya-lidov.php) === */
.akl-content{--akl-text:#e6edf7;--akl-muted:#9aa8bd;--akl-soft:#c7d2e5;--akl-heading:#fff;--akl-accent:#79f2ff;--akl-violet:#8b5cf6;--akl-green:#22c55e;--akl-container:1220px;background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);color:var(--akl-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;}
.akl-content *,.akl-content *::before,.akl-content *::after{box-sizing:border-box;}
.akl-content p{color:var(--akl-muted);line-height:1.72;margin:0 0 1em;}
.akl-content h2,.akl-content h3{color:var(--akl-heading);letter-spacing:-.04em;margin:0 0 .65em;}
.akl-content h2{font-size:clamp(26px,3.6vw,44px);line-height:1.08;}
.akl-content h3{font-size:19px;}
.akl-content strong{color:var(--akl-soft);}
.akl-content ul,.akl-content ol{padding-left:1.2em;margin:0 0 1em;color:var(--akl-muted);}
.akl-content li{margin-bottom:.4em;line-height:1.65;}
.akl-cnt{width:min(var(--akl-container),calc(100% - 40px));margin:0 auto;}
.akl-section{padding:clamp(56px,7vw,96px) 0;}
.akl-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.03),rgba(255,255,255,.008));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.akl-eyebrow{display:inline-flex;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--akl-accent);margin-bottom:12px;}
.akl-intro-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:28px;align-items:start;}
@media(max-width:900px){.akl-intro-grid{grid-template-columns:1fr;}}
.akl-intro-text{border-left:3px solid var(--akl-accent);padding-left:22px;}
.akl-kpi-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
.akl-kpi{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:18px;}
.akl-kpi .kv{font-size:22px;font-weight:900;color:var(--akl-accent);}
.akl-kpi .kl{font-size:12px;color:var(--akl-muted);margin-top:4px;}
.akl-table-wrap{overflow-x:auto;border-radius:16px;border:1px solid rgba(255,255,255,.1);margin:20px 0;}
.akl-table{width:100%;border-collapse:collapse;font-size:14px;}
.akl-table th{padding:12px 14px;text-align:left;background:rgba(121,242,255,.1);color:var(--akl-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);}
.akl-table td{padding:11px 14px;border-bottom:1px solid rgba(255,255,255,.06);color:var(--akl-text);vertical-align:top;}
.akl-table tr:last-child td{border-bottom:none;}
.akl-faq{display:flex;flex-direction:column;gap:12px;}
.akl-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:18px 22px;}
.akl-geo{background:rgba(139,92,246,.08);border:1px solid rgba(139,92,246,.25);border-radius:20px;padding:28px;margin-top:24px;}
.akl-content .ym-cta-block{border-radius:20px;padding:32px 36px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);}
.akl-content .ym-cta-block--primary{text-align:center;}
.akl-content .ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.akl-content .ym-cta-block--footer-final{text-align:center;}
.akl-content .ym-cta-block__headline{font-size:clamp(20px,2.6vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.akl-content .ym-cta-block__sub{color:var(--akl-muted);font-size:15px;margin:0 auto 20px;max-width:640px;line-height:1.7;}
.akl-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.akl-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.akl-content .ym-link--accent{color:var(--akl-accent)!important;text-decoration:underline!important;}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-kvalifikaciya-lidov-page" role="main" tabindex="-1">

<section class="nero-ai-hero akl-hero-leads" id="hero" aria-labelledby="akl-hero-leads-title">
<style>
/* ── Hero ai-kvalifikaciya-lidov: самодостаточные стили ── */
.akl-hero-leads {
  --akl-cyan: #79f2ff;
  --akl-violet: #8b5cf6;
  --akl-hot: #f97316;
  --akl-warm: #fbbf24;
  --akl-cold: #38bdf8;
  --akl-nogo: #94a3b8;
  --akl-green: #22c55e;
  --akl-text: #e6edf7;
  --akl-muted: #9aa8bd;
  --akl-soft: #c7d2e5;
  --akl-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.akl-hero-leads::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 70%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.akl-hero-leads::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 560px;
  height: 560px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(10px);
  animation: aklHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aklHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.akl-hero-leads .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.akl-hero-leads .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.akl-hero-leads .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.akl-hero-leads .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--akl-cyan) 40%, var(--akl-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.akl-hero-leads .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--akl-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: lowercase;
  letter-spacing: 0.06em;
}
.akl-hero-leads .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--akl-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.akl-hero-leads .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.akl-hero-leads .nero-ai-badge {
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
.akl-hero-leads .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.akl-hero-leads .nero-ai-btn {
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
.akl-hero-leads .nero-ai-btn:hover { transform: translateY(-2px); }
.akl-hero-leads .nero-ai-btn-primary {
  color: #050711 !important;
  background: linear-gradient(135deg, var(--akl-cyan), #a78bfa);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.akl-hero-leads .nero-ai-btn-secondary {
  color: var(--akl-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.akl-hero-leads .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--akl-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.akl-hero-leads .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.akl-hero-leads .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.akl-hero-leads .nero-ai-dots { display: flex; gap: 7px; }
.akl-hero-leads .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.akl-hero-leads .nero-ai-dot:nth-child(1) { background: #fb7185; }
.akl-hero-leads .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.akl-hero-leads .nero-ai-dot:nth-child(3) { background: #34d399; }
.akl-hero-leads .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.akl-hero-leads .nero-ai-window-body { padding: 16px; }
.akl-hero-leads .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.akl-hero-leads .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.akl-hero-leads .nero-ai-live-pill {
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
.akl-hero-leads .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aklPulse 1.6s infinite;
}
@keyframes aklPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.akl-hero-leads .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.akl-hero-leads .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.akl-hero-leads .nero-ai-metric span {
  display: block;
  color: var(--akl-muted);
  font-size: 11px;
  font-weight: 700;
}
.akl-hero-leads .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.akl-hero-leads .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.akl-hero-leads .akl-status-legend {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 6px;
  margin-bottom: 10px;
}
.akl-hero-leads .akl-status-chip {
  text-align: center;
  padding: 6px 4px;
  border-radius: 10px;
  font-size: 9px;
  font-weight: 800;
  letter-spacing: .02em;
  border: 1px solid rgba(255,255,255,.08);
}
.akl-hero-leads .akl-status-chip--hot { background: rgba(249,115,22,.15); color: #fdba74; }
.akl-hero-leads .akl-status-chip--warm { background: rgba(251,191,36,.12); color: #fde68a; }
.akl-hero-leads .akl-status-chip--cold { background: rgba(56,189,248,.12); color: #bae6fd; }
.akl-hero-leads .akl-status-chip--nogo { background: rgba(148,163,184,.12); color: #cbd5e1; }
.akl-hero-leads .akl-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 50% 42%, rgba(121,242,255,.08), rgba(6,10,24,.94) 72%);
}
.akl-hero-leads #akl-hero-leads-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.akl-hero-leads .nero-ai-task-stream { display: grid; gap: 8px; }
.akl-hero-leads .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.akl-hero-leads .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--akl-cyan);
  font-size: 11px;
  font-weight: 800;
}
.akl-hero-leads .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.akl-hero-leads .nero-ai-task span {
  color: var(--akl-muted);
  font-size: 11px;
}
.akl-hero-leads .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.akl-hero-leads .nero-ai-status--hot {
  background: rgba(249,115,22,.14);
  color: #fdba74;
}
.akl-hero-leads .nero-ai-status--warm {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .akl-hero-leads .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .akl-hero-leads .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .akl-hero-leads .akl-status-legend { grid-template-columns: 1fr 1fr; }
  .akl-hero-leads .nero-ai-task { grid-template-columns: 28px 1fr; }
  .akl-hero-leads .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai квалификация лидов</p>
      <h1 id="akl-hero-leads-title">AI-квалификация лидов: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI присваивает каждому лиду статус — горячий, тёплый, холодный или нецелевой — до передачи менеджеру, чтобы отдел продаж не тратил время на пустые разговоры</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">4 статуса лида</li>
        <li class="nero-ai-badge">CRM 24/7</li>
        <li class="nero-ai-badge">Скоринг</li>
        <li class="nero-ai-badge">Под ключ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy-vnedreniya">Этапы внедрения</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-квалификация лидов">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-квалификация · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Входящие</span><strong>47</strong><small>сегодня</small></div>
            <div class="nero-ai-metric"><span>Ответ</span><strong>8 сек</strong><small>первичный</small></div>
            <div class="nero-ai-metric"><span>Горячие</span><strong>12</strong><small>в очереди</small></div>
            <div class="nero-ai-metric"><span>Override</span><strong>4%</strong><small>РОП</small></div>
          </div>
          <div class="akl-status-legend" aria-hidden="true">
            <span class="akl-status-chip akl-status-chip--hot">горячий</span>
            <span class="akl-status-chip akl-status-chip--warm">тёплый</span>
            <span class="akl-status-chip akl-status-chip--cold">холодный</span>
            <span class="akl-status-chip akl-status-chip--nogo">нецелевой</span>
          </div>
          <div class="akl-dash-canvas-wrap">
            <canvas id="akl-hero-leads-canvas" role="img" aria-label="Анимация: заявки по лучам к матрице статусов, запись в CRM и передача менеджеру"></canvas>
          </div>
          <div class="nero-ai-task-stream" aria-label="Поток квалификации">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">IN</span>
              <div><strong>Заявка</strong><span>сайт · Telegram · форма</span></div>
              <span class="nero-ai-status">принято</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Статус лида</strong><span>матрица · confidence 0.91</span></div>
              <span class="nero-ai-status nero-ai-status--hot">горячий</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Поля и задача</strong><span>amoCRM / Bitrix24</span></div>
              <span class="nero-ai-status">записано</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">→</span>
              <div><strong>Менеджер</strong><span>summary диалога в карточке</span></div>
              <span class="nero-ai-status nero-ai-status--warm">в работе</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * akl-hero-leads-engine — «Диспетчерская квалификации лидов»
 * LeadIngressStream → QualificationMatrixHub → CrmBridgePortal → ManagerQueueDock
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("akl-hero-leads-canvas");
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
    scale = Math.min(cw / 400, ch / 260) * 1.05;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    hot: "#f97316",
    warm: "#fbbf24",
    cold: "#38bdf8",
    nogo: "#94a3b8",
    hub: "#1e293b",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    lead: "#e2e8f0",
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
      ctx.lineWidth = 1.2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  function drawLeadDot(ctx, x, y, color, pulse) {
    var r = 5 + (pulse ? Math.sin(frame * 0.2) * 1.2 : 0);
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.arc(x, y, r, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1;
    ctx.stroke();
  }

  function LeadIngressStream() {
    this.rays = [
      { angle: -1.1, offset: 0, color: C.hot },
      { angle: -0.35, offset: 40, color: C.warm },
      { angle: 0.35, offset: 80, color: C.cold },
      { angle: 1.05, offset: 120, color: C.nogo }
    ];
  }
  LeadIngressStream.prototype.draw = function (ctx) {
    var R0 = 95 * scale;
    var R1 = 42 * scale;
    this.rays.forEach(function (ray) {
      ctx.strokeStyle = "rgba(121,242,255,0.12)";
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      var x0 = Math.cos(ray.angle) * R0;
      var y0 = Math.sin(ray.angle) * R0 * 0.55;
      var x1 = Math.cos(ray.angle) * R1;
      var y1 = Math.sin(ray.angle) * R1 * 0.55;
      ctx.moveTo(x0, y0);
      ctx.lineTo(x1, y1);
      ctx.stroke();

      var t = ((frame * 0.55 + ray.offset) % 100) / 100;
      var lx = x0 + (x1 - x0) * t;
      var ly = y0 + (y1 - y0) * t;
      if (t < 0.88) drawLeadDot(ctx, lx, ly, ray.color, t > 0.7);
    });
  };

  function IcpFilterGate() {}
  IcpFilterGate.prototype.draw = function (ctx) {
    drawRR(ctx, -118, -12, 36, 48, 6, "rgba(255,255,255,0.05)", C.outline);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ICP", -100, 8);
    var open = Math.sin(frame * 0.08) > 0;
    ctx.fillStyle = open ? "rgba(34,197,94,0.5)" : "rgba(248,113,113,0.4)";
    ctx.fillRect(-112, 18, 24, 3);
  };

  function QualificationMatrixHub() {
    this.phase = 0;
    this.activeQuad = 0;
  }
  QualificationMatrixHub.prototype.draw = function (ctx) {
    this.phase = (frame * 0.04) % 220;
    this.activeQuad = Math.floor(this.phase / 55) % 4;
    var size = 52 * scale;
    var colors = [C.hot, C.warm, C.cold, C.nogo];
    var labels = ["Г", "Т", "Х", "Н"];
    drawRR(ctx, -size, -size * 0.55, size * 2, size * 1.1, 10, C.hub, C.outline);
    for (var q = 0; q < 4; q++) {
      var qx = (q % 2) * size - size + 4;
      var qy = Math.floor(q / 2) * (size * 0.5) - size * 0.5 + 4;
      var alpha = q === this.activeQuad ? 0.85 : 0.35;
      ctx.fillStyle = colors[q];
      ctx.globalAlpha = alpha;
      drawRR(ctx, qx, qy, size - 8, size * 0.45 - 4, 4, colors[q], null);
      ctx.globalAlpha = 1;
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(labels[q], qx + (size - 8) / 2, qy + (size * 0.45 - 4) / 2 + 3);
    }
    if (this.phase > 140 && this.phase < 200) {
      var conf = 0.72 + Math.sin(frame * 0.1) * 0.12;
      ctx.strokeStyle = C.cyan;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, 0, 28 * scale, -Math.PI / 2, -Math.PI / 2 + Math.PI * 2 * conf);
      ctx.stroke();
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText(Math.round(conf * 100) + "%", 0, -38 * scale);
    }
  };

  function StatusRingSorter() {}
  StatusRingSorter.prototype.draw = function (ctx) {
    var rot = frame * 0.015;
    ctx.save();
    ctx.rotate(rot);
    for (var i = 0; i < 4; i++) {
      var a = (i / 4) * Math.PI * 2;
      var col = [C.hot, C.warm, C.cold, C.nogo][i];
      ctx.fillStyle = col;
      ctx.beginPath();
      ctx.arc(Math.cos(a) * 62 * scale, Math.sin(a) * 38 * scale, 4, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.restore();
  };

  function CrmBridgePortal() {
    this.sync = 0;
  }
  CrmBridgePortal.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    drawRR(ctx, 72, -8, 44, 56, 8, "rgba(139,92,246,0.15)", C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM", 94, 4);
    if (prg >= 165 && prg < 210) {
      this.sync = (prg - 165) / 45;
      ctx.fillStyle = C.violet;
      ctx.globalAlpha = 0.35 + this.sync * 0.5;
      for (var b = 0; b < 3; b++) {
        drawRR(ctx, 78, 12 + b * 12, 32, 8, 2, "rgba(121,242,255,0.35)", null);
      }
      ctx.globalAlpha = 1;
    }
  };

  function ManagerQueueDock() {}
  ManagerQueueDock.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    drawRR(ctx, 118, 22, 52, 28, 6, "rgba(34,197,94,0.12)", C.outline);
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Менеджер", 144, 38);
    if (prg >= 200) {
      drawLeadDot(ctx, 132, 30, C.hot, true);
      ctx.strokeStyle = C.hot;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.moveTo(94, 18);
      ctx.lineTo(128, 28);
      ctx.stroke();
    }
  };

  function Agent(x, y, color, role, dialogs, stepTrig) {
    this.x = x;
    this.y = y;
    this.color = color;
    this.role = role;
    this.dialogs = dialogs;
    this.stepTrig = stepTrig;
    this.bubble = null;
    this.bubbleT = 0;
    this.tx = x;
    this.ty = y;
  }
  Agent.prototype.setTarget = function (tx, ty) {
    this.tx = tx;
    this.ty = ty;
  };
  Agent.prototype.tick = function () {
    this.x += (this.tx - this.x) * 0.06;
    this.y += (this.ty - this.y) * 0.06;
    if (this.bubbleT > 0) this.bubbleT--;
    else this.bubble = null;
  };
  Agent.prototype.say = function () {
    if (Math.random() > 0.992 && !this.bubble) {
      this.bubble = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      this.bubbleT = 90;
    }
  };
  Agent.prototype.draw = function (ctx) {
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y, 7 * scale, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.beginPath();
    ctx.arc(this.x + 2, this.y - 2, 2, 0, Math.PI * 2);
    ctx.fill();
    if (this.bubble && this.bubbleT > 0) {
      var bw = Math.min(110, this.bubble.length * 5.5);
      drawRR(ctx, this.x - bw / 2, this.y - 28, bw, 16, 4, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.font = "6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(this.bubble, this.x, this.y - 17);
    }
  };

  var ingress = new LeadIngressStream();
  var icp = new IcpFilterGate();
  var hub = new QualificationMatrixHub();
  var ring = new StatusRingSorter();
  var crm = new CrmBridgePortal();
  var dock = new ManagerQueueDock();

  var agents = [
    new Agent(-130, 42, C.agentYellow, "1_architect", ["Матрица 4 статусов", "Критерии от РОПа", "Порог бюджета"], 30),
    new Agent(-125, -48, C.agentGreen, "2_seo", ["ICP: B2B услуги", "Анти-портрет клиента", "Поле региона"], 60),
    new Agent(48, -52, C.agentBlue, "3_coder", ["Webhook ACK 200", "Очередь Redis", "JSON статуса"], 90),
    new Agent(52, 44, C.agentPink, "4_designer", ["Цвет горячего", "Легенда статусов", "UI для РОПа"], 120),
    new Agent(128, -18, C.agentPurple, "5_deployer", ["Пилот Telegram", "Передача менеджеру", "Human-in-the-loop"], 150)
  ];

  var bubbles = [];
  function createBubble(text, ttl) {
    bubbles.push({ text: text, t: ttl || 70, y: -58 * scale });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);

    ingress.draw(ctx);
    icp.draw(ctx);
    ring.draw(ctx);
    hub.draw(ctx);
    crm.draw(ctx);
    dock.draw(ctx);

    var prg = (frame * 0.04) % 220;
    if (prg === 1) createBubble("Новая заявка с формы", 65);
    if (prg === 58) createBubble("Диалог: бюджет и срок", 70);
    if (prg === 112) createBubble("Статус: горячий · 91%", 75);
    if (prg === 168) createBubble("Поля записаны в CRM", 68);
    if (prg === 205) createBubble("Задача менеджеру", 72);

    agents.forEach(function (a, i) {
      var targets = [
        { x: -105, y: 8 },
        { x: -100, y: -32 },
        { x: 8, y: -28 },
        { x: 12, y: 32 },
        { x: 108, y: 0 }
      ];
      if (prg > 40 + i * 12) a.setTarget(targets[i].x * scale, targets[i].y * scale);
      a.tick();
      a.say();
      a.draw(ctx);
    });

    bubbles.forEach(function (b) {
      b.t--;
      b.y -= 0.15;
      if (b.t <= 0) return;
      ctx.globalAlpha = Math.min(1, b.t / 20);
      drawRR(ctx, -55 * scale, b.y, 110 * scale, 14, 4, "rgba(15,23,42,0.88)", C.cyan);
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.text, 0, b.y + 10);
      ctx.globalAlpha = 1;
    });
    bubbles = bubbles.filter(function (b) { return b.t > 0; });

    ctx.restore();
    requestAnimationFrame(engineloop);
  }
  engineloop();
});
</script>

<div class="akl-content">
  <section class="akl-section akl-intro" id="intro" aria-label="Введение">
    <div class="akl-cnt">
      <div class="akl-intro-grid nero-ai-reveal">
        <div class="akl-intro-text">
<p>В B2B-продажах главный дефицит — не лиды, а <strong>внимание менеджера</strong>. Когда на входе смешиваются готовые к сделке запросы, «просто спросить» и явно нецелевые обращения, отдел начинает тратить часы на диалоги без бюджета и полномочий. <strong>AI-квалификация лидов</strong> — это внедрение автоматической первичной оценки <strong>до</strong> передачи контакта в CRM: система уточняет данные, сопоставляет их с вашим ICP и присваивает статус, чтобы продавец открывал только те карточки, где есть смысл разговаривать.</p>
<p>Nero Network внедряет такие контуры <strong>под ключ</strong> для агентств, девелоперов, интеграторов и отделов продаж услуг: от матрицы критериев до интеграции с amoCRM, Bitrix24 и мессенджерами. Ниже — как устроено решение, чем оно отличается от «просто чат-бота», какие этапы внедрения и на что смотреть при выборе подрядчика.</p>
        </div>
        <div class="akl-kpi-grid" aria-label="Ключевые ориентиры">
          <div class="akl-kpi"><div class="kv">87%</div><div class="kl">компаний используют AI в продажах (Salesforce 2026)</div></div>
          <div class="akl-kpi"><div class="kv">4</div><div class="kl">статуса лида до менеджера</div></div>
          <div class="akl-kpi"><div class="kv">×8</div><div class="kl">конверсия при ответе &lt;5 мин</div></div>
          <div class="akl-kpi"><div class="kv">150–450k ₽</div><div class="kl">ориентир чека внедрения</div></div>
        </div>
      </div>

      <nav class="akl-toc ym-toc nero-ai-reveal" aria-label="Оглавление статьи">
        <p class="akl-toc-title">На этой странице</p>
        <ul class="akl-toc-list">
          <li><a href="#statusy-lidov">Зачем отделу продаж</a></li>
          <li><a href="#matrica-statusov">Матрица статусов</a></li>
          <li><a href="#skoring">AI лид-скоринг</a></li>
          <li><a href="#etapy-vnedreniya">Этапы внедрения</a></li>
          <li><a href="#crm">Интеграция с CRM</a></li>
          <li><a href="#keis">Кейсы</a></li>
          <li><a href="#cena">Стоимость</a></li>
          <li><a href="#faq">FAQ</a></li>
        </ul>
      </nav>

      <p class="nero-ai-reveal akl-internal-wrap" style="margin-top:20px;font-size:14px"><span class="akl-internal-links">Смежные услуги: <a href="/vnedrenie-ai-amocrm/">AI-агент для amoCRM</a> · <a href="/vnedrenie-ai-obrabotka-email-crm/">обработка email в CRM</a> · <a href="/ai-1c-erp/">AI для 1С и ERP</a>.</span></p>
    </div>
  </section>
  <section class="akl-section" id="statusy-lidov">
    <div class="akl-cnt nero-ai-reveal">
      <span class="akl-eyebrow">Зачем отделу продаж</span>
<h2>Зачем отделу продаж AI-квалификация лидов</h2>
<p>Руководитель продаж обычно видит одну картину в отчётах и другую — в переписках. В CRM все заявки выглядят одинаково, а по факту часть из них никогда не купит: нет бюджета, неверный регион, запрос не по профилю, человек не ЛПР. <strong>Автоматизация квалификации клиентов</strong> снимает с менеджеров рутину первых вопросов и даёт <strong>прозрачную очередь</strong> для команды.</p>
<p>По данным отчёта Salesforce *State of Sales* (7-е издание, опрос 4 050 продавцов, 2025–2026): <strong>87%</strong> организаций уже используют AI в продажах — для проспектинга, прогноза, <strong>lead scoring</strong> или черновиков писем; <strong>54%</strong> продавцов уже работали с <strong>AI-агентами</strong>, и почти <strong>9 из 10</strong> планируют это к 2027 году. Топ-команды <strong>в 1,7 раза</strong> чаще применяют prospecting-агентов, чем отстающие (<a href="https://www.salesforce.com/news/stories/state-of-sales-report-announcement-2026/" target="_blank" rel="noopener noreferrer">анонс отчёта</a>). Для российского B2B это не «мода», а способ выровнять скорость реакции с ожиданиями клиента.</p>
<p><strong>AI для отдела продаж</strong> в узком смысле этой страницы — не генерация писем ради красоты текста, а <strong>решение о приоритете лида</strong> до звонка человека.</p>
<h3>Сколько времени уходит на нецелевые заявки</h3>
<p>Типовой сценарий: менеджер тратит 15–40 минут на уточнение бюджета, срока, географии и роли контакта — и только потом понимает, что сделка не в воронке. Умножьте на десятки заявок в месяц: получаются <strong>десятки часов</strong>, которые не конвертируются в выручку.</p>
<p>Исследования <strong>speed-to-lead</strong> показывают, почему задержка бьёт по деньгам: анализ XANT по <strong>5,7 млн</strong> лидов — конверсия <strong>в 8 раз выше</strong>, если контакт в первые <strong>5 минут</strong>, а не позже (<a href="https://wearemachina.com/insights/speed-to-lead" target="_blank" rel="noopener noreferrer">обзор</a>). Классические работы по скорости ответа фиксируют резкое падение шансов связаться и квалифицировать лид после первых минут ожидания (<a href="https://leadsource.co/blog/speed-to-lead-evidence" target="_blank" rel="noopener noreferrer">разбор источников</a>). AI-агент отвечает за секунды, собирает поля в карточку и <strong>не откладывает</strong> «тёплых» до конца рабочего дня.</p>
<p>Отдельная боль — <strong>неполные формы</strong>: имя и телефон без контекста. Тогда квалификация в мессенджере (дожим заявки) часто даёт больший эффект, чем ещё один менеджер на линии. В публичном кейсе «Беспалов Авто» интегратор описывает до <strong>40%</strong> экономии времени на первичной квалификации за счёт AI в Telegram и обновления Bitrix24 (<a href="https://zharikovconsulting.ru/cases/bespalovavto-ai" target="_blank" rel="noopener noreferrer">кейс</a>).</p>
<h3>Чем отличается от «просто CRM» и обработки почты</h3>
<p>Интеграция CRM и обработка входящей почты решают <strong>другие</strong> задачи: доставить письмо в карточку, поставить задачу, не потерять вложение. <strong>AI-квалификация лидов с CRM</strong> добавляет слой <strong>смысла</strong>: какой статус у обращения, какое следующее действие, кого будить ночью, а кого отправить в nurturing.</p>
<div class="akl-table-wrap"><table class="akl-table">
<tr><th>Задача</th><th>Обычная CRM / почта</th><th>AI-квалификация</th></tr>
<tr><td>Скорость первого ответа</td><td>Зависит от графика менеджера</td><td>Секунды–минуты, 24/7 на выбранных каналах</td></tr>
<tr><td>Заполнение полей</td><td>Ручной ввод</td><td>Диалог + структура в JSON → поля CRM</td></tr>
<tr><td>Приоритет очереди</td><td>Часто «кто первый написал»</td><td>Горячий / тёплый / холодный / нецелевой</td></tr>
<tr><td>Аналитика</td><td>«Сколько лидов»</td><td>Доля статусов, override РОПа, причины отказа</td></tr>
</table></div>
<p>Если вам ближе <a href="/vnedrenie-ai-amocrm/">внедрение AI в amoCRM</a> или <a href="/vnedrenie-ai-obrabotka-email-crm/">обработка email в CRM</a> — это смежные услуги. Здесь фокус на <strong>скоринге и статусах</strong>, а не на одной интеграции канала.</p>
    </div>
  </section>

<section id="ai-kvalifikaciya-lidov-boris-block" class="bak-root" aria-label="Анимация: AI присваивает лиду статус до передачи в CRM">
<style>
#ai-kvalifikaciya-lidov-boris-block.bak-root{padding:clamp(48px,6vw,72px) 0;background:#f1f5f9;}
#ai-kvalifikaciya-lidov-boris-block .bak-cnt{width:min(1160px,calc(100% - 40px));margin:0 auto;}
#ai-kvalifikaciya-lidov-boris-block .bak-card{display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);border-radius:24px;overflow:hidden;background:#fff;box-shadow:0 12px 48px rgba(15,23,42,.1),0 0 0 1px rgba(148,163,184,.2);min-height:500px;}
@media(max-width:1023px){#ai-kvalifikaciya-lidov-boris-block .bak-card{grid-template-columns:1fr;min-height:auto;}}
#ai-kvalifikaciya-lidov-boris-block .bak-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-kvalifikaciya-lidov-boris-block .bak-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#ai-kvalifikaciya-lidov-boris-block .bak-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#6366f1;margin:0 0 14px;}
#ai-kvalifikaciya-lidov-boris-block .bak-ey::before{content:'';width:20px;height:2px;background:#6366f1;border-radius:1px;}
#ai-kvalifikaciya-lidov-boris-block .bak-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 20px;}
#ai-kvalifikaciya-lidov-boris-block .bak-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:10px;}
#ai-kvalifikaciya-lidov-boris-block .bak-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14.5px;line-height:1.5;color:#334155;}
#ai-kvalifikaciya-lidov-boris-block .bak-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(99,102,241,.12);display:flex;align-items:center;justify-content:center;font-size:11px;color:#6366f1;font-style:normal;margin-top:1px;}
#ai-kvalifikaciya-lidov-boris-block .bak-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-kvalifikaciya-lidov-boris-block .bak-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-kvalifikaciya-lidov-boris-block .bak-pl-h{background:rgba(239,68,68,.08);color:#b91c1c;border:1.5px solid rgba(239,68,68,.25);}
#ai-kvalifikaciya-lidov-boris-block .bak-pl-w{background:rgba(245,158,11,.1);color:#b45309;border:1.5px solid rgba(245,158,11,.28);}
#ai-kvalifikaciya-lidov-boris-block .bak-pl-c{background:rgba(59,130,246,.08);color:#1d4ed8;border:1.5px solid rgba(59,130,246,.22);}
#ai-kvalifikaciya-lidov-boris-block .bak-pl-n{background:rgba(100,116,139,.1);color:#475569;border:1.5px solid rgba(100,116,139,.25);}
#ai-kvalifikaciya-lidov-boris-block .bak-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
#ai-kvalifikaciya-lidov-boris-block .bak-rgt{background:linear-gradient(155deg,#0b1020 0%,#121a32 50%,#0a0f1c 100%);position:relative;min-height:420px;}
#ai-kvalifikaciya-lidov-boris-block #bak-lead-qualify-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bak-cnt"><div class="bak-card">
<div class="bak-lft">
<span class="bak-ey">Поток в действии</span>
<h3 class="bak-h3">Заявка проходит AI-квалификацию — менеджер видит только приоритетную очередь</h3>
<ul class="bak-ul">
<li><span class="bak-ic">1</span>Входящий лид с сайта или мессенджера попадает в контур за секунды</li>
<li><span class="bak-ic">2</span>Агент уточняет бюджет, срок, ЛПР и сопоставляет с матрицей ICP</li>
<li><span class="bak-ic">3</span>Статус и summary записываются в CRM до звонка человека</li>
<li><span class="bak-ic">?</span>Низкая уверенность — очередь human-in-the-loop для РОПа</li>
</ul>
<div class="bak-pills">
<span class="bak-pl bak-pl-h">Горячий</span><span class="bak-pl bak-pl-w">Тёплый</span>
<span class="bak-pl bak-pl-c">Холодный</span><span class="bak-pl bak-pl-n">Нецелевой</span>
</div>
<p class="bak-foot">Дальше — матрица статусов и критерии для вашей ниши →</p>
</div>
<div class="bak-rgt"><canvas id="bak-lead-qualify-canvas" aria-label="Анимация: лиды проходят AI-квалификацию и сортируются по четырём статусам в CRM" role="img"></canvas></div>
</div></div>
<script>
(function(){var cv=document.getElementById('bak-lead-qualify-canvas');if(!cv)return;var ctx=cv.getContext('2d');var W=0,H=0,fr=0;
function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;W=cv.width;H=cv.height;}
window.addEventListener('resize',resize);resize();
var ST={hot:{label:'Горячий',color:'#ef4444',bg:'rgba(239,68,68,.15)'},warm:{label:'Тёплый',color:'#f59e0b',bg:'rgba(245,158,11,.15)'},cold:{label:'Холодный',color:'#3b82f6',bg:'rgba(59,130,246,.15)'},bad:{label:'Нецелевой',color:'#94a3b8',bg:'rgba(148,163,184,.2)'}};
var lanes=[{key:'hot'},{key:'warm'},{key:'cold'},{key:'bad'}];
function rr(x,y,w,h,r,fill,stroke){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(fill){ctx.fillStyle=fill;ctx.fill();}if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=1.2;ctx.stroke();}}
var chips=[];function spawn(){var keys=['hot','hot','warm','warm','cold','cold','bad'];var k=keys[Math.floor(Math.random()*keys.length)];chips.push({x:-30,y:H*0.38+Math.random()*H*0.08,phase:0,speed:1.1+Math.random()*0.5,status:k});}
function drawHub(cx,cy,r,p){var g=ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);g.addColorStop(0,'rgba(139,92,246,.35)');g.addColorStop(1,'rgba(139,92,246,0)');ctx.fillStyle=g;ctx.beginPath();ctx.arc(cx,cy,r*1.8,0,Math.PI*2);ctx.fill();rr(cx-r,cy-r,r*2,r*2,r*0.4,'#1e1b4b','#8b5cf6');ctx.fillStyle='#e9d5ff';ctx.font='bold '+Math.max(12,r*0.28)+'px system-ui,sans-serif';ctx.textAlign='center';ctx.textBaseline='middle';ctx.fillText('AI',cx,cy-2);ctx.font=Math.max(9,r*0.16)+'px system-ui,sans-serif';ctx.fillStyle='rgba(226,232,240,.7)';ctx.fillText('квалификация',cx,cy+r*0.35);ctx.strokeStyle='#a78bfa';ctx.lineWidth=2+p*2;ctx.globalAlpha=.25+p*.35;ctx.beginPath();ctx.arc(cx,cy,r+8+p*6,0,Math.PI*2);ctx.stroke();ctx.globalAlpha=1;}
function tick(){fr++;if(fr%55===0&&chips.length<8)spawn();ctx.clearRect(0,0,W,H);var laneH=H*0.11,gap=H*0.025,top=H*0.12;for(var i=0;i<lanes.length;i++){lanes[i].y=top+i*(laneH+gap);var st=ST[lanes[i].key];rr(W*0.62,lanes[i].y,W*0.34,laneH,8,st.bg,st.color);ctx.fillStyle=st.color;ctx.font='bold 11px system-ui,sans-serif';ctx.textAlign='left';ctx.fillText(st.label,W*0.64,lanes[i].y+laneH*0.62);}var hubX=W*0.38,hubY=H*0.5,hubR=Math.min(W,H)*0.09;drawHub(hubX,hubY,hubR,0.5+0.5*Math.sin(fr*0.05));for(var j=chips.length-1;j>=0;j--){var c=chips[j];c.phase+=c.speed*0.8;c.x+=c.speed;var st=ST[c.status];if(c.phase<hubX-hubR-10){rr(c.x-14,c.y-10,28,20,6,'#fff','#cbd5e1');ctx.fillStyle='#64748b';ctx.font='10px system-ui,sans-serif';ctx.textAlign='center';ctx.fillText('лид',c.x,c.y+4);}else if(c.phase<hubX+hubR+20){rr(c.x-16,c.y-11,32,22,6,st.bg,st.color);ctx.fillStyle=st.color;ctx.font='bold 9px system-ui,sans-serif';ctx.fillText(st.label.slice(0,4),c.x,c.y+4);}else{var li=lanes.findIndex(function(l){return l.key===c.status;});if(li>=0)c.y+=(lanes[li].y+laneH*0.5-c.y)*0.08;rr(c.x-14,c.y-10,28,20,6,st.bg,st.color);if(c.x>W*0.95){chips.splice(j,1);continue;}}if(c.x>W+40)chips.splice(j,1);}rr(W*0.78,H*0.82,W*0.18,H*0.12,8,'rgba(14,165,233,.12)','#0ea5e9');ctx.fillStyle='#7dd3fc';ctx.font='bold 10px system-ui,sans-serif';ctx.textAlign='center';ctx.fillText('CRM',W*0.87,H*0.89);requestAnimationFrame(tick);}tick();})();
</script>
</section>
  <section class="akl-section" id="matrica-statusov">
    <div class="akl-cnt nero-ai-reveal">
      <span class="akl-eyebrow">Матрица статусов</span>
<h2>Как AI присваивает статус лиду: горячий, тёплый, холодный, нецелевой</h2>
<p>Оффер Nero Network для этой услуги простой и проверяемый: каждому входящему обращению присваивается <strong>один из четырёх статусов</strong> до передачи менеджеру.</p>
<div class="akl-table-wrap"><table class="akl-table">
<tr><th>Статус</th><th>Когда ставится (пример для B2B-услуг / девелопера / агентства)</th><th>Действие в CRM</th></tr>
<tr><td><strong>Горячий</strong></td><td>Есть бюджет/срок, запрос по профилю, ЛПР или явный мандат, готовность к встрече</td><td>Задача менеджеру сразу, уведомление, приоритет в очереди</td></tr>
<tr><td><strong>Тёплый</strong></td><td>Интерес есть, но срок/бюджет размыты или нужен доп. согласующий</td><td>Серия касаний, КП, назначение созвона</td></tr>
<tr><td><strong>Холодный</strong></td><td>Запрос общий, «на будущее», нет срочности</td><td>Отложенная цепочка, реактивация агентом позже</td></tr>
<tr><td><strong>Нецелевой</strong></td><td>Не ваш регион, нет бюджета, спам, конкурент, услуга вне прайса</td><td>Вежливый отказ, причина в поле CRM, без траты времени отдела</td></tr>
</table></div>
<p>Такая <strong>матрица квалификации лидов</strong> — центральный лид-магнит проекта: не абстрактный «ИИ», а таблица <strong>критерий → статус → действие</strong>, которую РОП утверждает до запуска.</p>
<p>Логика контура в типовом <strong>внедрении ai квалификация лидов</strong>:</p>
<ol>
<li>Событие: заявка с сайта, сообщение в Telegram, звонок, форма Tilda.</li>
<li>Нормализация контакта и обогащение: UTM, история в CRM, данные формы.</li>
<li>Диалог или опрос: 3–7 вопросов по матрице (продукт, объём, срок, бюджет, ЛПР — как в кейсе MrBoro для amoCRM, <a href="https://mrboroai.ru/cases/ai-agent-lead-qualification-amocrm" target="_blank" rel="noopener noreferrer">описание</a>).</li>
<li>Классификация: статус + <strong>confidence score</strong> (уверенность модели).</li>
<li>Действие в CRM: кастомное поле, тег, стадия, summary в примечании.</li>
<li><strong>Human-in-the-loop</strong> для спорных, жалоб и чувствительных к ПДн кейсов.</li>
</ol>
<h3>Правила, скоринг и LLM-агент — что выбрать</h3>
<p>Три подхода не конкурируют «кто круче» — они закрывают разную зрелость данных:</p>
<div class="akl-table-wrap"><table class="akl-table">
<tr><th>Подход</th><th>Когда уместен</th><th>Ограничения</th></tr>
<tr><td><strong>Правила + скрипт</strong> (BANT/MEDDIC в чек-листе)</td><td>Мало истории сделок, жёсткий ICP, понятные пороги чека</td><td>Не увидит нетипичный, но выгодный лид</td></tr>
<tr><td><strong>ML lead scoring</strong> на истории CRM</td><td>Сотни–тысячи закрытых сделок, чистые поля</td><td>Нужна дисциплина данных; без диалога не закроет «пустую» форму</td></tr>
<tr><td><strong>LLM-агент</strong> (диалог + контекст CRM)</td><td>Мессенджеры, много каналов, неполные заявки</td><td>Риск галлюцинаций, лимиты webhook CRM, compliance</td></tr>
</table></div>
<p>В проектах Nero Network часто строят <strong>два контура</strong>: диалоговый агент (как у Velmi на Habr для Bitrix24) и <strong>опциональный</strong> ML-слой поверх истории — по аналогии с Salesforce Einstein Lead Scoring, где модель пересчитывается регулярно по конверсии Lead → сделка (<a href="https://help.salesforce.com/s/articleView?id=sf.einstein_sales_setup_enable_lead_insights.htm" target="_blank" rel="noopener noreferrer">справка Salesforce</a>).</p>
<p>Публичная архитектура Velmi (<a href="https://habr.com/ru/articles/1045026/" target="_blank" rel="noopener noreferrer">Habr</a>): webhook CRM → быстрый ответ <strong>200 OK</strong> (обход лимита <strong>3 секунд</strong> на ответ Bitrix24) → очередь Redis → асинхронная обработка GPT-агентом. В материале заявлены: время ответа <strong>с 2–3 часов до 30–40 секунд</strong>, рост доли квалифицированных лидов <strong>+35%</strong>, экономия порядка <strong>50 ч/мес</strong> у менеджеров. Это ориентир рынка, не гарантия для каждого нишевого проекта — но показывает класс эффекта при правильной инженерии.</p>
<h3>Human-in-the-loop и контроль качества</h3>
<p>«AI ошибётся» — справедливое возражение. Поэтому в рабочем контуре закладывают:</p>
<ul>
<li>пороги уверенности: «горячий» без автопередачи, если score ниже заданного;</li>
<li>выборочную проверку РОПом и метрику <strong>% override</strong> (сколько статусов человек меняет);</li>
<li>запрет автоматических обещаний по цене и срокам без шаблонов;</li>
<li>отдельную очередь для refund/complaint/unknown — как в кейсе маршрутизации на workspace.ru (<a href="https://workspace.ru/cases/ai-sistema-kvalifikacii-obrascheniy-i-avtomaticheskoy-marshrutizacii-v-bitrix24/" target="_blank" rel="noopener noreferrer">кейс</a>).</li>
</ul>
<p>HubSpot в Customer Agent использует статусы Qualified / Partially qualified / Not qualified — близкая логика к нашей четырёхуровневой шкале (<a href="https://knowledge.hubspot.com/customer-agent/set-up-customer-agent-actions-to-qualify-leads" target="_blank" rel="noopener noreferrer">документация</a>). Международный термин <strong>CQL (Conversation Qualified Lead)</strong> из экосистемы Drift/Salesloft подчёркивает: лид «горячий» <strong>после диалога</strong>, а не только по одной строке в форме (<a href="https://help.salesloft.com/s/article/Drift-Conversation-Qualified-Leads-CQL" target="_blank" rel="noopener noreferrer">справка Salesloft</a>).</p>
    </div>
  </section>
  <section class="akl-section akl-section-alt" id="skoring">
    <div class="akl-cnt nero-ai-reveal">
<h2>AI лид-скоринг и скоринг лидов: одна задача, разные формулировки</h2>
<p>В поиске встречаются запросы <strong>ai лид скоринг</strong> и <strong>скоринг лидов ai</strong> — это тот же кластер, что и квалификация, с акцентом на <strong>числовой или ранговый приоритет</strong>.</p>
<p><strong>Квалификация</strong> отвечает на вопрос: «С кем вообще имеет смысл разговаривать и какой у лида тип?» <strong>Скоринг</strong> часто добавляет балл 0–100 или вероятность конверсии. В кейсе AutoBIT24 для Bitrix24 описан ML-скоринг на трёх годах сделок: балл, правила-исключения, автозвонок менеджеру при score 80+; в статье интегратора указаны ориентиры по конверсии и циклу сделки (<a href="https://autobit24.ru/blog/ai-skoring-lidov-bitrix24-prioritizaciya/" target="_blank" rel="noopener noreferrer">материал</a>) — цифры заявлены автором кейса, не независимым аудитом.</p>
<p>Для заказчика важно не путать:</p>
<ul>
<li><strong>маршрутизацию</strong> (куда отправить обращение: продажи vs поддержка);</li>
<li><strong>квалификацию</strong> (целевой ли клиент);</li>
<li><strong>скоринг</strong> (насколько срочно и вероятно закрытие).</li>
</ul>
<p>Nero Network в <strong>настройке ai квалификация лидов</strong> фиксирует все три слоя в ТЗ, чтобы <strong>ai воронка продаж</strong> в CRM не превращалась в хаотичный набор тегов.</p>
<p><strong>Коротко:</strong> если вам нужен только балл без диалога — возможен старт с ML при наличии истории. Если лиды приходят «пустыми» с сайта и мессенджеров — без LLM-агента скоринг будет гадать по одному email.</p>
    </div>
  </section>
  <section class="akl-section" id="etapy-vnedreniya">
    <div class="akl-cnt nero-ai-reveal">
      <span class="akl-eyebrow">Под ключ</span>
<h2>Внедрение AI-квалификации лидов под ключ: этапы и сроки</h2>
<p><strong>Внедрение ai квалификация лидов под ключ</strong> в Nero Network — это не покупка «коробочного бота», а проект с диагностикой, матрицей, пилотом и передачей в эксплуатацию отделу.</p>
<p>Ориентиры сроков по рынку РФ: <strong>3–6 недель</strong> на типовой проект; <strong>2–8 недель</strong> на первый контур в amoCRM (кейс MrBoro). Ниже — этапы, которые мы проходим с клиентом.</p>
<h3>Аудит воронки и источников лидов</h3>
<p><strong>3–5 рабочих дней</strong> на старте:</p>
<ul>
<li>карта каналов: сайт, формы, Telegram, WhatsApp, VK, телефония;</li>
<li>текущие стадии CRM и поля (что реально заполняют менеджеры);</li>
<li>SLA первого ответа и фактическая задержка;</li>
<li>критерии «целевой / нецелевой» от РОПа, анти-портрет клиента;</li>
<li>20–50 примеров «хороших» и «плохих» лидов для обучения промптов.</li>
</ul>
<p>Результат этапа — согласованная схема «канал → агент → CRM → менеджер» и список интеграций.</p>
<h3>Обучение модели / промптов на ваших критериях</h3>
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
    <p class="ym-cta-block__sub">Перед внедрением квалификации полезно разобраться в промптах, human-in-the-loop и интеграции с CRM — так быстрее согласовать матрицу с РОПом. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
  </div>
</aside>
<p>На основе <strong>Матрицы квалификации лидов</strong> (лид-магнит проекта) формируем:</p>
<ul>
<li>сценарии вопросов (3–7 шагов, как у NOVA для amoCRM: <a href="https://nova-amocrm.ru/articles/ai-agent-qualification-amocrm" target="_blank" rel="noopener noreferrer">статья</a>);</li>
<li>JSON-схему статуса для LLM;</li>
<li>hard filters: регион, минимальный чек, запрещённые услуги;</li>
<li>тексты согласия на обработку ПДн <strong>до</strong> сбора телефона (требование 152-ФЗ; см. FAQ).</li>
</ul>
<p>Правило из практики интеграторов: <strong>квалифицирован</strong> = заполнено N из M обязательных полей + валидный контакт.</p>
<h3>Пилот и масштабирование</h3>
<p>Рекомендуемый порядок:</p>
<ol>
<li><strong>Пилот на одном канале</strong> (часто Telegram или виджет сайта).</li>
<li>Замер: доля статусов, время до первого ответа, override РОПа, жалобы.</li>
<li>Тираж на остальные каналы, подключение телефонии (транскрибация → квалификация).</li>
<li>Обучение отдела: когда доверять статусу, когда перепроверять.</li>
</ol>
<p><strong>Разработка ai квалификация лидов</strong> в смысле кастомного контура оправдана, когда встроенного AI CRM не хватает: несколько CRM, 1С, жёсткая матрица из четырёх статусов, очереди, аудит, обход лимитов webhook. В amoCRM на тарифе «Профессиональный и выше» уже есть нативные AI-агенты (<a href="https://new.amocrm.ru/ai-agent" target="_blank" rel="noopener noreferrer">официальная страница</a>) — мы честно разделяем сценарии «хватает платформы» и «нужен свой контур».</p>
<div class="ym-cta-block ym-cta-block--primary" id="cta-matrica">
  <div class="ym-cta-block__icon" aria-hidden="true">🎯</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получить карту квалификации лидов</p>
    <p class="ym-cta-block__sub">Соберём матрицу под вашу нишу: критерии → статус (горячий / тёплый / холодный / нецелевой) → действие в CRM и черновик сценария вопросов. Ориентир пилота и бюджета в вилке 150–450 тыс. ₽ — без навязанных «коробок».</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>
    </div>
  </section>
  <section class="akl-section akl-section-alt" id="crm">
    <div class="akl-cnt nero-ai-reveal">
<h2>Интеграция с CRM и AI-воронка продаж</h2>
<p><strong>Интеграция ai квалификация лидов с crm</strong> — обязательная часть услуги: статус без поля в карточке не существует для отдела продаж.</p>
<h3>Передача статуса и полей в amoCRM, Bitrix24, HubSpot, 1С</h3>
<p>Типовой набор действий API:</p>
<ul>
<li>кастомное поле «Статус AI» (горячий / тёплый / холодный / нецелевой);</li>
<li>теги и стадия сделки;</li>
<li>примечание со <strong>summary</strong> диалога для менеджера;</li>
<li>задача с дедлайном по SLA.</li>
</ul>
<p>Для <strong>Bitrix24</strong> критична асинхронная схема из-за лимита ответа webhook (~3 с) — иначе интеграция «падает» под нагрузкой (см. кейс Velmi на Habr). Для <strong>amoCRM</strong> часто используют связку с телефонией UIS и запись диалога в примечание (кейс MrBoro). <strong>HubSpot</strong> удобен для экспортных процессов со статусами агента. <strong>1С</strong> подключается, когда квалификация должна влиять на учёт или передачу заказа — это отдельный слой адаптера в ТЗ.</p>
<p><strong>AI для crm</strong> в маркетинговых текстах иногда продают как «магию в одной кнопке». На практике выигрывает связка: <strong>каналы + агент + дисциплина полей + отчёт для РОПа</strong>.</p>
<h3>Триггеры для менеджера и приоритет очереди</h3>
<p>После <strong>автоматизации через ai квалификация лидов</strong> воронка перестаёт быть «лавиной одинаковых задач»:</p>
<ul>
<li>горячий → push/звонок ответственному, короткий SLA;</li>
<li>тёплый → задача в рабочее время + шаблон КП;</li>
<li>холодный → цепочка в marketing automation;</li>
<li>нецелевой → закрытие с причиной для аналитики (откуда приходит мусор).</li>
</ul>
<p>Salesforce в блоге про agentic qualification отмечает: классический scoring historically оставлял без follow-up большую долю лидов — порядка <strong>одного из четырёх</strong> получал продолжение работы; агенты помогают <strong>масштабно возвращать «холодных»</strong> без перегрузки reps (<a href="https://www.salesforce.com/ap/blog/ai-for-lead-qualification/" target="_blank" rel="noopener noreferrer">материал</a>). Для вашей базы это отдельный сценарий после запуска входящего контура.</p>
    </div>
  </section>
  <section class="akl-section" id="keis">
    <div class="akl-cnt nero-ai-reveal">
      <span class="akl-eyebrow">Кейсы</span>
<h2>Кейс и пример внедрения AI-квалификации лидов</h2>
<p>Ниже — <strong>примеры внедрения ai</strong> из открытых источников (РФ и мир), на которые опирается методология Nero Network. Это не выдуманные «наши цифры», а референсы для ожиданий и архитектуры.</p>
<p><strong>Россия:</strong></p>
<ol>
<li><strong>Velmi + Bitrix24</strong> — агент квалификации, очередь, GPT; метрики в статье: ответ <strong>30–40 с</strong>, <strong>+35%</strong> квалифицированных лидов (<a href="https://habr.com/ru/articles/1045026/" target="_blank" rel="noopener noreferrer">Habr</a>).</li>
<li><strong>Беспалов Авто</strong> — дожим неполных лидов с сайта в Telegram, Bitrix24; до <strong>40%</strong> экономии времени на первичке (<a href="https://zharikovconsulting.ru/cases/bespalovavto-ai" target="_blank" rel="noopener noreferrer">кейс</a>).</li>
<li><strong>MrBoro + amoCRM</strong> — 4–6 критериев, секунды vs часы на ответ (<a href="https://mrboroai.ru/cases/ai-agent-lead-qualification-amocrm" target="_blank" rel="noopener noreferrer">кейс</a>).</li>
<li><strong>workspace.ru</strong> — классификация обращений и маршрутизация в Bitrix24 с human approval (<a href="https://workspace.ru/cases/ai-sistema-kvalifikacii-obrascheniy-i-avtomaticheskoy-marshrutizacii-v-bitrix24/" target="_blank" rel="noopener noreferrer">кейс</a>).</li>
</ol>
<p><strong>Международный контекст:</strong> Salesforce State of Sales 2026, Einstein scoring, HubSpot Customer Agent, Drift CQL — см. блок исследования в пайплайне.</p>
<h3>Метрики до/после (структура — без выдуманных цифр)</h3>
<p>Для вашего пилота фиксируем <strong>одинаковый набор KPI</strong> до и после:</p>
<div class="akl-table-wrap"><table class="akl-table">
<tr><th>Метрика</th><th>Зачем</th></tr>
<tr><td>Время до первого ответа</td><td>Speed-to-lead</td></tr>
<tr><td>Доля лидов с заполненными ключевыми полями</td><td>Качество CRM</td></tr>
<tr><td>Распределение по 4 статусам</td><td>Нагрузка на отдел</td></tr>
<tr><td>% override статуса РОПом</td><td>Качество AI</td></tr>
<tr><td>Конверсия лид → встреча / сделка</td><td>Бизнес-результат</td></tr>
<tr><td>Часы менеджеров на первичку</td><td>ROI проекта</td></tr>
</table></div>
<p>Конкретные проценты роста зависят от ниши; в публичных кейсах выше приведены <strong>заявления интеграторов и клиентов</strong> — мы используем их как ориентиры при проектировании, а не как обещание в договоре.</p>
<p><strong>Пример внедрения ai квалификация лидов</strong> для <strong>ai квалификация лидов для бизнеса</strong> среднего масштаба: агентство услуг, 80–150 входящих лидов в месяц, amoCRM, Telegram + форма на сайте. Пилот 3 недели на Telegram, матрица из 4 статусов, поле в сделке, обучение 8 менеджеров читать summary. Далее — тираж на форму и отчёт Metabase для РОПа.</p>
    </div>
  </section>
  <section class="akl-section" id="cena">
    <div class="akl-cnt nero-ai-reveal">
      <span class="akl-eyebrow">Бюджет</span>
<h2>Стоимость внедрения: из чего складывается цена</h2>
<p>Запрос <strong>ai квалификация лидов цена</strong> логичен: бюджет нужно согласовать до старта. Ориентир чека по коммерческой матрице Nero Network для этой услуги: <strong>150–450 тыс. ₽</strong> в зависимости от сложности (каналы, CRM, ML-слой, телефония, compliance).</p>
<p>На стоимость влияют:</p>
<div class="akl-table-wrap"><table class="akl-table">
<tr><th>Фактор</th><th>Влияние на бюджет</th></tr>
<tr><td>Количество каналов (сайт, мессенджеры, звонки)</td><td>Каждый канал — сценарий и тесты</td></tr>
<tr><td>CRM и количество интеграций</td><td>amoCRM / Bitrix24 / связка с 1С</td></tr>
<tr><td>LLM vs правила vs ML</td><td>ML требует подготовки данных</td></tr>
<tr><td>Требования 152-ФЗ и хостинг в РФ</td><td>YandexGPT / GigaChat, договор поручения</td></tr>
<tr><td>Панель метрик и обучение отдела</td><td>Часы аналитики и воркшопы</td></tr>
</table></div>
<p>Для сравнения: на рынке встречаются предложения интеграторов от <strong>~69–279 тыс. ₽</strong> за sales-AI контур (NeuralOps, публичная страница) и пакеты <strong>280–980 тыс. ₽</strong> у студий с голосовым агентом (<a href="https://neuralops.ru/sales-ai" target="_blank" rel="noopener noreferrer">пример сегмента</a>). <strong>AI-квалификация лидов для малого бизнеса</strong> часто начинается с одного канала и упрощённой матрицы — чтобы уложиться в нижнюю часть вилки без потери смысла статусов.</p>
<p>ROI считают не от «магии нейросети», а от <strong>часов менеджеров</strong> и <strong>потерянных горячих</strong> из-за медленного ответа. Один не пойманный в срок B2B-лид с чеком проекта может стоить дороже пилота.</p>
<div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы к четырём статусам и измеримой очереди?</p>
    <p class="ym-cta-block__sub">Следующий шаг — матрица квалификации и пилот на одном канале (часто Telegram). Обсудим CRM, compliance 152-ФЗ и ориентир бюджета 150–450 тыс. ₽.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить карту квалификации</a>
      <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">FAQ по внедрению →</a>
    </div>
  </div>
</div>
    </div>
  </section>
  <section class="akl-section akl-section-alt" id="faq">
    <div class="akl-cnt nero-ai-reveal">
      <span class="akl-eyebrow">FAQ</span>
<h2>FAQ: как внедрить, для кого подходит, риски</h2>
<h3>Как внедрить ai квалификация лидов, если CRM уже перегружена полями?</h3>
<p>Начните с <strong>одного</strong> статусного поля и примечания summary. Не плодите десять новых атрибутов. На аудите согласуем минимальный набор, который РОП реально смотрит в списке сделок.</p>
<h3>AI-квалификация лидов для малого бизнеса — имеет смысл?</h3>
<p>Да, если есть <strong>поток</strong> входящих (от ~30–50 в месяц) и хотя бы один менеджер тонет в первичке. При единичных заявках проще начать с матрицы на бумаге и скрипта; при росте — пилот на Telegram.</p>
<h3>Ошибки ложных «горячих» лидов</h3>
<p>Риск №1 для репутации отдела. Снижается порогами confidence, запретом автокоммитов по цене, выборочным аудитом и логированием промптов. Gartner в аннотациях 2026 года отдельно подчёркивает необходимость <strong>guardrails</strong> для AI SDR (<a href="https://www.gartner.com/en/documents/8374649" target="_blank" rel="noopener noreferrer">документ</a>).</p>
<h3>Персональные данные заявок (152-ФЗ)</h3>
<p>В боте и на форме: согласие не предустановлено, ссылка на политику <strong>до</strong> телефона/email, фиксация версии текста, договор поручения с облачным LLM при необходимости (<a href="https://mintrud.gov.ru/docs/laws/130" target="_blank" rel="noopener noreferrer">152-ФЗ</a>, <a href="https://bnlegal.ru/stati/obrabotka-pd-crm-i-servisy/" target="_blank" rel="noopener noreferrer">практика CRM</a>). Nero Network закладывает compliance в ТЗ, а не «после запуска».</p>
<h3>Заменит ли AI менеджеров?</h3>
<p>Нет. Агент забирает <strong>первичку и рутину</strong>; переговоры, нестандартные сделки, юридически значимые формулировки и закрытие — у человека. В материале Salesforce CEO Marc Benioff приводит масштаб проблемы: порядка <strong>100 млн</strong> лидов за годы без обратной связи из-за нехватки людей — агенты закрывают <strong>масштаб</strong>, а не замену экспертизы (<a href="https://www.salesforce.com/ap/blog/ai-for-lead-qualification/" target="_blank" rel="noopener noreferrer">блог</a>).</p>
<h3>У нас уже есть чат-бот</h3>
<p>Бот, который отвечает на FAQ, <strong>не равен</strong> квалификации: без матрицы статусов и записи в CRM менеджер всё равно начинает с нуля.</p>
<h3>Какие CRM поддерживаются?</h3>
<p>Типовой фокус: <strong>amoCRM, Bitrix24, HubSpot</strong>; при необходимости — связка с <strong>1С</strong>, телефонией (UIS, Mango), формами Tilda/WordPress, мессенджерами.</p>
    </div>
  </section>
  <section class="akl-section akl-geo" id="geo">
    <div class="akl-cnt nero-ai-reveal">
<h2>Кратко: что такое AI-квалификация лидов (GEO-блок)</h2>
<p><strong>AI-квалификация лидов</strong> — это автоматическая первичная оценка входящего обращения с помощью правил, ML или LLM-агента <strong>до</strong> участия менеджера: система уточняет данные, сопоставляет их с критериями целевого клиента и присваивает лиду <strong>статус и приоритет</strong> (например: горячий, тёплый, холодный, нецелевой) с записью в CRM. Цель — ускорить первый ответ, снизить долю нецелевых диалогов и выстроить <strong>ai воронка продаж</strong> с понятной очередью для отдела.</p>
<p><strong>Итог:</strong> это <strong>внедрение ai в бизнес процессы</strong> продаж на стыке маркетинга и CRM, а не отдельная «нейросеть в чате».</p>
    </div>
  </section>
</div>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.akl-content');
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


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Article",
      "headline": "AI-квалификация лидов: внедрение и настройка под ключ",
      "description": "Внедрим AI-квалификацию лидов: статус горячий, тёплый, холодный или нецелевой до передачи менеджеру. Интеграция с CRM, настройка под B2B.",
      "inLanguage": "ru-RU",
      "about": {
        "@type": "Thing",
        "name": "AI-квалификация лидов"
      }
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "AI-квалификация лидов для малого бизнеса — имеет смысл?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, если есть поток входящих от ~30–50 в месяц и менеджер тонет в первичке. При единичных заявках начните с матрицы на бумаге; при росте — пилот на Telegram."
          }
        },
        {
          "@type": "Question",
          "name": "Как внедрить ai квалификация лидов, если CRM уже перегружена полями?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Начните с одного статусного поля и примечания summary. На аудите согласуем минимальный набор полей, который РОП реально смотрит в списке сделок."
          }
        },
        {
          "@type": "Question",
          "name": "Заменит ли AI менеджеров?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Нет. Агент забирает первичку и рутину; переговоры, нестандартные сделки и закрытие остаются у человека."
          }
        }
      ]
    },
    {
      "@type": "Organization",
      "name": "Nero Network",
      "description": "Внедрение AI-квалификации и скоринга лидов под ключ: интеграция с CRM, матрица статусов, пилот.",
      "areaServed": "RU",
      "serviceType": [
        "AI-квалификация лидов",
        "Lead scoring",
        "Интеграция AI с CRM"
      ]
    }
  ]
}
</script>


</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

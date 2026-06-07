<?php
/**
 * Template Name: AI-обработка входящей почты в CRM: внедрение под ключ
 * Description: SEO-лендинг — AI-обработка входящей почты в CRM. Кейсы, интеграции, цены. Аудит почты бесплатно.
 */

$page_seo_title       = 'AI-обработка входящей почты в CRM: внедрение под ключ';
$page_seo_description = 'Внедряем AI для обработки входящей почты: классификация писем, извлечение данных, создание сделок в CRM. Кейсы, интеграции, цены. Аудит почты бесплатно.';

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


$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: '');
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Разобрать вашу почту';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#cta';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#kak-rabotaet';

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

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
/* Kadence reset + breadcrumbs hide */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

/* ── Hero email→CRM: самодостаточные стили (без CSS темы) ── */
.vnec-hero-email-crm {
  --vnec-cyan: #79f2ff;
  --vnec-violet: #8b5cf6;
  --vnec-green: #22c55e;
  --vnec-text: #e6edf7;
  --vnec-muted: #9aa8bd;
  --vnec-soft: #c7d2e5;
  --vnec-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnec-hero-email-crm.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnec-hero-email-crm::before {
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
.vnec-hero-email-crm::after {
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
  animation: vnecHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnecHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vnec-hero-email-crm .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnec-hero-email-crm .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnec-hero-email-crm .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnec-hero-email-crm .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnec-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnec-hero-email-crm .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnec-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnec-hero-email-crm .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnec-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnec-hero-email-crm .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnec-hero-email-crm .nero-ai-badge {
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
.vnec-hero-email-crm .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnec-hero-email-crm .nero-ai-btn {
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
.vnec-hero-email-crm .nero-ai-btn:hover { transform: translateY(-2px); }
.vnec-hero-email-crm .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnec-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnec-hero-email-crm .nero-ai-btn-secondary {
  color: var(--vnec-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnec-hero-email-crm .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnec-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnec-hero-email-crm .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnec-hero-email-crm .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnec-hero-email-crm .nero-ai-dots { display: flex; gap: 7px; }
.vnec-hero-email-crm .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnec-hero-email-crm .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnec-hero-email-crm .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnec-hero-email-crm .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnec-hero-email-crm .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnec-hero-email-crm .nero-ai-window-body { padding: 16px; }
.vnec-hero-email-crm .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vnec-hero-email-crm .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnec-hero-email-crm .nero-ai-live-pill {
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
.vnec-hero-email-crm .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnecPulse 1.6s infinite;
}
@keyframes vnecPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnec-hero-email-crm .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnec-hero-email-crm .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnec-hero-email-crm .nero-ai-metric span {
  display: block;
  color: var(--vnec-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnec-hero-email-crm .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnec-hero-email-crm .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnec-hero-email-crm .vnec-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 40%, rgba(121,242,255,.08), rgba(6,10,24,.9) 70%);
}
.vnec-hero-email-crm #vnec-inbox-crm-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnec-hero-email-crm .nero-ai-task-stream {
  display: grid;
  gap: 8px;
}
.vnec-hero-email-crm .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnec-hero-email-crm .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vnec-cyan);
  font-size: 13px;
  font-weight: 800;
}
.vnec-hero-email-crm .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnec-hero-email-crm .nero-ai-task span {
  color: var(--vnec-muted);
  font-size: 11px;
}
.vnec-hero-email-crm .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnec-hero-email-crm .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vnec-hero-email-crm .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnec-hero-email-crm .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vnec-hero-email-crm .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnec-hero-email-crm .nero-ai-window-body { padding: 12px; }
  .vnec-hero-email-crm .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnec-hero-email-crm .nero-ai-status { grid-column: 2; width: fit-content; }
}

/* VNEC content root */
.vnec-content{
  --vnec-bg:#050711;--vnec-bg2:#080b17;--vnec-surface:rgba(255,255,255,.072);
  --vnec-text:#e6edf7;--vnec-muted:#9aa8bd;--vnec-soft:#c7d2e5;--vnec-heading:#fff;
  --vnec-border:rgba(255,255,255,.10);--vnec-accent:#79f2ff;--vnec-violet:#8b5cf6;--vnec-green:#22c55e;
  --vnec-btn-from:#2563eb;--vnec-btn-to:#7c3aed;--vnec-r:18px;--vnec-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnec-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vnec-content *,.vnec-content *::before,.vnec-content *::after{box-sizing:border-box}
.vnec-content a{color:inherit}
.vnec-content p{color:var(--vnec-muted);line-height:1.72;margin:0 0 1em}
.vnec-content p:last-child{margin-bottom:0}
.vnec-content h2,.vnec-content h3,.vnec-content h4{color:var(--vnec-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vnec-content strong{color:var(--vnec-soft)}
.vnec-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vnec-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vnec-muted);font-size:14.5px;line-height:1.65}
.vnec-content ul li::before{content:'›';position:absolute;left:0;color:var(--vnec-accent);font-weight:700}
.vnec-cnt{width:min(var(--vnec-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vnec-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vnec-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vnec-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vnec-sh.vnec-left{margin-left:0;text-align:left}
.vnec-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vnec-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vnec-sh.vnec-left p{margin-left:0}
.vnec-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnec-accent);margin-bottom:14px}
.vnec-gt{background:linear-gradient(92deg,#fff 0%,var(--vnec-accent) 44%,var(--vnec-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.vnec-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vnec-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vnec-intro-text{position:relative;padding-left:20px}
.vnec-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vnec-accent),var(--vnec-violet))}
.vnec-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vnec-muted);margin-bottom:1em}
.vnec-intro-text p:last-child{margin-bottom:0;color:var(--vnec-soft)}
.vnec-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vnec-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.vnec-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vnec-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vnec-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnec-muted);line-height:1.4}
.vnec-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vnec-intro-grid{grid-template-columns:1fr;gap:36px}.vnec-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vnec-intro-kpi{grid-template-columns:1fr 1fr}}
.vnec-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vnec-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vnec-toc a{display:inline-block;padding:9px 18px;background:var(--vnec-surface);border:1px solid var(--vnec-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vnec-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vnec-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vnec-accent);background:rgba(121,242,255,.08)}
.vnec-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vnec-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.vnec-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.vnec-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vnec-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.vnec-grid-2,.vnec-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.vnec-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vnec-grid-3{grid-template-columns:1fr}}
.vnec-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vnec-table{width:100%;border-collapse:collapse;font-size:14px}
.vnec-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vnec-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.vnec-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vnec-text);vertical-align:top}
.vnec-table tr:last-child td{border-bottom:none}
.vnec-table tr:hover td{background:rgba(255,255,255,.03)}
.vnec-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vnec-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vnec-accent);border:1px solid rgba(121,242,255,.2)}
.vnec-flow .arr{color:var(--vnec-muted);font-size:16px;padding:0 4px;background:none;border:none}
.vnec-timeline{position:relative;padding-left:40px}
.vnec-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vnec-accent),var(--vnec-violet));opacity:.35;border-radius:2px}
.vnec-tl-item{position:relative;margin-bottom:32px}
.vnec-tl-item:last-child{margin-bottom:0}
.vnec-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vnec-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vnec-tl-item h3{font-size:17px;margin-bottom:8px}
.vnec-tl-item p{font-size:14.5px;margin:0}
.vnec-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vnec-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vnec-case-grid{grid-template-columns:1fr}}
.vnec-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.vnec-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.vnec-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnec-green);margin-bottom:10px}
.vnec-case-card h3{font-size:16px;margin-bottom:14px}
.vnec-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px}
.vnec-metric .num{font-size:20px;font-weight:900;color:var(--vnec-accent);flex-shrink:0}
.vnec-metric .lbl{font-size:13px;color:var(--vnec-muted)}
.vnec-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vnec-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vnec-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnec-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.vnec-faq-q::after{content:'▾';font-size:13px;color:var(--vnec-accent);flex-shrink:0;transition:transform .25s}
.vnec-faq-item.open .vnec-faq-q::after{transform:rotate(180deg)}
.vnec-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vnec-muted);line-height:1.72}
.vnec-faq-item.open .vnec-faq-a{max-height:800px;padding:0 24px 20px}
.vnec-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.vnec-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--vnec-muted)}
.vnec-cta-checklist li::before{content:'✓';color:var(--vnec-green);font-weight:800}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vnec-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--vnec-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vnec-btn-from),var(--vnec-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
/* === БОРИС: prefix bec-, scoped внутри #vnedrenie-ai-obrabotka-email-crm-boris-block === */
#vnedrenie-ai-obrabotka-email-crm-boris-block.bec-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-email-crm-boris-block .bec-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-email-crm-boris-block .bec-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0ea5e9;
  margin:0 0 14px;
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0ea5e9;
  border-radius:1px;
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(14,165,233,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0284c7;
  margin-top:1px;
  font-style:normal;
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-obrabotka-email-crm-boris-block .bec-rgt{
  position:relative;
  background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 45%,#f8fafc 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-email-crm-boris-block .bec-rgt{min-height:360px;}
}
#bec-email-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}

</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-obrabotka-email-crm-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnec-hero-email-crm" id="vnec-hero-email-crm" aria-labelledby="vnec-hero-title">
<div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">CRM / email · внедрение под ключ</p>
      <h1 id="vnec-hero-title">AI-обработка входящей почты и заявок в CRM: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть классифицирует письма, извлекает данные и создаёт сделки в CRM — без потерянных заявок и ручного переноса</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Классификация писем</li>
        <li class="nero-ai-badge">Извлечение полей</li>
        <li class="nero-ai-badge">amoCRM / Битрикс24</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="#cta">Разобрать вашу почту</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-обработки входящей почты">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Почтовый мост → CRM</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Входящих сегодня</span>
              <strong>47</strong>
              <small>sales@ + info@</small>
            </div>
            <div class="nero-ai-metric">
              <span>Классифицировано AI</span>
              <strong>94%</strong>
              <small>без ручной сортировки</small>
            </div>
            <div class="nero-ai-metric">
              <span>До сделки в CRM</span>
              <strong>42 сек</strong>
              <small>письмо → карточка</small>
            </div>
            <div class="nero-ai-metric">
              <span>Потерянных заявок</span>
              <strong>0</strong>
              <small>за сегодня</small>
            </div>
          </div>

          <div class="vnec-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnec-inbox-crm-canvas" role="img" aria-label="Анимация: письма по орбитам классифицируются AI и превращаются в сделки CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий почты">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✉</span>
              <div><strong>sales@: заявка на КП</strong><span>Класс: коммерция · confidence 0.96</span></div>
              <span class="nero-ai-status">сделка</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">PDF</span>
              <div><strong>Вложение: счёт-фактура</strong><span>Извлечено 8 полей NER</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↳</span>
              <div><strong>info@: вопрос по доставке</strong><span>Маршрут: поддержка → задача</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⊘</span>
              <div><strong>Спам отфильтрован</strong><span>3 письма не попали в CRM</span></div>
              <span class="nero-ai-status">отсечено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vnec-content">

  <section class="vnec-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vnec-cnt">
      <div class="vnec-intro-grid nero-ai-reveal">
        <div class="vnec-intro-text">
          <p class="vnec-eyebrow">Лонгрид · AI email → CRM</p>
          <p>Входящая почта — один из самых старых и самых «дырявых» каналов продаж. Клиент пишет на sales@ или info@, менеджер видит письмо через час, копирует телефон в CRM, забывает про вложение — и заявка уходит конкуренту. <strong>AI-обработка входящей почты и заявок в CRM</strong> закрывает этот разрыв: нейросеть классифицирует письма, извлекает данные и создаёт сделки или задачи без ручного переноса.</p>
          <p><strong>Коротко:</strong> Nero Network внедряет связку «почтовый канал → AI-оркестратор → CRM API» под ключ — от аудита ящика до пилота на одном sales@. Ориентир по бюджету: <strong>120–300 тыс. ₽</strong>. Первый шаг — <strong>«Разобрать вашу почту»</strong>: бесплатный разбор 50–100 последних писем и <strong>Карта автоматизации входящей почты</strong>.</p>
        </div>
        <div class="vnec-intro-kpi" aria-label="Ключевые метрики email-triage">
          <div class="vnec-kpi-card"><div class="kv">47 ч</div><div class="kl">среднее время ответа B2B</div><div class="ks">Optifai, 2025–2026</div></div>
          <div class="vnec-kpi-card"><div class="kv">32%</div><div class="kl">close rate при ответе &lt;5 мин</div><div class="ks">vs 12% при задержке</div></div>
          <div class="vnec-kpi-card"><div class="kv">82%</div><div class="kl">автообработка email-заказов</div><div class="ks">GT Golf, 2026</div></div>
          <div class="vnec-kpi-card"><div class="kv">0</div><div class="kl">потерянных заявок в пилоте</div><div class="ks">цель Nero Network</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vnec-toc-outer">
    <div class="vnec-cnt">
      <nav class="vnec-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Аудит почты</a>
      </nav>
    </div>
  </div>

  <section class="vnec-section" id="zachem">
    <div class="vnec-cnt">
      <div class="vnec-sh vnec-left nero-ai-reveal">
        <span class="vnec-eyebrow">Зачем бизнесу</span>
        <h2>Зачем бизнесу AI-обработка входящей почты и заявок в CRM</h2>
        <p><strong>Определение.</strong> AI-обработка email в CRM — автоматизация, при которой нейросеть выполняет бизнес-логику: тип обращения, поля из текста, маршрутизация по отделу, лид или задача в CRM.</p>
      </div>
      <p class="vnec-related nero-ai-reveal" style="margin-top:20px;font-size:15px">Когда входящий поток идёт не только из почты, но и из звонков и мессенджеров внутри CRM, полезно сравнить сценарии: <a href="/vnedrenie-ai-amocrm/" style="color:var(--vnec-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a> — соседняя посадочная про автоматизацию сделок и задач в amoCRM без ручного переноса данных.</p>
      <div class="vnec-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="vnec-card">
          <h3>Почему письма теряются</h3>
          <ul>
            <li>Общий ящик sales@ — важное тонет в рассылках без <strong>ai сортировки почты</strong></li>
            <li>Ручной копипаст: 3–7 мин на письмо; в C.H. Robinson — до 7 мин и очередь 4 часа</li>
            <li>Нестандартный формат: свободный текст, PDF, цепочки писем</li>
            <li>Нет SLA: 12–18% лидов с sales@ теряются до AI-классификации</li>
          </ul>
        </div>
        <div class="vnec-card">
          <h3>ROI: меньше ручной сортировки</h3>
          <div class="vnec-table-wrap">
            <table class="vnec-table" aria-label="Метрики до и после AI email automation">
              <thead><tr><th>Метрика</th><th>До</th><th>После AI</th></tr></thead>
              <tbody>
                <tr><td>Triage письма</td><td>3–7 мин</td><td>секунды – 1 мин</td></tr>
                <tr><td>Ответ на лид</td><td>4–47 ч</td><td>&lt;15 мин – 1 ч</td></tr>
                <tr><td>Автообработка</td><td>0%</td><td>70–82%</td></tr>
              </tbody>
            </table>
          </div>
          <p style="margin-top:14px;font-size:14px">Кейс <strong>СТЕК</strong>: время обработки −70%; <strong>Bell Direct</strong>: +20% efficiency, 2 FTE высвобождено.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vnec-section vnec-section-alt" id="kak-rabotaet">
    <div class="vnec-cnt">
      <div class="vnec-sh nero-ai-reveal">
        <span class="vnec-eyebrow">Пайплайн</span>
        <h2>Как работает AI-обработка email: от письма до сделки</h2>
        <p><strong>Коротко:</strong> новое письмо → препроцессинг → AI-классификация и NER → ветвление по confidence → запись в CRM или очередь human-in-the-loop.</p>
      </div>
      <div class="vnec-flow nero-ai-reveal" aria-label="Схема потока обработки почты">
        <span>Входящее письмо</span><span class="arr">→</span>
        <span>Препроцессинг</span><span class="arr">→</span>
        <span>AI: классификация + NER</span><span class="arr">→</span>
        <span>confidence ≥ порог?</span><span class="arr">→</span>
        <span>Сделка в CRM</span>
      </div>
    </div>

<section id="vnedrenie-ai-obrabotka-email-crm-boris-block" class="bec-root" aria-label="Анимация: AI-классификация входящей почты и создание сделки в CRM">
<div class="bec-cnt">
  <div class="bec-card">

    <div class="bec-lft">
      <span class="bec-ey">Пайплайн в действии</span>
      <h3 class="bec-h3">От входящего письма до карточки CRM — за секунды, не часы</h3>
      <ul class="bec-ul">
        <li><span class="bec-ic">1</span>AI определяет намерение: заявка, поддержка, счёт или спам</li>
        <li><span class="bec-ic">2</span>NER извлекает имя, телефон, сумму и номенклатуру из текста</li>
        <li><span class="bec-ic">3</span>При высокой уверенности — автосоздание сделки в CRM</li>
        <li><span class="bec-ic">?</span>Низкий confidence — очередь «Неразобранное AI» для менеджера</li>
      </ul>
      <div class="bec-pills">
        <span class="bec-pl bec-pl-g">7 мин → &lt;1 мин</span>
        <span class="bec-pl bec-pl-b">82% автообработка</span>
        <span class="bec-pl bec-pl-v">human-in-the-loop</span>
      </div>
      <p class="bec-foot">Дальше разберём классы писем и правила маршрутизации →</p>
    </div>

    <div class="bec-rgt">
      <canvas
        id="bec-email-pipeline-canvas"
        aria-label="Анимация: входящие письма классифицируются AI, поля извлекаются и формируют карточку сделки в CRM"
        role="img"
      ></canvas>
    </div>

  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bec-email-pipeline-canvas');
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
    mail:'#ffffff',
    mailBdr:'#cbd5e1',
    ai:'#8b5cf6',
    aiGlow:'rgba(139,92,246,.25)',
    laneSale:'#22c55e',
    laneSup:'#3b82f6',
    laneDoc:'#f59e0b',
    laneSpam:'#94a3b8',
    crm:'#0ea5e9',
    field:'#e0f2fe',
    fieldBdr:'#7dd3fc',
    line:'rgba(14,165,233,.35)',
    muted:'#64748b',
    text:'#1e293b'
  };

  var LANES = [
    {key:'sale', label:'Заявка', color:C.laneSale, y:0},
    {key:'sup',  label:'Поддержка', color:C.laneSup, y:0},
    {key:'doc',  label:'Счёт', color:C.laneDoc, y:0},
    {key:'spam', label:'Спам', color:C.laneSpam, y:0}
  ];

  function rr(ctx,x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  function drawMailIcon(ctx,x,y,s,rot){
    ctx.save();
    ctx.translate(x,y);
    ctx.rotate(rot||0);
    rr(ctx,-s*0.5,-s*0.35,s,s*0.7,4,C.mail,C.mailBdr);
    ctx.strokeStyle=C.mailBdr;
    ctx.lineWidth=1.2;
    ctx.beginPath();
    ctx.moveTo(-s*0.42,-s*0.22);
    ctx.lineTo(0,s*0.08);
    ctx.lineTo(s*0.42,-s*0.22);
    ctx.stroke();
    ctx.restore();
  }

  var emails = [];
  var fields = [];
  var crmCard = {alpha:0, fields:[]};
  var cycleT = 0;

  function spawnEmail(){
    var types = ['sale','sale','sup','doc','spam'];
    var type = types[Math.floor(Math.random()*types.length)];
    emails.push({
      x: -40,
      y: H*0.22 + Math.random()*H*0.12,
      type: type,
      phase: 0,
      speed: 1.2 + Math.random()*0.6,
      wobble: Math.random()*Math.PI*2
    });
  }

  function spawnField(lx, ly){
    var labels = ['Имя','Телефон','Сумма','Товар'];
    var vals = ['ООО Прогресс','+7 921…','150 тыс. ₽','Спец. заказ'];
    var i = fields.length % 4;
    fields.push({
      x: lx, y: ly,
      tx: W*0.78, ty: H*0.38 + i*28,
      label: labels[i], val: vals[i],
      t: 0, alpha: 0
    });
  }

  function drawAiHub(cx, cy, r, pulse){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*1.8);
    g.addColorStop(0, C.aiGlow);
    g.addColorStop(1, 'rgba(139,92,246,0)');
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(cx,cy,r*1.6,0,Math.PI*2);
    ctx.fill();

    rr(ctx,cx-r,cy-r,r*2,r*2,r*0.35,'#f5f3ff',C.ai);
    ctx.fillStyle = C.ai;
    ctx.font = 'bold ' + Math.max(11,r*0.22) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('AI', cx, cy-2);
    ctx.font = Math.max(9,r*0.14) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('классификация + NER', cx, cy+r*0.38);

    ctx.strokeStyle = C.ai;
    ctx.lineWidth = 2 + pulse*2;
    ctx.globalAlpha = 0.3 + pulse*0.4;
    ctx.beginPath();
    ctx.arc(cx,cy,r+6+pulse*8,0,Math.PI*2);
    ctx.stroke();
    ctx.globalAlpha = 1;
  }

  function drawLane(x, y, w, h, lane, count){
    rr(ctx,x,y,w,h,6,'rgba(255,255,255,.85)',lane.color);
    ctx.fillStyle = lane.color;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(lane.label, x+10, y+16);
    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.fillText(count + ' писем', x+10, y+h-8);
  }

  function drawCrmCard(x,y,w,h,alpha){
    if(alpha < 0.05) return;
    ctx.globalAlpha = alpha;
    rr(ctx,x,y,w,h,10,'#fff',C.crm);
    ctx.fillStyle = C.crm;
    ctx.font = 'bold 12px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Сделка в CRM', x+12, y+20);
    var rows = ['Имя: ООО Прогресс','Тел: +7 921…','Сумма: 150 000 ₽','Статус: Новая'];
    ctx.fillStyle = C.text;
    ctx.font = '10px system-ui,sans-serif';
    for(var i=0;i<rows.length;i++){
      rr(ctx,x+10,y+28+i*22,w-20,18,4,C.field,C.fieldBdr);
      ctx.fillText(rows[i], x+16, y+41+i*22);
    }
    ctx.globalAlpha = 1;
  }

  function tick(){
    frame++;
    cycleT++;
    if(frame % 90 === 0) spawnEmail();

    var hubX = W*0.42, hubY = H*0.48, hubR = Math.min(W,H)*0.09;
    var pulse = 0.5 + 0.5*Math.sin(frame*0.06);

    LANES.forEach(function(lane,i){
      lane.y = H*0.68 + i*(H*0.07);
    });

    ctx.clearRect(0,0,W,H);

    /* заголовок сцены */
    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Входящие', W*0.06, H*0.1);
    ctx.textAlign = 'right';
    ctx.fillText('CRM', W*0.94, H*0.1);

    /* стрелки потока */
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 2;
    ctx.setLineDash([6,4]);
    ctx.beginPath();
    ctx.moveTo(W*0.14, H*0.28);
    ctx.lineTo(hubX - hubR - 8, hubY);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(hubX + hubR + 8, hubY);
    ctx.lineTo(W*0.72, H*0.35);
    ctx.stroke();
    ctx.setLineDash([]);

    drawAiHub(hubX, hubY, hubR, pulse);

  var laneCounts = {sale:0,sup:0,doc:0,spam:0};

    emails = emails.filter(function(em){
      em.phase += em.speed;
      var targetLane = LANES.find(function(l){return l.key===em.type;});
      if(!targetLane) return false;

      if(em.phase < 120){
        em.x += em.speed*1.4;
        em.y += Math.sin(frame*0.08+em.wobble)*0.3;
      } else if(em.phase < 200){
        var dx = hubX - em.x, dy = hubY - em.y;
        em.x += dx*0.04;
        em.y += dy*0.04;
      } else if(em.phase < 280){
        var tx = W*0.22, ty = targetLane.y + 20;
        em.x += (tx-em.x)*0.05;
        em.y += (ty-em.y)*0.05;
        if(em.phase === 201 && em.type==='sale') spawnField(hubX, hubY);
      } else {
        laneCounts[em.type]++;
        return false;
      }
      drawMailIcon(ctx, em.x, em.y, 22, Math.sin(frame*0.05)*0.08);
      return true;
    });

    LANES.forEach(function(lane){
      drawLane(W*0.08, lane.y, W*0.28, H*0.055, lane, laneCounts[lane.key]||0);
    });

    fields = fields.filter(function(f){
      f.t += 0.025;
      f.alpha = Math.min(1, f.t*2);
      var ease = f.t*f.t*(3-2*f.t);
      var cx = f.x + (f.tx-f.x)*ease;
      var cy = f.y + (f.ty-f.y)*ease;
      ctx.globalAlpha = f.alpha;
      rr(ctx,cx-36,cy-10,72,20,5,C.field,C.fieldBdr);
      ctx.fillStyle = C.text;
      ctx.font = '9px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(f.label+': '+f.val, cx, cy+4);
      ctx.globalAlpha = 1;
      if(f.t >= 1){
        crmCard.alpha = Math.min(1, crmCard.alpha + 0.02);
        return false;
      }
      return true;
    });

    drawCrmCard(W*0.68, H*0.28, W*0.26, H*0.42, crmCard.alpha);

    if(cycleT > 520){
      cycleT = 0;
      emails = [];
      fields = [];
      crmCard.alpha = 0;
    }

    requestAnimationFrame(tick);
  }

  requestAnimationFrame(tick);
})();
</script>
</section>

  </section>

  <section class="vnec-section vnec-section-alt">
    <div class="vnec-cnt">
      <div class="vnec-sh vnec-left nero-ai-reveal">
        <h3 id="klassifikaciya">Классификация и маршрутизация входящих</h3>
        <p><strong>Ai сортировка почты</strong> определяет намерение и срочность. Типовые классы: коммерческая заявка, поддержка, счёт, партнёрство, спам, срочное (VIP).</p>
      </div>
      <div class="vnec-card nero-ai-reveal">
        <p>На выходе — JSON: <code>{intent, confidence, priority, suggested_owner, summary}</code>. Горячая заявка → воронка продаж и Telegram-алерт; поддержка → сервис; счёт → бухгалтерия. OpenAI Agents SDK (2026): <code>needs_approval</code> — пауза перед записью в CRM при низкой уверенности.</p>
      </div>

      <div class="vnec-sh vnec-left nero-ai-reveal" style="margin-top:48px">
        <h3 id="ner">Извлечение полей: имя, телефон, сумма, адрес</h3>
        <p><strong>Извлечение данных из писем ai</strong> (NER): контакты, коммерческие поля, контекст (дедлайн, тендер, договор).</p>
      </div>
      <div class="vnec-grid-2 nero-ai-reveal">
        <div class="vnec-card">
          <h3>Bestrank / Битрикс24 + YandexGPT</h3>
          <p>Письмо → бизнес-процесс → YandexGPT → поля лида и номенклатура. ~<strong>1 минута</strong> на письмо. «AI Кубики» извлекают товары из Excel и PDF.</p>
        </div>
        <div class="vnec-card">
          <h3>GT Golf (Gralio, США)</h3>
          <p>Заказы из email (PDF, Excel, фото) → NetSuite за <strong>&lt;30 сек</strong>. К марту 2026 — <strong>82%</strong> email-заказов автоматически.</p>
        </div>
      </div>

      <div class="vnec-sh vnec-left nero-ai-reveal" style="margin-top:48px">
        <h3 id="crm-zapis">Создание сделок, лидов и задач в CRM</h3>
      </div>
      <div class="vnec-table-wrap nero-ai-reveal">
        <table class="vnec-table" aria-label="Сравнение уровней автоматизации email">
          <thead><tr><th>Подход</th><th>Что умеет</th><th>Ограничения</th></tr></thead>
          <tbody>
            <tr><td>Ручная обработка</td><td>Любой формат</td><td>Медленно, нет SLA</td></tr>
            <tr><td>Штатный парсер amoCRM</td><td>Типовое письмо</td><td>Не понимает свободный текст</td></tr>
            <tr><td>CoPilot в Битрикс24</td><td>Суммаризация, черновик</td><td>Не создаёт сделки автоматически</td></tr>
            <tr><td><strong>AI-агент Nero Network</strong></td><td>Классификация, NER, сделка, HITL</td><td>Требует настройки потока</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;font-size:14.5px">Финальный шаг — <strong>ai входящие письма crm</strong>: <code>crm.lead.add</code> (Битрикс24), <code>POST /api/v4/leads</code> (amoCRM). При низком confidence — очередь «Неразобранное AI».</p>
    </div>
  </section>

  <section class="vnec-section" id="etapy">
    <div class="vnec-cnt">
      <div class="vnec-sh nero-ai-reveal">
        <span class="vnec-eyebrow">Под ключ</span>
        <h2>Внедрение AI обработки email под ключ: этапы и сроки</h2>
        <p>Проектная модель из трёх фаз: письмо → карточка в CRM с измеримым результатом.</p>
      </div>
      <div class="vnec-timeline nero-ai-reveal">
        <div class="vnec-tl-item">
          <div class="vnec-tl-dot"></div>
          <h3>Фаза 0 — «Разобрать вашу почту» (аудит)</h3>
          <p>50–100 писем, карта типов, оценка потерь, совместимость CRM. Артефакт — <strong>Карта автоматизации входящей почты</strong>. Бесплатно, без обязательств.</p>
        </div>
        <div class="vnec-tl-item">
          <div class="vnec-tl-dot"></div>
          <h3>Фаза 1 — Пилот (2–4 недели)</h3>
          <p>1 ящик, 2–3 класса писем, лиды в amoCRM/Битрикс24. JSON Schema, порог confidence, дашборд accuracy и «письмо → сделка».</p>
        </div>
        <div class="vnec-tl-item">
          <div class="vnec-tl-dot"></div>
          <h3>Фаза 2 — Прод</h3>
          <p>Вложения PDF/XLS, дедупликация Message-ID, SLA-алерты, обучение на правках менеджеров. Менеджеры — «редакторы», не копипастеры.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center">Менеджеры переходят от копипаста к звонкам и сделкам — как в кейсе СТЕК, где сотрудники стали редакторами ответов, а не искателями документации. <strong>Ai почтовый ассистент</strong> не заменяет продажи — убирает рутину triage.</p>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации сами?</p>
    <p class="ym-cta-block__sub">Если команда хочет понимать n8n, промпты и human-in-the-loop до старта проекта — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#'); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer">обучение по внедрению AI в бизнес-процессы</a>. Это помогает быстрее принимать решения на этапе пилота.</p>
  </div>
</aside>
    </div>
    <div class="vnec-cnt"><div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
  <div class="ym-cta-block__icon" aria-hidden="true">📬</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Разобрать вашу почту — бесплатно</p>
    <p class="ym-cta-block__sub">Выгрузим 50–100 последних писем, составим Карту автоматизации входящей почты и покажем, сколько заявок теряется между ящиком и CRM. Без обязательств.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn">Разобрать вашу почту</a>
  </div>
</div></div>
  </section>

  <section class="vnec-section vnec-section-alt" id="integracii">
    <div class="vnec-cnt">
      <div class="vnec-sh nero-ai-reveal">
        <span class="vnec-eyebrow">Стек</span>
        <h2>Интеграции почты и CRM</h2>
        <p><strong>Интеграция ai обработка email с crm</strong> — без надёжной записи в воронку AI остаётся «умным фильтром».</p>
      </div>
      <div class="vnec-grid-2 nero-ai-reveal">
        <div class="vnec-card">
          <h3>Gmail, Microsoft 365, Яндекс.Почта</h3>
          <p>IMAP, OAuth Gmail, Microsoft Graph, API Яндекс 360. Триггер: новое письмо в sales@ / info@. Препроцессинг: HTML, вложения, антиспам, дедупликация. Подбор коннектора под 152-ФЗ.</p>
        </div>
        <div class="vnec-card">
          <h3>Make, n8n, webhooks</h3>
          <p><code>Gmail / Яндекс → n8n → YandexGPT / GPT-4o → amoCRM / Битрикс24 API</code>. n8n on-prem для 152-ФЗ; Make — быстрый пилот; OpenAI Agents SDK — <code>needs_approval</code>.</p>
        </div>
      </div>
      <div class="vnec-table-wrap nero-ai-reveal" style="margin-top:28px">
        <table class="vnec-table" aria-label="CRM и место для AI-агента">
          <thead><tr><th>CRM</th><th>Штатные возможности</th><th>Место для AI</th></tr></thead>
          <tbody>
            <tr><td><strong>amoCRM</strong></td><td>Автообработка по шаблону</td><td>Нестандартный текст, вложения, intent</td></tr>
            <tr><td><strong>Битрикс24</strong></td><td>CoPilot: суммаризация</td><td>Автосоздание сделок, NER номенклатуры</td></tr>
            <tr><td><strong>1С:CRM / УТ</strong></td><td>Экстракторы заявок</td><td>Email + мессенджеры → карточка</td></tr>
            <tr><td><strong>HubSpot, Salesforce</strong></td><td>Zapier/Parseur</td><td>Кастомный агент для смешанного потока</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="vnec-section" id="keisy">
    <div class="vnec-cnt">
      <div class="vnec-sh nero-ai-reveal">
        <span class="vnec-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI для обработки почты</h2>
      </div>
      <p class="vnec-related nero-ai-reveal" style="margin-bottom:28px;font-size:15px">На корпоративном масштабе те же принципы triage и маршрутизации заявок уже проверены в enterprise: в разборе <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--vnec-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude — уроки AI для бизнеса</a> показаны цифровые шлюзы и managed-агенты, которые можно адаптировать к потокам email→CRM.</p>
      <div class="vnec-case-grid">
        <div class="vnec-case-card nero-ai-reveal">
          <div class="vnec-case-tag">Логистика · США</div>
          <h3>C.H. Robinson</h3>
          <p>15 000 shipment-email/день: классификация → извлечение → заказ. ~5 500 заказов/день автоматически, &gt;600 человеко-часов/день.</p>
          <div class="vnec-metric"><span class="num">7 мин</span><span class="lbl">→ автоматизация triage</span></div>
        </div>
        <div class="vnec-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vnec-case-tag">Россия · Битрикс24</div>
          <h3>Bestrank / YandexGPT</h3>
          <p>Письмо → БП → YandexGPT → поля CRM и номенклатура. Паттерн для производства и опта.</p>
          <div class="vnec-metric"><span class="num">~1 мин</span><span class="lbl">на письмо после настройки</span></div>
        </div>
        <div class="vnec-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vnec-case-tag">Санкт-Петербург</div>
          <h3>СТЕК</h3>
          <p>ИИ в закрытом контуре: почта, сайт, ЛК, телефон → классификация → локальная LLM → валидация менеджером.</p>
          <div class="vnec-metric"><span class="num">−70%</span><span class="lbl">время обработки запроса</span></div>
        </div>
        <div class="vnec-case-card nero-ai-reveal">
          <div class="vnec-case-tag">Финансы · Австралия</div>
          <h3>Bell Direct</h3>
          <p>Super Agent триажит 800+ client emails/день → задачи с приоритетом. Срочные — за секунды.</p>
          <div class="vnec-metric"><span class="num">+20%</span><span class="lbl">operational efficiency</span></div>
        </div>
        <div class="vnec-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vnec-case-tag">SaaS</div>
          <h3>eZintegrations</h3>
          <p>AI на sales@ → Salesforce. Ответ с 4–24 ч до &lt;15 мин; triage SDR с 2,8 ч/день до &lt;20 мин.</p>
          <div class="vnec-metric"><span class="num">12–18%</span><span class="lbl">устранены потери лидов</span></div>
        </div>
        <div class="vnec-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vnec-case-tag">Россия</div>
          <h3>Script Agency</h3>
          <p>ИИ сортирует входящие: «10 важных вместо 200»; пилот за 2 недели, интеграции через MCP.</p>
          <div class="vnec-metric"><span class="num">MCP</span><span class="lbl">150–300 тыс. ₽ ориентир</span></div>
        </div>
      </div>
    </div>
  </section>

  <section class="vnec-section vnec-section-alt" id="ceny">
    <div class="vnec-cnt">
      <div class="vnec-sh nero-ai-reveal">
        <span class="vnec-eyebrow">Бюджет</span>
        <h2>Стоимость внедрения AI обработки email</h2>
        <p>Коридор <strong>120–300 тыс. ₽</strong> за проект <strong>ai обработка email под ключ</strong>.</p>
      </div>
      <div class="vnec-table-wrap nero-ai-reveal">
        <table class="vnec-table" aria-label="Состав проекта 120–300 тыс руб">
          <thead><tr><th>Компонент</th><th>Содержание</th></tr></thead>
          <tbody>
            <tr><td>Аудит</td><td>«Разобрать вашу почту», Карта автоматизации</td></tr>
            <tr><td>Пилот</td><td>1 ящик, 2–3 класса, запись в CRM</td></tr>
            <tr><td>AI-оркестратор</td><td>n8n/Make + промпт-банк + JSON Schema</td></tr>
            <tr><td>CRM-адаптер</td><td>amoCRM / Битрикс24 / 1С</td></tr>
            <tr><td>Human-in-the-loop</td><td>Очередь «Неразобранное», Telegram</td></tr>
            <tr><td>Обучение и метрики</td><td>Регламент, accuracy, время до сделки</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vnec-card nero-ai-reveal" style="margin-top:24px">
        <h3>От чего зависит цена</h3>
        <p>Объём потока, CRM и кастомные поля, почтовый стек, контур данных (облако vs on-prem), парсинг вложений, количество ящиков. Кастомный агент окупается при <strong>50+</strong> входящих в день с хотя бы 10% коммерческих.</p>
      </div>
      <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Узнайте бюджет под ваш поток писем</p>
    <p class="ym-cta-block__sub">Ориентир 120–300 тыс. ₽ за внедрение под ключ. На аудите «Разобрать вашу почту» дадим оценку сроков, CRM-совместимости и ROI — бесплатно.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent">Разобрать вашу почту</a>
    </div>
  </div>
</div>
    </div>
  </section>

  <section class="vnec-section" id="kontekst">
    <div class="vnec-cnt">
      <div class="vnec-sh vnec-left nero-ai-reveal">
        <span class="vnec-eyebrow">Контекст</span>
        <h2>Где обработка почты вписывается в карту автоматизации</h2>
        <p>На <strong>Карте автоматизации входящей почты</strong> почта — входная точка воронки: каналы → триаж AI → CRM → коммуникация → аналитика «письмо → сделка».</p>
        <p style="margin-top:16px">Следующие шаги: AI в мессенджерах, квалификация лидов, RAG для поддержки (паттерн СТЕК). Единый стек n8n + LLM + MCP — без «островов» автоматизации.</p>
      </div>
    </div>
  </section>

  <section class="vnec-section vnec-section-alt" id="faq">
    <div class="vnec-cnt">
      <div class="vnec-sh nero-ai-reveal">
        <span class="vnec-eyebrow">Вопрос — ответ</span>
        <h2>FAQ: как внедрить AI обработку email в ваш бизнес</h2>
      </div>
      <div class="vnec-faq nero-ai-reveal">
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли решение малому бизнесу?</div><div class="vnec-faq-a"><p>Да, при стабильном потоке заявок на почту. Пилот на 1 ящике — 2–4 недели, от 120 тыс. ₽. Для 2–3 писем в неделю хватит штатной автопочты amoCRM; AI нужен при свободной форме и общем info@.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Безопасность почты и персональные данные</div><div class="vnec-faq-a"><p>Псевдонимизация до LLM, YandexGPT/BitrixGPT в РФ, on-prem n8n, регламент 152-ФЗ, human-in-the-loop для юридически значимых ответов. Подход white-data-зоны (PROMAREN).</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Готовые SaaS vs кастомный AI-агент</div><div class="vnec-faq-a"><p>SaaS слабо с российскими CRM и нестандартными письмами. Кастомный агент Nero Network: amoCRM/Битрикс24/1С, 5–10 классов, HITL, 120–300 тыс. ₽ разово.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько длится внедрение?</div><div class="vnec-faq-a"><p>Аудит — 3–5 дней. Пилот — 2–4 недели. Прод с вложениями — ещё 2–4 недели.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Что если AI ошибётся?</div><div class="vnec-faq-a"><p>Порог confidence, очередь «Неразобранное AI», идемпотентность по Message-ID. Менеджер правит — система учится на правках.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли программист в штате?</div><div class="vnec-faq-a"><p>Нет. Nero Network сдаёт решение под ключ и обучает команду.</p></div></div>
      </div>
    </div>
  </section>

  <section class="vnec-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="vnec-cnt" style="text-align:center">
      <span class="vnec-eyebrow">Первый шаг бесплатно</span>
      <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px">Разобрать вашу почту:<br>Карта автоматизации входящей почты</h2>
      <p style="max-width:580px;margin:0 auto 28px;font-size:16px">Nero Network разберёт 50–100 последних писем, покажет потери между ящиком и CRM и даст оценку бюджета 120–300 тыс. ₽ под ваш поток.</p>
      <ul class="vnec-cta-checklist">
        <li>Аудит за 3–5 рабочих дней</li>
        <li>Карта классов и полей CRM</li>
        <li>Оценка ROI для sales@</li>
        <li>Без обязательств</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px">Разобрать вашу почту</a>
    </div>
  </section>

</div><!-- /.vnec-content -->

<?php
$vnec_page_url = trailingslashit( get_permalink() );
$vnec_site_url = trailingslashit( home_url( '/' ) );
$vnec_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$vnec_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $vnec_site_url . '#organization',
      'name'  => $vnec_brand,
      'url'   => $vnec_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $vnec_site_url . '#website',
      'url'       => $vnec_site_url,
      'name'      => $vnec_brand,
      'publisher' => [ '@id' => $vnec_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $vnec_page_url . '#webpage',
      'url'         => $vnec_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $vnec_site_url . '#website' ],
      'about'       => [ '@id' => $vnec_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $vnec_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vnec_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vnec_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $vnec_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $vnec_page_url,
      'provider'    => [ '@id' => $vnec_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $vnec_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Подходит ли решение малому бизнесу?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, при стабильном потоке заявок на почту. Пилот на 1 ящике — 2–4 недели, от 120 тыс. ₽. Для 2–3 писем в неделю хватит штатной автопочты amoCRM; AI нужен при свободной форме и общем info@.' ] ],
        [ '@type' => 'Question', 'name' => 'Безопасность почты и персональные данные', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Псевдонимизация до LLM, YandexGPT/BitrixGPT в РФ, on-prem n8n, регламент 152-ФЗ, human-in-the-loop для юридически значимых ответов. Подход white-data-зоны (PROMAREN).' ] ],
        [ '@type' => 'Question', 'name' => 'Готовые SaaS vs кастомный AI-агент', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'SaaS слабо с российскими CRM и нестандартными письмами. Кастомный агент Nero Network: amoCRM/Битрикс24/1С, 5–10 классов, HITL, 120–300 тыс. ₽ разово.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько длится внедрение?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит — 3–5 дней. Пилот — 2–4 недели. Прод с вложениями — ещё 2–4 недели.' ] ],
        [ '@type' => 'Question', 'name' => 'Что если AI ошибётся?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Порог confidence, очередь «Неразобранное AI», идемпотентность по Message-ID. Менеджер правит — система учится на правках.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужен ли программист в штате?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. Nero Network сдаёт решение под ключ и обучает команду.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vnec_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
?>

</main>

<script>
/**
 * vnec-inbox-crm-engine — Диспетчерская «Почтовый мост CRM»
 * Мир: орбитальные потоки писем → AI-триаж → NER → запись сделки в CRM
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnec-inbox-crm-canvas");
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
    cy = ch / 2 + 10;
    scale = Math.min(cw / 420, ch / 280) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    mailBg: "#f8fafc",
    mailFlap: "#e2e8f0",
    orbit: "rgba(121,242,255,0.22)",
    orbitGlow: "rgba(139,92,246,0.35)",
    crmBase: "#1e293b",
    crmAccent: "#79f2ff",
    crmGreen: "#22c55e",
    spam: "#fb7185",
    fieldChip: "#a7f3d0",
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

  /* Орбитальные дуги — транспорт писем (не конвейер) */
  function OrbitalMailStream() {
    this.orbitPhase = 0;
  }
  OrbitalMailStream.prototype.draw = function (ctx) {
    this.orbitPhase = (frame * 0.025) % (Math.PI * 2);
    var orbits = [
      { rx: 130, ry: 55, offset: 0, speed: 1 },
      { rx: 105, ry: 42, offset: 2.1, speed: 1.3 },
      { rx: 80, ry: 30, offset: 4.2, speed: 0.85 }
    ];
    orbits.forEach(function (orb, idx) {
      ctx.save();
      ctx.strokeStyle = idx === 0 ? C.orbitGlow : C.orbit;
      ctx.lineWidth = idx === 0 ? 2 : 1;
      ctx.setLineDash([6, 8]);
      ctx.lineDashOffset = -frame * 0.4;
      ctx.beginPath();
      ctx.ellipse(0, -20, orb.rx, orb.ry, 0, 0, Math.PI * 2);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();
    });

    for (var i = 0; i < 5; i++) {
      var orb = orbits[i % 3];
      var t = (this.orbitPhase * orb.speed + orb.offset + i * 1.25) % (Math.PI * 2);
      var ex = Math.cos(t) * orb.rx;
      var ey = -20 + Math.sin(t) * orb.ry;
      drawEnvelope(ctx, ex, ey, 14, 10, i % 3 === 2 ? C.spam : C.mailBg);
    }
  };

  function drawEnvelope(ctx, x, y, w, h, color) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -w / 2, -h / 2, w, h, 2, color, C.outline);
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(-w / 2, -h / 2);
    ctx.lineTo(0, 0);
    ctx.lineTo(w / 2, -h / 2);
    ctx.stroke();
    ctx.restore();
  }

  /* Центральная CRM-воронка — вместо WebsiteTerminal */
  function CrmDealForge() {
    this.syncPulse = 0;
    this.dealCount = 0;
  }
  CrmDealForge.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    this.syncPulse = 0;

    drawRR(ctx, -55, -75, 110, 150, 10, C.crmBase, C.outline);

    /* Воронка CRM */
    ctx.fillStyle = "rgba(121,242,255,0.12)";
    ctx.beginPath();
    ctx.moveTo(-40, -55);
    ctx.lineTo(40, -55);
    ctx.lineTo(22, 15);
    ctx.lineTo(-22, 15);
    ctx.closePath();
    ctx.fill();
    ctx.strokeStyle = C.crmAccent;
    ctx.lineWidth = 1.5;
    ctx.stroke();

    /* Стадии воронки */
    var stages = ["Новый", "Квалиф.", "Сделка"];
    stages.forEach(function (s, i) {
      ctx.fillStyle = "rgba(255,255,255,0.55)";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(s, 0, -42 + i * 22);
    });

    /* Фазы цикла */
    if (prg >= 60 && prg < 120) {
      /* TRIAGE — подсветка сортировщика */
      ctx.fillStyle = "rgba(139,92,246,0.35)";
      ctx.beginPath();
      ctx.arc(-70, -30, 18 + Math.sin(frame * 0.1) * 3, 0, Math.PI * 2);
      ctx.fill();
    }

    if (prg >= 120 && prg < 180) {
      /* EXTRACT — поля NER */
      var fields = ["Имя", "Тел.", "Сумма"];
      fields.forEach(function (f, i) {
        var fx = 55 + Math.sin(frame * 0.08 + i) * 4;
        var fy = -50 + i * 22;
        drawRR(ctx, fx, fy, 34, 14, 4, C.fieldChip, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(f, fx + 17, fy + 10);
      });
    }

    if (prg >= 180) {
      /* COMMIT — карточка сделки + импульс */
      var commitPrg = Math.min(1, (prg - 180) / 25);
      var cardY = 25 - commitPrg * 35;
      drawRR(ctx, -28, cardY, 56, 32, 6, "rgba(34,197,94,0.25)", C.crmGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Лид #1847", 0, cardY + 14);
      ctx.font = "7px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("amoCRM · 201", 0, cardY + 24);

      if (prg > 195 && prg < 230) {
        this.syncPulse = (prg - 195) / 35;
        ctx.strokeStyle = "rgba(34,197,94," + (0.8 - this.syncPulse * 0.7) + ")";
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.arc(0, cardY + 16, 20 + this.syncPulse * 40, 0, Math.PI * 2);
        ctx.stroke();
      }
      if (prg > 210 && prg < 215) this.dealCount++;
    }

    /* API-луч в CRM */
    if (prg >= 175) {
      var beamAlpha = Math.min(1, (prg - 175) / 15) * (prg < 225 ? 1 : 1 - (prg - 225) / 15);
      ctx.strokeStyle = "rgba(121,242,255," + beamAlpha * 0.7 + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([4, 4]);
      ctx.beginPath();
      ctx.moveTo(0, 60);
      ctx.lineTo(0, 95);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = C.crmAccent;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("API → CRM", 0, 108);
    }

    /* Счётчик сделок */
    ctx.fillStyle = C.crmGreen;
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "right";
    ctx.fillText("+" + (Math.floor(prg / 240) + (prg > 210 ? 1 : 0)) + " сегодня", 50, -62);
  };

  /* Спам-ловушка — уникальный объект темы */
  function SpamDivertGate() {
    this.glow = 0;
  }
  SpamDivertGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    drawRR(ctx, -155, 10, 36, 28, 6, "rgba(251,113,133,0.15)", C.spam);
    ctx.fillStyle = C.spam;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("SPAM", -137, 28);

    if (prg > 55 && prg < 90) {
      this.glow = Math.sin((prg - 55) * 0.15) * 0.5 + 0.5;
      var sx = -120 + ((prg - 55) / 35) * 50;
      drawEnvelope(ctx, sx, 5, 12, 8, C.spam);
    }
  };

  /* Шкала confidence */
  function ConfidenceMeter() {
    this.val = 0.72;
  }
  ConfidenceMeter.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 60) this.val = 0.45 + (prg / 60) * 0.2;
    else if (prg < 120) this.val = 0.65 + ((prg - 60) / 60) * 0.2;
    else if (prg < 180) this.val = 0.85 + ((prg - 120) / 60) * 0.1;
    else this.val = 0.96;

    drawRR(ctx, 95, -65, 52, 16, 4, "rgba(255,255,255,0.08)", C.outline);
    drawRR(ctx, 97, -63, 48 * this.val, 12, 3, C.crmGreen, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText(Math.round(this.val * 100) + "% AI", 97, -52);
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

    /* Агенты идут к орбитальному хабу снизу — другая геометрия */
    var hubTargets = {
      "1_architect": { x: -90, y: 55 },
      "2_seo": { x: -30, y: 65 },
      "3_coder": { x: 30, y: 65 },
      "4_designer": { x: 90, y: 55 },
      "5_deployer": { x: 0, y: 75 }
    };
    var tgt = hubTargets[this.role] || { x: 0, y: 60 };

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
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.2;
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
    if (carryType) drawRR(ctx, -16, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var stream = new OrbitalMailStream();
  var forge = new CrmDealForge();
  var spamGate = new SpamDivertGate();
  var confidence = new ConfidenceMeter();

  entities.push(stream);
  entities.push(spamGate);
  entities.push(forge);
  entities.push(confidence);
  entities.push(new Agent(-140, 95, C.agentYellow, "1_architect", 18, [
    "Правила sales@ готовы", "Маршрутизация по ящикам", "Аудит 50 писем"
  ]));
  entities.push(new Agent(-70, 105, C.agentGreen, "2_seo", 62, [
    "Заявка, не спам!", "Класс: коммерция", "Intent = lead"
  ]));
  entities.push(new Agent(0, 108, C.agentBlue, "3_coder", 108, [
    "JSON Schema NER", "temperature=0", "Structured output"
  ]));
  entities.push(new Agent(70, 105, C.agentPink, "4_designer", 152, [
    "Поля CRM сопоставлены", "Кастомные атрибуты", "Воронка продаж"
  ]));
  entities.push(new Agent(140, 95, C.agentPurple, "5_deployer", 192, [
    "POST /api/v4/leads", "201 Created ✓", "Telegram-алерт менеджеру"
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

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.04) % 240;
    if (prg >= 16 && prg < 16.05) createBubble(-100, -40, "1. Письмо в поток");
    if (prg >= 64 && prg < 64.05) createBubble(-70, 20, "2. AI-классификация");
    if (prg >= 112 && prg < 112.05) createBubble(0, -10, "3. NER: имя, телефон");
    if (prg >= 168 && prg < 168.05) createBubble(40, 30, "4. Карточка в CRM");
    if (prg >= 208 && prg < 208.05) createBubble(100, -20, "5. Менеджер уведомлён");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.crmAccent);
      ctx.fillStyle = C.bubbleText;
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

<script>
(function(){
  document.querySelectorAll('.vnec-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.vnec-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.vnec-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.vnec-faq-q');if(q)q.setAttribute('aria-expanded','false');
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
  var root=document.querySelector('.vnec-content');
  if(!root)return;
  var items=root.querySelectorAll('.nero-ai-reveal');
  if('IntersectionObserver' in window){
    var observer=new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){entry.target.classList.add('nero-ai-active');observer.unobserve(entry.target);}
      });
    },{threshold:0.1,rootMargin:'0px 0px -6% 0px'});
    items.forEach(function(item){observer.observe(item);});
  }else{items.forEach(function(item){item.classList.add('nero-ai-active');});}
})();
</script>


<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

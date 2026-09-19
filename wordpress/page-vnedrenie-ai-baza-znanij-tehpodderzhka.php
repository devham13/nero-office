<?php
/**
 * Template Name: AI-база знаний для техподдержки: внедрение под ключ
 * Description: Внедрим AI-базу знаний для техподдержки под ключ: единые ответы с цитатой из утверждённых инструкций, интеграция с CRM. Аудит базы знаний — бесплатно.
 */

$page_seo_title       = 'AI-база знаний для техподдержки: внедрение под ключ | Nero Network';
$page_seo_description = 'Внедрим AI-базу знаний для техподдержки под ключ: единые ответы с цитатой из утверждённых инструкций, интеграция с CRM. Аудит базы знаний — бесплатно.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'KPI', 'href' => '#kpi'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать AI-базу знаний';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Курс по RAG';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

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
.vnkbz-hero-email-crm {
  --vnkbz-cyan: #79f2ff;
  --vnkbz-violet: #8b5cf6;
  --vnkbz-green: #22c55e;
  --vnkbz-text: #e6edf7;
  --vnkbz-muted: #9aa8bd;
  --vnkbz-soft: #c7d2e5;
  --vnkbz-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnkbz-hero-email-crm.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnkbz-hero-email-crm::before {
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
.vnkbz-hero-email-crm::after {
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
.vnkbz-hero-email-crm .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnkbz-hero-email-crm .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnkbz-hero-email-crm .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnkbz-hero-email-crm .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnkbz-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnkbz-hero-email-crm .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnkbz-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnkbz-hero-email-crm .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnkbz-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnkbz-hero-email-crm .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnkbz-hero-email-crm .nero-ai-badge {
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
.vnkbz-hero-email-crm .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnkbz-hero-email-crm .nero-ai-btn {
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
.vnkbz-hero-email-crm .nero-ai-btn:hover { transform: translateY(-2px); }
.vnkbz-hero-email-crm .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnkbz-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnkbz-hero-email-crm .nero-ai-btn-secondary {
  color: var(--vnkbz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnkbz-hero-email-crm .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnkbz-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnkbz-hero-email-crm .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnkbz-hero-email-crm .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnkbz-hero-email-crm .nero-ai-dots { display: flex; gap: 7px; }
.vnkbz-hero-email-crm .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnkbz-hero-email-crm .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnkbz-hero-email-crm .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnkbz-hero-email-crm .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnkbz-hero-email-crm .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnkbz-hero-email-crm .nero-ai-window-body { padding: 16px; }
.vnkbz-hero-email-crm .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vnkbz-hero-email-crm .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnkbz-hero-email-crm .nero-ai-live-pill {
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
.vnkbz-hero-email-crm .nero-ai-live-pill::before {
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
.vnkbz-hero-email-crm .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnkbz-hero-email-crm .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnkbz-hero-email-crm .nero-ai-metric span {
  display: block;
  color: var(--vnkbz-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnkbz-hero-email-crm .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnkbz-hero-email-crm .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnkbz-hero-email-crm .vnkbz-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 40%, rgba(121,242,255,.08), rgba(6,10,24,.9) 70%);
}
.vnkbz-hero-email-crm #vnkbz-inbox-crm-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnkbz-hero-email-crm .nero-ai-task-stream {
  display: grid;
  gap: 8px;
}
.vnkbz-hero-email-crm .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnkbz-hero-email-crm .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vnkbz-cyan);
  font-size: 13px;
  font-weight: 800;
}
.vnkbz-hero-email-crm .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnkbz-hero-email-crm .nero-ai-task span {
  color: var(--vnkbz-muted);
  font-size: 11px;
}
.vnkbz-hero-email-crm .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnkbz-hero-email-crm .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vnkbz-hero-email-crm .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnkbz-hero-email-crm .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vnkbz-hero-email-crm .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnkbz-hero-email-crm .nero-ai-window-body { padding: 12px; }
  .vnkbz-hero-email-crm .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnkbz-hero-email-crm .nero-ai-status { grid-column: 2; width: fit-content; }
}

/* VNEC content root */
.vnkbz-content{
  --vnkbz-bg:#050711;--vnkbz-bg2:#080b17;--vnkbz-surface:rgba(255,255,255,.072);
  --vnkbz-text:#e6edf7;--vnkbz-muted:#9aa8bd;--vnkbz-soft:#c7d2e5;--vnkbz-heading:#fff;
  --vnkbz-border:rgba(255,255,255,.10);--vnkbz-accent:#79f2ff;--vnkbz-violet:#8b5cf6;--vnkbz-green:#22c55e;
  --vnkbz-btn-from:#2563eb;--vnkbz-btn-to:#7c3aed;--vnkbz-r:18px;--vnkbz-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnkbz-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vnkbz-content *,.vnkbz-content *::before,.vnkbz-content *::after{box-sizing:border-box}
.vnkbz-content a{color:inherit}
.vnkbz-content p{color:var(--vnkbz-muted);line-height:1.72;margin:0 0 1em}
.vnkbz-content p:last-child{margin-bottom:0}
.vnkbz-content h2,.vnkbz-content h3,.vnkbz-content h4{color:var(--vnkbz-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vnkbz-content strong{color:var(--vnkbz-soft)}
.vnkbz-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vnkbz-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vnkbz-muted);font-size:14.5px;line-height:1.65}
.vnkbz-content ul li::before{content:'›';position:absolute;left:0;color:var(--vnkbz-accent);font-weight:700}
.vnkbz-cnt{width:min(var(--vnkbz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vnkbz-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vnkbz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vnkbz-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vnkbz-sh.vnkbz-left{margin-left:0;text-align:left}
.vnkbz-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vnkbz-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vnkbz-sh.vnkbz-left p{margin-left:0}
.vnkbz-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnkbz-accent);margin-bottom:14px}
.vnkbz-gt{background:linear-gradient(92deg,#fff 0%,var(--vnkbz-accent) 44%,var(--vnkbz-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.vnkbz-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vnkbz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vnkbz-intro-text{position:relative;padding-left:20px}
.vnkbz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vnkbz-accent),var(--vnkbz-violet))}
.vnkbz-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vnkbz-muted);margin-bottom:1em}
.vnkbz-intro-text p:last-child{margin-bottom:0;color:var(--vnkbz-soft)}
.vnkbz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vnkbz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.vnkbz-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vnkbz-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vnkbz-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnkbz-muted);line-height:1.4}
.vnkbz-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vnkbz-intro-grid{grid-template-columns:1fr;gap:36px}.vnkbz-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vnkbz-intro-kpi{grid-template-columns:1fr 1fr}}
.vnkbz-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vnkbz-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vnkbz-toc a{display:inline-block;padding:9px 18px;background:var(--vnkbz-surface);border:1px solid var(--vnkbz-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vnkbz-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vnkbz-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vnkbz-accent);background:rgba(121,242,255,.08)}
.vnkbz-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vnkbz-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.vnkbz-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.vnkbz-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vnkbz-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.vnkbz-grid-2,.vnkbz-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.vnkbz-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vnkbz-grid-3{grid-template-columns:1fr}}
.vnkbz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vnkbz-table{width:100%;border-collapse:collapse;font-size:14px}
.vnkbz-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vnkbz-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.vnkbz-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vnkbz-text);vertical-align:top}
.vnkbz-table tr:last-child td{border-bottom:none}
.vnkbz-table tr:hover td{background:rgba(255,255,255,.03)}
.vnkbz-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vnkbz-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vnkbz-accent);border:1px solid rgba(121,242,255,.2)}
.vnkbz-flow .arr{color:var(--vnkbz-muted);font-size:16px;padding:0 4px;background:none;border:none}
.vnkbz-timeline{position:relative;padding-left:40px}
.vnkbz-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vnkbz-accent),var(--vnkbz-violet));opacity:.35;border-radius:2px}
.vnkbz-tl-item{position:relative;margin-bottom:32px}
.vnkbz-tl-item:last-child{margin-bottom:0}
.vnkbz-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vnkbz-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vnkbz-tl-item h3{font-size:17px;margin-bottom:8px}
.vnkbz-tl-item p{font-size:14.5px;margin:0}
.vnkbz-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vnkbz-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vnkbz-case-grid{grid-template-columns:1fr}}
.vnkbz-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.vnkbz-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.vnkbz-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnkbz-green);margin-bottom:10px}
.vnkbz-case-card h3{font-size:16px;margin-bottom:14px}
.vnkbz-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px}
.vnkbz-metric .num{font-size:20px;font-weight:900;color:var(--vnkbz-accent);flex-shrink:0}
.vnkbz-metric .lbl{font-size:13px;color:var(--vnkbz-muted)}
.vnkbz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vnkbz-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vnkbz-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnkbz-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.vnkbz-faq-q::after{content:'▾';font-size:13px;color:var(--vnkbz-accent);flex-shrink:0;transition:transform .25s}
.vnkbz-faq-item.open .vnkbz-faq-q::after{transform:rotate(180deg)}
.vnkbz-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vnkbz-muted);line-height:1.72}
.vnkbz-faq-item.open .vnkbz-faq-a{max-height:800px;padding:0 24px 20px}
.vnkbz-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.vnkbz-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--vnkbz-muted)}
.vnkbz-cta-checklist li::before{content:'✓';color:var(--vnkbz-green);font-weight:800}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vnkbz-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--vnkbz-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vnkbz-btn-from),var(--vnkbz-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
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


.vnkbz-prose h3{font-size:17px;margin-top:1.4em}
.vnkbz-prose > h2{display:none}
.vnkbz-hr{border:none;border-top:1px solid rgba(255,255,255,.08);margin:28px 0}

</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-baza-znanij-tehpodderzhka-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnkbz-hero-rag-kb" id="vnkbz-hero-rag-kb" aria-labelledby="vnkbz-hero-title">
<style>
/* === VNKBZ HERO — self-contained, .nero-ai-home-page dark premium === */
.vnkbz-hero-rag-kb {
  --vnkbz-cyan: #79f2ff;
  --vnkbz-violet: #8b5cf6;
  --vnkbz-green: #22c55e;
  --vnkbz-amber: #f59e0b;
  --vnkbz-text: #e6edf7;
  --vnkbz-muted: #9aa8bd;
  --vnkbz-soft: #c7d2e5;
  --vnkbz-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  color: var(--vnkbz-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
.vnkbz-hero-rag-kb::before {
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
.vnkbz-hero-rag-kb::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(6px);
  animation: vnkbzGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnkbzGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vnkbz-hero-rag-kb .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnkbz-hero-rag-kb .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnkbz-hero-rag-kb .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .92;
  letter-spacing: -0.065em;
  color: #fff;
}
.vnkbz-hero-rag-kb .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnkbz-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnkbz-hero-rag-kb .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnkbz-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnkbz-hero-rag-kb .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnkbz-soft) !important;
  font-size: clamp(17px, 2vw, 21px);
  line-height: 1.58;
}
.vnkbz-hero-rag-kb .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnkbz-hero-rag-kb .nero-ai-badge {
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
  white-space: nowrap;
}
.vnkbz-hero-rag-kb .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 34px;
}
.vnkbz-hero-rag-kb .nero-ai-btn {
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
  transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
}
.vnkbz-hero-rag-kb .nero-ai-btn:hover { transform: translateY(-2px); }
.vnkbz-hero-rag-kb .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnkbz-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnkbz-hero-rag-kb .nero-ai-btn-secondary {
  color: var(--vnkbz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnkbz-hero-rag-kb .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnkbz-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnkbz-hero-rag-kb .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnkbz-hero-rag-kb .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnkbz-hero-rag-kb .nero-ai-dots { display: flex; gap: 7px; }
.vnkbz-hero-rag-kb .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnkbz-hero-rag-kb .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnkbz-hero-rag-kb .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnkbz-hero-rag-kb .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnkbz-hero-rag-kb .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnkbz-hero-rag-kb .nero-ai-window-body { padding: 16px; }
.vnkbz-hero-rag-kb .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 14px;
}
.vnkbz-hero-rag-kb .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnkbz-hero-rag-kb .nero-ai-live-pill {
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
.vnkbz-hero-rag-kb .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnkbzPulse 1.6s infinite;
}
@keyframes vnkbzPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnkbz-hero-rag-kb .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnkbz-hero-rag-kb .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnkbz-hero-rag-kb .nero-ai-metric span {
  display: block;
  color: var(--vnkbz-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnkbz-hero-rag-kb .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnkbz-hero-rag-kb .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnkbz-hero-rag-kb .vnkbz-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(139, 92, 246, 0.18);
  background: radial-gradient(ellipse at 50% 35%, rgba(139,92,246,.10), rgba(6,10,24,.92) 72%);
}
.vnkbz-hero-rag-kb #vnkbz-rag-support-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnkbz-hero-rag-kb .nero-ai-task-stream {
  display: grid;
  gap: 8px;
}
.vnkbz-hero-rag-kb .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnkbz-hero-rag-kb .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(139,92,246,.14);
  color: var(--vnkbz-violet);
  font-size: 12px;
  font-weight: 800;
}
.vnkbz-hero-rag-kb .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnkbz-hero-rag-kb .nero-ai-task span {
  color: var(--vnkbz-muted);
  font-size: 11px;
}
.vnkbz-hero-rag-kb .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnkbz-hero-rag-kb .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.vnkbz-hero-rag-kb .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .vnkbz-hero-rag-kb .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnkbz-hero-rag-kb .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vnkbz-hero-rag-kb .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnkbz-hero-rag-kb .nero-ai-window-body { padding: 12px; }
  .vnkbz-hero-rag-kb .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnkbz-hero-rag-kb .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow">RAG · техподдержка · внедрение под ключ</p>
    <h1 id="vnkbz-hero-title">AI-база знаний для техподдержки: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
    <p class="nero-ai-hero-lead">AI отвечает по утверждённым инструкциям и показывает документ-источник — операторы перестают искать ответы вручную</p>
    <ul class="nero-ai-badges" aria-label="Этапы внедрения">
      <li class="nero-ai-badge">Аудит базы знаний</li>
      <li class="nero-ai-badge">RAG-индексация</li>
      <li class="nero-ai-badge">Faithfulness-gate</li>
      <li class="nero-ai-badge">CRM / Telegram</li>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Собрать AI-базу знаний</a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация RAG-базы знаний для техподдержки">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3>Copilot с цитатой источника</h3>
          <span class="nero-ai-live-pill">онлайн</span>
        </div>
        <div class="nero-ai-metrics-grid">
          <div class="nero-ai-metric">
            <span>Поиск в wiki</span>
            <strong>3 сек</strong>
            <small>было ~60 сек</small>
          </div>
          <div class="nero-ai-metric">
            <span>Faithfulness</span>
            <strong>96%</strong>
            <small>grounded в регламенте</small>
          </div>
          <div class="nero-ai-metric">
            <span>Ответов с citation</span>
            <strong>100%</strong>
            <small>документ-источник виден</small>
          </div>
          <div class="nero-ai-metric">
            <span>Режим запуска</span>
            <strong>стажёр</strong>
            <small>оператор подтверждает</small>
          </div>
        </div>

        <div class="vnkbz-dash-canvas-wrap" aria-hidden="false">
          <canvas id="vnkbz-rag-support-canvas" role="img" aria-label="Анимация: фрагменты инструкций индексируются, RAG находит регламент и выдаёт ответ с цитатой документа-источника"></canvas>
        </div>

        <div class="nero-ai-task-stream" aria-label="Лента событий RAG-поддержки">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">?</span>
            <div><strong>Клиент: срок возврата 20 дней?</strong><span>Retrieval: регламент_возврата.pdf §4.2</span></div>
            <span class="nero-ai-status">найдено</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">📄</span>
            <div><strong>Источник: регламент_возврата.pdf</strong><span>Цитата: «14 календарных дней»</span></div>
            <span class="nero-ai-status nero-ai-status--violet">citation</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">✓</span>
            <div><strong>Faithfulness-gate пройден</strong><span>confidence 0.94 · черновик оператору</span></div>
            <span class="nero-ai-status">copilot</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">⊘</span>
            <div><strong>Billing: спор по тарифу</strong><span>Автоответ запрещён → эскалация</span></div>
            <span class="nero-ai-status nero-ai-status--amber">оператор</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<div class="vnkbz-content">

  <section class="vnkbz-intro vnkbz-section" id="intro" aria-label="Введение">
    <div class="vnkbz-cnt">
      <div class="vnkbz-intro-grid nero-ai-reveal">
        <div class="vnkbz-intro-text">
          <p class="vnkbz-eyebrow">Лонгрид / RAG / техподдержка</p>
<p><strong>Коротко:</strong> AI-база знаний для техподдержки — это система, которая отвечает клиентам и операторам <strong>только по утверждённым инструкциям</strong> и показывает <strong>документ-источник</strong> в каждом ответе. Внедрение под ключ Nero Network закрывает боль «операторы отвечают по-разному» и сокращает поиск ответа с минут до секунд.</p>
<p>Клиент ждёт на линии, оператор листает папки, wiki и чаты — и в итоге даёт ответ, который завтра коллега сформулирует иначе. В 2026 году IBM называет <strong>унификацию разрозненных систем и данных</strong> главным трендом контакт-центров: поддержка должна говорить одним голосом во всех каналах. Мы внедряем <strong>AI-базу знаний для техподдержки</strong> на архитектуре RAG — чтобы каждый ответ опирался на ваши регламенты, а не на «догадки» нейросети.</p>
<p><strong>Оффер Nero Network:</strong> AI отвечает по утверждённой базе знаний и показывает документ-источник. Операторы перестают искать ответы вручную, клиенты получают единые формулировки. Первый шаг — <strong>аудит базы знаний поддержки</strong>; далее — пилот на реальных тикетах и интеграция с CRM.</p>
        </div>
        <div class="vnkbz-intro-kpi" aria-label="Ключевые метрики RAG-поддержки">
          <div class="vnkbz-kpi-card"><div class="kv">60→3 сек</div><div class="kl">поиск в wiki</div><div class="ks">Альфа-Банк / KTS</div></div>
          <div class="vnkbz-kpi-card"><div class="kv">96%</div><div class="kl">faithfulness</div><div class="ks">Timeweb Cloud</div></div>
          <div class="vnkbz-kpi-card"><div class="kv">100%</div><div class="kl">ответов с citation</div><div class="ks">grounded RAG</div></div>
          <div class="vnkbz-kpi-card"><div class="kv">6-10 нед</div><div class="kl">внедрение под ключ</div><div class="ks">Nero Network</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vnkbz-toc-outer">
    <div class="vnkbz-cnt">
      <nav class="vnkbz-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu">Проблема</a>
        <a href="#kak-rabotaet">Как работает RAG</a>
        <a href="#etapy">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#kpi">KPI</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="vnkbz-section" id="pochemu">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">Проблема</span>
        <h2>Почему операторы отвечают по-разному — и как это лечит AI-база знаний</h2>
      </div>
      <div class="vnkbz-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Определение проблемы:</strong> неконсистентность ответов — когда разные операторы по одному и тому же вопросу ссылаются на разные инструкции, устаревшие PDF или личный опыт. Это снижает доверие клиентов и увеличивает нагрузку на эскалацию.</p>
<p>По данным Salesforce (цитата в материале IBM, 2026), потребители регулярно используют до <strong>девяти каналов</strong> коммуникации с брендом. Если в Telegram одно, на сайте другое, а в email третье — клиент не получает <strong>единых ответов операторов поддержки</strong>. AI-база знаний техподдержка решает это на уровне источника: один индекс утверждённых документов, одна логика ответа.</p>
<h3>Разрозненные инструкции в папках, wiki и чатах</h3>
<p>Типичная картина: регламент возврата лежит в PDF на общем диске, актуальная версия — в Confluence, а операторы переписывают друг другу «как правильно» в Telegram-чате. Wiki без семантического поиска не находит ответ, если клиент спросил иначе, чем сформулирован заголовок статьи.</p>
<p>В кейсе <strong>Альфа-Банка</strong> (KTS) операторы тратили в среднем <strong>60 секунд</strong> на ручной поиск в wiki по одному запросу. После внедрения RAG-платформы время поиска сократилось до <strong>3 секунд</strong> — в <strong>20 раз</strong> быстрее. Это не магия чат-бота, а <strong>rag техподдержка</strong>: векторный поиск по индексу + ответ с цитатой.</p>
<h3>Потери времени на поиск ответа в тикете</h3>
<p>Каждая минута поиска — это задержка <strong>времени первого ответа (FRT)</strong> и рост очереди. В том же кейсе Альфа-Банка среднее время обработки обращения сократилось на <strong>40 секунд</strong> (с 5 минут до 4:20). Для команды из 10–50 операторов это десятки часов в день, которые можно вернуть в решение сложных кейсов.</p>
<p><strong>Итог по боли:</strong> без единой AI knowledge base поддержка платит временем, репутацией и деньгами за каждый тикет, где оператор «вспоминает на память» вместо того, чтобы процитировать инструкцию.</p>
<h3>Риски неконсистентных ответов клиентам</h3>
<p>Разные трактовки одного регламента ведут к спорам, возвратам, жалобам и повторным обращениям. Исследование Deloitte (цитата РБК, 2024): <strong>87% клиентов</strong> при сложных вопросах всё равно требуют живого оператора — но это не отменяет требования к <strong>точности</strong> первичного ответа. Ошибка на первой линии дороже, чем задержка на 30 секунд.</p>
<p>AI-база знаний техподдержка для бизнеса даёт оператору <strong>черновик из утверждённого источника</strong> (режим copilot): человек редактирует и отправляет, а клиент видит согласованную формулировку. Это принципиально иной уровень, чем «свободный» чат-бот без привязки к документам.</p>
      </div>
    </div>
  </section>

  <section class="vnkbz-section vnkbz-section-alt" id="kak-rabotaet">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">RAG</span>
        <h2>Что такое AI-база знаний для техподдержки и чем она отличается от обычной wiki</h2>
      </div>
      <div class="vnkbz-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Определение:</strong> AI-база знаний для техподдержки — корпоративный <strong>ai knowledge base</strong> с модулем генерации ответов на основе <strong>RAG (Retrieval-Augmented Generation)</strong>. Система ищет релевантные фрагменты в ваших PDF, Confluence, Notion и регламентах, а языковая модель формирует ответ <strong>только из найденного</strong> — с указанием документа-источника.</p>
<p>Обычная wiki — это хранилище. RAG-база знаний — это <strong>активный ассистент</strong>: понимает вопрос на естественном языке, находит нужный абзац и выдаёт <strong>ai ответы из базы знаний</strong>, а не ссылку «почитайте раздел 4.2».</p>
<div class="vnkbz-table-wrap"><table class="vnkbz-table">
<tr><th>Критерий</th><th>Обычный чат-бот</th><th>Wiki / FAQ</th><th>RAG-база знаний</th></tr>
<tr><td>---</td><td>---</td><td>---</td><td>---</td></tr>
<tr><td>Источник ответа</td><td>Сценарии, «память» модели</td><td>Статьи вручную</td><td>Утверждённые документы</td></tr>
<tr><td>Цитата источника</td><td>Нет</td><td>Ссылка на статью</td><td>Фрагмент + документ</td></tr>
<tr><td>Риск галлюцинаций</td><td>Высокий</td><td>Нет (но долгий поиск)</td><td>Низкий при faithfulness-gate</td></tr>
<tr><td>Обновление</td><td>Переписывание сценариев</td><td>Ручное</td><td>Автоиндексация при правке</td></tr>
<tr><td>Copilot для оператора</td><td>Редко</td><td>Нет</td><td>Да</td></tr>
</table></div>
<p>По отчёту <strong>Menlo Ventures (2024)</strong>, доля RAG в enterprise AI-приложениях выросла с <strong>31% до 51%</strong>; fine-tuning используют лишь <strong>9%</strong> production-моделей. Для техподдержки RAG — практичный путь: не переобучать модель, а подключить <strong>ваши</strong> инструкции.</p>
<h3>RAG: ответ только из утверждённых документов</h3>
<p><strong>Как работает пайплайн RAG:</strong></p>
<ol>
<li>1. <strong>Индексация</strong> — парсинг PDF, DOCX, Markdown, HTML; разбиение на чанки; векторные embeddings.</li>
<li>2. <strong>Retrieval</strong> — семантический поиск по запросу клиента или оператора; rerank по релевантности.</li>
<li>3. <strong>Generation</strong> — LLM (YandexGPT, GigaChat, OpenAI, Claude) синтезирует ответ из найденных фрагментов.</li>
<li>4. <strong>Citation</strong> — в ответе блок «Источник: [документ, раздел]».</li>
<li>5. <strong>Faithfulness-gate</strong> — если уверенность ниже порога, система не генерирует ответ, а эскалирует к оператору.</li>
</ol>
<p>Типовой стек: Qdrant, pgvector или Elasticsearch как векторное хранилище; оркестратор retrieval + rerank; интеграция в CRM, тикеты и чат.</p>
<h3>Цитата документа-источника в каждом ответе</h3>
<p>Это ключевой дифференциатор Nero Network перед коробочными ботами. IBM watsonx называет такой подход <strong>conversational search с traceable sources</strong> — policy-grounded answers: ответ прослеживается до бизнес-документации.</p>
<p>В режиме copilot (по модели DeskPilot / Uvik для Zendesk и Intercom) оператор видит <strong>черновик + источник</strong> перед отправкой. Клиент в self-service получает тот же принцип: не «бот так решил», а «вот что написано в регламенте от 12.03.2026».</p>
<p>Кейс <strong>Timeweb Cloud</strong> (апрель 2026): RAG-ассистент в тикет-системе достиг <strong>96,3%</strong> качества ответов и <strong>90%</strong> CSAT после внедрения жёсткой привязки к базе знаний. До этого «голый» LLM без RAG давал <strong>64%</strong> CSAT и не снижал нагрузку на инженеров.</p>
<h3>Эскалация к оператору, когда в базе нет ответа</h3>
<p>Честная AI-база знаний техподдержка <strong>не додумывает</strong>. Если retrieval не нашёл релевантный контекст или faithfulness-score ниже порога — ответ: «В утверждённых инструкциях нет информации по этому вопросу, передаю оператору».</p>
<p>Обязательная эскалация настроена для billing, legal и конфликтных тем (практика Uvik, Bitmovin). <strong>МТС</strong> на Habr отмечает: RAG — промежуточный этап; дальше агент сам собирает данные по тикету, но <strong>без</strong> grounded-ответа из Confluence/Jira такой путь невозможен.</p>
<p><strong>Коротко:</strong> RAG техподдержка = скорость поиска wiki + дисциплина регламента + прозрачность источника.</p>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

<section id="vnedrenie-ai-baza-znanij-tehpodderzhka-boris-block" class="bkb-root" aria-label="Как работает RAG-пайплайн: от запроса оператора до ответа с цитатой инструкции">
<style>
/* === БОРИС: prefix bkb-, scoped внутри #vnedrenie-ai-baza-znanij-tehpodderzhka-boris-block === */
.bkb-root{padding:56px 0 64px;background:#f8fafc;}
.bkb-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
.bkb-card{
  display:grid;
  grid-template-columns:42% 58%;
  border-radius:22px;
  overflow:hidden;
  box-shadow:0 8px 40px rgba(15,23,42,.11),0 0 0 1px rgba(14,165,233,.12);
  min-height:500px;
  background:#fff;
}
@media(max-width:1024px){.bkb-card{grid-template-columns:1fr;min-height:auto;}}
.bkb-lft{
  padding:44px 38px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1024px){.bkb-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
.bkb-ey{
  display:inline-flex;
  align-items:center;
  gap:7px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.1em;
  text-transform:uppercase;
  color:#0284c7;
  margin:0 0 14px;
}
.bkb-ey::before{
  content:'';
  display:inline-block;
  width:18px;height:2px;
  background:#0284c7;
  border-radius:1px;
}
.bkb-h3{
  font-size:24px;
  font-weight:800;
  color:#0f172a;
  line-height:1.32;
  margin:0 0 20px;
}
@media(max-width:600px){.bkb-h3{font-size:20px;}}
.bkb-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:10px;
}
.bkb-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14.5px;
  line-height:1.5;
  color:#334155;
}
.bkb-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(2,132,199,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0284c7;
  margin-top:1px;
  font-style:normal;
}
.bkb-pills{
  display:flex;
  flex-wrap:wrap;
  gap:7px;
  margin-bottom:18px;
}
.bkb-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
.bkb-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
.bkb-pl-b{background:rgba(2,132,199,.08);color:#0369a1;border:1.5px solid rgba(2,132,199,.22);}
.bkb-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
.bkb-foot{
  font-size:13.5px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
.bkb-rgt{
  background:linear-gradient(145deg,#060a18 0%,#0c1228 50%,#080d1e 100%);
  position:relative;
  overflow:hidden;
  min-height:420px;
}
@media(max-width:1024px){.bkb-rgt{min-height:380px;}}
#bkb-rag-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bkb-cnt">
<div class="bkb-card">

  <div class="bkb-lft">
    <span class="bkb-ey">RAG в действии</span>
    <h3 class="bkb-h3">Запрос оператора → поиск по инструкциям → ответ с цитатой источника</h3>
    <ul class="bkb-ul">
      <li><span class="bkb-ic">1</span>Семантический поиск по PDF, Confluence и wiki — не по ключевым словам</li>
      <li><span class="bkb-ic">2</span>LLM формирует черновик <strong>только</strong> из найденных фрагментов</li>
      <li><span class="bkb-ic">3</span>Блок «Источник: документ, раздел» в каждом ответе</li>
      <li><span class="bkb-ic">4</span>Faithfulness-gate: низкая уверенность — эскалация, не галлюцинация</li>
    </ul>
    <div class="bkb-pills">
      <span class="bkb-pl bkb-pl-g">60 сек → 3 сек</span>
      <span class="bkb-pl bkb-pl-b">citation в ответе</span>
      <span class="bkb-pl bkb-pl-v">faithfulness-gate</span>
    </div>
    <p class="bkb-foot">Дальше — как мы внедряем AI-базу знаний под ключ →</p>
  </div>

  <div class="bkb-rgt">
    <canvas
      id="bkb-rag-pipeline-canvas"
      aria-label="Анимация RAG-пайплайна: запрос в тикете, поиск по документам, черновик ответа с цитатой регламента"
      role="img"
    ></canvas>
  </div>

</div>
</div>

<script>
(function(){
  var cv = document.getElementById('bkb-rag-pipeline-canvas');
  if (!cv) return;
  var cx = cv.getContext('2d');
  var W = 0, H = 0, fr = 0, pulse = 0;
  var LOOP = 680;

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
    sky:'#38bdf8', skyD:function(a){return 'rgba(56,189,248,'+a+')';},
    green:'#4ade80', greenD:function(a){return 'rgba(74,222,128,'+a+')';},
    viol:'#a78bfa', violD:function(a){return 'rgba(167,139,250,'+a+')';},
    amber:'#fbbf24', amberD:function(a){return 'rgba(251,191,36,'+a+')';},
    text:'#e2e8f0',
    muted:'rgba(226,232,240,.45)',
    card:'rgba(255,255,255,.06)',
    cardBdr:'rgba(255,255,255,.11)',
    line:'rgba(255,255,255,.08)'
  };

  var DOCS = [
    {label:'PDF', sub:'Регламент возврата', icon:'\uD83D\uDCC4', matchAt:90},
    {label:'Confluence', sub:'FAQ доставки', icon:'\uD83D\uDCDA', matchAt:999},
    {label:'Notion', sub:'Тарифы 2026', icon:'\uD83D\uDCDD', matchAt:999}
  ];

  var PHASES = {
  Q_START:40, SEARCH:100, MATCH:180, DRAFT:280, GATE:380, SENT:480, RESET:620
  };

  function rr(x,y,w,h,r,fill,stroke,lw){
    cx.beginPath();
    if(cx.roundRect){cx.roundRect(x,y,w,h,r);}
    else{
      cx.moveTo(x+r,y);cx.arcTo(x+w,y,x+w,y+h,r);
      cx.arcTo(x+w,y+h,x,y+h,r);cx.arcTo(x,y+h,x,y,r);
      cx.arcTo(x,y,x+w,y,r);cx.closePath();
    }
    if(fill){cx.fillStyle=fill;cx.fill();}
    if(stroke){cx.strokeStyle=stroke;cx.lineWidth=lw||1.5;cx.stroke();}
  }

  function clipText(txt, maxW, font){
    cx.font = font;
    if(cx.measureText(txt).width <= maxW) return txt;
    while(txt.length > 3 && cx.measureText(txt+'\u2026').width > maxW) txt = txt.slice(0,-1);
    return txt+'\u2026';
  }

  function drawHeader(){
    cx.fillStyle = C.text;
    cx.font = 'bold 12px Inter,system-ui,sans-serif';
    cx.textAlign = 'left';
    cx.fillText('RAG Copilot  \u2014  тикет #4821', 14, 22);

    var live = 5 + Math.sin(pulse*0.08)*2;
    cx.beginPath(); cx.arc(W-58, 18, live+5, 0, Math.PI*2);
    cx.fillStyle = C.greenD(0.12 + 0.06*Math.sin(pulse*0.08));
    cx.fill();
    cx.beginPath(); cx.arc(W-58, 18, 4, 0, Math.PI*2);
    cx.fillStyle = C.green; cx.fill();
    cx.fillStyle = C.green;
    cx.font = '10px Inter,system-ui,sans-serif';
    cx.fillText('retrieval live', W-48, 22);

    cx.strokeStyle = C.line; cx.lineWidth = 1;
    cx.beginPath(); cx.moveTo(0, 34); cx.lineTo(W, 34); cx.stroke();
  }

  function drawTicket(phase){
    var tx = 14, ty = 44, tw = W*0.44, th = 52;
    if(tw > 280) tw = 280;
    var alpha = phase >= PHASES.Q_START ? Math.min(1, (phase-PHASES.Q_START)/30) : 0;
    if(alpha <= 0) return;
    cx.globalAlpha = alpha;
    rr(tx, ty, tw, th, 10, C.skyD(0.08), C.skyD(0.28), 1.5);
    cx.fillStyle = C.sky;
    cx.font = 'bold 10px Inter,sans-serif';
    cx.textAlign = 'left';
    cx.fillText('Запрос клиента', tx+10, ty+16);
    cx.fillStyle = C.text;
    cx.font = '11px Inter,sans-serif';
    var q = 'Могу вернуть товар через 20 дней?';
    cx.fillText(clipText(q, tw-20, '11px Inter,sans-serif'), tx+10, ty+34);
    cx.globalAlpha = 1;
  }

  function drawDocs(phase){
    var dx = 14, dy = 108, dw = (W*0.38 > 200 ? 200 : W*0.38), dh = 54, gap = 8;
    cx.fillStyle = C.muted;
    cx.font = 'bold 10px Inter,sans-serif';
    cx.textAlign = 'left';
    cx.fillText('БАЗА ЗНАНИЙ', dx, dy-6);

    DOCS.forEach(function(doc, i){
      var y = dy + i*(dh+gap);
      var matched = phase >= PHASES.MATCH && i === 0;
      var searching = phase >= PHASES.SEARCH && phase < PHASES.MATCH;
      var scanPulse = searching ? 0.5+0.5*Math.sin(pulse*0.15+i) : 0;
      var bg = matched ? C.greenD(0.14) : searching ? C.violD(0.06+scanPulse*0.08) : C.card;
      var bdr = matched ? C.greenD(0.35) : searching ? C.violD(0.2+scanPulse*0.15) : C.cardBdr;
      rr(dx, y, dw, dh, 8, bg, bdr, 1.5);

      cx.fillStyle = C.text;
      cx.font = '16px sans-serif';
      cx.textAlign = 'left';
      cx.fillText(doc.icon, dx+10, y+22);
      cx.fillStyle = matched ? C.green : C.text;
      cx.font = 'bold 11px Inter,sans-serif';
      cx.fillText(doc.label, dx+34, y+18);
      cx.fillStyle = C.muted;
      cx.font = '10px Inter,sans-serif';
      cx.fillText(clipText(doc.sub, dw-44, '10px Inter,sans-serif'), dx+34, y+34);

      if(matched){
        cx.fillStyle = C.green;
        cx.font = 'bold 12px sans-serif';
        cx.textAlign = 'right';
        cx.fillText('\u2713', dx+dw-10, y+22);
        var beamX = dx+dw, beamY = y+dh/2;
        var t = Math.min(1, (phase-PHASES.MATCH)/40);
        cx.strokeStyle = C.greenD(0.4*t);
        cx.lineWidth = 2;
        cx.setLineDash([4,4]);
        cx.beginPath();
        cx.moveTo(beamX, beamY);
        cx.lineTo(beamX+60*t, beamY);
        cx.stroke();
        cx.setLineDash([]);
      }
    });
  }

  function drawRetrieval(phase){
    if(phase < PHASES.SEARCH || phase > PHASES.GATE+40) return;
    var cx0 = W*0.48, cy0 = H*0.42;
    var r = 36 + Math.sin(pulse*0.06)*4;

    if(phase < PHASES.MATCH){
      for(var i=0;i<5;i++){
        var ang = (i/5)*Math.PI*2 + pulse*0.04;
        cx.beginPath();
        cx.arc(cx0+Math.cos(ang)*r, cy0+Math.sin(ang)*r, 3, 0, Math.PI*2);
        cx.fillStyle = C.violD(0.5+0.3*Math.sin(pulse*0.1+i));
        cx.fill();
      }
      cx.fillStyle = C.viol;
      cx.font = 'bold 10px Inter,sans-serif';
      cx.textAlign = 'center';
      cx.fillText('retrieval', cx0, cy0+4);
    } else {
      rr(cx0-44, cy0-28, 88, 56, 12, C.violD(0.12), C.violD(0.3), 1.5);
      cx.fillStyle = C.viol;
      cx.font = 'bold 9px Inter,sans-serif';
      cx.textAlign = 'center';
      cx.fillText('чанк найден', cx0, cy0-10);
      cx.fillStyle = C.text;
      cx.font = '9px Inter,sans-serif';
      cx.fillText('п.4.2 — срок 14 дней', cx0, cy0+6);
      cx.fillStyle = C.muted;
      cx.font = '8px Inter,sans-serif';
      cx.fillText('score 0.94', cx0, cy0+20);
    }
  }

  function drawDraft(phase){
    if(phase < PHASES.DRAFT) return;
    var ax = W*0.52, ay = H*0.58;
    var aw = W - ax - 14;
    if(aw > 300) aw = 300;
    if(aw < 160) ax = W - aw - 14;
    var ah = 118;
    var t = Math.min(1, (phase-PHASES.DRAFT)/35);
    cx.globalAlpha = t;

    rr(ax, ay, aw, ah, 10, C.greenD(0.1), C.greenD(0.28), 1.5);
    cx.fillStyle = C.green;
    cx.font = 'bold 10px Inter,sans-serif';
    cx.textAlign = 'left';
    cx.fillText('Черновик ответа', ax+10, ay+16);

    cx.fillStyle = C.text;
    cx.font = '10px Inter,sans-serif';
    var lines = [
      'Возврат возможен в течение',
      '14 дней с момента получения.',
      'Через 20 дней — отказ.'
    ];
    lines.forEach(function(ln, i){
      cx.fillText(ln, ax+10, ay+34+i*14);
    });

    rr(ax+8, ay+ah-28, aw-16, 20, 5, C.skyD(0.15), null, 0);
    cx.fillStyle = C.sky;
    cx.font = '9px Inter,sans-serif';
    cx.textAlign = 'left';
    cx.fillText('\uD83D\uDCC4 Источник: Регламент возврата, п.4.2', ax+14, ay+ah-14);
    cx.globalAlpha = 1;
  }

  function drawGate(phase){
    if(phase < PHASES.GATE) return;
    var gx = 14, gy = H - 52, gw = 130, gh = 36;
    var t = Math.min(1, (phase-PHASES.GATE)/25);
    cx.globalAlpha = t;
    var pass = phase < PHASES.RESET;
    rr(gx, gy, gw, gh, 8, pass ? C.greenD(0.12) : C.amberD(0.12), pass ? C.greenD(0.3) : C.amberD(0.3), 1.5);
    cx.fillStyle = pass ? C.green : C.amber;
    cx.font = 'bold 10px Inter,sans-serif';
    cx.textAlign = 'left';
    cx.fillText(pass ? '\u2713 faithfulness 96%' : '\u26A0 эскалация', gx+10, gy+14);
    cx.fillStyle = C.muted;
    cx.font = '9px Inter,sans-serif';
    cx.fillText(pass ? 'grounded в источнике' : 'вне базы знаний', gx+10, gy+28);
    cx.globalAlpha = 1;
  }

  function drawOperator(phase){
    if(phase < PHASES.SENT) return;
    var ox = W - 150, oy = H - 52;
    var t = Math.min(1, (phase-PHASES.SENT)/20);
    cx.globalAlpha = t;
    rr(ox, oy, 136, 36, 8, C.skyD(0.15), C.skyD(0.35), 1.5);
    cx.fillStyle = C.sky;
    cx.font = 'bold 10px Inter,sans-serif';
    cx.textAlign = 'center';
    cx.fillText('Оператор отправил \u2713', ox+68, oy+22);
    cx.globalAlpha = 1;
  }

  function drawSearchRays(phase){
    if(phase < PHASES.SEARCH || phase >= PHASES.MATCH) return;
    var fromX = W*0.22, fromY = 130;
    var toX = W*0.48, toY = H*0.42;
    var prog = Math.min(1, (phase-PHASES.SEARCH)/50);
    cx.strokeStyle = C.violD(0.15+0.2*Math.sin(pulse*0.12));
    cx.lineWidth = 1.5;
    cx.setLineDash([3,5]);
    for(var r=0;r<3;r++){
      var off = r*18;
      cx.beginPath();
      cx.moveTo(fromX, fromY+off);
      cx.lineTo(fromX+(toX-fromX)*prog, fromY+off+(toY-fromY-off)*prog*0.5);
      cx.stroke();
    }
    cx.setLineDash([]);
  }

  function frame(){
    fr = (fr+1) % LOOP;
    pulse++;
    var phase = fr;

    cx.clearRect(0,0,W,H);

  /* subtle grid */
    cx.strokeStyle = 'rgba(255,255,255,.03)';
    cx.lineWidth = 1;
    for(var g=0;g<W;g+=40){cx.beginPath();cx.moveTo(g,0);cx.lineTo(g,H);cx.stroke();}
    for(var g2=0;g2<H;g2+=40){cx.beginPath();cx.moveTo(0,g2);cx.lineTo(W,g2);cx.stroke();}

    drawHeader();
    drawTicket(phase);
    drawDocs(phase);
    drawSearchRays(phase);
    drawRetrieval(phase);
    drawDraft(phase);
    drawGate(phase);
    drawOperator(phase);

    requestAnimationFrame(frame);
  }
  frame();
})();
</script>
</section>

  <section class="vnkbz-section" id="etapy">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">Внедрение</span>
        <h2>Как мы внедряем AI-базу знаний для техподдержки под ключ</h2>
      </div>
      <div class="vnkbz-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Внедрение ai</strong> в бизнес-процессы поддержки — проектная работа, а не установка плагина за вечер. Nero Network ведёт <strong>внедрение ai база знаний техподдержка под ключ</strong> по этапам с измеримыми KPI на каждом шаге. Ориентир сроков полного цикла: <strong>6–10 недель</strong> от аудита до production (зависит от объёма документов и интеграций).</p>
<h3>Аудит базы знаний поддержки (лид-магнит)</h3>
<p>Первый этап — <strong>аудит базы знаний поддержки</strong> (3–5 рабочих дней). Мы инвентаризируем PDF, wiki, Confluence, Notion, решённые тикеты; находим дубли, устаревшие версии и «серые зоны», где операторы отвечают из головы.</p>
<p>На выходе — карта каналов (сайт, Telegram, email, CRM), список приоритетных документов для индексации и <strong>eval-набор</strong> из 50–200 реальных вопросов клиентов. Это фундамент для честных метрик faithfulness, а не маркетинговых «минус 80% нагрузки» без методологии.</p>
<p><strong>Аудит базы знаний — бесплатно</strong> при заказе внедрения. Отдельно аудит помогает понять, готова ли ваша документация к RAG.</p>
<h3>Индексация PDF, Confluence, Notion и внутренних wiki</h3>
<p>Подготовка данных (1–2 недели): конвертация в структурированный Markdown, <strong>единый смысл на файл</strong> — один из шести принципов подготовки БЗ по опыту Timeweb Cloud:</p>
<ol>
<li>1. Единый смысл в одном файле (не смешивать возврат и доставку в одной статье).</li>
<li>2. Markdown-разметка для заголовков и списков.</li>
<li>3. Разделение промпта системы и содержимого БЗ.</li>
<li>4. Версионность документов с датой и владельцем.</li>
<li>5. Реальные формулировки клиентов в FAQ-блоках.</li>
<li>6. Еженедельный разбор негативных ответов и доработка пробелов.</li>
</ol>
<p>Технически: парсер → chunking → embeddings → векторная БД с metadata (продукт, роль, версия, дата). При правке документа webhook обновляет индекс — как в кейсе Альфа-Банка с автообновлением при правках редакторов.</p>
<h3>Настройка политик доступа и актуализации инструкций</h3>
<p><strong>RBAC на уровне retrieval</strong> — обязательный элемент. В кейсе Альфа-Банка учтены уровни доступа операторов к статьям; кеширование тоже разграничено по правам. Без этого RAG может показать конфиденциальный внутренний регламент клиенту в self-service.</p>
<p>Мы настраиваем:</p>
<ul>
<li>фильтры по роли (оператор 1-й линии / старший / клиент);</li>
<li>фильтры по продукту и версии тарифа;</li>
<li>запрещённые темы для автогенерации;</li>
<li>политику хранения: on-prem, YandexGPT / GigaChat для РФ-контура, без передачи ПД в промпт (152-ФЗ).</li>
</ul>
<h3>Пилот на реальных тикетах и замер KPI</h3>
<p>MVP RAG (2–3 недели): ответ с citation + faithfulness-gate. Пилот «стажёр» (2–4 недели) по модели Timeweb: AI предлагает черновик, оператор принимает или отклоняет. Так снижается страх галлюцинаций и падает риск для CSAT.</p>
<p>Замеряем FRT, долю автозакрытия, faithfulness (RAGAS-метрики), CSAT операторов. Только после прохождения quality gate — расширение на self-service и автономные ответы клиентам.</p>
<!-- CTA-1: после H2 «Как мы внедряем AI-базу знаний для техподдержки под ключ» -->
<div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
  <div class="ym-cta-block__icon" aria-hidden="true">📚</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы собрать AI-базу знаний для техподдержки?</p>
    <p class="ym-cta-block__sub">Начнём с бесплатного аудита базы знаний поддержки: инвентаризация документов, eval-набор из реальных тикетов и demo RAG на 3–5 ваших вопросах. Без обязательств.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn" target="_blank" rel="noopener noreferrer"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>
      </div>
    </div>
  </section>

  <section class="vnkbz-section vnkbz-section-alt" id="integracii">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">Интеграции</span>
        <h2>Интеграция AI-базы знаний с CRM и системами поддержки</h2>
      </div>
      <div class="vnkbz-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Ai база знаний техподдержка интеграция crm</strong> — не опция, а условие единого голоса бренда. Ответ должен появляться там, где уже ведётся диалог: в тикете, open line, мессенджере, виджете на сайте.</p>
<h3>Zendesk, Freshdesk, Intercom</h3>
<p>Для международных стеков реализуем <strong>RAG copilot</strong> по модели DeskPilot: черновик ответа внутри интерфейса агента, видимые source references, confidence thresholds. Оператор не переключается между вкладками — подсказка с цитатой прямо в тикете.</p>
<p>Сценарий: клиент пишет в Intercom → RAG находит раздел документации → оператор видит draft + ссылку на источник → редактирует и отправляет. Billing и legal — mandatory escalation без автогенерации.</p>
<h3>Битрикс24 и amoCRM</h3>
<p><strong>Ai база знаний техподдержка в CRM</strong> для российского рынка — частый запрос. В Битрикс24 есть коробочный «Агент для поиска по базе знаний» с RAG в Космос, но коробка ≠ ваши регламенты, eval-набор и кастомная логика эскалации.</p>
<p>Nero Network интегрирует RAG через:</p>
<ul>
<li><strong>Битрикс24</strong> — open line, задачи, внутренний чат операторов;</li>
<li><strong>amoCRM</strong> — через Make.com / n8n + API: черновик ответа в карточке сделки, webhook на обновление индекса при смене статуса.</li>
</ul>
<p>Преимущество проектной модели: без vendor lock-in, единый индекс для CRM + Telegram + сайта — в духе тренда IBM 2026 на <strong>унификацию данных</strong> контакт-центра.</p>
<h3>Telegram-бот и виджет на сайте</h3>
<p>Self-service для типовых FAQ: статус заказа, условия возврата, настройка продукта. <strong>Чат-бот техподдержка база знаний</strong> на RAG закрывает первую линию, не подменяя оператора на сложных кейсах.</p>
<p>Виджет на сайте и Telegram-бот подключаются к одному индексу — клиент получает те же <strong>ai ответы из базы знаний</strong>, что и оператор в CRM. Lorikeet (2026) фиксирует: median cost self-service <strong>$1.84</strong> vs agent-assisted <strong>$13.50</strong> (Gartner via Lorikeet) — экономический аргумент для автоматизации типовых запросов.</p>
      </div>
    </div>
  </section>

  <section class="vnkbz-section" id="kpi">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">Метрики</span>
        <h2>KPI внедрения: что измеряем после запуска</h2>
      </div>
      <div class="vnkbz-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Коротко:</strong> без цифр внедрение ai в бизнес процессы поддержки превращается в «поставили бота». Мы фиксируем baseline до пилота и сравниваем после — с оговоркой: агрессивные vendor-обещания «70–80% deflection» часто не совпадают с полевой реальностью (Digital Applied 2026: median Zendesk deflection <strong>41,2%</strong>).</p>
<div class="vnkbz-table-wrap"><table class="vnkbz-table">
<tr><th>KPI</th><th>Что измеряем</th><th>Ориентиры из кейсов</th></tr>
<tr><td>---</td><td>---</td><td>---</td></tr>
<tr><td>FRT (время первого ответа)</td><td>Секунды до первого ответа клиенту</td><td>Альфа-Банк: −40 сек на обращение; Softwave (интегратор): часы → 5 сек</td></tr>
<tr><td>Доля автозакрытия</td><td>% тикетов без участия оператора</td><td>Timeweb: частичная автономия; vendor median ~41%</td></tr>
<tr><td>Faithfulness / точность</td><td>Ответ grounded в источнике</td><td>Timeweb: 96,3%; RAGAS faithfulness gate</td></tr>
<tr><td>Консистентность</td><td>% ответов с citation</td><td>Ключевой дифференциатор vs «голый» чат-бот</td></tr>
<tr><td>CSAT / NPS операторов</td><td>Удобство copilot</td><td>Альфа-Банк: 93% положительных оценок операторов</td></tr>
<tr><td>Нагрузка на 1-ю линию</td><td>Тикеты на оператора</td><td>Timeweb: −22%+; Softwave (интегратор): −45%</td></tr>
</table></div>
<h3>Время первого ответа (FRT)</h3>
<p>FRT — первый метрика, которую видит клиент. RAG сокращает не только поиск в wiki, но и время формулировки: оператор отправляет отредактированный черновик вместо набора с нуля.</p>
<h3>Доля автозакрытия тикетов</h3>
<p>Автозакрытие растёт на типовых FAQ: «как сбросить пароль», «срок возврата», «статус заявки». Сложные и эмоциональные кейсы — к человеку: <strong>87%</strong> клиентов при сложных вопросах требуют оператора (Deloitte via РБК, 2024).</p>
<h3>Консистентность ответов операторов и бота</h3>
<p>Главная цель <strong>ai база знаний техподдержка для бизнеса</strong> — один регламент, одна формулировка, один источник. Измеряем долю ответов с корректной citation и совпадение с эталоном из eval-набора.</p>
<p><strong>Итог:</strong> KPI привязаны к вашему baseline, а не к чужим слайдам. Nubank (eval-driven framework) показывает: устойчивый рост self-service (+29 п.п.) возможен только через цикл eval → A/B → production.</p>
      </div>
    </div>
  </section>

  <section class="vnkbz-section vnkbz-section-alt" id="ceny">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">Цена</span>
        <h2>Сколько стоит AI-база знаний для техподдержки</h2>
      </div>
      <div class="vnkbz-prose nero-ai-reveal nero-ai-delay-1">
<p>Вопрос <strong>«сколько стоит ai база знаний техподдержка»</strong> закономерен. Цена зависит не от «количества нейронов», а от объёма документов, каналов и требований к безопасности.</p>
<h3>Из чего складывается смета (объём документов, интеграции, SLA)</h3>
<p>Факторы цены:</p>
<ul>
<li><strong>Объём и качество БЗ</strong> — 50 страниц PDF vs 500+ страниц Confluence с дублями (после аудита объём может сократиться).</li>
<li><strong>Количество интеграций</strong> — виджет + Telegram vs CRM + телефония + несколько продуктовых линий.</li>
<li><strong>Контур данных</strong> — облако vs on-prem; YandexGPT/GigaChat vs зарубежные API.</li>
<li><strong>Режим запуска</strong> — только copilot vs self-service с автозакрытием.</li>
<li><strong>SLA и поддержка</strong> — мониторинг faithfulness, еженедельный разбор негативных ответов.</li>
</ul>
<h3>Ориентир чека 250–800 тыс. ₽ и что входит в пакет</h3>
<p>Ориентир чека Nero Network: <strong>250–800 тыс. ₽</strong> — между «сделайте сами в коробке Битрикс24» и enterprise-проектами от <strong>2,5 млн ₽</strong> (сегмент Format Koda). В пакет «под ключ» обычно входит:</p>
<ul>
<li>аудит базы знаний;</li>
<li>подготовка и индексация документов;</li>
<li>MVP RAG с citation и faithfulness-gate;</li>
<li>пилот «стажёр» на реальных тикетах;</li>
<li>1–2 интеграции (CRM и/или мессенджер + виджет);</li>
<li>обучение команды поддержки и редакторов БЗ;</li>
<li>отчёт KPI и рекомендации по масштабированию.</li>
</ul>
<p>Точная смета — после аудита и eval-набора. <strong>Ai база знаний техподдержка для малого бизнеса</strong> с одним каналом и компактной БЗ — ближе к нижней границе; SaaS с несколькими продуктами и CRM — к верхней.</p>
<h3>Когда окупается за счёт сокращения времени операторов</h3>
<p>Окупаемость считаем через FRT, AHT и разгрузку 1-й линии — не через «AI заменит всех». Пример: команда 15 операторов, экономия 40 секунд на тикет при 200 тикетах в день — это более 33 операторо-часов в месяц только на поиске. Плюс снижение повторных обращений из-за неконсистентных ответов.</p>
<p>Кейс Softwave (публикует интегратор Flow Masters, цифры со страницы кейса): время ответа <strong>2–4 часа → 5 секунд</strong>; <strong>45%</strong> тикетов закрывает RAG. Используем как ориентир с оговоркой об источнике, не как гарантию.</p>
      </div>
    </div>
  </section>

  <section class="vnkbz-section" id="dlya-kogo">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">Сегменты</span>
        <h2>Для кого подходит: SaaS, e-commerce и сервисные центры</h2>
      </div>
      <div class="vnkbz-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Ai база знаний техподдержка для бизнеса</strong> окупается там, где инструкций много, а операторов недостаточно, чтобы держать всё в голове.</p>
<h3>Техподдержка SaaS с растущей базой инструкций</h3>
<p>SaaS-команды обновляют документацию еженедельно: новые фичи, тарифы, API. RAG с автоиндексацией снимает риск устаревших ответов. Кейс <strong>«СофтВейв»</strong> (Flow Masters): RAG на <strong>500+</strong> страниц документации SaaS.</p>
<p>Позиция <strong>МТС</strong>: RAG — первый этап, далее агент анализирует тикеты в Jira/Confluence. Для растущего SaaS это понятная дорожная карта.</p>
<h3>Интернет-магазины и сервисные центры</h3>
<p>E-commerce и сервисные центры: возвраты, гарантия, статус ремонта, совместимость — типовые вопросы с жёсткими регламентами. Self-service в виджете и Telegram разгружает сезонные пики без найма временных операторов.</p>
<p><strong>Автоматизация техподдержки ai</strong> здесь — не замена сервиса, а единый голос по регламенту в пик нагрузки.</p>
<h3>Команды без штатного разработчика AI</h3>
<p><strong>Ai база знаний техподдержка без программиста</strong> — реальный сценарий при внедрении под ключ. Nero Network берёт на себя индексацию, интеграции через Make/n8n, настройку faithfulness-gate и пилот. С вашей стороны — владелец контента БЗ, доступ к CRM и eval-вопросы из реальных тикетов.</p>
<p>Коробочный агент Битрикс24 не отменяет потребность в <strong>структурировании</strong> ваших регламентов и eval — без этого даже готовая платформа даёт слабый результат (опыт Сотбит: коробка отвечает «проверьте документацию»).</p>
<!-- CTA-2: после H3 «Команды без штатного разработчика AI» -->
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите разобраться в RAG и AI-автоматизации поддержки сами?</p>
    <p class="ym-cta-block__sub">Если команда хочет понимать принципы RAG, faithfulness-gate и интеграции через Make/n8n до старта проекта — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это помогает быстрее принимать решения на этапе пилота и говорить с подрядчиком на одном языке.</p>
  </div>
</aside>
      </div>
    </div>
  </section>

  <section class="vnkbz-section vnkbz-section-alt" id="keisy">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">Кейсы</span>
        <h2>Примеры и кейсы внедрения AI-базы знаний</h2>
      </div>
      <div class="vnkbz-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Ai база знаний техподдержка примеры внедрения</strong> и <strong>ai база знаний техподдержка кейсы</strong> — не абстракция. Ниже — проверенные публичные референсы и типовые сценарии Nero Network.</p>
<h3>Сценарий: единый ответ из регламента возврата</h3>
<p>Клиент: «Могу вернуть товар через 20 дней?» RAG находит пункт регламента возврата (срок 14 дней), формирует ответ с цитатой и ссылкой на документ. Оператор в copilot-режиме подтверждает и отправляет — клиент и коллега завтра получат <strong>ту же</strong> формулировку.</p>
<p>Без RAG один оператор скажет «нет», другой — «уточню у старшего», третий процитирует устаревший PDF на 30 дней.</p>
<h3>Сценарий: помощь оператору в сложном тикете</h3>
<p>Инженер Timeweb Cloud получает тикет по настройке VPS. RAG-ассистент в режиме «стажёра» предлагает черновик из шести принципов структурированной БЗ; инженер правит техническую деталь и отправляет. Качество выросло с <strong>74%</strong> до <strong>92%</strong> в режиме стажёра, итоговое — <strong>96,3%</strong>.</p>
<p>Альфа-Банк: <strong>12 000</strong> операторов, <strong>85 000+</strong> запросов в сутки, <strong>93%</strong> положительных оценок от операторов — масштаб copilot, а не игрушечного бота.</p>
<h3>Что показываем на demo RAG</h3>
<p>На демо Nero Network вы задаёте <strong>3–5 реальных вопросов</strong> из вашей поддержки. Мы показываем:</p>
<ul>
<li>найденный фрагмент документа;</li>
<li>сгенерированный ответ с citation;</li>
<li>срабатывание faithfulness-gate на вопрос вне БЗ;</li>
<li>эскалацию на billing/legal.</li>
</ul>
<p>Это сильнее презентации «минус 80% нагрузки» — вы видите поведение на <strong>ваших</strong> инструкциях.</p>
<p><strong>Международный контекст:</strong> Ring (Amazon Bedrock Knowledge Bases) масштабирует RAG-поддержку на 10 регионов с metadata-фильтрами; Bitmovin строит multi-agent triage (документация → диагностика → handoff). Для SMB в РФ достаточно первого этапа — grounded copilot + self-service.</p>
      </div>
    </div>
  </section>

  <section class="vnkbz-section" id="riski">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">Риски</span>
        <h2>Риски и как мы их закрываем</h2>
      </div>
      <div class="vnkbz-prose nero-ai-reveal nero-ai-delay-1">
<p>Честность про риски — часть E-E-A-T. Lorikeet (2026): <strong>88%</strong> контакт-центров используют AI, но только <strong>25%</strong> полностью интегрировали автоматизацию. Разрыв adoption vs outcomes — аргумент за методологию, а не коробку.</p>
<h3>Галлюцинации без жёсткого RAG</h3>
<p>«Голый» LLM без retrieval додумывает тарифы, сроки и условия. Решение: <strong>RAG + faithfulness-gate</strong> (метрика RAGAS Faithfulness). При низкой уверенности — отказ от генерации и эскалация. Timeweb до RAG: <strong>64%</strong> CSAT и ноль разгрузки; после — <strong>90%</strong> CSAT и <strong>−22%+</strong> нагрузки.</p>
<h3>Устаревшие инструкции</h3>
<p>Индекс без автообновления опаснее, чем его отсутствие: клиент получает уверенный, но устаревший ответ. Решение: webhook при правке документа в Confluence/Notion/Google Docs; версионность metadata; владелец документа в админке.</p>
<h3>Доступ к конфиденциальным документам</h3>
<p>RBAC на retrieval (кейс Альфа-Банка): оператор 1-й линии не видит внутренние регламенты для руководства; клиент в self-service — только публичные FAQ. Кеширование ответов тоже с учётом уровней доступа.</p>
<p>Дополнительно: RAG плохо работает с точными цифрами без структурированных данных — Timeweb планирует MCP для точных значений. На пилоте выявляем такие «дыры» и либо структурируем данные, либо оставляем эскалацию.</p>
<p><strong>Возражение «AI заменит операторов»:</strong> 87% сложных кейсов — к человеку. AI — суфлёр и ускоритель, не замена команды.</p>
      </div>
    </div>
  </section>

  <section class="vnkbz-section" id="faq">
    <div class="vnkbz-cnt">
      <div class="vnkbz-sh vnkbz-left nero-ai-reveal">
        <span class="vnkbz-eyebrow">FAQ</span>
        <h2>FAQ по AI-базе знаний для техподдержки</h2>
      </div>
      <div class="vnkbz-faq nero-ai-reveal nero-ai-delay-1">
<div class="vnkbz-faq-item nero-ai-reveal"><button type="button" class="vnkbz-faq-q" aria-expanded="false">Как внедрить AI-базу знаний для техподдержки?</button><div class="vnkbz-faq-a"><p><strong>Как внедрить ai база знаний техподдержка:</strong> (1) аудит документов и каналов; (2) подготовка БЗ по шести принципам структурирования; (3) MVP RAG с citation; (4) пилот «стажёр» на реальных тикетах; (5) интеграция в CRM/мессенджер; (6) production с еженедельным разбором качества. Срок — ориентир <strong>6–10 недель</strong> под ключ. Nero Network ведёт все этапы; старт — с бесплатного аудита базы знаний.</p></div></div>
<div class="vnkbz-faq-item nero-ai-reveal"><button type="button" class="vnkbz-faq-q" aria-expanded="false">Можно ли запустить без программиста?</button><div class="vnkbz-faq-a"><p>Да. <strong>Ai база знаний техподдержка без программиста</strong> — стандартный формат «под ключ»: интеграции через Make.com/n8n, настройка индекса и faithfulness-gate на стороне Nero Network. От вас — доступ к документам, CRM и согласование eval-вопросов. Штатный разработчик нужен только при жёстком on-prem или нестандартных legacy-системах.</p></div></div>
<div class="vnkbz-faq-item nero-ai-reveal"><button type="button" class="vnkbz-faq-q" aria-expanded="false">Какие документы нужны на старте?</button><div class="vnkbz-faq-a"><p>Минимум: регламенты, FAQ, инструкции (PDF, DOCX, Markdown), карта продуктов/тарифов, <strong>50–200 реальных вопросов</strong> из тикетов для eval. Желательно: решённые тикеты с проверенными ответами (практика Сотбит). Чем структурированнее документы — тем быстрее пилот.</p></div></div>
<div class="vnkbz-faq-item nero-ai-reveal"><button type="button" class="vnkbz-faq-q" aria-expanded="false">Как обновлять базу после изменения регламентов?</button><div class="vnkbz-faq-a"><p>Редактор правит документ в Confluence/Notion/Google Docs → webhook переиндексирует чанки → новые ответы сразу из актуальной версии. В админке — владелец документа, дата версии, отчёт «вопросы без ответа» для закрытия пробелов в БЗ.</p></div></div>
<div class="vnkbz-faq-item nero-ai-reveal"><button type="button" class="vnkbz-faq-q" aria-expanded="false">Подходит ли для малого бизнеса?</button><div class="vnkbz-faq-a"><p><strong>Ai база знаний техподдержка для малого бизнеса</strong> — да, при 5+ операторах или высокой доле повторяющихся вопросов. Компактная БЗ и один-два канала (виджет + Telegram) укладываются в нижний диапазон сметы <strong>250–400 тыс. ₽</strong>. Если тикетов мало и регламент на одной странице — достаточно хорошо структурированного FAQ; RAG окупается при росте объёма обращений.</p></div></div>
<div class="vnkbz-faq-item nero-ai-reveal"><button type="button" class="vnkbz-faq-q" aria-expanded="false">Бот будет врать?</button><div class="vnkbz-faq-a"><p>При жёстком RAG и faithfulness-gate — нет: ответ только из найденных фрагментов или эскалация. Без RAG риск галлюцинаций высокий — поэтому мы не рекомендуем «голый» чат-бот для поддержки.</p></div></div>
<div class="vnkbz-faq-item nero-ai-reveal"><button type="button" class="vnkbz-faq-q" aria-expanded="false">Сколько времени до первых результатов?</button><div class="vnkbz-faq-a"><p>MVP с ответами и citation — <strong>2–3 недели</strong> после аудита. Измеримый эффект по FRT и CSAT — после пилота «стажёр» (<strong>2–4 недели</strong>). Полный production с self-service — от <strong>6 недель</strong>.</p></div></div>
<div class="vnkbz-faq-item nero-ai-reveal"><button type="button" class="vnkbz-faq-q" aria-expanded="false">Чем отличается от коробки Битрикс24?</button><div class="vnkbz-faq-a"><p>Коробочный агент — стартовая точка. Nero Network настраивает <strong>ваши</strong> регламенты, eval, RBAC, интеграции amoCRM/Telegram, режим стажёра и честные KPI. Это кастом под процессы, а не универсальный поиск по публичной справке.</p></div></div>
<p><strong>Итог:</strong> AI-база знаний для техподдержки на RAG даёт <strong>единые ответы с цитатой инструкции</strong>, сокращает поиск с минут до секунд и безопасно запускается через режим «стажёра». Nero Network внедряет решение под ключ — от аудита до интеграции с CRM.</p>
<!-- CTA-3: после блока FAQ, перед footer -->
<div class="ym-cta-block ym-cta-block--dual" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Закажите аудит базы знаний и соберите AI-базу знаний под вашу поддержку</p>
    <p class="ym-cta-block__sub">Покажем ответы с цитатой из ваших инструкций, сработает ли faithfulness-gate и как интегрировать RAG в CRM или Telegram. Ориентир внедрения под ключ — 6–10 недель, чек 250–800 тыс. ₽.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Читать FAQ</a>
    </div>
  </div>
</div>
      </div>
    </div>
  </section>

  <!-- SCHEMA-MARKUP:INSERT -->

</div>

<script>
/**
 * vnkbz-rag-support-engine — Архив цитирования
 * Мир: стеллажи wiki → семантические лучи → RAG-консоль → луч цитаты оператору
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnkbz-rag-support-canvas");
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
    shelf: "#1e293b",
    shelfEdge: "#334155",
    docWhite: "#f8fafc",
    docGreen: "#a7f3d0",
    docBlue: "#93c5fd",
    docAmber: "#fde68a",
    beam: "rgba(121,242,255,0.35)",
    beamViolet: "rgba(139,92,246,0.45)",
    consoleBg: "#0f172a",
    consoleAccent: "#79f2ff",
    citeGreen: "#22c55e",
    gateRed: "#fb7185",
    nodeGlow: "rgba(139,92,246,0.55)",
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

  function drawMiniDoc(ctx, x, y, w, h, color, lines) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 2, color, C.outline);
    for (var i = 0; i < (lines || 2); i++) {
      drawRR(ctx, x - w / 2 + 3, y - h / 2 + 4 + i * 4, w - 6, 2, 1, "rgba(148,163,184,0.6)", null);
    }
  }

  /* Стеллажи wiki/PDF на заднем плане */
  function WikiShelfWall() {
    this.sway = 0;
  }
  WikiShelfWall.prototype.draw = function (ctx) {
    this.sway = Math.sin(frame * 0.02) * 2;
    var shelves = [-140, -70, 70, 140];
    shelves.forEach(function (sx, si) {
      drawRR(ctx, sx - 28 + this.sway * (si % 2 ? -1 : 1), 55, 56, 8, 2, C.shelfEdge, C.outline);
      for (var row = 0; row < 3; row++) {
        var dy = 30 + row * 18;
        var colors = [C.docWhite, C.docGreen, C.docBlue, C.docAmber];
        drawMiniDoc(ctx, sx + (row % 2 ? -8 : 8), dy, 14, 12, colors[(si + row) % 4], 2);
      }
    }, this);
  };

  /* Вертикальные семантические лучи — транспорт чанков (не конвейер) */
  function ChunkBeamStream() {
    this.phase = 0;
  }
  ChunkBeamStream.prototype.draw = function (ctx) {
    this.phase = (frame * 0.03) % 1;
    var beams = [
      { x: -75, color: C.beam },
      { x: -25, color: C.beamViolet },
      { x: 25, color: C.beam },
      { x: 75, color: C.beamViolet }
    ];
    beams.forEach(function (b) {
      var grad = ctx.createLinearGradient(b.x, 70, b.x, -85);
      grad.addColorStop(0, "rgba(121,242,255,0.02)");
      grad.addColorStop(0.5, b.color);
      grad.addColorStop(1, "rgba(139,92,246,0.05)");
      ctx.strokeStyle = grad;
      ctx.lineWidth = 2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.5;
      ctx.beginPath();
      ctx.moveTo(b.x, 75);
      ctx.lineTo(b.x, -80);
      ctx.stroke();
      ctx.setLineDash([]);

      for (var i = 0; i < 3; i++) {
        var t = (this.phase + i * 0.33) % 1;
        var cy = 70 - t * 145;
        var docColors = [C.docWhite, C.docGreen, C.docBlue];
        drawMiniDoc(ctx, b.x + Math.sin(frame * 0.05 + i) * 3, cy, 11, 10, docColors[i], 2);
      }
    }, this);
  };

  /* Пульсирующее поле embeddings */
  function EmbeddingNodeField() {
    this.nodes = [];
    for (var i = 0; i < 12; i++) {
      this.nodes.push({
        x: -120 + Math.random() * 240,
        y: -60 + Math.random() * 80,
        r: 2 + Math.random() * 3,
        phase: Math.random() * Math.PI * 2
      });
    }
  }
  EmbeddingNodeField.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 280;
    this.nodes.forEach(function (n) {
      var pulse = 0.4 + Math.sin(frame * 0.06 + n.phase) * 0.35;
      if (prg > 70 && prg < 200) pulse += 0.25;
      ctx.fillStyle = "rgba(139,92,246," + pulse + ")";
      ctx.beginPath();
      ctx.arc(n.x, n.y, n.r * (1 + pulse * 0.5), 0, Math.PI * 2);
      ctx.fill();
      if (prg > 90 && prg < 170) {
        ctx.strokeStyle = "rgba(121,242,255,0.15)";
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(n.x, n.y);
        ctx.lineTo(0, -35);
        ctx.stroke();
      }
    });
  };

  /* Центральная RAG-консоль copilot */
  function RagCitationConsole() {
    this.highlightLine = 0;
    this.citeBeam = 0;
  }
  RagCitationConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 280;

    drawRR(ctx, -62, -78, 124, 156, 10, C.consoleBg, C.outline);
    drawRR(ctx, -58, -74, 116, 22, [6, 6, 0, 0], "#1e293b", C.outline);
    ctx.fillStyle = C.consoleAccent;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("RAG COPILOT · DEMO", -54, -60);

    /* Фаза QUERY */
    if (prg >= 0) {
      drawRR(ctx, -54, -48, 108, 18, 4, "rgba(121,242,255,0.12)", C.consoleAccent);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "7px Inter,sans-serif";
      ctx.fillText("Вопрос: срок возврата товара?", -50, -36);
    }

    /* Фаза RETRIEVE — подсветка чанков */
    if (prg >= 70 && prg < 150) {
      var retAlpha = Math.min(1, (prg - 70) / 20);
      ctx.globalAlpha = retAlpha;
      var chunks = [
        { y: -22, label: "чанк §4.2", w: 0.92 },
        { y: -6, label: "чанк FAQ", w: 0.6 },
        { y: 10, label: "устар. PDF", w: 0.35 }
      ];
      chunks.forEach(function (ch, i) {
        var active = prg > 90 + i * 18;
        drawRR(ctx, -54, ch.y, 108 * ch.w, 12, 3, active ? "rgba(34,197,94,0.2)" : "rgba(255,255,255,0.06)", active ? C.citeGreen : C.outline);
        ctx.fillStyle = active ? "#bbf7d0" : "#94a3b8";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.fillText(ch.label, -50, ch.y + 8);
      });
      ctx.globalAlpha = 1;
    }

    /* Фаза GROUND — ответ */
    if (prg >= 150 && prg < 220) {
      drawRR(ctx, -54, 22, 108, 38, 5, "rgba(34,197,94,0.12)", C.citeGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Ответ: возврат в течение 14 дней", -50, 36);
      ctx.fillStyle = "#86efac";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("по регламенту от 12.03.2026", -50, 46);
      this.highlightLine = Math.sin(frame * 0.08) * 2;
      drawRR(ctx, -54, 52, 108, 14, 3, "rgba(139,92,246,0.2)", C.beamViolet);
      ctx.fillStyle = "#ddd6fe";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("Источник: регламент_возврата.pdf §4.2", -50, 62 + this.highlightLine);
    }

    /* Фаза CITE — луч к оператору */
    if (prg >= 220) {
      this.citeBeam = Math.min(1, (prg - 220) / 25);
      var beamA = this.citeBeam * (prg < 260 ? 1 : 1 - (prg - 260) / 20);
      ctx.strokeStyle = "rgba(34,197,94," + beamA * 0.85 + ")";
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.moveTo(0, 78);
      ctx.lineTo(0, 78 + 35 * this.citeBeam);
      ctx.stroke();

      if (prg > 235) {
        drawRR(ctx, -38, 95, 76, 22, 5, "rgba(34,197,94,0.22)", C.citeGreen);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("Оператор · черновик", 0, 106);
        ctx.fillStyle = "#bbf7d0";
        ctx.font = "6px Inter,sans-serif";
        ctx.fillText("+ citation готов", 0, 114);
      }
    }
  };

  /* Faithfulness-gate — порог уверенности */
  function FaithfulnessGate() {
    this.score = 0.5;
  }
  FaithfulnessGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 280;
    if (prg < 70) this.score = 0.42 + (prg / 70) * 0.2;
    else if (prg < 150) this.score = 0.62 + ((prg - 70) / 80) * 0.22;
    else if (prg < 220) this.score = 0.84 + ((prg - 150) / 70) * 0.12;
    else this.score = 0.96;

    var open = this.score >= 0.82;
    drawRR(ctx, 108, -58, 44, 52, 6, "rgba(255,255,255,0.05)", C.outline);
    ctx.fillStyle = open ? C.citeGreen : C.gateRed;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("FAITH", 130, -42);
    ctx.fillText(Math.round(this.score * 100) + "%", 130, -32);

    ctx.strokeStyle = open ? C.citeGreen : C.gateRed;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(130, -12, 14, Math.PI, 0);
    ctx.stroke();
    ctx.fillStyle = open ? "rgba(34,197,94,0.25)" : "rgba(251,113,133,0.2)";
    ctx.fill();

    if (!open && prg > 60 && prg < 90) {
      ctx.fillStyle = C.gateRed;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("эскалация", 130, 8);
    }
  };

  /* Маршрутизатор billing/legal */
  function EscalationRouter() {
    this.blink = 0;
  }
  EscalationRouter.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 280;
    drawRR(ctx, -155, 18, 40, 30, 5, "rgba(245,158,11,0.12)", C.outline);
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("BILLING", -135, 30);
    ctx.fillText("LEGAL", -135, 40);

    if (prg > 55 && prg < 95) {
      this.blink = Math.sin((prg - 55) * 0.2) * 0.5 + 0.5;
      drawRR(ctx, -148, 8, 26, 10, 3, "rgba(245,158,11," + (0.15 + this.blink * 0.25) + ")", "#f59e0b");
      ctx.fillStyle = "#fff";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("стоп", -135, 16);
    }
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
    var prg = (frame * 0.035) % 280;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -115, y: 48 },
      "2_seo": { x: -55, y: 58 },
      "3_coder": { x: 55, y: 58 },
      "4_designer": { x: 115, y: 48 },
      "5_deployer": { x: 0, y: 68 }
    };
    var tgt = targets[this.role] || { x: 0, y: 55 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        faceDir = tgt.x > this.baseX ? 1 : -1;
        carryType = this.color;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 16) {
        this.x = tgt.x;
        this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = tgt.x > this.baseX ? -1 : 1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 16) / 8);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 16) / 8);
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
      if (prg >= this.stepTrig - 12 && prg < this.stepTrig) carryType = this.color;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 260);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.5);
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.lineJoin = "round";

    var legL = 0, legR = 0;
    if (isMoving) {
      var walk = this.timer * 6;
      legL = Math.sin(walk) * 5;
      legR = Math.sin(walk + Math.PI) * 5;
    }
    drawRR(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
    drawRR(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
    drawRR(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
    drawRR(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);
    drawRR(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);

    var hx = 0, hy = -28 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(hx, hy, 12, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 2;
    ctx.strokeStyle = C.outline;
    ctx.stroke();

    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(hx + 5, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 2, 0, Math.PI * 2); ctx.fill();

    if (this.role === "1_architect") {
      ctx.strokeStyle = C.outline; ctx.lineWidth = 1;
      ctx.strokeRect(hx + 1, hy - 5, 6, 6);
      ctx.strokeRect(hx - 7, hy - 5, 6, 6);
    } else if (this.role === "2_seo") {
      drawRR(ctx, hx - 12, hy - 14, 24, 8, [6, 6, 0, 0], C.outline, null);
    } else if (this.role === "3_coder") {
      ctx.fillStyle = C.outline;
      ctx.font = "bold 8px monospace";
      ctx.fillText("</>", hx - 8, hy - 4);
    } else if (this.role === "4_designer") {
      drawRR(ctx, hx - 14, hy - 12, 28, 6, 3, "#f43f5e", C.outline);
    } else if (this.role === "5_deployer") {
      ctx.strokeStyle = C.outline; ctx.lineWidth = 2;
      ctx.beginPath(); ctx.arc(hx, hy, 14, Math.PI, Math.PI * 2); ctx.stroke();
    }
    ctx.restore();

    if (carryType) {
      drawMiniDoc(ctx, -18 * faceDir, -20 - bob, 12, 10, carryType, 2);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var wiki = new WikiShelfWall();
  var beams = new ChunkBeamStream();
  var nodes = new EmbeddingNodeField();
  var consoleRag = new RagCitationConsole();
  var gate = new FaithfulnessGate();
  var router = new EscalationRouter();

  entities.push(wiki);
  entities.push(nodes);
  entities.push(beams);
  entities.push(router);
  entities.push(consoleRag);
  entities.push(gate);

  entities.push(new Agent(-130, 72, C.agentYellow, "1_architect", 18, [
    "Инвентаризация wiki…", "Дубли в Confluence", "Карта регламентов готова", "Аудит БЗ: 847 статей"
  ]));
  entities.push(new Agent(-70, 78, C.agentGreen, "2_seo", 58, [
    "FAQ-метаданные", "Формулировки клиентов", "LSI для retrieval", "Теги продукта v2.1"
  ]));
  entities.push(new Agent(70, 78, C.agentBlue, "3_coder", 98, [
    "Чанк 512 токенов", "Embeddings в Qdrant", "Webhook переиндекса", "Rerank топ-3"
  ]));
  entities.push(new Agent(130, 72, C.agentPink, "4_designer", 138, [
    "Блок citation в UI", "Copilot для оператора", "Подсветка источника", "Режим стажёра"
  ]));
  entities.push(new Agent(0, 82, C.agentPurple, "5_deployer", 178, [
    "Интеграция amoCRM", "Telegram-бот FAQ", "Faithfulness 0.94", "Пилот на 50 тикетах"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 280, maxLife: life || 280 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.035) % 280;
    if (prg >= 16 && prg < 16.05) createBubble(-130, 50, "1. Аудит инструкций", 240);
    if (prg >= 56 && prg < 56.05) createBubble(-70, 56, "2. Индексация PDF", 240);
    if (prg >= 96 && prg < 96.05) createBubble(70, 56, "3. Retrieval + rerank", 240);
    if (prg >= 136 && prg < 136.05) createBubble(130, 50, "4. Ответ с цитатой", 240);
    if (prg >= 176 && prg < 176.05) createBubble(0, 60, "5. Copilot в CRM", 240);
    if (prg >= 225 && prg < 225.05) createBubble(0, -20, "Grounded · источник виден", 300);

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 30);
      if (bub.life > bub.maxLife - 10) alpha = (bub.maxLife - bub.life) / 10;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bub.x - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bub.x, by - th / 2);
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
  document.querySelectorAll('.vnkbz-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.vnkbz-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.vnkbz-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.vnkbz-faq-q');if(q)q.setAttribute('aria-expanded','false');
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
  var root=document.querySelector('.vnkbz-content');
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

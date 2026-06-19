<?php
/**
 * Template Name: Интеграция AI в CRM, ERP и 1С: внедрение под ключ
 * Description: SEO-лендинг — интеграция AI в CRM, ERP, 1С, телефонию и базы знаний. Кейсы, схема внедрения, цены.
 */

$page_seo_title       = 'Интеграция AI в CRM, ERP и 1С: внедрение под ключ';
$page_seo_description = 'Подключим AI к CRM, ERP, 1С, телефонии и базам знаний: интеграция нейросетей и AI-агентов в корпоративные системы под ключ. Аудит, кейсы, схема внедрения, цены.';

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
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить интеграции';
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

/* Hero integraciya-ai-crm-erp */
.iace-hero-integration {
  --iace-gold: #f5c518;
  --iace-violet: #8b5cf6;
  --iace-cyan: #79f2ff;
  --iace-green: #22c55e;
  --iace-text: #e6edf7;
  --iace-muted: #9aa8bd;
  --iace-soft: #c7d2e5;
  --iace-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.iace-hero-integration::before {
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
.iace-hero-integration::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .09), transparent 66%);
  filter: blur(8px);
  animation: iaceHeroGlow 10s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes iaceHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.iace-hero-integration .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.iace-hero-integration .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.iace-hero-integration .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.iace-hero-integration .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--iace-cyan) 38%, var(--iace-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.iace-hero-integration .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--iace-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.iace-hero-integration .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--iace-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.iace-hero-integration .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.iace-hero-integration .nero-ai-badge {
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
.iace-hero-integration .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.iace-hero-integration .nero-ai-btn {
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
.iace-hero-integration .nero-ai-btn:hover { transform: translateY(-2px); }
.iace-hero-integration .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--iace-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.iace-hero-integration .nero-ai-btn-secondary {
  color: var(--iace-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.iace-hero-integration .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--iace-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.iace-hero-integration .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.iace-hero-integration .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.iace-hero-integration .nero-ai-dots { display: flex; gap: 7px; }
.iace-hero-integration .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.iace-hero-integration .nero-ai-dot:nth-child(1) { background: #fb7185; }
.iace-hero-integration .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.iace-hero-integration .nero-ai-dot:nth-child(3) { background: #34d399; }
.iace-hero-integration .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.iace-hero-integration .nero-ai-window-body { padding: 16px; }
.iace-hero-integration .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.iace-hero-integration .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.iace-hero-integration .nero-ai-live-pill {
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
.iace-hero-integration .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: iacePulse 1.6s infinite;
}
@keyframes iacePulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.iace-hero-integration .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.iace-hero-integration .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.iace-hero-integration .nero-ai-metric span {
  display: block;
  color: var(--iace-muted);
  font-size: 11px;
  font-weight: 700;
}
.iace-hero-integration .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.iace-hero-integration .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.iace-hero-integration .iace-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: radial-gradient(ellipse at 50% 42%, rgba(139,92,246,.12), rgba(6,10,24,.94) 74%);
}
.iace-hero-integration #iace-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.iace-hero-integration .nero-ai-task-stream { display: grid; gap: 8px; }
.iace-hero-integration .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.iace-hero-integration .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--iace-cyan);
  font-size: 11px;
  font-weight: 800;
}
.iace-hero-integration .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.iace-hero-integration .nero-ai-task span {
  color: var(--iace-muted);
  font-size: 11px;
}
.iace-hero-integration .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.iace-hero-integration .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.iace-hero-integration .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .iace-hero-integration .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .iace-hero-integration .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .iace-hero-integration .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .iace-hero-integration .nero-ai-window-body { padding: 12px; }
  .iace-hero-integration .nero-ai-task { grid-template-columns: 28px 1fr; }
  .iace-hero-integration .nero-ai-status { grid-column: 2; width: fit-content; }
}

.iace-content{
  --iace-bg:#050711;--iace-bg2:#080b17;--iace-surface:rgba(255,255,255,.072);
  --iace-text:#e6edf7;--iace-muted:#9aa8bd;--iace-soft:#c7d2e5;--iace-heading:#fff;
  --iace-border:rgba(255,255,255,.10);--iace-accent:#79f2ff;--iace-violet:#8b5cf6;--iace-green:#22c55e;
  --iace-btn-from:#2563eb;--iace-btn-to:#7c3aed;--iace-r:18px;--iace-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--iace-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.iace-content *,.iace-content *::before,.iace-content *::after{box-sizing:border-box}
.iace-content a{color:inherit}
.iace-content p{color:var(--iace-muted);line-height:1.72;margin:0 0 1em}
.iace-content p:last-child{margin-bottom:0}
.iace-content h2,.iace-content h3,.iace-content h4{color:var(--iace-heading);letter-spacing:-.045em;margin:0 0 .7em}
.iace-content strong{color:var(--iace-soft)}
.iace-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.iace-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--iace-muted);font-size:14.5px;line-height:1.65}
.iace-content ul li::before{content:'›';position:absolute;left:0;color:var(--iace-accent);font-weight:700}
.iace-cnt{width:min(var(--iace-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.iace-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.iace-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.iace-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.iace-sh.iace-left{margin-left:0;text-align:left}
.iace-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.iace-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.iace-sh.iace-left p{margin-left:0}
.iace-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--iace-accent);margin-bottom:14px}
.iace-gt{background:linear-gradient(92deg,#fff 0%,var(--iace-accent) 44%,var(--iace-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.iace-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.iace-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.iace-intro-text{position:relative;padding-left:20px}
.iace-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--iace-accent),var(--iace-violet))}
.iace-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--iace-muted);margin-bottom:1em}
.iace-intro-text p:last-child{margin-bottom:0;color:var(--iace-soft)}
.iace-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.iace-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.iace-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--iace-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.iace-kpi-card .kl{font-size:11px;font-weight:600;color:var(--iace-muted);line-height:1.4}
.iace-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.iace-intro-grid{grid-template-columns:1fr;gap:36px}.iace-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.iace-intro-kpi{grid-template-columns:1fr 1fr}}
.iace-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.iace-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.iace-toc a{display:inline-block;padding:9px 18px;background:var(--iace-surface);border:1px solid var(--iace-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--iace-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.iace-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--iace-accent);background:rgba(121,242,255,.08)}
.iace-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--iace-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.iace-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.iace-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.iace-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.iace-grid-2,.iace-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.iace-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.iace-grid-3{grid-template-columns:1fr}}
.iace-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.iace-table{width:100%;border-collapse:collapse;font-size:14px}
.iace-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--iace-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.iace-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--iace-text);vertical-align:top}
.iace-table tr:last-child td{border-bottom:none}
.iace-table tr:hover td{background:rgba(255,255,255,.03)}
.iace-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.iace-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--iace-accent);border:1px solid rgba(121,242,255,.2)}
.iace-flow .arr{color:var(--iace-muted);font-size:16px;padding:0 4px;background:none;border:none}
.iace-timeline{position:relative;padding-left:40px}
.iace-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--iace-accent),var(--iace-violet));opacity:.35;border-radius:2px}
.iace-tl-item{position:relative;margin-bottom:32px}
.iace-tl-item:last-child{margin-bottom:0}
.iace-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--iace-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.iace-tl-item h3{font-size:17px;margin-bottom:8px}
.iace-tl-item p{font-size:14.5px;margin:0}
.iace-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.iace-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.iace-case-grid{grid-template-columns:1fr}}
.iace-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.iace-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.iace-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--iace-green);margin-bottom:10px}
.iace-case-card h3{font-size:16px;margin-bottom:14px}
.iace-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px}
.iace-metric .num{font-size:20px;font-weight:900;color:var(--iace-accent);flex-shrink:0}
.iace-metric .lbl{font-size:13px;color:var(--iace-muted)}
.iace-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.iace-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.iace-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--iace-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.iace-faq-q::after{content:'▾';font-size:13px;color:var(--iace-accent);flex-shrink:0;transition:transform .25s}
.iace-faq-item.open .iace-faq-q::after{transform:rotate(180deg)}
.iace-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--iace-muted);line-height:1.72}
.iace-faq-item.open .iace-faq-a{max-height:800px;padding:0 24px 20px}
.iace-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.iace-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--iace-muted)}
.iace-cta-checklist li::before{content:'✓';color:var(--iace-green);font-weight:800}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--iace-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--iace-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--iace-btn-from),var(--iace-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}

.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--iace-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--iace-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--iace-btn-from),var(--iace-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}

.ym-cta-block--primary{background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(121,242,255,.1));border-color:rgba(245,197,24,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);}
.iace-geo-def{background:rgba(121,242,255,.06);border:1px solid rgba(121,242,255,.28);border-radius:16px;padding:20px 24px;margin:24px 0;font-size:15px;line-height:1.72;color:var(--iace-soft);}
.iace-callout{background:rgba(255,255,255,.05);border-left:3px solid var(--iace-accent);padding:16px 20px;margin:20px 0;border-radius:0 12px 12px 0;font-size:14.5px;color:var(--iace-muted);}
.iace-content a.iace-link{color:var(--iace-accent)!important;text-decoration:underline!important;text-underline-offset:3px;}
.iace-content ol{padding-left:0;list-style:none;margin:0 0 1.2em;counter-reset:iace-step;}
.iace-content ol li{counter-increment:iace-step;padding-left:28px;position:relative;margin-bottom:.5em;color:var(--iace-muted);font-size:14.5px;line-height:1.65;}
.iace-content ol li::before{content:counter(iace-step);position:absolute;left:0;width:20px;height:20px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--iace-accent);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;}
.iace-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:18px;padding:24px;margin-bottom:14px;}
.iace-scenario h3{font-size:17px;margin-bottom:8px;}
.iace-scenario p{font-size:14.5px;margin:0;}
.iace-error-list{display:grid;gap:10px;margin:20px 0;}
.iace-error-item{display:flex;gap:12px;padding:14px 16px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:12px;font-size:14px;color:var(--iace-muted);}
.iace-error-item strong{color:var(--iace-soft);flex-shrink:0;}

/* === БОРИС: prefix iace-b-, scoped внутри #integraciya-ai-crm-erp-boris-block === */
#integraciya-ai-crm-erp-boris-block.iace-b-root{
  padding:clamp(32px,4vw,48px) 0;
  margin:clamp(24px,3vw,40px) 0;
}
#integraciya-ai-crm-erp-boris-block .iace-b-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 clamp(16px,3vw,24px);
}
#integraciya-ai-crm-erp-boris-block .iace-b-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 12px 48px rgba(0,0,0,.28),0 0 0 1px rgba(121,242,255,.12);
  min-height:min(520px,70vh);
}
@media(max-width:1023px){
  #integraciya-ai-crm-erp-boris-block .iace-b-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#integraciya-ai-crm-erp-boris-block .iace-b-lft{
  padding:clamp(28px,3.5vw,40px) clamp(22px,3vw,36px);
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #integraciya-ai-crm-erp-boris-block .iace-b-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
  }
}
#integraciya-ai-crm-erp-boris-block .iace-b-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0891b2;
  margin:0 0 14px;
}
#integraciya-ai-crm-erp-boris-block .iace-b-ey::before{
  content:'';
  width:18px;height:2px;
  background:linear-gradient(90deg,#79f2ff,#8b5cf6);
  border-radius:1px;
}
#integraciya-ai-crm-erp-boris-block .iace-b-h3{
  font-size:clamp(19px,2.3vw,25px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 16px;
}
#integraciya-ai-crm-erp-boris-block .iace-b-ul{
  list-style:none;
  margin:0 0 20px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:8px;
}
#integraciya-ai-crm-erp-boris-block .iace-b-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#integraciya-ai-crm-erp-boris-block .iace-b-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(121,242,255,.12);
  display:flex;align-items:center;justify-content:center;
  font-size:10px;
  color:#0e7490;
  margin-top:1px;
  font-style:normal;
  font-weight:700;
}
#integraciya-ai-crm-erp-boris-block .iace-b-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:16px;
}
#integraciya-ai-crm-erp-boris-block .iace-b-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:11.5px;
  font-weight:700;
  white-space:nowrap;
}
#integraciya-ai-crm-erp-boris-block .iace-b-pl-c{
  background:rgba(121,242,255,.1);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.28);
}
#integraciya-ai-crm-erp-boris-block .iace-b-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#integraciya-ai-crm-erp-boris-block .iace-b-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#integraciya-ai-crm-erp-boris-block .iace-b-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#integraciya-ai-crm-erp-boris-block .iace-b-rgt{
  position:relative;
  background:linear-gradient(145deg,#050711 0%,#0a1020 45%,#080b17 100%);
  min-height:400px;
  overflow:hidden;
}
@media(max-width:1023px){
  #integraciya-ai-crm-erp-boris-block .iace-b-rgt{min-height:360px;}
}
#iace-context-bus-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<main id="primary" class="site-main nero-ai-home-page integraciya-ai-crm-erp-page" role="main" tabindex="-1">

<section class="nero-ai-hero iace-hero-integration" id="hero" aria-labelledby="hero-iace-title">
<div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · интеграция ai</p>
      <h1 id="hero-iace-title">Интеграция AI в CRM, ERP и корпоративные системы: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Подключим AI к вашим CRM, ERP, 1С, телефонии и базам знаний — чтобы нейросеть работала с реальными данными, а не в отрыве от бизнес-процессов</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">CRM · ERP · 1С</li>
        <li class="nero-ai-badge">AI-агенты</li>
        <li class="nero-ai-badge">MCP / RAG</li>
        <li class="nero-ai-badge">Аудит под ключ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить интеграции</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация интеграционного хаба AI с CRM и ERP">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>интеграция · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Системы</span>
              <strong>5+</strong>
              <small>CRM · ERP · 1С · телефония · БЗ</small>
            </div>
            <div class="nero-ai-metric">
              <span>Контекст</span>
              <strong>live</strong>
              <small>shared data layer</small>
            </div>
            <div class="nero-ai-metric">
              <span>Агенты</span>
              <strong>on</strong>
              <small>MCP + webhooks</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ответ</span>
              <strong>&lt;1 мин</strong>
              <small>webhook → CRM</small>
            </div>
          </div>

          <div class="iace-dash-canvas-wrap" aria-hidden="false">
            <canvas id="iace-hero-canvas" role="img" aria-label="Анимация: данные из CRM, ERP и 1С стекаются в общий контекст, AI-агент записывает результат в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента интеграционных событий">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">WH</span>
              <div><strong>Webhook: новый лид Bitrix24</strong><span>Контекст CRM + история звонков</span></div>
              <span class="nero-ai-status">контекст</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Агент: квалификация + черновик КП</strong><span>RAG по регламентам продаж</span></div>
              <span class="nero-ai-status nero-ai-status--violet">агент</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">1С</span>
              <div><strong>Read-only: остаток и оплата</strong><span>ERP данные в контексте сделки</span></div>
              <span class="nero-ai-status">синхр.</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Запись в CRM после подтверждения</strong><span>human-in-the-loop · RBAC</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="iace-content">

  <section class="iace-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="iace-cnt">
      <div class="iace-intro-grid nero-ai-reveal">
        <div class="iace-intro-text">
          <p class="iace-eyebrow">Лонгрид · интеграция AI</p>
          <p>Компании уже пробуют ChatGPT, GigaChat и YandexGPT — но выручка почти не меняется. Причина не в «слабой модели», а в том, что нейросеть не подключена к CRM, ERP, 1С и другим рабочим системам. <strong>Интеграция AI</strong> — это внедрение управляемого слоя, который читает операционные данные и помогает действовать внутри бизнес-процессов, а не в отдельном чате.</p>
          <p><?php echo esc_html($brand); ?> проектирует такие связки под ключ: от аудита текущих интеграций до пилота и масштабирования. Первый шаг — <strong>Проверить интеграции</strong>: понять, где AI уже может работать с реальными данными, а где без доработки останется «нейросетью в вакууме».</p>
        </div>
        <div class="iace-intro-kpi" aria-label="Ключевые метрики рынка AI">
          <div class="iace-kpi-card"><div class="kv">40%</div><div class="kl">enterprise-приложений с агентами к 2026</div><div class="ks">Gartner, 2025</div></div>
          <div class="iace-kpi-card"><div class="kv">88%</div><div class="kl">организаций используют AI</div><div class="ks">McKinsey State of AI</div></div>
          <div class="iace-kpi-card"><div class="kv">24%</div><div class="kl">компаний в РФ интегрировали ИИ</div><div class="ks">1.ru, 2026</div></div>
          <div class="iace-kpi-card"><div class="kv">300к–3млн ₽</div><div class="kl">ориентир чека проекта</div><div class="ks">пилот → enterprise</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="iace-toc-outer">
    <div class="iace-cnt">
      <nav class="iace-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-ne-rabotaet">Проблема</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#etapy">Внедрение</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#bezopasnost">Безопасность</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="iace-section" id="pochemu-ne-rabotaet">
    <div class="iace-cnt">
      <div class="iace-sh iace-left nero-ai-reveal">
        <span class="iace-eyebrow">Почему не работает</span>
        <h2>Почему AI без интеграции с CRM и ERP <span class="iace-gt">не работает</span></h2>
      </div>

      <div class="iace-scenario nero-ai-reveal">
        <h3>«Нейросеть в вакууме»: чат-бот vs рабочий слой над данными</h3>
        <p>Изолированный чат-бот на сайте или в мессенджере отвечает на общие вопросы. Он не видит стадию сделки в CRM, остаток на складе в ERP, историю звонков и переписку с клиентом. Менеджер копирует текст вручную, сверяет цифры в 1С, возвращается в чат — и теряет время.</p>
        <p><strong>Рабочий AI-слой</strong> получает событие из CRM, подтягивает контекст из ERP/1С, телефонии и базы знаний, формирует ответ или черновик действия и при необходимости записывает результат обратно в систему — с подтверждением человека для критичных операций.</p>
      </div>
      <div class="iace-callout nero-ai-reveal"><strong>Коротко:</strong> чат-бот разговаривает; интеграция AI в CRM и ERP <strong>действует на данных</strong>, которые уже есть в компании.</div>
      <p class="nero-ai-reveal">По опыту внедрений на Habr, интеграция AI-агента в CRM — это примерно 20% LLM и 80% инженерии: webhooks, очереди, чистота полей, идемпотентность API (<a href="https://habr.com/ru/articles/1045026/" class="iace-link" target="_blank" rel="noopener noreferrer">Velmi / Habr</a>).</p>

      <div class="iace-sh iace-left nero-ai-reveal" style="margin-top:48px">
        <h3>Bottleneck 2026: не модель, а единый data context</h3>
        <p>На Microsoft Build 2026 узкое место enterprise AI — <strong>единый контекст данных</strong>, а не «ещё одна умная модель». Fabric IQ, agentic apps и multi-agent systems требуют подключения к operational data — CRM, ERP, базам, live-сигналам (<a href="https://azure.microsoft.com/en-us/blog/microsoft-build-2026-building-agentic-apps-with-microsoft-fabric-and-microsoft-databases/" class="iace-link" target="_blank" rel="noopener noreferrer">Azure Blog</a>).</p>
      </div>
      <p class="nero-ai-reveal">Gartner прогнозирует: к концу 2026 года <strong>40% enterprise-приложений</strong> получат встроенных task-specific AI-агентов — против менее 5% в 2025. McKinsey отмечает: 88% организаций используют AI хотя бы в одной функции, но только около трети масштабируют решения.</p>

      <div class="iace-geo-def nero-ai-reveal" role="note">
        <strong>Определение (GEO):</strong> <em>Интеграция AI в корпоративные системы</em> — проектирование и внедрение слоя, который связывает LLM и AI-агентов с CRM, ERP, 1С, телефонией, почтой и базами знаний через API, webhooks, RAG и протоколы вроде MCP, с правилами доступа, журналированием и human-in-the-loop для записи в учётные системы.
      </div>
      <p class="nero-ai-reveal">Если вы не уверены, на каком этапе находится ваш ландшафт, начните с аудита: <strong>Проверить интеграции</strong> — это карта систем, данных и узких мест, а не продажа «ещё одного бота».</p>
    </div>
  </section>

  <section class="iace-section iace-section-alt" id="kak-rabotaet">
    <div class="iace-cnt">
      <div class="iace-sh iace-left nero-ai-reveal">
        <span class="iace-eyebrow">Архитектура</span>
        <h2>Что такое интеграция AI в <span class="iace-gt">бизнес-процессы</span></h2>
      </div>

      <div class="iace-sh iace-left nero-ai-reveal">
        <h3>AI-слой поверх CRM, ERP, 1С, телефонии и баз знаний</h3>
        <p><strong>Внедрение AI в бизнес-процессы</strong> — не разовая настройка промпта, а цепочка из шести шагов:</p>
      </div>
      <ol class="nero-ai-reveal">
        <li>Событие в канале (форма, звонок, письмо, смена стадии CRM).</li>
        <li>Оркестратор принимает webhook, отвечает за секунды и ставит задачу в очередь.</li>
        <li>Сбор контекста: карточка CRM, история коммуникаций, данные ERP/1С (на пилоте — read-only).</li>
        <li>LLM: классификация, ответ, черновик действия.</li>
        <li>Governance: эскалация человеку при высоком риске; запись в CRM/ERP после подтверждения.</li>
        <li>Метрики: время ответа, конверсия, доля автозакрытых типовых кейсов.</li>
      </ol>
      <p class="nero-ai-reveal">Типовой стек <?php echo esc_html($brand); ?>: LLM (GigaChat, YandexGPT, OpenAI/Claude — по контуру) + оркестратор (n8n, Make, FastAPI) + API/webhooks CRM/ERP + RAG по регламентам + SSO/RBAC.</p>

      <div class="iace-sh iace-left nero-ai-reveal" style="margin-top:40px">
        <h3>AI-агенты, RAG и webhooks: как данные попадают в нейросеть</h3>
        <p><strong>AI-агенты</strong> вызывают инструменты: прочитать сделку, найти регламент, создать задачу, обновить поле. <strong>RAG</strong> подмешивает фрагменты базы знаний. <strong>Webhooks</strong> — точка входа: CRM или телефония сообщает о событии без постоянного опроса.</p>
        <p>Протокол <strong>MCP</strong> в 2026 году становится практическим стандартом «USB-C для AI↔ERP»: его поддерживают Dynamics 365, Oracle Integration Cloud, Битрикс24 MCP Hub, экосистема 1С через 1С:Шину.</p>
      </div>

      <section id="integraciya-ai-crm-erp-boris-block" class="iace-b-root" aria-label="Анимация: единый контекст данных между CRM, ERP, 1С, телефонией и базой знаний">
<div class="iace-b-cnt">
  <div class="iace-b-card">

    <div class="iace-b-lft">
      <span class="iace-b-ey">Shared context · 2026</span>
      <h3 class="iace-b-h3">Один контекст для CRM, ERP, 1С и телефонии — агент видит всю картину сделки</h3>
      <ul class="iace-b-ul">
        <li><span class="iace-b-ic">1</span>Webhook из CRM или телефонии запускает оркестратор за &lt;3 сек</li>
        <li><span class="iace-b-ic">2</span>Сбор контекста: карточка CRM + данные ERP/1С + фрагменты RAG</li>
        <li><span class="iace-b-ic">3</span>LLM формирует ответ или черновик действия с учётом роли (RBAC)</li>
        <li><span class="iace-b-ic">✓</span>Запись в системы — после human-in-the-loop для критичных операций</li>
      </ul>
      <div class="iace-b-pills">
        <span class="iace-b-pl iace-b-pl-c">MCP · webhooks</span>
        <span class="iace-b-pl iace-b-pl-v">5+ систем</span>
        <span class="iace-b-pl iace-b-pl-g">read-only → write</span>
      </div>
      <p class="iace-b-foot">Дальше — сценарии по каждой системе и таблица интеграций →</p>
    </div>

    <div class="iace-b-rgt">
      <canvas
        id="iace-context-bus-canvas"
        aria-label="Анимация: пакеты данных текут между CRM, ERP, 1С, телефонией, базой знаний и центральным AI-оркестратором через единый контекстный слой"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('iace-context-bus-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 460;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    cyan:'#79f2ff', cyanD:'rgba(121,242,255,',
    viol:'#8b5cf6', violD:'rgba(139,92,246,',
    green:'#22c55e', greenD:'rgba(34,197,94,',
    gold:'#f5c518', goldD:'rgba(245,197,24,',
    blue:'#60a5fa', blueD:'rgba(96,165,250,',
    pink:'#f472b6', pinkD:'rgba(244,114,182,',
    text:'#e6edf7', muted:'#94a3b8',
    line:'rgba(255,255,255,.08)',
    hub:'#0f172a'
  };

  var NODES = [
    {id:'crm',  label:'CRM',      sub:'amo · B24',  color:C.blue,  ang:-2.4, r:0.78},
    {id:'erp',  label:'ERP / 1С', sub:'учёт',       color:C.gold,  ang:-0.9, r:0.78},
    {id:'mcp',  label:'MCP',      sub:'tools',      color:C.viol,  ang:0,    r:0.62},
    {id:'tel',  label:'Телефония',sub:'STT',        color:C.green, ang:0.9,  r:0.78},
    {id:'rag',  label:'БЗ / RAG', sub:'регламенты', color:C.pink,  ang:2.4,  r:0.78}
  ];

  var PACKETS = [];
  var LOOP = 680;

  function hubPos(){
    return {x: W * 0.5, y: H * 0.52};
  }

  function nodePos(n){
    var h = hubPos();
    var rad = Math.min(W, H) * n.r * 0.42;
    return {
      x: h.x + Math.cos(n.ang) * rad,
      y: h.y + Math.sin(n.ang) * rad * 0.82
    };
  }

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function spawnPacket(){
    var src = NODES[Math.floor(Math.random() * NODES.length)];
    var toHub = Math.random() > 0.45;
    var dst = toHub ? null : NODES[Math.floor(Math.random() * NODES.length)];
    if(dst && dst.id === src.id) dst = NODES[(NODES.indexOf(src)+2) % NODES.length];
    PACKETS.push({
      src: src.id,
      dst: dst ? dst.id : 'hub',
      t: 0,
      speed: 0.008 + Math.random() * 0.006,
      color: src.color,
      size: 3 + Math.random() * 2
    });
    if(PACKETS.length > 28) PACKETS.shift();
  }

  function drawGrid(){
    ctx.strokeStyle='rgba(121,242,255,.04)';
    ctx.lineWidth=1;
    var step = 32;
    for(var gx=0; gx<W; gx+=step){
      ctx.beginPath(); ctx.moveTo(gx,0); ctx.lineTo(gx,H); ctx.stroke();
    }
    for(var gy=0; gy<H; gy+=step){
      ctx.beginPath(); ctx.moveTo(0,gy); ctx.lineTo(W,gy); ctx.stroke();
    }
  }

  function drawLinks(){
    var h = hubPos();
    NODES.forEach(function(n){
      var p = nodePos(n);
      ctx.strokeStyle = C.line;
      ctx.lineWidth = 1.2;
      ctx.setLineDash([4,6]);
      ctx.beginPath();
      ctx.moveTo(h.x, h.y);
      ctx.quadraticCurveTo((h.x+p.x)/2, (h.y+p.y)/2 - 18, p.x, p.y);
      ctx.stroke();
      ctx.setLineDash([]);
    });
  }

  function drawHub(pulse){
    var h = hubPos();
    var r = 38 + Math.sin(pulse * 0.06) * 3;
    var g = ctx.createRadialGradient(h.x,h.y,4,h.x,h.y,r+20);
    g.addColorStop(0, C.violD + '0.35)');
    g.addColorStop(1, C.violD + '0)');
    ctx.fillStyle = g;
    ctx.beginPath(); ctx.arc(h.x,h.y,r+22,0,Math.PI*2); ctx.fill();

    rr(h.x-r, h.y-r*0.9, r*2, r*1.8, 14, C.hub, C.cyan, 2);
    ctx.fillStyle = C.cyan;
    ctx.font = 'bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI', h.x, h.y - 4);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText('оркестратор', h.x, h.y + 10);

    ctx.strokeStyle = C.cyanD + (0.25 + 0.15*Math.sin(pulse*0.08)) + ')';
    ctx.lineWidth = 1.5;
    ctx.beginPath(); ctx.arc(h.x,h.y,r+14,0,Math.PI*2); ctx.stroke();
  }

  function drawNode(n, pulse){
    var p = nodePos(n);
    var w = 72, ht = 44;
    var x = p.x - w/2, y = p.y - ht/2;
    var glow = 6 + Math.sin(pulse * 0.05 + n.ang) * 2;

    ctx.beginPath(); ctx.arc(p.x,p.y,28+glow,0,Math.PI*2);
    ctx.fillStyle = n.color === C.blue ? C.blueD+'0.12)' :
                    n.color === C.gold ? C.goldD+'0.12)' :
                    n.color === C.viol ? C.violD+'0.12)' :
                    n.color === C.green ? C.greenD+'0.12)' : C.pinkD+'0.12)';
    ctx.fill();

    rr(x,y,w,ht,10,'rgba(255,255,255,.06)','rgba(255,255,255,.14)',1.2);
    rr(x+8,y+8,10,10,3,n.color,null,0);
    ctx.fillStyle = C.text;
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(n.label, x+22, y+18);
    ctx.fillStyle = C.muted;
    ctx.font = '8.5px Inter,sans-serif';
    ctx.fillText(n.sub, x+22, y+32);
  }

  function getPointOnCurve(from, to, t){
    var h = hubPos();
    var mx = (from.x + to.x) / 2;
    var my = (from.y + to.y) / 2 - 16;
    var u = 1 - t;
    return {
      x: u*u*from.x + 2*u*t*mx + t*t*to.x,
      y: u*u*from.y + 2*u*t*my + t*t*to.y
    };
  }

  function drawPackets(){
    PACKETS.forEach(function(pk){
      var srcN = NODES.find(function(n){ return n.id === pk.src; });
      if(!srcN) return;
      var from = nodePos(srcN);
      var to = pk.dst === 'hub' ? hubPos() : nodePos(NODES.find(function(n){ return n.id === pk.dst; }));
      var pt = getPointOnCurve(from, to, pk.t);
      ctx.beginPath(); ctx.arc(pt.x, pt.y, pk.size, 0, Math.PI*2);
      ctx.fillStyle = pk.color;
      ctx.globalAlpha = 0.85;
      ctx.fill();
      ctx.globalAlpha = 1;
      pk.t += pk.speed;
    });
    PACKETS = PACKETS.filter(function(pk){ return pk.t <= 1.05; });
  }

  function drawLegend(){
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('webhook → контекст → LLM → запись', 14, H - 14);
    ctx.textAlign = 'right';
    ctx.fillStyle = C.green;
    ctx.fillText('● live sync', W - 14, H - 14);
  }

  function drawTopBar(){
    ctx.fillStyle = C.text;
    ctx.font = 'bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Контекстный слой · CRM + ERP + 1С', 14, 22);
    var pr = 5 + Math.sin(frame * 0.07) * 2;
    ctx.beginPath(); ctx.arc(W-20, 18, pr+3, 0, Math.PI*2);
    ctx.fillStyle = C.greenD + '0.15)'; ctx.fill();
    ctx.beginPath(); ctx.arc(W-20, 18, 3, 0, Math.PI*2);
    ctx.fillStyle = C.green; ctx.fill();
    ctx.strokeStyle = C.line; ctx.lineWidth = 1;
    ctx.beginPath(); ctx.moveTo(0,32); ctx.lineTo(W,32); ctx.stroke();
  }

  function tick(){
    frame++;
    if(frame % 22 === 0) spawnPacket();
    ctx.clearRect(0,0,W,H);
    drawGrid();
    drawLinks();
    drawHub(frame);
    NODES.forEach(function(n){ drawNode(n, frame); });
    drawPackets();
    drawTopBar();
    drawLegend();
    requestAnimationFrame(tick);
  }

  for(var i=0;i<8;i++) spawnPacket();
  tick();
})();
</script>
</section>

      <p class="nero-ai-reveal"><strong>Лид-магнит:</strong> скачайте <strong>«Схему интеграции AI»</strong> — визуальная карта потоков данных от события в CRM до ответа агента и записи в ERP. Схема помогает согласовать ТЗ с IT, продажами и ИБ до старта разработки.</p>

      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-schema">
        <div class="ym-cta-block__icon" aria-hidden="true">🗺️</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Получите схему интеграции AI под ваш стек</p>
          <p class="ym-cta-block__sub">Визуальная карта потоков: CRM, ERP, 1С, телефония, RAG и точки human-in-the-loop. Помогает согласовать ТЗ с IT, продажами и ИБ до старта пилота — бесплатно вместе с аудитом ландшафта.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить интеграции</a>
        </div>
      </div>
    </div>
  </section>

  <section class="iace-section" id="scenarii">
    <div class="iace-cnt">
      <div class="iace-sh nero-ai-reveal">
        <span class="iace-eyebrow">Системы</span>
        <h2>Сценарии интеграции AI по <span class="iace-gt">корпоративным системам</span></h2>
        <p>Зонтичная <strong>интеграция AI с CRM</strong>, ERP и смежными системами закрывает разные контуры.</p>
      </div>

      <div class="iace-table-wrap nero-ai-reveal">
        <table class="iace-table" aria-label="Системы и типовые сценарии AI">
          <thead><tr><th>Система</th><th>Что подключаем</th><th>Типовые сценарии AI</th></tr></thead>
          <tbody>
            <tr><td>CRM</td><td>amoCRM, Битрикс24, Мегаплан</td><td>Квалификация лидов, скоринг, summary переписки, черновики КП</td></tr>
            <tr><td>ERP / 1С</td><td>1С:ERP, УТ, Бухгалтерия</td><td>Первичка, прогноз закупок, подсказки по документам, сверка с CRM</td></tr>
            <tr><td>Телефония</td><td>Mango, UIS, CallTouch</td><td>STT звонка → summary и задача в CRM</td></tr>
            <tr><td>Почта / мессенджеры</td><td>Почта, Telegram, WA Business</td><td>Классификация входящих, маршрутизация, ответы по регламенту</td></tr>
            <tr><td>Базы знаний</td><td>Confluence, Notion, 1С:ДО</td><td>RAG для операторов и менеджеров, единые ответы по продукту</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;font-size:15px;line-height:1.65;color:var(--iace-muted)">Зонтичная <strong>интеграция AI с корпоративными системами</strong> объединяет CRM, ERP, 1С, телефонию и базы знаний; ниже — разбор по каждому контуру со ссылками на узкие посадочные. На enterprise-масштабе те же принципы единого data context уже проверены: в материале <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" class="iace-link">KPMG и Claude — 276 000 сотрудников: уроки AI для бизнеса</a> описаны managed-агенты и цифровые шлюзы, применимые к связке CRM↔ERP.</p>

      <div class="iace-scenario nero-ai-reveal">
        <h3>CRM (amoCRM, Битрикс24): лиды, сделки, переписка</h3>
        <p>В CRM AI закрывает скорость первого контакта и качество данных в воронке. Кейс Velmi: AI-агент квалифицирует лиды в Bitrix24 — время ответа с 2–3 часов до 30–40 секунд (<a href="https://habr.com/ru/articles/1045026/" class="iace-link" target="_blank" rel="noopener noreferrer">Habr</a>). OFF Group встроил YandexGPT в 20+ бизнес-процессов Битрикс24.</p>
        <p>Подробнее — в материале <a href="/vnedrenie-ai-amocrm/" class="iace-link">внедрение AI в amoCRM</a>.</p>
      </div>

      <div class="iace-scenario nero-ai-reveal">
        <h3>ERP и 1С: заявки, счета, документы</h3>
        <p><strong>AI ERP интеграция</strong> — отдельный контур: учётные данные, проводки, первичные документы. 1С:ERP предлагает штатные сервисы — распознавание первички, прогноз продаж, 1С:Напарник. Кастомные агенты дополняют кросс-системные сценарии CRM↔1С через MCP и 1С:Шину.</p>
        <p>Углублённый разбор — на странице <a href="/ai-1c-erp/" class="iace-link">AI для 1С и ERP</a>.</p>
      </div>

      <div class="iace-scenario nero-ai-reveal">
        <h3>Телефония и почта в CRM</h3>
        <p>Звонок и письмо — частые точки потери лидов. AI транскрибирует разговор, извлекает намерение, создаёт задачу и заполняет поля CRM. Детальный сценарий — в гайде <a href="/vnedrenie-ai-obrabotka-email-crm/" class="iace-link">AI-обработка входящей почты в CRM</a>.</p>
      </div>

      <div class="iace-scenario nero-ai-reveal">
        <h3>Базы знаний и внутренние API: RAG, SSO, RBAC</h3>
        <p>Корпоративные регламенты живут в Confluence, SharePoint, файлах и 1С:Документооборот. RAG даёт агенту актуальные выдержки вместо «галлюцинаций». <strong>SSO и RBAC</strong> ограничивают, какие сущности видит модель для каждой роли.</p>
      </div>
    </div>
  </section>

  <section class="iace-section iace-section-alt" id="etapy">
    <div class="iace-cnt">
      <div class="iace-sh iace-left nero-ai-reveal">
        <span class="iace-eyebrow">Под ключ</span>
        <h2>Как мы внедряем интеграцию AI <span class="iace-gt">под ключ</span></h2>
        <p><strong>Интеграция AI под ключ</strong> в <?php echo esc_html($brand); ?> — проектная модель с измеримым пилотом, а не бесконечный PoC.</p>
      </div>

      <div class="iace-timeline nero-ai-reveal">
        <div class="iace-tl-item">
          <div class="iace-tl-dot"></div>
          <h3>Аудит текущих CRM/ERP/1С и качества данных</h3>
          <p>1–2 недели: карта систем, API и webhooks, дубли полей, «источники правды» по клиенту и заказу, требования ПДн и ролей. Результат — список сценариев с приоритетом по ROI и риску.</p>
        </div>
        <div class="iace-tl-item">
          <div class="iace-tl-dot"></div>
          <h3>Проектирование: API, webhooks, безопасность, on-prem vs cloud</h3>
          <p>Коннекторы (amoCRM REST, Bitrix24, 1С HTTP/OData, телефония), оркестратор, очередь, векторное хранилище для RAG. Write-операции в 1С и финансы — только с human-in-the-loop.</p>
        </div>
        <div class="iace-tl-item">
          <div class="iace-tl-dot"></div>
          <h3>Пилот → масштабирование → обучение команды</h3>
          <p>Пилот 2–4 недели на одном сценарии: summary сделки + следующий шаг или квалификация лида с записью в CRM. Сначала read-only, затем одна подтверждаемая write-операция. После KPI — второй канал, связка CRM↔1С, дашборд метрик.</p>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед интеграцией CRM и ERP полезно разобраться в n8n, промптах, MCP и human-in-the-loop — это ускоряет согласование сценариев с IT и ИБ. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>

      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-etapy">
        <div class="ym-cta-block__icon" aria-hidden="true">🔗</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить интеграции — первый шаг под ключ</p>
          <p class="ym-cta-block__sub">За 1–2 недели составим карту CRM, ERP, 1С, телефонии и баз знаний: API, webhooks, качество данных, приоритет сценариев по ROI. На выходе — план пилота и ориентир бюджета 300 тыс.–3 млн ₽ без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить интеграции</a>
        </div>
      </div>
    </div>
  </section>

  <section class="iace-section" id="ceny">
    <div class="iace-cnt">
      <div class="iace-sh nero-ai-reveal">
        <span class="iace-eyebrow">Коммерция</span>
        <h2>Стоимость и сроки <span class="iace-gt">внедрения AI</span></h2>
      </div>

      <div class="iace-sh iace-left nero-ai-reveal">
        <h3>От чего зависит бюджет (300 тыс.–3 млн ₽)</h3>
        <p>Ориентир чека для проектов <?php echo esc_html($brand); ?> — <strong>300 000–3 000 000 ₽</strong>.</p>
      </div>

      <div class="iace-table-wrap nero-ai-reveal">
        <table class="iace-table" aria-label="Факторы влияния на бюджет интеграции AI">
          <thead><tr><th>Фактор</th><th>Влияние на бюджет</th></tr></thead>
          <tbody>
            <tr><td>Число систем (CRM + ERP + телефония + БЗ)</td><td>Каждый коннектор и согласование полей</td></tr>
            <tr><td>Read-only vs запись в 1С/CRM</td><td>Governance, тесты, откат</td></tr>
            <tr><td>On-prem / гибрид</td><td>Инфраструктура, ПАК, поддержка</td></tr>
            <tr><td>Качество данных</td><td>Предпроектная чистка полей и справочников</td></tr>
            <tr><td>Кастомные MCP и очереди</td><td>Инженерия сверх «коробочного» чата</td></tr>
            <tr><td>Обучение и сопровождение</td><td>Документация, регламенты, SLA</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте бюджет под ваш ландшафт CRM + ERP</p>
          <p class="ym-cta-block__sub">Ориентир 300 000–3 000 000 ₽ в зависимости от числа систем и глубины write-доступа. На аудите «Проверить интеграции» дадим смету пилота, сроки и KPI — бесплатно.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить интеграции</a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Вопросы и ответы</a>
          </div>
        </div>
      </div>

      <div class="iace-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="iace-card">
          <h3>Под ключ vs самостоятельное внедрение</h3>
          <p><strong>Интеграция AI без программиста</strong> возможна на уровне готовых конструкторов (MCP Hub в Битрикс24, облачные сценарии 1С) — для узких задач. Смешанный стек почти всегда требует разработки интеграции и настройки оркестратора.</p>
        </div>
        <div class="iace-card">
          <h3>ROI: когда окупается интеграция</h3>
          <p>Измеряйте пилот по KPI: время первого ответа, доля квалифицированных лидов, часы ручного ввода, ошибки двойного ввода CRM↔1С. Без привязки к CRM/ERP ROI остаётся «экономией на лицензиях чата».</p>
        </div>
      </div>
    </div>
  </section>

  <section class="iace-section iace-section-alt" id="keisy">
    <div class="iace-cnt">
      <div class="iace-sh nero-ai-reveal">
        <span class="iace-eyebrow">Доверие</span>
        <h2>Кейсы и примеры <span class="iace-gt">интеграции AI</span></h2>
      </div>

      <div class="iace-case-grid nero-ai-reveal">
        <div class="iace-case-card">
          <div class="iace-case-tag">CRM</div>
          <h3>Квалификация лидов и summary</h3>
          <p>Velmi, OFF Group: автоматизация воронки, черновики КП, снижение времени ответа.</p>
        </div>
        <div class="iace-case-card">
          <div class="iace-case-tag">ERP / 1С</div>
          <h3>Первичка и MCP-агенты</h3>
          <p>Распознавание документов, прогнозы, доступ через MCP без правки типовой конфигурации.</p>
        </div>
        <div class="iace-case-card">
          <div class="iace-case-tag">Телефония</div>
          <h3>Транскрипт → CRM</h3>
          <p>STT звонка, summary, задача менеджеру — см. сценарий «Телефония и почта в CRM» выше.</p>
        </div>
      </div>

      <div class="iace-error-list nero-ai-reveal">
        <div class="iace-error-item"><strong>1.</strong> Agentwashing — маркировка чата как «агента» без инструментов и данных.</div>
        <div class="iace-error-item"><strong>2.</strong> Запись в 1С без порогов — финансовые операции без подтверждения.</div>
        <div class="iace-error-item"><strong>3.</strong> Игнорирование качества CRM — AI масштабирует хаос в полях.</div>
        <div class="iace-error-item"><strong>4.</strong> Синхронные webhooks — таймаут 3 сек в Bitrix24; нужна очередь.</div>
        <div class="iace-error-item"><strong>5.</strong> Один контур для всех ролей — нарушение RBAC и 152-ФЗ.</div>
      </div>
    </div>
  </section>

  <section class="iace-section" id="bezopasnost">
    <div class="iace-cnt">
      <div class="iace-sh iace-left nero-ai-reveal">
        <span class="iace-eyebrow">Enterprise</span>
        <h2>Безопасность и compliance при <span class="iace-gt">подключении AI</span></h2>
      </div>
      <div class="iace-grid-2 nero-ai-reveal">
        <div class="iace-card">
          <h3>Персональные данные, RBAC, журналирование</h3>
          <p>Персональные данные не должны уходить в публичные модели без договора и обезличивания. <strong>Audit log</strong> фиксирует промпт, источники RAG, предложенное и выполненное действие.</p>
        </div>
        <div class="iace-card">
          <h3>On-prem, облако и гибрид</h3>
          <p>GigaChat Enterprise, YandexGPT в контуре заказчика, гибрид с облачным RAG — выбор по матрице «контур × задача». Внешний интеграционный слой через API/MCP <strong>не останавливает</strong> учёт: типовая 1С остаётся на поддержке.</p>
        </div>
      </div>
      <div class="iace-callout nero-ai-reveal"><strong>Итог:</strong> интеграция AI для компании — управляемый контур с ролями, логами и подтверждением критичных действий, а не «дать всем ChatGPT».</div>
    </div>
  </section>

  <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
    <div class="iace-cnt">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы подключить AI к CRM, ERP и 1С?</p>
        <p class="ym-cta-block__sub">Получите схему интеграции AI и проведите аудит ландшафта: пилот на одном сценарии, on-prem и 152-ФЗ, human-in-the-loop для учётных операций.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить интеграции</a>
          <a href="#kak-rabotaet" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Схема внедрения</a>
        </div>
      </div>
    </div>
  </div>

  <section class="iace-section iace-section-alt" id="faq">
    <div class="iace-cnt">
      <div class="iace-sh nero-ai-reveal">
        <span class="iace-eyebrow">FAQ</span>
        <h2>FAQ по интеграции AI в CRM, ERP и корпоративные системы</h2>
      </div>
      <div class="iace-faq nero-ai-reveal">
        <div class="iace-faq-item">
          <div class="iace-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить интеграцию AI?</div>
          <div class="iace-faq-a">Аудит систем и данных → выбор одного пилотного сценария → проектирование коннекторов и RAG → read-only тест → одна write-операция с подтверждением → масштабирование. Старт: <strong>Проверить интеграции</strong> и <strong>Схема интеграции AI</strong>.</div>
        </div>
        <div class="iace-faq-item">
          <div class="iace-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит интеграция AI?</div>
          <div class="iace-faq-a">Зависит от числа систем и глубины интеграции. Ориентир <?php echo esc_html($brand); ?>: <strong>300 000–3 000 000 ₽</strong>; пилот одного сценария — ближе к нижней границе. Точная смета — после аудита.</div>
        </div>
        <div class="iace-faq-item">
          <div class="iace-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли без программиста?</div>
          <div class="iace-faq-a">Для узких задач в Битрикс24 MCP Hub и штатных сценариях 1С — частично да. Смешанный ландшафт CRM + ERP + телефония требует настройки интеграции инженерами или подрядчиком под ключ.</div>
        </div>
        <div class="iace-faq-item">
          <div class="iace-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли для малого и среднего бизнеса?</div>
          <div class="iace-faq-a"><strong>Интеграция AI для малого бизнеса</strong> — обычно один контур (CRM + почта или телефония). <strong>Для среднего бизнеса</strong> — CRM + 1С + телефония с поэтапным пилотом. Главное условие: дисциплина данных в CRM.</div>
        </div>
        <div class="iace-faq-item">
          <div class="iace-faq-q" role="button" tabindex="0" aria-expanded="false">Какие задачи решает интеграция AI?</div>
          <div class="iace-faq-a">Квалификация и скоринг лидов, summary звонков и переписок, RAG по регламентам, черновики документов, маршрутизация обращений, подсказки по учётным операциям с подтверждением. Это <strong>ai автоматизация бизнеса</strong> на реальных процессах.</div>
        </div>
        <div class="iace-faq-item">
          <div class="iace-faq-q" role="button" tabindex="0" aria-expanded="false">Чем отличается от «просто нейросети для бизнеса»?</div>
          <div class="iace-faq-a"><strong>AI для бизнеса</strong> в виде браузерного чата не видит ваши сделки и остатки. <strong>Интеграция с корпоративными системами</strong> даёт агентам инструменты, контекст и измеримый KPI.</div>
        </div>
      </div>
    </div>
  </section>

</div><!-- .iace-content -->

<!-- AD_BANNER:INSERT -->

<?php
$iace_page_url = trailingslashit( get_permalink() );
$iace_site_url = trailingslashit( home_url( '/' ) );
$iace_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$iace_h1       = 'Интеграция AI в CRM, ERP и корпоративные системы: внедрение под ключ';
$iace_schema   = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $iace_site_url . '#organization',
			'name'  => $iace_brand,
			'url'   => $iace_site_url,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $iace_site_url . '#website',
			'url'       => $iace_site_url,
			'name'      => $iace_brand,
			'publisher' => [ '@id' => $iace_site_url . '#organization' ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $iace_page_url . '#webpage',
			'url'         => $iace_page_url,
			'name'        => $iace_h1,
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $iace_site_url . '#website' ],
			'about'       => [ '@id' => $iace_site_url . '#organization' ],
		],
		[
			'@type'           => 'BreadcrumbList',
			'@id'             => $iace_page_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $iace_site_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => $iace_h1, 'item' => $iace_page_url ],
			],
		],
		[
			'@type'       => 'Service',
			'@id'         => $iace_page_url . '#service',
			'name'        => $iace_h1,
			'description' => $page_seo_description,
			'url'         => $iace_page_url,
			'provider'    => [ '@id' => $iace_site_url . '#organization' ],
		],
		[
			'@type'      => 'FAQPage',
			'@id'        => $iace_page_url . '#faq',
			'mainEntity' => [
				[ '@type' => 'Question', 'name' => 'Как внедрить интеграцию AI?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит систем и данных → выбор одного пилотного сценария → проектирование коннекторов и RAG → read-only тест → одна write-операция с подтверждением → масштабирование. Старт: Проверить интеграции и Схема интеграции AI.' ] ],
				[ '@type' => 'Question', 'name' => 'Сколько стоит интеграция AI?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Зависит от числа систем и глубины интеграции. Ориентир ' . $iace_brand . ': 300 000–3 000 000 ₽; пилот одного сценария — ближе к нижней границе. Точная смета — после аудита.' ] ],
				[ '@type' => 'Question', 'name' => 'Можно ли без программиста?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Для узких задач в Битрикс24 MCP Hub и штатных сценариях 1С — частично да. Смешанный ландшафт CRM + ERP + телефония требует настройки интеграции инженерами или подрядчиком под ключ.' ] ],
				[ '@type' => 'Question', 'name' => 'Подходит ли для малого и среднего бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Интеграция AI для малого бизнеса — обычно один контур (CRM + почта или телефония). Для среднего бизнеса — CRM + 1С + телефония с поэтапным пилотом. Главное условие: дисциплина данных в CRM.' ] ],
				[ '@type' => 'Question', 'name' => 'Какие задачи решает интеграция AI?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Квалификация и скоринг лидов, summary звонков и переписок, RAG по регламентам, черновики документов, маршрутизация обращений, подсказки по учётным операциям с подтверждением. Это ai автоматизация бизнеса на реальных процессах.' ] ],
				[ '@type' => 'Question', 'name' => 'Чем отличается от «просто нейросети для бизнеса»?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'AI для бизнеса в виде браузерного чата не видит ваши сделки и остатки. Интеграция с корпоративными системами даёт агентам инструменты, контекст и измеримый KPI.' ] ],
			],
		],
	],
];
echo '<script type="application/ld+json">' . wp_json_encode( $iace_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

<script>
/**
 * iace-hero-engine — «Context Nexus»: радиальный интеграционный хаб
 * Цикл: ingest → context_merge → agent_act → sync_pulse (не завод/ракета)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("iace-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  var LOOP = 240;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
    scale = Math.min(cw / 400, ch / 260) * 1.08;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    hub: "#1e293b",
    hubRing: "#79f2ff",
    hubGlow: "rgba(121,242,255,.25)",
    crm: "#3b82f6",
    erp: "#8b5cf6",
    onec: "#f5c518",
    tel: "#22c55e",
    kb: "#f472b6",
    pulse: "#e2e8f0",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    shield: "#34d399"
  };

  function rr(x, y, w, h, r, fill, stroke, lw) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1.5; ctx.stroke(); }
  }

  function drawPolyRound(x, y, w, h, radius, fill, stroke) {
    rr(x, y, w, h, radius, fill, stroke, 2);
  }

  var SATELLITES = [
    { label: "CRM", color: C.crm, angle: -2.1, dist: 118 },
    { label: "ERP", color: C.erp, angle: -0.5, dist: 125 },
    { label: "1С", color: C.onec, angle: 0.55, dist: 120 },
    { label: "TEL", color: C.tel, angle: 1.35, dist: 115 },
    { label: "БЗ", color: C.kb, angle: 2.35, dist: 112 }
  ];

  function satPos(sat) {
    return {
      x: Math.cos(sat.angle) * sat.dist,
      y: Math.sin(sat.angle) * sat.dist * 0.72
    };
  }

  function phase() {
    var t = frame % LOOP;
    if (t < 60) return "ingest";
    if (t < 140) return "merge";
    if (t < 200) return "agent";
    return "sync";
  }

  function phaseProg() {
    var t = frame % LOOP;
    var ph = phase();
    if (ph === "ingest") return t / 60;
    if (ph === "merge") return (t - 60) / 80;
    if (ph === "agent") return (t - 140) / 60;
    return (t - 200) / 40;
  }

  class SystemSatellite {
    constructor(sat) { this.sat = sat; this.flash = 0; }
    draw(ctx) {
      var p = satPos(this.sat);
      var lit = phase() === "sync" || (phase() === "agent" && phaseProg() > 0.4);
      var alpha = lit ? 1 : 0.72;
      ctx.globalAlpha = alpha;
      rr(p.x - 22, p.y - 14, 44, 28, 8, "rgba(15,23,42,.9)", this.sat.color, 2);
      ctx.fillStyle = this.sat.color;
      ctx.font = "bold 9px Inter,system-ui,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(this.sat.label, p.x, p.y + 3);
      if (this.flash > 0) {
        ctx.globalAlpha = this.flash * 0.5;
        ctx.beginPath();
        ctx.arc(p.x, p.y, 26, 0, Math.PI * 2);
        ctx.fillStyle = this.sat.color;
        ctx.fill();
        this.flash -= 0.04;
      }
      ctx.globalAlpha = 1;
    }
  }

  class WebhookSpark {
  constructor(satIdx) { this.satIdx = satIdx; this.life = 0; }
    trigger() { this.life = 1; }
    draw(ctx) {
      if (this.life <= 0) return;
      var p = satPos(SATELLITES[this.satIdx]);
      ctx.globalAlpha = this.life;
      ctx.strokeStyle = "#fde68a";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(p.x, p.y, 18 + (1 - this.life) * 12, 0, Math.PI * 2);
      ctx.stroke();
      this.life -= 0.035;
      ctx.globalAlpha = 1;
    }
  }

  class ArcDataPulse {
    constructor(satIdx, offset) {
      this.satIdx = satIdx;
      this.offset = offset;
      this.t = offset;
    }
    draw(ctx) {
      var ph = phase();
      if (ph === "sync") return;
      this.t += 0.018;
      if (this.t > 1) this.t = 0;
      var sat = SATELLITES[this.satIdx];
      var from = satPos(sat);
      var prog = (this.t + frame * 0.004 + this.offset) % 1;
      if (ph === "ingest" && prog > 0.55) return;
      var bx = from.x * (1 - prog);
      var by = from.y * (1 - prog);
      var curve = Math.sin(prog * Math.PI) * -28;
      ctx.fillStyle = sat.color;
      ctx.globalAlpha = 0.55 + Math.sin(prog * Math.PI) * 0.4;
      ctx.beginPath();
      ctx.arc(bx, by + curve, 4, 0, Math.PI * 2);
      ctx.fill();
      ctx.globalAlpha = 1;
    }
  }

  class RagShard {
    constructor(a, r, sp) { this.a = a; this.r = r; this.sp = sp; }
    draw(ctx) {
      if (phase() !== "merge" && phase() !== "agent") return;
      var ang = this.a + frame * this.sp;
      var rx = Math.cos(ang) * this.r;
      var ry = Math.sin(ang) * this.r * 0.65;
      ctx.save();
      ctx.translate(rx, ry);
      ctx.rotate(ang);
      rr(-7, -5, 14, 10, 2, "rgba(244,114,182,.35)", C.kb, 1);
      ctx.fillStyle = C.kb;
      ctx.font = "7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("RAG", 0, 2);
      ctx.restore();
    }
  }

  class McpConnectorNode {
    constructor(satIdx) { this.satIdx = satIdx; }
    draw(ctx) {
      if (phase() === "ingest") return;
      var p = satPos(SATELLITES[this.satIdx]);
      var mx = p.x * 0.55;
      var my = p.y * 0.55;
      rr(mx - 8, my - 5, 16, 10, 3, "rgba(139,92,246,.2)", C.erp, 1);
      ctx.fillStyle = "#c4b5fd";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("MCP", mx, my + 2);
    }
  }

  class RbacShieldGate {
    draw(ctx) {
      if (phase() !== "agent" || phaseProg() < 0.55) return;
      var a = Math.min(1, (phaseProg() - 0.55) * 3);
      ctx.globalAlpha = a * 0.85;
      ctx.strokeStyle = C.shield;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(0, -42);
      ctx.lineTo(18, -30);
      ctx.lineTo(18, -10);
      ctx.quadraticCurveTo(0, 2, -18, -10);
      ctx.lineTo(-18, -30);
      ctx.closePath();
      ctx.stroke();
      ctx.fillStyle = "rgba(52,211,153,.15)";
      ctx.fill();
      ctx.globalAlpha = 1;
    }
  }

  class ContextSyncCore {
    draw(ctx) {
      var ph = phase();
      var pulse = ph === "sync" ? 1 + Math.sin(frame * 0.2) * 0.08 : 1;
      var rings = 3;
      for (var r = rings; r >= 1; r--) {
        ctx.globalAlpha = 0.12 + (ph === "sync" ? 0.2 : 0);
        ctx.strokeStyle = C.hubRing;
        ctx.lineWidth = 1.5;
        ctx.beginPath();
        for (var i = 0; i < 6; i++) {
          var ang = (i / 6) * Math.PI * 2 + frame * 0.008 * r;
          var rad = (22 + r * 10) * pulse;
          var px = Math.cos(ang) * rad;
          var py = Math.sin(ang) * rad * 0.85;
          if (i === 0) ctx.moveTo(px, py);
          else ctx.lineTo(px, py);
        }
        ctx.closePath();
        ctx.stroke();
      }
      ctx.globalAlpha = 1;
      rr(-26, -22, 52, 44, 10, C.hub, C.hubRing, 2);
      ctx.fillStyle = ph === "sync" ? C.hubRing : "#cbd5e1";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("CONTEXT", 0, -4);
      ctx.fillText("NEXUS", 0, 8);
      if (ph === "sync") {
        ctx.fillStyle = C.tel;
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.fillText("LIVE", 0, 20);
      }
    }
  }

  class Agent {
    constructor(x, y, color, role, stepTrig, dialogs, targetAngle) {
      this.x = x; this.y = y; this.baseX = x; this.baseY = y;
      this.color = color; this.role = role;
      this.timer = Math.random() * 100;
      this.stepTrig = stepTrig;
      this.dialogs = dialogs;
      this.targetAngle = targetAngle;
      this.hitAnimation = 0;
    }

    draw(ctx) {
      this.timer += 0.03;
      var isMoving = false;
      var carryType = null;
      var faceDir = 1;
      var t = frame % LOOP;
      var prg = t;
      var target = satPos({ angle: this.targetAngle, dist: 72 });
      target.y *= 0.72;

      if (phase() === "agent" && prg >= this.stepTrig && prg < this.stepTrig + 22) {
        var local = prg - this.stepTrig;
        if (local < 11) {
          isMoving = true;
          faceDir = target.x > this.baseX ? 1 : -1;
          carryType = this.color;
          var k = local / 11;
          this.x = this.baseX + (target.x - this.baseX) * k;
          this.y = this.baseY + (target.y - this.baseY) * k;
        } else if (local < 16) {
          isMoving = false;
          this.x = target.x;
          this.y = target.y;
        } else {
          isMoving = true;
          faceDir = -1;
          var k2 = (local - 16) / 6;
          this.x = target.x - (target.x - this.baseX) * k2;
          this.y = target.y - (target.y - this.baseY) * k2;
        }
      } else {
        this.x = this.baseX;
        this.y = this.baseY;
      }

      if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
      }

      var bob = Math.abs(Math.sin(this.timer * 3)) * 2;
      if (!isMoving) bob = Math.sin(this.timer * 1.5);

      ctx.save();
      ctx.translate(this.x, this.y);
      drawPolyRound(-10, -5, 8, 14, 2, C.outline, null);
      drawPolyRound(-12, 5, 12, 6, 2, C.outline, null);
      drawPolyRound(2, -5, 8, 14, 2, C.outline, null);
      drawPolyRound(0, 5, 12, 6, 2, C.outline, null);
      drawPolyRound(-15, -12 - bob, 30, 20, 6, this.color, C.outline);
      var hx = 0, hy = -28 - bob;
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(hx, hy, 12, 0, Math.PI * 2);
      ctx.fill();
      ctx.lineWidth = 2;
      ctx.strokeStyle = C.outline;
      ctx.stroke();
      ctx.fillStyle = "#fff";
      ctx.beginPath();
      ctx.arc(hx + 4, hy - 2, 3, 0, Math.PI * 2);
      ctx.arc(hx - 4, hy - 2, 3, 0, Math.PI * 2);
      ctx.fill();
      if (carryType) {
        drawPolyRound(-16, -18 - bob, 14, 14, 2, carryType, C.outline);
      }
      ctx.restore();
    }
  }

  var entities = [];
  var bubbles = [];
  var sparks = SATELLITES.map(function (_, i) { return new WebhookSpark(i); });

  entities.push(new ContextSyncCore());
  SATELLITES.forEach(function (s) { entities.push(new SystemSatellite(s)); });
  for (var pi = 0; pi < 5; pi++) {
    entities.push(new ArcDataPulse(pi, pi * 0.18));
    entities.push(new McpConnectorNode(pi));
  }
  entities.push(new RbacShieldGate());
  entities.push(new RagShard(0, 58, 0.012));
  entities.push(new RagShard(2.1, 64, -0.01));
  entities.push(new RagShard(4.2, 52, 0.014));

  entities.push(new Agent(-95, 58, C.agentYellow, "1_architect", 148, [
    "Карта API CRM↔ERP",
    "Схема полей согласована",
    "Источники правды зафиксированы"
  ], -1.6));
  entities.push(new Agent(-55, 72, C.agentGreen, "2_data", 154, [
    "Дубли в CRM убраны",
    "Контекст сделки полный",
    "ERP read-only подключён"
  ], -0.3));
  entities.push(new Agent(-10, 78, C.agentBlue, "3_integrator", 160, [
    "Webhook → Redis OK",
    "Идемпотентность API",
    "Очередь без таймаутов"
  ], 0.5));
  entities.push(new Agent(40, 70, C.agentPink, "4_rag", 166, [
    "Регламенты в RAG",
    "Прайс подмешан в промпт",
    "FAQ по продукту готов"
  ], 1.2));
  entities.push(new Agent(82, 58, C.agentPurple, "5_governance", 172, [
    "RBAC перед записью",
    "Журнал действий включён",
    "Запись в CRM подтверждена"
  ], 2.0));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 240, maxLife: customLife || 240 });
  }

  var bubbleFired = { ingest: false, merge: false, agent: false, sync: false };

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    var ph = phase();
    var gridA = 0.04 + (ph === "sync" ? 0.06 : 0);
    ctx.strokeStyle = "rgba(121,242,255," + gridA + ")";
    ctx.lineWidth = 1;
    for (var gx = -160; gx <= 160; gx += 32) {
      ctx.beginPath();
      ctx.moveTo(gx, -90);
      ctx.lineTo(gx, 90);
      ctx.stroke();
    }

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });
    sparks.forEach(function (s) { s.draw(ctx); });

    var t = frame % LOOP;
    if (t === 8) { sparks[0].trigger(); }
    if (t === 22) { sparks[2].trigger(); }
    if (t === 38) { sparks[1].trigger(); }

    if (t >= 62 && t < 62.05 && !bubbleFired.merge) {
      createBubble(-40, -50, "2. Контекст CRM+ERP слит");
      bubbleFired.merge = true;
    }
    if (t >= 100 && t < 100.05) createBubble(0, -70, "3. RAG: регламенты в запросе");
    if (t >= 162 && t < 162.05) createBubble(50, 10, "4. MCP-коннектор активен");
    if (t >= 205 && t < 205.05) {
      createBubble(0, -85, "5. CONTEXT LIVE — все системы в синхроне", 280);
      SATELLITES.forEach(function (_, i) { sparks[i].trigger(); });
    }
    if (t < 5) { bubbleFired = { ingest: false, merge: false, agent: false, sync: false }; }

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      rr(bub.x - tw / 2, bub.y - 18, tw, 18, 6, C.bubbleBg, C.hubRing, 1);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bub.x, bub.y - 8);
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
  document.querySelectorAll('.iace-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.iace-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.iace-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.iace-faq-q');if(q)q.setAttribute('aria-expanded','false');
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
  var root=document.querySelector('.iace-content');
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

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

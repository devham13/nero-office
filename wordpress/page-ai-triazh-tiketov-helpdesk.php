<?php
/**
 * Template Name: AI-триаж тикетов helpdesk: внедрение под ключ
 * Description: SEO-лендинг — AI-триаж тикетов helpdesk. Классификация, приоритет, маршрутизация. Zendesk, Freshdesk, CRM. Аудит SLA бесплатно.
 */

$page_seo_title       = 'AI-триаж тикетов helpdesk: внедрение под ключ';
$page_seo_description = 'Внедряем AI-триаж тикетов в helpdesk: классификация по теме, приоритет и маршрутизация к исполнителю. Zendesk, Freshdesk, CRM. Аудит SLA — бесплатно.';

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
    ['label' => 'Проблема', 'href' => '#sla-bolezni'],
    ['label' => 'Как работает', 'href' => '#chto-takoe-ai-triazh'],
    ['label' => 'Этапы', 'href' => '#etapy-vnedreniya'],
    ['label' => 'Интеграции', 'href' => '#integratsii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить helpdesk';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = 'Как это работает';
$secondary_cta_url = '#chto-takoe-ai-triazh';

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

/* ── Hero helpdesk triage: ath- prefix, самодостаточные стили ── */
.ath-hero-helpdesk {
  --ath-cyan: #79f2ff;
  --ath-violet: #8b5cf6;
  --ath-green: #22c55e;
  --ath-amber: #f59e0b;
  --ath-rose: #fb7185;
  --ath-text: #e6edf7;
  --ath-muted: #9aa8bd;
  --ath-soft: #c7d2e5;
  --ath-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.ath-hero-helpdesk.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.ath-hero-helpdesk::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 55% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.ath-hero-helpdesk::after {
  content: "";
  position: absolute;
  right: 8%;
  top: 12%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(8px);
  animation: athHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes athHeroGlow {
  from { opacity: .4; transform: scale(.94); }
  to { opacity: .82; transform: scale(1.05); }
}
.ath-hero-helpdesk .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.ath-hero-helpdesk .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.ath-hero-helpdesk .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.ath-hero-helpdesk .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--ath-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.ath-hero-helpdesk .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--ath-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.ath-hero-helpdesk .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--ath-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.ath-hero-helpdesk .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.ath-hero-helpdesk .nero-ai-badge {
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
.ath-hero-helpdesk .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.ath-hero-helpdesk .nero-ai-btn {
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
.ath-hero-helpdesk .nero-ai-btn:hover { transform: translateY(-2px); }
.ath-hero-helpdesk .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--ath-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.ath-hero-helpdesk .nero-ai-btn-secondary {
  color: var(--ath-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.ath-hero-helpdesk .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--ath-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.ath-hero-helpdesk .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.ath-hero-helpdesk .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.ath-hero-helpdesk .nero-ai-dots { display: flex; gap: 7px; }
.ath-hero-helpdesk .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.ath-hero-helpdesk .nero-ai-dot:nth-child(1) { background: var(--ath-rose); }
.ath-hero-helpdesk .nero-ai-dot:nth-child(2) { background: var(--ath-amber); }
.ath-hero-helpdesk .nero-ai-dot:nth-child(3) { background: var(--ath-green); }
.ath-hero-helpdesk .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.ath-hero-helpdesk .nero-ai-window-body { padding: 16px; }
.ath-hero-helpdesk .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.ath-hero-helpdesk .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.ath-hero-helpdesk .nero-ai-live-pill {
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
.ath-hero-helpdesk .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--ath-green);
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: athPulse 1.6s infinite;
}
@keyframes athPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.ath-hero-helpdesk .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.ath-hero-helpdesk .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.ath-hero-helpdesk .nero-ai-metric span {
  display: block;
  color: var(--ath-muted);
  font-size: 11px;
  font-weight: 700;
}
.ath-hero-helpdesk .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.ath-hero-helpdesk .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.ath-hero-helpdesk .ath-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(139, 92, 246, 0.18);
  background: radial-gradient(ellipse at 50% 42%, rgba(139,92,246,.10), rgba(6,10,24,.92) 72%);
}
.ath-hero-helpdesk #ath-helpdesk-triage-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.ath-hero-helpdesk .nero-ai-task-stream { display: grid; gap: 8px; }
.ath-hero-helpdesk .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.ath-hero-helpdesk .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  font-size: 11px;
  font-weight: 800;
}
.ath-hero-helpdesk .nero-ai-task-icon--p1 { background: rgba(251,113,133,.14); color: var(--ath-rose); }
.ath-hero-helpdesk .nero-ai-task-icon--bill { background: rgba(121,242,255,.12); color: var(--ath-cyan); }
.ath-hero-helpdesk .nero-ai-task-icon--sent { background: rgba(245,158,11,.12); color: var(--ath-amber); }
.ath-hero-helpdesk .nero-ai-task-icon--rev { background: rgba(139,92,246,.14); color: var(--ath-violet); }
.ath-hero-helpdesk .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.ath-hero-helpdesk .nero-ai-task span {
  color: var(--ath-muted);
  font-size: 11px;
}
.ath-hero-helpdesk .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.ath-hero-helpdesk .nero-ai-status--route { background: rgba(121,242,255,.11); color: #a5f3fc; }
.ath-hero-helpdesk .nero-ai-status--ok { background: rgba(34,197,94,.11); color: #bbf7d0; }
.ath-hero-helpdesk .nero-ai-status--amber { background: rgba(245,158,11,.12); color: #fde68a; }
.ath-hero-helpdesk .nero-ai-status--review { background: rgba(139,92,246,.12); color: #ddd6fe; }
@media (max-width: 1100px) {
  .ath-hero-helpdesk .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .ath-hero-helpdesk .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .ath-hero-helpdesk .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .ath-hero-helpdesk .nero-ai-window-body { padding: 12px; }
  .ath-hero-helpdesk .nero-ai-task { grid-template-columns: 28px 1fr; }
  .ath-hero-helpdesk .nero-ai-status { grid-column: 2; width: fit-content; }
}

/* ── ATH content root (статья, не hero) ── */
.ath-content{
  --ath-bg:#050711;--ath-bg2:#080b17;--ath-surface:rgba(255,255,255,.072);
  --ath-text:#e6edf7;--ath-muted:#9aa8bd;--ath-soft:#c7d2e5;--ath-heading:#fff;
  --ath-border:rgba(255,255,255,.10);--ath-accent:#79f2ff;--ath-violet:#8b5cf6;--ath-green:#22c55e;--ath-amber:#f59e0b;--ath-rose:#fb7185;
  --ath-btn-from:#2563eb;--ath-btn-to:#7c3aed;--ath-r:18px;--ath-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--ath-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.ath-content *,.ath-content *::before,.ath-content *::after{box-sizing:border-box}
.ath-content a{color:inherit}
.ath-content p{color:var(--ath-muted);line-height:1.72;margin:0 0 1em}
.ath-content p:last-child{margin-bottom:0}
.ath-content h2,.ath-content h3,.ath-content h4{color:var(--ath-heading);letter-spacing:-.045em;margin:0 0 .7em}
.ath-content strong{color:var(--ath-soft)}
.ath-content ul,.ath-content ol{padding-left:0;list-style:none;margin:0 0 1em}
.ath-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--ath-muted);font-size:14.5px;line-height:1.65}
.ath-content ul li::before{content:'›';position:absolute;left:0;color:var(--ath-accent);font-weight:700}
.ath-content ol{counter-reset:ath-ol;margin:0 0 1em;padding:0}
.ath-content ol li{counter-increment:ath-ol;padding-left:28px;position:relative;margin-bottom:.5em;color:var(--ath-muted);font-size:14.5px;line-height:1.65}
.ath-content ol li::before{content:counter(ath-ol);position:absolute;left:0;width:20px;height:20px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--ath-accent);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;top:2px}
.ath-cnt{width:min(var(--ath-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.ath-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.ath-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.ath-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.ath-sh.ath-left{margin-left:0;text-align:left}
.ath-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.ath-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.ath-sh.ath-left p{margin-left:0}
.ath-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ath-accent);margin-bottom:14px}
.ath-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.ath-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.ath-intro-text{position:relative;padding-left:20px}
.ath-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--ath-accent),var(--ath-violet))}
.ath-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--ath-muted);margin-bottom:1em}
.ath-intro-text p:last-child{margin-bottom:0;color:var(--ath-soft)}
.ath-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.ath-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.ath-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--ath-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.ath-kpi-card .kl{font-size:11px;font-weight:600;color:var(--ath-muted);line-height:1.4}
.ath-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.ath-intro-grid{grid-template-columns:1fr;gap:36px}.ath-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.ath-intro-kpi{grid-template-columns:1fr 1fr}}
.ath-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.ath-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.ath-toc a{display:inline-block;padding:9px 18px;background:var(--ath-surface);border:1px solid var(--ath-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--ath-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.ath-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--ath-accent);background:rgba(121,242,255,.08)}
.ath-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--ath-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.ath-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.ath-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.ath-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.ath-grid-2,.ath-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.ath-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.ath-grid-3{grid-template-columns:1fr}}
.ath-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.ath-table,.ym-table{width:100%;border-collapse:collapse;font-size:14px}
.ath-table th,.ym-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--ath-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.ath-table td,.ym-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--ath-text);vertical-align:top}
.ath-table tr:last-child td,.ym-table tr:last-child td{border-bottom:none}
.ath-table tr:hover td,.ym-table tr:hover td{background:rgba(255,255,255,.03)}
.ath-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.ath-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--ath-accent);border:1px solid rgba(121,242,255,.2)}
.ath-flow .arr{color:var(--ath-muted);font-size:16px;padding:0 4px;background:none;border:none}
.ath-timeline{position:relative;padding-left:40px}
.ath-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--ath-accent),var(--ath-violet));opacity:.35;border-radius:2px}
.ath-tl-item{position:relative;margin-bottom:32px}
.ath-tl-item:last-child{margin-bottom:0}
.ath-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--ath-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.ath-tl-item h3{font-size:17px;margin-bottom:8px}
.ath-tl-item p{font-size:14.5px;margin:0}
.ath-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.ath-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.ath-case-grid{grid-template-columns:1fr}}
.ath-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.ath-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.ath-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ath-green);margin-bottom:10px}
.ath-case-card h3{font-size:16px;margin-bottom:14px}
.ath-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px}
.ath-metric .num{font-size:20px;font-weight:900;color:var(--ath-accent);flex-shrink:0}
.ath-metric .lbl{font-size:13px;color:var(--ath-muted)}
.ath-platform-badges{display:flex;flex-wrap:wrap;gap:8px;margin:20px 0}
.ath-platform-badges span{padding:6px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(139,92,246,.12);border:1px solid rgba(139,92,246,.28);color:#c4b5fd}
.ath-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.ath-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.ath-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--ath-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.ath-faq-q::after{content:'▾';font-size:13px;color:var(--ath-accent);flex-shrink:0;transition:transform .25s}
.ath-faq-item.open .ath-faq-q::after{transform:rotate(180deg)}
.ath-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--ath-muted);line-height:1.72}
.ath-faq-item.open .ath-faq-a{max-height:900px;padding:0 24px 20px}
.ath-audit-card{border-left:3px solid var(--ath-accent);padding-left:20px;margin:24px 0}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--ath-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--ath-accent)!important;text-decoration:underline!important}
.ath-related{font-size:15px;margin-top:20px}
.ath-related a{color:var(--ath-accent)!important;text-decoration:underline!important;text-underline-offset:3px}
.ath-inline-cta{margin-top:16px;font-size:14.5px}
.ath-inline-cta a{color:var(--ath-accent)!important;font-weight:700;text-decoration:underline!important}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-triazh-tiketov-helpdesk-page" role="main" tabindex="-1">

</style>

<section class="nero-ai-hero ath-hero-helpdesk" id="ath-hero-helpdesk" aria-labelledby="ath-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Support / helpdesk · внедрение под ключ</p>
      <h1 id="ath-hero-title">AI-триаж тикетов helpdesk: внедрение классификации и маршрутизации <span class="nero-ai-gradient-text">под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI определяет тему, срочность и исполнителя каждого обращения — SLA соблюдается, тикеты не теряются на L1</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Классификация intent</li>
        <li class="nero-ai-badge">Приоритет P1–P4</li>
        <li class="nero-ai-badge">Маршрутизация L1/L2/L3</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить helpdesk</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#chto-takoe-ai-triazh">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Helpdesk Triage Console — демонстрация AI-триажа">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Helpdesk Triage Console</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Тикетов сегодня</span>
              <strong>312</strong>
              <small>портал + чат + email</small>
            </div>
            <div class="nero-ai-metric">
              <span>Auto-triage</span>
              <strong>87%</strong>
              <small>без ручной сортировки L1</small>
            </div>
            <div class="nero-ai-metric">
              <span>Среднее время triage</span>
              <strong>11 сек</strong>
              <small>intent → очередь</small>
            </div>
            <div class="nero-ai-metric">
              <span>SLA breach сегодня</span>
              <strong>2</strong>
              <small>−68% к прошлой неделе</small>
            </div>
          </div>

          <div class="ath-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ath-helpdesk-triage-canvas" role="img" aria-label="Анимация: тикеты по радиальным спицам классифицируются AI и маршрутизируются в очереди L1, Billing и L2"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента тикетов">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--p1">P1</span>
              <div><strong>«не работает API»</strong><span>→ L2 DevOps · confidence 0.91</span></div>
              <span class="nero-ai-status nero-ai-status--route">маршрут</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--bill">₽</span>
              <div><strong>Биллинг: двойное списание</strong><span>→ очередь Billing · P2</span></div>
              <span class="nero-ai-status nero-ai-status--ok">SLA ok</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--sent">−</span>
              <div><strong>Sentiment негативный</strong><span>VIP-клиент · эскалация</span></div>
              <span class="nero-ai-status nero-ai-status--amber">эскалация</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--rev">?</span>
              <div><strong>Low confidence 0.54</strong><span>→ review L1 · human triage</span></div>
              <span class="nero-ai-status nero-ai-status--review">review</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="ath-content">

  <section class="ath-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="ath-cnt">
      <div class="ath-intro-grid nero-ai-reveal">
        <div class="ath-intro-text">
          <p class="ath-eyebrow">Лонгрид · AI helpdesk triage</p>
          <p><strong>Коротко:</strong> AI-триаж тикетов helpdesk — это автоматический анализ каждого обращения до ручной обработки L1: система определяет тему, срочность и исполнителя, чтобы SLA соблюдался, а тикеты не терялись в общей очереди.</p>
          <p>Nero Network внедряет <strong>ai triage tickets под ключ</strong> поверх Zendesk, Freshdesk, Jira Service Management, Битрикс24 и amoCRM — без смены helpdesk. Первый шаг: бесплатный <strong>аудит SLA и маршрутизации</strong> на 100–200 тикетов.</p>
        </div>
        <div class="ath-intro-kpi" aria-label="Ключевые метрики triage">
          <div class="ath-kpi-card"><div class="kv">30–60 с</div><div class="kl">экономия на категоризации</div><div class="ks">Zendesk, на тикет</div></div>
          <div class="ath-kpi-card"><div class="kv">85–95%</div><div class="kl">точность AI-триажа</div><div class="ks">при обучении на истории</div></div>
          <div class="ath-kpi-card"><div class="kv">250–800К</div><div class="kl">ориентир чека проекта</div><div class="ks">пилот + интеграция</div></div>
          <div class="ath-kpi-card"><div class="kv">4 нед</div><div class="kl">типовой пилот</div><div class="ks">KPI + confidence gate</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="ath-toc-outer">
    <div class="ath-cnt">
      <nav class="ath-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#sla-bolezni">Проблема</a>
        <a href="#chto-takoe-ai-triazh">Как работает</a>
        <a href="#klassifikatsiya-prioritet">Классификация</a>
        <a href="#marshrutizatsiya">Маршрутизация</a>
        <a href="#integratsii">Интеграции</a>
        <a href="#etapy-vnedreniya">Этапы</a>
        <a href="#metriki">Метрики</a>
        <a href="#keisy">Кейсы</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- §1 SLA болезни -->
  <section class="ath-section" id="sla-bolezni">
    <div class="ath-cnt">
      <div class="ath-sh ath-left nero-ai-reveal">
        <span class="ath-eyebrow">Проблема маршрутизации</span>
        <h2>Почему тикеты попадают не к тому специалисту и срывают SLA</h2>
        <p>В SaaS-компаниях, IT-поддержке и сервисных центрах обращение формально принято, но <strong>маршрутизация тикетов helpdesk</strong> работает на глаз — и SLA нарушается ещё до эскалации.</p>
      </div>

      <div class="ath-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="ath-card">
          <h3>Типичные боли на аудите</h3>
          <ul>
            <li><strong>Misroute</strong> — биллинг вместо техподдержки, L2 вместо L1, региональная очередь вместо центральной</li>
            <li><strong>Ручной triage съедает часы</strong> — при 500+ обращений/мес это десятки часов L1 только на категоризации</li>
            <li><strong>SLA breach без прозрачности</strong> — нет картины, почему сорвался дедлайн</li>
            <li><strong>Негативный sentiment пропускается</strong> — VIP ждёт в той же очереди, что и смена пароля</li>
          </ul>
        </div>
        <div class="ath-card ath-audit-card">
          <h3>Определение SLA breach</h3>
          <p>Нарушение согласованного времени первого ответа или решения по политике поддержки. <strong>AI sla контроль</strong> начинается не с отчёта постфактум, а с корректной приоритизации в момент создания тикета.</p>
          <p style="margin-top:14px">Коммерческий вход — <strong>аудит SLA и маршрутизации</strong>: карта очередей, % misroute, среднее время triage. Бесплатный первый шаг перед пилотом.</p>
        </div>
      </div>
    </div>

    <div class="ath-cnt">
      <aside class="ym-cta-block ym-cta-block--primary" id="cta-audit-sla">
        <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить helpdesk — бесплатно</p>
          <p class="ym-cta-block__sub">Выгрузим 100–200 тикетов, построим карту очередей и покажем % misroute и SLA breach до старта пилота. Без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить helpdesk</a>
        </div>
      </aside>
    </div>
  </section>

  <!-- §2 Что такое AI-триаж -->
  <section class="ath-section ath-section-alt" id="chto-takoe-ai-triazh">
    <div class="ath-cnt">
      <div class="ath-sh nero-ai-reveal">
        <span class="ath-eyebrow">Определение</span>
        <h2>Что такое AI-триаж тикетов в helpdesk</h2>
        <p><strong>AI triage tickets</strong> — автоматический анализ входящего обращения с определением темы/интента, срочности и исполнителя <em>до</em> ручной обработки первой линии.</p>
      </div>

      <div class="ath-card nero-ai-reveal" style="margin-bottom:28px">
        <p><strong>Коротко:</strong> триаж — это не ответ клиенту и не закрытие тикета. Это решение «куда, кому и с каким приоритетом» направить обращение за секунды после intake.</p>
      </div>

      <div class="ath-sh ath-left nero-ai-reveal" style="margin-bottom:24px">
        <h3>Отличие triage от простой автоматизации ответов</h3>
      </div>
      <div class="ath-table-wrap nero-ai-reveal">
        <table class="ath-table ym-table" aria-label="Сравнение подходов к triage">
          <thead><tr><th>Подход</th><th>Что делает</th><th>Риск</th></tr></thead>
          <tbody>
            <tr><td>Rule-based routing (ключевые слова)</td><td>Маршрут по шаблонам «если тема содержит X»</td><td>Точность <strong>40–50%</strong> на сложных формулировках</td></tr>
            <tr><td><strong>AI-триаж (NLP/LLM)</strong></td><td>Intent detection + priority scoring + routing</td><td>Точность <strong>85–95%</strong> при обучении на истории</td></tr>
            <tr><td>Полный AI-agent (agentic)</td><td>Автономное решение обращения без человека</td><td>Gartner: <strong>&gt;40%</strong> agentic-проектов отменят к 2027 из-за ROI</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;font-size:14.5px">Для mid-market SaaS оптимален <strong>практичный средний слой</strong>: классификация + маршрутизация + <strong>ai sla контроль</strong> с human-in-the-loop. IBM (2026): акцент на human-machine collaboration, не замену агентов.</p>

      <div class="ath-sh ath-left nero-ai-reveal" style="margin-top:48px">
        <h3>Тема, срочность, исполнитель — три решения на каждый тикет</h3>
      </div>
      <ol class="nero-ai-reveal" style="max-width:720px;margin:0 auto 28px">
        <li><strong>Тема / intent</strong> — категория обращения (биллинг, техсбой, onboarding, возврат)</li>
        <li><strong>Срочность</strong> — P1–P4 с учётом SLA-политики, тарифа клиента, sentiment</li>
        <li><strong>Исполнитель / очередь</strong> — L1/L2/L3, skills-based assignee, региональная группа</li>
      </ol>

      <div class="ath-flow nero-ai-reveal" aria-label="Пайплайн triage">
        <span>Intake</span><span class="arr">→</span>
        <span>NLP / LLM</span><span class="arr">→</span>
        <span>Priority scoring</span><span class="arr">→</span>
        <span>Routing</span><span class="arr">→</span>
        <span>Confidence gate</span>
      </div>

      <p class="ath-related nero-ai-reveal">На смежной странице <a href="/vnedrenie-ai-obrabotka-email-crm/">внедрение AI-обработки email в CRM</a> канал — почтовый ящик → CRM. Здесь фокус на <strong>тикетах helpdesk/ITSM</strong>: портал, чат, Zendesk, Jira SM, Битрикс24.</p>
    </div>
  </section>

  <!-- БОРИС: визуальный блок после 2-го H2 -->
  <section id="ath-triazh-helpdesk-boris-block" class="bath-root" aria-label="Анимация: AI-триаж маршрутизирует тикеты по очередям L1, Billing и L2">
<style>
/* === БОРИС: prefix bath-, scoped внутри #ath-triazh-helpdesk-boris-block === */
#ath-triazh-helpdesk-boris-block.bath-root{
  padding:56px 0 64px;
  background:linear-gradient(180deg,rgba(121,242,255,.04),transparent);
  border-top:1px solid rgba(121,242,255,.08);
  border-bottom:1px solid rgba(121,242,255,.08);
}
#ath-triazh-helpdesk-boris-block .bath-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ath-triazh-helpdesk-boris-block .bath-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.12),0 0 0 1px rgba(121,242,255,.2);
  min-height:500px;
}
@media(max-width:1023px){
  #ath-triazh-helpdesk-boris-block .bath-card{grid-template-columns:1fr;min-height:auto;}
}
#ath-triazh-helpdesk-boris-block .bath-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ath-triazh-helpdesk-boris-block .bath-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#ath-triazh-helpdesk-boris-block .bath-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#0891b2;margin:0 0 14px;
}
#ath-triazh-helpdesk-boris-block .bath-ey::before{
  content:'';width:18px;height:2px;background:#79f2ff;border-radius:1px;
}
#ath-triazh-helpdesk-boris-block .bath-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#ath-triazh-helpdesk-boris-block .bath-ul{
  list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;
}
#ath-triazh-helpdesk-boris-block .bath-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#ath-triazh-helpdesk-boris-block .bath-ul li::before{content:none}
#ath-triazh-helpdesk-boris-block .bath-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(121,242,255,.15);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#0891b2;margin-top:1px;font-style:normal;font-weight:800;
}
#ath-triazh-helpdesk-boris-block .bath-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ath-triazh-helpdesk-boris-block .bath-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ath-triazh-helpdesk-boris-block .bath-pl-c{background:rgba(121,242,255,.15);color:#0e7490;}
#ath-triazh-helpdesk-boris-block .bath-pl-g{background:rgba(34,197,94,.12);color:#15803d;}
#ath-triazh-helpdesk-boris-block .bath-pl-v{background:rgba(139,92,246,.12);color:#6d28d9;}
#ath-triazh-helpdesk-boris-block .bath-pl-a{background:rgba(245,158,11,.12);color:#b45309;}
#ath-triazh-helpdesk-boris-block .bath-foot{font-size:13px;color:#64748b;margin:0;font-style:italic;}
#ath-triazh-helpdesk-boris-block .bath-rgt{
  position:relative;min-height:420px;
  background:linear-gradient(145deg,#f0f9ff 0%,#f8fafc 55%,#eef2ff 100%);
}
@media(max-width:1023px){#ath-triazh-helpdesk-boris-block .bath-rgt{min-height:360px;}}
#bath-triage-routing-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
    <div class="bath-cnt">
      <div class="bath-card">
        <div class="bath-lft">
          <span class="bath-ey">Маршрутизация в действии</span>
          <h3 class="bath-h3">Тикет создан → AI выдаёт intent, priority, queue — SLA-таймер стартует корректно</h3>
          <ul class="bath-ul">
            <li><span class="bath-ic">P1</span>«Не работает API» → L2 DevOps, confidence 0.91 — авто-назначение</li>
            <li><span class="bath-ic">$</span>Биллинг / возврат → очередь Billing, приоритет P2</li>
            <li><span class="bath-ic">−</span>Негативный sentiment → эскалация выше в очереди</li>
            <li><span class="bath-ic">?</span>Confidence &lt;60% → review L1, human-in-the-loop</li>
          </ul>
          <div class="bath-pills">
            <span class="bath-pl bath-pl-c">routing</span>
            <span class="bath-pl bath-pl-v">AI 0.91</span>
            <span class="bath-pl bath-pl-g">SLA ok</span>
            <span class="bath-pl bath-pl-a">review</span>
          </div>
          <p class="bath-foot">Дальше разберём классификацию и priority scoring →</p>
        </div>
        <div class="bath-rgt">
          <canvas id="bath-triage-routing-canvas" role="img" aria-label="Анимация: тикеты helpdesk проходят AI-триаж и распределяются по очередям L1, Billing и L2"></canvas>
        </div>
      </div>
    </div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bath-triage-routing-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a', hub:'#8b5cf6', hubGlow:'rgba(139,92,246,.22)',
    cyan:'#79f2ff', green:'#22c55e', amber:'#f59e0b', rose:'#fb7185',
    l1:'#3b82f6', bill:'#14b8a6', l2:'#8b5cf6', rev:'#f59e0b',
    muted:'#64748b', card:'#ffffff', line:'rgba(14,165,233,.3)'
  };

  var QUEUES = [
    {key:'l1', label:'L1 Support', color:C.l1, y:0},
    {key:'bill', label:'Billing', color:C.bill, y:0},
    {key:'l2', label:'L2 DevOps', color:C.l2, y:0},
    {key:'rev', label:'Review L1', color:C.rev, y:0}
  ];

  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  function drawTicket(x,y,w,h,priority,alpha){
    ctx.globalAlpha = alpha || 1;
    var col = priority==='P1' ? C.rose : priority==='P2' ? C.amber : C.cyan;
    rr(x,y,w,h,6,C.card,col);
    ctx.fillStyle = col;
    ctx.font = 'bold 9px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(priority, x+8, y+14);
    ctx.fillStyle = C.ink;
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText('Тикет #'+Math.floor(Math.random()*9000+1000), x+8, y+26);
    ctx.globalAlpha = 1;
  }

  var tickets = [];
  var cycleT = 0;

  function spawnTicket(){
    var types = [
      {q:'l2', p:'P1', label:'API down'},
      {q:'bill', p:'P2', label:'Возврат'},
      {q:'l1', p:'P3', label:'Пароль'},
      {q:'rev', p:'P3', label:'Неясно'},
      {q:'l1', p:'P2', label:'Onboarding'}
    ];
    var t = types[Math.floor(Math.random()*types.length)];
    tickets.push({
      x: -50, y: H*0.2 + Math.random()*H*0.15,
      type: t.q, priority: t.p, label: t.label,
      phase: 0, speed: 1.1 + Math.random()*0.5
    });
  }

  function drawHub(cx,cy,r,pulse){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
    g.addColorStop(0,C.hubGlow); g.addColorStop(1,'rgba(139,92,246,0)');
    ctx.fillStyle=g; ctx.beginPath(); ctx.arc(cx,cy,r*1.8,0,Math.PI*2); ctx.fill();
    rr(cx-r,cy-r,r*2,r*2,r*0.4,'#f5f3ff',C.hub);
    ctx.fillStyle=C.hub; ctx.font='bold '+Math.max(12,r*0.28)+'px system-ui,sans-serif';
    ctx.textAlign='center'; ctx.textBaseline='middle';
    ctx.fillText('AI Triage',cx,cy-4);
    ctx.font=Math.max(9,r*0.16)+'px system-ui,sans-serif'; ctx.fillStyle=C.muted;
    ctx.fillText('intent · priority · route',cx,cy+r*0.35);
    ctx.strokeStyle=C.hub; ctx.lineWidth=2+pulse*2; ctx.globalAlpha=0.25+pulse*0.35;
    ctx.beginPath(); ctx.arc(cx,cy,r+8+pulse*6,0,Math.PI*2); ctx.stroke();
    ctx.globalAlpha=1;
  }

  function drawQueue(x,y,w,h,q,count){
    rr(x,y,w,h,8,'rgba(255,255,255,.92)',q.color);
    ctx.fillStyle=q.color; ctx.font='bold 11px system-ui,sans-serif'; ctx.textAlign='left';
    ctx.fillText(q.label,x+10,y+18);
    ctx.fillStyle=C.muted; ctx.font='10px system-ui,sans-serif';
    ctx.fillText((count||0)+' в очереди',x+10,y+h-10);
  }

  function tick(){
    frame++; cycleT++;
    if(frame%85===0) spawnTicket();

    var hubX=W*0.44, hubY=H*0.42, hubR=Math.min(W,H)*0.085;
    var pulse=0.5+0.5*Math.sin(frame*0.06);
    QUEUES.forEach(function(q,i){ q.y=H*0.62+i*(H*0.085); });

    ctx.clearRect(0,0,W,H);
    ctx.fillStyle=C.muted; ctx.font='10px system-ui,sans-serif'; ctx.textAlign='left';
    ctx.fillText('Входящие тикеты',W*0.05,H*0.08);
    ctx.textAlign='right'; ctx.fillText('Очереди',W*0.95,H*0.08);

    ctx.strokeStyle=C.line; ctx.lineWidth=2; ctx.setLineDash([5,4]);
    ctx.beginPath(); ctx.moveTo(W*0.12,H*0.28); ctx.lineTo(hubX-hubR-6,hubY); ctx.stroke();
    ctx.setLineDash([]);

    drawHub(hubX,hubY,hubR,pulse);

    var counts={l1:0,bill:0,l2:0,rev:0};
    tickets=tickets.filter(function(tk){
      tk.phase+=tk.speed;
      var q=QUEUES.find(function(x){return x.key===tk.type;});
      if(!q) return false;
      if(tk.phase<110){ tk.x+=tk.speed*1.5; }
      else if(tk.phase<190){
        var dx=hubX-tk.x, dy=hubY-tk.y;
        tk.x+=dx*0.045; tk.y+=dy*0.045;
      } else if(tk.phase<270){
        var tx=W*0.72, ty=q.y+18;
        tk.x+=(tx-tk.x)*0.055; tk.y+=(ty-tk.y)*0.055;
      } else { counts[tk.type]++; return false; }
      drawTicket(tk.x-22,tk.y-14,44,32,tk.priority,Math.min(1,tk.phase/40));
      return true;
    });

    QUEUES.forEach(function(q){
      drawQueue(W*0.58,q.y,W*0.34,H*0.065,q,counts[q.key]);
    });

    if(cycleT>480){ cycleT=0; tickets=[]; }
    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
  </section>

  <!-- §3 Классификация -->
  <section class="ath-section" id="klassifikatsiya-prioritet">
    <div class="ath-cnt">
      <div class="ath-sh nero-ai-reveal">
        <span class="ath-eyebrow">NLP + правила</span>
        <h2>Как AI классифицирует и приоритизирует обращения</h2>
        <p><strong>Автоматическая классификация обращений</strong> строится на связке NLP/LLM и бизнес-правил.</p>
      </div>

      <div class="ath-flow nero-ai-reveal" aria-label="Пайплайн классификации">
        <span>Intake</span><span class="arr">→</span>
        <span>NLP/LLM</span><span class="arr">→</span>
        <span>Priority scoring</span><span class="arr">→</span>
        <span>Routing</span><span class="arr">→</span>
        <span>Confidence gate</span>
      </div>

      <div class="ath-sh ath-left nero-ai-reveal" style="margin-top:40px">
        <h3>Intent detection и разбор текста тикета</h3>
        <p>Модель анализирует subject, body, канал и метаданные. Для обучения — <strong>500–2000+</strong> исторических тикетов. Таксономия на старте: <strong>8–15 категорий intent</strong> + матрица P1–P4.</p>
      </div>

      <div class="ath-sh ath-left nero-ai-reveal" style="margin-top:40px">
        <h3>Priority scoring и правила срочности</h3>
        <p><strong>Ai приоритет обращений</strong> учитывает sentiment, тариф submitter, SLA-risk и тип по матрице ITIL/ESM — не только слова «срочно».</p>
      </div>

      <div class="ath-sh ath-left nero-ai-reveal" style="margin-top:40px">
        <h3>Human-in-the-loop при низкой уверенности</h3>
      </div>
      <div class="ath-table-wrap nero-ai-reveal">
        <table class="ath-table ym-table" aria-label="Confidence gate пороги">
          <thead><tr><th>Confidence</th><th>Действие</th></tr></thead>
          <tbody>
            <tr><td><strong>≥85%</strong></td><td>Автоматическое назначение очереди и полей</td></tr>
            <tr><td><strong>60–85%</strong></td><td>Подсказка L1: «предлагаем P2 / очередь Billing»</td></tr>
            <tr><td><strong>&lt;60%</strong></td><td>Общая очередь triage, ручная разметка</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:16px;font-size:14px">P1/P0 с юридическим риском <strong>всегда</strong> проходят выборочный аудит человеком, даже при высокой confidence.</p>
    </div>
  </section>

  <!-- §4 Маршрутизация -->
  <section class="ath-section ath-section-alt" id="marshrutizatsiya">
    <div class="ath-cnt">
      <div class="ath-sh nero-ai-reveal">
        <span class="ath-eyebrow">L1 / L2 / L3</span>
        <h2>Маршрутизация и распределение тикетов между линиями поддержки</h2>
        <p>После классификации срабатывает <strong>ai helpdesk routing</strong> — назначение очереди, группы и исполнителя.</p>
      </div>

      <div class="ath-grid-3 nero-ai-reveal">
        <div class="ath-card">
          <h3>L1</h3>
          <p>Типовые запросы, первичная диагностика, подтверждение AI-подсказок.</p>
        </div>
        <div class="ath-card">
          <h3>L2</h3>
          <p>Эскалация по skills: биллинг, интеграции, DevOps.</p>
        </div>
        <div class="ath-card">
          <h3>L3</h3>
          <p>Инциденты, security, архитектура.</p>
        </div>
      </div>

      <div class="ath-card nero-ai-reveal" style="margin-top:28px">
        <h3>Назначение по навыкам и загрузке</h3>
        <p><strong>Ai маршрутизация тикетов</strong> учитывает матрицу skills (язык, продукт, регион) и текущую загрузку агентов. Гибрид AI-классификатора и rule-based Auto Assignment (Round Robin, Load Balancer).</p>
        <p style="margin-top:12px"><strong>Итог:</strong> тикет → нормализация → AI (intent, priority, queue, confidence) → SLA-таймер → auto-assign или задача L1 → логирование для дообучения.</p>
      </div>
    </div>
  </section>

  <!-- §5 Интеграции -->
  <section class="ath-section" id="integratsii">
    <div class="ath-cnt">
      <div class="ath-sh nero-ai-reveal">
        <span class="ath-eyebrow">Стек</span>
        <h2>Интеграции: Zendesk, Freshdesk, Jira SM, Битрикс24, amoCRM</h2>
        <p><strong>Интеграция ai triage tickets</strong> не требует смены helpdesk. Модуль — слой между intake и очередями.</p>
      </div>

      <div class="ath-platform-badges nero-ai-reveal" aria-label="Платформы">
        <span>Zendesk</span><span>Freshdesk</span><span>Jira SM</span><span>Битрикс24</span><span>amoCRM</span><span>SimpleOne</span><span>1С:ITIL</span>
      </div>

      <div class="ath-timeline nero-ai-reveal">
        <div class="ath-tl-item">
          <div class="ath-tl-dot"></div>
          <h3>Webhook на ticket.created</h3>
          <p>AI-модуль обрабатывает payload: subject, description, requester, custom fields.</p>
        </div>
        <div class="ath-tl-item">
          <div class="ath-tl-dot"></div>
          <h3>Update fields</h3>
          <p>Priority, Group, Type, tags, assignee. Опционально — summary для L2 и RAG по похожим тикетам.</p>
        </div>
        <div class="ath-tl-item">
          <div class="ath-tl-dot"></div>
          <h3>Связка с CRM</h3>
          <p>Когда тариф в amoCRM/Битрикс24 — AI подтягивает customer tier для priority scoring.</p>
        </div>
      </div>

      <div class="ath-table-wrap nero-ai-reveal" style="margin-top:32px">
        <table class="ath-table ym-table" aria-label="Native AI vs кастомный слой Nero">
          <thead><tr><th>Платформа</th><th>Встроенный AI-triage</th><th>Когда нужен кастомный слой Nero</th></tr></thead>
          <tbody>
            <tr><td>Zendesk Intelligent Triage</td><td>Intent, sentiment, routing</td><td>Мульти-система, свои SLA, Битрикс24 параллельно</td></tr>
            <tr><td>Freshdesk Freddy Auto Triage</td><td>Priority, Group, Type</td><td>Кастомная таксономия, on-prem РФ, 152-ФЗ</td></tr>
            <tr><td>Jira SM / Rovo</td><td>Request type, priority, escalation</td><td>Смешанный стек ITSM + CRM вне Atlassian</td></tr>
            <tr><td>Битрикс24 / amoCRM</td><td>Базовая категоризация</td><td>Единый модуль для каналов, audit-first</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:16px;font-size:14px">Для enterprise с <strong>152-ФЗ</strong> возможен on-prem: YandexGPT, GigaChat с API к любым ITSM.</p>
    </div>
  </section>

  <!-- §6 Этапы -->
  <section class="ath-section ath-section-alt" id="etapy-vnedreniya">
    <div class="ath-cnt">
      <div class="ath-sh nero-ai-reveal">
        <span class="ath-eyebrow">Под ключ</span>
        <h2>Этапы внедрения AI-триажа под ключ</h2>
        <p>Проектная модель из шести этапов — рабочий чеклист для <strong>разработки ai triage tickets</strong> на вашем стеке.</p>
      </div>

      <div class="ath-timeline nero-ai-reveal">
        <div class="ath-tl-item">
          <div class="ath-tl-dot"></div>
          <h3>Аудит маршрутизации (лид-магнит)</h3>
          <p>100–200 тикетов, карта очередей, % misroute, breach SLA. Отчёт <strong>до</strong> покупки лицензий.</p>
        </div>
        <div class="ath-tl-item">
          <div class="ath-tl-dot"></div>
          <h3>Обучение модели</h3>
          <p>Пилот на закрытых тикетах: accuracy vs ручная разметка, калибровка confidence. Минимум <strong>500</strong> тикетов; комфортно — <strong>2000+</strong>.</p>
        </div>
        <div class="ath-tl-item">
          <div class="ath-tl-dot"></div>
          <h3>Пилот, метрики, масштабирование</h3>
          <p>4 недели: SLA breach %, FRT, % override, feedback loop (👍/👎). После стабилизации — все очереди и каналы.</p>
        </div>
      </div>
      <p class="ath-inline-cta nero-ai-reveal" style="text-align:center;margin-top:24px">
        <a href="#stoimost">Проверить helpdesk</a> — начните с аудита, не с «чёрного ящика».
      </p>
    </div>
  </section>

  <!-- §7 Метрики -->
  <section class="ath-section" id="metriki">
    <div class="ath-cnt">
      <div class="ath-sh nero-ai-reveal">
        <span class="ath-eyebrow">KPI пилота</span>
        <h2>Метрики до и после: время triage, SLA, нагрузка на L1</h2>
        <p>Без измеримых KPI <strong>автоматизация через ai triage tickets</strong> не попадает в бюджет.</p>
      </div>

      <div class="ath-table-wrap nero-ai-reveal">
        <table class="ath-table ym-table" aria-label="Метрики пилота triage">
          <thead><tr><th>Метрика</th><th>Что измеряем</th><th>Ориентиры из кейсов*</th></tr></thead>
          <tbody>
            <tr><td><strong>FRT</strong></td><td>Медиана до первого ответа</td><td>Qualia (Zendesk): <strong>−75%</strong> FRT</td></tr>
            <tr><td><strong>SLA breach %</strong></td><td>Доля тикетов с нарушением дедлайна</td><td>Цель: снижение на 15–30% от базы аудита</td></tr>
            <tr><td>Реакция на негатив</td><td>Время ответа frustrated users</td><td>Benevity: <strong>+58%</strong> скорость</td></tr>
            <tr><td>MTTR</td><td>Среднее время решения</td><td>CrushBank/watsonx: <strong>~25%</strong> снижение</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:12px;font-size:13px;color:#64748b">*Ориентиры для гипотез пилота, не гарантия результата.</p>

      <div class="ath-card nero-ai-reveal" style="margin-top:28px">
        <h3>Среднее время triage и доля ручной сортировки</h3>
        <p>Zendesk: экономия <strong>1–5 мин/тикет</strong> на категоризации; при 300 тикетах/день — <strong>5–25 часов/день</strong> потенциальной разгрузки L1.</p>
        <ul style="margin-top:14px">
          <li>prediction accuracy и prediction rate</li>
          <li>% override агентом (сигнал для дообучения)</li>
          <li>нагрузка L1 в часах/неделю</li>
          <li>топ intent по объёму</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- §8 Кейсы -->
  <section class="ath-section ath-section-alt" id="keisy">
    <div class="ath-cnt">
      <div class="ath-sh nero-ai-reveal">
        <span class="ath-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI triage tickets</h2>
        <p>Выигрыш даёт связка triage + SLA, а не «магический агент».</p>
      </div>

      <div class="ath-case-grid">
        <div class="ath-case-card nero-ai-reveal">
          <div class="ath-case-tag">SaaS · США</div>
          <h3>Qualia</h3>
          <p>Автоматизация triage в Zendesk — <strong>−75%</strong> FRT, <strong>−30%</strong> дневной объём тикетов после self-service.</p>
          <div class="ath-metric"><span class="num">−75%</span><span class="lbl">first response time</span></div>
        </div>
        <div class="ath-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="ath-case-tag">Канада</div>
          <h3>Benevity</h3>
          <p>~350 000 тикетов/год: intent + sentiment triage — <strong>+58%</strong> скорость для недовольных; <strong>364 ч/год</strong> экономии на категоризации.</p>
          <div class="ath-metric"><span class="num">+58%</span><span class="lbl">скорость ответа</span></div>
        </div>
        <div class="ath-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="ath-case-tag">IT-поддержка · РФ</div>
          <h3>Т1 «ИИ для ИТ-поддержки»</h3>
          <p>LLM/RAG для ITSM: автоклассификация, маршрутизация, API к Zendesk/Jira/Битрикс24, on-premise для 152-ФЗ.</p>
          <div class="ath-metric"><span class="num">on-prem</span><span class="lbl">152-ФЗ</span></div>
        </div>
        <div class="ath-case-card nero-ai-reveal">
          <div class="ath-case-tag">MSP · США</div>
          <h3>CrushBank + IBM watsonx</h3>
          <p>Классификация VPN setup vs repair — <strong>~25%</strong> снижение MTTR, <strong>+20%</strong> first-call resolution.</p>
          <div class="ath-metric"><span class="num">−25%</span><span class="lbl">MTTR</span></div>
        </div>
        <div class="ath-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="ath-case-tag">ESM / ITIL</div>
          <h3>SimpleOne AI BPA</h3>
          <p>Классификация на 0–1 линии, автомаршрутизация, RAG по инцидентам и known errors.</p>
          <div class="ath-metric"><span class="num">RAG</span><span class="lbl">known errors</span></div>
        </div>
        <div class="ath-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="ath-case-tag">Nero Network</div>
          <h3>Дифференциатор</h3>
          <p><strong>Аудит SLA как вход</strong>, а не сразу «бот». Честные KPI пилота и confidence gate.</p>
          <div class="ath-metric"><span class="num">audit</span><span class="lbl">first step</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- §9 Стоимость -->
  <section class="ath-section" id="stoimost">
    <div class="ath-cnt">
      <div class="ath-sh nero-ai-reveal">
        <span class="ath-eyebrow">Бюджет</span>
        <h2>Стоимость внедрения и сроки проекта</h2>
        <p><strong>Ai triage tickets цена</strong> зависит от очередей, каналов и глубины интеграции. Ориентир: <strong>250–800 тыс. ₽</strong>.</p>
      </div>

      <div class="ath-table-wrap nero-ai-reveal">
        <table class="ath-table ym-table" aria-label="Состав проекта triage">
          <thead><tr><th>Компонент</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Аудит SLA и маршрутизации</td><td>100–200 тикетов, карта misroute, рекомендации</td></tr>
            <tr><td>Пилот (3–6 недель)</td><td>Обучение, webhook, confidence gate, дашборд KPI</td></tr>
            <tr><td>Продакшен</td><td>Масштабирование очередей, feedback loop, документация</td></tr>
            <tr><td>On-prem / 152-ФЗ</td><td>YandexGPT/GigaChat, отдельная смета</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;font-size:15px">
        <strong>→ CTA: Проверить helpdesk</strong> — оставьте заявку на аудит SLA и маршрутизации до подписания контракта.
      </p>

      <div class="ym-cta-block ym-cta-block--dual" id="cta-stoimost-helpdesk">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте бюджет и ROI под ваш helpdesk</p>
          <p class="ym-cta-block__sub">Ориентир 250–800 тыс. ₽ за пилот + интеграцию. На аудите «Проверить helpdesk» дадим карту misroute, смету и KPI пилота — бесплатно на входе.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить helpdesk</a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn">Частые вопросы</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- §10 Внедрение AI -->
  <section class="ath-section ath-section-alt" id="vnedrenie-ai">
    <div class="ath-cnt">
      <div class="ath-sh ath-left nero-ai-reveal">
        <span class="ath-eyebrow">Кластер автоматизации</span>
        <h2>Внедрение AI в поддержку: связь с общим кластером автоматизации</h2>
        <p>Запросы <strong>внедрение ai в бизнес</strong>, <strong>внедрение ai агентов</strong> и <strong>внедрение нейросетей в рабочие процессы</strong> часто начинаются с абстрактного «хотим AI». Helpdesk-triage — конкретная точка входа с быстрым эффектом:</p>
      </div>
      <ul class="nero-ai-reveal" style="max-width:720px;margin:24px auto 0">
        <li>не затрагивает ERP и документооборот</li>
        <li>работает поверх Zendesk/Freshdesk/Битрикс24</li>
        <li>даёт метрики за 4 недели пилота</li>
      </ul>
      <div class="ath-card nero-ai-reveal" style="margin-top:28px;max-width:820px;margin-left:auto;margin-right:auto">
        <p>Gartner (март 2025): к 2029 agentic AI закроет <strong>80%</strong> типовых обращений — но Gartner (июнь 2025) предупреждает об отмене <strong>&gt;40%</strong> проектов к 2027. Позиция Nero Network: начинать с <strong>зрелого triage</strong>, не с «агента ради агента».</p>
        <p style="margin-top:12px"><strong>Внедрение ai в бизнес процессы</strong> поддержки = таксономия + интеграция + governance + мониторинг.</p>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie-triazh">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите разобраться в AI-триаже до старта проекта?</p>
          <p class="ym-cta-block__sub">Командам support и IT полезно понимать confidence gate, human-in-the-loop и интеграции с Zendesk/Freshdesk до пилота — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#'); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'); ?></a>. Это ускоряет согласование таксономии и порогов на этапе аудита.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- §11 FAQ -->
  <section class="ath-section" id="faq">
    <div class="ath-cnt">
      <div class="ath-sh nero-ai-reveal">
        <span class="ath-eyebrow">Вопрос — ответ</span>
        <h2>FAQ — частые вопросы о AI-триаже тикетов</h2>
      </div>

      <div class="ath-faq nero-ai-reveal">
        <div class="ath-faq-item">
          <div class="ath-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai triage tickets в существующий helpdesk?</div>
          <div class="ath-faq-a"><p>1. Аудит маршрутизации и SLA. 2. Выгрузка 500–2000+ тикетов. 3. Webhook → AI-модуль → update полей. 4. Пилот 4 недели с confidence gate. 5. Масштабирование. Смена helpdesk не требуется.</p></div>
        </div>
        <div class="ath-faq-item">
          <div class="ath-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит ai triage tickets для малого бизнеса?</div>
          <div class="ath-faq-a"><p>До 200–300 тикетов/мес. — нижняя часть коридора <strong>250–800 тыс. ₽</strong>: аудит + пилот на одной очереди. Точная смета — после аудита.</p></div>
        </div>
        <div class="ath-faq-item">
          <div class="ath-faq-q" tabindex="0" role="button" aria-expanded="false">Нужна ли интеграция с CRM?</div>
          <div class="ath-faq-a"><p>Не всегда. Если тариф в helpdesk — достаточно API helpdesk. <strong>Интеграция ai triage tickets с crm</strong> нужна, когда приоритет зависит от amoCRM/Битрикс24/Salesforce.</p></div>
        </div>
        <div class="ath-faq-item">
          <div class="ath-faq-q" tabindex="0" role="button" aria-expanded="false">Какие риски ошибочной классификации и GDPR/PII?</div>
          <div class="ath-faq-a"><p>Confidence gate + аудит критичных тикетов; анонимизация PII; on-prem для 152-ФЗ; agnostic-слой поверх native AI Zendesk/Freshdesk.</p></div>
        </div>
        <div class="ath-faq-item">
          <div class="ath-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько тикетов нужно для обучения?</div>
          <div class="ath-faq-a"><p>Минимум <strong>500</strong> размеченных; для стабильной accuracy — <strong>≥2000</strong>. При дефиците данных — режим подсказок (60–85% confidence).</p></div>
        </div>
        <div class="ath-faq-item">
          <div class="ath-faq-q" tabindex="0" role="button" aria-expanded="false">Чем AI-триаж helpdesk отличается от email-triage?</div>
          <div class="ath-faq-a"><p>Email-triage — канал почты → CRM. Helpdesk-triage — тикеты портала/чата/ITSM, фокус на <strong>маршрутизации L1/L2/L3 и SLA</strong>. См. раздел <a href="#chto-takoe-ai-triazh">«Что такое AI-триаж»</a> и блок <a href="#svyazannye-materialy">смежных материалов</a>.</p></div>
        </div>
      </div>

      <div class="ath-card nero-ai-reveal" style="margin-top:40px;text-align:center">
        <h3>Итог</h3>
        <p><strong>AI-триаж тикетов helpdesk</strong> — управляемое <strong>внедрение ai triage tickets под ключ</strong>: аудит SLA → классификация → приоритизация → маршрутизация → метрики. Nero Network внедряет модуль без смены helpdesk, с human-in-the-loop.</p>
        <p class="ath-inline-cta" style="margin-top:16px"><a href="#stoimost">Проверить helpdesk</a> — аудит SLA и маршрутизации бесплатно на входе.</p>
      </div>
    </div>
  </section>

</div><!-- /.ath-content -->
<section class="ath-section ath-section-alt" id="svyazannye-materialy" aria-label="Смежные материалы по внедрению AI">
  <div class="ath-cnt">
    <div class="ath-sh nero-ai-reveal">
      <span class="ath-eyebrow">Смежные материалы</span>
      <h2>Другие сценарии внедрения AI в бизнес-процессы</h2>
      <p>Helpdesk-triage — точка входа в кластер автоматизации поддержки. Ниже — опубликованные разборы смежных каналов, CRM и учётных контуров.</p>
    </div>
    <div class="ath-grid-2 nero-ai-reveal">
      <div class="ath-card">
        <h3>CRM и интеграции</h3>
        <ul>
          <li><a href="/vnedrenie-ai-amocrm/">AI-агент для amoCRM</a> — приоритет тикета по тарифу, сделке и сегменту клиента</li>
          <li>Email-triage до тикета — в разделе <a href="#chto-takoe-ai-triazh">«Что такое AI-триаж»</a></li>
        </ul>
      </div>
      <div class="ath-card">
        <h3>Учёт и масштаб</h3>
        <ul>
          <li><a href="/ai-1c-erp/">AI-агент для 1С и ERP</a> — автоматизация учёта и документооборота рядом с контуром поддержки</li>
          <li><a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">KPMG и Claude: уроки внедрения AI</a> — enterprise-кейс масштабирования AI в корпоративных процессах</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php
$ath_page_url = trailingslashit( get_permalink() );
$ath_site_url = trailingslashit( home_url( '/' ) );
$ath_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$ath_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $ath_site_url . '#organization',
      'name'  => $ath_brand,
      'url'   => $ath_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $ath_site_url . '#website',
      'url'       => $ath_site_url,
      'name'      => $ath_brand,
      'publisher' => [ '@id' => $ath_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $ath_page_url . '#webpage',
      'url'         => $ath_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $ath_site_url . '#website' ],
      'about'       => [ '@id' => $ath_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $ath_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $ath_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $ath_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $ath_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $ath_page_url,
      'provider'    => [ '@id' => $ath_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $ath_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить ai triage tickets в существующий helpdesk?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '1. Аудит маршрутизации и SLA. 2. Выгрузка 500–2000+ тикетов. 3. Webhook → AI-модуль → update полей. 4. Пилот 4 недели с confidence gate. 5. Масштабирование. Смена helpdesk не требуется.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит ai triage tickets для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'До 200–300 тикетов/мес. — нижняя часть коридора 250–800 тыс. ₽: аудит + пилот на одной очереди. Точная смета — после аудита.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужна ли интеграция с CRM?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Не всегда. Если тариф в helpdesk — достаточно API helpdesk. Интеграция ai triage tickets с crm нужна, когда приоритет зависит от amoCRM/Битрикс24/Salesforce.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие риски ошибочной классификации и GDPR/PII?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Confidence gate + аудит критичных тикетов; анонимизация PII; on-prem для 152-ФЗ; agnostic-слой поверх native AI Zendesk/Freshdesk.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько тикетов нужно для обучения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Минимум 500 размеченных; для стабильной accuracy — ≥2000. При дефиците данных — режим подсказок (60–85% confidence).' ] ],
        [ '@type' => 'Question', 'name' => 'Чем AI-триаж helpdesk отличается от email-triage?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Email-triage — канал почты → CRM. Helpdesk-triage — тикеты портала/чата/ITSM, фокус на маршрутизации L1/L2/L3 и SLA. См. внедрение AI-обработки email.' ] ],
      ],
    ],
    [
      '@type'             => 'Article',
      '@id'               => $ath_page_url . '#article',
      'headline'          => $page_seo_title,
      'description'       => $page_seo_description,
      'url'               => $ath_page_url,
      'mainEntityOfPage'  => [ '@id' => $ath_page_url . '#webpage' ],
      'publisher'         => [ '@id' => $ath_site_url . '#organization' ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $ath_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
?>

</main>

<script>
/**
 * ath-helpdesk-triage-engine — Диспетчерская триажа L1
 * Мир: радиальные спицы тикетов → TriageRoutingHub → QueuePod + SLA ring
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ath-helpdesk-triage-canvas");
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
    ticketBg: "#f1f5f9",
    ticketP1: "#fb7185",
    spoke: "rgba(121,242,255,0.20)",
    spokeGlow: "rgba(139,92,246,0.32)",
    hubBase: "#1e293b",
    hubAccent: "#8b5cf6",
    hubCyan: "#79f2ff",
    slaGreen: "#22c55e",
    slaWarn: "#f59e0b",
    podL1: "#3b82f6",
    podBill: "#06b6d4",
    podL2: "#a855f7",
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

  function drawTicket(ctx, x, y, w, h, color, label) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -w / 2, -h / 2, w, h, 3, color, C.outline);
    ctx.fillStyle = "#0f172a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    if (label) ctx.fillText(label, 0, 2);
    ctx.restore();
  }

  /* Радиальные спицы — транспорт тикетов */
  function RadialTicketLanes() {
    this.phase = 0;
  }
  RadialTicketLanes.prototype.draw = function (ctx) {
    this.phase = (frame * 0.028) % (Math.PI * 2);
    var spokes = [
      { angle: -Math.PI / 2, len: 95, label: "L1" },
      { angle: -Math.PI / 6, len: 88, label: "Bill" },
      { angle: Math.PI / 3, len: 92, label: "L2" }
    ];
    spokes.forEach(function (sp, idx) {
      var ex = Math.cos(sp.angle) * sp.len;
      var ey = Math.sin(sp.angle) * sp.len * 0.55 - 15;
      ctx.save();
      ctx.strokeStyle = idx === 2 ? C.spokeGlow : C.spoke;
      ctx.lineWidth = idx === 0 ? 2 : 1.2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.moveTo(0, -15);
      ctx.lineTo(ex, ey);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();
    });

    for (var i = 0; i < 4; i++) {
      var sp = spokes[i % 3];
      var t = (this.phase + i * 1.4) % (Math.PI * 2);
      var prog = (Math.sin(t) * 0.5 + 0.5);
      var px = Math.cos(sp.angle) * sp.len * prog;
      var py = -15 + Math.sin(sp.angle) * sp.len * 0.55 * prog;
      var col = i === 0 ? C.ticketP1 : C.ticketBg;
      drawTicket(ctx, px, py, 16, 11, col, i === 0 ? "P1" : "");
    }
  };

  /* Центральный хаб триажа */
  function TriageRoutingHub() {
    this.scanAngle = 0;
  }
  TriageRoutingHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.scanAngle = (frame * 0.06) % (Math.PI * 2);

    /* Гексагон-хаб */
    ctx.save();
    ctx.beginPath();
    for (var i = 0; i < 6; i++) {
      var a = Math.PI / 3 * i - Math.PI / 6;
      var hx = Math.cos(a) * 38;
      var hy = -18 + Math.sin(a) * 28;
      if (i === 0) ctx.moveTo(hx, hy);
      else ctx.lineTo(hx, hy);
    }
    ctx.closePath();
    ctx.fillStyle = C.hubBase;
    ctx.fill();
    ctx.strokeStyle = C.hubAccent;
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.restore();

    ctx.fillStyle = C.hubCyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI TRIAGE", 0, -16);

    /* Сканирующий луч */
    if (prg >= 40 && prg < 100) {
      ctx.save();
      ctx.strokeStyle = "rgba(139,92,246,0.55)";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(0, -18);
      ctx.lineTo(Math.cos(this.scanAngle) * 42, -18 + Math.sin(this.scanAngle) * 28);
      ctx.stroke();
      ctx.restore();
    }

    /* Фазы: CLASSIFY → SCORE → ROUTE */
    if (prg >= 55 && prg < 115) {
      ctx.fillStyle = "rgba(139,92,246,0.25)";
      ctx.beginPath();
      ctx.arc(0, -18, 22 + Math.sin(frame * 0.12) * 3, 0, Math.PI * 2);
      ctx.fill();
    }
    if (prg >= 115 && prg < 175) {
      pyramid.draw(ctx);
    }
    if (prg >= 175 && prg < 235) {
      var routeProg = (prg - 175) / 60;
      drawTicket(ctx, routeProg * 70 - 35, 25 - routeProg * 15, 18, 12, C.ticketP1, "API");
    }
    if (prg >= 220) {
      slaRing.draw(ctx, Math.min(1, (prg - 220) / 25));
    }
  };

  /* Пирамида приоритетов P1–P4 */
  function PriorityPyramid() {}
  PriorityPyramid.prototype.draw = function (ctx) {
    var levels = [
      { w: 50, y: 8, c: "rgba(251,113,133,0.35)", t: "P4" },
      { w: 38, y: -2, c: "rgba(245,158,11,0.35)", t: "P3" },
      { w: 26, y: -12, c: "rgba(121,242,255,0.35)", t: "P2" },
      { w: 14, y: -22, c: "rgba(251,113,133,0.55)", t: "P1" }
    ];
    levels.forEach(function (lv, i) {
      var lit = (frame + i * 15) % 80 < 40;
      drawRR(ctx, -lv.w / 2, lv.y - 6, lv.w, 10, 2, lit ? lv.c : "rgba(255,255,255,0.06)", C.outline);
      if (lit && i === 3) {
        ctx.fillStyle = C.ticketP1;
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("P1", 0, lv.y);
      }
    });
  };

  /* SLA-кольцо — финал цикла */
  function SlaCountdownRing() {
    this.pulse = 0;
  }
  SlaCountdownRing.prototype.draw = function (ctx, alpha) {
    if (alpha <= 0) return;
    this.pulse = Math.sin(frame * 0.1) * 0.15 + 0.85;
    ctx.save();
    ctx.globalAlpha = alpha;
    ctx.strokeStyle = C.slaGreen;
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(55, -55, 16 * this.pulse, 0, Math.PI * 2 * 0.92);
    ctx.stroke();
    ctx.fillStyle = C.slaGreen;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("SLA", 55, -52);
    ctx.fillText("OK", 55, -44);
    ctx.globalAlpha = 1;
    ctx.restore();
  };

  /* Поды очередей */
  function QueuePod(x, y, color, label) {
    this.x = x; this.y = y; this.color = color; this.label = label;
    this.assignFlash = 0;
  }
  QueuePod.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, this.x - 22, this.y - 14, 44, 28, 6, "rgba(255,255,255,0.06)", this.color);
    ctx.fillStyle = this.color;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(this.label, this.x, this.y + 2);

    if (prg >= 200 && prg < 250 && this.label === "L2") {
      this.assignFlash = (prg - 200) / 50;
      drawRR(ctx, this.x - 18, this.y - 28, 36, 12, 4, "rgba(34,197,94,0.3)", C.slaGreen);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("@devops", this.x, this.y - 20);
    }
  };

  function SentimentEscalationFlag() {}
  SentimentEscalationFlag.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 130 || prg > 175) return;
    var wave = Math.sin((prg - 130) * 0.2) * 4;
    drawRR(ctx, -130, -50 + wave, 28, 18, 4, "rgba(245,158,11,0.2)", C.slaWarn);
    ctx.fillStyle = C.slaWarn;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("VIP−", -116, -38 + wave);
  };

  function HumanReviewGate() {}
  HumanReviewGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 108, 18, 40, 22, 5, "rgba(139,92,246,0.12)", C.hubAccent);
    ctx.fillStyle = "#ddd6fe";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("review", 128, 28);
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("L1", 128, 36);
    if (prg > 240 && prg < 255) {
      drawTicket(ctx, 95, 5, 12, 8, C.ticketBg, "?");
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
    var prg = (frame * 0.038) % 260;
    var isMoving = false;
    var faceDir = 1;

    var podTargets = {
      "1_architect": { x: -75, y: 72 },
      "2_seo": { x: -25, y: 82 },
      "3_coder": { x: 25, y: 82 },
      "4_designer": { x: 75, y: 72 },
      "5_deployer": { x: 0, y: 90 }
    };
    var tgt = podTargets[this.role] || { x: 0, y: 80 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 17) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 240 === 0 && Math.random() < 0.14) {
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
    ctx.restore();
  };

  var pyramid = new PriorityPyramid();
  var slaRing = new SlaCountdownRing();
  var entities = [];
  var bubbles = [];

  entities.push(new RadialTicketLanes());
  entities.push(new SentimentEscalationFlag());
  entities.push(new TriageRoutingHub());
  entities.push(new HumanReviewGate());
  entities.push(new QueuePod(-72, 58, C.podL1, "L1"));
  entities.push(new QueuePod(0, 68, C.podBill, "Billing"));
  entities.push(new QueuePod(78, 58, C.podL2, "L2"));
  entities.push(new Agent(-130, 98, C.agentYellow, "1_architect", 20, [
    "Таксономия: 12 intent", "Матрица P1–P4 готова", "SLA-политика в YAML"
  ]));
  entities.push(new Agent(-65, 108, C.agentGreen, "2_seo", 58, [
    "Confidence ≥85% → auto", "VIP sentiment ↑", "Порог review = 60%"
  ]));
  entities.push(new Agent(0, 112, C.agentBlue, "3_coder", 98, [
    "ticket.created webhook", "Zendesk API v2", "Freshdesk adapter"
  ]));
  entities.push(new Agent(65, 108, C.agentPink, "4_designer", 138, [
    "Очереди L1/L2/Billing", "Skills-based UI", "Теги intent в UI"
  ]));
  entities.push(new Agent(130, 98, C.agentPurple, "5_deployer", 178, [
    "Auto-assign включён", "SLA-таймер старт", "Override лог в BI"
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

    var prg = (frame * 0.038) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(-90, -55, "1. Тикет в intake");
    if (prg >= 62 && prg < 62.05) createBubble(-40, -25, "2. Intent: API outage");
    if (prg >= 108 && prg < 108.05) createBubble(0, -35, "3. Priority P1");
    if (prg >= 158 && prg < 158.05) createBubble(50, 10, "4. → L2 DevOps");
    if (prg >= 218 && prg < 218.05) createBubble(70, -50, "5. SLA зелёный ✓");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.hubCyan);
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
  document.querySelectorAll('.ath-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.ath-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.ath-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.ath-faq-q');if(q)q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){item.classList.add('open');btn.setAttribute('aria-expanded','true');}
    });
    btn.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}});
  });
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

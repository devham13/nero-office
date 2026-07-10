<?php
/**
 * Template Name: AI-анализ возражений клиентов: внедрение под ключ
 * Description: SEO-лендинг — AI-анализ возражений клиентов по звонкам и перепискам. Карта возражений, CRM, телефония.
 */

$page_seo_title       = 'AI-анализ возражений клиентов: внедрение под ключ';
$page_seo_description = 'AI разбирает звонки и переписки, собирает карту возражений и причины отказов. Внедрение под ключ: CRM, телефония, мессенджеры. Рекомендации для оффера и скриптов продаж.';

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
    ['label' => 'Боль', 'href' => '#bole'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Демо-отчёт', 'href' => '#demo-otchet'],
    ['label' => 'Стоимость', 'href' => '#cena'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить демо-отчёт';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#kak-rabotaet';

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
.ai-analiz-vozrazheniy-page{--aavr-accent:#fb7185;--aavr-accent2:#a78bfa;--aavr-cyan:#79f2ff}
.aavr-hero-objections{min-height:100vh;min-height:100dvh;position:relative}
.aavr-intro{padding:clamp(40px,5vw,72px) 0 clamp(28px,4vw,48px);border-bottom:1px solid rgba(255,255,255,.06);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent)}
.aavr-intro-grid{display:grid;grid-template-columns:minmax(0,1fr) minmax(280px,360px);gap:clamp(28px,4vw,56px);align-items:center}
.aavr-intro-text{position:relative;padding-left:20px;text-align:left!important}
.aavr-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aavr-accent),var(--aavr-accent2))}
.aavr-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;margin:0 0 1em}
.aavr-intro-terminal{background:rgba(2,6,23,.55);border:1px solid rgba(255,255,255,.12);border-radius:18px;overflow:hidden;box-shadow:0 18px 50px rgba(0,0,0,.35)}
.aavr-term-top{display:flex;align-items:center;gap:7px;padding:10px 14px;border-bottom:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.04)}
.aavr-term-top span{width:9px;height:9px;border-radius:50%;background:#fb7185}
.aavr-term-top span:nth-child(2){background:#fbbf24}.aavr-term-top span:nth-child(3){background:#4ade80}
.aavr-term-top em{margin-left:auto;font-size:10px;font-style:normal;color:#9aa8bd;letter-spacing:.08em;text-transform:uppercase}
.aavr-term-body{padding:14px;display:grid;gap:8px}
.aavr-term-line{font-size:12px;color:#c7d2e5;font-family:ui-monospace,SFMono-Regular,Menlo,monospace}
.aavr-term-line code{color:#fda4af;margin-right:8px}
.aavr-term-ok{color:#bbf7d0}
.aavr-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:8px;padding:0 14px 14px}
.aavr-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:12px 10px;text-align:center}
.aavr-kpi-card .kv{display:block;font-size:clamp(18px,2.2vw,24px);font-weight:900;color:#fff}
.aavr-kpi-card .kl{display:block;margin-top:4px;font-size:10px;color:#9aa8bd;line-height:1.35}
.aavr-toc-outer{padding:8px 0 clamp(24px,3vw,40px)}
.aavr-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.aavr-toc a{display:inline-block;padding:9px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;font-weight:600;color:#9aa8bd}
.aavr-toc a:hover{border-color:rgba(251,113,133,.4);color:#fda4af;background:rgba(251,113,133,.08)}
.aavr-prose{max-width:860px}
.aavr-prose p,.aavr-faq-a p{color:var(--nero-ai-muted);line-height:1.72;margin:0 0 1.1em;font-size:15px}
.aavr-prose .aavr-lead{color:var(--nero-ai-soft);font-weight:600}
.aavr-prose h3.aavr-h3{font-size:clamp(18px,2.2vw,22px);margin:1.6em 0 .7em;color:#fff}
.aavr-list,.aavr-olist{margin:0 0 1.2em;padding-left:0;list-style:none}
.aavr-list li,.aavr-olist li{position:relative;padding-left:18px;margin-bottom:.5em;color:var(--nero-ai-muted);font-size:14.5px;line-height:1.65}
.aavr-list li::before{content:'›';position:absolute;left:0;color:var(--aavr-accent);font-weight:700}
.aavr-olist{counter-reset:aavrli}.aavr-olist li{counter-increment:aavrli}
.aavr-olist li::before{content:counter(aavrli) '.';position:absolute;left:0;color:var(--aavr-cyan);font-weight:800;font-size:12px}
.aavr-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:1.2em 0}
.aavr-table{width:100%;border-collapse:collapse;font-size:14px}
.aavr-table th{padding:12px 14px;text-align:left;background:rgba(251,113,133,.12);color:#fda4af;font-weight:700;border-bottom:1px solid rgba(251,113,133,.25)}
.aavr-table td{padding:11px 14px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--nero-ai-text);vertical-align:top}
.aavr-table tr:last-child td{border-bottom:none}
.aavr-prose a{color:var(--aavr-cyan);text-decoration:underline;text-underline-offset:2px}
.aavr-faq{display:grid;gap:10px;max-width:860px}
.aavr-faq-item{border:1px solid rgba(255,255,255,.1);border-radius:14px;background:rgba(255,255,255,.045);overflow:hidden}
.aavr-faq-item summary{padding:18px 20px;color:#fff;font-weight:750;cursor:pointer;list-style:none;display:flex;justify-content:space-between;gap:16px}
.aavr-faq-item summary::-webkit-details-marker{display:none}
.aavr-faq-item summary::after{content:'+';color:var(--aavr-accent);font-size:20px}
.aavr-faq-item[open] summary::after{content:'−'}
.aavr-faq-a{padding:0 20px 18px}
.ym-cta-block{border-radius:20px;padding:clamp(24px,4vw,36px);margin:28px 0;background:linear-gradient(135deg,rgba(251,113,133,.12),rgba(167,139,250,.1));border:1px solid rgba(251,113,133,.28);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block__icon{font-size:34px;margin-bottom:12px}
.ym-cta-block__headline{font-size:clamp(19px,2.6vw,26px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--nero-ai-muted);font-size:15px;margin:0 auto 18px;max-width:620px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-link--accent{color:var(--aavr-cyan)!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}
@media(max-width:900px){.aavr-intro-grid{grid-template-columns:1fr}}
/* Hero Alina */
/* ── Hero AI-анализ возражений: самодостаточные стили ── */
.aavr-hero-objections {
  --aavr-coral: #fb7185;
  --aavr-amber: #fbbf24;
  --aavr-violet: #a78bfa;
  --aavr-cyan: #67e8f9;
  --aavr-green: #4ade80;
  --aavr-text: #e6edf7;
  --aavr-muted: #9aa8bd;
  --aavr-soft: #c7d2e5;
  --aavr-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aavr-hero-objections::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 74%);
  opacity: .5;
  pointer-events: none;
  z-index: -2;
}
.aavr-hero-objections::after {
  content: "";
  position: absolute;
  right: 8%;
  top: 12%;
  width: 640px;
  height: 640px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(251,113,133,.14), transparent 68%);
  filter: blur(8px);
  animation: aavrHeroPulse 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aavrHeroPulse {
  from { opacity: .4; transform: scale(.94); }
  to { opacity: .82; transform: scale(1.05); }
}
.aavr-hero-objections .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aavr-hero-objections .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(340px, .95fr);
  gap: clamp(28px, 4vw, 52px);
  align-items: center;
}
.aavr-hero-objections .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 760px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aavr-hero-objections .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aavr-coral) 38%, var(--aavr-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aavr-hero-objections .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(251, 113, 133, 0.22);
  border-radius: 999px;
  background: rgba(251, 113, 133, 0.08);
  color: var(--aavr-coral) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aavr-hero-objections .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 700px;
  color: var(--aavr-soft) !important;
  font-size: clamp(17px, 1.85vw, 21px);
  line-height: 1.58;
}
.aavr-hero-objections .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 24px 0 0;
  padding: 0;
  list-style: none;
}
.aavr-hero-objections .nero-ai-badge {
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
.aavr-hero-objections .aavr-phase-row {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 20px 0 0;
}
.aavr-hero-objections .aavr-phase {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 12px;
  background: rgba(255,255,255,.04);
  color: var(--aavr-muted);
  font-size: 12px;
  font-weight: 650;
}
.aavr-hero-objections .aavr-phase strong {
  display: grid;
  place-items: center;
  width: 22px;
  height: 22px;
  border-radius: 7px;
  background: linear-gradient(135deg, var(--aavr-coral), var(--aavr-violet));
  color: #fff;
  font-size: 11px;
  font-weight: 800;
}
.aavr-hero-objections .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 30px;
}
.aavr-hero-objections .nero-ai-btn {
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
.aavr-hero-objections .nero-ai-btn:hover { transform: translateY(-2px); }
.aavr-hero-objections .nero-ai-btn-primary {
  color: #1a0a12 !important;
  background: linear-gradient(135deg, #fda4af, #fcd34d);
  box-shadow: 0 18px 42px rgba(251, 113, 133, 0.22);
}
.aavr-hero-objections .nero-ai-btn-secondary {
  color: var(--aavr-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aavr-hero-objections .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.44);
  box-shadow: var(--aavr-shadow);
  transform: perspective(1100px) rotateY(4deg) rotateX(1deg);
}
.aavr-hero-objections .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .96), rgba(8, 10, 22, .98));
}
.aavr-hero-objections .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aavr-hero-objections .nero-ai-dots { display: flex; gap: 7px; }
.aavr-hero-objections .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aavr-hero-objections .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aavr-hero-objections .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aavr-hero-objections .nero-ai-dot:nth-child(3) { background: #4ade80; }
.aavr-hero-objections .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aavr-hero-objections .nero-ai-window-body { padding: 16px; }
.aavr-hero-objections .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aavr-hero-objections .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aavr-hero-objections .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(251,113,133,.12);
  color: #fecdd3;
  font-size: 12px;
  font-weight: 800;
}
.aavr-hero-objections .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--aavr-coral);
  box-shadow: 0 0 0 6px rgba(251,113,133,.14);
  animation: aavrLivePulse 1.6s infinite;
}
@keyframes aavrLivePulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aavr-hero-objections .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aavr-hero-objections .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aavr-hero-objections .nero-ai-metric span {
  display: block;
  color: var(--aavr-muted);
  font-size: 11px;
  font-weight: 700;
}
.aavr-hero-objections .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aavr-hero-objections .aavr-dash-canvas-wrap {
  position: relative;
  height: clamp(210px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(251, 113, 133, 0.16);
  background: radial-gradient(ellipse at 50% 45%, rgba(251,113,133,.1), rgba(6,10,24,.92) 72%);
}
.aavr-hero-objections #aavr-objection-radar-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aavr-hero-objections .nero-ai-task-stream {
  display: grid;
  gap: 8px;
}
.aavr-hero-objections .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aavr-hero-objections .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(251,113,133,.12);
  color: var(--aavr-coral);
  font-size: 13px;
  font-weight: 800;
}
.aavr-hero-objections .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aavr-hero-objections .nero-ai-task span {
  color: var(--aavr-muted);
  font-size: 11px;
}
.aavr-hero-objections .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(74,222,128,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aavr-hero-objections .nero-ai-status--amber {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .aavr-hero-objections .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aavr-hero-objections .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aavr-hero-objections .nero-ai-metrics-grid { grid-template-columns: 1fr; }
  .aavr-hero-objections .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aavr-hero-objections .nero-ai-window-body { padding: 12px; }
  .aavr-hero-objections .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aavr-hero-objections .nero-ai-status { grid-column: 2; width: fit-content; }
}
/* Boris */
/* === БОРИС: prefix bav-, scoped внутри #ai-analiz-vozrazheniy-boris-block === */
#ai-analiz-vozrazheniy-boris-block.bav-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-analiz-vozrazheniy-boris-block .bav-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-analiz-vozrazheniy-boris-block .bav-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:520px;
}
@media(max-width:1023px){
  #ai-analiz-vozrazheniy-boris-block .bav-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-analiz-vozrazheniy-boris-block .bav-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-analiz-vozrazheniy-boris-block .bav-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-analiz-vozrazheniy-boris-block .bav-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#6366f1;
  margin:0 0 14px;
}
#ai-analiz-vozrazheniy-boris-block .bav-ey::before{
  content:'';
  width:18px;height:2px;
  background:#6366f1;
  border-radius:1px;
}
#ai-analiz-vozrazheniy-boris-block .bav-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-analiz-vozrazheniy-boris-block .bav-ul{
  list-style:none;
  margin:0 0 20px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-analiz-vozrazheniy-boris-block .bav-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-analiz-vozrazheniy-boris-block .bav-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(99,102,241,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#4f46e5;
  margin-top:1px;
  font-style:normal;
}
#ai-analiz-vozrazheniy-boris-block .bav-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:20px;
}
#ai-analiz-vozrazheniy-boris-block .bav-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-analiz-vozrazheniy-boris-block .bav-pl-v{
  background:rgba(99,102,241,.08);
  color:#4338ca;
  border:1.5px solid rgba(99,102,241,.22);
}
#ai-analiz-vozrazheniy-boris-block .bav-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-analiz-vozrazheniy-boris-block .bav-pl-a{
  background:rgba(245,158,11,.08);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.22);
}
#ai-analiz-vozrazheniy-boris-block .bav-cta{
  margin:0 0 14px;
}
#ai-analiz-vozrazheniy-boris-block .bav-cta .nero-ai-btn-primary{
  font-size:14px;
  padding:12px 22px;
}
#ai-analiz-vozrazheniy-boris-block .bav-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-analiz-vozrazheniy-boris-block .bav-rgt{
  position:relative;
  background:linear-gradient(135deg,#f0f9ff 0%,#eef2ff 40%,#faf5ff 100%);
  min-height:460px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-analiz-vozrazheniy-boris-block .bav-rgt{min-height:380px;}
}
#bav-objection-map-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-analiz-vozrazheniy-page" role="main" tabindex="-1">

<section class="nero-ai-hero aavr-hero-objections" id="aavr-hero-objections" aria-labelledby="aavr-hero-title">


  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Продажи / аналитика · 2026</p>
      <h1 id="aavr-hero-title">AI-анализ возражений клиентов: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Собственник не знает, почему клиенты не покупают — AI собирает возражения из звонков и переписок и даёт рекомендации для оффера и скриптов продаж</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Карта возражений</li>
        <li class="nero-ai-badge">Звонки + CRM</li>
        <li class="nero-ai-badge">Под ключ</li>
      </ul>
      <div class="aavr-phase-row" aria-label="Этапы внедрения">
        <span class="aavr-phase"><strong>1</strong> Подключение каналов</span>
        <span class="aavr-phase"><strong>2</strong> STT + LLM</span>
        <span class="aavr-phase"><strong>3</strong> Карта возражений</span>
        <span class="aavr-phase"><strong>4</strong> Патч скрипта</span>
      </div>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Найти причины отказов'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#demo-otchet">Получить карту возражений</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация карты возражений AI">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Карта возражений</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Цена</span><strong>34%</strong></div>
            <div class="nero-ai-metric"><span>Подумаю</span><strong>22%</strong></div>
            <div class="nero-ai-metric"><span>Конкурент</span><strong>18%</strong></div>
          </div>

          <div class="aavr-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aavr-objection-radar-canvas" role="img" aria-label="Анимация: диалоги по дугам попадают на радар возражений, формируют карту и рекомендацию для скрипта продаж"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий анализа">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">☎</span>
              <div><strong>Звонок → STT → LLM → тег в CRM</strong><span>возражение «дорого» · confidence 0.91</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">WA</span>
              <div><strong>WhatsApp: скрытое возражение по срокам</strong><span>класс: отложенное решение</span></div>
              <span class="nero-ai-status nero-ai-status--amber">новое</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↗</span>
              <div><strong>Рекомендация: усилить блок ценности в скрипте</strong><span>патч для менеджеров · v3</span></div>
              <span class="nero-ai-status">отправлено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <section class="aavr-intro nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="nero-ai-container">
      <div class="aavr-intro-grid nero-ai-reveal">
        <div class="aavr-intro-text">
<p class="aavr-lead"><strong>Коротко:</strong> Nero Network внедряет AI-агента, который автоматически разбирает звонки и переписки, собирает карту возражений и показывает собственнику, почему клиенты не покупают — без ручного прослушивания сотен диалогов. На старте вы получаете лид-магнит «Карта возражений по вашим диалогам» и CTA «Найти причины отказов».</p>
<p>Собственник видит в CRM статусы сделок, но не слышит, что клиент говорит между строк. РОП физически не успевает прослушать больше 5–10% звонков. Переписки в WhatsApp и Telegram живут отдельно от воронки. В итоге отдел продаж отчитывается «клиент подумает», а бизнес не знает реальных причин отказа — и не может поправить оффер, скрипт или цену.</p>
<p>AI-анализ возражений закрывает эту слепую зону: аналитический слой над уже существующими коммуникациями, а не чат-бот для клиентов. Система собирает диалоги, извлекает возражения по смыслу, агрегирует их в карту и даёт рекомендации для оффера, скриптов и обучения менеджеров.</p>
        </div>
        <div class="aavr-intro-terminal" aria-label="Пайплайн AI-анализа возражений">
          <div class="aavr-term-top"><span></span><span></span><span></span><em>objection-map · live</em></div>
          <div class="aavr-term-body">
            <div class="aavr-term-line"><code>channel</code> звонок + WhatsApp + CRM</div>
            <div class="aavr-term-line"><code>stt</code> Yandex SpeechKit → текст</div>
            <div class="aavr-term-line"><code>llm</code> извлечь возражение по смыслу</div>
            <div class="aavr-term-line aavr-term-ok"><code>out</code> карта возражений → РОП</div>
          </div>
          <div class="aavr-intro-kpi">
            <div class="aavr-kpi-card"><span class="kv">100%</span><span class="kl">диалогов под аналитикой</span></div>
            <div class="aavr-kpi-card"><span class="kv">7–14</span><span class="kl">дней до первой карты</span></div>
            <div class="aavr-kpi-card"><span class="kv">34%</span><span class="kl">типичная доля «цена»</span></div>
            <div class="aavr-kpi-card"><span class="kv">0</span><span class="kl">программистов у клиента</span></div>
          </div>
        </div>
      </div>
      <nav class="aavr-toc-outer" aria-label="Оглавление">
        <div class="aavr-toc ym-toc nero-ai-reveal">
          <a href="#bole">Боль собственника</a><a href="#chto-takoe">Что такое AI-анализ</a><a href="#kak-rabotaet">Как работает</a><a href="#integracii">Источники данных</a><a href="#vozrazheniya">Возражения и оффер</a><a href="#demo-otchet">Демо-отчёт</a><a href="#dlya-kogo">Для кого</a><a href="#roi">ROI 2026</a><a href="#cena">Стоимость</a><a href="#keisy">Кейсы</a><a href="#faq">FAQ</a>
        </div>
      </nav>
    </div>
  </section>
<!-- INTERNAL-LINKS:INSERT -->

  <section class="nero-ai-section aavr-section" id="bole">
    <div class="nero-ai-container">
      <div class="nero-ai-section-head nero-ai-left nero-ai-reveal">
        <h2>Почему собственник не знает, почему клиенты не покупают</h2>
      </div>
      <div class="aavr-prose nero-ai-reveal nero-ai-delay-1">
<p class="aavr-lead"><strong>Определение:</strong> причины отказа клиентов — это не только явное «нет», но и скрытые возражения в звонках и переписках, которые редко попадают в CRM в структурированном виде.</p>
<p>Отдел продаж работает, лиды есть, встречи назначаются — а конверсия в сделку не растёт. Собственник спрашивает РОПа: «Почему не покупают?» Ответы звучат одинаково: «дорого», «не сейчас», «надо подумать». Это не аналитика, а интерпретация менеджера после десятка случайно выбранных разговоров.</p>
<h3 class="aavr-h3">Скрытые возражения в звонках и переписках, которые не попадают в CRM</h3>
<p>CRM фиксирует этап воронки и итоговый статус. Она не хранит формулировки клиента, эмоциональный тон, контекст сравнения с конкурентом, скрытый негатив за вежливым «подумаю». Когда менеджер уходит, его заметки уходят вместе с ним.</p>
<p>Кейс застройщика «Брусника» с платформой Imot.io показал типичную картину: тимлиды тратили часы на выборочную прослушку тысяч звонков, а инсайты не попадали в CRM. LLM-анализ вместо словарного поиска позволил фиксировать скрытые возражения — когда «подумаю» на самом деле означает отказ, а не отложенный интерес. Источник: <a href="https://www.sostav.ru/publication/kak-developer-brusnika-sekonomil-70-vremeni-timlidov-i-perestal-teryat-insajty-v-tysyachakh-zvonkov-81795.html" target="_blank" rel="noopener noreferrer">Sostav, кейс «Брусника»</a>.</p>
<p>В мессенджерах ситуация хуже: переписка размазана по чатам, не привязана к сделке, не видна собственнику. AI-анализ возражений объединяет звонки, WhatsApp, Telegram, email и чаты на сайте в единую картину — именно здесь Nero Network отстраивается от конкурентов, которые продают отдельно Voice AI и Chat AI.</p>
<h3 class="aavr-h3">Сколько стоит ручное прослушивание сотен диалогов для РОПа</h3>
<p>При ручном контроле качества прослушивается 1–10% диалогов. Остальные 90%+ — слепая зона. РОП тратит часы на выборочную прослушку, а собственник получает субъективные выводы, а не статистику.</p>
<p>ГК «А101» столкнулась с масштабированием: штат контакт-центра вырос в четыре раза, ручной контроль перестал работать. Решение — автоматическая оценка 100% диалогов с AI-аналитикой причин отказов от записи на встречу. Источник: <a href="https://3itech.ru/cases/tpost/02x0ra6h81-ai-analitika-dlya-zastroischika-a101-poc" target="_blank" rel="noopener noreferrer">3iTech, кейс «А101»</a>.</p>
<p>По данным Salesforce State of Sales 2026, 46% представителей поколения Z редко получают обратную связь по sales conversations — боль, которую закрывает системная аналитика диалогов, а не разовая прослушка тимлидом. Источник: <a href="https://www.salesforce.com/news/stories/state-of-sales-report-announcement-2026/" target="_blank" rel="noopener noreferrer">Salesforce, State of Sales 2026</a>.</p>
<p class="aavr-lead"><strong>Итог:</strong> собственник не знает, почему клиенты не покупают, потому что данные о возражениях разрознены, неполны и не агрегированы. AI-анализ возражений превращает хаос диалогов в управляемую аналитику.</p>
      </div>
    </div>
  </section>

  <section class="nero-ai-section aavr-section" id="chto-takoe">
    <div class="nero-ai-container">
      <div class="nero-ai-section-head nero-ai-left nero-ai-reveal">
        <h2>Что такое AI-анализ возражений клиентов</h2>
      </div>
      <div class="aavr-prose nero-ai-reveal nero-ai-delay-1">
<p class="aavr-lead"><strong>Определение:</strong> AI-анализ возражений — это внедрение аналитического AI-агента, который транскрибирует речь и анализирует текст переписок, извлекает возражения и причины отказа по смыслу, а не по ключевым словам, и формирует карту возражений с рекомендациями для бизнеса.</p>
<p>Это не транскрибация ради протокола и не чат-бот для входящих заявок. Это post-call и post-chat аналитика: система работает после завершения диалога, разбирает его контекст и отдаёт результат РОПу и собственнику.</p>
<p>Типовой стек: телефония (Mango, UIS, Sipuni) → запись → STT (Yandex SpeechKit, Whisper) → LLM-анализ → CRM (amoCRM, Битрикс24) → дашборд «Карта возражений».</p>
<h3 class="aavr-h3">Как AI-агент разбирает диалоги продаж без ручной разметки</h3>
<p>Пайплайн Nero Network работает в шесть шагов:</p>
<ol class="aavr-olist"><li><strong>Сбор</strong> — webhook от телефонии при завершении звонка, API мессенджера или выгрузка из CRM.</li><li><strong>Транскрипция</strong> — Yandex SpeechKit или Whisper; стерео-каналы «менеджер / клиент».</li><li><strong>Извлечение сущностей</strong> — LLM по промптам: возражение, категория, цитата, отработано/нет, следующий шаг, эмоциональный тон.</li><li><strong>Агрегация</strong> — кластеризация формулировок («дорого», «нет бюджета», «кусается цена» → категория «ценовое»).</li><li><strong>Выход</strong> — дашборд, запись в CRM, рекомендации для скрипта и оффера.</li><li><strong>Human-in-the-loop</strong> — РОП валидирует 5–10% разметки первые две недели, корректирует таксономию под нишу.</li></ol>
<p>Команда DS Авито Недвижимость построила LLM-модель для автоматического поиска возражений в звонках кол-центра (до ~30 000 звонков в день) с гибридным пайплайном: авторазметка LLM → экспертная проверка → дообучение правил. Источник: <a href="https://habr.com/ru/companies/avito/articles/1020006/" target="_blank" rel="noopener noreferrer">Habr, Авито</a>. Аргумент для бизнеса: нейросеть понимает контекст, а не ищет слова в словаре.</p>
<p>ОТП Банк использует двухуровневую схему: ML на массовых задачах, LLM — где нужен смысл, эмоции и нюансы переговоров. Источник: <a href="https://www.vedomosti.ru/press_releases/2026/03/16/otp-bank-rechevaya-analitika-na-baze-ml-i-llm-pomogaet-luchshe-ponyat-klientov" target="_blank" rel="noopener noreferrer">Ведомости, ОТП Банк</a>.</p>
<h3 class="aavr-h3">Карта возражений: частые отказы, формулировки клиентов, динамика по менеджерам</h3>
<p class="aavr-lead"><strong>Карта возражений</strong> — центральный артефакт услуги. Это не таблица в Excel, а структурированный отчёт:</p>
<ul class="aavr-list"><li>топ возражений с частотой встречаемости;</li><li>динамика по неделям и этапам воронки;</li><li>разбивка по менеджерам, каналам, продуктам;</li><li>качество отработки (чек-лист / LAARC);</li><li>обезличенные цитаты из реальных диалогов;</li><li>приоритеты для правок оффера и скриптов.</li></ul>
<p>Лид-магнит Nero Network — <strong>«Карта возражений по вашим диалогам»</strong>: на пилоте система разбирает 20–30 исторических диалогов и показывает, как выглядит отчёт до полного внедрения.</p>
      </div>
    </div>
  </section>

<section id="ai-analiz-vozrazheniy-boris-block" class="bav-root" aria-label="Анимация: диалоги из звонков и мессенджеров превращаются в карту возражений через AI">


<div class="bav-cnt">
  <div class="bav-card">

    <div class="bav-lft">
      <span class="bav-ey">Пайплайн аналитики</span>
      <h3 class="bav-h3">Звонок, WhatsApp или CRM — AI собирает скрытые возражения в одну карту</h3>
      <ul class="bav-ul">
        <li><span class="bav-ic">☎</span>Телефония и мессенджеры отдают диалоги без ручной выгрузки</li>
        <li><span class="bav-ic">◎</span>STT и LLM извлекают возражение по смыслу, а не по словарю</li>
        <li><span class="bav-ic">▤</span>Кластеры «цена», «подумаю», «конкурент» — с частотой и цитатами</li>
        <li><span class="bav-ic">→</span>Рекомендации для оффера и скриптов уходят РОПу и собственнику</li>
      </ul>
      <div class="bav-pills">
        <span class="bav-pl bav-pl-v">100% диалогов</span>
        <span class="bav-pl bav-pl-g">STT → LLM → CRM</span>
        <span class="bav-pl bav-pl-a">human-in-the-loop</span>
      </div>
      <p class="bav-cta">
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Найти причины отказов</a>
      </p>
      <p class="bav-foot">Дальше — этапы внедрения AI-анализа возражений под ключ →</p>
    </div>

    <div class="bav-rgt">
      <canvas
        id="bav-objection-map-canvas"
        aria-label="Анимация: диалоги из звонков и мессенджеров проходят STT и LLM и формируют карту возражений с долями по категориям"
        role="img"
      ></canvas>
    </div>

  </div>
</div>


</section>

  <section class="nero-ai-section aavr-section" id="kak-rabotaet">
    <div class="nero-ai-container">
      <div class="nero-ai-section-head nero-ai-left nero-ai-reveal">
        <h2>Как работает внедрение AI-анализ возражений под ключ</h2>
      </div>
      <div class="aavr-prose nero-ai-reveal nero-ai-delay-1">
<p class="aavr-lead"><strong>Коротко:</strong> Nero Network берёт на себя аудит, подключение источников, настройку AI-агента, интеграцию с CRM и выдачу первой карты возражений — без необходимости нанимать программистов и собирать стек самостоятельно.</p>
<p>Публичных кейсов именно с формулировкой «AI-анализ возражений под ключ» как отдельного продукта мало — рынок чаще продаёт речевую аналитику или Revenue Intelligence, где анализ возражений — модуль. Nero Network упаковывает услугу под вопрос собственника: «почему не покупают» — с фиксированным проектом и измеримым артефактом.</p>
<h3 class="aavr-h3">Этапы: аудит диалогов → подключение источников → настройка AI → отчёт и рекомендации</h3>
<div class="aavr-table-wrap"><table class="aavr-table">
<thead><tr><th>Этап</th><th>Срок</th><th>Что происходит</th></tr></thead><tbody>
<tr><td><strong>0. Аудит</strong></td><td>1–2 дня</td><td>Карта каналов (звонки, мессенджеры, email, чаты); объём диалогов; CRM-поля; текущие скрипты; доля «потерянных» причин отказа</td></tr>
<tr><td><strong>1. Пилот на одном канале</strong></td><td>2–3 недели</td><td>Подключение телефонии или одного мессенджера; STT; LLM-разбор 50–200 исторических диалогов; согласование таксономии с РОПом</td></tr>
<tr><td><strong>2. Карта возражений v1</strong></td><td>в рамках пилота</td><td>Дашборд / PDF «Карта возражений по вашим диалогам»; топ-5 возражений, % встречаемости, качество отработки, цитаты</td></tr>
<tr><td><strong>3. Интеграция в CRM</strong></td><td>1–2 недели</td><td>Автотеги в amoCRM/Битрикс24, поле «причина отказа», задачи РОПу при системном провале</td></tr>
<tr><td><strong>4. Рекомендации для оффера</strong></td><td>ежемесячно</td><td>Отчёт для собственника: что менять в УТП, лендинге, скрипте — не только «тренировать менеджеров»</td></tr>
</tbody></table></div>
<p>По данным интегратора Itgrix, полный цикл «конец звонка → данные в CRM» занимает 30–90 секунд при облачном STT; окупаемость пайплайна — 4–8 недель. Источник: <a href="https://itgrix.com/ru/blog/ai-transkriptsiya-i-analiz-zvonkov-v-bitriks24-i-amocrm/" target="_blank" rel="noopener noreferrer">Itgrix, блог 2026</a>.</p>
<h3 class="aavr-h3">AI-анализ возражений без программиста: что делает команда Nero Network</h3>
<p>Клиенту не нужен IT-отдел. Nero Network:</p>
<ul class="aavr-list"><li>подключает коннекторы телефонии и мессенджеров (Mango, UIS, Sipuni, Wazzup, Chat2Desk);</li><li>настраивает STT-пайплайн и LLM-анализатор;</li><li>строит автоматизацию на Make.com, n8n или Itgrix;</li><li>синхронизирует теги и поля с amoCRM / Битрикс24;</li><li>оформляет compliance по 152-ФЗ: информатор, согласие, договор поручения, российский контур.</li></ul>
<p>Что остаётся за клиентом: утверждение таксономии возражений, решения по ценообразованию, разбор спорных диалогов, финальное одобрение рекомендаций (критично для медицины и юриспруденции).</p>
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите понять логику AI-аналитики до старта проекта?</p>
    <p class="ym-cta-block__sub">Если команде важно разобраться в промптах, human-in-the-loop и интеграции CRM до пилота — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>. Это ускоряет согласование таксономии возражений с РОПом.</p>
  </div>
</aside>
<h3 class="aavr-h3">Сроки и зона ответственности при внедрении под ключ</h3>
<p>Ориентир: первая карта возражений — через <strong>7–14 дней</strong> после старта пилота при наличии 30–50 записей звонков или экспорта переписок. Полное внедрение с интеграцией 1–2 каналов и месяцем сопровождения укладывается в проект <strong>180–500 тыс. ₽</strong> (см. блок о цене ниже).</p>
<p>Зона ответственности Nero Network: техническая реализация, настройка AI, интеграции, отчёты. Зона клиента: доступ к записям и перепискам с соблюдением согласий, обратная связь РОПа по таксономии, внедрение рекомендаций в продажи и маркетинг.</p>
      </div>
    </div>
  </section>

<!-- INTERNAL-LINKS:INSERT -->
  <section class="nero-ai-section aavr-section nero-ai-section-alt" id="integracii">
    <div class="nero-ai-container">
      <div class="nero-ai-section-head nero-ai-left nero-ai-reveal">
        <h2>Откуда AI берёт данные: звонки, CRM и мессенджеры</h2>
      </div>
      <div class="aavr-prose nero-ai-reveal nero-ai-delay-1">
<p class="aavr-lead"><strong>Определение:</strong> источники данных для AI-анализа возражений — любые каналы, где происходит диалог «менеджер — клиент»: телефония, CRM-переписки, мессенджеры, email, чаты на сайте.</p>
<h3 class="aavr-h3">Телефония (Mango, UIS, Sipuni) и записи разговоров</h3>
<p>Телефония — основной канал для B2B, недвижимости, медицины и услуг. Nero Network подключает webhook при завершении звонка: запись → STT → LLM-анализ → результат в CRM и дашборд.</p>
<p>Поддерживаемые АТС: Mango Office, UIS, Sipuni, Билайн АТС. Стереозапись позволяет разделять реплики менеджера и клиента — критично для оценки качества отработки возражений.</p>
<p class="aavr-lead"><strong>Важно по 152-ФЗ:</strong> запись разговора — персональные данные; голос может считаться биометрией. Для AI-аналитики, обучения и маркетинга чаще требуется согласие, не только автоинформатор. Источник: <a href="https://ic-tech.ru/blog/faq/questions-152fz/nuzhno-li-soglasie-na-zapis-telefonnyh-razgovorov-klientov/" target="_blank" rel="noopener noreferrer">IC Tech, FAQ 152-ФЗ</a>.</p>
<h3 class="aavr-h3">amoCRM и Битрикс24: переписки и сделки как контекст возражений</h3>
<p>CRM — не только хранилище статусов, но и контекст для анализа: этап воронки, сумма сделки, источник лида, история касаний. AI привязывает возражение к конкретной сделке и показывает, на каком этапе чаще всего «сыпется» конверсия.</p>
<p>Интеграция: автотеги возражений, поле «причина отказа», задачи РОПу при повторяющихся провалах. Для клиентов с ERP-контекстом в B2B логично связать аналитику с данными из 1С — как дополнительный слой, не заменяя CRM.</p>
<p>Конкуренты вроде SalesAI, Rechka и Dialext продают интеграцию с amoCRM и Битрикс24 как SaaS-подписку. Nero Network отстраивается: <strong>внедрение под ключ</strong> с кастомной таксономией возражений под нишу, а не универсальный чек-лист из коробки.</p>
<h3 class="aavr-h3">WhatsApp и Telegram: анализ переписок в связке с воронкой продаж</h3>
<p>В 2026 году значительная доля продаж проходит через мессенджеры. Отдельные виджеты Voice AI для amoCRM анализируют звонки; Chat AI — чаты. Nero Network объединяет оба потока в <strong>одной карте возражений</strong>.</p>
<p>Подключение: WhatsApp Business API, Telegram-бот, интеграторы Wazzup, Chat2Desk, PinALL. Переписки проходят тот же LLM-пайплайн, что и звонки — с единой таксономией и дашбордом для собственника.</p>
<p>Требования 152-ФЗ к перепискам те же: согласие на обработку в политике или при первом контакте, локализация данных на серверах в РФ (с 1 июля 2025 ужесточены требования к хранению ПДн граждан РФ). Источник: <a href="https://b-152.ru/zakon-o-personalnyh-dannyh-2025" target="_blank" rel="noopener noreferrer">b-152.ru, изменения 2025</a>.</p>
      </div>
    </div>
  </section>

  <section class="nero-ai-section aavr-section" id="vozrazheniya">
    <div class="nero-ai-container">
      <div class="nero-ai-section-head nero-ai-left nero-ai-reveal">
        <h2>Какие возражения выявляет AI и как это меняет оффер</h2>
      </div>
      <div class="aavr-prose nero-ai-reveal nero-ai-delay-1">
<p class="aavr-lead"><strong>Коротко:</strong> AI классифицирует возражения по таксономии, показывает частотность и качество отработки — и даёт рекомендации не только для скриптов, но и для УТП, лендинга и ценовой логики.</p>
<h3 class="aavr-h3">Типовые категории: цена, сроки, доверие, конкурент, «подумаю»</h3>
<p>По отраслевым гайдам B2B (не независимые исследования РФ, а структурированные фреймворки):</p>
<div class="aavr-table-wrap"><table class="aavr-table">
<thead><tr><th>Категория</th><th>Примеры формулировок</th><th>Что часто стоит за словами</th></tr></thead><tbody>
<tr><td><strong>Цена / бюджет</strong></td><td>«дорого», «нет бюджета»</td><td>недостаточно воспринятой ценности</td></tr>
<tr><td><strong>Сроки</strong></td><td>«не сейчас», «в следующем квартале»</td><td>низкий приоритет или вежливый отказ</td></tr>
<tr><td><strong>Доверие</strong></td><td>«не слышал о вас», «надо подумать»</td><td>риск, недоверие к продукту/компании</td></tr>
<tr><td><strong>Полномочия</strong></td><td>«надо согласовать»</td><td>сложная закупка, нет ЛПР на линии</td></tr>
<tr><td><strong>Конкурент / статус-кво</strong></td><td>«уже работаем с…», «нас всё устраивает»</td><td>сравнение или страх смены</td></tr>
<tr><td><strong>Потребность / fit</strong></td><td>«нам это не нужно»</td><td>неверно выявлена боль</td></tr>
</tbody></table></div>
<p>Источники категорий: <a href="https://prospeo.io/s/types-of-sales-objections" target="_blank" rel="noopener noreferrer">Prospeo</a>, <a href="https://resources.rework.com/libraries/deal-closing/objection-handling-framework" target="_blank" rel="noopener noreferrer">Rework</a>.</p>
<p>В кейсе ГК «А101» AI-аналитика выделила причины отказов от встречи: «занятость», «думает», «семейные обстоятельства», «финансовые причины» — с отчётностью по чек-листу отработки возражений на 100% диалогов. Источник: <a href="https://3itech.ru/cases/tpost/02x0ra6h81-ai-analitika-dlya-zastroischika-a101-poc" target="_blank" rel="noopener noreferrer">3iTech, «А101»</a>.</p>
<p>Nero Network настраивает таксономию под нишу: для недвижимости — ипотека и сроки сдачи; для медицины — доверие и страх процедуры; для обучения — ROI курса и конкуренты.</p>
<h3 class="aavr-h3">Рекомендации для оффера, УТП и скриптов отработки возражений</h3>
<p>AI не просто считает «дорого» — он показывает, <strong>как</strong> клиенты формулируют ценовое возражение, отрабатывает ли менеджер по LAARC, и какие аргументы не срабатывают. На основе этого Nero Network формирует рекомендации:</p>
<ul class="aavr-list"><li>правки в скрипте продаж (конкретные блоки отработки);</li><li>изменения в УТП и лендинге (если 40% отказов — «не понял ценность»);</li><li>точечное обучение менеджеров по реальным провалам, а не по абстрактным тренингам;</li><li>задачи в CRM для РОПа при системном провале одной категории.</li></ul>
<p>Международный фреймворк Gangly описывает цикл Detect → Classify → Surface framework → Log to CRM — структура «карта возражений → рекомендация → запись в CRM → следующий звонок с контекстом». Источник: <a href="https://getgangly.com/blog/ai-objection-handling" target="_blank" rel="noopener noreferrer">Gangly Blog</a>. Nero Network адаптирует этот цикл под российскую телефонию, CRM и 152-ФЗ.</p>
      </div>
    </div>
  </section>

  <section class="nero-ai-section aavr-section" id="demo-otchet">
    <div class="nero-ai-container">
      <div class="nero-ai-section-head nero-ai-left nero-ai-reveal">
        <h2>Пример отчёта: карта возражений по вашим диалогам</h2>
      </div>
      <div class="aavr-prose nero-ai-reveal nero-ai-delay-1">
<p class="aavr-lead"><strong>Определение:</strong> карта возражений — визуальный и табличный отчёт, который показывает топ причин отказа, динамику, цитаты и приоритеты для правок оффера.</p>
<h3 class="aavr-h3">Демо-блок: топ возражений, цитаты из диалогов, приоритеты для правок</h3>
<p>Структура отчёта Nero Network (макет, без выдуманных цифр конкретного клиента):</p>
<p class="aavr-lead"><strong>Блок 1. Сводка за период</strong></p>
<ul class="aavr-list"><li>Проанализировано диалогов: N (звонки + переписки)</li><li>Топ-5 категорий возражений с долей от всех отказов</li><li>Тренд: растёт / падает / стабильно по сравнению с прошлым периодом</li></ul>
<p class="aavr-lead"><strong>Блок 2. Детализация по категориям</strong></p>
<div class="aavr-table-wrap"><table class="aavr-table">
<thead><tr><th>Категория</th><th>Доля</th><th>Качество отработки</th><th>Рекомендация</th></tr></thead><tbody>
<tr><td>Цена</td><td>—</td><td>—</td><td>Усилить блок ценности в скрипте</td></tr>
<tr><td>Сроки</td><td>—</td><td>—</td><td>Добавить кейс с быстрым стартом</td></tr>
<tr><td>Доверие</td><td>—</td><td>—</td><td>Вынести отзывы на этап презентации</td></tr>
<tr><td>Конкурент</td><td>—</td><td>—</td><td>Подготовить battlecard</td></tr>
<tr><td>«Подумаю»</td><td>—</td><td>—</td><td>Уточняющие вопросы в скрипте</td></tr>
</tbody></table></div>
<p class="aavr-lead"><strong>Блок 3. Цитаты (обезличенно)</strong></p>
<ul class="aavr-list"><li>Примеры реальных формулировок клиентов</li><li>Примеры удачной и неудачной отработки менеджером</li></ul>
<p class="aavr-lead"><strong>Блок 4. Разбивка по менеджерам и каналам</strong></p>
<ul class="aavr-list"><li>Где провалы системные, а где точечные</li><li>Звонки vs WhatsApp vs Telegram</li></ul>
<p class="aavr-lead"><strong>Блок 5. Приоритеты для собственника</strong></p>
<ul class="aavr-list"><li>Что менять в оффере (не только в тренингах)</li><li>Следующие шаги: скрипт, лендинг, ценовая логика</li></ul>
<h3 class="aavr-h3">CTA: «Найти причины отказов» — что получает клиент на старте</h3>
<p>Кнопка <strong>«Найти причины отказов»</strong> запускает первичный аудит:</p>
<ol class="aavr-olist"><li>Короткий бриф: ниша, каналы, CRM, объём диалогов.</li><li>Передача 20–30 записей или экспорта переписок (с соблюдением согласий).</li><li>Пилотный разбор и <strong>лид-магнит «Карта возражений по вашим диалогам»</strong> — демонстрация формата до полного проекта.</li><li>Коммерческое предложение на внедрение под ключ с фиксированным чеком.</li></ol>
<p>Это отстройка от SaaS-конкурентов (Rechka, Dialext, SalesAI), которые продают подписку от объёма минут без кастомной таксономии и без связки возражений с изменением оффера.</p>
<aside class="ym-cta-block ym-cta-block--primary" id="cta-karta">
  <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Найти причины отказов по вашим диалогам</p>
    <p class="ym-cta-block__sub">Передадите 20–30 записей звонков или экспорт переписок — соберём пилотную «Карту возражений по вашим диалогам» и покажем формат отчёта до полного внедрения. Без обязательств.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Найти причины отказов'); ?></a>
  </div>
</aside>
      </div>
    </div>
  </section>

  <section class="nero-ai-section aavr-section" id="dlya-kogo">
    <div class="nero-ai-container">
      <div class="nero-ai-section-head nero-ai-left nero-ai-reveal">
        <h2>Для кого услуга: B2B, недвижимость, медицина, обучение, услуги</h2>
      </div>
      <div class="aavr-prose nero-ai-reveal nero-ai-delay-1">
<p class="aavr-lead"><strong>Коротко:</strong> AI-анализ возражений даёт быстрый ROI там, где много диалогов, длинный цикл сделки и собственник не видит реальных причин отказа.</p>
<h3 class="aavr-h3">Где аналитика возражений даёт быстрый ROI</h3>
<p class="aavr-lead"><strong>Недвижимость.</strong> Застройщики и агентства: тысячи звонков, отказы от встреч и броней, скрытые возражения по ипотеке и срокам. Кейсы: «А101» (100% диалогов, причины отказов от встречи), «Брусника» (экономия 70% времени тимлидов). «Наша компания изначально осознавала ценность речевой аналитики… Главная цель — рост продаж» — Анна Макарова, ГК «А101». Источник: <a href="https://companies.rbc.ru/news/kaWvOfKY4B/kak-ii-menyaet-rabotu-developerov-opyit-vnedreniya-rechevoj-analitiki/" target="_blank" rel="noopener noreferrer">RBC Companies</a>.</p>
<p class="aavr-lead"><strong>B2B-услуги.</strong> Длинный цикл, несколько ЛПР, возражения по полномочиям и конкуренту. AI показывает, на каком этапе воронки «отваливаются» сделки и какие формулировки повторяются.</p>
<p class="aavr-lead"><strong>Обучение и EdTech.</strong> Возражения по цене курса, ROI обучения, сравнение с конкурентами. Карта возражений помогает поправить лендинг и скрипт продажника, а не только контент курса.</p>
<p class="aavr-lead"><strong>Медицина и клиники.</strong> Доверие, страх процедуры, «подумаю» как вежливый отказ. Критичен блок 152-ФЗ: российский контур, согласие, регламент хранения записей.</p>
<p class="aavr-lead"><strong>Финансы и страхование.</strong> ОТП Банк: конверсия в продажи +3,3%, FCR +1,7% (кейс банка, не гарантия для любого бизнеса). Росгосстрах: 100% входящих, реакция на возражения, ~7% сокращение времени диалога. Источники: <a href="https://www.vedomosti.ru/press_releases/2026/03/16/otp-bank-rechevaya-analitika-na-baze-ml-i-llm-pomogaet-luchshe-ponyat-klientov" target="_blank" rel="noopener noreferrer">Ведомости</a>, <a href="https://www.cnews.ru/news/line/2026-06-22_ii_pomogaet_rosgosstrahu" target="_blank" rel="noopener noreferrer">CNews</a>.</p>
<p class="aavr-lead"><strong>Ритейл B2B.</strong> СТД «Петрович» + «Обит»: 20 000 звонков, трёхуровневая классификация, точность ~89%, пилот за недели. Источник: <a href="https://corp.cnews.ru/news/line/2026-03-05_obit_pomogaet_avtomatizirovat" target="_blank" rel="noopener noreferrer">CNews, «Петрович»</a>.</p>
<h3 class="aavr-h3">AI-анализ возражений для малого бизнеса: когда имеет смысл</h3>
<p>Минимум для первой карты — <strong>30–50 диалогов</strong>. Если у вас 10 звонков в месяц, ROI аналитики будет низким. Если 100+ звонков и переписок — ручной контроль не масштабируется, а SaaS-подписка на год может стоить сопоставимо с разовым внедрением под ключ.</p>
<p>Для МСБ Nero Network предлагает старт с одного канала (телефония или WhatsApp), пилот за 2–3 недели и фиксированный чек <strong>180–500 тыс. ₽</strong> вместо бессрочной подписки enterprise-SaaS.</p>
      </div>
    </div>
  </section>

  <section class="nero-ai-section aavr-section nero-ai-section-alt" id="roi">
    <div class="nero-ai-container">
      <div class="nero-ai-section-head nero-ai-left nero-ai-reveal">
        <h2>ROI и эффект: agentic AI в продажах в 2026</h2>
      </div>
      <div class="aavr-prose nero-ai-reveal nero-ai-delay-1">
<p class="aavr-lead"><strong>Коротко:</strong> тренд 2026 — AI-агенты освобождают продавцов от рутины и углубляют понимание клиента; post-call аналитика возражений — практическое воплощение этого тренда для собственника.</p>
<h3 class="aavr-h3">Тренд Salesforce State of Sales 2026: меньше ручного разбора, больше данных для решений</h3>
<p>Salesforce фиксирует: AI и AI-агенты — <strong>тактика роста №1</strong> для sales-команд в 2026. Ключевые цифры из официального пресс-релиза (опрос 4 050 sales professionals, август–сентябрь 2025):</p>
<ul class="aavr-list"><li><strong>87%</strong> организаций уже используют AI в продажах.</li><li><strong>54%</strong> продавцов использовали AI-агентов; почти <strong>9 из 10</strong> планируют к 2027.</li><li>Ожидаемая экономия времени: <strong>−34%</strong> на research, <strong>−36%</strong> на черновики email.</li><li><strong>94%</strong> лидеров с агентами считают их критичными для бизнес-задач.</li><li>Топ-команды <strong>в 1,7 раза чаще</strong> используют prospecting AI-агентов.</li><li><strong>89%</strong> говорят, что AI углубляет понимание клиента.</li></ul>
<p>Источник: <a href="https://www.salesforce.com/news/stories/state-of-sales-report-announcement-2026/" target="_blank" rel="noopener noreferrer">Salesforce, State of Sales 2026</a>.</p>
<p class="aavr-lead"><strong>Важно:</strong> отчёт не содержит отдельной метрики «анализ возражений». Его корректно цитировать как тренд agentic AI и освобождение от рутины, а не как прямое исследование objection mapping. Для Nero Network связка такая: AI-агенты убирают busywork → post-call аналитика даёт собственнику данные для решений по офферу.</p>
<p>«We want to kill the busywork so our teams can focus on what actually moves deals forward» — Adam Alfano, EVP of Sales, Salesforce. Источник: тот же пресс-релиз.</p>
<h3 class="aavr-h3">Метрики: конверсия, длина цикла, качество скриптов</h3>
<p>Качественные эффекты внедрения AI-анализа возражений (без гарантированных цифр для каждого клиента):</p>
<ul class="aavr-list"><li><strong>100% диалогов</strong> под аналитикой вместо 1–10% выборочной прослушки.</li><li>Собственник видит <strong>структурированные причины отказов</strong>, а не ощущение «менеджеры слабые».</li><li>Быстрее обновление скриптов и оффера по данным, а не по интуиции.</li><li>Снижение ручного ввода в CRM (автотеги, поле «причина отказа»).</li><li>Точечное обучение менеджеров по реальным провалам.</li></ul>
<p>Осторожное цитирование цифр из российских кейсов (с пометкой «результат конкретного внедрения»):</p>
<ul class="aavr-list"><li>ОТП Банк: конверсия в продажи <strong>+3,3%</strong>, FCR +1,7%, среднее время обработки −5 сек.</li><li>Росгосстрах: ~<strong>7%</strong> сокращение среднего времени диалога, рост FCR.</li><li>«Петрович»: точность классификации ~<strong>89%</strong> на 20 000 звонков.</li></ul>
<p>Рынок РФ сместился от «ключевых слов в звонке» (Keywords 1.0) к контекстному LLM-анализу (Revenue Intelligence 2.0). Крупные компании строят собственные контуры (Авито, Росгосстрах, ОТП); средний бизнес получает тот же класс решений через внедрение под ключ от Nero Network.</p>
      </div>
    </div>
  </section>

  <section class="nero-ai-section aavr-section" id="cena">
    <div class="nero-ai-container">
      <div class="nero-ai-section-head nero-ai-left nero-ai-reveal">
        <h2>Сколько стоит AI-анализ возражений и что входит в проект</h2>
      </div>
      <div class="aavr-prose nero-ai-reveal nero-ai-delay-1">
<p class="aavr-lead"><strong>Коротко:</strong> ориентир чека Nero Network — <strong>180–500 тыс. ₽</strong> за проект с аудитом, пилотом, интеграцией 1–2 каналов и сопровождением.</p>
<h3 class="aavr-h3">Ориентир чека 180–500 тыс. ₽: от чего зависит стоимость</h3>
<div class="aavr-table-wrap"><table class="aavr-table">
<thead><tr><th>Фактор</th><th>Влияние на цену</th></tr></thead><tbody>
<tr><td>Количество каналов (звонки, WhatsApp, Telegram, email)</td><td>+за каждый дополнительный канал</td></tr>
<tr><td>Объём диалогов в месяц</td><td>влияет на STT и LLM-нагрузку</td></tr>
<tr><td>CRM и телефония (готовые коннекторы vs кастом)</td><td>кастом дороже</td></tr>
<tr><td>Требования 152-ФЗ (облако РФ vs on-prem)</td><td>on-prem и закрытый контур — выше</td></tr>
<tr><td>Кастомная таксономия и промпт-цепочки</td><td>уникальная ниша — больше настройки</td></tr>
<tr><td>Сопровождение после запуска</td><td>1 месяц в базе, далее по договору</td></tr>
</tbody></table></div>
<p>Сравнение с альтернативами: годовая подписка enterprise-речевой аналитики + FTE аналитика/QA на ручной разбор часто сопоставимы или дороже, при этом без кастомной карты возражений и связки с оффером.</p>
<h3 class="aavr-h3">Что входит: интеграции, настройка AI-агента, отчёты, сопровождение</h3>
<p class="aavr-lead"><strong>В базовый проект Nero Network входит:</strong></p>
<ul class="aavr-list"><li>Аудит каналов и CRM (1–2 дня).</li><li>Подключение телефонии или одного мессенджера.</li><li>STT-пайплайн (Yandex SpeechKit / Whisper).</li><li>LLM-анализатор с таксономией возражений под нишу.</li><li>Дашборд «Карта возражений» + PDF-отчёт.</li><li>Интеграция с amoCRM или Битрикс24 (автотеги, поле причины отказа).</li><li>Блок compliance: информатор, согласие, договор поручения, российский контур.</li><li>Первый месяц сопровождения: корректировка таксономии, валидация РОПом.</li><li>Лид-магнит на старте: «Карта возражений по вашим диалогам».</li></ul>
<p class="aavr-lead"><strong>Не входит (обсуждается отдельно):</strong> on-prem инфраструктура, доработка лендинга по рекомендациям, тренинги менеджеров, интеграция с 1С/ERP.</p>
      </div>
    </div>
  </section>

  <section class="nero-ai-section aavr-section nero-ai-section-alt" id="keisy">
    <div class="nero-ai-container">
      <div class="nero-ai-section-head nero-ai-left nero-ai-reveal">
        <h2>Кейсы внедрения AI-анализа возражений</h2>
      </div>
      <div class="aavr-prose nero-ai-reveal nero-ai-delay-1">
<p class="aavr-lead"><strong>Коротко:</strong> прямых публичных кейсов с брендом «AI-анализ возражений под ключ» мало; рынок продаёт речевую аналитику, где анализ возражений — модуль. Ниже — проверенные смежные внедрения и шаблон для вашего проекта.</p>
<h3 class="aavr-h3">Структура кейса: боль → решение → интеграции → результат</h3>
<p class="aavr-lead"><strong>Шаблон кейса Nero Network:</strong></p>
<ol class="aavr-olist"><li><strong>Боль:</strong> собственник не знает причины отказов; РОП слушает 5–10% звонков; CRM не отражает реальность.</li><li><strong>Решение:</strong> внедрение AI-агента post-call/post-chat аналитики с картой возражений.</li><li><strong>Интеграции:</strong> телефония + CRM + мессенджеры; STT + LLM; дашборд для РОПа и собственника.</li><li><strong>Результат:</strong> структурированная карта возражений, рекомендации для оффера и скриптов, 100% покрытие диалогов.</li></ol>
<p class="aavr-lead"><strong>Карточки российских референсов:</strong></p>
<div class="aavr-table-wrap"><table class="aavr-table">
<thead><tr><th>Компания</th><th>Отрасль</th><th>Что сделано</th><th>Источник</th></tr></thead><tbody>
<tr><td>ГК «А101»</td><td>Недвижимость</td><td>100% диалогов; причины отказов от встречи; отработка возражений</td><td><a href="https://3itech.ru/cases/tpost/02x0ra6h81-ai-analitika-dlya-zastroischika-a101-poc" target="_blank" rel="noopener noreferrer">3iTech</a></td></tr>
<tr><td>«Брусника»</td><td>Недвижимость</td><td>LLM вместо словаря; скрытые возражения; −70% времени тимлидов</td><td><a href="https://www.sostav.ru/publication/kak-developer-brusnika-sekonomil-70-vremeni-timlidov-i-perestal-teryat-insajty-v-tysyachakh-zvonkov-81795.html" target="_blank" rel="noopener noreferrer">Sostav</a></td></tr>
<tr><td>Авито Недвижимость</td><td>Маркетплейс</td><td>LLM-поиск возражений; ~30 000 звонков/день</td><td><a href="https://habr.com/ru/companies/avito/articles/1020006/" target="_blank" rel="noopener noreferrer">Habr</a></td></tr>
<tr><td>ОТП Банк</td><td>Финансы</td><td>ML + LLM; конверсия +3,3%</td><td><a href="https://www.vedomosti.ru/press_releases/2026/03/16/otp-bank-rechevaya-analitika-na-baze-ml-i-llm-pomogaet-luchshe-ponyat-klientov" target="_blank" rel="noopener noreferrer">Ведомости</a></td></tr>
<tr><td>Росгосстрах</td><td>Страхование</td><td>100% звонков; 100+ промптов; GenAI</td><td><a href="https://www.cnews.ru/news/line/2026-06-22_ii_pomogaet_rosgosstrahu" target="_blank" rel="noopener noreferrer">CNews</a></td></tr>
<tr><td>СТД «Петрович»</td><td>Ритейл B2B</td><td>20 000 звонков; точность ~89%</td><td><a href="https://corp.cnews.ru/news/line/2026-03-05_obit_pomogaet_avtomatizirovat" target="_blank" rel="noopener noreferrer">CNews</a></td></tr>
</tbody></table></div>
<h3 class="aavr-h3">Чем отличаемся от «просто транскрибации звонков»</h3>
<div class="aavr-table-wrap"><table class="aavr-table">
<thead><tr><th>Критерий</th><th>Транскрибация</th><th>AI-анализ возражений Nero Network</th></tr></thead><tbody>
<tr><td>Выход</td><td>Текст разговора</td><td>Категория возражения, качество отработки, рекомендация</td></tr>
<tr><td>Покрытие</td><td>Файл в папке</td><td>100% диалогов в дашборде и CRM</td></tr>
<tr><td>Аналитика</td><td>Нет</td><td>Карта частотности, тренды, разбивка по менеджерам</td></tr>
<tr><td>Действия</td><td>РОП читает вручную</td><td>Автотеги, задачи, рекомендации для оффера</td></tr>
<tr><td>Омниканальность</td><td>Только звонки</td><td>Звонки + WhatsApp + Telegram в одной карте</td></tr>
<tr><td>Внедрение</td><td>Самостоятельно</td><td>Под ключ, без программиста</td></tr>
<tr><td>Compliance</td><td>На клиенте</td><td>152-ФЗ встроен в проект</td></tr>
</tbody></table></div>
<p>Отстройка от SaaS (SalesAI, Rechka, Dialext): не подписка от объёма минут, а <strong>фиксированный проект</strong> с кастомной таксономией и фокусом на собственника, а не только на QA менеджеров.</p>
      </div>
    </div>
  </section>

  <section class="nero-ai-section aavr-section" id="faq">
    <div class="nero-ai-container">
      <div class="nero-ai-section-head nero-ai-left nero-ai-reveal">
        <h2>FAQ по AI-анализу возражений</h2>
      </div>
      <div class="aavr-faq nero-ai-faq nero-ai-reveal nero-ai-delay-1">
<details class="aavr-faq-item"><summary>Как внедрить ai анализ возражений в действующий отдел продаж?</summary><div class="aavr-faq-a"><p>Без остановки продаж. Этап 0 — аудит (1–2 дня): какие каналы, сколько диалогов, что в CRM. Этап 1 — пилот на исторических данных (50–200 диалогов) и одном live-канале. РОП валидирует таксономию. Этап 2 — автоматический разбор новых диалогов и отчёт для собственника. Менеджеры продолжают работать как обычно; меняются скрипты и оффер на основе данных.</p></div></details>
<details class="aavr-faq-item"><summary>Нужны ли программисты и IT-отдел?</summary><div class="aavr-faq-a"><p>Нет. Nero Network реализует <strong>ai анализ возражений без программиста</strong> на стороне клиента: коннекторы телефонии, STT, LLM, автоматизация (Make/n8n/Itgrix), интеграция CRM. От клиента — доступ к записям, обратная связь РОПа, согласия по 152-ФЗ.</p></div></details>
<details class="aavr-faq-item"><summary>Как устроена интеграция с CRM и телефонией?</summary><div class="aavr-faq-a"><p>Схема: завершение звонка → webhook → запись → STT → LLM → теги и поля в amoCRM/Битрикс24 → дашборд. Для мессенджеров — API или интегратор (Wazzup, Chat2Desk). Полный цикл «конец звонка → данные в CRM» — 30–90 секунд при облачном STT (Itgrix, 2026). Поддерживаются Mango, UIS, Sipuni, amoCRM, Битрикс24, RetailCRM.</p></div></details>
<details class="aavr-faq-item"><summary>152-ФЗ и хранение записей звонков при AI-обработке</summary><div class="aavr-faq-a"><p>Чек-лист compliance в каждом проекте Nero Network:</p>
<ol class="aavr-olist"><li><strong>Запись = персональные данные</strong> (голос, содержание разговора). Источник: <a href="https://ic-tech.ru/blog/faq/questions-152fz/yavlyayutsya-li-zapisi-zvonkov-s-klientami-personalnymi-dannymi/" target="_blank" rel="noopener noreferrer">IC Tech</a>.</li><li><strong>Автоинформатор</strong> о записи в начале звонка.</li><li><strong>Согласие</strong> на обработку для AI-аналитики, обучения, маркетинга — отдельно от исполнения договора. Источник: <a href="https://ic-tech.ru/blog/faq/questions-152fz/nuzhno-li-soglasie-na-zapis-telefonnyh-razgovorov-klientov/" target="_blank" rel="noopener noreferrer">IC Tech</a>.</li><li><strong>Локализация:</strong> хранение ПДн граждан РФ на серверах в РФ (ред. с 1 июля 2025). Источник: <a href="https://b-152.ru/zakon-o-personalnyh-dannyh-2025" target="_blank" rel="noopener noreferrer">b-152.ru</a>.</li><li><strong>Договор поручения</strong> на обработку ПДн с облачным провайдером; при зарубежном LLM — уведомление РКН о трансграничной передаче. Источник: <a href="https://airassvet.ru/articles/152fz-zarubezhnye-ii" target="_blank" rel="noopener noreferrer">AI Assvet</a>.</li><li><strong>Практика Nero Network:</strong> российский контур (Yandex Cloud, VK Cloud, on-prem Whisper + локальная LLM), минимизация ПДн в промптах, сроки хранения, журнал доступа.</li></ol></div></details>
<details class="aavr-faq-item"><summary>Можно ли заказать ai анализ возражений для одного филиала или отдела?</summary><div class="aavr-faq-a"><p>Да. Модульная архитектура: старт с одного канала (только звонки или только WhatsApp), одного отдела или филиала. Пилот на 2–3 недели покажет ценность до масштабирования на всю компанию. Минимум данных — 30–50 диалогов для первой карты.</p></div></details>
<p class="aavr-lead"><strong>Заключение.</strong> AI-анализ возражений — это не модный чат-бот, а аналитический слой, который отвечает на главный вопрос собственника: почему клиенты не покупают. Nero Network внедряет решение под ключ: от аудита и пилота до карты возражений, интеграции с CRM и рекомендаций для оффера. На старте — лид-магнит «Карта возражений по вашим диалогам». Следующий шаг — <strong>«Найти причины отказов»</strong>.</p>
      </div>
    </div>
  </section>

  <section class="nero-ai-section aavr-final" id="final-cta">
    <div class="nero-ai-container">
      <div class="nero-ai-final-cta nero-ai-reveal">
        <h2>Узнайте, почему клиенты не покупают — по вашим диалогам</h2>
        <p>На старте соберём пилотную карту возражений из 20–30 звонков или переписок. Дальше — внедрение под ключ: CRM, телефония, рекомендации для оффера и скриптов.</p>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Найти причины отказов'); ?></a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="#demo-otchet">Получить карту возражений</a>
        </div>
      </div>
    </div>
  </section>

<!-- SCHEMA-MARKUP:INSERT -->
</main>

<script>
/**
 * aavr-objection-radar-engine — Диспетчерская «Echo Radar»
 * Мир: радиальный радар возражений, дуги диалогов, рекомендация скрипта.
 */
(function () {
  "use strict";
  var canvas = document.getElementById("aavr-objection-radar-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var p = canvas.parentElement;
    if (!p) return;
    canvas.width = p.clientWidth || 640;
    canvas.height = p.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 520, ch / 240) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#e2e8f0",
    radarBase: "rgba(15,23,42,0.85)",
    segPrice: "#fb7185",
    segThink: "#fbbf24",
    segComp: "#a78bfa",
    segOther: "#64748b",
    dialogPhone: "#67e8f9",
    dialogChat: "#c4b5fd",
    wave: "#4ade80",
    patchGreen: "#22c55e",
    crmBlue: "#38bdf8",
    bubbleBg: "#ffffff",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6"
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

  /* Дуги диалогов — вместо Conveyor */
  function DialogArcCarousel() {
    this.phase = 0;
    this.arcs = [
      { rx: 165, ry: 58, speed: 0.022, offset: 0, kind: "phone" },
      { rx: 145, ry: 72, speed: 0.028, offset: 2.1, kind: "chat" },
      { rx: 125, ry: 86, speed: 0.034, offset: 4.2, kind: "phone" }
    ];
  }
  DialogArcCarousel.prototype.draw = function (ctx) {
    this.phase += 0.018;
    var self = this;
    this.arcs.forEach(function (arc, ai) {
      ctx.strokeStyle = "rgba(103,232,249," + (0.12 + ai * 0.04) + ")";
      ctx.lineWidth = 1;
      ctx.beginPath();
      ctx.ellipse(0, 10, arc.rx, arc.ry, 0, Math.PI * 1.05, Math.PI * 1.95);
      ctx.stroke();

      for (var i = 0; i < 2; i++) {
        var t = (self.phase * arc.speed * 60 + arc.offset + i * 1.7) % (Math.PI * 0.9);
        var ang = Math.PI * 1.05 + t;
        var ex = Math.cos(ang) * arc.rx;
        var ey = 10 + Math.sin(ang) * arc.ry;
        if (arc.kind === "phone") drawPhoneChip(ctx, ex, ey);
        else drawChatChip(ctx, ex, ey);
      }
    });
  };

  function drawPhoneChip(ctx, x, y) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -9, -7, 18, 14, 3, C.dialogPhone, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("☎", 0, 2);
    ctx.restore();
  }

  function drawChatChip(ctx, x, y) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -10, -8, 20, 14, 4, C.dialogChat, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 5px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("WA", 0, 2);
    ctx.restore();
  }

  /* Волна STT — уникальный объект */
  function SttWaveStrip() {
    this.amp = 0;
  }
  SttWaveStrip.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    if (prg > 48) return;
    this.amp = Math.min(1, prg / 48);
    ctx.strokeStyle = "rgba(74,222,128," + (0.35 * this.amp) + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var i = 0; i < 48; i++) {
      var x = -150 + i * 6;
      var y = -78 + Math.sin(i * 0.45 + frame * 0.12) * 10 * this.amp;
      if (i === 0) ctx.moveTo(x, y);
      else ctx.lineTo(x, y);
    }
    ctx.stroke();
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("STT", -150, -92);
  };

  /* Скрытое возражение из чата */
  function HiddenObjectionReveal() {
    this.alpha = 0;
  }
  HiddenObjectionReveal.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    if (prg < 52 || prg > 105) { this.alpha = 0; return; }
    this.alpha = prg < 70 ? (prg - 52) / 18 : 1 - (prg - 90) / 15;
    ctx.globalAlpha = Math.max(0, this.alpha);
    drawRR(ctx, 108, -72, 72, 28, 6, "rgba(251,191,36,0.2)", C.segThink);
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("«подумаю» = сроки", 144, -56);
    ctx.globalAlpha = 1;
  };

  /* Центральный радар — вместо WebsiteTerminal */
  function ObjectionRadarCore() {
    this.pulse = 0;
  }
  ObjectionRadarCore.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    this.pulse = Math.sin(frame * 0.08) * 0.04;

    /* Кольца радара */
    for (var r = 1; r <= 3; r++) {
      ctx.strokeStyle = "rgba(226,232,240," + (0.08 + r * 0.04) + ")";
      ctx.lineWidth = 1;
      ctx.beginPath();
      ctx.arc(0, 18, 28 + r * 16 + this.pulse * 8, 0, Math.PI * 2);
      ctx.stroke();
    }

    drawRR(ctx, -38, -20, 76, 76, 38, C.radarBase, C.outline);

    /* Фаза cluster: сегменты растут */
    var segs = [
      { label: "Цена", pct: 0.34, color: C.segPrice, start: -Math.PI / 2, end: -Math.PI / 6 },
      { label: "Подумаю", pct: 0.22, color: C.segThink, start: -Math.PI / 6, end: Math.PI / 6 },
      { label: "Конкурент", pct: 0.18, color: C.segComp, start: Math.PI / 6, end: Math.PI / 2 }
    ];

    var grow = prg < 55 ? 0 : prg < 120 ? (prg - 55) / 65 : 1;
    segs.forEach(function (s) {
      var sweep = (s.end - s.start) * s.pct * grow;
      ctx.fillStyle = s.color.replace(")", ",0.55)").replace("rgb", "rgba").replace("#", "");
      ctx.globalAlpha = 0.55 * grow;
      ctx.beginPath();
      ctx.moveTo(0, 18);
      ctx.arc(0, 18, 34, s.start, s.start + sweep);
      ctx.closePath();
      ctx.fillStyle = s.color;
      ctx.globalAlpha = 0.42 * grow;
      ctx.fill();
      ctx.globalAlpha = 1;
    });

    /* Фаза map: проценты */
    if (prg >= 118) {
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("34%", -12, 8);
      ctx.fillText("22%", 18, 26);
      ctx.fillText("18%", 14, -6);
    }

    /* Луч сканирования */
    var scanAng = (frame * 0.04) % (Math.PI * 2);
    ctx.strokeStyle = "rgba(251,113,133,0.45)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(0, 18);
    ctx.lineTo(Math.cos(scanAng) * 50, 18 + Math.sin(scanAng) * 50);
    ctx.stroke();

    /* Фаза prescribe: карточка рекомендации */
    if (prg >= 175) {
      var cardPrg = Math.min(1, (prg - 175) / 20);
      var cardY = 52 - cardPrg * 28;
      drawRR(ctx, -42, cardY, 84, 30, 8, "rgba(34,197,94,0.22)", C.patchGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Усилить блок ценности", 0, cardY + 12);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("патч скрипта v3", 0, cardY + 22);

      if (prg > 195 && prg < 215) {
        ctx.strokeStyle = "rgba(34,197,94," + (1 - (prg - 195) / 20) + ")";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(0, cardY + 15, 18 + (prg - 195) * 2, 0, Math.PI * 2);
        ctx.stroke();
      }
    }
  };

  /* Тег уходит в CRM */
  function CrmTagEmitter() {
    this.fly = 0;
  }
  CrmTagEmitter.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    if (prg < 198) return;
    this.fly = Math.min(1, (prg - 198) / 18);
    var tx = -60 + this.fly * 120;
    var ty = 30 - this.fly * 55;
    drawRR(ctx, tx, ty, 36, 14, 4, "rgba(56,189,248,0.25)", C.crmBlue);
    ctx.fillStyle = "#e0f2fe";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM тег", tx + 18, ty + 9);
    if (this.fly > 0.6) {
      ctx.strokeStyle = "rgba(56,189,248,0.5)";
      ctx.setLineDash([3, 3]);
      ctx.beginPath();
      ctx.moveTo(0, 48);
      ctx.lineTo(tx + 18, ty + 7);
      ctx.stroke();
      ctx.setLineDash([]);
    }
  };

  /* Панель патча скрипта сбоку */
  function ScriptPatchPanel() {
    this.glow = 0;
  }
  ScriptPatchPanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    drawRR(ctx, -168, 28, 44, 52, 6, "rgba(255,255,255,0.06)", C.outline);
    if (prg >= 175) {
      this.glow = Math.sin((prg - 175) * 0.2) * 0.3 + 0.5;
      ctx.fillStyle = "rgba(74,222,128," + this.glow + ")";
      for (var i = 0; i < 3; i++) {
        drawRR(ctx, -160, 36 + i * 14, 28, 8, 2, "rgba(255,255,255,0.5)", null);
      }
    }
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("скрипт", -146, 24);
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
    var prg = (frame * 0.045) % 220;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    /* Агенты выходят к верхней дуге радара — иная геометрия */
    var rimTargets = {
      "1_architect": { x: -95, y: -42 },
      "2_seo": { x: -35, y: -58 },
      "3_coder": { x: 35, y: -58 },
      "4_designer": { x: 95, y: -42 },
      "5_deployer": { x: 0, y: -68 }
    };
    var tgt = rimTargets[this.role] || { x: 0, y: -50 };

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
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.6) * 1.2;
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -8, -4 + bob, 16, 12, 2, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -14 - bob, 9, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 1.5;
    ctx.strokeStyle = C.outline;
    ctx.stroke();
    if (carryType) drawRR(ctx, -14, -20 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new DialogArcCarousel());
  entities.push(new SttWaveStrip());
  entities.push(new ObjectionRadarCore());
  entities.push(new HiddenObjectionReveal());
  entities.push(new ScriptPatchPanel());
  entities.push(new CrmTagEmitter());
  entities.push(new Agent(-120, 72, C.agentYellow, "1_architect", 12, [
    "400 звонков без ручного прослушивания",
    "Категоризирую возражения по CRM",
    "Карта отказов за ночь"
  ]));
  entities.push(new Agent(-55, 88, C.agentGreen, "2_seo", 48, [
    "Тег «цена» — 34% диалогов",
    "LSI в скрипт менеджера",
    "Интент отказа: конкурент"
  ]));
  entities.push(new Agent(10, 92, C.agentBlue, "3_coder", 88, [
    "STT → LLM без кода",
    "Webhook: тег в amoCRM",
    "Пайплайн на n8n"
  ]));
  entities.push(new Agent(70, 82, C.agentPink, "4_designer", 128, [
    "Скрытое «подумаю» в чате",
    "Тон менеджера не давить",
    "Отчёт для собственника"
  ]));
  entities.push(new Agent(118, 68, C.agentPurple, "5_deployer", 168, [
    "Тег в карточке сделки",
    "Патч скрипта в прод",
    "Интеграция телефонии"
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

    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.045) % 220;
    if (prg >= 10 && prg < 10.05) createBubble(-110, 50, "1. Захват диалога", 200);
    if (prg >= 50 && prg < 50.05) createBubble(-40, 30, "2. STT → LLM", 200);
    if (prg >= 95 && prg < 95.05) createBubble(20, 20, "3. Тег возражения", 200);
    if (prg >= 135 && prg < 135.05) createBubble(60, 10, "4. Сегмент радара", 200);
    if (prg >= 178 && prg < 178.05) createBubble(0, -30, "5. Патч скрипта", 200);

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 24);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 18, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.outline;
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
})();
</script>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bav-objection-map-canvas');
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
    line:'rgba(99,102,241,.18)',
    phone:'#22c55e',
    chat:'#3b82f6',
    crm:'#8b5cf6',
    ai:'#6366f1',
    aiGlow:'rgba(99,102,241,.22)',
    card:'rgba(255,255,255,.92)',
    cardBdr:'rgba(148,163,184,.35)',
    price:'#ef4444',
    think:'#f59e0b',
    rival:'#8b5cf6',
    term:'#0ea5e9',
    green:'#22c55e'
  };

  var OBJECTIONS = [
    {label:'Цена', pct:34, color:C.price, quote:'«Дорого для нас»'},
    {label:'Подумаю', pct:22, color:C.think, quote:'«Надо посоветоваться»'},
    {label:'Конкурент', pct:18, color:C.rival, quote:'«У других дешевле»'},
    {label:'Сроки', pct:14, color:C.term, quote:'«Не успеем к дедлайну»'}
  ];

  var CHANNELS = [
    {key:'phone', label:'Звонок', color:C.phone, icon:'☎'},
    {key:'chat',  label:'WhatsApp', color:C.chat, icon:'💬'},
    {key:'crm',   label:'CRM', color:C.crm, icon:'▣'}
  ];

  var DIALOGS = [
    {ch:0, text:'Дорого, нет бюджета'},
    {ch:1, text:'Подумаю до пятницы'},
    {ch:2, text:'Сравниваем с конкурентом'},
    {ch:0, text:'Сроки не подходят'},
    {ch:1, text:'Скрытый негатив по цене'},
    {ch:2, text:'Нужно согласовать с ЛПР'}
  ];

  var packets = [];
  var sparks = [];
  var barProg = OBJECTIONS.map(function(){ return 0; });
  var cycleT = 0;
  var LOOP = 680;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function spawnPacket(){
    var d = DIALOGS[Math.floor(Math.random()*DIALOGS.length)];
    var laneY = H*0.14 + d.ch * (H*0.2);
    packets.push({
      ch:d.ch,
      text:d.text,
      x:-120,
      y:laneY + (Math.random()-0.5)*12,
      alpha:0,
      phase:0,
      speed:1.4 + Math.random()*0.5,
      tagged:false
    });
  }

  function spawnSpark(targetIdx, fromX, fromY){
    var o = OBJECTIONS[targetIdx];
    sparks.push({
      x:fromX, y:fromY,
      tx:W*0.72, ty:H*0.22 + targetIdx*(H*0.16),
      color:o.color,
      life:0,
      max:50 + targetIdx*8
    });
    barProg[targetIdx] = Math.min(o.pct, barProg[targetIdx] + 4);
  }

  function drawChannels(L, R){
    CHANNELS.forEach(function(ch,i){
      var y = H*0.12 + i*(H*0.2);
      rr(L, y-14, R-L, 36, 10, 'rgba(255,255,255,.55)', ch.color, 1.2);
      ctx.fillStyle=ch.color;
      ctx.font='bold 11px Inter,system-ui,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(ch.icon+' '+ch.label, L+10, y+8);
    });
  }

  function drawAIHub(cx,cy,w,h,pulse){
    rr(cx-w/2, cy-h/2, w, h, 14, C.card, C.ai, 2);
    ctx.fillStyle=C.ai;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('AI-разбор', cx, cy-18);
    var pills = ['STT','LLM','Тег CRM'];
    pills.forEach(function(p,i){
      var px = cx - 52 + i*52;
      var py = cy+6;
      var glow = 0.35 + 0.25*Math.sin(pulse*0.08 + i);
      rr(px-22, py-10, 44, 20, 8, 'rgba(99,102,241,'+glow+')', C.ai, 1);
      ctx.fillStyle='#312e81';
      ctx.font='bold 9px Inter,sans-serif';
      ctx.fillText(p, px, py+4);
    });
    var scanY = cy - h/2 + 8 + (pulse*2)%(h-16);
    ctx.strokeStyle='rgba(99,102,241,.45)';
    ctx.lineWidth=1.5;
    ctx.beginPath();
    ctx.moveTo(cx-w/2+8, scanY);
    ctx.lineTo(cx+w/2-8, scanY);
    ctx.stroke();
  }

  function drawMapPanel(x,y,w,h){
    rr(x,y,w,h,12,C.card,C.cardBdr,1.5);
    ctx.fillStyle=C.ink;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Карта возражений', x+14, y+22);
    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.fillText('обновление в реальном времени', x+14, y+36);

    OBJECTIONS.forEach(function(o,i){
      var by = y+52 + i*(h-64)/OBJECTIONS.length;
      var bw = w - 28;
      var prog = barProg[i]/100;
      ctx.fillStyle=C.ink;
      ctx.font='bold 10px Inter,sans-serif';
      ctx.fillText(o.label, x+14, by);
      ctx.fillStyle=C.muted;
      ctx.textAlign='right';
      ctx.fillText(o.pct+'%', x+w-14, by);
      ctx.textAlign='left';
      rr(x+14, by+6, bw, 10, 5, '#e2e8f0', null, 0);
      rr(x+14, by+6, bw*prog, 10, 5, o.color, null, 0);
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,sans-serif';
      ctx.fillText(o.quote, x+14, by+28);
    });
  }

  function drawPacket(p){
    var ch = CHANNELS[p.ch];
    ctx.globalAlpha = p.alpha;
    var tw = Math.min(130, 8 + p.text.length*5.5);
    rr(p.x, p.y-12, tw, 24, 8, C.card, ch.color, 1.2);
    ctx.fillStyle=C.ink;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText(p.text, p.x+8, p.y+4);
    ctx.globalAlpha = 1;
  }

  function tick(){
    frame++;
    cycleT = (cycleT + 1) % LOOP;
    ctx.clearRect(0,0,W,H);

    var L = W*0.04;
    var hubX = W*0.48;
    var hubY = H*0.5;
    var mapX = W*0.62;
    var mapY = H*0.1;
    var mapW = W*0.34;
    var mapH = H*0.8;

    drawChannels(L, W*0.28);
    drawAIHub(hubX, hubY, W*0.22, H*0.36, frame);
    drawMapPanel(mapX, mapY, mapW, mapH);

    ctx.strokeStyle=C.line;
    ctx.lineWidth=1.5;
    ctx.setLineDash([5,5]);
    ctx.beginPath();
    ctx.moveTo(W*0.28, H*0.5);
    ctx.lineTo(hubX - W*0.11, H*0.5);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(hubX + W*0.11, H*0.5);
    ctx.lineTo(mapX, H*0.5);
    ctx.stroke();
    ctx.setLineDash([]);

    if(frame % 55 === 0) spawnPacket();

    packets = packets.filter(function(p){
      p.phase++;
      p.x += p.speed;
      if(p.x < W*0.1) p.alpha = Math.min(1, p.alpha + 0.06);
      drawPacket(p);

      if(!p.tagged && p.x > hubX - W*0.08){
        p.tagged = true;
        var idx = p.ch % OBJECTIONS.length;
        if(p.text.indexOf('Дорого')>=0 || p.text.indexOf('цен')>=0) idx = 0;
        else if(p.text.indexOf('Подумаю')>=0 || p.text.indexOf('негатив')>=0) idx = 1;
        else if(p.text.indexOf('конкур')>=0 || p.text.indexOf('ЛПР')>=0) idx = 2;
        else if(p.text.indexOf('Срок')>=0) idx = 3;
        spawnSpark(idx, hubX + W*0.1, hubY);
      }
      return p.x < W + 40;
    });

    sparks = sparks.filter(function(s){
      s.life++;
      var t = s.life / s.max;
      var ease = t<0.5 ? 2*t*t : 1-Math.pow(-2*t+2,2)/2;
      var sx = s.x + (s.tx - s.x)*ease;
      var sy = s.y + (s.ty - s.y)*ease;
      ctx.globalAlpha = 1 - t;
      ctx.fillStyle = s.color;
      ctx.beginPath();
      ctx.arc(sx, sy, 4, 0, Math.PI*2);
      ctx.fill();
      ctx.globalAlpha = 1;
      return s.life < s.max;
    });

    if(cycleT > LOOP - 80){
      barProg = barProg.map(function(v,i){
        return Math.max(0, v - 0.15);
      });
    }

    requestAnimationFrame(tick);
  }
  tick();
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

<?php get_footer(); ?>

<?php
/**
 * Template Name: AI-контроль качества звонков менеджеров
 * Description: SEO-лендинг — внедрение AI-контроля качества звонков под ключ. Транскрибация, call scoring, CRM.
 */

$page_seo_title       = 'AI-контроль качества звонков менеджеров — внедрение под ключ';
$page_seo_description = 'AI проверяет 100% звонков по чек-листу: транскрибация, оценка менеджеров, интеграция с CRM. Показываем, где команда теряет сделки. Разбор 10 звонков бесплатно.';

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
$nero_public_base = rtrim( getenv( 'PUBLIC_SITE_URL' ) ?: getenv( 'WP_SITE_URL' ) ?: home_url(), '/' );
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить звонки';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#cta';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#how';

$nero_ai_header_links = [
    ['label' => 'Проблема', 'href' => '#problem'],
    ['label' => 'Как работает', 'href' => '#how'],
    ['label' => 'Чек-лист', 'href' => '#checklist'],
    ['label' => 'Отчёт', 'href' => '#report'],
    ['label' => 'Интеграции', 'href' => '#integrations'],
    ['label' => 'Кейсы', 'href' => '#cases'],
    ['label' => 'Стоимость', 'href' => '#pricing'],
    ['label' => 'FAQ', 'href' => '#faq'],
    ['label' => 'Заявка', 'href' => '#cta'],
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
/* Скрыть шапку Kadence — pill-шапка nero-ai-floating-header как на главной */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header {
  display: none !important;
}
body.nero-ai-landing {
  padding-top: 0 !important;
}
</style>

<style>
/* --- Hero scope: call-quality QA (self-contained) --- */
#hero.cqa-hero {
  --cqa-cyan: #79f2ff;
  --cqa-violet: #8b5cf6;
  --cqa-green: #22c55e;
  --cqa-amber: #fbbf24;
  --cqa-rose: #fb7185;
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
#hero.cqa-hero::before {
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
#hero.cqa-hero::after {
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
  animation: cqaHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes cqaHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
#hero.cqa-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
#hero.cqa-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 6.2vw, 82px);
  line-height: .92;
  letter-spacing: -0.065em;
  color: #fff;
}
#hero.cqa-hero .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: #c7d2e5 !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
#hero.cqa-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
#hero.cqa-hero .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
  white-space: nowrap;
}
#hero.cqa-hero .nero-ai-btn-row { display: flex; flex-wrap: wrap; gap: 14px; margin-top: 34px; }
#hero.cqa-hero .nero-ai-btn {
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
#hero.cqa-hero .nero-ai-btn:hover,
#hero.cqa-hero .nero-ai-btn:focus-visible { transform: translateY(-2px); }
#hero.cqa-hero .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--cqa-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
#hero.cqa-hero .nero-ai-btn-secondary {
  color: #e6edf7 !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
#hero.cqa-hero .nero-ai-btn-secondary:hover {
  border-color: rgba(121, 242, 255, 0.36);
  background: rgba(121, 242, 255, 0.08);
}
#hero.cqa-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, var(--cqa-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
#hero.cqa-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
#hero.cqa-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
#hero.cqa-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
#hero.cqa-hero .nero-ai-dots { display: flex; gap: 7px; }
#hero.cqa-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
#hero.cqa-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
#hero.cqa-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
#hero.cqa-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
#hero.cqa-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
#hero.cqa-hero .nero-ai-window-body { padding: 18px; }
#hero.cqa-hero .cqa-canvas-wrap {
  position: relative;
  height: 118px;
  margin-bottom: 14px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(0,0,0,.28);
  overflow: hidden;
}
#hero.cqa-hero #cqa-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
#hero.cqa-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
#hero.cqa-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
#hero.cqa-hero .nero-ai-live-pill {
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
#hero.cqa-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: cqaPulse 1.6s infinite;
}
@keyframes cqaPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
#hero.cqa-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
#hero.cqa-hero .nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
}
#hero.cqa-hero .nero-ai-metric span {
  display: block;
  color: #9aa8bd;
  font-size: 12px;
  font-weight: 700;
}
#hero.cqa-hero .nero-ai-metric strong {
  display: block;
  margin-top: 7px;
  color: #fff;
  font-size: 24px;
  line-height: 1;
}
#hero.cqa-hero .nero-ai-metric small {
  display: block;
  margin-top: 6px;
  color: #9fb0c9;
  font-size: 11px;
}
#hero.cqa-hero .nero-ai-task-stream { margin-top: 16px; display: grid; gap: 10px; }
#hero.cqa-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
  animation: cqaTaskFloat 5s ease-in-out infinite;
}
#hero.cqa-hero .nero-ai-task:nth-child(2) { animation-delay: .6s; }
#hero.cqa-hero .nero-ai-task:nth-child(3) { animation-delay: 1.2s; }
#hero.cqa-hero .nero-ai-task:nth-child(4) { animation-delay: 1.8s; }
@keyframes cqaTaskFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-4px); }
}
#hero.cqa-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--cqa-cyan);
  font-size: 11px;
  font-weight: 800;
}
#hero.cqa-hero .nero-ai-task strong { display: block; color: #f8fafc; font-size: 13px; }
#hero.cqa-hero .nero-ai-task span { color: #9aa8bd; font-size: 12px; }
#hero.cqa-hero .nero-ai-status {
  padding: 5px 8px;
  border-radius: 999px;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
}
#hero.cqa-hero .nero-ai-status--ok {
  background: rgba(34,197,94,.12);
  color: #86efac;
}
#hero.cqa-hero .nero-ai-status--warn {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
#hero.cqa-hero .nero-ai-status--alert {
  background: rgba(251,113,133,.12);
  color: #fecdd3;
}
#hero.cqa-hero .nero-ai-reveal {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity .55s ease, transform .55s ease;
}
#hero.cqa-hero .nero-ai-reveal.nero-ai-active {
  opacity: 1;
  transform: none;
}
#hero.cqa-hero .nero-ai-delay-2 { transition-delay: .24s; }
@media (max-width: 960px) {
  #hero.cqa-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  #hero.cqa-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 640px) {
  #hero.cqa-hero { min-height: auto; padding-top: 56px; }
  #hero.cqa-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  #hero.cqa-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
@media (prefers-reduced-motion: reduce) {
  #hero.cqa-hero * { animation: none !important; transition: none !important; }
  #hero.cqa-hero .nero-ai-reveal { opacity: 1; transform: none; }
}
</style>
<style>
/* =====================================================
   VNA CONTENT — ai-kontrol-kachestva-zvonkov-menedzherov
   (Борис: scoped под .vna-content, префиксы vna-* / bqc-*)
   ===================================================== */
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important;}

.vna-content{
  --vna-bg:#050711;--vna-bg2:#080b17;--vna-bg3:#0a0e1c;
  --vna-surface:rgba(255,255,255,.072);--vna-surface2:rgba(255,255,255,.108);
  --vna-text:#e6edf7;--vna-muted:#9aa8bd;--vna-soft:#c7d2e5;--vna-heading:#fff;
  --vna-border:rgba(255,255,255,.10);--vna-border-s:rgba(255,255,255,.18);
  --vna-accent:#79f2ff;--vna-violet:#8b5cf6;--vna-green:#22c55e;--vna-cyan:#79f2ff;
  --vna-warn:#f59e0b;--vna-red:#f87171;
  --vna-btn-from:#2563eb;--vna-btn-to:#7c3aed;
  --vna-shadow:0 24px 72px rgba(0,0,0,.4);
  --vna-r:18px;--vna-r-lg:24px;--vna-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vna-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vna-content *,.vna-content *::before,.vna-content *::after{box-sizing:border-box;}
.vna-content a{color:inherit;text-decoration:none;}
.vna-content p{color:var(--vna-muted);line-height:1.72;margin:0 0 1em;}
.vna-content p:last-child{margin-bottom:0;}
.vna-content h2,.vna-content h3,.vna-content h4{color:var(--vna-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.vna-content strong{color:var(--vna-soft);}
.vna-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vna-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vna-muted);font-size:14.5px;line-height:1.65;}
.vna-content ul li::before{content:'›';position:absolute;left:0;color:var(--vna-accent);font-weight:700;}
.vna-content code{background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;color:var(--vna-soft);}

.vna-cnt{width:min(var(--vna-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.vna-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vna-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.vna-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vna-sh.vna-left{margin-left:0;text-align:left;}
.vna-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vna-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vna-sh.vna-left p{margin-left:0;}
.vna-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vna-accent);margin-bottom:14px;}
.vna-gt{background:linear-gradient(92deg,#fff 0%,var(--vna-accent) 44%,var(--vna-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}

.vna-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.vna-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:start;}
.vna-intro-text{position:relative;padding-left:20px;}
.vna-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vna-accent),var(--vna-violet));}
.vna-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vna-muted);margin-bottom:1em;}
.vna-intro-def{background:rgba(121,242,255,.06);border:1px solid rgba(121,242,255,.18);border-radius:14px;padding:18px 20px;margin-bottom:1.2em;}
.vna-intro-def strong{color:var(--vna-accent);}
.vna-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.vna-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.vna-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vna-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.vna-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vna-muted);line-height:1.4;}
.vna-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.vna-intro-grid{grid-template-columns:1fr;gap:36px;}.vna-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.vna-intro-kpi{grid-template-columns:1fr 1fr;}}

.vna-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vna-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.vna-toc a{display:inline-block;padding:9px 18px;background:var(--vna-surface);border:1px solid var(--vna-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vna-muted);transition:border-color .2s,color .2s,background .2s;}
.vna-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vna-accent);background:rgba(121,242,255,.08);}

.vna-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vna-border);border-radius:var(--vna-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.vna-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.vna-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vna-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.vna-grid-2,.vna-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.vna-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vna-grid-3{grid-template-columns:1fr;}}

/* KPI-полоса #problem */
.vna-kpi-strip{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin:36px 0 0;}
.vna-kpi-strip .vna-kpi-card{text-align:left;padding:20px 18px;}
.vna-kpi-strip .vna-kpi-card .kv{font-size:clamp(22px,3vw,32px);}
.vna-kpi-strip .arrow{color:var(--vna-green);font-size:11px;font-weight:700;margin-top:6px;display:block;}
@media(max-width:900px){.vna-kpi-strip{grid-template-columns:1fr 1fr;}}
@media(max-width:500px){.vna-kpi-strip{grid-template-columns:1fr;}}

/* Пайплайн #how */
.vna-pipeline{display:grid;grid-template-columns:repeat(5,1fr);gap:12px;margin-top:32px;position:relative;}
.vna-pipeline::before{content:'';position:absolute;top:28px;left:8%;right:8%;height:2px;background:linear-gradient(90deg,var(--vna-accent),var(--vna-violet));opacity:.35;z-index:0;}
.vna-pipe-step{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:20px 14px;text-align:center;position:relative;z-index:1;transition:border-color .2s,transform .2s;}
.vna-pipe-step:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.vna-pipe-icon{width:44px;height:44px;margin:0 auto 12px;border-radius:12px;background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.25);display:flex;align-items:center;justify-content:center;font-size:18px;}
.vna-pipe-step h4{font-size:13px;margin:0 0 6px;color:#fff;}
.vna-pipe-step p{font-size:12px;margin:0;line-height:1.5;}
@media(max-width:900px){.vna-pipeline{grid-template-columns:1fr 1fr;}.vna-pipeline::before{display:none;}}
@media(max-width:500px){.vna-pipeline{grid-template-columns:1fr;}}

/* Scorecard #checklist */
.vna-scorecard{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:28px;}
.vna-score-row{display:flex;align-items:center;gap:12px;margin-bottom:14px;}
.vna-score-label{flex:0 0 140px;font-size:13px;font-weight:600;color:var(--vna-soft);}
.vna-score-bar{flex:1;height:10px;background:rgba(255,255,255,.08);border-radius:99px;overflow:hidden;}
.vna-score-fill{height:100%;border-radius:99px;transition:width 1.2s ease;}
.vna-score-fill.ok{background:linear-gradient(90deg,var(--vna-green),#4ade80);}
.vna-score-fill.warn{background:linear-gradient(90deg,var(--vna-warn),#fbbf24);}
.vna-score-fill.bad{background:linear-gradient(90deg,var(--vna-red),#fb7185);}
.vna-score-val{flex:0 0 36px;font-size:12px;font-weight:800;text-align:right;}
@media(max-width:700px){.vna-scorecard{grid-template-columns:1fr;}.vna-score-label{flex:0 0 110px;}}

/* Отчёт-пример #report */
.vna-report-mock{background:linear-gradient(145deg,rgba(255,255,255,.08),rgba(255,255,255,.03));border:1px solid rgba(121,242,255,.2);border-radius:20px;padding:28px;margin-top:28px;}
.vna-report-head{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:16px;margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,.08);}
.vna-report-score{font-size:42px;font-weight:900;color:var(--vna-accent);letter-spacing:-.04em;line-height:1;}
.vna-report-tags{display:flex;flex-wrap:wrap;gap:8px;}
.vna-report-tag{padding:5px 12px;border-radius:99px;font-size:11px;font-weight:700;background:rgba(248,113,113,.12);color:var(--vna-red);border:1px solid rgba(248,113,113,.25);}
.vna-report-tag.ok{background:rgba(34,197,94,.12);color:var(--vna-green);border-color:rgba(34,197,94,.25);}
.vna-quote{background:rgba(0,0,0,.25);border-left:3px solid var(--vna-accent);border-radius:0 12px 12px 0;padding:14px 18px;margin:12px 0;font-size:14px;font-style:italic;color:var(--vna-soft);}
.vna-quote cite{display:block;margin-top:8px;font-size:11px;font-style:normal;color:var(--vna-muted);}

/* Интеграции */
.vna-integ-pills{display:flex;flex-wrap:wrap;gap:10px;margin-top:24px;}
.vna-integ-pill{padding:10px 18px;border-radius:99px;font-size:13px;font-weight:700;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:var(--vna-soft);transition:border-color .2s,background .2s;}
.vna-integ-pill:hover{border-color:rgba(121,242,255,.4);background:rgba(121,242,255,.08);}

.vna-timeline{position:relative;padding-left:40px;}
.vna-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vna-accent),var(--vna-violet));opacity:.35;border-radius:2px;}
.vna-tl-item{position:relative;margin-bottom:32px;}
.vna-tl-item:last-child{margin-bottom:0;}
.vna-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vna-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.vna-tl-item h3{font-size:17px;margin-bottom:8px;}
.vna-tl-item p{font-size:14.5px;margin:0;}

.vna-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin-top:24px;}
.vna-table{width:100%;border-collapse:collapse;font-size:14px;}
.vna-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vna-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.vna-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vna-text);vertical-align:top;}
.vna-table tr:last-child td{border-bottom:none;}
.vna-table tr:hover td{background:rgba(255,255,255,.03);}

.vna-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vna-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vna-case-grid{grid-template-columns:1fr;}}
.vna-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.vna-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.vna-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vna-green);margin-bottom:10px;}
.vna-case-card h3{font-size:16px;margin-bottom:14px;}
.vna-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.vna-metric{display:flex;align-items:baseline;gap:8px;}
.vna-metric .num{font-size:22px;font-weight:900;color:var(--vna-accent);flex-shrink:0;letter-spacing:-.04em;}
.vna-metric .lbl{font-size:13px;color:var(--vna-muted);}

.vna-price-badge{display:inline-block;padding:8px 20px;border-radius:99px;font-size:clamp(18px,2.5vw,24px);font-weight:900;color:#fff;background:linear-gradient(135deg,var(--vna-btn-from),var(--vna-btn-to));margin:16px 0 24px;box-shadow:0 8px 32px rgba(59,130,246,.3);}

.vna-callout{background:rgba(139,92,246,.08);border:1px solid rgba(139,92,246,.25);border-radius:16px;padding:22px 26px;margin:28px 0;}
.vna-callout--soft{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.vna-callout p{margin-bottom:.8em;}
.vna-callout p:last-child{margin-bottom:0;}

.vna-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vna-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.vna-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vna-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.vna-faq-q::after{content:'▾';font-size:13px;color:var(--vna-accent);flex-shrink:0;transition:transform .25s;}
.vna-faq-item.open .vna-faq-q::after{transform:rotate(180deg);}
.vna-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vna-muted);line-height:1.72;}
.vna-faq-item.open .vna-faq-a{max-height:600px;padding:0 24px 20px;}

.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--primary{background:linear-gradient(135deg,rgba(121,242,255,.14),rgba(59,130,246,.1));border-color:rgba(121,242,255,.35);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--vna-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vna-btn-from),var(--vna-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

.vna-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0;}
.vna-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--vna-muted);}
.vna-cta-checklist li::before{content:'✓';color:var(--vna-green);font-weight:800;}

.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
</style>
<main id="primary" class="site-main nero-ai-home-page ai-kontrol-kachestva-zvonkov-menedzherov-page" role="main" tabindex="-1">

<section class="nero-ai-hero cqa-hero" id="hero" aria-labelledby="hero-cqa-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · контроль качества звонков</p>
      <h1 id="hero-cqa-title">AI-контроль качества звонков менеджеров: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI проверяет 100% звонков по чек-листу и показывает, где команда теряет сделки — вместо выборочного прослушивания руководителем</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Транскрибация</li>
        <li class="nero-ai-badge">Call scoring</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">Чек-лист</li>
        <li class="nero-ai-badge">152-ФЗ</li>
        <li class="nero-ai-badge">Telegram</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#how">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-контроль качества звонков">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true">
            <span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span>
          </div>
          <span class="nero-ai-window-title">AI-контроль звонков · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Оценка диалогов в реальном времени</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>

          <div class="cqa-canvas-wrap" aria-hidden="true">
            <canvas
              id="cqa-hero-canvas"
              role="img"
              aria-label="Анимация: звуковая волна звонка проходит через AI-оценку по чек-листу"
            ></canvas>
          </div>

          <div class="nero-ai-metrics-grid" aria-label="Ключевые метрики QA">
            <div class="nero-ai-metric">
              <span>Охват QA</span>
              <strong>100%</strong>
              <small>было 2–5%</small>
            </div>
            <div class="nero-ai-metric">
              <span>Средний score</span>
              <strong>72</strong>
              <small>команда за неделю</small>
            </div>
            <div class="nero-ai-metric">
              <span>Без next step</span>
              <strong>23</strong>
              <small>звонка за сутки</small>
            </div>
            <div class="nero-ai-metric">
              <span>Оценка</span>
              <strong>15 сек</strong>
              <small>на один диалог</small>
            </div>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий QA">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ASR</span>
              <div>
                <strong>Звонок завершён</strong>
                <span>транскрибация ASR</span>
              </div>
              <span class="nero-ai-status nero-ai-status--ok">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div>
                <strong>AI-оценка</strong>
                <span>68/100 · нет next step</span>
              </div>
              <span class="nero-ai-status nero-ai-status--warn">внимание</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div>
                <strong>Оценка в CRM</strong>
                <span>сделка «думает»</span>
              </div>
              <span class="nero-ai-status nero-ai-status--ok">записано</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div>
                <strong>Алерт РОПу</strong>
                <span>возражение по цене не отработано</span>
              </div>
              <span class="nero-ai-status nero-ai-status--alert">алерт</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  var hero = document.getElementById('hero');
  if (hero) {
    var reveals = hero.querySelectorAll('.nero-ai-reveal');
    if ('IntersectionObserver' in window) {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting) {
            e.target.classList.add('nero-ai-active');
            io.unobserve(e.target);
          }
        });
      }, { threshold: 0.12 });
      reveals.forEach(function (el) { io.observe(el); });
    } else {
      reveals.forEach(function (el) { el.classList.add('nero-ai-active'); });
    }
  }

  var cv = document.getElementById('cqa-hero-canvas');
  if (!cv) return;
  var cx = cv.getContext('2d');
  var W = 0, H = 0, t = 0;
  var checklist = [
    { label: 'Приветствие', ok: true },
    { label: 'Потребность', ok: true },
    { label: 'Возражения', ok: false },
    { label: 'Next step', ok: false }
  ];

  function resize() {
    var rect = cv.parentElement.getBoundingClientRect();
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    W = Math.max(1, Math.floor(rect.width));
    H = Math.max(1, Math.floor(rect.height));
    cv.width = Math.floor(W * dpr);
    cv.height = Math.floor(H * dpr);
    cv.style.width = W + 'px';
    cv.style.height = H + 'px';
    cx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function waveY(x, phase) {
    return H * 0.52
      + Math.sin(x * 0.045 + phase) * 14
      + Math.sin(x * 0.018 + phase * 1.4) * 9
      + Math.sin(x * 0.09 + phase * 2.1) * 5;
  }

  function draw() {
    t += 0.035;
    cx.clearRect(0, 0, W, H);

    var grad = cx.createLinearGradient(0, 0, W, 0);
    grad.addColorStop(0, 'rgba(6,10,24,0.95)');
    grad.addColorStop(0.5, 'rgba(11,18,38,0.92)');
    grad.addColorStop(1, 'rgba(6,10,24,0.95)');
    cx.fillStyle = grad;
    cx.fillRect(0, 0, W, H);

    cx.strokeStyle = 'rgba(121,242,255,0.08)';
    cx.lineWidth = 1;
    for (var gx = 0; gx < W; gx += 28) {
      cx.beginPath();
      cx.moveTo(gx, 0);
      cx.lineTo(gx, H);
      cx.stroke();
    }

    var scanX = (Math.sin(t * 0.55) * 0.5 + 0.5) * (W - 40) + 20;
    var waveGrad = cx.createLinearGradient(0, 0, W, 0);
    waveGrad.addColorStop(0, 'rgba(121,242,255,0.15)');
    waveGrad.addColorStop(0.45, 'rgba(121,242,255,0.85)');
    waveGrad.addColorStop(0.55, 'rgba(139,92,246,0.85)');
    waveGrad.addColorStop(1, 'rgba(121,242,255,0.15)');

    cx.beginPath();
    for (var x = 0; x <= W; x += 2) {
      var y = waveY(x, t * 2.2);
      if (x === 0) cx.moveTo(x, y);
      else cx.lineTo(x, y);
    }
    cx.strokeStyle = waveGrad;
    cx.lineWidth = 2.2;
    cx.stroke();

    cx.lineTo(W, H);
    cx.lineTo(0, H);
    cx.closePath();
    var fillGrad = cx.createLinearGradient(0, H * 0.3, 0, H);
    fillGrad.addColorStop(0, 'rgba(121,242,255,0.18)');
    fillGrad.addColorStop(1, 'rgba(121,242,255,0)');
    cx.fillStyle = fillGrad;
    cx.fill();

    cx.strokeStyle = 'rgba(251,191,36,0.55)';
    cx.lineWidth = 1.5;
    cx.setLineDash([4, 4]);
    cx.beginPath();
    cx.moveTo(scanX, 8);
    cx.lineTo(scanX, H - 8);
    cx.stroke();
    cx.setLineDash([]);

    var cardW = Math.min(150, W * 0.38);
    var cardX = W - cardW - 12;
    var cardY = 10;
    cx.fillStyle = 'rgba(255,255,255,0.06)';
    cx.strokeStyle = 'rgba(255,255,255,0.12)';
    cx.lineWidth = 1;
    cx.beginPath();
    cx.roundRect(cardX, cardY, cardW, H - 20, 10);
    cx.fill();
    cx.stroke();

    cx.fillStyle = '#e6edf7';
    cx.font = 'bold 10px Inter, system-ui, sans-serif';
    cx.fillText('Scorecard', cardX + 10, cardY + 16);

    var score = Math.round(62 + Math.sin(t * 0.8) * 8);
    cx.fillStyle = score < 70 ? '#fbbf24' : '#22c55e';
    cx.font = 'bold 18px Inter, system-ui, sans-serif';
    cx.fillText(score + '/100', cardX + 10, cardY + 36);

    checklist.forEach(function (item, i) {
      var rowY = cardY + 48 + i * 14;
      var lit = item.ok ? (Math.sin(t * 1.6 + i) > -0.2) : (Math.sin(t * 2.4 + i) > 0.55);
      cx.fillStyle = lit ? (item.ok ? '#22c55e' : '#fb7185') : 'rgba(255,255,255,0.18)';
      cx.beginPath();
      cx.arc(cardX + 14, rowY, 4, 0, Math.PI * 2);
      cx.fill();
      cx.fillStyle = lit ? '#c7d2e5' : '#64748b';
      cx.font = '9px Inter, system-ui, sans-serif';
      var label = item.label.length > 12 ? item.label.slice(0, 11) + '…' : item.label;
      cx.fillText(label, cardX + 24, rowY + 3);
    });

    cx.fillStyle = 'rgba(199,210,229,0.75)';
    cx.font = '9px Inter, system-ui, sans-serif';
    var transcript = 'Менеджер: …уточню бюджет… Клиент: дорого…';
    cx.fillText(transcript.slice(0, Math.floor(18 + (Math.sin(t) + 1) * 12)), 12, H - 12);

    requestAnimationFrame(draw);
  }

  resize();
  window.addEventListener('resize', resize, { passive: true });
  if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    requestAnimationFrame(draw);
  } else {
    cx.fillStyle = 'rgba(6,10,24,0.95)';
    cx.fillRect(0, 0, W, H);
    cx.fillStyle = '#79f2ff';
    cx.font = '12px Inter, system-ui, sans-serif';
    cx.fillText('AI call scoring · демо', 12, H / 2);
  }
})();
</script>

<div class="vna-content">

  <!-- INTRO -->
  <section class="vna-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vna-cnt">
      <div class="vna-intro-grid nero-ai-reveal">
        <div class="vna-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai контроль качества звонков</p>
          <div class="vna-intro-def">
            <p><strong>AI-контроль качества звонков</strong> — система, которая транскрибирует 100% разговоров, оценивает их по чек-листу и показывает руководителю точки потери сделок. Практический слой <strong>внедрения AI в бизнес-процессы</strong> отдела продаж и контакт-центра.</p>
          </div>
          <p>Для отдела продаж это частный случай более широкого тренда — <a href="<?php echo esc_url($nero_public_base . '/kpmg-claude-vnedrenie-ai-276-tysyach/'); ?>">масштабное внедрение AI в бизнес-процессы</a>: от корпоративных платформ до точечной автоматизации в CRM и контакт-центре.</p>
          <p>Отдел продаж живёт в звонках. Руководитель знает, что качество диалога влияет на конверсию, средний чек и повторные обращения. Но физически прослушать все разговоры невозможно: при 15–30 менеджерах и сотнях звонков в день классический контроль качества превращается в лотерею.</p>
          <p><strong>AI-контроль качества звонков</strong> закрывает этот разрыв: автоматизирует оценку, делает её единообразной и возвращает сигнал туда, где принимаются решения — в воронку CRM и ежедневный разбор с командой. Nero Network внедряет такие системы под ключ: от бесплатного разбора 10 звонков до интеграции с вашей телефонией и CRM.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые показатели">
          <div class="vna-kpi-card"><div class="kv">100%</div><div class="kl">охват QA вместо выборки</div><div class="ks">Gartner Auto QA, 2026</div></div>
          <div class="vna-kpi-card"><div class="kv">15 сек</div><div class="kl">оценка одного звонка</div><div class="ks">кейс «Соль»</div></div>
          <div class="vna-kpi-card"><div class="kv">90%+</div><div class="kl">точность простых критериев</div><div class="ks">Росгосстрах</div></div>
          <div class="vna-kpi-card"><div class="kv">10</div><div class="kl">звонков бесплатно</div><div class="ks">лид-магнит Nero</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#problem">Проблема</a>
        <a href="#how">Как работает</a>
        <a href="#checklist">Чек-лист</a>
        <a href="#report">Отчёт</a>
        <a href="#integrations">Интеграции</a>
        <a href="#cases">Кейсы</a>
        <a href="#pricing">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Заявка</a>
      </nav>
    </div>
  </div>

  <!-- #problem -->
  <section class="vna-section" id="problem">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Боль руководителя</span>
        <h2>Почему руководитель не слышит<br>100% ошибок в звонках</h2>
        <p>Контроль качества звонков менеджеров в большинстве компаний — выборочный, субъективный и не масштабируется.</p>
      </div>

      <div class="vna-card nero-ai-reveal" id="problem-sampling">
        <h3 style="font-size:20px;margin-bottom:14px;">Выборочное прослушивание и слепые зоны отдела продаж</h3>
        <p>Супервайзер или РОП вручную выбирает 5–10% записей и ставит субъективную оценку. По Gartner (Innovation Insight: Auto QA, январь 2026) ручной QA охватывает типично <strong>2–5%</strong> взаимодействий. В российских кейсах цифры жёстче: «Лемана Про» — <strong>1,5%</strong>, Росгосстрах — <strong>1%</strong> при ~15 000 звонков в день, «Ленремонт» — ~<strong>10%</strong> при ~18 000 звонках в сутки.</p>
        <p>Девяносто плюс процентов ошибок остаются невидимыми. Менеджер не фиксирует следующий шаг — сделка «зависает» в CRM без причины. Клиент озвучивает возражение «дорого», а сотрудник уходит в монолог — конверсия падает, но руководитель узнаёт об этом случайно, если узнаёт вообще.</p>
      </div>

      <div class="vna-kpi-strip nero-ai-reveal" aria-label="Сравнение ручного QA и AI">
        <div class="vna-kpi-card"><div class="kv">2–5%</div><div class="kl">ручной QA (Gartner)</div><span class="arrow">→</span></div>
        <div class="vna-kpi-card"><div class="kv">1,5%</div><div class="kl">«Лемана Про» до AI</div><span class="arrow">→</span></div>
        <div class="vna-kpi-card"><div class="kv">100%</div><div class="kl">после AI-контроля</div><span class="arrow" style="color:var(--vna-accent);">полный охват</span></div>
        <div class="vna-kpi-card"><div class="kv">15 сек</div><div class="kl">оценка vs 10 мин вручную</div><span class="arrow" style="color:var(--vna-green);">кейс «Соль»</span></div>
      </div>

      <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="problem-trend" style="margin-top:28px;">
        <h3 style="font-size:19px;margin-bottom:12px;">Тренд автоматизации контакт-центров в 2026 году</h3>
        <p>В 2026 году индустрия смещается от «прослушать выборку» к <strong>автоматизированному QA на 100% взаимодействий</strong>. IBM (contact center automation trends, январь 2026) называет automated quality assurance ключевым трендом. Gartner фиксирует сдвиг роли QA-менеджера: от прослушивателя к стратегу на полном массиве данных.</p>
        <div class="vna-callout vna-callout--soft" style="margin-top:18px;margin-bottom:0;">
          <p><strong>Коротко:</strong> ручной контроль качества звонков менеджеров масштабируется плохо. AI-анализ звонков даёт полный охват, объективные критерии и скорость обратной связи, которую физически не обеспечить отделом ОКК.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #how -->
  <section class="vna-section vna-section-alt" id="how">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Технология</span>
        <h2>Как работает AI-контроль качества звонков:<br>от записи до отчёта</h2>
        <p>Типовой пайплайн: запись → транскрибация → диаризация → LLM-анализ → результат в CRM.</p>
      </div>

      <div class="vna-pipeline nero-ai-reveal" aria-label="Пайплайн AI-контроля звонков">
        <div class="vna-pipe-step"><div class="vna-pipe-icon">📞</div><h4>Запись</h4><p>АТС/CRM сохраняет аудио и метаданные</p></div>
        <div class="vna-pipe-step"><div class="vna-pipe-icon">🎙️</div><h4>ASR</h4><p>AI-транскрибация звонков в текст</p></div>
        <div class="vna-pipe-step"><div class="vna-pipe-icon">👥</div><h4>Диаризация</h4><p>Разделение реплик менеджера и клиента</p></div>
        <div class="vna-pipe-step"><div class="vna-pipe-icon">🧠</div><h4>LLM</h4><p>AI-речевая аналитика и call scoring</p></div>
        <div class="vna-pipe-step"><div class="vna-pipe-icon">📊</div><h4>CRM</h4><p>Оценка, теги, алерт РОПу</p></div>
      </div>

      <div class="vna-grid-2" style="margin-top:36px;">
        <div class="vna-card nero-ai-reveal" id="how-asr">
          <h3 style="font-size:18px;margin-bottom:12px;">AI-транскрибация и речевая аналитика звонков</h3>
          <p>В российских проектах используют Yandex SpeechKit, GigaAM, Whisper (on-prem). В кейсе Росгосстраха WER транскрибации — <strong>0,23</strong>. AI-речевая аналитика добавляет интерпретацию: тон, негатив, кластеризация жалоб, критичные инциденты.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="how-scoring">
          <h3 style="font-size:18px;margin-bottom:12px;">AI call scoring: оценка по чек-листу за секунды</h3>
          <p>Бинарные критерии, весовые оценки, compliance-фразы, поведенческие паттерны. Кейс «Соль» + mymeet.ai: <strong>10 минут → 15 секунд</strong> на один звонок при ~150 часах записей в месяц.</p>
        </div>
      </div>

      <div class="vna-card nero-ai-reveal nero-ai-delay-2" id="how-rop" style="margin-top:20px;">
        <h3 style="font-size:18px;margin-bottom:12px;">Что видит руководитель вместо «случайных» прослушиваний</h3>
        <ul>
          <li>рейтинг менеджеров по единой шкале 0–100;</li>
          <li>топ-3 повторяющиеся ошибки команды за неделю;</li>
          <li>«потерянные» звонки — нет next step, слабое закрытие, игнор возражения;</li>
          <li>эталонные диалоги для обучения;</li>
          <li>связка со сделкой — оценка на стадии воронки.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- БОРИС: визуальный блок — разбор одного звонка -->
  <section id="boris-calls-viz" class="bqc-root" aria-label="Анимация: AI разбирает звонок — волна, транскрипт, scorecard">
<style>
.bqc-root{padding:56px 0 64px;background:#f0f4fb;}
.bqc-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
.bqc-card{display:grid;grid-template-columns:40% 60%;border-radius:24px;overflow:hidden;box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(6,182,212,.18);min-height:500px;}
@media(max-width:960px){.bqc-card{grid-template-columns:1fr;min-height:auto;}}
.bqc-lft{background:#fff;padding:44px 36px;display:flex;flex-direction:column;justify-content:center;}
.bqc-ey{display:inline-flex;align-items:center;gap:7px;font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;color:#0891b2;margin:0 0 14px;}
.bqc-ey::before{content:'';display:inline-block;width:20px;height:2px;background:#0891b2;}
.bqc-h3{font-size:24px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 20px;}
.bqc-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:10px;}
.bqc-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14.5px;line-height:1.5;color:#334155;}
.bqc-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(6,182,212,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0891b2;font-style:normal;}
.bqc-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;}
.bqc-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;}
.bqc-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
.bqc-pl-c{background:rgba(6,182,212,.08);color:#0e7490;border:1.5px solid rgba(6,182,212,.22);}
.bqc-pl-r{background:rgba(248,113,113,.08);color:#b91c1c;border:1.5px solid rgba(248,113,113,.22);}
.bqc-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
.bqc-rgt{background:linear-gradient(145deg,#060a18 0%,#0c1228 55%,#080d1f 100%);position:relative;overflow:hidden;min-height:420px;}
#bqc-call-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bqc-cnt"><div class="bqc-card">
  <div class="bqc-lft">
    <span class="bqc-ey">Внутри одного звонка</span>
    <h3 class="bqc-h3">От аудиоволны до scorecard: что делает AI за 15 секунд</h3>
    <ul class="bqc-ul">
      <li><span class="bqc-ic">1</span>ASR превращает запись в транскрипт с таймкодами</li>
      <li><span class="bqc-ic">2</span>Диаризация разделяет реплики менеджера и клиента</li>
      <li><span class="bqc-ic">3</span>LLM оценивает по чек-листу и выделяет цитаты-доказательства</li>
      <li><span class="bqc-ic">4</span>Результат уходит в CRM: балл, теги, рекомендация РОПу</li>
    </ul>
    <div class="bqc-pills">
      <span class="bqc-pl bqc-pl-c">68/100 · нет next step</span>
      <span class="bqc-pl bqc-pl-r">возражение по цене</span>
      <span class="bqc-pl bqc-pl-g">15 сек · оценка</span>
    </div>
    <p class="bqc-foot">Дальше — чек-лист критериев, по которым строится оценка →</p>
  </div>
  <div class="bqc-rgt"><canvas id="bqc-call-canvas" aria-label="Анимация: звуковая волна, транскрипт и scorecard оценки звонка" role="img"></canvas></div>
</div></div>
<script>
(function(){
  var cv=document.getElementById('bqc-call-canvas');if(!cv)return;
  var cx=cv.getContext('2d'),W=0,H=0,fr=0,pulse=0;
  function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||500;W=cv.width;H=cv.height;}
  window.addEventListener('resize',resize);resize();
  var C={cyan:'#22d3ee',green:'#4ade80',red:'#f87171',viol:'#a78bfa',text:'#e2e8f0',muted:'rgba(226,232,240,.45)',card:'rgba(255,255,255,.06)',line:'rgba(255,255,255,.08)'};
  var BARS=[{label:'Приветствие',pct:.92,clr:C.green},{label:'Потребность',pct:.58,clr:C.cyan},{label:'Возражения',pct:.35,clr:C.red},{label:'Next step',pct:.22,clr:C.red}];
  var LINES=[{who:'М',txt:'Добрый день, компания Nero...'},{who:'К',txt:'Интересует внедрение аналитики'},{who:'М',txt:'Расскажу о тарифах...'},{who:'К',txt:'Дорого, пришлите КП'},{who:'М',txt:'Хорошо, до связи'}];
  var LOOP=480;
  function rr(x,y,w,h,r,fill,stroke,lw){cx.beginPath();if(cx.roundRect)cx.roundRect(x,y,w,h,r);else{cx.moveTo(x+r,y);cx.arcTo(x+w,y,x+w,y+h,r);cx.arcTo(x+w,y+h,x,y+h,r);cx.arcTo(x,y+h,x,y,r);cx.arcTo(x,y,x+w,y,r);cx.closePath();}if(fill){cx.fillStyle=fill;cx.fill();}if(stroke){cx.strokeStyle=stroke;cx.lineWidth=lw||1;cx.stroke();}}
  function drawWave(y,h){cx.beginPath();cx.moveTo(16,y+h/2);for(var x=16;x<W-16;x+=3){var amp=Math.sin((x+fr*2)*0.04)*Math.sin((x+fr)*0.012+pulse*0.05)*h*0.35;cx.lineTo(x,y+h/2+amp);}cx.strokeStyle=C.cyan;cx.lineWidth=2;cx.stroke();}
  function loop(){
    fr++;pulse++;var phase=fr%LOOP;
    cx.clearRect(0,0,W,H);
    if(phase<200)drawWave(24,Math.max(20,72-phase*0.15));
    if(phase>55){rr(14,100,W-28,110,12,C.card,C.line,1);cx.fillStyle=C.text;cx.font='bold 11px Inter,sans-serif';cx.textAlign='left';cx.fillText('Транскрипт · AI call scoring',24,120);
      var vis=Math.min(LINES.length,Math.floor(Math.max(0,phase-70)/35));
      for(var i=0;i<vis;i++){var ln=LINES[i],ly=134+i*22;cx.fillStyle=ln.who==='М'?C.cyan:C.green;cx.font='bold 10px sans-serif';cx.fillText(ln.who,28,ly);cx.fillStyle=C.muted;cx.font='11px Inter,sans-serif';cx.fillText(ln.txt,50,ly);}}
    if(phase>190){var prog=Math.min(1,Math.max(0,(phase-200)/120));rr(14,230,W-28,120,12,C.card,C.line,1);
      cx.fillStyle=C.cyan;cx.font='bold 28px Inter,sans-serif';cx.fillText(Math.round(22+prog*46)+'/100',W-90,266);
      BARS.forEach(function(b,i){var by=248+i*26,bw=W-80;cx.fillStyle=C.muted;cx.font='10px Inter,sans-serif';cx.fillText(b.label,24,by+10);rr(24,by+14,bw,8,4,'rgba(255,255,255,.08)',null,0);if(bw*b.pct*prog>2)rr(24,by+14,bw*b.pct*prog,8,4,b.clr+'99',null,0);});}
    if(phase>320){cx.globalAlpha=Math.min(1,(phase-320)/40);rr(W/2-110,H-36,220,26,13,'rgba(74,222,128,.15)',C.green,1);cx.fillStyle=C.green;cx.font='bold 11px Inter,sans-serif';cx.textAlign='center';cx.fillText('✓ Записано в CRM · сделка «думает»',W/2,H-18);cx.globalAlpha=1;}
    requestAnimationFrame(loop);
  }
  document.fonts.ready.then(function(){loop();});
})();
</script>
</section>

  <!-- #checklist -->
  <section class="vna-section" id="checklist">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Оценка</span>
        <h2>Чек-лист AI-оценки<br>звонков менеджеров</h2>
        <p>Скоринг звонков работает, когда критерии отражают реальный процесс продаж.</p>
      </div>
      <div class="vna-scorecard nero-ai-reveal">
        <div class="vna-card">
          <h3 style="font-size:18px;margin-bottom:16px;">Пример scorecard (веса критериев)</h3>
          <div class="vna-score-row"><span class="vna-score-label">Приветствие</span><div class="vna-score-bar"><div class="vna-score-fill ok" style="width:92%"></div></div><span class="vna-score-val">92%</span></div>
          <div class="vna-score-row"><span class="vna-score-label">Потребность</span><div class="vna-score-bar"><div class="vna-score-fill warn" style="width:58%"></div></div><span class="vna-score-val">58%</span></div>
          <div class="vna-score-row"><span class="vna-score-label">Возражения</span><div class="vna-score-bar"><div class="vna-score-fill bad" style="width:35%"></div></div><span class="vna-score-val">35%</span></div>
          <div class="vna-score-row"><span class="vna-score-label">Next step</span><div class="vna-score-bar"><div class="vna-score-fill bad" style="width:22%"></div></div><span class="vna-score-val">22%</span></div>
        </div>
        <div>
          <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="checklist-greeting">
            <h3 style="font-size:17px;margin-bottom:10px;">Приветствие и установление контакта</h3>
            <p>Представление, уведомление о записи (152-ФЗ), цель звонка. Простые критерии — точность <strong>90–95%</strong>.</p>
          </div>
          <div class="vna-card nero-ai-reveal nero-ai-delay-2" id="checklist-needs" style="margin-top:16px;">
            <h3 style="font-size:17px;margin-bottom:10px;">Выявление потребности и работа с возражениями</h3>
            <p>Сложные критерии — <strong>60–70%</strong> без калибровки; после 50–100 звонков — 85–90%+ (Росгосстрах, «Лемана Про»).</p>
          </div>
        </div>
      </div>
      <div class="vna-card nero-ai-reveal" id="checklist-nextstep" style="margin-top:24px;">
        <h3 style="font-size:18px;margin-bottom:10px;">Фиксация следующего шага и причины потери сделки</h3>
        <p>Именно здесь AI чаще показывает «невидимые» потери. <strong>Итог:</strong> начните с 8–12 критериев, используйте 3–4 ключевых (Aiston / «Ленремонт»).</p>
      </div>
    </div>
  </section>

  <!-- #report -->
  <section class="vna-section vna-section-alt" id="report">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Лид-магнит</span>
        <h2>Пример отчёта AI-контроля:<br>где команда теряет сделки</h2>
      </div>
      <div class="vna-report-mock nero-ai-reveal">
        <div class="vna-report-head">
          <div><div style="font-size:13px;color:var(--vna-muted);">Звонок #1847 · менеджер А.</div><div class="vna-report-score">68<span style="font-size:18px;color:var(--vna-muted);">/100</span></div></div>
          <div class="vna-report-tags"><span class="vna-report-tag">нет next step</span><span class="vna-report-tag">возражение по цене</span><span class="vna-report-tag ok">приветствие ✓</span></div>
        </div>
        <blockquote class="vna-quote">«Дорого, пришлите КП на почту» — клиент, 04:12<cite>Менеджер не уточнил бюджет и не предложил встречу</cite></blockquote>
      </div>
      <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="report-pilot" style="margin-top:28px;">
        <h3 style="font-size:18px;margin-bottom:12px;">Разбор 10 звонков бесплатно</h3>
        <p>Score по каждому звонку, <strong>3 типовые потери сделки</strong>, рекомендации по критериям — на ваших записях из АТС.</p>
      </div>
    </div>
  </section>

  <div class="vna-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-report">
      <div class="ym-cta-block__icon" aria-hidden="true">📞</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Разберём 10 ваших звонков бесплатно</p>
        <p class="ym-cta-block__sub">Покажем score по чек-листу, 3 повторяющиеся потери сделки и рекомендации по критериям — на реальных записях из вашей АТС, не на демо.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <!-- #integrations -->
  <section class="vna-section" id="integrations">
    <div class="vna-cnt">
      <div class="vna-sh">
        <span class="vna-eyebrow">Связка с CRM</span>
        <h2>Интеграция AI-контроля звонков<br>с CRM и телефонией</h2>
      </div>
      <div class="vna-integ-pills nero-ai-reveal">
        <span class="vna-integ-pill">amoCRM</span><span class="vna-integ-pill">Битрикс24</span><span class="vna-integ-pill">Mango</span><span class="vna-integ-pill">UIS</span><span class="vna-integ-pill">Asterisk</span><span class="vna-integ-pill">Telegram</span>
      </div>
      <div class="vna-grid-2" style="margin-top:32px;">
        <div class="vna-card nero-ai-reveal" id="integrations-stack">
          <h3 style="font-size:18px;">amoCRM, Битрикс24, Mango, UIS, Asterisk</h3>
          <p>Webhook → очередь → транскрипт и score → поля в CRM. Для <a href="<?php echo esc_url($nero_public_base . '/vnedrenie-ai-amocrm/'); ?>">внедрения AI-агента в amoCRM</a> и смежных сценариев автоматизации воронки схема похожа: оценка звонка, теги и задачи попадают в карточку сделки. «Ленремонт»: охват QA <strong>~10% → 99%</strong>, нагрузка на ОКК <strong>−10×</strong>.</p>
        </div>
        <div class="vna-card nero-ai-reveal nero-ai-delay-1" id="integrations-crm-fields">
          <h3 style="font-size:18px;">Запись оценки в карточку сделки</h3>
          <p>Балл, саммари, нарушения чек-листа, таймкоды, задача при низком score — РОП видит причину без прослушивания 15-минутной записи.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #implementation -->
  <section class="vna-section vna-section-alt" id="implementation">
    <div class="vna-cnt">
      <div class="vna-sh"><span class="vna-eyebrow">Под ключ</span><h2>Внедрение AI-контроля под ключ:<br>этапы и сроки</h2></div>
      <div class="vna-timeline nero-ai-reveal">
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Аудит и чек-лист (3–5 дней)</h3><p>АТС, CRM, 152-ФЗ, 20–50 эталонных записей.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>MVP → продакшен</h3><p>2–4 недели MVP; 4–8 недель калибровка, дашборд, регламент ПДн.</p></div>
        <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Обучение и 152-ФЗ</h3><p>Серверы в РФ, разграничение доступа. Человек — спорные звонки и коучинг.</p></div>
      </div>
      <aside class="vna-callout vna-callout--soft nero-ai-reveal" aria-label="Дополнительно про обучение">
        <p><strong>Хотите разобраться в AI-аналитике до внедрения?</strong> Посмотрите материалы по автоматизации и внедрению AI в рабочие процессы — это поможет сформулировать ТЗ для отдела продаж и быстрее пройти аудит.</p>
        <p><a href="<?php echo esc_url($secondary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a></p>
      </aside>
    </div>
  </section>

  <!-- #audience -->
  <section class="vna-section" id="audience">
    <div class="vna-cnt">
      <div class="vna-sh"><span class="vna-eyebrow">ЦА</span><h2>AI-контроль качества звонков<br>для бизнеса: кому подходит</h2></div>
      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card" id="audience-sales"><div class="vna-eyebrow">Продажи</div><h3>B2B и B2C</h3><p>«Нетология»: цикл сделки <strong>72 ч</strong> vs <strong>84+</strong> ч.</p></div>
        <div class="vna-card nero-ai-delay-1" id="audience-cc"><div class="vna-eyebrow">Колл-центры</div><h3>Тысячи звонков</h3><p>«Лемана Про»: этапы продаж <strong>41% → 94%</strong>.</p></div>
        <div class="vna-card nero-ai-delay-2" id="audience-smb"><div class="vna-eyebrow">Малый бизнес</div><h3>3–5 менеджеров</h3><p>«Соль»: балл <strong>55–60% → 85%+</strong>.</p></div>
      </div>
    </div>
  </section>

  <!-- #cases -->
  <section class="vna-section vna-section-alt" id="cases">
    <div class="vna-cnt">
      <div class="vna-sh"><span class="vna-eyebrow">Кейсы</span><h2>Кейсы внедрения<br>AI-анализа звонков</h2></div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Компания</th><th>Было</th><th>Стало</th><th>Эффект</th></tr></thead>
          <tbody>
            <tr><td>«Лемана Про»</td><td>QA 1,5%</td><td>100%</td><td>Этапы 41%→94%</td></tr>
            <tr><td>Росгосстрах</td><td>QA 1%</td><td>100%</td><td>Инциденты — до 1 часа</td></tr>
            <tr><td>«Ленремонт»</td><td>~10%</td><td>99%</td><td>ОКК −10×</td></tr>
            <tr><td>«Соль»</td><td>10 мин</td><td>15 сек</td><td>Балл 55%→85%+</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- #pricing -->
  <section class="vna-section" id="pricing">
    <div class="vna-cnt">
      <div class="vna-sh"><span class="vna-eyebrow">Цена</span><h2>Стоимость внедрения<br>AI-контроля качества звонков</h2></div>
      <div class="vna-sh nero-ai-reveal"><span class="vna-price-badge">180–600 тыс. ₽</span><p>Проект под ключ: аудит, пилот 10 звонков, пайплайн ASR→LLM→CRM, дашборд, 152-ФЗ.</p></div>
    </div>
  </section>

  <!-- #faq -->
  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh"><span class="vna-eyebrow">FAQ</span><h2>Частые вопросы</h2></div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить AI-контроль в отдел продаж?</div><div class="vna-faq-a">10 записей бесплатно → аудит → MVP 2–4 недели → калибровка 50–100 звонков → продакшен 4–8 недель.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Интеграция с CRM и АТС?</div><div class="vna-faq-a">Mango, UIS, Asterisk + amoCRM, Битрикс24. Самописные — REST API.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Точность AI-оценки?</div><div class="vna-faq-a">Простые критерии 90–95%; сложные 60–70% без калибровки, 85–90%+ после.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">152-ФЗ?</div><div class="vna-faq-a">Уведомление, серверы в РФ, сроки хранения, аудит логов.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Для малого бизнеса?</div><div class="vna-faq-a">Да — пилот на 10 звонков до инвестиции.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Лучше ручного прослушивания?</div><div class="vna-faq-a">100% охват, единые критерии, секунды вместо дней, результат в CRM.</div></div>
      </div>
    </div>
  </section>

  <!-- #cta -->
  <section class="vna-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="vna-cnt" style="text-align:center;">
      <span class="vna-eyebrow">Бесплатный пилот</span>
      <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;">Проверьте звонки команды с AI</h2>
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final" style="margin:0;">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверьте звонки команды с AI — разбор 10 разговоров бесплатно</p>
          <p class="ym-cta-block__sub">Не презентация «как у всех», а ваш отчёт-пример: оценки, цитаты из транскриптов и три повторяющиеся потери. Дальше — MVP за 2–4 недели и дашборд для РОПа.</p>
          <ul class="vna-cta-checklist">
            <li>100% охват вместо выборочного прослушивания</li>
            <li>Интеграция с вашей CRM и телефонией</li>
            <li>Compliance по 152-ФЗ в проекте</li>
          </ul>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#pricing" class="nero-ai-btn nero-ai-btn-secondary">Стоимость внедрения</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.vna-content -->

<script>
(function(){document.querySelectorAll('.vna-faq-q').forEach(function(btn){btn.addEventListener('click',function(){var item=btn.closest('.vna-faq-item'),o=item.classList.contains('open');document.querySelectorAll('.vna-faq-item.open').forEach(function(el){el.classList.remove('open');});if(!o)item.classList.add('open');});});})();
</script>
<script>
(function(){var r=document.querySelector('.vna-content');if(!r)return;var i=r.querySelectorAll('.nero-ai-reveal');if('IntersectionObserver'in window){var o=new IntersectionObserver(function(e){e.forEach(function(n){if(n.isIntersecting){n.target.classList.add('nero-ai-active');o.unobserve(n.target);}});},{threshold:.1});i.forEach(function(x){o.observe(x);});}else{i.forEach(function(x){x.classList.add('nero-ai-active');});}})();
</script>

<?php
$cqa_page_url  = trailingslashit( get_permalink() );
$cqa_site_url  = trailingslashit( $nero_public_base );
$cqa_org_id    = $cqa_site_url . '#organization';
$cqa_web_id    = $cqa_site_url . '#website';
$cqa_schema    = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $cqa_org_id,
			'name'  => $brand ?: 'Nero Network',
			'url'   => $cqa_site_url,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $cqa_web_id,
			'url'       => $cqa_site_url,
			'name'      => $brand ?: 'Nero Network',
			'publisher' => [ '@id' => $cqa_org_id ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $cqa_page_url . '#webpage',
			'url'         => $cqa_page_url,
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $cqa_web_id ],
			'about'       => [ '@id' => $cqa_org_id ],
		],
		[
			'@type'           => 'BreadcrumbList',
			'@id'             => $cqa_page_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $cqa_site_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $cqa_page_url ],
			],
		],
		[
			'@type'       => 'Service',
			'@id'         => $cqa_page_url . '#service',
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'url'         => $cqa_page_url,
			'provider'    => [ '@id' => $cqa_org_id ],
		],
		[
			'@type'      => 'FAQPage',
			'@id'        => $cqa_page_url . '#faq',
			'mainEntity' => [
				[ '@type' => 'Question', 'name' => 'Как внедрить AI-контроль в отдел продаж?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '10 записей бесплатно → аудит → MVP 2–4 недели → калибровка 50–100 звонков → продакшен 4–8 недель.' ] ],
				[ '@type' => 'Question', 'name' => 'Интеграция с CRM и АТС?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Mango, UIS, Asterisk + amoCRM, Битрикс24. Самописные — REST API.' ] ],
				[ '@type' => 'Question', 'name' => 'Точность AI-оценки?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Простые критерии 90–95%; сложные 60–70% без калибровки, 85–90%+ после.' ] ],
				[ '@type' => 'Question', 'name' => '152-ФЗ?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Уведомление, серверы в РФ, сроки хранения, аудит логов.' ] ],
				[ '@type' => 'Question', 'name' => 'Для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да — пилот на 10 звонков до инвестиции.' ] ],
				[ '@type' => 'Question', 'name' => 'Лучше ручного прослушивания?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '100% охват, единые критерии, секунды вместо дней, результат в CRM.' ] ],
			],
		],
		[
			'@type'       => 'HowTo',
			'@id'         => $cqa_page_url . '#howto',
			'name'        => 'Как работает AI-контроль качества звонков: от записи до отчёта',
			'description' => 'Типовой пайплайн: запись → транскрибация → диаризация → LLM-анализ → результат в CRM.',
			'step'        => [
				[ '@type' => 'HowToStep', 'position' => 1, 'name' => 'Запись', 'text' => 'АТС/CRM сохраняет аудио и метаданные' ],
				[ '@type' => 'HowToStep', 'position' => 2, 'name' => 'ASR', 'text' => 'AI-транскрибация звонков в текст' ],
				[ '@type' => 'HowToStep', 'position' => 3, 'name' => 'Диаризация', 'text' => 'Разделение реплик менеджера и клиента' ],
				[ '@type' => 'HowToStep', 'position' => 4, 'name' => 'LLM', 'text' => 'AI-речевая аналитика и call scoring' ],
				[ '@type' => 'HowToStep', 'position' => 5, 'name' => 'CRM', 'text' => 'Оценка, теги, алерт РОПу' ],
			],
		],
	],
];
echo '<script type="application/ld+json">' . wp_json_encode( $cqa_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

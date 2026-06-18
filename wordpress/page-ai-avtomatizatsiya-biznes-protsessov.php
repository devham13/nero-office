<?php
/**
 * Template Name: AI-автоматизация бизнес-процессов: внедрение под ключ
 * Description: SEO-лендинг — AI-автоматизация бизнес-процессов под ключ. Нейросети, агенты, кейсы, стоимость. Квиз «Найти процессы для AI».
 */

$page_seo_title       = 'AI-автоматизация бизнес-процессов: внедрение под ключ';
$page_seo_description = 'AI-автоматизация бизнес-процессов под ключ: нейросети и агенты убирают рутину и ошибки. Аудит, кейсы, стоимость. Квиз «Найти процессы для AI».';

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

$brand = get_bloginfo( 'name' ) ?: ( getenv( 'SITE_BRAND' ) ?: '' ); // pragma: allowlist secret

$nero_ai_header_links = [
	[ 'label' => 'Что это', 'href' => '#chto-takoe' ],
	[ 'label' => 'Этапы', 'href' => '#etapy' ],
	[ 'label' => 'AI-агенты', 'href' => '#agenty' ],
	[ 'label' => 'Кейсы', 'href' => '#keisy' ],
	[ 'label' => 'Стоимость', 'href' => '#ceny' ],
	[ 'label' => 'FAQ', 'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Написать в Telegram';
$primary_cta_url   = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs = nero_ai_primary_cta_link_attrs( $primary_cta_url );

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if ( ! is_readable( $nero_ai_floating ) ) {
	require dirname( __DIR__ ) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
	require $nero_ai_floating;
}

?>

<?php nero_ai_echo_theme_styles( [ 'nero-ai-longread-ui-compat.css' ] ); ?>

<style>
/* Kadence reset + landing shell */
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

.aibp-hero { min-height: 100dvh; position: relative; }

.aibp-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aibp-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aibp-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid rgba(255,255,255,.10);border-radius:999px;font-size:13px;font-weight:600;color:#9aa8bd;transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.aibp-toc a:hover{border-color:rgba(121,242,255,.42);color:#79f2ff;background:rgba(121,242,255,.08);}

.aibp-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.aibp-content a.ym-link--accent{color:#79f2ff!important;text-decoration:underline!important;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.nero-ai-home-page .nero-ai-btn-primary.ym-btn--accent{color:#fff!important;}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* === AIBP PAGE SCOPED (Борис + тело статьи) === */
.aibp-content{
  --aibp-bg:#050711;--aibp-bg2:#080b17;
  --aibp-text:#e6edf7;--aibp-muted:#9aa8bd;--aibp-soft:#c7d2e5;--aibp-heading:#fff;
  --aibp-border:rgba(255,255,255,.10);
  --aibp-accent:#79f2ff;--aibp-violet:#8b5cf6;--aibp-green:#22c55e;--aibp-cyan:#79f2ff;
  --aibp-btn-from:#2563eb;--aibp-btn-to:#7c3aed;
  --aibp-r:18px;--aibp-r-lg:24px;--aibp-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aibp-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aibp-content *,.aibp-content *::before,.aibp-content *::after{box-sizing:border-box;}
.aibp-content p{color:var(--aibp-muted);line-height:1.72;margin:0 0 1em;}
.aibp-content h2,.aibp-content h3,.aibp-content h4{color:var(--aibp-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.aibp-content strong{color:var(--aibp-soft);}
.aibp-cnt{width:min(var(--aibp-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aibp-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aibp-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aibp-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aibp-sh.aibp-left{margin-left:0;text-align:left;}
.aibp-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aibp-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aibp-sh.aibp-left p{margin-left:0;}
.aibp-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aibp-accent);margin-bottom:14px;}
.aibp-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.aibp-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.aibp-intro-text{position:relative;padding-left:20px;}
.aibp-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aibp-accent),var(--aibp-violet));}
.aibp-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aibp-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.aibp-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aibp-heading);}
.aibp-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aibp-muted);}
@media(max-width:900px){.aibp-intro-grid{grid-template-columns:1fr;}}
.aibp-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aibp-table,.nero-ai-table.aibp-table{width:100%;border-collapse:collapse;font-size:14px;}
.aibp-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--aibp-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);}
.aibp-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aibp-text);vertical-align:top;}
.aibp-table tr:hover td{background:rgba(255,255,255,.03);}
.aibp-callout,.nero-ai-callout.aibp-callout{background:rgba(121,242,255,.06);border-left:3px solid var(--aibp-accent);border-radius:0 14px 14px 0;padding:18px 22px;margin:24px 0;}
.aibp-callout p{margin:0;color:var(--aibp-soft);}
.aibp-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aibp-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.aibp-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aibp-border);border-radius:var(--aibp-r-lg);padding:26px;}
@media(max-width:768px){.aibp-grid-2,.aibp-grid-3{grid-template-columns:1fr;}}
.aibp-checklist{list-style:none;padding:0;margin:20px 0;}
.aibp-checklist li{display:flex;align-items:flex-start;gap:12px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,.06);color:var(--aibp-muted);font-size:14.5px;}
.aibp-checklist li::before{content:'☐';color:var(--aibp-accent);font-size:16px;flex-shrink:0;}
.aibp-quote,.nero-ai-quote.aibp-quote{border-left:3px solid var(--aibp-violet);padding:20px 24px;margin:28px 0;background:rgba(139,92,246,.08);border-radius:0 16px 16px 0;font-style:italic;color:var(--aibp-soft);}
.aibp-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.nero-ai-faq-item,.aibp-faq details{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:0;}
.nero-ai-faq-item summary,.aibp-faq summary{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aibp-heading);cursor:pointer;list-style:none;}
.nero-ai-faq-item summary::-webkit-details-marker{display:none;}
.nero-ai-faq-item p,.aibp-faq details p{padding:0 24px 20px;margin:0;font-size:14.5px;}
.aibp-quiz-card{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border:1px solid rgba(139,92,246,.25);border-radius:24px;padding:40px;text-align:center;margin-top:24px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--aibp-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
</style>

<main id="primary" class="site-main nero-ai-home-page aibp-page" role="main" tabindex="-1">

<section class="nero-ai-hero aibp-hero" id="hero" aria-labelledby="aibp-hero-title">
<style>
/* ── Hero ai-avtomatizatsiya-biznes-protsessov: самодостаточные стили ── */
.aibp-hero {
  --aibp-cyan: #79f2ff;
  --aibp-violet: #8b5cf6;
  --aibp-green: #22c55e;
  --aibp-text: #e6edf7;
  --aibp-muted: #9aa8bd;
  --aibp-soft: #c7d2e5;
  --aibp-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(920px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background:
    radial-gradient(circle at 12% 7%, rgba(121, 242, 255, 0.14), transparent 28rem),
    radial-gradient(circle at 86% 12%, rgba(139, 92, 246, 0.18), transparent 34rem),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.aibp-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 72%);
  opacity: .45;
  pointer-events: none;
  z-index: 0;
}
.aibp-hero .nero-ai-container { width: min(1220px, calc(100% - 40px)); margin: 0 auto; position: relative; z-index: 1; }
.aibp-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aibp-hero .nero-ai-eyebrow {
  display: inline-flex; align-items: center; gap: 8px;
  margin: 0 0 16px; padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22); border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aibp-cyan) !important;
  font-size: 13px; font-weight: 750; line-height: 1;
  text-transform: uppercase; letter-spacing: 0.1em;
}
.aibp-hero h1 {
  margin: 0; max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px); line-height: .96;
  letter-spacing: -0.06em; color: #fff; font-weight: 900;
}
.aibp-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aibp-cyan) 42%, #c4b5fd 100%);
  -webkit-background-clip: text; background-clip: text;
  color: transparent !important;
}
.aibp-hero .nero-ai-hero-lead {
  margin: 22px 0 0; max-width: 720px;
  color: var(--aibp-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px); line-height: 1.58;
}
.aibp-hero .nero-ai-badges { display: flex; flex-wrap: wrap; gap: 10px; margin: 26px 0 0; padding: 0; list-style: none; }
.aibp-hero .nero-ai-badge {
  display: inline-flex; align-items: center; gap: 7px;
  padding: 8px 11px; border: 1px solid rgba(255,255,255,.11); border-radius: 999px;
  background: rgba(255,255,255,.055); color: #dce8f7;
  font-size: 13px; font-weight: 700;
}
.aibp-hero .nero-ai-btn-row { display: flex; flex-wrap: wrap; gap: 14px; margin-top: 34px; }
.aibp-hero .nero-ai-btn {
  display: inline-flex; align-items: center; justify-content: center;
  min-height: 48px; padding: 14px 20px; border-radius: 999px;
  border: 1px solid transparent; font-size: 15px; font-weight: 800;
  text-decoration: none !important;
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.aibp-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.aibp-hero .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--aibp-cyan), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aibp-hero .nero-ai-btn-secondary {
  color: var(--aibp-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aibp-hero .nero-ai-dashboard {
  position: relative; padding: 18px; border-radius: 34px;
  background: rgba(2, 6, 23, 0.42); box-shadow: var(--aibp-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.aibp-hero .nero-ai-dashboard-shell {
  overflow: hidden; border: 1px solid rgba(255,255,255,.12); border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aibp-hero .nero-ai-window-top {
  display: flex; align-items: center; justify-content: space-between; gap: 14px;
  padding: 14px 16px; border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aibp-hero .nero-ai-dots { display: flex; gap: 7px; }
.aibp-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aibp-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aibp-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aibp-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.aibp-hero .nero-ai-window-title {
  color: #cfe3f9; font-size: 11px; font-weight: 750;
  letter-spacing: .08em; text-transform: uppercase;
}
.aibp-hero .nero-ai-window-body { padding: 16px; }
.aibp-hero .nero-ai-dashboard-title {
  display: flex; align-items: flex-start; justify-content: space-between;
  gap: 16px; margin-bottom: 12px;
}
.aibp-hero .nero-ai-dashboard-title h3 {
  margin: 0; font-size: 18px; letter-spacing: -0.03em; color: #fff;
}
.aibp-hero .nero-ai-live-pill {
  display: inline-flex; align-items: center; gap: 7px;
  padding: 6px 9px; border-radius: 999px;
  background: rgba(34,197,94,.10); color: #bbf7d0;
  font-size: 12px; font-weight: 800;
}
.aibp-hero .nero-ai-live-pill::before {
  content: ""; width: 7px; height: 7px; border-radius: 50%;
  background: var(--aibp-green); animation: aibpPulse 2s ease-in-out infinite;
}
@keyframes aibpPulse { 0%,100%{opacity:1} 50%{opacity:.35} }
.aibp-hero .nero-ai-metrics-grid {
  display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; margin-bottom: 12px;
}
.aibp-hero .nero-ai-metric {
  padding: 12px; border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.aibp-hero .nero-ai-metric span { display: block; font-size: 11px; color: var(--aibp-muted); margin-bottom: 4px; }
.aibp-hero .nero-ai-metric strong { display: block; font-size: 22px; color: #fff; letter-spacing: -0.03em; }
.aibp-hero .nero-ai-metric small { display: block; font-size: 11px; color: #7dd3fc; margin-top: 2px; }
.aibp-hero .aibp-dash-canvas-wrap {
  position: relative; height: 148px; margin: 10px 0 12px;
  border-radius: 16px; overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.12);
  background: rgba(0, 0, 0, 0.25);
}
.aibp-hero .aibp-dash-canvas-wrap canvas { display: block; width: 100%; height: 100%; }
.aibp-hero .nero-ai-task-stream { display: flex; flex-direction: column; gap: 8px; }
.aibp-hero .nero-ai-task {
  display: grid; grid-template-columns: 34px 1fr auto; gap: 10px; align-items: center;
  padding: 10px 12px; border-radius: 14px;
  border: 1px solid rgba(255,255,255,.07); background: rgba(255,255,255,.03);
}
.aibp-hero .nero-ai-task-icon {
  width: 34px; height: 34px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  background: rgba(121, 242, 255, 0.12); color: #bae6fd;
  font-size: 11px; font-weight: 800;
}
.aibp-hero .nero-ai-task strong { display: block; color: #fff; font-size: 13px; }
.aibp-hero .nero-ai-task span { display: block; color: var(--aibp-muted); font-size: 11px; margin-top: 2px; }
.aibp-hero .nero-ai-status {
  padding: 4px 8px; border-radius: 999px; font-size: 10px; font-weight: 800;
  background: rgba(34,197,94,.12); color: #86efac;
}
.aibp-hero .nero-ai-status--amber { background: rgba(245,158,11,.12); color: #fcd34d; }
.aibp-hero .aibp-flow-pill {
  margin-top: 10px; text-align: center; font-size: 11px; font-weight: 700;
  letter-spacing: .06em; text-transform: uppercase; color: #7dd3fc;
}
@media (max-width: 980px) {
  .aibp-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aibp-hero .nero-ai-dashboard { transform: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai автоматизация процессов</p>
      <h1 id="aibp-hero-title">AI-автоматизация бизнес-процессов: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Убираем ручную рутину и ошибки в повторяемых операциях с помощью нейросетей и AI-агентов — без полной перестройки компании. Старт — квиз и чек-лист процессов для автоматизации.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Аудит процесса</li>
        <li class="nero-ai-badge">AI-агенты</li>
        <li class="nero-ai-badge">CRM и 1С</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs ?? ''; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kviz">Найти процессы для AI</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-операционного центра процессов">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-операционный центр · процессы</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Процессов в работе</span><strong>12</strong><small>активных цепочек</small></div>
            <div class="nero-ai-metric"><span>Время цикла</span><strong>−68%</strong><small>после пилота</small></div>
            <div class="nero-ai-metric"><span>Ошибки ввода</span><strong>−75%</strong><small>ручной ввод</small></div>
            <div class="nero-ai-metric"><span>Рутина</span><strong>−38%</strong><small>высвобождено</small></div>
          </div>

          <div class="aibp-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aibp-hero-canvas" role="img" aria-label="Анимация: потоки процессов проходят триггер, AI-агента, CRM/1С и эскалацию оператору"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Поток задач автоматизации">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↳</span>
              <div><strong>Триггер (письмо/форма)</strong><span>Вход в цепочку · webhook</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>AI-агент (классификация)</strong><span>Intent → маршрут и контекст</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>CRM / 1С (действие)</strong><span>Поля · документ · задача</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">👤</span>
              <div><strong>Эскалация (человек)</strong><span>confidence 0.82 · review</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
          </div>
          <p class="aibp-flow-pill">Триггер → AI-агент → CRM/1С → Эскалация</p>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="aibp-content">
<!-- INTRO -->
  <section class="aibp-intro aibp-section" id="chto-takoe" aria-label="Введение">
    <div class="aibp-cnt">
      <div class="aibp-intro-grid nero-ai-reveal">
        <div class="aibp-intro-text">
          <p class="aibp-eyebrow">Лонгрид · ai автоматизация</p>
          <p>Ручная рутина, ошибки при переносе данных между системами и «чёрные ящики» в операциях — типичная картина, когда компания растёт быстрее, чем успевает выстроить процессы. <strong>AI-автоматизация бизнес-процессов</strong> решает эту задачу иначе, чем классические скрипты: нейросети и <strong>AI-агенты</strong> не только подсказывают текст, а <strong>выполняют действия</strong> — заполняют CRM, готовят документы, маршрутизируют заявки, сверяют данные — с эскалацией человеку на критичных шагах. Nero Network внедряет такие цепочки <strong>под ключ</strong>: от аудита одного процесса до масштабирования на отдел без полной перестройки компании.</p>
          <p><strong>Коротко:</strong> если операция повторяется, имеет правила и оставляет цифровой след — её можно автоматизировать агентом. Старт — с бесплатного аудита и квиза «Найти процессы для AI».</p>
        </div>
        <div class="aibp-intro-kpi" aria-label="Ключевые метрики рынка">
          <div class="aibp-kpi-card"><div class="kv">40%</div><div class="kl">приложений с AI-агентами к 2026</div></div>
          <div class="aibp-kpi-card"><div class="kv">×5</div><div class="kl">рост корп. GenAI в РФ за год</div></div>
          <div class="aibp-kpi-card"><div class="kv">10–15%</div><div class="kl">компаний на зрелости внедрения</div></div>
          <div class="aibp-kpi-card"><div class="kv">200 тыс.+</div><div class="kl">ориентир PoC под ключ</div></div>
        </div>
      </div>

      <div class="aibp-sh aibp-left nero-ai-reveal" style="margin-top:48px;">
        <h2>Что такое AI-автоматизация бизнес-процессов и зачем она компании</h2>
      </div>

      <div class="nero-ai-reveal">
        <p><strong>Определение.</strong> AI-автоматизация бизнес-процессов — внедрение AI-агентов и нейросетей в повторяемые цепочки работы: заявки, документы, согласования, поддержка, закупки, отчётность. Агент получает триггер (письмо, форма, событие в CRM), понимает контекст, выполняет шаги в подключённых системах и передаёт результат человеку, если уверенность низкая или действие критично.</p>
        <p>По данным Gartner, к концу 2026 года <strong>до 40% корпоративных приложений</strong> получат task-specific AI-агентов — против менее 5% в 2025 году. В России корпоративный GenAI вырос примерно <strong>в 5 раз за год</strong> (Strategy Partners, 2025), но до промышленной зрелости дошли лишь <strong>10–15%</strong> компаний.</p>

        <h3>Чем отличается от обычной автоматизации процессов</h3>
        <div class="aibp-table-wrap">
          <table class="aibp-table nero-ai-table">
            <thead><tr><th>Критерий</th><th>RPA / no-code без AI</th><th>AI-агент</th></tr></thead>
            <tbody>
              <tr><td>Входные данные</td><td>Структурированные</td><td>Текст, документы, диалог</td></tr>
              <tr><td>Изменение сценария</td><td>Переписывание правил</td><td>Донастройка промптов и guardrails</td></tr>
              <tr><td>Действия в системах</td><td>По API или UI-скрипт</td><td>API + computer use для legacy</td></tr>
              <tr><td>Ошибки</td><td>Жёсткий отказ</td><td>Классификация + эскалация человеку</td></tr>
            </tbody>
          </table>
        </div>

        <h3>Какие задачи решает AI-автоматизация бизнес-процессов</h3>
        <ol style="color:var(--aibp-muted);padding-left:1.2em;line-height:1.72;">
          <li><strong>Сокращение ручного труда</strong> на повторяемых операциях.</li>
          <li><strong>Снижение ошибок</strong> за счёт извлечения полей из документов и кросс-проверок.</li>
          <li><strong>Ускорение цикла</strong> — в кейсах Сбера время подготовки закупочной заявки сократилось <strong>с 60 до 5 минут</strong> (×12).</li>
          <li><strong>Прозрачность</strong> — логи действий агента, метрики, точки контроля.</li>
          <li><strong>Масштабирование без линейного роста штата</strong>.</li>
        </ol>
        <div class="aibp-callout nero-ai-callout"><p><strong>Итог блока:</strong> AI-автоматизация бизнес-процессов — это не «ещё один чат-бот», а исполнитель повторяемых операций с правилами и человеком на финишной прямой.</p></div>
      </div>
    </div>
  </section>

  <div class="aibp-toc-outer">
    <div class="aibp-cnt">
      <nav class="aibp-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что это</a>
        <a href="#kogda-nuzhna">Когда нужна</a>
        <a href="#agenty">AI-агенты</a>
        <a href="#etapy">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#kviz">Квиз</a>
      </nav>
    </div>
  </div>

  <!-- БОЛИ -->
  <section class="aibp-section aibp-section-alt" id="kogda-nuzhna">
    <div class="aibp-cnt">
      <div class="aibp-sh">
        <span class="aibp-eyebrow">Боли ЦА</span>
        <h2>Когда бизнесу нужна AI-автоматизация: рутина, ошибки и слабая управляемость</h2>
        <p>Триггеры: часы на однотипные действия, ошибки при вводе, непрозрачный статус заявок, рост обращений без пропорционального найма.</p>
      </div>

      <h3>Типовые процессы с высокой долей ручного труда</h3>
      <div class="aibp-table-wrap nero-ai-reveal">
        <table class="aibp-table nero-ai-table">
          <thead><tr><th>Направление</th><th>Примеры операций</th><th>Потенциал AI</th></tr></thead>
          <tbody>
            <tr><td>Продажи</td><td>Квалификация лидов, КП, напоминания</td><td>Высокий</td></tr>
            <tr><td>Поддержка</td><td>Первичная линия, база знаний, тикеты</td><td>Очень высокий</td></tr>
            <tr><td>Документооборот</td><td>Счета, акты, сверки</td><td>Высокий</td></tr>
            <tr><td>HR</td><td>Скрининг резюме, онбординг</td><td>Средний</td></tr>
            <tr><td>Закупки</td><td>ТЗ, заявки, согласования</td><td>Высокий</td></tr>
            <tr><td>Отчётность</td><td>Сбор данных, сводки</td><td>Средний–высокий</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Сколько стоит бездействие: ошибки сотрудников и потери времени</h3>
      <p class="nero-ai-reveal">McKinsey State of AI 2025: <strong>88%</strong> организаций используют AI, но лишь <strong>~39%</strong> видят EBIT-эффект — разница в <strong>перепроектировании workflow</strong>. Ориентиры из российских внедрений: «АкваКлин» — ошибки <strong>8%→2%</strong>, время <strong>12→3 мин</strong>; «Битрикс24» — <strong>&gt;65%</strong> запросов без оператора; «Альфа-Лизинг» — первичка <strong>~20 мин → пара минут</strong>.</p>
      <div class="aibp-callout nero-ai-callout nero-ai-reveal"><p><strong>Коротко:</strong> чем выше повторяемость и чем чётче регламент — тем быстрее окупается пилот. Один «узкий» процесс с 20–40 операциями в день легко съедает <strong>1–2 ставки</strong> в год.</p></div>
    </div>
  </section>

  <!-- ========== БОРИС: ВИЗУАЛЬНЫЙ БЛОК (после #kogda-nuzhna) ========== -->
  <section id="ai-avtomatizatsiya-biznes-protsessov-boris-block" class="aibp-b-root" aria-label="Анимация: оркестрация AI-агентов между CRM, 1С, почтой и оператором">
<style>
/* === БОРИС: prefix aibp-b-, scoped внутри #ai-avtomatizatsiya-biznes-protsessov-boris-block === */
#ai-avtomatizatsiya-biznes-protsessov-boris-block.aibp-b-root{
  padding:56px 0 64px;
  background:#f1f5f9;
}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-cnt{
  max-width:1160px;margin:0 auto;padding:0 24px;
}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-card{grid-template-columns:1fr;min-height:auto;}
}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#0891b2;margin:0 0 14px;
}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-ey::before{
  content:'';width:18px;height:2px;background:#0891b2;border-radius:1px;
}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-ul{
  list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;
}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(8,145,178,.1);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#0e7490;margin-top:1px;font-style:normal;
}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-pl-c{background:rgba(8,145,178,.08);color:#0e7490;border:1.5px solid rgba(8,145,178,.22);}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-rgt{
  position:relative;
  background:linear-gradient(145deg,#ecfeff 0%,#f0f9ff 35%,#faf5ff 70%,#f8fafc 100%);
  min-height:420px;overflow:hidden;
}
@media(max-width:1023px){#ai-avtomatizatsiya-biznes-protsessov-boris-block .aibp-b-rgt{min-height:360px;}}
#aibp-orchestrator-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="aibp-b-cnt">
  <div class="aibp-b-card">
    <div class="aibp-b-lft">
      <span class="aibp-b-ey">Оркестрация процессов</span>
      <h3 class="aibp-b-h3">Один агент — несколько систем: заявка проходит цепочку без ручного копипаста</h3>
      <ul class="aibp-b-ul">
        <li><span class="aibp-b-ic">⚡</span>Триггер: письмо, форма, webhook CRM — агент классифицирует задачу</li>
        <li><span class="aibp-b-ic">◎</span>Контекст из RAG, справочников и истории клиента подтягивается автоматически</li>
        <li><span class="aibp-b-ic">↔</span>Действия в CRM, 1С, почте и мессенджерах — по правилам guardrails</li>
        <li><span class="aibp-b-ic">👤</span>Низкая уверенность или критичный шаг — эскалация оператору (human-in-the-loop)</li>
      </ul>
      <div class="aibp-b-pills">
        <span class="aibp-b-pl aibp-b-pl-c">Триггер → агент → системы</span>
        <span class="aibp-b-pl aibp-b-pl-g">−68% время цикла*</span>
        <span class="aibp-b-pl aibp-b-pl-v">Мультиагент 2026</span>
      </div>
      <p class="aibp-b-foot">Дальше разберём сценарии AI-агентов по направлениям бизнеса →</p>
    </div>
    <div class="aibp-b-rgt">
      <canvas id="aibp-orchestrator-canvas" role="img" aria-label="Анимация: узлы CRM, 1С, почта и оператор связаны оркестратором AI-агентов, задачи движутся по цепочке"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('aibp-orchestrator-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, t = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    hub:'#8b5cf6', hubGlow:'rgba(139,92,246,.25)',
    crm:'#3b82f6', erp:'#eab308', mail:'#06b6d4', msg:'#22c55e', human:'#f97316',
    line:'rgba(100,116,139,.35)', pkt:'#0891b2', text:'#0f172a', muted:'#64748b', white:'#fff'
  };

  var nodes = [
    {id:'hub', label:'Оркестратор', sub:'AI-агент', x:.5, y:.5, r:38, color:C.hub},
    {id:'crm', label:'CRM', sub:'amoCRM / B24', x:.18, y:.28, r:28, color:C.crm},
    {id:'erp', label:'1С / ERP', sub:'учёт', x:.82, y:.28, r:28, color:C.erp},
    {id:'mail', label:'Почта', sub:'IMAP', x:.15, y:.72, r:26, color:C.mail},
    {id:'msg', label:'Мессенджер', sub:'TG / WA', x:.5, y:.82, r:26, color:C.msg},
    {id:'human', label:'Оператор', sub:'HITL', x:.85, y:.72, r:26, color:C.human}
  ];

  var edges = [
    ['crm','hub'],['hub','erp'],['mail','hub'],['hub','msg'],['hub','human'],['erp','human']
  ];

  var packets = [
    {from:'mail', to:'hub', phase:0, color:C.mail},
    {from:'hub', to:'crm', phase:.22, color:C.crm},
    {from:'crm', to:'hub', phase:.38, color:C.crm},
    {from:'hub', to:'erp', phase:.55, color:C.erp},
    {from:'hub', to:'human', phase:.72, color:C.human},
    {from:'hub', to:'msg', phase:.88, color:C.msg}
  ];

  function nodeById(id){ for(var i=0;i<nodes.length;i++) if(nodes[i].id===id) return nodes[i]; return nodes[0]; }
  function pos(n){ return {x:n.x*W, y:n.y*H}; }

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r); else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawNode(n, pulse){
    var p = pos(n);
    var glow = n.id==='hub' ? 12 + pulse*6 : 4;
    ctx.beginPath();
    ctx.arc(p.x,p.y,n.r+glow,0,Math.PI*2);
    ctx.fillStyle = n.id==='hub' ? C.hubGlow : 'rgba(0,0,0,.04)';
    ctx.fill();
    ctx.beginPath();
    ctx.arc(p.x,p.y,n.r,0,Math.PI*2);
    ctx.fillStyle = n.color;
    ctx.fill();
    ctx.strokeStyle = 'rgba(255,255,255,.85)';
    ctx.lineWidth = 2.5;
    ctx.stroke();
    ctx.fillStyle = C.white;
    ctx.font = 'bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(n.label, p.x, p.y+4);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText(n.sub, p.x, p.y+n.r+14);
  }

  function drawEdge(a,b){
    var pa=pos(a), pb=pos(b);
    var dx=pb.x-pa.x, dy=pb.y-pa.y, len=Math.sqrt(dx*dx+dy*dy)||1;
    var sx=pa.x+dx/len*a.r*0.6, sy=pa.y+dy/len*a.r*0.6;
    var ex=pb.x-dx/len*b.r*0.55, ey=pb.y-dy/len*b.r*0.55;
    ctx.beginPath();
    ctx.moveTo(sx,sy);
    ctx.lineTo(ex,ey);
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([6,5]);
    ctx.stroke();
    ctx.setLineDash([]);
  }

  function drawPacket(pk, prog){
    var a=nodeById(pk.from), b=nodeById(pk.to);
    var pa=pos(a), pb=pos(b);
    var x=pa.x+(pb.x-pa.x)*prog, y=pa.y+(pb.y-pa.y)*prog;
    ctx.beginPath();
    ctx.arc(x,y,5,0,Math.PI*2);
    ctx.fillStyle = pk.color;
    ctx.fill();
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 1.5;
    ctx.stroke();
  }

  function loop(){
    t += 0.012;
    var pulse = (Math.sin(t*2)+1)/2;
    ctx.clearRect(0,0,W,H);

    /* subtle grid */
    ctx.strokeStyle = 'rgba(148,163,184,.12)';
    ctx.lineWidth = 1;
    for(var gx=0;gx<W;gx+=32){ ctx.beginPath();ctx.moveTo(gx,0);ctx.lineTo(gx,H);ctx.stroke(); }
    for(var gy=0;gy<H;gy+=32){ ctx.beginPath();ctx.moveTo(0,gy);ctx.lineTo(W,gy);ctx.stroke(); }

    for(var e=0;e<edges.length;e++){
      drawEdge(nodeById(edges[e][0]), nodeById(edges[e][1]));
    }
    for(var i=0;i<packets.length;i++){
      var prog = (packets[i].phase + t*0.15) % 1;
      drawPacket(packets[i], prog);
    }
    for(var j=0;j<nodes.length;j++) drawNode(nodes[j], pulse);

    /* legend pill */
    rr(12,H-36, W>400?200:W-24, 24, 8, 'rgba(255,255,255,.92)', 'rgba(148,163,184,.3)', 1);
    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Демо-логика: триггер → оркестратор → системы → человек', 22, H-20);

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>
  <!-- ========== /БОРИС ========== -->

  <!-- AI-АГЕНТЫ -->
  <section class="aibp-section" id="agenty">
    <div class="aibp-cnt">
      <div class="aibp-sh">
        <span class="aibp-eyebrow">Технология 2026</span>
        <h2>AI-агенты и нейросети для автоматизации бизнес-процессов</h2>
        <p>Переход от assistive AI к outcome-focused workflow. Microsoft Copilot Studio — GA computer-using agents. Gartner предупреждает о agent washing.</p>
      </div>

      <h3>Сценарии агентов: продажи, поддержка, документооборот, HR, закупки, отчётность</h3>
      <div class="aibp-grid-2 nero-ai-reveal">
        <div class="aibp-card"><h4>Продажи</h4><p>Классификация заявок, обогащение CRM, черновик КП, напоминания менеджеру.</p></div>
        <div class="aibp-card"><h4>Поддержка</h4><p>RAG + тикеты. «Битрикс24» — <strong>&gt;65%</strong> без оператора, CSAT <strong>90%</strong>.</p></div>
        <div class="aibp-card"><h4>Документооборот</h4><p>Извлечение полей из PDF, сверка (DaData MCP в кейсе «Альфа-Лизинг»).</p></div>
        <div class="aibp-card"><h4>Закупки</h4><p>«Акрон» — ТЗ <strong>с дней до минут</strong>; Сбер — цепочка «от заявки до оплаты».</p></div>
      </div>

      <h3>Low-code агенты (Copilot Studio, Make, n8n) vs кастомные интеграции</h3>
      <div class="aibp-table-wrap nero-ai-reveal">
        <table class="aibp-table nero-ai-table">
          <thead><tr><th>Подход</th><th>Когда подходит</th><th>Ограничения</th><th>Срок старта</th></tr></thead>
          <tbody>
            <tr><td><strong>Make / n8n</strong></td><td>Простые цепочки, есть API</td><td>Сложный governance, legacy без API</td><td>2–4 недели</td></tr>
            <tr><td><strong>Copilot Studio</strong></td><td>Экосистема Microsoft, computer use</td><td>Лицензии, данные за рубежом</td><td>3–6 недель</td></tr>
            <tr><td><strong>Кастом Nero Network</strong></td><td>CRM+1С+мессенджеры, 152-ФЗ</td><td>Нужна проектная команда</td><td>2–4 недели PoC</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ЭТАПЫ + CTA #1 -->
  <section class="aibp-section aibp-section-alt" id="etapy">
    <div class="aibp-cnt">
      <div class="aibp-sh aibp-left">
        <span class="aibp-eyebrow">Под ключ</span>
        <h2>Внедрение AI в бизнес-процессы: этапы от аудита до запуска</h2>
        <p>Модель Nero Network: <strong>аудит → PoC → пилот → масштаб</strong>.</p>
      </div>

      <h3>Аудит и приоритизация процессов (чек-лист)</h3>
      <p>Бесплатный аудит <strong>одного процесса</strong> — вход в воронку и лид-магнит «Чек-лист процессов для автоматизации».</p>
      <ul class="aibp-checklist nero-ai-reveal">
        <li>Операция повторяется <strong>&gt;50 раз в месяц</strong></li>
        <li>Есть письменный регламент или понятные примеры</li>
        <li>Исход «правильно / неправильно» можно проверить</li>
        <li>Есть цифровой след (CRM, почта, 1С)</li>
        <li>Эскалация на человека технически возможна</li>
      </ul>

      <h3>Пилот, интеграции и масштабирование</h3>
      <p><strong>PoC за 2–4 недели</strong> с одной метрикой: время цикла, % ошибок, cost per operation. Логика: триггер → классификация → действия → guardrails → эскалация → аналитика.</p>

      <h3>Governance, безопасность данных и границы автономии агентов</h3>
      <p>Gartner: <strong>&gt;40% agentic AI-проектов будут отменены к 2027</strong>. Матрица автономии, audit log, human-in-the-loop на платежах и договорах, 152-ФЗ и закрытый контур.</p>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
        <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Бесплатный аудит одного процесса — с чек-листом</p>
          <p class="ym-cta-block__sub">За 2–3 рабочих дня составим карту as-is, оценим повторяемость, API и риски. На выходе — приоритетный процесс для PoC и ориентир ROI без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <!-- ПОД КЛЮЧ + CTA #2 -->
  <section class="aibp-section" id="pod-klyuch">
    <div class="aibp-cnt">
      <div class="aibp-sh aibp-left">
        <h2>AI-автоматизация бизнес-процессов под ключ или своими силами</h2>
      </div>
      <h3>Когда достаточно no-code, а когда нужна разработка и интеграция</h3>
      <p><strong>No-code</strong> — API и линейный процесс. <strong>UI-агент</strong> — legacy без API. <strong>Кастом</strong> — несколько систем, сложные правила, 152-ФЗ.</p>
      <h3>AI-автоматизация бизнес-процессов без программиста — реально ли</h3>
      <p>Частично — база знаний и правила эскалации ведёт операционист. Интеграции и guardrails — обычно с разработчиком или подрядчиком.</p>
      <div class="aibp-callout nero-ai-callout"><p><strong>Итог:</strong> под ключ выгодно, когда нужен <strong>измеримый результат за 2–6 недель</strong> и один ответственный за весь контур.</p></div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите внедрять AI своими силами — с пониманием рисков?</p>
          <p class="ym-cta-block__sub">Перед пилотом полезно разобраться в n8n, промптах, guardrails и human-in-the-loop — так команда быстрее согласует сценарии с IT. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- МСБ -->
  <section class="aibp-section aibp-section-alt" id="msb">
    <div class="aibp-cnt">
      <div class="aibp-sh">
        <h2>AI-автоматизация для малого и среднего бизнеса</h2>
      </div>
      <div class="aibp-grid-2 nero-ai-reveal">
        <div class="aibp-card">
          <h3>Быстрые победы для малого бизнеса</h3>
          <p>Заказы в мессенджере + CRM («АкваКлин»); автоответы с сайта; первичка почты. Бюджет пилота <strong>200–400 тыс. ₽</strong>.</p>
        </div>
        <div class="aibp-card">
          <h3>Масштабирование на средний бизнес</h3>
          <p>Один агент → соседний процесс → оркестратор. Дашборд для COO: время, ошибки, загрузка людей.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ИНТЕГРАЦИИ -->
  <section class="aibp-section" id="integracii">
    <div class="aibp-cnt">
      <div class="aibp-sh">
        <h2>Интеграция AI-автоматизации с CRM, 1С, почтой и ERP</h2>
      </div>
      <div class="aibp-grid-3 nero-ai-reveal">
        <div class="aibp-card"><h3>CRM</h3><p>Лид → классификация → поля → задача. <a href="/vnedrenie-ai-amocrm/">внедрение AI в amoCRM</a></p></div>
        <div class="aibp-card"><h3>1С / ERP</h3><p>Счета, акты, остатки. <a href="/ai-1c-erp/">AI для 1С и ERP</a></p></div>
        <div class="aibp-card"><h3>Почта</h3><p><a href="/vnedrenie-ai-obrabotka-email-crm/">обработка email с AI в CRM</a></p></div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
      <div class="aibp-callout nero-ai-callout"><p><strong>Коротко:</strong> интеграция — 60–70% успеха; модель без интеграции остаётся чатом.</p></div>
    </div>
  </section>

  <!-- КЕЙСЫ -->
  <section class="aibp-section aibp-section-alt" id="keisy">
    <div class="aibp-cnt">
      <div class="aibp-sh">
        <h2>Кейсы и примеры внедрения AI-автоматизации бизнес-процессов</h2>
      </div>
      <div class="aibp-table-wrap nero-ai-reveal">
        <table class="aibp-table nero-ai-table">
          <thead><tr><th>Компания</th><th>Процесс</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>Сбербанк</td><td>Закупки</td><td>Время заявки <strong>60→5 мин</strong></td></tr>
            <tr><td>«Акрон Холдинг»</td><td>ТЗ на закупки</td><td><strong>Дни → минуты</strong>, &gt;400 ТЗ / 4 мес.</td></tr>
            <tr><td>«Альфа-Лизинг»</td><td>Первичка</td><td><strong>~20 мин → 2 мин</strong></td></tr>
            <tr><td>«Битрикс24»</td><td>Поддержка</td><td><strong>&gt;65%</strong> без оператора</td></tr>
            <tr><td>«АкваКлин» (МСБ)</td><td>Заказы</td><td>Ошибки <strong>8→2%</strong>, окупаемость <strong>~3 мес.</strong></td></tr>
          </tbody>
        </table>
      </div>
      <blockquote class="aibp-quote nero-ai-quote nero-ai-reveal">
        «Мы переходим от простой автоматизации к цифровым процессам нового поколения, в которых ИИ становится полноценным участником бизнес-процессов» — <strong>Тарас Скворцов</strong>, финдиректор Сбербанка (CNews, 2026).
      </blockquote>
    </div>
  </section>

  <!-- СТОИМОСТЬ + CTA #3 -->
  <section class="aibp-section" id="ceny">
    <div class="aibp-cnt">
      <div class="aibp-sh">
        <h2>Стоимость AI-автоматизации бизнес-процессов: из чего складывается цена</h2>
        <p>Ориентир чека: <strong>200 тыс.–1,8 млн ₽</strong>.</p>
      </div>
      <div class="aibp-table-wrap nero-ai-reveal">
        <table class="aibp-table nero-ai-table">
          <thead><tr><th>Фактор</th><th>Влияние на смету</th></tr></thead>
          <tbody>
            <tr><td>Число систем и качество API</td><td>Высокое</td></tr>
            <tr><td>Объём кастомной логики / правил</td><td>Высокое</td></tr>
            <tr><td>Требования 152-ФЗ, on-prem</td><td>Среднее–высокое</td></tr>
            <tr><td>Число агентов и каналов</td><td>Среднее</td></tr>
          </tbody>
        </table>
      </div>
      <p><strong>Пакеты:</strong> аудит + PoC — от <strong>200 тыс. ₽</strong>; пилот с интеграциями — <strong>400–800 тыс. ₽</strong>; несколько процессов — до <strong>1,8 млн ₽</strong>.</p>

      <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте бюджет под ваши процессы</p>
          <p class="ym-cta-block__sub">Ориентир 200 тыс.–1,8 млн ₽ в зависимости от интеграций. Пройдите квиз или напишите нам — подготовим смету PoC / пилот / масштаб после аудита.</p>
          <div class="ym-cta-block__actions">
            <a href="#kviz" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent">Найти процессы для AI</a>
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="aibp-section aibp-section-alt" id="faq">
    <div class="aibp-cnt">
      <div class="aibp-sh">
        <h2>Частые вопросы об AI-автоматизации бизнес-процессов</h2>
      </div>
      <div class="aibp-faq nero-ai-reveal">
        <details class="nero-ai-faq-item" open>
          <summary>Как внедрить AI-автоматизацию бизнес-процессов пошагово</summary>
          <p>Квиз и чек-лист → аудит одного процесса → PoC 2–4 недели с human-in-the-loop → пилот → масштабирование и governance.</p>
        </details>
        <details class="nero-ai-faq-item">
          <summary>Сколько стоит внедрение и что входит в «под ключ»</summary>
          <p>Проектирование, интеграции, настройка агента, обучение, мониторинг первого месяца. Цена — от <strong>200 тыс. ₽</strong> за PoC.</p>
        </details>
        <details class="nero-ai-faq-item">
          <summary>Какие процессы автоматизировать первыми</summary>
          <p>Поддержка, входящие заявки, первичные документы, статусные коммуникации. Не начинайте с безусловных платежей без пилота.</p>
        </details>
        <details class="nero-ai-faq-item">
          <summary>Нужны ли программисты и как обеспечить безопасность данных</summary>
          <p>Программисты нужны на интеграции и guardrails. Безопасность: российские LLM, закрытый контур, маскирование ПДн, audit log.</p>
        </details>
        <details class="nero-ai-faq-item">
          <summary>Чем агент отличается от чат-бота?</summary>
          <p>Агент выполняет действия в системах; бот в основном отвечает текстом.</p>
        </details>
        <details class="nero-ai-faq-item">
          <summary>Можно ли без полной перестройки компании?</summary>
          <p>Да — модель «один процесс → масштаб» — базовый подход Nero Network.</p>
        </details>
      </div>
    </div>
  </section>

  <!-- КВИЗ / ФИНАЛ -->
  <section class="aibp-section" id="kviz">
    <div class="aibp-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Найдите процессы для AI-автоматизации в вашей компании</p>
          <p class="ym-cta-block__sub">Квиз за 3–5 минут + чек-лист процессов для автоматизации. Затем — бесплатный аудит одного процесса с цифрами PoC.</p>
          <div class="ym-cta-block__actions">
            <a href="#kviz" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent">Пройти квиз</a>
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          </div>
        </div>
      </div>
      <div class="aibp-quiz-card nero-ai-reveal" aria-label="Заглушка квиза">
        <p style="color:var(--aibp-muted);margin:0;">Виджет квиза «Найти процессы для AI» — подключение на этапе публикации.</p>
      </div>
    </div>
  </section>
</div><!-- /.aibp-content -->

<!-- SCHEMA-MARKUP:INSERT -->
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const canvas = document.getElementById('aibp-hero-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let cw = 0, ch = 0, frame = 0;
  const bubbles = [];

  function resize() {
    const p = canvas.parentElement;
    if (!p) return;
    canvas.width = p.clientWidth;
    canvas.height = p.clientHeight;
    cw = canvas.width;
    ch = canvas.height;
  }
  window.addEventListener('resize', resize);
  resize();

  const C = {
    outline: '#0f172a',
    cyan: '#79f2ff',
    violet: '#8b5cf6',
    green: '#22c55e',
    amber: '#f59e0b',
    river: 'rgba(121,242,255,0.35)',
    panel: 'rgba(15,23,42,0.9)',
    text: '#94a3b8',
    agentY: '#eab308', agentG: '#10b981', agentB: '#3b82f6', agentP: '#ec4899', agentV: '#8b5cf6'
  };

  function roundRect(x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function createBubble(x, y, text) {
    bubbles.push({ x, y, text, life: 0, max: 140 });
  }

  class ProcessRiver {
    constructor(x, y, h) { this.x = x; this.y = y; this.h = h; }
    draw() {
      const off = (frame * 0.6) % 24;
      ctx.strokeStyle = C.river;
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.moveTo(this.x, this.y);
      ctx.bezierCurveTo(this.x + 18, this.y + this.h * 0.35, this.x - 12, this.y + this.h * 0.7, this.x, this.y + this.h);
      ctx.stroke();
      for (let i = 0; i < this.h; i += 24) {
        const py = this.y + i + off;
        if (py < this.y + this.h) {
          ctx.fillStyle = C.cyan;
          ctx.beginPath();
          ctx.arc(this.x, py, 3, 0, Math.PI * 2);
          ctx.fill();
        }
      }
    }
  }

  class OrchestrationNexus {
    constructor(x, y) { this.x = x; this.y = y; this.phase = 0; }
    draw() {
      this.phase = (frame * 0.04) % 220;
      const pulse = 0.5 + Math.sin(frame * 0.08) * 0.15;
      ctx.save();
      ctx.translate(this.x, this.y);
      for (let i = 0; i < 6; i++) {
        const a = (i / 6) * Math.PI * 2 + frame * 0.01;
        ctx.strokeStyle = `rgba(121,242,255,${0.15 + pulse * 0.2})`;
        ctx.beginPath();
        ctx.moveTo(0, 0);
        ctx.lineTo(Math.cos(a) * 52, Math.sin(a) * 52);
        ctx.stroke();
      }
      roundRect(-36, -28, 72, 56, 10, C.panel, C.cyan);
      ctx.fillStyle = '#fff';
      ctx.font = 'bold 9px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('ORCH', 0, -4);
      ctx.fillStyle = C.text;
      ctx.font = '8px Inter,sans-serif';
      ctx.fillText('nexus', 0, 10);
      if (this.phase > 180) {
        const w = Math.min(1, (this.phase - 180) / 25);
        ctx.strokeStyle = `rgba(34,197,94,${w})`;
        ctx.lineWidth = 4;
        ctx.beginPath();
        ctx.arc(0, 0, 40 + w * 10, 0, Math.PI * 2);
        ctx.stroke();
        if (this.phase === 181) createBubble(0, -50, 'Пилот в проде ✓');
      }
      ctx.restore();
    }
  }

  class TriggerBeacon {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(active) {
      roundRect(this.x - 14, this.y - 10, 28, 20, 6, active ? '#1e3a5f' : C.panel, active ? C.cyan : C.outline);
      ctx.fillStyle = active ? C.cyan : C.text;
      ctx.font = '8px sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('IN', this.x, this.y + 3);
    }
  }

  class Agent {
    constructor(x, y, color, role, trig, dialogs) {
      this.x = x; this.y = y; this.bx = x; this.by = y;
      this.color = color; this.role = role; this.trig = trig; this.dialogs = dialogs;
      this.t = Math.random() * 100;
    }
    draw() {
      this.t += 0.04;
      const prg = (frame * 0.04) % 220;
      let moving = false;
      const tx = cw * 0.52, ty = ch * 0.42 + this.trig * 0.15;
      if (prg >= this.trig && prg < this.trig + 22) {
        const lp = prg - this.trig;
        moving = lp < 18;
        const k = lp < 11 ? lp / 11 : (22 - lp) / 11;
        this.x = this.bx + (tx - this.bx) * k;
        this.y = this.by + (ty - this.by) * k;
      } else { this.x = this.bx; this.y = this.by; }
      if (!moving && frame % 180 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)]);
      }
      const bob = moving ? 0 : Math.sin(this.t) * 1.5;
      ctx.save();
      ctx.translate(this.x, this.y + bob);
      roundRect(-12, -8, 24, 16, 5, this.color, C.outline);
      ctx.fillStyle = '#fff';
      ctx.beginPath();
      ctx.arc(4, -14, 5, 0, Math.PI * 2);
      ctx.arc(-4, -14, 5, 0, Math.PI * 2);
      ctx.fill();
      ctx.restore();
    }
  }

  const rivers = [];
  const nexus = new OrchestrationNexus(0, 0);
  const trigger = new TriggerBeacon(0, 0);
  const agents = [
    new Agent(0, 0, C.agentY, '1_architect', 20, ['Карта as-is готова', 'Где узкое горлышко?', 'Повторяемость >50/мес']),
    new Agent(0, 0, C.agentG, '2_analyst', 55, ['ROI на поддержке выше', 'Сначала входящие заявки', 'Чек-лист приоритетов']),
    new Agent(0, 0, C.agentB, '3_integrator', 95, ['CRM webhook ок', '1С без API — UI-агент', 'n8n для оркестратора']),
    new Agent(0, 0, C.agentP, '4_operator', 135, ['Guardrails на платежи', 'Human-in-the-loop', 'Маскируем ПДн']),
    new Agent(0, 0, C.agentV, '5_deployer', 175, ['Пилот на отделе', 'Метрика: −68% цикл', 'Масштаб на соседний процесс'])
  ];

  function layout() {
    nexus.x = cw * 0.55;
    nexus.y = ch * 0.48;
    trigger.x = cw * 0.12;
    trigger.y = ch * 0.22;
    rivers.length = 0;
    rivers.push(new ProcessRiver(cw * 0.12, ch * 0.32, ch * 0.35));
    rivers.push(new ProcessRiver(cw * 0.82, ch * 0.28, ch * 0.38));
    const spots = [[0.08, 0.78], [0.22, 0.82], [0.78, 0.8], [0.9, 0.72], [0.5, 0.82]];
    agents.forEach((a, i) => { a.bx = cw * spots[i][0]; a.by = ch * spots[i][1]; });
  }

  function drawBubbles() {
    for (let i = bubbles.length - 1; i >= 0; i--) {
      const b = bubbles[i];
      b.life++;
      const a = 1 - b.life / b.max;
      if (a <= 0) { bubbles.splice(i, 1); continue; }
      ctx.save();
      ctx.globalAlpha = a;
      const tw = Math.min(120, b.text.length * 5.5);
      roundRect(b.x - tw / 2, b.y - 22, tw, 18, 6, '#fff', C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = '8px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(b.text, b.x, b.y - 10);
      ctx.restore();
    }
  }

  function loop() {
    frame++;
    layout();
    ctx.clearRect(0, 0, cw, ch);
    const prg = (frame * 0.04) % 220;
    trigger.draw(prg < 40);
    rivers.forEach(r => r.draw());
    roundRect(cw * 0.72, ch * 0.18, 56, 34, 8, C.panel, C.violet);
    ctx.fillStyle = '#c4b5fd';
    ctx.font = '8px sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('CRM/1С', cw * 0.72 + 28, ch * 0.18 + 20);
    roundRect(cw * 0.38, ch * 0.12, 48, 28, 8, C.panel, C.amber);
    ctx.fillStyle = '#fcd34d';
    ctx.fillText('HITL', cw * 0.38 + 24, ch * 0.12 + 18);
    nexus.draw();
    agents.forEach(a => a.draw());
    drawBubbles();
    requestAnimationFrame(loop);
  }
  loop();
});
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.aibp-page') || document.querySelector('.aibp-content');
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

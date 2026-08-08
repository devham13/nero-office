<?php
/**
 * Template Name: Компьютерное зрение для бизнеса: внедрение под ключ
 * Description: SEO-лендинг — внедрение CV под ключ: дефекты, полки, склады, интеграции ERP/WMS/CRM.
 */

$page_seo_title       = 'Компьютерное зрение для бизнеса: внедрение под ключ';
$page_seo_description = 'Внедрение компьютерного зрения под ключ: контроль дефектов, объектов, очередей и полок. Интеграция с ERP, CRM, WMS. Аудит сценариев CV для бизнеса.';
$page_seo_keywords    = 'компьютерное зрение для бизнеса, компьютерное зрение для бизнеса под ключ, внедрение компьютерного зрения, разработка компьютерного зрения, система компьютерного зрения, ai компьютерное зрение, контроль дефектов, компьютерное зрение производство, компьютерное зрение ритейл, интеграция erp crm, стоимость компьютерного зрения, аудит сценариев cv';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
	$parts['title'] = $page_seo_title;
	return $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description, $page_seo_keywords ): void {
	echo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta name="keywords" content="' . esc_attr( $page_seo_keywords ) . '" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";
	echo '<meta property="og:type" content="article" />' . "\n";
}, 1 );

$brand = get_bloginfo( 'name' ) ?: ( getenv( 'SITE_BRAND' ) ?: '' ); // pragma: allowlist secret

$nero_ai_header_links = [
	[ 'label' => 'Зачем CV', 'href' => '#zachem-cv' ],
	[ 'label' => 'Задачи', 'href' => '#zadachi-cv' ],
	[ 'label' => 'Отрасли', 'href' => '#otrasli' ],
	[ 'label' => 'Внедрение', 'href' => '#etapy' ],
	[ 'label' => 'Стек', 'href' => '#stek' ],
	[ 'label' => 'Интеграции', 'href' => '#integracii' ],
	[ 'label' => 'Стоимость', 'href' => '#ceny' ],
	[ 'label' => 'ROI', 'href' => '#roi' ],
	[ 'label' => 'Кейсы', 'href' => '#keisy' ],
	[ 'label' => 'Compliance', 'href' => '#compliance' ],
	[ 'label' => 'FAQ', 'href' => '#faq' ],
	[ 'label' => 'Оценить', 'href' => '#ocenit' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Оценить компьютерное зрение';
$primary_cta_url   = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_url = getenv( 'SECONDARY_CTA_URL' ) ?: '';

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

.cvb-content{
  --cvb-bg:#050711;--cvb-bg2:#080b17;
  --cvb-surface:rgba(255,255,255,.072);
  --cvb-text:#e6edf7;--cvb-muted:#9aa8bd;--cvb-soft:#c7d2e5;--cvb-heading:#fff;
  --cvb-border:rgba(255,255,255,.10);
  --cvb-accent:#79f2ff;--cvb-violet:#8b5cf6;--cvb-green:#22c55e;--cvb-warning:#f59e0b;
  --cvb-btn-from:#2563eb;--cvb-btn-to:#7c3aed;
  --cvb-container:1220px;--cvb-r:18px;--cvb-r-lg:24px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--cvb-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.cvb-content *,.cvb-content *::before,.cvb-content *::after{box-sizing:border-box;}
.cvb-content a{color:inherit;text-decoration:none;}
.cvb-content p{color:var(--cvb-muted);line-height:1.72;margin:0 0 1em;}
.cvb-content p:last-child{margin-bottom:0;}
.cvb-content h2,.cvb-content h3,.cvb-content h4{color:var(--cvb-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.cvb-content strong{color:var(--cvb-soft);}
.cvb-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.cvb-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--cvb-muted);font-size:14.5px;line-height:1.65;}
.cvb-content ul li::before{content:'›';position:absolute;left:0;color:var(--cvb-accent);font-weight:700;}
.cvb-cnt{width:min(var(--cvb-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.cvb-section,.nero-ai-section.cvb-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.cvb-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.cvb-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.cvb-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.cvb-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.cvb-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--cvb-accent);margin-bottom:14px;}
.cvb-gt{background:linear-gradient(92deg,#fff 0%,var(--cvb-accent) 44%,var(--cvb-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.cvb-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.cvb-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.cvb-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.cvb-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.cvb-kpi-card .kv{font-size:clamp(18px,2.2vw,24px);font-weight:900;color:var(--cvb-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.cvb-kpi-card .kl{font-size:11px;font-weight:600;color:var(--cvb-muted);line-height:1.4;}
@media(max-width:900px){.cvb-intro-grid{grid-template-columns:1fr;gap:36px;}}
.cvb-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.cvb-table{width:100%;border-collapse:collapse;font-size:14px;}
.cvb-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--cvb-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.cvb-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--cvb-text);vertical-align:top;}
.cvb-table tr:last-child td{border-bottom:none;}
.cvb-table tr:hover td{background:rgba(255,255,255,.03);}
.cvb-table .cvb-hl{color:var(--cvb-green);font-weight:700;}
.cvb-callout{border-left:4px solid var(--cvb-warning);background:rgba(245,158,11,.08);border-radius:0 14px 14px 0;padding:20px 24px;margin:24px 0;}
.cvb-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.cvb-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.cvb-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--cvb-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.cvb-faq-q::after{content:'▾';font-size:13px;color:var(--cvb-accent);flex-shrink:0;transition:transform .25s;}
.cvb-faq-item.open .cvb-faq-q::after{transform:rotate(180deg);}
.cvb-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--cvb-muted);line-height:1.72;}
.cvb-faq-item.open .cvb-faq-a{max-height:800px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--cvb-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--cvb-btn-from),var(--cvb-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--cvb-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--cvb-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
.cvb-intro-text{text-align:left!important;border-left:3px solid transparent;border-image:linear-gradient(180deg,var(--cvb-accent),var(--cvb-violet)) 1;padding-left:22px;}
.cvb-intro-text p{text-align:left!important;}
.cvb-toc-outer{padding:0 0 clamp(32px,4vw,48px);}
.cvb-toc{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;max-width:980px;margin:0 auto;}
.cvb-toc a{display:inline-flex;padding:8px 14px;border-radius:999px;font-size:12.5px;font-weight:700;color:var(--cvb-soft);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);transition:background .2s,border-color .2s;}
.cvb-toc a:hover{background:rgba(121,242,255,.1);border-color:rgba(121,242,255,.35);color:#fff;}
.cvb-body{max-width:860px;margin:0 auto;text-align:left;}
.cvb-body .cvb-h3{font-size:clamp(18px,2.2vw,22px);margin:2em 0 .75em;color:var(--cvb-heading);}
.cvb-body .cvb-h3:first-child{margin-top:0;}
.cvb-steps{counter-reset:cvbstep;list-style:none;padding:0;margin:0 0 1.5em;}
.cvb-steps li{position:relative;padding:0 0 16px 42px;margin:0 0 10px;color:var(--cvb-muted);font-size:14.5px;line-height:1.65;}
.cvb-steps li::before{counter-increment:cvbstep;content:counter(cvbstep);position:absolute;left:0;top:0;width:28px;height:28px;border-radius:50%;background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.3);color:var(--cvb-accent);font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center;}
.cvb-card{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:var(--cvb-r);padding:24px 28px;margin:24px 0;}
.cvb-timeline{display:grid;gap:0;margin:20px 0;}
.cvb-tl-item{position:relative;padding:0 0 28px 32px;border-left:2px solid rgba(121,242,255,.25);}
.cvb-tl-item:last-child{border-left-color:transparent;padding-bottom:0;}
.cvb-tl-dot{position:absolute;left:-7px;top:4px;width:12px;height:12px;border-radius:50%;background:var(--cvb-accent);box-shadow:0 0 0 4px rgba(121,242,255,.15);}
.cvb-tl-item h4{font-size:16px;margin:0 0 6px;color:var(--cvb-heading);}
.cvb-grid-3{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;margin:24px 0;}
@media(max-width:900px){.cvb-grid-3{grid-template-columns:1fr;}}
.cvb-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:18px 20px;}
.cvb-case-card .cvb-case-badge{display:inline-block;padding:4px 10px;border-radius:99px;font-size:11px;font-weight:800;background:rgba(34,197,94,.12);color:#86efac;margin-bottom:10px;}
.cvb-case-card h4{font-size:15px;margin:0 0 6px;}
.cvb-case-card p{font-size:13.5px;margin:0;}
.cvb-sh-left{text-align:left;max-width:820px;margin:0 0 32px;}
.cvb-sh-left h2,.cvb-sh-left p{margin-left:0;margin-right:0;}
.cvb-list-check li::before{content:'✓';color:var(--cvb-green);}

</style>

<main id="primary" class="site-main nero-ai-home-page kompyuternoe-zrenie-dlya-biznesa-page" role="main" tabindex="-1">

<section class="nero-ai-hero cvb-hero" id="hero" aria-labelledby="hero-cv-title">
<style>
.cvb-hero{
  --cvb-cyan:#79f2ff;--cvb-violet:#8b5cf6;--cvb-green:#22c55e;
  --cvb-text:#e6edf7;--cvb-muted:#9aa8bd;--cvb-soft:#c7d2e5;
  position:relative;min-height:min(980px,calc(100dvh - 1px));
  display:grid;align-items:center;
  padding:clamp(72px,9vw,132px) 0 clamp(44px,7vw,86px);
  isolation:isolate;
}
.cvb-hero::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);background-size:64px 64px;mask-image:radial-gradient(circle at 38% 28%,#000 0%,transparent 72%);opacity:.55;pointer-events:none;z-index:-2;}
.cvb-hero .nero-ai-container{width:min(1220px,calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.cvb-hero .nero-ai-hero-grid{display:grid;grid-template-columns:minmax(0,1.05fr) minmax(360px,.95fr);gap:clamp(28px,4vw,56px);align-items:center;}
.cvb-hero .nero-ai-hero-copy h1{margin:0;max-width:800px;font-size:clamp(36px,5.4vw,68px);line-height:.96;letter-spacing:-.06em;color:#fff;font-weight:900;}
.cvb-hero .nero-ai-gradient-text{background:linear-gradient(92deg,#fff 0%,var(--cvb-cyan) 42%,var(--cvb-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.cvb-hero .nero-ai-eyebrow{display:inline-flex;align-items:center;gap:8px;margin:0 0 16px;padding:8px 12px;border:1px solid rgba(121,242,255,.22);border-radius:999px;background:rgba(121,242,255,.08);color:var(--cvb-cyan)!important;font-size:13px;font-weight:750;line-height:1;text-transform:uppercase;letter-spacing:.1em;}
.cvb-hero .nero-ai-hero-lead{margin:22px 0 0;max-width:720px;color:var(--cvb-soft)!important;font-size:clamp(17px,1.9vw,21px);line-height:1.58;}
.cvb-hero .nero-ai-badges{display:flex;flex-wrap:wrap;gap:10px;margin:26px 0 0;padding:0;list-style:none;}
.cvb-hero .nero-ai-badge{display:inline-flex;align-items:center;gap:7px;padding:8px 11px;border:1px solid rgba(255,255,255,.11);border-radius:999px;background:rgba(255,255,255,.055);color:#dce8f7;font-size:13px;font-weight:700;}
.cvb-hero .nero-ai-btn-row{display:flex;flex-wrap:wrap;gap:14px;align-items:center;margin-top:34px;}
.cvb-hero .nero-ai-btn{display:inline-flex;align-items:center;justify-content:center;min-height:48px;padding:14px 20px;border-radius:999px;border:1px solid transparent;font-size:15px;font-weight:800;line-height:1;text-decoration:none!important;transition:transform .22s ease;}
.cvb-hero .nero-ai-btn:hover{transform:translateY(-2px);}
.cvb-hero .nero-ai-btn-primary{color:#041018!important;background:linear-gradient(135deg,var(--cvb-cyan),#38bdf8);box-shadow:0 18px 42px rgba(121,242,255,.22);}
.cvb-hero .nero-ai-btn-secondary{color:var(--cvb-text)!important;background:rgba(255,255,255,.07);border-color:rgba(255,255,255,.14);}
.cvb-hero .nero-ai-dashboard{position:relative;padding:18px;border-radius:34px;background:rgba(2,6,23,.42);box-shadow:0 28px 90px rgba(0,0,0,.42);transform:perspective(1100px) rotateY(3deg) rotateX(2deg);}
.cvb-hero .nero-ai-dashboard-shell{overflow:hidden;border:1px solid rgba(255,255,255,.12);border-radius:26px;background:linear-gradient(180deg,rgba(15,23,42,.95),rgba(6,10,24,.96));}
.cvb-hero .nero-ai-window-top{display:flex;align-items:center;justify-content:space-between;gap:14px;padding:14px 16px;border-bottom:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.045);}
.cvb-hero .nero-ai-dots{display:flex;gap:7px;}
.cvb-hero .nero-ai-dot{width:10px;height:10px;border-radius:50%;}
.cvb-hero .nero-ai-dot:nth-child(1){background:#fb7185;}
.cvb-hero .nero-ai-dot:nth-child(2){background:#fbbf24;}
.cvb-hero .nero-ai-dot:nth-child(3){background:#34d399;}
.cvb-hero .nero-ai-window-title{color:#cfe3f9;font-size:11px;font-weight:750;letter-spacing:.08em;text-transform:uppercase;}
.cvb-hero .nero-ai-window-body{padding:16px;}
.cvb-hero .nero-ai-dashboard-title{display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:12px;}
.cvb-hero .nero-ai-dashboard-title h3{margin:0;font-size:18px;letter-spacing:-.03em;color:#fff;}
.cvb-hero .nero-ai-live-pill{display:inline-flex;align-items:center;gap:7px;padding:6px 9px;border-radius:999px;background:rgba(34,197,94,.10);color:#bbf7d0;font-size:12px;font-weight:800;}
.cvb-hero .nero-ai-live-pill::before{content:"";width:7px;height:7px;border-radius:50%;background:#22c55e;box-shadow:0 0 0 6px rgba(34,197,94,.14);animation:cvbPulse 1.6s infinite;}
@keyframes cvbPulse{0%,100%{transform:scale(.86);opacity:.65;}50%{transform:scale(1);opacity:1;}}
.cvb-hero .nero-ai-metrics-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;margin-bottom:12px;}
.cvb-hero .nero-ai-metric{padding:12px;border:1px solid rgba(255,255,255,.09);border-radius:16px;background:rgba(255,255,255,.055);}
.cvb-hero .nero-ai-metric span{display:block;color:var(--cvb-muted);font-size:11px;font-weight:700;}
.cvb-hero .nero-ai-metric strong{display:block;margin-top:5px;color:#fff;font-size:22px;line-height:1;}
.cvb-hero .cvb-dash-canvas-wrap{position:relative;height:180px;border-radius:14px;overflow:hidden;background:rgba(0,0,0,.35);border:1px solid rgba(255,255,255,.08);margin-bottom:12px;}
.cvb-hero #cvb-hero-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
.cvb-hero .cvb-task-stream{display:flex;flex-direction:column;gap:6px;}
.cvb-hero .cvb-task-row{display:grid;grid-template-columns:42px 1fr auto;gap:8px;align-items:center;padding:8px 10px;border-radius:10px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06);font-size:11px;}
.cvb-hero .cvb-task-tag{font-weight:800;color:var(--cvb-cyan);letter-spacing:.06em;}
.cvb-hero .cvb-task-status{font-size:10px;font-weight:700;padding:3px 8px;border-radius:99px;}
.cvb-hero .cvb-task-status--ok{background:rgba(34,197,94,.15);color:#86efac;}
.cvb-hero .cvb-task-status--warn{background:rgba(245,158,11,.15);color:#fcd34d;}
@media(max-width:1024px){.cvb-hero .nero-ai-hero-grid{grid-template-columns:1fr;}.cvb-hero .nero-ai-dashboard{transform:none;}}
</style>
<div class="nero-ai-container nero-ai-reveal">
  <div class="nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html( $brand ); ?> · computer vision</p>
      <h1 id="hero-cv-title">Компьютерное зрение для бизнеса: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Автоматический контроль дефектов, объектов, очередей и полок — разработаем CV-систему под вашу задачу с интеграцией в процессы</p>
      <ul class="nero-ai-badges" aria-label="Сценарии CV">
        <li class="nero-ai-badge">Контроль дефектов</li>
        <li class="nero-ai-badge">Полки и очереди</li>
        <li class="nero-ai-badge">Склад WMS</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        <a href="#zachem-cv" class="nero-ai-btn nero-ai-btn-secondary">Как это работает</a>
      </div>
    </div>
    <div class="nero-ai-dashboard" aria-label="Демо: компьютерное зрение на объекте">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">CV · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>CV-операционный центр</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Дефекты</span><strong>3</strong><small>критичных</small></div>
            <div class="nero-ai-metric"><span>Точность</span><strong>94%</strong></div>
            <div class="nero-ai-metric"><span>Latency</span><strong>&lt;200 мс</strong></div>
            <div class="nero-ai-metric"><span>Полки</span><strong>24/7</strong></div>
          </div>
          <div class="cvb-dash-canvas-wrap">
            <canvas id="cvb-hero-canvas" aria-label="Демо CV: камера, bounding boxes, алерт" role="img"></canvas>
          </div>
          <div class="cvb-task-stream">
            <div class="cvb-task-row"><span class="cvb-task-tag">CAM</span><span>Кадр с линии → детекция дефекта</span><span class="cvb-task-status cvb-task-status--ok">ok</span></div>
            <div class="cvb-task-row"><span class="cvb-task-tag">AI</span><span>Confidence 0.92 → событие CV</span><span class="cvb-task-status cvb-task-status--ok">ok</span></div>
            <div class="cvb-task-row"><span class="cvb-task-tag">TG</span><span>Алерт в Telegram → ответственный</span><span class="cvb-task-status cvb-task-status--ok">ok</span></div>
            <div class="cvb-task-row"><span class="cvb-task-tag">WMS</span><span>Сверка комплектации → блокировка отгрузки</span><span class="cvb-task-status cvb-task-status--warn">review</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<div class="cvb-content">

<section class="cvb-intro nero-ai-section" id="intro">
  <div class="cvb-cnt">
    <div class="cvb-intro-grid nero-ai-reveal">
<div class="cvb-intro-text">
        <p><strong>Коротко:</strong> компьютерное зрение для бизнеса — не «камера с ИИ», а производственная система: камеры → модели → правила → интеграции → действия в процессе. Nero Network проектирует и внедряет CV под ключ — от аудита сценариев до промышленного запуска.</p>
        <p>Рынок CV в России — <strong>25,76 млрд ₽</strong> (2025), прогноз <strong>49,61 млрд ₽</strong> к 2030 (VisionLabs). Но 70–85% enterprise AI-проектов не выходят на заявленный ROI: причина не в «слабой нейросети», а в данных, освещении и отсутствии связки с ERP, WMS и CRM (Datature 2026).</p>
      </div>
      <div class="cvb-intro-kpi">
        <div class="cvb-kpi-card"><div class="kv">25,76 млрд ₽</div><div class="kl">рынок CV РФ, 2025</div></div>
        <div class="cvb-kpi-card"><div class="kv">70–85%</div><div class="kl">провалов ROI без процесса</div></div>
        <div class="cvb-kpi-card"><div class="kv">4–6 нед.</div><div class="kl">типичный PoC</div></div>
        <div class="cvb-kpi-card"><div class="kv">600 тыс.–5 млн ₽</div><div class="kl">вилка проекта</div></div>
      </div>
    </div>
  </div>
</section>

<div class="cvb-toc-outer">
  <div class="cvb-cnt">
    <nav class="cvb-toc ym-toc" aria-label="Оглавление статьи">
      <a href="#zachem-cv">Зачем CV</a>
      <a href="#zadachi-cv">Задачи</a>
      <a href="#otrasli">Отрасли</a>
      <a href="#etapy">Внедрение</a>
      <a href="#stek">Стек</a>
      <a href="#integracii">Интеграции</a>
      <a href="#ceny">Стоимость</a>
      <a href="#roi">ROI</a>
      <a href="#keisy">Кейсы</a>
      <a href="#compliance">Compliance</a>
      <a href="#faq">FAQ</a>
      <a href="#ocenit">Оценить</a>
    </nav>
  </div>
</div>

<section class="cvb-section nero-ai-section" id="zachem-cv">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal">
      <span class="cvb-eyebrow">Определение</span>
      <h2>Что такое компьютерное зрение для бизнеса и зачем оно нужно</h2>
      <p>Камеры → модели YOLO/CNN/VLM → правила → интеграция с ERP, WMS, CRM → алерты и дашборды.</p>
    </div>

    <div class="cvb-body nero-ai-reveal">
      <p><strong>Определение:</strong> компьютерное зрение (Computer Vision, CV) для бизнеса — технология, при которой камеры и нейросети автоматически распознают объекты, дефекты, людей, текст и сцены на изображении или видеопотоке, а результат передаётся в бизнес-системы для действий: остановка линии, задача сотруднику, алерт в Telegram, запись в CRM.</p>
      <p>В отличие от бытовых приложений, промышленное CV — это не один алгоритм, а <strong>цепочка</strong>: камеры и освещение → модели распознавания (YOLO, CNN, VLM) → правила и пороги уверенности → интеграция с ERP, WMS, CRM, SCADA → дашборды и алерты.</p>
      <h3 class="cvb-h3">От камеры к решению: распознавание, подсчёт, контроль</h3>
      <ol class="cvb-steps">
        <li><strong>Захват</strong> — IP-камера (RTSP), промышленная камера на линии или фото с мобильного приложения сотрудника.</li>
        <li><strong>Инференс</strong> — нейросеть детектирует объекты, классифицирует дефекты, считает количество, распознаёт текст (OCR).</li>
        <li><strong>Правила</strong> — при confidence выше порога: автодействие; ниже — очередь на проверку человеком (human-in-the-loop).</li>
        <li><strong>Интеграция</strong> — событие уходит в 1С, WMS, amoCRM, Telegram-бот, SCADA.</li>
        <li><strong>Аналитика</strong> — дашборд: % брака, время реакции, heatmap нарушений.</li>
      </ol>
      <h3 class="cvb-h3">Где CV даёт измеримый эффект уже в первый год</h3>
      <div class="cvb-table-wrap">
        <table class="cvb-table">
          <thead><tr><th>Направление</th><th>Типовой эффект</th><th>Референс</th></tr></thead>
          <tbody>
            <tr><td>Контроль брака на линии</td><td class="cvb-hl">−70% необнаруженного брака</td><td>Производство шпона, YOLO</td></tr>
            <tr><td>Предотвращение простоя</td><td class="cvb-hl">до 1 млн ₽/день</td><td>НПО «Аконит»</td></tr>
            <tr><td>Ритейл: полки</td><td class="cvb-hl">+6% оборот</td><td>«Лента»</td></tr>
            <tr><td>Модерация</td><td class="cvb-hl">7× производительность</td><td>X5 Tech «Иваныч»</td></tr>
            <tr><td>Склад WMS</td><td class="cvb-hl">89% → 96%</td><td>«СТА Карго»</td></tr>
          </tbody>
        </table>
      </div>
      <p><strong>Какие задачи решает CV для бизнеса:</strong> контроль качества, подсчёт объектов, мониторинг очередей и полок, детекция СИЗ, сверка с WMS, OCR ценников — без ручных обходов.</p>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </div>
</section>

<section class="cvb-section cvb-section-alt nero-ai-section" id="zadachi-cv">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal">
      <span class="cvb-eyebrow">Сценарии</span>
      <h2>Задачи, которые закрывает CV: дефекты, объекты, очереди, полки, нарушения</h2>
    </div>

    <div class="cvb-body nero-ai-reveal">
      <p>Одна платформа — разные сценарии. Начинаем с одного приоритетного KPI, не с «цифровизации всего завода».</p>
      <h3 class="cvb-h3">Автоматический контроль дефектов и брака</h3>
      <ul>
        <li><strong>Ariston / ML Sense:</strong> &gt;600 000 изделий/год, остановка линии при критическом браке.</li>
        <li><strong>НПО «Аконит»:</strong> 5 классов дефектов труб — блокировка до фрезерного узла; простой до <strong>1 млн ₽/день</strong>.</li>
        <li><strong>Производство шпона:</strong> YOLO, точность <strong>94,3%</strong>, −<strong>70%</strong> брака.</li>
        <li><strong>«Северсталь»:</strong> 35 агрегатов, ~60% продукции, инвестиции ~<strong>2 млрд ₽</strong> за 10 лет.</li>
      </ul>
      <h3 class="cvb-h3">Подсчёт объектов и мониторинг зон</h3>
      <p><strong>NeuroCore</strong> — до <strong>3000 операций/сутки</strong> сверки комплектации с WMS. Робот Яндекс у «СТА Карго» и «Азбуки вкуса»: аллея за <strong>4 минуты</strong>, WMS 89%→<strong>96%</strong>.</p>
      <h3 class="cvb-h3">Очереди, полки и выкладка в ритейле</h3>
      <ul>
        <li><strong>«Магнит»:</strong> 430 магазинов, reuse камер, масштаб за ~6 месяцев.</li>
        <li><strong>Fix Price:</strong> VLM OSA, <strong>8000+</strong> точек без собственной ML-лаборатории.</li>
        <li><strong>«Лента»:</strong> −<strong>40%</strong> времени на выкладку, <strong>+6%</strong> оборот категорий.</li>
        <li><strong>Shelf Sense X5:</strong> контроль пустот и ценников в 100 магазинах Москвы.</li>
      </ul>
      <h3 class="cvb-h3">Нарушения и инциденты в зонах безопасности</h3>
      <p><strong>ГК Юзтех:</strong> детекция СИЗ, «красных зон», техники — модульное масштабирование. ~<strong>75%</strong> производителей уже внедрили AI-inspection (Datature 2026).</p>
    </div>
  </div>
</section>

<?php /* === БОРИС BLOCK START — вставка после 2-го H2 === */ ?>
<section id="kompyuternoe-zrenie-dlya-biznesa-boris-block" class="cvb-b-root" aria-label="Анимация: CV-события из производства, ритейла и склада уходят в бизнес-системы">
<style>
#kompyuternoe-zrenie-dlya-biznesa-boris-block.cvb-b-root{padding:56px 0 64px;background:#f8fafc;}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-card{display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:520px;}
@media(max-width:1023px){#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-card{grid-template-columns:1fr;min-height:auto;}}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0891b2;margin:0 0 14px;}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-ey::before{content:'';width:18px;height:2px;background:#0891b2;border-radius:1px;}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(8,145,178,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0e7490;margin-top:1px;font-style:normal;}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-pl-c{background:rgba(8,145,178,.08);color:#0e7490;border:1.5px solid rgba(8,145,178,.22);}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-rgt{position:relative;background:linear-gradient(135deg,#ecfeff 0%,#f0f9ff 35%,#f5f3ff 70%,#f8fafc 100%);min-height:460px;overflow:hidden;}
@media(max-width:1023px){#kompyuternoe-zrenie-dlya-biznesa-boris-block .cvb-b-rgt{min-height:400px;}}
#cvb-pipeline-monitor-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="cvb-b-cnt">
  <div class="cvb-b-card">
    <div class="cvb-b-lft">
      <span class="cvb-b-ey">Интеграция CV → процесс</span>
      <h3 class="cvb-b-h3">Одна камера — три зоны: линия, полка, склад. Событие сразу в ERP, WMS и Telegram</h3>
      <ul class="cvb-b-ul">
        <li><span class="cvb-b-ic">🏭</span>Производство: дефект на конвейере → стоп линии или очередь арбитру</li>
        <li><span class="cvb-b-ic">🛒</span>Ритейл: пустая полка → задача сотруднику в CRM</li>
        <li><span class="cvb-b-ic">📦</span>Склад: расхождение с WMS → блокировка отгрузки до проверки</li>
        <li><span class="cvb-b-ic">?</span>Confidence &lt; порога — human-in-the-loop, не ложный автостоп</li>
      </ul>
      <div class="cvb-b-pills">
        <span class="cvb-b-pl cvb-b-pl-g">&lt;200 мс edge</span>
        <span class="cvb-b-pl cvb-b-pl-c">YOLO + правила</span>
        <span class="cvb-b-pl cvb-b-pl-v">152-ФЗ on-prem</span>
      </div>
      <p class="cvb-b-foot">Дальше — отрасли и типовые сценарии CV по вертикалям →</p>
    </div>
    <div class="cvb-b-rgt">
      <canvas id="cvb-pipeline-monitor-canvas" aria-label="Анимация: три зоны CV отправляют события в Telegram, WMS и ERP" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('cvb-pipeline-monitor-canvas');
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
    ink:'#0f172a', muted:'#64748b', line:'#cbd5e1',
    cyan:'#0891b2', cyanGlow:'rgba(8,145,178,.18)',
    red:'#ef4444', redGlow:'rgba(239,68,68,.2)',
    green:'#22c55e', amber:'#f59e0b',
    violet:'#8b5cf6', shelf:'#e2e8f0', belt:'#334155'
  };

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle=fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawZoneLabel(x,y,text,clr){
    ctx.fillStyle=clr; ctx.font='bold 10px Inter,system-ui,sans-serif'; ctx.textAlign='left';
    ctx.fillText(text,x,y);
  }

  function drawBbox(x,y,w,h,clr,label,conf){
    ctx.strokeStyle=clr; ctx.lineWidth=2; ctx.setLineDash([]);
    ctx.strokeRect(x,y,w,h);
    var tag = label + (conf ? ' ' + conf : '');
    var tw = ctx.measureText(tag).width;
    rr(x,y-16,tw+10,14,3,clr,null,0);
    ctx.fillStyle='#fff'; ctx.font='bold 9px Inter,sans-serif'; ctx.textAlign='left';
    ctx.fillText(tag,x+5,y-5);
  }

  function drawFactoryZone(x,y,w,h,t){
    rr(x,y,w,h,12,'#fff',C.line,1);
    drawZoneLabel(x+10,y+16,'Производство',C.cyan);
    var beltY = y + h*0.55;
    rr(x+12,beltY,w-24,28,4,C.belt,null,0);
    var offset = (t*2.2) % (w-60);
    rr(x+20+offset,beltY+6,36,16,3,'#94a3b8',C.ink,1);
    var defectX = x + 20 + ((t*2.2 + 120) % (w-60));
    rr(defectX,beltY+6,36,16,3,'#94a3b8',C.ink,1);
    if (Math.abs(defectX - (x+w*0.62)) < 28) {
      drawBbox(defectX-4,beltY+2,44,24,C.red,'DEFECT','0.94');
    }
  }

  function drawRetailZone(x,y,w,h,t){
    rr(x,y,w,h,12,'#fff',C.line,1);
    drawZoneLabel(x+10,y+16,'Ритейл · полка',C.violet);
    var sy = y + 36, sw = (w-24)/4;
    for (var i=0;i<4;i++){
      var empty = (i===2);
      rr(x+12+i*(sw+4),sy,sw,h-52,4,empty?'#fef3c7':C.shelf,empty?C.amber:C.line,1);
      if (!empty){
        rr(x+16+i*(sw+4),sy+8,sw-8,sw-8,3,'#a5b4fc',null,0);
      } else if ((t%120)<80){
        drawBbox(x+10+i*(sw+4),sy-2,sw+4,h-48,C.amber,'OOS','0.88');
      }
    }
  }

  function drawWarehouseZone(x,y,w,h,t){
    rr(x,y,w,h,12,'#fff',C.line,1);
    drawZoneLabel(x+10,y+16,'Склад · WMS',C.green);
    var px = x+18, py = y+h-70;
    rr(px,py, w-36, 42,6,'#f1f5f9',C.line,1);
    var count = 6 + Math.floor((t/40)%3);
    for (var j=0;j<count;j++){
      rr(px+10+j*22, py+10, 16,16,2,'#38bdf8',null,0);
    }
    if ((t%90)>55){
      drawBbox(px+10+4*22-4,py+6,24,24,C.red,'−2 шт','review');
    }
  }

  function drawBus(y,t){
    var hubs = [
      {x:W*0.22,label:'Telegram',clr:'#0ea5e9'},
      {x:W*0.5,label:'WMS',clr:C.green},
      {x:W*0.78,label:'ERP/1С',clr:C.amber}
    ];
    hubs.forEach(function(h){
      rr(h.x-36,y,72,30,8,h.clr,null,0);
      ctx.fillStyle='#fff'; ctx.font='bold 10px Inter,sans-serif'; ctx.textAlign='center';
      ctx.fillText(h.label,h.x,y+19);
    });
    var pulse = (t%60)/60;
    ctx.strokeStyle=C.cyan; ctx.lineWidth=2; ctx.setLineDash([5,5]);
    ctx.beginPath(); ctx.moveTo(W*0.17,y-40); ctx.lineTo(W*0.22,y); ctx.stroke();
    ctx.beginPath(); ctx.moveTo(W*0.5,y-40); ctx.lineTo(W*0.5,y); ctx.stroke();
    ctx.beginPath(); ctx.moveTo(W*0.83,y-40); ctx.lineTo(W*0.78,y); ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle=C.cyanGlow;
    ctx.beginPath(); ctx.arc(W*0.22,y-40,6+pulse*4,0,Math.PI*2); ctx.fill();
    ctx.beginPath(); ctx.arc(W*0.5,y-40,6+pulse*4,0,Math.PI*2); ctx.fill();
    ctx.beginPath(); ctx.arc(W*0.83,y-40,6+pulse*4,0,Math.PI*2); ctx.fill();
  }

  function loop(){
    frame++;
    ctx.clearRect(0,0,W,H);
    var pad = 14, gap = 10;
    var zw = (W - pad*2 - gap*2) / 3;
    var zh = H * 0.52;
    var zy = pad + 8;
    drawFactoryZone(pad, zy, zw, zh, frame);
    drawRetailZone(pad+zw+gap, zy, zw, zh, frame);
    drawWarehouseZone(pad+(zw+gap)*2, zy, zw, zh, frame);
    drawBus(H*0.82, frame);
    ctx.fillStyle=C.muted; ctx.font='10px Inter,sans-serif'; ctx.textAlign='center';
    ctx.fillText('CV-событие → правила → действие в процессе', W/2, H-10);
    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>
<?php /* === БОРИС BLOCK END === */ ?>

<section class="cvb-section nero-ai-section" id="otrasli">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal"><h2>Компьютерное зрение по отраслям: производство, ритейл, склады, безопасность, медицина</h2></div>

    <div class="cvb-body nero-ai-reveal">
      <p>Чек и срок PoC зависят от сценария — не от размера бренда на визитке.</p>
      <div class="cvb-table-wrap">
        <table class="cvb-table">
          <thead><tr><th>Отрасль</th><th>Сценарии CV</th><th>Типовой чек</th><th>Срок PoC</th></tr></thead>
          <tbody>
            <tr><td>Производство</td><td>Дефекты, сборка, аттестация</td><td>1–3 млн ₽</td><td>4–6 недель</td></tr>
            <tr><td>Ритейл</td><td>Полки, очереди, ценники</td><td>600 тыс.–2 млн ₽</td><td>4–8 недель</td></tr>
            <tr><td>Склад / логистика</td><td>Комплектация, инвентаризация</td><td>800 тыс.–2,5 млн ₽</td><td>6–10 недель</td></tr>
            <tr><td>Безопасность</td><td>СИЗ, периметр, красные зоны</td><td>600 тыс.–1,5 млн ₽</td><td>4–6 недель</td></tr>
            <tr><td>Медицина</td><td>«Второе мнение»</td><td>2–5 млн ₽</td><td>3–6 месяцев</td></tr>
          </tbody>
        </table>
      </div>
      <h3 class="cvb-h3">Производство и контроль качества</h3>
      <p>Edge-инференс с latency <strong>&lt;200 мс</strong> — стандарт для конвейеров. Для среднего производства без ML-команды: одна линия, PoC за 4–6 недель, от <strong>600 тыс. ₽</strong>.</p>
      <h3 class="cvb-h3">Ритейл и фронт-офис</h3>
      <p>Тренд 2025–2026 — <strong>VLM</strong>: Fix Price на 8000 магазинов без многолетнего цикла обучения. X5 Tech — <strong>10 млн фото/мес</strong>, гибрид CNN + VLM.</p>
      <h3 class="cvb-h3">Склад и логистика</h3>
      <p>Интеграция с WMS через API — обязательное условие ROI: без связи с учётом система остаётся «красивым дашбордом».</p>
      <h3 class="cvb-h3">Безопасность и видеоаналитика</h3>
      <p>Сегмент видеоаналитики в России — <strong>4,83 млрд ₽</strong> (53% рынка CV). Поэтапное масштабирование: СИЗ → красные зоны → контроль техники.</p>
      <h3 class="cvb-h3">Медицина и визуальный контроль</h3>
      <p><strong>«МосМедИИ»</strong> — 74 региона, 8+ млн исследований. Для коммерческих клиник — B2B «второе мнение»; требуется регистрация медизделия.</p>
    </div>
  </div>
</section>

<section class="cvb-section cvb-section-alt nero-ai-section" id="etapy">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal"><h2>Внедрение компьютерного зрения под ключ: этапы и сроки</h2></div>

    <div class="cvb-body nero-ai-reveal">
      <p><strong>Внедрение компьютерного зрения под ключ</strong> — проект из 4 фаз Nero Network. Ориентиры: PoC 4–6 нед., пилот 2–3 мес. (ICL Services).</p>

      <h3 class="cvb-h3">Аудит сценариев и пилот (лид-магнит)</h3>
      <p><strong>Аудит сценариев CV</strong> — бесплатная точка входа. За 1–2 дня фиксируем: камеры, освещение, KPI, интеграции, 152-ФЗ, вилку <strong>600 тыс.–5 млн ₽</strong> и roadmap. Итог: ТЗ, оценка данных, рекомендация CNN/YOLO vs VLM vs гибрид.</p>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-audit">
        <div class="ym-cta-block__icon" aria-hidden="true">📷</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Бесплатный аудит сценариев CV</p>
          <p class="ym-cta-block__sub">За 1–2 дня на объекте или по видео: камеры, освещение, KPI, интеграции и 152-ФЗ. Итог — ТЗ, вилка бюджета 600 тыс.–5 млн ₽ и roadmap внедрения.</p>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        </div>
      </div>

      <h3 class="cvb-h3">Проектирование, камеры, освещение, разметка</h3>
      <p>Выбор камер, настройка освещения, сбор датасета (<strong>минимум 500 размеченных кадров</strong>), регламент дефекта и эскалации.</p>

      <h3 class="cvb-h3">Обучение модели, тест на линии, промышленный запуск</h3>
      <p>PoC <strong>4–6 недель</strong>: YOLOv8/v11 или VLM. Пилот <strong>2–3 месяца</strong>: интеграция, алерты, дашборд. Масштаб: MLOps, дообучение на новых SKU.</p>

      <h3 class="cvb-h3">Под ключ или своими силами: что выбрать</h3>
      <div class="cvb-table-wrap">
        <table class="cvb-table">
          <thead><tr><th>Критерий</th><th>Под ключ</th><th>Своими силами</th></tr></thead>
          <tbody>
            <tr><td>Срок до PoC</td><td class="cvb-hl">4–6 недель</td><td>6–18 месяцев</td></tr>
            <tr><td>ML-команда</td><td>Не нужна</td><td>3–5 специалистов</td></tr>
            <tr><td>Интеграция 1С/WMS</td><td>Включена</td><td>Отдельный подрядчик</td></tr>
            <tr><td>Compliance 152-ФЗ</td><td>By design</td><td>Риск при самостоятельной сборке</td></tr>
          </tbody>
        </table>
      </div>
      <p><strong>Как внедрить CV без программистов в штате:</strong> интегратор с платформой (AISee, ML Sense) или VLM-подход — как Fix Price без собственной ML-лаборатории.</p>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации до старта CV?</p>
          <p class="ym-cta-block__sub">Если команда хочет понимать n8n, промпты и human-in-the-loop до пилота — посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent"<?php echo $secondary_cta_url ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( getenv( 'SECONDARY_CTA_LABEL' ) ?: 'обучение по внедрению AI в бизнес-процессы' ); ?></a>. Это ускоряет принятие решений на этапе аудита сценариев.</p>
        </div>
      </aside>
    </div>
  </div>
</section>

<section class="cvb-section nero-ai-section" id="stek">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal"><h2>Технологический стек: YOLO, OpenCV, edge и облако</h2></div>

    <div class="cvb-body nero-ai-reveal">
      <p><strong>AI компьютерное зрение</strong> в 2026 — матрица выбора под задачу, latency и регуляторику.</p>
      <div class="cvb-table-wrap">
        <table class="cvb-table">
          <thead><tr><th>Технология</th><th>Когда использовать</th><th>Latency</th><th>Стоимость</th></tr></thead>
          <tbody>
            <tr><td>YOLO / CNN (edge)</td><td>Конвейер, дефекты, СИЗ</td><td>&lt;200 мс</td><td>Средняя</td></tr>
            <tr><td>OpenCV + классика</td><td>Простые сценарии</td><td>&lt;50 мс</td><td>Низкая</td></tr>
            <tr><td>VLM (cloud/on-prem)</td><td>Полки, ценники</td><td>0,5–3 сек</td><td>За вызов</td></tr>
            <tr><td class="cvb-hl">Гибрид CNN + VLM</td><td class="cvb-hl">Highload + верификация</td><td class="cvb-hl">Оптимальная</td><td>Баланс (X5)</td></tr>
          </tbody>
        </table>
      </div>
      <h3 class="cvb-h3">Камеры, освещение, latency и точность</h3>
      <p>Точность зависит от данных, освещения и скорости объекта. На производстве шпона — 94,3% при датасете 10 000+ кадров. Для линии &lt;200 мс — edge (Jetson, промышленный ПК с GPU).</p>
      <h3 class="cvb-h3">Edge vs cloud</h3>
      <p><strong>Edge-first</strong> — &gt;50% новых деплоев в 2026. <strong>Cloud/VLM</strong> — ритейл, модерация (Wildberries: 70+ млн изображений/день). <strong>152-ФЗ:</strong> ПДн в РФ с 01.07.2025; биометрия — отдельное согласие с 01.09.2025.</p>
      <h3 class="cvb-h3">Ложные срабатывания и качество данных</h3>
      <div class="cvb-callout"><p>Георгий Кононов («Пятёрочка»): «Успех пилота зависит от обратной связи сотрудников». <strong>Честный подход Nero Network:</strong> human-in-the-loop, пороги confidence, дообучение. Главная причина провала — данные, не модель (Datature 2026).</p></div>
    </div>
  </div>
</section>

<section class="cvb-section cvb-section-alt nero-ai-section" id="integracii">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal"><h2>Интеграция CV в бизнес-процессы: ERP, 1С, WMS, CRM, SCADA</h2></div>

    <div class="cvb-body nero-ai-reveal">
      <p><strong>Интеграция CV</strong> — то, что отличает рабочую систему от демо. CV-событие должно запускать <strong>действие в процессе</strong>.</p>
      <h3 class="cvb-h3">Дашборды, алерты, Telegram</h3>
      <ul class="cvb-list-check">
        <li><strong>Telegram-бот</strong> — мгновенный алерт с фото нарушения;</li>
        <li><strong>Дашборд</strong> (Grafana, Metabase, Power BI) — % брака, heatmap;</li>
        <li><strong>Webhook</strong> — маршрутизация через n8n/Make в CRM и email.</li>
      </ul>
      <p>Связка CV → n8n → задача менеджеру → отчёт в CRM — единый контур AI-автоматизации Nero Network.</p>
      <h3 class="cvb-h3">Связка с учётом и производственными системами</h3>
      <ul>
        <li><strong>1С / SAP</strong> — фиксация брака, списание, акты;</li>
        <li><strong>WMS</strong> — сверка комплектации, блокировка отгрузки;</li>
        <li><strong>amoCRM / Bitrix24</strong> — задачи при нарушениях на полке;</li>
        <li><strong>SCADA / ПЛК</strong> — стоп линии (Modbus TCP / OPC UA) после пилота.</li>
      </ul>
      <p>Без интеграции пилот «зависает» на дашборде — одна из причин, почему 70–85% enterprise AI-проектов не достигают ROI.</p>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </div>
</section>

<section class="cvb-section nero-ai-section" id="ceny">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal"><h2>Сколько стоит компьютерное зрение для бизнеса</h2></div>

    <div class="cvb-body nero-ai-reveal">
      <p>Ориентир Nero Network и рынка: <strong>600 тыс.–5 млн ₽</strong>. Точная цифра — после аудита сценариев.</p>
      <h3 class="cvb-h3">Из чего складывается бюджет</h3>
      <div class="cvb-table-wrap">
        <table class="cvb-table">
          <thead><tr><th>Статья</th><th>Доля</th><th>Комментарий</th></tr></thead>
          <tbody>
            <tr><td>Аудит и проектирование</td><td>5–10%</td><td>ТЗ, roadmap</td></tr>
            <tr><td>Камеры и освещение</td><td>15–25%</td><td>Новые или reuse</td></tr>
            <tr><td>Сервер / edge</td><td>10–20%</td><td>Jetson, GPU</td></tr>
            <tr><td>Разработка модели</td><td>30–40%</td><td>Датасет, YOLO/VLM</td></tr>
            <tr><td>Интеграция</td><td>15–25%</td><td>API, webhook, SCADA</td></tr>
            <tr><td>Поддержка (год)</td><td>10–15%</td><td>MLOps, SLA</td></tr>
          </tbody>
        </table>
      </div>
      <h3 class="cvb-h3">Для малого и среднего бизнеса</h3>
      <ul>
        <li>Производство 50–200 чел.: 1 линия — <strong>800 тыс.–1,5 млн ₽</strong>;</li>
        <li>Ритейл 5–20 магазинов: VLM для полок — <strong>600 тыс.–1,2 млн ₽</strong>;</li>
        <li>Склад 3PL: 2–4 камеры — <strong>1–2 млн ₽</strong>;</li>
        <li>Стройплощадка: модуль СИЗ — <strong>600 тыс.–1 млн ₽</strong>.</li>
      </ul>
    </div>
    <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте бюджет CV под ваш объект</p>
        <p class="ym-cta-block__sub">Микро-проект от 600 тыс. ₽ (1 линия / зона склада / магазин). На аудите сценариев CV рассчитаем окупаемость до старта разработки — без обязательств.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="cvb-section cvb-section-alt nero-ai-section" id="roi">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal"><h2>ROI и окупаемость: брак, ФОТ, скорость инспекции</h2></div>

    <div class="cvb-body nero-ai-reveal">
      <p><strong>ROI CV</strong> считается в браке, ФОТ, простое и обороте полки — не в accuracy модели.</p>
      <h3 class="cvb-h3">Метрики до/после внедрения</h3>
      <div class="cvb-table-wrap">
        <table class="cvb-table">
          <thead><tr><th>Метрика</th><th>До CV</th><th>После CV</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>Необнаруженный брак</td><td>100%</td><td class="cvb-hl">−70%</td><td>Шпон</td></tr>
            <tr><td>Модерация</td><td>1×</td><td class="cvb-hl">7×</td><td>X5 «Иваныч»</td></tr>
            <tr><td>Время на выкладку</td><td>100%</td><td class="cvb-hl">−40%</td><td>«Лента»</td></tr>
            <tr><td>Точность WMS</td><td>89%</td><td class="cvb-hl">96%</td><td>«СТА Карго»</td></tr>
            <tr><td>Доля QA-персонала</td><td>40%</td><td class="cvb-hl">4%</td><td>Global FMCG</td></tr>
          </tbody>
        </table>
      </div>
      <h3 class="cvb-h3">Типичные сроки окупаемости</h3>
      <ul>
        <li><strong>Производство:</strong> 6–18 месяцев;</li>
        <li><strong>Ритейл:</strong> 12–24 месяца;</li>
        <li><strong>Склад:</strong> 8–14 месяцев;</li>
        <li><strong>Безопасность:</strong> 12–18 месяцев.</li>
      </ul>
    </div>
  </div>
</section>

<section class="cvb-section nero-ai-section" id="keisy">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal"><h2>Кейсы и примеры внедрения</h2></div>

    <div class="cvb-body nero-ai-reveal">
      <p>Публичные российские референсы доказывают: CV масштабируется — от пилота в 8 магазинах до 8000+ точек.</p>
      <h3 class="cvb-h3">Производство</h3>
      <div class="cvb-grid-3">
        <div class="cvb-case-card"><span class="cvb-case-badge">35 агрегатов</span><h4>«Северсталь»</h4><p>Аттестация металлопроката, ~60% продукции.</p></div>
        <div class="cvb-case-card"><span class="cvb-case-badge">600k+/год</span><h4>Ariston</h4><p>Микродефекты на конвейере водонагревателей.</p></div>
        <div class="cvb-case-card"><span class="cvb-case-badge">−70% брака</span><h4>Производство шпона</h4><p>YOLO, точность 94,3%.</p></div>
      </div>
      <h3 class="cvb-h3">Ритейл и склад</h3>
      <div class="cvb-grid-3">
        <div class="cvb-case-card"><span class="cvb-case-badge">430 магазинов</span><h4>«Магнит»</h4><p>Reuse камер, масштаб за 6 месяцев.</p></div>
        <div class="cvb-case-card"><span class="cvb-case-badge">8000+ точек</span><h4>Fix Price</h4><p>VLM OSA без собственной ML-лаборатории.</p></div>
        <div class="cvb-case-card"><span class="cvb-case-badge">7×</span><h4>X5 «Иваныч»</h4><p>10 млн фото/мес, 62 типа проверок.</p></div>
        <div class="cvb-case-card"><span class="cvb-case-badge">WMS 96%</span><h4>«СТА Карго»</h4><p>Робот-инвентаризатор Яндекс.</p></div>
        <div class="cvb-case-card"><span class="cvb-case-badge">3000 ops/сутки</span><h4>NeuroCore</h4><p>Контроль комплектации на складе.</p></div>
        <div class="cvb-case-card"><span class="cvb-case-badge">+6% оборот</span><h4>«Лента»</h4><p>Контроль полок, −40% времени на выкладку.</p></div>
      </div>
      <h3 class="cvb-h3">Безопасность / медицина</h3>
      <div class="cvb-grid-3">
        <div class="cvb-case-card"><span class="cvb-case-badge">СИЗ</span><h4>ГК Юзтех</h4><p>Модульная система, красные зоны.</p></div>
        <div class="cvb-case-card"><span class="cvb-case-badge">74 региона</span><h4>«МосМедИИ»</h4><p>8+ млн исследований, «второе мнение».</p></div>
        <div class="cvb-case-card"><span class="cvb-case-badge">≥90% precision</span><h4>Wildberries</h4><p>CV-модерация 2+ млн карточек/день.</p></div>
      </div>
    </div>
  </div>
</section>

<section class="cvb-section cvb-section-alt nero-ai-section" id="compliance">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal"><h2>Риски и compliance: 152-ФЗ, GDPR, этика видеонаблюдения</h2></div>

    <div class="cvb-body nero-ai-reveal">
      <p>Видеонаблюдение с CV — зона повышенного регуляторного внимания. Nero Network проектирует <strong>compliance-by-design</strong>.</p>
      <div class="cvb-callout"><p><strong>152-ФЗ (2025–2026):</strong> ПДн только в РФ (с 01.07.2025); биометрия — отдельное согласие (с 01.09.2025); штрафы за утечку биометрии — до <strong>20 млн ₽</strong>. Видеозаписи с лицами — ПДн: таблички, политика, сроки хранения.</p></div>
      <p><strong>Технические меры:</strong> маскирование лиц, ограничение архива, журнал доступа, on-prem в РФ. <strong>Этика:</strong> CV для полок и брака — одно; тотальная слежка без прозрачных правил — другое. Фиксируем регламент зон съёмки и доступа к записям.</p>
    </div>
  </div>
</section>

<section class="cvb-section nero-ai-section" id="faq">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal"><h2>FAQ по компьютерному зрению для бизнеса</h2></div>
    <div class="cvb-faq nero-ai-reveal">
      <div class="cvb-faq-item"><button type="button" class="cvb-faq-q" aria-expanded="false">Нужны ли программисты в штате?</button><div class="cvb-faq-a"><p>Реалистично при работе с интегратором под ключ — разработка модели и MLOps на стороне подрядчика. IT подключается на API-интеграции.</p></div></div>
      <div class="cvb-faq-item"><button type="button" class="cvb-faq-q" aria-expanded="false">Можно ли без интеграции с CRM/ERP?</button><div class="cvb-faq-a"><p>Технически да (дашборд + Telegram). Экономически нет — без связи с процессом ROI не достигается.</p></div></div>
      <div class="cvb-faq-item"><button type="button" class="cvb-faq-q" aria-expanded="false">Как оценить готовность площадки к CV?</button><div class="cvb-faq-a"><p>Чеклист: камеры, 500+ примеров, регламент событий, IT-контакт, 152-ФЗ, KPI (брак, полка, комплектация, СИЗ).</p></div></div>
      <div class="cvb-faq-item"><button type="button" class="cvb-faq-q" aria-expanded="false">Какая точность у CV?</button><div class="cvb-faq-a"><p>90–95% — реалистичный ориентир при качественном датасете (шпон 94,3%, Wildberries ≥90%). 100% не обещаем — human-in-the-loop для спорных кейсов.</p></div></div>
      <div class="cvb-faq-item"><button type="button" class="cvb-faq-q" aria-expanded="false">Какие сроки внедрения?</button><div class="cvb-faq-a"><p>Аудит 1–2 дня → PoC 4–6 недель → пилот 2–3 месяца → масштабирование. Для бизнеса без ML-команды — под ключ.</p></div></div>
</div>
  </div>
</section>

<section class="cvb-section cvb-section-alt nero-ai-section" id="ocenit">
  <div class="cvb-cnt">
    <div class="cvb-sh nero-ai-reveal"><h2>Оценить компьютерное зрение для вашей задачи</h2></div>

    <div class="cvb-body nero-ai-reveal">
      <p>Вы хотите автоматически видеть дефекты, объекты, очереди, полки или нарушения — но не уверены, с чего начать? <strong>Nero Network</strong> разрабатывает систему CV под вашу задачу с интеграцией в процессы.</p>
      <h3 class="cvb-h3">Что вы получите</h3>
      <ul class="cvb-list-check">
        <li><strong>Аудит сценариев CV</strong> — камеры, освещение, данные, юридика и ROI;</li>
        <li>Roadmap с вилкой <strong>600 тыс.–5 млн ₽</strong>;</li>
        <li>Рекомендацию: YOLO, VLM или гибрид;</li>
        <li>План интеграции с 1С, ERP, WMS, CRM, Telegram.</li>
      </ul>
      <p>Один приоритетный сценарий за <strong>6–10 недель</strong>. Без найма ML-инженеров в штат.</p>
      <p><strong>Итог:</strong> в 2026 CV — зрелая технология с доказанным ROI. Ключ — сценарий, данные, интеграция и честный human-in-the-loop. Nero Network внедряет компьютерное зрение для бизнеса под ключ.</p>
    </div>
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Оценить компьютерное зрение для вашей задачи</p>
        <p class="ym-cta-block__sub">Разработаем систему CV под ключ: контроль, распознавание, подсчёт и аналитика с интеграцией в 1С, ERP, WMS и CRM. Один приоритетный сценарий за 6–10 недель.</p>
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>
  </div>
</section>

</div><!-- .cvb-content -->

<!-- SCHEMA-MARKUP:INSERT -->


<script>
document.addEventListener("DOMContentLoaded",function(){
  var canvas=document.getElementById("cvb-hero-canvas");
  if(!canvas)return;
  var ctx=canvas.getContext("2d"),cw=0,ch=0,scale=1,cx=0,cy=0,frame=0,bubbles=[];
  function resizeCanvas(){
    var wrap=canvas.parentElement;if(!wrap)return;
    canvas.width=wrap.clientWidth||400;canvas.height=wrap.clientHeight||180;
    cw=canvas.width;ch=canvas.height;cx=cw/2;cy=ch/2+6;scale=Math.min(cw/420,ch/280)*1.1;
  }
  window.addEventListener("resize",resizeCanvas);resizeCanvas();
  var C={outline:"#64748b",frameBg:"#1e293b",frameEdge:"#38bdf8",bboxOk:"#22c55e",bboxWarn:"#f59e0b",bboxCrit:"#ef4444",fiber:"rgba(56,189,248,0.35)",monitor:"#0f172a",scanLine:"rgba(139,92,246,0.5)",agentYellow:"#eab308",agentGreen:"#10b981",agentBlue:"#3b82f6",agentPink:"#ec4899",agentPurple:"#8b5cf6",bubbleBg:"#0f172a",bubbleText:"#e2e8f0"};
  function drawRR(ctx,x,y,w,h,r,fill,stroke){ctx.fillStyle=fill;ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);ctx.fill();if(stroke){ctx.lineWidth=1.2;ctx.strokeStyle=stroke;ctx.stroke();}}
  function createBubble(x,y,text,ttl){bubbles.push({x:x,y:y,text:text,life:ttl||200,max:ttl||200});}
  function OpticalFramePipeline(){this.frames=[{lane:0,offset:0,label:"L1"},{lane:1,offset:55,label:"L2"},{lane:2,offset:110,label:"RT"}];}
  OpticalFramePipeline.prototype.draw=function(ctx){var lanes=[{y:-72,h:8},{y:-52,h:8},{y:-32,h:8}];lanes.forEach(function(ln){ctx.strokeStyle=C.fiber;ctx.lineWidth=2;ctx.beginPath();ctx.moveTo(-175,ln.y);ctx.bezierCurveTo(-90,ln.y-6,-30,ln.y+4,20,ln.y+18);ctx.stroke();});this.frames.forEach(function(fr){var t=((frame*0.5+fr.offset)%140)/140;var x=-165+t*185,y=lanes[fr.lane].y+Math.sin(t*Math.PI)*3;if(t<0.88){drawRR(ctx,x-10,y-7,20,14,2,C.frameBg,C.frameEdge);ctx.fillStyle="#94a3b8";ctx.font="bold 5px Inter,sans-serif";ctx.textAlign="center";ctx.fillText(fr.label,x,y+2);}});};
  function InferenceViewport(){this.phase=0;}
  InferenceViewport.prototype.draw=function(ctx){var prg=(frame*0.042)%260;this.phase=prg;drawRR(ctx,25,-55,130,100,8,C.monitor,C.outline);if(prg>55){ctx.strokeStyle=prg>140?C.bboxCrit:C.bboxWarn;ctx.lineWidth=1.8;ctx.strokeRect(62,12,36,20);}if(prg>100){var conf=Math.min(0.94,0.6+(prg-100)/200);drawRR(ctx,38,38,104*conf,10,3,C.bboxOk,null);}};
  function AlertEscalationBeacon(){}
  AlertEscalationBeacon.prototype.draw=function(ctx){var prg=(frame*0.042)%260;if(prg<165)return;var r=8+((prg-165)/40)*14;ctx.strokeStyle="rgba(239,68,68,0.5)";ctx.lineWidth=2;ctx.beginPath();ctx.arc(118,18,r,0,Math.PI*2);ctx.stroke();};
  var pipeline=new OpticalFramePipeline(),viewport=new InferenceViewport(),beacon=new AlertEscalationBeacon();
  function drawBubbles(ctx){bubbles=bubbles.filter(function(b){b.life--;if(b.life<=0)return false;ctx.globalAlpha=b.life/b.max;drawRR(ctx,b.x-ctx.measureText(b.text).width/2-6,b.y-18,ctx.measureText(b.text).width+12,14,4,C.bubbleBg,"rgba(56,189,248,0.4)");ctx.fillStyle=C.bubbleText;ctx.font="bold 6px Inter,sans-serif";ctx.textAlign="center";ctx.fillText(b.text,b.x,b.y-8);ctx.globalAlpha=1;return true;});}
  function engineLoop(){frame++;ctx.clearRect(0,0,cw,ch);ctx.save();ctx.translate(cx,cy);ctx.scale(scale,scale);pipeline.draw(ctx);viewport.draw(ctx);beacon.draw(ctx);drawBubbles(ctx);ctx.restore();requestAnimationFrame(engineLoop);}
  engineLoop();
});
</script>

<script>
(function(){
  document.querySelectorAll('.cvb-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.cvb-faq-item');
      var open=item.classList.contains('open');
      document.querySelectorAll('.cvb-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.cvb-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!open){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
    });
  });
})();
</script>

<script>
(function(){
  var root=document.querySelector('.kompyuternoe-zrenie-dlya-biznesa-page');
  if(!root) return;
  var items=root.querySelectorAll('.nero-ai-reveal');
  if('IntersectionObserver' in window){
    var obs=new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if(e.isIntersecting){ e.target.classList.add('nero-ai-active'); obs.unobserve(e.target); }
      });
    },{threshold:.1,rootMargin:'0px 0px -6% 0px'});
    items.forEach(function(i){ obs.observe(i); });
  } else {
    items.forEach(function(i){ i.classList.add('nero-ai-active'); });
  }
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

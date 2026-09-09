<?php
/**
 * Template Name: AI для производства: сменные задания и контроль простоев
 * Description: SEO-лендинг — внедрение AI-агента для малого производства: сменные задания, фиксация простоев, отчёт руководителю без Excel.
 */

$page_seo_title       = 'AI для производства: сменные задания и контроль простоев';
$page_seo_description = 'Внедрение AI-агента для малого производства: сменные задания, фиксация простоев в реальном времени, отчёт руководителю без Excel. Аудит потерь, интеграция с 1С.';

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
	['label' => 'Как работает',    'href' => '#kak-rabotaet'],
	['label' => 'Сменные задания', 'href' => '#smennie-zadaniya'],
	['label' => 'Простои и OEE',   'href' => '#prostoi-oee'],
	['label' => 'Интеграции',      'href' => '#integracii'],
	['label' => 'Этапы',           'href' => '#etapy'],
	['label' => 'Стоимость',       'href' => '#cena-roi'],
	['label' => 'FAQ',             'href' => '#faq'],
	['label' => 'Найти простои',   'href' => '#cta'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = 'Найти простои';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '';

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
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
.apk-hero-prostoi{min-height:100vh;min-height:100dvh;position:relative}
.apk-content{--apk-bg:#050711;--apk-bg2:#080b17;--apk-surface:rgba(255,255,255,.072);--apk-text:#e6edf7;--apk-muted:#9aa8bd;--apk-soft:#c7d2e5;--apk-heading:#fff;--apk-border:rgba(255,255,255,.10);--apk-accent:#79f2ff;--apk-amber:#f59e0b;--apk-green:#22c55e;--apk-violet:#8b5cf6;--apk-btn-from:#06b6d4;--apk-btn-to:#7c3aed;--apk-shadow:0 24px 72px rgba(0,0,0,.4);--apk-r:18px;--apk-container:1220px;background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);color:var(--apk-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden}
.apk-content *,.apk-content *::before,.apk-content *::after{box-sizing:border-box}
.apk-content a{color:inherit;text-decoration:none}
.apk-content p{color:var(--apk-muted);line-height:1.72;margin:0 0 1em}
.apk-content p:last-child{margin-bottom:0}
.apk-content h2,.apk-content h3,.apk-content h4{color:var(--apk-heading);letter-spacing:-.045em;margin:0 0 .7em}
.apk-content strong{color:var(--apk-soft)}
.apk-content ul,.apk-content ol{padding-left:0;list-style:none;margin:0 0 1em}
.apk-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--apk-muted);font-size:14.5px;line-height:1.65}
.apk-content ul li::before{content:'›';position:absolute;left:0;color:var(--apk-accent);font-weight:700}
.apk-content ol.apk-ol{counter-reset:apkli}
.apk-content ol.apk-ol li{counter-increment:apkli;padding-left:28px}
.apk-content ol.apk-ol li::before{content:counter(apkli);color:var(--apk-accent);font-weight:800;font-size:12px;left:0;width:20px;text-align:center}
.apk-cnt{width:min(var(--apk-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.apk-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.apk-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.apk-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.apk-sh.apk-left{margin-left:0;text-align:left}
.apk-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.apk-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.apk-sh.apk-left p{margin-left:0}
.apk-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apk-accent);margin-bottom:14px}
.apk-gt{background:linear-gradient(92deg,#fff 0%,var(--apk-accent) 44%,var(--apk-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.apk-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.apk-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.apk-intro-text{position:relative;padding-left:20px;text-align:left!important}
.apk-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--apk-accent),var(--apk-violet))}
.apk-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--apk-muted);margin-bottom:1em}
.apk-intro-text p:last-child{margin-bottom:0;color:var(--apk-soft)}
.apk-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.apk-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.apk-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--apk-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.apk-kpi-card .kl{font-size:11px;font-weight:600;color:var(--apk-muted);line-height:1.4}
.apk-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.apk-intro-grid{grid-template-columns:1fr;gap:36px}.apk-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.apk-intro-kpi{grid-template-columns:1fr 1fr}}
.apk-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.apk-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.apk-toc a{display:inline-block;padding:9px 18px;background:var(--apk-surface);border:1px solid var(--apk-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--apk-muted);transition:border-color .2s,color .2s,background .2s}
.apk-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--apk-accent);background:rgba(121,242,255,.08)}
.apk-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--apk-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.apk-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.apk-callout{border-left:3px solid var(--apk-accent);padding:18px 22px;background:rgba(121,242,255,.06);border-radius:0 14px 14px 0;margin:24px 0}
.apk-callout p{margin:0;color:var(--apk-soft)}
.apk-quote{border-left:3px solid var(--apk-violet);padding:20px 24px;background:rgba(139,92,246,.08);border-radius:0 16px 16px 0;margin:24px 0;font-style:italic;color:var(--apk-soft)}
.apk-quote cite{display:block;margin-top:10px;font-style:normal;font-size:13px;color:var(--apk-muted)}
.apk-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.apk-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.apk-grid-2,.apk-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.apk-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.apk-grid-3{grid-template-columns:1fr}}
.apk-steps{display:grid;gap:12px;margin:24px 0}
.apk-step{display:flex;gap:14px;align-items:flex-start;padding:16px 18px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:14px}
.apk-step-num{flex-shrink:0;width:32px;height:32px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--apk-accent);font-weight:800;font-size:14px;display:flex;align-items:center;justify-content:center}
.apk-step strong{color:var(--apk-heading);display:block;margin-bottom:4px}
.apk-step span{font-size:14px;color:var(--apk-muted)}
.apk-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.apk-table{width:100%;border-collapse:collapse;font-size:14px}
.apk-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--apk-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.apk-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--apk-text);vertical-align:top}
.apk-table tr:last-child td{border-bottom:none}
.apk-table tr:hover td{background:rgba(255,255,255,.03)}
.apk-timeline{position:relative;padding-left:40px}
.apk-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--apk-accent),var(--apk-violet));opacity:.35;border-radius:2px}
.apk-tl-item{position:relative;margin-bottom:32px}
.apk-tl-item:last-child{margin-bottom:0}
.apk-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--apk-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.apk-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.apk-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.apk-case-grid{grid-template-columns:1fr}}
.apk-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.apk-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.apk-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apk-green);margin-bottom:10px}
.apk-case-card h3{font-size:16px;margin-bottom:14px}
.apk-calc{background:rgba(15,23,42,.6);border:1px solid rgba(121,242,255,.15);border-radius:16px;padding:24px;font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:13px;color:var(--apk-soft);line-height:1.7;margin:20px 0;white-space:pre-wrap}
.apk-checklist{display:grid;gap:10px}
.apk-check{display:flex;gap:10px;align-items:flex-start;font-size:14.5px;color:var(--apk-muted)}
.apk-check-yes::before{content:'✓';color:var(--apk-green);font-weight:800}
.apk-check-no::before{content:'✗';color:var(--apk-amber);font-weight:800}
.apk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.apk-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.apk-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--apk-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.apk-faq-q::after{content:'▾';font-size:13px;color:var(--apk-accent);flex-shrink:0;transition:transform .25s}
.apk-faq-item.open .apk-faq-q::after{transform:rotate(180deg)}
.apk-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--apk-muted);line-height:1.72}
.apk-faq-item.open .apk-faq-a{max-height:600px;padding:0 24px 20px}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--apk-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn:hover{transform:translateY(-2px)}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--apk-btn-from),var(--apk-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(6,182,212,.35)}
.ym-link--accent{color:var(--apk-accent)!important;text-decoration:underline!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}
.nero-ai-delay-2{transition-delay:.24s}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
</style>

<main id="primary" class="site-main nero-ai-home-page apk-prostoi-page" role="main" tabindex="-1">
<section class="nero-ai-hero apk-hero-prostoi" id="hero" aria-labelledby="apk-prostoi-hero-title">
<style>
/* ── Hero ai-proizvodstvo-kontrol-prostoi: самодостаточные стили ── */
.apk-hero-prostoi {
  --apk-cyan: #79f2ff;
  --apk-amber: #f59e0b;
  --apk-green: #22c55e;
  --apk-violet: #8b5cf6;
  --apk-text: #e6edf7;
  --apk-muted: #9aa8bd;
  --apk-soft: #c7d2e5;
  --apk-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.apk-hero-prostoi::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(circle at 42% 32%, #000 0%, transparent 70%);
  opacity: .5;
  pointer-events: none;
  z-index: -2;
}
.apk-hero-prostoi::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .09), transparent 66%);
  filter: blur(10px);
  animation: apkProstoiGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes apkProstoiGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.04); }
}
.apk-hero-prostoi .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.apk-hero-prostoi .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.apk-hero-prostoi .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.apk-hero-prostoi .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--apk-cyan) 38%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.apk-hero-prostoi .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--apk-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.apk-hero-prostoi .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--apk-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.apk-hero-prostoi .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.apk-hero-prostoi .nero-ai-badge {
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
.apk-hero-prostoi .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.apk-hero-prostoi .nero-ai-btn {
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
.apk-hero-prostoi .nero-ai-btn:hover { transform: translateY(-2px); }
.apk-hero-prostoi .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--apk-cyan), #38bdf8);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.apk-hero-prostoi .nero-ai-btn-secondary {
  color: var(--apk-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.apk-hero-prostoi .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--apk-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.apk-hero-prostoi .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.apk-hero-prostoi .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.apk-hero-prostoi .nero-ai-dots { display: flex; gap: 7px; }
.apk-hero-prostoi .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.apk-hero-prostoi .nero-ai-dot:nth-child(1) { background: #fb7185; }
.apk-hero-prostoi .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.apk-hero-prostoi .nero-ai-dot:nth-child(3) { background: #34d399; }
.apk-hero-prostoi .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.apk-hero-prostoi .nero-ai-window-body { padding: 16px; }
.apk-hero-prostoi .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.apk-hero-prostoi .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.apk-hero-prostoi .nero-ai-live-pill {
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
.apk-hero-prostoi .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: apkProstoiPulse 1.6s infinite;
}
@keyframes apkProstoiPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.apk-hero-prostoi .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.apk-hero-prostoi .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.apk-hero-prostoi .nero-ai-metric span {
  display: block;
  color: var(--apk-muted);
  font-size: 11px;
  font-weight: 700;
}
.apk-hero-prostoi .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.apk-hero-prostoi .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.apk-hero-prostoi .nero-ai-metric--alert strong { color: var(--apk-amber); }
.apk-hero-prostoi .apk-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 35% 40%, rgba(121,242,255,.06), rgba(6,10,24,.94) 72%);
}
.apk-hero-prostoi #apk-prostoi-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.apk-hero-prostoi .nero-ai-task-stream { display: grid; gap: 8px; }
.apk-hero-prostoi .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.apk-hero-prostoi .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--apk-cyan);
  font-size: 11px;
  font-weight: 800;
}
.apk-hero-prostoi .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.apk-hero-prostoi .nero-ai-task span {
  color: var(--apk-muted);
  font-size: 11px;
}
.apk-hero-prostoi .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.apk-hero-prostoi .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.apk-hero-prostoi .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #bae6fd;
}
@media (max-width: 1100px) {
  .apk-hero-prostoi .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .apk-hero-prostoi .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .apk-hero-prostoi .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .apk-hero-prostoi .nero-ai-window-body { padding: 12px; }
  .apk-hero-prostoi .nero-ai-task { grid-template-columns: 28px 1fr; }
  .apk-hero-prostoi .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Производство / смены · ai производство контроль</p>
      <h1 id="apk-prostoi-hero-title">AI-агент для производства: <span class="nero-ai-gradient-text">сменные задания и контроль простоев</span> под ключ</h1>
      <p class="nero-ai-hero-lead">AI собирает данные по смене, фиксирует отклонения и простои — отчёт руководителю без ручного сбора в Excel</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Сменные задания</li>
        <li class="nero-ai-badge">Контроль простоев</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">Telegram + 1С</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация сменного контура AI-агента">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Сменный контур · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>OEE смены</span>
              <strong>68%</strong>
              <small>доступность × скорость × качество</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--alert">
              <span>Простои сегодня</span>
              <strong>47 мин</strong>
              <small>РЦ-3 · нет материала</small>
            </div>
            <div class="nero-ai-metric">
              <span>Заданий в очереди</span>
              <strong>12</strong>
              <small>утренний пакет подтверждён</small>
            </div>
            <div class="nero-ai-metric">
              <span>Отчёт через</span>
              <strong>0 мин</strong>
              <small>briefing готов к отправке</small>
            </div>
          </div>

          <div class="apk-dash-canvas-wrap" aria-hidden="false">
            <canvas id="apk-prostoi-hero-canvas" role="img" aria-label="Анимация: диспетчерская смены — задания по орбите, простой на РЦ-3, подтверждение мастера и отчёт в Telegram"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⏸</span>
              <div><strong>Простой РЦ-3 — нет материала</strong><span>фиксация 11:24 · эскалация мастеру</span></div>
              <span class="nero-ai-status nero-ai-status--amber">простой</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Мастер подтвердил пакет заданий</strong><span>12 операций · human-in-the-loop</span></div>
              <span class="nero-ai-status">подтверждено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Эскалация: простой &gt;15 мин</strong><span>уведомление руководителю</span></div>
              <span class="nero-ai-status nero-ai-status--amber">алерт</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Briefing входящей смены готов</strong><span>3 незакрытых · 1 критичный простой</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">отчёт</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * apk-prostoi-hero-engine — «Диспетчерская сменного контура»
 * Мир: орбитальные карточки заданий → панель смены → простой → подтверждение → Telegram-briefing
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("apk-prostoi-hero-canvas");
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
    scale = Math.min(cw / 420, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    floor: "rgba(30,41,59,0.55)",
    floorLine: "rgba(121,242,255,0.12)",
    hubBase: "#0f172a",
    hubCyan: "#79f2ff",
    hubAmber: "#f59e0b",
    hubGreen: "#22c55e",
    hubViolet: "#8b5cf6",
    ticketBlue: "#dbeafe",
    ticketGreen: "#d1fae5",
    ticketAmber: "#fef3c7",
    beaconOn: "#22c55e",
    beaconWarn: "#f59e0b",
    beaconOff: "#475569",
    heatLow: "rgba(121,242,255,0.15)",
    heatHigh: "rgba(245,158,11,0.45)",
    tgBlue: "#38bdf8",
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
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    if (label) ctx.fillText(label, x, y + 2);
  }

  /* Орбитальная дорожка карточек заданий — вместо Conveyor */
  function TaskOrbitalLane() {
    this.tickets = [
      { angle: 0, color: C.ticketBlue, label: "РЦ-1" },
      { angle: 2.1, color: C.ticketGreen, label: "РЦ-2" },
      { angle: 4.2, color: C.ticketAmber, label: "РЦ-3" }
    ];
  }
  TaskOrbitalLane.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var rx = 0, ry = -8, rw = 155, rh = 52;
    ctx.strokeStyle = "rgba(121,242,255,0.22)";
    ctx.lineWidth = 1.2;
    ctx.setLineDash([4, 5]);
    ctx.beginPath();
    ctx.ellipse(rx, ry, rw, rh, 0, 0, Math.PI * 2);
    ctx.stroke();
    ctx.setLineDash([]);

    this.tickets.forEach(function (t, i) {
      var speed = prg < 120 ? 0.018 : 0.006;
      t.angle += speed;
      var tx = rx + Math.cos(t.angle) * rw;
      var ty = ry + Math.sin(t.angle) * rh * 0.55;
      var pulse = 1 + Math.sin(frame * 0.08 + i) * 0.06;
      drawTicket(ctx, tx, ty, 18 * pulse, 14 * pulse, t.color, t.label);
    });
  };

  /* Панель смены с OEE-кольцом — вместо WebsiteTerminal */
  function ShiftBriefingHub() {
    this.oee = 0.68;
    this.phase = 0;
  }
  ShiftBriefingHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -58, -72, 116, 128, 10, C.hubBase, C.outline);

    drawRR(ctx, -50, -64, 100, 16, [6, 6, 0, 0], "rgba(121,242,255,0.18)", null);
    ctx.fillStyle = C.hubCyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Сменный контур", -44, -54);

    /* OEE-кольцо */
    var oeeVal = prg < 110 ? 0.72 : prg < 150 ? 0.58 : 0.68;
    this.oee = oeeVal;
    ctx.lineWidth = 5;
    ctx.strokeStyle = "rgba(255,255,255,0.08)";
    ctx.beginPath();
    ctx.arc(0, -18, 28, 0, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = prg >= 110 && prg < 150 ? C.hubAmber : C.hubCyan;
    ctx.beginPath();
    ctx.arc(0, -18, 28, -Math.PI / 2, -Math.PI / 2 + Math.PI * 2 * oeeVal);
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 11px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(oeeVal * 100) + "%", 0, -14);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillText("OEE", 0, -6);

    /* Очередь заданий внутри панели */
    for (var q = 0; q < 3; q++) {
      var on = prg > 20 + q * 18;
      drawRR(ctx, -42, 8 + q * 14, 84, 10, 2, on ? "rgba(255,255,255,0.08)" : "rgba(255,255,255,0.03)", null);
      if (on) {
        ctx.fillStyle = q === 2 && prg >= 110 && prg < 190 ? C.hubAmber : C.hubCyan;
        ctx.fillRect(-38, 11 + q * 14, 30 + q * 12, 4);
      }
    }

    /* Фаза подтверждения мастера */
    if (prg >= 150 && prg < 200) {
      var stamp = Math.min(1, (prg - 150) / 16);
      ctx.save();
      ctx.translate(30, 38);
      ctx.rotate(-0.12 * stamp);
      ctx.globalAlpha = stamp;
      ctx.strokeStyle = C.hubGreen;
      ctx.lineWidth = 1.8;
      ctx.strokeRect(-22, -10, 44, 20);
      ctx.fillStyle = C.hubGreen;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ПОДТВ.", 0, 3);
      ctx.restore();
    }
  };

  /* Таймер простоя */
  function DowntimeChronometer() {
    this.seconds = 0;
  }
  DowntimeChronometer.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 110 || prg > 200) return;
    var run = prg - 110;
    this.seconds = Math.floor(run * 2.3);
    drawRR(ctx, 108, -58, 52, 34, 6, "rgba(245,158,11,0.12)", C.hubAmber);
    ctx.fillStyle = C.hubAmber;
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(this.seconds + " мин", 134, -42);
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillText("ПРОСТОЙ", 134, -52);
    if (run > 25) {
      ctx.globalAlpha = 0.35 + Math.sin(frame * 0.2) * 0.25;
      ctx.fillStyle = C.hubAmber;
      ctx.beginPath();
      ctx.arc(152, -52, 4, 0, Math.PI * 2);
      ctx.fill();
      ctx.globalAlpha = 1;
    }
  };

  /* Маяки рабочих центров */
  function WorkCenterBeaconRow() {
    this.states = ["on", "on", "on"];
  }
  WorkCenterBeaconRow.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg >= 110 && prg < 190) this.states = ["on", "on", "warn"];
    else if (prg >= 190) this.states = ["on", "on", "on"];
    else this.states = ["on", "on", "on"];

    var centers = [
      { x: -120, y: 58, label: "РЦ-1" },
      { x: 0, y: 62, label: "РЦ-2" },
      { x: 120, y: 58, label: "РЦ-3" }
    ];
    ctx.fillStyle = C.floor;
    drawRR(ctx, -150, 48, 300, 28, 6, C.floor, C.floorLine);

    centers.forEach(function (rc, i) {
      var col = C.beaconOn;
      if (this.states[i] === "warn") col = C.beaconWarn;
      drawRR(ctx, rc.x - 22, rc.y - 8, 44, 22, 5, "rgba(15,23,42,0.7)", C.outline);
      ctx.fillStyle = col;
      ctx.beginPath();
      ctx.arc(rc.x - 12, rc.y + 2, 4, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(rc.label, rc.x + 4, rc.y + 5);
    }, this);
  };

  /* Тепловая карта потерь */
  function LossHeatmapPanel() {
    this.cells = [0.2, 0.35, 0.55, 0.8, 0.45, 0.25];
  }
  LossHeatmapPanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -175, -18, 36, 48, 4, "rgba(255,255,255,0.04)", C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Потери", -157, -10);
    this.cells.forEach(function (v, i) {
      var boost = prg >= 110 && i === 4 ? 0.25 : 0;
      var heat = Math.min(1, v + boost);
      var col = heat > 0.6 ? C.heatHigh : C.heatLow;
      var cx = -168 + (i % 3) * 10;
      var cy = 0 + Math.floor(i / 3) * 10;
      drawRR(ctx, cx, cy, 8, 8, 2, col, null);
    });
  };

  /* Telegram-эскалация — финал цикла */
  function TelegramEscalationBadge() {
    this.slide = 0;
  }
  TelegramEscalationBadge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 198) return;
    this.slide = Math.min(1, (prg - 198) / 22);
    var ty = 78 - this.slide * 55;
    drawRR(ctx, 95, ty, 58, 36, 8, "rgba(56,189,248,0.15)", C.tgBlue);
    ctx.fillStyle = C.tgBlue;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Telegram", 124, ty + 12);
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillStyle = "#e2e8f0";
    ctx.fillText("Briefing", 124, ty + 24);
    if (this.slide > 0.5) {
      ctx.fillStyle = C.hubGreen;
      ctx.beginPath();
      ctx.arc(148, ty + 8, 5, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  /* Пол цеха — декоративная сетка */
  function WorkshopFloorGrid() {
    this.wave = 0;
  }
  WorkshopFloorGrid.prototype.draw = function (ctx) {
    this.wave = Math.sin(frame * 0.04) * 2;
    ctx.strokeStyle = C.floorLine;
    ctx.lineWidth = 0.8;
    for (var i = -160; i <= 160; i += 32) {
      ctx.beginPath();
      ctx.moveTo(i, 42 + this.wave);
      ctx.lineTo(i, 78);
      ctx.stroke();
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
    var prg = (frame * 0.042) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -120, y: 42 },
      "2_seo": { x: -40, y: 46 },
      "3_coder": { x: 0, y: -42 },
      "4_designer": { x: 120, y: 42 },
      "5_deployer": { x: 124, y: 62 }
    };
    var tgt = targets[this.role] || { x: 0, y: 40 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 15) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 15) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 15) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.1;
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
  var floor = new WorkshopFloorGrid();
  var lane = new TaskOrbitalLane();
  var hub = new ShiftBriefingHub();
  var chrono = new DowntimeChronometer();
  var beacons = new WorkCenterBeaconRow();
  var heatmap = new LossHeatmapPanel();
  var telegram = new TelegramEscalationBadge();

  entities.push(floor);
  entities.push(heatmap);
  entities.push(beacons);
  entities.push(lane);
  entities.push(hub);
  entities.push(chrono);
  entities.push(telegram);
  entities.push(new Agent(-150, 18, C.agentYellow, "1_architect", 18, [
    "Карта РЦ на смену", "Приоритеты из 1С", "Пакет заданий готов"
  ]));
  entities.push(new Agent(-95, 22, C.agentGreen, "2_seo", 62, [
    "OEE упал до 58%", "Узкое место — РЦ-3", "Потери в теплокарте"
  ]));
  entities.push(new Agent(-35, 20, C.agentBlue, "3_coder", 108, [
    "Webhook 1С OK", "Telegram-бот live", "n8n: простой >15 мин"
  ]));
  entities.push(new Agent(40, 22, C.agentPink, "4_designer", 152, [
    "Мастер, подтверди", "Human-in-the-loop", "Перестановка РЦ-3"
  ]));
  entities.push(new Agent(95, 18, C.agentPurple, "5_deployer", 205, [
    "Briefing в Telegram", "Отчёт руководителю", "Смена передана"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 230, maxLife: life || 230 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.042) % 260;
    if (prg >= 16 && prg < 16.05) createBubble(-140, -30, "1. Пакет заданий");
    if (prg >= 58 && prg < 58.05) createBubble(-70, -35, "2. Мониторинг OEE");
    if (prg >= 112 && prg < 112.05) createBubble(120, -48, "3. Простой РЦ-3");
    if (prg >= 156 && prg < 156.05) createBubble(35, -55, "4. Подтверждение мастера");
    if (prg >= 206 && prg < 206.05) createBubble(110, 30, "5. Briefing в Telegram");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      drawRR(ctx, b.x - (ctx.measureText(b.text).width + 14) / 2, b.y - 22, ctx.measureText(b.text).width + 14, 18, 5, C.bubbleBg, C.hubCyan);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
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


<div class="apk-content">

  <section class="apk-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="apk-cnt">
      <div class="apk-intro-grid nero-ai-reveal">
        <div class="apk-intro-text">
          <p class="apk-eyebrow">Производство · ai производство контроль</p>
          <p>На малом производстве план и факт расходятся каждый день: сменные задания меняют в WhatsApp, простой замечают через два часа, а отчёт руководителю собирают вручную из Excel и чатов. <strong>AI-агент для производства</strong> закрывает обе боли в одном контуре: выдаёт и обновляет задания, фиксирует простои в момент события и формирует отчёт без ручного сбора данных.</p>
          <p>Nero Network внедряет <strong>ai производство контроль</strong> под ключ — с human-in-the-loop, чтобы вы получили эффект, а не очередной «цифровой эксперимент».</p>
        </div>
        <div class="apk-intro-kpi" aria-label="Ключевые метрики производства">
          <div class="apk-kpi-card"><div class="kv">30–70%</div><div class="kl">OEE на российских предприятиях</div><div class="ks">отраслевые обзоры 2026</div></div>
          <div class="apk-kpi-card"><div class="kv">50%</div><div class="kl">времени станков — потери</div><div class="ks">не только поломки</div></div>
          <div class="apk-kpi-card"><div class="kv">47 мин</div><div class="kl">типичный простой до алерта</div><div class="ks">без AI-контура</div></div>
          <div class="apk-kpi-card"><div class="kv">2–5 мин</div><div class="kl">фиксация с AI-агентом</div><div class="ks">целевой KPI пилота</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="apk-toc-outer">
    <div class="apk-cnt">
      <nav class="apk-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zachem-ai">Зачем AI</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#agentic-ai">Agentic AI</a>
        <a href="#smennie-zadaniya">Сменные задания</a>
        <a href="#prostoi-oee">Простои и OEE</a>
        <a href="#integracii">Интеграции</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#etapy">Этапы</a>
        <a href="#cena-roi">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Найти простои</a>
      </nav>
    </div>
  </div>

  <section class="apk-section" id="zachem-ai">
    <div class="apk-cnt">
      <div class="apk-sh apk-left nero-ai-reveal">
        <span class="apk-eyebrow">Главное ядро</span>
        <h2>Зачем производству AI-агент: ручные задания и поздние простои</h2>
        <p><strong>Определение:</strong> AI-агент для сменных заданий и контроля простоев — прикладной слой поверх уже существующих процессов цеха. Он не заменяет 1С, MES и мастера, а собирает данные по смене, обновляет задания при изменении плана и готовит сводку для руководителя.</p>
      </div>
      <p class="nero-ai-reveal">На российских предприятиях <strong>OEE часто составляет 30–70%</strong> при мировом классе 80–85%. До <strong>50% рабочего времени станков</strong> уходит на потери, не связанные с поломками. Малые цеха живут в Excel, бумажных нарядах и групповых чатах — разрыв между планом и фактом закрывается в конце смены, когда стоимость часа простоя уже списана.</p>
      <div class="apk-callout nero-ai-reveal"><p><strong>Коротко:</strong> если задачи меняются вручную, а простои фиксируются поздно — <strong>ai для производства</strong> с фокусом на смену и контроль даёт измеримый эффект быстрее, чем трёхлетняя «цифровая трансформация».</p></div>
      <div class="apk-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="apk-card">
          <h3>Почему Excel и чаты на смене не работают</h3>
          <ul>
            <li>07:45 — план в Excel, часть заданий устарела ещё вчера</li>
            <li>11:00 — простой 40 минут, никто не зафиксировал</li>
            <li>16:00 — входящая смена не знает, что не закрыто</li>
            <li>18:30 — отчёт собирают из трёх чатов</li>
          </ul>
          <p>Excel не шлёт алерт. Чат не считает OEE. Бумажный наряд не перестраивается при срыве поставки.</p>
        </div>
        <div class="apk-card nero-ai-delay-1">
          <h3>Сколько стоят незафиксированные простои</h3>
          <p><strong>Формула:</strong> стоимость потерь = часы простоя × стоимость часа простоя.</p>
          <p>Если час простоя стоит <strong>500–3 000 ₽</strong>, а в месяц «теряется» <strong>5–20 скрытых часов</strong> — это <strong>2 500–60 000 ₽</strong> на одном рабочем центре.</p>
          <p><strong>25–30%</strong> планового фонда времени уходит на простои — часто как «норма».</p>
        </div>
      </div>
      <div class="apk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apk-table">
          <thead><tr><th>Было</th><th>Стало с AI-агентом</th></tr></thead>
          <tbody>
            <tr><td>Простой узнали через 2 часа</td><td>Алерт за 2–5 минут</td></tr>
            <tr><td>Задания в 3 чатах</td><td>Единая очередь в Telegram</td></tr>
            <tr><td>Отчёт собирают 45 минут</td><td>Сводка генерируется автоматически</td></tr>
            <tr><td>OEE «примерно 60%»</td><td>OEE-лайт с декомпозицией потерь</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="kak-rabotaet">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Сменный контур</span>
        <h2>Как AI-агент работает на смене: от задания до отчёта руководителю</h2>
        <p><strong>ai сменные задания</strong> и <strong>ai контроль простоев</strong> в одном агенте — единый контур: план → исполнение → отклонения → отчёт → передача смены.</p>
      </div>
      <div class="apk-grid-3 nero-ai-reveal">
        <div class="apk-card">
          <h3>Сбор данных без ручного ввода</h3>
          <p>1С:УНФ, КА, ERP · Google Sheets · Telegram · датчики (опционально). Утром агент формирует пакет заданий — мастер подтверждает одной кнопкой.</p>
        </div>
        <div class="apk-card nero-ai-delay-1">
          <h3>Фиксация простоев в реальном времени</h3>
          <p>При простое &gt;15 мин — запрос причины из справочника, классификация, эскалация: 2 мин → мастер, 5 мин → руководитель.</p>
        </div>
        <div class="apk-card nero-ai-delay-2">
          <h3>Автоматический отчёт</h3>
          <p>OEE-лайт, топ-3 потери, briefing для входящей смены — в Telegram или на дашборд без «собери в конце дня».</p>
        </div>
      </div>
      <div class="apk-card nero-ai-reveal" style="margin-top:28px;">
        <h3>5 шагов работы агента на смене</h3>
        <div class="apk-steps">
          <div class="apk-step"><span class="apk-step-num">1</span><div><strong>Утро</strong><span>пакет сменных заданий с подтверждением мастера</span></div></div>
          <div class="apk-step"><span class="apk-step-num">2</span><div><strong>Смена</strong><span>фиксация старт/стоп операций</span></div></div>
          <div class="apk-step"><span class="apk-step-num">3</span><div><strong>Простой</strong><span>запрос причины + эскалация</span></div></div>
          <div class="apk-step"><span class="apk-step-num">4</span><div><strong>Отклонение</strong><span>перестановка заданий с утверждением</span></div></div>
          <div class="apk-step"><span class="apk-step-num">5</span><div><strong>Конец смены</strong><span>отчёт + briefing входящей смене</span></div></div>
        </div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
      <section id="ai-proizvodstvo-kontrol-prostoi-boris-block" class="apk-boris-root" aria-label="Анимация: сменный цикл AI-агента — от задания до отчёта руководителю">
<style>
/* === БОРИС: prefix apk-b-, scoped внутри #ai-proizvodstvo-kontrol-prostoi-boris-block === */
#ai-proizvodstvo-kontrol-prostoi-boris-block.apk-boris-root{
  padding:48px 0 56px;
  background:#f8fafc;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-lft{
  padding:36px 32px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:28px 22px;
  }
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0891b2;
  margin:0 0 12px;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-ey::before{
  content:'';
  width:18px;height:2px;
  background:#06b6d4;
  border-radius:1px;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-h3{
  font-size:clamp(19px,2.3vw,25px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 16px;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-steps{
  list-style:none;
  margin:0 0 18px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:8px;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-steps li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:13.5px;
  line-height:1.48;
  color:#334155;
  padding:6px 10px;
  border-radius:10px;
  transition:background .35s ease, box-shadow .35s ease;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-steps li.apk-b-active{
  background:rgba(6,182,212,.08);
  box-shadow:inset 3px 0 0 #06b6d4;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-num{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(6,182,212,.12);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  font-weight:800;
  color:#0e7490;
  margin-top:1px;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:14px;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:11.5px;
  font-weight:700;
  white-space:nowrap;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-pl-c{
  background:rgba(6,182,212,.08);
  color:#0e7490;
  border:1.5px solid rgba(6,182,212,.22);
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-pl-a{
  background:rgba(245,158,11,.08);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.28);
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-foot{
  font-size:12.5px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfeff 0%,#f0f9ff 35%,#fffbeb 70%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-proizvodstvo-kontrol-prostoi-boris-block .apk-b-rgt{min-height:360px;}
}
#apk-shift-cycle-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="apk-b-cnt">
  <div class="apk-b-card">

    <div class="apk-b-lft">
      <span class="apk-b-ey">Сменный контур · 5 шагов</span>
      <h3 class="apk-b-h3">От пакета заданий утром до briefing входящей смены — без Excel и обзвона</h3>
      <ol class="apk-b-steps" id="apk-b-step-list">
        <li data-step="0" class="apk-b-active"><span class="apk-b-num">1</span><span><strong>Утро</strong> — AI формирует пакет сменных заданий, мастер подтверждает в Telegram</span></li>
        <li data-step="1"><span class="apk-b-num">2</span><span><strong>Смена</strong> — исполнитель фиксирует старт и стоп операций на рабочих центрах</span></li>
        <li data-step="2"><span class="apk-b-num">3</span><span><strong>Простой</strong> — алерт &gt;15 мин, запрос причины, эскалация мастеру</span></li>
        <li data-step="3"><span class="apk-b-num">4</span><span><strong>Отклонение</strong> — перестановка очереди при срыве плана, human-in-the-loop</span></li>
        <li data-step="4"><span class="apk-b-num">5</span><span><strong>Отчёт</strong> — OEE-лайт, топ-3 потери, briefing для входящей смены</span></li>
      </ol>
      <div class="apk-b-pills">
        <span class="apk-b-pl apk-b-pl-c">OEE 68%</span>
        <span class="apk-b-pl apk-b-pl-a">Простой 47 мин</span>
        <span class="apk-b-pl apk-b-pl-g">12 заданий</span>
      </div>
      <p class="apk-b-foot">Дальше — agentic AI с проверкой человеком и тренд Gartner →</p>
    </div>

    <div class="apk-b-rgt">
      <canvas
        id="apk-shift-cycle-canvas"
        aria-label="Анимация сменного цикла: рабочие центры, фиксация простоя, подтверждение мастера и отчёт руководителю"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('apk-shift-cycle-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var stepList = document.getElementById('apk-b-step-list');
  var W = 0, H = 0, frame = 0;

  var PHASE_LEN = 130;
  var LOOP = PHASE_LEN * 5;

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
    cyan:'#06b6d4',
    cyanGlow:'rgba(6,182,212,.18)',
    amber:'#f59e0b',
    amberGlow:'rgba(245,158,11,.22)',
    green:'#22c55e',
    greenGlow:'rgba(34,197,94,.18)',
    violet:'#8b5cf6',
    floor:'#e2e8f0',
    floorDark:'#cbd5e1',
    rcIdle:'#f1f5f9',
    rcActive:'#ecfeff',
    rcDown:'#fff7ed',
    paper:'#ffffff',
    tg:'#229ed9'
  };

  var STEPS = ['Утро','Смена','Простой','Отклонение','Отчёт'];

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawFloor(pad, floorY, floorH){
    rr(pad, floorY, W-pad*2, floorH, 14, C.floor, C.floorDark, 1);
    ctx.strokeStyle='rgba(148,163,184,.35)';
    ctx.lineWidth=1;
    for(var lx=pad+40; lx<W-pad-20; lx+=48){
      ctx.beginPath();
      ctx.moveTo(lx, floorY+12);
      ctx.lineTo(lx, floorY+floorH-12);
      ctx.stroke();
    }
  }

  function drawWorkCenter(x, y, w, h, label, state, pulse){
    var fill = state==='down' ? C.rcDown : (state==='active' ? C.rcActive : C.rcIdle);
    var border = state==='down' ? C.amber : (state==='active' ? C.cyan : C.floorDark);
    rr(x, y, w, h, 10, fill, border, state==='down'?2.5:1.5);

    ctx.fillStyle=C.ink;
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(label, x+w/2, y+18);

    var barY = y+h-28;
    rr(x+10, barY, w-20, 8, 4, 'rgba(15,23,42,.06)', null, 0);
    var prog = state==='active' ? 0.55+Math.sin(pulse*0.04)*0.15 : (state==='down' ? 0.2 : 0.75);
    rr(x+10, barY, (w-20)*prog, 8, 4, state==='down'?C.amber:C.green, null, 0);

    if(state==='down'){
      ctx.fillStyle=C.amber;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.fillText('ПРОСТОЙ', x+w/2, y+h-10);
    } else if(state==='active'){
      ctx.fillStyle=C.cyan;
      ctx.font='9px Inter,sans-serif';
      ctx.fillText('в работе', x+w/2, y+h-10);
    }
  }

  function drawTelegramBubble(x, y, w, h, title, lines, alpha){
    ctx.globalAlpha = alpha || 1;
    rr(x, y, w, h, 12, C.paper, 'rgba(34,150,217,.35)', 1.5);
    rr(x+10, y+10, 28, 28, 14, C.tg, null, 0);
    ctx.fillStyle='#fff';
    ctx.font='bold 14px sans-serif';
    ctx.textAlign='center';
    ctx.fillText('✈', x+24, y+30);
    ctx.fillStyle=C.ink;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText(title, x+44, y+22);
    lines.forEach(function(ln,i){
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,sans-serif';
      ctx.fillText(ln, x+12, y+48+i*14);
    });
    ctx.globalAlpha=1;
  }

  function drawTaskCard(x, y, w, h, text, clr, alpha){
    ctx.globalAlpha = alpha || 1;
    rr(x, y, w, h, 6, clr||'#e0f2fe', C.cyan, 1);
    ctx.fillStyle=C.ink;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(text, x+w/2, y+h/2+3);
    ctx.globalAlpha=1;
  }

  function drawAlert(x, y, text, pulse){
    var a = 0.85+Math.sin(pulse*0.12)*0.15;
    ctx.globalAlpha=a;
    rr(x, y, 120, 26, 8, C.amberGlow, C.amber, 2);
    ctx.fillStyle='#b45309';
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(text, x+60, y+17);
    ctx.globalAlpha=1;
  }

  function drawConfirmBtn(x, y, pulse){
    var glow = 0.7+Math.sin(pulse*0.1)*0.3;
    ctx.globalAlpha=glow;
    rr(x, y, 96, 28, 8, C.greenGlow, C.green, 2);
    ctx.fillStyle='#15803d';
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('✓ Мастер', x+48, y+18);
    ctx.globalAlpha=1;
  }

  function drawReportPanel(x, y, w, h, oee, losses){
    rr(x, y, w, h, 12, 'rgba(15,23,42,.92)', '#334155', 1.5);
    ctx.fillStyle='#e2e8f0';
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Сменный отчёт', x+12, y+20);

    var cx=x+w/2, cy=y+52, r=28;
    ctx.beginPath();
    ctx.arc(cx,cy,r,0,Math.PI*2);
    ctx.strokeStyle='rgba(255,255,255,.12)';
    ctx.lineWidth=6;
    ctx.stroke();
    ctx.beginPath();
    ctx.arc(cx,cy,r,-Math.PI/2,-Math.PI/2+Math.PI*2*(oee/100));
    ctx.strokeStyle=C.cyan;
    ctx.lineWidth=6;
    ctx.stroke();
    ctx.fillStyle='#fff';
    ctx.font='bold 14px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(oee+'%', cx, cy+5);
    ctx.fillStyle=C.muted;
    ctx.font='8px Inter,sans-serif';
    ctx.fillText('OEE', cx, cy+18);

    losses.forEach(function(ln,i){
      ctx.fillStyle=i===0?C.amber:(i===1?'#fbbf24':C.muted);
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText('• '+ln, x+12, y+98+i*14);
    });
  }

  function drawPhaseBar(phase, prog){
    var barW = Math.min(280, W-40);
    var barX = (W-barW)/2;
    var barY = 14;
    rr(barX, barY, barW, 28, 10, 'rgba(255,255,255,.75)', 'rgba(148,163,184,.3)', 1);
    var segW = barW/5;
    for(var i=0;i<5;i++){
      var sx = barX + i*segW + 3;
      var sw = segW - 6;
      var active = i===phase;
      rr(sx, barY+4, sw, 20, 6, active?C.cyanGlow:'transparent', active?C.cyan:'transparent', active?1.5:0);
      ctx.fillStyle = active ? '#0e7490' : C.muted;
      ctx.font = (active?'bold ':'')+'8px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(STEPS[i], sx+sw/2, barY+17);
    }
    var indX = barX + phase*segW + segW*prog;
    ctx.fillStyle=C.cyan;
    ctx.beginPath();
    ctx.arc(indX, barY+34, 4, 0, Math.PI*2);
    ctx.fill();
  }

  function syncStepList(phase){
    if(!stepList) return;
    var items = stepList.querySelectorAll('li');
    items.forEach(function(li){
      li.classList.toggle('apk-b-active', parseInt(li.getAttribute('data-step'),10)===phase);
    });
  }

  function loop(){
    frame++;
    var t = frame % LOOP;
    var phase = Math.floor(t / PHASE_LEN);
    var localT = t % PHASE_LEN;
    var prog = localT / PHASE_LEN;

    ctx.clearRect(0,0,W,H);

    var pad = Math.max(12, W*0.04);
    var floorY = H*0.42;
    var floorH = Math.min(160, H*0.38);
    var rcW = Math.min(88, (W-pad*2-48)/3);
    var rcH = 72;
    var rcGap = (W - pad*2 - rcW*3) / 2;
    var rcY = floorY + 24;

    drawPhaseBar(phase, prog);
    drawFloor(pad, floorY, floorH);

    var rc1x = pad + 16;
    var rc2x = rc1x + rcW + rcGap;
    var rc3x = rc2x + rcW + rcGap;

    var rc1State = phase===1 ? 'active' : 'idle';
    var rc2State = phase===1 ? 'active' : 'idle';
    var rc3State = phase>=2 && phase<=3 ? 'down' : (phase===1 ? 'active' : 'idle');

    drawWorkCenter(rc1x, rcY, rcW, rcH, 'РЦ-1', rc1State, frame);
    drawWorkCenter(rc2x, rcY, rcW, rcH, 'РЦ-2', rc2State, frame);
    drawWorkCenter(rc3x, rcY, rcW, rcH, 'РЦ-3', rc3State, frame);

    if(phase===0){
      var cardX = pad + 20 + prog*(rc2x-rc1x);
      drawTaskCard(cardX, floorY-36, 64, 22, 'Задание #12', '#e0f2fe', 1);
      drawTelegramBubble(W-pad-150, floorY-50, 140, 72, 'Пакет смены',
        ['12 заданий · 3 РЦ','Мастер: подтвердить?'], Math.min(1, prog*2));
      if(prog>0.55) drawConfirmBtn(W-pad-110, floorY-58, frame);
    }

    if(phase===1){
      drawTaskCard(rc1x+14, rcY+30, 56, 18, 'Операция А', '#d1fae5', 0.9);
      drawTaskCard(rc2x+14, rcY+30, 56, 18, 'Операция Б', '#d1fae5', 0.9);
    }

    if(phase===2){
      drawAlert(rc3x-16, rcY-32, 'Простой >15 мин', frame);
      drawTelegramBubble(pad+8, floorY-54, 130, 68, 'Причина простоя',
        ['1. Наладка','2. Нет материала','3. Поломка'], Math.min(1, prog*1.5));
    }

    if(phase===3){
      var swapProg = Math.min(1, prog*1.2);
      drawTaskCard(rc3x+8, rcY-28-swapProg*20, 58, 20, '→ РЦ-2', '#fef3c7', swapProg);
      drawConfirmBtn(rc2x+rcW/2-48, floorY+floorH+8, frame);
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('Перестановка с подтверждением', W/2, floorY+floorH+44);
    }

    if(phase===4){
      var rpW = Math.min(170, W*0.32);
      var rpH = 130;
      var rpX = W - pad - rpW - 8;
      var rpY = floorY - 8;
      drawReportPanel(rpX, rpY, rpW, rpH, 68, ['Нет материала · 47 мин','Наладка · 22 мин','Ожидание · 15 мин']);
      drawTelegramBubble(pad+6, floorY-48, 138, 64, 'Briefing смены',
        ['3 незакрытых операции','1 критичный простой'], Math.min(1, prog*1.8));
    }

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Цех · сменный контур', pad, H-10);
    ctx.textAlign='right';
    ctx.fillText('AI-агент · human-in-the-loop', W-pad, H-10);

    if(frame % 8 === 0) syncStepList(phase);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>
    </div>
  </section>

  <section class="apk-section" id="agentic-ai">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Agentic AI</span>
        <h2>Agentic AI на производстве: автономность с проверкой человеком</h2>
        <p><strong>Agentic AI</strong> — системы, которые планируют шаги, собирают данные и выполняют цепочку действий. На производстве это <strong>bounded agent</strong> с обязательной проверкой человека.</p>
      </div>
      <div class="apk-quote nero-ai-reveal">
        <p>«Most agentic AI projects right now are early stage experiments or proof of concepts that are mostly driven by hype and are often misapplied»</p>
        <cite>— Anushree Verma, Gartner, 25.06.2025</cite>
      </div>
      <p class="nero-ai-reveal">По прогнозу Gartner, <strong>более 40% проектов agentic AI будут отменены к концу 2027</strong>. Вывод для владельца цеха: продавать нужно не «автономный завод», а <strong>агент с human-in-the-loop</strong>.</p>
      <div class="apk-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="apk-card">
          <h3>Человек обязателен</h3>
          <ul>
            <li>подтверждение сменных заданий и перестановок</li>
            <li>финальная классификация нестандартных простоев</li>
            <li>технологические решения при браке и авариях</li>
            <li>юридическая и производственная ответственность</li>
          </ul>
        </div>
        <div class="apk-card nero-ai-delay-1">
          <h3>Агент делает сам</h3>
          <ul>
            <li>сбор контекста из 1С, таблиц, чатов</li>
            <li>формирование очереди заданий</li>
            <li>классификацию типовых причин простоев</li>
            <li>генерацию отчётов и briefing смены</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="smennie-zadaniya">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Сменные задания</span>
        <h2>Сменные задания без хаоса: выдача, обновление, контроль исполнения</h2>
      </div>
      <div class="apk-grid-3 nero-ai-reveal">
        <div class="apk-card"><h3>Мебельная фабрика</h3><p>Заказы в 1С:УНФ, сдельные наряды. AI: утренний пакет → перестановка при срыве поставки → фиксация «нет материала».</p></div>
        <div class="apk-card nero-ai-delay-1"><h3>Пищевое производство</h3><p>35% простоев — смена материалов (кейс «Камский»). AI фиксирует простой, классифицирует, связывает с планом смены.</p></div>
        <div class="apk-card nero-ai-delay-2"><h3>Универсальный цех</h3><p>План в Excel, факт — устно. Telegram-бот → очередь операций → эскалация → сравнение смен.</p></div>
      </div>
      <div class="apk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apk-table">
          <thead><tr><th>Роль</th><th>Было</th><th>С AI-агентом</th></tr></thead>
          <tbody>
            <tr><td>Диспетчер</td><td>Собирает потребности вручную</td><td>Агент читает заказы из 1С, диспетчер корректирует</td></tr>
            <tr><td>Мастер</td><td>Раздаёт задания, не выходит в цех</td><td>Подтверждает пакет, управляет отклонениями</td></tr>
            <tr><td>Исполнитель</td><td>Отмечает «сделал» в чате</td><td>Фиксирует старт/стоп в боте</td></tr>
            <tr><td>Руководитель</td><td>Ждёт отчёт в конце дня</td><td>Получает сводку и OEE-лайт автоматически</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="apk-section" id="prostoi-oee">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">KPI и OEE</span>
        <h2>Контроль простоев и OEE: KPI, которые видит руководитель</h2>
        <p><strong>OEE = Доступность × Производительность × Качество</strong>. Для российских предприятий 65–75% — хорошая отправная точка; цель 75–80% за год.</p>
      </div>
      <div class="apk-table-wrap nero-ai-reveal">
        <table class="apk-table">
          <thead><tr><th>Метрика</th><th>Что показывает</th><th>Как помогает AI-агент</th></tr></thead>
          <tbody>
            <tr><td>OEE</td><td>Общая эффективность</td><td>Автосбор факта по смене</td></tr>
            <tr><td>MTBF / MTTR</td><td>Наработка / восстановление</td><td>Паттерны до отказа, эскалация</td></tr>
            <tr><td>Длительность простоев</td><td>Топ КПЭ ТОиР</td><td>Мгновенная фиксация</td></tr>
            <tr><td>План/факт смены</td><td>Выполнение заданий</td><td>Очередь + статусы</td></tr>
          </tbody>
        </table>
      </div>
      <div class="apk-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Карта потерь производства как старт аудита</h3>
        <p><strong>Лид-магнит Nero Network — «Карта потерь производства»</strong> — экспресс-аудит за 1–2 дня: обход цеха, оценка стоимости часа простоя, топ-3 причин, рекомендация пилотного участка. Выход — PDF + план пилота.</p>
      </div>
      <aside class="ym-cta-block ym-cta-block--primary" id="cta-karta-poter">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Карта потерь производства — бесплатный аудит за 1–2 дня</p>
          <p class="ym-cta-block__sub">Обойдём цех, зафиксируем точки простоев и оценим стоимость часа остановки. На выходе — PDF «Карта потерь» и рекомендация пилотного участка без обязательств по внедрению.</p>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        </div>
      </aside>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="integracii">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Интеграции</span>
        <h2>Интеграции без большого IT-бюджета: 1С, MES, таблицы, Telegram</h2>
      </div>
      <div class="apk-table-wrap nero-ai-reveal">
        <table class="apk-table">
          <thead><tr><th>Источник</th><th>Пилот (4–8 недель)</th><th>Тираж</th></tr></thead>
          <tbody>
            <tr><td>Telegram</td><td>Бот для мастера и исполнителей</td><td>Расширение на все смены</td></tr>
            <tr><td>Google Sheets / Excel</td><td>План смены, справочник простоев</td><td>Миграция в 1С</td></tr>
            <tr><td>1С:УНФ / КА / ERP</td><td>Чтение заказов и операций</td><td>Двусторонняя синхронизация</td></tr>
            <tr><td>n8n / Make</td><td>Оркестрация триггеров</td><td>Масштабирование правил</td></tr>
          </tbody>
        </table>
      </div>
      <div class="apk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apk-table">
          <thead><tr><th></th><th>Excel / чаты</th><th>MES «на миллионы»</th><th>AI-агент Nero Network</th></tr></thead>
          <tbody>
            <tr><td>Стоимость входа</td><td>0 ₽</td><td>5–80 млн ₽</td><td>500 тыс.–2 млн ₽</td></tr>
            <tr><td>Фиксация простоев</td><td>Поздняя</td><td>В реальном времени</td><td>В реальном времени + AI-аналитика</td></tr>
            <tr><td>Срок внедрения</td><td>—</td><td>6–18 месяцев</td><td>4–8 недель пилот</td></tr>
            <tr><td>Human-in-the-loop</td><td>—</td><td>Зависит от MES</td><td>По умолчанию</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="apk-section" id="dlya-kogo">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит: малое производство, цеха, мебель, пищевка</h2>
      </div>
      <div class="apk-grid-2 nero-ai-reveal">
        <div class="apk-card">
          <h3>Где AI-агент даёт быстрый эффект</h3>
          <div class="apk-checklist">
            <div class="apk-check apk-check-yes">Цех 10–50 человек с ручной диспетчеризацией</div>
            <div class="apk-check apk-check-yes">2+ рабочих центра с перекидыванием заданий</div>
            <div class="apk-check apk-check-yes">План в 1С, Excel или Google Sheets</div>
            <div class="apk-check apk-check-yes">Руководитель хочет OEE-лайт без MES</div>
          </div>
        </div>
        <div class="apk-card nero-ai-delay-1">
          <h3>Где нужен оператор-контролёр</h3>
          <div class="apk-checklist">
            <div class="apk-check apk-check-no">Нет владельца процесса — «внедрим AI, а дальше сами»</div>
            <div class="apk-check apk-check-no">Данные о простоях никогда не фиксировались</div>
            <div class="apk-check apk-check-no">Ожидание «цифрового директора завода»</div>
          </div>
          <p style="margin-top:14px;">В этих случаях начните с <strong>Карты потерь</strong> — иногда проблема в процессе, а не в технологии.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="etapy">
    <div class="apk-cnt">
      <div class="apk-sh apk-left nero-ai-reveal">
        <span class="apk-eyebrow">Под ключ</span>
        <h2>Внедрение AI-агента под ключ: этапы от аудита до запуска на смене</h2>
      </div>
      <div class="apk-card nero-ai-reveal">
        <div class="apk-timeline">
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Аудит «Карта потерь» (1–2 дня)</h3><p>Как выдаются задания, карта точек фиксации простоев, оценка стоимости часа, топ-3 причин. Выход: PDF + рекомендация пилотного участка.</p></div>
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Пилот на одной линии (4–8 недель)</h3><p>1С / таблица / Telegram. AI-агент: задания, простои, эскалация, отчёт. KPI в договоре. Чек Nero Network 500 тыс.–2 млн ₽.</p></div>
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Масштабирование и обучение мастеров</h3><p>Расширение на второй цех / смену, датчики (опционально), 2–3 сессии обучения — Telegram уже на телефоне.</p></div>
        </div>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI на производстве полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с 1С — это ускоряет согласование с мастерами и IT. Посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $secondary_cta_label ); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="apk-section" id="cena-roi">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Коммерция</span>
        <h2>Стоимость, сроки и окупаемость</h2>
        <p>Ориентир чека <strong>500 тыс.–2 млн ₽</strong>. Для пилота на одном участке — от 500 000 ₽.</p>
      </div>
      <div class="apk-table-wrap nero-ai-reveal">
        <table class="apk-table">
          <thead><tr><th>Компонент</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Аудит «Карта потерь»</td><td>Обход цеха, PDF, рекомендации</td></tr>
            <tr><td>Разработка AI-агента</td><td>Модули заданий, простоев, эскалации, отчётности</td></tr>
            <tr><td>Интеграции</td><td>1С, Telegram, таблицы, n8n</td></tr>
            <tr><td>Пилот 4–8 недель</td><td>Запуск на одном участке, KPI</td></tr>
          </tbody>
        </table>
      </div>
      <div class="apk-calc nero-ai-reveal">Потери в месяц = часы простоя × стоимость часа × кол-во центров
Экономия = (сокращение часов простоя на 20–40%) × стоимость часа
Окупаемость = стоимость пилота / экономия в месяц

Пример: 10 ч × 1 500 ₽/час = 15 000 ₽/мес. Сокращение на 30% = 4 500 ₽/мес.
На 3–5 участках — окупаемость за 6–18 месяцев.</div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="keisy">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Кейсы</span>
        <h2>Примеры внедрения и кейсы</h2>
      </div>
      <div class="apk-case-grid nero-ai-reveal">
        <div class="apk-case-card"><div class="apk-case-tag">Мебель</div><h3>Задачи в WhatsApp → единый контур</h3><p>18 человек. AI читает 1С:УНФ, перестановка кнопкой мастера. Время перестройки — с 40–60 мин до 5–10 мин.</p></div>
        <div class="apk-case-card"><div class="apk-case-tag">Пищевка</div><h3>Простой через 2 часа → алерт за минуты</h3><p>Линия упаковки. Исполнитель отмечает простой в боте, через 15 мин — эскалация мастеру. Топ причин за неделю без ручного сбора.</p></div>
        <div class="apk-case-card"><div class="apk-case-tag">Универсальный цех</div><h3>Передача смены без потери задач</h3><p>Briefing: незакрытые операции, критичные простои, приоритеты. По аналогии с Oxmaint — снижение «потери задач» до 8%.</p></div>
      </div>
    </div>
  </section>

  <section class="apk-section" id="faq">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">FAQ</span>
        <h2>FAQ: внедрение AI на производстве</h2>
      </div>
      <div class="apk-faq nero-ai-reveal">
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли свой IT-отдел?</div><div class="apk-faq-a">Нет для пилота. Nero Network берёт разработку и интеграцию. На стороне заказчика нужен владелец процесса — мастер или производственный директор.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Как связать с 1С и ERP?</div><div class="apk-faq-a">Агент читает документы через API или ODBC. Поддерживаются 1С:УНФ, КА, ERP. Агент — надстройка, не замена 1С.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Чем agentic AI отличается от «просто дашборда»?</div><div class="apk-faq-a">Дашборд показывает цифры. Agentic AI собирает данные, предлагает действия, генерирует отчёты. Критические решения — за человеком.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли датчики на станках?</div><div class="apk-faq-a">Нет для старта. Фиксация через Telegram-бот или планшет. Датчики — опция на этапе тиража.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Работает ли без 1С?</div><div class="apk-faq-a">Да. План смены можно вести в Google Sheets или Excel — агент подключится к таблице.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Кто отвечает, если AI ошибся?</div><div class="apk-faq-a">Агент не меняет план без подтверждения мастера. Ответственность — за человеком. Все действия логируются.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Как соблюдается 152-ФЗ?</div><div class="apk-faq-a">Yandex GPT / GigaChat в облаке или on-premise. На тираже — развёртывание в контуре заказчика.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько времени до первого результата?</div><div class="apk-faq-a">Карта потерь — 1–2 дня. Пилот на участке — 4–8 недель до рабочего контура на смене.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Как заказать аудит и внедрение?</div><div class="apk-faq-a">Оставьте заявку с CTA «Найти простои» — проведём экспресс-аудит и подготовим «Карту потерь производства».</div></div>
      </div>
    </div>
  </section>

  <section class="apk-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="apk-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Найти простои на вашем производстве</p>
          <p class="ym-cta-block__sub">Задачи меняются вручную. Простои фиксируются поздно. <strong>Nero Network</strong> внедряет AI-агент для производства под ключ — с human-in-the-loop, интеграцией с 1С и Telegram. Первый шаг — бесплатная «Карта потерь производства»: обход цеха, оценка стоимости часа простоя, топ-3 причин.</p>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        </div>
      </div>
    </div>
  </section>

</div>

<!-- INTERNAL-LINKS:INSERT -->
<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.apk-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.apk-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.apk-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.apk-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
    });
    btn.addEventListener('keydown', function(e){
      if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.apk-prostoi-page') || document.querySelector('.apk-content');
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

<?php if ( getenv( 'AD_BANNER_URL' ) && getenv( 'AD_BANNER_IMAGE_URL' ) ) : ?>
<div class="apk-ad-banner" style="text-align:center;padding:24px 0 40px;">
  <a href="<?php echo esc_url( getenv( 'AD_BANNER_URL' ) ); ?>" target="_blank" rel="noopener noreferrer">
    <img src="<?php echo esc_url( getenv( 'AD_BANNER_IMAGE_URL' ) ); ?>" width="970" height="90" alt="<?php echo esc_attr( getenv( 'AD_BANNER_ALT' ) ?: 'Реклама' ); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;">
  </a>
</div>
<?php endif; ?>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

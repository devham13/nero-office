<?php
/**
 * Template Name: Внедрение AI-поиска по договорам и приложениям под ключ
 * Description: SEO-лендинг — RAG-поиск по договорам, цитирование PDF, OCR сканов. Внедрение под ключ для юротдела.
 */

$page_seo_title       = 'Внедрение AI-поиска по договорам под ключ — RAG для юротдела';
$page_seo_description = 'AI-поиск по договорам и приложениям: нейросеть находит пункты, сроки, суммы и риски за секунды с цитированием источника в PDF. Внедрение RAG под ключ для юротдела, закупок и финансов.';

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
    ['label' => 'Что это', 'href' => '#chto-takoe'],
    ['label' => 'Как ищет', 'href' => '#kak-ishchet'],
    ['label' => 'RAG', 'href' => '#rag-sistema'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить документы';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '';
if (empty($secondary_cta_url) || $secondary_cta_url === '#') {
    $secondary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
}
$secondary_cta_attrs = nero_ai_primary_cta_link_attrs($secondary_cta_url);

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

.ragdog-hero{min-height:100vh;min-height:100dvh;position:relative;}

.ragdog-content{
  --rd-bg:#050711;--rd-bg2:#080b17;
  --rd-surface:rgba(255,255,255,.072);
  --rd-text:#e6edf7;--rd-muted:#9aa8bd;--rd-soft:#c7d2e5;--rd-heading:#fff;
  --rd-border:rgba(255,255,255,.10);
  --rd-accent:#818cf8;--rd-violet:#a78bfa;--rd-amber:#fbbf24;--rd-green:#34d399;
  --rd-btn-from:#6366f1;--rd-btn-to:#a78bfa;
  --rd-r:18px;--rd-r-lg:24px;--rd-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--rd-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.ragdog-content *,.ragdog-content *::before,.ragdog-content *::after{box-sizing:border-box;}
.ragdog-content a{color:inherit;}
.ragdog-content p{color:var(--rd-muted);line-height:1.72;margin:0 0 1em;}
.ragdog-content p:last-child{margin-bottom:0;}
.ragdog-content h2,.ragdog-content h3,.ragdog-content h4{color:var(--rd-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.ragdog-content strong{color:var(--rd-soft);}
.ragdog-content ul,.ragdog-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.ragdog-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--rd-muted);font-size:14.5px;line-height:1.65;}
.ragdog-content ul li::before{content:'›';position:absolute;left:0;color:var(--rd-accent);font-weight:700;}
.ragdog-content ol{counter-reset:rd-ol;}
.ragdog-content ol li{counter-increment:rd-ol;padding-left:28px;position:relative;margin-bottom:.5em;color:var(--rd-muted);font-size:14.5px;line-height:1.65;}
.ragdog-content ol li::before{content:counter(rd-ol);position:absolute;left:0;width:20px;height:20px;border-radius:50%;background:rgba(129,140,248,.15);color:var(--rd-accent);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;top:2px;}
.ragdog-cnt{width:min(var(--rd-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.ragdog-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.ragdog-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.ragdog-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.ragdog-sh.ragdog-left{margin-left:0;text-align:left;}
.ragdog-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.ragdog-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.ragdog-sh.ragdog-left p{margin-left:0;}
.ragdog-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(129,140,248,.08);border:1px solid rgba(129,140,248,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--rd-accent);margin-bottom:14px;}
.ragdog-gt{background:linear-gradient(92deg,#fff 0%,var(--rd-accent) 44%,var(--rd-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.ragdog-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.ragdog-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.ragdog-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.ragdog-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--rd-accent),var(--rd-violet));}
.ragdog-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--rd-muted);margin-bottom:1em;}
.ragdog-intro-text p:last-child{margin-bottom:0;color:var(--rd-soft);}
.ragdog-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.ragdog-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.ragdog-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--rd-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.ragdog-kpi-card .kl{font-size:11px;font-weight:600;color:var(--rd-muted);line-height:1.4;}
.ragdog-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.ragdog-intro-grid{grid-template-columns:1fr;gap:36px;}.ragdog-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.ragdog-intro-kpi{grid-template-columns:1fr 1fr;}}
.ragdog-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.ragdog-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.ragdog-toc a{display:inline-block;padding:9px 18px;background:var(--rd-surface);border:1px solid var(--rd-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--rd-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.ragdog-toc a:hover{border-color:rgba(129,140,248,.42);color:var(--rd-accent);background:rgba(129,140,248,.08);}
.ragdog-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--rd-border);border-radius:var(--rd-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;margin-bottom:16px;}
.ragdog-card:hover{border-color:rgba(129,140,248,.28);transform:translateY(-2px);}
.ragdog-card:last-child{margin-bottom:0;}
.ragdog-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.ragdog-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.ragdog-grid-2,.ragdog-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.ragdog-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.ragdog-grid-3{grid-template-columns:1fr;}}
.ragdog-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--rd-r);padding:26px;margin-bottom:14px;}
.ragdog-scenario:last-child{margin-bottom:0;}
.ragdog-scenario h3{font-size:17px;margin-bottom:8px;}
.ragdog-scenario p{font-size:14.5px;margin:0 0 .6em;}
.ragdog-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.ragdog-table{width:100%;border-collapse:collapse;font-size:14px;}
.ragdog-table th{padding:13px 16px;text-align:left;background:rgba(129,140,248,.1);color:var(--rd-accent);font-weight:700;border-bottom:1px solid rgba(129,140,248,.25);white-space:nowrap;}
.ragdog-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--rd-text);vertical-align:top;}
.ragdog-table tr:last-child td{border-bottom:none;}
.ragdog-table tr:hover td{background:rgba(255,255,255,.03);}
.ragdog-pipeline{display:block;padding:14px 18px;border-radius:12px;background:rgba(15,23,42,.6);border:1px solid rgba(129,140,248,.2);font-family:ui-monospace,monospace;font-size:13px;color:var(--rd-soft);margin:16px 0;overflow-x:auto;}
.ragdog-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.ragdog-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.ragdog-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--rd-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.ragdog-faq-q::after{content:'▾';font-size:13px;color:var(--rd-accent);flex-shrink:0;transition:transform .25s;}
.ragdog-faq-item.open .ragdog-faq-q::after{transform:rotate(180deg);}
.ragdog-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--rd-muted);line-height:1.72;}
.ragdog-faq-item.open .ragdog-faq-a{max-height:800px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(129,140,248,.12),rgba(167,139,250,.1));border:1px solid rgba(129,140,248,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(167,139,250,.12),rgba(129,140,248,.08));border-color:rgba(167,139,250,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--rd-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--rd-btn-from),var(--rd-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(99,102,241,.35);}
.ym-link--accent{color:var(--rd-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-poisk-po-dogovoram-page" role="main" tabindex="-1">
<span id="main" class="screen-reader-text" tabindex="-1" aria-hidden="true"></span>

<section class="nero-ai-hero ragdog-hero" id="ragdog-hero" aria-labelledby="ragdog-hero-title">
<style>
/* ── Hero vnedrenie-ai-poisk-po-dogovoram: самодостаточные стили nero-ai-home ── */
.ragdog-hero {
  --ragdog-indigo: #818cf8;
  --ragdog-violet: #a78bfa;
  --ragdog-amber: #fbbf24;
  --ragdog-green: #34d399;
  --ragdog-text: #e6edf7;
  --ragdog-muted: #9aa8bd;
  --ragdog-soft: #c7d2e5;
  --ragdog-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.ragdog-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.ragdog-hero::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 560px;
  height: 560px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(129, 140, 248, .14), transparent 66%);
  filter: blur(10px);
  animation: ragdogHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes ragdogHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.04); }
}
.ragdog-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.ragdog-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.ragdog-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 64px);
  line-height: 1.02;
  letter-spacing: -0.05em;
  color: #fff;
  font-weight: 900;
}
.ragdog-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--ragdog-indigo) 38%, var(--ragdog-amber) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.ragdog-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(129, 140, 248, 0.28);
  border-radius: 999px;
  background: rgba(129, 140, 248, 0.1);
  color: var(--ragdog-indigo) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.ragdog-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--ragdog-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.ragdog-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.ragdog-hero .nero-ai-badge {
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
.ragdog-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.ragdog-hero .nero-ai-btn {
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
.ragdog-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.ragdog-hero .nero-ai-btn-primary {
  color: #0f172a !important;
  background: linear-gradient(135deg, var(--ragdog-indigo), #c4b5fd);
  box-shadow: 0 18px 42px rgba(129, 140, 248, 0.28);
}
.ragdog-hero .nero-ai-btn-secondary {
  color: var(--ragdog-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.ragdog-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--ragdog-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.ragdog-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.ragdog-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.ragdog-hero .nero-ai-dots { display: flex; gap: 7px; }
.ragdog-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.ragdog-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.ragdog-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.ragdog-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.ragdog-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.ragdog-hero .nero-ai-window-body { padding: 16px; }
.ragdog-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.ragdog-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.ragdog-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(52, 211, 153, .10);
  color: #a7f3d0;
  font-size: 12px;
  font-weight: 800;
}
.ragdog-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--ragdog-green);
  box-shadow: 0 0 0 6px rgba(52, 211, 153, .14);
  animation: ragdogPulse 1.6s infinite;
}
@keyframes ragdogPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.ragdog-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.ragdog-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.ragdog-hero .nero-ai-metric span {
  display: block;
  color: var(--ragdog-muted);
  font-size: 11px;
  font-weight: 700;
}
.ragdog-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.ragdog-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.ragdog-hero .ragdog-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(129, 140, 248, 0.2);
  background: radial-gradient(ellipse at 45% 35%, rgba(129,140,248,.1), rgba(6,10,24,.92) 72%);
}
.ragdog-hero #ragdog-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.ragdog-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.ragdog-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.ragdog-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(129,140,248,.14);
  color: var(--ragdog-indigo);
  font-size: 11px;
  font-weight: 800;
}
.ragdog-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.ragdog-hero .nero-ai-task span {
  color: var(--ragdog-muted);
  font-size: 11px;
}
.ragdog-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(52,211,153,.11);
  color: #a7f3d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.ragdog-hero .nero-ai-status--amber {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
.ragdog-hero .nero-ai-status--violet {
  background: rgba(167,139,250,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .ragdog-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .ragdog-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .ragdog-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .ragdog-hero .nero-ai-window-body { padding: 12px; }
  .ragdog-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .ragdog-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Документы / RAG · внедрение под ключ</p>
      <h1 id="ragdog-hero-title">Внедрение AI-поиска по договорам и приложениям <span class="nero-ai-gradient-text">под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть находит пункты, сроки, суммы и риски в договорах за секунды — с точной ссылкой на источник в документе</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">RAG-поиск</li>
        <li class="nero-ai-badge">Цитирование PDF</li>
        <li class="nero-ai-badge">OCR сканов</li>
        <li class="nero-ai-badge">On-prem</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить документы</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#rag-sistema">Как устроена система</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-поиска по договорному архиву">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики RAG · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Юридический RAG-центр</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Договоров в индексе</span>
              <strong>2 400+</strong>
              <small>договор + приложения</small>
            </div>
            <div class="nero-ai-metric">
              <span>Время ответа</span>
              <strong>3 сек</strong>
              <small>типовой запрос</small>
            </div>
            <div class="nero-ai-metric">
              <span>Citation rate</span>
              <strong>96%</strong>
              <small>с валидной ссылкой</small>
            </div>
            <div class="nero-ai-metric">
              <span>Сканы OCR</span>
              <strong>да</strong>
              <small>PDF без текстового слоя</small>
            </div>
          </div>

          <div class="ragdog-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ragdog-hero-canvas" role="img" aria-label="Анимация: страницы договоров поднимаются в архиве, RAG находит пункт и подсвечивает цитату в PDF"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента запросов к договорному архиву">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">?</span>
              <div><strong>Срок оплаты по ООО «Ромашка»</strong><span>п. 4.2 · Договор_поставки_2024.pdf</span></div>
              <span class="nero-ai-status">цитата</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⚠</span>
              <div><strong>Неустойка выше порога</strong><span>Риск · приложение № 2</span></div>
              <span class="nero-ai-status nero-ai-status--amber">риск</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↳</span>
              <div><strong>Цепочка: договор + допсоглашение №3</strong><span>Единый запрос по контрагенту</span></div>
              <span class="nero-ai-status nero-ai-status--violet">связано</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">∅</span>
              <div><strong>Нет в корпусе — честный отказ</strong><span>Без галлюцинации условия</span></div>
              <span class="nero-ai-status">grounding</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * ragdog-hero-engine — «Архивный зал RAG-цитирования»
 * Мир: вертикальный лифт договоров → embedding-поле → hybrid retrieval → подсветка пункта в PDF
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ragdog-hero-canvas");
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
    docCream: "#fef9c3",
    docBlue: "#dbeafe",
    docRose: "#fce7f3",
    docMint: "#d1fae5",
    liftRail: "#475569",
    hubBase: "#1e1b4b",
    hubAccent: "#818cf8",
    citeAmber: "#fbbf24",
    citeGlow: "rgba(251,191,36,0.45)",
    riskRed: "rgba(239,68,68,0.85)",
    vectorNode: "#a78bfa",
    vectorLine: "rgba(167,139,250,0.35)",
    scanCyan: "rgba(56,189,248,0.5)",
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

  function drawContractPage(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, color, C.outline);
    ctx.strokeStyle = "rgba(148,163,184,0.45)";
    ctx.lineWidth = 0.7;
    for (var i = 0; i < 4; i++) {
      ctx.beginPath();
      ctx.moveTo(x - w / 2 + 3, y - h / 2 + 5 + i * 4);
      ctx.lineTo(x + w / 2 - 3, y - h / 2 + 5 + i * 4);
      ctx.stroke();
    }
    if (label) {
      ctx.fillStyle = C.outline;
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, x, y + 2);
    }
  }

  /* Вертикальный лифт страниц — вместо Conveyor */
  function DocumentLiftCarousel() {
    this.pages = [
      { offset: 0, color: C.docCream, label: "Дог" },
      { offset: 55, color: C.docBlue, label: "ДС" },
      { offset: 110, color: C.docRose, label: "Прил" }
    ];
  }
  DocumentLiftCarousel.prototype.draw = function (ctx) {
    var railX = -168;
    drawRR(ctx, railX - 6, -92, 12, 118, 4, "rgba(30,41,59,0.55)", C.liftRail);
    ctx.fillStyle = C.hubAccent;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Архив", railX - 4, -98);

    var prg = (frame * 0.036) % 250;
    this.pages.forEach(function (pg) {
      var t = ((frame * 0.42 + pg.offset) % 110) / 110;
      var py = 28 - t * 108;
      if (t < 0.88) drawContractPage(ctx, railX, py, 15, 20, pg.color, pg.label);
      if (prg > 8 && prg < 52 && t > 0.35 && t < 0.5) {
        ctx.save();
        ctx.globalAlpha = 0.35 + Math.sin(frame * 0.15) * 0.15;
        ctx.fillStyle = C.scanCyan;
        ctx.fillRect(railX - 12, py - 12, 24, 26);
        ctx.restore();
      }
    });
  };

  /* Плавающие embedding-узлы — фоновая волна */
  function EmbeddingNodeField() {
    this.nodes = [];
    for (var i = 0; i < 14; i++) {
      this.nodes.push({
        x: -120 + Math.random() * 240,
        y: -70 + Math.random() * 120,
        r: 2 + Math.random() * 2.5,
        phase: Math.random() * Math.PI * 2
      });
    }
  }
  EmbeddingNodeField.prototype.draw = function (ctx) {
    var prg = (frame * 0.036) % 250;
    if (prg < 48) return;
    var pulse = prg > 48 && prg < 175 ? 1 : 0.35;
    this.nodes.forEach(function (n, i) {
      var nx = n.x + Math.sin(frame * 0.02 + n.phase) * 6;
      var ny = n.y + Math.cos(frame * 0.018 + n.phase) * 5;
      ctx.fillStyle = C.vectorNode;
      ctx.globalAlpha = 0.25 + pulse * 0.45;
      ctx.beginPath();
      ctx.arc(nx, ny, n.r, 0, Math.PI * 2);
      ctx.fill();
      if (i % 3 === 0 && pulse > 0.5) {
        var j = (i + 4) % 14;
        var n2 = this.nodes[j];
        ctx.strokeStyle = C.vectorLine;
        ctx.lineWidth = 0.8;
        ctx.beginPath();
        ctx.moveTo(nx, ny);
        ctx.lineTo(n2.x, n2.y);
        ctx.stroke();
      }
    }, this);
    ctx.globalAlpha = 1;
  };

  /* Консоль RAG — вместо WebsiteTerminal */
  function CitationRetrievalHub() {
    this.beamAngle = 0;
  }
  CitationRetrievalHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.036) % 250;
    drawRR(ctx, -42, -82, 108, 138, 10, C.hubBase, C.outline);

    drawRR(ctx, -36, -74, 96, 16, [6, 6, 0, 0], "rgba(129,140,248,0.35)", null);
    ctx.fillStyle = "#e0e7ff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("RAG · запрос", -30, -64);

    /* Поле вопроса */
    drawRR(ctx, -34, -52, 92, 14, 4, "rgba(255,255,255,0.08)", C.outline);
    if (prg > 95) {
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("Срок оплаты?", -30, -43);
    }

    /* Чанки retrieval */
    if (prg > 108) {
      var chunks = ["п. 4.2 оплата", "ДС №3 срок", "прил. график"];
      chunks.forEach(function (c, i) {
        var on = prg > 112 + i * 14;
        drawRR(ctx, -32, -30 + i * 16, 88, 12, 3, on ? "rgba(167,139,250,0.22)" : "rgba(255,255,255,0.05)", C.outline);
        if (on) {
          ctx.fillStyle = "#ddd6fe";
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.fillText(c, -28, -21 + i * 16);
        }
      });
    }

    /* Ответ с grounding */
    if (prg > 168) {
      var ansPrg = Math.min(1, (prg - 168) / 20);
      ctx.globalAlpha = ansPrg;
      drawRR(ctx, -34, 22, 92, 28, 5, "rgba(52,211,153,0.12)", C.outline);
      ctx.fillStyle = "#a7f3d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("14 календ. дней", -28, 34);
      ctx.fillStyle = C.citeAmber;
      ctx.fillText("↗ п. 4.2 · стр. 7", -28, 44);
      ctx.globalAlpha = 1;
    }

    /* Hybrid beam */
    if (prg > 118 && prg < 165) {
      this.beamAngle += 0.08;
      ctx.save();
      ctx.translate(12, -10);
      ctx.rotate(this.beamAngle);
      ctx.strokeStyle = "rgba(129,140,248,0.55)";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(0, 0);
      ctx.lineTo(55, 0);
      ctx.stroke();
      ctx.restore();
    }
  };

  /* PDF с подсветкой пункта */
  function ClauseHighlightPane() {
    this.highlight = 0;
  }
  ClauseHighlightPane.prototype.draw = function (ctx) {
    var prg = (frame * 0.036) % 250;
    var px = 118, py = -72;
    drawRR(ctx, px, py, 56, 78, 6, "#f8fafc", C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("PDF", px + 28, py + 12);

    for (var r = 0; r < 5; r++) {
      drawRR(ctx, px + 6, py + 18 + r * 10, 44, 6, 2, "rgba(148,163,184,0.25)", null);
    }

    if (prg > 178) {
      var hi = Math.min(1, (prg - 178) / 16);
      ctx.globalAlpha = hi;
      drawRR(ctx, px + 5, py + 38, 46, 10, 2, C.citeGlow, C.citeAmber);
      ctx.strokeStyle = C.citeAmber;
      ctx.lineWidth = 1.5;
      ctx.strokeRect(px + 5, py + 38, 46, 10);
      ctx.fillStyle = "#92400e";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("п. 4.2", px + 8, py + 46);
      ctx.globalAlpha = 1;
    }
  };

  /* Штамп риска на приложении */
  function RiskTagStamp() {}
  RiskTagStamp.prototype.draw = function (ctx) {
    var prg = (frame * 0.036) % 250;
    if (prg < 188 || prg > 232) return;
    var stampPrg = Math.min(1, (prg - 188) / 14);
    ctx.save();
    ctx.translate(138, 18);
    ctx.rotate(-0.22 * stampPrg);
    ctx.globalAlpha = stampPrg * 0.9;
    ctx.strokeStyle = C.riskRed;
    ctx.lineWidth = 1.8;
    ctx.strokeRect(-24, -10, 48, 20);
    ctx.fillStyle = C.riskRed;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("РИСК", 0, 4);
    ctx.restore();
  };

  /* Связь договор → допсоглашение */
  function SupplementChainLink() {}
  SupplementChainLink.prototype.draw = function (ctx) {
    var prg = (frame * 0.036) % 250;
    if (prg < 60 || prg > 200) return;
    ctx.strokeStyle = "rgba(52,211,153,0.45)";
    ctx.lineWidth = 1.2;
    ctx.setLineDash([4, 4]);
    ctx.beginPath();
    ctx.moveTo(-150, -20);
    ctx.quadraticCurveTo(-20, -55, 12, -20);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle = "#6ee7b7";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("договор → ДС №3", -70, -58);
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.hitAnimation = 0;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var isMoving = false, carryType = null, faceDir = 1;
    var prg = (frame * 0.036) % 250;
    var targetX = -8;
    var targetY = -18 + (this.stepTrig * 0.35);

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var localPrg = prg - this.stepTrig;
      if (localPrg < 9) {
        isMoving = true; faceDir = 1; carryType = this.color;
        this.x = this.baseX + (targetX - this.baseX) * (localPrg / 9);
        this.y = this.baseY + (targetY - this.baseY) * (localPrg / 9);
      } else if (localPrg < 13) {
        this.x = targetX; this.y = targetY;
      } else {
        isMoving = true; faceDir = -1;
        this.x = targetX - (targetX - this.baseX) * ((localPrg - 13) / 9);
        this.y = targetY - (targetY - this.baseY) * ((localPrg - 13) / 9);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
    }

    var bob = Math.sin(this.timer * 1.5) * (isMoving ? 1.5 : 1);
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var walkPhase = this.timer * 6;
      legL = Math.sin(walkPhase) * 4;
      legR = Math.sin(walkPhase + Math.PI) * 4;
    }
    drawRR(ctx, -9, -4 + Math.max(0, legL), 7, 12, 2, C.outline, null);
    drawRR(ctx, 1, -4 + Math.max(0, legR), 7, 12, 2, C.outline, null);
    drawRR(ctx, -13, -11 - bob, 26, 18, 5, this.color, C.outline);
    var hx = 0, hy = -26 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath(); ctx.arc(hx, hy, 10, 0, Math.PI * 2); ctx.fill();
    ctx.lineWidth = 1.5; ctx.strokeStyle = C.outline; ctx.stroke();
    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
    if (this.role === "1_architect") {
      ctx.strokeStyle = C.outline; ctx.lineWidth = 1;
      ctx.strokeRect(hx, hy - 5, 5, 5);
    } else if (this.role === "3_coder") {
      ctx.fillStyle = C.outline;
      ctx.font = "bold 7px monospace";
      ctx.fillText("</>", hx - 8, hy - 10);
    }
    ctx.restore();
    if (carryType) drawRR(ctx, -16 * faceDir, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new DocumentLiftCarousel());
  entities.push(new EmbeddingNodeField());
  entities.push(new CitationRetrievalHub());
  entities.push(new ClauseHighlightPane());
  entities.push(new SupplementChainLink());
  entities.push(new RiskTagStamp());

  entities.push(new Agent(-178, 42, C.agentYellow, "1_architect", 18, [
    "Clause-boundaries готовы", "Приложения связаны", "Чанки по пунктам", "Иерархия разделов", "Parent-child chunk"
  ]));
  entities.push(new Agent(-148, 68, C.agentGreen, "2_seo", 58, [
    "ИНН в sparse-индексе", "ACL на контрагента", "Метаданные договора", "Тип: рамочный", "Контрагент проиндексирован"
  ]));
  entities.push(new Agent(-118, 36, C.agentBlue, "3_coder", 98, [
    "Hybrid BM25+vector", "Reranker включён", "Grounding strict", "Faithfulness check", "Отказ без корпуса"
  ]));
  entities.push(new Agent(-88, 58, C.agentPink, "4_designer", 138, [
    "Bounding box в PDF", "Подсветка п. 4.2", "Кликабельная цитата", "Стр. 7 готова", "UX юриста ок"
  ]));
  entities.push(new Agent(-58, 28, C.agentPurple, "5_deployer", 178, [
    "On-prem нода", "Пилот 500 PDF", "Citation rate 96%", "OCR сканов включён", "Прод готов"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 260, maxLife: customLife || 260 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.036) % 250;
    if (prg >= 12 && prg < 12.04) createBubble(-165, -40, "1. OCR страниц");
    if (prg >= 62 && prg < 62.04) createBubble(-20, -90, "2. Embedding-поле");
    if (prg >= 112 && prg < 112.04) createBubble(-5, -50, "3. Hybrid retrieval");
    if (prg >= 162 && prg < 162.04) createBubble(130, -30, "4. Цитата п. 4.2");
    if (prg >= 198 && prg < 198.04) createBubble(135, 10, "5. Риск отмечен");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      drawRR(ctx, bub.x - tw / 2, bub.y - 18, tw, 18, 5, C.bubbleBg, C.outline);
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

<div class="ragdog-content">

  <section class="ragdog-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="ragdog-cnt">
      <div class="ragdog-intro-grid nero-ai-reveal">
        <div class="ragdog-intro-text">
          <p class="ragdog-eyebrow">Лонгрид · ai поиск по договорам</p>
          <p><strong>Коротко:</strong> AI-поиск по договорам — это корпоративная RAG-система, которая индексирует договоры, допсоглашения, приложения и сканы, отвечает на вопросы на естественном языке строго из вашего архива и показывает цитату с ссылкой на документ, страницу и пункт. Nero Network внедряет такой контур под ключ: от OCR и индексации до интеграции с 1С, Directum, SharePoint и CRM.</p>
          <p>Российский рынок LegalTech в 2026 году оценивается примерно в 20 млрд ₽ с ростом почти на треть к предыдущему году. Более 95% решений на рынке — отечественные. При этом узкая боль остаётся прежней: сотрудники юротдела, закупок и финансов тратят часы на ручной просмотр папок PDF. <strong>AI-поиск по договорам</strong> переводит эту работу из режима «читать каждый файл» в режим «задать вопрос — получить ответ с источником за секунды».</p>
        </div>
        <div class="ragdog-intro-kpi" aria-label="Ключевые метрики RAG-поиска">
          <div class="ragdog-kpi-card"><div class="kv">20 млрд ₽</div><div class="kl">рынок LegalTech РФ</div><div class="ks">рост ~30% в 2026</div></div>
          <div class="ragdog-kpi-card"><div class="kv">95%+</div><div class="kl">отечественные решения</div><div class="ks">РБК Компании</div></div>
          <div class="ragdog-kpi-card"><div class="kv">часы → сек</div><div class="kl">типовой запрос</div><div class="ks">вместо Ctrl+F</div></div>
          <div class="ragdog-kpi-card"><div class="kv">96%</div><div class="kl">citation rate</div><div class="ks">цель пилота</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="ragdog-toc-outer">
    <div class="ragdog-cnt">
      <nav class="ragdog-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что это</a>
        <a href="#kak-ishchet">Как ищет нейросеть</a>
        <a href="#rag-sistema">RAG-система</a>
        <a href="#ai-analiz">Анализ условий</a>
        <a href="#skany">OCR и сканы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#etapy">Внедрение</a>
        <a href="#metriki">Метрики</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <section class="ragdog-section" id="chto-takoe">
    <div class="ragdog-cnt">
      <div class="ragdog-sh ragdog-left nero-ai-reveal">
        <span class="ragdog-eyebrow">Определение</span>
        <h2>Что такое AI-поиск по договорам и кому он нужен</h2>
        <p><strong>AI-поиск по договорам</strong> — корпоративная система на базе RAG, которая понимает вопрос на естественном языке, находит релевантные фрагменты в договорном архиве и формирует ответ <strong>только из найденных документов</strong>, с обязательной ссылкой на источник.</p>
      </div>

      <div class="ragdog-card nero-ai-reveal">
        <p>В отличие от SaaS «загрузи один договор и получи анализ рисков», корпоративное <strong>внедрение AI-поиска по договорам под ключ</strong> работает с <strong>всем архивом</strong>: договоры, допсоглашения, спецификации, акты, сканы, документы в Directum, 1С:Документооборот, SharePoint. Система учитывает права доступа (ACL).</p>
      </div>

      <div class="ragdog-sh ragdog-left" style="margin-top:48px;margin-bottom:28px;">
        <h3 id="pochemu-ruchnoi">Почему условия в договорах ищут вручную часами</h3>
      </div>
      <div class="nero-ai-reveal">
        <p>Типичная картина: юрист получает запрос «какой срок оплаты по договору с контрагентом N» — и начинает ручной обход папок, допсоглашений, Ctrl+F по PDF и сравнение версий. На один запрос уходит от 30 минут до нескольких часов.</p>
        <ul>
          <li>поиск папки по названию контрагента или ИНН;</li>
          <li>цепочка допсоглашений, меняющих сроки и суммы;</li>
          <li>Ctrl+F не находит формулировку из допсоглашения;</li>
          <li>скан без текстового слоя;</li>
          <li>сравнение версий договора 2021 и 2025 года.</li>
        </ul>
      </div>

      <div class="ragdog-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="ragdog-table">
          <thead><tr><th>Критерий</th><th>Классический поиск</th><th>AI-поиск (RAG)</th></tr></thead>
          <tbody>
            <tr><td>Понимание смысла</td><td>Только точное совпадение слов</td><td>Семантический поиск по формулировкам</td></tr>
            <tr><td>Охват архива</td><td>Один файл или папка</td><td>Весь корпус с ACL</td></tr>
            <tr><td>Сканы и старые PDF</td><td>Не ищет без OCR</td><td>OCR + индексация</td></tr>
            <tr><td>Цепочка договор → допсоглашение</td><td>Ручной обход</td><td>Единый запрос по связанным документам</td></tr>
            <tr><td>Ответ</td><td>Список файлов</td><td>Ответ с цитатой: документ, страница, пункт</td></tr>
            <tr><td>Интеграция с 1С/СЭД</td><td>Нет</td><td>Виджет в привычном контуре</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ragdog-sh ragdog-left" style="margin-top:48px;margin-bottom:28px;">
        <h3 id="scenarii-rolei">Юротдел, закупки и финансы: типовые сценарии поиска</h3>
      </div>
      <div class="ragdog-grid-3 nero-ai-reveal">
        <div class="ragdog-scenario">
          <h3>Юротдел</h3>
          <p>Условия расторжения, лимит ответственности, конфиденциальность; сравнение редакций; подготовка к переговорам.</p>
        </div>
        <div class="ragdog-scenario nero-ai-delay-1">
          <h3>Закупки</h3>
          <p>Сроки поставки, штрафы, условия приёмки, автопролонгация; кросс-документные запросы по истории с контрагентом.</p>
        </div>
        <div class="ragdog-scenario nero-ai-delay-2">
          <h3>Финансы</h3>
          <p>График оплат, авансы, валюта расчётов, неустойки; сверка «что в договоре» vs «что в счёте».</p>
        </div>
      </div>

      <div class="ragdog-card nero-ai-reveal" style="margin-top:24px;">
        <h3 style="font-size:17px;margin-bottom:12px;">12 примеров вопросов за одну сессию</h3>
        <ol>
          <li>Какой срок оплаты по договору с ООО «Ромашка» с учётом всех допсоглашений?</li>
          <li>Где прописана неустойка за просрочку поставки?</li>
          <li>Есть ли автопролонгация и на какой срок?</li>
          <li>Какой лимит ответственности по рамочному договору?</li>
          <li>Чем отличается п. 5.3 в договоре 2023 года от версии 2025 года?</li>
          <li>Какие штрафы за нарушение SLA в приложении № 2?</li>
          <li>В каких договорах с контрагентом N упоминается арбитраж?</li>
          <li>Какой график авансирования по активным контрактам?</li>
          <li>Где условие о праве одностороннего отказа?</li>
          <li>Какие сроки гарантии в спецификациях?</li>
          <li>Сравни срок оплаты в договоре A и договоре B.</li>
          <li>Есть ли отклонения от типового шаблона в этом договоре?</li>
        </ol>
      </div>
    </div>
  </section>

  <section class="ragdog-section ragdog-section-alt" id="kak-ishchet">
    <div class="ragdog-cnt">
      <div class="ragdog-sh nero-ai-reveal">
        <span class="ragdog-eyebrow">Pipeline</span>
        <h2>Как нейросеть ищет по договорам: от запроса до ответа</h2>
        <p><strong>Поиск по договорам нейросеть</strong> выполняет не как «чат, который знает всё», а как управляемый pipeline: запрос → поиск фрагментов → генерация ответа → цитата.</p>
      </div>

      <div class="ragdog-card nero-ai-reveal" id="semanticheskii-poisk">
        <h3>Семантический поиск вместо Ctrl+F по папке PDF</h3>
        <p><strong>Нейросеть для поиска по договорам</strong> преобразует вопрос и фрагменты в векторные представления и находит близкие по смыслу, даже если слова не совпадают. Для юридических текстов применяют <strong>гибридный поиск</strong> — BM25 + dense retrieval.</p>
        <ol>
          <li>Пользователь задаёт вопрос в чате, виджете СЭД, 1С или Telegram-боте.</li>
          <li>Система определяет область поиска: контрагент, тип документа, дата, ACL.</li>
          <li>Hybrid retrieval выбирает 5–15 релевантных фрагментов.</li>
          <li>Reranker уточняет порядок фрагментов.</li>
          <li>LLM синтезирует ответ строго из retrieved chunks.</li>
          <li>UI показывает ответ и кликабельные цитаты.</li>
        </ol>
      </div>

      <div class="ragdog-card nero-ai-reveal" id="citirovanie">
        <h3>Цитирование источника: пункт, страница, фрагмент документа</h3>
        <p>Без цитаты юрист не доверяет ответу. Минимальный стандарт — строка вида <strong>[Источник: Договор_поставки_2024.pdf, стр. 7, п. 4.2]</strong> с подсветкой абзаца в PDF. <strong>Поиск по договорам нейросеть</strong> экономит не на «красивом тексте», а на проверяемости — каждый тезис открывается в первоисточнике за один клик.</p>
      </div>
    </div>
  </section>

<section id="vnedrenie-ai-poisk-po-dogovoram-boris-block" class="bcd-root" aria-label="Анимация: RAG-поиск по договорам — от запроса до цитаты в PDF">
<style>
/* === БОРИС: prefix bcd-, scoped внутри #vnedrenie-ai-poisk-po-dogovoram-boris-block === */
#vnedrenie-ai-poisk-po-dogovoram-boris-block.bcd-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:520px;
}
@media(max-width:1023px){
  #vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#1d4ed8;
  margin:0 0 14px;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-ey::before{
  content:'';
  width:18px;height:2px;
  background:#1d4ed8;
  border-radius:1px;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(29,78,216,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#1d4ed8;
  margin-top:1px;
  font-style:normal;
  font-weight:700;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:20px;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-pl-b{
  background:rgba(29,78,216,.08);
  color:#1d4ed8;
  border:1.5px solid rgba(29,78,216,.22);
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-cta{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  padding:12px 22px;
  border-radius:999px;
  font-size:14px;
  font-weight:700;
  text-decoration:none!important;
  background:linear-gradient(135deg,#2563eb,#7c3aed);
  color:#fff!important;
  box-shadow:0 8px 28px rgba(59,130,246,.32);
  transition:transform .2s,box-shadow .2s;
  margin-bottom:14px;
  align-self:flex-start;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-cta:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 36px rgba(59,130,246,.4);
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-rgt{
  position:relative;
  background:linear-gradient(135deg,#eff6ff 0%,#f5f3ff 38%,#f0fdf4 72%,#f8fafc 100%);
  min-height:460px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-poisk-po-dogovoram-boris-block .bcd-rgt{min-height:400px;}
}
#bcd-rag-citation-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bcd-cnt">
  <div class="bcd-card">

    <div class="bcd-lft">
      <span class="bcd-ey">RAG · цитирование</span>
      <h3 class="bcd-h3">Вопрос на русском — ответ с пунктом, страницей и подсветкой в PDF</h3>
      <ul class="bcd-ul">
        <li><span class="bcd-ic">1</span>Hybrid retrieval: векторный поиск + BM25 по ИНН, суммам и номерам пунктов</li>
        <li><span class="bcd-ic">2</span>Reranker выбирает 5–15 релевантных чанков из договора и допсоглашений</li>
        <li><span class="bcd-ic">3</span>LLM формирует ответ строго из найденного — без «памяти обучения»</li>
        <li><span class="bcd-ic">↗</span>Клик по цитате открывает PDF на нужной странице с подсветкой абзаца</li>
      </ul>
      <div class="bcd-pills">
        <span class="bcd-pl bcd-pl-b">часы → секунды</span>
        <span class="bcd-pl bcd-pl-g">citation rate</span>
        <span class="bcd-pl bcd-pl-v">grounding</span>
      </div>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent bcd-cta"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Проверить документы'); ?></a>
      <p class="bcd-foot">Дальше — как устроен RAG-контур: chunking, embedding и снижение галлюцинаций →</p>
    </div>

    <div class="bcd-rgt">
      <canvas
        id="bcd-rag-citation-canvas"
        aria-label="Анимация: запрос пользователя проходит RAG-поиск по архиву договоров и возвращает ответ с цитатой в PDF"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bcd-rag-citation-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 500;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a',
    muted:'#64748b',
    soft:'#475569',
    paper:'#ffffff',
    paperBdr:'#cbd5e1',
    query:'#1d4ed8',
    queryBg:'#eff6ff',
    rag:'#7c3aed',
    ragGlow:'rgba(124,58,237,.18)',
    chunk:'#dbeafe',
    chunkBdr:'#93c5fd',
    cite:'#fbbf24',
    citeBg:'rgba(251,191,36,.22)',
    green:'#22c55e',
    line:'rgba(29,78,216,.28)',
    pdf:'#f1f5f9',
    highlight:'rgba(34,197,94,.28)'
  };

  var DOCS = [
    {label:'Договор_2024.pdf', clause:'п. 4.2', color:'#3b82f6'},
    {label:'Допсогл._№3.pdf', clause:'п. 2.1', color:'#8b5cf6'},
    {label:'Спецификация.pdf', clause:'табл. 1', color:'#0ea5e9'},
    {label:'Рамочный_2023.pdf', clause:'п. 7.5', color:'#6366f1'}
  ];

  var QUERY = 'Срок оплаты по договору с ООО «Ромашка»?';
  var ANSWER = '14 календарных дней с даты поставки';
  var SOURCE = 'Договор_поставки_2024.pdf · стр. 7 · п. 4.2';

  var LOOP = 720;
  var chunks = [];
  var particles = [];

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function initChunks(){
    chunks = DOCS.map(function(d,i){
      return {
        label: d.clause,
        doc: d.label,
        color: d.color,
        angle: (i/DOCS.length)*Math.PI*2,
        dist: 0,
        alpha: 0,
        phase: i*45
      };
    });
  }
  initChunks();

  function drawQueryBubble(x,y,w,alpha,pulse){
    ctx.globalAlpha = alpha;
    rr(x,y,w,52,12,C.queryBg,C.query,2);
    ctx.fillStyle = C.query;
    ctx.font = 'bold 10px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Запрос юриста', x+12, y+16);
    ctx.fillStyle = C.ink;
    ctx.font = '10px Inter,system-ui,sans-serif';
    var words = QUERY.split(' ');
    var line = '', ly = y+30, maxW = w-24;
    words.forEach(function(wd){
      var test = line ? line+' '+wd : wd;
      if(ctx.measureText(test).width > maxW){
        ctx.fillText(line, x+12, ly);
        line = wd; ly += 13;
      } else line = test;
    });
    if(line) ctx.fillText(line, x+12, ly);

    ctx.strokeStyle = C.query;
    ctx.lineWidth = 1.5 + pulse;
    ctx.globalAlpha = alpha * (0.25 + pulse*0.15);
    ctx.beginPath();
    ctx.arc(x+w-8, y+8, 4+pulse*3, 0, Math.PI*2);
    ctx.stroke();
    ctx.globalAlpha = 1;
  }

  function drawArchive(x,y,w,h,t){
    rr(x,y,w,h,10,C.paper,C.paperBdr,1.5);
    ctx.fillStyle = C.muted;
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Архив договоров', x+10, y+16);

    DOCS.forEach(function(d,i){
      var dy = y + 24 + i*22;
      var slide = Math.sin((t+i*40)*0.04)*2;
      rr(x+8, dy+slide, w-16, 18, 4, C.pdf, d.color, 1);
      ctx.fillStyle = d.color;
      ctx.font = '8px Inter,sans-serif';
      ctx.fillText(d.label, x+14, dy+12+slide);
    });
  }

  function drawRagHub(cx,cy,r,pulse,t){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2.2);
    g.addColorStop(0, C.ragGlow);
    g.addColorStop(1, 'rgba(124,58,237,0)');
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(cx,cy,r*2,0,Math.PI*2);
    ctx.fill();

    rr(cx-r,cy-r,r*2,r*2,r*0.4,'#faf5ff',C.rag,2);
    ctx.fillStyle = C.rag;
    ctx.font = 'bold ' + Math.max(11,r*0.28) + 'px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('RAG', cx, cy-4);
    ctx.font = Math.max(8,r*0.16) + 'px Inter,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('retrieve → rank', cx, cy+r*0.35);

    for(var i=0;i<3;i++){
      var ang = (i/3)*Math.PI*2 + t*0.05;
      ctx.beginPath();
      ctx.arc(cx+Math.cos(ang)*(r+10+pulse*6), cy+Math.sin(ang)*(r*0.6), 3, 0, Math.PI*2);
      ctx.fillStyle = C.rag;
      ctx.fill();
    }
  }

  function drawChunk(cx,cy,w,h,text,sub,alpha,color){
    ctx.globalAlpha = alpha;
    rr(cx-w/2,cy-h/2,w,h,5,C.chunk,color||C.chunkBdr,1);
    ctx.fillStyle = color || C.ink;
    ctx.font = 'bold 9px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(text, cx, cy-2);
    if(sub){
      ctx.fillStyle = C.muted;
      ctx.font = '7px Inter,sans-serif';
      ctx.fillText(sub, cx, cy+9);
    }
    ctx.globalAlpha = 1;
  }

  function drawAnswerPanel(x,y,w,h,alpha,highlight){
    ctx.globalAlpha = alpha;
    rr(x,y,w,h,10,C.paper,'#22c55e',2);
    ctx.fillStyle = C.green;
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Ответ с grounding', x+12, y+18);

    ctx.fillStyle = C.ink;
    ctx.font = '11px Inter,sans-serif';
    ctx.fillText(ANSWER, x+12, y+38);

    rr(x+10,y+48,w-20,22,6,'#f0fdf4','#86efac',1);
    ctx.fillStyle = '#15803d';
    ctx.font = 'bold 8px Inter,sans-serif';
    ctx.fillText('↗ '+SOURCE, x+16, y+62);

    if(highlight > 0){
      ctx.fillStyle = C.citeBg;
      ctx.globalAlpha = alpha * highlight;
      rr(x+10,y+76,w-20,14,3,C.citeBg,C.cite,1);
      ctx.fillStyle = '#b45309';
      ctx.font = '8px Inter,sans-serif';
      ctx.fillText('faithfulness check ✓', x+16, y+86);
    }
    ctx.globalAlpha = 1;
  }

  function drawPdfPreview(x,y,w,h,hlY,hlAlpha,pulse){
    rr(x,y,w,h,8,C.paper,C.paperBdr,1.5);
    ctx.fillStyle = C.muted;
    ctx.font = 'bold 9px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('PDF · стр. 7', x+10, y+14);

    for(var i=0;i<6;i++){
      var ly = y+22+i*11;
      var lw = w - 20 - (i%3)*12;
      ctx.fillStyle = '#e2e8f0';
      ctx.fillRect(x+10, ly, lw, 5);
    }

    if(hlAlpha > 0){
      var hy = y + hlY;
      ctx.fillStyle = C.highlight;
      ctx.globalAlpha = hlAlpha * (0.7 + pulse*0.3);
      rr(x+8, hy, w-16, 28, 4, C.highlight, C.green, 1.5);
      ctx.globalAlpha = hlAlpha;
      ctx.fillStyle = C.ink;
      ctx.font = '8px Inter,sans-serif';
      ctx.fillText('п. 4.2: оплата в течение 14 календ. дней', x+12, hy+17);
      ctx.globalAlpha = 1;
    }
  }

  function spawnParticle(x1,y1,x2,y2){
    particles.push({x:x1,y:y1,tx:x2,ty:y2,t:0});
  }

  function loop(){
    frame++;
    var t = frame % LOOP;
    ctx.clearRect(0,0,W,H);

    var pad = Math.max(12, W*0.04);
    var archW = Math.min(118, W*0.2);
    var archH = Math.min(130, H*0.32);
    var archX = pad;
    var archY = H*0.14;

    var hubX = W*0.46;
    var hubY = H*0.46;
    var hubR = Math.min(W,H)*0.085;
    var pulse = 0.5 + 0.5*Math.sin(frame*0.07);

    var qW = Math.min(200, W*0.34);
    var qX = W*0.06;
    var qY = H*0.06;
    var qAlpha = t < 80 ? t/80 : (t > 640 ? (LOOP-t)/80 : 1);
    drawQueryBubble(qX, qY, qW, qAlpha, pulse);

    drawArchive(archX, archY, archW, archH, t);

    drawRagHub(hubX, hubY, hubR, pulse, t);

    var ansW = Math.min(210, W*0.36);
    var ansH = 100;
    var ansX = W - ansW - pad;
    var ansY = H*0.12;
    var ansAlpha = 0;
    if(t > 380) ansAlpha = Math.min(1, (t-380)/60);
    if(t > 650) ansAlpha = Math.max(0, 1-(t-650)/50);

    var pdfW = Math.min(150, W*0.28);
    var pdfH = Math.min(120, H*0.28);
    var pdfX = W - pdfW - pad;
    var pdfY = H*0.58;
    var hlAlpha = 0;
    if(t > 480) hlAlpha = Math.min(1, (t-480)/50);
    if(t > 660) hlAlpha = Math.max(0, 1-(t-660)/40);

    chunks.forEach(function(ch,i){
      var startT = 120 + ch.phase;
      var endT = 360;
      if(t < startT){ ch.alpha = 0; ch.dist = 0; return; }
      if(t > endT){ ch.alpha = Math.max(0, 1-(t-endT)/40); }
      else ch.alpha = Math.min(1, (t-startT)/30);

      var prog = Math.min(1, (t-startT)/(endT-startT));
      var ease = prog*prog*(3-2*prog);
      var fromX = archX + archW*0.5;
      var fromY = archY + 34 + i*22;
      var toX = hubX + Math.cos(ch.angle)*hubR*1.4;
      var toY = hubY + Math.sin(ch.angle)*hubR*0.9;
      var cx = fromX + (toX-fromX)*ease;
      var cy = fromY + (toY-fromY)*ease;

      if(t === startT+1) spawnParticle(fromX, fromY, hubX, hubY);

      drawChunk(cx, cy, 54, 26, ch.label, ch.doc.split('.')[0].slice(0,14), ch.alpha, ch.color);

      if(t > 300 && t < 380 && i === 0){
        ctx.globalAlpha = 0.35;
        ctx.strokeStyle = C.line;
        ctx.lineWidth = 1.5;
        ctx.setLineDash([4,4]);
        ctx.beginPath();
        ctx.moveTo(hubX+hubR, hubY);
        ctx.lineTo(ansX, ansY+ansH/2);
        ctx.stroke();
        ctx.setLineDash([]);
        ctx.globalAlpha = 1;
      }
    });

  particles = particles.filter(function(p){
    p.t += 0.04;
    var ease = p.t*p.t*(3-2*p.t);
    var px = p.x + (p.tx-p.x)*ease;
    var py = p.y + (p.ty-p.y)*ease;
    ctx.globalAlpha = 1-p.t;
    ctx.fillStyle = C.rag;
    ctx.beginPath();
    ctx.arc(px, py, 2.5, 0, Math.PI*2);
    ctx.fill();
    ctx.globalAlpha = 1;
    return p.t < 1;
  });

    if(t > 100 && t < 200){
      ctx.globalAlpha = 0.4;
      ctx.strokeStyle = C.line;
      ctx.lineWidth = 2;
      ctx.setLineDash([5,4]);
      ctx.beginPath();
      ctx.moveTo(qX+qW, qY+26);
      ctx.lineTo(hubX-hubR-4, hubY-10);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.globalAlpha = 1;
    }

    var faithHl = t > 520 ? Math.min(1,(t-520)/40) : 0;
    drawAnswerPanel(ansX, ansY, ansW, ansH, ansAlpha, faithHl);
    drawPdfPreview(pdfX, pdfY, pdfW, pdfH, 48, hlAlpha, pulse);

    if(hlAlpha > 0.3 && t > 500 && t < 680){
      ctx.strokeStyle = C.green;
      ctx.lineWidth = 1.5;
      ctx.setLineDash([3,3]);
      ctx.globalAlpha = 0.5;
      ctx.beginPath();
      ctx.moveTo(ansX+20, ansY+ansH);
      ctx.lineTo(pdfX+pdfW*0.5, pdfY);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.globalAlpha = 1;
    }

    if(t > LOOP-30){
      particles = [];
      initChunks();
    }

    requestAnimationFrame(loop);
  }

  requestAnimationFrame(loop);
})();
</script>
</section>

  <section class="ragdog-section" id="rag-sistema">
    <div class="ragdog-cnt">
      <div class="ragdog-sh nero-ai-reveal">
        <span class="ragdog-eyebrow">Архитектура</span>
        <h2>RAG-поиск по документам: как устроена система</h2>
        <p><strong>RAG-поиск по документам</strong> — технология, при которой LLM сначала извлекает релевантные фрагменты из корпоративной базы, затем генерирует ответ. Для <strong>rag для юридических документов</strong> это критично: модель не должна выдумывать условия.</p>
      </div>
      <code class="ragdog-pipeline nero-ai-reveal">ingest → OCR/парсинг → chunking → индексация → запрос → retrieval → ответ с цитатой</code>

      <div class="ragdog-grid-2 nero-ai-reveal">
        <div class="ragdog-card" id="chunking">
          <h3>Chunking, embedding и векторная база</h3>
          <p>Для юридических текстов нужен <strong>clause-aware</strong> подход — нарезка по пунктам с parent-child chunks. Embeddings: GigaChat, Yandex или multilingual e5. Векторная база: pgvector, Qdrant, Weaviate + BM25 для ИНН и сумм.</p>
        </div>
        <div class="ragdog-card nero-ai-delay-1" id="grounding">
          <h3>Grounding и снижение галлюцинаций</h3>
          <p>Промпт «отвечай только из контекста», отказ при отсутствии данных, post-check цитат, human-in-the-loop для спорных ответов. AI помогает, но не заменяет юриста.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ragdog-section ragdog-section-alt" id="ai-analiz">
    <div class="ragdog-cnt">
      <div class="ragdog-sh nero-ai-reveal">
        <span class="ragdog-eyebrow">Извлечение</span>
        <h2>AI-анализ договоров: пункты, сроки, суммы и риски</h2>
        <p><strong>AI-анализ договоров</strong> — ускоренное извлечение и сравнение условий из архива, а не замена юридического заключения.</p>
      </div>
      <div class="nero-ai-reveal">
        <div class="ragdog-scenario" id="avto-poisk">
          <h3>Автоматический поиск условий в договоре</h3>
          <p><strong>Поиск условий в договоре автоматически</strong> работает поверх всего индекса. Система понимает, что «срок оплаты» может быть в разделе «Расчёты», в допсоглашении № 3 или в спецификации.</p>
        </div>
        <div class="ragdog-scenario">
          <h3>Как искать сроки и суммы в договорах автоматически</h3>
          <p>NER-модуль извлекает даты, суммы, валюты при индексации; LLM комбинирует structured metadata и семантический поиск. Типовой ориентир пилота — проверка за ~30 секунд.</p>
        </div>
        <div class="ragdog-scenario">
          <h3>Выявление рисков и несоответствий в приложениях</h3>
          <p><strong>Поиск рисков в договорах AI</strong> сравнивает с playbook и чек-листами компании: «Покажи договоры, где лимит ответственности ниже порога».</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ragdog-section" id="skany">
    <div class="ragdog-cnt">
      <div class="ragdog-sh nero-ai-reveal">
        <span class="ragdog-eyebrow">OCR</span>
        <h2>Поиск по сканам и неструктурированным договорам</h2>
        <p><strong>AI-поиск по сканам договоров</strong> — обязательный модуль для российских архивов 2000–2010-х.</p>
      </div>
      <div class="ragdog-grid-2 nero-ai-reveal">
        <div class="ragdog-card" id="ocr-skanov">
          <h3>OCR для отсканированных договоров и актов</h3>
          <p>Native PDF — прямой парсинг; сканы — Yandex Vision OCR, ABBYY, Tesseract + VLM. Layout-aware parsing сохраняет структуру таблиц для точных цитат. Кейсы: ускорение поиска 10–30×.</p>
        </div>
        <div class="ragdog-card nero-ai-delay-1" id="edinyi-indeks">
          <h3>Единый индекс: договор + приложения + допсоглашения</h3>
          <p>Цепочка документов одного контрагента в одном запросе. Пользователь не обязан помнить, в каком допсоглашении меняли срок оплаты.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ragdog-section ragdog-section-alt" id="integracii">
    <div class="ragdog-cnt">
      <div class="ragdog-sh nero-ai-reveal">
        <span class="ragdog-eyebrow">Экосистема</span>
        <h2>Интеграции: ECM, SharePoint, 1С и CRM</h2>
        <p>Корпоративный <strong>ai поиск в договорах под ключ</strong> встраивается туда, где сотрудники уже работают.</p>
      </div>
      <div class="ragdog-grid-2 nero-ai-reveal">
        <div class="ragdog-card" id="hranilishche">
          <h3>Подключение корпоративного хранилища документов</h3>
          <p><strong>СЭД/ECM:</strong> Directum RX, 1С:Документооборот, Docsvision. <strong>Файловые хранилища:</strong> SharePoint, сетевые папки. Для учётного контура смежный продукт — <a href="/ai-1c-erp/" class="ym-link ym-link--accent">AI-агент для 1С и ERP</a>: извлечение полей из счетов и первички, дополняющий RAG-поиск по договорному архиву.</p>
        </div>
        <div class="ragdog-card nero-ai-delay-1" id="crm-svyaz">
          <h3>Привязка найденных условий к сделкам и задачам</h3>
          <p>Экспорт цитаты в задачу юристу в Битрикс24 или <a href="/vnedrenie-ai-amocrm/" class="ym-link ym-link--accent">amoCRM</a>; привязка к сделке с контрагентом; Telegram-бот для быстрых запросов с ACL.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ragdog-section" id="etapy">
    <div class="ragdog-cnt">
      <div class="ragdog-sh nero-ai-reveal">
        <span class="ragdog-eyebrow">Под ключ</span>
        <h2>Внедрение AI-поиска по договорам под ключ</h2>
        <p><strong>Внедрение ai поиск договоров</strong> в Nero Network — проектная модель с измеримым пилотом.</p>
      </div>

      <div class="ragdog-table-wrap nero-ai-reveal">
        <table class="ragdog-table">
          <thead><tr><th>Этап</th><th>Срок</th><th>Содержание</th></tr></thead>
          <tbody>
            <tr><td>Аудит корпуса</td><td>1–2 нед.</td><td>Источники, объём, доля сканов, ACL, требования ИБ</td></tr>
            <tr><td>Пилот</td><td>2–4 нед.</td><td>200–500 договоров, ingestion + OCR + индекс, 10–15 эталонных вопросов</td></tr>
            <tr><td>Калибровка retrieval</td><td>1–2 нед.</td><td>Clause-aware chunking, hybrid BM25+vector, тест на галлюцинации</td></tr>
            <tr><td>Интеграция</td><td>2–4 нед.</td><td>Виджет в СЭД/портал/1С/Telegram</td></tr>
            <tr><td>Прод + мониторинг</td><td>ongoing</td><td>Дашборд: latency, citation rate, human review</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ragdog-card nero-ai-reveal" id="etapy-pilot">
        <h3>Этапы проекта: аудит архива → пилот → прод</h3>
        <p>CTA Nero Network — <strong>«Проверить документы»</strong>: пилот на подмножестве вашего архива с отчётом citation rate до полного внедрения. Пришлите типовой корпус — покажем поиск на ваших формулировках.</p>
      </div>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-pilot">
        <div class="ym-cta-block__icon" aria-hidden="true">📄</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверьте поиск на ваших договорах</p>
          <p class="ym-cta-block__sub">Пилот на 200–500 договоров из вашего архива: ingestion, OCR, индекс и 10–15 эталонных вопросов от юристов и закупок. Отчёт с citation rate и рекомендациями по прод-масштабированию — на ваших формулировках, не на демо-договорах из интернета.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать RAG до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI-поиска по договорам полезно разобраться в chunking, grounding, OCR и human-in-the-loop — это ускоряет согласование с ИБ и юротделом. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo $secondary_cta_attrs; ?>><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>

      <div class="ragdog-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="ragdog-card" id="onprem">
          <h3>On-prem vs облако: ПДн и коммерческая тайна</h3>
          <p>Банки и госкомпании выбирают on-prem с локальными LLM. Средний бизнес — облако РФ для быстрого пилота. Безопасность — архитектура ACL, логи, шифрование, а не обещание в договоре.</p>
        </div>
        <div class="ragdog-card nero-ai-delay-1" id="stoimost">
          <h3>Сколько стоит внедрение AI-поиска по документам</h3>
          <p>Пилот (200–500 договоров) — точка входа с фиксированным scope. ROI — экономия часов юристов, закупок и финансов; меньше пропущенных сроков из-за «не нашли пункт вовремя».</p>
        </div>
      </div>

      <div class="ragdog-table-wrap nero-ai-reveal">
        <table class="ragdog-table">
          <thead><tr><th>Вариант</th><th>Когда выбирают</th><th>Плюсы</th><th>Минусы</th></tr></thead>
          <tbody>
            <tr><td><strong>On-prem</strong></td><td>Банки, госкомпании, 152-ФЗ</td><td>Данные не покидают периметр</td><td>Выше стоимость инфраструктуры</td></tr>
            <tr><td><strong>Облако РФ</strong></td><td>Средний бизнес</td><td>Быстрый пилот</td><td>Требует согласования с ИБ</td></tr>
            <tr><td><strong>Гибрид</strong></td><td>Крупный холдинг</td><td>Индексация on-prem</td><td>Сложнее архитектура</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="ragdog-section ragdog-section-alt" id="metriki">
    <div class="ragdog-cnt">
      <div class="ragdog-sh nero-ai-reveal">
        <span class="ragdog-eyebrow">ROI</span>
        <h2>Метрики эффекта: время ответа, точность, экономия часов</h2>
        <p>Внедрение имеет смысл, когда метрики измеряются на <strong>вашем</strong> golden set — 10–30 типовых вопросов от юристов и закупок.</p>
      </div>
      <div class="ragdog-grid-3 nero-ai-reveal">
        <div class="ragdog-card"><h3 style="font-size:16px;">Latency</h3><p>Целевой ориентир: секунды на типовой запрос в проде.</p></div>
        <div class="ragdog-card nero-ai-delay-1"><h3 style="font-size:16px;">Citation rate</h3><p>Доля ответов с валидной цитатой, проверяемой по PDF.</p></div>
        <div class="ragdog-card nero-ai-delay-2"><h3 style="font-size:16px;">Faithfulness</h3><p>Соответствие ответа извлечённым фрагментам без домыслов.</p></div>
      </div>
      <div class="ragdog-card nero-ai-reveal" style="margin-top:20px;">
        <p><strong>Ориентиры из публичных кейсов</strong> (данные интеграторов): Nord Clan — ускорение 10–30×; Digital-Pro Tech — ~30 сек на проверку; Zinin &amp; Shturbin — с полчаса на поиск одного пункта до секунд.</p>
      </div>
    </div>
  </section>

  <section class="ragdog-section" id="faq">
    <div class="ragdog-cnt">
      <div class="ragdog-sh nero-ai-reveal">
        <span class="ragdog-eyebrow">Вопросы</span>
        <h2>FAQ по AI-поиску в договорах</h2>
      </div>
      <div class="ragdog-faq nero-ai-reveal">
        <div class="ragdog-faq-item"><div class="ragdog-faq-q" role="button" tabindex="0" aria-expanded="false">Как найти пункт в договоре быстро без ручного чтения?</div><div class="ragdog-faq-a">Задайте вопрос на естественном языке в корпоративном чате: «Где в договоре с N прописана неустойка?» Система выполнит RAG-поиск, вернёт ответ с цитатой и откроет PDF на нужной странице.</div></div>
        <div class="ragdog-faq-item"><div class="ragdog-faq-q" role="button" tabindex="0" aria-expanded="false">Чем RAG отличается от обычного полнотекстового поиска?</div><div class="ragdog-faq-a">Полнотекстовый поиск выдаёт список файлов по ключевым словам. RAG находит фрагменты по смыслу, формулирует связный ответ с цитатами, добавляет grounding и отказ при отсутствии данных.</div></div>
        <div class="ragdog-faq-item"><div class="ragdog-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли проверить систему на своих документах?</div><div class="ragdog-faq-a">Да. Формат Nero Network — пилот «Проверить документы»: 200–500 договоров, 10–15 ваших вопросов, отчёт с citation rate и рекомендациями по прод-масштабированию.</div></div>
        <div class="ragdog-faq-item"><div class="ragdog-faq-q" role="button" tabindex="0" aria-expanded="false">Заменяет ли нейросеть юриста?</div><div class="ragdog-faq-a">Нет. Система ускоряет поиск и первичный анализ; юридическая квалификация, переговоры и ответственность перед судом остаются за человеком.</div></div>
        <div class="ragdog-faq-item"><div class="ragdog-faq-q" role="button" tabindex="0" aria-expanded="false">Что если ответ неверный?</div><div class="ragdog-faq-a">Включены citation discipline, post-check и human review. Пользователь всегда может открыть источник и проверить цитату.</div></div>
        <div class="ragdog-faq-item"><div class="ragdog-faq-q" role="button" tabindex="0" aria-expanded="false">Работает ли без облака?</div><div class="ragdog-faq-a">Да, on-prem с российскими LLM — стандартный сценарий для чувствительных отраслей.</div></div>
        <div class="ragdog-faq-item"><div class="ragdog-faq-q" role="button" tabindex="0" aria-expanded="false">У нас уже Directum / 1С:ДО — зачем интегратор?</div><div class="ragdog-faq-a">Nero Network усиливает штатный ИИ кастомным RAG, сложными интеграциями, OCR архива сканов и единым поиском по экспортам из нескольких систем.</div></div>
      </div>

      <div class="ragdog-card nero-ai-reveal" style="margin-top:32px;">
        <p><strong>Итог:</strong> <strong>Внедрение AI-поиска по договорам и приложениям под ключ</strong> — переход от часов ручного просмотра PDF к проверяемым ответам за секунды, с цитатой в пункт и интеграцией в 1С, Directum, SharePoint или CRM. <strong>Проверить документы</strong> — первый шаг: покажем поиск на ваших договорах, а не в демо-режиме.</p>
      </div>

      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы перестать искать пункты в PDF вручную?</p>
          <p class="ym-cta-block__sub">Первый шаг — пилот «Проверить документы» на подмножестве архива с измеримым citation rate. Покажем поиск на ваших договорах, допсоглашениях и сканах — не в демо-режиме.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

</div>

<!-- SCHEMA-MARKUP:INSERT -->

<?php
$ragdog_page_url = trailingslashit( get_permalink() );
$ragdog_site_url = trailingslashit( home_url( '/' ) );
$ragdog_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$ragdog_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $ragdog_site_url . '#organization',
      'name'  => $ragdog_brand,
      'url'   => $ragdog_site_url,
    ],
    [
      '@type'       => 'Article',
      '@id'         => $ragdog_page_url . '#article',
      'headline'    => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $ragdog_page_url,
      'author'      => [ '@id' => $ragdog_site_url . '#organization' ],
      'publisher'   => [ '@id' => $ragdog_site_url . '#organization' ],
      'mainEntityOfPage' => [ '@id' => $ragdog_page_url . '#webpage' ],
    ],
    [
      '@type' => 'WebPage',
      '@id'   => $ragdog_page_url . '#webpage',
      'url'   => $ragdog_page_url,
      'name'  => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf' => [ '@id' => $ragdog_site_url . '#website' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $ragdog_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как найти пункт в договоре быстро без ручного чтения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Задайте вопрос на естественном языке в корпоративном чате. Система выполнит RAG-поиск, вернёт ответ с цитатой и откроет PDF на нужной странице.' ] ],
        [ '@type' => 'Question', 'name' => 'Чем RAG отличается от обычного полнотекстового поиска?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'RAG находит фрагменты по смыслу, формулирует ответ с цитатами, добавляет grounding и отказ при отсутствии данных.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли проверить систему на своих документах?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Пилот «Проверить документы»: 200–500 договоров, 10–15 ваших вопросов, отчёт с citation rate.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $ragdog_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>
</main>

<script>
(function(){
  document.querySelectorAll('.ragdog-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.ragdog-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.ragdog-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.ragdog-faq-q');
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
  var root = document.querySelector('.vnedrenie-ai-poisk-po-dogovoram-page') || document.querySelector('.ragdog-content');
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

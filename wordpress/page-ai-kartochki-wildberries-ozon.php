<?php
/**
 * Template Name: AI-карточки Wildberries и Ozon: внедрение под ключ
 * Description: SEO-лендинг — AI-генератор карточек для Wildberries и Ozon. SEO-описания, rich content, FAQ. Аудит одной карточки.
 */

$page_seo_title       = 'AI-карточки Wildberries и Ozon: внедрение под ключ';
$page_seo_description = 'Внедряем AI-генератор карточек для Wildberries и Ozon: SEO-описания, заголовки, rich content и FAQ. Бесплатный аудит одной карточки. Под ключ для селлеров и брендов.';

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
    ['label' => 'Почему не продают', 'href' => '#pochemu-kartochki'],
    ['label' => 'AI vs ChatGPT', 'href' => '#chto-takoe-ai-generator'],
    ['label' => 'Wildberries', 'href' => '#ai-wb'],
    ['label' => 'Ozon', 'href' => '#ai-ozon'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
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

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить карточку';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#pochemu-kartochki';

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
/* =====================================================
   AKWO PAGE — ai-kartochki-wildberries-ozon
   ===================================================== */
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,
.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}

.akwo-hero-mp{
  min-height:100vh!important;
  min-height:100dvh!important;
  position:relative!important;
}

.akwo-content{
  --akwo-bg:#050711;--akwo-bg2:#080b17;--akwo-bg3:#0a0e1c;
  --akwo-surface:rgba(255,255,255,.072);--akwo-surface2:rgba(255,255,255,.108);
  --akwo-text:#e6edf7;--akwo-muted:#9aa8bd;--akwo-soft:#c7d2e5;--akwo-heading:#fff;
  --akwo-border:rgba(255,255,255,.10);--akwo-border-s:rgba(255,255,255,.18);
  --akwo-wb:#cb11ab;--akwo-ozon:#005bff;--akwo-accent:#79f2ff;--akwo-violet:#8b5cf6;
  --akwo-green:#22c55e;--akwo-cyan:#79f2ff;
  --akwo-shadow:0 24px 72px rgba(0,0,0,.4);
  --akwo-r:18px;--akwo-r-lg:24px;--akwo-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--akwo-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.akwo-content *,.akwo-content *::before,.akwo-content *::after{box-sizing:border-box;}
.akwo-content a{color:inherit;}
.akwo-content p{color:var(--akwo-muted);line-height:1.72;margin:0 0 1em;text-align:left!important;}
.akwo-content p:last-child{margin-bottom:0;}
.akwo-content h2,.akwo-content h3,.akwo-content h4{color:var(--akwo-heading);letter-spacing:-.045em;margin:0 0 .7em;text-align:left!important;}
.akwo-content strong{color:var(--akwo-soft);}
.akwo-content ul,.akwo-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.akwo-content ul li,.akwo-content ol li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--akwo-muted);font-size:14.5px;line-height:1.65;text-align:left!important;
}
.akwo-content ul li::before{content:'›';position:absolute;left:0;color:var(--akwo-accent);font-weight:700;}
.akwo-content ol{counter-reset:akwo-ol;}
.akwo-content ol li{counter-increment:akwo-ol;padding-left:28px;}
.akwo-content ol li::before{content:counter(akwo-ol) '.';position:absolute;left:0;color:var(--akwo-accent);font-weight:700;}

.akwo-cnt{width:min(var(--akwo-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}

.akwo-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.akwo-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);
}

.akwo-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.akwo-sh.akwo-left{margin-left:0;margin-right:0;text-align:left;}
.akwo-sh h2{font-size:clamp(26px,4vw,46px);line-height:1.08;margin-bottom:14px;}
.akwo-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;text-align:left!important;}
.akwo-sh.akwo-left p{margin-left:0;}

.akwo-eyebrow{
  display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;
  background:linear-gradient(90deg,rgba(203,17,171,.12),rgba(0,91,255,.12));
  border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--akwo-accent);margin-bottom:14px;
}

.akwo-gt{
  background:linear-gradient(92deg,#fff 0%,var(--akwo-wb) 38%,var(--akwo-ozon) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

.akwo-intro{padding:clamp(48px,6vw,88px) 0;}
.akwo-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.akwo-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.akwo-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--akwo-wb),var(--akwo-ozon));
}
.akwo-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.akwo-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.akwo-kpi-card{
  padding:16px;border-radius:16px;background:rgba(255,255,255,.055);
  border:1px solid rgba(255,255,255,.09);
}
.akwo-kpi-card .kv{font-size:26px;font-weight:900;color:#fff;line-height:1;margin-bottom:6px;}
.akwo-kpi-card .kl{font-size:12px;color:var(--akwo-muted);line-height:1.45;}
.akwo-kpi-card .ks{font-size:10px;color:#64748b;margin-top:6px;}

.akwo-toc-outer{padding:0 0 clamp(32px,4vw,48px);}
.akwo-toc{
  display:flex;flex-wrap:wrap;gap:10px;justify-content:center;
}
.akwo-toc a,.ym-toc.akwo-toc a{
  display:inline-flex;align-items:center;padding:10px 16px;border-radius:999px;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);
  color:var(--akwo-soft)!important;text-decoration:none!important;font-size:13px;font-weight:700;
  transition:background .2s,border-color .2s;
}
.akwo-toc a:hover{background:rgba(121,242,255,.12);border-color:rgba(121,242,255,.28);}

.akwo-card{
  padding:28px;border-radius:var(--akwo-r-lg);
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.10);
  margin-bottom:20px;
}
.akwo-card h3{font-size:19px;margin-bottom:12px;}

.akwo-grid-2{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px;}
.akwo-grid-3{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;}

.akwo-table-wrap{overflow-x:auto;margin:24px 0;border-radius:16px;border:1px solid rgba(255,255,255,.1);}
.akwo-table{width:100%;border-collapse:collapse;font-size:13.5px;}
.akwo-table th,.akwo-table td{padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.08);}
.akwo-table th{background:rgba(255,255,255,.06);color:var(--akwo-soft);font-weight:700;}
.akwo-table td{color:var(--akwo-muted);}

.akwo-code{
  display:block;padding:18px;border-radius:14px;margin:20px 0;
  background:rgba(0,0,0,.35);border:1px solid rgba(255,255,255,.08);
  font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:12.5px;
  color:#cbd5e1;line-height:1.6;overflow-x:auto;white-space:pre;
}

.akwo-checklist{
  padding:22px;border-radius:16px;
  background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.18);
  margin:24px 0;
}
.akwo-checklist h4{color:#bbf7d0;margin-bottom:12px;font-size:15px;}

.akwo-bento{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;margin-top:28px;}
.akwo-bento-card{
  padding:22px;border-radius:18px;background:rgba(255,255,255,.05);
  border:1px solid rgba(255,255,255,.09);
}
.akwo-bento-card h3{font-size:17px;margin-bottom:8px;}

.akwo-faq{display:flex;flex-direction:column;gap:10px;max-width:860px;margin:0 auto;}
.akwo-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.akwo-faq-q{padding:18px 24px;cursor:pointer;font-weight:700;color:var(--akwo-soft);display:flex;justify-content:space-between;gap:12px;}
.akwo-faq-q::after{content:'▾';transition:transform .2s;}
.akwo-faq-item.open .akwo-faq-q::after{transform:rotate(180deg);}
.akwo-faq-a{max-height:0;overflow:hidden;padding:0 24px;transition:max-height .35s ease,padding .35s ease;}
.akwo-faq-item.open .akwo-faq-a{max-height:800px;padding:0 24px 20px;}

.ym-cta-block{
  margin:36px 0;padding:28px 32px;border-radius:20px;
  background:linear-gradient(135deg,rgba(203,17,171,.12),rgba(0,91,255,.10));
  border:1px solid rgba(121,242,255,.18);
}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.ym-cta-block__headline{font-size:clamp(18px,2.2vw,22px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{font-size:15px;color:var(--akwo-muted);margin:0 0 18px;line-height:1.65;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;}
.ym-link--accent{color:var(--akwo-accent)!important;text-decoration:underline!important;text-underline-offset:3px;}

.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}

@media(max-width:900px){
  .akwo-intro-grid{grid-template-columns:1fr;gap:36px;}
  .akwo-intro-kpi{grid-template-columns:repeat(2,1fr);}
  .akwo-grid-2,.akwo-grid-3,.akwo-bento{grid-template-columns:1fr;}
}
@media(max-width:600px){.akwo-intro-kpi{grid-template-columns:1fr;}}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-kartochki-wildberries-ozon-page" role="main" tabindex="-1">

<section class="nero-ai-hero akwo-hero-mp" id="akwo-hero-mp" aria-labelledby="akwo-hero-title">
<style>
/* ── Hero ai-kartochki-wildberries-ozon: самодостаточные стили ── */
.akwo-hero-mp {
  --akwo-wb: #cb11ab;
  --akwo-wb-soft: rgba(203, 17, 171, 0.18);
  --akwo-ozon: #005bff;
  --akwo-ozon-soft: rgba(0, 91, 255, 0.18);
  --akwo-cyan: #79f2ff;
  --akwo-green: #22c55e;
  --akwo-text: #e6edf7;
  --akwo-muted: #9aa8bd;
  --akwo-soft: #c7d2e5;
  --akwo-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.akwo-hero-mp::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.akwo-hero-mp::after {
  content: "";
  position: absolute;
  left: 58%;
  top: 10%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background:
    radial-gradient(circle, rgba(203, 17, 171, .10), transparent 55%),
    radial-gradient(circle at 70% 40%, rgba(0, 91, 255, .12), transparent 60%);
  filter: blur(8px);
  animation: akwoHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes akwoHeroGlow {
  from { opacity: .42; transform: scale(.94); }
  to { opacity: .88; transform: scale(1.06); }
}
.akwo-hero-mp .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.akwo-hero-mp .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.akwo-hero-mp .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.6vw, 72px);
  line-height: .94;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.akwo-hero-mp .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--akwo-wb) 38%, var(--akwo-ozon) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.akwo-hero-mp .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(203, 17, 171, 0.24);
  border-radius: 999px;
  background: linear-gradient(90deg, var(--akwo-wb-soft), var(--akwo-ozon-soft));
  color: var(--akwo-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.akwo-hero-mp .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--akwo-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.akwo-hero-mp .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.akwo-hero-mp .nero-ai-badge {
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
.akwo-hero-mp .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.akwo-hero-mp .nero-ai-btn {
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
.akwo-hero-mp .nero-ai-btn:hover { transform: translateY(-2px); }
.akwo-hero-mp .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--akwo-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.akwo-hero-mp .nero-ai-btn-secondary {
  color: var(--akwo-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.akwo-hero-mp .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--akwo-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.akwo-hero-mp .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.akwo-hero-mp .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.akwo-hero-mp .nero-ai-dots { display: flex; gap: 7px; }
.akwo-hero-mp .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.akwo-hero-mp .nero-ai-dot:nth-child(1) { background: #fb7185; }
.akwo-hero-mp .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.akwo-hero-mp .nero-ai-dot:nth-child(3) { background: #34d399; }
.akwo-hero-mp .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.akwo-hero-mp .nero-ai-window-body { padding: 16px; }
.akwo-hero-mp .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.akwo-hero-mp .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.akwo-hero-mp .nero-ai-live-pill {
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
.akwo-hero-mp .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: akwoPulse 1.6s infinite;
}
@keyframes akwoPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.akwo-hero-mp .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.akwo-hero-mp .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.akwo-hero-mp .nero-ai-metric span {
  display: block;
  color: var(--akwo-muted);
  font-size: 11px;
  font-weight: 700;
}
.akwo-hero-mp .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.akwo-hero-mp .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.akwo-hero-mp .akwo-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background:
    radial-gradient(ellipse at 25% 50%, var(--akwo-wb-soft), transparent 50%),
    radial-gradient(ellipse at 75% 50%, var(--akwo-ozon-soft), transparent 50%),
    rgba(6, 10, 24, 0.92);
}
.akwo-hero-mp #akwo-mp-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.akwo-hero-mp .nero-ai-task-stream { display: grid; gap: 8px; }
.akwo-hero-mp .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.akwo-hero-mp .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--akwo-cyan);
  font-size: 10px;
  font-weight: 800;
}
.akwo-hero-mp .nero-ai-task-icon--wb {
  background: var(--akwo-wb-soft);
  color: #f0abfc;
}
.akwo-hero-mp .nero-ai-task-icon--oz {
  background: var(--akwo-ozon-soft);
  color: #93c5fd;
}
.akwo-hero-mp .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.akwo-hero-mp .nero-ai-task span {
  color: var(--akwo-muted);
  font-size: 11px;
}
.akwo-hero-mp .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.akwo-hero-mp .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .akwo-hero-mp .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .akwo-hero-mp .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .akwo-hero-mp .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .akwo-hero-mp .nero-ai-window-body { padding: 12px; }
  .akwo-hero-mp .nero-ai-task { grid-template-columns: 28px 1fr; }
  .akwo-hero-mp .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Маркетплейсы · WB / Ozon · внедрение под ключ</p>
      <h1 id="akwo-hero-title">AI-генератор карточек для <span class="nero-ai-gradient-text">Wildberries и Ozon</span>: внедрение под ключ</h1>
      <p class="nero-ai-hero-lead">Нейросеть собирает SEO-описания, заголовки, rich content и FAQ — карточки ранжируются выше и продают без ручной рутины</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">SEO-описания</li>
        <li class="nero-ai-badge">Заголовки</li>
        <li class="nero-ai-badge">Rich content</li>
        <li class="nero-ai-badge">FAQ</li>
        <li class="nero-ai-badge">API WB/Ozon</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Проверить карточку'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Как проходит внедрение →</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-генератора карточек Wildberries и Ozon">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Контент-студия WB / Ozon</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Карточек в очереди</span>
              <strong>47</strong>
              <small>фид → AI → review</small>
            </div>
            <div class="nero-ai-metric">
              <span>SEO-слой готов</span>
              <strong>92%</strong>
              <small>ключи + LSI WB</small>
            </div>
            <div class="nero-ai-metric">
              <span>Rich content</span>
              <strong>38</strong>
              <small>блоков Ozon JSON</small>
            </div>
            <div class="nero-ai-metric">
              <span>Compliance</span>
              <strong>0</strong>
              <small>стоп-слов в пилоте</small>
            </div>
          </div>

          <div class="akwo-dash-canvas-wrap" aria-hidden="false">
            <canvas id="akwo-mp-hero-canvas" role="img" aria-label="Анимация: ключи текут в студию карточек, AI собирает слои SEO и rich content, проходит модерацию и публикует на Wildberries и Ozon"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий контент-студии">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--wb">WB</span>
              <div><strong>SKU #8842 — заголовок + ключи</strong><span>60 символов · LSI в описании</span></div>
              <span class="nero-ai-status">SEO ✓</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--oz">OZ</span>
              <div><strong>Ozon rich JSON — 6 блоков</strong><span>контент-рейтинг +18 баллов</span></div>
              <span class="nero-ai-status">rich ✓</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CG</span>
              <div><strong>Compliance Guard</strong><span>«№1» заменено · галлюцинация отсечена</span></div>
              <span class="nero-ai-status">ok</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">API</span>
              <div><strong>Content API WB — пакет 12 SKU</strong><span>human review → публикация</span></div>
              <span class="nero-ai-status nero-ai-status--amber">live</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="akwo-content">

  <section class="akwo-intro akwo-section" id="intro" aria-label="Введение">
    <div class="akwo-cnt">
      <div class="akwo-intro-grid nero-ai-reveal">
        <div class="akwo-intro-text">
          <p class="akwo-eyebrow">Лонгрид · AI-карточки WB / Ozon</p>
          <p><strong>Коротко:</strong> AI-карточки Wildberries — это не разовый промпт в ChatGPT, а внедрённый контент-conveyor: SEO-описания, заголовки, rich content, FAQ и выгрузка в кабинет продавца через API. Nero Network настраивает такую систему под ключ для селлеров и брендов с каталогом от десятков до тысяч SKU.</p>
          <p>Рынок маркетплейсов в 2026 году консолидируется: по данным банка «Точка» (через sellermate.io), число активных продавцов сократилось на 6,9% за февраль–декабрь 2025, при этом медианная выручка селлера выросла на 19%. Выигрывают те, кто системно оптимизирует карточки — generative AI ускоряет черновики, но без процесса, compliance-слоя и интеграций массовая генерация превращается в риск блокировок и дублей.</p>
        </div>
        <div class="akwo-intro-kpi" aria-label="Ключевые метрики маркетплейсов">
          <div class="akwo-kpi-card"><div class="kv">−6,9%</div><div class="kl">активных продавцов за 2025</div><div class="ks">банк «Точка»</div></div>
          <div class="akwo-kpi-card"><div class="kv">+19%</div><div class="kl">медианная выручка селлера</div><div class="ks">sellermate.io</div></div>
          <div class="akwo-kpi-card"><div class="kv">1 млн+</div><div class="kl">селлеров на Wildberries</div><div class="ks">оценка рынка 2026</div></div>
          <div class="akwo-kpi-card"><div class="kv">60–250K</div><div class="kl">ориентир чека под ключ</div><div class="ks">Nero Network</div></div>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:28px;font-size:15px;color:var(--akwo-muted);text-align:left!important"><strong>Определение:</strong> AI-генератор карточек для маркетплейсов — связка процессов и инструментов, которая из фото, характеристик, УТП и ключевых запросов собирает полный контент карточки и при необходимости выгружает результат в кабинет Wildberries или Ozon через API или полуавтоматический пайплайн.</p>
      
    </div>
  </section>

  <div class="akwo-toc-outer">
    <div class="akwo-cnt">
      <nav class="akwo-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-kartochki">Почему не продают</a>
        <a href="#chto-takoe-ai-generator">AI vs ChatGPT</a>
        <a href="#ai-wb">Wildberries</a>
        <a href="#ai-ozon">Ozon</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta-audit">Аудит</a>
      </nav>
    </div>
  </div>

  <section class="akwo-section" id="pochemu-kartochki">
    <div class="akwo-cnt">
      <div class="akwo-sh akwo-left nero-ai-reveal">
        <span class="akwo-eyebrow">SEO · rich · модерация</span>
        <h2>Почему карточки на Wildberries и Ozon перестали продавать</h2>
        <p>Карточки плохо ранжируются и не конвертируют по трём связанным причинам: неполные поля и слабое SEO, визуал и rich content без структуры, нарушения правил модерации.</p>
      </div>

      <div class="akwo-card nero-ai-reveal">
        <h3>Как маркетплейсы ранжируют карточки в 2026</h3>
        <p><strong>Wildberries.</strong> Наименование — до 60 символов; приоритетные ключи в начале; описание индексируется (~2000–5000 символов); все обязательные характеристики; фото 900×1200 (3:4).</p>
        <p><strong>Ozon.</strong> Название — до 100 символов; контент-рейтинг до 100 баллов; rich до 10 блоков; более 50 млн уникальных поисковых запросов в месяц.</p>
        <div class="akwo-table-wrap">
          <table class="akwo-table">
            <thead><tr><th>Элемент</th><th>Wildberries</th><th>Ozon</th></tr></thead>
            <tbody>
              <tr><td>Название</td><td>до 60 символов, ключи в начале</td><td>до 100 символов, ≤2 повтора слова</td></tr>
              <tr><td>Описание</td><td>индексируется, ~2000–5000 символов</td><td>~1000 символов; влияет на поведение</td></tr>
              <tr><td>Rich content</td><td>JPG/PNG от 1000 px, 1:1</td><td>до 10 блоков, JSON или редактор</td></tr>
              <tr><td>API</td><td>Content API, до 100 карточек/запрос</td><td>Product Import + rich JSON</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="akwo-grid-2 nero-ai-reveal nero-ai-delay-1">
        <div class="akwo-card">
          <h3>Rich content и CTR</h3>
          <p>На WB rich content — мини-лендинг в карточке; на Ozon текст в блоках rich индексируется. Industry-оценки роста конверсии 22–30% на Ozon — не официальные цифры маркетплейса.</p>
        </div>
        <div class="akwo-card">
          <h3>Типичные ошибки селлеров</h3>
          <ul>
            <li>Дубли слов в названии WB</li>
            <li>«Простыни» ключей вместо структуры</li>
            <li>Выдуманные характеристики — триггер модерации</li>
            <li>Штраф за нарушение ИС на WB — 10 000 ₽</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="akwo-section akwo-section-alt" id="chto-takoe-ai-generator">
    <div class="akwo-cnt">
      <div class="akwo-sh akwo-left nero-ai-reveal">
        <span class="akwo-eyebrow">Продукт</span>
        <h2>Что такое AI-генератор карточек и чем он отличается от «просто ChatGPT»</h2>
        <p>AI-генератор карточек товаров — не кнопка «напиши описание», а система с модулями: семантика по нише, генерация под лимиты категории, compliance, human review и публикация.</p>
      </div>

      <div class="akwo-bento nero-ai-reveal">
        <div class="akwo-bento-card">
          <h3>Блоки системы</h3>
          <p>Наименование под лимиты площадки; SEO-описание с LSI; буллеты; FAQ; структура rich content; заполнение атрибутов.</p>
        </div>
        <div class="akwo-bento-card">
          <h3>Почему один промпт не масштабируется</h3>
          <p>Без категорийных шаблонов, лимитов символов и стоп-слов каталог из 50–100+ SKU превращается в хаос дублей.</p>
        </div>
        <div class="akwo-bento-card">
          <h3>Риски AI</h3>
          <p>Галлюцинации в характеристиках; медицинские формулировки; дубли ключей. Compliance Guard + human-in-the-loop закрывают риски.</p>
        </div>
        <div class="akwo-bento-card">
          <h3>Модель Amazon</h3>
          <p>«Черновик в кабинете + edit gate» — продавец редактирует или публикует AI-текст. Nero адаптирует как «аудит → AI-черновик → эксперт → публикация».</p>
        </div>
      </div>

      <div class="akwo-checklist nero-ai-reveal">
        <h4>Чек-лист публикации (адаптация практики vc.ru)</h4>
        <ol>
          <li>Факты сверены с этикеткой, паспортом, сертификатами.</li>
          <li>Нет запрещённых формулировок («лечит», «№1», необоснованные награды).</li>
          <li>Название без дублей слов и эмодзи; ключи в начале.</li>
          <li>Все обязательные характеристики заполнены и соответствуют товару.</li>
          <li>Rich content без SEO-спама; единый визуальный стиль.</li>
          <li>Человек утвердил финальную версию — не «сгенерил и забыл».</li>
        </ol>
      </div>
    </div>
  </section>

<section id="ai-kartochki-wildberries-ozon-boris-block" class="bwo-root" aria-label="Анимация: пайплайн AI-карточек — фид, нейросеть, публикация на Wildberries и Ozon">
<style>
/* === БОРИС: prefix bwo-, scoped внутри #ai-kartochki-wildberries-ozon-boris-block === */
#ai-kartochki-wildberries-ozon-boris-block.bwo-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:520px;
}
@media(max-width:1023px){
  #ai-kartochki-wildberries-ozon-boris-block .bwo-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-kartochki-wildberries-ozon-boris-block .bwo-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#cb11ab;
  margin:0 0 14px;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-ey::before{
  content:'';
  width:18px;height:2px;
  background:linear-gradient(90deg,#cb11ab,#005bff);
  border-radius:1px;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-ul{
  list-style:none;
  margin:0 0 20px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(203,17,171,.08);
  display:flex;align-items:center;justify-content:center;
  font-size:10px;
  color:#a21caf;
  margin-top:1px;
  font-style:normal;
  font-weight:700;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:20px;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-pl-wb{
  background:rgba(203,17,171,.08);
  color:#a21caf;
  border:1.5px solid rgba(203,17,171,.22);
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-pl-oz{
  background:rgba(0,91,255,.08);
  color:#1d4ed8;
  border:1.5px solid rgba(0,91,255,.22);
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-cta{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  align-self:flex-start;
  margin-bottom:16px;
  font-size:14px;
  font-weight:700;
  padding:12px 22px;
  border-radius:12px;
  text-decoration:none;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-kartochki-wildberries-ozon-boris-block .bwo-rgt{
  position:relative;
  background:linear-gradient(135deg,#fdf4ff 0%,#eff6ff 38%,#f0fdf4 72%,#f8fafc 100%);
  min-height:460px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-kartochki-wildberries-ozon-boris-block .bwo-rgt{min-height:380px;}
}
#bwo-mp-feed-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bwo-cnt">
  <div class="bwo-card">

    <div class="bwo-lft">
      <span class="bwo-ey">Контент-conveyor</span>
      <h3 class="bwo-h3">Один фид — AI-сборка — две площадки без копипаста</h3>
      <ul class="bwo-ul">
        <li><span class="bwo-ic">1</span>Мастер-фид из Sheets, PIM или CSV: SKU, фото, характеристики, tone of voice</li>
        <li><span class="bwo-ic">2</span>Semantic Engine подтягивает ключи WB/Ozon; Copy Generator собирает SEO, rich и FAQ</li>
        <li><span class="bwo-ic">3</span>Compliance Guard режет стоп-слова и галлюцинации — human review перед API</li>
        <li><span class="bwo-ic">→</span>Publish Adapter выгружает адаптированные карточки в кабинеты Wildberries и Ozon</li>
      </ul>
      <div class="bwo-pills">
        <span class="bwo-pl bwo-pl-wb">WB · Content API</span>
        <span class="bwo-pl bwo-pl-oz">Ozon · Import</span>
        <span class="bwo-pl bwo-pl-g">3–10 мин / SKU</span>
      </div>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent bwo-cta"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Проверить карточку'); ?></a>
      <p class="bwo-foot">Дальше — SEO-описания и заголовки под алгоритм Wildberries →</p>
    </div>

    <div class="bwo-rgt">
      <canvas
        id="bwo-mp-feed-pipeline-canvas"
        aria-label="Анимация: товарный фид проходит AI-обработку и публикуется на Wildberries и Ozon"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bwo-mp-feed-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;
  var LOOP = 820;

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
    feed:'#0ea5e9',
    feedBg:'rgba(14,165,233,.08)',
    ai:'#8b5cf6',
    aiGlow:'rgba(139,92,246,.18)',
    comp:'#22c55e',
    compBg:'rgba(34,197,94,.1)',
    wb:'#cb11ab',
    wbBg:'rgba(203,17,171,.1)',
    oz:'#005bff',
    ozBg:'rgba(0,91,255,.1)',
    paper:'#ffffff',
    line:'rgba(100,116,139,.35)',
    chip:'#e0f2fe',
    chipBdr:'#7dd3fc'
  };

  var STAGES = [
    {id:'feed',   label:'Фид SKU',       sub:'Sheets · PIM',     color:C.feed},
    {id:'sem',    label:'Ключи',         sub:'Semantic Engine',  color:C.feed},
    {id:'ai',     label:'AI-сборка',     sub:'SEO · rich · FAQ', color:C.ai},
    {id:'guard',  label:'Compliance',    sub:'human review',     color:C.comp},
    {id:'split',  label:'Публикация',    sub:'WB + Ozon',        color:C.wb}
  ];

  var SKUS = [
    {name:'SKU-1042', cat:'Косметика', delay:0},
    {name:'SKU-2087', cat:'Дом',       delay:180},
    {name:'SKU-3310', cat:'Одежда',    delay:360},
    {name:'SKU-4521', cat:'Косметика', delay:540},
    {name:'SKU-5899', cat:'Дом',       delay:720}
  ];

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function txt(str,x,y,size,clr,align,bold){
    ctx.fillStyle=clr||C.ink;
    ctx.font=(bold?'bold ':'')+(size||11)+'px Inter,system-ui,sans-serif';
    ctx.textAlign=align||'left';
    ctx.fillText(str,x,y);
  }

  function drawStageNode(cx,cy,r,stage,pulse,active){
    var glow = active ? 1 : 0.55;
    ctx.globalAlpha=glow;
    rr(cx-r,cy-r,r*2,r*2,r,stage.color==='ai'?C.aiGlow:stage.color==='feed'?C.feedBg:stage.color==='comp'?C.compBg:C.wbBg,stage.color,active?2.5:1.5);
    ctx.globalAlpha=1;
    if(stage.id==='ai'){
      for(var i=0;i<4;i++){
        var ang=(i/4)*Math.PI*2+pulse*0.05;
        ctx.beginPath();
        ctx.arc(cx+Math.cos(ang)*(r-6),cy+Math.sin(ang)*(r-6),3,0,Math.PI*2);
        ctx.fillStyle=C.ai;ctx.fill();
      }
    }
    if(stage.id==='guard' && active){
      ctx.strokeStyle=C.comp;ctx.lineWidth=2;
      ctx.beginPath();
      ctx.moveTo(cx-5,cy);ctx.lineTo(cx-1,cy+4);ctx.lineTo(cx+6,cy-5);
      ctx.stroke();
    }
    txt(stage.label,cx,cy+r+14,9,active?C.ink:C.muted,'center',true);
    txt(stage.sub,cx,cy+r+26,8,C.muted,'center',false);
  }

  function drawFeedPanel(x,y,w,h,pulse){
    rr(x,y,w,h,10,C.paper,'#cbd5e1',1.5);
    rr(x,y,w,22,10,'#f1f5f9','#e2e8f0',0);
    txt('Мастер-фид',x+10,y+15,10,C.ink,'left',true);
    var rows=4, rh=(h-34)/rows;
    for(var i=0;i<rows;i++){
      var ry=y+28+i*rh;
      rr(x+8,ry+4,w-16,rh-8,4,i%2?C.feedBg:'#f8fafc','#e2e8f0',1);
      rr(x+12,ry+10,28,8,2,C.feed,null,0);
      rr(x+46,ry+10,w*0.35,8,2,'#e2e8f0',null,0);
      if((pulse+i*20)%60<30){
        rr(x+w-28,ry+8,16,12,3,C.compBg,C.comp,1);
      }
    }
  }

  function drawMiniCard(x,y,w,h,brand,clr,bg,lines,pulse){
    rr(x,y,w,h,8,C.paper,clr,2);
    rr(x+6,y+6,w-12,h*0.38,5,bg,clr,0);
    txt(brand,x+w/2,y+h*0.28,9,clr,'center',true);
    for(var i=0;i<lines;i++){
      rr(x+8,y+h*0.48+i*10,w-16,6,2,'#e2e8f0',null,0);
    }
    if(pulse%40<20){
      rr(x+w-22,y+8,14,14,7,bg,clr,1.5);
      ctx.fillStyle=clr;
      ctx.font='bold 9px sans-serif';
      ctx.textAlign='center';
      ctx.fillText('✓',x+w-15,y+18);
    }
  }

  function drawPacket(px,py,sku,t,stageIdx){
    var size=22;
    var alpha=1;
    var layers=Math.min(stageIdx,4);
    rr(px-size/2,py-size/2,size,size,6,C.paper,C.feed,1.5);
    ctx.fillStyle=C.feed;
    ctx.font='bold 7px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('SKU',px,py+2);
    if(layers>=2){
      rr(px-size/2+2,py-size/2-5,size-4,5,2,C.chip,C.chipBdr,1);
      txt('SEO',px,py-size/2-1,6,C.muted,'center',false);
    }
    if(layers>=3){
      rr(px-size/2+2,py+size/2, size-4,5,2,'#fae8ff','#e879f9',1);
    }
    if(layers>=4){
      ctx.strokeStyle=C.comp;ctx.lineWidth=1.5;
      ctx.beginPath();ctx.arc(px+size/2-3,py-size/2+3,4,0,Math.PI*2);ctx.stroke();
    }
    ctx.globalAlpha=alpha;
    txt(sku.name,px,py+size/2+10,7,C.muted,'center',false);
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t=frame%LOOP;
    var pulse=frame;
    ctx.clearRect(0,0,W,H);

    var pad=16;
    var stageCount=STAGES.length;
    var usableW=W-pad*2;
    var stageGap=usableW/(stageCount-1);
    var baseY=H*0.42;
    var nodeR=Math.min(26, H*0.055);

    /* flow line */
    ctx.strokeStyle=C.line;
    ctx.lineWidth=2;
    ctx.setLineDash([6,5]);
    ctx.beginPath();
    ctx.moveTo(pad+nodeR, baseY);
    ctx.lineTo(W-pad-nodeR, baseY);
    ctx.stroke();
    ctx.setLineDash([]);

    /* animated flow dots */
    for(var d=0;d<5;d++){
      var prog=((t+d*140)%LOOP)/LOOP;
      var fx=pad+nodeR+prog*(usableW-nodeR*2);
      ctx.beginPath();
      ctx.arc(fx,baseY,3,0,Math.PI*2);
      ctx.fillStyle=d%2?C.wb:C.oz;
      ctx.globalAlpha=0.35+0.35*Math.sin(prog*Math.PI);
      ctx.fill();
      ctx.globalAlpha=1;
    }

    /* stage nodes */
    STAGES.forEach(function(st,i){
      var sx=pad+nodeR+i*stageGap;
      var active=((t+i*90)%200)<120;
      drawStageNode(sx,baseY,nodeR,st,pulse,active);
    });

    /* feed panel left */
    var feedW=Math.min(88, W*0.14);
    var feedH=Math.min(110,H*0.28);
    drawFeedPanel(pad, H*0.62, feedW, feedH, pulse);

    /* marketplace outputs right */
    var cardW=Math.min(72, W*0.11);
    var cardH=cardW*1.35;
    var rx=W-pad-cardW;
    drawMiniCard(rx, H*0.58, cardW, cardH, 'WB', C.wb, C.wbBg, 3, pulse);
    drawMiniCard(rx, H*0.58+cardH+10, cardW, cardH, 'Ozon', C.oz, C.ozBg, 2, pulse+15);

    /* split arrows */
    ctx.strokeStyle=C.line;ctx.lineWidth=1.5;
    ctx.beginPath();
    ctx.moveTo(W-pad-nodeR-20, baseY);
    ctx.lineTo(rx+cardW/2, H*0.58+cardH/2);
    ctx.moveTo(W-pad-nodeR-20, baseY);
    ctx.lineTo(rx+cardW/2, H*0.58+cardH+10+cardH/2);
    ctx.stroke();

    /* moving SKU packets */
    SKUS.forEach(function(sku){
      var lt=(t-sku.delay+LOOP)%LOOP;
      var prog=lt/LOOP;
      var px=pad+nodeR+prog*(usableW-nodeR*2);
      var py=baseY-Math.sin(prog*Math.PI)*18;
      var stIdx=Math.floor(prog*(stageCount));
      if(stIdx>=stageCount) stIdx=stageCount-1;
      drawPacket(px,py,sku,lt,stIdx);
    });

    /* legend strip */
    rr(pad, pad, W-pad*2, 28, 8,'rgba(255,255,255,.72)','rgba(148,163,184,.25)',1);
    txt('фид → ключи → AI → compliance → WB / Ozon', W/2, pad+18, 10, C.muted, 'center', false);

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>

  <section class="akwo-section" id="ai-wb">
    <div class="akwo-cnt">
      <div class="akwo-sh akwo-left nero-ai-reveal">
        <span class="akwo-eyebrow">Wildberries</span>
        <h2>AI-карточки для Wildberries: описания, заголовки и SEO под алгоритм WB</h2>
        <p>Блок ai описание товара wb и ai seo wb — ядро коммерческого кластера. Wildberries индексирует описание; ai заголовки товаров напрямую влияют на видимость.</p>
      </div>
      <div class="akwo-grid-3 nero-ai-reveal">
        <div class="akwo-card"><h3>Структура SEO-описания</h3><p>Аудитория → преимущества → сценарии → детали. Ключи естественно; лимит категории соблюдается автоматически.</p></div>
        <div class="akwo-card"><h3>Заголовки и буллеты</h3><p>До 60 символов: бренд, тип, ключевой атрибут. Буллеты — короткие проверяемые УТП без суперлативов из стоп-листа.</p></div>
        <div class="akwo-card"><h3>Rich и FAQ</h3><p>Авто: структура rich, тексты слайдов, черновики FAQ. Вручную: юридически значимые формулировки и финальный визуал.</p></div>
      </div>
    </div>
  </section>

  <section class="akwo-section akwo-section-alt" id="ai-ozon">
    <div class="akwo-cnt">
      <div class="akwo-sh akwo-left nero-ai-reveal">
        <span class="akwo-eyebrow">Ozon</span>
        <h2>AI-карточки для Ozon: отличия требований и единый контент-пайплайн</h2>
        <p>Ai ozon карточки требуют отдельной логики: генератор не копирует WB-текст один в один. Ozon сильнее опирается на название, атрибуты, rich и контент-рейтинг.</p>
      </div>
      <div class="akwo-grid-2 nero-ai-reveal">
        <div class="akwo-card"><h3>Отличия Ozon от WB</h3><p>Контент-рейтинг до 100 баллов; rich через JSON или редактор; переиндексация 7–14 дней после обновлений.</p></div>
        <div class="akwo-card"><h3>Один фид — две площадки</h3><p>Единый мастер-фид в PIM; AI-модуль адаптирует контент под лимиты WB и Ozon без ручного копипаста.</p></div>
      </div>
      <div class="akwo-card nero-ai-reveal nero-ai-delay-1">
        <h3>Когда одна площадка, когда обе</h3>
        <p><strong>Одна площадка:</strong> каталог до ~50 SKU, тест ниши. <strong>Обе сразу:</strong> бренд с единым ассортиментом, общий PIM, сезонный запуск сотен позиций.</p>
      </div>
    </div>
  </section>

  <section class="akwo-section" id="etapy">
    <div class="akwo-cnt">
      <div class="akwo-sh akwo-left nero-ai-reveal">
        <span class="akwo-eyebrow">Под ключ</span>
        <h2>Внедрение AI-карточек под ключ: этапы от аудита до массовой публикации</h2>
        <p>Ai карточки wildberries под ключ — коммерческое ядро Nero Network. Ориентир чека: 60–250 тыс. ₽.</p>
      </div>

      <div class="akwo-card nero-ai-reveal">
        <h3>Бесплатный аудит одной карточки WB/Ozon</h3>
        <p>Scorecard: контент-рейтинг и полнота полей; SEO vs топ-3; rich content; риски модерации; roadmap пилота на 10–50 карточек.</p>
      </div>

<div class="ym-cta-block ym-cta-block--primary" id="cta-audit">
  <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Проверьте одну карточку Wildberries или Ozon — бесплатно</p>
    <p class="ym-cta-block__sub">Scorecard: контент-рейтинг и полнота полей, SEO vs топ-3 в нише, rich content, риски модерации и roadmap пилота на 10–50 SKU. Не «3 бесплатные генерации», а разбор с ценностью — без обязательств по внедрению.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Проверить карточку'); ?></a>
  </div>
</div>

      <div class="akwo-bento nero-ai-reveal">
        <div class="akwo-bento-card"><h3>Этап 1 — ТЗ и tone of voice</h3><p>Категория, артикулы, фото, этикетка, конкуренты, brandbook для rich.</p></div>
        <div class="akwo-bento-card"><h3>Этап 2 — промпты и compliance</h3><p>Шаблоны по категориям; Compliance Guard под БАД и косметику; выбор LLM по 152-ФЗ.</p></div>
        <div class="akwo-bento-card"><h3>Этап 3 — пилот 10–50 SKU</h3><p>A/B → human review → публикация через API. Мониторинг 7–14 дней: показы, CTR, позиции.</p></div>
        <div class="akwo-bento-card"><h3>Этап 4 — масштаб</h3><p>Триггер «новый SKU» в Make/n8n → черновик → задача в amoCRM → публикация → лог версий.</p></div>
      </div>
    </div>
  </section>

  <section class="akwo-section akwo-section-alt" id="integracii">
    <div class="akwo-cnt">
      <div class="akwo-sh akwo-left nero-ai-reveal">
        <span class="akwo-eyebrow">API · CRM · Make/n8n</span>
        <h2>Интеграции: CRM, PIM, Google Sheets и автоматизация через Make/n8n</h2>
        <p>Интеграция ai карточки wildberries с CRM — дифференциатор Nero Network против обзорных «ТОП-15 нейросетей» без API-слоя.</p>
      </div>
      <pre class="akwo-code nero-ai-reveal">Фид (Sheets/PIM/CSV) → Semantic Engine (ключи) → Copy Generator + Rich Planner
→ Compliance Guard → Human review (Sheets/UI) → Publish Adapter (WB/Ozon API) → Audit Dashboard</pre>
      <div class="akwo-grid-2 nero-ai-reveal nero-ai-delay-1">
        <div class="akwo-card"><h3>CRM и ERP</h3>
          <p>amoCRM / Bitrix24: статусы «черновик / на модерации / опубликовано», задачи контент-менеджеру; для связки статусов и AI-автоматизации подойдёт <a href="/vnedrenie-ai-amocrm/">внедрение AI-агента в amoCRM</a>.</p>
          <p>PIM: Google Sheets, 1С, МойСклад — единые мастер-данные товара; при учёте в 1С имеет смысл рассмотреть <a href="/ai-1c-erp/">AI-агент для 1С и ERP</a> как источник SKU для conveyor.</p></div>
        <div class="akwo-card"><h3>Human-in-the-loop</h3><p>Стандарт индустрии: WildCards, MPStats, Amazon edit gate. API-токен WB — минимальные права Content API.</p></div>
      </div>
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до пилота карточек?</p>
    <p class="ym-cta-block__sub">Перед внедрением conveyor полезно разобраться в промптах, Make/n8n и human-in-the-loop — это ускоряет согласование с контент-менеджерами и снижает риск «сгенерил — загрузил — забыл». Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
  </div>
</aside>
    </div>
  </section>

  

  <section class="akwo-section" id="keisy">
    <div class="akwo-cnt">
      <div class="akwo-sh akwo-left nero-ai-reveal">
        <span class="akwo-eyebrow">E-E-A-T</span>
        <h2>Кейсы и примеры внедрения AI-карточек для селлеров и брендов</h2>
        <p>Публичных именованных B2B-кейсов мало — Nero опирается на проверенные модели и честно разделяет их с проектной реализацией.</p>
      </div>
      <div class="akwo-grid-3 nero-ai-reveal">
        <div class="akwo-card"><h3>Одежда и косметика</h3><p>87 SKU косметики: черновик ~3 мин vs 25–35 мин вручную; финал после чек-листа на галлюцинации (vc.ru).</p></div>
        <div class="akwo-card"><h3>Товары для дома</h3><p>Сотни SKU с близкими характеристиками; категорийные промпты и пакетная обработка через API до 100 карточек/запрос WB.</p></div>
        <div class="akwo-card"><h3>Малый бизнес vs бренд</h3><p>5–30 SKU — SaaS + review; 100–1000+ SKU — conveyor с CRM, compliance и API; чек 60–250 тыс. ₽.</p></div>
      </div>
    </div>
  </section>

  <section class="akwo-section akwo-section-alt" id="ceny">
    <div class="akwo-cnt">
      <div class="akwo-sh akwo-left nero-ai-reveal">
        <span class="akwo-eyebrow">ROI</span>
        <h2>Сколько стоит внедрение и как считать ROI от AI-карточек</h2>
        <p>Ai карточки wildberries цена зависит от SKU, интеграций и глубины rich — не от «59 ₽ за токен».</p>
      </div>
      <div class="akwo-table-wrap nero-ai-reveal">
        <table class="akwo-table">
          <thead><tr><th>Компонент</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Аудит 1 карточки</td><td>scorecard, ключи, риски — бесплатно</td></tr>
            <tr><td>Настройка conveyor</td><td>промпты, compliance, шаблоны категорий</td></tr>
            <tr><td>Интеграции</td><td>WB/Ozon API, Sheets, Make/n8n, amoCRM</td></tr>
            <tr><td>Пилот 10–50 SKU</td><td>генерация, review, публикация, отчёт 7–14 дней</td></tr>
            <tr><td>Масштаб + поддержка</td><td>сезонные обновления, мониторинг API</td></tr>
          </tbody>
        </table>
      </div>
      <div class="akwo-table-wrap nero-ai-reveal nero-ai-delay-1">
        <table class="akwo-table">
          <thead><tr><th>Критерий</th><th>SaaS</th><th>Nero под ключ</th></tr></thead>
          <tbody>
            <tr><td>SKU</td><td>до ~30</td><td>50–1000+</td></tr>
            <tr><td>Маркетплейсы</td><td>ручная адаптация</td><td>единый фид WB + Ozon</td></tr>
            <tr><td>Compliance</td><td>на клиенте</td><td>Compliance Guard + эксперт</td></tr>
          </tbody>
        </table>
      </div>
<div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Узнайте бюджет под ваш каталог WB/Ozon</p>
    <p class="ym-cta-block__sub">Ориентир <strong>60–250 тыс. ₽</strong> за внедрение под ключ — между токенами SaaS и AI-консалтингом. На бесплатном аудите одной карточки дадим оценку SKU, интеграций (API, CRM, PIM) и ROI пилота — без обязательств.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Проверить карточку'); ?></a>
      <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
    </div>
  </div>
</div>
    </div>
  </section>

  <section class="akwo-section" id="strategiya">
    <div class="akwo-cnt">
      <div class="akwo-sh akwo-left nero-ai-reveal">
        <span class="akwo-eyebrow">Родовой AI</span>
        <h2>Внедрение AI в бизнес-процессы контента: место карточек маркетплейсов в стратегии</h2>
        <p>Внедрение AI в бизнес-процессы контента в 2026 часто начинается с маркетинга — быстрый win с измеримым результатом; об этом же пишут <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">уроки корпоративного внедрения AI</a> на примере масштабных программ. Карточки WB/Ozon — не изолированный канал, а часть контент-завода бренда.</p>
      </div>
      <div class="akwo-grid-2 nero-ai-reveal">
        <div class="akwo-card"><h3>Быстрый win в 2026</h3><p>Generative AI для e-commerce — один из первых сценариев с понятным ROI: тексты, rich, FAQ без найма отдела копирайтеров на каждый SKU.</p></div>
        <div class="akwo-card"><h3>Контент-завод и SEO сайта</h3><p>Единый brand tone в PIM питает карточки, сайт бренда, email и соцсети; следующий шаг после карточек — <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработку входящей почты в CRM</a> для единой коммуникации с клиентами. Semantic Engine собирает ключи и для WB/Ozon, и для SEO сайта.</p></div>
      </div>
    </div>
  </section>

  <section class="akwo-section akwo-section-alt" id="faq">
    <div class="akwo-cnt">
      <div class="akwo-sh nero-ai-reveal">
        <span class="akwo-eyebrow">FAQ</span>
        <h2>Как внедрить AI-карточки Wildberries и Ozon</h2>
      </div>
      <div class="akwo-faq nero-ai-reveal">
        <div class="akwo-faq-item"><div class="akwo-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли использовать один текст на WB и Ozon?</div><div class="akwo-faq-a"><p>Нет как единый копипаст: лимиты названия (60 vs 100 символов), индексация и форматы rich различаются. Единый мастер-фид + AI-адаптация — правильная модель.</p></div></div>
        <div class="akwo-faq-item"><div class="akwo-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли отдельный SEO-специалист после внедрения?</div><div class="akwo-faq-a"><p>Semantic Engine и пилот закрывают рутину ключей; SEO-специалист нужен для стратегии категорий и рекламы — не для ручного копипаста 200 описаний.</p></div></div>
        <div class="akwo-faq-item"><div class="akwo-faq-q" tabindex="0" role="button" aria-expanded="false">Как часто обновлять карточки нейросетью?</div><div class="akwo-faq-a"><p>Сезонные коллекции — перед запуском; стабильный ассортимент — при падении CTR/позиций; Ozon — ориентир переиндексации 7–14 дней.</p></div></div>
        <div class="akwo-faq-item"><div class="akwo-faq-q" tabindex="0" role="button" aria-expanded="false">Что входит в бесплатный аудит одной карточки?</div><div class="akwo-faq-a"><p>Контент-рейтинг; SEO vs топ-3; rich content; риски модерации; roadmap пилота. CTA: Проверить карточку.</p></div></div>
        <div class="akwo-faq-item"><div class="akwo-faq-q" tabindex="0" role="button" aria-expanded="false">Сроки внедрения под ключ</div><div class="akwo-faq-a"><p>Аудит — 1–3 дня. Настройка — 1–2 недели. Пилот 10–50 SKU — 2–4 недели с мониторингом.</p></div></div>
        <div class="akwo-faq-item"><div class="akwo-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли дизайнер, если AI генерирует карточки?</div><div class="akwo-faq-a"><p>Тексты и структура rich — AI; финальный визуал — дизайнер или Visual Bridge (Fabula, WBGen).</p></div></div>
        <div class="akwo-faq-item"><div class="akwo-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько SKU окупает внедрение?</div><div class="akwo-faq-a"><p>Ориентир: от ~50 SKU при регулярных обновлениях или двух маркетплейсах; при 5 SKU чаще достаточно SaaS + аудита.</p></div></div>
        <div class="akwo-faq-item"><div class="akwo-faq-q" tabindex="0" role="button" aria-expanded="false">Как передать API-токен безопасно?</div><div class="akwo-faq-a"><p>Отдельный токен с минимальными правами WB Content API; не передавать пароль от кабинета; ротация при смене подрядчика.</p></div></div>
        <div class="akwo-faq-item"><div class="akwo-faq-q" tabindex="0" role="button" aria-expanded="false">Rich content на Ozon: JSON или редактор?</div><div class="akwo-faq-a"><p>Оба варианта: визуальный редактор для точечных правок; JSON/API для массовых обновлений. Publish Adapter поддерживает оба сценария.</p></div></div>
      </div>
      <div class="akwo-card nero-ai-reveal" style="margin-top:32px">
        <p><strong>Итог:</strong> ai карточки wildberries под ключ — это conveyor Nero Network: фид → ключи → AI-черновик → compliance → эксперт → публикация → мониторинг. Не SaaS «за 59 ₽» и не абстрактный ChatGPT, а внедрение с интеграциями, чек-листом модерации и измеримым пилотом.</p>
      </div>
<div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы к AI-карточкам на Wildberries и Ozon?</p>
    <p class="ym-cta-block__sub">Отправьте ссылку или артикул одной карточки — подготовим бесплатный аудит: ключи, rich, риски модерации и план conveyor под ваш каталог. Следующий шаг — пилот на 10–50 SKU с human-in-the-loop и выгрузкой через API.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Проверить карточку'); ?></a>
  </div>
</div>
    </div>
  </section>

</div>

<?php
$akwo_page_url = trailingslashit( get_permalink() );
$akwo_site_url = trailingslashit( home_url( '/' ) );
$akwo_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$akwo_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $akwo_site_url . '#organization',
      'name'  => $akwo_brand,
      'url'   => $akwo_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $akwo_site_url . '#website',
      'url'       => $akwo_site_url,
      'name'      => $akwo_brand,
      'publisher' => [ '@id' => $akwo_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $akwo_page_url . '#webpage',
      'url'         => $akwo_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $akwo_site_url . '#website' ],
      'about'       => [ '@id' => $akwo_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $akwo_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $akwo_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $akwo_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $akwo_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $akwo_page_url,
      'provider'    => [ '@id' => $akwo_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $akwo_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Можно ли использовать один текст на WB и Ozon?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет как единый копипаст: лимиты названия (60 vs 100 символов), индексация и форматы rich различаются. Единый мастер-фид + AI-адаптация — правильная модель.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужен ли отдельный SEO-специалист после внедрения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Semantic Engine и пилот закрывают рутину ключей; SEO-специалист нужен для стратегии категорий и рекламы — не для ручного копипаста 200 описаний.' ] ],
        [ '@type' => 'Question', 'name' => 'Как часто обновлять карточки нейросетью?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Сезонные коллекции — перед запуском; стабильный ассортимент — при падении CTR/позиций; Ozon — ориентир переиндексации 7–14 дней.' ] ],
        [ '@type' => 'Question', 'name' => 'Что входит в бесплатный аудит одной карточки?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Контент-рейтинг; SEO vs топ-3; rich content; риски модерации; roadmap пилота. CTA: Проверить карточку.' ] ],
        [ '@type' => 'Question', 'name' => 'Сроки внедрения под ключ', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит — 1–3 дня. Настройка — 1–2 недели. Пилот 10–50 SKU — 2–4 недели с мониторингом.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужен ли дизайнер, если AI генерирует карточки?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Тексты и структура rich — AI; финальный визуал — дизайнер или Visual Bridge (Fabula, WBGen).' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько SKU окупает внедрение?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир: от ~50 SKU при регулярных обновлениях или двух маркетплейсах; при 5 SKU чаще достаточно SaaS + аудита.' ] ],
        [ '@type' => 'Question', 'name' => 'Как передать API-токен безопасно?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Отдельный токен с минимальными правами WB Content API; не передавать пароль от кабинета; ротация при смене подрядчика.' ] ],
        [ '@type' => 'Question', 'name' => 'Rich content на Ozon: JSON или редактор?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Оба варианта: визуальный редактор для точечных правок; JSON/API для массовых обновлений. Publish Adapter поддерживает оба сценария.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $akwo_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
/**
 * akwo-mp-hero-engine — «Контент-студия двух витрин WB + Ozon»
 * Фазы: intake → layer_stack → compliance_scan → publish_boost
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("akwo-mp-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 280) * 1.08;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    wb: "#cb11ab",
    wbLight: "#f0abfc",
    wbPanel: "rgba(203,17,171,0.12)",
    ozon: "#005bff",
    ozonLight: "#93c5fd",
    ozonPanel: "rgba(0,91,255,0.12)",
    layerTitle: "#fef3c7",
    layerSeo: "#a7f3d0",
    layerRich: "#fbcfe8",
    layerFaq: "#ddd6fe",
    keyChip: "#e0f2fe",
    gateGreen: "#22c55e",
    gateRed: "#fb7185",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    cardBg: "#1e293b"
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

  /* Лоток входящих SKU с фида */
  function SkuIntakeTray() {}
  SkuIntakeTray.prototype.draw = function (ctx) {
    drawRR(ctx, -195, -72, 36, 52, 5, "rgba(30,41,59,0.65)", C.outline);
    for (var i = 0; i < 3; i++) {
      drawRR(ctx, -188, -62 + i * 8, 22, 10, 2, i % 2 ? C.layerTitle : "#f8fafc", C.outline);
    }
    ctx.fillStyle = C.wbLight;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Фид SKU", -192, -78);
  };

  /* Изогнутые потоки ключей — вместо Conveyor */
  function SemanticKeywordRiver() {
    this.chips = [
      { stream: 0, offset: 0, text: "ai seo wb" },
      { stream: 0, offset: 45, text: "rich" },
      { stream: 1, offset: 20, text: "ozon" },
      { stream: 1, offset: 70, text: "FAQ" },
      { stream: 0, offset: 90, text: "LSI" }
    ];
  }
  SemanticKeywordRiver.prototype.draw = function (ctx) {
    var streams = [
      { y0: -55, amp: 12, color: C.wbLight },
      { y0: 55, amp: 10, color: C.ozonLight }
    ];
    streams.forEach(function (s, si) {
      ctx.strokeStyle = si === 0 ? "rgba(203,17,171,0.35)" : "rgba(0,91,255,0.35)";
      ctx.lineWidth = 2;
      ctx.beginPath();
      for (var x = -200; x <= 200; x += 8) {
        var y = s.y0 + Math.sin((x + frame * 0.6) * 0.04) * s.amp;
        if (x === -200) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
      }
      ctx.stroke();
    });

    this.chips.forEach(function (chip) {
      var t = ((frame * 0.35 + chip.offset) % 140) / 140;
      var x = -190 + t * 380;
      var baseY = chip.stream === 0 ? -55 : 55;
      var y = baseY + Math.sin((x + frame * 0.6) * 0.04) * (chip.stream === 0 ? 12 : 10);
      if (t > 0.05 && t < 0.92) {
        var tw = chip.text.length * 4.5 + 10;
        drawRR(ctx, x - tw / 2, y - 6, tw, 12, 3, C.keyChip, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(chip.text, x, y + 2);
      }
    });
  };

  /* Карусель слайдов rich content */
  function RichContentSlideCarousel() {
    this.slide = 0;
  }
  RichContentSlideCarousel.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 70 || prg >= 170) return;
    var slides = ["УТП", "Слайд 2", "FAQ"];
    var active = Math.floor((prg - 70) / 28) % 3;
    this.slide = active;
    for (var i = 0; i < 3; i++) {
      var sx = -8 + i * 22;
      var sy = -118 + (i === active ? 0 : 4);
      var alpha = i === active ? 1 : 0.45;
      ctx.globalAlpha = alpha;
      drawRR(ctx, sx, sy, 28, 18, 3, i === active ? C.layerRich : "rgba(251,207,232,0.4)", C.outline);
      ctx.fillStyle = "#831843";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(slides[i], sx + 14, sy + 11);
      ctx.globalAlpha = 1;
    }
  };

  /* Две витрины-карточки — вместо WebsiteTerminal */
  function TwinMarketplaceCardForge() {
    this.layerPhase = 0;
    this.modStamp = 0;
    this.sparkH = 0;
  }
  TwinMarketplaceCardForge.prototype.drawCard = function (ctx, x, y, w, h, brandColor, brandLabel, layers, prg) {
    drawRR(ctx, x, y, w, h, 8, C.cardBg, C.outline);
    drawRR(ctx, x + 4, y + 4, w - 8, 14, [4, 4, 0, 0], brandColor, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText(brandLabel, x + 8, y + 14);

    var layerNames = ["Заголовок", "SEO", "Rich", "FAQ"];
    var layerColors = [C.layerTitle, C.layerSeo, C.layerRich, C.layerFaq];
    layerNames.forEach(function (name, i) {
      if (prg > 35 + i * 22) {
        var ly = y + 24 + i * 14;
        drawRR(ctx, x + 6, ly, w - 12, 10, 2, layerColors[i], C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(name, x + 10, ly + 7);
      }
    });

    /* Фото-плейсхолдер */
    if (prg > 30) {
      drawRR(ctx, x + 6, y + h - 28, w - 12, 20, 3, "rgba(255,255,255,0.08)", C.outline);
    }
  };

  TwinMarketplaceCardForge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    this.layerPhase = prg;

    this.drawCard(ctx, -118, -58, 72, 108, C.wb, "WB", 4, prg);
    this.drawCard(ctx, 46, -58, 72, 108, C.ozon, "Ozon", 4, prg);

    /* Центральный AI-мост */
    drawRR(ctx, -22, -18, 44, 36, 8, "rgba(121,242,255,0.12)", C.outline);
    ctx.fillStyle = "#79f2ff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI", -2, 2);

    /* Фаза compliance: штамп между карточками */
    if (prg >= 155 && prg < 210) {
      var stampA = Math.min(1, (prg - 155) / 14);
      ctx.save();
      ctx.globalAlpha = stampA;
      ctx.strokeStyle = C.gateGreen;
      ctx.lineWidth = 2;
      ctx.strokeRect(-38, 42, 76, 22);
      ctx.fillStyle = C.gateGreen;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("МОДЕРАЦИЯ ✓", 0, 56);
      ctx.restore();
    }

    /* Фаза publish_boost: sparkline ранжирования */
    if (prg >= 195) {
      this.sparkH = Math.min(28, (prg - 195) * 1.2);
      var pts = [0, 4, 8, 14, 10, 18, 22, this.sparkH];
      ctx.strokeStyle = C.gateGreen;
      ctx.lineWidth = 2;
      ctx.beginPath();
      pts.forEach(function (py, i) {
        var px = -50 + i * 14;
        if (i === 0) ctx.moveTo(px, 78 - py);
        else ctx.lineTo(px, 78 - py);
      });
      ctx.stroke();
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("↑ позиция", 0, 92);
    }
  };

  /* Арка compliance-сканера */
  function ComplianceCheckGate() {
    this.scanLine = 0;
  }
  ComplianceCheckGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 130 || prg >= 200) return;

    ctx.strokeStyle = "rgba(34,197,94,0.55)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, 8, 52, Math.PI, 0);
    ctx.stroke();

    var scanT = (prg - 130) / 70;
    this.scanLine = -44 + scanT * 88;
    ctx.fillStyle = "rgba(34,197,94,0.25)";
    ctx.fillRect(this.scanLine - 2, -36, 4, 72);

    if (prg > 145 && prg < 175) {
      drawRR(ctx, 58, -8, 38, 12, 3, "rgba(251,113,133,0.25)", C.gateRed);
      ctx.fillStyle = C.gateRed;
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("№1 ✗", 77, 1);
    }
  };

  /* Луч API-публикации */
  function ApiPublishBeam() {
    this.pulse = 0;
  }
  ApiPublishBeam.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 188 || prg > 238) return;
    this.pulse = (prg - 188) / 50;
    var alpha = prg < 225 ? this.pulse : 1 - (prg - 225) / 13;
    ctx.strokeStyle = "rgba(121,242,255," + (alpha * 0.8) + ")";
    ctx.lineWidth = 2.5;
    ctx.setLineDash([4, 3]);
    ctx.beginPath();
    ctx.moveTo(82, 10);
    ctx.lineTo(155, -20);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle = "#79f2ff";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("API → WB", 118, -8);

    ctx.beginPath();
    ctx.moveTo(-82, 10);
    ctx.lineTo(-155, -20);
    ctx.strokeStyle = "rgba(147,197,253," + (alpha * 0.8) + ")";
    ctx.stroke();
    ctx.fillStyle = "#93c5fd";
    ctx.fillText("Import Ozon", -118, -8);
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
    var prg = (frame * 0.042) % 240;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -175, y: -35 },
      "2_seo": { x: -95, y: -48 },
      "3_coder": { x: 0, y: -52 },
      "4_designer": { x: 82, y: -48 },
      "5_deployer": { x: 0, y: 62 }
    };
    var tgt = targets[this.role] || { x: 0, y: 0 };

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
  var intake = new SkuIntakeTray();
  var river = new SemanticKeywordRiver();
  var carousel = new RichContentSlideCarousel();
  var forge = new TwinMarketplaceCardForge();
  var gate = new ComplianceCheckGate();
  var apiBeam = new ApiPublishBeam();

  entities.push(intake);
  entities.push(river);
  entities.push(forge);
  entities.push(carousel);
  entities.push(gate);
  entities.push(apiBeam);
  entities.push(new Agent(-155, 78, C.agentYellow, "1_architect", 18, [
    "Tone of voice бренда", "SKU из Google Sheets", "Шаблон категории WB"
  ]));
  entities.push(new Agent(-75, 82, C.agentGreen, "2_seo", 58, [
    "Ключ ai seo wb в начале", "LSI без дублей в названии", "Описание 2000+ символов"
  ]));
  entities.push(new Agent(5, 85, C.agentBlue, "3_coder", 98, [
    "Rich JSON для Ozon API", "POST content/v2/cards", "Версии A/B в Sheets"
  ]));
  entities.push(new Agent(78, 82, C.agentPink, "4_designer", 138, [
    "Слайды rich 1:1 от 1000px", "FAQ под возражения ниши", "CTR-блоки на обложке"
  ]));
  entities.push(new Agent(155, 78, C.agentPurple, "5_deployer", 178, [
    "Compliance перед upload", "Human review обязателен", "Пакет 12 карточек в WB"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 220, maxLife: life || 220 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.042) % 240;
    if (prg >= 16 && prg < 16.06) createBubble(-175, -55, "1. Фид SKU");
    if (prg >= 56 && prg < 56.06) createBubble(-95, -58, "2. Ключи WB/Ozon");
    if (prg >= 96 && prg < 96.06) createBubble(0, -62, "3. Rich + FAQ слои");
    if (prg >= 136 && prg < 136.06) createBubble(82, -58, "4. CTR-слайды");
    if (prg >= 176 && prg < 176.06) createBubble(0, 48, "5. Модерация → API");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var bx = bub.x;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2);
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
  'use strict';
  document.querySelectorAll('.akwo-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.akwo-faq-item');
      var open=item.classList.contains('open');
      document.querySelectorAll('.akwo-faq-item.open').forEach(function(el){el.classList.remove('open');el.querySelector('.akwo-faq-q').setAttribute('aria-expanded','false');});
      if(!open){item.classList.add('open');btn.setAttribute('aria-expanded','true');}
    });
    btn.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}});
  });
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

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

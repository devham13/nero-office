<?php
/**
 * Template Name: AI для клиник: запись, напоминания и поддержка пациентов под ключ
 * Description: SEO-лендинг — внедрение AI для клиники. Кейсы, МИС/CRM, цены. Аудит записей и звонков.
 */

$page_seo_title       = 'AI для клиники под ключ: запись, напоминания, поддержка пациентов';
$page_seo_description = 'Внедряем AI для клиники: запись, напоминания, поддержка пациентов и база знаний. Кейсы, МИС/CRM, цены от 250 тыс. ₽. Аудит записей и звонков бесплатно.';

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
    ['label' => '4 функции', 'href' => '#funkcii'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Автоматизировать клинику';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '';
$ad_banner_url       = getenv('AD_BANNER_URL') ?: '';
$ad_banner_image_url = getenv('AD_BANNER_IMAGE_URL') ?: '';
$ad_banner_alt       = getenv('AD_BANNER_ALT') ?: '';

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

.adk-hero-clinic{
  min-height:100vh;min-height:100dvh;position:relative;
}

.adk-content{
  --adk-bg:#050711;--adk-bg2:#080b17;
  --adk-text:#e6edf7;--adk-muted:#9aa8bd;--adk-soft:#c7d2e5;--adk-heading:#fff;
  --adk-border:rgba(255,255,255,.10);
  --adk-accent:#79f2ff;--adk-violet:#8b5cf6;--adk-green:#22c55e;--adk-amber:#f59e0b;
  --adk-btn-from:#2563eb;--adk-btn-to:#7c3aed;
  --adk-r:18px;--adk-r-lg:24px;--adk-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--adk-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.adk-content *,.adk-content *::before,.adk-content *::after{box-sizing:border-box;}
.adk-content a{color:inherit;text-decoration:none;}
.adk-content p{color:var(--adk-muted);line-height:1.72;margin:0 0 1em;}
.adk-content p:last-child{margin-bottom:0;}
.adk-content h2,.adk-content h3,.adk-content h4{color:var(--adk-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.adk-content strong{color:var(--adk-soft);}
.adk-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.adk-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--adk-muted);font-size:14.5px;line-height:1.65;}
.adk-content ul li::before{content:'›';position:absolute;left:0;color:var(--adk-accent);font-weight:700;}
.adk-cnt{width:min(var(--adk-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.adk-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.adk-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.adk-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.adk-sh.adk-left{margin-left:0;text-align:left;}
.adk-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.adk-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.adk-sh.adk-left p{margin-left:0;}
.adk-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--adk-accent);margin-bottom:14px;}
.adk-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.adk-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.adk-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.adk-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--adk-accent),var(--adk-violet));}
.adk-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--adk-muted);margin-bottom:1em;}
.adk-intro-text p:last-child{margin-bottom:0;color:var(--adk-soft);}
.adk-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.adk-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.adk-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--adk-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.adk-kpi-card .kl{font-size:11px;font-weight:600;color:var(--adk-muted);line-height:1.4;}
.adk-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.adk-intro-grid{grid-template-columns:1fr;gap:36px;}.adk-intro-kpi{grid-template-columns:repeat(3,1fr);}}
@media(max-width:600px){.adk-intro-kpi{grid-template-columns:1fr 1fr;}}
.adk-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.adk-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.adk-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid var(--adk-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--adk-muted);transition:border-color .2s,color .2s,background .2s;}
.adk-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--adk-accent);background:rgba(121,242,255,.08);}
.adk-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.adk-feature-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;margin-bottom:28px;}
.adk-feature-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--adk-r-lg);padding:26px;transition:border-color .22s,transform .22s;}
.adk-feature-card:hover{border-color:rgba(121,242,255,.3);transform:translateY(-2px);}
.adk-feature-card .adk-fc-icon{font-size:28px;margin-bottom:12px;}
.adk-feature-card h3{font-size:17px;margin-bottom:10px;}
.adk-feature-card p{font-size:14.5px;margin:0;}
.adk-pain-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-left:3px solid var(--adk-accent);border-radius:0 var(--adk-r) var(--adk-r) 0;padding:24px;}
.adk-pain-card h3{font-size:17px;margin-bottom:10px;}
.adk-pain-card p{font-size:14.5px;margin:0;}
.adk-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.adk-table{width:100%;border-collapse:collapse;font-size:14px;}
.adk-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--adk-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.adk-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--adk-text);vertical-align:top;}
.adk-table tr:last-child td{border-bottom:none;}
.adk-table tr:hover td{background:rgba(255,255,255,.03);}
.adk-timeline{position:relative;padding-left:40px;}
.adk-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--adk-accent),var(--adk-violet));opacity:.35;border-radius:2px;}
.adk-tl-item{position:relative;margin-bottom:32px;}
.adk-tl-item:last-child{margin-bottom:0;}
.adk-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--adk-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.adk-tl-item h3{font-size:17px;margin-bottom:8px;}
.adk-tl-item p{font-size:14.5px;margin:0;}
.adk-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.adk-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.adk-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.adk-source-badge{display:inline-block;padding:3px 9px;border-radius:6px;font-size:10px;font-weight:700;background:rgba(121,242,255,.1);color:var(--adk-accent);margin-bottom:10px;}
.adk-case-card h3{font-size:16px;margin-bottom:10px;}
.adk-case-card p{font-size:14px;margin:0;}
.adk-news-card{background:rgba(139,92,246,.08);border:1px solid rgba(139,92,246,.25);border-radius:var(--adk-r-lg);padding:28px;margin-bottom:24px;}
.adk-news-date{font-size:11px;font-weight:700;color:var(--adk-violet);letter-spacing:.08em;text-transform:uppercase;margin-bottom:8px;}
.adk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.adk-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.adk-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--adk-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.adk-faq-q::after{content:'▾';font-size:13px;color:var(--adk-accent);flex-shrink:0;transition:transform .25s;}
.adk-faq-item.open .adk-faq-q::after{transform:rotate(180deg);}
.adk-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--adk-muted);line-height:1.72;}
.adk-faq-item.open .adk-faq-a{max-height:600px;padding:0 24px 20px;}
.adk-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0;}
.adk-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--adk-muted);}
.adk-cta-checklist li::before{content:'✓';color:var(--adk-green);font-weight:800;}
.adk-price-highlight{font-size:clamp(24px,3vw,36px);font-weight:900;color:var(--adk-accent);margin:16px 0;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--primary{background:linear-gradient(135deg,rgba(121,242,255,.14),rgba(34,197,94,.08));border-color:rgba(121,242,255,.35);}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--adk-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--adk-btn-from),var(--adk-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--adk-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:960px){.adk-grid-3,.adk-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:768px){.adk-feature-grid,.adk-grid-3,.adk-case-grid{grid-template-columns:1fr;}}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>
<main id="primary" class="site-main nero-ai-home-page ai-dlya-klinik-page" role="main" tabindex="-1">

<section class="nero-ai-hero adk-hero-clinic" id="hero" aria-labelledby="adk-hero-title">
<style>
/* === ADK HERO: self-contained, scoped .adk-hero-clinic === */
.adk-hero-clinic {
  --adk-cyan: #79f2ff;
  --adk-green: #22c55e;
  --adk-violet: #8b5cf6;
  --adk-muted: #9aa8bd;
  position: relative;
  overflow: hidden;
}
.adk-hero-clinic .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1fr) minmax(0, 1.08fr);
  gap: clamp(28px, 4vw, 52px);
  align-items: center;
}
.adk-hero-clinic .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #fff 0%, var(--adk-cyan) 42%, var(--adk-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.adk-hero-clinic .nero-ai-hero-lead {
  font-size: clamp(16px, 1.8vw, 19px);
  line-height: 1.62;
  color: var(--adk-muted);
  max-width: 620px;
  margin: 0 0 22px;
}
.adk-hero-clinic .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 26px;
  padding: 0;
  list-style: none;
}
.adk-hero-clinic .nero-ai-badge {
  padding: 7px 13px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 700;
  color: #c7d2e5;
  background: rgba(121, 242, 255, 0.08);
  border: 1px solid rgba(121, 242, 255, 0.2);
}
.adk-hero-clinic .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}
.adk-hero-clinic .nero-ai-dashboard {
  padding: 14px;
  border-radius: 22px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  background: rgba(8, 12, 24, 0.82);
  box-shadow: 0 28px 72px rgba(0, 0, 0, 0.45);
}
.adk-hero-clinic .nero-ai-dashboard-shell {
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(15, 23, 42, 0.55);
}
.adk-hero-clinic .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.07);
  background: rgba(255, 255, 255, 0.03);
}
.adk-hero-clinic .nero-ai-dots { display: flex; gap: 6px; }
.adk-hero-clinic .nero-ai-dot {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(148, 163, 184, 0.35);
}
.adk-hero-clinic .nero-ai-window-title {
  font-size: 11px;
  font-weight: 600;
  color: #64748b;
  letter-spacing: 0.02em;
}
.adk-hero-clinic .nero-ai-window-body { padding: 14px; }
.adk-hero-clinic .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  margin-bottom: 12px;
}
.adk-hero-clinic .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 15px;
  font-weight: 800;
  color: #f8fafc;
  letter-spacing: -0.02em;
}
.adk-hero-clinic .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 4px 10px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.12);
  border: 1px solid rgba(34, 197, 94, 0.28);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
  text-transform: lowercase;
}
.adk-hero-clinic .nero-ai-live-pill::before {
  content: "";
  width: 7px; height: 7px;
  border-radius: 50%;
  background: var(--adk-green);
  box-shadow: 0 0 0 5px rgba(34, 197, 94, 0.14);
  animation: adkHeroPulse 1.6s infinite;
}
@keyframes adkHeroPulse {
  0%, 100% { transform: scale(0.86); opacity: 0.65; }
  50% { transform: scale(1); opacity: 1; }
}
.adk-hero-clinic .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 8px;
  margin-bottom: 10px;
}
.adk-hero-clinic .nero-ai-metric {
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.045);
}
.adk-hero-clinic .nero-ai-metric span {
  display: block;
  font-size: 10px;
  font-weight: 700;
  color: var(--adk-muted);
  text-transform: uppercase;
  letter-spacing: 0.06em;
}
.adk-hero-clinic .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  font-size: 20px;
  line-height: 1;
  color: #fff;
}
.adk-hero-clinic .nero-ai-metric small {
  display: block;
  margin-top: 3px;
  font-size: 10px;
  color: #7c8da6;
}
.adk-hero-clinic .adk-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 268px);
  margin: 0 0 10px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 35% 40%, rgba(121, 242, 255, 0.09), rgba(6, 10, 22, 0.94) 72%);
}
.adk-hero-clinic #adk-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.adk-hero-clinic .nero-ai-task-stream { display: grid; gap: 7px; }
.adk-hero-clinic .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 9px;
  padding: 9px 10px;
  border-radius: 13px;
  border: 1px solid rgba(255, 255, 255, 0.07);
  background: rgba(255, 255, 255, 0.035);
}
.adk-hero-clinic .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px; height: 28px;
  border-radius: 11px;
  background: rgba(121, 242, 255, 0.12);
  color: var(--adk-cyan);
  font-size: 10px;
  font-weight: 800;
}
.adk-hero-clinic .nero-ai-task strong {
  display: block;
  color: #f1f5f9;
  font-size: 11.5px;
}
.adk-hero-clinic .nero-ai-task span {
  color: var(--adk-muted);
  font-size: 10.5px;
}
.adk-hero-clinic .nero-ai-status {
  padding: 3px 8px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.12);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.adk-hero-clinic .nero-ai-status--cyan {
  background: rgba(121, 242, 255, 0.12);
  color: #c8fbff;
}
@media (max-width: 1100px) {
  .adk-hero-clinic .nero-ai-hero-grid { grid-template-columns: 1fr; }
}
@media (max-width: 520px) {
  .adk-hero-clinic .nero-ai-task { grid-template-columns: 28px 1fr; }
  .adk-hero-clinic .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai для клиники</p>
      <h1 id="adk-hero-title">AI для клиник: <span class="nero-ai-gradient-text">запись, напоминания и поддержка пациентов под ключ</span></h1>
      <p class="nero-ai-hero-lead">Снимаем нагрузку с администраторов — AI-агенты для записи, FAQ пациентов и внутренней базы знаний в частных клиниках и стоматологиях</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Запись 24/7</li>
        <li class="nero-ai-badge">Напоминания</li>
        <li class="nero-ai-badge">FAQ пациентов</li>
        <li class="nero-ai-badge">База знаний</li>
        <li class="nero-ai-badge">МИС/CRM</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Автоматизировать клинику</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#funkcii">4 функции AI</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо: AI-регистратура клиники">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">клиника · AI-администратор</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-регистратура онлайн</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Обращения</span><strong>47</strong><small>сегодня</small></div>
            <div class="nero-ai-metric"><span>No-show</span><strong>−25%</strong><small>после AI</small></div>
            <div class="nero-ai-metric"><span>Ответ</span><strong>8 сек</strong><small>первичный</small></div>
            <div class="nero-ai-metric"><span>МИС</span><strong>sync</strong><small>YCLIENTS</small></div>
          </div>

          <div class="adk-dash-canvas-wrap" aria-hidden="false">
            <canvas id="adk-hero-canvas" role="img" aria-label="Анимация: обращения из каналов проходят AI-маршрутизацию — запись, напоминание и подтверждение визита в МИС"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий регистратуры">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Запись к терапевту</strong><span>слот завтра 10:30</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Напоминание T-24ч</strong><span>пациент подтвердил</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">отправлено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">MIS</span>
              <div><strong>Слот подтверждён</strong><span>синхронизация YCLIENTS</span></div>
              <span class="nero-ai-status">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * adk-hero-engine — «Диспетчерская регистратуры клиники»
 * Мир: орбита каналов → triage-хаб → запись в МИС → напоминания → подтверждение визита
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("adk-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 240;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
    scale = Math.min(cw / 400, ch / 250) * 1.08;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    cyan: "#79f2ff",
    green: "#22c55e",
    violet: "#8b5cf6",
    amber: "#f59e0b",
    card: "rgba(255,255,255,0.08)",
    hubBg: "#0f172a",
    tokenTG: "#38bdf8",
    tokenWA: "#4ade80",
    tokenPH: "#a78bfa",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0b1220",
    bubbleText: "#e2e8f0"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Орбитальное кольцо каналов — вместо Conveyor */
  function ChannelStreamRing() {
    this.tokens = [
      { angle: 0, channel: "TG", color: C.tokenTG },
      { angle: 2.1, channel: "WA", color: C.tokenWA },
      { angle: 4.2, channel: "☎", color: C.tokenPH }
    ];
  }
  ChannelStreamRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var rx = 118, ry = 52;
    ctx.strokeStyle = "rgba(121,242,255,0.18)";
    ctx.lineWidth = 1.5;
    ctx.setLineDash([4, 6]);
    ctx.beginPath();
    ctx.ellipse(0, -8, rx, ry, 0, 0, Math.PI * 2);
    ctx.stroke();
    ctx.setLineDash([]);

    this.tokens.forEach(function (t, i) {
      var a = t.angle + frame * 0.018 + i * 0.4;
      var tx = Math.cos(a) * rx;
      var ty = -8 + Math.sin(a) * ry;
      drawRR(ctx, tx - 14, ty - 9, 28, 18, 5, t.color, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(t.channel, tx, ty + 3);
    });
  };

  /* Центральный экран пути пациента — вместо WebsiteTerminal */
  function PatientJourneyScreen() {
    this.tab = 0;
    this.confirmPop = 0;
  }
  PatientJourneyScreen.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -62, -72, 124, 138, 12, C.hubBg, C.cyan);

    ctx.fillStyle = C.cyan;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Путь пациента", -52, -58);

    var phases = ["Intake", "Запись", "T-24", "✓ Визит"];
    var active = prg < 55 ? 0 : prg < 110 ? 1 : prg < 175 ? 2 : 3;
    phases.forEach(function (p, i) {
      var px = -52 + i * 28;
      drawRR(ctx, px, -48, 24, 11, 3, i === active ? "rgba(121,242,255,0.22)" : C.card, C.outline);
      ctx.fillStyle = i === active ? C.cyan : "#94a3b8";
      ctx.font = "bold 5.5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(p, px + 12, -40);
    });

    if (prg >= 45) {
      drawRR(ctx, -50, -30, 100, 34, 6, "rgba(56,189,248,0.12)", C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Терапевт · завтра 10:30", -44, -14);
      ctx.fillStyle = "#94a3b8";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("первичный приём", -44, -6);
    }

    if (prg >= 115) {
      drawRR(ctx, -50, 8, 100, 22, 5, "rgba(34,197,94,0.14)", C.green);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Напоминание T-24 отправлено", 0, 22);
    }

    if (prg >= 185) {
      this.confirmPop = Math.min(1, (prg - 185) / 20);
      ctx.save();
      ctx.globalAlpha = this.confirmPop;
      drawRR(ctx, -38, 36, 76, 28, 8, "rgba(34,197,94,0.22)", C.green);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("✓ Визит подтверждён", 0, 54);
      ctx.restore();
    }
  };

  /* Башня напоминаний T-48 / T-24 / T-2 */
  function ReminderPulseTower() {
    this.pulse = 0;
  }
  ReminderPulseTower.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -148, -40, 22, 78, 5, "rgba(30,41,59,0.65)", C.outline);
    var bells = ["T-48", "T-24", "T-2"];
    bells.forEach(function (b, i) {
      var on = prg > 95 + i * 22;
      ctx.fillStyle = on ? C.green : "rgba(148,163,184,0.35)";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b, -137, -24 + i * 22);
      if (on && frame % 30 < 15) {
        ctx.strokeStyle = "rgba(34,197,94,0.45)";
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.arc(-137, -28 + i * 22, 10 + Math.sin(frame * 0.1) * 2, 0, Math.PI * 2);
        ctx.stroke();
      }
    });
  };

  /* Мост синхронизации МИС */
  function MisSyncBridge() {
    this.beam = 0;
  }
  MisSyncBridge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, 118, -28, 34, 56, 6, "rgba(15,23,42,0.7)", C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("МИС", 135, -16);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("YCLIENTS", 135, -6);

    if (prg >= 200 && prg < 252) {
      this.beam = (prg - 200) / 52;
      ctx.strokeStyle = "rgba(121,242,255," + (0.35 + this.beam * 0.5) + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([4, 3]);
      ctx.beginPath();
      ctx.moveTo(62, 10);
      ctx.lineTo(118, 0);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("sync", 90, 22);
    }
  };

  /* Сфера FAQ / базы знаний */
  function FaqKnowledgeOrb() {
    this.rot = 0;
  }
  FaqKnowledgeOrb.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    this.rot += 0.012;
    var oy = -92 + Math.sin(frame * 0.04) * 3;
    ctx.save();
    ctx.translate(0, oy);
    ctx.strokeStyle = "rgba(139,92,246,0.45)";
    ctx.lineWidth = 1.2;
    ctx.beginPath();
    ctx.arc(0, 0, 16, 0, Math.PI * 2);
    ctx.stroke();
    ctx.fillStyle = "rgba(139,92,246,0.18)";
    ctx.fill();
    ctx.fillStyle = C.violet;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("FAQ", 0, 3);
    if (prg > 60 && prg < 130) {
      ctx.fillStyle = "#ddd6fe";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("Подготовка к УЗИ?", -42, -6);
      ctx.fillText("График в воскресенье?", 48, 8);
    }
    ctx.restore();
  };

  /* Лампа эскалации на администратора */
  function EscalationLamp() {
    this.blink = 0;
  }
  EscalationLamp.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var hot = prg > 38 && prg < 52;
    drawRR(ctx, -18, 78, 36, 14, 4, hot ? "rgba(245,158,11,0.22)" : C.card, hot ? C.amber : C.outline);
    ctx.fillStyle = hot ? "#fde68a" : "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(hot ? "→ администратор" : "гибрид AI+чел.", 0, 88);
  };

  /* Дуга no-show */
  function NoShowGauge() {
    this.val = 0;
  }
  NoShowGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 210) return;
    this.val = Math.min(1, (prg - 210) / 25);
    ctx.strokeStyle = "rgba(34,197,94,0.25)";
    ctx.lineWidth = 4;
    ctx.beginPath();
    ctx.arc(130, 52, 18, Math.PI, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = C.green;
    ctx.beginPath();
    ctx.arc(130, 52, 18, Math.PI, Math.PI + Math.PI * this.val);
    ctx.stroke();
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("−25%", 130, 56);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "5px Inter,sans-serif";
    ctx.fillText("no-show", 130, 64);
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

    var hubTargets = {
      "1_architect": { x: -78, y: 42 },
      "2_seo": { x: -28, y: 50 },
      "3_coder": { x: 22, y: 50 },
      "4_designer": { x: 72, y: 42 },
      "5_deployer": { x: 0, y: 62 }
    };
    var tgt = hubTargets[this.role] || { x: 0, y: 48 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 16) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 16) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 16) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.4) * 1;
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 5.5;
      legL = Math.sin(wp) * 3.5;
      legR = Math.sin(wp + Math.PI) * 3.5;
    }
    drawRR(ctx, -7, -3 + Math.max(0, legL), 6, 11, 2, C.outline, null);
    drawRR(ctx, 1, -3 + Math.max(0, legR), 6, 11, 2, C.outline, null);
    drawRR(ctx, -11, -9 - bob, 22, 14, 4, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -20 - bob, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new ChannelStreamRing());
  entities.push(new ReminderPulseTower());
  entities.push(new FaqKnowledgeOrb());
  entities.push(new PatientJourneyScreen());
  entities.push(new MisSyncBridge());
  entities.push(new EscalationLamp());
  entities.push(new NoShowGauge());
  entities.push(new Agent(-120, 86, C.agentYellow, "1_architect", 18, [
    "Карта сценариев клиники", "Матрица AI / человек", "Аудит 50 звонков"
  ]));
  entities.push(new Agent(-60, 92, C.agentGreen, "2_seo", 62, [
    "FAQ: подготовка к УЗИ", "База знаний RAG", "Тон без диагностики"
  ]));
  entities.push(new Agent(0, 96, C.agentBlue, "3_coder", 108, [
    "API YCLIENTS · слоты", "book_appointment()", "152-ФЗ контур РФ"
  ]));
  entities.push(new Agent(60, 92, C.agentPink, "4_designer", 154, [
    "Диалог T-48→T-2", "Кнопки переноса", "UX подтверждения"
  ]));
  entities.push(new Agent(120, 86, C.agentPurple, "5_deployer", 202, [
    "Пилот 2–4 недели", "Sync МИС live", "No-show −25%"
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

    var prg = (frame * 0.042) % 260;
    if (prg >= 12 && prg < 12.05) createBubble(-95, -30, "1. Обращение из Telegram");
    if (prg >= 58 && prg < 58.05) createBubble(-20, -58, "2. AI уточняет врача и слот");
    if (prg >= 108 && prg < 108.05) createBubble(10, -18, "3. Запись в МИС");
    if (prg >= 158 && prg < 158.05) createBubble(-40, 10, "4. Цепочка напоминаний");
    if (prg >= 215 && prg < 215.05) createBubble(55, 30, "5. Пациент подтвердил визит");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 16, 5, C.bubbleBg, C.cyan);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
      ctx.fillText(b.text, b.x, b.y - 10);
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


<div class="adk-content">

  <section class="adk-intro" id="intro" aria-label="Введение">
    <div class="adk-cnt">
      <div class="adk-intro-grid nero-ai-reveal">
        <div class="adk-intro-text">
          <p class="adk-eyebrow">Лонгрид · медицина</p>
          <p><strong>Коротко:</strong> AI для клиники в коммерческом смысле — это операционный слой вокруг пациентского сервиса: запись 24/7, напоминания, ответы на типовые вопросы и внутренняя база знаний для администраторов. Это не диагностика и не замена врача. Nero Network внедряет такие AI-агенты под ключ — с интеграцией в МИС, соблюдением 152-ФЗ и гибридной моделью «робот + человек».</p>
          <p>Частная клиника, стоматология или медицинский центр живут в режиме постоянного потока: звонки, мессенджеры, переносы, no-show, одни и те же вопросы про подготовку к процедурам. Администраторы тонут в рутине — и именно здесь <strong>ai для клиники</strong> даёт измеримый эффект без риска для медицинской репутации.</p>
        </div>
        <div class="adk-intro-kpi" aria-label="Ключевые показатели">
          <div class="adk-kpi-card"><div class="kv">10–25%</div><div class="kl">no-show в частных клиниках</div><div class="ks">YCLIENTS / ProDoctorov</div></div>
          <div class="adk-kpi-card"><div class="kv">70%</div><div class="kl">рутины у операторов</div><div class="ks">кейс «Доктор Плюс»</div></div>
          <div class="adk-kpi-card"><div class="kv">44%</div><div class="kl">обращений без оператора</div><div class="ks">«Доктор Плюс», 2025</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="adk-toc-outer">
    <div class="adk-cnt">
      <nav class="adk-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#problema">Проблема</a>
        <a href="#funkcii">4 функции</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#integracii">МИС / CRM</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="adk-section" id="problema" aria-labelledby="problema-h2">
    <div class="adk-cnt">
      <div class="adk-sh adk-left nero-ai-reveal">
        <span class="adk-eyebrow">Боль регистратуры</span>
        <h2 id="problema-h2">Почему администраторы клиник не справляются с потоком пациентов</h2>
        <p><strong>Определение проблемы:</strong> перегруз регистратуры — не «лень персонала», а структурный разрыв между объёмом обращений и возможностями ручной обработки. Средний <strong>no-show в частных клиниках РФ — 10–25%</strong>, в крупных городах — <strong>18–20%</strong> (YCLIENTS / ProDoctorov, 2023).</p>
      </div>
      <div class="adk-grid-3 nero-ai-reveal">
        <div class="adk-pain-card">
          <h3>Перегруз записью и повторными звонками</h3>
          <p>В пиковые часы на линии одновременно: запись, перенос, отмена, вопрос о стоимости. По кейсу «Доктор Плюс» (CNews, 03.03.2026), до <strong>70% времени операторов</strong> уходило на типовые запросы. Пропущенный звонок после 18:00 редко возвращается.</p>
        </div>
        <div class="adk-pain-card nero-ai-delay-1">
          <h3>No-show и ручные напоминания</h3>
          <p>SMS-напоминания дают лишь <strong>5–10%</strong> улучшения явки. В сети «Красивая улыбка» до внедрения AI <strong>68% записей</strong> заканчивались неявкой. Многоступенчатые касания T-48 → T-24 → T-2 работают как диалог.</p>
        </div>
        <div class="adk-pain-card nero-ai-delay-2">
          <h3>Одни и те же вопросы каждый день</h3>
          <p>«Как подготовиться к УЗИ?», «Работаете ли в воскресенье?», «Принимаете ли ДМС?» — десятки повторов ежедневно. Без AI база знаний остаётся PDF в общей папке.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:28px;max-width:820px;">Без автоматизации клиника платит зарплатой 2–3 смен регистраторов и теряет выручку на no-show и ночных заявках. <strong>Ai для клиники</strong> закрывает рутину, оставляя людям жалобы, страховые кейсы и всё, что требует эмпатии.</p>
    </div>
  </section>

  <section class="adk-section adk-section-alt" id="funkcii" aria-labelledby="funkcii-h2">
    <div class="adk-cnt">
      <div class="adk-sh nero-ai-reveal">
        <span class="adk-eyebrow">4 модуля</span>
        <h2 id="funkcii-h2">Что автоматизирует AI для клиники: 4 функции под ключ</h2>
        <p>Коммерческий <strong>ai для клиники под ключ</strong> — это LLM-агент + middleware + интеграция с МИС/CRM + каналы связи. Агент ведёт диалог, вызывает функции (<code>book_appointment</code>, <code>cancel_booking</code>), эскалирует «красные флаги» на человека.</p>
      </div>
      <div class="adk-feature-grid nero-ai-reveal">
        <div class="adk-feature-card">
          <div class="adk-fc-icon" aria-hidden="true">📅</div>
          <h3>Запись на визит 24/7</h3>
          <p>Сайт, Telegram, WhatsApp, VK, голосовая линия. Агент подбирает врача, услугу и слот, проверяет МИС в реальном времени. По кейсу NELFT (NHS), <strong>42–45% активности</strong> — вне рабочих часов 9–17.</p>
        </div>
        <div class="adk-feature-card nero-ai-delay-1">
          <div class="adk-fc-icon" aria-hidden="true">🔔</div>
          <h3>Напоминания о визитах</h3>
          <p>Цепочка T-48ч → T-24ч → T-2ч с кнопками «подтверждаю», «перенести», «отменить». В кейсе NELFT неявки снизились на <strong>25%</strong>; «Красивая улыбка» — рост явки на <strong>44%</strong> за 3 месяца.</p>
        </div>
        <div class="adk-feature-card nero-ai-delay-1">
          <div class="adk-fc-icon" aria-hidden="true">💬</div>
          <h3>Поддержка пациентов и FAQ</h3>
          <p><strong>Ai администратор клиники</strong> понимает естественную речь, отвечает из базы знаний. «Доктор Плюс»: <strong>44% обращений</strong> обработаны ИИ автономно, SL <strong>+15%</strong>, пропущенные звонки <strong>−8%</strong>.</p>
        </div>
        <div class="adk-feature-card nero-ai-delay-2">
          <div class="adk-fc-icon" aria-hidden="true">📚</div>
          <h3>База знаний для администраторов</h3>
          <p>RAG-слой для персонала: скрипты, регламенты, прайс. «Будь Здоров» + CallForce: <strong>58% обращений</strong> конвертированы в запись на приём.</p>
        </div>
      </div>
      <div class="adk-table-wrap nero-ai-reveal">
        <table class="adk-table">
          <thead><tr><th>Формат</th><th>Плюсы</th><th>Минусы</th><th>Когда подходит</th></tr></thead>
          <tbody>
            <tr><td>Rule-based чат-бот</td><td>Дёшев, предсказуем</td><td>Ломается на вариациях фраз</td><td>3–5 жёстких сценариев</td></tr>
            <tr><td>LLM-агент (текст)</td><td>Диалог, FAQ, запись в МИС</td><td>Нужна интеграция и compliance</td><td>Клиники с 10+ услугами</td></tr>
            <tr><td>Голосовой AI</td><td>Закрывает телефон 24/7</td><td>Выше порог внедрения</td><td>Высокий поток звонков, как у «МЕДСИ»</td></tr>
            <tr><td>Гибрид AI + оператор</td><td>Лучший UX, меньше рисков</td><td>Требует матрицы эскалаций</td><td>Средний и крупный бизнес</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

<!-- ================================================
     БОРИС: после #funkcii, перед #vnedrenie
     ================================================ -->
<section id="ai-dlya-klinik-boris-block" class="adkb-root" aria-label="Анимация: путь обращения пациента от канала через AI-агента в МИС и цепочку напоминаний">
<style>
/* === БОРИС: prefix adkb-, scoped внутри #ai-dlya-klinik-boris-block === */
#ai-dlya-klinik-boris-block.adkb-root{
  padding:56px 0 64px;
  background:linear-gradient(180deg,rgba(121,242,255,.04) 0%,transparent 100%);
}
#ai-dlya-klinik-boris-block .adkb-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-dlya-klinik-boris-block .adkb-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 44px rgba(15,23,42,.09),0 0 0 1px rgba(121,242,255,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-dlya-klinik-boris-block .adkb-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-dlya-klinik-boris-block .adkb-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e8f4f8;
}
@media(max-width:1023px){
  #ai-dlya-klinik-boris-block .adkb-lft{
    border-right:none;
    border-bottom:1px solid #e8f4f8;
    padding:32px 24px;
  }
}
#ai-dlya-klinik-boris-block .adkb-ey{
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
#ai-dlya-klinik-boris-block .adkb-ey::before{
  content:'';
  width:18px;height:2px;
  background:#79f2ff;
  border-radius:1px;
}
#ai-dlya-klinik-boris-block .adkb-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-dlya-klinik-boris-block .adkb-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-dlya-klinik-boris-block .adkb-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-dlya-klinik-boris-block .adkb-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(121,242,255,.15);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0e7490;
  margin-top:1px;
  font-style:normal;
}
#ai-dlya-klinik-boris-block .adkb-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-dlya-klinik-boris-block .adkb-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-dlya-klinik-boris-block .adkb-pl-c{
  background:rgba(121,242,255,.1);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.35);
}
#ai-dlya-klinik-boris-block .adkb-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-dlya-klinik-boris-block .adkb-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-dlya-klinik-boris-block .adkb-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-dlya-klinik-boris-block .adkb-rgt{
  position:relative;
  background:linear-gradient(145deg,#f0fdff 0%,#e0f7fa 35%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-dlya-klinik-boris-block .adkb-rgt{min-height:380px;}
}
#adkb-clinic-flow-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="adkb-cnt">
  <div class="adkb-card">

    <div class="adkb-lft">
      <span class="adkb-ey">Поток пациента · live</span>
      <h3 class="adkb-h3">Одно обращение — от мессенджера до слота в МИС и цепочки напоминаний</h3>
      <ul class="adkb-ul">
        <li><span class="adkb-ic">1</span>Пациент пишет в Telegram, WhatsApp или звонит — AI принимает 24/7</li>
        <li><span class="adkb-ic">2</span>Агент уточняет услугу, врача и проверяет слоты в YCLIENTS / Медиалог в реальном времени</li>
        <li><span class="adkb-ic">3</span>Запись создаётся в МИС; пациент получает подтверждение в том же канале</li>
        <li><span class="adkb-ic">↻</span>T-48 → T-24 → T-2: диалоговые напоминания с кнопками «подтвердить / перенести»</li>
      </ul>
      <div class="adkb-pills">
        <span class="adkb-pl adkb-pl-c">8 сек ответ</span>
        <span class="adkb-pl adkb-pl-g">−25% no-show</span>
        <span class="adkb-pl adkb-pl-v">МИС sync</span>
      </div>
      <p class="adkb-foot">Дальше — этапы внедрения AI для клиники под ключ →</p>
    </div>

    <div class="adkb-rgt">
      <canvas
        id="adkb-clinic-flow-canvas"
        aria-label="Анимация: обращение пациента проходит через каналы связи, AI-агент и попадает в расписание МИС с напоминаниями"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('adkb-clinic-flow-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 440;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    cyan:'#79f2ff', cyanD:function(a){return 'rgba(121,242,255,'+a+')';},
    green:'#22c55e', greenD:function(a){return 'rgba(34,197,94,'+a+')';},
    viol:'#8b5cf6', violD:function(a){return 'rgba(139,92,246,'+a+')';},
    slate:'#0f172a', muted:'#64748b',
    card:'rgba(255,255,255,.92)', cardBdr:'rgba(15,23,42,.08)',
    line:'rgba(15,23,42,.12)'
  };

  var CHANNELS = [
    {label:'Telegram', icon:'TG', color:C.cyan, yOff:0},
    {label:'WhatsApp', icon:'WA', color:'#25d366', yOff:1},
    {label:'Телефон', icon:'☎', color:C.viol, yOff:2}
  ];

  var tokens = [];
  var LOOP = 680;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect){ctx.roundRect(x,y,w,h,r);}
    else{
      ctx.moveTo(x+r,y);ctx.arcTo(x+w,y,x+w,y+h,r);
      ctx.arcTo(x+w,y+h,x,y+h,r);ctx.arcTo(x,y+h,x,y,r);
      ctx.arcTo(x,y,x+w,y,r);ctx.closePath();
    }
    if(fill){ctx.fillStyle=fill;ctx.fill();}
    if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke();}
  }

  function spawnToken(chIdx){
    var ch = CHANNELS[chIdx];
    var sx = W * 0.08;
    var sy = H * (0.28 + ch.yOff * 0.14);
    tokens.push({
      ch:chIdx, x:sx, y:sy, phase:0,
      label:['Запись','FAQ','Перенос'][Math.floor(Math.random()*3)],
      born:frame
    });
  }

  if(frame === 0){
    spawnToken(0); spawnToken(1);
  }

  function drawHub(cx, cy, r){
    var pulse = 0.5 + 0.5 * Math.sin(frame * 0.06);
    ctx.beginPath();
    ctx.arc(cx, cy, r + 8 + pulse * 4, 0, Math.PI * 2);
    ctx.fillStyle = C.cyanD(0.12 + pulse * 0.08);
    ctx.fill();
    rr(cx - r, cy - r, r * 2, r * 2, 16, C.card, C.cyan, 2);
    ctx.fillStyle = C.slate;
    ctx.font = 'bold 13px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI-агент', cx, cy - 6);
    ctx.font = '11px Inter,system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('клиника', cx, cy + 12);
  }

  function drawMIS(rx, ry, rw, rh){
    rr(rx, ry, rw, rh, 14, C.card, C.green, 1.5);
    ctx.fillStyle = C.slate;
    ctx.font = 'bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('YCLIENTS · расписание', rx + 14, ry + 22);
    var slots = ['09:00 терапевт','11:30 УЗИ','14:00 стоматолог','16:30 анализы'];
    for(var i = 0; i < 4; i++){
      var sy = ry + 38 + i * 36;
      var active = (frame + i * 90) % LOOP < 120;
      rr(rx + 10, sy, rw - 20, 28, 8,
        active ? C.greenD(0.15) : 'rgba(248,250,252,.9)',
        active ? C.green : C.line, 1);
      ctx.fillStyle = active ? '#15803d' : C.muted;
      ctx.font = '11px Inter,system-ui,sans-serif';
      ctx.fillText(slots[i], rx + 18, sy + 18);
      if(active){
        ctx.fillStyle = C.green;
        ctx.font = 'bold 10px Inter,system-ui,sans-serif';
        ctx.fillText('✓', rx + rw - 22, sy + 18);
      }
    }
  }

  function drawReminders(bx, by){
    var steps = ['T-48ч','T-24ч','T-2ч'];
    for(var i = 0; i < 3; i++){
      var alpha = 0.4 + 0.6 * Math.max(0, Math.sin((frame - i * 40) * 0.05));
      var rx = bx + i * 52;
      rr(rx, by, 46, 22, 11, C.violD(alpha * 0.2), C.viol, 1);
      ctx.fillStyle = '#6d28d9';
      ctx.font = 'bold 9px Inter,system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.globalAlpha = alpha;
      ctx.fillText(steps[i], rx + 23, by + 14);
      ctx.globalAlpha = 1;
    }
  }

  function drawChannel(ch, x, y, w, h){
    rr(x, y, w, h, 12, C.card, ch.color, 1.5);
    ctx.fillStyle = ch.color;
    ctx.font = 'bold 14px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(ch.icon, x + w/2, y + h/2 - 4);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,system-ui,sans-serif';
    ctx.fillText(ch.label, x + w/2, y + h + 14);
  }

  function drawFlowLines(hubX, hubY){
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([4, 6]);
    CHANNELS.forEach(function(ch, i){
      var sy = H * (0.28 + ch.yOff * 0.14) + 20;
      ctx.beginPath();
      ctx.moveTo(W * 0.08 + 56, sy);
      ctx.bezierCurveTo(W * 0.25, sy, W * 0.32, hubY, hubX - 40, hubY);
      ctx.stroke();
    });
    ctx.setLineDash([]);
    ctx.beginPath();
    ctx.moveTo(hubX + 40, hubY);
    ctx.bezierCurveTo(W * 0.62, hubY, W * 0.68, H * 0.35, W * 0.72, H * 0.32);
    ctx.strokeStyle = C.greenD(0.5);
    ctx.stroke();
  }

  function tick(){
    frame++;
    if(frame % 95 === 0) spawnToken(Math.floor(Math.random() * 3));
    if(frame % 140 === 70) spawnToken(2);

    ctx.clearRect(0, 0, W, H);

    var hubX = W * 0.48, hubY = H * 0.48;
    var misX = W * 0.72, misY = H * 0.18, misW = W * 0.22, misH = H * 0.55;

    drawFlowLines(hubX, hubY);

    CHANNELS.forEach(function(ch, i){
      drawChannel(ch, W * 0.04, H * (0.22 + ch.yOff * 0.14), 52, 40);
    });

    drawHub(hubX, hubY, 44);
    drawMIS(misX, misY, Math.min(misW, 160), misH);
    drawReminders(misX, misY + misH + 12);

    tokens.forEach(function(t){
      var age = frame - t.born;
      var progress = Math.min(1, age / 200);
      var ch = CHANNELS[t.ch];
      var startX = W * 0.08 + 26;
      var startY = H * (0.28 + ch.yOff * 0.14);
      var midX = hubX, midY = hubY;
      var endX = misX + 40, endY = misY + 60;

      if(progress < 0.45){
        var p = progress / 0.45;
        t.x = startX + (midX - startX) * p;
        t.y = startY + (midY - startY) * p;
        t.phase = 0;
      } else if(progress < 0.85){
        var p2 = (progress - 0.45) / 0.4;
        t.x = midX + (endX - midX) * p2;
        t.y = midY + (endY - midY) * p2;
        t.phase = 1;
      } else {
        t.phase = 2;
        t.x = endX + Math.sin(frame * 0.08) * 3;
        t.y = endY;
      }

      var col = t.phase === 2 ? C.green : ch.color;
      ctx.beginPath();
      ctx.arc(t.x, t.y, 7, 0, Math.PI * 2);
      ctx.fillStyle = col;
      ctx.fill();
      ctx.strokeStyle = '#fff';
      ctx.lineWidth = 2;
      ctx.stroke();

      if(t.phase === 1 && age % 30 < 15){
        ctx.fillStyle = C.slate;
        ctx.font = '9px Inter,system-ui,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText(t.label, t.x, t.y - 12);
      }
    });

    tokens = tokens.filter(function(t){ return frame - t.born < 260; });

    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('каналы 24/7', W * 0.04, H * 0.12);
    ctx.textAlign = 'right';
    ctx.fillText('напоминания', misX + misW, H * 0.92);

    requestAnimationFrame(tick);
  }

  requestAnimationFrame(tick);
})();
</script>
</section>


  <section class="adk-section" id="vnedrenie" aria-labelledby="vnedrenie-h2">
    <div class="adk-cnt">
      <div class="adk-sh nero-ai-reveal">
        <span class="adk-eyebrow">Под ключ</span>
        <h2 id="vnedrenie-h2">Внедрение AI для клиники под ключ: этапы и аудит</h2>
        <p><strong>Внедрение ai для клиники</strong> в Nero Network — проект на <strong>2–6 недель</strong> от аудита до пилота. <strong>Ai для клиники без программиста</strong> на стороне клиники — нормальная модель, если подрядчик берёт интеграцию и сопровождение.</p>
      </div>
      <div class="adk-timeline nero-ai-reveal">
        <div class="adk-tl-item"><div class="adk-tl-dot"></div><h3>Аудит записей и звонков (лид-магнит)</h3><p>50–100 диалогов, карта типовых vs сложных обращений, доля no-show, пики нагрузки. Результат — обоснованная карта: что автоматизировать в первую очередь и какой ROI реалистичен.</p></div>
        <div class="adk-tl-item"><div class="adk-tl-dot"></div><h3>Диагностика процессов и карта сценариев</h3><p>Запись, перенос, отмена, FAQ, напоминания, лист ожидания. Матрица «AI / человек» и red flags: жалобы, симптомы, экстренные состояния. Любой медицинский вопрос — эскалация.</p></div>
        <div class="adk-tl-item"><div class="adk-tl-dot"></div><h3>Пилот → масштабирование → сопровождение</h3><p>Пилот <strong>2–4 недели</strong> на одном канале. Метрики: конверсия в запись, no-show, время ответа, доля эскалаций.<?php if ($secondary_cta_url) : ?> После пилота команда проходит <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link--accent"<?php echo nero_ai_external_link_attrs($secondary_cta_url); ?>>обучение работе с AI-агентом</a>.<?php endif; ?></p></div>
        <div class="adk-tl-item"><div class="adk-tl-dot"></div><h3>Под ключ или самостоятельно</h3><p>Для клиники с no-show 15%+ кастомное <strong>внедрение ai для клиники под ключ</strong> окупается быстрее шаблонного бота без интеграции в расписание.</p></div>
      </div>
      <div class="adk-table-wrap nero-ai-reveal">
        <table class="adk-table">
          <thead><tr><th>Критерий</th><th>Под ключ (Nero Network)</th><th>Самостоятельно (SaaS-бот)</th></tr></thead>
          <tbody>
            <tr><td>Интеграция с МИС</td><td>Кастом middleware, несколько систем</td><td>Часто 1–2 шаблона</td></tr>
            <tr><td>Compliance 152-ФЗ</td><td>Серверы в РФ, аудит формулировок</td><td>Зависит от вендора</td></tr>
            <tr><td>Голос + текст</td><td>Единая логика сценариев</td><td>Обычно только чат</td></tr>
            <tr><td>Срок</td><td>2–6 недель до пилота</td><td>3–7 дней, но поверхностно</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <div class="adk-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-vnedrenie">
      <div class="ym-cta-block__icon" aria-hidden="true">🏥</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Начните с аудита записей и звонков</p>
        <p class="ym-cta-block__sub">Разберём 50–100 диалогов вашей регистратуры, оценим no-show и покажем, что автоматизировать в первую очередь. Бесплатно, за 2–3 рабочих дня.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Заказать аудит записей и звонков</a>
      </div>
    </div>
  </div>

  <section class="adk-section adk-section-alt" id="integracii" aria-labelledby="integracii-h2">
    <div class="adk-cnt">
      <div class="adk-sh adk-left nero-ai-reveal">
        <span class="adk-eyebrow">Интеграции</span>
        <h2 id="integracii-h2">Интеграция с МИС, CRM и телефонией</h2>
        <p>Без связи с расписанием AI превращается в FAQ-виджет. <strong>Интеграция ai для клиники</strong> — ядро проекта: middleware между каналами и МИС.</p>
      </div>
      <div class="adk-table-wrap nero-ai-reveal">
        <table class="adk-table">
          <thead><tr><th>МИС</th><th>Способ подключения</th><th>Кто заявляет интеграцию</th></tr></thead>
          <tbody>
            <tr><td>YCLIENTS</td><td>REST API, функции записи</td><td>NextBot, BotHelp, PapAI</td></tr>
            <tr><td>Инфоклиника</td><td>API</td><td>Chatme, Flow Masters, BotHelp</td></tr>
            <tr><td>Медиалог</td><td>API / модули</td><td>Chatme (кейс Юсуповской)</td></tr>
            <tr><td>1С:Медицина</td><td>REST API</td><td>Noltis, Bothost, PapAI</td></tr>
            <tr><td>Medesk, IDENT, Renovatio</td><td>Штатные API</td><td>Noltis, отраслевые интеграторы</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">Кейс Юсуповской больницы + Chatme.ai + МИС «Медиалог»: NLU-бот в WhatsApp — <strong>снижение нагрузки на администраторов до 72%</strong>. Запрос <strong>ai для клиники с CRM</strong> закрывается единым контуром: лид из чата → запись в МИС → напоминание → аналитика.</p>
      <p class="nero-ai-reveal" style="margin-top:20px;font-size:15px">Если часть обращений пациентов приходит по email или из форм на сайте, а не только в мессенджеры, логика та же: <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--adk-accent);text-decoration:underline;text-underline-offset:3px">AI-обработка входящей почты в CRM под ключ</a> — классификация, извлечение полей и маршрутизация заявки до записи в расписание.</p>
      <p class="nero-ai-reveal" style="margin-top:14px;font-size:15px">Для клиник на amoCRM или Битрикс24 как витрине лидов до МИС уместен сценарий <a href="/vnedrenie-ai-amocrm/" style="color:var(--adk-accent);text-decoration:underline;text-underline-offset:3px">внедрения AI-агента в amoCRM</a>: единый контур «обращение → сделка → задача администратора» без ручного переноса данных.</p>
      <p class="nero-ai-reveal" style="margin-top:14px;font-size:15px">Учётный контур на <strong>1С:Медицина</strong> из таблицы выше дополняется операционным AI: см. <a href="/ai-1c-erp/" style="color:var(--adk-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP под ключ</a> — синхронизация заказов, ДМС и складских операций без двойного ввода.</p>
      <p class="nero-ai-reveal" style="margin-top:14px;font-size:15px">На корпоративном масштабе те же принципы triage и маршрутизации подтверждаются публичными кейсами: в разборе <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--adk-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude — уроки AI для бизнеса</a> показаны managed-агенты и шлюзы, которые можно адаптировать к потокам регистратуры клиники.</p>
    </div>
  </section>

  <section class="adk-section" id="niche" aria-labelledby="niche-h2">
    <div class="adk-cnt">
      <div class="adk-sh nero-ai-reveal"><h2 id="niche-h2">AI для частных клиник, стоматологий и медцентров</h2></div>
      <div class="adk-grid-3 nero-ai-reveal">
        <div class="adk-feature-card"><h3>Частные клиники и медцентры</h3><p>Много специалистов, ДМС, сложная маршрутизация. Референс — «МЕДСИ» + голосовой ИИ SL Soft: <strong>3,5+ млн звонков в год</strong> дополнительно автоматизировано.</p></div>
        <div class="adk-feature-card nero-ai-delay-1"><h3>Стоматологии</h3><p>Главный KPI — <strong>явка</strong>. «Красивая улыбка», 6 филиалов: явка <strong>+44%</strong>, <strong>−78%</strong> нагрузки на обзвон.</p></div>
        <div class="adk-feature-card nero-ai-delay-2"><h3>Малый и средний бизнес</h3><p>Чек Nero Network <strong>250 тыс.–2 млн ₽</strong>. Пилот за 2–3 недели на Telegram + одна МИС.</p></div>
      </div>
    </div>
  </section>

  <section class="adk-section adk-section-alt" id="bezopasnost" aria-labelledby="bezopasnost-h2">
    <div class="adk-cnt">
      <div class="adk-sh adk-left nero-ai-reveal">
        <h2 id="bezopasnost-h2">Безопасность, 152-ФЗ и границы AI в медицине</h2>
        <p>Nero Network внедряет <strong>операционный AI</strong> — запись, напоминания, FAQ. <strong>Искусственный интеллект в клинике</strong> для пациентского сервиса не ставит диагнозов.</p>
      </div>
      <div class="adk-table-wrap nero-ai-reveal">
        <table class="adk-table">
          <thead><tr><th>AI может</th><th>AI не может</th></tr></thead>
          <tbody>
            <tr><td>Записать, перенести, отменить визит</td><td>Интерпретировать симптомы</td></tr>
            <tr><td>Ответить на FAQ из базы знаний</td><td>Ставить диагноз, назначать лечение</td></tr>
            <tr><td>Напомнить о визите, собрать подтверждение</td><td>Комментировать результаты анализов</td></tr>
            <tr><td>Эскалировать с полным контекстом</td><td>Заменить врачебную консультацию</td></tr>
          </tbody>
        </table>
      </div>
      <ul class="nero-ai-reveal" style="margin-top:20px;max-width:820px;">
        <li><strong>152-ФЗ, ст. 18:</strong> первичная обработка ПДн — на серверах в РФ.</li>
        <li><strong>323-ФЗ:</strong> врачебная тайна; бот — транспорт сообщений, не архив истории болезни.</li>
        <li style="color:var(--adk-amber);">Штрафы после поправок 2025: до <strong>700 тыс. ₽</strong> за неправомерную обработку; утечки спецкатегорий — до <strong>15 млн ₽</strong>.</li>
      </ul>
    </div>
  </section>

  <section class="adk-section" id="trend-2026" aria-labelledby="trend-h2">
    <div class="adk-cnt">
      <div class="adk-sh adk-left nero-ai-reveal">
        <h2 id="trend-h2">Тренд 2026: enterprise AI-агенты в операциях бизнеса</h2>
      </div>
      <div class="adk-news-card nero-ai-reveal">
        <div class="adk-news-date">Июнь 2026 · Meta Business Agent</div>
        <p>В июне 2026 Meta запустила <strong>Business Agent</strong> — AI-агент в WhatsApp, Messenger и Instagram с функциями <strong>book appointments</strong>, квалификации лидов и эскалации на человека. Более <strong>1 млн бизнесов</strong> уже используют Business Agent.</p>
        <p>Для клиники в РФ нужен свой контур: российские модели, middleware, МИС — западный SaaS не закрывает 152-ФЗ и YCLIENTS.</p>
      </div>
      <div class="adk-table-wrap nero-ai-reveal">
        <table class="adk-table">
          <thead><tr><th>Параметр</th><th>Rule-based бот 2020-х</th><th>LLM-агент 2026</th></tr></thead>
          <tbody>
            <tr><td>Понимание фраз</td><td>Только кнопки и ключевые слова</td><td>Естественная речь, контекст</td></tr>
            <tr><td>Запись в МИС</td><td>Редко или через оператора</td><td>API в реальном времени</td></tr>
            <tr><td>Напоминания</td><td>Одно SMS</td><td>Диалог с переносом</td></tr>
            <tr><td>Эскалация</td><td>«Позвоните нам»</td><td>Контекст диалога оператору</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="adk-section adk-section-alt" id="keisy" aria-labelledby="keisy-h2">
    <div class="adk-cnt">
      <div class="adk-sh nero-ai-reveal">
        <h2 id="keisy-h2">Кейсы и примеры внедрения AI в клиниках</h2>
        <p><strong>Ai для клиники кейсы</strong> из проверенных источников. Тип источника указан для прозрачности.</p>
      </div>
      <div class="adk-case-grid nero-ai-reveal">
        <div class="adk-case-card"><span class="adk-source-badge">CNews · РБК</span><h3>«Доктор Плюс» + targetai</h3><p>SL <strong>+15%</strong>, пропущенные звонки <strong>−8%</strong>, до <strong>44%</strong> обращений обработано ИИ автономно за 6 месяцев.</p></div>
        <div class="adk-case-card"><span class="adk-source-badge">РБК</span><h3>«МЕДСИ» + SL Soft</h3><p>Голосовой ИИ: запись, ДМС, стоимость, маршрутизация. Агент в КЦ более 5 лет.</p></div>
        <div class="adk-case-card"><span class="adk-source-badge">Сайт клиники</span><h3>«Будь Здоров» + CallForce</h3><p>Речевая аналитика 100% звонков; <strong>58%</strong> обращений конвертированы в запись.</p></div>
        <div class="adk-case-card"><span class="adk-source-badge">Интегратор</span><h3>Юсуповская + Медиалог</h3><p>WhatsApp-бот с API Медиалог; нагрузка на администраторов <strong>−72%</strong>.</p></div>
        <div class="adk-case-card"><span class="adk-source-badge">vc.ru ⚠️</span><h3>«Красивая улыбка»</h3><p>Явка <strong>+44%</strong> за 3 месяца, <strong>−78%</strong> обзвона. Независимый аудит не публиковался.</p></div>
        <div class="adk-case-card"><span class="adk-source-badge">РБК</span><h3>ИИ «Доктор Жест»</h3><p>Сопровождение приёма в <strong>74 клиниках</strong>, <strong>500 000</strong> сопровождённых приёмов. Не диагностирует.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;">Максимальный эффект там, где AI связан с расписанием и работает в гибриде с операторами.</p>
    </div>
  </section>

  <div class="adk-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-keisy">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите таких же результатов в своей клинике?</p>
        <p class="ym-cta-block__sub">−72% нагрузки на администраторов, +44% явки, 44% обращений без оператора — реальные кейсы. Следующим может стать ваш медцентр.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Автоматизировать клинику</a>
          <a href="#vnedrenie" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
        </div>
      </div>
    </div>
  </div>

  <section class="adk-section" id="ceny" aria-labelledby="ceny-h2">
    <div class="adk-cnt">
      <div class="adk-sh nero-ai-reveal">
        <h2 id="ceny-h2">Стоимость внедрения AI для клиники</h2>
        <p class="adk-price-highlight">250 тыс.–2 млн ₽</p>
        <p>Типовой проект Nero Network: аудит, сценарии, middleware + МИС, AI-агент, напоминания, RAG-база, пилот, compliance, обучение.</p>
      </div>
      <div class="adk-table-wrap nero-ai-reveal">
        <table class="adk-table">
          <thead><tr><th>Фактор</th><th>Влияние на бюджет</th></tr></thead>
          <tbody>
            <tr><td>1 канал (Telegram) vs омниканал</td><td>×1,5–2,5</td></tr>
            <tr><td>Текст vs голосовой AI</td><td>+30–80%</td></tr>
            <tr><td>Количество МИС / филиалов</td><td>+интеграционные часы</td></tr>
            <tr><td>Self-hosted LLM в контуре</td><td>+инфраструктура, −риск compliance</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">Пример ROI: при 20 записях/день, чеке 5 000 ₽ и снижении no-show с 20% до 14% — <strong>~180 000 ₽/мес.</strong> сохранённой выручки. Для точного расчёта нужен аудит.</p>
    </div>
  </section>

  <section class="adk-section adk-section-alt" id="faq" aria-labelledby="faq-h2">
    <div class="adk-cnt">
      <div class="adk-sh nero-ai-reveal"><h2 id="faq-h2">FAQ — внедрение AI для клиники</h2></div>
      <div class="adk-faq nero-ai-reveal" itemscope itemtype="https://schema.org/FAQPage">
        <div class="adk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <div class="adk-faq-q" role="button" tabindex="0" aria-expanded="false" itemprop="name">Как внедрить ai для клиники</div>
          <div class="adk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text">Заказать аудит → согласовать сценарии → подключить API МИС → пилот 2–4 недели → масштабирование. Срок до пилота — <strong>2–6 недель</strong>.</div></div>
        </div>
        <div class="adk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <div class="adk-faq-q" role="button" tabindex="0" aria-expanded="false" itemprop="name">Сколько стоит ai для клиники</div>
          <div class="adk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text">Ориентир Nero Network: <strong>250 тыс.–2 млн ₽</strong> под ключ. Факторы — каналы, голос, число интеграций, филиалы.</div></div>
        </div>
        <div class="adk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <div class="adk-faq-q" role="button" tabindex="0" aria-expanded="false" itemprop="name">Нужен ли программист — ai для клиники без программиста</div>
          <div class="adk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text">На стороне клиники — нет. Нужны регламенты, FAQ, доступ к МИС, согласие на обработку ПДн. Техническую часть берёт Nero Network.</div></div>
        </div>
        <div class="adk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <div class="adk-faq-q" role="button" tabindex="0" aria-expanded="false" itemprop="name">Какие задачи решает ai для клиники</div>
          <div class="adk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text">Запись и перенос 24/7; напоминания; FAQ пациентов; внутренняя база знаний; квалификация лидов; аналитика no-show. Не решает: диагностику, назначения, жалобы без эскалации.</div></div>
        </div>
        <div class="adk-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <div class="adk-faq-q" role="button" tabindex="0" aria-expanded="false" itemprop="name">Как заказать — ai для клиники консультация</div>
          <div class="adk-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text">Оставьте заявку на <strong>аудит записей и звонков</strong> — разберём каналы, МИС и дадим карту внедрения с ориентиром бюджета.</div></div>
        </div>
      </div>
    </div>
  </section>

  <section class="adk-section adk-cta-final" id="cta" aria-labelledby="cta-h2" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="adk-cnt" style="text-align:center;">
      <span class="adk-eyebrow">Лид-магнит</span>
      <h2 id="cta-h2" style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;">Автоматизировать клинику</h2>
      <p style="max-width:580px;margin:0 auto 28px;font-size:16px;">Nero Network внедряет <strong>ai для клиники под ключ</strong>: запись, напоминания, поддержка пациентов и внутренняя база знаний — с интеграцией в вашу МИС, соблюдением 152-ФЗ и гибридной моделью «AI + администратор».</p>
      <ul class="adk-cta-checklist">
        <li>Аудит записей и звонков бесплатно</li>
        <li>Карта сценариев и ROI</li>
        <li>Пилот за 2–6 недель</li>
        <li>Чек 250 тыс.–2 млн ₽</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </section>

  <div class="adk-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы автоматизировать клинику?</p>
        <p class="ym-cta-block__sub">Бесплатный аудит записей и звонков — первый шаг. Покажем карту внедрения и ориентир бюджета за 2–6 недель до пилота.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Автоматизировать клинику</a>
      </div>
    </div>
<?php if ($ad_banner_url && $ad_banner_image_url) : ?>
    <div class="adk-ad-banner" style="text-align:center;padding:24px 0 40px;">
      <a href="<?php echo esc_url($ad_banner_url); ?>" target="_blank" rel="noopener noreferrer">
        <img src="<?php echo esc_url($ad_banner_image_url); ?>" width="970" height="90" alt="<?php echo esc_attr($ad_banner_alt); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;">
      </a>
    </div>
<?php endif; ?>
  </div>

</div><!-- /.adk-content -->

<?php
$adk_page_url = trailingslashit( get_permalink() );
$adk_site_url = trailingslashit( home_url( '/' ) );
$adk_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$adk_schema   = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $adk_site_url . '#organization',
			'name'  => $adk_brand,
			'url'   => $adk_site_url,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $adk_site_url . '#website',
			'url'       => $adk_site_url,
			'name'      => $adk_brand,
			'publisher' => [ '@id' => $adk_site_url . '#organization' ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $adk_page_url . '#webpage',
			'url'         => $adk_page_url,
			'name'        => 'AI для клиник: запись, напоминания и поддержка пациентов под ключ',
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $adk_site_url . '#website' ],
			'about'       => [ '@id' => $adk_site_url . '#organization' ],
		],
		[
			'@type' => 'BreadcrumbList',
			'@id'   => $adk_page_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $adk_site_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => 'AI для клиник: запись, напоминания и поддержка пациентов под ключ', 'item' => $adk_page_url ],
			],
		],
		[
			'@type'       => 'Service',
			'@id'         => $adk_page_url . '#service',
			'name'        => 'AI для клиник: запись, напоминания и поддержка пациентов под ключ',
			'description' => $page_seo_description,
			'url'         => $adk_page_url,
			'provider'    => [ '@id' => $adk_site_url . '#organization' ],
		],
		[
			'@type' => 'FAQPage',
			'@id'   => $adk_page_url . '#faq',
			'mainEntity' => [
				[ '@type' => 'Question', 'name' => 'Как внедрить ai для клиники', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Заказать аудит → согласовать сценарии → подключить API МИС → пилот 2–4 недели → масштабирование. Срок до пилота — 2–6 недель.' ] ],
				[ '@type' => 'Question', 'name' => 'Сколько стоит ai для клиники', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир Nero Network: 250 тыс.–2 млн ₽ под ключ. Факторы — каналы, голос, число интеграций, филиалы.' ] ],
				[ '@type' => 'Question', 'name' => 'Нужен ли программист — ai для клиники без программиста', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'На стороне клиники — нет. Нужны регламенты, FAQ, доступ к МИС, согласие на обработку ПДн. Техническую часть берёт Nero Network.' ] ],
				[ '@type' => 'Question', 'name' => 'Какие задачи решает ai для клиники', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Запись и перенос 24/7; напоминания; FAQ пациентов; внутренняя база знаний; квалификация лидов; аналитика no-show. Не решает: диагностику, назначения, жалобы без эскалации.' ] ],
				[ '@type' => 'Question', 'name' => 'Как заказать — ai для клиники консультация', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Оставьте заявку на аудит записей и звонков — разберём каналы, МИС и дадим карту внедрения с ориентиром бюджета.' ] ],
			],
		],
	],
];
echo '<script type="application/ld+json">' . wp_json_encode( $adk_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

<script>
(function(){
  document.querySelectorAll('.adk-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.adk-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.adk-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.adk-faq-q');
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
  var root = document.querySelector('.adk-content');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){ entry.target.classList.add('nero-ai-active'); observer.unobserve(entry.target); }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -6% 0px' });
    items.forEach(function(item){ observer.observe(item); });
  } else {
    items.forEach(function(item){ item.classList.add('nero-ai-active'); });
  }
})();
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

<?php
/**
 * Template Name: AI-администратор для ресторана: внедрение под ключ
 * Description: SEO-лендинг — AI-администратор для ресторана и доставки. Бронь, меню, статус заказа. Кейсы, интеграции.
 */

$page_seo_title       = 'AI-администратор для ресторана: внедрение под ключ';
$page_seo_description = 'Внедряем AI-администратора для ресторана и доставки: бронь столиков, ответы по меню и статус заказа без очереди на линии. Кейсы, интеграции. Получите сценарий бесплатно.';

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
    ['label' => 'Зачем',       'href' => '#zachem-ai-admin'],
    ['label' => 'Сценарии',    'href' => '#scenarii-ai-admin'],
    ['label' => 'Внедрение',   'href' => '#vnedrenie-pod-klyuch'],
    ['label' => 'Кейсы',       'href' => '#keisy'],
    ['label' => 'Стоимость',   'href' => '#stoimost'],
    ['label' => 'FAQ',         'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить сценарий';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '';

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

.rest-hero-horeca{min-height:100vh;min-height:100dvh;position:relative;}

/* === ADR CONTENT — ai-dlya-restorana article body (Борис) === */
.adr-content{
  --adr-bg:#050711;--adr-bg2:#080b17;
  --adr-surface:rgba(255,255,255,.072);--adr-text:#e6edf7;--adr-muted:#9aa8bd;
  --adr-soft:#c7d2e5;--adr-heading:#fff;--adr-border:rgba(255,255,255,.10);
  --adr-accent:#79f2ff;--adr-violet:#8b5cf6;--adr-green:#22c55e;--adr-amber:#f59e0b;
  --adr-btn-from:#2563eb;--adr-btn-to:#7c3aed;--adr-r:18px;--adr-r-lg:24px;--adr-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--adr-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.adr-content *,.adr-content *::before,.adr-content *::after{box-sizing:border-box;}
.adr-content p{color:var(--adr-muted);line-height:1.72;margin:0 0 1em;}
.adr-content h2,.adr-content h3,.adr-content h4{color:var(--adr-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.adr-content strong{color:var(--adr-soft);}
.adr-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.adr-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--adr-muted);font-size:14.5px;line-height:1.65;}
.adr-content ul li::before{content:'›';position:absolute;left:0;color:var(--adr-accent);font-weight:700;}
.adr-content ol{color:var(--adr-muted);padding-left:1.4em;margin:0 0 1em;line-height:1.72;}
.adr-cnt{width:min(var(--adr-container),calc(100% - 40px));margin:0 auto;}
.adr-section{padding:clamp(64px,8vw,112px) 0;}
.adr-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.adr-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.adr-sh.adr-left{margin-left:0;text-align:left;}
.adr-sh h2{font-size:clamp(26px,4vw,46px);line-height:1.08;margin-bottom:14px;}
.adr-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.adr-sh.adr-left p{margin-left:0;}
.adr-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--adr-accent);margin-bottom:14px;}
.adr-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.adr-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.adr-intro-text{position:relative;padding-left:20px;}
.adr-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--adr-accent),var(--adr-violet));}
.adr-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.adr-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.adr-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--adr-heading);margin-bottom:5px;}
.adr-kpi-card .kl{font-size:11px;font-weight:600;color:var(--adr-muted);line-height:1.4;}
.adr-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
.adr-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.adr-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.adr-toc a{display:inline-block;padding:9px 18px;background:var(--adr-surface);border:1px solid var(--adr-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--adr-muted);transition:border-color .2s,color .2s;}
.adr-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--adr-accent);}
.adr-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--adr-border);border-radius:var(--adr-r-lg);padding:26px;}
.adr-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.adr-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0;}
.adr-table{width:100%;border-collapse:collapse;font-size:14px;}
.adr-table th{background:rgba(255,255,255,.06);padding:14px 18px;text-align:left;font-weight:700;color:var(--adr-heading);border-bottom:1px solid rgba(255,255,255,.1);}
.adr-table td{padding:13px 18px;border-bottom:1px solid rgba(255,255,255,.06);color:var(--adr-muted);}
.adr-table tr:last-child td{border-bottom:none;}
.adr-table--highlight{border-color:rgba(245,158,11,.35);box-shadow:0 0 0 1px rgba(245,158,11,.12);}
.adr-stack-layer{display:grid;grid-template-columns:140px 1fr;gap:20px;padding:18px 0;border-bottom:1px solid rgba(255,255,255,.07);align-items:start;}
.adr-stack-layer:last-child{border-bottom:none;}
.adr-stack-label{font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:var(--adr-accent);}
.adr-stack-val{font-size:15px;color:var(--adr-text);font-weight:600;}
.adr-stack-desc{font-size:13px;color:var(--adr-muted);margin-top:4px;}
.adr-stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-top:28px;}
.adr-stat-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:20px 16px;text-align:center;}
.adr-stat-card .num{font-size:clamp(22px,3vw,32px);font-weight:900;color:var(--adr-accent);margin-bottom:6px;}
.adr-stat-card .lbl{font-size:12px;color:var(--adr-muted);line-height:1.45;}
.adr-timeline{display:flex;flex-direction:column;gap:0;}
.adr-tl-item{position:relative;padding:0 0 28px 28px;border-left:2px solid rgba(121,242,255,.25);}
.adr-tl-item:last-child{padding-bottom:0;}
.adr-tl-dot{position:absolute;left:-7px;top:4px;width:12px;height:12px;border-radius:50%;background:var(--adr-accent);box-shadow:0 0 12px rgba(121,242,255,.5);}
.adr-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.adr-faq-item{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.adr-faq-q{display:flex;justify-content:space-between;align-items:center;padding:18px 24px;font-weight:700;color:var(--adr-heading);cursor:pointer;font-size:15px;}
.adr-faq-q::after{content:'▾';color:var(--adr-accent);transition:transform .2s;}
.adr-faq-item.open .adr-faq-q::after{transform:rotate(180deg);}
.adr-faq-a{max-height:0;overflow:hidden;transition:max-height .3s;padding:0 24px;color:var(--adr-muted);font-size:14.5px;line-height:1.7;}
.adr-faq-item.open .adr-faq-a{max-height:800px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(59,130,246,.12),rgba(139,92,246,.1));border:1px solid rgba(59,130,246,.28);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(59,130,246,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--adr-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:var(--adr-accent);text-decoration:underline;}
.adr-internal-links-wrap{padding:0 0 clamp(28px,3.5vw,44px);}
.adr-internal-links{margin:0;}
.adr-internal-links__h{font-size:clamp(18px,2.2vw,22px);margin-bottom:16px;}
.adr-internal-links__list{margin:0;padding:0;list-style:none;display:flex;flex-direction:column;gap:12px;}
.adr-internal-links__list li{margin:0;padding:0;font-size:14.5px;line-height:1.65;color:var(--adr-muted);}
.adr-internal-links__list li::before{content:none;}
.adr-internal-links__list a{color:var(--adr-accent);font-weight:600;text-decoration:none;border-bottom:1px solid rgba(121,242,255,.35);transition:color .2s,border-color .2s;}
.adr-internal-links__list a:hover{color:#fff;border-color:rgba(121,242,255,.7);}
@media(max-width:900px){.adr-intro-grid{grid-template-columns:1fr;}.adr-stat-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:768px){.adr-grid-3{grid-template-columns:1fr;}.adr-stack-layer{grid-template-columns:1fr;}}
@media(max-width:600px){.adr-intro-kpi{grid-template-columns:1fr 1fr;}.ym-cta-block{padding:28px 20px;}}
.adr-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.adr-content a{color:inherit;}
.adr-content ol{color:var(--adr-muted);padding-left:1.4em;margin:0 0 1em;line-height:1.72;}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--adr-btn-from),var(--adr-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--adr-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.ai-dlya-restorana-page .nero-ai-btn-secondary{color:var(--adr-text)!important;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.18);}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlya-restorana-page" role="main" tabindex="-1">

<section class="nero-ai-hero rest-hero-horeca" id="hero" aria-labelledby="rest-hero-title">
<style>
/* ── Hero ai-dlya-restorana: самодостаточные стили (канон главной Nero Network) ── */
.rest-hero-horeca {
  --rest-warm: #f97316;
  --rest-amber: #fbbf24;
  --rest-cyan: #38bdf8;
  --rest-green: #22c55e;
  --rest-text: #e6edf7;
  --rest-muted: #9aa8bd;
  --rest-soft: #c7d2e5;
  --rest-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.rest-hero-horeca::before {
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
.rest-hero-horeca::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(249, 115, 22, .12), transparent 66%);
  filter: blur(10px);
  animation: restHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes restHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to   { opacity: .78; transform: scale(1.04); }
}
.rest-hero-horeca .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.rest-hero-horeca .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.rest-hero-horeca .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.rest-hero-horeca .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--rest-warm) 40%, #fde68a 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.rest-hero-horeca .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(249, 115, 22, 0.24);
  border-radius: 999px;
  background: rgba(249, 115, 22, 0.08);
  color: var(--rest-warm) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.rest-hero-horeca .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--rest-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.rest-hero-horeca .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.rest-hero-horeca .nero-ai-badge {
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
.rest-hero-horeca .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.rest-hero-horeca .nero-ai-btn {
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
.rest-hero-horeca .nero-ai-btn:hover { transform: translateY(-2px); }
.rest-hero-horeca .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--rest-warm), #fde68a);
  box-shadow: 0 18px 42px rgba(249, 115, 22, 0.22);
}
.rest-hero-horeca .nero-ai-btn-secondary {
  color: var(--rest-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.rest-hero-horeca .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--rest-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.rest-hero-horeca .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.rest-hero-horeca .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.rest-hero-horeca .nero-ai-dots { display: flex; gap: 7px; }
.rest-hero-horeca .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.rest-hero-horeca .nero-ai-dot:nth-child(1) { background: #fb7185; }
.rest-hero-horeca .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.rest-hero-horeca .nero-ai-dot:nth-child(3) { background: #34d399; }
.rest-hero-horeca .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.rest-hero-horeca .nero-ai-window-body { padding: 16px; }
.rest-hero-horeca .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.rest-hero-horeca .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.rest-hero-horeca .nero-ai-live-pill {
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
.rest-hero-horeca .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: restPulse 1.6s infinite;
}
@keyframes restPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.rest-hero-horeca .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.rest-hero-horeca .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.rest-hero-horeca .nero-ai-metric span {
  display: block;
  color: var(--rest-muted);
  font-size: 11px;
  font-weight: 700;
}
.rest-hero-horeca .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.rest-hero-horeca .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.rest-hero-horeca .rest-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(249, 115, 22, 0.18);
  background: radial-gradient(ellipse at 50% 40%, rgba(249,115,22,.08), rgba(6,10,24,.92) 72%);
}
.rest-hero-horeca #rest-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.rest-hero-horeca .nero-ai-task-stream { display: grid; gap: 8px; }
.rest-hero-horeca .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.rest-hero-horeca .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(249,115,22,.12);
  color: var(--rest-warm);
  font-size: 11px;
  font-weight: 800;
}
.rest-hero-horeca .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.rest-hero-horeca .nero-ai-task span {
  color: var(--rest-muted);
  font-size: 11px;
}
.rest-hero-horeca .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.rest-hero-horeca .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .rest-hero-horeca .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .rest-hero-horeca .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .rest-hero-horeca .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .rest-hero-horeca .nero-ai-window-body { padding: 12px; }
  .rest-hero-horeca .nero-ai-task { grid-template-columns: 28px 1fr; }
  .rest-hero-horeca .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai для ресторана</p>
      <h1 id="rest-hero-title">AI-администратор для ресторана и доставки: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Принимаем брони, отвечаем по меню и статусу доставки — без очереди на линии и потерянных заказов</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Бронь 24/7</li>
        <li class="nero-ai-badge">Меню и аллергены</li>
        <li class="nero-ai-badge">Статус доставки</li>
        <li class="nero-ai-badge">Эскалация на оператора</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#scenarii-ai-admin">Посмотреть сценарии</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-администратор ресторана">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-администратор ресторана</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Пропущенные</span><strong>0%</strong><small>звонков</small></div>
            <div class="nero-ai-metric"><span>Авто</span><strong>82%</strong><small>обработка</small></div>
            <div class="nero-ai-metric"><span>Линия</span><strong>24/7</strong><small>на связи</small></div>
            <div class="nero-ai-metric"><span>КЦ</span><strong>↓3,5×</strong><small>нагрузка</small></div>
          </div>

          <div class="rest-dash-canvas-wrap" aria-hidden="false">
            <canvas id="rest-hero-canvas" role="img" aria-label="Анимация: входящий звонок классифицируется, бронь подтверждается на карте зала"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий AI-администратора">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">☎</span>
              <div><strong>Входящий звонок</strong><span>бронь столика на 4</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">🛵</span>
              <div><strong>Статус доставки</strong><span>ответ из iiko · ETA 18 мин</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">🍽</span>
              <div><strong>Банкет 20 гостей</strong><span>эскалация менеджеру</span></div>
              <span class="nero-ai-status nero-ai-status--amber">оператор</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("rest-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    if (!canvas.parentElement) return;
    canvas.width = canvas.parentElement.clientWidth || 400;
    canvas.height = canvas.parentElement.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 10;
    scale = cw < 400 ? cw / 380 : Math.min(cw / 520, ch / 280) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    warm: "#f97316",
    amber: "#fbbf24",
    green: "#22c55e",
    cyan: "#38bdf8",
    panelBg: "#0f172a",
    panelLine: "#1e293b",
    ticket: "#fef3c7",
    bubbleBg: "#ffffff",
    bubbleText: "#0f172a",
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

  /* Транспорт: кухонная рейка чеков (не конвейер) */
  function TicketPegRail(x, y, w) {
    this.x = x; this.y = y; this.w = w;
    this.tickets = [
      { label: "БРОНЬ", color: C.green, offset: 0 },
      { label: "МЕНЮ", color: C.amber, offset: 55 },
      { label: "ДОСТАВКА", color: C.cyan, offset: 110 }
    ];
  }
  TicketPegRail.prototype.draw = function (ctx) {
    drawRR(ctx, this.x, this.y, this.w, 8, 4, C.panelLine, C.outline);
    var drift = (frame * 0.45) % (this.w + 80);
    this.tickets.forEach(function (t) {
      var tx = this.x + ((t.offset + drift) % (this.w + 40)) - 20;
      drawRR(ctx, tx, this.y - 22, 38, 18, 3, t.color, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(t.label, tx + 19, this.y - 10);
    }, this);
  };

  /* Центральный объект: панель хостес с картой зала */
  function HostCommandPanel(x, y) {
    this.x = x; this.y = y;
    this.phase = 0;
    this.litTable = -1;
    this.confirmAlpha = 0;
  }
  HostCommandPanel.prototype.draw = function (ctx) {
    var cycle = (frame * 0.042) % 240;
    this.phase = cycle;
    if (cycle > 185) {
      this.litTable = 4;
      this.confirmAlpha = Math.min(1, (cycle - 185) / 20);
    } else if (cycle > 120) {
      this.litTable = 2;
      this.confirmAlpha = 0;
    } else {
      this.litTable = -1;
      this.confirmAlpha = 0;
    }

    drawRR(ctx, this.x - 95, this.y - 70, 190, 130, 10, C.panelBg, C.outline);
    drawRR(ctx, this.x - 88, this.y - 62, 176, 18, 4, C.panelLine, null);
    ctx.fillStyle = C.warm;
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("HOST · AI DISPATCH", this.x - 82, this.y - 50);

    /* Сетка столиков 3×3 */
    for (var row = 0; row < 3; row++) {
      for (var col = 0; col < 3; col++) {
        var idx = row * 3 + col;
        var tx = this.x - 72 + col * 28;
        var ty = this.y - 38 + row * 24;
        var fill = idx === this.litTable ? C.green : C.panelLine;
        drawRR(ctx, tx, ty, 22, 18, 4, fill, C.outline);
        if (idx === this.litTable && cycle > 185) {
          ctx.strokeStyle = C.green;
          ctx.lineWidth = 2;
          ctx.globalAlpha = 0.4 + Math.sin(frame * 0.2) * 0.3;
          ctx.strokeRect(tx - 2, ty - 2, 26, 22);
          ctx.globalAlpha = 1;
        }
      }
    }

    /* Индикаторы интентов */
    var intents = ["бронь", "меню", "статус"];
    intents.forEach(function (label, i) {
      var on = cycle > 50 + i * 25 && cycle < 200;
      drawRR(ctx, this.x - 82 + i * 58, this.y + 38, 50, 14, 3, on ? "rgba(249,115,22,.25)" : C.panelLine, C.outline);
      ctx.fillStyle = on ? C.amber : "#64748b";
      ctx.font = "7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, this.x - 57 + i * 58, this.y + 48);
    }, this);

    if (this.confirmAlpha > 0) {
      drawRR(ctx, this.x - 70, this.y + 58, 140, 22, 6, "rgba(34,197,94,.2)", C.green);
      ctx.fillStyle = C.green;
      ctx.globalAlpha = this.confirmAlpha;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Бронь подтверждена · SMS гостю", this.x, this.y + 72);
      ctx.globalAlpha = 1;
    }
  };

  /* Пульс входящего звонка */
  function IncomingCallPulse(x, y) {
    this.x = x; this.y = y;
  }
  IncomingCallPulse.prototype.draw = function (ctx) {
    var cycle = (frame * 0.042) % 240;
    if (cycle > 45) return;
    var rings = 3;
    for (var i = 0; i < rings; i++) {
      var r = 12 + i * 8 + (frame % 30) * 0.4;
      ctx.strokeStyle = "rgba(249,115,22," + (0.5 - i * 0.15) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(this.x, this.y, r, 0, Math.PI * 2);
      ctx.stroke();
    }
    drawRR(ctx, this.x - 10, this.y - 10, 20, 20, 5, C.warm, C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 10px sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("☎", this.x, this.y + 4);
  };

  /* Меню / база знаний */
  function MenuKnowledgeScroll(x, y) {
    this.x = x; this.y = y;
  }
  MenuKnowledgeScroll.prototype.draw = function (ctx) {
    var cycle = (frame * 0.042) % 240;
    if (cycle < 55 || cycle > 130) return;
    var scroll = (cycle - 55) * 0.8;
    drawRR(ctx, this.x, this.y - 30 + (scroll % 40), 36, 48, 4, "#fff7ed", C.outline);
    for (var i = 0; i < 4; i++) {
      drawRR(ctx, this.x + 5, this.y - 22 + i * 10 + (scroll % 40), 26, 4, 1, "#fed7aa", null);
    }
  };

  /* Маяк доставки */
  function DeliveryEtaBeacon(x, y) {
    this.x = x; this.y = y;
  }
  DeliveryEtaBeacon.prototype.draw = function (ctx) {
    var cycle = (frame * 0.042) % 240;
    if (cycle < 100 || cycle > 175) return;
    ctx.fillStyle = C.cyan;
    ctx.beginPath();
    ctx.moveTo(this.x, this.y - 8);
    ctx.lineTo(this.x + 10, this.y + 6);
    ctx.lineTo(this.x - 10, this.y + 6);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.stroke();
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ETA", this.x, this.y + 18);
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y;
    this.baseX = x; this.baseY = y;
    this.color = color;
    this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }
  Agent.prototype.draw = function (ctx) {
    this.timer += 0.035;
    var cycle = (frame * 0.042) % 240;
    var isMoving = false;
    var targetX = -20;
    var targetY = 15 + (this.stepTrig % 3) * 8;
    var faceDir = 1;

    if (cycle >= this.stepTrig && cycle < this.stepTrig + 22) {
      var local = cycle - this.stepTrig;
      isMoving = local < 18;
      var t = Math.min(1, local / 10);
      if (local < 10) {
        this.x = this.baseX + (targetX - this.baseX) * t;
        this.y = this.baseY + (targetY - this.baseY) * t;
        faceDir = targetX > this.baseX ? 1 : -1;
      } else {
        this.x = targetX - (targetX - this.baseX) * ((local - 12) / 10);
        this.y = targetY - (targetY - this.baseY) * ((local - 12) / 10);
        faceDir = -1;
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.4) * 1.2;
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -10, -8 - bob, 20, 14, 4, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -18 - bob, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new TicketPegRail(-120, -95, 240));
  entities.push(new HostCommandPanel(0, 10));
  entities.push(new IncomingCallPulse(-105, 55));
  entities.push(new MenuKnowledgeScroll(105, -20));
  entities.push(new DeliveryEtaBeacon(108, 50));
  entities.push(new Agent(-130, 75, C.agentYellow, "1_architect", 28, [
    "Карта диалогов брони", "Overflow после 3 гудков", "Сценарий эскалации"
  ]));
  entities.push(new Agent(-75, 82, C.agentGreen, "2_integrator", 72, [
    "Remarked API слоты", "Стоп-лист из iiko", "CRM карточка гостя"
  ]));
  entities.push(new Agent(-20, 85, C.agentBlue, "3_voice", 118, [
    "Yandex SpeechKit STT", "Read-back заказа", "Warm transfer оператору"
  ]));
  entities.push(new Agent(35, 82, C.agentPink, "4_content", 158, [
    "Аллергены в базе", "Акции на сегодня", "Тон бренда TOV"
  ]));
  entities.push(new Agent(90, 75, C.agentPurple, "5_launch", 198, [
    "Пилот: бронь + FAQ", "Дашборд метрик 24/7", "152-ФЗ compliance"
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

    var prg = (frame * 0.042) % 240;
    if (prg >= 12 && prg < 12.05) createBubble(-95, 30, "1. Входящий звонок");
    if (prg >= 58 && prg < 58.05) createBubble(-10, -40, "2. Интент: бронь / меню");
    if (prg >= 125 && prg < 125.05) createBubble(0, -55, "3. Слот в Remarked");
    if (prg >= 188 && prg < 188.05) createBubble(0, 85, "4. Подтверждение гостю");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 16, 4, C.bubbleBg, C.warm);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
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
});
</script>


<!-- ====================================================
     КОНТЕНТНАЯ ЧАСТЬ — ai-dlya-restorana (Борис)
     ВНИМАНИЕ: содержит <canvas> и <script> — не удалять id
     ==================================================== -->
<div class="adr-content">

  <section class="adr-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="adr-cnt">
      <div class="adr-intro-grid nero-ai-reveal">
        <div class="adr-intro-text">
          <p class="adr-eyebrow">Лонгрид · ai для ресторана</p>
          <p><strong>Коротко:</strong> AI-администратор — это цифровой сотрудник на входящей линии и в мессенджерах, который принимает брони столиков, отвечает по меню и сообщает статус доставки 24/7. В отличие от кнопочного чат-бота, он понимает свободную речь («тихий столик у окна на шестерых»), обращается к POS и CRM через API и передаёт сложные запросы живому администратору с полным контекстом диалога.</p>
          <p>Звонки по брони и доставке отвлекают персонал в самый загруженный момент — когда администратор встречает гостей в зале, а оператор call-центра не успевает снять трубку. Пропущенный звонок в ресторане — это не «техническая мелочь», а потерянная бронь, отменённый заказ и уход клиента к конкуренту. Внедрение AI для ресторана под ключ закрывает эту боль без найма ночной смены и без бесконечной SaaS-подписки: фиксированный проект, прозрачные сценарии, измеримый результат.</p>
        </div>
        <div class="adr-intro-kpi" aria-label="Ключевые метрики боли HoReCa">
          <div class="adr-kpi-card"><div class="kv">35%</div><div class="kl">броней по телефону</div><div class="ks">VoiceLogic, отрасл. оценка</div></div>
          <div class="adr-kpi-card"><div class="kv">25%</div><div class="kl">пропущенных звонков в пик</div><div class="ks">администраторы в зале</div></div>
          <div class="adr-kpi-card"><div class="kv">110–160%</div><div class="kl">рост пропусков в Москве</div><div class="ks">Calltouch / CNews, 2025</div></div>
          <div class="adr-kpi-card"><div class="kv">35 млн ₽</div><div class="kl">потери сети в год</div><div class="ks">Nodul / AdIndex, 2026</div></div>
        </div>
      </div>
    </div>
  </section>

  <?php $nn_site = rtrim( getenv( 'PUBLIC_SITE_URL' ) ?: getenv( 'WP_SITE_URL' ) ?: '', '/' ); ?>
  <div class="adr-internal-links-wrap">
    <div class="adr-cnt">
      <aside class="adr-card adr-internal-links" aria-label="Смежные материалы Nero Network по внедрению AI">
        <span class="adr-eyebrow">Читайте также</span>
        <h2 class="adr-internal-links__h">Внедрение AI в бизнес: смежные решения</h2>
        <ul class="adr-internal-links__list">
          <li><a href="<?php echo esc_url( $nn_site . '/vnedrenie-ai-amocrm/' ); ?>">AI-агент для amoCRM под ключ</a> — карточки гостей, история броней и аналитика конверсии из входящей линии ресторана.</li>
          <li><a href="<?php echo esc_url( $nn_site . '/vnedrenie-ai-obrabotka-email-crm/' ); ?>">AI-обработка входящей почты в CRM</a> — автоматизация письменных запросов гостей и бронирований, которые приходят на email.</li>
          <li><a href="<?php echo esc_url( $nn_site . '/ai-1c-erp/' ); ?>">AI-агент для 1С и ERP</a> — связка учётных систем с операционными сценариями: заказы, остатки, статусы доставки.</li>
          <li><a href="<?php echo esc_url( $nn_site . '/kpmg-claude-vnedrenie-ai-276-tysyach/' ); ?>">масштабное внедрение AI в бизнес — кейс KPMG и Claude</a> — уроки корпоративного rollout для команд, которые планируют пилот AI-администратора.</li>
        </ul>
      </aside>
    </div>
  </div>

  <div class="adr-toc-outer">
    <div class="adr-cnt">
      <nav class="adr-toc" aria-label="Оглавление статьи">
        <a href="#zachem-ai-admin">Зачем</a>
        <a href="#scenarii-ai-admin">Сценарии</a>
        <a href="#vnedrenie-pod-klyuch">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#keisy">Кейсы</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- H2 1 -->
  <section class="adr-section" id="zachem-ai-admin">
    <div class="adr-cnt">
      <div class="adr-sh adr-left">
        <span class="adr-eyebrow">Боль и выгода</span>
        <h2>Зачем ресторану и доставке AI-администратор</h2>
      </div>

      <div class="adr-card nero-ai-reveal">
        <h3 id="propushchennyj-zvonok">Пропущенный звонок — потерянная бронь и заказ</h3>
        <p>В HoReCa входящий звонок — это деньги в реальном времени. Гость хочет забронировать столик на субботу, уточнить состав блюда для аллергика или узнать, где курьер. Если линия занята или звонок сорвался после нескольких гудков, он не ждёт — он звонит в соседнее заведение или оформляет заказ через агрегатор, где маржа ниже.</p>
        <p>По оценкам платформы Nodul (AdIndex, апрель 2026), рестораны в России могут терять до <strong>35 млн ₽ в год</strong> из-за неотвеченных звонков. Calltouch (CNews, декабрь 2025) фиксирует рост пропущенных обращений в Москве до <strong>110–160%</strong> от базового уровня в пиковые месяцы. На отраслевых лендингах голосовых решений для ресторанов (VoiceLogic) указывают: до <strong>35%</strong> броней по-прежнему приходят по телефону, а в часы пик администраторы пропускают до <strong>25%</strong> звонков.</p>
        <p><strong>Итог:</strong> автоматизация через AI для ресторана — не про «модный чат-бот», а про возврат выручки, которая уже стучится в дверь, но не дозванивается.</p>
      </div>

      <div class="adr-card nero-ai-reveal nero-ai-delay-1" style="margin-top:20px;">
        <h3 id="nagruzka-pik">Нагрузка на администраторов и call-центр в часы пик</h3>
        <p>Типичная картина: пятница, 19:00. Администратор в зале встречает гостей, принимает оплату, координирует кухню. Параллельно звонит телефон — бронь, доставка, вопрос по меню. Оператор call-центра доставки в это же время обрабатывает статусы заказов, и очередь растёт.</p>
        <p>Кейс сети «Тануки» (TWIN24): до внедрения голосового бота пропускалось до <strong>30%</strong> звонков на линии доставки, среднее ожидание в пике — <strong>10–12 минут</strong>. После запуска AI-линии <strong>100%</strong> звонков принимаются, нагрузка на отдел доставки снижена практически до нуля для типовых сценариев, расходы на подтверждение заказов — <strong>в 3 раза</strong> ниже.</p>
        <p>AI-администратор ресторана снимает рутину с живых сотрудников: бронь, FAQ по меню, статус заказа, подтверждение визита. Люди остаются там, где без них не обойтись — банкеты, конфликты, VIP, нестандартные пожелания.</p>
      </div>

      <div class="adr-card nero-ai-reveal nero-ai-delay-2" style="margin-top:20px;">
        <h3 id="servisnye-zaprosy-2026">Сервисные запросы гостей, которые можно автоматизировать в 2026</h3>
        <p>Большинство обращений в ресторан и доставку — повторяемые. Их удобно переводить в автоматические сценарии:</p>
        <ul>
          <li>бронирование, изменение и отмена столика;</li>
          <li>вопросы по меню, аллергенам, стоп-листу, акциям;</li>
          <li>приём заказа на доставку и самовывоз;</li>
          <li>статус заказа и ETA курьера;</li>
          <li>подтверждение брони за несколько часов до визита;</li>
          <li>короткий NPS-опрос после визита.</li>
        </ul>
        <p>Тренд 2025–2026 — переход от «чат-ботов с кнопками» к <strong>agentic AI</strong>: агентам, которые сами вызывают API бронирования, POS и CRM. Gartner (цит. IBM Contact Center Automation Trends) прогнозирует, что к <strong>2028</strong> не менее <strong>70%</strong> клиентов начнут customer journey с conversational AI-интерфейса. Cisco (цит. Voiceflow, 2026) ожидает <strong>56%</strong> support-взаимодействий с agentic AI к середине 2026 года.</p>
        <p>Для ресторана это уже не эксперимент, а операционный стандарт: конкуренты закрывают входящую линию AI-администраторами.</p>
      </div>
    </div>
  </section>

  <!-- H2 2 -->
  <section class="adr-section adr-section-alt" id="scenarii-ai-admin">
    <div class="adr-cnt">
      <div class="adr-sh">
        <span class="adr-eyebrow">Сценарии AI-админа</span>
        <h2>Что делает AI-администратор: бронь, меню, доставка</h2>
        <p><strong>Определение:</strong> AI-администратор — голосовой и/или текстовый AI-агент, который работает как цифровой сотрудник на «входящей линии» и в мессенджерах. Он отличается от IVR («нажмите 1») пониманием естественной речи и от простого чат-бота — способностью выполнять действия: проверить слот в Remarked, оформить бронь, запросить статус в iiko, записать контакт в CRM.</p>
      </div>

      <div class="adr-grid-3 nero-ai-reveal">
        <div class="adr-card">
          <h3 id="bronirovanie-24-7">Бронирование столиков 24/7 (телефон, сайт, мессенджеры)</h3>
          <p>AI бронирование столиков работает круглосуточно — в том числе в «мёртвые» часы, когда администратора в зале нет. Гость говорит или пишет свободно: «Столик на четверых в субботу в 20:00, желательно у окна». Агент запрашивает API системы бронирования (Remarked, Poster, внутренняя CRM), предлагает доступные слоты, уточняет депозит при необходимости, отправляет подтверждение в SMS, Telegram или WhatsApp.</p>
          <p>Международный ориентир: ресторан The Melting Pot (США, PolyAI) за первые 6 месяцев получил <strong>$250 000</strong> выручки с after-hours броней; <strong>68%</strong> reservation-звонков обрабатывает AI. В России кейс Fromtech показывает <strong>82%</strong> звонков, принимаемых роботом, и <strong>0%</strong> пропущенных на линии бронирования.</p>
        </div>
        <div class="adr-card nero-ai-delay-1">
          <h3 id="menu-allergeny">Ответы по меню, аллергенам и акциям</h3>
          <p>AI приём заказов начинается с консультации. Гость спрашивает: «Есть ли безглютеновые позиции?», «Что сегодня в стопе?», «Действует ли акция на день рождения?». Агент отвечает из базы знаний, синхронизированной с актуальным меню и стоп-листом из POS.</p>
          <p>Ответы не «галлюцинируют» — стоп-лист и цены подтягиваются из iiko, R-Keeper или Poster. При сомнении агент уточняет или переводит на оператора. В скрипте возможен upsell: предложить напиток или десерт к заказу.</p>
        </div>
        <div class="adr-card nero-ai-delay-2">
          <h3 id="status-dostavki">Статус заказа доставки и эскалация на оператора</h3>
          <p>AI доставка еды и AI бот доставки закрывают линию «где мой заказ?» — самый частый повод позвонить в службу доставки. Агент по номеру телефона или номеру заказа запрашивает статус в POS, сообщает ETA, при задержке инициирует callback или эскалацию.</p>
          <p>Кейс «Тануки»: <strong>~90%</strong> стандартных ситуаций решаются без человека. <strong>Эскалация</strong> — обязательный модуль: банкет, жалоба, VIP, негатив — warm transfer на живого администратора <strong>с контекстом</strong>.</p>
        </div>
      </div>

      <div class="adr-table-wrap adr-table--highlight nero-ai-reveal" style="margin-top:32px;">
        <table class="adr-table" aria-label="Сценарии: что делает AI и что передаёт человеку">
          <thead>
            <tr>
              <th scope="col">Сценарий</th>
              <th scope="col">Делает AI</th>
              <th scope="col">Передаёт человеку</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Бронь на 2–8 гостей</td><td>✓</td><td>Банкет 15+ гостей</td></tr>
            <tr><td>FAQ по меню, аллергены</td><td>✓</td><td>Индивидуальное меню, шеф-стол</td></tr>
            <tr><td>Статус доставки</td><td>✓</td><td>Компенсация, конфликт</td></tr>
            <tr><td>Приём заказа доставки</td><td>✓ (с read-back)</td><td>Сложные модификаторы вне скрипта</td></tr>
            <tr><td>Подтверждение брони, NPS</td><td>✓</td><td>Жалоба, негатив</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- CTA Артура #1 -->
  <div class="adr-cnt">
    <aside class="ym-cta-block ym-cta-block--primary" id="cta-scenarii">
      <div class="ym-cta-block__icon" aria-hidden="true">🍽️</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получите сценарий AI-администратора для вашего ресторана</p>
        <p class="ym-cta-block__sub">Готовая карта диалогов: бронь столиков, меню и аллергены, статус доставки, эскалация банкетов — до заявки на внедрение. Бесплатно, за 1–2 рабочих дня после брифа.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </aside>
  </div>

  <!-- ================================================
       БОРИС: визуальный блок после #scenarii-ai-admin
       ================================================ -->
  <section id="ai-dlya-restorana-boris-block" class="bari-root" aria-label="Операционный мостик: маршрутизация запроса гостя через AI-администратора">
<style>
/* === БОРИС: prefix bari-, scoped внутри #ai-dlya-restorana-boris-block === */
#ai-dlya-restorana-boris-block.bari-root{padding:56px 0 64px;background:#f8fafc;}
#ai-dlya-restorana-boris-block .bari-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-dlya-restorana-boris-block .bari-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-dlya-restorana-boris-block .bari-card{grid-template-columns:1fr;min-height:auto;}
}
#ai-dlya-restorana-boris-block .bari-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-dlya-restorana-boris-block .bari-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#ai-dlya-restorana-boris-block .bari-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:#ea580c;margin:0 0 14px;
}
#ai-dlya-restorana-boris-block .bari-ey::before{content:'';width:18px;height:2px;background:#ea580c;border-radius:1px;}
#ai-dlya-restorana-boris-block .bari-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#ai-dlya-restorana-boris-block .bari-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-dlya-restorana-boris-block .bari-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#ai-dlya-restorana-boris-block .bari-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(234,88,12,.1);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#c2410c;margin-top:1px;font-style:normal;
}
#ai-dlya-restorana-boris-block .bari-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-dlya-restorana-boris-block .bari-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-dlya-restorana-boris-block .bari-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-dlya-restorana-boris-block .bari-pl-o{background:rgba(234,88,12,.08);color:#c2410c;border:1.5px solid rgba(234,88,12,.22);}
#ai-dlya-restorana-boris-block .bari-pl-b{background:rgba(59,130,246,.08);color:#1d4ed8;border:1.5px solid rgba(59,130,246,.22);}
#ai-dlya-restorana-boris-block .bari-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
#ai-dlya-restorana-boris-block .bari-rgt{
  background:linear-gradient(145deg,#0c0a09 0%,#1c1917 55%,#0f0d0b 100%);
  position:relative;overflow:hidden;min-height:420px;
}
#bari-rest-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="bari-cnt">
  <div class="bari-card">
    <div class="bari-lft">
      <span class="bari-ey">Операционный мостик</span>
      <h3 class="bari-h3">Один запрос гостя — четыре канала, один AI, три исхода</h3>
      <ul class="bari-ul">
        <li><span class="bari-ic">☎</span>Телефон, Telegram и WhatsApp сходятся в AI-хаб — единая база знаний</li>
        <li><span class="bari-ic">◎</span>Интент определяется за секунды: бронь, меню, статус доставки, банкет</li>
        <li><span class="bari-ic">↗</span>API Remarked / iiko / CRM — действие, а не шаблонный ответ</li>
        <li><span class="bari-ic">👤</span>Низкая уверенность или VIP — warm transfer оператору с логом диалога</li>
      </ul>
      <div class="bari-pills">
        <span class="bari-pl bari-pl-g">0% пропущенных</span>
        <span class="bari-pl bari-pl-o">82% автообработка</span>
        <span class="bari-pl bari-pl-b">24/7 на линии</span>
      </div>
      <p class="bari-foot">Дальше разберём этапы внедрения AI для ресторана под ключ →</p>
    </div>
    <div class="bari-rgt">
      <canvas id="bari-rest-canvas" role="img" aria-label="Анимация: запросы гостя с телефона и мессенджеров проходят через AI-хаб к системам бронирования, POS и оператору"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  var cv=document.getElementById('bari-rest-canvas');
  if(!cv)return;
  var cx=cv.getContext('2d'),W=0,H=0,t=0;

  function resize(){
    var p=cv.parentElement;if(!p)return;
    cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;
    W=cv.width;H=cv.height;
  }
  window.addEventListener('resize',resize);resize();

  var C={
    phone:'#f97316',chat:'#38bdf8',hub:'#a78bfa',pos:'#4ade80',crm:'#60a5fa',human:'#fb7185',
    text:'#e7e5e4',muted:'rgba(231,229,228,.45)',line:'rgba(255,255,255,.08)',card:'rgba(255,255,255,.06)'
  };

  var COLS=[
    {x:0.12,label:'Каналы'},
    {x:0.38,label:'AI-хаб'},
    {x:0.64,label:'Системы'},
    {x:0.88,label:'Исход'}
  ];

  var REQ=[
    {type:'phone',label:'Бронь на 4',color:C.phone,delay:0},
    {type:'chat',label:'Меню / аллерген',color:C.chat,delay:90},
    {type:'phone',label:'Где курьер?',color:C.phone,delay:180},
    {type:'chat',label:'Банкет 20 чел.',color:C.chat,delay:270},
    {type:'phone',label:'Стол у окна',color:C.phone,delay:360}
  ];
  var LOOP=480;

  function drawHub(x,y,r,pulse){
    var g=cx.createRadialGradient(x,y,0,x,y,r*1.8);
    g.addColorStop(0,'rgba(167,139,250,'+(0.35+0.15*Math.sin(pulse))+')');
    g.addColorStop(1,'rgba(167,139,250,0)');
    cx.fillStyle=g;cx.beginPath();cx.arc(x,y,r*1.8,0,Math.PI*2);cx.fill();
    cx.fillStyle=C.hub;cx.beginPath();cx.arc(x,y,r,0,Math.PI*2);cx.fill();
    cx.fillStyle='#fff';cx.font='bold 11px Inter,sans-serif';cx.textAlign='center';
    cx.fillText('AI',x,y+4);
  }

  function drawNode(x,y,w,h,label,sub,color){
    cx.fillStyle=C.card;cx.strokeStyle='rgba(255,255,255,.14)';cx.lineWidth=1;
    cx.beginPath();cx.roundRect(x-w/2,y-h/2,w,h,10);cx.fill();cx.stroke();
    cx.fillStyle=color;cx.beginPath();cx.arc(x-w/2+16,y,5,0,Math.PI*2);cx.fill();
    cx.fillStyle=C.text;cx.font='600 11px Inter,sans-serif';cx.textAlign='left';
    cx.fillText(label,x-w/2+28,y-2);
    if(sub){cx.fillStyle=C.muted;cx.font='10px Inter,sans-serif';cx.fillText(sub,x-w/2+28,y+12);}
  }

  function drawParticle(px,py,alpha,color){
    cx.globalAlpha=alpha;cx.fillStyle=color;
    cx.beginPath();cx.arc(px,py,4,0,Math.PI*2);cx.fill();cx.globalAlpha=1;
  }

  function loop(){
    t++;var pulse=t*0.04;
    cx.clearRect(0,0,W,H);

    cx.strokeStyle=C.line;cx.lineWidth=1;
    for(var i=0;i<4;i++){
      var lx=COLS[i].x*W;
      cx.beginPath();cx.moveTo(lx,36);cx.lineTo(lx,H-28);cx.stroke();
      cx.fillStyle=C.muted;cx.font='600 9px Inter,sans-serif';cx.textAlign='center';
      cx.fillText(COLS[i].label,lx,24);
    }

    var hubX=COLS[1].x*W,hubY=H*0.5,hubR=34;
    drawHub(hubX,hubY,hubR,pulse);

    drawNode(COLS[0].x*W,H*0.28,100,36,'Телефон','входящая',C.phone);
    drawNode(COLS[0].x*W,H*0.52,100,36,'Telegram','чат',C.chat);
    drawNode(COLS[0].x*W,H*0.76,100,36,'WhatsApp','чат',C.chat);

    drawNode(COLS[2].x*W,H*0.32,110,36,'Remarked','бронь',C.pos);
    drawNode(COLS[2].x*W,H*0.56,110,36,'iiko / POS','статус',C.pos);
    drawNode(COLS[2].x*W,H*0.80,110,36,'CRM','карточка',C.crm);

    drawNode(COLS[3].x*W,H*0.38,100,36,'Подтверждение','SMS / TG',C.pos);
    drawNode(COLS[3].x*W,H*0.58,100,36,'Ответ гостю','меню / ETA',C.chat);
    drawNode(COLS[3].x*W,H*0.78,100,36,'Оператор','эскалация',C.human);

    REQ.forEach(function(r,idx){
      var lt=(t-r.delay+LOOP*10)%LOOP;
      var prog=Math.min(1,lt/220);
      if(prog<=0||prog>=1)return;
      var startX=COLS[0].x*W+50;
      var startY=H*(0.28+(idx%3)*0.24);
      var targets=[
        {x:hubX,y:hubY},
        {x:COLS[2].x*W-40,y:H*(0.32+(idx%3)*0.24)},
        {x:COLS[3].x*W-40,y:H*(0.38+(idx%3)*0.2)}
      ];
      var seg=prog*2;
      var px,py;
      if(seg<1){
        px=startX+(hubX-startX)*seg;py=startY+(hubY-startY)*seg;
      }else{
        var s2=seg-1;
        var tx=idx===3?targets[2].x:targets[1].x;
        var ty=idx===3?targets[2].y:targets[1].y;
        px=hubX+(tx-hubX)*s2;py=hubY+(ty-hubY)*s2;
      }
      drawParticle(px,py,0.85,r.color);
      if(prog>0.85&&prog<0.95){
        cx.fillStyle=r.color;cx.font='9px Inter,sans-serif';cx.textAlign='center';
        cx.fillText(r.label,px,py-10);
      }
    });

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
  </section>

  <!-- H2 3 -->
  <section class="adr-section" id="vnedrenie-pod-klyuch">
    <div class="adr-cnt">
      <div class="adr-sh adr-left">
        <span class="adr-eyebrow">Под ключ</span>
        <h2>Внедрение AI для ресторана под ключ</h2>
        <p>Внедрение под ключ в формате Nero Network — это проект с фиксированной сметой, а не бесконечная подписка на SaaS-платформу. Внедрение AI агентов в контакт-центр ресторана по модели «под ключ» включает аудит, пилот, интеграции, обучение и запуск.</p>
      </div>

      <div class="adr-card nero-ai-reveal">
        <h3 id="audit-scenariev">Аудит сценариев и точек контакта с гостем</h3>
        <p>Старт — карта каналов: телефон, сайт, Telegram, WhatsApp, VK, агрегаторы. Считаем объём обращений по типам (бронь / доставка / FAQ), фиксируем POS, CRM, телефонию, правила эскалации. Результат аудита (3–5 дней) — приоритетный сценарий для пилота и чек-лист интеграций.</p>
      </div>

      <div class="adr-card nero-ai-reveal nero-ai-delay-1" style="margin-top:20px;">
        <h3 id="nastrojka-dialogov">Настройка диалогов и базы знаний (меню, политики)</h3>
        <p>На этапе настройки AI для ресторана собирается база знаний: меню с ценами и аллергенами, карта зала, зоны доставки, часы работы, скрипты банкетов, тон общения (TOV бренда). Диалоги проектируются как сценарии с интентами: бронь, заказ, статус, меню, жалоба, банкет.</p>
        <p>Проводится тест <strong>50+ диалогов</strong> с калибровкой порога эскалации. Ориентир рынка: <strong>60–90%</strong> типовых обращений без человека.</p>
      </div>

      <div class="adr-card nero-ai-reveal nero-ai-delay-2" style="margin-top:20px;">
        <h3 id="pilot-zapusk">Пилот, запуск и сопровождение</h3>
        <p>Рекомендуемый путь — <strong>гибридный запуск</strong>:</p>
        <ol>
          <li><strong>Пилот на одном канале</strong> (2–4 недели): входящая телефония «бронь + FAQ» ИЛИ Telegram «статус доставки».</li>
          <li><strong>Overflow-режим:</strong> AI подключается после 3–4 гудков, пока администратор занят.</li>
          <li><strong>Полная линия 24/7</strong> — после стабильных метрик на пилоте.</li>
        </ol>
        <p>Внедрение AI в бизнес процессы ресторана завершается передачей: документация, дашборд метрик, политика обработки персональных данных.</p>
        <p><strong>Лид-магнит Nero Network:</strong> документ «Сценарий AI-администратора ресторана» — готовая карта диалогов до заявки на внедрение.</p>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите понимать AI-автоматизацию до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI-администратора полезно разобраться в сценариях n8n, промптах и human-in-the-loop — так быстрее согласуете пилот с командой зала и call-центра. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- H2 4 -->
  <section class="adr-section adr-section-alt" id="integracii">
    <div class="adr-cnt">
      <div class="adr-sh">
        <span class="adr-eyebrow">Интеграции</span>
        <h2>Интеграции: CRM, телефония, мессенджеры, POS</h2>
        <p>Без связки с POS и CRM получается FAQ-бот, а не администратор. AI для ресторана с CRM и POS даёт сквозной цикл: звонок → действие → запись в учёт → уведомление команде.</p>
      </div>

      <div class="adr-card nero-ai-reveal">
        <h3 id="crm-restorana">CRM ресторана и учёт гостей</h3>
        <p>Интеграция AI для ресторана с CRM (amoCRM, Битрикс24) фиксирует каждый контакт: имя, телефон, история броней, источник, причина эскалации. Администратор видит карточку гостя до перевода звонка.</p>
      </div>

      <div class="adr-card nero-ai-reveal nero-ai-delay-1" style="margin-top:28px;">
        <h3 id="telefoniya-messendzhery">Телефония, Telegram/WhatsApp, сайт и агрегаторы доставки</h3>
        <p>Схема типового стека:</p>
        <div class="adr-stack-layer"><div class="adr-stack-label">Телефония</div><div><div class="adr-stack-val">Манго Офис, UIS, Zadarma, Sipuni</div><div class="adr-stack-desc">Входящая линия, overflow после 3–4 гудков</div></div></div>
        <div class="adr-stack-layer"><div class="adr-stack-label">AI-хаб</div><div><div class="adr-stack-val">Оркестратор + LLM + база знаний</div><div class="adr-stack-desc">Единый агент на голос и текст</div></div></div>
        <div class="adr-stack-layer"><div class="adr-stack-label">POS / бронь</div><div><div class="adr-stack-val">iiko, R-Keeper, Poster, Remarked</div><div class="adr-stack-desc">Слоты, стоп-лист, статус заказа в реальном времени</div></div></div>
        <div class="adr-stack-layer"><div class="adr-stack-label">CRM</div><div><div class="adr-stack-val">amoCRM, Битрикс24</div><div class="adr-stack-desc">Карточка гостя, аналитика конверсии</div></div></div>
        <div class="adr-stack-layer"><div class="adr-stack-label">Уведомления</div><div><div class="adr-stack-val">Telegram администратору</div><div class="adr-stack-desc">Эскалация, подтверждение брони, алерт о задержке</div></div></div>
        <p style="margin-top:20px;">Агрегаторы закрывают часть заказов, но <strong>прямые</strong> звонки и сайт дают более высокую маржу. AI-администратор обслуживает собственные каналы заведения.</p>
      </div>

      <div class="adr-card nero-ai-reveal nero-ai-delay-2" style="margin-top:20px;">
        <h3 id="pos-kuhnya">POS и операционные системы кухни</h3>
        <p>Модуль заказов и статусов работает через API iiko, R-Keeper, Poster. AI проверяет доступность блюда, актуальный стоп-лист, статус заказа. Модуль бронирования — через Remarked или API Poster.</p>
        <p>Технологический слой: STT/TTS (Yandex SpeechKit, ElevenLabs), LLM (YandexGPT, GPT-4, Claude), оркестратор (n8n, Make.com), векторное хранилище (Qdrant).</p>
      </div>
    </div>
  </section>

  <!-- H2 5 -->
  <section class="adr-section" id="dlya-kogo">
    <div class="adr-cnt">
      <div class="adr-sh">
        <span class="adr-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит: ресторан, кафе, доставка, банкеты</h2>
        <p>Решение масштабируется от одной точки до сети и особенно выгодно там, где нет отдельного call-центра.</p>
      </div>
      <div class="adr-grid-3 nero-ai-reveal">
        <div class="adr-card">
          <h3 id="restoran-kafe">Рестораны и кафе с залом</h3>
          <p>Основной сценарий — AI бронирование столиков + FAQ по меню. Подходит заведениям с потоком телефонных броней и вечерними пиками, когда зал загружен, а телефон не умолкает.</p>
        </div>
        <div class="adr-card nero-ai-delay-1">
          <h3 id="dostavka-dark-kitchen">Службы доставки и dark kitchen</h3>
          <p>Фокус — AI приём заказов, статус курьера, подтверждение адреса. Кейс «Тануки»: поэтапный rollout от подтверждений к полной линии. Dark kitchen получает «виртуального администратора» вместо расширения штата операторов.</p>
        </div>
        <div class="adr-card nero-ai-delay-2">
          <h3 id="bankety-event">Банкетные площадки и event-форматы</h3>
          <p>AI фильтрует входящий поток: дата, количество гостей, формат, бюджет, контакт — и <strong>переводит на менеджера банкетов</strong> с заполненной карточкой. Снимает первичный опрос с администратора.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 6 -->
  <section class="adr-section adr-section-alt" id="keisy">
    <div class="adr-cnt">
      <div class="adr-sh">
        <span class="adr-eyebrow">Кейсы HoReCa</span>
        <h2>Кейсы и примеры внедрения AI в HoReCa</h2>
        <p>Кейсы внедрения AI в ресторанной нише — уже не гипотеза. Ниже — проверяемые ориентиры из России и международной практики.</p>
      </div>

      <div class="adr-stat-grid nero-ai-reveal" aria-label="Метрики кейсов">
        <div class="adr-stat-card"><div class="num">70%</div><div class="lbl">автообработка<br>Fromtech, сеть</div></div>
        <div class="adr-stat-card"><div class="num">0%</div><div class="lbl">пропущенных звонков<br>бронирование</div></div>
        <div class="adr-stat-card"><div class="num">~90%</div><div class="lbl">без человека<br>Тануки / доставка</div></div>
        <div class="adr-stat-card"><div class="num">$250k</div><div class="lbl">after-hours брони<br>Melting Pot / PolyAI</div></div>
      </div>

      <div class="adr-card nero-ai-reveal" style="margin-top:32px;">
        <h3 id="metriki-keisy">Метрики: время ответа, конверсия брони, снижение нагрузки на линию</h3>
        <p><strong>Россия:</strong> Fromtech — <strong>70%</strong> авто, нагрузка на КЦ <strong>↓ в 3,5 раза</strong>, <strong>0%</strong> пропущенных; виртуальный помощник — <strong>82%</strong> звонков роботом; TWIN / «Тануки» — <strong>~90%</strong> без человека, расходы на подтверждение <strong>↓ в 3 раза</strong>; AI-метрдотель (ADPASS) — бронь, меню, депозиты на свободном языке.</p>
        <p><strong>Международные ориентиры:</strong> The Melting Pot — <strong>68%</strong> reservation-звонков, <strong>$250k</strong> выручки; Big Table Group — <strong>3800+</strong> броней/мес; Domino's — <strong>~80%</strong> phone-orders; Stinking Rose — <strong>80%</strong> resolved, <strong>117%</strong> рост covers.</p>
        <p>McKinsey (цит. IBM): внедрение AI-агентов в контакт-центры — <strong>~50%</strong> снижение cost per call при росте CSAT.</p>
      </div>

      <div class="adr-card nero-ai-reveal nero-ai-delay-1" style="margin-top:20px;">
        <h3 id="oshibki-zapusk">Типовые ошибки и как их избежать при запуске</h3>
        <ol>
          <li><strong>Запуск без интеграции с POS</strong> — AI отвечает «из головы». Решение: синхронизация стоп-листа и цен.</li>
          <li><strong>Сразу 100% линии без пилота</strong> — страх персонала. Решение: overflow → пилот → 24/7.</li>
          <li><strong>Роботизированный голос</strong> — абоненты бросают трубку (кейс Domino's). Решение: естественный TTS, быстрый fallback.</li>
          <li><strong>Нет эскалации с контекстом</strong> — гость повторяет всё заново. Решение: warm transfer с логом.</li>
          <li><strong>Игнорирование 152-ФЗ</strong> — штрафы с 30.05.2025. Решение: согласие, политика, хостинг в РФ.</li>
        </ol>
      </div>
    </div>
  </section>

  <!-- H2 7 -->
  <section class="adr-section" id="stoimost">
    <div class="adr-cnt">
      <div class="adr-sh adr-left">
        <span class="adr-eyebrow">Стоимость</span>
        <h2>Стоимость внедрения AI для ресторана</h2>
        <p>Собственнику нужен ориентир по бюджету до заявки — ниже разложим смету по этапам. Внедрение AI в бизнес ресторана в формате Nero Network — проект с прозрачной сметой.</p>
      </div>

      <div class="adr-table-wrap nero-ai-reveal">
        <table class="adr-table" aria-label="Этапы проекта и содержание">
          <thead>
            <tr><th scope="col">Этап</th><th scope="col">Содержание</th></tr>
          </thead>
          <tbody>
            <tr><td>Аудит (3–5 дней)</td><td>Каналы, объёмы, POS/CRM, приоритет сценария</td></tr>
            <tr><td>Проектирование</td><td>Диалоги, база знаний, регламент эскалации</td></tr>
            <tr><td>Интеграции</td><td>Телефония, POS, CRM, мессенджеры</td></tr>
            <tr><td>Пилот и тесты</td><td>50+ диалогов, калибровка</td></tr>
            <tr><td>Запуск</td><td>Overflow → полная линия</td></tr>
            <tr><td>Сопровождение</td><td>Метрики, обновление меню, доработка сценариев</td></tr>
          </tbody>
        </table>
      </div>

      <div class="adr-card nero-ai-reveal" style="margin-top:28px;">
        <h3 id="chek-100-300">Ориентир чека 100–300 тыс. ₽ и факторы цены</h3>
        <p>Ориентир чека на внедрение AI для ресторана под ключ — <strong>100–300 тыс. ₽</strong> в зависимости от:</p>
        <ul>
          <li>количества каналов (только телефон vs телефон + Telegram + WhatsApp);</li>
          <li>глубины интеграций (одна POS vs iiko + Remarked + CRM);</li>
          <li>голосового стека (базовый SpeechKit vs премиум-голос);</li>
          <li>числа точек (одна vs сеть);</li>
          <li>сценариев (только бронь vs бронь + доставка + NPS).</li>
        </ul>
        <p>Сравнение с альтернативой: один FTE оператора call-центра — постоянные затраты. AI-администратор окупает проект за счёт возврата пропущенных броней; для сети ориентир потерь — до <strong>35 млн ₽/год</strong> (Nodul).</p>
      </div>
    </div>
  </section>

  <!-- H2 8 FAQ -->
  <section class="adr-section adr-section-alt" id="faq">
    <div class="adr-cnt">
      <div class="adr-sh">
        <span class="adr-eyebrow">FAQ</span>
        <h2>FAQ — как внедрить AI для ресторана</h2>
      </div>

      <div class="adr-faq nero-ai-reveal" data-adr-faq>
        <div class="adr-faq-item open">
          <div class="adr-faq-q" tabindex="0" role="button" aria-expanded="true">Сколько времени занимает запуск?</div>
          <div class="adr-faq-a">Пилот на одном сценарии — <strong>2–4 недели</strong>. Полноценное внедрение AI решений с несколькими каналами — <strong>4–8 недель</strong>. Аудит занимает 3–5 дней и может стартовать сразу после брифа.</div>
        </div>
        <div class="adr-faq-item">
          <div class="adr-faq-q" tabindex="0" role="button" aria-expanded="false">Что если гость задаёт нестандартный вопрос?</div>
          <div class="adr-faq-a">AI классифицирует интент. При низкой уверенности, негативе, банкете на N+ гостей, VIP или жалобе — <strong>мгновенный перевод на оператора</strong> с контекстом. По кейсам Fromtech <strong>30%</strong> обращений изначально проектируются на эскалацию.</div>
        </div>
        <div class="adr-faq-item">
          <div class="adr-faq-q" tabindex="0" role="button" aria-expanded="false">Как обрабатываются персональные данные (152-ФЗ)?</div>
          <div class="adr-faq-a">Обязательно: политика ПДн и согласие; уведомление Роскомнадзора (с <strong>30.05.2025</strong>); хранение в РФ (ограничения с <strong>01.07.2025</strong>); право гостя на удаление. Compliance-модуль входит в проект Nero Network.</div>
        </div>
        <div class="adr-faq-item">
          <div class="adr-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли начать с одного канала?</div>
          <div class="adr-faq-a">Да, это рекомендуемый путь: сначала «бронь + FAQ по телефону» или «статус доставки в Telegram», затем остальные каналы. Так снижается риск и быстрее виден ROI.</div>
        </div>
        <div class="adr-faq-item">
          <div class="adr-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI живого администратора?</div>
          <div class="adr-faq-a">Нет. AI закрывает рутину 24/7; люди — банкеты, эмоции, исключения. IBM: успешная автоматизация — «не о замене людей, а об интеллектуальной оптимизации процессов».</div>
        </div>
        <div class="adr-faq-item">
          <div class="adr-faq-q" tabindex="0" role="button" aria-expanded="false">Ошибётся ли бот в заказе?</div>
          <div class="adr-faq-a">Риск снижается read-back заказа, проверкой по POS и лимитом автономии. Human-in-the-loop для сложных модификаторов.</div>
        </div>
        <div class="adr-faq-item">
          <div class="adr-faq-q" tabindex="0" role="button" aria-expanded="false">У нас уже есть агрегаторы — зачем AI?</div>
          <div class="adr-faq-a">Агрегаторы не снимают прямые звонки и заказы с сайта, где маржа выше. AI-администратор обслуживает <strong>собственные</strong> каналы.</div>
        </div>
        <div class="adr-faq-item">
          <div class="adr-faq-q" tabindex="0" role="button" aria-expanded="false">Нужен ли программист в штате?</div>
          <div class="adr-faq-a">Нет. Внедрение AI для ресторана под ключ включает настройку, интеграции и обучение команды.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Итог -->
  <section class="adr-section" id="itog" aria-label="Итог">
    <div class="adr-cnt">
      <div class="adr-card nero-ai-reveal">
        <h2 style="font-size:clamp(22px,3vw,32px);">Итог</h2>
        <p>AI-администратор для ресторана и доставки — это внедрение AI агентов на входящую линию и в мессенджеры: бронь столиков, ответы по меню, статус заказа, эскалация на живого сотрудника. Российские и международные кейсы показывают <strong>0%</strong> пропущенных звонков, <strong>60–90%</strong> автономии на типовых сценариях и измеримый рост выручки с телефонных броней.</p>
        <p>Nero Network реализует проект под ключ: аудит → пилот → интеграции с iiko, Remarked, CRM и телефонией → запуск с compliance по 152-ФЗ. Ориентир инвестиций — <strong>100–300 тыс. ₽</strong>.</p>
        <p><strong>Получите сценарий AI-администратора ресторана</strong> — готовую карту диалогов для вашего заведения. Это первый шаг до заявки на внедрение.</p>
      </div>

      <aside class="ym-cta-block ym-cta-block--dual ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы внедрить AI-администратора под ключ?</p>
          <p class="ym-cta-block__sub">Аудит каналов, пилот на одном сценарии, интеграции с iiko, Remarked и CRM, запуск с compliance по 152-ФЗ. Ориентир инвестиций — 100–300 тыс. ₽.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Читать FAQ</a>
          </div>
        </div>
      </aside>
    </div>
  </section>

</div><!-- /.adr-content -->

<script>
(function(){
  document.querySelectorAll('[data-adr-faq] .adr-faq-q').forEach(function(q){
    q.addEventListener('click',function(){
      var item=q.parentElement,open=item.classList.contains('open');
      item.parentElement.querySelectorAll('.adr-faq-item').forEach(function(i){
        i.classList.remove('open');
        i.querySelector('.adr-faq-q').setAttribute('aria-expanded','false');
      });
      if(!open){item.classList.add('open');q.setAttribute('aria-expanded','true');}
    });
  });
})();
</script>
<?php
$rest_page_url = trailingslashit( get_permalink() );
$rest_site_url = trailingslashit( home_url( '/' ) );
$rest_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$rest_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $rest_site_url . '#organization',
      'name'  => $rest_brand,
      'url'   => $rest_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $rest_site_url . '#website',
      'url'       => $rest_site_url,
      'name'      => $rest_brand,
      'publisher' => [ '@id' => $rest_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $rest_page_url . '#webpage',
      'url'         => $rest_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $rest_site_url . '#website' ],
      'about'       => [ '@id' => $rest_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $rest_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $rest_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $rest_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $rest_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $rest_page_url,
      'provider'    => [ '@id' => $rest_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $rest_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Сколько времени занимает запуск?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Пилот на одном сценарии — 2–4 недели. Полноценное внедрение AI решений с несколькими каналами — 4–8 недель. Аудит занимает 3–5 дней и может стартовать сразу после брифа.' ] ],
        [ '@type' => 'Question', 'name' => 'Что если гость задаёт нестандартный вопрос?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'AI классифицирует интент. При низкой уверенности, негативе, банкете на N+ гостей, VIP или жалобе — мгновенный перевод на оператора с контекстом. По кейсам Fromtech 30% обращений изначально проектируются на эскалацию.' ] ],
        [ '@type' => 'Question', 'name' => 'Как обрабатываются персональные данные (152-ФЗ)?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Обязательно: политика ПДн и согласие; уведомление Роскомнадзора (с 30.05.2025); хранение в РФ (ограничения с 01.07.2025); право гостя на удаление. Compliance-модуль входит в проект Nero Network.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли начать с одного канала?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, это рекомендуемый путь: сначала «бронь + FAQ по телефону» или «статус доставки в Telegram», затем остальные каналы. Так снижается риск и быстрее виден ROI.' ] ],
        [ '@type' => 'Question', 'name' => 'Заменит ли AI живого администратора?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. AI закрывает рутину 24/7; люди — банкеты, эмоции, исключения. IBM: успешная автоматизация — «не о замене людей, а об интеллектуальной оптимизации процессов».' ] ],
        [ '@type' => 'Question', 'name' => 'Ошибётся ли бот в заказе?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Риск снижается read-back заказа, проверкой по POS и лимитом автономии. Human-in-the-loop для сложных модификаторов.' ] ],
        [ '@type' => 'Question', 'name' => 'У нас уже есть агрегаторы — зачем AI?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Агрегаторы не снимают прямые звонки и заказы с сайта, где маржа выше. AI-администратор обслуживает собственные каналы.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужен ли программист в штате?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. Внедрение AI для ресторана под ключ включает настройку, интеграции и обучение команды.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $rest_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-dlya-restorana-page') || document.querySelector('.adr-content');
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

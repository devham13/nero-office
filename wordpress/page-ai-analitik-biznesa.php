<?php
/**
 * Template Name: AI-аналитик бизнеса: дашборд и отчёты для собственника под ключ
 * Description: Внедряем AI-аналитик бизнеса: CRM, 1С и реклама в одном дашборде. Ежедневные выводы, риски и действия для собственника.
 */

$page_seo_title       = 'AI-аналитик бизнеса: дашборд и отчёты для собственника под ключ';
$page_seo_description = 'Внедряем AI-аналитик бизнеса: CRM, 1С и реклама в одном дашборде. Каждый день — выводы, риски и действия для собственника. Получите пример отчёта.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение',    'href' => '#etapy'],
    ['label' => 'Сравнение',    'href' => '#sravnenie'],
    ['label' => 'Кейсы',        'href' => '#keisy'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить пример отчёта';
$primary_cta_url = nero_ai_primary_cta_url();
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

.aab-hero-analitik {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.aab-content{
  --aab-bg:#050711;--aab-bg2:#080b17;
  --aab-surface:rgba(255,255,255,.072);--aab-surface2:rgba(255,255,255,.108);
  --aab-text:#e6edf7;--aab-muted:#9aa8bd;--aab-soft:#c7d2e5;--aab-heading:#fff;
  --aab-border:rgba(255,255,255,.10);--aab-border-s:rgba(255,255,255,.18);
  --aab-accent:#79f2ff;--aab-violet:#8b5cf6;--aab-green:#22c55e;--aab-cyan:#79f2ff;
  --aab-btn-from:#06b6d4;--aab-btn-to:#8b5cf6;
  --aab-shadow:0 24px 72px rgba(0,0,0,.4);
  --aab-r:18px;--aab-r-lg:24px;--aab-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aab-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aab-content *,.aab-content *::before,.aab-content *::after{box-sizing:border-box;}
.aab-content a{color:inherit;text-decoration:none;}
.aab-content p{color:var(--aab-muted);line-height:1.72;margin:0 0 1em;text-align:left;}
.aab-content p:last-child{margin-bottom:0;}
.aab-content h2,.aab-content h3,.aab-content h4{color:var(--aab-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.aab-content strong{color:var(--aab-soft);}
.aab-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aab-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aab-muted);font-size:14.5px;line-height:1.65;text-align:left;}
.aab-content ul li::before{content:'›';position:absolute;left:0;color:var(--aab-accent);font-weight:700;}
.aab-cnt{width:min(var(--aab-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aab-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aab-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aab-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aab-sh.aab-left{margin-left:0;text-align:left;}
.aab-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aab-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aab-sh.aab-left p{margin-left:0;}
.aab-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aab-accent);margin-bottom:14px;}
.aab-gt{background:linear-gradient(92deg,#fff 0%,var(--aab-accent) 44%,var(--aab-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.aab-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.aab-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.aab-intro-text{position:relative;padding-left:20px;text-align:left;}
.aab-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aab-accent),var(--aab-violet));}
.aab-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--aab-muted);margin-bottom:1em;}
.aab-intro-text p:last-child{margin-bottom:0;color:var(--aab-soft);}
.aab-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aab-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.aab-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aab-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.aab-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aab-muted);line-height:1.4;}
.aab-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.aab-intro-grid{grid-template-columns:1fr;gap:36px;}.aab-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.aab-intro-kpi{grid-template-columns:1fr 1fr;}}
.aab-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aab-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aab-toc a{display:inline-block;padding:9px 18px;background:var(--aab-surface);border:1px solid var(--aab-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aab-muted);transition:border-color .2s,color .2s,background .2s;}
.aab-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--aab-accent);background:rgba(121,242,255,.08);}
.aab-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aab-border);border-radius:var(--aab-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.aab-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.aab-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aab-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.aab-grid-2,.aab-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.aab-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aab-grid-3{grid-template-columns:1fr;}}
.aab-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--aab-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.aab-scenario:last-child{margin-bottom:0;}
.aab-scenario:hover{border-color:rgba(121,242,255,.3);}
.aab-scenario h3{font-size:17px;margin-bottom:8px;}
.aab-scenario p{font-size:14.5px;margin:0 0 .6em;}
.aab-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aab-table{width:100%;border-collapse:collapse;font-size:14px;}
.aab-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--aab-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.aab-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aab-text);vertical-align:top;}
.aab-table tr:last-child td{border-bottom:none;}
.aab-table tr:hover td{background:rgba(255,255,255,.03);}
.aab-timeline{position:relative;padding-left:40px;}
.aab-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aab-accent),var(--aab-violet));opacity:.35;border-radius:2px;}
.aab-tl-item{position:relative;margin-bottom:32px;}
.aab-tl-item:last-child{margin-bottom:0;}
.aab-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--aab-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.aab-tl-item h3{font-size:17px;margin-bottom:8px;}
.aab-tl-item p{font-size:14.5px;margin:0;}
.aab-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.aab-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aab-case-grid{grid-template-columns:1fr;}}
.aab-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.aab-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.aab-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aab-green);margin-bottom:10px;}
.aab-case-card h3{font-size:16px;margin-bottom:14px;}
.aab-terminal{background:#0a0e1c;border:1px solid rgba(121,242,255,.2);border-radius:14px;padding:20px 22px;font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:12.5px;line-height:1.65;color:#c7d2e5;overflow-x:auto;margin:20px 0;}
.aab-terminal .t-dim{color:#64748b;}
.aab-terminal .t-warn{color:#fbbf24;}
.aab-terminal .t-ok{color:#4ade80;}
.aab-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aab-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.aab-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aab-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.aab-faq-q::after{content:'▾';font-size:13px;color:var(--aab-accent);flex-shrink:0;transition:transform .25s;}
.aab-faq-item.open .aab-faq-q::after{transform:rotate(180deg);}
.aab-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--aab-muted);line-height:1.72;}
.aab-faq-item.open .aab-faq-a{max-height:800px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--aab-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--aab-btn-from),var(--aab-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(6,182,212,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--aab-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--aab-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-analitik-biznesa-page" role="main" tabindex="-1">

<section class="nero-ai-hero aab-hero-analitik" id="hero" aria-labelledby="aab-hero-title">
<style>
/* ── Hero ai-analitik-biznesa: самодостаточные стили (без CSS темы) ── */
.aab-hero-analitik {
  --aab-cyan: #79f2ff;
  --aab-violet: #8b5cf6;
  --aab-green: #22c55e;
  --aab-amber: #f59e0b;
  --aab-text: #e6edf7;
  --aab-muted: #9aa8bd;
  --aab-soft: #c7d2e5;
  --aab-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aab-hero-analitik::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(121, 242, 255, 0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(121, 242, 255, 0.04) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 62% 32%, #000 0%, transparent 72%);
  opacity: 0.55;
  pointer-events: none;
  z-index: -2;
}
.aab-hero-analitik::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, 0.14), transparent 66%);
  filter: blur(8px);
  animation: aabHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aabHeroGlow {
  from { opacity: 0.35; transform: scale(0.95); }
  to { opacity: 0.78; transform: scale(1.05); }
}
.aab-hero-analitik .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aab-hero-analitik .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, 0.95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aab-hero-analitik .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: 0.98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aab-hero-analitik .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aab-cyan) 38%, var(--aab-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aab-hero-analitik .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aab-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aab-hero-analitik .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aab-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aab-hero-analitik .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aab-hero-analitik .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 8px 11px;
  border: 1px solid rgba(255, 255, 255, 0.11);
  border-radius: 999px;
  background: rgba(255, 255, 255, 0.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.aab-hero-analitik .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aab-hero-analitik .nero-ai-btn {
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
  transition: transform 0.22s ease, border-color 0.22s ease, background 0.22s ease;
}
.aab-hero-analitik .nero-ai-btn:hover { transform: translateY(-2px); }
.aab-hero-analitik .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--aab-cyan), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aab-hero-analitik .nero-ai-btn-secondary {
  color: var(--aab-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aab-hero-analitik .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aab-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.aab-hero-analitik .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, 0.95), rgba(6, 10, 24, 0.96));
}
.aab-hero-analitik .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.045);
}
.aab-hero-analitik .nero-ai-dots { display: flex; gap: 7px; }
.aab-hero-analitik .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aab-hero-analitik .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aab-hero-analitik .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aab-hero-analitik .nero-ai-dot:nth-child(3) { background: #34d399; }
.aab-hero-analitik .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}
.aab-hero-analitik .nero-ai-window-body { padding: 16px; }
.aab-hero-analitik .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aab-hero-analitik .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aab-hero-analitik .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.1);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.aab-hero-analitik .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.14);
  animation: aabPulse 1.6s infinite;
}
@keyframes aabPulse {
  0%, 100% { transform: scale(0.86); opacity: 0.65; }
  50% { transform: scale(1); opacity: 1; }
}
.aab-hero-analitik .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aab-hero-analitik .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255, 255, 255, 0.09);
  border-radius: 16px;
  background: rgba(255, 255, 255, 0.055);
}
.aab-hero-analitik .nero-ai-metric span {
  display: block;
  color: var(--aab-muted);
  font-size: 11px;
  font-weight: 700;
}
.aab-hero-analitik .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aab-hero-analitik .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aab-hero-analitik .aab-dash-canvas-wrap {
  position: relative;
  height: clamp(210px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: radial-gradient(ellipse at 50% 42%, rgba(139, 92, 246, 0.1), rgba(6, 10, 24, 0.92) 72%);
}
.aab-hero-analitik #aab-analitik-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aab-hero-analitik .aab-phase-pill {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 10px;
}
.aab-hero-analitik .aab-phase-pill span {
  padding: 6px 10px;
  border-radius: 999px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  background: rgba(255, 255, 255, 0.04);
  color: #b8c8de;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 0.04em;
  text-transform: uppercase;
}
.aab-hero-analitik .nero-ai-task-stream { display: grid; gap: 8px; }
.aab-hero-analitik .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.04);
}
.aab-hero-analitik .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121, 242, 255, 0.12);
  color: var(--aab-cyan);
  font-size: 11px;
  font-weight: 800;
}
.aab-hero-analitik .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aab-hero-analitik .nero-ai-task span {
  color: var(--aab-muted);
  font-size: 11px;
}
.aab-hero-analitik .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aab-hero-analitik .nero-ai-status--risk {
  background: rgba(245, 158, 11, 0.14);
  color: #fde68a;
}
.aab-hero-analitik .nero-ai-status--ai {
  background: rgba(139, 92, 246, 0.16);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .aab-hero-analitik .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aab-hero-analitik .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aab-hero-analitik .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aab-hero-analitik .nero-ai-window-body { padding: 12px; }
  .aab-hero-analitik .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aab-hero-analitik .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai аналитик бизнеса</p>
      <h1 id="aab-hero-title">AI-аналитик бизнеса: управленческие отчёты и дашборд для собственника <span class="nero-ai-gradient-text">под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI собирает данные из CRM, 1С и таблиц и каждый день показывает выводы, риски и действия — без ручной сводки отчётов</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Под ключ</li>
        <li class="nero-ai-badge">CRM + 1С</li>
        <li class="nero-ai-badge">Ежедневный брифинг</li>
        <li class="nero-ai-badge">Telegram</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Получить пример отчёта'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-брифинг для собственника">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-брифинг за сегодня</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Выручка</span>
              <strong>1,24 млн</strong>
              <small>−8% к плану · 1С</small>
            </div>
            <div class="nero-ai-metric">
              <span>Маржа</span>
              <strong>34,2%</strong>
              <small>−2,1 п.п. · скидки</small>
            </div>
            <div class="nero-ai-metric">
              <span>Лиды</span>
              <strong>47</strong>
              <small>amoCRM · воронка</small>
            </div>
            <div class="nero-ai-metric">
              <span>Риски</span>
              <strong>3</strong>
              <small>алерт собственнику</small>
            </div>
          </div>

          <div class="aab-phase-pill" aria-hidden="true">
            <span>Сбор</span>
            <span>Витрина KPI</span>
            <span>AI-брифинг</span>
            <span>Telegram</span>
          </div>

          <div class="aab-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aab-analitik-hero-canvas" role="img" aria-label="Анимация: потоки из CRM, 1С и рекламы сходятся в кокпит AI-аналитика и уходят брифингом в Telegram"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента рисков и рекомендаций">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">1С</span>
              <div><strong>Дебиторка +340 тыс. ₽</strong><span>риск кассового разрыва к 20.06</span></div>
              <span class="nero-ai-status nero-ai-status--risk">риск</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Конверсия 12% → 9%</strong><span>просадка на этапе «КП»</span></div>
              <span class="nero-ai-status nero-ai-status--risk">риск</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>5 действий на сегодня</strong><span>эффект в ₽ · источники проверены</span></div>
              <span class="nero-ai-status nero-ai-status--ai">брифинг</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="aab-content">

  <section class="aab-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="aab-cnt">
      <div class="aab-intro-grid nero-ai-reveal">
        <div class="aab-intro-text">
          <p class="aab-eyebrow">Лонгрид · ai аналитик бизнеса</p>
          <p><strong>Коротко:</strong> AI-аналитик бизнеса — это управленческий слой поверх CRM, 1С, таблиц и рекламы, который каждый день отдаёт собственнику выводы, риски и конкретные действия в рублях. Не ещё один график, а ежедневный брифинг за 3 минуты.</p>
          <p>Собственник, директор или финансовый руководитель получает единую картину вместо десятка разрозненных файлов. Коммерческий оффер услуги «под ключ»: AI собирает данные и каждый день показывает выводы, риски и действия — без ручной сводки отчётов.</p>
        </div>
        <div class="aab-intro-kpi" aria-label="Ключевые метрики управленки">
          <div class="aab-kpi-card"><div class="kv">3 мин</div><div class="kl">утренний брифинг</div><div class="ks">вместо часов Excel</div></div>
          <div class="aab-kpi-card"><div class="kv">3+2+5</div><div class="kl">риски · возможности · действия</div><div class="ks">формат отчёта</div></div>
          <div class="aab-kpi-card"><div class="kv">CRM+1С</div><div class="kl">единая витрина KPI</div><div class="ks">API/OData</div></div>
          <div class="aab-kpi-card"><div class="kv">250к–1,2М</div><div class="kl">ориентир проекта</div><div class="ks">под ключ</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aab-toc-outer">
    <div class="aab-cnt">
      <nav class="aab-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Внедрение</a>
        <a href="#sravnenie">Сравнение с BI</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#bezopasnost">Безопасность</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="aab-section" id="intro-detail">
    <div class="aab-cnt">
      <div class="aab-sh aab-left nero-ai-reveal">
        <span class="aab-eyebrow">Что получает собственник</span>
        <h2>AI-аналитик бизнеса — что получает собственник вместо разрозненных отчётов</h2>
        <p><strong>Определение.</strong> AI-аналитик бизнеса для собственника — не «ещё один дашборд» и не чат с ChatGPT поверх Excel. Это настроенный контур: данные из учётных и коммерческих систем собираются автоматически, KPI пересчитываются по прозрачным правилам, а языковая модель формирует <strong>ежедневные управленческие выводы</strong>.</p>
      </div>

      <div class="aab-grid-3 nero-ai-reveal">
        <div class="aab-card">
          <h3>Чем AI-дашборд отличается от Excel</h3>
          <p>Excel хорош для хранения, но плох как операционный инструмент руководителя: цифры устаревают, формулы ломаются, версии расходятся.</p>
        </div>
        <div class="aab-card nero-ai-delay-1">
          <h3>Единая витрина KPI</h3>
          <p>CRM, 1С, реклама, банк — данные подтягиваются по расписанию (ETL/API), а не по дисциплине сотрудников.</p>
        </div>
        <div class="aab-card nero-ai-delay-2">
          <h3>Выводы, а не только графики</h3>
          <p>AI формирует брифинг: риски, возможности, действия. Цифры из API/SQL; LLM пишет текст, не считает.</p>
        </div>
      </div>

      <div class="aab-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aab-table">
          <thead><tr><th>Критерий</th><th>Excel / ручная сводка</th><th>AI-аналитик бизнеса</th></tr></thead>
          <tbody>
            <tr><td>Актуальность</td><td>Зависит от дисциплины</td><td>Данные по расписанию (ETL/API)</td></tr>
            <tr><td>Выводы</td><td>Собственник интерпретирует сам</td><td>AI: риски, возможности, действия</td></tr>
            <tr><td>Источники</td><td>Разрозненные файлы</td><td>CRM, 1С, реклама, банк</td></tr>
            <tr><td>Ad-hoc вопросы</td><td>Новая сводка = часы</td><td>Вопрос на естественном языке → витрина</td></tr>
            <tr><td>Достоверность</td><td>Ошибки в формулах</td><td>Цифры из API; LLM не считает</td></tr>
          </tbody>
        </table>
      </div>

      <div class="aab-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Какие управленческие вопросы закрывает система</h3>
        <ul>
          <li><strong>Выручка и маржа:</strong> что изменилось за сутки/неделю, в каком канале просадка.</li>
          <li><strong>Воронка продаж (ai анализ продаж):</strong> где «застревают» сделки, кто отстаёт от плана.</li>
          <li><strong>Дебиторка и касса:</strong> ранние сигналы кассового разрыва, рост просрочки.</li>
          <li><strong>Маркетинг:</strong> связка расходов на Директ/VK с лидами и оплатами из CRM.</li>
          <li><strong>Команда:</strong> отклонения от плановых KPI без ожидания месячного закрытия.</li>
        </ul>
        <p>Формат ответа — <strong>«3 риска, 2 возможности, 5 действий с эффектом в ₽»</strong>, а не «посмотрите на график».</p>
      </div>
    </div>
  </section>

  <section class="aab-section aab-section-alt" id="problema">
    <div class="aab-cnt">
      <div class="aab-sh nero-ai-reveal">
        <span class="aab-eyebrow">Боль собственника</span>
        <h2>Проблема: данные есть в CRM, 1С и рекламе — выводов нет</h2>
        <p>Главная боль: <strong>данные есть в разных системах, но нет понятных выводов</strong>. Собственник платит за CRM, учёт, рекламу — и всё равно каждое утро собирает «правду» вручную.</p>
      </div>

      <div class="aab-grid-2 nero-ai-reveal">
        <div class="aab-scenario">
          <h3>Почему классические отчёты не дают ежедневных действий</h3>
          <p>Power BI, DataLens и отчёты 1С показывают метрики. Собственнику нужен слой <strong>интерпретации и приоритизации</strong>: задержка, разные цифры в отделах, нет «что делать», зависимость от аналитика в штате.</p>
        </div>
        <div class="aab-scenario">
          <h3>Сколько времени теряется на «сборку картины»</h3>
          <p>Паттерн: <strong>1–3 часа в неделю</strong> на выгрузки и сверку — это <strong>50–150 часов в год</strong>. Время, которое можно тратить на стратегию, а не на Excel.</p>
        </div>
      </div>

      <div class="aab-card nero-ai-reveal" style="margin-top:24px;">
        <p>По обзору «Яков и Партнёры» + Яндекс (2025): <strong>71%</strong> крупных компаний используют gen AI; <strong>78%</strong> отмечают финансовую отдачу. Но лишь <strong>~4%</strong> довели кейс до полного внедрения — главная причина: отсутствие data layer и ROI-модели.</p>
        <p>Первый шаг к ежедневному брифингу — собрать проверяемый data layer из учётных и коммерческих систем: без этого AI останется экспериментом с ChatGPT. На практике начинают с контура <a href="https://meta-journal.ru/ai-1c-erp/">AI-агент для 1С и ERP</a> — read-only OData/API и нормализованные KPI для витрины аналитики.</p>
      </div>
    </div>
  </section>

<section id="ai-analitik-biznesa-boris-block" class="aab-root" aria-label="Демо: ежедневный AI-брифинг собственника — KPI, риски и действия">
<style>
/* === БОРИС: prefix aab-, scoped внутри #ai-analitik-biznesa-boris-block === */
#ai-analitik-biznesa-boris-block.aab-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-analitik-biznesa-boris-block .aab-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-analitik-biznesa-boris-block .aab-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:520px;
}
@media(max-width:1023px){
  #ai-analitik-biznesa-boris-block .aab-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-analitik-biznesa-boris-block .aab-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-analitik-biznesa-boris-block .aab-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-analitik-biznesa-boris-block .aab-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#7c3aed;
  margin:0 0 14px;
}
#ai-analitik-biznesa-boris-block .aab-ey::before{
  content:'';
  width:18px;height:2px;
  background:linear-gradient(90deg,#79f2ff,#8b5cf6);
  border-radius:1px;
}
#ai-analitik-biznesa-boris-block .aab-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 16px;
}
#ai-analitik-biznesa-boris-block .aab-lead{
  font-size:14px;
  line-height:1.55;
  color:#475569;
  margin:0 0 18px;
}
#ai-analitik-biznesa-boris-block .aab-ul{
  list-style:none;
  margin:0 0 20px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-analitik-biznesa-boris-block .aab-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-analitik-biznesa-boris-block .aab-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(121,242,255,.12);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0e7490;
  margin-top:1px;
  font-style:normal;
}
#ai-analitik-biznesa-boris-block .aab-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:16px;
}
#ai-analitik-biznesa-boris-block .aab-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-analitik-biznesa-boris-block .aab-pl-c{
  background:rgba(121,242,255,.1);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.35);
}
#ai-analitik-biznesa-boris-block .aab-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-analitik-biznesa-boris-block .aab-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-analitik-biznesa-boris-block .aab-integrations{
  display:flex;
  flex-wrap:wrap;
  gap:6px;
  margin-bottom:18px;
}
#ai-analitik-biznesa-boris-block .aab-int{
  padding:4px 10px;
  border-radius:8px;
  font-size:11px;
  font-weight:600;
  color:#475569;
  background:#f1f5f9;
  border:1px solid #e2e8f0;
}
#ai-analitik-biznesa-boris-block .aab-vs{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:8px;
  margin-bottom:18px;
}
#ai-analitik-biznesa-boris-block .aab-vs-col{
  padding:10px 12px;
  border-radius:12px;
  font-size:11px;
  line-height:1.45;
}
#ai-analitik-biznesa-boris-block .aab-vs-col--old{
  background:#fef2f2;
  border:1px solid #fecaca;
  color:#991b1b;
}
#ai-analitik-biznesa-boris-block .aab-vs-col--new{
  background:rgba(121,242,255,.08);
  border:1px solid rgba(121,242,255,.35);
  color:#0e7490;
}
#ai-analitik-biznesa-boris-block .aab-vs-col strong{
  display:block;
  font-size:12px;
  margin-bottom:4px;
}
#ai-analitik-biznesa-boris-block .aab-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-analitik-biznesa-boris-block .aab-rgt{
  position:relative;
  background:linear-gradient(135deg,#f0f9ff 0%,#ede9fe 35%,#f8fafc 100%);
  min-height:460px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-analitik-biznesa-boris-block .aab-rgt{min-height:400px;}
}
#aab-briefing-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="aab-cnt">
  <div class="aab-card">

    <div class="aab-lft">
      <span class="aab-ey">AI dashboard · ежедневный отчёт</span>
      <h3 class="aab-h3">Утренний брифинг за 3 минуты: выводы, риски и действия в рублях</h3>
      <p class="aab-lead">Не графики ради графиков — готовый управленческий ответ: что изменилось, где риск, какой шаг даст эффект. Цифры только из API/OData, текст формирует AI.</p>
      <ul class="aab-ul">
        <li><span class="aab-ic">1</span>Сводка KPI за 24 часа: выручка, маржа, лиды — к плану и прошлому периоду</li>
        <li><span class="aab-ic">⚠</span>3 риска с источником данных и порогом отклонения</li>
        <li><span class="aab-ic">✓</span>5 действий на сегодня с оценкой эффекта в ₽</li>
        <li><span class="aab-ic">↗</span>Доставка в Telegram — собственник читает без входа в BI</li>
      </ul>
      <div class="aab-pills">
        <span class="aab-pl aab-pl-c">3 риска · 2 возможности</span>
        <span class="aab-pl aab-pl-v">Цифры из витрины KPI</span>
        <span class="aab-pl aab-pl-g">~3 мин / день</span>
      </div>
      <div class="aab-integrations" aria-hidden="true">
        <span class="aab-int">1С</span>
        <span class="aab-int">amoCRM</span>
        <span class="aab-int">Битрикс24</span>
        <span class="aab-int">Sheets</span>
        <span class="aab-int">Директ</span>
        <span class="aab-int">Банк</span>
      </div>
      <div class="aab-vs" aria-hidden="true">
        <div class="aab-vs-col aab-vs-col--old">
          <strong>Excel / ручная сводка</strong>
          Часы на «склейку», устаревшие цифры, нет приоритетов
        </div>
        <div class="aab-vs-col aab-vs-col--new">
          <strong>AI-аналитик бизнеса</strong>
          Ежедневный брифинг, проверяемые KPI, действия в ₽
        </div>
      </div>
      <p class="aab-foot">Дальше разберём архитектуру слоёв: источники → витрина → AI → Telegram →</p>
    </div>

    <div class="aab-rgt">
      <canvas
        id="aab-briefing-canvas"
        aria-label="Анимация: данные из 1С, CRM и рекламы собираются в витрину KPI, AI формирует ежедневный брифинг с рисками и действиями"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('aab-briefing-canvas');
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
    cyan:'#06b6d4',
    cyanGlow:'rgba(121,242,255,.25)',
    viol:'#8b5cf6',
    violGlow:'rgba(139,92,246,.2)',
    green:'#22c55e',
    red:'#ef4444',
    amber:'#f59e0b',
    onec:'#ffdd2d',
    crm:'#3b82f6',
    ads:'#f97316',
    bank:'#10b981',
    sheet:'#22c55e',
    card:'#ffffff',
    cardBdr:'rgba(148,163,184,.35)',
    line:'rgba(6,182,212,.35)'
  };

  var SOURCES = [
    {label:'1С', x:0.08, y:0.12, clr:C.onec, delay:0},
    {label:'CRM', x:0.22, y:0.08, clr:C.crm, delay:30},
    {label:'Sheets', x:0.36, y:0.14, clr:C.sheet, delay:60},
    {label:'Директ', x:0.50, y:0.09, clr:C.ads, delay:90},
    {label:'Банк', x:0.64, y:0.13, clr:C.bank, delay:120}
  ];

  var LOOP = 820;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawSourceNode(sx,sy,label,clr,pulse){
    var r = 18 + Math.sin(pulse*0.08)*2;
    ctx.beginPath();
    ctx.arc(sx,sy,r+6,0,Math.PI*2);
    ctx.fillStyle=clr+'33';
    ctx.fill();
    ctx.beginPath();
    ctx.arc(sx,sy,r,0,Math.PI*2);
    ctx.fillStyle=clr;
    ctx.fill();
    ctx.strokeStyle=C.ink;
    ctx.lineWidth=1.5;
    ctx.stroke();
    ctx.fillStyle=C.ink;
    ctx.font='bold 9px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(label,sx,sy+3);
  }

  function drawParticle(x,y,alpha,clr){
    ctx.globalAlpha=alpha;
    ctx.beginPath();
    ctx.arc(x,y,3,0,Math.PI*2);
    ctx.fillStyle=clr;
    ctx.fill();
    ctx.globalAlpha=1;
  }

  function drawVitrineHub(cx,cy,w,h,pulse,active){
    var glow = 0.15 + 0.1*Math.sin(pulse*0.06);
    rr(cx-w/2-8,cy-h/2-8,w+16,h+16,14,'rgba(121,242,255,'+glow+')',null,0);
    rr(cx-w/2,cy-h/2,w,h,12,C.card,C.cyan,2);
    ctx.fillStyle=C.cyan;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Витрина KPI',cx,cy-h/2+18);
    if(active>0.3){
      var bars = ['Выручка','Маржа','Лиды'];
      var vals = ['1,24 млн','34,2%','47'];
      bars.forEach(function(lbl,i){
        var by=cy-h/2+32+i*22;
        ctx.fillStyle=C.muted;
        ctx.font='9px Inter,sans-serif';
        ctx.textAlign='left';
        ctx.fillText(lbl,cx-w/2+10,by);
        var prog=Math.min(1,active-i*0.15);
        rr(cx-w/2+70,by-10,(w-90)*prog,8,4,C.cyanGlow,null,0);
        if(prog>0.5){
          ctx.fillStyle=C.ink;
          ctx.font='bold 9px Inter,sans-serif';
          ctx.textAlign='right';
          ctx.fillText(vals[i],cx+w/2-10,by);
        }
      });
    }
    for(var i=0;i<4;i++){
      var ang=(i/4)*Math.PI*2+pulse*0.05;
      ctx.beginPath();
      ctx.arc(cx+Math.cos(ang)*28,cy+Math.sin(ang)*16,3,0,Math.PI*2);
      ctx.fillStyle=C.viol;
      ctx.fill();
    }
  }

  function drawAiLayer(ax,ay,w,h,alpha,pulse){
    ctx.globalAlpha=alpha;
    rr(ax,ay,w,h,10,'rgba(139,92,246,.1)',C.viol,2);
    ctx.fillStyle=C.viol;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('AI-слой',ax+w/2,ay+16);
    ctx.fillText('брифинг',ax+w/2,ay+28);
    var scanY=ay+36+(pulse%40);
    ctx.fillStyle='rgba(139,92,246,.2)';
    ctx.fillRect(ax+6,scanY,w-12,3);
    ctx.globalAlpha=1;
  }

  function drawBriefingCard(bx,by,bw,bh,phase,pulse){
    var slide=Math.min(1,Math.max(0,(phase-0.35)/0.25));
    var offX=(1-slide)*60;
    ctx.globalAlpha=slide;
    rr(bx+offX,by,bw,bh,14,C.card,C.cardBdr,1.5);
    ctx.shadowColor='rgba(15,23,42,.08)';
    ctx.shadowBlur=12;
    ctx.shadowOffsetY=4;

    ctx.fillStyle=C.ink;
    ctx.font='bold 12px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('📊 AI-брифинг · 07:15',bx+offX+14,by+22);

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText('Компания «Образец»',bx+offX+14,by+36);

    var kpiY=by+48;
    var kpis=[
      {lbl:'Выручка',val:'1,24 млн',delta:'−8%',clr:C.red},
      {lbl:'Маржа',val:'34,2%',delta:'−2,1 п.п.',clr:C.amber},
      {lbl:'Лиды',val:'47',delta:'+3',clr:C.green}
    ];
    var kw=(bw-28)/3;
    kpis.forEach(function(k,i){
      var kx=bx+offX+10+i*(kw+4);
      rr(kx,kpiY,kw,42,8,'#f8fafc',C.cardBdr,1);
      ctx.fillStyle=C.muted;
      ctx.font='8px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(k.lbl,kx+6,kpiY+14);
      ctx.fillStyle=C.ink;
      ctx.font='bold 10px Inter,sans-serif';
      ctx.fillText(k.val,kx+6,kpiY+28);
      ctx.fillStyle=k.clr;
      ctx.font='8px Inter,sans-serif';
      ctx.fillText(k.delta,kx+6,kpiY+38);
    });

    if(phase>0.55){
      var riskA=Math.min(1,(phase-0.55)/0.15);
      ctx.globalAlpha=slide*riskA;
      ctx.fillStyle=C.red;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText('⚠ 3 риска',bx+offX+14,by+108);
      var risks=['Дебиторка +340 тыс.','Конверсия 12→9%','Директ +22% / −15% лидов'];
      risks.forEach(function(r,i){
        var ry=by+120+i*16;
        rr(bx+offX+12,ry,bw-24,14,7,'rgba(239,68,68,.08)',C.red,1);
        ctx.fillStyle='#b91c1c';
        ctx.font='8px Inter,sans-serif';
        ctx.fillText(r,bx+offX+18,ry+10);
      });
    }

    if(phase>0.72){
      var actA=Math.min(1,(phase-0.72)/0.15);
      ctx.globalAlpha=slide*actA;
      ctx.fillStyle=C.green;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.fillText('🎯 5 действий',bx+offX+14,by+172);
      var acts=['Созвон с должником — +180 тыс. ₽','Разбор воронки с менеджером','Пауза кампаний Директ'];
      acts.forEach(function(a,i){
        var ay=by+184+i*15;
        ctx.fillStyle=C.green;
        ctx.font='bold 9px sans-serif';
        ctx.fillText('✓',bx+offX+14,ay+9);
        ctx.fillStyle=C.ink;
        ctx.font='8px Inter,sans-serif';
        ctx.fillText(a,bx+offX+26,ay+9);
      });
    }

    if(phase>0.88){
      var tgA=Math.sin(pulse*0.1)*0.3+0.7;
      ctx.globalAlpha=slide*tgA;
      rr(bx+offX+12,by+bh-32,bw-24,24,12,'rgba(6,182,212,.12)',C.cyan,1.5);
      ctx.fillStyle=C.cyan;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('✈ Telegram · доставлено собственнику',bx+offX+bw/2,by+bh-16);
    }

    ctx.shadowBlur=0;
    ctx.shadowOffsetY=0;
    ctx.globalAlpha=1;
  }

  function drawFlowLine(x1,y1,x2,y2,alpha){
    ctx.globalAlpha=alpha*0.4;
    ctx.strokeStyle=C.line;
    ctx.lineWidth=1.5;
    ctx.setLineDash([4,4]);
    ctx.beginPath();
    ctx.moveTo(x1,y1);
    ctx.lineTo(x2,y2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t=(frame%LOOP)/LOOP;
    var pulse=frame;

    ctx.clearRect(0,0,W,H);

    var hubX=W*0.38, hubY=H*0.42;
    var hubW=Math.min(130,W*0.22), hubH=100;
    var aiX=hubX-hubW/2-50, aiY=hubY-20, aiW=44, aiH=56;
    var briefX=W*0.52, briefY=H*0.18;
    var briefW=Math.min(220,W*0.42), briefH=H*0.72;

    SOURCES.forEach(function(s){
      var sx=W*s.x, sy=H*s.y;
      drawSourceNode(sx,sy,s.label,s.clr,pulse+s.delay);
      drawFlowLine(sx,sy,hubX,hubY,0.5+0.3*Math.sin(pulse*0.04+s.delay));

      var prog=(t*LOOP+s.delay*2)%LOOP/LOOP;
      var px=sx+(hubX-sx)*prog;
      var py=sy+(hubY-sy)*prog;
      if(prog<0.85) drawParticle(px,py,1-prog*0.8,s.clr);
    });

    var vitActive=Math.min(1,t*2.5);
    drawVitrineHub(hubX,hubY,hubW,hubH,pulse,vitActive);

    var aiAlpha=Math.min(1,Math.max(0,(t-0.15)*3));
    drawAiLayer(aiX,aiY,aiW,aiH,aiAlpha,pulse);

    if(aiAlpha>0.2){
      drawFlowLine(hubX+hubW/2,hubY,briefX,briefY+briefH/2,aiAlpha);
      drawFlowLine(aiX+aiW,hubY,briefX,briefY+briefH/2,aiAlpha*0.6);
    }

    drawBriefingCard(briefX,briefY,briefW,briefH,t,pulse);

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>

  <section class="aab-section" id="kak-rabotaet">
    <div class="aab-cnt">
      <div class="aab-sh nero-ai-reveal">
        <span class="aab-eyebrow">Архитектура</span>
        <h2>Как работает AI-аналитик управленческих отчётов</h2>
        <p>Типовой контур: источники → витрина данных → AI-слой → канал доставки (Telegram, email, личный кабинет).</p>
      </div>

      <div class="aab-grid-3 nero-ai-reveal">
        <div class="aab-card">
          <h3>Источники данных</h3>
          <p>1С (OData/REST), amoCRM/Битрикс24, Google Sheets, Яндекс Директ, VK Реклама, банк и эквайринг — единая витрина KPI.</p>
        </div>
        <div class="aab-card nero-ai-delay-1">
          <h3>Формат ежедневного отчёта</h3>
          <p>Сводка за 24 часа, 3 риска, 2 возможности, 5 действий в ₽, алерты при критичных отклонениях, еженедельный план/факт.</p>
        </div>
        <div class="aab-card nero-ai-delay-2">
          <h3>AI-прогноз выручки</h3>
          <p>Ранние сигналы: просадка конверсии при стабильном трафике, рост дебиторки, отклонение маржи из-за скидок в канале.</p>
        </div>
      </div>

      <div class="aab-terminal nero-ai-reveal" aria-label="Пример структуры ежедневного AI-отчёта">
        <div class="t-dim">📊 AI-брифинг за 12.06.2026 | Компания «Образец»</div>
        <div>ВЫРУЧКА: 1,24 млн ₽ (−8% к плану) | источник: 1С:УТ</div>
        <div>МАРЖА: 34,2% (−2,1 п.п.) | причина: скидки в канале «Опт»</div>
        <div class="t-warn">⚠️ 3 РИСКА: дебиторка +340 тыс.; конверсия 12%→9%; Директ +22% / −15% лидов</div>
        <div class="t-ok">✅ 2 ВОЗМОЖНОСТИ: розница +11%; 14 сделок на «Договор» — +890 тыс. ₽</div>
        <div class="t-ok">🎯 5 ДЕЙСТВИЙ: созвон с должником; разбор воронки; пауза кампаний Директ…</div>
      </div>

      <div class="aab-card nero-ai-reveal">
        <h3>Логика работы Nero Network</h3>
        <ol style="padding-left:1.2em;color:var(--aab-muted);line-height:1.7;">
          <li>Ночью/утром ETL забирает свежие данные.</li>
          <li>Витрина пересчитывает KPI по зафиксированным формулам (не в LLM).</li>
          <li>AI получает агрегаты + флаги аномалий → брифинг.</li>
          <li>На вопрос собственника — проверяемый запрос к витрине → ответ со ссылкой на источник.</li>
          <li>Критичные отклонения — push в Telegram.</li>
        </ol>
        <p><strong>Цифры не «из головы» нейросети:</strong> LLM определяет intent → SQL/OData-запрос → цифры только из витрины.</p>
      </div>

<aside class="ym-cta-block ym-cta-block--primary" id="cta-primer-otcheta">
  <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получите пример ежедневного AI-отчёта</p>
    <p class="ym-cta-block__sub">Покажем обезличенный брифинг: 3 риска, 2 возможности, 5 действий с эффектом в ₽ — до пилота на ваших данных из CRM, 1С и рекламы.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Получить пример отчёта</a>
  </div>
</aside>
    </div>
  </section>

  <section class="aab-section aab-section-alt" id="etapy">
    <div class="aab-cnt">
      <div class="aab-sh nero-ai-reveal">
        <span class="aab-eyebrow">Под ключ</span>
        <h2>Внедрение AI-аналитика бизнеса под ключ: этапы и сроки</h2>
        <p>Ориентир чека: <strong>250 тыс.–1,2 млн ₽</strong>. До первых отчётов у интеграторов — 1–2 недели при готовых доступах.</p>
      </div>

      <div class="aab-timeline nero-ai-reveal">
        <div class="aab-tl-item">
          <span class="aab-tl-dot" aria-hidden="true"></span>
          <h3>Аудит данных и KPI (3–5 дней)</h3>
          <p>Инвентаризация 1С, CRM, таблиц, рекламы. Согласование 8–12 KPI, матрица доступов, регламент расчёта маржи.</p>
        </div>
        <div class="aab-tl-item">
          <span class="aab-tl-dot" aria-hidden="true"></span>
          <h3>Настройка интеграций (5–10 дней)</h3>
          <p>Коннекторы OData/REST, витрина PostgreSQL или DataLens. AI layer: промпт-цепочка, Text-to-SQL, YandexGPT/GigaChat для ПДн в РФ.</p>
        </div>
        <div class="aab-tl-item">
          <span class="aab-tl-dot" aria-hidden="true"></span>
          <h3>Запуск и пилот (2–4 недели)</h3>
          <p>Telegram-бот + email, обезличенный пример отчёта. Human-in-the-loop: собственник/финдиректор валидирует выводы, корректируются пороги.</p>
        </div>
      </div>

<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до старта аналитики?</p>
    <p class="ym-cta-block__sub">Перед настройкой интеграций и калибровкой алертов полезно разобраться в data layer, промптах и human-in-the-loop — финдиректор быстрее валидирует выводы на пилоте. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
  </div>
</aside>
    </div>
  </section>

  <section class="aab-section" id="sravnenie">
    <div class="aab-cnt">
      <div class="aab-sh nero-ai-reveal">
        <span class="aab-eyebrow">Честное сравнение</span>
        <h2>AI-управленческая аналитика vs Power BI, DataLens и штатный аналитик</h2>
      </div>

      <div class="aab-table-wrap nero-ai-reveal">
        <table class="aab-table">
          <thead><tr><th>Решение</th><th>Срок запуска</th><th>Ежедневные выводы</th><th>1С + CRM</th><th>Ориентир стоимости</th></tr></thead>
          <tbody>
            <tr><td>Excel / ручная сводка</td><td>0 ₽, часы</td><td>Нет</td><td>Выгрузки вручную</td><td>Время собственника</td></tr>
            <tr><td>Power BI + Copilot</td><td>Недели–месяцы</td><td>Summarize по отчёту</td><td>Нужна интеграция</td><td>Лицензии + аналитик</td></tr>
            <tr><td>Яндекс DataLens + Нейроаналитик</td><td>Недели</td><td>NL-запросы</td><td>Нужен data layer</td><td>от ~1,6 млн ₽/год</td></tr>
            <tr><td>SaaS AGINE AI</td><td>Дни</td><td>Pulse, Health Score</td><td>Только CRM</td><td>19 900–49 900 ₽/мес</td></tr>
            <tr><td>Nero Network custom</td><td>2–4 недели пилот</td><td>Ежедневный брифинг в Telegram</td><td>1С + CRM + реклама</td><td>250 тыс.–1,2 млн ₽</td></tr>
          </tbody>
        </table>
      </div>

      <div class="aab-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="aab-card">
          <h3>Достаточно BI, если…</h3>
          <ul>
            <li>Есть штатный аналитик с ежедневными выводами.</li>
            <li>Нужна визуализация для совещаний без проактивных алертов.</li>
            <li>Корпоративный контур с лицензиями уже оплачен.</li>
          </ul>
        </div>
        <div class="aab-card">
          <h3>Нужен AI-аналитик, если…</h3>
          <ul>
            <li>Собственник хочет <strong>ежедневные действия</strong>, а не графики.</li>
            <li>Данные в 1С, CRM и рекламе, но нет единой «правды».</li>
            <li>Нет FTE-аналитика, бюджет 250 тыс.–1,2 млн ₽ на проект.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="aab-section aab-section-alt" id="keisy">
    <div class="aab-cnt">
      <div class="aab-sh nero-ai-reveal">
        <span class="aab-eyebrow">Практика</span>
        <h2>Кейсы и примеры внедрения AI-аналитика бизнеса</h2>
        <p>Типовые сценарии для малого и среднего бизнеса — без выдуманных цифр эффекта.</p>
      </div>

      <div class="aab-case-grid nero-ai-reveal">
        <div class="aab-case-card">
          <div class="aab-case-tag">Розница</div>
          <h3>Сеть точек</h3>
          <p>Выручка по точкам из 1С, трафик из таблиц. AI-алерт при отклонении выручки точки &gt;15% от недельного среднего.</p>
        </div>
        <div class="aab-case-card">
          <div class="aab-case-tag">B2B-услуги</div>
          <h3>Воронка + 1С</h3>
          <p>amoCRM + 1С:БП. AI-анализ продаж: сделки &gt;14 дней, план/факт по менеджерам.</p>
        </div>
        <div class="aab-case-card">
          <div class="aab-case-tag">E-commerce</div>
          <h3>Директ + CRM + 1С</h3>
          <p>Связка CAC и маржи по SKU; ai прогноз выручки на 4 недели.</p>
        </div>
      </div>

      <div class="aab-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Ориентиры по ROI без выдуманных цифр</h3>
        <p><strong>78%</strong> компаний отмечают финансовую отдачу от ИИ (Яков и Партнёры, 2025). Окупаемость кастомного контура — ориентир <strong>3–9 месяцев</strong> при активном использовании, не гарантия. Пилот на «выручка + маржа + воронка CRM» — 2–4 недели.</p>
        <p>Для витрины «воронка CRM» нужны чистые сделки и этапы в amoCRM — если автоматизации ещё нет, логично сначала закрыть <a href="https://meta-journal.ru/vnedrenie-ai-amocrm/">внедрение AI-агента в amoCRM</a>, а уже затем подключать ежедневный брифинг собственнику.</p>
        <p>Дополнительный поток лидов в дашборд даёт входящая почта: <a href="https://meta-journal.ru/vnedrenie-ai-obrabotka-email-crm/">AI-обработка входящей почты в CRM</a> убирает ручную разборку заявок и ускоряет попадание обращений в воронку для AI-аналитики.</p>
      </div>
    </div>
  </section>

  <section class="aab-section" id="ceny">
    <div class="aab-cnt">
      <div class="aab-sh nero-ai-reveal">
        <span class="aab-eyebrow">Стоимость</span>
        <h2>Стоимость внедрения и окупаемость</h2>
      </div>

      <div class="aab-table-wrap nero-ai-reveal">
        <table class="aab-table">
          <thead><tr><th>Фактор</th><th>Влияние на чек</th></tr></thead>
          <tbody>
            <tr><td>Число источников (1С, CRM, реклама, банк)</td><td>+за каждый нетиповой коннектор</td></tr>
            <tr><td>Сложность учёта (УТ vs ERP)</td><td>ERP дороже</td></tr>
            <tr><td>Число KPI и сценариев алертов</td><td>8–12 базовых vs 20+</td></tr>
            <tr><td>Ad-hoc вопросы (Text-to-SQL)</td><td>+AI layer</td></tr>
            <tr><td>On-prem vs облако РФ</td><td>On-prem +инфраструктура</td></tr>
          </tbody>
        </table>
      </div>

      <div class="aab-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Что входит в пакет «под ключ»</h3>
        <ul>
          <li>Discovery и согласование KPI.</li>
          <li>Data layer: коннекторы, витрина, правила расчёта.</li>
          <li>AI layer: брифинг, алерты, ad-hoc вопросы.</li>
          <li>Доставка: Telegram + email.</li>
          <li>Пилот 2–4 недели с human-in-the-loop.</li>
          <li>Документация и обезличенный пример ежедневного отчёта.</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="aab-section aab-section-alt" id="bezopasnost">
    <div class="aab-cnt">
      <div class="aab-sh nero-ai-reveal">
        <span class="aab-eyebrow">152-ФЗ</span>
        <h2>Безопасность данных и доступы при AI-аналитике</h2>
      </div>

      <div class="aab-grid-2 nero-ai-reveal">
        <div class="aab-card">
          <h3>Разграничение прав</h3>
          <p>Собственник видит всё; финдиректор — финансы; коммерция — воронку без маржи по SKU. ПДн маскируются в ответах AI. Журнал запросов для аудита.</p>
        </div>
        <div class="aab-card">
          <h3>Где обрабатываются данные</h3>
          <p>ПДн и финданные — YandexGPT, GigaChat или on-prem. Паттерн AI-шлюз + OData: цифры только из 1С API. On-prem для контуров «данные не покидают периметр».</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aab-section" id="faq">
    <div class="aab-cnt">
      <div class="aab-sh nero-ai-reveal">
        <span class="aab-eyebrow">FAQ</span>
        <h2>Частые вопросы собственников</h2>
      </div>

      <div class="aab-faq nero-ai-reveal">
        <div class="aab-faq-item">
          <div class="aab-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai аналитик бизнеса в действующие процессы?</div>
          <div class="aab-faq-a">Без «ломки» учёта: read-only API/OData к 1С и CRM. Первый пилот — один контур («выручка + воронка»). Полный цикл: Discovery 3–5 дней → data layer 5–10 дней → AI layer 5–7 дней → пилот 2–4 недели.</div>
        </div>
        <div class="aab-faq-item">
          <div class="aab-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли начать с одного направления?</div>
          <div class="aab-faq-a">Да. Типовой старт — ai анализ продаж: CRM + оплаты из 1С. Второй этап — рекламные кабинеты и ai прогноз выручки.</div>
        </div>
        <div class="aab-faq-item">
          <div class="aab-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли штатный аналитик после внедрения?</div>
          <div class="aab-faq-a">AI снижает зависимость от ручной сводки, но не отменяет стратегические решения. Для МСБ часто достаточно финдиректора на валидации пилота.</div>
        </div>
        <div class="aab-faq-item">
          <div class="aab-faq-q" role="button" tabindex="0" aria-expanded="false">Как связано с трендом AI-внедрений 2026?</div>
          <div class="aab-faq-a">McKinsey State of AI: выигрывают компании, перестраивающие end-to-end процессы. Услуга «под ключ» — мост от эксперимента с ChatGPT к операционному AI-контуру с KPI.</div>
        </div>
        <div class="aab-faq-item">
          <div class="aab-faq-q" role="button" tabindex="0" aria-expanded="false">Что если данные «грязные»?</div>
          <div class="aab-faq-a">Discovery включает аудит качества. На пилоте — минимальный согласованный набор KPI. Data layer выявляет расхождения до запуска брифинга.</div>
        </div>
        <div class="aab-faq-item">
          <div class="aab-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько до первого отчёта?</div>
          <div class="aab-faq-a">По рынку: 1–2 недели при готовых доступах. Проект Nero Network: ориентир 2–4 недели до стабильного пилота с валидацией.</div>
        </div>
      </div>
    </div>
  </section>

  <section class="aab-section aab-section-alt" id="itog">
    <div class="aab-cnt">
      <div class="aab-sh nero-ai-reveal">
        <h2>Итог</h2>
        <p><strong>AI-аналитик бизнеса</strong> — управленческие отчёты и дашборд для собственника под ключ: CRM, 1С, таблицы и реклама в едином контуре, ежедневные выводы в Telegram, проверяемые цифры из API. Внедрение в коридоре <strong>250 тыс.–1,2 млн ₽</strong> закрывает боль «данные есть — выводов нет».</p>
        <p><strong>Получить пример ежедневного AI-отчёта</strong> — первый шаг к пилоту на ваших данных.</p>
      </div>
    </div>
  </section>

<div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы к утреннему AI-брифингу за 3 минуты?</p>
    <p class="ym-cta-block__sub">Первый шаг — пример ежедневного отчёта под вашу отрасль. Пилот на контуре «выручка + маржа + воронка CRM» — 2–4 недели, ориентир 250 тыс.–1,2 млн ₽.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить пример отчёта</a>
      <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Вопросы собственников</a>
    </div>
  </div>
</div>

</div>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "https://meta-journal.ru//#organization",
      "name": "Neurinix",
      "url": "https://meta-journal.ru/"
    },
    {
      "@type": "WebSite",
      "@id": "https://meta-journal.ru//#website",
      "url": "https://meta-journal.ru/",
      "name": "Neurinix",
      "publisher": {
        "@id": "https://meta-journal.ru//#organization"
      }
    },
    {
      "@type": "WebPage",
      "@id": "https://meta-journal.ru/ai-analitik-biznesa/#webpage",
      "url": "https://meta-journal.ru/ai-analitik-biznesa/",
      "name": "AI-аналитик бизнеса: управленческие отчёты и дашборд для собственника под ключ",
      "description": "Внедряем AI-аналитик бизнеса: CRM, 1С и реклама в одном дашборде. Каждый день — выводы, риски и действия для собственника. Получите пример отчёта.",
      "isPartOf": {
        "@id": "https://meta-journal.ru//#website"
      },
      "about": {
        "@id": "https://meta-journal.ru//#organization"
      }
    },
    {
      "@type": "BreadcrumbList",
      "@id": "https://meta-journal.ru/ai-analitik-biznesa/#breadcrumb",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Главная",
          "item": "https://meta-journal.ru/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "AI-аналитик бизнеса: управленческие отчёты и дашборд для собственника под ключ",
          "item": "https://meta-journal.ru/ai-analitik-biznesa/"
        }
      ]
    },
    {
      "@type": "Service",
      "@id": "https://meta-journal.ru/ai-analitik-biznesa/#service",
      "name": "AI-аналитик бизнеса: управленческие отчёты и дашборд для собственника под ключ",
      "description": "Внедряем AI-аналитик бизнеса: CRM, 1С и реклама в одном дашборде. Каждый день — выводы, риски и действия для собственника. Получите пример отчёта.",
      "url": "https://meta-journal.ru/ai-analitik-biznesa/",
      "provider": {
        "@id": "https://meta-journal.ru//#organization"
      }
    },
    {
      "@type": "FAQPage",
      "@id": "https://meta-journal.ru/ai-analitik-biznesa/#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Как внедрить ai аналитик бизнеса в действующие процессы?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Без «ломки» учёта: read-only API/OData к 1С и CRM. Первый пилот — один контур («выручка + воронка»). Полный цикл: Discovery 3–5 дней → data layer 5–10 дней → AI layer 5–7 дней → пилот 2–4 недели."
          }
        },
        {
          "@type": "Question",
          "name": "Можно ли начать с одного направления?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да. Типовой старт — ai анализ продаж: CRM + оплаты из 1С. Второй этап — рекламные кабинеты и ai прогноз выручки."
          }
        },
        {
          "@type": "Question",
          "name": "Нужен ли штатный аналитик после внедрения?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "AI снижает зависимость от ручной сводки, но не отменяет стратегические решения. Для МСБ часто достаточно финдиректора на валидации пилота."
          }
        },
        {
          "@type": "Question",
          "name": "Как связано с трендом AI-внедрений 2026?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "McKinsey State of AI: выигрывают компании, перестраивающие end-to-end процессы. Услуга «под ключ» — мост от эксперимента с ChatGPT к операционному AI-контуру с KPI."
          }
        },
        {
          "@type": "Question",
          "name": "Что если данные «грязные»?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Discovery включает аудит качества. На пилоте — минимальный согласованный набор KPI. Data layer выявляет расхождения до запуска брифинга."
          }
        },
        {
          "@type": "Question",
          "name": "Сколько до первого отчёта?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "По рынку: 1–2 недели при готовых доступах. Проект Nero Network: ориентир 2–4 недели до стабильного пилота с валидацией."
          }
        }
      ]
    }
  ]
}
</script>

</main>

<script id="aab-analitik-hero-engine">
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aab-analitik-hero-canvas");
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
    cy = ch / 2 + 8;
    scale = cw < 420 ? cw / 420 : Math.min(cw / 520, ch / 300) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#0f172a",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    amber: "#f59e0b",
    panel: "#0f172a",
    panelHi: "#1e293b",
    text: "#e2e8f0",
    bubbleBg: "rgba(15,23,42,0.92)",
    bubbleText: "#e2e8f0",
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

  /* Фоновая волна сетки аналитики */
  function SparkGridWave() {
    this.phase = 0;
  }
  SparkGridWave.prototype.draw = function (ctx) {
    this.phase += 0.02;
    ctx.strokeStyle = "rgba(121,242,255,0.06)";
    ctx.lineWidth = 1;
    for (var i = -3; i <= 3; i++) {
      var y = i * 28 + Math.sin(this.phase + i) * 6;
      ctx.beginPath();
      ctx.moveTo(-200, y);
      ctx.lineTo(200, y);
      ctx.stroke();
    }
  };

  /* Орбитальные дуги потоков данных — вместо Conveyor */
  function OrbitalDataArcs() {
    this.offset = 0;
  }
  OrbitalDataArcs.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    this.offset = (frame * 0.35) % 100;
    var sources = [
      { angle: -2.2, color: C.amber, label: "1С" },
      { angle: -0.6, color: C.cyan, label: "CRM" },
      { angle: 0.9, color: C.green, label: "XL" },
      { angle: 2.3, color: C.violet, label: "ADS" }
    ];
    sources.forEach(function (s, idx) {
      var r = 95 + idx * 4;
      var sx = Math.cos(s.angle) * r;
      var sy = Math.sin(s.angle) * r * 0.55;
      ctx.strokeStyle = s.color + "55";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(sx, sy);
      ctx.quadraticCurveTo(sx * 0.35, sy * 0.35, 0, -8);
      ctx.stroke();
      if (prg > idx * 18 && prg < 200) {
        var t = ((prg - idx * 18 + this.offset) % 40) / 40;
        var px = sx + (0 - sx) * t;
        var py = sy + (-8 - sy) * t;
        drawRR(ctx, px - 5, py - 5, 10, 10, 3, s.color, C.outline);
      }
    }, this);
  };

  /* Маяки источников по периметру */
  function SourceBeacon(angle, color, label) {
    this.angle = angle;
    this.color = color;
    this.label = label;
  }
  SourceBeacon.prototype.draw = function (ctx) {
    var r = 108;
    var x = Math.cos(this.angle) * r;
    var y = Math.sin(this.angle) * r * 0.55;
    drawRR(ctx, x - 14, y - 10, 28, 20, 5, C.panelHi, this.color);
    ctx.fillStyle = this.color;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(this.label, x, y + 3);
  };

  /* Кольцо плиток KPI */
  function KpiVitrineRing() {
    this.pulse = 0;
  }
  KpiVitrineRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 55) return;
    this.pulse = Math.sin(frame * 0.08) * 2;
    var tiles = ["₽", "Δ%", "CRM", "CAC"];
    tiles.forEach(function (t, i) {
      var a = (i / tiles.length) * Math.PI * 2 - Math.PI / 2;
      var rx = Math.cos(a) * (52 + this.pulse);
      var ry = Math.sin(a) * (32 + this.pulse);
      drawRR(ctx, rx - 11, ry - 8, 22, 16, 4, "rgba(121,242,255,0.15)", C.cyan);
      ctx.fillStyle = C.text;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(t, rx, ry + 3);
    }, this);
  };

  /* Центральная консоль брифинга — вместо WebsiteTerminal */
  function ExecutiveBriefingConsole() {
    this.tab = 0;
  }
  ExecutiveBriefingConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, -58, -52, 116, 104, 10, C.panel, C.cyan);
    drawRR(ctx, -52, -46, 104, 16, [6, 6, 0, 0], C.violet, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("AI · брифинг", -46, -35);

    if (prg >= 70) {
      drawRR(ctx, -48, -24, 96, 14, 3, "rgba(34,197,94,0.2)", C.green);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Выручка 1,24 млн · −8%", -44, -14);
    }
    if (prg >= 110) {
      for (var r = 0; r < 3; r++) {
        drawRR(ctx, -48, -4 + r * 16, 96, 11, 2, "rgba(245,158,11,0.18)", C.amber);
        ctx.fillStyle = "#fde68a";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.fillText("Риск " + (r + 1) + " · порог превышен", -44, 4 + r * 16);
      }
    }
    if (prg >= 155) {
      drawRR(ctx, -48, 44, 96, 18, 4, "rgba(139,92,246,0.22)", C.violet);
      ctx.fillStyle = "#ddd6fe";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("5 действий · эффект в ₽", 0, 56);
    }
  };

  /* Флажки рисков */
  function RiskAmberFlags() {
    this.wave = 0;
  }
  RiskAmberFlags.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 100 || prg > 210) return;
    this.wave = Math.sin(frame * 0.12) * 3;
    [-38, 0, 38].forEach(function (fx, i) {
      ctx.fillStyle = C.amber;
      ctx.beginPath();
      ctx.moveTo(fx, -58 + this.wave);
      ctx.lineTo(fx + 8, -50 + this.wave + i);
      ctx.lineTo(fx, -42 + this.wave);
      ctx.fill();
    }, this);
  };

  /* Доставка в Telegram — финал цикла */
  function TelegramPulseOrb() {
    this.y = 0;
    this.alpha = 0;
  }
  TelegramPulseOrb.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 188) {
      this.y = 0;
      this.alpha = 0;
      return;
    }
    var local = prg - 188;
    this.y = -local * 1.8;
    this.alpha = local < 40 ? local / 40 : 1 - (local - 40) / 12;
    ctx.save();
    ctx.globalAlpha = Math.max(0, this.alpha);
    ctx.fillStyle = C.cyan;
    ctx.beginPath();
    ctx.arc(0, -70 + this.y, 14, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.fillStyle = C.panel;
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("TG", 0, -66 + this.y);
    ctx.fillStyle = C.text;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.fillText("брифинг отправлен", 0, -88 + this.y);
    ctx.restore();
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
    var stations = {
      "1_architect": { x: -72, y: 38 },
      "2_seo": { x: -28, y: 46 },
      "3_coder": { x: 18, y: 46 },
      "4_designer": { x: 62, y: 38 },
      "5_deployer": { x: 0, y: 54 }
    };
    var tgt = stations[this.role] || { x: 0, y: 42 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 15) {
        this.x = tgt.x;
        this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 15) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 15) / 7);
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.1) {
      createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.5) * 1;
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

  entities.push(new SparkGridWave());
  entities.push(new OrbitalDataArcs());
  entities.push(new SourceBeacon(-2.2, C.amber, "1С"));
  entities.push(new SourceBeacon(-0.6, C.cyan, "CRM"));
  entities.push(new SourceBeacon(0.9, C.green, "XL"));
  entities.push(new SourceBeacon(2.3, C.violet, "ADS"));
  entities.push(new KpiVitrineRing());
  entities.push(new ExecutiveBriefingConsole());
  entities.push(new RiskAmberFlags());
  entities.push(new TelegramPulseOrb());
  entities.push(new Agent(-120, 82, C.agentYellow, "1_architect", 18, [
    "KPI-схема собственника", "8 метрик на витрину", "Правила маржи фиксируем"
  ]));
  entities.push(new Agent(-60, 90, C.agentGreen, "2_seo", 62, [
    "OData 1С подключён", "amoCRM воронка sync", "Директ API в витрине"
  ]));
  entities.push(new Agent(0, 92, C.agentBlue, "3_coder", 108, [
    "ETL ночью 06:00", "Цифры не из LLM", "SQL к витрине KPI"
  ]));
  entities.push(new Agent(60, 90, C.agentPink, "4_designer", 154, [
    "3 риска в брифинг", "2 возможности в ₽", "5 действий на сегодня"
  ]));
  entities.push(new Agent(120, 82, C.agentPurple, "5_deployer", 200, [
    "Push в Telegram 08:30", "Human-in-the-loop", "Журнал запросов аудит"
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

    var prg = (frame * 0.042) % 240;
    if (prg >= 12 && prg < 12.05) createBubble(-100, -42, "1. Потоки из CRM и 1С");
    if (prg >= 68 && prg < 68.05) createBubble(-20, -48, "2. Витрина KPI пересчитана");
    if (prg >= 128 && prg < 128.05) createBubble(40, -18, "3. AI: риски и действия");
    if (prg >= 188 && prg < 188.05) createBubble(0, 62, "4. Брифинг в Telegram");

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

<script>
(function(){
  document.querySelectorAll('.aab-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aab-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aab-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aab-faq-q');
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
  var root = document.querySelector('.ai-analitik-biznesa-page') || document.querySelector('.aab-content');
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

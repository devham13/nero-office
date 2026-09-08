<?php
/**
 * Template Name: AI-агент для производства: сменные задания и контроль простоев
 * Description: Внедрение AI-агента для сменных заданий и контроля простоев. Интеграция с 1С, Telegram, OEE.
 */

$page_seo_title       = 'AI-агент для производства: сменные задания и контроль простоев';
$page_seo_description = 'Внедрение AI-агента для сменных заданий и контроля простоев: сбор данных по смене, фиксация отклонений, отчёт руководителю. Интеграция с 1С и ERP. Карта потерь — бесплатно.';

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
    ['label' => 'Боли', 'href' => '#problem'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'OEE', 'href' => '#prostoi-oee'],
    ['label' => 'Отрасли', 'href' => '#scenarii'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Найти простои';
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
/* Скрыть шапку Kadence */
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

.apk-content{
  --apk-bg:#050711;--apk-bg2:#080b17;--apk-bg3:#0a0e1c;
  --apk-surface:rgba(255,255,255,.072);--apk-surface2:rgba(255,255,255,.108);
  --apk-text:#e6edf7;--apk-muted:#9aa8bd;--apk-soft:#c7d2e5;--apk-heading:#fff;
  --apk-border:rgba(255,255,255,.10);--apk-border-s:rgba(255,255,255,.18);
  --apk-accent:#f5c518;--apk-violet:#8b5cf6;--apk-green:#22c55e;--apk-cyan:#79f2ff;
  --apk-btn-from:#2563eb;--apk-btn-to:#7c3aed;
  --apk-shadow:0 24px 72px rgba(0,0,0,.4);
  --apk-r:18px;--apk-r-lg:24px;--apk-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--apk-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.apk-content *,.apk-content *::before,.apk-content *::after{box-sizing:border-box;}
.apk-content a{color:inherit;text-decoration:none;}
.apk-content p{color:var(--apk-muted);line-height:1.72;margin:0 0 1em;}
.apk-content p:last-child{margin-bottom:0;}
.apk-content h2,.apk-content h3,.apk-content h4{color:var(--apk-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.apk-content strong{color:var(--apk-soft);}
.apk-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.apk-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--apk-muted);font-size:14.5px;line-height:1.65;}
.apk-content ul li::before{content:'›';position:absolute;left:0;color:var(--apk-accent);font-weight:700;}
.apk-cnt{width:min(var(--apk-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.apk-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.apk-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.apk-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.apk-sh.apk-left{margin-left:0;text-align:left;}
.apk-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.apk-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.apk-sh.apk-left p{margin-left:0;}
.apk-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apk-accent);margin-bottom:14px;}
.apk-gt{background:linear-gradient(92deg,#fff 0%,var(--apk-accent) 44%,var(--apk-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.apk-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.apk-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.apk-intro-text{position:relative;padding-left:20px;}
.apk-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--apk-accent),var(--apk-violet));}
.apk-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--apk-muted);margin-bottom:1em;}
.apk-intro-text p:last-child{margin-bottom:0;color:var(--apk-soft);}
.apk-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.apk-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.apk-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--apk-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.apk-kpi-card .kl{font-size:11px;font-weight:600;color:var(--apk-muted);line-height:1.4;}
.apk-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.apk-intro-grid{grid-template-columns:1fr;gap:36px;}.apk-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.apk-intro-kpi{grid-template-columns:1fr 1fr;}}
.apk-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.apk-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.apk-toc a{display:inline-block;padding:9px 18px;background:var(--apk-surface);border:1px solid var(--apk-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--apk-muted);transition:border-color .2s,color .2s,background .2s;}
.apk-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--apk-accent);background:rgba(245,197,24,.08);}
.apk-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--apk-border);border-radius:var(--apk-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.apk-card:hover{border-color:rgba(245,197,24,.28);transform:translateY(-2px);}
.apk-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.apk-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.apk-grid-2,.apk-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.apk-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.apk-grid-3{grid-template-columns:1fr;}}
.apk-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--apk-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.apk-scenario:last-child{margin-bottom:0;}
.apk-scenario:hover{border-color:rgba(245,197,24,.3);}
.apk-scenario h3{font-size:17px;margin-bottom:8px;}
.apk-scenario p{font-size:14.5px;margin:0 0 .6em;}
.apk-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.apk-table{width:100%;border-collapse:collapse;font-size:14px;}
.apk-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--apk-accent);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);white-space:nowrap;}
.apk-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--apk-text);vertical-align:top;}
.apk-table tr:last-child td{border-bottom:none;}
.apk-table tr:hover td{background:rgba(255,255,255,.03);}
.apk-timeline{position:relative;padding-left:40px;}
.apk-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--apk-accent),var(--apk-violet));opacity:.35;border-radius:2px;}
.apk-tl-item{position:relative;margin-bottom:32px;}
.apk-tl-item:last-child{margin-bottom:0;}
.apk-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--apk-accent);box-shadow:0 0 0 4px rgba(245,197,24,.2);}
.apk-tl-item h3{font-size:17px;margin-bottom:8px;}
.apk-tl-item p{font-size:14.5px;margin:0;}
.apk-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.apk-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.apk-case-grid{grid-template-columns:1fr;}}
.apk-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.apk-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.apk-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apk-green);margin-bottom:10px;}
.apk-case-card h3{font-size:16px;margin-bottom:14px;}
.apk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.apk-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.apk-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--apk-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.apk-faq-q::after{content:'▾';font-size:13px;color:var(--apk-accent);flex-shrink:0;transition:transform .25s;}
.apk-faq-item.open .apk-faq-q::after{transform:rotate(180deg);}
.apk-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--apk-muted);line-height:1.72;}
.apk-faq-item.open .apk-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,197,24,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--apk-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--apk-btn-from),var(--apk-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--apk-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--apk-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

</style>
</style>


<main id="primary" class="site-main nero-ai-home-page ai-proizvodstvo-kontrol-prostoev-page" role="main" tabindex="-1">

<section class="nero-ai-hero apk-hero-prostoi" id="hero" aria-labelledby="apk-hero-title">
<style>
/* ── Hero ai-proizvodstvo-kontrol-prostoev: самодостаточные стили ── */
.apk-hero-prostoi {
  --apk-gold: #f5c518;
  --apk-cyan: #79f2ff;
  --apk-alert: #ef4444;
  --apk-green: #22c55e;
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
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.apk-hero-prostoi::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .09), transparent 66%);
  filter: blur(8px);
  animation: apkHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes apkHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
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
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.apk-hero-prostoi .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--apk-gold) 38%, #fde68a 100%);
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
  border: 1px solid rgba(245, 197, 24, 0.22);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--apk-gold) !important;
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
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--apk-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
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
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
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
  background: rgba(121, 242, 255, .10);
  color: #bae6fd;
  font-size: 12px;
  font-weight: 800;
}
.apk-hero-prostoi .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--apk-cyan);
  box-shadow: 0 0 0 6px rgba(121, 242, 255, .14);
  animation: apkPulse 1.6s infinite;
}
@keyframes apkPulse {
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
.apk-hero-prostoi .nero-ai-metric--alert strong { color: #fca5a5; }
.apk-hero-prostoi .nero-ai-metric--ok strong { color: #86efac; }
.apk-hero-prostoi .apk-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 28% 42%, rgba(121,242,255,.08), rgba(6,10,24,.94) 74%);
}
.apk-hero-prostoi #apk-hero-shift-canvas {
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
.apk-hero-prostoi .nero-ai-task-icon--alert {
  background: rgba(239,68,68,.14);
  color: #fca5a5;
}
.apk-hero-prostoi .nero-ai-task-icon--ok {
  background: rgba(34,197,94,.12);
  color: #86efac;
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
.apk-hero-prostoi .nero-ai-status--alert {
  background: rgba(239,68,68,.12);
  color: #fecaca;
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
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai производство контроль</p>
      <h1 id="apk-hero-title">AI-агент для сменных заданий и контроля простоев: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Сменные задания, отклонения и простои — в одном отчёте руководителю: AI собирает данные по смене без ручного хаоса в цехе</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Сменные задания</li>
        <li class="nero-ai-badge">Контроль простоев</li>
        <li class="nero-ai-badge">Telegram</li>
        <li class="nero-ai-badge">1С / ERP</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">OEE</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>" <?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#karta-poter">Карта потерь</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-агента смены и контроля простоев">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">смена · ai-агент · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Контроль смены · цех</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--alert">
              <span>Простои смены</span>
              <strong>86 мин</strong>
              <small>−12 мин vs вчера</small>
            </div>
            <div class="nero-ai-metric">
              <span>Доступность OEE</span>
              <strong>88%</strong>
              <small>план/факт смены</small>
            </div>
            <div class="nero-ai-metric">
              <span>Задания в работе</span>
              <strong>14</strong>
              <small>3 линии · 2 участка</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--ok">
              <span>Отчёт готов</span>
              <strong>✓</strong>
              <small>сводка руководителю</small>
            </div>
          </div>

          <div class="apk-dash-canvas-wrap" aria-hidden="false">
            <canvas id="apk-hero-shift-canvas" role="img" aria-label="Анимация: AI-агент выдаёт сменные задания, фиксирует простой и формирует отчёт руководителю"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">1С</span>
              <div><strong>План смены загружен из 1С</strong><span>12 операций · участок сборки</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Задание #1842 выдано в Telegram</strong><span>Оператор · станок ЧПУ-3</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--alert">⏸</span>
              <div><strong>Простой 7 мин — запрос причины</strong><span>Переналадка / нет материала</span></div>
              <span class="nero-ai-status nero-ai-status--amber">ожидание</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--alert">!</span>
              <div><strong>Эскалация мастеру</strong><span>Простой &gt; порога · линия 2</span></div>
              <span class="nero-ai-status nero-ai-status--alert">alert</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--ok">✓</span>
              <div><strong>Сводка руководителю готова</strong><span>Топ-3 потери · OEE 88%</span></div>
              <span class="nero-ai-status">отправлено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * Shift Pulse Room Engine — hero ai-proizvodstvo-kontrol-prostoev
 * Каркас Agent/createBubble из hero-engine-example.js; сцена — диспетчерская смены.
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("apk-hero-shift-canvas");
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
    scale = Math.min(cw / 480, ch / 260) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#cbd5e1",
    floor: "#0f172a",
    floorLine: "rgba(121,242,255,.12)",
    boardBg: "#1e293b",
    boardCol: "#334155",
    gold: "#f5c518",
    cyan: "#79f2ff",
    alert: "#ef4444",
    green: "#22c55e",
    chipTask: "#38bdf8",
    chipIdle: "#f87171",
    chipOk: "#4ade80",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0b1220"
  };

  function drawPolyRound(ctx, x, y, w, h, radius, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, radius);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /** Горизонтальная лента событий смены (вместо Conveyor) */
  class PulseTimeline {
    constructor(x, y, w) {
      this.x = x; this.y = y; this.w = w;
    }
    draw(ctx) {
      drawPolyRound(ctx, this.x, this.y, this.w, 14, 7, C.boardCol, C.outline);
      var offset = (frame * 0.45) % 40;
      ctx.save();
      ctx.beginPath();
      if (ctx.roundRect) ctx.roundRect(this.x + 4, this.y + 3, this.w - 8, 8, 4);
      else ctx.rect(this.x + 4, this.y + 3, this.w - 8, 8);
      ctx.clip();
      ctx.fillStyle = C.cyan;
      for (var i = this.x - 20; i < this.x + this.w + 40; i += 40) {
        ctx.globalAlpha = 0.35 + 0.25 * Math.sin(frame * 0.08 + i * 0.02);
        ctx.fillRect(i - offset, this.y + 5, 12, 4);
      }
      ctx.restore();
    }
  }

  /** Канбан-доска смены (вместо WebsiteTerminal) */
  class ShiftBriefBoard {
    constructor(x, y) {
      this.x = x; this.y = y;
      this.cycle = 0;
      this.reportY = 0;
      this.reportSpeed = 0;
    }
    draw(ctx) {
      this.cycle = (frame * 0.04) % 240;
      drawPolyRound(ctx, this.x - 90, this.y - 70, 180, 130, 8, C.boardBg, C.outline);
      var cols = ["План", "Простой", "Отчёт"];
      for (var c = 0; c < 3; c++) {
        drawPolyRound(ctx, this.x - 82 + c * 58, this.y - 62, 50, 112, 4, C.boardCol, null);
        ctx.fillStyle = C.outline;
        ctx.font = "bold 7px Inter, sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(cols[c], this.x - 57 + c * 58, this.y - 52);
      }
      if (this.cycle > 25) {
        drawPolyRound(ctx, this.x - 78, this.y - 38, 42, 28, 3, C.chipTask, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 6px sans-serif";
        ctx.fillText("#1842", this.x - 57, this.y - 22);
      }
      if (this.cycle > 95 && this.cycle < 175) {
        drawPolyRound(ctx, this.x - 20, this.y - 36, 42, 28, 3, C.chipIdle, C.outline);
        ctx.fillStyle = "#fff";
        ctx.fillText("7 мин", this.x + 1, this.y - 20);
      }
      if (this.cycle > 175) {
        drawPolyRound(ctx, this.x + 38, this.y - 40, 42, 32, 3, C.chipOk, C.outline);
        ctx.fillStyle = "#052e16";
        ctx.fillText("88%", this.x + 59, this.y - 22);
      }
      if (this.cycle > 210) {
        if (this.cycle === 210.04) this.reportSpeed = 0;
        this.reportSpeed += 0.35;
        this.reportY -= this.reportSpeed;
        var ry = this.y - 20 + this.reportY;
        ctx.save();
        ctx.globalAlpha = Math.min(1, (this.cycle - 210) / 12);
        drawPolyRound(ctx, this.x - 18, ry - 30, 36, 48, 3, "#fef3c7", C.outline);
        ctx.fillStyle = C.outline;
        ctx.font = "bold 6px sans-serif";
        ctx.fillText("Отчёт", this.x, ry - 12);
        ctx.fillText("→ дире.", this.x, ry - 4);
        ctx.restore();
      } else {
        this.reportY = 0;
        this.reportSpeed = 0;
      }
    }
  }

  class DowntimeBeacon {
    constructor(x, y) {
      this.x = x; this.y = y;
    }
    draw(ctx) {
      var prg = (frame * 0.04) % 240;
      if (prg < 100 || prg > 175) return;
      var pulse = 0.5 + 0.5 * Math.sin(frame * 0.25);
      ctx.save();
      ctx.globalAlpha = 0.35 + pulse * 0.45;
      ctx.fillStyle = C.alert;
      ctx.beginPath();
      ctx.arc(this.x, this.y, 8 + pulse * 4, 0, Math.PI * 2);
      ctx.fill();
      drawPolyRound(ctx, this.x - 4, this.y - 18, 8, 14, 2, C.alert, C.outline);
      ctx.restore();
    }
  }

  class OeeRingGauge {
    constructor(x, y, r) {
      this.x = x; this.y = y; this.r = r;
    }
    draw(ctx) {
      var prg = (frame * 0.04) % 240;
      var fill = prg > 175 ? 0.88 : Math.min(0.55, prg / 320);
      ctx.lineWidth = 5;
      ctx.strokeStyle = "rgba(148,163,184,.25)";
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
      ctx.stroke();
      ctx.strokeStyle = prg > 175 ? C.green : C.gold;
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.r, -Math.PI / 2, -Math.PI / 2 + Math.PI * 2 * fill);
      ctx.stroke();
      ctx.fillStyle = C.outline;
      ctx.font = "bold 9px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(Math.round(fill * 100) + "%", this.x, this.y + 3);
    }
  }

  class Agent {
    constructor(x, y, color, role, stepTrig, dialogs, station) {
      this.x = x; this.y = y;
      this.baseX = x; this.baseY = y;
      this.color = color;
      this.role = role;
      this.timer = Math.random() * 100;
      this.stepTrig = stepTrig;
      this.dialogs = dialogs;
      this.station = station;
      this.hitAnimation = 0;
    }
    draw(ctx) {
      this.timer += 0.035;
      var isMoving = false;
      var carryType = null;
      var faceDir = 1;
      var prg = (frame * 0.04) % 240;
      var tx = this.station.x;
      var ty = this.station.y;

      if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
        var local = prg - this.stepTrig;
        if (local < 12) {
          isMoving = true;
          faceDir = tx > this.baseX ? 1 : -1;
          carryType = this.color;
          this.x = this.baseX + (tx - this.baseX) * (local / 12);
          this.y = this.baseY + (ty - this.baseY) * (local / 12);
        } else if (local < 16) {
          this.x = tx; this.y = ty;
        } else {
          isMoving = true;
          faceDir = -faceDir;
          this.x = tx - (tx - this.baseX) * ((local - 16) / 12);
          this.y = ty - (ty - this.baseY) * ((local - 16) / 12);
        }
      } else {
        this.x = this.baseX;
        this.y = this.baseY;
        carryType = prg >= this.stepTrig - 8 ? this.color : null;
      }

      if (!isMoving) {
        var chipX = -220 + ((frame * 0.4 + this.baseX * 0.3) % 220);
        if (Math.abs(chipX - this.x) < 18) this.hitAnimation = Math.sin(frame * 0.3) * 6;
        else this.hitAnimation = 0;
        if (frame % 180 === 0 && Math.random() < 0.12) {
          createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
        }
      } else {
        this.hitAnimation = 0;
      }

      var bob = Math.abs(Math.sin(this.timer * 3)) * 2;
      if (!isMoving) bob = Math.sin(this.timer * 1.5);

      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.lineJoin = "round";
      var legL = 0, legR = 0;
      if (isMoving) {
        var walk = this.timer * 6;
        legL = Math.sin(walk) * 4;
        legR = Math.sin(walk + Math.PI) * 4;
      }
      drawPolyRound(ctx, -9, -4 + Math.max(0, legL), 7, 12, 2, C.outline, null);
      drawPolyRound(ctx, -11, 4 + Math.max(0, legL), 11, 5, 2, C.outline, null);
      drawPolyRound(ctx, 2, -4 + Math.max(0, legR), 7, 12, 2, C.outline, null);
      drawPolyRound(ctx, 0, 4 + Math.max(0, legR), 11, 5, 2, C.outline, null);
      drawPolyRound(ctx, -14, -10 - bob, 28, 18, 5, this.color, C.outline);
      var hx = 0, hy = -24 - bob;
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(hx, hy, 10, 0, Math.PI * 2);
      ctx.fill();
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = C.outline;
      ctx.stroke();
      ctx.save();
      ctx.scale(faceDir, 1);
      ctx.fillStyle = "#fff";
      ctx.beginPath(); ctx.arc(hx + 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
      ctx.fillStyle = C.outline;
      ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(hx - 2, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
      if (this.role === "1_architect") {
        ctx.strokeStyle = C.outline;
        ctx.strokeRect(hx + 1, hy - 4, 5, 5);
        ctx.strokeRect(hx - 6, hy - 4, 5, 5);
      } else if (this.role === "2_seo") {
        drawPolyRound(ctx, hx - 10, hy - 12, 20, 6, [4, 4, 0, 0], C.outline, null);
      } else if (this.role === "3_coder") {
        ctx.fillStyle = C.outline;
        ctx.fillRect(hx - 8, hy - 10, 16, 3);
        ctx.fillRect(hx - 5, hy - 14, 10, 3);
      } else if (this.role === "4_designer") {
        drawPolyRound(ctx, hx - 12, hy - 10, 24, 5, 2, "#f43f5e", C.outline);
      } else if (this.role === "5_deployer") {
        ctx.strokeStyle = C.outline;
        ctx.beginPath();
        ctx.arc(hx, hy, 12, Math.PI, Math.PI * 2);
        ctx.stroke();
      }
      ctx.restore();
      if (carryType) drawPolyRound(ctx, -16 * faceDir, -14 - bob, 14, 14, 2, carryType, C.outline);
      ctx.restore();
    }
  }

  var entities = [];
  var bubbles = [];
  var timeline = new PulseTimeline(-200, 52, 400);
  var board = new ShiftBriefBoard(0, -10);
  var beacon = new DowntimeBeacon(95, -55);
  var oee = new OeeRingGauge(-115, -35, 22);
  entities.push(timeline);
  entities.push(board);
  entities.push(beacon);
  entities.push(oee);
  entities.push(new Agent(-175, 38, C.agentYellow, "1_architect", 18, ["План из 1С...", "Аудит смены", "Карта потерь"], { x: -95, y: -5 }));
  entities.push(new Agent(-120, 58, C.agentGreen, "2_seo", 55, ["OEE 88%...", "Топ простоев", "Парето готово"], { x: -40, y: -45 }));
  entities.push(new Agent(-55, 30, C.agentBlue, "3_coder", 88, ["TG #1842", "Бот смены", "Статус в ERP"], { x: 30, y: -8 }));
  entities.push(new Agent(10, 55, C.agentPink, "4_designer", 118, ["Панель мастера", "Alert простоя", "UI смены"], { x: 85, y: -42 }));
  entities.push(new Agent(55, 25, C.agentPurple, "5_deployer", 168, ["Отчёт PDF", "→ директору", "Смена закрыта"], { x: 55, y: -58 }));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 240, maxLife: customLife || 240 });
  }

  function drawTaskChips(ctx) {
    var prg = (frame * 0.04) % 240;
    var colors = [C.chipTask, C.chipIdle, C.chipOk];
    for (var n = 0; n < 3; n++) {
      var px = -220 + ((frame * 0.4 + n * 75) % 220);
      if (px > 110) continue;
      drawPolyRound(ctx, px, 48, 14, 10, 2, colors[n], C.outline);
    }
  }

  function drawFloorGrid(ctx) {
    ctx.strokeStyle = C.floorLine;
    ctx.lineWidth = 1;
    for (var g = -200; g <= 200; g += 40) {
      ctx.globalAlpha = 0.35 + 0.15 * Math.sin(frame * 0.05 + g * 0.01);
      ctx.beginPath();
      ctx.moveTo(g, 20);
      ctx.lineTo(g - 30, 70);
      ctx.stroke();
    }
    ctx.globalAlpha = 1;
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);
    drawFloorGrid(ctx);
    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });
    drawTaskChips(ctx);

    var prg = (frame * 0.04) % 240;
    if (prg >= 12 && prg < 12.05) createBubble(-175, 10, "1. Аудит смены");
    if (prg >= 52 && prg < 52.05) createBubble(-120, 30, "2. Карта потерь");
    if (prg >= 92 && prg < 92.05) createBubble(-55, 5, "3. Telegram-задание");
    if (prg >= 122 && prg < 122.05) createBubble(10, 28, "4. Простой 7 мин");
    if (prg >= 172 && prg < 172.05) createBubble(55, 0, "5. Отчёт руководителю");

    ctx.font = "bold 10px Inter, sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 24);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var bx = bub.x;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawPolyRound(ctx, bx - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.cyan);
      ctx.fillStyle = "#e2e8f0";
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


<div class="apk-content">

  <section class="apk-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="apk-cnt">
      <div class="apk-intro-grid nero-ai-reveal">
        <div class="apk-intro-text">
          <p class="apk-eyebrow">Лонгрид · ai производство контроль</p>
          <p><strong>Коротко:</strong> AI-агент для производства собирает данные по смене, фиксирует простои и отклонения в моменте и формирует отчёт руководителю — вместо ручных сменных заданий в Excel и «вспоминания» потерь на следующий день.</p>
          <p>Мы внедряем такие решения для малого производства: мебельные цеха, пищевые линии, сборочные участки с 5–50 рабочими местами. Не тяжёлый MES на три года — а операционный слой между цехом и директором: Telegram для операторов, панель для мастера, сводка для руководителя.</p>
        </div>
        <div class="apk-intro-kpi" aria-label="Ключевые метрики смены">
          <div class="apk-kpi-card"><div class="kv">2–4 ч</div><div class="kl">рутина мастера без агента</div><div class="ks">на смену</div></div>
          <div class="apk-kpi-card"><div class="kv">88%</div><div class="kl">доступность при 86 мин простоя</div><div class="ks">пример смены</div></div>
          <div class="apk-kpi-card"><div class="kv">98,7%</div><div class="kl">полнота полей учёта</div><div class="ks">Telegram-паттерн</div></div>
          <div class="apk-kpi-card"><div class="kv">4–8 нед</div><div class="kl">пилот на одном участке</div><div class="ks">под ключ</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="apk-toc-outer">
    <div class="apk-cnt">
      <nav class="apk-toc" aria-label="Оглавление статьи">
        <a href="#problem">Боли</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#prostoi-oee">OEE</a>
        <a href="#scenarii">Отрасли</a>
        <a href="#integracii">Интеграции</a>
        <a href="#etapy">Внедрение</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#trendy">Тренды 2026</a>
        <a href="#karta-poter">Карта потерь</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Следующий шаг</a>
      </nav>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <section class="apk-section" id="problem">
    <div class="apk-cnt">
      <div class="apk-sh apk-left nero-ai-reveal">
        <span class="apk-eyebrow">Проблема</span>
        <h2>Почему на производстве теряют деньги на простоях и ручных сменных заданиях</h2>
        <p><strong>Определение:</strong> простой — любой период, когда оборудование или рабочее место не выполняет плановую операцию. Контроль простоев без цифровой фиксации почти всегда даёт заниженную картину потерь.</p>
      </div>

      <div class="apk-grid-3 nero-ai-reveal">
        <div class="apk-card">
          <h3>Excel и бумага вместо плана смены</h3>
          <p>Задачи меняются вручную — заказ сорвался, материал задержали, оператор заболел. К концу смены никто не уверен, что план/факт совпадает с реальностью.</p>
        </div>
        <div class="apk-card nero-ai-delay-1">
          <h3>Руководитель узнаёт о простое поздно</h3>
          <p>Оператор остановил станок в 10:15, а в журнале запись в 16:40 «по памяти». OEE считается «на глаз» или в Excel с задержкой в сутки.</p>
        </div>
        <div class="apk-card nero-ai-delay-2">
          <h3>Скрытые потери малого цеха</h3>
          <p>Мастер тратит 2–4 часа смены на рутину. В пищевой промышленности средний OEE часто 55–65% — треть мощности «утекает» в неучтённые потери.</p>
        </div>
      </div>

      <div class="apk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apk-table">
          <thead><tr><th>Сегмент</th><th>Типичная боль</th><th>Что не видно без учёта</th></tr></thead>
          <tbody>
            <tr><td>Мебельный цех</td><td>Переналадки ЧПУ, смена фрез</td><td>Реальное время наладки vs норма</td></tr>
            <tr><td>Пищевое производство</td><td>Санитарные окна, смена плёнки</td><td>OEE линии упаковки как «чёрная дыра»</td></tr>
            <tr><td>Сборочный участок</td><td>Нет материала, нет задания</td><td>Простой «ожидание планирования»</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="kak-rabotaet">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Решение</span>
        <h2>Что делает AI-агент для сменных заданий и контроля простоев</h2>
        <p>AI-агент получает план смены, раздаёт задания операторам, фиксирует события и готовит сводку для руководителя — ai контроль простоев встроен в тот же цикл.</p>
      </div>

      <div class="apk-grid-3 nero-ai-reveal">
        <div class="apk-card"><h3>Сбор данных без ручного ввода</h3><p>План из 1С, ERP или Excel. Статус — кнопкой в Telegram. Голосовое мастера агент парсит и предлагает изменение плана.</p></div>
        <div class="apk-card nero-ai-delay-1"><h3>Фиксация простоев в моменте</h3><p>При простое &gt; порога — запрос причины из классификатора. Критичный простой эскалируется мастеру с регламентом из базы знаний.</p></div>
        <div class="apk-card nero-ai-delay-2"><h3>Автоотчёт руководителю</h3><p>План/факт, топ-3 причины простоев, OEE, черновик передачи смены. Мастер правит и подписывает за 5–15 минут.</p></div>
      </div>

      <div class="apk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apk-table">
          <thead><tr><th>Этап</th><th>Без агента</th><th>С AI-агентом</th></tr></thead>
          <tbody>
            <tr><td>Утро</td><td>Сбор плана из 5 источников, 45–90 мин</td><td>План из 1С → утверждение, 10–15 мин</td></tr>
            <tr><td>Смена</td><td>Звонки, правки в чатах, журнал «потом»</td><td>Задания в Telegram, простои в моменте</td></tr>
            <tr><td>Конец смены</td><td>1–2 ч на отчёт и передачу</td><td>5–15 мин на проверку сводки агента</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

<section id="ai-proizvodstvo-kontrol-prostoev-boris-block" class="apk-b-root" aria-label="Анимация: карта потерь смены и фиксация простоев в реальном времени">
<style>
/* === БОРИС: prefix apk-b-, scoped внутри #ai-proizvodstvo-kontrol-prostoev-boris-block === */
#ai-proizvodstvo-kontrol-prostoev-boris-block.apk-b-root{
  padding:clamp(48px,6vw,72px) 0;
  background:#f8fafc;
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:520px;
}
@media(max-width:1023px){
  #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#b45309;
  margin:0 0 14px;
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-ey::before{
  content:'';
  width:18px;height:2px;
  background:#f5c518;
  border-radius:1px;
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(245,197,24,.12);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#b45309;
  margin-top:1px;
  font-style:normal;
  font-weight:700;
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-pl-r{
  background:rgba(239,68,68,.08);
  color:#b91c1c;
  border:1.5px solid rgba(239,68,68,.22);
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-pl-c{
  background:rgba(121,242,255,.12);
  color:#0e7490;
  border:1.5px solid rgba(14,165,233,.25);
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-rgt{
  position:relative;
  background:linear-gradient(145deg,#fffbeb 0%,#fef9c3 18%,#f0f9ff 55%,#f8fafc 100%);
  min-height:460px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-b-rgt{min-height:400px;}
}
#apk-shift-loss-map-canvas{
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
      <span class="apk-b-ey">Контроль в моменте</span>
      <h3 class="apk-b-h3">Карта потерь смены: простой фиксируется сразу, а не «по памяти» в конце дня</h3>
      <ul class="apk-b-ul">
        <li><span class="apk-b-ic">1</span>AI видит остановку на рабочем месте и запускает таймер — без ожидания вечернего журнала</li>
        <li><span class="apk-b-ic">2</span>Оператор выбирает причину из классификатора; агент сверяет с регламентом и эскалирует мастеру</li>
        <li><span class="apk-b-ic">3</span>Парето причин и кольцо OEE обновляются в смене — руководитель получает сводку, не Excel наутро</li>
        <li><span class="apk-b-ic">✓</span>Human-in-the-loop: критичные решения подтверждает мастер, агент ведёт audit log</li>
      </ul>
      <div class="apk-b-pills">
        <span class="apk-b-pl apk-b-pl-r">7 мин → эскалация</span>
        <span class="apk-b-pl apk-b-pl-g">OEE live</span>
        <span class="apk-b-pl apk-b-pl-c">98,7% полнота полей</span>
      </div>
      <p class="apk-b-foot">Дальше разберём, как устроен контроль простоев, OEE и карта потерь производства →</p>
    </div>

    <div class="apk-b-rgt">
      <canvas
        id="apk-shift-loss-map-canvas"
        aria-label="Анимация: тепловая карта рабочих мест цеха, фиксация простоя, обновление OEE и отправка отчёта руководителю"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('apk-shift-loss-map-canvas');
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
    panel:'#ffffff',
    panelBdr:'#cbd5e1',
    gold:'#f5c518',
    cyan:'#06b6d4',
    cyanGlow:'rgba(6,182,212,.25)',
    green:'#22c55e',
    greenSoft:'rgba(34,197,94,.15)',
    red:'#ef4444',
    redSoft:'rgba(239,68,68,.18)',
    orange:'#f59e0b',
    violet:'#8b5cf6',
    grid:'rgba(148,163,184,.35)',
    floor:'#f1f5f9',
    floorDark:'#e2e8f0'
  };

  var STATIONS = [
    {id:'Станок 1', col:0, row:0, status:'ok'},
    {id:'Станок 2', col:1, row:0, status:'ok'},
    {id:'Линия 2', col:2, row:0, status:'down', reason:'Переналадка', since:7},
    {id:'Упаковка', col:0, row:1, status:'ok'},
    {id:'Сборка', col:1, row:1, status:'warn', reason:'Нет материала', since:3},
    {id:'ЧПУ-3', col:2, row:1, status:'ok'}
  ];

  var PARETO = [
    {label:'Переналадка', val:34, color:C.orange},
    {label:'Нет материала', val:22, color:C.red},
    {label:'Настройка', val:14, color:C.violet},
    {label:'Прочее', val:8, color:C.muted}
  ];

  var LOOP = 720;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function txt(str,x,y,size,color,align,bold){
    ctx.fillStyle=color||C.ink;
    ctx.font=(bold?'bold ':'')+(size||12)+'px Inter,system-ui,sans-serif';
    ctx.textAlign=align||'left';
    ctx.textBaseline='middle';
    ctx.fillText(str,x,y);
  }

  function phase(){
    var t = frame % LOOP;
    if(t < 120) return 0;      /* все работают */
    if(t < 220) return 1;      /* простой линии 2 */
    if(t < 320) return 2;      /* запрос причины */
    if(t < 420) return 3;      /* классификация + парето */
    if(t < 520) return 4;      /* OEE dip */
    if(t < 620) return 5;      /* отчёт */
    return 6;                  /* отправка */
  }

  function drawHeader(x,y,w){
    rr(x,y,w,36,8,C.panel,C.panelBdr,1);
    rr(x+10,y+10,8,8,2,C.green,null,0);
    txt('карта потерь · смена #1842',x+24,y+18,11,C.muted,'left',true);
    var liveX = x+w-72;
    rr(liveX,y+8,62,20,10,C.redSoft,C.red,1);
    txt('LIVE',liveX+31,y+18,9,C.red,'center',true);
  }

  function drawGrid(ox,oy,gw,gh,cellW,cellH,gap){
    var ph = phase();
    var pulse = 0.5 + 0.5*Math.sin(frame*0.12);

    for(var i=0;i<STATIONS.length;i++){
      var st = STATIONS[i];
      var cx = ox + st.col*(cellW+gap);
      var cy = oy + st.row*(cellH+gap);
      var isDown = st.status==='down' && ph>=1;
      var isWarn = st.status==='warn' && ph>=1;
      var fill = C.greenSoft;
      var bdr = C.green;
      if(isDown){ fill = C.redSoft; bdr = C.red; }
      else if(isWarn){ fill = 'rgba(245,158,11,.15)'; bdr = C.orange; }

      if((isDown||isWarn) && ph>=1){
        ctx.globalAlpha = 0.35 + pulse*0.35;
        rr(cx-4,cy-4,cellW+8,cellH+8,10,'transparent',bdr,2);
        ctx.globalAlpha = 1;
      }

      rr(cx,cy,cellW,cellH,8,fill,bdr,1.5);
      rr(cx+8,cy+8,cellW-16,cellH*0.42,4,C.floor,C.floorDark,1);

      /* мини-станок */
      var mx = cx+cellW*0.5-14;
      var my = cy+cellH*0.55;
      rr(mx,my,28,18,3,isDown?C.red:(isWarn?C.orange:C.cyan),C.ink,1);
      rr(mx+4,my+4,8,6,1,C.panel,null,0);
      rr(mx+16,my+4,8,6,1,C.panel,null,0);

      txt(st.id,cx+cellW/2,cy+cellH-10,9,C.ink,'center',true);

      if(isDown && ph>=1){
        var mins = st.since + Math.floor((frame%LOOP-120)/45);
        rr(cx+6,cy+6,52,16,4,C.red,C.red,0);
        txt('⏱ '+mins+' мин',cx+32,cy+14,8,'#fff','center',true);
      }
    }

    /* AI-сканер */
    if(ph>=1 && ph<=4){
      var scanY = oy + ((frame*2)%(gh));
      ctx.strokeStyle = C.cyanGlow;
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.moveTo(ox-6, scanY);
      ctx.lineTo(ox+gw+6, scanY);
      ctx.stroke();
    }
  }

  function drawOeeRing(cx,cy,r,avail){
    ctx.lineWidth = 10;
    ctx.strokeStyle = C.floorDark;
    ctx.beginPath();
    ctx.arc(cx,cy,r,0,Math.PI*2);
    ctx.stroke();

    var ph = phase();
    var target = ph>=4 ? 0.82 : 0.91;
    var start = -Math.PI/2;
    var end = start + Math.PI*2*target;
    ctx.strokeStyle = ph>=4 ? C.orange : C.green;
    ctx.beginPath();
    ctx.arc(cx,cy,r,start,end);
    ctx.stroke();

    txt('OEE',cx,cy-6,10,C.muted,'center',true);
    txt(Math.round(target*100)+'%',cx,cy+10,16,C.ink,'center',true);
  }

  function drawPareto(x,y,w,h,progress){
    rr(x,y,w,h,8,C.panel,C.panelBdr,1);
    txt('Топ причин простоя',x+12,y+14,10,C.muted,'left',true);
    var barW = (w-24)/PARETO.length - 6;
    var maxVal = 40;
    for(var i=0;i<PARETO.length;i++){
      var p = PARETO[i];
      var bx = x+12 + i*(barW+6);
      var bh = (h-50)*(p.val/maxVal)*progress;
      var by = y+h-16-bh;
      rr(bx,by,barW,bh,3,p.color,null,0);
      txt(p.label,bx+barW/2,y+h-6,7,C.muted,'center',false);
    }
  }

  function drawBubble(x,y,w,text,sub){
    rr(x,y,w,sub?52:40,10,C.panel,C.cyan,1.5);
    ctx.fillStyle = C.cyan;
    ctx.beginPath();
    ctx.moveTo(x+18,y+ (sub?52:40));
    ctx.lineTo(x+26,y+ (sub?52:40)+8);
    ctx.lineTo(x+34,y+ (sub?52:40));
    ctx.fill();
    txt(text,x+12,y+(sub?16:14),10,C.ink,'left',true);
    if(sub) txt(sub,x+12,y+32,9,C.muted,'left',false);
  }

  function drawReportCard(x,y,alpha,slide){
    ctx.globalAlpha = alpha;
    var rx = x + slide;
    rr(rx,y,148,88,10,C.panel,C.gold,2);
    rr(rx+10,y+10,128,10,3,C.gold,null,0);
    txt('Отчёт смены',rx+74,y+28,10,C.ink,'center',true);
    txt('План/факт · топ-3 потери',rx+74,y+44,8,C.muted,'center',false);
    rr(rx+10,y+58,60,18,4,C.greenSoft,C.green,1);
    txt('Telegram ✓',rx+40,y+67,8,C.green,'center',true);
    rr(rx+78,y+58,60,18,4,'rgba(121,242,255,.15)',C.cyan,1);
    txt('PDF',rx+108,y+67,8,C.cyan,'center',true);
    ctx.globalAlpha = 1;
  }

  function draw(){
    ctx.clearRect(0,0,W,H);
    var pad = Math.max(14, W*0.04);
    var headerY = pad;
    var headerW = W - pad*2;

    drawHeader(pad, headerY, headerW);

    var gridY = headerY + 48;
    var gridW = W*0.58;
    var gridH = H - gridY - pad - 70;
    var cellW = (gridW - 16)/3;
    var cellH = (gridH - 12)/2;

    /* пол */
    rr(pad-4, gridY-4, gridW+8, gridH+8,10,C.floor,C.grid,1);
    drawGrid(pad, gridY, gridW, gridH, cellW, cellH, 8);

    /* OEE */
    var oeeX = pad + gridW + (W - pad - gridW - pad)*0.5;
    var oeeY = gridY + gridH*0.32;
    var oeeR = Math.min(42, gridH*0.18);
    drawOeeRing(oeeX, oeeY, oeeR, 0.91);

    var ph = phase();
    var prog = ph>=3 ? Math.min(1,(frame%LOOP-320)/80) : 0;

    /* Парето */
    var parX = pad + gridW + 8;
    var parW = W - parX - pad;
    var parY = gridY + gridH*0.55;
    var parH = gridH*0.42;
    if(parW > 60) drawPareto(parX, parY, parW, parH, prog);

    /* AI bubble */
    if(ph===2){
      drawBubble(pad+gridW*0.55, gridY+cellH*0.2, 156, 'Запрос причины', 'Простой > 5 мин · Линия 2');
    }
    if(ph===3){
      rr(pad+gridW*0.52, gridY+cellH*0.55, 120, 22, 6,'rgba(245,158,11,.12)',C.orange,1);
      txt('✓ Переналадка', pad+gridW*0.52+60, gridY+cellH*0.55+11, 9, C.orange, 'center', true);
    }

    /* Отчёт */
    if(ph>=5){
      var slide = Math.min(1,(frame%LOOP-520)/60);
      drawReportCard(oeeX-74, oeeY+oeeR+24, 0.85+0.15*slide, slide*18);
    }
    if(ph===6){
      ctx.strokeStyle = C.cyan;
      ctx.lineWidth = 1.5;
      ctx.setLineDash([4,4]);
      ctx.beginPath();
      ctx.moveTo(oeeX, oeeY+oeeR+60);
      ctx.lineTo(oeeX+40, oeeY+oeeR+90);
      ctx.stroke();
      ctx.setLineDash([]);
      txt('→ руководителю', oeeX+44, oeeY+oeeR+92, 9, C.cyan, 'left', true);
    }

    frame++;
    requestAnimationFrame(draw);
  }

  draw();
})();
</script>
</section>


  <section class="apk-section" id="prostoi-oee">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">OEE</span>
        <h2>Как устроен контроль простоев и OEE с AI</h2>
        <p><strong>OEE</strong> = Доступность × Производительность × Качество. Для малого цеха достаточно начать с доступности — учёт простоев даёт 80% пользы OEE без полного MES.</p>
      </div>

      <div class="apk-card nero-ai-reveal">
        <div class="apk-timeline">
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Уровень 1: ручные отметки</h3><p>Telegram или терминал — старт за 2–3 недели, без датчиков.</p></div>
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Уровень 2: гибрид</h3><p>Датчики на ключевых станках + ручная классификация причин — сверка «датчик vs оператор».</p></div>
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Уровень 3: полный мониторинг</h3><p>MonitoringLite и аналоги — OEE в реальном времени; AI-агент добавляет сменные задания и отчётность поверх.</p></div>
        </div>
      </div>

      <div class="apk-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="apk-card">
          <h3>Карта потерь производства</h3>
          <p>Паспорт смены → таблица простоев → классификатор → доступность → дерево потерь → Парето → стоимость в рублях. Пример: смена 12 ч, 86 мин простоев → доступность 88%.</p>
        </div>
        <div class="apk-card">
          <h3>Human-in-the-loop</h3>
          <p>Gartner: &gt;40% agentic AI-проектов могут быть отменены к 2027. Агент собирает и предлагает; мастер утверждает план, классификацию и передачу смены — каждая рекомендация со ссылкой на регламент.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="scenarii">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Отрасли</span>
        <h2>Сценарии для малого производства</h2>
        <p>Ai производство контроль для малого бизнеса — не уменьшенный заводской MES, а сценарии под 5–50 сотрудников.</p>
      </div>
      <div class="apk-scenario nero-ai-reveal"><h3>Мебельный цех: сменные задания и переналадки</h3><p>Очередь операций по приоритету отгрузки → задания в Telegram → код «смена инструмента» → Парето по наладке за неделю. Кейсы MonitoringLite: Кузнецкий МК, SV-Мебель.</p></div>
      <div class="apk-scenario nero-ai-reveal"><h3>Пищевое производство: партии и санитарные окна</h3><p>Кейс Bizerba на АПК «Камский»: 35% простоев — смена материалов; после мер сокращение на 50%. Агент отделяет плановые санитарные окна от аварийных простоев.</p></div>
      <div class="apk-scenario nero-ai-reveal"><h3>Универсальный цех 5–50 человек</h3><p>Telegram-учёт за 30 секунд + AI-слой: суммаризация смены, поиск повторов, ответы по регламентам — без тяжёлого MES на старте.</p></div>

      <div class="apk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apk-table">
          <thead><tr><th>Инструмент</th><th>Когда подходит</th><th>Ограничения</th></tr></thead>
          <tbody>
            <tr><td>Бумага / журнал</td><td>До 5 человек</td><td>Нет трендов, поздняя фиксация</td></tr>
            <tr><td>Excel</td><td>Есть мастер-«табличник»</td><td>Нет алертов, версии путаются</td></tr>
            <tr><td>MES под ключ</td><td>50+ станков</td><td>Срок 3–8 мес., нужен IT</td></tr>
            <tr><td><strong>AI-агент смены</strong></td><td>5–50 чел., боль «задания + простои»</td><td>Не заменяет SCADA с первого дня</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="apk-section" id="integracii">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Интеграции</span>
        <h2>Интеграции: 1С, ERP, CRM, Telegram и датчики</h2>
        <p>Интеграция ai производство контроль — не «большой IT-проект». Типовой стек: 1С, Telegram, Excel/CSV, n8n/Make.</p>
      </div>
      <div class="apk-grid-2 nero-ai-reveal">
        <div class="apk-card"><h3>На старте без IT-отдела</h3><p>1С:УПП, 1С:ERP — заказы и номенклатура. Telegram — интерфейс оператора. n8n — триггеры: простой → задача → уведомление директору.</p></div>
        <div class="apk-card nero-ai-delay-1"><h3>Когда нужен MES</h3><p>10+ станков с OPC/Modbus — гибрид с MonitoringLite. Полный traceability — MES как следующий этап после пилота.</p></div>
      </div>
      <div class="apk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apk-table">
          <thead><tr><th>Ситуация</th><th>Рекомендация</th></tr></thead>
          <tbody>
            <tr><td>Нет датчиков, учёт ручной</td><td>AI-агент + Telegram</td></tr>
            <tr><td>Есть 1С, нет оперативки в цехе</td><td>Агент поверх 1С</td></tr>
            <tr><td>10+ станков с OPC</td><td>Датчики + агент заданий</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="etapy">
    <div class="apk-cnt">
      <div class="apk-sh apk-left nero-ai-reveal">
        <span class="apk-eyebrow">Под ключ</span>
        <h2>Внедрение AI в производство под ключ: этапы и сроки</h2>
        <p>4–8 недель на одном участке: аудит → MVP в Telegram → AI-слой → масштабирование.</p>
      </div>
      <div class="apk-card nero-ai-reveal">
        <div class="apk-timeline">
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Неделя 1: аудит и карта потерь</h3><p>Интервью мастера, наблюдение смены, расчёт стоимости часа простоя. Аудит рынка: 80–180 тыс. ₽.</p></div>
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Недели 2–4: пилот на участке</h3><p>Telegram-бот, классификатор 10–15 кодов, AI-суммаризация и отчёт руководителю. Ориентир: 420 тыс.–1,8 млн ₽.</p></div>
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Масштабирование</h3><p>Второй участок, датчики (опционально), обучение мастеров, KPI в договоре.</p></div>
        </div>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до пилота в цехе?</p>
    <p class="ym-cta-block__sub">Перед внедрением AI-агента смены полезно разобраться в agentic AI, n8n, Telegram-интеграциях и human-in-the-loop — это ускоряет обучение мастеров и согласование KPI с руководством. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#'); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
  </div>
</aside>
    </div>
  </section>

  <section class="apk-section" id="ceny">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI для контроля простоев и как считать ROI</h2>
        <p>Ориентир чека: 500 тыс.–2 млн ₽ — зависит от числа линий, интеграций и on-premise LLM.</p>
      </div>
      <div class="apk-table-wrap nero-ai-reveal">
        <table class="apk-table">
          <thead><tr><th>Фактор</th><th>Влияние на стоимость</th></tr></thead>
          <tbody>
            <tr><td>Количество рабочих мест / линий</td><td>1 участок vs 3 цеха</td></tr>
            <tr><td>Интеграции (1С, датчики, CRM)</td><td>+150–400 тыс. ₽</td></tr>
            <tr><td>On-premise LLM vs облако</td><td>Безопасность 152-ФЗ</td></tr>
            <tr><td>Поддержка</td><td>25–80 тыс. ₽/мес</td></tr>
          </tbody>
        </table>
      </div>
      <div class="apk-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Калькулятор окупаемости</h3>
        <p>Годовой эффект ≈ (сокращение минут простоя в месяц / 60) × ставка часа простоя × 12. Пример: 29 ч/мес неучтённого простоя × 3 000 ₽/ч ≈ 1,04 млн ₽/год. Пилот 800 тыс. ₽ окупается менее чем за год только за счёт видимости.</p>
      </div>
      <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Узнайте, где теряете деньги на простоях</p>
    <p class="ym-cta-block__sub">Ориентир 500 тыс.–2 млн ₽ за внедрение под ключ. На экспресс-аудите «Карта потерь» назовём бюджет пилота и ROI по вашему цеху — без обязательств.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a href="#karta-poter" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Карта потерь производства</a>
    </div>
  </div>
</div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="keisy">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI на производстве</h2>
        <p>Смежные внедрения с оговоркой: не выдаём их за точный дубль продукта «сменные задания + простои».</p>
      </div>
      <div class="apk-case-grid nero-ai-reveal">
        <div class="apk-case-card"><div class="apk-case-tag">Noltis</div><h3>ИИ-помощник мастера</h3><p>−18% простоев, +12% выработки (данные вендора). Telegram + 1С/ERP.</p></div>
        <div class="apk-case-card"><div class="apk-case-tag">АПК «Камский»</div><h3>Упаковочная линия</h3><p>−50% простоев на смене материалов, +18% рентабельности за 9 мес.</p></div>
        <div class="apk-case-card"><div class="apk-case-tag">GroupBWT</div><h3>Agentic AI + human approval</h3><p>−31% незапланированных простоев на 14 линиях за 6 мес.</p></div>
      </div>
      <div class="apk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apk-table">
          <thead><tr><th>Метрика</th><th>До</th><th>После</th></tr></thead>
          <tbody>
            <tr><td>Фиксация простоя</td><td>Конец смены</td><td>Момент остановки</td></tr>
            <tr><td>Время отчёта мастеру</td><td>1–2 ч</td><td>5–15 мин</td></tr>
            <tr><td>Латентность для директора</td><td>Следующий день</td><td>&lt; 2 мин после смены</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="apk-section" id="trendy">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">2026</span>
        <h2>Agentic AI в производстве в 2026: тренды и риски</h2>
        <p>Сдвиг от copilot к agentic execution — агент действует по триггеру, человек при низкой уверенности.</p>
      </div>
      <div class="apk-grid-2 nero-ai-reveal">
        <div class="apk-card"><h3>Gartner: до 40% проектов отменят</h3><p>Рост затрат, неясная ценность, слабый risk control. Решение: пилот с KPI, human-in-the-loop, audit log.</p></div>
        <div class="apk-card nero-ai-delay-1"><h3>Проверяемый результат</h3><p>Агент не останавливает линию по безопасности без человека. Позиция: второй мастер смены, не замена инженера.</p></div>
      </div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="karta-poter">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Лид-магнит</span>
        <h2>Карта потерь производства</h2>
        <p>Бесплатный вход в проект: вы видите свои цифры до покупки пилота.</p>
      </div>
      <div class="apk-card nero-ai-reveal">
        <ol style="margin:0;padding-left:20px;color:var(--apk-muted);line-height:1.8;">
          <li>Назначьте наблюдателя на смену</li>
          <li>Фиксируйте каждый простой &gt; 3 мин: время, станок, причина</li>
          <li>Посчитайте доступность и топ-3 причины</li>
          <li>Умножьте часы простоя на ставку — минимальная оценка потерь</li>
        </ol>
      </div>
    </div>
  </section>

  <section class="apk-section" id="faq">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">FAQ</span>
        <h2>Частые вопросы о внедрении AI на производстве</h2>
      </div>
      <div class="apk-faq nero-ai-reveal">
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли отдельный MES?</div><div class="apk-faq-a">Нет на старте. AI-агент закрывает 80% боли учёта смены быстрее и дешевле MES. MES — логичный следующий шаг после пилота.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько длится пилот?</div><div class="apk-faq-a">4–6 недель на одном участке: неделя 1 — аудит; недели 2–4 — MVP + AI-слой; недели 5–6 — стабилизация.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Какие данные нужны для старта?</div><div class="apk-faq-a">Справочник оборудования, нормы на ключевые операции, классификатор причин (10 кодов), регламенты для RAG, роли сотрудников.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Безопасность данных и 152-ФЗ</div><div class="apk-faq-a">Облако (Yandex Cloud) или on-premise LLM. Разграничение прав и audit log изменений.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-агент отличается от автоматизации отчётов?</div><div class="apk-faq-a">Автоматизация шлёт отчёт из того, что уже ввели. Агент собирает события, классифицирует простои, находит паттерны и предлагает действия — мастер подтверждает.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Заменит ли агент мастера?</div><div class="apk-faq-a">Нет. Утверждение плана, спорные простои, безопасность — за человеком. Агент экономит 1–2 часа отчётности.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли датчики на станках?</div><div class="apk-faq-a">Не обязательны на старте. Ручной учёт в Telegram уже даёт кратный выигрыш против бумаги.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить без программиста?</div><div class="apk-faq-a">Закажите аудит «Карты потерь» — мы настраиваем Telegram, панель и интеграции. С вашей стороны: регламенты, доступ к 1С, участие мастера.</div></div>
      </div>
    </div>
  </section>

  <section class="apk-section" id="cta" style="background:linear-gradient(135deg,rgba(245,197,24,.08),rgba(139,92,246,.08));">
    <div class="apk-cnt nero-ai-reveal">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Найти простои на вашем производстве</p>
    <p class="ym-cta-block__sub">Скачайте «Карту потерь», закажите экспресс-аудит смены или напишите нам — первый измеримый результат уже на первой неделе. Между Excel и тяжёлым MES — ваш слой контроля смены.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a href="#karta-poter" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Карта потерь производства</a>
    </div>
  </div>
</div>
    </div>
  </section>

</div>

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
  var root = document.querySelector('.ai-proizvodstvo-kontrol-prostoev-page') || document.querySelector('.apk-content');
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

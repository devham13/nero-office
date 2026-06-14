<?php
/**
 * Template Name: AI для салона красоты: внедрение AI-администратора под ключ
 * Description: SEO-лендинг — AI-администратор для салона красоты. Запись 24/7, YClients, DIKIDI, кейсы.
 */

$page_seo_title       = 'AI для салона красоты: внедрение AI-администратора под ключ';
$page_seo_description = 'Внедряем AI-администратора для салона красоты: запись клиентов к мастеру 24/7, ответы на FAQ, напоминания о визите. Интеграция с YClients, DIKIDI, CRM. Кейсы, цены, настройка под ключ.';

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
    ['label' => 'Возможности', 'href' => '#vozmozhnosti'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Настроить AI-запись';
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

body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
.salon-hero-admin{min-height:100vh;min-height:100dvh;position:relative}
.ask-content{
  --ask-bg:#050711;--ask-bg2:#080b17;
  --ask-surface:rgba(255,255,255,.072);--ask-text:#e6edf7;--ask-muted:#9aa8bd;
  --ask-soft:#c7d2e5;--ask-heading:#fff;--ask-border:rgba(255,255,255,.10);
  --ask-rose:#f472b6;--ask-violet:#c084fc;--ask-green:#22c55e;--ask-cyan:#79f2ff;
  --ask-btn-from:#db2777;--ask-btn-to:#a855f7;--ask-r:18px;--ask-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--ask-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.ask-content *,.ask-content *::before,.ask-content *::after{box-sizing:border-box}
.ask-content a{color:inherit;text-decoration:none}
.ask-content p{color:var(--ask-muted);line-height:1.72;margin:0 0 1em}
.ask-content p:last-child{margin-bottom:0}
.ask-content h2,.ask-content h3,.ask-content h4{color:var(--ask-heading);letter-spacing:-.045em;margin:0 0 .7em}
.ask-content strong{color:var(--ask-soft)}
.ask-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.ask-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--ask-muted);font-size:14.5px;line-height:1.65}
.ask-content ul li::before{content:'›';position:absolute;left:0;color:var(--ask-rose);font-weight:700}
.ask-cnt{width:min(var(--ask-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.ask-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.ask-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.ask-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.ask-sh.ask-left{margin-left:0;text-align:left}
.ask-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.ask-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.ask-sh.ask-left p{margin-left:0}
.ask-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(244,114,182,.08);border:1px solid rgba(244,114,182,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ask-rose);margin-bottom:14px}
.ask-gt{background:linear-gradient(92deg,#fff 0%,var(--ask-rose) 44%,var(--ask-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.ask-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.ask-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.ask-intro-text{position:relative;padding-left:20px;text-align:left}
.ask-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--ask-rose),var(--ask-violet))}
.ask-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--ask-muted);margin-bottom:1em}
.ask-intro-text p:last-child{margin-bottom:0;color:var(--ask-soft)}
.ask-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.ask-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.ask-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--ask-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.ask-kpi-card .kl{font-size:11px;font-weight:600;color:var(--ask-muted);line-height:1.4}
.ask-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.ask-intro-grid{grid-template-columns:1fr;gap:36px}.ask-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.ask-intro-kpi{grid-template-columns:1fr 1fr}}
.ask-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.ask-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.ask-toc a{display:inline-block;padding:9px 18px;background:var(--ask-surface);border:1px solid var(--ask-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--ask-muted);transition:border-color .2s,color .2s,background .2s}
.ask-toc a:hover{border-color:rgba(244,114,182,.42);color:var(--ask-rose);background:rgba(244,114,182,.08)}
.ask-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--ask-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22)}
.ask-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.ask-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.ask-grid-2,.ask-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.ask-grid-3{grid-template-columns:1fr 1fr}}
.ask-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.ask-table{width:100%;border-collapse:collapse;font-size:14px}
.ask-table th{padding:13px 16px;text-align:left;background:rgba(244,114,182,.1);color:var(--ask-rose);font-weight:700;border-bottom:1px solid rgba(244,114,182,.25);white-space:nowrap}
.ask-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--ask-text);vertical-align:top}
.ask-table tr:last-child td{border-bottom:none}
.ask-table tr:hover td{background:rgba(255,255,255,.03)}
.ask-table tr.ask-highlight td{background:rgba(244,114,182,.08);font-weight:600}
.ask-steps{display:grid;grid-template-columns:repeat(7,1fr);gap:8px;margin:24px 0}
.ask-step{padding:14px 10px;border-radius:14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);text-align:center;font-size:11px;color:var(--ask-muted)}
.ask-step strong{display:block;color:var(--ask-heading);font-size:18px;margin-bottom:4px}
@media(max-width:900px){.ask-steps{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.ask-steps{grid-template-columns:1fr 1fr}}
.ask-crm-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:24px 0}
.ask-crm-card{padding:20px;border-radius:16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1)}
.ask-crm-card h4{margin:0 0 8px;color:var(--ask-rose);font-size:15px}
.ask-crm-card p{font-size:13.5px;margin:0}
@media(max-width:768px){.ask-crm-cards{grid-template-columns:1fr}}
.ask-timeline{position:relative;padding-left:40px}
.ask-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--ask-rose),var(--ask-violet));opacity:.35;border-radius:2px}
.ask-tl-item{position:relative;margin-bottom:32px}
.ask-tl-item:last-child{margin-bottom:0}
.ask-tl-item::before{content:'';position:absolute;left:-34px;top:6px;width:12px;height:12px;border-radius:50%;background:var(--ask-rose);box-shadow:0 0 0 4px rgba(244,114,182,.2)}
.ask-case-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}
.ask-case-card{padding:24px;border-radius:18px;background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1)}
.ask-case-card h3{font-size:17px;margin-bottom:10px}
.ask-case-metric{display:inline-block;padding:4px 10px;border-radius:999px;background:rgba(34,197,94,.12);color:#86efac;font-size:12px;font-weight:700;margin-top:8px}
@media(max-width:768px){.ask-case-grid{grid-template-columns:1fr}}
.ask-checklist{counter-reset:askchk;list-style:none;padding:0;margin:0}
.ask-checklist li{counter-increment:askchk;padding:16px 16px 16px 52px;position:relative;margin-bottom:10px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:14px;color:var(--ask-muted);font-size:14.5px}
.ask-checklist li::before{content:counter(askchk);position:absolute;left:16px;top:14px;width:24px;height:24px;border-radius:50%;background:rgba(244,114,182,.15);color:var(--ask-rose);font-weight:800;font-size:12px;display:flex;align-items:center;justify-content:center}
.ask-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.ask-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.ask-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--ask-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.ask-faq-q::after{content:'▾';font-size:13px;color:var(--ask-rose);flex-shrink:0;transition:transform .25s}
.ask-faq-item.open .ask-faq-q::after{transform:rotate(180deg)}
.ask-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--ask-muted);line-height:1.72}
.ask-faq-item.open .ask-faq-a{max-height:800px;padding:0 24px 20px}
.ask-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(244,114,182,.12),rgba(192,132,252,.1));border:1px solid rgba(244,114,182,.3);text-align:center}
.ask-content .ym-cta-block--secondary{background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));border-color:rgba(121,242,255,.25)}
.ask-content .ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(244,114,182,.1));border-color:rgba(34,197,94,.3)}
.ask-content .ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ask-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ask-content .ym-cta-block__sub{color:var(--ask-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ask-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ask-content .ym-link--accent{color:var(--ask-cyan)!important;text-decoration:underline}
.ask-content .ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ask-content .ym-btn:hover{transform:translateY(-2px)}
.ask-content .ym-btn--accent{background:linear-gradient(135deg,var(--ask-btn-from),var(--ask-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(219,39,119,.35)}
.ask-content .ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--ask-text)!important;border:1.5px solid rgba(255,255,255,.18)}
.ask-final-cta{text-align:center;padding:clamp(48px,6vw,80px) 0;background:linear-gradient(135deg,rgba(244,114,182,.14),rgba(192,132,252,.1));border-radius:24px;border:1px solid rgba(244,114,182,.25);margin-top:32px}
.ask-final-cta .ask-lead-magnet{display:inline-flex;align-items:center;gap:8px;padding:8px 16px;border-radius:999px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);font-size:13px;color:var(--ask-soft);margin-bottom:20px}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}
.nero-ai-delay-2{transition-delay:.24s}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-administrator-salona-krasoty-page" role="main" tabindex="-1">

<section class="nero-ai-hero salon-hero-admin" id="hero" aria-labelledby="hero-salon-title">
<style>
/* ── Hero ai-administrator-salona-krasoty: самодостаточные стили ── */
.salon-hero-admin {
  --salon-rose: #f472b6;
  --salon-violet: #c084fc;
  --salon-mint: #34d399;
  --salon-cyan: #79f2ff;
  --salon-text: #e6edf7;
  --salon-muted: #9aa8bd;
  --salon-soft: #c7d2e5;
  --salon-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  color: var(--salon-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  background:
    radial-gradient(circle at 14% 8%, rgba(244, 114, 182, 0.16), transparent 28rem),
    radial-gradient(circle at 88% 10%, rgba(192, 132, 252, 0.18), transparent 32rem),
    radial-gradient(circle at 55% 92%, rgba(52, 211, 153, 0.07), transparent 34rem),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.salon-hero-admin::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.032) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.032) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: 0;
}
.salon-hero-admin::after {
  content: "";
  position: absolute;
  left: 18%;
  top: 14%;
  width: 560px;
  height: 560px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(244, 114, 182, .12), transparent 66%);
  filter: blur(8px);
  animation: salonHeroGlow 8s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes salonHeroGlow {
  from { opacity: .42; transform: scale(.96); }
  to { opacity: .8; transform: scale(1.04); }
}
.salon-hero-admin .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.salon-hero-admin .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.salon-hero-admin .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .94;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.salon-hero-admin .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--salon-rose) 38%, var(--salon-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.salon-hero-admin .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(244, 114, 182, 0.24);
  border-radius: 999px;
  background: rgba(244, 114, 182, 0.08);
  color: var(--salon-rose) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.salon-hero-admin .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--salon-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.salon-hero-admin .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.salon-hero-admin .nero-ai-badge {
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
.salon-hero-admin .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.salon-hero-admin .nero-ai-btn {
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
.salon-hero-admin .nero-ai-btn:hover { transform: translateY(-2px); }
.salon-hero-admin .nero-ai-btn-primary {
  color: #2a0a18 !important;
  background: linear-gradient(135deg, var(--salon-rose), #fda4af);
  box-shadow: 0 18px 42px rgba(244, 114, 182, 0.24);
}
.salon-hero-admin .nero-ai-btn-secondary {
  color: var(--salon-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.salon-hero-admin .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--salon-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.salon-hero-admin .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.salon-hero-admin .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.salon-hero-admin .nero-ai-dots { display: flex; gap: 7px; }
.salon-hero-admin .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.salon-hero-admin .nero-ai-dot:nth-child(1) { background: #fb7185; }
.salon-hero-admin .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.salon-hero-admin .nero-ai-dot:nth-child(3) { background: #34d399; }
.salon-hero-admin .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.salon-hero-admin .nero-ai-window-body { padding: 16px; }
.salon-hero-admin .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.salon-hero-admin .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.salon-hero-admin .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(52,211,153,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.salon-hero-admin .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: salonPulse 1.6s infinite;
}
@keyframes salonPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.salon-hero-admin .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
}
.salon-hero-admin .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.salon-hero-admin .nero-ai-metric span {
  display: block;
  color: var(--salon-muted);
  font-size: 11px;
  font-weight: 700;
}
.salon-hero-admin .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.salon-hero-admin .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 10px;
}
.salon-hero-admin .salon-dash-canvas-wrap {
  position: relative;
  height: clamp(210px, 30vw, 280px);
  margin: 12px 0;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(244, 114, 182, 0.18);
  background: radial-gradient(ellipse at 35% 40%, rgba(244,114,182,.08), rgba(6,10,24,.94) 70%);
}
.salon-hero-admin #salon-ai-admin-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.salon-hero-admin .nero-ai-task-stream { display: grid; gap: 8px; }
.salon-hero-admin .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.salon-hero-admin .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(244,114,182,.12);
  color: var(--salon-rose);
  font-size: 10px;
  font-weight: 800;
}
.salon-hero-admin .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.salon-hero-admin .nero-ai-task span {
  color: var(--salon-muted);
  font-size: 11px;
}
.salon-hero-admin .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(52,211,153,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.salon-hero-admin .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .salon-hero-admin .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .salon-hero-admin .nero-ai-dashboard { transform: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai для салона красоты</p>
      <h1 id="hero-salon-title">AI-администратор для салона красоты: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI записывает клиентов к мастерам 24/7, отвечает на вопросы и напоминает о визите — без потерянных заявок, когда администратор offline</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Запись 24/7</li>
        <li class="nero-ai-badge">YClients / DIKIDI</li>
        <li class="nero-ai-badge">FAQ из базы</li>
        <li class="nero-ai-badge">Напоминания</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-администратора салона">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">салон · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-администратор салона</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Входящих диалогов</span>
              <strong>47</strong>
              <small>TG · WA · VK</small>
            </div>
            <div class="nero-ai-metric">
              <span>Время ответа</span>
              <strong>~5 сек</strong>
              <small>среднее</small>
            </div>
            <div class="nero-ai-metric">
              <span>Автозапись</span>
              <strong>22%</strong>
              <small>броней*</small>
            </div>
            <div class="nero-ai-metric">
              <span>No-show</span>
              <strong>−35%</strong>
              <small>напоминания*</small>
            </div>
          </div>

          <div class="salon-dash-canvas-wrap" aria-hidden="false">
            <canvas id="salon-ai-admin-hero-canvas" role="img" aria-label="Анимация: сообщения из мессенджеров попадают в AI-панель, запись фиксируется в CRM и уходит напоминание клиенту"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий AI-администратора">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>23:15 — запись к мастеру Анна</strong><span>Суббота 14:00 · маникюр</span></div>
              <span class="nero-ai-status">запись</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">WA</span>
              <div><strong>FAQ: цена комби-маникюра</strong><span>Ответ из базы знаний</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">YC</span>
              <div><strong>YClients — слот подтверждён</strong><span>CRM синхронизирована</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⏰</span>
              <div><strong>Напоминание −24 ч</strong><span>Подтвердите визит или перенесите</span></div>
              <span class="nero-ai-status nero-ai-status--amber">отправлено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>

<script>
/**
 * salon-ai-admin-hero-engine — «Салонный AI-диспетчерский центр»
 * Мир: орбита мессенджеров → панель AI-администратора → кресло мастера → напоминание
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("salon-ai-admin-hero-canvas");
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
    panelBg: "#1e293b",
    panelScreen: "#0f172a",
    rose: "#f472b6",
    violet: "#c084fc",
    mint: "#34d399",
    tgBlue: "#38bdf8",
    waGreen: "#22c55e",
    vkBlue: "#818cf8",
    chair: "#475569",
    chairActive: "#f472b6",
    bubbleBg: "#0f172a",
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

  /* Орбитальный поток сообщений — вместо Conveyor */
  function MessengerBubbleStream() {
    this.channels = [
      { color: C.tgBlue, label: "TG", offset: 0, lane: -1 },
      { color: C.waGreen, label: "WA", offset: 55, lane: 0 },
      { color: C.vkBlue, label: "VK", offset: 110, lane: 1 }
    ];
  }
  MessengerBubbleStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    this.channels.forEach(function (ch) {
      var t = ((frame * 0.5 + ch.offset) % 140) / 140;
      if (t > 0.88) return;
      var startX = -175 + ch.lane * 28;
      var startY = -88;
      var endX = -15;
      var endY = -18;
      var cx1 = startX + 60;
      var cy1 = startY + 20;
      var cx2 = endX - 40;
      var cy2 = endY - 30;
      var px = Math.pow(1 - t, 3) * startX + 3 * Math.pow(1 - t, 2) * t * cx1 + 3 * (1 - t) * t * t * cx2 + t * t * t * endX;
      var py = Math.pow(1 - t, 3) * startY + 3 * Math.pow(1 - t, 2) * t * cy1 + 3 * (1 - t) * t * t * cy2 + t * t * t * endY;
      drawRR(ctx, px - 10, py - 8, 20, 16, 6, ch.color, C.outline);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(ch.label, px, py + 2);
    });
    if (prg < 55) {
      ctx.strokeStyle = "rgba(244,114,182,0.25)";
      ctx.lineWidth = 1;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(-175, -88);
      ctx.quadraticCurveTo(-40, -10, -15, -18);
      ctx.stroke();
      ctx.setLineDash([]);
    }
  };

  /* Центральная панель AI-администратора — вместо WebsiteTerminal */
  function BookingConciergePanel() {
    this.chatLines = 0;
  }
  BookingConciergePanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, -55, -72, 130, 118, 10, C.panelBg, C.outline);
    drawRR(ctx, -48, -65, 116, 16, [6, 6, 0, 0], C.rose, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("AI · запись", -42, -54);

    drawRR(ctx, -48, -44, 116, 82, 6, C.panelScreen, C.outline);

    if (prg >= 45 && prg < 95) {
      var lines = [
        { who: "Клиент", text: "Маникюр в сб?", y: -36 },
        { who: "AI", text: "К мастеру Анна?", y: -22 },
        { who: "Клиент", text: "Да, после 13:00", y: -8 }
      ];
      lines.forEach(function (ln, i) {
        if (prg > 50 + i * 12) {
          ctx.fillStyle = ln.who === "AI" ? C.rose : "#cbd5e1";
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.textAlign = "left";
          ctx.fillText(ln.who + ": " + ln.text, -44, ln.y);
        }
      });
    }

    if (prg >= 100 && prg < 195) {
      var slots = ["14:00", "15:30", "17:00"];
      slots.forEach(function (s, i) {
        var active = prg > 115 && i === 0;
        drawRR(ctx, -42 + i * 38, 8, 34, 14, 4, active ? "rgba(52,211,153,0.35)" : "rgba(255,255,255,0.08)", C.outline);
        ctx.fillStyle = active ? C.mint : "#94a3b8";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(s, -25 + i * 38, 18);
      });
    }

    if (prg >= 155) {
      var stamp = Math.min(1, (prg - 155) / 16);
      ctx.save();
      ctx.globalAlpha = stamp;
      ctx.strokeStyle = C.mint;
      ctx.lineWidth = 2;
      ctx.strokeRect(-20, 28, 58, 18);
      ctx.fillStyle = C.mint;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Запись ✓", 9, 40);
      ctx.restore();
    }
  };

  /* Ряд кресел мастеров */
  function MasterChairRow() {
    this.active = 0;
  }
  MasterChairRow.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    var masters = ["Анна", "Мария", "Олег"];
    masters.forEach(function (name, i) {
      var x = -70 + i * 48;
      var y = 52;
      var lit = prg >= 165 && i === 0;
      drawRR(ctx, x, y, 36, 28, 6, lit ? "rgba(244,114,182,0.22)" : "rgba(71,85,105,0.45)", C.outline);
      drawRR(ctx, x + 6, y - 14, 24, 16, 8, lit ? C.chairActive : C.chair, C.outline);
      ctx.fillStyle = lit ? "#fce7f3" : "#94a3b8";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(name, x + 18, y + 18);
      if (lit) {
        ctx.fillStyle = C.mint;
        ctx.fillText("● занято", x + 18, y + 26);
      }
    });
  };

  /* Синхронизация CRM YClients / DIKIDI */
  function CrmCalendarSync() {
    this.spin = 0;
  }
  CrmCalendarSync.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, 88, -58, 52, 48, 8, "rgba(255,255,255,0.06)", C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("YClients", 114, -46);
    if (prg >= 120 && prg < 210) {
      this.spin = (prg - 120) / 90;
      ctx.strokeStyle = C.mint;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(114, -28, 10, 0, Math.PI * 2 * this.spin);
      ctx.stroke();
      ctx.fillStyle = C.mint;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("sync", 114, -26);
    }
  };

  /* Кольцо напоминания −24ч */
  function ReminderPulseRing() {
    this.r = 0;
  }
  ReminderPulseRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 198) return;
    this.r = (prg - 198) / 42;
    var alpha = prg < 228 ? 0.6 : 1 - (prg - 228) / 12;
    ctx.strokeStyle = "rgba(251,191,36," + (alpha * 0.7) + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(114, 18, 8 + this.r * 22, 0, Math.PI * 2);
    ctx.stroke();
    var flyY = 18 - this.r * 55;
    drawRR(ctx, 104, flyY - 8, 36, 14, 5, "rgba(251,191,36,0.85)", C.outline);
    ctx.fillStyle = "#1e293b";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("−24ч", 122, flyY + 1);
  };

  /* Блёстки салона — ambient */
  function SalonSparkleField() {
    this.dots = [];
    for (var i = 0; i < 12; i++) {
      this.dots.push({ x: (Math.random() - 0.5) * 340, y: (Math.random() - 0.5) * 160, ph: Math.random() * 6.28 });
    }
  }
  SalonSparkleField.prototype.draw = function (ctx) {
    this.dots.forEach(function (d) {
      var a = 0.15 + Math.sin(frame * 0.04 + d.ph) * 0.12;
      ctx.fillStyle = "rgba(244,114,182," + a + ")";
      ctx.beginPath();
      ctx.arc(d.x, d.y, 1.2, 0, Math.PI * 2);
      ctx.fill();
    });
  };

  /* Карточки услуг */
  function BeautyServiceCards() {
    this.cards = [
      { label: "маникюр", color: "#fbcfe8", x: -155, y: 10 },
      { label: "стрижка", color: "#ddd6fe", x: -155, y: 38 }
    ];
  }
  BeautyServiceCards.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg > 90) return;
    this.cards.forEach(function (card, i) {
      var drift = ((frame * 0.35 + i * 40) % 80) / 80;
      var dx = card.x + drift * 90;
      drawRR(ctx, dx, card.y, 38, 14, 4, card.color, C.outline);
      ctx.fillStyle = "#334155";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(card.label, dx + 19, card.y + 9);
    });
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
    var carryType = null;

    var targets = {
      "1_architect": { x: -95, y: 78 },
      "2_seo": { x: -48, y: 86 },
      "3_coder": { x: 0, y: 88 },
      "4_designer": { x: 48, y: 86 },
      "5_deployer": { x: 95, y: 78 }
    };
    var tgt = targets[this.role] || { x: 0, y: 82 };

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
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 15) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 15) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
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
  entities.push(new SalonSparkleField());
  entities.push(new BeautyServiceCards());
  entities.push(new MessengerBubbleStream());
  entities.push(new BookingConciergePanel());
  entities.push(new MasterChairRow());
  entities.push(new CrmCalendarSync());
  entities.push(new ReminderPulseRing());
  entities.push(new Agent(-120, 95, C.agentYellow, "1_architect", 18, [
    "Карта intents записи", "FAQ: адрес и парковка", "Сценарий no-show"
  ]));
  entities.push(new Agent(-60, 98, C.agentGreen, "2_seo", 58, [
    "Прайс из CRM", "Мастер Анна — слот 14:00", "LSI: ai запись к мастеру"
  ]));
  entities.push(new Agent(0, 100, C.agentBlue, "3_coder", 108, [
    "get_slots YClients", "book_appointment OK", "152-ФЗ: согласие ПДн"
  ]));
  entities.push(new Agent(60, 98, C.agentPink, "4_designer", 158, [
    "Тон администратора", "Карточка «маникюр»", "Human takeover UI"
  ]));
  entities.push(new Agent(120, 95, C.agentPurple, "5_deployer", 208, [
    "Напоминание −24ч", "Rollout на 2 филиала", "Дашборд no-show"
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
    if (prg >= 12 && prg < 12.05) createBubble(-140, -60, "1. Сообщение из TG");
    if (prg >= 52 && prg < 52.05) createBubble(-30, -70, "2. Intent: запись");
    if (prg >= 112 && prg < 112.05) createBubble(10, -40, "3. Слот у мастера");
    if (prg >= 162 && prg < 162.05) createBubble(50, 10, "4. Запись в CRM");
    if (prg >= 205 && prg < 205.05) createBubble(100, 30, "5. −24ч напоминание");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 18, 5, C.bubbleBg, C.rose);
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


<div class="ask-content">

  <section class="ask-intro" id="intro" aria-label="Введение">
    <div class="ask-cnt">
      <div class="ask-intro-grid nero-ai-reveal">
        <div class="ask-intro-text">
          <p class="ask-eyebrow">Лонгрид · ai для салона красоты</p>
          <p><strong>Коротко:</strong> AI-администратор — это LLM-агент поверх вашей CRM записи, который принимает клиентов в мессенджерах и на сайте 24/7: записывает к мастеру, отвечает на FAQ, переносит визиты и напоминает о записи. CRM (YClients, DIKIDI, Арника) остаётся «мозгом» расписания; AI закрывает диалоговый слой, где теряются заявки.</p>
          <p>Решение подходит салонам красоты, барбершопам, студиям маникюра и педикюра, косметологии и SPA — любому бизнесу с предварительной записью по мастерам и услугам.</p>
        </div>
        <div class="ask-intro-kpi" aria-label="Ключевые показатели">
          <div class="ask-kpi-card"><div class="kv">30 мин</div><div class="kl">задержка администратора</div><div class="ks">Daria AI / vc.ru</div></div>
          <div class="ask-kpi-card"><div class="kv">~1 500 ₽</div><div class="kl">потеря на слот</div><div class="ks">при задержке 15 мин</div></div>
          <div class="ask-kpi-card"><div class="kv">22%</div><div class="kl">броней через бота</div><div class="ks">кейс «Богелика»</div></div>
          <div class="ask-kpi-card"><div class="kv">120k+</div><div class="kl">бизнесов на DIKIDI</div><div class="ks">2026</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="ask-toc-outer">
    <div class="ask-cnt">
      <nav class="ask-toc" aria-label="Оглавление">
        <a href="#chto-takoe">Что такое AI</a>
        <a href="#vozmozhnosti">Возможности</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#integracii">CRM</a>
        <a href="#etapy">Внедрение</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="ask-section" id="chto-takoe">
    <div class="ask-cnt">
      <div class="ask-sh nero-ai-reveal">
        <span class="ask-eyebrow">Определение</span>
        <h2>Что такое AI-администратор для салона красоты</h2>
        <p><strong>AI для салона красоты</strong> в формате AI-администратора — это не виджет с кнопками «1 — запись, 2 — цены», а связка языковой модели и интеграций с CRM.</p>
      </div>
      <div class="ask-grid-2 nero-ai-reveal">
        <div class="ask-card">
          <h3>Чем отличается от обычного чат-бота</h3>
          <p>Классический чат-бот работает по дереву сценариев. <strong>AI-администратор салона</strong> понимает намерение (intent): запись, цена, адрес, перенос, отмена, жалоба. Он вызывает функции CRM через API — <code>get_services</code>, <code>get_slots</code>, <code>book_appointment</code>, <code>cancel_booking</code> — и отвечает в свободной форме.</p>
          <p>По данным IBM (январь 2026), contact center automation переходит от rule-based ботов к <strong>agentic AI</strong>. Nero Network позиционирует <strong>кастомное внедрение под ключ</strong> — когда коробочного SaaS недостаточно.</p>
        </div>
        <div class="ask-card">
          <h3>Какие задачи закрывает нейросеть</h3>
          <p><strong>Определение:</strong> AI-администратор закрывает повторяющиеся операции первой линии — без участия человека в каждом сообщении.</p>
          <div class="ask-table-wrap">
            <table class="ask-table">
              <thead><tr><th>Задача</th><th>Что делает AI</th><th>Человеку</th></tr></thead>
              <tbody>
                <tr><td>Запись к мастеру</td><td>Подбор услуги, слота, запись в CRM</td><td>VIP, нестандарт</td></tr>
                <tr><td>FAQ</td><td>Цены, адрес, подготовка</td><td>Мед. противопоказания</td></tr>
                <tr><td>Перенос и отмена</td><td>По live-расписанию CRM</td><td>Конфликты, негатив</td></tr>
                <tr><td>Напоминания</td><td>−24 ч / −2 ч с confirm</td><td>—</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ask-section ask-section-alt" id="kogda-nuzhen">
    <div class="ask-cnt">
      <div class="ask-sh nero-ai-reveal">
        <h2>Когда салону нужен AI вместо или вместе с администратором</h2>
        <p><strong>AI для салона красоты для бизнеса</strong> — это не замена всей команды, а усиление точки входа клиента.</p>
      </div>
      <div class="ask-grid-2 nero-ai-reveal">
        <div class="ask-card">
          <h3>Потерянные заявки вне рабочего времени</h3>
          <p>Клиент пишет в 23:00 или в воскресенье; ответ приходит утром — и он уже записался у конкурента. По материалам Daria AI, задержка <strong>15 минут</strong> может стоить салону <strong>~1 500 ₽</strong> на одном слоте. Международные данные показывают, что <strong>35–40% звонков</strong> теряются в пиковые часы.</p>
          <p><strong>AI для салона красоты для малого бизнеса</strong> закрывает этот разрыв: ответ за секунды, запись в CRM, напоминание о визите — без найма второй смены.</p>
        </div>
        <div class="ask-card">
          <h3>Перегруз администратора в пиковые часы</h3>
          <p>После акции или рассылки поток сообщений резко растёт. Владелец сети «Богелика» Михаил Дороничев: «Дарья стала нашим спасением… круглосуточно… уже приносит реальную прибыль» (vc.ru).</p>
          <p><strong>AI бот для салона</strong> снимает рутину — цены, адрес, перенос, запись к свободному мастеру — и эскалирует только сложные кейсы с полной историей диалога.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="ai-administrator-salona-krasoty-boris-block" class="ask-root" aria-label="Анимация: сценарий записи клиента через AI-администратора салона">
<style>
/* === БОРИС: prefix ask-, scoped внутри #ai-administrator-salona-krasoty-boris-block === */
#ai-administrator-salona-krasoty-boris-block.ask-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-administrator-salona-krasoty-boris-block .ask-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-administrator-salona-krasoty-boris-block .ask-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-administrator-salona-krasoty-boris-block .ask-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-administrator-salona-krasoty-boris-block .ask-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-administrator-salona-krasoty-boris-block .ask-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-administrator-salona-krasoty-boris-block .ask-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#db2777;
  margin:0 0 14px;
}
#ai-administrator-salona-krasoty-boris-block .ask-ey::before{
  content:'';
  width:18px;height:2px;
  background:#db2777;
  border-radius:1px;
}
#ai-administrator-salona-krasoty-boris-block .ask-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-administrator-salona-krasoty-boris-block .ask-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-administrator-salona-krasoty-boris-block .ask-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-administrator-salona-krasoty-boris-block .ask-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(219,39,119,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:10px;
  font-weight:800;
  color:#be185d;
  margin-top:1px;
  font-style:normal;
}
#ai-administrator-salona-krasoty-boris-block .ask-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-administrator-salona-krasoty-boris-block .ask-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-administrator-salona-krasoty-boris-block .ask-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-administrator-salona-krasoty-boris-block .ask-pl-p{
  background:rgba(219,39,119,.08);
  color:#be185d;
  border:1.5px solid rgba(219,39,119,.22);
}
#ai-administrator-salona-krasoty-boris-block .ask-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#ai-administrator-salona-krasoty-boris-block .ask-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-administrator-salona-krasoty-boris-block .ask-rgt{
  position:relative;
  background:linear-gradient(135deg,#fdf2f8 0%,#fce7f3 35%,#f0f9ff 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-administrator-salona-krasoty-boris-block .ask-rgt{min-height:360px;}
}
#ask-booking-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="ask-cnt">
  <div class="ask-card">

    <div class="ask-lft">
      <span class="ask-ey">Сценарий записи · 7 шагов</span>
      <h3 class="ask-h3">От сообщения в 23:00 до подтверждённого слота в YClients — без живого администратора</h3>
      <ul class="ask-ul">
        <li><span class="ask-ic">1</span>Приветствие и согласие на обработку ПДн (152-ФЗ)</li>
        <li><span class="ask-ic">2</span>AI определяет intent: запись, цена, адрес, перенос или отмена</li>
        <li><span class="ask-ic">3</span>Выбор услуги → мастера → свободного слота из CRM</li>
        <li><span class="ask-ic">4</span>Запись в YClients / DIKIDI и напоминание −24 ч / −2 ч</li>
      </ul>
      <div class="ask-pills">
        <span class="ask-pl ask-pl-g">~5 сек ответ</span>
        <span class="ask-pl ask-pl-p">22% автозапись*</span>
        <span class="ask-pl ask-pl-b">TG · WA · VK</span>
      </div>
      <p class="ask-foot">Дальше разберём, что именно умеет AI-администратор: запись, FAQ и напоминания →</p>
    </div>

    <div class="ask-rgt">
      <canvas
        id="ask-booking-pipeline-canvas"
        aria-label="Анимация: сообщение из мессенджера проходит AI-классификацию, создаёт запись в CRM салона и отправляет напоминание клиенту"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('ask-booking-pipeline-canvas');
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
    line:'rgba(219,39,119,.28)',
    lineAct:'rgba(34,197,94,.45)',
    tg:'#29b6f6',
    wa:'#22c55e',
    vk:'#3b82f6',
    ai:'#a855f7',
    aiGlow:'rgba(168,85,247,.22)',
    crm:'#0ea5e9',
    crmBg:'#e0f2fe',
    slot:'#ffffff',
    slotOk:'#dcfce7',
    rem:'#f59e0b',
    bubble:'#ffffff',
    bubbleBdr:'#fbcfe8',
    text:'#1e293b'
  };

  var STEPS = [
    {key:'msg',  label:'Мессенджер', sub:'TG · WA · VK'},
    {key:'ai',   label:'AI intent', sub:'запись / FAQ'},
    {key:'crm',  label:'CRM слот', sub:'YClients'},
    {key:'rem',  label:'Напоминание', sub:'−24 ч'}
  ];

  function rr(ctx,x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){
      ctx.strokeStyle=stroke;
      ctx.lineWidth=lw||1.5;
      ctx.stroke();
    }
  }

  function nodePos(i){
    var pad = Math.min(W,H)*0.08;
    var usable = W - pad*2;
    return {
      x: pad + usable * (i / (STEPS.length - 1)),
      y: H * 0.52
    };
  }

  function drawConnector(x1,y1,x2,y2,active,t){
    ctx.save();
    ctx.strokeStyle = active ? C.lineAct : C.line;
    ctx.lineWidth = active ? 2.5 : 1.5;
    ctx.setLineDash(active ? [] : [6,5]);
    ctx.beginPath();
    ctx.moveTo(x1,y1);
    var mx = (x1+x2)/2;
    ctx.bezierCurveTo(mx,y1-18, mx,y2-18, x2,y2);
    ctx.stroke();
    ctx.setLineDash([]);
    if(active){
      var px = x1 + (x2-x1)*t;
      var py = y1 + Math.sin(t*Math.PI)*-12;
      ctx.fillStyle = C.ai;
      ctx.beginPath();
      ctx.arc(px, py, 4, 0, Math.PI*2);
      ctx.fill();
    }
    ctx.restore();
  }

  function drawMsgNode(x,y,scale,channel){
    var s = scale || 1;
    var col = channel==='tg'?C.tg:(channel==='wa'?C.wa:C.vk);
    var lbl = channel==='tg'?'TG':(channel==='wa'?'WA':'VK');
    ctx.save();
    ctx.translate(x,y);
    rr(ctx,-34*s,-28*s,68*s,56*s,10*s,C.bubble,C.bubbleBdr);
    ctx.fillStyle = col;
    ctx.font = 'bold '+(11*s)+'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(lbl, 0, -4*s);
    ctx.fillStyle = C.muted;
    ctx.font = (9*s)+'px system-ui,sans-serif';
    ctx.fillText('23:15', 0, 12*s);
    ctx.restore();
  }

  function drawAiNode(x,y,pulse){
    ctx.save();
    ctx.translate(x,y);
    if(pulse > 0){
      ctx.globalAlpha = 0.25 + pulse*0.35;
      ctx.fillStyle = C.aiGlow;
      ctx.beginPath();
      ctx.arc(0,0,42+pulse*10,0,Math.PI*2);
      ctx.fill();
      ctx.globalAlpha = 1;
    }
    rr(ctx,-38,-32,76,64,14,'#faf5ff','#d8b4fe',2);
    ctx.fillStyle = C.ai;
    ctx.font = 'bold 13px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI', 0, -6);
    ctx.fillStyle = C.muted;
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText('intent', 0, 10);
    ctx.restore();
  }

  function drawCrmNode(x,y,slotLit,t){
    ctx.save();
    ctx.translate(x,y);
    rr(ctx,-42,-36,84,72,12,C.crmBg,'#7dd3fc',1.5);
    ctx.fillStyle = C.crm;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('CRM', 0, -18);
    var slots = [[-22,-4,18,14],[2,-4,18,14],[-22,14,18,14],[2,14,18,14]];
    for(var i=0;i<slots.length;i++){
      var sl = slots[i];
      var on = slotLit && i===1;
      rr(ctx,sl[0],sl[1],sl[2],sl[3],3, on?C.slotOk:C.slot, on?'#22c55e':'#bae6fd');
      if(on){
        ctx.fillStyle = '#15803d';
        ctx.font = '8px system-ui,sans-serif';
        ctx.fillText('14:00', sl[0]+9, sl[1]+10);
      }
    }
    if(slotLit){
      ctx.strokeStyle = 'rgba(34,197,94,'+(0.4+Math.sin(t*6)*0.3)+')';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0,0,48,0,Math.PI*2);
      ctx.stroke();
    }
    ctx.restore();
  }

  function drawRemNode(x,y,ping){
    ctx.save();
    ctx.translate(x,y);
    if(ping > 0){
      ctx.globalAlpha = 0.2 + ping*0.3;
      ctx.fillStyle = 'rgba(245,158,11,.35)';
      ctx.beginPath();
      ctx.arc(0,0,36+ping*8,0,Math.PI*2);
      ctx.fill();
      ctx.globalAlpha = 1;
    }
    rr(ctx,-34,-30,68,60,12,'#fffbeb','#fcd34d',1.5);
    ctx.fillStyle = C.rem;
    ctx.font = '18px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('🔔', 0, 4);
    ctx.fillStyle = C.muted;
    ctx.font = '8px system-ui,sans-serif';
    ctx.fillText('−24 ч', 0, 22);
    ctx.restore();
  }

  function drawStepLabel(x,y,text,sub,active){
    ctx.fillStyle = active ? C.ink : C.muted;
    ctx.font = (active?'bold ':'')+'11px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(text, x, y);
    ctx.fillStyle = C.muted;
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText(sub, x, y+13);
  }

  var packets = [];
  var channels = ['tg','wa','vk','tg','wa'];
  function spawnPacket(){
    packets.push({
      ch: channels[Math.floor(Math.random()*channels.length)],
      t: 0,
      stage: 0,
      speed: 0.004 + Math.random()*0.003,
      label: ['Запись к Ане','FAQ: цена','Суббота 14:00','Перенос визита'][Math.floor(Math.random()*4)]
    });
  }
  for(var i=0;i<3;i++) spawnPacket();

  function drawPacket(pkt){
    var pos = [];
    for(var j=0;j<STEPS.length;j++) pos.push(nodePos(j));
    var s = pkt.stage;
    var localT = pkt.t;
    var x,y;
    if(s >= STEPS.length-1){
      x = pos[STEPS.length-1].x + localT*40;
      y = pos[STEPS.length-1].y - localT*20;
    } else {
      var a = pos[s], b = pos[s+1];
      x = a.x + (b.x-a.x)*localT;
      y = a.y + (b.y-a.y)*localT + Math.sin(localT*Math.PI)*-14;
    }
    ctx.save();
    ctx.globalAlpha = 0.92;
    if(s===0) drawMsgNode(x,y,0.75,pkt.ch);
    else {
      rr(ctx,x-28,y-12,56,24,8,C.bubble,C.bubbleBdr);
      ctx.fillStyle = C.text;
      ctx.font = '8px system-ui,sans-serif';
      ctx.textAlign = 'center';
      var lbl = pkt.label.length>14 ? pkt.label.slice(0,13)+'…' : pkt.label;
      ctx.fillText(lbl, x, y+4);
    }
    ctx.restore();
  }

  function tick(){
    frame++;
    if(frame % 90 === 0 && packets.length < 5) spawnPacket();

    for(var i=packets.length-1;i>=0;i--){
      packets[i].t += packets[i].speed;
      if(packets[i].t >= 1){
        packets[i].t = 0;
        packets[i].stage++;
        if(packets[i].stage >= STEPS.length){
          packets.splice(i,1);
          spawnPacket();
        }
      }
    }

    ctx.clearRect(0,0,W,H);

    var bgGrad = ctx.createLinearGradient(0,0,W,H);
    bgGrad.addColorStop(0,'#fdf2f8');
    bgGrad.addColorStop(0.5,'#fce7f3');
    bgGrad.addColorStop(1,'#f0f9ff');
    ctx.fillStyle = bgGrad;
    ctx.fillRect(0,0,W,H);

    ctx.strokeStyle = 'rgba(148,163,184,.12)';
    ctx.lineWidth = 1;
    for(var gx=0;gx<W;gx+=28){
      ctx.beginPath(); ctx.moveTo(gx,0); ctx.lineTo(gx,H); ctx.stroke();
    }
    for(var gy=0;gy<H;gy+=28){
      ctx.beginPath(); ctx.moveTo(0,gy); ctx.lineTo(W,gy); ctx.stroke();
    }

    var nodes = nodePos(0);
    var pulse = (Math.sin(frame*0.05)+1)/2;
    var ping  = (Math.sin(frame*0.07+1)+1)/2;
    var slotOn = (Math.sin(frame*0.04)+1)/2 > 0.35;

    for(var c=0;c<STEPS.length-1;c++){
      var p1 = nodePos(c), p2 = nodePos(c+1);
      var act = packets.some(function(pk){ return pk.stage===c; });
      var lt = 0;
      packets.forEach(function(pk){ if(pk.stage===c) lt = Math.max(lt,pk.t); });
      drawConnector(p1.x+36, p1.y, p2.x-36, p2.y, act, lt);
    }

    for(var n=0;n<STEPS.length;n++){
      var p = nodePos(n);
      drawStepLabel(p.x, p.y+52, STEPS[n].label, STEPS[n].sub, n===1||n===2);
      if(n===0) drawMsgNode(p.x,p.y,1,'tg');
      else if(n===1) drawAiNode(p.x,p.y,pulse);
      else if(n===2) drawCrmNode(p.x,p.y,slotOn,frame*0.02);
      else drawRemNode(p.x,p.y,ping);
    }

    packets.forEach(drawPacket);

    ctx.fillStyle = C.muted;
    ctx.font = '9px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('* демо-поток · не реальные данные салона', 12, H-10);
  }

  (function loop(){
    tick();
    requestAnimationFrame(loop);
  })();
})();
</script>
</section>

  <div class="ask-cnt"><aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-boli">
  <div class="ym-cta-block__icon" aria-hidden="true">💬</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Где ваш салон теряет записи сегодня?</p>
    <p class="ym-cta-block__sub">Разберём каналы — Telegram, WhatsApp, звонки, Instagram Direct — и покажем, сколько заявок уходит в offline администратора. Бесплатный аудит записи за 2–3 рабочих дня.</p>
    <a class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside></div>

  <section class="ask-section" id="vozmozhnosti">
    <div class="ask-cnt">
      <div class="ask-sh nero-ai-reveal">
        <h2>Что умеет AI-администратор: запись, FAQ и напоминания</h2>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
      <div class="ask-grid-3 nero-ai-reveal">
        <div class="ask-card">
          <h3>Запись к мастеру и выбор услуги</h3>
          <p><strong>AI запись клиентов салон</strong> работает по живому расписанию CRM. Клиент называет услугу → AI уточняет мастера → запрашивает слоты через API YClients / DIKIDI → создаёт запись.</p>
          <p>В кейсе QU Bot: <strong>70% запросов</strong> обрабатывает бот, <strong>+40% записей</strong> через мессенджеры.</p>
        </div>
        <div class="ask-card">
          <h3>Ответы на типовые вопросы</h3>
          <p>AI отвечает только из <strong>базы знаний салона</strong> — прайс, правила отмены, депозиты, акции. Модель не «выдумывает» цены.</p>
          <p><strong>Human takeover обязателен:</strong> медицинские противопоказания, жалобы, VIP-клиенты.</p>
        </div>
        <div class="ask-card">
          <h3>Напоминание о визите</h3>
          <p><strong>AI напоминание о визите салон</strong> — ключ к снижению no-show: −24 ч и −2 ч, confirm / перенос / отмена, post-visit отзыв.</p>
          <p>Zenoti Benchmark 2025: при автоматизации no-show — <strong>3%</strong>. PapAI Soft заявляет <strong>−35% no-show</strong>.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ask-section ask-section-alt" id="kak-rabotaet">
    <div class="ask-cnt">
      <div class="ask-sh nero-ai-reveal">
        <h2>Как работает сценарий записи к мастеру через мессенджеры</h2>
        <p><strong>AI запись к мастеру</strong> — центральный сценарий внедрения <strong>чат-бот запись салон красоты</strong> с LLM-слоем.</p>
      </div>
      <div class="ask-steps nero-ai-reveal" aria-label="7 шагов записи">
        <div class="ask-step"><strong>1</strong>Согласие ПДн</div>
        <div class="ask-step"><strong>2</strong>Intent</div>
        <div class="ask-step"><strong>3</strong>Услуга</div>
        <div class="ask-step"><strong>4</strong>Мастер</div>
        <div class="ask-step"><strong>5</strong>Слот CRM</div>
        <div class="ask-step"><strong>6</strong>Напоминания</div>
        <div class="ask-step"><strong>7</strong>Post-visit</div>
      </div>
      <div class="ask-grid-2 nero-ai-reveal nero-ai-delay-1">
        <div class="ask-card">
          <h3>WhatsApp, Telegram, VK, Instagram Direct и виджет</h3>
          <p>Основной поток — <strong>Telegram, WhatsApp, VK, Instagram Direct</strong>*, Max. Jivo ИИ + YClients поддерживает все каналы. Nero Network проектирует <strong>омниканальный inbox</strong> — единую очередь диалогов с human takeover.</p>
        </div>
        <div class="ask-card">
          <h3>Выбор мастера, слота и no-show</h3>
          <p>Клиент может запросить «своего» мастера или ближайший слот. При отмене AI предлагает освободившееся окно тем, кто был в листе ожидания. No-show обрабатывается напоминаниями и аналитикой по каналам и мастерам.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ask-section" id="integracii">
    <div class="ask-cnt">
      <div class="ask-sh nero-ai-reveal">
        <h2>Интеграция AI с CRM и системами записи салона</h2>
        <p><strong>AI crm салон</strong> — CRM = backend расписания, AI-агент = frontend в мессенджерах.</p>
      </div>
      <div class="ask-table-wrap nero-ai-reveal">
        <table class="ask-table">
          <thead><tr><th>CRM</th><th>Роль</th><th>AI «из коробки»</th><th>Интеграция AI-бота</th></tr></thead>
          <tbody>
            <tr><td><strong>YClients</strong></td><td>Лидер для салонов в РФ</td><td>Нет LLM-диалога</td><td>API + OAuth</td></tr>
            <tr><td><strong>DIKIDI</strong></td><td>120 000+ бизнесов</td><td>Рассылки, не AI-диалог</td><td>API → overlay-бот</td></tr>
            <tr><td><strong>Арника</strong></td><td>Склад, зарплаты</td><td>Нет AI-диалога</td><td>API + overlay</td></tr>
            <tr><td><strong>1С:Салон</strong></td><td>Учёт + запись</td><td>Нет</td><td>API/обмен + бот</td></tr>
          </tbody>
        </table>
      </div>
      <div class="ask-crm-cards nero-ai-reveal nero-ai-delay-1">
        <div class="ask-crm-card"><h4>YClients</h4><p>Маркетплейс: Jivo, Daria AI, Suvvy. API записи/отмены, OAuth.</p></div>
        <div class="ask-crm-card"><h4>DIKIDI</h4><p>120k+ бизнесов. Overlay-бот или кастом через Make/n8n.</p></div>
        <div class="ask-crm-card"><h4>Арника / 1С</h4><p>API + overlay без замены действующей системы учёта.</p></div>
      </div>
      <div class="ask-card nero-ai-reveal nero-ai-delay-2">
        <h3>Синхронизация расписания и истории визитов</h3>
        <p><strong>Интеграция AI для салона красоты с CRM</strong> через function calling: чтение услуг, мастеров, расписания; создание, перенос, отмена записи; история диалога в карточке клиента. Оркестрация — Make, n8n или Python backend.</p>
      </div>
    </div>
  </section>

  <section class="ask-section ask-section-alt" id="etapy">
    <div class="ask-cnt">
      <div class="ask-sh nero-ai-reveal">
        <h2>Внедрение AI для салона красоты под ключ: этапы и сроки</h2>
        <p><strong>Внедрение AI для салона красоты</strong> — проект с фиксированными этапами, а не «поставили виджет и забыли».</p>
      </div>
      <div class="ask-timeline nero-ai-reveal">
        <div class="ask-tl-item"><h3>Аудит записи и каналов — 2–3 дня</h3><p>Разбор CRM, каналов (TG, WA, VK, сайт, телефония), прайса, правил записи. На выходе — карта потерь: где заявки «умирают».</p></div>
        <div class="ask-tl-item"><h3>Настройка сценариев — 3–5 дней</h3><p>Карта intents, FAQ, эскалации, лид-магнит «Сценарий записи для салона».</p></div>
        <div class="ask-tl-item"><h3>Интеграции — 5–10 дней</h3><p>YClients/DIKIDI API, Telegram Bot API, WhatsApp Business API, VK, виджет сайта.</p></div>
        <div class="ask-tl-item"><h3>AI-слой и compliance — 5–7 дней</h3><p>Промпт, function calling, RAG по FAQ, compliance 152-ФЗ.</p></div>
        <div class="ask-tl-item"><h3>Пилот и rollout — 2+ недели</h3><p>Один канал + один филиал → метрики → доработка → масштабирование на сеть.</p></div>
      </div>
      <div class="ask-card nero-ai-reveal nero-ai-delay-1" style="margin-top:32px">
        <h3>Поддержка после старта</h3>
        <p>Обучение администратора, дашборд метрик (время ответа, % автозаписи, no-show, эскалации, выручка с AI-канала). <strong>AI для салона красоты под ключ</strong> включает итерации по реальным диалогам.</p>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите понимать AI-автоматизацию до старта проекта?</p>
    <p class="ym-cta-block__sub">Если владелец или администратор хочет разобраться в сценариях записи, n8n и human-in-the-loop до пилота — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: $secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'Курс по AI-автоматизации'); ?></a>. Это ускоряет согласование этапов внедрения с командой салона.</p>
  </div>
</aside>
    </div>
  </section>

  <section class="ask-section" id="ceny">
    <div class="ask-cnt">
      <div class="ask-sh nero-ai-reveal">
        <h2>Сколько стоит AI-администратор для салона красоты</h2>
      </div>
      <div class="ask-table-wrap nero-ai-reveal">
        <table class="ask-table">
          <thead><tr><th>Формат</th><th>Ориентир</th><th>Плюсы</th><th>Минусы</th></tr></thead>
          <tbody>
            <tr><td>jAutomation</td><td>от 5 000 ₽/мес</td><td>Быстрый старт, Telegram + YClients</td><td>Ограниченные правила</td></tr>
            <tr><td>Daria AI</td><td>trial 3 дня</td><td>Кейсы в beauty, YClients native</td><td>SaaS-рамки</td></tr>
            <tr><td>Jivo ИИ + YClients</td><td>маркетплейс</td><td>Все каналы</td><td>Не DIKIDI / 1С</td></tr>
            <tr class="ask-highlight"><td><strong>Nero Network под ключ</strong></td><td><strong>120–350 тыс. ₽</strong></td><td>DIKIDI, Арника, 152-ФЗ, voice</td><td>Выше входной порог</td></tr>
          </tbody>
        </table>
      </div>
      <div class="ask-grid-2 nero-ai-reveal nero-ai-delay-1">
        <div class="ask-card">
          <h3>ROI: меньше потерянных заявок</h3>
          <ul>
            <li>Задержка 15 мин ≈ 1 500 ₽/слот (Daria AI)</li>
            <li>Кейс «Богелика»: 800+ диалогов, 123 записи, <strong>198 142 ₽</strong> выручки, <strong>22% броней</strong></li>
            <li>Jivo: до <strong>~80%</strong> времени оператора на рутине</li>
          </ul>
        </div>
        <div class="ask-card">
          <h3>Когда оправдан кастом</h3>
          <p>Депозиты, blacklist мастеров, DIKIDI, голосовой канал для пропущенных звонков, прозрачная архитектура Make/n8n для технически грамотного ЛПР.</p>
        </div>
      </div>
      <aside class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-ceny">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Узнайте бюджет под ваш салон</p>
    <p class="ym-cta-block__sub">Ориентир <strong>120–350 тыс. ₽</strong> за внедрение AI-администратора под ключ: YClients/DIKIDI, мессенджеры, compliance 152-ФЗ. На аудите покажем ROI по вашим каналам записи — без обязательств.</p>
    <div class="ym-cta-block__actions">
      <a class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Ответы на вопросы →</a>
    </div>
  </div>
</aside>
    </div>
  </section>

  <section class="ask-section ask-section-alt" id="keisy">
    <div class="ask-cnt">
      <div class="ask-sh nero-ai-reveal">
        <h2>Кейсы внедрения AI в салоны красоты, студии и барбершопы</h2>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
      <div class="ask-case-grid nero-ai-reveal">
        <div class="ask-case-card">
          <h3>Daria AI × «Богелика» (Нижний Новгород)</h3>
          <p>ИИ-администратор «Дарья»: запись, перенос, FAQ; YClients + WhatsApp; пилот → 4 филиала, 80+ мастеров.</p>
          <span class="ask-case-metric">198 142 ₽ выручки · 22% броней</span>
        </div>
        <div class="ask-case-card">
          <h3>Jivo ИИ × YClients</h3>
          <p>Официальный модуль в маркетплейсе: установка → синхронизация услуг/мастеров → AI ведёт диалог и пишет в календарь.</p>
          <span class="ask-case-metric">Слой поверх CRM</span>
        </div>
        <div class="ask-case-card">
          <h3>DINGG AI × Glow Beauty Bar (Miami)</h3>
          <p>+ $18K/month revenue, 68% inquiries → booking.</p>
          <span class="ask-case-metric">+68% booking rate</span>
        </div>
        <div class="ask-case-card">
          <h3>Salon Sora × BookingBee.ai</h3>
          <p>157 after-hours calls автоматически, 6,8× ROI, −50% no-show через SMS-напоминания.</p>
          <span class="ask-case-metric">6,8× ROI</span>
        </div>
      </div>
      <div class="ask-card nero-ai-reveal nero-ai-delay-1" style="margin-top:24px">
        <h3>KPI успешного внедрения</h3>
        <ul>
          <li>Время ответа: секунды вместо 15–30+ минут</li>
          <li>Доля автозаписи: ориентир <strong>15–25%+</strong> (кейс Daria: 22%)</li>
          <li>No-show: напоминания дают −35% и более</li>
          <li>Выручка с AI-канала — отдельная строка в аналитике</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="ask-section" id="checklist">
    <div class="ask-cnt">
      <div class="ask-sh nero-ai-reveal">
        <h2>Как внедрить AI для салона красоты: пошаговый чек-лист</h2>
        <p><strong>Итог:</strong> семь блоков — от данных до пилота.</p>
      </div>
      <ol class="ask-checklist nero-ai-reveal">
        <li>Зафиксировать CRM и каналы записи.</li>
        <li>Собрать прайс, расписание мастеров, FAQ, политику ПДн.</li>
        <li>Спроектировать сценарии (запись, перенос, FAQ, эскалация).</li>
        <li>Подключить API CRM и мессенджеров.</li>
        <li>Настроить AI-слой и compliance 152-ФЗ.</li>
        <li>Протестировать на команде салона.</li>
        <li>Пилот на одном канале → масштабирование.</li>
      </ol>
      <div class="ask-grid-2 nero-ai-reveal nero-ai-delay-1" style="margin-top:28px">
        <div class="ask-card">
          <h3>Подготовка базы услуг и мастеров</h3>
          <p>Прайс с длительностью и ценой, расписание мастеров, FAQ, тон общения, политика ПДн, доступы API. Без актуального прайса AI будет эскалировать даже простые вопросы.</p>
        </div>
        <div class="ask-card">
          <h3>Тестирование до запуска</h3>
          <p>Прогоните: запись к мастеру, «любой свободный», перенос, отмена, акция, мед. вопрос (→ человеку), негатив. Проверьте запись в CRM и отсутствие дублей SMS YClients.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ask-section ask-section-alt" id="faq">
    <div class="ask-cnt">
      <div class="ask-sh nero-ai-reveal">
        <h2>FAQ: частые вопросы про AI-администратора салона</h2>
      </div>
      <div class="ask-faq nero-ai-reveal">
        <div class="ask-faq-item" id="faq-zamena">
          <div class="ask-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI живого администратора полностью?</div>
          <div class="ask-faq-a"><p>Нет — и это не цель. AI закрывает переписку 24/7; человек — сервис в зале, конфликты, косметологию с мед.ограничениями, VIP. Многие клиенты не отличают качественный AI-диалог от администратора, если тон выверен.</p></div>
        </div>
        <div class="ask-faq-item" id="faq-152">
          <div class="ask-faq-q" tabindex="0" role="button" aria-expanded="false">Безопасны ли персональные данные клиентов (152-ФЗ)?</div>
          <div class="ask-faq-a"><p>Да, при правильной настройке: явное согласие, политика конфиденциальности, уведомление РКН, хранение в РФ, отдельное согласие на рассылки. Nero Network включает compliance-блок в каждый проект.</p></div>
        </div>
        <div class="ask-faq-item" id="faq-sroki">
          <div class="ask-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает запуск?</div>
          <div class="ask-faq-a"><p>Коробочный SaaS — от нескольких дней. <strong>Кастом под ключ Nero Network:</strong> ориентир <strong>3–6 недель</strong> в зависимости от числа каналов, CRM и филиалов.</p></div>
        </div>
        <div class="ask-faq-item" id="faq-raspisanie">
          <div class="ask-faq-q" tabindex="0" role="button" aria-expanded="false">Ошибётся ли AI в расписании?</div>
          <div class="ask-faq-a"><p>Запись идёт только через <strong>live API CRM</strong> — не из «памяти» модели. При неуверенности AI эскалирует диалог администратору с историей.</p></div>
        </div>
        <div class="ask-faq-item" id="faq-crm">
          <div class="ask-faq-q" tabindex="0" role="button" aria-expanded="false">У нас уже YClients / DIKIDI — зачем ещё AI?</div>
          <div class="ask-faq-a"><p>CRM не закрывает мессенджеры «из коробки». YClients — backend расписания; AI — frontend диалога в TG, WA, VK.</p></div>
        </div>
        <div class="ask-faq-item" id="faq-chelovek">
          <div class="ask-faq-q" tabindex="0" role="button" aria-expanded="false">Клиенты хотят живого человека</div>
          <div class="ask-faq-a"><p>AI отвечает мгновенно; сложное — человеку. Скорость часто важнее «живого голоса» в 23:00, когда администратор спит, а слот завтра утром уже занят у конкурента.</p></div>
        </div>
      </div>
    </div>
  </section>

  <section class="ask-section" id="nastroit-zapis">
    <div class="ask-cnt">
      <div class="ask-final-cta nero-ai-reveal">
        <span class="ask-lead-magnet">📋 Лид-магнит: «Сценарий записи для салона»</span>
        <h2>Настроить AI-запись для вашего салона</h2>
        <p><strong>CRM у вас уже есть — не хватает AI-слоя в мессенджерах.</strong> Nero Network внедряет AI-администратора под ключ: интеграция с YClients, DIKIDI, Арника, 1С:Салон; омниканальность TG + WA + VK + сайт; опционально голос для пропущенных звонков; compliance 152-ФЗ.</p>
        <p>Готовая карта intents от приветствия до post-visit — адаптируйте под ваш прайс и правила.</p>
        <a class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </section>

</div>


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Заменит ли AI живого администратора полностью?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Нет — и это не цель. AI закрывает переписку 24/7; человек — сервис в зале, конфликты, косметологию с мед.ограничениями, VIP."
          }
        },
        {
          "@type": "Question",
          "name": "Безопасны ли персональные данные клиентов (152-ФЗ)?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, при правильной настройке: явное согласие, политика конфиденциальности, уведомление РКН, хранение в РФ, отдельное согласие на рассылки."
          }
        },
        {
          "@type": "Question",
          "name": "Сколько времени занимает запуск?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Коробочный SaaS — от нескольких дней. Кастом под ключ Nero Network: ориентир 3–6 недель в зависимости от числа каналов, CRM и филиалов."
          }
        },
        {
          "@type": "Question",
          "name": "Ошибётся ли AI в расписании?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Запись идёт только через live API CRM — не из памяти модели. При неуверенности AI эскалирует диалог администратору с историей."
          }
        },
        {
          "@type": "Question",
          "name": "У нас уже YClients / DIKIDI — зачем ещё AI?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "CRM не закрывает мессенджеры из коробки. YClients — backend расписания; AI — frontend диалога в TG, WA, VK."
          }
        },
        {
          "@type": "Question",
          "name": "Клиенты хотят живого человека",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "AI отвечает мгновенно; сложное — человеку. Скорость часто важнее живого голоса в 23:00, когда администратор спит."
          }
        }
      ]
    },
    {
      "@type": "Organization",
      "name": "Nero Network",
      "description": "Внедрение AI-администратора для салонов красоты под ключ: запись 24/7, интеграция с YClients, DIKIDI, CRM.",
      "areaServed": "RU",
      "serviceType": [
        "AI-администратор для салона красоты",
        "Внедрение AI для салона красоты",
        "Интеграция AI с CRM салона"
      ]
    }
  ]
}
</script>

</main>

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
  document.querySelectorAll('.ask-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.ask-faq-item');
      var wasOpen = item.classList.contains('open');
      document.querySelectorAll('.ask-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.ask-faq-q');
        if (q) q.setAttribute('aria-expanded','false');
      });
      if (!wasOpen) {
        item.classList.add('open');
        btn.setAttribute('aria-expanded','true');
      }
    });
    btn.addEventListener('keydown', function(e){
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
    });
  });
})();

</script>

<?php get_footer(); ?>

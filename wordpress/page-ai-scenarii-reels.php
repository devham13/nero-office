<?php
/**
 * Template Name: AI-сценарии Reels под ключ: генерация и внедрение для бизнеса
 * Description: Внедряем AI-конвейер сценариев Reels: нейросеть собирает структуры роликов из оффера, болей ЦА и SEO-тем. Пакет на месяц, хуки и CTA. Получите 10 сценариев под вашу нишу.
 */

$page_seo_title       = 'AI-сценарии Reels под ключ: генерация и внедрение для бизнеса';
$page_seo_description = 'Внедряем AI-конвейер сценариев Reels: нейросеть собирает структуры роликов из оффера, болей ЦА и SEO-тем. Пакет на месяц, хуки и CTA. Получите 10 сценариев под вашу нишу.';

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
    ['label' => 'Пакет', 'href' => '#paket'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить сценарии';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Внедрение AI в бизнес';
$secondary_cta_url = '#vnedrenie-ai';

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

/* Kadence reset + breadcrumbs hide */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

.ai-scenarii-reels-page{--asr-accent:#ec4899;--asr-accent2:#79f2ff;--asr-violet:#8b5cf6;--asr-green:#22c55e;--asr-text:#e6edf7;--asr-muted:#9aa8bd;--asr-soft:#c7d2e5;--asr-heading:#fff;--asr-border:rgba(255,255,255,.10);--asr-surface:rgba(255,255,255,.06);--asr-container:1220px}
.ai-scenarii-reels-page .asr-content *,.ai-scenarii-reels-page .asr-content *::before,.ai-scenarii-reels-page .asr-content *::after{box-sizing:border-box}
.ai-scenarii-reels-page .asr-content a{color:inherit}
.ai-scenarii-reels-page .asr-content p{color:var(--asr-muted);line-height:1.72;margin:0 0 1em}
.ai-scenarii-reels-page .asr-content p:last-child{margin-bottom:0}
.ai-scenarii-reels-page .asr-content h2,.ai-scenarii-reels-page .asr-content h3,.ai-scenarii-reels-page .asr-content h4{color:var(--asr-heading);letter-spacing:-.045em;margin:0 0 .7em}
.ai-scenarii-reels-page .asr-content strong{color:var(--asr-soft)}
.ai-scenarii-reels-page .asr-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.ai-scenarii-reels-page .asr-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--asr-muted);font-size:14.5px;line-height:1.65}
.ai-scenarii-reels-page .asr-content ul li::before{content:'›';position:absolute;left:0;color:var(--asr-accent2);font-weight:700}
.ai-scenarii-reels-page .asr-cnt{width:min(var(--asr-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.ai-scenarii-reels-page .asr-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.ai-scenarii-reels-page .asr-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.ai-scenarii-reels-page .asr-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.ai-scenarii-reels-page .asr-sh.asr-left{margin-left:0;text-align:left}
.ai-scenarii-reels-page .asr-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.ai-scenarii-reels-page .asr-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.ai-scenarii-reels-page .asr-sh.asr-left p{margin-left:0}
.ai-scenarii-reels-page .asr-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(236,72,153,.08);border:1px solid rgba(236,72,153,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#f9a8d4;margin-bottom:14px}
.ai-scenarii-reels-page .asr-gt{background:linear-gradient(92deg,#fff 0%,var(--asr-accent2) 44%,var(--asr-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.ai-scenarii-reels-page .asr-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.ai-scenarii-reels-page .asr-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.ai-scenarii-reels-page .asr-intro-text{position:relative;padding-left:20px;text-align:left!important}
.ai-scenarii-reels-page .asr-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--asr-accent),var(--asr-accent2))}
.ai-scenarii-reels-page .asr-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--asr-muted);margin-bottom:1em}
.ai-scenarii-reels-page .asr-intro-text p:last-child{margin-bottom:0;color:var(--asr-soft)}
.ai-scenarii-reels-page .asr-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.ai-scenarii-reels-page .asr-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.ai-scenarii-reels-page .asr-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--asr-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.ai-scenarii-reels-page .asr-kpi-card .kl{font-size:11px;font-weight:600;color:var(--asr-muted);line-height:1.4}
.ai-scenarii-reels-page .asr-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.ai-scenarii-reels-page .asr-intro-grid{grid-template-columns:1fr;gap:36px}.ai-scenarii-reels-page .asr-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.ai-scenarii-reels-page .asr-intro-kpi{grid-template-columns:1fr 1fr}}
.ai-scenarii-reels-page .asr-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.ai-scenarii-reels-page .asr-toc,.ai-scenarii-reels-page .ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.ai-scenarii-reels-page .asr-toc a{display:inline-block;padding:9px 18px;background:var(--asr-surface);border:1px solid var(--asr-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--asr-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.ai-scenarii-reels-page .asr-toc a:hover{border-color:rgba(236,72,153,.42);color:#f9a8d4;background:rgba(236,72,153,.08)}
.ai-scenarii-reels-page .asr-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--asr-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.ai-scenarii-reels-page .asr-card:hover{border-color:rgba(236,72,153,.28);transform:translateY(-2px)}
.ai-scenarii-reels-page .asr-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.ai-scenarii-reels-page .asr-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.ai-scenarii-reels-page .asr-grid-2,.ai-scenarii-reels-page .asr-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.ai-scenarii-reels-page .asr-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.ai-scenarii-reels-page .asr-grid-3{grid-template-columns:1fr}}
.ai-scenarii-reels-page .asr-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.ai-scenarii-reels-page .asr-table{width:100%;border-collapse:collapse;font-size:14px}
.ai-scenarii-reels-page .asr-table th{padding:13px 16px;text-align:left;background:rgba(236,72,153,.1);color:#f9a8d4;font-weight:700;border-bottom:1px solid rgba(236,72,153,.25);white-space:nowrap}
.ai-scenarii-reels-page .asr-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--asr-text);vertical-align:top}
.ai-scenarii-reels-page .asr-table tr:last-child td{border-bottom:none}
.ai-scenarii-reels-page .asr-table tr:hover td{background:rgba(255,255,255,.03)}
.ai-scenarii-reels-page .asr-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.ai-scenarii-reels-page .asr-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(236,72,153,.1);color:#f9a8d4;border:1px solid rgba(236,72,153,.2)}
.ai-scenarii-reels-page .asr-flow .arr{color:var(--asr-muted);font-size:16px;padding:0 4px;background:none;border:none}
.ai-scenarii-reels-page .asr-timeline{position:relative;padding-left:40px}
.ai-scenarii-reels-page .asr-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--asr-accent),var(--asr-accent2));opacity:.35;border-radius:2px}
.ai-scenarii-reels-page .asr-tl-item{position:relative;margin-bottom:32px}
.ai-scenarii-reels-page .asr-tl-item:last-child{margin-bottom:0}
.ai-scenarii-reels-page .asr-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--asr-accent);box-shadow:0 0 0 4px rgba(236,72,153,.2)}
.ai-scenarii-reels-page .asr-tl-item h3{font-size:17px;margin-bottom:8px}
.ai-scenarii-reels-page .asr-tl-item p{font-size:14.5px;margin:0}
.ai-scenarii-reels-page .asr-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.ai-scenarii-reels-page .asr-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.ai-scenarii-reels-page .asr-case-grid{grid-template-columns:1fr}}
.ai-scenarii-reels-page .asr-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.ai-scenarii-reels-page .asr-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.ai-scenarii-reels-page .asr-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--asr-green);margin-bottom:10px}
.ai-scenarii-reels-page .asr-case-card h3{font-size:16px;margin-bottom:14px}
.ai-scenarii-reels-page .asr-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.ai-scenarii-reels-page .asr-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.ai-scenarii-reels-page .asr-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--asr-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.ai-scenarii-reels-page .asr-faq-q::after{content:'▾';font-size:13px;color:#f9a8d4;flex-shrink:0;transition:transform .25s}
.ai-scenarii-reels-page .asr-faq-item.open .asr-faq-q::after{transform:rotate(180deg)}
.ai-scenarii-reels-page .asr-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--asr-muted);line-height:1.72}
.ai-scenarii-reels-page .asr-faq-item.open .asr-faq-a{max-height:800px;padding:0 24px 20px}
.ai-scenarii-reels-page .asr-checklist{display:flex;flex-wrap:wrap;gap:9px;margin:20px 0 0;padding:0;list-style:none}
.ai-scenarii-reels-page .asr-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--asr-muted)}
.ai-scenarii-reels-page .asr-checklist li::before{content:'✓';color:var(--asr-green);font-weight:800}
.ai-scenarii-reels-page .nero-ai-cta-inline{padding:28px 32px;margin:32px 0;border-radius:20px}
.ai-scenarii-reels-page .nero-ai-cta-inline h3{margin:0 0 12px;font-size:clamp(18px,2.4vw,24px)}
.ai-scenarii-reels-page .nero-ai-cta-inline p{margin:0 0 18px}
.ai-scenarii-reels-page .nero-ai-final{padding:clamp(64px,8vw,100px) 0;text-align:center;background:linear-gradient(135deg,rgba(236,72,153,.1),rgba(121,242,255,.08));border-top:1px solid rgba(255,255,255,.08)}
.ai-scenarii-reels-page .nero-ai-final .nero-ai-h2{font-size:clamp(28px,4vw,48px);margin:0 0 16px}
.ai-scenarii-reels-page .nero-ai-final .nero-ai-sub{max-width:640px;margin:0 auto 20px;font-size:clamp(15px,1.6vw,18px);color:var(--asr-muted)}
.ai-scenarii-reels-page .nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.ai-scenarii-reels-page .nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.ai-scenarii-reels-page .nero-ai-delay-1{transition-delay:.12s}
.ai-scenarii-reels-page .nero-ai-delay-2{transition-delay:.24s}
/* Boris block scoped styles included inline in block */

</style>

<main id="primary" class="site-main nero-ai-home-page ai-scenarii-reels-page" role="main" tabindex="-1">

<section class="nero-ai-hero asr-hero-reels" id="hero" aria-labelledby="asr-hero-title">
<style>
/* === ASR hero: scoped внутри .asr-hero-reels — самодостаточный блок === */
.asr-hero-reels {
  --asr-cyan: #79f2ff;
  --asr-violet: #8b5cf6;
  --asr-pink: #ec4899;
  --asr-green: #22c55e;
  --asr-muted: #9aa8bd;
  --asr-text: #e6edf7;
  position: relative;
  min-height: min(980px, calc(100vh - 1px));
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.asr-hero-reels::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 45% 30%, #000 0%, transparent 72%);
  opacity: .45;
  pointer-events: none;
  z-index: -2;
}
.asr-hero-reels .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.asr-hero-reels .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(320px, 0.98fr);
  gap: clamp(28px, 4vw, 52px);
  align-items: center;
}
.asr-hero-reels .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(236, 72, 153, 0.28);
  border-radius: 999px;
  background: rgba(236, 72, 153, 0.1);
  color: #f9a8d4 !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.asr-hero-reels h1 {
  margin: 0;
  color: #fff;
  font-size: clamp(34px, 5vw, 64px);
  line-height: 0.98;
  letter-spacing: -0.045em;
}
.asr-hero-reels .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--asr-cyan) 38%, #f472b6 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.asr-hero-reels .nero-ai-hero-lead {
  margin: 20px 0 0;
  max-width: 640px;
  color: var(--asr-muted);
  font-size: clamp(16px, 1.7vw, 20px);
  line-height: 1.65;
}
.asr-hero-reels .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 24px 0 0;
  padding: 0;
  list-style: none;
}
.asr-hero-reels .nero-ai-badge {
  padding: 8px 14px;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 999px;
  background: rgba(255,255,255,.06);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.asr-hero-reels .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 28px;
}
.asr-hero-reels .nero-ai-btn {
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
  transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
}
.asr-hero-reels .nero-ai-btn:hover,
.asr-hero-reels .nero-ai-btn:focus-visible { transform: translateY(-2px); }
.asr-hero-reels .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--asr-cyan), #fbcfe8);
  box-shadow: 0 18px 42px rgba(236, 72, 153, 0.22);
}
.asr-hero-reels .nero-ai-btn-secondary {
  color: var(--asr-text) !important;
  background: rgba(255,255,255,.07);
  border-color: rgba(255,255,255,.14);
}
.asr-hero-reels .nero-ai-btn-secondary:hover {
  border-color: rgba(236, 72, 153, 0.36);
  background: rgba(236, 72, 153, 0.1);
}
.asr-hero-reels .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: 0 28px 90px rgba(0,0,0,.42);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.asr-hero-reels .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.asr-hero-reels .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.asr-hero-reels .nero-ai-dots { display: flex; gap: 7px; }
.asr-hero-reels .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.asr-hero-reels .nero-ai-dot:nth-child(1) { background: #fb7185; }
.asr-hero-reels .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.asr-hero-reels .nero-ai-dot:nth-child(3) { background: #34d399; }
.asr-hero-reels .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.asr-hero-reels .nero-ai-window-body { padding: 16px; }
.asr-hero-reels .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.asr-hero-reels .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.asr-hero-reels .nero-ai-live-pill {
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
.asr-hero-reels .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: asrPulse 1.6s infinite;
}
@keyframes asrPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.asr-hero-reels .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.asr-hero-reels .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.asr-hero-reels .nero-ai-metric span {
  display: block;
  color: var(--asr-muted);
  font-size: 11px;
  font-weight: 700;
}
.asr-hero-reels .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.asr-hero-reels .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.asr-hero-reels .asr-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(236, 72, 153, 0.2);
  background: radial-gradient(ellipse at 50% 35%, rgba(236,72,153,.09), rgba(6,10,24,.94) 72%);
}
.asr-hero-reels #asr-reels-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.asr-hero-reels .nero-ai-task-stream { display: grid; gap: 8px; }
.asr-hero-reels .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.asr-hero-reels .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(236,72,153,.14);
  color: #f9a8d4;
  font-size: 11px;
  font-weight: 800;
}
.asr-hero-reels .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.asr-hero-reels .nero-ai-task span {
  color: var(--asr-muted);
  font-size: 11px;
}
.asr-hero-reels .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.asr-hero-reels .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.asr-hero-reels .nero-ai-status--pink {
  background: rgba(236,72,153,.14);
  color: #fbcfe8;
}
@media (max-width: 1100px) {
  .asr-hero-reels .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .asr-hero-reels .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .asr-hero-reels .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .asr-hero-reels .nero-ai-window-body { padding: 12px; }
  .asr-hero-reels .nero-ai-task { grid-template-columns: 28px 1fr; }
  .asr-hero-reels .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Видео / креативы · ai сценарии reels</p>
      <h1 id="asr-hero-title">AI-сценарии Reels для бизнеса: <span class="nero-ai-gradient-text">генерация и внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть собирает сценарии коротких видео из вашего оффера, болей клиентов и SEO-тем — получите 10 готовых идей под вашу нишу</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Оффер + боли ЦА</li>
        <li class="nero-ai-badge">SEO-темы → ролик</li>
        <li class="nero-ai-badge">3–5 хуков A/B</li>
        <li class="nero-ai-badge">Пакет на 30 дней</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-конвейера сценариев Reels">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-конвейер сценариев Reels</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Пакет</span>
              <strong>30</strong>
              <small>сценариев / месяц</small>
            </div>
            <div class="nero-ai-metric">
              <span>Хуки</span>
              <strong>3–5</strong>
              <small>вариантов на ролик</small>
            </div>
            <div class="nero-ai-metric">
              <span>Длина</span>
              <strong>15–45 с</strong>
              <small>Reels / Shorts</small>
            </div>
            <div class="nero-ai-metric">
              <span>Лид-магнит</span>
              <strong>10</strong>
              <small>идей под нишу</small>
            </div>
          </div>

          <div class="asr-dash-canvas-wrap" aria-hidden="false">
            <canvas id="asr-reels-hero-canvas" role="img" aria-label="Анимация: оффер, боли и SEO-темы превращаются в снимаемые сценарии Reels с хуками и экспортом в календарь"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий конвейера">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">SEO</span>
              <div><strong>Кластер → тема ролика</strong><span>Wordstat → сценарий #12</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">HK</span>
              <div><strong>Hook Factory — 4 варианта</strong><span>0–3 с · A/B тест входа</span></div>
              <span class="nero-ai-status nero-ai-status--pink">хуки</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TB</span>
              <div><strong>Таблица сценария</strong><span>тайминг · кадр · реплика · CTA</span></div>
              <span class="nero-ai-status">снимаемо</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">30</span>
              <div><strong>Контент-календарь</strong><span>пакет в очередь batch-съёмки</span></div>
              <span class="nero-ai-status nero-ai-status--amber">в съёмку</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


  <div class="asr-content">
  <section class="asr-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="asr-cnt">
      <div class="asr-intro-grid nero-ai-reveal">
        <div class="asr-intro-text">
          <p class="asr-eyebrow">Лонгрид · AI-сценарии Reels</p>
          <p>Короткое видео давно перестало быть «дополнением к SMM». Для услуг, экспертов, брендов и агентств Reels, VK Клипы и YouTube Shorts — рабочий канал охвата и лидогенерации. Проблема в другом: <strong>видео нужны постоянно, но нет идей и структуры</strong>.</p>
          <p><strong>Коротко:</strong> вход = оффер + боли + SEO-кластер → выход = таблица «тайминг | кадр | реплика | подпись» + 3–5 вариантов хука на каждый ролик. <strong>AI-сценарии Reels</strong> в формате Nero Network — внедрённый бизнес-процесс, а не разовый промпт в ChatGPT.</p>
        </div>
        <div class="asr-intro-kpi" aria-label="Ключевые метрики короткого видео">
          <div class="asr-kpi-card"><div class="kv">91%</div><div class="kl">бизнесов в видеомаркетинге</div><div class="ks">Wyzowl 2026</div></div>
          <div class="asr-kpi-card"><div class="kv">63%</div><div class="kl">предпочитают короткое видео</div><div class="ks">vs 12% статьи</div></div>
          <div class="asr-kpi-card"><div class="kv">30</div><div class="kl">сценариев в пакете</div><div class="ks">на месяц</div></div>
          <div class="asr-kpi-card"><div class="kv">3–5</div><div class="kl">вариантов хука A/B</div><div class="ks">на каждый ролик</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="asr-toc-outer">
    <div class="asr-cnt">
      <nav class="asr-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#kak-rabotaet">Как работает</a><a href="#paket">Пакет</a><a href="#keisy">Кейсы</a><a href="#ceny">Стоимость</a><a href="#faq">FAQ</a><a href="#poluchit-scenarii">Получить сценарии</a>
      </nav>
    </div>
  </div>

  <section class="asr-section" id="pochemu-video">
    <div class="asr-cnt">
      <div class="asr-sh asr-left nero-ai-reveal">
        <span class="asr-eyebrow">Боль рынка</span>
        <h2>Почему видео нужны постоянно, а идей не хватает</h2>
        <p>По данным Wyzowl (конец 2025), <strong>91% бизнесов</strong> используют видеомаркетинг в 2026 году. <strong>63% потребителей</strong> предпочитают узнавать о продукте через короткое видео. В России — мультиплатформенная задача: Reels (38–42 млн MAU), VK Клипы (52 млн), YouTube Shorts (41 млн).</p>
      </div>
      <div class="asr-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="asr-card">
          <h3>Регулярность Reels без выгорания команды</h3>
          <ul>
            <li>Пустой чат перед съёмкой: «о чём сегодня снимать?»</li>
            <li>Срыв batch-дня: идеи есть, но без структуры съёмка растягивается</li>
            <li>2–4 часа в неделю уходят на идеи, а не на съёмку и продажи</li>
            <li>Контент-план живёт в голове одного человека — при отпуске канал «замирает»</li>
          </ul>
        </div>
        <div class="asr-card">
          <h3>Почему «снимать по настроению» не работает</h3>
          <p>B2B-услуги требуют связки <strong>боль → решение → доказательство → CTA</strong>. Формула: хук (0–3 с) → проблема → ценность → proof → один CTA, длина <strong>15–45 секунд</strong>.</p>
          <p style="margin-top:12px;font-size:14px"><strong>Сценарий reels для продвижения услуг</strong> должен закрывать конкретный подзапрос аудитории и вести к одному действию.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="ai-scenarii-reels-boris-block" class="asr-root" aria-label="Анимация: beat-структура AI-сценария Reels с таймлайном и вариантами хука">
<style>
/* === БОРИС: prefix asr-, scoped внутри #ai-scenarii-reels-boris-block === */
#ai-scenarii-reels-boris-block.asr-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-scenarii-reels-boris-block .asr-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-scenarii-reels-boris-block .asr-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:520px;
}
@media(max-width:1023px){
  #ai-scenarii-reels-boris-block .asr-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-scenarii-reels-boris-block .asr-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-scenarii-reels-boris-block .asr-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-scenarii-reels-boris-block .asr-ey{
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
#ai-scenarii-reels-boris-block .asr-ey::before{
  content:'';
  width:18px;height:2px;
  background:#db2777;
  border-radius:1px;
}
#ai-scenarii-reels-boris-block .asr-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-scenarii-reels-boris-block .asr-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-scenarii-reels-boris-block .asr-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-scenarii-reels-boris-block .asr-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(219,39,119,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#be185d;
  margin-top:1px;
  font-style:normal;
}
#ai-scenarii-reels-boris-block .asr-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-scenarii-reels-boris-block .asr-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-scenarii-reels-boris-block .asr-pl-p{
  background:rgba(236,72,153,.08);
  color:#be185d;
  border:1.5px solid rgba(236,72,153,.22);
}
#ai-scenarii-reels-boris-block .asr-pl-b{
  background:rgba(59,130,246,.08);
  color:#1d4ed8;
  border:1.5px solid rgba(59,130,246,.22);
}
#ai-scenarii-reels-boris-block .asr-pl-g{
  background:rgba(16,185,129,.08);
  color:#047857;
  border:1.5px solid rgba(16,185,129,.22);
}
#ai-scenarii-reels-boris-block .asr-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-scenarii-reels-boris-block .asr-rgt{
  position:relative;
  background:linear-gradient(145deg,#fdf2f8 0%,#eff6ff 45%,#f0fdf4 100%);
  min-height:460px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-scenarii-reels-boris-block .asr-rgt{min-height:400px;}
}
#asr-script-timeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="asr-cnt">
  <div class="asr-card">

    <div class="asr-lft">
      <span class="asr-ey">Структура сценария</span>
      <h3 class="asr-h3">Не абзац в чате — снимаемая таблица с beat-структурой и A/B-хуками</h3>
      <ul class="asr-ul">
        <li><span class="asr-ic">1</span>SEO-тема и боль клиента превращаются в тайминг по секундам</li>
        <li><span class="asr-ic">2</span>Формула: хук (0–3 с) → проблема → ценность → proof → один CTA</li>
        <li><span class="asr-ic">3</span>3–5 вариантов входа на каждый ролик — не берём первый, самый слабый</li>
        <li><span class="asr-ic">4</span>Выход: строки «тайминг | кадр | реплика | подпись» для batch-съёмки</li>
      </ul>
      <div class="asr-pills">
        <span class="asr-pl asr-pl-p">15–45 сек</span>
        <span class="asr-pl asr-pl-b">3–5 хуков</span>
        <span class="asr-pl asr-pl-g">1 CTA</span>
      </div>
      <p class="asr-foot">Дальше разберём, как AI-конвейер собирает такие сценарии из оффера и SEO-кластера →</p>
    </div>

    <div class="asr-rgt">
      <canvas
        id="asr-script-timeline-canvas"
        aria-label="Анимация: SEO-тема превращается в beat-структуру сценария Reels внутри вертикального кадра с таймлайном"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('asr-script-timeline-canvas');
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
    phone:'#1e293b',
    screen:'#0f172a',
    screenLit:'#1e293b',
    hook:'#ec4899',
    problem:'#f59e0b',
    value:'#3b82f6',
    proof:'#10b981',
    cta:'#8b5cf6',
    seo:'#0ea5e9',
    seoBg:'rgba(14,165,233,.12)',
    white:'#ffffff',
    grid:'rgba(148,163,184,.15)',
    glow:'rgba(236,72,153,.25)'
  };

  var BEATS = [
    {key:'hook',    label:'Хук',     color:C.hook,    start:0,  end:3,  text:'«4 часа на идеи — 2 ролика»'},
    {key:'problem', label:'Боль',    color:C.problem, start:3,  end:10, text:'Нет структуры съёмки'},
    {key:'value',   label:'Ценность',color:C.value,   start:10, end:25, text:'AI-конвейер → 30 сценариев'},
    {key:'proof',   label:'Proof',   color:C.proof,   start:25, end:35, text:'Таблица тайминг/кадр'},
    {key:'cta',     label:'CTA',     color:C.cta,     start:35, end:42, text:'Напиши «сценарии»'}
  ];

  var HOOKS = [
    '«4 часа на идеи — 2 ролика»',
    '«ChatGPT дал текст — на съёмке импровизация»',
    '«Контент-план без сценариста — как?»',
    '«Один CTA, не пять призывов»'
  ];

  var SEO_TAGS = ['ai сценарии reels', 'боль ЦА', 'SEO-кластер', 'оффер', 'хук A/B'];

  var LOOP = 720;
  var TOTAL_SEC = 45;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function txt(str,x,y,size,weight,color,align){
    ctx.font = (weight||'600')+' '+(size||12)+'px Inter,system-ui,sans-serif';
    ctx.fillStyle = color||C.ink;
    ctx.textAlign = align||'left';
    ctx.textBaseline = 'middle';
    ctx.fillText(str,x,y);
  }

  function drawPhone(cx, cy, phW, phH, progress){
    var r = 18;
    var sw = phW * 0.06;
    rr(cx - phW/2, cy - phH/2, phW, phH, r, C.phone, C.ink, 2.5);
    var ix = cx - phW/2 + sw;
    var iy = cy - phH/2 + sw + 8;
    var iw = phW - sw*2;
    var ih = phH - sw*2 - 16;
    rr(ix, iy, iw, ih, 10, C.screenLit, null, 0);

    var notchW = iw * 0.28;
    rr(cx - notchW/2, iy + 4, notchW, 6, 3, C.phone, null, 0);

    var beatH = ih / BEATS.length;
    var activeIdx = Math.floor((progress % LOOP) / (LOOP / BEATS.length)) % BEATS.length;

    BEATS.forEach(function(b, i){
      var by = iy + 28 + i * beatH;
      var alpha = i <= activeIdx ? 1 : 0.22;
      var slide = i === activeIdx ? Math.sin(frame * 0.08) * 2 : 0;

      ctx.globalAlpha = alpha;
      rr(ix + 8, by + slide, iw - 16, beatH - 6, 6, b.color + '33', b.color, 1.2);

      ctx.fillStyle = b.color;
      ctx.font = 'bold 9px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(b.label, ix + 14, by + 10 + slide);

      if(i <= activeIdx){
        ctx.fillStyle = C.white;
        ctx.font = '600 8px Inter,sans-serif';
        var t = b.text;
        if(i === 0){
          var hi = Math.floor((frame / 90) % HOOKS.length);
          t = HOOKS[hi];
        }
        ctx.fillText(t.length > 28 ? t.slice(0,26)+'…' : t, ix + 14, by + beatH/2 + 4 + slide);
      }
      ctx.globalAlpha = 1;
    });

    var scanY = iy + 28 + (progress % LOOP) / LOOP * (ih - 40);
    ctx.strokeStyle = 'rgba(236,72,153,.5)';
    ctx.lineWidth = 1.5;
    ctx.setLineDash([4,4]);
    ctx.beginPath();
    ctx.moveTo(ix + 6, scanY);
    ctx.lineTo(ix + iw - 6, scanY);
    ctx.stroke();
    ctx.setLineDash([]);
  }

  function drawTimeline(tx, ty, tw, th, progress){
    rr(tx, ty, tw, th, 8, C.white, C.grid, 1);
    var pad = 6;
    var innerW = tw - pad*2;
    BEATS.forEach(function(b){
      var x0 = tx + pad + (b.start / TOTAL_SEC) * innerW;
      var w = ((b.end - b.start) / TOTAL_SEC) * innerW;
      var lit = ((progress % LOOP) / LOOP) * TOTAL_SEC >= b.start;
      rr(x0, ty + pad, w - 2, th - pad*2, 4, lit ? b.color : b.color + '44', null, 0);
      if(w > 28){
        ctx.fillStyle = lit ? '#fff' : C.muted;
        ctx.font = 'bold 7px Inter,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText(b.label, x0 + w/2 - 1, ty + th/2);
      }
    });
    txt('0 с', tx + 4, ty + th + 10, 8, '600', C.muted, 'left');
    txt('45 с', tx + tw - 4, ty + th + 10, 8, '600', C.muted, 'right');
  }

  function drawTablePreview(x, y, w, progress){
    var rows = 3;
    var rh = 22;
    rr(x, y, w, rh + rows*rh + 8, 8, 'rgba(255,255,255,.92)', C.grid, 1);
    var cols = ['Тайминг','Кадр','Реплика'];
    var cw = [w*0.22, w*0.28, w*0.46];
    var cx = x + 6;
    cols.forEach(function(col, i){
      txt(col, cx + cw[i]/2, y + 12, 7, '700', C.muted, 'center');
      cx += cw[i];
    });
    var data = [
      ['0–3 с','Крупный план','Хук: боль ЦА'],
      ['3–10 с','Телефон','Нет структуры'],
      ['10–22 с','Таблица','30 сценариев']
    ];
    var vis = Math.min(rows, 1 + Math.floor((progress % LOOP) / (LOOP/4)));
    for(var r = 0; r < vis; r++){
      var ry = y + rh + r * rh;
      ctx.strokeStyle = C.grid;
      ctx.beginPath();
      ctx.moveTo(x+4, ry);
      ctx.lineTo(x+w-4, ry);
      ctx.stroke();
      cx = x + 8;
      data[r].forEach(function(cell, i){
        txt(cell, cx, ry + rh/2, 7, '500', C.ink, 'left');
        cx += cw[i];
      });
    }
  }

  function drawSeoParticle(tag, idx, progress, targetX, targetY){
    var phase = (progress + idx * 110) % LOOP;
    var t = phase / LOOP;
    var startX = W * 0.06 + idx * 18;
    var startY = H * 0.12 + (idx % 3) * 28;
    var ease = t < 0.55 ? t / 0.55 : 1;
    var fade = t > 0.85 ? 1 - (t - 0.85) / 0.15 : 1;
    var px = startX + (targetX - startX) * ease;
    var py = startY + (targetY - startY) * ease + Math.sin(frame * 0.05 + idx) * 4;

    ctx.globalAlpha = fade * 0.9;
    var tw = ctx.measureText ? 0 : 0;
    ctx.font = '600 9px Inter,sans-serif';
    tw = ctx.measureText(tag).width + 16;
    rr(px - tw/2, py - 10, tw, 20, 10, C.seoBg, C.seo, 1.2);
    txt(tag, px, py, 9, '600', '#0369a1', 'center');
    ctx.globalAlpha = 1;
  }

  function drawHookPills(x, y, w){
    var hi = Math.floor((frame / 90) % HOOKS.length);
    var label = 'Хук ' + (hi + 1) + '/' + HOOKS.length;
    rr(x, y, w, 26, 13, 'rgba(236,72,153,.1)', C.hook, 1.2);
    txt(label, x + w/2, y + 13, 9, '700', '#be185d', 'center');
    var sub = HOOKS[hi];
    if(sub.length > 34) sub = sub.slice(0,32) + '…';
    txt(sub, x + w/2, y + 38, 8, '500', C.muted, 'center');
  }

  function draw(){
    frame++;
    var progress = frame % LOOP;
    ctx.clearRect(0,0,W,H);

    var gridStep = 32;
    ctx.strokeStyle = C.grid;
    ctx.lineWidth = 1;
    for(var gx = 0; gx < W; gx += gridStep){
      ctx.beginPath(); ctx.moveTo(gx,0); ctx.lineTo(gx,H); ctx.stroke();
    }
    for(var gy = 0; gy < H; gy += gridStep){
      ctx.beginPath(); ctx.moveTo(0,gy); ctx.lineTo(W,gy); ctx.stroke();
    }

    var phW = Math.min(W * 0.28, 130);
    var phH = phW * 1.78;
    var phoneCX = W * 0.52;
    var phoneCY = H * 0.46;

    SEO_TAGS.forEach(function(tag, i){
      drawSeoParticle(tag, i, progress, phoneCX, phoneCY - phH * 0.15);
    });

    drawPhone(phoneCX, phoneCY, phW, phH, progress);

    var tlW = Math.min(W * 0.72, 420);
    var tlX = (W - tlW) / 2;
    var tlY = H * 0.78;
    drawTimeline(tlX, tlY, tlW, 32, progress);

    if(W > 480){
      drawTablePreview(W * 0.04, H * 0.14, Math.min(W * 0.26, 160), progress);
      drawHookPills(phoneCX - phW/2 - 10, H * 0.1, Math.min(phW + 20, 150));
    } else {
      drawHookPills(phoneCX - 70, H * 0.06, 140);
    }

    txt('SEO-тема → сценарий', W/2, H * 0.04, 10, '700', C.muted, 'center');

    requestAnimationFrame(draw);
  }

  draw();
})();
</script>
</section>

  <section class="asr-section asr-section-alt" id="chto-takoe">
    <div class="asr-cnt">
      <div class="asr-sh nero-ai-reveal">
        <span class="asr-eyebrow">Определение</span>
        <h2>Что такое AI-конвейер сценариев Reels</h2>
        <p><strong>AI-конвейер сценариев Reels</strong> — повторяемый процесс, в котором из брифа (оффер, боли ЦА, tone of voice, SEO-кластер) система генерирует <strong>снимаемые</strong> сценарии с 3–5 вариантами хука и одним CTA на ролик.</p>
      </div>
      <div class="asr-grid-3 nero-ai-reveal" style="margin-top:8px">
        <div class="asr-card"><h3>От оффера и болей — к структуре</h3><p>Оффер, 10–30 болей ЦА, tone of voice, CTA-воронка. LLM раскладывает боли по рубрикам и собирает Hook → Problem → Value → Proof → CTA.</p></div>
        <div class="asr-card"><h3>SEO-тема → сценарий ролика</h3><p>Wordstat-кластер или лонгрид → тема ролика → CTA на лид-магнит. Одна SEO-тема порождает <strong>3–5 сценариев с разными хуками</strong> для A/B.</p></div>
        <div class="asr-card"><h3>Хуки, тезисы, CTA</h3><p>3–5 вариантов хука (0–3 с), тезисы по секундам, <strong>один CTA</strong>, подпись для платформы. Retention engineering 2026: не брать первый, самый слабый хук.</p></div>
      </div>
    </div>
  </section>

  <section class="asr-section" id="kak-rabotaet">
    <div class="asr-cnt">
      <div class="asr-sh nero-ai-reveal">
        <span class="asr-eyebrow">Внедрение под ключ</span>
        <h2>Как работает внедрение AI-сценариев Reels под ключ</h2>
        <p>Ориентир чека: <strong>50–180 тыс. ₽</strong> — согласуется с рынком контент-заводов (от 50 000 ₽ под ключ).</p>
      </div>
      <div class="asr-timeline nero-ai-reveal">
        <div class="asr-tl-item"><span class="asr-tl-dot"></span><h3>Шаг 1 — аудит ниши, оффера и ЦА (1–2 дня)</h3><p>Интервью, 5–10 болей, 10–20 SEO-тем, tone of voice. Итог: структурированный бриф (Brief Engine).</p></div>
        <div class="asr-tl-item"><span class="asr-tl-dot"></span><h3>Шаг 2 — генерация пакета на 30 дней</h3><p>10–30 сценариев в едином шаблоне, Hook Factory: 3–5 входов на каждый ролик. Генерация + редактура: 2–3 дня.</p></div>
        <div class="asr-tl-item"><span class="asr-tl-dot"></span><h3>Шаг 3 — интеграция в контент-план и CRM</h3><p>Выгрузка в Google Sheets, Notion, amoCRM, Bitrix24. Make.com / n8n: триггер «новая SEO-тема» → сценарий → задача в CRM. Для полноценной <a href="/vnedrenie-ai-amocrm/">интеграции AI с amoCRM под ключ</a> сценарии можно связать с воронкой сделок и задачами менеджеров.</p></div>
        <div class="asr-tl-item"><span class="asr-tl-dot"></span><h3>Шаг 4 — доработка и масштабирование без программиста</h3><p>Сценарии в таблице, инструкция batch-съёмки. CRM-интеграция — опционально. Ежемесячное пополнение по новым SEO-темам.</p></div>
      </div>
      <!-- CTA-ARTUR-1 -->
      <aside class="nero-ai-cta-inline nero-ai-card nero-ai-reveal" aria-label="Лид-магнит: 10 сценариев">
  <h3>10 сценариев под вашу нишу — в демо-пакете</h3>
  <p>После аудита ниши и оффера вы получите таблицу «тайминг | кадр | реплика | подпись» с 3–5 вариантами хука и одним CTA на каждый ролик. Без «текста в чате» — только снимаемые сценарии.</p>
  <div class="nero-ai-cta-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside>
    </div>
  </section>

  <section class="asr-section asr-section-alt" id="paket">
    <div class="asr-cnt">
      <div class="asr-sh nero-ai-reveal">
        <span class="asr-eyebrow">Формат пакета</span>
        <h2>Что входит в пакет: структура сценария Reels для бизнеса</h2>
        <p><strong>Структура reels для бизнеса</strong> — снимаемая таблица: <strong>тайминг | кадр | реплика | подпись</strong>, 3 варианта хука, ограничения «одна локация / телефон».</p>
      </div>
      <div class="asr-table-wrap nero-ai-reveal">
        <table class="asr-table" aria-label="Формула сценария Reels">
          <thead><tr><th>Блок</th><th>Время</th><th>Задача</th></tr></thead>
          <tbody>
            <tr><td>Хук</td><td>0–3 с</td><td>Остановить скролл, назвать боль или парадокс</td></tr>
            <tr><td>Проблема</td><td>3–10 с</td><td>Узнаваемая ситуация ЦА</td></tr>
            <tr><td>Ценность</td><td>10–25 с</td><td>Как услуга/метод закрывает боль</td></tr>
            <tr><td>Доказательство</td><td>25–35 с</td><td>Кейс, цифра, до/после</td></tr>
            <tr><td>CTA</td><td>35–45 с</td><td><strong>Один</strong> призыв: директ, чеклист, запись</td></tr>
          </tbody>
        </table>
      </div>
      <div class="asr-table-wrap nero-ai-reveal">
        <table class="asr-table" aria-label="Адаптация под платформы РФ">
          <thead><tr><th>Платформа</th><th>MAU (РФ)</th><th>ERR</th><th>Особенности</th></tr></thead>
          <tbody>
            <tr><td>Reels</td><td>38–42 млн</td><td>2–5%</td><td>Хук в первые 3 с, вертикаль 9:16</td></tr>
            <tr><td>VK Клипы</td><td>52 млн</td><td>3–6%</td><td>Часто выше ERR, локальный контекст</td></tr>
            <tr><td>YouTube Shorts</td><td>41 млн</td><td>—</td><td>Поисковый трафик, дольше «живёт»</td></tr>
          </tbody>
        </table>
      </div>
      <div class="asr-card nero-ai-reveal" style="margin-top:24px">
        <h3>Пример демо-сценария (шаблон)</h3>
        <p><strong>Тема (SEO):</strong> «как внедрить ai сценарии reels» · <strong>Ниша:</strong> маркетинговое агентство B2B</p>
        <div class="asr-table-wrap" style="margin-top:16px">
          <table class="asr-table" aria-label="Демо-сценарий Reels">
            <thead><tr><th>Тайминг</th><th>Кадр</th><th>Реплика</th><th>Подпись</th></tr></thead>
            <tbody>
              <tr><td>0–3 с</td><td>Крупный план</td><td>«Ваш SMM тратит 4 часа на идеи — и снимает 2 ролика»</td><td>4 часа → 2 ролика</td></tr>
              <tr><td>3–10 с</td><td>Скролл блокнота</td><td>«Проблема не в камере. Нет структуры: хук, боль, CTA»</td><td>Нет структуры</td></tr>
              <tr><td>10–22 с</td><td>Таблица сценариев</td><td>«AI-конвейер даёт 30 сценариев в едином формате»</td><td>30 сценариев</td></tr>
              <tr><td>32–40 с</td><td>Возврат в камеру</td><td>«Напиши „сценарии“ — пришлём 10 идей под вашу нишу»</td><td>CTA: 10 сценариев</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:14px;font-size:14px"><strong>Варианты хука (A/B):</strong> «4 часа на идеи — 2 ролика в месяц» · «ChatGPT дал текст. На съёмке — снова импровизация» · «Контент-план на месяц без сценариста — как»</p>
      </div>
    </div>
  </section>

  <section class="asr-section" id="dlya-kogo">
    <div class="asr-cnt">
      <div class="asr-sh nero-ai-reveal"><span class="asr-eyebrow">Аудитория</span><h2>Для кого подходит услуга</h2></div>
      <div class="asr-grid-3 nero-ai-reveal">
        <div class="asr-card"><h3>Услуги и B2B-эксперты</h3><p>Консультанты, юристы, врачи, IT, логистика, образование. <strong>Сценарии для reels эксперта</strong> — из реальных болей аудитории.</p></div>
        <div class="asr-card"><h3>Бренды и личные проекты</h3><p><strong>Ai сценарии reels для малого бизнеса</strong> — пакет 10 сценариев как лид-магнит, без штатного SMM. Регулярность 3–5 роликов в неделю.</p></div>
        <div class="asr-card"><h3>Маркетинговые агентства</h3><p>White-label пакет под клиента. Кейс MindStudio: <strong>8 → 85 роликов/мес</strong>, production time <strong>18–22 дня → 1–2 дня</strong>.</p></div>
      </div>
    </div>
  </section>

  <section class="asr-section asr-section-alt" id="sravnenie">
    <div class="asr-cnt">
      <div class="asr-sh nero-ai-reveal"><span class="asr-eyebrow">Сравнение</span><h2>AI-сценарии Reels vs ручная разработка сценариев</h2></div>
      <div class="asr-table-wrap nero-ai-reveal">
        <table class="asr-table" aria-label="Сравнение подходов">
          <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы</th></tr></thead>
          <tbody>
            <tr><td>ChatGPT / Claude «в чате»</td><td>Быстро, бесплатно/дешёво</td><td>Нет брифа, нет пакета, нет CRM, шаблонность</td></tr>
            <tr><td>SaaS (Vlex, Павля, Virale)</td><td>UI, тренды, план на 30 дней</td><td>Нет SEO-связки, нет B2B-воронки</td></tr>
            <tr><td><strong>Nero Network под ключ</strong></td><td>Оффер + боли + SEO → пакет, редактура, CRM</td><td>Чек 50–180 тыс. ₽, нужен бриф</td></tr>
          </tbody>
        </table>
      </div>
      <div class="asr-grid-2 nero-ai-reveal" style="margin-top:24px">
        <div class="asr-card"><h3>Где AI помогает</h3><ul><li>Структура, варианты хуков, таблицы</li><li>Рубрикация 30 дней</li><li>Пакет за 3–5 рабочих дней</li></ul></div>
        <div class="asr-card"><h3>Где нужен редактор</h3><ul><li>Неожиданность и фирменная конкретика</li><li>Точная интонация бренда</li><li>Quality Gate: штампы, вода, несколько CTA</li></ul></div>
      </div>
    </div>
  </section>

  <section class="asr-section" id="oshibki">
    <div class="asr-cnt">
      <div class="asr-sh asr-left nero-ai-reveal"><span class="asr-eyebrow">Чеклист</span><h2>5 ошибок AI-сценариев (и как их не делать)</h2></div>
      <div class="asr-grid-2 nero-ai-reveal">
        <div class="asr-card"><h3>1. Штампы и вода</h3><p>«В современном мире», 40 секунд без новой информации. Решение: бриф с конкретными болями и beat-структура по секундам.</p></div>
        <div class="asr-card"><h3>2. Несколько CTA</h3><p>«Подпишись, лайк, сайт, директ». Решение: <strong>один CTA</strong> на ролик.</p></div>
        <div class="asr-card"><h3>3. Нет хука</h3><p>Вход с «привет, я…». Решение: Hook Factory, 3–5 вариантов, не брать первый.</p></div>
        <div class="asr-card"><h3>4. Нет конкретики бизнеса</h3><p>Сценарий «для всех». Решение: вход из CRM-болей и SEO-тем клиента.</p></div>
      </div>
    </div>
  </section>

  <section class="asr-section asr-section-alt" id="keisy">
    <div class="asr-cnt">
      <div class="asr-sh nero-ai-reveal"><span class="asr-eyebrow">Кейсы</span><h2>Примеры внедрения и кейсы</h2></div>
      <div class="asr-case-grid nero-ai-reveal">
        <div class="asr-case-card"><div class="asr-case-tag">SEO-кластер</div><h3>Эксперт по услугам — 30 сценариев</h3><p>30 SEO-тем → 30 сценариев с единым шаблоном → batch-съёмка. Связка поиска и короткого видео.</p></div>
        <div class="asr-case-card"><div class="asr-case-tag">Агентство</div><h3>Пакет сценариев под клиента</h3><p>MindStudio: <strong>8 → 85 видео/мес</strong>, production <strong>18–22 дня → 1–2 дня</strong>. White-label для агентств.</p></div>
        <div class="asr-case-card"><div class="asr-case-tag">B2B SaaS</div><h3>Long-form → short-form</h3><p>Конвейер blog → short video; Make.com + Claude API; <strong>−97% времени</strong> на автоматизированное производство (PoC).</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;font-size:14px">Измеряйте: охваты и ERR, заявки с UTM, стоимость лида, регулярность роликов в месяц до/после пакета.</p>
    </div>
  </section>

  <section class="asr-section" id="integraciya">
    <div class="asr-cnt">
      <div class="asr-sh nero-ai-reveal"><span class="asr-eyebrow">CRM и автоматизация</span><h2>Интеграция с CRM и контент-планом</h2></div>
      <div class="asr-flow nero-ai-reveal" aria-label="Поток от SEO-темы к съёмке">
        <span>Wordstat / лонгрид</span><span class="arr">→</span>
        <span>Строка в Sheets</span><span class="arr">→</span>
        <span>Сценарий + хуки</span><span class="arr">→</span>
        <span>Публикация + UTM</span><span class="arr">→</span>
        <span>Заявка в CRM</span>
      </div>
      <div class="asr-table-wrap nero-ai-reveal">
        <table class="asr-table" aria-label="Сценарии по стадиям воронки">
          <thead><tr><th>Стадия</th><th>Тип сценария</th><th>Пример CTA</th></tr></thead>
          <tbody>
            <tr><td>Прогрев</td><td>Экспертный, FAQ</td><td>«Сохрани чеклист»</td></tr>
            <tr><td>Дожим</td><td>Боль + proof</td><td>«Напиши в директ»</td></tr>
            <tr><td>Реактивация</td><td>Кейс, до/после</td><td>«Запись на консультацию»</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px">Когда Reels или Shorts приводят заявку, следующий шаг — не потерять её в почте: <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработку входящей почты в CRM</a> можно подключить в тот же контур автоматизации.</p>
    </div>
  </section>

  <section class="asr-section asr-section-alt" id="ceny">
    <div class="asr-cnt">
      <div class="asr-sh nero-ai-reveal"><span class="asr-eyebrow">Цены</span><h2>Стоимость и пакеты внедрения AI-сценариев Reels</h2><p>Ориентир чека: <strong>50–180 тыс. ₽</strong>. На цену влияют объём (10 vs 30 сценариев), ниша (комплаенс), интеграции CRM/Make и глубина редактуры.</p></div>
      <div class="asr-card nero-ai-reveal" style="max-width:640px;margin:0 auto;text-align:center">
        <h3>Лид-магнит: 10 сценариев под вашу нишу</h3>
        <p>Перед полным заказом — демо-пакет: формат таблицы и качество структуры. CTA: <strong>Получить сценарии</strong>.</p>
      </div>
    </div>
  </section>

  <section class="asr-section" id="vnedrenie-ai">
    <div class="asr-cnt">
      <div class="asr-sh nero-ai-reveal"><span class="asr-eyebrow">Быстрый старт</span><h2>Внедрение AI в бизнес: почему сценарии видео — быстрый старт</h2></div>
      <div class="asr-grid-2 nero-ai-reveal">
        <div class="asr-card"><h3>ROI коротких видео</h3><p>91% бизнесов в видеомаркетинге. Short-form — #1 ROI у 49% маркетологов. На фоне <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">масштабного внедрения AI в бизнес</a> у крупных компаний сценарии Reels — быстрый модуль с видимым результатом; Salesforce: AI-агенты — <strong>−36%</strong> на content creation.</p></div>
        <div class="asr-card"><h3>Модуль AI-стратегии</h3><p>1) SEO-контент → темы. 2) AI-сценарии Reels → охват. 3) CRM + AI-агенты → заявки. На этапе учёта и документооборота помогает <a href="/ai-1c-erp/">AI-агент для 1С и ERP</a>. Закрывает «внедрение ai решений» без полной IT-трансформации.</p></div>
      </div>
      <!-- CTA-ARTUR-2 -->
      <aside class="nero-ai-cta-inline nero-ai-card nero-ai-reveal" aria-label="Обучение и внедрение AI">
  <p>Если вы только начинаете <strong>внедрение AI в бизнес</strong>, сценарии Reels — быстрый модуль с видимым результатом за дни. Для системного освоения автоматизации и контент-конвейеров — <a href="<?php echo esc_url($secondary_cta_url); ?>"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
</aside>
      <ul class="asr-checklist nero-ai-reveal" aria-label="Чеклист готовности">
        <li>Есть чёткий оффер (3–5 формулировок)</li>
        <li>Собраны 10+ болей/вопросов ЦА</li>
        <li>Определён один главный CTA</li>
        <li>Есть SEO-темы или контент-база</li>
        <li>Примеры tone of voice</li>
        <li>Готовность batch-съёмки</li>
      </ul>
    </div>
  </section>

  <section class="asr-section asr-section-alt" id="faq">
    <div class="asr-cnt">
      <div class="asr-sh nero-ai-reveal"><span class="asr-eyebrow">FAQ</span><h2>FAQ — частые вопросы про AI-сценарии Reels</h2></div>
      <div class="asr-faq nero-ai-reveal">
        <div class="asr-faq-item"><div class="asr-faq-q">Нужен ли программист для внедрения?</div><div class="asr-faq-a"><p><strong>Нет</strong> для стартового пакета: сценарии в Google Sheets / Notion. CRM-интеграция и Make/n8n — опционально.</p></div></div>
        <div class="asr-faq-item"><div class="asr-faq-q">Сколько сценариев в месяц реально снимать?</div><div class="asr-faq-a"><p>При batch-формате: <strong>10–20 роликов за 1 съёмочный день</strong>. Реалистично для эксперта: 12–20 роликов/мес при 3–5 в неделю.</p></div></div>
        <div class="asr-faq-item"><div class="asr-faq-q">Подходят ли сценарии для YouTube Shorts?</div><div class="asr-faq-a"><p><strong>Да.</strong> Один пакет адаптируется: Reels, VK Клипы, Shorts — разная длина и темп из одной базы.</p></div></div>
        <div class="asr-faq-item"><div class="asr-faq-q">Можно ли заказать только генерацию без внедрения?</div><div class="asr-faq-a"><p>Можно пакет генерации без CRM. Полное внедрение включает бриф, редактуру, выгрузку и инструкцию.</p></div></div>
        <div class="asr-faq-item"><div class="asr-faq-q">ИИ пишет шаблонно?</div><div class="asr-faq-a"><p>Без брифа — да. С брифом, болями, SEO-темами и редактурой — структура AI + конкретика вашего бизнеса.</p></div></div>
        <div class="asr-faq-item"><div class="asr-faq-q">Instagram в РФ ограничен — зачем Reels?</div><div class="asr-faq-a"><p>Пакет <strong>мультиплатформенный</strong>: VK Клипы (52 млн MAU) и Shorts (41 млн) из одной сценарной базы.</p></div></div>
      </div>
    </div>
  </section>

  <!-- CTA-ARTUR-3 -->
  <section class="nero-ai-final" id="poluchit-scenarii" aria-labelledby="final-cta-title">
  <div class="nero-ai-container">
    <h2 id="final-cta-title" class="nero-ai-h2">Получить 10 сценариев под вашу нишу</h2>
    <p class="nero-ai-sub">AI-конвейер Nero Network: оффер + боли + SEO-темы → пакет на месяц в CRM. Ориентир чека 50–180 тыс. ₽, срок пакета 3–5 рабочих дней.</p>
    <ul class="nero-ai-badges" aria-label="Что в лид-магните">
      <li class="nero-ai-badge">10 демо-сценариев</li>
      <li class="nero-ai-badge">Таблица тайминг / кадр / реплика</li>
      <li class="nero-ai-badge">3–5 хуков на ролик</li>
    </ul>
    <div class="nero-ai-cta-row" style="justify-content:center;margin-top:24px;">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </div>
</section>

  <section class="asr-section" id="itog">
    <div class="asr-cnt">
      <div class="asr-sh nero-ai-reveal">
        <p style="font-size:clamp(15px,1.6vw,18px);max-width:760px;margin:0 auto"><strong>Итог:</strong> видео нужны постоянно — <strong>91% бизнесов</strong> уже в игре. Идеи и структура — через <strong>AI-конвейер сценариев Reels</strong>: оффер + боли + SEO → снимаемый пакет → CRM → заявки.</p>
      </div>
    </div>
  </section>
  </div>


<?php
$asr_page_url = trailingslashit( get_permalink() );
$asr_site_url = trailingslashit( home_url( '/' ) );
$asr_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$asr_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $asr_site_url . '#organization',
      'name'  => $asr_brand,
      'url'   => $asr_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $asr_site_url . '#website',
      'url'       => $asr_site_url,
      'name'      => $asr_brand,
      'publisher' => [ '@id' => $asr_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $asr_page_url . '#webpage',
      'url'         => $asr_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $asr_site_url . '#website' ],
      'about'       => [ '@id' => $asr_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $asr_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $asr_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $asr_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $asr_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $asr_page_url,
      'provider'    => [ '@id' => $asr_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $asr_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Нужен ли программист для внедрения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет для стартового пакета: сценарии в Google Sheets / Notion. CRM-интеграция и Make/n8n — опционально.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько сценариев в месяц реально снимать?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'При batch-формате: 10–20 роликов за 1 съёмочный день. Реалистично для эксперта: 12–20 роликов/мес при 3–5 в неделю.' ] ],
        [ '@type' => 'Question', 'name' => 'Подходят ли сценарии для YouTube Shorts?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Один пакет адаптируется: Reels, VK Клипы, Shorts — разная длина и темп из одной базы.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли заказать только генерацию без внедрения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Можно пакет генерации без CRM. Полное внедрение включает бриф, редактуру, выгрузку и инструкцию.' ] ],
        [ '@type' => 'Question', 'name' => 'ИИ пишет шаблонно?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Без брифа — да. С брифом, болями, SEO-темами и редактурой — структура AI + конкретика вашего бизнеса.' ] ],
        [ '@type' => 'Question', 'name' => 'Instagram в РФ ограничен — зачем Reels?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Пакет мультиплатформенный: VK Клипы (52 млн MAU) и Shorts (41 млн) из одной сценарной базы.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $asr_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
/**
 * asr-reels-hero-engine — «Вертикальная режиссерская Reels»
 * Мир: карусель брифа → storyboard 9:16 → хуки A/B → календарь съёмок
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("asr-reels-hero-canvas");
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
    phoneBg: "#0f172a",
    phoneFrame: "#334155",
    beatHook: "#f472b6",
    beatProb: "#fb923c",
    beatVal: "#38bdf8",
    beatProof: "#a78bfa",
    beatCta: "#22c55e",
    cardOffer: "#fef3c7",
    cardPain: "#fecdd3",
    cardSeo: "#bae6fd",
    calSlot: "rgba(255,255,255,0.08)",
    calActive: "rgba(236,72,153,0.35)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    glowPink: "rgba(236,72,153,0.45)"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.4;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  function drawMiniPhone(ctx, x, y, w, h, beats) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 8, C.phoneBg, C.phoneFrame);
    drawRR(ctx, x - w / 2 + 4, y - h / 2 + 6, w - 8, 10, 4, "#1e293b", null);
    var slotH = (h - 24) / beats.length;
    beats.forEach(function (b, i) {
      var by = y - h / 2 + 18 + i * slotH;
      var alpha = b.on ? 1 : 0.25;
      ctx.globalAlpha = alpha;
      drawRR(ctx, x - w / 2 + 6, by, w - 12, slotH - 3, 3, b.color, C.outline);
      if (b.on) {
        ctx.fillStyle = "#fff";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(b.label, x - w / 2 + 10, by + slotH / 2 + 1);
      }
      ctx.globalAlpha = 1;
    });
  }

  /* Карусель входа: оффер / боль / SEO — вместо Conveyor */
  function BriefInputCarousel() {
    this.cards = [
      { label: "ОФФЕР", color: C.cardOffer, offset: 0 },
      { label: "БОЛЬ", color: C.cardPain, offset: 70 },
      { label: "SEO", color: C.cardSeo, offset: 140 }
    ];
  }
  BriefInputCarousel.prototype.draw = function (ctx) {
    var trackY = 52;
    drawRR(ctx, -175, trackY - 14, 110, 28, 6, "rgba(255,255,255,0.04)", C.outline);
    ctx.strokeStyle = "rgba(148,163,184,0.35)";
    ctx.setLineDash([4, 4]);
    ctx.beginPath();
    ctx.moveTo(-65, trackY);
    ctx.lineTo(-25, trackY);
    ctx.stroke();
    ctx.setLineDash([]);

    this.cards.forEach(function (card) {
      var t = ((frame * 0.42 + card.offset) % 130) / 130;
      var px = -168 + t * 95;
      if (t < 0.88) {
        drawRR(ctx, px - 14, trackY - 11, 28, 22, 4, card.color, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(card.label, px, trackY + 2);
      }
    });
  };

  /* Вертикальный storyboard — вместо WebsiteTerminal */
  function VerticalStoryboardRail() {
    this.beats = [
      { label: "HOOK", color: C.beatHook, on: false },
      { label: "PROB", color: C.beatProb, on: false },
      { label: "VAL", color: C.beatVal, on: false },
      { label: "PROOF", color: C.beatProof, on: false },
      { label: "CTA", color: C.beatCta, on: false }
    ];
  }
  VerticalStoryboardRail.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    var glow = 0.15 + Math.sin(frame * 0.08) * 0.08;
    ctx.save();
    ctx.shadowColor = C.glowPink;
    ctx.shadowBlur = 12 * glow;
    drawMiniPhone(ctx, 0, -8, 52, 96, this.beats);
    ctx.restore();

    var thresholds = [58, 78, 98, 118, 138];
    this.beats.forEach(function (b, i) {
      b.on = prg >= thresholds[i];
    });

    if (prg >= 55 && prg < 145) {
      var pulse = Math.sin(frame * 0.15) * 2;
      ctx.strokeStyle = "rgba(236,72,153,0.5)";
      ctx.lineWidth = 1.2;
      for (var s = 0; s < 5; s++) {
        var sy = -38 + s * 16 + pulse;
        ctx.beginPath();
        ctx.moveTo(-8, sy);
        ctx.lineTo(8, sy);
        ctx.stroke();
      }
    }
  };

  /* Док вариантов хука */
  function HookVariantDock() {
    this.active = 0;
  }
  HookVariantDock.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 130 || prg >= 178) return;
    var hooks = ["«4ч → 2 ролика»", "«Нет структуры»", "«ChatGPT ≠ съёмка»"];
    this.active = Math.floor((prg - 130) / 12) % 3;
    hooks.forEach(function (h, i) {
      var hx = -58 + i * 38;
      var hy = 58;
      var isAct = i === this.active;
      drawRR(ctx, hx - 16, hy - 8, 32, 16, 4, isAct ? "rgba(236,72,153,0.35)" : "rgba(255,255,255,0.06)", isAct ? C.beatHook : C.outline);
      ctx.fillStyle = isAct ? "#fff" : "#94a3b8";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(h.substring(0, 8), hx, hy + 3);
    }, this);
    ctx.fillStyle = "#f9a8d4";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("A/B хуки", 0, 78);
  };

  /* Орбита SEO-тегов */
  function SeoTagOrbit() {
    this.tags = ["reels", "бизнес", "хук", "cta"];
  }
  SeoTagOrbit.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 20 || prg > 60) return;
    this.tags.forEach(function (tag, i) {
      var ang = frame * 0.03 + i * (Math.PI / 2);
      var rx = -95 + Math.cos(ang) * 22;
      var ry = -55 + Math.sin(ang) * 14;
      drawRR(ctx, rx - 14, ry - 6, 28, 12, 3, C.cardSeo, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(tag, rx, ry + 3);
    });
  };

  /* Лента календаря 30 дней */
  function ContentCalendarStrip() {
    this.slots = 8;
  }
  ContentCalendarStrip.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    var baseX = 95;
    var baseY = 38;
    drawRR(ctx, baseX - 42, baseY - 28, 84, 56, 6, "rgba(255,255,255,0.04)", C.outline);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("30 дней", baseX, baseY - 20);

    for (var i = 0; i < this.slots; i++) {
      var sx = baseX - 36 + (i % 4) * 18;
      var sy = baseY - 8 + Math.floor(i / 4) * 14;
      var filled = prg >= 182 + i * 5;
      drawRR(ctx, sx, sy, 14, 10, 2, filled ? C.calActive : C.calSlot, filled ? C.beatHook : C.outline);
    }

    if (prg >= 210) {
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("batch → съёмка", baseX, baseY + 32);
    }
  };

  /* Стопка готовых сценариев */
  function ShootBatchTray() {
    this.count = 0;
  }
  ShootBatchTray.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 168) return;
    this.count = Math.min(10, Math.floor((prg - 168) / 6));
    for (var i = 0; i < this.count; i++) {
      var ox = 95 + (i % 3) * 2;
      var oy = 72 - (i % 5) * 3;
      drawRR(ctx, ox - 10, oy - 8, 20, 14, 3, C.cardOffer, C.outline);
    }
    if (this.count >= 10) {
      ctx.fillStyle = C.beatCta;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("10 готово", 95, 92);
    }
  };

  /* Пульсация beat-сетки */
  function BeatRhythmGrid() {
    this.wave = 0;
  }
  BeatRhythmGrid.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 55 || prg >= 145) return;
    this.wave = Math.sin(frame * 0.2) * 3;
    ctx.strokeStyle = "rgba(56,189,248,0.25)";
    ctx.lineWidth = 1;
    for (var g = 0; g < 6; g++) {
      ctx.beginPath();
      ctx.moveTo(-120, -70 + g * 22 + this.wave);
      ctx.lineTo(120, -70 + g * 22 - this.wave);
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
    var prg = (frame * 0.04) % 240;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -120, y: 38 },
      "2_seo": { x: -70, y: 48 },
      "3_coder": { x: -5, y: -42 },
      "4_designer": { x: 40, y: -38 },
      "5_deployer": { x: 105, y: 55 }
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
      createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
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

  entities.push(new BeatRhythmGrid());
  entities.push(new BriefInputCarousel());
  entities.push(new SeoTagOrbit());
  entities.push(new VerticalStoryboardRail());
  entities.push(new HookVariantDock());
  entities.push(new ContentCalendarStrip());
  entities.push(new ShootBatchTray());

  entities.push(new Agent(-135, 78, C.agentYellow, "1_architect", 18, [
    "Бриф: оффер + боли", "Tone of voice в Markdown", "Матрица рубрик 20/50/30"
  ]));
  entities.push(new Agent(-75, 88, C.agentGreen, "2_seo", 52, [
    "Кластер Wordstat → тема", "LSI в подпись ролика", "FAQ → сценарий #7"
  ]));
  entities.push(new Agent(-15, 82, C.agentBlue, "3_coder", 88, [
    "Beat по секундам", "Один CTA — не три", "15–45 с снимаемо"
  ]));
  entities.push(new Agent(55, 78, C.agentPink, "4_designer", 128, [
    "Кадр + подпись", "9:16 вертикаль", "Batch за 1 день"
  ]));
  entities.push(new Agent(125, 82, C.agentPurple, "5_deployer", 178, [
    "Экспорт в Sheets", "Очередь съёмки", "CRM: стадия воронки"
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
    entities.forEach(function (e) { if (e.draw) e.draw(ctx); });

    var prg = (frame * 0.04) % 240;
    if (prg >= 16 && prg < 16.05) createBubble(-110, -30, "1. Оффер в бриф");
    if (prg >= 48 && prg < 48.05) createBubble(-70, -40, "2. SEO → тема");
    if (prg >= 72 && prg < 72.05) createBubble(-10, -55, "3. Beat-структура");
    if (prg >= 138 && prg < 138.05) createBubble(0, 45, "4. Хуки A/B");
    if (prg >= 188 && prg < 188.05) createBubble(95, 20, "5. Пакет в календарь");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 16, 5, C.bubbleBg, C.beatHook);
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

<script>

(function(){
  document.querySelectorAll('.asr-faq-q').forEach(function(q){
    q.addEventListener('click',function(){
      var item=q.closest('.asr-faq-item');
      if(item) item.classList.toggle('open');
    });
  });
})();

</script>

<?php
$nero_ai_header_js = function_exists('nero_ai_read_theme_asset')
    ? nero_ai_read_theme_asset('assets/js/nero-ai-site-header.js')
    : '';
if ($nero_ai_header_js === '' && function_exists('nero_ai_read_theme_asset')) {
    $nero_ai_header_js = nero_ai_read_theme_asset('nero-ai-site-header.js');
}
if ($nero_ai_header_js === '') {
    $nero_ai_header_js_fallback = dirname(__DIR__) . '/shared/theme-canonical/nero-ai-site-header.js';
    if (is_readable($nero_ai_header_js_fallback)) {
        $nero_ai_header_js = (string) file_get_contents($nero_ai_header_js_fallback);
    }
}
if ($nero_ai_header_js !== '') {
    echo "<script>\n", $nero_ai_header_js, "\n</script>\n";
}
?>

<?php get_footer(); ?>

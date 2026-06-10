<?php
/**
 * Template Name: AI-генератор рекламных креативов и гипотез: внедрение под ключ
 * Description: SEO-лендинг — AI-генератор рекламных гипотез, офферов и креативов для Яндекс Директа и VK. 20 гипотез в подарок.
 */

$page_seo_title       = 'AI рекламные креативы и гипотезы: внедрение под ключ';
$page_seo_description = 'Внедряем AI-генератор рекламных гипотез, офферов и креативов для Яндекс Директа и performance. 20 гипотез в подарок. Под ключ для бизнеса — от 70 тыс. ₽.';

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
    ['label' => 'Зачем', 'href' => '#zachem'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Каналы', 'href' => '#kanaly'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => '20 гипотез', 'href' => '#generator'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить гипотезы';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как работает';
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
/* Скрыть шапку Kadence — pill-шапка из темы */
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

/* CTA blocks */
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(255,107,157,.12),rgba(121,242,255,.1));border:1px solid rgba(255,107,157,.3);text-align:center;}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--ark-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--ark-btn-from),var(--ark-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--ark-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--ark-cyan)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* Content buttons in ark-content */
.ark-content .nero-ai-btn{display:inline-flex;align-items:center;justify-content:center;min-height:48px;padding:14px 20px;border-radius:999px;border:1px solid transparent;font-size:15px;font-weight:800;line-height:1;text-decoration:none!important;transition:transform .22s ease,box-shadow .22s ease;}
.ark-content .nero-ai-btn:hover{transform:translateY(-2px);}
.ark-content .nero-ai-btn-primary{color:#031018!important;background:linear-gradient(135deg,var(--ark-cyan),#a7f3d0);box-shadow:0 18px 42px rgba(121,242,255,.22);}
.ark-content .nero-ai-btn-secondary{color:var(--ark-text)!important;background:rgba(255,255,255,.07);border-color:rgba(255,255,255,.14);}

/* === ARK CONTENT: ai-reklamnye-kreativy-gipotezy === */
.ark-content{
  --ark-bg:#050711;--ark-bg2:#080b17;
  --ark-text:#e6edf7;--ark-muted:#9aa8bd;--ark-soft:#c7d2e5;--ark-heading:#fff;
  --ark-border:rgba(255,255,255,.10);
  --ark-magenta:#ff6b9d;--ark-cyan:#79f2ff;--ark-violet:#8b5cf6;--ark-green:#22c55e;
  --ark-btn-from:#2563eb;--ark-btn-to:#7c3aed;
  --ark-container:1220px;--ark-r:18px;--ark-r-lg:24px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--ark-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.ark-content *,.ark-content *::before,.ark-content *::after{box-sizing:border-box;}
.ark-content a{color:inherit;text-decoration:none;}
.ark-content p{color:var(--ark-muted);line-height:1.72;margin:0 0 1em;}
.ark-content p:last-child{margin-bottom:0;}
.ark-content h2,.ark-content h3,.ark-content h4{color:var(--ark-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.ark-content strong{color:var(--ark-soft);}
.ark-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.ark-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--ark-muted);font-size:14.5px;line-height:1.65;}
.ark-content ul li::before{content:'›';position:absolute;left:0;color:var(--ark-magenta);font-weight:700;}
.ark-cnt{width:min(var(--ark-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.ark-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.ark-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.ark-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.ark-sh.ark-left{margin-left:0;text-align:left;}
.ark-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.ark-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.ark-sh.ark-left p{margin-left:0;}
.ark-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(255,107,157,.08);border:1px solid rgba(255,107,157,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ark-magenta);margin-bottom:14px;}
.ark-gt{background:linear-gradient(92deg,#fff 0%,var(--ark-magenta) 40%,var(--ark-cyan) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.ark-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.ark-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.ark-intro-text{position:relative;padding-left:20px;}
.ark-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--ark-magenta),var(--ark-violet));}
.ark-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--ark-muted);margin-bottom:1em;}
.ark-intro-text p:last-child{margin-bottom:0;color:var(--ark-soft);}
.ark-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.ark-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.ark-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--ark-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.ark-kpi-card .kl{font-size:11px;font-weight:600;color:var(--ark-muted);line-height:1.4;}
.ark-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.ark-intro-grid{grid-template-columns:1fr;gap:36px;}.ark-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.ark-intro-kpi{grid-template-columns:1fr 1fr;}}
.ark-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.ark-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.ark-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid var(--ark-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--ark-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.ark-toc a:hover{border-color:rgba(255,107,157,.42);color:var(--ark-magenta);background:rgba(255,107,157,.08);}
.ark-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--ark-border);border-radius:var(--ark-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.ark-card:hover{border-color:rgba(255,107,157,.28);transform:translateY(-2px);}
.ark-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.ark-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.ark-grid-2,.ark-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.ark-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.ark-grid-3{grid-template-columns:1fr;}}
.ark-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0;}
.ark-table{width:100%;border-collapse:collapse;font-size:14px;}
.ark-table th{padding:13px 16px;text-align:left;background:rgba(255,107,157,.1);color:var(--ark-magenta);font-weight:700;border-bottom:1px solid rgba(255,107,157,.25);white-space:nowrap;}
.ark-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--ark-text);vertical-align:top;}
.ark-table tr:last-child td{border-bottom:none;}
.ark-table tr:hover td{background:rgba(255,255,255,.03);}
.ark-table tr.ark-row-highlight td{background:rgba(121,242,255,.06);}
.ark-table tr.ark-row-highlight td:first-child{font-weight:700;color:var(--ark-cyan);}
.ark-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--ark-r);padding:26px;margin-bottom:14px;}
.ark-scenario:last-child{margin-bottom:0;}
.ark-scenario h3{font-size:17px;margin-bottom:8px;}
.ark-scenario p{font-size:14.5px;margin:0 0 .6em;}
.ark-timeline{position:relative;padding-left:40px;}
.ark-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--ark-magenta),var(--ark-violet));opacity:.35;border-radius:2px;}
.ark-tl-item{position:relative;margin-bottom:32px;}
.ark-tl-item:last-child{margin-bottom:0;}
.ark-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--ark-magenta);box-shadow:0 0 0 4px rgba(255,107,157,.2);}
.ark-tl-item h3{font-size:17px;margin-bottom:8px;}
.ark-tl-item p{font-size:14.5px;margin:0;}
.ark-case-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;}
@media(max-width:768px){.ark-case-grid{grid-template-columns:1fr;}}
.ark-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.ark-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ark-green);margin-bottom:10px;}
.ark-case-card h3{font-size:16px;margin-bottom:14px;}
.ark-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px;}
.ark-metric .num{font-size:20px;font-weight:900;color:var(--ark-cyan);flex-shrink:0;}
.ark-metric .lbl{font-size:13px;color:var(--ark-muted);}
.ark-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.ark-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.ark-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--ark-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.ark-faq-q::after{content:'▾';font-size:13px;color:var(--ark-magenta);flex-shrink:0;transition:transform .25s;}
.ark-faq-item.open .ark-faq-q::after{transform:rotate(180deg);}
.ark-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--ark-muted);line-height:1.72;}
.ark-faq-item.open .ark-faq-a{max-height:800px;padding:0 24px 20px;}
.ark-generator{background:linear-gradient(135deg,#0a0e1c 0%,#12162a 50%,#0d1020 100%);border:2px solid transparent;border-image:linear-gradient(135deg,var(--ark-magenta),var(--ark-cyan),var(--ark-violet)) 1;border-radius:var(--ark-r-lg);padding:clamp(40px,5vw,64px) 0;margin:0;}
.ark-generator-inner{max-width:640px;margin:0 auto;text-align:center;}
.ark-generator-form{display:grid;gap:14px;margin-top:28px;text-align:left;}
.ark-generator-form label{font-size:13px;font-weight:600;color:var(--ark-soft);display:block;margin-bottom:4px;}
.ark-generator-form input,.ark-generator-form select,.ark-generator-form textarea{width:100%;padding:12px 16px;border-radius:12px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.06);color:var(--ark-text);font-size:15px;}
.ark-generator-form textarea{min-height:80px;resize:vertical;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(255,107,157,.12),rgba(121,242,255,.1));border:1px solid rgba(255,107,157,.3);text-align:center;}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--ark-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:var(--ark-cyan)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-reklamnye-kreativy-gipotezy-page" role="main" tabindex="-1">

<section class="nero-ai-hero ark-hero-creatives" id="hero" aria-labelledby="ark-hero-creatives-title">
<style>
/* Hero ai-reklamnye-kreativy-gipotezy — самодостаточные стили */
.ark-hero-creatives {
  --ark-magenta: #ff6b9d;
  --ark-cyan: #79f2ff;
  --ark-violet: #8b5cf6;
  --ark-text: #e6edf7;
  --ark-muted: #9aa8bd;
  --ark-soft: #c7d2e5;
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.ark-hero-creatives::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 32%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.ark-hero-creatives::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 680px;
  height: 680px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(255,107,157,.14), transparent 66%);
  filter: blur(8px);
  animation: arkCreativesGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes arkCreativesGlow {
  from { opacity: .42; transform: scale(.96); }
  to { opacity: .88; transform: scale(1.05); }
}
.ark-hero-creatives .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.ark-hero-creatives .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.ark-hero-creatives .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.2vw, 72px);
  line-height: .94;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.ark-hero-creatives .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--ark-cyan) 38%, var(--ark-magenta) 72%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.ark-hero-creatives .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(255,107,157,0.24);
  border-radius: 999px;
  background: rgba(255,107,157,0.08);
  color: var(--ark-magenta) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.ark-hero-creatives .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--ark-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.ark-hero-creatives .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.ark-hero-creatives .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 650;
}
.ark-hero-creatives .nero-ai-btn-row { display: flex; flex-wrap: wrap; gap: 14px; margin-top: 28px; }
.ark-hero-creatives .nero-ai-btn {
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
.ark-hero-creatives .nero-ai-btn:hover { transform: translateY(-2px); }
.ark-hero-creatives .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--ark-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.ark-hero-creatives .nero-ai-btn-secondary {
  color: var(--ark-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.ark-hero-creatives .nero-ai-dashboard {
  padding: 14px;
  border-radius: 28px;
  border: 1px solid rgba(255,255,255,.1);
  background: linear-gradient(180deg, rgba(255,255,255,.07), rgba(255,255,255,.03));
  box-shadow: 0 28px 90px rgba(0,0,0,.42);
  backdrop-filter: blur(18px);
}
.ark-hero-creatives .nero-ai-dashboard-shell {
  border-radius: 22px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(6,10,24,.72);
  overflow: hidden;
}
.ark-hero-creatives .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  border-bottom: 1px solid rgba(255,255,255,.07);
  background: rgba(255,255,255,.03);
}
.ark-hero-creatives .nero-ai-dots { display: flex; gap: 6px; }
.ark-hero-creatives .nero-ai-dot {
  width: 8px; height: 8px; border-radius: 999px;
  background: rgba(255,255,255,.18);
}
.ark-hero-creatives .nero-ai-window-title {
  color: var(--ark-muted);
  font-size: 11px;
  font-weight: 700;
}
.ark-hero-creatives .nero-ai-window-body { padding: 16px; }
.ark-hero-creatives .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 12px;
}
.ark-hero-creatives .nero-ai-dashboard-title h3 {
  margin: 0;
  color: #fff;
  font-size: 15px;
  font-weight: 800;
}
.ark-hero-creatives .nero-ai-live-pill {
  padding: 5px 10px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
}
.ark-hero-creatives .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 8px;
  margin-bottom: 12px;
}
.ark-hero-creatives .nero-ai-metric {
  padding: 10px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.ark-hero-creatives .nero-ai-metric span {
  display: block;
  color: var(--ark-muted);
  font-size: 11px;
  font-weight: 700;
}
.ark-hero-creatives .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.ark-hero-creatives .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.ark-hero-creatives .ark-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121,242,255,0.18);
  background: radial-gradient(ellipse at 35% 40%, rgba(139,92,246,.12), rgba(6,10,24,.92) 72%);
}
.ark-hero-creatives #ark-creatives-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.ark-hero-creatives .nero-ai-task-stream { display: grid; gap: 8px; }
.ark-hero-creatives .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.ark-hero-creatives .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(255,107,157,.12);
  color: var(--ark-magenta);
  font-size: 10px;
  font-weight: 800;
}
.ark-hero-creatives .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.ark-hero-creatives .nero-ai-task span {
  color: var(--ark-muted);
  font-size: 11px;
}
.ark-hero-creatives .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.ark-hero-creatives .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
.ark-hero-creatives .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .ark-hero-creatives .nero-ai-hero-grid { grid-template-columns: 1fr; }
}
@media (max-width: 520px) {
  .ark-hero-creatives .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .ark-hero-creatives .nero-ai-window-body { padding: 12px; }
  .ark-hero-creatives .nero-ai-task { grid-template-columns: 28px 1fr; }
  .ark-hero-creatives .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai рекламные креативы</p>
      <h1 id="ark-hero-creatives-title">AI-генератор рекламных креативов и гипотез: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI формирует гипотезы, офферы и варианты креативов — чтобы вы тестировали рекламу быстрее, а не упирались в исчерпание идей</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Гипотезы</li>
        <li class="nero-ai-badge">Яндекс Директ</li>
        <li class="nero-ai-badge">VK Ads</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">A/B-тесты</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Получить гипотезы</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация Creative Pipeline">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Creative Pipeline · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Гипотез</span>
              <strong>18</strong>
              <small>в неделю</small>
            </div>
            <div class="nero-ai-metric">
              <span>Time-to-test</span>
              <strong>2,1</strong>
              <small>дня</small>
            </div>
            <div class="nero-ai-metric">
              <span>В очереди</span>
              <strong>12</strong>
              <small>креативов</small>
            </div>
            <div class="nero-ai-metric">
              <span>CPL</span>
              <strong>−25%</strong>
              <small>после A/B*</small>
            </div>
          </div>

          <div class="ark-dash-canvas-wrap">
            <canvas id="ark-creatives-hero-canvas" role="img" aria-label="Анимация: гипотезы по орбите собираются на A/B-стенде, проходят Brand Guard и публикуются в Директ и VK"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента pipeline">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">BR</span>
              <div><strong>Бриф</strong><span>ниша, оффер, CRM-сегменты</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">20</span>
              <div><strong>20 гипотез</strong><span>аудитория × боль × CTA</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">генерация</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AB</span>
              <div><strong>Тексты Директ</strong><span>3 варианта заголовков</span></div>
              <span class="nero-ai-status nero-ai-status--violet">тест</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">VK</span>
              <div><strong>Публикация</strong><span>Brand Guard → Директ + VK</span></div>
              <span class="nero-ai-status">запуск</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * ark-creatives-hero-engine — «Зал запуска гипотез»
 * Мир: орбита гипотез → A/B-стенд → Brand Guard → публикация в площадки
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ark-creatives-hero-canvas");
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
    magenta: "#ff6b9d",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    cardA: "#fce7f3",
    cardB: "#dbeafe",
    cardC: "#ede9fe",
    boardBg: "#1e293b",
    guardGreen: "#22c55e",
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

  function drawHypothesisCard(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 4, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    if (label) ctx.fillText(label, x, y + 2);
  }

  /* Орбитальный поток гипотез — вместо Conveyor */
  function HypothesisOrbitTrack() {
    this.cards = [
      { angle: 0, color: C.cardA, label: "H1" },
      { angle: 2.1, color: C.cardB, label: "H2" },
      { angle: 4.2, color: C.cardC, label: "H3" }
    ];
  }
  HypothesisOrbitTrack.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    var orbitR = 95 + Math.sin(frame * 0.04) * 4;
    ctx.strokeStyle = "rgba(121,242,255,0.15)";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.ellipse(0, 5, orbitR, orbitR * 0.55, 0, 0, Math.PI * 2);
    ctx.stroke();

    this.cards.forEach(function (card, i) {
      var speed = 0.018 + i * 0.003;
      var ang = card.angle + frame * speed;
      var pull = prg > 35 && prg < 95 ? (prg - 35) / 60 : 0;
      var r = orbitR * (1 - pull * 0.72);
      var px = Math.cos(ang) * r;
      var py = 5 + Math.sin(ang) * r * 0.55;
      if (pull < 0.95) drawHypothesisCard(ctx, px, py, 18, 22, card.color, card.label);
    });
  };

  /* Стопка офферов слева */
  function OfferCardStack() {}
  OfferCardStack.prototype.draw = function (ctx) {
    for (var i = 0; i < 3; i++) {
      drawRR(ctx, -155 + i * 3, -42 + i * 4, 26, 32, 3, i === 2 ? C.cardA : "#f8fafc", C.outline);
    }
    ctx.fillStyle = C.magenta;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Офферы", -152, -48);
  };

  /* A/B сплит-стенд — вместо WebsiteTerminal */
  function AbVariantBoard() {
    this.winner = null;
    this.publishPulse = 0;
  }
  AbVariantBoard.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, -55, -62, 110, 118, 10, C.boardBg, C.outline);

    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("A/B · сплит", 0, -48);

    var showVariants = prg >= 55;
    if (showVariants) {
      var variants = [
        { x: -32, color: C.cardA, label: "A", ctr: "3.2%" },
        { x: 0, color: C.cardB, label: "B", ctr: "4.1%" },
        { x: 32, color: C.cardC, label: "C", ctr: "2.8%" }
      ];
      variants.forEach(function (v, i) {
        var pop = Math.min(1, (prg - 55 - i * 12) / 14);
        if (pop <= 0) return;
        ctx.globalAlpha = pop;
        drawRR(ctx, v.x - 14, -30, 28, 36, 4, v.color, C.outline);
        ctx.fillStyle = C.outline;
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.fillText(v.label, v.x, -18);
        ctx.font = "6px Inter,sans-serif";
        ctx.fillText("CTR " + v.ctr, v.x, 0);
        ctx.globalAlpha = 1;
      });
    }

    if (prg >= 175) {
      this.publishPulse = Math.min(1, (prg - 175) / 20);
      ctx.strokeStyle = C.cyan;
      ctx.lineWidth = 2;
      ctx.globalAlpha = 0.4 + Math.sin(frame * 0.2) * 0.3;
      ctx.beginPath();
      ctx.arc(0, 8, 38 + this.publishPulse * 22, 0, Math.PI * 2);
      ctx.stroke();
      ctx.globalAlpha = 1;
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("WIN → площадки", 0, 38);
    } else {
      this.publishPulse = 0;
    }
  };

  /* Щит Brand Guard */
  function BrandGuardGate() {
    this.flash = 0;
  }
  BrandGuardGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 120 || prg >= 175) return;
    var gatePrg = (prg - 120) / 55;
    this.flash = Math.sin(frame * 0.15) * 0.15 + 0.85;

    ctx.save();
    ctx.globalAlpha = 0.25 + gatePrg * 0.5;
    drawRR(ctx, 72, -38, 44, 52, 8, "rgba(34,197,94,0.12)", C.guardGreen);
    ctx.strokeStyle = C.guardGreen;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(82, -8);
    ctx.lineTo(94, 2);
    ctx.lineTo(108, -22);
    ctx.stroke();
    ctx.fillStyle = C.guardGreen;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Brand", 94, 2);
    ctx.fillText("Guard", 94, 12);
    ctx.restore();
  };

  /* Пульс CTR справа */
  function CTRPulseMeter() {
    this.bars = [0.4, 0.65, 0.5, 0.8];
  }
  CTRPulseMeter.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, 118, -58, 36, 70, 5, "rgba(255,255,255,0.05)", C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CTR", 136, -48);

    this.bars.forEach(function (b, i) {
      var h = 8 + b * 22 + (prg > 175 ? Math.sin(frame * 0.1 + i) * 4 : 0);
      drawRR(ctx, 124 + i * 7, 2 - h, 5, h, 2, i === 3 ? C.magenta : C.cyan, null);
    });
  };

  /* Маяки площадок */
  function PlatformBeacon() {
    this.pulse = 0;
  }
  PlatformBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 185) return;
    this.pulse = (prg - 185) / 35;

    var platforms = [
      { x: -70, y: 52, label: "Д", color: "#fc3f1d" },
      { x: 0, y: 58, label: "VK", color: "#0077ff" }
    ];
    platforms.forEach(function (p, i) {
      var a = Math.min(1, this.pulse - i * 0.15);
      if (a <= 0) return;
      ctx.globalAlpha = a;
      drawRR(ctx, p.x - 14, p.y - 10, 28, 20, 5, p.color, C.outline);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(p.label, p.x, p.y + 3);
      ctx.globalAlpha = 1;
    }, this);
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }
  Agent.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    this.timer += 0.03;
    var isMoving = false;
    var faceDir = 1;
    var targetX = -20 + this.stepTrig * 0.08;
    var targetY = -20;

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (targetX - this.baseX) * (local / 11);
        this.y = this.baseY + (targetY - this.baseY) * (local / 11);
      } else if (local < 16) {
        this.x = targetX; this.y = targetY;
      } else {
        isMoving = true; faceDir = -1;
        this.x = targetX - (targetX - this.baseX) * ((local - 16) / 6);
        this.y = targetY - (targetY - this.baseY) * ((local - 16) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.5);
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -12, -8 - bob, 24, 16, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -18 - bob, 10, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 1.5;
    ctx.strokeStyle = C.outline;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new OfferCardStack());
  entities.push(new HypothesisOrbitTrack());
  entities.push(new AbVariantBoard());
  entities.push(new BrandGuardGate());
  entities.push(new CTRPulseMeter());
  entities.push(new PlatformBeacon());

  entities.push(new Agent(-140, 38, C.agentYellow, "1_architect", 18, [
    "Бриф: ниша + CRM", "20 гипотез в веере", "Сегмент × боль × CTA", "Очередь тестов готова", "Запускаю pipeline"
  ]));
  entities.push(new Agent(-105, 62, C.agentGreen, "2_seo", 58, [
    "Заголовок под Директ", "УТП в 56 символов", "LSI в оффере", "Текст B побеждает", "Hook для VK"
  ]));
  entities.push(new Agent(-68, 28, C.agentBlue, "3_coder", 98, [
    "Вариант A/B/C", "Формат 1080×1080", "Промпт YandexART", "Видео из статики", "Очередь в API"
  ]));
  entities.push(new Agent(-32, 55, C.agentPink, "4_designer", 128, [
    "Brand Guard OK", "Маркировка рекламы", "Тон бренда держим", "Галлюцинацию убрала", "Compliance ✓"
  ]));
  entities.push(new Agent(8, 22, C.agentPurple, "5_deployer", 168, [
    "Победитель B → Директ", "Дубль в VK Ads", "UTM в CRM", "A/B в кабинете", "CPL −25%*"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.042) % 240;
    if (prg >= 12 && prg < 12.05) createBubble(-140, 10, "1. Бриф + CRM");
    if (prg >= 52 && prg < 52.05) createBubble(-105, 35, "2. Веер гипотез");
    if (prg >= 92 && prg < 92.05) createBubble(-68, 5, "3. A/B-варианты");
    if (prg >= 132 && prg < 132.05) createBubble(-32, 30, "4. Brand Guard");
    if (prg >= 188 && prg < 188.05) createBubble(8, -5, "5. Публикация!");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 18, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 9);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineLoop);
  }

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(engineLoop);
  } else {
    engineLoop();
  }
});
</script>

<div class="ark-content">

  <!-- INTRO после hero -->
  <section class="ark-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="ark-cnt">
      <div class="ark-intro-grid nero-ai-reveal">
        <div class="ark-intro-text">
          <p class="ark-eyebrow">Лонгрид · ai рекламные креативы</p>
          <p><strong>Коротко:</strong> AI-генератор рекламных креативов и гипотез — не разовая «нейросеть для баннера», а управляемый конвейер: система формулирует офферы и тестовые гипотезы, производит варианты текстов и визуалов под форматы площадок и отдаёт их в цикл A/B-тестов. Nero Network внедряет такой pipeline под ключ — с интеграцией в CRM, рекламные кабинеты и бренд-гайдлайны клиента.</p>
          <p>Performance-маркетинг в 2026 году упирается не в отсутствие бюджета, а в скорость идей. Пока команда вручную собирает третий вариант объявления, аудитория уже «выгорает» на прежних креативах. <strong>AI рекламные креативы</strong> и <strong>ai гипотезы для рекламы</strong> закрывают этот разрыв — при условии, что внедрение выстроено как процесс, а не как эксперимент с чат-ботом.</p>
          <!-- INTERNAL-LINKS:INSERT -->
        </div>
        <div class="ark-intro-kpi" aria-label="Ключевые показатели рынка">
          <div class="ark-kpi-card">
            <div class="kv">100%</div>
            <div class="kl">агентств используют ИИ</div>
            <div class="ks">Okkam Creative, 2026</div>
          </div>
          <div class="ark-kpi-card">
            <div class="kv">65%</div>
            <div class="kl">имеют план внедрения</div>
            <div class="ks">Okkam Creative, 2026</div>
          </div>
          <div class="ark-kpi-card">
            <div class="kv">+17%</div>
            <div class="kl">конверсий с нейрообъявлениями</div>
            <div class="ks">Яндекс Директ</div>
          </div>
          <div class="ark-kpi-card">
            <div class="kv">3–5</div>
            <div class="kl">вариаций в неделю — цель тестов</div>
            <div class="ks">performance, 2026</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="ark-toc-outer">
    <div class="ark-cnt">
      <nav class="ark-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#kanaly">Каналы</a>
        <a href="#keisy">Кейсы</a>
        <a href="#generator">20 гипотез</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- #zachem -->
  <section class="ark-section" id="zachem">
    <div class="ark-cnt">
      <div class="ark-sh ark-left">
        <span class="ark-eyebrow">Зачем бизнесу</span>
        <h2>Зачем бизнесу AI-генератор рекламных гипотез и креативов</h2>
        <p><strong>Определение:</strong> AI-генератор рекламных гипотез и креативов — программно-организационная система, в которой LLM и генеративные модели изображений/видео работают по заданным правилам бренда и данным CRM, выдавая очередь тестируемых офферов и готовых к запуску материалов для performance-каналов.</p>
      </div>

      <div class="ark-grid-3 nero-ai-reveal">
        <div class="ark-card">
          <h3>Боль «гипотезы заканчиваются»</h3>
          <p>В кабинете работают 2–3 креатива, CTR падает, новые идеи — раз в неделю. <strong>Creative fatigue</strong> снижает эффективность за 7–21 день; целевая скорость — 3–5 вариаций в неделю. Ручной продакшен редко выдерживает темп.</p>
        </div>
        <div class="ark-card nero-ai-delay-1">
          <h3>Что даёт AI</h3>
          <p>Генерация гипотез (сегмент × боль × УТП × CTA), черновики текстов и визуалов под Директ/VK, масштабирование победителей без потери смысла.</p>
        </div>
        <div class="ark-card nero-ai-delay-2">
          <h3>AI + эксперт</h3>
          <p>Максимальная отдача — симбиоз ИИ и маркетолога на постановке задач и финальном QC. Кейс Adventum × ОТП Банк: +20% лидов при human-in-the-loop.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #kak-rabotaet -->
  <section class="ark-section ark-section-alt" id="kak-rabotaet">
    <div class="ark-cnt">
      <div class="ark-sh">
        <span class="ark-eyebrow">Pipeline</span>
        <h2>Как работает AI-генератор: от гипотезы до креатива</h2>
        <p><strong>Коротко:</strong> бриф и данные → 20+ гипотез → тексты и визуалы → модерация → публикация в кабинеты → аналитика и новый виток.</p>
      </div>

      <div class="ark-table-wrap nero-ai-reveal">
        <table class="ark-table">
          <thead>
            <tr>
              <th>Шаг</th>
              <th>Что происходит</th>
              <th>Инструменты</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1. Бриф и данные</td><td>CRM, аналитика, фид, бренд-гайд, история креативов</td><td>amoCRM, Bitrix24, Метрика</td></tr>
            <tr class="ark-row-highlight"><td>2. Генерация гипотез</td><td>20+ связок «аудитория — оффер — формат»</td><td>YandexGPT, GPT, Claude</td></tr>
            <tr><td>3. Производство</td><td>Тексты, баннеры, видео по шаблонам</td><td>YandexART, Kandinsky, Runway</td></tr>
            <tr><td>4. Модерация</td><td>Compliance, маркировка, бренд</td><td>Brand Guard + маркетолог</td></tr>
            <tr><td>5. Публикация и цикл</td><td>Выгрузка в кабинеты, дашборд, алерты на fatigue</td><td>Директ API, VK Ads, Make/n8n</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ark-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="ark-card">
          <h3>A/B-варианты и creative fatigue</h3>
          <p>AI-конвейер держит очередь вариантов: разные заголовки, визуальные hook'и, CTA под сегменты из CRM. Scoring дополняется реальными метриками ваших кабинетов — не универсальным шаблоном SaaS.</p>
        </div>
        <div class="ark-card">
          <h3>Бренд-гайдлайны и compliance</h3>
          <p><strong>56%</strong> пользователей снижают доверие к бренду из-за ИИ-рекламы (Okkam). Правило Nero: управляемый ИИ — черновики от нейросети, финальное слово за человеком и чеклистом Brand Guard.</p>
        </div>
      </div>

      <div class="ark-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="ark-table">
          <thead>
            <tr><th>Зона</th><th>AI</th><th>Человек</th></tr>
          </thead>
          <tbody>
            <tr><td>Гипотезы и черновики</td><td>✓</td><td>—</td></tr>
            <tr><td>Утверждение офферов и compliance</td><td>—</td><td>✓</td></tr>
            <tr><td>Адаптация под форматы площадок</td><td>✓</td><td>контроль</td></tr>
            <tr><td>Стратегия и интерпретация ROI</td><td>—</td><td>✓</td></tr>
          </tbody>
        </table>
      </div>

      <!-- CTA-1 от Артура: после #kak-rabotaet -->
      <aside class="ym-cta-block ym-cta-block--primary" id="cta-pipeline">
        <div class="ym-cta-block__icon" aria-hidden="true">🎯</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Получите 20 гипотез для вашей рекламы</p>
          <p class="ym-cta-block__sub">Разберём нишу, канал и оффер — пришлём персонализированный список гипотез и 3–5 приоритетных для теста в ближайшие 7 дней. Бесплатно, без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Получить гипотезы</a>
        </div>
      </aside>
    </div>
  </section>

</div><!-- /.ark-content (часть 1) -->

<!-- ====================================================
     БОРИС: визуальный блок A/B-лаборатория (после #kak-rabotaet)
     ==================================================== -->
<section id="ai-reklamnye-kreativy-gipotezy-boris-block" class="brk-root" aria-label="Анимация: очередь гипотез и A/B-варианты креативов для Яндекс Директ и VK">
<style>
/* === БОРИС: prefix brk-, scoped внутри #ai-reklamnye-kreativy-gipotezy-boris-block === */
#ai-reklamnye-kreativy-gipotezy-boris-block.brk-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-reklamnye-kreativy-gipotezy-boris-block .brk-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-reklamnye-kreativy-gipotezy-boris-block .brk-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#ff6b9d;margin:0 0 14px;
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-ey::before{
  content:'';width:18px;height:2px;background:#ff6b9d;border-radius:1px;
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;
  line-height:1.28;margin:0 0 18px;
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-ul{
  list-style:none;margin:0 0 22px;padding:0;
  display:flex;flex-direction:column;gap:9px;
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-ul li{
  display:flex;align-items:flex-start;gap:10px;
  font-size:14px;line-height:1.5;color:#334155;
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(255,107,157,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#db2777;margin-top:1px;font-style:normal;
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-pills{
  display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-pl-m{background:rgba(255,107,157,.08);color:#be185d;border:1.5px solid rgba(255,107,157,.22);}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-pl-c{background:rgba(121,242,255,.12);color:#0e7490;border:1.5px solid rgba(121,242,255,.28);}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-foot{
  font-size:13px;color:#64748b;font-style:italic;margin:0;
}
#ai-reklamnye-kreativy-gipotezy-boris-block .brk-rgt{
  position:relative;
  background:linear-gradient(135deg,#fff0f6 0%,#e0f7ff 45%,#f5f3ff 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){
  #ai-reklamnye-kreativy-gipotezy-boris-block .brk-rgt{min-height:380px;}
}
#brk-hypothesis-pipeline-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>

<div class="brk-cnt">
  <div class="brk-card">
    <div class="brk-lft">
      <span class="brk-ey">A/B-лаборатория</span>
      <h3 class="brk-h3">20 гипотез → варианты креативов → тест в Директ и VK без ручного копипаста</h3>
      <ul class="brk-ul">
        <li><span class="brk-ic">1</span>Hypothesis Engine формирует связки «аудитория — боль — оффер — CTA»</li>
        <li><span class="brk-ic">2</span>Creative Factory собирает тексты и баннеры под лимиты площадок</li>
        <li><span class="brk-ic">3</span>Brand Guard отсекает галлюцинации и нарушения тона бренда</li>
        <li><span class="brk-ic">→</span>Test Orchestrator ставит A/B в очередь и следит за creative fatigue</li>
      </ul>
      <div class="brk-pills">
        <span class="brk-pl brk-pl-m">18 гипотез/нед</span>
        <span class="brk-pl brk-pl-c">2,1 дня time-to-test</span>
        <span class="brk-pl brk-pl-v">Директ + VK</span>
      </div>
      <p class="brk-foot">Дальше — этапы внедрения AI рекламных креативов под ключ →</p>
    </div>
    <div class="brk-rgt">
      <canvas
        id="brk-hypothesis-pipeline-canvas"
        aria-label="Анимация: гипотезы превращаются в варианты креативов и уходят в A/B-тесты Яндекс Директ и VK"
        role="img"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('brk-hypothesis-pipeline-canvas');
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
    ink:'#0f172a', muted:'#64748b', paper:'#ffffff', paperBdr:'#e2e8f0',
    magenta:'#ff6b9d', magentaGlow:'rgba(255,107,157,.2)',
    cyan:'#79f2ff', cyanGlow:'rgba(121,242,255,.25)',
    violet:'#8b5cf6', violetGlow:'rgba(139,92,246,.2)',
    green:'#22c55e', yandex:'#fc3f1d', vk:'#0077ff',
    line:'rgba(100,116,139,.25)'
  };

  var HYP = [
    {label:'Гипотеза A', hook:'Скидка 20%', color:C.magenta, delay:0},
    {label:'Гипотеза B', hook:'Бесплатный аудит', color:C.cyan, delay:120},
    {label:'Гипотеза C', hook:'Кейс за 7 дней', color:C.violet, delay:240},
    {label:'Гипотеза D', hook:'−25% CPL', color:C.magenta, delay:360}
  ];
  var LOOP = 520;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawHypCard(x,y,w,h,clr,title,sub,alpha){
    ctx.globalAlpha = alpha || 1;
    rr(x,y,w,h,10,C.paper,C.paperBdr,1.5);
    rr(x+8,y+8,w-16,6,3,clr,null,0);
    ctx.fillStyle=C.ink;
    ctx.font='bold 10px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText(title,x+12,y+26);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText(sub,x+12,y+40);
    ctx.globalAlpha=1;
  }

  function drawCreativeTile(x,y,s,clr,letter,alpha){
    ctx.globalAlpha = alpha || 1;
    rr(x,y,s,s*1.15,6,clr,'rgba(255,255,255,.6)',1);
    ctx.fillStyle='#fff';
    ctx.font='bold 14px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(letter,x+s/2,y+s*0.62);
    ctx.globalAlpha=1;
  }

  function drawAbFork(cx,cy,w,h,pulse){
    rr(cx,cy,w,h,12,'rgba(139,92,246,.06)',C.violet,2);
    ctx.fillStyle=C.violet;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('A/B Orchestrator',cx+w/2,cy+16);
    var bar = (pulse % 50) / 50;
    rr(cx+12,cy+h-18,w-24,6,3,'rgba(255,255,255,.5)',null,0);
    rr(cx+12,cy+h-18,(w-24)*bar,6,3,C.violet,null,0);
  }

  function drawChannel(x,y,w,h,clr,label,icon){
    rr(x,y,w,h,10,clr,'rgba(255,255,255,.4)',1.5);
    ctx.fillStyle='#fff';
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(icon,x+w/2,y+h/2-2);
    ctx.font='9px Inter,sans-serif';
    ctx.fillText(label,x+w/2,y+h/2+12);
  }

  function loop(){
    frame++;
    var t = frame % LOOP;
    ctx.clearRect(0,0,W,H);

    var pad = 16;
    var forkW = Math.min(120, W*0.2);
    var forkH = Math.min(72, H*0.18);
    var forkX = W*0.42 - forkW/2;
    var forkY = H*0.42 - forkH/2;
    var chW = Math.min(72, W*0.14);
    var chH = Math.min(48, H*0.12);
    var yandexX = W - chW - pad;
    var vkX = W - chW - pad;
    var yandexY = H*0.28;
    var vkY = H*0.62;

    drawAbFork(forkX, forkY, forkW, forkH, frame);
    drawChannel(yandexX, yandexY, chW, chH, C.yandex, 'Директ', 'Я');
    drawChannel(vkX, vkY, chW, chH, C.vk, 'VK Ads', 'VK');

    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([4,4]);
    ctx.beginPath();
    ctx.moveTo(forkX+forkW, forkY+forkH/2);
    ctx.lineTo(yandexX, yandexY+chH/2);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(forkX+forkW, forkY+forkH/2);
    ctx.lineTo(vkX, vkY+chH/2);
    ctx.stroke();
    ctx.setLineDash([]);

    var spawned = 0;
    HYP.forEach(function(h){
      var lt = (t - h.delay + LOOP) % LOOP;
      if(lt > LOOP - 40) return;
      var prog = Math.min(1, lt / 180);
      var startX = pad;
      var midX = forkX - 24;
      var x = startX + (midX - startX) * prog;
      var y = H*0.38 + spawned * 28;
      spawned++;
      var alpha = prog < 0.92 ? 1 : Math.max(0, 1 - (lt - 165) / 15);

      if(prog < 0.55){
        drawHypCard(x, y, 108, 52, h.color, h.label, h.hook, alpha);
      } else {
        var cp = (prog - 0.55) / 0.45;
        var tiles = ['A','B'];
        tiles.forEach(function(letter, i){
          var tx = x + i * 34 * cp;
          var ty = y + 4;
          drawCreativeTile(tx, ty, 28, h.color, letter, alpha * cp);
        });
        if(cp > 0.7){
          ctx.globalAlpha = alpha * (cp - 0.7) / 0.3;
          ctx.fillStyle = h.color;
          ctx.beginPath();
          ctx.arc(forkX - 6, y + 20, 4, 0, Math.PI*2);
          ctx.fill();
          ctx.globalAlpha = 1;
        }
      }
    });

    ctx.fillStyle = C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Бриф → гипотезы → креативы → тест', pad, H - pad);

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>

<div class="ark-content">

  <!-- #vnedrenie -->
  <section class="ark-section" id="vnedrenie">
    <div class="ark-cnt">
      <div class="ark-sh ark-left">
        <span class="ark-eyebrow">Под ключ</span>
        <h2>Внедрение AI рекламных креативов под ключ</h2>
        <p><strong>Определение:</strong> настройка, интеграция и обучение команды работе с готовым конвейером гипотез — не продажа «ещё одного чата с нейросетью». Включает аудит, pipeline, CRM, кабинеты и сопровождение первых тестов.</p>
      </div>

      <div class="ark-timeline nero-ai-reveal" id="etapy">
        <div class="ark-tl-item">
          <div class="ark-tl-dot"></div>
          <h3>Этапы: аудит → настройка → интеграция → обучение команды</h3>
          <p><strong>1. Аудит (3–5 дней).</strong> Разбор цикла креативов, каналов, CRM, фидов, compliance.</p>
          <p><strong>2. Настройка (1–2 недели).</strong> Промпт-библиотека, шаблоны форматов, Brand Guard, Make/n8n.</p>
          <p><strong>3. Интеграция.</strong> Директ API, VK Ads, amoCRM/Bitrix24; тестовый прогон 20 гипотез.</p>
          <p><strong>4. Обучение и запуск.</strong> Воркшоп: утверждение, дашборд, новый бриф в очередь.</p>
          <p><strong>5. Сопровождение.</strong> Донастройка по результатам первых 2–4 недель тестов.</p>
        </div>
      </div>

      <!-- CTA-2 от Артура: после этапов -->
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите понимать AI-pipeline до старта проекта?</p>
          <p class="ym-cta-block__sub">На этапе обучения команды полезно заранее разобраться в промптах, Brand Guard и human-in-the-loop — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#'); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'); ?></a>. Это ускоряет согласование сценариев с маркетингом и compliance.</p>
        </div>
      </aside>

      <div class="ark-card nero-ai-reveal" id="ceny" style="margin-top:28px;">
        <h3>Сроки и ориентир стоимости (70–220 тыс. ₽)</h3>
        <p>Ориентир чека Nero Network — <strong>от 70 до 220 тыс. ₽</strong> в зависимости от числа каналов, глубины CRM-интеграции, видео-ветки и SLA на сопровождение.</p>
        <p>Срок полного внедрения — обычно <strong>3–5 недель</strong> от аудита до первых опубликованных тестов; express-сценарий (тексты + Директ) — от 2 недель.</p>
      </div>

      <div class="ark-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Интеграция с CRM и рекламными кабинетами</h3>
        <p><strong>Вход:</strong> сегменты лидов, LTV, отказы из amoCRM / Bitrix24. <strong>Выход:</strong> задачи на тест, UTM, отчёт CPL/CPA по гипотезам. Make/n8n передаёт утверждённые креативы в кабинеты.</p>
        <p>Встроенные нейрообъявления Директа (+17% конверсий) и «Креативная студия» VK не заменяют CRM-слой и очередь гипотез под ваш бренд.</p>
      </div>
    </div>
  </section>

  <!-- #kanaly -->
  <section class="ark-section ark-section-alt" id="kanaly">
    <div class="ark-cnt">
      <div class="ark-sh">
        <span class="ark-eyebrow">Каналы</span>
        <h2>Каналы: Яндекс Директ, performance и e-commerce</h2>
      </div>
      <div class="ark-grid-2 nero-ai-reveal">
        <div class="ark-card">
          <h3>Для in-house маркетологов и агентств</h3>
          <p><strong>AI объявления яндекс директ</strong> — заголовки под лимиты, нейрообъявления, ИИ-редактор картинок. Для агентств pipeline Nero стандартизирует скорость на портфеле клиентов.</p>
          <p><strong>AI performance marketing</strong> охватывает VK Ads: мультиканальный pipeline сводит Директ и VK в одну очередь гипотез.</p>
        </div>
        <div class="ark-card">
          <h3>E-commerce и услуги: быстрый цикл тестов</h3>
          <p>Для ритейла — связка <strong>фид → гипотезы → видео/баннеры</strong>. Для услуг — compliance и сегментация боли из CRM. Малый бизнес — облегчённый пакет: Директ + 20 гипотез + базовый Brand Guard.</p>
          <!-- INTERNAL-LINKS:INSERT -->
        </div>
      </div>
    </div>
  </section>

  <!-- #keisy -->
  <section class="ark-section" id="keisy">
    <div class="ark-cnt">
      <div class="ark-sh">
        <span class="ark-eyebrow">Кейсы и ROI</span>
        <h2>Кейсы и ROI: скорость тестов вместо ручного продакшена</h2>
      </div>

      <div class="ark-table-wrap nero-ai-reveal">
        <table class="ark-table">
          <thead>
            <tr><th>Метрика</th><th>До AI-pipeline</th><th>Цель после внедрения</th></tr>
          </thead>
          <tbody>
            <tr><td>Гипотез в неделю</td><td>1–3</td><td>5–20 (с модерацией)</td></tr>
            <tr><td>Time-to-test</td><td>5–10 дней</td><td>1–3 дня</td></tr>
            <tr><td>Стоимость единицы креатива</td><td>дизайн + копирайт</td><td>доля AI + QC</td></tr>
            <tr><td>CPL / CPA</td><td>базовая линия</td><td>сравнение по гипотезам</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ark-case-grid nero-ai-reveal" style="margin-top:28px;">
        <div class="ark-case-card">
          <div class="ark-case-tag">Adventum × ОТП Банк</div>
          <h3>AI + human QC в финансах</h3>
          <div class="ark-metric"><span class="num">+20%</span><span class="lbl">лидов на YandexGPT-текстах</span></div>
          <div class="ark-metric"><span class="num">−25%</span><span class="lbl">стоимость лида</span></div>
          <div class="ark-metric"><span class="num">10,01%</span><span class="lbl">CTR vs 3,74% у контроля</span></div>
        </div>
        <div class="ark-case-card">
          <div class="ark-case-tag">Яндекс Директ</div>
          <h3>Нейрообъявления площадки</h3>
          <div class="ark-metric"><span class="num">+17%</span><span class="lbl">конверсий в среднем</span></div>
          <div class="ark-metric"><span class="num">+7%</span><span class="lbl">охвата ЦА на видео из статики</span></div>
          <p style="margin-top:12px;font-size:13px;">Официальные данные Яндекса; кастомный pipeline Nero добавляет CRM-контекст и мультиплощадочность.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA-3 от Артура: после #keisy -->
  <div class="ark-cnt">
    <aside class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте бюджет внедрения под ваши каналы</p>
        <p class="ym-cta-block__sub">Ориентир <strong>70–220 тыс. ₽</strong> за AI-генератор креативов под ключ. На аудите оценим CRM, Яндекс Директ/VK и ROI первых тестов.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Получить гипотезы'); ?></a>
          <a href="#generator" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">20 гипотез бесплатно</a>
        </div>
      </div>
    </aside>
  </div>

  <!-- #generator -->
  <section class="ark-generator" id="generator">
    <div class="ark-cnt">
      <div class="ark-generator-inner nero-ai-reveal">
        <span class="ark-eyebrow">Лид-магнит</span>
        <h2 style="font-size:clamp(26px,4vw,40px);margin-bottom:12px;">20 гипотез для вашей рекламы</h2>
        <p>Персонализированный список гипотез под вашу нишу, канал и тип оффера. После заявки — 3–5 приоритетных для теста в ближайшие 7 дней и чеклист модерации.</p>
        <form class="ark-generator-form" action="#" method="post" aria-label="Форма заявки на 20 гипотез">
          <div>
            <label for="gen-niche">Ниша / продукт</label>
            <input type="text" id="gen-niche" name="niche" placeholder="Например: стоматология, e-commerce одежда" required>
          </div>
          <div>
            <label for="gen-channel">Канал</label>
            <select id="gen-channel" name="channel">
              <option value="direct">Яндекс Директ</option>
              <option value="vk">VK Реклама</option>
              <option value="both">Директ + VK</option>
            </select>
          </div>
          <div>
            <label for="gen-goal">Целевое действие</label>
            <input type="text" id="gen-goal" name="goal" placeholder="Заявка, звонок, покупка">
          </div>
          <div>
            <label for="gen-contact">Контакт (Telegram или email)</label>
            <input type="text" id="gen-contact" name="contact" placeholder="@username или email" required>
          </div>
          <button type="submit" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="justify-self:center;margin-top:8px;">Получить гипотезы</button>
        </form>
      </div>
    </div>
  </section>

  <!-- #faq -->
  <section class="ark-section" id="faq">
    <div class="ark-cnt">
      <div class="ark-sh">
        <span class="ark-eyebrow">FAQ</span>
        <h2>Частые вопросы</h2>
      </div>
      <div class="ark-faq nero-ai-reveal" role="list">
        <div class="ark-faq-item" role="listitem">
          <div class="ark-faq-q" tabindex="0">Как внедрить ai рекламные креативы в компании с нуля?</div>
          <div class="ark-faq-a"><p>Аудит процессов → стек (LLM, CRM, кабинеты) → пилот на одном канале → Brand Guard → масштабирование на VK и e-commerce. Nero Network проходит маршрут за 3–5 недель под ключ.</p></div>
        </div>
        <div class="ark-faq-item" role="listitem">
          <div class="ark-faq-q" tabindex="0">Сколько стоят ai рекламные креативы под ключ?</div>
          <div class="ark-faq-a"><p><strong>AI рекламные креативы цена</strong> — от 70 тыс. ₽ (базовый: гипотезы + Директ + обучение) до 220 тыс. ₽ (мультиканал, CRM, видео из фида). Точная смета — после аудита.</p></div>
        </div>
        <div class="ark-faq-item" role="listitem">
          <div class="ark-faq-q" tabindex="0">Подходят ли ai рекламные креативы для малого бизнеса?</div>
          <div class="ark-faq-a"><p>Да, в облегчённом пакете: фокус на Яндекс Директ, текстовые и статичные варианты, минимальная CRM-связка.</p></div>
        </div>
        <div class="ark-faq-item" role="listitem">
          <div class="ark-faq-q" tabindex="0">Заменит ли AI маркетолога?</div>
          <div class="ark-faq-a"><p>Нет. AI усиливает маркетолога: нейросеть закрывает черновики и вариации, человек — стратегию, compliance и интерпретацию метрик.</p></div>
        </div>
        <div class="ark-faq-item" role="listitem">
          <div class="ark-faq-q" tabindex="0">Чем Nero отличается от Oblako.ai и нейрообъявлений?</div>
          <div class="ark-faq-a"><p>SaaS — инструмент в вакууме; Директ/VK — генерация без CRM и очереди гипотез. Nero — единый pipeline «20 гипотез → креативы → CRM → тест» под ваш бренд.</p></div>
        </div>
        <div class="ark-faq-item" role="listitem">
          <div class="ark-faq-q" tabindex="0">Нужна ли маркировка и соблюдение ФЗ о рекламе?</div>
          <div class="ark-faq-a"><p>Да. Brand Guard и чеклист compliance входят во внедрение; ИИ не освобождает от юридических требований в РФ.</p></div>
        </div>
        <div class="ark-faq-item" role="listitem">
          <div class="ark-faq-q" tabindex="0">Можно ли интегрировать только CRM без видео?</div>
          <div class="ark-faq-a"><p>Да. Интеграция масштабируется модульно: старт с текстов и статики + amoCRM, видео-ветку добавляют на втором этапе.</p></div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.ark-content -->

  <!-- INTERNAL-LINKS:INSERT -->
  <!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.ark-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.ark-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.ark-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.ark-faq-q');
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

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

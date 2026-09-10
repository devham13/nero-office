<?php
/**
 * Template Name: AI-агент для сметы по заявке: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-агента для первичной сметы по заявке.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-агент для сметы по заявке: внедрение под ключ';
$page_seo_description = 'Внедряем AI-агента для первичной сметы по заявке: сбор параметров объекта, фото и пожеланий клиента. Черновик сметы за минуты, интеграция с CRM. Бриф бесплатно.';

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
    ['label' => 'Для кого', 'href' => '#komu'],
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

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать сметного агента';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

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

.aspa-content{
  --aspa-bg:#050711;--aspa-bg2:#080b17;--aspa-bg3:#0a0e1c;
  --aspa-surface:rgba(255,255,255,.072);--aspa-surface2:rgba(255,255,255,.108);
  --aspa-text:#e6edf7;--aspa-muted:#9aa8bd;--aspa-soft:#c7d2e5;--aspa-heading:#fff;
  --aspa-border:rgba(255,255,255,.10);--aspa-border-s:rgba(255,255,255,.18);
  --aspa-accent:#f5c518;--aspa-violet:#8b5cf6;--aspa-green:#22c55e;--aspa-cyan:#79f2ff;
  --aspa-btn-from:#2563eb;--aspa-btn-to:#7c3aed;
  --aspa-shadow:0 24px 72px rgba(0,0,0,.4);
  --aspa-r:18px;--aspa-r-lg:24px;--aspa-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aspa-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aspa-content *,.aspa-content *::before,.aspa-content *::after{box-sizing:border-box;}
.aspa-content a{color:inherit;text-decoration:none;}
.aspa-content p{color:var(--aspa-muted);line-height:1.72;margin:0 0 1em;}
.aspa-content p:last-child{margin-bottom:0;}
.aspa-content h2,.aspa-content h3,.aspa-content h4{color:var(--aspa-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.aspa-content strong{color:var(--aspa-soft);}
.aspa-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aspa-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aspa-muted);font-size:14.5px;line-height:1.65;}
.aspa-content ul li::before{content:'›';position:absolute;left:0;color:var(--aspa-accent);font-weight:700;}
.aspa-cnt{width:min(var(--aspa-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aspa-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aspa-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aspa-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aspa-sh.aspa-left{margin-left:0;text-align:left;}
.aspa-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aspa-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aspa-sh.aspa-left p{margin-left:0;}
.aspa-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aspa-accent);margin-bottom:14px;}
.aspa-gt{background:linear-gradient(92deg,#fff 0%,var(--aspa-accent) 44%,var(--aspa-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.aspa-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.aspa-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.aspa-intro-text{position:relative;padding-left:20px;}
.aspa-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aspa-accent),var(--aspa-violet));}
.aspa-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--aspa-muted);margin-bottom:1em;}
.aspa-intro-text p:last-child{margin-bottom:0;color:var(--aspa-soft);}
.aspa-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aspa-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.aspa-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aspa-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.aspa-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aspa-muted);line-height:1.4;}
.aspa-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.aspa-intro-grid{grid-template-columns:1fr;gap:36px;}.aspa-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.aspa-intro-kpi{grid-template-columns:1fr 1fr;}}
.aspa-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aspa-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aspa-toc a{display:inline-block;padding:9px 18px;background:var(--aspa-surface);border:1px solid var(--aspa-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aspa-muted);transition:border-color .2s,color .2s,background .2s;}
.aspa-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--aspa-accent);background:rgba(245,197,24,.08);}
.aspa-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aspa-border);border-radius:var(--aspa-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.aspa-card:hover{border-color:rgba(245,197,24,.28);transform:translateY(-2px);}
.aspa-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aspa-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.aspa-grid-2,.aspa-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.aspa-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aspa-grid-3{grid-template-columns:1fr;}}
.aspa-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--aspa-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.aspa-scenario:last-child{margin-bottom:0;}
.aspa-scenario:hover{border-color:rgba(245,197,24,.3);}
.aspa-scenario h3{font-size:17px;margin-bottom:8px;}
.aspa-scenario p{font-size:14.5px;margin:0 0 .6em;}
.aspa-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aspa-table{width:100%;border-collapse:collapse;font-size:14px;}
.aspa-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--aspa-accent);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);white-space:nowrap;}
.aspa-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aspa-text);vertical-align:top;}
.aspa-table tr:last-child td{border-bottom:none;}
.aspa-table tr:hover td{background:rgba(255,255,255,.03);}
.aspa-timeline{position:relative;padding-left:40px;}
.aspa-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aspa-accent),var(--aspa-violet));opacity:.35;border-radius:2px;}
.aspa-tl-item{position:relative;margin-bottom:32px;}
.aspa-tl-item:last-child{margin-bottom:0;}
.aspa-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--aspa-accent);box-shadow:0 0 0 4px rgba(245,197,24,.2);}
.aspa-tl-item h3{font-size:17px;margin-bottom:8px;}
.aspa-tl-item p{font-size:14.5px;margin:0;}
.aspa-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.aspa-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aspa-case-grid{grid-template-columns:1fr;}}
.aspa-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.aspa-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.aspa-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aspa-green);margin-bottom:10px;}
.aspa-case-card h3{font-size:16px;margin-bottom:14px;}
.aspa-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aspa-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.aspa-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aspa-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.aspa-faq-q::after{content:'▾';font-size:13px;color:var(--aspa-accent);flex-shrink:0;transition:transform .25s;}
.aspa-faq-item.open .aspa-faq-q::after{transform:rotate(180deg);}
.aspa-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--aspa-muted);line-height:1.72;}
.aspa-faq-item.open .aspa-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,197,24,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--aspa-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--aspa-btn-from),var(--aspa-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--aspa-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--aspa-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}


.aspa-callout-pain{display:flex;gap:16px;align-items:flex-start;padding:22px 24px;border-radius:16px;background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.22);margin:24px 0;}
.aspa-callout-pain .ico{font-size:28px;line-height:1;flex-shrink:0;}
.aspa-steps{display:flex;flex-direction:column;gap:14px;margin:24px 0;}
.aspa-step-item{display:grid;grid-template-columns:36px 1fr;gap:14px;align-items:start;padding:16px 18px;border-radius:14px;background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);counter-increment:aspa-step;}
.aspa-steps{counter-reset:aspa-step;}
.aspa-step-item::before{content:counter(aspa-step);width:36px;height:36px;border-radius:10px;background:rgba(245,197,24,.15);color:var(--aspa-accent);font-weight:900;font-size:14px;display:grid;place-items:center;}
.aspa-int-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:24px;}
@media(max-width:768px){.aspa-int-grid{grid-template-columns:1fr;}}
.aspa-int-card{padding:20px;border-radius:16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);text-align:center;}
.aspa-int-card .ico{font-size:32px;margin-bottom:10px;}
.aspa-price-band{display:inline-flex;align-items:center;gap:12px;padding:16px 28px;border-radius:16px;background:linear-gradient(135deg,rgba(245,197,24,.15),rgba(121,242,255,.1));border:1px solid rgba(245,197,24,.35);margin:20px 0;font-size:clamp(18px,2.5vw,24px);font-weight:800;color:#fff;}
.aspa-table-highlight td:last-child,.aspa-table-highlight th:last-child{background:rgba(245,197,24,.08);}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-smeta-po-zayavke-page" role="main" tabindex="-1">

<section class="nero-ai-hero aspa-hero-smeta" id="hero" aria-labelledby="aspa-hero-title">
<style>
/* ── Hero ai-smeta-po-zayavke: самодостаточные стили (без CSS темы) ── */
.aspa-hero-smeta {
  --aspa-gold: #f5c518;
  --aspa-teal: #79f2ff;
  --aspa-green: #22c55e;
  --aspa-text: #e6edf7;
  --aspa-muted: #9aa8bd;
  --aspa-soft: #c7d2e5;
  --aspa-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aspa-hero-smeta::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.aspa-hero-smeta::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .09), transparent 66%);
  filter: blur(8px);
  animation: aspaHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aspaHeroGlow {
  from { opacity: .35; transform: scale(.95); }
  to { opacity: .78; transform: scale(1.05); }
}
.aspa-hero-smeta .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aspa-hero-smeta .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aspa-hero-smeta .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aspa-hero-smeta .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aspa-gold) 40%, var(--aspa-teal) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aspa-hero-smeta .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 197, 24, 0.22);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--aspa-gold) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aspa-hero-smeta .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aspa-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aspa-hero-smeta .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aspa-hero-smeta .nero-ai-badge {
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
.aspa-hero-smeta .aspa-hero-steps {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 18px 0 0;
  padding: 0;
  list-style: none;
}
.aspa-hero-smeta .aspa-hero-step {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 7px 12px;
  border-radius: 12px;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: rgba(121, 242, 255, 0.06);
  color: #b8ecff;
  font-size: 12px;
  font-weight: 700;
}
.aspa-hero-smeta .aspa-hero-step span {
  width: 20px;
  height: 20px;
  border-radius: 6px;
  background: rgba(245, 197, 24, 0.22);
  color: var(--aspa-gold);
  display: grid;
  place-items: center;
  font-size: 10px;
  font-weight: 900;
}
.aspa-hero-smeta .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 30px;
}
.aspa-hero-smeta .nero-ai-btn {
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
.aspa-hero-smeta .nero-ai-btn:hover { transform: translateY(-2px); }
.aspa-hero-smeta .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--aspa-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.aspa-hero-smeta .nero-ai-btn-secondary {
  color: var(--aspa-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aspa-hero-smeta .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aspa-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.aspa-hero-smeta .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aspa-hero-smeta .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aspa-hero-smeta .nero-ai-dots { display: flex; gap: 7px; }
.aspa-hero-smeta .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aspa-hero-smeta .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aspa-hero-smeta .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aspa-hero-smeta .nero-ai-dot:nth-child(3) { background: #34d399; }
.aspa-hero-smeta .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aspa-hero-smeta .nero-ai-window-body { padding: 16px; }
.aspa-hero-smeta .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aspa-hero-smeta .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aspa-hero-smeta .nero-ai-live-pill {
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
.aspa-hero-smeta .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aspaPulse 1.6s infinite;
}
@keyframes aspaPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aspa-hero-smeta .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aspa-hero-smeta .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aspa-hero-smeta .nero-ai-metric span {
  display: block;
  color: var(--aspa-muted);
  font-size: 11px;
  font-weight: 700;
}
.aspa-hero-smeta .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aspa-hero-smeta .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aspa-hero-smeta .aspa-dash-canvas-wrap {
  position: relative;
  height: clamp(210px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 35% 40%, rgba(121,242,255,.08), rgba(6,10,24,.94) 74%);
}
.aspa-hero-smeta #aspa-smeta-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aspa-hero-smeta .nero-ai-task-stream { display: grid; gap: 8px; }
.aspa-hero-smeta .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aspa-hero-smeta .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--aspa-teal);
  font-size: 11px;
  font-weight: 800;
}
.aspa-hero-smeta .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aspa-hero-smeta .nero-ai-task span {
  color: var(--aspa-muted);
  font-size: 11px;
}
.aspa-hero-smeta .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aspa-hero-smeta .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.aspa-hero-smeta .aspa-hero-pill {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 14px;
}
.aspa-hero-smeta .aspa-hero-pill span {
  padding: 6px 12px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.1);
  background: rgba(255,255,255,.04);
  color: #cbd5e1;
  font-size: 11px;
  font-weight: 700;
}
@media (max-width: 1100px) {
  .aspa-hero-smeta .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aspa-hero-smeta .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aspa-hero-smeta .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aspa-hero-smeta .nero-ai-window-body { padding: 12px; }
  .aspa-hero-smeta .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aspa-hero-smeta .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Строительство / смета · внедрение под ключ</p>
      <h1 id="aspa-hero-title">AI-агент для первичного расчёта сметы по заявке: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Клиент не ждёт: AI собирает параметры объекта, фото и пожелания — сметчик получает черновик сметы за минуты, а не за часы переписки</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Бриф 24/7</li>
        <li class="nero-ai-badge">Фото объекта</li>
        <li class="nero-ai-badge">Черновик сметы</li>
        <li class="nero-ai-badge">CRM + сметчик</li>
      </ul>
      <ol class="aspa-hero-steps" aria-label="Этапы обработки заявки">
        <li class="aspa-hero-step"><span>1</span>Заявка</li>
        <li class="aspa-hero-step"><span>2</span>AI-бриф</li>
        <li class="aspa-hero-step"><span>3</span>Теги по фото</li>
        <li class="aspa-hero-step"><span>4</span>Черновик</li>
        <li class="aspa-hero-step"><span>5</span>Сметчик</li>
      </ol>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
      <div class="aspa-hero-pill" aria-label="Интеграции и контроль">
        <span>amoCRM</span>
        <span>Bitrix24</span>
        <span>Telegram</span>
        <span>Human-in-the-loop</span>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация: заявка → черновик сметы">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Заявка → черновик сметы</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Заявок сегодня</span>
              <strong>12</strong>
              <small>сайт / мессенджеры</small>
            </div>
            <div class="nero-ai-metric">
              <span>До черновика</span>
              <strong>4 мин</strong>
              <small>среднее время</small>
            </div>
            <div class="nero-ai-metric">
              <span>Позиций в смете</span>
              <strong>38</strong>
              <small>из вашего прайса</small>
            </div>
            <div class="nero-ai-metric">
              <span>Полный бриф</span>
              <strong>86%</strong>
              <small>до выезда</small>
            </div>
          </div>

          <div class="aspa-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aspa-smeta-hero-canvas" role="img" aria-label="Анимация: пакеты брифа по канату, AI собирает черновик сметы и передаёт сметчику в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий сметного агента">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Заявка: ремонт 65 м²</strong><span>Telegram · новая сделка</span></div>
              <span class="nero-ai-status">принято</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Бриф собран</strong><span>площадь, сроки, бюджет, фото</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📷</span>
              <div><strong>Теги по фото</strong><span>демонтаж · штукатурка · потолок</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">₽</span>
              <div><strong>Черновик 38 позиций</strong><span>цены из прайса · CRM</span></div>
              <span class="nero-ai-status nero-ai-status--amber">на проверке</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Задача сметчику</strong><span>проверить скрытые работы</span></div>
              <span class="nero-ai-status">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="aspa-content">

  <section class="aspa-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="aspa-cnt">
      <div class="aspa-intro-grid nero-ai-reveal">
        <div class="aspa-intro-text">
          <p class="aspa-eyebrow">Лонгрид · ai смета по заявке</p>
          <p><strong>Коротко:</strong> AI-агент для первичной сметы по заявке — это система, которая принимает входящую заявку 24/7, структурированно собирает параметры объекта, фото и пожелания клиента и готовит черновик сметы для проверки сметчиком. Это не «магическая цена из чата», а связка брифа, CRM и сметной логики под контролем человека.</p>
          <p>Строительные компании, ремонтные бригады и монтажники инженерных систем теряют лиды на этапе, когда клиент ждёт оценку, а менеджер вручную перебирает вводные из мессенджеров, звонков и Excel.</p>
        </div>
        <div class="aspa-intro-kpi" aria-label="Ключевые метрики сметного агента">
          <div class="aspa-kpi-card"><div class="kv">4 мин</div><div class="kl">до черновика</div><div class="ks">среднее время</div></div>
          <div class="aspa-kpi-card"><div class="kv">24/7</div><div class="kl">сбор брифа</div><div class="ks">без менеджера</div></div>
          <div class="aspa-kpi-card"><div class="kv">38</div><div class="kl">позиций в смете</div><div class="ks">из вашего прайса</div></div>
          <div class="aspa-kpi-card"><div class="kv">HITL</div><div class="kl">human-in-the-loop</div><div class="ks">финал за сметчиком</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aspa-toc-outer">
    <div class="aspa-cnt">
      <nav class="aspa-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что такое</a>
        <a href="#bol">Боль продаж</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#komu">Для кого</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Бриф</a>
      </nav>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <section class="aspa-section" id="chto-takoe">
    <div class="aspa-cnt">
      <div class="aspa-sh">
        <span class="aspa-eyebrow">Определение</span>
        <h2>Что такое AI-агент для первичной сметы по заявке</h2>
        <p><strong>Определение:</strong> AI-агент для первичной сметы по заявке — связка чат-интерфейса (сайт, Telegram, WhatsApp, форма в CRM) и backend-логики, которая принимает заявку, собирает вводные, анализирует фото и формирует черновик сметы с пометкой «для проверки сметчиком».</p>
      </div>
      <div class="aspa-card nero-ai-reveal">
        <p>В отличие от SaaS для сметчиков (ПростоСмета, Solar ИИ-Сметчик, Smeta.AI), агент работает на <strong>входящем потоке клиентов</strong>: заявка приходит с сайта или из мессенджера — и уже через минуты в CRM появляется структурированный бриф и черновик позиций.</p>
        <p>По данным McKinsey (март 2026), индустрия переходит к <strong>agentic AI</strong> — системам, которые не только генерируют текст, но и <strong>действуют</strong> под контролем человека.</p>
      </div>
      <div class="aspa-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="aspa-card">
          <h3>Зачем автоматизировать первичную смету</h3>
          <ul>
            <li><strong>Скорость ответа</strong> — клиент не уходит, пока менеджер «допрашивает» вводные.</li>
            <li><strong>Полнота брифа</strong> — агент задаёт все нужные вопросы по скрипту.</li>
            <li><strong>Экономия времени сметчика</strong> — он проверяет черновик, а не собирает данные.</li>
          </ul>
        </div>
        <div class="aspa-card nero-ai-delay-1">
          <h3>Чем AI-агент отличается от калькулятора и Excel</h3>
          <p>Калькулятор закрывает квалификацию. AI-смета добавляет <strong>черновик с позициями</strong>, а не только вилку «от–до».</p>
        </div>
      </div>
      <div class="aspa-table-wrap nero-ai-reveal aspa-table-highlight" style="margin-top:28px;">
        <table class="aspa-table">
          <thead><tr><th>Критерий</th><th>Excel</th><th>Калькулятор</th><th>AI-агент</th></tr></thead>
          <tbody>
            <tr><td>Сбор вводных</td><td>Менеджер вручную</td><td>3–5 полей</td><td>Диалог с уточнениями</td></tr>
            <tr><td>Фото объекта</td><td>Отдельно</td><td>Не принимает</td><td>Тегирует состояние</td></tr>
            <tr><td>Выход</td><td>Пустая таблица</td><td>Вилка «от–до»</td><td>Черновик для сметчика</td></tr>
            <tr><td>CRM</td><td>Копипаст</td><td>Часто без интеграции</td><td>Сделка + задача сметчику</td></tr>
            <tr><td>24/7</td><td>Нет</td><td>Да, без сметы</td><td>Да, с черновиком</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aspa-section aspa-section-alt" id="bol">
    <div class="aspa-cnt">
      <div class="aspa-sh aspa-left">
        <span class="aspa-eyebrow">Боль отдела продаж</span>
        <h2>Клиент ждёт оценку, менеджер собирает вводные вручную</h2>
        <p>Клиент написал «сколько стоит ремонт 65 м²», менеджер ответил через два часа. Сметчик получил скриншоты — без площади демонтажа и списка материалов.</p>
      </div>
      <div class="aspa-callout-pain nero-ai-reveal">
        <span class="ico" aria-hidden="true">⏳</span>
        <div><p style="margin:0;color:var(--aspa-soft);"><strong>Менеджер превращается в секретаря переписки.</strong> 30–50% ночных лидов «остывают» без автоответа с брифом.</p></div>
      </div>
      <div class="aspa-grid-2 nero-ai-reveal">
        <div class="aspa-card">
          <h3>Типовой путь без AI</h3>
          <ol style="padding-left:20px;color:var(--aspa-muted);line-height:1.7;font-size:14.5px;">
            <li>Заявка на сайте или в мессенджере.</li>
            <li>Переписка 5–15 сообщений.</li>
            <li>Фото без структуры.</li>
            <li>Данные в Excel/CRM вручную.</li>
            <li>Сметчик без единого брифа.</li>
            <li>КП через 4–48 часов — или клиент ушёл.</li>
          </ol>
        </div>
        <div class="aspa-card nero-ai-delay-1">
          <h3>Типовые потери</h3>
          <ul>
            <li><strong>Ночные заявки</strong> — 30–50% без автоответа.</li>
            <li><strong>Неполный бриф</strong> — 40–60% времени сметчика на уточнения.</li>
            <li><strong>Потеря контекста</strong> — фото и пожелания в разных каналах.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

<section id="ai-smeta-po-zayavke-boris-block" class="aspa-boris-root nero-ai-section" aria-label="Анимация: из переписки и фото — черновик сметы в CRM для сметчика">
<style>
/* === БОРИС: prefix aspa-, scoped внутри #ai-smeta-po-zayavke-boris-block === */
#ai-smeta-po-zayavke-boris-block.aspa-boris-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-smeta-po-zayavke-boris-block .aspa-boris-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-smeta-po-zayavke-boris-block .aspa-boris-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-ey{
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
#ai-smeta-po-zayavke-boris-block .aspa-boris-ey::before{
  content:'';
  width:18px;height:2px;
  background:linear-gradient(90deg,#f5c518,#79f2ff);
  border-radius:1px;
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(245,197,24,.15);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#b45309;
  margin-top:1px;
  font-style:normal;
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-pl-a{
  background:rgba(245,197,24,.12);
  color:#92400e;
  border:1.5px solid rgba(245,197,24,.35);
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-pl-t{
  background:rgba(121,242,255,.12);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.35);
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-smeta-po-zayavke-boris-block .aspa-boris-rgt{
  position:relative;
  background:linear-gradient(135deg,#fffbeb 0%,#fef9c3 22%,#ecfeff 55%,#f0fdfa 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-smeta-po-zayavke-boris-block .aspa-boris-rgt{min-height:380px;}
}
#aspa-smeta-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="aspa-boris-cnt">
  <div class="aspa-boris-card">

    <div class="aspa-boris-lft">
      <span class="aspa-boris-ey">Рабочий стол сметчика</span>
      <h3 class="aspa-boris-h3">Переписка и фото превращаются в черновик сметы — сметчик проверяет, а не собирает вводные</h3>
      <ul class="aspa-boris-ul">
        <li><span class="aspa-boris-ic">1</span>Заявки из Telegram, WhatsApp и сайта стекаются в одну CRM-карточку</li>
        <li><span class="aspa-boris-ic">2</span>AI структурирует бриф: площадь, материалы, теги по фото — без цен «с потолка»</li>
        <li><span class="aspa-boris-ic">3</span>Черновик с позициями из вашего прайса попадает сметчику с чек-листом</li>
        <li><span class="aspa-boris-ic">✓</span>Спорные строки помечаются «ТРЕБУЕТ ЗАМЕРА» — финал за человеком</li>
      </ul>
      <div class="aspa-boris-pills">
        <span class="aspa-boris-pl aspa-boris-pl-a">~4 мин до черновика</span>
        <span class="aspa-boris-pl aspa-boris-pl-t">38 позиций в смете</span>
        <span class="aspa-boris-pl aspa-boris-pl-g">human-in-the-loop</span>
      </div>
      <p class="aspa-boris-foot">Дальше — пошаговая схема: заявка → бриф → черновик → КП клиенту →</p>
    </div>

    <div class="aspa-boris-rgt">
      <canvas
        id="aspa-smeta-pipeline-canvas"
        aria-label="Анимация: сообщения клиента и фото объекта превращаются в таблицу черновика сметы в CRM для проверки сметчиком"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('aspa-smeta-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;
  var LOOP = 720;

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
    paper:'#ffffff',
    line:'rgba(14,165,233,.28)',
    tg:'#2AABEE',
    wa:'#25D366',
    amber:'#f5c518',
    teal:'#79f2ff',
    ai:'#8b5cf6',
    aiGlow:'rgba(139,92,246,.18)',
    crm:'#1e293b',
    crmHdr:'#334155',
    row:'#f8fafc',
    rowAlt:'#f1f5f9',
    green:'#22c55e',
    warn:'#f59e0b',
    warnBg:'#fef3c7',
    photo:'#cbd5e1'
  };

  var MSGS = [
    {ch:'TG', color:C.tg, text:'Ремонт 65 м², вторичка', delay:0},
    {ch:'WA', color:C.wa, text:'3 фото комнат + голосовое', delay:120},
    {ch:'TG', color:C.tg, text:'Бюджет до 1,2 млн, срок 2 мес', delay:240},
    {ch:'WA', color:C.wa, text:'Натяжной потолок, демонтаж', delay:360},
    {ch:'TG', color:C.tg, text:'Планировка во вложении', delay:480}
  ];

  var ROWS = [
    {name:'Демонтаж стяжки', qty:'42 м²', price:'1 680 ₽', ok:true},
    {name:'Штукатурка стен', qty:'118 м²', price:'354 ₽', ok:true},
    {name:'Электроразводка', qty:'—', price:'ТРЕБУЕТ ЗАМЕРА', ok:false},
    {name:'Натяжной потолок', qty:'65 м²', price:'890 ₽', ok:true},
    {name:'Плитка ванная', qty:'18 м²', price:'2 100 ₽', ok:true}
  ];

  var PHOTO_TAGS = ['старая штукатурка', 'натяжной потолок', 'демонтаж'];

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawBubble(x,y,w,text,chColor,chLabel,alpha){
    ctx.globalAlpha = alpha || 1;
    rr(x,y,w,36,10,C.paper,'#e2e8f0',1);
    rr(x+6,y+6,28,24,6,chColor,null,0);
    ctx.fillStyle='#fff';
    ctx.font='bold 8px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(chLabel,x+20,y+20);
    ctx.fillStyle=C.ink;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='left';
    var short = text.length>22 ? text.slice(0,20)+'…' : text;
    ctx.fillText(short,x+40,y+22);
    ctx.globalAlpha=1;
  }

  function drawBriefHub(cx,cy,w,h,pulse){
    rr(cx,cy,w,h,14,C.aiGlow,C.ai,2);
    ctx.fillStyle=C.ai;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('AI · бриф + vision',cx+w/2,cy+20);

    var fields = ['65 м²','вторичка','класс «комфорт»'];
    fields.forEach(function(f,i){
      var fy = cy + 36 + i*22;
      var fw = ctx.measureText(f).width + 14;
      rr(cx+12,fy,fw,18,9,'#ede9fe','#c4b5fd',1);
      ctx.fillStyle='#5b21b6';
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(f,cx+19,fy+12);
    });

    PHOTO_TAGS.forEach(function(tag,i){
      var tx = cx + w - 8 - ctx.measureText(tag).width - 12;
      var ty = cy + h - 28 - i*20;
      rr(tx,ty,ctx.measureText(tag).width+12,16,8,'#ecfeff','#67e8f9',1);
      ctx.fillStyle='#0e7490';
      ctx.font='8px Inter,sans-serif';
      ctx.fillText(tag,tx+6,ty+11);
    });

    var scanY = cy + 52 + (pulse % 70);
    ctx.fillStyle='rgba(121,242,255,.25)';
    ctx.fillRect(cx+10,scanY-1,w-20,3);
  }

  function drawCrmTable(x,y,w,h,visibleRows,pulse){
    rr(x,y,w,h,12,C.crm,'#475569',2);
    rr(x,y,w,32,12,C.crmHdr,null,0);
    ctx.fillStyle='#f8fafc';
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('CRM · черновик сметы',x+12,y+20);
    ctx.fillStyle=C.teal;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='right';
    ctx.fillText('на проверке',x+w-12,y+20);

    var rh=28, top=y+40;
    ROWS.forEach(function(row,i){
      if(i>=visibleRows) return;
      var ry=top+i*(rh+4);
      var bg=i%2===0?C.row:C.rowAlt;
      rr(x+8,ry,w-16,rh,6,bg,'#e2e8f0',1);
      ctx.fillStyle=C.ink;
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(row.name,x+14,ry+17);
      ctx.fillStyle=C.muted;
      ctx.fillText(row.qty,x+w*0.52,ry+17);
      if(row.ok){
        ctx.fillStyle=C.green;
        ctx.font='bold 9px Inter,sans-serif';
        ctx.textAlign='right';
        ctx.fillText(row.price,x+w-14,ry+17);
      } else {
        ctx.fillStyle='#b45309';
        ctx.font='bold 8px Inter,sans-serif';
        ctx.textAlign='right';
        ctx.fillText(row.price,x+w-14,ry+17);
      }
    });

    var estX = x + w - 52;
    var estY = y + h - 44;
    rr(estX,estY,44,44,22,'#fef3c7',C.amber,2);
    ctx.fillStyle='#92400e';
    ctx.font='bold 18px sans-serif';
    ctx.textAlign='center';
    ctx.fillText('👷',estX+22,estY+30);

    if(visibleRows>=3){
      var ckY = estY - 8;
      ctx.strokeStyle=C.green;
      ctx.lineWidth=2;
      ctx.beginPath();
      ctx.moveTo(estX-20,ckY);
      ctx.lineTo(estX-14,ckY+6);
      ctx.lineTo(estX-6,ckY-4);
      ctx.stroke();
    }
  }

  function drawArrow(x1,y1,x2,y2,alpha){
    ctx.globalAlpha=alpha||0.45;
    ctx.strokeStyle=C.line;
    ctx.lineWidth=1.5;
    ctx.setLineDash([5,4]);
    ctx.beginPath();
    ctx.moveTo(x1,y1);ctx.lineTo(x2,y2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.globalAlpha=1;
  }

  function drawPhotoThumb(x,y,s,alpha){
    ctx.globalAlpha=alpha||1;
    rr(x,y,s,s*0.75,4,C.photo,'#94a3b8',1);
    ctx.fillStyle='#64748b';
    ctx.font='8px sans-serif';
    ctx.textAlign='center';
    ctx.fillText('📷',x+s/2,y+s*0.42);
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t = frame % LOOP;
    ctx.clearRect(0,0,W,H);

    var pad = 12;
    var hubW = Math.min(118, W*0.2);
    var hubH = Math.min(130, H*0.32);
    var hubX = W*0.38 - hubW/2;
    var hubY = H*0.42 - hubH/2;
    var crmW = Math.min(168, W*0.28);
    var crmH = Math.min(210, H*0.52);
    var crmX = W - crmW - pad;
    var crmY = H*0.5 - crmH/2;

    drawBriefHub(hubX,hubY,hubW,hubH,frame);

    var visibleRows = 0;
    MSGS.forEach(function(msg){
      var lt = (t - msg.delay + LOOP) % LOOP;
      if(lt > LOOP - 60) return;
      var prog = Math.min(1, lt / 180);
      var startX = pad;
      var endX = hubX - 8;
      var bx = startX + (endX - startX) * prog;
      var by = hubY + 20 + (MSGS.indexOf(msg) % 3) * 42;
      var alpha = prog < 0.92 ? 1 : Math.max(0, 1 - (lt - 165) / 15);
      var bw = Math.min(140, W*0.22);
      if(prog < 0.55){
        drawBubble(bx, by, bw, msg.text, msg.color, msg.ch, alpha);
      } else if(prog < 0.85){
        drawBubble(hubX + hubW/2 - bw/2, by, bw, msg.text, msg.color, msg.ch, 0.35);
        drawArrow(bx + bw, by + 18, hubX, hubY + hubH/2, prog - 0.55);
      }
      if(prog > 0.7) visibleRows = Math.max(visibleRows, Math.floor((prog - 0.7) / 0.06) + 1);
    });

    if(t > 200){
      var photoProg = Math.min(1, (t - 200) / 120);
      drawPhotoThumb(hubX - 28, hubY + hubH - 20, 24, photoProg);
      drawArrow(hubX + hubW, hubY + hubH/2, crmX, crmY + crmH/2, Math.min(1, (t-280)/80));
    }

    visibleRows = Math.min(ROWS.length, Math.max(visibleRows, Math.floor(t / 140) % (ROWS.length + 1)));
    drawCrmTable(crmX, crmY, crmW, crmH, visibleRows, frame);

    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Мессенджеры · заявка', pad, H - 10);
    ctx.textAlign='center';
    ctx.fillText('Структурирование брифа', hubX + hubW/2, H - 10);
    ctx.textAlign='right';
    ctx.fillText('Черновик для сметчика', crmX + crmW, H - 10);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>


  <section class="aspa-section" id="kak-rabotaet">
    <div class="aspa-cnt">
      <div class="aspa-sh">
        <span class="aspa-eyebrow">Процесс</span>
        <h2>Как работает AI-смета по заявке: параметры объекта, фото, пожелания</h2>
        <p>Схема: <strong>заявка → бриф → черновик → проверка сметчика → КП клиенту</strong>.</p>
      </div>
      <div class="aspa-table-wrap nero-ai-reveal">
        <table class="aspa-table">
          <thead><tr><th>Вводная</th><th>Что спрашивает агент</th><th>На замер</th></tr></thead>
          <tbody>
            <tr><td>Тип объекта</td><td>Квартира, дом, коммерция</td><td>Скрытые коммуникации</td></tr>
            <tr><td>Площадь</td><td>Общая, жилая, по комнатам</td><td>Точные объёмы демонтажа</td></tr>
            <tr><td>Состояние</td><td>Новострой / вторичка</td><td>Скрытые дефекты</td></tr>
            <tr><td>Фото</td><td>Общий вид, проблемные зоны</td><td>Скрытые работы</td></tr>
          </tbody>
        </table>
      </div>
      <div class="aspa-steps nero-ai-reveal">
        <div class="aspa-step-item"><div><strong>Заявка</strong> — сайт, Telegram, WhatsApp или транскрипт звонка.</div></div>
        <div class="aspa-step-item"><div><strong>AI-бриф</strong> — уточняющие вопросы по скрипту, сбор фото в CRM.</div></div>
        <div class="aspa-step-item"><div><strong>Шаблон сметы</strong> — детерминированное сопоставление ответов и тегов.</div></div>
        <div class="aspa-step-item"><div><strong>Черновик</strong> — позиции из прайса; «ТРЕБУЕТ ЗАМЕРА» для неизвестного.</div></div>
        <div class="aspa-step-item"><div><strong>Проверка сметчика</strong> — чек-лист, правки, PDF клиенту.</div></div>
      </div>
      <div class="ym-cta-block ym-cta-block--primary" id="cta-brief">
        <div class="ym-cta-block__icon" aria-hidden="true">📐</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Собрать сметного агента под вашу услугу</p>
          <p class="ym-cta-block__sub">Бесплатный «Бриф на смету под вашу услугу»: разберём каналы заявок и покажем, как AI соберёт черновик из вашего прайса — не вилку «от–до».</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="aspa-section aspa-section-alt" id="komu">
    <div class="aspa-cnt">
      <div class="aspa-sh"><span class="aspa-eyebrow">Сегменты</span><h2>Кому нужен AI-агент для сметы по заявке</h2></div>
      <div class="aspa-grid-3 nero-ai-reveal">
        <div class="aspa-card"><h3>Строительные компании</h3><p>Ускорение пресейла: параметры дома → черновик по шаблону. BIMLIB: с 3 недель до 5 минут на BIM.</p></div>
        <div class="aspa-card nero-ai-delay-1"><h3>Ремонт и отделка</h3><p>Фото комнат + класс отделки → 38–41 позиция за 4–5 минут. EstimationPro AI: estimate за ~30 сек.</p></div>
        <div class="aspa-card nero-ai-delay-2"><h3>Инженерные системы</h3><p>The Best Check: PDF-смета в CRM. Агент собирает вводные до выезда инженера.</p></div>
      </div>
    </div>
  </section>

  <section class="aspa-section" id="integracii">
    <div class="aspa-cnt">
      <div class="aspa-sh"><span class="aspa-eyebrow">Интеграции</span><h2>CRM, мессенджеры и сметные программы</h2></div>
      <div class="aspa-int-grid nero-ai-reveal">
        <div class="aspa-int-card"><div class="ico">📊</div><h3>amoCRM / Bitrix24</h3><p>Сделка: собрано → черновик → проверка → отправлено клиенту.</p></div>
        <div class="aspa-int-card"><div class="ico">💬</div><h3>Telegram / WhatsApp</h3><p>Заявка в привычном мессенджере — без длинной формы на сайте.</p></div>
        <div class="aspa-int-card"><div class="ico">📋</div><h3>Гранд-Смета / 1С</h3><p>Экспорт черновика в Excel/XML. Полная синхронизация — после пилота.</p></div>
      </div>
    </div>
  </section>

  <section class="aspa-section aspa-section-alt" id="keisy">
    <div class="aspa-cnt">
      <div class="aspa-sh"><span class="aspa-eyebrow">Кейсы</span><h2>Примеры внедрения AI-сметы по заявке</h2></div>
      <div class="aspa-case-grid nero-ai-reveal">
        <div class="aspa-case-card"><div class="aspa-case-tag">Электромонтаж</div><h3>The Best Check</h3><p>PDF-смета в Битrix24 прямо на объекте.</p></div>
        <div class="aspa-case-card"><div class="aspa-case-tag">Нормативы</div><h3>Solar BI</h3><p>ГЭСН-2022, human-in-the-loop, XLSX/DOCX.</p></div>
        <div class="aspa-case-card"><div class="aspa-case-tag">Пресейл</div><h3>Meldana</h3><p>От 159 000 ₽ внедрение, КП за минуты.</p></div>
        <div class="aspa-case-card"><div class="aspa-case-tag">США</div><h3>EstimationPro AI</h3><p>Фото + голос → line-item estimate ~30 сек.</p></div>
        <div class="aspa-case-card"><div class="aspa-case-tag">США</div><h3>Houzz Pro</h3><p>Cost database → itemized proposal.</p></div>
        <div class="aspa-case-card"><div class="aspa-case-tag">Пилот</div><h3>20–30 заявок</h3><p>Метрики: время, полнота брифа, конверсия.</p></div>
      </div>
    </div>
  </section>

  <section class="aspa-section" id="vnedrenie">
    <div class="aspa-cnt">
      <div class="aspa-sh aspa-left"><span class="aspa-eyebrow">Под ключ</span><h2>Внедрение: от брифа до запуска</h2></div>
      <div class="aspa-card nero-ai-reveal">
        <div class="aspa-timeline">
          <div class="aspa-tl-item"><div class="aspa-tl-dot"></div><h3>Аудит (2–3 дня)</h3><p>Каналы заявок, шаблоны, SLA. «Бриф на смету под вашу услугу».</p></div>
          <div class="aspa-tl-item"><div class="aspa-tl-dot"></div><h3>Прототип (7–14 дней)</h3><p>Бот + виджет + CRM; пилот на реальных заявках.</p></div>
          <div class="aspa-tl-item"><div class="aspa-tl-dot"></div><h3>Интеграция (7–10 дней)</h3><p>RAG по прайсу, human-in-the-loop, обучение команды. 3–5 недель до пилота.</p></div>
        </div>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите понимать AI-автоматизацию до старта проекта?</p>
          <p class="ym-cta-block__sub">На этапе обучения полезно пройти <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a> — так проще формулировать требования к сметному агенту.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="aspa-section aspa-section-alt" id="ceny">
    <div class="aspa-cnt">
      <div class="aspa-sh"><span class="aspa-eyebrow">Коммерция</span><h2>Сколько стоит внедрение AI-агента для сметы</h2></div>
      <div class="aspa-price-band nero-ai-reveal">180 000 – 600 000 ₽ за внедрение под ключ</div>
      <div class="aspa-grid-2 nero-ai-reveal">
        <div class="aspa-card"><h3>Рынок</h3><ul><li>Meldana — от 159 000 ₽.</li><li>GPTmag (строительство) — ~680 000 ₽.</li></ul></div>
        <div class="aspa-card nero-ai-delay-1"><h3>Факторы цены</h3><ul><li>Типы услуг и деревья вопросов.</li><li>CRM, мессенджеры, Гранд-Смета.</li><li>Фото, голос, OCR, 152-ФЗ.</li></ul></div>
      </div>
    </div>
  </section>

  <section class="aspa-section" id="sravnenie">
    <div class="aspa-cnt">
      <div class="aspa-sh"><span class="aspa-eyebrow">Сравнение</span><h2>AI-смета vs ручной расчёт и quantity takeoff</h2></div>
      <div class="aspa-table-wrap nero-ai-reveal aspa-table-highlight">
        <table class="aspa-table">
          <thead><tr><th>Подход</th><th>Вход</th><th>Время</th><th>Кому</th></tr></thead>
          <tbody>
            <tr><td>Ручной расчёт</td><td>Переписка</td><td>Часы–дни</td><td>Мало заявок</td></tr>
            <tr><td>Бот с вилкой</td><td>Анкета</td><td>5–20 мин</td><td>Квалификация</td></tr>
            <tr><td>SaaS для сметчика</td><td>Описание</td><td>5–10 мин</td><td>Без CRM-клиента</td></tr>
            <tr><td><strong>AI-агент по заявке</strong></td><td>Заявка + фото</td><td>Минуты</td><td>Поток заявок</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aspa-section aspa-section-alt" id="riski">
    <div class="aspa-cnt">
      <div class="aspa-sh"><span class="aspa-eyebrow">E-E-A-T</span><h2>Риски и контроль качества</h2></div>
      <div class="aspa-grid-3 nero-ai-reveal">
        <div class="aspa-card"><h3>Галлюцинации</h3><p>Цены только из прайса; «ТРЕБУЕТ ЗАМЕРА» для неизвестного.</p></div>
        <div class="aspa-card nero-ai-delay-1"><h3>Ответственность</h3><p>Черновик предварительный; финал, замер и договор — за сметчиком.</p></div>
        <div class="aspa-card nero-ai-delay-2"><h3>152-ФЗ</h3><p>Хранение в РФ; согласие при фото с людьми или адресом.</p></div>
      </div>
    </div>
  </section>

  <section class="aspa-section" id="faq">
    <div class="aspa-cnt">
      <div class="aspa-sh"><span class="aspa-eyebrow">FAQ</span><h2>Частые вопросы об AI-смете по заявке</h2></div>
      <div class="aspa-faq nero-ai-reveal">
        <div class="aspa-faq-item"><div class="aspa-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить без программиста?</div><div class="aspa-faq-a">Внедрение под ключ — задача интегратора. Вы передаёте прайсы и скрипты; webhook, бот и RAG — на стороне исполнителя.</div></div>
        <div class="aspa-faq-item"><div class="aspa-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит для малого бизнеса?</div><div class="aspa-faq-a">Да, при потоке от 10–15 заявок в месяц и повторяющихся типах работ.</div></div>
        <div class="aspa-faq-item"><div class="aspa-faq-q" role="button" tabindex="0" aria-expanded="false">Интеграция с CRM?</div><div class="aspa-faq-a">amoCRM, Bitrix24, Kommo — сделка, фото, задача сметчику.</div></div>
        <div class="aspa-faq-item"><div class="aspa-faq-q" role="button" tabindex="0" aria-expanded="false">Заменит сметчика?</div><div class="aspa-faq-a">Нет. Агент убирает рутину сбора; сметчик проверяет цифры и скрытые работы.</div></div>
        <div class="aspa-faq-item"><div class="aspa-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна проектная документация?</div><div class="aspa-faq-a">Нет — для первичной оценки по заявке. ГЭСН из проектов — другие инструменты.</div></div>
        <div class="aspa-faq-item"><div class="aspa-faq-q" role="button" tabindex="0" aria-expanded="false">Точность черновика?</div><div class="aspa-faq-a">Ориентир для обсуждения; зависит от брифа и прайса.</div></div>
        <div class="aspa-faq-item"><div class="aspa-faq-q" role="button" tabindex="0" aria-expanded="false">Только WhatsApp?</div><div class="aspa-faq-a">WhatsApp Business API + единая карточка в CRM.</div></div>
        <div class="aspa-faq-item"><div class="aspa-faq-q" role="button" tabindex="0" aria-expanded="false">Гранд-Смета?</div><div class="aspa-faq-a">Экспорт Excel/XML; двусторонняя синхронизация — после пилота.</div></div>
      </div>
    </div>
  </section>

  <section class="aspa-section" id="cta" style="background:linear-gradient(135deg,rgba(245,197,24,.08),rgba(121,242,255,.08));">
    <div class="aspa-cnt">
      <div class="aspa-sh"><h2>Собрать сметного агента под вашу услугу</h2><p>AI-агент 24/7, черновик из прайса, amoCRM, Bitrix24, Telegram, WhatsApp, human-in-the-loop.</p></div>
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы перестать терять лиды на этапе первичной сметы?</p>
          <p class="ym-cta-block__sub">180 000–600 000 ₽, до пилота 3–5 недель. Соберём сметного агента под ремонт, строительство или инженерные системы.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Сначала FAQ</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script id="aspa-smeta-hero-engine">
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("aspa-smeta-hero-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");

  let cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    if (!canvas.parentElement) return;
    canvas.width = canvas.parentElement.clientWidth || 400;
    canvas.height = canvas.parentElement.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 20;
    scale = cw < 400 ? cw / 420 : Math.min(cw / 520, ch / 300) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  const C = {
    outline: "#0f172a",
    gold: "#f5c518",
    teal: "#79f2ff",
    green: "#22c55e",
    boardBg: "#0b1224",
    boardRow: "#1e293b",
    cable: "#64748b",
    packetBlue: "#93c5fd",
    packetAmber: "#fcd34d",
    packetPink: "#fbcfe8",
    bubbleBg: "#ffffff",
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
    if (stroke) { ctx.lineWidth = 2; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  class BriefPacketCable {
    constructor(x, y, w) {
      this.x = x; this.y = y; this.w = w;
    }
    draw(ctx) {
      ctx.lineWidth = 3;
      ctx.strokeStyle = C.cable;
      ctx.beginPath();
      ctx.moveTo(this.x, this.y);
      ctx.quadraticCurveTo(this.x + this.w * 0.5, this.y - 35, this.x + this.w, this.y);
      ctx.stroke();
      ctx.fillStyle = C.cable;
      for (let i = 0; i < 4; i++) {
        ctx.beginPath();
        ctx.arc(this.x + i * (this.w / 3), this.y - (i % 2) * 8, 4, 0, Math.PI * 2);
        ctx.fill();
      }
      const offset = (frame * 0.45) % (this.w + 40);
      const packs = [
        { col: C.packetAmber, label: "TG" },
        { col: C.packetBlue, label: "📷" },
        { col: C.packetPink, label: "65м²" }
      ];
      packs.forEach((p, idx) => {
        const px = this.x - 20 + ((offset + idx * 55) % (this.w + 30));
        if (px > this.x - 10 && px < this.x + this.w + 10) {
          drawRR(ctx, px, this.y - 18, 22, 16, 3, p.col, C.outline);
          ctx.fillStyle = C.outline;
          ctx.font = "bold 7px sans-serif";
          ctx.textAlign = "center";
          ctx.fillText(p.label, px + 11, this.y - 7);
        }
      });
    }
  }

  class DraftEstimateBoard {
    constructor(x, y) {
      this.x = x; this.y = y;
      this.rowCount = 0;
      this.stampScale = 0;
      this.crmPulse = 0;
    }
    draw(ctx) {
      const cycle = (frame * 0.04) % 240;
      this.rowCount = Math.min(5, Math.floor(cycle / 28));
      drawRR(ctx, this.x, this.y, 210, 170, 10, C.boardBg, C.outline);
      drawRR(ctx, this.x + 8, this.y + 8, 194, 22, 4, "#162032", C.outline);
      ctx.fillStyle = C.teal;
      ctx.font = "bold 9px sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("ЧЕРНОВИК СМЕТЫ · демо", this.x + 14, this.y + 22);

      for (let i = 0; i < this.rowCount; i++) {
        const ry = this.y + 38 + i * 22;
        drawRR(ctx, this.x + 10, ry, 190, 16, 3, C.boardRow, null);
        drawRR(ctx, this.x + 14, ry + 4, 70 + (i * 8), 8, 2, "#334155", null);
        drawRR(ctx, this.x + 160, ry + 4, 32, 8, 2, C.gold, C.outline);
      }

      if (cycle > 140 && cycle < 200) {
        this.stampScale = Math.min(1, (cycle - 140) / 25);
        ctx.save();
        ctx.translate(this.x + 155, this.y + 130);
        ctx.scale(this.stampScale, this.stampScale);
        ctx.strokeStyle = C.green;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(0, 0, 22, 0, Math.PI * 2);
        ctx.stroke();
        ctx.fillStyle = C.green;
        ctx.font = "bold 7px sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("ПРОВЕРКА", 0, -2);
        ctx.fillText("СМЕТЧИК", 0, 8);
        ctx.restore();
      } else if (cycle >= 200) {
        this.crmPulse = (cycle - 200) / 40;
        const alpha = 1 - this.crmPulse;
        ctx.globalAlpha = Math.max(0, alpha);
        drawRR(ctx, this.x + 120, this.y + 145, 70, 18, 4, C.green, C.outline);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 8px sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("CRM ✓", this.x + 155, this.y + 157);
        ctx.globalAlpha = 1;
      } else {
        this.stampScale = 0;
        this.crmPulse = 0;
      }
    }
  }

  class PhotoThumbCluster {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(ctx) {
      const cycle = (frame * 0.04) % 240;
      if (cycle < 70 || cycle > 160) return;
      const t = (cycle - 70) / 90;
      const bob = Math.sin(frame * 0.08) * 3;
      drawRR(ctx, this.x, this.y + bob, 28, 22, 3, "#1e293b", C.outline);
      drawRR(ctx, this.x + 4, this.y + 4 + bob, 20, 10, 2, C.teal, null);
      ctx.fillStyle = C.outline;
      ctx.font = "6px sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("фото", this.x + 14, this.y + 18 + bob);
      if (t > 0.4) {
        drawRR(ctx, this.x + 32, this.y - 2 + bob, 36, 10, 2, "rgba(121,242,255,.25)", C.teal);
        ctx.fillStyle = C.teal;
        ctx.font = "bold 6px sans-serif";
        ctx.fillText("демонтаж", this.x + 50, this.y + 5 + bob);
      }
    }
  }

  class CrmDealPin {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(ctx) {
      const cycle = (frame * 0.04) % 240;
      if (cycle < 190) return;
      const pulse = 0.85 + Math.sin(frame * 0.12) * 0.15;
      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.scale(pulse, pulse);
      drawRR(ctx, -18, -12, 36, 24, 5, "#0f172a", C.gold);
      ctx.fillStyle = C.gold;
      ctx.font = "bold 7px sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("DEAL", 0, 2);
      ctx.restore();
    }
  }

  class MeasureFlagMarker {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(ctx) {
      const cycle = (frame * 0.04) % 240;
      if (cycle < 100 || cycle > 175) return;
      ctx.strokeStyle = "#f97316";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(this.x, this.y + 20);
      ctx.lineTo(this.x, this.y - 5);
      ctx.stroke();
      drawRR(ctx, this.x + 2, this.y - 12, 28, 12, 2, "#f97316", C.outline);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 6px sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("ЗАМЕР?", this.x + 6, this.y - 3);
    }
  }

  class Agent {
    constructor(x, y, color, role, stepTrig, dialogs) {
      this.x = x; this.y = y; this.baseX = x; this.baseY = y;
      this.color = color; this.role = role;
      this.timer = Math.random() * 100;
      this.stepTrig = stepTrig;
      this.dialogs = dialogs;
    }
    draw(ctx) {
      this.timer += 0.03;
      const prg = (frame * 0.04) % 240;
      let isMoving = false;
      let faceDir = 1;
      const targetX = 20;
      const targetY = -55 - this.stepTrig * 0.15;

      if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
        const local = prg - this.stepTrig;
        isMoving = true;
        if (local < 11) {
          faceDir = 1;
          this.x = this.baseX + (targetX - this.baseX) * (local / 11);
          this.y = this.baseY + (targetY - this.baseY) * (local / 11);
        } else {
          faceDir = -1;
          const back = (local - 11) / 11;
          this.x = targetX - (targetX - this.baseX) * back;
          this.y = targetY - (targetY - this.baseY) * back;
        }
      } else {
        this.x = this.baseX;
        this.y = this.baseY;
      }

      if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
        const rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
        createBubble(this.x, this.y - 18, rnd, 220);
      }

      const bob = isMoving ? Math.abs(Math.sin(this.timer * 4)) * 2 : Math.sin(this.timer * 1.4);
      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.lineJoin = "round";
      drawRR(ctx, -10, 0, 8, 12, 2, C.outline, null);
      drawRR(ctx, 2, 0, 8, 12, 2, C.outline, null);
      drawRR(ctx, -14, -10 - bob, 28, 18, 5, this.color, C.outline);
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(0, -24 - bob, 10, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 2;
      ctx.stroke();
      ctx.restore();
    }
  }

  const entities = [];
  const bubbles = [];
  entities.push(new BriefPacketCable(-120, -75, 240));
  entities.push(new DraftEstimateBoard(30, -40));
  entities.push(new PhotoThumbCluster(-70, 10));
  entities.push(new MeasureFlagMarker(95, 55));
  entities.push(new CrmDealPin(130, 70));
  entities.push(new Agent(-110, 45, C.agentYellow, "1_intake", 18, ["Заявка с TG", "Тип: квартира", "Принял вводные"]));
  entities.push(new Agent(-55, 70, C.agentGreen, "2_brief", 52, ["Площадь 65 м²", "Срок: 2 мес", "Бюджет уточнён"]));
  entities.push(new Agent(0, 35, C.agentBlue, "3_vision", 88, ["Тег: штукатурка", "Фото: потолок", "Демонтаж вижу"]));
  entities.push(new Agent(55, 65, C.agentPink, "4_estimate", 128, ["38 позиций", "Цена из прайса", "Черновик готов"]));
  entities.push(new Agent(100, 40, C.agentPurple, "5_crm", 168, ["Задача сметчику", "Статус: review", "CRM обновлена"]));

  function createBubble(x, y, text, customLife = 240) {
    bubbles.push({ x, y, text, life: customLife, maxLife: customLife });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    drawRR(ctx, -140, 50, 280, 8, 2, "#1e293b", null);

    entities.sort((a, b) => (a.y || 0) - (b.y || 0));
    entities.forEach((e) => e.draw(ctx));

    const prg = (frame * 0.04) % 240;
    if (prg >= 20 && prg < 20.05) createBubble(-100, -50, "1. Заявка 24/7");
    if (prg >= 58 && prg < 58.05) createBubble(-40, 30, "2. Бриф по скрипту");
    if (prg >= 96 && prg < 96.05) createBubble(10, -10, "3. Теги по фото");
    if (prg >= 136 && prg < 136.05) createBubble(60, 40, "4. Строки сметы");
    if (prg >= 176 && prg < 176.05) createBubble(110, 10, "5. На сметчика");

    ctx.font = "bold 10px Inter, sans-serif";
    ctx.textAlign = "center";
    for (let i = bubbles.length - 1; i >= 0; i--) {
      const bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      let alpha = Math.min(1, bub.life / 25);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      const tw = ctx.measureText(bub.text).width + 14;
      const th = 18;
      const by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bub.x - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.outline;
      ctx.fillText(bub.text, bub.x, by - th / 2);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineLoop);
  }

  document.fonts.ready.then(() => engineLoop());
});
</script>

<script>
(function(){
  document.querySelectorAll('.aspa-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aspa-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aspa-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aspa-faq-q');
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
  var root = document.querySelector('.ai-smeta-po-zayavke-page') || document.querySelector('.aspa-content');
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

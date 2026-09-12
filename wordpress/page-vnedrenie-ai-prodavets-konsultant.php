<?php
/**
 * Template Name: AI-продавец-консультант для розничной сети: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-продавца-консультанта для розницы. Подбор по задаче, бюджету и наличию, передача диалога продавцу. Кейсы, этапы, цены.
 */

$page_seo_title       = 'AI-продавец-консультант для розницы: внедрение под ключ';
$page_seo_description = 'Внедряем AI-продавца-консультанта для розничных сетей: единый подбор товара по задаче, бюджету и наличию. Кейсы, этапы, цены. Сценарий для магазина — бесплатно.';

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
    ['label' => 'Сценарии',     'href' => '#scenarii'],
    ['label' => 'Для кого',     'href' => '#komu-nuzhno'],
    ['label' => 'Внедрение',    'href' => '#vnedrenie'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать продавца';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '';

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
/* Скрыть шапку Kadence — используем nero-ai-floating-header как на главной */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }

/* =====================================================
   VAPC PAGE — GLOBAL RESETS
   ===================================================== */
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

/* =====================================================
   VAPC CONTENT ROOT — dark theme (палитра Артура)
   ===================================================== */
.vapc-content{
  --vapc-bg:#050711;--vapc-bg2:#080b17;--vapc-bg3:#0a0e1c;
  --vapc-surface:rgba(255,255,255,.072);--vapc-surface2:rgba(255,255,255,.108);
  --vapc-text:#e6edf7;--vapc-muted:#9aa8bd;--vapc-soft:#c7d2e5;--vapc-heading:#fff;
  --vapc-border:rgba(255,255,255,.10);--vapc-border-s:rgba(255,255,255,.18);
  --vapc-accent:#79f2ff;--vapc-green:#22c55e;--vapc-violet:#8b5cf6;--vapc-warm:#f59e0b;
  --vapc-btn-from:#2563eb;--vapc-btn-to:#7c3aed;
  --vapc-shadow:0 24px 72px rgba(0,0,0,.4);
  --ym-shadow-sm:0 8px 28px rgba(0,0,0,.25);
  --vapc-r:18px;--vapc-r-lg:24px;--vapc-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vapc-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vapc-content *,.vapc-content *::before,.vapc-content *::after{box-sizing:border-box;}
.vapc-content a{color:inherit;text-decoration:none;}
.vapc-content p{color:var(--vapc-muted);line-height:1.72;margin:0 0 1em;}
.vapc-content p:last-child{margin-bottom:0;}
.vapc-content h2,.vapc-content h3,.vapc-content h4{color:var(--vapc-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.vapc-content strong{color:var(--vapc-soft);}
.vapc-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vapc-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vapc-muted);font-size:14.5px;line-height:1.65;}
.vapc-content ul li::before{content:'›';position:absolute;left:0;color:var(--vapc-accent);font-weight:700;}
.vapc-content ol{padding-left:20px;margin:0 0 1em;color:var(--vapc-muted);}
.vapc-content ol li{margin-bottom:.5em;line-height:1.7;font-size:14.5px;}
.vapc-content .vapc-inline-link,
.vapc-content p a:not(.ym-btn):not(.nero-ai-btn){color:var(--vapc-accent)!important;text-decoration:underline!important;text-underline-offset:3px;}

/* Container / sections */
.vapc-cnt{width:min(var(--vapc-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.vapc-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vapc-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.vapc-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vapc-sh.vapc-left{margin-left:0;text-align:left;}
.vapc-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vapc-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vapc-sh.vapc-left p{margin-left:0;}
.vapc-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vapc-accent);margin-bottom:14px;}
.vapc-eyebrow--warm{background:rgba(245,158,11,.08);border-color:rgba(245,158,11,.26);color:var(--vapc-warm);}
.vapc-eyebrow--violet{background:rgba(139,92,246,.1);border-color:rgba(139,92,246,.28);color:#c4b5fd;}
.vapc-gt{background:linear-gradient(92deg,#fff 0%,var(--vapc-accent) 44%,var(--vapc-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}

/* Intro + KPI */
.vapc-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.vapc-intro-grid{display:grid;grid-template-columns:1fr 360px;gap:56px;align-items:center;}
.vapc-intro-text{position:relative;padding-left:20px;}
.vapc-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vapc-accent),var(--vapc-violet));}
.vapc-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vapc-muted);margin-bottom:1em;}
.vapc-intro-text p:last-child{margin-bottom:0;color:var(--vapc-soft);}
.vapc-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.vapc-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.vapc-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vapc-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.vapc-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vapc-muted);line-height:1.4;}
.vapc-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.vapc-intro-grid{grid-template-columns:1fr;gap:36px;}.vapc-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.vapc-intro-kpi{grid-template-columns:1fr 1fr;}}

/* TOC */
.vapc-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vapc-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.vapc-toc a{display:inline-block;padding:9px 18px;background:var(--vapc-surface);border:1px solid var(--vapc-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vapc-muted);transition:border-color .2s,color .2s,background .2s;}
.vapc-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vapc-accent);background:rgba(121,242,255,.08);}

/* Cards / grids */
.vapc-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vapc-border);border-radius:var(--vapc-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.vapc-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.vapc-card h3{font-size:17px;margin-bottom:8px;}
.vapc-card p{font-size:14.5px;}
.vapc-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vapc-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:960px){.vapc-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:768px){.vapc-grid-2{grid-template-columns:1fr;}}
@media(max-width:600px){.vapc-grid-3{grid-template-columns:1fr;}}

/* Определение — карточка с левой cyan-полосой */
.vapc-def{position:relative;padding:24px 26px 24px 30px;border-radius:var(--vapc-r);background:rgba(121,242,255,.06);border:1px solid rgba(121,242,255,.22);margin:0 0 26px;}
.vapc-def::before{content:'';position:absolute;left:0;top:14px;bottom:14px;width:4px;border-radius:0 3px 3px 0;background:linear-gradient(180deg,var(--vapc-accent),rgba(121,242,255,.2));}
.vapc-def h3{font-size:16px;margin-bottom:8px;color:var(--vapc-accent);letter-spacing:.02em;text-transform:uppercase;font-size:12px;}
.vapc-def p{color:var(--vapc-soft);font-size:15.5px;margin:0;}

/* Боль розницы — warm-карточки */
.vapc-pain{background:rgba(245,158,11,.06);border:1px solid rgba(245,158,11,.2);border-radius:var(--vapc-r);padding:22px 24px;}
.vapc-pain .pt{font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--vapc-warm);margin-bottom:10px;}
.vapc-pain h3{font-size:16px;margin-bottom:8px;}
.vapc-pain p{font-size:14px;margin:0;}

/* Timeline / stepper */
.vapc-timeline{position:relative;padding-left:40px;}
.vapc-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vapc-accent),var(--vapc-violet));opacity:.35;border-radius:2px;}
.vapc-tl-item{position:relative;margin-bottom:30px;}
.vapc-tl-item:last-child{margin-bottom:0;}
.vapc-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vapc-accent);box-shadow:0 0 0 4px rgba(121,242,255,.18);display:grid;place-items:center;font-size:9px;font-weight:900;color:#04212b;}
.vapc-tl-item h3{font-size:17px;margin-bottom:8px;}
.vapc-tl-item p{font-size:14.5px;margin:0;}
.vapc-stepper{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:900px){.vapc-stepper{grid-template-columns:1fr 1fr;}}
@media(max-width:560px){.vapc-stepper{grid-template-columns:1fr;}}
.vapc-step{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--vapc-r);padding:22px 20px;position:relative;}
.vapc-step .sn{display:inline-grid;place-items:center;width:28px;height:28px;border-radius:50%;background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.3);color:var(--vapc-accent);font-size:13px;font-weight:900;margin-bottom:12px;}
.vapc-step h3{font-size:15.5px;margin-bottom:7px;}
.vapc-step p{font-size:13.5px;margin:0;}
.vapc-step .sd{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--vapc-green);margin-top:10px;}

/* Scenario cards */
.vapc-scen-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
@media(max-width:768px){.vapc-scen-grid{grid-template-columns:1fr;}}
.vapc-scen{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--vapc-r);padding:26px;transition:border-color .2s,transform .2s;}
.vapc-scen:hover{border-color:rgba(121,242,255,.3);transform:translateY(-2px);}
.vapc-scen .st{font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--vapc-accent);margin-bottom:10px;}
.vapc-scen h3{font-size:17px;margin-bottom:8px;}
.vapc-scen p{font-size:14.5px;margin:0 0 .6em;}
.vapc-scen p:last-child{margin-bottom:0;}

/* Persona cards */
.vapc-persona{background:linear-gradient(180deg,rgba(255,255,255,.075),rgba(255,255,255,.035));border:1px solid rgba(255,255,255,.1);border-radius:var(--vapc-r-lg);padding:26px;}
.vapc-persona .pi{font-size:26px;margin-bottom:12px;line-height:1;}
.vapc-persona h3{font-size:16.5px;margin-bottom:8px;}
.vapc-persona p{font-size:14px;margin:0 0 .6em;}
.vapc-persona .pf{font-size:12px;color:var(--vapc-accent);font-weight:700;}

/* Callout Gartner */
.vapc-callout{position:relative;border-radius:var(--vapc-r-lg);padding:30px 32px;background:linear-gradient(135deg,rgba(139,92,246,.16),rgba(121,242,255,.07));border:1px solid rgba(139,92,246,.32);box-shadow:0 18px 54px rgba(0,0,0,.3);}
.vapc-callout .cb{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(139,92,246,.2);color:#e9d5ff;font-size:11.5px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:14px;}
.vapc-callout .cn{font-size:clamp(30px,5vw,52px);font-weight:900;line-height:1;letter-spacing:-.05em;color:#fff;margin-bottom:10px;}
.vapc-callout p{font-size:15px;margin:0 0 .7em;}
.vapc-callout p:last-child{margin-bottom:0;}
.vapc-quote{border-left:3px solid var(--vapc-accent);padding:6px 0 6px 18px;margin:18px 0;color:var(--vapc-soft);font-size:15px;font-style:italic;line-height:1.7;}
.vapc-quote cite{display:block;margin-top:8px;font-style:normal;font-size:12.5px;color:var(--vapc-muted);}

/* Tables */
.vapc-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.vapc-table{width:100%;border-collapse:collapse;font-size:14px;}
.vapc-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vapc-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.vapc-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vapc-text);vertical-align:top;}
.vapc-table tr:last-child td{border-bottom:none;}
.vapc-table tr:hover td{background:rgba(255,255,255,.03);}
.vapc-table--split th:first-child{background:rgba(34,197,94,.1);color:#86efac;border-bottom-color:rgba(34,197,94,.25);}

/* Case cards */
.vapc-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vapc-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vapc-case-grid{grid-template-columns:1fr;}}
.vapc-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.vapc-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.vapc-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vapc-green);margin-bottom:10px;}
.vapc-case-card h3{font-size:16px;margin-bottom:12px;}
.vapc-case-card p{font-size:14px;}
.vapc-case-kpi{display:flex;flex-wrap:wrap;gap:8px;margin:14px 0 0;}
.vapc-case-kpi span{padding:5px 11px;border-radius:999px;background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.24);color:#bbf7d0;font-size:12px;font-weight:800;}

/* FAQ */
.vapc-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vapc-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.vapc-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vapc-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.vapc-faq-q::after{content:'▾';font-size:13px;color:var(--vapc-accent);flex-shrink:0;transition:transform .25s;}
.vapc-faq-item.open .vapc-faq-q::after{transform:rotate(180deg);}
.vapc-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vapc-muted);line-height:1.72;}
.vapc-faq-item.open .vapc-faq-a{max-height:700px;padding:0 24px 20px;}

/* CTA-блоки (Артур) */
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--vapc-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;margin-bottom:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vapc-btn-from),var(--vapc-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--vapc-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--vapc-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
@media(prefers-reduced-motion:reduce){
  .nero-ai-reveal{opacity:1;transform:none;transition:none;}
  .vapc-card:hover,.vapc-scen:hover,.vapc-case-card:hover,.ym-btn:hover{transform:none;}
}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-prodavets-konsultant-page" role="main" tabindex="-1">

<style>
/* =====================================================
   HERO «СТЕЛЛАЖНЫЙ АТРИУМ ПОДБОРА» — vapc-hero-retail
   Самодостаточные стили: работают без CSS темы
   ===================================================== */
.vapc-hero-retail{
  --vapc-accent:#79f2ff;
  --vapc-green:#22c55e;
  --vapc-violet:#8b5cf6;
  --vapc-warm:#f59e0b;
  --vapc-bg:#050711;
  --vapc-text:#e6edf7;
  --vapc-soft:#c7d2e5;
  --vapc-muted:#9aa8bd;
  --vapc-shadow:0 28px 90px rgba(0,0,0,.45);
}
.vapc-hero-retail.nero-ai-hero{
  position:relative;
  display:grid;
  align-items:center;
  min-height:min(980px,calc(100dvh - 1px));
  padding:clamp(72px,8vw,116px) 0 clamp(40px,6vw,72px);
  background:
    radial-gradient(ellipse at 16% 6%,rgba(121,242,255,.10),transparent 56%),
    radial-gradient(ellipse at 88% 20%,rgba(139,92,246,.13),transparent 58%),
    linear-gradient(180deg,#050711 0%,#080b17 58%,#050711 100%);
  color:var(--vapc-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
  isolation:isolate;
  overflow:hidden;
}
.vapc-hero-retail *,
.vapc-hero-retail *::before,
.vapc-hero-retail *::after{box-sizing:border-box;}
/* фон: «полочная» сетка зала */
.vapc-hero-retail::before{
  content:"";
  position:absolute;inset:0;
  background-image:
    linear-gradient(rgba(255,255,255,.045) 1px,transparent 1px),
    linear-gradient(90deg,rgba(255,255,255,.028) 1px,transparent 1px);
  background-size:100% 56px,88px 100%;
  mask-image:radial-gradient(ellipse at 62% 34%,#000 0%,transparent 74%);
  -webkit-mask-image:radial-gradient(ellipse at 62% 34%,#000 0%,transparent 74%);
  opacity:.6;
  pointer-events:none;
  z-index:-2;
}
/* фон: световая «витрина» */
.vapc-hero-retail::after{
  content:"";
  position:absolute;
  right:-6%;top:6%;
  width:760px;height:760px;
  border-radius:999px;
  background:radial-gradient(circle,rgba(121,242,255,.13),transparent 66%);
  filter:blur(4px);
  animation:vapcHeroGlow 9s ease-in-out infinite alternate;
  pointer-events:none;
  z-index:-1;
}
@keyframes vapcHeroGlow{
  from{opacity:.42;transform:scale(.95);}
  to{opacity:.82;transform:scale(1.06);}
}
.vapc-hero-retail .nero-ai-container{
  width:min(1220px,calc(100% - 40px));
  margin:0 auto;
  position:relative;
  z-index:1;
}
.vapc-hero-retail .nero-ai-hero-grid{
  display:grid;
  grid-template-columns:minmax(0,1.04fr) minmax(360px,.96fr);
  gap:clamp(28px,4vw,58px);
  align-items:center;
}
/* ── левая колонка: текст ── */
.vapc-hero-retail .nero-ai-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  margin:0 0 16px;padding:8px 13px;
  border:1px solid rgba(121,242,255,.22);
  border-radius:999px;
  background:rgba(121,242,255,.08);
  color:var(--vapc-accent)!important;
  font-size:12.5px;font-weight:750;line-height:1;
  text-transform:uppercase;letter-spacing:.11em;
}
.vapc-hero-retail .nero-ai-hero-copy h1{
  margin:0;max-width:760px;
  font-size:clamp(33px,4.6vw,58px);
  line-height:1;letter-spacing:-.055em;
  font-weight:900;color:#fff;
}
.vapc-hero-retail .nero-ai-gradient-text{
  background:linear-gradient(92deg,#fff 0%,var(--vapc-accent) 46%,#c4b5fd 100%);
  -webkit-background-clip:text;background-clip:text;
  color:transparent!important;
}
.vapc-hero-retail .nero-ai-hero-lead{
  margin:22px 0 0;max-width:660px;
  color:var(--vapc-soft)!important;
  font-size:clamp(16px,1.7vw,19.5px);
  line-height:1.56;
}
.vapc-hero-retail .nero-ai-badges{
  display:flex;flex-wrap:wrap;gap:10px;
  margin:26px 0 0;padding:0;list-style:none;
}
.vapc-hero-retail .nero-ai-badge{
  display:inline-flex;align-items:center;gap:7px;
  padding:8px 12px;
  border:1px solid rgba(255,255,255,.11);
  border-radius:999px;
  background:rgba(255,255,255,.055);
  color:#dce8f7;font-size:13px;font-weight:700;
}
.vapc-hero-retail .nero-ai-badge::before{
  content:"";width:6px;height:6px;border-radius:50%;
  background:var(--vapc-accent);opacity:.8;
}
.vapc-hero-retail .nero-ai-badge:nth-child(3)::before{background:var(--vapc-green);}
.vapc-hero-retail .nero-ai-badge:nth-child(5)::before{background:var(--vapc-violet);}
.vapc-hero-retail .nero-ai-btn-row{
  display:flex;flex-wrap:wrap;align-items:center;gap:14px;
  margin-top:34px;
}
.vapc-hero-retail .nero-ai-btn{
  display:inline-flex;align-items:center;justify-content:center;
  min-height:48px;padding:14px 22px;
  border:1px solid transparent;border-radius:999px;
  font-size:15px;font-weight:800;line-height:1;
  text-decoration:none!important;
  transition:transform .22s ease,border-color .22s ease,background .22s ease;
}
.vapc-hero-retail .nero-ai-btn:hover{transform:translateY(-2px);}
.vapc-hero-retail .nero-ai-btn-primary{
  color:#031018!important;
  background:linear-gradient(135deg,var(--vapc-accent),#a7f3d0);
  box-shadow:0 18px 42px rgba(121,242,255,.22);
}
.vapc-hero-retail .nero-ai-btn-secondary{
  color:var(--vapc-text)!important;
  background:rgba(255,255,255,.07);
  border-color:rgba(255,255,255,.14);
}
.vapc-hero-retail .nero-ai-btn-secondary:hover{border-color:rgba(121,242,255,.4);}
.vapc-hero-retail .vapc-hero-note{
  margin:18px 0 0;
  color:var(--vapc-muted);
  font-size:13px;line-height:1.55;
}
/* ── правая колонка: демо-дашборд ── */
.vapc-hero-retail .nero-ai-dashboard{
  position:relative;padding:18px;
  border-radius:34px;
  background:rgba(2,6,23,.42);
  box-shadow:var(--vapc-shadow);
  transform:perspective(1150px) rotateY(-3deg) rotateX(2deg);
}
.vapc-hero-retail .nero-ai-dashboard-shell{
  overflow:hidden;
  border:1px solid rgba(255,255,255,.12);
  border-radius:26px;
  background:linear-gradient(180deg,rgba(15,23,42,.95),rgba(6,10,24,.96));
}
.vapc-hero-retail .nero-ai-window-top{
  display:flex;align-items:center;justify-content:space-between;gap:14px;
  padding:14px 16px;
  border-bottom:1px solid rgba(255,255,255,.08);
  background:rgba(255,255,255,.045);
}
.vapc-hero-retail .nero-ai-dots{display:flex;gap:7px;}
.vapc-hero-retail .nero-ai-dot{width:10px;height:10px;border-radius:50%;}
.vapc-hero-retail .nero-ai-dot:nth-child(1){background:#fb7185;}
.vapc-hero-retail .nero-ai-dot:nth-child(2){background:#fbbf24;}
.vapc-hero-retail .nero-ai-dot:nth-child(3){background:#34d399;}
.vapc-hero-retail .nero-ai-window-title{
  color:#cfe3f9;font-size:11px;font-weight:750;
  letter-spacing:.08em;text-transform:uppercase;
}
.vapc-hero-retail .nero-ai-window-body{padding:16px;}
.vapc-hero-retail .nero-ai-dashboard-title{
  display:flex;align-items:flex-start;justify-content:space-between;gap:16px;
  margin-bottom:12px;
}
.vapc-hero-retail .nero-ai-dashboard-title h3{
  margin:0;font-size:18px;letter-spacing:-.03em;color:#fff;
}
.vapc-hero-retail .nero-ai-live-pill{
  display:inline-flex;align-items:center;gap:7px;
  padding:6px 10px;border-radius:999px;
  background:rgba(34,197,94,.10);
  color:#bbf7d0;font-size:12px;font-weight:800;white-space:nowrap;
}
.vapc-hero-retail .nero-ai-live-pill::before{
  content:"";width:7px;height:7px;border-radius:50%;
  background:var(--vapc-green);
  box-shadow:0 0 0 6px rgba(34,197,94,.14);
  animation:vapcPulse 1.6s infinite;
}
@keyframes vapcPulse{
  0%,100%{transform:scale(.86);opacity:.65;}
  50%{transform:scale(1);opacity:1;}
}
.vapc-hero-retail .nero-ai-metrics-grid{
  display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:8px;
  margin-bottom:12px;
}
.vapc-hero-retail .nero-ai-metric{
  padding:10px 9px;
  border:1px solid rgba(255,255,255,.09);
  border-radius:14px;
  background:rgba(255,255,255,.055);
}
.vapc-hero-retail .nero-ai-metric span{
  display:block;color:var(--vapc-muted);
  font-size:10.5px;font-weight:700;line-height:1.25;
}
.vapc-hero-retail .nero-ai-metric strong{
  display:block;margin-top:5px;color:#fff;
  font-size:17px;line-height:1;letter-spacing:-.03em;
}
.vapc-hero-retail .nero-ai-metric small{
  display:block;margin-top:4px;color:#9fb0c9;font-size:10px;
}
/* сцена canvas внутри дашборда */
.vapc-hero-retail .vapc-dash-stage{
  position:relative;
  height:clamp(228px,32vw,306px);
  margin:0 0 12px;
  border:1px solid rgba(121,242,255,.15);
  border-radius:18px;
  overflow:hidden;
  background:
    radial-gradient(ellipse at 56% 34%,rgba(121,242,255,.09),transparent 62%),
    linear-gradient(180deg,rgba(10,15,32,.92),rgba(5,8,20,.96));
}
.vapc-hero-retail #vapc-shelf-advisor-canvas{
  position:absolute;inset:0;
  display:block;width:100%;height:100%;
}
.vapc-hero-retail .vapc-stage-legend{
  position:absolute;left:10px;bottom:9px;
  display:flex;flex-wrap:wrap;gap:8px;
  font-size:9.5px;font-weight:700;letter-spacing:.04em;
  color:var(--vapc-muted);
  pointer-events:none;
}
.vapc-hero-retail .vapc-stage-legend i{
  display:inline-flex;align-items:center;gap:5px;font-style:normal;
}
.vapc-hero-retail .vapc-stage-legend i::before{
  content:"";width:7px;height:7px;border-radius:3px;background:var(--vapc-accent);
}
.vapc-hero-retail .vapc-stage-legend i:nth-child(2)::before{background:var(--vapc-green);}
.vapc-hero-retail .vapc-stage-legend i:nth-child(3)::before{background:var(--vapc-warm);}
/* лента задач */
.vapc-hero-retail .nero-ai-task-stream{display:grid;gap:8px;}
.vapc-hero-retail .nero-ai-task{
  display:grid;grid-template-columns:30px 1fr auto;
  align-items:center;gap:10px;padding:10px;
  border:1px solid rgba(255,255,255,.08);
  border-radius:14px;
  background:rgba(255,255,255,.04);
}
.vapc-hero-retail .nero-ai-task-icon{
  display:grid;place-items:center;
  width:30px;height:30px;border-radius:12px;
  background:rgba(121,242,255,.12);
  color:var(--vapc-accent);
  font-size:12px;font-weight:800;
}
.vapc-hero-retail .nero-ai-task strong{display:block;color:#f8fafc;font-size:12px;}
.vapc-hero-retail .nero-ai-task span{color:var(--vapc-muted);font-size:11px;}
.vapc-hero-retail .nero-ai-status{
  padding:4px 9px;border-radius:999px;
  background:rgba(34,197,94,.11);
  color:#bbf7d0;font-size:10px;font-weight:800;white-space:nowrap;
}
.vapc-hero-retail .nero-ai-status--cyan{background:rgba(121,242,255,.12);color:#a5f3fc;}
.vapc-hero-retail .nero-ai-status--amber{background:rgba(245,158,11,.12);color:#fde68a;}
.vapc-hero-retail .nero-ai-status--violet{background:rgba(139,92,246,.16);color:#ddd6fe;}
/* ── адаптив ── */
@media (max-width:1100px){
  .vapc-hero-retail .nero-ai-hero-grid{grid-template-columns:1fr;}
  .vapc-hero-retail .nero-ai-dashboard{transform:none;}
}
@media (max-width:640px){
  .vapc-hero-retail .nero-ai-metrics-grid{grid-template-columns:repeat(2,minmax(0,1fr));}
  .vapc-hero-retail .nero-ai-dashboard{padding:10px;border-radius:24px;}
  .vapc-hero-retail .nero-ai-window-body{padding:12px;}
  .vapc-hero-retail .nero-ai-task{grid-template-columns:30px 1fr;}
  .vapc-hero-retail .nero-ai-status{grid-column:2;width:fit-content;}
  .vapc-hero-retail .vapc-stage-legend{display:none;}
}
@media (prefers-reduced-motion:reduce){
  .vapc-hero-retail::after{animation:none;}
  .vapc-hero-retail .nero-ai-live-pill::before{animation:none;}
}
</style>

<section class="nero-ai-hero vapc-hero-retail" id="vapc-hero-retail" aria-labelledby="vapc-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">

    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai розница</p>
      <h1 id="vapc-hero-title">AI-продавец-консультант для розничной сети: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Единый AI-консультант для продавцов и клиентов — подбор товара по задаче, бюджету и наличию, с передачей «горячего» диалога живому продавцу.</p>
      <ul class="nero-ai-badges" aria-label="Что делает AI-продавец-консультант">
        <li class="nero-ai-badge">Подбор по задаче</li>
        <li class="nero-ai-badge">Фильтр по бюджету</li>
        <li class="nero-ai-badge">Наличие live</li>
        <li class="nero-ai-badge">Кросс-sell</li>
        <li class="nero-ai-badge">Gartner 2026</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Собрать продавца</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
      <p class="vapc-hero-note">Бесплатно на аудите — документ «Сценарий AI-консультанта для магазина» (5–7 ветвей диалога). Ориентир бюджета внедрения — 250 тыс.–1 млн ₽.</p>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация подбора товара AI-консультантом">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">retail · AI-консультант · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Подбор по задаче и наличию</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>

          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Время ответа</span>
              <strong>2–3 сек</strong>
              <small>первый ответ</small>
            </div>
            <div class="nero-ai-metric">
              <span>Варианты</span>
              <strong>3 SKU</strong>
              <small>с обоснованием</small>
            </div>
            <div class="nero-ai-metric">
              <span>Наличие</span>
              <strong>live</strong>
              <small>по точке</small>
            </div>
            <div class="nero-ai-metric">
              <span>Эскалация</span>
              <strong>&lt;20%</strong>
              <small>диалогов</small>
            </div>
          </div>

          <div class="vapc-dash-stage">
            <canvas id="vapc-shelf-advisor-canvas" role="img" aria-label="Анимация: стеллаж торгового зала — AI-консультант отсекает позиции по бюджету и остаткам, собирает комплект из 3 SKU и передаёт подбор продавцу"></canvas>
            <div class="vapc-stage-legend" aria-hidden="true">
              <i>подходит</i><i>в наличии</i><i>нет на точке</i>
            </div>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента диалога AI-консультанта">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">?</span>
              <div><strong>Запрос клиента</strong><span>«плитка в ванную, бюджет до 60 тыс»</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">задача</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">₽</span>
              <div><strong>Уточнение бюджета</strong><span>2 вопроса вместо анкеты на 15 полей</span></div>
              <span class="nero-ai-status">принято</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">1С</span>
              <div><strong>Каталог + остатки</strong><span>1 позиция выпала — нет на этой точке</span></div>
              <span class="nero-ai-status nero-ai-status--amber">замена</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">3</span>
              <div><strong>Рекомендация</strong><span>3 SKU + клей, затирка, грунт</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">→</span>
              <div><strong>Передача продавцу</strong><span>резюме диалога и подбор в CRM</span></div>
              <span class="nero-ai-status nero-ai-status--violet">handoff</span>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>

<div class="vapc-content">

  <section class="vapc-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vapc-cnt">
      <div class="vapc-intro-grid nero-ai-reveal">
        <div class="vapc-intro-text">
          <p class="vapc-eyebrow">Лонгрид · ai продавец консультант</p>
          <p><strong>Коротко:</strong> AI-продавец-консультант — это task-specific AI-агент, который ведёт консультацию вместо разрозненных ответов продавцов: уточняет задачу клиента, фильтрует товар по бюджету и наличию в конкретной точке, предлагает сопутствующие позиции и передаёт «горячий» диалог живому продавцу с полным контекстом.</p>
          <p><?php echo esc_html($brand); ?> собирает и интегрирует такое решение под ключ: от аудита каталога до пилота на одной точке и масштабирования на сеть. Ориентир бюджета — <strong>250 тыс.–1 млн ₽</strong> в зависимости от количества каналов и глубины интеграции.</p>
        </div>
        <div class="vapc-intro-kpi" aria-label="Ключевые метрики рынка">
          <div class="vapc-kpi-card"><div class="kv">67% / &lt;10%</div><div class="kl">GenAI в e-com против ритейла</div><div class="ks">Яков и Партнёры</div></div>
          <div class="vapc-kpi-card"><div class="kv">40%</div><div class="kl">приложений с task-specific агентами</div><div class="ks">Gartner, к 2026</div></div>
          <div class="vapc-kpi-card"><div class="kv">+9,8%</div><div class="kl">конверсия в A/B-тесте</div><div class="ks">Askona, 2026</div></div>
          <div class="vapc-kpi-card"><div class="kv">2–3 сек</div><div class="kl">целевое время ответа</div><div class="ks">кейс Plitonit</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <div class="vapc-toc-outer">
    <div class="vapc-cnt">
      <nav class="vapc-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что это</a>
        <a href="#problema">Проблема</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#komu-nuzhno">Для кого</a>
        <a href="#trend-2026">Тренд 2026</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#etapy">Этапы</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Собрать продавца</a>
      </nav>
    </div>
  </div>

  <section class="vapc-section" id="chto-takoe">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <span class="vapc-eyebrow">Основа</span>
        <h2>Что такое AI-продавец-консультант и зачем он розничной сети</h2>
        <p>Он не «отвечает на вопросы вообще», а ведёт структурированный диалог по логике продавца: задача → параметры → варианты → наличие → оформление или эскалация.</p>
      </div>

      <div class="vapc-def nero-ai-reveal">
        <h3>Определение</h3>
        <p>AI-продавец-консультант — это специализированный AI-агент под задачу продаж и консультации, встроенный в retail-процесс: сайт, мобильное приложение, мессенджеры, планшет или киоск на точке, CRM и каталог с остатками. Ключевое отличие от привычной автоматизации: он работает с <strong>двумя пользователями на одном «мозге»</strong> — клиент получает быстрый подбор в digital-канале, продавец на полу получает подсказку по ассортименту, совместимости и остаткам.</p>
      </div>

      <div class="vapc-card nero-ai-reveal" style="margin-bottom:26px;">
        <p>База знаний, каталог и правила — общие, поэтому ответ в шоуруме на Ленинском и в чате на сайте перестаёт зависеть от того, кто именно вышел в смену. Это и есть разница между «ещё одним чат-ботом» и системой, которая влияет на выручку.</p>
      </div>

      <h3 style="font-size:clamp(19px,2.4vw,26px);margin:36px 0 16px;">Чем AI-консультант отличается от чат-бота и скрипта продаж</h3>
      <p style="max-width:900px;">Классический чат-бот на сайте построен на дереве кнопок и FAQ: он знает про доставку и график работы, но не умеет подобрать товар. Скрипт продаж — это документ, который каждый продавец применяет по-своему. Нейросеть-продавец без интеграций — это ещё хуже: она уверенно рекомендует то, чего нет в наличии, и придумывает характеристики.</p>

      <div class="vapc-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="vapc-card">
          <h3>RAG по проверенным карточкам</h3>
          <p>Модель отвечает про характеристики только на основе верифицированного каталога и регламентов, а не «из головы». Это базовая защита от галлюцинаций в рекомендациях.</p>
        </div>
        <div class="vapc-card nero-ai-delay-1">
          <h3>Живой каталог и остатки</h3>
          <p>Подбор фильтруется по цене и фактическому наличию в конкретном магазине или на складе. Рекомендация товара, которого нет, — это отрицательная конверсия.</p>
        </div>
        <div class="vapc-card">
          <h3>Порог уверенности</h3>
          <p>Если модель не уверена, диалог уходит человеку. В кейсе М.Видео-Эльдорадо с AutoFAQ порог выставлен на уровне 80% — ниже него вопрос эскалируется (<a href="https://autofaq.ai/case/mvideo-eldorado" target="_blank" rel="noopener noreferrer">autofaq.ai</a>).</p>
        </div>
        <div class="vapc-card nero-ai-delay-1">
          <h3>Аналитика спроса</h3>
          <p>Система фиксирует, что спрашивали и чего в ассортименте не хватает, — это готовые данные для закупок и мерчандайзинга, а не только для поддержки.</p>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:26px;max-width:900px;"><strong>Итог блока:</strong> «ещё один чат-бот» решает задачу поддержки. AI-продавец-консультант решает задачу выручки: конверсия консультации, средний чек, скорость первого ответа.</p>

      <h3 style="font-size:clamp(19px,2.4vw,26px);margin:36px 0 16px;">Единый стандарт консультации для всех точек сети</h3>
      <p style="max-width:900px;">В сети из 10, 50 или 300 точек качество консультации — это распределение, а не константа. Один продавец знает линейку наизусть, второй работает третью неделю. Обучение помогает, но текучка обнуляет его: в DIY-сегменте, по данным кейса Molver и бренда Plitonit, текучка персонала доходит до 98% в год (<a href="https://www.retail.ru/cases/ai-konsultant-dlya-riteyla-zachem-brendu-govoryashchiy-kiosk-v-tochkakh-prodazh/" target="_blank" rel="noopener noreferrer">retail.ru</a>).</p>
      <p style="max-width:900px;">AI-консультант превращает знание из «свойства сотрудника» в «свойство системы». Обновили линейку — обновили базу знаний, и стандарт консультации поменялся одновременно на всех точках, во всех каналах и у всех франчайзи.</p>
    </div>
  </section>

  <section class="vapc-section vapc-section-alt" id="problema">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <span class="vapc-eyebrow vapc-eyebrow--warm">Боль</span>
        <h2>Проблема розницы: когда продавцы консультируют по-разному</h2>
        <p>Боль формулируется почти дословно одинаково: продавцы консультируют по-разному, клиент не получает быстрый ответ. Дальше это разворачивается в три конкретных потери.</p>
      </div>

      <div class="vapc-grid-3 nero-ai-reveal">
        <div class="vapc-pain">
          <div class="pt">Потеря 1</div>
          <h3>Долгий подбор товара</h3>
          <p>Клиент приходит с задачей, а не с артикулом: «положить плитку в ванной», «матрас для двоих», «ноутбук под монтаж до 120 тысяч». Каждая минута поиска в терминале и звонков коллегам — риск отказа.</p>
        </div>
        <div class="vapc-pain">
          <div class="pt">Потеря 2</div>
          <h3>Разрыв между каналами</h3>
          <p>На сайте товар в наличии, в шоуруме говорят обратное; в Telegram отвечают по одному скрипту, на точке — по другому. Клиент видит не сеть, а набор независимых лавок под одной вывеской.</p>
        </div>
        <div class="vapc-pain">
          <div class="pt">Потеря 3</div>
          <h3>Кросс-продажи, которых не было</h3>
          <p>Когда продавец с трудом закрывает основной запрос, до сопутствующих товаров он не доходит. Комплект материалов, аксессуар, расходник, продлённая гарантия остаются в каталоге.</p>
        </div>
      </div>

      <div class="vapc-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:19px;">Новая планка ожиданий — 2–3 секунды</h3>
        <p>В кейсе AI-киоска Plitonit целевое время ответа выставлено на 2–3 секунды (<a href="https://www.retail.ru/cases/ai-konsultant-dlya-riteyla-zachem-brendu-govoryashchiy-kiosk-v-tochkakh-prodazh/" target="_blank" rel="noopener noreferrer">retail.ru</a>). Покупатель уже привык к такой скорости в маркетплейсах и в AI-чатах и переносит это ожидание в магазин.</p>
        <p>Показательно, насколько retail отстаёт от e-commerce. По исследованию «Яков и Партнёры» и Яндекса, GenAI используют около 67% e-commerce-компаний против менее 10% в ритейле; при этом ритейлеры вкладывают в AI до 2% digital-бюджета, а e-com — 3–5% (<a href="https://yakovpartners.ru/publications/e-commerce-companies-lead-the-way-in-ai-adoption/" target="_blank" rel="noopener noreferrer">yakovpartners.ru</a>). Разрыв в зрелости — это одновременно и разрыв в скорости ответа клиенту.</p>
        <p style="margin-bottom:0;"><strong>Коротко о цене проблемы:</strong> неоднородная консультация бьёт по трём метрикам сразу — конверсия визита, средний чек и повторные покупки. Ни одна из них не восстанавливается наймом ещё одного тренера по продукту.</p>
      </div>
    </div>
  </section>

  <section class="vapc-section" id="kak-rabotaet">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <span class="vapc-eyebrow">Механика</span>
        <h2>Как работает AI-консультант в магазине и онлайн</h2>
        <p>Шесть шагов, одинаковых для digital-канала и для точки продаж.</p>
      </div>

      <div class="vapc-card nero-ai-reveal">
        <div class="vapc-timeline">
          <div class="vapc-tl-item"><div class="vapc-tl-dot">1</div><h3>Формулировка задачи</h3><p>Клиент или продавец описывает задачу свободным текстом либо голосом: «нужен диван до 80 тысяч, доставка завтра», «какой клей подойдёт к этой плитке».</p></div>
          <div class="vapc-tl-item"><div class="vapc-tl-dot">2</div><h3>Уточнение параметров</h3><p>Агент задаёт минимально необходимые вопросы: бюджет, срок, ограничения, предпочтения. Не анкета на 15 полей, а 2–4 вопроса, как у живого консультанта.</p></div>
          <div class="vapc-tl-item"><div class="vapc-tl-dot">3</div><h3>Запрос к каталогу</h3><p>Система обращается к каталогу, остаткам и акциям через API, выгрузку или коннектор: 1С, МойСклад, Bitrix, amoCRM, e-com API, CSV.</p></div>
          <div class="vapc-tl-item"><div class="vapc-tl-dot">4</div><h3>Формирование вариантов</h3><p>Агент выдаёт 2–3 варианта с обоснованием — почему именно это подходит под задачу и бюджет — и добавляет сопутствующие позиции.</p></div>
          <div class="vapc-tl-item"><div class="vapc-tl-dot">5</div><h3>Самообслуживание или эскалация</h3><p>При высокой уверенности клиент доводит покупку сам; при низкой — диалог передаётся живому продавцу вместе с резюме и историей в CRM.</p></div>
          <div class="vapc-tl-item"><div class="vapc-tl-dot">6</div><h3>Аналитика</h3><p>После сделки система показывает, что спрашивали, где агент ошибся, где он конвертировал. Это вход для доработки сценариев и для закупок.</p></div>
        </div>
      </div>

      <h3 style="font-size:clamp(19px,2.4vw,26px);margin:36px 0 16px;">Подбор по задаче, бюджету и наличию</h3>
      <p style="max-width:900px;">Три фильтра — задача, бюджет, наличие — это ядро всей механики. Именно их не закрывают типовые «AI-продавцы» для мессенджеров: они хорошо квалифицируют лида и отрабатывают возражения, но не знают, что лежит на полке в конкретном магазине. Наличие критично не только для офлайна: рекомендация товара, которого нет, разрушает доверие ко всей выдаче агента.</p>

      <h3 style="font-size:clamp(19px,2.4vw,26px);margin:36px 0 16px;">Помощь продавцу на полу и клиенту в digital-каналах</h3>
      <p style="max-width:900px;">Двухконтурная архитектура «AI для продавца + AI для клиента» на одной базе знаний уже проверена в крупной рознице. М.Видео-Эльдорадо запустила внутреннего AI-ассистента для более чем 19 тысяч сотрудников в 1200+ магазинах: около 65% еженедельных вопросов персонала закрываются автоматически (<a href="https://autofaq.ai/case/mvideo-eldorado" target="_blank" rel="noopener noreferrer">autofaq.ai</a>). Параллельно для клиентов работает голосовой виртуальный консультант от VS Robotics, который распознаёт 2000 категорий и 3350 брендов, а магазин определяет с точностью 99% (<a href="https://logistics.ru/riteyl/mvideo-eldorado-vnedrila-virtualnogo-konsultanta-ot-vs-robotics" target="_blank" rel="noopener noreferrer">logistics.ru</a>).</p>
      <p style="max-width:900px;">Тот же путь заложен в дорожную карту сети «Подружка»: команда «ДАР» (КОРУС Консалтинг) собрала ИИ-помощника по подбору косметики в Telegram, а следующими шагами заявлены сайт, приложение и <strong>инструмент для консультантов в офлайн-магазинах</strong> (<a href="https://data.korusconsulting.ru/press-center/news/dar-sozdal-ii-pomoshchnika-dlya-roznichnoy-seti-podruzhka/" target="_blank" rel="noopener noreferrer">data.korusconsulting.ru</a>).</p>

      <h3 style="font-size:clamp(19px,2.4vw,26px);margin:36px 0 16px;">Связка с каталогом и учётом остатков</h3>
      <p style="max-width:900px;">Технически AI-консультант — это несколько модулей, и большая часть проектной работы приходится не на «нейросеть», а на данные:</p>
      <div class="vapc-grid-2 nero-ai-reveal" style="margin-top:18px;">
        <div class="vapc-card">
          <h3>Контур диалога</h3>
          <ul>
            <li><strong>диалоговый движок</strong> — LLM + RAG по карточкам товаров, регламентам и FAQ;</li>
            <li><strong>recommendation engine</strong> — перевод задачи в набор SKU с фильтром по бюджету;</li>
            <li><strong>moderation &amp; guardrails</strong> — запрещённые формулировки, проверка фактов по карточке, kill switch.</li>
          </ul>
        </div>
        <div class="vapc-card nero-ai-delay-1">
          <h3>Контур данных и интерфейсов</h3>
          <ul>
            <li><strong>catalog &amp; stock connector</strong> — цены, остатки, привязка к магазину или складу;</li>
            <li><strong>seller copilot</strong> — интерфейс для персонала: планшет, Telegram, веб-панель;</li>
            <li><strong>customer front</strong> — виджет сайта, SDK приложения, опционально киоск;</li>
            <li><strong>analytics dashboard</strong> — конверсия, доля эскалаций, топ-запросов без ответа.</li>
          </ul>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;max-width:900px;"><strong>Итог блока:</strong> качество AI-продавца на 70% определяется качеством каталога и базы знаний и только на 30% — выбором модели.</p>

      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>

  <section class="vapc-section vapc-section-alt" id="scenarii">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <span class="vapc-eyebrow">Сценарии</span>
        <h2>Сценарии AI-продавца для розничной сети</h2>
        <p>Рабочие сценарии, которые мы закладываем в проект. Они же входят в лид-магнит «Сценарий AI-консультанта для магазина».</p>
      </div>

      <div class="vapc-scen-grid nero-ai-reveal">
        <div class="vapc-scen">
          <div class="st">Офлайн-точка</div>
          <h3>Консультация в шоуруме и на торговой точке</h3>
          <p>Продавец открывает планшет, вводит запрос клиента и получает готовый ответ с обоснованием и наличием. Второй вариант — киоск или экран, который сам вступает в диалог.</p>
          <p>В кейсе Plitonit говорящий киоск с камерой и микрофоном уточняет задачу, подбирает клей, затирку и штукатурку, ведёт клиента к нужной полке и помогает оплатить — с интеграцией эквайринга, ККТ и программы лояльности (<a href="https://www.retail.ru/cases/ai-konsultant-dlya-riteyla-zachem-brendu-govoryashchiy-kiosk-v-tochkakh-prodazh/" target="_blank" rel="noopener noreferrer">retail.ru</a>).</p>
        </div>
        <div class="vapc-scen nero-ai-delay-1">
          <div class="st">Digital</div>
          <h3>Подбор на сайте и в мобильном приложении</h3>
          <p>Вместо фильтров по 20 параметрам — диалог. Askona вместе с Imshop.io запустила диалогового ИИ-консультанта в мобильном приложении: подбор товаров для сна и дома, статус заказа, бонусы, «айсбрейкеры» в момент сомнения клиента (<a href="https://www.retail.ru/rbc/pressreleases/askona-pobedila-v-konkurse-keysov-new-retail-s-proektom-ii-konsultanta/" target="_blank" rel="noopener noreferrer">retail.ru</a>).</p>
        </div>
        <div class="vapc-scen">
          <div class="st">Средний чек</div>
          <h3>Кросс-продажи и допродажи по контексту запроса</h3>
          <p>Агент видит задачу целиком, поэтому предлагает комплект, а не случайный товар «с вами также покупали». Плитка → клей, затирка, крестики, грунтовка. Матрас → основание, наматрасник, подушки. Ноутбук → память, охлаждение, сумка, гарантия.</p>
        </div>
        <div class="vapc-scen nero-ai-delay-1">
          <div class="st">Франшиза</div>
          <h3>Один стандарт для всех дилеров</h3>
          <p>Для франшизы AI-консультант — это инструмент контроля качества. Управляющая компания задаёт базу знаний и правила, франчайзи получают их автоматически. Не нужно верить на слово, что на точке в другом городе консультируют по стандарту: логи диалогов показывают фактическую картину.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="vnedrenie-ai-prodavets-konsultant-boris-block" class="bapc-root" aria-label="Анимация: запросы из четырёх каналов проходят AI-консультанта, порог уверенности 80% и уходят в готовый ответ или живому продавцу">
<style>
/* === БОРИС: prefix bapc-, scoped внутри #vnedrenie-ai-prodavets-konsultant-boris-block ===
   Режим: КОНТРАСТ к hero Алины. У Алины — тёмный зал и пространство товара
   (стеллаж 15 SKU → 3). Здесь — светлая схема маршрута самого диалога:
   4 канала → один консультант → порог уверенности → ответ или продавец. */
#vnedrenie-ai-prodavets-konsultant-boris-block.bapc-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-card{
  display:grid;
  grid-template-columns:minmax(0,40%) minmax(0,60%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-ai-prodavets-konsultant-boris-block .bapc-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-prodavets-konsultant-boris-block .bapc-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-ey{
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
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0891b2;
  border-radius:1px;
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 16px;
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-lead{
  font-size:14.5px;
  line-height:1.62;
  color:#475569;
  margin:0 0 18px;
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(8,145,178,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0e7490;
  margin-top:1px;
  font-style:normal;
  font-weight:700;
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-pl-g{
  background:rgba(22,163,74,.08);
  color:#15803d;
  border:1.5px solid rgba(22,163,74,.22);
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-pl-b{
  background:rgba(8,145,178,.08);
  color:#0e7490;
  border:1.5px solid rgba(8,145,178,.22);
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-pl-v{
  background:rgba(124,58,237,.08);
  color:#6d28d9;
  border:1.5px solid rgba(124,58,237,.22);
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-prodavets-konsultant-boris-block .bapc-rgt{
  position:relative;
  background:linear-gradient(135deg,#f0f9ff 0%,#ecfeff 30%,#faf5ff 72%,#f8fafc 100%);
  min-height:460px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-prodavets-konsultant-boris-block .bapc-rgt{min-height:390px;}
}
@media(max-width:560px){
  #vnedrenie-ai-prodavets-konsultant-boris-block .bapc-rgt{min-height:320px;}
}
#bapc-dialog-router-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bapc-cnt">
  <div class="bapc-card">

    <div class="bapc-lft">
      <span class="bapc-ey">Маршрут диалога</span>
      <h3 class="bapc-h3">Четыре канала, один консультант и порог уверенности 80%</h3>
      <p class="bapc-lead">Сценарии выше выглядят как разные продукты: киоск в зале, приложение, Telegram, планшет продавца. Внутри это один агент и один маршрут — меняется только окно, в котором пришёл запрос.</p>
      <ul class="bapc-ul">
        <li><span class="bapc-ic">1</span>Запрос приходит из сайта, мессенджера, киоска или планшета продавца — в одну очередь</li>
        <li><span class="bapc-ic">2</span>Агент проверяет три условия: задача, бюджет, наличие в конкретной точке</li>
        <li><span class="bapc-ic">3</span>Ответ собирается только из карточек, регламентов и остатков — не «из головы» модели</li>
        <li><span class="bapc-ic">?</span>Уверенность ниже 80% — диалог уходит продавцу с резюме, а не клиенту наугад</li>
      </ul>
      <div class="bapc-pills">
        <span class="bapc-pl bapc-pl-b">2–3 сек ответ</span>
        <span class="bapc-pl bapc-pl-g">3 SKU + кросс-sell</span>
        <span class="bapc-pl bapc-pl-v">&lt;20% эскалаций</span>
      </div>
      <p class="bapc-foot">Дальше — кому это окупается и что входит во внедрение под ключ →</p>
    </div>

    <div class="bapc-rgt">
      <canvas
        id="bapc-dialog-router-canvas"
        role="img"
        aria-label="Схема-анимация: запросы из четырёх каналов сходятся в одного AI-консультанта, проходят проверку задачи, бюджета и наличия по каталогу и остаткам, затем шкалу уверенности — ответы выше 80% уходят клиенту готовым подбором, ниже 80% передаются живому продавцу"
      ></canvas>
    </div>

  </div>
</div>

<script>
/**
 * bapc-dialog-router — блок Бориса, «Маршрутизатор диалога».
 * Контраст к hero Алины: там тёмный торговый зал и сужение ассортимента,
 * здесь светлая схема маршрута запроса через один агент к двум выходам.
 * Объекты: ChannelStack, RequestPill, IntentRouter, KnowledgeCore,
 * ConfidenceGate, AnswerCard, SellerQueue, MetricRail.
 */
(function () {
  'use strict';

  function boot() {
    var cv = document.getElementById('bapc-dialog-router-canvas');
    if (!cv || !cv.getContext) return;
    var ctx = cv.getContext('2d');

    var VW = 680, VH = 470;
    var W = 0, H = 0, frame = 0;
    var reduced = !!(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);

    function resize() {
      var box = cv.parentElement;
      if (!box) return;
      /* backing store с учётом DPR — иначе мелкие подписи схемы мылят на retina */
      var dpr = Math.min(2.5, window.devicePixelRatio || 1);
      cv.width = Math.round((box.clientWidth || 660) * dpr);
      cv.height = Math.round((box.clientHeight || 460) * dpr);
      W = cv.width;
      H = cv.height;
    }

    var C = {
      ink: '#0f172a',
      body: '#334155',
      muted: '#64748b',
      hair: '#cbd5e1',
      plate: '#ffffff',
      plateAlt: '#f1f5f9',
      cyan: '#0891b2',
      cyanSoft: 'rgba(8,145,178,.12)',
      blue: '#2563eb',
      amber: '#d97706',
      violet: '#7c3aed',
      green: '#16a34a',
      greenSoft: 'rgba(22,163,74,.12)',
      violetSoft: 'rgba(124,58,237,.12)'
    };

    function rr(x, y, w, h, r, fill, stroke, lw) {
      ctx.beginPath();
      if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
      else ctx.rect(x, y, w, h);
      if (fill) { ctx.fillStyle = fill; ctx.fill(); }
      if (stroke) { ctx.lineWidth = lw || 1.2; ctx.strokeStyle = stroke; ctx.stroke(); }
    }
    function txt(text, x, y, color, size, align, weight) {
      ctx.fillStyle = color;
      ctx.font = (weight || 700) + ' ' + (size || 9) + 'px Inter,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif';
      ctx.textAlign = align || 'left';
      ctx.textBaseline = 'alphabetic';
      ctx.fillText(text, x, y);
    }

    /* ── ChannelStack: четыре окна, из которых приходит один и тот же запрос ── */
    var CHANNELS = [
      { name: 'сайт',     hint: 'виджет',   color: C.cyan,   y: 98 },
      { name: 'telegram', hint: 'бот',      color: C.blue,   y: 154 },
      { name: 'киоск',    hint: 'в зале',   color: C.amber,  y: 210 },
      { name: 'планшет',  hint: 'продавец', color: C.violet, y: 266 }
    ];

    /* Реплики: конкретные retail-запросы, не абстрактные «заявки» */
    var REQUESTS = [
      { ch: 0, text: 'плитка в ванную',  conf: 93 },
      { ch: 1, text: 'матрас для двоих', conf: 88 },
      { ch: 2, text: 'клей к плитке',    conf: 96 },
      { ch: 3, text: 'есть на точке?',   conf: 91 },
      { ch: 0, text: 'рассрочка, кухня', conf: 62 },
      { ch: 1, text: 'ноутбук, монтаж',  conf: 86 },
      { ch: 3, text: 'замена, гарантия', conf: 57 },
      { ch: 2, text: 'что в комплекте',  conf: 90 }
    ];

    var LIFE = 312, SPAWN = 104;
    var pills = [];
    var seq = 0;
    var done = 0, escalated = 0;
    var gauge = 92, gaugeShown = 92;

    function spawn() {
      var src = REQUESTS[seq % REQUESTS.length];
      seq++;
      pills.push({ ch: src.ch, text: src.text, conf: src.conf, t: 0, counted: false });
    }

    /* фазы одного запроса: канал → сведение → проверки → шлюз → выход */
    var SLOT_Y = 133, GATE_X = 484, GATE_Y = 190, OUT_X = 598;
    function pillPos(p) {
      var t = p.t, laneY = CHANNELS[p.ch].y, x, y, alpha = 1;
      if (t < 0.30) {
        x = 128 + (216 - 128) * (t / 0.30);
        y = laneY;
        alpha = Math.min(1, t / 0.05);
      } else if (t < 0.40) {
        var k = (t - 0.30) / 0.10;
        var e = k * k * (3 - 2 * k);
        x = 216 + (355 - 216) * e;
        y = laneY + (SLOT_Y - laneY) * e;
      } else if (t < 0.62) {
        x = 355; y = SLOT_Y;
      } else if (t < 0.76) {
        var k2 = (t - 0.62) / 0.14;
        x = 355 + (GATE_X - 355) * k2;
        y = SLOT_Y + (GATE_Y - SLOT_Y) * (k2 * k2);
      } else {
        var k3 = (t - 0.76) / 0.24;
        var outY = p.conf >= 80 ? 156 : 272;
        x = GATE_X + (OUT_X - GATE_X) * k3;
        y = GATE_Y + (outY - GATE_Y) * Math.min(1, k3 * 1.25);
        if (k3 > 0.86) alpha = Math.max(0, 1 - (k3 - 0.86) / 0.14);
      }
      return { x: x, y: y, alpha: alpha };
    }
    function phaseOf(p) {
      if (p.t < 0.30) return 'lane';
      if (p.t < 0.40) return 'merge';
      if (p.t < 0.62) return 'check';
      if (p.t < 0.76) return 'gate';
      return 'out';
    }

    /* ── ChannelStack ── */
    function drawChannels() {
      txt('КАНАЛЫ', 24, 66, C.muted, 9.5, 'left', 800);
      for (var i = 0; i < CHANNELS.length; i++) {
        var c = CHANNELS[i];
        rr(22, c.y - 17, 100, 34, 9, C.plate, 'rgba(148,163,184,.45)', 1.1);
        rr(30, c.y - 5, 9, 9, 2.5, c.color, null);
        txt(c.name, 46, c.y - 1, C.ink, 10.5, 'left', 800);
        txt(c.hint, 46, c.y + 10, C.muted, 8.5, 'left', 600);

        /* трек канала: пунктир, который сам едет к консультанту */
        ctx.save();
        ctx.strokeStyle = 'rgba(148,163,184,.55)';
        ctx.lineWidth = 1;
        ctx.setLineDash([4, 5]);
        ctx.lineDashOffset = -frame * 0.6;
        ctx.beginPath();
        ctx.moveTo(126, c.y);
        ctx.lineTo(266, c.y);
        ctx.stroke();
        ctx.restore();
      }
      /* сведение четырёх треков в одну точку входа */
      ctx.save();
      ctx.strokeStyle = 'rgba(8,145,178,.32)';
      ctx.lineWidth = 1.1;
      for (var j = 0; j < CHANNELS.length; j++) {
        ctx.beginPath();
        ctx.moveTo(266, CHANNELS[j].y);
        ctx.quadraticCurveTo(302, CHANNELS[j].y, 318, SLOT_Y);
        ctx.stroke();
      }
      ctx.restore();
      txt('запрос один, окна разные', 196, 306, C.muted, 8.5, 'center', 600);
    }

    /* ── IntentRouter: три проверки вместо анкеты на 15 полей ── */
    var PROBES = [
      { label: 'задача', note: 'что нужно сделать' },
      { label: 'бюджет', note: 'потолок клиента' },
      { label: 'наличие', note: 'по этой точке' }
    ];
    function routerLoad() {
      var load = -1;
      for (var i = 0; i < pills.length; i++) {
        if (phaseOf(pills[i]) === 'check') {
          var local = (pills[i].t - 0.40) / 0.22;
          if (local > load) load = local;
        }
      }
      return load;
    }
    function drawRouter() {
      var load = routerLoad();
      var active = load >= 0;

      rr(276, 74, 158, 232, 14, 'rgba(255,255,255,.92)', 'rgba(8,145,178,.35)', 1.5);
      rr(276, 74, 158, 26, 14, 'rgba(8,145,178,.10)', null);
      txt('AI-КОНСУЛЬТАНТ · RAG', 355, 91, C.cyan, 9, 'center', 800);
      txt(active ? 'проверяет запрос' : 'ожидает запрос', 355, 112, active ? C.cyan : C.muted, 8, 'center', 700);

      /* слот приёма запроса: сюда встаёт карточка запроса */
      rr(292, 118, 126, 30, 8, active ? 'rgba(8,145,178,.07)' : C.plateAlt, 'rgba(148,163,184,.35)', 1);

      for (var i = 0; i < PROBES.length; i++) {
        var py = 180 + i * 38;
        var fill = active ? Math.max(0, Math.min(1, (load - i * 0.2) / 0.42)) : 0;
        txt(PROBES[i].label, 292, py, C.body, 9.5, 'left', 800);
        txt(PROBES[i].note, 418, py, C.muted, 8, 'right', 600);
        rr(292, py + 6, 126, 6, 3, 'rgba(148,163,184,.28)', null);
        if (fill > 0) rr(292, py + 6, 126 * fill, 6, 3, fill >= 1 ? C.green : C.cyan, null);
        if (fill >= 1) {
          ctx.save();
          ctx.strokeStyle = C.green;
          ctx.lineWidth = 1.6;
          ctx.beginPath();
          ctx.moveTo(423, py - 3); ctx.lineTo(426, py); ctx.lineTo(431, py - 6);
          ctx.stroke();
          ctx.restore();
        }
      }

      txt('2–4 уточняющих вопроса, не анкета', 355, 298, C.muted, 8, 'center', 600);
    }

    /* ── KnowledgeCore: источник правды под консультантом ── */
    var PLATES = ['карточки SKU · атрибуты', 'регламенты и tone of voice', 'остатки 1С / МойСклад'];
    function drawKnowledge() {
      var active = routerLoad() >= 0;
      for (var i = 0; i < PLATES.length; i++) {
        var y = 330 + i * 24;
        rr(276, y, 158, 20, 6, i === 2 ? 'rgba(22,163,74,.09)' : C.plate, 'rgba(148,163,184,.4)', 1);
        rr(283, y + 7, 6, 6, 1.5, i === 2 ? C.green : C.cyan, null);
        txt(PLATES[i], 294, y + 14, C.body, 8.5, 'left', 600);
      }
      /* луч подпитки: данные идут вверх, в проверки */
      ctx.save();
      ctx.strokeStyle = active ? 'rgba(8,145,178,' + (0.5 + Math.sin(frame * 0.12) * 0.25) + ')' : 'rgba(148,163,184,.35)';
      ctx.lineWidth = 1.4;
      ctx.setLineDash([3, 4]);
      ctx.lineDashOffset = frame * 0.8;
      ctx.beginPath();
      ctx.moveTo(355, 328);
      ctx.lineTo(355, 308);
      ctx.stroke();
      ctx.restore();
      txt('ИСТОЧНИК ОТВЕТА', 276, 322, C.muted, 8.5, 'left', 800);
    }

    /* ── ConfidenceGate: порог 80% как в кейсе М.Видео ── */
    function drawGate() {
      var target = 92;
      for (var i = 0; i < pills.length; i++) {
        var ph = phaseOf(pills[i]);
        if (ph === 'gate' || (ph === 'out' && pills[i].t < 0.86)) target = pills[i].conf;
      }
      gauge = target;
      gaugeShown += (gauge - gaugeShown) * 0.14;

      /* панель порога стоит НАД коридором, по которому идёт запрос */
      var gx = 444, gy = 86, gw = 86, gh = 84;
      var pass = gaugeShown >= 80;
      rr(gx, gy, gw, gh, 11, 'rgba(255,255,255,.92)', 'rgba(148,163,184,.45)', 1.2);
      txt('УВЕРЕННОСТЬ', gx + gw / 2, gy + 16, C.muted, 8, 'center', 800);
      txt(Math.round(gaugeShown) + '%', gx + gw / 2, gy + 38, pass ? C.green : C.violet, 15, 'center', 900);

      var bx = gx + 9, by = gy + 44, bw = gw - 18, bh = 7;
      rr(bx, by, bw, bh, 3.5, C.plateAlt, 'rgba(148,163,184,.35)', 1);
      rr(bx, by, bw * Math.max(0, Math.min(100, gaugeShown)) / 100, bh, 3.5, pass ? C.green : C.violet, null);

      /* отметка порога 80% на шкале */
      var tx = bx + bw * 0.8;
      ctx.save();
      ctx.strokeStyle = 'rgba(217,119,6,' + (0.7 + Math.sin(frame * 0.08) * 0.2) + ')';
      ctx.lineWidth = 1.6;
      ctx.beginPath();
      ctx.moveTo(tx, by - 4);
      ctx.lineTo(tx, by + bh + 4);
      ctx.stroke();
      ctx.restore();
      txt('порог 80%', gx + gw / 2, gy + 62, C.amber, 7.5, 'center', 800);
      txt(pass ? 'ответ клиенту' : 'диалог продавцу', gx + gw / 2, gy + 75, pass ? C.green : C.violet, 7.5, 'center', 800);

      /* коридор решения и развилка на два выхода */
      ctx.save();
      ctx.strokeStyle = 'rgba(148,163,184,.5)';
      ctx.lineWidth = 1.1;
      ctx.setLineDash([5, 4]);
      ctx.lineDashOffset = -frame * 0.5;
      ctx.beginPath();
      ctx.moveTo(436, GATE_Y); ctx.lineTo(528, GATE_Y);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.beginPath();
      ctx.moveTo(528, GATE_Y); ctx.quadraticCurveTo(536, GATE_Y, 536, 156);
      ctx.moveTo(528, GATE_Y); ctx.quadraticCurveTo(536, GATE_Y, 536, 272);
      ctx.stroke();
      ctx.restore();
      ctx.save();
      ctx.strokeStyle = 'rgba(8,145,178,.45)';
      ctx.lineWidth = 1;
      ctx.beginPath();
      ctx.moveTo(gx + gw / 2, gy + gh);
      ctx.lineTo(gx + gw / 2, GATE_Y - 14);
      ctx.stroke();
      ctx.restore();
    }

    /* ── Два выхода: готовый подбор и очередь продавца ── */
    function drawOutputs() {
      var hotA = 0, hotS = 0;
      for (var i = 0; i < pills.length; i++) {
        if (phaseOf(pills[i]) === 'out' && pills[i].t > 0.9) {
          if (pills[i].conf >= 80) hotA = 1; else hotS = 1;
        }
      }

      /* выход клиенту: текст сверху, слот приёма карточки снизу */
      rr(536, 96, 124, 80, 11, hotA ? 'rgba(22,163,74,.16)' : C.greenSoft, C.green, hotA ? 1.8 : 1.2);
      txt('КЛИЕНТ', 546, 112, C.green, 8.5, 'left', 800);
      txt('3 SKU + кросс-sell', 546, 126, C.ink, 9.5, 'left', 800);
      txt('обоснование и наличие', 546, 137, C.muted, 7.5, 'left', 600);
      rr(542, 142, 112, 28, 7, 'rgba(255,255,255,.55)', 'rgba(22,163,74,.3)', 1);

      /* выход продавцу */
      rr(536, 212, 124, 80, 11, hotS ? 'rgba(124,58,237,.16)' : C.violetSoft, C.violet, hotS ? 1.8 : 1.2);
      txt('ПРОДАВЕЦ', 546, 228, C.violet, 8.5, 'left', 800);
      txt('диалог с контекстом', 546, 242, C.ink, 9.5, 'left', 800);
      txt('резюме и причина в CRM', 546, 253, C.muted, 7.5, 'left', 600);
      rr(542, 258, 112, 28, 7, 'rgba(255,255,255,.55)', 'rgba(124,58,237,.3)', 1);

      if (hotA || hotS) {
        var cyc = (frame % 40) / 40;
        ctx.save();
        ctx.strokeStyle = hotA ? 'rgba(22,163,74,' + (0.55 - cyc * 0.55) + ')' : 'rgba(124,58,237,' + (0.55 - cyc * 0.55) + ')';
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(598, hotA ? 156 : 272, 32 + cyc * 20, 0, Math.PI * 2);
        ctx.stroke();
        ctx.restore();
      }
    }

    /* ── Сам запрос в пути ── */
    function drawPills() {
      for (var i = 0; i < pills.length; i++) {
        var p = pills[i];
        var pos = pillPos(p);
        var ph = phaseOf(p);
        var w = ph === 'gate' || ph === 'out' ? 96 : 104;
        var col = CHANNELS[p.ch].color;
        var passing = ph === 'out' || (ph === 'gate' && p.t > 0.68);
        var edge = passing ? (p.conf >= 80 ? C.green : C.violet) : col;

        ctx.save();
        ctx.globalAlpha = pos.alpha;
        rr(pos.x - w / 2, pos.y - 11, w, 22, 7, '#ffffff', edge, 1.4);
        rr(pos.x - w / 2 + 5, pos.y - 4, 4, 8, 1.5, col, null);
        /* после шлюза карточка запроса превращается в карточку решения */
        var caption = passing ? (p.conf >= 80 ? 'подбор 3 SKU' : 'эскалация') : p.text;
        txt(caption, pos.x - w / 2 + 13, pos.y + 3, C.ink, passing ? 7.6 : 8.2, 'left', 700);
        if (passing) {
          txt(p.conf + '%', pos.x + w / 2 - 7, pos.y + 3, p.conf >= 80 ? C.green : C.violet, 7.6, 'right', 800);
        }
        ctx.restore();
      }
    }

    /* ── MetricRail: живой счётчик маршрута ── */
    function drawMetrics() {
      rr(22, 420, 636, 32, 10, 'rgba(255,255,255,.86)', 'rgba(148,163,184,.4)', 1);
      var auto = Math.round(((1017 + (done - escalated)) / (1240 + done)) * 100);
      var cells = [
        { k: 'диалогов за смену', v: (1240 + done) + '' },
        { k: 'закрыто без человека', v: auto + '%' },
        { k: 'эскалация продавцу', v: (100 - auto) + '%' },
        { k: 'первый ответ', v: '2,4 сек' }
      ];
      for (var i = 0; i < cells.length; i++) {
        var x = 38 + i * 158;
        txt(cells[i].v, x, 438, C.ink, 12.5, 'left', 900);
        txt(cells[i].k, x, 448, C.muted, 8, 'left', 600);
        if (i) {
          ctx.save();
          ctx.strokeStyle = 'rgba(148,163,184,.35)';
          ctx.lineWidth = 1;
          ctx.beginPath();
          ctx.moveTo(x - 18, 428); ctx.lineTo(x - 18, 446);
          ctx.stroke();
          ctx.restore();
        }
      }
    }

    function drawHeader() {
      txt('МАРШРУТИЗАТОР ДИАЛОГА', 24, 34, C.ink, 12, 'left', 900);
      txt('один агент · четыре канала · порог 80%', 24, 48, C.muted, 8.5, 'left', 600);
      rr(520, 22, 138, 20, 7, 'rgba(8,145,178,.10)', 'rgba(8,145,178,.3)', 1);
      txt('живой контур · demo', 589, 36, C.cyan, 8.5, 'center', 800);
    }

    function scene() {
      ctx.clearRect(0, 0, W, H);
      ctx.save();
      var s = Math.min(W / VW, H / VH);
      if (!isFinite(s) || s <= 0) s = 1;
      ctx.translate((W - VW * s) / 2, (H - VH * s) / 2);
      ctx.scale(s, s);

      drawHeader();
      drawChannels();
      drawKnowledge();
      drawRouter();
      drawGate();
      drawOutputs();
      drawPills();
      drawMetrics();

      ctx.restore();
    }

    function step() {
      frame++;
      if (frame % SPAWN === 0) spawn();
      for (var i = pills.length - 1; i >= 0; i--) {
        pills[i].t += 1 / LIFE;
        if (pills[i].t >= 1) {
          if (!pills[i].counted) {
            done++;
            if (pills[i].conf < 80) escalated++;
            pills[i].counted = true;
          }
          pills.splice(i, 1);
        }
      }
      scene();
      requestAnimationFrame(step);
    }

    resize();
    window.addEventListener('resize', function () {
      resize();
      if (reduced) scene();
    });

    if (reduced) {
      /* статичный кадр: по одному запросу на каждой стадии маршрута */
      frame = 160;
      done = 214; escalated = 39;
      pills = [
        { ch: 0, text: REQUESTS[0].text, conf: REQUESTS[0].conf, t: 0.18, counted: false },
        { ch: 2, text: REQUESTS[2].text, conf: REQUESTS[2].conf, t: 0.50, counted: false },
        { ch: 3, text: REQUESTS[6].text, conf: REQUESTS[6].conf, t: 0.755, counted: false },
        { ch: 1, text: REQUESTS[1].text, conf: REQUESTS[1].conf, t: 0.96, counted: false }
      ];
      gaugeShown = 57;
      scene();
      return;
    }

    spawn();
    if (document.fonts && document.fonts.ready) {
      document.fonts.ready.then(step).catch(step);
    } else {
      step();
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
</script>
  </section>

  <div class="vapc-cnt">
    <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-scenarii">
      <div class="ym-cta-block__icon" aria-hidden="true">🛒</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Собрать AI-продавца под ваш ассортимент</p>
        <p class="ym-cta-block__sub">Разберём каналы и сценарии, которые дадут результат первыми. Бесплатно отдаём документ «Сценарий AI-консультанта для магазина» — 5–7 типовых ветвей: подбор по задаче, фильтр по бюджету, проверка наличия, кросс-sell и эскалация продавцу.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Собрать продавца</a>
      </div>
    </div>
  </div>

  <section class="vapc-section" id="komu-nuzhno">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <span class="vapc-eyebrow">Для кого</span>
        <h2>Для кого: розница, шоурумы, франшизы, дилеры</h2>
        <p>AI-продавец-консультант окупается там, где консультация реально влияет на решение о покупке. Если у товара есть параметры, совместимость и сценарии использования — он нужен обязательно.</p>
      </div>

      <div class="vapc-grid-3 nero-ai-reveal">
        <div class="vapc-persona">
          <div class="pi" aria-hidden="true">🏪</div>
          <h3>Одиночный магазин и региональная сеть</h3>
          <p>Для одного магазина имеет смысл MVP в одном канале: виджет на сайте или Telegram с базовым каталогом. Это нижняя граница бюджета и 4–8 недель работы.</p>
          <p>Для сети на 5–50 точек ключевая ценность в другом — синхронизация: единый стандарт консультации плюс остатки по каждому магазину.</p>
          <div class="pf">MVP: 1 канал · 4–8 недель</div>
        </div>
        <div class="vapc-persona nero-ai-delay-1">
          <div class="pi" aria-hidden="true">🛋️</div>
          <h3>Шоурум с высокой долей консультации</h3>
          <p>Мебель, кухни, матрасы, отделочные материалы, электроника, инженерное оборудование, оптика, косметика — категории, где покупатель почти не выбирает без помощи.</p>
          <p>Здесь AI работает не вместо продавца, а как усилитель: снимает рутину и освобождает время на сложные сделки. Модель IKEA показывает эффект на масштабе: бот Billie закрывает до 74% рутинных обращений, а 8500 сотрудников контакт-центров переобучили в удалённых дизайн-консультантов — канал даёт €1,25–1,3 млрд выручки (<a href="https://fortune.com/2026/07/30/ikea-ai-workforce-reskilling-jobs-billie-chatbot-global-500/" target="_blank" rel="noopener noreferrer">fortune.com</a>, <a href="https://www.cio.com/article/4180896/how-ikea-turned-a-chatbot-with-13-million-users-into-a-business-worth-1-3-million.html" target="_blank" rel="noopener noreferrer">cio.com</a>).</p>
          <div class="pf">До 74% рутины на боте</div>
        </div>
        <div class="vapc-persona nero-ai-delay-2">
          <div class="pi" aria-hidden="true">🧩</div>
          <h3>Франшиза и дилерская сеть</h3>
          <p>Франшизе AI-консультант даёт три вещи, которые сложно получить иначе: одинаковый стандарт ответа, измеримость (доля закрытых запросов, доля эскалаций) и быстрый онбординг новых точек.</p>
          <p>Новый продавец выходит на приемлемый уровень консультации с первого дня, а управляющая компания видит фактическую картину по логам.</p>
          <div class="pf">Контроль стандарта по логам</div>
        </div>
      </div>

      <div class="vapc-card nero-ai-reveal" style="margin-top:28px;border-color:rgba(245,158,11,.28);background:rgba(245,158,11,.05);">
        <h3 style="font-size:18px;">Кому пока рано</h3>
        <p style="margin-bottom:0;">Сети с неструктурированным каталогом без атрибутов, без выгрузки остатков и без описаний товаров. Сначала PIM и данные, потом агент — иначе внедрение AI превращается в проект по расчистке каталога с непредсказуемым сроком.</p>
      </div>
    </div>
  </section>

  <section class="vapc-section vapc-section-alt" id="trend-2026">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <span class="vapc-eyebrow vapc-eyebrow--violet">Тренд</span>
        <h2>Тренд 2026: task-specific AI agents в retail</h2>
        <p>Прогноз Gartner, agentic commerce в России и честная часть тренда — почему 40% проектов отменят.</p>
      </div>

      <div class="vapc-callout nero-ai-reveal">
        <div class="cb">Gartner · прогноз</div>
        <div class="cn">40%</div>
        <p>корпоративных приложений получат task-specific AI agents к 2026 году — против менее 5% в 2025-м (<a href="https://www.gartner.com/en/newsroom/press-releases/2025-08-26-gartner-predicts-40-percent-of-enterprise-apps-will-feature-task-specific-ai-agents-by-2026-up-from-less-than-5-percent-in-2025" target="_blank" rel="noopener noreferrer">gartner.com, 26.08.2025</a>). Аналитики описывают пять стадий: AI-ассистенты к 2025 → task-specific агенты в 2026 → коллаборативные агенты в 2027 → кросс-приложенческие экосистемы в 2028 → демократизация создания агентов в 2029.</p>
        <div class="vapc-quote">AI agents are evolving rapidly… from basic assistants… to task-specific agents by 2026 and ultimately multiagent ecosystems by 2029.<cite>Анушри Верма, Gartner (<a href="https://channelpostmea.com/2025/08/26/40-of-enterprise-apps-will-feature-task-specific-ai-agents-by-2026/" target="_blank" rel="noopener noreferrer">channelpostmea.com</a>)</cite></div>
        <p>К 2035 году agentic AI, по оценке Gartner, будет давать около 30% выручки рынка корпоративного ПО — более $450 млрд против 2% в 2025 году. К 2028 году примерно треть пользовательского опыта сместится с нативных приложений на agentic-интерфейсы.</p>
      </div>

      <div class="vapc-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vapc-card">
          <h3>Agentic commerce в России</h3>
          <p>Data Insight и Яндекс оценивают, что к 2028–2029 годам через AI-агентов будет проходить 2–4% российского eCommerce — 400–850 млрд ₽, а к 2030–2032 годам 7–11%, то есть 2–3 трлн ₽ (<a href="https://datainsight.ru/agentic-commerce2026" target="_blank" rel="noopener noreferrer">datainsight.ru</a>). В Hype Cycle for Digital Commerce 2026 Gartner выводит Agentic Buying, AI Checkout и AEO в центр коммерции (<a href="https://www.across-magazine.com/ai-agents-move-to-center/" target="_blank" rel="noopener noreferrer">across-magazine.com</a>).</p>
        </div>
        <div class="vapc-card nero-ai-delay-1">
          <h3>Почему розница переходит от «чат-бота» к AI-продавцу</h3>
          <p>Walmart запустил agentic-помощника Sparky в приложении, вебе и магазинах. По данным Digital Commerce 360 за Q1 FY2026, недельная активная аудитория выросла вдвое квартал к кварталу, качество ответов — на 40%, средний чек у пользователей Sparky примерно на 35% выше, а число проданных через агента единиц выросло более чем в 4 раза (<a href="https://www.digitalcommerce360.com/2026/05/22/walmart-sparky-agent-ai-sales-supply-chain/" target="_blank" rel="noopener noreferrer">digitalcommerce360.com</a>, <a href="https://corporate.walmart.com/news/2025/06/06/walmart-the-future-of-shopping-is-agentic-meet-sparky" target="_blank" rel="noopener noreferrer">corporate.walmart.com</a>). Показателен и обратный опыт: checkout в сторонней LLM дал низкую конверсию, и Walmart сделал ставку на встроенного агента (<a href="https://www.wired.com/story/ai-lab-walmart-openai-shaking-up-agentic-shopping-deal/" target="_blank" rel="noopener noreferrer">wired.com</a>). Sephora пошла другим путём — приложение внутри ChatGPT с учётом профиля Beauty Insider (<a href="https://newsroom.sephora.com/sephora-app-in-chatgpt-brings-a-new-personalized-beauty-experience/" target="_blank" rel="noopener noreferrer">newsroom.sephora.com</a>).</p>
        </div>
      </div>

      <div class="vapc-card nero-ai-reveal" style="margin-top:28px;border-color:rgba(245,158,11,.3);background:rgba(245,158,11,.05);">
        <h3 style="font-size:19px;">Честная часть тренда: 40% agentic-проектов будут отменены</h3>
        <p>Второй прогноз Gartner мы приводим специально: более 40% agentic AI-проектов будут отменены к концу 2027 года из-за роста издержек, неясного ROI и слабого контроля риска (<a href="https://www.gartner.com/en/newsroom/press-releases/2025-06-25-gartner-predicts-over-40-percent-of-agentic-ai-projects-will-be-canceled-by-end-of-2027" target="_blank" rel="noopener noreferrer">gartner.com, 25.06.2025</a>). Верма прямо говорит: «Most agentic AI propositions lack significant value or return on investment… Many use cases positioned as agentic today don't require agentic implementations».</p>
        <p style="margin-bottom:0;">Вывод для розничной сети простой. Внедрение AI-агентов оправдано там, где есть измеримая метрика и понятный сценарий. Консультация в рознице — как раз такой случай: конверсия, средний чек и время ответа считаются до и после. Поэтому мы продаём не «магию нейросети», а пилот с KPI и governance.</p>
      </div>
    </div>
  </section>

  <section class="vapc-section" id="vnedrenie">
    <div class="vapc-cnt">
      <div class="vapc-sh vapc-left">
        <span class="vapc-eyebrow">Под ключ</span>
        <h2>Что входит во внедрение AI-продавца под ключ</h2>
        <p>Это не «настроим бота», а проект с фиксированным содержанием работ.</p>
      </div>

      <div class="vapc-grid-2 nero-ai-reveal">
        <div class="vapc-card">
          <h3>Аудит процесса консультации и каталога</h3>
          <p>Разбираем, как консультация происходит сейчас: какие запросы приходят, где продавец тормозит, какие каналы есть, что лежит в CRM и каталоге. На выходе — карта типовых запросов и список KPI: время ответа, конверсия консультации в чек, средний чек, доля эскалаций.</p>
        </div>
        <div class="vapc-card nero-ai-delay-1">
          <h3>Проектирование сценариев и базы знаний</h3>
          <p>Собираем ветви диалога под ваш ассортимент, тональность бренда и compliance-ограничения. Отдельно фиксируем, о чём агент говорить не должен: медицинские утверждения, юридически значимые формулировки, обещания по срокам, которых нет в системе.</p>
        </div>
        <div class="vapc-card">
          <h3>Разработка, интеграция, обучение персонала</h3>
          <p>Разработка диалогового движка, подключение каталога и остатков, интеграция CRM, вывод интерфейсов для клиента и для продавца. Отдельный блок — обучение персонала: без него copilot остаётся неиспользованной вкладкой в браузере.</p>
        </div>
        <div class="vapc-card nero-ai-delay-1">
          <h3>Запуск и сопровождение</h3>
          <p>Пилот, замер метрик, доработка сценариев по логам, масштабирование. Governance-контур на постоянку: модерация новых типов ответов, автоматические проверки, sampling диалогов, kill switch.</p>
        </div>
      </div>

      <h3 style="font-size:clamp(19px,2.4vw,26px);margin:36px 0 8px;">Что делает AI, а что остаётся человеку</h3>
      <div class="vapc-table-wrap vapc-table--split nero-ai-reveal">
        <table class="vapc-table vapc-table--split">
          <thead><tr><th>Делает AI</th><th>Остаётся человеку</th></tr></thead>
          <tbody>
            <tr><td>Структурированная консультация «задача → параметры → варианты»</td><td>Нестандартные ситуации, претензии, возвраты</td></tr>
            <tr><td>Ответы по характеристикам только из верифицированных карточек</td><td>Сложные сделки: B2B, рассрочка, trade-in</td></tr>
            <tr><td>Фильтр по бюджету и наличию в конкретной точке</td><td>Проверка спорных рекомендаций (медицина, детские товары)</td></tr>
            <tr><td>Предложение сопутствующих товаров</td><td>Обучение и корректировка базы знаний</td></tr>
            <tr><td>Передача «горячего» диалога продавцу с резюме</td><td>Решение при уверенности модели ниже порога</td></tr>
            <tr><td>Сбор аналитики спроса и пробелов ассортимента</td><td>Стратегия ассортимента и закупок</td></tr>
          </tbody>
        </table>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI-консультанта полезно разобраться в промптах, RAG, human-in-the-loop и интеграции с каталогом — это ускоряет согласование сценариев с merchandising и IT.<?php if ($secondary_cta_url !== '') : ?> Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.<?php endif; ?></p>
        </div>
      </aside>

      <h3 style="font-size:clamp(19px,2.4vw,26px);margin:36px 0 16px;">Какие данные нужны для запуска</h3>
      <div class="vapc-card nero-ai-reveal">
        <ul style="margin-bottom:0;">
          <li>каталог или PIM: SKU, атрибуты, совместимость, цены, фото;</li>
          <li>остатки по магазинам — минимум ежедневная синхронизация на MVP;</li>
          <li>FAQ, скрипты продавцов, регламенты;</li>
          <li>история типовых диалогов или тикетов, если она есть;</li>
          <li>tone of voice бренда, запреты и compliance-правила;</li>
          <li>поля в CRM под лиды и эскалации.</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="vapc-section vapc-section-alt" id="integracii">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <span class="vapc-eyebrow">Интеграции</span>
        <h2>Интеграции: CRM, каталог, учёт наличия</h2>
        <p>Интеграция AI-продавца-консультанта — это то, что отличает рабочее решение от демо-бота.</p>
      </div>

      <div class="vapc-grid-2 nero-ai-reveal">
        <div class="vapc-card">
          <h3>CRM и история обращений клиента</h3>
          <p>Агент пишет в CRM лид, резюме диалога и причину эскалации. Продавец подхватывает разговор с контекстом, а не с фразы «расскажите ещё раз». Поддерживаем amoCRM, Bitrix24 и retail-CRM; связка AI-продавца-консультанта с CRM обычно и есть первая точка интеграции.</p>
        </div>
        <div class="vapc-card nero-ai-delay-1">
          <h3>Каталог, цены, остатки в реальном времени</h3>
          <p>На MVP допустима статическая выгрузка с обновлением 1–2 раза в день. На полном внедрении — real-time API остатков по магазинам, иначе теряется главный смысл: «есть в вашей точке прямо сейчас».</p>
        </div>
      </div>

      <div class="vapc-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vapc-table">
          <thead><tr><th>Контур</th><th>Инструменты</th></tr></thead>
          <tbody>
            <tr><td>CRM</td><td>amoCRM, Bitrix24, retail CRM</td></tr>
            <tr><td>Каталог и остатки</td><td>1С, МойСклад, API e-com, CSV-выгрузки</td></tr>
            <tr><td>POS и чек</td><td>кассовое ПО, эквайринг (как в кейсе Plitonit)</td></tr>
            <tr><td>Сайт и приложение</td><td>виджет, mobile SDK</td></tr>
            <tr><td>Мессенджеры</td><td>Telegram, VK, WhatsApp Business</td></tr>
            <tr><td>База знаний</td><td>PIM, Confluence, Notion, PDF-регламенты</td></tr>
            <tr><td>AI-модель</td><td>YandexGPT, GigaChat, OpenAI, Claude + RAG</td></tr>
            <tr><td>Голос (опционально)</td><td>Yandex SpeechKit, ElevenLabs</td></tr>
            <tr><td>Автоматизация</td><td>n8n, Make — вебхуки CRM и алерты</td></tr>
            <tr><td>Аналитика</td><td>Метрика, воронка CRM, BI</td></tr>
          </tbody>
        </table>
      </div>

      <h3 style="font-size:clamp(19px,2.4vw,26px);margin:36px 0 16px;">Омниканал: сайт, мессенджеры, киоск на точке</h3>
      <p style="max-width:900px;">Один агент — много интерфейсов. Виджет на сайте, SDK в приложении, Telegram и VK, планшет продавца, при необходимости голосовой киоск в зале. Логика подбора и база знаний при этом единые, поэтому ответ в любом канале совпадает.</p>
    </div>
  </section>

  <section class="vapc-section" id="etapy">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <span class="vapc-eyebrow">Этапы</span>
        <h2>Этапы внедрения: от аудита до запуска</h2>
        <p>Как внедрить AI-продавца-консультанта без риска попасть в те самые 40% отменённых проектов — двигаться короткими этапами с замером на каждом.</p>
      </div>

      <div class="vapc-stepper nero-ai-reveal">
        <div class="vapc-step">
          <span class="sn">1</span>
          <h3>Аудит и карта консультаций</h3>
          <p>Аудит каналов, каталога и CRM, карта типовых запросов, согласование KPI и метода замера. Здесь же честно оцениваем готовность данных: если каталог без атрибутов, сначала идёт подготовка данных.</p>
          <div class="sd">1–2 недели</div>
        </div>
        <div class="vapc-step">
          <span class="sn">2</span>
          <h3>Прототип и пилот на одной точке</h3>
          <p>MVP: один канал, база знаний, каталог и остатки в режиме чтения, handoff продавцу. Пилот на 2–4 точках или на одном сегменте каталога, обязательно с контрольной группой.</p>
          <div class="sd">3–6 недель</div>
        </div>
        <div class="vapc-step">
          <span class="sn">3</span>
          <h3>Масштабирование на сеть</h3>
          <p>Планшет продавца, виджет на сайте, мессенджеры, интеграции CRM и POS, доступ для франчайзи. Масштабирование включаем только после того, как пилот показал цифры.</p>
          <div class="sd">после цифр пилота</div>
        </div>
        <div class="vapc-step">
          <span class="sn">4</span>
          <h3>Метрики и доработка сценариев</h3>
          <p>Смотрим топ-запросов без ответа, доработываем базу знаний, чистим ошибочные рекомендации, расширяем кросс-sell. Отдельно ведём реестр рисков.</p>
          <div class="sd">постоянно</div>
        </div>
      </div>

      <div class="vapc-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:19px;">Как выглядит корректное доказательство</h3>
        <p>Askona провела A/B-тест с 26 февраля по 13 марта 2026 года: конверсия выросла на 9,8%, выручка — на 18,4% (<a href="https://nrcases.ru/iicase5-2026" target="_blank" rel="noopener noreferrer">nrcases.ru</a>). Это и есть корректный формат доказательства — не «ощущается лучше», а измеренная разница.</p>
        <p style="margin-bottom:0;">В кейсе Plitonit пилот длился около года и завершился в ноябре 2025-го, промышленный запуск — январь 2026-го, с расчётной окупаемостью 2–2,5 года (<a href="https://www.retail.ru/cases/ai-konsultant-dlya-riteyla-zachem-brendu-govoryashchiy-kiosk-v-tochkakh-prodazh/" target="_blank" rel="noopener noreferrer">retail.ru</a>). Реестр рисков ведём отдельно: галлюцинации по характеристикам, юридически значимые формулировки, персональные данные, зависимость качества ответа от актуальности каталога.</p>
      </div>
    </div>
  </section>

  <section class="vapc-section vapc-section-alt" id="keisy">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <span class="vapc-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI-консультанта</h2>
        <p>Прямых публичных кейсов «единый AI-продавец для всей сети под ключ» в России пока мало. Зато есть сильные смежные внедрения, и они закрывают разные контуры одной задачи.</p>
      </div>

      <div class="vapc-case-grid nero-ai-reveal">
        <div class="vapc-case-card">
          <div class="vapc-case-tag">DIY · офлайн-точка</div>
          <h3>Plitonit и Molver: подбор в шоуруме</h3>
          <p>Голосовой AI-киоск в DIY-точках: камера, микрофон, RAG по технической документации, навигация по залу, кросс-продажи, QR и корзина, интеграция с эквайрингом, ККТ и программой лояльности. Киоск первым вступает в диалог, подбирает комплект материалов и ведёт клиента к полке, сохраняя память диалога при повторном визите.</p>
          <div class="vapc-case-kpi"><span>2–3 сек ответ</span><span>до +20% выручки</span><span>окупаемость 2–2,5 года</span></div>
          <p style="margin-top:14px;">Иван Коновалов, Molver: «AI-консультант — всего лишь мостик между цифровым и реальным миром… помогает ритейлеру увеличить выручку до 20%» (<a href="https://www.retail.ru/cases/ai-konsultant-dlya-riteyla-zachem-brendu-govoryashchiy-kiosk-v-tochkakh-prodazh/" target="_blank" rel="noopener noreferrer">retail.ru</a>).</p>
        </div>
        <div class="vapc-case-card">
          <div class="vapc-case-tag">Онлайн-канал</div>
          <h3>Askona: рост конверсии в приложении</h3>
          <p>Диалоговый ИИ-консультант в мобильном приложении вместо поиска по каталогу: уточняющие вопросы по параметрам, релевантные SKU, покупка внутри приложения, статус заказа и бонусы. Проект победил в конкурсе кейсов New Retail 2026, дальше планируется масштабирование на askona.ru.</p>
          <div class="vapc-case-kpi"><span>+9,8% конверсия</span><span>+18,4% выручка</span><span>A/B-тест</span></div>
          <p style="margin-top:14px;">Владимир Корчагов, Askona: «Мы стремимся сделать цифровую консультацию такой же полезной и качественной, как общение с профессиональным продавцом-консультантом в магазине» (<a href="https://www.retail.ru/rbc/pressreleases/askona-pobedila-v-konkurse-keysov-new-retail-s-proektom-ii-konsultanta/" target="_blank" rel="noopener noreferrer">retail.ru</a>, <a href="https://www.vedomosti.ru/press_releases/2026/06/22/askona-pobedila-v-konkurse-keisov-new-retail-s-proektom-ii-konsultanta" target="_blank" rel="noopener noreferrer">vedomosti.ru</a>).</p>
        </div>
        <div class="vapc-case-card">
          <div class="vapc-case-tag">Стандарт сети</div>
          <h3>«Подружка» и М.Видео-Эльдорадо</h3>
          <p>Сеть «Подружка» вместе с командой «ДАР» (КОРУС Консалтинг) собрала ИИ-помощника на open source и внешней LLM: диалоговый подбор косметики в Telegram, с планами вывести помощника на сайт, в приложение и в руки консультантов офлайн-магазинов.</p>
          <div class="vapc-case-kpi"><span>65% вопросов персонала</span><span>порог 80%</span><span>2000 категорий</span></div>
          <p style="margin-top:14px;">Дмитрий Мамонтов, ИТ-директор «Подружки»: «AI-помощник позволяет сделать взаимодействие более живым и персональным… создать ощущение консультанта, который всегда под рукой» (<a href="https://data.korusconsulting.ru/press-center/news/dar-sozdal-ii-pomoshchnika-dlya-roznichnoy-seti-podruzhka/" target="_blank" rel="noopener noreferrer">data.korusconsulting.ru</a>). М.Видео-Эльдорадо закрыла второй контур — поддержку персонала (<a href="https://autofaq.ai/case/mvideo-eldorado" target="_blank" rel="noopener noreferrer">autofaq.ai</a>, <a href="https://logistics.ru/riteyl/mvideo-eldorado-vnedrila-virtualnogo-konsultanta-ot-vs-robotics" target="_blank" rel="noopener noreferrer">logistics.ru</a>).</p>
        </div>
      </div>

      <div class="vapc-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:19px;">Что эти кейсы значат для вашей сети</h3>
        <ul style="margin-bottom:0;">
          <li>Офлайн-точка, приложение, мессенджер и поддержка продавца — уже проверенные контуры по отдельности.</li>
          <li>Ни один из них не даёт полной картины: собранное решение «клиент + продавец на одной базе» и есть незанятая позиция на рынке.</li>
          <li>Все публичные цифры получены в A/B или в измеримом пилоте. Мы не обещаем «+30% к выручке» — мы обещаем корректный замер на вашем ассортименте.</li>
        </ul>
      </div>

      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-keisy">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Покажем, как кейсы переносятся на ваш каталог</p>
          <p class="ym-cta-block__sub">Рассчитаем пилот с KPI и контрольной группой. Заберите «Сценарий AI-консультанта для магазина» — готовую карту диалога для вашей категории.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Собрать продавца</a>
            <a href="#ceny" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Смотреть стоимость</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="vapc-section" id="ceny">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <span class="vapc-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI-продавец-консультант</h2>
        <p>Ориентир бюджета на внедрение под ключ — <strong>250 тыс.–1 млн ₽</strong>. Разброс объясняется четырьмя факторами.</p>
      </div>

      <div class="vapc-card nero-ai-reveal">
        <h3 style="font-size:19px;">Из чего складывается стоимость</h3>
        <ol style="margin-bottom:0;">
          <li><strong>Количество каналов.</strong> Один канал дешевле, омниканал (точка + сайт + приложение + мессенджеры) дороже.</li>
          <li><strong>Состояние данных.</strong> Готовый API каталога с атрибутами и остатками — минимальные работы. Каталог без атрибутов и без выгрузки остатков — отдельный подпроект.</li>
          <li><strong>Глубина интеграций.</strong> Чтение каталога стоит одного, запись в CRM, корзина и POS — другого.</li>
          <li><strong>Governance-требования.</strong> Модерация, логи, eval-тесты, kill switch — обязательны для чувствительных категорий.</li>
        </ol>
      </div>

      <h3 style="font-size:clamp(19px,2.4vw,26px);margin:36px 0 8px;">Пилот против полного внедрения в сеть</h3>
      <div class="vapc-table-wrap nero-ai-reveal">
        <table class="vapc-table">
          <thead><tr><th>Функция</th><th>MVP / пилот</th><th>Полное внедрение</th></tr></thead>
          <tbody>
            <tr><td>Каналы</td><td>1: сайт <strong>или</strong> Telegram <strong>или</strong> планшет продавца</td><td>Омниканал: точка + сайт + приложение + мессенджеры</td></tr>
            <tr><td>Каталог</td><td>Статическая выгрузка или CSV, обновление 1–2 раза в день</td><td>Real-time API остатков по магазинам</td></tr>
            <tr><td>Подбор</td><td>По задаче, бюджету и категории</td><td>+ кросс-sell, комплекты, акции, лояльность</td></tr>
            <tr><td>Продавец</td><td>Read-only copilot «подсказка ответа»</td><td>Полный co-pilot + создание корзины в CRM</td></tr>
            <tr><td>Голос</td><td>—</td><td>Киоск и голосовой ввод</td></tr>
            <tr><td>Оплата</td><td>Ссылка на корзину или QR</td><td>POS, NFC, программа лояльности</td></tr>
            <tr><td>Governance</td><td>Ручная модерация всех новых типов ответов</td><td>Автоматические eval, sampling, kill switch</td></tr>
            <tr><td>Аналитика</td><td>Базовые метрики в CRM</td><td>ABC/XYZ-анализ запросов, дообучение на логах</td></tr>
            <tr><td>Срок и бюджет</td><td>4–8 недель, нижняя граница диапазона</td><td>3–6 месяцев, верхняя граница диапазона</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vapc-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vapc-card">
          <h3>Ежемесячные расходы на LLM и поддержку</h3>
          <p>Кроме внедрения есть операционные расходы: токены модели (зависят от объёма диалогов и длины контекста), хостинг, обновление базы знаний, модерация и доработка сценариев. Их считаем на этапе аудита исходя из фактического числа консультаций — так вы видите себестоимость одного диалога, а не абстрактную «подписку».</p>
        </div>
        <div class="vapc-card nero-ai-delay-1">
          <h3>ROI: меньше потерянных консультаций, выше средний чек</h3>
          <ul>
            <li><strong>время первого ответа</strong> — ориентир из кейса Plitonit: 2–3 секунды;</li>
            <li><strong>конверсия консультации в покупку</strong> — ориентир Askona: +9,8% в A/B;</li>
            <li><strong>выручка на сессию или средний чек</strong> — Askona +18,4%, Walmart Sparky: AOV примерно на 35% выше;</li>
            <li><strong>доля автозакрытия запросов</strong> — ориентир М.Видео: 65% внутренних вопросов персонала;</li>
            <li><strong>доля эскалаций</strong> — показывает, где база знаний ещё не закрывает спрос.</li>
          </ul>
          <p style="margin-bottom:0;">Это ориентиры из публичных кейсов, а не гарантия. Ваш результат зависит от категории, качества каталога и дисциплины персонала — поэтому мы всегда начинаем с пилота с контрольной группой.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vapc-section vapc-section-alt" id="faq">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <span class="vapc-eyebrow">FAQ</span>
        <h2>FAQ: ответы перед заказом внедрения</h2>
      </div>
      <div class="vapc-faq nero-ai-reveal">
        <div class="vapc-faq-item"><div class="vapc-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли программисты на стороне заказчика?</div><div class="vapc-faq-a">Нет. AI-продавец-консультант внедряется без программиста на вашей стороне: разработку, коннекторы к каталогу и CRM, сценарии и governance делает наша команда. От вас нужен человек, который знает ассортимент и может согласовывать формулировки, а также контакт вашего IT или интегратора для доступа к каталогу и остаткам.</div></div>
        <div class="vapc-faq-item"><div class="vapc-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько времени занимает запуск?</div><div class="vapc-faq-a">MVP в одном канале — 4–8 недель: аудит 1–2 недели, разработка и интеграция 3–6 недель. Полное внедрение на сеть с омниканалом, POS и лояльностью — 3–6 месяцев. Пилот на 2–4 точках стартует раньше, чем завершается rollout, — цифры вы видите до полного масштабирования.</div></div>
        <div class="vapc-faq-item"><div class="vapc-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли AI-продавец-консультант для малого бизнеса и одного магазина?</div><div class="vapc-faq-a">Да, если у товара есть параметры и консультация влияет на покупку. Для одного магазина берём MVP: один канал, базовый каталог, подсказки продавцу. Это нижняя граница бюджета. Для сети из 50+ точек к этому добавляются остатки по магазинам и контроль стандарта консультации.</div></div>
        <div class="vapc-faq-item"><div class="vapc-faq-q" role="button" tabindex="0" aria-expanded="false">Как AI учитывает наличие и актуальные цены?</div><div class="vapc-faq-a">Через коннектор к вашей системе учёта: 1С, МойСклад, API интернет-магазина или регулярная выгрузка. На MVP допустима синхронизация раз в сутки, на полном внедрении — обращение к остаткам в реальном времени по конкретной точке. Про характеристики агент отвечает только из верифицированных карточек — это защита от галлюцинаций.</div></div>
        <div class="vapc-faq-item"><div class="vapc-faq-q" role="button" tabindex="0" aria-expanded="false">Чем это отличается от готового чат-бота на сайте?</div><div class="vapc-faq-a">Чат-бот работает по дереву кнопок и FAQ, отвечает про доставку и график. AI-продавец-консультант — task-specific агент: понимает задачу, фильтрует по бюджету и наличию, обосновывает выбор, предлагает сопутствующие товары, передаёт диалог продавцу с контекстом и пишет данные в CRM. Большинство решений на рынке ориентированы на входящие заявки в мессенджерах и не работают с остатками, POS и планшетом продавца на точке.</div></div>
        <div class="vapc-faq-item"><div class="vapc-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит AI-продавец-консультант и как заказать?</div><div class="vapc-faq-a">Ориентир — 250 тыс.–1 млн ₽ в зависимости от каналов, состояния каталога и глубины интеграций. Чтобы заказать внедрение, начните с аудита: мы разбираем ваш процесс консультации, показываем сценарии с наибольшим эффектом и фиксируем KPI пилота.</div></div>
        <div class="vapc-faq-item"><div class="vapc-faq-q" role="button" tabindex="0" aria-expanded="false">Заменит ли AI продавцов?</div><div class="vapc-faq-a">Нет, и это принципиальная позиция. Модель, которая работает, — augmentation: AI снимает рутину и типовые вопросы, продавец получает время на сложные консультации и сделки. У IKEA бот закрыл до 74% рутинных обращений, а 8500 сотрудников перевели в удалённых дизайн-консультантов, создав канал на €1,25–1,3 млрд.</div></div>
        <div class="vapc-faq-item"><div class="vapc-faq-q" role="button" tabindex="0" aria-expanded="false">А если проект не окупится? Gartner говорит, что 40% agentic-проектов отменят</div><div class="vapc-faq-a">Именно поэтому мы работаем через пилот с KPI и контрольной группой, а не через «внедрим агента и посмотрим». Gartner называет причины отмены прямо: рост издержек, неясный ROI, слабый контроль риска. Наш ответ — узкий scope на старте, измеримая метрика, governance-контур и решение о масштабировании по цифрам пилота.</div></div>
      </div>
    </div>
  </section>

  <section class="vapc-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.07),rgba(139,92,246,.08));">
    <div class="vapc-cnt">
      <div class="vapc-sh">
        <h2>Собрать AI-продавца для вашей сети</h2>
      </div>

      <div class="vapc-grid-2 nero-ai-reveal">
        <div class="vapc-card">
          <h3>Два факта, с которыми розница подходит к 2026 году</h3>
          <p>Первый: покупатель уже привык к скорости AI-ответа и переносит это ожидание в магазин. Второй: AI-агенты становятся стандартным слоем корпоративных приложений — по прогнозу Gartner, 40% приложений получат task-specific агентов уже к 2026 году, при том что в 2025-м их было меньше 5%.</p>
          <p style="margin-bottom:0;">Сеть, которая соберёт единый стандарт консультации первой, получает не «модную технологию», а измеримое преимущество: быстрее первый ответ, одинаковое качество на всех точках, выше конверсия и средний чек, плюс аналитика реального спроса для закупок.</p>
        </div>
        <div class="vapc-card nero-ai-delay-1">
          <h3>Что вы получаете от <?php echo esc_html($brand); ?></h3>
          <ul style="margin-bottom:0;">
            <li>аудит процесса консультации и каталога с картой типовых запросов;</li>
            <li>спроектированные сценарии AI-продавца под ваш ассортимент;</li>
            <li>интеграции с CRM, каталогом, остатками и, при необходимости, POS;</li>
            <li>два интерфейса на одной базе: клиент в digital-канале и продавец на точке;</li>
            <li>пилот с KPI и контрольной группой, а затем масштабирование на сеть;</li>
            <li>governance-контур: модерация, логи, kill switch, защита от галлюцинаций.</li>
          </ul>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Собрать AI-продавца для вашей сети</p>
          <p class="ym-cta-block__sub">Оставьте заявку — разберём кейс на аудите. Бесплатно: документ «Сценарий AI-консультанта для магазина» с 5–7 ветвями диалога.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Собрать продавца</a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Вопросы перед заказом</a>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
$vapc_ad_url   = getenv('AD_BANNER_URL') ?: '';
$vapc_ad_image = getenv('AD_BANNER_IMAGE_URL') ?: '';
$vapc_ad_alt   = getenv('AD_BANNER_ALT') ?: 'Реклама';
if ($vapc_ad_url !== '' && $vapc_ad_image !== '') :
?>
  <div class="vapc-cnt vapc-ad-banner" style="margin:48px auto 32px;text-align:center;">
    <a href="<?php echo esc_url($vapc_ad_url); ?>" target="_blank" rel="noopener noreferrer sponsored">
      <img src="<?php echo esc_url($vapc_ad_image); ?>" width="970" height="90" alt="<?php echo esc_attr($vapc_ad_alt); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;box-shadow:var(--ym-shadow-sm);">
    </a>
  </div>
<?php endif; ?>

</div>

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * vapc-shelf-advisor-engine — мир «Стеллажный атриум подбора» (hero, Алина)
 * Центральный объект: ShelfMatrixWall (матрица SKU 5x3).
 * Транспорт: AisleWayfinder (проход зала + ценниковая шина) — вместо конвейера.
 * Фазы: ЗАПРОС → БЮДЖЕТ → НАЛИЧИЕ → КОМПЛЕКТ → ПЕРЕДАЧА ПРОДАВЦУ.
 * Финал цикла: карточка подбора уезжает на бейдж живого продавца.
 */
(function () {
  'use strict';

  function boot() {
    var canvas = document.getElementById('vapc-shelf-advisor-canvas');
    if (!canvas || !canvas.getContext) return;
    var ctx = canvas.getContext('2d');

    var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
    var CYCLE = 260;
    var reduced = !!(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);

    function resizeCanvas() {
      var wrap = canvas.parentElement;
      if (!wrap) return;
      canvas.width = wrap.clientWidth || 440;
      canvas.height = wrap.clientHeight || 290;
      cw = canvas.width;
      ch = canvas.height;
      cx = cw / 2;
      cy = ch / 2 + 6;
      scale = Math.min(cw / 460, ch / 300) * 1.06;
    }
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    var C = {
      line: 'rgba(148,171,201,.85)',
      rack: '#131c33',
      rackEdge: 'rgba(121,242,255,.22)',
      cell: 'rgba(255,255,255,.075)',
      cellDim: 'rgba(255,255,255,.022)',
      cellEdge: 'rgba(255,255,255,.14)',
      pick: 'rgba(121,242,255,.20)',
      pickEdge: '#79f2ff',
      acc: 'rgba(34,197,94,.20)',
      accEdge: '#22c55e',
      gone: 'rgba(245,158,11,.14)',
      goneEdge: '#f59e0b',
      floor: 'rgba(121,242,255,.07)',
      chevron: 'rgba(121,242,255,.42)',
      badge: 'rgba(139,92,246,.18)',
      badgeEdge: '#8b5cf6',
      white: '#f8fafc',
      muted: '#9aa8bd',
      bubbleBg: '#0b1020',
      agentYellow: '#eab308',
      agentGreen: '#10b981',
      agentBlue: '#3b82f6',
      agentPink: '#ec4899',
      agentPurple: '#8b5cf6'
    };

    /* ── фазы цикла: сужение выдачи, а не сборка ── */
    var PHASES = [
      { id: 'task',    from: 0,   to: 52,  label: '1 · запрос' },
      { id: 'budget',  from: 52,  to: 104, label: '2 · бюджет' },
      { id: 'stock',   from: 104, to: 156, label: '3 · наличие' },
      { id: 'bundle',  from: 156, to: 208, label: '4 · комплект' },
      { id: 'handoff', from: 208, to: 260, label: '5 · передача' }
    ];
    function prgNow() { return (frame * 0.04) % CYCLE; }
    function phaseOf(p) {
      for (var i = 0; i < PHASES.length; i++) {
        if (p >= PHASES[i].from && p < PHASES[i].to) return PHASES[i];
      }
      return PHASES[0];
    }
    function reached(p, id) {
      for (var i = 0; i < PHASES.length; i++) {
        if (PHASES[i].id === id) return p >= PHASES[i].from;
      }
      return false;
    }

    function drawRR(c, x, y, w, h, r, fill, stroke, lw) {
      c.beginPath();
      if (c.roundRect) c.roundRect(x, y, w, h, r);
      else c.rect(x, y, w, h);
      if (fill) { c.fillStyle = fill; c.fill(); }
      if (stroke) { c.lineWidth = lw || 1.2; c.strokeStyle = stroke; c.stroke(); }
    }
    function label(c, text, x, y, color, size, align) {
      c.fillStyle = color;
      c.font = 'bold ' + (size || 7) + 'px Inter,-apple-system,sans-serif';
      c.textAlign = align || 'center';
      c.textBaseline = 'alphabetic';
      c.fillText(text, x, y);
    }

    /* =========================================================
       ShelfMatrixWall — центральный объект мира (вместо экрана)
       15 ячеек SKU: цена + статус наличия. Выдача сужается.
       ========================================================= */
    var COLS = 5, ROWS = 3, CW_ = 34, CH_ = 25, GAP = 5;
    var WALL_X = -74, WALL_Y = -90;
    var BUDGET_LIMIT = 60;

    /* pick: финальный комплект · swap: замена выпавшей позиции · drop: выпадает по остаткам · acc: сопутствующая */
    var SKU = [
      { c: 0, r: 0, price: 96, tag: 'XL-фор.' },
      { c: 1, r: 0, price: 45, tag: 'керамогр.', pick: true },
      { c: 2, r: 0, price: 118, tag: 'ручн. рос.' },
      { c: 3, r: 0, price: 74, tag: 'мозаика' },
      { c: 4, r: 0, price: 52, tag: 'керамогр.', swap: true },
      { c: 0, r: 1, price: 61, tag: 'бордюр' },
      { c: 1, r: 1, price: 88, tag: 'панно' },
      { c: 2, r: 1, price: 54, tag: 'плинтус' },
      { c: 3, r: 1, price: 58, tag: 'декор', drop: true },
      { c: 4, r: 1, price: 103, tag: 'слэб' },
      { c: 0, r: 2, price: 7, tag: 'клей+затир.', acc: true },
      { c: 1, r: 2, price: 72, tag: 'ступени' },
      { c: 2, r: 2, price: 39, tag: 'фоновая', pick: true },
      { c: 3, r: 2, price: 64, tag: 'подступ.' },
      { c: 4, r: 2, price: 49, tag: 'грунт-сет' }
    ];

    function cellBox(sku) {
      return {
        x: WALL_X + sku.c * (CW_ + GAP),
        y: WALL_Y + sku.r * (CH_ + GAP),
        w: CW_,
        h: CH_
      };
    }

    function ShelfMatrixWall() { this.y = -60; }
    ShelfMatrixWall.prototype.draw = function (c) {
      var p = prgNow();
      var ph = phaseOf(p);

      /* каркас стеллажа: стойки + полки */
      var wallW = COLS * CW_ + (COLS - 1) * GAP;
      var wallH = ROWS * CH_ + (ROWS - 1) * GAP;
      drawRR(c, WALL_X - 12, WALL_Y - 13, wallW + 24, wallH + 28, 8, C.rack, C.rackEdge, 1.4);
      for (var r = 0; r < ROWS; r++) {
        var by = WALL_Y + r * (CH_ + GAP) + CH_ + 2;
        drawRR(c, WALL_X - 8, by, wallW + 16, 2.5, 1, 'rgba(121,242,255,.16)', null);
      }
      label(c, 'СТЕЛЛАЖ · КАТАЛОГ ТОЧКИ', WALL_X - 8, WALL_Y - 4, 'rgba(199,210,229,.6)', 6.5, 'left');

      /* лимит бюджета: 140 → 60 в фазе БЮДЖЕТ */
      var limit = 140;
      if (ph.id === 'budget') {
        limit = 140 - (140 - BUDGET_LIMIT) * Math.min(1, (p - ph.from) / 34);
      } else if (reached(p, 'stock')) {
        limit = BUDGET_LIMIT;
      }

      /* ambient: волна сканирования по колонкам — второй слой движения */
      var scanCol = Math.floor((frame * 0.05) % (COLS * 1.6));

      for (var i = 0; i < SKU.length; i++) {
        var s = SKU[i];
        var b = cellBox(s);
        var overBudget = s.price > limit;
        var fill = C.cell, edge = C.cellEdge, lw = 1;
        var alpha = 1;

        if (overBudget) { fill = C.cellDim; edge = 'rgba(255,255,255,.07)'; alpha = 0.5; }

        /* НАЛИЧИЕ: позиция выпала с этой точки, вместо неё — свап */
        if (reached(p, 'stock') && s.drop) { fill = C.gone; edge = C.goneEdge; alpha = 1; }
        if (reached(p, 'stock') && s.swap) { fill = C.pick; edge = C.pickEdge; lw = 1.5; }

        /* КОМПЛЕКТ: остаются только позиции комплекта */
        if (reached(p, 'bundle')) {
          if (s.pick || s.swap) { fill = C.pick; edge = C.pickEdge; lw = 1.6; alpha = 1; }
          else if (s.acc) { fill = C.acc; edge = C.accEdge; lw = 1.5; alpha = 1; }
          else if (!s.drop) { fill = C.cellDim; edge = 'rgba(255,255,255,.06)'; alpha = 0.38; }
        }

        c.save();
        c.globalAlpha = alpha;
        drawRR(c, b.x, b.y, b.w, b.h, 4, fill, edge, lw);

        /* мини-изображение SKU */
        drawRR(c, b.x + 4, b.y + 4, 11, 11, 2, 'rgba(255,255,255,.14)', null);
        drawRR(c, b.x + 4, b.y + 17, b.w - 8, 2, 1, 'rgba(255,255,255,.12)', null);

        /* цена и ярлык */
        label(c, s.price + 'т', b.x + b.w - 4, b.y + 11, overBudget ? 'rgba(154,168,189,.75)' : C.white, 7, 'right');
        label(c, s.tag, b.x + b.w - 4, b.y + 22, 'rgba(154,168,189,.8)', 5.6, 'right');

        /* статус наличия — появляется в фазе НАЛИЧИЕ */
        if (reached(p, 'stock') && !overBudget) {
          if (s.drop) {
            c.strokeStyle = C.goneEdge;
            c.lineWidth = 1.4;
            c.beginPath();
            c.moveTo(b.x + 5, b.y + 5); c.lineTo(b.x + b.w - 5, b.y + b.h - 5);
            c.moveTo(b.x + b.w - 5, b.y + 5); c.lineTo(b.x + 5, b.y + b.h - 5);
            c.stroke();
          } else {
            /* статус-полоса «в наличии» у левого края ячейки — не мешает цене и ярлыку */
            drawRR(c, b.x + 1.5, b.y + 5, 2.4, b.h - 10, 1.2, s.swap ? C.pickEdge : C.accEdge, null);
          }
        }

        /* ambient-подсветка колонки сканирования */
        if (s.c === scanCol && ph.id !== 'handoff') {
          drawRR(c, b.x, b.y, b.w, b.h, 4, 'rgba(121,242,255,.07)', null);
        }
        c.restore();
      }

      /* CrossSellBracket — скоба комплекта вокруг выбранных SKU */
      if (reached(p, 'bundle')) {
        var t = ph.id === 'bundle' ? Math.min(1, (p - 156) / 22) : 1;
        c.save();
        c.globalAlpha = 0.9;
        c.strokeStyle = C.pickEdge;
        c.lineWidth = 1.2;
        c.setLineDash([4, 3]);
        c.lineDashOffset = -frame * 0.25;
        c.beginPath();
        var a = cellBox(SKU[1]), d = cellBox(SKU[4]), f = cellBox(SKU[12]), g = cellBox(SKU[10]);
        c.moveTo(a.x + a.w / 2, a.y + a.h);
        c.lineTo(a.x + a.w / 2, a.y + a.h + 8 * t);
        c.lineTo(d.x + d.w / 2, a.y + a.h + 8 * t);
        c.lineTo(d.x + d.w / 2, d.y + d.h);
        c.moveTo(f.x + f.w / 2, f.y);
        c.lineTo(f.x + f.w / 2, f.y - 7 * t);
        c.moveTo(g.x + g.w / 2, g.y);
        c.lineTo(g.x + g.w / 2, g.y - 7 * t);
        c.stroke();
        c.setLineDash([]);
        label(c, '3 SKU + кросс-sell', 116, WALL_Y - 4, C.pickEdge, 6.5, 'right');
        c.restore();
      }

      /* индикатор текущей фазы — левый верхний угол сцены */
      drawRR(c, -200, -118, 64, 13, 6, 'rgba(121,242,255,.10)', 'rgba(121,242,255,.32)');
      label(c, ph.label.toUpperCase(), -168, -108.5, C.pickEdge, 6.6, 'center');
    };

    /* =========================================================
       AisleWayfinder — проход зала вместо конвейера
       Шевроны ведут к полке; сверху — ценниковая шина
       ========================================================= */
    function AisleWayfinder() { this.y = 40; }
    AisleWayfinder.prototype.draw = function (c) {
      var p = prgNow();

      /* пол прохода в перспективе */
      c.save();
      c.fillStyle = C.floor;
      c.beginPath();
      c.moveTo(-150, 30);
      c.lineTo(150, 30);
      c.lineTo(200, 96);
      c.lineTo(-200, 96);
      c.closePath();
      c.fill();
      c.strokeStyle = 'rgba(121,242,255,.16)';
      c.lineWidth = 1;
      c.stroke();
      c.restore();

      /* шевроны-указатели «к нужной полке» */
      var flow = (frame * 0.5) % 60;
      for (var i = 0; i < 7; i++) {
        var x = -190 + i * 58 + flow;
        if (x > 196) x -= 406;
        var fade = 1 - Math.abs(x) / 240;
        c.save();
        c.globalAlpha = Math.max(0.12, fade * 0.8);
        c.strokeStyle = C.chevron;
        c.lineWidth = 1.8;
        c.beginPath();
        c.moveTo(x - 6, 52);
        c.lineTo(x, 58);
        c.lineTo(x - 6, 64);
        c.stroke();
        c.restore();
      }
      label(c, 'ПРОХОД ЗАЛА', -196, 44, 'rgba(154,168,189,.6)', 6.2, 'left');

      /* ценниковая шина: дрейфующие ярлыки над стеллажом */
      var rail = (frame * 0.22) % 270;
      for (var k = 0; k < 3; k++) {
        var tx = -100 + ((k * 90 + rail) % 270);
        c.save();
        c.globalAlpha = 0.45;
        drawRR(c, tx, -122, 28, 10, 3, 'rgba(255,255,255,.07)', 'rgba(121,242,255,.22)');
        label(c, ['акция', 'новинка', 'остаток'][k], tx + 14, -114.5, 'rgba(199,210,229,.85)', 5.6, 'center');
        c.restore();
      }

      /* ПЕРЕДАЧА: карточка подбора едет по проходу к бейджу продавца */
      if (reached(p, 'handoff')) {
        var t = Math.min(1, (p - 208) / 34);
        if (t < 0.8) {
          var ease = t * t * (3 - 2 * t);
          var sx = 20 + (163 - 20) * ease;
          var sy = 18 + (4 - 18) * ease;
          c.save();
          c.globalAlpha = Math.min(1, t / 0.12) * (t > 0.66 ? 1 - (t - 0.66) / 0.14 : 1);
          drawRR(c, sx - 32, sy - 15, 64, 30, 6, 'rgba(121,242,255,.16)', C.pickEdge, 1.4);
          label(c, 'Комплект · 3 SKU', sx, sy - 4, C.white, 6.8, 'center');
          label(c, '91 тыс ₽ · в наличии', sx, sy + 7, '#a5f3fc', 6.2, 'center');
          c.restore();
        }
      }
    };

    /* =========================================================
       BudgetDial — бюджетный лимитер (уникальный объект темы)
       ========================================================= */
    function BudgetDial() { this.y = -50; }
    BudgetDial.prototype.draw = function (c) {
      var p = prgNow();
      var ph = phaseOf(p);
      var t = ph.id === 'task' ? 0 : (ph.id === 'budget' ? Math.min(1, (p - 52) / 34) : 1);

      drawRR(c, -178, -88, 62, 72, 8, 'rgba(255,255,255,.05)', 'rgba(255,255,255,.12)');
      label(c, 'БЮДЖЕТ', -147, -76, 'rgba(199,210,229,.75)', 6.4, 'center');

      /* шкала и ползунок-ограничитель: чем ниже планка, тем короче выдача */
      drawRR(c, -172, -68, 8, 36, 4, 'rgba(255,255,255,.07)', null);
      var knobY = -68 + 36 * (0.1 + t * 0.6);
      c.save();
      c.globalAlpha = 0.45;
      drawRR(c, -172, knobY + 4, 8, Math.max(0, -32 - knobY - 4), 4, 'rgba(121,242,255,.5)', null);
      c.restore();
      drawRR(c, -176, knobY, 16, 4.5, 2.2, C.pickEdge, null);

      var shown = Math.round(140 - (140 - BUDGET_LIMIT) * t);
      label(c, 'до ' + shown, -136, -54, C.white, 8.5, 'center');
      label(c, 'тыс ₽', -136, -43, 'rgba(154,168,189,.9)', 6.2, 'center');
      label(c, t >= 1 ? '7 из 15 SKU' : 'фильтр…', -147, -23, t >= 1 ? '#a5f3fc' : 'rgba(154,168,189,.8)', 6.4, 'center');
    };

    /* =========================================================
       StockBeacon — маячок остатков по контурам (точка/склад/нет)
       ========================================================= */
    function StockBeacon() { this.y = -55; }
    StockBeacon.prototype.draw = function (c) {
      var p = prgNow();
      var active = reached(p, 'stock');
      drawRR(c, 134, -90, 64, 62, 8, 'rgba(255,255,255,.05)', 'rgba(255,255,255,.12)');
      label(c, 'ОСТАТКИ', 166, -78, 'rgba(199,210,229,.75)', 6.4, 'center');

      var rows = [
        { t: 'эта точка', v: '6', col: C.accEdge },
        { t: 'склад 24ч', v: '3', col: C.pickEdge },
        { t: 'нет', v: '1', col: C.goneEdge }
      ];
      for (var i = 0; i < rows.length; i++) {
        var ry = -68 + i * 13;
        var on = active || i === 0;
        c.save();
        c.globalAlpha = on ? 1 : 0.35;
        c.fillStyle = rows[i].col;
        c.beginPath();
        c.arc(142, ry + 2, 2.4 + (active && i === 2 ? Math.abs(Math.sin(frame * 0.08)) * 1.2 : 0), 0, Math.PI * 2);
        c.fill();
        label(c, rows[i].t, 148, ry + 4.5, 'rgba(199,210,229,.9)', 6.2, 'left');
        label(c, active ? rows[i].v : '—', 194, ry + 4.5, C.white, 6.6, 'right');
        c.restore();
      }

      /* луч синхронизации к стеллажу */
      if (active && p < 156) {
        c.save();
        c.strokeStyle = 'rgba(121,242,255,' + (0.55 - ((p - 104) / 52) * 0.35) + ')';
        c.lineWidth = 1.4;
        c.setLineDash([3, 3]);
        c.lineDashOffset = -frame * 0.6;
        c.beginPath();
        c.moveTo(132, -58);
        c.lineTo(120, -58);
        c.stroke();
        c.setLineDash([]);
        c.restore();
      }
    };

    /* =========================================================
       SellerHandoffBadge — бейдж продавца, приёмник эскалации
       ========================================================= */
    function SellerHandoffBadge() { this.y = 52; }
    SellerHandoffBadge.prototype.draw = function (c) {
      var p = prgNow();
      var got = reached(p, 'handoff') && (p - 208) / 34 > 0.68;
      drawRR(c, 126, 26, 74, 44, 10, got ? 'rgba(139,92,246,.26)' : C.badge, C.badgeEdge, got ? 1.7 : 1.1);
      label(c, 'ПРОДАВЕЦ', 163, 40, '#ddd6fe', 6.6, 'center');
      label(c, got ? 'контекст принят' : 'ожидает handoff', 163, 51, got ? '#fff' : 'rgba(199,210,229,.7)', 6.2, 'center');
      label(c, got ? '2,4 сек · CRM #1847' : 'порог уверенности 80%', 163, 62, got ? '#a5f3fc' : 'rgba(154,168,189,.75)', 5.8, 'center');

      if (got) {
        c.save();
        var pulse = ((p - 208) / 34 - 0.68) / 0.32;
        c.strokeStyle = 'rgba(139,92,246,' + (0.7 - pulse * 0.6) + ')';
        c.lineWidth = 2;
        c.beginPath();
        c.arc(163, 48, 26 + pulse * 26, 0, Math.PI * 2);
        c.stroke();
        c.restore();
      }
    };

    /* =========================================================
       TaskChip — реплика клиента, стартовое событие цикла
       ========================================================= */
    function TaskChip() { this.y = 8; }
    TaskChip.prototype.draw = function (c) {
      var p = prgNow();
      var ph = phaseOf(p);
      var alpha = ph.id === 'task' ? Math.min(1, p / 10) : (ph.id === 'budget' ? 1 - Math.min(1, (p - 52) / 10) : 0);
      if (alpha <= 0.02) return;
      c.save();
      c.globalAlpha = alpha;
      drawRR(c, -200, -8, 100, 42, 8, 'rgba(121,242,255,.12)', 'rgba(121,242,255,.5)', 1.4);
      label(c, 'ЗАПРОС КЛИЕНТА', -150, 3, '#a5f3fc', 5.8, 'center');
      label(c, '«Плитка в ванную,', -150, 14, C.white, 7, 'center');
      label(c, 'до 60 тыс, доставка', -150, 23, C.white, 7, 'center');
      label(c, 'на выходные»', -150, 32, C.white, 7, 'center');
      c.fillStyle = 'rgba(121,242,255,.5)';
      c.beginPath();
      c.moveTo(-100, 20); c.lineTo(-92, 25); c.lineTo(-100, 30);
      c.fill();
      c.restore();
    };

    /* =========================================================
       Agent — тип персонажей сохранён по образцу эталона,
       геометрия движения новая: подъём к своей зоне стеллажа
       ========================================================= */
    function Agent(x, y, color, role, stepTrig, dialogs, tool) {
      this.x = x; this.y = y;
      this.baseX = x; this.baseY = y;
      this.color = color; this.role = role;
      this.stepTrig = stepTrig;
      this.dialogs = dialogs;
      this.tool = tool;
      this.timer = Math.random() * 100;
    }

    /* каждый идёт к своей зоне: полка / бюджетный дисплей / бейдж продавца */
    var STATIONS = {
      '1_architect': { x: -58, y: 20 },
      '2_seo':       { x: -147, y: -2 },
      '3_coder':     { x: 22, y: 22 },
      '4_designer':  { x: 96, y: 18 },
      '5_deployer':  { x: 163, y: 92 }
    };

    Agent.prototype.draw = function (c) {
      this.timer += 0.03;
      var p = prgNow();
      var tgt = STATIONS[this.role] || { x: 0, y: 30 };
      var isMoving = false, faceDir = 1, carry = null;
      var span = 30;

      if (p >= this.stepTrig && p < this.stepTrig + span) {
        var local = p - this.stepTrig;
        if (local < 12) {
          /* вертикальный подъём: сначала вбок по проходу, затем к полке */
          var k = local / 12;
          isMoving = true;
          faceDir = tgt.x >= this.baseX ? 1 : -1;
          this.x = this.baseX + (tgt.x - this.baseX) * Math.min(1, k * 1.6);
          this.y = this.baseY + (tgt.y - this.baseY) * (k * k);
          carry = this.color;
        } else if (local < 20) {
          this.x = tgt.x; this.y = tgt.y;
          carry = this.color;
        } else {
          var k2 = (local - 20) / 10;
          isMoving = true;
          faceDir = tgt.x >= this.baseX ? -1 : 1;
          this.x = tgt.x - (tgt.x - this.baseX) * k2;
          this.y = tgt.y - (tgt.y - this.baseY) * Math.min(1, k2 * 1.4);
        }
      } else {
        this.x = this.baseX; this.y = this.baseY;
        carry = p >= this.stepTrig - 10 ? this.color : null;
      }

      if (!isMoving && frame % 210 === 0 && Math.random() < 0.14) {
        createBubble(this.x, this.y - 20, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
      }

      var bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 1.6 : Math.sin(this.timer * 1.4) * 1;

      c.save();
      c.translate(this.x, this.y);
      c.lineJoin = 'round';

      var legL = 0, legR = 0;
      if (isMoving) {
        var walk = this.timer * 6;
        legL = Math.sin(walk) * 4;
        legR = Math.sin(walk + Math.PI) * 4;
      }
      drawRR(c, -7.5, -4 + Math.max(0, legL), 6.5, 11, 2, 'rgba(15,23,42,.95)', 'rgba(148,171,201,.5)');
      drawRR(c, 0.5, -4 + Math.max(0, legR), 6.5, 11, 2, 'rgba(15,23,42,.95)', 'rgba(148,171,201,.5)');
      drawRR(c, -11, -10 - bob, 22, 15, 5, this.color, 'rgba(6,10,24,.9)', 1.2);
      c.fillStyle = this.color;
      c.beginPath();
      c.arc(0, -21 - bob, 8.4, 0, Math.PI * 2);
      c.fill();
      c.lineWidth = 1.2;
      c.strokeStyle = 'rgba(6,10,24,.9)';
      c.stroke();

      /* мини-атрибут роли */
      c.save();
      c.scale(faceDir, 1);
      c.fillStyle = 'rgba(6,10,24,.85)';
      if (this.role === '1_architect') {
        drawRR(c, -9, -31 - bob, 18, 4, 2, 'rgba(6,10,24,.85)', null);      /* кепка мерчандайзера */
      } else if (this.role === '2_seo') {
        drawRR(c, 3, -26 - bob, 8, 6, 1, 'rgba(255,255,255,.8)', null);      /* прайс-лист */
      } else if (this.role === '3_coder') {
        drawRR(c, 2, -25 - bob, 9, 7, 1.5, 'rgba(121,242,255,.85)', null);   /* терминал остатков */
      } else if (this.role === '4_designer') {
        drawRR(c, -10, -28 - bob, 20, 3, 1.5, 'rgba(236,72,153,.95)', null); /* мерч-лента */
      } else if (this.role === '5_deployer') {
        drawRR(c, 3, -27 - bob, 8, 11, 1.5, 'rgba(226,232,240,.9)', 'rgba(6,10,24,.8)'); /* планшет продавца */
      }
      c.restore();

      if (carry) {
        drawRR(c, -16 * faceDir - 4, -16 - bob, 9, 9, 2, carry, 'rgba(6,10,24,.9)');
      }
      c.restore();
    };

    /* ── сборка сцены ── */
    var entities = [];
    var bubbles = [];

    entities.push(new AisleWayfinder());
    entities.push(new ShelfMatrixWall());
    entities.push(new BudgetDial());
    entities.push(new StockBeacon());
    entities.push(new TaskChip());
    entities.push(new SellerHandoffBadge());

    entities.push(new Agent(-176, 80, C.agentYellow, '1_architect', 6, [
      'Атрибуты SKU заполнены',
      'Каталог без описаний — не поедет',
      'Совместимость проверена',
      'PIM синхронизирован'
    ]));
    entities.push(new Agent(-108, 88, C.agentGreen, '2_seo', 56, [
      'Бюджет клиента — 60 тыс',
      'Дороже — не показываем',
      'Осталось 7 позиций',
      'Акция считается в лимит'
    ]));
    entities.push(new Agent(-18, 92, C.agentBlue, '3_coder', 108, [
      '1С отдаёт остатки по точке',
      'Декор — нет на Ленинском',
      'МойСклад: обновление 5 мин',
      'Нет в наличии — не рекомендуем'
    ]));
    entities.push(new Agent(66, 88, C.agentPink, '4_designer', 158, [
      'Клей и затирка в комплект',
      'Кросс-sell по задаче, не по акции',
      'Три варианта с обоснованием',
      'Тон бренда соблюдён'
    ]));
    entities.push(new Agent(146, 104, C.agentPurple, '5_deployer', 210, [
      'Принял подбор с контекстом',
      'Уверенность ниже 80% — беру сам',
      'Резюме диалога в CRM',
      'Клиент уже у полки'
    ]));

    function createBubble(x, y, text, life) {
      bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
    }

    function drawScene() {
      ctx.clearRect(0, 0, cw, ch);
      ctx.save();
      ctx.translate(cx, cy);
      ctx.scale(scale, scale);

      entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
      for (var i = 0; i < entities.length; i++) entities[i].draw(ctx);

      var p = prgNow();
      if (p >= 8 && p < 8.05) createBubble(-148, 62, '1. Задача клиента');
      if (p >= 58 && p < 58.05) createBubble(-112, 64, '2. Фильтр по бюджету');
      if (p >= 110 && p < 110.05) createBubble(-20, 68, '3. Остатки по точке');
      if (p >= 132 && p < 132.05) createBubble(50, 66, 'Нет на точке → замена');
      if (p >= 162 && p < 162.05) createBubble(86, 70, '4. Комплект + кросс-sell');
      if (p >= 214 && p < 214.05) createBubble(140, 96, '5. Контекст продавцу');

      ctx.font = 'bold 9.5px Inter,-apple-system,sans-serif';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'alphabetic';
      for (var j = bubbles.length - 1; j >= 0; j--) {
        var b = bubbles[j];
        b.life--;
        if (b.life <= 0) { bubbles.splice(j, 1); continue; }
        var alpha = Math.min(1, b.life / 25);
        if (b.life > b.maxLife - 8) alpha = (b.maxLife - b.life) / 8;
        ctx.globalAlpha = Math.max(0, alpha);
        var tw = ctx.measureText(b.text).width + 14;
        var by = b.y - (b.maxLife - b.life) * 0.035;
        drawRR(ctx, b.x - tw / 2, by - 20, tw, 17, 5, C.bubbleBg, 'rgba(121,242,255,.45)');
        ctx.fillStyle = '#e2e8f0';
        ctx.fillText(b.text, b.x, by - 8.5);
        ctx.globalAlpha = 1;
      }

      ctx.restore();
    }

    function engineloop() {
      frame++;
      drawScene();
      requestAnimationFrame(engineloop);
    }

    if (reduced) {
      /* статичный кадр на фазе КОМПЛЕКТ, когда все персонажи на своих местах */
      frame = Math.round(196 / 0.04);
      drawScene();
      window.addEventListener('resize', function () { resizeCanvas(); drawScene(); });
      return;
    }

    if (document.fonts && document.fonts.ready) {
      document.fonts.ready.then(engineloop).catch(engineloop);
    } else {
      engineloop();
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
</script>

<script>
(function(){
  document.querySelectorAll('.vapc-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.vapc-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.vapc-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.vapc-faq-q');
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
  var root = document.querySelector('.vnedrenie-ai-prodavets-konsultant-page') || document.querySelector('.vapc-content');
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

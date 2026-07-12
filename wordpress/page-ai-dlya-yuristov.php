<?php
/**
 * Template Name: AI для юристов: внедрение и настройка под ключ
 * Description: AI-помощник для юротдела — проверка договоров, поиск практики, FAQ и база знаний. Внедрение под ключ с human-in-the-loop.
 */

$page_seo_title       = 'AI для юристов: внедрение под ключ для юротдела';
$page_seo_description = 'AI-помощник для юротдела: проверка договоров, поиск практики, типовые консультации и база знаний. Внедрение под ключ с human-in-the-loop и защитой данных. Кейсы и расчёт стоимости.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Зачем AI', 'href' => '#zachem'],
    ['label' => 'Задачи', 'href' => '#zadachi'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'Безопасность', 'href' => '#bezopasnost'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Внедрить AI для юристов';
$primary_cta_url   = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
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

.yl-content{
  --yl-bg:#050711;--yl-bg2:#080b17;--yl-bg3:#0a0e1c;
  --yl-surface:rgba(255,255,255,.072);--yl-surface2:rgba(255,255,255,.108);
  --yl-text:#e6edf7;--yl-muted:#9aa8bd;--yl-soft:#c7d2e5;--yl-heading:#fff;
  --yl-border:rgba(255,255,255,.10);--yl-border-s:rgba(255,255,255,.18);
  --yl-primary:#79f2ff;--yl-violet:#8b5cf6;--yl-green:#22c55e;--yl-amber:#f59e0b;
  --yl-btn-from:#0891b2;--yl-btn-to:#8b5cf6;
  --yl-shadow:0 24px 72px rgba(0,0,0,.4);
  --yl-r:18px;--yl-r-lg:24px;--yl-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--yl-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.yl-content *,.yl-content *::before,.yl-content *::after{box-sizing:border-box;}
.yl-content a{color:inherit;}
.yl-content p{color:var(--yl-muted);line-height:1.72;margin:0 0 1em;}
.yl-content p:last-child{margin-bottom:0;}
.yl-content h2,.yl-content h3,.yl-content h4{color:var(--yl-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.yl-content strong{color:var(--yl-soft);}
.yl-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.yl-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--yl-muted);font-size:14.5px;line-height:1.65;}
.yl-content ul li::before{content:'›';position:absolute;left:0;color:var(--yl-primary);font-weight:700;}
.yl-content ol{padding-left:1.2em;margin:0 0 1em;color:var(--yl-muted);}
.yl-content ol li{margin-bottom:.45em;font-size:14.5px;line-height:1.65;}
.yl-cnt{width:min(var(--yl-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.yl-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.yl-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.yl-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.yl-sh.yl-left{margin-left:0;text-align:left;}
.yl-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.yl-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.yl-sh.yl-left p{margin-left:0;}
.yl-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--yl-primary);margin-bottom:14px;}
.yl-gt{background:linear-gradient(92deg,#fff 0%,var(--yl-primary) 44%,var(--yl-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.yl-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.yl-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.yl-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.yl-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--yl-primary),var(--yl-violet));}
.yl-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--yl-muted);margin-bottom:1em;}
.yl-intro-text p:last-child{margin-bottom:0;color:var(--yl-soft);}
.yl-intro-deco{display:grid;gap:10px;}
.yl-term{background:rgba(255,255,255,.05);border:1px solid rgba(121,242,255,.18);border-radius:14px;padding:14px 16px;font-family:ui-monospace,monospace;font-size:12px;color:var(--yl-soft);line-height:1.6;}
.yl-term .yl-term-line{color:var(--yl-primary);}
.yl-chips{display:flex;flex-wrap:wrap;gap:8px;margin-top:10px;}
.yl-chip{padding:6px 12px;border-radius:999px;font-size:11px;font-weight:700;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.05);color:var(--yl-muted);}
.yl-chip--c{color:var(--yl-primary);border-color:rgba(121,242,255,.28);}
.yl-chip--g{color:var(--yl-green);border-color:rgba(34,197,94,.28);}
.yl-chip--v{color:#c4b5fd;border-color:rgba(139,92,246,.28);}
@media(max-width:900px){.yl-intro-grid{grid-template-columns:1fr;gap:36px;}}
.yl-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.yl-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.yl-toc a{display:inline-block;padding:9px 18px;background:var(--yl-surface);border:1px solid var(--yl-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--yl-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.yl-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--yl-primary);background:rgba(121,242,255,.08);}
.yl-kpi-row{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:28px 0;}
@media(max-width:768px){.yl-kpi-row{grid-template-columns:1fr;}}
.yl-kpi{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:var(--yl-r);padding:22px;text-align:center;}
.yl-kpi .kv{font-size:clamp(28px,3.5vw,38px);font-weight:900;color:var(--yl-heading);letter-spacing:-.04em;line-height:1;margin-bottom:6px;}
.yl-kpi .kl{font-size:13px;font-weight:600;color:var(--yl-muted);}
.yl-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--yl-border);border-radius:var(--yl-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.yl-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.yl-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.yl-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.yl-grid-2,.yl-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.yl-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.yl-grid-3{grid-template-columns:1fr;}}
.yl-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--yl-r);padding:26px;margin-bottom:14px;}
.yl-scenario:last-child{margin-bottom:0;}
.yl-scenario h3{font-size:17px;margin-bottom:8px;}
.yl-scenario p{font-size:14.5px;margin:0 0 .6em;}
.yl-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.yl-table{width:100%;border-collapse:collapse;font-size:14px;}
.yl-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--yl-primary);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.yl-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--yl-text);vertical-align:top;}
.yl-table tr:last-child td{border-bottom:none;}
.yl-table tr:hover td{background:rgba(255,255,255,.03);}
.yl-timeline{position:relative;padding-left:40px;}
.yl-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--yl-primary),var(--yl-violet));opacity:.35;border-radius:2px;}
.yl-tl-item{position:relative;margin-bottom:32px;}
.yl-tl-item:last-child{margin-bottom:0;}
.yl-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--yl-primary);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.yl-tl-item h3{font-size:17px;margin-bottom:8px;}
.yl-tl-item p{font-size:14.5px;margin:0;}
.yl-highlight{background:linear-gradient(135deg,rgba(121,242,255,.1),rgba(139,92,246,.08));border:1px solid rgba(121,242,255,.25);border-radius:var(--yl-r);padding:24px;margin:24px 0;}
.yl-highlight h3{font-size:18px;margin-bottom:10px;color:var(--yl-primary);}
.yl-pills{display:flex;flex-wrap:wrap;gap:8px;margin:16px 0;}
.yl-pill{padding:6px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.25);color:var(--yl-green);}
.yl-split{display:grid;grid-template-columns:1fr 1fr;gap:24px;}
@media(max-width:768px){.yl-split{grid-template-columns:1fr;}}
.yl-callout{background:rgba(251,191,36,.08);border:1px solid rgba(251,191,36,.25);border-radius:var(--yl-r);padding:20px 24px;margin:20px 0;}
.yl-callout h4{color:#fde68a;margin-bottom:8px;font-size:15px;}
.yl-case-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;}
@media(max-width:768px){.yl-case-grid{grid-template-columns:1fr;}}
.yl-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.yl-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.yl-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--yl-green);margin-bottom:10px;}
.yl-case-card h3{font-size:16px;margin-bottom:10px;}
.yl-flow{display:grid;grid-template-columns:repeat(6,1fr);gap:8px;margin:24px 0;}
@media(max-width:900px){.yl-flow{grid-template-columns:repeat(3,1fr);}}
@media(max-width:500px){.yl-flow{grid-template-columns:1fr 1fr;}}
.yl-flow-step{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:14px 10px;text-align:center;font-size:12px;color:var(--yl-muted);}
.yl-flow-step strong{display:block;color:var(--yl-primary);font-size:11px;margin-bottom:4px;}
.yl-stack-chips{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px;}
.yl-stack-chip{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(139,92,246,.1);border:1px solid rgba(139,92,246,.25);color:#c4b5fd;}
.yl-steps-num{counter-reset:ylstep;display:flex;flex-direction:column;gap:16px;margin:24px 0;}
.yl-step-num{display:grid;grid-template-columns:40px 1fr;gap:16px;align-items:start;}
.yl-step-num::before{counter-increment:ylstep;content:counter(ylstep);display:grid;place-items:center;width:40px;height:40px;border-radius:50%;background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.3);color:var(--yl-primary);font-weight:800;font-size:16px;}
.yl-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.yl-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.yl-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--yl-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.yl-faq-q::after{content:'▾';font-size:13px;color:var(--yl-primary);flex-shrink:0;transition:transform .25s;}
.yl-faq-item.open .yl-faq-q::after{transform:rotate(180deg);}
.yl-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--yl-muted);line-height:1.72;}
.yl-faq-item.open .yl-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border:1px solid rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--yl-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--yl-btn-from),var(--yl-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(8,145,178,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--yl-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--yl-primary)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.yl-hero-yuristy{min-height:100dvh;position:relative;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlya-yuristov-page" role="main" tabindex="-1">


<section class="nero-ai-hero yl-hero-yuristy" id="hero" aria-labelledby="yl-hero-title">
<style>
/* === HERO yl-hero-yuristy — самодостаточные стили === */
.yl-hero-yuristy {
  --yl-primary: #79f2ff;
  --yl-violet: #8b5cf6;
  --yl-green: #22c55e;
  --yl-text: #e6edf7;
  --yl-muted: #9aa8bd;
  --yl-soft: #c7d2e5;
  --yl-border: rgba(255,255,255,.10);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  font-family: Inter, system-ui, -apple-system, sans-serif;
  color: var(--yl-text);
}
.yl-hero-yuristy::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 40% 28%, #000 0%, transparent 72%);
  opacity: .5;
  pointer-events: none;
  z-index: 0;
}
.yl-hero-yuristy::after {
  content: "";
  position: absolute;
  left: 30%;
  top: 12%;
  width: 720px;
  height: 720px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(121,242,255,.10), transparent 66%);
  filter: blur(8px);
  pointer-events: none;
  z-index: 0;
}
.yl-hero-yuristy .yl-hero-cnt {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.yl-hero-yuristy .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(340px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.yl-hero-yuristy .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121,242,255,.2);
  border-radius: 999px;
  background: rgba(121,242,255,.08);
  color: var(--yl-primary);
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: .11em;
}
.yl-hero-yuristy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(40px, 6.5vw, 82px);
  line-height: .92;
  letter-spacing: -.06em;
  color: #fff;
  font-weight: 800;
}
.yl-hero-yuristy .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--yl-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.yl-hero-yuristy .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--yl-soft);
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.yl-hero-yuristy .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 24px 0 0;
  padding: 0;
  list-style: none;
}
.yl-hero-yuristy .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 12px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 12.5px;
  font-weight: 700;
  white-space: nowrap;
}
.yl-hero-yuristy .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 32px;
}
.yl-hero-yuristy .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 22px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  text-decoration: none !important;
  transition: transform .22s ease, box-shadow .22s ease;
}
.yl-hero-yuristy .nero-ai-btn:hover { transform: translateY(-2px); }
.yl-hero-yuristy .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--yl-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121,242,255,.22);
}
.yl-hero-yuristy .nero-ai-btn-secondary {
  color: var(--yl-text) !important;
  background: rgba(255,255,255,.07);
  border-color: rgba(255,255,255,.14);
}
.yl-hero-yuristy .nero-ai-dashboard {
  position: relative;
  padding: 16px;
  border-radius: 32px;
  background: rgba(2,6,23,.42);
  box-shadow: 0 24px 72px rgba(0,0,0,.45);
  transform: perspective(1100px) rotateY(-2deg) rotateX(1.5deg);
}
.yl-hero-yuristy .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 24px;
  background: linear-gradient(180deg, rgba(15,23,42,.95), rgba(6,10,24,.96));
}
.yl-hero-yuristy .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 12px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.yl-hero-yuristy .nero-ai-dots { display: flex; gap: 7px; }
.yl-hero-yuristy .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.yl-hero-yuristy .nero-ai-dot:nth-child(1) { background: #fb7185; }
.yl-hero-yuristy .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.yl-hero-yuristy .nero-ai-dot:nth-child(3) { background: #34d399; }
.yl-hero-yuristy .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.yl-hero-yuristy .nero-ai-window-body { padding: 16px; }
.yl-hero-yuristy .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 12px;
}
.yl-hero-yuristy .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 17px;
  color: #fff;
  letter-spacing: -.02em;
}
.yl-hero-yuristy .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
}
.yl-hero-yuristy .nero-ai-live-pill::before {
  content: "";
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 5px rgba(34,197,94,.12);
  animation: yl-pulse 1.6s infinite;
}
@keyframes yl-pulse { 0%,100%{opacity:.6;transform:scale(.9)} 50%{opacity:1;transform:scale(1)} }
.yl-hero-yuristy .yl-legal-canvas-wrap {
  position: relative;
  height: clamp(150px, 22vw, 200px);
  margin-bottom: 14px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.08);
  background: linear-gradient(145deg, #07091a 0%, #0d1224 55%, #090d1f 100%);
}
#yl-legal-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.yl-hero-yuristy .yl-stage-pills {
  position: absolute;
  left: 10px;
  right: 10px;
  bottom: 8px;
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  justify-content: center;
  z-index: 2;
  pointer-events: none;
}
.yl-hero-yuristy .yl-stage-pill {
  padding: 5px 10px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 700;
  color: #dce8f7;
  background: rgba(15,23,42,.82);
  border: 1px solid rgba(121,242,255,.22);
  backdrop-filter: blur(6px);
}
.yl-hero-yuristy .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
}
.yl-hero-yuristy .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 14px;
  background: rgba(255,255,255,.05);
}
.yl-hero-yuristy .nero-ai-metric span {
  display: block;
  color: var(--yl-muted);
  font-size: 11px;
  font-weight: 700;
}
.yl-hero-yuristy .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.yl-hero-yuristy .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 10px;
}
.yl-hero-yuristy .nero-ai-task-stream {
  margin-top: 12px;
  display: grid;
  gap: 8px;
}
.yl-hero-yuristy .nero-ai-task {
  display: grid;
  grid-template-columns: 26px 1fr auto;
  align-items: center;
  gap: 8px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.yl-hero-yuristy .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 26px;
  height: 26px;
  border-radius: 10px;
  background: rgba(121,242,255,.12);
  color: var(--yl-primary);
  font-size: 10px;
  font-weight: 800;
}
.yl-hero-yuristy .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.yl-hero-yuristy .nero-ai-task span {
  color: var(--yl-muted);
  font-size: 11px;
}
.yl-hero-yuristy .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.yl-hero-yuristy .nero-ai-status--wait {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
@media (max-width: 960px) {
  .yl-hero-yuristy .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .yl-hero-yuristy .nero-ai-dashboard { transform: none; }
}
</style>

  <div class="yl-hero-cnt nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai для юристов</p>
      <h1 id="yl-hero-title">AI для юристов: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Снимаем рутину с юротдела: типовые вопросы, поиск практики и проверка договоров — с AI-помощником, базой знаний и контролем конфиденциальности</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Проверка договоров</li>
        <li class="nero-ai-badge">Поиск практики</li>
        <li class="nero-ai-badge">FAQ по ЛНА</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">On-prem</li>
        <li class="nero-ai-badge">СЭД</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#zachem">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо: AI для юротдела">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">юротдел · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-пульт юротдела</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>

          <div class="yl-legal-canvas-wrap" aria-hidden="true">
            <canvas id="yl-legal-hero-canvas" role="img" aria-label="Анимация: договор проходит RAG-поиск, чек-лист рисков и утверждение юристом"></canvas>
            <div class="yl-stage-pills">
              <span class="yl-stage-pill">Аудит рутины</span>
              <span class="yl-stage-pill">RAG и чек-лист</span>
              <span class="yl-stage-pill">Верификация рисков</span>
              <span class="yl-stage-pill">Утверждение юристом</span>
            </div>
          </div>

          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Договоров / час</span><strong>12</strong><small>первичный разбор</small></div>
            <div class="nero-ai-metric"><span>Практика</span><strong>×3</strong><small>ускорение поиска</small></div>
            <div class="nero-ai-metric"><span>FAQ авто</span><strong>85%</strong><small>типовых ответов</small></div>
            <div class="nero-ai-metric"><span>Рутина</span><strong>−30%</strong><small>время юристов</small></div>
          </div>

          <div class="nero-ai-task-stream">
            <div class="nero-ai-task"><span class="nero-ai-task-icon">DOC</span><div><strong>Договор загружен</strong><span>поставка оборудования</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Риски по чек-листу</strong><span>3 пункта средний риск</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">RAG</span><div><strong>Практика: 14 решений</strong><span>Гарант · внутр. регламент</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">HITL</span><div><strong>Юристу на утверждение</strong><span>черновик заключения</span></div><span class="nero-ai-status nero-ai-status--wait">ожидает</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function(){
  var canvas = document.getElementById('yl-legal-hero-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var p = canvas.parentElement;
    if (!p) return;
    canvas.width = p.clientWidth || 400;
    canvas.height = p.clientHeight || 180;
    cw = canvas.width; ch = canvas.height;
    cx = cw / 2; cy = ch / 2 + 8;
    scale = Math.min(cw / 520, ch / 200) * 1.15;
  }
  window.addEventListener('resize', resizeCanvas);
  resizeCanvas();

  var C = {
    outline: '#94a3b8',
    cyan: '#79f2ff',
    violet: '#8b5cf6',
    green: '#22c55e',
    amber: '#fbbf24',
    red: '#f87171',
    panel: '#1e293b',
    panelLight: '#334155',
    doc: '#f8fafc',
    seal: '#dc2626',
    agentYellow: '#eab308',
    agentGreen: '#10b981',
    agentBlue: '#3b82f6',
    agentPink: '#ec4899',
    agentPurple: '#8b5cf6',
    bubbleBg: 'rgba(15,23,42,.92)'
  };

  function roundRect(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) { ctx.lineWidth = 1.5; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  /* Дугообразный поток пунктов — вместо Conveyor */
  class ClausePipeline {
    constructor() {
      this.items = [
        { offset: 0, color: C.doc, label: '§' },
        { offset: 80, color: '#dbeafe', label: '§' },
        { offset: 160, color: '#fef3c7', label: '§' }
      ];
    }
    draw(ctx) {
      ctx.save();
      ctx.strokeStyle = 'rgba(121,242,255,.25)';
      ctx.lineWidth = 2;
      ctx.setLineDash([6, 8]);
      ctx.beginPath();
      ctx.moveTo(-220, 30);
      ctx.quadraticCurveTo(0, -50, 220, 30);
      ctx.stroke();
      ctx.setLineDash([]);
      var spd = frame * 0.35;
      this.items.forEach(function(it) {
        var t = ((spd + it.offset) % 280) / 280;
        var px = -220 + t * 440;
        var py = 30 - Math.sin(t * Math.PI) * 55;
        roundRect(ctx, px - 10, py - 12, 20, 24, 3, it.color, C.outline);
        ctx.fillStyle = C.outline;
        ctx.font = 'bold 9px Inter,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText(it.label, px, py + 3);
      });
      ctx.restore();
    }
  }

  /* Центральная консоль верификации — вместо WebsiteTerminal */
  class VerificationConsole {
    constructor(x, y) { this.x = x; this.y = y; this.phase = 0; }
    draw(ctx) {
      this.phase = (frame * 0.04) % 240;
      var wx = this.x - 70, wy = this.y - 55, ww = 140, wh = 110;
      roundRect(ctx, wx - 6, wy - 6, ww + 12, wh + 12, 8, C.panel, C.cyan);
      roundRect(ctx, wx, wy, ww, wh, 6, '#0f172a', C.outline);
      roundRect(ctx, wx, wy, ww, 18, [6,6,0,0], C.panelLight, null);
      ctx.fillStyle = C.cyan;
      ctx.font = 'bold 8px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText('VERIFICATION CONSOLE', wx + 8, wy + 12);

      if (this.phase < 60) {
        roundRect(ctx, wx + 10, wy + 28, ww - 20, 16, 2, C.doc, C.outline);
        ctx.fillStyle = '#94a3b8';
        ctx.fillText('Загрузка договора…', wx + 14, wy + 39);
      } else if (this.phase < 120) {
        for (var i = 0; i < 4; i++) {
          roundRect(ctx, wx + 10, wy + 26 + i * 14, 50 + i * 12, 8, 1, 'rgba(121,242,255,.2)', null);
        }
        ctx.fillStyle = C.cyan;
        ctx.fillText('RAG: 14 источников', wx + 10, wy + 88);
      } else if (this.phase < 180) {
        roundRect(ctx, wx + 10, wy + 28, ww - 20, 50, 3, '#1e1b4b', C.violet);
        roundRect(ctx, wx + 16, wy + 36, 40, 6, 1, C.amber, null);
        roundRect(ctx, wx + 16, wy + 48, 55, 6, 1, C.red, null);
        roundRect(ctx, wx + 16, wy + 60, 30, 6, 1, C.green, null);
        ctx.fillStyle = '#fde68a';
        ctx.fillText('3 риска · чек-лист', wx + 10, wy + 88);
      } else if (this.phase < 220) {
        roundRect(ctx, wx + 20, wy + 32, ww - 40, 44, 4, C.doc, C.outline);
        ctx.fillStyle = C.outline;
        ctx.font = '7px Inter,sans-serif';
        ctx.fillText('Черновик заключения', wx + 26, wy + 48);
        ctx.fillStyle = C.amber;
        ctx.fillText('→ юристу', wx + 26, wy + 62);
      } else {
        ctx.save();
        ctx.translate(wx + ww/2, wy + 55);
        ctx.fillStyle = C.seal;
        ctx.beginPath(); ctx.arc(0, 0, 18, 0, Math.PI * 2); ctx.fill();
        ctx.strokeStyle = '#fff'; ctx.lineWidth = 2; ctx.stroke();
        ctx.fillStyle = '#fff';
        ctx.font = 'bold 7px Inter,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('УТВЕРЖДЕНО', 0, 3);
        ctx.restore();
      }
    }
  }

  class CitationArchive {
    draw(ctx) {
      var ax = -175, ay = -20;
      for (var s = 0; s < 3; s++) {
        roundRect(ctx, ax + s * 4, ay - s * 8, 28, 36, 2, '#e2e8f0', C.outline);
      }
      if (frame % 240 > 55 && frame % 240 < 125) {
        ctx.fillStyle = C.green;
        ctx.font = 'bold 8px Inter,sans-serif';
        ctx.textAlign = 'left';
        ctx.fillText('14 реш.', ax + 34, ay + 4);
      }
    }
  }

  class ComplianceVault {
    draw(ctx) {
      var vx = 155, vy = 10;
      roundRect(ctx, vx, vy, 36, 44, 4, C.panel, C.cyan);
      roundRect(ctx, vx + 14, vy + 18, 8, 12, 2, C.cyan, null);
      var glow = 0.3 + Math.sin(frame * 0.08) * 0.15;
      ctx.strokeStyle = 'rgba(121,242,255,' + glow + ')';
      ctx.lineWidth = 2;
      ctx.strokeRect(vx - 2, vy - 2, 40, 48);
    }
  }

  class HumanApprovalGate {
    draw(ctx) {
      var gx = 120, gy = -35;
      ctx.strokeStyle = 'rgba(251,191,36,.5)';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(gx, gy + 40); ctx.lineTo(gx, gy); ctx.lineTo(gx + 40, gy);
      ctx.stroke();
      var prg = (frame * 0.04) % 240;
      if (prg >= 180 && prg < 220) {
        roundRect(ctx, gx + 8, gy + 12, 24, 18, 2, C.amber, C.outline);
        ctx.fillStyle = '#451a03';
        ctx.font = 'bold 7px Inter,sans-serif';
        ctx.fillText('HITL', gx + 14, gy + 24);
      }
    }
  }

  class Agent {
    constructor(x, y, color, role, orbitAngle, dialogs) {
      this.baseX = x; this.baseY = y;
      this.x = x; this.y = y;
      this.color = color; this.role = role;
      this.orbitAngle = orbitAngle;
      this.dialogs = dialogs;
      this.timer = Math.random() * 100;
    }
    draw(ctx) {
      this.timer += 0.04;
      var prg = (frame * 0.04) % 240;
      var orbitR = 95 + (this.role === '3_coder' ? 0 : 12);
      var active = prg > 20 && prg < 210;
      if (active) {
        var ang = this.orbitAngle + frame * 0.012;
        this.x = Math.cos(ang) * orbitR;
        this.y = Math.sin(ang) * 0.45 * orbitR - 10;
      } else {
        this.x = this.baseX; this.y = this.baseY;
      }
      if (!active && frame % 180 === 0 && Math.random() < 0.12) {
        var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
        createBubble(this.x, this.y - 18, rnd, 220);
      }
      var bob = Math.sin(this.timer * 1.8) * 1.5;
      ctx.save();
      ctx.translate(this.x, this.y);
      roundRect(ctx, -12, -8 + bob, 24, 16, 5, this.color, C.outline);
      ctx.fillStyle = this.color;
      ctx.beginPath(); ctx.arc(0, -16 - bob, 9, 0, Math.PI * 2); ctx.fill();
      ctx.strokeStyle = C.outline; ctx.lineWidth = 1.5; ctx.stroke();
      ctx.fillStyle = '#fff';
      ctx.beginPath(); ctx.arc(3, -17 - bob, 2.5, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(-3, -17 - bob, 2.5, 0, Math.PI * 2); ctx.fill();
      ctx.restore();
    }
  }

  var entities = [];
  var bubbles = [];
  entities.push(new ClausePipeline());
  entities.push(new CitationArchive());
  entities.push(new ComplianceVault());
  entities.push(new HumanApprovalGate());
  entities.push(new VerificationConsole(0, -5));
  entities.push(new Agent(-150, 45, C.agentYellow, '1_architect', 0.2, ['Карта рутины готова', 'Шаблон договора загружен', 'Аудит процессов…']));
  entities.push(new Agent(-60, 55, C.agentGreen, '2_seo', 1.4, ['14 решений из практики', 'СПС: ссылки добавлены', 'НПА актуальны']));
  entities.push(new Agent(30, 50, C.agentBlue, '3_coder', 2.8, ['RAG проиндексирован', 'Промпт с citations', 'Чек-лист рисков v2']));
  entities.push(new Agent(100, 48, C.agentPink, '4_designer', 4.2, ['3 пункта — средний риск', 'Черновик заключения', 'Спорный §7 подсвечен']));
  entities.push(new Agent(160, 42, C.agentPurple, '5_deployer', 5.6, ['Журнал аудита записан', 'On-prem контур OK', 'Передано юристу']));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, maxLife: life });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);
    entities.sort(function(a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function(e) { e.draw(ctx); });

    var prg = (frame * 0.04) % 240;
    if (prg >= 8 && prg < 8.05) createBubble(-140, -10, '1. Договор в консоль', 200);
    if (prg >= 68 && prg < 68.05) createBubble(-40, -30, '2. RAG: практика', 200);
    if (prg >= 128 && prg < 128.05) createBubble(50, -25, '3. Риски по чек-листу', 200);
    if (prg >= 188 && prg < 188.05) createBubble(110, -40, '4. Human-in-the-loop', 200);
    if (prg >= 228 && prg < 228.05) createBubble(0, -60, '5. Печать в архив', 200);

    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'center';
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      roundRect(ctx, b.x - tw/2, b.y - 18, tw, 18, 5, C.bubbleBg, C.cyan);
      ctx.fillStyle = '#e2e8f0';
      ctx.fillText(b.text, b.x, b.y - 6);
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
})();
</script>

<div class="yl-content">

<section class="yl-intro" id="intro">
  <div class="yl-cnt">
    <div class="yl-intro-grid nero-ai-reveal">
      <div class="yl-intro-text">
        <p><strong>Коротко:</strong> AI для юристов — это не «робот-адвокат», а внедряемый помощник для рутины: проверка договоров, поиск практики, FAQ по регламентам и база знаний. Nero Network настраивает такие системы под ключ — с human-in-the-loop, защитой данных и интеграцией в ваши процессы.</p>
        <p>Юридический отдел в 2026 году живёт в парадоксе: <strong>88% юристов уже используют ИИ</strong> (опрос 500+ респондентов, Авито × Право.ru, ноябрь 2025), но только <strong>25% компаний</strong> дают корпоративный доступ к безопасным инструментам. Остальные работают в «теневом» режиме — копируют договоры в ChatGPT, ищут практику в публичных чатах, рискуя конфиденциальностью.</p>
      </div>
      <div class="yl-intro-deco" aria-hidden="true">
        <div class="yl-term">
          <span class="yl-term-line">$ legal_ops --audit</span><br>
          → договоры · FAQ · research<br>
          → risk_matrix · HITL · on-prem
        </div>
        <div class="yl-chips">
          <span class="yl-chip yl-chip--c">88% юристов</span>
          <span class="yl-chip yl-chip--v">25% корп. доступ</span>
          <span class="yl-chip yl-chip--g">23% автоматизируемо</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="yl-toc-outer">
  <div class="yl-cnt">
    <nav class="yl-toc nero-ai-reveal" aria-label="Оглавление страницы">
      <a href="#zachem">Зачем AI</a>
      <a href="#zadachi">Задачи</a>
      <a href="#etapy">Внедрение</a>
      <a href="#ceny">Стоимость</a>
      <a href="#bezopasnost">Безопасность</a>
      <a href="#komu">Кому подходит</a>
      <a href="#keisy">Кейсы</a>
      <a href="#integracii">Интеграции</a>
      <a href="#faq">FAQ</a>
    </nav>
  </div>
</div>

<section class="yl-section" id="zachem">
  <div class="yl-cnt">
    <div class="yl-sh nero-ai-reveal">
      <span class="yl-eyebrow">Контекст 2026</span>
      <h2>Зачем юротделу <span class="yl-gt">AI-помощник</span></h2>
      <p>Типовая рутина, verification gap и почему «голый чат-бот» не подходит регулируемой функции.</p>
    </div>

    <div class="yl-kpi-row nero-ai-reveal nero-ai-delay-1">
      <div class="yl-kpi"><div class="kv">88%</div><div class="kl">юристов уже используют ИИ</div></div>
      <div class="yl-kpi"><div class="kv">25%</div><div class="kl">компаний дают корп. доступ</div></div>
      <div class="yl-kpi"><div class="kv">23%</div><div class="kl">типовых задач автоматизируемо</div></div>
    </div>

    <div class="yl-grid-2 nero-ai-reveal nero-ai-delay-2">
      <div class="yl-card">
        <h3>Типовая рутина: вопросы, практика, договоры</h3>
        <p><strong>Определение:</strong> AI для юридического отдела — набор модулей (RAG-помощник, нормоконтроль договоров, поиск практики, FAQ-бот, compliance-чеклисты), который снимает повторяющуюся нагрузку с юристов, оставляя за человеком финальную позицию.</p>
        <ul>
          <li><strong>Типовые внутренние вопросы</strong> — очередь к юристам растёт быстрее штата</li>
          <li><strong>Поиск судебной практики и НПА</strong> — 57% юристов называют анализ информации главной задачей для ИИ</li>
          <li><strong>Первичная проверка договоров</strong> — 39% уже используют ИИ, но без корпоративного контура это хаос</li>
        </ul>
      </div>
      <div class="yl-card">
        <h3>Почему «голый чат-бот» не подходит</h3>
        <p>Исследование arxiv <strong>2605.14675</strong> (2026) фиксирует <strong>verification gap</strong>: production блокирует отсутствие механизмов верификации вывода.</p>
        <ul>
          <li><strong>84%</strong> юристов боятся недостоверности ответов ИИ</li>
          <li><strong>80%</strong> требуют обязательной перепроверки</li>
          <li><strong>77%</strong> — утечки конфиденциальной информации</li>
        </ul>
        <p><strong>Итог:</strong> в 2026 году вопрос не «нужен ли AI юротделу», а «как внедрить его безопасно и с измеримым ROI».</p>
      </div>
    </div>
  </div>
</section>

<section class="yl-section yl-section-alt" id="zadachi">
  <div class="yl-cnt">
    <div class="yl-sh nero-ai-reveal">
      <span class="yl-eyebrow">Сценарии</span>
      <h2>Какие задачи решает <span class="yl-gt">AI для юристов</span></h2>
      <p>Карта сценариев с уровнем риска и необходимым контролем — основа для пилота.</p>
    </div>

    <div class="yl-table-wrap nero-ai-reveal">
      <table class="yl-table">
        <thead>
          <tr><th>Сценарий</th><th>Что делает AI</th><th>Уровень риска</th><th>Контроль</th></tr>
        </thead>
        <tbody>
          <tr><td>Первичная проверка типового договора</td><td>Риски по чек-листу, подсветка спорных пунктов</td><td>Низкий–средний</td><td>Авто для сумм до порога; юрист для высоких</td></tr>
          <tr><td>Поиск судебной практики и НПА</td><td>RAG по СПС и внутренней базе, ответы со ссылками</td><td>Средний</td><td>Обязательная верификация источников</td></tr>
          <tr><td>FAQ по внутренним регламентам</td><td>Ответы по ЛНА, политикам, шаблонам</td><td>Низкий</td><td>Эскалация нестандартных кейсов</td></tr>
          <tr><td>Compliance-чеклисты</td><td>Проверка соответствия процедурам</td><td>Средний–высокий</td><td>Human-in-the-loop на финале</td></tr>
          <tr><td>Черновики претензий и заключений</td><td>Генерация по шаблонам</td><td>Средний</td><td>Юрист правит и подписывает</td></tr>
          <tr><td>Мониторинг изменений законодательства</td><td>Дайджесты, алерты</td><td>Низкий</td><td>Ручной отбор релевантных норм</td></tr>
          <tr><td>Клиентский первичный приём (юрфирма)</td><td>Квалификация запроса, маршрутизация</td><td>Низкий</td><td>Юрист ведёт переговоры</td></tr>
        </tbody>
      </table>
    </div>

    <div class="yl-grid-3 nero-ai-reveal nero-ai-delay-1">
      <div class="yl-scenario">
        <h3>Первичный разбор и проверка договоров</h3>
        <p>Кейс <strong>Systeme Electric + Directum</strong>: нормоконтроль ускорил проверку с <strong>30 до 5 минут</strong> (×6), эквивалент <strong>2 FTE</strong> на ~400 000 договоров в год.</p>
        <p><strong>Русклимат + Embedika:</strong> 75 → 39 минут (~×2), 32 типа отраслевых рисков, тестовый контур только во внутренней сети.</p>
      </div>
      <div class="yl-scenario">
        <h3>Поиск судебной практики и НПА</h3>
        <p><strong>Яндекс Нейроюрист</strong>: ускорение поиска <strong>×3</strong>, работы с договорами <strong>×1,5</strong>; 86% ответов с хорошей оценкой. Nero Network собирает RAG под ваши шаблоны и регламенты.</p>
      </div>
      <div class="yl-scenario">
        <h3>FAQ и compliance-чеклисты</h3>
        <p>Кейс <strong>ЕВРАЗ + ПравоТех</strong>: чат-бот для ~60 000 сотрудников — <strong>85%</strong> типовых документов автоматически, затраты времени юристов <strong>−30%</strong>, доступ <strong>24/7</strong>.</p>
      </div>
    </div>
  </div>
</section>

<section id="ai-dlya-yuristov-boris-block" class="bly-root" aria-label="Анимация: AI проверяет договор по чек-листу рисков и маршрутизирует на утверждение юристу">
<style>
/* === БОРИС: prefix bly-, scoped внутри #ai-dlya-yuristov-boris-block === */
#ai-dlya-yuristov-boris-block.bly-root{
  padding:clamp(48px,6vw,72px) 0;
  background:#f0f4fb;
}
#ai-dlya-yuristov-boris-block .bly-cnt{
  width:min(1160px,calc(100% - 40px));
  margin:0 auto;
}
#ai-dlya-yuristov-boris-block .bly-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 48px rgba(5,7,17,.12),0 0 0 1px rgba(121,242,255,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-dlya-yuristov-boris-block .bly-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-dlya-yuristov-boris-block .bly-lft{
  padding:clamp(32px,4vw,44px) clamp(24px,3vw,40px);
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-dlya-yuristov-boris-block .bly-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
  }
}
#ai-dlya-yuristov-boris-block .bly-ey{
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
#ai-dlya-yuristov-boris-block .bly-ey::before{
  content:'';
  width:18px;height:2px;
  background:linear-gradient(90deg,#79f2ff,#8b5cf6);
  border-radius:1px;
}
#ai-dlya-yuristov-boris-block .bly-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
  letter-spacing:-.03em;
}
#ai-dlya-yuristov-boris-block .bly-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-dlya-yuristov-boris-block .bly-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.55;
  color:#334155;
}
#ai-dlya-yuristov-boris-block .bly-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(121,242,255,.12);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0891b2;
  margin-top:1px;
  font-style:normal;
}
#ai-dlya-yuristov-boris-block .bly-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-dlya-yuristov-boris-block .bly-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-dlya-yuristov-boris-block .bly-pl-c{
  background:rgba(121,242,255,.1);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.28);
}
#ai-dlya-yuristov-boris-block .bly-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-dlya-yuristov-boris-block .bly-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-dlya-yuristov-boris-block .bly-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-dlya-yuristov-boris-block .bly-rgt{
  position:relative;
  background:linear-gradient(145deg,#050711 0%,#0a0e1c 55%,#080b17 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-dlya-yuristov-boris-block .bly-rgt{min-height:380px;}
}
#bly-legal-verify-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bly-cnt">
  <div class="bly-card">

    <div class="bly-lft">
      <span class="bly-ey">Human-in-the-loop</span>
      <h3 class="bly-h3">Договор проходит AI-сканирование — финальное «да» остаётся за юристом</h3>
      <ul class="bly-ul">
        <li><span class="bly-ic">§</span>AI подсвечивает риски по чек-листу компании: штрафы, юрисдикция, сроки, ответственность</li>
        <li><span class="bly-ic">↗</span>Каждый флаг — со ссылкой на СПС, внутренний регламент или судебную практику</li>
        <li><span class="bly-ic">⚖</span>Порог автономности: низкий риск и сумма до лимита — авто-маршрут; выше — очередь юристу</li>
        <li><span class="bly-ic">✓</span>Юрист правит черновик, утверждает; журнал аудита фиксирует промпт → ответ → правки</li>
      </ul>
      <div class="bly-pills">
        <span class="bly-pl bly-pl-c">75 мин → 39 мин</span>
        <span class="bly-pl bly-pl-g">32 типа рисков</span>
        <span class="bly-pl bly-pl-v">Порог 1 млн ₽</span>
      </div>
      <p class="bly-foot">Дальше — этапы внедрения AI для юротдела под ключ →</p>
    </div>

    <div class="bly-rgt">
      <canvas
        id="bly-legal-verify-canvas"
        aria-label="Анимация: договор проходит AI-анализ рисков, получает citations и маршрутизируется на утверждение юристу или авто-одобрение"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bly-legal-verify-canvas');
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
    cyan:'#79f2ff',
    cyanD:function(a){return 'rgba(121,242,255,'+a+')';},
    viol:'#8b5cf6',
    violD:function(a){return 'rgba(139,92,246,'+a+')';},
    green:'#22c55e',
    greenD:function(a){return 'rgba(34,197,94,'+a+')';},
    amber:'#f59e0b',
    amberD:function(a){return 'rgba(245,158,11,'+a+')';},
    text:'#e6edf7',
    muted:'rgba(226,232,240,.45)',
    card:'rgba(255,255,255,.06)',
    cardBdr:'rgba(255,255,255,.12)',
    paper:'#f8fafc',
    paperBdr:'#cbd5e1',
    ink:'#0f172a',
    line:'rgba(255,255,255,.08)',
    stamp:'#22c55e'
  };

  var RISKS = [
    {label:'Штрафные санкции', cite:'ГК РФ ст. 330', level:'high', delay:80},
    {label:'Юрисдикция', cite:'Арбитражный регламент', level:'med', delay:150},
    {label:'Срок оплаты 45 дн.', cite:'Внутр. политика №12', level:'low', delay:220},
    {label:'Ограничение ответств.', cite:'Суд. практика А40', level:'high', delay:290}
  ];

  var LOOP = 680;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawTopBar(){
    ctx.fillStyle=C.text;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('юротдел · нормоконтроль',14,24);
    ctx.fillStyle=C.cyan;
    ctx.font='10px Inter,sans-serif';
    ctx.fillText('AI-скан активен',14,40);
    var pulse=8+Math.sin(frame*0.07)*3;
    ctx.beginPath();ctx.arc(W-28,28,pulse,0,Math.PI*2);
    ctx.fillStyle=C.greenD(0.15+0.1*Math.sin(frame*0.07));ctx.fill();
    ctx.beginPath();ctx.arc(W-28,28,4,0,Math.PI*2);
    ctx.fillStyle=C.green;ctx.fill();
    ctx.strokeStyle=C.line;ctx.lineWidth=1;
    ctx.beginPath();ctx.moveTo(0,48);ctx.lineTo(W,48);ctx.stroke();
  }

  function drawContract(x,y,w,h,highlight,alpha){
    ctx.globalAlpha=alpha||1;
    rr(x,y,w,h,8,C.paper,C.paperBdr,1.5);
    rr(x+8,y+8,w-16,14,3,C.cyanD(0.25),null,0);
    ctx.fillStyle=C.ink;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Договор поставки №1847',x+12,y+18);
    for(var i=0;i<5;i++){
      var ly=y+32+i*14;
      var lw=w-24;
      if(highlight===i){
        rr(x+10,ly-2,lw,12,2,C.amberD(0.35),C.amber,1.5);
      }
      rr(x+10,ly,lw*(0.55+Math.sin(i*1.7)*0.15),6,2,'#cbd5e1',null,0);
    }
    ctx.globalAlpha=1;
  }

  function drawScanner(x,y,w,h){
    rr(x,y,w,h,12,C.violD(0.1),C.viol,2);
    ctx.fillStyle=C.viol;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('AI · чек-лист рисков',x+w/2,y+18);
    var scanY=y+28+(frame%70);
    ctx.fillStyle=C.cyanD(0.2);
    ctx.fillRect(x+8,scanY-2,w-16,4);
    ctx.strokeStyle=C.cyan;ctx.lineWidth=2;
    ctx.beginPath();ctx.moveTo(x+8,scanY);ctx.lineTo(x+w-8,scanY);ctx.stroke();
    for(var i=0;i<3;i++){
      var ang=(i/3)*Math.PI*2+frame*0.05;
      ctx.beginPath();
      ctx.arc(x+w/2+Math.cos(ang)*18,y+h/2+Math.sin(ang)*12,2.5,0,Math.PI*2);
      ctx.fillStyle=C.cyan;ctx.fill();
    }
  }

  function drawRiskChip(x,y,text,cite,level,alpha){
    ctx.globalAlpha=alpha||1;
    var clr=level==='high'?C.amber:level==='med'?C.viol:C.cyan;
    var bg=level==='high'?C.amberD(0.15):level==='med'?C.violD(0.12):C.cyanD(0.12);
    var chipW=Math.min(148,W*0.28);
    rr(x,y,chipW,42,8,bg,clr,1.2);
    ctx.fillStyle=C.text;
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText(text,x+8,y+16);
    ctx.fillStyle=clr;
    ctx.font='8px Inter,sans-serif';
    ctx.fillText('↗ '+cite,x+8,y+32);
    ctx.globalAlpha=1;
    return chipW;
  }

  function drawGate(x,y,w,h,state,prog){
    rr(x,y,w,h,10,C.card,C.cardBdr,1.5);
    ctx.fillStyle=C.text;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Порог автономности',x+12,y+20);
    var barY=y+30;
    rr(x+10,barY,w-20,8,4,'rgba(255,255,255,.08)',null,0);
    var fillW=(w-20)*Math.min(1,prog);
    var barClr=prog>0.72?C.amber:C.green;
    rr(x+10,barY,fillW,8,4,barClr,null,0);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText('Сумма: 840 тыс. ₽ · риск: средний',x+12,y+52);
    if(state==='lawyer'){
      rr(x+10,y+58,w-20,32,6,C.amberD(0.15),C.amber,1.5);
      ctx.fillStyle=C.amber;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('→ Юристу на утверждение',x+w/2,y+78);
    } else if(state==='auto'){
      rr(x+10,y+58,w-20,32,6,C.greenD(0.15),C.green,1.5);
      ctx.fillStyle=C.green;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('✓ Авто-маршрут (низкий риск)',x+w/2,y+78);
    }
  }

  function drawLawyerStamp(x,y,alpha){
    ctx.globalAlpha=alpha||1;
    rr(x,y,72,72,36,'transparent',C.stamp,2.5);
    ctx.strokeStyle=C.stamp;ctx.lineWidth=2.5;
    ctx.beginPath();ctx.arc(x+36,y+36,30,0,Math.PI*2);ctx.stroke();
    ctx.fillStyle=C.stamp;
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('УТВЕРЖДЕНО',x+36,y+32);
    ctx.fillText('юристом',x+36,y+44);
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t=frame%LOOP;
    ctx.clearRect(0,0,W,H);
    drawTopBar();

    var pad=14;
    var docW=Math.min(120,W*0.22);
    var docH=docW*1.35;
    var scanW=Math.min(130,W*0.24);
    var scanH=Math.min(95,H*0.26);
    var gateW=Math.min(165,W*0.28);
    var gateH=96;

    var docStartX=pad;
    var scanX=W*0.34-scanW/2;
    var scanY=H*0.42-scanH/2;
    var gateX=W-gateW-pad;
    var gateY=H*0.5-gateH/2;

    var docProg=Math.min(1,t/120);
    var docX=docStartX+(scanX-docStartX-20)*docProg;
    var docY=scanY+scanH/2-docH/2;

    if(t<130){
      drawContract(docX,docY,docW,docH,docProg>0.6?2:-1,1);
    }
    drawScanner(scanX,scanY,scanW,scanH);

    if(t>60){
      RISKS.forEach(function(r,i){
        var localT=t-r.delay;
        if(localT<0||localT>280) return;
        var alpha=localT<30?localT/30:localT>250?Math.max(0,1-(localT-250)/30):1;
        var cx=scanX+scanW+10;
        var cy=scanY-10+i*48;
        if(cy+42>H-60) cy=scanY+scanH+10+(i-2)*48;
        drawRiskChip(cx,cy,r.label,r.cite,r.level,alpha);
      });
    }

    var riskScore=0;
    if(t>200) riskScore=Math.min(1,(t-200)/180);
    var gateState=t>420&&t<520?'lawyer':t>=520?'auto':'pending';
    var gateProg=t>350?Math.min(1,(t-350)/200):0;
    drawGate(gateX,gateY,gateW,gateH,gateState,gateProg);

    if(t>130&&t<400){
      var moveProg=Math.min(1,(t-130)/200);
      var midX=scanX+scanW/2-docW/2;
      var midY=scanY+scanH/2-docH/2;
      var endX=gateX-docW-16;
      var endY=gateY+8;
      var cx2=midX+(endX-midX)*moveProg;
      var cy2=midY+(endY-midY)*moveProg;
      drawContract(cx2,cy2,docW,docH,moveProg>0.5?0:3,0.7+moveProg*0.3);
    }

    if(t>520){
      var stampAlpha=Math.min(1,(t-520)/60);
      drawLawyerStamp(gateX+gateW-50,gateY-20,stampAlpha);
    }

    if(t>100&&t<500){
      ctx.strokeStyle=C.cyanD(0.35);
      ctx.lineWidth=1.5;
      ctx.setLineDash([4,4]);
      ctx.beginPath();
      ctx.moveTo(scanX+scanW,scanY+scanH/2);
      ctx.lineTo(gateX,gateY+gateH/2);
      ctx.stroke();
      ctx.setLineDash([]);
    }

    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Черновик → citations → порог → утверждение',pad,H-12);

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>

<section class="yl-section" id="etapy">
  <div class="yl-cnt">
    <div class="yl-sh nero-ai-reveal">
      <span class="yl-eyebrow">Под ключ</span>
      <h2>Как устроено <span class="yl-gt">внедрение AI для юристов</span></h2>
      <p>Проектная модель из 4 этапов. Срок первого результата: <strong>2–8 недель</strong>.</p>
    </div>

    <div class="yl-timeline nero-ai-reveal">
      <div class="yl-tl-item">
        <div class="yl-tl-dot"></div>
        <h3>Этап 1 (1–2 недели): аудит и «Карта юридической рутины»</h3>
        <p>Диагностика процессов: договоры, FAQ, legal research, compliance. Замер времени, классификация по риску, матрица «сценарий → нужен ли юрист → порог автономности». На выходе — документ с ориентиром бюджета <strong>300 тыс.–2 млн ₽</strong>.</p>
      </div>
    </div>

    <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-karta-rutiny">
      <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получите Карту юридической рутины — бесплатно</p>
        <p class="ym-cta-block__sub">За 1–2 недели разберём ваши процессы: договоры, FAQ, legal research, compliance. На выходе — матрица «сценарий → риск → порог автономности» и ориентир бюджета 300 тыс.–2 млн ₽. Без обязательств по внедрению.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>

    <div class="yl-timeline nero-ai-reveal nero-ai-delay-1">
      <div class="yl-tl-item">
        <div class="yl-tl-dot"></div>
        <h3>Этап 2 (2–4 недели): пилот на одном сценарии</h3>
        <p>RAG по шаблонам договоров, ЛНА, политикам compliance. Чек-листы рисков, few-shot на обезличенных кейсах, промпты с citations. Стек: YandexGPT / GigaChat / частный vLLM + векторная база + журнал промптов.</p>
      </div>
      <div class="yl-tl-item">
        <div class="yl-tl-dot"></div>
        <h3>Этап 3: интеграция с DMS, CRM, wiki, ЭДО</h3>
        <p>СЭД (Directum, 1С:ДО), CRM (amoCRM, Bitrix24), мессенджеры, wiki, n8n/Make для маршрутизации и эскалации.</p>
      </div>
      <div class="yl-tl-item">
        <div class="yl-tl-dot"></div>
        <h3>Этап 4 (4–8 недель): масштабирование</h3>
        <p>Второй и третий сценарии, обучение «юридических чемпионов». Модель Cuatrecasas + Harvey: 80%+ юристов используют ежедневно после firmwide rollout.</p>
      </div>
    </div>

    <div class="yl-highlight nero-ai-reveal">
      <h3>Логика работы системы</h3>
      <ol>
        <li>Пользователь загружает документ или задаёт вопрос (чат, виджет в СЭД, Telegram).</li>
        <li>AI извлекает контекст из RAG: шаблоны, регламенты, СПС.</li>
        <li>Модель формирует черновик: риски, рекомендации, ссылки.</li>
        <li>Система классифицирует риск: низкий — авто-маршрут; высокий — в очередь юристу.</li>
        <li>Юрист правит, утверждает; feedback уходит в лог.</li>
        <li>Аналитика: время на задачу, % принятых без правок, adoption по отделам.</li>
      </ol>
    </div>
  </div>
</section>

<section class="yl-section yl-section-alt" id="ceny">
  <div class="yl-cnt">
    <div class="yl-sh nero-ai-reveal">
      <span class="yl-eyebrow">Коммерция</span>
      <h2>Стоимость <span class="yl-gt">внедрения AI для юристов</span></h2>
      <p>Ориентир чека Nero Network: <strong>300 000 – 2 000 000 ₽</strong> — в зависимости от глубины внедрения.</p>
    </div>

    <div class="yl-table-wrap nero-ai-reveal">
      <table class="yl-table">
        <thead><tr><th>Фактор</th><th>Влияние на стоимость</th></tr></thead>
        <tbody>
          <tr><td>Количество сценариев (1 vs 3+)</td><td>Базовый пилот vs комплекс</td></tr>
          <tr><td>Объём базы знаний и шаблонов</td><td>Настройка RAG, индексация</td></tr>
          <tr><td>Интеграции (СЭД, CRM, мессенджеры)</td><td>От точечного виджета до сквозного потока</td></tr>
          <tr><td>Контур данных (облако РФ vs on-prem)</td><td>Private LLM, инфраструктура ИБ</td></tr>
          <tr><td>Уровень кастомизации чек-листов</td><td>Отраслевые риски (как у Русклимат: 32 типа)</td></tr>
          <tr><td>Обучение и change management</td><td>Champions, регрессионные тесты</td></tr>
        </tbody>
      </table>
    </div>

    <div class="yl-pills nero-ai-reveal nero-ai-delay-1">
      <span class="yl-pill">ЕВРАЗ: −30% времени юристов</span>
      <span class="yl-pill">Systeme Electric: ×6 скорость</span>
      <span class="yl-pill">Русклимат: ×2 быстрее</span>
      <span class="yl-pill">Яндекс: до 40% задач юриста</span>
    </div>

    <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-ceny">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте стоимость под ваш юротдел</p>
        <p class="ym-cta-block__sub">Ориентир 300 тыс.–2 млн ₽ в зависимости от сценариев, интеграций и контура (облако РФ vs on-prem). Пилот с одного сценария — нижняя граница диапазона. Точный расчёт — после карты юридической рутины.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="yl-section" id="bezopasnost">
  <div class="yl-cnt">
    <div class="yl-sh nero-ai-reveal">
      <span class="yl-eyebrow">Verification-first</span>
      <h2>Безопасность, конфиденциальность и <span class="yl-gt">human-in-the-loop</span></h2>
      <p>Главный дифференциатор Nero Network против конкурентов без архитектуры верификации.</p>
    </div>

    <div class="yl-split nero-ai-reveal">
      <div class="yl-card">
        <h3>Облако РФ (YandexGPT, GigaChat)</h3>
        <p>Типовые задачи без ПДн и коммерческой тайны в документах; быстрый старт пилота.</p>
      </div>
      <div class="yl-card">
        <h3>On-prem / закрытый контур</h3>
        <p>Договоры с NDA, персональные данные (152-ФЗ), отраслевые секреты. Примеры: Русклимат, Авито (собственные LLM в контуре).</p>
      </div>
    </div>

    <div class="yl-callout nero-ai-reveal nero-ai-delay-1">
      <h4>Почему ChatGPT в браузере — риск для юротдела</h4>
      <p>Нет аудита, данные могут уходить на зарубежные серверы, нет единых чек-листов и порогов риска. <strong>47%</strong> юристов используют ChatGPT — но <strong>84%</strong> не доверяют ответам без проверки. Nero закрывает разрыв: от теневого ChatGPT к корпоративному AI с аудитом.</p>
    </div>

    <div class="yl-card nero-ai-reveal nero-ai-delay-2">
      <h3>Верификация ответов и ответственность юриста</h3>
      <ul>
        <li>AI выдаёт <strong>черновики</strong>, не финальные заключения</li>
        <li>Каждый ответ со <strong>ссылками на источники</strong> (СПС, внутренние регламенты)</li>
        <li>Журнал аудита: промпт → ответ → правки юриста → утверждение</li>
        <li>Регрессионные тесты при обновлении промптов и моделей</li>
      </ul>
      <p>Точность генеративного ИИ на юридических задачах — <strong>60–80%</strong> (Право.ru, 2025). <strong>Ответственность</strong> остаётся за юристом, который подписывает документ.</p>
    </div>
  </div>
</section>

<section class="yl-section yl-section-alt" id="komu">
  <div class="yl-cnt">
    <div class="yl-sh nero-ai-reveal">
      <span class="yl-eyebrow">Сегменты</span>
      <h2>AI для юрфирм, in-house и <span class="yl-gt">compliance</span></h2>
    </div>
    <div class="yl-grid-3 nero-ai-reveal">
      <div class="yl-card">
        <h3>Малый и средний бизнес</h3>
        <p>Фокус на 1–2 сценариях: клиентский приём + шаблоны договоров или FAQ + проверка типовых поставок. Старт с пилота <strong>300–500 тыс. ₽</strong> на один сценарий.</p>
      </div>
      <div class="yl-card">
        <h3>Корпоративные юрслужбы</h3>
        <p>Интеграция с СЭД и ERP, пороговая автономность (модель Systeme Electric), масштаб внутренних пользователей (модель ЕВРАЗ: 60 000 сотрудников).</p>
      </div>
      <div class="yl-card">
        <h3>Compliance-функция</h3>
        <p>Мониторинг НПА, чек-листы по регуляторным требованиям, audit trail для проверок. Legal Ops как владелец внедрения.</p>
      </div>
    </div>
  </div>
</section>

<section class="yl-section yl-internal-links" id="smozhnye-materialy">
  <div class="yl-cnt">
    <div class="yl-sh nero-ai-reveal">
      <span class="yl-eyebrow">Смежные материалы</span>
      <h2>Внедрение AI в <span class="yl-gt">соседних процессах</span></h2>
      <p>Юротдел редко живёт изолированно: CRM, ERP и enterprise-контур — соседние точки автоматизации с тем же подходом human-in-the-loop.</p>
    </div>
    <div class="yl-grid-2 nero-ai-reveal nero-ai-delay-1">
      <div class="yl-card">
        <h3>ERP и договорный контур</h3>
        <p>Для корпоративных юрслужб с интеграцией в СЭД и ERP: <a href="<?php echo esc_url( home_url( '/ai-1c-erp/' ) ); ?>">AI-агент для 1С и ERP под ключ</a> — сквозная автоматизация документооборота рядом с юридическими процессами.</p>
      </div>
      <div class="yl-card">
        <h3>CRM для юрфирм</h3>
        <p>Входящий запрос → квалификация → карточка клиента: <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-amocrm/' ) ); ?>">внедрение AI-агента в amoCRM</a> дополняет сценарий первичного приёма у юристов.</p>
      </div>
      <div class="yl-card">
        <h3>Почта и CRM</h3>
        <p>Автоматизация входящих обращений клиентов: <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-obrabotka-email-crm/' ) ); ?>">AI-обработка почты в CRM</a> снижает ручную сортировку до эскалации юристу.</p>
      </div>
      <div class="yl-card">
        <h3>Enterprise-масштаб</h3>
        <p>Уроки rollout на десятки тысяч сотрудников и agentic AI в регулируемых функциях: <a href="<?php echo esc_url( home_url( '/kpmg-claude-vnedrenie-ai-276-tysyach/' ) ); ?>">кейс KPMG и Claude для 276&nbsp;000 сотрудников</a>.</p>
      </div>
    </div>
  </div>
</section>

<section class="yl-section" id="keisy">
  <div class="yl-cnt">
    <div class="yl-sh nero-ai-reveal">
      <span class="yl-eyebrow">Доказательства</span>
      <h2>Кейсы и примеры <span class="yl-gt">внедрения</span></h2>
      <p>Цифры из публичных источников, без выдуманных брендов Nero.</p>
    </div>
    <div class="yl-case-grid nero-ai-reveal">
      <div class="yl-case-card">
        <div class="yl-case-tag">ЕВРАЗ</div>
        <h3>Внутренние запросы</h3>
        <p>85% типовых документов автоматически, −30% времени юристов, 24/7. <a href="https://pravo.tech/blog/article/60-000-sotrudnikov-bez-ocheredi-k-yuristam-kak-evraz-avtomatiziroval-vnutrennie-zaprosy" target="_blank" rel="noopener noreferrer">ПравоТех →</a></p>
      </div>
      <div class="yl-case-card">
        <div class="yl-case-tag">Systeme Electric</div>
        <h3>Нормоконтроль</h3>
        <p>×6 скорость, 2 FTE, порог 1 млн ₽. <a href="https://www.directum.ru/blog-post/juristy_systeme_electric_uskorili_proverku_dogovorov_v_6_raz_s_pomoshhju_ii-reshenija_directum" target="_blank" rel="noopener noreferrer">Directum →</a></p>
      </div>
      <div class="yl-case-card">
        <div class="yl-case-tag">Русклимат</div>
        <h3>Анализ рисков</h3>
        <p>75 → 39 минут, on-prem, 32 типа рисков. <a href="https://www.cnews.ru/news/line/2025-08-12_rusklimat_sokratil_vremya" target="_blank" rel="noopener noreferrer">CNews →</a></p>
      </div>
      <div class="yl-case-card">
        <div class="yl-case-tag">Яндекс Нейроюрист</div>
        <h3>Legal research</h3>
        <p>×3 поиск, 75% юристов Яндекса используют постоянно, on-prem для enterprise. <a href="https://yandex.ru/company/news/20-11-2025-01" target="_blank" rel="noopener noreferrer">Yandex B2B →</a></p>
      </div>
    </div>
    <p class="nero-ai-reveal" style="text-align:center;margin-top:24px;font-size:14px;">Доля руководителей юрфункций с ИИ выросла с 10–18% до <strong>40–50%</strong> за 2025 (ПравоТех) — рынок созрел для внедрения.</p>
  </div>
</section>

<section class="yl-section yl-section-alt" id="integracii">
  <div class="yl-cnt">
    <div class="yl-sh nero-ai-reveal">
      <span class="yl-eyebrow">Стек</span>
      <h2>Интеграции: CRM, 1С, <span class="yl-gt">агенты</span></h2>
    </div>

    <div class="yl-card nero-ai-reveal">
      <h3>AI-агенты vs единый помощник</h3>
      <p>Agentic-сценарии внедряем <strong>только</strong> с порогами риска и обязательной валидацией на high-risk шагах. Для большинства юротделов старт — <strong>единый AI-помощник</strong> (чат + проекты + СЭД), а не рой автономных агентов.</p>
    </div>

    <div class="yl-flow nero-ai-reveal nero-ai-delay-1">
      <div class="yl-flow-step"><strong>1</strong>Запрос / документ</div>
      <div class="yl-flow-step"><strong>2</strong>RAG-контекст</div>
      <div class="yl-flow-step"><strong>3</strong>Черновик + риски</div>
      <div class="yl-flow-step"><strong>4</strong>Классификация</div>
      <div class="yl-flow-step"><strong>5</strong>HITL / авто</div>
      <div class="yl-flow-step"><strong>6</strong>Аналитика</div>
    </div>
    <div class="yl-stack-chips nero-ai-reveal">
      <span class="yl-stack-chip">Directum</span>
      <span class="yl-stack-chip">1С:ДО</span>
      <span class="yl-stack-chip">amoCRM</span>
      <span class="yl-stack-chip">Bitrix24</span>
      <span class="yl-stack-chip">Telegram</span>
      <span class="yl-stack-chip">n8n / Make</span>
    </div>

    <p class="nero-ai-reveal" style="margin-top:24px;"><strong>Внедрение без программиста:</strong> Nero настраивает интеграции, промпты, RAG, n8n-маршруты. Юристы работают в привычных интерфейсах; IT подключается только на доступах и on-prem.</p>

    <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
        <p class="ym-cta-block__sub">Перед внедрением AI в юротдел полезно разобраться в RAG, human-in-the-loop, промптах и интеграции с СЭД — это ускоряет согласование сценариев с Legal Ops и IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
      </div>
    </aside>
  </div>
</section>

<section class="yl-section" id="konsultaciya">
  <div class="yl-cnt">
    <div class="yl-sh nero-ai-reveal">
      <span class="yl-eyebrow">Следующий шаг</span>
      <h2>Внедрить <span class="yl-gt">AI для юристов</span></h2>
    </div>
    <div class="yl-steps-num nero-ai-reveal">
      <div class="yl-step-num"><div><strong>Заявка</strong> — короткий бриф: отрасль, размер юротдела, приоритетный сценарий.</div></div>
      <div class="yl-step-num"><div><strong>Карта юридической рутины</strong> (аудит 1–2 недели) — бесплатный лид-магнит при переходе к проекту.</div></div>
      <div class="yl-step-num"><div><strong>Пилот 2–4 недели</strong> — один сценарий с измеримым KPI.</div></div>
      <div class="yl-step-num"><div><strong>Масштабирование</strong> — второй/третий модуль, обучение champions.</div></div>
    </div>

    <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы внедрить AI для юротдела?</p>
        <p class="ym-cta-block__sub">Следующий шаг — консультация и карта юридической рутины. Пилот на одном сценарии за 2–4 недели: проверка договоров, FAQ или поиск практики — с human-in-the-loop и защитой данных.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>
</section>

<section class="yl-section yl-section-alt" id="faq">
  <div class="yl-cnt">
    <div class="yl-sh nero-ai-reveal">
      <span class="yl-eyebrow">FAQ</span>
      <h2>Вопросы по <span class="yl-gt">внедрению AI для юристов</span></h2>
    </div>
    <div class="yl-faq nero-ai-reveal">
      <div class="yl-faq-item"><div class="yl-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai для юристов?</div><div class="yl-faq-a">Поэтапно: аудит рутины → пилот на одном сценарии → настройка RAG и интеграций → human-in-the-loop и пороги риска → масштабирование. Срок первого результата — от 2 недель. Под ключ это делает Nero Network.</div></div>
      <div class="yl-faq-item"><div class="yl-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai для юристов?</div><div class="yl-faq-a">Ориентир Nero Network: <strong>300 тыс.–2 млн ₽</strong> в зависимости от сценариев, интеграций и контура. Пилот с одного сценария — нижняя граница диапазона.</div></div>
      <div class="yl-faq-item"><div class="yl-faq-q" role="button" tabindex="0" aria-expanded="false">Ai для юристов под ключ или самостоятельно?</div><div class="yl-faq-a">Под ключ: on-prem / облако РФ, интеграция с СЭД, пороги риска, журнал, срок 2–8 недель. Самостоятельно — риск утечек в публичные чаты и месяцы проб.</div></div>
      <div class="yl-faq-item"><div class="yl-faq-q" role="button" tabindex="0" aria-expanded="false">Ai для юристов без программиста — реально?</div><div class="yl-faq-a">Да, при модели под ключ: Nero настраивает техническую часть, юристы работают в готовых интерфейсах. IT подключается только для доступов и on-prem.</div></div>
      <div class="yl-faq-item"><div class="yl-faq-q" role="button" tabindex="0" aria-expanded="false">Какие задачи решает ai для юристов?</div><div class="yl-faq-a">Проверка договоров, поиск практики, FAQ по регламентам, compliance-чеклисты, черновики документов, мониторинг НПА. Финальная позиция — за юристом.</div></div>
      <div class="yl-faq-item"><div class="yl-faq-q" role="button" tabindex="0" aria-expanded="false">ИИ галлюцинирует — как с этим жить?</div><div class="yl-faq-a">Только черновики, citations, чек-листы, обязательная перепроверка. Точность 60–80% на отдельных задачах — достаточно для рутины, недостаточно для автономных решений.</div></div>
      <div class="yl-faq-item"><div class="yl-faq-q" role="button" tabindex="0" aria-expanded="false">Кто отвечает за ошибку AI?</div><div class="yl-faq-a">Юрист, утвердивший документ. ИИ — инструмент в цепочке, не замена профессиональной ответственности.</div></div>
      <div class="yl-faq-item"><div class="yl-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли 152-ФЗ при внедрении?</div><div class="yl-faq-a">Если в документах есть ПДн — да: on-prem или облако РФ с договором обработки, реестр ПО, политики хранения. Nero проектирует контур под требования ИБ клиента.</div></div>
    </div>
  </div>
</section>

</div><!-- .yl-content -->

<?php
$yl_page_url = trailingslashit( get_permalink() );
$yl_site_url = trailingslashit( home_url( '/' ) );
$yl_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$yl_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $yl_site_url . '#organization',
      'name'  => $yl_brand,
      'url'   => $yl_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $yl_site_url . '#website',
      'url'       => $yl_site_url,
      'name'      => $yl_brand,
      'publisher' => [ '@id' => $yl_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $yl_page_url . '#webpage',
      'url'         => $yl_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $yl_site_url . '#website' ],
      'about'       => [ '@id' => $yl_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $yl_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $yl_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $yl_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $yl_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $yl_page_url,
      'provider'    => [ '@id' => $yl_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $yl_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить ai для юристов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Поэтапно: аудит рутины → пилот на одном сценарии → настройка RAG и интеграций → human-in-the-loop и пороги риска → масштабирование. Срок первого результата — от 2 недель. Под ключ это делает Nero Network.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит ai для юристов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир Nero Network: 300 тыс.–2 млн ₽ в зависимости от сценариев, интеграций и контура. Пилот с одного сценария — нижняя граница диапазона.' ] ],
        [ '@type' => 'Question', 'name' => 'Ai для юристов под ключ или самостоятельно?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Под ключ: on-prem / облако РФ, интеграция с СЭД, пороги риска, журнал, срок 2–8 недель. Самостоятельно — риск утечек в публичные чаты и месяцы проб.' ] ],
        [ '@type' => 'Question', 'name' => 'Ai для юристов без программиста — реально?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, при модели под ключ: Nero настраивает техническую часть, юристы работают в готовых интерфейсах. IT подключается только для доступов и on-prem.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие задачи решает ai для юристов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Проверка договоров, поиск практики, FAQ по регламентам, compliance-чеклисты, черновики документов, мониторинг НПА. Финальная позиция — за юристом.' ] ],
        [ '@type' => 'Question', 'name' => 'ИИ галлюцинирует — как с этим жить?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Только черновики, citations, чек-листы, обязательная перепроверка. Точность 60–80% на отдельных задачах — достаточно для рутины, недостаточно для автономных решений.' ] ],
        [ '@type' => 'Question', 'name' => 'Кто отвечает за ошибку AI?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Юрист, утвердивший документ. ИИ — инструмент в цепочке, не замена профессиональной ответственности.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужен ли 152-ФЗ при внедрении?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Если в документах есть ПДн — да: on-prem или облако РФ с договором обработки, реестр ПО, политики хранения. Nero проектирует контур под требования ИБ клиента.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $yl_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
(function(){
  document.querySelectorAll('.yl-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.yl-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.yl-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.yl-faq-q');
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
  var root = document.querySelector('.ai-dlya-yuristov-page');
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

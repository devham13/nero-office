<?php
/**
 * Template Name: AI-обучение продавцов: тренажёр знаний продукта под ключ
 * Description: SEO-лендинг — AI-тренажёр знаний продукта для продавцов. Тест, role-play, CRM. Внедрение от 150 тыс. ₽.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-обучение продавцов: тренажёр знаний продукта под ключ';
$page_seo_description = 'AI-тренажёр знаний продукта для продавцов под ключ: обучение менеджеров, разбор возражений, оценка ответов. Тест для отдела продаж. Внедрение от 150 тыс. ₽.';

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
    ['label' => 'Зачем', 'href' => '#zachem'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'CRM', 'href' => '#integracii'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'Тест', 'href' => '#test'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить продавцов';
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

.aop-content{
  --aop-bg:#050711;--aop-bg2:#080b17;--aop-bg3:#0a0e1c;
  --aop-surface:rgba(255,255,255,.072);--aop-surface2:rgba(255,255,255,.108);
  --aop-text:#e6edf7;--aop-muted:#9aa8bd;--aop-soft:#c7d2e5;--aop-heading:#fff;
  --aop-border:rgba(255,255,255,.10);--aop-border-s:rgba(255,255,255,.18);
  --aop-accent:#79f2ff;--aop-violet:#8b5cf6;--aop-green:#22c55e;--aop-cyan:#79f2ff;
  --aop-btn-from:#2563eb;--aop-btn-to:#7c3aed;
  --aop-shadow:0 24px 72px rgba(0,0,0,.4);
  --aop-r:18px;--aop-r-lg:24px;--aop-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aop-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aop-content *,.aop-content *::before,.aop-content *::after{box-sizing:border-box;}
.aop-content a{color:inherit;text-decoration:none;}
.aop-content p{color:var(--aop-muted);line-height:1.72;margin:0 0 1em;}
.aop-content p:last-child{margin-bottom:0;}
.aop-content h2,.aop-content h3,.aop-content h4{color:var(--aop-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.aop-content strong{color:var(--aop-soft);}
.aop-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aop-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aop-muted);font-size:14.5px;line-height:1.65;}
.aop-content ul li::before{content:'›';position:absolute;left:0;color:var(--aop-accent);font-weight:700;}
.aop-cnt{width:min(var(--aop-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aop-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aop-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aop-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aop-sh.aop-left{margin-left:0;text-align:left;}
.aop-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aop-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aop-sh.aop-left p{margin-left:0;}
.aop-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aop-accent);margin-bottom:14px;}
.aop-gt{background:linear-gradient(92deg,#fff 0%,var(--aop-accent) 44%,var(--aop-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.aop-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.aop-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.aop-intro-text{position:relative;padding-left:20px;}
.aop-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aop-accent),var(--aop-violet));}
.aop-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--aop-muted);margin-bottom:1em;}
.aop-intro-text p:last-child{margin-bottom:0;color:var(--aop-soft);}
.aop-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aop-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.aop-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aop-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.aop-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aop-muted);line-height:1.4;}
.aop-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.aop-intro-grid{grid-template-columns:1fr;gap:36px;}.aop-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.aop-intro-kpi{grid-template-columns:1fr 1fr;}}
.aop-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aop-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aop-toc a{display:inline-block;padding:9px 18px;background:var(--aop-surface);border:1px solid var(--aop-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aop-muted);transition:border-color .2s,color .2s,background .2s;}
.aop-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--aop-accent);background:rgba(121,242,255,.08);}
.aop-callout{background:linear-gradient(135deg,rgba(121,242,255,.1),rgba(139,92,246,.08));border:1px solid rgba(121,242,255,.25);border-radius:var(--aop-r-lg);padding:24px 28px;margin:24px 0;}
.aop-callout p{margin:0;color:var(--aop-soft);text-align:left!important;}
.aop-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aop-border);border-radius:var(--aop-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.aop-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.aop-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aop-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.aop-grid-2,.aop-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.aop-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aop-grid-3{grid-template-columns:1fr;}}
.aop-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aop-table{width:100%;border-collapse:collapse;font-size:14px;}
.aop-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--aop-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.aop-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aop-text);vertical-align:top;}
.aop-table tr:last-child td{border-bottom:none;}
.aop-table tr:hover td{background:rgba(255,255,255,.03);}
.aop-steps{counter-reset:aopstep;display:grid;gap:14px;margin:28px 0;}
.aop-step{display:grid;grid-template-columns:44px 1fr;gap:16px;padding:18px 20px;background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:16px;}
.aop-step::before{counter-increment:aopstep;content:counter(aopstep);display:grid;place-items:center;width:44px;height:44px;border-radius:12px;background:rgba(121,242,255,.12);color:var(--aop-accent);font-weight:800;font-size:16px;}
.aop-step h4{margin:0 0 6px;font-size:15px;}
.aop-step p{margin:0;font-size:14px;}
.aop-timeline{position:relative;padding-left:40px;}
.aop-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aop-accent),var(--aop-violet));opacity:.35;border-radius:2px;}
.aop-tl-item{position:relative;margin-bottom:32px;}
.aop-tl-item:last-child{margin-bottom:0;}
.aop-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--aop-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.aop-tl-item h3{font-size:17px;margin-bottom:8px;}
.aop-tl-item p{font-size:14.5px;margin:0;}
.aop-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.aop-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aop-case-grid{grid-template-columns:1fr;}}
.aop-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.aop-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.aop-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aop-green);margin-bottom:10px;}
.aop-case-card h3{font-size:16px;margin-bottom:14px;}
.aop-price-band{display:inline-block;padding:12px 24px;border-radius:999px;background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.35);color:#86efac;font-size:clamp(18px,2.5vw,24px);font-weight:800;margin:16px 0 24px;}
.aop-test-box{border:2px solid rgba(34,197,94,.35);border-radius:var(--aop-r-lg);padding:36px;background:rgba(34,197,94,.06);}
.aop-badge-row{display:flex;flex-wrap:wrap;gap:10px;margin:20px 0;}
.aop-badge{display:inline-flex;padding:8px 14px;border-radius:999px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);font-size:12px;font-weight:700;color:var(--aop-soft);}
.aop-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aop-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.aop-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aop-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.aop-faq-q::after{content:'▾';font-size:13px;color:var(--aop-accent);flex-shrink:0;transition:transform .25s;}
.aop-faq-item.open .aop-faq-q::after{transform:rotate(180deg);}
.aop-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--aop-muted);line-height:1.72;}
.aop-faq-item.open .aop-faq-a{max-height:800px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--aop-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--aop-btn-from),var(--aop-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-link--accent{color:var(--aop-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-obuchenie-prodavcov-page" role="main" tabindex="-1">

<section class="nero-ai-hero aop-hero" id="hero" aria-labelledby="aop-hero-title">
<style>
/* ── Hero ai-obuchenie-prodavcov: самодостаточные стили ── */
.aop-hero {
  --aop-cyan: #79f2ff;
  --aop-violet: #8b5cf6;
  --aop-green: #22c55e;
  --aop-amber: #f59e0b;
  --aop-text: #e6edf7;
  --aop-muted: #9aa8bd;
  --aop-soft: #c7d2e5;
  --aop-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aop-hero::before {
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
.aop-hero::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 700px;
  height: 700px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(8px);
  animation: aopHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aopHeroGlow {
  from { opacity: .42; transform: scale(.96); }
  to { opacity: .88; transform: scale(1.05); }
}
.aop-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aop-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aop-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(38px, 5.8vw, 78px);
  line-height: .92;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.aop-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aop-cyan) 38%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aop-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aop-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aop-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aop-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aop-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aop-hero .nero-ai-badge {
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
.aop-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aop-hero .nero-ai-btn {
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
.aop-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.aop-hero .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--aop-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aop-hero .nero-ai-btn-secondary {
  color: var(--aop-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aop-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aop-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.aop-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aop-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aop-hero .nero-ai-dots { display: flex; gap: 7px; }
.aop-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aop-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aop-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aop-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.aop-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aop-hero .nero-ai-window-body { padding: 16px; }
.aop-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aop-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aop-hero .nero-ai-live-pill {
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
.aop-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aopPulse 1.6s infinite;
}
@keyframes aopPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aop-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
.aop-hero .nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
}
.aop-hero .nero-ai-metric span { display: block; color: var(--aop-muted); font-size: 12px; font-weight: 700; }
.aop-hero .nero-ai-metric strong { display: block; margin-top: 7px; color: #fff; font-size: 24px; line-height: 1; }
.aop-hero .nero-ai-metric small { display: block; margin-top: 6px; color: #9fb0c9; font-size: 12px; }
.aop-hero .aop-dash-canvas-wrap {
  margin-top: 14px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: linear-gradient(180deg, rgba(8,12,28,.9), rgba(4,7,18,.95));
  overflow: hidden;
  min-height: 168px;
}
.aop-hero #aop-hero-trainer-canvas {
  display: block;
  width: 100%;
  height: 168px;
}
.aop-hero .nero-ai-task-stream { margin-top: 14px; display: grid; gap: 10px; }
.aop-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
}
.aop-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--aop-cyan);
  font-size: 11px;
  font-weight: 800;
}
.aop-hero .nero-ai-task strong { display: block; color: #f8fafc; font-size: 13px; }
.aop-hero .nero-ai-task span { color: var(--aop-muted); font-size: 12px; }
.aop-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #86efac;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
}
.aop-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fcd34d;
}
@media (max-width: 1023px) {
  .aop-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aop-hero .nero-ai-dashboard { transform: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai обучение продавцов</p>
      <h1 id="aop-hero-title">AI-обучение продавцов: <span class="nero-ai-gradient-text">тренажёр знаний продукта</span> под ключ</h1>
      <p class="nero-ai-hero-lead">Нейросеть тренирует менеджеров по продукту, возражениям и скриптам — с оценкой каждого ответа. Сократите онбординг и уберите ошибки в консультациях.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности тренажёра">
        <li class="nero-ai-badge">Тест знаний</li>
        <li class="nero-ai-badge">Role-play</li>
        <li class="nero-ai-badge">AI-оценка</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">Онбординг</li>
        <li class="nero-ai-badge">Telegram</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#test">Пройти тест</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демо: AI-тренажёр продаж">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-тренажёр продаж · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Средний балл</span>
              <strong>78/100</strong>
              <small>по продукту</small>
            </div>
            <div class="nero-ai-metric">
              <span>На обучении</span>
              <strong>12</strong>
              <small>менеджеров</small>
            </div>
            <div class="nero-ai-metric">
              <span>Сертифицировано</span>
              <strong>67%</strong>
              <small>команды</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ramp time</span>
              <strong>−34%</strong>
              <small>онбординг</small>
            </div>
          </div>

          <div class="aop-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aop-hero-trainer-canvas" role="img" aria-label="Анимация: менеджеры тренируются с цифровым клиентом, AI оценивает ответы и выставляет статус в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий тренажёра">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">+</span>
              <div><strong>Новый сценарий: возражение «дорого»</strong><span>загружен в базу знаний</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>AI-оценка: 82/100</strong><span>факты о продукте — ок, тон — ок</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Статус CRM: допущен</strong><span>amoCRM · сертификация</span></div>
              <span class="nero-ai-status">новое</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">РОП</span>
              <div><strong>Повторить модуль «комплектации»</strong><span>3 менеджера ниже порога 80</span></div>
              <span class="nero-ai-status nero-ai-status--amber">задача</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="aop-content">

  <section class="aop-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="aop-cnt">
      <div class="aop-intro-grid nero-ai-reveal">
        <div class="aop-intro-text">
          <p class="aop-eyebrow">Лонгрид · ai обучение продавцов</p>
          <p><strong>Коротко:</strong> AI-тренажёр знаний продукта загружает каталог, скрипты и FAQ компании и тренирует менеджеров в диалоге с «цифровым клиентом». Каждый ответ оценивается автоматически — факты, структура, работа с возражениями. Внедрение под ключ: тест знаний, интеграция в amoCRM или Битрикс24, допуск к клиентам только после порога.</p>
          <p>Новый менеджер быстро путает комплектации и устаревшие цены — клиенты получают противоречивые консультации. В 2026 году sales-команды решают это не разовым тренингом, а <strong>внедрением AI в обучение продавцов</strong>: ежедневная практика, объективная оценка, результат в CRM.</p>
        </div>
        <div class="aop-intro-kpi" aria-label="Метрики Salesforce State of Sales 2026">
          <div class="aop-kpi-card"><div class="kv">47%</div><div class="kl">без roleplay перед звонком</div><div class="ks">Salesforce 2026</div></div>
          <div class="aop-kpi-card"><div class="kv">46%</div><div class="kl">редко получают обратную связь</div><div class="ks">Salesforce 2026</div></div>
          <div class="aop-kpi-card"><div class="kv">3–9 мес</div><div class="kl">ramp time без онбординга</div><div class="ks">Careertrainer 2026</div></div>
          <div class="aop-kpi-card"><div class="kv">−34%</div><div class="kl">ускорение с программой</div><div class="ks">формальный онбординг</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aop-toc-outer">
    <div class="aop-cnt">
      <nav class="aop-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">CRM</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#test">Тест</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="aop-section" id="zachem">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Боль отдела продаж</span>
        <h2>Зачем отделу продаж AI-тренажёр знаний продукта</h2>
        <p><strong>AI-тренажёр знаний продукта</strong> — нейросеть для обучения продажам, которая проверяет готовность консультировать: знает ли продавец каталог, отличия от конкурентов, условия и типовые возражения.</p>
      </div>

      <div class="aop-callout nero-ai-reveal">
        <p>Главная боль: новые продавцы долго изучают продукт и ошибаются в консультациях. Живой role-play с РОПом не масштабируется — у одного руководителя десяток менеджеров, у сети сотни точек.</p>
      </div>

      <div class="aop-grid-2 nero-ai-reveal">
        <div class="aop-card">
          <h3>Сколько теряет бизнес на долгом обучении менеджеров</h3>
          <p>Ramp time без структурированного онбординга — <strong>3–9 месяцев</strong>. До 33% новых сотрудников уходят в первые 90 дней при плохой адаптации. Пока менеджер «набирает руку» — зарплата без плана, испорченные лиды, нагрузка на РОПа до 10 часов в неделю на наставничество.</p>
        </div>
        <div class="aop-card nero-ai-delay-1">
          <h3>Почему классические курсы не закрывают знание продукта</h3>
          <p>87% навыков из разового занятия теряется за 30 дней без закрепления. LMS фиксирует просмотр, а не умение ответить «чем ваша модель отличается от конкурента?». Нужен <strong>ai тренажер продаж</strong> с проверкой открытых ответов.</p>
        </div>
      </div>

      <div class="aop-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aop-table">
          <thead><tr><th>Формат</th><th>Что измеряет</th><th>Слабое место</th></tr></thead>
          <tbody>
            <tr><td>Разовый тренинг</td><td>Вовлечённость в зале</td><td>Нет ежедневной практики</td></tr>
            <tr><td>LMS (видео + тест)</td><td>Факт просмотра</td><td>Можно угадать ответ</td></tr>
            <tr><td>Речевая аналитика</td><td>Ошибки после факта</td><td>Не обучает до выхода в поле</td></tr>
            <tr><td>AI-тренажёр знаний продукта</td><td>Применение в диалоге</td><td>Требует настройки под каталог</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aop-section aop-section-alt" id="kak-rabotaet">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Механика тренажёра</span>
        <h2>Что такое AI-обучение продавцов и как работает тренажёр</h2>
        <p><strong>AI обучение продавцов</strong> — не «нейропродавец» в переписке с клиентом, а <strong>нейротренер</strong>: готовит живого менеджера, проверяет знание продукта и допускает к работе после порога.</p>
      </div>

      <p class="nero-ai-reveal" style="max-width:820px;margin:0 auto 24px;text-align:center;">Система на RAG: каталог, прайс, FAQ, battlecards, скрипты. AI индексирует материалы, генерирует сценарии и оценивает ответы строго по вашим документам.</p>

      <div class="aop-steps nero-ai-reveal">
        <div class="aop-step"><div><h4>Загрузка базы</h4><p>РОП загружает продуктовую базу → AI индексирует знания.</p></div></div>
        <div class="aop-step"><div><h4>Тест и сценарии</h4><p>Система генерирует тест → методолог утверждает сценарии.</p></div></div>
        <div class="aop-step"><div><h4>Входной контроль</h4><p>Продавец проходит тест знаний продукта.</p></div></div>
        <div class="aop-step"><div><h4>Role-play</h4><p>Тренировка в диалоге с AI-клиентом по слабым темам.</p></div></div>
        <div class="aop-step"><div><h4>AI-оценка</h4><p>Каждый ответ оценивается → дашборд РОПу → персональный план.</p></div></div>
        <div class="aop-step"><div><h4>Допуск в CRM</h4><p>Порог 80/100 → статус «допущен» в amoCRM / Битрикс24.</p></div></div>
      </div>

      <div class="aop-card nero-ai-reveal" style="margin-top:28px;">
        <h3 id="simulyaciya">Симуляция диалогов и разбор возражений</h3>
        <p><strong>Нейросеть для обучения продажам</strong> играет роль клиента: уточняющие вопросы, возражения «дорого», «нет бюджета», «не срочно». Сценарии по этапам сделки: контакт → потребности → оффер → возражения → закрытие.</p>
        <ul>
          <li>консультация по характеристикам и комплектациям;</li>
          <li>сравнение с конкурентом по battlecards;</li>
          <li>возражение по цене с аргументами из скрипта;</li>
          <li>upsell, кросс-продажа, эскалация нестандартного запроса.</li>
        </ul>
      </div>

      <div class="aop-card nero-ai-reveal nero-ai-delay-1" style="margin-top:20px;">
        <h3 id="ocenka">Автоматическая оценка ответов менеджера</h3>
        <p>AI-оценщик проверяет открытый ответ по чек-листу: факты о продукте, структура, работа с возражением, тон бренда. Шкала 0–100 плюс текстовый разбор — что верно, где ошибка, какой фрагмент базы перечитать.</p>
      </div>

      <div class="aop-card nero-ai-reveal nero-ai-delay-2" style="margin-top:20px;">
        <h3 id="skripty">Обучение по скриптам и актуальной базе продукта</h3>
        <p>Тренажёр подтягивает актуальную линейку: при обновлении каталога база переиндексируется. Форматы: веб-тренажёр для глубокой отработки, Telegram-бот для сессий 3–5 минут между сменами, голосовой режим через Yandex SpeechKit.</p>
      </div>

<section id="ai-obuchenie-prodavcov-boris-block" class="bao-root" aria-label="Анимация: AI-тренажёр оценивает ответ менеджера в диалоге с клиентом">
<style>
/* === БОРИС: prefix bao-, scoped внутри #ai-obuchenie-prodavcov-boris-block === */
#ai-obuchenie-prodavcov-boris-block.bao-root{
  padding:clamp(40px,6vw,64px) 0;
  background:#f0f4fb;
}
#ai-obuchenie-prodavcov-boris-block .bao-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 clamp(16px,3vw,24px);
}
#ai-obuchenie-prodavcov-boris-block .bao-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  box-shadow:0 10px 48px rgba(15,23,42,.11),0 0 0 1.5px rgba(121,242,255,.18);
  min-height:min(520px,70vh);
  background:#fff;
}
@media(max-width:1023px){
  #ai-obuchenie-prodavcov-boris-block .bao-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-obuchenie-prodavcov-boris-block .bao-lft{
  padding:clamp(28px,4vw,44px) clamp(22px,3vw,40px);
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
  background:#ffffff;
}
@media(max-width:1023px){
  #ai-obuchenie-prodavcov-boris-block .bao-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
  }
}
#ai-obuchenie-prodavcov-boris-block .bao-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0e7490;
  margin:0 0 14px;
}
#ai-obuchenie-prodavcov-boris-block .bao-ey::before{
  content:'';
  width:20px;height:2px;
  background:linear-gradient(90deg,#79f2ff,#8b5cf6);
  border-radius:1px;
}
#ai-obuchenie-prodavcov-boris-block .bao-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-obuchenie-prodavcov-boris-block .bao-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-obuchenie-prodavcov-boris-block .bao-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.52;
  color:#334155;
}
#ai-obuchenie-prodavcov-boris-block .bao-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(14,165,233,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0369a1;
  margin-top:1px;
  font-style:normal;
}
#ai-obuchenie-prodavcov-boris-block .bao-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-obuchenie-prodavcov-boris-block .bao-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-obuchenie-prodavcov-boris-block .bao-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-obuchenie-prodavcov-boris-block .bao-pl-c{
  background:rgba(121,242,255,.1);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.28);
}
#ai-obuchenie-prodavcov-boris-block .bao-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-obuchenie-prodavcov-boris-block .bao-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-obuchenie-prodavcov-boris-block .bao-rgt{
  position:relative;
  background:linear-gradient(145deg,#050711 0%,#0a0e1c 55%,#080b17 100%);
  min-height:400px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-obuchenie-prodavcov-boris-block .bao-rgt{min-height:380px;}
}
#bao-sales-trainer-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bao-cnt">
  <div class="bao-card">

    <div class="bao-lft">
      <span class="bao-ey">Симуляция в действии</span>
      <h3 class="bao-h3">Менеджер отвечает на возражение — AI оценивает факты, структуру и скрипт</h3>
      <ul class="bao-ul">
        <li><span class="bao-ic">💬</span>Цифровой клиент задаёт уточняющие вопросы и типовые возражения из вашей базы</li>
        <li><span class="bao-ic">✓</span>AI-оценщик сверяет ответ с каталогом, battlecards и эталонным скриптом</li>
        <li><span class="bao-ic">◎</span>Балл 0–100 и разбор ошибок — до выхода продавца к реальному клиенту</li>
        <li><span class="bao-ic">↗</span>Порог пройден → статус «сертифицирован» уходит в amoCRM / Битрикс24</li>
      </ul>
      <div class="bao-pills">
        <span class="bao-pl bao-pl-c">Role-play 24/7</span>
        <span class="bao-pl bao-pl-g">Оценка 0–100</span>
        <span class="bao-pl bao-pl-v">RAG по вашему каталогу</span>
      </div>
      <p class="bao-foot">Дальше — для кого подходит внедрение и сегменты ЦА →</p>
    </div>

    <div class="bao-rgt">
      <canvas
        id="bao-sales-trainer-canvas"
        aria-label="Анимация: диалог менеджера с AI-клиентом, нарастающая оценка ответа и чек-лист критериев"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bao-sales-trainer-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, fr = 0, pulse = 0;
  var LOOP = 640;

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
    cyan:'#79f2ff', green:'#22c55e', viol:'#8b5cf6',
    text:'#e6edf7', muted:'rgba(230,237,247,.55)',
    card:'rgba(255,255,255,.07)', bdr:'rgba(255,255,255,.12)',
    clientBg:'rgba(121,242,255,.12)', mgrBg:'rgba(139,92,246,.16)',
    warn:'#fbbf24'
  };

  var DIALOG = [
    {who:'client', text:'У конкурента дешевле на 15%. Почему брать у вас?'},
    {who:'mgr', text:'Сравним по ТХ: наша модель даёт +2 года гарантии и сервис за 24 ч…'},
    {who:'client', text:'Нам не срочно — можем подождать.'},
    {who:'mgr', text:'Понимаю. Сейчас акция до конца месяца — фиксируем цену и срок поставки…'}
  ];

  var CHECKS = ['Факты о продукте','Структура ответа','Работа с возражением','Тон бренда'];

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect){ctx.roundRect(x,y,w,h,r);}
    else{ctx.moveTo(x+r,y);ctx.arcTo(x+w,y,x+w,y+h,r);ctx.arcTo(x+w,y+h,x,y+h,r);ctx.arcTo(x,y+h,x,y,r);ctx.arcTo(x,y,x+w,y,r);ctx.closePath();}
    if(fill){ctx.fillStyle=fill;ctx.fill();}
    if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke();}
  }

  function ease(t){return t<0?0:t>1?1:t*t*(3-2*t);}

  function drawHeader(){
    ctx.fillStyle=C.text;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('AI-тренажёр · сценарий «возражение по цене»',14,24);
    var pr = 6+Math.sin(pulse*0.08)*2;
    ctx.beginPath();ctx.arc(W-58,20,pr+3,0,Math.PI*2);
    ctx.fillStyle='rgba(34,197,94,'+(0.12+0.08*Math.sin(pulse*0.08))+')';ctx.fill();
    ctx.beginPath();ctx.arc(W-58,20,4,0,Math.PI*2);
    ctx.fillStyle=C.green;ctx.fill();
    ctx.fillStyle=C.green;
    ctx.font='10px Inter,system-ui,sans-serif';
    ctx.fillText('live',W-48,24);
    ctx.strokeStyle=C.bdr;ctx.lineWidth=1;
    ctx.beginPath();ctx.moveTo(0,36);ctx.lineTo(W,36);ctx.stroke();
  }

  function drawChat(t){
    var chatX=12, chatY=48, chatW=W-148, chatH=H-56;
    rr(chatX,chatY,chatW,chatH,12,C.card,C.bdr,1);

    var phase = (fr % LOOP) / LOOP;
    var msgIdx = phase < 0.28 ? 0 : phase < 0.48 ? 1 : phase < 0.62 ? 2 : 3;
    var localT = phase < 0.28 ? phase/0.28 : phase < 0.48 ? (phase-0.28)/0.2 : phase < 0.62 ? (phase-0.48)/0.14 : (phase-0.62)/0.38;

    var y = chatY + 16;
    for(var i=0;i<=msgIdx;i++){
      var d = DIALOG[i];
      var isClient = d.who === 'client';
      var alpha = (i < msgIdx) ? 1 : ease(localT);
      if(alpha <= 0) continue;
      var maxW = chatW - 48;
      ctx.font='11px Inter,system-ui,sans-serif';
      var lines = wrap(d.text, maxW - 20);
      var bh = 14 + lines.length * 15;
      var bx = isClient ? chatX+14 : chatX+chatW-maxW-4;
      var bw = maxW;
      ctx.globalAlpha = alpha;
      rr(bx, y, bw, bh, 10, isClient ? C.clientBg : C.mgrBg, isClient ? 'rgba(121,242,255,.25)' : 'rgba(139,92,246,.3)', 1);
      ctx.fillStyle = isClient ? C.cyan : C.viol;
      ctx.font='bold 9px Inter,system-ui,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(isClient ? 'Клиент' : 'Менеджер', bx+12, y+14);
      ctx.fillStyle = C.text;
      ctx.font='11px Inter,system-ui,sans-serif';
      for(var li=0;li<lines.length;li++){
        ctx.fillText(lines[li], bx+12, y+28+li*15);
      }
      y += bh + 10;
      ctx.globalAlpha = 1;
    }

    if(msgIdx === 1 && localT < 0.35){
      var ty = chatY + chatH - 28;
      rr(chatX+14, ty, 72, 20, 8, 'rgba(255,255,255,.06)', C.bdr, 1);
      for(var dti=0;dti<3;dti++){
        ctx.beginPath();ctx.arc(chatX+28+dti*14, ty+10, 3, 0, Math.PI*2);
        ctx.fillStyle='rgba(230,237,247,'+(0.3+0.5*Math.sin(pulse*0.15+dti))+')';ctx.fill();
      }
    }
  }

  function wrap(text, maxW){
    var words = text.split(' '), line='', out=[];
    for(var i=0;i<words.length;i++){
      var test = line + words[i] + ' ';
      if(ctx.measureText(test).width > maxW && line){out.push(line.trim());line=words[i]+' ';}
      else line = test;
    }
    if(line.trim()) out.push(line.trim());
    return out.length ? out : [text];
  }

  function drawScorePanel(t){
    var px = W - 128, py = 48, pw = 112, ph = H - 56;
    rr(px, py, pw, ph, 12, C.card, C.bdr, 1);

    var scoreT = Math.max(0, Math.min(1, (fr % LOOP - 180) / 200));
    var score = Math.round(38 + ease(scoreT) * 46);

    ctx.fillStyle = C.muted;
    ctx.font='9px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('AI-оценка', px+12, py+18);

    ctx.fillStyle = C.text;
    ctx.font='bold 26px Inter,system-ui,sans-serif';
    ctx.fillText(score + '/100', px+12, py+46);

    var barX=px+12, barY=py+54, barW=pw-24, barH=6;
    rr(barX, barY, barW, barH, 3, 'rgba(255,255,255,.08)', null);
    var grad = ctx.createLinearGradient(barX,0,barX+barW,0);
    grad.addColorStop(0, C.viol); grad.addColorStop(1, C.green);
    ctx.fillStyle = grad;
    rr(barX, barY, barW * (score/100), barH, 3, grad, null);

    var cy = py + 72;
    for(var ci=0;ci<CHECKS.length;ci++){
      var done = scoreT > (ci+1)/CHECKS.length * 0.85;
      ctx.fillStyle = done ? C.green : 'rgba(255,255,255,.15)';
      ctx.font='10px Inter,system-ui,sans-serif';
      ctx.fillText((done ? '✓ ' : '○ ') + CHECKS[ci], px+12, cy);
      cy += 18;
    }

    if(score >= 80){
      var ba = ease(Math.min(1, (fr%LOOP - 380)/60));
      ctx.globalAlpha = ba;
      rr(px+10, py+ph-36, pw-20, 24, 8, 'rgba(34,197,94,.15)', 'rgba(34,197,94,.4)', 1);
      ctx.fillStyle = C.green;
      ctx.font='bold 9px Inter,system-ui,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('CRM: допущен ✓', px+pw/2, py+ph-20);
      ctx.globalAlpha = 1;
    }
  }

  function draw(){
    ctx.clearRect(0,0,W,H);
    drawHeader();
    drawChat(fr/LOOP);
    drawScorePanel(fr/LOOP);
    fr++; pulse++;
    requestAnimationFrame(draw);
  }
  draw();
})();
</script>
</section>

      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-kak-rabotaet">
        <div class="ym-cta-block__icon" aria-hidden="true">🎯</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверьте, насколько ваши продавцы знают продукт</p>
          <p class="ym-cta-block__sub">Демо-тест на 10–15 вопросов из вашей базы знаний: AI оценит открытые ответы, покажет пробелы и предложит сценарии тренировки. Без обязательств — первый шаг к внедрению тренажёра под ключ.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="aop-section" id="dlya-kogo">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит внедрение AI в обучение продаж</h2>
        <p>Окупается там, где ошибка в консультации стоит денег, а масштабировать живое наставничество сложно: отделы продаж, розница, дилеры, франшизы.</p>
      </div>
      <div class="aop-grid-3 nero-ai-reveal">
        <div class="aop-card">
          <div style="font-size:28px;margin-bottom:12px;" aria-hidden="true">🏪</div>
          <h3>Розница и сети с высокой текучкой</h3>
          <p>Единый стандарт знаний в каждом магазине. Кейс «Пятёрочка»: время обучения с 1,5 ч до 25 мин, экономия 8 500 человеко-часов в год.</p>
        </div>
        <div class="aop-card nero-ai-delay-1">
          <div style="font-size:28px;margin-bottom:12px;" aria-hidden="true">🤝</div>
          <h3>Дилерские сети и франшизы</h3>
          <p>Путь «тест → тренажёр → допуск в CRM». Партнёр не получает горячие лиды, пока не наберёт порог по знанию продукта — статус в amoCRM или Битрикс24.</p>
        </div>
        <div class="aop-card nero-ai-delay-2">
          <div style="font-size:28px;margin-bottom:12px;" aria-hidden="true">🏢</div>
          <h3>AI обучение продавцов для малого бизнеса</h3>
          <p>Кастомный тренажёр под каталог с пилотом на 5–15 человек. Ориентир <strong>150–450 тыс. ₽</strong> — часто дешевле трёх месяцев непродуктивного новичка.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aop-section aop-section-alt" id="etapy">
    <div class="aop-cnt">
      <div class="aop-sh aop-left nero-ai-reveal">
        <span class="aop-eyebrow">Под ключ</span>
        <h2>Внедрение AI-обучения продавцов под ключ</h2>
        <p>От аудита материалов до пилота и интеграции с CRM. Срок типового проекта — <strong>2–4 недели</strong> на пилот.</p>
      </div>
      <div class="aop-card nero-ai-reveal">
        <div class="aop-timeline">
          <div class="aop-tl-item"><div class="aop-tl-dot"></div><h3>Аудит продукта, скриптов и типовых ошибок</h3><p>3–5 дней: каталог, прайс, FAQ, топ-10 возражений, чек-лист оценки РОПа.</p></div>
          <div class="aop-tl-item"><div class="aop-tl-dot"></div><h3>Настройка тренажёра и сценариев</h3><p>1–2 недели: RAG-база, 5–10 сценариев, AI-оценщик. Параллельно — лид-магнит: тест на 10–15 вопросов.</p></div>
          <div class="aop-tl-item"><div class="aop-tl-dot"></div><h3>Запуск пилота и обучение РОПа</h3><p>2–4 недели на 5–15 продавцах: дашборд, корректировка сценариев, масштабирование на отдел.</p></div>
        </div>
      </div>
      <div class="aop-card nero-ai-reveal" style="margin-top:24px;">
        <h3>AI обучение продавцов без программиста — что входит в услугу</h3>
        <p>Команда клиента предоставляет документы и утверждает сценарии; интегратор настраивает техническую часть: RAG, тренажёр, тест, веб или Telegram, CRM, документация, поддержка пилота.</p>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">РОП хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед заказом тренажёра полезно разобраться в промптах, RAG-базе и human-in-the-loop — так быстрее согласуются сценарии и чек-листы оценки. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="aop-section" id="integracii">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Сквозной онбординг</span>
        <h2>Интеграция с CRM и контроль результатов</h2>
        <p><strong>AI обучение продавцов интеграция crm</strong> — часть процесса: статусы обучения, задачи РОПу, привязка к карточке менеджера.</p>
      </div>
      <div class="aop-badge-row nero-ai-reveal" style="justify-content:center;">
        <span class="aop-badge">тест → тренажёр → CRM</span>
        <span class="aop-badge">amoCRM</span>
        <span class="aop-badge">Битрикс24</span>
        <span class="aop-badge">Make / n8n</span>
      </div>
      <div class="aop-table-wrap nero-ai-reveal">
        <table class="aop-table">
          <thead><tr><th>Метрика</th><th>Что показывает</th></tr></thead>
          <tbody>
            <tr><td>Time to productivity</td><td>Дней до выхода на план / порога сертификации</td></tr>
            <tr><td>Оценка по продукту</td><td>Средний балл AI-оценщика по фактам о товаре</td></tr>
            <tr><td>Пробелы в знаниях</td><td>Топ тем с провалами — куда направить повтор</td></tr>
            <tr><td>Доля сертифицированных</td><td>% команды, допущенной к консультациям</td></tr>
            <tr><td>Нагрузка на РОПа</td><td>Сокращение часов на рутинную прослушку</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aop-section aop-section-alt" id="ceny">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI-обучение продавцов</h2>
        <p>Прозрачность по составу работ отличает кастомное внедрение от SaaS с непонятным «от».</p>
      </div>
      <div class="aop-sh nero-ai-reveal">
        <div class="aop-price-band">150–450 тыс. ₽ · кастомное внедрение</div>
      </div>
      <div class="aop-grid-2 nero-ai-reveal">
        <div class="aop-card">
          <h3>От чего зависит стоимость</h3>
          <ul>
            <li>объём базы знаний — SKU, комплектации, языки;</li>
            <li>число сценариев и формат (текст, голос);</li>
            <li>интеграции — CRM, телефония, Telegram, 1С;</li>
            <li>число пользователей — пилот или сеть.</li>
          </ul>
        </div>
        <div class="aop-card">
          <h3>Что входит в пакет «под ключ»</h3>
          <ul>
            <li>аудит базы и RAG;</li>
            <li>тест + диалоговый тренажёр + AI-оценщик;</li>
            <li>дашборд РОПа + интеграция CRM;</li>
            <li>пилот 2–4 недели + обучение команды.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="aop-section" id="keisy">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Референсы рынка</span>
        <h2>Кейсы и примеры внедрения AI-тренажёра продаж</h2>
        <p>Публичные кейсы подтверждают эффективность формата role-play и ассессмента — не обязательно под ваш продукт, но по механике сопоставимо.</p>
      </div>
      <div class="aop-case-grid nero-ai-reveal">
        <div class="aop-case-card">
          <div class="aop-case-tag">Фарма · EGIS</div>
          <h3>Сокращение онбординга</h3>
          <p>AI-тренажёр для торговых представителей; масштаб с 20 до 200 сотрудников; NPS 85%, корреляция AI-оценки с экспертом 0,84.</p>
        </div>
        <div class="aop-case-card">
          <div class="aop-case-tag">Ритейл · X5</div>
          <h3>«Пятёрочка»</h3>
          <p>Время обучения с 1,5 ч до 25 мин; конфликты −6%, товарооборот +2,62% после внедрения тренажёра на SpeechKit.</p>
        </div>
        <div class="aop-case-card">
          <div class="aop-case-tag">B2B · Skorozvon</div>
          <h3>Без потери заявок</h3>
          <p>Новичок отрабатывает скрипт в AI-симуляторе до выхода на линию — не «учится на реальных клиентах».</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aop-section aop-section-alt" id="test">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Лид-магнит</span>
        <h2>Тест знаний продукта для отдела продаж</h2>
        <p>Демонстрация механики, которую внедряем клиентам: AI генерирует вопросы и проверяет открытые ответы — плюс диалоговый тренажёр, а не только викторина.</p>
      </div>
      <div class="aop-test-box nero-ai-reveal">
        <h3>Как пройти тест и получить разбор</h3>
        <ol style="padding-left:20px;color:var(--aop-muted);line-height:1.8;margin:0 0 24px;">
          <li>Нажмите «<?php echo esc_html($primary_cta_label); ?>» на странице.</li>
          <li>Ответьте на вопросы о продукте — как на реальной консультации.</li>
          <li>Получите AI-разбор: что верно, где пробел.</li>
          <li>Оставьте заявку — подготовим тест и тренажёр под ваш каталог.</li>
        </ol>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </section>

  <section class="aop-section" id="faq">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">FAQ</span>
        <h2>FAQ — как заказать и внедрить AI-обучение продавцов</h2>
      </div>
      <div class="aop-faq nero-ai-reveal">
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai обучение продавцов в компании?</div><div class="aop-faq-a">Собрать каталог и скрипты → аудит → RAG и 5–10 сценариев → пилот на 5–15 продавцах → интеграция CRM → масштабирование. Срок пилота обычно 2–4 недели. Проект ведётся под ключ — внутренняя AI-команда не обязательна.</div></div>
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai обучение продавцов?</div><div class="aop-faq-a">Ориентир 150–450 тыс. ₽ за кастомное внедрение с тестом, тренажёром, AI-оценщиком, дашбордом и CRM. Точная смета — после аудита объёма базы знаний.</div></div>
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли интегрировать тренажёр с нашей CRM?</div><div class="aop-faq-a">Да. Стандарт — amoCRM и Битрикс24: статусы обучения, задачи РОПу, привязка к сотруднику. Опционально — телефония, Telegram, 1С-каталог.</div></div>
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-тренажёр отличается от LMS и курсов?</div><div class="aop-faq-a">LMS фиксирует просмотр и тест с вариантами. AI-тренажёр проверяет открытый ответ в диалоге — умеет ли продавец консультировать. Оптимально: LMS для регламентов, AI для ежедневных повторений и допуска к клиентам.</div></div>
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">Чем отличается от «нейропродавца»?</div><div class="aop-faq-a">Нейропродавец ведёт переписку с клиентом вместо менеджера. Тренажёр готовит менеджера — другая задача и результат.</div></div>
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">AI не будет врать про наш продукт?</div><div class="aop-faq-a">База на RAG по вашим документам; сценарии утверждает методолог. Без актуального каталога любой AI ошибётся — процесс это блокирует.</div></div>
      </div>
    </div>
  </section>

  <div class="aop-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы сократить онбординг и убрать ошибки в консультациях?</p>
        <p class="ym-cta-block__sub">AI-тренажёр знаний продукта под ваш каталог: тест, role-play, AI-оценка и статус в CRM. Ориентир внедрения — 150–450 тыс. ₽, пилот 2–4 недели.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>


  <!-- INTERNAL-LINKS:INSERT -->

  <!-- SCHEMA-MARKUP:INSERT -->

</div>

</main>

<script>
/**
 * AOP Sales Trainer Hero Engine — амфитеатр role-play (не завод/конвейер).
 * Canvas: #aop-hero-trainer-canvas
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aop-hero-trainer-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    if (!canvas.parentElement) return;
    var wrap = canvas.parentElement;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = 168;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 520, ch / 168) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    podBg: "#0f172a",
    podAccent: "#79f2ff",
    cardProd: "#a7f3d0",
    cardScript: "#93c5fd",
    cardObj: "#fbcfe8",
    green: "#22c55e",
    violet: "#8b5cf6",
    amber: "#f59e0b",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "rgba(15,23,42,.92)"
  };

  function roundRect(ctx, x, y, w, h, r, fill, stroke) {
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

  function cyclePrg() { return (frame * 0.045) % 220; }

  /* Орбитальные карточки знаний — замена Conveyor */
  function SkillCardOrbit(ctx) {
    var prg = cyclePrg();
    var orbitAngle = frame * 0.022;
    var cards = [
      { color: C.cardProd, label: "SKU" },
      { color: C.cardScript, label: "скрипт" },
      { color: C.cardObj, label: "возр." }
    ];
    for (var i = 0; i < cards.length; i++) {
      var a = orbitAngle + (i * Math.PI * 2 / 3);
      var rx = 115 + Math.sin(frame * 0.03 + i) * 8;
      var ry = 52 + Math.cos(frame * 0.025 + i) * 6;
      var ox = Math.cos(a) * rx;
      var oy = Math.sin(a) * ry * 0.55;
      var alpha = prg < 45 ? Math.min(1, prg / 20) : 1;
      ctx.save();
      ctx.globalAlpha = alpha;
      roundRect(ctx, ox - 14, oy - 10, 28, 20, 4, cards[i].color, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 7px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(cards[i].label, ox, oy + 3);
      ctx.restore();
    }
  }

  /* Кабина цифрового клиента — замена WebsiteTerminal */
  function ClientSimulatorPod(ctx) {
    var prg = cyclePrg();
    var px = 0, py = -18;
    ctx.lineJoin = "round";

    roundRect(ctx, px - 70, py - 42, 140, 88, 12, C.podBg, C.podAccent);

    /* силуэт клиента */
    ctx.fillStyle = C.violet;
    ctx.beginPath();
    ctx.arc(px, py - 18, 14, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    roundRect(ctx, px - 18, py - 2, 36, 28, 6, "rgba(139,92,246,.35)", C.outline);

    /* речь клиента в roleplay */
    if (prg > 48 && prg < 125) {
      var talk = Math.sin(frame * 0.2) > 0;
      roundRect(ctx, px + 22, py - 32, 52, 18, 6, "rgba(121,242,255,.15)", C.podAccent);
      ctx.fillStyle = C.podAccent;
      ctx.font = "bold 7px Inter, sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(talk ? "Дорого!" : "А сроки?", px + 28, py - 20);
    }

    /* шкала оценки */
    var scoreFill = prg < 120 ? Math.max(0, (prg - 55) / 65) : 1;
    if (prg > 55) {
      roundRect(ctx, px - 58, py + 22, 116, 10, 4, "rgba(255,255,255,.08)", null);
      roundRect(ctx, px - 58, py + 22, 116 * scoreFill, 10, 4, C.green, null);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(Math.round(52 + scoreFill * 30) + "/100", px, py + 30);
    }

    /* штамп сертификации — финал (не ракета) */
    if (prg > 178) {
      var stamp = Math.min(1, (prg - 178) / 18);
      ctx.save();
      ctx.globalAlpha = stamp;
      ctx.translate(px + 38, py + 8);
      ctx.rotate(-0.25);
      ctx.strokeStyle = C.green;
      ctx.lineWidth = 2;
      ctx.strokeRect(-22, -10, 44, 20);
      ctx.fillStyle = C.green;
      ctx.font = "bold 8px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ДОПУЩЕН", 0, 4);
      ctx.restore();
    }
  }

  function ObjectionTag(ctx) {
    var prg = cyclePrg();
    if (prg < 50 || prg > 130) return;
    var bob = Math.sin(frame * 0.08) * 4;
    roundRect(ctx, -95, -55 + bob, 44, 16, 6, "rgba(245,158,11,.2)", C.amber);
    ctx.fillStyle = C.amber;
    ctx.font = "bold 7px Inter, sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("«дорого»", -73, -44 + bob);
  }

  function CrmReadyLamp(ctx) {
    var prg = cyclePrg();
    var on = prg > 175;
    ctx.fillStyle = on ? C.green : "rgba(148,163,184,.4)";
    ctx.beginPath();
    ctx.arc(88, 38, 5, 0, Math.PI * 2);
    ctx.fill();
    if (on) {
      ctx.fillStyle = "#86efac";
      ctx.font = "bold 7px Inter, sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("CRM", 96, 41);
    }
  }

  function ProductCatalogStack(ctx) {
    for (var s = 0; s < 3; s++) {
      roundRect(ctx, -118 + s * 3, 18 - s * 3, 22, 28, 3, ["#e2e8f0", "#cbd5e1", "#94a3b8"][s], C.outline);
    }
  }

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.035;
    var prg = cyclePrg();
    var isMoving = false;
    var faceDir = 1;
    var targetX = Math.cos(this.stepTrig * 0.7) * 42;
    var targetY = -22 + Math.sin(this.stepTrig * 0.5) * 18;

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        faceDir = targetX > this.baseX ? 1 : -1;
        this.x = this.baseX + (targetX - this.baseX) * (local / 11);
        this.y = this.baseY + (targetY - this.baseY) * (local / 11);
      } else if (local < 14) {
        this.x = targetX; this.y = targetY;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = targetX - (targetX - this.baseX) * ((local - 14) / 8);
        this.y = targetY - (targetY - this.baseY) * ((local - 14) / 8);
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 5)) * 2 : Math.sin(this.timer * 1.4);
    ctx.save();
    ctx.translate(this.x, this.y);
    roundRect(ctx, -11, 2 + bob, 9, 12, 2, C.outline, null);
    roundRect(ctx, 2, 2 + bob, 9, 12, 2, C.outline, null);
    roundRect(ctx, -13, -10 - bob, 26, 18, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -22 - bob, 10, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.restore();
  };

  var bubbles = [];
  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
  }

  var agents = [
    new Agent(-100, 42, C.agentYellow, "1_architect", 12, ["Чек-лист готов", "Сценарий №7", "Порог 80 баллов"]),
    new Agent(-72, -8, C.agentGreen, "2_seo", 38, ["Возражение в базе", "FAQ по SKU", "LSI для скрипта"]),
    new Agent(-48, 52, C.agentBlue, "3_coder", 72, ["RAG обновлён", "Оценщик v2", "Промпт клиента"]),
    new Agent(78, 48, C.agentPink, "4_designer", 98, ["UI тренажёра", "Дашборд РОПа", "Бейдж сертификата"]),
    new Agent(92, -4, C.agentPurple, "5_deployer", 128, ["Статус в CRM", "Пилот запущен", "Telegram-бот"])
  ];

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    ProductCatalogStack(ctx);
    SkillCardOrbit(ctx);
    ObjectionTag(ctx);
    ClientSimulatorPod(ctx);
    CrmReadyLamp(ctx);

    agents.sort(function (a, b) { return a.y - b.y; });
    agents.forEach(function (a) { a.draw(ctx); });

    var prg = cyclePrg();
    if (prg >= 14 && prg < 14.08) createBubble(-100, 20, "1. Тест знаний");
    if (prg >= 52 && prg < 52.08) createBubble(0, -50, "2. Role-play");
    if (prg >= 98 && prg < 98.08) createBubble(0, -8, "3. AI-оценка");
    if (prg >= 142 && prg < 142.08) createBubble(70, 10, "4. Разбор РОПу");
    if (prg >= 182 && prg < 182.08) createBubble(40, -30, "5. Допуск в CRM");

    ctx.font = "bold 9px Inter, sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 24);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      roundRect(ctx, b.x - tw / 2, b.y - 18 - (b.maxLife - b.life) * 0.04, tw, 16, 5, C.bubbleBg, C.podAccent);
      ctx.fillStyle = "#e2e8f0";
      ctx.fillText(b.text, b.x, b.y - 9 - (b.maxLife - b.life) * 0.04);
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

<script>
(function(){
  document.querySelectorAll('.aop-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aop-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aop-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aop-faq-q');
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
  var root = document.querySelector('.ai-obuchenie-prodavcov-page') || document.querySelector('.aop-content');
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

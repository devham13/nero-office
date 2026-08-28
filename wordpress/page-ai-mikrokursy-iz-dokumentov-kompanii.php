<?php
/**
 * Template Name: AI-агент для микрокурсов из документов компании
 * Description: AI превращает регламенты и инструкции в микрокурсы с тестами и чек-листами. Внедрение под ключ.
 */
declare(strict_types=1);

$page_seo_title       = 'AI-агент для микрокурсов из документов компании — внедрение';
$page_seo_description = 'AI превращает регламенты и инструкции в микрокурсы с тестами и чек-листами. Внедрение под ключ для HR, франшиз и отделов продаж. Пробный урок из документа.';

add_filter(
    'document_title_parts',
    static function (array $parts) use ($page_seo_title): array {
        $parts['title'] = $page_seo_title;
        return $parts;
    },
    20
);

add_action(
    'wp_head',
    static function () use ($page_seo_title, $page_seo_description): void {
        echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
    },
    1
);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Для кого', 'href' => '#dlya-kogo'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Создать урок';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = '#kak-rabotaet';

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
/* Kadence → pill-шапка темы */
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
.mkdk-hero{min-height:100vh;min-height:100dvh;position:relative;}
.mkdk-intro-text p{text-align:left!important;}
/* mkdk — ai-mikrokursy-iz-dokumentov-kompanii */
.mkdk-content{
  --mkdk-bg:#050711;--mkdk-bg2:#080b17;
  --mkdk-surface:rgba(255,255,255,.072);--mkdk-text:#e6edf7;
  --mkdk-muted:#9aa8bd;--mkdk-soft:#c7d2e5;--mkdk-heading:#fff;
  --mkdk-border:rgba(255,255,255,.10);
  --mkdk-primary:#79f2ff;--mkdk-accent:#8b5cf6;--mkdk-green:#22c55e;--mkdk-warn:#f59e0b;
  --mkdk-r:18px;--mkdk-r-lg:24px;--mkdk-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--mkdk-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.mkdk-content *,.mkdk-content *::before,.mkdk-content *::after{box-sizing:border-box;}
.mkdk-content a{color:inherit;text-decoration:none;}
.mkdk-content p{color:var(--mkdk-muted);line-height:1.72;margin:0 0 1em;}
.mkdk-content p:last-child{margin-bottom:0;}
.mkdk-content h2,.mkdk-content h3,.mkdk-content h4{color:var(--mkdk-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.mkdk-content strong{color:var(--mkdk-soft);}
.mkdk-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.mkdk-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--mkdk-muted);font-size:14.5px;line-height:1.65;}
.mkdk-content ul li::before{content:'›';position:absolute;left:0;color:var(--mkdk-primary);font-weight:700;}
.mkdk-cnt{width:min(var(--mkdk-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.mkdk-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.mkdk-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.mkdk-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.mkdk-sh.mkdk-left{margin-left:0;text-align:left;}
.mkdk-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.mkdk-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.mkdk-sh.mkdk-left p{margin-left:0;}
.mkdk-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--mkdk-primary);margin-bottom:14px;}
.mkdk-gt{background:linear-gradient(92deg,#fff 0%,var(--mkdk-primary) 44%,var(--mkdk-accent) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.mkdk-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.mkdk-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.mkdk-intro-text{position:relative;padding-left:20px;}
.mkdk-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--mkdk-primary),var(--mkdk-accent));}
.mkdk-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.mkdk-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.mkdk-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--mkdk-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.mkdk-kpi-card .kl{font-size:11px;font-weight:600;color:var(--mkdk-muted);line-height:1.4;}
.mkdk-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
.mkdk-kpi-card.mkdk-kpi-good .kv{color:var(--mkdk-green);}
.mkdk-kpi-card.mkdk-kpi-warn .kv{color:var(--mkdk-warn);}
@media(max-width:900px){.mkdk-intro-grid{grid-template-columns:1fr;gap:36px;}.mkdk-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.mkdk-intro-kpi{grid-template-columns:1fr 1fr;}}
.mkdk-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.mkdk-toc,.ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.mkdk-toc a,.ym-toc a{display:inline-block;padding:9px 18px;background:var(--mkdk-surface);border:1px solid var(--mkdk-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--mkdk-muted);transition:border-color .2s,color .2s,background .2s;}
.mkdk-toc a:hover,.ym-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--mkdk-primary);background:rgba(121,242,255,.08);}
.mkdk-bento{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
@media(max-width:900px){.mkdk-bento{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.mkdk-bento{grid-template-columns:1fr;}}
.mkdk-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--mkdk-border);border-radius:var(--mkdk-r-lg);padding:26px;backdrop-filter:blur(16px);transition:border-color .22s,transform .22s;}
.mkdk-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.mkdk-card h3{font-size:17px;margin-bottom:10px;}
.mkdk-card p{font-size:14px;margin:0;}
.mkdk-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.mkdk-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.mkdk-grid-2,.mkdk-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.mkdk-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.mkdk-grid-3{grid-template-columns:1fr;}}
.mkdk-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0;}
.mkdk-table{width:100%;border-collapse:collapse;font-size:14px;}
.mkdk-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--mkdk-primary);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.mkdk-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--mkdk-text);vertical-align:top;}
.mkdk-table tr:last-child td{border-bottom:none;}
.mkdk-table tr:hover td{background:rgba(255,255,255,.03);}
.mkdk-table .mkdk-col-highlight{background:rgba(139,92,246,.08);border-left:2px solid var(--mkdk-accent);}
.mkdk-pipeline{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin:32px 0;}
@media(max-width:900px){.mkdk-pipeline{grid-template-columns:1fr 1fr;}}
@media(max-width:500px){.mkdk-pipeline{grid-template-columns:1fr;}}
.mkdk-step{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--mkdk-r);padding:22px 18px;text-align:center;position:relative;}
.mkdk-step-num{font-size:28px;margin-bottom:8px;}
.mkdk-step h3{font-size:15px;margin-bottom:8px;}
.mkdk-step p{font-size:13px;margin:0;}
.mkdk-chips{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-top:24px;}
.mkdk-chip{padding:10px 18px;border-radius:999px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);font-size:13px;font-weight:600;color:var(--mkdk-soft);}
.mkdk-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.mkdk-case-grid{grid-template-columns:1fr;}}
.mkdk-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.mkdk-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--mkdk-green);margin-bottom:10px;}
.mkdk-timeline{position:relative;padding-left:40px;}
.mkdk-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--mkdk-primary),var(--mkdk-accent));opacity:.35;border-radius:2px;}
.mkdk-tl-item{position:relative;margin-bottom:32px;}
.mkdk-tl-item:last-child{margin-bottom:0;}
.mkdk-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--mkdk-primary);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.mkdk-tl-item h3{font-size:17px;margin-bottom:8px;}
.mkdk-tl-item p{font-size:14.5px;margin:0;}
.mkdk-stat-row{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:32px;}
@media(max-width:768px){.mkdk-stat-row{grid-template-columns:1fr;}}
.mkdk-stat{background:rgba(139,92,246,.1);border:1px solid rgba(139,92,246,.25);border-radius:var(--mkdk-r);padding:28px;text-align:center;}
.mkdk-stat .num{font-size:clamp(32px,5vw,48px);font-weight:900;color:var(--mkdk-primary);line-height:1;margin-bottom:8px;}
.mkdk-stat .lbl{font-size:14px;color:var(--mkdk-muted);}
.mkdk-quote{border-left:3px solid var(--mkdk-accent);padding:20px 24px;margin:28px 0;background:rgba(139,92,246,.06);border-radius:0 14px 14px 0;font-style:italic;color:var(--mkdk-soft);}
.mkdk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.mkdk-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.mkdk-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--mkdk-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.mkdk-faq-q::after{content:'▾';font-size:13px;color:var(--mkdk-primary);flex-shrink:0;transition:transform .25s;}
.mkdk-faq-item.open .mkdk-faq-q::after{transform:rotate(180deg);}
.mkdk-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--mkdk-muted);line-height:1.72;}
.mkdk-faq-item.open .mkdk-faq-a{max-height:600px;padding:0 24px 20px;}
.mkdk-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:24px;list-style:none;padding:0;}
.mkdk-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--mkdk-muted);}
.mkdk-cta-checklist li::before{content:'✓';color:var(--mkdk-green);font-weight:800;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:linear-gradient(135deg,rgba(255,255,255,.04),rgba(121,242,255,.06));border-color:rgba(255,255,255,.14);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--mkdk-muted);font-size:15px;margin:0 auto 22px;max-width:640px;line-height:1.7;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:var(--mkdk-primary);text-decoration:underline;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.nero-ai-delay-3{transition-delay:.36s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page mkdk-page" role="main" tabindex="-1">

<section class="nero-ai-hero mkdk-hero" id="hero" aria-labelledby="mkdk-hero-title">
<style>
/* ── mkdk-hero: самодостаточные стили (префикс mkdk-, токены Артура) ── */
.mkdk-hero {
  --mkdk-primary: #79f2ff;
  --mkdk-accent: #8b5cf6;
  --mkdk-green: #22c55e;
  --mkdk-warn: #f59e0b;
  --mkdk-text: #e6edf7;
  --mkdk-muted: #9aa8bd;
  --mkdk-soft: #c7d2e5;
  --mkdk-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.mkdk-hero::before {
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
.mkdk-hero::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121,242,255,.12), transparent 66%);
  filter: blur(8px);
  animation: mkdkHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes mkdkHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.04); }
}
.mkdk-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.mkdk-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.mkdk-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 64px);
  line-height: .98;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.mkdk-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--mkdk-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.mkdk-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--mkdk-primary) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.mkdk-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--mkdk-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.mkdk-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.mkdk-hero .nero-ai-badge {
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
.mkdk-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.mkdk-hero .nero-ai-btn {
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
.mkdk-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.mkdk-hero .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--mkdk-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.mkdk-hero .nero-ai-btn-secondary {
  color: var(--mkdk-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.mkdk-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--mkdk-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.mkdk-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.mkdk-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.mkdk-hero .nero-ai-dots { display: flex; gap: 7px; }
.mkdk-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.mkdk-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.mkdk-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.mkdk-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.mkdk-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.mkdk-hero .nero-ai-window-body { padding: 16px; }
.mkdk-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.mkdk-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.mkdk-hero .nero-ai-live-pill {
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
.mkdk-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--mkdk-green);
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: mkdkPulse 1.6s infinite;
}
@keyframes mkdkPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.mkdk-hero .mkdk-doc-flow {
  display: grid;
  grid-template-columns: 1fr auto 1.2fr;
  gap: 10px;
  align-items: center;
  margin-bottom: 12px;
  padding: 12px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
}
.mkdk-hero .mkdk-pdf-card {
  text-align: center;
  padding: 10px 8px;
  border-radius: 12px;
  background: rgba(245,158,11,.12);
  border: 1px solid rgba(245,158,11,.28);
}
.mkdk-hero .mkdk-pdf-card strong {
  display: block;
  font-size: 22px;
  color: #fde68a;
  line-height: 1;
}
.mkdk-hero .mkdk-pdf-card span {
  display: block;
  margin-top: 4px;
  font-size: 10px;
  font-weight: 700;
  color: var(--mkdk-muted);
  text-transform: uppercase;
  letter-spacing: .06em;
}
.mkdk-hero .mkdk-flow-arrow {
  font-size: 20px;
  color: var(--mkdk-primary);
  font-weight: 900;
}
.mkdk-hero .mkdk-lesson-stack {
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.mkdk-hero .mkdk-lesson-card {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 7px 10px;
  border-radius: 10px;
  background: rgba(139,92,246,.14);
  border: 1px solid rgba(139,92,246,.28);
  font-size: 11px;
  font-weight: 700;
  color: #e9d5ff;
}
.mkdk-hero .mkdk-lesson-card em {
  font-style: normal;
  width: 22px;
  height: 22px;
  border-radius: 6px;
  background: var(--mkdk-accent);
  color: #fff;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 10px;
  flex-shrink: 0;
}
.mkdk-hero .mkdk-test-pill {
  display: inline-flex;
  align-self: flex-start;
  margin-top: 2px;
  padding: 5px 10px;
  border-radius: 999px;
  background: rgba(34,197,94,.15);
  border: 1px solid rgba(34,197,94,.35);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
}
.mkdk-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.mkdk-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.mkdk-hero .nero-ai-metric span {
  display: block;
  color: var(--mkdk-muted);
  font-size: 11px;
  font-weight: 700;
}
.mkdk-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 20px;
  letter-spacing: -0.03em;
  line-height: 1.1;
}
.mkdk-hero .nero-ai-metric small {
  display: block;
  margin-top: 3px;
  color: #64748b;
  font-size: 10px;
}
.mkdk-hero .mkdk-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin-bottom: 12px;
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.08);
  background: linear-gradient(180deg, rgba(8,12,28,.9), rgba(4,8,20,.95));
}
.mkdk-hero #mkdk-hero-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.mkdk-hero .nero-ai-task-stream { display: flex; flex-direction: column; gap: 8px; }
.mkdk-hero .nero-ai-task {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.045);
  border: 1px solid rgba(255,255,255,.07);
}
.mkdk-hero .nero-ai-task-icon {
  flex-shrink: 0;
  width: 32px;
  height: 32px;
  border-radius: 10px;
  background: rgba(121,242,255,.12);
  border: 1px solid rgba(121,242,255,.22);
  color: var(--mkdk-primary);
  font-size: 10px;
  font-weight: 800;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}
.mkdk-hero .nero-ai-task div { flex: 1; min-width: 0; }
.mkdk-hero .nero-ai-task strong {
  display: block;
  font-size: 12px;
  color: #fff;
  line-height: 1.3;
}
.mkdk-hero .nero-ai-task span {
  display: block;
  font-size: 11px;
  color: var(--mkdk-muted);
  line-height: 1.35;
}
.mkdk-hero .nero-ai-status {
  flex-shrink: 0;
  font-size: 10px;
  font-weight: 800;
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #86efac;
  text-transform: lowercase;
}
.mkdk-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fcd34d;
}
@media (max-width: 960px) {
  .mkdk-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .mkdk-hero .nero-ai-dashboard { transform: none; }
  .mkdk-hero .nero-ai-metrics-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 520px) {
  .mkdk-hero .mkdk-doc-flow { grid-template-columns: 1fr; text-align: center; }
  .mkdk-hero .mkdk-flow-arrow { transform: rotate(90deg); }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai микрокурсы</p>
      <h1 id="mkdk-hero-title">AI-агент для микрокурсов из документов компании: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Превращаем регламенты и инструкции в короткие уроки, тесты и чек-листы — сотрудники учатся быстрее, HR обновляет материалы без ручной верстки</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Микроуроки 5–15 мин</li>
        <li class="nero-ai-badge">Тесты из регламента</li>
        <li class="nero-ai-badge">Чек-листы</li>
        <li class="nero-ai-badge">SCORM / LMS</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: документ превращается в микрокурс">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">document → course · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Регламент → микрокурс</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>

          <div class="mkdk-doc-flow" aria-hidden="true">
            <div class="mkdk-pdf-card">
              <strong>PDF</strong>
              <span>40 стр. · SOP</span>
            </div>
            <div class="mkdk-flow-arrow" aria-hidden="true">→</div>
            <div class="mkdk-lesson-stack">
              <div class="mkdk-lesson-card"><em>1</em> Вводный модуль · 7 мин</div>
              <div class="mkdk-lesson-card"><em>2</em> Процедура на точке · 5 мин</div>
              <div class="mkdk-lesson-card"><em>3</em> Исключения · 6 мин</div>
              <span class="mkdk-test-pill">тест готов</span>
            </div>
          </div>

          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>completion</span>
              <strong>80–90%</strong>
              <small>микроформат</small>
            </div>
            <div class="nero-ai-metric">
              <span>time-to-course</span>
              <strong>часы</strong>
              <small>не недели</small>
            </div>
            <div class="nero-ai-metric">
              <span>статус</span>
              <strong>live</strong>
              <small>версионность</small>
            </div>
          </div>

          <div class="mkdk-dash-canvas-wrap">
            <canvas id="mkdk-hero-canvas" role="img" aria-label="Анимация: PDF-регламент разбивается на микроуроки, тест и чек-лист, затем публикуется в LMS"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Этапы пайплайна">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">PDF</span>
              <div><strong>Загрузка регламента</strong><span>PDF, Word, wiki — chunking с заголовками</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Архитектор модулей</strong><span>5–15 мин на урок · learning objectives</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Тест + чек-лист</strong><span>RAG по абзацам регламента</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review HR</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * mkdk-hero-engine — L&D-студия: SemanticPageRibbon → MicrocourseAssemblerPod → LmsPublishGate
 * Мир: учебная мастерская HR (не завод vibecoding, не желоба 1С)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("mkdk-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    scroll: "#fef3c7",
    scrollEdge: "#f59e0b",
    shardBlue: "#bfdbfe",
    shardGreen: "#bbf7d0",
    shardViolet: "#ddd6fe",
    podBase: "#1e293b",
    podGlow: "rgba(121,242,255,0.25)",
    cardBg: "#312e81",
    cardFront: "#4c1d95",
    quizGreen: "#22c55e",
    checklist: "#fde68a",
    gateFrame: "#0f172a",
    gateCyan: "#79f2ff",
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

  function drawTextLines(ctx, x, y, w, n) {
    ctx.strokeStyle = "rgba(148,163,184,0.45)";
    ctx.lineWidth = 0.8;
    for (var i = 0; i < n; i++) {
      ctx.beginPath();
      ctx.moveTo(x + 4, y + 5 + i * 5);
      ctx.lineTo(x + w - 4 - (i % 2) * 8, y + 5 + i * 5);
      ctx.stroke();
    }
  }

  /* PDF-простыня на стеллаже */
  function ScrollDocument() {
    this.unroll = 0;
  }
  ScrollDocument.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    this.unroll = prg < 70 ? prg / 70 : 1;
    var h = 18 + this.unroll * 42;
    drawRR(ctx, -195, -55, 28, h, 3, C.scroll, C.scrollEdge);
    drawTextLines(ctx, -195, -50, 28, Math.floor(3 + this.unroll * 6));
    ctx.fillStyle = C.scrollEdge;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("SOP", -181, -48);
    if (this.unroll > 0.6) {
      ctx.fillStyle = "rgba(245,158,11,0.7)";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.fillText("40 стр.", -181, -55 + h + 6);
    }
  };

  /* Лента смысловых фрагментов — вместо Conveyor */
  function SemanticPageRibbon() {
    this.shards = [
      { off: 0, color: C.shardBlue, label: "§1" },
      { off: 55, color: C.shardGreen, label: "§2" },
      { off: 110, color: C.shardViolet, label: "§3" },
      { off: 165, color: C.shardBlue, label: "FAQ" }
    ];
  }
  SemanticPageRibbon.prototype.draw = function (ctx) {
    drawRR(ctx, -210, 28, 420, 14, 7, "rgba(71,85,105,0.5)", C.outline);
    var wave = Math.sin(frame * 0.06) * 2;
    this.shards.forEach(function (sh) {
      var t = ((frame * 0.55 + sh.off) % 220) / 220;
      var sx = -200 + t * 400;
      var sy = 35 + wave;
      if (t > 0.05 && t < 0.92) {
        drawRR(ctx, sx - 10, sy - 7, 20, 14, 3, sh.color, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(sh.label, sx, sy + 2);
      }
    });
  };

  /* Пьедестал сборки микрокурса — вместо WebsiteTerminal */
  function MicrocourseAssemblerPod() {
    this.cards = 0;
    this.quizAlpha = 0;
    this.scormY = 0;
  }
  MicrocourseAssemblerPod.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    ctx.save();
    ctx.shadowColor = C.podGlow;
    ctx.shadowBlur = prg > 60 && prg < 200 ? 16 : 4;
    drawRR(ctx, -55, -42, 110, 78, 10, C.podBase, C.outline);
    drawRR(ctx, -48, -35, 96, 10, 4, "rgba(121,242,255,0.15)", C.gateCyan);
    ctx.restore();

    if (prg >= 75 && prg < 140) {
      this.cards = Math.min(3, Math.floor((prg - 75) / 18));
      for (var i = 0; i < this.cards; i++) {
        var pop = Math.min(1, (prg - 75 - i * 18) / 10);
        var cy2 = -22 + i * 16;
        ctx.globalAlpha = pop;
        drawRR(ctx, -38, cy2, 76, 12, 3, C.cardFront, C.outline);
        ctx.fillStyle = "#e9d5ff";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText("Урок " + (i + 1), -32, cy2 + 8);
        ctx.globalAlpha = 1;
      }
    }

    if (prg >= 140 && prg < 210) {
      this.quizAlpha = Math.min(1, (prg - 140) / 20);
      ctx.globalAlpha = this.quizAlpha;
      drawRR(ctx, 20, -30, 28, 14, 4, "rgba(34,197,94,0.25)", C.quizGreen);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ТЕСТ", 34, -20);
      drawRR(ctx, 20, -10, 28, 14, 4, "rgba(253,230,138,0.25)", C.checklist);
      ctx.fillStyle = "#fde68a";
      ctx.fillText("ЧЕК", 34, 0);
      ctx.globalAlpha = 1;
    }

    if (prg >= 210) {
      var fly = (prg - 210) / 50;
      this.scormY = -fly * 55;
      ctx.globalAlpha = Math.max(0, 1 - fly * 0.9);
      drawRR(ctx, -18, -8 + this.scormY, 36, 22, 4, "#1e3a5f", C.gateCyan);
      ctx.fillStyle = C.gateCyan;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("SCORM", 0, 6 + this.scormY);
      ctx.globalAlpha = 1;
    }
  };

  /* Орбита вопросов вокруг пьедестала */
  function QuizOrbitRing() {
    this.angle = 0;
  }
  QuizOrbitRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 130 || prg > 220) return;
    this.angle += 0.04;
    var r = 62 + Math.sin(frame * 0.05) * 4;
    for (var q = 0; q < 4; q++) {
      var a = this.angle + q * (Math.PI / 2);
      var qx = Math.cos(a) * r;
      var qy = Math.sin(a) * 0.35 * r - 8;
      drawRR(ctx, qx - 6, qy - 5, 12, 10, 3, "rgba(34,197,94,0.2)", C.quizGreen);
      ctx.fillStyle = "#86efac";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("?", qx, qy + 2);
    }
  };

  /* Портал публикации в LMS */
  function LmsPublishGate() {
    this.pulse = 0;
  }
  LmsPublishGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    this.pulse = 0.5 + Math.sin(frame * 0.08) * 0.5;
    drawRR(ctx, 145, -48, 52, 72, 8, C.gateFrame, C.gateCyan);
    drawRR(ctx, 152, -38, 38, 48, 5, "rgba(121,242,255,0.08)", null);
    ctx.strokeStyle = "rgba(121,242,255," + (0.25 + this.pulse * 0.35) + ")";
    ctx.lineWidth = 1.5;
    ctx.strokeRect(152, -38, 38, 48);
    ctx.fillStyle = C.gateCyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("LMS", 171, -12);
    if (prg >= 215) {
      var glow = Math.min(1, (prg - 215) / 25);
      ctx.globalAlpha = glow;
      ctx.fillStyle = "rgba(34,197,94,0.35)";
      ctx.beginPath();
      ctx.arc(171, 2, 10 + glow * 6, 0, Math.PI * 2);
      ctx.fill();
      ctx.globalAlpha = 1;
    }
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.hitAnimation = 0;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var isMoving = false;
    var carryType = null;
    var faceDir = 1;
    var prg = (frame * 0.042) % 260;

    var targetX = -10 + (this.stepTrig % 3) * 22;
    var targetY = -55 + Math.floor(this.stepTrig / 50) * 12;

    if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true; faceDir = 1;
        carryType = this.color;
        this.x = this.baseX + (targetX - this.baseX) * (local / 12);
        this.y = this.baseY + (targetY - this.baseY) * (local / 12);
      } else if (local < 16) {
        this.x = targetX; this.y = targetY;
      } else {
        isMoving = true; faceDir = -1;
        this.x = targetX - (targetX - this.baseX) * ((local - 16) / 12);
        this.y = targetY - (targetY - this.baseY) * ((local - 16) / 12);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 18, rnd, 240);
    }

    var bob = Math.abs(Math.sin(this.timer * 3)) * 2;
    if (!isMoving) bob = Math.sin(this.timer * 1.5);

    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -10, -4 + bob, 8, 12, 2, C.outline, null);
    drawRR(ctx, 2, -4 + bob, 8, 12, 2, C.outline, null);
    drawRR(ctx, -14, -14 - bob, 28, 18, 6, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -26 - bob, 10, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 1.5;
    ctx.strokeStyle = C.outline;
    ctx.stroke();
    if (carryType) {
      drawRR(ctx, -14 * faceDir, -20 - bob, 12, 12, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new ScrollDocument());
  entities.push(new SemanticPageRibbon());
  entities.push(new MicrocourseAssemblerPod());
  entities.push(new QuizOrbitRing());
  entities.push(new LmsPublishGate());

  entities.push(new Agent(-175, 55, C.agentYellow, "1_architect", 20, [
    "Декомпозирую регламент…", "Модуль 1: onboarding", "Learning objectives готовы"
  ]));
  entities.push(new Agent(-120, 72, C.agentGreen, "2_seo", 65, [
    "Заголовки уроков из SOP", "Микроформат 7 мин", "Ключи в тексте урока"
  ]));
  entities.push(new Agent(-55, 58, C.agentBlue, "3_coder", 105, [
    "SCORM-обёртка", "Чанки с цитатами", "Версия документа v3"
  ]));
  entities.push(new Agent(10, 70, C.agentPink, "4_designer", 145, [
    "Карточки уроков", "Чек-лист перед сменой", "Mobile-first верстка"
  ]));
  entities.push(new Agent(55, 52, C.agentPurple, "5_deployer", 185, [
    "Жду ревью HR…", "Публикую в LMS", "Webhook: курс live"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife, maxLife: customLife });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.042) % 260;
    if (prg >= 18 && prg < 18.08) createBubble(-175, -20, "1. Ingest PDF");
    if (prg >= 68 && prg < 68.08) createBubble(-120, 10, "2. Architect");
    if (prg >= 108 && prg < 108.08) createBubble(-55, -5, "3. Уроки");
    if (prg >= 148 && prg < 148.08) createBubble(10, 15, "4. Тест + чек");
    if (prg >= 215 && prg < 215.08) createBubble(120, -30, "5. LMS publish");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      drawRR(ctx, bub.x - tw / 2, bub.y - 18, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bub.x, bub.y - 8);
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



<!-- ====================================================
     КОНТЕНТНАЯ ЧАСТЬ (после hero Алины)
     ==================================================== -->
<div class="mkdk-content">

  <!-- INTRO -->
  <section class="mkdk-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="mkdk-cnt nero-ai-container">
      <div class="mkdk-intro-grid nero-ai-reveal">
        <div class="mkdk-intro-text">
          <p class="mkdk-eyebrow">Лонгрид · ai микрокурсы</p>
          <p><strong>Коротко:</strong> длинные корпоративные документы почти не работают как обучение — сотрудники не доходят до конца, HR не успевает обновлять курсы, а бизнес теряет деньги на ошибках и медленном онбординге.</p>
          <p>Регламент на 40 страниц, PDF-инструкция «для внутреннего использования», onboarding-пакет из десятка файлов — типичный набор в HR, учебных центрах, франшизах и отделах продаж. Формально обучение есть. Практически — сотрудники открывают документ, пролистывают, закрывают.</p>
        </div>
        <div class="mkdk-intro-kpi" aria-label="Ключевые показатели">
          <div class="mkdk-kpi-card mkdk-kpi-warn">
            <div class="kv">13–30%</div>
            <div class="kl">completion длинных курсов</div>
            <div class="ks">eLearning Industry, 2025</div>
          </div>
          <div class="mkdk-kpi-card mkdk-kpi-good">
            <div class="kv">80–90%</div>
            <div class="kl">completion микромодулей</div>
            <div class="ks">eLearning Industry, 2025</div>
          </div>
          <div class="mkdk-kpi-card">
            <div class="kv">48 ч</div>
            <div class="kl">демо-микрокурс из документа</div>
            <div class="ks">лид-магнит Nero Network</div>
          </div>
          <div class="mkdk-kpi-card">
            <div class="kv">100–300 тыс. ₽</div>
            <div class="kl">ориентир пилота под ключ</div>
            <div class="ks">контент-план 2026</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <p class="mkdk-related nero-ai-reveal" style="font-size:15px;">Когда микрокурс нужно не только опубликовать, но и назначить менеджеру при создании сделки, смотрите <a href="/vnedrenie-ai-amocrm/" style="color:var(--mkdk-primary);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a> — соседняя посадочная про автоматизацию сделок и задач без ручного переноса данных.</p>
  <p class="mkdk-related nero-ai-reveal nero-ai-delay-1" style="font-size:15px;margin-top:12px;">Если регламенты живут в учётной системе, а обучение привязано к должностям в 1С:ЗУП или ERP, полезен сценарий <a href="/ai-1c-erp/" style="color:var(--mkdk-primary);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP</a> — тот же контур, что в кейсе «Азия Цемент» с ЛНА и тестами из документов.</p>

  <!-- TOC -->
  <div class="mkdk-toc-outer">
    <div class="mkdk-cnt">
      <nav class="ym-toc mkdk-toc" aria-label="Оглавление статьи">
        <a href="#boli">Боли HR</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- BOLI -->
  <section class="mkdk-section" id="boli">
    <div class="mkdk-cnt">
      <div class="mkdk-sh">
        <span class="mkdk-eyebrow">Боль бизнеса</span>
        <h2>Почему сотрудники не читают длинные инструкции и регламенты</h2>
        <p>Проблема не в «ленивых людях». Проблема в формате и процессе обновления материалов.</p>
      </div>
      <div class="mkdk-bento">
        <div class="mkdk-card nero-ai-reveal">
          <h3>Обучение не обновляется</h3>
          <p>Регламент изменился — курс в LMS живёт прошлой версией. Методист переверстает урок через недели, а сотрудники уже работают по новым правилам.</p>
        </div>
        <div class="mkdk-card nero-ai-reveal nero-ai-delay-1">
          <h3>Разрозненные версии</h3>
          <p>В филиалах и франшизе одна процедура описана тремя разными PDF. Учебный центр не контролирует, что реально читают на точках.</p>
        </div>
        <div class="mkdk-card nero-ai-reveal nero-ai-delay-2">
          <h3>Ручная разработка не масштабируется</h3>
          <p>Один проверочный тест из регламента — от 1 до 8 часов ручной работы (кейс «Азия Цемент», GigaChat + 1С:ERP).</p>
        </div>
        <div class="mkdk-card nero-ai-reveal">
          <h3>Высокий COR ≠ обучение</h3>
          <p>Course Completion Rate 70% не гарантирует усвоение — метрика часто отражает «открыл и пролистал» (Glabix, 2026).</p>
        </div>
        <div class="mkdk-card nero-ai-reveal nero-ai-delay-1">
          <h3>Skill gaps растут</h3>
          <p>63% работодателей называют пробелы в навыках главным препятствием; 85% планируют усилить переквалификацию (МТС Линк, 2026).</p>
        </div>
        <div class="mkdk-card nero-ai-reveal nero-ai-delay-2">
          <h3>Что ломается при ручной верстке</h3>
          <p>Структура, тексты, тесты, SCORM, назначение в LMS — всё вручную. При изменении документа цикл начинается снова. Дни и недели на один курс.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CHTO-TAKOE -->
  <section class="mkdk-section mkdk-section-alt" id="chto-takoe">
    <div class="mkdk-cnt">
      <div class="mkdk-sh">
        <span class="mkdk-eyebrow">Определение</span>
        <h2>Что такое AI-агент для микрокурсов из документов</h2>
        <p>Автономный пайплайн: загрузка корпоративных файлов → анализ структуры → генерация уроков, тестов и чек-листов → публикация в LMS или SCORM.</p>
      </div>

      <div class="mkdk-grid-2 nero-ai-reveal">
        <div class="mkdk-card">
          <h3>От регламента и SOP к уроку за минуты</h3>
          <p>HR загружает регламент → агент разбивает на микромодули → генерирует уроки, тесты и чек-лист «перед сменой» → HR модерирует → курс публикуется в LMS или назначается через CRM/Telegram.</p>
        </div>
        <div class="mkdk-card">
          <h3>Не чат с документами</h3>
          <p>Task-specific система: ingestion → architect → generate → assess → publish. Gartner: к концу 2026 года <strong>40% корпоративных приложений</strong> будут иметь такие агенты (было &lt;5% в 2025).</p>
        </div>
      </div>

      <div class="mkdk-sh mkdk-left" style="margin-top:48px;">
        <h3 style="font-size:22px;">Чем агент отличается от обычного конструктора курсов</h3>
      </div>
      <div class="mkdk-table-wrap nero-ai-reveal">
        <table class="mkdk-table">
          <thead>
            <tr>
              <th>Критерий</th>
              <th>Конструктор / SaaS LMS</th>
              <th>AI-агент под ключ</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Источник контента</td>
              <td>Ручной ввод или шаблоны</td>
              <td>Корпоративные документы + RAG</td>
            </tr>
            <tr>
              <td>Обновление при изменении регламента</td>
              <td>Вручную</td>
              <td>Сигнал «курс устарел», пересборка блоков</td>
            </tr>
            <tr>
              <td>Интеграция CRM / франшиза</td>
              <td>Ограничена</td>
              <td>Кастом: amoCRM, Bitrix24, 1С</td>
            </tr>
            <tr>
              <td>Governance</td>
              <td>Базовая</td>
              <td>Цитаты на абзацы регламента, модерация HR</td>
            </tr>
            <tr>
              <td>Traceability</td>
              <td>Часто нет</td>
              <td>Каждый блок урока → source chunk</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- KAK-RABOTAET + БОРИС -->
  <section class="mkdk-section" id="kak-rabotaet">
    <div class="mkdk-cnt">
      <div class="mkdk-sh">
        <span class="mkdk-eyebrow">Пайплайн</span>
        <h2>Как AI превращает документы в уроки, тесты и чек-листы</h2>
        <p>Четыре шага — от загрузки PDF до публикации без ручной верстки. Multi-agent pipeline (Frontiers in AI, 2026): semantic ingestion → architect → RAG generation → SCORM packaging.</p>
      </div>

      <!-- ===== БОРИС: визуальный блок ===== -->
      <section id="ai-mikrokursy-boris-block" class="bmk-root" aria-label="Мониторинг multi-agent pipeline: документ проходит через агентов в реальном времени">
        <style>
        .bmk-root{margin:0 0 48px;}
        .bmk-card{display:grid;grid-template-columns:42% 58%;border-radius:24px;overflow:hidden;box-shadow:0 8px 48px rgba(0,0,0,.35),0 0 0 1.5px rgba(121,242,255,.18);min-height:480px;}
        @media(max-width:960px){.bmk-card{grid-template-columns:1fr;min-height:auto;}}
        .bmk-lft{background:#f8fafc;padding:44px 36px;display:flex;flex-direction:column;justify-content:center;}
        @media(max-width:600px){.bmk-lft{padding:28px 22px;}}
        .bmk-ey{display:inline-flex;align-items:center;gap:7px;font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;color:#0e7490;margin:0 0 14px;}
        .bmk-ey::before{content:'';display:inline-block;width:20px;height:2px;background:#79f2ff;border-radius:1px;}
        .bmk-h3{font-size:23px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 18px;}
        .bmk-ul{list-style:none;margin:0 0 20px;padding:0;display:flex;flex-direction:column;gap:9px;}
        .bmk-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
        .bmk-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(121,242,255,.15);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0891b2;font-style:normal;}
        .bmk-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:16px;}
        .bmk-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
        .bmk-pl-g{background:rgba(34,197,94,.1);color:#15803d;border:1.5px solid rgba(34,197,94,.25);}
        .bmk-pl-b{background:rgba(121,242,255,.12);color:#0e7490;border:1.5px solid rgba(121,242,255,.3);}
        .bmk-pl-v{background:rgba(139,92,246,.1);color:#6d28d9;border:1.5px solid rgba(139,92,246,.25);}
        .bmk-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
        .bmk-rgt{background:linear-gradient(145deg,#050711 0%,#0a0e1c 55%,#070b16 100%);position:relative;overflow:hidden;min-height:400px;}
        #mkdk-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
        </style>
        <div class="bmk-card">
          <div class="bmk-lft">
            <span class="bmk-ey">Multi-agent pipeline</span>
            <h3 class="bmk-h3">Документ в движении: четыре агента собирают микрокурс в реальном времени</h3>
            <ul class="bmk-ul">
              <li><span class="bmk-ic">1</span><strong>Ingest</strong> — PDF разбивается на chunks с сохранением структуры</li>
              <li><span class="bmk-ic">2</span><strong>Architect</strong> — декомпозиция на модули 5–15 минут</li>
              <li><span class="bmk-ic">3</span><strong>Assess</strong> — тесты и чек-листы из тех же абзацев</li>
              <li><span class="bmk-ic">4</span><strong>Publish</strong> — SCORM/HTML → LMS или CRM</li>
            </ul>
            <div class="bmk-pills">
              <span class="bmk-pl bmk-pl-b">RAG traceability</span>
              <span class="bmk-pl bmk-pl-g">human-in-the-loop</span>
              <span class="bmk-pl bmk-pl-v">15–20 мин черновик</span>
            </div>
            <p class="bmk-foot">Дальше — пошаговая схема пайплайна ↓</p>
          </div>
          <div class="bmk-rgt">
            <canvas id="mkdk-pipeline-canvas" aria-label="Анимация: документ проходит через четыре AI-агента — ingest, architect, assess, publish — и превращается в микроуроки" role="img"></canvas>
          </div>
        </div>
        <script>
        (function(){
          var cv=document.getElementById('mkdk-pipeline-canvas');
          if(!cv)return;
          var cx=cv.getContext('2d'),W=0,H=0,fr=0;
          function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;W=cv.width;H=cv.height;}
          window.addEventListener('resize',resize);resize();
          var AGENTS=[
            {label:'Ingest',color:'#79f2ff',icon:'\u{1F4C4}'},
            {label:'Architect',color:'#8b5cf6',icon:'\u{1F9E9}'},
            {label:'Assess',color:'#22c55e',icon:'\u2705'},
            {label:'Publish',color:'#f59e0b',icon:'\u{1F680}'}
          ];
          var docX=-80,docPhase=0,particles=[];
          function loop(){
            fr++;
            cx.fillStyle='#050711';cx.fillRect(0,0,W,H);
            var pad=24,stepW=(W-pad*2)/4,gY=H*0.38,gH=H*0.42;
            AGENTS.forEach(function(ag,i){
              var x=pad+i*stepW+stepW*0.1,w=stepW*0.8;
              cx.strokeStyle='rgba(255,255,255,.08)';cx.lineWidth=1;
              cx.strokeRect(x,gY,w,gH);
              cx.fillStyle=ag.color;cx.font='bold 12px Inter,system-ui,sans-serif';cx.textAlign='center';
              cx.fillText(ag.icon,x+w/2,gY+28);
              cx.fillStyle='rgba(226,232,240,.9)';cx.font='600 11px Inter,system-ui,sans-serif';
              cx.fillText(ag.label,x+w/2,gY+gH-14);
              if(i<3){cx.strokeStyle='rgba(121,242,255,.35)';cx.lineWidth=2;cx.beginPath();cx.moveTo(x+w+4,gY+gH/2);cx.lineTo(x+stepW-4,gY+gH/2);cx.stroke();}
            });
            docPhase=(fr*0.008)%5;
            var t=docPhase/5;
            docX=pad+t*(W-pad*2-60);
            var pulse=0.5+0.5*Math.sin(fr*0.08);
            cx.fillStyle='rgba(121,242,255,'+(0.15+0.1*pulse)+')';
            cx.beginPath();cx.arc(docX+30,gY+gH/2,28+pulse*4,0,Math.PI*2);cx.fill();
            cx.fillStyle='#e2e8f0';cx.font='bold 11px Inter,system-ui,sans-serif';cx.textAlign='center';
            cx.fillText('PDF',docX+30,gY+gH/2+4);
            if(fr%40===0&&particles.length<12)particles.push({x:docX+30,y:gY+gH/2,life:60,clr:AGENTS[Math.floor(t*4)%4].color});
            particles=particles.filter(function(p){p.x+=1.2;p.y-=0.3;p.life--;if(p.life>0){cx.fillStyle=p.clr;cx.globalAlpha=p.life/60;cx.fillRect(p.x,p.y,4,4);cx.globalAlpha=1;}return p.life>0;});
            if(docPhase>4){
              var ox=pad+3*stepW+stepW*0.25;
              for(var j=0;j<3;j++){cx.fillStyle=['#79f2ff','#8b5cf6','#22c55e'][j];cx.globalAlpha=0.7+0.3*Math.sin(fr*0.05+j);cx.fillRect(ox+j*22,gY+50,18,24,4);cx.globalAlpha=1;}
              cx.fillStyle='rgba(34,197,94,.8)';cx.font='10px Inter,system-ui,sans-serif';cx.fillText('\u2713 \u0442\u0435\u0441\u0442',ox+30,gY+90);
            }
            cx.fillStyle='rgba(226,232,240,.5)';cx.font='10px Inter,system-ui,sans-serif';cx.textAlign='left';
            cx.fillText('pipeline monitor \u00b7 live',16,20);
            requestAnimationFrame(loop);
          }
          loop();
        })();
        </script>
      </section>
      <!-- ===== /БОРИС ===== -->

      <div class="mkdk-pipeline nero-ai-reveal">
        <div class="mkdk-step">
          <div class="mkdk-step-num" aria-hidden="true">📄</div>
          <h3>Шаг 1 — загрузка</h3>
          <p>PDF, DOCX, PPT, Confluence, Notion. OCR при необходимости. Chunking с сохранением заголовков и нумерации.</p>
        </div>
        <div class="mkdk-step">
          <div class="mkdk-step-num" aria-hidden="true">🧩</div>
          <h3>Шаг 2 — микроуроки</h3>
          <p>Architect Agent декомпозирует «простыню» на модули 5–15 минут с learning objectives на каждый блок.</p>
        </div>
        <div class="mkdk-step">
          <div class="mkdk-step-num" aria-hidden="true">✅</div>
          <h3>Шаг 3 — тесты</h3>
          <p>Квизы, ситуационные кейсы, чек-листы «перед сменой» и «перед звонком» из тех же абзацев регламента.</p>
        </div>
        <div class="mkdk-step">
          <div class="mkdk-step-num" aria-hidden="true">🚀</div>
          <h3>Шаг 4 — публикация</h3>
          <p>SCORM/HTML → LMS/CRM. Webhook при изменении исходного файла → флаг «курс требует ревью».</p>
        </div>
      </div>

      <div class="mkdk-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="mkdk-card">
          <h3>Кейс «Азия Цемент»</h3>
          <p>Drag-and-drop Word/PDF → GigaChat генерирует тесты → секунды вместо 1–8 часов. 100% охват онбординга; графики тестирования — с недель до дней.</p>
        </div>
        <div class="mkdk-card">
          <h3>Версионность</h3>
          <p>При изменении регламента — сигнал пересобрать урок. Teamly и Habr фиксируют боль «LMS есть, а курсов нет» — агент закрывает разрыв между базой знаний и обучением.</p>
        </div>
      </div>
    </div>
  </section>

  <p class="mkdk-related nero-ai-reveal" style="font-size:15px;">Для команд, где обучение идёт в связке с обработкой входящих обращений, сравните <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--mkdk-primary);text-decoration:underline;text-underline-offset:3px">AI-обработку входящей почты в CRM</a> — triage писем и маршрутизация заявок дополняют сценарий «документ → микрокурс → назначение в CRM».</p>
  <p class="mkdk-related nero-ai-reveal nero-ai-delay-1" style="font-size:15px;margin-top:12px;">На корпоративном масштабе те же принципы task-specific агентов уже проверены в enterprise: в разборе <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--mkdk-primary);text-decoration:underline;text-underline-offset:3px">KPMG и Claude — уроки AI для бизнеса</a> показаны managed-агенты для 276 000 сотрудников — логичное продолжение тренда agentic AI в L&amp;D.</p>

  <!-- CTA-1: после kak-rabotaet -->
  <div class="mkdk-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-demo">
      <div class="ym-cta-block__icon" aria-hidden="true">📄</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Пробный микрокурс из одного вашего документа</p>
        <p class="ym-cta-block__sub">Загрузите регламент, SOP или onboarding-инструкцию — за 48 часов покажем 3–5 микроуроков по 5–7 минут, тест и чек-лист. Не презентацию «как это могло бы быть», а рабочий черновик с human-in-the-loop.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Создать урок</a>
      </div>
    </div>
  </div>

  <!-- DLYA-KOGO -->
  <section class="mkdk-section mkdk-section-alt" id="dlya-kogo">
    <div class="mkdk-cnt">
      <div class="mkdk-sh">
        <span class="mkdk-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит внедрение AI корпоративного обучения</h2>
        <p>Пилот в коридоре 100–300 тыс. ₽ доступен HR в средних компаниях, франшизам и отделам продаж без собственного IT-отдела.</p>
      </div>
      <div class="mkdk-grid-3">
        <div class="mkdk-card nero-ai-reveal" data-nero-tooltip="Единая библиотека регламентов → микрокурсы по должностям → аналитика completion rate">
          <div class="mkdk-eyebrow">👥 HR</div>
          <h3>HR и внутренние учебные центры</h3>
          <p>Единая библиотека регламентов → микрокурсы по должностям → аналитика completion rate и провалов в тестах. Снижение нагрузки на методистов.</p>
        </div>
        <div class="mkdk-card nero-ai-reveal nero-ai-delay-1" data-nero-tooltip="Новый регламент УК → микрокурс для всех партнёров за 24–48 часов">
          <div class="mkdk-eyebrow">🏪 Франшизы</div>
          <h3>Франшизы и сети с едиными стандартами</h3>
          <p>ФРУК: 210 УК, 3500+ пользователей — LMS + база знаний + AI. Ускорение запуска точек на 30–40%. Новый регламент → автоматический микрокурс для всех партнёров.</p>
        </div>
        <div class="mkdk-card nero-ai-reveal nero-ai-delay-2" data-nero-tooltip="Скрипт продаж → микрокурс → назначение в amoCRM при создании сделки">
          <div class="mkdk-eyebrow">📞 Sales</div>
          <h3>Отделы продаж и onboarding новичков</h3>
          <p>Скрипт продаж изменился → микрокурс для менеджеров → назначение в amoCRM/Bitrix24. Sales onboarding без «прочитай 80 страниц продуктовой линейки».</p>
        </div>
      </div>
    </div>
  </section>

  <!-- PREIMUSHCHESTVA -->
  <section class="mkdk-section" id="preimushchestva">
    <div class="mkdk-cnt">
      <div class="mkdk-sh">
        <span class="mkdk-eyebrow">Преимущества</span>
        <h2>Преимущества AI-микрокурсов перед классическим e-learning</h2>
      </div>
      <div class="mkdk-table-wrap nero-ai-reveal">
        <table class="mkdk-table">
          <thead>
            <tr><th>Формат</th><th>Типичный completion rate</th></tr>
          </thead>
          <tbody>
            <tr><td>Длинный курс / «простыня»</td><td>13–30%</td></tr>
            <tr><td>Self-paced онлайн (норма COR)</td><td>13–15%</td></tr>
            <tr><td>Compliance-обучение</td><td>~72%</td></tr>
            <tr><td>Микрообучение с геймификацией</td><td><strong style="color:var(--mkdk-green);">80–90%</strong></td></tr>
          </tbody>
        </table>
      </div>
      <div class="mkdk-grid-3" style="margin-top:28px;">
        <div class="mkdk-card nero-ai-reveal">
          <h3>Скорость обновления</h3>
          <p>Ручная разработка: дни–недели. Multi-agent edtech (60x): 15–20 минут на publishable output. Демо из одного документа за 48 часов.</p>
        </div>
        <div class="mkdk-card nero-ai-reveal nero-ai-delay-1">
          <h3>Короткий формат</h3>
          <p>Модули 5–15 минут. Retention микроформата — +25–60% vs традиционные форматы (Continu, 2025).</p>
        </div>
        <div class="mkdk-card nero-ai-reveal nero-ai-delay-2">
          <h3>Единый стиль и актуальность</h3>
          <p>Агент выдерживает tone of voice. При расхождении курса и PDF — подсветка устаревших блоков. Единые стандарты во филиалах.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- INTEGRACII -->
  <section class="mkdk-section mkdk-section-alt" id="integracii">
    <div class="mkdk-cnt">
      <div class="mkdk-sh">
        <span class="mkdk-eyebrow">Интеграции</span>
        <h2>Интеграции: LMS, CRM и HR-системы</h2>
        <p>Агент не заменяет LMS — он кормит её контентом. Кастомная связка закрывает воронку адаптации целиком.</p>
      </div>
      <div class="mkdk-grid-2 nero-ai-reveal">
        <div class="mkdk-card">
          <h3>Экспорт в LMS / SCORM</h3>
          <p>SCORM 1.2 / xAPI export. iSpring Learn, Websoft, МТС Линк Курсы, Teamly. Собственный лёгкий веб-портал, если LMS нет.</p>
        </div>
        <div class="mkdk-card">
          <h3>Связка с CRM и HR</h3>
          <p>amoCRM / Bitrix24 — назначение обучения новому сотруднику. 1С:ЗУП / 1С:ERP — привязка к должностям. Telegram — бот «пройди урок» + напоминания.</p>
        </div>
      </div>
      <div class="mkdk-chips nero-ai-reveal">
        <span class="mkdk-chip">amoCRM</span>
        <span class="mkdk-chip">Bitrix24</span>
        <span class="mkdk-chip">1С:ERP</span>
        <span class="mkdk-chip">Telegram</span>
        <span class="mkdk-chip">SCORM</span>
        <span class="mkdk-chip">iSpring</span>
        <span class="mkdk-chip">Teamly</span>
        <span class="mkdk-chip">n8n / Make</span>
      </div>
      <div class="mkdk-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Внедрение без программиста</h3>
        <p>HR загружает документы, модерирует, назначает. IT один раз подключает интеграции. Триггеры «новый файл в папке → пересборка курса» — n8n, Make.com без кода. Nero Network — внедрение под ключ.</p>
      </div>
    </div>
  </section>

  <!-- CTA-2: после integracii -->
  <div class="mkdk-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
        <p class="ym-cta-block__sub">Перед внедрением AI-агента для микрокурсов полезно разобраться в RAG, human-in-the-loop и no-code-триггерах (n8n/Make) — это ускоряет согласование с HR и IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo (strpos($secondary_cta_url, 'http') === 0 ? ' target="_blank" rel="noopener noreferrer"' : ''); ?>><?php echo esc_html($secondary_cta_label); ?></a>.</p>
      </div>
    </aside>
  </div>

  <!-- KEISY -->
  <section class="mkdk-section" id="keisy">
    <div class="mkdk-cnt">
      <div class="mkdk-sh">
        <span class="mkdk-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры: микрокурсы из корпоративных документов</h2>
      </div>
      <div class="mkdk-case-grid">
        <div class="mkdk-case-card nero-ai-reveal">
          <div class="mkdk-case-tag">Россия · производство</div>
          <h3>«Азия Цемент»</h3>
          <p>Подсистема ЛНА в 1С:ERP, GigaChat для тестов, drag-and-drop Word/PDF. Готовые LMS не подошли — кастом. 100% охват онбординга; графики тестирования — с недель до дней.</p>
        </div>
        <div class="mkdk-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="mkdk-case-tag">EU · гостиничный бизнес</div>
          <h3>SANA Hotels / Twistag</h3>
          <p>Сотни PowerPoint с институциональными знаниями; рост штата 20% без найма training staff. Персонализация: тот же регламент — разные акценты для продаж и склада.</p>
        </div>
        <div class="mkdk-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="mkdk-case-tag">Regulated · финансы</div>
          <h3>UJJI AI</h3>
          <p>RAG на PDF, видео, записи встреч → structured learning paths. Time-to-launch — с ~2 недель до &lt;1 часа. Governance для regulated отраслей.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CENY -->
  <section class="mkdk-section mkdk-section-alt" id="ceny">
    <div class="mkdk-cnt">
      <div class="mkdk-sh">
        <span class="mkdk-eyebrow">Коммерция</span>
        <h2>Стоимость и этапы внедрения AI-агента под ключ</h2>
        <p>Аудит → пилот на одном документе → интеграции → масштабирование.</p>
      </div>
      <div class="mkdk-timeline nero-ai-reveal">
        <div class="mkdk-tl-item">
          <div class="mkdk-tl-dot"></div>
          <h3>1. Аудит (2–3 дня)</h3>
          <p>1–3 типовых документа + матрица ролей + текущие LMS/CRM.</p>
        </div>
        <div class="mkdk-tl-item">
          <div class="mkdk-tl-dot"></div>
          <h3>2. Пилот (1–2 недели)</h3>
          <p>Демо-микрокурс — 3–5 уроков по 5–7 мин + тест + чек-лист из одного регламента.</p>
        </div>
        <div class="mkdk-tl-item">
          <div class="mkdk-tl-dot"></div>
          <h3>3. Интеграция (1–2 недели)</h3>
          <p>CRM, Telegram, LMS/SCORM. Governance: модерация HR, цитаты на source.</p>
        </div>
        <div class="mkdk-tl-item">
          <div class="mkdk-tl-dot"></div>
          <h3>4. Масштабирование</h3>
          <p>Пакетная обработка папки регламентов, шаблоны по отделам (sales, support, франшиза).</p>
        </div>
      </div>
      <div class="mkdk-table-wrap nero-ai-reveal" style="margin-top:40px;">
        <table class="mkdk-table">
          <thead>
            <tr><th>KPI</th><th>До</th><th>После (ориентир)</th></tr>
          </thead>
          <tbody>
            <tr><td>Time-to-course</td><td>дни–недели</td><td>часы–1–2 дня</td></tr>
            <tr><td>Completion rate</td><td>13–30%</td><td>80–90% (микроформат)</td></tr>
            <tr><td>% актуальных курсов</td><td>низкий</td><td>рост за счёт версионности</td></tr>
            <tr><td>Часов методиста на тест</td><td>1–8 ч</td><td>минуты (генерация + модерация)</td></tr>
          </tbody>
        </table>
      </div>
      <div class="mkdk-card nero-ai-reveal" style="margin-top:24px;text-align:center;">
        <h3>Ориентир бюджета: 100–300 тыс. ₽</h3>
        <p>Конкурентный пилот/MVP vs 1,5–4 млн ₽ turnkey на рынке РФ. Вход без «съесть весь бюджет»; upsell на интеграции и масштаб.</p>
      </div>
      <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте бюджет пилота под ваши документы</p>
          <p class="ym-cta-block__sub">Ориентир <strong>100–300 тыс. ₽</strong> за внедрение AI-агента под ключ: аудит, демо-микрокурс, интеграция CRM/LMS. На созвоне оценим объём регламентов, KPI (time-to-course, completion rate) и схему governance.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Создать урок</a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Вопросы и ответы</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TREND -->
  <section class="mkdk-section" id="trend">
    <div class="mkdk-cnt">
      <div class="mkdk-sh">
        <span class="mkdk-eyebrow">Тренд 2026</span>
        <h2>Agentic AI в корпоративном обучении</h2>
        <p>Внедрение ai агентов в L&D — не хайп «через три года», а окно 2026.</p>
      </div>
      <div class="mkdk-stat-row nero-ai-reveal">
        <div class="mkdk-stat">
          <div class="num" data-nero-count="40" data-nero-suffix="%">40%</div>
          <div class="lbl">enterprise-приложений с task-specific агентами к концу 2026 (Gartner)</div>
        </div>
        <div class="mkdk-stat">
          <div class="num">17%</div>
          <div class="lbl">организаций уже развернули AI-агентов (Odin Training, 2026)</div>
        </div>
        <div class="mkdk-stat">
          <div class="num">70%+</div>
          <div class="lbl">крупных российских компаний используют генеративный ИИ (МТС Линк, 2026)</div>
        </div>
      </div>
      <blockquote class="mkdk-quote nero-ai-reveal">
        Сдвиг от content delivery к capability orchestration — агенты диагностируют skill gaps, проектируют пути, коучат в момент работы. — Cornerstone, 2026
      </blockquote>
      <div class="mkdk-card nero-ai-reveal">
        <h3>Ответ Nero Network на риски agentic AI</h3>
        <p>Human-in-the-loop, traceability, пилот с одним документом — снижение риска «демо без ROI». &gt;40% agentic-проектов могут быть отменены к 2027 из-за costs и unclear ROI (Gartner, цит. Odin Training Solutions).</p>
      </div>
    </div>
  </section>

  <!-- SRAVNENIE -->
  <section class="mkdk-section mkdk-section-alt nero-ai-section-alt" id="sravnenie">
    <div class="mkdk-cnt">
      <div class="mkdk-sh">
        <span class="mkdk-eyebrow">Сравнение</span>
        <h2>SaaS vs кастомный агент Nero Network</h2>
      </div>
      <div class="mkdk-table-wrap nero-ai-reveal">
        <table class="mkdk-table">
          <thead>
            <tr>
              <th>Параметр</th>
              <th>iSpring / Teamly / Easygenerator</th>
              <th class="mkdk-col-highlight">Nero Network — агент под ключ</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Скорость черновика</td>
              <td>Минуты</td>
              <td class="mkdk-col-highlight">Минуты + кастом pipeline</td>
            </tr>
            <tr>
              <td>CRM / франшиза</td>
              <td>Ограничено</td>
              <td class="mkdk-col-highlight">amoCRM, Bitrix24, 1С, Telegram</td>
            </tr>
            <tr>
              <td>Версионность документа</td>
              <td>Слабо</td>
              <td class="mkdk-col-highlight">Сигнал при изменении PDF</td>
            </tr>
            <tr>
              <td>152-ФЗ / on-premise</td>
              <td>Зависит от SaaS</td>
              <td class="mkdk-col-highlight">GigaChat, YandexGPT, локальный контур</td>
            </tr>
            <tr>
              <td>Лид-магнит</td>
              <td>Trial SaaS</td>
              <td class="mkdk-col-highlight">Ваш документ → демо-урок за 48 ч</td>
            </tr>
            <tr>
              <td>Бюджет входа</td>
              <td>Подписка + скрытые интеграции</td>
              <td class="mkdk-col-highlight">Пилот 100–300 тыс. ₽</td>
            </tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="text-align:center;margin-top:24px;color:var(--mkdk-muted);">Когда SaaS достаточно: одна LMS, стандартные курсы. Когда нужен агент: франшиза, sales onboarding, compliance с версионностью, on-premise.</p>
    </div>
  </section>

  <!-- FAQ -->
  <section class="mkdk-section" id="faq">
    <div class="mkdk-cnt">
      <div class="mkdk-sh">
        <span class="mkdk-eyebrow">FAQ</span>
        <h2>Частые вопросы про AI корпоративное обучение</h2>
      </div>
      <div class="mkdk-faq nero-ai-reveal" id="mkdk-faq-accordion">
        <div class="mkdk-faq-item">
          <div class="mkdk-faq-q" role="button" tabindex="0" aria-expanded="false">Какие документы подходят для микрокурса?</div>
          <div class="mkdk-faq-a">Регламенты, ЛНА, SOP, onboarding-инструкции, скрипты продаж, политики безопасности, продуктовые описания, презентации, wiki-статьи. Форматы: PDF, DOCX, PPT, Confluence, Notion. Эволют — 15+ типов; iSpring AI — TXT, PDF, DOCX до 5 файлов.</div>
        </div>
        <div class="mkdk-faq-item">
          <div class="mkdk-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли свой LMS?</div>
          <div class="mkdk-faq-a">Нет. Агент экспортирует SCORM/xAPI или даёт лёгкий портал. У нас уже есть LMS — агент не заменяет, а ускоряет наполнение.</div>
        </div>
        <div class="mkdk-faq-item">
          <div class="mkdk-faq-q" role="button" tabindex="0" aria-expanded="false">Как защищаются корпоративные данные?</div>
          <div class="mkdk-faq-a">RAG строго по вашим документам; облако РФ (GigaChat, YandexGPT) или on-premise (Llama/Qwen, pgvector, Qdrant). 152-ФЗ. Модерация HR перед публикацией.</div>
        </div>
        <div class="mkdk-faq-item">
          <div class="mkdk-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли начать с одного документа?</div>
          <div class="mkdk-faq-a">Да. Лид-магнит Nero Network: пробный микрокурс из одного регламента — 3–5 микроуроков + тест + чек-лист. Минимальный риск перед масштабированием.</div>
        </div>
        <div class="mkdk-faq-item">
          <div class="mkdk-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai корпоративное обучение?</div>
          <div class="mkdk-faq-a">Аудит документов и систем → пилот на одном файле → интеграция CRM/LMS → governance → пакетная обработка. Nero Network — внедрение под ключ, без найма отдельной AI-лаборатории.</div>
        </div>
        <div class="mkdk-faq-item">
          <div class="mkdk-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai корпоративное обучение?</div>
          <div class="mkdk-faq-a">Ориентир пилота Nero Network: 100–300 тыс. ₽. Полный turnkey на рынке РФ — от 1,5–4 млн ₽. ROI через time-to-publish и снижение часов методиста.</div>
        </div>
        <div class="mkdk-faq-item">
          <div class="mkdk-faq-q" role="button" tabindex="0" aria-expanded="false">AI не выдумает факты из регламента?</div>
          <div class="mkdk-faq-a">Риск галлюцинаций снижается RAG по source chunks, цитатами на абзацы регламента и human-in-the-loop. «Загрузить в ChatGPT» — не governance.</div>
        </div>
        <div class="mkdk-faq-item">
          <div class="mkdk-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли программист на стороне клиента?</div>
          <div class="mkdk-faq-a">Для пилота — нет. HR работает в UI: загрузка, модерация, назначение. IT подключает интеграции один раз; триггеры — n8n/Make.</div>
        </div>
        <div class="mkdk-faq-item">
          <div class="mkdk-faq-q" role="button" tabindex="0" aria-expanded="false">Что если регламент изменится?</div>
          <div class="mkdk-faq-a">Webhook или триггер «файл обновлён» → агент помечает устаревшие блоки курса → HR ревьюит → пересборка без полной ручной верстки.</div>
        </div>
        <div class="mkdk-faq-item">
          <div class="mkdk-faq-q" role="button" tabindex="0" aria-expanded="false">Сотрудники не будут учиться — что делать?</div>
          <div class="mkdk-faq-a">Микроформат 5–15 мин, mobile-first, Telegram, completion 80–90%. Длинные инструкции не читают — короткие уроки с тестом проходят.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA FINAL -->
  <section class="mkdk-section mkdk-section-alt" id="cta">
    <div class="mkdk-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Создайте пробный микрокурс из одного документа</p>
          <ul class="mkdk-cta-checklist" aria-label="Что входит в пилот">
            <li>Демо из вашего регламента за 48 часов</li>
            <li>3–5 уроков + тест + чек-лист</li>
            <li>Схема интеграции CRM/LMS</li>
            <li>Бюджет 100–300 тыс. ₽ без скрытых условий</li>
          </ul>
          <p class="ym-cta-block__sub">Длинные инструкции не работают. AI-микрокурсы из корпоративных документов — практичный ответ на боль «обучение не обновляется».</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Создать урок</a>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.mkdk-content -->

<script>
(function(){
  document.querySelectorAll('.mkdk-faq-q').forEach(function(q){
    q.addEventListener('click',function(){
      var item=q.parentElement;
      var open=item.classList.contains('open');
      document.querySelectorAll('.mkdk-faq-item.open').forEach(function(el){el.classList.remove('open');el.querySelector('.mkdk-faq-q').setAttribute('aria-expanded','false');});
      if(!open){item.classList.add('open');q.setAttribute('aria-expanded','true');}
    });
    q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();q.click();}});
  });
})();
</script>


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "//#organization",
      "name": "Nero Network",
      "url": "/"
    },
    {
      "@type": "WebSite",
      "@id": "//#website",
      "url": "/",
      "name": "Nero Network",
      "publisher": {
        "@id": "//#organization"
      }
    },
    {
      "@type": "WebPage",
      "@id": "/ai-mikrokursy-iz-dokumentov-kompanii/#webpage",
      "url": "/ai-mikrokursy-iz-dokumentov-kompanii/",
      "name": "AI-агент для микрокурсов из документов компании: внедрение под ключ",
      "description": "AI превращает регламенты и инструкции в микрокурсы с тестами и чек-листами. Внедрение под ключ для HR, франшиз и отделов продаж. Пробный урок из документа.",
      "isPartOf": {
        "@id": "//#website"
      },
      "about": {
        "@id": "//#organization"
      }
    },
    {
      "@type": "BreadcrumbList",
      "@id": "/ai-mikrokursy-iz-dokumentov-kompanii/#breadcrumb",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Главная",
          "item": "/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "AI-агент для микрокурсов из документов компании: внедрение под ключ",
          "item": "/ai-mikrokursy-iz-dokumentov-kompanii/"
        }
      ]
    },
    {
      "@type": "Service",
      "@id": "/ai-mikrokursy-iz-dokumentov-kompanii/#service",
      "name": "AI-агент для микрокурсов из документов компании: внедрение под ключ",
      "description": "AI превращает регламенты и инструкции в микрокурсы с тестами и чек-листами. Внедрение под ключ для HR, франшиз и отделов продаж. Пробный урок из документа.",
      "url": "/ai-mikrokursy-iz-dokumentov-kompanii/",
      "provider": {
        "@id": "//#organization"
      }
    },
    {
      "@type": "FAQPage",
      "@id": "/ai-mikrokursy-iz-dokumentov-kompanii/#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Какие документы подходят для микрокурса?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Регламенты, ЛНА, SOP, onboarding-инструкции, скрипты продаж, политики безопасности, продуктовые описания, презентации, wiki-статьи. Форматы: PDF, DOCX, PPT, Confluence, Notion. Эволют — 15+ типов; iSpring AI — TXT, PDF, DOCX до 5 файлов."
          }
        },
        {
          "@type": "Question",
          "name": "Нужен ли свой LMS?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Нет. Агент экспортирует SCORM/xAPI или даёт лёгкий портал. У нас уже есть LMS — агент не заменяет, а ускоряет наполнение."
          }
        },
        {
          "@type": "Question",
          "name": "Как защищаются корпоративные данные?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "RAG строго по вашим документам; облако РФ (GigaChat, YandexGPT) или on-premise (Llama/Qwen, pgvector, Qdrant). 152-ФЗ. Модерация HR перед публикацией."
          }
        },
        {
          "@type": "Question",
          "name": "Можно ли начать с одного документа?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да. Лид-магнит Nero Network: пробный микрокурс из одного регламента — 3–5 микроуроков + тест + чек-лист. Минимальный риск перед масштабированием."
          }
        },
        {
          "@type": "Question",
          "name": "Как внедрить ai корпоративное обучение?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Аудит документов и систем → пилот на одном файле → интеграция CRM/LMS → governance → пакетная обработка. Nero Network — внедрение под ключ, без найма отдельной AI-лаборатории."
          }
        },
        {
          "@type": "Question",
          "name": "Сколько стоит ai корпоративное обучение?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Ориентир пилота Nero Network: 100–300 тыс. ₽. Полный turnkey на рынке РФ — от 1,5–4 млн ₽. ROI через time-to-publish и снижение часов методиста."
          }
        },
        {
          "@type": "Question",
          "name": "AI не выдумает факты из регламента?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Риск галлюцинаций снижается RAG по source chunks, цитатами на абзацы регламента и human-in-the-loop. «Загрузить в ChatGPT» — не governance."
          }
        },
        {
          "@type": "Question",
          "name": "Нужен ли программист на стороне клиента?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Для пилота — нет. HR работает в UI: загрузка, модерация, назначение. IT подключает интеграции один раз; триггеры — n8n/Make."
          }
        },
        {
          "@type": "Question",
          "name": "Что если регламент изменится?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Webhook или триггер «файл обновлён» → агент помечает устаревшие блоки курса → HR ревьюит → пересборка без полной ручной верстки."
          }
        },
        {
          "@type": "Question",
          "name": "Сотрудники не будут учиться — что делать?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Микроформат 5–15 мин, mobile-first, Telegram, completion 80–90%. Длинные инструкции не читают — короткие уроки с тестом проходят."
          }
        }
      ]
    }
  ]
}
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

<?php
/**
 * Template Name: AI-агент для 1С и ERP: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI-агента для 1С и ERP. Кейсы, интеграции, ROI. Аудит документооборота.
 */

$page_seo_title       = 'AI-агент для 1С и ERP: внедрение и настройка под ключ';
$page_seo_description = 'Внедрение AI-агента для 1С и ERP: автоматизация счетов, заявок и первички без ручного ввода. Интеграция с CRM, OCR, ROI-калькулятор. Аудит документооборота.';
$page_og_image        = null;

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Зачем AI', 'href' => '#kak-rabotaet'],
    ['label' => 'Документы', 'href' => '#dokumenty'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

if (function_exists('nero_page_register_social_meta')) {
    nero_page_register_social_meta($page_seo_title, $page_seo_description, $page_og_image);
}

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Посчитать экономию';
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

.a1c-content{
  --a1c-bg:#050711;--a1c-bg2:#080b17;--a1c-bg3:#0a0e1c;
  --a1c-surface:rgba(255,255,255,.072);--a1c-surface2:rgba(255,255,255,.108);
  --a1c-text:#e6edf7;--a1c-muted:#9aa8bd;--a1c-soft:#c7d2e5;--a1c-heading:#fff;
  --a1c-border:rgba(255,255,255,.10);--a1c-border-s:rgba(255,255,255,.18);
  --a1c-accent:#f5c518;--a1c-violet:#8b5cf6;--a1c-green:#22c55e;--a1c-cyan:#79f2ff;
  --a1c-btn-from:#2563eb;--a1c-btn-to:#7c3aed;
  --a1c-shadow:0 24px 72px rgba(0,0,0,.4);
  --a1c-r:18px;--a1c-r-lg:24px;--a1c-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--a1c-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.a1c-content *,.a1c-content *::before,.a1c-content *::after{box-sizing:border-box;}
.a1c-content a{color:inherit;text-decoration:none;}
.a1c-content p{color:var(--a1c-muted);line-height:1.72;margin:0 0 1em;}
.a1c-content p:last-child{margin-bottom:0;}
.a1c-content h2,.a1c-content h3,.a1c-content h4{color:var(--a1c-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.a1c-content strong{color:var(--a1c-soft);}
.a1c-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.a1c-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--a1c-muted);font-size:14.5px;line-height:1.65;}
.a1c-content ul li::before{content:'›';position:absolute;left:0;color:var(--a1c-accent);font-weight:700;}
.a1c-cnt{width:min(var(--a1c-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.a1c-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.a1c-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.a1c-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.a1c-sh.a1c-left{margin-left:0;text-align:left;}
.a1c-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.a1c-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.a1c-sh.a1c-left p{margin-left:0;}
.a1c-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--a1c-accent);margin-bottom:14px;}
.a1c-gt{background:linear-gradient(92deg,#fff 0%,var(--a1c-accent) 44%,var(--a1c-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.a1c-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.a1c-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.a1c-intro-text{position:relative;padding-left:20px;}
.a1c-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--a1c-accent),var(--a1c-violet));}
.a1c-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--a1c-muted);margin-bottom:1em;}
.a1c-intro-text p:last-child{margin-bottom:0;color:var(--a1c-soft);}
.a1c-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.a1c-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.a1c-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--a1c-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.a1c-kpi-card .kl{font-size:11px;font-weight:600;color:var(--a1c-muted);line-height:1.4;}
.a1c-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.a1c-intro-grid{grid-template-columns:1fr;gap:36px;}.a1c-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.a1c-intro-kpi{grid-template-columns:1fr 1fr;}}
.a1c-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.a1c-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.a1c-toc a{display:inline-block;padding:9px 18px;background:var(--a1c-surface);border:1px solid var(--a1c-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--a1c-muted);transition:border-color .2s,color .2s,background .2s;}
.a1c-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--a1c-accent);background:rgba(245,197,24,.08);}
.a1c-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--a1c-border);border-radius:var(--a1c-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.a1c-card:hover{border-color:rgba(245,197,24,.28);transform:translateY(-2px);}
.a1c-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.a1c-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.a1c-grid-2,.a1c-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.a1c-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.a1c-grid-3{grid-template-columns:1fr;}}
.a1c-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--a1c-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.a1c-scenario:last-child{margin-bottom:0;}
.a1c-scenario:hover{border-color:rgba(245,197,24,.3);}
.a1c-scenario h3{font-size:17px;margin-bottom:8px;}
.a1c-scenario p{font-size:14.5px;margin:0 0 .6em;}
.a1c-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.a1c-table{width:100%;border-collapse:collapse;font-size:14px;}
.a1c-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--a1c-accent);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);white-space:nowrap;}
.a1c-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--a1c-text);vertical-align:top;}
.a1c-table tr:last-child td{border-bottom:none;}
.a1c-table tr:hover td{background:rgba(255,255,255,.03);}
.a1c-timeline{position:relative;padding-left:40px;}
.a1c-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--a1c-accent),var(--a1c-violet));opacity:.35;border-radius:2px;}
.a1c-tl-item{position:relative;margin-bottom:32px;}
.a1c-tl-item:last-child{margin-bottom:0;}
.a1c-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--a1c-accent);box-shadow:0 0 0 4px rgba(245,197,24,.2);}
.a1c-tl-item h3{font-size:17px;margin-bottom:8px;}
.a1c-tl-item p{font-size:14.5px;margin:0;}
.a1c-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.a1c-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.a1c-case-grid{grid-template-columns:1fr;}}
.a1c-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.a1c-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.a1c-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--a1c-green);margin-bottom:10px;}
.a1c-case-card h3{font-size:16px;margin-bottom:14px;}
.a1c-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.a1c-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.a1c-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--a1c-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.a1c-faq-q::after{content:'▾';font-size:13px;color:var(--a1c-accent);flex-shrink:0;transition:transform .25s;}
.a1c-faq-item.open .a1c-faq-q::after{transform:rotate(180deg);}
.a1c-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--a1c-muted);line-height:1.72;}
.a1c-faq-item.open .a1c-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,197,24,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--a1c-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--a1c-btn-from),var(--a1c-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--a1c-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--a1c-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-1c-erp-page" role="main" tabindex="-1">

<section class="nero-ai-hero a1c-hero-erp" id="a1c-hero-erp" aria-labelledby="a1c-hero-title">
<style>
/* ── Hero ai-1c-erp: самодостаточные стили (без CSS темы) ── */
.a1c-hero-erp {
  --a1c-gold: #f5c518;
  --a1c-erp-red: #d71920;
  --a1c-cyan: #38bdf8;
  --a1c-green: #22c55e;
  --a1c-text: #e6edf7;
  --a1c-muted: #9aa8bd;
  --a1c-soft: #c7d2e5;
  --a1c-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.a1c-hero-erp::before {
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
.a1c-hero-erp::after {
  content: "";
  position: absolute;
  right: 8%;
  top: 12%;
  width: 640px;
  height: 640px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(245, 197, 24, .11), transparent 66%);
  filter: blur(8px);
  animation: a1cHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes a1cHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.a1c-hero-erp .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.a1c-hero-erp .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.a1c-hero-erp .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.a1c-hero-erp .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--a1c-gold) 42%, #fde68a 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.a1c-hero-erp .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 197, 24, 0.22);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--a1c-gold) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.a1c-hero-erp .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--a1c-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.a1c-hero-erp .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.a1c-hero-erp .nero-ai-badge {
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
.a1c-hero-erp .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.a1c-hero-erp .nero-ai-btn {
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
.a1c-hero-erp .nero-ai-btn:hover { transform: translateY(-2px); }
.a1c-hero-erp .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--a1c-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.a1c-hero-erp .nero-ai-btn-secondary {
  color: var(--a1c-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.a1c-hero-erp .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--a1c-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.a1c-hero-erp .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.a1c-hero-erp .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.a1c-hero-erp .nero-ai-dots { display: flex; gap: 7px; }
.a1c-hero-erp .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.a1c-hero-erp .nero-ai-dot:nth-child(1) { background: #fb7185; }
.a1c-hero-erp .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.a1c-hero-erp .nero-ai-dot:nth-child(3) { background: #34d399; }
.a1c-hero-erp .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.a1c-hero-erp .nero-ai-window-body { padding: 16px; }
.a1c-hero-erp .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.a1c-hero-erp .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.a1c-hero-erp .nero-ai-live-pill {
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
.a1c-hero-erp .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: a1cPulse 1.6s infinite;
}
@keyframes a1cPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.a1c-hero-erp .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.a1c-hero-erp .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.a1c-hero-erp .nero-ai-metric span {
  display: block;
  color: var(--a1c-muted);
  font-size: 11px;
  font-weight: 700;
}
.a1c-hero-erp .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.a1c-hero-erp .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.a1c-hero-erp .a1c-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(245, 197, 24, 0.16);
  background: radial-gradient(ellipse at 30% 45%, rgba(245,197,24,.07), rgba(6,10,24,.92) 72%);
}
.a1c-hero-erp #ai1c-erp-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.a1c-hero-erp .nero-ai-task-stream { display: grid; gap: 8px; }
.a1c-hero-erp .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.a1c-hero-erp .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(245,197,24,.12);
  color: var(--a1c-gold);
  font-size: 11px;
  font-weight: 800;
}
.a1c-hero-erp .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.a1c-hero-erp .nero-ai-task span {
  color: var(--a1c-muted);
  font-size: 11px;
}
.a1c-hero-erp .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.a1c-hero-erp .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .a1c-hero-erp .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .a1c-hero-erp .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .a1c-hero-erp .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .a1c-hero-erp .nero-ai-window-body { padding: 12px; }
  .a1c-hero-erp .nero-ai-task { grid-template-columns: 28px 1fr; }
  .a1c-hero-erp .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">CRM / 1С и ERP · внедрение под ключ</p>
      <h1 id="a1c-hero-title">AI-агент для 1С и ERP: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть извлекает данные из счетов, заявок и документов и передаёт в 1С/ERP</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">OCR счетов</li>
        <li class="nero-ai-badge">Заявки в 1С</li>
        <li class="nero-ai-badge">УПД и акты</li>
        <li class="nero-ai-badge">OData / REST</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-обработки документов для 1С/ERP">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Документооборот → 1С/ERP</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Документов сегодня</span>
              <strong>128</strong>
              <small>счета, заявки, УПД</small>
            </div>
            <div class="nero-ai-metric">
              <span>Извлечено AI</span>
              <strong>96%</strong>
              <small>без ручного ввода</small>
            </div>
            <div class="nero-ai-metric">
              <span>До проводки</span>
              <strong>12 сек</strong>
              <small>скан → 1С</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ошибок ввода</span>
              <strong>0</strong>
              <small>за смену</small>
            </div>
          </div>

          <div class="a1c-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ai1c-erp-hero-canvas" role="img" aria-label="Анимация: документы по желобам сортируются, AI извлекает поля и проводит в 1С/ERP"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий документооборота">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">СФ</span>
              <div><strong>Счёт №847 — 11 полей</strong><span>Контрагент, сумма, НДС → Реализация</span></div>
              <span class="nero-ai-status">проведено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ЗП</span>
              <div><strong>Заявка на закуп</strong><span>Номенклатура → Заказ поставщику</span></div>
              <span class="nero-ai-status">проведено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">УПД</span>
              <div><strong>УПД — сверка НДС</strong><span>Строки → Покупки / склад</span></div>
              <span class="nero-ai-status">проведено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">?</span>
              <div><strong>Акт выполненных работ</strong><span>confidence 0.78 — на review бухгалтера</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="a1c-content">

  <section class="a1c-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="a1c-cnt">
      <div class="a1c-intro-grid nero-ai-reveal">
        <div class="a1c-intro-text">
          <p class="a1c-eyebrow">Лонгрид · ai 1c erp</p>
          <p><strong>Коротко:</strong> AI-агент для 1С и ERP — это система, которая сама принимает счета, заявки и первичные документы, извлекает из них поля и создаёт черновики в учётной системе. Человек остаётся на контроле и согласовании, а не на механическом переносе цифр из PDF в базу.</p>
          <p>Оптовая торговля, производство и бухгалтерские отделы на 1С:УТ 11, 1С:ERP 2 и 1С:Бухгалтерия 3.0 ежедневно обрабатывают сотни и тысячи документов. По данным McKinsey State of AI 2025, около 88% организаций уже используют AI, но EBIT даёт <strong>перестройка workflow</strong> — не «ещё один инструмент».</p>
        </div>
        <div class="a1c-intro-kpi" aria-label="Ключевые метрики документооборота">
          <div class="a1c-kpi-card"><div class="kv">88%</div><div class="kl">организаций используют AI</div><div class="ks">McKinsey 2025</div></div>
          <div class="a1c-kpi-card"><div class="kv">21%</div><div class="kl">перепроектировали процессы</div><div class="ks">McKinsey 2025</div></div>
          <div class="a1c-kpi-card"><div class="kv">15 мин</div><div class="kl">ручной ввод на документ</div><div class="ks">до автоматизации</div></div>
          <div class="a1c-kpi-card"><div class="kv">40 сек</div><div class="kl">после внедрения AI</div><div class="ks">кейс казначейства</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="a1c-toc-outer">
    <div class="a1c-cnt">
      <nav class="a1c-toc" aria-label="Оглавление статьи">
        <a href="#kak-rabotaet">Зачем AI в 1С</a>
        <a href="#dokumenty">Документы</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#neuroset">OCR и LLM</a>
        <a href="#otrasli">Отрасли</a>
        <a href="#ceny">Цена и ROI</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Аудит</a>
      </nav>
    </div>
  </div>

  <section class="a1c-section" id="zachem">
    <div class="a1c-cnt">
      <div class="a1c-sh" id="kak-rabotaet">
        <span class="a1c-eyebrow">Зачем бизнесу</span>
        <h2>Зачем бизнесу AI-агент для 1С и ERP</h2>
        <p>Документооборот в 1С — понятный кандидат на автоматизацию: правила формализованы, результат измерим, человек остаётся в контуре контроля.</p>
      </div>

      <div class="a1c-grid-3 nero-ai-reveal">
        <div class="a1c-card">
          <h3>Где ручной ввод съедает маржу</h3>
          <p>50 счетов × 10–15 мин = 4–5 часов в день на механический перенос. Ошибки НДС, дубли платежей, очередь неразнесённой первички перед закрытием периода.</p>
        </div>
        <div class="a1c-card nero-ai-delay-1">
          <h3>Чем агент отличается от автоматизации 1С</h3>
          <p>Классификация → извлечение OCR/LLM → сверка с базой → черновик в 1С. Цепочка от канала до согласования, а не один экран ввода.</p>
        </div>
        <div class="a1c-card nero-ai-delay-2">
          <h3>ROI в 2026 — переработка процессов</h3>
          <p>Рынок ИИ-агентов в РФ вырастет в 4,5 раза к 2028 (Яков и Партнёры). Выигрывают проекты с пилотом, KPI и одним сценарием на старте.</p>
        </div>
      </div>

      <div class="a1c-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:19px;margin-bottom:10px;">AI-агент vs 1С:РПД</h3>
        <p><a href="https://v8.1c.ru/its/services/1s-raspoznavanie-pervichnykh-dokumentov/" target="_blank" rel="noopener noreferrer">1С:РПД</a> ускоряет распознавание первички в интерфейсе 1С, но не закрывает сквозной процесс «письмо → заявка на расход → казначейство → оплата». <strong>Определение:</strong> AI-агент для 1С — автономная система с human-in-the-loop от входящего канала до черновика в ERP с журналом решений и метриками ROI.</p>
      </div>
    </div>
  </section>

  <section class="a1c-section a1c-section-alt" id="dokumenty">
    <div class="a1c-cnt">
      <div class="a1c-sh">
        <span class="a1c-eyebrow">Сценарии</span>
        <h2>Какие документы и заявки автоматизирует AI</h2>
        <p>AI-обработка счетов, документов 1С и заявок покрывает весь входящий поток первички без замены учётной системы.</p>
      </div>

      <div class="nero-ai-reveal">
        <div class="a1c-scenario" id="schet-v-1s">
          <h3>Счета и входящие документы: из PDF и скана в 1С</h3>
          <p>AI извлекает ИНН, суммы с НДС, строки номенклатуры; ищет контрагента; формирует «Заказ поставщику» или «Поступление». Кейс GPTmag: 1800 док/мес, 4 мин → 30 сек, ошибки 2,5% → 0,3%.</p>
        </div>
        <div class="a1c-scenario">
          <h3>Заявки и заказы: от письма и формы до проведения в ERP</h3>
          <p>Когда заявка приходит из почты, помогает <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработка входящей почты в CRM</a> на этапе до ERP. Классификация письма, извлечение позиций, проверка лимитов, создание «Заказа клиента» или «Заявки на расход ДС». Пилот казначейства: 15 мин → 40 сек, точность 87%.</p>
        </div>
        <div class="a1c-scenario">
          <h3>УПД, акты, накладные: сверка полей без ручного ввода</h3>
          <p>Сопоставление номенклатуры, флаги расхождений бухгалтеру. Enterprise-кейс Epsilon Metrics: цепочка от счетов до закрывающих на 9 юрлицах.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="ai-1c-erp-boris-block" class="b1c-root" aria-label="Анимация: AI извлекает поля из счетов и УПД и создаёт черновики в 1С/ERP">
<style>
/* === БОРИС: prefix b1c-, scoped внутри #ai-1c-erp-boris-block === */
#ai-1c-erp-boris-block.b1c-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-1c-erp-boris-block .b1c-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-1c-erp-boris-block .b1c-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-1c-erp-boris-block .b1c-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-1c-erp-boris-block .b1c-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-1c-erp-boris-block .b1c-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-1c-erp-boris-block .b1c-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#d97706;
  margin:0 0 14px;
}
#ai-1c-erp-boris-block .b1c-ey::before{
  content:'';
  width:18px;height:2px;
  background:#d97706;
  border-radius:1px;
}
#ai-1c-erp-boris-block .b1c-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-1c-erp-boris-block .b1c-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-1c-erp-boris-block .b1c-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-1c-erp-boris-block .b1c-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(217,119,6,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#b45309;
  margin-top:1px;
  font-style:normal;
}
#ai-1c-erp-boris-block .b1c-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-1c-erp-boris-block .b1c-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-1c-erp-boris-block .b1c-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-1c-erp-boris-block .b1c-pl-o{
  background:rgba(217,119,6,.08);
  color:#b45309;
  border:1.5px solid rgba(217,119,6,.22);
}
#ai-1c-erp-boris-block .b1c-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#ai-1c-erp-boris-block .b1c-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-1c-erp-boris-block .b1c-rgt{
  position:relative;
  background:linear-gradient(135deg,#fffbeb 0%,#fef3c7 28%,#f0f9ff 72%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-1c-erp-boris-block .b1c-rgt{min-height:380px;}
}
#b1c-erp-doc-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="b1c-cnt">
  <div class="b1c-card">

    <div class="b1c-lft">
      <span class="b1c-ey">Документооборот 1С</span>
      <h3 class="b1c-h3">Счёт, УПД или заявка — из PDF в черновик 1С без ручного ввода</h3>
      <ul class="b1c-ul">
        <li><span class="b1c-ic">1</span>AI классифицирует тип: счёт поставщика, УПД, ТОРГ-12, заявка на расход ДС</li>
        <li><span class="b1c-ic">2</span>OCR + LLM извлекают ИНН, суммы, НДС и строки номенклатуры</li>
        <li><span class="b1c-ic">3</span>Сверка с контрагентом, договором и дублями платежа в базе 1С</li>
        <li><span class="b1c-ic">?</span>Confidence &lt; 87% — очередь бухгалтеру; остальное — черновик в ERP</li>
      </ul>
      <div class="b1c-pills">
        <span class="b1c-pl b1c-pl-o">15 мин → 40 сек</span>
        <span class="b1c-pl b1c-pl-g">87% auto-match</span>
        <span class="b1c-pl b1c-pl-b">OData / REST 1С</span>
      </div>
      <p class="b1c-foot">Дальше — этапы внедрения AI 1С под ключ и сроки пилота →</p>
    </div>

    <div class="b1c-rgt">
      <canvas
        id="b1c-erp-doc-pipeline-canvas"
        aria-label="Анимация: документы проходят AI-извлечение полей, сверку с 1С и создание черновиков в ERP"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('b1c-erp-doc-pipeline-canvas');
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
    paper:'#ffffff',
    paperBdr:'#cbd5e1',
    scan:'#f59e0b',
    scanGlow:'rgba(245,158,11,.22)',
    ai:'#8b5cf6',
    aiGlow:'rgba(139,92,246,.2)',
    onec:'#ffdd2d',
    onecDark:'#e8b800',
    onecPanel:'#1a1f2e',
    green:'#22c55e',
    blue:'#0ea5e9',
    orange:'#f59e0b',
    red:'#ef4444',
    field:'#e0f2fe',
    fieldBdr:'#7dd3fc',
    line:'rgba(14,165,233,.3)',
    review:'#fef3c7',
    reviewBdr:'#fbbf24'
  };

  var DOCS = [
    {type:'Счёт', color:C.orange, fields:['ИНН','Сумма','НДС'], target:'Заказ поставщику', delay:0},
    {type:'УПД', color:C.blue, fields:['ИНН','Строки','Дата'], target:'Поступление', delay:140},
    {type:'Заявка', color:C.green, fields:['Контрагент','Бюджет'], target:'Заявка на расход ДС', delay:280},
    {type:'Счёт', color:C.orange, fields:['ИНН','Сумма'], target:'Заказ поставщику', delay:420},
    {type:'УПД', color:C.blue, fields:['ИНН','НДС'], target:'Поступление', delay:560}
  ];

  var LOOP = 700;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawDocIcon(x,y,s,clr,label,alpha){
    ctx.globalAlpha = alpha || 1;
    rr(x,y,s,s*1.28,5,C.paper,C.paperBdr,1.5);
    rr(x+6,y+8,s-12,10,2,clr,null,0);
    ctx.fillStyle=C.ink;
    ctx.font='bold 9px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('PDF',x+s/2,y+16);
    ctx.fillStyle=clr;
    ctx.font='bold 8px Inter,sans-serif';
    ctx.fillText(label,x+s/2,y+s*1.1);
    ctx.globalAlpha=1;
  }

  function drawScanner(cx,cy,w,h,pulse){
    rr(cx,cy,w,h,12,'rgba(139,92,246,.08)',C.ai,2);
    ctx.fillStyle=C.ai;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('AI · OCR + LLM',cx+w/2,cy+18);

    var scanY = cy + 28 + (pulse % 80);
    ctx.fillStyle=C.scanGlow;
    ctx.fillRect(cx+8,scanY-2,w-16,4);
    ctx.strokeStyle=C.scan;
    ctx.lineWidth=2;
    ctx.beginPath();
    ctx.moveTo(cx+8,scanY);ctx.lineTo(cx+w-8,scanY);
    ctx.stroke();

    for(var i=0;i<3;i++){
      var ang=(i/3)*Math.PI*2+pulse*0.06;
      ctx.beginPath();
      ctx.arc(cx+w/2+Math.cos(ang)*22,cy+h/2+Math.sin(ang)*14,3,0,Math.PI*2);
      ctx.fillStyle=C.ai;ctx.fill();
    }
  }

  function drawFieldChip(x,y,text,clr,alpha){
    ctx.globalAlpha=alpha||1;
    var tw=ctx.measureText(text).width;
    var pw=tw+16;
    rr(x,y,pw,20,10,C.field,C.fieldBdr,1);
    ctx.fillStyle=clr||C.ink;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(text,x+pw/2,y+13);
    ctx.globalAlpha=1;
    return pw;
  }

  function drawOnecPanel(x,y,w,h,doneCount,reviewCount,pulse){
    rr(x,y,w,h,10,C.onecPanel,'#334155',2);
    rr(x,y,w,28,10,C.onec,C.onecDark,0);
    ctx.fillStyle=C.ink;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('1С:ERP · черновики',x+10,y+18);
    ctx.fillStyle=C.green;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='right';
    ctx.fillText('API online',x+w-10,y+18);

    var slotH=38, gap=6, top=y+36;
    var slots=['Заказ поставщику','Поступление','Заявка на расход ДС'];
    var slotClr=[C.orange,C.blue,C.green];
    slots.forEach(function(lbl,i){
      var sy=top+i*(slotH+gap);
      var filled=i<doneCount;
      rr(x+8,sy,w-16,slotH,6,filled?'rgba(34,197,94,.12)':'rgba(255,255,255,.04)',filled?C.green:'rgba(255,255,255,.1)',1);
      ctx.fillStyle=filled?C.green:'rgba(226,232,240,.5)';
      ctx.font=(filled?'bold ':'')+'10px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(lbl,x+16,sy+22);
      if(filled){
        ctx.fillStyle=C.green;
        ctx.font='bold 12px sans-serif';
        ctx.textAlign='right';
        ctx.fillText('✓',x+w-16,sy+22);
      } else if(i===doneCount){
        var prog=(pulse%60)/60;
        rr(x+16,sy+28,w-32,3,2,'rgba(255,255,255,.08)',null,0);
        rr(x+16,sy+28,(w-32)*prog,3,2,slotClr[i],null,0);
      }
    });

    if(reviewCount>0){
      var ry=y+h-36;
      rr(x+8,ry,w-16,28,6,C.review,C.reviewBdr,1.5);
      ctx.fillStyle='#b45309';
      ctx.font='bold 9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText('На проверку: '+reviewCount+' док.',x+16,ry+18);
    }
  }

  function drawFlowArrows(x1,y1,x2,y2,alpha){
    ctx.globalAlpha=alpha||0.5;
    ctx.strokeStyle=C.line;
    ctx.lineWidth=1.5;
    ctx.setLineDash([4,4]);
    ctx.beginPath();
    ctx.moveTo(x1,y1);ctx.lineTo(x2,y2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t=frame%LOOP;
    ctx.clearRect(0,0,W,H);

    var pad=14;
    var scanW=Math.min(130,W*0.22);
    var scanH=Math.min(100,H*0.28);
    var scanX=W*0.36-scanW/2;
    var scanY=H*0.38-scanH/2;
    var onecW=Math.min(155,W*0.26);
    var onecH=Math.min(200,H*0.55);
    var onecX=W-onecW-pad;
    var onecY=H*0.5-onecH/2;

    drawScanner(scanX,scanY,scanW,scanH,frame);

    var done=0, review=0;
    DOCS.forEach(function(doc){
      var localT=(t-doc.delay+LOOP)%LOOP;
      if(localT>LOOP-80) return;
      var prog=Math.min(1,localT/200);
      var startX=pad;
      var endX=scanX-20;
      var docX=startX+(endX-startX)*prog;
      var docY=scanY+scanH/2-20;
      var alpha=prog<0.95?1:Math.max(0,1-(localT-190)/10);

      if(prog<0.45){
        drawDocIcon(docX,docY,36,doc.color,doc.type,alpha);
      } else if(prog<0.75){
        var fp=prog-0.45;
        drawDocIcon(scanX+scanW/2-18,docY,36,doc.color,doc.type,1-fp*0.5);
        doc.fields.forEach(function(f,i){
          var fx=scanX+scanW+8;
          var fy=scanY+20+i*24;
          drawFieldChip(fx,fy,f,f,Math.min(1,fp*2-i*0.2));
        });
        drawFlowArrows(scanX+scanW,scanY+scanH/2,onecX,onecY+onecH/2,fp);
      } else {
        var pp=prog-0.75;
        if(pp>0.6 && Math.random()>0.92) review++;
        else done=Math.min(3,done+1);
        doc.fields.forEach(function(f,i){
          drawFieldChip(onecX-50,onecY+30+i*22,f,C.blue,0.4+pp*0.4);
        });
      }
    });

    drawOnecPanel(onecX,onecY,onecW,onecH,Math.min(3,Math.floor(t/180)%4),review>0?1:0,frame);

    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Входящие PDF / сканы',pad,H-12);
    ctx.textAlign='center';
    ctx.fillText('Извлечение полей',scanX+scanW/2,H-12);
    ctx.textAlign='right';
    ctx.fillText('Черновики 1С',onecX+onecW,H-12);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>

  <section class="a1c-section" id="etapy">
    <div class="a1c-cnt">
      <div class="a1c-sh a1c-left">
        <span class="a1c-eyebrow">Под ключ</span>
        <h2>Внедрение AI 1С под ключ: этапы и сроки</h2>
        <p>Аудит → пилот на 30% потока → продакшен с SLA на точность извлечения.</p>
      </div>

      <div class="a1c-card nero-ai-reveal">
        <div class="a1c-timeline">
          <div class="a1c-tl-item"><div class="a1c-tl-dot"></div><h3>Аудит ручного документооборота (1–2 недели)</h3><p>Карта потоков, типы документов, время на ввод, % ошибок, REST/OData. Лид-магнит: приоритет сценариев и оценка ROI.</p></div>
          <div class="a1c-tl-item"><div class="a1c-tl-dot"></div><h3>Пилот на ваших документах (4–8 недель)</h3><p>Один сценарий, 30% потока, 50–200 эталонных документов. Раскатка 10% → 50% → 100%.</p></div>
          <div class="a1c-tl-item"><div class="a1c-tl-dot"></div><h3>Продакшен, обучение и SLA</h3><p>KPI: время на документ, % auto, эскалация при confidence &lt; 85–90%. Бюджет ориентир: 300 тыс.–1,5 млн ₽.</p></div>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-audit">
  <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Аудит ручного документооборота в 1С — бесплатно</p>
    <p class="ym-cta-block__sub">За 1–2 недели составим карту потоков: счета, УПД, заявки, время на документ, % ошибок и узкие места закрытия периода. На выходе — приоритет сценариев и ориентир ROI без обязательств по внедрению.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Посчитать экономию</a>
  </div>
</div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
    <p class="ym-cta-block__sub">Перед внедрением AI 1С полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с OData — это ускоряет согласование сценариев с бухгалтерией и IT. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
  </div>
</aside>
    </div>
  </section>

  <section class="a1c-section a1c-section-alt" id="integracii">
    <div class="a1c-cnt">
      <div class="a1c-sh">
        <span class="a1c-eyebrow">Интеграции</span>
        <h2>Интеграция AI 1С с CRM и ERP</h2>
        <p>REST/OData 8.3.5+, связка с CRM, типовые точки подключения по конфигурациям.</p>
      </div>

      <div class="a1c-grid-2 nero-ai-reveal">
        <div class="a1c-card">
          <h3>REST/OData и безопасный обмен</h3>
          <p>JSON-запросы без снятия с поддержки. Очереди RabbitMQ / 1С:Шина при пиках. Журнал решений ИИ для regulated-контуров (ФСТЭК №117).</p>
        </div>
        <div class="a1c-card nero-ai-delay-1">
          <h3>Связка с CRM</h3>
          <p>Лид в amoCRM или Битрикс24 → счёт или заказ в 1С без двойного ввода. <a href="/vnedrenie-ai-amocrm/">интеграция AI с amoCRM под ключ</a> — смежный сценарий. Смежные CRM-сценарии — на отдельных посадочных; здесь фокус на учётном контуре ERP.</p>
        </div>
      </div>

      <div class="a1c-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="a1c-table">
          <thead><tr><th>Конфигурация</th><th>Сценарий AI</th><th>Документ в 1С</th></tr></thead>
          <tbody>
            <tr><td>1С:УТ 11</td><td>Счёт поставщика, заказ клиента</td><td>Заказ поставщику, Реализация</td></tr>
            <tr><td>1С:ERP 2</td><td>Заявка на расход, поступление</td><td>Заявка на расход ДС, Поступление</td></tr>
            <tr><td>1С:Бухгалтерия 3.0</td><td>Входящий счёт, оплата</td><td>Счёт от поставщика, Платёжное поручение</td></tr>
            <tr><td>1С:КА 2</td><td>Сквозной закупочный цикл</td><td>Заказ, Поступление, Сверка</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="a1c-section" id="neuroset">
    <div class="a1c-cnt">
      <div class="a1c-sh">
        <span class="a1c-eyebrow">Технология</span>
        <h2>Нейросеть для 1С: OCR, LLM и извлечение полей</h2>
        <p>Три слоя: распознавание образа, структурирование полей, бизнес-валидация.</p>
      </div>

      <div class="a1c-table-wrap nero-ai-reveal">
        <table class="a1c-table">
          <thead><tr><th>Критерий</th><th>1С:РПД</th><th>SaaS (Vysor)</th><th>Кастомный AI-агент</th></tr></thead>
          <tbody>
            <tr><td>Сквозной процесс до заявки/оплаты</td><td>Частично</td><td>Средне</td><td>Полный под регламент</td></tr>
            <tr><td>Интеграция CRM + почта + ЭДО</td><td>Нет</td><td>Частично</td><td>Да</td></tr>
            <tr><td>Бюджет старта</td><td>Ниже</td><td>Подписка + токены</td><td>300 тыс.–1,5 млн ₽</td></tr>
            <tr><td>Срок до пилота</td><td>Быстро</td><td>Дни</td><td>4–8 недель</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="margin-top:20px;text-align:center;max-width:720px;margin-left:auto;margin-right:auto;">10–20% счетов на ручную проверку — норма. Каждое решение AI фиксируется в журнале: файл, поля, confidence, правки бухгалтера.</p>
    </div>
  </section>

  <section class="a1c-section a1c-section-alt" id="otrasli">
    <div class="a1c-cnt">
      <div class="a1c-sh">
        <span class="a1c-eyebrow">Отрасли</span>
        <h2>AI ERP для опта, производства и бухгалтерии</h2>
      </div>
      <div class="a1c-grid-3 nero-ai-reveal">
        <div class="a1c-card"><h3>Оптовая торговля</h3><p>Десятки счетов ежедневно, разные макеты. Сокращение cost per invoice; международный ориентир — −50% трудозатрат AP.</p></div>
        <div class="a1c-card nero-ai-delay-1"><h3>Производство</h3><p>KT.Team: −70% времени на рутину, 50+ док/день, −45% ошибок. Архитектура «классификатор → исполнитель в 1С».</p></div>
        <div class="a1c-card nero-ai-delay-2"><h3>Бухгалтерия</h3><p>Меньше очереди неразнесённой первички, быстрее сверка с банком и закрытие месяца. Эксперт остаётся на финальном утверждении.</p></div>
      </div>
    </div>
  </section>

  <section class="a1c-section" id="ceny">
    <div class="a1c-cnt">
      <div class="a1c-sh" id="roi">
        <span class="a1c-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI 1С: цена, ROI и калькулятор экономии</h2>
        <p>Ориентир внедрения: 300 тыс.–1,5 млн ₽. Окупаемость считается в часах и ошибках.</p>
      </div>

      <div class="a1c-card nero-ai-reveal">
        <h3>Формула ROI (упрощённо)</h3>
        <p>Экономия в месяц = (Документов × Минут вручную / 60 × Ставка часа) − (Стоимость AI + амортизация) − (Минут с AI / 60 × Ставка × Документов)</p>
        <p><strong>Пример:</strong> 500 док/мес, 8 мин/док, ставка 800 ₽/час → экономия на труде ~43 000 ₽/мес. При бюджете 600 тыс. ₽ окупаемость ~14 мес только по труду; при 120 ч/мес ручного ввода — быстрее.</p>
        <p>На фоне <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">масштабного внедрения AI в бизнес</a> у крупных компаний публичные кейсы: горизонт 3–6 месяцев при 200+ док/мес. Критично автоматизировать весь pipeline: capture → validate → route → post.</p>
      </div>

      <div class="ym-cta-block ym-cta-block--dual" id="cta-roi">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Посчитайте экономию на вашем потоке документов</p>
    <p class="ym-cta-block__sub">Укажите объём счетов и заявок в месяц, минуты на ручной ввод и ставку часа — получите ориентир окупаемости при бюджете 300 тыс.–1,5 млн ₽. Точный расчёт — после аудита документооборота.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Посчитать экономию</a>
      <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
    </div>
  </div>
</div>
    </div>
  </section>

  <section class="a1c-section a1c-section-alt" id="keisy">
    <div class="a1c-cnt">
      <div class="a1c-sh">
        <span class="a1c-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI 1С</h2>
        <p>Цифры зависят от потока и дисциплины пилота — ниже публичные истории с оговоркой об источнике.</p>
      </div>

      <div class="a1c-case-grid nero-ai-reveal">
        <div class="a1c-case-card"><div class="a1c-case-tag">Производство</div><h3>Мебель, 1800 док/мес</h3><p>n8n + GigaChat Vision + API 1С. 4 мин → 30 сек; окупаемость ~5 мес при ~500 тыс. ₽.</p></div>
        <div class="a1c-case-card"><div class="a1c-case-tag">Металлоконструкции</div><h3>ИИ-агент через API 1С</h3><p>−70% времени на рутину, 50+ док/день, −45% ошибок. До 3 часов в день возвращено специалистам.</p></div>
        <div class="a1c-case-card"><div class="a1c-case-tag">Казначейство</div><h3>Заявки на расход ДС</h3><p>15 мин → 40 сек, 87% точность, 13% на ручной доработке. Ускорение в 22,5 раза.</p></div>
      </div>

      <div class="a1c-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="a1c-table">
          <thead><tr><th>Показатель</th><th>До AI</th><th>После AI</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>Время на документ</td><td>4–15 мин</td><td>30–40 сек</td><td>GPTmag, Клерк</td></tr>
            <tr><td>Ошибки ввода</td><td>2,5%</td><td>0,3%</td><td>GPTmag</td></tr>
            <tr><td>Auto без правок</td><td>—</td><td>50–87%</td><td>Клерк, бенчмарки AP</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="a1c-section" id="faq">
    <div class="a1c-cnt">
      <div class="a1c-sh">
        <span class="a1c-eyebrow">FAQ</span>
        <h2>Как внедрить AI 1C в компанию</h2>
      </div>
      <div class="a1c-faq nero-ai-reveal">
        <div class="a1c-faq-item"><div class="a1c-faq-q" role="button" tabindex="0" aria-expanded="false">С чего начать, если документооборот уже в 1С?</div><div class="a1c-faq-a">Аудит одного болезненного сценария (входящие счета), замер времени и ошибок за 2 недели. Проверьте REST/OData. Пилот на 30% потока — не «всё сразу».</div></div>
        <div class="a1c-faq-item"><div class="a1c-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли доработка конфигурации?</div><div class="a1c-faq-a">В большинстве проектов нет: агент через API снаружи. Исключения — нестандартные поля и маршруты согласования внутри 1С.</div></div>
        <div class="a1c-faq-item"><div class="a1c-faq-q" role="button" tabindex="0" aria-expanded="false">Безопасность данных и 152-ФЗ</div><div class="a1c-faq-a">Российские модели (GigaChat, YandexGPT), on-prem, zero retention. Главбух сохраняет финальное утверждение платежей.</div></div>
        <div class="a1c-faq-item"><div class="a1c-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-агент лучше 1С:РПД?</div><div class="a1c-faq-a">РПД ускоряет ввод первички; агент ведёт цепочку от почты/ЭДО до заявки на расход и маршрута согласования.</div></div>
        <div class="a1c-faq-item"><div class="a1c-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько длится внедрение?</div><div class="a1c-faq-a">Аудит 1–2 недели, пилот 4–8 недель, масштабирование — по числу сценариев.</div></div>
        <div class="a1c-faq-item"><div class="a1c-faq-q" role="button" tabindex="0" aria-expanded="false">Дорого ли это?</div><div class="a1c-faq-a">Пилот от ~300 тыс. ₽. При 200+ док/мес окупаемость по кейсам — несколько месяцев. 10–15% документов на ручную обработку — норма.</div></div>
      </div>
    </div>
  </section>

  <section class="a1c-section" id="itog">
    <div class="a1c-cnt">
      <div class="a1c-sh">
        <h2>Итог</h2>
        <p>AI-агент для 1С и ERP — перестроенная цепочка от счёта и заявки до проводки. Следующий шаг — <strong>посчитать экономию</strong> и заказать <strong>аудит ручного документооборота</strong>.</p>
      </div>
    </div>
  </section>

  <section class="a1c-section" id="cta" style="background:linear-gradient(135deg,rgba(245,197,24,.08),rgba(139,92,246,.08));">
    <div class="a1c-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы убрать ручной ввод в 1С и ERP?</p>
    <p class="ym-cta-block__sub">Следующий шаг — аудит документооборота и расчёт экономии на ваших счетах, заявках и первичке. Пилот на одном сценарии за 4–8 недель, без ломки конфигурации 1С.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Посчитать экономию</a>
  </div>
</div>
    </div>
  </section>

</div>


<?php
$a1c_page_url = trailingslashit( get_permalink() );
$a1c_site_url = trailingslashit( home_url( '/' ) );
$a1c_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$a1c_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $a1c_site_url . '#organization',
      'name'  => $a1c_brand,
      'url'   => $a1c_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $a1c_site_url . '#website',
      'url'       => $a1c_site_url,
      'name'      => $a1c_brand,
      'publisher' => [ '@id' => $a1c_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $a1c_page_url . '#webpage',
      'url'         => $a1c_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $a1c_site_url . '#website' ],
      'about'       => [ '@id' => $a1c_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $a1c_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $a1c_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $a1c_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $a1c_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $a1c_page_url,
      'provider'    => [ '@id' => $a1c_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $a1c_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'С чего начать, если документооборот уже в 1С?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит одного болезненного сценария (входящие счета), замер времени и ошибок за 2 недели. Проверьте REST/OData. Пилот на 30% потока — не «всё сразу».' ] ],
        [ '@type' => 'Question', 'name' => 'Нужна ли доработка конфигурации?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'В большинстве проектов нет: агент через API снаружи. Исключения — нестандартные поля и маршруты согласования внутри 1С.' ] ],
        [ '@type' => 'Question', 'name' => 'Безопасность данных и 152-ФЗ', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Российские модели (GigaChat, YandexGPT), on-prem, zero retention. Главбух сохраняет финальное утверждение платежей.' ] ],
        [ '@type' => 'Question', 'name' => 'Чем AI-агент лучше 1С:РПД?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'РПД ускоряет ввод первички; агент ведёт цепочку от почты/ЭДО до заявки на расход и маршрута согласования.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько длится внедрение?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит 1–2 недели, пилот 4–8 недель, масштабирование — по числу сценариев.' ] ],
        [ '@type' => 'Question', 'name' => 'Дорого ли это?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Пилот от ~300 тыс. ₽. При 200+ док/мес окупаемость по кейсам — несколько месяцев. 10–15% документов на ручную обработку — норма.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $a1c_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
?>
</main>

<script>
/**
 * ai1c-erp-hero-engine — «Бухгалтерский мост документов → 1С/ERP»
 * Мир: вертикальные желоба первички → OCR-сканер → сверка → проводка в ядро ERP
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ai1c-erp-hero-canvas");
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
    cy = ch / 2 + 8;
    scale = Math.min(cw / 420, ch / 280) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    docWhite: "#f8fafc",
    docBlue: "#dbeafe",
    docGreen: "#d1fae5",
    docAmber: "#fef3c7",
    chute: "#475569",
    chuteEdge: "#1e293b",
    erpBase: "#1e293b",
    erpGold: "#f5c518",
    erpRed: "#d71920",
    erpGreen: "#22c55e",
    scanBeam: "rgba(56,189,248,0.55)",
    fieldChip: "#a7f3d0",
    stampRed: "rgba(215,25,32,0.85)",
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

  function drawDoc(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    if (label) ctx.fillText(label, x, y + 2);
    ctx.strokeStyle = "rgba(148,163,184,0.5)";
    ctx.lineWidth = 0.8;
    for (var i = 0; i < 3; i++) {
      ctx.beginPath();
      ctx.moveTo(x - w / 2 + 3, y - h / 2 + 6 + i * 4);
      ctx.lineTo(x + w / 2 - 3, y - h / 2 + 6 + i * 4);
      ctx.stroke();
    }
  }

  /* Вертикальные желоба сортировки — вместо Conveyor */
  function DocumentSorterChute() {
    this.items = [
      { lane: 0, offset: 0, color: C.docAmber, label: "СФ" },
      { lane: 1, offset: 80, color: C.docBlue, label: "ЗП" },
      { lane: 2, offset: 160, color: C.docGreen, label: "УПД" }
    ];
  }
  DocumentSorterChute.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 250;
    var lanes = [
      { x1: -165, x2: -55, yTop: -95, yBot: 25 },
      { x1: -95, x2: -15, yTop: -105, yBot: 30 },
      { x1: -25, x2: 25, yTop: -100, yBot: 28 }
    ];
    lanes.forEach(function (ln, idx) {
      ctx.fillStyle = idx === 1 ? "rgba(245,197,24,0.08)" : "rgba(71,85,105,0.35)";
      ctx.beginPath();
      ctx.moveTo(ln.x1, ln.yTop);
      ctx.lineTo(ln.x2, ln.yTop);
      ctx.lineTo(ln.x2 + 8, ln.yBot);
      ctx.lineTo(ln.x1 - 8, ln.yBot);
      ctx.closePath();
      ctx.fill();
      ctx.strokeStyle = C.chuteEdge;
      ctx.lineWidth = 1.2;
      ctx.stroke();
    });

    this.items.forEach(function (it, i) {
      var lane = lanes[it.lane];
      var t = ((frame * 0.45 + it.offset) % 120) / 120;
      var dx = lane.x1 + (lane.x2 - lane.x1) * t;
      var dy = lane.yTop + (lane.yBot - lane.yTop) * t;
      if (t < 0.92) drawDoc(ctx, dx, dy, 16, 20, it.color, it.label);
    });
  };

  /* Стеллаж входящих счетов */
  function InvoiceStackTray() {
    this.wobble = 0;
  }
  InvoiceStackTray.prototype.draw = function (ctx) {
    drawRR(ctx, -175, -88, 28, 70, 4, "rgba(30,41,59,0.6)", C.outline);
    for (var i = 0; i < 4; i++) {
      drawDoc(ctx, -161, -72 + i * 5, 14, 18, i % 2 ? C.docWhite : C.docAmber, "");
    }
    ctx.fillStyle = C.erpGold;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Вход", -172, -94);
  };

  /* OCR-линза — сканирует документ в центре */
  function OcrLensScanner() {
    this.beamX = -40;
  }
  OcrLensScanner.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 250;
    if (prg < 55 || prg >= 135) return;

    var scanPrg = (prg - 55) / 80;
    this.beamX = -50 + scanPrg * 100;

    ctx.save();
    ctx.globalAlpha = 0.35 + Math.sin(frame * 0.12) * 0.15;
    ctx.fillStyle = C.scanBeam;
    ctx.fillRect(this.beamX - 2, -45, 4, 70);
    ctx.strokeStyle = "#38bdf8";
    ctx.lineWidth = 1.5;
    ctx.strokeRect(this.beamX - 18, -40, 36, 58);
    ctx.restore();

    if (prg > 70 && prg < 125) {
      var fields = ["ИНН", "Сумма", "НДС", "Дата"];
      fields.forEach(function (f, i) {
        var fx = -35 + (i % 2) * 42;
        var fy = -30 + Math.floor(i / 2) * 18;
        var pop = Math.min(1, (prg - 70 - i * 8) / 12);
        if (pop > 0) {
          drawRR(ctx, fx, fy, 36, 12, 3, C.fieldChip, C.outline);
          ctx.fillStyle = "#0f172a";
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.textAlign = "center";
          ctx.globalAlpha = pop;
          ctx.fillText(f, fx + 18, fy + 9);
          ctx.globalAlpha = 1;
        }
      });
    }
  };

  /* Книга сверки НДС */
  function ReconciliationLedger() {
    this.checks = 0;
  }
  ReconciliationLedger.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 250;
    drawRR(ctx, 108, -58, 48, 62, 5, "rgba(255,255,255,0.06)", C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Сверка", 132, -48);

    if (prg >= 135 && prg < 195) {
      var rows = ["НДС ✓", "Сумма ✓", "Контр. ✓"];
      rows.forEach(function (r, i) {
        var on = prg > 140 + i * 15;
        ctx.fillStyle = on ? C.erpGreen : "rgba(255,255,255,0.35)";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(r, 114, -32 + i * 16);
      });
    }
  };

  /* Ядро проводки 1С — вместо WebsiteTerminal */
  function ErpPostingCore() {
    this.tab = 0;
    this.stampPhase = 0;
  }
  ErpPostingCore.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 250;
    drawRR(ctx, 15, -78, 118, 148, 10, C.erpBase, C.outline);

    /* Шапка 1С-стиля */
    drawRR(ctx, 22, -70, 104, 18, [6, 6, 0, 0], C.erpRed, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("1С · ERP", 28, -58);

    /* Вкладки */
    var tabs = ["Счёт", "Заявка", "УПД"];
    var activeTab = prg < 80 ? 0 : prg < 160 ? 1 : 2;
    this.tab = activeTab;
    tabs.forEach(function (t, i) {
      var tx = 24 + i * 34;
      drawRR(ctx, tx, -48, 30, 12, 3, i === activeTab ? "rgba(245,197,24,0.25)" : "rgba(255,255,255,0.06)", C.outline);
      ctx.fillStyle = i === activeTab ? C.erpGold : "#94a3b8";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(t, tx + 15, -39);
    });

    /* Строки документа */
    if (prg >= 60) {
      for (var r = 0; r < 4; r++) {
        drawRR(ctx, 26, -28 + r * 16, 96, 10, 2, "rgba(255,255,255,0.08)", null);
        if (prg > 90 + r * 10) {
          ctx.fillStyle = "#cbd5e1";
          ctx.fillRect(30, -24 + r * 16, 50 + (r * 7), 3);
        }
      }
    }

    /* Фаза POST: штамп «Проведено» */
    if (prg >= 195) {
      var stampPrg = Math.min(1, (prg - 195) / 18);
      ctx.save();
      ctx.translate(74, 20);
      ctx.rotate(-0.18 * stampPrg);
      ctx.globalAlpha = stampPrg;
      ctx.strokeStyle = C.stampRed;
      ctx.lineWidth = 2;
      ctx.strokeRect(-28, -12, 56, 24);
      ctx.fillStyle = C.stampRed;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ПРОВЕДЕНО", 0, 4);
      ctx.restore();
    }

    /* Журнал операций внизу */
    if (prg >= 210) {
      drawRR(ctx, 26, 38, 96, 22, 4, "rgba(34,197,94,0.18)", C.erpGreen);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Журнал: +1 проводка", 74, 52);
    }
  };

  /* Луч OData-синхронизации */
  function OdataSyncBeam() {
    this.pulse = 0;
  }
  OdataSyncBeam.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 250;
    if (prg < 188 || prg > 248) return;
    this.pulse = (prg - 188) / 60;
    var alpha = prg < 230 ? this.pulse : 1 - (prg - 230) / 18;
    ctx.strokeStyle = "rgba(56,189,248," + (alpha * 0.75) + ")";
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 4]);
    ctx.beginPath();
    ctx.moveTo(-5, 15);
    ctx.lineTo(20, 15);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle = "#38bdf8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("OData → 1С", 8, 28);
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
    var prg = (frame * 0.038) % 250;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    /* Агенты идут к сканеру сверху по дуге — иная геометрия */
    var scanTargets = {
      "1_architect": { x: -75, y: 40 },
      "2_seo": { x: -25, y: 48 },
      "3_coder": { x: 25, y: 48 },
      "4_designer": { x: 75, y: 40 },
      "5_deployer": { x: 0, y: 58 }
    };
    var tgt = scanTargets[this.role] || { x: 0, y: 45 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 17) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 10 ? this.color : null;
    }

    if (!isMoving && frame % 210 === 0 && Math.random() < 0.11) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 230);
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
  var chute = new DocumentSorterChute();
  var stack = new InvoiceStackTray();
  var scanner = new OcrLensScanner();
  var ledger = new ReconciliationLedger();
  var erpCore = new ErpPostingCore();
  var odata = new OdataSyncBeam();

  entities.push(stack);
  entities.push(chute);
  entities.push(scanner);
  entities.push(ledger);
  entities.push(erpCore);
  entities.push(odata);
  entities.push(new Agent(-130, 88, C.agentYellow, "1_architect", 20, [
    "Схема регистров 1С", "Маппинг полей УТ", "Аудит первички"
  ]));
  entities.push(new Agent(-65, 95, C.agentGreen, "2_seo", 68, [
    "Контрагент в справочнике", "Номенклатура сопоставлена", "ИНН валиден"
  ]));
  entities.push(new Agent(0, 98, C.agentBlue, "3_coder", 118, [
    "JSON Schema NER", "POST /odata/standard", "Идемпотентность GUID"
  ]));
  entities.push(new Agent(65, 95, C.agentPink, "4_designer", 168, [
    "Review при 0.78", "UI бухгалтера", "Поля human-in-the-loop"
  ]));
  entities.push(new Agent(130, 88, C.agentPurple, "5_deployer", 218, [
    "Проведение в 1С:ERP", "Регламент 152-ФЗ", "Алерт в Telegram"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.038) % 250;
    if (prg >= 18 && prg < 18.05) createBubble(-120, -50, "1. Документ в желоб");
    if (prg >= 72 && prg < 72.05) createBubble(-30, -55, "2. OCR + NER полей");
    if (prg >= 148 && prg < 148.05) createBubble(50, -20, "3. Сверка НДС");
    if (prg >= 200 && prg < 200.05) createBubble(70, 25, "4. Проводка в 1С");
    if (prg >= 235 && prg < 235.05) createBubble(0, 70, "5. OData синхронизация");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      drawRR(ctx, b.x - (ctx.measureText(b.text).width + 14) / 2, b.y - 22, ctx.measureText(b.text).width + 14, 18, 5, C.bubbleBg, C.erpGold);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
      ctx.fillText(b.text, b.x, b.y - 11);
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
  document.querySelectorAll('.a1c-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.a1c-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.a1c-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.a1c-faq-q');
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
  var root = document.querySelector('.ai-1c-erp-page') || document.querySelector('.a1c-content');
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

<?php
/**
 * Template Name: AI IT-поддержка сотрудников: внедрение helpdesk под ключ
 * Description: SEO-лендинг — AI-агент внутренней IT-поддержки для сотрудников.
 */

declare(strict_types=1);

$page_seo_title       = 'AI IT-поддержка сотрудников: внедрение helpdesk под ключ';
$page_seo_description = 'Внедряем AI-агента внутренней IT-поддержки: автоответы на типовые вопросы, создание тикетов, маршрутизация в IT. Кейсы, схема helpdesk, цены. Аудит бесплатно.';

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
    ['label' => 'Схема helpdesk', 'href' => '#shema-helpdesk'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Цены', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Снизить нагрузку IT';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение AI для IT';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#etapy';

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
/* Kadence layout reset + breadcrumbs hide */
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

/* Hero full viewport */
.ithp-page .ithp-hero.nero-ai-hero{
  min-height:min(980px,calc(100dvh - 1px));
  position:relative;
  display:grid;
  align-items:center;
}

.ithp-content{
  --ithp-bg:#050711;--ithp-bg2:#080b17;--ithp-text:#e6edf7;--ithp-muted:#9aa8bd;--ithp-soft:#c7d2e5;--ithp-heading:#fff;
  --ithp-border:rgba(255,255,255,.10);--ithp-accent:#79f2ff;--ithp-accent-2:#8b5cf6;--ithp-green:#22c55e;
  --ithp-btn-from:#2563eb;--ithp-btn-to:#7c3aed;--ithp-r:18px;--ithp-r-lg:24px;--ithp-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--ithp-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.ithp-content *,.ithp-content *::before,.ithp-content *::after{box-sizing:border-box;}
.ithp-content a{color:inherit;text-decoration:none;}
.ithp-content p{color:var(--ithp-muted);line-height:1.72;margin:0 0 1em;}
.ithp-content p:last-child{margin-bottom:0;}
.ithp-content h2,.ithp-content h3,.ithp-content h4{color:var(--ithp-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.ithp-content strong{color:var(--ithp-soft);}
.ithp-content ul,.ithp-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.ithp-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--ithp-muted);font-size:14.5px;line-height:1.65;}
.ithp-content ul li::before{content:'›';position:absolute;left:0;color:var(--ithp-accent);font-weight:700;}
.ithp-content ol{counter-reset:ithp-ol;}
.ithp-content ol li{counter-increment:ithp-ol;padding-left:28px;position:relative;margin-bottom:.5em;color:var(--ithp-muted);font-size:14.5px;line-height:1.65;}
.ithp-content ol li::before{content:counter(ithp-ol);position:absolute;left:0;width:20px;height:20px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--ithp-accent);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;top:1px;}
.ithp-cnt{width:min(var(--ithp-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.ithp-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.ithp-section-alt{background:rgba(255,255,255,.03);border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.ithp-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.ithp-sh.ithp-left{margin-left:0;text-align:left;}
.ithp-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.ithp-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.ithp-sh.ithp-left p{margin-left:0;}
.ithp-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ithp-accent);margin-bottom:14px;}
.ithp-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:rgba(255,255,255,.03);border-bottom:1px solid rgba(255,255,255,.06);}
.ithp-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.ithp-intro-text{position:relative;padding-left:20px;}
.ithp-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--ithp-accent),var(--ithp-accent-2));}
@media(max-width:900px){.ithp-intro-grid{grid-template-columns:1fr;gap:36px;}}
.ithp-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.ithp-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.ithp-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.06);border:1px solid var(--ithp-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--ithp-muted);transition:border-color .2s,color .2s,background .2s;}
.ithp-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--ithp-accent);background:rgba(121,242,255,.08);}
.ithp-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--ithp-border);border-radius:var(--ithp-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.ithp-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.ithp-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.ithp-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.ithp-grid-2,.ithp-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.ithp-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.ithp-grid-3{grid-template-columns:1fr;}}
.ithp-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--ithp-r);padding:26px;margin-bottom:14px;}
.ithp-scenario:last-child{margin-bottom:0;}
.ithp-scenario h3{font-size:17px;margin-bottom:8px;}
.ithp-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.ithp-table{width:100%;border-collapse:collapse;font-size:14px;}
.ithp-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--ithp-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.ithp-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--ithp-text);vertical-align:top;}
.ithp-table tr:last-child td{border-bottom:none;}
.ithp-table tr:hover td{background:rgba(255,255,255,.03);}
.ithp-timeline{position:relative;padding-left:40px;}
.ithp-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--ithp-accent),var(--ithp-accent-2));opacity:.35;border-radius:2px;}
.ithp-tl-item{position:relative;margin-bottom:32px;}
.ithp-tl-item:last-child{margin-bottom:0;}
.ithp-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--ithp-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.ithp-tl-item h3{font-size:17px;margin-bottom:8px;}
.ithp-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.ithp-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.ithp-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--ithp-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.ithp-faq-q::after{content:'▾';font-size:13px;color:var(--ithp-accent);flex-shrink:0;transition:transform .25s;}
.ithp-faq-item.open .ithp-faq-q::after{transform:rotate(180deg);}
.ithp-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--ithp-muted);line-height:1.72;}
.ithp-faq-item.open .ithp-faq-a{max-height:600px;padding:0 24px 20px;}
.ithp-code{background:rgba(0,0,0,.35);border:1px solid rgba(121,242,255,.15);border-radius:12px;padding:18px 20px;font-family:ui-monospace,monospace;font-size:12.5px;line-height:1.6;color:var(--ithp-soft);overflow-x:auto;margin:20px 0;white-space:pre-wrap;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--ithp-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--ithp-btn-from),var(--ithp-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-link--accent{color:var(--ithp-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
.ithp-intro-text p{text-align:left!important;}
.ithp-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.ithp-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.ithp-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--ithp-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.ithp-kpi-card .kl{font-size:11px;font-weight:600;color:var(--ithp-muted);line-height:1.4;}
.ithp-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.ithp-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.ithp-intro-kpi{grid-template-columns:1fr 1fr;}}

</style>

<main id="primary" class="site-main nero-ai-home-page ithp-page" role="main" tabindex="-1">

<section class="nero-ai-hero ithp-hero" id="ithp-hero" aria-labelledby="ithp-hero-title">
<style>
/* ===== ITHP HERO — самодостаточные стили (не полагаться на тему) ===== */
.ithp-hero {
  --ithp-accent: #79f2ff;
  --ithp-accent-2: #8b5cf6;
  --ithp-muted: rgba(255,255,255,.68);
  --ithp-soft: #c7d2e5;
  --ithp-text: #e6edf7;
  --ithp-shadow: 0 24px 72px rgba(0,0,0,.42);
  position: relative;
  padding: clamp(72px, 10vw, 120px) 0 clamp(56px, 8vw, 96px);
  overflow: hidden;
}
.ithp-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse 80% 60% at 15% 20%, rgba(121,242,255,.09), transparent 55%),
    radial-gradient(ellipse 60% 50% at 85% 70%, rgba(139,92,246,.08), transparent 50%);
  pointer-events: none;
}
.ithp-hero .nero-ai-container.nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
  position: relative;
  z-index: 1;
}
.ithp-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.ithp-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--ithp-accent) 44%, var(--ithp-accent-2) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.ithp-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121,242,255,.24);
  border-radius: 999px;
  background: rgba(121,242,255,.08);
  color: var(--ithp-accent) !important;
  font-size: 12px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.ithp-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--ithp-muted) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.ithp-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.ithp-hero .nero-ai-badge {
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
.ithp-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.ithp-hero .nero-ai-btn {
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
.ithp-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.ithp-hero .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--ithp-accent), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121,242,255,.22);
}
.ithp-hero .nero-ai-btn-secondary {
  color: var(--ithp-text) !important;
  background: rgba(255,255,255,.07);
  border-color: rgba(255,255,255,.14);
}
.ithp-hero .ithp-flow-steps {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 28px;
  padding: 0;
  list-style: none;
}
.ithp-hero .ithp-flow-steps li {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 12px;
  border-radius: 999px;
  border: 1px solid rgba(121,242,255,.18);
  background: rgba(121,242,255,.06);
  color: var(--ithp-soft);
  font-size: 12px;
  font-weight: 700;
}
.ithp-hero .ithp-flow-steps li span {
  display: grid;
  place-items: center;
  width: 22px;
  height: 22px;
  border-radius: 8px;
  background: linear-gradient(135deg, var(--ithp-accent), var(--ithp-accent-2));
  color: #041018;
  font-size: 11px;
  font-weight: 900;
}
.ithp-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--ithp-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.ithp-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.ithp-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.ithp-hero .nero-ai-dots { display: flex; gap: 7px; }
.ithp-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.ithp-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.ithp-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.ithp-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.ithp-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.ithp-hero .nero-ai-window-body { padding: 16px; }
.ithp-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.ithp-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.ithp-hero .nero-ai-live-pill {
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
.ithp-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: ithpPulse 1.6s infinite;
}
@keyframes ithpPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.ithp-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.ithp-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.ithp-hero .nero-ai-metric span {
  display: block;
  color: var(--ithp-muted);
  font-size: 11px;
  font-weight: 700;
}
.ithp-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.ithp-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.ithp-hero .ithp-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121,242,255,.18);
  background: radial-gradient(ellipse at 35% 40%, rgba(121,242,255,.08), rgba(6,10,24,.94) 72%);
}
.ithp-hero #ithp-helpdesk-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.ithp-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.ithp-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.ithp-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--ithp-accent);
  font-size: 11px;
  font-weight: 800;
}
.ithp-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.ithp-hero .nero-ai-task span {
  color: var(--ithp-muted);
  font-size: 11px;
}
.ithp-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.ithp-hero .nero-ai-status--amber {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
.ithp-hero .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
@media (max-width: 1024px) {
  .ithp-hero .nero-ai-container.nero-ai-hero-grid { grid-template-columns: 1fr; }
  .ithp-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 640px) {
  .ithp-hero .nero-ai-metrics-grid { grid-template-columns: 1fr; }
  .ithp-hero .ithp-flow-steps li { font-size: 11px; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Внутренний IT desk · AI helpdesk</p>
      <h1 id="ithp-hero-title">AI-агент внутренней IT-поддержки: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть отвечает на типовые вопросы сотрудников, создаёт тикеты и передаёт сложные случаи IT — без перегрузки отдела</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">AI helpdesk IT</li>
        <li class="nero-ai-badge">RAG + actions</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">152-ФЗ</li>
        <li class="nero-ai-badge">Teams / Telegram</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Снизить нагрузку IT</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#shema-helpdesk">Схема helpdesk</a>
      </div>
      <ol class="ithp-flow-steps" aria-label="Этапы helpdesk-воронки">
        <li><span>1</span> Заявка сотрудника</li>
        <li><span>2</span> RAG-поиск в KB</li>
        <li><span>3</span> Автоответ / action</li>
        <li><span>4</span> Эскалация L2</li>
      </ol>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI IT helpdesk">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>IT helpdesk · live</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Deflection rate</span>
              <strong>32%</strong>
              <small>за неделю</small>
            </div>
            <div class="nero-ai-metric">
              <span>Время ответа</span>
              <strong>&lt; 1 мин</strong>
              <small>типовые темы</small>
            </div>
            <div class="nero-ai-metric">
              <span>L1 без человека</span>
              <strong>68%</strong>
              <small>пароль / VPN</small>
            </div>
            <div class="nero-ai-metric">
              <span>Открытых тикетов</span>
              <strong>−24%</strong>
              <small>vs прошлый месяц</small>
            </div>
          </div>

          <div class="ithp-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ithp-helpdesk-canvas" role="img" aria-label="Анимация: заявка VPN проходит RAG-диагностику, получает инструкцию и при неудаче эскалируется в L2"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий helpdesk">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">VPN</span>
              <div><strong>«VPN не подключается»</strong><span>Канал: Teams · intent: remote_access</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">intake</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>RAG-диагностика</strong><span>Статья KB #VPN-03 · confidence 0.91</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">?</span>
              <div><strong>«Помогло?»</strong><span>Сотрудник: нет · логи AnyConnect</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">L2</span>
              <div><strong>Тикет #IT-4821</strong><span>Маршрут: сеть · контекст диалога</span></div>
              <span class="nero-ai-status">эскалация</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * ithp-helpdesk-engine — Диспетчерская внутреннего IT helpdesk
 * Мир: TicketPulseLanes → HelpdeskAiConsole → EscalationBeacon
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ithp-helpdesk-canvas");
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
    consoleBg: "#0f172a",
    consoleTop: "#1e293b",
    accent: "#79f2ff",
    accent2: "#8b5cf6",
    green: "#22c55e",
    amber: "#fbbf24",
    ticket: "#e2e8f0",
    ticketHot: "#a5f3fc",
    kb: "#a7f3d0",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    lane: "rgba(121,242,255,0.14)"
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

  /* Горизонтальные импульсные дорожки заявок */
  function TicketPulseLanes() {
    this.wave = 0;
  }
  TicketPulseLanes.prototype.draw = function (ctx) {
    this.wave = (frame * 0.035) % 1;
    var lanes = [-55, -15, 25];
    lanes.forEach(function (ly, idx) {
      drawRR(ctx, -175, ly, 350, 10, 5, "rgba(15,23,42,0.55)", C.lane);
      ctx.strokeStyle = C.accent;
      ctx.lineWidth = 1;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * (0.6 + idx * 0.15);
      ctx.beginPath();
      ctx.moveTo(-170, ly + 5);
      ctx.lineTo(170, ly + 5);
      ctx.stroke();
      ctx.setLineDash([]);
    });

    for (var i = 0; i < 4; i++) {
      var laneY = lanes[i % 3];
      var t = (this.wave + i * 0.22) % 1;
      var tx = -165 + t * 330;
      var isVpn = i === 0;
      drawRR(ctx, tx - 16, laneY - 6, 32, 22, 4, isVpn ? C.ticketHot : C.ticket, C.outline);
      if (isVpn) {
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("VPN", tx, laneY + 7);
      }
    }
  };

  /* Центральная AI-консоль helpdesk */
  function HelpdeskAiConsole() {
    this.phaseLabel = "";
  }
  HelpdeskAiConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, -62, -72, 124, 148, 10, C.consoleBg, C.outline);
    drawRR(ctx, -56, -66, 112, 22, [6, 6, 0, 0], C.consoleTop, C.outline);

    ctx.fillStyle = "#ef4444";
    ctx.beginPath(); ctx.arc(-48, -55, 3, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = "#fbbf24";
    ctx.beginPath(); ctx.arc(-38, -55, 3, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = "#22c55e";
    ctx.beginPath(); ctx.arc(-28, -55, 3, 0, Math.PI * 2); ctx.fill();

    /* Чат сотрудника */
    drawRR(ctx, -50, -38, 88, 22, 5, "rgba(121,242,255,0.12)", C.accent);
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("VPN не подключается", -44, -24);

    /* Фазы: INTAKE → RAG → ASSIST → FEEDBACK → ESCALATE */
    if (prg >= 30 && prg < 90) {
      drawRR(ctx, -50, -10, 100, 36, 5, "rgba(167,243,208,0.18)", C.kb);
      ctx.fillStyle = "#ecfdf5";
      ctx.font = "7px Inter,sans-serif";
      ctx.fillText("KB: AnyConnect чек-лист", -44, 2);
      ctx.fillText("1) Перезапуск клиента", -44, 12);
      ctx.fillText("2) Проверка сертификата", -44, 22);
    }
    if (prg >= 90 && prg < 140) {
      drawRR(ctx, -50, 18, 100, 28, 5, "rgba(34,197,94,0.15)", C.green);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Инструкция отправлена", -44, 32);
      ctx.font = "7px Inter,sans-serif";
      ctx.fillText("Ожидание ответа сотрудника…", -44, 42);
    }
    if (prg >= 140 && prg < 190) {
      drawRR(ctx, -50, 18, 48, 20, 5, "rgba(34,197,94,0.2)", C.green);
      drawRR(ctx, 2, 18, 48, 20, 5, "rgba(251,191,36,0.2)", C.amber);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Да", -26, 31);
      ctx.fillText("Нет", 26, 31);
    }
    if (prg >= 190) {
      var esc = Math.min(1, (prg - 190) / 30);
      drawRR(ctx, -50, 50, 100, 24, 5, "rgba(139,92,246,0.22)", C.accent2);
      ctx.fillStyle = "#ede9fe";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Тикет #IT-4821 → L2", 0, 64);
      ctx.strokeStyle = "rgba(121,242,255," + (0.4 + esc * 0.5) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(62, 62);
      ctx.lineTo(62 + esc * 55, 62 - esc * 35);
      ctx.stroke();
    }

    this.phaseLabel = prg < 30 ? "INTAKE" : prg < 90 ? "RAG" : prg < 140 ? "ASSIST" : prg < 190 ? "FEEDBACK" : "ESCALATE";
    ctx.fillStyle = C.accent;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "right";
    ctx.fillText(this.phaseLabel, 54, -58);
  };

  /* Маяк VPN-диагностики */
  function VpnShieldBeacon() {
    this.pulse = 0;
  }
  VpnShieldBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    this.pulse = Math.sin(frame * 0.08) * 0.5 + 0.5;
    drawRR(ctx, -155, -48, 34, 40, 6, "rgba(121,242,255,0.1)", C.accent);
    ctx.fillStyle = C.accent;
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("VPN", -138, -22);
    if (prg > 35 && prg < 95) {
      ctx.strokeStyle = "rgba(121,242,255," + (0.3 + this.pulse * 0.5) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(-138, -28, 22 + this.pulse * 6, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* Сканер фрагментов KB */
  function KnowledgeShardScanner() {
    this.idx = 0;
  }
  KnowledgeShardScanner.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 25 || prg > 100) return;
    var shards = ["KB", "FAQ", "SOP"];
    shards.forEach(function (s, i) {
      var ang = (frame * 0.04 + i * 2.1) % (Math.PI * 2);
      var sx = Math.cos(ang) * 38 - 138;
      var sy = Math.sin(ang) * 18 - 5;
      drawRR(ctx, sx, sy, 22, 14, 3, C.kb, C.outline);
      ctx.fillStyle = "#064e3b";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(s, sx + 11, sy + 10);
    });
  };

  /* Маршрутизатор каналов */
  function ChannelRouter() {
    this.blink = 0;
  }
  ChannelRouter.prototype.draw = function (ctx) {
    var channels = ["TG", "MS"];
    channels.forEach(function (ch, i) {
      var x = 118 + i * 28;
      drawRR(ctx, x, -58, 24, 18, 4, "rgba(255,255,255,0.08)", C.outline);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(ch, x + 12, -45);
    });
    if (frame % 90 < 45) {
      this.blink = 1;
      ctx.fillStyle = C.accent;
      ctx.beginPath();
      ctx.arc(130, -68, 3, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  /* Кольцо SLA */
  function SlaCountdownRing() {
    this.angle = 0;
  }
  SlaCountdownRing.prototype.draw = function (ctx) {
    this.angle = (frame * 0.03) % (Math.PI * 2);
    ctx.strokeStyle = "rgba(251,191,36,0.35)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(130, 28, 22, 0, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = C.amber;
    ctx.beginPath();
    ctx.arc(130, 28, 22, -Math.PI / 2, -Math.PI / 2 + this.angle);
    ctx.stroke();
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("SLA", 130, 31);
  };

  /* Маяк эскалации L2 */
  function EscalationBeacon() {
    this.beam = 0;
  }
  EscalationBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, 108, 8, 44, 52, 6, "rgba(139,92,246,0.15)", C.accent2);
    ctx.fillStyle = C.accent2;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("L2", 130, 38);
    if (prg >= 195) {
      this.beam = Math.min(1, (prg - 195) / 20);
      ctx.fillStyle = "rgba(139,92,246," + (0.15 + this.beam * 0.35) + ")";
      ctx.beginPath();
      ctx.moveTo(130, -8);
      ctx.lineTo(118, 8);
      ctx.lineTo(142, 8);
      ctx.closePath();
      ctx.fill();
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
    var prg = (frame * 0.042) % 240;
    var targetX = 20;
    var targetY = -20 + (this.stepTrig * 0.35);

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var localPrg = prg - this.stepTrig;
      if (localPrg < 9) {
        isMoving = true; faceDir = 1; carryType = this.color;
        this.x = this.baseX + (targetX - this.baseX) * (localPrg / 9);
        this.y = this.baseY + (targetY - this.baseY) * (localPrg / 9);
      } else if (localPrg < 14) {
        isMoving = false; faceDir = 1; this.x = targetX; this.y = targetY;
      } else {
        isMoving = true; faceDir = -1;
        this.x = targetX - (targetX - this.baseX) * ((localPrg - 14) / 8);
        this.y = targetY - (targetY - this.baseY) * ((localPrg - 14) / 8);
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
    ctx.lineJoin = "round";

    var legL = 0, legR = 0;
    if (isMoving) {
      var walkPhase = this.timer * 6;
      legL = Math.sin(walkPhase) * 5;
      legR = Math.sin(walkPhase + Math.PI) * 5;
    }
    drawRR(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
    drawRR(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
    drawRR(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
    drawRR(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);
    drawRR(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);

    var hx = 0, hy = -28 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath(); ctx.arc(hx, hy, 12, 0, Math.PI * 2); ctx.fill();
    ctx.lineWidth = 2; ctx.strokeStyle = C.outline; ctx.stroke();

    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(hx + 5, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 2, 0, Math.PI * 2); ctx.fill();

    if (this.role === "1_architect") {
      ctx.strokeStyle = C.outline; ctx.lineWidth = 1;
      ctx.strokeRect(hx + 1, hy - 5, 6, 6);
      ctx.strokeRect(hx - 7, hy - 5, 6, 6);
    } else if (this.role === "2_seo") {
      drawRR(ctx, hx - 12, hy - 14, 24, 8, [6, 6, 0, 0], C.outline, null);
    } else if (this.role === "3_coder") {
      ctx.fillStyle = C.outline;
      ctx.beginPath();
      ctx.moveTo(hx - 10, hy - 8); ctx.lineTo(hx - 14, hy - 18); ctx.lineTo(hx - 4, hy - 12);
      ctx.lineTo(hx, hy - 20); ctx.lineTo(hx + 4, hy - 12); ctx.lineTo(hx + 12, hy - 16); ctx.lineTo(hx + 10, hy - 8);
      ctx.fill();
    } else if (this.role === "4_designer") {
      drawRR(ctx, hx - 14, hy - 12, 28, 6, 3, "#f43f5e", C.outline);
    } else if (this.role === "5_deployer") {
      ctx.strokeStyle = C.outline; ctx.lineWidth = 2;
      ctx.beginPath(); ctx.arc(hx, hy, 14, Math.PI, Math.PI * 2); ctx.stroke();
    }
    ctx.restore();

    if (carryType) {
      drawRR(ctx, -18 * faceDir, -18 - bob, 16, 16, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new TicketPulseLanes());
  entities.push(new VpnShieldBeacon());
  entities.push(new KnowledgeShardScanner());
  entities.push(new HelpdeskAiConsole());
  entities.push(new ChannelRouter());
  entities.push(new SlaCountdownRing());
  entities.push(new EscalationBeacon());

  entities.push(new Agent(-150, 55, C.agentYellow, "1_architect", 18, [
    "Матрица заявок готова",
    "Топ-15 категорий L1",
    "Пароль — в автомат"
  ]));
  entities.push(new Agent(-95, 78, C.agentGreen, "2_seo", 48, [
    "Статья VPN найдена",
    "RAG: 3 фрагмента KB",
    "Confluence проиндексирован"
  ]));
  entities.push(new Agent(-40, 50, C.agentBlue, "3_coder", 88, [
    "Webhook в Jira SM",
    "Поля тикета заполнены",
    "GLPI API отвечает"
  ]));
  entities.push(new Agent(15, 72, C.agentPink, "4_designer", 128, [
    "Виджет Teams готов",
    "Self-service UX ок",
    "Кнопка «Помогло?»"
  ]));
  entities.push(new Agent(60, 48, C.agentPurple, "5_deployer", 168, [
    "Тикет #4821 → L2",
    "Контекст передан инженеру",
    "Human-in-the-loop"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 260, maxLife: customLife || 260 });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.042) % 240;
    if (prg >= 12 && prg < 12.08) createBubble(-150, 20, "1. Заявка в desk");
    if (prg >= 52 && prg < 52.08) createBubble(-95, 35, "2. RAG по VPN");
    if (prg >= 102 && prg < 102.08) createBubble(-40, 15, "3. Инструкция");
    if (prg >= 152 && prg < 152.08) createBubble(15, 40, "4. «Помогло?»");
    if (prg >= 202 && prg < 202.08) createBubble(60, 10, "5. Эскалация L2");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    ctx.lineJoin = "round";

    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 30);
      if (bub.life > bub.maxLife - 10) alpha = (bub.maxLife - bub.life) / 10;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 16;
      var th = 20;
      var bx = bub.x;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 6, C.bubbleBg, C.accent);
      ctx.fillStyle = C.bubbleBg;
      ctx.beginPath();
      ctx.moveTo(bx - 4, by); ctx.lineTo(bx + 4, by); ctx.lineTo(bx, by + 5);
      ctx.fill();
      ctx.strokeStyle = C.accent; ctx.stroke();
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2);
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

<div class="ithp-content">

  <section class="ithp-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="ithp-cnt">
      <div class="ithp-intro-grid nero-ai-reveal">
        <div class="ithp-intro-text">
          <p class="ithp-eyebrow">Лонгрид · ai it поддержка сотрудников</p>
          <p><strong>Коротко:</strong> AI-агент внутренней IT-поддержки — цифровой первый контакт для сотрудников: нейросеть понимает запрос на естественном языке, ищет ответ в корпоративной базе знаний, выполняет типовые действия через API и передаёт сложные случаи живому инженеру с полным контекстом диалога.</p>
          <p>На корпоративном масштабе схожие принципы governance и human-in-the-loop разбираем в материале <a href="<?php echo esc_url(home_url('/kpmg-claude-vnedrenie-ai-276-tysyach/')); ?>" class="ym-link ym-link--accent">KPMG и Claude: уроки AI для бизнеса</a> — полезно сравнить с внутренним helpdesk.</p>
          <p>Nero Network внедряет <strong>ai it поддержку сотрудников</strong> под ключ: от аудита заявок до запуска <strong>ai helpdesk it</strong> в Teams, Telegram или на корпоративном портале.</p>
        </div>

        <div class="ithp-intro-kpi" aria-label="Ключевые метрики IT helpdesk">
          <div class="ithp-kpi-card"><div class="kv">32%</div><div class="kl">deflection rate</div><div class="ks">типовые L1</div></div>
          <div class="ithp-kpi-card"><div class="kv">&lt; 1 мин</div><div class="kl">время ответа</div><div class="ks">FRT типовых тем</div></div>
          <div class="ithp-kpi-card"><div class="kv">68%</div><div class="kl">L1 без человека</div><div class="ks">пароль / VPN</div></div>
          <div class="ithp-kpi-card"><div class="kv">−24%</div><div class="kl">открытых тикетов</div><div class="ks">vs прошлый месяц</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="ithp-toc-outer">
    <div class="ithp-cnt">
      <nav class="ithp-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что такое AI helpdesk</a>
        <a href="#problema">Проблема IT</a>
        <a href="#shema-helpdesk">Схема helpdesk</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#integracii">Интеграции</a>
        <a href="#etapy">Внедрение</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Цены</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Аудит</a>
      </nav>
    </div>
  </div>

  <!-- §1 #chto-takoe -->
  <section class="ithp-section" id="chto-takoe">
    <div class="ithp-cnt">
      <div class="ithp-sh ithp-left">
        <span class="ithp-eyebrow">Определение</span>
        <h2>Что такое AI-агент внутренней IT-поддержки и зачем он нужен</h2>
        <p>AI-агент — не «чат с ChatGPT» и не FAQ-бот с кнопками. Это <strong>ai внутренний помощник</strong> в контуре компании: регламенты, ITSM, каталог услуг, Active Directory.</p>
      </div>

      <div class="ithp-table-wrap nero-ai-reveal">
        <table class="ithp-table">
          <thead>
            <tr><th>Критерий</th><th>Классический IT support</th><th>FAQ-чат-бот</th><th>AI-агент helpdesk</th></tr>
          </thead>
          <tbody>
            <tr><td>Понимание запроса</td><td>Человек интерпретирует</td><td>Только кнопки/ключевые слова</td><td>Естественный язык + контекст</td></tr>
            <tr><td>Источник ответа</td><td>Опыт инженера</td><td>Зашитые сценарии</td><td>RAG + actions</td></tr>
            <tr><td>Действия</td><td>Инженер вручную</td><td>Минимум</td><td>Тикет, статус, сброс пароля</td></tr>
            <tr><td>Масштаб</td><td>Линейно от штата</td><td>Дёшево, но ограниченно</td><td>24/7 self-service</td></tr>
            <tr><td>Эскалация</td><td>—</td><td>Часто тупик</td><td>L2 с историей и классификацией</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ithp-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Как нейросеть снижает нагрузку на IT-отдел</h3>
        <p>По бенчмаркам <strong>60–70% L1-тикетов</strong> — повторяющиеся категории. AI-агент закрывает цикл: ответ → «помогло?» → закрытие или тикет. Итог — <strong>снижение нагрузки IT</strong> на 30–50% при зрелой KB; FRT для типовых тем — секунды вместо часов.</p>
      </div>
    </div>
  </section>

  <!-- §2 #problema -->
  <section class="ithp-section ithp-section-alt" id="problema">
    <div class="ithp-cnt">
      <div class="ithp-sh ithp-left">
        <span class="ithp-eyebrow">Боль бизнеса</span>
        <h2>Почему IT-отдел перегружен: однотипные вопросы и заявки</h2>
        <p>Главная боль средней компании (100–1000 сотрудников): <strong>IT получает однотипные вопросы и заявки</strong>, а штат не растёт.</p>
      </div>

      <div class="ithp-grid-2 nero-ai-reveal">
        <div class="ithp-card">
          <h3>Типичная картина</h3>
          <ul>
            <li>40–60% дня — повторяющиеся обращения</li>
            <li>Сотрудники пишут в личку «срочно сбрось пароль»</li>
            <li>KB есть, но ею не пользуются</li>
            <li>Без аналитики не видно, что «съедает» IT</li>
          </ul>
        </div>
        <div class="ithp-card">
          <h3>Топ-15 категорий для автоматизации</h3>
          <p>Основа лид-магнита «Список IT-заявок для автоматизации»: пароль, VPN, почта, SharePoint, ПО, принтер, Wi‑Fi, онбординг, оборудование, 1С, статус заявки, MFA, CRM, VPN для командировки, регламент ИБ.</p>
        </div>
      </div>

      <div class="ithp-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Сколько времени уходит на L1 без AI</h3>
        <p>Медианный FRT на L1 — 2–8 часов; в пик — сутки. С AI: FRT типовых тем — секунды; классификация и поля тикета — автоматически; инженер только на сложных случаях. <strong>63% пользователей предпочитают self-service</strong>, если он быстрый (Gartner, 2026).</p>
      </div>

      <!-- CTA №1 от Артура -->
      <aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-audit-it">
        <div class="ym-cta-block__icon" aria-hidden="true">🎫</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Снизить нагрузку IT — начните с аудита заявок</p>
          <p class="ym-cta-block__sub">Бесплатно разберём 200 последних тикетов, выделим топ-15 категорий для автоматизации и дадим матрицу «автоматизируем / полуавтомат / только человек». На выходе — «Список IT-заявок для автоматизации» и ориентир по deflection без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </aside>
    </div>
  </section>

  <!-- §3 #shema-helpdesk + БОРИС VIZ -->
  <section class="ithp-section" id="shema-helpdesk">
    <div class="ithp-cnt">
      <div class="ithp-sh">
        <span class="ithp-eyebrow">Воронка helpdesk</span>
        <h2>Схема helpdesk с AI: от вопроса сотрудника до тикета</h2>
        <p>Центральный блок страницы — логика <strong>ai helpdesk it</strong> под ключ: канал → RAG → action → тикет → человек.</p>
      </div>

      <div class="ithp-code nero-ai-reveal" aria-label="Текстовая схема воронки">
Сотрудник → Канал (Teams / Telegram / виджет / почта)
    → AI-агент: классификация + RAG-поиск в KB
        ├─ [Высокая уверенность + типовой] → Ответ + self-service → Закрытие
        ├─ [Средняя уверенность] → Ответ + «Помогло?» → Да: закрыть / Нет: тикет
        └─ [Сложный / критичный] → Тикет L2 + контекст → Инженер IT → Обновление KB
      </div>

      <!-- === БОРИС: визуальный блок #boris-helpdesk-viz === -->
      <div id="boris-helpdesk-viz" class="bih-root" aria-label="Анимация: сценарий VPN — диагностика, инструкция, эскалация в тикет L2">
<style>
#boris-helpdesk-viz.bih-root{padding:8px 0 48px;}
#boris-helpdesk-viz .bih-cnt{max-width:1160px;margin:0 auto;}
#boris-helpdesk-viz .bih-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #boris-helpdesk-viz .bih-card{grid-template-columns:1fr;min-height:auto;}
}
#boris-helpdesk-viz .bih-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;background:#fff;
}
@media(max-width:1023px){
  #boris-helpdesk-viz .bih-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#boris-helpdesk-viz .bih-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:#0891b2;margin:0 0 14px;
}
#boris-helpdesk-viz .bih-ey::before{content:'';width:18px;height:2px;background:#0891b2;border-radius:1px;}
#boris-helpdesk-viz .bih-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#boris-helpdesk-viz .bih-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#boris-helpdesk-viz .bih-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#boris-helpdesk-viz .bih-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(8,145,178,.1);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#0e7490;margin-top:1px;font-style:normal;
}
#boris-helpdesk-viz .bih-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#boris-helpdesk-viz .bih-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#boris-helpdesk-viz .bih-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#boris-helpdesk-viz .bih-pl-c{background:rgba(8,145,178,.08);color:#0e7490;border:1.5px solid rgba(8,145,178,.22);}
#boris-helpdesk-viz .bih-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#boris-helpdesk-viz .bih-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#boris-helpdesk-viz .bih-rgt{
  position:relative;background:linear-gradient(135deg,#f0fdfa 0%,#ecfeff 35%,#f8fafc 100%);
  min-height:420px;overflow:hidden;
}
@media(max-width:1023px){#boris-helpdesk-viz .bih-rgt{min-height:360px;}}
#ithp-helpdesk-funnel-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

        <div class="bih-cnt">
          <div class="bih-card">
            <div class="bih-lft">
              <span class="bih-ey">Сценарий · VPN</span>
              <h3 class="bih-h3">«Не работает VPN» → диагностика → инструкция → тикет L2 с контекстом</h3>
              <ul class="bih-ul">
                <li><span class="bih-ic">1</span>Сотрудник пишет в Teams/Telegram — AI классифицирует интент «VPN»</li>
                <li><span class="bih-ic">2</span>RAG находит статью KB → пошаговая диагностика (клиент, сертификат, сеть)</li>
                <li><span class="bih-ic">3</span>«Помогло?» — при «Нет» создаётся тикет с историей чата и логами</li>
                <li><span class="bih-ic">→</span>Инженер L2 получает структурированный контекст, не «что-то не работает»</li>
              </ul>
              <div class="bih-pills">
                <span class="bih-pl bih-pl-c">32% deflection</span>
                <span class="bih-pl bih-pl-g">&lt; 1 мин FRT</span>
                <span class="bih-pl bih-pl-v">Human-in-the-loop</span>
              </div>
              <p class="bih-foot">Дальше — ключевые сценарии IT support →</p>
            </div>
            <div class="bih-rgt">
              <canvas id="ithp-helpdesk-funnel-canvas" role="img" aria-label="Анимация воронки helpdesk: запрос VPN проходит через AI-агента, RAG и эскалацию в тикет L2"></canvas>
            </div>
          </div>
        </div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('ithp-helpdesk-funnel-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;
  var LOOP = 720;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a', muted:'#64748b', line:'rgba(8,145,178,.25)',
    cyan:'#06b6d4', cyanL:'rgba(6,182,212,.12)', green:'#22c55e', greenL:'rgba(34,197,94,.12)',
    violet:'#8b5cf6', violetL:'rgba(139,92,246,.12)', orange:'#f59e0b', orangeL:'rgba(245,158,11,.12)',
    white:'#ffffff', card:'#f8fafc', bdr:'#cbd5e1', bubble:'#ecfeff', bubbleBdr:'#67e8f9'
  };

  var NODES = [
    {id:'emp', label:'Сотрудник', sub:'VPN?', x:.08, y:.42, w:.14, h:.16, clr:C.cyan},
    {id:'ch', label:'Канал', sub:'Teams', x:.26, y:.42, w:.12, h:.14, clr:C.cyan},
    {id:'ai', label:'AI-агент', sub:'RAG + intent', x:.44, y:.38, w:.16, h:.22, clr:C.violet},
    {id:'ok', label:'Self-service', sub:'Закрыто', x:.72, y:.18, w:.14, h:.14, clr:C.green},
    {id:'fb', label:'«Помогло?»', sub:'Средняя', x:.72, y:.42, w:.14, h:.14, clr:C.orange},
    {id:'l2', label:'Тикет L2', sub:'Эскалация', x:.72, y:.66, w:.14, h:.14, clr:C.orange}
  ];

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function nodePos(n){
    return {x:n.x*W, y:n.y*H, w:n.w*W, h:n.h*H, cx:n.x*W+n.w*W/2, cy:n.y*H+n.h*H/2};
  }

  function drawNode(n, alpha, pulse){
    var p = nodePos(n);
    ctx.globalAlpha = alpha || 1;
    rr(p.x,p.y,p.w,p.h,10,C.white,n.clr,2);
    rr(p.x+4,p.y+4,p.w-8,5,3,n.clr,null,0);
    if(pulse){
      ctx.strokeStyle=n.clr; ctx.lineWidth=2; ctx.globalAlpha=.35+Math.sin(frame*.08)*.2;
      rr(p.x-3,p.y-3,p.w+6,p.h+6,12,null,n.clr,2);
      ctx.globalAlpha=alpha||1;
    }
    ctx.fillStyle=C.ink; ctx.font='bold 11px Inter,system-ui,sans-serif'; ctx.textAlign='center';
    ctx.fillText(n.label, p.cx, p.cy+2);
    ctx.fillStyle=C.muted; ctx.font='10px Inter,sans-serif';
    ctx.fillText(n.sub, p.cx, p.cy+16);
    ctx.globalAlpha=1;
  }

  function drawEdge(x1,y1,x2,y2,prog,clr){
    ctx.strokeStyle=clr||C.line; ctx.lineWidth=2;
    ctx.setLineDash([6,4]); ctx.lineDashOffset=-frame*.5;
    ctx.beginPath(); ctx.moveTo(x1,y1);
    var mx=(x1+x2)/2, my=(y1+y2)/2-12;
    ctx.quadraticCurveTo(mx,my,x2,y2); ctx.stroke();
    ctx.setLineDash([]);
    if(prog>0){
      var t=Math.min(1,prog);
      var px=x1+(x2-x1)*t, py=y1+(y2-y1)*t;
      ctx.fillStyle=clr||C.cyan;
      ctx.beginPath(); ctx.arc(px,py,5,0,Math.PI*2); ctx.fill();
    }
  }

  function drawBubble(x,y,text,w,side){
    var bw=w||120, bh=36;
    var bx=side==='left'?x-bw-8:x+8;
    rr(bx,y-bh/2,bw,bh,8,C.bubble,C.bubbleBdr,1);
    ctx.fillStyle=C.ink; ctx.font='10px Inter,sans-serif'; ctx.textAlign='center';
    var lines=text.split('\n');
    lines.forEach(function(ln,i){ ctx.fillText(ln,bx+bw/2,y-4+i*12); });
  }

  function drawTicket(x,y,alpha){
    ctx.globalAlpha=alpha||1;
    rr(x,y,90,52,6,C.orangeL,C.orange,1.5);
    ctx.fillStyle=C.orange; ctx.font='bold 9px Inter,sans-serif'; ctx.textAlign='left';
    ctx.fillText('INC-2847 · L2',x+8,y+14);
    ctx.fillStyle=C.ink; ctx.font='9px Inter,sans-serif';
    ctx.fillText('VPN · контекст чата',x+8,y+28);
    ctx.fillText('AnyConnect · cert',x+8,y+40);
    ctx.globalAlpha=1;
  }

  function phase(){
    return frame % LOOP;
  }

  function draw(){
    ctx.clearRect(0,0,W,H);
    var f=phase();
    var emp=nodePos(NODES[0]), ch=nodePos(NODES[1]), ai=nodePos(NODES[2]);
    var ok=nodePos(NODES[3]), fb=nodePos(NODES[4]), l2=nodePos(NODES[5]);

    NODES.forEach(function(n){ drawNode(n,1,false); });

    var prog1=Math.max(0,Math.min(1,(f-20)/80));
    var prog2=Math.max(0,Math.min(1,(f-100)/80));
    var prog3=Math.max(0,Math.min(1,(f-180)/100));
    var prog4=Math.max(0,Math.min(1,(f-320)/120));

    drawEdge(emp.cx+emp.w/2,emp.cy,ch.cx-ch.w/2,ch.cy,prog1,C.cyan);
    drawEdge(ch.cx+ch.w/2,ch.cy,ai.cx-ai.w/2,ai.cy,prog2,C.violet);
    if(f>200) drawEdge(ai.cx+ai.w/2,ai.cy-20,ok.cx-ok.w/2,ok.cy,Math.max(0,(f-200)/60),C.green);
    if(f>240) drawEdge(ai.cx+ai.w/2,ai.cy,fb.cx-fb.w/2,fb.cy,Math.max(0,(f-240)/60),C.orange);
    if(f>280) drawEdge(fb.cx+fb.w/2,fb.cy,l2.cx-l2.w/2,l2.cy,prog4,C.orange);

    if(f>30 && f<200) drawBubble(emp.cx,emp.cy-30,'VPN не\nподключается',110,'right');
    if(f>120 && f<280) drawBubble(ai.cx,ai.cy-40,'1. Проверьте клиент\n2. Сертификат\n3. Сеть Wi‑Fi',130,'right');
    if(f>260 && f<380){
      rr(fb.x+8,fb.y+fb.h-14,fb.w-16,10,4,C.orangeL,null,0);
      ctx.fillStyle=C.orange; ctx.font='bold 9px Inter,sans-serif'; ctx.textAlign='center';
      ctx.fillText('Нет → тикет', fb.cx, fb.y+fb.h-6);
    }
    if(f>360) drawTicket(l2.x+8,l2.y+8,Math.min(1,(f-360)/40));

    if(f>100 && f<220) drawNode(NODES[2],1,true);
    if(f>340) drawNode(NODES[5],1,true);

    ctx.fillStyle=C.muted; ctx.font='10px Inter,sans-serif'; ctx.textAlign='left';
    ctx.fillText('Демо-сценарий · ai helpdesk it', 14, H-12);

    frame++;
    requestAnimationFrame(draw);
  }
  draw();
})();
</script>
      </div>
      <!-- /boris-helpdesk-viz -->

      <div class="ithp-grid-3 nero-ai-reveal" style="margin-top:32px;">
        <div class="ithp-card">
          <h3>Автоответы (пароль, VPN, доступы)</h3>
          <p>Интент → KB → пошаговый ответ. Для пароля/VPN — полуавтомат с approval (human-in-the-loop, как в кейсе Деснол).</p>
        </div>
        <div class="ithp-card">
          <h3>Создание и классификация тикетов</h3>
          <p>Jira SM, GLPI, 1С:ITILIUM, Zendesk — категория, приоритет, история чата. Ошибки классификации: ~30% → ~5% (SimpleOne/ITG).</p>
        </div>
        <div class="ithp-card">
          <h3>Эскалация к инженеру</h3>
          <p>Не провал, а регламент: порог уверенности, критичные системы, запрет автодействий с ПДн. Контекст: что пробовали, какие статьи показывал AI.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §4 #scenarii -->
  <section class="ithp-section ithp-section-alt" id="scenarii">
    <div class="ithp-cnt">
      <div class="ithp-sh">
        <span class="ithp-eyebrow">Сценарии L1</span>
        <h2>Что автоматизирует AI-агент: ключевые сценарии IT support</h2>
      </div>
      <div class="ithp-grid-3 nero-ai-reveal">
        <div class="ithp-scenario">
          <h3>Сброс пароля, VPN, доступы</h3>
          <p>Диагностика блокировки, MFA, чек-лист VPN, маршрутизация доступа. <strong>60–80%</strong> автономного закрытия при зрелой KB.</p>
        </div>
        <div class="ithp-scenario">
          <h3>ПО, принтеры, оборудование</h3>
          <p>Каталог ПО, типовые шаги принтера, заявка на расходники. <strong>35–55%</strong> для периферии.</p>
        </div>
        <div class="ithp-scenario">
          <h3>База знаний и FAQ</h3>
          <p>AI делает KB доступной: находит фрагмент, адаптирует формулировку. Закрытые тикеты → черновики статей с модерацией IT.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §5 #integracii -->
  <section class="ithp-section" id="integracii">
    <div class="ithp-cnt">
      <div class="ithp-sh ithp-left">
        <span class="ithp-eyebrow">ITSM и KB</span>
        <h2>Интеграции AI IT-поддержки с service desk и CRM</h2>
        <p>Агент — слой поверх ITSM, не замена. <strong>Интеграция ai it поддержки сотрудников</strong> с ESM/HR-CRM, не внешней продажной CRM.</p>
      </div>
      <div class="ithp-table-wrap nero-ai-reveal">
        <table class="ithp-table">
          <thead><tr><th>Размер</th><th>ITSM</th><th>KB</th><th>Каналы</th></tr></thead>
          <tbody>
            <tr><td>Малый (до 100)</td><td>GLPI / почта</td><td>Notion / Google Docs</td><td>Telegram, виджет</td></tr>
            <tr><td>Средний (100–1000)</td><td>Jira SM / 1С:ITILIUM</td><td>Confluence / SharePoint</td><td>Teams, Telegram</td></tr>
            <tr><td>Крупный (1000+)</td><td>ServiceNow / SimpleOne</td><td>Enterprise KB + CMDB</td><td>Teams, Slack, email</td></tr>
          </tbody>
        </table>
      </div>
      <div class="ithp-card nero-ai-reveal" style="margin-top:20px;">
        <p>Заявки из CRM и ESM часто пересекаются с IT: для продажного контура см. <a href="<?php echo esc_url(home_url('/vnedrenie-ai-amocrm/')); ?>" class="ym-link ym-link--accent">AI-агент для amoCRM: внедрение и настройка под ключ</a>.</p>
        <p>Для учётного контура и ERP — отдельный сценарий <a href="<?php echo esc_url(home_url('/ai-1c-erp/')); ?>" class="ym-link ym-link--accent">AI-агент для 1С и ERP</a> с теми же RAG и actions через API.</p>
        <h3>Стек LLM для РФ</h3>
        <p>YandexGPT, GigaChat, Ollama; гибрид с OpenAI/Claude для неконфиденциальных сценариев. Оркестрация — Make, n8n, MCP. <strong>152-ФЗ:</strong> ПДн и доступы — закрытый контур, RBAC, логирование.</p>
      </div>
    </div>
  </section>

  <!-- §6 #komu-nuzhno -->
  <section class="ithp-section ithp-section-alt" id="komu-nuzhno">
    <div class="ithp-cnt">
      <div class="ithp-sh">
        <span class="ithp-eyebrow">Целевая аудитория</span>
        <h2>Кому нужна AI IT-поддержка сотрудников</h2>
      </div>
      <div class="ithp-grid-2 nero-ai-reveal">
        <div class="ithp-card">
          <h3>Средние компании и распределённые команды</h3>
          <p>Штат от ~100 человек, IT 2–5 инженеров, удалёнка, всплески при онбординге. Единый канал Teams/Telegram вместо «найди дежурного».</p>
        </div>
        <div class="ithp-card">
          <h3>IT с высокой долей L1</h3>
          <p>Если &gt;50% тикетов — «пароль, VPN, принтер», эффект в первый квартал. При 80% уникальных L2/L3 — начать с копилота для инженеров (Landev AI: −29%).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §7 #etapy -->
  <section class="ithp-section" id="etapy">
    <div class="ithp-cnt">
      <div class="ithp-sh ithp-left">
        <span class="ithp-eyebrow">Внедрение под ключ</span>
        <h2>Как проходит внедрение AI в бизнес-процессы IT support</h2>
        <p><strong>Внедрение ai агентов</strong> и <strong>внедрение ai в бизнес процессы</strong> — поэтапный проект с фиксированным результатом.</p>
      </div>
      <div class="ithp-timeline nero-ai-reveal">
        <div class="ithp-tl-item"><span class="ithp-tl-dot"></span><h3>Фаза 0 — аудит (3–5 дней)</h3><p>200–500 тикетов → топ-15 категорий → матрица автоматизации. Лид-магнит «Список IT-заявок».</p></div>
        <div class="ithp-tl-item"><span class="ithp-tl-dot"></span><h3>MVP (3–4 недели)</h3><p>RAG-бот в Telegram/виджете; 30–50 статей KB; 5 сценариев: пароль, VPN, принтер, доступ к ПО, статус.</p></div>
        <div class="ithp-tl-item"><span class="ithp-tl-dot"></span><h3>Actions (2–3 недели)</h3><p>AD/LDAP, каталог ПО, маршрутизация по группам.</p></div>
        <div class="ithp-tl-item"><span class="ithp-tl-dot"></span><h3>Расширение + аналитика</h3><p>Ещё 10–15 категорий; dashboard deflection, FRT, CSAT. Полный цикл: <strong>4–8 недель</strong>.</p></div>
      </div>
      <div class="ithp-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Внедрение без программиста</h3>
        <p><strong>Ai it поддержка сотрудников без программиста</strong> — реалистично при GLPI/Jira + Make/n8n + Telegram + YandexGPT. Legacy/CMDB — зона Nero Network.</p>
      </div>

      <!-- CTA №2 от Артура -->
      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie-it">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта helpdesk?</p>
          <p class="ym-cta-block__sub">Перед пилотом полезно разобраться в RAG, n8n/Make, human-in-the-loop и интеграции с GLPI/Jira — это ускоряет согласование с IT и ИБ. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- §8 #keisy -->
  <section class="ithp-section ithp-section-alt" id="keisy">
    <div class="ithp-cnt">
      <div class="ithp-sh">
        <span class="ithp-eyebrow">ROI и кейсы</span>
        <h2>Кейсы и примеры внедрения AI IT-поддержки</h2>
      </div>
      <div class="ithp-table-wrap nero-ai-reveal">
        <table class="ithp-table">
          <thead><tr><th>Метрика</th><th>Что измеряет</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td>Deflection rate</td><td>Без тикета к человеку</td><td>~22% год 1; зрелые 40–60%</td></tr>
            <tr><td>FRT</td><td>Время первого ответа</td><td>Часы → секунды</td></tr>
            <tr><td>% L1 без человека</td><td>Автономное закрытие</td><td>До 80% (пароль/VPN)</td></tr>
          </tbody>
        </table>
      </div>
      <div class="ithp-grid-3 nero-ai-reveal" style="margin-top:24px;">
        <div class="ithp-card"><h3>Деснол / 1С:ITILIUM</h3><p>−80% рутины L1, ×4 скорость, ИИ в 80% обращений.</p></div>
        <div class="ithp-card"><h3>SimpleOne / ITG</h3><p>~95% информационных запросов автоматически.</p></div>
        <div class="ithp-card"><h3>IBM AskIT</h3><p>86% запросов без человека, CSAT 91,6% — ориентир масштаба.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;text-align:center;font-size:13px;color:var(--ithp-muted);">Через 3 месяца пилота: deflection 20–35%, FRT &lt; 1 мин, −25% «шумных» L1-тикетов.</p>
    </div>
  </section>

  <!-- §9 #ceny -->
  <section class="ithp-section" id="ceny">
    <div class="ithp-cnt">
      <div class="ithp-sh">
        <span class="ithp-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI IT-поддержка сотрудников</h2>
      </div>
      <div class="ithp-table-wrap nero-ai-reveal">
        <table class="ithp-table">
          <thead><tr><th>Пакет</th><th>Состав</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td><strong>Пилот</strong></td><td>Аудит + MVP, 5 сценариев, 30–50 статей KB</td><td>от 200 тыс. ₽</td></tr>
            <tr><td><strong>Стандарт</strong></td><td>+ ITSM, 10–15 сценариев, аналитика</td><td>350–500 тыс. ₽</td></tr>
            <tr><td><strong>Расширенный</strong></td><td>+ AD/actions, несколько каналов, 152-ФЗ</td><td>до 650 тыс. ₽</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:16px;text-align:center;">OPEX на LLM: 1–5 тыс. ₽/мес. Окупаемость при снятии 30–40% L1 — часто 6–12 месяцев.</p>
    </div>
  </section>

  <!-- §10 #sravnenie -->
  <section class="ithp-section ithp-section-alt" id="sravnenie">
    <div class="ithp-cnt">
      <div class="ithp-sh ithp-left">
        <span class="ithp-eyebrow">Сравнение</span>
        <h2>AI helpdesk vs классический IT support и простой чат-бот</h2>
      </div>
      <div class="ithp-table-wrap nero-ai-reveal">
        <table class="ithp-table">
          <thead><tr><th>Риск</th><th>Митигация</th></tr></thead>
          <tbody>
            <tr><td>Галлюцинации</td><td>RAG только из ваших документов; порог уверенности</td></tr>
            <tr><td>Утечка данных</td><td>On-prem / российские LLM; маскирование ПДн</td></tr>
            <tr><td>Неправильный доступ</td><td>RBAC; approval на привилегированные действия</td></tr>
            <tr><td>Недоверие (36% перепроверяют ИИ)</td><td>Human-in-the-loop, прозрачная эскалация</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- §11 #faq -->
  <section class="ithp-section" id="faq">
    <div class="ithp-cnt">
      <div class="ithp-sh">
        <span class="ithp-eyebrow">FAQ</span>
        <h2>FAQ: частые вопросы об AI IT-поддержке сотрудников</h2>
      </div>
      <div class="ithp-faq nero-ai-reveal" id="ithp-faq-accordion">
        <div class="ithp-faq-item"><div class="ithp-faq-q">Как внедрить AI IT-поддержку в компании?</div><div class="ithp-faq-a"><p>Аудит 200–500 тикетов → 5–10 пилотных категорий → KB от 30 статей → MVP за 3–4 недели → измерить deflection и расширять.</p></div></div>
        <div class="ithp-faq-item"><div class="ithp-faq-q">Сколько стоит внедрение?</div><div class="ithp-faq-a"><p>Ориентир <strong>200–650 тыс. ₽</strong> под ключ + OPEX 1–5 тыс. ₽/мес. Точная смета — после аудита.</p></div></div>
        <div class="ithp-faq-item"><div class="ithp-faq-q">Подходит ли для малого бизнеса?</div><div class="ithp-faq-a"><p>Да, если IT на аутсорсе или 1–2 инженера. Минимум: Telegram + GLPI + RAG по Notion.</p></div></div>
        <div class="ithp-faq-item"><div class="ithp-faq-q">Можно ли внедрить без программиста?</div><div class="ithp-faq-a"><p>Да, для стандартных коннекторов. Legacy — доработка на стороне Nero Network.</p></div></div>
        <div class="ithp-faq-item"><div class="ithp-faq-q">Какие интеграции поддерживаются?</div><div class="ithp-faq-a"><p>Jira SM, GLPI, OTRS, 1С:ITILIUM, SimpleOne, Zendesk; KB — Confluence, SharePoint; AD; Telegram, Teams, Slack.</p></div></div>
        <div class="ithp-faq-item"><div class="ithp-faq-q">Сколько статей нужно в KB?</div><div class="ithp-faq-a"><p>Минимум 30–50 для пилота, 100+ для deflection 40%+.</p></div></div>
        <div class="ithp-faq-item"><div class="ithp-faq-q">Что если нет ITSM?</div><div class="ithp-faq-a"><p>Почта/таблица или лёгкий GLPI; агент создаёт заявки в доступной системе.</p></div></div>
        <div class="ithp-faq-item"><div class="ithp-faq-q">Как быстро окупается?</div><div class="ithp-faq-a"><p>При снятии 30–40% L1 и пилоте от 200 тыс. ₽ — часто 6–12 месяцев.</p></div></div>
      </div>
    </div>
  </section>

  <!-- §12 #cta -->
  <section class="ithp-section ithp-section-alt" id="cta">
    <div class="ithp-cnt">
      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal">
        <p class="ym-cta-block__headline">Снизить нагрузку IT: следующий шаг</p>
        <p class="ym-cta-block__sub">Nero Network — <strong>разработка и внедрение ai it поддержки сотрудников под ключ</strong>: аудит → MVP → интеграции → аналитика. Бесплатный аудит 200 тикетов, лид-магнит «Список IT-заявок для автоматизации», смета 200–650 тыс. ₽ за 4–8 недель.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </section>

</div><!-- /.ithp-content -->

<script>
(function(){
  var acc=document.getElementById('ithp-faq-accordion');
  if(!acc)return;
  acc.querySelectorAll('.ithp-faq-q').forEach(function(q){
    q.addEventListener('click',function(){q.parentElement.classList.toggle('open');});
  });
})();
</script>

<?php
$ithp_page_url = trailingslashit( get_permalink() );
$ithp_site_url = trailingslashit( home_url( '/' ) );
$ithp_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$ithp_h1       = 'AI-агент внутренней IT-поддержки: внедрение под ключ';
$ithp_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $ithp_site_url . '#organization',
      'name'  => $ithp_brand,
      'url'   => $ithp_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $ithp_site_url . '#website',
      'url'       => $ithp_site_url,
      'name'      => $ithp_brand,
      'publisher' => [ '@id' => $ithp_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $ithp_page_url . '#webpage',
      'url'         => $ithp_page_url,
      'name'        => $ithp_h1,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $ithp_site_url . '#website' ],
      'about'       => [ '@id' => $ithp_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $ithp_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $ithp_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $ithp_h1, 'item' => $ithp_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $ithp_page_url . '#service',
      'name'        => $ithp_h1,
      'description' => $page_seo_description,
      'url'         => $ithp_page_url,
      'provider'    => [ '@id' => $ithp_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $ithp_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить AI IT-поддержку в компании?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит 200–500 тикетов → 5–10 пилотных категорий → KB от 30 статей → MVP за 3–4 недели → измерить deflection и расширять.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит внедрение?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир 200–650 тыс. ₽ под ключ + OPEX 1–5 тыс. ₽/мес. Точная смета — после аудита.' ] ],
        [ '@type' => 'Question', 'name' => 'Подходит ли для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, если IT на аутсорсе или 1–2 инженера. Минимум: Telegram + GLPI + RAG по Notion.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли внедрить без программиста?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, для стандартных коннекторов. Legacy — доработка на стороне Nero Network.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие интеграции поддерживаются?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Jira SM, GLPI, OTRS, 1С:ITILIUM, SimpleOne, Zendesk; KB — Confluence, SharePoint; AD; Telegram, Teams, Slack.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько статей нужно в KB?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Минимум 30–50 для пилота, 100+ для deflection 40%+.' ] ],
        [ '@type' => 'Question', 'name' => 'Что если нет ITSM?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Почта/таблица или лёгкий GLPI; агент создаёт заявки в доступной системе.' ] ],
        [ '@type' => 'Question', 'name' => 'Как быстро окупается?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'При снятии 30–40% L1 и пилоте от 200 тыс. ₽ — часто 6–12 месяцев.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $ithp_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

  <p class="nero-ai-reveal" style="margin:28px auto 0;width:min(1220px,calc(100% - 40px));font-size:14.5px;color:#9aa8bd;text-align:center;line-height:1.65;">Когда канал заявок — почта, а не чат: <a href="<?php echo esc_url(home_url('/vnedrenie-ai-obrabotka-email-crm/')); ?>" class="ym-link ym-link--accent">AI-обработка входящей почты в CRM</a> — соседний сценарий с маршрутизацией и тикетами.</p>

</main>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ithp-page') || document.querySelector('.ithp-content');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if (e.isIntersecting) { e.target.classList.add('nero-ai-active'); io.unobserve(e.target); }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    items.forEach(function(el){ io.observe(el); });
  } else {
    items.forEach(function(el){ el.classList.add('nero-ai-active'); });
  }
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

<?php
/**
 * Template Name: AI-агент для заявок с Авито, Циан и классифайдов: внедрение под ключ
 * Slug: ai-zayavki-avito-cian-klassifaidy
 */

declare(strict_types=1);

$page_seo_title       = 'AI-агент для заявок с Авито, Циан: внедрение под ключ';
$page_seo_description = 'Внедряем AI-агента для заявок с Авито, Циан и классифайдов: единая воронка лидов, диалог с клиентом, сделка в CRM без потерь в мессенджерах. Кейсы, цены, аудит.';

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
    ['label' => 'CRM',          'href' => '#integraciya-crm'],
    ['label' => 'Внедрение',    'href' => '#etapy'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать заявки в одну воронку';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение по AI-автоматизации';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: home_url('/#services');

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

.azak-hero-klassifaidy {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.azak-content{
  --azak-bg:#050711;--azak-bg2:#080b17;
  --azak-text:#e6edf7;--azak-muted:#9aa8bd;--azak-soft:#c7d2e5;--azak-heading:#fff;
  --azak-border:rgba(255,255,255,.10);
  --azak-primary:#79f2ff;--azak-violet:#8b5cf6;--azak-green:#22c55e;
  --azak-avito:#00aaff;--azak-cian:#0468ff;--azak-youla:#ff4081;
  --azak-btn-from:#2563eb;--azak-btn-to:#7c3aed;
  --azak-container:1220px;--azak-r:18px;--azak-r-lg:24px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--azak-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.azak-content *,.azak-content *::before,.azak-content *::after{box-sizing:border-box;}
.azak-content a{color:inherit;}
.azak-content p{color:var(--azak-muted);line-height:1.72;margin:0 0 1em;text-align:left!important;}
.azak-content p:last-child{margin-bottom:0;}
.azak-content h2,.azak-content h3,.azak-content h4{color:var(--azak-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.azak-content strong{color:var(--azak-soft);}
.azak-content ul,.azak-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.azak-content ul li,.azak-content ol li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--azak-muted);font-size:14.5px;line-height:1.65;text-align:left!important;}
.azak-content ul li::before{content:'›';position:absolute;left:0;color:var(--azak-primary);font-weight:700;}
.azak-content ol{counter-reset:azak-ol;}
.azak-content ol li{counter-increment:azak-ol;padding-left:28px;}
.azak-content ol li::before{content:counter(azak-ol) '.';position:absolute;left:0;color:var(--azak-primary);font-weight:700;}
.azak-cnt{width:min(var(--azak-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.azak-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.azak-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.azak-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.azak-sh.azak-left{margin-left:0;text-align:left;}
.azak-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.azak-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;text-align:left!important;}
.azak-sh.azak-left p{margin-left:0;}
.azak-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--azak-primary);margin-bottom:14px;}
.azak-gt{background:linear-gradient(92deg,#fff 0%,var(--azak-primary) 44%,var(--azak-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.azak-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.azak-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.azak-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.azak-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--azak-primary),var(--azak-violet));}
.azak-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--azak-muted);margin-bottom:1em;}
.azak-intro-text p:last-child{margin-bottom:0;color:var(--azak-soft);}
.azak-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.azak-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.azak-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--azak-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.azak-kpi-card .kl{font-size:11px;font-weight:600;color:var(--azak-muted);line-height:1.4;}
.azak-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.azak-intro-grid{grid-template-columns:1fr;gap:36px;}.azak-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.azak-intro-kpi{grid-template-columns:1fr 1fr;}}
.azak-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.azak-toc,.ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.azak-toc a,.ym-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid var(--azak-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--azak-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.azak-toc a:hover,.ym-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--azak-primary);background:rgba(121,242,255,.08);}
.azak-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--azak-border);border-radius:var(--azak-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);}
.azak-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.azak-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.azak-grid-2,.azak-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.azak-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.azak-grid-3{grid-template-columns:1fr;}}
.azak-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--azak-r);padding:26px;margin-bottom:14px;}
.azak-scenario:last-child{margin-bottom:0;}
.azak-scenario h3{font-size:17px;margin-bottom:8px;}
.azak-scenario p{font-size:14.5px;margin:0 0 .6em;text-align:left!important;}
.azak-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.azak-table{width:100%;border-collapse:collapse;font-size:14px;}
.azak-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--azak-primary);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.azak-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--azak-text);vertical-align:top;text-align:left!important;}
.azak-table tr:last-child td{border-bottom:none;}
.azak-table tr:hover td{background:rgba(255,255,255,.03);}
.azak-code{background:rgba(0,0,0,.35);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:16px 18px;font-family:ui-monospace,monospace;font-size:13px;color:var(--azak-soft);overflow-x:auto;margin:20px 0;text-align:left!important;}
.azak-timeline{position:relative;padding-left:40px;}
.azak-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--azak-primary),var(--azak-violet));opacity:.35;border-radius:2px;}
.azak-tl-item{position:relative;margin-bottom:32px;}
.azak-tl-item:last-child{margin-bottom:0;}
.azak-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--azak-primary);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.azak-tl-item h3{font-size:17px;margin-bottom:8px;}
.azak-tl-item p{font-size:14.5px;margin:0;text-align:left!important;}
.azak-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.azak-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.azak-case-grid{grid-template-columns:1fr;}}
.azak-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.azak-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--azak-green);margin-bottom:10px;}
.azak-case-card h3{font-size:16px;margin-bottom:14px;}
.azak-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.azak-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.azak-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--azak-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;text-align:left!important;}
.azak-faq-q::after{content:'▾';font-size:13px;color:var(--azak-primary);flex-shrink:0;transition:transform .25s;}
.azak-faq-item.open .azak-faq-q::after{transform:rotate(180deg);}
.azak-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--azak-muted);line-height:1.72;text-align:left!important;}
.azak-faq-item.open .azak-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--azak-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;text-align:left!important;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--azak-btn-from),var(--azak-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--azak-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--azak-primary)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-zayavki-avito-cian-klassifaidy-page" role="main" tabindex="-1">

<section class="nero-ai-hero azak-hero-klassifaidy" id="azak-hero-klassifaidy" aria-labelledby="azak-hero-title">
<style>
/* === AZAK HERO — self-contained .nero-ai-home-page hero block === */
.azak-hero-klassifaidy {
  --azak-bg: #060812;
  --azak-text: #e6edf7;
  --azak-muted: #9aa8bd;
  --azak-soft: #c7d2e5;
  --azak-heading: #ffffff;
  --azak-primary: #79f2ff;
  --azak-violet: #8b5cf6;
  --azak-green: #22c55e;
  --azak-avito: #00aaff;
  --azak-cian: #0468ff;
  --azak-youla: #ff4081;
  --azak-container: 1220px;
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  color: var(--azak-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  background:
    radial-gradient(circle at 12% 7%, rgba(121, 242, 255, 0.18), transparent 28rem),
    radial-gradient(circle at 86% 12%, rgba(139, 92, 246, 0.22), transparent 34rem),
    radial-gradient(circle at 60% 90%, rgba(34, 197, 94, 0.08), transparent 35rem),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
  overflow: hidden;
}
.azak-hero-klassifaidy::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 45% 30%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: 0;
}
.azak-hero-klassifaidy *,
.azak-hero-klassifaidy *::before,
.azak-hero-klassifaidy *::after { box-sizing: border-box; }
.azak-hero-klassifaidy .nero-ai-container {
  width: min(var(--azak-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.azak-hero-klassifaidy .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.azak-hero-klassifaidy .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--azak-primary) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.azak-hero-klassifaidy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 6.2vw, 82px);
  line-height: .92;
  letter-spacing: -0.065em;
  color: var(--azak-heading);
}
.azak-hero-klassifaidy .nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, var(--azak-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.azak-hero-klassifaidy .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--azak-soft) !important;
  font-size: clamp(17px, 2vw, 21px);
  line-height: 1.58;
}
.azak-hero-klassifaidy .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.azak-hero-klassifaidy .nero-ai-badge {
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
  white-space: nowrap;
}
.azak-hero-klassifaidy .nero-ai-badge--avito { border-color: rgba(0,170,255,.35); background: rgba(0,170,255,.1); }
.azak-hero-klassifaidy .nero-ai-badge--cian { border-color: rgba(4,104,255,.35); background: rgba(4,104,255,.1); }
.azak-hero-klassifaidy .nero-ai-badge--youla { border-color: rgba(255,64,129,.35); background: rgba(255,64,129,.1); }
.azak-hero-klassifaidy .azak-chip-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  flex-shrink: 0;
}
.azak-hero-klassifaidy .nero-ai-badge--avito .azak-chip-dot { background: var(--azak-avito); }
.azak-hero-klassifaidy .nero-ai-badge--cian .azak-chip-dot { background: var(--azak-cian); }
.azak-hero-klassifaidy .nero-ai-badge--youla .azak-chip-dot { background: var(--azak-youla); }
.azak-hero-klassifaidy .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.azak-hero-klassifaidy .nero-ai-btn {
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
.azak-hero-klassifaidy .nero-ai-btn:hover { transform: translateY(-2px); }
.azak-hero-klassifaidy .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--azak-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.azak-hero-klassifaidy .nero-ai-btn-secondary {
  color: var(--azak-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.azak-hero-klassifaidy .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.azak-hero-klassifaidy .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.azak-hero-klassifaidy .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.azak-hero-klassifaidy .nero-ai-dots { display: flex; gap: 7px; }
.azak-hero-klassifaidy .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.azak-hero-klassifaidy .nero-ai-dot:nth-child(1) { background: #fb7185; }
.azak-hero-klassifaidy .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.azak-hero-klassifaidy .nero-ai-dot:nth-child(3) { background: #34d399; }
.azak-hero-klassifaidy .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.azak-hero-klassifaidy .nero-ai-window-body { padding: 16px; }
.azak-hero-klassifaidy .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.azak-hero-klassifaidy .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.azak-hero-klassifaidy .nero-ai-live-pill {
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
.azak-hero-klassifaidy .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: azakPulse 1.6s infinite;
}
@keyframes azakPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.azak-hero-klassifaidy .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.azak-hero-klassifaidy .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.azak-hero-klassifaidy .nero-ai-metric span {
  display: block;
  color: var(--azak-muted);
  font-size: 11px;
  font-weight: 700;
}
.azak-hero-klassifaidy .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.azak-hero-klassifaidy .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.azak-hero-klassifaidy .azak-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 40%, rgba(121,242,255,.08), rgba(6,10,24,.9) 70%);
}
.azak-hero-klassifaidy #azak-klassifaidy-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.azak-hero-klassifaidy .nero-ai-task-stream { display: grid; gap: 8px; }
.azak-hero-klassifaidy .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.azak-hero-klassifaidy .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--azak-primary);
  font-size: 11px;
  font-weight: 800;
}
.azak-hero-klassifaidy .nero-ai-task-icon--avito { background: rgba(0,170,255,.15); color: #7dd3fc; }
.azak-hero-klassifaidy .nero-ai-task-icon--cian { background: rgba(4,104,255,.15); color: #93c5fd; }
.azak-hero-klassifaidy .nero-ai-task-icon--youla { background: rgba(255,64,129,.15); color: #f9a8d4; }
.azak-hero-klassifaidy .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.azak-hero-klassifaidy .nero-ai-task span {
  color: var(--azak-muted);
  font-size: 11px;
}
.azak-hero-klassifaidy .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.azak-hero-klassifaidy .nero-ai-status--hot {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .azak-hero-klassifaidy .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .azak-hero-klassifaidy .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .azak-hero-klassifaidy .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .azak-hero-klassifaidy .nero-ai-window-body { padding: 12px; }
  .azak-hero-klassifaidy .nero-ai-task { grid-template-columns: 28px 1fr; }
  .azak-hero-klassifaidy .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow">Классифайды · CRM · AI под ключ</p>
    <h1 id="azak-hero-title">AI-агент для заявок с Авито, Циан и классифайдов: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
    <p class="nero-ai-hero-lead">AI собирает лиды из классифайдов, уточняет потребность и создаёт сделку в CRM — без потерь в мессенджерах</p>
    <ul class="nero-ai-badges" aria-label="Площадки и интеграции">
      <li class="nero-ai-badge nero-ai-badge--avito"><span class="azak-chip-dot" aria-hidden="true"></span>Avito</li>
      <li class="nero-ai-badge nero-ai-badge--cian"><span class="azak-chip-dot" aria-hidden="true"></span>Циан</li>
      <li class="nero-ai-badge nero-ai-badge--youla"><span class="azak-chip-dot" aria-hidden="true"></span>Юла</li>
      <li class="nero-ai-badge">amoCRM</li>
      <li class="nero-ai-badge">Bitrix24</li>
      <li class="nero-ai-badge">Единая воронка</li>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация AI-сбора заявок с классифайдов">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3>Классифайды → единая CRM-воронка</h3>
          <span class="nero-ai-live-pill">онлайн</span>
        </div>
        <div class="nero-ai-metrics-grid">
          <div class="nero-ai-metric">
            <span>Заявок сегодня</span>
            <strong>31</strong>
            <small>Avito · Циан · Юла</small>
          </div>
          <div class="nero-ai-metric">
            <span>Первый ответ AI</span>
            <strong>12 сек</strong>
            <small>speed-to-lead</small>
          </div>
          <div class="nero-ai-metric">
            <span>В CRM без потерь</span>
            <strong>100%</strong>
            <small>webhook → сделка</small>
          </div>
          <div class="nero-ai-metric">
            <span>Горячих лидов</span>
            <strong>8</strong>
            <small>score ≥ 70</small>
          </div>
        </div>

        <div class="azak-dash-canvas-wrap" aria-hidden="false">
          <canvas id="azak-klassifaidy-hero-canvas" role="img" aria-label="Анимация: заявки с Avito, Cian и Youla сливаются через AI в единую CRM-воронку"></canvas>
        </div>

        <div class="nero-ai-task-stream" aria-label="Живой поток заявок">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon nero-ai-task-icon--avito">A</span>
            <div><strong>Чат Avito · 2-к квартира</strong><span>AI уточняет бюджет и срок</span></div>
            <span class="nero-ai-status nero-ai-status--hot">hot</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon nero-ai-task-icon--cian">C</span>
            <div><strong>Циан · показ объекта</strong><span>Сделка #2041 в amoCRM</span></div>
            <span class="nero-ai-status">готово</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon nero-ai-task-icon--youla">Ю</span>
            <div><strong>Юла · услуга мастера</strong><span>Задача менеджеру · SLA 15 мин</span></div>
            <span class="nero-ai-status">новое</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<script>
/**
 * azak-klassifaidy-hero-engine — Диспетчерская «Единая воронка классифайдов»
 * Мир: три потока площадок → AI-квалификация → единая CRM-воронка
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("azak-klassifaidy-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 290) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    avito: "#00aaff",
    cian: "#0468ff",
    youla: "#ff4081",
    crmBase: "#1e293b",
    crmAccent: "#79f2ff",
    crmGreen: "#22c55e",
    aiCore: "#8b5cf6",
    chatBg: "#f1f5f9",
    hot: "#f59e0b",
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

  /* Три параллельных потока чипов площадок — вместо Conveyor */
  function ClassifiedStreamHub() {
    this.wave = 0;
  }
  ClassifiedStreamHub.prototype.draw = function (ctx) {
    this.wave = (frame * 0.035) % (Math.PI * 2);
    var lanes = [
      { color: C.avito, label: "A", yOff: -55, phase: 0 },
      { color: C.cian, label: "C", yOff: -20, phase: 2.1 },
      { color: C.youla, label: "Ю", yOff: 15, phase: 4.2 }
    ];
    lanes.forEach(function (lane, idx) {
      ctx.strokeStyle = lane.color + "44";
      ctx.lineWidth = 2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.5;
      ctx.beginPath();
      ctx.moveTo(-165, lane.yOff);
      ctx.bezierCurveTo(-80, lane.yOff - 8, -20, lane.yOff + 6, 35, -5);
      ctx.stroke();
      ctx.setLineDash([]);

      for (var i = 0; i < 2; i++) {
        var t = ((this.wave + lane.phase + i * Math.PI) % (Math.PI * 2)) / (Math.PI * 2);
        var px = -165 + t * 200;
        var py = lane.yOff + Math.sin(t * Math.PI * 2 + idx) * 4;
        PlatformChip.draw(ctx, px, py, lane.color, lane.label, 12);
      }
    }, this);
  };

  /* Чип площадки — тематический объект */
  var PlatformChip = {
    draw: function (ctx, x, y, color, label, size) {
      ctx.save();
      ctx.translate(x, y);
      drawRR(ctx, -size / 2, -size / 2, size, size, 4, color, C.outline);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.textBaseline = "middle";
      ctx.fillText(label, 0, 1);
      ctx.restore();
    }
  };

  /* AI-узел квалификации — между потоками и воронкой */
  function AiQualifierNode() {
    this.pulse = 0;
  }
  AiQualifierNode.prototype.draw = function (ctx, prg) {
    this.pulse = 0.5 + Math.sin(frame * 0.12) * 0.25;
    var active = prg >= 70 && prg < 140;
    var glow = active ? 0.35 + Math.sin(frame * 0.15) * 0.15 : 0.12;
    ctx.fillStyle = "rgba(139,92,246," + glow + ")";
    ctx.beginPath();
    ctx.arc(35, -5, 22 + this.pulse * 6, 0, Math.PI * 2);
    ctx.fill();
    drawRR(ctx, 18, -18, 34, 26, 8, "#312e81", C.outline);
    ctx.fillStyle = C.aiCore;
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI", 35, -2);

    if (active) {
      ChatBubblePacket.draw(ctx, 55, -28, "Бюджет?");
      ChatBubblePacket.draw(ctx, 62, 8, "Срок?");
      var score = Math.min(100, Math.floor((prg - 70) / 0.7));
      drawRR(ctx, 48, 22, 36, 14, 4, "rgba(245,158,11,0.35)", C.hot);
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText(score + " hot", 66, 32);
    }
  };

  var ChatBubblePacket = {
    draw: function (ctx, x, y, text) {
      ctx.save();
      ctx.translate(x, y);
      drawRR(ctx, -18, -8, 36, 16, 4, C.chatBg, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(text, 0, 2);
      ctx.restore();
    }
  };

  /* Единая CRM-воронка — вместо WebsiteTerminal */
  function CrmUnifiedFunnel() {
    this.dealDrop = 0;
  }
  CrmUnifiedFunnel.prototype.draw = function (ctx, prg) {
    drawRR(ctx, 95, -72, 88, 138, 10, C.crmBase, C.outline);

    ctx.fillStyle = "rgba(121,242,255,0.14)";
    ctx.beginPath();
    ctx.moveTo(108, -58);
    ctx.lineTo(170, -58);
    ctx.lineTo(158, 8);
    ctx.lineTo(120, 8);
    ctx.closePath();
    ctx.fill();
    ctx.strokeStyle = C.crmAccent;
    ctx.lineWidth = 1.5;
    ctx.stroke();

    SourceTagRibbon.draw(ctx, 102, -65);
    ["Новый", "Квал.", "CRM"].forEach(function (s, i) {
      ctx.fillStyle = "rgba(255,255,255,0.6)";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(s, 139, -48 + i * 18);
    });

    if (prg >= 140) {
      var dropPrg = Math.min(1, (prg - 140) / 30);
      var cardY = -15 + dropPrg * 45;
      drawRR(ctx, 112, cardY, 54, 28, 6, "rgba(34,197,94,0.28)", C.crmGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Лид #2041", 139, cardY + 12);
      ctx.font = "6px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("amoCRM", 139, cardY + 22);

      if (prg > 165 && prg < 210) {
        var ring = (prg - 165) / 45;
        ctx.strokeStyle = "rgba(34,197,94," + (0.85 - ring * 0.75) + ")";
        ctx.lineWidth = 2.5;
        ctx.beginPath();
        ctx.arc(139, cardY + 14, 18 + ring * 38, 0, Math.PI * 2);
        ctx.stroke();
      }
      if (prg > 175 && prg < 180) this.dealDrop++;
    }
  };

  var SourceTagRibbon = {
    draw: function (ctx, x, y) {
      var tags = [
        { c: C.avito, t: "Avito" },
        { c: C.cian, t: "Cian" },
        { c: C.youla, t: "Youla" }
      ];
      tags.forEach(function (tag, i) {
        drawRR(ctx, x + i * 28, y, 26, 10, 3, tag.c + "55", tag.c);
        ctx.fillStyle = "#fff";
        ctx.font = "5px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(tag.t, x + 13 + i * 28, y + 7);
      });
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
    var prg = (frame * 0.04) % 220;

    var targetX = 35;
    var targetY = -5 + (this.stepTrig * 0.35);

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
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
    }

    var bob = Math.sin(this.timer * 1.5) * (isMoving ? 2 : 1);
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = isMoving ? Math.sin(this.timer * 6) * 5 : 0;
    var legR = isMoving ? Math.sin(this.timer * 6 + Math.PI) * 5 : 0;
    drawRR(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
    drawRR(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
    drawRR(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
    drawRR(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);
    drawRR(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath(); ctx.arc(0, -28 - bob, 12, 0, Math.PI * 2); ctx.fill();
    ctx.lineWidth = 2; ctx.strokeStyle = C.outline; ctx.stroke();
    ctx.save(); ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(4, -30 - bob, 4, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(-4, -30 - bob, 4, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(5, -30 - bob, 2, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(-3, -30 - bob, 2, 0, Math.PI * 2); ctx.fill();
    ctx.restore();
    if (carryType) drawRR(ctx, -18 * faceDir, -18 - bob, 14, 14, 2, carryType, C.outline);
    ctx.restore();
  };

  var streamHub = new ClassifiedStreamHub();
  var aiNode = new AiQualifierNode();
  var crmFunnel = new CrmUnifiedFunnel();
  var bubbles = [];

  var agents = [
    new Agent(-150, 45, C.agentYellow, "1_architect", 12, ["API Avito OK", "Webhook V3", "Тариф проверен"]),
    new Agent(-120, 75, C.agentGreen, "2_seo", 45, ["UTM: avito", "Источник Циан", "Тег классифайд"]),
    new Agent(-90, 25, C.agentBlue, "3_coder", 78, ["lead.received", "ACK ≤ 2 сек", "JSON нормализован"]),
    new Agent(-60, 55, C.agentPink, "4_designer", 108, ["Контекст объявления", "Диалог по существу", "Не «оставьте телефон»"]),
    new Agent(-30, 35, C.agentPurple, "5_deployer", 148, ["Сделка в CRM", "Задача менеджеру", "Эскалация hot"])
  ];

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, maxLife: life });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    var prg = (frame * 0.04) % 220;

    streamHub.draw(ctx);
    aiNode.draw(ctx, prg);
    crmFunnel.draw(ctx, prg);

    agents.forEach(function (a) { a.draw(ctx); });

    if (prg >= 10 && prg < 10.05) createBubble(-150, 25, "1. Приём с Avito", 220);
    if (prg >= 44 && prg < 44.05) createBubble(-120, 55, "2. Тег источника", 220);
    if (prg >= 76 && prg < 76.05) createBubble(-90, 5, "3. Webhook ACK", 220);
    if (prg >= 106 && prg < 106.05) createBubble(-60, 35, "4. AI-диалог", 220);
    if (prg >= 146 && prg < 146.05) createBubble(-30, 15, "5. Сделка в CRM", 220);

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      drawRR(ctx, bub.x - tw / 2, bub.y - 18, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bub.x, bub.y - 9);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  document.fonts.ready.then(function () { engineloop(); });
});
</script>



<div class="azak-content">

<section class="azak-intro" id="vvedenie">
  <div class="azak-cnt">
    <div class="azak-intro-grid nero-ai-reveal">
      <div class="azak-intro-text">
        <p><strong>Коротко:</strong> Nero Network внедряет task-specific AI-агента, который принимает заявки с Авито, Циан, Юла и других классифайдов, ведёт первичный диалог, квалифицирует лид и создаёт сделку в CRM — без потерь между мессенджерами площадок и вашей воронкой.</p>
        <p>Единая воронка лидов из классифайдов — когда все обращения с Avito, Циан, Юла попадают в одну CRM с едиными правилами маршрутизации, SLA и аналитикой по источникам.</p>
      </div>
      <div class="azak-intro-kpi" aria-label="KPI воронки классифайдов">
        <div class="azak-kpi-card"><div class="kv">12 сек</div><div class="kl">Первый ответ AI</div><div class="ks">speed-to-lead</div></div>
        <div class="azak-kpi-card"><div class="kv">3</div><div class="kl">Площадки в одной CRM</div><div class="ks">Avito · Циан · Юла</div></div>
        <div class="azak-kpi-card"><div class="kv">402</div><div class="kl">Чек-лист Avito API</div><div class="ks">тариф до старта</div></div>
        <div class="azak-kpi-card"><div class="kv">4–6</div><div class="kl">Недель внедрения</div><div class="ks">под ключ</div></div>
      </div>
    </div>
  </div>
</section>

<div class="azak-toc-outer">
  <div class="azak-cnt">
    <nav class="ym-toc azak-toc nero-ai-reveal nero-ai-delay-1" aria-label="Оглавление страницы">
      <a href="#pochemu-teryautsya">Почему теряются</a>
      <a href="#chto-takoe-ai-agent">Что такое AI-агент</a>
      <a href="#kak-rabotaet">Как работает</a>
      <a href="#integraciya-crm">CRM</a>
      <a href="#scenarii-nishi">Ниши</a>
      <a href="#etapy">Внедрение</a>
      <a href="#ceny">Стоимость</a>
      <a href="#keisy">Кейсы</a>
      <a href="#faq">FAQ</a>
    </nav>
  </div>
</div>

<section class="azak-section" id="pochemu-teryautsya">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Проблема</span>
      <h2>Почему заявки с Авито, Циан и других классифайдов теряются</h2>
      <p>Заявки приходят из разных площадок — и уже на этом этапе начинается хаос. Менеджер открывает ЛК Авито, переключается в чат Циан, проверяет Юлу, параллельно отвечает в WhatsApp и Telegram.</p>
    </div>
    <div class="nero-ai-reveal nero-ai-delay-1">
      <p><strong>Определение:</strong> единая воронка лидов из классифайдов — это когда все обращения с Avito, Циан, Юла и смежных площадок попадают в одну CRM-систему с едиными правилами маршрутизации, SLA и аналитикой по источникам.</p>

      <h3>Типичные точки потерь: площадка → мессенджер → CRM</h3>
      <ol>
        <li><strong>Задержка первого ответа.</strong> Клиент написал в чат Авито в 19:00, менеджер увидел утром.</li>
        <li><strong>Ручное копирование.</strong> Сообщение остаётся в мессенджере площадки, сделка в CRM не создаётся.</li>
        <li><strong>«Универсальный диспетчер».</strong> Клиент попадает не к агенту объекта — теряет доверие (кейс АН «Итака»).</li>
        <li><strong>Конкуренция за одного клиента.</strong> Несколько менеджеров видят одно обращение в разных вкладках.</li>
      </ol>
      <p>По данным Циан.Журнал (апрель 2026), в АН «Итака» <strong>в январе 2026 обращений в чатах впервые стало больше, чем звонков</strong>.</p>

      <h3>Карта потерь по источникам лидов</h3>
      <p><strong>Лид-магнит Nero Network:</strong> «Карта потерь по источникам лидов» — чек-лист, который показывает, на каком шаге теряется каждый канал.</p>
      <div class="azak-table-wrap">
        <table class="azak-table">
          <thead><tr><th>Этап</th><th>Где ломается</th><th>Что измерять</th></tr></thead>
          <tbody>
            <tr><td>Площадка → webhook</td><td>Нет API / неверный тариф Avito (402)</td><td>% сообщений без доставки в систему</td></tr>
            <tr><td>Webhook → первый ответ</td><td>Нет AI, менеджер офлайн</td><td>Время первого ответа (мин)</td></tr>
            <tr><td>Диалог → квалификация</td><td>Нет скрипта, «оставьте телефон»</td><td>% лидов без бюджета/срока</td></tr>
            <tr><td>Квалификация → CRM</td><td>Нет интеграции</td><td>% чатов без сделки</td></tr>
            <tr><td>CRM → менеджер</td><td>Нет SLA, нет эскалации</td><td>% лидов без контакта &gt; N часов</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-karta-poter">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте, где теряются заявки с классифайдов</p>
        <p class="ym-cta-block__sub">Бесплатная «Карта потерь по источникам лидов»: покажем, на каком шаге между Авито, Циан, Юла и CRM уходит каждый канал — и что можно автоматизировать уже на аудите.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </aside>
  </div>
</section>

<section class="azak-section azak-section-alt" id="chto-takoe-ai-agent">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Решение</span>
      <h2>Что такое AI-агент для обработки заявок с классифайдов</h2>
      <p><strong>AI заявки Авито</strong> — это не «бот с шаблонными фразами». Речь о программном слое между мессенджерами площадок и CRM.</p>
    </div>
    <div class="nero-ai-reveal nero-ai-delay-1">
      <ul>
        <li>принимает сообщения с Avito, Циан, Юла;</li>
        <li>отвечает по существу вопроса с контекстом объявления;</li>
        <li>задаёт 2–4 уточняющих вопроса (бюджет, срок, регион, формат);</li>
        <li>создаёт/обновляет сделку в amoCRM, Bitrix24 или другой CRM;</li>
        <li>передаёт менеджеру «горячий» лид с саммари, а не сырой чат.</li>
      </ul>

      <h3>Чем AI-менеджер Авито отличается от автоответчика</h3>
      <div class="azak-table-wrap">
        <table class="azak-table">
          <thead><tr><th>Критерий</th><th>Автоответчик</th><th>AI-менеджер Avito</th></tr></thead>
          <tbody>
            <tr><td>Контекст объявления</td><td>Нет</td><td>Да: цена, категория, регион</td></tr>
            <tr><td>Квалификация</td><td>«Оставьте телефон»</td><td>BANT-lite: бюджет, срок, intent</td></tr>
            <tr><td>CRM</td><td>Часто вручную</td><td>Автосоздание сделки + поля</td></tr>
            <tr><td>Скоринг</td><td>Нет</td><td>hot / warm / cold / spam</td></tr>
            <tr><td>Эскалация</td><td>Нет</td><td>Передача человеку по правилам</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Task-specific AI agent для источников трафика (Gartner 2026)</h3>
      <p>Gartner прогнозирует: к концу 2026 года <strong>40% enterprise-приложений</strong> получат task-specific AI agents. Для классифайдов: один агент = один процесс «лид с площадки → квалификация → сделка в CRM».</p>
      <p><strong>Баланс ожиданий:</strong> более 40% agentic AI-проектов могут быть отменены к 2027 — поэтому проектируем агента под конкретную воронку с измеримыми метриками.</p>
    </div>
  </div>
</section>

<section id="ai-zayavki-avito-cian-klassifaidy-boris-block" class="azak-root" aria-label="Анимация: webhook с классифайдов через AI в CRM-сделку">
<style>
/* === БОРИС: prefix azak-, scoped внутри #ai-zayavki-avito-cian-klassifaidy-boris-block === */
#ai-zayavki-avito-cian-klassifaidy-boris-block.azak-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-zayavki-avito-cian-klassifaidy-boris-block .azak-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-zayavki-avito-cian-klassifaidy-boris-block .azak-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0ea5e9;
  margin:0 0 14px;
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0ea5e9;
  border-radius:1px;
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(14,165,233,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0284c7;
  margin-top:1px;
  font-style:normal;
  font-weight:700;
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-zayavki-avito-cian-klassifaidy-boris-block .azak-rgt{
  position:relative;
  background:linear-gradient(160deg,#f0fdf4 0%,#e0f2fe 42%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-zayavki-avito-cian-klassifaidy-boris-block .azak-rgt{min-height:380px;}
}
#azak-lead-funnel-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="azak-cnt">
  <div class="azak-card">

    <div class="azak-lft">
      <span class="azak-ey">Воронка · этап 2</span>
      <h3 class="azak-h3">Webhook → AI → CRM: как лид с Авито и Циан превращается в сделку</h3>
      <ul class="azak-ul">
        <li><span class="azak-ic">1</span>Площадка шлёт webhook — ACK ≤ 2 сек, обработка асинхронно</li>
        <li><span class="azak-ic">2</span>AI отвечает по контексту объявления и задаёт 2–4 вопроса BANT-lite</li>
        <li><span class="azak-ic">3</span>Structured JSON: intent, budget, score — hot / warm / cold / spam</li>
        <li><span class="azak-ic">4</span>Сделка в amoCRM или Bitrix24 с полями ai_summary и источником площадки</li>
      </ul>
      <div class="azak-pills">
        <span class="azak-pl azak-pl-g">Avito · Циан · Юла</span>
        <span class="azak-pl azak-pl-b">ACK &lt; 2 сек</span>
        <span class="azak-pl azak-pl-v">CQL-скоринг</span>
      </div>
      <p class="azak-foot">Дальше разберём каждый шаг архитектуры на площадках →</p>
    </div>

    <div class="azak-rgt">
      <canvas
        id="azak-lead-funnel-canvas"
        aria-label="Анимация: заявки с Авито, Циан и Юла проходят webhook, AI-квалификацию и попадают в CRM-сделку"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('azak-lead-funnel-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
    layoutNodes();
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a',
    avito:'#00a046',
    cian:'#0468ff',
    youla:'#ff5722',
    webhook:'#0ea5e9',
    webhookGlow:'rgba(14,165,233,.28)',
    ai:'#8b5cf6',
    aiGlow:'rgba(139,92,246,.22)',
    crm:'#0369a1',
    hot:'#22c55e',
    warm:'#f59e0b',
    cold:'#94a3b8',
    line:'rgba(14,165,233,.32)',
    bubble:'#ffffff',
    bubbleBdr:'#cbd5e1',
    muted:'#64748b',
    text:'#1e293b',
    funnel:'rgba(14,165,233,.06)'
  };

  var PLATFORMS = [
    {key:'avito', label:'Avito', color:C.avito, x:0, y:0},
    {key:'cian',  label:'Циан',  color:C.cian,  x:0, y:0},
    {key:'youla', label:'Юла',   color:C.youla, x:0, y:0}
  ];

  var webhook = {x:0,y:0,r:0};
  var aiNode  = {x:0,y:0,r:0,pulse:0};
  var crmNode = {x:0,y:0,w:0,h:0};
  var funnelPath = [];

  function layoutNodes(){
    var pad = W * 0.06;
    PLATFORMS[0].x = pad + W*0.08;  PLATFORMS[0].y = H*0.14;
    PLATFORMS[1].x = W*0.5;         PLATFORMS[1].y = H*0.10;
    PLATFORMS[2].x = W - pad - W*0.08; PLATFORMS[2].y = H*0.14;
    webhook.x = W*0.5; webhook.y = H*0.32; webhook.r = Math.min(W,H)*0.055;
    aiNode.x = W*0.5; aiNode.y = H*0.54; aiNode.r = Math.min(W,H)*0.07;
    crmNode.w = W*0.36; crmNode.h = H*0.18;
    crmNode.x = W*0.5 - crmNode.w/2; crmNode.y = H*0.76;
    funnelPath = [
      {x:W*0.5,y:H*0.20},
      {x:W*0.5,y:H*0.32},
      {x:W*0.5,y:H*0.54},
      {x:W*0.5,y:H*0.76}
    ];
  }

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

  function drawFunnelBg(){
    ctx.save();
    ctx.fillStyle = C.funnel;
    ctx.beginPath();
    ctx.moveTo(W*0.18, H*0.18);
    ctx.lineTo(W*0.82, H*0.18);
    ctx.lineTo(W*0.62, H*0.88);
    ctx.lineTo(W*0.38, H*0.88);
    ctx.closePath();
    ctx.fill();
    ctx.restore();
  }

  function drawPlatform(p, pulse){
    var s = Math.min(W,H)*0.038;
    ctx.save();
    ctx.fillStyle = p.color;
    ctx.globalAlpha = 0.12 + pulse*0.08;
    ctx.beginPath();
    ctx.arc(p.x, p.y, s*1.8, 0, Math.PI*2);
    ctx.fill();
    ctx.globalAlpha = 1;
    rr(ctx, p.x - s, p.y - s*0.55, s*2, s*1.1, 6, '#fff', p.color, 2);
    ctx.fillStyle = C.text;
    ctx.font = 'bold ' + Math.max(10, s*0.55) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(p.label, p.x, p.y);
    ctx.restore();
  }

  function drawWebhookNode(t){
    var r = webhook.r;
    var glow = 0.5 + 0.5*Math.sin(t*0.08);
    ctx.save();
    ctx.fillStyle = C.webhookGlow;
    ctx.beginPath();
    ctx.arc(webhook.x, webhook.y, r*(1.6+glow*0.3), 0, Math.PI*2);
    ctx.fill();
    rr(ctx, webhook.x-r, webhook.y-r*0.65, r*2, r*1.3, 8, '#fff', C.webhook, 2);
    ctx.fillStyle = C.webhook;
    ctx.font = 'bold ' + Math.max(9,r*0.38) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('Webhook', webhook.x, webhook.y - r*0.15);
    ctx.font = Math.max(8,r*0.28) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('200 OK', webhook.x, webhook.y + r*0.35);
    ctx.restore();
  }

  function drawAiNode(t){
    var r = aiNode.r;
    var pulse = 0.5 + 0.5*Math.sin(t*0.06);
    ctx.save();
    ctx.fillStyle = C.aiGlow;
    ctx.beginPath();
    ctx.arc(aiNode.x, aiNode.y, r*(1.4+pulse*0.25), 0, Math.PI*2);
    ctx.fill();
    rr(ctx, aiNode.x-r, aiNode.y-r, r*2, r*2, 12, '#fff', C.ai, 2.5);
    ctx.fillStyle = C.ai;
    ctx.font = 'bold ' + Math.max(10,r*0.42) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('AI', aiNode.x, aiNode.y - r*0.12);
    ctx.font = Math.max(8,r*0.28) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('квалификация', aiNode.x, aiNode.y + r*0.32);

    var bubbles = ['Бюджет?','Срок?','Регион?'];
    bubbles.forEach(function(txt,i){
      var bx = aiNode.x + r*1.35*Math.cos(i*1.2 - 0.5 + t*0.02);
      var by = aiNode.y + r*0.9*Math.sin(i*1.4 - 0.3);
      var bw = ctx.measureText(txt).width + 14;
      rr(ctx, bx-bw/2, by-9, bw, 18, 9, C.bubble, C.bubbleBdr, 1);
      ctx.fillStyle = C.text;
      ctx.font = Math.max(8,r*0.26) + 'px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(txt, bx, by+1);
    });
    ctx.restore();
  }

  function drawCrmCard(t, dealAlpha){
    var x = crmNode.x, y = crmNode.y, w = crmNode.w, h = crmNode.h;
    ctx.save();
    ctx.globalAlpha = dealAlpha;
    rr(ctx, x, y, w, h, 10, '#fff', C.crm, 2);
    ctx.fillStyle = C.crm;
    ctx.font = 'bold ' + Math.max(10,w*0.055) + 'px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.textBaseline = 'top';
    ctx.fillText('CRM · сделка', x+12, y+10);
    var fields = [
      {l:'Источник', v:'Avito'},
      {l:'Бюджет', v:'4,2 млн ₽'},
      {l:'Score', v:'hot · 87'}
    ];
    fields.forEach(function(f,i){
      var fy = y + 32 + i*22;
      ctx.fillStyle = C.muted;
      ctx.font = Math.max(8,w*0.038) + 'px system-ui,sans-serif';
      ctx.fillText(f.l, x+12, fy);
      ctx.fillStyle = i===2 ? C.hot : C.text;
      ctx.font = 'bold ' + Math.max(9,w*0.042) + 'px system-ui,sans-serif';
      ctx.fillText(f.v, x+w*0.38, fy);
    });
    var barW = w - 24;
    var prog = 0.65 + 0.35*Math.sin(t*0.04);
    rr(ctx, x+12, y+h-18, barW, 6, 3, '#e2e8f0');
    rr(ctx, x+12, y+h-18, barW*prog, 6, 3, C.hot);
    ctx.restore();
  }

  function drawConnector(from, to, alpha, dash){
    ctx.save();
    ctx.strokeStyle = C.line;
    ctx.globalAlpha = alpha;
    ctx.lineWidth = 2;
    if(dash) ctx.setLineDash([6,5]);
    ctx.beginPath();
    ctx.moveTo(from.x, from.y);
    var midY = (from.y + to.y)/2;
    ctx.bezierCurveTo(from.x, midY, to.x, midY, to.x, to.y);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.restore();
  }

  var packets = [];
  var spawnTimer = 0;
  var crmAlpha = 0;

  function spawnPacket(){
    var src = PLATFORMS[Math.floor(Math.random()*3)];
    var statuses = ['hot','warm','cold'];
    packets.push({
      srcX: src.x, srcY: src.y,
      stage: 0,
      t: 0,
      speed: 0.012 + Math.random()*0.008,
      color: src.color,
      status: statuses[Math.floor(Math.random()*3)],
      x: src.x, y: src.y
    });
  }

  function updatePacket(p){
    p.t += p.speed;
    if(p.stage === 0){
      p.x = p.srcX + (webhook.x - p.srcX)*p.t;
      p.y = p.srcY + (webhook.y - p.srcY)*p.t;
      if(p.t >= 1){ p.stage=1; p.t=0; }
    } else if(p.stage === 1){
      p.x = webhook.x;
      p.y = webhook.y + (aiNode.y - webhook.y)*p.t;
      if(p.t >= 1){ p.stage=2; p.t=0; }
    } else if(p.stage === 2){
      var wobble = Math.sin(frame*0.05)*8;
      p.x = aiNode.x + wobble;
      p.y = aiNode.y + (crmNode.y + crmNode.h*0.3 - aiNode.y)*p.t;
      if(p.t >= 1){ p.stage=3; p.t=0; crmAlpha = Math.min(1, crmAlpha+0.15); }
    } else {
      p.x = crmNode.x + crmNode.w*0.5;
      p.y = crmNode.y + crmNode.h*0.5;
      p.t += 0.02;
      if(p.t > 1) return false;
    }
    return true;
  }

  function drawPacket(p){
    var sc = Math.min(W,H)*0.014;
    var col = p.status==='hot'?C.hot:(p.status==='warm'?C.warm:C.cold);
    ctx.save();
    ctx.fillStyle = p.color;
    ctx.globalAlpha = 0.25;
    ctx.beginPath();
    ctx.arc(p.x, p.y, sc*2.2, 0, Math.PI*2);
    ctx.fill();
    ctx.globalAlpha = 1;
    ctx.fillStyle = col;
    ctx.beginPath();
    ctx.arc(p.x, p.y, sc, 0, Math.PI*2);
    ctx.fill();
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.restore();
  }

  function drawFlowLines(){
    PLATFORMS.forEach(function(p){
      drawConnector({x:p.x,y:p.y+20}, {x:webhook.x,y:webhook.y-webhook.r}, 0.45, true);
    });
    drawConnector({x:webhook.x,y:webhook.y+webhook.r*0.7}, {x:aiNode.x,y:aiNode.y-aiNode.r}, 0.6, false);
    drawConnector({x:aiNode.x,y:aiNode.y+aiNode.r}, {x:crmNode.x+crmNode.w/2,y:crmNode.y}, 0.6, false);
  }

  function drawLegend(){
    var items = [
      {c:C.hot, t:'hot'},
      {c:C.warm, t:'warm'},
      {c:C.cold, t:'cold'}
    ];
    var lx = W*0.04, ly = H*0.92;
    ctx.font = Math.max(9,W*0.022) + 'px system-ui,sans-serif';
    items.forEach(function(it,i){
      var ix = lx + i*52;
      ctx.fillStyle = it.c;
      ctx.beginPath();
      ctx.arc(ix, ly, 5, 0, Math.PI*2);
      ctx.fill();
      ctx.fillStyle = C.muted;
      ctx.textAlign = 'left';
      ctx.textBaseline = 'middle';
      ctx.fillText(it.t, ix+10, ly);
    });
  }

  function loop(){
    frame++;
    ctx.clearRect(0,0,W,H);
    drawFunnelBg();
    drawFlowLines();

    var platPulse = 0.5 + 0.5*Math.sin(frame*0.04);
    PLATFORMS.forEach(function(p){ drawPlatform(p, platPulse); });

    drawWebhookNode(frame);
    drawAiNode(frame);
    drawCrmCard(frame, crmAlpha);

    spawnTimer++;
    if(spawnTimer > 55){ spawnTimer=0; spawnPacket(); }

    packets = packets.filter(function(p){
      var ok = updatePacket(p);
      if(ok) drawPacket(p);
      return ok && p.stage < 3;
    });

    drawLegend();
    requestAnimationFrame(loop);
  }

  loop();
})();
</script>
</section>

<section class="azak-section" id="kak-rabotaet">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Архитектура</span>
      <h2>Как работает AI на Авито, Циан и других площадках</h2>
      <p><strong>AI обработка заявок Авито</strong> и <strong>автоматизация заявок Циан</strong> строятся на одной архитектуре.</p>
    </div>
    <div class="azak-code nero-ai-reveal">Клиент → чат площадки → webhook (&lt; 2 сек ACK) → AI-диалог → CRM-сделка → менеджер</div>

    <h3 class="nero-ai-reveal nero-ai-delay-1">Приём заявки и первичный диалог</h3>
    <ol class="nero-ai-reveal nero-ai-delay-1">
      <li>Клиент пишет в чат по объявлению на Avito, Циан или Юле.</li>
      <li>Площадка отправляет webhook на middleware. Для Avito: ответ <strong>200 OK ≤ 2 секунд</strong>.</li>
      <li>AI отправляет первый ответ <strong>по существу вопроса</strong> — не «оставьте телефон» сразу.</li>
    </ol>

    <h3>Уточнение потребности и квалификация лида</h3>
    <p>AI задаёт 2–4 вопроса по BANT-lite: бюджет, срок, формат, регион. На выходе — structured JSON: intent, budget, timeline, score, status (hot/warm/cold/spam).</p>

    <h3>Создание сделки и задач в CRM</h3>
    <ul>
      <li>создаёт или обновляет сделку с UTM/источником (Avito / Циан / Юла);</li>
      <li>заполняет custom fields: ai_summary, ai_score, platform_chat_url;</li>
      <li>ставит задачу менеджеру при score ≥ threshold;</li>
      <li>эскалирует человеку при негативе, торге, юридически значимых вопросах.</li>
    </ul>
  </div>
</section>

<section class="azak-section azak-section-alt" id="integraciya-crm">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Интеграции</span>
      <h2>Интеграция с CRM: amoCRM, Bitrix24 и другие</h2>
      <p><strong>AI заявки Авито интеграция CRM</strong> — CRM остаётся системой учёта; AI — надстройка.</p>
    </div>

    <h3>Маршрутизация лидов по источнику (Авито / Циан / Юла)</h3>
    <div class="azak-table-wrap nero-ai-reveal">
      <table class="azak-table">
        <thead><tr><th>Площадка</th><th>Доступ к API</th><th>Стоимость API</th><th>Ключевые ограничения</th></tr></thead>
        <tbody>
          <tr><td><strong>Avito</strong></td><td>Тарифы «Базовый», «Расширенный», «Максимальный»</td><td>Платная подписка с API мессенджера</td><td>Без подписки — <strong>402</strong> на read/write</td></tr>
          <tr><td><strong>Циан</strong></td><td>Агентства, риелторы, застройщики</td><td><strong>Бесплатно</strong></td><td>ACCESS KEY в ЛК или import@cian.ru</td></tr>
          <tr><td><strong>Юла</strong></td><td>Только <strong>бизнес-аккаунт</strong></td><td>По договору</td><td>Токен у персонального менеджера Юлы</td></tr>
        </tbody>
      </table>
    </div>

    <h3>Поля сделки, теги и SLA по площадкам</h3>
    <ul class="nero-ai-reveal">
      <li><strong>Источник:</strong> avito / cian / youla / auto_ru / drom</li>
      <li><strong>ID объявления и ссылка на чат площадки</strong></li>
      <li><strong>AI-score</strong> (0–100) и статус hot/warm/cold/spam</li>
      <li><strong>AI-summary</strong> — краткое саммари диалога</li>
      <li><strong>Время первого ответа</strong> — для дашборда «карта потерь»</li>
    </ul>
  </div>
</section>

<section class="azak-section" id="scenarii-nishi">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Ниши</span>
      <h2>Сценарии по нишам: недвижимость, авто, услуги, аренда</h2>
    </div>
    <div class="azak-grid-3">
      <div class="azak-scenario nero-ai-reveal">
        <h3>Агентства недвижимости и застройщики</h3>
        <p><strong>AI агент Циан</strong> — приоритетный канал: бесплатный API, глубокая интеграция чатов. Модель «Итака»: AI обрабатывает типовые запросы, профильный агент подключается к экспертизе по объекту.</p>
      </div>
      <div class="azak-scenario nero-ai-reveal nero-ai-delay-1">
        <h3>Автодилеры и сервисы</h3>
        <p>На Avito и Auto.ru AI квалифицирует: марка/модель, бюджет, trade-in, срок покупки. Кейс «Логема»: <strong>+25% скорость сбора лидов</strong>.</p>
      </div>
      <div class="azak-scenario nero-ai-reveal nero-ai-delay-2">
        <h3>Локальные услуги и мастера</h3>
        <p>Быстрый ответ на «сколько стоит» и «когда можете», сбор адреса и срока, создание сделки в CRM. Кейс «А-Мебель»: единое окно Avito, Юлы и сайта в Bitrix24.</p>
      </div>
    </div>
  </div>
</section>

<section class="azak-section azak-section-alt" id="etapy">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Процесс</span>
      <h2>Внедрение AI заявки Авито под ключ: этапы и сроки</h2>
      <p>Типовой проект: <strong>4–6 недель</strong> с измеримым результатом на каждом этапе.</p>
    </div>
    <div class="azak-timeline nero-ai-reveal">
      <div class="azak-tl-item"><span class="azak-tl-dot"></span><h3>Аудит источников и API площадок</h3><p>Чек-лист Avito (402), Циан ACCESS KEY, Юла бизнес-аккаунт, CRM-схема, 152-ФЗ. Результат — «Карта потерь» и ТЗ.</p></div>
      <div class="azak-tl-item"><span class="azak-tl-dot"></span><h3>Настройка сценариев и интеграции</h3><p>Middleware, коннекторы площадок, AI Orchestrator, CRM Adapter, human handoff, дашборд аналитики.</p></div>
      <div class="azak-tl-item"><span class="azak-tl-dot"></span><h3>AI заявки Авито без программиста vs под ключ</h3>
        <div class="azak-table-wrap">
          <table class="azak-table">
            <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы</th><th>Когда выбирать</th></tr></thead>
            <tbody>
              <tr><td>No-code (Albato, Make)</td><td>Быстрый MVP</td><td>Нет глубокой квалификации</td><td>Тест на Avito</td></tr>
              <tr><td>Агрегатор (Wazzup, i2crm)</td><td>Зеркало чатов в CRM</td><td>Нет AI-слоя</td><td>Только «единое окно»</td></tr>
              <tr><td><strong>Под ключ (Nero Network)</strong></td><td>Avito+Циан+Юла, AI, CRM</td><td>4–6 недель, 150–450 тыс. ₽</td><td>Коммерческая воронка</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации сами?</p>
        <p class="ym-cta-block__sub">Если команда хочет понимать n8n, промпты, webhooks классифайдов и human-in-the-loop до старта проекта — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это помогает быстрее принимать решения на этапе пилота.</p>
      </div>
    </aside>
  </div>
</section>

<section class="azak-section" id="ceny">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">ROI</span>
      <h2>Стоимость, ROI и окупаемость</h2>
    </div>
    <h3>Из чего складывается цена внедрения (ориентир 150–450 тыс. ₽)</h3>
    <div class="azak-table-wrap nero-ai-reveal">
      <table class="azak-table">
        <thead><tr><th>Статья</th><th>Что входит</th></tr></thead>
        <tbody>
          <tr><td>Аудит и ТЗ</td><td>Карта потерь, чек-лист API, схема воронки</td></tr>
          <tr><td>Middleware + коннекторы</td><td>Avito, Циан, Юла, webhook-инфраструктура</td></tr>
          <tr><td>AI-слой</td><td>Промпты, база знаний, скоринг, guardrails</td></tr>
          <tr><td>CRM-интеграция</td><td>Поля, роботы, маршрутизация, SLA</td></tr>
          <tr><td><strong>Отдельно:</strong> тариф Avito с API</td><td>Не входит в стоимость внедрения</td></tr>
        </tbody>
      </table>
    </div>
    <h3>Метрики: скорость ответа, конверсия, доля потерянных лидов</h3>
    <ul>
      <li><strong>Speed-to-lead</strong> — цель: секунды/минуты, не часы.</li>
      <li><strong>Конверсия чат → сделка</strong> — до и после внедрения.</li>
      <li>Ориентиры: «Логема» +25% скорость; «Итака» — чаты обогнали звонки.</li>
    </ul>
  </div>
</section>

<section class="azak-section azak-section-alt" id="keisy">
  <div class="azak-cnt">
    <div class="azak-sh nero-ai-reveal">
      <span class="azak-eyebrow">Кейсы</span>
      <h2>Кейсы и примеры внедрения</h2>
    </div>
    <div class="azak-case-grid">
      <div class="azak-case-card nero-ai-reveal">
        <div class="azak-case-tag">Недвижимость</div>
        <h3>АН «Итака» + Циан API</h3>
        <p>Глубокая интеграция чатов Циан в CRM. В январе 2026 чатов стало больше, чем звонков. Урок: гибрид AI + человек.</p>
      </div>
      <div class="azak-case-card nero-ai-reveal nero-ai-delay-1">
        <div class="azak-case-tag">E-commerce</div>
        <h3>«А-Мебель» — Avito, Юла, сайт → B24</h3>
        <p>Единое окно заявок, автоматическое распределение, передача в 1С. До внедрения — «17 вкладок».</p>
      </div>
      <div class="azak-case-card nero-ai-reveal nero-ai-delay-2">
        <div class="azak-case-tag">B2B услуги</div>
        <h3>«Логема» — Avito + Bitrix24</h3>
        <p>+25% скорость сбора лидов; обработка быстрее на 1 час, взаимодействие — на 2 часа.</p>
      </div>
    </div>
    <p class="nero-ai-reveal" style="margin-top:24px;text-align:left!important;"><em>Примечание:</em> публичных кейсов с AI-агентом на Avito+Циан+CRM одновременно пока мало — опираемся на проверенные интеграционные кейсы + проектную модель Nero Network.</p>
  </div>
</section>

<section class="azak-section" id="faq">
  <div class="azak-cnt">
    <div class="azak-sh nero-ai-reveal">
      <span class="azak-eyebrow">FAQ</span>
      <h2>FAQ: AI для заявок с классифайдов</h2>
    </div>
    <div class="azak-faq nero-ai-reveal">
      <div class="azak-faq-item"><div class="azak-faq-q">Что будет, если на Avito нет платной подписки с API мессенджера?</div><div class="azak-faq-a">Без подписки read/write возвращает <strong>402</strong>. Полноценный AI-агент требует платного тарифа — отдельная строка бюджета до старта.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Можно ли обойтись без программиста?</div><div class="azak-faq-a">Для одного канала и зеркалирования — да (Albato, Make). Для AI под ключ с несколькими площадками — нужна проектная интеграция.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">AI заявки Авито под ключ или самостоятельно?</div><div class="azak-faq-a">Самостоятельно — если тестируете один канал. Под ключ — если нужна единая воронка Avito + Циан + Юла с CRM и картой потерь.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Заменит ли AI менеджера?</div><div class="azak-faq-a">Нет. AI — speed-to-lead и квалификация. Человек — торг, показы, юридические нюансы.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Как подключить Циан?</div><div class="azak-faq-a">ACCESS KEY в ЛК или запрос на import@cian.ru. API бесплатен для агентств и застройщиков.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Нужен ли бизнес-аккаунт на Юле?</div><div class="azak-faq-a">Да. API только для бизнес-аккаунта; токен выдаёт персональный менеджер Юлы.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Заблокируют ли аккаунт за бота?</div><div class="azak-faq-a">При официальном API — нет. Эмуляция браузера — нарушение правил Avito.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Как соблюдается 152-ФЗ?</div><div class="azak-faq-a">YandexGPT или GigaChat для хранения данных в РФ. OpenAI/Claude — через прокси с согласованной политикой ПДн.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Сколько времени занимает внедрение?</div><div class="azak-faq-a">Типовой проект: 4–6 недель — аудит, разработка, пилот и QA.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">У нас только Avito / только Циан — имеет смысл?</div><div class="azak-faq-a">Да. Архитектура модульная: старт с одного канала, подключение остальных без переписывания.</div></div>
    </div>

    <aside class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Собрать заявки в одну воронку</p>
        <p class="ym-cta-block__sub">Nero Network проводит аудит источников лидов и внедряет AI-агента для заявок с Авито, Циан и классифайдов под ключ: от проверки API и тарифов до сделки в CRM и дашборда «карта потерь». Ориентир бюджета — 150–450 тыс. ₽.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
        </div>
      </div>
    </aside>
  </div>
</section>

</div>

</main>

<script>
document.querySelectorAll('.azak-faq-q').forEach(function(q){
  q.addEventListener('click',function(){
    var item=q.closest('.azak-faq-item');
    if(item) item.classList.toggle('open');
  });
});
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

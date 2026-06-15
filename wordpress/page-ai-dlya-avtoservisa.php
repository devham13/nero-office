<?php
/**
 * Template Name: AI-администратор для автосервиса: внедрение и настройка под ключ
 * Description: AI-администратор для автосервиса — звонки, запись в CRM, калькулятор пропущенных. Внедрение под ключ 120–350 тыс. ₽.
 */

$page_seo_title       = 'AI для автосервиса: внедрение администратора под ключ';
$page_seo_description = 'AI-администратор для автосервиса принимает звонки, уточняет услугу и записывает клиентов в CRM. Внедрение под ключ: сценарии, интеграции, кейсы. Калькулятор потерь и ориентир 120–350 тыс. ₽.';

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
    ['label' => 'Почему AI', 'href' => '#pochemu-ai-2026'],
    ['label' => 'Калькулятор', 'href' => '#kalkulyator-propuschennyh'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet-ai-admin'],
    ['label' => 'Функции', 'href' => '#funkcii-ai'],
    ['label' => 'Этапы', 'href' => '#etapy-vnedreniya'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Посчитать потери';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#';

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
/* Kadence layout overrides */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important;}

/* CTA blocks */
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--ava-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--ava-btn-from),var(--ava-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--ava-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--ava-accent)!important;text-decoration:underline!important;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<style>
/* === AVA PAGE — ai-dlya-avtoservisa content root === */
.ava-content{
  --ava-bg:#050711;--ava-bg2:#080b17;
  --ava-surface:rgba(255,255,255,.072);--ava-surface2:rgba(255,255,255,.108);
  --ava-text:#e6edf7;--ava-muted:#9aa8bd;--ava-soft:#c7d2e5;--ava-heading:#fff;
  --ava-border:rgba(255,255,255,.10);--ava-accent:#79f2ff;--ava-violet:#8b5cf6;--ava-green:#22c55e;--ava-red:#f87171;
  --ava-btn-from:#2563eb;--ava-btn-to:#7c3aed;--ava-r:18px;--ava-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--ava-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.ava-content *,.ava-content *::before,.ava-content *::after{box-sizing:border-box}
.ava-content a{color:inherit}
.ava-content p{color:var(--ava-muted);line-height:1.72;margin:0 0 1em}
.ava-content p:last-child{margin-bottom:0}
.ava-content h2,.ava-content h3,.ava-content h4{color:var(--ava-heading);letter-spacing:-.045em;margin:0 0 .7em}
.ava-content strong{color:var(--ava-soft)}
.ava-content ul,.ava-content ol{padding-left:0;list-style:none;margin:0 0 1em}
.ava-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--ava-muted);font-size:14.5px;line-height:1.65}
.ava-content ul li::before{content:'›';position:absolute;left:0;color:var(--ava-accent);font-weight:700}
.ava-cnt{width:min(var(--ava-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.ava-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.ava-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.ava-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.ava-sh.ava-left{margin-left:0;text-align:left}
.ava-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.ava-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.ava-sh.ava-left p{margin-left:0}
.ava-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ava-accent);margin-bottom:14px}
.ava-gt{background:linear-gradient(92deg,#fff 0%,var(--ava-accent) 44%,var(--ava-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.ava-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.ava-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.ava-intro-text{position:relative;padding-left:20px}
.ava-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--ava-accent),var(--ava-violet))}
.ava-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--ava-muted);margin-bottom:1em}
.ava-intro-text p:last-child{margin-bottom:0;color:var(--ava-soft)}
.ava-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.ava-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.ava-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--ava-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.ava-kpi-card .kl{font-size:11px;font-weight:600;color:var(--ava-muted);line-height:1.4}
.ava-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.ava-intro-grid{grid-template-columns:1fr;gap:36px}.ava-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.ava-intro-kpi{grid-template-columns:1fr 1fr}}
.ava-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.ava-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.ava-toc a{display:inline-block;padding:9px 18px;background:var(--ava-surface);border:1px solid var(--ava-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--ava-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.ava-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--ava-accent);background:rgba(121,242,255,.08)}
.ava-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--ava-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.ava-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.ava-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.ava-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.ava-grid-2,.ava-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.ava-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.ava-grid-3{grid-template-columns:1fr}}
.ava-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.ava-table{width:100%;border-collapse:collapse;font-size:14px}
.ava-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--ava-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.ava-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--ava-text);vertical-align:top}
.ava-table tr:last-child td{border-bottom:none}
.ava-table tr:hover td{background:rgba(255,255,255,.03)}
.ava-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.ava-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--ava-accent);border:1px solid rgba(121,242,255,.2)}
.ava-flow .arr{color:var(--ava-muted);font-size:16px;padding:0 4px;background:none;border:none}
.ava-timeline{position:relative;padding-left:40px}
.ava-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--ava-accent),var(--ava-violet));opacity:.35;border-radius:2px}
.ava-tl-item{position:relative;margin-bottom:32px}
.ava-tl-item:last-child{margin-bottom:0}
.ava-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--ava-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.ava-tl-item h3{font-size:17px;margin-bottom:8px}
.ava-tl-item p{font-size:14.5px;margin:0}
.ava-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.ava-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.ava-case-grid{grid-template-columns:1fr}}
.ava-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.ava-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.ava-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ava-green);margin-bottom:10px}
.ava-case-card h3{font-size:16px;margin-bottom:14px}
.ava-short{background:rgba(121,242,255,.06);border-left:3px solid var(--ava-accent);padding:14px 18px;border-radius:0 12px 12px 0;margin:20px 0;font-size:14.5px;color:var(--ava-soft)}
.ava-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.ava-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.ava-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--ava-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.ava-faq-q::after{content:'▾';font-size:13px;color:var(--ava-accent);flex-shrink:0;transition:transform .25s}
.ava-faq-item.open .ava-faq-q::after{transform:rotate(180deg)}
.ava-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--ava-muted);line-height:1.72}
.ava-faq-item.open .ava-faq-a{max-height:800px;padding:0 24px 20px}
/* Калькулятор */
.ava-calc-wrap{background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.06));border:2px solid rgba(121,242,255,.35);border-radius:28px;padding:clamp(28px,4vw,44px);box-shadow:0 20px 60px rgba(0,0,0,.35)}
.ava-calc-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px 32px;margin-bottom:28px}
@media(max-width:700px){.ava-calc-grid{grid-template-columns:1fr}}
.ava-calc-field label{display:block;font-size:13px;font-weight:700;color:var(--ava-soft);margin-bottom:8px}
.ava-calc-field input[type=number],.ava-calc-field input[type=range]{width:100%}
.ava-calc-field input[type=number]{padding:12px 14px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.35);color:#fff;font-size:16px;font-weight:700}
.ava-calc-field input[type=range]{accent-color:var(--ava-accent);margin-top:4px}
.ava-calc-hint{font-size:11.5px;color:#64748b;margin-top:6px}
.ava-calc-result{text-align:center;padding:28px 20px;background:rgba(0,0,0,.3);border-radius:20px;border:1px solid rgba(248,113,113,.35)}
.ava-calc-result .lbl{font-size:13px;color:var(--ava-muted);margin-bottom:8px}
.ava-calc-result .month{font-size:clamp(32px,5vw,52px);font-weight:900;color:var(--ava-red);letter-spacing:-.04em;line-height:1}
.ava-calc-result .year{font-size:15px;color:var(--ava-muted);margin-top:10px}
.ava-calc-compare{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin-top:20px}
.ava-calc-pill{padding:8px 16px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:var(--ava-muted)}
.ava-calc-pill strong{color:var(--ava-accent)}
.ava-calc-cta{margin-top:24px;text-align:center}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlya-avtoservisa-page" role="main" tabindex="-1">

<section class="nero-ai-hero avto-hero-servis" id="hero" aria-labelledby="hero-avtoservis-title">
<style>
/* ── Hero ai-dlya-avtoservisa: самодостаточные стили (без CSS темы) ── */
.avto-hero-servis {
  --avto-amber: #f59e0b;
  --avto-orange: #fb923c;
  --avto-cyan: #38bdf8;
  --avto-green: #22c55e;
  --avto-text: #e6edf7;
  --avto-muted: #9aa8bd;
  --avto-soft: #c7d2e5;
  --avto-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.avto-hero-servis::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.avto-hero-servis::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 680px;
  height: 680px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(245, 158, 11, .13), transparent 66%);
  filter: blur(8px);
  animation: avtoHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes avtoHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.avto-hero-servis .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.avto-hero-servis .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.avto-hero-servis .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.avto-hero-servis .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--avto-amber) 42%, #fde68a 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.avto-hero-servis .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 158, 11, 0.22);
  border-radius: 999px;
  background: rgba(245, 158, 11, 0.08);
  color: var(--avto-amber) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.avto-hero-servis .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--avto-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.avto-hero-servis .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.avto-hero-servis .nero-ai-badge {
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
.avto-hero-servis .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.avto-hero-servis .nero-ai-btn {
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
.avto-hero-servis .nero-ai-btn:hover { transform: translateY(-2px); }
.avto-hero-servis .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--avto-amber), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 158, 11, 0.22);
}
.avto-hero-servis .nero-ai-btn-secondary {
  color: var(--avto-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.avto-hero-servis .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--avto-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.avto-hero-servis .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.avto-hero-servis .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.avto-hero-servis .nero-ai-dots { display: flex; gap: 7px; }
.avto-hero-servis .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.avto-hero-servis .nero-ai-dot:nth-child(1) { background: #fb7185; }
.avto-hero-servis .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.avto-hero-servis .nero-ai-dot:nth-child(3) { background: #34d399; }
.avto-hero-servis .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.avto-hero-servis .nero-ai-window-body { padding: 16px; }
.avto-hero-servis .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.avto-hero-servis .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.avto-hero-servis .nero-ai-live-pill {
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
.avto-hero-servis .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: avtoPulse 1.6s infinite;
}
@keyframes avtoPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.avto-hero-servis .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.avto-hero-servis .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.avto-hero-servis .nero-ai-metric span {
  display: block;
  color: var(--avto-muted);
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
}
.avto-hero-servis .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
  letter-spacing: -0.04em;
}
.avto-hero-servis .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #8fa3be;
  font-size: 11px;
}
.avto-hero-servis .avto-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.08);
  background: linear-gradient(180deg, rgba(15,23,42,.6), rgba(2,6,23,.85));
}
.avto-hero-servis #ai-avtoservisa-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.avto-hero-servis .nero-ai-task-stream {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.avto-hero-servis .nero-ai-task {
  display: grid;
  grid-template-columns: auto 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.07);
  background: rgba(255,255,255,.04);
}
.avto-hero-servis .nero-ai-task-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 34px;
  height: 28px;
  padding: 0 8px;
  border-radius: 8px;
  background: rgba(56,189,248,.12);
  color: #7dd3fc;
  font-size: 10px;
  font-weight: 900;
  letter-spacing: .04em;
}
.avto-hero-servis .nero-ai-task strong {
  display: block;
  color: #eef4ff;
  font-size: 13px;
  line-height: 1.2;
}
.avto-hero-servis .nero-ai-task span {
  display: block;
  color: #8fa3be;
  font-size: 11px;
  line-height: 1.3;
}
.avto-hero-servis .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #86efac;
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .05em;
  white-space: nowrap;
}
.avto-hero-servis .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fcd34d;
}
.avto-hero-servis .nero-ai-dashboard-footnote {
  margin: 10px 0 0;
  color: #64748b;
  font-size: 11px;
  font-style: italic;
  text-align: center;
}
@media (max-width: 1023px) {
  .avto-hero-servis .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .avto-hero-servis .nero-ai-dashboard { transform: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai для автосервиса</p>
      <h1 id="hero-avtoservis-title">AI-администратор для автосервиса: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI принимает звонки, уточняет услугу, записывает клиента и передаёт заявку — пока администратор занят в сервисе</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Звонки 24/7</li>
        <li class="nero-ai-badge">Запись в CRM</li>
        <li class="nero-ai-badge">Голосовой AI</li>
        <li class="nero-ai-badge">Шиномонтаж сезон</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Посчитать потери</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kalkulyator-propuschennyh">Калькулятор</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-администратор автосервиса">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">Автосервис · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-администратор СТО</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Пропущенных</span>
              <strong>18</strong>
              <small>за сегодня</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ожидание</span>
              <strong>1:42</strong>
              <small>среднее</small>
            </div>
            <div class="nero-ai-metric">
              <span>В очереди</span>
              <strong>7</strong>
              <small>звонков</small>
            </div>
            <div class="nero-ai-metric">
              <span>Рутина админа</span>
              <strong>−32%</strong>
              <small>меньше</small>
            </div>
          </div>

          <div class="avto-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ai-avtoservisa-hero-canvas" role="img" aria-label="Анимация: входящие звонки обрабатывает AI-администратор, слот бронируется в CRM автосервиса"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий автосервиса">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CALL</span>
              <div><strong>Входящий: запись на шиномонтаж R17</strong><span>Марка уточняется · слот сб 9:00</span></div>
              <span class="nero-ai-status nero-ai-status--amber">обработка</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Уточнение марки, слот чт 10:00</strong><span>Ориентир 3 500 ₽ · ТО масла</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Заявка в 1С / amoCRM, SMS клиенту</strong><span>Тег ai-admin · напоминание 24 ч</span></div>
              <span class="nero-ai-status">новое</span>
            </div>
          </div>
          <p class="nero-ai-dashboard-footnote">*пример логики AI-администратора · демонстрационные данные</p>
        </div>
      </div>
    </div>
  </div>

<script>
/**
 * ai-avtoservisa-hero-engine — Диспетчерская СТО
 * Мир: входящие звонки по дорожке → AI-пульт приёмной → слот в CRM → SMS
 * Отличие от vibecoding: нет конвейера сайтов; центр — пульт AI-администратора автосервиса
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ai-avtoservisa-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var p = canvas.parentElement;
    if (!p) return;
    canvas.width = p.clientWidth || 640;
    canvas.height = p.clientHeight || 240;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 10;
    scale = cw < 400 ? cw / 420 : Math.min(cw / 560, ch / 240) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#0f172a",
    lane: "#1e293b",
    laneRoll: "#334155",
    desk: "#0f172a",
    screen: "#1e3a5f",
    screenHi: "#38bdf8",
    cal: "#ffffff",
    calSlot: "#dcfce7",
    calSlotHi: "#22c55e",
    phone: "#f8fafc",
    wheel: "#64748b",
    ticket: "#fef3c7",
    sms: "#dbeafe",
    agentY: "#eab308",
    agentG: "#10b981",
    agentB: "#3b82f6",
    agentP: "#ec4899",
    agentV: "#8b5cf6",
    bubble: "#ffffff",
    glow: "rgba(56,189,248,.2)"
  };

  function rr(ctx, x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function drawPhone(ctx, x, y, s, ring) {
    rr(ctx, x - s * 0.35, y - s * 0.5, s * 0.7, s, 5, C.phone, C.outline);
    if (ring > 0) {
      ctx.strokeStyle = "rgba(56,189,248," + (0.15 + ring * 0.25) + ")";
      ctx.lineWidth = 2;
      for (var i = 1; i <= 3; i++) {
        ctx.beginPath();
        ctx.arc(x, y - s * 0.05, s * (0.55 + i * 0.22 + ring * 0.1), 0, Math.PI * 2);
        ctx.stroke();
      }
    }
  }

  function drawWheel(ctx, x, y, r) {
    ctx.strokeStyle = C.wheel;
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(x, y, r, 0, Math.PI * 2);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(x - r, y); ctx.lineTo(x + r, y);
    ctx.moveTo(x, y - r); ctx.lineTo(x, y + r);
    ctx.stroke();
  }

  class CallLane {
    constructor(x, y, w) {
      this.x = x; this.y = y; this.w = w;
    }
    draw(ctx) {
      rr(ctx, this.x, this.y, this.w, 36, 6, C.lane, C.outline);
      var off = (frame * 0.4) % 24;
      ctx.save();
      ctx.beginPath();
      if (ctx.roundRect) ctx.roundRect(this.x + 6, this.y + 6, this.w - 12, 24, 4);
      else ctx.rect(this.x + 6, this.y + 6, this.w - 12, 24);
      ctx.clip();
      ctx.fillStyle = C.laneRoll;
      for (var i = this.x; i < this.x + this.w + 30; i += 24) {
        ctx.fillRect(i - off, this.y + 10, 4, 16);
      }
      ctx.restore();
    }
  }

  class AiReceptionDesk {
    constructor(x, y) {
      this.x = x; this.y = y;
      this.phase = 0;
      this.smsY = 0;
    }
    draw(ctx) {
      this.phase = (frame * 0.06) % 200;
      rr(ctx, this.x - 90, this.y - 20, 180, 120, 10, C.desk, C.outline);

      var sx = this.x - 70, sy = this.y - 8, sw = 140, sh = 88;
      rr(ctx, sx, sy, sw, sh, 6, C.screen, C.outline);
      rr(ctx, sx, sy, sw, 18, [6, 6, 0, 0], "#0c4a6e", C.outline);
      ctx.fillStyle = "#7dd3fc";
      ctx.font = "bold 7px sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("AI-АДМИН · СТО", sx + 8, sy + 12);

      var ring = this.phase < 40 ? Math.sin(frame * 0.2) * 0.5 + 0.5 : 0;
      drawPhone(ctx, sx + 22, sy + 48, 18, ring);

      if (this.phase > 35 && this.phase < 120) {
        ctx.fillStyle = "#e2e8f0";
        ctx.font = "6px sans-serif";
        ctx.fillText("Kia Rio · шиномонтаж R17", sx + 44, sy + 42);
      }
      if (this.phase > 70 && this.phase < 150) {
        rr(ctx, sx + 44, sy + 48, 80, 10, 2, "#fef9c3", C.outline);
        ctx.fillStyle = C.outline;
        ctx.font = "6px sans-serif";
        ctx.fillText("от 3 500 ₽", sx + 48, sy + 56);
      }

      var calX = sx + 44, calY = sy + 62;
      if (this.phase > 100) {
        rr(ctx, calX, calY, 72, 22, 3, C.cal, C.outline);
        for (var d = 0; d < 3; d++) {
          var filled = this.phase > 110 + d * 12;
          rr(ctx, calX + 4 + d * 22, calY + 4, 18, 14, 2, filled ? C.calSlotHi : C.calSlot, C.outline);
        }
      }

      if (this.phase > 165) {
        var prg = (this.phase - 165) / 35;
        this.smsY = Math.min(prg * 30, 30);
        ctx.globalAlpha = Math.min(1, prg * 1.5);
        rr(ctx, sx + 50, sy + 20 - this.smsY, 56, 16, 4, C.sms, C.outline);
        ctx.fillStyle = C.outline;
        ctx.font = "bold 6px sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("SMS ✓ запись", sx + 78, sy + 30 - this.smsY);
        ctx.globalAlpha = 1;
      } else {
        this.smsY = 0;
      }
    }
  }

  class Agent {
    constructor(x, y, color, role, dialogs) {
      this.homeX = x; this.homeY = y;
      this.x = x; this.y = y;
      this.color = color;
      this.role = role;
      this.dialogs = dialogs;
      this.stepTrig = Math.random() * 200;
      this.bubble = null;
      this.bubbleT = 0;
    }
    draw(ctx) {
      var t = (frame + this.stepTrig) % 200;
      var tx = this.homeX, ty = this.homeY;
      if (t > 20 && t < 90) {
        tx = cx - 40 + (this.role.charCodeAt(0) % 5) * 14;
        ty = cy + 20;
      }
      this.x += (tx - this.x) * 0.06;
      this.y += (ty - this.y) * 0.06;

      ctx.fillStyle = this.color;
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(this.x, this.y - 10, 7, 0, Math.PI * 2);
      ctx.fill();
      ctx.stroke();
      rr(ctx, this.x - 6, this.y - 2, 12, 14, 3, this.color, C.outline);

      if (Math.random() < 0.004 && !this.bubble) {
        this.bubble = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
        this.bubbleT = 90;
      }
      if (this.bubble && this.bubbleT > 0) {
        this.bubbleT--;
        var bw = Math.min(110, this.bubble.length * 5.5 + 16);
        rr(ctx, this.x - bw / 2, this.y - 38, bw, 16, 4, C.bubble, C.outline);
        ctx.fillStyle = C.outline;
        ctx.font = "6px sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(this.bubble, this.x, this.y - 27);
        if (this.bubbleT === 0) this.bubble = null;
      }
    }
  }

  var lane = new CallLane(0, 0, 0);
  var desk = new AiReceptionDesk(0, 0);
  var laneItems = [];
  var agents = [];

  function initScene() {
    lane = new CallLane(cx - 120 * scale, cy + 42 * scale, 240 * scale);
    desk = new AiReceptionDesk(cx, cy - 8 * scale);
    agents = [
      new Agent(cx - 100 * scale, cy + 70 * scale, C.agentY, "1_dispatcher", ["Принял звонок", "Ночная линия", "Сезон R17"]),
      new Agent(cx - 55 * scale, cy + 78 * scale, C.agentG, "2_intake", ["Марка Kia", "ТО-2 60к км", "Код ошибки"]),
      new Agent(cx - 10 * scale, cy + 82 * scale, C.agentB, "3_pricing", ["Из прайса", "До осмотра", "Норма-час"]),
      new Agent(cx + 35 * scale, cy + 78 * scale, C.agentP, "4_scheduler", ["Чт 10:00", "Пост №2", "Свободно"]),
      new Agent(cx + 80 * scale, cy + 70 * scale, C.agentV, "5_crm", ["В 1С", "amoCRM", "SMS ушло"])
    ];
    laneItems = [];
  }

  function spawnLaneItem() {
    var types = ["phone", "phone", "wheel", "ticket"];
    var type = types[Math.floor(Math.random() * types.length)];
    laneItems.push({
      x: lane.x - 20,
      y: lane.y + 10,
      type: type,
      speed: 0.8 + Math.random() * 0.5
    });
  }

  function drawLaneItems(ctx) {
    for (var i = laneItems.length - 1; i >= 0; i--) {
      var it = laneItems[i];
      it.x += it.speed;
      if (it.type === "phone") drawPhone(ctx, it.x, it.y + 8, 14, 0);
      else if (it.type === "wheel") drawWheel(ctx, it.x, it.y + 10, 9);
      else rr(ctx, it.x - 10, it.y + 2, 20, 14, 2, C.ticket, C.outline);
      if (it.x > lane.x + lane.w + 30) laneItems.splice(i, 1);
    }
  }

  function engineloop() {
    ctx.clearRect(0, 0, cw, ch);
    var g = ctx.createRadialGradient(cx, cy, 0, cx, cy, cw * 0.55);
    g.addColorStop(0, C.glow);
    g.addColorStop(1, "rgba(2,6,23,0)");
    ctx.fillStyle = g;
    ctx.fillRect(0, 0, cw, ch);

    lane.draw(ctx);
    desk.draw(ctx);
    drawLaneItems(ctx);
    agents.forEach(function (a) { a.draw(ctx); });

    if (frame % 55 === 0) spawnLaneItem();

    if (frame % 140 === 20) {
      var hints = [
        "Звонок → AI",
        "Слот в CRM",
        "Админ в боксе",
        "Шиномонтаж R17"
      ];
      var hint = hints[(frame / 140 | 0) % hints.length];
      rr(ctx, cx - 42, 8, 84, 14, 4, "rgba(15,23,42,.75)", "rgba(56,189,248,.35)");
      ctx.fillStyle = "#bae6fd";
      ctx.font = "bold 7px sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(hint, cx, 18);
    }

    frame++;
    requestAnimationFrame(engineloop);
  }

  initScene();
  window.addEventListener("resize", initScene);
  engineloop();
});
</script>
</section>

<div class="ava-content">

  <!-- INTRO после hero -->
  <section class="ava-intro nero-ai-section" id="pochemu-ai-2026" aria-label="Введение">
    <div class="ava-cnt">
      <div class="ava-intro-grid nero-ai-reveal">
        <div class="ava-intro-text">
          <p class="ava-eyebrow">Лонгрид · ai для автосервиса</p>
          <p><strong>Коротко:</strong> AI для автосервиса — это не «чат-бот на сайте», а голосовой AI-администратор, который принимает звонки, уточняет услугу, даёт ориентир по цене из вашего справочника и создаёт запись в CRM. Nero Network внедряет такое решение под ключ: от аудита звонков до интеграции с 1С, amoCRM или Битрикс24.</p>
        </div>
        <div class="ava-intro-kpi" aria-label="Ключевые метрики автосервиса">
          <div class="ava-kpi-card"><div class="kv">20–35%</div><div class="kl">пропущенных в пик</div><div class="ks">отраслевые бенчмарки</div></div>
          <div class="ava-kpi-card"><div class="kv">40%</div><div class="kl">звонков вне часов</div><div class="ks">Stexa / ниша СТО</div></div>
          <div class="ava-kpi-card"><div class="kv">120–350</div><div class="kl">тыс. ₽ внедрение</div><div class="ks">проект под ключ</div></div>
          <div class="ava-kpi-card"><div class="kv">2–3</div><div class="kl">недели до пилота</div><div class="ks">запись + цена + CRM</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <div class="ava-toc-outer">
    <div class="ava-cnt">
      <nav class="ava-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-ai-2026">Почему AI</a>
        <a href="#kalkulyator-propuschennyh">Калькулятор</a>
        <a href="#kak-rabotaet-ai-admin">Как работает</a>
        <a href="#funkcii-ai">Функции</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#kejsy-scenarii">Кейсы</a>
        <a href="#etapy-vnedreniya">Этапы</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#zayavka">Заявка</a>
      </nav>
    </div>
  </div>

  <!-- H2: Почему автосервису нужен AI -->
  <section class="ava-section" aria-labelledby="pochemu-h2">
    <div class="ava-cnt">
      <div class="ava-sh ava-left">
        <span class="ava-eyebrow">Тренд 2026</span>
        <h2 id="pochemu-h2">Почему автосервису нужен AI-администратор в 2026</h2>
        <p>Автосервис на три поста — мини-контакт-центр на одну-две линии. Клиенты звонят по цене и записи, администратор одновременно оформляет заказ-наряд у стойки и берёт трубку.</p>
      </div>

      <div class="ava-card nero-ai-reveal">
        <p>В 2026 тренд contact-center automation дошёл до малого сервисного бизнеса. IBM в обзоре Contact Center Automation Trends (12.01.2026) фиксирует ускорение voice-based conversational AI и agentic AI в customer service. Gartner, цитируемый IBM, прогнозирует: к 2028 не менее 70% клиентов начнут путь с conversational AI.</p>
        <p class="ava-short"><strong>Определение:</strong> AI-администратор автосервиса — голосовой (и опционально текстовый) AI-агент, который ведёт диалог как приёмщик: уточняет марку и работу, озвучивает ориентир по цене, бронирует слот, создаёт запись в CRM и при необходимости переводит на живого администратора с контекстом разговора.</p>
        <p>Автоматизация через AI для автосервиса не заменяет приёмщика целиком. Она забирает рутину — запись, уточнение, повторяющиеся вопросы по цене — и закрывает окна, когда человек физически занят: вечер, выходные, сезонный пик.</p>
      </div>

      <div class="ava-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="ava-card" id="zvonki-glavnyj-kanal">
          <h3>Звонки — главный канал СТО и шиномонтажа</h3>
          <p>Телефон остаётся главным каналом обращений в автосервис, шиномонтаж и кузовной ремонт. Мессенджеры растут у аудитории до 40 лет, но для владельцев авто 45+ звонок — привычный способ «узнать цену и записаться на завтра».</p>
          <p>По данным отраслевых обзоров automotive service в США (STELLA, Numa, Toma — цитируются в обзорах CallSphere и BuiltWithAgents, 2026), в пиковые часы 30–40% входящих на сервисную линию могут оставаться без ответа.</p>
        </div>
        <div class="ava-card nero-ai-delay-1">
          <h3>Карта: 5 типовых звонков в автосервис</h3>
          <div class="ava-table-wrap" style="margin:12px 0 0;">
            <table class="ava-table">
              <thead><tr><th>№</th><th>Интент</th><th>Реплика клиента</th></tr></thead>
              <tbody>
                <tr><td>1</td><td>Запись</td><td>«Хочу записаться на ТО / шиномонтаж»</td></tr>
                <tr><td>2</td><td>Цена</td><td>«Сколько стоит замена масла?»</td></tr>
                <tr><td>3</td><td>Статус</td><td>«Машина готова?»</td></tr>
                <tr><td>4</td><td>Кузовной</td><td>«Вмятина — сколько и когда?»</td></tr>
                <tr><td>5</td><td>Эвакуатор</td><td>«Не заводится, можете забрать?»</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="ava-card nero-ai-reveal nero-ai-delay-2" id="propushchennyj-zvonok" style="margin-top:28px;">
        <h3>Пропущенный звонок = потерянная запись</h3>
        <p class="ava-short"><strong>Коротко:</strong> пропущенный звонок в автосервисе — это не «пропущенный звонок», а потерянная запись с измеримым чеком.</p>
        <p>По бенчмаркам из публичных материалов интеграторов, доля пропущенных в пик составляет 20–35%; в шиномонтажный сезон — до 35–45%. У нишевого решения Stexa для СТО заявлено: до 40% звонков приходят вне рабочего времени, а в сезон входящие могут вырасти в три раза.</p>
        <p>Клиент, которому не ответили за 30–60 секунд, редко ждёт перезвона. Конверсия звонка в запись — ориентир 40–60%. Средний чек СТО — 5 000–15 000 ₽.</p>
        <p><strong>Формула ущерба:</strong> Потери в месяц = Звонки × % пропущенных × % конверсии × Средний чек. Пример: 300 × 0,25 × 0,5 × 8 000 = <strong>300 000 ₽</strong> потенциальной недополученной выручки в месяц.</p>
      </div>
    </div>
  </section>

  <!-- БОРИС: Canvas — поток звонков в пике -->
  <section id="ai-dlya-avtoservisa-boris-block" class="bava-root" aria-label="Анимация: поток входящих звонков автосервиса — AI перехватывает или звонок теряется">
<style>
#ai-dlya-avtoservisa-boris-block.bava-root{padding:56px 0 64px;background:#f1f5f9;}
#ai-dlya-avtoservisa-boris-block .bava-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-dlya-avtoservisa-boris-block .bava-card{display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:480px;}
@media(max-width:1023px){#ai-dlya-avtoservisa-boris-block .bava-card{grid-template-columns:1fr;min-height:auto;}}
#ai-dlya-avtoservisa-boris-block .bava-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-dlya-avtoservisa-boris-block .bava-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#ai-dlya-avtoservisa-boris-block .bava-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0284c7;margin:0 0 14px;}
#ai-dlya-avtoservisa-boris-block .bava-ey::before{content:'';width:18px;height:2px;background:#0284c7;border-radius:1px;}
#ai-dlya-avtoservisa-boris-block .bava-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#ai-dlya-avtoservisa-boris-block .bava-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-dlya-avtoservisa-boris-block .bava-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-dlya-avtoservisa-boris-block .bava-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(2,132,199,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0369a1;margin-top:1px;font-style:normal;}
#ai-dlya-avtoservisa-boris-block .bava-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-dlya-avtoservisa-boris-block .bava-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-dlya-avtoservisa-boris-block .bava-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-dlya-avtoservisa-boris-block .bava-pl-r{background:rgba(248,113,113,.08);color:#b91c1c;border:1.5px solid rgba(248,113,113,.22);}
#ai-dlya-avtoservisa-boris-block .bava-pl-b{background:rgba(2,132,199,.08);color:#0369a1;border:1.5px solid rgba(2,132,199,.22);}
#ai-dlya-avtoservisa-boris-block .bava-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
#ai-dlya-avtoservisa-boris-block .bava-rgt{background:linear-gradient(145deg,#0c1222 0%,#111827 55%,#0a0f1a 100%);position:relative;overflow:hidden;min-height:400px;}
@media(max-width:1023px){#ai-dlya-avtoservisa-boris-block .bava-rgt{min-height:360px;}}
#bava-calls-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bava-cnt">
<div class="bava-card">
  <div class="bava-lft">
    <span class="bava-ey">Пик сезона · шиномонтаж</span>
    <h3 class="bava-h3">Пока администратор у стойки — очередь звонков растёт</h3>
    <ul class="bava-ul">
      <li><span class="bava-ic">📞</span>Входящие параллельно: запись R17, цена ТО, статус ремонта</li>
      <li><span class="bava-ic">✓</span>AI перехватывает типовой звонок → слот в CRM → SMS клиенту</li>
      <li><span class="bava-ic">✕</span>Пропущенный звонок уходит к конкуренту в 2ГИС — красная ветка</li>
      <li><span class="bava-ic">→</span>Дальше — посчитайте свои потери в калькуляторе ниже</li>
    </ul>
    <div class="bava-pills">
      <span class="bava-pl bava-pl-g">AI: запись в CRM</span>
      <span class="bava-pl bava-pl-r">Пропуск: −8 000 ₽</span>
      <span class="bava-pl bava-pl-b">×3 входящих в сезон</span>
    </div>
    <p class="bava-foot">Контраст к hero: не dashboard, а живой поток звонков →</p>
  </div>
  <div class="bava-rgt">
    <canvas id="bava-calls-canvas" aria-label="Анимация потока звонков: входящие, обработка AI, пропущенные и записи в CRM" role="img"></canvas>
  </div>
</div>
</div>
<script>
(function(){
  var cv=document.getElementById('bava-calls-canvas');
  if(!cv)return;
  var cx=cv.getContext('2d'),W=0,H=0,t=0;
  function resize(){
    var p=cv.parentElement;if(!p)return;
    cv.width=p.clientWidth||640;cv.height=p.clientHeight||400;
    W=cv.width;H=cv.height;
  }
  window.addEventListener('resize',resize);resize();
  var C={cyan:'#38bdf8',green:'#4ade80',red:'#f87171',viol:'#a78bfa',text:'#e2e8f0',muted:'rgba(226,232,240,.4)',line:'rgba(255,255,255,.08)'};
  var CALLS=[
    {y:.22,delay:0,path:'ai',label:'Шиномонтаж R17'},
    {y:.38,delay:55,path:'miss',label:'Цена масла'},
    {y:.52,delay:110,path:'ai',label:'ТО Kia Rio'},
    {y:.66,delay:165,path:'miss',label:'Статус ремонта'},
    {y:.78,delay:220,path:'ai',label:'Запись чт 10:00'}
  ];
  var LOOP=320;
  function rr(x,y,w,h,r,fill,stroke,lw){
    cx.beginPath();
    if(cx.roundRect)cx.roundRect(x,y,w,h,r);
    else{cx.moveTo(x+r,y);cx.arcTo(x+w,y,x+w,y+h,r);cx.arcTo(x+w,y+h,x,y+h,r);cx.arcTo(x,y+h,x,y,r);cx.arcTo(x,y,x+w,y,r);cx.closePath();}
    if(fill){cx.fillStyle=fill;cx.fill();}
    if(stroke){cx.strokeStyle=stroke;cx.lineWidth=lw||1;cx.stroke();}
  }
  function drawNode(x,y,r,col,glow){
    cx.beginPath();cx.arc(x,y,r+glow,0,Math.PI*2);
    cx.fillStyle=col.replace('1)','.15)').replace('rgb','rgba').replace('#4ade80','rgba(74,222,128,.12)').replace('#f87171','rgba(248,113,113,.12)').replace('#38bdf8','rgba(56,189,248,.12)');
    if(col===C.green)cx.fillStyle='rgba(74,222,128,.14)';
    if(col===C.red)cx.fillStyle='rgba(248,113,113,.14)';
    if(col===C.cyan)cx.fillStyle='rgba(56,189,248,.14)';
    cx.fill();
    cx.beginPath();cx.arc(x,y,r,0,Math.PI*2);cx.fillStyle=col;cx.fill();
  }
  function loop(){
    t++;
    var f=t%LOOP;
    cx.clearRect(0,0,W,H);
    var inX=W*.08,aiX=W*.48,missX=W*.78,crmX=W*.92;
    rr(12,12,W-24,H-24,14,'rgba(255,255,255,.03)',C.line,1);
    cx.fillStyle=C.muted;cx.font='bold 11px Inter,sans-serif';cx.textAlign='left';
    cx.fillText('Входящие',inX-20,28);
    cx.textAlign='center';cx.fillText('AI-админ',aiX,28);
    cx.fillText('Пропуск',missX,28);
    cx.textAlign='right';cx.fillText('CRM',crmX,28);
    drawNode(inX,H*.5,10,C.cyan,6);
    drawNode(aiX,H*.5,12,C.viol,8);
    drawNode(missX,H*.5,10,C.red,6);
    drawNode(crmX,H*.5,10,C.green,6);
    CALLS.forEach(function(call){
      var lt=(f-call.delay+LOOP)%LOOP;
      if(lt>LOOP-40)return;
      var prog=Math.min(1,lt/140);
      var y=call.y*H;
      var x1=inX+(aiX-inX)*Math.min(1,prog*1.4);
      if(prog>.5){
        var p2=(prog-.5)*2;
        x1=call.path==='ai'?aiX+(crmX-aiX)*p2:aiX+(missX-aiX)*p2;
      }
      var col=call.path==='ai'?C.green:C.red;
      cx.beginPath();cx.arc(x1,y,7,0,Math.PI*2);cx.fillStyle=col;cx.fill();
      cx.strokeStyle='rgba(255,255,255,.25)';cx.lineWidth=1.5;
      cx.beginPath();cx.moveTo(inX+12,y);cx.lineTo(x1-10,y);cx.stroke();
      if(prog>.85){
        cx.globalAlpha=Math.max(0,1-(lt-120)/20);
        cx.fillStyle=C.text;cx.font='9px Inter,sans-serif';cx.textAlign='left';
        cx.fillText(call.label,x1+10,y+3);
        cx.globalAlpha=1;
      }
    });
    var aiCnt=Math.floor(f/60)%4+2,missCnt=Math.floor(f/90)%3+1;
    cx.fillStyle=C.muted;cx.font='10px Inter,sans-serif';cx.textAlign='left';
    cx.fillText('Обработано AI: '+aiCnt+'  ·  Пропущено: '+missCnt,H*.5-40, H-16);
    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>

  <!-- КАЛЬКУЛЯТОР -->
  <section class="ava-section ava-section-alt" id="kalkulyator-propuschennyh" aria-labelledby="calc-h2">
    <div class="ava-cnt">
      <div class="ava-sh">
        <span class="ava-eyebrow">Лид-магнит</span>
        <h2 id="calc-h2">Калькулятор пропущенных звонков автосервиса</h2>
        <p>Подставьте цифры из отчёта АТС — увидите порядок потерь и сравните с ориентиром внедрения 120–350 тыс. ₽.</p>
      </div>

      <div class="ava-calc-wrap nero-ai-reveal" id="ava-calc-root">
        <div class="ava-calc-grid">
          <div class="ava-calc-field">
            <label for="ava-calc-calls">Звонков в месяц</label>
            <input type="number" id="ava-calc-calls" value="300" min="10" max="10000" step="10" inputmode="numeric">
            <p class="ava-calc-hint">Из отчёта АТС: Манго, UIS, Sipuni, Ростелеком ВАТС</p>
          </div>
          <div class="ava-calc-field">
            <label for="ava-calc-missed-val">% пропущенных: <strong id="ava-calc-missed-val">25</strong>%</label>
            <input type="range" id="ava-calc-missed" value="25" min="5" max="50" step="1">
            <p class="ava-calc-hint">Обычно 20–35%; в сезон шиномонтажа — до 45%</p>
          </div>
          <div class="ava-calc-field">
            <label for="ava-calc-conv-val">% конверсии в запись: <strong id="ava-calc-conv-val">50</strong>%</label>
            <input type="range" id="ava-calc-conv" value="50" min="20" max="80" step="5">
            <p class="ava-calc-hint">Ориентир для типового СТО: 40–60%</p>
          </div>
          <div class="ava-calc-field">
            <label for="ava-calc-check">Средний чек, ₽</label>
            <input type="number" id="ava-calc-check" value="8000" min="1000" max="100000" step="500" inputmode="numeric">
            <p class="ava-calc-hint">Типично 5 000–15 000 ₽ в зависимости от ниши</p>
          </div>
        </div>

        <div class="ava-calc-result" aria-live="polite">
          <p class="lbl">Потенциальные потери в месяц</p>
          <p class="month" id="ava-calc-month">300 000 ₽</p>
          <p class="year" id="ava-calc-year">≈ 3 600 000 ₽ в год</p>
          <div class="ava-calc-compare">
            <span class="ava-calc-pill">Внедрение AI: <strong>120–350 тыс. ₽</strong></span>
            <span class="ava-calc-pill">2-й админ: <strong>80–120 тыс. ₽/мес</strong></span>
          </div>
        </div>

        <div class="ava-calc-cta">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>

      <div class="ava-card nero-ai-reveal" style="margin-top:28px;">
        <p>Калькулятор не обещает «вернуть всё» — он показывает порядок цифр. Реальный эффект зависит от доли типовых звонков, качества сценариев и интеграции с CRM. Даже если AI перехватит 30–50% рутинных обращений в нерабочее время и в пик — окупаемость часто укладывается в 1–3 месяца.</p>
      </div>
    </div>
  </section>


      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-kalkulyator">
        <div class="ym-cta-block__icon" aria-hidden="true">📞</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнали свои потери? Разберём звонки бесплатно</p>
          <p class="ym-cta-block__sub">Прослушаем 20–30 записей с вашей АТС, покажем долю пропущенных и карту сценариев для AI-администратора. Без обязательств по внедрению — только цифры и план пилота на 2–3 недели.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>

  <!-- H2: Как работает -->
  <section class="ava-section" id="kak-rabotaet-ai-admin" aria-labelledby="kak-h2">
    <div class="ava-cnt">
      <div class="ava-sh">
        <span class="ava-eyebrow">Гибридная модель</span>
        <h2 id="kak-h2">Как работает AI-администратор для автосервиса</h2>
        <p>AI работает там, где администратор физически не успевает — ночь, выходные, сезонный пик. Днём живой приёмщик остаётся на сложных кейсах.</p>
      </div>

      <div class="ava-flow nero-ai-reveal" aria-label="Цепочка работы AI-администратора">
        <span>Звонок на СТО</span><span class="arr">→</span>
        <span>AI: интент + 152-ФЗ</span><span class="arr">→</span>
        <span>Уточнение + слот CRM</span><span class="arr">→</span>
        <span>Запись + SMS</span><span class="arr">→</span>
        <span>Warm transfer</span>
      </div>

      <div class="ava-grid-3 nero-ai-reveal">
        <div class="ava-card" id="zvonok-utochnenie">
          <h3>Входящий звонок → уточнение марки и работы</h3>
          <p>AI-звонки автосервис начинаются с определения интента за 10–15 секунд. Сценарий собирает поля для CRM: тип работы, дата, телефон. Мгновенный перевод по фразе «оператор» — без борьбы с клиентом 50+.</p>
        </div>
        <div class="ava-card nero-ai-delay-1" id="cena-i-zapis">
          <h3>Ориентир по цене и запись на услугу</h3>
          <p>AI расчёт ремонта — <strong>только из справочника клиента</strong>. Агент читает расписание постов из 1С:Автосервис, amoCRM, Битрикс24 или Google Таблицы.</p>
        </div>
        <div class="ava-card nero-ai-delay-2" id="zayavka-crm">
          <h3>Заявка в CRM и уведомление мастеру</h3>
          <p>Создаётся лид с тегом <code>ai-admin</code>, транскрипт и summary в карточке. Мастер получает уведомление в Telegram, SMS или задачу в CRM.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2: Функции -->
  <section class="ava-section ava-section-alt" id="funkcii-ai" aria-labelledby="funk-h2">
    <div class="ava-cnt">
      <div class="ava-sh">
        <span class="ava-eyebrow">Возможности</span>
        <h2 id="funk-h2">Функции AI для автосервиса</h2>
      </div>

      <div class="ava-grid-3 nero-ai-reveal">
        <div class="ava-card" id="zvonki-messendzhery">
          <h3>Приём звонков и мессенджеров</h3>
          <p>Голос 24/7 + Telegram, WhatsApp, VK. Гибрид: голос — ночь и пик; мессенджеры — аудитория до 40 лет. Исходящие напоминания за 24 ч снижают no-show на 30–45%.</p>
        </div>
        <div class="ava-card nero-ai-delay-1" id="raschet-remonta">
          <h3>Предварительный расчёт ремонта</h3>
          <p>Чек-лист по справочнику: ТО-1/ТО-2, R15–R22, диагностика. Итог — диапазон «от … до …» с дисклеймером до осмотра.</p>
        </div>
        <div class="ava-card nero-ai-delay-2" id="integraciya-crm">
          <h3>Интеграция с CRM и учёткой</h3>
          <p>1С:Автосервис, Альфа-Авто, amoCRM, Битрикс24, AutoCRM, Trinion, Google Таблица. Телефония: Манго, UIS, Sipuni, Asterisk.</p>
        </div>
      </div>

      <div class="ava-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="ava-table">
          <thead><tr><th>AI</th><th>Человек</th></tr></thead>
          <tbody>
            <tr><td>Типовые звонки 24/7</td><td>Финальная смета после осмотра</td></tr>
            <tr><td>Ориентир цены из справочника</td><td>Приёмка авто в боксе</td></tr>
            <tr><td>Бронирование слота</td><td>Согласование запчастей, сложная диагностика</td></tr>
            <tr><td>Подтверждение и напоминание</td><td>VIP-клиенты, контроль качества AI</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ava-table-wrap nero-ai-reveal">
        <table class="ava-table">
          <thead><tr><th>Система</th><th>Кто использует</th><th>Что интегрируем</th></tr></thead>
          <tbody>
            <tr><td>1С:Автосервис</td><td>малые СТО, 1–3 поста</td><td>расписание, заказ-наряды, справочник работ</td></tr>
            <tr><td>amoCRM / Битрикс24</td><td>СТО с маркетингом</td><td>лиды, воронка, задачи мастерам</td></tr>
            <tr><td>Google Таблица</td><td>микро-СТО</td><td>минимальный пакет + ручное подтверждение</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- H2: Для кого -->
  <section class="ava-section" id="dlya-kogo" aria-labelledby="dlya-h2">
    <div class="ava-cnt">
      <div class="ava-sh">
        <span class="ava-eyebrow">Целевая аудитория</span>
        <h2 id="dlya-h2">Для кого подходит внедрение</h2>
        <p>Малый и средний сервисный сегмент: 1–6 постов, один-два администратора, телефон как главный канал.</p>
      </div>
      <div class="ava-grid-3 nero-ai-reveal">
        <div class="ava-card" id="avtoservis-sto">
          <h3>Автосервис и СТО</h3>
          <p>AI закрывает 60–70% входящих: запись, цена, статус «машина готова?». Пакет Nero: 120–350 тыс. ₽ разово, пилот 2–3 недели.</p>
        </div>
        <div class="ava-card nero-ai-delay-1" id="shinomontazh-sezon">
          <h3>Шиномонтаж и сезонные пики</h3>
          <p>Сезон март–апрель и октябрь–ноябрь: входящие ×2–3. AI принимает параллельные звонки, записывает на пост, озвучивает цену перебортовки.</p>
        </div>
        <div class="ava-card nero-ai-delay-2" id="deteyling-kuzovnoj">
          <h3>Детейлинг и кузовной ремонт</h3>
          <p>Длинный цикл, выше чек. AI собирает параметры повреждения, записывает на осмотр, фиксирует страховой кейс с эскалацией на приёмщика.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- H2: Кейсы -->
  <section class="ava-section ava-section-alt" id="kejsy-scenarii" aria-labelledby="kejs-h2">
    <div class="ava-cnt">
      <div class="ava-sh">
        <span class="ava-eyebrow">Сценарии</span>
        <h2 id="kejs-h2">Кейсы и сценарии внедрения</h2>
      </div>
      <div class="ava-case-grid nero-ai-reveal">
        <div class="ava-case-card" id="to-diagnostika">
          <div class="ava-case-tag">ТО и диагностика</div>
          <h3>ТО-2 Kia Rio — запись в 1С</h3>
          <p>AI уточняет пробег, озвучивает состав ТО-2 (от 12 000 ₽), предлагает слот, создаёт запись. Бенчмарк Mia Labs: containment 62%+, логику «пойманный звонок = запись» переносим без долларовых обещаний.</p>
        </div>
        <div class="ava-case-card" id="shinomontazh-zapis">
          <div class="ava-case-tag">Шиномонтаж</div>
          <h3>Перебортовка R17, свои колёса</h3>
          <p>Уточняет радиус, датчики давления, цену из прайса, записывает на пост №2. Stexa: ×3 входящих в сезон — Nero отстраивается кастомными сценариями, не подпиской.</p>
        </div>
        <div class="ava-case-card" id="kuzovnoj-foto">
          <div class="ava-case-tag">Кузовной</div>
          <h3>Оценка по фото + антикейс 50+</h3>
          <p>Голосовой AI для аудитории 50+ не всем зашёл (GPTmag) — Nero учитывает гибрид: мгновенный перевод на администратора.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2: Этапы -->
  <section class="ava-section" id="etapy-vnedreniya" aria-labelledby="etapy-h2">
    <div class="ava-cnt">
      <div class="ava-sh ava-left">
        <span class="ava-eyebrow">Под ключ</span>
        <h2 id="etapy-h2">Этапы внедрения AI под ключ</h2>
        <p>Разработка и настройка ai для автосервиса — проектная модель, не «поставили коробку и ушли».</p>
      </div>
      <div class="ava-card nero-ai-reveal">
        <div class="ava-timeline">
          <div class="ava-tl-item" id="audit-zvonkov"><div class="ava-tl-dot"></div>
            <h3>Аудит звонков и сценариев (2–3 дня)</h3>
            <p>20–30 записей звонков, топ-5 интентов, доля пропущенных из АТС, карта сценариев и ТЗ на интеграцию.</p>
          </div>
          <div class="ava-tl-item" id="telefoniya-crm"><div class="ava-tl-dot"></div>
            <h3>Подключение телефонии (SIP/ВАТС) и CRM (1–2 недели)</h3>
            <p>SIP-маршрутизация, API CRM, база знаний, предупреждение о записи разговора. Хранение в РФ при 152-ФЗ.</p>
          </div>
          <div class="ava-tl-item" id="obuchenie-zapusk"><div class="ava-tl-dot"></div>
            <h3>Обучение, тестовый период и запуск (1 неделя)</h3>
            <p>10–15 сценариев, доработка по реальным формулировкам. Дашборд: пропущенные, AHT, конверсия, no-show. Итого: 2–3 недели до первых боевых сценариев.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-audit-zvonkov">
        <div class="ym-cta-block__icon" aria-hidden="true">🎧</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Аудит звонков автосервиса — бесплатно</p>
          <p class="ym-cta-block__sub">За 2–3 дня выделим топ-5 интентов (цена, запись, статус, кузовной, эвакуатор), замерим пропущенные из АТС и дадим ориентир интеграции с вашей CRM и телефонией. Фиксированный проект: 120–350 тыс. ₽.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понять AI до пилота на номере?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI-администратора полезно разобраться в сценариях диалога, human-in-the-loop и интеграции телефонии с CRM — это ускоряет согласование с администратором и мастерами. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>

  <!-- H2: Стоимость -->
  <section class="ava-section ava-section-alt" id="stoimost" aria-labelledby="stoim-h2">
    <div class="ava-cnt">
      <div class="ava-sh">
        <span class="ava-eyebrow">Коммерция</span>
        <h2 id="stoim-h2">Стоимость внедрения AI для автосервиса</h2>
        <p>Ориентир <strong>120–350 тыс. ₽</strong> за проект под ключ — фиксированный проект с вашими сценариями и CRM, не подписка SaaS.</p>
      </div>
      <div class="ava-grid-2 nero-ai-reveal">
        <div class="ava-card" id="chto-vhodit">
          <h3>Что входит в пакет</h3>
          <ul>
            <li>Аудит звонков и проектирование сценариев</li>
            <li>Голосовой AI-агент (STT + LLM + TTS)</li>
            <li>Интеграция CRM/учётки и телефонии</li>
            <li>База знаний, пилот, обучение, дашборд</li>
            <li>Опционально: мессенджеры, напоминания, оценка по фото</li>
          </ul>
        </div>
        <div class="ava-card nero-ai-delay-1" id="ot-chego-zavisit">
          <h3>От чего зависит сумма</h3>
          <div class="ava-table-wrap" style="margin:0;">
            <table class="ava-table">
              <thead><tr><th>Фактор</th><th>Влияние</th></tr></thead>
              <tbody>
                <tr><td>Доп. филиалы</td><td>+20–40% за адрес</td></tr>
                <tr><td>CRM без API (Excel)</td><td>минимальный пакет</td></tr>
                <tr><td>Мессенджеры WA/TG/VK</td><td>+30–50 тыс. ₽/канал</td></tr>
                <tr><td>Исходящие напоминания</td><td>+40–80 тыс. ₽</td></tr>
              </tbody>
            </table>
          </div>
          <p style="margin-top:14px;">Второй администратор — 80–120 тыс. ₽/мес ФОТ. Один месяц пропущенных часто стоит дороже внедрения.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2: FAQ -->
  <section class="ava-section" id="faq" aria-labelledby="faq-h2">
    <div class="ava-cnt">
      <div class="ava-sh">
        <span class="ava-eyebrow">FAQ</span>
        <h2 id="faq-h2">FAQ по внедрению AI в автосервис</h2>
      </div>
      <div class="ava-faq nero-ai-reveal" id="ava-faq-root">
        <div class="ava-faq-item" id="faq-vtoroj-admin">
          <div class="ava-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли второй администратор после внедрения?</div>
          <div class="ava-faq-a"><p>Не обязательно. AI закрывает рутину и нерабочее время; один администратор + AI часто заменяют схему «два приёмщика в сезон».</p></div>
        </div>
        <div class="ava-faq-item" id="faq-crm-telefoniya">
          <div class="ava-faq-q" role="button" tabindex="0" aria-expanded="false">Какие CRM и телефонию подключаете?</div>
          <div class="ava-faq-a"><p>amoCRM, Битрикс24, 1С:Автосервис, Альфа-Авто, AutoCRM, Trinion, Google Таблица. Телефония: Манго, UIS, Sipuni, МТТ, Ростелеком ВАТС, Asterisk.</p></div>
        </div>
        <div class="ava-faq-item" id="faq-okupaemost">
          <div class="ava-faq-q" role="button" tabindex="0" aria-expanded="false">Как считается окупаемость?</div>
          <div class="ava-faq-a"><p>Через калькулятор: (звонки × % пропущенных × конверсия × чек) − стоимость внедрения. Плюс разгрузка админа, меньше no-show, записи вне рабочих часов.</p></div>
        </div>
        <div class="ava-faq-item" id="faq-zapis-razgovorov">
          <div class="ava-faq-q" role="button" tabindex="0" aria-expanded="false">Законно ли записывать разговоры с AI?</div>
          <div class="ava-faq-a"><p>Да, при соблюдении 152-ФЗ. AI предупреждает о записи в начале; продолжение = фактическое согласие. Хранение — на серверах в РФ при требовании клиента.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- H2: Заявка -->
  <section class="ava-section ava-section-alt" id="zayavka" aria-labelledby="zayavka-h2">
    <div class="ava-cnt">
      <div class="ava-sh">
        <span class="ava-eyebrow">Следующий шаг</span>
        <h2 id="zayavka-h2">Заявка на внедрение</h2>
        <p>Внедрение ai для автосервиса под ключ начинается с цифр, а не с «давайте попробуем бота».</p>
      </div>
      <div class="ava-card nero-ai-reveal" style="max-width:820px;margin:0 auto;text-align:center;">
        <p><strong>Шаг 1.</strong> Посчитайте потери в калькуляторе.</p>
        <p><strong>Шаг 2.</strong> Заявка на аудит 20–30 записей звонков — карта сценариев и ориентир 120–350 тыс. ₽.</p>
        <p><strong>Шаг 3.</strong> Пилот на одном номере за 2–3 недели: запись, цена, CRM.</p>
        <p>Contact-center automation 2026 дошла до автосервиса на три поста. Вопрос не «нужен ли AI», а сколько записей вы теряете каждый месяц.</p>
      </div>

        <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-zayavka">
          <div class="ym-cta-block__body">
            <p class="ym-cta-block__headline">Contact-center automation 2026 дошла до автосервиса на три поста</p>
            <p class="ym-cta-block__sub">Сначала — цифры в калькуляторе. Потом — аудит звонков и пилот на одном номере: запись, цена, CRM. Прозрачные метрики: сколько звонков закрыл AI и сколько записей появилось вне рабочих часов.</p>
            <div class="ym-cta-block__actions">
              <a href="#kalkulyator-propuschennyh" class="nero-ai-btn nero-ai-btn-secondary ym-btn">Калькулятор потерь</a>
              <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            </div>
          </div>
        </div>
    </div>
  </section>

</div><!-- /.ava-content -->

<script>
/* Калькулятор пропущенных звонков */
(function(){
  var calls=document.getElementById('ava-calc-calls');
  var missed=document.getElementById('ava-calc-missed');
  var conv=document.getElementById('ava-calc-conv');
  var check=document.getElementById('ava-calc-check');
  var missedVal=document.getElementById('ava-calc-missed-val');
  var convVal=document.getElementById('ava-calc-conv-val');
  var monthEl=document.getElementById('ava-calc-month');
  var yearEl=document.getElementById('ava-calc-year');
  if(!calls||!monthEl)return;
  function fmt(n){return Math.round(n).toLocaleString('ru-RU')+' \u20bd';}
  function recalc(){
    var c=parseFloat(calls.value)||0;
    var m=(parseFloat(missed.value)||0)/100;
    var v=(parseFloat(conv.value)||0)/100;
    var ch=parseFloat(check.value)||0;
    if(missedVal)missedVal.textContent=missed.value;
    if(convVal)convVal.textContent=conv.value;
    var loss=c*m*v*ch;
    monthEl.textContent=fmt(loss);
    yearEl.textContent='\u2248 '+fmt(loss*12)+' \u0432 \u0433\u043e\u0434';
  }
  ['input','change'].forEach(function(ev){
    [calls,missed,conv,check].forEach(function(el){if(el)el.addEventListener(ev,recalc);});
  });
  recalc();
})();

/* FAQ аккордеон */
(function(){
  var root=document.getElementById('ava-faq-root');
  if(!root)return;
  root.querySelectorAll('.ava-faq-q').forEach(function(q){
    function toggle(){
      var item=q.parentElement;
      var open=item.classList.contains('open');
      root.querySelectorAll('.ava-faq-item').forEach(function(i){i.classList.remove('open');i.querySelector('.ava-faq-q').setAttribute('aria-expanded','false');});
      if(!open){item.classList.add('open');q.setAttribute('aria-expanded','true');}
    }
    q.addEventListener('click',toggle);
    q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();toggle();}});
  });
})();
</script>
<!-- SCHEMA-MARKUP:INSERT -->

<!-- AD_BANNER: not configured -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

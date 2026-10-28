<?php
/**
 * Template Name: AI-агент для сменных заданий и контроля простоев на производстве
 * Description: SEO-лендинг — внедрение AI-агента для контроля простоев и сменных заданий на производстве.
 */

declare(strict_types=1);

$page_seo_title       = 'Внедрение AI на производстве: контроль простоев под ключ';
$page_seo_description = 'AI-агент для производства: сменные задания, контроль простоев и отчёт руководителю. Внедрение под ключ для цехов. Бесплатная карта потерь производства.';

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

$brand               = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Найти простои';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#vnedrenie';

$nero_ai_header_links = [
    ['label' => 'Простои', 'href' => '#prostoi'],
    ['label' => 'Решение', 'href' => '#agent'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Для кого', 'href' => '#dlya-kogo'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}
?>

<?php nero_ai_echo_theme_styles(); ?>

<style>
/* Kadence reset */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

/* APKP content root */
.apkp-content{
  --apkp-bg:#050711;--apkp-bg2:#080b17;--apkp-surface:rgba(255,255,255,.072);
  --apkp-text:#e6edf7;--apkp-muted:#9aa8bd;--apkp-soft:#c7d2e5;--apkp-heading:#fff;
  --apkp-border:rgba(255,255,255,.10);--apkp-accent:#79f2ff;--apkp-violet:#8b5cf6;
  --apkp-green:#22c55e;--apkp-amber:#f5c518;--apkp-btn-from:#2563eb;--apkp-btn-to:#7c3aed;
  --apkp-r:18px;--apkp-r-lg:24px;--apkp-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--apkp-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.apkp-content *,.apkp-content *::before,.apkp-content *::after{box-sizing:border-box}
.apkp-content a{color:inherit;text-decoration:none}
.apkp-content p{color:var(--apkp-muted);line-height:1.72;margin:0 0 1em}
.apkp-content p:last-child{margin-bottom:0}
.apkp-content h2,.apkp-content h3,.apkp-content h4{color:var(--apkp-heading);letter-spacing:-.045em;margin:0 0 .7em}
.apkp-content strong{color:var(--apkp-soft)}
.apkp-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.apkp-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--apkp-muted);font-size:14.5px;line-height:1.65}
.apkp-content ul li::before{content:'›';position:absolute;left:0;color:var(--apkp-accent);font-weight:700}
.apkp-cnt{width:min(var(--apkp-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.apkp-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.apkp-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.apkp-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.apkp-sh.apkp-left{margin-left:0;text-align:left}
.apkp-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.apkp-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.apkp-sh.apkp-left p{margin-left:0}
.apkp-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apkp-accent);margin-bottom:14px}
.apkp-gt{background:linear-gradient(92deg,#fff 0%,var(--apkp-accent) 44%,var(--apkp-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.apkp-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.apkp-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.apkp-intro-text{position:relative;padding-left:20px}
.apkp-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--apkp-accent),var(--apkp-violet))}
.apkp-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8}
.apkp-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.apkp-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.apkp-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--apkp-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.apkp-kpi-card .kl{font-size:11px;font-weight:600;color:var(--apkp-muted);line-height:1.4}
.apkp-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.apkp-intro-grid{grid-template-columns:1fr;gap:36px}.apkp-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.apkp-intro-kpi{grid-template-columns:1fr 1fr}}
.apkp-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.apkp-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.apkp-toc a{display:inline-block;padding:9px 18px;background:var(--apkp-surface);border:1px solid var(--apkp-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--apkp-muted);transition:border-color .2s,color .2s,background .2s}
.apkp-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--apkp-accent);background:rgba(121,242,255,.08)}
.apkp-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--apkp-border);border-radius:var(--apkp-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22)}
.apkp-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.apkp-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.apkp-grid-2,.apkp-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.apkp-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.apkp-grid-3{grid-template-columns:1fr}}
.apkp-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09)}
.apkp-table{width:100%;border-collapse:collapse;font-size:14px}
.apkp-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--apkp-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.apkp-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--apkp-text);vertical-align:top}
.apkp-table tr:last-child td{border-bottom:none}
.apkp-table tr:hover td{background:rgba(255,255,255,.03)}
.apkp-table--zebra tbody tr:nth-child(even) td{background:rgba(255,255,255,.02)}
.apkp-cat{display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--apkp-amber);margin-right:8px;vertical-align:middle}
.apkp-callout{border-left:4px solid var(--apkp-amber);padding:20px 24px;margin:28px 0;background:rgba(245,197,24,.06);border-radius:0 14px 14px 0}
.apkp-callout p{margin:0;font-size:15px;color:var(--apkp-soft)}
.apkp-callout cite{display:block;margin-top:10px;font-size:13px;color:var(--apkp-muted);font-style:normal}
.apkp-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09)}
.apkp-compare{width:100%;border-collapse:collapse}
.apkp-compare th{padding:13px 16px;font-size:13px;font-weight:700;text-align:left;background:rgba(255,255,255,.06);color:var(--apkp-muted);border-bottom:1px solid rgba(255,255,255,.1)}
.apkp-compare td{padding:13px 16px;font-size:14px;color:var(--apkp-text);border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top}
.apkp-compare tr:last-child td{border-bottom:none}
.apkp-compare .apkp-col-agent{background:rgba(121,242,255,.06);border-left:2px solid rgba(121,242,255,.35)}
.apkp-good{color:var(--apkp-green)}
.apkp-timeline{position:relative;padding-left:40px}
.apkp-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--apkp-accent),var(--apkp-violet));opacity:.35;border-radius:2px}
.apkp-tl-item{position:relative;margin-bottom:32px}
.apkp-tl-item:last-child{margin-bottom:0}
.apkp-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--apkp-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.apkp-tl-item h3{font-size:17px;margin-bottom:8px}
.apkp-tl-item p{font-size:14.5px;margin:0}
.apkp-day-table .apkp-row-highlight td{background:rgba(34,197,94,.08)!important}
.apkp-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.apkp-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.apkp-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--apkp-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.apkp-faq-q::after{content:'▾';font-size:13px;color:var(--apkp-accent);flex-shrink:0;transition:transform .25s}
.apkp-faq-item.open .apkp-faq-q::after{transform:rotate(180deg)}
.apkp-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--apkp-muted);line-height:1.72}
.apkp-faq-item.open .apkp-faq-a{max-height:800px;padding:0 24px 20px}
.apkp-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.apkp-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--apkp-muted)}
.apkp-cta-checklist li::before{content:'✓';color:var(--apkp-green);font-weight:800}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{background:linear-gradient(135deg,rgba(245,197,24,.08),rgba(121,242,255,.06));border-color:rgba(245,197,24,.25);text-align:left}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--apkp-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn:hover{transform:translateY(-2px)}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--apkp-btn-from),var(--apkp-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--apkp-text)!important;border:1.5px solid rgba(255,255,255,.18)}
.ym-link--accent{color:var(--apkp-accent)!important;text-decoration:underline!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
/* Hero viewport + apkp-page shell */
.apkp-page .apkp-hero-prostoiev,
.apkp-page .nero-ai-hero.apkp-hero-prostoiev {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}
.apkp-page .apkp-hero-prostoiev .nero-ai-hero-grid .nero-ai-hero-copy {
  text-align: left;
}
</style>

<main id="primary" class="site-main nero-ai-home-page apkp-page" role="main" tabindex="-1">

<section class="nero-ai-hero apkp-hero-prostoiev" id="hero" aria-labelledby="apkp-hero-title">
<style>
/* ── Hero ai-proizvodstvo-kontrol-prostoiev: самодостаточные стили ── */
.apkp-hero-prostoiev {
  --apkp-gold: #f5c518;
  --apkp-violet: #8b5cf6;
  --apkp-cyan: #79f2ff;
  --apkp-green: #22c55e;
  --apkp-amber: #f59e0b;
  --apkp-text: #e6edf7;
  --apkp-muted: #9aa8bd;
  --apkp-soft: #c7d2e5;
  --apkp-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.apkp-hero-prostoiev::before {
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
.apkp-hero-prostoiev::after {
  content: "";
  position: absolute;
  right: 8%;
  top: 12%;
  width: 640px;
  height: 640px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(245, 197, 24, .11), transparent 66%);
  filter: blur(8px);
  animation: apkpHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes apkpHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.apkp-hero-prostoiev .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.apkp-hero-prostoiev .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.apkp-hero-prostoiev .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.apkp-hero-prostoiev .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--apkp-gold) 42%, var(--apkp-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.apkp-hero-prostoiev .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 197, 24, 0.22);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--apkp-gold) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.apkp-hero-prostoiev .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--apkp-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.apkp-hero-prostoiev .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.apkp-hero-prostoiev .nero-ai-badge {
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
.apkp-hero-prostoiev .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.apkp-hero-prostoiev .nero-ai-btn {
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
.apkp-hero-prostoiev .nero-ai-btn:hover { transform: translateY(-2px); }
.apkp-hero-prostoiev .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--apkp-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.apkp-hero-prostoiev .nero-ai-btn-secondary {
  color: var(--apkp-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.apkp-hero-prostoiev .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--apkp-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.apkp-hero-prostoiev .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.apkp-hero-prostoiev .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.apkp-hero-prostoiev .nero-ai-dots { display: flex; gap: 7px; }
.apkp-hero-prostoiev .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.apkp-hero-prostoiev .nero-ai-dot:nth-child(1) { background: #fb7185; }
.apkp-hero-prostoiev .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.apkp-hero-prostoiev .nero-ai-dot:nth-child(3) { background: #34d399; }
.apkp-hero-prostoiev .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.apkp-hero-prostoiev .nero-ai-window-body { padding: 16px; }
.apkp-hero-prostoiev .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.apkp-hero-prostoiev .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.apkp-hero-prostoiev .nero-ai-live-pill {
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
.apkp-hero-prostoiev .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: apkpPulse 1.6s infinite;
}
@keyframes apkpPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.apkp-hero-prostoiev .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.apkp-hero-prostoiev .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.apkp-hero-prostoiev .nero-ai-metric span {
  display: block;
  color: var(--apkp-muted);
  font-size: 11px;
  font-weight: 700;
}
.apkp-hero-prostoiev .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.apkp-hero-prostoiev .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.apkp-hero-prostoiev .nero-ai-metric--alert strong { color: var(--apkp-gold); }
.apkp-hero-prostoiev .nero-ai-metric--cyan strong { color: var(--apkp-cyan); }
.apkp-hero-prostoiev .apkp-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(245, 197, 24, 0.16);
  background: radial-gradient(ellipse at 30% 45%, rgba(245,197,24,.07), rgba(6,10,24,.92) 72%);
}
.apkp-hero-prostoiev #apkp-prostoiev-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.apkp-hero-prostoiev .nero-ai-task-stream { display: grid; gap: 8px; }
.apkp-hero-prostoiev .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.apkp-hero-prostoiev .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(245,197,24,.12);
  color: var(--apkp-gold);
  font-size: 11px;
  font-weight: 800;
}
.apkp-hero-prostoiev .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.apkp-hero-prostoiev .nero-ai-task span {
  color: var(--apkp-muted);
  font-size: 11px;
}
.apkp-hero-prostoiev .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.apkp-hero-prostoiev .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.apkp-hero-prostoiev .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
@media (max-width: 1100px) {
  .apkp-hero-prostoiev .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .apkp-hero-prostoiev .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .apkp-hero-prostoiev .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .apkp-hero-prostoiev .nero-ai-window-body { padding: 12px; }
  .apkp-hero-prostoiev .nero-ai-task { grid-template-columns: 28px 1fr; }
  .apkp-hero-prostoiev .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai производство</p>
      <h1 id="apkp-hero-title">AI-агент для сменных заданий и <span class="nero-ai-gradient-text">контроля простоев</span> на производстве</h1>
      <p class="nero-ai-hero-lead">Собирает данные по смене, фиксирует отклонения и формирует отчёт руководителю — без ручного пересчёта заданий и поздней фиксации простоев</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Сменные задания</li>
        <li class="nero-ai-badge">Контроль простоев</li>
        <li class="nero-ai-badge">Отчёт директору</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Найти простои'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#vnedrenie">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-контроля смены и простоев">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Смена · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>План/факт</span>
              <strong>87%</strong>
              <small>выполнение смены</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--alert">
              <span>Простой</span>
              <strong>12 мин</strong>
              <small>зафиксировано в моменте</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--cyan">
              <span>OEE</span>
              <strong>76%</strong>
              <small>доступность × план</small>
            </div>
            <div class="nero-ai-metric">
              <span>Алерт</span>
              <strong>активен</strong>
              <small>простой &gt;15 мин</small>
            </div>
          </div>

          <div class="apkp-dash-canvas-wrap" aria-hidden="false">
            <canvas id="apkp-prostoiev-hero-canvas" role="img" aria-label="Анимация: AI-агент собирает смену, фиксирует простой и отправляет отчёт директору"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">01</span>
              <div><strong>Смена собрана</strong><span>Заказы из 1С → черновик мастеру</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">02</span>
              <div><strong>Простой &gt;15 мин</strong><span>Участок резки · причина: материал</span></div>
              <span class="nero-ai-status nero-ai-status--amber">алерт</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">03</span>
              <div><strong>Отчёт директору</strong><span>План/факт, ТОП-3 потери → Telegram</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">отправлен</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- HERO: делает Алина — не включать в этот фрагмент -->

<div class="apkp-content">


  <!-- INTRO -->
  <section class="apkp-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="apkp-cnt">
      <div class="apkp-intro-grid nero-ai-reveal">
        <div class="apkp-intro-text">
          <p class="apkp-eyebrow">Лонгрид · ai производство контроль</p>
          <p><strong>Коротко:</strong> AI-агент для производства — это не чат-бот на сайте, а операционный слой над цехом. Он собирает факт по смене, сравнивает план и факт, рано сигнализирует о простоях и формирует отчёт руководителю — без ручного пересчёта заданий в Excel и без «детектива» в конце смены.</p>
          <p>На малом производстве — мебель, пищевое, металлоконструкции, участки с ЧПУ — типичная картина одна: <strong>задачи меняются вручную, простои фиксируются поздно</strong>. Мастер тратит часы на сводки, директор узнаёт о потерях, когда час простоя уже стоил десятки тысяч рублей. Внедрение AI-агентов в такой контур решает узкую, измеримую задачу: <strong>найти простои</strong>, собрать смену, дать прозрачность — а не обещать «магический завод будущего».</p>
        </div>
        <div class="apkp-intro-kpi" aria-label="Ключевые показатели">
          <div class="apkp-kpi-card"><div class="kv">50–100</div><div class="kl">тыс. ₽/ч простоя (пищевое)</div><div class="ks">inner.su, 2025</div></div>
          <div class="apkp-kpi-card"><div class="kv">&gt;40%</div><div class="kl">agentic AI проектов отменят</div><div class="ks">Gartner, 2025</div></div>
          <div class="apkp-kpi-card"><div class="kv">4–8</div><div class="kl">недель до пилота</div><div class="ks">Nero Network</div></div>
          <div class="apkp-kpi-card"><div class="kv">500К–2М</div><div class="kl">₽ бюджет внедрения</div><div class="ks">коммерческий план</div></div>
        </div>
      </div>
    </div>
      <!-- INTERNAL-LINKS:INSERT -->
  </section>

  <div class="apkp-toc-outer">
    <div class="apkp-cnt">
      <nav class="apkp-toc" aria-label="Оглавление статьи">
        <a href="#prostoi">Простои</a>
        <a href="#agent">Решение</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#etapy">Этапы</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#konsultaciya">Консультация</a>
      </nav>
    </div>
  </div>

  <!-- #prostoi -->
  <section class="apkp-section" id="prostoi" aria-labelledby="prostoi-h2">
    <div class="apkp-cnt">
      <div class="apkp-sh apkp-left nero-ai-reveal">
        <span class="apkp-eyebrow">Боль цеха</span>
        <h2 id="prostoi-h2">Почему на производстве теряют деньги из‑за ручных сменных заданий и поздней фиксации простоев</h2>
        <p><strong>Определение:</strong> простой на производстве — период, когда оборудование или рабочий центр не выполняет плановую операцию по причинам, которые можно классифицировать и устранить.</p>
      </div>

      <div class="apkp-card nero-ai-reveal" style="margin-bottom:28px;">
        <h3>Как сейчас ведут сменные задания в малых цехах (Excel, 1С, бумажные наряды)</h3>
        <p>В цехах на 10–200 человек сменное задание чаще всего живёт в одном из трёх форматов:</p>
        <ul>
          <li><strong>Excel или Google Таблицы</strong> — план на смену, правки «на лету», обратный перенос факта мастером вечером. При росте заказов таблица превращается в хаос.</li>
          <li><strong>1С:УНФ или 1С:ERP</strong> — учёт есть, но пооперационный контроль в цехе часто остаётся на бумажных нарядах без ранних алертов и NL-отчётов.</li>
          <li><strong>Бумажные сменные наряды</strong> — печать утром, подписи, перенос факта мастером. Данные есть, но они мёртвые до конца смены.</li>
        </ul>
        <p>Проект «Завод на автопилоте» на базе 1С:ERP показал масштаб проблемы: до <strong>40% рабочего времени начальника участка</strong> уходило на поиск статуса деталей. Простои остаются управляемой метрикой — но только если их <strong>фиксируют в моменте</strong>.</p>
      </div>

      <div class="apkp-sh apkp-left nero-ai-reveal" style="margin-bottom:24px;">
        <h3>Типовые причины простоев и почему их замечают слишком поздно</h3>
        <p>По отраслевым ориентирам для РФ (inner.su, 2025) среди причин простоя <strong>без автоматики</strong> человеческий фактор даёт порядка <strong>35%</strong>. Типовой справочник при внедрении <strong>ai контроль простоев</strong>:</p>
      </div>

      <div class="apkp-table-wrap nero-ai-reveal">
        <table class="apkp-table apkp-table--zebra">
          <thead><tr><th>Категория</th><th>Мебельный цех</th><th>Пищевое производство</th></tr></thead>
          <tbody>
            <tr><td><span class="apkp-cat" aria-hidden="true"></span>Поломка оборудования</td><td>кромкооблицовочный, ЧПУ</td><td>линия фасовки, дозатор</td></tr>
            <tr><td><span class="apkp-cat" aria-hidden="true"></span>Ожидание материала</td><td>нет ЛДСП, фурнитуры</td><td>нет упаковки, сырья</td></tr>
            <tr><td><span class="apkp-cat" aria-hidden="true"></span>Переналадка</td><td>смена программы ЧПУ</td><td>санобработка, смена SKU</td></tr>
            <tr><td><span class="apkp-cat" aria-hidden="true"></span>Ожидание людей</td><td>нет оператора на участке</td><td>нехватка смены на линии</td></tr>
            <tr><td><span class="apkp-cat" aria-hidden="true"></span>Организационные</td><td>очередь на ОТК</td><td>простой между сменами</td></tr>
            <tr><td><span class="apkp-cat" aria-hidden="true"></span>Качество / брак</td><td>переделка партии</td><td>отбраковка, HACCP</td></tr>
            <tr><td><span class="apkp-cat" aria-hidden="true"></span>Плановое ТО</td><td>регламентная остановка</td><td>CIP-мойка</td></tr>
          </tbody>
        </table>
      </div>

      <div class="apkp-grid-3 nero-ai-reveal" style="margin-top:28px;">
        <div class="apkp-card"><h3>Деревообработка</h3><p><strong>30–80 тыс. ₽/ч</strong> стоимость простоя (inner.su, 2025)</p></div>
        <div class="apkp-card"><h3>Пищевое</h3><p><strong>50–100 тыс. ₽/ч</strong> — один незамеченный час бьёт по марже</p></div>
        <div class="apkp-card"><h3>Машиностроение</h3><p><strong>90–180 тыс. ₽/ч</strong> — глобально простои «съедают» до ~11% выручки</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;text-align:center;"><strong>Контроль простоев производство</strong> без цифрового контура = учёт «для отчёта», а не для решений в смене.</p>
    </div>
  </section>

  <!-- #agent -->
  <section class="apkp-section apkp-section-alt" id="agent" aria-labelledby="agent-h2">
    <div class="apkp-cnt">
      <div class="apkp-sh nero-ai-reveal">
        <span class="apkp-eyebrow">Решение</span>
        <h2 id="agent-h2">AI-агент для производства: что меняется в контроле смен и простоев</h2>
        <p><strong>Определение:</strong> <strong>AI-агент для производства</strong> — система с доступом к заказам, нормам и факту с планшета или Telegram, которая собирает смену, сравнивает план/факт и готовит отчёт. <strong>Human-in-the-loop</strong>, не автопилот без ответственности.</p>
      </div>

      <div class="apkp-grid-3 nero-ai-reveal">
        <div class="apkp-card">
          <h3>Автосбор сменных заданий</h3>
          <p>Агент подтягивает заказы из 1С или таблицы, учитывает РЦ и людей, предлагает черновик плана. Мастер правит приоритеты и выпускает задания на планшеты или в Telegram-бот смены.</p>
        </div>
        <div class="apkp-card nero-ai-delay-1">
          <h3>Раннее выявление простоев</h3>
          <p>Простой &gt; N минут → обязательная причина (3 тапа). Отставание от нормы → push мастеру. Повторяющаяся причина → эскалация директору.</p>
        </div>
        <div class="apkp-card nero-ai-delay-2">
          <h3>Отчёт руководителю</h3>
          <p>Дашборд план/факт, OEE, текстовая сводка на русском, доставка в Telegram или email — без «собери сам из пяти файлов».</p>
        </div>
      </div>

      <div class="apkp-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Правила ai контроль простоев</h3>
        <ul>
          <li>простой <strong>&gt; N минут</strong> → причина из справочника обязательна;</li>
          <li>отставание от нормы на операции → push мастеру;</li>
          <li>повторяющаяся причина за неделю → эскалация директору;</li>
          <li>простой без причины → блокировка закрытия операции до классификации.</li>
        </ul>
        <p>Для участка с ЧПУ — второй контур телеметрии (КитМон, CNC Pulse). Для мебельного и пищевого цеха <strong>без датчиков</strong> достаточно ручного ввода — сознательный старт, не навязанная MES.</p>
      </div>
    </div>
  </section>

  <!-- БОРИС: визуальный блок (после #agent) -->
  <section id="ai-proizvodstvo-kontrol-prostoiev-boris-block" class="apkpb-root" aria-label="Анимация: карта цеха с ранним алертом простоя и отчётом директору">
<style>
#ai-proizvodstvo-kontrol-prostoiev-boris-block.apkpb-root{padding:clamp(48px,6vw,72px) 0;background:linear-gradient(180deg,rgba(245,197,24,.04),transparent)}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-cnt{width:min(1160px,calc(100% - 40px));margin:0 auto}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:linear-gradient(180deg,rgba(255,255,255,.09),rgba(255,255,255,.04));border:1px solid rgba(255,255,255,.12);box-shadow:0 24px 64px rgba(0,0,0,.35);min-height:480px}
@media(max-width:1023px){#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-card{grid-template-columns:1fr;min-height:auto}}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid rgba(255,255,255,.08)}
@media(max-width:1023px){#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-lft{border-right:none;border-bottom:1px solid rgba(255,255,255,.08);padding:32px 24px}}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#f5c518;margin:0 0 14px}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-ey::before{content:'';width:18px;height:2px;background:#f5c518;border-radius:1px}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#fff;line-height:1.28;margin:0 0 18px}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#c7d2e5}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(245,197,24,.15);display:flex;align-items:center;justify-content:center;font-size:11px;color:#f5c518;margin-top:1px;font-style:normal}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-pl-a{background:rgba(245,197,24,.12);color:#f5c518;border:1.5px solid rgba(245,197,24,.28)}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-pl-g{background:rgba(34,197,94,.1);color:#22c55e;border:1.5px solid rgba(34,197,94,.25)}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-pl-c{background:rgba(121,242,255,.1);color:#79f2ff;border:1.5px solid rgba(121,242,255,.25)}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-foot{font-size:13px;color:#9aa8bd;font-style:italic;margin:0}
#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-rgt{position:relative;background:radial-gradient(ellipse at 30% 40%,rgba(245,197,24,.08),transparent 55%),radial-gradient(ellipse at 70% 60%,rgba(121,242,255,.06),transparent 50%),#080b17;min-height:420px;overflow:hidden}
@media(max-width:1023px){#ai-proizvodstvo-kontrol-prostoiev-boris-block .apkpb-rgt{min-height:360px}}
#apkp-shift-monitor-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>
<div class="apkpb-cnt">
  <div class="apkpb-card nero-ai-reveal">
    <div class="apkpb-lft">
      <span class="apkpb-ey">Мониторинг смены</span>
      <h3 class="apkpb-h3">Карта цеха: простой фиксируется в моменте — не в конце смены</h3>
      <ul class="apkpb-ul">
        <li><span class="apkpb-ic">1</span>Участки РЦ на смене: зелёный — в работе, amber — простой &gt;15 мин</li>
        <li><span class="apkpb-ic">2</span>Оператор выбирает причину из справочника — 3 тапа на планшете</li>
        <li><span class="apkpb-ic">3</span>Агент эскалирует повторяющиеся потери и считает OEE упрощённо</li>
        <li><span class="apkpb-ic">→</span>Поток данных уходит директору: план/факт, ТОП-3 потери, текст на русском</li>
      </ul>
      <div class="apkpb-pills">
        <span class="apkpb-pl apkpb-pl-a">Алерт &gt;15 мин</span>
        <span class="apkpb-pl apkpb-pl-g">Human-in-the-loop</span>
        <span class="apkpb-pl apkpb-pl-c">Отчёт в Telegram</span>
      </div>
      <p class="apkpb-foot">Дальше — как устроено внедрение ai производство контроль от смены до отчёта →</p>
    </div>
    <div class="apkpb-rgt">
      <canvas id="apkp-shift-monitor-canvas" role="img" aria-label="Анимация: карта рабочих центров цеха, ранний алерт простоя и формирование отчёта директору"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv=document.getElementById('apkp-shift-monitor-canvas');
  if(!cv)return;
  var ctx=cv.getContext('2d'),W=0,H=0,t=0;
  function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||420;W=cv.width;H=cv.height;}
  window.addEventListener('resize',resize);resize();
  var C={bg:'#080b17',grid:'rgba(255,255,255,.04)',rc:'rgba(255,255,255,.08)',rcB:'rgba(255,255,255,.14)',green:'#22c55e',amber:'#f5c518',cyan:'#79f2ff',violet:'#8b5cf6',text:'#e6edf7',muted:'#9aa8bd',alert:'rgba(245,197,24,.18)'};
  var RC=[
    {x:.12,y:.18,w:.22,h:.28,label:'Резка',state:'run'},
    {x:.38,y:.18,w:.22,h:.28,label:'ЧПУ',state:'down'},
    {x:.64,y:.18,w:.22,h:.28,label:'Кромка',state:'run'},
    {x:.12,y:.58,w:.22,h:.28,label:'Сборка',state:'run'},
    {x:.38,y:.58,w:.22,h:.28,label:'Упаковка',state:'run'},
    {x:.64,y:.58,w:.22,h:.28,label:'ОТК',state:'idle'}
  ];
  var LOOP=480;
  function rr(x,y,w,h,r,fill,stroke,lw){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(fill){ctx.fillStyle=fill;ctx.fill();}if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1;ctx.stroke();}}
  function drawGrid(){ctx.strokeStyle=C.grid;ctx.lineWidth=1;for(var i=0;i<W;i+=48){ctx.beginPath();ctx.moveTo(i,0);ctx.lineTo(i,H);ctx.stroke();}for(var j=0;j<H;j+=48){ctx.beginPath();ctx.moveTo(0,j);ctx.lineTo(W,j);ctx.stroke();}}
  function drawRC(rc,phase){
    var x=rc.x*W,y=rc.y*H,w=rc.w*W,h=rc.h*H;
    var isDown=rc.state==='down';
    var pulse=isDown?0.5+0.5*Math.sin(phase*0.12):0;
    var col=isDown?C.amber:(rc.state==='run'?C.green:'#64748b');
    if(isDown){ctx.fillStyle=C.alert;rr(x-4,y-4,w+8,h+8,10,C.alert,null,0);}
    rr(x,y,w,h,10,C.rc,C.rcB,1.5);
    ctx.fillStyle=col;ctx.beginPath();ctx.arc(x+14,y+14,5,0,Math.PI*2);ctx.fill();
    if(isDown&&pulse>0.7){ctx.fillStyle='rgba(245,197,24,.35)';ctx.beginPath();ctx.arc(x+w/2,y+h/2,18+pulse*8,0,Math.PI*2);ctx.fill();}
    ctx.fillStyle=C.text;ctx.font='bold 12px Inter,sans-serif';ctx.fillText(rc.label,x+26,y+18);
    ctx.fillStyle=C.muted;ctx.font='10px Inter,sans-serif';
    ctx.fillText(isDown?'ПРОСТОЙ 18 мин':'В работе',x+10,y+h-12);
  }
  function drawAlert(phase){
    var ax=W*.38+RC[1].w*W/2,ay=RC[1].y*H-8;
    if(phase%LOOP<LOOP*.7){
      var bob=Math.sin(phase*0.08)*3;
      rr(ax-70,ay-36+bob,140,28,8,'rgba(245,197,24,.92)',null,0);
      ctx.fillStyle='#0f172a';ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='center';
      ctx.fillText('⚠ Простой >15 мин — укажите причину',ax,ay-17+bob);ctx.textAlign='left';
    }
  }
  function drawFlow(phase){
    var sx=W*.5,sy=H*.82,ex=W*.82,ey=H*.12;
    var prog=(phase%120)/120;
    ctx.strokeStyle='rgba(121,242,255,.35)';ctx.lineWidth=2;ctx.setLineDash([6,6]);
    ctx.beginPath();ctx.moveTo(sx,sy);ctx.bezierCurveTo(sx+40,sy-60,ex-60,ey+40,ex,ey);ctx.stroke();ctx.setLineDash([]);
    var px=sx+(ex-sx)*prog,py=sy+(ey-sy)*prog-30*Math.sin(prog*Math.PI);
    ctx.fillStyle=C.cyan;ctx.beginPath();ctx.arc(px,py,5,0,Math.PI*2);ctx.fill();
    rr(ex-55,ey-22,110,44,10,'rgba(121,242,255,.12)',C.cyan,1);
    ctx.fillStyle=C.cyan;ctx.font='bold 10px Inter,sans-serif';ctx.fillText('Отчёт директору',ex-48,ey-4);
    ctx.fillStyle=C.muted;ctx.font='9px Inter,sans-serif';ctx.fillText('План 87% · ТОП-3 потери',ex-48,ey+10);
  }
  function frame(){t++;ctx.clearRect(0,0,W,H);drawGrid();RC.forEach(function(rc){drawRC(rc,t);});drawAlert(t);drawFlow(t);requestAnimationFrame(frame);}
  requestAnimationFrame(frame);
})();
</script>
  </section>

  <!-- #vnedrenie -->
  <section class="apkp-section" id="vnedrenie" aria-labelledby="vnedrenie-h2">
    <div class="apkp-cnt">
      <div class="apkp-sh nero-ai-reveal">
        <span class="apkp-eyebrow">Механика</span>
        <h2 id="vnedrenie-h2">Как работает внедрение AI производство контроль: от смены до отчёта</h2>
        <p>Поэтапная сборка контура <strong>данные → правила → агент → отчёт</strong> с человеком на критичных точках.</p>
      </div>

      <div class="apkp-table-wrap nero-ai-reveal" style="margin-bottom:28px;">
        <table class="apkp-table">
          <thead><tr><th>Источник</th><th>Что даёт</th><th>Когда достаточно</th></tr></thead>
          <tbody>
            <tr><td>Планшет / PWA в цехе</td><td>старт/стоп, причины простоя</td><td><strong>минимум для старта</strong></td></tr>
            <tr><td>Telegram-бот смены</td><td>задания, быстрые отметки</td><td>цех без терминалов</td></tr>
            <tr><td>API 1С / Google Sheets</td><td>заказы, номенклатура</td><td>есть учёт, нет цехового слоя</td></tr>
            <tr><td>Датчики / ЧПУ</td><td>факт без ручного ввода</td><td>второй этап</td></tr>
          </tbody>
        </table>
      </div>

      <div class="apkp-callout nero-ai-reveal">
        <p>Gartner (25.06.2025): <strong>более 40% проектов agentic AI будут отменены к концу 2027</strong> — из‑за неясного ROI и слабого risk control.</p>
        <cite>— Anushree Verma, Gartner: «большинство проектов сейчас — ранние эксперименты или PoC, часто driven by hype»</cite>
      </div>

      <div class="apkp-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="apkp-card">
          <h3>Human-in-the-loop</h3>
          <ul>
            <li>узкий MVP: одна линия, KPI смены;</li>
            <li>мастер утверждает план и причины простоя;</li>
            <li>аудит: кто подтвердил решение агента — в логе;</li>
            <li>измеримый CTA: <strong>«найти простои»</strong>, не hype.</li>
          </ul>
        </div>
        <div class="apkp-card">
          <h3>Дашборд производства в MVP</h3>
          <ul>
            <li>план/факт по смене и неделе;</li>
            <li>карта потерь по категориям простоев;</li>
            <li>drill-down: участок → операция → причина;</li>
            <li>Q&A для мастера на естественном языке.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- #dlya-kogo -->
  <section class="apkp-section apkp-section-alt" id="dlya-kogo" aria-labelledby="dlya-kogo-h2">
    <div class="apkp-cnt">
      <div class="apkp-sh nero-ai-reveal">
        <span class="apkp-eyebrow">Целевая аудитория</span>
        <h2 id="dlya-kogo-h2">Для кого подходит: мебель, пищевое производство и малые цеха</h2>
        <p>Малые и средние цеха <strong>10–200 сотрудников</strong> — где <strong>внедрение ai для малого производства</strong> упиралось в цену MES.</p>
      </div>

      <div class="apkp-grid-2 nero-ai-reveal">
        <div class="apkp-card">
          <h3>Когда достаточно лёгкого решения без MES/SCADA</h3>
          <ul>
            <li>сменные задания в Excel/на бумаге;</li>
            <li>1С ведёт учёт, но нет ранних алертов;</li>
            <li>простои узнаёте в конце смены;</li>
            <li>нет штатного программиста, но есть мастер с планшетом.</li>
          </ul>
        </div>
        <div class="apkp-card">
          <h3>AI для мебельного и пищевого производства</h3>
          <p>Множество РЦ, сменные наряды, чувствительность к материалу и переналадке, сезонные пики. По обзору ERP vs MES (bpadevelop.ru, 2026): для <strong>&lt;50 человек</strong> часто хватает ERP с базовым модулем.</p>
        </div>
      </div>

      <div class="apkp-compare-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apkp-compare">
          <thead><tr><th>Критерий</th><th>Excel / бумага</th><th>MES / ПУП на 1С</th><th class="apkp-col-agent">AI-агент Nero</th></tr></thead>
          <tbody>
            <tr><td>Сменные задания</td><td>вручную</td><td>автоматизированы</td><td class="apkp-col-agent">автомат + <strong>пересборка агентом</strong></td></tr>
            <tr><td>Учёт простоев</td><td>постфактум</td><td>по регламенту</td><td class="apkp-col-agent"><strong>ранняя фиксация + алерты</strong></td></tr>
            <tr><td>Отчёт директору</td><td>сводка мастера</td><td>дашборды MES</td><td class="apkp-col-agent"><strong>NL-сводка + дашборд</strong></td></tr>
            <tr><td>Порог входа</td><td>₽0, скрытые потери</td><td>от ~1 млн ₽</td><td class="apkp-col-agent">пилот <strong>500 тыс.–2 млн ₽</strong></td></tr>
            <tr><td>Срок до пользы</td><td>—</td><td>месяцы</td><td class="apkp-col-agent"><strong>4–8 нед.</strong></td></tr>
            <tr><td>Нужны датчики</td><td>нет</td><td>часто да</td><td class="apkp-col-agent"><strong>нет для старта</strong></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- #etapy -->
  <section class="apkp-section" id="etapy" aria-labelledby="etapy-h2">
    <div class="apkp-cnt">
      <div class="apkp-sh nero-ai-reveal">
        <span class="apkp-eyebrow">Под ключ</span>
        <h2 id="etapy-h2">Внедрение AI-агентов на производстве под ключ: этапы и сроки</h2>
      </div>

      <div class="apkp-timeline nero-ai-reveal">
        <div class="apkp-tl-item" id="etap-audit">
          <div class="apkp-tl-dot"></div>
          <h3>Аудит сменных процессов и карта потерь (лид-магнит)</h3>
          <p><strong>Фаза 0 (1–2 нед.):</strong> как сейчас — Excel, бумага, 1С УНФ; список РЦ и причин простоев; оценка стоимости часа простоя. Результат — <strong>«Карта потерь производства»</strong> (бесплатно на консультации).</p>
        </div>
      </div>

      <!-- CTA-1 Артура: после аудита -->
      <div class="ym-cta-block ym-cta-block--primary" id="cta-karta-poter">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Получить карту потерь производства — бесплатно на этапе аудита</p>
          <p class="ym-cta-block__sub">За 1–2 недели разберём, как вы ведёте смены: Excel, 1С, бумага. Покажем, где теряете время и деньги на простоях — до покупки софта и без обязательств по внедрению.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        </div>
      </div>

      <div class="apkp-timeline nero-ai-reveal" style="margin-top:32px;">
        <div class="apkp-tl-item">
          <div class="apkp-tl-dot"></div>
          <h3>Пилот на одной линии или участке</h3>
          <p><strong>Фаза 1 (2–4 нед.):</strong> цифровые сменные задания, фиксация простоев с планшета/Telegram, базовые алерты. <strong>Фаза 2 (2–4 нед.):</strong> AI-агент — сводка смены, NL-отчёт, интеграция с 1С/Google Sheets.</p>
        </div>
      </div>

      <div class="apkp-table-wrap nero-ai-reveal" style="margin:32px 0;">
        <table class="apkp-table apkp-day-table">
          <thead><tr><th>Время</th><th>Без агента</th><th>С AI-агентом</th></tr></thead>
          <tbody>
            <tr><td>06:00</td><td>сводка в Excel, 1–2 часа</td><td class="apkp-row-highlight">агент прислал черновик смены, 15–20 мин</td></tr>
            <tr><td>10:30</td><td>узнал о простое «сам догадался»</td><td class="apkp-row-highlight">push: простой &gt;15 мин, причина обязательна</td></tr>
            <tr><td>14:00</td><td>срочный заказ — пересчёт вручную</td><td class="apkp-row-highlight">агент пересобрал участок, мастер утвердил</td></tr>
            <tr><td>18:00</td><td>сводка в Excel</td><td class="apkp-row-highlight">отчёт директору: план/факт, ТОП-3 потери</td></tr>
          </tbody>
        </table>
      </div>

      <div class="apkp-timeline nero-ai-reveal" id="etap-masshtab">
        <div class="apkp-tl-item">
          <div class="apkp-tl-dot"></div>
          <h3>Масштабирование и обучение смен</h3>
          <p><strong>Фаза 3:</strong> другие участки, опционально OEE и телеметрия. <strong>15–20% бюджета</strong> — на «живую» эксплуатацию (cheaz.ru). <strong>Ai производство контроль под ключ</strong> = аудит + пилот + масштаб + обучение.</p>
        </div>
      </div>

      <!-- CTA-2 Артура: после масштабирования -->
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать agentic AI до пилота на участке?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI на производстве полезно разобраться в human-in-the-loop, интеграциях с 1С и сценариях пилота без hype — это ускоряет согласование с мастером и директором. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#'); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'материалы Nero Network'); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- #ceny -->
  <section class="apkp-section apkp-section-alt" id="ceny" aria-labelledby="ceny-h2">
    <div class="apkp-cnt">
      <div class="apkp-sh nero-ai-reveal">
        <span class="apkp-eyebrow">Экономика</span>
        <h2 id="ceny-h2">Сколько стоит и какой эффект: цена внедрения AI и окупаемость</h2>
      </div>

      <div class="apkp-grid-2 nero-ai-reveal">
        <div class="apkp-card">
          <h3>Из чего складывается стоимость</h3>
          <ul>
            <li>число РЦ и смен;</li>
            <li>интеграции (1С, CRM, Telegram, планшеты);</li>
            <li>телеметрия и on-prem LLM (152-ФЗ);</li>
            <li>поддержка и справочники причин простоя.</li>
          </ul>
          <p>Ориентир Nero Network: <strong>500 тыс.–2 млн ₽</strong> за проект с пилотом на одном участке.</p>
        </div>
        <div class="apkp-card">
          <h3>Ценовые якоря рынка</h3>
          <ul>
            <li><strong>PartnerSoft MES на 1С</strong> — от ~1 млн ₽;</li>
            <li><strong>Zool.ai</strong> (CV) — от ~870 тыс. ₽/год;</li>
            <li><strong>CNC Pulse</strong> — от 500 ₽/мес./станок.</li>
          </ul>
          <p><strong>Сколько стоит ai производство контроль</strong> конкретно — после аудита.</p>
        </div>
      </div>

      <div class="apkp-card nero-ai-reveal" style="margin-top:28px;">
        <h3>OEE и снижение скрытых простоев — методология без выдуманных цифр</h3>
        <p><strong>OEE производство</strong> в MVP: <strong>доступность × выполнение плана смены</strong>. Методология:</p>
        <ol style="padding-left:1.2em;color:var(--apkp-muted);line-height:1.72;">
          <li>Базовая линия 2–4 недели: все простои с причинами.</li>
          <li>Стоимость часа — по отрасли (inner.su) или gross margin.</li>
          <li>Эффект = раннее обнаружение + меньше ручного времени мастера + устранение повторяющихся причин.</li>
        </ol>
        <p>Пример: пищевой цех теряет <strong>1 час в день</strong> незамеченного простоя по материалу → зона внимания <strong>1,5–3 млн ₽/мес.</strong> Реальная экономия — доля, которую вы увидите в карте потерь.</p>
      </div>
    </div>
  </section>

  <!-- #keisy -->
  <section class="apkp-section" id="keisy" aria-labelledby="keisy-h2">
    <div class="apkp-cnt">
      <div class="apkp-sh nero-ai-reveal">
        <span class="apkp-eyebrow">Кейсы</span>
        <h2 id="keisy-h2">Кейсы и примеры внедрения AI-контроля на производстве</h2>
        <p>Прямых публичных кейсов «agentic AI = сменные задания + простои на малом цехе» в РФ <strong>мало</strong>. Ниже — смежные примеры и проектная модель Nero (помечена отдельно).</p>
      </div>

      <div class="apkp-card nero-ai-reveal" style="margin-bottom:28px;">
        <h3>Проектная модель Nero Network (не публичный кейс)</h3>
        <ul>
          <li>Клиент: мебельный цех, ~35 человек, 1С:УНФ + Excel.</li>
          <li>MVP: Telegram-бот + планшет; справочник из 12 причин простоя.</li>
          <li>AI: ежесменный отчёт, алерт при простое &gt;20 мин без материала.</li>
          <li><strong>Ai производство контроль без программиста</strong> на стороне клиента.</li>
        </ul>
      </div>

      <div class="apkp-table-wrap nero-ai-reveal">
        <table class="apkp-table">
          <thead><tr><th>Кейс</th><th>Что близко теме</th><th>Ограничение</th></tr></thead>
          <tbody>
            <tr><td><strong>КитМон</strong></td><td>AI «почему станок простаивал», OEE</td><td>фокус на ЧПУ и телеметрии</td></tr>
            <tr><td><strong>Зинин × Штурбин</strong></td><td>AI-планирование, human-in-the-loop</td><td>планирование, не полный учёт простоев</td></tr>
            <tr><td><strong>Иж-Рэст / Zool.ai</strong></td><td>−15–20% простоев, статистика смен</td><td>видеоаналитика</td></tr>
            <tr><td><strong>1С «Завод на автопилоте»</strong></td><td>авто-сменные задания</td><td>без AI-агента</td></tr>
            <tr><td><strong>Bosch Shopfloor Agent</strong></td><td>агент при остановке линии</td><td>enterprise</td></tr>
            <tr><td><strong>RapidCanvas</strong></td><td>пересборка расписания за минуты</td><td>текстиль, 300 станков</td></tr>
          </tbody>
        </table>
      </div>

      <div class="apkp-callout nero-ai-reveal" style="margin-top:28px;">
        <p>Три риска agentic AI: <strong>hype вместо KPI</strong>, автономия без ответственности, пилот без продакшена. Nero закрывает их узким MVP, human-in-the-loop и 15–20% бюджета на эксплуатацию.</p>
      </div>
    </div>
  </section>

  <!-- #faq -->
  <section class="apkp-section apkp-section-alt" id="faq" aria-labelledby="faq-h2">
    <div class="apkp-cnt">
      <div class="apkp-sh nero-ai-reveal">
        <span class="apkp-eyebrow">FAQ</span>
        <h2 id="faq-h2">FAQ: внедрение AI на производстве — ответы на частые вопросы</h2>
      </div>

      <div class="apkp-faq nero-ai-reveal" data-apkp-faq>
        <div class="apkp-faq-item">
          <div class="apkp-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai производство контроль без программиста?</div>
          <div class="apkp-faq-a"><p>Три шага: <strong>аудит</strong> → <strong>пилот на одном участке</strong> (планшет/Telegram + справочник простоев) → <strong>подключение AI-отчётов</strong>. Техническую часть берёт Nero; от вас — мастер, доступ к 1С/таблице, согласование справочника причин.</p></div>
        </div>
        <div class="apkp-faq-item">
          <div class="apkp-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли интеграция с CRM или достаточно 1С?</div>
          <div class="apkp-faq-a"><p>Для производства первичен источник заказов — чаще <strong>1С:УНФ/ERP</strong> или Google Sheets. CRM — опционально, если заказ рождается там и не попадает в 1С.</p></div>
        </div>
        <div class="apkp-faq-item">
          <div class="apkp-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-агент отличается от готовой MES?</div>
          <div class="apkp-faq-a"><p>MES структурирует учёт. AI-агент добавляет пересборку смены при сбое, ранние алерты, текстовый отчёт и Q&A для мастера. Связка <strong>1С + AI-агент</strong> — типовой паттерн.</p></div>
        </div>
        <div class="apkp-faq-item">
          <div class="apkp-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли датчики на старте?</div>
          <div class="apkp-faq-a"><p><strong>Нет.</strong> Старт — планшет или Telegram и дисциплина причин простоя. Телеметрия — второй контур.</p></div>
        </div>
        <div class="apkp-faq-item">
          <div class="apkp-faq-q" role="button" tabindex="0" aria-expanded="false">Заменит ли AI-агент 1С?</div>
          <div class="apkp-faq-a"><p><strong>Нет.</strong> Агент убирает ручной пересчёт смен и позднюю фиксацию простоев. Заказы, остатки, зарплата — в ERP.</p></div>
        </div>
        <div class="apkp-faq-item">
          <div class="apkp-faq-q" role="button" tabindex="0" aria-expanded="false">Кто утверждает решения агента?</div>
          <div class="apkp-faq-a"><p><strong>Мастер</strong> — план и причины простоя. <strong>Начальник производства</strong> — приоритеты. <strong>Директор</strong> — стратегические изменения. Финальная ответственность — у человека.</p></div>
        </div>
        <div class="apkp-faq-item">
          <div class="apkp-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько длится пилот?</div>
          <div class="apkp-faq-a"><p>Обычно <strong>4–8 недель</strong>: 2–4 нед. MVP + 2–4 нед. AI-слой. Зависит от числа РЦ и интеграций.</p></div>
        </div>
        <div class="apkp-faq-item">
          <div class="apkp-faq-q" role="button" tabindex="0" aria-expanded="false">Как считается oee производство в системе?</div>
          <div class="apkp-faq-a"><p>Упрощённо: <strong>доступность</strong> × <strong>выполнение плана смены</strong>. Полный OEE — на этапе масштабирования.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- #konsultaciya -->
  <section class="apkp-section" id="konsultaciya" aria-labelledby="konsultaciya-h2">
    <div class="apkp-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal">
        <span class="apkp-eyebrow">CTA</span>
        <h2 id="konsultaciya-h2" class="ym-cta-block__headline" style="margin-top:12px;">Найти простои на вашем производстве — бесплатная карта потерь и консультация</h2>
        <p class="ym-cta-block__sub">Если <strong>задачи меняются вручную, простои фиксируются поздно</strong> — вы не один такой. Nero Network внедряет AI-агент для сменных заданий и контроля простоев под ключ: от аудита до пилота с human-in-the-loop.</p>
        <ul class="apkp-cta-checklist">
          <li>разбор контура: Excel, 1С, бумага</li>
          <li>черновик карты потерь по РЦ</li>
          <li>бюджет 500 тыс.–2 млн ₽ без навязанной MES</li>
          <li>roadmap: аудит → пилот → AI-отчёты → масштаб</li>
        </ul>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить карту потерь производства</a>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost"<?php echo $primary_cta_attrs; ?>>Заказать ai производство контроль</a>
        </div>
        <p class="ym-cta-block__sub" style="margin-top:24px;margin-bottom:0;font-size:14px;">Сменное задание → факт → простой с причиной → отчёт директору. Начните с узкого сценария, который можно измерить уже в первую смену.</p>
      </div>

      <!-- AD_BANNER: вставить перед footer если AD_BANNER_URL и AD_BANNER_IMAGE_URL заданы в env -->
      <?php if (getenv('AD_BANNER_URL') && getenv('AD_BANNER_IMAGE_URL')) : ?>
      <div class="nero-ai-reveal" style="margin-top:32px;text-align:center;">
        <a href="<?php echo esc_url(getenv('AD_BANNER_URL')); ?>" target="_blank" rel="noopener noreferrer">
          <img src="<?php echo esc_url(getenv('AD_BANNER_IMAGE_URL')); ?>" width="970" height="90" alt="<?php echo esc_attr(getenv('AD_BANNER_ALT') ?: 'Партнёр'); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;box-shadow:0 8px 28px rgba(0,0,0,.25);">
        </a>
      </div>
      <?php endif; ?>
    </div>
  </section>

</div><!-- /.apkp-content -->

<script>
/* FAQ accordion */
(function(){
  document.querySelectorAll('[data-apkp-faq] .apkp-faq-q').forEach(function(q){
    q.addEventListener('click',function(){var item=q.parentElement;var open=item.classList.contains('open');item.parentElement.querySelectorAll('.apkp-faq-item').forEach(function(i){i.classList.remove('open');i.querySelector('.apkp-faq-q').setAttribute('aria-expanded','false');});if(!open){item.classList.add('open');q.setAttribute('aria-expanded','true');}});
    q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();q.click();}});
  });
})();
</script>

  <!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * apkp-prostoiev-hero-engine — «Диспетчерская сменного контроля»
 * Мир: EventPulseRail → ShiftCommandBridge → DowntimeAlertBeacon → TelegramReportBurst
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("apkp-prostoiev-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  var LOOP = 240;

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
    outline: "#64748b",
    panel: "#0f172a",
    panelEdge: "#1e293b",
    gold: "#f5c518",
    amber: "#f59e0b",
    cyan: "#79f2ff",
    green: "#22c55e",
    red: "#ef4444",
    tagBlue: "#dbeafe",
    tagGreen: "#d1fae5",
    tagAmber: "#fef3c7",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
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
    if (stroke) {
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Горизонтальная лента импульсов событий — вместо Conveyor */
  function EventPulseRail() {
    this.pulses = [
      { offset: 0, color: C.tagGreen, label: "✓" },
      { offset: 55, color: C.tagAmber, label: "!" },
      { offset: 110, color: C.tagBlue, label: "→" },
      { offset: 165, color: C.cyan, label: "TG" }
    ];
  }
  EventPulseRail.prototype.draw = function (ctx) {
    var y = 72;
    drawRR(ctx, -175, y, 350, 14, 7, "rgba(30,41,59,0.75)", C.outline);
    var offset = (frame * 0.55) % 350;
    this.pulses.forEach(function (p) {
      var px = -165 + ((frame * 0.55 + p.offset) % 330);
      ctx.fillStyle = p.color;
      ctx.beginPath();
      ctx.arc(px, y + 7, 5, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1;
      ctx.stroke();
      ctx.fillStyle = C.outline;
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(p.label, px, y + 9);
    });
    ctx.fillStyle = C.gold;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Лента событий смены", -165, y - 6);
  };

  /* Очередь сменных нарядов слева */
  function WorkOrderTagQueue() {}
  WorkOrderTagQueue.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % LOOP;
    drawRR(ctx, -168, -58, 36, 88, 5, "rgba(15,23,42,0.85)", C.outline);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Наряды", -150, -50);
    var tags = ["РЦ-1", "РЦ-2", "Сбор"];
    tags.forEach(function (t, i) {
      var pop = prg > 8 + i * 12 ? Math.min(1, (prg - 8 - i * 12) / 10) : 0;
      if (pop <= 0) return;
      ctx.globalAlpha = pop;
      drawRR(ctx, -162, -42 + i * 22, 28, 16, 3, i === 0 ? C.tagGreen : C.tagBlue, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText(t, -148, -30 + i * 22);
      ctx.globalAlpha = 1;
    });
  };

  /* Центральный мост план/факт — вместо WebsiteTerminal */
  function ShiftCommandBridge() {
    this.planFill = 0;
    this.downtimeFlash = 0;
  }
  ShiftCommandBridge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % LOOP;
    drawRR(ctx, -55, -72, 130, 118, 10, C.panel, C.panelEdge);

    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("План / факт смены", -45, -58);

    /* Полоса плана */
    var planW = prg < 70 ? (prg / 70) * 96 : 96;
    drawRR(ctx, -45, -48, 100, 10, 3, "rgba(255,255,255,0.08)", null);
    drawRR(ctx, -45, -48, planW, 10, 3, "rgba(34,197,94,0.55)", null);
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.fillText("87%", 60, -40);

    /* Блок простоя — фаза 2 */
    if (prg >= 72) {
      this.downtimeFlash = prg >= 72 && prg < 145 ? 0.5 + Math.sin(frame * 0.18) * 0.35 : 0;
      ctx.globalAlpha = 0.35 + this.downtimeFlash;
      drawRR(ctx, -45, -28, 100, 22, 4, "rgba(245,158,11,0.35)", C.amber);
      ctx.globalAlpha = 1;
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Простой 12 мин · материал", -42, -14);
    }

    /* Мини-график OEE */
    if (prg >= 120) {
      drawRR(ctx, -45, 8, 100, 28, 4, "rgba(121,242,255,0.08)", C.cyan);
      ctx.strokeStyle = C.cyan;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      for (var i = 0; i < 8; i++) {
        var gx = -40 + i * 12;
        var gy = 30 - (0.55 + Math.sin(i * 0.9 + frame * 0.04) * 0.15) * 18;
        if (i === 0) ctx.moveTo(gx, gy);
        else ctx.lineTo(gx, gy);
      }
      ctx.stroke();
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("OEE 76%", -42, 22);
    }
  };

  /* Маяк простоя — уникальный объект темы */
  function DowntimeAlertBeacon() {
    this.ring = 0;
  }
  DowntimeAlertBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % LOOP;
    if (prg < 68 || prg > 150) return;
    var bx = 92, by = -18;
    this.ring = (prg - 68) / 82;
    ctx.strokeStyle = "rgba(245,158,11," + (0.4 - this.ring * 0.35) + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(bx, by, 8 + this.ring * 22, 0, Math.PI * 2);
    ctx.stroke();
    drawRR(ctx, bx - 8, by - 14, 16, 22, 4, C.amber, C.outline);
    ctx.fillStyle = "#451a03";
    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("!", bx, by + 2);
  };

  /* Дуга OEE справа */
  function OeeArcGauge() {
    this.angle = 0;
  }
  OeeArcGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % LOOP;
    if (prg < 115) return;
    var ax = 118, ay = 28, r = 22;
    ctx.strokeStyle = "rgba(255,255,255,0.1)";
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.arc(ax, ay, r, Math.PI * 0.75, Math.PI * 2.25);
    ctx.stroke();
    this.angle = 0.76 * (Math.PI * 1.5);
    ctx.strokeStyle = C.green;
    ctx.beginPath();
    ctx.arc(ax, ay, r, Math.PI * 0.75, Math.PI * 0.75 + this.angle);
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("76%", ax, ay + 4);
  };

  /* Планшет отметки оператора */
  function TabletCheckInPod() {
    this.tap = 0;
  }
  TabletCheckInPod.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % LOOP;
    if (prg < 78 || prg > 138) return;
    var tx = -95, ty = 38;
    drawRR(ctx, tx, ty, 34, 48, 5, "#1e293b", C.outline);
    drawRR(ctx, tx + 4, ty + 6, 26, 30, 3, "#0f172a", null);
    ctx.fillStyle = C.amber;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Причина", tx + 17, ty + 18);
    ctx.fillText("материал", tx + 17, ty + 28);
    if (prg > 95 && prg < 105) {
      this.tap = 1;
      ctx.strokeStyle = C.green;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(tx + 17, ty + 42, 6, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* Финал: отчёт в Telegram — вместо ракеты/ZIP */
  function TelegramReportBurst() {
    this.y = 0;
    this.alpha = 0;
  }
  TelegramReportBurst.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % LOOP;
    if (prg < 175) return;
    var local = (prg - 175) / 65;
    this.y = -20 - local * 55;
    this.alpha = local < 0.75 ? local / 0.75 : 1 - (local - 0.75) / 0.25;
    ctx.save();
    ctx.globalAlpha = Math.max(0, this.alpha);
    drawRR(ctx, 8, this.y, 52, 36, 8, "rgba(56,189,248,0.25)", C.cyan);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Отчёт", 34, this.y + 14);
    ctx.fillText("директору", 34, this.y + 24);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillText("Telegram ✓", 34, this.y + 34);
    ctx.restore();
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
    var prg = (frame * 0.042) % LOOP;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -120, y: -20 },
      "2_seo": { x: -15, y: -55 },
      "3_coder": { x: -78, y: 48 },
      "4_designer": { x: 20, y: -55 },
      "5_deployer": { x: 55, y: 42 }
    };
    var tgt = targets[this.role] || { x: 0, y: 0 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 15) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 15) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 15) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.5) * 1;
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -10, -8 - bob, 20, 14, 4, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -18 - bob, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    if (carryType) {
      drawRR(ctx, -14, -22 - bob, 12, 12, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new EventPulseRail());
  entities.push(new WorkOrderTagQueue());
  entities.push(new ShiftCommandBridge());
  entities.push(new DowntimeAlertBeacon());
  entities.push(new OeeArcGauge());
  entities.push(new TabletCheckInPod());
  entities.push(new TelegramReportBurst());

  entities.push(new Agent(-145, 55, C.agentYellow, "1_architect", 12, [
    "Смену пересобрал из 1С",
    "Черновик готов мастеру",
    "Заказы подтянул автоматом"
  ]));
  entities.push(new Agent(-155, -35, C.agentGreen, "2_seo", 38, [
    "Приоритеты РЦ расставил",
    "Срочный заказ — в план",
    "Пересборка за 3 минуты"
  ]));
  entities.push(new Agent(-125, 18, C.agentBlue, "3_coder", 78, [
    "Простой 15 мин — фиксирую",
    "Причина: нет материала",
    "3 тапа на планшете"
  ]));
  entities.push(new Agent(95, -42, C.agentPink, "4_designer", 108, [
    "План утверждён мастером",
    "Human-in-the-loop ✓",
    "Причину простоя подтвердил"
  ]));
  entities.push(new Agent(130, 8, C.agentPurple, "5_deployer", 168, [
    "Отчёт директору готов",
    "ТОП-3 потери в Telegram",
    "NL-сводка на русском"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 240, maxLife: customLife || 240 });
  }

  function engineLoop() {
    frame++;
    var prg = (frame * 0.042) % LOOP;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    if (prg >= 14 && prg < 14.08) createBubble(-120, -35, "1. Сбор смены");
    if (prg >= 74 && prg < 74.08) createBubble(-15, -65, "2. Алерт простоя");
    if (prg >= 108 && prg < 108.08) createBubble(20, -65, "3. Причина подтверждена");
    if (prg >= 178 && prg < 178.08) createBubble(55, 30, "4. Отчёт директору");

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


<script>
(function(){
  'use strict';
  var root = document.querySelector('.apkp-page') || document.querySelector('.apkp-content');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if (entry.isIntersecting) {
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

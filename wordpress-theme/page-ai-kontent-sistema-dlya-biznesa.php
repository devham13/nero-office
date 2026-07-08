<?php
/**
 * Template Name: AI-контент-система для бизнеса: внедрение под ключ
 * Description: AI-контент для бизнеса — темы, тексты, посты, рассылки и изображения в едином стиле. Внедрение под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-контент для бизнеса: внедрение системы под ключ';
$page_seo_description = 'Настроим AI-систему контента для бизнеса: темы, тексты, посты, рассылки и изображения в едином стиле. Внедрение под ключ — от консультации до контроля качества. Для блога, SEO и соцсетей.';

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
    ['label' => 'Система', 'href' => '#chto-takoe-sistema'],
    ['label' => 'Состав', 'href' => '#sostav-sistemy'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Настроить AI-контент';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#chto-takoe-sistema';

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
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

.akcs-content{
  --akcs-text:#e6edf7;--akcs-muted:#9aa8bd;--akcs-soft:#c7d2e5;--akcs-heading:#fff;
  --akcs-border:rgba(255,255,255,.10);--akcs-accent:#79f2ff;--akcs-violet:#8b5cf6;--akcs-green:#22c55e;
  --akcs-btn-from:#2563eb;--akcs-btn-to:#7c3aed;--akcs-container:1220px;
}
.akcs-content *,.akcs-content *::before,.akcs-content *::after{box-sizing:border-box}
.akcs-content a{color:inherit}
.akcs-content p{color:var(--akcs-muted);line-height:1.72;margin:0 0 1em}
.akcs-content p:last-child{margin-bottom:0}
.akcs-content h2,.akcs-content h3,.akcs-content h4{color:var(--akcs-heading);letter-spacing:-.045em;margin:0 0 .7em}
.akcs-content h3{font-size:clamp(17px,2vw,21px)}
.akcs-content strong{color:var(--akcs-soft)}
.akcs-content ul,.akcs-content ol{padding-left:0;list-style:none;margin:0 0 1em}
.akcs-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--akcs-muted);font-size:14.5px;line-height:1.65}
.akcs-content ul li::before{content:'›';position:absolute;left:0;color:var(--akcs-accent);font-weight:700}
.akcs-content ol.akcs-ol{counter-reset:akcsli}
.akcs-content ol.akcs-ol li{counter-increment:akcsli;padding-left:28px}
.akcs-content ol.akcs-ol li::before{content:counter(akcsli);font-size:11px;font-weight:800;color:var(--akcs-accent);left:0;top:1px}
.akcs-cnt{width:min(var(--akcs-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.akcs-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.akcs-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.akcs-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.akcs-sh.akcs-left{margin-left:0;text-align:left}
.akcs-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.akcs-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.akcs-sh.akcs-left p{margin-left:0}
.akcs-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--akcs-accent);margin-bottom:14px}
.akcs-gt{background:linear-gradient(92deg,#fff 0%,var(--akcs-accent) 44%,var(--akcs-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.akcs-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.akcs-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.akcs-intro-text{position:relative;padding-left:20px;text-align:left!important}
.akcs-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--akcs-accent),var(--akcs-violet))}
.akcs-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--akcs-muted);margin-bottom:1em}
.akcs-intro-text p:last-child{margin-bottom:0;color:var(--akcs-soft)}
.akcs-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.akcs-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.akcs-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--akcs-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.akcs-kpi-card .kl{font-size:11px;font-weight:600;color:var(--akcs-muted);line-height:1.4}
.akcs-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.akcs-intro-grid{grid-template-columns:1fr;gap:36px}.akcs-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.akcs-intro-kpi{grid-template-columns:1fr 1fr}}
.akcs-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.akcs-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.akcs-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.06);border:1px solid var(--akcs-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--akcs-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.akcs-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--akcs-accent);background:rgba(121,242,255,.08)}
.akcs-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--akcs-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);transition:border-color .22s,transform .22s}
.akcs-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.akcs-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.akcs-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.akcs-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
@media(max-width:960px){.akcs-grid-3,.akcs-grid-4{grid-template-columns:1fr 1fr}}
@media(max-width:768px){.akcs-grid-2,.akcs-grid-3,.akcs-grid-4{grid-template-columns:1fr}}
.akcs-pain-card{text-align:center;padding:22px 16px}
.akcs-pain-card .ico{font-size:28px;margin-bottom:10px}
.akcs-pain-card h3{font-size:15px;margin-bottom:8px}
.akcs-pain-card p{font-size:13px;margin:0}
.akcs-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.akcs-table{width:100%;border-collapse:collapse;font-size:14px}
.akcs-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--akcs-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.akcs-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--akcs-text);vertical-align:top}
.akcs-table tr:last-child td{border-bottom:none}
.akcs-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.akcs-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--akcs-accent);border:1px solid rgba(121,242,255,.2)}
.akcs-flow .arr{color:var(--akcs-muted);font-size:16px;padding:0 4px;background:none;border:none}
.akcs-timeline{position:relative;padding-left:40px}
.akcs-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--akcs-accent),var(--akcs-violet));opacity:.35;border-radius:2px}
.akcs-tl-item{position:relative;margin-bottom:32px}
.akcs-tl-item:last-child{margin-bottom:0}
.akcs-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--akcs-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.akcs-case-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}
@media(max-width:768px){.akcs-case-grid{grid-template-columns:1fr}}
.akcs-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px}
.akcs-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--akcs-green);margin-bottom:10px}
.akcs-price-badge{display:inline-flex;align-items:center;gap:10px;padding:12px 22px;border-radius:999px;background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.35);color:#bbf7d0;font-weight:800;font-size:15px;margin:20px 0}
.akcs-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.akcs-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.akcs-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--akcs-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.akcs-faq-q::after{content:'▾';font-size:13px;color:var(--akcs-accent);flex-shrink:0;transition:transform .25s}
.akcs-faq-item.open .akcs-faq-q::after{transform:rotate(180deg)}
.akcs-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--akcs-muted);line-height:1.72}
.akcs-faq-item.open .akcs-faq-a{max-height:900px;padding:0 24px 20px}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--akcs-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-link--accent{color:var(--akcs-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--akcs-btn-from),var(--akcs-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-kontent-sistema-dlya-biznesa-page" role="main" tabindex="-1">

<section class="nero-ai-hero akcs-hero-content" id="akcs-hero" aria-labelledby="akcs-hero-title">
<style>
/* === AKCS HERO — самодостаточные стили (премиум .nero-ai-home-page) === */
.akcs-hero-content {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.akcs-hero-content::before {
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
  z-index: -2;
}
.akcs-hero-content .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.akcs-hero-content .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.akcs-hero-content .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: #79f2ff !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.akcs-hero-content h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 6vw, 72px);
  line-height: 1.02;
  letter-spacing: -0.05em;
  color: #ffffff;
  font-weight: 800;
}
.akcs-hero-content .nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, #79f2ff 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.akcs-hero-content .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: #c7d2e5 !important;
  font-size: clamp(17px, 2vw, 21px);
  line-height: 1.58;
}
.akcs-hero-content .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.akcs-hero-content .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.akcs-hero-content .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 34px;
}
.akcs-hero-content .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 20px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  text-decoration: none !important;
  transition: transform .22s ease, box-shadow .22s ease;
}
.akcs-hero-content .nero-ai-btn:hover { transform: translateY(-2px); }
.akcs-hero-content .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, #79f2ff, #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.akcs-hero-content .nero-ai-btn-secondary {
  color: #e6edf7 !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.akcs-hero-content .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.akcs-hero-content .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.akcs-hero-content .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.akcs-hero-content .nero-ai-dots { display: flex; gap: 7px; }
.akcs-hero-content .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.akcs-hero-content .nero-ai-dot:nth-child(1) { background: #fb7185; }
.akcs-hero-content .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.akcs-hero-content .nero-ai-dot:nth-child(3) { background: #34d399; }
.akcs-hero-content .nero-ai-window-title {
  font-size: 11px;
  color: #64748b;
  font-weight: 600;
}
.akcs-hero-content .nero-ai-window-body { padding: 16px; }
.akcs-hero-content .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.akcs-hero-content .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  color: #fff;
  letter-spacing: -0.03em;
}
.akcs-hero-content .nero-ai-live-pill {
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
.akcs-hero-content .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: akcsPulse 1.6s infinite;
}
@keyframes akcsPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.akcs-hero-content .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.akcs-hero-content .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.akcs-hero-content .nero-ai-metric span {
  display: block;
  color: #9aa8bd;
  font-size: 11px;
  font-weight: 700;
}
.akcs-hero-content .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.akcs-hero-content .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.akcs-hero-content .akcs-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 35%, rgba(139,92,246,.10), rgba(6,10,24,.92) 72%);
}
.akcs-hero-content #akcs-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.akcs-hero-content .nero-ai-task-stream { display: grid; gap: 8px; }
.akcs-hero-content .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  font-size: 12px;
}
.akcs-hero-content .nero-ai-task-icon {
  width: 28px;
  height: 28px;
  border-radius: 8px;
  background: rgba(121,242,255,.12);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 800;
  color: #79f2ff;
}
.akcs-hero-content .nero-ai-task strong {
  display: block;
  color: #fff;
  font-size: 12px;
}
.akcs-hero-content .nero-ai-task span {
  color: #9aa8bd;
  font-size: 11px;
}
.akcs-hero-content .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 800;
  background: rgba(34,197,94,.15);
  color: #86efac;
}
.akcs-hero-content .nero-ai-status--amber {
  background: rgba(245,158,11,.15);
  color: #fcd34d;
}
@media (max-width: 960px) {
  .akcs-hero-content .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .akcs-hero-content .nero-ai-dashboard { transform: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · AI-контент для бизнеса</p>
      <h1 id="akcs-hero-title">AI-контент-система для бизнеса: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Единый стиль, регулярные тексты, посты, рассылки и изображения — без ручной рутины и разрозненных подрядчиков</p>
      <ul class="nero-ai-badges" aria-label="Модули системы">
        <li class="nero-ai-badge">Контент-план</li>
        <li class="nero-ai-badge">Блог/SEO</li>
        <li class="nero-ai-badge">Соцсети</li>
        <li class="nero-ai-badge">Email</li>
        <li class="nero-ai-badge">Визуал</li>
        <li class="nero-ai-badge">QA</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#chto-takoe-sistema">Как устроена система</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-контент-конвейера">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-контент-конвейер · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Публикаций / нед</span>
              <strong>24</strong>
              <small>блог + VK + email</small>
            </div>
            <div class="nero-ai-metric">
              <span>TTM идея → пост</span>
              <strong>−70%</strong>
              <small>vs ручной цикл</small>
            </div>
            <div class="nero-ai-metric">
              <span>Единый ToV</span>
              <strong>RAG</strong>
              <small>архив бренда 18 мес</small>
            </div>
            <div class="nero-ai-metric">
              <span>Cost per piece</span>
              <strong>−41%</strong>
              <small>ориентир кейса</small>
            </div>
          </div>

          <div class="akcs-dash-canvas-wrap" aria-hidden="false">
            <canvas id="akcs-hero-canvas" role="img" aria-label="Анимация: темы спускаются по лентам, проходят QA и публикуются в блог, VK и email"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента контент-пайплайна">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">◎</span>
              <div><strong>Тема: AI-контент для МСБ</strong><span>Wordstat-кластер · приоритет высокий</span></div>
              <span class="nero-ai-status">тема</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✎</span>
              <div><strong>Черновик лонгрида + GEO</strong><span>ToV по RAG · H2/H3 + FAQ</span></div>
              <span class="nero-ai-status">черновик</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>QA: governance чеклист</strong><span>факты · тон · CTA · запреты</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↗</span>
              <div><strong>Мультиканал: блог · VK · email</strong><span>WP + расписание · UTM в CRM</span></div>
              <span class="nero-ai-status">live</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * akcs-hero-engine — Редакционный нейро-центр
 * Мир: вертикальные ленты тем → мультиканальный хаб → QA → синхронная публикация
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("akcs-hero-canvas");
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
    ribbon: "rgba(139,92,246,0.35)",
    ribbonGlow: "rgba(121,242,255,0.28)",
    hubBase: "#1e293b",
    hubAccent: "#79f2ff",
    hubGreen: "#22c55e",
    seed: "#fde68a",
    blog: "#93c5fd",
    social: "#c4b5fd",
    email: "#a7f3d0",
    rag: "#f8fafc",
    qa: "#f97316",
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

  /* Вертикальные ленты тем — вместо Conveyor */
  function IdeaRibbonStream() {
    this.phase = 0;
  }
  IdeaRibbonStream.prototype.draw = function (ctx) {
    this.phase = (frame * 0.022) % 1;
    var lanes = [
      { x: -115, w: 8, hue: C.ribbon },
      { x: -95, w: 6, hue: C.ribbonGlow },
      { x: -75, w: 8, hue: C.ribbon }
    ];
    lanes.forEach(function (lane, idx) {
      ctx.strokeStyle = lane.hue;
      ctx.lineWidth = lane.w;
      ctx.setLineDash([10, 14]);
      ctx.lineDashOffset = -frame * (0.6 + idx * 0.15);
      ctx.beginPath();
      ctx.moveTo(lane.x, -95);
      ctx.bezierCurveTo(lane.x + 18, -40, lane.x - 12, 20, lane.x + 8, 75);
      ctx.stroke();
      ctx.setLineDash([]);
    });

    for (var i = 0; i < 4; i++) {
      var t = (this.phase + i * 0.22) % 1;
      var sx = -105 + Math.sin(t * Math.PI * 2) * 8;
      var sy = -90 + t * 165;
      drawRR(ctx, sx - 9, sy - 6, 18, 12, 3, C.seed, C.outline);
      ctx.fillStyle = "#78350f";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("тема", sx, sy + 2);
    }
  };

  /* Полка RAG — уникальный объект */
  function RAGKnowledgeShelf() {
    this.glow = 0;
  }
  RAGKnowledgeShelf.prototype.draw = function (ctx) {
    drawRR(ctx, -165, -55, 42, 90, 6, "rgba(255,255,255,0.06)", C.outline);
    ["FAQ", "ToV", "Кейсы"].forEach(function (lbl, i) {
      drawRR(ctx, -158, -48 + i * 26, 28, 18, 3, C.rag, C.outline);
      ctx.fillStyle = "#334155";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(lbl, -144, -36 + i * 26);
    });
    var prg = (frame * 0.035) % 260;
    if (prg > 40 && prg < 80) {
      this.glow = Math.sin((prg - 40) * 0.12);
      ctx.strokeStyle = "rgba(121,242,255," + (0.3 + this.glow * 0.4) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(-123, -10);
      ctx.lineTo(-70, -5);
      ctx.stroke();
    }
  };

  /* Календарь тем сверху */
  function TopicSeedCalendar() {}
  TopicSeedCalendar.prototype.draw = function (ctx) {
    drawRR(ctx, -50, -88, 100, 22, 5, "rgba(255,255,255,0.08)", C.outline);
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Контент-план · неделя 24", 0, -74);
    var prg = (frame * 0.035) % 260;
    if (prg > 8 && prg < 35) {
      var drop = (prg - 8) / 27;
      drawRR(ctx, -8, -65 + drop * 25, 16, 10, 2, C.seed, C.outline);
    }
  };

  /* Центральный хаб — вместо WebsiteTerminal */
  function MultiChannelPublishHub() {
    this.splitAnim = 0;
    this.syncPulse = 0;
  }
  MultiChannelPublishHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;

    /* Шестиугольник хаба */
    ctx.fillStyle = C.hubBase;
    ctx.strokeStyle = C.hubAccent;
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var i = 0; i < 6; i++) {
      var ang = (Math.PI / 3) * i - Math.PI / 6;
      var hx = Math.cos(ang) * 48;
      var hy = Math.sin(ang) * 38 - 5;
      if (i === 0) ctx.moveTo(hx, hy);
      else ctx.lineTo(hx, hy);
    }
    ctx.closePath();
    ctx.fill();
    ctx.stroke();

    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ХАБ", 0, -2);

    /* Фаза DRAFT: наполнение черновика */
    if (prg >= 55 && prg < 130) {
      var fillH = ((prg - 55) / 75) * 40;
      drawRR(ctx, -22, 8 - fillH, 44, fillH, 3, "rgba(121,242,255,0.25)", null);
      ctx.fillStyle = "#bfdbfe";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("черновик", 0, 4);
    }

    /* Фаза MULTICAST: расщепление на каналы */
    if (prg >= 195) {
      this.splitAnim = Math.min(1, (prg - 195) / 30);
      var ports = [
        { lbl: "Блог", col: C.blog, x: -75, y: 35 },
        { lbl: "VK", col: C.social, x: 0, y: 55 },
        { lbl: "Email", col: C.email, x: 75, y: 35 }
      ];
      ports.forEach(function (p) {
        var px = p.x * this.splitAnim;
        var py = p.y * this.splitAnim;
        drawRR(ctx, px - 18, py - 10, 36, 20, 5, p.col, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(p.lbl, px, py + 3);
        ctx.strokeStyle = "rgba(121,242,255,0.4)";
        ctx.lineWidth = 1.5;
        ctx.beginPath();
        ctx.moveTo(0, 15);
        ctx.lineTo(px, py - 8);
        ctx.stroke();
      }, this);

      if (prg > 220 && prg < 255) {
        this.syncPulse = (prg - 220) / 35;
        ctx.strokeStyle = "rgba(34,197,94," + (0.85 - this.syncPulse * 0.75) + ")";
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.arc(0, 10, 25 + this.syncPulse * 55, 0, Math.PI * 2);
        ctx.stroke();
      }
    }
  };

  /* Кольцо ToV */
  function ToneOfVoiceRing() {
    this.rot = 0;
  }
  ToneOfVoiceRing.prototype.draw = function (ctx) {
    this.rot = frame * 0.015;
    ctx.save();
    ctx.rotate(this.rot);
    ctx.strokeStyle = "rgba(236,72,153,0.45)";
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 9]);
    ctx.beginPath();
    ctx.arc(0, -5, 62, 0, Math.PI * 2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.restore();
    ctx.fillStyle = "#fbcfe8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ToV", 0, -68);
  };

  /* QA-ворота governance */
  function QAChecklistGate() {
    this.stamp = 0;
  }
  QAChecklistGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    drawRR(ctx, 115, -15, 38, 50, 6, "rgba(249,115,22,0.12)", C.qa);
    ctx.fillStyle = C.qa;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("QA", 134, 2);

    if (prg >= 140 && prg < 195) {
      this.stamp = Math.min(1, (prg - 140) / 25);
      ctx.globalAlpha = this.stamp;
      ctx.strokeStyle = C.hubGreen;
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.arc(134, 8, 14, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = C.hubGreen;
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.fillText("✓", 134, 12);
      ctx.globalAlpha = 1;
    }
  };

  /* GEO-панель */
  function GEOChunkPanel() {}
  GEOChunkPanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 260;
    if (prg < 90) return;
    drawRR(ctx, 95, 45, 55, 38, 5, "rgba(255,255,255,0.07)", C.outline);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("GEO chunk", 100, 58);
    drawRR(ctx, 100, 62, 40, 4, 1, "#64748b", null);
    drawRR(ctx, 100, 70, 32, 4, 1, "#64748b", null);
    drawRR(ctx, 100, 78, 45, 4, 1, "#64748b", null);
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
    var prg = (frame * 0.035) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -55, y: 70 },
      "2_seo": { x: -18, y: 78 },
      "3_coder": { x: 18, y: 78 },
      "4_designer": { x: 55, y: 70 },
      "5_deployer": { x: 0, y: 88 }
    };
    var tgt = targets[this.role] || { x: 0, y: 75 };

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

    if (!isMoving && frame % 240 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 230);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.2;
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
    if (carryType) drawRR(ctx, -16 * faceDir, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new IdeaRibbonStream());
  entities.push(new RAGKnowledgeShelf());
  entities.push(new TopicSeedCalendar());
  entities.push(new ToneOfVoiceRing());
  entities.push(new MultiChannelPublishHub());
  entities.push(new QAChecklistGate());
  entities.push(new GEOChunkPanel());
  entities.push(new Agent(-130, 95, C.agentYellow, "1_architect", 20, [
    "Тема из Wordstat-кластера", "Контент-план на 2 недели", "Приоритет: коммерция"
  ]));
  entities.push(new Agent(-65, 102, C.agentGreen, "2_seo", 58, [
    "GEO: FAQ + определения", "H2 под кластер запросов", "LSI без переспама"
  ]));
  entities.push(new Agent(0, 105, C.agentBlue, "3_coder", 98, [
    "n8n: тема → черновик", "Промпт + structured JSON", "RAG на архиве бренда"
  ]));
  entities.push(new Agent(65, 102, C.agentPink, "4_designer", 138, [
    "Обложка по ToV", "ТЗ Kandinsky готово", "Баннер для VK"
  ]));
  entities.push(new Agent(130, 95, C.agentPurple, "5_deployer", 178, [
    "WP + VK + email sync", "UTM в amoCRM", "Публикация по расписанию"
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

    var prg = (frame * 0.035) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(-90, -50, "1. Тема из календаря");
    if (prg >= 62 && prg < 62.05) createBubble(-50, 10, "2. ToV по RAG-базе");
    if (prg >= 102 && prg < 102.05) createBubble(0, 0, "3. Черновик + GEO");
    if (prg >= 152 && prg < 152.05) createBubble(120, -5, "4. QA: governance ✓");
    if (prg >= 205 && prg < 205.05) createBubble(60, -30, "5. Блог · VK · email live");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.hubAccent);
      ctx.fillStyle = C.bubbleText;
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

<div class="akcs-content">

  <section class="akcs-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="akcs-cnt">
      <div class="akcs-intro-grid nero-ai-reveal">
        <div class="akcs-intro-text">
          <p class="akcs-eyebrow">Лонгрид · AI-контент для бизнеса</p>
          <p>У большинства компаний с блогом, соцсетями, SEO, email и рекламой контент производится нерегулярно, в разном стиле и с непрозрачной стоимостью. <strong>AI-контент для бизнеса</strong> решает не задачу «написать один текст», а задачу <strong>управляемого конвейера</strong> — от темы до публикации в нескольких каналах.</p>
          <p><strong>Оффер Nero Network:</strong> настроим AI-систему контента под ключ — темы, тексты, посты, рассылки, изображения и контроль качества. Первый шаг — <strong>контент-план на AI</strong>; основной CTA — <strong>«Настроить AI-контент»</strong>.</p>
        </div>
        <div class="akcs-intro-kpi" aria-label="Ключевые метрики AI-контента">
          <div class="akcs-kpi-card"><div class="kv">62%</div><div class="kl">знают об AI-агентах</div><div class="ks">СберМаркетинг, 2026</div></div>
          <div class="akcs-kpi-card"><div class="kv">24%</div><div class="kl">реально используют</div><div class="ks">разрыв в РФ</div></div>
          <div class="akcs-kpi-card"><div class="kv">91%</div><div class="kl">маркетологов с AI</div><div class="ks">Jasper 2026</div></div>
          <div class="akcs-kpi-card"><div class="kv">−70%</div><div class="kl">цикл поста</div><div class="ks">кейс СберМаркетинг</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="akcs-toc-outer">
    <div class="akcs-cnt">
      <nav class="akcs-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-kontent">Почему «сыпется»</a>
        <a href="#chto-takoe-sistema">Система</a>
        <a href="#sostav-sistemy">Состав</a>
        <a href="#etapy">Этапы</a>
        <a href="#agenty">Агенты</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#integracii">Интеграции</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="akcs-section" id="pochemu-kontent">
    <div class="akcs-cnt">
      <div class="akcs-sh akcs-left nero-ai-reveal">
        <span class="akcs-eyebrow">Боль бизнеса</span>
        <h2>Почему контент «сыпется»: нерегулярность, разный стиль и высокая стоимость</h2>
        <p><strong>Коротко:</strong> у большинства компаний с блогом, соцсетями, SEO, email и рекламой контент производится нерегулярно, в разном стиле и с непрозрачной стоимостью. AI-контент для бизнеса решает задачу <strong>управляемого конвейера</strong>.</p>
      </div>
      <p class="nero-ai-reveal">По данным опроса СберМаркетинга (COSSA, 2026), <strong>62%</strong> российских маркетологов знают об AI-агентах, но только <strong>24%</strong> реально используют их в работе. При этом <strong>91%</strong> маркетологов в мире уже применяют AI (Jasper State of AI in Marketing 2026) — разрыв между знанием и внедрением в России особенно заметен.</p>
      <div class="akcs-grid-4 nero-ai-reveal" style="margin-top:28px" aria-label="Четыре боли контент-производства">
        <div class="akcs-card akcs-pain-card"><div class="ico">📅</div><h3>Нерегулярно</h3><p>Блог и соцсети обновляются «когда успеем»</p></div>
        <div class="akcs-card akcs-pain-card"><div class="ico">🎭</div><h3>Разный стиль</h3><p>Подрядчики и авторы дают разнородный голос</p></div>
        <div class="akcs-card akcs-pain-card"><div class="ico">⏳</div><h3>Долго</h3><p>От идеи до публикации — дни и недели</p></div>
        <div class="akcs-card akcs-pain-card"><div class="ico">💸</div><h3>Дорого</h3><p>Нет прозрачной цены единицы контента</p></div>
      </div>
      <div class="akcs-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="akcs-card">
          <h3>Когда ручное производство перестаёт масштабироваться</h3>
          <p>Типичная картина: блог обновляется «когда успеем», посты в VK и Telegram выходят рывками, email-рассылки откладываются. Ручной контент упирается в три потолка: <strong>скорость</strong>, <strong>стиль</strong> и <strong>стоимость</strong>.</p>
          <p>Исследование Microsoft Research по M365 Copilot (arXiv 2605.23958) показывает: в корпоративном AI доминируют задачи <strong>письма и коммуникаций</strong>. Нужна <strong>своя контент-операционная система</strong>, а не разовые запросы в ChatGPT.</p>
        </div>
        <div class="akcs-card">
          <h3>Скрытые расходы разрозненных подрядчиков</h3>
          <ul>
            <li><strong>Согласования</strong> — каждый исполнитель не знает тон бренда</li>
            <li><strong>Потери на передаче</strong> — бриф теряется между чатами</li>
            <li><strong>Дублирование</strong> — одна мысль переписывается с нуля</li>
            <li><strong>Нет аналитики</strong> — непонятна стоимость лида с блога</li>
          </ul>
          <p>Кейс PrivateSEO: стоимость контента <strong>−40%</strong>, конверсия с блога <strong>×2,1</strong>.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="akcs-section akcs-section-alt" id="chto-takoe-sistema">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Определение</span>
        <h2>Что такое AI-контент-система для бизнеса</h2>
        <p><strong>Определение:</strong> сквозной конвейер контент-производства — от идеи и темы до черновика, редактуры, визуала, публикации и аналитики. Не подписка на ChatGPT, а управляемый процесс с единым tone of voice и QA.</p>
      </div>

      <div class="akcs-card nero-ai-reveal" style="margin-bottom:28px">
        <h3>От разовой генерации текста к управляемому контент-процессу</h3>
        <p>Разовая генерация: промпт → черновик → правки → копипаст в CMS. На следующий день — снова с нуля, без памяти бренда и SEO-кластера.</p>
        <div class="akcs-flow" aria-label="Семь шагов контент-пайплайна">
          <span>Вход</span><span class="arr">→</span>
          <span>План</span><span class="arr">→</span>
          <span>Генерация</span><span class="arr">→</span>
          <span>QA</span><span class="arr">→</span>
          <span>Человек</span><span class="arr">→</span>
          <span>Публикация</span><span class="arr">→</span>
          <span>Аналитика</span>
        </div>
        <p>По данным Forrester TEI для M365 Copilot, средняя экономия времени на <strong>content creation</strong> — <strong>34,2%</strong>. Система снимает рутину drafting, человек фокусируется на стратегии и финальной редактуре.</p>
      </div>

<section id="ai-kontent-sistema-dlya-biznesa-boris-block" class="acs-root" aria-label="Анимация: AI-контент-пайплайн — от идеи до публикации в четырёх каналах">
<style>
/* === БОРИС: prefix acs-, scoped внутри #ai-kontent-sistema-dlya-biznesa-boris-block === */
#ai-kontent-sistema-dlya-biznesa-boris-block.acs-root{
  padding:48px 0 56px;
  background:#f8fafc;
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #ai-kontent-sistema-dlya-biznesa-boris-block .acs-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-lft{
  padding:36px 32px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-kontent-sistema-dlya-biznesa-boris-block .acs-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:28px 22px;
  }
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#6366f1;
  margin:0 0 12px;
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-ey::before{
  content:'';
  width:18px;height:2px;
  background:#6366f1;
  border-radius:1px;
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-h3{
  font-size:clamp(19px,2.3vw,25px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 16px;
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-steps{
  list-style:none;
  margin:0 0 18px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:7px;
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-steps li{
  display:flex;
  align-items:flex-start;
  gap:9px;
  font-size:13px;
  line-height:1.45;
  color:#334155;
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-num{
  flex-shrink:0;
  width:20px;height:20px;
  border-radius:50%;
  background:rgba(99,102,241,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:10px;
  font-weight:800;
  color:#4f46e5;
  margin-top:1px;
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-pills{
  display:flex;
  flex-wrap:wrap;
  gap:7px;
  margin-bottom:14px;
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-pl{
  padding:4px 11px;
  border-radius:99px;
  font-size:11px;
  font-weight:700;
  white-space:nowrap;
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-pl-v{
  background:rgba(99,102,241,.08);
  color:#4338ca;
  border:1.5px solid rgba(99,102,241,.22);
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-foot{
  font-size:12px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-kontent-sistema-dlya-biznesa-boris-block .acs-rgt{
  position:relative;
  background:linear-gradient(135deg,#eef2ff 0%,#f0f9ff 35%,#f8fafc 70%,#faf5ff 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-kontent-sistema-dlya-biznesa-boris-block .acs-rgt{min-height:360px;}
}
#acs-content-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="acs-cnt">
  <div class="acs-card">

    <div class="acs-lft">
      <span class="acs-ey">Пайплайн · 7 этапов</span>
      <h3 class="acs-h3">Один смысл — блог, соцсети, email и реклама без копипаста</h3>
      <ol class="acs-steps" aria-label="Этапы AI-контент-системы">
        <li><span class="acs-num">1</span><strong>Вход</strong> — SEO-кластер, тренд или заметка эксперта</li>
        <li><span class="acs-num">2</span><strong>План</strong> — темы, заголовки и формат под канал</li>
        <li><span class="acs-num">3</span><strong>Генерация</strong> — черновик по ToV + факты из RAG</li>
        <li><span class="acs-num">4</span><strong>QA</strong> — факты, тон, CTA, запреты</li>
        <li><span class="acs-num">5</span><strong>Человек</strong> — редактор 10–30 мин на единицу</li>
        <li><span class="acs-num">6</span><strong>Публикация</strong> — CMS, VK, Telegram, email</li>
        <li><span class="acs-num">7</span><strong>Аналитика</strong> — лиды, скорость, cost per piece</li>
      </ol>
      <div class="acs-pills">
        <span class="acs-pl acs-pl-v">1 смысл → 4 канала</span>
        <span class="acs-pl acs-pl-g">−70% цикл поста</span>
        <span class="acs-pl acs-pl-b">34% экономия времени</span>
      </div>
      <p class="acs-foot">Дальше — чем система отличается от «просто ChatGPT» и из чего состоит архитектура →</p>
    </div>

    <div class="acs-rgt">
      <canvas
        id="acs-content-pipeline-canvas"
        aria-label="Анимация: идея проходит планирование, генерацию, QA и расщепляется на блог, VK, email и рекламу"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('acs-content-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a',
    muted:'#64748b',
    line:'rgba(99,102,241,.25)',
    ai:'#6366f1',
    aiGlow:'rgba(99,102,241,.18)',
    plan:'#8b5cf6',
    gen:'#0ea5e9',
    qa:'#22c55e',
    human:'#f59e0b',
    pub:'#ec4899',
    blog:'#3b82f6',
    vk:'#2563eb',
    email:'#10b981',
    ads:'#f97316',
    packet:'#ffffff',
    packetBdr:'#c7d2fe',
    hub:'#eef2ff',
    hubBdr:'#a5b4fc'
  };

  var STAGES = [
    {id:'in',   label:'Вход',   x:0.08, color:C.ai,   icon:'💡'},
    {id:'plan', label:'План',   x:0.22, color:C.plan, icon:'📋'},
    {id:'gen',  label:'Генерация', x:0.36, color:C.gen, icon:'✍️'},
    {id:'qa',   label:'QA',     x:0.50, color:C.qa,   icon:'✓'},
    {id:'hum',  label:'Редактор', x:0.64, color:C.human, icon:'👤'},
    {id:'hub',  label:'Хаб',    x:0.78, color:C.pub,  icon:'⚡'}
  ];

  var CHANNELS = [
    {label:'Блог',  color:C.blog,  yOff:-0.14, icon:'📄'},
    {label:'VK',    color:C.vk,    yOff:-0.05, icon:'💬'},
    {label:'Email', color:C.email, yOff:0.05,  icon:'✉️'},
    {label:'Реклама', color:C.ads, yOff:0.14, icon:'📢'}
  ];

  var LOOP = 520;
  var packets = [];

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawStage(sx, sy, st, pulse){
    var r = 22 + (pulse || 0);
    ctx.globalAlpha = 1;
    rr(sx-r, sy-r, r*2, r*2, r, C.hub, st.color, 2);
    ctx.fillStyle = '#fff';
    ctx.font = '16px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(st.icon, sx, sy - 1);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 9px Inter,system-ui,sans-serif';
    ctx.fillText(st.label, sx, sy + r + 11);
  }

  function drawChannel(cx, cy, ch, alpha){
    ctx.globalAlpha = alpha || 1;
    var w = 54, h = 36;
    rr(cx - w/2, cy - h/2, w, h, 8, '#fff', ch.color, 1.5);
    ctx.font = '14px system-ui';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(ch.icon, cx - 14, cy);
    ctx.fillStyle = ch.color;
    ctx.font = 'bold 9px Inter,sans-serif';
    ctx.fillText(ch.label, cx + 10, cy + 1);
    ctx.globalAlpha = 1;
  }

  function spawnPacket(){
    packets.push({
      t: 0,
      stage: 0,
      branch: Math.floor(Math.random() * 4),
      label: ['SEO','VK','Email','Ads'][Math.floor(Math.random()*4)]
    });
  }

  if (packets.length === 0) spawnPacket();

  function draw(){
    ctx.clearRect(0,0,W,H);
    var cy = H * 0.48;
    var hubX = W * 0.78;
    var hubY = cy;

    /* фоновая сетка */
    ctx.strokeStyle = 'rgba(148,163,184,.12)';
    ctx.lineWidth = 1;
    for(var gx=0; gx<W; gx+=28){
      ctx.beginPath(); ctx.moveTo(gx,0); ctx.lineTo(gx,H); ctx.stroke();
    }

    /* линия пайплайна */
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 3;
    ctx.setLineDash([]);
    ctx.beginPath();
    ctx.moveTo(W*0.06, cy);
    ctx.lineTo(hubX - 24, cy);
    ctx.stroke();

    /* стадии */
    STAGES.forEach(function(st, i){
      var sx = W * st.x;
      var pulse = (st.id === 'qa' && frame % 60 < 30) ? 2 : 0;
      drawStage(sx, cy, st, pulse);
      if(i < STAGES.length - 1){
        var nx = W * STAGES[i+1].x;
        ctx.strokeStyle = C.line;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(sx + 24, cy);
        ctx.lineTo(nx - 24, cy);
        ctx.stroke();
      }
    });

    /* разветвление на каналы */
    CHANNELS.forEach(function(ch){
      var tx = W * 0.93;
      var ty = cy + H * ch.yOff;
      ctx.strokeStyle = ch.color;
      ctx.globalAlpha = 0.35;
      ctx.lineWidth = 2;
      ctx.setLineDash([4,4]);
      ctx.beginPath();
      ctx.moveTo(hubX + 24, hubY);
      ctx.quadraticCurveTo(hubX + 50, (hubY + ty) / 2, tx - 30, ty);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.globalAlpha = 1;
      drawChannel(tx, ty, ch, 0.85 + 0.15 * Math.sin(frame * 0.04 + ch.yOff * 10));
    });

    /* пакеты контента */
    if(frame % 85 === 0) spawnPacket();
    packets = packets.filter(function(p){ return p.t < LOOP + 120; });

    packets.forEach(function(p){
      p.t++;
      var prog = p.t / LOOP;
      var px, py;
      if(prog < 0.72){
        var seg = prog / 0.72;
        var idx = Math.min(Math.floor(seg * (STAGES.length - 1)), STAGES.length - 2);
        var local = (seg * (STAGES.length - 1)) - idx;
        var x1 = W * STAGES[idx].x;
        var x2 = W * STAGES[idx+1].x;
        px = x1 + (x2 - x1) * local;
        py = cy;
      } else {
        var bprog = (prog - 0.72) / 0.28;
        var ch = CHANNELS[p.branch];
        var tx = W * 0.93;
        var ty = cy + H * ch.yOff;
        px = hubX + 24 + (tx - 30 - hubX - 24) * bprog;
        var midY = (hubY + ty) / 2;
        py = hubY + (ty - hubY) * bprog + Math.sin(bprog * Math.PI) * (midY - hubY) * 0.3;
      }
      var col = CHANNELS[p.branch].color;
      ctx.globalAlpha = 0.92;
      rr(px-14, py-10, 28, 20, 5, C.packet, col, 1.5);
      ctx.fillStyle = col;
      ctx.font = 'bold 7px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      ctx.fillText(p.label, px, py);
      ctx.globalAlpha = 1;
    });

    /* легенда */
    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('RAG + ToV → мультиканал', 12, H - 14);

    frame++;
    requestAnimationFrame(draw);
  }
  draw();
})();
</script>
</section>

      <div class="akcs-table-wrap nero-ai-reveal">
        <h3 style="padding:0 4px 12px">Чем система отличается от «просто ChatGPT для маркетолога»</h3>
        <table class="akcs-table" aria-label="Сравнение ChatGPT и AI-контент-системы">
          <thead><tr><th>Критерий</th><th>ChatGPT «вручную»</th><th>AI-контент-система</th></tr></thead>
          <tbody>
            <tr><td>Tone of voice</td><td>Зависит от промпта каждый раз</td><td>RAG на архиве бренда, гайдлайнах</td></tr>
            <tr><td>Качество</td><td>Риск галлюцинаций</td><td>QA-агент + human-in-the-loop</td></tr>
            <tr><td>Каналы</td><td>Один текст — один канал</td><td>Один смысл → блог, VK, email, реклама</td></tr>
            <tr><td>Интеграции</td><td>Копипаст</td><td>WordPress, amoCRM, Bitrix24, VK</td></tr>
            <tr><td>Аналитика</td><td>Нет</td><td>UTM, лиды, cost per piece</td></tr>
            <tr><td>Масштаб</td><td>Один человек</td><td>Конвейер для всей команды</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">Jasper State of AI in Marketing 2026: <strong>governance</strong> — барьер №1 при масштабировании AI (27% респондентов). Система с чеклистами и ролями редактора закрывает этот разрыв.</p>
    </div>
  </section>

  <section class="akcs-section" id="sostav-sistemy">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Архитектура</span>
        <h2>Из чего состоит AI-система контента</h2>
        <p>Темы, тексты, посты, рассылки, изображения и контроль качества — нейросети для контента лишь один слой в архитектуре.</p>
      </div>
      <div class="akcs-grid-3 nero-ai-reveal">
        <div class="akcs-card"><h3>Контент-план и кластеры</h3><p>AI мониторит тренды и SEO-семантику. Кейс СберМаркетинга: <strong>700→1200+</strong> публикаций в год, TTM <strong>×3,5</strong>.</p></div>
        <div class="akcs-card"><h3>Тексты для блога и SEO</h3><p>Структура H2/H3, SEO-кластер, RAG-база. GEO-блоки: определения, FAQ, цифры с источниками.</p></div>
        <div class="akcs-card"><h3>Посты и креативы</h3><p>Один смысл → VK, Telegram, рекламные заголовки. <strong>51%</strong> маркетологов — multi-asset generation (Jasper 2026).</p></div>
        <div class="akcs-card"><h3>Email-рассылки</h3><p>Цепочки welcome, nurture, реактивации с сегментацией из CRM. HubSpot 2026: <strong>~94%</strong> планируют AI в контенте.</p></div>
        <div class="akcs-card"><h3>Визуал</h3><p>Автогенерация обложек или ТЗ дизайнеру по утверждённому тексту — визуал не оторван от смысла.</p></div>
        <div class="akcs-card"><h3>QA и governance</h3><p>Факты, тон, CTA, запреты. Вычитка человеком <strong>10–15 мин</strong> на пост. Цитата Анны Тупикиной (СберМаркетинг).</p></div>
      </div>
    </div>
  </section>

  <section class="akcs-section akcs-section-alt" id="etapy">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Внедрение</span>
        <h2>Внедрение AI-контент-системы под ключ: этапы, сроки и роли</h2>
        <p><strong>Коротко:</strong> <strong>14–30 дней</strong>, ориентир чека <strong>100–600 тыс. ₽</strong>. Nero Network ведёт проект от аудита до передачи системы.</p>
      </div>
      <div class="akcs-timeline nero-ai-reveal">
        <div class="akcs-tl-item"><span class="akcs-tl-dot"></span><h3>Аудит каналов (3–5 дней)</h3><p>Каналы, tone of voice, узкие места. Архив контента 6–24 месяца, редакционная политика.</p></div>
        <div class="akcs-tl-item"><span class="akcs-tl-dot"></span><h3>Настройка пайплайна (7–14 дней)</h3><p>RAG-база, n8n/Make.com + LLM. Цепочка: тема → черновик → QA → статус в Notion/Bitrix24.</p></div>
        <div class="akcs-tl-item"><span class="akcs-tl-dot"></span><h3>Обучение команды (2–4 дня)</h3><p>Регламент human-in-the-loop: кто утверждает, редактирует, публикует. Олег Качалин (Rocket Tech): «ИИ приносит пользу, когда инструмент соответствует компетенциям команды».</p></div>
        <div class="akcs-tl-item"><span class="akcs-tl-dot"></span><h3>Пилот и масштабирование</h3><p><strong>2–4 недели:</strong> 20–50 единиц контента, калибровка промптов. Первые материалы — уже на первой неделе после настройки базы знаний.</p></div>
      </div>
      
<div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
  <div class="ym-cta-block__icon" aria-hidden="true">✍️</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Настроить AI-контент под ваши каналы</p>
    <p class="ym-cta-block__sub">Проведём экспресс-аудит блога, соцсетей, email и рекламы — и подготовим <strong>контент-план на AI</strong> с темами, форматами и приоритетами. Пилот 2–4 недели, первые материалы — уже на первой неделе.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>

    </div>
  </section>

  <section class="akcs-section" id="agenty">
    <div class="akcs-cnt">
      <div class="akcs-sh akcs-left nero-ai-reveal">
        <span class="akcs-eyebrow">AI-агенты</span>
        <h2>AI-автоматизация контента и AI-агенты в маркетинге</h2>
        <p>Контент-завод на AI — операционная модель: мониторинг тем, черновики, адаптация под канал, первичный фактчек по регламенту.</p>
      </div>
      <div class="akcs-grid-2 nero-ai-reveal">
        <div class="akcs-card"><h3>AI делает</h3><ul><li>Мониторинг 200+ источников</li><li>Черновики по каркасу H2/H3</li><li>Адаптация под канал и длину</li><li>Email-серии и рекламные варианты</li><li>ТЗ дизайнерам и фактчек по RAG</li></ul></div>
        <div class="akcs-card"><h3>Человек остаётся за</h3><ul><li>Стратегией и позиционированием</li><li>Финальной редактурой и юридикой</li><li>Утверждением публикаций (governance)</li><li>Интервью с экспертами</li><li>Кризисными и чувствительными темами</li></ul></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px">Типовой стек: <strong>GigaChat/YandexGPT</strong> + <strong>n8n/Make.com</strong> + <strong>WordPress</strong> + <strong>amoCRM/Bitrix24</strong>. MCP позволяет агентам обращаться к базе знаний и CMS без копипаста. MIT: <strong>95%</strong> AI-пилотов не доходят до масштабирования — системное внедрение с метриками — ответ на разрыв.</p>
    </div>
  </section>

  <section class="akcs-section akcs-section-alt" id="dlya-kogo">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит: блог, SEO, соцсети, email и реклама</h2>
        <p>Если у вас хотя бы два канала из списка, AI-контент для бизнеса окупается быстрее, чем при единичном канале.</p>
      </div>
      <div class="akcs-grid-2 nero-ai-reveal">
        <div class="akcs-card"><h3>Малый бизнес</h3><p>Заменяет хаос фрилансеров. PrivateSEO: команда 4→2, <strong>1 статья за 1 день</strong> вместо 5, бюджет <strong>~70 тыс. ₽/мес</strong> вместо 120.</p></div>
        <div class="akcs-card"><h3>Средний бизнес</h3><p>Единое ядро tone of voice при нескольких подрядчиках. СберМаркетинг: команда 6 чел., кратный прирост объёма без расширения штата.</p></div>
      </div>
    </div>
  </section>

  <section class="akcs-section" id="integracii">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Стек</span>
        <h2>Интеграции: CMS, CRM, email и SEO</h2>
      </div>
      <div class="akcs-grid-3 nero-ai-reveal">
        <div class="akcs-card"><h3>Блог и CMS</h3><p>WordPress, Tilda: черновик → редактура → публикация по расписанию. SEO-поля по шаблону, перелинковка по кластеру.</p></div>
        <div class="akcs-card"><h3>CRM и email</h3><p>amoCRM, Bitrix24: письма под стадию воронки, реактивация и промо с сегментацией.</p></div>
        <div class="akcs-card"><h3>SEO и GEO</h3><p>Мета, H2/H3, FAQ под кластер. Структурированные блоки для AI-цитирования в выдаче.</p></div>
      </div>
    </div>
  </section>

  <section class="akcs-section akcs-section-alt" id="stoimost">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Цена</span>
        <h2>Сколько стоит AI-контент для бизнеса</h2>
        <p>Ориентир внедрения под ключ — <strong>100–600 тыс. ₽</strong>. Точная смета зависит от каналов, интеграций и объёма пилота.</p>
        <div class="akcs-price-badge">100–600 тыс. ₽ · 14–30 дней</div>
      </div>
      <div class="akcs-grid-2 nero-ai-reveal">
        <div class="akcs-card">
          <h3>Факторы сметы</h3>
          <ul>
            <li>Число каналов (блог, соцсети, email, реклама)</li>
            <li>Интеграции CRM, CMS, аналитика</li>
            <li>Глубина RAG и объём базы знаний</li>
            <li>Визуал: автогенерация vs ТЗ дизайнерам</li>
            <li>Поддержка после пилота</li>
          </ul>
        </div>
        <div class="akcs-card">
          <h3>Что входит в «под ключ»</h3>
          <p><strong>Включено:</strong> аудит, пайплайн, RAG, промпты, пилот 20–50 единиц, обучение, документация.</p>
          <p><strong>Отдельно:</strong> подписки LLM API, индивидуальный дизайн, новые бренды, длительное сопровождение.</p>
          <p>Кейс СберМаркетинга: стоимость поста <strong>−41–52%</strong>, написание <strong>−95%</strong> — ориентир ROI, не гарантия.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="akcs-section" id="sravnenie">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Сравнение</span>
        <h2>Под ключ или своими силами</h2>
      </div>
      <div class="akcs-table-wrap nero-ai-reveal">
        <table class="akcs-table" aria-label="DIY vs внедрение под ключ">
          <thead><tr><th>Параметр</th><th>Своими силами</th><th>Под ключ (Nero Network)</th></tr></thead>
          <tbody>
            <tr><td>Срок до результатов</td><td>1–3 мес.</td><td>1–2 нед. (пилот)</td></tr>
            <tr><td>Tone of voice</td><td>Нестабильно</td><td>RAG + QA-чеклист</td></tr>
            <tr><td>Интеграции</td><td>Ручной копипаст</td><td>n8n/Make, автопубликация</td></tr>
            <tr><td>Governance</td><td>Часто отсутствует</td><td>Чеклисты, роли, регламент</td></tr>
            <tr><td>Риск масштабирования</td><td>95% пилотов не масштабируются</td><td>Пилот → метрики → масштаб</td></tr>
            <tr><td>Программист</td><td>Желателен</td><td>Не обязателен</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal"><strong>Эдуард Трубченинов</strong> (PrivateSEO): «ИИ не заменит мышление. Но уберёт рутину». Заказать внедрение стоит, если контент нужен в <strong>3+ каналах</strong>, подрядчики дают разный стиль, команда перегружена, нужны CRM/CMS-интеграции и SEO/GEO.</p>
      
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите сначала разобраться в AI-контенте своими силами?</p>
    <p class="ym-cta-block__sub">Перед заказом внедрения полезно понять n8n/Make, промпты, human-in-the-loop и RAG на данных бренда — так проще оценить DIY vs под ключ. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo nero_ai_external_link_attrs($secondary_cta_url); ?>><?php echo esc_html($secondary_cta_label); ?></a>.</p>
  </div>
</aside>

    </div>
  </section>

  <section class="akcs-section akcs-section-alt" id="keisy">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI-контента</h2>
      </div>
      <div class="akcs-case-grid nero-ai-reveal">
        <div class="akcs-case-card">
          <div class="akcs-case-tag">СберМаркетинг · GigaChat</div>
          <h3>Регулярный блог + соцсети</h3>
          <p>Публикации <strong>700→1200+</strong> в год, TTM <strong>×3,5</strong>, цикл поста <strong>−70%</strong>. Digital Communications Awards 2026 — «Лучшее контент-решение».</p>
        </div>
        <div class="akcs-case-card">
          <div class="akcs-case-tag">PrivateSEO · ChatGPT</div>
          <h3>SEO-конвейер для агентства</h3>
          <p>Конверсия с блога <strong>×2,1</strong>, 1 статья за 1 день вместо 5, контент-отдел 4→2 человека.</p>
        </div>
        <div class="akcs-case-card">
          <div class="akcs-case-tag">Международный паттерн</div>
          <h3>Email + реклама с единым стилем</h3>
          <p>Jasper в workflow 2X (B2B): ideation → editing в одной платформе. Cushman &amp; Wakefield — thousands of hours saved.</p>
        </div>
        <div class="akcs-case-card">
          <div class="akcs-case-tag">Nero Network</div>
          <h3>Один смысл → четыре канала</h3>
          <p>Email-блок + рекламный заголовок + пост VK + лонгрид SEO — единый tone of voice и QA перед публикацией.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="akcs-section" id="faq">
    <div class="akcs-cnt">
      <div class="akcs-sh nero-ai-reveal">
        <span class="akcs-eyebrow">FAQ</span>
        <h2>Частые вопросы об AI-контенте для бизнеса</h2>
      </div>
      <div class="akcs-faq nero-ai-reveal" id="akcs-faq-accordion">
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Как внедрить AI-контент для бизнеса пошагово?</div><div class="akcs-faq-a"><p>1) Аудит каналов (3–5 дней). 2) База знаний и ToV (5–7 дней). 3) Пайплайн и QA (7–14 дней). 4) Пилот 20–50 единиц (2–4 недели). 5) Обучение и масштабирование. Первый шаг — <strong>контент-план на AI</strong>.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Какие задачи решает AI-контент-система?</div><div class="akcs-faq-a"><p>Регулярный выпуск без расширения штата, единый стиль across каналов, сокращение цикла «идея → публикация», прозрачная стоимость единицы, SEO/GEO, интеграция с CRM.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Можно ли внедрить без программиста?</div><div class="akcs-faq-a"><p>Да. Nero Network настраивает n8n/Make.com, GigaChat/YandexGPT API, WordPress и CRM. Команда работает через интерфейс и регламент — без кода.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Сколько стоит AI-контент для бизнеса?</div><div class="akcs-faq-a"><p>Ориентир: <strong>100–600 тыс. ₽</strong> за внедрение под ключ. Подписки на LLM API — отдельно.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Как заказать консультацию?</div><div class="akcs-faq-a"><p>Через CTA <strong>«Настроить AI-контент»</strong> — экспресс-аудит каналов и контент-план на AI с темами и приоритетами.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Не забанит ли Google и Яндекс за AI-тексты?</div><div class="akcs-faq-a"><p>Penalize низкое качество, не AI как таковой. Human-in-the-loop, RAG, QA — стандарт системного подхода. Кейс СберМаркетинга: 1200+ публикаций в год при росте качества.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Как обеспечивается качество?</div><div class="akcs-faq-a"><p>Три уровня: RAG на данных бренда, QA-агент с чеклистом, финальная редактура человеком.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Что с персональными данными и 152-ФЗ?</div><div class="akcs-faq-a"><p>GigaChat, YandexGPT, отечественные облака. RAG на ваших данных без утечки в публичные модели. On-premise — по запросу.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Чем это отличается от Jasper или Copilot?</div><div class="akcs-faq-a"><p>Jasper — SaaS для англоязычного рынка. Copilot — enterprise Microsoft. Nero Network строит <strong>вашу систему</strong> на российском стеке с WordPress, amoCRM, VK, Telegram — под ключ.</p></div></div>
        <div class="akcs-faq-item"><div class="akcs-faq-q" role="button" tabindex="0">Когда ждать первые результаты?</div><div class="akcs-faq-a"><p>Первые материалы — на <strong>первой неделе</strong> после настройки базы знаний. Пилот — <strong>2–4 недели</strong>.</p></div></div>
      </div>
    </div>
  </section>

</div>

<script>
(function(){
  var root = document.getElementById('akcs-faq-accordion');
  if (!root) return;
  root.querySelectorAll('.akcs-faq-q').forEach(function(q){
    function toggle(){ q.parentElement.classList.toggle('open'); }
    q.addEventListener('click', toggle);
    q.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); toggle(); }});
  });
})();
</script>

<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Как внедрить AI-контент для бизнеса пошагово?","acceptedAnswer":{"@type":"Answer","text":"Аудит каналов, база знаний и ToV, пайплайн и QA, пилот 20–50 единиц, обучение и масштабирование. Первый шаг — контент-план на AI."}},
{"@type":"Question","name":"Какие задачи решает AI-контент-система?","acceptedAnswer":{"@type":"Answer","text":"Регулярный выпуск без расширения штата, единый стиль across каналов, сокращение цикла идея-публикация, прозрачная стоимость единицы, SEO/GEO, интеграция с CRM."}},
{"@type":"Question","name":"Можно ли внедрить без программиста?","acceptedAnswer":{"@type":"Answer","text":"Да. Nero Network настраивает n8n/Make.com, GigaChat/YandexGPT API, WordPress и CRM. Команда работает через интерфейс и регламент — без кода."}},
{"@type":"Question","name":"Сколько стоит AI-контент для бизнеса?","acceptedAnswer":{"@type":"Answer","text":"Ориентир: 100–600 тыс. ₽ за внедрение под ключ. Подписки на LLM API — отдельно."}},
{"@type":"Question","name":"Как заказать консультацию?","acceptedAnswer":{"@type":"Answer","text":"Через CTA «Настроить AI-контент» — экспресс-аудит каналов и контент-план на AI с темами и приоритетами."}},
{"@type":"Question","name":"Не забанит ли Google и Яндекс за AI-тексты?","acceptedAnswer":{"@type":"Answer","text":"Penalize низкое качество, не AI как таковой. Human-in-the-loop, RAG, QA — стандарт системного подхода."}},
{"@type":"Question","name":"Как обеспечивается качество?","acceptedAnswer":{"@type":"Answer","text":"Три уровня: RAG на данных бренда, QA-агент с чеклистом, финальная редактура человеком."}},
{"@type":"Question","name":"Что с персональными данными и 152-ФЗ?","acceptedAnswer":{"@type":"Answer","text":"GigaChat, YandexGPT, отечественные облака. RAG на ваших данных без утечки в публичные модели."}},
{"@type":"Question","name":"Чем это отличается от Jasper или Copilot?","acceptedAnswer":{"@type":"Answer","text":"Nero Network строит вашу систему на российском стеке с WordPress, amoCRM, VK, Telegram — под ключ."}},
{"@type":"Question","name":"Когда ждать первые результаты?","acceptedAnswer":{"@type":"Answer","text":"Первые материалы — на первой неделе после настройки базы знаний. Пилот — 2–4 недели."}}
]}
</script>
<script>
(function(){
  var sl=document.querySelector('a.skip-link[href="#main"]');
  if(sl){sl.setAttribute('href','#primary');}
  var iw=document.getElementById('inner-wrap');
  var primary=document.getElementById('primary');
  if(iw&&primary&&iw!==primary){iw.removeAttribute('role');}
})();
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

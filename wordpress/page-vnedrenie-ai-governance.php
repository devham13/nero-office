<?php
/**
 * Template Name: Внедрение AI governance под ключ
 * Description: SEO-лендинг — управление и безопасность AI-агентов, пропорциональный контроль Gartner L1–L4.
 */

$page_seo_title       = 'AI governance под ключ: управление и безопасность AI-агентов';
$page_seo_description = 'Внедрение AI governance для бизнеса: роли, уровни автономности, аудит и circuit breakers. Настроим контроль AI-агентов без лишних доступов — по модели Gartner. Чек-лист AI-рисков.';

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
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Настроить контроль AI';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#urovni';

$nero_ai_header_links = [
    ['label' => 'Прогноз Gartner', 'href' => '#gartner'],
    ['label' => 'Уровни L1–L4', 'href' => '#urovni'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Compliance', 'href' => '#compliance'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
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

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

<style>
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

.vg-content{
  --vg-cyan:#79f2ff;--vg-violet:#8b5cf6;--vg-green:#22c55e;--vg-amber:#f59e0b;--vg-red:#fb7185;
  --vg-bg:#050711;--vg-bg2:#080b17;--vg-surface:rgba(255,255,255,.072);--vg-text:#e6edf7;--vg-muted:#9aa8bd;--vg-soft:#c7d2e5;--vg-heading:#fff;
  --vg-border:rgba(255,255,255,.10);--vg-btn-from:#2563eb;--vg-btn-to:#8b5cf6;--vg-r:18px;--vg-r-lg:24px;--vg-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);color:var(--vg-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vg-content *,.vg-content *::before,.vg-content *::after{box-sizing:border-box}
.vg-content a{color:inherit;text-decoration:none}
.vg-content p{color:var(--vg-muted);line-height:1.72;margin:0 0 1em}
.vg-content p:last-child{margin-bottom:0}
.vg-content h2,.vg-content h3,.vg-content h4{color:var(--vg-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vg-content strong{color:var(--vg-soft)}
.vg-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vg-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vg-muted);font-size:14.5px;line-height:1.65}
.vg-content ul li::before{content:'›';position:absolute;left:0;color:var(--vg-cyan);font-weight:700}
.vg-cnt{width:min(var(--vg-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vg-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vg-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vg-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vg-sh.vg-left{margin-left:0;text-align:left}
.vg-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vg-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vg-sh.vg-left p{margin-left:0}
.vg-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vg-cyan);margin-bottom:14px}
.vg-gt{background:linear-gradient(92deg,#fff 0%,var(--vg-cyan) 44%,var(--vg-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}

.vg-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vg-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vg-intro-text{position:relative;padding-left:20px;text-align:left!important}
.vg-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vg-cyan),var(--vg-violet))}
.vg-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vg-muted);margin-bottom:1em}
.vg-intro-text p:last-child{margin-bottom:0;color:var(--vg-soft)}
.vg-terminal{background:rgba(2,6,23,.55);border:1px solid rgba(121,242,255,.18);border-radius:16px;padding:18px;font-family:ui-monospace,monospace;font-size:12px;line-height:1.7;box-shadow:0 14px 40px rgba(0,0,0,.28)}
.vg-terminal .vg-t-line{display:flex;gap:10px;margin-bottom:6px}
.vg-terminal .vg-t-tag{color:var(--vg-cyan);font-weight:700;min-width:52px}
.vg-terminal .vg-t-val{color:#cbd5e1}
.vg-terminal .vg-t-ok{color:var(--vg-green)}
.vg-terminal .vg-t-warn{color:var(--vg-amber)}
@media(max-width:900px){.vg-intro-grid{grid-template-columns:1fr;gap:36px}}

.vg-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vg-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vg-toc a{display:inline-block;padding:9px 18px;background:var(--vg-surface);border:1px solid var(--vg-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vg-muted);transition:border-color .2s,color .2s,background .2s}
.vg-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vg-cyan);background:rgba(121,242,255,.08)}

.vg-bento{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:28px 0}
@media(max-width:768px){.vg-bento{grid-template-columns:1fr}}
.vg-stat{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:18px;padding:24px 20px;text-align:center}
.vg-stat strong{display:block;font-size:clamp(28px,4vw,42px);font-weight:900;color:var(--vg-heading);letter-spacing:-.04em;line-height:1;margin-bottom:8px}
.vg-stat span{font-size:13px;color:var(--vg-muted);line-height:1.5}
.vg-stat--amber{border-color:rgba(245,158,11,.35)}.vg-stat--amber strong{color:var(--vg-amber)}
.vg-stat--red{border-color:rgba(251,113,133,.35)}.vg-stat--red strong{color:var(--vg-red)}
.vg-stat--cyan{border-color:rgba(121,242,255,.35)}.vg-stat--cyan strong{color:var(--vg-cyan)}

.vg-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vg-border);border-radius:var(--vg-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22)}
.vg-callout{border-left:4px solid var(--vg-red);padding:18px 22px;background:rgba(251,113,133,.08);border-radius:0 14px 14px 0;margin:24px 0}
.vg-callout strong{color:var(--vg-red)}

.vg-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.vg-table{width:100%;border-collapse:collapse;font-size:14px}
.vg-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vg-cyan);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.vg-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vg-text);vertical-align:top}
.vg-table tr:last-child td{border-bottom:none}
.vg-table tr:hover td{background:rgba(255,255,255,.03)}
.vg-badge{display:inline-block;padding:3px 9px;border-radius:6px;font-size:11px;font-weight:700}
.vg-badge--l1{background:rgba(34,197,94,.15);color:#86efac}
.vg-badge--l2{background:rgba(121,242,255,.15);color:#a5f3fc}
.vg-badge--l3{background:rgba(245,158,11,.15);color:#fde68a}
.vg-badge--l4{background:rgba(251,113,133,.15);color:#fecdd3}

.vg-split{display:grid;grid-template-columns:1fr 1fr;gap:28px;align-items:start}
@media(max-width:900px){.vg-split{grid-template-columns:1fr}}
.vg-level-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--vg-r);padding:22px;margin-bottom:14px}
.vg-level-card h3{font-size:17px}

.vg-timeline{position:relative;padding-left:40px}
.vg-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vg-cyan),var(--vg-violet));opacity:.35;border-radius:2px}
.vg-tl-item{position:relative;margin-bottom:32px}
.vg-tl-item:last-child{margin-bottom:0}
.vg-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vg-cyan);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vg-tl-item h3{font-size:17px;margin-bottom:8px}
.vg-tl-item p{font-size:14.5px;margin:0}

.vg-chips{display:flex;flex-wrap:wrap;gap:10px;margin:20px 0}
.vg-chip{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;border:1px solid rgba(121,242,255,.25);background:rgba(121,242,255,.08);color:var(--vg-cyan)}

.vg-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vg-case-grid{grid-template-columns:1fr}}
.vg-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px}
.vg-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vg-green);margin-bottom:10px}
.vg-case-card h3{font-size:16px;margin-bottom:14px}

.vg-checklist{list-style:none;padding:0;margin:0}
.vg-checklist li{display:flex;gap:10px;align-items:flex-start;padding:10px 0;border-bottom:1px solid rgba(255,255,255,.06);font-size:14px;color:var(--vg-muted)}
.vg-checklist li::before{content:'☐';color:var(--vg-cyan);font-weight:800;flex-shrink:0}
.vg-checklist-group{margin-bottom:28px}
.vg-checklist-group h3{font-size:15px;color:var(--vg-soft);margin-bottom:8px}

.vg-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vg-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vg-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vg-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.vg-faq-q::after{content:'▾';font-size:13px;color:var(--vg-cyan);flex-shrink:0;transition:transform .25s}
.vg-faq-item.open .vg-faq-q::after{transform:rotate(180deg)}
.vg-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vg-muted);line-height:1.72}
.vg-faq-item.open .vg-faq-a{max-height:800px;padding:0 24px 20px}

.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vg-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s}
.ym-btn:hover{transform:translateY(-2px)}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vg-btn-from),var(--vg-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--vg-text)!important;border:1.5px solid rgba(255,255,255,.18)}
.ym-link--accent{color:var(--vg-cyan)!important;text-decoration:underline!important}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}

.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}
.nero-ai-delay-2{transition-delay:.24s}
</style>
<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-governance-page" role="main" tabindex="-1">

<section class="nero-ai-hero vg-hero-governance" id="hero" aria-labelledby="vg-hero-governance-title">
<style>
/* ── Hero vnedrenie-ai-governance: самодостаточные стили ── */
.vg-hero-governance {
  --vg-cyan: #79f2ff;
  --vg-violet: #8b5cf6;
  --vg-green: #22c55e;
  --vg-amber: #f59e0b;
  --vg-red: #fb7185;
  --vg-text: #e6edf7;
  --vg-muted: #9aa8bd;
  --vg-soft: #c7d2e5;
  --vg-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vg-hero-governance::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.vg-hero-governance::after {
  content: "";
  position: absolute;
  left: 6%;
  top: 10%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background:
    radial-gradient(circle, rgba(121,242,255,.12), transparent 66%),
    radial-gradient(circle at 70% 40%, rgba(139,92,246,.10), transparent 58%);
  filter: blur(8px);
  animation: vgHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vgHeroGlow {
  from { opacity: .42; transform: scale(.95); }
  to { opacity: .88; transform: scale(1.05); }
}
.vg-hero-governance .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vg-hero-governance .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vg-hero-governance .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.vg-hero-governance .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vg-cyan) 38%, var(--vg-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vg-hero-governance .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vg-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.vg-hero-governance .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--vg-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vg-hero-governance .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vg-hero-governance .nero-ai-badge {
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
.vg-hero-governance .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vg-hero-governance .nero-ai-btn {
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
.vg-hero-governance .nero-ai-btn:hover { transform: translateY(-2px); }
.vg-hero-governance .nero-ai-btn-primary {
  color: #fff !important;
  background: linear-gradient(135deg, #2563eb, var(--vg-violet));
  box-shadow: 0 18px 42px rgba(139, 92, 246, 0.28);
}
.vg-hero-governance .nero-ai-btn-secondary {
  color: var(--vg-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vg-hero-governance .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vg-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.vg-hero-governance .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vg-hero-governance .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vg-hero-governance .nero-ai-dots { display: flex; gap: 7px; }
.vg-hero-governance .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vg-hero-governance .nero-ai-dot:nth-child(1) { background: var(--vg-red); }
.vg-hero-governance .nero-ai-dot:nth-child(2) { background: var(--vg-amber); }
.vg-hero-governance .nero-ai-dot:nth-child(3) { background: var(--vg-green); }
.vg-hero-governance .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vg-hero-governance .nero-ai-window-body { padding: 16px; }
.vg-hero-governance .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vg-hero-governance .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vg-hero-governance .nero-ai-live-pill {
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
.vg-hero-governance .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--vg-green);
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vgPulse 1.6s infinite;
}
@keyframes vgPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vg-hero-governance .vg-level-rows {
  display: grid;
  gap: 6px;
  margin-bottom: 12px;
}
.vg-hero-governance .vg-level-row {
  display: grid;
  grid-template-columns: 36px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 8px 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 12px;
  background: rgba(255,255,255,.04);
  font-size: 11px;
}
.vg-hero-governance .vg-level-tag {
  display: grid;
  place-items: center;
  width: 36px;
  height: 24px;
  border-radius: 8px;
  font-weight: 900;
  font-size: 10px;
  letter-spacing: .04em;
}
.vg-hero-governance .vg-level-tag--l1 { background: rgba(34,197,94,.15); color: #86efac; }
.vg-hero-governance .vg-level-tag--l2 { background: rgba(121,242,255,.12); color: #a5f3fc; }
.vg-hero-governance .vg-level-tag--l3 { background: rgba(245,158,11,.14); color: #fde68a; }
.vg-hero-governance .vg-level-tag--l4 { background: rgba(251,113,133,.14); color: #fecdd3; }
.vg-hero-governance .vg-level-row strong { color: #f8fafc; font-size: 11px; }
.vg-hero-governance .vg-level-row span.vg-level-desc { color: var(--vg-muted); font-size: 10px; display: block; }
.vg-hero-governance .vg-pill-status {
  padding: 4px 8px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vg-hero-governance .vg-pill-status--green { background: rgba(34,197,94,.12); color: #bbf7d0; }
.vg-hero-governance .vg-pill-status--cyan { background: rgba(121,242,255,.12); color: #a5f3fc; }
.vg-hero-governance .vg-pill-status--amber { background: rgba(245,158,11,.14); color: #fde68a; }
.vg-hero-governance .vg-pill-status--red { background: rgba(251,113,133,.14); color: #fecdd3; }
.vg-hero-governance .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 8px;
  margin-bottom: 12px;
}
.vg-hero-governance .nero-ai-metric {
  padding: 10px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 14px;
  background: rgba(255,255,255,.055);
}
.vg-hero-governance .nero-ai-metric span {
  display: block;
  color: var(--vg-muted);
  font-size: 10px;
  font-weight: 700;
}
.vg-hero-governance .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  color: #fff;
  font-size: 18px;
  line-height: 1;
}
.vg-hero-governance .nero-ai-metric small {
  display: block;
  margin-top: 3px;
  color: #9fb0c9;
  font-size: 10px;
}
.vg-hero-governance .vg-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 50% 42%, rgba(121,242,255,.08), rgba(6,10,24,.94) 72%);
}
.vg-hero-governance #vg-governance-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vg-hero-governance .nero-ai-task-stream { display: grid; gap: 8px; }
.vg-hero-governance .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vg-hero-governance .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vg-cyan);
  font-size: 10px;
  font-weight: 800;
}
.vg-hero-governance .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vg-hero-governance .nero-ai-task span {
  color: var(--vg-muted);
  font-size: 11px;
}
.vg-hero-governance .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vg-hero-governance .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.vg-hero-governance .nero-ai-status--red {
  background: rgba(251,113,133,.12);
  color: #fecdd3;
}
@media (max-width: 1100px) {
  .vg-hero-governance .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vg-hero-governance .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vg-hero-governance .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vg-hero-governance .nero-ai-metrics-grid { grid-template-columns: 1fr; }
  .vg-hero-governance .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vg-hero-governance .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · AI governance · Gartner 2026</p>
      <h1 id="vg-hero-governance-title">Управление и безопасность AI-агентов: <span class="nero-ai-gradient-text">внедрение AI governance под ключ</span></h1>
      <p class="nero-ai-hero-lead">Пропорциональный контроль вместо единых правил: настроим роли, уровни автономности и защиту AI-агентов — по модели Gartner, без лишних доступов и без «полного доверия» автономным ботам</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">4 уровня автономности</li>
        <li class="nero-ai-badge">152-ФЗ / compliance</li>
        <li class="nero-ai-badge">Make · n8n · MCP</li>
        <li class="nero-ai-badge">пилот 4–8 недель</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Настроить контроль AI'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#urovni">4 уровня контроля</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="AI Governance Control Center — демо-дашборд">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики governance · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI Governance Control Center</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>

          <div class="vg-level-rows" aria-label="Уровни автономности Gartner">
            <div class="vg-level-row">
              <span class="vg-level-tag vg-level-tag--l1">L1</span>
              <div><strong>Observe</strong><span class="vg-level-desc">RAG read-only · scoped access</span></div>
              <span class="vg-pill-status vg-pill-status--green">безопасно</span>
            </div>
            <div class="vg-level-row">
              <span class="vg-level-tag vg-level-tag--l2">L2</span>
              <div><strong>Advise</strong><span class="vg-level-desc">черновики · human executes</span></div>
              <span class="vg-pill-status vg-pill-status--cyan">рекомендации</span>
            </div>
            <div class="vg-level-row">
              <span class="vg-level-tag vg-level-tag--l3">L3</span>
              <div><strong>Act with approval</strong><span class="vg-level-desc">write после approve в Telegram</span></div>
              <span class="vg-pill-status vg-pill-status--amber">ожидает OK</span>
            </div>
            <div class="vg-level-row">
              <span class="vg-level-tag vg-level-tag--l4">L4</span>
              <div><strong>Act autonomously</strong><span class="vg-level-desc">guardrails + circuit breaker</span></div>
              <span class="vg-pill-status vg-pill-status--red">armed</span>
            </div>
          </div>

          <div class="nero-ai-metrics-grid" aria-label="Метрики риска">
            <div class="nero-ai-metric">
              <span>Инциденты 2026</span>
              <strong>42%</strong>
              <small>Информзащита</small>
            </div>
            <div class="nero-ai-metric">
              <span>Демонтаж к 2027</span>
              <strong>40%</strong>
              <small>прогноз Gartner</small>
            </div>
            <div class="nero-ai-metric">
              <span>Circuit breaker</span>
              <strong>armed</strong>
              <small>kill switch готов</small>
            </div>
          </div>

          <div class="vg-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vg-governance-hero-canvas" role="img" aria-label="Анимация: агенты проходят шлюз политик, audit log и circuit breaker в диспетчерской governance"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий governance">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">L1</span>
              <div><strong>RAG · Confluence</strong><span>read-only · audit OK</span></div>
              <span class="nero-ai-status">logged</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">L3</span>
              <div><strong>approve → amoCRM</strong><span>сделка после Telegram OK</span></div>
              <span class="nero-ai-status nero-ai-status--amber">approve</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CB</span>
              <div><strong>circuit breaker</strong><span>L4 аномалия · агент изолирован</span></div>
              <span class="nero-ai-status nero-ai-status--red">tripped</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="vg-content">

<section class="vg-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
  <div class="vg-cnt nero-ai-container">
    <div class="vg-intro-grid nero-ai-reveal">
      <div class="vg-intro-text">
        <p class="nero-ai-eyebrow">AI governance · Gartner 2026</p>
        <p>Компании масштабируют <strong>внедрение AI в бизнес</strong> быстрее, чем выстраивают контроль: чат-боты в поддержке, сценарии в Make и n8n, MCP-агенты с доступом к CRM и 1С, корпоративные Copilot-плагины. Каждый такой контур — это уже не «просто нейросеть», а <strong>AI-агент</strong> с правами на данные и действия.</p>
        <p><strong>Nero Network</strong> внедряет <strong>AI governance под ключ</strong>: пропорциональный контроль по уровням автономности, роли, аудит, approval workflows и circuit breakers — без блокировки простых агентов и без «полного доверия» автономным ботам.</p>
        <!-- INTERNAL-LINKS:INSERT -->
      </div>
      <div class="vg-terminal" aria-label="Схема пайплайна governance">
        <div class="vg-t-line"><span class="vg-t-tag">agent</span><span class="vg-t-val">→ Policy Gateway</span></div>
        <div class="vg-t-line"><span class="vg-t-tag">L1</span><span class="vg-t-val vg-t-ok">read · log · audit OK</span></div>
        <div class="vg-t-line"><span class="vg-t-tag">L3</span><span class="vg-t-val vg-t-warn">approve → Telegram OK</span></div>
        <div class="vg-t-line"><span class="vg-t-tag">audit</span><span class="vg-t-val">prompt → tool → outcome</span></div>
        <div class="vg-t-line"><span class="vg-t-tag">L4</span><span class="vg-t-val">circuit breaker · sandbox</span></div>
      </div>
    </div>
  </div>
</section>

<div class="vg-toc-outer"><div class="vg-cnt"><nav class="vg-toc ym-toc" aria-label="Оглавление статьи">
  <a href="#gartner">Gartner 2026</a>
  <a href="#chto-takoe">Что такое</a>
  <a href="#riski">Риски</a>
  <a href="#urovni">Уровни L1–L4</a>
  <a href="#vnedrenie">Внедрение</a>
  <a href="#compliance">Compliance</a>
  <a href="#ceny">Стоимость</a>
  <a href="#keisy">Кейсы</a>
  <a href="#faq">FAQ</a>
  <a href="#cheklist">Чек-лист</a>
</nav></div></div>

<section class="vg-section ym-section" id="gartner">
  <div class="vg-cnt ym-container">
    <div class="vg-sh nero-ai-reveal">
      <span class="vg-eyebrow">Gartner · май 2026</span>
      <h2>Почему единое AI governance ломает агентов: прогноз Gartner на 2026–2027</h2>
      <p>«One-size-fits-all» governance для всех AI-агентов — прямой путь к срыву масштабирования. К 2027 году <strong>40% предприятий демонтируют автономных агентов</strong> из‑за пробелов в контроле.</p>
    </div>
    <div class="vg-bento nero-ai-reveal">
      <div class="vg-stat vg-stat--amber"><strong>40%</strong><span>демонтаж агентов к 2027 — прогноз Gartner</span></div>
      <div class="vg-stat vg-stat--red"><strong>42%</strong><span>компаний с инцидентами ИИ-агентов в 2026</span></div>
      <div class="vg-stat vg-stat--cyan"><strong>58%</strong><span>тратят &gt;5 часов на расследование без audit trail</span></div>
    </div>
    <div class="vg-split nero-ai-reveal nero-ai-delay-1">
      <div class="vg-card">
        <h3>40% компаний демонтируют агентов к 2027</h3>
        <p>Прогноз Gartner — следствие реальных инцидентов. Исследование «Информзащиты» (CNews, 26.05.2026): <strong>42%</strong> организаций столкнулись с инцидентами ИИ-агентов. Демонтаж — потеря автоматизации, репутационный ущерб, штрафы по 152-ФЗ.</p>
      </div>
      <div class="vg-card">
        <h3>Два провала: over-restriction и under-restriction</h3>
        <p><strong>Over-restriction</strong> — жёсткие запреты на RAG-бота → shadow AI. <strong>Under-restriction</strong> — write-доступ без approval: <strong>53%</strong> фиксировали превышение полномочий агентами. Пропорциональный контроль — ответ Gartner.</p>
      </div>
    </div>
  </div>
</section>

<section class="vg-section vg-section-alt ym-section ym-section-alt" id="chto-takoe">
  <div class="vg-cnt ym-container">
    <div class="vg-sh nero-ai-reveal">
      <span class="vg-eyebrow">Определение</span>
      <h2>Что такое AI governance и чем отличается от «запрета нейросетей»</h2>
      <p><strong>AI governance</strong> — управляемый контур вокруг AI-агентов: кто что может читать и писать, кто утверждает действия, что логируется, как остановить агента при аномалии.</p>
    </div>
    <div class="vg-table-wrap nero-ai-reveal ym-table">
      <table class="vg-table">
        <thead><tr><th>Область</th><th>Фокус</th><th>Пример</th></tr></thead>
        <tbody>
          <tr><td>Политика ИБ</td><td>Общие правила работы с данными</td><td>Запрет передачи ПДн во внешние API</td></tr>
          <tr><td>MLOps</td><td>Жизненный цикл моделей</td><td>Деплой и A/B тест LLM</td></tr>
          <tr><td><strong>AI governance</strong></td><td>Поведение агентов в продакшене</td><td>Сделка в amoCRM только после approve в Telegram</td></tr>
        </tbody>
      </table>
    </div>
    <div class="vg-card nero-ai-reveal nero-ai-delay-1" style="margin-top:28px">
      <h3>Кому нужен AI governance</h3>
      <ul>
        <li><strong>Собственник и CEO</strong> — снимает риск «агент сделал за нас»</li>
        <li><strong>CISO и ИБ</strong> — audit log, kill switch, карта рисков</li>
        <li><strong>IT и интеграторы</strong> — единый шаблон для Make/n8n/MCP</li>
        <li><strong>Compliance</strong> — доказуемость контроля ПДн и журналирование</li>
      </ul>
    </div>
  </div>
</section>

<section class="vg-section ym-section" id="riski">
  <div class="vg-cnt ym-container">
    <div class="vg-sh vg-left nero-ai-reveal">
      <span class="vg-eyebrow">Безопасность</span>
      <h2>Риски AI-агентов без контроля: доступы, ошибки, действия без одобрения</h2>
      <p>Только <strong>5%</strong> компаний используют единую платформу агентов; <strong>27%</strong> агентов не инвентаризированы. Каждый неучтённый агент — вектор OWASP Agentic Top 10.</p>
    </div>
    <div class="vg-callout nero-ai-reveal"><p><strong>53%</strong> организаций фиксировали, что агенты превышали заданные полномочия. С least privilege — инциденты у <strong>17%</strong>; без практики — у <strong>76%</strong>.</p></div>
    <div class="vg-split nero-ai-reveal nero-ai-delay-1">
      <div>
        <h3>Лишние права к CRM, ERP, почте и API</h3>
        <p>Admin-токен amoCRM без scoped access: любая галлюцинация или prompt injection — действие в CRM. Read-only для отчётов (L1–L2) и write в документы (L3+) — разные миры по риску.</p>
      </div>
      <div>
        <h3>Галлюцинации и автономные действия</h3>
        <p>Агент L4 без guardrails может отправить КП с неверной ценой или утечь данные. <em>«Компания видит выполнение задачи, но не видит цепочку решений»</em> — Анатолий Песковский, «Информзащита».</p>
      </div>
    </div>
  </div>
</section>

<section class="vg-section vg-section-alt ym-section ym-section-alt" id="urovni">
  <div class="vg-cnt ym-container">
    <div class="vg-sh nero-ai-reveal">
      <span class="vg-eyebrow">Методология Gartner</span>
      <h2>Пропорциональное управление: 4 уровня автономности AI-агентов</h2>
      <p>Матрица: агент → уровень → разрешённые tools → обязательные контроли.</p>
    </div>
    <div class="vg-table-wrap nero-ai-reveal ym-table">
      <table class="vg-table">
        <thead><tr><th>Уровень</th><th>Автономность</th><th>Базовые контроли</th><th>Примеры</th></tr></thead>
        <tbody>
          <tr><td><span class="vg-badge vg-badge--l1">L1 Observe</span></td><td>Только чтение, RAG</td><td>Scoped access, logging</td><td>RAG по Confluence; отчёт из CRM read-only</td></tr>
          <tr><td><span class="vg-badge vg-badge--l2">L2 Advise</span></td><td>Черновики, человек исполняет</td><td>+ hallucination testing</td><td>Черновик КП; подсказка в amoCRM</td></tr>
          <tr><td><span class="vg-badge vg-badge--l3">L3 Act with approval</span></td><td>Write после approve</td><td>+ audit trails, incident response</td><td>Сделка, письмо — после Telegram OK</td></tr>
          <tr><td><span class="vg-badge vg-badge--l4">L4 Act autonomously</span></td><td>Действия в guardrails</td><td>+ circuit breakers, rollback</td><td>Ночная синхронизация в лимитах</td></tr>
        </tbody>
      </table>
    </div>

    <section id="vnedrenie-ai-governance-boris-block" class="vgov-root" aria-label="Анимация: агенты проходят через Policy Gateway по уровням автономности L1–L4">
<style>
/* === БОРИС: prefix vgov-, scoped внутри #vnedrenie-ai-governance-boris-block === */
#vnedrenie-ai-governance-boris-block.vgov-root{
  padding:48px 0 56px;
  background:#f8fafc;
}
#vnedrenie-ai-governance-boris-block .vgov-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-governance-boris-block .vgov-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:520px;
}
@media(max-width:1023px){
  #vnedrenie-ai-governance-boris-block .vgov-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-governance-boris-block .vgov-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-governance-boris-block .vgov-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-governance-boris-block .vgov-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#8b5cf6;
  margin:0 0 14px;
}
#vnedrenie-ai-governance-boris-block .vgov-ey::before{
  content:'';
  width:18px;height:2px;
  background:linear-gradient(90deg,#79f2ff,#8b5cf6);
  border-radius:1px;
}
#vnedrenie-ai-governance-boris-block .vgov-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-ai-governance-boris-block .vgov-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-governance-boris-block .vgov-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-governance-boris-block .vgov-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(139,92,246,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:10px;
  font-weight:800;
  color:#7c3aed;
  margin-top:1px;
  font-style:normal;
}
#vnedrenie-ai-governance-boris-block .vgov-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnedrenie-ai-governance-boris-block .vgov-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-governance-boris-block .vgov-pl-l1{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-governance-boris-block .vgov-pl-l2{
  background:rgba(121,242,255,.12);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.35);
}
#vnedrenie-ai-governance-boris-block .vgov-pl-l3{
  background:rgba(245,158,11,.08);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.28);
}
#vnedrenie-ai-governance-boris-block .vgov-pl-l4{
  background:rgba(251,113,133,.08);
  color:#be123c;
  border:1.5px solid rgba(251,113,133,.28);
}
#vnedrenie-ai-governance-boris-block .vgov-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-governance-boris-block .vgov-rgt{
  position:relative;
  background:linear-gradient(135deg,#f5f3ff 0%,#ecfeff 42%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-governance-boris-block .vgov-rgt{min-height:380px;}
}
#vgov-policy-gateway-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="vgov-cnt">
  <div class="vgov-card">

    <div class="vgov-lft">
      <span class="vgov-ey">Policy Gateway · Gartner L1–L4</span>
      <h3 class="vgov-h3">Один шлюз — разные правила: от read-only RAG до approve в Telegram</h3>
      <ul class="vgov-ul">
        <li><span class="vgov-ic">L1</span><strong>Observe</strong> — scoped access, логирование; агент читает CRM/базу без write</li>
        <li><span class="vgov-ic">L2</span><strong>Advise</strong> — черновик и рекомендация; человек исполняет сам</li>
        <li><span class="vgov-ic">L3</span><strong>Act with approval</strong> — tool-call ждёт кнопку в очереди approve</li>
        <li><span class="vgov-ic">!</span><strong>L4 + circuit breaker</strong> — автономия только в guardrails; kill switch при аномалии</li>
      </ul>
      <div class="vgov-pills">
        <span class="vgov-pl vgov-pl-l1">L1 read-only</span>
        <span class="vgov-pl vgov-pl-l2">L2 advise</span>
        <span class="vgov-pl vgov-pl-l3">L3 approve</span>
        <span class="vgov-pl vgov-pl-l4">circuit breaker</span>
      </div>
      <p class="vgov-foot">Дальше разберём, что входит во внедрение AI governance под ключ →</p>
    </div>

    <div class="vgov-rgt">
      <canvas
        id="vgov-policy-gateway-canvas"
        aria-label="Анимация: AI-агенты разных уровней автономности проходят через Policy Gateway — approve, audit log и circuit breaker"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('vgov-policy-gateway-canvas');
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
    panel:'#ffffff',
    panelBdr:'#e2e8f0',
    l1:'#22c55e',
    l1bg:'rgba(34,197,94,.12)',
    l2:'#06b6d4',
    l2bg:'rgba(121,242,255,.18)',
    l3:'#f59e0b',
    l3bg:'rgba(245,158,11,.14)',
    l4:'#fb7185',
    l4bg:'rgba(251,113,133,.14)',
    violet:'#8b5cf6',
    violetBg:'rgba(139,92,246,.12)',
    gateway:'#1e293b',
    audit:'#0f172a',
    line:'rgba(139,92,246,.28)',
    ok:'#22c55e',
    warn:'#f59e0b',
    danger:'#ef4444'
  };

  var LEVELS = [
    {id:'L1', label:'Observe', sub:'read · log', color:C.l1, bg:C.l1bg},
    {id:'L2', label:'Advise', sub:'draft', color:C.l2, bg:C.l2bg},
    {id:'L3', label:'Approve', sub:'human OK', color:C.l3, bg:C.l3bg},
    {id:'L4', label:'Autonomous', sub:'guardrails', color:C.l4, bg:C.l4bg}
  ];

  var LOOP = 720;
  var agents = [];
  var auditLines = [];
  var breakerFlash = 0;
  var approvePulse = 0;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function spawnAgent(){
    var lvl = Math.floor(Math.random()*4);
    var names = ['RAG-бот','n8n CRM','MCP-mail','Make sync','Copilot HR'];
    agents.push({
      level: lvl,
      name: names[Math.floor(Math.random()*names.length)],
      x: -50,
      phase: 0,
      speed: 0.9 + Math.random()*0.5,
      approved: false,
      tripped: false,
      alpha: 1
    });
  }

  function pushAudit(text, clr){
    auditLines.unshift({text:text, color:clr||C.muted, life:220});
    if(auditLines.length>6) auditLines.pop();
  }

  function laneY(i){
    var top = H*0.14;
    var laneH = (H*0.72) / 4;
    return top + i*laneH + laneH*0.42;
  }

  function drawGateway(gx, gy, gw, gh){
    rr(gx,gy,gw,gh,14,C.gateway,'#334155',2);
    ctx.fillStyle='#f8fafc';
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Policy Gateway',gx+gw/2,gy+20);
    ctx.fillStyle=C.violet;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText('allowlist · PII · RBAC',gx+gw/2,gy+34);

    LEVELS.forEach(function(lv,i){
      var ly = gy + 44 + i*((gh-56)/4);
      var lh = (gh-60)/4 - 4;
      rr(gx+8,ly,gw-16,lh,6,lv.bg,lv.color,1);
      ctx.fillStyle=lv.color;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(lv.id+' · '+lv.label,gx+14,ly+lh*0.55);
    });

    if(approvePulse>0){
      var py = gy + 44 + 2*((gh-56)/4) + 8;
      ctx.globalAlpha = Math.min(1, approvePulse/30);
      rr(gx+gw-42,py,32,18,9,C.l3,'#fff',0);
      ctx.fillStyle='#fff';
      ctx.font='bold 8px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('OK',gx+gw-26,py+12);
      ctx.globalAlpha=1;
      approvePulse--;
    }

    if(breakerFlash>0){
      ctx.globalAlpha = Math.min(0.85, breakerFlash/40);
      rr(gx+6,gy+gh-28,gw-12,20,6,'rgba(239,68,68,.25)',C.danger,2);
      ctx.fillStyle=C.danger;
      ctx.font='bold 8px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('CIRCUIT BREAKER',gx+gw/2,gy+gh-14);
      ctx.globalAlpha=1;
      breakerFlash--;
    }
  }

  function drawAuditPanel(ax, ay, aw, ah){
    rr(ax,ay,aw,ah,12,C.panel,C.panelBdr,1.5);
    ctx.fillStyle=C.ink;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Audit log · append-only',ax+12,ay+18);
    ctx.fillStyle=C.ok;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='right';
    ctx.fillText('live',ax+aw-12,ay+18);

    auditLines.forEach(function(line,i){
      var ly = ay + 32 + i*22;
      if(ly > ay+ah-10) return;
      ctx.globalAlpha = Math.min(1, line.life/80);
      ctx.fillStyle=line.color;
      ctx.font='8.5px ui-monospace,monospace';
      ctx.textAlign='left';
      ctx.fillText(line.text, ax+10, ly);
      ctx.globalAlpha=1;
      line.life--;
    });
  }

  function drawAgent(ag, laneIdx){
    var lv = LEVELS[ag.level];
    var y = laneY(laneIdx) - 12;
    var w = 44, h = 24;
    rr(ag.x, y, w, h, 7, lv.bg, lv.color, 1.5);
    ctx.fillStyle=lv.color;
    ctx.font='bold 8px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(lv.id, ag.x+w/2, y+10);
    ctx.fillStyle=C.ink;
    ctx.font='7px Inter,sans-serif';
    var nm = ag.name.length>9 ? ag.name.slice(0,8)+'…' : ag.name;
    ctx.fillText(nm, ag.x+w/2, y+20);

    if(ag.level===1 && ag.phase>0.35 && ag.phase<0.65){
      rr(ag.x+w+6,y-4,52,18,6,'#fff',C.l2,1);
      ctx.fillStyle=C.l2;
      ctx.font='7px Inter,sans-serif';
      ctx.fillText('черновик', ag.x+w+32, y+8);
    }
    if(ag.level===2 && ag.phase>0.42 && ag.phase<0.72 && !ag.approved){
      ctx.strokeStyle=C.l3;
      ctx.lineWidth=2;
      ctx.setLineDash([3,3]);
      ctx.strokeRect(ag.x-3,y-3,w+6,h+6);
      ctx.setLineDash([]);
    }
    if(ag.tripped){
      ctx.fillStyle=C.danger;
      ctx.font='bold 14px sans-serif';
      ctx.fillText('⏻', ag.x+w+8, y+14);
    }
  }

  function loop(){
    frame++;
    var t = frame % LOOP;
    ctx.clearRect(0,0,W,H);

    var pad = Math.max(10, W*0.02);
    var gw = Math.min(118, W*0.2);
    var gh = H*0.78;
    var gx = W*0.38 - gw/2;
    var gy = H*0.11;
    var ax = W - Math.min(150, W*0.24) - pad;
    var ay = gy;
    var aw = Math.min(150, W*0.24);
    var ah = gh;

    if(frame % 95 === 0) spawnAgent();

    drawGateway(gx, gy, gw, gh);
    drawAuditPanel(ax, ay, aw, ah);

    LEVELS.forEach(function(lv,i){
      var ly = laneY(i);
      ctx.strokeStyle='rgba(148,163,184,.25)';
      ctx.lineWidth=1;
      ctx.setLineDash([5,6]);
      ctx.beginPath();
      ctx.moveTo(pad, ly);
      ctx.lineTo(ax-8, ly);
      ctx.stroke();
      ctx.setLineDash([]);
    });

    agents = agents.filter(function(ag){
      ag.phase = Math.min(1, ag.phase + 0.004*ag.speed);
      var endX = ax - 20;
      var gateX = gx - 8;
      var prog = ag.phase;

      if(prog < 0.38){
        ag.x = pad + (gateX - pad)*prog/0.38;
      } else if(prog < 0.42){
        ag.x = gateX;
        if(ag.level===2 && !ag.approved && frame%120===0){
          approvePulse = 35;
          ag.approved = true;
          pushAudit('L3 approve → amoCRM OK', C.l3);
        }
        if(ag.level===0 && frame%140===0) pushAudit('L1 read CRM · audit OK', C.l1);
        if(ag.level===1 && frame%130===0) pushAudit('L2 draft saved · no write', C.l2);
        if(ag.level===2 && !ag.approved) return true;
      } else if(prog < 0.78){
        if(ag.level===2 && !ag.approved) return true;
        var p2 = (prog-0.42)/0.36;
        ag.x = gateX + (endX - gateX)*p2;
        if(ag.level===2 && ag.approved && p2>0.5 && !ag._logged){
          ag._logged=true;
        }
        if(ag.level===1 && p2>0.6 && !ag._logged){
          ag._logged=true;
          pushAudit('L2 → operator sends', C.l2);
        }
      } else {
        if(ag.level===2 && !ag.approved) return true;
        var p3 = (prog-0.78)/0.22;
        ag.x = endX + (ax - endX)*p3;
        if(p3>0.85){
          if(ag.level>=2) pushAudit('tool-call logged · hash '+Math.floor(Math.random()*9999), C.violet);
          return false;
        }
      }

      if(ag.level===3 && frame%200===0 && Math.random()>0.65){
        ag.tripped=true;
        breakerFlash=50;
        pushAudit('L4 anomaly · breaker TRIP', C.danger);
      }

      drawAgent(ag, ag.level);
      return true;
    });

    if(frame===1){
      pushAudit('gateway online · 4 tiers', C.violet);
      pushAudit('scoped access enforced', C.l1);
    }

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('agent → policy → audit', pad, H-pad);

    requestAnimationFrame(loop);
  }

  loop();
})();
</script>
</section>

    <div class="vg-level-card nero-ai-reveal"><h3>Observe — только наблюдение и логирование</h3><p>Агент не меняет системы. Лёгкий контроль — иначе shadow AI. Входная точка для внедрения нейросетей в отдел.</p></div>
    <div class="vg-level-card nero-ai-reveal nero-ai-delay-1"><h3>Advise — рекомендации без исполнения</h3><p>Модель предлагает текст и маршрут — исполняет человек. Критичны проверки на галлюцинации и automation bias.</p></div>
    <div class="vg-level-card nero-ai-reveal nero-ai-delay-2"><h3>Act with approval — действие после согласования</h3><p>Золотая середина: агент готовит операцию, человек подтверждает в approval queue. Важно не допустить approval fatigue.</p></div>
    <div class="vg-level-card nero-ai-reveal nero-ai-delay-1"><h3>Act autonomously — автономия с жёсткими guardrails</h3><p>L4 допустим только с circuit breakers, spend caps, rollback и владельцем агента. Для среднего бизнеса — отложенный L4.</p></div>
  </div>
</section>

<section class="vg-section ym-section" id="vnedrenie">
  <div class="vg-cnt ym-container">
    <div class="vg-sh nero-ai-reveal">
      <span class="vg-eyebrow">Услуга под ключ</span>
      <h2>Что входит во внедрение AI governance под ключ</h2>
      <p>Ориентир <strong>4–8 недель</strong> на пилот; чек <strong>400 тыс.–2 млн ₽</strong>.</p>
    </div>
    <div class="vg-timeline nero-ai-reveal">
      <div class="vg-tl-item"><div class="vg-tl-dot"></div><h3>1. Аудит (1–2 недели)</h3><p>Инвентаризация чат-ботов, Make/n8n, MCP, Copilot-плагинов, скриптов в CRM/1С.</p></div>
      <div class="vg-tl-item"><div class="vg-tl-dot"></div><h3>2. Классификация (1–2 недели)</h3><p>Матрица «агент → L1–L4 → allowlist API → контроли»; согласование с ИБ.</p></div>
      <div class="vg-tl-item"><div class="vg-tl-dot"></div><h3>3. Gateway и policy (2–4 недели)</h3><p>Agent Gateway, policy engine, audit log, circuit breaker, rollback.</p></div>
      <div class="vg-tl-item"><div class="vg-tl-dot"></div><h3>4. Пилот и масштабирование</h3><p>2–3 агента разных уровней; интеграция Make/n8n, MCP, amoCRM, 1С, Telegram.</p></div>
    </div>
    <div class="vg-card nero-ai-reveal nero-ai-delay-1" style="margin-top:32px">
      <h3>Интеграции без замены стека</h3>
      <p>Governance-слой поверх Make/n8n, MCP, amoCRM, Bitrix24, 1С, Telegram, YandexGPT/GigaChat — с обезличиванием под 152-ФЗ. Фокус — контроль агентов в любых интеграциях.</p>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </div>
</section>

<aside class="ym-cta-block ym-cta-block--primary" id="cta-vnedrenie">
  <div class="ym-cta-block__icon" aria-hidden="true">🛡️</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Настроить контроль AI-агентов под ваш стек</p>
    <p class="ym-cta-block__sub">Проведём аудит Make/n8n, MCP, amoCRM и 1С, классифицируем агентов по L1–L4 и запустим пилот с gateway, audit log и approve в Telegram. Ориентир — 4–8 недель.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Настроить контроль AI'); ?></a>
  </div>
</aside>

<section class="vg-section vg-section-alt ym-section ym-section-alt" id="compliance">
  <div class="vg-cnt ym-container">
    <div class="vg-sh nero-ai-reveal">
      <span class="vg-eyebrow">Регуляторика РФ</span>
      <h2>AI governance для компании: политики, compliance и 152-ФЗ</h2>
      <p>Технический контур + внутренние политики и регуляторные требования.</p>
    </div>
    <div class="vg-chips nero-ai-reveal">
      <span class="vg-chip">152-ФЗ</span><span class="vg-chip">ФСТЭК №117</span><span class="vg-chip">ЦБ 3-МР</span><span class="vg-chip">DLP + RBAC</span><span class="vg-chip">audit log</span>
    </div>
    <div class="vg-split nero-ai-reveal nero-ai-delay-1">
      <div class="vg-card"><h3>Внутренние политики</h3><p>Классификация данных, владелец агента, approver, регламент инцидента, запрет shadow AI, еженедельный отчёт по рискам.</p></div>
      <div class="vg-card"><h3>Российский контекст</h3><p>152-ФЗ: маскирование, on-prem/российские модели. ФСТЭК №117 (с 01.03.2026) для госсектора. Банк России 3-МР (16.06.2026) для финрынка.</p></div>
    </div>
  </div>
</section>

<section class="vg-section ym-section" id="ceny">
  <div class="vg-cnt ym-container">
    <div class="vg-sh nero-ai-reveal">
      <span class="vg-eyebrow">Коммерция</span>
      <h2>Сколько стоит внедрение AI governance и от чего зависит цена</h2>
      <p>Ориентир чека Nero Network: <strong>400 тыс.–2 млн ₽</strong> — в зависимости от масштаба агентов и интеграций.</p>
    </div>
    <div class="vg-table-wrap nero-ai-reveal">
      <table class="vg-table">
        <thead><tr><th>Фактор</th><th>Влияние на бюджет</th></tr></thead>
        <tbody>
          <tr><td>Количество агентов и платформ</td><td>Больше точек — больше аудит и policy</td></tr>
          <tr><td>Доля L3–L4 vs L1–L2</td><td>Approval, circuit breakers дороже</td></tr>
          <tr><td>ПДн и отрасли (финансы, госсектор)</td><td>DLP, ФСТЭК, отчёты регулятору</td></tr>
          <tr><td>Пилот vs полный контур</td><td>Пилот 2–3 агента — нижняя граница чека</td></tr>
        </tbody>
      </table>
    </div>
    <div class="vg-card nero-ai-reveal nero-ai-delay-1" style="margin-top:24px">
      <h3>AI governance под ключ или самостоятельно</h3>
      <p><strong>Самостоятельно</strong> — при сильной команде ИБ + платформенных инженеров. <strong>Под ключ</strong> — для среднего бизнеса без CISO-отдела: шаблоны Gartner, orchestrator, approve в Telegram, чек-лист AI-рисков.</p>
    </div>
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Сначала разобраться в AI-автоматизации сами?</p>
        <p class="ym-cta-block__sub">Если команда хочет понимать n8n, human-in-the-loop и уровни автономности до заказа governance — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование политик с IT и ИБ на этапе пилота.</p>
      </div>
    </aside>
  </div>
</section>

<section class="vg-section vg-section-alt ym-section ym-section-alt" id="keisy">
  <div class="vg-cnt ym-container">
    <div class="vg-sh nero-ai-reveal">
      <span class="vg-eyebrow">Доверие</span>
      <h2>Кейсы и примеры внедрения AI governance</h2>
      <p>Верифицированные ориентиры и типовые сценарии Nero Network.</p>
    </div>
    <div class="vg-case-grid nero-ai-reveal">
      <div class="vg-case-card"><div class="vg-case-tag">VK AI Space · 2026</div><h3>Изолированная среда на агента</h3><p>Зона ограниченной автономности, сквозной аудит. «Готовность рынка упирается в зрелость инфраструктуры управления» — Роман Стятюгин, VK Tech.</p></div>
      <div class="vg-case-card"><div class="vg-case-tag">NLB + Adastra</div><h3>Governance-слой в банке</h3><p>Agentic AI Platform: approval workflows, audit trails; первый use case за пять месяцев.</p></div>
      <div class="vg-case-card"><div class="vg-case-tag">Nero Network</div><h3>Проектная модель L1→L3</h3><p>RAG L1 → черновики L2 → approve в Telegram L3 → L4 только после circuit breakers.</p></div>
    </div>
  </div>
</section>

<section class="vg-section ym-section" id="faq">
  <div class="vg-cnt ym-container">
    <div class="vg-sh nero-ai-reveal">
      <span class="vg-eyebrow">FAQ</span>
      <h2>Как внедрить AI governance в бизнес-процессы</h2>
    </div>
    <div class="vg-faq ym-faq nero-ai-reveal" id="vg-faq-accordion">
      <div class="vg-faq-item"><div class="vg-faq-q" role="button" tabindex="0">Как внедрить AI governance пошагово?</div><div class="vg-faq-a"><p>Аудит → классификация L1–L4 → матрица ролей → gateway и audit log → пилот на 2–3 агентах → документация и чек-лист → масштабирование.</p></div></div>
      <div class="vg-faq-item"><div class="vg-faq-q" role="button" tabindex="0">Нужен ли программист для настройки контроля агентов?</div><div class="vg-faq-a"><p>При интеграции под ключ — Nero Network настраивает Make/n8n, proxy и очереди approve. Внутреннему IT нужно согласовать доступы и владельцев процессов.</p></div></div>
      <div class="vg-faq-item"><div class="vg-faq-q" role="button" tabindex="0">Как связать AI governance с CRM и ERP?</div><div class="vg-faq-a"><p>Единый реестр: агент amoCRM L2 и агент 1С L1 в одной политике. Gateway маршрутизирует tool-calls без замены CRM.</p></div></div>
      <div class="vg-faq-item"><div class="vg-faq-q" role="button" tabindex="0">Подходит ли AI governance малому и среднему бизнесу?</div><div class="vg-faq-a"><p>Средний бизнес — основной сегмент (от 400 тыс. ₽). Малый — при 2–3 агентах, начинают с L1–L2 и реестра.</p></div></div>
      <div class="vg-faq-item"><div class="vg-faq-q" role="button" tabindex="0">Чем AI governance отличается от «ещё одного бота»?</div><div class="vg-faq-a"><p>Бот без классификации — неизвестный риск. Governance — рамка для всех ботов: кто что может, как остановить, как расследовать.</p></div></div>
    </div>
  </div>
</section>

<section class="vg-section vg-section-alt ym-section ym-section-alt" id="cheklist">
  <div class="vg-cnt ym-container">
    <div class="vg-sh nero-ai-reveal">
      <span class="vg-eyebrow">Лид-магнит</span>
      <h2>Чек-лист AI-рисков и следующий шаг</h2>
      <p>Базовые пункты перед масштабированием ai агентов (полная версия — лид-магнит Nero Network).</p>
    </div>
    <div class="vg-checklist-group nero-ai-reveal"><h3>Реестр и политика</h3><ul class="vg-checklist"><li>Все агенты в реестре с владельцем</li><li>У каждого агента уровень L1–L4</li><li>Нет неучтённых low-code с write-доступом</li></ul></div>
    <div class="vg-checklist-group nero-ai-reveal nero-ai-delay-1"><h3>Доступы</h3><ul class="vg-checklist"><li>Least privilege к CRM, 1С, почте, API</li><li>Allowlist tools для MCP</li><li>Отдельные учётки агентов</li></ul></div>
    <div class="vg-checklist-group nero-ai-reveal nero-ai-delay-2"><h3>Контроль и аудит</h3><ul class="vg-checklist"><li>L3+ только с approval</li><li>Circuit breaker на L4</li><li>Immutable audit log prompt → tool → outcome</li><li>Маскирование ПДн под 152-ФЗ</li></ul></div>
  </div>
</section>

<aside class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Получите чек-лист AI-рисков и план пилота</p>
    <p class="ym-cta-block__sub">Разберём ваших агентов, предложим матрицу Gartner L1–L4 и передадим чек-лист AI-рисков. Следующий шаг — заявка на настройку контроля.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Настроить контроль AI'); ?></a>
      <a href="#urovni" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Смотреть 4 уровня →</a>
    </div>
  </div>
</aside>

</div>

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vg-governance-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 240;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2;
    scale = Math.min(cw / 520, ch / 280) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#0f172a",
    hubBase: "#1e293b",
    hubGlow: "#79f2ff",
    l1: "#22c55e",
    l2: "#79f2ff",
    l3: "#f59e0b",
    l4: "#fb7185",
    audit: "#8b5cf6",
    bubbleBg: "#f8fafc",
    bubbleText: "#0f172a",
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

  /* Орбитальный поток токенов агентов — замена Conveyor */
  function OrbitalAgentStream() {
    this.angle = 0;
  }
  OrbitalAgentStream.prototype.draw = function (ctx) {
    this.angle += 0.012;
    var prg = (frame * 0.042) % 260;
    var colors = ["#94a3b8", C.l1, C.l2, C.l3, C.l4];
    for (var i = 0; i < 5; i++) {
      var a = this.angle + (i * Math.PI * 2) / 5;
      var rx = 95 + Math.sin(frame * 0.02 + i) * 8;
      var ry = 42 + Math.cos(frame * 0.025 + i) * 5;
      var ox = Math.cos(a) * rx;
      var oy = Math.sin(a) * ry * 0.55;
      var phase = Math.floor(prg / 52);
      var col = colors[Math.min(phase, i) % 5];
      if (prg < 40) col = "#94a3b8";
      drawRR(ctx, ox - 7, oy - 7, 14, 14, 4, col, C.outline);
      if (phase >= 2 && i === 3) {
        ctx.strokeStyle = C.l3;
        ctx.lineWidth = 1;
        ctx.setLineDash([3, 3]);
        ctx.beginPath();
        ctx.moveTo(ox, oy);
        ctx.lineTo(72, -18);
        ctx.stroke();
        ctx.setLineDash([]);
      }
    }
    ctx.strokeStyle = "rgba(121,242,255,.18)";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.ellipse(0, 0, 100, 48, 0, 0, Math.PI * 2);
    ctx.stroke();
  };

  /* Центральный шлюз политик — замена WebsiteTerminal */
  function PolicyGatewayHub(x, y) {
    this.x = x;
    this.y = y;
    this.pulse = 0;
  }
  PolicyGatewayHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    this.pulse = 0.5 + Math.sin(frame * 0.06) * 0.15;
    var rings = [
      { r: 38, c: C.l1, label: "L1" },
      { r: 30, c: C.l2, label: "L2" },
      { r: 22, c: C.l3, label: "L3" },
      { r: 14, c: C.l4, label: "L4" }
    ];
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -28, -28, 56, 56, 10, C.hubBase, C.outline);
    rings.forEach(function (ring, idx) {
      var active = prg >= 45 + idx * 40;
      ctx.strokeStyle = active ? ring.c : "rgba(148,163,184,.35)";
      ctx.lineWidth = active ? 2.5 : 1;
      ctx.globalAlpha = active ? 0.95 : 0.4;
      ctx.beginPath();
      ctx.arc(0, 0, ring.r * 0.35, 0, Math.PI * 2);
      ctx.stroke();
      if (active && prg < 200) {
        ctx.fillStyle = ring.c;
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(ring.label, 0, ring.r * 0.35 + 3);
      }
    });
    ctx.globalAlpha = 1;
    ctx.fillStyle = C.hubGlow;
    ctx.globalAlpha = this.pulse * 0.25;
    ctx.beginPath();
    ctx.arc(0, 0, 22, 0, Math.PI * 2);
    ctx.fill();
    ctx.globalAlpha = 1;
    if (prg >= 100 && prg < 200) {
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("POLICY", 0, -2);
      ctx.fillText("ENGINE", 0, 8);
    }
    ctx.restore();
  };

  /* Башня immutable audit log */
  function ImmutableAuditStack(x, y) {
    this.x = x;
    this.y = y;
    this.height = 0;
  }
  ImmutableAuditStack.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg > 120) this.height = Math.min(50, this.height + 0.4);
    if (prg < 5) this.height = 0;
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -18, 10, 36, 55, 4, "#0f172a", C.outline);
    for (var i = 0; i < Math.floor(this.height / 10); i++) {
      drawRR(ctx, -14, 14 - i * 9, 28, 7, 2, C.audit, null);
    }
    ctx.fillStyle = C.l1;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AUDIT", 0, -8);
    ctx.restore();
  };

  /* Очередь approve L3 */
  function ApprovalQueueDock(x, y) {
    this.x = x;
    this.y = y;
    this.queue = 0;
  }
  ApprovalQueueDock.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg > 130 && prg < 210) this.queue = Math.min(3, this.queue + 0.02);
    if (prg < 5) this.queue = 0;
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -22, -8, 44, 50, 6, "rgba(245,158,11,.12)", C.l3);
    ctx.fillStyle = C.l3;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("APPROVE", 0, -14);
    for (var q = 0; q < Math.floor(this.queue); q++) {
      drawRR(ctx, -16, 2 + q * 12, 32, 9, 3, "#fef3c7", C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("TG OK?", -4, 9 + q * 12);
    }
    ctx.restore();
  };

  /* Circuit breaker — финал цикла */
  function CircuitBreakerRelays(x, y) {
    this.x = x;
    this.y = y;
    this.tripped = false;
  }
  CircuitBreakerRelays.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    this.tripped = prg >= 215;
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -20, -6, 40, 28, 5, "#1e293b", C.outline);
    ctx.fillStyle = this.tripped ? C.l4 : "#64748b";
    ctx.beginPath();
    ctx.arc(-8, 8, 5, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = this.tripped ? C.l4 : C.l3;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(this.tripped ? "TRIP!" : "ARMED", 6, 10);
    if (this.tripped) {
      ctx.strokeStyle = C.l4;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(-14, -2);
      ctx.lineTo(14, 14);
      ctx.stroke();
    }
    ctx.restore();
  };

  /* Sandbox-купол для L4 */
  function SandboxQuarantineDome(x, y) {
    this.x = x;
    this.y = y;
    this.alpha = 0;
  }
  SandboxQuarantineDome.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg >= 220) this.alpha = Math.min(1, this.alpha + 0.04);
    if (prg < 5) this.alpha = 0;
    if (this.alpha <= 0) return;
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.globalAlpha = this.alpha * 0.55;
    ctx.strokeStyle = C.l4;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, 0, 28, Math.PI, 0);
    ctx.stroke();
    ctx.fillStyle = "rgba(251,113,133,.15)";
    ctx.beginPath();
    ctx.arc(0, 0, 28, Math.PI, 0);
    ctx.lineTo(28, 12);
    ctx.lineTo(-28, 12);
    ctx.fill();
    ctx.globalAlpha = this.alpha;
    ctx.fillStyle = C.l4;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("SANDBOX", 0, 4);
    ctx.restore();
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x;
    this.y = y;
    this.baseX = x;
    this.baseY = y;
    this.color = color;
    this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.035;
    var prg = (frame * 0.042) % 260;
    var isMoving = false;
    var carryType = null;
    var faceDir = 1;
    var targets = {
      "1_architect": { x: -95, y: 28 },
      "2_seo": { x: -35, y: -55 },
      "3_coder": { x: 0, y: -8 },
      "4_designer": { x: 72, y: -18 },
      "5_deployer": { x: 0, y: 58 }
    };
    var tgt = targets[this.role] || { x: 0, y: 0 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 16) {
        this.x = tgt.x;
        this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        var back = (local - 16) / 6;
        this.x = tgt.x - (tgt.x - this.baseX) * back;
        this.y = tgt.y - (tgt.y - this.baseY) * back;
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 4)) * 2 : Math.sin(this.timer * 1.4);
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -10, -8 - bob, 20, 14, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -18 - bob, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    if (carryType) drawRR(ctx, -14 * faceDir, -16 - bob, 10, 10, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new OrbitalAgentStream());
  entities.push(new ImmutableAuditStack(-95, 5));
  entities.push(new PolicyGatewayHub(0, -5));
  entities.push(new ApprovalQueueDock(72, -5));
  entities.push(new CircuitBreakerRelays(0, 62));
  entities.push(new SandboxQuarantineDome(0, 38));
  entities.push(new Agent(-110, 55, C.agentYellow, "1_architect", 25, [
    "Инвентаризация агентов", "Реестр Make/n8n", "Владелец сценария?"
  ]));
  entities.push(new Agent(-55, 62, C.agentGreen, "2_seo", 70, [
    "L1 RAG — лёгкий контроль", "Shadow AI риск", "Классифицирую L2"
  ]));
  entities.push(new Agent(-15, 58, C.agentBlue, "3_coder", 115, [
    "Allowlist MCP tools", "Policy engine OK", "Gateway proxy live"
  ]));
  entities.push(new Agent(45, 60, C.agentPink, "4_designer", 160, [
    "Approve в Telegram", "Превью сделки CRM", "Anti approval-fatigue"
  ]));
  entities.push(new Agent(95, 55, C.agentPurple, "5_deployer", 205, [
    "Circuit breaker armed", "Kill switch готов", "L4 → sandbox!"
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

    var prg = (frame * 0.042) % 260;
    if (prg >= 22 && prg < 22.05) createBubble(-100, -20, "1. Скан реестра");
    if (prg >= 68 && prg < 68.05) createBubble(-40, -45, "2. Класс L1–L4");
    if (prg >= 118 && prg < 118.05) createBubble(0, -30, "3. Policy check");
    if (prg >= 168 && prg < 168.05) createBubble(70, -25, "4. Approve queue");
    if (prg >= 218 && prg < 218.05) createBubble(0, 50, "5. Circuit breaker!");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 18, tw, 16, 5, C.bubbleBg, C.hubGlow);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
      ctx.fillText(b.text, b.x, b.y - 9);
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
  var items=document.querySelectorAll('#vg-faq-accordion .vg-faq-item');
  items.forEach(function(item){
    var q=item.querySelector('.vg-faq-q');
    if(!q)return;
    function toggle(){var open=item.classList.contains('open');items.forEach(function(i){i.classList.remove('open');});if(!open)item.classList.add('open');}
    q.addEventListener('click',toggle);
    q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();toggle();}});
  });
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

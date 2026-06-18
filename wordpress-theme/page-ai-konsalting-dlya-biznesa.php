<?php
/**
 * Template Name: AI-консалтинг для бизнеса: стратегия и внедрение под ключ
 * Description: SEO-лонгрид — AI-консалтинг для бизнеса: аудит, карта сценариев, ROI, дорожная карта. Экспресс-диагностика.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-консалтинг для бизнеса: стратегия и внедрение под ключ';
$page_seo_description = 'AI-консалтинг для бизнеса под ключ: аудит процессов, карта сценариев, приоритизация по ROI и дорожная карта внедрения. Экспресс-диагностика AI-потенциала. Получить консультацию.';

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
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Получить консультацию';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#etapy';

$nero_ai_header_links = [
    ['label' => 'Зачем AI',  'href' => '#zachem'],
    ['label' => 'Этапы',     'href' => '#etapy'],
    ['label' => 'Сценарии',  'href' => '#scenarii-ai'],
    ['label' => 'Результат', 'href' => '#deliverables'],
    ['label' => 'Цена',      'href' => '#cena'],
    ['label' => 'Кейсы',     'href' => '#keisy'],
    ['label' => 'FAQ',       'href' => '#faq'],
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
/* Kadence reset + hero-first layout */
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
.akdb-hero {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

/* Intro: left-aligned text per design system */
.akdb-intro-text,
.akdb-intro-text p { text-align: left !important; }

/* CTA blocks */
.akdb-content .ym-cta-block__actions .nero-ai-btn-secondary {
  background: rgba(255,255,255,.08);
  color: var(--akdb-text) !important;
  border: 1.5px solid rgba(255,255,255,.18);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 20px;
  border-radius: 999px;
  font-size: 15px;
  font-weight: 700;
  text-decoration: none !important;
}
.ym-btn{
  display:inline-flex;align-items:center;justify-content:center;
  padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;
  text-decoration:none!important;transition:transform .2s,box-shadow .2s;
}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,
.nero-ai-home-page .ym-btn--accent,
.akdb-content .ym-btn--accent{
  background:linear-gradient(135deg,var(--akdb-btn-from),var(--akdb-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}

/* Reveal */
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.nero-ai-delay-3{transition-delay:.36s;}

/* === AKDB: article body, prefix akdb- === */
.akdb-content{
  --akdb-bg:#050711;--akdb-bg2:#080b17;
  --akdb-surface:rgba(255,255,255,.072);--akdb-text:#e6edf7;--akdb-muted:#9aa8bd;
  --akdb-soft:#c7d2e5;--akdb-heading:#fff;--akdb-border:rgba(255,255,255,.10);
  --akdb-accent:#79f2ff;--akdb-violet:#8b5cf6;--akdb-green:#22c55e;
  --akdb-btn-from:#2563eb;--akdb-btn-to:#7c3aed;
  --akdb-r:18px;--akdb-r-lg:24px;--akdb-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--akdb-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.akdb-content *,.akdb-content *::before,.akdb-content *::after{box-sizing:border-box;}
.akdb-content a{color:inherit;text-decoration:none;}
.akdb-content a.akdb-link{color:var(--akdb-accent);text-decoration:underline;}
.akdb-content p{color:var(--akdb-muted);line-height:1.72;margin:0 0 1em;font-size:15px;}
.akdb-content p:last-child{margin-bottom:0;}
.akdb-content h2,.akdb-content h3,.akdb-content h4{color:var(--akdb-heading);letter-spacing:-.04em;margin:0 0 .7em;}
.akdb-content strong{color:var(--akdb-soft);}
.akdb-content ul,.akdb-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.akdb-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--akdb-muted);font-size:14.5px;line-height:1.65;}
.akdb-content ul li::before{content:'›';position:absolute;left:0;color:var(--akdb-accent);font-weight:700;}
.akdb-cnt{width:min(var(--akdb-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.akdb-section{padding:clamp(64px,8vw,100px) 0;position:relative;}
.akdb-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.akdb-sh{max-width:820px;margin:0 auto 44px;text-align:center;}
.akdb-sh.akdb-left{margin-left:0;text-align:left;}
.akdb-sh h2{font-size:clamp(26px,3.8vw,46px);line-height:1.08;margin-bottom:14px;}
.akdb-sh p{font-size:clamp(15px,1.6vw,17px);max-width:680px;margin:0 auto;}
.akdb-sh.akdb-left p{margin-left:0;}
.akdb-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--akdb-accent);margin-bottom:14px;}
.akdb-intro{padding:clamp(40px,5vw,72px) 0;border-bottom:1px solid rgba(255,255,255,.06);}
.akdb-intro-grid{display:grid;grid-template-columns:1fr 320px;gap:48px;align-items:start;}
.akdb-intro-text{padding-left:18px;border-left:3px solid var(--akdb-violet);}
@media(max-width:900px){.akdb-intro-grid{grid-template-columns:1fr;}}
.akdb-kpi-strip{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin:28px 0 0;}
@media(max-width:700px){.akdb-kpi-strip{grid-template-columns:1fr;}}
.akdb-kpi{background:rgba(255,255,255,.06);border:1px solid var(--akdb-border);border-radius:16px;padding:20px 18px;text-align:center;}
.akdb-kpi .kv{font-size:clamp(22px,3vw,32px);font-weight:900;color:var(--akdb-heading);line-height:1;}
.akdb-kpi .kl{font-size:12px;color:var(--akdb-muted);margin-top:6px;line-height:1.4;}
.akdb-toc-outer{padding:0 0 clamp(32px,4vw,52px);}
.akdb-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.akdb-toc a{display:inline-block;padding:9px 18px;background:var(--akdb-surface);border:1px solid var(--akdb-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--akdb-muted);transition:border-color .2s,color .2s;}
.akdb-toc a:hover{border-color:rgba(121,242,255,.4);color:var(--akdb-accent);}
.akdb-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--akdb-border);border-radius:var(--akdb-r-lg);padding:26px;backdrop-filter:blur(14px);}
.akdb-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
@media(max-width:768px){.akdb-grid-2{grid-template-columns:1fr;}}
.akdb-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:22px 0;}
.akdb-table{width:100%;border-collapse:collapse;font-size:14px;}
.akdb-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--akdb-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.2);white-space:nowrap;}
.akdb-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--akdb-text);vertical-align:top;}
.akdb-table tr:last-child td{border-bottom:none;}
.akdb-table tr:hover td{background:rgba(255,255,255,.03);}
.akdb-table tr.akdb-row-highlight td{background:rgba(139,92,246,.08);font-weight:600;}
.akdb-timeline{position:relative;padding-left:40px;}
.akdb-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--akdb-accent),var(--akdb-violet));opacity:.35;}
.akdb-tl-item{position:relative;margin-bottom:30px;}
.akdb-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--akdb-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.akdb-tl-item h3{font-size:17px;margin-bottom:8px;}
.akdb-case-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px;}
@media(max-width:768px){.akdb-case-grid{grid-template-columns:1fr;}}
.akdb-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:24px;}
.akdb-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--akdb-green);margin-bottom:8px;}
.akdb-barrier-pills{display:flex;flex-wrap:wrap;gap:10px;margin-top:20px;}
.akdb-barrier-pill{padding:10px 16px;border-radius:12px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);font-size:13px;color:var(--akdb-muted);}
.akdb-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.akdb-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.akdb-faq-q{padding:18px 22px;font-size:16px;font-weight:700;color:var(--akdb-heading);cursor:pointer;display:flex;justify-content:space-between;gap:12px;user-select:none;}
.akdb-faq-q::after{content:'▾';color:var(--akdb-accent);transition:transform .25s;}
.akdb-faq-item.open .akdb-faq-q::after{transform:rotate(180deg);}
.akdb-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .35s ease,padding .25s;font-size:14.5px;color:var(--akdb-muted);line-height:1.72;}
.akdb-faq-item.open .akdb-faq-a{max-height:500px;padding:0 22px 18px;}
.akdb-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.akdb-content .ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.akdb-content .ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.akdb-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.akdb-content .ym-cta-block__sub{color:var(--akdb-muted);font-size:15px;margin:0 auto 20px;max-width:620px;line-height:1.7;}
.akdb-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.akdb-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.akdb-content .ym-link--accent{color:var(--akdb-accent)!important;text-decoration:underline!important;}
@media(max-width:600px){.akdb-content .ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-konsalting-dlya-biznesa-page akdb-page" role="main" tabindex="-1">

<section class="nero-ai-hero akdb-hero" id="hero" aria-labelledby="akdb-hero-title">
<style>
/* ── Hero ai-konsalting-dlya-biznesa: самодостаточные стили ── */
.akdb-hero {
  --akdb-cyan: #79f2ff;
  --akdb-violet: #a78bfa;
  --akdb-green: #22c55e;
  --akdb-amber: #f59e0b;
  --akdb-text: #e6edf7;
  --akdb-muted: #9aa8bd;
  --akdb-soft: #c7d2e5;
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.akdb-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.akdb-hero::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(167, 139, 250, .14), transparent 66%);
  filter: blur(8px);
  animation: akdbHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes akdbHeroGlow {
  from { opacity: .42; transform: scale(.95); }
  to { opacity: .84; transform: scale(1.05); }
}
.akdb-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.akdb-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.akdb-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.akdb-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--akdb-cyan) 42%, var(--akdb-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.akdb-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(167, 139, 250, 0.28);
  border-radius: 999px;
  background: rgba(167, 139, 250, 0.1);
  color: var(--akdb-violet) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.akdb-hero .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--akdb-soft) !important;
  font-size: clamp(17px, 1.85vw, 21px);
  line-height: 1.58;
}
.akdb-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.akdb-hero .nero-ai-badge {
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
.akdb-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.akdb-hero .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 20px;
  border-radius: 999px;
  font-size: 15px;
  font-weight: 700;
  text-decoration: none !important;
  transition: transform .2s, box-shadow .2s;
}
.akdb-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.akdb-hero .nero-ai-btn-primary {
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  color: #fff !important;
  box-shadow: 0 8px 32px rgba(59, 130, 246, .35);
}
.akdb-hero .nero-ai-btn-secondary {
  background: rgba(255,255,255,.08);
  color: var(--akdb-text) !important;
  border: 1.5px solid rgba(255,255,255,.18);
}
.akdb-hero .nero-ai-dashboard {
  position: relative;
}
.akdb-hero .nero-ai-dashboard-shell {
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 20px;
  background: linear-gradient(180deg, rgba(255,255,255,.09), rgba(255,255,255,.04));
  box-shadow: 0 28px 90px rgba(0,0,0,.38);
  overflow: hidden;
  backdrop-filter: blur(16px);
}
.akdb-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(0,0,0,.18);
}
.akdb-hero .nero-ai-dots { display: flex; gap: 6px; }
.akdb-hero .nero-ai-dot {
  width: 10px; height: 10px; border-radius: 50%;
  background: rgba(255,255,255,.18);
}
.akdb-hero .nero-ai-window-title {
  font-size: 11px;
  font-weight: 600;
  color: var(--akdb-muted);
  letter-spacing: .04em;
}
.akdb-hero .nero-ai-window-body { padding: 18px 18px 16px; }
.akdb-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.akdb-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 15px;
  font-weight: 800;
  color: #fff;
  letter-spacing: -.02em;
}
.akdb-hero .nero-ai-live-pill {
  padding: 4px 10px;
  border-radius: 999px;
  background: rgba(34,197,94,.15);
  border: 1px solid rgba(34,197,94,.35);
  color: #86efac;
  font-size: 11px;
  font-weight: 700;
}
.akdb-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
  margin-bottom: 12px;
}
.akdb-hero .nero-ai-metric {
  padding: 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.09);
}
.akdb-hero .nero-ai-metric span {
  display: block;
  font-size: 11px;
  color: var(--akdb-muted);
  margin-bottom: 4px;
}
.akdb-hero .nero-ai-metric strong {
  display: block;
  font-size: 22px;
  font-weight: 900;
  color: #fff;
  letter-spacing: -.04em;
  line-height: 1;
}
.akdb-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  font-size: 10px;
  color: #64748b;
}
.akdb-hero .akdb-dash-canvas-wrap {
  position: relative;
  height: 220px;
  margin: 0 0 12px;
  border-radius: 14px;
  overflow: hidden;
  background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 55%, #f0fdf4 100%);
  border: 1px solid rgba(15,23,42,.08);
}
.akdb-hero #akdb-strategy-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.akdb-hero .nero-ai-task-stream {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.akdb-hero .nero-ai-task {
  display: grid;
  grid-template-columns: auto 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 12px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.08);
  font-size: 12px;
}
.akdb-hero .nero-ai-task-icon {
  width: 28px; height: 28px;
  display: grid; place-items: center;
  border-radius: 8px;
  background: rgba(121,242,255,.12);
  color: var(--akdb-cyan);
  font-size: 11px;
  font-weight: 800;
}
.akdb-hero .nero-ai-task strong {
  display: block;
  color: #fff;
  font-size: 12px;
}
.akdb-hero .nero-ai-task span {
  display: block;
  color: var(--akdb-muted);
  font-size: 11px;
}
.akdb-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.15);
  color: #86efac;
  font-size: 10px;
  font-weight: 700;
  white-space: nowrap;
}
.akdb-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.15);
  color: #fcd34d;
}
@media (max-width: 1023px) {
  .akdb-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .akdb-hero .akdb-dash-canvas-wrap { height: 200px; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai консалтинг</p>
      <h1 id="akdb-hero-title">AI-консалтинг для бизнеса: стратегия внедрения и дорожная карта <span class="nero-ai-gradient-text">под ключ</span></h1>
      <p class="nero-ai-hero-lead">Определим, какие AI-сценарии окупятся в вашей компании, и составим дорожную карту внедрения с финансовой моделью эффекта — до бюджета на разработку и очередного пилота без KPI.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы консалтинга">
        <li class="nero-ai-badge">AI-стратегия</li>
        <li class="nero-ai-badge">Дорожная карта</li>
        <li class="nero-ai-badge">ROI</li>
        <li class="nero-ai-badge">Аудит</li>
        <li class="nero-ai-badge">Пилоты</li>
        <li class="nero-ai-badge">Governance</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Получить консультацию</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Экспресс-диагностика</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-консалтинга">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики консалтинга · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-стратегия · демо консалтинга</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Сценариев в портфеле</span>
              <strong>5</strong>
              <small>после аудита</small>
            </div>
            <div class="nero-ai-metric">
              <span>Приоритет ROI</span>
              <strong>#1</strong>
              <small>документооборот</small>
            </div>
            <div class="nero-ai-metric">
              <span>Фазы roadmap</span>
              <strong>3</strong>
              <small>пилот → масштаб</small>
            </div>
            <div class="nero-ai-metric">
              <span>Payback пилота</span>
              <strong>4 мес*</strong>
              <small>базовый сценарий</small>
            </div>
          </div>

          <div class="akdb-dash-canvas-wrap" aria-hidden="false">
            <canvas id="akdb-strategy-canvas" role="img" aria-label="Анимация: штаб AI-стратегии — приоритизация сценариев по ROI и утверждение дорожной карты"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента этапов консалтинга">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">01</span>
              <div><strong>Аудит процессов</strong><span>инвентаризация «теневого AI»</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">02</span>
              <div><strong>Карта сценариев</strong><span>top-5 use cases</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">03</span>
              <div><strong>Приоритизация ROI</strong><span>impact / effort / risk</span></div>
              <span class="nero-ai-status nero-ai-status--amber">scoring</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">04</span>
              <div><strong>Дорожная карта утверждена</strong><span>фаза 1: пилот с KPI</span></div>
              <span class="nero-ai-status">roadmap</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="akdb-content">

  <!-- INTRO -->
  <section class="akdb-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="akdb-cnt">
      <div class="akdb-intro-grid nero-ai-reveal">
        <div class="akdb-intro-text">
          <p class="akdb-eyebrow">Лонгрид · ai консалтинг</p>
          <p><strong>Коротко:</strong> AI-консалтинг для бизнеса — стратегическая услуга до разработки: мы определяем, какие AI-сценарии окупятся в вашей компании, в каком порядке их внедрять и как измерить эффект. На выходе — AI-стратегия, дорожная карта внедрения и финансовая модель с KPI пилотов, а не «ещё один чат-бот ради хайпа».</p>
        </div>
        <div class="akdb-kpi-strip" aria-label="Ключевые deliverables">
          <div class="akdb-kpi"><div class="kv">5</div><div class="kl">сценариев в top-портфеле</div></div>
          <div class="akdb-kpi"><div class="kv">3–12</div><div class="kl">мес. дорожная карта</div></div>
          <div class="akdb-kpi"><div class="kv">ROI</div><div class="kl">финмодель для ЛПР</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="akdb-toc-outer">
    <div class="akdb-cnt">
      <nav class="akdb-toc" aria-label="Оглавление">
        <a href="#zachem">Зачем AI</a>
        <a href="#chto-takoe">Что такое</a>
        <a href="#etapy">Этапы</a>
        <a href="#scenarii-ai">Сценарии</a>
        <a href="#deliverables">Результат</a>
        <a href="#cena">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- #zachem -->
  <section class="akdb-section nero-ai-section" id="zachem">
    <div class="akdb-cnt">
      <div class="akdb-sh">
        <span class="akdb-eyebrow">Тренд 2026</span>
        <h2>Зачем бизнесу AI-консалтинг в 2026 году, а не хаотичные пилоты</h2>
        <p>От экспериментов с ChatGPT к управляемому agentic-внедрению — разрыв между пилотами и стратегией стоит миллионов рублей бюджета.</p>
      </div>
      <div class="akdb-kpi-strip nero-ai-reveal" aria-label="Разрыв пилоты vs стратегия">
        <div class="akdb-kpi"><div class="kv">97%</div><div class="kl">внедряют или планируют ИИ (РФ)</div></div>
        <div class="akdb-kpi"><div class="kv">26%</div><div class="kl">имеют формализованную AI-стратегию</div></div>
        <div class="akdb-kpi"><div class="kv">2,3/4</div><div class="kl">зрелость Responsible AI (McKinsey 2026)</div></div>
      </div>
      <div class="akdb-card nero-ai-reveal" style="margin-top:28px;">
        <p>В 2026 году <strong>ai для бизнеса</strong> перестал быть экспериментом «попробовать ChatGPT». По данным McKinsey State of AI 2025, <strong>88%</strong> организаций уже используют искусственный интеллект хотя бы в одной функции. При этом <strong>почти две трети</strong> компаний ещё не масштабировали AI на уровне всей организации, а <strong>agentic AI</strong> масштабируют лишь <strong>23%</strong> респондентов.</p>
        <p>Параллельно в России: по опросу MTS Web Services среди 700 крупных компаний <strong>97%</strong> внедряют или планируют внедрение ИИ, однако только <strong>26%</strong> имеют формализованную AI-стратегию. Исследование билайн и Ассоциации менеджеров (январь–февраль 2026): <strong>24%</strong> официально интегрировали нейросети, <strong>38,6%</strong> случаев ответственность на IT, у коммерции — <strong>7%</strong>.</p>
        <p><strong>Итог:</strong> бизнес тратит бюджет на <strong>ai автоматизацию бизнеса</strong>, но не понимает, какие сценарии окупятся. Именно здесь нужен <strong>ai консалтинг</strong> — управляемый переход от пилотов к измеримому эффекту. McKinsey State of AI Trust 2026 фиксирует сдвиг к <strong>agentic era</strong>: главный барьер масштабирования — <strong>безопасность и риски</strong> (почти <strong>⅔</strong> респондентов).</p>
      </div>
    </div>
  </section>

  <!-- #chto-takoe -->
  <section class="akdb-section akdb-section-alt nero-ai-section" id="chto-takoe">
    <div class="akdb-cnt">
      <div class="akdb-sh akdb-left">
        <span class="akdb-eyebrow">Определение</span>
        <h2>Что такое AI-консалтинг для бизнеса и чем он отличается от разовой интеграции</h2>
      </div>
      <div class="akdb-card nero-ai-reveal">
        <p><strong>AI-консалтинг</strong> (или <strong>ai-консалтинг</strong>) — стратегическая услуга: «что внедрять», «зачем», «в каком порядке» и «когда окупится». Не разработка одного бота и не обучение ChatGPT.</p>
        <p>Типовой результат <strong>ai консалтинга для бизнеса</strong>: аудит процессов → карта use cases → приоритизация по ROI → дорожная карта 3–12 мес. → финмодель → спецификация первого пилота.</p>
      </div>
      <h3 style="margin-top:36px;font-size:20px;">Когда нужен стратегический консалтинг, а когда — точечное внедрение</h3>
      <div class="akdb-table-wrap nero-ai-reveal">
        <table class="akdb-table">
          <thead><tr><th>Ситуация</th><th>Что заказывать</th></tr></thead>
          <tbody>
            <tr><td>Неясно, с чего начать; 5+ разрозненных экспериментов</td><td><strong>AI-консалтинг</strong> — стратегия и дорожная карта</td></tr>
            <tr><td>Понятен один процесс (CRM, почта, 1С)</td><td>Точечное <strong>внедрение ai решений</strong></td></tr>
            <tr><td>Нужен ROI до бюджета на разработку</td><td>Консалтинг с финмоделью</td></tr>
            <tr><td>Уже есть стратегия, нужен код</td><td>Разработка агентов / интеграция</td></tr>
          </tbody>
        </table>
      </div>
      <div class="akdb-card nero-ai-reveal" style="margin-top:24px;">
        <h3 style="font-size:18px;">Какие задачи решает AI-консалтинг на уровне компании</h3>
        <ul>
          <li><strong>Приоритизация</strong> — из 20 идей выбрать 2–3 с измеримым эффектом</li>
          <li><strong>Синхронизация IT и бизнеса</strong> — единый язык KPI</li>
          <li><strong>Governance-lite</strong> — уровни автономии, HITL, 152-ФЗ</li>
          <li><strong>Анти-портфель игрушек</strong> — критерии kill для пилотов без ROI</li>
          <li><strong>Мост к внедрению</strong> — backlog для CRM, телефонии, Make/n8n</li>
        </ul>
        <p>По OTUS (Habr, 2025), до измеримой ценности AI в масштабе организации доходят ~<strong>5%</strong> компаний; time-to-value — <strong>9–18 месяцев</strong>. Консалтинг сокращает путь за счёт правильного первого сценария.</p>
      </div>
    </div>
  </section>

  <!-- #komu-podhodit -->
  <section class="akdb-section nero-ai-section" id="komu-podhodit">
    <div class="akdb-cnt">
      <div class="akdb-sh">
        <span class="akdb-eyebrow">Целевая аудитория</span>
        <h2>Кому подходит AI-консалтинг: собственникам, директорам по развитию и IT</h2>
      </div>
      <p class="nero-ai-reveal" style="text-align:center;max-width:720px;margin:0 auto 32px;"><strong>AI-консалтинг для компании</strong> нужен, когда ЛПР видит потенциал <strong>ai для бизнеса</strong>, но не готов тратить миллионы без обоснования.</p>
      <div class="akdb-grid-2 nero-ai-reveal">
        <div class="akdb-card">
          <span class="akdb-eyebrow">Средний бизнес</span>
          <h3>AI-консалтинг для среднего бизнеса</h3>
          <p>Оптимален формат <strong>ai консалтинг под ключ</strong>: экспресс-диагностика → стратегия → дорожная карта → сопровождение пилота. По Mera Research, <strong>55%</strong> GenAI-проектов в РФ остаются на стадии пилотов — консалтинг даёт критерии перехода к масштабу.</p>
        </div>
        <div class="akdb-card nero-ai-delay-1">
          <span class="akdb-eyebrow">Малый бизнес</span>
          <h3>AI-консалтинг для малого бизнеса</h3>
          <p>Сжатый пакет: top-3 сценария, финмодель на 6–12 месяцев, спецификация одного quick win. Бюджет Nero Network — <strong>100–700 тыс. ₽</strong> — сопоставим с одним неудачным пилотом без методологии.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #etapy -->
  <section class="akdb-section akdb-section-alt nero-ai-section" id="etapy">
    <div class="akdb-cnt">
      <div class="akdb-sh">
        <span class="akdb-eyebrow">Методология Nero</span>
        <h2>Этапы AI-консалтинга: от аудита процессов до масштабирования</h2>
        <p><strong>AI-консалтинг под ключ</strong> — проектная модель с измеримыми этапами, не «дек на 200 слайдов».</p>
      </div>
      <div class="akdb-timeline nero-ai-reveal">
        <div class="akdb-tl-item">
          <div class="akdb-tl-dot"></div>
          <h3>Экспресс-диагностика AI-потенциала (лид-магнит)</h3>
          <p>3–5 рабочих дней: интервью с ЛПР и IT, инвентаризация «теневого AI», матрица «процесс × боль × данные × готовность», <strong>top-5 сценариев</strong> с грубой оценкой эффекта.</p>
        </div>
        <div class="akdb-tl-item">
          <div class="akdb-tl-dot"></div>
          <h3>Карта AI-сценариев и приоритизация по ROI</h3>
          <p>1–2 недели: воркшопы с владельцами процессов, baseline-метрики, scoring по impact / effort / data readiness / risk. Методология кейса «Конкор Оптика»: 20+ гипотез → рост продаж <strong>25%</strong>.</p>
        </div>
        <div class="akdb-tl-item">
          <div class="akdb-tl-dot"></div>
          <h3>Дорожная карта внедрения и backlog автоматизаций</h3>
          <p>Квартальный план 3–12 месяцев: пилот → измерение → масштаб. Backlog с user stories, спецификация 1-го агента.</p>
        </div>
        <div class="akdb-tl-item">
          <div class="akdb-tl-dot"></div>
          <h3>Финансовая модель эффекта и KPI пилотов</h3>
          <p>TCO, три сценария ROI (оптимист / база / пессимист), payback. Бюджет 10/20/70: технологии / данные / люди и процессы (Alpina Digital, 2026).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA #1 Артур -->
  <div class="akdb-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
      <div class="ym-cta-block__icon" aria-hidden="true">🗺️</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Экспресс-диагностика AI-потенциала за 3–5 дней</p>
        <p class="ym-cta-block__sub">Интервью с ЛПР и IT, инвентаризация «теневого AI», матрица процессов и <strong>top-5 сценариев</strong> с грубой оценкой ROI. Результат — с чего начать и что не делать, до бюджета на разработку.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Получить консультацию</a>
      </div>
    </div>
  </div>

  <!-- #scenarii-ai + БОРИС -->
  <section class="akdb-section nero-ai-section" id="scenarii-ai">
    <div class="akdb-cnt">
      <div class="akdb-sh">
        <span class="akdb-eyebrow">Окупаемые сценарии</span>
        <h2>Какие AI-сценарии чаще всего окупаются в B2B</h2>
        <p>По анализу российских и международных внедрений, <strong>внедрение ai решений</strong> чаще окупается в пяти зонах: продажи, поддержка, документооборот, маркетинг, закупки.</p>
      </div>
    </div>

    <!-- === БОРИС CANVAS BLOCK === -->
    <section id="ai-konsalting-dlya-biznesa-boris-block" class="akd-root" aria-label="Анимация: приоритизация AI-сценариев по ROI в B2B-консалтинге">
<style>
/* === БОРИС: prefix akd-, scoped в #ai-konsalting-dlya-biznesa-boris-block === */
#ai-konsalting-dlya-biznesa-boris-block.akd-root{padding:48px 0 56px;background:#f0f4f8;}
#ai-konsalting-dlya-biznesa-boris-block .akd-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-konsalting-dlya-biznesa-boris-block .akd-card{
  display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 12px 44px rgba(15,23,42,.09),0 0 0 1px rgba(148,163,184,.2);
  min-height:480px;max-height:720px;
}
@media(max-width:1023px){
  #ai-konsalting-dlya-biznesa-boris-block .akd-card{grid-template-columns:1fr;min-height:auto;max-height:none;}
}
#ai-konsalting-dlya-biznesa-boris-block .akd-lft{
  padding:38px 34px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-konsalting-dlya-biznesa-boris-block .akd-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:28px 22px;}
}
#ai-konsalting-dlya-biznesa-boris-block .akd-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:#6366f1;margin:0 0 12px;
}
#ai-konsalting-dlya-biznesa-boris-block .akd-ey::before{content:'';width:18px;height:2px;background:#6366f1;border-radius:1px;}
#ai-konsalting-dlya-biznesa-boris-block .akd-h3{font-size:clamp(19px,2.3vw,25px);font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 16px;}
#ai-konsalting-dlya-biznesa-boris-block .akd-ul{list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:8px;}
#ai-konsalting-dlya-biznesa-boris-block .akd-ul li{display:flex;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-konsalting-dlya-biznesa-boris-block .akd-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(99,102,241,.1);
  display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:800;color:#4f46e5;font-style:normal;
}
#ai-konsalting-dlya-biznesa-boris-block .akd-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px;}
#ai-konsalting-dlya-biznesa-boris-block .akd-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;}
#ai-konsalting-dlya-biznesa-boris-block .akd-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-konsalting-dlya-biznesa-boris-block .akd-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#ai-konsalting-dlya-biznesa-boris-block .akd-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-konsalting-dlya-biznesa-boris-block .akd-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-konsalting-dlya-biznesa-boris-block .akd-rgt{
  position:relative;background:linear-gradient(145deg,#eef2ff 0%,#f5f3ff 40%,#f0f9ff 100%);
  min-height:400px;overflow:hidden;
}
@media(max-width:1023px){#ai-konsalting-dlya-biznesa-boris-block .akd-rgt{min-height:360px;}}
#akdb-roi-scenario-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="akd-cnt">
  <div class="akd-card">
    <div class="akd-lft">
      <span class="akd-ey">ROI-портфель · B2B</span>
      <h3 class="akd-h3">Пять сценариев проходят scoring-матрицу — на выходе приоритет #1 с измеримым payback</h3>
      <ul class="akd-ul">
        <li><span class="akd-ic">1</span>Продажи и CRM — квалификация лидов, follow-up, прогноз воронки</li>
        <li><span class="akd-ic">2</span>Поддержка — до 52% инцидентов без человека (кейс ритейла)</li>
        <li><span class="akd-ic">3</span>Документооборот — цикл с 4 ч до 15 мин, ошибки −92%</li>
        <li><span class="akd-ic">4</span>Маркетинг и закупки — прогноз спроса, ассортимент</li>
      </ul>
      <div class="akd-pills">
        <span class="akd-pl akd-pl-v">#1 ROI · поддержка</span>
        <span class="akd-pl akd-pl-g">payback 3–9 мес.</span>
        <span class="akd-pl akd-pl-b">HITL на рисках</span>
      </div>
      <p class="akd-foot">Дальше — что вы получите на выходе консалтинга →</p>
    </div>
    <div class="akd-rgt">
      <canvas id="akdb-roi-scenario-canvas" aria-label="Анимация: AI-сценарии B2B проходят матрицу приоритизации по ROI и ранжируются" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('akdb-roi-scenario-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;
  var LOOP = 720;

  var SCENES = [
    {id:'sales', label:'Продажи', color:'#3b82f6', roi:72, effort:55},
    {id:'support', label:'Поддержка', color:'#22c55e', roi:91, effort:38},
    {id:'docs', label:'Документы', color:'#f59e0b', roi:85, effort:48},
    {id:'mkt', label:'Маркетинг', color:'#ec4899', roi:58, effort:62},
    {id:'proc', label:'Закупки', color:'#8b5cf6', roi:67, effort:52}
  ];

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 440;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle=fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawMatrix(mx,my,mw,mh,pulse){
    rr(mx,my,mw,mh,14,'rgba(255,255,255,.85)','#c7d2fe',2);
    ctx.fillStyle='#4338ca';
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Scoring-матрица ROI × Effort', mx+mw/2, my+22);

    var gx = mx+24, gy = my+36, gw = mw-48, gh = mh-52;
    rr(gx,gy,gw,gh,8,'#f8fafc','#e2e8f0',1);

    ctx.strokeStyle='rgba(99,102,241,.25)';
    ctx.lineWidth=1;
    ctx.setLineDash([4,4]);
    ctx.beginPath(); ctx.moveTo(gx+gw*0.55,gy); ctx.lineTo(gx+gw*0.55,gy+gh); ctx.stroke();
    ctx.beginPath(); ctx.moveTo(gx,gy+gh*0.5); ctx.lineTo(gx+gw,gy+gh*0.5); ctx.stroke();
    ctx.setLineDash([]);

    ctx.fillStyle='#64748b';
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('↑ ROI', gx+4, gy+12);
    ctx.textAlign='right';
    ctx.fillText('Quick win →', gx+gw-4, gy+gh+14);

    var qx = gx+gw*0.62, qy = gy+gh*0.12, qw = gw*0.32, qh = gh*0.35;
    var qa = 0.55 + 0.45*Math.sin(pulse*0.04);
    rr(qx,qy,qw,qh,6,'rgba(34,197,94,'+(0.08+qa*0.08)+')','#22c55e',1.5);
    ctx.fillStyle='#15803d';
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Зона #1', qx+qw/2, qy+qh/2-4);
    ctx.fillText('пилот', qx+qw/2, qy+qh/2+10);
  }

  function drawBubble(s, x, y, r, alpha, rank){
    ctx.globalAlpha = alpha;
    rr(x-r,y-r,r*2,r*2,r,s.color,null,0);
    ctx.fillStyle='#fff';
    ctx.font='bold '+(r>16?'11':'9')+'px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(s.label, x, y+(rank?-4:2));
    if (rank){
      ctx.fillStyle=s.color;
      ctx.font='bold 10px Inter,sans-serif';
      ctx.fillText('#'+rank, x, y+14);
    }
    ctx.globalAlpha=1;
  }

  function drawRankBar(rx,ry,rw,rh,items,pulse){
    rr(rx,ry,rw,rh,12,'rgba(255,255,255,.9)','#e2e8f0',1.5);
    ctx.fillStyle='#0f172a';
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Приоритет портфеля', rx+12, ry+20);

    var sorted = items.slice().sort(function(a,b){return b.roi-a.roi;});
    var barH = (rh-36)/sorted.length;
    sorted.forEach(function(s,i){
      var by = ry+28+i*barH;
      var prog = Math.min(1, ((frame+s.roi*3)%LOOP)/180);
      var bw = (rw-24)*prog*(s.roi/100);
      rr(rx+12, by+4, rw-24, barH-8, 4, '#f1f5f9', null, 0);
      rr(rx+12, by+4, bw, barH-8, 4, s.color, null, 0);
      ctx.fillStyle='#334155';
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText((i+1)+'. '+s.label, rx+16, by+barH/2+3);
      ctx.textAlign='right';
      ctx.fillStyle=s.color;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.fillText(s.roi+'%', rx+rw-14, by+barH/2+3);
    });
  }

  function loop(){
    frame++;
    var pulse = frame;
    var t = frame % LOOP;
    ctx.clearRect(0,0,W,H);

    var mx = W*0.06, my = H*0.08, mw = W*0.58, mh = H*0.84;
    if (W < 500){ mx = W*0.04; mw = W*0.92; my = H*0.06; mh = H*0.52; }

    drawMatrix(mx,my,mw,mh,pulse);

    SCENES.forEach(function(s,i){
      var phase = (t + i*120) % LOOP;
      var startX = mx - 40;
      var startY = my + mh*0.2 + i*(mh*0.14);
      var endX = mx + mw*0.72 + (s.roi>80?8:20);
      var endY = my + mh*0.18 + (100-s.roi)*mh*0.004;
      var prog = Math.min(1, phase/200);
      if (phase > 500) prog = 1 - Math.min(1,(phase-500)/120);

      var x = startX + (endX-startX)*prog;
      var y = startY + (endY-startY)*prog;
      var rank = s.roi >= 85 ? 1 : (s.roi >= 70 ? 2 : 0);
      drawBubble(s, x, y, rank?18:14, 0.85+0.15*Math.sin(pulse*0.05+i), rank||null);

      if (prog > 0.3 && prog < 0.95){
        ctx.strokeStyle=s.color;
        ctx.globalAlpha=0.25;
        ctx.lineWidth=1.5;
        ctx.setLineDash([3,5]);
        ctx.beginPath();
        ctx.moveTo(startX+20,startY);
        ctx.lineTo(x,y);
        ctx.stroke();
        ctx.setLineDash([]);
        ctx.globalAlpha=1;
      }
    });

    if (W >= 500){
      drawRankBar(W*0.68, H*0.1, W*0.28, H*0.8, SCENES, pulse);
    }

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
    </section>
    <!-- === /БОРИС === -->

    <div class="akdb-cnt" style="margin-top:40px;">
      <div class="akdb-card nero-ai-reveal">
        <h3>AI-агенты для продаж, поддержки и документооборота</h3>
        <p><strong>AI-агенты</strong> — следующий шаг после ассистентов: цепочка действий (CRM → ответ → эскалация). McKinsey: <strong>39%</strong> экспериментируют, <strong>23%</strong> масштабируют. Разумный старт — один агент в одном процессе с human-in-the-loop.</p>
        <p>Предупреждение мультиагентных систем: при точности <strong>90%</strong> на 5 шагах совокупная точность падает до ~<strong>59%</strong>. Консалтинг рекомендует сложную архитектуру только после провала простого сценария.</p>
      </div>
      <div class="akdb-card nero-ai-reveal nero-ai-delay-1" style="margin-top:18px;">
        <h3>AI-консалтинг и интеграции: CRM, ERP, почта — обзорно</h3>
        <p><strong>AI-консалтинг с CRM</strong> на уровне стратегии определяет, <strong>где</strong> интеграция даст эффект. Стек после консалтинга: amoCRM / Bitrix24, телефония, мессенджеры, 1С / ERP, Make / n8n, YandexGPT / GigaChat.</p>
        <p>Точечные интеграции — отдельные услуги Nero. Консалтинг отвечает: <strong>какая первая в очереди и почему</strong>.</p>
      </div>
    </div>
  </section>

  <!-- #deliverables -->
  <section class="akdb-section akdb-section-alt nero-ai-section" id="deliverables">
    <div class="akdb-cnt">
      <div class="akdb-sh">
        <span class="akdb-eyebrow">Deliverables</span>
        <h2>Что вы получите на выходе AI-консалтинга</h2>
      </div>
      <div class="akdb-table-wrap nero-ai-reveal">
        <table class="akdb-table">
          <thead><tr><th>Deliverable</th><th>Содержание</th></tr></thead>
          <tbody>
            <tr><td><strong>AI-стратегия</strong></td><td>Видение, принципы, governance-lite, стек</td></tr>
            <tr class="akdb-row-highlight"><td><strong>Дорожная карта</strong></td><td>Фазы 3–12 мес., зависимости, роли</td></tr>
            <tr class="akdb-row-highlight"><td><strong>Финансовая модель</strong></td><td>TCO, ROI, payback, 3 сценария</td></tr>
            <tr><td><strong>Карта сценариев</strong></td><td>Use cases с приоритетом и kill-критериями</td></tr>
            <tr><td><strong>Спецификация пилота</strong></td><td>User stories, интеграции, KPI</td></tr>
            <tr><td><strong>Backlog автоматизаций</strong></td><td>Очередь для разработки / интеграции</td></tr>
            <tr><td><strong>Критерии go/no-go</strong></td><td>Когда масштабировать, когда останавливать пилот</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;text-align:center;"><strong>Коротко:</strong> не PDF «для полки», а рабочий план с цифрами для ЛПР и ТЗ для исполнителей.</p>
    </div>
  </section>

  <!-- #sravnenie -->
  <section class="akdb-section nero-ai-section" id="sravnenie">
    <div class="akdb-cnt">
      <div class="akdb-sh">
        <span class="akdb-eyebrow">Модели внедрения</span>
        <h2>Внутренний центр компетенций, внешний консалтинг или vendor-led: что выбрать</h2>
      </div>
      <div class="akdb-table-wrap nero-ai-reveal">
        <table class="akdb-table">
          <thead><tr><th>Модель</th><th>Плюсы</th><th>Минусы</th><th>Когда выбирать</th></tr></thead>
          <tbody>
            <tr><td><strong>Внутренний CoE</strong></td><td>Контроль, накопление знаний</td><td>Дорого, долго нанимать</td><td>Крупный бизнес, постоянный поток задач</td></tr>
            <tr><td><strong>Внешний консалтинг</strong></td><td>Методология, скорость</td><td>Нужен handoff внутрь</td><td>Средний бизнес, нет AI-стратегии</td></tr>
            <tr><td><strong>Vendor-led</strong></td><td>Готовая платформа</td><td>Привязка к вендору</td><td>Регулируемые отрасли, on-prem</td></tr>
          </tbody>
        </table>
      </div>
      <div class="akdb-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="akdb-card">
          <h3>AI-консалтинг под ключ или самостоятельно</h3>
          <p>Самостоятельный путь возможен при методологии ROI и владельце процесса. Консалтинг окупается, когда нужно согласовать 3+ департамента или защитить <strong>финансовую модель ai внедрения</strong> перед советом за 2–4 недели.</p>
        </div>
        <div class="akdb-card">
          <h3>AI-консалтинг без программиста</h3>
          <p>Реалистичен на этапе стратегии: интервью, карта, финмодель, спецификация. Production-интеграции требуют разработки — но вы получаете ТЗ. Граница: консалтинг = «что и зачем», интеграция = «как в коде».</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA #2 Артур -->
  <div class="akdb-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать AI до заказа консалтинга?</p>
        <p class="ym-cta-block__sub">Если вы выбираете путь «самостоятельно» или готовите внутренний CoE — полезно заранее разобраться в приоритизации сценариев, ROI и human-in-the-loop. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo nero_ai_external_link_attrs($secondary_cta_url); ?>><?php echo esc_html($secondary_cta_label); ?></a> — это ускоряет согласование с IT и бизнесом на этапе стратегии.</p>
      </div>
    </aside>
  </div>

  <!-- #riski -->
  <section class="akdb-section akdb-section-alt nero-ai-section" id="riski">
    <div class="akdb-cnt">
      <div class="akdb-sh akdb-left">
        <span class="akdb-eyebrow">Барьеры</span>
        <h2>Почему AI-пилоты не доходят до ROI: данные, комплаенс, кадры, интеграции</h2>
      </div>
      <div class="akdb-card nero-ai-reveal">
        <p><strong>Внедрение ai в бизнес</strong> проваливается из-за организационных барьеров, не из-за «слабой нейросети».</p>
        <ul>
          <li><strong>Данные</strong> — Excel вместо единого источника, «грязные» сканы</li>
          <li><strong>Комплаенс</strong> — «теневой AI», 152-ФЗ, on-prem / GigaChat Enterprise</li>
          <li><strong>Кадры</strong> — барьер обучения вырос до <strong>60%</strong> (McKinsey 2026)</li>
          <li><strong>Интеграции</strong> — агент без CRM/ERP остаётся игрушкой</li>
        </ul>
        <div class="akdb-barrier-pills">
          <span class="akdb-barrier-pill">Kill: нет baseline</span>
          <span class="akdb-barrier-pill">Kill: нет владельца</span>
          <span class="akdb-barrier-pill">Kill: ROI &lt; порога за 90 дней</span>
        </div>
      </div>
    </div>
  </section>

  <!-- #keisy -->
  <section class="akdb-section nero-ai-section" id="keisy">
    <div class="akdb-cnt">
      <div class="akdb-sh">
        <span class="akdb-eyebrow">Рыночные ориентиры</span>
        <h2>Примеры внедрения AI-стратегии в российском B2B</h2>
        <p>Downstream-эффекты внедрений — не кейсы Nero, а ориентиры для финмодели.</p>
      </div>
      <div class="akdb-case-grid nero-ai-reveal">
        <div class="akdb-case-card">
          <div class="akdb-case-tag">Ритейл · +25%</div>
          <h3>Конкор Оптика + 1С ПРО Консалтинг</h3>
          <p>20+ гипотез → валидация → планирование запасов. <a class="akdb-link" href="https://companies.rbc.ru/news/KxvSpxp7vH/" target="_blank" rel="noopener noreferrer">РБК Компании</a></p>
        </div>
        <div class="akdb-case-card">
          <div class="akdb-case-tag">Девелопмент</div>
          <h3>AB Centrum + GigaChat Enterprise</h3>
          <p>«Цифровой прораб» — документы и согласования в закрытом контуре. <a class="akdb-link" href="https://www.cnews.ru/news/line/2026-03-24_tsifrovoj_prorab_dlya_biznesa" target="_blank" rel="noopener noreferrer">CNews</a></p>
        </div>
        <div class="akdb-case-card">
          <div class="akdb-case-tag">Промышленность · 45 млн ₽/год</div>
          <h3>Металлургический холдинг</h3>
          <p>12 агентов на документообороте, окупаемость ~4 мес. <a class="akdb-link" href="https://companies.rbc.ru/news/La7IUKZEnQ/" target="_blank" rel="noopener noreferrer">РБК</a></p>
        </div>
        <div class="akdb-case-card">
          <div class="akdb-case-tag">Ритейл / телеком · 52%</div>
          <h3>IT-поддержка без человека</h3>
          <p>Мультиагентное ядро прогноза спроса; телеком — 2+ млрд ₽/год. <a class="akdb-link" href="https://companies.rbc.ru/news/rLf8q7QPFR/" target="_blank" rel="noopener noreferrer">РБК</a></p>
        </div>
      </div>
    </div>
  </section>

  <!-- #cena -->
  <section class="akdb-section akdb-section-alt nero-ai-section" id="cena">
    <div class="akdb-cnt">
      <div class="akdb-sh">
        <span class="akdb-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI-консалтинг для бизнеса и от чего зависит цена</h2>
      </div>
      <h3 style="font-size:18px;margin-bottom:16px;">Форматы: экспресс-диагностика, стратегия, полный цикл</h3>
      <div class="akdb-table-wrap nero-ai-reveal">
        <table class="akdb-table">
          <thead><tr><th>Формат</th><th>Срок</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td><strong>Экспресс-диагностика</strong></td><td>3–5 дней</td><td>Top-5 сценариев, грубый ROI, рекомендация пакета</td></tr>
            <tr><td><strong>Стандарт</strong></td><td>2–4 недели</td><td>Аудит, карта, приоритизация, roadmap, финмодель</td></tr>
            <tr><td><strong>Enterprise</strong></td><td>4–8 недель</td><td>+ governance, спецификация агента, сопровождение пилота</td></tr>
          </tbody>
        </table>
      </div>
      <h3 style="font-size:18px;margin:28px 0 16px;">Ориентиры бюджета</h3>
      <div class="akdb-table-wrap nero-ai-reveal">
        <table class="akdb-table">
          <thead><tr><th>Источник</th><th>Вилка</th></tr></thead>
          <tbody>
            <tr><td>Рынок РФ (экспресс)</td><td>от <strong>150 000 ₽</strong></td></tr>
            <tr><td>Рынок РФ (стандарт)</td><td><strong>300 000–450 000 ₽</strong></td></tr>
            <tr><td>Рынок РФ (enterprise)</td><td><strong>1 000 000+ ₽</strong></td></tr>
            <tr class="akdb-row-highlight"><td><strong>Пакет Nero Network</strong></td><td><strong>100–700 тыс. ₽</strong></td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:18px;">Точная <strong>стоимость ai консалтинга</strong> фиксируется после экспресс-диагностики.</p>
    </div>
  </section>

  <!-- #faq -->
  <section class="akdb-section nero-ai-section" id="faq">
    <div class="akdb-cnt">
      <div class="akdb-sh">
        <span class="akdb-eyebrow">FAQ · GEO</span>
        <h2>Частые вопросы об AI-консалтинге для бизнеса</h2>
      </div>
      <div class="akdb-faq nero-ai-reveal" id="akdb-faq-accordion">
        <div class="akdb-faq-item">
          <div class="akdb-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить AI-консалтинг в компании с нуля?</div>
          <div class="akdb-faq-a">Зафиксируйте 3–5 ключевых процессов с объёмами → экспресс-диагностика (3–5 дней) → воркшопы → утвердите roadmap и KPI первого пилота → запуск только по сценарию с готовыми данными.</div>
        </div>
        <div class="akdb-faq-item">
          <div class="akdb-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько длится AI-консалтинг и когда ждать первый эффект?</div>
          <div class="akdb-faq-a">Стратегия — 2–4 недели. Первый эффект пилота — от 1–3 месяцев. Масштабный ROI — типично 9–18 месяцев (OTUS / Habr).</div>
        </div>
        <div class="akdb-faq-item">
          <div class="akdb-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит AI-консалтинг?</div>
          <div class="akdb-faq-a">Вилка Nero Network — 100–700 тыс. ₽. Рынок: экспресс от 150 тыс., стандарт 300–450 тыс., enterprise от 1 млн ₽.</div>
        </div>
        <div class="akdb-faq-item">
          <div class="akdb-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли своя команда разработки после консалтинга?</div>
          <div class="akdb-faq-a">Не обязательно сразу. Консалтинг даёт спецификацию и backlog — можно передать Nero или интегратору.</div>
        </div>
        <div class="akdb-faq-item">
          <div class="akdb-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-консалтинг отличается от заказа одной нейросети «под задачу»?</div>
          <div class="akdb-faq-a">Разовый бот решает одну точку. Консалтинг отвечает, какую точку брать первой и как считать ROI. 97% экспериментируют, 26% имеют формализованный план.</div>
        </div>
        <div class="akdb-faq-item">
          <div class="akdb-faq-q" role="button" tabindex="0" aria-expanded="false">AI-консалтинг для малого бизнеса — имеет ли смысл?</div>
          <div class="akdb-faq-a">Да, в формате top-3 сценариев и одного пилота. Для микробизнеса иногда достаточно точечной интеграции.</div>
        </div>
        <div class="akdb-faq-item">
          <div class="akdb-faq-q" role="button" tabindex="0" aria-expanded="false">AI-консалтинг с CRM — это отдельная услуга?</div>
          <div class="akdb-faq-a">На этапе консалтинга определяем роль CRM в AI-архитектуре. Точечное внедрение в amoCRM / Bitrix24 — следующий шаг после приоритизации.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- #cta final -->
  <section class="akdb-section nero-ai-section" id="cta">
    <div class="akdb-cnt">
      <div class="ym-cta-block ym-cta-block--dual ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Получить консультацию по AI-стратегии для вашего бизнеса</p>
          <p class="ym-cta-block__sub">Сформируем AI-стратегию, дорожную карту внедрения и финансовую модель эффекта — чтобы бюджет уходил на окупаемые сценарии, а не на очередной пилот без KPI. Пакет Nero Network: <strong>100–700 тыс. ₽</strong>.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить консультацию</a>
            <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Экспресс-диагностика AI-потенциала</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<script>
/* FAQ toggle — akdb */
document.addEventListener('DOMContentLoaded', function(){
  document.querySelectorAll('.akdb-faq-q').forEach(function(q){
    q.addEventListener('click', function(){
      var item = q.closest('.akdb-faq-item');
      var open = item.classList.contains('open');
      document.querySelectorAll('.akdb-faq-item.open').forEach(function(i){ i.classList.remove('open'); i.querySelector('.akdb-faq-q').setAttribute('aria-expanded','false'); });
      if (!open){ item.classList.add('open'); q.setAttribute('aria-expanded','true'); }
    });
    q.addEventListener('keydown', function(e){ if (e.key==='Enter'||e.key===' '){ e.preventDefault(); q.click(); }});
  });
});
</script>

<script>
/**
 * akdb-strategy-engine — Штаб AI-стратегии
 * Мир: водопад сценариев → матрица ROI → печать утверждения → roadmap
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("akdb-strategy-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 220;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 440, ch / 240) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    outlineDark: "#0f172a",
    matrixBg: "#f1f5f9",
    matrixHi: "#a7f3d0",
    matrixLo: "#fecaca",
    cardBg: "#ffffff",
    cardToy: "#fde68a",
    roadmap: "#1e293b",
    roadmapGlow: "#8b5cf6",
    stamp: "#22c55e",
    gauge: "#3b82f6",
    shadow: "rgba(139,92,246,0.2)",
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

  /* Водопад карточек сценариев — вертикальные дуги, не конвейер */
  function ScenarioWaterfall() {
    this.lanes = [
      { xOff: -95, curve: 0.35, hue: C.cardBg },
      { xOff: -30, curve: 0.22, hue: C.cardBg },
      { xOff: 35, curve: -0.22, hue: C.cardBg },
      { xOff: 100, curve: -0.35, hue: C.cardToy }
    ];
  }
  ScenarioWaterfall.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.lanes.forEach(function (lane, li) {
      for (var i = 0; i < 3; i++) {
        var t = ((prg * 0.6 + i * 55 + li * 18) % 180) / 180;
        var y = -110 + t * 95;
        var x = lane.xOff + Math.sin(t * Math.PI * lane.curve * 4) * 22;
        var isToy = li === 3 && prg > 40 && prg < 100;
        drawRR(ctx, x - 14, y - 10, 28, 20, 4, isToy ? C.cardToy : lane.hue, C.outline);
        ctx.fillStyle = C.outlineDark;
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(li === 3 ? "?" : "UC", x, y + 2);
      }
    });
    /* Волна сетки приоритизации */
    ctx.strokeStyle = "rgba(100,116,139,0.15)";
    ctx.lineWidth = 1;
    for (var w = 0; w < 4; w++) {
      var waveY = -55 + Math.sin(frame * 0.04 + w) * 3;
      ctx.beginPath();
      ctx.moveTo(-140, waveY + w * 18);
      ctx.bezierCurveTo(-50, waveY + w * 18 - 8, 50, waveY + w * 18 + 8, 140, waveY + w * 18);
      ctx.stroke();
    }
  };

  /* Матрица ROI 2×2 — центральный объект вместо WebsiteTerminal */
  function RoiPriorityMatrix() {
    this.quadrantGlow = 0;
  }
  RoiPriorityMatrix.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -70, -45, 140, 100, 8, C.matrixBg, C.outline);
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(0, -45); ctx.lineTo(0, 55);
    ctx.moveTo(-70, 5); ctx.lineTo(70, 5);
    ctx.stroke();
    ctx.fillStyle = C.outlineDark;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("impact ↑", -35, -50);
    ctx.fillText("effort →", 0, 62);

    var labels = ["Quick win", "Стратегия", "Отложить", "Игрушка"];
    var pos = [[-35, -20], [35, -20], [-35, 30], [35, 30]];
    labels.forEach(function (lb, i) {
      ctx.fillStyle = i === 0 ? "#065f46" : i === 3 ? "#9a3412" : "#334155";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText(lb, pos[i][0], pos[i][1]);
    });

    if (prg >= 70 && prg < 150) {
      this.quadrantGlow = Math.sin((prg - 70) * 0.08) * 0.4 + 0.4;
      ctx.fillStyle = "rgba(34,197,94," + this.quadrantGlow + ")";
      ctx.beginPath();
      ctx.arc(-35, -20, 22, 0, Math.PI * 2);
      ctx.fill();
      drawRR(ctx, -48, -32, 26, 18, 4, C.matrixHi, C.outline);
      ctx.fillStyle = "#065f46";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("#1", -35, -20);
    }
  };

  /* Доска roadmap — финал: печать ROI, не ракета */
  function RoadmapUnlockBoard() {
    this.stampAlpha = 0;
    this.phaseLit = 0;
  }
  RoadmapUnlockBoard.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -85, 58, 170, 52, 8, C.roadmap, C.outlineDark);
    var phases = ["Диагн.", "Пилот", "Масштаб"];
    phases.forEach(function (ph, i) {
      var px = -70 + i * 52;
      var lit = prg >= 190 && i <= Math.floor((prg - 190) / 18);
      drawRR(ctx, px, 68, 44, 28, 5, lit ? "rgba(139,92,246,0.35)" : "rgba(255,255,255,0.08)", lit ? C.roadmapGlow : C.outline);
      ctx.fillStyle = lit ? "#e9d5ff" : "#94a3b8";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(ph, px + 22, 84);
    });

    if (prg >= 190) {
      this.stampAlpha = Math.min(1, (prg - 190) / 20);
      ctx.save();
      ctx.globalAlpha = this.stampAlpha;
      ctx.strokeStyle = C.stamp;
      ctx.lineWidth = 2.5;
      ctx.beginPath();
      ctx.arc(55, 72, 18, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = C.stamp;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ROI", 55, 70);
      ctx.fillText("OK", 55, 80);
      ctx.restore();
      if (prg > 210 && prg < 215) createBubble(55, 45, "Roadmap утверждён!", 280);
    }
  };

  /* Отсев игрушечных пилотов */
  function KillPilotChute() {
    this.tumble = 0;
  }
  KillPilotChute.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 108, -15, 32, 70, 6, "rgba(254,202,202,0.35)", "#f87171");
    ctx.fillStyle = "#b91c1c";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("KILL", 124, 8);
    ctx.fillText("пилот", 124, 16);
    if (prg > 95 && prg < 130) {
      this.tumble = (prg - 95) * 0.12;
      var ty = -20 + this.tumble * 55;
      drawRR(ctx, 118, ty, 18, 14, 3, C.cardToy, C.outline);
    }
  };

  /* Кольцо governance agentic AI */
  function GovernanceRing() {
    this.pulse = 0;
  }
  GovernanceRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.pulse = 0.5 + Math.sin(frame * 0.05) * 0.2;
    ctx.strokeStyle = "rgba(139,92,246," + (prg > 120 && prg < 175 ? this.pulse : 0.25) + ")";
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 6]);
    ctx.beginPath();
    ctx.arc(-115, 15, 28, 0, Math.PI * 2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle = "#5b21b6";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("HITL", -115, 12);
    ctx.fillText("trust", -115, 20);
  };

  /* Стрелка finmodel / payback */
  function FinModelGauge() {
    this.angle = -0.8;
  }
  FinModelGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -128, 58, 36, 36, 8, "#e0f2fe", C.outline);
    if (prg >= 150 && prg < 195) {
      this.angle = -0.8 + ((prg - 150) / 45) * 1.6;
    }
    ctx.save();
    ctx.translate(-110, 76);
    ctx.rotate(this.angle);
    ctx.strokeStyle = C.gauge;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(0, 0);
    ctx.lineTo(12, 0);
    ctx.stroke();
    ctx.restore();
    ctx.fillStyle = C.outlineDark;
    ctx.font = "bold 5px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("4м", -110, 88);
  };

  /* Облако теневого AI */
  function ShadowAiCloud() {
    this.drift = 0;
  }
  ShadowAiCloud.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.drift = Math.sin(frame * 0.03) * 6;
    if (prg < 65) {
      ctx.fillStyle = C.shadow;
      ctx.beginPath();
      ctx.arc(-125 + this.drift, -75, 16, 0, Math.PI * 2);
      ctx.arc(-108 + this.drift, -78, 12, 0, Math.PI * 2);
      ctx.arc(-92 + this.drift, -72, 14, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = "#6d28d9";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("shadow", -110 + this.drift, -72);
      ctx.fillText("AI", -110 + this.drift, -64);
    }
  };

  function Agent(x, y, color, role, stepTrig, dialogs, targetX, targetY) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.targetX = targetX;
    this.targetY = targetY;
    this.hitAnimation = 0;
  }
  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var isMoving = false;
    var carryType = null;
    var faceDir = 1;
    var prg = (frame * 0.038) % 260;

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 9) {
        isMoving = true; faceDir = 1; carryType = this.color;
        this.x = this.baseX + (this.targetX - this.baseX) * (local / 9);
        this.y = this.baseY + (this.targetY - this.baseY) * (local / 9);
      } else if (local < 14) {
        this.x = this.targetX; this.y = this.targetY;
      } else {
        isMoving = true; faceDir = -1;
        var back = (local - 14) / 8;
        this.x = this.targetX - (this.targetX - this.baseX) * back;
        this.y = this.targetY - (this.targetY - this.baseY) * back;
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.5);
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 6;
      legL = Math.sin(wp) * 5;
      legR = Math.sin(wp + Math.PI) * 5;
    }
    drawRR(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outlineDark, null);
    drawRR(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outlineDark, null);
    drawRR(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outlineDark, null);
    drawRR(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outlineDark, null);
    drawRR(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outlineDark);
    var hx = 0, hy = -28 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath(); ctx.arc(hx, hy, 12, 0, Math.PI * 2); ctx.fill();
    ctx.lineWidth = 2; ctx.strokeStyle = C.outlineDark; ctx.stroke();
    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outlineDark;
    ctx.beginPath(); ctx.arc(hx + 5, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    if (this.role === "1_architect") {
      ctx.strokeStyle = C.outlineDark; ctx.lineWidth = 1;
      ctx.strokeRect(hx + 1, hy - 5, 6, 6); ctx.strokeRect(hx - 7, hy - 5, 6, 6);
    }
    ctx.restore();
    if (carryType) drawRR(ctx, -18 * faceDir, -16 - bob, 14, 14, 2, carryType, C.outlineDark);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new ScenarioWaterfall());
  entities.push(new ShadowAiCloud());
  entities.push(new RoiPriorityMatrix());
  entities.push(new RoadmapUnlockBoard());
  entities.push(new KillPilotChute());
  entities.push(new GovernanceRing());
  entities.push(new FinModelGauge());

  entities.push(new Agent(-130, 35, C.agentYellow, "1_architect", 18,
    ["Собираю теневой AI...", "Карта процессов готова", "20 идей → 5 сценариев"],
    -110, -55));
  entities.push(new Agent(-55, -5, C.agentGreen, "2_roi", 78,
    ["Scoring по ROI...", "Quick win: документы", "Игрушки в kill-лист"],
    -35, -25));
  entities.push(new Agent(15, 30, C.agentBlue, "3_integrator", 118,
    ["Данные в CRM готовы?", "Интеграция: amo + 1С", "Data readiness: 78%"],
    0, 10));
  entities.push(new Agent(75, -10, C.agentPink, "4_governance", 148,
    ["Уровень автономии L2", "HITL на рисковых шагах", "152-ФЗ: on-prem"],
    -115, 15));
  entities.push(new Agent(120, 40, C.agentPurple, "5_strategist", 188,
    ["Финмодель для совета", "Payback: 4 мес база", "Roadmap на 3 квартала"],
    55, 55));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, maxLife: life });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.038) % 260;
    if (prg >= 12 && prg < 12.05) createBubble(-110, -70, "1. Аудит и теневой AI");
    if (prg >= 72 && prg < 72.05) createBubble(-35, -35, "2. Матрица ROI");
    if (prg >= 122 && prg < 122.05) createBubble(-115, 0, "3. Governance-lite");
    if (prg >= 162 && prg < 162.05) createBubble(-110, 70, "4. Финмодель TCO");
    if (prg >= 200 && prg < 200.05) createBubble(55, 40, "5. Пилот #1 в roadmap");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 18 - (b.maxLife - b.life) * 0.04, tw, 18, 5, C.bubbleBg, null);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 8 - (b.maxLife - b.life) * 0.04);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineLoop);
  }

  document.fonts.ready.then(engineLoop);
});
</script>


<!-- INTERNAL-LINKS:INSERT -->
<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

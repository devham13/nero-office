<?php
/**
 * Template Name: Разработка AI-агентов для бизнеса
 * Description: SEO-лендинг — разработка и внедрение AI-агентов под ключ. CRM, почта, мессенджеры, Make/n8n.
 */

$page_seo_title       = 'Разработка AI-агентов для бизнеса: внедрение под ключ';
$page_seo_description = 'Разрабатываем и внедряем AI-агентов для бизнеса: CRM, почта, мессенджеры, Make/n8n. Сценарии с human-in-the-loop. Кейсы, этапы, цены. Оценка задач бесплатно.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta name="keywords" content="разработка ai агентов, разработка ai агентов для бизнеса, разработка ai агентов под ключ, внедрение ai в бизнес, ai для бизнеса, ai агенты, ai автоматизация бизнеса, внедрение ai в бизнес процессы, human-in-the-loop" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Боли', 'href' => '#boli'],
    ['label' => 'Агенты', 'href' => '#uslugi'],
    ['label' => 'Сценарий', 'href' => '#operacionnyj-centr'],
    ['label' => 'Внедрение', 'href' => '#process'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = 'Оценить задачи для агента';
$primary_cta_url   = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);

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
/* Скрыть шапку Kadence — pill-шапка как на главной */
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

.raa-content{
  --raa-bg:#050711;--raa-bg2:#080b17;--raa-bg3:#0a0e1c;
  --raa-surface:rgba(255,255,255,.072);--raa-surface2:rgba(255,255,255,.108);
  --raa-text:#e6edf7;--raa-muted:#9aa8bd;--raa-soft:#c7d2e5;--raa-heading:#fff;
  --raa-border:rgba(255,255,255,.10);--raa-border-s:rgba(255,255,255,.18);
  --raa-accent:#79f2ff;--raa-violet:#8b5cf6;--raa-green:#22c55e;--raa-cyan:#79f2ff;
  --raa-btn-from:#2563eb;--raa-btn-to:#7c3aed;
  --raa-shadow:0 24px 72px rgba(0,0,0,.4);
  --raa-r:18px;--raa-r-lg:24px;--raa-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--raa-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.raa-content *,.raa-content *::before,.raa-content *::after{box-sizing:border-box;}
.raa-content a{color:inherit;text-decoration:none;}
.raa-content a:hover{color:var(--raa-accent);}
.raa-content p{color:var(--raa-muted);line-height:1.72;margin:0 0 1em;}
.raa-content p:last-child{margin-bottom:0;}
.raa-content h2,.raa-content h3,.raa-content h4{color:var(--raa-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.raa-content strong{color:var(--raa-soft);}
.raa-cnt{width:min(var(--raa-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.raa-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.raa-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.raa-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.raa-sh.raa-left{margin-left:0;text-align:left;}
.raa-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.raa-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.raa-sh.raa-left p{margin-left:0;}
.raa-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--raa-accent);margin-bottom:14px;}
.raa-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.raa-intro-grid{display:grid;grid-template-columns:minmax(0,1fr) minmax(260px,340px);gap:clamp(32px,5vw,56px);align-items:center;}
.raa-intro-text{position:relative;padding-left:20px;}
.raa-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--raa-accent),var(--raa-violet));}
.raa-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.raa-intro-deco{display:grid;gap:10px;}
.raa-intro-chip{display:inline-flex;padding:8px 14px;border-radius:999px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);font-size:13px;font-weight:700;color:var(--raa-soft);}
.raa-intro-stat{padding:14px 16px;border-radius:14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);}
.raa-intro-stat strong{display:block;font-size:22px;font-weight:900;color:#fff;letter-spacing:-.04em;}
.raa-intro-stat span{display:block;margin-top:4px;font-size:12px;color:var(--raa-muted);line-height:1.45;}
@media(max-width:900px){.raa-intro-grid{grid-template-columns:1fr;}}
.raa-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.raa-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.raa-toc a{display:inline-block;padding:9px 18px;background:var(--raa-surface);border:1px solid var(--raa-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--raa-muted);transition:border-color .2s,color .2s,background .2s;}
.raa-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--raa-accent);background:rgba(121,242,255,.08);}
.raa-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--raa-border);border-radius:var(--raa-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.raa-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.raa-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.raa-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.raa-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;}
@media(max-width:960px){.raa-grid-3,.raa-grid-4{grid-template-columns:1fr 1fr;}}
@media(max-width:768px){.raa-grid-2,.raa-grid-3,.raa-grid-4{grid-template-columns:1fr;}}
.raa-pain-icon{font-size:28px;margin-bottom:12px;}
.raa-itog{margin-top:28px;padding:18px 22px;border-left:3px solid var(--raa-accent);background:rgba(121,242,255,.06);border-radius:0 14px 14px 0;color:var(--raa-soft);font-size:15px;line-height:1.65;}
.raa-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.raa-table{width:100%;border-collapse:collapse;font-size:14px;}
.raa-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--raa-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.raa-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--raa-text);vertical-align:top;}
.raa-table tr:last-child td{border-bottom:none;}
.raa-table tr:hover td{background:rgba(255,255,255,.03);}
.raa-table--hitl td:first-child{font-weight:700;}
.raa-flow{display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:10px;margin:28px 0;}
.raa-flow-step{flex:1 1 140px;max-width:200px;padding:18px 14px;border-radius:16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);text-align:center;}
.raa-flow-step strong{display:block;color:#fff;font-size:14px;margin-bottom:6px;}
.raa-flow-step span{display:block;font-size:12px;color:var(--raa-muted);}
.raa-flow-arrow{color:var(--raa-accent);font-size:20px;font-weight:800;}
.raa-chips{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-top:24px;}
.raa-chip{padding:8px 14px;border-radius:999px;background:rgba(139,92,246,.12);border:1px solid rgba(139,92,246,.28);font-size:13px;font-weight:700;color:#ddd6fe;}
.raa-kpi-big{text-align:center;padding:36px 28px;border-radius:24px;background:rgba(255,255,255,.05);border:1px solid rgba(121,242,255,.2);margin-bottom:24px;}
.raa-kpi-big strong{display:block;font-size:clamp(48px,10vw,80px);font-weight:900;color:var(--raa-accent);letter-spacing:-.06em;line-height:1;}
.raa-timeline{position:relative;padding-left:40px;}
.raa-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--raa-accent),var(--raa-violet));opacity:.35;border-radius:2px;}
.raa-tl-item{position:relative;margin-bottom:32px;}
.raa-tl-item:last-child{margin-bottom:0;}
.raa-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--raa-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.raa-tl-item h3{font-size:17px;margin-bottom:8px;}
.raa-tl-item p{font-size:14.5px;margin:0;}
.raa-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.raa-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.raa-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--raa-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.raa-faq-q::after{content:'▾';font-size:13px;color:var(--raa-accent);flex-shrink:0;transition:transform .25s;}
.raa-faq-item.open .raa-faq-q::after{transform:rotate(180deg);}
.raa-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--raa-muted);line-height:1.72;}
.raa-faq-item.open .raa-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px auto;max-width:var(--raa-container);background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--raa-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__note{margin-top:16px!important;font-size:13px!important;max-width:520px;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--raa-btn-from),var(--raa-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--raa-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--raa-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}.raa-flow-arrow{display:none;}}
</style>

<main id="primary" class="site-main nero-ai-home-page razrabotka-ai-agentov-page" role="main" tabindex="-1">

<section class="nero-ai-hero raa-hero" id="raa-hero" aria-labelledby="raa-hero-title">
<style>
/* ── Hero razrabotka-ai-agentov: самодостаточные стили (без CSS темы) ── */
.raa-hero {
  --raa-cyan: #79f2ff;
  --raa-violet: #8b5cf6;
  --raa-green: #22c55e;
  --raa-amber: #f59e0b;
  --raa-text: #e6edf7;
  --raa-muted: #9aa8bd;
  --raa-soft: #c7d2e5;
  --raa-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: radial-gradient(ellipse 80% 60% at 20% 20%, rgba(121, 242, 255, 0.07), transparent 55%),
    radial-gradient(ellipse 70% 50% at 85% 30%, rgba(139, 92, 246, 0.09), transparent 60%),
    linear-gradient(180deg, #050711 0%, #080b17 48%, #050711 100%);
}
.raa-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 74%);
  opacity: .55;
  pointer-events: none;
  z-index: 0;
}
.raa-hero::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .1), transparent 68%);
  filter: blur(10px);
  animation: raaHeroGlow 10s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes raaHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.raa-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.raa-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.raa-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.raa-hero .nero-ai-gradient-text {
  display: block;
  margin-top: 6px;
  background: linear-gradient(92deg, #fff 0%, var(--raa-cyan) 38%, var(--raa-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
  font-size: clamp(22px, 3.2vw, 36px);
  font-weight: 800;
  letter-spacing: -0.04em;
}
.raa-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--raa-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.raa-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--raa-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.raa-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.raa-hero .nero-ai-badge {
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
.raa-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.raa-hero .nero-ai-btn {
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
.raa-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.raa-hero .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--raa-cyan), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.raa-hero .nero-ai-btn-secondary {
  color: var(--raa-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.raa-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  border: 1px solid rgba(255,255,255,.08);
  backdrop-filter: blur(18px);
  box-shadow: var(--raa-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.raa-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.raa-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.raa-hero .nero-ai-dots { display: flex; gap: 7px; }
.raa-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.raa-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.raa-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.raa-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.raa-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.raa-hero .nero-ai-window-body { padding: 16px; }
.raa-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.raa-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.raa-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
  white-space: nowrap;
}
.raa-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: raaPulse 1.6s infinite;
}
@keyframes raaPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.raa-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.raa-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.raa-hero .nero-ai-metric span {
  display: block;
  color: var(--raa-muted);
  font-size: 11px;
  font-weight: 700;
}
.raa-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.raa-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.raa-hero .raa-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 50% 42%, rgba(121,242,255,.06), rgba(6,10,24,.94) 72%);
}
.raa-hero #raa-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.raa-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.raa-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.raa-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--raa-cyan);
  font-size: 10px;
  font-weight: 800;
}
.raa-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.raa-hero .nero-ai-task span {
  color: var(--raa-muted);
  font-size: 11px;
}
.raa-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.raa-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.raa-hero .nero-ai-status--cyan {
  background: rgba(121,242,255,.11);
  color: #a5f3fc;
}
@media (max-width: 1100px) {
  .raa-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .raa-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .raa-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .raa-hero .nero-ai-window-body { padding: 12px; }
  .raa-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .raa-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · внедрение AI в бизнес</p>
      <h1 id="raa-hero-title">Разработка AI-агентов для бизнеса<span class="nero-ai-gradient-text">под ключ · действия в CRM и почте</span></h1>
      <p class="nero-ai-hero-lead">Создадим AI-агентов, которые выполняют рабочие сценарии между CRM, таблицами, почтой и мессенджерами — сложные решения передают человеку</p>
      <ul class="nero-ai-badges" aria-label="Ключевые направления">
        <li class="nero-ai-badge">AI-агенты</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">Make/n8n</li>
        <li class="nero-ai-badge">Продажи</li>
        <li class="nero-ai-badge">Поддержка</li>
        <li class="nero-ai-badge">Документы</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Оценить задачи для агента</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#cta">Получить карту задач для AI-агентов</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-операционного центра">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-операционный центр</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Заявок в очереди</span>
              <strong>12</strong>
              <small>почта · Telegram · форма</small>
            </div>
            <div class="nero-ai-metric">
              <span>До первого ответа</span>
              <strong>4 мин</strong>
              <small>среднее за смену</small>
            </div>
            <div class="nero-ai-metric">
              <span>Шагов без человека</span>
              <strong>78%</strong>
              <small>классификация · CRM · ответ</small>
            </div>
            <div class="nero-ai-metric">
              <span>Эскалации сегодня</span>
              <strong>2</strong>
              <small>human-in-the-loop</small>
            </div>
          </div>

          <div class="raa-dash-canvas-wrap" aria-hidden="false">
            <canvas id="raa-hero-canvas" role="img" aria-label="Анимация: заявка проходит через AI-агента к CRM, ответу клиенту и задаче менеджеру"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий агента">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">@</span>
              <div><strong>Письмо sales@ → классификация лида</strong><span>извлечение контакта и потребности</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">обработано</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Сделка создана в amoCRM</strong><span>ответственный назначен · этап воронки</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↩</span>
              <div><strong>Ответ клиенту отправлен</strong><span>шаблон + контекст из RAG</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">☎</span>
              <div><strong>Задача менеджеру: звонок через 15 мин</strong><span>эскалация по правилу суммы</span></div>
              <span class="nero-ai-status nero-ai-status--amber">HITL</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * raa-hero-engine — «Оркестрационный нексус AI-агента»
 * Мир: каналы (почта, чат, таблица) → ядро агента → CRM → ответ → шлюз human-in-the-loop
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("raa-hero-canvas");
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
    scale = Math.min(cw / 420, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    amber: "#f59e0b",
    panel: "rgba(15,23,42,0.85)",
    glow: "rgba(121,242,255,0.35)",
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
      ctx.lineWidth = 1.2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Орбитальные каналы входа */
  function ChannelSatellites() {
    this.nodes = [
      { angle: -2.1, r: 92, label: "mail", color: C.cyan },
      { angle: -0.55, r: 88, label: "TG", color: C.green },
      { angle: 0.75, r: 90, label: "CRM", color: C.violet },
      { angle: 2.15, r: 86, label: "sheet", color: C.amber }
    ];
  }
  ChannelSatellites.prototype.draw = function (ctx) {
    var self = this;
    this.nodes.forEach(function (n) {
      var nx = Math.cos(n.angle) * n.r * scale;
      var ny = Math.sin(n.angle) * n.r * 0.55 * scale;
      drawRR(ctx, nx - 18, ny - 12, 36, 24, 6, "rgba(255,255,255,0.07)", C.outline);
      ctx.fillStyle = n.color;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(n.label, nx, ny + 3);
      ctx.strokeStyle = "rgba(121,242,255,0.18)";
      ctx.lineWidth = 1;
      ctx.beginPath();
      ctx.moveTo(nx, ny);
      ctx.quadraticCurveTo(nx * 0.35, ny * 0.2, 0, 0);
      ctx.stroke();
    });
  };

  /* Центральное ядро агента — шестиугольник */
  function AgentNexusCore() {
    this.pulse = 0;
  }
  AgentNexusCore.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    this.pulse = 0.5 + Math.sin(frame * 0.08) * 0.5;
    var rad = 28 + this.pulse * 4;
    ctx.save();
    ctx.shadowColor = C.glow;
    ctx.shadowBlur = 14 + this.pulse * 10;
    ctx.fillStyle = "rgba(121,242,255,0.12)";
    ctx.strokeStyle = C.cyan;
    ctx.lineWidth = 1.8;
    ctx.beginPath();
    for (var i = 0; i < 6; i++) {
      var a = (Math.PI / 3) * i - Math.PI / 6;
      var px = Math.cos(a) * rad;
      var py = Math.sin(a) * rad;
      if (i === 0) ctx.moveTo(px, py);
      else ctx.lineTo(px, py);
    }
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    ctx.restore();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI", 0, 3);
    if (prg > 40 && prg < 120) {
      var ring = (prg - 40) / 80;
      ctx.strokeStyle = "rgba(139,92,246," + (0.25 + ring * 0.35) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, 0, rad + 10 + ring * 8, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* Мини-терминал CRM справа */
  function CrmDealBoard() {
    this.dealPhase = 0;
  }
  CrmDealBoard.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    var bx = 118 * scale;
    drawRR(ctx, bx - 42, -52, 84, 78, 8, C.panel, C.outline);
    ctx.fillStyle = C.violet;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("amoCRM · сделка", bx - 34, -40);
    var cols = ["Новая", "Квал", "Звонок"];
    cols.forEach(function (c, i) {
      drawRR(ctx, bx - 34 + i * 24, -30, 20, 44, 4, "rgba(255,255,255,0.05)", C.outline);
      ctx.fillStyle = "#94a3b8";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(c, bx - 24 + i * 24, -22);
    });
    if (prg > 70) {
      var cardX = bx - 24 + Math.min(2, Math.floor((prg - 70) / 35)) * 24;
      drawRR(ctx, cardX - 7, -8, 14, 18, 3, "rgba(121,242,255,0.25)", C.cyan);
    }
    if (prg > 150) {
      ctx.fillStyle = C.green;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("✓ ответ", bx, 18);
    }
  };

  /* Шлюз human-in-the-loop */
  function HumanEscalationGate() {
    this.open = false;
  }
  HumanEscalationGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 220;
    this.open = prg > 165;
    var gx = -8;
    var gy = 58 * scale;
    drawRR(ctx, gx - 38, gy - 10, 76, 22, 6, this.open ? "rgba(245,158,11,0.15)" : "rgba(255,255,255,0.05)", this.open ? C.amber : C.outline);
    ctx.fillStyle = this.open ? "#fde68a" : "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(this.open ? "HITL · менеджер" : "авто-режим", gx, gy + 4);
  };

  /* Импульсы данных по дугам */
  function DataPulseStream() {
    this.pulses = [
      { from: -2.1, t: 0, color: C.cyan },
      { from: -0.55, t: 40, color: C.green },
      { from: 0.75, t: 90, color: C.violet },
      { from: 2.15, t: 130, color: C.amber }
    ];
  }
  DataPulseStream.prototype.draw = function (ctx) {
    var cycle = (frame * 0.9) % 200;
    this.pulses.forEach(function (p) {
      var t = ((cycle + p.t) % 200) / 200;
      if (t > 0.92) return;
      var startA = p.from;
      var sx = Math.cos(startA) * 92 * scale;
      var sy = Math.sin(startA) * 92 * 0.55 * scale;
      var px = sx * (1 - t);
      var py = sy * (1 - t);
      ctx.fillStyle = p.color;
      ctx.beginPath();
      ctx.arc(px, py, 3 + t * 2, 0, Math.PI * 2);
      ctx.fill();
    });
  };

  /* Агент-интеграторы (5 ролей) */
  function IntegrationAgent(x, y, color, role, dialogs) {
    this.x = x; this.y = y; this.color = color; this.role = role;
    this.dialogs = dialogs || [];
    this.stepTrig = Math.random() * 200;
    this.bubble = null;
  }
  IntegrationAgent.prototype.draw = function (ctx) {
    var walk = Math.sin((frame + this.stepTrig) * 0.05) * 2;
    var ax = this.x + walk;
    var ay = this.y + Math.cos((frame + this.stepTrig) * 0.04) * 1.5;
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(ax, ay - 8, 5, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillRect(ax - 4, ay - 3, 8, 10);
    if (this.bubble && frame < this.bubble.until) {
      var bw = 54, bh = 16;
      drawRR(ctx, ax - bw / 2, ay - 28, bw, bh, 4, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(this.bubble.text, ax, ay - 17);
    } else if (Math.random() < 0.002 && this.dialogs.length) {
      this.bubble = { text: this.dialogs[Math.floor(Math.random() * this.dialogs.length)], until: frame + 90 };
    }
  };

  var agents = [
    new IntegrationAgent(-95, 28, C.agentBlue, "trigger", ["webhook", "событие"]),
    new IntegrationAgent(-42, 38, C.agentGreen, "classify", ["лид B2B", "скоринг"]),
    new IntegrationAgent(8, 32, C.agentPurple, "crm", ["сделка+", "поля"]),
    new IntegrationAgent(52, 36, C.agentPink, "reply", ["ответ ✓", "шаблон"]),
    new IntegrationAgent(96, 30, C.agentYellow, "hitl", ["эскалация", "review"])
  ];

  var channels = new ChannelSatellites();
  var core = new AgentNexusCore();
  var crm = new CrmDealBoard();
  var gate = new HumanEscalationGate();
  var pulses = new DataPulseStream();

  function engineloop() {
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    channels.draw(ctx);
    pulses.draw(ctx);
    core.draw(ctx);
    crm.draw(ctx);
    gate.draw(ctx);
    agents.forEach(function (a) { a.draw(ctx); });

    var prg = (frame * 0.04) % 220;
    if (prg > 12 && prg < 28) {
      ctx.fillStyle = "rgba(121,242,255,0.85)";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("заявка → агент", -70, -68);
    }
    if (prg > 95 && prg < 112) {
      ctx.fillStyle = "rgba(34,197,94,0.9)";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("CRM + ответ", 55, -68);
    }

    ctx.restore();
    frame++;
    requestAnimationFrame(engineloop);
  }
  engineloop();
});
</script>

<div class="raa-content">

  <section class="raa-intro" id="vvedenie" aria-label="Введение">
    <div class="raa-cnt">
      <div class="raa-intro-grid nero-ai-reveal">
        <div class="raa-intro-text">
          <p class="raa-eyebrow">Лонгрид · ai-агенты</p>
          <p><strong>Коротко:</strong> разработка AI-агентов для бизнеса — это заказная интеграция систем, которые не просто отвечают в чате, а выполняют многошаговые сценарии в CRM, почте, таблицах и мессенджерах. Nero Network проектирует таких агентов под ключ: от аудита задач до пилота с human-in-the-loop.</p>
          <p>AI-автоматизация бизнеса в 2026 году смещается к <strong>действиям в системах</strong>, а не к демо-ботам. Агенты закрывают разрыв между «поиграли с ChatGPT» и измеримым процессом в CRM, почте и мессенджерах.</p>
        </div>
        <div class="raa-intro-deco" aria-label="Ключевые темы">
          <div class="raa-intro-chip">Human-in-the-loop</div>
          <div class="raa-intro-chip">Make / n8n</div>
          <div class="raa-intro-chip">CRM + почта</div>
          <div class="raa-intro-chip">Карта задач</div>
          <div class="raa-intro-stat"><strong>62%</strong><span>компаний тестируют AI-агентов · McKinsey 2025</span></div>
          <div class="raa-intro-stat"><strong>23%</strong><span>масштабируют в одной функции</span></div>
        </div>
      </div>
    </div>
  </section>

  <div class="raa-toc-outer"><div class="raa-cnt"><nav class="raa-toc" aria-label="Оглавление">
    <a href="#boli">Боли</a><a href="#uslugi">Агенты</a><a href="#operacionnyj-centr">Сценарий</a>
    <a href="#process">Внедрение</a><a href="#stoimost">Стоимость</a><a href="#faq">FAQ</a>
  </nav></div></div>

  <section class="raa-section" id="boli">
    <div class="raa-cnt">
      <div class="raa-sh raa-left">
        <span class="raa-eyebrow">Боли бизнеса</span>
        <h2>Почему ручные переключения между CRM, почтой и мессенджерами съедают время</h2>
        <p>Внедрение AI в бизнес-процессы чаще всего начинается не с «умного чата», а с боли в операционке: письмо → CRM → мессенджер → Google Sheets → задача коллеге. Каждый цикл — минуты на заявку, десятки раз в день.</p>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
      <p class="nero-ai-reveal">По McKinsey Global Survey 2025: <strong>62%</strong> организаций экспериментируют с AI-агентами, <strong>23%</strong> масштабируют в одной функции.</p>
      <div class="raa-grid-3 nero-ai-reveal" style="margin-top:28px">
        <div class="raa-card"><div class="raa-pain-icon" aria-hidden="true">📧</div><h3>Продажи</h3><p>Лид с почты/Telegram → ручной ввод в amoCRM/Bitrix24 → задача на перезвон.</p></div>
        <div class="raa-card nero-ai-delay-1"><div class="raa-pain-icon" aria-hidden="true">🎧</div><h3>Поддержка</h3><p>Регламент, копирование номера заказа, эскалация в IT — без L1/L2 автоматизации команда тонет.</p></div>
        <div class="raa-card nero-ai-delay-2"><div class="raa-pain-icon" aria-hidden="true">📄</div><h3>Back-office</h3><p>Накладные и статусы в таблицах. Кейс Nurax/РБК: цикл накладной <strong>4 ч → 15 мин</strong> на PDF.</p></div>
      </div>
      <div class="raa-itog nero-ai-reveal">Повторяющиеся переключения между CRM, почтой, таблицами и мессенджерами — кандидаты на AI-агентов, не на чат-виджет.</div>
    </div>
  </section>

  <section class="raa-section raa-section-alt" id="agent-vs-bot">
    <div class="raa-cnt">
      <div class="raa-sh"><span class="raa-eyebrow">Терминология</span><h2>AI-агент и чат-бот — в чём разница для бизнеса</h2><p>Запросы «ai агенты» и «нейросети ai-агенты» в выдаче часто смешивают три класса решений. Для заказчика важно различать их до подписания сметы.</p></div>
      <div class="raa-table-wrap nero-ai-reveal"><table class="raa-table">
        <thead><tr><th>Критерий</th><th>Чат-бот</th><th>RPA</th><th>AI-агент</th></tr></thead>
        <tbody>
          <tr><td>Триггер</td><td>Реплика</td><td>Расписание</td><td>Событие в системе</td></tr>
          <tr><td>Действие</td><td>Ответ в чате</td><td>Клики UI</td><td>API: сделки, письма, статусы</td></tr>
          <tr><td>Эскалация</td><td>Оператор</td><td>Ошибка</td><td>Human-in-the-loop + лог</td></tr>
        </tbody>
      </table></div>
      <p class="nero-ai-reveal" style="margin-top:24px;max-width:780px;margin-left:auto;margin-right:auto;text-align:center">Как формулирует Ciklum (2025–2026): RPA автоматизирует правило, чат-бот ведёт разговор, <strong>AI-агент координирует суждение, исключения и несколько систем</strong>.</p>
      <div class="raa-card nero-ai-reveal" style="margin-top:28px"><h3>Human-in-the-loop</h3>
        <div class="raa-table-wrap"><table class="raa-table raa-table--hitl">
          <thead><tr><th>Действие</th><th>Режим</th><th>Примеры</th></tr></thead>
          <tbody>
            <tr><td>Агент сам</td><td>Авто</td><td>Классификация, типовой ответ</td></tr>
            <tr><td>Спросить</td><td>HITL</td><td>Скидка вне политики, конфликт данных</td></tr>
            <tr><td>Человек</td><td>Без агента</td><td>Договор, платёж, переговоры</td></tr>
          </tbody>
        </table></div>
      </div>
    </div>
  </section>


  <!-- === БОРИС: визуальный блок после #agent-vs-bot === -->
  <section id="razrabotka-ai-agentov-boris-block" class="raa-b-root" aria-label="Анимация: ручные переключения между CRM, почтой, мессенджером и таблицами vs единый AI-агент">
<style>
#razrabotka-ai-agentov-boris-block.raa-b-root{padding:56px 0 64px;background:#f1f5f9}
#razrabotka-ai-agentov-boris-block .raa-b-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#razrabotka-ai-agentov-boris-block .raa-b-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:500px}
@media(max-width:1023px){#razrabotka-ai-agentov-boris-block .raa-b-card{grid-template-columns:1fr;min-height:auto}}
#razrabotka-ai-agentov-boris-block .raa-b-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0}
@media(max-width:1023px){#razrabotka-ai-agentov-boris-block .raa-b-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px}}
#razrabotka-ai-agentov-boris-block .raa-b-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0891b2;margin:0 0 14px}
#razrabotka-ai-agentov-boris-block .raa-b-ey::before{content:'';width:18px;height:2px;background:#0891b2;border-radius:1px}
#razrabotka-ai-agentov-boris-block .raa-b-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px}
#razrabotka-ai-agentov-boris-block .raa-b-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px}
#razrabotka-ai-agentov-boris-block .raa-b-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155}
#razrabotka-ai-agentov-boris-block .raa-b-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(8,145,178,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0e7490;margin-top:1px;font-style:normal}
#razrabotka-ai-agentov-boris-block .raa-b-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px}
#razrabotka-ai-agentov-boris-block .raa-b-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap}
#razrabotka-ai-agentov-boris-block .raa-b-pl-r{background:rgba(239,68,68,.08);color:#b91c1c;border:1.5px solid rgba(239,68,68,.22)}
#razrabotka-ai-agentov-boris-block .raa-b-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#razrabotka-ai-agentov-boris-block .raa-b-pl-c{background:rgba(121,242,255,.15);color:#0e7490;border:1.5px solid rgba(8,145,178,.25)}
#razrabotka-ai-agentov-boris-block .raa-b-foot{font-size:13px;color:#64748b;font-style:italic;margin:0}
#razrabotka-ai-agentov-boris-block .raa-b-rgt{position:relative;background:linear-gradient(145deg,#0a0f1e 0%,#111827 55%,#0d1526 100%);min-height:440px;overflow:hidden}
@media(max-width:1023px){#razrabotka-ai-agentov-boris-block .raa-b-rgt{min-height:380px}}
#raa-switch-pain-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>
<div class="raa-b-cnt">
  <div class="raa-b-card">
    <div class="raa-b-lft">
      <span class="raa-b-ey">До автоматизации</span>
      <h3 class="raa-b-h3">Четыре окна — один сотрудник: почта, CRM, Telegram и таблица без единого сценария</h3>
      <ul class="raa-b-ul">
        <li><span class="raa-b-ic">✉</span>Письмо sales@ — телефон копируется вручную в amoCRM</li>
        <li><span class="raa-b-ic">💬</span>Ответ уходит из Telegram, карточка сделки не обновлена</li>
        <li><span class="raa-b-ic">📊</span>Статус в Google Sheets расходится с CRM</li>
        <li><span class="raa-b-ic">→</span>AI-агент сводит цепочку: событие → контекст → действие → лог → эскалация</li>
      </ul>
      <div class="raa-b-pills">
        <span class="raa-b-pl raa-b-pl-r">~8 мин / заявка</span>
        <span class="raa-b-pl raa-b-pl-c">4 системы</span>
        <span class="raa-b-pl raa-b-pl-g">1 агент → 1 сценарий</span>
      </div>
      <p class="raa-b-foot">Дальше — какие AI-агентов мы разрабатываем под ключ →</p>
    </div>
    <div class="raa-b-rgt">
      <canvas id="raa-switch-pain-canvas" role="img" aria-label="Анимация: данные прыгают между окнами почты, CRM, Telegram и таблицы, затем объединяются AI-агентом"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('raa-switch-pain-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, t = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    mail:'#38bdf8', crm:'#a78bfa', tg:'#22d3ee', sheet:'#4ade80',
    agent:'#79f2ff', warn:'#f87171', text:'#e2e8f0', muted:'rgba(226,232,240,.45)',
    win:'rgba(255,255,255,.06)', bdr:'rgba(255,255,255,.14)', pkt:'#fbbf24'
  };

  var APPS = [
    {id:'mail', label:'Почта', x:0.12, y:0.14, w:0.34, h:0.28, color:C.mail},
    {id:'crm', label:'CRM', x:0.54, y:0.10, w:0.36, h:0.30, color:C.crm},
    {id:'tg', label:'Telegram', x:0.10, y:0.52, w:0.32, h:0.26, color:C.tg},
    {id:'sheet', label:'Sheets', x:0.52, y:0.50, w:0.36, h:0.28, color:C.sheet}
  ];

  var LOOP = 900;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle=fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawWin(app, alpha, active){
    var x = app.x*W, y = app.y*H, w = app.w*W, h = app.h*H;
    ctx.globalAlpha = alpha || 1;
    rr(x,y,w,h,10,C.win,app.color, active?2.5:1);
    rr(x,y,w,22,10,app.color,null,0);
    ctx.fillStyle='#0f172a';
    ctx.font='bold 10px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText(app.label,x+10,y+15);
    if (active){
      ctx.strokeStyle=app.color;
      ctx.lineWidth=2;
      ctx.shadowColor=app.color;
      ctx.shadowBlur=12;
      rr(x,y,w,h,10,null,app.color,2);
      ctx.shadowBlur=0;
    }
    ctx.globalAlpha=1;
    return {cx:x+w/2, cy:y+h/2};
  }

  function drawPacket(px, py, s, alpha){
    ctx.globalAlpha = alpha || 1;
    rr(px-s/2,py-s/2,s,s,4,C.pkt,'#f59e0b',1);
    ctx.fillStyle='#78350f';
    ctx.font='bold 8px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('DATA',px,py+3);
    ctx.globalAlpha=1;
  }

  function drawAgent(cx, cy, r, pulse){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r);
    g.addColorStop(0,'rgba(121,242,255,.35)');
    g.addColorStop(1,'rgba(121,242,255,0)');
    ctx.fillStyle=g;
    ctx.beginPath();ctx.arc(cx,cy,r+pulse*8,0,Math.PI*2);ctx.fill();
    rr(cx-r*0.7,cy-r*0.55,r*1.4,r*1.1,14,'rgba(121,242,255,.12)',C.agent,2);
    ctx.fillStyle=C.agent;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('AI-агент',cx,cy-4);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText('orchestrator',cx,cy+10);
  }

  function lerp(a,b,p){ return a+(b-a)*p; }

  function frame(){
    t = (t+1) % LOOP;
    ctx.clearRect(0,0,W,H);

    var phase = t / LOOP;
    var chaos = phase < 0.72;
    var agentOn = !chaos;
    var agentPulse = Math.sin(t*0.08)*0.5+0.5;

    var centers = [];
    for (var i=0;i<APPS.length;i++){
      var active = chaos && Math.floor((t/40)%4)===i;
      centers.push(drawWin(APPS[i], chaos?1:0.35, active));
    }

    if (chaos){
      var path = Math.floor(t/55)%6;
      var pairs = [[0,1],[1,2],[2,3],[3,0],[0,2],[1,3]];
      var pr = (t%55)/55;
      var a = centers[pairs[path][0]], b = centers[pairs[path][1]];
      var px = lerp(a.cx,b.cx,pr), py = lerp(a.cy,b.cy,pr);
      drawPacket(px,py,18,1);
      ctx.strokeStyle='rgba(248,113,113,.4)';
      ctx.setLineDash([4,6]);
      ctx.beginPath();ctx.moveTo(a.cx,a.cy);ctx.lineTo(b.cx,b.cy);ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle=C.warn;
      ctx.font='bold 11px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('ручное копирование',W/2,H*0.92);
    } else {
      var acx = W*0.5, acy = H*0.5;
      drawAgent(acx,acy,42,agentPulse);
      for (var j=0;j<centers.length;j++){
        ctx.strokeStyle='rgba(121,242,255,.35)';
        ctx.lineWidth=1.5;
        ctx.beginPath();ctx.moveTo(acx,acy);ctx.lineTo(centers[j].cx,centers[j].cy);ctx.stroke();
        drawWin(APPS[j],0.55,false);
      }
      ctx.fillStyle=C.agent;
      ctx.font='bold 11px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('единый сценарий',W/2,H*0.92);
    }

    requestAnimationFrame(frame);
  }
  requestAnimationFrame(frame);
})();
</script>
  </section>

  <section class="raa-section" id="uslugi">
    <div class="raa-cnt">
      <div class="raa-sh">
        <span class="raa-eyebrow">Услуги</span>
        <h2>Какие AI-агентов мы разрабатываем под ключ</h2>
        <p>Разработка AI-агентов под ключ начинается с <strong>одного приоритетного сценария</strong>, а не с «универсального цифрового сотрудника на всё».</p>
      </div>
      <div class="raa-grid-2 nero-ai-reveal">
        <div class="raa-card raa-service"><h3>Агент для продаж и лидов</h3><p><strong>Триггеры:</strong> форма, почта, Telegram/WhatsApp. <strong>Действия:</strong> сделка в amoCRM/Bitrix24, первичный ответ, задача на звонок.</p></div>
        <div class="raa-card raa-service nero-ai-delay-1"><h3>Агент поддержки</h3><p>Диагностика по базе знаний, автозакрытие типовых кейсов, эскалация в L2 с summary.</p></div>
        <div class="raa-card raa-service nero-ai-delay-1"><h3>Back-office: документы</h3><p>PDF/скан → извлечение полей → сверка → маршрутизация в 1С/ERP.</p></div>
        <div class="raa-card raa-service nero-ai-delay-2"><h3>Сквозные сценарии</h3><p>Заявка → квалификация → CRM → ответ клиенту → задача менеджеру. Смежные услуги: <a href="/vnedrenie-ai-amocrm/">amoCRM</a>, <a href="/ai-1c-erp/">1С/ERP</a>, <a href="/vnedrenie-ai-obrabotka-email-crm/">почта → CRM</a>.</p></div>
      </div>
    </div>
  </section>

  <!-- CTA Артура #1 — после #uslugi -->
  <div class="ym-cta-block ym-cta-block--primary" id="cta-uslugi">
    <div class="ym-cta-block__icon" aria-hidden="true">🤖</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Нужен AI-агент под ваш сценарий?</p>
      <p class="ym-cta-block__sub">Разберём один приоритетный процесс — продажи, поддержка или back-office: триггеры, интеграции CRM/почты/мессенджеров, точки human-in-the-loop. Оценка задач бесплатно, без обязательств по внедрению.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Оценить задачи для агента</a>
    </div>
  </div>

  <section class="raa-section raa-section-alt" id="operacionnyj-centr">
    <div class="raa-cnt">
      <div class="raa-sh">
        <span class="raa-eyebrow">Сценарий</span>
        <h2>AI-операционный центр: как выглядит рабочий сценарий агента</h2>
        <p>AI-операционный центр — <strong>наглядная модель</strong> прохождения сценария от события до метрик на дашборде.</p>
      </div>
      <div class="raa-flow nero-ai-reveal">
        <div class="raa-flow-step"><strong>1. Событие</strong><span>почта / Telegram / форма</span></div>
        <span class="raa-flow-arrow" aria-hidden="true">→</span>
        <div class="raa-flow-step"><strong>2. Контекст</strong><span>RAG, история, вложения</span></div>
        <span class="raa-flow-arrow" aria-hidden="true">→</span>
        <div class="raa-flow-step"><strong>3. План</strong><span>классификация, сущности</span></div>
        <span class="raa-flow-arrow" aria-hidden="true">→</span>
        <div class="raa-flow-step"><strong>4. API</strong><span>CRM, ответ, задача</span></div>
        <span class="raa-flow-arrow" aria-hidden="true">→</span>
        <div class="raa-flow-step"><strong>5. Контроль</strong><span>эскалация человеку</span></div>
      </div>
      <p class="nero-ai-reveal" style="max-width:780px;margin:0 auto 28px;text-align:center">На дашборде пилота: время до первого ответа, доля шагов без человека, число эскалаций, очередь необработанных событий.</p>
      <div class="raa-chips nero-ai-reveal" aria-label="Стек интеграций">
        <span class="raa-chip">Make / n8n</span><span class="raa-chip">amoCRM</span><span class="raa-chip">Bitrix24</span><span class="raa-chip">1С</span><span class="raa-chip">Telegram</span><span class="raa-chip">Google Sheets</span><span class="raa-chip">RAG / MCP</span>
      </div>
    </div>
  </section>

  <section class="raa-section" id="trendy-2026">
    <div class="raa-cnt">
      <div class="raa-sh">
        <span class="raa-eyebrow">Тренды 2026</span>
        <h2>Тренды 2026: task-specific AI agents в корпоративных приложениях</h2>
      </div>
      <div class="raa-kpi-big nero-ai-reveal">
        <p style="margin-bottom:8px;color:var(--raa-muted)">Прогноз Gartner: enterprise apps с task-specific AI agents</p>
        <strong data-nero-count="40" data-nero-suffix="%">0%</strong>
        <p style="margin-top:12px;font-size:14px">к концу 2026 года — против &lt;5% в 2025. <em>Оговорка для SMB:</em> прогноз про вендоров enterprise-приложений, не про долю МСБ с кастомными агентами.</p>
      </div>
      <div class="raa-card nero-ai-reveal"><h3>Почему пора переходить от чат-ботов к агентам с действиями</h3><p>Три драйвера 2026: спрос на внедрение AI решений с измеримым эффектом; зрелость Make/n8n/MCP; дефицит кадров — агент снимает переключения между системами, человек остаётся на сложных решениях.</p></div>
    </div>
  </section>

  <section class="raa-section raa-section-alt" id="process">
    <div class="raa-cnt">
      <div class="raa-sh raa-left">
        <span class="raa-eyebrow">Внедрение</span>
        <h2>Процесс разработки и внедрения AI-агентов</h2>
      </div>
      <div class="raa-timeline nero-ai-reveal">
        <div class="raa-tl-item"><div class="raa-tl-dot"></div><h3>Аудит задач и карта сценариев</h3><p><strong>1–2 недели.</strong> На выходе — Карта задач для AI-агентов: триггер, системы, KPI пилота.</p></div>
        <div class="raa-tl-item"><div class="raa-tl-dot"></div><h3>Проектирование, интеграции, пилот</h3><p><strong>3–6 недель</strong> на один сквозной сценарий. Webhooks, RAG, guardrails, тест на 20–50 примерах.</p></div>
        <div class="raa-tl-item"><div class="raa-tl-dot"></div><h3>Обучение и сопровождение</h3><p>Регламент human-in-the-loop, дашборд метрик, итерации каждые 2–4 недели.</p></div>
      </div>
    </div>
  </section>

  <!-- CTA Артура #2 — после #process -->
  <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
      <p class="ym-cta-block__sub">Перед разработкой AI-агентов полезно разобраться в n8n, промптах, human-in-the-loop и интеграциях с CRM — это ускоряет приёмку пилота и согласование с IT. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
    </div>
  </aside>

  <section class="raa-section" id="dlya-kogo">
    <div class="raa-cnt">
      <div class="raa-sh"><span class="raa-eyebrow">Сегменты</span><h2>Для кого подходит разработка AI-агентов</h2></div>
      <div class="raa-grid-4 nero-ai-reveal">
        <div class="raa-card"><h3>Отделы продаж</h3><p>Поток лидов из нескольких каналов, ручной ввод в CRM.</p></div>
        <div class="raa-card"><h3>Поддержка</h3><p>Типовые обращения, база знаний, e-commerce/SaaS.</p></div>
        <div class="raa-card"><h3>Back-office</h3><p>Документооборот, сверки, ERP + почта.</p></div>
        <div class="raa-card"><h3>МСБ</h3><p>Один агент на Make/n8n + CRM + мессенджер; пилот 300 тыс.–2,5 млн ₽.</p></div>
      </div>
    </div>
  </section>

  <section class="raa-section raa-section-alt" id="rezultaty">
    <div class="raa-cnt">
      <div class="raa-sh"><span class="raa-eyebrow">KPI пилота</span><h2>Результаты пилота: что можно измерить без завышенных обещаний</h2></div>
      <div class="raa-grid-3 nero-ai-reveal">
        <div class="raa-card"><h3>Время до первого ответа</h3><p>Минуты/часы — до и после пилота.</p></div>
        <div class="raa-card"><h3>Доля шагов без человека</h3><p>+ число эскалаций и причины.</p></div>
        <div class="raa-card"><h3>Ручное копирование</h3><p>Объём переключений между системами до/после.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;font-size:14px">Ограничение: агент не исправит хаотичный CRM без регламентов. Пилот — с короткой цепочкой и прозрачной эскалацией.</p>
    </div>
  </section>

  <section class="raa-section" id="stoimost">
    <div class="raa-cnt">
      <div class="raa-sh"><span class="raa-eyebrow">Цена</span><h2>Стоимость разработки AI-агентов и сроки пилота</h2></div>
      <p class="nero-ai-reveal" style="text-align:center;max-width:680px;margin:0 auto 16px">Запросы «разработка ai агентов цена» закрываем честно: <strong>без аудита задач смета будет неточной</strong>.</p>
      <p class="nero-ai-reveal" style="text-align:center;max-width:680px;margin:0 auto 28px">Ориентир чека: <strong>300 тыс.–2,5 млн ₽</strong>. Точная смета — после карты задач.</p>
      <div class="raa-table-wrap nero-ai-reveal">
        <table class="raa-table">
          <thead><tr><th>Фактор</th><th>Влияние на бюджет</th></tr></thead>
          <tbody>
            <tr><td>Число систем (CRM + почта + мессенджер + ERP)</td><td>Каждая интеграция — отдельный контур API</td></tr>
            <tr><td>Неструктурированные документы</td><td>Выше требования к извлечению и валидации</td></tr>
            <tr><td>On-premise / российские LLM</td><td>Инфраструктура и лицензии</td></tr>
            <tr><td>Compliance</td><td>Логи, маскирование PII, роли</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;text-align:center"><a href="#cta">Оценить задачи для агента</a> · <a href="#cta">Получить карту задач для AI-агентов</a></p>
    </div>
  </section>

  <section class="raa-section raa-section-alt" id="seo-uslugi">
    <div class="raa-cnt">
      <div class="raa-sh"><span class="raa-eyebrow">SEO</span><h2>Разработка AI-агентов для бизнеса — услуги и направления</h2></div>
      <div class="raa-grid-3 nero-ai-reveal">
        <div class="raa-card"><h3>Заказать разработку</h3><p>Аудит → карта → пилот → масштаб. amoCRM, Bitrix24, 1С, Telegram, Make/n8n.</p></div>
        <div class="raa-card"><h3>Внедрение AI в бизнес-процессы</h3><p>Продажи, поддержка, документы. Human-in-the-loop, метрики пилота.</p></div>
        <div class="raa-card"><h3>Интеграция с CRM</h3><p>Сквозные сценарии вне одного вендора. <a href="/vnedrenie-ai-amocrm/">amoCRM</a>, <a href="/vnedrenie-ai-obrabotka-email-crm/">почта</a>, <a href="/ai-1c-erp/">1С/ERP</a>.</p></div>
      </div>
    </div>
  </section>

  <section class="raa-section" id="faq">
    <div class="raa-cnt">
      <div class="raa-sh"><span class="raa-eyebrow">FAQ</span><h2>Частые вопросы о разработке AI-агентов</h2></div>
      <div class="raa-faq nero-ai-reveal" id="raa-faq-accordion">
        <div class="raa-faq-item"><div class="raa-faq-q" role="button" tabindex="0">Сколько стоит разработка AI-агентов?</div><div class="raa-faq-a"><p>Ориентир <strong>300 тыс.–2,5 млн ₽</strong>. Пилот одного агента — <strong>3–6 недель</strong> после аудита.</p></div></div>
        <div class="raa-faq-item"><div class="raa-faq-q" role="button" tabindex="0">Можно ли внедрить без программиста в штате?</div><div class="raa-faq-a"><p>Да. Разработка AI-агентов без программиста на стороне клиента — нормальная модель: интегратор настраивает Make/n8n, API, RAG и регламенты; ваша команда участвует в интервью, приёмке пилота и обновлении базы знаний.</p></div></div>
        <div class="raa-faq-item"><div class="raa-faq-q" role="button" tabindex="0">Какие CRM и системы поддерживаются?</div><div class="raa-faq-a"><p>amoCRM, Bitrix24, МойСклад, 1С, почта (IMAP/Exchange), Telegram, WhatsApp Business, VK, Google Sheets, Tilda/WordPress-формы, helpdesk (UseDesk и аналоги). Нестандартные системы — по API.</p></div></div>
        <div class="raa-faq-item"><div class="raa-faq-q" role="button" tabindex="0">Под ключ или своими силами?</div><div class="raa-faq-a"><p>Под ключ (Nero Network) — 4–8 недель до пилота, несколько интеграций, ответственность за production. Гибрид: пилот под ключ + документация и сценарии Make/n8n для IT.</p></div></div>
        <div class="raa-faq-item"><div class="raa-faq-q" role="button" tabindex="0">Какие задачи решает агент в первую очередь?</div><div class="raa-faq-a"><p>Квалификация лида, первичный ответ, сделка, типовой тикет, извлечение полей из документа.</p></div></div>
        <div class="raa-faq-item"><div class="raa-faq-q" role="button" tabindex="0">Чем агент отличается от RPA?</div><div class="raa-faq-a"><p>RPA — жёсткий UI-сценарий; агент — вариативный текст и ветвления. На практике — гибрид.</p></div></div>
        <div class="raa-faq-item"><div class="raa-faq-q" role="button" tabindex="0">Безопасны ли данные?</div><div class="raa-faq-a"><p>GigaChat, YandexGPT, on-premise, 152-ФЗ, маскирование PII в логах — на этапе аудита.</p></div></div>
      </div>
    </div>
  </section>

  <section class="raa-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="raa-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы убрать ручные переключения между CRM, почтой и мессенджерами?</p>
          <p class="ym-cta-block__sub">Nero Network проводит аудит, собирает <strong>Карту задач для AI-агентов</strong> и запускает пилот одного сценария с human-in-the-loop. Чек проекта — ориентир 300 тыс.–2,5 млн ₽ после карты задач.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Оценить задачи для агента</a>
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost"<?php echo $primary_cta_attrs; ?>>Получить карту задач для AI-агентов</a>
          </div>
          <p class="ym-cta-block__sub ym-cta-block__note">«Получить карту» — тот же бриф: на выходе структурированный разбор цепочек для автоматизации. Первый шаг без обязательств.</p>
        </div>
      </div>
    </div>
  </section>

</div>
</div><!-- /.raa-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.raa-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.raa-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.raa-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.raa-faq-q');
        if (q) q.setAttribute('aria-expanded', 'false');
      });
      if (!isOpen) {
        item.classList.add('open');
        btn.setAttribute('aria-expanded', 'true');
      }
    });
    btn.addEventListener('keydown', function(e){
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.raa-content');
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

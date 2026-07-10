<?php
/**
 * Template Name: AI для SEO-продвижения: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI SEO: семантика, контент-план, тексты, перелинковка. Кейсы, цены, FAQ.
 */
$page_seo_title       = 'AI SEO под ключ: внедрение семантики, контента и перелинковки';
$page_seo_description = 'Внедрение AI SEO для бизнеса и агентств: настроим сбор семантики, контент-план, SEO-тексты и внутреннюю перелинковку. Цена, кейсы и консультация — меньше рутины, быстрее страницы в выдаче.';
$page_seo_keywords    = 'ai seo, внедрение ai seo, ai seo под ключ, нейросети для seo, искусственный интеллект для seo, ai seo для бизнеса, настройка ai seo, ai seo цена, ai seo кейсы, семантика seo ai, контент-план seo, ai автоматизация seo';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description, $page_seo_keywords): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta name="keywords" content="' . esc_attr($page_seo_keywords) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: '');

$nero_ai_header_links = [
    ['label' => 'Задачи',       'href' => '#zadachi-seo'],
    ['label' => 'Процесс',      'href' => '#etapy-vnedreniya'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Кейсы',        'href' => '#keisy'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать SEO через AI';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = '#zadachi-seo';
$secondary_cta_ext   = getenv('SECONDARY_CTA_URL') ?: '';
$secondary_cta_lbl   = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';

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
.yoast-breadcrumb,.entry-header,.page-title-section { display: none !important; }

#primary,.site-main,.site-content,#content,.content-area {
  padding-top: 0 !important; margin-top: 0 !important;
}

/* === Hero Алины (vseo) === */
.vnedrenie-ai-seo-page .nero-ai-hero {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
  padding: clamp(108px, 14vh, 148px) 0 clamp(64px, 8vw, 80px);
  background:
    radial-gradient(ellipse 80% 50% at 70% 20%, rgba(121, 242, 255, 0.14), transparent),
    radial-gradient(ellipse 60% 40% at 10% 80%, rgba(139, 92, 246, 0.12), transparent),
    #060a12;
  overflow: hidden;
}
.vnedrenie-ai-seo-page .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: 1fr 1.08fr;
  gap: clamp(28px, 5vw, 52px);
  align-items: center;
  width: min(1200px, 92vw);
  margin: 0 auto;
}
.vnedrenie-ai-seo-page .nero-ai-eyebrow {
  display: inline-block;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #79f2ff;
  margin-bottom: 14px;
}
.vnedrenie-ai-seo-page #hero-seo-title {
  font-size: clamp(32px, 4.8vw, 54px);
  font-weight: 800;
  line-height: 1.08;
  letter-spacing: -0.03em;
  color: #f8fafc;
  margin: 0 0 18px;
}
.vnedrenie-ai-seo-page .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #79f2ff 0%, #8b5cf6 55%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-top: 4px;
}
.vnedrenie-ai-seo-page .nero-ai-hero-lead {
  font-size: clamp(16px, 1.9vw, 19px);
  line-height: 1.62;
  color: #94a3b8;
  margin: 0 0 24px;
  max-width: 580px;
}
.vnedrenie-ai-seo-page .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  list-style: none;
  padding: 0;
  margin: 0 0 26px;
}
.vnedrenie-ai-seo-page .nero-ai-badge {
  padding: 8px 14px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  background: rgba(121, 242, 255, 0.08);
  border: 1px solid rgba(121, 242, 255, 0.22);
  color: #bfdbfe;
}
.vnedrenie-ai-seo-page .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}
.vnedrenie-ai-seo-page .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 24px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 15px;
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.2s;
}
.vnedrenie-ai-seo-page .nero-ai-btn-primary {
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  color: #fff !important;
  box-shadow: 0 8px 32px rgba(59, 130, 246, 0.35);
}
.vnedrenie-ai-seo-page .nero-ai-btn-secondary {
  background: transparent;
  color: #e2e8f0 !important;
  border: 1px solid rgba(148, 163, 184, 0.2);
}
.vnedrenie-ai-seo-page .nero-ai-btn:hover { transform: translateY(-2px); }
.vnedrenie-ai-seo-page .nero-ai-dashboard {
  position: relative;
  background: rgba(15, 23, 42, 0.72);
  border: 1px solid rgba(148, 163, 184, 0.14);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 24px 64px rgba(0, 0, 0, 0.45);
  backdrop-filter: blur(12px);
}
.vnedrenie-ai-seo-page .vseo-hero-canvas-wrap {
  position: absolute;
  inset: 0;
  opacity: 0.42;
  pointer-events: none;
  z-index: 0;
}
#vseo-hero-canvas { width: 100%; height: 100%; display: block; }
.vnedrenie-ai-seo-page .nero-ai-dashboard-shell {
  position: relative;
  z-index: 1;
  padding: 18px;
}
.vnedrenie-ai-seo-page .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 14px;
  padding-bottom: 12px;
  border-bottom: 1px solid rgba(148, 163, 184, 0.12);
}
.vnedrenie-ai-seo-page .nero-ai-dots { display: flex; gap: 6px; }
.vnedrenie-ai-seo-page .nero-ai-dot {
  width: 10px; height: 10px; border-radius: 50%;
  background: rgba(148, 163, 184, 0.35);
}
.vnedrenie-ai-seo-page .nero-ai-window-title {
  font-size: 12px; font-weight: 600; color: #94a3b8;
}
.vnedrenie-ai-seo-page .nero-ai-dashboard-title {
  display: flex; justify-content: space-between; align-items: center;
  margin-bottom: 14px;
}
.vnedrenie-ai-seo-page .nero-ai-dashboard-title h3 {
  margin: 0; font-size: 14px; font-weight: 700; color: #f8fafc;
}
.vnedrenie-ai-seo-page .nero-ai-live-pill {
  font-size: 11px; color: #4ade80; display: flex; align-items: center; gap: 6px;
}
.vnedrenie-ai-seo-page .nero-ai-live-pill::before {
  content: ''; width: 6px; height: 6px; border-radius: 50%;
  background: #4ade80; animation: vseo-pulse 2s infinite;
}
@keyframes vseo-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.35; } }
.vnedrenie-ai-seo-page .nero-ai-metrics-grid {
  display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-bottom: 12px;
}
.vnedrenie-ai-seo-page .nero-ai-metric {
  background: rgba(30, 41, 59, 0.65);
  border: 1px solid rgba(148, 163, 184, 0.12);
  border-radius: 12px; padding: 12px;
}
.vnedrenie-ai-seo-page .nero-ai-metric span {
  display: block; font-size: 11px; color: #79f2ff; margin-bottom: 2px;
}
.vnedrenie-ai-seo-page .nero-ai-metric strong {
  display: block; font-size: 20px; color: #f8fafc; letter-spacing: -0.03em;
}
.vnedrenie-ai-seo-page .nero-ai-metric small { font-size: 10px; color: #64748b; }
.vnedrenie-ai-seo-page .nero-ai-task-stream { margin-top: 4px; }
.vnedrenie-ai-seo-page .nero-ai-task {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 0; border-bottom: 1px solid rgba(148, 163, 184, 0.08);
  font-size: 12px;
}
.vnedrenie-ai-seo-page .nero-ai-task:last-child { border-bottom: none; }
.vnedrenie-ai-seo-page .nero-ai-task-icon {
  width: 28px; height: 28px; border-radius: 8px;
  background: rgba(139, 92, 246, 0.2); color: #c4b5fd;
  display: flex; align-items: center; justify-content: center;
  font-size: 10px; font-weight: 800; flex-shrink: 0;
}
.vnedrenie-ai-seo-page .nero-ai-task div { flex: 1; }
.vnedrenie-ai-seo-page .nero-ai-task strong {
  display: block; color: #e2e8f0; font-size: 12px;
}
.vnedrenie-ai-seo-page .nero-ai-task div span { color: #64748b; font-size: 11px; }
.vnedrenie-ai-seo-page .nero-ai-status {
  font-size: 10px; font-weight: 700; padding: 4px 8px; border-radius: 999px;
  background: rgba(34, 197, 94, 0.15); color: #4ade80;
}
.vnedrenie-ai-seo-page .nero-ai-status--new {
  background: rgba(121, 242, 255, 0.12); color: #79f2ff;
}
@media (max-width: 900px) {
  .vnedrenie-ai-seo-page .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnedrenie-ai-seo-page .vseo-hero-canvas-wrap { height: 180px; position: relative; }
}

.vseo-content {
  --vseo-bg: #050711; --vseo-bg2: #080b17; --vseo-bg3: #0a0e1c;
  --vseo-surface: rgba(255,255,255,.072); --vseo-surface2: rgba(255,255,255,.108);
  --vseo-text: #e6edf7; --vseo-muted: #9aa8bd; --vseo-soft: #c7d2e5; --vseo-heading: #fff;
  --vseo-border: rgba(255,255,255,.10); --vseo-border-s: rgba(255,255,255,.18);
  --vseo-accent: #79f2ff; --vseo-violet: #8b5cf6; --vseo-green: #22c55e; --vseo-cyan: #79f2ff;
  --vseo-btn-from: #2563eb; --vseo-btn-to: #7c3aed;
  --vseo-shadow: 0 24px 72px rgba(0,0,0,.4);
  --vseo-r: 18px; --vseo-r-lg: 24px; --vseo-container: 1220px;
  background: linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
  color: var(--vseo-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  overflow-x: hidden;
}
.vseo-content *, .vseo-content *::before, .vseo-content *::after { box-sizing: border-box; }
.vseo-content a { color: inherit; text-decoration: none; }
.vseo-content p { color: var(--vseo-muted); line-height: 1.72; margin: 0 0 1em; }
.vseo-content p:last-child { margin-bottom: 0; }
.vseo-content h2, .vseo-content h3, .vseo-content h4 {
  color: var(--vseo-heading); letter-spacing: -.045em; margin: 0 0 .7em;
}
.vseo-content strong { color: var(--vseo-soft); }
.vseo-content ul { padding-left: 0; list-style: none; margin: 0 0 1em; }
.vseo-content ul li {
  padding-left: 20px; position: relative; margin-bottom: .45em;
  color: var(--vseo-muted); font-size: 14.5px; line-height: 1.65;
}
.vseo-content ul li::before {
  content: '›'; position: absolute; left: 0; color: var(--vseo-accent); font-weight: 700;
}
.vseo-content code {
  background: rgba(121,242,255,.1); padding: 2px 6px; border-radius: 4px;
  font-size: 13px; color: var(--vseo-accent);
}
.vseo-cnt { width: min(var(--vseo-container), calc(100% - 40px)); margin: 0 auto; position: relative; z-index: 1; }
.vseo-section { padding: clamp(64px, 8vw, 112px) 0; position: relative; }
.vseo-section-alt {
  background: linear-gradient(180deg, rgba(255,255,255,.032), rgba(255,255,255,.01));
  border-top: 1px solid rgba(255,255,255,.06); border-bottom: 1px solid rgba(255,255,255,.06);
}
.vseo-sh { max-width: 820px; margin: 0 auto 48px; text-align: center; }
.vseo-sh.vseo-left { margin-left: 0; text-align: left; }
.vseo-sh h2 { font-size: clamp(26px, 4vw, 50px); line-height: 1.06; margin-bottom: 14px; }
.vseo-sh p { font-size: clamp(15px, 1.6vw, 18px); max-width: 680px; margin: 0 auto; }
.vseo-sh.vseo-left p { margin-left: 0; }
.vseo-eyebrow {
  display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px; border-radius: 999px;
  background: rgba(121,242,255,.08); border: 1px solid rgba(121,242,255,.22);
  font-size: 11.5px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
  color: var(--vseo-accent); margin-bottom: 14px;
}
.vseo-gt {
  background: linear-gradient(92deg, #fff 0%, var(--vseo-accent) 44%, var(--vseo-violet) 100%);
  -webkit-background-clip: text; background-clip: text; color: transparent !important;
}
.vseo-intro {
  padding: clamp(40px, 5vw, 72px) 0 clamp(40px, 5vw, 64px);
  background: linear-gradient(180deg, rgba(255,255,255,.03), transparent);
  border-bottom: 1px solid rgba(255,255,255,.06);
}
.vseo-intro-grid { display: grid; grid-template-columns: 1fr 340px; gap: 56px; align-items: center; }
.vseo-intro-text { position: relative; padding-left: 20px; }
.vseo-intro-text::before {
  content: ''; position: absolute; left: 0; top: 4px; bottom: 4px; width: 3px; border-radius: 2px;
  background: linear-gradient(180deg, var(--vseo-accent), var(--vseo-violet));
}
.vseo-intro-text p { text-align: left !important; font-size: clamp(14.5px, 1.55vw, 16.5px); line-height: 1.8; }
.vseo-intro-kpi { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.vseo-kpi-card {
  background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1); border-radius: 14px;
  padding: 16px 14px; text-align: center; box-shadow: 0 8px 28px rgba(0,0,0,.25); backdrop-filter: blur(12px);
}
.vseo-kpi-card .kv { font-size: clamp(20px, 2.5vw, 26px); font-weight: 900; color: var(--vseo-heading); letter-spacing: -.04em; line-height: 1; margin-bottom: 5px; }
.vseo-kpi-card .kl { font-size: 11px; font-weight: 600; color: var(--vseo-muted); line-height: 1.4; }
.vseo-kpi-card .ks { font-size: 10px; color: #64748b; margin-top: 4px; }
@media (max-width: 900px) { .vseo-intro-grid { grid-template-columns: 1fr; gap: 36px; } .vseo-intro-kpi { grid-template-columns: repeat(4, 1fr); } }
@media (max-width: 600px) { .vseo-intro-kpi { grid-template-columns: 1fr 1fr; } }
.vseo-toc-outer { padding: 0 0 clamp(36px, 4.5vw, 56px); }
.vseo-toc { display: flex; flex-wrap: wrap; gap: 9px; justify-content: center; }
.vseo-toc a {
  display: inline-block; padding: 9px 18px; background: var(--vseo-surface); border: 1px solid var(--vseo-border);
  border-radius: 999px; font-size: 13px; font-weight: 600; color: var(--vseo-muted);
  transition: border-color .2s, color .2s, background .2s;
}
.vseo-toc a:hover { border-color: rgba(121,242,255,.42); color: var(--vseo-accent); background: rgba(121,242,255,.08); }
.vseo-card {
  background: linear-gradient(180deg, rgba(255,255,255,.085), rgba(255,255,255,.042));
  border: 1px solid var(--vseo-border); border-radius: var(--vseo-r-lg); padding: 26px;
  backdrop-filter: blur(16px); box-shadow: 0 14px 40px rgba(0,0,0,.22);
  transition: border-color .22s, transform .22s;
}
.vseo-card:hover { border-color: rgba(121,242,255,.28); transform: translateY(-2px); }
.vseo-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.vseo-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.vseo-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
@media (max-width: 768px) { .vseo-grid-2, .vseo-grid-3, .vseo-grid-4 { grid-template-columns: 1fr; } }
@media (max-width: 960px) { .vseo-grid-3 { grid-template-columns: 1fr 1fr; } .vseo-grid-4 { grid-template-columns: 1fr 1fr; } }
@media (max-width: 600px) { .vseo-grid-3, .vseo-grid-4 { grid-template-columns: 1fr; } }
.vseo-module-card {
  background: rgba(255,255,255,.055); border: 1px solid rgba(255,255,255,.1); border-radius: var(--vseo-r);
  padding: 24px; transition: border-color .2s;
}
.vseo-module-card:hover { border-color: rgba(121,242,255,.3); }
.vseo-module-card h3 { font-size: 17px; margin-bottom: 8px; }
.vseo-module-tag {
  font-size: 11px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
  color: var(--vseo-violet); margin-bottom: 10px;
}
.vseo-table-wrap { overflow-x: auto; border-radius: 14px; border: 1px solid rgba(255,255,255,.09); margin: 20px 0; }
.vseo-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.vseo-table th {
  padding: 13px 16px; text-align: left; background: rgba(121,242,255,.1); color: var(--vseo-accent);
  font-weight: 700; border-bottom: 1px solid rgba(121,242,255,.25); white-space: nowrap;
}
.vseo-table td { padding: 12px 16px; border-bottom: 1px solid rgba(255,255,255,.05); color: var(--vseo-text); vertical-align: top; }
.vseo-table tr:last-child td { border-bottom: none; }
.vseo-table tr:hover td { background: rgba(255,255,255,.03); }
.vseo-table tr.vseo-highlight td { background: rgba(121,242,255,.08); font-weight: 600; }
.vseo-timeline { position: relative; padding-left: 40px; }
.vseo-timeline::before {
  content: ''; position: absolute; left: 12px; top: 8px; bottom: 8px; width: 2px;
  background: linear-gradient(180deg, var(--vseo-accent), var(--vseo-violet)); opacity: .35; border-radius: 2px;
}
.vseo-tl-item { position: relative; margin-bottom: 32px; }
.vseo-tl-item:last-child { margin-bottom: 0; }
.vseo-tl-dot {
  position: absolute; left: -32px; top: 4px; width: 16px; height: 16px; border-radius: 50%;
  background: var(--vseo-accent); box-shadow: 0 0 0 4px rgba(121,242,255,.2);
}
.vseo-tl-item h3 { font-size: 17px; margin-bottom: 8px; }
.vseo-case-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
@media (max-width: 900px) { .vseo-case-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 600px) { .vseo-case-grid { grid-template-columns: 1fr; } }
.vseo-case-card {
  background: rgba(255,255,255,.055); border: 1px solid rgba(255,255,255,.09);
  border-radius: 20px; padding: 26px; transition: border-color .2s, transform .2s;
}
.vseo-case-card:hover { border-color: rgba(34,197,94,.35); transform: translateY(-2px); }
.vseo-case-tag { font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--vseo-green); margin-bottom: 10px; }
.vseo-faq { display: flex; flex-direction: column; gap: 10px; max-width: 820px; margin: 0 auto; }
.vseo-faq-item { background: rgba(255,255,255,.055); border: 1px solid rgba(255,255,255,.1); border-radius: 14px; overflow: hidden; }
.vseo-faq-q {
  padding: 19px 24px; font-size: 16px; font-weight: 700; color: var(--vseo-heading); cursor: pointer;
  display: flex; align-items: center; justify-content: space-between; gap: 16px; user-select: none;
}
.vseo-faq-q::after { content: '▾'; font-size: 13px; color: var(--vseo-accent); flex-shrink: 0; transition: transform .25s; }
.vseo-faq-item.open .vseo-faq-q::after { transform: rotate(180deg); }
.vseo-faq-a {
  padding: 0 24px; max-height: 0; overflow: hidden; transition: max-height .38s ease, padding .25s;
  font-size: 14.5px; color: var(--vseo-muted); line-height: 1.72;
}
.vseo-faq-item.open .vseo-faq-a { max-height: 600px; padding: 0 24px 20px; }
.ym-cta-block {
  border-radius: 20px; padding: 36px 40px; margin: 32px 0;
  background: linear-gradient(135deg, rgba(121,242,255,.12), rgba(139,92,246,.1));
  border: 1px solid rgba(121,242,255,.3); text-align: center;
}
.ym-cta-block--secondary { background: rgba(255,255,255,.04); border-color: rgba(255,255,255,.12); text-align: left; }
.ym-cta-block--dual { background: linear-gradient(135deg, rgba(34,197,94,.1), rgba(121,242,255,.1)); border-color: rgba(34,197,94,.3); }
.ym-cta-block--footer-final { background: linear-gradient(135deg, rgba(139,92,246,.12), rgba(121,242,255,.08)); border-color: rgba(139,92,246,.3); }
.ym-cta-block__icon { font-size: 36px; margin-bottom: 14px; }
.ym-cta-block__headline { font-size: clamp(20px, 2.8vw, 28px); font-weight: 800; color: #fff; margin: 0 0 10px; }
.ym-cta-block__sub { color: var(--vseo-muted); font-size: 15px; margin: 0 auto 22px; max-width: 600px; line-height: 1.7; }
.ym-cta-block--secondary .ym-cta-block__sub { margin-left: 0; }
.ym-cta-block__actions { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; }
.ym-btn {
  display: inline-flex; align-items: center; justify-content: center; padding: 13px 28px;
  border-radius: 999px; font-size: 15px; font-weight: 700; text-decoration: none !important;
  transition: transform .2s, box-shadow .2s;
}
.ym-btn:hover { transform: translateY(-2px); }
.ym-btn--accent, .nero-ai-home-page .ym-btn--accent {
  background: linear-gradient(135deg, var(--vseo-btn-from), var(--vseo-btn-to)); color: #fff !important;
  box-shadow: 0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--ghost { background: rgba(255,255,255,.08); color: var(--vseo-text) !important; border: 1.5px solid rgba(255,255,255,.18); }
.ym-link--accent { color: var(--vseo-accent) !important; text-decoration: underline !important; }
.nero-ai-reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease, transform .55s ease; }
.nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
.nero-ai-delay-1 { transition-delay: .12s; }
.nero-ai-delay-2 { transition-delay: .24s; }
@media (max-width: 600px) { .ym-cta-block { padding: 28px 20px; } }
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-seo-page" role="main" tabindex="-1">

<!-- HERO: блок Алины (canvas + dashboard) -->
<section class="nero-ai-hero" id="hero" aria-labelledby="hero-seo-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai seo</p>
      <h1 id="hero-seo-title">AI для SEO-продвижения: <span class="nero-ai-gradient-text">внедрение семантики, контента и перелинковки под ключ</span></h1>
      <p class="nero-ai-hero-lead">Настроим AI-процесс для сбора семантики, контент-плана, SEO-текстов и внутренней перелинковки — чтобы команда тратила меньше времени на рутину и быстрее выпускала оптимизированные страницы</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Семантика</li>
        <li class="nero-ai-badge">Контент-план</li>
        <li class="nero-ai-badge">SEO-тексты</li>
        <li class="nero-ai-badge">Перелинковка</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#zadachi-seo">Как это работает</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: SEO-конвейер">
      <div class="vseo-hero-canvas-wrap" aria-hidden="true">
        <canvas id="vseo-hero-canvas"></canvas>
      </div>
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">SEO-конвейер · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-операционный центр</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Кластеры</span><strong>847</strong><small>в ядре</small></div>
            <div class="nero-ai-metric"><span>Страницы/день</span><strong>8</strong><small>ramp-up</small></div>
            <div class="nero-ai-metric"><span>Время на статью</span><strong>−72%</strong><small>vs ручной</small></div>
            <div class="nero-ai-metric"><span>Индексация</span><strong>live</strong><small>GSC</small></div>
          </div>
          <div class="nero-ai-task-stream">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">WS</span>
              <div><strong>Wordstat → кластер</strong><span>Semantic Engine</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AR</span>
              <div><strong>Content Architect → план</strong><span>карта страниц</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">WR</span>
              <div><strong>Writer Agent → черновик</strong><span>SERP-gap brief</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">LK</span>
              <div><strong>Internal Link → 3 ссылки</strong><span>hub-and-spoke</span></div>
              <span class="nero-ai-status nero-ai-status--new">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vseo-content">

  <section class="vseo-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vseo-cnt nero-ai-container">
      <div class="vseo-intro-grid nero-ai-intro-grid nero-ai-reveal">
        <div class="vseo-intro-text nero-ai-intro-text">
          <p class="vseo-eyebrow">Лонгрид · ai seo</p>
          <p>Семантика, статьи, метатеги и перелинковка съедают недели — а очередь кластеров растёт быстрее штата. По данным Microsoft (<a href="https://arxiv.org/abs/2605.23958" target="_blank" rel="noopener noreferrer">arXiv 2605.23958</a>, 5,34 млн промптов), <strong>~60% запросов</strong> в enterprise-AI — подготовка текстов и извлечение информации. SEO-команда может закрыть рутину тем же паттерном.</p>
          <p><strong>AI SEO</strong> — не разовый промпт в ChatGPT, а внедрённый конвейер: семантика → контент-план → SEO-тексты → перелинковка → модерация → CMS. Nero Network настраивает его под ключ — с human-in-the-loop, мульти-LLM стеком и аналитикой по кластерам.</p>
        </div>
        <div class="vseo-intro-kpi" aria-label="Ключевые показатели">
          <div class="vseo-kpi-card"><div class="kv">60%</div><div class="kl">writing + retrieval</div><div class="ks">arxiv 2605.23958</div></div>
          <div class="vseo-kpi-card"><div class="kv">100–700K</div><div class="kl">ориентир чека Nero</div><div class="ks">под ключ</div></div>
          <div class="vseo-kpi-card"><div class="kv">3–10</div><div class="kl">страниц в день</div><div class="ks">после ramp-up</div></div>
          <div class="vseo-kpi-card"><div class="kv">5–10%</div><div class="kl">выборочный QA</div><div class="ks">human gate</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vseo-cnt">
    <p class="nero-ai-reveal" style="margin:0 auto clamp(24px,3vw,36px);max-width:820px;font-size:15px;line-height:1.72;text-align:center;color:var(--vseo-muted)">Тренд enterprise-AI к writing и retrieval уже виден у крупных компаний: в разборе <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--vseo-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude — уроки AI для бизнеса</a> показано, как цифровые шлюзы и managed-агенты сокращают рутину — тот же принцип применим к SEO-конвейеру.</p>
  </div>

  <div class="vseo-toc-outer">
    <div class="vseo-cnt">
      <nav class="vseo-toc" aria-label="Оглавление статьи">
        <a href="#aktualnost-2026">Актуальность 2026</a>
        <a href="#zadachi-seo">Задачи SEO</a>
        <a href="#komu-podhodit">Для кого</a>
        <a href="#etapy-vnedreniya">Процесс</a>
        <a href="#sravnenie">Сравнение</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#riski">Риски</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Следующий шаг</a>
      </nav>
    </div>
  </div>

  <section class="vseo-section" id="aktualnost-2026">
    <div class="vseo-cnt">
      <div class="vseo-sh">
        <span class="vseo-eyebrow">Тренд 2026</span>
        <h2>Почему AI для SEO-продвижения актуален в 2026 году</h2>
        <p>SEO в 2026 — классическая выдача, AI Overviews и ответы нейросетей. Побеждают те, кто быстрее производит структурированный экспертный контент с human-in-the-loop.</p>
      </div>
      <div class="vseo-card nero-ai-reveal">
        <h3>Как enterprise-AI смещается к writing и information retrieval</h3>
        <p>Исследование Microsoft «AI in the Enterprise: How People Use M365 Copilot Chat» (<a href="https://arxiv.org/abs/2605.23958" target="_blank" rel="noopener noreferrer">arXiv 2605.23958</a>) проанализировало ~5,34 млн промптов. <strong>Writing доминирует</strong> — Content Refinement ~25% запросов; Information Inquiry + Content Refinement вместе — ~60%. Copilot выполняет ~3,26 активности на разговор против ~1,68 у пользователя: AI берёт рутину, человек задаёт цель.</p>
      </div>
      <div class="vseo-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="vseo-table">
          <thead><tr><th>Задача SEO</th><th>Аналог в M365 Copilot</th><th>Роль AI в конвейере</th></tr></thead>
          <tbody>
            <tr><td>Сбор семантики, анализ SERP</td><td>Information Inquiry</td><td>Парсинг, кластеризация, gap-анализ</td></tr>
            <tr><td>Контент-план, ТЗ, H1/meta</td><td>Ideation and Planning</td><td>Структура, типы страниц, приоритеты</td></tr>
            <tr><td>SEO-тексты, обновление страниц</td><td>Content Refinement</td><td>Черновик + редактура по брифу</td></tr>
            <tr><td>Перелинковка, анкоры</td><td>Documenting Information</td><td>Автоподбор контекстных ссылок</td></tr>
            <tr><td>Стратегия и QA</td><td>Decision making</td><td>Human-in-the-loop, контроль 5–10%</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vseo-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Что меняется в SEO-рутине</h3>
        <p><strong>GEO</strong> — видимость в ChatGPT, Алисе, Perplexity. <strong>AI SEO-workflow</strong> — конвейер страниц из Wordstat в CMS. Nero Network закрывает второе; GEO — надстройка поверх готового контента.</p>
        <p>Традиционный цикл: Wordstat → кластеры в Excel → ТЗ копирайтеру → meta вручную → CMS → перелинковка «когда дойдут руки». <strong>Внедрение AI SEO</strong> переносит это в оркестрированный пайплайн с QA-gate.</p>
        <ul>
          <li>семантика собирается и чистится автоматически;</li>
          <li>контент-план генерируется из карты сайта;</li>
          <li>SEO-тексты создаются по ТЗ из SERP-gap;</li>
          <li>перелинковка встраивается при генерации — 2–3 контекстные ссылки;</li>
          <li>публикация с модерацией: 100% ВЧ, 5–10% выборочно НЧ.</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="vseo-section vseo-section-alt" id="zadachi-seo">
    <div class="vseo-cnt">
      <div class="vseo-sh">
        <span class="vseo-eyebrow">Задачи</span>
        <h2>Какие задачи SEO закрывает внедрение AI</h2>
        <p><strong>AI SEO</strong> — конвейер: семантика → контент-план → тексты и мета → перелинковка → модерация → публикация. Не разовый промпт, а система с интеграциями и QA.</p>
      </div>
      <div class="vseo-grid-2 nero-ai-reveal">
        <div class="vseo-module-card">
          <div class="vseo-module-tag">Semantic Engine</div>
          <h3>Сбор и кластеризация семантики</h3>
          <p>Импорт из Wordstat, Keys.so, Rush Analytics → нормализация, дедуп, классификация по интенту. LLM валидирует спорные кластеры.</p>
        </div>
        <div class="vseo-module-card">
          <div class="vseo-module-tag">Content Architect</div>
          <h3>Контент-план и календарь</h3>
          <p>Карта сайта: тип страницы, H1, title/description, hub-and-spoke. Лид-магнит: <strong>AI-контент-план</strong>.</p>
        </div>
        <div class="vseo-module-card">
          <div class="vseo-module-tag">Writer + Editor</div>
          <h3>SEO-тексты и метатеги</h3>
          <p>Черновик по SERP-gap, антипереспам, проверка галлюцинаций. Google оценивает качество, не происхождение.</p>
        </div>
        <div class="vseo-module-card">
          <div class="vseo-module-tag">Internal Link Agent</div>
          <h3>Перелинковка и обновление</h3>
          <p>2–3 контекстные ссылки в абзацах. Обновление устаревших страниц по новому брифу.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:28px;text-align:center;max-width:720px;margin-left:auto;margin-right:auto;"><strong>Итог по задачам:</strong> внедрение ai seo сокращает 60–80% повторяемых операций; стратегию, модерацию ВЧ и YMYL оставляет людям.</p>
    </div>
  </section>

  <!-- БОРИС: визуальный блок после #zadachi-seo -->
  <section id="vnedrenie-ai-seo-boris-block" class="bseo-root" aria-label="Анимация: SEO-конвейер — от кластера до публикации в CMS">
<style>
#vnedrenie-ai-seo-boris-block.bseo-root { padding: 60px 0 72px; background: #f0f4fb; }
#vnedrenie-ai-seo-boris-block .bseo-cnt { max-width: 1160px; margin: 0 auto; padding: 0 20px; }
#vnedrenie-ai-seo-boris-block .bseo-card {
  display: grid; grid-template-columns: 42% 58%; border-radius: 24px; overflow: hidden;
  box-shadow: 0 8px 48px rgba(15,23,42,.13), 0 0 0 1.5px rgba(121,242,255,.2); min-height: 500px;
}
@media (max-width: 960px) { #vnedrenie-ai-seo-boris-block .bseo-card { grid-template-columns: 1fr; min-height: auto; } }
#vnedrenie-ai-seo-boris-block .bseo-lft {
  background: #fff; padding: 48px 40px; display: flex; flex-direction: column; justify-content: center;
}
@media (max-width: 600px) { #vnedrenie-ai-seo-boris-block .bseo-lft { padding: 32px 24px; } }
#vnedrenie-ai-seo-boris-block .bseo-ey {
  display: inline-flex; align-items: center; gap: 7px; font-size: 11px; font-weight: 700;
  letter-spacing: .11em; text-transform: uppercase; color: #0ea5e9; margin: 0 0 15px;
}
#vnedrenie-ai-seo-boris-block .bseo-ey::before { content: ''; display: inline-block; width: 20px; height: 2px; background: #0ea5e9; border-radius: 1px; }
#vnedrenie-ai-seo-boris-block .bseo-h3 { font-size: 25px; font-weight: 800; color: #0f172a; line-height: 1.3; margin: 0 0 22px; }
#vnedrenie-ai-seo-boris-block .bseo-ul { list-style: none; margin: 0 0 26px; padding: 0; display: flex; flex-direction: column; gap: 10px; }
#vnedrenie-ai-seo-boris-block .bseo-ul li { display: flex; align-items: flex-start; gap: 10px; font-size: 14.5px; line-height: 1.5; color: #334155; }
#vnedrenie-ai-seo-boris-block .bseo-ic {
  flex-shrink: 0; width: 22px; height: 22px; border-radius: 50%; background: rgba(14,165,233,.1);
  display: flex; align-items: center; justify-content: center; font-size: 11px; color: #0ea5e9; margin-top: 1px; font-style: normal;
}
#vnedrenie-ai-seo-boris-block .bseo-pills { display: flex; flex-wrap: wrap; gap: 7px; margin-bottom: 22px; }
#vnedrenie-ai-seo-boris-block .bseo-pl { padding: 5px 12px; border-radius: 99px; font-size: 12px; font-weight: 700; white-space: nowrap; }
#vnedrenie-ai-seo-boris-block .bseo-pl-g { background: rgba(34,197,94,.08); color: #15803d; border: 1.5px solid rgba(34,197,94,.22); }
#vnedrenie-ai-seo-boris-block .bseo-pl-c { background: rgba(121,242,255,.1); color: #0369a1; border: 1.5px solid rgba(121,242,255,.3); }
#vnedrenie-ai-seo-boris-block .bseo-pl-v { background: rgba(139,92,246,.08); color: #5b21b6; border: 1.5px solid rgba(139,92,246,.22); }
#vnedrenie-ai-seo-boris-block .bseo-foot { font-size: 13.5px; color: #64748b; font-style: italic; margin: 0; }
#vnedrenie-ai-seo-boris-block .bseo-rgt {
  background: linear-gradient(145deg, #07091a 0%, #0d1224 55%, #090d1f 100%); position: relative; overflow: hidden; min-height: 400px;
}
#bseo-pipeline-canvas { position: absolute; inset: 0; width: 100%; height: 100%; display: block; }
</style>
<div class="bseo-cnt"><div class="bseo-card">
  <div class="bseo-lft">
    <span class="bseo-ey">Продолжение конвейера</span>
    <h3 class="bseo-h3">От кластера Wordstat до страницы в CMS — поток без ручного копипаста</h3>
    <ul class="bseo-ul">
      <li><span class="bseo-ic">1</span>Кластер проходит Semantic Engine — чистка, интент, приоритет</li>
      <li><span class="bseo-ic">2</span>Content Architect назначает тип страницы и H1/meta</li>
      <li><span class="bseo-ic">3</span>Writer Agent генерирует черновик, Editor проверяет переспам</li>
      <li><span class="bseo-ic">4</span>Internal Link Agent встраивает 2–3 контекстные ссылки</li>
      <li><span class="bseo-ic">✓</span>QA-gate → публикация в WordPress с Schema.org</li>
    </ul>
    <div class="bseo-pills">
      <span class="bseo-pl bseo-pl-c">847 кластеров</span>
      <span class="bseo-pl bseo-pl-g">−72% на статью</span>
      <span class="bseo-pl bseo-pl-v">human gate 5–10%</span>
    </div>
    <p class="bseo-foot">Дальше — для кого подходит AI SEO под ключ →</p>
  </div>
  <div class="bseo-rgt">
    <canvas id="bseo-pipeline-canvas" aria-label="Анимация SEO-конвейера: кластеры движутся через станции семантики, контента, перелинковки к публикации в CMS" role="img"></canvas>
  </div>
</div></div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bseo-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize() {
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var STATIONS = [
    { label: 'Wordstat', sub: 'кластер', color: '#79f2ff', x: 0 },
    { label: 'Architect', sub: 'план', color: '#8b5cf6', x: 0 },
    { label: 'Writer', sub: 'черновик', color: '#a78bfa', x: 0 },
    { label: 'Link Agent', sub: '3 ссылки', color: '#22c55e', x: 0 },
    { label: 'CMS', sub: 'live', color: '#38bdf8', x: 0 }
  ];

  var packets = [];
  var cycle = 0;

  function rr(x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function spawnPacket() {
    packets.push({ t: 0, speed: 0.004 + Math.random() * 0.002, label: 'кластер #' + (Math.floor(Math.random() * 900) + 100), alpha: 0 });
  }

  function drawStation(s, idx, active) {
    var pad = 24;
    var gap = (W - pad * 2) / (STATIONS.length - 1);
    s.x = pad + idx * gap;
    var sy = H * 0.38;
    var sw = 72, sh = 56;
    var pulse = active ? 0.15 + 0.1 * Math.sin(frame * 0.08) : 0;

    if (active) {
      ctx.fillStyle = 'rgba(121,242,255,' + pulse + ')';
      ctx.beginPath();
      ctx.arc(s.x, sy + sh / 2, sw * 0.7, 0, Math.PI * 2);
      ctx.fill();
    }

    rr(s.x - sw / 2, sy, sw, sh, 10, 'rgba(255,255,255,.08)', s.color);
    ctx.fillStyle = s.color;
    ctx.font = 'bold 10px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(s.label, s.x, sy + 22);
    ctx.fillStyle = 'rgba(226,232,240,.55)';
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText(s.sub, s.x, sy + 38);

    if (idx < STATIONS.length - 1) {
      var nx = pad + (idx + 1) * gap;
      ctx.strokeStyle = 'rgba(255,255,255,.12)';
      ctx.lineWidth = 2;
      ctx.setLineDash([6, 6]);
      ctx.beginPath();
      ctx.moveTo(s.x + sw / 2 + 4, sy + sh / 2);
      ctx.lineTo(nx - sw / 2 - 4, sy + sh / 2);
      ctx.stroke();
      ctx.setLineDash([]);
    }
  }

  function tick() {
    frame++;
    cycle++;
    if (cycle % 90 === 0) spawnPacket();

    ctx.fillStyle = '#07091a';
    ctx.fillRect(0, 0, W, H);

    ctx.fillStyle = '#e2e8f0';
    ctx.font = 'bold 12px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('SEO Pipeline · live', 16, 24);
    ctx.fillStyle = '#22c55e';
    ctx.beginPath();
    ctx.arc(W - 28, 20, 4, 0, Math.PI * 2);
    ctx.fill();

    for (var i = 0; i < STATIONS.length; i++) {
      var act = false;
      for (var j = 0; j < packets.length; j++) {
        var seg = packets[j].t * (STATIONS.length - 1);
        if (Math.floor(seg) === i) act = true;
      }
      drawStation(STATIONS[i], i, act);
    }

    for (var k = packets.length - 1; k >= 0; k--) {
      var pk = packets[k];
      pk.t += pk.speed;
      if (pk.t < 0.05) pk.alpha = Math.min(1, pk.alpha + 0.05);
      if (pk.t > 1) { packets.splice(k, 1); continue; }

      var pad2 = 24;
      var gap2 = (W - pad2 * 2) / (STATIONS.length - 1);
      var px = pad2 + pk.t * gap2 * (STATIONS.length - 1);
      var py = H * 0.38 + 28 + Math.sin(pk.t * Math.PI * 4) * 6;

      var grd = ctx.createRadialGradient(px, py, 0, px, py, 18);
      grd.addColorStop(0, 'rgba(121,242,255,.9)');
      grd.addColorStop(1, 'rgba(121,242,255,0)');
      ctx.globalAlpha = pk.alpha;
      ctx.fillStyle = grd;
      ctx.beginPath();
      ctx.arc(px, py, 18, 0, Math.PI * 2);
      ctx.fill();
      rr(px - 14, py - 10, 28, 20, 6, '#1e293b', '#79f2ff');
      ctx.fillStyle = '#79f2ff';
      ctx.font = '8px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('SEO', px, py + 3);
      ctx.globalAlpha = 1;
    }

    if (packets.length < 3 && cycle % 60 === 0) spawnPacket();

    requestAnimationFrame(tick);
  }
  tick();
})();
</script>
  </section>

  <div class="vseo-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-zadachi">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получите AI-контент-план под вашу нишу</p>
        <p class="ym-cta-block__sub">На консультации разберём семантику, соберём карту кластеров, типы страниц и календарь публикаций — бесплатный лид-магнит перед внедрением конвейера.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <section class="vseo-section" id="komu-podhodit">
    <div class="vseo-cnt">
      <div class="vseo-sh">
        <span class="vseo-eyebrow">Аудитория</span>
        <h2>Для кого подходит AI SEO под ключ</h2>
      </div>
      <div class="vseo-grid-3 nero-ai-reveal">
        <div class="vseo-card">
          <h3>SEO-агентства и контентные команды</h3>
          <p>Масштаб без пропорционального роста штата. White-label конвейер под клиентские ниши с разными brand voice.</p>
        </div>
        <div class="vseo-card">
          <h3>Владельцы сайтов и маркетологи</h3>
          <p>Предсказуемый календарь публикаций без найма отдела копирайтеров. Programmatic SEO и мультиязычность.</p>
        </div>
        <div class="vseo-card">
          <h3>Малый и средний бизнес</h3>
          <p>Пилот на 50–100 кластеров с обучением. Оркестрация в Make.com/n8n, WordPress REST — <strong>ai seo без программиста</strong> при работе под ключ.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vseo-section vseo-section-alt" id="etapy-vnedreniya">
    <div class="vseo-cnt">
      <div class="vseo-sh">
        <span class="vseo-eyebrow">Процесс Nero</span>
        <h2>Что входит в внедрение AI SEO: наш процесс</h2>
      </div>
      <div class="vseo-card nero-ai-reveal">
        <div class="vseo-timeline">
          <div class="vseo-tl-item">
            <div class="vseo-tl-dot"></div>
            <h3>Аудит SEO-процесса (3–5 дней)</h3>
            <p>Wordstat/Keys.so, GSC, Вебмастер, CMS, brand voice, риски YMYL. Карта узких мест и план автоматизации.</p>
          </div>
          <div class="vseo-tl-item">
            <div class="vseo-tl-dot"></div>
            <h3>Настройка AI-агентов (2–4 нед., пилот)</h3>
            <p>Cursor + MCP, Make.com/n8n, мульти-LLM. Калибровка на 2–3 эталонных страницах. Интеграции: Wordstat, WordPress, amoCRM.</p>
          </div>
          <div class="vseo-tl-item">
            <div class="vseo-tl-dot"></div>
            <h3>Запуск пайплайна (4–8 нед.)</h3>
            <p>Семантика → кластеризация → Content Architect → Writer + Editor → Internal Link → QA-gate → CMS со Schema.org.</p>
          </div>
          <div class="vseo-tl-item">
            <div class="vseo-tl-dot"></div>
            <h3>Обучение команды и передача под ключ</h3>
            <p>Регламент модерации, документация, дашборд кластеров. Система остаётся у вас, а не только у подрядчика.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <aside class="vseo-cnt">
    <div class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
        <p class="ym-cta-block__sub">Перед внедрением AI SEO полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с WordPress. Посмотрите <?php if ($secondary_cta_ext) : ?><a href="<?php echo esc_url($secondary_cta_ext); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_lbl); ?></a><?php else : ?><span><?php echo esc_html($secondary_cta_lbl); ?></span><?php endif; ?>.</p>
      </div>
    </div>
  </aside>

  <div class="vseo-cnt">
    <p class="nero-ai-reveal" style="margin:0 auto 20px;max-width:820px;font-size:15px;line-height:1.72;color:var(--vseo-muted)">Когда SEO-страницы приносят лиды в CRM, следующий шаг — автоматизация воронки: <a href="/vnedrenie-ai-amocrm/" style="color:var(--vseo-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a> закрывает создание сделок, задач и итогов звонков без ручного переноса.</p>
    <p class="nero-ai-reveal" style="margin:0 auto clamp(24px,3vw,36px);max-width:820px;font-size:15px;line-height:1.72;color:var(--vseo-muted)">Если основной канал — входящая почта с лендингов, полезно связать контент-машину с triage: <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--vseo-accent);text-decoration:underline;text-underline-offset:3px">AI-обработка входящей почты в CRM</a> классифицирует письма и создаёт карточки до того, как менеджер откроет почту.</p>
  </div>

  <section class="vseo-section" id="sravnenie">
    <div class="vseo-cnt">
      <div class="vseo-sh">
        <span class="vseo-eyebrow">Сравнение</span>
        <h2>AI SEO vs ручной SEO-процесс</h2>
      </div>
      <div class="vseo-table-wrap nero-ai-reveal">
        <table class="vseo-table">
          <thead><tr><th>Критерий</th><th>Ручной SEO</th><th>AI SEO под ключ</th></tr></thead>
          <tbody>
            <tr><td>Семантика 10K кластеров</td><td>Месяцы, команда 3–6 чел.</td><td>Дни–недели с LLM-пайплайном</td></tr>
            <tr><td>Время на статью</td><td>4–8 часов + очередь</td><td>~30 мин + модерация</td></tr>
            <tr><td>Перелинковка</td><td>Вручную, откладывается</td><td>Встроена в генерацию</td></tr>
            <tr><td>Масштаб</td><td>Линейный рост штата</td><td>Программируемый ramp-up</td></tr>
            <tr><td>GEO/AEO</td><td>Отдельный проект</td><td>Надстройка над конвейером</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;">Под ключ окупается от сотен кластеров. Пилот на 50–100 кластеров — разумная точка входа перед полным конвейером.</p>
      <div class="vseo-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="vseo-card">
          <h3>Где AI, где эксперт</h3>
          <p>AI: семантика, черновики, meta, перелинковка, первичный QA. Эксперт: стратегия, ВЧ-модерация, YMYL, E-E-A-T, внешние ссылки.</p>
        </div>
        <div class="vseo-card">
          <h3>Под ключ или самостоятельно</h3>
          <p>ChatGPT + таблицы ломаются на масштабе. Под ключ окупается от сотен кластеров; пилот 50–100 — разумная точка входа.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vseo-section vseo-section-alt" id="kak-rabotaet">
    <div class="vseo-cnt">
      <div class="vseo-sh">
        <span class="vseo-eyebrow">Технология</span>
        <h2>Нейросети и AI-агенты в SEO: как это работает</h2>
      </div>
      <div class="vseo-grid-3 nero-ai-reveal">
        <div class="vseo-module-card">
          <h3>Нейросети для семантики</h3>
          <p>Researcher парсит SERP, entities и gaps. Кластеризация — Key Collector/Rush Analytics; LLM валидирует интент.</p>
        </div>
        <div class="vseo-module-card">
          <h3>LLM для текстов и meta</h3>
          <p>Gemini Flash — скорость; Claude/GPT — структура и редактура. Каждый текст из SERP-gap и brand book.</p>
        </div>
        <div class="vseo-module-card">
          <h3>Автоматизация перелинковки</h3>
          <p>4 агента: планирование + inline linking + image + publish. Google Sheets как очередь. Human approval перед live.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vseo-section" id="ceny">
    <div class="vseo-cnt">
      <div class="vseo-sh">
        <span class="vseo-eyebrow">Бюджет</span>
        <h2>Сколько стоит внедрение AI SEO</h2>
      </div>
      <div class="vseo-table-wrap nero-ai-reveal">
        <table class="vseo-table">
          <thead><tr><th>Тип услуги</th><th>Вилка (РФ, 2026)</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>Разовое внедрение AI SEO-конвейера</td><td>80–300 тыс. ₽</td><td>рынок AI SEO-фабрик</td></tr>
            <tr><td>SEO-завод (setup)</td><td>от 350 тыс. ₽ + от 25 тыс. ₽/мес</td><td>FlowFrame</td></tr>
            <tr><td>LLM-пайплайн семантики</td><td>~200 тыс. ₽, ~100 ч</td><td>InHouse / SEOnews</td></tr>
            <tr class="vseo-highlight"><td><strong>Ориентир Nero Network</strong></td><td><strong>100–700 тыс. ₽</strong></td><td>коммерческий оффер</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;">ROI считается против ФОТ копирайтеров и упущенного трафика. InHouse: окупаемость от ~10K кластеров. FlowFrame: ROI ~1,5 месяца.</p>
    </div>
  </section>

  <div class="vseo-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте бюджет внедрения AI SEO под ваш объём</p>
        <p class="ym-cta-block__sub">Ориентир 100–700 тыс. ₽ в зависимости от семантики и интеграций. На консультации дадим оценку сроков, стека и ROI — бесплатно.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Сначала FAQ</a>
        </div>
      </div>
    </div>
  </div>

  <section class="vseo-section vseo-section-alt" id="keisy">
    <div class="vseo-cnt">
      <div class="vseo-sh">
        <span class="vseo-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI SEO</h2>
      </div>
      <div class="vseo-case-grid nero-ai-reveal">
        <div class="vseo-case-card">
          <div class="vseo-case-tag">InHouse · e-commerce</div>
          <h3>Семантика 450K кластеров за 3 мес.</h3>
          <p>Без ИИ — 10% плана за 3 мес. С LLM-пайплайном — 450K кластеров, 690K страниц, ускорение 10–15×. Setup ~200 тыс. ₽.</p>
        </div>
        <div class="vseo-case-card">
          <div class="vseo-case-tag">FlowFrame · B2B SaaS</div>
          <h3>90 страниц/мес vs 4–6 вручную</h3>
          <p>4–8 мин на страницу vs 5–7 дней. Показы Google ~1 200 → ~8 500 за 60 дней. Внедрение от 350 тыс. ₽.</p>
        </div>
        <div class="vseo-case-card">
          <div class="vseo-case-tag">Ashmanov · GEO</div>
          <h3>GEO как надстройка</h3>
          <p>Flowwow: видимость в Google AI Overview ×1,7 за 4 мес. GEO работает поверх контента, который производит AI-конвейер.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vseo-section" id="riski">
    <div class="vseo-cnt">
      <div class="vseo-sh">
        <span class="vseo-eyebrow">Риски</span>
        <h2>Риски и типичные ошибки при внедрении AI в SEO</h2>
      </div>
      <div class="vseo-grid-2 nero-ai-reveal">
        <div class="vseo-card">
          <h3>Качество, E-E-A-T и переспам</h3>
          <p>Главная ошибка — автопубликация без модерации. Нужны эталонные страницы, factcheck YMYL, экспертные вставки.</p>
        </div>
        <div class="vseo-card">
          <h3>Зависимость от одного LLM</h3>
          <p>Мульти-модельный пайплайн через OpenRouter, fallback, версионирование промптов. Ramp-up индексации: старт с 3–5 стр/день.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vseo-section vseo-section-alt" id="faq">
    <div class="vseo-cnt">
      <div class="vseo-sh">
        <span class="vseo-eyebrow">FAQ</span>
        <h2>FAQ: ответы на частые вопросы</h2>
      </div>
      <div class="vseo-faq nero-ai-reveal">
        <div class="vseo-faq-item"><div class="vseo-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai seo в существующий процесс?</div><div class="vseo-faq-a">Аудит этапов → пилот 50–100 кластеров → CMS и аналитика → масштабирование после QA.</div></div>
        <div class="vseo-faq-item"><div class="vseo-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai seo для компании?</div><div class="vseo-faq-a">Ориентир Nero: 100–700 тыс. ₽. Рынок: от 80–300 тыс. ₽ за базовый конвейер.</div></div>
        <div class="vseo-faq-item"><div class="vseo-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли внедрить ai seo без программиста?</div><div class="vseo-faq-a">Да, при работе под ключ. Nero передаёт пайплайн на Make.com/n8n с WordPress REST.</div></div>
        <div class="vseo-faq-item"><div class="vseo-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли интеграция с CRM?</div><div class="vseo-faq-a">Не обязательна для старта. Полезна для лендингов: amoCRM, Bitrix24 — лиды с меткой кластера.</div></div>
        <div class="vseo-faq-item"><div class="vseo-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI SEO отличается от GEO?</div><div class="vseo-faq-a">GEO — видимость в ответах нейросетей. AI SEO — производство страниц для классической выдачи.</div></div>
        <div class="vseo-faq-item"><div class="vseo-faq-q" role="button" tabindex="0" aria-expanded="false">Google банит AI-тексты?</div><div class="vseo-faq-a">Нет. Штрафуют scaled content abuse и бесполезный контент.</div></div>
        <div class="vseo-faq-item"><div class="vseo-faq-q" role="button" tabindex="0" aria-expanded="false">ChatGPT не заменяет внедрение?</div><div class="vseo-faq-a">Нужна система: кластеры, ТЗ, QA, CMS, перелинковка, аналитика.</div></div>
        <div class="vseo-faq-item"><div class="vseo-faq-q" role="button" tabindex="0" aria-expanded="false">Какие задачи решает ai seo в первую очередь?</div><div class="vseo-faq-a">Семантика, контент-план, тексты, мета, перелинковка, обновление — 60–80% времени SEO-команды.</div></div>
        <div class="vseo-faq-item"><div class="vseo-faq-q" role="button" tabindex="0" aria-expanded="false">AI SEO под ключ или самостоятельно?</div><div class="vseo-faq-a">Самостоятельно — для единичных текстов. Под ключ — от сотен кластеров с интеграциями.</div></div>
        <div class="vseo-faq-item"><div class="vseo-faq-q" role="button" tabindex="0" aria-expanded="false">Есть ли ai seo для ниши YMYL?</div><div class="vseo-faq-a">Да, с усиленным human-in-the-loop: 100% модерация, factcheck, юридическая вычитка.</div></div>
      </div>
    </div>
  </section>

  <div class="vseo-cnt">
    <section class="ym-cta-block ym-cta-block--footer-final" id="cta">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Соберите SEO через AI — следующий шаг</p>
        <p class="ym-cta-block__sub">Внедрение AI SEO под ключ: семантика → контент-план → тексты → перелинковка → CMS. Лид-магнит: <strong>AI-контент-план</strong>. Ориентир: 100–700 тыс. ₽.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </section>
  </div>

</div><!-- /.vseo-content -->

<script>
(function(){
  document.querySelectorAll('.vseo-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.vseo-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.vseo-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.vseo-faq-q');
        if (q) q.setAttribute('aria-expanded', 'false');
      });
      if (!isOpen) { item.classList.add('open'); btn.setAttribute('aria-expanded', 'true'); }
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
  var root = document.querySelector('.vseo-content');
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

<script>
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("vseo-hero-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");
  let cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    const wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 320;
    cw = canvas.width; ch = canvas.height;
    cx = cw / 2; cy = ch / 2 + 20;
    scale = Math.min(cw / 420, ch / 340) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  const C = {
    outline: "#0f172a",
    grid: "rgba(121,242,255,0.06)",
    hub: "#1e293b",
    hubGlow: "rgba(121,242,255,0.25)",
    stream: "#334155",
    tagInfo: "#79f2ff",
    tagComm: "#8b5cf6",
    tagNav: "#22c55e",
    page: "#f8fafc",
    rank: "#4ade80",
    agentYellow: "#eab308", agentGreen: "#10b981", agentBlue: "#3b82f6",
    agentPink: "#ec4899", agentPurple: "#8b5cf6",
    bubbleBg: "rgba(15,23,42,0.92)"
  };

  function rr(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) { ctx.lineWidth = 1.5; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  class QueryStream {
    constructor(x, y, h) { this.x = x; this.y = y; this.h = h; }
    draw(ctx) {
      const offset = (frame * 0.45) % 40;
      ctx.strokeStyle = C.stream; ctx.lineWidth = 2;
      ctx.beginPath(); ctx.moveTo(this.x, this.y - this.h/2); ctx.lineTo(this.x, this.y + this.h/2); ctx.stroke();
      for (let i = -this.h/2; i < this.h/2 + 30; i += 28) {
        const ty = this.y + i - offset;
        if (ty < this.y - this.h/2 + 10 || ty > this.y + this.h/2 - 10) continue;
        const colors = [C.tagInfo, C.tagComm, C.tagNav];
        rr(ctx, this.x - 22, ty - 6, 44, 12, 3, colors[(Math.floor(i/28) + frame) % 3], C.outline);
      }
    }
  }

  class SerpClusterHub {
    constructor(x, y) {
      this.x = x; this.y = y;
      this.phase = 0;
      this.rankY = 40;
      this.pulse = 0;
    }
    draw(ctx) {
      this.phase = (frame * 0.04) % 220;
      ctx.lineJoin = "round";
      ctx.strokeStyle = C.grid;
      for (let gx = -80; gx <= 80; gx += 20) {
        const wave = Math.sin(frame * 0.05 + gx * 0.08) * 3;
        ctx.beginPath(); ctx.moveTo(this.x + gx, this.y - 50 + wave); ctx.lineTo(this.x + gx, this.y + 50 - wave); ctx.stroke();
      }
      rr(ctx, this.x - 70, this.y - 55, 140, 110, 10, C.hub, C.outline);
      const prg = this.phase;
      if (prg < 50) {
        for (let i = 0; i < 4; i++) {
          const a = (frame * 0.03 + i * 1.2);
          const rx = this.x + Math.cos(a) * 35;
          const ry = this.y - 10 + Math.sin(a) * 18;
          rr(ctx, rx - 8, ry - 5, 16, 10, 2, C.tagInfo, null);
        }
      } else if (prg < 120) {
        rr(ctx, this.x - 45, this.y - 35, 90, 70, 6, C.page, C.outline);
        for (let l = 0; l < 4; l++) {
          rr(ctx, this.x - 35, this.y - 25 + l * 14, 55 + (l % 2) * 15, 6, 2, "#94a3b8", null);
        }
        rr(ctx, this.x - 35, this.y - 38, 40, 8, 2, C.tagComm, null);
      } else {
        this.pulse = Math.min(1, (prg - 120) / 30);
        rr(ctx, this.x - 45, this.y - 35, 90, 70, 6, C.page, C.outline);
        ctx.save();
        ctx.globalAlpha = 0.3 + this.pulse * 0.5;
        ctx.fillStyle = C.hubGlow;
        ctx.beginPath(); ctx.arc(this.x, this.y, 55 + this.pulse * 20, 0, Math.PI * 2); ctx.fill();
        ctx.restore();
        this.rankY = 40 - this.pulse * 28;
        ctx.fillStyle = C.rank; ctx.font = "bold 11px Inter,sans-serif";
        ctx.fillText("↑ SERP", this.x - 18, this.y + this.rankY);
      }
    }
  }

  class LinkSpokeRing {
    constructor(x, y, r) { this.x = x; this.y = y; this.r = r; }
    draw(ctx) {
      const prg = (frame * 0.04) % 220;
      if (prg < 100) return;
      const rot = frame * 0.02;
      ctx.strokeStyle = "rgba(139,92,246,0.5)"; ctx.lineWidth = 1.5;
      for (let i = 0; i < 5; i++) {
        const a = rot + (i * Math.PI * 2) / 5;
        const nx = this.x + Math.cos(a) * this.r;
        const ny = this.y + Math.sin(a) * this.r;
        ctx.beginPath(); ctx.moveTo(this.x, this.y); ctx.lineTo(nx, ny); ctx.stroke();
        rr(ctx, nx - 5, ny - 5, 10, 10, 2, C.tagComm, C.outline);
      }
    }
  }

  class RankPulse {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(ctx) {
      const prg = (frame * 0.04) % 220;
      if (prg < 150) return;
      const t = (prg - 150) / 40;
      ctx.strokeStyle = C.rank; ctx.lineWidth = 2;
      ctx.beginPath(); ctx.arc(this.x, this.y, 8 + t * 25, 0, Math.PI * 2); ctx.stroke();
    }
  }

  class Agent {
    constructor(x, y, color, role, targetX, dialogs) {
      this.x = x; this.y = y; this.color = color; this.role = role;
      this.targetX = targetX; this.targetY = y;
      this.dialogs = dialogs; this.timer = Math.random() * 100;
    }
    draw(ctx) {
      this.timer += 0.016;
      const isMoving = Math.abs(this.x - this.targetX) > 2;
      if (isMoving) this.x += (this.targetX - this.x) * 0.04;
      if (Math.abs(this.x - this.targetX) < 8 && frame % 180 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
      }
      const bob = Math.sin(this.timer * 2) * (isMoving ? 1.5 : 2.5);
      ctx.save(); ctx.translate(this.x, this.y); ctx.lineJoin = "round";
      rr(ctx, -12, -6 + bob, 24, 18, 5, this.color, C.outline);
      ctx.fillStyle = this.color;
      ctx.beginPath(); ctx.arc(0, -16 - bob, 9, 0, Math.PI * 2); ctx.fill();
      ctx.lineWidth = 1.5; ctx.strokeStyle = C.outline; ctx.stroke();
      ctx.restore();
    }
  }

  const entities = [];
  const bubbles = [];
  const hub = new SerpClusterHub(0, -10);
  const stream = new QueryStream(-120, 0, 140);
  entities.push(stream, hub, new LinkSpokeRing(0, -10, 52), new RankPulse(0, -10));
  entities.push(new Agent(-140, 50, C.agentYellow, "1_architect", -95, ["Кластеризую Wordstat", "Интент спорный — на SEO", "Карта кластеров готова"]));
  entities.push(new Agent(-60, 70, C.agentGreen, "2_seo", -40, ["LSI не хватает!", "Gap по SERP закрыт", "Meta title утверждён"]));
  entities.push(new Agent(20, 55, C.agentBlue, "3_coder", 55, ["Оркестратор n8n ок", "Агент Writer подключён", "QA-gate настроен"]));
  entities.push(new Agent(80, 65, C.agentPink, "4_designer", 95, ["H2/H3 структура ок", "FAQ-блок добавлен", "Сниппет читаемый"]));
  entities.push(new Agent(130, 45, C.agentPurple, "5_deployer", 115, ["Жду модерацию ВЧ", "Публикация в CMS", "Индекс пошёл!"]));

  function createBubble(x, y, text, life = 240) {
    bubbles.push({ x, y, text, life, maxLife: life });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);
    entities.sort((a, b) => (a.y || 0) - (b.y || 0));
    entities.forEach(e => e.draw(ctx));

    const prg = (frame * 0.04) % 220;
    if (prg >= 12 && prg < 12.05) createBubble(-120, -30, "1. Импорт семантики");
    if (prg >= 48 && prg < 48.05) createBubble(-40, 20, "2. Кластер + интент");
    if (prg >= 88 && prg < 88.05) createBubble(55, 10, "3. Черновик по brief");
    if (prg >= 128 && prg < 128.05) createBubble(95, 30, "4. Перелинковка");
    if (prg >= 168 && prg < 168.05) createBubble(0, -60, "5. Пульс индексации!");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (let i = bubbles.length - 1; i >= 0; i--) {
      const b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      let alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      const tw = ctx.measureText(b.text).width + 14;
      rr(ctx, b.x - tw/2, b.y - 28 - (b.maxLife - b.life) * 0.04, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.fillText(b.text, b.x, b.y - 19 - (b.maxLife - b.life) * 0.04);
      ctx.globalAlpha = 1;
    }
    ctx.restore();
    requestAnimationFrame(engineloop);
  }
  document.fonts.ready.then(engineloop);
});
</script>

<?php
$vseo_page_url = trailingslashit( get_permalink() );
$vseo_site_url  = trailingslashit( home_url( '/' ) );
$vseo_brand     = get_bloginfo( 'name' ) ?: 'Nero Network';
$vseo_schema    = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $vseo_site_url . '#organization',
      'name'  => $vseo_brand,
      'url'   => $vseo_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $vseo_site_url . '#website',
      'url'       => $vseo_site_url,
      'name'      => $vseo_brand,
      'publisher' => [ '@id' => $vseo_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $vseo_page_url . '#webpage',
      'url'         => $vseo_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $vseo_site_url . '#website' ],
      'about'       => [ '@id' => $vseo_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $vseo_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vseo_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vseo_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $vseo_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $vseo_page_url,
      'provider'    => [ '@id' => $vseo_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $vseo_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить ai seo в существующий процесс?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит этапов → пилот 50–100 кластеров → CMS и аналитика → масштабирование после QA.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит ai seo для компании?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир Nero: 100–700 тыс. ₽. Рынок: от 80–300 тыс. ₽ за базовый конвейер.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли внедрить ai seo без программиста?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, при работе под ключ. Nero передаёт пайплайн на Make.com/n8n с WordPress REST.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужна ли интеграция с CRM?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Не обязательна для старта. Полезна для лендингов: amoCRM, Bitrix24 — лиды с меткой кластера.' ] ],
        [ '@type' => 'Question', 'name' => 'Чем AI SEO отличается от GEO?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'GEO — видимость в ответах нейросетей. AI SEO — производство страниц для классической выдачи.' ] ],
        [ '@type' => 'Question', 'name' => 'Google банит AI-тексты?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. Штрафуют scaled content abuse и бесполезный контент.' ] ],
        [ '@type' => 'Question', 'name' => 'ChatGPT не заменяет внедрение?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нужна система: кластеры, ТЗ, QA, CMS, перелинковка, аналитика.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие задачи решает ai seo в первую очередь?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Семантика, контент-план, тексты, мета, перелинковка, обновление — 60–80% времени SEO-команды.' ] ],
        [ '@type' => 'Question', 'name' => 'AI SEO под ключ или самостоятельно?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Самостоятельно — для единичных текстов. Под ключ — от сотен кластеров с интеграциями.' ] ],
        [ '@type' => 'Question', 'name' => 'Есть ли ai seo для ниши YMYL?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, с усиленным human-in-the-loop: 100% модерация, factcheck, юридическая вычитка.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vseo_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

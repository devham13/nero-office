<?php
/**
 * Template Name: AI-аудит бизнес-процессов: найдём, где автоматизация принесёт деньги
 * Description: SEO-лендинг — AI-аудит бизнес-процессов. Бесплатная карта AI-возможностей. Gartner 2026.
 * Slug: ai-audit-biznes-protsessov
 */

declare(strict_types=1);

// ── SEO ──────────────────────────────────────────────────────────────────────
$page_seo_title       = 'AI-аудит бизнес-процессов — заказать для компании под ключ';
$page_seo_description = 'Проведём AI-аудит бизнес-процессов для вашей компании. Покажем, какие процессы автоматизировать первыми и какой ROI ожидать. Бесплатная карта AI-возможностей.';

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

// ── CTA helpers ──────────────────────────────────────────────────────────────
$brand             = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить карту AI-возможностей';
$primary_cta_url   = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);

$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Курс по AI-автоматизации';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#metodologiya';

// Alias function so hero/Boris fragments can call nero_ai_primary_cta_label()
if (!function_exists('nero_ai_primary_cta_label')) {
    function nero_ai_primary_cta_label(): string
    {
        return getenv('PRIMARY_CTA_LABEL') ?: 'Получить карту AI-возможностей';
    }
}

// ── Header nav — якоря к секциям страницы ────────────────────────────────────
$nero_ai_header_links = [
    ['label' => 'Проблема',    'href' => '#problema'],
    ['label' => 'Методология', 'href' => '#metodologiya'],
    ['label' => 'Кейсы',       'href' => '#kejsy'],
    ['label' => 'Стоимость',   'href' => '#stoimost'],
    ['label' => 'FAQ',         'href' => '#faq'],
];

// ── Bootstrap (тема → fallback shared/) ──────────────────────────────────────
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
/* ── Скрыть шапку Kadence, использовать nero-ai-floating-header ─────────── */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }

.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs,
.yoast-breadcrumb, .entry-header, .page-title-section { display: none !important; }

#primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}

/* ══════════════════════════════════════════════════════════════
   PAGE WRAPPER — ai-audit-biznes-protsessov-page
   CSS-переменные страницы, базовые типографика и ритм
══════════════════════════════════════════════════════════════ */
.ai-audit-biznes-protsessov-page {
  --naad-bg: #0a1a2e;
  --naad-bg2: #0f2035;
  --naad-bg3: #071524;
  --naad-surface: rgba(255,255,255,.06);
  --naad-surface2: rgba(255,255,255,.10);
  --naad-text: #f1f5f9;
  --naad-muted: rgba(241,245,249,.72);
  --naad-soft: rgba(241,245,249,.55);
  --naad-heading: #f1f5f9;
  --naad-border: rgba(79,163,224,.15);
  --naad-border-s: rgba(79,163,224,.28);
  --naad-accent: #4fa3e0;
  --naad-green: #10b981;
  --naad-red: #ef4444;
  --naad-orange: #fb923c;
  --naad-r: 14px;
  --naad-r-lg: 20px;
  --naad-container: 1200px;
  background: linear-gradient(180deg, #0a1a2e 0%, #0f2035 50%, #0a1a2e 100%);
  color: var(--naad-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  overflow-x: hidden;
}
.ai-audit-biznes-protsessov-page *,
.ai-audit-biznes-protsessov-page *::before,
.ai-audit-biznes-protsessov-page *::after { box-sizing: border-box; }
.ai-audit-biznes-protsessov-page a { color: inherit; text-decoration: none; }
.ai-audit-biznes-protsessov-page p {
  color: var(--naad-muted);
  line-height: 1.72;
  margin: 0 0 1em;
}
.ai-audit-biznes-protsessov-page p:last-child { margin-bottom: 0; }
.ai-audit-biznes-protsessov-page h2 {
  font-size: clamp(22px, 2.4vw, 34px);
  font-weight: 800;
  color: var(--naad-heading);
  letter-spacing: -.04em;
  margin: 0 0 .7em;
  line-height: 1.2;
}
.ai-audit-biznes-protsessov-page h3 {
  font-size: clamp(17px, 1.7vw, 24px);
  font-weight: 700;
  color: var(--naad-heading);
  letter-spacing: -.025em;
  margin: 1.6em 0 .55em;
  line-height: 1.3;
}
.ai-audit-biznes-protsessov-page strong { color: #fff; }
.ai-audit-biznes-protsessov-page ul {
  padding-left: 0;
  list-style: none;
  margin: 0 0 1em;
}
.ai-audit-biznes-protsessov-page ul li {
  padding-left: 22px;
  position: relative;
  margin-bottom: .5em;
  color: var(--naad-muted);
  font-size: 15px;
  line-height: 1.65;
}
.ai-audit-biznes-protsessov-page ul li::before {
  content: '▸';
  position: absolute;
  left: 0;
  color: var(--naad-accent);
  font-size: 11px;
  top: 4px;
}
.ai-audit-biznes-protsessov-page ol {
  padding-left: 0;
  list-style: none;
  counter-reset: naad-ol;
  margin: 0 0 1em;
}
.ai-audit-biznes-protsessov-page ol li {
  counter-increment: naad-ol;
  padding-left: 34px;
  position: relative;
  margin-bottom: .6em;
  color: var(--naad-muted);
  font-size: 15px;
  line-height: 1.65;
}
.ai-audit-biznes-protsessov-page ol li::before {
  content: counter(naad-ol);
  position: absolute;
  left: 0;
  top: 1px;
  width: 22px;
  height: 22px;
  background: rgba(79,163,224,.18);
  color: var(--naad-accent);
  border-radius: 50%;
  font-size: 11px;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  line-height: 1;
}
.ai-audit-biznes-protsessov-page blockquote {
  border-left: 3px solid var(--naad-accent);
  padding: 14px 20px;
  margin: 24px 0;
  background: rgba(79,163,224,.06);
  border-radius: 0 8px 8px 0;
}
.ai-audit-biznes-protsessov-page blockquote p {
  color: rgba(241,245,249,.8);
  font-style: italic;
}

/* ── Container / Section ── */
.ym-container {
  max-width: var(--naad-container);
  margin: 0 auto;
  padding: 0 clamp(16px, 4vw, 60px);
}
.nero-ai-section {
  padding: clamp(48px, 7vh, 88px) 0;
}
.nero-ai-section:nth-child(even) {
  background: rgba(15,32,53,.45);
}

/* ══════════════════════════════════════════════════════════════
   HERO CSS (от Алины)
   id: ai-audit-hero | canvas: ai-audit-dispatch-canvas
══════════════════════════════════════════════════════════════ */
#ai-audit-hero.naad-hero {
  position: relative;
  min-height: 100vh;
  min-height: 100dvh;
  background: linear-gradient(135deg, #0a1a2e 0%, #0f2035 60%, #0a1520 100%);
  display: flex;
  flex-direction: column;
  justify-content: center;
  overflow: hidden;
  padding: clamp(80px, 10vh, 120px) clamp(20px, 5vw, 80px) clamp(40px, 6vh, 80px);
  box-sizing: border-box;
}
#ai-audit-hero.naad-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(79,163,224,0.05) 1px, transparent 1px),
    linear-gradient(90deg, rgba(79,163,224,0.05) 1px, transparent 1px);
  background-size: 60px 60px;
  pointer-events: none;
}
#ai-audit-hero.naad-hero::after {
  content: '';
  position: absolute;
  top: 25%; right: 15%;
  width: 580px; height: 580px;
  background: radial-gradient(circle, rgba(79,163,224,0.07) 0%, transparent 70%);
  pointer-events: none;
}
.naad-hero__inner {
  position: relative;
  z-index: 2;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: center;
  max-width: 1280px;
  margin: 0 auto;
  width: 100%;
}
.naad-hero__text { display: flex; flex-direction: column; gap: 24px; }
.naad-hero__badges { display: flex; flex-wrap: wrap; gap: 8px; }
.naad-badge {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 6px 14px;
  border: 1px solid rgba(79,163,224,0.3);
  border-radius: 999px;
  font-size: 12px; font-weight: 600;
  color: #4fa3e0;
  background: rgba(79,163,224,0.08);
  letter-spacing: .03em;
}
.naad-badge--danger {
  color: #ef4444;
  border-color: rgba(239,68,68,0.3);
  background: rgba(239,68,68,0.08);
}
.naad-hero__h1 {
  font-size: clamp(28px, 3.2vw, 54px);
  font-weight: 900; line-height: 1.1;
  letter-spacing: -1.5px; color: #f1f5f9; margin: 0;
}
.naad-hero__h1 .naad-h1-accent {
  display: block;
  background: linear-gradient(90deg, #4fa3e0 0%, #10b981 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  background-clip: text;
}
.naad-hero__sub {
  font-size: clamp(15px, 1.5vw, 19px); line-height: 1.65;
  color: rgba(241,245,249,0.72); margin: 0; max-width: 560px;
}
.naad-hero__cta { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; }
.naad-btn {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 14px 28px; border-radius: 10px;
  font-weight: 700; font-size: 15px; text-decoration: none;
  transition: transform .2s, box-shadow .2s;
  cursor: pointer; border: none; line-height: 1;
}
.naad-btn:hover { transform: translateY(-2px); }
.naad-btn--primary {
  background: linear-gradient(135deg, #4fa3e0, #2563eb);
  color: #fff !important;
  box-shadow: 0 4px 16px rgba(79,163,224,0.35);
}
.naad-btn--primary:hover { box-shadow: 0 8px 28px rgba(79,163,224,0.5); }
.naad-btn--secondary {
  background: transparent;
  border: 1px solid rgba(79,163,224,0.4);
  color: #4fa3e0 !important;
}
.naad-btn--secondary:hover {
  border-color: rgba(79,163,224,0.7);
  background: rgba(79,163,224,0.06);
}
.naad-hero__trust { display: flex; flex-wrap: wrap; gap: 8px 20px; align-items: center; }
.naad-trust-item {
  font-size: 12px; color: rgba(241,245,249,0.5);
  display: flex; align-items: center; gap: 5px;
}
.naad-trust-item::before { content: '✓'; color: #10b981; font-weight: 800; }
.naad-hero__visual { display: flex; flex-direction: column; gap: 14px; }
.naad-canvas-wrap {
  position: relative; width: 100%;
  height: clamp(260px, 34vh, 400px);
  background: rgba(15,32,53,0.55);
  border: 1px solid rgba(79,163,224,0.18);
  border-radius: 16px; overflow: hidden;
}
#ai-audit-dispatch-canvas { position: absolute; inset: 0; width: 100%; height: 100%; }
.naad-stat-cards { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; }
.naad-stat-card {
  background: rgba(15,32,53,0.82);
  border: 1px solid rgba(79,163,224,0.18);
  border-radius: 12px; padding: 16px 14px;
  text-align: center;
  backdrop-filter: blur(8px);
  transition: border-color .25s, transform .2s;
}
.naad-stat-card:hover { border-color: rgba(79,163,224,0.45); transform: translateY(-2px); }
.naad-stat-num { font-size: clamp(22px,2.4vw,30px); font-weight: 900; line-height: 1; margin-bottom: 6px; }
.naad-stat-card--risk .naad-stat-num { color: #ef4444; }
.naad-stat-card--warn .naad-stat-num { color: #fb923c; }
.naad-stat-card--pos .naad-stat-num {
  background: linear-gradient(135deg, #10b981, #4fa3e0);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  background-clip: text;
}
.naad-stat-text { font-size: 11px; color: rgba(241,245,249,.68); line-height: 1.45; margin-bottom: 5px; }
.naad-stat-src  { font-size: 10px; color: rgba(241,245,249,.32); font-style: italic; }
.naad-stages {
  position: relative; z-index: 2;
  display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;
  margin-top: clamp(24px, 4vh, 44px);
}
.naad-stage {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 10px 20px;
  background: rgba(15,32,53,0.72);
  border: 1px solid rgba(79,163,224,0.2);
  border-radius: 999px;
  font-size: 13px; font-weight: 600;
  color: rgba(241,245,249,0.75);
  backdrop-filter: blur(6px);
}
.naad-stage-num {
  display: inline-flex; align-items: center; justify-content: center;
  width: 22px; height: 22px;
  background: rgba(79,163,224,0.2); color: #4fa3e0;
  border-radius: 50%; font-size: 11px; font-weight: 800; flex-shrink: 0;
}
@media (max-width: 900px) {
  .naad-hero__inner { grid-template-columns: 1fr; gap: 28px; }
  .naad-hero__visual { order: -1; }
  .naad-canvas-wrap { height: 230px; }
}
@media (max-width: 600px) {
  .naad-stat-cards { grid-template-columns: 1fr; gap: 8px; }
  .naad-stat-card { display: flex; align-items: center; text-align: left; gap: 14px; padding: 12px 16px; }
  .naad-stat-num { font-size: 28px; flex-shrink: 0; margin-bottom: 0; }
  .naad-stages { gap: 8px; }
  .naad-stage { font-size: 12px; padding: 8px 14px; }
}

/* ══════════════════════════════════════════════════════════════
   INTRO BLOCK — второй блок после hero
   Паттерн: левый текст + правый визуальный якорь (KPI)
   + градиентная полоса слева у текста + ниже TOC
══════════════════════════════════════════════════════════════ */
.naad-intro { padding: clamp(48px, 7vh, 72px) 0 clamp(24px, 3vh, 40px); }
.naad-intro__grid {
  display: grid;
  grid-template-columns: 1fr 360px;
  gap: 48px;
  align-items: start;
}
.naad-intro__text {
  position: relative;
  padding-left: 20px;
  text-align: left !important;
}
.naad-intro__text::before {
  content: '';
  position: absolute;
  left: 0; top: 0; bottom: 0;
  width: 3px;
  background: linear-gradient(180deg, #4fa3e0 0%, #10b981 100%);
  border-radius: 3px;
}
.naad-intro__lead {
  font-size: clamp(16px, 1.6vw, 20px);
  line-height: 1.7;
  color: rgba(241,245,249,.85) !important;
  text-align: left !important;
  margin: 0 0 16px;
}
.naad-intro__sub {
  font-size: 14px;
  color: rgba(241,245,249,.55);
  line-height: 1.65;
  text-align: left !important;
  margin: 0;
}
.naad-intro__visual {
  background: rgba(15,32,53,.65);
  border: 1px solid rgba(79,163,224,.2);
  border-radius: 16px;
  padding: 24px 22px;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.naad-kpi-eyebrow {
  font-size: 10px; font-weight: 700;
  letter-spacing: .1em; text-transform: uppercase;
  color: var(--naad-accent); margin: 0;
}
.naad-kpi-row {
  display: flex; align-items: center; gap: 14px;
  padding: 10px 0;
  border-bottom: 1px solid rgba(255,255,255,.07);
}
.naad-kpi-row:last-child { border-bottom: none; }
.naad-kpi-num {
  font-size: 26px; font-weight: 900;
  min-width: 60px; flex-shrink: 0; line-height: 1;
}
.naad-kpi-num--red   { color: #ef4444; }
.naad-kpi-num--blue  {
  background: linear-gradient(135deg, #4fa3e0, #2563eb);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  background-clip: text;
}
.naad-kpi-num--green {
  background: linear-gradient(135deg, #10b981, #4fa3e0);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  background-clip: text;
}
.naad-kpi-label  { font-size: 12px; color: rgba(241,245,249,.62); line-height: 1.45; }
.naad-kpi-source { font-size: 10px; color: rgba(241,245,249,.28); font-style: italic; margin-top: 3px; }
@media (max-width: 900px) {
  .naad-intro__grid { grid-template-columns: 1fr; }
  .naad-intro__visual { order: -1; }
}

/* ── TOC ────────────────────────────────────────────────── */
.ym-toc {
  margin: clamp(32px, 5vh, 48px) auto 0;
  max-width: 860px;
  padding: 0 clamp(16px, 4vw, 60px);
}
.ym-toc__label {
  font-size: 11px; font-weight: 700;
  letter-spacing: .1em; text-transform: uppercase;
  color: var(--naad-accent); margin: 0 0 12px;
}
.ym-toc__list { display: flex; flex-wrap: wrap; gap: 8px; list-style: none; padding: 0; margin: 0; }
.ym-toc__item a {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 7px 14px;
  border: 1px solid rgba(79,163,224,.22);
  border-radius: 999px;
  font-size: 13px; font-weight: 500;
  color: rgba(241,245,249,.7);
  background: rgba(79,163,224,.06);
  transition: border-color .2s, color .2s;
}
.ym-toc__item a:hover { border-color: rgba(79,163,224,.5); color: #4fa3e0; }

/* ══════════════════════════════════════════════════════════════
   BORIS BLOCK CSS
   id: boris-article-viz | canvas: ai-audit-matrix-canvas
══════════════════════════════════════════════════════════════ */
#boris-article-viz { padding: 16px 0 48px; }
.boris-card {
  background: #fff;
  border-radius: 24px;
  box-shadow: 0 6px 32px rgba(15,23,42,.11), 0 1px 4px rgba(15,23,42,.06);
  border: 1px solid #e2e8f0;
  overflow: hidden;
  display: grid;
  grid-template-columns: 2fr 3fr;
  min-height: 460px;
}
@media (max-width: 1023px) { .boris-card { grid-template-columns: 1fr; } }
.boris-text {
  padding: 40px 32px 40px 40px;
  display: flex; flex-direction: column; justify-content: center; gap: 0;
}
.boris-eyebrow {
  font-size: 11px; font-weight: 700;
  letter-spacing: .12em; text-transform: uppercase;
  color: #2563eb; margin: 0 0 14px;
}
.boris-h3 {
  font-size: clamp(19px, 1.9vw, 26px);
  font-weight: 800; color: #0f172a;
  line-height: 1.3; margin: 0 0 14px;
}
.boris-lead { font-size: 14px; color: #475569; line-height: 1.65; margin: 0 0 22px; }
.boris-legend { display: flex; flex-direction: column; gap: 9px; margin-bottom: 24px; }
.boris-legend-row {
  display: flex; align-items: center; gap: 9px;
  font-size: 13px; color: #334155; line-height: 1.4;
}
.boris-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
.boris-dot--qw   { background: #22c55e; }
.boris-dot--st   { background: #3b82f6; }
.boris-dot--low  { background: #f59e0b; }
.boris-dot--skip { background: #94a3b8; }
.boris-pills { display: flex; gap: 8px; flex-wrap: wrap; }
.boris-pill {
  font-size: 11px; font-weight: 600;
  padding: 4px 11px; border-radius: 20px;
  background: #f1f5f9; color: #64748b;
}
.boris-pill--blue { background: #dbeafe; color: #1d4ed8; }
.boris-canvas-wrap {
  background: #f8fafc;
  border-left: 1px solid #e2e8f0;
  position: relative;
  min-height: 420px;
}
@media (max-width: 1023px) {
  .boris-canvas-wrap { border-left: none; border-top: 1px solid #e2e8f0; min-height: 340px; }
  .boris-text { padding: 28px 24px; }
}
#ai-audit-matrix-canvas {
  display: block; position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
}

/* ── Reveal animation ─────────────────────────────────── */
.reveal {
  opacity: 0;
  transform: translateY(24px);
  transition: opacity .65s ease, transform .65s ease;
}
.reveal.visible { opacity: 1; transform: none; }
.delay-1 { transition-delay: .1s; }
.delay-2 { transition-delay: .2s; }
.delay-3 { transition-delay: .3s; }
.delay-4 { transition-delay: .4s; }
</style>

<main id="primary" class="site-main ai-audit-biznes-protsessov-page" role="main" tabindex="-1">

<!-- ═══════════════════════════════════════════════════════════════
     HERO — Алина
     canvas: ai-audit-dispatch-canvas | script: ai-audit-dispatch-engine
     Не изменять id canvas и структуру hero.
════════════════════════════════════════════════════════════════ -->
<section id="ai-audit-hero" class="naad-hero">

<div class="naad-hero__inner">
  <!-- LEFT: TEXT CONTENT -->
  <div class="naad-hero__text">
    <div class="naad-hero__badges">
      <span class="naad-badge naad-badge--danger">⚠ Gartner: 40% внедрений AI провалятся</span>
      <span class="naad-badge">Бесплатная карта AI-возможностей</span>
    </div>

    <h1 class="naad-hero__h1">
      AI-аудит бизнес-процессов:
      <span class="naad-h1-accent">найдём, где автоматизация принесёт деньги</span>
    </h1>

    <p class="naad-hero__sub">
      Покажем, какие процессы автоматизировать первыми — бесплатная карта AI-возможностей для вашей компании
    </p>

    <div class="naad-hero__cta">
      <a href="<?php echo esc_url( nero_ai_primary_cta_url() ); ?>"
         class="naad-btn naad-btn--primary"
         target="_blank" rel="noopener noreferrer">
        <?php echo esc_html( nero_ai_primary_cta_label() ); ?>
      </a>
      <a href="#metodologiya" class="naad-btn naad-btn--secondary">
        Посмотреть методологию
      </a>
    </div>

    <div class="naad-hero__trust">
      <span class="naad-trust-item">Результат через 2–4 недели</span>
      <span class="naad-trust-item">ROI-расчёт по каждому процессу</span>
      <span class="naad-trust-item">Честно скажем, если AI не нужен</span>
    </div>
  </div>

  <!-- RIGHT: VISUAL — canvas + stat cards -->
  <div class="naad-hero__visual">
    <div class="naad-canvas-wrap">
      <canvas id="ai-audit-dispatch-canvas"></canvas>
    </div>

    <div class="naad-stat-cards">
      <div class="naad-stat-card naad-stat-card--risk">
        <div class="naad-stat-num">40%</div>
        <div class="naad-stat-text">компаний провалят AI-агентов из-за отсутствия аудита</div>
        <div class="naad-stat-src">Gartner, 2026</div>
      </div>
      <div class="naad-stat-card naad-stat-card--warn">
        <div class="naad-stat-num">74%</div>
        <div class="naad-stat-text">уже откатили AI-агентов после запуска</div>
        <div class="naad-stat-src">Sinch, 2026</div>
      </div>
      <div class="naad-stat-card naad-stat-card--pos">
        <div class="naad-stat-num">3–5×</div>
        <div class="naad-stat-text">выше результат у компаний с предварительным аудитом</div>
        <div class="naad-stat-src">BCG</div>
      </div>
    </div>
  </div>
</div>

<!-- AUDIT STAGE PILLS -->
<div class="naad-stages">
  <div class="naad-stage"><span class="naad-stage-num">1</span> Диагностика процессов</div>
  <div class="naad-stage"><span class="naad-stage-num">2</span> Анализ потерь в рублях</div>
  <div class="naad-stage"><span class="naad-stage-num">3</span> Приоритизация Quick Wins</div>
  <div class="naad-stage"><span class="naad-stage-num">4</span> Карта AI-возможностей</div>
</div>

</section>

<!-- ═══════════════════════════════════════════════════════════════
     INTRO BLOCK — второй блок (сразу после hero)
     Паттерн: левый текст + правый KPI-блок + градиент-бар слева
     TOC — ниже по центру
════════════════════════════════════════════════════════════════ -->
<div class="naad-intro">
  <div class="ym-container">
    <div class="naad-intro__grid reveal">

      <div class="naad-intro__text">
        <p class="naad-intro__lead">Вы думаете о внедрении AI в бизнес. Перед вами — десятки инструментов, интеграторов, агентов и обещаний «сократить затраты на 30%». И один вопрос, который не даёт покоя: <strong>где конкретно AI принесёт деньги, а где просто съест бюджет?</strong></p>
        <p class="naad-intro__sub">AI-аудит бизнес-процессов — это ответ до того, как вы потратите рубль на внедрение. Покажем, какие процессы автоматизировать первыми и какой ROI ожидать — с конкретными числами, без маркетинговых обещаний.</p>
      </div>

      <div class="naad-intro__visual">
        <p class="naad-kpi-eyebrow">Данные рынка 2026</p>
        <div class="naad-kpi-row">
          <div><div class="naad-kpi-num naad-kpi-num--red">40%</div></div>
          <div>
            <div class="naad-kpi-label">предприятий откажутся от AI-агентов из-за ошибок без аудита</div>
            <div class="naad-kpi-source">Gartner, май 2026</div>
          </div>
        </div>
        <div class="naad-kpi-row">
          <div><div class="naad-kpi-num naad-kpi-num--blue">74%</div></div>
          <div>
            <div class="naad-kpi-label">компаний уже откатили AI-агентов после запуска в production</div>
            <div class="naad-kpi-source">Sinch, 2026</div>
          </div>
        </div>
        <div class="naad-kpi-row">
          <div><div class="naad-kpi-num naad-kpi-num--green">3–5×</div></div>
          <div>
            <div class="naad-kpi-label">выше результат у компаний, начавших с аудита процессов</div>
            <div class="naad-kpi-source">BCG AI Report</div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <nav class="ym-toc" aria-label="Содержание статьи">
    <p class="ym-toc__label">Содержание</p>
    <ul class="ym-toc__list">
      <li class="ym-toc__item"><a href="#problema">Почему провалят AI</a></li>
      <li class="ym-toc__item"><a href="#chto-takoe">Что такое AI-аудит</a></li>
      <li class="ym-toc__item"><a href="#kak-vybrat">Как выбрать процессы</a></li>
      <li class="ym-toc__item"><a href="#metodologiya">Методология</a></li>
      <li class="ym-toc__item"><a href="#kejsy">Кейсы</a></li>
      <li class="ym-toc__item"><a href="#stoimost">Стоимость</a></li>
      <li class="ym-toc__item"><a href="#integracii">Интеграции</a></li>
      <li class="ym-toc__item"><a href="#faq">FAQ</a></li>
    </ul>
  </nav>
</div>

<!-- ═══════════════════════════════════════════════════════════════
     #problema — Почему 40% компаний провалили внедрение AI
════════════════════════════════════════════════════════════════ -->
<section id="problema" class="nero-ai-section">
  <div class="ym-container">

    <h2 class="reveal">Почему 40% компаний провалили внедрение AI</h2>

    <p>Рынок искусственного интеллекта в России вырос до <strong>257&nbsp;млрд рублей в 2025 году</strong> (данные Правительства РФ) — на 54&nbsp;млрд больше, чем в 2024-м. 65% российских компаний увеличили ИТ-бюджеты в 2026 году, и AI стал главным направлением инвестиций (CNews, июнь 2026). Компании вкладывают. Но далеко не все получают отдачу.</p>
    <p>Gartner и Sinch в 2026 году опубликовали данные, которые описывают реальную картину честнее, чем любые маркетинговые материалы.</p>

    <h3>Что говорит Gartner о неудачах с AI-агентами в 2026 году</h3>

    <p>По прогнозу Gartner (май 2026), к 2027 году <strong>40% предприятий демонтируют или понизят статус автономных AI-агентов</strong> — из-за пробелов в управлении, обнаруженных только после производственных инцидентов. Shiva Varma, Senior Director Analyst at Gartner, объясняет первопричину:</p>
    <blockquote><p>«Предприятия рассматривают управление AI-агентами как бинарное — либо полностью заблокировано, либо полностью доверено. Это и есть первопричина сбоёв».</p></blockquote>
    <p>Компании запускают AI без предварительного понимания, что именно им нужно и как это должно работать. Результат — провал уже после запуска, когда деньги потрачены.</p>
    <p>Исследование Sinch (опрос 2&nbsp;527 руководителей в 10 странах, май 2026): <strong>74% предприятий уже отключили или откатили живого AI-агента</strong> в коммуникациях. Топ-причины: утечка персональных данных (31%), галлюцинации и репутационный риск (22%), невозможность отследить, что пошло не так (16%).</p>
    <p>McKinsey («The State of AI 2025»): <strong>88% организаций используют AI хотя бы в одной функции</strong>, но только <strong>39% сообщают о влиянии AI на EBIT</strong>. Большинство «просто добавили AI сверху», не меняя логику работы.</p>

    <h3>Три типичные ошибки при запуске AI без предварительного аудита</h3>

    <p><strong>Ошибка 1: внедрять там, где «красиво», а не там, где «больно».</strong><br>
    Компания запускает голосового робота — потому что это эффектно. Но реальная боль — потеря заявок на этапе обработки документов. Робот работает. Заявки теряются. ROI&nbsp;=&nbsp;0.</p>

    <p><strong>Ошибка 2: автоматизировать хаос вместо порядка.</strong><br>
    Если процесс сломан — AI его не починит. AI его ускорит. Автоматизированный хаотичный процесс выдаёт ошибки быстрее и масштабнее. Именно это становится причиной «галлюцинаций» и репутационных инцидентов, о которых говорит Sinch.</p>

    <p><strong>Ошибка 3: Shadow AI без инвентаризации.</strong><br>
    Shadow AI — несанкционированные AI-инструменты, которые сотрудники используют самостоятельно, — увеличивает стоимость утечки данных в среднем на <strong>670&nbsp;000 долларов</strong> по сравнению с нормой (IBM Cost of Data Breach 2025, CSA 2026). Без предварительного аудита вы не знаете, какие AI-инструменты уже работают внутри компании.</p>

  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     #chto-takoe — Что такое AI-аудит бизнес-процессов
════════════════════════════════════════════════════════════════ -->
<section id="chto-takoe" class="nero-ai-section">
  <div class="ym-container">

    <h2 class="reveal">Что такое AI-аудит бизнес-процессов</h2>

    <p><strong>Определение:</strong> AI-аудит бизнес-процессов — это структурированная диагностика операционной модели компании с целью найти конкретные точки, где внедрение искусственного интеллекта даст измеримый экономический эффект.</p>
    <p>Это не технологическая оценка AI-сервисов. Это не стратегическая презентация с абстрактными прогнозами. Это пошаговый разбор: кто что делает, сколько это стоит в рублях, где теряются заявки и деньги, и что именно выгодно автоматизировать в первую очередь.</p>
    <p>Для бизнеса — это инструмент принятия управленческого решения <strong>до</strong> того, как деньги потрачены на разработку. Аудит отвечает на главный вопрос собственника: «Где AI принесёт деньги, а где просто увеличит затраты?»</p>

    <h3>Этапы аудита: от диагностики до карты AI-возможностей</h3>

    <p>Типичный AI-аудит бизнес-процессов включает пять последовательных шагов:</p>
    <ol>
      <li><strong>Картирование процессов</strong> — фиксируем, как реально работает компания (не «по регламенту», а «как есть»). Интервью с сотрудниками, изучение CRM, телефонии, документов, таблиц.</li>
      <li><strong>Оценка в рублях</strong> — каждому процессу присваивается «цена»: сколько людей, сколько часов, сколько стоит ошибка. Переводит абстрактные «неэффективности» в конкретные потери.</li>
      <li><strong>Поиск узких мест</strong> — где процесс тормозит, дублируется, теряет данные? Зоны наибольшего потенциала для автоматизации.</li>
      <li><strong>Генерация гипотез</strong> — какой AI-инструмент решит конкретную проблему? Для каждой гипотезы — стоимость внедрения и ожидаемый ROI.</li>
      <li><strong>Приоритизация и «Карта AI-возможностей»</strong> — итоговый документ с ранжированным списком: Quick Wins (0–3 месяца), среднесрочные (3–6 месяцев), стратегические (6–12 месяцев), пропустить.</li>
    </ol>
    <p>Срок проведения — 2–4 недели. Именно столько нужно, чтобы получить честный результат, а не красивую презентацию.</p>

    <h3>Кому нужен AI-аудит и когда начинать</h3>

    <p>AI-аудит бизнес-процессов нужен компании, которая:</p>
    <ul>
      <li>думает о внедрении AI, но не знает, с чего начать;</li>
      <li>уже пробовала AI и не получила ощутимого результата;</li>
      <li>получила смету от разработчика на 1–5&nbsp;млн рублей и хочет понять, на что именно;</li>
      <li>видит, что конкуренты автоматизируются быстрее;</li>
      <li>теряет заявки или тратит деньги на ручные операции, которые «можно было бы автоматизировать».</li>
    </ul>
    <p>Начинать — до того, как заключён любой контракт на разработку. Иначе вы рискуете оказаться в числе тех 40%, о которых предупреждает Gartner.</p>
    <p>Если ваша компания уже реализовала AI-проект и он не дал результата — аудит поможет найти реальную причину и понять, что делать дальше.</p>

    <!-- CTA 1 — Артур: карточка CTA в теле лонгрида -->
    <div class="nero-ai-cta-block nero-ai-cta-block--card" style="background:var(--ym-gradient-primary,linear-gradient(135deg,#1e3a5f 0%,#0d1f3c 100%));border-radius:16px;padding:32px 40px;margin:40px 0;text-align:center;">
      <p style="font-size:13px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:var(--ym-accent,#4fa3e0);margin:0 0 12px;">Бесплатно для вашей компании</p>
      <h3 style="font-size:clamp(20px,2.5vw,28px);font-weight:700;color:#fff;margin:0 0 12px;line-height:1.3;">Получите бесплатную карту AI-возможностей</h3>
      <p style="color:rgba(255,255,255,.75);font-size:16px;margin:0 auto 24px;max-width:520px;">Разберём 3–5 ваших процессов и покажем, где автоматизация реально окупится — до того, как вы потратите бюджет.</p>
      <a href="<?php echo esc_url( nero_ai_primary_cta_url() ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer" style="display:inline-block;padding:14px 32px;background:var(--ym-accent,#4fa3e0);color:#fff;font-weight:700;font-size:16px;border-radius:8px;text-decoration:none;"><?php echo esc_html( nero_ai_primary_cta_label() ); ?></a>
    </div>

  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     #kak-vybrat — Как выбрать правильные процессы
════════════════════════════════════════════════════════════════ -->
<section id="kak-vybrat" class="nero-ai-section">
  <div class="ym-container">

    <h2 class="reveal">Как выбрать правильные процессы для автоматизации</h2>

    <p>Не все бизнес-процессы одинаково выгодно автоматизировать. Многие компании делают ставку на то, что «выглядит AI-шно» — чат-боты, голосовые роботы, умные ассистенты. Но реальные деньги часто лежат там, где скучнее: обработка документов, заполнение CRM, сортировка обращений.</p>
    <p>Правило для выбора: <strong>не автоматизируй ради автоматизации — ищи максимальный ROI при минимальных затратах на внедрение</strong>.</p>

    <h3>Матрица приоритизации: ROI vs сложность внедрения</h3>

    <p>Профессиональная методология оценки — двухосная матрица: <strong>Impact</strong> (влияние на деньги или время) × <strong>Feasibility</strong> (насколько просто внедрить). Каждому процессу присваивается оценка по обеим осям.</p>

    <p>Практика показывает: наибольший ROI при минимальных затратах даёт автоматизация там, где высок объём однотипных операций. <a href="/ai-1c-erp/">Интеграция AI с 1С и ERP</a> — один из самых предсказуемых Quick Wins: обработка документов ускоряется в 20–30 раз, ручной ввод практически уходит. Параллельно аудит оценивает <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-маршрутизацию входящей почты и заявок в CRM</a>: время реакции на обращение снижается с часов до секунд.</p>

    <p>Для компаний с активными продажами отдельно анализируется <a href="/vnedrenie-ai-amocrm/">автоматизация воронки в amoCRM с помощью AI-агента</a> — квалификация лидов, заполнение карточек, сопровождение сделок без участия менеджера. Крупный бизнес подтверждает тренд: <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">опыт KPMG по внедрению AI для 276 000 сотрудников</a> показывает, как системный подход к выбору процессов кардинально меняет итоговый результат.</p>

    <div style="overflow-x:auto;margin:24px 0;">
      <table style="width:100%;border-collapse:collapse;font-size:15px;">
        <thead>
          <tr style="background:rgba(255,255,255,.06);">
            <th style="padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.12);color:#fff;">Категория</th>
            <th style="padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.12);color:#fff;">Impact</th>
            <th style="padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.12);color:#fff;">Feasibility</th>
            <th style="padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.12);color:#fff;">Срок</th>
            <th style="padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.12);color:#fff;">Пример</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:#22c55e;font-weight:700;">✓ Quick Win</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">Высокий</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">Высокая</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">0–3 мес.</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">Автозаполнение CRM из звонков</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:#3b82f6;font-weight:700;">★ Стратегический</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">Высокий</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">Сложная</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">6–12 мес.</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">Предиктивная аналитика спроса</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:#f59e0b;font-weight:700;">↓ Низкий приоритет</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">Низкий</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">Высокая</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">На потом</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.8);">Автоответы на FAQ-запросы</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;color:#94a3b8;font-weight:700;">✕ Пропустить</td>
            <td style="padding:12px 16px;color:rgba(255,255,255,.8);">Низкий</td>
            <td style="padding:12px 16px;color:rgba(255,255,255,.8);">Сложная</td>
            <td style="padding:12px 16px;color:rgba(255,255,255,.8);">—</td>
            <td style="padding:12px 16px;color:rgba(255,255,255,.8);">Роботизация редкого ручного процесса</td>
          </tr>
        </tbody>
      </table>
    </div>

    <p>Лучшая стратегия начала AI-трансформации — найти максимальное количество Quick Wins и реализовать их за первые 1–3 месяца. Это создаёт видимый результат, формирует доверие команды к AI и финансирует следующие этапы из сэкономленных средств.</p>
    <p>Digital Colliers (Нидерланды): «AI-аудит — это наивысшая ROI-активность, которую компания может сделать до того, как вложит хоть один евро в внедрение. И именно этот шаг большинство компаний пропускает полностью».</p>

    <h3>Примеры процессов с высоким потенциалом отдачи</h3>

    <ul>
      <li><strong>Транскрипция и анализ звонков.</strong> Автоматическая запись, расшифровка, классификация по категориям. Экономит 5–15 часов работы в неделю в отделе продаж или поддержки.</li>
      <li><strong>Автозаполнение CRM из звонков и переписки.</strong> Данные из разговоров автоматически попадают в карточку сделки. Потери данных снижаются до нуля.</li>
      <li><strong>Классификация входящих обращений.</strong> Письма, заявки, чаты сортируются AI по типу и направляются нужному специалисту. Сокращает время реакции с часов до минут.</li>
      <li><strong>Автогенерация документов.</strong> Договоры, коммерческие предложения, отчёты по шаблонам — на основе данных из CRM. Менеджер тратит 2 минуты вместо 20.</li>
      <li><strong>Аналитика воронки.</strong> AI находит узкие места в воронке продаж, где теряются сделки, и предлагает гипотезы причин.</li>
      <li><strong>Обработка документов.</strong> Распознавание, извлечение данных из договоров, актов, накладных — вместо ручного ввода в 1С или таблицы.</li>
    </ul>
    <p>McKinsey в «The State of AI 2025» подтверждает: только <strong>21% организаций</strong>, получивших реальный EBIT-эффект от AI, фундаментально переработали хотя бы часть рабочих процессов.</p>

  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     БОРИС — Анимированная матрица приоритизации
     id: boris-article-viz | canvas: ai-audit-matrix-canvas
     Позиция: после #kak-vybrat, перед #metodologiya
     НЕ изменять canvas id, НЕ удалять script
════════════════════════════════════════════════════════════════ -->
<section id="boris-article-viz">
<div class="ym-container">
  <div class="boris-card">

    <div class="boris-text">
      <p class="boris-eyebrow">Матрица приоритизации</p>
      <h3 class="boris-h3">Найдите Quick&nbsp;Wins прежде чем вложить рубль</h3>
      <p class="boris-lead">Каждый процесс оценивается по двум осям: <strong>Impact</strong> (деньги и время) и <strong>Feasibility</strong> (сложность внедрения). Анимация показывает, как реальные процессы попадают в четыре зоны матрицы.</p>
      <div class="boris-legend">
        <div class="boris-legend-row"><span class="boris-dot boris-dot--qw"></span><strong>Quick Win</strong>&nbsp;— высокий эффект, лёгкое внедрение (0–3 мес.)</div>
        <div class="boris-legend-row"><span class="boris-dot boris-dot--st"></span><strong>Стратегический</strong>&nbsp;— высокий эффект, сложное внедрение (6–12 мес.)</div>
        <div class="boris-legend-row"><span class="boris-dot boris-dot--low"></span><strong>Низкий приоритет</strong>&nbsp;— малый эффект, лёгкое внедрение (отложить)</div>
        <div class="boris-legend-row"><span class="boris-dot boris-dot--skip"></span><strong>Пропустить</strong>&nbsp;— затраты выше выгоды</div>
      </div>
      <div class="boris-pills">
        <span class="boris-pill boris-pill--blue">Impact × Feasibility</span>
        <span class="boris-pill">Digital Colliers, 2026</span>
        <span class="boris-pill">AI Hub Landau</span>
      </div>
    </div>

    <div class="boris-canvas-wrap">
      <canvas id="ai-audit-matrix-canvas" aria-label="Матрица приоритизации AI-процессов"></canvas>
    </div>

  </div>
</div>
</section><!-- /boris-article-viz -->

<!-- ═══════════════════════════════════════════════════════════════
     #metodologiya — Методология нашего AI-аудита
════════════════════════════════════════════════════════════════ -->
<section id="metodologiya" class="nero-ai-section">
  <div class="ym-container">

    <h2 class="reveal">Методология нашего AI-аудита</h2>

    <p>Nero Network проводит AI-аудит бизнес-процессов по трёхэтапной методологии: диагностика → анализ → план. Каждый этап даёт конкретный артефакт, а не «слайды с выводами». На выходе клиент получает рабочий документ, с которым можно действовать.</p>

    <h3>Шаг 1 — Диагностика: интервью с командой и сбор данных</h3>

    <p>На первом этапе (1–5 рабочих дней) мы погружаемся в то, как устроен бизнес клиента:</p>
    <ul>
      <li>Проводим структурированные интервью с собственником и операционным директором — по шаблону из 30+ вопросов о процессах, инструментах, стоимости и болях.</li>
      <li>Анализируем реальные данные: CRM-выгрузки, записи звонков, переписку, документы, регламенты.</li>
      <li>Строим «живую» карту процессов — как они работают на самом деле, а не на бумаге.</li>
      <li>Фиксируем «цену» каждого процесса в рублях: сколько человек, сколько часов, сколько стоит ошибка или задержка.</li>
    </ul>
    <p><strong>Артефакт этапа:</strong> список процессов с первичной оценкой времени и стоимости.</p>

    <h3>Шаг 2 — Анализ: выявление точек потерь и узких мест</h3>

    <p>На втором этапе (3–7 рабочих дней) мы переходим от фактов к гипотезам:</p>
    <ul>
      <li>Выявляем <strong>узкие места</strong>: где процесс тормозит, дублируется, требует ручного труда без добавленной ценности.</li>
      <li>Оцениваем <strong>готовность данных</strong>: есть ли у компании данные, на которых можно запустить AI-инструмент.</li>
      <li>Проверяем <strong>интеграционную готовность</strong>: CRM, 1С, ERP, мессенджеры, телефония.</li>
      <li>Проводим <strong>матричную приоритизацию</strong> по Impact × Feasibility — каждый процесс получает категорию.</li>
      <li>Готовим <strong>консервативный ROI-расчёт</strong>: стоимость внедрения vs ежегодная экономия по правилу 25-го перцентиля.</li>
    </ul>
    <p><strong>Артефакт этапа:</strong> таблица процессов с категорией, оценкой ROI и рекомендованным AI-инструментом.</p>

    <h3>Шаг 3 — Карта AI-возможностей и приоритетный план внедрения</h3>

    <p>Финальный документ аудита — <strong>Карта AI-возможностей</strong> — рабочий инструмент, а не маркетинговая презентация:</p>
    <ul>
      <li>Ранжированный список процессов: Quick Win → Среднесрочный → Стратегический → Пропустить.</li>
      <li>По каждому пункту: описание процесса, боль, AI-решение, стоимость внедрения (ориентировочно), ROI-расчёт (консервативный), срок окупаемости, рекомендованный инструмент.</li>
      <li>Дорожная карта с фазами: что делать в месяц 1–3, 4–6, 7–12.</li>
      <li>Рекомендации по интеграции с текущей инфраструктурой.</li>
      <li>Раздел по рискам: Shadow AI, персональные данные (152-ФЗ), что учесть.</li>
    </ul>
    <p>AI Hub Landau: «Хорошо выстроенные аудиты выявляют возможности, которые стоят в 10–50 раз больше самого аудита. Реальный случай: экономия $500&nbsp;000 в год при стоимости аудита $25&nbsp;000».</p>

    <!-- CTA 2 — Артур: двойная CTA-карточка после методологии -->
    <div class="nero-ai-cta-block nero-ai-cta-block--dual" style="background:var(--ym-surface-2,#0f2035);border:1px solid rgba(79,163,224,.2);border-radius:16px;padding:32px 40px;margin:40px 0;">
      <div style="display:flex;gap:32px;align-items:center;flex-wrap:wrap;">
        <div style="flex:1;min-width:240px;">
          <h3 style="font-size:clamp(18px,2vw,24px);font-weight:700;color:#fff;margin:0 0 10px;">Заказать AI-аудит бизнес-процессов</h3>
          <p style="color:rgba(255,255,255,.7);font-size:15px;margin:0;">Покажем, какие процессы автоматизировать первыми и какой ROI ожидать. Срок — 2–4 недели, стоимость — от 50&nbsp;000&nbsp;₽.</p>
        </div>
        <div style="display:flex;flex-direction:column;gap:12px;min-width:200px;">
          <a href="<?php echo esc_url( nero_ai_primary_cta_url() ); ?>" class="nero-ai-btn nero-ai-btn-primary" target="_blank" rel="noopener noreferrer" style="display:inline-block;padding:13px 28px;background:var(--ym-accent,#4fa3e0);color:#fff;font-weight:700;font-size:15px;border-radius:8px;text-decoration:none;text-align:center;"><?php echo esc_html( nero_ai_primary_cta_label() ); ?></a>
          <a href="<?php echo esc_url( getenv('SECONDARY_CTA_URL') ?: '#metodologiya' ); ?>" class="nero-ai-btn nero-ai-btn-secondary" target="_blank" rel="noopener noreferrer" style="display:inline-block;padding:12px 28px;background:transparent;border:1px solid rgba(79,163,224,.45);color:var(--ym-accent,#4fa3e0);font-weight:600;font-size:14px;border-radius:8px;text-decoration:none;text-align:center;"><?php echo esc_html( getenv('SECONDARY_CTA_LABEL') ?: 'Курс по AI-автоматизации' ); ?></a>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     #kejsy — Кейсы
════════════════════════════════════════════════════════════════ -->
<section id="kejsy" class="nero-ai-section">
  <div class="ym-container">

    <h2 class="reveal">Кейсы: результаты AI-аудита для разных отраслей</h2>

    <h3>Производство: сокращение ручных операций и ускорение учёта</h3>

    <p><strong>Сбербанк (Process Mining, 2026).</strong> Первый в России ИИ-агент для платформы Process Mining самостоятельно анализирует до 100&nbsp;млн событий в месяц и формирует готовый отчёт с гипотезами и рекомендациями. Задача, на которую аналитики тратили десятки часов, теперь решается за минуты.</p>
    <blockquote><p>«Наш ИИ-агент находит скрытые взаимосвязи в данных, генерирует обоснованные гипотезы. Он ускоряет весь цикл работы — от исследований до внедрения изменений». — Тарас Скворцов, зампред правления Сбербанка.</p></blockquote>

    <p><strong>Вентиляционная компания (кейс GodKod AI).</strong> Пришли со сметой на автоматизацию в 3&nbsp;млн рублей. Аудит показал: 70% задач решает пилот за 1&nbsp;млн. Остальные 2&nbsp;млн — масштабирование после проверки гипотезы. Экономия на этапе планирования: <strong>2&nbsp;млн рублей</strong> — без единой строчки кода.</p>

    <h3>Сервисный бизнес: автоматизация обработки заявок и клиентских обращений</h3>

    <p><strong>Оконная компания (500 сотрудников, кейс GodKod AI).</strong> Планировали голосового робота и автоматизацию пяти направлений. После аудита — приоритет на речевую аналитику и автозаполнение CRM-карточек из записей звонков. Итог: один чёткий план вместо пяти. Риски снизились в 5 раз, бюджет — втрое, скорость результата — в разы выше.</p>

    <p><strong>ROI 243% в первый год</strong> — зафиксирован в кейсе IT&nbsp;Digital по AI-аудиту и автоматизации. Условие: аудит с построением BPMN-карт процессов и ROI-анализом по каждому изменению.</p>
    <p>«По моим расчётам, средняя компания из 100 человек теряет от 3 до 8&nbsp;млн рублей в год на процессах, которые можно автоматизировать с помощью ИИ» (Андрей Пономарёв, vc.ru, 2026).</p>

    <h3>Малый бизнес: AI-аудит без программиста</h3>

    <p><strong>Юридическая компания (6 сотрудников, кейс GodKod AI).</strong> Планировали нанять ещё 6 человек — плюс 3&nbsp;млн рублей в год на ФОТ. Аудит выявил реальную проблему: не нехватка людей, а хаотичный сбор и систематизация документов. Решение — автоматизация документооборота, а не найм. Экономия: <strong>3&nbsp;млн рублей в год</strong>. Решение найдено на этапе аудита — без единой строчки кода.</p>
    <p>BCG AI Report: <strong>компании, которые сначала разбираются в своих процессах, а потом внедряют ИИ, получают результат в 3–5 раз лучше</strong> конкурентов, которые начинают с технологии.</p>

  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     #stoimost — Стоимость AI-аудита
════════════════════════════════════════════════════════════════ -->
<section id="stoimost" class="nero-ai-section">
  <div class="ym-container">

    <h2 class="reveal">Сколько стоит AI-аудит бизнес-процессов</h2>

    <h3>Что входит в стоимость и от чего зависит цена</h3>

    <p>Ориентировочный диапазон на российском рынке:</p>
    <div style="overflow-x:auto;margin:24px 0;">
      <table style="width:100%;border-collapse:collapse;font-size:15px;">
        <thead>
          <tr style="background:rgba(255,255,255,.06);">
            <th style="padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.12);color:#fff;">Формат</th>
            <th style="padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.12);color:#fff;">Стоимость</th>
            <th style="padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.12);color:#fff;">Что включает</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.9);">Экспресс-диагностика&nbsp;/ карта потерь</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:#22c55e;font-weight:600;">Бесплатно — 15&nbsp;000&nbsp;₽</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.75);">1–2 часа, 3–5 процессов, первичная оценка</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.9);">Аудит среднего бизнеса (50–500 сотрудников)</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:#4fa3e0;font-weight:600;">50&nbsp;000–350&nbsp;000&nbsp;₽</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.75);">Полная диагностика, карта процессов, ROI, дорожная карта</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;color:rgba(255,255,255,.9);">Комплексный аудит enterprise</td>
            <td style="padding:12px 16px;color:#f59e0b;font-weight:600;">от 750&nbsp;000&nbsp;₽</td>
            <td style="padding:12px 16px;color:rgba(255,255,255,.75);">Многоуровневый аудит, BPMN, архитектурные предложения</td>
          </tr>
        </tbody>
      </table>
    </div>

    <p>Стоимость AI-аудита в Nero Network — <strong>50–350&nbsp;тыс. рублей</strong> в зависимости от масштаба компании, числа процессов и глубины анализа. На цену влияет: количество подразделений; число IT-систем (CRM, ERP, телефония); необходимость анализа данных; отраслевая специфика и регуляторные требования (152-ФЗ).</p>

    <h3>Сравнение: AI-аудит vs самостоятельное внедрение без диагностики</h3>

    <div style="overflow-x:auto;margin:24px 0;">
      <table style="width:100%;border-collapse:collapse;font-size:15px;">
        <thead>
          <tr style="background:rgba(255,255,255,.06);">
            <th style="padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.12);color:#fff;">Сценарий</th>
            <th style="padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.12);color:#fff;">Стоимость ошибки</th>
            <th style="padding:12px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.12);color:#fff;">Время потерь</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.9);">Внедрение без аудита</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:#ef4444;font-weight:600;">1–5&nbsp;млн&nbsp;₽</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.75);">3–12 месяцев</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.9);">AI-аудит + правильное внедрение</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:#22c55e;font-weight:600;">50–350&nbsp;тыс.&nbsp;₽</td>
            <td style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.07);color:rgba(255,255,255,.75);">2–4 недели</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;color:rgba(255,255,255,.9);font-weight:700;">Разница</td>
            <td style="padding:12px 16px;color:#4fa3e0;font-weight:700;">Экономия 700 тыс. — 5&nbsp;млн&nbsp;₽</td>
            <td style="padding:12px 16px;color:rgba(255,255,255,.75);">2–10 месяцев</td>
          </tr>
        </tbody>
      </table>
    </div>

    <p>Если по итогам аудита выяснится, что AI вашей компании пока не нужен — мы честно об этом скажем. Это редкость на рынке, но именно такой подход формирует долгосрочные отношения с клиентом.</p>

  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     #integracii — Интеграция в инфраструктуру
════════════════════════════════════════════════════════════════ -->
<section id="integracii" class="nero-ai-section">
  <div class="ym-container">

    <h2 class="reveal">AI-аудит с интеграцией в вашу инфраструктуру</h2>

    <p>Одно из главных возражений: «Боимся, что придётся менять все наши системы». Хорошая новость: AI-рекомендации в большинстве случаев не требуют замены текущей инфраструктуры. Новые инструменты встраиваются через интеграционный слой.</p>

    <h3>Интеграция результатов аудита с CRM и ERP-системами</h3>

    <p>Nero Network работает с основными системами российского бизнеса:</p>
    <ul>
      <li><strong>CRM:</strong> amoCRM, Bitrix24 — анализ данных по сделкам, воронкам, обращениям; автозаполнение карточек из звонков.</li>
      <li><strong>Телефония:</strong> Манго, UIS, Beeline Business — транскрипция и анализ звонков через Яндекс&nbsp;SpeechKit или AssemblyAI.</li>
      <li><strong>Документооборот:</strong> 1С, МойСклад — зоны ручного ввода как главный источник потенциала для автоматизации.</li>
      <li><strong>Мессенджеры:</strong> Telegram, WhatsApp Business — аудит скорости и качества обработки входящих заявок.</li>
      <li><strong>AI-инструменты с учётом 152-ФЗ:</strong> YandexGPT для задач с персональными данными; on-prem LLaMA для конфиденциальных корпоративных данных; OpenAI для задач без чувствительных данных.</li>
      <li><strong>Аналитика:</strong> Яндекс.Метрика, DataLens — дашборды по результатам автоматизации.</li>
    </ul>

    <h3>Как внедрить AI-рекомендации без смены текущих инструментов</h3>

    <p>Большинство Quick Wins реализуются через интеграционный слой (Make.com или n8n) без изменения основных систем:</p>
    <ul>
      <li>CRM получает данные из звонков через вебхук → AI-модель классифицирует → запись автоматически в карточку сделки.</li>
      <li>Входящие письма → AI-триаж → автоматическое назначение ответственного в CRM с тегом.</li>
      <li>Документ создаётся по шаблону из данных сделки — без доработки 1С, за 2 минуты вместо 20.</li>
    </ul>
    <p>Нередко оказывается, что уже существующие инструменты (amoCRM, Bitrix24) не используются на 60–70% своих возможностей. Часть Quick Wins реализуется через настройку — без дополнительных подписок.</p>

  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     #faq — Часто задаваемые вопросы
════════════════════════════════════════════════════════════════ -->
<section id="faq" class="nero-ai-section">
  <div class="ym-container">

    <h2 class="reveal">Часто задаваемые вопросы об AI-аудите</h2>

    <h3>Как провести AI-аудит бизнес-процессов без программиста?</h3>
    <p>AI-аудит — это управленческий, а не технический инструмент. Программист на стороне клиента не нужен. Нужен доступ к данным (CRM-выгрузка, записи звонков, основные регламенты); 2–3 часа времени ключевых сотрудников на структурированные интервью; готовность открыто рассказать, как работают процессы на самом деле. Технической экспертизы на стороне клиента на этапе диагностики не требуется.</p>

    <h3>Подходит ли AI-аудит для малого бизнеса?</h3>
    <p>Да — и для малого бизнеса AI-аудит особенно ценен. Именно небольшие компании (5–50 человек) чаще всего несут скрытые потери на ручных операциях, которые при малом масштабе кажутся «нормальными». Юридическая компания из 6 человек сэкономила 3&nbsp;млн рублей в год, отказавшись от найма в пользу автоматизации. Для малого бизнеса особенно подходит формат экспресс-аудита: 1–5 дней, фокус на 3–5 ключевых процессах.</p>

    <h3>Какие задачи решает AI-аудит бизнес-процессов?</h3>
    <ol>
      <li><strong>Определяет, нужен ли AI вашей компании прямо сейчас</strong> — и если нет, сохраняет бюджет.</li>
      <li><strong>Показывает конкретные процессы</strong> с наибольшим потенциалом автоматизации — вместо общих слов про «оптимизацию».</li>
      <li><strong>Считает ROI</strong> по каждому сценарию консервативно — не «сколько могли бы сэкономить», а «сколько точно сэкономите в нижнем сценарии».</li>
      <li><strong>Даёт дорожную карту</strong> — с конкретными инструментами, сроками и этапами внедрения.</li>
    </ol>

    <h3>Как быстро окупается AI после правильного аудита?</h3>
    <p>Quick Wins, выявленные в ходе аудита, окупаются за <strong>1–3 месяца</strong> после внедрения. Среднесрочные результаты (3–6 месяцев) — более сложные интеграции: снижение ФОТ, ускорение цикла сделки, сокращение времени обработки документов. По консервативным международным оценкам (AI Hub Landau): правильно выбранные AI-инвестиции возвращают в <strong>10–50 раз</strong> больше стоимости самого аудита за первый год.</p>

    <h3>Что входит в бесплатную карту AI-возможностей?</h3>
    <p>Бесплатная карта AI-возможностей включает: 3–5 процессов с наибольшим потенциалом автоматизации именно в вашей компании; ориентировочный эффект для каждого процесса (в часах или рублях в месяц); рекомендацию по первому шагу; честную оценку: стоит ли вообще начинать AI-проект прямо сейчас.</p>
    <p><a href="<?php echo esc_url( nero_ai_primary_cta_url() ); ?>" target="_blank" rel="noopener noreferrer"><strong>Заказать бесплатную карту AI-возможностей</strong></a> — первый шаг к тому, чтобы не оказаться в числе тех 40% компаний, о которых предупреждает Gartner в 2026 году.</p>

  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     #cta — Финальный CTA-блок (Артур)
════════════════════════════════════════════════════════════════ -->
<div id="cta" class="nero-ai-cta-block nero-ai-cta-block--final" style="background:var(--ym-gradient-primary,linear-gradient(135deg,#162d4a 0%,#0a1a2e 100%));border-radius:20px;padding:48px 40px;margin:48px auto;max-width:1200px;text-align:center;">
  <p style="font-size:13px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:var(--ym-accent,#4fa3e0);margin:0 0 16px;">50&nbsp;000–350&nbsp;000&nbsp;₽ · срок 2–4 недели</p>
  <h2 style="font-size:clamp(22px,3vw,36px);font-weight:800;color:#fff;margin:0 0 16px;line-height:1.25;">Не окажитесь в числе 40% компаний,<br>которые провалили внедрение AI</h2>
  <p style="color:rgba(255,255,255,.75);font-size:17px;margin:0 auto 32px;max-width:580px;">Проведём AI-аудит, покажем карту возможностей и честно скажем, если AI пока не нужен — до того, как вы потратите бюджет.</p>
  <a href="<?php echo esc_url( nero_ai_primary_cta_url() ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer" style="display:inline-block;padding:16px 40px;background:var(--ym-accent,#4fa3e0);color:#fff;font-weight:800;font-size:17px;border-radius:10px;text-decoration:none;"><?php echo esc_html( nero_ai_primary_cta_label() ); ?></a>
</div>

<?php
$naad_page_url = trailingslashit( get_permalink() );
$naad_site_url = trailingslashit( home_url( '/' ) );
$naad_brand    = get_bloginfo( 'name' ) ?: 'Organization';
$naad_schema   = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type' => 'Organization',
            '@id'   => $naad_site_url . '#organization',
            'name'  => $naad_brand,
            'url'   => $naad_site_url,
        ],
        [
            '@type'     => 'WebSite',
            '@id'       => $naad_site_url . '#website',
            'url'       => $naad_site_url,
            'name'      => $naad_brand,
            'publisher' => [ '@id' => $naad_site_url . '#organization' ],
        ],
        [
            '@type'       => 'WebPage',
            '@id'         => $naad_page_url . '#webpage',
            'url'         => $naad_page_url,
            'name'        => 'AI-аудит бизнес-процессов: найдём, где автоматизация принесёт деньги',
            'description' => $page_seo_description,
            'isPartOf'    => [ '@id' => $naad_site_url . '#website' ],
            'about'       => [ '@id' => $naad_site_url . '#organization' ],
        ],
        [
            '@type'           => 'BreadcrumbList',
            '@id'             => $naad_page_url . '#breadcrumb',
            'itemListElement' => [
                [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $naad_site_url ],
                [ '@type' => 'ListItem', 'position' => 2, 'name' => 'AI-аудит бизнес-процессов: найдём, где автоматизация принесёт деньги', 'item' => $naad_page_url ],
            ],
        ],
        [
            '@type'       => 'Service',
            '@id'         => $naad_page_url . '#service',
            'name'        => 'AI-аудит бизнес-процессов: найдём, где автоматизация принесёт деньги',
            'description' => $page_seo_description,
            'url'         => $naad_page_url,
            'provider'    => [ '@id' => $naad_site_url . '#organization' ],
        ],
        [
            '@type'      => 'FAQPage',
            '@id'        => $naad_page_url . '#faq',
            'mainEntity' => [
                [ '@type' => 'Question', 'name' => 'Как провести AI-аудит бизнес-процессов без программиста?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'AI-аудит — это управленческий, а не технический инструмент. Для его проведения программист на стороне клиента не нужен. Вам понадобится: доступ к данным (CRM-выгрузка, записи звонков, основные регламенты); 2–3 часа времени ключевых сотрудников на структурированные интервью; готовность открыто рассказать, как работают процессы на самом деле. Технической экспертизы на стороне клиента на этапе диагностики не требуется. Программисты понадобятся на следующем шаге — при реализации рекомендаций аудита. Но не раньше.' ] ],
                [ '@type' => 'Question', 'name' => 'Подходит ли AI-аудит для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да — и для малого бизнеса AI-аудит особенно ценен. Именно небольшие компании (5–50 человек) чаще всего несут скрытые потери на ручных операциях, которые при малом масштабе кажутся нормальными. Юридическая компания из 6 человек (кейс GodKod AI) сэкономила 3 млн рублей в год, отказавшись от найма в пользу автоматизации. Для малого бизнеса особенно подходит формат экспресс-аудита: 1–5 дней, фокус на 3–5 ключевых процессах.' ] ],
                [ '@type' => 'Question', 'name' => 'Какие задачи решает AI-аудит бизнес-процессов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'AI-аудит решает четыре управленческие задачи: определяет, нужен ли AI вашей компании прямо сейчас; показывает конкретные процессы с наибольшим потенциалом автоматизации; считает ROI по каждому сценарию консервативно; даёт дорожную карту с конкретными инструментами, сроками и этапами внедрения.' ] ],
                [ '@type' => 'Question', 'name' => 'Как быстро окупается AI после правильного аудита?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Quick Wins, выявленные в ходе аудита, окупаются за 1–3 месяца после внедрения. Среднесрочные результаты (3–6 месяцев) — более сложные интеграции: снижение ФОТ на рутинных задачах, ускорение цикла сделки. По консервативным международным оценкам (AI Hub Landau) правильно выбранные AI-инвестиции возвращают в 10–50 раз больше стоимости самого аудита за первый год.' ] ],
                [ '@type' => 'Question', 'name' => 'Что входит в бесплатную карту AI-возможностей?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Бесплатная карта AI-возможностей включает: 3–5 процессов с наибольшим потенциалом автоматизации именно в вашей компании; ориентировочный эффект для каждого процесса (в часах или рублях в месяц); рекомендацию по первому шагу — какой инструмент, какая интеграция, с чего начать; честную оценку, стоит ли вообще начинать AI-проект прямо сейчас. Карта формируется на основе короткой диагностической сессии (60–90 минут).' ] ],
            ],
        ],
    ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $naad_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<!-- ═══════════════════════════════════════════════════════════════
     SCRIPTS: Hero Canvas Engine (Алина)
     canvas id: ai-audit-dispatch-canvas
     НЕ удалять, НЕ переименовывать canvas id
════════════════════════════════════════════════════════════════ -->
<script id="ai-audit-dispatch-engine">
/**
 * AI Audit Dispatch Engine v1
 * Мир: «Диспетчерская AI-рисков»
 * canvas id: ai-audit-dispatch-canvas
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ai-audit-dispatch-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");

  var cw = 0, ch = 0, cx = 0, cy = 0, scale = 1, frame = 0;

  function resizeCanvas() {
    if (!canvas.parentElement) return;
    cw = canvas.parentElement.clientWidth || 600;
    ch = canvas.parentElement.clientHeight || 360;
    canvas.width = cw;
    canvas.height = ch;
    cx = cw / 2;
    cy = ch / 2 + 20;
    if (cw < 480) { scale = cw / 520; }
    else { scale = Math.min(cw / 860, ch / 520) * 1.25; }
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline:"#94a3b8",matrixBg:"rgba(15,32,53,0.95)",matrixBorder:"#4fa3e0",
    flowLine:"#1e3a5f",flowAccent:"#4fa3e0",flowRisk:"#ef4444",flowOk:"#10b981",
    agentYellow:"#eab308",agentGreen:"#10b981",agentBlue:"#3b82f6",
    agentPink:"#ec4899",agentPurple:"#8b5cf6",
    cardQuick:"rgba(16,185,129,0.22)",cardMid:"rgba(251,146,60,0.22)",
    cardLow:"rgba(100,116,139,0.15)",bubbleBg:"rgba(10,26,46,0.93)",
    bubbleText:"#e2e8f0",success:"#10b981",accent:"#4fa3e0"
  };

  function drawRect(x,y,w,h,r,fill,stroke){
    ctx.fillStyle=fill;
    ctx.beginPath();
    if(ctx.roundRect){ctx.roundRect(x,y,w,h,Array.isArray(r)?r:r);}
    else{ctx.rect(x,y,w,h);}
    ctx.fill();
    if(stroke){ctx.lineWidth=1.5;ctx.strokeStyle=stroke;ctx.stroke();}
  }

  function DataFlow(x1,y,x2){
    this.x1=x1;this.y=y;this.x2=x2;this.nodes=[];
    var self=this;
    for(var i=0;i<6;i++){
      self.nodes.push({x:x1+Math.random()*(x2-x1),speed:0.4+Math.random()*0.4,
        type:Math.random()>0.5?"risk":"ok",r:3+Math.random()*3.5});
    }
  }
  DataFlow.prototype.draw=function(){
    ctx.strokeStyle=C.flowLine;ctx.lineWidth=1;
    ctx.beginPath();ctx.moveTo(this.x1,this.y);ctx.lineTo(this.x2,this.y);ctx.stroke();
    var dashOff=-(frame*0.4%22);
    ctx.save();ctx.globalAlpha=0.22+0.1*Math.sin(frame*0.04);
    ctx.strokeStyle=C.flowAccent;ctx.lineWidth=1.5;
    ctx.setLineDash([5,11]);ctx.lineDashOffset=dashOff;
    ctx.beginPath();ctx.moveTo(this.x1,this.y);ctx.lineTo(this.x2,this.y);ctx.stroke();
    ctx.setLineDash([]);ctx.restore();
    for(var i=0;i<this.nodes.length;i++){
      var n=this.nodes[i];n.x+=n.speed;
      if(n.x>this.x2+14){n.x=this.x1-10;n.type=Math.random()>0.52?"risk":"ok";}
      if(n.x<this.x1||n.x>this.x2)continue;
      ctx.save();ctx.globalAlpha=0.82;
      ctx.fillStyle=n.type==="risk"?C.flowRisk:C.flowOk;
      ctx.shadowColor=n.type==="risk"?C.flowRisk:C.flowOk;ctx.shadowBlur=6;
      ctx.beginPath();ctx.arc(n.x,this.y,n.r,0,Math.PI*2);ctx.fill();
      ctx.restore();
    }
  };

  function AuditMatrix(x,y){this.x=x;this.y=y;this.w=188;this.h=208;}
  AuditMatrix.prototype.draw=function(){
    var mx=this.x-this.w/2,my=this.y-this.h/2;
    var prg=(frame*0.05)%200;
    ctx.save();ctx.shadowColor=C.matrixBorder;
    ctx.shadowBlur=8+5*Math.abs(Math.sin(frame*0.03));
    drawRect(mx,my,this.w,this.h,10,C.matrixBg,C.matrixBorder);ctx.restore();
    drawRect(mx,my,this.w,26,[10,10,0,0],"rgba(79,163,224,0.14)",null);
    ctx.fillStyle=C.accent;ctx.font="bold 8px Inter, sans-serif";
    ctx.textAlign="center";ctx.textBaseline="middle";
    ctx.fillText("МАТРИЦА AI-АУДИТА",this.x,my+13);
    for(var d=0;d<4;d++){
      ctx.fillStyle=prg>d*40?C.success:"rgba(100,116,139,0.35)";
      ctx.beginPath();ctx.arc(mx+this.w-52+d*11,my+13,3,0,Math.PI*2);ctx.fill();
    }
    if(prg<175){
      ctx.fillStyle="rgba(203,213,225,0.38)";ctx.font="7px Inter, sans-serif";
      ctx.textAlign="center";ctx.fillText("← СЛОЖНОСТЬ →",this.x,my+44);
      ctx.save();ctx.translate(mx+14,my+this.h/2+12);ctx.rotate(-Math.PI/2);
      ctx.fillText("← ЭФФЕКТ →",0,0);ctx.restore();
      var qx=mx+26,qy=my+52,qw=64,qh=63,gap=8;
      var a1=prg>22?Math.min(1,(prg-22)/14):0;
      ctx.globalAlpha=a1;drawRect(qx,qy,qw,qh,5,C.cardQuick,"#10b981");
      ctx.fillStyle="#10b981";ctx.font="bold 9px Inter, sans-serif";ctx.textAlign="center";
      ctx.fillText("Quick",qx+qw/2,qy+qh/2-5);ctx.fillText("Win ✓",qx+qw/2,qy+qh/2+7);
      ctx.globalAlpha=1;
      var a2=prg>62?Math.min(1,(prg-62)/14):0;
      ctx.globalAlpha=a2;drawRect(qx+qw+gap,qy,qw,qh,5,C.cardMid,"#fb923c");
      ctx.fillStyle="#fb923c";ctx.font="bold 8px Inter, sans-serif";ctx.textAlign="center";
      ctx.fillText("Стратег.",qx+qw+gap+qw/2,qy+qh/2-4);
      ctx.fillText("6–12 мес",qx+qw+gap+qw/2,qy+qh/2+8);ctx.globalAlpha=1;
      var a3=prg>102?Math.min(1,(prg-102)/14):0;
      ctx.globalAlpha=a3;drawRect(qx,qy+qh+gap,qw,qh,5,C.cardLow,"#64748b");
      ctx.fillStyle="#94a3b8";ctx.font="bold 8px Inter, sans-serif";ctx.textAlign="center";
      ctx.fillText("Отложить",qx+qw/2,qy+qh+gap+qh/2-4);
      ctx.fillText("3–6 мес",qx+qw/2,qy+qh+gap+qh/2+8);ctx.globalAlpha=1;
      var a4=prg>140?Math.min(1,(prg-140)/14):0;
      ctx.globalAlpha=a4;drawRect(qx+qw+gap,qy+qh+gap,qw,qh,5,"rgba(100,116,139,0.08)","#334155");
      ctx.fillStyle="#64748b";ctx.font="bold 9px Inter, sans-serif";ctx.textAlign="center";
      ctx.fillText("Пропустить",qx+qw+gap+qw/2,qy+qh+gap+qh/2);ctx.globalAlpha=1;
    } else {
      var fp=Math.min(1,(prg-175)/25);
      ctx.save();ctx.globalAlpha=fp*0.18;ctx.fillStyle=C.success;
      ctx.beginPath();ctx.arc(this.x,my+this.h/2+8,65,0,Math.PI*2);ctx.fill();ctx.restore();
      ctx.save();ctx.translate(this.x,my+this.h/2-14);ctx.scale(fp,fp);
      ctx.strokeStyle=C.success;ctx.lineWidth=7;ctx.lineCap="round";ctx.lineJoin="round";
      ctx.shadowColor=C.success;ctx.shadowBlur=12;
      ctx.beginPath();ctx.moveTo(-28,0);ctx.lineTo(-8,22);ctx.lineTo(28,-22);ctx.stroke();
      ctx.restore();
      ctx.globalAlpha=fp;ctx.fillStyle=C.success;ctx.font="bold 11px Inter, sans-serif";
      ctx.textAlign="center";ctx.fillText("КАРТА ГОТОВА",this.x,my+this.h-28);
      ctx.fillStyle="rgba(203,213,225,0.65)";ctx.font="8px Inter, sans-serif";
      ctx.fillText("AI-возможности определены",this.x,my+this.h-14);ctx.globalAlpha=1;
    }
  };

  function Agent(x,y,color,role,stepTrig,dialogs){
    this.x=x;this.y=y;this.baseX=x;this.baseY=y;
    this.color=color;this.role=role;this.timer=Math.random()*100;
    this.stepTrig=stepTrig;this.dialogs=dialogs;
  }
  Agent.prototype.draw=function(){
    this.timer+=0.03;var isMoving=false,carryType=null,faceDir=1;
    var prg=(frame*0.05)%200;
    var targetX=55,targetY=-20+(this.stepTrig*0.28);
    if(prg>=this.stepTrig&&prg<this.stepTrig+25){
      var lp=prg-this.stepTrig;
      if(lp<10){isMoving=true;faceDir=1;carryType=this.color;
        this.x=this.baseX+(targetX-this.baseX)*(lp/10);
        this.y=this.baseY+(targetY-this.baseY)*(lp/10);
      }else if(lp<15){isMoving=false;faceDir=1;this.x=targetX;this.y=targetY;
      }else{isMoving=true;faceDir=-1;
        this.x=targetX-(targetX-this.baseX)*((lp-15)/10);
        this.y=targetY-(targetY-this.baseY)*((lp-15)/10);
      }
    }else{
      this.x=this.baseX;this.y=this.baseY;isMoving=false;
      carryType=prg>=this.stepTrig-8?this.color:null;
    }
    if(!isMoving&&frame%220===(Math.floor(this.stepTrig*3)%220)&&Math.random()<0.12){
      var rnd=this.dialogs[Math.floor(Math.random()*this.dialogs.length)];
      createBubble(this.x,this.y-22,rnd,260);
    }
    var bob=isMoving?Math.abs(Math.sin(this.timer*3))*2:Math.sin(this.timer*1.5)*1;
    ctx.save();ctx.translate(this.x,this.y);ctx.lineJoin="round";
    var legL=0,legR=0;
    if(isMoving){var wp=this.timer*6;legL=Math.sin(wp)*5;legR=Math.sin(wp+Math.PI)*5;}
    drawRect(-10,-5+Math.max(0,legL),8,14,2,C.outline,null);
    drawRect(-12,5+Math.max(0,legL),12,6,2,C.outline,null);
    drawRect(2,-5+Math.max(0,legR),8,14,2,C.outline,null);
    drawRect(0,5+Math.max(0,legR),12,6,2,C.outline,null);
    drawRect(-15,-12-bob,30,20,6,this.color,C.outline);
    var hx=0,hy=-28-bob;
    ctx.fillStyle=this.color;ctx.beginPath();ctx.arc(hx,hy,12,0,Math.PI*2);ctx.fill();
    ctx.lineWidth=2;ctx.strokeStyle=C.outline;ctx.stroke();
    ctx.save();ctx.scale(faceDir,1);
    ctx.fillStyle="#fff";
    ctx.beginPath();ctx.arc(hx+4,hy-2,4,0,Math.PI*2);ctx.fill();
    ctx.beginPath();ctx.arc(hx-4,hy-2,4,0,Math.PI*2);ctx.fill();
    ctx.fillStyle="#0f172a";
    ctx.beginPath();ctx.arc(hx+5,hy-2,2,0,Math.PI*2);ctx.fill();
    ctx.beginPath();ctx.arc(hx-3,hy-2,2,0,Math.PI*2);ctx.fill();
    if(this.role==="1_architect"){
      ctx.strokeStyle=C.outline;ctx.lineWidth=1.5;
      ctx.strokeRect(hx+1,hy-6,6,5);ctx.strokeRect(hx-7,hy-6,6,5);
      ctx.beginPath();ctx.moveTo(hx+1,hy-3);ctx.lineTo(hx-1,hy-3);ctx.stroke();
    }else if(this.role==="2_seo"){
      drawRect(hx-12,hy-14,24,7,[4,4,0,0],C.outline,null);
      ctx.fillStyle=C.accent;ctx.beginPath();ctx.arc(hx,hy-19,3,0,Math.PI*2);ctx.fill();
    }else if(this.role==="3_coder"){
      ctx.strokeStyle=C.outline;ctx.lineWidth=2;
      ctx.beginPath();ctx.arc(hx,hy,14,Math.PI,0);ctx.stroke();
      drawRect(hx-16,hy-2,4,7,2,C.outline,null);drawRect(hx+12,hy-2,4,7,2,C.outline,null);
    }else if(this.role==="4_designer"){
      drawRect(hx-14,hy-12,28,5,2,"#f43f5e",C.outline);
      ctx.fillStyle="#fcd34d";ctx.beginPath();
      ctx.moveTo(hx-2,hy-15);ctx.lineTo(hx+2,hy-15);ctx.lineTo(hx,hy-20);
      ctx.closePath();ctx.fill();
    }else if(this.role==="5_deployer"){
      ctx.strokeStyle=C.success;ctx.lineWidth=2;
      ctx.beginPath();ctx.arc(hx,hy,14,Math.PI,0);ctx.stroke();
      drawRect(hx-16,hy-2,4,8,2,C.outline,null);drawRect(hx+12,hy-2,4,8,2,C.outline,null);
    }
    ctx.restore();
    if(carryType){
      var cf=faceDir;
      drawRect(-22*cf,-20-bob,14,10,2,carryType,C.outline);
      ctx.fillStyle="rgba(255,255,255,0.45)";
      ctx.fillRect(-20*cf,-19-bob,8,1.5);ctx.fillRect(-20*cf,-16-bob,5,1.5);
    }
    ctx.restore();
  };

  var bubbles=[];
  var flow1=new DataFlow(-300,85,240);
  var flow2=new DataFlow(-260,132,200);
  var matrix=new AuditMatrix(110,-18);
  var agents=[
    new Agent(-268,44,C.agentYellow,"1_architect",15,["Картирую процессы...","Нашёл узкое место!","Оцениваю в рублях"]),
    new Agent(-155,106,C.agentGreen,"2_seo",55,["Считаю потери...","Quick Win найден!","ROI посчитан"]),
    new Agent(-58,-18,C.agentBlue,"3_coder",95,["Проверяю CRM...","Интеграция есть!","Данные чистые"]),
    new Agent(42,102,C.agentPink,"4_designer",135,["Строю матрицу...","Приоритет: HIGH!","Отчёт оформлен"]),
    new Agent(188,18,C.agentPurple,"5_deployer",175,["Карта готова!","Согласовано!","Внедряем первыми"])
  ];

  function createBubble(x,y,text,life){
    bubbles.push({x:x,y:y,text:text,life:life||270,maxLife:life||270});
  }

  function engineloop(){
    frame++;
    ctx.clearRect(0,0,cw,ch);
    ctx.save();ctx.translate(cx,cy);ctx.scale(scale,scale);
    flow1.draw();flow2.draw();
    matrix.draw();
    var prg=(frame*0.05)%200;
    if(prg>=14&&prg<14.06)createBubble(-268,0,"1. Картирование");
    if(prg>=54&&prg<54.06)createBubble(-155,56,"2. Потери найдены");
    if(prg>=94&&prg<94.06)createBubble(-58,-48,"3. ROI посчитан");
    if(prg>=134&&prg<134.06)createBubble(42,52,"4. Матрица готова");
    if(prg>=174&&prg<174.06)createBubble(110,-90,"✓ Карта AI-возможностей");
    agents.sort(function(a,b){return a.y-b.y;});
    agents.forEach(function(ag){ag.draw();});
    ctx.font="bold 10px Inter, sans-serif";ctx.textAlign="center";
    ctx.textBaseline="middle";ctx.lineJoin="round";
    for(var i=bubbles.length-1;i>=0;i--){
      var bub=bubbles[i];bub.life--;
      if(bub.life<=0){bubbles.splice(i,1);continue;}
      var alpha=Math.min(1,bub.life/22);
      if(bub.life>bub.maxLife-8)alpha=(bub.maxLife-bub.life)/8;
      ctx.globalAlpha=alpha;
      var tw=ctx.measureText(bub.text).width+14,th=18;
      var bx=bub.x,by=bub.y-(bub.maxLife-bub.life)*0.04;
      drawRect(bx-tw/2,by-th,tw,th,5,C.bubbleBg,C.matrixBorder);
      ctx.fillStyle=C.bubbleBg;ctx.beginPath();
      ctx.moveTo(bx-3,by);ctx.lineTo(bx+3,by);ctx.lineTo(bx,by+4);
      ctx.closePath();ctx.fill();
      ctx.strokeStyle=C.matrixBorder;ctx.lineWidth=1.5;ctx.stroke();
      ctx.fillRect(bx-2,by-2,4,3);
      ctx.fillStyle=C.bubbleText;ctx.fillText(bub.text,bx,by-th/2);
      ctx.globalAlpha=1;
    }
    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  document.fonts.ready.then(function(){engineloop();});
});
</script>

<!-- ═══════════════════════════════════════════════════════════════
     SCRIPTS: Boris Matrix Canvas Engine
     canvas id: ai-audit-matrix-canvas
     НЕ удалять, НЕ переименовывать canvas id
════════════════════════════════════════════════════════════════ -->
<script>
(function() {
  'use strict';
  var canvas = document.getElementById('ai-audit-matrix-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var cw = 0, ch = 0, frame = 0, animId = null;

  function resize() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    var dpr = window.devicePixelRatio || 1;
    var w = wrap.clientWidth  || 400;
    var h = wrap.clientHeight || 420;
    canvas.width  = Math.round(w * dpr);
    canvas.height = Math.round(h * dpr);
    canvas.style.width  = w + 'px';
    canvas.style.height = h + 'px';
    ctx.setTransform(1,0,0,1,0,0);
    ctx.scale(dpr, dpr);
    cw = w; ch = h;
  }
  window.addEventListener('resize', function(){ resize(); }, { passive:true });
  resize();

  var COL = {
    qw:'#16a34a',qwFill:'#22c55e',qwBg:'rgba(34,197,94,.07)',
    st:'#1d4ed8',stFill:'#3b82f6',stBg:'rgba(59,130,246,.07)',
    low:'#b45309',lowFill:'#f59e0b',lowBg:'rgba(245,158,11,.05)',
    skip:'#64748b',skipFill:'#94a3b8',skipBg:'rgba(148,163,184,.05)',
    axis:'#94a3b8',grid:'#e2e8f0',label:'#475569',
    quadLabel:'rgba(0,0,0,.55)',bg:'#f8fafc'
  };

  var ML=58,MR_PAD=18,MT=22,MB=52;
  function bounds(){ return {l:ML,r:cw-MR_PAD,t:MT,b:ch-MB}; }
  function toCanvas(qx,qy){
    var b=bounds();
    return {x:b.l+qx*(b.r-b.l),y:b.b-qy*(b.b-b.t)};
  }

  var NODES=[
    {label:'Анализ\nзвонков',qx:.76,qy:.82,cat:'qw',sf:30},
    {label:'CRM\nавтозаполн.',qx:.86,qy:.68,cat:'qw',sf:75},
    {label:'Классиф.\nзаявок',qx:.66,qy:.74,cat:'qw',sf:120},
    {label:'Предиктивная\nаналит.',qx:.22,qy:.84,cat:'st',sf:170},
    {label:'Умное\nценообр.',qx:.32,qy:.66,cat:'st',sf:215},
    {label:'FAQ-бот',qx:.75,qy:.26,cat:'low',sf:260},
    {label:'Email\nавтоответы',qx:.88,qy:.16,cat:'low',sf:305},
    {label:'Ручной\nввод (ред.)',qx:.24,qy:.20,cat:'skip',sf:350}
  ];

  var CYCLE=560,FLY=38;
  var nodes=NODES.map(function(n){
    return {label:n.label,qx:n.qx,qy:n.qy,cat:n.cat,sf:n.sf,
      x:0,y:0,sx:0,sy:0,tx:0,ty:0,arrived:false,alpha:0};
  });

  function eob(t){
    if(t<4/11)return(121/16)*t*t;
    if(t<8/11){t-=6/11;return(121/16)*t*t+.75;}
    if(t<10/11){t-=9/11;return(121/16)*t*t+.9375;}
    t-=21/22;return(121/16)*t*t+63/64;
  }

  function drawMatrix(pulse){
    var b=bounds();
    var mx=(b.l+b.r)/2,my=(b.t+b.b)/2;
    ctx.fillStyle=COL.bg;ctx.fillRect(0,0,cw,ch);
    ctx.fillStyle=COL.qwBg; ctx.fillRect(mx,b.t,b.r-mx,my-b.t);
    ctx.fillStyle=COL.stBg; ctx.fillRect(b.l,b.t,mx-b.l,my-b.t);
    ctx.fillStyle=COL.lowBg;ctx.fillRect(mx,my,b.r-mx,b.b-my);
    ctx.fillStyle=COL.skipBg;ctx.fillRect(b.l,my,mx-b.l,b.b-my);
    var pa=.06+Math.abs(Math.sin(frame*.035))*.09*pulse;
    ctx.fillStyle='rgba(34,197,94,'+pa+')';
    ctx.beginPath();
    if(ctx.roundRect)ctx.roundRect(mx+1,b.t+1,b.r-mx-2,my-b.t-2,6);
    else ctx.rect(mx+1,b.t+1,b.r-mx-2,my-b.t-2);
    ctx.fill();
    ctx.strokeStyle=COL.grid;ctx.lineWidth=1;ctx.setLineDash([4,4]);
    ctx.beginPath();ctx.moveTo(mx,b.t);ctx.lineTo(mx,b.b);
    ctx.moveTo(b.l,my);ctx.lineTo(b.r,my);ctx.stroke();ctx.setLineDash([]);
    ctx.strokeStyle='#cbd5e1';ctx.lineWidth=1.5;
    ctx.strokeRect(b.l,b.t,b.r-b.l,b.b-b.t);
    ctx.font='bold 10px Inter,system-ui,sans-serif';ctx.textBaseline='top';
    ctx.fillStyle=COL.qw; ctx.textAlign='left';ctx.fillText('✓ Quick Win',mx+7,b.t+7);
    ctx.fillStyle=COL.st; ctx.textAlign='left';ctx.fillText('★ Стратегич.',b.l+7,b.t+7);
    ctx.fillStyle=COL.low;ctx.textAlign='left';ctx.fillText('↓ Низкий прио.',mx+7,my+5);
    ctx.fillStyle=COL.skip;ctx.textAlign='left';ctx.fillText('✕ Пропустить',b.l+7,my+5);
    ctx.textBaseline='alphabetic';
    ctx.strokeStyle=COL.axis;ctx.lineWidth=1.5;
    ctx.beginPath();ctx.moveTo(b.l-4,b.b+4);ctx.lineTo(b.r+6,b.b+4);ctx.stroke();
    ctx.fillStyle=COL.axis;
    ctx.beginPath();ctx.moveTo(b.r+6,b.b+4);ctx.lineTo(b.r+1,b.b);ctx.lineTo(b.r+1,b.b+8);ctx.fill();
    ctx.beginPath();ctx.moveTo(b.l-4,b.b+4);ctx.lineTo(b.l-4,b.t-6);ctx.stroke();
    ctx.beginPath();ctx.moveTo(b.l-4,b.t-6);ctx.lineTo(b.l-9,b.t-1);ctx.lineTo(b.l+1,b.t-1);ctx.fill();
    ctx.fillStyle=COL.label;ctx.font='10px Inter,system-ui,sans-serif';
    ctx.textAlign='center';ctx.textBaseline='bottom';
    ctx.fillText('Простота внедрения (Feasibility) →',(b.l+b.r)/2,ch-4);
    ctx.save();ctx.translate(12,(b.t+b.b)/2);ctx.rotate(-Math.PI/2);
    ctx.textAlign='center';ctx.textBaseline='top';
    ctx.fillText('← Влияние на бизнес (Impact)',0,0);
    ctx.restore();ctx.textBaseline='alphabetic';
  }

  function drawNode(node){
    if(node.alpha<=0)return;
    var col=COL[node.cat+'Fill'];
    var r=Math.min(22,Math.max(16,Math.min(cw,ch)*.052));
    var x=node.x,y=node.y;
    ctx.save();ctx.globalAlpha=node.alpha;
    ctx.shadowColor=col;ctx.shadowBlur=node.arrived?9:4;
    ctx.fillStyle=col;ctx.beginPath();ctx.arc(x,y,r,0,Math.PI*2);ctx.fill();
    ctx.strokeStyle='#fff';ctx.lineWidth=2;ctx.stroke();ctx.shadowBlur=0;
    var lines=node.label.split('\n');
    var lh=9.5,total=lines.length*lh;
    ctx.fillStyle='#fff';ctx.font='bold 8px Inter,system-ui,sans-serif';
    ctx.textAlign='center';ctx.textBaseline='middle';
    lines.forEach(function(ln,i){ctx.fillText(ln,x,y-total/2+i*lh+lh/2);});
    ctx.restore();
  }

  function updateNodes(){
    var cf=frame%CYCLE;
    nodes.forEach(function(nd){
      var lf=cf-nd.sf;
      var pos=toCanvas(nd.qx,nd.qy);nd.tx=pos.x;nd.ty=pos.y;
      if(lf<0){nd.alpha=0;nd.arrived=false;nd.sx=nd.tx+(Math.random()*40-20);nd.sy=ch+35;return;}
      if(lf<FLY){
        var t=lf/FLY;nd.x=nd.sx+(nd.tx-nd.sx)*t;
        nd.y=nd.sy+(nd.ty-nd.sy)*eob(t);nd.alpha=Math.min(1,t*3);
      }else{
        nd.x=nd.tx;nd.y=nd.ty+Math.sin(frame*.04+nd.sf*.07)*2.2;
        nd.alpha=1;nd.arrived=true;
      }
    });
  }

  function loop(){
    frame++;
    var cf=frame%CYCLE;
    var pulse=(cf>NODES[2].sf+FLY)?1:0;
    ctx.clearRect(0,0,cw,ch);
    drawMatrix(pulse);updateNodes();nodes.forEach(drawNode);
    animId=requestAnimationFrame(loop);
  }

  if(typeof IntersectionObserver!=='undefined'){
    var io=new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if(e.isIntersecting){if(!animId){frame=0;loop();}}
        else{if(animId){cancelAnimationFrame(animId);animId=null;}}
      });
    },{threshold:0.05});
    io.observe(canvas);
  }else{
    if(document.fonts&&document.fonts.ready)document.fonts.ready.then(loop);
    else loop();
  }
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

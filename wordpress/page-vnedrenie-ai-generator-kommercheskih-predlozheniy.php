<?php
/**
 * Template Name: AI KP Generator
 * Description: AI-генератор коммерческих предложений по брифу клиента — внедрение под ключ
 */

$page_seo_title = 'AI-генератор коммерческих предложений — внедрение под ключ';
$page_seo_description = 'Внедрим AI-генератор КП по брифу клиента: персональное коммерческое предложение за 2–5 минут на основе заявки и истории общения. Шаблон сильного КП под вашу нишу — соберите пример бесплатно.';

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

$brand = getenv('SITE_BRAND') ?: get_bloginfo('name') ?: '[REDACTED]';

$nero_bootstrap = get_stylesheet_directory() . '/partials/nero-ai-longread-bootstrap.php';
if (is_readable($nero_bootstrap)) {
    require_once $nero_bootstrap;
}

get_header();
?>

<style>

/**
 * Meta Journal / Neurinix homepage design reference.
 * Назначение: новый шаблонный дизайн для главной страницы и будущих AI/B2B лендингов.
 * Использование: корневая обёртка страницы должна иметь класс .nero-ai-home-page.
 * Все пользовательские классы начинаются с .nero-ai- чтобы не конфликтовать с WordPress/Kadence.
 */

:root {
  --nero-ai-bg: #060812;
  --nero-ai-bg-2: #0b1020;
  --nero-ai-surface: rgba(255, 255, 255, 0.072);
  --nero-ai-surface-2: rgba(255, 255, 255, 0.105);
  --nero-ai-card: rgba(11, 16, 32, 0.78);
  --nero-ai-card-strong: rgba(17, 24, 39, 0.92);
  --nero-ai-text: #e6edf7;
  --nero-ai-muted: #9aa8bd;
  --nero-ai-soft: #c7d2e5;
  --nero-ai-heading: #ffffff;
  --nero-ai-border: rgba(255, 255, 255, 0.12);
  --nero-ai-border-strong: rgba(125, 249, 255, 0.26);
  --nero-ai-primary: #79f2ff;
  --nero-ai-primary-2: #8b5cf6;
  --nero-ai-accent: #22c55e;
  --nero-ai-warn: #f59e0b;
  --nero-ai-danger: #fb7185;
  --nero-ai-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  --nero-ai-shadow-soft: 0 18px 46px rgba(0, 0, 0, 0.25);
  --nero-ai-radius-xl: 32px;
  --nero-ai-radius-lg: 24px;
  --nero-ai-radius-md: 18px;
  --nero-ai-container: 1220px;
}

#primary.nero-ai-home-page,
.nero-ai-home-page {
  min-height: 100vh;
  margin: 0;
  padding: 0;
  overflow-x: hidden;
  color: var(--nero-ai-text);
  background:
    radial-gradient(circle at 12% 7%, rgba(121, 242, 255, 0.18), transparent 28rem),
    radial-gradient(circle at 86% 12%, rgba(139, 92, 246, 0.22), transparent 34rem),
    radial-gradient(circle at 60% 90%, rgba(34, 197, 94, 0.08), transparent 35rem),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}

.nero-ai-home-page *,
.nero-ai-home-page *::before,
.nero-ai-home-page *::after { box-sizing: border-box; }

.nero-ai-home-page :where(section, article, footer, aside, .nero-ai-section) a { color: inherit; }
.nero-ai-home-page p { color: var(--nero-ai-muted); }
.nero-ai-home-page h1,
.nero-ai-home-page h2,
.nero-ai-home-page h3,
.nero-ai-home-page h4 { color: var(--nero-ai-heading); letter-spacing: -0.045em; }

.nero-ai-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.nero-ai-section { padding: clamp(70px, 9vw, 126px) 0; position: relative; }
.nero-ai-section-tight { padding: clamp(48px, 6vw, 82px) 0; }
.nero-ai-section-alt {
  background: linear-gradient(180deg, rgba(255, 255, 255, 0.035), rgba(255, 255, 255, 0.012));
  border-top: 1px solid rgba(255, 255, 255, 0.07);
  border-bottom: 1px solid rgba(255, 255, 255, 0.07);
}

.nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--nero-ai-primary) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}

.nero-ai-section-head {
  max-width: 820px;
  margin: 0 auto 42px;
  text-align: center;
}
.nero-ai-section-head.nero-ai-left { margin-left: 0; text-align: left; }
.nero-ai-section-head h2 {
  margin: 0;
  font-size: clamp(34px, 5vw, 64px);
  line-height: 0.98;
}
.nero-ai-section-head p {
  margin: 18px auto 0;
  max-width: 720px;
  font-size: clamp(16px, 1.7vw, 20px);
  line-height: 1.65;
}
.nero-ai-section-head.nero-ai-left p { margin-left: 0; }

.nero-ai-gradient-text {
  background: linear-gradient(92deg, #ffffff 0%, var(--nero-ai-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}

.nero-ai-btn-row { display: flex; flex-wrap: wrap; gap: 14px; align-items: center; }

.nero-ai-card {
  position: relative;
  border: 1px solid var(--nero-ai-border);
  border-radius: var(--nero-ai-radius-lg);
  background: linear-gradient(180deg, rgba(255, 255, 255, 0.086), rgba(255, 255, 255, 0.044));
  box-shadow: var(--nero-ai-shadow-soft);
  backdrop-filter: blur(18px);
}
.nero-ai-card::before {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: inherit;
  padding: 1px;
  background: linear-gradient(135deg, rgba(121, 242, 255, .34), rgba(139, 92, 246, .14), rgba(34, 197, 94, .12));
  -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
  -webkit-mask-composite: xor;
  mask-composite: exclude;
  pointer-events: none;
  opacity: .75;
}

.nero-ai-automation-map {
  margin-top: 22px;
  padding: 18px;
  border-radius: 22px;
  border: 1px solid rgba(255,255,255,.10);
  background:
    radial-gradient(circle at 50% 50%, rgba(121,242,255,.11), transparent 42%),
    rgba(255,255,255,.035);
}
.nero-ai-map-title { margin: 0 0 14px; color: #dce8f7; font-size: 13px; font-weight: 800; }
.nero-ai-map-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  align-items: center;
  gap: 14px;
}
.nero-ai-people, .nero-ai-processes { display: grid; gap: 10px; }
.nero-ai-person,
.nero-ai-process-node {
  position: relative;
  min-height: 54px;
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.10);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
  cursor: help;
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.nero-ai-person:hover,
.nero-ai-person:focus-visible,
.nero-ai-process-node:hover,
.nero-ai-process-node:focus-visible { transform: translateY(-2px); border-color: rgba(121,242,255,.38); background: rgba(121,242,255,.08); outline: none; }
.nero-ai-person-figure {
  position: relative;
  flex: 0 0 28px;
  width: 28px;
  height: 34px;
}
.nero-ai-person-figure::before {
  content: "";
  position: absolute;
  left: 8px;
  top: 0;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--nero-ai-primary), #c4b5fd);
  box-shadow: 0 0 18px rgba(121,242,255,.25);
}
.nero-ai-person-figure::after {
  content: "";
  position: absolute;
  left: 4px;
  top: 15px;
  width: 20px;
  height: 18px;
  border-radius: 10px 10px 6px 6px;
  background: rgba(255,255,255,.18);
  border: 1px solid rgba(255,255,255,.16);
}
.nero-ai-person span,
.nero-ai-process-node span { display: block; color: #e7f0fb; font-size: 12px; font-weight: 800; line-height: 1.2; }
.nero-ai-person small,
.nero-ai-process-node small { display: block; margin-top: 3px; color: var(--nero-ai-muted); font-size: 11px; line-height: 1.25; }
.nero-ai-ai-core {
  position: relative;
  display: grid;
  place-items: center;
  min-height: 270px;
}
.nero-ai-core-ring {
  position: absolute;
  inset: 18px;
  border-radius: 50%;
  border: 1px dashed rgba(121,242,255,.28);
  animation: neroAiRotate 18s linear infinite;
}
.nero-ai-core-ring:nth-child(2) { inset: 42px; animation-duration: 12s; animation-direction: reverse; opacity: .75; }
@keyframes neroAiRotate { to { transform: rotate(360deg); } }
.nero-ai-core-chip {
  position: relative;
  z-index: 1;
  width: 120px;
  height: 120px;
  display: grid;
  place-items: center;
  border-radius: 34px;
  border: 1px solid rgba(121,242,255,.34);
  background: linear-gradient(135deg, rgba(121,242,255,.22), rgba(139,92,246,.18));
  box-shadow: 0 0 55px rgba(121,242,255,.18), inset 0 0 36px rgba(255,255,255,.06);
}
.nero-ai-core-chip strong { display: block; color: #fff; font-size: 24px; line-height: 1; }
.nero-ai-core-chip span { display: block; margin-top: 6px; color: #c7d2fe; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: .1em; }
.nero-ai-flow-line {
  position: absolute;
  height: 2px;
  width: 54%;
  background: linear-gradient(90deg, transparent, rgba(121,242,255,.65), transparent);
  animation: neroAiFlow 1.7s ease-in-out infinite;
}
.nero-ai-flow-line:nth-child(3) { top: 34%; transform: rotate(18deg); }
.nero-ai-flow-line:nth-child(4) { top: 62%; transform: rotate(-16deg); animation-delay: .55s; }
@keyframes neroAiFlow { 0% { opacity: .2; filter: blur(0); } 50% { opacity: 1; filter: blur(1px); } 100% { opacity: .2; filter: blur(0); } }

.nero-ai-grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
.nero-ai-grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
.nero-ai-grid-4 { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; }

.nero-ai-service-card,
.nero-ai-pain-card,
.nero-ai-trend-card,
.nero-ai-niche-card,
.nero-ai-result-card {
  padding: 22px;
  min-height: 100%;
  overflow: hidden;
}
.nero-ai-card-icon {
  display: grid;
  place-items: center;
  width: 44px;
  height: 44px;
  margin-bottom: 18px;
  border-radius: 16px;
  background: linear-gradient(135deg, rgba(121,242,255,.16), rgba(139,92,246,.14));
  color: var(--nero-ai-primary);
  font-size: 21px;
}
.nero-ai-card h3 { margin: 0 0 10px; font-size: 20px; line-height: 1.08; }
.nero-ai-card p { margin: 0; font-size: 15px; line-height: 1.58; }
.nero-ai-card small { display: block; margin-top: 14px; color: #c7d2fe; font-size: 12px; font-weight: 800; }
.nero-ai-pain-card { display: flex; gap: 13px; align-items: flex-start; }
.nero-ai-pain-card::after {
  content: "";
  position: absolute;
  right: -32px;
  top: -32px;
  width: 120px;
  height: 120px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(251,113,133,.16), transparent 66%);
}
.nero-ai-pain-mark {
  flex: 0 0 30px;
  display: grid;
  place-items: center;
  width: 30px;
  height: 30px;
  border-radius: 12px;
  background: rgba(251,113,133,.12);
  color: #fecdd3;
  font-weight: 900;
}

.nero-ai-center-flow {
  display: grid;
  gap: 12px;
}
.nero-ai-flow-step {
  display: grid;
  grid-template-columns: 74px 1fr;
  gap: 16px;
  padding: 16px;
  border: 1px solid rgba(255,255,255,.10);
  border-radius: 20px;
  background: rgba(255,255,255,.045);
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.nero-ai-flow-step:hover,
.nero-ai-flow-step:focus-within { transform: translateX(4px); border-color: rgba(121,242,255,.35); background: rgba(121,242,255,.065); }
.nero-ai-step-kicker {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  height: 34px;
  border-radius: 999px;
  background: rgba(121,242,255,.10);
  color: var(--nero-ai-primary);
  font-size: 12px;
  font-weight: 900;
}
.nero-ai-flow-step h3 { margin: 0 0 6px; font-size: 18px; }
.nero-ai-flow-step p { margin: 0; font-size: 14px; line-height: 1.55; }

.nero-ai-process-list { counter-reset: neroAiStep; display: grid; gap: 14px; }
.nero-ai-process-item {
  counter-increment: neroAiStep;
  display: grid;
  grid-template-columns: 62px 1fr;
  gap: 18px;
  padding: 20px;
}
.nero-ai-process-item::before {
  content: counter(neroAiStep, decimal-leading-zero);
  display: grid;
  place-items: center;
  width: 52px;
  height: 52px;
  border-radius: 18px;
  background: linear-gradient(135deg, rgba(121,242,255,.18), rgba(34,197,94,.12));
  color: var(--nero-ai-primary);
  font-weight: 950;
}
.nero-ai-process-item h3 { margin: 0 0 6px; font-size: 19px; }
.nero-ai-process-item p { margin: 0; line-height: 1.58; }

.nero-ai-kpi-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
.nero-ai-kpi-card { padding: 24px; }
.nero-ai-kpi-value { display: block; color: #fff; font-size: clamp(36px, 5vw, 62px); font-weight: 950; letter-spacing: -0.06em; line-height: .9; }
.nero-ai-kpi-label { display: block; margin-top: 10px; color: var(--nero-ai-muted); font-weight: 750; }
.nero-ai-bars { display: grid; gap: 12px; margin-top: 20px; }
.nero-ai-bar-row { display: grid; grid-template-columns: 74px 1fr 48px; gap: 10px; align-items: center; color: var(--nero-ai-muted); font-size: 12px; font-weight: 800; }
.nero-ai-bar-track { height: 10px; border-radius: 999px; background: rgba(255,255,255,.08); overflow: hidden; }
.nero-ai-bar-fill { height: 100%; border-radius: inherit; background: linear-gradient(90deg, var(--nero-ai-primary-2), var(--nero-ai-primary)); transform-origin: left; animation: neroAiBar .9s ease-out both; }
@keyframes neroAiBar { from { transform: scaleX(0); } to { transform: scaleX(1); } }

.nero-ai-seo-box {
  padding: clamp(26px, 4vw, 46px);
  border-radius: var(--nero-ai-radius-xl);
  border: 1px solid rgba(255,255,255,.10);
  background: linear-gradient(135deg, rgba(121,242,255,.07), rgba(139,92,246,.06), rgba(255,255,255,.035));
}
.nero-ai-seo-box h2 { margin: 0 0 20px; font-size: clamp(30px, 4vw, 52px); }
.nero-ai-seo-box p { margin: 0 0 16px; font-size: 17px; line-height: 1.72; }
.nero-ai-seo-box p:last-child { margin-bottom: 0; }

.nero-ai-faq { display: grid; gap: 12px; }
.nero-ai-faq details {
  border: 1px solid rgba(255,255,255,.10);
  border-radius: 18px;
  background: rgba(255,255,255,.045);
  overflow: hidden;
}
.nero-ai-faq summary {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  padding: 18px 20px;
  color: #fff;
  cursor: pointer;
  font-weight: 850;
  list-style: none;
}
.nero-ai-faq summary::-webkit-details-marker { display: none; }
.nero-ai-faq summary::after { content: "+"; color: var(--nero-ai-primary); font-size: 22px; line-height: 1; }
.nero-ai-faq details[open] summary::after { content: "−"; }
.nero-ai-faq details p { margin: 0; padding: 0 20px 18px; line-height: 1.62; }

.nero-ai-final-cta {
  padding: clamp(34px, 5vw, 58px);
  border-radius: 34px;
  overflow: hidden;
  background:
    radial-gradient(circle at 15% 20%, rgba(121,242,255,.18), transparent 34%),
    radial-gradient(circle at 80% 10%, rgba(139,92,246,.18), transparent 34%),
    linear-gradient(135deg, rgba(255,255,255,.09), rgba(255,255,255,.04));
}
.nero-ai-final-cta h2 { margin: 0; max-width: 850px; font-size: clamp(34px, 5.2vw, 70px); line-height: .96; }
.nero-ai-final-cta p { margin: 18px 0 0; max-width: 760px; font-size: 18px; line-height: 1.65; }
.nero-ai-final-cta .nero-ai-btn-row { margin-top: 30px; }

[data-nero-tooltip] { position: relative; }
[data-nero-tooltip]::after {
  content: attr(data-nero-tooltip);
  position: absolute;
  left: 50%;
  bottom: calc(100% + 12px);
  width: min(280px, 80vw);
  transform: translate(-50%, 8px);
  z-index: 20;
  padding: 12px 13px;
  border: 1px solid rgba(121,242,255,.22);
  border-radius: 14px;
  background: rgba(5, 8, 18, .96);
  box-shadow: var(--nero-ai-shadow-soft);
  color: #eaf3ff;
  font-size: 12px;
  line-height: 1.45;
  opacity: 0;
  pointer-events: none;
  transition: opacity .18s ease, transform .18s ease;
}
[data-nero-tooltip]:hover::after,
[data-nero-tooltip]:focus-visible::after,
[data-nero-tooltip].nero-ai-tooltip-active::after { opacity: 1; transform: translate(-50%, 0); }

.nero-ai-reveal { opacity: 0; transform: translateY(28px); transition: opacity .72s ease, transform .72s ease; }
.nero-ai-reveal.nero-ai-active { opacity: 1; transform: translateY(0); }
.nero-ai-delay-1 { transition-delay: .08s; }
.nero-ai-delay-2 { transition-delay: .16s; }
.nero-ai-delay-3 { transition-delay: .24s; }
.nero-ai-delay-4 { transition-delay: .32s; }

@media (max-width: 1100px) {
    .nero-ai-grid-4 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .nero-ai-grid-3 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 820px) {
  .nero-ai-container { width: min(100% - 28px, var(--nero-ai-container)); }
    .nero-ai-map-grid { grid-template-columns: 1fr; }
  .nero-ai-ai-core { min-height: 210px; }
  .nero-ai-grid-2,
  .nero-ai-grid-3,
  .nero-ai-grid-4,
  .nero-ai-kpi-grid { grid-template-columns: 1fr; }
  .nero-ai-metrics-grid { grid-template-columns: 1fr; }
  .nero-ai-flow-step { grid-template-columns: 1fr; }
  .nero-ai-process-item { grid-template-columns: 1fr; }
  .nero-ai-btn-row { align-items: stretch; }
  .nero-ai-home-page .nero-ai-btn { width: 100%; }
}
@media (max-width: 520px) {
    .nero-ai-section { padding: 58px 0; }
}
@media (prefers-reduced-motion: reduce) {
  .nero-ai-home-page *,
  .nero-ai-home-page *::before,
  .nero-ai-home-page *::after { animation: none !important; transition: none !important; scroll-behavior: auto !important; }
  .nero-ai-reveal { opacity: 1; transform: none; }
}


/* Page shell + theme reset */
.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs, .yoast-breadcrumb,
.entry-header, .page-title-section { display: none !important; }

#primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}

/* Шапка как на главной: скрываем Kadence, показываем .nero-ai-header */
body.nero-ai-landing-shell #masthead,
body.nero-ai-landing-shell #mobile-header {
  display: none !important;
}
body.nero-ai-landing-shell {
  padding-top: 0 !important;
}

.ym-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

/* Intro after hero */
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro {
  padding: clamp(48px, 6vw, 72px) 0 clamp(28px, 4vw, 40px);
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__grid {
  display: grid;
  grid-template-columns: minmax(0, 1.15fr) minmax(280px, 0.85fr);
  gap: clamp(24px, 4vw, 40px);
  align-items: start;
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__text {
  text-align: left !important;
  border-left: 4px solid var(--nero-ai-primary);
  padding-left: clamp(18px, 3vw, 28px);
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__text p {
  text-align: left !important;
  margin: 0 0 16px;
  font-size: clamp(16px, 1.6vw, 18px);
  line-height: 1.65;
  color: var(--nero-ai-soft) !important;
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__text p:last-child { margin-bottom: 0; }
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__lead {
  font-size: clamp(17px, 1.8vw, 20px) !important;
  color: var(--nero-ai-heading) !important;
  font-weight: 650;
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__terminal {
  padding: 18px;
  border-radius: 20px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.10);
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__terminal-head {
  display: flex;
  gap: 6px;
  margin-bottom: 14px;
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__terminal-head span {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(255,255,255,.22);
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__terminal-head span:nth-child(1) { background: #fb7185; }
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__terminal-head span:nth-child(2) { background: #fbbf24; }
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__terminal-head span:nth-child(3) { background: #34d399; }
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 14px;
  padding: 0;
  list-style: none;
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__chips li {
  padding: 7px 11px;
  border-radius: 999px;
  border: 1px solid rgba(121,242,255,.22);
  background: rgba(121,242,255,.08);
  color: var(--nero-ai-primary) !important;
  font-size: 12px;
  font-weight: 700;
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__metric {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__metric div {
  padding: 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.08);
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__metric strong {
  display: block;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__metric span {
  display: block;
  margin-top: 6px;
  font-size: 11px;
  color: var(--nero-ai-muted);
  font-weight: 700;
}

/* TOC */
.nero-ai-toc-wrap {
  display: flex;
  justify-content: center;
  padding: 0 0 clamp(36px, 5vw, 52px);
}
.nero-ai-toc {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 10px;
  max-width: 980px;
  margin: 0;
  padding: 0;
  list-style: none;
}
.nero-ai-toc a {
  display: inline-flex;
  align-items: center;
  padding: 10px 14px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.12);
  background: rgba(255,255,255,.05);
  color: var(--nero-ai-soft) !important;
  font-size: 13px;
  font-weight: 700;
  text-decoration: none !important;
  transition: border-color .2s, background .2s;
}
.nero-ai-toc a:hover,
.nero-ai-toc a:focus-visible {
  border-color: rgba(121,242,255,.36);
  background: rgba(121,242,255,.08);
}

/* Prose */
.nero-ai-prose {
  max-width: 820px;
}
.nero-ai-prose h2 {
  margin: 0 0 18px;
  font-size: clamp(28px, 3.6vw, 42px);
  line-height: 1.08;
}
.nero-ai-prose h3 {
  margin: 28px 0 12px;
  font-size: clamp(20px, 2.2vw, 26px);
  line-height: 1.15;
}
.nero-ai-prose p,
.nero-ai-prose li {
  font-size: 16px;
  line-height: 1.68;
}
.nero-ai-prose ul,
.nero-ai-prose ol {
  margin: 14px 0;
  padding-left: 22px;
}
.nero-ai-prose strong { color: var(--nero-ai-heading); }
.nero-ai-prose a {
  color: var(--nero-ai-primary) !important;
  text-decoration: underline;
  text-underline-offset: 3px;
}
.nero-ai-prose hr {
  border: none;
  border-top: 1px solid rgba(255,255,255,.08);
  margin: 28px 0;
}
.nero-ai-prose em { color: var(--nero-ai-muted); }

.nero-ai-table-wrap {
  overflow-x: auto;
  margin: 18px 0 22px;
  border-radius: 16px;
  border: 1px solid rgba(255,255,255,.10);
}
.nero-ai-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}
.nero-ai-table th,
.nero-ai-table td {
  padding: 12px 14px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  text-align: left;
  vertical-align: top;
}
.nero-ai-table th {
  background: rgba(255,255,255,.05);
  color: var(--nero-ai-heading);
  font-weight: 800;
}
.nero-ai-table tr:last-child td { border-bottom: none; }

.nero-ai-inline-cta {
  margin: 28px 0;
  padding: clamp(22px, 3vw, 32px);
}
.nero-ai-inline-cta h3 {
  margin: 0 0 10px;
  font-size: clamp(22px, 2.4vw, 28px);
}
.nero-ai-inline-cta p { margin: 0 0 16px; }

.nero-ai-secondary-cta {
  margin: 16px 0 0;
  padding: 14px 16px;
  border-left: 3px solid var(--nero-ai-primary-2);
  background: rgba(139,92,246,.08);
  border-radius: 0 12px 12px 0;
}
.nero-ai-text-link {
  color: var(--nero-ai-primary) !important;
  font-weight: 800;
  text-decoration: underline;
}

.nero-ai-split {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 16px;
  margin: 22px 0;
}
.nero-ai-split .nero-ai-card { padding: 18px; }
.nero-ai-split h4 { margin: 0 0 8px; font-size: 17px; }

.nero-ai-summary {
  margin-top: 24px;
  padding: 20px 22px;
  border-radius: 18px;
  border: 1px solid rgba(34,197,94,.22);
  background: rgba(34,197,94,.08);
}
.nero-ai-summary p { margin: 0; color: var(--nero-ai-soft) !important; }

@media (max-width: 900px) {
  .vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__grid { grid-template-columns: 1fr; }
  .nero-ai-split { grid-template-columns: 1fr; }
}


</style>

<main id="primary" class="site-main vnedrenie-ai-generator-kommercheskih-predlozheniy-page nero-ai-home-page" role="main" tabindex="-1">
<?php
$nero_header = get_stylesheet_directory() . '/partials/nero-ai-site-header.php';
if (is_readable($nero_header)) {
    require $nero_header;
}
?>
<?php
$hero_eyebrow = 'AI-генератор КП · B2B-продажи';
$hero_title = 'AI-генератор коммерческих предложений по брифу клиента — внедрение под ключ';
$hero_title_id = 'vnedrenie-ai-kp-hero-title';
$hero_lead = 'AI создаёт персональное КП за 2–5 минут на основе заявки и истории общения — без шаблонных текстов';
$hero_badges = [
    'Бриф клиента',
    'RAG + CRM',
    'Черновик 2–5 мин',
    'Правка менеджера',
    'PDF в CRM',
];
$hero_primary_label = 'Собрать пример КП';
$hero_primary_url = '#demo-primer-kp';
$hero_secondary_label = getenv('SECONDARY_CTA_LABEL') ?: 'Что можно автоматизировать';
$hero_secondary_url = getenv('SECONDARY_CTA_URL') ?: home_url('/#services');
$hero_dashboard_title = 'Генератор КП · операционный центр';
$hero_dashboard_note = 'пример логики AI-генератора · демонстрационные данные';
$hero_metrics = [
    ['value' => '3:24', 'label' => 'TTQ черновика*'],
    ['value' => '14%', 'label' => 'edit rate AI-текста'],
    ['value' => '18', 'label' => 'КП за неделю'],
    ['value' => '−62%', 'label' => 'время подготовки*'],
];
$hero_feed = [
    ['dot' => 'blue', 'text' => 'Бриф из формы + amoCRM → AI собрал контекст переписки'],
    ['dot' => 'green', 'text' => 'RAG: 3 кейса и прайс подобраны → блок «понимание задачи»'],
    ['dot' => 'amber', 'text' => 'Черновик КП за 3 мин → статус «На согласовании»'],
    ['dot' => 'green', 'text' => 'Менеджер правит 12% текста → PDF прикреплён к сделке'],
];
$hero_partial = get_stylesheet_directory() . '/partials/nero-ai-longread-hero-shell.php';
if (is_readable($hero_partial)) {
    require $hero_partial;
}
?>

  <section class="nero-ai-section-tight vnedrenie-ai-generator-kommercheskih-predlozheniy-intro" aria-label="Введение">
    <div class="nero-ai-container">
      <div class="vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__grid nero-ai-reveal">
        <div class="vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__text">
          <p class="vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__lead"><strong>Коротко:</strong> <strong>AI-генератор коммерческих предложений</strong> — внедряемая система, которая превращает бриф клиента, поля CRM и историю переписки в персональное <strong>ai коммерческое предложение</strong> за 2–5 минут. Это не «скопируйте промпт в ChatGPT», а <strong>ai агент для подготовки документов</strong> с доступом к вашим прайсам, кейсам и шаблонам — с обязательной проверкой менеджером перед отправкой.</p>
          <p>Nero Network внедряет <strong>ai генератор кп</strong> под ключ: от аудита текущих шаблонов до пилота с измеримыми KPI — временем подготовки (TTQ), долей персонализированных блоков и конверсией КП → следующий этап сделки.</p>
        </div>
        <div class="vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__terminal nero-ai-reveal nero-ai-delay-1" aria-hidden="true">
          <div class="vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__terminal-head"><span></span><span></span><span></span></div>
          <ul class="vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__chips">
            <li>2–5 мин КП</li>
            <li>RAG + CRM</li>
            <li>amoCRM / Bitrix24</li>
            <li>Human-in-the-loop</li>
          </ul>
          <div class="vnedrenie-ai-generator-kommercheskih-predlozheniy-intro__metric">
            <div><strong data-nero-count="62" data-nero-prefix="−" data-nero-suffix="%">−0%</strong><span>время подготовки КП*</span></div>
            <div><strong>3:24</strong><span>TTQ черновика (демо)</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <nav class="nero-ai-toc-wrap" aria-label="Оглавление">
    <ul class="nero-ai-toc nero-ai-reveal">
      <li><a href="#b2b-poterya-sdelok">Почему B2B теряет сделки</a></li>
      <li><a href="#chto-takoe-ai-generator-kp">Что такое AI-генератор КП</a></li>
      <li><a href="#process-2-5-minut">Как AI создаёт КП за 2–5 минут</a></li>
      <li><a href="#vnedrenie-pod-klyuch">Внедрение под ключ</a></li>
      <li><a href="#integraciya-crm">Интеграция с CRM</a></li>
      <li><a href="#segmenty-b2b">Сегменты B2B</a></li>
      <li><a href="#ai-generator-smeti">AI-генератор сметы</a></li>
      <li><a href="#cena-vnedreniya">Сколько стоит</a></li>
      <li><a href="#keisy-metriki">Кейсы и метрики</a></li>
      <li><a href="#faq">FAQ</a></li>
      <li><a href="#demo-primer-kp">Соберите пример КП</a></li>
    </ul>
  </nav>

  <section id="b2b-poterya-sdelok" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Почему B2B теряет сделки из‑за медленных и шаблонных КП</h2>
      <p><strong>Определение проблемы:</strong> в B2B-продажах коммерческое предложение — не формальность, а точка, где клиент решает, доверять ли вам бюджет. Когда <strong>долго готовить коммерческое предложение</strong>, лид остывает; когда документ <strong>шаблонное коммерческое предложение</strong> без привязки к его задаче — конверсия падает ещё до переговоров.</p>

      <h3>Сколько времени уходит на одно КП в отделе продаж</h3>
      <p>На одно КП в среднем B2B-команде уходит <strong>от 3 до 6 часов</strong>: менеджер собирает данные из CRM, почты, Google Drive, сверяет прайс, ищет кейсы, согласует с техспециалистом и только потом собирает PDF. В кейсе Cortex Intellect × AvadaCRM заявлено <strong>1–4 часа</strong> на одно КП при разрозненных источниках данных (<a href="https://cortexintellect.com/ru/portfolio/ai-agent-for-project-estimation-and-proposals/" rel="noopener noreferrer" target="_blank">источник</a>).</p>
      <p>По <a href="https://www.qorusdocs.com/blog/proposal-management-benchmark-proposal-work-as-a-revenue-function" rel="noopener noreferrer" target="_blank">QorusDocs Proposal Benchmark 2025</a> более половины команд тратят <strong>6–10 дней</strong> на средний RFP, а <strong>56%</strong> привлекают <strong>6–15 участников</strong> к подготовке ответа.</p>

      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Этап ручного КП</th><th>Типичное время</th><th>Где теряется качество</th></tr></thead>
          <tbody>
            <tr><td>Сбор данных из CRM, почты, чатов</td><td>40–90 мин</td><td>Пропуск деталей из переписки</td></tr>
            <tr><td>Подбор кейсов и аргументов</td><td>30–60 мин</td><td>Копирование «универсальных» блоков</td></tr>
            <tr><td>Расчёт сметы и согласование</td><td>60–120 мин</td><td>Ошибки в прайсе, задержка ответа</td></tr>
            <tr><td>Вёрстка и внутреннее согласование</td><td>30–60 мин</td><td>Юридические правки в последний момент</td></tr>
            <tr><td><strong>Итого</strong></td><td><strong>3–6 ч и более</strong></td><td>Клиент уже получил КП конкурента</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Когда «универсальный прайс» не продаёт интегратору и производству</h3>
      <p><strong>ai коммерческое предложение для бизнеса</strong> в сложных нишах не сводится к прайс-листу. IT-интегратору нужны этапы, лицензии, архитектура; производству — номенклатура, сроки, логистика; агентству — пакеты услуг под конкретную воронку клиента.</p>
      <p>По данным <a href="https://www.iconiq.com/growth/reports/state-of-go-to-market-2025" rel="noopener noreferrer" target="_blank">ICONIQ State of GTM 2025</a>, <strong>около 70%</strong> компаний уже внедряют AI в GTM-процессы.</p>

      <h3>Цена задержки: клиент успевает получить КП от конкурента</h3>
      <p><strong>Персональное кп для клиента</strong>, отправленное в день запроса, конкурирует не только по цене, но и по скорости реакции. <strong>b2b коммерческое предложение автоматизация</strong> перестаёт быть «удобством» и становится условием выживания в воронке.</p>
      <div class="nero-ai-summary"><p><strong>Итог блока:</strong> медленные и одинаковые КП — прямая причина <strong>потери сделок</strong>. <strong>Автоматизация коммерческих предложений</strong> через <strong>нейросеть для кп</strong>, подключённую к вашим данным, сокращает time-to-quote без потери контроля качества.</p></div>
    </div>
  </section>

  <section id="chto-takoe-ai-generator-kp" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Что такое AI-генератор коммерческих предложений по брифу</h2>
      <p><strong>Определение:</strong> <strong>AI-генератор коммерческих предложений по брифу</strong> — внедряемая система (агент + интеграции + база знаний), которая автоматизирует цепочку: <strong>заявка/бриф → сбор контекста из CRM → подбор кейсов и цен → черновик КП → согласование → PDF/отправка</strong>.</p>

      <h3>От шаблона Word к персональному документу за минуты</h3>
      <p>Классический процесс: менеджер открывает <strong>ai шаблон коммерческого предложения</strong> в Word, вручную подставляет имя клиента. <strong>Ai генератор кп</strong> работает иначе: на входе — структурированный <strong>ai кп по брифу</strong>, на выходе — документ с блоками «понимание задачи», решение, смета, кейсы и следующий шаг.</p>
      <p>По данным практики CRM AI (<a href="https://crmai.kz/blog/ai-generatsiya-kommercheskikh-predlozheniy-crm" rel="noopener noreferrer" target="_blank">crmai.kz</a>), время подготовки на пилоте снижалось <strong>с ~40 минут до ~2 минут</strong> на черновик — иллюстративный ориентир для вашего пилота.</p>

      <h3>Чем AI-генератор отличается от «просто ChatGPT в браузере»</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Критерий</th><th>ChatGPT в браузере</th><th>AI-генератор КП под ключ</th></tr></thead>
          <tbody>
            <tr><td>Контекст CRM и переписки</td><td>Нет автоматического доступа</td><td>Webhooks, поля сделки, история писем</td></tr>
            <tr><td>Прайс и кейсы</td><td>Ручное копирование</td><td>RAG по approved-базе</td></tr>
            <tr><td>Триггер из воронки</td><td>Нет</td><td>Кнопка или смена этапа «Подготовка КП»</td></tr>
            <tr><td>Guardrails на цены</td><td>Нет</td><td>Запрет выдуманных сумм, проверка секций</td></tr>
            <tr><td>KPI</td><td>Не измеряется</td><td>TTQ, edit rate, conversion quote→deal</td></tr>
            <tr><td><strong>openai agents документы</strong></td><td>Ручной промпт</td><td><strong>function_tool</strong>, <strong>FileSearchTool</strong>, handoffs (<a href="https://openai.github.io/openai-agents-python/tools/" rel="noopener noreferrer" target="_blank">OpenAI Agents SDK</a>)</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Какие данные нужны на входе: заявка, бриф, история переписки</h3>
      <ol>
        <li><strong>Бриф</strong> — явный (форма, квиз) или собранный AI-ассистентом в чате.</li>
        <li><strong>CRM-карточка</strong> — компания, контакт, этап, бюджет, отрасль.</li>
        <li><strong>История переписки</strong> — последние письма, заметки, транскрипт звонка (опционально).</li>
        <li><strong>Корпоративная база</strong> — прайс, кейсы, регламенты скидок, брендбук.</li>
      </ol>
      <p><strong>Коммерческое предложение по истории переписки</strong> становится точнее, когда агент цитирует формулировки боли клиента — это основа <strong>ai персонализация кп</strong>.</p>
    </div>
  </section>
<!-- BORIS_INSERT_ANCHOR: после H2 «Что такое AI-генератор коммерческих предложений по брифу» (§2), перед H2 «Как AI создаёт персональное КП за 2–5 минут: пошаговый процесс» -->
<section id="vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block" class="boris-kp-pipeline" aria-labelledby="boris-kp-pipeline-title">
<style>
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block.boris-kp-pipeline {
    margin: 48px 0 56px;
    padding: 0;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 42%, #ecfdf5 100%);
    border: 1px solid rgba(15, 23, 42, 0.08);
    border-radius: 22px;
    box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
    padding: clamp(24px, 4vw, 40px);
    overflow: hidden;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__grid {
    display: grid;
    grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr);
    gap: clamp(24px, 4vw, 40px);
    align-items: center;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__eyebrow {
    margin: 0 0 10px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #059669;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__title {
    margin: 0 0 12px;
    font-size: clamp(22px, 2.4vw, 28px);
    line-height: 1.2;
    letter-spacing: -0.03em;
    color: #0f172a;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__lead {
    margin: 0 0 18px;
    color: #475569;
    font-size: 15px;
    line-height: 1.55;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__steps {
    margin: 0 0 20px;
    padding: 0;
    list-style: none;
    display: grid;
    gap: 8px;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__steps li {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    font-size: 13px;
    line-height: 1.45;
    color: #334155;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__step-num {
    flex: 0 0 24px;
    height: 24px;
    border-radius: 999px;
    background: #d1fae5;
    color: #047857;
    font-size: 11px;
    font-weight: 700;
    display: grid;
    place-items: center;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 999px;
    background: #fff;
    border: 1px solid rgba(15, 23, 42, 0.08);
    font-size: 12px;
    font-weight: 600;
    color: #0f172a;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__pill-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.18);
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__pill--sky .boris-kp-pipeline__pill-dot { background: #0ea5e9; box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.18); }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__pill--violet .boris-kp-pipeline__pill-dot { background: #8b5cf6; box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.18); }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__bridge {
    margin: 16px 0 0;
    font-size: 13px;
    color: #64748b;
    font-style: italic;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__viz {
    position: relative;
    min-height: 420px;
    border-radius: 18px;
    background: #fff;
    border: 1px solid rgba(15, 23, 42, 0.06);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9);
    overflow: hidden;
  }
  #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block #kp-brief-to-doc-boris-canvas {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 420px;
  }
  @media (max-width: 1023px) {
    #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__grid {
      grid-template-columns: 1fr;
    }
    #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block .boris-kp-pipeline__viz {
      min-height: 360px;
    }
    #vnedrenie-ai-generator-kommercheskih-predlozheniy-boris-block #kp-brief-to-doc-boris-canvas {
      min-height: 360px;
    }
  }
</style>

  <div class="ym-container boris-kp-pipeline__card">
    <div class="boris-kp-pipeline__grid">
      <div class="boris-kp-pipeline__copy">
        <p class="boris-kp-pipeline__eyebrow">Архитектура генерации КП</p>
        <h3 id="boris-kp-pipeline-title" class="boris-kp-pipeline__title">Бриф → RAG → агент → DOCX → CRM</h3>
        <p class="boris-kp-pipeline__lead">AI-генератор — не «один промпт в ChatGPT». Это цепочка: контекст клиента подтягивается из базы знаний, агент собирает структуру сильного КП, экспортирует DOCX и прикрепляет файл к сделке.</p>
        <ol class="boris-kp-pipeline__steps">
          <li><span class="boris-kp-pipeline__step-num">1</span><span><strong>Бриф</strong> — заявка, поля CRM, история переписки и ниша клиента.</span></li>
          <li><span class="boris-kp-pipeline__step-num">2</span><span><strong>RAG</strong> — шаблоны, прайс, кейсы и условия из векторной базы.</span></li>
          <li><span class="boris-kp-pipeline__step-num">3</span><span><strong>Агент</strong> — LLM собирает блоки: проблема → решение → смета → CTA.</span></li>
          <li><span class="boris-kp-pipeline__step-num">4</span><span><strong>DOCX</strong> — персонализированный документ с брендингом компании.</span></li>
          <li><span class="boris-kp-pipeline__step-num">5</span><span><strong>CRM</strong> — файл КП, статус «на согласовании», задача менеджеру.</span></li>
        </ol>
        <div class="boris-kp-pipeline__pills" aria-hidden="true">
          <span class="boris-kp-pipeline__pill"><span class="boris-kp-pipeline__pill-dot"></span>2–5 мин цикл</span>
          <span class="boris-kp-pipeline__pill boris-kp-pipeline__pill--sky"><span class="boris-kp-pipeline__pill-dot"></span>RAG · 120+ чанков</span>
          <span class="boris-kp-pipeline__pill boris-kp-pipeline__pill--violet"><span class="boris-kp-pipeline__pill-dot"></span>DOCX + amoCRM</span>
        </div>
        <p class="boris-kp-pipeline__bridge">Дальше разберём каждый этап — от сбора контекста до правок менеджера перед отправкой.</p>
      </div>
      <div class="boris-kp-pipeline__viz" aria-hidden="true">
        <canvas id="kp-brief-to-doc-boris-canvas" role="img" aria-label="Анимация: бриф клиента проходит через RAG и AI-агента, превращается в DOCX и прикрепляется к сделке в CRM"></canvas>
      </div>
    </div>
  </div>

<script id="kp-brief-to-doc-boris-engine">
(function () {
  var canvas = document.getElementById('kp-brief-to-doc-boris-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var cw = 0, ch = 0, frame = 0;

  var COL = {
    ink: '#0f172a',
    muted: '#64748b',
    line: '#cbd5e1',
    emerald: '#10b981',
    emeraldSoft: '#d1fae5',
    sky: '#0ea5e9',
    skySoft: '#e0f2fe',
    violet: '#8b5cf6',
    violetSoft: '#ede9fe',
    amber: '#f59e0b',
    amberSoft: '#fef3c7',
    rose: '#f43f5e',
    card: '#ffffff',
    cardBorder: '#e2e8f0'
  };

  var STAGES = [
    { key: 'brief', label: 'Бриф', sub: 'контекст клиента', color: COL.sky },
    { key: 'rag', label: 'RAG', sub: 'база знаний', color: COL.emerald },
    { key: 'agent', label: 'Агент', sub: 'сборка КП', color: COL.violet },
    { key: 'docx', label: 'DOCX', sub: 'документ', color: COL.amber },
    { key: 'crm', label: 'CRM', sub: 'сделка', color: COL.rose }
  ];

  var ragChips = ['Шаблон', 'Прайс', 'Кейс', 'Условия'];
  var agentBlocks = ['Проблема', 'Решение', 'Смета', 'CTA'];
  var docxLines = [
    'КП для ООО «СтройМастер»',
    'Задача: ремонт офиса 120 м²',
    'Срок: 6 недель · бюджет 890 000 ₽',
    'Следующий шаг: созвон 15 мин'
  ];

  function resize() {
    var parent = canvas.parentElement;
    if (!parent) return;
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    cw = parent.clientWidth;
    ch = Math.max(parent.clientHeight, 360);
    canvas.width = Math.floor(cw * dpr);
    canvas.height = Math.floor(ch * dpr);
    canvas.style.width = cw + 'px';
    canvas.style.height = ch + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function rr(x, y, w, h, r, fill, stroke, lw) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else {
      ctx.moveTo(x + r, y);
      ctx.arcTo(x + w, y, x + w, y + h, r);
      ctx.arcTo(x + w, y + h, x, y + h, r);
      ctx.arcTo(x, y + h, x, y, r);
      ctx.arcTo(x, y, x + w, y, r);
    }
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1.5; ctx.stroke(); }
  }

  function txt(str, x, y, size, color, align, weight) {
    ctx.font = (weight || 600) + ' ' + size + 'px Inter, system-ui, sans-serif';
    ctx.fillStyle = color || COL.ink;
    ctx.textAlign = align || 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(str, x, y);
  }

  function stagePositions() {
    var pad = 20;
    var topY = ch * 0.18;
    var nodeW = Math.min(72, (cw - pad * 2) / 5.8);
    var gap = (cw - pad * 2 - nodeW * 5) / 4;
    var xs = [];
    for (var i = 0; i < 5; i++) xs.push(pad + i * (nodeW + gap) + nodeW / 2);
    return { xs: xs, topY: topY, nodeW: nodeW, nodeH: 52, pad: pad };
  }

  function drawConnector(x1, x2, y, progress, color) {
    ctx.strokeStyle = COL.line;
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 5]);
    ctx.beginPath();
    ctx.moveTo(x1, y);
    ctx.lineTo(x2, y);
    ctx.stroke();
    ctx.setLineDash([]);
    if (progress > 0) {
      var px = x1 + (x2 - x1) * Math.min(1, progress);
      ctx.strokeStyle = color;
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.moveTo(x1, y);
      ctx.lineTo(px, y);
      ctx.stroke();
      ctx.fillStyle = color;
      ctx.beginPath();
      ctx.arc(px, y, 4, 0, Math.PI * 2);
      ctx.fill();
    }
  }

  function drawStageBadge(x, y, w, h, stage, active, pulse) {
    var c = stage.color;
    rr(x - w / 2, y, w, h, 12, active ? c + '18' : COL.card, active ? c : COL.cardBorder, active ? 2 : 1);
    rr(x - w / 2 + 8, y + 8, w - 16, 18, 6, active ? c + '33' : '#f8fafc', null);
    txt(stage.label, x, y + 17, 10, active ? c : COL.ink, 'center', 700);
    txt(stage.sub, x, y + h - 10, 8, COL.muted, 'center', 500);
    if (pulse > 0) {
      ctx.strokeStyle = c;
      ctx.globalAlpha = 0.22 * pulse;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(x, y + h / 2, w * 0.62 + pulse * 6, 0, Math.PI * 2);
      ctx.stroke();
      ctx.globalAlpha = 1;
    }
  }

  function drawBriefPanel(cx, cy, w, h, fill) {
    rr(cx - w / 2, cy - h / 2, w, h, 10, COL.card, COL.cardBorder);
    rr(cx - w / 2 + 10, cy - h / 2 + 10, w - 20, 14, 4, COL.skySoft, null);
    txt('Бриф клиента', cx - w / 2 + 10 + (w - 20) / 2, cy - h / 2 + 17, 8, COL.sky, 'center', 700);
    var fields = ['Ниша: B2B', 'Бюджет: 890k', 'Срок: 6 нед'];
    for (var i = 0; i < 3; i++) {
      var fy = cy - h / 2 + 32 + i * 16;
      var fw = (w - 28) * (0.55 + i * 0.12) * fill;
      if (fw > 4) rr(cx - w / 2 + 14, fy, fw, 10, 3, '#f1f5f9', COL.cardBorder);
    }
  }

  function drawRagVault(cx, cy, w, h, chipProgress) {
    rr(cx - w / 2, cy - h / 2, w, h, 10, COL.emeraldSoft, COL.emerald);
    txt('Vector DB', cx, cy - h / 2 + 14, 8, COL.emerald, 'center', 700);
    var offsets = [[-38, -18], [34, -22], [-32, 18], [36, 14]];
    for (var i = 0; i < ragChips.length; i++) {
      var p = Math.max(0, Math.min(1, chipProgress - i * 0.15));
      if (p <= 0) continue;
      var ox = offsets[i][0];
      var oy = offsets[i][1];
      ctx.globalAlpha = p;
      rr(cx + ox - 28, cy + oy - 9, 56, 18, 9, '#fff', COL.emerald);
      txt(ragChips[i], cx + ox, cy + oy, 8, COL.emerald, 'center', 600);
      ctx.globalAlpha = 1;
      if (p > 0.4) {
        ctx.strokeStyle = COL.emerald;
        ctx.globalAlpha = 0.15 * p;
        ctx.beginPath();
        ctx.moveTo(cx + ox, cy + oy - 9);
        ctx.lineTo(cx, cy - h / 2 + 22);
        ctx.stroke();
        ctx.globalAlpha = 1;
      }
    }
  }

  function drawAgentCore(cx, cy, r, spin, blockProgress) {
    ctx.save();
    ctx.translate(cx, cy);
    rr(-r, -r, r * 2, r * 2, 14, COL.violetSoft, COL.violet, 2);
    for (var i = 0; i < 4; i++) {
      ctx.save();
      ctx.rotate(spin + i * (Math.PI / 2));
      rr(-14, -r + 6, 28, 8, 4, COL.violet, null);
      ctx.restore();
    }
    txt('AI', 0, 1, 14, COL.violet, 'center', 800);
    ctx.restore();
    var bOff = [[-52, -28], [48, -24], [-44, 30], [50, 26]];
    for (var j = 0; j < agentBlocks.length; j++) {
      var bp = Math.max(0, Math.min(1, blockProgress - j * 0.18));
      if (bp <= 0) continue;
      ctx.globalAlpha = bp;
      rr(cx + bOff[j][0] - 30, cy + bOff[j][1] - 8, 60, 16, 8, '#fff', COL.violet);
      txt(agentBlocks[j], cx + bOff[j][0], cy + bOff[j][1], 8, COL.violet, 'center', 600);
      ctx.globalAlpha = 1;
    }
  }

  function drawDocxPage(cx, cy, w, h, lineProgress) {
    rr(cx - w / 2, cy - h / 2, w, h, 8, COL.card, COL.cardBorder);
    rr(cx - w / 2, cy - h / 2, w, 16, [8, 8, 0, 0], COL.amberSoft, null);
    txt('КП.docx', cx, cy - h / 2 + 8, 8, COL.amber, 'center', 700);
    for (var i = 0; i < docxLines.length; i++) {
      var lp = Math.max(0, Math.min(1, lineProgress - i * 0.2));
      if (lp <= 0) continue;
      var ly = cy - h / 2 + 28 + i * 18;
      var lw = (w - 24) * lp;
      var isBold = i === 0;
      rr(cx - w / 2 + 12, ly, lw, isBold ? 10 : 8, 3, isBold ? COL.amberSoft : '#f1f5f9', null);
      if (lp > 0.85 && i === docxLines.length - 1) {
        rr(cx - w / 2 + 12, ly + 14, w - 24, 12, 4, COL.emeraldSoft, COL.emerald);
        txt('✓ готово', cx, ly + 20, 7, COL.emerald, 'center', 700);
      }
    }
  }

  function drawCrmDeal(cx, cy, w, h, attachProgress) {
    rr(cx - w / 2, cy - h / 2, w, h, 10, COL.card, COL.cardBorder);
    txt('amoCRM · сделка', cx, cy - h / 2 + 14, 8, COL.muted, 'center', 600);
    rr(cx - w / 2 + 10, cy - h / 2 + 24, w - 20, 22, 6, '#fef2f2', COL.rose);
    txt('СтройМастер · КП', cx, cy - h / 2 + 35, 8, COL.rose, 'center', 700);
    var rows = ['Статус: на согласовании', 'Менеджер: Иванова'];
    for (var i = 0; i < rows.length; i++) {
      txt(rows[i], cx - w / 2 + 14, cy - h / 2 + 58 + i * 14, 7, COL.muted, 'left', 500);
    }
    if (attachProgress > 0) {
      var ay = cy + h / 2 - 28;
      ctx.globalAlpha = attachProgress;
      rr(cx - w / 2 + 10, ay, w - 20, 20, 6, COL.emeraldSoft, COL.emerald);
      txt('📎 КП_СтройМастер.docx', cx, ay + 10, 7, COL.emerald, 'center', 600);
      ctx.globalAlpha = 1;
    }
  }

  function drawPacket(x, y, stageIdx, glow) {
    var colors = [COL.sky, COL.emerald, COL.violet, COL.amber, COL.rose];
    var c = colors[stageIdx] || COL.sky;
    ctx.fillStyle = c;
    ctx.beginPath();
    ctx.moveTo(x, y - 8);
    ctx.lineTo(x + 10, y);
    ctx.lineTo(x, y + 8);
    ctx.lineTo(x - 10, y);
    ctx.closePath();
    ctx.fill();
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 2;
    ctx.stroke();
    if (glow > 0) {
      ctx.strokeStyle = c;
      ctx.globalAlpha = 0.3 * glow;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(x, y, 14 + glow * 6, 0, Math.PI * 2);
      ctx.stroke();
      ctx.globalAlpha = 1;
    }
  }

  function render() {
    ctx.clearRect(0, 0, cw, ch);
    var pos = stagePositions();
    var xs = pos.xs;
    var badgeY = pos.topY;
    var badgeW = pos.nodeW;
    var badgeH = pos.nodeH;
    var pipeY = badgeY + badgeH + 14;

    var cycle = (frame % 480) / 480;
    var t = cycle;

    var activeStage = Math.floor(t * 5);
    if (activeStage > 4) activeStage = 4;

    for (var i = 0; i < 4; i++) {
      var segStart = (i + 0.12) / 5;
      var segEnd = (i + 0.92) / 5;
      var segProg = Math.max(0, Math.min(1, (t - segStart) / (segEnd - segStart)));
      drawConnector(xs[i] + badgeW * 0.42, xs[i + 1] - badgeW * 0.42, pipeY, segProg, STAGES[i + 1].color);
    }

    for (var s = 0; s < 5; s++) {
      var isActive = s === activeStage || (s === activeStage - 1 && t * 5 % 1 > 0.7);
      var pulse = (s === activeStage) ? 0.5 + 0.5 * Math.sin(frame * 0.14) : 0;
      drawStageBadge(xs[s], badgeY, badgeW, badgeH, STAGES[s], isActive || s <= activeStage, pulse);
    }

    var panelY = ch * 0.62;
    var panelW = Math.min(130, cw * 0.22);
    var panelH = 100;

    var briefFill = Math.max(0, Math.min(1, (t - 0.02) / 0.12));
    var ragChip = Math.max(0, Math.min(1, (t - 0.18) / 0.16));
    var agentBlock = Math.max(0, Math.min(1, (t - 0.36) / 0.18));
    var docxLine = Math.max(0, Math.min(1, (t - 0.54) / 0.18));
    var crmAttach = Math.max(0, Math.min(1, (t - 0.72) / 0.2));

    if (t < 0.22) {
      drawBriefPanel(xs[0], panelY, panelW, panelH, briefFill);
    } else if (t < 0.4) {
      drawRagVault(xs[1], panelY, panelW, panelH, ragChip);
    } else if (t < 0.58) {
      drawAgentCore(xs[2], panelY, 38, frame * 0.02, agentBlock);
    } else if (t < 0.76) {
      drawDocxPage(xs[3], panelY, panelW, panelH + 20, docxLine);
    } else {
      drawCrmDeal(xs[4], panelY, panelW, panelH + 16, crmAttach);
    }

    var packetX = xs[0];
    var packetY = pipeY;
    if (t < 0.04) {
      packetX = xs[0];
    } else if (t < 0.2) {
      packetX = xs[0] + (xs[1] - xs[0]) * ((t - 0.04) / 0.16);
    } else if (t < 0.38) {
      packetX = xs[1] + (xs[2] - xs[1]) * ((t - 0.2) / 0.18);
    } else if (t < 0.56) {
      packetX = xs[2] + (xs[3] - xs[2]) * ((t - 0.38) / 0.18);
    } else if (t < 0.74) {
      packetX = xs[3] + (xs[4] - xs[3]) * ((t - 0.56) / 0.18);
    } else {
      packetX = xs[4];
    }
    drawPacket(packetX, packetY, activeStage, 0.4 + 0.3 * Math.sin(frame * 0.1));

    if (t > 0.82 && crmAttach > 0.7) {
      rr(cw / 2 - 105, ch - 32, 210, 22, 11, COL.emeraldSoft, COL.emerald);
      txt('КП прикреплено · задача менеджеру отправить', cw / 2, ch - 21, 8, COL.emerald, 'center', 700);
    }

    frame++;
    requestAnimationFrame(render);
  }

  window.addEventListener('resize', resize);
  resize();
  render();
})();
</script>
</section>
  <section id="process-2-5-minut" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Как AI создаёт персональное КП за 2–5 минут: пошаговый процесс</h2>
      <p><strong>Коротко:</strong> <strong>ai кп за 5 минут</strong> — реалистичный ориентир для черновика; финальная отправка после правок менеджера занимает ещё 15–30 минут.</p>

      <h3>Сбор контекста из формы, CRM и переписки</h3>
      <ol>
        <li><strong>Триггер:</strong> новый лид, смена этапа «Подготовка КП» или кнопка «Сгенерировать КП» в CRM.</li>
        <li><strong>Агент собирает контекст:</strong> поля брифа, последние 10 писем/заметок, данные компании.</li>
        <li><strong>RAG-поиск:</strong> top-3 релевантных кейса, SKU/услуги, условия скидок из approved-базы.</li>
      </ol>

      <h3>Структура сильного КП: проблема → решение → смета → следующий шаг</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Блок</th><th>Содержание</th><th>Источник данных</th></tr></thead>
          <tbody>
            <tr><td>Понимание задачи</td><td>Цитата боли клиента своими словами</td><td>Бриф + переписка</td></tr>
            <tr><td>Решение и логика</td><td>Почему этот подход, этапы</td><td>RAG + регламенты</td></tr>
            <tr><td>Roadmap / этапы</td><td>Сроки, роли, deliverables</td><td>Шаблон ниши</td></tr>
            <tr><td>Смета / пакеты</td><td>Позиции, варианты, итого</td><td>Прайс / 1С / таблица</td></tr>
            <tr><td>Кейсы</td><td>1–3 релевантных доказательства</td><td>RAG-база</td></tr>
            <tr><td>SLA и CTA</td><td>Гарантии, следующий шаг, контакты</td><td>Шаблон бренда</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Персонализация блоков под нишу и тип клиента</h3>
      <p><strong>Ai персонализация кп</strong> — JSON-блоки с правилами: для агентства подставляются пакеты услуг; для интегратора — лицензии и архитектура; для производства — номенклатура и логистика.</p>

      <h3>Согласование и правки менеджером перед отправкой</h3>
      <p><strong>Human-in-the-loop</strong> — архитектурная фича. Статусы в CRM: «Черновик AI» → «На согласовании» → «Одобрено» → «Отправлено». Менеджер правит 5–15 минут; лог правок идёт в дообучение промптов.</p>
      <div class="nero-ai-summary"><p><strong>Итог:</strong> <strong>ai коммерческое предложение</strong> за 2–5 минут — черновик; качество обеспечивают RAG, guardrails и финальный контроль человека.</p></div>
      <aside class="nero-ai-card nero-ai-reveal nero-ai-inline-cta" aria-label="[REDACTED]">
  <p class="nero-ai-eyebrow">Интерактив · 2–5 минут</p>
  <h3>Посмотрите, как AI соберёт черновик КП по вашему брифу</h3>
  <p>Заполните мини-бриф — получите фрагмент персонального коммерческого предложения: блок «понимание задачи» и набросок сметы. Это тот же pipeline, что мы внедряем в CRM с RAG и guardrails.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="[REDACTED]">[REDACTED]</a>
  </div>
</aside>
    </div>
  </section>

  <section id="vnedrenie-pod-klyuch" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Внедрение AI-генератора КП под ключ: этапы и сроки</h2>
      <p><strong>Внедрение ai коммерческое предложение</strong> в Nero Network — проект на <strong>2–6 недель</strong> с чеком <strong>100–250 тыс. ₽</strong>.</p>

      <div class="nero-ai-process-list">
        <div class="nero-ai-card nero-ai-process-item nero-ai-reveal"><h3>Аудит текущих шаблонов и воронки КП</h3><p><strong>3–5 дней:</strong> карта источников данных, 2–3 типовых сценария КП, замер текущего TTQ, инвентаризация шаблонов Word/DOCX.</p></div>
        <div class="nero-ai-card nero-ai-process-item nero-ai-reveal nero-ai-delay-1"><h3>Проектирование промптов, структуры и правил персонализации</h3><p>JSON-схема блоков, промпт-пакет по нишам и guardrails: запрет выдуманных цен, обязательные секции, тон бренда.</p></div>
        <div class="nero-ai-card nero-ai-process-item nero-ai-reveal nero-ai-delay-2"><h3>Подключение к CRM, почте и формам заявок</h3><p>Webhooks amoCRM/Bitrix24, почта, Telegram-уведомления, экспорт DOCX/PDF. Старт через n8n/Make возможен для простых сценариев.</p></div>
        <div class="nero-ai-card nero-ai-process-item nero-ai-reveal nero-ai-delay-3"><h3>Пилот на одной нише и масштабирование</h3><p><strong>2 недели пилота</strong> с KPI-дашбордом: TTQ, edit rate AI-текста (цель <strong>&lt;20%</strong>), conversion quote→deal.</p></div>
      </div>
      <p class="nero-ai-secondary-cta nero-ai-reveal">Чтобы отдел продаж уверенно работал с AI-черновиками на пилоте, полезно пройти <a class="nero-ai-text-link" href="[REDACTED]">[REDACTED]</a> — особенно когда менеджеры впервые получают документ от агента, а не собирают КП в Word с нуля.</p>

      <h3>Пример внедрения ai коммерческое предложение (типовой сценарий)</h3>
      <p><strong>Сценарий:</strong> IT-интегратор, amoCRM, 15–25 КП в месяц.</p>
      <ol>
        <li>Аудит: TTQ <strong>4 часа</strong>, данные в CRM + Google Drive.</li>
        <li>RAG по 8 кейсам и прайсу лицензий; агент в n8n + OpenAI API.</li>
        <li>Кнопка «Сгенерировать КП» в карточке сделки.</li>
        <li>Пилот: TTQ черновика <strong>3–5 мин</strong> + 20 мин правок; edit rate <strong>15%</strong> (иллюстративно).</li>
        <li>Масштабирование на вторую нишу через 4 недели.</li>
      </ol>
    </div>
  </section>

  <section id="integraciya-crm" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Интеграция AI-генератора КП с CRM и каналами продаж</h2>
      <p><strong>Ai коммерческое предложение с crm</strong> — ключевое отличие от SaaS-конструкторов западного рынка. Для РФ с amoCRM, 1С и 152-ФЗ нужна <strong>интеграция ai коммерческое предложение с crm</strong> под ваш стек.</p>

      <h3>amoCRM: сделка, поля брифа, автогенерация КП в карточке</h3>
      <p><strong>Ai коммерческое предложение amoCRM:</strong> кастомные поля брифа, webhook при переходе на этап «КП», генерация DOCX в карточку, статус «Черновик AI» (<a href="https://gptmag.ru/integratsiya-ai-s-1c-amocrm/" rel="noopener noreferrer" target="_blank">GPTmag: AI + 1С + amoCRM</a>).</p>

      <h3>Bitrix24: лиды, шаблоны документов, статусы согласования</h3>
      <p><strong>Ai коммерческое предложение битрикс24:</strong> приложение <a href="https://www.bitrix24.ru/apps/app/itnebo.ai_commercia/" rel="noopener noreferrer" target="_blank">AI Коммерческое24</a> генерирует КП за <strong>~5 минут</strong>. Nero Network дополняет коробку <strong>кастомным агентом + RAG</strong> для сложных смет и 1С.</p>

      <h3>Почта, мессенджеры и формы сайта — единый контекст для КП</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Канал</th><th>Что даёт агенту</th></tr></thead>
          <tbody>
            <tr><td>Форма/квиз на сайте</td><td>Структурированный бриф</td></tr>
            <tr><td>Email</td><td>История запросов и уточнений</td></tr>
            <tr><td>Telegram/WhatsApp</td><td>Быстрые уточнения, файлы</td></tr>
            <tr><td>Телефония</td><td>Транскрипт звонка (опционально)</td></tr>
          </tbody>
        </table>
      </div>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Класс</th><th>Инструменты</th></tr></thead>
          <tbody>
            <tr><td>CRM</td><td>amoCRM, Bitrix24, HubSpot</td></tr>
            <tr><td>ERP/цены</td><td>1С (REST), Google Sheets</td></tr>
            <tr><td>AI</td><td>OpenAI API, YandexGPT, GigaChat</td></tr>
            <tr><td>Оркестрация</td><td>n8n, Make, Albato, OpenAI Agents SDK</td></tr>
            <tr><td>Документы</td><td>DOCX/PDF, Google Drive, S3</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section id="segmenty-b2b" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>AI-генератор КП для агентств, интеграторов и производства</h2>

      <div class="nero-ai-grid-3">
        <div class="nero-ai-card nero-ai-service-card nero-ai-reveal"><div class="nero-ai-card-icon">AG</div><h3>Агентства</h3><p><strong>Ai кп для агентства:</strong> пакеты «Старт / Рост / Enterprise», KPI кампаний, кейсы по отрасли клиента.</p></div>
        <div class="nero-ai-card nero-ai-service-card nero-ai-reveal nero-ai-delay-1"><div class="nero-ai-card-icon">IT</div><h3>Интеграторы</h3><p><strong>Ai кп для интегратора:</strong> архитектура, модули, лицензии, этапы внедрения, SLA (<a href="https://cortexintellect.com/ru/portfolio/ai-agent-for-project-estimation-and-proposals/" rel="noopener noreferrer" target="_blank">Cortex Intellect</a>).</p></div>
        <div class="nero-ai-card nero-ai-service-card nero-ai-reveal nero-ai-delay-2"><div class="nero-ai-card-icon">PR</div><h3>Производство</h3><p><strong>Ai кп для производства:</strong> номенклатура из 1С, MOQ, сроки отгрузки. <strong>Ai генератор сметы</strong> связан с ERP.</p></div>
      </div>

      <h3>ai коммерческое предложение для малого бизнеса vs кастом для среднего B2B</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Параметр</th><th>Малый бизнес (5–10 КП/мес.)</th><th>Средний B2B (20+ КП/мес.)</th></tr></thead>
          <tbody>
            <tr><td>Старт</td><td>Коробка B24 / DIY n8n</td><td>Кастомный агент + RAG</td></tr>
            <tr><td>Интеграции</td><td>CRM + форма</td><td>CRM + 1С + почта + телефония</td></tr>
            <tr><td>Окупаемость</td><td>3–6 мес. (иллюстративно)</td><td>2–4 мес. при 10+ КП/мес.</td></tr>
            <tr><td>KPI</td><td>TTQ, качество черновика</td><td>TTQ + conversion + quotes/FTE</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section id="ai-generator-smeti" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>AI-генератор сметы и коммерческих документов продаж</h2>
      <p><strong>Ai документы продаж</strong> часто объединяют коммерческую часть и расчёт — но не всегда.</p>

      <h3>Когда КП и смета — один документ, а когда разделяются</h3>
      <p><strong>Один документ:</strong> типовые услуги, фиксированные пакеты. <strong>Раздельно:</strong> многоэтапные интеграции. <strong>Ai генератор сметы</strong> — отдельный agent «Pricer» с function_tool к прайсу/1С.</p>

      <h3>Автоматический расчёт позиций из прайса и условий клиента</h3>
      <p>RAG только из <strong>approved</strong>-источников — ответ на возражение «AI выдумает цены». Подход <a href="https://allsee.team/services/avtomatizaciya/avtomatizaciya-kommercheskih-predlozhenij" rel="noopener noreferrer" target="_blank">AllSee</a>: RAG к кейсам, прайсам, динамическое ценообразование.</p>

      <h3>Контроль маржи и согласование с руководителем</h3>
      <p>Статус «Требует согласования руководителя» срабатывает при скидке выше порога или марже ниже минимума.</p>
    </div>
  </section>

  <section id="cena-vnedreniya" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Сколько стоит внедрение AI-генератора коммерческих предложений</h2>
      <p><strong>Ai коммерческое предложение цена</strong> зависит от глубины интеграций, не от «подписки на нейросеть».</p>

      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Статья</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Аудит и ТЗ</td><td>Карта процессов, KPI, сценарии</td></tr>
            <tr><td>Агент + RAG</td><td>Промпты, база знаний, guardrails</td></tr>
            <tr><td>Интеграции</td><td>CRM, 1С, почта, документы</td></tr>
            <tr><td>Обучение</td><td>1–2 сессии для отдела продаж</td></tr>
            <tr><td>Пилот и дашборд</td><td>2 недели, метрики TTQ/edit rate</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Ориентир 100–250 тыс. ₽: что входит в стартовый пакет</h3>
      <p><strong>Ai коммерческое предложение стоимость</strong> стартового пакета Nero Network — <strong>100–250 тыс. ₽</strong>. Включено: 1 CRM, 1 нишевый промпт-пакет, RAG до 50 документов, кнопка генерации, пилот с KPI.</p>

      <h3>ROI: экономия часов менеджеров и рост конверсии КП → сделка</h3>
      <p>По benchmark-материалам (<a href="https://tribble.ai/blog/ai-proposal-automation-roi-framework/" rel="noopener noreferrer" target="_blank">Tribble</a>): сокращение time-to-quote <strong>40–70%</strong> (иллюстративно); payback <strong>2–4 мес.</strong> при <strong>10+ КП/мес.</strong></p>
    </div>
  </section>

  <section id="keisy-metriki" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Кейсы и метрики: что измерять после запуска</h2>
      <p><strong>Ai коммерческое предложение кейсы</strong> на российском рынке пока единичны, но паттерн повторяется: <strong>RAG + CRM + промпты по нишам + human-in-the-loop</strong>.</p>

      <div class="nero-ai-kpi-grid">
        <div class="nero-ai-card nero-ai-kpi-card nero-ai-reveal"><span class="nero-ai-kpi-value">2–5 мин</span><span class="nero-ai-kpi-label">TTQ черновика (пилот)</span></div>
        <div class="nero-ai-card nero-ai-kpi-card nero-ai-reveal nero-ai-delay-1"><span class="nero-ai-kpi-value" data-nero-count="20" data-nero-prefix="&lt;" data-nero-suffix="%">&lt;0%</span><span class="nero-ai-kpi-label">edit rate AI-текста (цель)</span></div>
        <div class="nero-ai-card nero-ai-kpi-card nero-ai-reveal nero-ai-delay-2"><span class="nero-ai-kpi-value">40→2 мин</span><span class="nero-ai-kpi-label">crmai.kz (заявлено)</span></div>
      </div>

      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы</th></tr></thead>
          <tbody>
            <tr><td>SaaS Bitrix24 (AI Коммерческое24)</td><td>Быстрый старт</td><td>Только B24, слабые 1С/сметы</td></tr>
            <tr><td>DIY Make/n8n</td><td>Дёшево</td><td>Нет KPI, хрупкие guardrails</td></tr>
            <tr><td>AllSee / кастом-интеграторы</td><td>RAG, под ключ</td><td>Редко live-демо на лендинге</td></tr>
            <tr><td><strong>Nero Network</strong></td><td>Агент + CRM + RAG + демо + KPI-пилот</td><td>Проект, не коробка</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section id="faq" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-reveal">
      <div class="nero-ai-section-head">
        <p class="nero-ai-eyebrow">FAQ</p>
        <h2>Частые вопросы про AI-генератор коммерческих предложений</h2>
      </div>
      <div class="nero-ai-faq nero-ai-prose">
        <details class="nero-ai-reveal"><summary>Сколько стоит ai коммерческое предложение?</summary><p>Стартовый пакет <strong>внедрения ai коммерческое предложение под ключ</strong> — ориентир <strong>100–250 тыс. ₽</strong> в зависимости от CRM, 1С и объёма RAG. Точная <strong>ai коммерческое предложение цена</strong> — после аудита 3–5 типовых сценариев КП.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1"><summary>Как внедрить ai генератор кп в отдел продаж?</summary><p><strong>Как внедрить ai коммерческое предложение:</strong> аудит → промпты и RAG → интеграция CRM → пилот 2 недели с KPI → обучение менеджеров → масштабирование.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-2"><summary>Можно ли связать ai кп с amoCRM или Битrix24?</summary><p>Да. <strong>Интеграция ai коммерческое предложение с crm</strong> — стандартный модуль: webhooks, поля брифа, кнопка генерации, статусы согласования.</p></details>
        <details class="nero-ai-reveal"><summary>Можно ли внедрить без программиста?</summary><p>Частично: DIY через <a href="https://crmai.kz/blog/crm-chatgpt-integraciya-bez-programmista-poshagovaya-instrukciya" rel="noopener noreferrer" target="_blank">n8n/Make + CRM</a> для простых КП. Для <strong>ai генератор сметы</strong> с 1С рекомендуем <strong>настройка ai коммерческое предложение</strong> с командой Nero Network.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1"><summary>Насколько безопасны данные клиентов и переписка?</summary><p>При ПДн — YandexGPT/GigaChat, облако РФ, обезличивание. Переписка не уходит в публичные чаты; доступ агента — по ролям.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-2"><summary>Что если AI ошибётся в цене или формулировке?</summary><p>RAG только из approved-прайса; agent «Reviewer» проверяет секции; <strong>обязательное одобрение менеджером</strong> перед отправкой.</p></details>
        <details class="nero-ai-reveal"><summary>Нужен ли свой шаблон КП или AI соберёт с нуля?</summary><p>Нужны <strong>3–5 эталонных КП</strong> и брендбук — AI собирает блоки по JSON-схеме. Лид-магнит — <strong>шаблон сильного кп</strong> под вашу нишу.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1"><summary>Работает ли с OpenAI Agents и другими AI-агентами в 2026?</summary><p>Да. <a href="https://openai.github.io/openai-agents-python/tools/" rel="noopener noreferrer" target="_blank">OpenAI Agents SDK</a> — production-паттерн: function_tool, FileSearchTool, handoffs, guardrails.</p></details>
      </div>
    </div>
  </section>

  <section id="demo-primer-kp" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Соберите пример КП — интерактивная демонстрация</h2>
      <p><strong>Пример внедрения ai коммерческое предложение</strong> лучше показать, чем описать. Заполните мини-бриф — система за <strong>2–5 минут</strong> формирует фрагмент <strong>ai коммерческое предложение</strong>.</p>

      <h3>Шаблон сильного КП под вашу нишу (лид-магнит)</h3>
      <p>Скачайте <strong>шаблон сильного кп</strong> с готовой структурой блоков для агентства, интегратора или производства — основа для промпт-пакета при <strong>внедрении ai агентов</strong> в отдел продаж.</p>

      <h3>Квиз / демо: бриф → черновик КП за минуты</h3>
      <p><strong>Primary CTA:</strong> <strong>Собрать пример КП</strong>. Заполните нишу, тип услуги и боль клиента — получите превью персонализированного документа.</p>

      <section class="nero-ai-final-cta nero-ai-card nero-ai-reveal" aria-labelledby="final-cta-kp-title">
  <h2 id="final-cta-kp-title">Соберите пример КП — или запросите аудит воронки</h2>
  <p>Nero Network внедряет AI-генератор коммерческих предложений под ключ: CRM, RAG, guardrails и пилот с KPI. Начните с интерактивного примера на этой странице или обсудите аудит ваших шаблонов и интеграций.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="[REDACTED]">[REDACTED]</a>
    <a class="nero-ai-btn nero-ai-btn-secondary" href="[REDACTED]">[REDACTED]</a>
  </div>
</section>

      <div class="nero-ai-summary nero-ai-reveal"><p><strong>Итог страницы:</strong> <strong>Ai коммерческое предложение под ключ</strong> — не замена менеджера, а ускорение <strong>автоматизация коммерческих предложений</strong> с измеримым ROI. Nero Network внедряет <strong>ai генератор кп</strong> с CRM, RAG, guardrails и пилотом KPI — от <strong>100–250 тыс. ₽</strong> и <strong>2–6 недель</strong>.</p></div>
    </div>
  </section>

</main>

<script>
(function () {
  'use strict';

  var root = document.querySelector('.nero-ai-home-page');
  if (!root) return;

  var revealItems = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

    revealItems.forEach(function (item) { observer.observe(item); });
  } else {
    revealItems.forEach(function (item) { item.classList.add('nero-ai-active'); });
  }

  var tooltipItems = root.querySelectorAll('[data-nero-tooltip]');
  tooltipItems.forEach(function (item) {
    if (!item.hasAttribute('tabindex')) item.setAttribute('tabindex', '0');

    item.addEventListener('click', function (event) {
      var isActive = item.classList.contains('nero-ai-tooltip-active');
      tooltipItems.forEach(function (other) { other.classList.remove('nero-ai-tooltip-active'); });
      if (!isActive) item.classList.add('nero-ai-tooltip-active');
      event.stopPropagation();
    });
  });

  document.addEventListener('click', function () {
    tooltipItems.forEach(function (item) { item.classList.remove('nero-ai-tooltip-active'); });
  });

  var counters = root.querySelectorAll('[data-nero-count]');
  function animateCounter(el) {
    var target = parseFloat(el.getAttribute('data-nero-count') || '0');
    var suffix = el.getAttribute('data-nero-suffix') || '';
    var prefix = el.getAttribute('data-nero-prefix') || '';
    var duration = 850;
    var start = performance.now();

    function frame(now) {
      var progress = Math.min((now - start) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      var value = Math.round(target * eased);
      el.textContent = prefix + value + suffix;
      if (progress < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  if ('IntersectionObserver' in window) {
    var counterObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting && !entry.target.dataset.neroDone) {
          entry.target.dataset.neroDone = '1';
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.35 });
    counters.forEach(function (counter) { counterObserver.observe(counter); });
  } else {
    counters.forEach(animateCounter);
  }
})();
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type": "Question", "name": "Сколько стоит ai коммерческое предложение?", "acceptedAnswer": {"@type": "Answer", "text": "Стартовый пакет внедрения ai коммерческое предложение под ключ — ориентир 100–250 тыс. ₽ в зависимости от CRM, 1С и объёма RAG."}},
    {"@type": "Question", "name": "Как внедрить ai генератор кп в отдел продаж?", "acceptedAnswer": {"@type": "Answer", "text": "Аудит → промпты и RAG → интеграция CRM → пилот 2 недели с KPI → обучение менеджеров → масштабирование."}},
    {"@type": "Question", "name": "Можно ли связать ai кп с amoCRM или Битrix24?", "acceptedAnswer": {"@type": "Answer", "text": "Да. Интеграция ai коммерческое предложение с crm — webhooks, поля брифа, кнопка генерации, статусы согласования."}},
    {"@type": "Question", "name": "Можно ли внедрить без программиста?", "acceptedAnswer": {"@type": "Answer", "text": "Частично через n8n/Make для простых КП; для ai генератор сметы с 1С рекомендуем настройка с командой Nero Network."}},
    {"@type": "Question", "name": "Насколько безопасны данные клиентов и переписка?", "acceptedAnswer": {"@type": "Answer", "text": "При ПДн — YandexGPT/GigaChat, облако РФ, обезличивание; доступ агента по ролям."}},
    {"@type": "Question", "name": "Что если AI ошибётся в цене или формулировке?", "acceptedAnswer": {"@type": "Answer", "text": "RAG из approved-прайса, agent Reviewer, обязательное одобрение менеджером перед отправкой."}},
    {"@type": "Question", "name": "Нужен ли свой шаблон КП или AI соберёт с нуля?", "acceptedAnswer": {"@type": "Answer", "text": "Нужны 3–5 эталонных КП и брендбук; AI собирает блоки по JSON-схеме."}},
    {"@type": "Question", "name": "Работает ли с OpenAI Agents и другими AI-агентами в 2026?", "acceptedAnswer": {"@type": "Answer", "text": "Да. OpenAI Agents SDK — function_tool, FileSearchTool, handoffs, guardrails."}}
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "AI-генератор коммерческих предложений по брифу клиента — внедрение под ключ",
  "description": "Внедрим AI-генератор КП по брифу клиента: персональное коммерческое предложение за 2–5 минут на основе заявки и истории общения. Шаблон сильного КП под вашу нишу — соберите пример бесплатно.",
  "author": {"@type": "Organization", "name": "Nero Network"},
  "about": "AI-генератор коммерческих предложений по брифу клиента"
}
</script>

<?php
get_footer();

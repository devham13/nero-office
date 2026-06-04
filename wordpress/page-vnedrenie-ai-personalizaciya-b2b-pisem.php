<?php
/**
 * Template Name: AI B2B Email Personalization
 * Description: AI-персонализация B2B-писем — внедрение под ключ без массового спама
 */

$page_seo_title = 'AI-персонализация B2B-писем — внедрение под ключ без спама';
$page_seo_description = 'Внедрим AI-систему персонализации B2B-писем: анализ компании клиента, релевантное холодное письмо за минуты — без массового спама. 5 примеров писем, CTA «Сгенерировать 3 письма».';

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

$brand = getenv('SITE_BRAND') ?: get_bloginfo('name') ?: '';
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Бесплатный аудит';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#demo-3-pisma';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Что можно автоматизировать';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: home_url('/#services');

$nero_bootstrap = get_stylesheet_directory() . '/partials/nero-ai-longread-bootstrap.php';
if (is_readable($nero_bootstrap)) {
    require_once $nero_bootstrap;
}

get_header();
?>

<style>
/* CRITICAL: theme reset + hero shell — must be first (see agent-pipeline-pitfalls §hero-markup) */
.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs, .yoast-breadcrumb,
.entry-header, .page-title-section { display: none !important; }

#primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}

body.nero-ai-landing-shell #masthead,
body.nero-ai-landing-shell #mobile-header {
  display: none !important;
}
body.nero-ai-landing-shell {
  padding-top: 0 !important;
}

.nero-ai-home .nero-ai-hero {
  padding: clamp(108px, 14vh, 148px) 0 clamp(64px, 8vw, 80px);
}
.nero-ai-home .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: 1fr 1.05fr;
  gap: clamp(32px, 5vw, 56px);
  align-items: center;
}
@media (max-width: 900px) {
  .nero-ai-home .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .nero-ai-home .nero-ai-dashboard { order: -1; }
}

/* nero-ai-home-page design tokens */

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


/* Page shell + theme reset — duplicated in shared CSS; kept for offline template readability */
.ym-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

/* Intro after hero */
.vnedrenie-ai-personalizaciya-b2b-pisem-intro {
  padding: clamp(48px, 6vw, 72px) 0 clamp(28px, 4vw, 40px);
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__grid {
  display: grid;
  grid-template-columns: minmax(0, 1.15fr) minmax(280px, 0.85fr);
  gap: clamp(24px, 4vw, 40px);
  align-items: start;
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__text {
  text-align: left !important;
  border-left: 4px solid var(--nero-ai-primary);
  padding-left: clamp(18px, 3vw, 28px);
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__text p {
  text-align: left !important;
  margin: 0 0 16px;
  font-size: clamp(16px, 1.6vw, 18px);
  line-height: 1.65;
  color: var(--nero-ai-soft) !important;
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__text p:last-child { margin-bottom: 0; }
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__lead {
  font-size: clamp(17px, 1.8vw, 20px) !important;
  color: var(--nero-ai-heading) !important;
  font-weight: 650;
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__terminal {
  padding: 18px;
  border-radius: 20px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.10);
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__terminal-head {
  display: flex;
  gap: 6px;
  margin-bottom: 14px;
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__terminal-head span {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(255,255,255,.22);
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__terminal-head span:nth-child(1) { background: #fb7185; }
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__terminal-head span:nth-child(2) { background: #fbbf24; }
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__terminal-head span:nth-child(3) { background: #34d399; }
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 14px;
  padding: 0;
  list-style: none;
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__chips li {
  padding: 7px 11px;
  border-radius: 999px;
  border: 1px solid rgba(121,242,255,.22);
  background: rgba(121,242,255,.08);
  color: var(--nero-ai-primary) !important;
  font-size: 12px;
  font-weight: 700;
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__metric {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__metric div {
  padding: 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.08);
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__metric strong {
  display: block;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnedrenie-ai-personalizaciya-b2b-pisem-intro__metric span {
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
  .vnedrenie-ai-personalizaciya-b2b-pisem-intro__grid { grid-template-columns: 1fr; }
  .nero-ai-split { grid-template-columns: 1fr; }
}


.nero-ai-demo-panel { margin-top: 28px; padding: clamp(22px, 3vw, 32px); border-radius: var(--nero-ai-radius-lg); border: 1px solid rgba(255,255,255,.12); background: rgba(255,255,255,.045); }
.nero-ai-demo-form label { display: block; margin-bottom: 8px; color: var(--nero-ai-soft); font-size: 14px; font-weight: 700; }
.nero-ai-demo-form textarea, .nero-ai-demo-form input[type="url"], .nero-ai-demo-form input[type="text"] { width: 100%; padding: 14px 16px; border-radius: 14px; border: 1px solid rgba(255,255,255,.14); background: rgba(5,8,18,.55); color: var(--nero-ai-heading); font-size: 15px; font-family: inherit; margin-bottom: 14px; }
.nero-ai-demo-form textarea { min-height: 72px; resize: vertical; }
.nero-ai-demo-drafts { display: none; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; margin-top: 24px; }
.nero-ai-demo-drafts.is-visible { display: grid; }
.nero-ai-demo-draft { padding: 18px; border-radius: 18px; border: 1px solid rgba(255,255,255,.10); background: rgba(255,255,255,.04); }
.nero-ai-demo-draft__type { margin: 0 0 10px; font-size: 11px; font-weight: 800; letter-spacing: .12em; text-transform: uppercase; color: var(--nero-ai-primary); }
.nero-ai-demo-draft h4 { margin: 0 0 8px; font-size: 15px; }
.nero-ai-demo-draft p { margin: 0 0 8px; font-size: 13px; line-height: 1.55; }
.nero-ai-demo-draft__subject { color: var(--nero-ai-soft) !important; font-weight: 700; }
.nero-ai-demo-note { margin-top: 14px; font-size: 12px; color: var(--nero-ai-muted); font-style: italic; }
@media (max-width: 900px) { .nero-ai-demo-drafts { grid-template-columns: 1fr; } }

</style>

<main id="primary" class="site-main vnedrenie-ai-personalizaciya-b2b-pisem-page nero-ai-home-page" role="main" tabindex="-1">
<?php
$nero_header_nav_links = [
    ['href' => '#problema-holodnyh-pisem', 'label' => 'Проблема'],
    ['href' => '#kak-rabotaet-ai', 'label' => 'Как работает'],
    ['href' => '#vnedrenie', 'label' => 'Внедрение'],
    ['href' => '#integraciya-crm', 'label' => 'CRM'],
    ['href' => '#anti-spam', 'label' => 'Без спама'],
    ['href' => '#faq', 'label' => 'FAQ'],
];
$nero_header_cta_label = 'Сгенерировать 3 письма';
$nero_header_cta_url = '#demo-3-pisma';
$nero_header = get_stylesheet_directory() . '/partials/nero-ai-site-header.php';
if (is_readable($nero_header)) {
    require $nero_header;
}
?>
<?php
$hero_eyebrow = 'AI outreach · B2B-письма';
$hero_title = 'AI-персонализация B2B-писем — внедрение под ключ';
$hero_title_id = 'vnedrenie-ai-personalizaciya-b2b-pisem-hero-title';
$hero_lead = 'AI персонализация писем для B2B: система анализирует компанию клиента и готовит релевантное персональное письмо — без массового спама';
$hero_badges = ['B2B outreach', 'Enrichment', 'Human approve', 'Anti-spam', 'CRM'];
$hero_primary_label = 'Сгенерировать 3 письма';
$hero_primary_url = '#demo-3-pisma';
$hero_secondary_label = $secondary_cta_label;
$hero_secondary_url = $secondary_cta_url;
$hero_dashboard_title = 'B2B outreach · персонализация писем';
$hero_dashboard_note = 'пример логики AI-outreach · демонстрационные данные';
$hero_metrics = [
    ['value' => '4:12', 'label' => 'draft на контакт*'],
    ['value' => '−36%', 'label' => 'время на черновик*'],
    ['value' => '3', 'label' => 'на approve'],
    ['value' => '35/день', 'label' => 'лимит без спама'],
];
$hero_feed = [
    ['dot' => 'blue', 'text' => 'Лид «ООО ЛогистикПро» · URL сайта → enrichment запущен'],
    ['dot' => 'blue', 'text' => 'Сайт + LinkedIn + вакансии → research brief (3 буллета)'],
    ['dot' => 'amber', 'text' => 'AI: icebreaker + subject + body → черновик в amoCRM'],
    ['dot' => 'green', 'text' => 'QA gate: confidence 0,82 · anti-spam OK → passed'],
    ['dot' => 'amber', 'text' => 'Статус «Ждёт approve» → задача менеджеру в CRM'],
    ['dot' => 'green', 'text' => 'Approve → в очередь отправки (35 писem/ящик/день)'],
];
$hero_partial = get_stylesheet_directory() . '/partials/nero-ai-longread-hero-shell.php';
if (is_readable($hero_partial)) {
    require $hero_partial;
}
?>

  <section class="nero-ai-section-tight vnedrenie-ai-personalizaciya-b2b-pisem-intro" aria-label="Введение">
    <div class="nero-ai-container">
      <div class="vnedrenie-ai-personalizaciya-b2b-pisem-intro__grid nero-ai-reveal">
        <div class="vnedrenie-ai-personalizaciya-b2b-pisem-intro__text">
          <p class="vnedrenie-ai-personalizaciya-b2b-pisem-intro__lead"><strong>Коротко:</strong> <strong>AI персонализация писем</strong> для B2B — не подстановка <code>{Имя}</code> в шаблон, а система: enrichment компании и контакта, анализ контекста, генерация icebreaker и черновика, проверка менеджером и отправка с лимитами и прогревом домена.</p>
          <p>Nero Network внедряет такой конвейер под ключ — в вашу CRM, с anti-spam-контуром и обучением команды.</p>
        </div>
        <div class="vnedrenie-ai-personalizaciya-b2b-pisem-intro__terminal nero-ai-reveal nero-ai-delay-1" aria-hidden="true">
          <div class="vnedrenie-ai-personalizaciya-b2b-pisem-intro__terminal-head"><span></span><span></span><span></span></div>
          <ul class="vnedrenie-ai-personalizaciya-b2b-pisem-intro__chips">
            <li>3,43% avg reply</li><li>Human-in-the-loop</li><li>amoCRM / Bitrix24</li><li>Anti-spam gate</li>
          </ul>
          <div class="vnedrenie-ai-personalizaciya-b2b-pisem-intro__metric">
            <div><strong data-nero-count="36" data-nero-prefix="−" data-nero-suffix="%">−0%</strong><span>время на черновик*</span></div>
            <div><strong>35/день</strong><span>лимит без спама</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <nav class="nero-ai-toc-wrap" aria-label="Оглавление">
    <ul class="nero-ai-toc nero-ai-reveal">
      <li><a href="#problema-holodnyh-pisem">Почему письма не читают</a></li>
      <li><a href="#chto-takoe-ai-personalizaciya">Что такое AI-персонализация</a></li>
      <li><a href="#spam-vs-outreach">Спам vs outreach</a></li>
      <li><a href="#kak-rabotaet-ai">Как работает AI</a></li>
      <li><a href="#vnedrenie">Внедрение под ключ</a></li>
      <li><a href="#integraciya-crm">CRM и интеграции</a></li>
      <li><a href="#anti-spam">Этика и anti-spam</a></li>
      <li><a href="#metriki">Метрики</a></li>
      <li><a href="#sravnenie-instrumentov">SaaS vs внедрение</a></li>
      <li><a href="#cena">Стоимость</a></li>
      <li><a href="#faq">FAQ</a></li>
      <li><a href="#demo-3-pisma">Сгенерировать 3 письма</a></li>
    </ul>
  </nav>

  <section id="problema-holodnyh-pisem" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Почему холодные B2B-письма не читают и ручная персонализация съедает часы</h2>
      <p>По Instantly Cold Email Benchmark 2026 средний <strong>reply rate</strong> — <strong>3,43%</strong>; у верхнего квартиля — <strong>5,5%</strong>, у elite-кампаний — <strong>&gt;10%</strong>. Шаблонная рассылка почти всегда в нижней части шкалы.</p>
      <p>Sopro и Cleverly фиксируют: <strong>продвинутая персонализация</strong> — до <strong>18% reply</strong> против <strong>9%</strong> у generic-писем, но каждое письмо персонализируют лишь <strong>~5%</strong> отправителей. Ручной research и черновик — <strong>15–45 мин</strong> на контакт, <strong>4–5 ч</strong> на strategic account (Aqfer + Evergrowth: с agent — <strong>11–12 мин</strong>). Salesforce State of Sales 2026: reps тратят <strong>~70%</strong> времени на non-selling.</p>
      <h3>Сколько времени уходит на одно персональное письмо в отделе продаж</h3>
      <p>CRM → сайт и LinkedIn → новости и вакансии → зацепка → subject и body → согласование. На 20 контактов в день без компромисса по качеству не успеть. AI снимает сбор контекста и первый черновик при human-in-the-loop перед отправкой.</p>
      <h3>Почему шаблонная рассылка убивает reply rate</h3>
      <p>Generic subject, «уважаемые коллеги», лендинг без привязки к бизнесу — получатель закрывает за секунду. Gmail и Outlook с 2024–2025 жёстче проверяют SPF, DKIM, DMARC. <strong>Open rate</strong> обесценивается из-за privacy — industry смещается к <strong>reply rate</strong> и <strong>positive reply rate</strong>.</p>
    </div>
  </section>

  <section id="chto-takoe-ai-personalizaciya" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Что такое AI-персонализация писем для B2B</h2>
      <p><strong>AI персонализация писем</strong> — конвейер: сайт, новости, вакансии, LinkedIn → research brief → icebreaker и body → QA и approve → отправка с warmup. Это <strong>ai генератор писем для b2b</strong> в процессе продаж, не разовый запрос в чат.</p>
      <p>Salesforce State of Sales 2026 (<strong>4 050</strong> респондентов): <strong>87%</strong> orgs используют AI; <strong>55%</strong> — для prospecting. Agents сокращают research <strong>−34%</strong>, drafting <strong>−36%</strong>. Топ-перформеры <strong>в 1,7×</strong> чаще используют prospecting AI agents.</p>
      <h3>Чем AI-письмо отличается от «просто ChatGPT в браузере»</h3>
      <p>ChatGPT/n8n без CRM и deliverability даёт черновик, не систему: галлюцинации, роботизированный тон, нет suppression list, риск для основного домена. Внедрение добавляет промпты под ICP, LLM-judge, approve в CRM, лимиты <strong>30–50 писем/ящик/день</strong>.</p>
      <h3>Какие данные нужны: сайт компании, LinkedIn, CRM, новости</h3>
      <p>Минимум: URL, email, должность. Оптимум: CRM-поля, Sales Navigator, новости за 90 дней, вакансии. Контекст &lt;50 символов → fallback или «ручной research», не generic AI-spam.</p>
    </div>
  </section>

  <section id="spam-vs-outreach" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Массовый спам vs персонализированный outreach</h2>
      <p><strong>Автоматизация холодных писем без спама</strong> — вопрос архитектуры. Спам: тысячи одинаковых писем, нет opt-out. <strong>AI персонализация писем без спама</strong>: уникальные тексты, низкий volume, human approve, suppression list.</p>
      <h3>Где проходит граница между масштабом и спамом</h3>
      <p>Масштаб — когда растёт число <strong>релевантных уникальных</strong> писем при лимитах отправки. Спам — когда AI пишет «про всех и ни про кого», растёт complaint rate. Nero Network: <strong>precision over volume</strong> (Instantly Benchmark 2026).</p>
      <h3>Deliverability: домен, прогрев, лимиты отправки</h3>
      <p>Secondary domains; warmup <strong>3–4 недели</strong>; SPF+DKIM+DMARC (Gmail с 01.02.2024, spam rate &lt;0,3%; Outlook с 05.05.2025); inbox rotation; <strong>30–50 emails/mailbox/day</strong>. Уникальный текст + низкий volume безопаснее 500 merge tags.</p>
    </div>
  </section>

  <section id="kak-rabotaet-ai" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Как работает AI-система: от enrichment до отправки</h2>
      <p>Семь шагов <strong>ai анализ компании для письма</strong> → отправка:</p>
      <ol>
        <li><strong>Шаг 1 — лид в CRM.</strong> Компания, контакт, URL.</li>
        <li><strong>Шаг 2 — enrichment.</strong> Сайт, новости, вакансии, LinkedIn.</li>
        <li><strong>Шаг 3 — research brief.</strong> 3–5 буллетов: боль, trigger, релевантность оффера.</li>
        <li><strong>Шаг 4 — генерация.</strong> Icebreaker → body → subject по tone of voice.</li>
        <li><strong>Шаг 5 — QA gate.</strong> LLM-judge + rules; low confidence → fallback.</li>
        <li><strong>Шаг 6 — human-in-the-loop.</strong> Approve / edit / reject в CRM.</li>
        <li><strong>Шаг 7 — отправка.</strong> ESP с лимитами; follow-up 2–4 касания; opt-out → suppression list.</li>
      </ol>
    </div>

<section id="vnedrenie-ai-personalizaciya-b2b-pisem-boris-block" class="boris-b2b-email nero-ai-reveal" aria-labelledby="boris-b2b-email-title">
<style>
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block.boris-b2b-email {
    margin: 48px 0 56px;
    padding: 0;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__card {
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.97) 0%, rgba(248, 250, 252, 0.94) 52%, rgba(238, 242, 255, 0.92) 100%);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border: 1px solid rgba(255, 255, 255, 0.22);
    border-radius: 24px;
    box-shadow:
      0 24px 64px rgba(0, 0, 0, 0.28),
      0 0 0 1px rgba(255, 255, 255, 0.06) inset,
      0 1px 0 rgba(255, 255, 255, 0.65) inset;
    padding: clamp(24px, 4vw, 40px);
    overflow: hidden;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__grid {
    display: grid;
    grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
    gap: clamp(24px, 4vw, 40px);
    align-items: center;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__eyebrow {
    margin: 0 0 10px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #2563eb;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__title {
    margin: 0 0 12px;
    font-size: clamp(22px, 2.4vw, 28px);
    line-height: 1.2;
    letter-spacing: -0.03em;
    color: #0f172a;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__lead {
    margin: 0 0 18px;
    color: #475569;
    font-size: 15px;
    line-height: 1.55;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__steps {
    margin: 0 0 20px;
    padding: 0;
    list-style: none;
    display: grid;
    gap: 10px;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__steps li {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    font-size: 14px;
    line-height: 1.45;
    color: #334155;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__step-icon {
    flex: 0 0 28px;
    height: 28px;
    border-radius: 10px;
    display: grid;
    place-items: center;
    font-size: 13px;
    font-weight: 800;
    color: #fff;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__step-icon--enrich { background: linear-gradient(135deg, #2563eb, #3b82f6); }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__step-icon--draft { background: linear-gradient(135deg, #8b5cf6, #a78bfa); }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__step-icon--qa { background: linear-gradient(135deg, #f59e0b, #fbbf24); }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__step-icon--send { background: linear-gradient(135deg, #10b981, #34d399); }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.85);
    border: 1px solid rgba(15, 23, 42, 0.08);
    font-size: 12px;
    font-weight: 600;
    color: #0f172a;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__pill-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.18);
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__pill--violet .boris-b2b-email__pill-dot { background: #8b5cf6; box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.18); }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__pill--cyan .boris-b2b-email__pill-dot { background: #06b6d4; box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.18); }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__bridge {
    margin: 16px 0 0;
    font-size: 13px;
    color: #64748b;
    font-style: italic;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__viz {
    position: relative;
    min-height: 480px;
    border-radius: 18px;
    background: #fff;
    border: 1px solid rgba(15, 23, 42, 0.06);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9);
    overflow: hidden;
  }
  #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block #b2b-email-personalizer-boris-canvas {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 480px;
  }
  @media (max-width: 1023px) {
    #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__grid {
      grid-template-columns: 1fr;
    }
    #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block .boris-b2b-email__viz,
    #vnedrenie-ai-personalizaciya-b2b-pisem-boris-block #b2b-email-personalizer-boris-canvas {
      min-height: 400px;
    }
  }
</style>

  <div class="ym-container boris-b2b-email__card">
    <div class="boris-b2b-email__grid">
      <div class="boris-b2b-email__copy">
        <p class="boris-b2b-email__eyebrow">Конвейер outreach</p>
        <h3 id="boris-b2b-email-title" class="boris-b2b-email__title">От URL компании до approve — без шаблонного спама</h3>
        <p class="boris-b2b-email__lead">AI не подставляет `{Имя}` — он собирает контекст, пишет черновик и отдаёт его менеджеру на проверку перед отправкой с лимитами.</p>
        <ol class="boris-b2b-email__steps">
          <li><span class="boris-b2b-email__step-icon boris-b2b-email__step-icon--enrich" aria-hidden="true">1</span><span><strong>Enrichment</strong> — сайт, LinkedIn, новости и вакансии → research brief из 3–5 буллетов.</span></li>
          <li><span class="boris-b2b-email__step-icon boris-b2b-email__step-icon--draft" aria-hidden="true">2</span><span><strong>Draft</strong> — icebreaker, subject и body под tone of voice и ICP.</span></li>
          <li><span class="boris-b2b-email__step-icon boris-b2b-email__step-icon--qa" aria-hidden="true">3</span><span><strong>QA</strong> — LLM-judge + правила; low confidence → fallback, не generic spam.</span></li>
          <li><span class="boris-b2b-email__step-icon boris-b2b-email__step-icon--send" aria-hidden="true">4</span><span><strong>Send</strong> — human approve в CRM → ESP с warmup и 30–50 писем/ящик/день.</span></li>
        </ol>
        <div class="boris-b2b-email__pills" aria-hidden="true">
          <span class="boris-b2b-email__pill"><span class="boris-b2b-email__pill-dot"></span>−34% research</span>
          <span class="boris-b2b-email__pill boris-b2b-email__pill--violet"><span class="boris-b2b-email__pill-dot"></span>Human-in-the-loop</span>
          <span class="boris-b2b-email__pill boris-b2b-email__pill--cyan"><span class="boris-b2b-email__pill-dot"></span>Anti-spam gate</span>
        </div>
        <p class="boris-b2b-email__bridge">Дальше — пошагово: от enrichment до отправки из CRM и follow-up цепочки.</p>
      </div>
      <div class="boris-b2b-email__viz" aria-hidden="true">
        <canvas id="b2b-email-personalizer-boris-canvas" role="img" aria-label="Анимация: URL компании превращается в research brief, затем в черновик письма и получает галочку approve менеджера"></canvas>
      </div>
    </div>
  </div>

<script id="b2b-email-personalizer-boris-engine">
(function () {
  var canvas = document.getElementById('b2b-email-personalizer-boris-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var cw = 0, ch = 0, frame = 0;

  var COL = {
    ink: '#0f172a',
    muted: '#64748b',
    line: '#cbd5e1',
    blue: '#2563eb',
    blueSoft: '#dbeafe',
    violet: '#8b5cf6',
    violetSoft: '#ede9fe',
    amber: '#f59e0b',
    amberSoft: '#fef3c7',
    green: '#10b981',
    greenSoft: '#d1fae5',
    card: '#ffffff',
    cardBorder: '#e2e8f0',
    cyan: '#06b6d4'
  };

  var briefLines = [
    'Расширение отдела продаж',
    'Вакансия SDR на HH.ru',
    'Триггер: новый продукт Q1'
  ];

  var emailSubject = 'Идея для outreach без шаблонов';
  var emailBody = 'Заметил расширение SDR — icebreaker по вакансии…';

  function resize() {
    var parent = canvas.parentElement;
    if (!parent) return;
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    cw = parent.clientWidth;
    ch = Math.max(parent.clientHeight, 400);
    canvas.width = Math.floor(cw * dpr);
    canvas.height = Math.floor(ch * dpr);
    canvas.style.width = cw + 'px';
    canvas.style.height = ch + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function rr(x, y, w, h, r, fill, stroke) {
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
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function text(str, x, y, size, color, align, weight) {
    ctx.font = (weight || 600) + ' ' + size + 'px Inter, system-ui, sans-serif';
    ctx.fillStyle = color || COL.ink;
    ctx.textAlign = align || 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(str, x, y);
  }

  function drawLabel(x, y, w, title, sub, accent) {
    rr(x, y, w, 22, 8, accent + '22', accent);
    text(title, x + w / 2, y + 8, 9, accent, 'center', 700);
    text(sub, x + w / 2, y + 34, 9, COL.muted, 'center', 500);
  }

  function drawUrlCard(x, y, w, h, glow) {
    rr(x, y, w, h, 14, COL.card, COL.cardBorder);
    rr(x + 10, y + 10, w - 20, 18, 6, COL.blueSoft, null);
    text('URL компании', x + w / 2, y + 19, 9, COL.blue, 'center', 700);
    rr(x + 10, y + 36, w - 20, 22, 8, '#f8fafc', COL.cardBorder);
    text('acme-logistics.ru', x + 16, y + 47, 10, COL.ink, 'left', 600);
    rr(x + 10, y + 66, w - 20, 8, 3, '#f1f5f9', null);
    rr(x + 10, y + 78, w - 20, 8, 3, '#f1f5f9', null);
    if (glow > 0) {
      ctx.strokeStyle = COL.blue;
      ctx.globalAlpha = 0.2 * glow;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(x + w / 2, y + h / 2, w * 0.62 + glow * 6, 0, Math.PI * 2);
      ctx.stroke();
      ctx.globalAlpha = 1;
    }
  }

  function drawBriefCard(x, y, w, h, progress) {
    rr(x, y, w, h, 14, COL.card, COL.cardBorder);
    rr(x + 10, y + 10, w - 20, 18, 6, COL.violetSoft, null);
    text('Research brief', x + w / 2, y + 19, 9, COL.violet, 'center', 700);
    for (var i = 0; i < briefLines.length; i++) {
      var p = Math.max(0, Math.min(1, progress - i * 0.22));
      if (p <= 0) continue;
      var by = y + 38 + i * 20;
      ctx.globalAlpha = p;
      rr(x + 10, by, 6, 6, 2, COL.violet, null);
      var chars = Math.ceil(briefLines[i].length * p);
      text(briefLines[i].substring(0, chars), x + 22, by + 3, 9, COL.ink, 'left', 500);
      ctx.globalAlpha = 1;
    }
  }

  function drawEmailCard(x, y, w, h, progress) {
    rr(x, y, w, h, 14, COL.card, COL.cardBorder);
    rr(x + 10, y + 10, w - 20, 18, 6, COL.amberSoft, null);
    text('Черновик письма', x + w / 2, y + 19, 9, COL.amber, 'center', 700);
    var subjP = Math.max(0, Math.min(1, progress));
    var bodyP = Math.max(0, Math.min(1, progress - 0.35));
    if (subjP > 0) {
      text('Subject:', x + 14, y + 40, 8, COL.muted, 'left', 600);
      text(emailSubject.substring(0, Math.ceil(emailSubject.length * subjP)), x + 14, y + 54, 9, COL.ink, 'left', 600);
    }
    if (bodyP > 0) {
      rr(x + 10, y + 66, w - 20, h - 78, 8, '#f8fafc', COL.cardBorder);
      text(emailBody.substring(0, Math.ceil(emailBody.length * bodyP)), x + 16, y + 82, 9, COL.muted, 'left', 500);
    }
  }

  function drawApproveBadge(x, y, scale, pulse) {
    ctx.save();
    ctx.translate(x, y);
    ctx.scale(scale, scale);
    rr(-38, -38, 76, 76, 20, COL.greenSoft, COL.green);
    ctx.strokeStyle = COL.green;
    ctx.lineWidth = 4;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    ctx.beginPath();
    ctx.moveTo(-14, 2);
    ctx.lineTo(-2, 14);
    ctx.lineTo(18, -12);
    ctx.stroke();
    text('Approve', 0, 30, 10, COL.green, 'center', 700);
    if (pulse > 0) {
      ctx.strokeStyle = COL.green;
      ctx.globalAlpha = 0.25 * pulse;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, 0, 48 + pulse * 10, 0, Math.PI * 2);
      ctx.stroke();
      ctx.globalAlpha = 1;
    }
    ctx.restore();
  }

  function drawFlowArrow(x1, x2, y, progress, color) {
    ctx.strokeStyle = COL.line;
    ctx.lineWidth = 2.5;
    ctx.setLineDash([5, 5]);
    ctx.beginPath();
    ctx.moveTo(x1, y);
    ctx.lineTo(x2, y);
    ctx.stroke();
    ctx.setLineDash([]);
    if (progress > 0) {
      var px = x1 + (x2 - x1) * progress;
      ctx.strokeStyle = color || COL.blue;
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.moveTo(x1, y);
      ctx.lineTo(px, y);
      ctx.stroke();
      ctx.fillStyle = color || COL.blue;
      ctx.beginPath();
      ctx.arc(px, y, 4, 0, Math.PI * 2);
      ctx.fill();
    }
  }

  function drawScanBeam(x, y, w, h, t) {
    var beamX = x + 10 + (w - 20) * t;
    var grad = ctx.createLinearGradient(beamX - 20, y, beamX + 20, y);
    grad.addColorStop(0, 'rgba(37, 99, 235, 0)');
    grad.addColorStop(0.5, 'rgba(37, 99, 235, 0.25)');
    grad.addColorStop(1, 'rgba(37, 99, 235, 0)');
    ctx.fillStyle = grad;
    ctx.fillRect(beamX - 20, y + 10, 40, h - 20);
  }

  function render() {
    ctx.clearRect(0, 0, cw, ch);
    var pad = Math.max(16, cw * 0.04);
    var cardW = Math.min(118, (cw - pad * 2) / 3.6);
    var cardH = Math.min(108, ch * 0.38);
    var yRow = ch * 0.46;
    var x1 = pad + cardW * 0.5;
    var x2 = cw * 0.38;
    var x3 = cw * 0.62;
    var x4 = cw - pad - cardW * 0.5;

    if (cw < 520) {
      x2 = cw * 0.5;
      x3 = cw * 0.5;
      x4 = cw * 0.5;
    }

    var cycle = (frame % 480) / 480;
    var t = cycle;

    var urlGlow = t < 0.22 ? 0.5 + 0.5 * Math.sin(frame * 0.14) : 0;
    var scanT = t < 0.22 ? (t / 0.22) % 1 : 0;
    var briefP = Math.max(0, Math.min(1, (t - 0.18) / 0.22));
    var emailP = Math.max(0, Math.min(1, (t - 0.42) / 0.22));
    var approveP = Math.max(0, Math.min(1, (t - 0.66) / 0.18));
    var approvePulse = approveP > 0.85 ? 0.5 + 0.5 * Math.sin(frame * 0.12) : 0;

    var a1 = Math.max(0, Math.min(1, (t - 0.08) / 0.12));
    var a2 = Math.max(0, Math.min(1, (t - 0.32) / 0.12));
    var a3 = Math.max(0, Math.min(1, (t - 0.56) / 0.12));

    if (cw >= 520) {
      drawFlowArrow(x1 + cardW * 0.5, x2 - cardW * 0.5, yRow, a1, COL.blue);
      drawFlowArrow(x2 + cardW * 0.5, x3 - cardW * 0.5, yRow, a2, COL.violet);
      drawFlowArrow(x3 + cardW * 0.5, x4 - cardW * 0.5, yRow, a3, COL.green);

      drawLabel(x1 - cardW / 2, yRow - cardH / 2 - 44, cardW, 'ШАГ 1', 'URL', COL.blue);
      drawUrlCard(x1 - cardW / 2, yRow - cardH / 2, cardW, cardH, urlGlow);
      if (scanT > 0 && t < 0.22) drawScanBeam(x1 - cardW / 2, yRow - cardH / 2, cardW, cardH, scanT);

      drawLabel(x2 - cardW / 2, yRow - cardH / 2 - 44, cardW, 'ШАГ 2', 'Brief', COL.violet);
      drawBriefCard(x2 - cardW / 2, yRow - cardH / 2, cardW, cardH, briefP);

      drawLabel(x3 - cardW / 2, yRow - cardH / 2 - 44, cardW, 'ШАГ 3', 'Письмо', COL.amber);
      drawEmailCard(x3 - cardW / 2, yRow - cardH / 2, cardW, cardH, emailP);

      if (approveP > 0) {
        drawLabel(x4 - cardW / 2, yRow - cardH / 2 - 44, cardW, 'ШАГ 4', 'Approve', COL.green);
        drawApproveBadge(x4, yRow, 0.6 + approveP * 0.4, approvePulse);
      } else {
        drawLabel(x4 - cardW / 2, yRow - cardH / 2 - 44, cardW, 'ШАГ 4', 'Approve', COL.green);
        rr(x4 - cardW / 2, yRow - cardH / 2, cardW, cardH, 14, '#f8fafc', COL.cardBorder);
        text('Ожидание QA…', x4, yRow, 10, COL.muted, 'center', 500);
      }
    } else {
      var stackY = pad + 36;
      var gap = 18;
      drawLabel(pad, stackY - 44, cw - pad * 2, 'ШАГ 1', 'URL компании', COL.blue);
      drawUrlCard(pad, stackY, cw - pad * 2, 88, urlGlow);
      if (scanT > 0 && t < 0.22) drawScanBeam(pad, stackY, cw - pad * 2, 88, scanT);

      stackY += 88 + gap;
      if (briefP > 0 || t > 0.15) {
        drawLabel(pad, stackY - 44, cw - pad * 2, 'ШАГ 2', 'Research brief', COL.violet);
        drawBriefCard(pad, stackY, cw - pad * 2, 96, briefP);
        stackY += 96 + gap;
      }

      if (emailP > 0 || t > 0.38) {
        drawLabel(pad, stackY - 44, cw - pad * 2, 'ШАГ 3', 'Черновик', COL.amber);
        drawEmailCard(pad, stackY, cw - pad * 2, 100, emailP);
        stackY += 100 + gap;
      }

      if (approveP > 0) {
        drawApproveBadge(cw / 2, stackY + 36, 0.7 + approveP * 0.3, approvePulse);
      }
    }

    if (t > 0.78 && approveP > 0.9) {
      rr(cw / 2 - 108, ch - 34, 216, 22, 11, COL.greenSoft, COL.green);
      text('Готово к отправке из CRM', cw / 2, ch - 23, 9, COL.green, 'center', 700);
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

    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <aside class="nero-ai-card nero-ai-reveal nero-ai-inline-cta" aria-label="Демо: сгенерировать 3 B2B-письма">
        <p class="nero-ai-eyebrow">Лид-магнит · 3 письма</p>
        <h3>Сгенерируйте 3 персональных B2B-письма по URL из вашего ICP</h3>
        <p>Увидите research brief, icebreaker, subject и body на реальных данных — без часов ручного research и без шаблонного спама.</p>
        <div class="nero-ai-btn-row"><a class="nero-ai-btn nero-ai-btn-primary" href="#demo-3-pisma">Сгенерировать 3 письма</a></div>
      </aside>
    </div>
  </section>

  <section id="vnedrenie" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Внедрение AI-персонализации B2B-писем под ключ</h2>
      <p><strong>Внедрение ai персонализация писем</strong> — проект <strong>2–3 недели</strong>.</p>
      <h3>Аудит текущего outreach и шаблонов</h3>
      <p>ICP, шаблоны, CRM, источник базы, 152-ФЗ/38-ФЗ, reply rate baseline. 5–10 эталонных писем и запретные формулировки.</p>
      <h3>Пилот на 50–200 контактов и KPI (reply rate, time-to-draft)</h3>
      <p>Замер time-to-draft, edit rate, reply vs baseline. Пилот без риска для основного домена.</p>
      <h3>Масштабирование на отдел продаж</h3>
      <p>Обучение SDR, регламент approve, A/B subject. База <strong>&lt;200</strong> — иногда быстрее вручную; система окупается при регулярном outbound.</p>
      <p class="nero-ai-secondary-cta nero-ai-reveal">Чтобы SDR и менеджеры уверенно работали с AI-черновиками на пилоте, полезно пройти <a class="nero-ai-text-link" href="<?php echo esc_url($secondary_cta_url); ?>"><?php echo esc_html($secondary_cta_label); ?></a> — особенно если команда впервые получает персонализированные письма с research brief, а не собирает outreach вручную из LinkedIn и сайта.</p>
    </div>
  </section>

  <section id="integraciya-crm" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Интеграции: CRM, LinkedIn, сайт компании</h2>
      <p><strong>CRM персонализация писем</strong> — статусы, черновики, suppression, аналитика.</p>
      <h3>Bitrix24, amoCRM, HubSpot — типовые сценарии</h3>
      <p><strong>amoCRM/Bitrix24:</strong> webhook → n8n → AI → «черновик» → approve → Coldy/UniSender. <strong>HubSpot/Salesforce:</strong> custom properties + Instantly/Smartlead для export.</p>
      <h3>Enrichment через Apollo, Clay, Clearbit и open data</h3>
      <p><strong>Apollo:</strong> AI openers, <strong>50 generations/24h</strong> — data+sequences, слабый deliverability. <strong>Clay</strong> — enrichment, не sender. РФ: Контур.Компас, Rusprofile. Stack 2026: Apollo/Clay → AI → sender → CRM.</p>
    </div>
  </section>

  <section id="anti-spam" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Этика, GDPR, 152-ФЗ и anti-spam</h2>
      <p><strong>Anti-spam outreach</strong> — технический и юридический слой. Nero продаёт процесс и checklist, не «обход закона».</p>
      <h3>Согласие, opt-out и хранение персональных данных</h3>
      <p><strong>152-ФЗ:</strong> email сотрудника — ПДн; хранение в РФ (с 01.07.2025); правовое основание. <strong>38-ФЗ:</strong> метка «Реклама», рекламодатель, opt-out. B2B cold в РФ — серая зона; модель зависит от базы. <strong>CAN-SPAM/GDPR/EU AI Act</strong> (disclosure с авг. 2026 для EU) — для export.</p>
      <h3>Политика «не спамить»: частота, сегментация, стоп-листы</h3>
      <p>Suppression list, сегментация ICP, лимиты, footer с отпиской. LLM-judge + human approve.</p>
    </div>
  </section>

  <section id="metriki" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Метрики и бизнес-результат</h2>
      <h3>Ориентиры Salesforce 2026: −34% research, −36% drafting</h3>
      <p>Подтверждено: <strong>−34%</strong> research, <strong>−36%</strong> drafting; <strong>92%</strong> с agents — помогает prospecting. Aqfer: <strong>4–5 ч → 11–12 мин</strong>. Siemens + Agentforce — <strong>inbound</strong> follow-up (100% ответов на inbound, ~2% «потерянных»), <strong>не cold outbound</strong>.</p>
      <h3>Что измерять на пилоте: reply rate, meeting booked, edit rate</h3>
      <div class="nero-ai-table-wrap"><table class="nero-ai-table"><thead><tr><th>Метрика</th><th>Зачем</th></tr></thead><tbody>
        <tr><td>Reply rate</td><td>Главный KPI 2026</td></tr>
        <tr><td>Positive reply</td><td>Качество ответов</td></tr>
        <tr><td>Meeting booked</td><td>Воронка</td></tr>
        <tr><td>Time-to-draft</td><td>Экономия SDR</td></tr>
        <tr><td>Edit rate</td><td>Качество промптов</td></tr>
        <tr><td>Complaint rate</td><td>Здоровье домена</td></tr>
      </tbody></table></div>
      <p><strong>Осторожно:</strong> «5× reply от AI», «40–50% reply у топов» — vendor-контент без методологии.</p>
      <h3>Подтверждено / осторожно / слух</h3>
      <div class="nero-ai-table-wrap"><table class="nero-ai-table"><thead><tr><th>Статус</th><th>Примеры</th></tr></thead><tbody>
        <tr><td>✅ Подтверждено</td><td>Reply ~3,43% (Instantly); −34%/−36% (Salesforce); 18% vs 9% (Sopro)</td></tr>
        <tr><td>⚠️ Осторожно</td><td>«5× reply» (vendor); vc.ru без аудита</td></tr>
        <tr><td>🔇 Слух</td><td>«Тысячи писем без риска»; «B2B cold в РФ запрещён»; «open rate — главная метрика»</td></tr>
      </tbody></table></div>
    </div>
  </section>

  <section id="sravnenie-instrumentov" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Сравнение подходов: SaaS-инструменты vs кастомное внедрение</h2>
      <h3>Apollo, Instantly, Lemlist, Smartlead, Clay — когда хватает SaaS</h3>
      <div class="nero-ai-table-wrap"><table class="nero-ai-table"><thead><tr><th>Инструмент</th><th>Плюс</th><th>Минус</th></tr></thead><tbody>
        <tr><td>Apollo</td><td>Data, AI openers</td><td>Deliverability</td></tr>
        <tr><td>Instantly</td><td>Warmup, benchmarks</td><td>Глубина персонализации</td></tr>
        <tr><td>Lemlist</td><td>Multichannel</td><td>Не data platform</td></tr>
        <tr><td>Smartlead</td><td>Agency-scale</td><td>CRM glue</td></tr>
        <tr><td>Clay</td><td>Enrichment</td><td>Не sender</td></tr>
      </tbody></table></div>
      <p>Export-outbound: Apollo + Instantly. РФ: Coldy/UniSender, 152-ФЗ, amoCRM/Bitrix24 — SaaS не закрывает.</p>
      <h3>Когда нужно кастомное внедрение под вашу CRM и процессы</h3>
      <p>Несколько CRM, строгий QA, РФ+international, human-in-the-loop в CRM, чек <strong>80–220 тыс. ₽</strong> вместо 4–5 подписок. ChatGPT за $20 ≠ стоимость потерянного домена.</p>
    </div>
  </section>

  <section id="cena" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Сколько стоит внедрение</h2>
      <h3>Ориентир чека 80–220 тыс. ₽</h3>
      <p>Модель Nero Network; практика интеграторов (UP-IM, vc.ru) — <strong>50–120 тыс. ₽</strong>. <strong>Ai персонализация писем цена</strong> зависит от интеграций и пилота.</p>
      <h3>Что входит: промпты, интеграции, обучение, пилот</h3>
      <p>Аудит, CRM+enrichment, AI agents, QA, deliverability, пилот 50–200, обучение SDR, compliance checklist. Подписки Apollo/Clay/OpenAI — отдельно.</p>
      <aside class="nero-ai-card nero-ai-reveal nero-ai-inline-cta" aria-label="Аудит outreach и персонализации">
        <p class="nero-ai-eyebrow">Бесплатный аудит · 30 минут</p>
        <h3>Разберём ваш outreach до внедрения AI-персонализации</h3>
        <p>Посмотрим шаблоны, CRM, источник базы, reply rate baseline и риски по 152-ФЗ/38-ФЗ — с ориентиром бюджета на пилот 50–200 контактов.</p>
        <div class="nero-ai-btn-row"><a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a></div>
      </aside>
    </div>
  </section>

  <section id="faq" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-reveal">
      <div class="nero-ai-section-head"><p class="nero-ai-eyebrow">FAQ</p><h2>FAQ: AI-персонализация B2B-писем</h2></div>
      <div class="nero-ai-faq nero-ai-prose">
        <details class="nero-ai-reveal"><summary>Как персонализировать холодное письмо с помощью AI?</summary><p>URL + контакт → enrichment → icebreaker и draft → approve → отправка с лимитами.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1"><summary>Чем AI-персонализация писем отличается от массовой рассылки?</summary><p>Контекст компании, QA, approve, suppression vs один шаблон на тысячи.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-2"><summary>Сколько времени: вручную vs с AI?</summary><p><strong>15–45 мин</strong> vs минуты на draft; approve — менеджер.</p></details>
        <details class="nero-ai-reveal"><summary>Можно ли автоматизировать без спама?</summary><p>Warmup, SPF/DKIM/DMARC, <strong>30–50 писем/день</strong>, opt-out, human-in-the-loop.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1"><summary>Какие CRM поддерживают AI outreach?</summary><p>amoCRM, Bitrix24, HubSpot, Salesforce через n8n; Apollo — из коробки; РФ — кастом.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-2"><summary>Нужен ли human-in-the-loop?</summary><p>Да: галлюцинации, роботизированный тон — approve обязателен.</p></details>
        <details class="nero-ai-reveal"><summary>Законно ли в РФ (152-ФЗ)?</summary><p>Email — ПДн; 38-ФЗ для рекламы; юридическая оценка до массовой отправки.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1"><summary>Какие метрики: open rate, reply rate?</summary><p>Приоритет: reply, positive reply, meeting booked.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-2"><summary>Apollo/Lemlist/Clay — хватит SaaS?</summary><p>Export — часто да; РФ compliance и CRM-процессы — внедрение.</p></details>
        <details class="nero-ai-reveal"><summary>Сколько стоит внедрение?</summary><p><strong>80–220 тыс. ₽</strong> под ключ.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1"><summary>Чем отличается от генератора КП?</summary><p>Outreach с icebreaker и deliverability, не документ по брифу.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-2"><summary>Сколько писем в день безопасно?</summary><p><strong>30–50/mailbox</strong> после warmup.</p></details>
      </div>
    </div>
  </section>

  <section id="demo-3-pisma" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Сгенерировать 3 письма — демо и лид-магнит</h2>
      <p><strong>Ai персонализация писем</strong> на ваших данных: <strong>сгенерируем 3 письма</strong> по URL из ICP — brief, icebreaker, subject, body.</p>
      <p><strong>Лид-магнит: 5 примеров персональных B2B-писем:</strong></p>
      <ol>
        <li><strong>Trigger-based</strong> — новость или вакансия.</li>
        <li><strong>Pain-based</strong> — боль из сайта.</li>
        <li><strong>Social proof</strong> — похожий клиент.</li>
        <li><strong>Question-led</strong> — вопрос вместо pitch.</li>
        <li><strong>Follow-up</strong> — новый факт, не bump.</li>
      </ol>
      <div class="nero-ai-demo-panel nero-ai-card nero-ai-reveal" id="demo-3-pisma-panel">
        <form class="nero-ai-demo-form" id="demo-3-pisma-form" action="#demo-3-pisma" method="get">
          <label for="demo-company-url">URL компании из вашего ICP</label>
          <input type="url" id="demo-company-url" name="company_url" placeholder="https://example-logistics.ru" required />
          <label for="demo-offer-hint">Кратко: ваш оффер (опционально)</label>
          <textarea id="demo-offer-hint" name="offer_hint" placeholder="Например: внедрение AI-outreach с human-in-the-loop для отдела продаж"></textarea>
          <div class="nero-ai-btn-row"><button type="submit" class="nero-ai-btn nero-ai-btn-primary" id="demo-generate-btn">Сгенерировать 3 письма</button></div>
          <p class="nero-ai-demo-note">Демо показывает примеры черновиков на основе домена — без отправки и без сохранения данных. Полная генерация — после аудита outreach.</p>
        </form>
        <div class="nero-ai-demo-drafts" id="demo-3-pisma-drafts" aria-live="polite" aria-label="Примеры сгенерированных писем"></div>
      </div>
      <p><strong>CTA: Сгенерировать 3 письма</strong> — первый шаг к <strong>внедрению ai персонализация писем под ключ</strong> без спама и без часов research на контакт.</p>
      <div class="nero-ai-btn-row nero-ai-reveal"><a class="nero-ai-btn nero-ai-btn-primary" href="#demo-3-pisma-panel">Сгенерировать 3 письма</a></div>
    </div>
  </section>

  <section class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container">
      <section class="nero-ai-final-cta nero-ai-card nero-ai-reveal" aria-labelledby="final-cta-audit-outreach">
        <h2 id="final-cta-audit-outreach">Сначала аудит outreach — потом внедрение под ключ</h2>
        <p>Nero Network не продаёт «ещё один SaaS для рассылок». Начинаем с диагностики: ICP, deliverability, CRM и ориентир чека 80–220 тыс. ₽ на систему с human-in-the-loop.</p>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
          <a class="nero-ai-btn nero-ai-btn-primary" href="#demo-3-pisma">Сгенерировать 3 письма</a>
        </div>
      </section>
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
<script>
(function () {
  'use strict';
  var form = document.getElementById('demo-3-pisma-form');
  var draftsEl = document.getElementById('demo-3-pisma-drafts');
  if (!form || !draftsEl) return;
  function domainFromUrl(raw) {
    try { var u = new URL(raw.indexOf('://') === -1 ? 'https://' + raw : raw); return u.hostname.replace(/^www\./, ''); }
    catch (e) { return raw.replace(/^https?:\/\//, '').replace(/^www\./, '').split('/')[0] || 'компания'; }
  }
  function companyLabel(domain) { var base = domain.split('.')[0] || 'компания'; return base.charAt(0).toUpperCase() + base.slice(1); }
  function buildDrafts(url, offer) {
    var domain = domainFromUrl(url), name = companyLabel(domain), offerText = offer || 'AI-персонализация B2B-писем с human-in-the-loop';
    return [
      { type: 'Trigger-based', subject: 'Заметил расширение команды продаж у ' + name, brief: 'На сайте ' + domain + ' — вакансии SDR / менеджеров по продажам.', body: 'Здравствуйте! Увидел, что ' + name + ' набирает SDR — часто это сигнал роста outbound. Мы внедряем ' + offerText + ': enrichment по сайту и LinkedIn, черновик за минуты, approve в CRM. Имеет смысл 15-мин созвон?' },
      { type: 'Pain-based', subject: 'Outreach без шаблонного спама для ' + name, brief: 'ICP-fit: B2B с регулярным холодным outreach и ручным research.', body: 'Коллеги из ' + name + ', типичная боль — 15–45 мин на персональное письмо и reply ~3–4% у generic-рассылок. Nero Network собирает конвейер: brief → icebreaker → draft → QA → отправка с лимитами 30–50/день. Показать 3 примера на ваших URL?' },
      { type: 'Question-led', subject: 'Как у вас сейчас устроен research перед письмом?', brief: 'Вопрос вместо pitch — проверка процесса до оффера.', body: 'Добрый день! Изучил ' + domain + ' — интересный продуктовый фокус. Скажите, менеджеры сами собирают контекст (сайт, новости, LinkedIn) или уже пробовали Apollo/Clay? Спрашиваю, потому что помогаем командам вроде ' + name + ' с ' + offerText + ' без риска для домена.' }
    ];
  }
  function renderDrafts(items) {
    draftsEl.innerHTML = items.map(function (d) {
      return '<article class="nero-ai-demo-draft nero-ai-reveal nero-ai-active"><p class="nero-ai-demo-draft__type">' + d.type + '</p><h4>Research brief</h4><p>' + d.brief + '</p><p class="nero-ai-demo-draft__subject">Subject: ' + d.subject + '</p><h4>Body (черновик)</h4><p>' + d.body + '</p></article>';
    }).join('');
    draftsEl.classList.add('is-visible');
    draftsEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var url = (document.getElementById('demo-company-url') || {}).value || '';
    var offer = (document.getElementById('demo-offer-hint') || {}).value || '';
    if (!url.trim()) return;
    renderDrafts(buildDrafts(url.trim(), offer.trim()));
  });
})();
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type": "Question", "name": "Как персонализировать холодное письмо с помощью AI?", "acceptedAnswer": {"@type": "Answer", "text": "URL + контакт → enrichment → icebreaker и draft → approve → отправка с лимитами."}},
    {"@type": "Question", "name": "Чем AI-персонализация писем отличается от массовой рассылки?", "acceptedAnswer": {"@type": "Answer", "text": "Контекст компании, QA, approve, suppression vs один шаблон на тысячи."}},
    {"@type": "Question", "name": "Сколько времени: вручную vs с AI?", "acceptedAnswer": {"@type": "Answer", "text": "15–45 мин vs минуты на draft; approve — менеджер."}},
    {"@type": "Question", "name": "Можно ли автоматизировать без спама?", "acceptedAnswer": {"@type": "Answer", "text": "Warmup, SPF/DKIM/DMARC, 30–50 писем/день, opt-out, human-in-the-loop."}},
    {"@type": "Question", "name": "Какие CRM поддерживают AI outreach?", "acceptedAnswer": {"@type": "Answer", "text": "amoCRM, Bitrix24, HubSpot, Salesforce через n8n; Apollo — из коробки; РФ — кастом."}},
    {"@type": "Question", "name": "Нужен ли human-in-the-loop?", "acceptedAnswer": {"@type": "Answer", "text": "Да: галлюцинации, роботизированный тон — approve обязателен."}},
    {"@type": "Question", "name": "Законно ли в РФ (152-ФЗ)?", "acceptedAnswer": {"@type": "Answer", "text": "Email — ПДн; 38-ФЗ для рекламы; юридическая оценка до массовой отправки."}},
    {"@type": "Question", "name": "Какие метрики: open rate, reply rate?", "acceptedAnswer": {"@type": "Answer", "text": "Приоритет: reply, positive reply, meeting booked."}},
    {"@type": "Question", "name": "Apollo/Lemlist/Clay — хватит SaaS?", "acceptedAnswer": {"@type": "Answer", "text": "Export — часто да; РФ compliance и CRM-процессы — внедрение."}},
    {"@type": "Question", "name": "Сколько стоит внедрение?", "acceptedAnswer": {"@type": "Answer", "text": "80–220 тыс. ₽ под ключ."}},
    {"@type": "Question", "name": "Чем отличается от генератора КП?", "acceptedAnswer": {"@type": "Answer", "text": "Outreach с icebreaker и deliverability, не документ по брифу."}},
    {"@type": "Question", "name": "Сколько писем в день безопасно?", "acceptedAnswer": {"@type": "Answer", "text": "30–50/mailbox после warmup."}}
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "AI-персонализация B2B-писем — внедрение под ключ",
  "description": "Внедрим AI-систему персонализации B2B-писем: анализ компании клиента, релевантное холодное письмо за минуты — без массового спама.",
  "author": {"@type": "Organization", "name": "Nero Network"},
  "about": "AI-персонализация B2B-писем"
}
</script>

<?php
get_footer();

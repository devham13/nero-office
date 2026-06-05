<?php
/**
 * Template Name: AI-агент для обработки заявок с сайта
 * Description: Лонгрид — внедрение AI-агента для обработки заявок с сайта под ключ.
 */

$page_seo_title = 'AI-агент для обработки заявок с сайта — внедрение под ключ';
$page_seo_description = 'AI отвечает на заявки за 5–15 секунд, квалифицирует лида и передаёт в CRM. Внедрение AI-агента под ключ для МСБ: интеграция, цена, кейсы и аудит потерь заявок.';

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Связаться с нами';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#audit-cta';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Дополнительные материалы';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#services';

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

get_header();
?>

<!-- wp:html -->
<style>
.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs, .yoast-breadcrumb,
.entry-header, .page-title-section { display: none !important; }
#primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}
/**
 * Nero Network homepage design reference.
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

.nero-ai-home-page a { color: inherit; }
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
.nero-ai-btn {
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
.nero-ai-btn:hover,
.nero-ai-btn:focus-visible { transform: translateY(-2px); }
.nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--nero-ai-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.nero-ai-btn-secondary {
  color: var(--nero-ai-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.nero-ai-btn-secondary:hover { border-color: rgba(121, 242, 255, 0.36); background: rgba(121, 242, 255, 0.08); }

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

.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100vh - 1px));
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.nero-ai-hero::before {
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
.nero-ai-hero::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .12), transparent 66%);
  filter: blur(6px);
  animation: neroAiGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes neroAiGlow { from { opacity: .45; transform: translateX(-50%) scale(.96); } to { opacity: .86; transform: translateX(-50%) scale(1.06); } }

.nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(44px, 7.2vw, 94px);
  line-height: .89;
  letter-spacing: -0.075em;
}
.nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--nero-ai-soft) !important;
  font-size: clamp(18px, 2vw, 22px);
  line-height: 1.58;
}
.nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.nero-ai-badge {
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
  white-space: nowrap;
}
.nero-ai-hero .nero-ai-btn-row { margin-top: 34px; }

.nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--nero-ai-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.nero-ai-dots { display: flex; gap: 7px; }
.nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,.22); }
.nero-ai-dot:nth-child(1) { background: #fb7185; }
.nero-ai-dot:nth-child(2) { background: #fbbf24; }
.nero-ai-dot:nth-child(3) { background: #34d399; }
.nero-ai-window-title { color: #cfe3f9; font-size: 12px; font-weight: 750; letter-spacing: .08em; text-transform: uppercase; }
.nero-ai-window-body { padding: 18px; }
.nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
}
.nero-ai-dashboard-title h3 { margin: 0; font-size: 20px; letter-spacing: -0.03em; }
.nero-ai-live-pill {
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
.nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: neroAiPulse 1.6s infinite;
}
@keyframes neroAiPulse { 0%, 100% { transform: scale(.86); opacity: .65; } 50% { transform: scale(1); opacity: 1; } }

.nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
.nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.nero-ai-metric:hover,
.nero-ai-metric:focus-within { transform: translateY(-3px); border-color: rgba(121,242,255,.34); background: rgba(121,242,255,.07); }
.nero-ai-metric span { display: block; color: var(--nero-ai-muted); font-size: 12px; font-weight: 700; }
.nero-ai-metric strong { display: block; margin-top: 7px; color: #fff; font-size: 24px; line-height: 1; }
.nero-ai-metric small { display: block; margin-top: 6px; color: #9fb0c9; }

.nero-ai-task-stream { margin-top: 16px; display: grid; gap: 10px; }
.nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
  animation: neroAiTaskFloat 5s ease-in-out infinite;
}
.nero-ai-task:nth-child(2) { animation-delay: .6s; }
.nero-ai-task:nth-child(3) { animation-delay: 1.2s; }
.nero-ai-task:nth-child(4) { animation-delay: 1.8s; }
@keyframes neroAiTaskFloat { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-4px); } }
.nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--nero-ai-primary);
  font-size: 15px;
}
.nero-ai-task strong { display: block; color: #f8fafc; font-size: 13px; }
.nero-ai-task span { color: var(--nero-ai-muted); font-size: 12px; }
.nero-ai-status {
  padding: 5px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
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
  .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .nero-ai-dashboard { transform: none; }
  .nero-ai-grid-4 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .nero-ai-grid-3 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 820px) {
  .nero-ai-container { width: min(100% - 28px, var(--nero-ai-container)); }
  .nero-ai-hero { min-height: auto; padding-top: 56px; }
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
  .nero-ai-btn { width: 100%; }
}
@media (max-width: 520px) {
  .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .nero-ai-window-body { padding: 13px; }
  .nero-ai-task { grid-template-columns: 28px 1fr; }
  .nero-ai-status { grid-column: 2; width: fit-content; }
  .nero-ai-section { padding: 58px 0; }
}
@media (prefers-reduced-motion: reduce) {
  .nero-ai-home-page *,
  .nero-ai-home-page *::before,
  .nero-ai-home-page *::after { animation: none !important; transition: none !important; scroll-behavior: auto !important; }
  .nero-ai-reveal { opacity: 1; transform: none; }
}

/* Intro after hero */
.vnedrenie-ai-intro-section { padding-top: clamp(48px, 6vw, 72px); }
.vnedrenie-ai-intro-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 28px;
  align-items: start;
  text-align: left !important;
}
@media (min-width: 901px) {
  .vnedrenie-ai-intro-grid { grid-template-columns: 1.05fr 0.95fr; gap: 36px; }
}
.vnedrenie-ai-intro-text {
  text-align: left !important;
  border-left: 4px solid;
  border-image: linear-gradient(180deg, var(--nero-ai-primary), var(--nero-ai-primary-2)) 1;
  padding-left: clamp(18px, 2.5vw, 28px);
}
.vnedrenie-ai-intro-text p { text-align: left !important; margin: 0 0 16px; font-size: clamp(16px, 1.6vw, 18px); line-height: 1.65; color: var(--nero-ai-soft) !important; }
.vnedrenie-ai-intro-text p:last-child { margin-bottom: 0; }
.vnedrenie-ai-intro-lead { font-size: clamp(17px, 1.8vw, 20px) !important; color: var(--nero-ai-text) !important; font-weight: 600; }
.vnedrenie-ai-intro-terminal {
  padding: 18px;
  border-radius: var(--nero-ai-radius-lg);
  border: 1px solid var(--nero-ai-border);
  background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.04));
  font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
  font-size: 12px;
  line-height: 1.55;
}
.vnedrenie-ai-intro-terminal-head {
  display: flex; gap: 6px; margin-bottom: 14px;
}
.vnedrenie-ai-intro-terminal-head span { width: 9px; height: 9px; border-radius: 50%; background: rgba(255,255,255,.25); }
.vnedrenie-ai-intro-terminal-head span:nth-child(1) { background: #fb7185; }
.vnedrenie-ai-intro-terminal-head span:nth-child(2) { background: #fbbf24; }
.vnedrenie-ai-intro-terminal-head span:nth-child(3) { background: #34d399; }
.vnedrenie-ai-intro-terminal code { color: var(--nero-ai-primary); }
.vnedrenie-ai-intro-chips { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 16px; }
.vnedrenie-ai-intro-chip {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 8px 12px; border-radius: 999px;
  border: 1px solid rgba(121,242,255,.22);
  background: rgba(121,242,255,.08);
  color: var(--nero-ai-primary) !important;
  font-size: 12px; font-weight: 750;
}
.ym-toc-wrap { display: flex; justify-content: center; margin-top: clamp(36px, 5vw, 52px); }
.ym-toc {
  display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;
  max-width: 980px; padding: 0; margin: 0; list-style: none;
}
.ym-toc a {
  display: inline-flex; padding: 10px 16px; border-radius: 999px;
  border: 1px solid rgba(255,255,255,.12);
  background: rgba(255,255,255,.05);
  color: var(--nero-ai-soft) !important;
  font-size: 13px; font-weight: 700; text-decoration: none !important;
  transition: border-color .2s, background .2s;
}
.ym-toc a:hover { border-color: rgba(121,242,255,.36); background: rgba(121,242,255,.08); }
.nero-ai-prose { max-width: 820px; margin: 0 auto; text-align: left; }
.nero-ai-prose h2 { margin: 0 0 20px; font-size: clamp(28px, 3.5vw, 44px); line-height: 1.05; scroll-margin-top: 100px; }
.nero-ai-prose h3 { margin: 28px 0 12px; font-size: clamp(20px, 2.2vw, 26px); scroll-margin-top: 100px; }
.nero-ai-prose p, .nero-ai-prose li { font-size: 16px; line-height: 1.68; color: var(--nero-ai-muted); }
.nero-ai-prose ul, .nero-ai-prose ol { margin: 0 0 18px; padding-left: 22px; }
.nero-ai-prose strong { color: var(--nero-ai-text); }
.nero-ai-prose table { width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px; }
.nero-ai-prose th, .nero-ai-prose td { border: 1px solid rgba(255,255,255,.12); padding: 12px 14px; text-align: left; vertical-align: top; }
.nero-ai-prose th { background: rgba(255,255,255,.06); color: var(--nero-ai-heading); }
.nero-ai-kpi-strip { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin: 28px 0; }
@media (max-width: 820px) { .nero-ai-kpi-strip { grid-template-columns: 1fr; } }
.nero-ai-kpi-mini { padding: 16px; border-radius: 18px; border: 1px solid rgba(255,255,255,.1); background: rgba(255,255,255,.04); text-align: center; }
.nero-ai-kpi-mini strong { display: block; color: var(--nero-ai-primary); font-size: 22px; }
.nero-ai-kpi-mini span { display: block; margin-top: 6px; font-size: 12px; color: var(--nero-ai-muted); }
#ai-lead-hero.fullscreen-white-office { min-height: 100vh; min-height: 100dvh; position: relative; }

</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-obrabotka-zayavok-s-sayta-page" role="main" tabindex="-1">
<span id="main" tabindex="-1" class="screen-reader-text" aria-hidden="true"></span>
<section id="ai-lead-hero" class="fullscreen-white-office ai-lead-hero" aria-labelledby="ai-lead-h1">
<style>
.fullscreen-white-office {
  position: relative;
  overflow: hidden;
  min-height: 100vh;
  background: #f8fafc;
}
.ai-lead-hero {
  background:
    radial-gradient(ellipse 80% 60% at 70% 20%, rgba(139, 92, 246, 0.06), transparent 50%),
    radial-gradient(ellipse 50% 40% at 15% 85%, rgba(249, 115, 22, 0.05), transparent 45%),
    linear-gradient(180deg, #ffffff 0%, #f1f5f9 100%);
}
.ai-lead-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(15, 23, 42, 0.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(15, 23, 42, 0.03) 1px, transparent 1px);
  background-size: 48px 48px;
  pointer-events: none;
  z-index: 1;
}
#ai-lead-night-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  z-index: 2;
}
.ai-lead-hero-copy {
  position: absolute;
  left: clamp(16px, 4vw, 56px);
  bottom: clamp(80px, 12vh, 140px);
  max-width: min(640px, 92vw);
  z-index: 4;
}
.giant-seo {
  font-size: clamp(32px, 4.8vw, 68px);
  font-weight: 900;
  line-height: 1.08;
  letter-spacing: -2px;
  color: #0f172a;
  margin: 0;
}
.giant-seo span {
  display: block;
  background: linear-gradient(90deg, #6366f1, #f97316);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.giant-seo-sub {
  font-size: clamp(15px, 1.8vw, 20px);
  line-height: 1.55;
  color: rgba(15, 23, 42, 0.72);
  margin-top: 18px;
  max-width: 580px;
}
.telegram-button {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-top: 22px;
  padding: 12px 22px;
  background: #0f172a;
  color: #fff !important;
  border-radius: 999px;
  font-weight: 700;
  font-size: 14px;
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.2s;
  box-shadow: 0 4px 14px rgba(15, 23, 42, 0.18);
}
.telegram-button:hover { transform: translateY(-2px); }
.vl-ui-tasks {
  position: absolute;
  left: clamp(16px, 4vw, 56px);
  top: clamp(72px, 10vh, 120px);
  display: flex;
  flex-direction: column;
  gap: 8px;
  z-index: 4;
}
.vl-ui-task {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 16px;
  background: rgba(255, 255, 255, 0.94);
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  font-size: 13px;
  font-weight: 600;
  color: #334155;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  backdrop-filter: blur(6px);
}
.vl-ui-task span {
  width: 26px;
  height: 26px;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  color: #fff;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 800;
  flex-shrink: 0;
}
.vl-ui-pill {
  position: absolute;
  right: clamp(16px, 4vw, 56px);
  bottom: clamp(24px, 5vh, 48px);
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-end;
  gap: 10px;
  z-index: 4;
  max-width: min(420px, 90vw);
}
.vl-ui-pill span {
  padding: 9px 16px;
  background: rgba(255, 255, 255, 0.94);
  border: 1px solid #e2e8f0;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  color: #334155;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}
@media (max-width: 768px) {
  .vl-ui-tasks { display: none; }
  .ai-lead-hero {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: clamp(72px, 12vh, 96px) clamp(16px, 4vw, 24px) clamp(20px, 4vh, 32px);
    box-sizing: border-box;
  }
  .ai-lead-hero-copy {
    position: relative;
    left: auto;
    bottom: auto;
    order: 1;
    margin-bottom: 14px;
    max-width: 100%;
  }
  .vl-ui-pill {
    position: relative;
    right: auto;
    bottom: auto;
    left: auto;
    transform: none;
    order: 2;
    justify-content: flex-start;
    max-width: 100%;
    gap: 8px;
  }
  .vl-ui-pill span {
    padding: 7px 12px;
    font-size: 11px;
  }
}
@media (max-width: 900px) and (min-width: 769px) {
  .vl-ui-pill { bottom: clamp(48px, 8vh, 72px); }
  .ai-lead-hero-copy { bottom: clamp(120px, 16vh, 180px); }
}
</style>

<canvas id="ai-lead-night-canvas" aria-hidden="true"></canvas>

<div class="vl-ui-tasks" aria-label="Этапы обработки заявки">
  <div class="vl-ui-task"><span>1</span> Заявка с формы</div>
  <div class="vl-ui-task"><span>2</span> AI за 5–15 сек</div>
  <div class="vl-ui-task"><span>3</span> Квалификация</div>
  <div class="vl-ui-task"><span>4</span> Запись в CRM</div>
  <div class="vl-ui-task"><span>5</span> Алерт менеджеру</div>
</div>

<div class="ai-lead-hero-copy">
  <h1 id="ai-lead-h1" class="giant-seo">
    AI-агент для обработки заявок с сайта:
    <span>внедрение под ключ</span>
  </h1>
  <p class="giant-seo-sub">Ответ за 5–15 секунд вместо часов ожидания — AI квалифицирует заявку и передаёт горячий лид в CRM, пока менеджеры офлайн</p>
  <a class="telegram-button" href="#audit-cta">Проверить потери заявок</a>
</div>

<div class="vl-ui-pill" aria-label="Метрики">
  <span>24/7</span>
  <span>5–15 сек</span>
  <span>amoCRM</span>
  <span>Битрикс24</span>
</div>

<script id="ai-lead-night-engine">
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("ai-lead-night-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");

  let cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    if (!canvas.parentElement) return;
    canvas.width = canvas.parentElement.clientWidth || window.innerWidth;
    canvas.height = canvas.parentElement.clientHeight || window.innerHeight;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 20;
    scale = cw < 768 ? cw / 560 : Math.min(cw / 980, ch / 760) * 1.35;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  const C = {
    outline: "#0f172a",
    softLine: "#cbd5e1",
    portalGlow: "#6366f1",
    riverData: "#38bdf8",
    cardCold: "#e2e8f0",
    cardWarm: "#fde68a",
    cardHot: "#fca5a5",
    nexusCore: "#8b5cf6",
    nexusRing: "#c4b5fd",
    crmGreen: "#10b981",
    crmBody: "#f8fafc",
    moon: "#fef3c7",
    windowGlass: "rgba(226, 232, 240, 0.5)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#ffffff",
    telegramBlue: "#0ea5e9"
  };

  function drawPolyRound(ctx, x, y, w, h, radius, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, radius);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  class NightSkyWindow {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(ctx) {
      drawPolyRound(ctx, this.x, this.y, 220, 90, 10, C.windowGlass, C.outline);
      ctx.save();
      ctx.beginPath();
      if (ctx.roundRect) ctx.roundRect(this.x, this.y, 220, 90, 10);
      else ctx.rect(this.x, this.y, 220, 90);
      ctx.clip();
      ctx.fillStyle = "#e0e7ff";
      ctx.fillRect(this.x, this.y, 220, 90);
      for (let i = 0; i < 8; i++) {
        ctx.fillStyle = "#fff";
        ctx.beginPath();
        ctx.arc(this.x + 30 + i * 22, this.y + 20 + (i % 3) * 12, 1.2, 0, Math.PI * 2);
        ctx.fill();
      }
      ctx.fillStyle = C.moon;
      ctx.beginPath();
      ctx.arc(this.x + 170, this.y + 28, 14, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1.5;
      ctx.stroke();
      ctx.restore();
      ctx.fillStyle = C.outline;
      ctx.font = "bold 9px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("02:47 — менеджеры офлайн", this.x + 110, this.y + 78);
    }
  }

  class SiteFormPortal {
    constructor(x, y) { this.x = x; this.y = y; this.pulse = 0; }
    draw(ctx) {
      this.pulse = (Math.sin(frame * 0.08) + 1) * 0.5;
      ctx.save();
      ctx.globalAlpha = 0.15 + this.pulse * 0.2;
      ctx.fillStyle = C.portalGlow;
      ctx.beginPath();
      ctx.arc(this.x + 50, this.y + 55, 55 + this.pulse * 8, 0, Math.PI * 2);
      ctx.fill();
      ctx.restore();
      drawPolyRound(ctx, this.x, this.y, 100, 110, 8, "#fff", C.outline);
      drawPolyRound(ctx, this.x + 8, this.y + 8, 84, 18, [6, 6, 0, 0], "#e2e8f0", C.outline);
      drawPolyRound(ctx, this.x + 12, this.y + 32, 76, 10, 2, C.cardCold, C.softLine);
      drawPolyRound(ctx, this.x + 12, this.y + 48, 76, 10, 2, C.cardCold, C.softLine);
      drawPolyRound(ctx, this.x + 12, this.y + 64, 48, 10, 2, C.cardCold, C.softLine);
      drawPolyRound(ctx, this.x + 12, this.y + 82, 36, 14, 4, C.nexusCore, C.outline);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Отправить", this.x + 30, this.y + 92);
    }
  }

  class WebhookRiver {
    constructor() {
      this.pathY = 30;
    }
    draw(ctx) {
      const prg = (frame * 0.035) % 240;
      ctx.lineWidth = 3;
      ctx.setLineDash([8, 6]);
      ctx.strokeStyle = C.riverData;
      ctx.beginPath();
      ctx.moveTo(-280, this.pathY + 20);
      ctx.bezierCurveTo(-120, this.pathY - 30, 40, this.pathY + 50, 180, this.pathY);
      ctx.stroke();
      ctx.setLineDash([]);

      const cards = [
        { offset: 0, color: C.cardCold, label: "form" },
        { offset: 80, color: C.cardWarm, label: "chat" },
        { offset: 160, color: C.cardHot, label: "hot" }
      ];
      cards.forEach((card) => {
        let t = ((prg * 1.2 + card.offset) % 240) / 240;
        if (t > 0.85) return;
        const bx = -280 + t * 460;
        const by = this.pathY + 20 + Math.sin(t * Math.PI * 2) * 18 - t * 15;
        drawPolyRound(ctx, bx, by, 22, 16, 3, card.color, C.outline);
        if (t > 0.55 && t < 0.75) {
          ctx.fillStyle = C.outline;
          ctx.font = "bold 7px Inter, sans-serif";
          ctx.fillText("JSON", bx + 11, by + 10);
        }
      });
    }
  }

  class ResponseChrono {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(ctx) {
      const prg = (frame * 0.035) % 240;
      let sec = 15;
      if (prg >= 55 && prg < 145) {
        sec = Math.max(5, 15 - Math.floor((prg - 55) / 9));
      } else if (prg >= 145) {
        sec = 5;
      }
      drawPolyRound(ctx, this.x, this.y, 72, 28, 14, "#fff", C.outline);
      ctx.fillStyle = sec <= 8 ? "#ef4444" : C.crmGreen;
      ctx.beginPath();
      ctx.arc(this.x + 14, this.y + 14, 5, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = C.outline;
      ctx.font = "bold 11px Inter, sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(sec + " сек", this.x + 26, this.y + 18);
    }
  }

  class QualificationNexus {
    constructor(x, y) {
      this.x = x;
      this.y = y;
      this.orbit = 0;
    }
    draw(ctx) {
      const prg = (frame * 0.035) % 240;
      this.orbit += 0.04;

      for (let r = 0; r < 3; r++) {
        ctx.strokeStyle = C.nexusRing;
        ctx.lineWidth = 1.5;
        ctx.globalAlpha = 0.35 - r * 0.08;
        ctx.beginPath();
        ctx.arc(this.x, this.y, 48 + r * 18, 0, Math.PI * 2);
        ctx.stroke();
      }
      ctx.globalAlpha = 1;

      ctx.fillStyle = C.nexusCore;
      ctx.beginPath();
      ctx.arc(this.x, this.y, 36, 0, Math.PI * 2);
      ctx.fill();
      ctx.lineWidth = 2;
      ctx.strokeStyle = C.outline;
      ctx.stroke();

      ctx.fillStyle = "#fff";
      ctx.font = "bold 10px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("AI", this.x, this.y - 4);
      ctx.font = "8px Inter, sans-serif";
      ctx.fillText("NEXUS", this.x, this.y + 8);

      for (let i = 0; i < 4; i++) {
        const ang = this.orbit + (i * Math.PI) / 2;
        const ox = this.x + Math.cos(ang) * 58;
        const oy = this.y + Math.sin(ang) * 38;
        ctx.fillStyle = ["#a7f3d0", "#93c5fd", "#fbcfe8", "#fde68a"][i];
        ctx.beginPath();
        ctx.arc(ox, oy, 5, 0, Math.PI * 2);
        ctx.fill();
        ctx.strokeStyle = C.outline;
        ctx.lineWidth = 1;
        ctx.stroke();
      }

      if (prg >= 55 && prg < 145) {
        const lines = Math.min(4, Math.floor((prg - 55) / 22));
        for (let i = 0; i < lines; i++) {
          drawPolyRound(ctx, this.x - 42, this.y - 55 + i * 12, 84, 8, 2, "#fff", C.softLine);
        }
        ctx.fillStyle = C.outline;
        ctx.font = "7px Inter, sans-serif";
        ctx.fillText("квалификация...", this.x, this.y + 52);
      }

      if (prg >= 145 && prg < 210) {
        ctx.fillStyle = "#ef4444";
        ctx.font = "bold 12px Inter, sans-serif";
        ctx.fillText("HOT", this.x, this.y - 58);
      }
    }
  }

  class CRMVault {
    constructor(x, y) {
      this.x = x;
      this.y = y;
      this.cardSlide = 0;
      this.flash = 0;
    }
    draw(ctx) {
      const prg = (frame * 0.035) % 240;
      drawPolyRound(ctx, this.x, this.y, 110, 130, 8, C.crmBody, C.outline);
      drawPolyRound(ctx, this.x + 8, this.y + 8, 94, 22, [6, 6, 0, 0], C.crmGreen, C.outline);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 9px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("CRM", this.x + 55, this.y + 22);

      for (let i = 0; i < 3; i++) {
        drawPolyRound(ctx, this.x + 12, this.y + 38 + i * 28, 86, 22, 4, "#fff", C.softLine);
        ctx.fillStyle = C.softLine;
        ctx.fillRect(this.x + 18, this.y + 46 + i * 28, 50, 3);
        ctx.fillRect(this.x + 18, this.y + 52 + i * 28, 35, 3);
      }

      if (prg >= 145 && prg < 220) {
        this.cardSlide = Math.min(1, (prg - 145) / 35);
        const cx = this.x + 55 - (1 - this.cardSlide) * 120;
        const cy = this.y + 70 - (1 - this.cardSlide) * 40;
        drawPolyRound(ctx, cx - 28, cy - 18, 56, 36, 4, C.cardHot, C.outline);
        ctx.fillStyle = C.outline;
        ctx.font = "bold 8px Inter, sans-serif";
        ctx.fillText("Лид #847", cx, cy);
        ctx.fillStyle = "#ef4444";
        ctx.fillText("HOT", cx, cy + 10);
        if (this.cardSlide >= 0.95) this.flash = 12;
      } else {
        this.cardSlide = 0;
      }

      if (this.flash > 0) {
        ctx.save();
        ctx.globalAlpha = this.flash / 12 * 0.35;
        ctx.fillStyle = C.crmGreen;
        ctx.beginPath();
        ctx.arc(this.x + 55, this.y + 70, 50, 0, Math.PI * 2);
        ctx.fill();
        ctx.restore();
        this.flash--;
      }
    }
  }

  class TelegramPulse {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(ctx) {
      const prg = (frame * 0.035) % 240;
      if (prg < 160 || prg > 230) return;
      const pulse = (Math.sin(frame * 0.2) + 1) * 0.5;
      ctx.save();
      ctx.globalAlpha = 0.2 + pulse * 0.3;
      ctx.fillStyle = C.telegramBlue;
      ctx.beginPath();
      ctx.arc(this.x, this.y, 22 + pulse * 6, 0, Math.PI * 2);
      ctx.fill();
      ctx.restore();
      drawPolyRound(ctx, this.x - 16, this.y - 16, 32, 32, 16, C.telegramBlue, C.outline);
      ctx.fillStyle = "#fff";
      ctx.beginPath();
      ctx.moveTo(this.x - 6, this.y + 2);
      ctx.lineTo(this.x + 8, this.y - 6);
      ctx.lineTo(this.x + 2, this.y + 2);
      ctx.lineTo(this.x + 6, this.y + 8);
      ctx.closePath();
      ctx.fill();
    }
  }

  class ManagerSleepPod {
    constructor(x, y) { this.x = x; this.y = y; }
    draw(ctx) {
      drawPolyRound(ctx, this.x, this.y, 90, 50, 6, "#fff", C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "8px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Менеджеры", this.x + 45, this.y + 14);
      for (let i = 0; i < 3; i++) {
        ctx.fillStyle = C.softLine;
        ctx.beginPath();
        ctx.arc(this.x + 22 + i * 22, this.y + 32, 8, 0, Math.PI * 2);
        ctx.fill();
      }
      const prg = (frame * 0.035) % 240;
      if (prg < 200) {
        ctx.fillStyle = C.outline;
        ctx.font = "bold 10px Inter, sans-serif";
        ctx.fillText("Zzz", this.x + 68, this.y + 28 + Math.sin(frame * 0.1) * 2);
      } else {
        ctx.fillStyle = C.crmGreen;
        ctx.font = "bold 8px Inter, sans-serif";
        ctx.fillText("Утро!", this.x + 45, this.y + 42);
      }
    }
  }

  class Agent {
    constructor(x, y, color, role, stepTrig, dialogs) {
      this.x = x;
      this.y = y;
      this.baseX = x;
      this.baseY = y;
      this.color = color;
      this.role = role;
      this.timer = Math.random() * 100;
      this.stepTrig = stepTrig;
      this.dialogs = dialogs;
      this.hitAnimation = 0;
    }

    draw(ctx) {
      this.timer += 0.03;
      let isMoving = false;
      let carryType = null;
      let faceDir = 1;

      const prg = (frame * 0.035) % 240;
      let targetX = 0;
      let targetY = -20;

      if (this.role === "1_architect") { targetX = -200; targetY = 10; }
      else if (this.role === "2_seo") { targetX = -60; targetY = -50; }
      else if (this.role === "3_coder") { targetX = 30; targetY = 30; }
      else if (this.role === "4_designer") { targetX = -120; targetY = 40; }
      else if (this.role === "5_deployer") { targetX = 200; targetY = 20; }

      if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
        const localPrg = prg - this.stepTrig;
        if (localPrg < 12) {
          isMoving = true;
          faceDir = targetX > this.baseX ? 1 : -1;
          carryType = this.color;
          this.x = this.baseX + (targetX - this.baseX) * (localPrg / 12);
          this.y = this.baseY + (targetY - this.baseY) * (localPrg / 12);
        } else if (localPrg < 16) {
          this.x = targetX;
          this.y = targetY;
        } else {
          isMoving = true;
          faceDir = targetX > this.baseX ? -1 : 1;
          this.x = targetX - (targetX - this.baseX) * ((localPrg - 16) / 12);
          this.y = targetY - (targetY - this.baseY) * ((localPrg - 16) / 12);
        }
      } else {
        this.x = this.baseX;
        this.y = this.baseY;
        carryType = prg >= this.stepTrig - 8 ? this.color : null;
      }

      if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 22, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
      }

      let bob = Math.sin(this.timer * 1.5) * (isMoving ? 2 : 1);
      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.lineJoin = "round";

      let legL = 0, legR = 0;
      if (isMoving) {
        const walkPhase = this.timer * 6;
        legL = Math.sin(walkPhase) * 5;
        legR = Math.sin(walkPhase + Math.PI) * 5;
      }
      drawPolyRound(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
      drawPolyRound(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
      drawPolyRound(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
      drawPolyRound(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);

      drawPolyRound(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);

      let hx = 0, hy = -28 - bob;
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(hx, hy, 12, 0, Math.PI * 2);
      ctx.fill();
      ctx.lineWidth = 2;
      ctx.strokeStyle = C.outline;
      ctx.stroke();

      ctx.save();
      ctx.scale(faceDir, 1);
      ctx.fillStyle = "#fff";
      ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(hx - 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
      ctx.fillStyle = C.outline;
      ctx.beginPath(); ctx.arc(hx + 5, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 2, 0, Math.PI * 2); ctx.fill();

      if (this.role === "1_architect") {
        ctx.strokeStyle = C.outline; ctx.lineWidth = 1;
        ctx.strokeRect(hx + 1, hy - 5, 6, 6);
        ctx.strokeRect(hx - 7, hy - 5, 6, 6);
      } else if (this.role === "2_seo") {
        drawPolyRound(ctx, hx - 12, hy - 14, 24, 8, [6, 6, 0, 0], C.outline, null);
      } else if (this.role === "3_coder") {
        ctx.fillStyle = C.outline;
        ctx.fillRect(hx - 8, hy - 10, 16, 3);
        ctx.fillRect(hx - 6, hy - 6, 12, 3);
      } else if (this.role === "4_designer") {
        drawPolyRound(ctx, hx - 14, hy - 12, 28, 6, 3, "#f43f5e", C.outline);
      } else if (this.role === "5_deployer") {
        ctx.strokeStyle = C.outline; ctx.lineWidth = 2;
        ctx.beginPath(); ctx.arc(hx, hy, 14, Math.PI, Math.PI * 2); ctx.stroke();
      }
      ctx.restore();

      if (carryType) {
        drawPolyRound(ctx, -18 * faceDir, -18 - bob, 14, 14, 2, carryType, C.outline);
      }
      ctx.restore();
    }
  }

  const entities = [];
  const bubbles = [];

  entities.push(new NightSkyWindow(120, -200));
  entities.push(new WebhookRiver());
  entities.push(new SiteFormPortal(-260, -30));
  entities.push(new QualificationNexus(0, -60));
  entities.push(new ResponseChrono(-38, -110));
  entities.push(new CRMVault(220, -50));
  entities.push(new TelegramPulse(290, -90));
  entities.push(new ManagerSleepPod(200, 100));

  entities.push(new Agent(-320, 80, C.agentYellow, "1_architect", 18, [
    "Webhook на форму...", "Схема intake готова", "Портал ловит ночные лиды"
  ]));
  entities.push(new Agent(-240, 130, C.agentGreen, "2_seo", 52, [
    "UTM: yandex/cpc", "Тег «ночная заявка»", "Источник в CRM"
  ]));
  entities.push(new Agent(-100, 60, C.agentBlue, "3_coder", 88, [
    "n8n → OpenAI → CRM", "JSON полей лида", "Guardrails включены"
  ]));
  entities.push(new Agent(-180, 150, C.agentPink, "4_designer", 118, [
    "Виджет чата на сайте", "152-ФЗ чекбокс", "UX «ответ за секунды»"
  ]));
  entities.push(new Agent(-40, 110, C.agentPurple, "5_deployer", 158, [
    "amoCRM complex API", "Telegram-алерт hot", "Пилот на проде"
  ]));

  function createBubble(x, y, text, customLife = 280) {
    bubbles.push({ x, y, text, life: customLife, maxLife: customLife });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort((a, b) => (a.y || 0) - (b.y || 0));
    entities.forEach((ent) => ent.draw(ctx));

    const prg = (frame * 0.035) % 240;
    if (prg >= 12 && prg < 12.05) createBubble(-260, -20, "1. Заявка с формы");
    if (prg >= 58 && prg < 58.05) createBubble(-10, -90, "2. AI за 5–15 сек");
    if (prg >= 98 && prg < 98.05) createBubble(0, -120, "3. Квалификация BANT");
    if (prg >= 148 && prg < 148.05) createBubble(220, -70, "4. Запись в CRM");
    if (prg >= 188 && prg < 188.05) createBubble(290, -100, "5. Telegram менеджеру");

    ctx.font = "bold 11px Inter, sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    ctx.lineJoin = "round";

    for (let i = bubbles.length - 1; i >= 0; i--) {
      const bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      let alpha = Math.min(1, bub.life / 30);
      if (bub.life > bub.maxLife - 10) alpha = (bub.maxLife - bub.life) / 10;
      ctx.globalAlpha = alpha;
      const tw = ctx.measureText(bub.text).width + 16;
      const th = 20;
      const bx = bub.x;
      const by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawPolyRound(ctx, bx - tw / 2, by - th, tw, th, 6, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleBg;
      ctx.beginPath();
      ctx.moveTo(bx - 4, by);
      ctx.lineTo(bx + 4, by);
      ctx.lineTo(bx, by + 5);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.stroke();
      ctx.fillStyle = C.outline;
      ctx.fillText(bub.text, bx, by - th / 2);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  document.fonts.ready.then(() => engineloop());
});
</script>
</section>

<section class="nero-ai-section nero-ai-section-tight vnedrenie-ai-intro-section" aria-label="Введение">
  <div class="nero-ai-container">
    <div class="vnedrenie-ai-intro-grid nero-ai-reveal">
      <div class="vnedrenie-ai-intro-text">
        <p class="nero-ai-eyebrow">Коротко</p>
        <p class="vnedrenie-ai-intro-lead">AI-агент принимает заявку с сайта за 5–15 секунд, уточняет данные, квалифицирует лид и передаёт его в CRM — пока менеджеры офлайн.</p>
        <p>Это не скриптовый чат-бот, а слой автоматизации между формой и amoCRM или Битрикс24.</p>
      </div>
      <div class="vnedrenie-ai-intro-decor" aria-hidden="true">
        <div class="vnedrenie-ai-intro-terminal">
          <div class="vnedrenie-ai-intro-terminal-head"><span></span><span></span><span></span></div>
          <div><code>webhook</code> → AI-агент → <code>crm.lead.add</code></div>
          <div style="margin-top:8px;color:var(--nero-ai-muted)">P90 response: <strong style="color:#22c55e">≤15 сек</strong></div>
          <div style="margin-top:4px;color:var(--nero-ai-muted)">night leads: <strong style="color:#f59e0b">~40%</strong></div>
          <div class="vnedrenie-ai-intro-chips">
            <span class="vnedrenie-ai-intro-chip">24/7</span>
            <span class="vnedrenie-ai-intro-chip">amoCRM</span>
            <span class="vnedrenie-ai-intro-chip">Битрикс24</span>
            <span class="vnedrenie-ai-intro-chip">human handoff</span>
          </div>
        </div>
      </div>
    </div>
    <div class="ym-toc-wrap">
      <nav class="ym-toc nero-ai-reveal nero-ai-delay-1" aria-label="Оглавление">
        <a href="#poterya-zayavok">Потери заявок</a>
        <a href="#chto-takoe-agent">Что такое AI-агент</a>
        <a href="#kak-rabotaet">Сценарий 5–15 сек</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#crm">CRM</a>
        <a href="#cena">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#riski">Риски</a>
        <a href="#faq">FAQ</a>
        <a href="#audit-cta">Аудит</a>
      </nav>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-section-alt" id="poterya-zayavok">
  <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
    <h2>Почему заявки с сайта теряются: ночь, выходные и медленный ответ менеджеров</h2>
    <p>Заявка с сайта — это не «ещё одно письмо в почте». Это клиент, который уже выбрал вас среди конкурентов и готов к диалогу. Проблема в том, что <strong>большинство обращений приходит вне рабочего графика менеджеров</strong>: вечером, ночью, в выходные. Пока отдел продаж «просыпается», лид остывает — уходит к тому, кто ответил первым.</p>
    <p><strong>Определение:</strong> <em>потеря заявок с сайта</em> — ситуация, когда обращение не получает первичный контакт в допустимое для клиента время, и лид уходит к конкуренту или откладывает решение на неопределённый срок.</p>
    <p>По оценке интегратора Botseller (материалы вендора, не независимый аудит), <strong>около 40% обращений приходят в нерабочее время</strong>. Типичный сценарий понедельника: менеджер открывает CRM в 9:00 и видит десятки непрочитанных заявок с выходных — часть клиентов уже нашла другого подрядчика.</p>
    <div class="nero-ai-kpi-strip nero-ai-reveal nero-ai-delay-1">
      <div class="nero-ai-kpi-mini"><strong>~40%</strong><span>заявок вне рабочего времени</span></div>
      <div class="nero-ai-kpi-mini"><strong>&gt;10 мин</strong><span>~50% клиентов уходят (CNews 2025)</span></div>
      <div class="nero-ai-kpi-mini"><strong>×21</strong><span>разница квалификации: 5 vs 30 мин (MIT/HBR)</span></div>
    </div>
    <h3 id="stoimost-potery">Сколько стоит каждая потерянная заявка для МСБ</h3>
    <p>Для малого и среднего бизнеса — клиники, онлайн-школы, локальные услуги — одна упущенная заявка часто равна среднему чеку сделки. Если в месяц приходит 100 обращений, а без быстрого ответа до CRM доходит лишь половина, «невидимая» потеря — это не абстрактная статистика, а конкретные рубли.</p>
    <p>Интеграторы предлагают упрощённую <strong>формулу потерь заявок</strong>:</p>
    <p><strong>Потери = Входящие − (Ответ ≤5 мин × дожим × фиксация в CRM)</strong></p>
    <p>Исследование провайдера «Телфин» и OkoCRM, опубликованное на CNews в ноябре 2025 года (7 500+ представителей бизнеса), фиксирует: <strong>примерно половина клиентов уходит без заказа, если ответ приходится ждать более 10 минут</strong>.</p>
    <p>Классический бенчмарк MIT Lead Response Management Study (HBR, 2011): <strong>ответ за 5 минут против 30 минут снижает шанс квалификации в 21 раз</strong>. По данным Drift Lead Response Report (2014), <strong>среднее время ответа B2B-компаний — 42 часа</strong>.</p>
    <h3 id="otvetim-utrom">Почему «ответим утром» больше не работает в 2026</h3>
    <p>Клиент 2026 года привык к мгновенным ответам в мессенджерах и маркетплейсах. Форма на сайте без обратной связи воспринимается как чёрная дыра. Компании теряют клиентов не только из-за долгой реакции, но и из-за неудобного формата коммуникации — отмечает Иван Павлов («Телфин», CNews, 24.11.2025).</p>
    <p><strong>Ответ на заявку ночью</strong> без AI-агента технически возможен только если дежурит живой менеджер — дорого и не масштабируется для МСБ. Именно здесь работает связка <strong>нейросеть для обработки лидов + CRM</strong>: первый контакт за секунды, структурированные данные для менеджера утром.</p>
  </div>
</section>

<section class="nero-ai-section" id="chto-takoe-agent">
  <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
    <h2>Что такое AI-агент для обработки заявок с сайта</h2>
    <p><strong>AI-агент для обработки заявок с сайта</strong> — программный слой между точкой входа (форма, виджет чата, мессенджер) и CRM. Он не просто отвечает по скрипту: принимает обращение, извлекает поля из свободного текста, задаёт уточняющие вопросы, классифицирует лид и создаёт или обновляет карточку в amoCRM или Битрикс24 с резюме диалога для менеджера.</p>
    <p>OpenAI в 2025–2026 годах выделяет тренд <strong>agentic AI для бизнеса</strong>: модели выполняют действия через инструменты (function calling, запись в CRM, handoff человеку), а не ограничиваются генерацией текста.</p>
    <h3 id="chatbot-k-agentu">От чат-бота к агенту: квалификация и действия, а не только ответы</h3>
    <table>
      <thead><tr><th>Уровень</th><th>Что делает</th><th>Ограничение</th></tr></thead>
      <tbody>
        <tr><td>Чат-бот по скрипту</td><td>Ответы по дереву решений</td><td>Не понимает свободный текст, не пишет в CRM</td></tr>
        <tr><td>AI-ассистент</td><td>Генерирует ответ + черновик для менеджера</td><td>Человек подтверждает каждый шаг</td></tr>
        <tr><td><strong>AI-агент</strong></td><td>Ответ + извлечение полей + запись в CRM + эскалация</td><td>Требует guardrails и human_review на рисковых темах</td></tr>
      </tbody>
    </table>
    <p>Интегратор METASAPIENS описывает типовой сценарий: webhook → анализ обращения → создание сделки с заполненными полями → первое сообщение клиенту → задача менеджеру. По их оценке, ручная квалификация одной заявки занимает 15–20 минут; без агента первый ответ может растянуться на 2–4 часа.</p>
    <h3 id="konsultant-vs-crm">AI-консультант на сайте vs менеджер в CRM</h3>
    <p><strong>Ai консультант на сайт</strong> работает на этапе «до CRM»: ловит intent, пока посетитель на странице. Менеджер в CRM работает с уже созданной карточкой — но если карточка появилась через 18 часов без контекста диалога, половина работы уже потеряна.</p>
    <p>Александр Завьялов (OkoCRM, цитата в исследовании «Телфин», CNews): «Если CRM позволяет видеть конверсию, важно видеть и формат взаимодействия, который привёл к продаже».</p>
  </div>
</section>

<section class="nero-ai-section nero-ai-section-tight"><div class="nero-ai-container nero-ai-reveal"><section id="vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block" class="boris-lead-pipeline-section" aria-labelledby="boris-lead-pipeline-title">
<style>
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block {
    margin: 48px 0;
    padding: 0;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline-card {
    background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
    border: 1px solid #e2e8f0;
    border-radius: 22px;
    box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
    padding: clamp(24px, 4vw, 40px);
    overflow: hidden;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 28px;
    align-items: center;
  }
  @media (min-width: 1024px) {
    #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline-grid {
      grid-template-columns: 1.1fr 0.9fr;
      gap: 36px;
    }
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-eyebrow {
    margin: 0 0 10px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #2563eb;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-kicker {
    margin: 0 0 14px;
    font-size: clamp(22px, 2.4vw, 28px);
    line-height: 1.2;
    letter-spacing: -0.03em;
    color: #0f172a;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-bridge {
    margin: 0 0 20px;
    font-size: 16px;
    line-height: 1.6;
    color: #475569;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-stats {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 0 0 18px;
    padding: 0;
    list-style: none;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-stats li {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 999px;
    background: #fff;
    border: 1px solid #e2e8f0;
    font-size: 13px;
    font-weight: 600;
    color: #0f172a;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-stats .boris-stat-accent {
    color: #059669;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-stats .boris-stat-warn {
    color: #d97706;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-teaser {
    margin: 0;
    font-size: 14px;
    line-height: 1.55;
    color: #64748b;
    border-left: 3px solid #93c5fd;
    padding-left: 14px;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-canvas-wrap {
    position: relative;
    min-height: 380px;
    max-height: 520px;
    height: clamp(380px, 42vw, 480px);
    border-radius: 18px;
    background:
      radial-gradient(circle at 20% 15%, rgba(59, 130, 246, 0.08), transparent 42%),
      radial-gradient(circle at 85% 80%, rgba(16, 185, 129, 0.07), transparent 38%),
      #f8fafc;
    border: 1px solid #e2e8f0;
    overflow: hidden;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block canvas {
    display: block;
    width: 100%;
    height: 100%;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-live-pill {
    position: absolute;
    top: 14px;
    right: 14px;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.92);
    border: 1px solid #e2e8f0;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #0f172a;
    pointer-events: none;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-live-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #22c55e;
    animation: boris-lead-pulse 1.6s ease-in-out infinite;
  }
  @keyframes boris-lead-pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.45; transform: scale(0.85); }
  }
  @media (max-width: 767px) {
    #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-canvas-wrap {
      min-height: 340px;
      height: 360px;
    }
  }
</style>

  <div class="boris-lead-pipeline-card">
    <div class="boris-lead-pipeline-grid">
      <div class="boris-lead-copy">
        <p class="boris-lead-eyebrow">Маршрут заявки</p>
        <h3 id="boris-lead-pipeline-title" class="boris-lead-kicker">От формы на сайте до карточки в CRM — за секунды</h3>
        <p class="boris-lead-bridge">Пока менеджеры офлайн, заявка не «зависает» в почте: webhook передаёт её AI-агенту, тот квалифицирует лид и создаёт задачу в amoCRM или Битрикс24.</p>
        <ul class="boris-lead-stats" aria-label="Ключевые метрики пайплайна">
          <li><span class="boris-stat-accent">5–15 сек</span> первый ответ</li>
          <li><span class="boris-stat-warn">~40%</span> заявок ночью</li>
          <li>hot / warm / cold</li>
        </ul>
        <p class="boris-lead-teaser">Дальше разберём каждый шаг сценария «ответ за 5–15 секунд» — от webhook до human handoff.</p>
      </div>
      <div class="boris-lead-canvas-wrap" aria-hidden="true">
        <span class="boris-lead-live-pill"><span class="boris-lead-live-dot"></span> live-пайплайн</span>
        <canvas id="vnedrenie-ai-zayavok-pipeline-canvas" width="640" height="480"></canvas>
      </div>
    </div>
  </div>

<script>
(function borisLeadPipelineEngine() {
  var canvas = document.getElementById('vnedrenie-ai-zayavok-pipeline-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var frame = 0;
  var cw = 0, ch = 0;

  var C = {
    outline: '#0f172a',
    line: '#94a3b8',
    lineActive: '#3b82f6',
    nodeBg: '#ffffff',
    nodeBorder: '#cbd5e1',
    aiGlow: '#8b5cf6',
    crmGreen: '#10b981',
    hotRed: '#ef4444',
    warmAmber: '#f59e0b',
    packetBlue: '#2563eb',
    nightBadge: '#6366f1',
    text: '#0f172a',
    textMuted: '#64748b',
    timerBg: '#ecfdf5',
    timerBorder: '#6ee7b7'
  };

  var nodes = [
    { id: 'form', label: 'Форма / чат', sub: 'сайт', x: 0.12, y: 0.52, w: 88, h: 52 },
    { id: 'hook', label: 'Webhook', sub: '<1 сек', x: 0.30, y: 0.38, w: 78, h: 48 },
    { id: 'ai', label: 'AI-агент', sub: '5–15 сек', x: 0.50, y: 0.52, w: 92, h: 56 },
    { id: 'crm', label: 'CRM', sub: 'amo / B24', x: 0.72, y: 0.38, w: 86, h: 52 },
    { id: 'tg', label: 'Telegram', sub: 'hot-лид', x: 0.88, y: 0.58, w: 82, h: 48 }
  ];

  var edges = [
    [0, 1], [1, 2], [2, 3], [3, 4]
  ];

  var packets = [];
  var spawnTimer = 0;
  var aiPulse = 0;
  var crmFill = 0;
  var timerSec = 12;
  var timerFlash = 0;

  function resize() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    cw = wrap.clientWidth;
    ch = wrap.clientHeight;
    canvas.width = cw;
    canvas.height = ch;
  }

  function nodePos(n) {
    return { x: n.x * cw, y: n.y * ch };
  }

  function roundRect(x, y, w, h, r, fill, stroke, lw) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else { ctx.moveTo(x + r, y); ctx.arcTo(x + w, y, x + w, y + h, r); ctx.arcTo(x + w, y + h, x, y + h, r); ctx.arcTo(x, y + h, x, y, r); ctx.arcTo(x, y, x + w, y, r); }
    ctx.closePath();
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.lineWidth = lw || 2; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  function drawEdge(from, to, progress) {
    var a = nodePos(from);
    var b = nodePos(to);
    var x1 = a.x + from.w * 0.5;
    var y1 = a.y;
    var x2 = b.x - to.w * 0.5;
    var y2 = b.y;
    var mx = (x1 + x2) / 2;
    ctx.beginPath();
    ctx.moveTo(x1, y1);
    ctx.bezierCurveTo(mx, y1 - 28, mx, y2 + 28, x2, y2);
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 2;
    ctx.setLineDash([6, 6]);
    ctx.stroke();
    ctx.setLineDash([]);

    if (progress >= 0) {
      var t = Math.max(0, Math.min(1, progress));
      var px = x1 + (x2 - x1) * t;
      var py = y1 + (y2 - y1) * t + Math.sin(t * Math.PI) * -18;
      ctx.beginPath();
      ctx.arc(px, py, 5, 0, Math.PI * 2);
      ctx.fillStyle = C.lineActive;
      ctx.fill();
    }
  }

  function drawNode(n, highlight) {
    var p = nodePos(n);
    var x = p.x - n.w / 2;
    var y = p.y - n.h / 2;
    var glow = highlight ? 'rgba(139, 92, 246, 0.18)' : null;
    if (glow) {
      roundRect(x - 4, y - 4, n.w + 8, n.h + 8, 14, glow, null);
    }
    roundRect(x, y, n.w, n.h, 10, C.nodeBg, highlight ? C.aiGlow : C.nodeBorder, highlight ? 2.5 : 1.5);
    ctx.fillStyle = C.text;
    ctx.font = 'bold 11px system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(n.label, p.x, p.y - 4);
    ctx.fillStyle = C.textMuted;
    ctx.font = '10px system-ui, sans-serif';
    ctx.fillText(n.sub, p.x, p.y + 12);

    if (n.id === 'form' && frame % 180 < 90) {
      roundRect(x + 6, y - 14, 52, 18, 6, C.nightBadge, C.outline, 1);
      ctx.fillStyle = '#fff';
      ctx.font = '9px system-ui, sans-serif';
      ctx.fillText('ночь 23:14', p.x, y - 2);
    }

    if (n.id === 'crm') {
      var cardW = 56, cardH = 22;
      var cx = p.x - cardW / 2;
      var cy = p.y + n.h / 2 + 8;
      roundRect(cx, cy, cardW, cardH, 5, '#ecfdf5', C.crmGreen, 1);
      ctx.fillStyle = C.crmGreen;
      ctx.font = '9px system-ui, sans-serif';
      ctx.fillText('лид #' + (100 + Math.floor(crmFill % 50)), p.x, cy + 14);
      ctx.fillRect(cx + 4, cy + cardH - 4, (cardW - 8) * Math.min(1, crmFill / 60), 3);
    }
  }

  function drawTimer() {
    var tx = cw * 0.50 - 42;
    var ty = ch * 0.18;
    roundRect(tx, ty, 84, 32, 8, timerFlash > 0 ? '#dcfce7' : C.timerBg, C.timerBorder, 1.5);
    ctx.fillStyle = '#065f46';
    ctx.font = 'bold 12px system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(timerSec + ' сек', tx + 42, ty + 20);
  }

  function drawLegend() {
    var items = [
      { c: C.hotRed, t: 'hot' },
      { c: C.warmAmber, t: 'warm' },
      { c: C.line, t: 'cold' }
    ];
    var lx = 16, ly = ch - 28;
    items.forEach(function(item, i) {
      ctx.fillStyle = item.c;
      ctx.beginPath();
      ctx.arc(lx + i * 58, ly, 5, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = C.textMuted;
      ctx.font = '10px system-ui, sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(item.t, lx + i * 58 + 10, ly + 4);
    });
  }

  function spawnPacket() {
    var types = ['hot', 'warm', 'cold'];
    var type = types[Math.floor(Math.random() * types.length)];
    packets.push({
      edgeIdx: 0,
      t: 0,
      speed: 0.012 + Math.random() * 0.006,
      type: type,
      color: type === 'hot' ? C.hotRed : type === 'warm' ? C.warmAmber : C.packetBlue
    });
  }

  function updatePackets() {
    for (var i = packets.length - 1; i >= 0; i--) {
      var p = packets[i];
      p.t += p.speed;
      if (p.t >= 1) {
        p.t = 0;
        p.edgeIdx++;
        if (p.edgeIdx === 2) {
          aiPulse = 40;
          timerSec = 5 + Math.floor(Math.random() * 11);
          timerFlash = 25;
        }
        if (p.edgeIdx === 3) crmFill += 8;
        if (p.edgeIdx >= edges.length) {
          packets.splice(i, 1);
          continue;
        }
      }
    }
  }

  function drawPacket(p) {
    var e = edges[p.edgeIdx];
    var from = nodes[e[0]];
    var to = nodes[e[1]];
    var a = nodePos(from);
    var b = nodePos(to);
    var x1 = a.x + from.w * 0.5;
    var y1 = a.y;
    var x2 = b.x - to.w * 0.5;
    var y2 = b.y;
    var t = p.t;
    var px = x1 + (x2 - x1) * t;
    var py = y1 + (y2 - y1) * t + Math.sin(t * Math.PI) * -18;
    ctx.beginPath();
    ctx.arc(px, py, 7, 0, Math.PI * 2);
    ctx.fillStyle = p.color;
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
  }

  function loop() {
    frame++;
    if (aiPulse > 0) aiPulse--;
    if (timerFlash > 0) timerFlash--;
    spawnTimer++;
    if (spawnTimer > 85) {
      spawnTimer = 0;
      spawnPacket();
    }
    updatePackets();

    ctx.clearRect(0, 0, cw, ch);

    edges.forEach(function(e) {
      drawEdge(nodes[e[0]], nodes[e[1]], -1);
    });

    nodes.forEach(function(n) {
      drawNode(n, n.id === 'ai' && aiPulse > 0);
    });

    packets.forEach(drawPacket);

    drawTimer();
    drawLegend();

    requestAnimationFrame(loop);
  }

  window.addEventListener('resize', resize);
  resize();
  loop();
})();
</script>
</section></div></section>

<section class="nero-ai-section nero-ai-section-alt" id="kak-rabotaet">
  <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
    <h2>Как работает сценарий «ответ за 5–15 секунд»</h2>
    <p><strong>Коротко:</strong> заявка → webhook (&lt;1 сек) → AI-обработка (5–15 сек) → structured output → запись в CRM → уведомление менеджеру. Спорные кейсы уходят на human_review без автообещаний по ценам и срокам.</p>
    <p>Ниже — <strong>проектная модель Nero Network</strong> (эталон сценария, не публичный кейс конкретного заказчика).</p>
    <h3 id="priem-zayavki">Приём заявки с формы, чата или мессенджера</h3>
    <ul>
      <li>Форма на лендинге (Tilda webhook, WordPress CF7/WPForms, кастомный POST)</li>
      <li>Виджет чата на сайте</li>
      <li>Telegram, WhatsApp Business API, MAX</li>
    </ul>
    <p>На форме — <strong>отдельный чекбокс согласия на обработку персональных данных</strong> (актуально с 1 сентября 2025 года по требованиям 152-ФЗ).</p>
    <h3 id="skoring">Уточняющие вопросы и скоринг лида</h3>
    <p>AI за <strong>5–15 секунд</strong>:</p>
    <ol>
      <li>Приветствует и подтверждает получение заявки</li>
      <li>Извлекает поля из текста (имя, телефон, услуга, срочность)</li>
      <li>Задаёт <strong>один</strong> контекстный уточняющий вопрос, если данных не хватает</li>
      <li>Формирует structured output (JSON): lead_type, need, urgency, missing_fields, manager_summary, risk_flags</li>
    </ol>
    <p>Метрики качества на пилоте: <strong>P90 time-to-first-response</strong>, доля лидов с ответом ≤5 мин, <strong>human_review rate</strong>.</p>
    <h3 id="peredacha-lida">Передача горячего лида менеджеру или в CRM</h3>
    <ul>
      <li>Запись в CRM: amoCRM POST /api/v4/leads/complex или Битрикс24 crm.lead.add</li>
      <li>Теги: «AI-квалифицирован», «ночная заявка», hot/warm/cold</li>
      <li>Задача менеджеру: «Позвонить до 10:00» для ночных hot-лидов</li>
      <li>Telegram-алерт для срочных обращений</li>
    </ul>
    <p>При недоступности API LLM — fallback: шаблонный автоответ + задача менеджеру.</p>
  </div>
  <div class="nero-ai-container"><aside class="nero-ai-seo-box nero-ai-reveal" aria-label="Призыв к действию">
  <h2>Готовы закрыть ночные заявки за 5–15 секунд?</h2>
  <p>Разберём ваши каналы, оценим долю обращений вне рабочего времени и покажем, как AI-агент передаёт квалифицированный лид в amoCRM или Битрикс24 — без найма ночной смены.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside></div>
</section>

<section class="nero-ai-section" id="vnedrenie">
  <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
    <h2>Внедрение AI-обработки заявок под ключ: этапы и сроки</h2>
    <p><strong>Ai обработка заявок под ключ</strong> для МСБ — это не «купить виджет и забыть», а проект с аудитом, базой знаний, пилотом и обучением команды. <strong>Внедрение ai в бизнес</strong> на этом участке воронки занимает от двух до четырёх недель при запуске на одном канале.</p>
    <h3 id="audit-voronki">Аудит текущей воронки и точек потери</h3>
    <p><strong>1–2 дня.</strong> Карта каналов заявок, поля CRM, SLA менеджеров, доля обращений в интервале 19:00–09:00 и в выходные. Лид-магнит Nero Network — <strong>аудит потерь заявок за 30 минут</strong>.</p>
    <h3 id="nastroyka-scenariev">Настройка сценариев и базы знаний</h3>
    <p><strong>2–3 дня.</strong> FAQ, прайс-диапазоны (не точные обещания), список услуг, скрипт квалификации (5–7 вопросов), <strong>запреты</strong>: финальные цены, сроки, медицинские и юридические обещания без human_review. RAG на базе Notion/Google Docs или векторного хранилища.</p>
    <h3 id="testirovanie">Тестирование, запуск и обучение команды</h3>
    <p><strong>MVP на одном канале — 5–7 дней.</strong> Режим «ассистент» (черновик + approve менеджера) → затем автоответ на безопасные уточнения.</p>
    <p><strong>CRM-интеграция — 2–3 дня.</strong> Дедупликация контактов, OAuth amoCRM / REST Битрикс24.</p>
    <p><strong>Пилот — 2–3 недели.</strong> Еженедельная выборка диалогов vs оценка менеджера; корректировка промптов и правил.</p>
    <p><strong>Масштабирование:</strong> Telegram/WhatsApp, дожимы, уведомления.</p>
  </div>
  <div class="nero-ai-container"><aside class="nero-ai-card nero-ai-reveal" style="padding: 22px 24px; margin: 28px 0;" aria-label="Обучение по AI-автоматизации">
  <p style="margin: 0; line-height: 1.65;">На этапе запуска важно, чтобы менеджеры понимали, как работает агент и когда подключаться к диалогу. Если команда ещё не готова к внедрению «под ключ», начните с базы: <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>" style="display: inline-flex; margin-top: 10px;"><?php echo esc_html($secondary_cta_label); ?></a></p>
</aside></div>
  <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
    <p>Конкуренты (NaimiAI, PapAI Soft) предлагают похожие сроки пилота 2–3 недели; PapAI Soft указывает «под ключ от 120 000 ₽» — ориентир нижней границы рынка.</p>
    <p><strong>Как внедрить ai обработка заявок</strong> без собственной разработки: подрядчик собирает webhook-пайплайн на n8n/Make + LLM + CRM API.</p>
  </div>
</section>

<section class="nero-ai-section nero-ai-section-alt" id="crm">
  <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
    <h2>Интеграция с CRM: amoCRM, Битрикс24, Telegram</h2>
    <p><strong>Ai обработка заявок с crm</strong> — ключевое отличие агента от «просто чата на сайте». Без записи в CRM ночной ответ не попадает в воронку и теряется в истории виджета.</p>
    <h3 id="polya-lida">Поля лида, статусы и триггеры в CRM</h3>
    <p><strong>amoCRM:</strong> API v4, создание сделок через /leads/complex, робот с created_by: 0.</p>
    <p><strong>Битрикс24:</strong> REST crm.lead.add, встроенный <strong>BitrixGPT</strong> анализирует чаты и звонки <strong>после</strong> завершения диалога — но <strong>не заменяет</strong> мгновенный первый контакт с сайта ночью.</p>
    <table>
      <thead><tr><th>Критерий</th><th>Внешний AI-агент на сайте</th><th>BitrixGPT / встроенный AI в CRM</th></tr></thead>
      <tbody>
        <tr><td>Первый контакт ночью с сайта</td><td>Да, 5–15 сек</td><td>Нет — нужен уже начатый диалог</td></tr>
        <tr><td>Запись в CRM с контекстом</td><td>Да, через API</td><td>Да, после чата/звонка</td></tr>
        <tr><td>Квалификация по правилам компании</td><td>Настраивается</td><td>Ограничена сценариями CRM</td></tr>
        <tr><td>Локализация данных (РФ)</td><td>Зависит от провайдера LLM</td><td>Серверы в РФ (BitrixGPT)</td></tr>
      </tbody>
    </table>
    <h3 id="vidzhety">Виджеты для Tilda, WordPress и лендингов</h3>
    <ul>
      <li><strong>WordPress:</strong> CF7, WPForms, кастомный POST + Elementor</li>
      <li><strong>Tilda:</strong> webhook на отправку формы</li>
      <li>События аналитики: «ai_qualified_lead» в Метрике/GA4</li>
    </ul>
    <h3 id="eskalatsiya">Эскалация на живого менеджера</h3>
    <ul>
      <li>price_request, legal_question, medical_advice → без автообещаний</li>
      <li>Низкая уверенность модели → human_review</li>
      <li>Явный запрос «хочу человека» → мгновенное подтверждение + передача с полным контекстом диалога</li>
    </ul>
  </div>
</section>

<section class="nero-ai-section" id="cena">
  <div class="nero-ai-container">
    <div class="nero-ai-grid-2 nero-ai-reveal">
      <div class="nero-ai-prose">
        <h2>Сколько стоит AI-обработка заявок для малого и среднего бизнеса</h2>
        <p><strong>Ai обработка заявок цена</strong> складывается из старта (аудит, интеграция, база знаний) и поддержки (API LLM, мониторинг, доработка сценариев). Точный ROI без пилота на ваших данных обещать нельзя — используйте калькулятор аудита потерь.</p>
        <h3 id="startovyy-paket">Стартовый пакет и поддержка (ориентир 120–350 тыс. ₽)</h3>
        <ul>
          <li><strong>Старт под ключ:</strong> 120–350 тыс. ₽ (аудит, один канал, CRM, база знаний, пилот)</li>
          <li><strong>Поддержка:</strong> API нейросети, хостинг оркестратора, ежемесячная выборка QA</li>
        </ul>
        <h3 id="roi">ROI: сколько заявок возвращает автоматизация</h3>
        <ol>
          <li>Зафиксировать входящие за 30 дней</li>
          <li>Разделить рабочее / нерабочее время</li>
          <li>Измерить текущий P90 time-to-first-response</li>
          <li>После пилота — те же метрики</li>
        </ol>
      </div>
      <div class="nero-ai-kpi-grid">
        <div class="nero-ai-card nero-ai-kpi-card nero-ai-reveal nero-ai-delay-1">
          <span class="nero-ai-kpi-value" data-nero-count="120" data-nero-suffix=" тыс. ₽">0 тыс. ₽</span>
          <span class="nero-ai-kpi-label">нижняя граница старта</span>
        </div>
        <div class="nero-ai-card nero-ai-kpi-card nero-ai-reveal nero-ai-delay-2">
          <span class="nero-ai-kpi-value" data-nero-count="350" data-nero-suffix=" тыс. ₽">0 тыс. ₽</span>
          <span class="nero-ai-kpi-label">верхняя граница под ключ</span>
        </div>
        <div class="nero-ai-card nero-ai-kpi-card nero-ai-reveal nero-ai-delay-3">
          <span class="nero-ai-kpi-value" data-nero-count="15" data-nero-suffix=" сек">0 сек</span>
          <span class="nero-ai-kpi-label">целевой P90 ответа</span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-section-alt" id="keisy">
  <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
    <h2>Кейсы и примеры внедрения AI-агента на сайте</h2>
    <p><strong>Важно:</strong> ниже — <strong>проверенные публичные источники</strong> с оговорками. Выдуманные «кейсы клиентов Nero Network» не приводятся.</p>
    <div class="nero-ai-grid-3" style="margin: 24px 0;">
      <div class="nero-ai-card nero-ai-niche-card nero-ai-reveal"><h3>Услуги и локальный бизнес</h3><p>Исследование «Телфин» + OkoCRM (CNews, ноябрь 2025): 7 500+ респондентов; ~50% клиентов уходят при ожидании ответа &gt;10 мин.</p></div>
      <div class="nero-ai-card nero-ai-niche-card nero-ai-reveal nero-ai-delay-1"><h3>Онлайн-школы</h3><p>Заявка на курс ночью → AI уточняет формат, бюджет, срок старта → карточка в CRM с тегом «тёплый» → менеджер звонит в первый рабочий час с контекстом.</p></div>
      <div class="nero-ai-card nero-ai-niche-card nero-ai-reveal nero-ai-delay-2"><h3>Клиники</h3><p>Отдельное согласие 152-ФЗ, запрет медицинских рекомендаций AI, запись на приём только через human_review или интеграцию с расписанием.</p></div>
    </div>
    <p><strong>Ai обработка заявок кейсы</strong> с независимой верификацией метрик в РФ пока редки — это пробел рынка и аргумент за пилот с прозрачными метриками P90.</p>
  </div>
</section>

<section class="nero-ai-section" id="riski">
  <div class="nero-ai-container">
    <div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Риски и как их снимают: галлюцинации, 152-ФЗ, качество квалификации</h2></div>
    <div class="nero-ai-grid-2">
      <div class="nero-ai-card nero-ai-reveal" style="padding:22px;">
        <h3>Контроль ответов и handoff человеку</h3>
        <ul>
          <li>RAG только на утверждённых документах (FAQ, регламенты)</li>
          <li>Structured output + валидация полей</li>
          <li>Список risk_flags и принудительный human_review</li>
          <li>Журнал диалогов и audit log</li>
        </ul>
      </div>
      <div class="nero-ai-card nero-ai-reveal nero-ai-delay-1" style="padding:22px;">
        <h3>Персональные данные и согласия</h3>
        <p>С <strong>1 сентября 2025 года</strong> — <strong>отдельное</strong> согласие на обработку ПДн; нельзя прятать только в оферте (152-ФЗ). Логирование диалогов — в соответствии с политикой ПДн; выбор LLM с контуром РФ (YandexGPT, GigaChat, BitrixGPT) при жёстких требованиях локализации.</p>
      </div>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-section-alt" id="faq">
  <div class="nero-ai-container">
    <div class="nero-ai-section-head nero-ai-reveal"><h2>FAQ: частые вопросы про AI-обработку заявок</h2></div>
    <div class="nero-ai-faq"><details class="nero-ai-reveal"><summary>Можно ли без программиста?</summary><p>Да, при <strong>внедрении ai обработка заявок под ключ</strong> подрядчиком. Клиент предоставляет доступы CRM, FAQ, обезличенные заявки, регламент квалификации.</p></details>
<details class="nero-ai-reveal"><summary>Сколько времени до первых лидов?</summary><p>MVP на одном канале — <strong>5–7 дней</strong>; первые реальные лиды в CRM — с запуска пилота (2–3 недели с донастройкой).</p></details>
<details class="nero-ai-reveal"><summary>Чем отличается от обычного чат-бота?</summary><p>Чат-бот по скрипту не пишет в CRM и не квалифицирует по вашим правилам. <strong>Ai агент для сайта</strong> создаёт карточку, теги, задачу менеджеру и работает 24/7 с SLA 5–15 сек.</p></details>
<details class="nero-ai-reveal"><summary>Не отпугнёт ли клиентов бот?</summary><p>Мгновенное подтверждение «заявка получена, уточню один вопрос» снижает тревожность. Handoff на человека по запросу — обязателен.</p></details>
<details class="nero-ai-reveal"><summary>Заменит ли AI менеджера?</summary><p>Нет. AI = ночная смена + квалификация + CRM. Человек = цены, скидки, договор, сложные B2B-сделки, претензии.</p></details>
<details class="nero-ai-reveal"><summary>Сколько стоит поддержка API нейросети?</summary><p>Зависит от объёма диалогов и модели. На пилоте считают cost per qualified lead; входит в ежемесячную поддержку после старта.</p></details>
<details class="nero-ai-reveal"><summary>Подходит ли для ai лидогенерация?</summary><p>Да, если цель — не «генерировать холодные контакты», а <strong>не терять входящие</strong> с сайта и рекламы.</p></details></div>
  </div>
</section>

<section class="nero-ai-section" id="audit-section">
  <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
    <h2>Проверьте, сколько заявок вы теряете (CTA + квиз)</h2>
    <p><strong>Коротко:</strong> если заявки приходят ночью, а менеджеры отвечают утром — вы уже теряете долю лидов. Бесплатный ориентир: аудит потерь за 30 минут.</p>
    <p><strong>Утечка ≈ Входящие в месяц × (% в нерабочее время) × (% без ответа ≤5–10 мин)</strong></p>
    <h3>Лид-магнит: аудит потерь заявок за 30 минут</h3>
    <p>Nero Network предлагает <strong>аудит потерь заявок за 30 минут</strong>: разбор каналов, оценка ночной доли, карта интеграции с amoCRM или Битрикс24.</p>
  </div>
  <div class="nero-ai-container"><section class="nero-ai-final-cta nero-ai-reveal" id="audit-cta" aria-label="Аудит потерь заявок">
  <h2>Проверьте, сколько заявок вы теряете</h2>
  <p>Если заявки приходят ночью, а менеджеры отвечают утром — вы уже теряете долю лидов. Бесплатный ориентир: <strong>аудит потерь заявок за 30 минут</strong> — разбор каналов, оценка ночной доли, карта интеграции с CRM.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
    <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>"><?php echo esc_html($secondary_cta_label); ?></a>
  </div>
</section></div>
  <div class="nero-ai-container nero-ai-prose nero-ai-reveal" style="margin-top:32px;">
    <p><strong>Итог:</strong> <strong>Ai обработка заявок</strong> в 2026 году — это агентный сценарий: секунды до первого ответа, квалификация по вашим правилам, запись в CRM, human handoff на рисках. Пилот на одном канале за 2–3 недели, ориентир 120–350 тыс. ₽ под ключ — рабочая модель для <strong>ai обработка заявок для бизнеса</strong>.</p>
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
  "@graph": [
    {
      "@type": "Article",
      "headline": "AI-агент для обработки заявок с сайта — внедрение под ключ",
      "description": "AI отвечает на заявки за 5–15 секунд, квалифицирует лида и передаёт в CRM. Внедрение AI-агента под ключ для МСБ.",
      "author": {
        "@type": "Organization",
        "name": "Nero Network"
      },
      "about": [
        "AI обработка заявок",
        "AI агент для сайта",
        "внедрение AI в бизнес"
      ]
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Можно ли без программиста?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, при внедрении ai обработка заявок под ключ подрядчиком. Клиент предоставляет доступы CRM, FAQ, обезличенные заявки, регламент квалификации."
          }
        },
        {
          "@type": "Question",
          "name": "Сколько времени до первых лидов?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "MVP на одном канале — 5–7 дней; первые реальные лиды в CRM — с запуска пилота (2–3 недели с донастройкой)."
          }
        },
        {
          "@type": "Question",
          "name": "Чем отличается от обычного чат-бота?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Чат-бот по скрипту не пишет в CRM и не квалифицирует по вашим правилам. Ai агент для сайта создаёт карточку, теги, задачу менеджеру и работает 24/7 с SLA 5–15 сек."
          }
        },
        {
          "@type": "Question",
          "name": "Не отпугнёт ли клиентов бот?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Мгновенное подтверждение «заявка получена, уточню один вопрос» снижает тревожность. Handoff на человека по запросу — обязателен."
          }
        },
        {
          "@type": "Question",
          "name": "Заменит ли AI менеджера?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Нет. AI = ночная смена + квалификация + CRM. Человек = цены, скидки, договор, сложные B2B-сделки, претензии."
          }
        },
        {
          "@type": "Question",
          "name": "Сколько стоит поддержка API нейросети?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Зависит от объёма диалогов и модели. На пилоте считают cost per qualified lead; входит в ежемесячную поддержку после старта."
          }
        },
        {
          "@type": "Question",
          "name": "Подходит ли для ai лидогенерация?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, если цель — не «генерировать холодные контакты», а не терять входящие с сайта и рекламы."
          }
        }
      ]
    },
    {
      "@type": "SoftwareApplication",
      "name": "AI-агент для обработки заявок с сайта",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Web",
      "offers": {
        "@type": "Offer",
        "priceCurrency": "RUB",
        "price": "120000",
        "description": "Старт под ключ от 120 000 ₽"
      }
    }
  ]
}
</script>
<!-- /wp:html -->

<?php
get_footer();

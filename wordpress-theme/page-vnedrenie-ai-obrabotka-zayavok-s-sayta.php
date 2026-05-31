<?php
/**
 * Template Name: Внедрение AI — обработка заявок с сайта
 * Description: Лонгрид Nero Network — AI-агент для первичной обработки заявок (slug: vnedrenie-ai-obrabotka-zayavok-s-sayta)
 */

$page_seo_title = 'Внедрение AI-агента: обработка заявок с сайта под ключ';
$page_seo_description = 'Внедряем AI-агента для первичной обработки заявок с сайта: ответ за 5–15 сек, квалификация лида и передача в CRM. Аудит потерь заявок за 30 минут.';

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

$brand = get_bloginfo('name') ?: 'AI-автоматизация';
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Аудит потерь за 30 минут';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#audit-30-min';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Что можно автоматизировать';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#vnedrenie-pod-kluch';

get_header();

?>

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
 * Meta Journal homepage design reference (dark nero-ai layout).
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

/* Longread prose (внутри .nero-ai-home-page) */
.nero-ai-prose h2 {
  font-size: clamp(28px, 3.6vw, 44px);
  line-height: 1.08;
  margin: 0 0 20px;
  letter-spacing: -0.04em;
}
.nero-ai-prose h3 {
  font-size: clamp(18px, 2.2vw, 24px);
  margin: 32px 0 12px;
}
.nero-ai-prose p,
.nero-ai-prose li {
  font-size: 16px;
  line-height: 1.72;
  color: var(--nero-ai-muted);
}
.nero-ai-prose p { margin: 0 0 16px; }
.nero-ai-prose strong { color: var(--nero-ai-soft); }
.nero-ai-prose a {
  color: var(--nero-ai-primary);
  text-decoration: underline;
  text-underline-offset: 3px;
}
.nero-ai-prose a:hover { color: #a7f3d0; }
.nero-ai-lead {
  font-size: 17px;
  line-height: 1.65;
  color: var(--nero-ai-soft) !important;
}
.nero-ai-table-wrap {
  overflow-x: auto;
  margin: 20px 0 24px;
  border-radius: var(--nero-ai-radius-md);
  border: 1px solid var(--nero-ai-border);
  background: rgba(255, 255, 255, 0.04);
}
.nero-ai-prose table.nero-ai-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}
.nero-ai-prose table.nero-ai-table th,
.nero-ai-prose table.nero-ai-table td {
  padding: 12px 14px;
  text-align: left;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  color: var(--nero-ai-text);
}
.nero-ai-prose table.nero-ai-table th {
  background: rgba(121, 242, 255, 0.08);
  color: var(--nero-ai-heading);
  font-weight: 800;
}
.nero-ai-callout {
  padding: 16px 18px;
  border-left: 3px solid var(--nero-ai-primary);
  border-radius: 0 14px 14px 0;
  background: rgba(121, 242, 255, 0.08);
  margin: 20px 0;
}
.nero-ai-callout p { margin: 0; color: var(--nero-ai-soft) !important; }
.nero-ai-ol-steps {
  counter-reset: neroStep;
  list-style: none;
  padding: 0;
  margin: 20px 0;
  display: grid;
  gap: 12px;
}
.nero-ai-ol-steps li {
  counter-increment: neroStep;
  position: relative;
  padding: 14px 16px 14px 52px;
  border: 1px solid var(--nero-ai-border);
  border-radius: var(--nero-ai-radius-md);
  background: rgba(255, 255, 255, 0.045);
  color: var(--nero-ai-text);
}
.nero-ai-ol-steps li::before {
  content: counter(neroStep);
  position: absolute;
  left: 14px;
  top: 14px;
  width: 28px;
  height: 28px;
  border-radius: 10px;
  background: linear-gradient(135deg, rgba(121, 242, 255, 0.35), rgba(139, 92, 246, 0.25));
  color: #031018;
  font-weight: 900;
  font-size: 13px;
  display: grid;
  place-items: center;
}
.nero-ai-intro-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.1fr) minmax(260px, 0.75fr);
  gap: 28px 36px;
  align-items: start;
}
.nero-ai-intro-text {
  border-left: 3px solid var(--nero-ai-primary);
  padding-left: 22px;
}
.nero-ai-intro-deco {
  padding: 18px 16px;
  border-radius: var(--nero-ai-radius-md);
  background: rgba(2, 6, 23, 0.65);
  border: 1px solid var(--nero-ai-border);
  font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
  font-size: 12px;
  line-height: 1.55;
  color: var(--nero-ai-soft);
}
.nero-ai-intro-deco .line { opacity: 0.9; margin-bottom: 6px; }
.nero-ai-intro-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 14px;
}
.nero-ai-intro-chips span {
  padding: 6px 10px;
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.12);
  border: 1px solid rgba(121, 242, 255, 0.22);
  color: var(--nero-ai-primary);
  font-size: 11px;
  font-weight: 700;
}
.nero-ai-toc-nav { padding: 8px 0 32px; text-align: center; }
.nero-ai-toc {
  display: inline-flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 8px;
  max-width: 980px;
  padding: 0;
  margin: 0;
  list-style: none;
}
.nero-ai-toc a {
  display: inline-block;
  padding: 8px 14px;
  border-radius: 999px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: rgba(255, 255, 255, 0.05);
  color: var(--nero-ai-soft) !important;
  font-size: 13px;
  font-weight: 700;
  text-decoration: none !important;
  transition: border-color .2s, background .2s, color .2s;
}
.nero-ai-toc a:hover {
  border-color: rgba(121, 242, 255, 0.4);
  background: rgba(121, 242, 255, 0.1);
  color: var(--nero-ai-primary) !important;
}
.nero-ai-bento-card { padding: 18px; min-height: 100%; }
.nero-ai-bento-card h4 { margin: 0 0 8px; font-size: 15px; }
.nero-ai-bento-card p { margin: 0; font-size: 14px; }
@media (max-width: 900px) {
  .nero-ai-intro-grid { grid-template-columns: 1fr; }
}

/* Boris canvas block — тёмная тема */
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block { padding: 0; }
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .nero-ai-boris-card {
  padding: clamp(24px, 4vw, 36px);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .nero-ai-boris-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr);
  gap: 28px 32px;
  align-items: stretch;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-eyebrow {
  display: inline-block;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--nero-ai-primary);
  margin-bottom: 10px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-kicker {
  font-size: clamp(1.25rem, 2.2vw, 1.55rem);
  line-height: 1.25;
  font-weight: 700;
  color: var(--nero-ai-heading);
  margin: 0 0 12px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead {
  font-size: 15px;
  line-height: 1.65;
  color: var(--nero-ai-muted);
  margin: 0 0 18px;
  max-width: 42em;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-points {
  list-style: none;
  padding: 0;
  margin: 0 0 20px;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-points li {
  position: relative;
  padding-left: 18px;
  font-size: 14px;
  line-height: 1.5;
  color: var(--nero-ai-soft);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-points li::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0.55em;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--nero-ai-primary);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 14px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 12px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid var(--nero-ai-border);
  color: var(--nero-ai-soft);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-pill strong {
  color: var(--nero-ai-primary);
  font-variant-numeric: tabular-nums;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-bridge {
  font-size: 13px;
  color: var(--nero-ai-muted);
  margin: 0;
  padding-top: 4px;
  border-top: 1px dashed rgba(255, 255, 255, 0.12);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-canvas-wrap {
  position: relative;
  min-height: 420px;
  border-radius: var(--nero-ai-radius-md);
  overflow: hidden;
  background: linear-gradient(165deg, rgba(15, 23, 42, 0.95) 0%, rgba(6, 10, 24, 0.98) 100%);
  border: 1px solid var(--nero-ai-border);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block canvas {
  display: block;
  width: 100%;
  height: 100%;
  min-height: 420px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-canvas-caption {
  position: absolute;
  left: 14px;
  right: 14px;
  bottom: 10px;
  font-size: 11px;
  color: var(--nero-ai-muted);
  text-align: center;
  pointer-events: none;
}
@media (max-width: 1023px) {
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .nero-ai-boris-grid { grid-template-columns: 1fr; }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-canvas-wrap,
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block canvas { min-height: 360px; }
}

</style>

<main id="primary" class="site-main nero-ai-home-page" role="main" tabindex="-1">

  <section class="nero-ai-hero" id="lead-dispatch-hero" aria-labelledby="hero-zayavki-title">
    <div class="nero-ai-container nero-ai-hero-grid">
      <div class="nero-ai-hero-copy nero-ai-reveal">
        <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai обработка заявок</p>
        <h1 id="hero-zayavki-title">Внедрение AI-агента <span class="nero-ai-gradient-text">для обработки заявок с сайта</span></h1>
        <p class="nero-ai-hero-lead">Отвечаем на заявки за 5–15 секунд, квалифицируем клиента и передаём горячий лид в CRM — без потерь ночью и в выходные.</p>
        <ul class="nero-ai-badges" aria-label="Ключевые параметры">
          <li class="nero-ai-badge">Ответ 5–15 сек</li>
          <li class="nero-ai-badge">24/7 без выходных</li>
          <li class="nero-ai-badge">amoCRM · Битрикс24</li>
          <li class="nero-ai-badge">Квалификация лида</li>
        </ul>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url(getenv('PRIMARY_CTA_URL') ?: '#audit-30-min'); ?>"><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Аудит потерь за 30 минут'); ?></a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#vnedrenie-pod-kluch'); ?>"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'Внедрение под ключ'); ?></a>
        </div>
      </div>

      <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: обработка заявок и CRM">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">пульт заявок · демо SLA</span>
          </div>
          <div class="nero-ai-window-body">
            <div class="nero-ai-dashboard-title">
              <h3>AI-приём заявок с сайта</h3>
              <span class="nero-ai-live-pill">live</span>
            </div>
            <div class="nero-ai-metrics-grid">
              <div class="nero-ai-metric" data-nero-tooltip="Первичный ответ AI на заявку с формы или чата — целевой SLA 5–15 секунд.">
                <span>First response</span><strong>5–15 с</strong><small>SLA пилота</small>
              </div>
              <div class="nero-ai-metric" data-nero-tooltip="Агент работает ночью и в выходные — менеджер подключается на эскалации.">
                <span>Доступность</span><strong>24/7</strong><small>без выходных</small>
              </div>
              <div class="nero-ai-metric" data-nero-tooltip="Карточка лида, теги и поля создаются в amoCRM или Битрикс24 автоматически.">
                <span>Лиды в CRM</span><strong data-nero-count="12" data-nero-suffix="">0</strong><small>за сегодня (демо)</small>
              </div>
              <div class="nero-ai-metric" data-nero-tooltip="Горячий / тёплый / холодный — маршрутизация без ручного копирования.">
                <span>Scoring</span><strong>hot</strong><small>квалификация</small>
              </div>
            </div>
            <div class="nero-ai-task-stream" aria-label="Этапы внедрения">
              <div class="nero-ai-task"><span class="nero-ai-task-icon">1</span><div><strong>Аудит каналов заявок</strong><span>форма, чат, мессенджеры</span></div><span class="nero-ai-status">этап</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">2</span><div><strong>AI-агент + база знаний</strong><span>RAG по FAQ и прайсу</span></div><span class="nero-ai-status">этап</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">3</span><div><strong>Интеграция с CRM</strong><span>amoCRM / Битрикс24</span></div><span class="nero-ai-status">этап</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">4</span><div><strong>Пилот SLA 5–15 сек</strong><span>метрики и эскалация</span></div><span class="nero-ai-status">запуск</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<section class="nero-ai-section nero-ai-section-tight nero-ai-prose" aria-label="Введение">
  <div class="nero-ai-container">
    <div class="nero-ai-intro-grid nero-ai-reveal">
      <div class="nero-ai-intro-text">
        <p><strong>Коротко:</strong> AI-агент для первичной обработки заявок — связка «канал входа → LLM-агент → CRM», которая за секунды подтверждает обращение, задаёт уточняющие вопросы, оценивает «горячесть» лида и передаёт карточку в amoCRM или Битрикс24. Менеджер подключается на эскалации и закрытии сделки.</p>
        <p>Малый и средний бизнес — услуги, онлайн-школы, клиники — получает заявки круглосуточно, а отдел продаж часто отвечает только в рабочие часы. Запросы «<strong>ai обработка заявок</strong>» и «<strong>внедрение ai в бизнес</strong>» в 2026 году смещаются от FAQ-ботов к <strong>агентным</strong> сценариям: система создаёт сделку, заполняет поля и маршрутизирует лид.</p>
      </div>
      <div class="nero-ai-intro-deco" aria-hidden="true">
        <div class="line">&gt; webhook: form_submit</div>
        <div class="line">&gt; SLA target: <span style="color:#79f2ff">5–15s</span></div>
        <div class="line">&gt; route: amoCRM | B24</div>
        <div class="line">&gt; score: hot | warm | cold</div>
        <div class="nero-ai-intro-chips">
          <span>24/7</span><span>RAG</span><span>Make</span><span>152-ФЗ</span>
        </div>
      </div>
    </div>
  </div>
</section>

<nav class="nero-ai-toc-nav" aria-label="Оглавление">
  <div class="nero-ai-container">
    <ul class="nero-ai-toc">
      <li><a href="#pochemu-teryaet-zayavki">Потеря заявок</a></li>
      <li><a href="#chto-takoe-ai-agent">Что такое AI-агент</a></li>
      <li><a href="#svyazka-sayt-ai-crm">Сайт → AI → CRM</a></li>
      <li><a href="#vnedrenie-pod-kluch">Внедрение</a></li>
      <li><a href="#sla-metriki">SLA и метрики</a></li>
      <li><a href="#stoimost">Стоимость</a></li>
      <li><a href="#riski-compliance">Риски</a></li>
      <li><a href="#keisy">Кейсы</a></li>
      <li><a href="#faq">FAQ</a></li>
      <li><a href="#audit-30-min">Аудит 30 мин</a></li>
    </ul>
  </div>
</nav>

<section id="pochemu-teryaet-zayavki" class="nero-ai-section nero-ai-section-alt nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Почему бизнес теряет заявки с сайта (ночь, выходные, медленный первый ответ)</h2>
    <p class="nero-ai-lead"><strong>Определение:</strong> «Потерянная заявка» — обращение без быстрого осмысленного ответа; клиент уходит к конкуренту или откладывает решение.</p>
    <p>Заявки приходят вечером и в выходные — менеджеры офлайн, лид «остывает». Коммерческий ответ услуги — <strong>ответ за 5–15 секунд</strong>, квалификация и передача горячего лида в CRM.</p>

    <h3 id="skolko-ostyvaet">Сколько лидов «остывает» без ответа за 5–15 минут</h3>
    <p>Исследование MIT / InsideSales (цит. <a href="https://textback.ru/kak_ne_teryat_goryachie_lidy/" rel="noopener noreferrer" target="_blank">textback.ru</a>): ответ <strong>за 5 минут</strong> vs <strong>за 30 минут</strong> — разница в квалификации <strong>в 21 раз</strong>.</p>
    <p>Обзоры 2025–2026: среднее время ответа на лиды у многих компаний — <strong>часы</strong>; малый % отвечает быстрее 5 минут (<a href="https://greetnow.com/blog/speed-to-lead-statistics" rel="noopener noreferrer" target="_blank">greetnow.com</a>, <a href="https://www.agoralia.app/nl/blog/speed-to-lead-2026" rel="noopener noreferrer" target="_blank">agoralia.app</a>).</p>
    <p>Jivo (цит. <a href="https://vc.ru/guryev_pro_ai/2327951-skorost-otveta-na-zaprosy-klientov-v-b2b-i-b2c" rel="noopener noreferrer" target="_blank">vc.ru</a>): ответ ~за <strong>10 секунд</strong> — ~<strong>70%</strong> вероятности продолжения диалога.</p>
    <div class="nero-ai-callout"><p><strong>Итог:</strong> медленный первый ответ — утечка выручки. <strong>Автоматизация через ai обработка заявок</strong> закрывает окно между формой и контактом.</p></div>

    <div class="nero-ai-table-wrap">
      <table class="nero-ai-table">
        <thead><tr><th>Роль</th><th>Скорость</th><th>Доступность</th><th>CRM</th><th>Переговоры</th></tr></thead>
        <tbody>
          <tr><td>Менеджер</td><td>Минуты–часы</td><td>Рабочие часы</td><td>Зависит от дисциплины</td><td>Да</td></tr>
          <tr><td>Кнопочный бот</td><td>Минуты</td><td>24/7</td><td>По сценарию</td><td>Нет</td></tr>
          <tr><td>AI-агент + CRM</td><td><strong>5–15 с</strong> first response</td><td>24/7</td><td>Автозаполнение, scoring</td><td>Эскалация</td></tr>
        </tbody>
      </table>
    </div>

    <h3 id="forma-i-messendzhery">Разница между формой на сайте и мессенджерами</h3>
    <div class="nero-ai-table-wrap">
      <table class="nero-ai-table">
        <thead><tr><th>Канал</th><th>Плюс</th><th>Риск без автоматизации</th></tr></thead>
        <tbody>
          <tr><td>Форма (WP, Tilda)</td><td>Высокий интент</td><td>Нет «живого» ответа — уход</td></tr>
          <tr><td>Виджет чата</td><td>Диалог в реальном времени</td><td>Ночью пусто или шаблон без CRM</td></tr>
          <tr><td>Telegram / MAX</td><td>Follow-up в РФ</td><td>Диалоги без CRM</td></tr>
          <tr><td>WhatsApp*</td><td>Популярен</td><td>152-ФЗ, юридические ограничения в РФ</td></tr>
        </tbody>
      </table>
    </div>
    <p><small>* Meta (WhatsApp) — экстремистская организация в РФ.</small></p>
    <p>Стек интеграторов РФ: форма/виджет, Telegram/MAX → Make/n8n → OpenAI / YandexGPT / GigaChat → RAG → CRM.</p>
  </div>
</section>

<div class="nero-ai-container"><aside class="nero-ai-card nero-ai-final-cta nero-ai-reveal" aria-labelledby="nero-cta-audit-mid">
  <h2 id="nero-cta-audit-mid">Проверить, сколько заявок вы теряете</h2>
  <p>Лид-магнит Nero Network: <strong>аудит потерь заявок за 30 минут</strong> — каналы, время первого ответа, ночные обращения и пустые поля в CRM до внедрения AI.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url(getenv('PRIMARY_CTA_URL') ?: '#audit-30-min'); ?>"><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Аудит за 30 минут'); ?></a>
  </div>
</aside></div>

<section id="chto-takoe-ai-agent" class="nero-ai-section nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Что такое AI-агент для первичной обработки заявок с сайта</h2>
    <p class="nero-ai-lead"><strong>Определение:</strong> связка «канал → LLM → CRM», которая подтверждает заявку, задаёт вопросы (бюджет, срок, потребность), извлекает поля, оценивает «горячесть» и создаёт сделку в amoCRM/Битрикс24.</p>
    <p>Тренд 2026 — <strong>агентные</strong> сценарии, как у <a href="https://openai.com/business/" rel="noopener noreferrer" target="_blank">OpenAI Business</a>.</p>

    <h3 id="otlichie-ot-bota">Отличие от простого чат-бота и от «только GPT в виджете»</h3>
    <div class="nero-ai-table-wrap">
      <table class="nero-ai-table">
        <thead><tr><th>Критерий</th><th>Кнопочный бот</th><th>GPT без CRM</th><th>AI-агент + CRM</th></tr></thead>
        <tbody>
          <tr><td>Диалог</td><td>Кнопки</td><td>Свободный текст</td><td>Текст + квалификация</td></tr>
          <tr><td>CRM</td><td>По сценарию</td><td>Часто нет</td><td>Автозаполнение, scoring</td></tr>
          <tr><td>База</td><td>Ветки</td><td>Промпт</td><td>RAG по FAQ/прайсу</td></tr>
          <tr><td>Скорость</td><td>Минуты</td><td>Секунды без процесса</td><td><strong>5–15 с</strong> + процесс</td></tr>
        </tbody>
      </table>
    </div>
    <p>SalesBot amoCRM, недвижимость (<a href="https://biznesenok.ru/nastrojka-salesbot-v-amocrm-kak-sozdat-chat-bota-dlja-avtomaticheskih-otvetov-i-kvalifikacii-lidov/" rel="noopener noreferrer" target="_blank">biznesenok.ru</a>): конверсия в показ <strong>в 2,3 раза</strong>; первый контакт <strong>22→4 мин</strong> — эталон кнопочного бота.</p>

    <h3 id="kvalifikaciya">Квалификация, сценарии вопросов, передача горячего лида</h3>
    <p>Типовые вопросы: услуга, срок, бюджет, город, контакт и согласие ПДн. Статусы <strong>горячий / тёплый / холодный</strong>; при низкой уверенности — эскалация с транскриптом.</p>
    <p>Обзор ТЕРМОС (<a href="https://www.sostav.ru/blogs/285440/77127" rel="noopener noreferrer" target="_blank">sostav.ru</a>): триггер → LLM → CRM → scoring; RAG и эскалация.</p>
  </div>
</section>

<section
  id="vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block"
  class="nero-ai-section nero-ai-section-alt"
  aria-labelledby="boris-intake-kicker"
>
  <div class="nero-ai-container">
    <div class="nero-ai-card nero-ai-boris-card">
      <div class="nero-ai-boris-grid">
        <div class="boris-copy">
          <span class="boris-eyebrow">Схема в движении</span>
          <h3 class="boris-kicker" id="boris-intake-kicker">Ночная заявка не ждёт утра: сайт → AI → CRM</h3>
          <p class="boris-lead">
            Пока отдел продаж офлайн, AI-агент подтверждает обращение за <strong>5–15 секунд</strong>,
            задаёт вопросы квалификации и заполняет карточку в amoCRM или Битрикс24 — менеджер получает уже «горячий» лид с контекстом.
          </p>
          <ul class="boris-points">
            <li>Каналы: форма сайта, виджет, Telegram / MAX — единый webhook.</li>
            <li>Scoring: горячий / тёплый / холодный — без ручного копирования в CRM.</li>
            <li>Эскалация: низкая уверенность → человек с полным транскриптом.</li>
          </ul>
          <div class="boris-pills" aria-hidden="true">
            <span class="boris-pill">SLA <strong>5–15 с</strong></span>
            <span class="boris-pill">24/7 <strong>первичка</strong></span>
            <span class="boris-pill">CRM <strong>авто</strong></span>
          </div>
          <p class="boris-bridge">Дальше разберём, как собрать связку «сайт → AI → CRM» на Make и amoCRM / Битрикс24.</p>
        </div>
        <div class="boris-canvas-wrap" role="img" aria-label="Анимация: заявки с сайта проходят AI-квалификацию и попадают в колонки CRM">
          <canvas id="lead-intake-pipeline-canvas" width="640" height="420"></canvas>
          <p class="boris-canvas-caption">Демо-поток: не обещание ROI, а логика first response и маршрутизации лида</p>
        </div>
      </div>
    </div>
  </div>

<script id="lead-intake-pipeline-engine">
(function () {
  "use strict";
  var canvas = document.getElementById("lead-intake-pipeline-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var wrap = canvas.parentElement;
  var cw = 640, ch = 420, frame = 0;
  var reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  function resize() {
    if (!wrap) return;
    var w = wrap.clientWidth || 640;
    var h = Math.max(360, Math.min(520, Math.round(w * 0.72)));
    canvas.width = w;
    canvas.height = h;
    cw = w;
    ch = h;
  }
  window.addEventListener("resize", resize);
  resize();

  var PAL = {
    ink: "#e6edf7",
    muted: "#9aa8bd",
    panel: "rgba(17, 24, 39, 0.92)",
    line: "rgba(255, 255, 255, 0.14)",
    ai: "#79f2ff",
    aiGlow: "rgba(121, 242, 255, 0.28)",
    hot: "#fb7185",
    warm: "#fbbf24",
    cold: "#64748b",
    ok: "#22c55e",
    night: "#312e81"
  };

  function rr(ctx, x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function drawClock() {
    var t = new Date();
    var h = t.getHours();
    var m = t.getMinutes();
    var label = (h < 10 ? "0" : "") + h + ":" + (m < 10 ? "0" : "") + m;
    var night = h < 8 || h >= 20;
    ctx.fillStyle = night ? PAL.night : PAL.muted;
    rr(ctx, 14, 12, 72, 26, 8, PAL.panel, PAL.line);
    ctx.fillStyle = night ? "#93c5fd" : PAL.ink;
    ctx.font = "600 12px Inter, system-ui, sans-serif";
    ctx.fillText(night ? "🌙 " + label : "☀ " + label, 24, 29);
  }

  var tickets = [];
  var pulses = [];
  var bubbles = [];

  function spawnTicket() {
    var channels = ["Форма", "Чат", "TG"];
    var ch = channels[Math.floor(Math.random() * channels.length)];
    var colors = { "Форма": "#dbeafe", "Чат": "#dcfce7", "TG": "#e0e7ff" };
    var idx = channels.indexOf(ch);
    tickets.push({
      x: -40,
      y: chY(idx),
      label: ch,
      color: colors[ch],
      phase: 0,
      score: Math.random() < 0.35 ? "hot" : Math.random() < 0.55 ? "warm" : "cold"
    });
  }

  function chY(i) {
    var base = ch * 0.38;
    return base + i * (ch * 0.14);
  }

  var lastSpawn = 0;

  function drawPipelineLabels() {
    ctx.font = "600 11px Inter, system-ui, sans-serif";
    ctx.fillStyle = PAL.muted;
    ctx.fillText("Вход", cw * 0.06, ch * 0.2);
    ctx.fillText("AI-квалификация", cw * 0.38, ch * 0.2);
    ctx.fillText("CRM", cw * 0.72, ch * 0.2);
    var lanes = [
      { t: "Горячий", c: PAL.hot, y: 0.32 },
      { t: "Тёплый", c: PAL.warm, y: 0.52 },
      { t: "Холодный", c: PAL.cold, y: 0.72 }
    ];
    lanes.forEach(function (lane) {
      rr(ctx, cw * 0.68, ch * lane.y, cw * 0.26, ch * 0.14, 10, "#fff", PAL.line);
      ctx.fillStyle = lane.c;
      ctx.beginPath();
      ctx.arc(cw * 0.7 + 8, ch * lane.y + 14, 4, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = PAL.ink;
      ctx.fillText(lane.t, cw * 0.7 + 18, ch * lane.y + 18);
    });
  }

  function drawQualifier(cx, cy, active) {
    var r = Math.min(cw, ch) * 0.09;
    var pulse = 0.5 + 0.5 * Math.sin(frame * 0.06);
    if (active) {
      ctx.strokeStyle = PAL.aiGlow;
      ctx.lineWidth = 10 + pulse * 6;
      ctx.beginPath();
      ctx.arc(cx, cy, r + 12, 0, Math.PI * 2);
      ctx.stroke();
    }
    var grad = ctx.createRadialGradient(cx, cy, 2, cx, cy, r);
    grad.addColorStop(0, "#60a5fa");
    grad.addColorStop(1, PAL.ai);
    ctx.fillStyle = grad;
    ctx.beginPath();
    ctx.arc(cx, cy, r, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = PAL.ink;
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "700 11px Inter, system-ui, sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI", cx, cy + 4);
    ctx.textAlign = "left";
    if (active) {
      var sec = 5 + Math.floor((frame % 120) / 8);
      if (sec > 15) sec = 8;
      ctx.fillStyle = PAL.ink;
      ctx.font = "600 10px Inter, system-ui, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(sec + " с", cx, cy + r + 16);
      ctx.textAlign = "left";
    }
  }

  function drawTicket(t) {
    var w = cw * 0.14;
    var h = ch * 0.08;
    rr(ctx, t.x, t.y, w, h, 8, t.color, PAL.ink);
    ctx.fillStyle = PAL.ink;
    ctx.font = "600 10px Inter, system-ui, sans-serif";
    ctx.fillText(t.label, t.x + 10, t.y + h * 0.62);
  }

  function routeColor(score) {
    if (score === "hot") return PAL.hot;
    if (score === "warm") return PAL.warm;
    return PAL.cold;
  }

  function targetY(score) {
    if (score === "hot") return ch * 0.36;
    if (score === "warm") return ch * 0.56;
    return ch * 0.76;
  }

  function tick() {
    if (!reduced) frame++;
    else frame += 0.25;

    ctx.clearRect(0, 0, cw, ch);
    drawClock();
    drawPipelineLabels();

    var qx = cw * 0.48;
    var qy = ch * 0.55;
    var anyActive = false;

    if (!reduced && frame - lastSpawn > 70 + Math.random() * 40) {
      spawnTicket();
      lastSpawn = frame;
    }

    for (var i = tickets.length - 1; i >= 0; i--) {
      var t = tickets[i];
      t.phase += reduced ? 0.008 : 0.018;
      if (t.phase < 0.45) {
        t.x += (qx - 80 - t.x) * 0.04;
        t.y += (qy - t.y) * 0.03;
        anyActive = true;
      } else if (t.phase < 0.55) {
        t.x = qx - cw * 0.07;
        t.y = qy - ch * 0.04;
        anyActive = true;
      } else {
        var tx = cw * 0.78;
        var ty = targetY(t.score);
        t.x += (tx - t.x) * 0.05;
        t.y += (ty - t.y) * 0.05;
        if (t.phase > 0.95 && Math.abs(t.x - tx) < 4) {
          pulses.push({ x: tx, y: ty, c: routeColor(t.score), life: 40 });
          if (t.score === "hot" && Math.random() < 0.4) {
            bubbles.push({ x: tx - 20, y: ty - 30, text: "→ менеджеру", life: 90 });
          }
          tickets.splice(i, 1);
        }
      }
      drawTicket(t);
    }

    drawQualifier(qx, qy, anyActive);

    for (var p = pulses.length - 1; p >= 0; p--) {
      var pu = pulses[p];
      pu.life--;
      ctx.strokeStyle = pu.c;
      ctx.globalAlpha = pu.life / 40;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(pu.x, pu.y, 18 + (40 - pu.life), 0, Math.PI * 2);
      ctx.stroke();
      ctx.globalAlpha = 1;
      if (pu.life <= 0) pulses.splice(p, 1);
    }

    for (var b = bubbles.length - 1; b >= 0; b--) {
      var bub = bubbles[b];
      bub.life--;
      bub.y -= 0.3;
      ctx.fillStyle = PAL.panel;
      rr(ctx, bub.x, bub.y, 88, 22, 6, PAL.panel, PAL.ok);
      ctx.fillStyle = PAL.ink;
      ctx.font = "600 9px Inter, system-ui, sans-serif";
      ctx.fillText(bub.text, bub.x + 8, bub.y + 14);
      if (bub.life <= 0) bubbles.splice(b, 1);
    }

    // connector lines
    ctx.strokeStyle = PAL.line;
    ctx.setLineDash([6, 6]);
    ctx.beginPath();
    ctx.moveTo(cw * 0.22, ch * 0.55);
    ctx.lineTo(cw * 0.38, ch * 0.55);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(cw * 0.58, ch * 0.55);
    ctx.lineTo(cw * 0.66, ch * 0.55);
    ctx.stroke();
    ctx.setLineDash([]);

    requestAnimationFrame(tick);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", tick);
  } else {
    tick();
  }
})();
</script>
</section>

<section id="svyazka-sayt-ai-crm" class="nero-ai-section nero-ai-section-alt nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Как работает связка «сайт → AI → CRM»</h2>
    <p class="nero-ai-lead"><strong>Коротко:</strong> заявка → webhook → AI за секунды → квалификация → CRM → менеджер с контекстом.</p>
    <div class="nero-ai-grid-3">
      <article class="nero-ai-card nero-ai-bento-card"><h4>Вход</h4><p>WP, Tilda, Jivo → webhook (&lt;1 с)</p></article>
      <article class="nero-ai-card nero-ai-bento-card"><h4>AI</h4><p>Подтверждение за 5–15 с, 3–5 вопросов</p></article>
      <article class="nero-ai-card nero-ai-bento-card"><h4>CRM</h4><p>Лид, тег «AI-квалифицирован», поля</p></article>
    </div>

    <h3 id="kanaly">Форма, виджет, WhatsApp, Telegram</h3>
    <ol class="nero-ai-ol-steps">
      <li>Вход: WP, Tilda, Jivo/Carrot → webhook.</li>
      <li>Подтверждение за <strong>5–15 с</strong>.</li>
      <li>3–5 вопросов на естественном языке.</li>
      <li>CRM: лид, тег, поля, маршрутизация.</li>
      <li>Логи, LRT, % эскалаций.</li>
    </ol>
    <p>Оркестрация: <strong>Make</strong> или <strong>n8n</strong>. Сценарий <a href="https://vc.ru/ai/2846645-n8n-i-gigachat-avtomatizatsiya-prodazh-dlya-malogo-biznesa" rel="noopener noreferrer" target="_blank">vc.ru</a>: Telegram → GigaChat → amoCRM.</p>

    <h3 id="amocrm-bitrix">amoCRM и Битрикс24: поля, статусы, ответственный менеджер</h3>
    <p>B2B + Amo (<a href="https://www.sostav.ru/blogs/281569/88011" rel="noopener noreferrer" target="_blank">sostav.ru</a>): заполнение CRM <strong>40%→100%</strong>; <strong>~30%</strong> лидов зависли на «КП отправлено» &gt; недели.</p>
  </div>
</section>

<section id="vnedrenie-pod-kluch" class="nero-ai-section nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Внедрение под ключ: этапы, сроки, что входит</h2>
    <p><strong>Проектная модель Nero Network</strong> (не публичный кейс). Прямых РФ-кейсов «форма → 5–15 с → CRM под ключ» в открытом доступе <strong>мало</strong>.</p>

    <h3 id="audit-voronki">Аудит текущей воронки и точек потерь</h3>
    <p><strong>2–3 дня:</strong> каналы, CRM, LRT, 5–7 вопросов квалификации, «красные линии». CTA: <strong>аудит потерь за 30 минут</strong>.</p>

    <h3 id="obuchenie-rag">Обучение на FAQ, прайсе, регламентах</h3>
    <p>RAG + тест <strong>20–30</strong> диалогов. Без данных в базе — эскалация, не выдуманный ответ.</p>
    <p class="nero-ai-card" style="padding: 20px 22px; margin: 24px 0; line-height: 1.65;">
  Перед заказом внедрения полезно понять, какие процессы уже можно автоматизировать без «чёрного ящика»:
  <a class="nero-ai-btn nero-ai-btn-secondary" style="display: inline-flex; margin-top: 12px;" href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#vnedrenie-pod-kluch'); ?>"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'Что можно автоматизировать'); ?></a>
</p>

    <h3 id="pilot">Пилот и масштабирование</h3>
    <p><strong>1–2 недели</strong> на одном канале. AI: first response, scoring, CRM, RAG, follow-up. Человек: переговоры, скидки, юридические обещания, закрытие.</p>
    <ol class="nero-ai-ol-steps">
      <li>Форма/виджет → webhook.</li>
      <li>Авто-подтверждение за <strong>5–15 с</strong>.</li>
      <li>AI: 3–5 вопросов (услуга, срок, бюджет, город).</li>
      <li>Сущности → CRM + hot/warm/cold.</li>
      <li>Горячий: Telegram менеджеру + задача «перезвонить».</li>
      <li>Низкая уверенность → человек с транскриптом.</li>
    </ol>
  </div>
</section>

<section id="sla-metriki" class="nero-ai-section nero-ai-section-alt nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>SLA 5–15 секунд и метрики эффективности</h2>
    <p><strong>SLA:</strong> первый ответ AI — <strong>5–15 с</strong>; менеджер на горячий лид — отдельный KPI (минуты).</p>
    <h3 id="metriki-crm">Время первого ответа, конверсия в CRM, % потерянных лидов</h3>
    <div class="nero-ai-table-wrap">
      <table class="nero-ai-table">
        <thead><tr><th>Метрика</th><th>Зачем</th></tr></thead>
        <tbody>
          <tr><td>LRT</td><td>До/после</td></tr>
          <tr><td>% ночных заявок</td><td>24/7</td></tr>
          <tr><td>% эскалаций</td><td>Качество</td></tr>
          <tr><td>Конверсия в «горячий»</td><td>Скрипт</td></tr>
          <tr><td>Заполненность CRM</td><td>Воронка</td></tr>
        </tbody>
      </table>
    </div>
    <h3 id="pervyj-mesyac">Что измерять в первый месяц</h3>
    <p>LRT по каналам; доля без эскалации; конверсия в звонок/встречу; QA ошибок; базовая линия «до пилота».</p>
  </div>
</section>

<section id="stoimost" class="nero-ai-section nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Стоимость и ориентиры чека (ai обработка заявок цена)</h2>
    <p>Тема Nero (Google Таблица): <strong>120–350 тыс. ₽</strong> старт + поддержка.</p>
    <h3 id="start-podderzhka">Старт 120–350 тыс. ₽ и поддержка</h3>
    <p>Аудит, пилот, RAG, CRM, ночной режим, дашборд месяца. Рынок (не Nero): SaaS <strong>15–40 тыс. ₽/мес</strong> (<a href="https://swiftagents.ru/blog/skolko-stoit-vnedrit-ii-v-malyy-biznes" rel="noopener noreferrer" target="_blank">swiftagents.ru</a>).</p>
    <h3 id="okupaemost">Когда окупается для услуг, школ, клиник</h3>
    <p>ЦА: МСБ, услуги, школы, клиники; много заявок вне 9–18.</p>
  </div>
</section>

<section id="riski-compliance" class="nero-ai-section nero-ai-section-alt nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Риски и комплаенс: 152-ФЗ, галлюцинации, эскалация на человека</h2>
    <h3 id="pd-hranenie">Хранение переписки и согласия</h3>
    <p>Локализация ПДн с <strong>01.07.2025</strong> (<a href="https://b1.ru/insights/law-messenger/localization-of-personal-data-of-russian-citizens-6-march-2025/" rel="noopener noreferrer" target="_blank">b1.ru</a>).</p>
    <h3 id="eskalaciya">Когда AI обязан передать диалог менеджеру</h3>
    <p>Низкая уверенность; негатив; скидки/договор; медицина/право вне регламента; просьба «человека».</p>
    <p>OpenAI inbound: точность <strong>~60%→&gt;98%</strong> с human-in-the-loop (<a href="https://openai.com/index/openai-inbound-sales-assistant/" rel="noopener noreferrer" target="_blank">openai.com</a>). Для МСБ — не обещать 98% без пилота.</p>
  </div>
</section>

<section id="keisy" class="nero-ai-section nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Кейсы и примеры внедрения (ai обработка заявок кейсы)</h2>
    <p>Именованных РФ-кейсов «только сайт → 5–15 с → CRM» <strong>мало</strong>. Цифры — только со ссылкой.</p>
    <h3 id="msb-vs-korp">МСБ и услуги vs корпоративный масштаб</h3>
    <div class="nero-ai-table-wrap">
      <table class="nero-ai-table">
        <thead><tr><th>Пример</th><th>Суть</th></tr></thead>
        <tbody>
          <tr><td>ТЕРМОС / Sostav</td><td>Make, scoring, RAG</td></tr>
          <tr><td>Botseller</td><td>9 сайтов, Amo — <a href="https://botseller.ai/blog/ii-bot-dlya-strojmaterialov-kejs" rel="noopener noreferrer" target="_blank">вендор</a></td></tr>
          <tr><td>SalesBot amo</td><td><strong>2,3×</strong> показ, <strong>22→4 мин</strong></td></tr>
          <tr><td>B2B + Amo</td><td>CRM <strong>40%→100%</strong></td></tr>
        </tbody>
      </table>
    </div>
    <h3 id="openai-trend">Агентные сценарии first response (тренд OpenAI Business)</h3>
    <p><a href="https://openai.com/index/openai-inbound-sales-assistant/" rel="noopener noreferrer" target="_blank">OpenAI Inbound Sales Assistant</a> — inbound-формы, RAG, handoff с контекстом.</p>
    <p><a href="https://www.intercom.com/blog/announcing-fin-for-sales/" rel="noopener noreferrer" target="_blank">Intercom Fin for Sales</a> — playbook, CRM; <strong>$9.99/Qualification</strong>.</p>
  </div>
</section>

<section id="faq" class="nero-ai-section nero-ai-section-alt nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>FAQ по AI-обработке заявок для малого бизнеса</h2>
    <div class="nero-ai-faq">
      <details class="nero-ai-reveal"><summary>Чем ai агент для сайта отличается от чат-бота?</summary><p>Свободный текст, CRM, scoring vs кнопки.</p></details>
      <details class="nero-ai-reveal"><summary>Заменит отдел продаж?</summary><p>Нет; первичка у AI, закрытие у человека.</p></details>
      <details class="nero-ai-reveal"><summary>Срок внедрения?</summary><p>Аудит 2–3 дня, пилот 1–2 недели, месяц метрик.</p></details>
      <details class="nero-ai-reveal"><summary>Стоимость?</summary><p>Nero: <strong>120–350 тыс. ₽</strong> старт; рынок от <strong>15 000 ₽/мес</strong>.</p></details>
      <details class="nero-ai-reveal"><summary>Нужна amoCRM/Битрикс24?</summary><p>Да для «горячего» лида с полями.</p></details>
      <details class="nero-ai-reveal"><summary>Ошибки AI?</summary><p>RAG, эскалация, human-in-the-loop.</p></details>
      <details class="nero-ai-reveal"><summary>Мало заявок?</summary><p>Сначала аудит окупаемости.</p></details>
      <details class="nero-ai-reveal"><summary>152-ФЗ?</summary><p>Согласие, локализация, каналы.</p></details>
      <details class="nero-ai-reveal"><summary>Есть SalesBot?</summary><p>LLM даёт секунды и свободный текст.</p></details>
      <details class="nero-ai-reveal"><summary>Только OpenAI?</summary><p>Зависит от данных; возможны YandexGPT/GigaChat.</p></details>
      <details class="nero-ai-reveal"><summary>Как узнать потери?</summary><p><strong>Аудит за 30 минут</strong> (CTA темы).</p></details>
    </div>
  </div>
</section>

<div class="nero-ai-container"><aside class="nero-ai-card nero-ai-final-cta nero-ai-reveal" aria-labelledby="nero-cta-audit-final">
  <h2 id="nero-cta-audit-final">Аудит потерь заявок за 30 минут — бесплатно</h2>
  <p>Зафиксируем базовую линию: LRT, долю ночных заявок без ответа и качество карточек в CRM. После аудита — понятный план: пилот «сайт → AI (5–15 с) → amoCRM/Битрикс24» или доработка процесса без AI.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url(getenv('PRIMARY_CTA_URL') ?: '#audit-30-min'); ?>"><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Проверить потери заявок'); ?></a>
  </div>
</aside></div>

<section id="audit-30-min" class="nero-ai-section nero-ai-prose nero-ai-reveal">
  <div class="nero-ai-container">
    <h2>Проверить, сколько заявок вы теряете — аудит за 30 минут</h2>
    <p class="nero-ai-lead"><strong>Коротко:</strong> до <strong>ai обработка заявок под ключ</strong> — базовая линия: ночные заявки, LRT, пустые поля CRM.</p>
    <ol class="nero-ai-ol-steps">
      <li>Каналы (форма, чат, мессенджеры).</li>
      <li>10–20 заявок: время обращения vs ответа.</li>
      <li>Поля CRM до звонка.</li>
      <li>Ночные/выходные без ответа.</li>
      <li>Рекомендация: пилот или процесс без AI.</li>
    </ol>
    <p>Дальше: <strong>сайт → AI (5–15 с) → amoCRM/Битрикс24 → менеджер</strong>. Nero Network: ответ 24/7, квалификация, горячий лид в CRM.</p>
    <div class="nero-ai-callout"><p><strong>Итог:</strong> <strong>ai консультант на сайт</strong> с CRM — ответ на боль МСБ. Выигрывает связка скорости, RAG, комплаенса и метрик.</p></div>
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
      "headline": "Внедрение AI-агента для обработки заявок с сайта под ключ",
      "description": "Внедряем AI-агента для первичной обработки заявок с сайта: ответ за 5–15 сек, квалификация лида и передача в CRM.",
      "author": {"@type": "Organization", "name": "Nero Network"},
      "inLanguage": "ru-RU"
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {"@type": "Question", "name": "Чем ai агент для сайта отличается от чат-бота?", "acceptedAnswer": {"@type": "Answer", "text": "Свободный текст, CRM, scoring vs кнопки."}},
        {"@type": "Question", "name": "Заменит отдел продаж?", "acceptedAnswer": {"@type": "Answer", "text": "Нет; первичка у AI, закрытие у человека."}},
        {"@type": "Question", "name": "Срок внедрения?", "acceptedAnswer": {"@type": "Answer", "text": "Аудит 2–3 дня, пилот 1–2 недели, месяц метрик."}},
        {"@type": "Question", "name": "Стоимость?", "acceptedAnswer": {"@type": "Answer", "text": "Nero: 120–350 тыс. ₽ старт; рынок от 15 000 ₽/мес."}}
      ]
    },
    {
      "@type": "SoftwareApplication",
      "name": "AI-агент для обработки заявок с сайта",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Web"
    }
  ]
}
</script>

<?php
get_footer();

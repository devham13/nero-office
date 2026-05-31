<?php
/**
 * Template Name: AI-обработка заявок с сайта
 * Description: AI-агент для первичной обработки заявок с сайта — лонгрид Nero Network.
 */

$page_seo_title = 'AI-обработка заявок с сайта: агент за 5–15 сек и CRM';
$page_seo_description = 'AI-агент для заявок с сайта: ответ за 5–15 сек, уточняющие вопросы и передача лида в CRM. Внедрение под ключ, кейсы, amoCRM и Битрикс24.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '
<meta property="og:image" content="https://meta-journal.ru/wp-content/uploads/nero-ai-lead-hero-og.jpg" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:image" content="https://meta-journal.ru/wp-content/uploads/nero-ai-lead-hero-og.jpg" />
<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
}, 1);

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


/* Hero Алины: не затемнять глобальными правилами nero-ai-home-page */
.nero-ai-home-page .ai-intake-hero,
.nero-ai-home-page .fullscreen-white-office.ai-intake-hero,
.nero-ai-home-page #ai-intake-hero {
  background: linear-gradient(165deg, #ffffff 0%, #f8fafc 48%, #f1f5f9 100%) !important;
  color: #0f172a !important;
  min-height: 100vh !important;
  min-height: 100dvh !important;
  position: relative !important;
}
.nero-ai-home-page .ai-intake-hero .giant-seo,
.nero-ai-home-page .ai-intake-hero .giant-seo span,
.nero-ai-home-page .ai-intake-hero h1,
.nero-ai-home-page .ai-intake-hero p,
.nero-ai-home-page .ai-intake-hero .ai-intake-sub,
.nero-ai-home-page .ai-intake-hero .ai-intake-steps,
.nero-ai-home-page .ai-intake-hero .ai-intake-pill {
  color: inherit;
}
.nero-ai-home-page .ai-intake-hero a.cta-telegram {
  color: #fff !important;
}

/* Intro после hero */
.ai-obrabotka-intro-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.1fr) minmax(280px, 0.9fr);
  gap: clamp(20px, 4vw, 40px);
  align-items: start;
}
.ai-obrabotka-intro-copy {
  text-align: left !important;
  border-left: 4px solid var(--nero-ai-primary);
  padding-left: clamp(16px, 2vw, 24px);
}
.ai-obrabotka-intro-copy p { text-align: left !important; }
.ai-obrabotka-intro-lead {
  font-size: clamp(17px, 1.8vw, 20px);
  line-height: 1.65;
  color: var(--nero-ai-soft) !important;
  margin: 0 0 12px;
}
.ai-obrabotka-intro-sub {
  margin: 0;
  font-size: 15px;
  line-height: 1.6;
  color: var(--nero-ai-muted) !important;
}
.ai-obrabotka-intro-terminal { padding: 18px; }
.ai-obrabotka-terminal-top {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-bottom: 14px;
  font-size: 12px;
  font-weight: 700;
  color: var(--nero-ai-muted);
}
.ai-obrabotka-terminal-top span {
  width: 8px; height: 8px; border-radius: 50%;
  background: rgba(121, 242, 255, 0.5);
}
.ai-obrabotka-terminal-lines {
  list-style: none;
  margin: 0 0 14px;
  padding: 0;
  display: grid;
  gap: 8px;
  font-size: 13px;
  line-height: 1.45;
  color: var(--nero-ai-soft);
}
.ai-obrabotka-terminal-lines code {
  color: var(--nero-ai-primary);
  font-weight: 700;
}
.ai-obrabotka-intro-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.ai-obrabotka-intro-chips span {
  padding: 6px 10px;
  border-radius: 999px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  background: rgba(121, 242, 255, 0.08);
  font-size: 11px;
  font-weight: 700;
  color: var(--nero-ai-primary);
}
.nero-ai-toc-wrap { margin-top: 28px; text-align: center; }
.nero-ai-toc {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 10px;
}
.nero-ai-toc a {
  padding: 8px 14px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.12);
  background: rgba(255,255,255,.05);
  font-size: 13px;
  font-weight: 700;
  text-decoration: none !important;
  color: var(--nero-ai-soft) !important;
}
.nero-ai-toc a:hover { border-color: rgba(121,242,255,.35); color: #fff !important; }

/* Prose longread */
.nero-ai-prose-wrap .nero-ai-section-head { margin-bottom: 28px; }
.nero-ai-prose { text-align: left; max-width: 900px; }
.nero-ai-prose h3 {
  margin: 28px 0 12px;
  font-size: clamp(20px, 2.2vw, 26px);
}
.nero-ai-prose p {
  margin: 0 0 16px;
  font-size: 16px;
  line-height: 1.72;
}
.nero-ai-prose a {
  color: var(--nero-ai-primary) !important;
  text-decoration: underline;
  text-underline-offset: 3px;
}
.nero-ai-prose-list {
  margin: 0 0 18px 1.2em;
  padding: 0;
  color: var(--nero-ai-muted);
}
.nero-ai-prose-list li { margin-bottom: 8px; line-height: 1.6; }
.nero-ai-table-wrap { overflow-x: auto; margin: 0 0 20px; }
.nero-ai-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}
.nero-ai-table th,
.nero-ai-table td {
  border: 1px solid rgba(255,255,255,.1);
  padding: 10px 12px;
  text-align: left;
  vertical-align: top;
}
.nero-ai-table th { background: rgba(255,255,255,.06); color: #fff; }
.nero-ai-code {
  margin: 0 0 20px;
  padding: 16px;
  border-radius: 16px;
  background: rgba(0,0,0,.35);
  border: 1px solid rgba(255,255,255,.08);
  overflow-x: auto;
  font-size: 13px;
  line-height: 1.5;
  color: #c7d2e5;
}
.nero-ai-inline-cta {
  margin: 28px 0;
  padding: 22px 24px;
}
.nero-ai-inline-cta p { margin: 0 0 16px; color: var(--nero-ai-soft) !important; }
#boris-article-viz { margin: 0; }

@media (max-width: 900px) {
  .ai-obrabotka-intro-grid { grid-template-columns: 1fr; }
  .ai-obrabotka-intro-copy { border-left-width: 3px; }
}

</style>

<div id="primary" class="site-main nero-ai-home-page ai-obrabotka-zayavok-s-sayta-page" tabindex="-1"><span id="main" class="screen-reader-text" aria-hidden="true"></span>
<section id="ai-intake-hero" class="fullscreen-white-office ai-intake-hero" aria-label="Hero: AI-обработка заявок с сайта">
<style>
.fullscreen-white-office.ai-intake-hero {
  position: relative;
  overflow: hidden;
  min-height: 100vh;
  background: linear-gradient(165deg, #ffffff 0%, #f8fafc 48%, #f1f5f9 100%);
}
.ai-intake-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(15, 23, 42, 0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(15, 23, 42, 0.04) 1px, transparent 1px);
  background-size: 48px 48px;
  pointer-events: none;
  z-index: 0;
}
.ai-intake-hero-canvas-wrap {
  position: absolute;
  inset: 0;
  z-index: 1;
}
#ai-lead-hub-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.ai-intake-copy {
  position: absolute;
  left: clamp(20px, 5vw, 72px);
  top: 50%;
  transform: translateY(-50%);
  max-width: min(520px, 42vw);
  z-index: 4;
}
.giant-seo {
  font-size: clamp(32px, 4.6vw, 68px);
  font-weight: 900;
  line-height: 1.06;
  letter-spacing: -2px;
  color: #0f172a;
  margin: 0;
  font-family: Inter, system-ui, sans-serif;
}
.giant-seo span {
  display: block;
  background: linear-gradient(92deg, #0ea5e9, #6366f1);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
}
.giant-seo-sub {
  font-size: clamp(15px, 1.9vw, 21px);
  line-height: 1.55;
  color: rgba(15, 23, 42, 0.72);
  margin: 18px 0 0;
  max-width: 520px;
  font-family: Inter, system-ui, sans-serif;
}
.telegram-button {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-top: 26px;
  padding: 12px 22px;
  background: #0f172a;
  color: #fff !important;
  border-radius: 999px;
  font-weight: 700;
  font-size: 14px;
  text-decoration: none;
  transition: transform 0.2s;
  font-family: Inter, system-ui, sans-serif;
}
.telegram-button:hover { transform: translateY(-2px); }
.vl-ui-tasks.ai-intake-steps {
  position: absolute;
  left: clamp(16px, 4vw, 56px);
  top: clamp(72px, 10vh, 120px);
  display: flex;
  flex-direction: column;
  gap: 8px;
  z-index: 3;
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
  font-family: Inter, system-ui, sans-serif;
}
.vl-ui-task span {
  width: 26px;
  height: 26px;
  background: #0ea5e9;
  color: #fff;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 800;
  flex-shrink: 0;
}
.vl-ui-pill.ai-intake-pill {
  position: absolute;
  top: clamp(20px, 4vh, 48px);
  right: clamp(16px, 4vw, 56px);
  left: auto;
  bottom: auto;
  transform: none;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-end;
  gap: 10px;
  z-index: 3;
}
.vl-ui-pill.ai-intake-pill span {
  padding: 9px 16px;
  background: rgba(255, 255, 255, 0.94);
  border: 1px solid #e2e8f0;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  color: #334155;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  font-family: Inter, system-ui, sans-serif;
}
@media (max-width: 900px) {
  .ai-intake-copy {
    top: auto;
    bottom: clamp(100px, 18vh, 160px);
    transform: none;
    max-width: calc(100% - 40px);
  }
  .vl-ui-tasks.ai-intake-steps {
    top: auto;
    bottom: clamp(16px, 3vh, 32px);
    flex-direction: row;
    flex-wrap: wrap;
    max-width: calc(100% - 32px);
  }
  .vl-ui-pill.ai-intake-pill {
    top: 12px;
    right: 12px;
    left: 12px;
    justify-content: center;
  }
}
</style>

<div class="ai-intake-hero-canvas-wrap" aria-hidden="true">
  <canvas id="ai-lead-hub-canvas" width="1200" height="800"></canvas>
</div>

<div class="vl-ui-tasks ai-intake-steps" aria-label="Этапы обработки заявки">
  <div class="vl-ui-task"><span>1</span> Захват формы</div>
  <div class="vl-ui-task"><span>2</span> AI-разбор</div>
  <div class="vl-ui-task"><span>3</span> Маршрутизация</div>
  <div class="vl-ui-task"><span>4</span> Ответ клиенту</div>
  <div class="vl-ui-task"><span>5</span> Запись в CRM</div>
</div>

<div class="vl-ui-pill ai-intake-pill" aria-label="Метрики">
  <span>&lt; 30 сек на лид</span>
  <span>24/7 приём</span>
  <span>Антиспам-фильтр</span>
</div>

<div class="ai-intake-copy">
  <h1 class="giant-seo">AI-агент принимает <span>заявки с сайта</span></h1>
  <p class="giant-seo-sub">Читает форму за секунды, уточняет контакт, оценивает лид и передаёт ответственному менеджеру — без потерь в почте и мессенджерах.</p>
  <a class="telegram-button" href="https://t.me/neroteam" target="_blank" rel="noopener">Обсудить внедрение →</a>
</div>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("ai-lead-hub-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");
  let cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  const CYCLE = 240;

  function resizeCanvas() {
    const parent = canvas.parentElement;
    if (!parent) return;
    canvas.width = parent.clientWidth || window.innerWidth;
    canvas.height = parent.clientHeight || window.innerHeight;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw * 0.58;
    cy = ch * 0.52;
    scale = cw < 768 ? cw / 620 : Math.min(cw / 1100, ch / 820) * 1.35;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  const C = {
    outline: "#0f172a",
    panel: "#ffffff",
    panelEdge: "#e2e8f0",
    accent: "#0ea5e9",
    accent2: "#6366f1",
    hot: "#f97316",
    ok: "#22c55e",
    muted: "#94a3b8",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    leadA: "#bae6fd",
    leadB: "#a7f3d0",
    leadC: "#fde68a",
    bubbleBg: "#ffffff"
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

  class AmbientPulse {
    draw(ctx) {
      const t = frame * 0.02;
      for (let i = 0; i < 6; i++) {
        const a = t + (i * Math.PI) / 3;
        const r = 220 + Math.sin(t + i) * 18;
        ctx.globalAlpha = 0.06 + Math.sin(t * 2 + i) * 0.03;
        ctx.strokeStyle = C.accent;
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.arc(40, -30, r, a, a + 0.6);
        ctx.stroke();
      }
      ctx.globalAlpha = 1;
    }
  }

  class OrbitalLeadStream {
    constructor() {
      this.orbs = [
        { r: 195, speed: 0.018, color: C.leadA, phase: 0 },
        { r: 235, speed: -0.014, color: C.leadB, phase: 1.2 },
        { r: 275, speed: 0.011, color: C.leadC, phase: 2.4 }
      ];
    }
    draw(ctx) {
      this.orbs.forEach((o, idx) => {
        const ang = frame * o.speed + o.phase;
        ctx.strokeStyle = C.panelEdge;
        ctx.lineWidth = 2;
        ctx.setLineDash([6, 10]);
        ctx.beginPath();
        ctx.arc(30, -20, o.r, ang - 0.9, ang + 2.2);
        ctx.stroke();
        ctx.setLineDash([]);
        for (let k = 0; k < 3; k++) {
          const da = ang + k * 2.1;
          const lx = 30 + Math.cos(da) * o.r;
          const ly = -20 + Math.sin(da) * o.r * 0.55;
          drawPolyRound(ctx, lx - 7, ly - 7, 14, 14, 4, o.color, C.outline);
          if (idx === 0 && k === 0) {
            ctx.fillStyle = C.outline;
            ctx.font = "bold 7px sans-serif";
            ctx.textAlign = "center";
            ctx.fillText("?", lx, ly + 2);
          }
        }
      });
    }
  }

  class ScoreGauge {
    constructor(x, y) {
      this.x = x;
      this.y = y;
    }
    draw(ctx, score) {
      drawPolyRound(ctx, this.x, this.y, 90, 12, 4, C.panelEdge, C.outline);
      const w = Math.max(8, 84 * score);
      drawPolyRound(ctx, this.x + 3, this.y + 3, w, 6, 3, score > 0.7 ? C.ok : C.accent, null);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 8px sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("AI " + Math.round(score * 100) + "%", this.x, this.y - 6);
    }
  }

  class CrmSlotRow {
    constructor(x, y) {
      this.x = x;
      this.y = y;
      this.active = 0;
    }
    draw(ctx, phase, pick) {
      this.active = pick;
      for (let i = 0; i < 3; i++) {
        const sx = this.x + i * 52;
        const on = phase > 120 && pick === i;
        drawPolyRound(ctx, sx, this.y, 44, 36, 6, on ? "#dcfce7" : C.panel, C.outline);
        ctx.fillStyle = on ? C.ok : C.muted;
        ctx.beginPath();
        ctx.arc(sx + 22, this.y + 14, 8, 0, Math.PI * 2);
        ctx.fill();
        ctx.fillStyle = C.outline;
        ctx.font = "bold 7px sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(["А", "Б", "В"][i], sx + 22, this.y + 30);
      }
    }
  }

  class ClientAckBubble {
    draw(ctx, alpha, yOff) {
      if (alpha <= 0) return;
      ctx.save();
      ctx.globalAlpha = alpha;
      drawPolyRound(ctx, -55, -120 + yOff, 110, 28, 8, C.panel, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 9px sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Приняли заявку", 0, -104 + yOff);
      ctx.restore();
    }
  }

  class IntakeCommandBoard {
    constructor(x, y) {
      this.x = x;
      this.y = y;
      this.gauge = new ScoreGauge(x + 20, y + 175);
      this.slots = new CrmSlotRow(x + 15, y + 200);
      this.ack = new ClientAckBubble();
      this.ring = 0;
    }
    draw(ctx) {
      const phase = (frame * 0.04) % CYCLE;
      drawPolyRound(ctx, this.x, this.y, 200, 250, 10, "#f1f5f9", C.outline);
      drawPolyRound(ctx, this.x + 8, this.y + 8, 184, 28, [8, 8, 0, 0], C.panelEdge, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 10px sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Щит приёма заявок", this.x + 14, this.y + 26);

      const wx = this.x + 12;
      const wy = this.y + 42;

      if (phase < 70) {
        const slide = Math.min(1, phase / 25);
        drawPolyRound(ctx, wx, wy + (1 - slide) * 30, 160, 48, 6, C.panel, C.outline);
        drawPolyRound(ctx, wx + 10, wy + 12 + (1 - slide) * 30, 60, 8, 2, C.panelEdge, null);
        drawPolyRound(ctx, wx + 10, wy + 26 + (1 - slide) * 30, 140, 8, 2, C.leadA, null);
        drawPolyRound(ctx, wx + 10, wy + 38 + (1 - slide) * 30, 90, 8, 2, C.leadB, null);
      } else if (phase < 130) {
        drawPolyRound(ctx, wx, wy, 160, 70, 6, C.panel, C.outline);
        const scanY = wy + 10 + ((phase - 70) % 40);
        ctx.fillStyle = "rgba(14, 165, 233, 0.25)";
        ctx.fillRect(wx + 8, scanY, 144, 4);
        ctx.fillStyle = C.outline;
        ctx.font = "bold 9px sans-serif";
        ctx.fillText("Разбор полей…", wx + 12, wy + 58);
        this.gauge.draw(ctx, Math.min(1, (phase - 70) / 50));
      } else if (phase < 210) {
        drawPolyRound(ctx, wx, wy, 160, 55, 6, C.panel, C.outline);
        const pick = Math.floor((phase - 130) / 25) % 3;
        this.slots.draw(ctx, phase, pick);
        ctx.fillStyle = C.outline;
        ctx.font="bold 9px sans-serif";
        ctx.fillText("→ менеджер " + ["А","Б","В"][pick], wx + 12, wy + 48);
      } else {
        const fin = phase - 210;
        this.ring = Math.min(1, fin / 20);
        ctx.strokeStyle = C.ok;
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.arc(wx + 80, wy + 40, 28 + this.ring * 12, 0, Math.PI * 2 * this.ring);
        ctx.stroke();
        ctx.fillStyle = C.ok;
        ctx.font = "900 18px sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("✓", wx + 80, wy + 46);
        this.ack.draw(ctx, fin / 25, -fin * 0.8);
      }
    }
  }

  class Agent {
    constructor(x, y, color, role, stepTrig, dialogs, hubX, hubY) {
      this.x = x;
      this.y = y;
      this.baseX = x;
      this.baseY = y;
      this.color = color;
      this.role = role;
      this.stepTrig = stepTrig;
      this.dialogs = dialogs;
      this.hubX = hubX;
      this.hubY = hubY;
      this.timer = Math.random() * 100;
      this.hitAnimation = 0;
    }

    draw(ctx) {
      this.timer += 0.03;
      const prg = (frame * 0.04) % CYCLE;
      let isMoving = false;
      let carryType = null;
      let faceDir = 1;
      const targetX = this.hubX;
      const targetY = this.hubY;

      if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
        const local = prg - this.stepTrig;
        if (local < 12) {
          isMoving = true;
          faceDir = targetX > this.baseX ? 1 : -1;
          carryType = this.color;
          const t = local / 12;
          this.x = this.baseX + (targetX - this.baseX) * t;
          this.y = this.baseY + (targetY - this.baseY) * t;
        } else if (local < 18) {
          this.x = targetX;
          this.y = targetY;
        } else {
          isMoving = true;
          faceDir = targetX > this.baseX ? -1 : 1;
          const t = (local - 18) / 10;
          this.x = targetX - (targetX - this.baseX) * t;
          this.y = targetY - (targetY - this.baseY) * t;
        }
      } else {
        this.x = this.baseX;
        this.y = this.baseY;
        carryType = prg >= this.stepTrig - 8 ? this.color : null;
      }

      if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 24, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 260);
      }

      let bob = Math.abs(Math.sin(this.timer * 3)) * 2;
      if (!isMoving) bob = Math.sin(this.timer * 1.5);

      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.lineJoin = "round";
      let legL = 0, legR = 0;
      if (isMoving) {
        const wp = this.timer * 6;
        legL = Math.sin(wp) * 5;
        legR = Math.sin(wp + Math.PI) * 5;
      }
      drawPolyRound(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
      drawPolyRound(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
      drawPolyRound(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
      drawPolyRound(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);
      drawPolyRound(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);
      const hx = 0, hy = -28 - bob;
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
      ctx.beginPath();
      ctx.arc(hx + 4, hy - 2, 4, 0, Math.PI * 2);
      ctx.fill();
      ctx.beginPath();
      ctx.arc(hx - 4, hy - 2, 4, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = C.outline;
      ctx.beginPath();
      ctx.arc(hx + 5, hy - 2, 2, 0, Math.PI * 2);
      ctx.fill();
      ctx.beginPath();
      ctx.arc(hx - 3, hy - 2, 2, 0, Math.PI * 2);
      ctx.fill();
      if (this.role === "1_architect") {
        ctx.strokeStyle = C.outline;
        ctx.lineWidth = 1;
        ctx.strokeRect(hx + 1, hy - 5, 6, 6);
        ctx.strokeRect(hx - 7, hy - 5, 6, 6);
      } else if (this.role === "2_seo") {
        drawPolyRound(ctx, hx - 12, hy - 14, 24, 8, [6, 6, 0, 0], C.outline, null);
      } else if (this.role === "3_coder") {
        ctx.fillStyle = C.outline;
        ctx.fillRect(hx - 8, hy - 10, 16, 10);
      } else if (this.role === "4_designer") {
        drawPolyRound(ctx, hx - 14, hy - 12, 28, 6, 3, "#f43f5e", C.outline);
      } else if (this.role === "5_deployer") {
        ctx.strokeStyle = C.outline;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(hx, hy, 14, Math.PI, Math.PI * 2);
        ctx.stroke();
      }
      ctx.restore();
      if (carryType) drawPolyRound(ctx, -18 * faceDir, -18 - bob, 14, 14, 2, carryType, C.outline);
      ctx.restore();
    }
  }

  const entities = [];
  const bubbles = [];
  const hub = new IntakeCommandBoard(20, -90);
  entities.push(new AmbientPulse());
  entities.push(new OrbitalLeadStream());
  entities.push(hub);
  entities.push(new Agent(-260, 80, C.agentYellow, "1_architect", 18, ["Какие поля обязательны?", "Схема формы готова", "Маска телефона"], 70, 10));
  entities.push(new Agent(-180, -60, C.agentGreen, "2_seo", 62, ["UTM из рекламы", "Интент: коммерция", "Гео в запросе"], 95, -25));
  entities.push(new Agent(-40, 100, C.agentBlue, "3_coder", 102, ["Webhook в CRM", "Валидация e-mail", "Антидубль лида"], 110, 35));
  entities.push(new Agent(120, -40, C.agentPink, "4_designer", 142, ["Форма на мобиле", "Кнопка заметнее", "Меньше полей"], 125, -5));
  entities.push(new Agent(200, 70, C.agentPurple, "5_deployer", 182, ["Алерт в Telegram", "Слот менеджера", "Лог в CRM"], 140, 25));

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
    entities.forEach((e) => e.draw(ctx));

    const prg = (frame * 0.04) % CYCLE;
    if (prg >= 12 && prg < 12.08) createBubble(-200, 40, "Заявка с лендинга");
    if (prg >= 78 && prg < 78.08) createBubble(50, -60, "AI: горячий лид");
    if (prg >= 138 && prg < 138.08) createBubble(120, 50, "Назначен менеджеру");
    if (prg >= 198 && prg < 198.08) createBubble(30, -130, "Клиенту: «Приняли»");
    if (prg >= 222 && prg < 222.08) createBubble(80, 20, "В CRM без потерь");

    ctx.font = "bold 11px Inter, sans-serif";
    ctx.textAlign = "center";
    for (let i = bubbles.length - 1; i >= 0; i--) {
      const bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) {
        bubbles.splice(i, 1);
        continue;
      }
      let alpha = Math.min(1, bub.life / 30);
      if (bub.life > bub.maxLife - 10) alpha = (bub.maxLife - bub.life) / 10;
      ctx.globalAlpha = alpha;
      const tw = ctx.measureText(bub.text).width + 16;
      const th = 20;
      const bx = bub.x;
      const by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawPolyRound(ctx, bx - tw / 2, by - th, tw, th, 6, C.bubbleBg, C.outline);
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

<section class="nero-ai-section nero-ai-section-tight ai-obrabotka-intro" aria-label="Введение">
  <div class="nero-ai-container">
    <div class="ai-obrabotka-intro-grid nero-ai-reveal">
      <div class="ai-obrabotka-intro-copy">
        <p class="nero-ai-eyebrow">Лонгрид · внедрение под ключ</p>
        <p class="ai-obrabotka-intro-lead"></p>
        <p class="ai-obrabotka-intro-sub">Ниже — метрики FRT, стек CRM + Make/n8n, кейсы, цены и чеклист запуска без потери лидов ночью и в выходные.</p>
      </div>
      <aside class="ai-obrabotka-intro-terminal nero-ai-card" aria-label="Схема обработки заявки">
        <div class="ai-obrabotka-terminal-top"><span></span><span></span><span></span> intake@nero</div>
        <ul class="ai-obrabotka-terminal-lines">
          <li><code>POST</code> /webhook/form → <strong>CRM</strong></li>
          <li><code>LLM</code> classify + score → <strong>поля сделки</strong></li>
          <li><code>SLA</code> FRT <strong>5–15 сек</strong></li>
          <li><code>ESCALATE</code> score &gt; 70 → <strong>менеджер</strong></li>
        </ul>
        <div class="ai-obrabotka-intro-chips">
          <span>24/7</span><span>RAG</span><span>amoCRM</span><span>Битрикс24</span>
        </div>
      </aside>
    </div>
    <nav class="nero-ai-toc-wrap nero-ai-reveal" aria-label="Оглавление">
      <div class="nero-ai-toc">
        <a href="#почему-заявки-с-сайта-остывают-и-сколько-лидов-теряет-бизнес-без-мгновенного-отв">Почему заявки с сайта «остывают» и сколько лидов теряет бизнес без мгновенного ответа</a><a href="#что-такое-ai-агент-для-первичной-обработки-заявок-с-сайта">Что такое AI-агент для первичной обработки заявок с сайта</a><a href="#как-работает-сценарий-от-заявки-до-горячего-лида-в-crm-за-515-секунд">Как работает сценарий: от заявки до горячего лида в CRM за 5–15 секунд</a><a href="#внедрение-ai-обработки-заявок-под-ключ-этапы-сроки-и-состав-работ">Внедрение AI-обработки заявок под ключ: этапы, сроки и состав работ</a><a href="#интеграция-с-crm-и-стеком-amocrm-битрикс24-make-n8n">Интеграция с CRM и стеком: amoCRM, Битрикс24, Make, n8n</a><a href="#для-кого-подходит-малый-и-средний-бизнес-услуги-школы-клиники">Для кого подходит: малый и средний бизнес, услуги, школы, клиники</a><a href="#кейсы-и-примеры-внедрения-ai-обработки-заявок">Кейсы и примеры внедрения AI-обработки заявок</a><a href="#сколько-стоит-ai-обработка-заявок-ориентиры-чека-и-tco">Сколько стоит AI-обработка заявок: ориентиры чека и TCO</a><a href="#риски-персональные-данные-и-контроль-качества-ответов-ai">Риски, персональные данные и контроль качества ответов AI</a><a href="#что-проверить-перед-запуском">Что проверить перед запуском</a>
      </div>
    </nav>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="почему-заявки-с-сайта-остывают-и-сколько-лидов-теряет-бизнес-без-мгновенного-отв" aria-labelledby="почему-заявки-с-сайта-остывают-и-сколько-лидов-теряет-бизнес-без-мгновенного-отв-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="почему-заявки-с-сайта-остывают-и-сколько-лидов-теряет-бизнес-без-мгновенного-отв-title">Почему заявки с сайта «остывают» и сколько лидов теряет бизнес без мгновенного ответа</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Определение:</strong> «Остывший лид» — заявка, по которой клиент не получил осмысленный первый контакт в срок, когда он ещё готов к диалогу. Для B2B и услуг этот срок часто измеряется <strong>минутами</strong>, а не часами.</p>
<p>Классическое исследование MIT / InsideSales (цитируется в российских разборах на <a href="https://textback.ru/kak_ne_teryat_goryachie_lidy/" target="_blank" rel="noopener noreferrer">Textback</a> и <a href="https://habr.com/ru/articles/1041312/" target="_blank" rel="noopener noreferrer">Habr</a>) показывает: ответ в <strong>5 минут</strong> против <strong>30 минут</strong> может дать до <strong>21×</strong> разницы в вероятности квалификации лида. Агрегатор <a href="https://gitnux.org/lead-response-time-statistics/" target="_blank" rel="noopener noreferrer">Gitnux</a> по данным исследования ~7 млн лидов указывает средний B2B lead response около <strong>42 часов</strong> и рост доли квалифицированных лидов на <strong>+391%</strong>, если ответить за <strong>1 минуту</strong> вместо часа.</p>
<p>По данным Drift (пересказ на Habr), <strong>55%</strong> B2B-компаний не отвечают на входящие в течение <strong>пяти рабочих дней</strong>. Исследование Harvard Business Review (там же) связывает с конкуренцией за сделку формулировку: <strong>35–50%</strong> покупателей отдают предпочтение тому, кто ответил <strong>первым</strong>.</p>
<p>В российском контексте боль подтверждает аналитика обращений: по пересказу данных Callibri на <a href="https://vc.ru/guryev_pro_ai/2327951-skorost-otveta-na-zaprosy-klientov-v-b2b-i-b2c" target="_blank" rel="noopener noreferrer">vc.ru</a> — более <strong>16%</strong> звонков остаются без ответа, около <strong>каждого третьего</strong> чата без ответа (на выборке 423 тыс. обращений за год). Это не абстрактный «тренд на AI», а измеримая <strong>стоимость потерянного лида</strong>.</p>
<h3>Ночные и выходные заявки: типичные потери по воронке</h3>
<p>Заявки, пришедшие после 19:00 или в субботу, часто попадают в CRM как «Иван, заявка с сайта» без бюджета, услуги и срочности. Менеджер видит карточку утром понедельника — клиент уже сравнил трёх конкурентов. <strong>Обработка заявок ночью</strong> без автоматизации почти всегда означает провал SLA первого контакта.</p>
<p><strong>Итог по блоку:</strong> скорость ответа на заявку — не косметика, а рычаг конверсии. AI-обработка заявок с сайта закрывает разрыв между «форма отправлена» и «менеджер в курсе».</p>
<h3>SLA ответа: от чего зависит конверсия формы и чата</h3>
<p><strong>SLA (Service Level Agreement) первого ответа</strong> — обещанное время до первого осмысленного контакта. Для формы на лендинге разумный ориентир в 2026 году: <strong>до 1 минуты</strong> на подтверждение и 1–2 уточняющих вопроса; для чата — <strong>5–15 секунд</strong> до первой реплики агента (оффер из коммерческой модели Nero Network согласован с практикой рынка «ответ за 30 секунд / 24×7» у интеграторов).</p>
<p>Метрики, которые стоит завести до внедрения:</p>
<div class="nero-ai-table-wrap"><table class="nero-ai-table"><tr><th>Метрика</th><th>Что измеряет</th></tr><tr><td><strong>FRT</strong> (First Response Time)</td><td>Время до первого ответа клиенту</td></tr><tr><td><strong>Lead response time</strong></td><td>Время до контакта от отдела продаж</td></tr><tr><td><strong>% заявок в SLA</strong></td><td>Доля обращений, уложившихся в норматив</td></tr><tr><td><strong>Конверсия заявка → созвон</strong></td><td>Доля лидов, дошедших до звонка</td></tr></table></div>
<p><strong>Чеклист «тайный покупатель»:</strong> оставьте тестовую заявку на своём сайте и засеките FRT фактический — рекомендация из практики, описанной на Habr; без замера невозможно обосновать <strong>аудит потерь заявок</strong>.</p>
<!-- artur:cta-primary-mid -->
<aside class="nero-ai-card nero-ai-inline-cta" role="complementary" aria-label="Получить AI-аудит">
  <p><strong>Заявки остывают быстрее, чем менеджер успевает открыть CRM.</strong> За 30 минут посчитаем фактический FRT, ночные потери и пустые поля воронки — без обязательств по внедрению.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="https://t.me/gorbachevzd" target="_blank" rel="noopener noreferrer">Получить AI-аудит</a>
  </div>
</aside>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="что-такое-ai-агент-для-первичной-обработки-заявок-с-сайта" aria-labelledby="что-такое-ai-агент-для-первичной-обработки-заявок-с-сайта-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="что-такое-ai-агент-для-первичной-обработки-заявок-с-сайта-title">Что такое AI-агент для первичной обработки заявок с сайта</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Определение:</strong> <strong>AI-агент для сайта</strong> (в контексте лидов) — автономный слой на LLM + оркестрации (Make, n8n, Albato) и CRM, который <strong>выполняет действия</strong>: создаёт/обновляет сделку, ставит задачу, отправляет сообщение, а не только генерирует текст.</p>
<p>По прогнозу <a href="https://www.gartner.com/en/newsroom/press-releases/2025-03-05-gartner-predicts-agentic-ai-will-autonomously-resolve-80-percent-of-common-customer-service-issues-without-human-intervention-by-20290" target="_blank" rel="noopener noreferrer">Gartner от 5 марта 2025</a>, к <strong>2029</strong> agentic AI сможет автономно закрывать <strong>до 80% типовых</strong> обращений в клиентском сервисе; для первички с сайта это подмножество сценариев плюс эскалация на сделки. Важно: Gartner в <a href="https://www.gartner.com/en/newsroom/press-releases/2026-02-03-gartner-predicts-half-of-companies-that-cut-customer-service-staff-due-to-ai-will-rehire-by-2027" target="_blank" rel="noopener noreferrer">релизе февраля 2026</a> предупреждает — <strong>50%</strong> компаний, сокративших штат CS из‑за AI, к <strong>2027</strong> могут <strong>нанять обратно</strong>. Вывод для бизнеса: агент — <strong>ассистент SDR</strong>, не замена отдела продаж.</p>
<p>Архитектура, близкая к российскому рынку, разобрана в материале студии «ТЕРМОС» на <a href="https://www.sostav.ru/blogs/285440/77127" target="_blank" rel="noopener noreferrer">Sostav.ru</a>: unified messaging (сайт, WhatsApp, Telegram), Make как цикл оркестрации, LLM-классификация интентов, NER в CRM, lead scoring, RAG против галлюцинаций. В публичном кейсе заявлено до <strong>75%</strong> первичных обращений у крупного застройщика — используйте как <strong>иллюстрацию архитектуры</strong>, не как гарантированный аудит без названия заказчика.</p>
<h3>Чем агент отличается от скриптового чат-бота и от «просто ChatGPT»</h3>
<div class="nero-ai-table-wrap"><table class="nero-ai-table"><tr><th></th><th>Скриптовый чат-бот</th><th>«Голый» ChatGPT в виджете</th><th>AI-агент + CRM</th></tr><tr><td>Логика</td><td>Дерево кнопок</td><td>Свободный диалог</td><td>Intent + скоринг + действия</td></tr><tr><td>CRM</td><td>Ручной перенос</td><td>Ручной перенос</td><td>Автозаполнение полей</td></tr><tr><td>ПДн</td><td>Зависит от хостинга</td><td>Риск трансграничной передачи</td><td>152-ФЗ, локальные LLM</td></tr><tr><td>Эскалация</td><td>«Позвоните в офис»</td><td>Непредсказуемо</td><td>Порог score + оператор</td></tr></table></div>
<p><strong>Нейросеть для обработки лидов</strong> в продуктовом смысле — это связка <strong>промпт-классификатор + JSON-схема + webhook</strong>, как в инструкционных схемах YandexGPT → API amoCRM / Битрикс24 (<a href="https://radiotochki.net/blog/ai/yandexgpt-v-bitriks24-i-amocrm-revolyuciya-v-obrabotke-zayavok-ili-kak-ii-sam-sozdaet-lidy-iz-pisem-i-chatov.html" target="_blank" rel="noopener noreferrer">обзор на radiotochki.net</a>).</p>
<h3>Какие каналы закрывает: форма, виджет, мессенджеры</h3>
<p>Типовой стек <strong>автоматизации обработки заявок с сайта</strong>:</p>
<ul class="nero-ai-prose-list">
<li>форма WordPress / Tilda / Bitrix-лендинг → POST webhook;</li>
<li>виджет чата (Jivo и аналоги);</li>
<li>Telegram / VK / MAX;</li>
<li>коллтрекинг (Sipuni, Calltouch, UIS) — как триггер «пропущенный → задача в CRM».</li>
</ul>
<p><strong>Коротко:</strong> один оркестратор (n8n / Make) собирает каналы в <strong>единую воронку</strong>, чтобы не терять лиды между мессенджером и формой.</p>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="как-работает-сценарий-от-заявки-до-горячего-лида-в-crm-за-515-секунд" aria-labelledby="как-работает-сценарий-от-заявки-до-горячего-лида-в-crm-за-515-секунд-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="как-работает-сценарий-от-заявки-до-горячего-лида-в-crm-за-515-секунд-title">Как работает сценарий: от заявки до горячего лида в CRM за 5–15 секунд</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Схема потока данных:</strong></p>
<pre class="nero-ai-code"><code>Сайт (форма/чат) → Webhook → Дедуп в CRM → LLM (JSON) → Сделка + теги
                              ↓
                    Ответ клиенту (5–15 сек)
                              ↓
              Score &gt; порога → задача менеджеру + summary</code></pre>
<p>Пошагово (модель Nero Network, согласована с blueprint <a href="https://thinkbot.agency/blog/machine-learning-for-business-productivity-n8n-lead-to-customer-crm-enrichment-intent-scoring-ai-triage-workflow-blueprint" target="_blank" rel="noopener noreferrer">ThinkBot Agency для n8n</a>):</p>
<ol class="nero-ai-prose-list">
<li>1. <strong>POST webhook</strong> с полями формы, UTM, `referrer`.</li>
<li>2. <strong>Дедупликация</strong> по телефону/email в amoCRM или Битрикс24.</li>
<li>3. <strong>LLM → JSON:</strong> `{intent, budget, urgency, service, spam_flag}`.</li>
<li>4. Создание или обновление сделки, теги, ответственный по правилам.</li>
<li>5. <strong>Мгновенное сообщение</strong> клиенту (виджет, Telegram, SMS).</li>
<li>6. <strong>Эскалация</strong> при низкой уверенности модели или запросе «живой менеджер».</li>
</ol>
<p>Кейс METASAPIENS (<a href="https://metasapiens.ru/blog/ai-agenty-v-crm-kak-cifrovoj-sotrudnik-zakryvaet-sdelki" target="_blank" rel="noopener noreferrer">блог</a>): webhook с сайта → AI → сделка с полями (бюджет, услуга, срочность) → первое сообщение → задача «позвонить за 2 часа». Боль «<strong>15–20 минут</strong> ручной квалификации на заявку» снимается на первом касании.</p>
<h3>Уточняющие вопросы и квалификация перед передачей менеджеру</h3>
<p><strong>AI-квалификация лидов</strong> — не опрос ради опроса. Типовой скрипт (5–7 вопросов): услуга, срок, бюджет/объём, гео, контакт для связи. Ответы пишутся в поля воронки; менеджер видит <strong>summary</strong>, а не сырой комментарий из формы.</p>
<p>На Западе conversational intake на demo-request формах набирает обороты: vendor-benchmark <a href="https://getperspective.ai/blog/ai-b2b-sales-funnels-78-percent-adoption-2026-pipeline-benchmark" target="_blank" rel="noopener noreferrer">Perspective AI</a> (n=412 SaaS, Q4 2025–Q1 2026) заявляет <strong>78%</strong> воронок с conversational layer против 22% в 2024 и медианный lift demo-request <strong>4,1×</strong>. Цифры — <strong>ориентир вендора</strong>, не норма для РФ; адаптация — виджет на лендинге + Telegram.</p>
<h3>Эскалация на человека: когда и как</h3>
<p>Эскалация обязательна, если:</p>
<ul class="nero-ai-prose-list">
<li>score квалификации выше порога (например, <strong>&gt;80</strong> — звонок за 15 минут);</li>
<li>клиент явно просит оператора;</li>
<li>модель не уверена (низкий confidence);</li>
<li>тема вне базы знаний (медицина, юридические обещания).</li>
</ul>
<p><strong>Human-in-the-loop:</strong> сделки с низким score уходят в nurture; горячие — в очередь менеджера с готовым контекстом. Так описан гибрид в экспертных материалах (<a href="https://admin24.ru/blog/ai-agenty-v-podderzhke-kak-vnedrit-i-nichego-ne-slomat" target="_blank" rel="noopener noreferrer">admin24.ru</a>: внедрять <strong>поэтапно</strong>, начиная с task-level агентов.</p>
    </div>
  </div>
</section>
<!-- boris:visual-block -->
<section id="boris-article-viz" class="boris-article-viz" aria-labelledby="boris-viz-title">
<style>
#boris-article-viz {
  --boris-bg: #f8fafc;
  --boris-card: #ffffff;
  --boris-border: rgba(15, 23, 42, 0.08);
  --boris-text: #0f172a;
  --boris-muted: #64748b;
  --boris-accent: #2563eb;
  --boris-green: #059669;
  --boris-violet: #7c3aed;
  margin: 2.5rem 0 3rem;
  font-family: Inter, system-ui, -apple-system, sans-serif;
}
#boris-article-viz .boris-viz-shell {
  background: var(--boris-bg);
  border: 1px solid var(--boris-border);
  border-radius: 22px;
  box-shadow: 0 18px 48px rgba(15, 23, 42, 0.06);
  padding: clamp(1.25rem, 3vw, 2.5rem);
}
#boris-article-viz .boris-viz-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 1.5rem;
  align-items: center;
}
@media (min-width: 1024px) {
  #boris-article-viz .boris-viz-grid {
    grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr);
    gap: 2rem;
  }
}
#boris-article-viz .boris-eyebrow {
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--boris-accent);
  margin: 0 0 0.5rem;
}
#boris-article-viz .boris-kicker {
  font-size: clamp(1.15rem, 2.2vw, 1.45rem);
  font-weight: 700;
  line-height: 1.25;
  color: var(--boris-text);
  margin: 0 0 0.75rem;
}
#boris-article-viz .boris-lead {
  font-size: 0.95rem;
  line-height: 1.55;
  color: var(--boris-muted);
  margin: 0 0 1.25rem;
  max-width: 36em;
}
#boris-article-viz .boris-stats {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin: 0 0 1rem;
  list-style: none;
  padding: 0;
}
#boris-article-viz .boris-stat {
  background: var(--boris-card);
  border: 1px solid var(--boris-border);
  border-radius: 999px;
  padding: 0.35rem 0.85rem;
  font-size: 12px;
  color: var(--boris-text);
}
#boris-article-viz .boris-stat strong {
  color: var(--boris-green);
  font-weight: 700;
}
#boris-article-viz .boris-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 0.4rem;
  margin: 0 0 1rem;
}
#boris-article-viz .boris-pill {
  font-size: 11px;
  padding: 0.25rem 0.65rem;
  border-radius: 6px;
  background: #eff6ff;
  color: #1d4ed8;
  border: 1px solid #bfdbfe;
}
#boris-article-viz .boris-bridge {
  font-size: 0.875rem;
  color: var(--boris-muted);
  margin: 0;
  border-left: 3px solid var(--boris-accent);
  padding-left: 0.75rem;
}
#boris-article-viz .boris-canvas-wrap {
  position: relative;
  background: var(--boris-card);
  border: 1px solid var(--boris-border);
  border-radius: 20px;
  min-height: 380px;
  max-height: 70vh;
  height: clamp(380px, 42vw, 520px);
  overflow: hidden;
}
#boris-article-viz #boris-lead-crm-flow-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
#boris-article-viz .boris-live {
  position: absolute;
  top: 12px;
  right: 12px;
  font-size: 10px;
  font-weight: 600;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--boris-green);
  background: #ecfdf5;
  border: 1px solid #a7f3d0;
  border-radius: 999px;
  padding: 0.2rem 0.55rem;
  display: flex;
  align-items: center;
  gap: 0.35rem;
  pointer-events: none;
}
#boris-article-viz .boris-live::before {
  content: "";
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--boris-green);
  animation: boris-pulse-dot 1.4s ease-in-out infinite;
}
@keyframes boris-pulse-dot {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.45; transform: scale(0.85); }
}
@media (prefers-reduced-motion: reduce) {
  #boris-article-viz .boris-live::before { animation: none; }
}
</style>

<div class="boris-viz-shell ym-container">
  <div class="boris-viz-grid">
    <div class="boris-viz-copy">
      <p class="boris-eyebrow">Маршрут заявки</p>
      <h3 id="boris-viz-title" class="boris-kicker">От формы на сайте до карточки в CRM — без ручного копирования</h3>
      <p class="boris-lead">Схема показывает, как AI-классификатор разбирает поля заявки, назначает сегмент и создаёт задачу менеджеру только когда нужен человек.</p>
      <ul class="boris-stats" aria-hidden="true">
        <li class="boris-stat"><strong>&lt; 30 с</strong> до CRM</li>
        <li class="boris-stat"><strong>4</strong> узла потока</li>
        <li class="boris-stat">эскалация по правилам</li>
      </ul>
      <div class="boris-pills" aria-hidden="true">
        <span class="boris-pill">Webhook</span>
        <span class="boris-pill">Скоринг</span>
        <span class="boris-pill">Bitrix24 / amo</span>
        <span class="boris-pill">HITL</span>
      </div>
      <p class="boris-bridge">Дальше разберём, какие поля формы и триггеры CRM задают на этапе внедрения.</p>
    </div>
    <div class="boris-canvas-wrap" role="img" aria-label="Анимация: заявка с сайта проходит AI-маршрутизацию в CRM и уведомление менеджеру">
      <span class="boris-live">live-поток</span>
      <canvas id="boris-lead-crm-flow-canvas" width="640" height="480"></canvas>
    </div>
  </div>
</div>

<script>
(function borisLeadCrmFlowEngine() {
  const canvas = document.getElementById("boris-lead-crm-flow-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");
  const reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const COLORS = {
    outline: "#0f172a",
    line: "#94a3b8",
    lineActive: "#2563eb",
    nodeBg: "#ffffff",
    nodeShadow: "rgba(15,23,42,0.06)",
    site: "#dbeafe",
    ai: "#ede9fe",
    crm: "#d1fae5",
    mgr: "#fef3c7",
    packet: "#2563eb",
    packetHot: "#7c3aed",
    text: "#0f172a",
    sub: "#64748b",
    badge: "#059669"
  };

  const NODES = [
    { id: "site", label: "Сайт", sub: "форма", color: COLORS.site, icon: "form" },
    { id: "ai", label: "AI", sub: "скоринг", color: COLORS.ai, icon: "chip" },
    { id: "crm", label: "CRM", sub: "карточка", color: COLORS.crm, icon: "card" },
    { id: "mgr", label: "Менеджер", sub: "эскалация", color: COLORS.mgr, icon: "bell" }
  ];

  let cw = 0, ch = 0, scale = 1, frame = 0;
  let positions = [];
  let packets = [];

  function resize() {
    const parent = canvas.parentElement;
    if (!parent) return;
    const dpr = Math.min(window.devicePixelRatio || 1, 2);
    cw = parent.clientWidth;
    ch = parent.clientHeight;
    canvas.width = Math.floor(cw * dpr);
    canvas.height = Math.floor(ch * dpr);
    canvas.style.width = cw + "px";
    canvas.style.height = ch + "px";
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    scale = cw < 420 ? cw / 360 : Math.min(cw / 520, 1.15);
    layoutNodes();
  }

  function layoutNodes() {
    const padX = 28 * scale;
    const midY = ch * 0.52;
    const usable = cw - padX * 2;
    const step = usable / (NODES.length - 1);
    positions = NODES.map((n, i) => ({
      ...n,
      x: padX + step * i,
      y: midY,
      r: 36 * scale
    }));
  }

  function spawnPacket() {
    packets.push({
      seg: 0,
      t: 0,
      speed: reduced ? 0.012 : 0.018 + Math.random() * 0.008,
      hot: Math.random() > 0.72,
      label: ["лид", "заявка", "демо"][Math.floor(Math.random() * 3)]
    });
    if (packets.length > 5) packets.shift();
  }

  function roundRect(x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else { ctx.moveTo(x + r, y); ctx.arcTo(x + w, y, x + w, y + h, r); ctx.arcTo(x + w, y + h, x, y + h, r); ctx.arcTo(x, y + h, x, y, r); ctx.arcTo(x, y, x + w, y, r); ctx.closePath(); }
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function drawIcon(node, x, y, size) {
    ctx.save();
    ctx.translate(x, y);
    ctx.strokeStyle = COLORS.outline;
    ctx.lineWidth = 1.8;
    ctx.fillStyle = "#fff";
    const s = size * 0.55;
    if (node.icon === "form") {
      roundRect(-s, -s * 0.7, s * 2, s * 1.4, 4, "#fff", COLORS.outline);
      ctx.beginPath();
      ctx.moveTo(-s * 0.6, -s * 0.2); ctx.lineTo(s * 0.6, -s * 0.2);
      ctx.moveTo(-s * 0.6, s * 0.15); ctx.lineTo(s * 0.3, s * 0.15);
      ctx.stroke();
    } else if (node.icon === "chip") {
      roundRect(-s, -s, s * 2, s * 2, 6, "#fff", COLORS.outline);
      ctx.fillStyle = COLORS.lineActive;
      for (let i = -1; i <= 1; i++) for (let j = -1; j <= 1; j++) {
        ctx.fillRect(i * s * 0.35 - 3, j * s * 0.35 - 3, 6, 6);
      }
    } else if (node.icon === "card") {
      roundRect(-s, -s * 0.65, s * 2, s * 1.3, 5, "#fff", COLORS.outline);
      ctx.fillStyle = COLORS.badge;
      roundRect(-s * 0.7, -s * 0.35, s * 0.9, s * 0.35, 2, COLORS.badge, null);
    } else {
      ctx.beginPath();
      ctx.arc(0, -s * 0.15, s * 0.55, Math.PI, 0);
      ctx.lineTo(s * 0.55, s * 0.5);
      ctx.lineTo(-s * 0.55, s * 0.5);
      ctx.closePath();
      ctx.fill();
      ctx.stroke();
      ctx.beginPath();
      ctx.arc(0, s * 0.65, s * 0.2, 0, Math.PI * 2);
      ctx.fill();
      ctx.stroke();
    }
    ctx.restore();
  }

  function drawNode(p, active) {
    const w = p.r * 2.1;
    const h = p.r * 1.55;
    const nx = p.x - w / 2;
    const ny = p.y - h / 2;
    ctx.save();
    if (active) {
      ctx.shadowColor = "rgba(37,99,235,0.25)";
      ctx.shadowBlur = 18;
    }
    roundRect(nx, ny, w, h, 14 * scale, p.color, active ? COLORS.lineActive : COLORS.line);
    ctx.shadowBlur = 0;
    drawIcon(p, p.x, p.y - 8 * scale, p.r);
    ctx.fillStyle = COLORS.text;
    ctx.font = `600 ${12 * scale}px Inter, system-ui, sans-serif`;
    ctx.textAlign = "center";
    ctx.fillText(p.label, p.x, p.y + p.r * 0.55);
    ctx.fillStyle = COLORS.sub;
    ctx.font = `500 ${10 * scale}px Inter, system-ui, sans-serif`;
    ctx.fillText(p.sub, p.x, p.y + p.r * 0.85);
    ctx.restore();
  }

  function drawEdges(activeSeg) {
    for (let i = 0; i < positions.length - 1; i++) {
      const a = positions[i];
      const b = positions[i + 1];
      const active = i === activeSeg;
      ctx.beginPath();
      ctx.moveTo(a.x + a.r * 0.9, a.y);
      ctx.lineTo(b.x - b.r * 0.9, b.y);
      ctx.strokeStyle = active ? COLORS.lineActive : COLORS.line;
      ctx.lineWidth = active ? 2.5 : 1.5;
      if (!reduced && active) {
        ctx.setLineDash([6, 6]);
        ctx.lineDashOffset = -frame * 0.8;
      } else {
        ctx.setLineDash([]);
      }
      ctx.stroke();
      ctx.setLineDash([]);
      const mx = (a.x + b.x) / 2;
      const my = a.y - 18 * scale;
      ctx.fillStyle = active ? COLORS.lineActive : COLORS.sub;
      ctx.beginPath();
      ctx.moveTo(mx, my);
      ctx.lineTo(mx - 5, my + 8);
      ctx.lineTo(mx + 5, my + 8);
      ctx.closePath();
      ctx.fill();
    }
  }

  function drawPacket(pkt) {
    const a = positions[pkt.seg];
    const b = positions[pkt.seg + 1];
    if (!a || !b) return;
    const x = a.x + (b.x - a.x) * pkt.t;
    const y = a.y + Math.sin(pkt.t * Math.PI) * (-22 * scale);
    ctx.save();
    ctx.fillStyle = pkt.hot ? COLORS.packetHot : COLORS.packet;
    ctx.beginPath();
    ctx.arc(x, y, 7 * scale, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#fff";
    ctx.font = `600 ${9 * scale}px Inter, sans-serif`;
    ctx.textAlign = "center";
    ctx.fillText(pkt.label, x, y - 12 * scale);
    ctx.restore();
  }

  function tick() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);

    const bgGrad = ctx.createLinearGradient(0, 0, cw, ch);
    bgGrad.addColorStop(0, "#fafbfc");
    bgGrad.addColorStop(1, "#f1f5f9");
    ctx.fillStyle = bgGrad;
    ctx.fillRect(0, 0, cw, ch);

  if (!reduced && frame % 90 === 0) spawnPacket();

    let activeSeg = 0;
    packets.forEach((p) => {
      if (!reduced) p.t += p.speed;
      if (p.t >= 1) { p.seg++; p.t = 0; }
      if (p.seg < NODES.length - 1) activeSeg = p.seg;
    });
    packets = packets.filter((p) => p.seg < NODES.length - 1);

    drawEdges(activeSeg);
    positions.forEach((p, i) => {
      const lit = i === activeSeg || i === activeSeg + 1;
      drawNode(p, lit);
    });
    packets.forEach(drawPacket);

    if (!reduced) requestAnimationFrame(tick);
  }

  window.addEventListener("resize", resize);
  resize();
  if (reduced) {
    spawnPacket();
    packets[0].t = 0.45;
    packets[0].seg = 1;
    tick();
  } else {
    for (let i = 0; i < 2; i++) { spawnPacket(); packets[i].t = i * 0.35; }
    requestAnimationFrame(tick);
  }
})();
</script>
</section>


<section class="nero-ai-section nero-ai-reveal" id="внедрение-ai-обработки-заявок-под-ключ-этапы-сроки-и-состав-работ" aria-labelledby="внедрение-ai-обработки-заявок-под-ключ-этапы-сроки-и-состав-работ-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="внедрение-ai-обработки-заявок-под-ключ-этапы-сроки-и-состав-работ-title">Внедрение AI-обработки заявок под ключ: этапы, сроки и состав работ</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Внедрение ai обработка заявок под ключ</strong> в модели Nero Network — проект из 4–6 недель на пилот (согласуется с рынком: интеграторы указывают пилоты <strong>от ~150–180 тыс. ₽</strong>, <a href="https://dodigital.ru/aiagent" target="_blank" rel="noopener noreferrer">dodigital.ru</a>, <a href="https://osmi-it.ru/ai-agenty/" target="_blank" rel="noopener noreferrer">osmi-it.ru</a>; стартовый коридор из брифа — <strong>120–350 тыс. ₽</strong> + поддержка).</p>
<div class="nero-ai-table-wrap"><table class="nero-ai-table"><tr><th>Этап</th><th>Содержание</th><th>Срок (ориентир)</th></tr><tr><td>1. Аудит</td><td>Формы, CRM, SLA, поля воронки</td><td>3–5 дней</td></tr><tr><td>2. MVP</td><td>Один источник → n8n/Make → LLM → CRM</td><td>2–3 недели</td></tr><tr><td>3. RAG</td><td>FAQ, прайс, регламенты</td><td>1 неделя</td></tr><tr><td>4. Метрики</td><td>FRT, % полей, конверсия в созвон</td><td>ongoing</td></tr><tr><td>5. Масштаб</td><td>Мессенджеры, RAG, спам-фильтр</td><td>1–2 недели</td></tr></table></div>
<h3>Аудит потерь заявок (лид-магнит 30 минут)</h3>
<p><strong>Аудит потерь заявок</strong> — разбор: сколько заявок приходит вне рабочего времени, какой фактический FRT, сколько карточек CRM пустые, есть ли дубли. CTA страницы: <strong>«Проверить, сколько заявок вы теряете»</strong> — логичное продолжение аудита.</p>
<h3>Обучение на FAQ, прайсе и регламентах (RAG)</h3>
<p><strong>RAG (Retrieval-Augmented Generation)</strong> — ответы только из утверждённых документов. Это главный противовес <strong>галлюцинациям</strong>: агент не «придумывает» цену услуги. База: pgvector или файлы; промпт с запретом ответов вне базы.</p>
<p>Обзор <a href="https://nikta.ai/blog/kak-uskorit-obrabotku-zayavok-polnoe-rukovodstvo-dlya-biznesa-v-20252026-godu" target="_blank" rel="noopener noreferrer">NIKTA AI (апрель 2026)</a> указывает на сокращение цикла обработки заявок на <strong>30–80%</strong> в первые месяцы автоматизации — как ориентир эффекта, не гарантия для каждой ниши.</p>
<!-- artur:cta-secondary -->
<aside class="nero-ai-card nero-ai-inline-cta nero-ai-inline-cta-secondary" role="complementary" aria-label="Посмотреть, что можно автоматизировать">
  <p><strong>Нужен обзор стека до пилота?</strong> Собрали материалы по Make/n8n, CRM и типовым сценариям AI-агентов — чтобы команда понимала логику до старта проекта.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-secondary" href="https://meta-journal.ru/" target="_blank" rel="noopener noreferrer">Посмотреть, что можно автоматизировать</a>
  </div>
</aside>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="интеграция-с-crm-и-стеком-amocrm-битрикс24-make-n8n" aria-labelledby="интеграция-с-crm-и-стеком-amocrm-битрикс24-make-n8n-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="интеграция-с-crm-и-стеком-amocrm-битрикс24-make-n8n-title">Интеграция с CRM и стеком: amoCRM, Битрикс24, Make, n8n</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Интеграция ai обработка заявок с crm</strong> — ядро ценности. Встроенный <a href="https://www.amocrm.ru/ai-agent/" target="_blank" rel="noopener noreferrer">AI-агент amoCRM</a> отвечает в мессенджерах и чатах, квалифицирует, меняет этапы — <strong>минимум кастомной разработки</strong>. Кастом на n8n/Make нужен, когда:</p>
<ul class="nero-ai-prose-list">
<li>несколько сайтов и воронок;</li>
<li>своя логика скоринга и 1С;</li>
<li>нестандартные поля и дедуп между юрлицами.</li>
</ul>
<p><strong>Make n8n ai заявка crm</strong> — типовая связка для МСБ: self-hosted n8n из соображений ПДн + GigaChat / YandexGPT (<a href="https://gptmag.ru/integratsiya-ai-s-1c-amocrm/" target="_blank" rel="noopener noreferrer">обзор стека 2026 на gptmag.ru</a>).</p>
<h3>Поля сделки, теги, ответственный и задачи менеджеру</h3>
<p>Чеклист полей CRM для лонгрида (по METASAPIENS и практике внедрений):</p>
<ul class="nero-ai-prose-list">
<li>услуга / продукт;</li>
<li>бюджет или диапазон;</li>
<li>срочность;</li>
<li>источник и UTM;</li>
<li>score 0–100;</li>
<li>AI-summary (текст для менеджера);</li>
<li>теги: `ai-qualified`, `spam`, `night-lead`.</li>
</ul>
<p>Задача менеджеру: тип «Позвонить», дедлайн из SLA (например, 2 часа для горячего).</p>
<h3>Дедупликация и защита от дублей лидов</h3>
<p>Дедуп по <strong>телефону и email</strong> до создания новой сделки. Иначе один клиент с формы и из Telegram получит двух менеджеров — и конфликт в CRM. Оркестратор делает upsert, а не слепой `lead.add`.</p>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="для-кого-подходит-малый-и-средний-бизнес-услуги-школы-клиники" aria-labelledby="для-кого-подходит-малый-и-средний-бизнес-услуги-школы-клиники-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="для-кого-подходит-малый-и-средний-бизнес-услуги-школы-клиники-title">Для кого подходит: малый и средний бизнес, услуги, школы, клиники</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Ai обработка заявок для малого бизнеса</strong> окупается, когда есть поток заявок с сайта (от 30–50 в месяц) и боль «ночь/выходные». ЦА из брифа: услуги, онлайн-школы, клиники, B2B-услуги.</p>
<h3>Услуги и запись на консультацию</h3>
<p>Агент уточняет тип услуги, город, желаемую дату, передаёт слот в календарь или задачу администратору. <strong>Ai консультант на сайт</strong> здесь — запись и квалификация, не юридическая консультация.</p>
<h3>Онлайн-школы и образовательные продукты</h3>
<p>Сценарии: курс, уровень подготовки, формат оплаты. Важно не обещать скидки вне прайса (контроль промпта). См. отраслевые сценарии на <a href="https://vc.ru/aihub/2842613-ii-agenty-dlya-biznesa-kak-vybrat-i-vnedrit-v-2026-godu" target="_blank" rel="noopener noreferrer">vc.ru/aihub</a>.</p>
<h3>Клиники и медицинские услуги (ограничения по ПДн)</h3>
<p>Медицинские данные — отдельный правовой режим. На первичке агент собирает <strong>запись и симптом-скрининг общего характера</strong> без диагнозов; диагностику и назначения — только врач. Обязательны согласия и политика на <a href="https://vc.ru/legal/1598826-sbor-personalnyh-dannyh-cherez-chat-bot" target="_blank" rel="noopener noreferrer">vc.ru/legal</a>, <a href="https://www.carrotquest.io/blog/personal-data-2025/" target="_blank" rel="noopener noreferrer">Carrot quest</a>.</p>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="кейсы-и-примеры-внедрения-ai-обработки-заявок" aria-labelledby="кейсы-и-примеры-внедрения-ai-обработки-заявок-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="кейсы-и-примеры-внедрения-ai-обработки-заявок-title">Кейсы и примеры внедрения AI-обработки заявок</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Честная оговорка:</strong> публичных кейсов «только сайт + AI + название компании + независимый аудит» мало; чаще — архитектурные разборы и продуктовые страницы CRM.</p>
<div class="nero-ai-table-wrap"><table class="nero-ai-table"><tr><th>Источник</th><th>Что показать на странице</th></tr><tr><td><a href="https://www.sostav.ru/blogs/285440/77127" target="_blank" rel="noopener noreferrer">Sostav / ТЕРМОС</a></td><td>Make + LLM + CRM, RAG</td></tr><tr><td><a href="https://www.amocrm.ru/ai-agent/" target="_blank" rel="noopener noreferrer">amoCRM AI-агент</a></td><td>Коробка vs кастом</td></tr><tr><td><a href="https://metasapiens.ru/blog/ai-agenty-v-crm-kak-cifrovoj-sotrudnik-zakryvaet-sdelki" target="_blank" rel="noopener noreferrer">METASAPIENS</a></td><td>Webhook → поля сделки</td></tr><tr><td><a href="https://getperspective.ai/blog/ai-b2b-sales-funnels-78-percent-adoption-2026-pipeline-benchmark" target="_blank" rel="noopener noreferrer">Perspective AI</a></td><td>Западный conversational intake (vendor)</td></tr></table></div>
<p>Уникальный стандарт Nero Network для <strong>пример внедрения ai обработка заявок</strong>: <strong>«заявка с сайта за 90 секунд в CRM с заполненными полями»</strong> — измеримый результат вместо «мы внедрим AI».</p>
<h3>Метрики до/после: время ответа, доля квалифицированных лидов</h3>
<p>До внедрения зафиксируйте: средний FRT, % пустых карточек, конверсию в созвон. После — те же метрики через 30 дней A/B (старая форма vs AI-интейк). Не публикуйте выдуманные проценты «гарантии роста».</p>
<h3>Ошибки внедрения и как их избежать</h3>
<ul class="nero-ai-prose-list">
<li>Запуск без RAG → галлюцинации и жалобы.</li>
<li>Нет дедупа → хаос в CRM.</li>
<li>Нет эскалации → клиент «застревает» с ботом.</li>
<li>Игнор 152-ФЗ → юридические риски.</li>
<li>Ожидание полной замены продаж → разочарование (см. Gartner 2026 про rehire).</li>
</ul>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="сколько-стоит-ai-обработка-заявок-ориентиры-чека-и-tco" aria-labelledby="сколько-стоит-ai-обработка-заявок-ориентиры-чека-и-tco-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="сколько-стоит-ai-обработка-заявок-ориентиры-чека-и-tco-title">Сколько стоит AI-обработка заявок: ориентиры чека и TCO</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Ai обработка заявок цена</strong> на рынке РФ (2025–2026):</p>
<ul class="nero-ai-prose-list">
<li><strong>Старт под ключ:</strong> ориентир <strong>120–350 тыс. ₽</strong> (бриф Nero Network).</li>
<li><strong>Пилот у интеграторов:</strong> от <strong>~150–180 тыс. ₽</strong>, 4–6 недель (<a href="https://dodigital.ru/aiagent" target="_blank" rel="noopener noreferrer">dodigital.ru</a>).</li>
<li><strong>Поддержка:</strong> доработка промптов, мониторинг диалогов, дообучение RAG.</li>
</ul>
<h3>Что входит в старт и что в поддержку</h3>
<p><strong>Старт:</strong> аудит, один канал, CRM, RAG на FAQ, метрики, обучение менеджеров читать AI-summary.</p>
<p><strong>Поддержка:</strong> новые сценарии, сезонные акции, разбор инцидентов, A/B тесты.</p>
<h3>Сравнение с наймом оператора / колл-центром (качественно)</h3>
<p>Один FTE первой линии — зарплата, налоги, обучение, сменность; ночные смены дороже. AI-менеджер заявок не заменяет переговоры и закрытие сделки, но снимает <strong>первичку 24×7</strong>. Возражение «дорого» закрывается пилотом на одном источнике заявок и замером FRT.</p>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="риски-персональные-данные-и-контроль-качества-ответов-ai" aria-labelledby="риски-персональные-данные-и-контроль-качества-ответов-ai-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="риски-персональные-данные-и-контроль-качества-ответов-ai-title">Риски, персональные данные и контроль качества ответов AI</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Риски:</strong> галлюцинации, утечка ПДн, спам-фильтр режет целевые заявки, зависимость от API LLM.</p>
<p><strong>Контроль качества:</strong></p>
<ul class="nero-ai-prose-list">
<li>логи промптов и ответов;</li>
<li>выборочная модерация диалогов;</li>
<li>запрет юридически значимых обещаний в промпте;</li>
<li>еженедельный разбор «провалов» и дополнение RAG.</li>
</ul>
<p>Gartner (<a href="https://www.gartner.com/en/newsroom/press-releases/2026-03-31-gartner-predicts-over-50-percent-of-customer-service-organizations-will-double-their-technology-spend-by-2028" target="_blank" rel="noopener noreferrer">март 2026</a>): более <strong>50%</strong> CS-организаций <strong>удвоят</strong> IT-затраты к 2028 без пропорционального сокращения людей — закладывайте TCO на стек, а не только на лицензию бота.</p>
<h3>152-ФЗ и согласия на обработку в форме</h3>
<p>Отдельное <strong>согласие</strong> на обработку ПДн (не только галочка «согласен с политикой» без предмета). При необходимости — уведомление в реестр оператора РКН. Хранение ПДн граждан РФ — на серверах в РФ при работе с локальными LLM (GigaChat, YandexGPT). Трансграничная передача в зарубежный API — только после юридической оценки.</p>
<h3>Мониторинг диалогов и доработка базы знаний</h3>
<p>KPI качества: доля эскалаций, NPS первого касания, доля ответов «вне базы». Раз в месяц — ревизия FAQ и прайса в RAG.</p>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="что-проверить-перед-запуском" aria-labelledby="что-проверить-перед-запуском-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="что-проверить-перед-запуском-title">Что проверить перед запуском</h2>
    </header>
    <div class="nero-ai-prose">
<ol class="nero-ai-prose-list">
<li>1. <strong>FRT фактический</strong> — тестовая заявка с сайта.  </li>
<li>2. <strong>Все каналы</strong> в одной CRM.  </li>
<li>3. <strong>Дедупликация</strong> по телефону/email.  </li>
<li>4. <strong>Обязательные поля</strong> воронки заполняет AI.  </li>
<li>5. <strong>Эскалация</strong> и кнопка «оператор».  </li>
<li>6. <strong>RAG</strong> только из утверждённых документов.  </li>
<li>7. <strong>Логи</strong> для разбора инцидентов.  </li>
<li>8. <strong>152-ФЗ:</strong> согласие, политика, РКН при необходимости.  </li>
<li>9. <strong>Хранение ПДн</strong> в РФ.  </li>
<li>10. <strong>Спам-фильтр</strong> без ложных отсечений.  </li>
<li>11. <strong>Мобильная форма</strong> и виджет.  </li>
<li>12. <strong>Нагрузка</strong> на пиках рекламы.  </li>
<li>13. <strong>A/B</strong> 30 дней.  </li>
<li>14. <strong>Обучение менеджеров</strong> читать summary.  </li>
<li>15. <strong>Трансграничная передача</strong> — если LLM за рубежом.</li>
</ol>
<!-- artur:cta-final -->
<div class="nero-ai-final-cta nero-ai-card nero-ai-reveal" role="region" aria-labelledby="nero-ai-final-cta-title">
  <h2 id="nero-ai-final-cta-title">Внедрим AI-обработку заявок с сайта под ключ</h2>
  <p>От аудита потерь до горячей сделки в amoCRM или Битрикс24: ответ за 5–15 секунд, уточняющие вопросы, RAG по вашим FAQ и эскалация на менеджера.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="https://t.me/gorbachevzd" target="_blank" rel="noopener noreferrer">Получить AI-аудит</a>
    <a class="nero-ai-btn nero-ai-btn-secondary" href="https://meta-journal.ru/" target="_blank" rel="noopener noreferrer">Посмотреть, что можно автоматизировать</a>
  </div>
</div>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="faq-ai-obrabotka-zayavok" aria-labelledby="faq-ai-obrabotka-zayavok-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="faq-ai-obrabotka-zayavok-title">FAQ: частые вопросы про AI-обработку заявок с сайта</h2>
    </header>
    <div class="nero-ai-prose">

    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-section-alt" id="faq" aria-labelledby="faq-title">
  <div class="nero-ai-container">
    <header class="nero-ai-section-head">
      <p class="nero-ai-eyebrow">FAQ</p>
      <h2 id="faq-title">Частые вопросы про AI-обработку заявок с сайта</h2>
    </header>
    <div class="nero-ai-faq nero-ai-reveal">
      <details class="nero-ai-reveal"><summary>Что такое ai обработка заявок и чем отличается от обычного чат-бота?</summary><p>Это автоматизация</p></details><details class="nero-ai-reveal"><summary>Как внедрить ai обработка заявок в уже работающий сайт?</summary><p>Через webhook формы или виджет; CRM и n8n/Make подключаются без переписывания всего сайта. MVP — один источник заявок.</p></details><details class="nero-ai-reveal"><summary>Сколько стоит ai обработка заявок для малого бизнеса?</summary><p>Ориентир старта</p></details><details class="nero-ai-reveal"><summary>Какие CRM поддерживаются из коробки?</summary><p>amoCRM (в т.ч. <a href="https://www.amocrm.ru/ai-agent/" target="_blank" rel="noopener noreferrer">встроенный AI-агент</a>), Битрикс24, SberCRM, EnvyCRM — кастомная логика через API и Albato/Apix-Drive.</p></details><details class="nero-ai-reveal"><summary>Заменяет ли AI менеджера полностью?</summary><p>Нет. AI закрывает первичку и SDR-рутину; переговоры, цена и договор — за человеком (<a href="https://www.gartner.com/en/newsroom/press-releases/2026-02-03-gartner-predicts-half-of-companies-that-cut-customer-service-staff-due-to-ai-will-rehire-by-2027" target="_blank" rel="noopener noreferrer">Gartner 2026</a>).</p></details><details class="nero-ai-reveal"><summary>Как быстро агент отвечает на заявку с формы?</summary><p>Целевой коридор</p></details><details class="nero-ai-reveal"><summary>Нужен ли программист для запуска?</summary><p>Пилот под ключ — на стороне интегратора; для поддержки полезен доступ к CRM и оркестратору, не обязательно штатный разработчик.</p></details><details class="nero-ai-reveal"><summary>Как передать горячий лид менеджеру в amoCRM / Битрикс24?</summary><p>Сделка с полями + задача + уведомление; в карточке — AI-summary и score.</p></details><details class="nero-ai-reveal"><summary>Безопасно ли отправлять персональные данные в AI?</summary><p>При соблюдении 152-ФЗ, согласий, хранения в РФ и выборе локальных LLM — да, в рамках оценки юриста. Подробнее: <a href="https://vc.ru/legal/1598826-sbor-personalnyh-dannyh-cherez-chat-bot" target="_blank" rel="noopener noreferrer">vc.ru/legal</a>.</p></details><details class="nero-ai-reveal"><summary>Есть ли примеры внедрения ai обработка заявок в 2026?</summary><p>Архитектурные — <a href="https://www.sostav.ru/blogs/285440/77127" target="_blank" rel="noopener noreferrer">Sostav/ТЕРМОС</a>, продуктовые — amoCRM, METASAPIENS; независимых аудитов с цифрами эффекта мало — опирайтесь на</p></details>
    </div>
  </div>
</section>
</div>

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
    {
      "@type": "Question",
      "name": "Что такое ai обработка заявок и чем отличается от обычного чат-бота?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Автоматизация первичной обработки: квалификация, ответ за секунды, запись в CRM. Чат-бот по кнопкам не заполняет сделку и не скорит лид."
      }
    },
    {
      "@type": "Question",
      "name": "Сколько стоит ai обработка заявок для малого бизнеса?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ориентир старта 120–350 тыс. ₽ под ключ; пилоты на рынке — от ~150–180 тыс. ₽."
      }
    },
    {
      "@type": "Question",
      "name": "Как быстро агент отвечает на заявку с формы?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Целевой коридор 5–15 секунд на первое сообщение; SLA подтверждается замером тайного покупателя."
      }
    }
  ]
}
</script>

<?php
get_footer();


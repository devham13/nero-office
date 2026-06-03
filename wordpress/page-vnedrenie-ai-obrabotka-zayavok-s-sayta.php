<?php
/**
 * Template Name: AI Agent Lead Processing
 * Description: AI-агент для обработки заявок с сайта — внедрение под ключ
 */

$page_seo_title = 'AI-агент для обработки заявок с сайта — внедрение под ключ';
$page_seo_description = 'Внедрим AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, квалификация лида и передача в CRM. Аудит потерь заявок за 30 минут — проверьте, сколько лидов уходит к конкурентам.';

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


/* Page shell + theme reset */
.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs, .yoast-breadcrumb,
.entry-header, .page-title-section { display: none !important; }

#primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}

.vnedrenie-ai-hero-stage {
  position: relative;
  min-height: clamp(360px, 42vw, 520px);
  padding: 0 !important;
  overflow: hidden;
}
.vnedrenie-ai-hero-stage canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}

.ym-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

/* Intro after hero */
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro {
  padding: clamp(48px, 6vw, 72px) 0 clamp(28px, 4vw, 40px);
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__grid {
  display: grid;
  grid-template-columns: minmax(0, 1.15fr) minmax(280px, 0.85fr);
  gap: clamp(24px, 4vw, 40px);
  align-items: start;
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__text {
  text-align: left !important;
  border-left: 4px solid var(--nero-ai-primary);
  padding-left: clamp(18px, 3vw, 28px);
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__text p {
  text-align: left !important;
  margin: 0 0 16px;
  font-size: clamp(16px, 1.6vw, 18px);
  line-height: 1.65;
  color: var(--nero-ai-soft) !important;
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__text p:last-child { margin-bottom: 0; }
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__lead {
  font-size: clamp(17px, 1.8vw, 20px) !important;
  color: var(--nero-ai-heading) !important;
  font-weight: 650;
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__terminal {
  padding: 18px;
  border-radius: 20px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.10);
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__terminal-head {
  display: flex;
  gap: 6px;
  margin-bottom: 14px;
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__terminal-head span {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(255,255,255,.22);
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__terminal-head span:nth-child(1) { background: #fb7185; }
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__terminal-head span:nth-child(2) { background: #fbbf24; }
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__terminal-head span:nth-child(3) { background: #34d399; }
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 14px;
  padding: 0;
  list-style: none;
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__chips li {
  padding: 7px 11px;
  border-radius: 999px;
  border: 1px solid rgba(121,242,255,.22);
  background: rgba(121,242,255,.08);
  color: var(--nero-ai-primary) !important;
  font-size: 12px;
  font-weight: 700;
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__metric {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__metric div {
  padding: 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.08);
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__metric strong {
  display: block;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__metric span {
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
  .vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__grid { grid-template-columns: 1fr; }
  .nero-ai-split { grid-template-columns: 1fr; }
}

</style>

<main id="primary" class="site-main vnedrenie-ai-obrabotka-zayavok-s-sayta-page nero-ai-home-page" role="main" tabindex="-1">
<section class="nero-ai-hero" id="lead-flow-dispatch" aria-labelledby="vnedrenie-ai-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow">AI-агент · обработка заявок с сайта</p>
      <h1 id="vnedrenie-ai-hero-title">AI-агент для обработки заявок с сайта: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI отвечает за 5–15 секунд, квалифицирует лид и передаёт его в CRM — пока менеджеры спят, заявки не остывают</p>
      <ul class="nero-ai-badges" aria-label="Этапы обработки заявок">
        <li class="nero-ai-badge">Заявка с сайта</li>
        <li class="nero-ai-badge">Ответ 5–15 сек</li>
        <li class="nero-ai-badge">Квалификация</li>
        <li class="nero-ai-badge">Карточка в CRM</li>
        <li class="nero-ai-badge">Задача менеджеру</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="#final-cta-audit-title">Проверить, сколько заявок вы теряете</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демонстрация потока заявок">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">ночной поток лидов · демо</span>
        </div>
        <div class="nero-ai-window-body vnedrenie-ai-hero-stage">
          <canvas id="vnedrenie-ai-zayavki-hero-canvas" aria-hidden="true"></canvas>
        </div>
      </div>
    </div>
  </div>
</section>

<script id="vnedrenie-ai-zayavki-hero-engine">
document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById("vnedrenie-ai-zayavki-hero-canvas");
    if (!canvas) return;
    const ctx = canvas.getContext("2d");

    let cw = 0, ch = 0, scale = 1;
    let cx = 0, cy = 0;
    let frame = 0;

    function resizeCanvas() {
        if (!canvas.parentElement) return;
        canvas.width = canvas.parentElement.clientWidth || window.innerWidth;
        canvas.height = canvas.parentElement.clientHeight || window.innerHeight;
        cw = canvas.width;
        ch = canvas.height;
        cx = cw / 2 + 80;
        cy = ch / 2 - 20;
        scale = cw < 768 ? cw / 620 : Math.min(cw / 1100, ch / 780) * 1.35;
    }
    window.addEventListener("resize", resizeCanvas);
    resizeCanvas();

    const C = {
        outline: "#79f2ff",
        softIndigo: "#79f2ff",
        softOrange: "#f59e0b",
        hotGreen: "#22c55e",
        cardBg: "rgba(17, 24, 39, 0.92)",
        fieldMuted: "rgba(255,255,255,0.10)",
        orbCore: "#6366f1",
        orbGlow: "rgba(121, 242, 255, 0.22)",
        streamDot: "#a5b4fc",
        envelope: "rgba(245, 158, 11, 0.35)",
        bubbleBg: "rgba(11, 16, 32, 0.96)",
        crmCol: "rgba(255,255,255,0.06)",
        agentYellow: "#eab308", agentGreen: "#22c55e", agentBlue: "#3b82f6",
        agentPink: "#ec4899", agentPurple: "#8b5cf6"
    };

    function drawPolyRound(ctx, x, y, w, h, radius, fill, stroke) {
        ctx.fillStyle = fill;
        ctx.beginPath();
        if (ctx.roundRect) ctx.roundRect(x, y, w, h, radius);
        else ctx.rect(x, y, w, h);
        ctx.fill();
        if (stroke) { ctx.lineWidth = 2; ctx.strokeStyle = stroke; ctx.stroke(); }
    }

    function bezierPoint(t, p0, p1, p2, p3) {
        const u = 1 - t;
        return {
            x: u*u*u*p0.x + 3*u*u*t*p1.x + 3*u*t*t*p2.x + t*t*t*p3.x,
            y: u*u*u*p0.y + 3*u*u*t*p1.y + 3*u*t*t*p2.y + t*t*t*p3.y
        };
    }

    class LeadStreamPath {
        constructor() {
            this.paths = [
                { p0:{x:-320,y:-80}, p1:{x:-180,y:-140}, p2:{x:-40,y:-60}, p3:{x:20,y:-20}, color:"#fde68a" },
                { p0:{x:-320,y:10}, p1:{x:-160,y:-30}, p2:{x:0,y:20}, p3:{x:30,y:0}, color:"#bbf7d0" },
                { p0:{x:-320,y:90}, p1:{x:-150,y:60}, p2:{x:-20,y:80}, p3:{x:25,y:40}, color:"#bfdbfe" }
            ];
        }
        draw(ctx) {
            const prg = (frame * 0.04) % 240;
            this.paths.forEach((path, idx) => {
                ctx.save();
                ctx.strokeStyle = "rgba(121, 242, 255, 0.28)";
                ctx.lineWidth = 2;
                ctx.setLineDash([6, 8]);
                ctx.beginPath();
                ctx.moveTo(path.p0.x, path.p0.y);
                ctx.bezierCurveTo(path.p1.x, path.p1.y, path.p2.x, path.p2.y, path.p3.x, path.p3.y);
                ctx.stroke();
                ctx.setLineDash([]);
                const offset = ((frame * 0.5 + idx * 80) % 240) / 240;
                if (prg < 200) {
                    const t = offset;
                    const pt = bezierPoint(t, path.p0, path.p1, path.p2, path.p3);
                    drawPolyRound(ctx, pt.x - 10, pt.y - 7, 20, 14, 3, path.color, C.outline);
                    ctx.fillStyle = C.outline;
                    ctx.font = "bold 7px sans-serif";
                    ctx.textAlign = "center";
                    ctx.fillText("лид", pt.x, pt.y + 2);
                }
                ctx.restore();
            });
        }
    }

    class SiteFormBeacon {
        constructor(x, y) { this.x = x; this.y = y; }
        draw(ctx) {
            const pulse = 1 + Math.sin(frame * 0.08) * 0.06;
            ctx.save();
            ctx.translate(this.x, this.y);
            drawPolyRound(ctx, -55, -45, 110, 90, 10, C.cardBg, C.outline);
            drawPolyRound(ctx, -45, -35, 90, 18, 6, C.fieldMuted, C.outline);
            drawPolyRound(ctx, -45, -10, 90, 12, 4, "#f8fafc", C.outline);
            drawPolyRound(ctx, -45, 6, 90, 12, 4, "#f8fafc", C.outline);
            drawPolyRound(ctx, -20, 28, 60, 16, 8, C.softIndigo, C.outline);
            ctx.fillStyle = "#fff";
            ctx.font = "bold 8px sans-serif";
            ctx.textAlign = "center";
            ctx.fillText("Оставить заявку", 10, 39);
            ctx.beginPath();
            ctx.arc(55, -50, 12 * pulse, 0, Math.PI * 2);
            ctx.fillStyle = "rgba(249, 115, 22, 0.15)";
            ctx.fill();
            ctx.strokeStyle = C.softOrange;
            ctx.lineWidth = 2;
            ctx.stroke();
            ctx.fillStyle = C.softOrange;
            ctx.font = "bold 9px sans-serif";
            ctx.fillText("NEW", 55, -47);
            ctx.restore();
        }
    }

    class QualificationOrb {
        constructor(x, y) {
            this.x = x; this.y = y;
            this.handoffY = 0;
            this.notifyAlpha = 0;
        }
        draw(ctx) {
            const prg = (frame * 0.04) % 240;
            ctx.save();
            ctx.translate(this.x, this.y);

            const glow = 1 + Math.sin(frame * 0.1) * 0.08;
            ctx.beginPath();
            ctx.arc(0, 0, 58 * glow, 0, Math.PI * 2);
            ctx.fillStyle = "rgba(129, 140, 248, 0.12)";
            ctx.fill();

            drawPolyRound(ctx, -48, -48, 96, 96, 48, C.orbGlow, C.outline);
            drawPolyRound(ctx, -32, -32, 64, 64, 32, C.orbCore, C.outline);
            ctx.fillStyle = "#fff";
            ctx.font = "900 14px sans-serif";
            ctx.textAlign = "center";
            ctx.fillText("AI", 0, 6);

            if (prg > 40 && prg < 130) {
                const sec = Math.min(15, 5 + Math.floor((prg - 40) / 6));
                ctx.fillStyle = C.hotGreen;
                ctx.font = "bold 11px sans-serif";
                ctx.fillText(sec + " сек", 0, -62);
                drawPolyRound(ctx, -42, 58, 84, 36, 8, C.cardBg, C.outline);
                const fields = ["Услуга ✓", "Бюджет ✓", "Срок ✓"];
                fields.forEach((f, i) => {
                    if (prg > 55 + i * 18) {
                        ctx.fillStyle = C.outline;
                        ctx.font = "bold 8px sans-serif";
                        ctx.textAlign = "left";
                        ctx.fillText(f, -34, 72 + i * 10);
                    }
                });
            }

            if (prg > 120 && prg < 200) {
                this.handoffY = Math.min(80, (prg - 120) * 2.5);
                drawPolyRound(ctx, 70, -20 + this.handoffY, 44, 32, 6, "#fef3c7", C.outline);
                ctx.fillStyle = C.outline;
                ctx.font = "bold 8px sans-serif";
                ctx.textAlign = "center";
                ctx.fillText("🔥", 92, -2 + this.handoffY);
            }

            if (prg >= 190) {
                this.notifyAlpha = Math.min(1, (prg - 190) / 15);
                ctx.globalAlpha = this.notifyAlpha;
                drawPolyRound(ctx, -30, -90, 120, 22, 8, "#dcfce7", C.outline);
                ctx.fillStyle = C.outline;
                ctx.font = "bold 9px sans-serif";
                ctx.textAlign = "center";
                ctx.fillText("Задача: позвонить за 15 мин", 30, -75);
                ctx.globalAlpha = 1;
            }

            ctx.restore();
        }
    }

    class CrmKanbanDock {
        constructor(x, y) { this.x = x; this.y = y; this.snap = 0; }
        draw(ctx) {
            const prg = (frame * 0.04) % 240;
            ctx.save();
            ctx.translate(this.x, this.y);
            drawPolyRound(ctx, -70, -70, 140, 150, 10, C.crmCol, C.outline);
            ctx.fillStyle = C.outline;
            ctx.font = "bold 10px sans-serif";
            ctx.textAlign = "center";
            ctx.fillText("CRM", 0, -52);

            const cols = ["Новый", "Горячий", "Задача"];
            cols.forEach((label, i) => {
                const colX = -48 + i * 34;
                drawPolyRound(ctx, colX, -38, 30, 100, 4, "#fff", C.outline);
                ctx.fillStyle = "#64748b";
                ctx.font = "bold 6px sans-serif";
                ctx.fillText(label, colX + 15, -28);
            });

            if (prg > 145) {
                this.snap = Math.min(1, (prg - 145) / 20);
                const cardY = -10 + (1 - this.snap) * 40;
                drawPolyRound(ctx, -14, cardY, 28, 36, 4, "#fef3c7", C.outline);
                if (this.snap > 0.8) {
                    ctx.strokeStyle = C.hotGreen;
                    ctx.lineWidth = 3;
                    ctx.strokeRect(-18, cardY - 4, 36, 44);
                }
            }
            ctx.restore();
        }
    }

    class NightShiftClock {
        constructor(x, y) { this.x = x; this.y = y; }
        draw(ctx) {
            ctx.save();
            ctx.translate(this.x, this.y);
            drawPolyRound(ctx, -36, -22, 72, 44, 10, C.cardBg, C.outline);
            ctx.fillStyle = C.softIndigo;
            ctx.font = "bold 14px sans-serif";
            ctx.textAlign = "center";
            ctx.fillText("02:47", 0, 2);
            ctx.fillStyle = "#64748b";
            ctx.font = "bold 7px sans-serif";
            ctx.fillText("ночь", 0, 14);
            ctx.restore();
        }
    }

    class ManagerSleepPod {
        constructor(x, y) { this.x = x; this.y = y; }
        draw(ctx) {
            ctx.save();
            ctx.translate(this.x, this.y);
            drawPolyRound(ctx, -40, 0, 80, 28, 6, "#e2e8f0", C.outline);
            drawPolyRound(ctx, -30, -18, 50, 22, 8, "#cbd5e1", C.outline);
            ctx.fillStyle = "#94a3b8";
            ctx.font = "bold 10px sans-serif";
            ctx.textAlign = "center";
            const zzz = "z".repeat(1 + Math.floor(frame / 30) % 3);
            ctx.fillText(zzz, 20, -28);
            ctx.restore();
        }
    }

    class Agent {
        constructor(x, y, color, role, stepTrig, dialogs) {
            this.x = x; this.y = y; this.baseX = x; this.baseY = y;
            this.color = color; this.role = role;
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
            const prg = (frame * 0.04) % 240;

            const targets = {
                "1_architect": { x: -260, y: -30 },
                "2_seo": { x: -20, y: -70 },
                "3_coder": { x: 10, y: 50 },
                "4_designer": { x: 50, y: -40 },
                "5_deployer": { x: 220, y: 20 }
            };
            const tgt = targets[this.role] || { x: 0, y: 0 };

            if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
                const local = prg - this.stepTrig;
                if (local < 11) {
                    isMoving = true; faceDir = tgt.x > this.baseX ? 1 : -1;
                    this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
                    this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
                    carryType = this.color;
                } else if (local < 16) {
                    this.x = tgt.x; this.y = tgt.y;
                } else {
                    isMoving = true; faceDir = tgt.x > this.baseX ? -1 : 1;
                    this.x = tgt.x - (tgt.x - this.baseX) * ((local - 16) / 6);
                    this.y = tgt.y - (tgt.y - this.baseY) * ((local - 16) / 6);
                }
            } else {
                this.x = this.baseX; this.y = this.baseY;
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
                legL = Math.sin(wp) * 5; legR = Math.sin(wp + Math.PI) * 5;
            }
            drawPolyRound(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
            drawPolyRound(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
            drawPolyRound(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
            drawPolyRound(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);
            drawPolyRound(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);
            const hx = 0, hy = -28 - bob;
            ctx.fillStyle = this.color;
            ctx.beginPath(); ctx.arc(hx, hy, 12, 0, Math.PI * 2); ctx.fill();
            ctx.lineWidth = 2; ctx.strokeStyle = C.outline; ctx.stroke();
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
                ctx.strokeRect(hx + 1, hy - 5, 6, 6); ctx.strokeRect(hx - 7, hy - 5, 6, 6);
            } else if (this.role === "2_seo") {
                drawPolyRound(ctx, hx - 12, hy - 14, 24, 8, [6, 6, 0, 0], C.outline, null);
            } else if (this.role === "3_coder") {
                ctx.fillStyle = C.outline;
                ctx.beginPath(); ctx.moveTo(hx - 10, hy - 8); ctx.lineTo(hx - 14, hy - 18); ctx.lineTo(hx - 4, hy - 12);
                ctx.lineTo(hx, hy - 20); ctx.lineTo(hx + 4, hy - 12); ctx.lineTo(hx + 12, hy - 16); ctx.lineTo(hx + 10, hy - 8); ctx.fill();
            } else if (this.role === "4_designer") {
                drawPolyRound(ctx, hx - 14, hy - 12, 28, 6, 3, "#f43f5e", C.outline);
            } else if (this.role === "5_deployer") {
                ctx.strokeStyle = C.outline; ctx.lineWidth = 2;
                ctx.beginPath(); ctx.arc(hx, hy, 14, Math.PI, Math.PI * 2); ctx.stroke();
            }
            ctx.restore();
            if (carryType) drawPolyRound(ctx, -20 * faceDir, -18 - bob, 16, 16, 2, carryType, C.outline);
            ctx.restore();
        }
    }

    const entities = [];
    const bubbles = [];
    const ambientDots = Array.from({ length: 18 }, (_, i) => ({
        x: (i * 47) % 400 - 200,
        y: (i * 31) % 300 - 150,
        sp: 0.2 + (i % 5) * 0.05
    }));

    entities.push(new LeadStreamPath());
    entities.push(new SiteFormBeacon(-280, -20));
    entities.push(new QualificationOrb(30, 0));
    entities.push(new CrmKanbanDock(240, -10));
    entities.push(new NightShiftClock(200, -120));
    entities.push(new ManagerSleepPod(260, 90));
    entities.push(new Agent(-180, 80, C.agentYellow, "1_architect", 18, [
        "Сценарий квалификации...", "Форма → webhook", "Ночной поток настроен!"
    ]));
    entities.push(new Agent(-100, -60, C.agentGreen, "2_seo", 52, [
        "Score: горячий!", "Тег amoCRM", "Бюджет в поле CRM"
    ]));
    entities.push(new Agent(-40, 100, C.agentBlue, "3_coder", 88, [
        "Webhook 200 OK", "Bitrix24 REST", "Поля заполнены"
    ]));
    entities.push(new Agent(80, -80, C.agentPink, "4_designer", 118, [
        "Карточка лида ✓", "История чата", "UI виджета ок"
    ]));
    entities.push(new Agent(160, 60, C.agentPurple, "5_deployer", 158, [
        "Задача на 09:00", "Telegram пинг", "Лид не остыл!"
    ]));

    function createBubble(x, y, text, customLife = 300) {
        bubbles.push({ x, y, text, life: customLife, maxLife: customLife });
    }

    function engineloop() {
        frame++;
        ctx.clearRect(0, 0, cw, ch);
        ctx.save();
        ctx.translate(cx, cy);
        ctx.scale(scale, scale);

        ambientDots.forEach(d => {
            d.y -= d.sp;
            if (d.y < -180) d.y = 180;
            ctx.fillStyle = "rgba(121, 242, 255, 0.22)";
            ctx.beginPath();
            ctx.arc(d.x, d.y, 2, 0, Math.PI * 2);
            ctx.fill();
        });

        entities.sort((a, b) => (a.y || 0) - (b.y || 0));
        entities.forEach(ent => ent.draw(ctx));

        const prg = (frame * 0.04) % 240;
        if (prg >= 12 && prg < 12.05) createBubble(-280, -40, "Заявка с сайта", 280);
        if (prg >= 48 && prg < 48.05) createBubble(30, -70, "Ответ за 8 сек", 280);
        if (prg >= 92 && prg < 92.05) createBubble(30, 50, "Бюджет уточнён", 280);
        if (prg >= 148 && prg < 148.05) createBubble(240, -30, "Горячий → CRM", 280);
        if (prg >= 198 && prg < 198.05) createBubble(260, 70, "Менеджер утром", 280);

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
            const by = bub.y - (bub.maxLife - bub.life) * 0.05;
            ctx.lineWidth = 2; ctx.strokeStyle = C.outline;
            drawPolyRound(ctx, bx - tw / 2, by - th, tw, th, 6, C.bubbleBg, C.outline);
            ctx.fillStyle = C.bubbleBg;
            ctx.beginPath(); ctx.moveTo(bx - 4, by); ctx.lineTo(bx + 4, by); ctx.lineTo(bx, by + 5); ctx.fill(); ctx.stroke();
            ctx.fillRect(bx - 3, by - 2, 6, 4);
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

  <section class="nero-ai-section-tight vnedrenie-ai-obrabotka-zayavok-s-sayta-intro" aria-label="Введение">
    <div class="nero-ai-container">
      <div class="vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__grid nero-ai-reveal">
        <div class="vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__text">
          <p class="vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__lead"><strong>Коротко:</strong> AI-обработка заявок — это автоматизация первого касания с лидом: нейросеть отвечает за 5–15 секунд, уточняет параметры сделки и передаёт горячий лид в CRM. Nero Network внедряет таких агентов под ключ — от аудита воронки до интеграции с amoCRM, Bitrix24 и мессенджерами.</p>
          <p>Заявки с сайта не ждут рабочего дня. Пока менеджер открывает почту утром, клиент уже получил ответ конкурента. AI-агент для сайта закрывает этот разрыв: принимает обращение из виджета, формы или Telegram, квалифицирует лид по вашему сценарию и создаёт в CRM карточку с заполненными полями — услуга, бюджет, срок, контакт.</p>
        </div>
        <div class="vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__terminal nero-ai-reveal nero-ai-delay-1" aria-hidden="true">
          <div class="vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__terminal-head"><span></span><span></span><span></span></div>
          <ul class="vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__chips">
            <li>5–15 сек ответ</li>
            <li>amoCRM / Bitrix24</li>
            <li>Telegram 24/7</li>
            <li>BANT-квалификация</li>
          </ul>
          <div class="vnedrenie-ai-obrabotka-zayavok-s-sayta-intro__metric">
            <div><strong data-nero-count="21" data-nero-prefix="×">×0</strong><span>падение шанса при ответе &gt;30 мин</span></div>
            <div><strong data-nero-count="78" data-nero-suffix="%">0%</strong><span>выбирают первого ответившего</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <nav class="nero-ai-toc-wrap" aria-label="Оглавление">
    <ul class="nero-ai-toc nero-ai-reveal">
      <li><a href="#pochemu-zayavki-ostyvayut">Почему заявки остывают</a></li>
      <li><a href="#chto-takoe-ai-agent">Что такое AI-агент</a></li>
      <li><a href="#kak-rabotaet-ai-obrabotka">Как работает обработка</a></li>
      <li><a href="#vnedrenie-pod-klyuch">Внедрение под ключ</a></li>
      <li><a href="#integratsiya-crm">Интеграция с CRM</a></li>
      <li><a href="#ai-dlya-msb">Для МСБ</a></li>
      <li><a href="#skolko-stoit">Стоимость</a></li>
      <li><a href="#keisy-i-metriki">Кейсы и метрики</a></li>
      <li><a href="#faq">FAQ</a></li>
      <li><a href="#final-cta-audit-title">Аудит за 30 минут</a></li>
    </ul>
  </nav>

  <section id="pochemu-zayavki-ostyvayut" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Почему заявки с сайта остывают, пока менеджеры спят</h2>
      <p><strong>Определение:</strong> «Остывший лид» — обращение, на которое компания ответила слишком поздно: клиент ушёл к конкуренту, передумал или перестал быть «горячим».</p>
      <p>Потеря заявок с сайта — не абстрактная проблема маркетинга. Это прямой утечка выручки в момент, когда реклама уже отработала, а продажи — ещё нет.</p>

      <h3>Сколько лидов теряет бизнес из‑за ответа позже 5 минут</h3>
      <p>Исследование MIT и InsideSales.com на выборке 15 000 лидов показало: если ответить через 30 минут вместо 5 минут, шанс квалификации падает <strong>в 21 раз</strong> (<a href="https://textback.ru/kak_ne_teryat_goryachie_lidy/" rel="noopener noreferrer" target="_blank">textback.ru</a>). Каждые <strong>30 секунд</strong> задержки на pre-sales чате снижают конверсию на <strong>7%</strong> — данные Drift 2024 (<a href="https://www.gethelpable.com/blog/live-chat-response-time-benchmarks" rel="noopener noreferrer" target="_blank">gethelpable.com</a>).</p>
      <p><strong>78%</strong> покупателей выбирают компанию, которая ответила первой (<a href="https://rechka.ai/blog/obrabotka-vkhodyashchikh-zayavok/" rel="noopener noreferrer" target="_blank">Rep.ai, 2024 — rechka.ai</a>). При этом средняя скорость ответа на B2B-заявку в российской практике — <strong>47 часов</strong> (Optifai, 2024, тот же обзор).</p>

      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Метрика</th><th>Норма / ориентир</th><th>Красный флаг</th></tr></thead>
          <tbody>
            <tr><td>Скорость первого ответа</td><td>≤1 мин идеал, ≤5 мин допустимо</td><td>&gt;30 мин</td></tr>
            <tr><td>% заявок, попавших в CRM</td><td>100%</td><td>Потери &gt;10%</td></tr>
            <tr><td>Конверсия лид → квалифицированный</td><td>30–60% (зависит от канала)</td><td>&lt;20%</td></tr>
            <tr><td>% лидов без контакта в первый день</td><td>≤10%</td><td>&gt;10%</td></tr>
            <tr><td>Разрыв «обращений» vs «сделок в CRM»</td><td>≤20%</td><td>&gt;20% = зона AI-агента</td></tr>
          </tbody>
        </table>
      </div>

      <p><strong>Иллюстративный расчёт упущенной выручки</strong> (формула из rechka.ai): 100 заявок/мес × 30% потерь × 10% конверсия × 50 000 ₽ средний чек = <strong>150 000 ₽/мес</strong> недополученной выручки. Цифры зависят от вашей воронки — именно поэтому Nero Network начинает с аудита потерь заявок, а не с продажи «бота в лоб».</p>

      <h3>Ночные и выходные заявки: типичные сценарии для услуг, школ и клиник</h3>
      <ul>
        <li><strong>Услуги и локальный бизнес:</strong> клиент сравнивает 3–5 подрядчиков вечером после работы; утром звонит тот, кто ответил первым.</li>
        <li><strong>Онлайн-школы:</strong> всплеск заявок после вебинара в 21:00–23:00; без AI-менеджера заявок куратор видит их только на следующий день.</li>
        <li><strong>Клиники:</strong> запись на приём в WhatsApp или через форму сайта в нерабочее время — без автоматизации регистратура теряет слоты (<a href="https://chat2desk.com/blog/kejsyi/chat-bot-v-whatsapp-podtverzhdaet-60-zapisej-k-vrachu-bez-obzvona-kejs-chat2desk-i-chatme.ai" rel="noopener noreferrer" target="_blank">кейс Chat2Desk × chatme.ai</a>: 60% записей подтверждаются без обзвона).</li>
      </ul>
      <p>AI-агент работает 24/7: первый контакт за секунды, эскалация на живого менеджера — только по правилам (горячий лид, нестандартный запрос, конфликт).</p>

      <h3>Когда «оставьте заявку — перезвоним» перестаёт работать</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Канал</th><th>Первый ответ</th><th>Вовлечённость</th><th>Конверсия в лид</th></tr></thead>
          <tbody>
            <tr><td>AI-чатбот</td><td>1,2 сек</td><td>12,4%</td><td>3,2%</td></tr>
            <tr><td>Live chat</td><td>47 сек</td><td>—</td><td>—</td></tr>
            <tr><td>Форма</td><td>4,2 ч</td><td>2,3%</td><td>0,2%</td></tr>
          </tbody>
        </table>
      </div>
      <p><em>Примечание: зарубежный SaaS-бенчмарк Conferbot (Jan–Mar 2026, 45 000 визитов — <a href="https://www.conferbot.com/blog/chatbot-vs-live-chat-vs-form" rel="noopener noreferrer" target="_blank">conferbot.com</a>). Порядок величин подтверждается обзором 2026: конверсия AI-чатботов 10–15% vs форм 2–3%.</em></p>
      <p>Форма не диалог: она не уточняет бюджет, не отсеивает спам, не ставит задачу менеджеру. AI-консультант на сайт делает это в первом же сообщении.</p>

      <aside class="nero-ai-card nero-ai-reveal nero-ai-inline-cta" aria-label="Аудит потерь заявок">
  <p class="nero-ai-eyebrow">Бесплатный аудит · 30 минут</p>
  <h3>Узнайте, сколько лидов теряете из‑за медленного ответа</h3>
  <p>Разберём каналы, время первого контакта и разрыв между обращениями и сделками в CRM — с иллюстративным расчётом упущенной выручки по вашим цифрам.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="https://t.me/gorbachevzd">Получить AI-аудит</a>
  </div>
</aside>
    </div>
  </section>

  <section id="chto-takoe-ai-agent" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Что такое AI-агент для первичной обработки заявок с сайта</h2>
      <p><strong>Определение:</strong> AI-агент для первичной обработки заявок — автономная система на LLM (GPT-4o, Claude, YandexGPT, GigaChat), которая принимает обращения с сайта, мессенджеров и маркетплейсов, отвечает за 5–15 секунд, квалифицирует лид и выполняет <strong>действия в CRM</strong>: создаёт сделку, заполняет поля, меняет стадию, ставит задачу.</p>
      <p>Это не синоним «чат-бота для приёма заявок». Разница принципиальная — как формулирует METASAPIENS: «Чат-бот отвечает. Ассистент помогает. <strong>Агент — работает</strong>» (<a href="https://metasapiens.ru/blog/ai-agenty-v-crm-kak-cifrovoj-sotrudnik-zakryvaet-sdelki" rel="noopener noreferrer" target="_blank">metasapiens.ru</a>).</p>

      <h3>От чат-бота с FAQ к агенту, который квалифицирует и передаёт лид</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th></th><th>Чат-бот по скрипту</th><th>AI-агент</th></tr></thead>
          <tbody>
            <tr><td>Ответы</td><td>Жёсткое дерево</td><td>Диалог по базе знаний + сценарий</td></tr>
            <tr><td>CRM</td><td>Иногда «отправить email»</td><td>Сделки, поля, стадии, задачи</td></tr>
            <tr><td>Квалификация</td><td>Нет или 1–2 вопроса</td><td>BANT/скрипт: услуга, бюджет, срок, ЛПР</td></tr>
            <tr><td>Эскалация</td><td>«Позвоните нам»</td><td>Правила: горячий → менеджер за 15 мин</td></tr>
            <tr><td>Ночь/выходные</td><td>Автоответ «мы перезвоним»</td><td>Полноценная первичная обработка</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Чем AI-консультант на сайте отличается от формы обратной связи</h3>
      <p>Форма создаёт «пустую» карточку: имя + телефон. AI-бот для сайта ведёт диалог и собирает контекст: услуга, бюджет, срок, город, ЛПР, готовность к созвону. Менеджер получает не «ещё одну заявку», а <strong>квалифицированный лид</strong> с историей переписки в CRM.</p>

      <h3>Какие задачи агент закрывает на первом касании</h3>
      <ol>
        <li><strong>Мгновенный первый контакт</strong> — small talk, приветствие, ответ на первый вопрос.</li>
        <li><strong>Квалификация по BANT/скрипту компании</strong> — бюджет, срок, услуга, контакт, ЛПР.</li>
        <li><strong>Заполнение полей CRM и тегов</strong> — score «горячий / тёплый / холодный».</li>
        <li><strong>Follow-up при молчании</strong> — дожим, если клиент не ответил.</li>
        <li><strong>Фильтрация спама</strong> и нецелевых обращений.</li>
      </ol>
      <p>Что остаётся за человеком: переговоры, возражения, high-ticket сделки, нестандартные запросы, финальное одобрение КП и договора.</p>
    </div>
  </section>

  <section id="vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block" class="boris-lead-pipeline" aria-labelledby="boris-lead-pipeline-title">
<style>
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block.boris-lead-pipeline {
    margin: 48px 0 56px;
    padding: 0;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 48%, #eef2ff 100%);
    border: 1px solid rgba(15, 23, 42, 0.08);
    border-radius: 22px;
    box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
    padding: clamp(24px, 4vw, 40px);
    overflow: hidden;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__grid {
    display: grid;
    grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
    gap: clamp(24px, 4vw, 40px);
    align-items: center;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__eyebrow {
    margin: 0 0 10px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #2563eb;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__title {
    margin: 0 0 12px;
    font-size: clamp(22px, 2.4vw, 28px);
    line-height: 1.2;
    letter-spacing: -0.03em;
    color: #0f172a;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__lead {
    margin: 0 0 18px;
    color: #475569;
    font-size: 15px;
    line-height: 1.55;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__steps {
    margin: 0 0 20px;
    padding: 0;
    list-style: none;
    display: grid;
    gap: 10px;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__steps li {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    font-size: 14px;
    line-height: 1.45;
    color: #334155;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__step-num {
    flex: 0 0 24px;
    height: 24px;
    border-radius: 999px;
    background: #dbeafe;
    color: #1d4ed8;
    font-size: 12px;
    font-weight: 700;
    display: grid;
    place-items: center;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__pill {
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
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__pill-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.18);
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__pill--violet .boris-lead-pipeline__pill-dot { background: #8b5cf6; box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.18); }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__pill--amber .boris-lead-pipeline__pill-dot { background: #f59e0b; box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.18); }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__bridge {
    margin: 16px 0 0;
    font-size: 13px;
    color: #64748b;
    font-style: italic;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__viz {
    position: relative;
    min-height: 380px;
    border-radius: 18px;
    background: #fff;
    border: 1px solid rgba(15, 23, 42, 0.06);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9);
    overflow: hidden;
  }
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block #lead-qualify-crm-boris-canvas {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 380px;
  }
  @media (max-width: 1023px) {
    #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__grid {
      grid-template-columns: 1fr;
    }
    #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .boris-lead-pipeline__viz {
      min-height: 340px;
    }
    #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block #lead-qualify-crm-boris-canvas {
      min-height: 340px;
    }
  }
</style>

  <div class="ym-container boris-lead-pipeline__card">
    <div class="boris-lead-pipeline__grid">
      <div class="boris-lead-pipeline__copy">
        <p class="boris-lead-pipeline__eyebrow">Пайплайн первого касания</p>
        <h3 id="boris-lead-pipeline-title" class="boris-lead-pipeline__title">Заявка → квалификация → горячий лид в CRM</h3>
        <p class="boris-lead-pipeline__lead">AI-агент не просто отвечает в чате — он проводит лид по сценарию и собирает поля, которые менеджеру пришлось бы выяснять вручную.</p>
        <ol class="boris-lead-pipeline__steps">
          <li><span class="boris-lead-pipeline__step-num">1</span><span><strong>Заявка</strong> — виджет, форма или Telegram; webhook создаёт черновик сделки.</span></li>
          <li><span class="boris-lead-pipeline__step-num">2</span><span><strong>Квалификация</strong> — 4–7 вопросов: услуга, бюджет, срок, контакт, ЛПР.</span></li>
          <li><span class="boris-lead-pipeline__step-num">3</span><span><strong>CRM</strong> — карточка с score «горячий», историей диалога и задачей менеджеру.</span></li>
        </ol>
        <div class="boris-lead-pipeline__pills" aria-hidden="true">
          <span class="boris-lead-pipeline__pill"><span class="boris-lead-pipeline__pill-dot"></span>5–15 сек ответ</span>
          <span class="boris-lead-pipeline__pill boris-lead-pipeline__pill--violet"><span class="boris-lead-pipeline__pill-dot"></span>7 полей CRM</span>
          <span class="boris-lead-pipeline__pill boris-lead-pipeline__pill--amber"><span class="boris-lead-pipeline__pill-dot"></span>24/7 без пауз</span>
        </div>
        <p class="boris-lead-pipeline__bridge">Дальше разберём каждый шаг пайплайна — от webhook до эскалации на менеджера.</p>
      </div>
      <div class="boris-lead-pipeline__viz" aria-hidden="true">
        <canvas id="lead-qualify-crm-boris-canvas" role="img" aria-label="Анимация: заявка с сайта проходит квалификацию AI-агентом и попадает в CRM как горячий лид"></canvas>
      </div>
    </div>
  </div>

<script id="lead-qualify-crm-boris-engine">
(function () {
  var canvas = document.getElementById('lead-qualify-crm-boris-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var cw = 0, ch = 0, frame = 0, cycle = 0;

  var COL = {
    ink: '#0f172a',
    muted: '#64748b',
    line: '#cbd5e1',
    blue: '#2563eb',
    blueSoft: '#dbeafe',
    green: '#10b981',
    greenSoft: '#d1fae5',
    violet: '#8b5cf6',
    violetSoft: '#ede9fe',
    amber: '#f59e0b',
    card: '#ffffff',
    cardBorder: '#e2e8f0',
    hot: '#ef4444'
  };

  var questions = ['Услуга?', 'Бюджет?', 'Срок?', 'Контакт?'];
  var crmFields = [
    { label: 'Услуга', value: 'Ремонт под ключ' },
    { label: 'Бюджет', value: '200 000 ₽' },
    { label: 'Срок', value: 'Март 2026' },
    { label: 'Score', value: 'Горячий' }
  ];

  function resize() {
    var parent = canvas.parentElement;
    if (!parent) return;
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    cw = parent.clientWidth;
    ch = Math.max(parent.clientHeight, 340);
    canvas.width = Math.floor(cw * dpr);
    canvas.height = Math.floor(ch * dpr);
    canvas.style.width = cw + 'px';
    canvas.style.height = ch + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function rr(x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else { ctx.moveTo(x + r, y); ctx.arcTo(x + w, y, x + w, y + h, r); ctx.arcTo(x + w, y + h, x, y + h, r); ctx.arcTo(x, y + h, x, y, r); ctx.arcTo(x, y, x + w, y, r); }
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

  function drawNode(x, y, w, h, title, sub, accent, pulse) {
    rr(x, y, w, h, 14, COL.card, COL.cardBorder);
    rr(x + 12, y + 12, w - 24, 28, 8, accent + '22', accent);
    text(title, x + w / 2, y + 26, 11, accent, 'center', 700);
    text(sub, x + w / 2, y + h - 18, 10, COL.muted, 'center', 500);
    if (pulse > 0) {
      ctx.strokeStyle = accent;
      ctx.globalAlpha = 0.25 * pulse;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(x + w / 2, y + h / 2, w * 0.55 + pulse * 8, 0, Math.PI * 2);
      ctx.stroke();
      ctx.globalAlpha = 1;
    }
  }

  function drawSiteWidget(x, y, w, h) {
    rr(x, y, w, h, 12, COL.card, COL.cardBorder);
    rr(x + 10, y + 10, w - 20, 14, 4, COL.blueSoft, null);
    rr(x + 10, y + 32, w - 20, 10, 3, '#f1f5f9', null);
    rr(x + 10, y + 48, w - 20, 10, 3, '#f1f5f9', null);
    rr(x + 10, y + 68, w - 50, 18, 6, COL.blue, null);
    text('Оставить заявку', x + 10 + (w - 50) / 2, y + 77, 9, '#fff', 'center', 600);
  }

  function drawAiHub(x, y, r, spin) {
    ctx.save();
    ctx.translate(x, y);
    rr(-r, -r, r * 2, r * 2, 16, COL.violetSoft, COL.violet);
    for (var i = 0; i < 3; i++) {
      ctx.save();
      ctx.rotate(spin + i * (Math.PI * 2 / 3));
      rr(-18, -r + 8, 36, 10, 5, COL.violet, null);
      ctx.restore();
    }
    text('AI', 0, 2, 16, COL.violet, 'center', 800);
    ctx.restore();
  }

  function drawCrmCard(x, y, w, h, fillProgress) {
    rr(x, y, w, h, 12, COL.card, COL.cardBorder);
    text('amoCRM · сделка', x + w / 2, y + 16, 10, COL.muted, 'center', 600);
    var rowH = 22;
    for (var i = 0; i < crmFields.length; i++) {
      var ry = y + 32 + i * (rowH + 6);
      var filled = Math.max(0, Math.min(1, fillProgress - i * 0.22));
      rr(x + 10, ry, 52, 14, 4, '#f8fafc', COL.cardBorder);
      text(crmFields[i].label, x + 36, ry + 7, 8, COL.muted, 'center', 500);
      rr(x + 68, ry, w - 78, 14, 4, filled > 0 ? COL.greenSoft : '#f8fafc', filled > 0 ? COL.green : COL.cardBorder);
      if (filled > 0.05) {
        var val = crmFields[i].value;
        if (crmFields[i].label === 'Score') {
          text(val, x + 68 + (w - 78) / 2, ry + 7, 8, COL.hot, 'center', 700);
        } else {
          text(val.substring(0, Math.ceil(val.length * filled)), x + 74, ry + 7, 8, COL.ink, 'left', 600);
        }
      }
    }
  }

  function drawPipe(x1, x2, y, progress, color) {
    ctx.strokeStyle = COL.line;
    ctx.lineWidth = 3;
    ctx.setLineDash([6, 6]);
    ctx.beginPath();
    ctx.moveTo(x1, y);
    ctx.lineTo(x2, y);
    ctx.stroke();
    ctx.setLineDash([]);
    if (progress > 0) {
      var px = x1 + (x2 - x1) * progress;
      ctx.strokeStyle = color || COL.blue;
      ctx.lineWidth = 4;
      ctx.beginPath();
      ctx.moveTo(x1, y);
      ctx.lineTo(px, y);
      ctx.stroke();
      ctx.fillStyle = color || COL.blue;
      ctx.beginPath();
      ctx.arc(px, y, 5, 0, Math.PI * 2);
      ctx.fill();
    }
  }

  function drawLead(x, y, hot) {
    var col = hot ? COL.hot : COL.blue;
    ctx.fillStyle = col;
    ctx.beginPath();
    ctx.arc(x, y, hot ? 9 : 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 2;
    ctx.stroke();
    if (hot) {
      text('🔥', x, y - 16, 12, COL.hot, 'center', 600);
    }
  }

  function drawQuestionPills(cx, cy, progress) {
    var offsets = [[-58, -42], [52, -38], [-48, 38], [56, 34]];
    for (var i = 0; i < questions.length; i++) {
      var p = Math.max(0, Math.min(1, progress - i * 0.18));
      if (p <= 0) continue;
      var ox = offsets[i][0];
      var oy = offsets[i][1];
      var pw = 62;
      var ph = 18;
      ctx.globalAlpha = p;
      rr(cx + ox - pw / 2, cy + oy - ph / 2, pw, ph, 9, '#fff', COL.violet);
      text(questions[i], cx + ox, cy + oy, 9, COL.violet, 'center', 600);
      ctx.globalAlpha = 1;
    }
  }

  function render() {
    ctx.clearRect(0, 0, cw, ch);
    var pad = 24;
    var nodeW = Math.min(108, (cw - pad * 2) / 3.8);
    var nodeH = 96;
    var yMid = ch * 0.52;
    var xSite = pad + nodeW * 0.5;
    var xAi = cw * 0.5;
    var xCrm = cw - pad - nodeW * 0.5;

    cycle = (frame % 420) / 420;
    var t = cycle;

    var p1 = Math.max(0, Math.min(1, (t - 0.05) / 0.18));
    var p2 = Math.max(0, Math.min(1, (t - 0.38) / 0.18));
    var qProgress = Math.max(0, Math.min(1, (t - 0.22) / 0.28));
    var crmFill = Math.max(0, Math.min(1, (t - 0.58) / 0.32));
    var aiPulse = t > 0.2 && t < 0.55 ? 0.5 + 0.5 * Math.sin(frame * 0.12) : 0;

    drawPipe(xSite + nodeW * 0.5, xAi - 42, yMid, p1, COL.blue);
    drawPipe(xAi + 42, xCrm - nodeW * 0.5, yMid, p2, COL.green);

    drawSiteWidget(xSite - nodeW / 2, yMid - nodeH / 2, nodeW, nodeH);
    drawNode(xSite - nodeW / 2, yMid - nodeH / 2 - 34, nodeW, 24, 'ШАГ 1', 'Заявка с сайта', COL.blue, 0);

    drawAiHub(xAi, yMid, 42, frame * 0.018);
    drawNode(xAi - nodeW / 2, yMid - nodeH / 2 - 34, nodeW, 24, 'ШАГ 2', 'Квалификация AI', COL.violet, aiPulse);
    drawQuestionPills(xAi, yMid, qProgress);

    drawCrmCard(xCrm - nodeW / 2, yMid - nodeH / 2, nodeW, nodeH + 28, crmFill);
    drawNode(xCrm - nodeW / 2, yMid - nodeH / 2 - 34, nodeW, 24, 'ШАГ 3', 'Горячий лид в CRM', COL.green, crmFill > 0.8 ? 0.4 + 0.3 * Math.sin(frame * 0.1) : 0);

    var leadX = xSite + nodeW * 0.5;
    var leadY = yMid;
    var hot = t > 0.35;
    if (t < 0.05) {
      leadX = xSite + nodeW * 0.5;
    } else if (t < 0.23) {
      var local = (t - 0.05) / 0.18;
      leadX = xSite + nodeW * 0.5 + (xAi - xSite - nodeW * 0.5 - 42) * local;
    } else if (t < 0.56) {
      leadX = xAi;
      leadY = yMid + Math.sin(frame * 0.08) * 3;
    } else if (t < 0.74) {
      var local2 = (t - 0.56) / 0.18;
      leadX = xAi + 42 + (xCrm - xAi - nodeW * 0.5 - 42) * local2;
      leadY = yMid;
    } else {
      leadX = xCrm - 8;
      leadY = yMid + 10;
    }
    drawLead(leadX, leadY, hot && t > 0.35);

    if (t > 0.78 && crmFill > 0.85) {
      rr(cw / 2 - 90, ch - 36, 180, 22, 11, COL.greenSoft, COL.green);
      text('Задача менеджеру: позвонить за 15 мин', cw / 2, ch - 25, 9, COL.green, 'center', 700);
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

  <section id="kak-rabotaet-ai-obrabotka" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Как работает AI-обработка заявок: от клика до горячего лида в CRM</h2>
      <p><strong>Коротко:</strong> заявка → webhook → AI-агент (5–15 сек) → поля CRM → задача менеджеру или nurture. Автоматизация через AI-обработку заявок строится на оркестраторе (Make, n8n) + LLM + CRM API.</p>

      <h3>Ответ за 5–15 секунд и уточняющие вопросы по сценарию</h3>
      <ol>
        <li>Webhook мгновенно создаёт черновик сделки в CRM.</li>
        <li>Триггер запускает AI-агента.</li>
        <li>Агент отвечает за <strong>5–15 секунд</strong> (медиана AI first response — <strong>1,8 сек</strong> vs human <strong>2 мин 34 сек</strong> — <a href="https://loopreply.com/blog/chatbot-conversations-data-study" rel="noopener noreferrer" target="_blank">loopreply.com</a>).</li>
        <li>Задаёт 4–7 уточняющих вопросов по сценарию.</li>
      </ol>

      <h3>Квалификация: бюджет, срок, услуга, контакт</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Шаг</th><th>Вопрос / действие</th><th>Поле CRM</th></tr></thead>
          <tbody>
            <tr><td>1</td><td>Какая услуга / продукт интересует?</td><td>Услуга, тег категории</td></tr>
            <tr><td>2</td><td>Какой бюджет рассматриваете?</td><td>Бюджет, score</td></tr>
            <tr><td>3</td><td>Когда планируете старт / покупку?</td><td>Срок, приоритет</td></tr>
            <tr><td>4</td><td>Город / филиал (если релевантно)</td><td>Город</td></tr>
            <tr><td>5</td><td>Контакт: телефон, Telegram, email</td><td>Телефон, Telegram</td></tr>
            <tr><td>6</td><td>Вы принимаете решение?</td><td>ЛПР да/нет</td></tr>
            <tr><td>7</td><td>Итог: горячий / тёплый / холодный / спам</td><td>Стадия воронки</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Передача карточки лида в amoCRM, Bitrix24 или Telegram</h3>
      <p>После квалификации агент заполняет поля сделки/лида, прикрепляет историю диалога, меняет стадию («Квалифицирован», «Горячий»), ставит задачу менеджеру «позвонить за 15 мин» и отправляет уведомление в Telegram-чат отдела продаж.</p>

      <h3>Эскалация на живого менеджера только по правилам</h3>
      <p>Гибридная модель SDR: <strong>AI</strong> = первые 5–15 сек + квалификация + CRM; <strong>Человек</strong> = закрытие сделки, возражения, дорогие контракты. По данным Comm100 Live Chat Benchmark 2026: CSAT при handoff bot→agent — <strong>92,6%</strong>; AI Agent handling rate — <strong>75,3%</strong> (<a href="https://www.comm100.com/resources/report/live-chat-benchmark-report/" rel="noopener noreferrer" target="_blank">comm100.com</a>).</p>
    </div>
  </section>

  <section id="vnedrenie-pod-klyuch" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Внедрение AI для обработки заявок под ключ: этапы и сроки</h2>
      <p><strong>Внедрение AI в бизнес-процессы</strong> первичной линии продаж — проект на <strong>2–4 недели</strong>, не «вставил виджет за 15 минут». Nero Network ведёт внедрение AI-агентов под ключ: от диагностики до пилота на реальных диалогах.</p>

      <div class="nero-ai-process-list">
        <div class="nero-ai-card nero-ai-process-item nero-ai-reveal"><h3>Аудит текущей воронки и точек потери заявок</h3><p><strong>1–2 дня.</strong> Все каналы: формы сайта, виджеты, Telegram, WhatsApp, Avito; время первого ответа; разрыв между обращениями и сделками в CRM. Результат — карта потерь и ТЗ на AI-агента.</p></div>
        <div class="nero-ai-card nero-ai-process-item nero-ai-reveal nero-ai-delay-1"><h3>Проектирование сценариев и базы знаний</h3><p><strong>2–3 дня.</strong> Дерево квалификации (4–7 вопросов), правила эскалации и скоринга, FAQ, прайс, скрипты менеджеров, запреты (152-ФЗ, мед. дисклеймеры).</p></div>
        <div class="nero-ai-card nero-ai-process-item nero-ai-reveal nero-ai-delay-2"><h3>Интеграция с сайтом, CRM и мессенджерами</h3><p><strong>5–10 дней.</strong> Оркестратор Make/n8n/Albato, LLM YandexGPT/GigaChat или GPT-4o/Claude, CRM API, каналы: виджет, Telegram, WhatsApp, VK, Avito.</p></div>
        <div class="nero-ai-card nero-ai-process-item nero-ai-reveal nero-ai-delay-3"><h3>Тестирование, обучение команды и запуск</h3><p><strong>2 недели пилота:</strong> 50–100 реальных диалогов, корректировка промптов и эскалации. Обучаем менеджеров: как работать с карточками от AI, SLA после передачи лида.</p></div>
      </div>
      <p class="nero-ai-secondary-cta nero-ai-reveal">Чтобы команда уверенно работала с карточками от AI, полезно пройти <a class="nero-ai-text-link" href="https://meta-journal.ru/">Посмотреть, что можно автоматизировать</a> — особенно если менеджеры впервые получают квалифицированные лиды с историей диалога, а не «голый» телефон.</p>

      <h3>Пример внедрения AI-обработки заявок (типовой кейс)</h3>
      <p><em>Проектная модель Nero Network — не публичный кейс с выдуманными цифрами ROI.</em></p>
      <p><strong>Ситуация:</strong> компания услуг, 80–120 заявок/мес, amoCRM, форма на Tilda + Telegram. Средний ответ — 4–6 часов в рабочее время, ночью — до следующего дня.</p>
      <ol>
        <li>Аудит: 22% заявок не попадали в CRM (мессенджеры в личку менеджеров).</li>
        <li>Единый сценарий: сайт + Telegram → n8n → YandexGPT → amoCRM.</li>
        <li>Поля CRM: услуга, бюджет, срок, score, история чата.</li>
        <li>Пилот 2 недели, еженедельный разбор качества ответов.</li>
      </ol>
      <p><strong>Референс по срокам:</strong> V-AI Labs — внедрение связки Make + Wazzup + Bitrix24 + ИИ-бот <strong>~7 дней</strong> + 2 недели адаптации (<a href="https://v-ai-labs.ru/blog/ai-bot-zayavki-crm" rel="noopener noreferrer" target="_blank">v-ai-labs.ru</a>).</p>
    </div>
  </section>

  <section id="integratsiya-crm" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Интеграция AI-обработки заявок с CRM и каналами сайта</h2>
      <p>Интеграция AI-обработки заявок с CRM — ядро проекта. AI-виджет на сайт без CRM — просто чат; с CRM — <strong>AI-помощник для отдела продаж</strong>, который готовит сделки.</p>

      <div class="nero-ai-grid-3">
        <div class="nero-ai-card nero-ai-service-card nero-ai-reveal"><div class="nero-ai-card-icon">CRM</div><h3>amoCRM</h3><p>Поля, сделки, задачи менеджеру. Кастомная логика скоринга, мультиканал, webhook с Tilda/WordPress, YandexGPT для 152-ФЗ.</p></div>
        <div class="nero-ai-card nero-ai-service-card nero-ai-reveal nero-ai-delay-1"><div class="nero-ai-card-icon">B24</div><h3>Bitrix24</h3><p>BitrixGPT чаще пост-обрабатывает диалог. Для мгновенного первого ответа нужна внешняя связка: заявка → бот первым пишет клиенту → стадии → резюме в Telegram.</p></div>
        <div class="nero-ai-card nero-ai-service-card nero-ai-reveal nero-ai-delay-2"><div class="nero-ai-card-icon">↔</div><h3>Единый сценарий</h3><p>Сайт, Telegram, WhatsApp, VK, Avito, телефония Mango/UIS — один сценарий квалификации, без ручного переноса «из Telegram в CRM».</p></div>
      </div>
    </div>
  </section>

  <section id="ai-dlya-msb" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>AI-обработка заявок для малого и среднего бизнеса</h2>
      <p>AI-обработка заявок для бизнеса с потоком от 30–50 обращений в месяц уже оправдана: стоимость проекта сопоставима с 1–2 junior-менеджерами (60–80 тыс. ₽/мес), а покрытие — 24/7.</p>

      <div class="nero-ai-split">
        <div class="nero-ai-card nero-ai-reveal"><h4>Услуги и локальный бизнес</h4><p>AI-агент уточняет объект, бюджет, срок начала, передаёт в CRM с приоритетом. Менеджер утром звонит по <strong>горячему</strong> лиду.</p></div>
        <div class="nero-ai-card nero-ai-reveal nero-ai-delay-1"><h4>Онлайн-школы и edtech</h4><p>После вебинара — пик заявок. Бот отвечает на вопросы о программе, квалифицирует по готовности оплатить, записывает на созвон.</p></div>
        <div class="nero-ai-card nero-ai-reveal nero-ai-delay-2"><h4>Клиники и запись на приём</h4><p>Подтверждение/отмена/перенос записи, интеграция с МИС. Референс — WhatsApp-бот «Клиника Фомина»: 60% записей без обзвона.</p></div>
        <div class="nero-ai-card nero-ai-reveal nero-ai-delay-3"><h4>Базовый vs кастом</h4><p>1 услуга и 1 воронка — базовый сценарий. Несколько CRM, RAG, Avito, WABA, отраслевые дисклеймеры — кастом от Nero Network.</p></div>
      </div>
    </div>
  </section>

  <section id="skolko-stoit" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Сколько стоит внедрение AI-агента для заявок с сайта</h2>
      <p>AI-обработка заявок цена зависит от сложности сценария, числа интеграций и требований к LLM. Ниже — ориентиры рынка и Nero Network.</p>

      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Поставщик / ориентир</th><th>Старт</th><th>Срок</th></tr></thead>
          <tbody>
            <tr><td>Nero Network (под ключ)</td><td>120–350 тыс. ₽</td><td>2–4 нед.</td></tr>
            <tr><td>NikSan (кастом AI-бот + CRM)</td><td>от 150 тыс. ₽</td><td>3–5 нед.</td></tr>
            <tr><td>NaimiAI (интеграции)</td><td>40–300 тыс. ₽</td><td>пилот 2–3 нед.</td></tr>
            <tr><td>METASAPIENS (кастом)</td><td>от 60–80 тыс. ₽</td><td>зависит от scope</td></tr>
          </tbody>
        </table>
      </div>

      <p>Junior-менеджер: <strong>60–80 тыс. ₽/мес</strong> × 12 = 720–960 тыс. ₽/год; работает 8 часов, 5 дней. AI-агент: проект <strong>120–350 тыс. ₽</strong> + поддержка; работает 24/7. Окупаемость зависит от числа заявок, среднего чека и текущих потерь — точный ROI без аудита обещать нельзя.</p>

      <aside class="nero-ai-card nero-ai-reveal nero-ai-inline-cta" aria-label="Расчёт окупаемости AI-агента">
  <p class="nero-ai-eyebrow">Ориентир 120–350 тыс. ₽</p>
  <h3>Сравните стоимость внедрения с потерями от «остывших» заявок</h3>
  <p>Точный ROI без аудита не обещаем — но за 30 минут посчитаем ваш разрыв «обращения vs CRM» и скажем, имеет ли смысл AI-агент в вашем объёме заявок.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="https://t.me/gorbachevzd">Получить AI-аудит</a>
  </div>
</aside>
    </div>
  </section>

  <section id="keisy-i-metriki" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Кейсы и метрики: что измерять после запуска</h2>
      <p>AI-обработка заявок кейсы на российском рынке подтверждают: главные метрики — <strong>скорость</strong>, <strong>доля квалифицированных</strong>, <strong>нагрузка на первую линию</strong>.</p>

      <div class="nero-ai-kpi-grid">
        <div class="nero-ai-card nero-ai-kpi-card nero-ai-reveal"><span class="nero-ai-kpi-value" data-nero-count="15" data-nero-prefix="+" data-nero-suffix="%">+0%</span><span class="nero-ai-kpi-label">конверсия (кейс 3iTech)</span></div>
        <div class="nero-ai-card nero-ai-kpi-card nero-ai-reveal nero-ai-delay-1"><span class="nero-ai-kpi-value">75,3%</span><span class="nero-ai-kpi-label">чатов обрабатывает AI (Comm100)</span></div>
        <div class="nero-ai-card nero-ai-kpi-card nero-ai-reveal nero-ai-delay-2"><span class="nero-ai-kpi-value" data-nero-count="30" data-nero-suffix="%">0%</span><span class="nero-ai-kpi-label">типовых запросов на боте</span></div>
      </div>

      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th></th><th>До</th><th>После AI-агента</th></tr></thead>
          <tbody>
            <tr><td>Услуга</td><td>—</td><td>Ремонт квартиры под ключ</td></tr>
            <tr><td>Бюджет</td><td>—</td><td>200 000 ₽</td></tr>
            <tr><td>Срок</td><td>—</td><td>Март 2026</td></tr>
            <tr><td>Score</td><td>—</td><td>Горячий</td></tr>
            <tr><td>История</td><td>—</td><td>6 сообщений в карточке</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section id="faq" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-reveal">
      <div class="nero-ai-section-head">
        <p class="nero-ai-eyebrow">FAQ</p>
        <h2>Частые вопросы про AI-обработку заявок</h2>
      </div>
      <div class="nero-ai-faq nero-ai-prose">
        <details class="nero-ai-reveal"><summary>Можно ли внедрить без программиста?</summary><p>Да, если вы заказываете <strong>внедрение под ключ</strong> у Nero Network. Интегратор настраивает Make/n8n, CRM, виджет и промпты. С вашей стороны нужны: скрипт квалификации, FAQ, доступы к CRM и сайту.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1"><summary>Насколько безопасны данные клиентов?</summary><p>Для соблюдения <strong>152-ФЗ</strong> Nero Network использует YandexGPT / GigaChat на серверах в РФ, маскирование ПДн в логах, договорные ограничения на хранение.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-2"><summary>Что если AI ошибётся в ответе?</summary><p>Защита в три слоя: база знаний и ограничения промпта; запрет «выдумывать» цены вне FAQ; эскалация на менеджера при неуверенности. На пилоте разбираем 50–100 реальных диалогов.</p></details>
        <details class="nero-ai-reveal"><summary>Как быстро окупается внедрение?</summary><p>Зависит от потока заявок, среднего чека и текущих потерь. При 100+ заявках/мес проект 120–350 тыс. ₽ часто окупается за <strong>2–6 месяцев</strong> — но только после расчёта на аудите.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1"><summary>Нужна ли доработка текущего сайта?</summary><p>Чаще <strong>нет</strong>. Достаточно webhook с формы Tilda/WordPress, JS-виджет чата или Telegram-ссылка. Доработка нужна, если сайт не отправляет события или CRM не имеет API.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-2"><summary>Чем ваш AI-агент лучше amoAI / BitrixGPT?</summary><p>amoAI и BitrixGPT — ассистенты внутри CRM. Nero ставит <strong>автономного агента до менеджера</strong> на входящей заявке с сайта, с кастомной логикой, мультиканалом и аудитом потерь.</p></details>
        <details class="nero-ai-reveal"><summary>Заменит ли AI менеджеров по продажам?</summary><p>Нет. AI — первичная обработка заявок; человек — переговоры и закрытие high-ticket сделок (<a href="https://www.sostav.ru/blogs/285440/77127" rel="noopener noreferrer" target="_blank">sostav.ru</a>).</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1"><summary>Сколько длится внедрение?</summary><p>Типовой срок: <strong>2–4 недели</strong> (аудит + интеграция + пилот). Сложные проекты — до 5–6 недель.</p></details>
      </div>
    </div>
  </section>

  <section id="audit-cta" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>Проверьте, сколько заявок вы теряете — аудит за 30 минут</h2>
      <p>Первичная обработка заявок автоматизация имеет смысл только после диагностики. Nero Network не продаёт «бота в лоб» — начинаем с <strong>аудита потерь заявок</strong>.</p>
      <h3>Что входит в экспресс-аудит воронки</h3>
      <ol>
        <li>Разбор каналов: сайт, формы, мессенджеры, CRM.</li>
        <li>Оценка времени первого ответа и «дыр» в воронке.</li>
        <li>Сравнение с нормами: скорость, % в CRM, конверсия.</li>
        <li>Иллюстративный расчёт упущенной выручки по вашим цифрам.</li>
        <li>Рекомендация: нужен ли AI-агент, какой scope, ориентир бюджета.</li>
      </ol>
      <section class="nero-ai-final-cta nero-ai-card nero-ai-reveal" aria-labelledby="final-cta-audit-title">
  <h2 id="final-cta-audit-title">Проверьте, сколько заявок вы теряете — аудит за 30 минут</h2>
  <p>Nero Network не продаёт «бота в лоб». Начинаем с диагностики: каналы, скорость ответа, дыры в воронке и ориентир бюджета на внедрение AI-агента под ключ.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="https://t.me/gorbachevzd">Получить AI-аудит</a>
    <a class="nero-ai-btn nero-ai-btn-secondary" href="https://meta-journal.ru/">Посмотреть, что можно автоматизировать</a>
  </div>
</section>
      <div class="nero-ai-summary nero-ai-reveal"><p><strong>Итог:</strong> AI-обработка заявок с сайта — это не модный виджет, а <strong>инфраструктура первой линии продаж</strong>: мгновенный ответ, квалификация, горячий лид в CRM. Nero Network внедряет AI-агентов под ключ — от аудита потерь до интеграции с amoCRM, Bitrix24 и мессенджерами.</p></div>
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
    {
      "@type": "Question",
      "name": "Можно ли внедрить без программиста?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Да, при заказе внедрения под ключ у Nero Network интегратор настраивает Make/n8n, CRM, виджет и промпты."
      }
    },
    {
      "@type": "Question",
      "name": "Насколько безопасны данные клиентов?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Для 152-ФЗ используются YandexGPT/GigaChat в РФ, маскирование ПДн и договорные ограничения на хранение."
      }
    },
    {
      "@type": "Question",
      "name": "Что если AI ошибётся в ответе?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Три слоя защиты: база знаний, запрет выдумывать цены вне FAQ, эскалация на менеджера; на пилоте разбирают 50–100 диалогов."
      }
    },
    {
      "@type": "Question",
      "name": "Как быстро окупается внедрение?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Зависит от потока заявок и среднего чека; при 100+ заявках/мес проект 120–350 тыс. ₽ часто окупается за 2–6 месяцев после расчёта на аудите."
      }
    },
    {
      "@type": "Question",
      "name": "Нужна ли доработка текущего сайта?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Чаще нет — достаточно webhook с формы, JS-виджета или Telegram-ссылки."
      }
    },
    {
      "@type": "Question",
      "name": "Чем AI-агент Nero лучше amoAI / BitrixGPT?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Nero ставит автономного агента до менеджера на входящей заявке с кастомной логикой и мультиканалом."
      }
    },
    {
      "@type": "Question",
      "name": "Заменит ли AI менеджеров по продажам?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Нет — AI закрывает первичную обработку, человек ведёт переговоры и high-ticket сделки."
      }
    },
    {
      "@type": "Question",
      "name": "Сколько длится внедрение?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Типовой срок 2–4 недели: аудит, интеграция и пилот."
      }
    }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "AI-агент для обработки заявок с сайта — внедрение под ключ",
  "description": "Внедрим AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, квалификация лида и передача в CRM. Аудит потерь заявок за 30 минут — проверьте, сколько лидов уходит к конкурентам.",
  "author": {
    "@type": "Organization",
    "name": "Nero Network"
  },
  "about": "AI-агент для первичной обработки заявок с сайта"
}
</script>

<?php
get_footer();

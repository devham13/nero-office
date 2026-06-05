<?php
/**
 * Template Name: AI-менеджер для входящих звонков
 */
$page_seo_title = 'AI-менеджер для входящих звонков — внедрение под ключ';
$page_seo_description = 'Внедрим AI голосового менеджера для входящих звонков 24/7: квалификация клиента, сделка в CRM, без пропущенных обращений. Расчёт потерь от звонков — бесплатно.';
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Посчитать потери звонков';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#audit-cta';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Материалы по внедрению AI';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#';

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

$nero_bootstrap = get_stylesheet_directory() . '/partials/nero-ai-longread-bootstrap.php';
if (is_readable($nero_bootstrap)) {
    require_once $nero_bootstrap;
}

get_header();
?>

<style>


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
  min-height: 0;
  margin: 0;
  padding: 0;
  overflow: visible;
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

/* Hero-first template reset */
.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs, .yoast-breadcrumb,
.entry-header, .page-title-section { display: none !important; }
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-primary, #primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-page { margin: 0; padding: 0; overflow: visible; }

body.nero-ai-landing-shell #masthead,
body.nero-ai-landing-shell #mobile-header {
  display: none !important;
}
body.nero-ai-landing-shell {
  padding-top: 0 !important;
}
html {
  overflow-x: clip;
}
body.nero-ai-landing-shell #inner-wrap,
body.nero-ai-landing-shell #wrapper,
body.nero-ai-landing-shell .content-area,
body.nero-ai-landing-shell #content,
body.nero-ai-landing-shell .content-wrap,
body.nero-ai-landing-shell .entry-content-wrap,
body.nero-ai-landing-shell .entry-content {
  overflow: visible !important;
  max-height: none !important;
  height: auto !important;
}
body.nero-ai-landing-shell .content-area {
  margin-top: 0 !important;
  margin-bottom: 0 !important;
}
.nero-ai-hero--voice-inbound,
.nero-ai-hero {
  padding-top: clamp(108px, 14vh, 148px);
}

/* Intro after hero */
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro {
  padding: clamp(48px, 6vw, 72px) 0 clamp(28px, 4vw, 40px);
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__grid {
  display: grid;
  grid-template-columns: minmax(0, 1.15fr) minmax(280px, 0.85fr);
  gap: clamp(24px, 4vw, 40px);
  align-items: start;
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__text {
  text-align: left !important;
  border-left: 4px solid var(--nero-ai-primary);
  padding-left: clamp(18px, 3vw, 28px);
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__text p {
  text-align: left !important;
  margin: 0 0 16px;
  font-size: clamp(16px, 1.6vw, 18px);
  line-height: 1.65;
  color: var(--nero-ai-soft) !important;
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__text p:last-child { margin-bottom: 0; }
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__lead {
  font-size: clamp(17px, 1.8vw, 20px) !important;
  color: var(--nero-ai-heading) !important;
  font-weight: 650;
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__terminal {
  padding: 18px;
  border-radius: 20px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.10);
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__terminal-head {
  display: flex;
  gap: 6px;
  margin-bottom: 14px;
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__terminal-head span {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(255,255,255,.22);
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__terminal-head span:nth-child(1) { background: #fb7185; }
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__terminal-head span:nth-child(2) { background: #fbbf24; }
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__terminal-head span:nth-child(3) { background: #34d399; }
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 14px;
  padding: 0;
  list-style: none;
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__chips li {
  padding: 7px 11px;
  border-radius: 999px;
  border: 1px solid rgba(121,242,255,.22);
  background: rgba(121,242,255,.08);
  color: var(--nero-ai-primary) !important;
  font-size: 12px;
  font-weight: 700;
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__metric {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__metric div {
  padding: 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.08);
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__metric strong {
  display: block;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__metric span {
  display: block;
  margin-top: 6px;
  font-size: 11px;
  color: var(--nero-ai-muted);
  font-weight: 700;
}
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
.nero-ai-prose { max-width: 820px; }
.nero-ai-prose h3 { margin: 28px 0 12px; font-size: clamp(20px, 2.4vw, 24px); }
.nero-ai-prose p, .nero-ai-prose li { font-size: 16px; line-height: 1.68; }
.nero-ai-prose code {
  padding: 2px 6px; border-radius: 6px; background: rgba(255,255,255,.08); color: #c7d2fe;
}
.nero-ai-table-wrap { overflow-x: auto; margin: 20px 0; }
.nero-ai-table {
  width: 100%; border-collapse: collapse; font-size: 14px;
}
.nero-ai-table th, .nero-ai-table td {
  border: 1px solid rgba(255,255,255,.12); padding: 10px 12px; text-align: left;
}
.nero-ai-table th { background: rgba(121,242,255,.08); color: #fff; }
.nero-ai-faq-item {
  border: 1px solid rgba(255,255,255,.10); border-radius: 18px;
  background: rgba(255,255,255,.045); margin-bottom: 12px; overflow: hidden;
}
.nero-ai-faq-item summary {
  padding: 18px 20px; cursor: pointer; font-weight: 800; color: #fff; list-style: none;
}
.nero-ai-faq-item summary::-webkit-details-marker { display: none; }
.nero-ai-faq-item p { margin: 0; padding: 0 20px 18px; }
.nero-ai-inline-cta { margin: 28px 0; padding: clamp(24px, 4vw, 36px); }
.nero-ai-inline-cta h3 { margin: 8px 0 12px; font-size: clamp(22px, 3vw, 28px); line-height: 1.15; }
.nero-ai-secondary-cta { margin: 20px 0; padding: 20px 24px; }
.nero-ai-secondary-cta a {
  color: var(--nero-ai-primary, #79f2ff); font-weight: 700;
  text-decoration: underline; text-underline-offset: 3px;
}
@media (max-width: 900px) {
  .vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__grid { grid-template-columns: 1fr; }
}


</style>

<main id="primary" class="site-main vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-page nero-ai-home-page" role="main" tabindex="-1" style="padding-top:0;overflow:visible">
<?php
$nero_header_nav_links = [
    ['href' => '#propushchennye-zvonki', 'label' => 'Пропущенные звонки'],
    ['href' => '#chto-takoe-ai-menedzher', 'label' => 'Что такое AI'],
    ['href' => '#vnedrenie-pod-klyuch', 'label' => 'Внедрение'],
    ['href' => '#ai-dlya-zvonkov', 'label' => 'Возможности'],
    ['href' => '#audio-demo', 'label' => 'Аудиодемо'],
    ['href' => '#integraciya-crm', 'label' => 'CRM и телефония'],
    ['href' => '#dlya-biznesa', 'label' => 'Кейсы'],
    ['href' => '#faq-golosovoy', 'label' => 'FAQ'],
    ['href' => '#audit-cta', 'label' => 'Расчёт потерь'],
];
$nero_header_cta_label = $primary_cta_label;
$nero_header_cta_url = '#audit-cta';
$nero_header = get_stylesheet_directory() . '/partials/nero-ai-site-header.php';
if (is_readable($nero_header)) {
    require $nero_header;
}
?>

<section class="nero-ai-hero nero-ai-hero--voice-inbound" aria-labelledby="voice-inbound-hero-title">
<style>
.nero-ai-hero--voice-inbound {
  --nero-ai-bg: #060812;
  --nero-ai-text: #e6edf7;
  --nero-ai-muted: #9aa8bd;
  --nero-ai-soft: #c7d2e5;
  --nero-ai-heading: #ffffff;
  --nero-ai-primary: #79f2ff;
  --nero-ai-primary-2: #8b5cf6;
  --nero-ai-accent: #22c55e;
  --nero-ai-danger: #fb7185;
  --nero-ai-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  --nero-ai-container: 1220px;
  position: relative;
  min-height: min(980px, calc(100vh - 1px));
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  color: var(--nero-ai-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  background:
    radial-gradient(circle at 10% 8%, rgba(121, 242, 255, 0.14), transparent 26rem),
    radial-gradient(circle at 88% 14%, rgba(139, 92, 246, 0.18), transparent 30rem),
    radial-gradient(circle at 55% 92%, rgba(34, 197, 94, 0.06), transparent 32rem),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.nero-ai-hero--voice-inbound *,
.nero-ai-hero--voice-inbound *::before,
.nero-ai-hero--voice-inbound *::after { box-sizing: border-box; }
.nero-ai-hero--voice-inbound::before {
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
  z-index: 0;
}
.nero-ai-hero--voice-inbound::after {
  content: "";
  position: absolute;
  left: 62%;
  top: 18%;
  width: 720px;
  height: 720px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .11), transparent 66%);
  filter: blur(8px);
  animation: voiceHeroGlow 9s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes voiceHeroGlow {
  from { opacity: .4; transform: translateX(-50%) scale(.94); }
  to { opacity: .82; transform: translateX(-50%) scale(1.05); }
}
.nero-ai-hero--voice-inbound .nero-ai-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.nero-ai-hero--voice-inbound .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.nero-ai-hero--voice-inbound .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--nero-ai-primary);
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.nero-ai-hero--voice-inbound .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(40px, 6.8vw, 88px);
  line-height: .9;
  letter-spacing: -0.075em;
  color: var(--nero-ai-heading);
}
.nero-ai-hero--voice-inbound .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #ffffff 0%, var(--nero-ai-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}
.nero-ai-hero--voice-inbound .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--nero-ai-soft);
  font-size: clamp(18px, 2vw, 22px);
  line-height: 1.58;
}
.nero-ai-hero--voice-inbound .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.nero-ai-hero--voice-inbound .nero-ai-badge {
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
.nero-ai-hero--voice-inbound .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.nero-ai-hero--voice-inbound .nero-ai-btn {
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
  text-decoration: none;
  transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
}
.nero-ai-hero--voice-inbound .nero-ai-btn:hover,
.nero-ai-hero--voice-inbound .nero-ai-btn:focus-visible { transform: translateY(-2px); }
.nero-ai-hero--voice-inbound .nero-ai-btn-primary {
  color: #031018;
  background: linear-gradient(135deg, var(--nero-ai-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.nero-ai-hero--voice-inbound .nero-ai-btn-secondary {
  color: var(--nero-ai-text);
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.nero-ai-hero--voice-inbound .nero-ai-btn-secondary:hover {
  border-color: rgba(121, 242, 255, 0.36);
  background: rgba(121, 242, 255, 0.08);
}
.nero-ai-hero--voice-inbound .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--nero-ai-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.nero-ai-hero--voice-inbound .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.nero-ai-hero--voice-inbound .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.nero-ai-hero--voice-inbound .nero-ai-dots { display: flex; gap: 7px; }
.nero-ai-hero--voice-inbound .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,.22); }
.nero-ai-hero--voice-inbound .nero-ai-dot:nth-child(1) { background: #fb7185; }
.nero-ai-hero--voice-inbound .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.nero-ai-hero--voice-inbound .nero-ai-dot:nth-child(3) { background: #34d399; }
.nero-ai-hero--voice-inbound .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.nero-ai-hero--voice-inbound .nero-ai-window-body { padding: 18px; }
.nero-ai-hero--voice-inbound .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
}
.nero-ai-hero--voice-inbound .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -0.03em;
  color: var(--nero-ai-heading);
}
.nero-ai-hero--voice-inbound .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .06em;
}
.nero-ai-hero--voice-inbound .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: voiceHeroPulse 1.6s infinite;
}
@keyframes voiceHeroPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.nero-ai-hero--voice-inbound .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
.nero-ai-hero--voice-inbound .nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.nero-ai-hero--voice-inbound .nero-ai-metric:hover,
.nero-ai-hero--voice-inbound .nero-ai-metric:focus-within {
  transform: translateY(-3px);
  border-color: rgba(121,242,255,.34);
  background: rgba(121,242,255,.07);
}
.nero-ai-hero--voice-inbound .nero-ai-metric span {
  display: block;
  color: var(--nero-ai-muted);
  font-size: 12px;
  font-weight: 700;
}
.nero-ai-hero--voice-inbound .nero-ai-metric strong {
  display: block;
  margin-top: 7px;
  color: #fff;
  font-size: 24px;
  line-height: 1;
}
.nero-ai-hero--voice-inbound .nero-ai-metric small {
  display: block;
  margin-top: 6px;
  color: #9fb0c9;
  font-size: 11px;
}
.nero-ai-hero--voice-inbound .nero-ai-metric--accent strong { color: #86efac; }
.nero-ai-hero--voice-inbound .nero-ai-metric--warn strong { color: #fda4af; }
.nero-ai-hero--voice-inbound .voice-hero-canvas-wrap {
  position: relative;
  margin-top: 14px;
  height: 118px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 18px;
  background: linear-gradient(180deg, rgba(121,242,255,.04), rgba(139,92,246,.03));
  overflow: hidden;
}
.nero-ai-hero--voice-inbound #voice-inbound-hero-canvas {
  display: block;
  width: 100%;
  height: 118px;
}
.nero-ai-hero--voice-inbound .voice-hero-canvas-label {
  position: absolute;
  left: 12px;
  top: 10px;
  z-index: 2;
  padding: 4px 8px;
  border-radius: 8px;
  background: rgba(6, 10, 24, .72);
  color: #9fdcff;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .04em;
  text-transform: uppercase;
  pointer-events: none;
}
.nero-ai-hero--voice-inbound .nero-ai-call-stream {
  margin-top: 14px;
  display: grid;
  gap: 10px;
}
.nero-ai-hero--voice-inbound .nero-ai-call-item {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
  animation: voiceCallFloat 5.2s ease-in-out infinite;
}
.nero-ai-hero--voice-inbound .nero-ai-call-item:nth-child(2) { animation-delay: .7s; }
.nero-ai-hero--voice-inbound .nero-ai-call-item:nth-child(3) { animation-delay: 1.4s; }
@keyframes voiceCallFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-4px); }
}
.nero-ai-hero--voice-inbound .nero-ai-call-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--nero-ai-primary);
  font-size: 14px;
  font-weight: 800;
}
.nero-ai-hero--voice-inbound .nero-ai-call-item strong {
  display: block;
  color: #f8fafc;
  font-size: 13px;
}
.nero-ai-hero--voice-inbound .nero-ai-call-item span {
  color: var(--nero-ai-muted);
  font-size: 12px;
}
.nero-ai-hero--voice-inbound .nero-ai-status {
  padding: 5px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
}
.nero-ai-hero--voice-inbound .nero-ai-status--ring {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
.nero-ai-hero--voice-inbound .nero-ai-status--crm {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .nero-ai-hero--voice-inbound .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .nero-ai-hero--voice-inbound .nero-ai-dashboard { transform: none; }
}
@media (max-width: 820px) {
  .nero-ai-hero--voice-inbound { min-height: auto; padding-top: 56px; }
  .nero-ai-hero--voice-inbound .nero-ai-container { width: min(100% - 28px, var(--nero-ai-container)); }
}
@media (prefers-reduced-motion: reduce) {
  .nero-ai-hero--voice-inbound::after,
  .nero-ai-hero--voice-inbound .nero-ai-live-pill::before,
  .nero-ai-hero--voice-inbound .nero-ai-call-item { animation: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Голосовой AI · входящие звонки</p>
      <h1 id="voice-inbound-hero-title">AI-менеджер для входящих звонков — <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI принимает звонки 24/7, квалифицирует клиента и создаёт сделку в CRM — без пропущенных обращений и потерь к конкурентам</p>
      <ul class="nero-ai-badges" aria-label="Этапы обработки звонка">
        <li class="nero-ai-badge">Входящий звонок</li>
        <li class="nero-ai-badge">Приём 24/7</li>
        <li class="nero-ai-badge">Квалификация</li>
        <li class="nero-ai-badge">Сделка в CRM</li>
        <li class="nero-ai-badge">Запись разговора</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url(getenv('PRIMARY_CTA_URL') ?: '#audit-cta'); ?>"><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Посчитать потери звонков'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#audio-demo'); ?>"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'Послушать аудиодемо'); ?></a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Дашборд входящих звонков AI-менеджера">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">voice ai · inbound line · demo</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Входящая линия · AI-оператор</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--warn" data-nero-tooltip="AI перехватывает звонки в нерабочее время и в пик — пропуски стремятся к нулю.">
              <span>Пропущенные</span>
              <strong data-nero-count="0">0</strong>
              <small>за смену · пример</small>
            </div>
            <div class="nero-ai-metric" data-nero-tooltip="Линия принимает входящие круглосуточно без очереди на автоответчик.">
              <span>Приём линии</span>
              <strong>24/7</strong>
              <small>без выходных</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--accent" data-nero-tooltip="После звонка AI создаёт или обновляет сделку в amoCRM / Bitrix24.">
              <span>Сделок в CRM</span>
              <strong data-nero-count="7">7</strong>
              <small>за ночь · пример</small>
            </div>
            <div class="nero-ai-metric" data-nero-tooltip="Демо-метрика: среднее время первого ответа AI vs очередь оператора.">
              <span>Ответ AI</span>
              <strong>0:02</strong>
              <small>мин:сек · пример</small>
            </div>
          </div>

          <div class="voice-hero-canvas-wrap" aria-hidden="true">
            <span class="voice-hero-canvas-label">live waveform · stt</span>
            <canvas id="voice-inbound-hero-canvas" role="img" aria-label="Анимация: волны входящего звонка и пульс линии AI-оператора"></canvas>
          </div>

          <div class="nero-ai-call-stream" aria-label="Поток входящих звонков">
            <div class="nero-ai-call-item">
              <span class="nero-ai-call-icon">☎</span>
              <div><strong>Входящий с рекламы</strong><span>AI ответил за 2 сек</span></div>
              <span class="nero-ai-status nero-ai-status--ring">на линии</span>
            </div>
            <div class="nero-ai-call-item">
              <span class="nero-ai-call-icon">AI</span>
              <div><strong>Квалификация по скрипту</strong><span>Цель, срочность, бюджет</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-call-item">
              <span class="nero-ai-call-icon">CRM</span>
              <div><strong>Сделка создана</strong><span>Задача менеджеру на утро</span></div>
              <span class="nero-ai-status nero-ai-status--crm">в CRM</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  var canvas = document.getElementById('voice-inbound-hero-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var wrap = canvas.parentElement;
  var dpr = Math.min(window.devicePixelRatio || 1, 2);
  var w = 0, h = 0, t = 0;
  var rings = [];
  var bars = [];
  var BAR_COUNT = 42;

  function resize() {
    var cw = wrap.clientWidth || 320;
    var ch = 118;
    w = cw;
    h = ch;
    canvas.width = Math.floor(cw * dpr);
    canvas.height = Math.floor(ch * dpr);
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    bars = [];
    for (var i = 0; i < BAR_COUNT; i++) {
      bars.push({ phase: Math.random() * Math.PI * 2, speed: 0.04 + Math.random() * 0.03, base: 0.12 + Math.random() * 0.18 });
    }
  }

  function spawnRing() {
    rings.push({ x: w * 0.18, y: h * 0.52, r: 8, alpha: 0.55, speed: 1.2 + Math.random() * 0.6 });
  }

  function drawGrid() {
    ctx.strokeStyle = 'rgba(121, 242, 255, 0.06)';
    ctx.lineWidth = 1;
    for (var gx = 0; gx < w; gx += 28) {
      ctx.beginPath();
      ctx.moveTo(gx, 0);
      ctx.lineTo(gx, h);
      ctx.stroke();
    }
    for (var gy = 0; gy < h; gy += 24) {
      ctx.beginPath();
      ctx.moveTo(0, gy);
      ctx.lineTo(w, gy);
      ctx.stroke();
    }
  }

  function drawSwitchboard(cx, cy) {
    ctx.fillStyle = 'rgba(15, 23, 42, 0.88)';
    ctx.strokeStyle = 'rgba(121, 242, 255, 0.35)';
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.roundRect(cx - 22, cy - 16, 44, 32, 10);
    ctx.fill();
    ctx.stroke();
    ctx.fillStyle = '#79f2ff';
    ctx.beginPath();
    ctx.arc(cx, cy, 5 + Math.sin(t * 0.08) * 1.2, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = 'rgba(34, 197, 94, 0.5)';
    ctx.beginPath();
    ctx.moveTo(cx + 22, cy - 4);
    ctx.lineTo(cx + 48, cy - 10);
    ctx.moveTo(cx + 22, cy + 4);
    ctx.lineTo(cx + 48, cy + 10);
    ctx.stroke();
  }

  function drawWaveform() {
    var startX = w * 0.34;
    var endX = w - 14;
    var usable = endX - startX;
    var step = usable / BAR_COUNT;
    for (var i = 0; i < BAR_COUNT; i++) {
      var b = bars[i];
      var amp = b.base + Math.abs(Math.sin(t * b.speed + b.phase)) * 0.42;
      var bh = amp * (h * 0.72);
      var x = startX + i * step;
      var grad = ctx.createLinearGradient(0, h * 0.5 - bh, 0, h * 0.5 + bh);
      grad.addColorStop(0, 'rgba(121, 242, 255, 0.85)');
      grad.addColorStop(1, 'rgba(139, 92, 246, 0.45)');
      ctx.fillStyle = grad;
      ctx.fillRect(x, h * 0.5 - bh * 0.5, Math.max(2, step * 0.55), bh);
    }
  }

  function drawCrmPulse() {
    var px = w - 34;
    var py = h * 0.5;
    var pulse = 0.5 + Math.sin(t * 0.06) * 0.5;
    ctx.strokeStyle = 'rgba(34, 197, 94, ' + (0.25 + pulse * 0.35) + ')';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(px, py, 10 + pulse * 6, 0, Math.PI * 2);
    ctx.stroke();
    ctx.fillStyle = 'rgba(34, 197, 94, 0.9)';
    ctx.beginPath();
    ctx.arc(px, py, 4, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = 'rgba(198, 210, 229, 0.75)';
    ctx.font = '600 9px Inter, sans-serif';
    ctx.fillText('CRM', px - 11, py + 22);
  }

  function frame() {
    if (!w || !h) { requestAnimationFrame(frame); return; }
    t++;
    ctx.clearRect(0, 0, w, h);
    drawGrid();
    if (t % 90 === 0) spawnRing();
    for (var i = rings.length - 1; i >= 0; i--) {
      var ring = rings[i];
      ring.r += ring.speed;
      ring.alpha -= 0.008;
      ctx.strokeStyle = 'rgba(251, 113, 133, ' + Math.max(0, ring.alpha) + ')';
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(ring.x, ring.y, ring.r, 0, Math.PI * 2);
      ctx.stroke();
      if (ring.alpha <= 0) rings.splice(i, 1);
    }
    drawSwitchboard(w * 0.18, h * 0.52);
    drawWaveform();
    drawCrmPulse();
    requestAnimationFrame(frame);
  }

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  resize();
  window.addEventListener('resize', resize);
  frame();
})();
</script>

<section class="nero-ai-section-tight vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro" aria-label="Введение">
  <div class="nero-ai-container">
    <div class="vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__grid nero-ai-reveal">
      <div class="vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__text">
        <p class="vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__lead"><strong>Коротко:</strong> пропущенный входящий — прямой уход клиента к конкуренту. <strong>AI голосовой менеджер</strong> принимает звонки 24/7, квалифицирует запрос и создаёт сделку в CRM без ручного переноса.</p>
        <p>Ниже — сколько стоят недозвоны, как устроен голосовой AI-бот, этапы <strong>внедрения под ключ</strong>, интеграции с телефонией и CRM, российские кейсы и ответы на частые вопросы.</p>
      </div>
      <div class="vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__terminal nero-ai-reveal nero-ai-delay-1" aria-hidden="true">
        <div class="vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__terminal-head"><span></span><span></span><span></span></div>
        <ul class="vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__chips">
          <li>Приём 24/7</li>
          <li>STT → LLM → TTS</li>
          <li>amoCRM / Bitrix24</li>
          <li>SIP / Mango / UIS</li>
        </ul>
        <div class="vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-intro__metric">
          <div><strong data-nero-count="85" data-nero-suffix="%">0%</strong><span>клиентов не перезванивают после недозвона</span></div>
          <div><strong data-nero-count="0">0</strong><span>пропущенных · цель AI-линии</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<nav class="nero-ai-toc-wrap" aria-label="Оглавление">
  <ul class="nero-ai-toc nero-ai-reveal">
    <li><a href="#propushchennye-zvonki">Пропущенные звонки</a></li>
    <li><a href="#chto-takoe-ai-menedzher">Что такое AI-менеджер</a></li>
    <li><a href="#vnedrenie-pod-klyuch">Внедрение под ключ</a></li>
    <li><a href="#ai-dlya-zvonkov">AI для звонков</a></li>
    <li><a href="#audio-demo">Аудиодемо</a></li>
    <li><a href="#integraciya-crm">CRM и телефония</a></li>
    <li><a href="#dlya-biznesa">Отрасли и кейсы</a></li>
    <li><a href="#avtomatizaciya">Автоматизация</a></li>
    <li><a href="#faq-golosovoy">FAQ</a></li>
    <li><a href="#audit-cta">Расчёт потерь</a></li>
  </ul>
</nav>

<section class="nero-ai-section" id="propushchennye-zvonki"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Пропущенный звонок — потерянный клиент и упущенная выручка</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Коротко:</strong> каждый недозвон — потенциально потерянная сделка. По данным исследования Nodul (Retail.ru, апрель 2026), российский бизнес теряет от <strong>9,5 до 96,2 млн ₽ в год</strong> на одну компанию из-за пропущенных звонков — лидеры по потерям в исследовании: стоматология и медицинские клиники.</p>
<h3>Сколько стоят пропущенные входящие звонки для бизнеса</h3>
<p>Пропущенные звонки бьют по выручке в трёх точках:</p>
<ol>
<li><strong>Прямая потеря сделки</strong> — клиент, который не дозвонился, часто уходит к тому, кто ответил первым.</li>
<li><strong>Сгоревший рекламный бюджет</strong> — лид пришёл с контекста или таргета, но контакт не состоялся.</li>
<li><strong>Нагрузка на персонал</strong> — администраторы и операторы вынуждены перезванивать, теряя время на текущих клиентов.</li>
</ol>
<p>По данным Ringostat, <strong>около 85% клиентов, не дозвонившихся с первого раза, не перезванивают</strong>. Это означает: один пропущенный звонок в пиковый час — не «перезвоним завтра», а почти гарантированная потеря.</p>
<p>Для оценки масштаба используйте простую формулу:</p>
<p><strong>Упущенная выручка в месяц = (пропущенные звонки × конверсия в сделку × средний чек)</strong></p>
<p>Если в месяц 200 входящих звонков, 15% пропускается (30 звонков), конверсия 20%, средний чек 15 000 ₽ — потери составляют <strong>90 000 ₽/мес</strong> или <strong>1,08 млн ₽/год</strong> только на «недозвонах».</p>
<h3>Почему клиенты уходят к конкурентам после недозвона</h3>
<p>Типичные причины:</p>
<ul>
<li><strong>Время ожидания</strong> — клиент не готов слушать гудки или автоответчик.</li>
<li><strong>Нерабочие часы</strong> — звонок вечером или в выходной, когда офис закрыт.</li>
<li><strong>Перегруз линии</strong> — пиковый поток (запись к врачу, сезон в автосервисе, акция в недвижимости).</li>
<li><strong>Отсутствие фиксации</strong> — звонок «потерялся» между администратором и менеджером, сделка в CRM не создана.</li>
</ul>
<p>В 2026 году ожидание мгновенного ответа стало нормой: по прогнозу Gartner (цитата в обзоре IBM, 2026), к <strong>2028 году не менее 70% клиентов начнут путь взаимодействия с брендом через conversational AI</strong>. Компании, которые не закрывают входящую линию, проигрывают не только в сервисе, но и в скорости обработки лида.</p>
<h3>Калькулятор потерь от пропущенных звонков</h3>
<p><strong>Лид-магнит Nero Network:</strong> бесплатный расчёт упущенной выручки от пропущенных звонков.</p>
<p>Для расчёта нужны четыре цифры из вашей телефонии или CRM:</p>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>Параметр</th><th>Что вводить</th></tr>
<tr><td>Входящих звонков в месяц</td><td>Статистика АТС</td></tr>
<tr><td>% пропущенных</td><td>Отчёт Mango / UIS / Zadarma</td></tr>
<tr><td>Конверсия звонка в сделку</td><td>CRM-воронка</td></tr>
<tr><td>Средний чек</td><td>Финансовый отчёт</td></tr>
</table></div>
<p>Модель ROI для голосовых агентов (адаптация международной практики Retell AI) учитывает containment rate — долю звонков, закрытых без оператора, и стоимость минуты AI vs стоимость звонка живого сотрудника.</p>
<aside class="nero-ai-inline-cta nero-ai-card nero-ai-reveal" aria-label="Расчёт потерь от пропущенных звонков">
  <p class="nero-ai-eyebrow">Лид-магнит · бесплатно</p>
  <h3>Посчитайте, сколько выручки уходит из-за пропущенных звонков</h3>
  <p>Введите объём входящих, долю пропусков, конверсию и средний чек — получите оценку упущенной выручки в месяц и год и поймёте, окупится ли <strong>внедрение ai голосовой менеджер</strong> в вашем случае.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside>
</div></div></section>
<section class="nero-ai-section nero-ai-section-alt" id="chto-takoe-ai-menedzher"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Что такое AI-менеджер для входящих звонков</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Определение:</strong> <strong>AI-менеджер для входящих звонков</strong> — голосовой AI-агент, подключённый к телефонии компании (виртуальная АТС, SIP, облачный номер), который принимает вызовы, ведёт диалог на естественном русском языке, квалифицирует обращение и создаёт или обновляет лид в CRM.</p>
<p>Цепочка обработки: <strong>STT (распознавание речи) → LLM (понимание намерения и генерация ответа) → TTS (синтез речи)</strong>. При необходимости звонок переводится на живого менеджера с контекстом и записью разговора.</p>
<p><strong>AI голосовой менеджер</strong> отличается от классического IVR тем, что понимает вариативные формулировки, а не только нажатие кнопок. По данным Neuro.net (2026), рынок перешёл от сценарных ботов к <strong>intent-based</strong> диалогам — агент распознаёт намерение, а не ждёт точной фразы из скрипта.</p>
<h3>Как голосовой AI-бот принимает и обрабатывает звонок</h3>
<p>Типовой сценарий (проектная модель Nero Network):</p>
<ol>
<li>Клиент звонит на многоканальный номер → виртуальная АТС направляет вызов на AI-линию (или при отсутствии ответа оператора за N секунд).</li>
<li>AI произносит уведомление о записи разговора (требование 152-ФЗ) → принимает запрос.</li>
<li>STT (Yandex SpeechKit streaming, latency 200–500 мс) → LLM (YandexGPT / GigaChat / Claude) с RAG по базе знаний клиента → TTS (SpeechKit v3, <250–300 мс).</li>
<li>AI собирает имя, цель, срочность, бюджет/услугу, удобное время → создаёт лид/сделку в CRM через API.</li>
<li>При низкой уверенности или просьбе клиента — blind transfer на менеджера + карточка с резюме звонка в CRM.</li>
</ol>
<p>Эталон масштаба в России — <strong>Робот Макс</strong> на линии Госуслуг: 100% входящего голосового трафика обрабатывается LLM-роботом с RAG, SSML-адаптацией ответов и оптимизацией latency пайплайна (generation-ai.ru).</p>
<h3>AI виртуальный оператор vs IVR и живой колл-центр</h3>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>Критерий</th><th>IVR («нажмите 1»)</th><th>AI виртуальный оператор</th><th>Живой колл-центр</th></tr>
<tr><td>Понимание свободной речи</td><td>Нет</td><td>Да (LLM)</td><td>Да</td></tr>
<tr><td>Время ответа</td><td>Мгновенно</td><td>1–3 сек (STT+LLM+TTS)</td><td>15–60 сек (очередь)</td></tr>
<tr><td>Работа 24/7</td><td>Да</td><td>Да</td><td>Дорого / смены</td></tr>
<tr><td>Стоимость контакта</td><td>Низкая</td><td>3,5–35 ₽/мин (Mango, sostav.ru)</td><td>ФОТ + АТС</td></tr>
<tr><td>Создание сделки в CRM</td><td>Редко</td><td>Автоматически</td><td>Вручную (риск ошибки)</td></tr>
<tr><td>Эскалация на человека</td><td>Ограничена</td><td>С контекстом и записью</td><td>Нативно</td></tr>
<tr><td>FCR (решение с первого контакта)</td><td>Низкий на сложных запросах</td><td>40–63% по кейсам (Boostra, Самолет Плюс)</td><td>Высокий на сложных</td></tr>
</table></div>
<p><strong>Итог:</strong> IVR подходит для простой маршрутизации. <strong>AI для звонков</strong> закрывает квалификацию и CRM. Живые операторы нужны для сложных переговоров, жалоб и нестандартных кейсов.</p>
<h3>Когда бизнесу нужен ai для звонков, а не только операторы</h3>
<p>Сигналы, что пора внедрять <strong>голосовой ai бот</strong>:</p>
<ul>
<li><strong>Более 100–150 входящих звонков в месяц</strong> — окупаемость AI vs оператор наступает от этой отметки (sostav.ru: при 200 звонках/мес экономия 22–60 тыс. ₽/мес).</li>
<li><strong>Пропуски в нерабочее время</strong> — клиники, юристы, автосервисы теряют лиды вечером и в выходные.</li>
<li><strong>Пиковые нагрузки</strong> — 6 филиалов клиник «Тонус» (200 000+ пациентов) разгрузили регистратуру голосовым роботом Neuro.net.</li>
<li><strong>Реклама без обратной связи</strong> — лид с сайта или контекста звонит, но линия занята.</li>
<li><strong>Нет единой фиксации в CRM</strong> — звонки не превращаются в сделки автоматически.</li>
</ul>
<p>По оценке UIS, <strong>до 70% обращений в колл-центр — стандартные вопросы</strong>, которые ИИ может обработать без оператора.</p>
</div></div></section>
<!-- BORIS: после H2 «Что такое AI-менеджер» -->
<div class="nero-ai-container">
<section class="boris-voice-split" id="vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block" aria-label="Схема голосового пайплайна STT → LLM → TTS → CRM">
<style>
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block.boris-voice-split {
  --boris-bg: rgba(11, 16, 32, 0.82);
  --boris-border: rgba(255, 255, 255, 0.12);
  --boris-cyan: #79f2ff;
  --boris-violet: #8b5cf6;
  --boris-green: #22c55e;
  --boris-amber: #f59e0b;
  --boris-text: #e6edf7;
  --boris-muted: #9aa8bd;
  margin: clamp(36px, 5vw, 52px) 0 clamp(44px, 6vw, 60px);
  padding: 0;
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-voice-card {
  display: grid;
  grid-template-columns: 1fr;
  gap: clamp(24px, 3vw, 36px);
  padding: clamp(24px, 4vw, 40px);
  border-radius: 24px;
  background:
    radial-gradient(circle at 8% 12%, rgba(121, 242, 255, 0.1), transparent 42%),
    radial-gradient(circle at 92% 78%, rgba(139, 92, 246, 0.14), transparent 38%),
    var(--boris-bg);
  border: 1px solid var(--boris-border);
  box-shadow: 0 28px 80px rgba(0, 0, 0, 0.38);
  backdrop-filter: blur(14px);
}
@media (min-width: 1024px) {
  #vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-voice-card {
    grid-template-columns: 1.05fr 0.95fr;
    align-items: center;
    gap: 40px;
  }
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 14px;
  padding: 7px 12px;
  border-radius: 999px;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--boris-cyan);
  background: rgba(121, 242, 255, 0.08);
  border: 1px solid rgba(121, 242, 255, 0.22);
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-kicker {
  margin: 0 0 12px;
  font-size: clamp(22px, 2.5vw, 30px);
  line-height: 1.18;
  font-weight: 800;
  letter-spacing: -0.03em;
  color: #fff;
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-bridge {
  margin: 0 0 20px;
  font-size: 15px;
  line-height: 1.58;
  color: var(--boris-muted);
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-points {
  display: grid;
  gap: 12px;
  margin: 0 0 20px;
  padding: 0;
  list-style: none;
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-points li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 14px;
  line-height: 1.48;
  color: var(--boris-text);
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-points li::before {
  content: "";
  flex: 0 0 8px;
  width: 8px;
  height: 8px;
  margin-top: 7px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--boris-cyan), var(--boris-violet));
  box-shadow: 0 0 10px rgba(121, 242, 255, 0.45);
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 12px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 700;
  color: var(--boris-text);
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.1);
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-pill strong {
  color: var(--boris-green);
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-canvas-wrap {
  position: relative;
  min-height: 400px;
  border-radius: 20px;
  overflow: hidden;
  background:
    linear-gradient(180deg, rgba(5, 7, 17, 0.35) 0%, rgba(8, 11, 23, 0.92) 100%),
    radial-gradient(circle at 30% 25%, rgba(121, 242, 255, 0.12), transparent 50%),
    radial-gradient(circle at 75% 70%, rgba(139, 92, 246, 0.1), transparent 45%);
  border: 1px solid rgba(125, 249, 255, 0.18);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.06);
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block #golosovoy-pipeline-canvas {
  display: block;
  width: 100%;
  height: 100%;
  min-height: 400px;
}
#vnedrenie-ai-golosovoy-menedzher-vhodashchie-zvonki-boris-block .boris-caption {
  position: absolute;
  left: 14px;
  right: 14px;
  bottom: 12px;
  margin: 0;
  padding: 9px 12px;
  border-radius: 12px;
  font-size: 11px;
  line-height: 1.4;
  color: var(--boris-muted);
  background: rgba(8, 11, 23, 0.88);
  border: 1px solid rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(8px);
  pointer-events: none;
}
</style>

<div class="boris-voice-card nero-ai-reveal">
  <div class="boris-voice-copy">
    <p class="boris-eyebrow">Голосовой пайплайн · под капотом</p>
    <h3 class="boris-kicker">От звонка до сделки в CRM — за 1–3 секунды ответа</h3>
    <p class="boris-bridge">На hero — дашборд входящих и KPI линии; здесь — как <strong>ai голосовой менеджер</strong> обрабатывает разговор: распознаёт речь, понимает намерение, отвечает голосом и фиксирует лид без ручного переноса.</p>
    <ul class="boris-points">
      <li><strong>STT</strong> — потоковое распознавание русской речи (200–500&nbsp;мс)</li>
      <li><strong>LLM + RAG</strong> — квалификация по скрипту и базе знаний компании</li>
      <li><strong>TTS</strong> — естественный синтез ответа клиенту (&lt;300&nbsp;мс)</li>
      <li><strong>CRM API</strong> — контакт, сделка и задача менеджеру сразу после звонка</li>
    </ul>
    <div class="boris-pills" aria-hidden="true">
      <span class="boris-pill"><strong>1–3</strong> сек ответ</span>
      <span class="boris-pill">SpeechKit · YandexGPT</span>
      <span class="boris-pill">amoCRM / Bitrix24</span>
    </div>
  </div>

  <div class="boris-canvas-wrap">
    <canvas id="golosovoy-pipeline-canvas" role="img" aria-label="Анимация: входящий звонок проходит STT, LLM, TTS и создаёт сделку в CRM"></canvas>
    <p class="boris-caption">Цикл: звонок → STT → LLM → TTS → CRM. Дальше — этапы внедрения под ключ и интеграции с вашей телефонией.</p>
  </div>
</div>

<script>
(function golosovoyPipelineEngine() {
  var canvas = document.getElementById('golosovoy-pipeline-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var wrap = canvas.parentElement;
  var cw = 0, ch = 0, frame = 0, dpr = 1;

  var C = {
    ink: '#e6edf7',
    muted: '#9aa8bd',
    line: 'rgba(255,255,255,0.14)',
    cyan: '#79f2ff',
    violet: '#8b5cf6',
    green: '#22c55e',
    amber: '#f59e0b',
    rose: '#fb7185',
    card: 'rgba(17,24,39,0.92)',
    cardEdge: 'rgba(255,255,255,0.12)'
  };

  var nodes = [];
  var pulse = { stage: 0, t: 0 };
  var waveform = [];
  var bubbles = [];
  var crmFields = 0;
  var latencyMs = 0;

  for (var w = 0; w < 48; w++) waveform.push(0);

  function resize() {
    if (!wrap) return;
    dpr = Math.min(window.devicePixelRatio || 1, 2);
    cw = wrap.clientWidth || 480;
    ch = Math.max(400, Math.min(540, cw * 0.78));
    canvas.width = Math.floor(cw * dpr);
    canvas.height = Math.floor(ch * dpr);
    canvas.style.height = ch + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    layoutNodes();
  }

  function layoutNodes() {
    var pad = 24;
    var y = ch * 0.48;
    var span = cw - pad * 2;
    var xs = [0.06, 0.26, 0.46, 0.66, 0.86].map(function (f) { return pad + span * f; });
    nodes = [
      { id: 'call', x: xs[0], y: y, label: 'Звонок', color: C.rose, icon: 'call' },
      { id: 'stt', x: xs[1], y: y, label: 'STT', color: C.cyan, icon: 'stt' },
      { id: 'llm', x: xs[2], y: y, label: 'LLM', color: C.violet, icon: 'llm' },
      { id: 'tts', x: xs[3], y: y, label: 'TTS', color: C.green, icon: 'tts' },
      { id: 'crm', x: xs[4], y: y, label: 'CRM', color: C.amber, icon: 'crm' }
    ];
  }

  function rr(x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function drawGrid() {
    ctx.strokeStyle = 'rgba(121, 242, 255, 0.06)';
    ctx.lineWidth = 1;
    for (var gx = 0; gx < cw; gx += 28) {
      ctx.beginPath(); ctx.moveTo(gx, 0); ctx.lineTo(gx, ch); ctx.stroke();
    }
    for (var gy = 0; gy < ch; gy += 28) {
      ctx.beginPath(); ctx.moveTo(0, gy); ctx.lineTo(cw, gy); ctx.stroke();
    }
  }

  function drawPaths() {
    for (var i = 0; i < nodes.length - 1; i++) {
      var a = nodes[i], b = nodes[i + 1];
      var mx = (a.x + b.x) / 2;
      var my = a.y - 42 - (i % 2) * 8;
      ctx.strokeStyle = C.line;
      ctx.lineWidth = 2;
      ctx.setLineDash([5, 7]);
      ctx.beginPath();
      ctx.moveTo(a.x + 30, a.y);
      ctx.quadraticCurveTo(mx, my, b.x - 30, b.y);
      ctx.stroke();
      ctx.setLineDash([]);
      var flow = (frame * 0.035 + i * 0.18) % 1;
      var t = flow;
      var px = (1 - t) * (1 - t) * (a.x + 30) + 2 * (1 - t) * t * mx + t * t * (b.x - 30);
      var py = (1 - t) * (1 - t) * a.y + 2 * (1 - t) * t * my + t * t * b.y;
      ctx.fillStyle = b.color;
      ctx.shadowColor = b.color;
      ctx.shadowBlur = 8;
      ctx.beginPath(); ctx.arc(px, py, 3.5, 0, Math.PI * 2); ctx.fill();
      ctx.shadowBlur = 0;
    }
  }

  function drawCallIcon(n, active) {
    var s = 30;
    rr(n.x - s, n.y - s, s * 2, s * 2, 14, C.card, C.cardEdge);
    if (active > 0) {
      ctx.strokeStyle = n.color;
      ctx.globalAlpha = 0.2 + active * 0.4;
      ctx.lineWidth = 2;
      ctx.beginPath(); ctx.arc(n.x, n.y, s + 6 + active * 8, 0, Math.PI * 2); ctx.stroke();
      ctx.globalAlpha = 1;
    }
    ctx.fillStyle = n.color;
    ctx.beginPath();
    ctx.moveTo(n.x - 8, n.y - 12);
    ctx.quadraticCurveTo(n.x - 14, n.y, n.x - 8, n.y + 12);
    ctx.lineTo(n.x + 4, n.y + 8);
    ctx.quadraticCurveTo(n.x + 12, n.y + 2, n.x + 10, n.y - 6);
    ctx.quadraticCurveTo(n.x + 8, n.y - 14, n.x - 2, n.y - 12);
    ctx.closePath();
    ctx.fill();
    var wx = n.x - 18, wy = n.y + 22;
    for (var i = 0; i < 12; i++) {
      var h = waveform[i] * 14 + 2;
      ctx.fillStyle = 'rgba(121,242,255,' + (0.35 + waveform[i] * 0.5) + ')';
      rr(wx + i * 3, wy - h / 2, 2, h, 1, ctx.fillStyle, null);
    }
  }

  function drawSttIcon(n, active) {
    var s = 30;
    rr(n.x - s, n.y - s, s * 2, s * 2, 14, C.card, C.cardEdge);
    if (active > 0) {
      ctx.strokeStyle = n.color;
      ctx.globalAlpha = 0.25 + active * 0.35;
      ctx.lineWidth = 2;
      ctx.beginPath(); ctx.arc(n.x, n.y, s + 6, 0, Math.PI * 2); ctx.stroke();
      ctx.globalAlpha = 1;
    }
    ctx.fillStyle = n.color;
    ctx.font = '700 10px Inter, system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('Алло, запись', n.x, n.y - 2);
    ctx.font = '600 8px Inter, sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('на приём…', n.x, n.y + 10);
  }

  function drawLlmIcon(n, active) {
    var s = 30;
    rr(n.x - s, n.y - s, s * 2, s * 2, 14, C.card, C.cardEdge);
    ctx.fillStyle = n.color;
    ctx.beginPath(); ctx.arc(n.x, n.y, 10, 0, Math.PI * 2); ctx.fill();
    for (var k = 0; k < 8; k++) {
      var ang = k / 8 * Math.PI * 2 + frame * 0.04;
      ctx.strokeStyle = 'rgba(139,92,246,' + (0.35 + active * 0.4) + ')';
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.moveTo(n.x + Math.cos(ang) * 12, n.y + Math.sin(ang) * 12);
      ctx.lineTo(n.x + Math.cos(ang) * 20, n.y + Math.sin(ang) * 20);
      ctx.stroke();
    }
    ctx.fillStyle = C.ink;
    ctx.font = '700 9px Inter, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('intent', n.x, n.y + 3);
  }

  function drawTtsIcon(n, active) {
    var s = 30;
    rr(n.x - s, n.y - s, s * 2, s * 2, 14, C.card, C.cardEdge);
    ctx.fillStyle = n.color;
    rr(n.x - 10, n.y - 8, 8, 16, 2, n.color, null);
    rr(n.x + 4, n.y - 12, 8, 24, 2, n.color, null);
    for (var r = 0; r < 3; r++) {
      var rad = 14 + r * 5 + active * 6 + Math.sin(frame * 0.08 + r) * 2;
      ctx.strokeStyle = 'rgba(34,197,94,' + (0.25 - r * 0.06) + ')';
      ctx.lineWidth = 2;
      ctx.beginPath(); ctx.arc(n.x + 14, n.y, rad, -0.5, 0.5); ctx.stroke();
    }
  }

  function drawCrmIcon(n, active) {
    var s = 30;
    rr(n.x - s, n.y - s, s * 2, s * 2, 14, C.card, C.cardEdge);
    rr(n.x - 14, n.y - 16, 28, 32, 4, 'rgba(255,255,255,0.06)', C.cardEdge);
    rr(n.x - 10, n.y - 10, 20, 4, 2, n.color, null);
    rr(n.x - 10, n.y - 2, 14, 3, 1, C.muted, null);
    rr(n.x - 10, n.y + 6, 16, 3, 1, C.muted, null);
    if (active > 0.2) {
      var prog = Math.min(1, active);
      rr(n.x - 12, n.y + 20, 24 * prog, 5, 2, C.green, null);
    }
  }

  function drawNode(n, idx) {
    var stageT = pulse.t * 5;
    var local = stageT - idx;
    var active = local > 0 && local < 1 ? Math.sin(local * Math.PI) : 0;
    if (n.icon === 'call') drawCallIcon(n, active);
    else if (n.icon === 'stt') drawSttIcon(n, active);
    else if (n.icon === 'llm') drawLlmIcon(n, active);
    else if (n.icon === 'tts') drawTtsIcon(n, active);
    else drawCrmIcon(n, Math.max(0, local));
    ctx.fillStyle = C.ink;
    ctx.font = '600 11px Inter, system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(n.label, n.x, n.y + 38);
  }

  function spawnBubble(x, y, text) {
    bubbles.push({ x: x, y: y, text: text, life: 0 });
  }

  function drawBubbles() {
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life += 1;
      var a = Math.max(0, 1 - b.life / 85);
      ctx.globalAlpha = a;
      var tw = ctx.measureText(b.text).width + 18;
      rr(b.x - tw / 2, b.y - 24 - b.life * 0.35, tw, 22, 9, C.card, C.cardEdge);
      ctx.fillStyle = C.ink;
      ctx.font = '600 10px Inter, sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(b.text, b.x, b.y - 10 - b.life * 0.35);
      ctx.globalAlpha = 1;
      if (b.life > 85) bubbles.splice(i, 1);
    }
  }

  function drawLatencyHud() {
    var boxW = 132, boxH = 40;
    rr(14, 14, boxW, boxH, 12, C.card, C.cardEdge);
    ctx.fillStyle = C.muted;
    ctx.font = '600 10px Inter, sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Latency пайплайна', 24, 28);
    ctx.fillStyle = C.cyan;
    ctx.font = '800 15px Inter, sans-serif';
    ctx.fillText(latencyMs + ' мс', 24, 44);
    var liveX = cw - 90;
    rr(liveX, 14, 76, 28, 999, 'rgba(34,197,94,0.12)', 'rgba(34,197,94,0.35)');
    ctx.fillStyle = C.green;
    ctx.font = '700 11px Inter, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('● LIVE', liveX + 38, 32);
  }

  function tickWaveform() {
    for (var i = waveform.length - 1; i > 0; i--) waveform[i] = waveform[i - 1];
    var stage = Math.floor(pulse.t * 5);
    var amp = stage === 0 || stage === 1 ? 0.4 + Math.random() * 0.55 : 0.08 + Math.random() * 0.12;
    waveform[0] = amp;
  }

  function tickCycle() {
    pulse.t += 0.0038;
    latencyMs = Math.min(2800, Math.floor(pulse.t * 7200));
    if (pulse.t >= 1) {
      pulse.t = 0;
      crmFields = 0;
      latencyMs = 0;
      bubbles.length = 0;
    }
    var stage = Math.floor(pulse.t * 5);
    if (stage === 1 && Math.abs(pulse.t * 5 - 1.05) < 0.02) spawnBubble(nodes[1].x, nodes[1].y - 36, 'Распознано: запись на приём');
    if (stage === 2 && Math.abs(pulse.t * 5 - 2.05) < 0.02) spawnBubble(nodes[2].x, nodes[2].y - 36, 'Квалификация: срочно');
    if (stage === 3 && Math.abs(pulse.t * 5 - 3.05) < 0.02) spawnBubble(nodes[3].x, nodes[3].y - 36, 'Ответ клиенту…');
    if (stage === 4 && crmFields < 3 && pulse.t > 0.82) {
      crmFields++;
      var labels = ['Контакт создан', 'Сделка: new_lead', 'Задача менеджеру'];
      spawnBubble(nodes[4].x, nodes[4].y - 40, labels[crmFields - 1]);
    }
  }

  function draw() {
    ctx.clearRect(0, 0, cw, ch);
    drawGrid();
    drawPaths();
    for (var i = 0; i < nodes.length; i++) drawNode(nodes[i], i);
    drawBubbles();
    drawLatencyHud();
    tickWaveform();
    tickCycle();
    frame++;
    requestAnimationFrame(draw);
  }

  window.addEventListener('resize', resize);
  resize();
  draw();
})();
</script>
</section>
</div>
<section class="nero-ai-section" id="vnedrenie-pod-klyuch"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Внедрение AI голосового менеджера под ключ</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Коротко:</strong> <strong>внедрение ai голосовой менеджер под ключ</strong> — это не покупка «минут робота», а проект: аудит звонков, сценарии, интеграция телефонии и CRM, пилот и запуск. Ориентир бюджета Nero Network: <strong>250–800 тыс. ₽</strong> в зависимости от сложности интеграций и числа сценариев.</p>
<h3>Этапы внедрения: аудит звонков → сценарии → запуск</h3>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>Этап</th><th>Срок</th><th>Содержание</th></tr>
<tr><td>1. Аудит</td><td>2–3 дня</td><td>Карта входящих сценариев, часы пиков, % пропущенных, поля CRM, юридические требования к записи</td></tr>
<tr><td>2. Проектирование</td><td>3–5 дней</td><td>Диалоги, правила эскалации, поля сделки, голос и тон бренда</td></tr>
<tr><td>3. Интеграция</td><td>5–10 дней</td><td>SIP/вебхук телефонии → AI-backend → CRM API; n8n/Make для оркестрации</td></tr>
<tr><td>4. Пилот</td><td>2 недели</td><td>20–30% трафика на AI, A/B с операторами, доработка по транскриптам</td></tr>
<tr><td>5. Прод</td><td>1 день</td><td>100% в нерабочее время + overflow в рабочее; еженедельный разбор</td></tr>
</table></div>
<p>Поэтапный rollout подтверждён кейсом <strong>Ренессанс Страхование + targetAI</strong> (Ведомости, 2026): за 3 недели доля звонков, обрабатываемых агентом, выросла с <strong>5% до 100%</strong>; за 2 месяца автоматизировано <strong>52%</strong> обращений.</p>
<h3>Разработка и настройка ai голосовой менеджер под задачи компании</h3>
<p><strong>Настройка ai голосовой менеджер</strong> включает:</p>
<ul>
<li><strong>Диалоговый движок + RAG</strong> — FAQ, прайс, расписание из Notion/Google Docs или Yandex AI Studio.</li>
<li><strong>Голос и тон</strong> — SSML-адаптация, скорость речи, приветствие с названием компании.</li>
<li><strong>Правила квалификации</strong> — скрипт продаж или сценарий записи (клиника, автосервис, консультация юриста).</li>
<li><strong>Панель модерации</strong> — просмотр проблемных диалогов, дообучение базы знаний.</li>
</ul>
<p><strong>Разработка ai голосовой менеджер</strong> для МСБ (клиника, автосервис, юрфирма, учебный центр) с 100–500 входящих/мес, amoCRM или Bitrix24 и облачной телефонией Mango/UIS/Zadarma — типовой профиль проекта Nero Network.</p>
<h3>Сроки, стоимость и что входит в «под ключ»</h3>
<p><strong>Что входит в пакет «под ключ»:</strong></p>
<ul>
<li>Аудит и проектирование сценариев</li>
<li>Подключение к телефонии (SIP, Mango API, UIS webhooks, Asterisk)</li>
<li>Voice AI pipeline (STT → LLM → TTS, streaming)</li>
<li>CRM-коннектор (amoCRM / Bitrix24 REST)</li>
<li>Запись и хранение аудио на серверах в РФ</li>
<li>Дашборд метрик: принято, пропущено, FCR, время ответа</li>
<li>Обучение команды и 2 недели сопровождения после запуска</li>
</ul>
<p><strong>Ориентиры по стоимости:</strong></p>
<ul>
<li>Проектное <strong>внедрение под ключ</strong>: 250–800 тыс. ₽ (Google Таблица, приоритет темы 10/10)</li>
<li>Эксплуатация: от <strong>3,5 ₽/мин</strong> (Mango голосовой робот) до <strong>25–35 ₽/мин</strong> для AI-колл-центра МСБ (sostav.ru)</li>
<li>При 200 звонках/мес AI дешевле оператора на <strong>22–60 тыс. ₽/мес</strong></li>
</ul>
<h3>Как внедрить ai голосовой менеджер без остановки телефонии</h3>
<p><strong>Интеграция ai голосовой менеджер</strong> не требует смены номера:</p>
<ol>
<li>Подключается параллельная AI-линия на существующей АТС.</li>
<li>Пилот идёт на 20–30% трафика (ночные часы, overflow).</li>
<li>Операторы продолжают работать днём на сложных сделках.</li>
<li>После стабилизации — гибридная модель: AI ночью и в пик, человек на переговорах.</li>
</ol>
<p>Так работает <strong>Самолет Плюс</strong>: через SIP определяется объект по номеру, данные фиксируются в CRM Topnlab, ~<strong>40% звонков автоматизировано</strong>, время разговора сократилось с 1,5 до 0,75 мин, экономия ~<strong>30 млн ₽/год</strong> при 500+ тыс. входящих звонков в год.</p>
<aside class="nero-ai-secondary-cta nero-ai-card nero-ai-reveal nero-ai-delay-1" aria-label="Материалы по внедрению AI">
  <p class="nero-ai-eyebrow">Для команды до старта проекта</p>
  <p>Перед запуском голосового AI полезно разобраться в архитектуре агентов, интеграциях с CRM и телефонией — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>: практические материалы по <strong>внедрению ai агентов</strong> и автоматизации без лишней теории.</p>
</aside>
</div></div></section>
<section class="nero-ai-section nero-ai-section-alt" id="ai-dlya-zvonkov"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>AI для звонков: что умеет голосовой AI-бот на входящей линии</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>AI отвечает на звонки</strong> не как автоответчик, а как первый контур приёма: принимает, понимает, квалифицирует, фиксирует в CRM.</p>
<h3>Приём звонков 24/7 и маршрутизация обращений</h3>
<p><strong>AI принимает звонки 24/7</strong> без очереди. Mango Office заявляет до <strong>100 одновременных входящих</strong> на голосовом роботе.</p>
<p>Маршрутизация:</p>
<ul>
<li>По номеру входящей линии (филиал, рекламный канал)</li>
<li>По намерению клиента (запись, консультация, жалоба)</li>
<li>По правилам overflow — на оператора при занятости или по таймауту</li>
</ul>
<p>Кейс <strong>Boostra + Fromtech</strong> (РБК Компании): LLM-ассистент обрабатывает <strong>100% входящих</strong>, <strong>63% запросов</strong> закрывает без оператора, устранены пропущенные звонки и ожидание на линии.</p>
<h3>Квалификация лида по скрипту продаж или записи</h3>
<p><strong>AI оператор звонков</strong> собирает структурированные данные:</p>
<ul>
<li>Имя и контакт</li>
<li>Цель обращения (услуга, продукт)</li>
<li>Срочность и бюджет</li>
<li>Удобное время для обратного звонка или визита</li>
<li>Источник (если коллтрекинг)</li>
</ul>
<p>Данные сразу попадают в поля сделки CRM — без ручного переноса администратором.</p>
<h3>Запись разговора, транскрипция и аналитика звонков</h3>
<p>Каждый звонок:</p>
<ul>
<li>Записывается (с предупреждением до начала — требование законодательства о ПДн)</li>
<li>Транскрибируется для разбора качества</li>
<li>Получает краткое резюме для менеджера при эскалации</li>
</ul>
<p>Аналитика: принято / пропущено, FCR, среднее время разговора (AHT). У Ренессанс Страхование AHT агента — <strong>100 сек</strong>.</p>
<h3 id="audio-demo">Аудиодемо: как звучит ai оператор звонков</h3>
<p>На странице — <strong>аудиодемо</strong> трёх сценариев (тип страницы от Nero Network):</p>
<ol>
<li><strong>Клиника</strong> — запись на приём, перенос визита</li>
<li><strong>Автосервис</strong> — запись на ТО, уточнение услуги</li>
<li><strong>Юрист</strong> — первичная консультация, сбор вводных</li>
</ol>
<p>Послушайте, как <strong>голосовой ai бот</strong> звучит на русском языке, прежде чем заказывать <strong>внедрение ai голосовой менеджер</strong>.</p>
</div></div></section>
<section class="nero-ai-section" id="integraciya-crm"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Интеграция AI голосового менеджера с CRM и телефонией</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Без CRM <strong>ai телефония</strong> — просто автоответчик. Ценность — в автоматическом создании сделки.</p>
<h3>ai голосовой менеджер с CRM: amoCRM, Bitrix24 и другие</h3>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>CRM</th><th>Возможности интеграции</th></tr>
<tr><td><strong>amoCRM</strong></td><td>200+ виджетов телефонии, Voximplant Kit, REST API для лидов и задач</td></tr>
<tr><td><strong>Bitrix24</strong></td><td>SIP-коннектор, Маркетплейс: Zvonobot, Robovoice, Tomoru</td></tr>
<tr><td><strong>Другие</strong></td><td>Webhook + n8n/Make/Albato/ApiMonster</td></tr>
</table></div>
<p><strong>Интеграция ai голосовой менеджер с CRM</strong> создаёт: контакт, сделку, задачу ответственному, запись звонка в карточке.</p>
<h3>Подключение к Mango, UIS, Zadarma, Asterisk, SIP</h3>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>Телефония</th><th>Способ подключения</th></tr>
<tr><td>Mango Office</td><td>API, голосовой робот от 3,5 ₽/мин</td></tr>
<tr><td>UIS</td><td>IVR + API webhooks</td></tr>
<tr><td>Zadarma</td><td>SIP, облачный номер</td></tr>
<tr><td>MTS Exolve</td><td>SIP</td></tr>
<tr><td>Asterisk</td><td>ARI / AudioSocket (on-prem)</td></tr>
</table></div>
<p><strong>SIP телефония ai бот</strong> подключается к существующей АТС без смены номера. Для компаний с собственной Asterisk — редкий у конкурентов, но востребованный сценарий (callsphere.ai, интеграции 2026).</p>
<h3>Автоматическое создание сделки и задачи после звонка</h3>
<p>После завершения диалога AI:</p>
<ol>
<li>Создаёт или обновляет лид/сделку/контакт</li>
<li>Заполняет поля квалификации</li>
<li>Назначает ответственного по правилам (филиал, услуга, round-robin)</li>
<li>Ставит задачу «перезвонить» или «подготовить КП»</li>
<li>Отправляет SMS/Telegram-уведомление клиенту (запись подтверждена)</li>
</ol>
<p>Паттерн API-интеграции телефонии ↔ CRM подтверждён кейсом <strong>Ак Барс Банк + Voximplant</strong>: HTTP API между платформами, возврат статуса и причины отказа в CRM.</p>
<h3>Интеграция ai голосовой менеджер с CRM без ручного переноса данных</h3>
<p>Ручной перенос — главная точка потери лидов. <strong>Голосовой бот интеграция CRM</strong> через API устраняет:</p>
<ul>
<li>Ошибки при записи номера телефона</li>
<li>Забытые перезвоны</li>
<li>Дубли контактов</li>
<li>Разрыв между «приняли звонок» и «создали сделку»</li>
</ul>
<p>Связка <strong>входящий номер → объект в CRM → сделка</strong> — ключевой результат, а не «минуты робота».</p>
</div></div></section>
<section class="nero-ai-section nero-ai-section-alt" id="dlya-biznesa"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>AI голосовой менеджер для бизнеса: отрасли и кейсы</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Российский рынок технологий для контакт-центров оценивается в <strong>18–20 млрд ₽</strong> (TAdviser, через MightyCall, 2026); ИИ — ключевой драйвер роста. Публичных кейсов по входящим/голосовым AI — <strong>10+</strong>.</p>
<h3>Клиники и медицинские центры</h3>
<p><strong>Голосовой бот для клиники</strong> — один из самых понятных сценариев:</p>
<ul>
<li><strong>МЕДСИ + SL Soft:</strong> голосовой ИИ-агент с записью/переносом/отменой визитов, проверкой ДМС, расчётом стоимости; понимает неформальные названия врачей и клиник.</li>
<li><strong>Сеть «Тонус» + Neuro.net:</strong> запись, перенос, отмена, справки, навигация ДМС/ОМС; 6 филиалов, 200 000+ пациентов.</li>
</ul>
<p>Боль: нагрузка на call-центр, запись <strong>24/7</strong>, пиковые часы. Потери от пропущенных звонков в стоматологии — лидеры в исследовании Nodul (до 96,2 млн ₽/год).</p>
<h3>Недвижимость, юристы и консалтинг</h3>
<p><strong>Голосовой бот для недвижимости:</strong></p>
<ul>
<li><strong>Самолет Плюс:</strong> 500+ тыс. входящих/год, ~40% автоматизации, 85% клиентов положительно воспринимают ИИ (Ольга Цыганкова, руководитель КЦ).</li>
<li><strong>Rich Life Estate:</strong> 1236 клиентов обработано голосовым роботом, 672 подтвердили актуальность, 254 согласились на просмотр, 67 сделок — воронка «звонок → квалификация → CRM».</li>
</ul>
<p>Для юристов и консалтинга AI собирает вводные для первичной консультации: тема, срочность, формат (очно/онлайн), бюджет.</p>
<h3>Автосервисы, обучение и сервисные компании</h3>
<p><strong>Автомир + VS Robotics</strong> (Сбер): робот-оператор для сервисных центров — ~<strong>20% сервисных звонков</strong>, 100% контактов успешно в пилоте; сезонные пики без найма операторов.</p>
<p>Учебные центры: запись на пробное занятие, ответы о расписании и стоимости курсов, квалификация по уровню подготовки.</p>
<h3>Примеры внедрения и ai голосовой менеджер кейсы</h3>
<p>Сводка российских метрик:</p>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>Компания</th><th>Отрасль</th><th>Результат</th></tr>
<tr><td>Boostra</td><td>Финтех</td><td>100% приёма, 63% без оператора</td></tr>
<tr><td>Ренессанс Страхование</td><td>Страхование</td><td>5%→100% за 3 нед., 52% автоматизации за 2 мес.</td></tr>
<tr><td>Самолет Плюс</td><td>Недвижимость</td><td>40% автоматизации, −30 млн ₽/год</td></tr>
<tr><td>МЕДСИ</td><td>Медицина</td><td>Запись 24/7, ДМС, неформальные запросы</td></tr>
<tr><td>Автомир</td><td>Автосервис</td><td>20% звонков, 100% успех в пилоте</td></tr>
<tr><td>Госуслуги (Робот Макс)</td><td>Госсектор</td><td>100% голосового трафика на LLM</td></tr>
</table></div>
<h3>AI голосовой менеджер для малого бизнеса: когда окупается</h3>
<p><strong>AI голосовой менеджер для малого бизнеса</strong> окупается, когда:</p>
<ul>
<li>Есть <strong>50+ пропущенных звонков в месяц</strong> — даже при малом объёме AI закрывает нерабочее время.</li>
<li>Средний чек от <strong>5 000 ₽</strong> — одна спасённая сделка покрывает неделю минут робота.</li>
<li>Нет штатного администратора на полный день — AI заменяет «виртуальную регистратуру».</li>
</ul>
<p>При 150+ звонках/мес окупаемость наступает быстрее (ориентир sostav.ru). Гибридная модель снижает риск: AI ночью, человек днём.</p>
</div></div></section>
<section class="nero-ai-section" id="avtomatizaciya"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Автоматизация входящих звонков через AI-агентов</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Автоматизация входящих звонков</strong> — часть более широкого <strong>внедрения ai агентов</strong> в клиентский сервис.</p>
<h3>Связка голосового AI с другими ai-агентами (заявки, follow-up)</h3>
<p>Единая экосистема:</p>
<ul>
<li><strong>Входящий звонок</strong> → квалификация → CRM</li>
<li><strong>Заявка с сайта</strong> → тот же AI-номер или чат-агент</li>
<li><strong>Follow-up</strong> → исходящее подтверждение (кейс Гемотест + RoboVoice: напоминание о визите, фиксация в МИС)</li>
</ul>
<p><strong>Внедрение ai решений</strong> для контакт-центра — не один бот, а оркестрация агентов (IBM watsonx Orchestrate: agentic AI координирует специализированных агентов и 1000+ enterprise-приложений).</p>
<h3>Внедрение ai агентов в контакт-центр: тренды 2026</h3>
<p>Ключевые тренды (IBM, Neuro.net, Gartner):</p>
<ul>
<li>Переход от экспериментов к <strong>операционной устойчивости</strong> LLM-агентов</li>
<li><strong>Agentic AI</strong> — модульный выбор STT/TTS (Deepgram <300 мс, ElevenLabs premium TTS)</li>
<li>Снижение нагрузки на операторов на <strong>20–30%</strong> в пик; стоимость контакта ↓ в <strong>1,5–1,8 раза</strong> (РБК / Neuro.net)</li>
<li>Фокус на <strong>containment rate</strong> и AHT, а не на «роботе ради робота»</li>
</ul>
<p>«В 2026 году вопрос уже не в том, использовать ли голосовой AI, а в какой именно AI и в какой роли» — Neuro.net, январь 2026.</p>
<h3>ROI: ai телефония vs расширение штата операторов</h3>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>Показатель</th><th>+2 оператора</th><th>AI голосовой менеджер</th></tr>
<tr><td>ФОТ в месяц</td><td>80–160 тыс. ₽</td><td>0 (разовое внедрение)</td></tr>
<tr><td>Эксплуатация</td><td>АТС, обучение, текучка</td><td>3,5–35 ₽/мин</td></tr>
<tr><td>Ночные смены</td><td>Дорого / невозможно</td><td>Включено</td></tr>
<tr><td>Масштабирование в пик</td><td>Найм за недели</td><td>До 100 линий (Mango)</td></tr>
<tr><td>CRM-фиксация</td><td>Зависит от дисциплины</td><td>Автоматически</td></tr>
<tr><td>Окупаемость</td><td>Постоянные затраты</td><td>От 100–200 звонков/мес</td></tr>
</table></div>
<p>Международный бенчмарк Retell AI: <strong>$0.11/мин</strong> AI vs <strong>$2.70–5.60</strong> за звонок оператора при containment rate 65%.</p>
<p><strong>Внедрение ai в бизнес</strong> через голосовой канал — один из самых понятных коммерческих кейсов AI в 2026 году: измеримый вход (звонки), измеримый выход (сделки в CRM), прозрачный ROI.</p>
</div></div></section>
<section class="nero-ai-section nero-ai-section-alt" id="faq-golosovoy"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>FAQ: внедрение, цена, качество и юридические вопросы</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<details class="nero-ai-faq-item"><summary>Сколько стоит ai голосовой менеджер и от чего зависит цена</summary><p><strong>AI голосовой менеджер цена</strong> складывается из сложности сценариев, числа интеграций, типа телефонии и объёма трафика. Проектное <strong>внедрение под ключ</strong>: <strong>250–800 тыс. ₽</strong>. Эксплуатация: от <strong>3,5 ₽/мин</strong>. Для точной сметы — расчёт потерь от пропущенных звонков и заявка на аудит.</p></details>
<details class="nero-ai-faq-item"><summary>Качество русского языка, задержка ответа (latency)</summary><p>Yandex SpeechKit STT streaming: <strong>200–500 мс</strong>. TTS v3: <strong>до 250–300 мс</strong>. Суммарная задержка ответа AI — <strong>1–3 секунды</strong>, что сопоставимо с ожиданием оператора в очереди. Качество диалога важнее факта AI: доля клиентов, не готовых общаться с ботом у Ренессанс, снизилась с <strong>60% до 30%</strong> после доработки сценариев.</p></details>
<details class="nero-ai-faq-item"><summary>Законность записи разговоров и обработки персональных данных</summary><p>Нужно предупреждение о записи до начала разговора, локализация ПДн в РФ (с 01.07.2025), политика обработки на сайте и в договоре, серверы записи и транскрипции в РФ (Yandex SpeechKit, YandexGPT). Юридический блок — редкий дифференциатор vs вендоры, которые продают минуты без проработки compliance.</p></details>
<details class="nero-ai-faq-item"><summary>Можно ли заменить весь колл-центр ai виртуальным оператором</summary><p><strong>Нет</strong> — и это не цель. Гибридная модель эффективнее: AI на типовых запросах, нерабочее время и overflow; человек — на сложных переговорах и жалобах. Boostra закрывает 63% без оператора, Ренессанс автоматизирует 52% — остальное идёт на эскалацию.</p></details>
</div></div></section>
<section class="nero-ai-section" id="audit-cta-section"><div class="nero-ai-container"><div class="nero-ai-final-cta nero-ai-card nero-ai-reveal" id="audit-cta">
  <h2>Посчитать потери от пропущенных звонков и заказать внедрение</h2>
  <p>Nero Network реализует AI-менеджера для входящих «от звонка до сделки в CRM»: аудит линии за 2–3 дня, интеграция с вашей телефонией и amoCRM / Bitrix24, пилот на 20–30% трафика. Ориентир чека — 250–800 тыс. ₽, срок запуска — 3–5 недель.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
    <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>
  </div>
</div></div></section>

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
  "@type": "Article",
  "headline": "AI-менеджер для входящих звонков — внедрение под ключ",
  "description": "Внедрим AI голосового менеджера для входящих звонков 24/7: квалификация клиента, сделка в CRM, без пропущенных обращений.",
  "author": {"@type": "Organization", "name": "Nero Network"},
  "mainEntityOfPage": {"@type": "WebPage"},
  "about": {"@type": "Service", "name": "Внедрение AI голосового менеджера для входящих звонков"}
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type": "Question", "name": "Сколько стоит ai голосовой менеджер и от чего зависит цена", "acceptedAnswer": {"@type": "Answer", "text": "Проектное внедрение под ключ: 250–800 тыс. ₽. Эксплуатация: от 3,5 ₽/мин."}},
    {"@type": "Question", "name": "Качество русского языка, задержка ответа (latency)", "acceptedAnswer": {"@type": "Answer", "text": "Суммарная задержка ответа AI — 1–3 секунды. Yandex SpeechKit STT: 200–500 мс, TTS: <250–300 мс."}},
    {"@type": "Question", "name": "Законность записи разговоров и обработки персональных данных", "acceptedAnswer": {"@type": "Answer", "text": "Предупреждение о записи до начала разговора, локализация ПДн в РФ, политика на сайте."}},
    {"@type": "Question", "name": "Можно ли заменить весь колл-центр ai виртуальным оператором", "acceptedAnswer": {"@type": "Answer", "text": "Нет — гибридная модель эффективнее: AI на типовых запросах, человек на сложных переговорах."}}
  ]
}
</script>

<?php get_footer(); ?>

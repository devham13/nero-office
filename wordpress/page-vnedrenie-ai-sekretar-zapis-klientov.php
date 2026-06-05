<?php
/**
 * Template Name: AI-секретарь для записи клиентов
 */
$page_seo_title = 'AI-секретарь для записи клиентов — внедрение под ключ';
$page_seo_description = 'Голосовой AI-секретарь подбирает свободное время, записывает клиента на услугу и отправляет подтверждение. Внедрение для салонов, клиник и студий — меньше нагрузки на администратора.';
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить сценарий записи';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#scenario-cta';
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
#vnedrenie-ai-sekretar-zapis-klientov-primary, #primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}
.vnedrenie-ai-sekretar-zapis-klientov-page { margin: 0; padding: 0; overflow: visible; }

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
.nero-ai-hero--sekretar-booking,
.nero-ai-hero {
  padding-top: clamp(108px, 14vh, 148px);
}

/* Intro after hero */
.vnedrenie-ai-sekretar-zapis-klientov-intro {
  padding: clamp(48px, 6vw, 72px) 0 clamp(28px, 4vw, 40px);
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__grid {
  display: grid;
  grid-template-columns: minmax(0, 1.15fr) minmax(280px, 0.85fr);
  gap: clamp(24px, 4vw, 40px);
  align-items: start;
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__text {
  text-align: left !important;
  border-left: 4px solid var(--nero-ai-primary);
  padding-left: clamp(18px, 3vw, 28px);
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__text p {
  text-align: left !important;
  margin: 0 0 16px;
  font-size: clamp(16px, 1.6vw, 18px);
  line-height: 1.65;
  color: var(--nero-ai-soft) !important;
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__text p:last-child { margin-bottom: 0; }
.vnedrenie-ai-sekretar-zapis-klientov-intro__lead {
  font-size: clamp(17px, 1.8vw, 20px) !important;
  color: var(--nero-ai-heading) !important;
  font-weight: 650;
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__terminal {
  padding: 18px;
  border-radius: 20px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.10);
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__terminal-head {
  display: flex;
  gap: 6px;
  margin-bottom: 14px;
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__terminal-head span {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(255,255,255,.22);
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__terminal-head span:nth-child(1) { background: #fb7185; }
.vnedrenie-ai-sekretar-zapis-klientov-intro__terminal-head span:nth-child(2) { background: #fbbf24; }
.vnedrenie-ai-sekretar-zapis-klientov-intro__terminal-head span:nth-child(3) { background: #34d399; }
.vnedrenie-ai-sekretar-zapis-klientov-intro__chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 14px;
  padding: 0;
  list-style: none;
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__chips li {
  padding: 7px 11px;
  border-radius: 999px;
  border: 1px solid rgba(121,242,255,.22);
  background: rgba(121,242,255,.08);
  color: var(--nero-ai-primary) !important;
  font-size: 12px;
  font-weight: 700;
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__metric {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__metric div {
  padding: 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.08);
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__metric strong {
  display: block;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnedrenie-ai-sekretar-zapis-klientov-intro__metric span {
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
  .vnedrenie-ai-sekretar-zapis-klientov-intro__grid { grid-template-columns: 1fr; }
}



</style>

<main id="primary" class="site-main vnedrenie-ai-sekretar-zapis-klientov-page nero-ai-home-page" role="main" tabindex="-1" style="padding-top:0;overflow:visible">
<?php
$nero_header_nav_links = [
    ['href' => '#chto-takoe-ai-sekretar', 'label' => 'Что такое AI-секретарь'],
    ['href' => '#lost-bookings-pain', 'label' => 'Потери записей'],
    ['href' => '#booking-demo', 'label' => 'Демо записи'],
    ['href' => '#booking-scenario', 'label' => 'Сценарий'],
    ['href' => '#integraciya-crm', 'label' => 'CRM и календари'],
    ['href' => '#vnedrenie-pod-klyuch', 'label' => 'Внедрение'],
    ['href' => '#keisy', 'label' => 'Кейсы'],
    ['href' => '#faq-sekretar', 'label' => 'FAQ'],
    ['href' => '#scenario-cta', 'label' => 'Сценарий записи'],
];
$nero_header_cta_label = $primary_cta_label;
$nero_header_cta_url = '#scenario-cta';
$nero_header = get_stylesheet_directory() . '/partials/nero-ai-site-header.php';
if (is_readable($nero_header)) {
    require $nero_header;
}
?>

<section class="nero-ai-hero nero-ai-hero--sekretar-booking" aria-labelledby="sekretar-booking-hero-title">
<style>
.nero-ai-hero--sekretar-booking {
  --nero-ai-bg: #060812;
  --nero-ai-text: #e6edf7;
  --nero-ai-muted: #9aa8bd;
  --nero-ai-soft: #c7d2e5;
  --nero-ai-heading: #ffffff;
  --nero-ai-primary: #79f2ff;
  --nero-ai-primary-2: #8b5cf6;
  --nero-ai-accent: #22c55e;
  --nero-ai-warn: #f59e0b;
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
    radial-gradient(circle at 8% 10%, rgba(121, 242, 255, 0.13), transparent 26rem),
    radial-gradient(circle at 92% 12%, rgba(139, 92, 246, 0.17), transparent 30rem),
    radial-gradient(circle at 50% 95%, rgba(34, 197, 94, 0.07), transparent 32rem),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.nero-ai-hero--sekretar-booking *,
.nero-ai-hero--sekretar-booking *::before,
.nero-ai-hero--sekretar-booking *::after { box-sizing: border-box; }
.nero-ai-hero--sekretar-booking::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 40% 26%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: 0;
}
.nero-ai-hero--sekretar-booking::after {
  content: "";
  position: absolute;
  left: 64%;
  top: 20%;
  width: 680px;
  height: 680px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(34, 197, 94, .09), transparent 66%);
  filter: blur(8px);
  animation: sekretarHeroGlow 8.5s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes sekretarHeroGlow {
  from { opacity: .38; transform: translateX(-50%) scale(.93); }
  to { opacity: .78; transform: translateX(-50%) scale(1.04); }
}
.nero-ai-hero--sekretar-booking .nero-ai-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.nero-ai-hero--sekretar-booking .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.nero-ai-hero--sekretar-booking .nero-ai-eyebrow {
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
.nero-ai-hero--sekretar-booking .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 6.4vw, 86px);
  line-height: .9;
  letter-spacing: -0.075em;
  color: var(--nero-ai-heading);
}
.nero-ai-hero--sekretar-booking .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #ffffff 0%, var(--nero-ai-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}
.nero-ai-hero--sekretar-booking .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--nero-ai-soft);
  font-size: clamp(18px, 2vw, 22px);
  line-height: 1.58;
}
.nero-ai-hero--sekretar-booking .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.nero-ai-hero--sekretar-booking .nero-ai-badge {
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
.nero-ai-hero--sekretar-booking .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.nero-ai-hero--sekretar-booking .nero-ai-btn {
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
.nero-ai-hero--sekretar-booking .nero-ai-btn:hover,
.nero-ai-hero--sekretar-booking .nero-ai-btn:focus-visible { transform: translateY(-2px); }
.nero-ai-hero--sekretar-booking .nero-ai-btn-primary {
  color: #031018;
  background: linear-gradient(135deg, var(--nero-ai-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.nero-ai-hero--sekretar-booking .nero-ai-btn-secondary {
  color: var(--nero-ai-text);
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.nero-ai-hero--sekretar-booking .nero-ai-btn-secondary:hover {
  border-color: rgba(121, 242, 255, 0.36);
  background: rgba(121, 242, 255, 0.08);
}
.nero-ai-hero--sekretar-booking .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--nero-ai-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.nero-ai-hero--sekretar-booking .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.nero-ai-hero--sekretar-booking .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.nero-ai-hero--sekretar-booking .nero-ai-dots { display: flex; gap: 7px; }
.nero-ai-hero--sekretar-booking .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,.22); }
.nero-ai-hero--sekretar-booking .nero-ai-dot:nth-child(1) { background: #fb7185; }
.nero-ai-hero--sekretar-booking .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.nero-ai-hero--sekretar-booking .nero-ai-dot:nth-child(3) { background: #34d399; }
.nero-ai-hero--sekretar-booking .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.nero-ai-hero--sekretar-booking .nero-ai-window-body { padding: 18px; }
.nero-ai-hero--sekretar-booking .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 14px;
}
.nero-ai-hero--sekretar-booking .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -0.03em;
  color: var(--nero-ai-heading);
}
.nero-ai-hero--sekretar-booking .nero-ai-live-pill {
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
.nero-ai-hero--sekretar-booking .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: sekretarHeroPulse 1.6s infinite;
}
@keyframes sekretarHeroPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.nero-ai-hero--sekretar-booking .sekretar-slot-strip {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 14px;
}
.nero-ai-hero--sekretar-booking .sekretar-slot {
  padding: 7px 11px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 12px;
  background: rgba(255,255,255,.04);
  color: #c7d2e5;
  font-size: 12px;
  font-weight: 700;
  white-space: nowrap;
  transition: border-color .2s, background .2s, color .2s;
}
.nero-ai-hero--sekretar-booking .sekretar-slot--free {
  border-color: rgba(121,242,255,.28);
  background: rgba(121,242,255,.08);
  color: #a5f3fc;
}
.nero-ai-hero--sekretar-booking .sekretar-slot--booked {
  border-color: rgba(139,92,246,.24);
  background: rgba(139,92,246,.10);
  color: #ddd6fe;
}
.nero-ai-hero--sekretar-booking .sekretar-slot--busy {
  opacity: .45;
  text-decoration: line-through;
}
.nero-ai-hero--sekretar-booking .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
.nero-ai-hero--sekretar-booking .nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.nero-ai-hero--sekretar-booking .nero-ai-metric:hover,
.nero-ai-hero--sekretar-booking .nero-ai-metric:focus-within {
  transform: translateY(-3px);
  border-color: rgba(121,242,255,.34);
  background: rgba(121,242,255,.07);
}
.nero-ai-hero--sekretar-booking .nero-ai-metric span {
  display: block;
  color: var(--nero-ai-muted);
  font-size: 12px;
  font-weight: 700;
}
.nero-ai-hero--sekretar-booking .nero-ai-metric strong {
  display: block;
  margin-top: 7px;
  color: #fff;
  font-size: 24px;
  line-height: 1;
}
.nero-ai-hero--sekretar-booking .nero-ai-metric small {
  display: block;
  margin-top: 6px;
  color: #9fb0c9;
  font-size: 11px;
}
.nero-ai-hero--sekretar-booking .nero-ai-metric--accent strong { color: #86efac; }
.nero-ai-hero--sekretar-booking .nero-ai-metric--warn strong { color: #fcd34d; }
.nero-ai-hero--sekretar-booking .nero-ai-metric--danger strong { color: #fda4af; }
.nero-ai-hero--sekretar-booking .sekretar-hero-canvas-wrap {
  position: relative;
  margin-top: 14px;
  height: 128px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 18px;
  background: linear-gradient(180deg, rgba(139,92,246,.05), rgba(34,197,94,.04));
  overflow: hidden;
}
.nero-ai-hero--sekretar-booking #sekretar-booking-hero-canvas {
  display: block;
  width: 100%;
  height: 128px;
}
.nero-ai-hero--sekretar-booking .sekretar-hero-canvas-label {
  position: absolute;
  left: 12px;
  top: 10px;
  z-index: 2;
  padding: 4px 8px;
  border-radius: 8px;
  background: rgba(6, 10, 24, .72);
  color: #c4b5fd;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .04em;
  text-transform: uppercase;
  pointer-events: none;
}
.nero-ai-hero--sekretar-booking .nero-ai-booking-stream {
  margin-top: 14px;
  display: grid;
  gap: 10px;
}
.nero-ai-hero--sekretar-booking .nero-ai-booking-item {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
  animation: sekretarBookingFloat 5.4s ease-in-out infinite;
}
.nero-ai-hero--sekretar-booking .nero-ai-booking-item:nth-child(2) { animation-delay: .8s; }
.nero-ai-hero--sekretar-booking .nero-ai-booking-item:nth-child(3) { animation-delay: 1.6s; }
@keyframes sekretarBookingFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-4px); }
}
.nero-ai-hero--sekretar-booking .nero-ai-booking-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(139,92,246,.14);
  color: #c4b5fd;
  font-size: 13px;
  font-weight: 800;
}
.nero-ai-hero--sekretar-booking .nero-ai-booking-item strong {
  display: block;
  color: #f8fafc;
  font-size: 13px;
}
.nero-ai-hero--sekretar-booking .nero-ai-booking-item span {
  color: var(--nero-ai-muted);
  font-size: 12px;
}
.nero-ai-hero--sekretar-booking .nero-ai-status {
  padding: 5px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
}
.nero-ai-hero--sekretar-booking .nero-ai-status--slot {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
.nero-ai-hero--sekretar-booking .nero-ai-status--sms {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .nero-ai-hero--sekretar-booking .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .nero-ai-hero--sekretar-booking .nero-ai-dashboard { transform: none; }
}
@media (max-width: 820px) {
  .nero-ai-hero--sekretar-booking { min-height: auto; padding-top: 56px; }
  .nero-ai-hero--sekretar-booking .nero-ai-container { width: min(100% - 28px, var(--nero-ai-container)); }
}
@media (prefers-reduced-motion: reduce) {
  .nero-ai-hero--sekretar-booking::after,
  .nero-ai-hero--sekretar-booking .nero-ai-live-pill::before,
  .nero-ai-hero--sekretar-booking .nero-ai-booking-item { animation: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">AI-секретарь · запись на услуги</p>
      <h1 id="sekretar-booking-hero-title">AI-секретарь для записи клиентов на услуги — <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI подбирает время, записывает клиента и отправляет подтверждение — без перегруза администратора</p>
      <ul class="nero-ai-badges" aria-label="Этапы сценария записи">
        <li class="nero-ai-badge">Заявка клиента</li>
        <li class="nero-ai-badge">Подбор слота</li>
        <li class="nero-ai-badge">Запись в календарь</li>
        <li class="nero-ai-badge">SMS-подтверждение</li>
        <li class="nero-ai-badge">Напоминание</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#booking-demo">Посмотреть демо записи</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Дашборд AI-секретаря: календарь, слоты и записи">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">booking ai · calendar · demo</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Расписание · AI-секретарь</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>

          <div class="sekretar-slot-strip" aria-label="Слоты на сегодня">
            <span class="sekretar-slot sekretar-slot--busy">09:00</span>
            <span class="sekretar-slot sekretar-slot--booked">10:30</span>
            <span class="sekretar-slot sekretar-slot--free">12:00</span>
            <span class="sekretar-slot sekretar-slot--booked">14:30</span>
            <span class="sekretar-slot sekretar-slot--free">16:00</span>
            <span class="sekretar-slot sekretar-slot--busy">17:30</span>
          </div>

          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--accent" data-nero-tooltip="AI фиксирует каждую заявку в календаре — администратор не ведёт записи вручную.">
              <span>Записей сегодня</span>
              <strong data-nero-count="12">12</strong>
              <small>через AI · пример</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--danger" data-nero-tooltip="No-show — клиенты, не пришедшие на приём. Напоминания AI снижают долю пропусков.">
              <span>No-show</span>
              <strong data-nero-count="18" data-nero-prefix="−" data-nero-suffix="%">−18%</strong>
              <small>к пилоту · пример</small>
            </div>
            <div class="nero-ai-metric" data-nero-tooltip="Свободные окна в расписании мастеров — AI предлагает только актуальные слоты.">
              <span>Свободных слотов</span>
              <strong data-nero-count="7">7</strong>
              <small>на неделю · пример</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--warn" data-nero-tooltip="SMS и мессенджер: клиент получает подтверждение сразу после записи.">
              <span>Подтверждений</span>
              <strong data-nero-count="94" data-nero-suffix="%">94%</strong>
              <small>SMS / WA · пример</small>
            </div>
          </div>

          <div class="sekretar-hero-canvas-wrap" aria-hidden="true">
            <span class="sekretar-hero-canvas-label">live booking · calendar</span>
            <canvas id="sekretar-booking-hero-canvas" role="img" aria-label="Анимация: клиент выбирает слот, AI подтверждает запись и отправляет напоминание"></canvas>
          </div>

          <div class="nero-ai-booking-stream" aria-label="Поток записей AI-секретаря">
            <div class="nero-ai-booking-item">
              <span class="nero-ai-booking-icon">☎</span>
              <div><strong>Клиент: «Запишите на стрижку»</strong><span>Голосовой AI уточнил дату</span></div>
              <span class="nero-ai-status nero-ai-status--slot">слот 12:00</span>
            </div>
            <div class="nero-ai-booking-item">
              <span class="nero-ai-booking-icon">📅</span>
              <div><strong>Календарь YClients / CRM</strong><span>Мастер Ирина · 45 мин</span></div>
              <span class="nero-ai-status">занято</span>
            </div>
            <div class="nero-ai-booking-item">
              <span class="nero-ai-booking-icon">✉</span>
              <div><strong>SMS-подтверждение отправлено</strong><span>Напоминание за 24 ч</span></div>
              <span class="nero-ai-status nero-ai-status--sms">доставлено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  var canvas = document.getElementById('sekretar-booking-hero-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var wrap = canvas.parentElement;
  var dpr = Math.min(window.devicePixelRatio || 1, 2);
  var w = 0, h = 0, t = 0;
  var CYCLE = 320;
  var phase = 0;
  var smsWaves = [];
  var particles = [];

  var DAYS = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
  var SLOTS_PER_DAY = 3;

  function resize() {
    var cw = wrap.clientWidth || 320;
    var ch = 128;
    w = cw;
    h = ch;
    canvas.width = Math.floor(cw * dpr);
    canvas.height = Math.floor(ch * dpr);
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function roundRect(x, y, rw, rh, r) {
    if (ctx.roundRect) {
      ctx.beginPath();
      ctx.roundRect(x, y, rw, rh, r);
      return;
    }
    ctx.beginPath();
    ctx.moveTo(x + r, y);
    ctx.lineTo(x + rw - r, y);
    ctx.quadraticCurveTo(x + rw, y, x + rw, y + r);
    ctx.lineTo(x + rw, y + rh - r);
    ctx.quadraticCurveTo(x + rw, y + rh, x + rw - r, y + rh);
    ctx.lineTo(x + r, y + rh);
    ctx.quadraticCurveTo(x, y + rh, x, y + rh - r);
    ctx.lineTo(x, y + r);
    ctx.quadraticCurveTo(x, y, x + r, y);
    ctx.closePath();
  }

  function drawGrid() {
    ctx.strokeStyle = 'rgba(121, 242, 255, 0.05)';
    ctx.lineWidth = 1;
    for (var gx = 0; gx < w; gx += 32) {
      ctx.beginPath();
      ctx.moveTo(gx, 0);
      ctx.lineTo(gx, h);
      ctx.stroke();
    }
    for (var gy = 0; gy < h; gy += 26) {
      ctx.beginPath();
      ctx.moveTo(0, gy);
      ctx.lineTo(w, gy);
      ctx.stroke();
    }
  }

  function drawCalendarHub(ox, oy, ow, oh) {
    var cellW = ow / 7;
    var cellH = oh / (SLOTS_PER_DAY + 1);
    ctx.fillStyle = 'rgba(15, 23, 42, 0.88)';
    ctx.strokeStyle = 'rgba(121, 242, 255, 0.28)';
    ctx.lineWidth = 1.2;
    roundRect(ox, oy, ow, oh, 10);
    ctx.fill();
    ctx.stroke();

    ctx.font = '700 9px Inter, sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    for (var d = 0; d < 7; d++) {
      var dx = ox + d * cellW + cellW * 0.5;
      var dy = oy + cellH * 0.55;
      ctx.fillStyle = d === 2 ? '#79f2ff' : 'rgba(198, 210, 229, 0.7)';
      ctx.fillText(DAYS[d], dx, dy);
    }

    var highlightDay = 2;
    var highlightSlot = 1;
    var cycleSlot = Math.floor((phase % 120) / 40) % SLOTS_PER_DAY;
    if (phase >= 40 && phase < 200) {
      highlightSlot = cycleSlot;
    }

    for (var row = 0; row < SLOTS_PER_DAY; row++) {
      for (var col = 0; col < 7; col++) {
        var sx = ox + col * cellW + 3;
        var sy = oy + cellH + row * cellH + 3;
        var sw = cellW - 6;
        var sh = cellH - 6;
        var booked = (col + row) % 4 === 0;
        var isTarget = col === highlightDay && row === highlightSlot && phase >= 40;
        var isConfirmed = col === highlightDay && row === highlightSlot && phase >= 160;

        if (isConfirmed) {
          ctx.fillStyle = 'rgba(34, 197, 94, 0.35)';
          ctx.strokeStyle = 'rgba(34, 197, 94, 0.65)';
        } else if (isTarget) {
          var pulse = 0.5 + Math.sin(t * 0.12) * 0.5;
          ctx.fillStyle = 'rgba(121, 242, 255, ' + (0.18 + pulse * 0.22) + ')';
          ctx.strokeStyle = 'rgba(121, 242, 255, 0.75)';
        } else if (booked) {
          ctx.fillStyle = 'rgba(139, 92, 246, 0.18)';
          ctx.strokeStyle = 'rgba(139, 92, 246, 0.35)';
        } else {
          ctx.fillStyle = 'rgba(255, 255, 255, 0.04)';
          ctx.strokeStyle = 'rgba(255, 255, 255, 0.08)';
        }
        roundRect(sx, sy, sw, sh, 4);
        ctx.fill();
        ctx.stroke();

        if (isConfirmed) {
          ctx.strokeStyle = '#86efac';
          ctx.lineWidth = 2;
          ctx.beginPath();
          ctx.moveTo(sx + sw * 0.28, sy + sh * 0.55);
          ctx.lineTo(sx + sw * 0.44, sy + sh * 0.72);
          ctx.lineTo(sx + sw * 0.74, sy + sh * 0.32);
          ctx.stroke();
        }
      }
    }
  }

  function drawClientRequest(cx, cy) {
    if (phase < 10 || phase > 220) return;
    var enter = Math.min(1, (phase - 10) / 25);
    var exit = phase > 190 ? Math.max(0, 1 - (phase - 190) / 30) : 1;
    var alpha = enter * exit;
    var bx = cx - 90 + Math.min(phase, 80) * 1.1;

    ctx.globalAlpha = alpha;
    ctx.fillStyle = 'rgba(251, 113, 133, 0.9)';
    ctx.beginPath();
    ctx.arc(bx, cy, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = 'rgba(6, 10, 24, 0.82)';
    roundRect(bx + 12, cy - 14, 78, 28, 8);
    ctx.fill();
    ctx.strokeStyle = 'rgba(251, 113, 133, 0.45)';
    ctx.lineWidth = 1;
    ctx.stroke();
    ctx.fillStyle = '#fda4af';
    ctx.font = '600 9px Inter, sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('запись?', bx + 18, cy + 1);
    ctx.globalAlpha = 1;
  }

  function drawBookingArrow(fromX, fromY, toX, toY) {
    if (phase < 50 || phase > 150) return;
    var prog = Math.min(1, (phase - 50) / 60);
    var mx = fromX + (toX - fromX) * prog;
    var my = fromY + (toY - fromY) * prog - Math.sin(prog * Math.PI) * 18;

    ctx.strokeStyle = 'rgba(121, 242, 255, 0.55)';
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 4]);
    ctx.beginPath();
    ctx.moveTo(fromX, fromY);
    ctx.quadraticCurveTo((fromX + toX) * 0.5, fromY - 24, mx, my);
    ctx.stroke();
    ctx.setLineDash([]);

    ctx.fillStyle = '#79f2ff';
    ctx.beginPath();
    ctx.arc(mx, my, 4, 0, Math.PI * 2);
    ctx.fill();
  }

  function spawnSmsWave(x, y) {
    smsWaves.push({ x: x, y: y, r: 6, alpha: 0.7 });
  }

  function spawnParticles(x, y) {
    for (var i = 0; i < 6; i++) {
      particles.push({
        x: x,
        y: y,
        vx: (Math.random() - 0.5) * 2.2,
        vy: -1.2 - Math.random() * 1.8,
        life: 40 + Math.random() * 20,
        max: 60,
        color: i % 2 ? '#86efac' : '#c4b5fd'
      });
    }
  }

  function drawSmsNode(sx, sy) {
    if (phase < 170) return;
    var pulse = 0.5 + Math.sin(t * 0.1) * 0.5;
    ctx.fillStyle = 'rgba(15, 23, 42, 0.9)';
    ctx.strokeStyle = 'rgba(139, 92, 246, 0.45)';
    ctx.lineWidth = 1.5;
    roundRect(sx - 20, sy - 14, 40, 28, 9);
    ctx.fill();
    ctx.stroke();
    ctx.fillStyle = 'rgba(196, 181, 253, 0.95)';
    ctx.font = '700 8px Inter, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('SMS', sx, sy + 3);

    if (phase === 170) spawnSmsWave(sx + 22, sy);
    if (phase === 175) spawnParticles(sx, sy);

    for (var i = smsWaves.length - 1; i >= 0; i--) {
      var wave = smsWaves[i];
      wave.r += 1.4;
      wave.alpha -= 0.018;
      ctx.strokeStyle = 'rgba(139, 92, 246, ' + Math.max(0, wave.alpha) + ')';
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(wave.x, wave.y, wave.r, 0, Math.PI * 2);
      ctx.stroke();
      if (wave.alpha <= 0) smsWaves.splice(i, 1);
    }
  }

  function drawNoShowBar(nx, ny, nw) {
    var reduction = 0.18 + Math.sin(t * 0.04) * 0.04;
    ctx.fillStyle = 'rgba(255,255,255,0.06)';
    roundRect(nx, ny, nw, 10, 5);
    ctx.fill();
    ctx.fillStyle = 'rgba(251, 113, 133, 0.55)';
    roundRect(nx, ny, nw * 0.42, 10, 5);
    ctx.fill();
    ctx.fillStyle = 'rgba(34, 197, 94, 0.75)';
    roundRect(nx + nw * 0.42, ny, nw * (0.58 - reduction * 0.3), 10, 5);
    ctx.fill();
    ctx.fillStyle = 'rgba(198, 210, 229, 0.75)';
    ctx.font = '600 8px Inter, sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('no-show ↓', nx, ny - 5);
  }

  function drawParticles() {
    for (var i = particles.length - 1; i >= 0; i--) {
      var p = particles[i];
      p.x += p.vx;
      p.y += p.vy;
      p.life--;
      var a = Math.max(0, p.life / p.max);
      ctx.globalAlpha = a;
      ctx.fillStyle = p.color;
      ctx.beginPath();
      ctx.arc(p.x, p.y, 2.5, 0, Math.PI * 2);
      ctx.fill();
      ctx.globalAlpha = 1;
      if (p.life <= 0) particles.splice(i, 1);
    }
  }

  function frame() {
    if (!w || !h) { requestAnimationFrame(frame); return; }
    t++;
    phase = t % CYCLE;

    ctx.clearRect(0, 0, w, h);
    drawGrid();

    var calX = w * 0.06;
    var calY = h * 0.14;
    var calW = w * 0.52;
    var calH = h * 0.78;
    drawCalendarHub(calX, calY, calW, calH);

    var slotCenterX = calX + calW * (2 / 7) + (calW / 7) * 0.5;
    var slotCenterY = calY + (calH / (SLOTS_PER_DAY + 1)) + (calH / (SLOTS_PER_DAY + 1)) * 1.5;
    drawClientRequest(w * 0.08, h * 0.5);
    drawBookingArrow(w * 0.14, h * 0.5, slotCenterX, slotCenterY);
    drawSmsNode(w - 42, h * 0.48);
    drawNoShowBar(w * 0.62, h * 0.82, w * 0.32);
    drawParticles();

    requestAnimationFrame(frame);
  }

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  resize();
  window.addEventListener('resize', resize);
  frame();
})();
</script>

<section class="nero-ai-section-tight vnedrenie-ai-sekretar-zapis-klientov-intro" aria-label="Введение">
  <div class="nero-ai-container">
    <div class="vnedrenie-ai-sekretar-zapis-klientov-intro__grid nero-ai-reveal">
      <div class="vnedrenie-ai-sekretar-zapis-klientov-intro__text">
        <p class="vnedrenie-ai-sekretar-zapis-klientov-intro__lead"><strong>Коротко:</strong> голосовой AI-секретарь принимает звонок, подбирает свободное время в календаре или CRM, создаёт запись и отправляет клиенту подтверждение — без очереди и без потери обращения в часы пик. Внедрение под ключ закрывает цепочку «звонок → слот → подтверждение → напоминание → визит» для салонов, клиник, стоматологий, студий и школ.</p>
        <p>Администратор перегружен, запись теряется — это не гипотеза, а ежедневная реальность сервисного бизнеса. Пока сотрудник оформляет одного клиента, треть входящих может остаться без ответа; часть из них уходит к конкуренту. AI-секретарь для записи клиентов на услуги снимает рутину с первой линии: подбирает время, фиксирует визит в системе учёта и доводит клиента до подтверждённой записи. Ниже — как устроено решение, чем оно отличается от онлайн-формы и чат-бота, какие интеграции нужны и как выглядит внедрение AI-секретаря под ключ.</p>
      </div>
      <div class="vnedrenie-ai-sekretar-zapis-klientov-intro__terminal nero-ai-reveal nero-ai-delay-1" aria-hidden="true">
        <div class="vnedrenie-ai-sekretar-zapis-klientov-intro__terminal-head"><span></span><span></span><span></span></div>
        <ul class="vnedrenie-ai-sekretar-zapis-klientov-intro__chips">
          <li>YClients / Medesk</li>
          <li>Google Calendar</li>
          <li>SMS-подтверждение</li>
          <li>Anti-no-show</li>
        </ul>
        <div class="vnedrenie-ai-sekretar-zapis-klientov-intro__metric">
          <div><strong data-nero-count="30" data-nero-suffix="%">0%</strong><span>пропущенных звонков в пик (рынок)</span></div>
          <div><strong data-nero-count="24" data-nero-suffix="/7">0/7</strong><span>запись без очереди</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<nav class="nero-ai-toc-wrap" aria-label="Оглавление">
  <ul class="nero-ai-toc nero-ai-reveal">
    <li><a href="#chto-takoe-ai-sekretar">Что такое AI-секретарь</a></li>
    <li><a href="#lost-bookings-pain">Потери записей</a></li>
    <li><a href="#booking-demo">Демо записи</a></li>
    <li><a href="#booking-scenario">Сценарий</a></li>
    <li><a href="#golos-vs-online">Голос vs онлайн</a></li>
    <li><a href="#integraciya-crm">CRM и календари</a></li>
    <li><a href="#vnedrenie-pod-klyuch">Внедрение</a></li>
    <li><a href="#dlya-nish">Ниши</a></li>
    <li><a href="#stoimost">Стоимость</a></li>
    <li><a href="#keisy">Кейсы</a></li>
    <li><a href="#faq-sekretar">FAQ</a></li>
    <li><a href="#scenario-cta">Сценарий записи</a></li>
  </ul>
</nav>

<section class="nero-ai-section" id="chto-takoe-ai-sekretar"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Что такое AI-секретарь для записи клиентов и чем он отличается от обычного администратора</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Определение:</strong> AI-секретарь для записи — голосовой (или мультиканальный) AI-агент, который ведёт диалог на естественном языке, проверяет свободные слоты в YClients, Medesk, amoCRM, Битрикс24 или другой системе учёта, создаёт запись, отправляет подтверждение в SMS, WhatsApp или Telegram и при необходимости напоминает о визите или переносит запись.</p>
<p>Это не IVR «нажмите 1» и не универсальный чат-бот с кнопками. Современный AI-администратор и AI-ресепшн в 2026 году работают как <strong>agentic AI</strong>: распознают свободную речь, вызывают API календаря через function calling, уточняют недостающие данные и эскалируют нестандартные кейсы человеку с полным контекстом диалога.</p>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>Критерий</th><th>Живой администратор</th><th>AI-секретарь для записи</th></tr>
<tr><td>Параллельные звонки</td><td>Один-два одновременно</td><td>Масштабируется под пик</td></tr>
<tr><td>Запись в CRM</td><td>Вручную, с риском ошибки</td><td>Автоматически через API</td></tr>
<tr><td>Подтверждение и напоминания</td><td>Часто «когда успеем»</td><td>Каскад SMS/голос по регламенту</td></tr>
<tr><td>Стоимость</td><td>ФОТ + больничные + обучение</td><td>Проект + сопровождение</td></tr>
</table></div>
<p>Виртуальный администратор для записи не заменяет человека полностью: сложные консультации, жалобы, нестандартные скидки и юридически значимые согласия остаются за сотрудником. AI берёт типовой поток — запись, перенос, отмена, цена, адрес, подготовка к процедуре — и разгружает администратора на <strong>30–70%</strong> обращений по данным публичных кейсов (Fromtech, МЕДСИ, вендоры голосовых платформ).</p>
<p>Отдельно важно отличие от страницы про «голосового менеджера входящих звонков»: там фокус на квалификации и пропущенных звонках; здесь — <strong>end-to-end запись на услугу</strong>: слот в календаре, подтверждение, перенос, anti-no-show.</p>
</div></div></section><section class="nero-ai-section nero-ai-section-alt" id="lost-bookings-pain"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Почему записи теряются: перегруженный администратор и скрытые потери выручки</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Типовая картина в салоне или клинике: пики нагрузки <strong>12:00–14:00</strong> и <strong>17:00–19:00</strong>. Администратор одновременно встречает гостя у стойки, принимает оплату и отвечает на звонок. Пропущенный вызов часто не перезванивают вовремя — клиент записывается у конкурента.</p>
<p>По оценкам вендора VoiceLogic, до <strong>30%</strong> входящих в медицинские организации остаются без ответа; <strong>67%</strong> не дозвонившихся с первой попытки обращаются к другой клинике (рыночный ориентир, не гарантия для каждого бизнеса). Потерянные записи администратор — прямой удар по выручке: каждый неотвеченный звонок с интентом «хочу записаться» — потенциальный чек, который не попал в календарь.</p>
<p>Вторая скрытая потеря — <strong>no-show</strong> (неявки). В частных клиниках крупных городов неявки составляют <strong>18–20%</strong> (исследование MedBusiness); по данным YClients — <strong>10–25%</strong> в зависимости от специализации. В салонах красоты показатель часто достигает <strong>20–30%</strong>. Пустое окно в расписании — это не «мелочь», а системная дыра в загрузке мастеров и врачей.</p>
<p><strong>Формула потерь (подставьте свои цифры):</strong></p>
<ol>
<li>Пропущенные звонки в месяц × конверсия в запись × средний чек = упущенная выручка с телефона.</li>
<li>Записи в месяц × % no-show × средний чек = потери от неявок.</li>
</ol>
<p>Снижение no-show через AI достигается не магией, а <strong>каскадом напоминаний</strong>: подтверждение сразу после записи, напоминание за 24 и 2 часа, исходящий обзвон накануне визита. Автоматические напоминания в медицине и beauty снижают неявки на <strong>30–60%</strong> (MedBusiness). Кейс сети клиник «Элегра» с RoboVoice: исходящий обзвон до ~1000 пациентов в день, обзвон <strong>в 6 раз быстрее</strong> операторов (Retail.ru).</p>
<p><strong>Итог блока:</strong> перегруз администратора бьёт дважды — теряются входящие звонки и растёт доля пустых слотов из-за поздних отмен и забывчивости клиентов. AI-секретарь закрывает оба контура: входящая запись и исходящее подтверждение.</p>
<section class="boris-booking-split" id="booking-demo" aria-label="Пайплайн AI-секретаря: звонок, слот, CRM, напоминание">
<style>
#booking-demo {
  --boris-bg: #f8fafc;
  --boris-card: #ffffff;
  --boris-border: rgba(15, 23, 42, 0.08);
  --boris-text: #0f172a;
  --boris-muted: #64748b;
  --boris-accent: #2563eb;
  --boris-accent-soft: #dbeafe;
  --boris-green: #059669;
  --boris-green-soft: #d1fae5;
  --boris-violet: #7c3aed;
  --boris-shadow: 0 18px 48px rgba(15, 23, 42, 0.07);
  margin: 2.5rem 0;
  font-family: Inter, system-ui, -apple-system, sans-serif;
}
#booking-demo .boris-booking-card {
  background: var(--boris-card);
  border: 1px solid var(--boris-border);
  border-radius: 22px;
  box-shadow: var(--boris-shadow);
  padding: clamp(1.25rem, 3vw, 2.5rem);
  display: grid;
  grid-template-columns: 1fr;
  gap: clamp(1.25rem, 3vw, 2rem);
  align-items: center;
}
@media (min-width: 1024px) {
  #booking-demo .boris-booking-card {
    grid-template-columns: 1.1fr 1fr;
    gap: 2.5rem;
  }
}
#booking-demo .boris-eyebrow {
  display: inline-block;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--boris-accent);
  background: var(--boris-accent-soft);
  padding: 0.35rem 0.7rem;
  border-radius: 999px;
  margin-bottom: 0.75rem;
}
#booking-demo .boris-kicker {
  font-size: clamp(1.25rem, 2.4vw, 1.65rem);
  line-height: 1.25;
  font-weight: 700;
  color: var(--boris-text);
  margin: 0 0 0.65rem;
}
#booking-demo .boris-lead {
  font-size: 0.98rem;
  line-height: 1.55;
  color: var(--boris-muted);
  margin: 0 0 1.1rem;
}
#booking-demo .boris-points {
  list-style: none;
  margin: 0 0 1.1rem;
  padding: 0;
  display: grid;
  gap: 0.55rem;
}
#booking-demo .boris-points li {
  display: flex;
  align-items: flex-start;
  gap: 0.55rem;
  font-size: 0.94rem;
  line-height: 1.45;
  color: var(--boris-text);
}
#booking-demo .boris-points li::before {
  content: "";
  flex-shrink: 0;
  width: 7px;
  height: 7px;
  margin-top: 0.45rem;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--boris-accent), var(--boris-violet));
}
#booking-demo .boris-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 0.45rem;
  margin-bottom: 0.75rem;
}
#booking-demo .boris-pill {
  font-size: 0.78rem;
  font-weight: 600;
  padding: 0.35rem 0.7rem;
  border-radius: 999px;
  border: 1px solid var(--boris-border);
  background: var(--boris-bg);
  color: var(--boris-text);
}
#booking-demo .boris-pill--live {
  border-color: rgba(5, 150, 105, 0.25);
  background: var(--boris-green-soft);
  color: var(--boris-green);
}
#booking-demo .boris-bridge {
  font-size: 0.88rem;
  color: var(--boris-muted);
  margin: 0;
}
#booking-demo .boris-canvas-wrap {
  position: relative;
  background: linear-gradient(160deg, #f1f5f9 0%, #ffffff 55%, #eff6ff 100%);
  border: 1px solid var(--boris-border);
  border-radius: 18px;
  min-height: 380px;
  max-height: 520px;
  height: clamp(380px, 42vw, 480px);
  overflow: hidden;
}
#booking-demo #secretary-booking-pipeline-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
#booking-demo .boris-canvas-caption {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  padding: 0.55rem 1rem;
  font-size: 0.72rem;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: var(--boris-muted);
  background: linear-gradient(transparent, rgba(255,255,255,0.92));
  text-align: center;
  pointer-events: none;
}
</style>

<div class="boris-booking-card">
  <div class="boris-copy">
    <span class="boris-eyebrow">Цепочка записи</span>
    <h3 class="boris-kicker">От звонка до подтверждённого визита — без ручного ввода</h3>
    <p class="boris-lead">AI-секретарь не «отвечает за администратора», а проходит весь маршрут: принимает звонок, проверяет свободные окна, фиксирует запись в CRM и запускает каскад напоминаний.</p>
    <ul class="boris-points">
      <li><strong>Звонок</strong> — клиент диктует услугу и время; STT и агент уточняют детали без очереди.</li>
      <li><strong>Слот</strong> — live-проверка YClients, Medesk или Google Calendar; предлагаются 2–3 варианта.</li>
      <li><strong>CRM</strong> — визит создаётся через API; администратор видит карточку с транскриптом.</li>
      <li><strong>Напоминание</strong> — SMS, мессенджер или исходящий звонок снижают no-show.</li>
    </ul>
    <div class="boris-pills" aria-hidden="true">
      <span class="boris-pill boris-pill--live">24/7 на линии</span>
      <span class="boris-pill">API CRM</span>
      <span class="boris-pill">Anti-no-show</span>
    </div>
    <p class="boris-bridge">Дальше разберём пошаговый сценарий и интеграции с вашей системой учёта.</p>
  </div>
  <div class="boris-canvas-wrap">
    <canvas id="secretary-booking-pipeline-canvas" role="img" aria-label="Анимация: звонок клиента, подбор слота, запись в CRM, напоминание о визите"></canvas>
    <div class="boris-canvas-caption">Звонок → Слот → CRM → Напоминание</div>
  </div>
</div>

<script id="secretary-booking-pipeline-engine">
(function () {
  var canvas = document.getElementById('secretary-booking-pipeline-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var dpr = Math.min(window.devicePixelRatio || 1, 2);
  var W = 0, H = 0, frame = 0;
  var nodes = [];
  var packets = [];
  var phase = 0;

  var COLORS = {
    outline: '#0f172a',
    line: '#cbd5e1',
    lineActive: '#2563eb',
    phone: '#3b82f6',
    slot: '#8b5cf6',
    crm: '#059669',
    remind: '#f59e0b',
    bubble: '#ffffff',
    text: '#334155',
    glow: 'rgba(37, 99, 235, 0.18)'
  };

  var STAGES = [
    { key: 'call', label: 'Звонок', sub: 'STT + диалог', color: COLORS.phone, icon: 'phone' },
    { key: 'slot', label: 'Слот', sub: 'Календарь API', color: COLORS.slot, icon: 'calendar' },
    { key: 'crm', label: 'CRM', sub: 'Запись визита', color: COLORS.crm, icon: 'crm' },
    { key: 'remind', label: 'Напоминание', sub: 'SMS / голос', color: COLORS.remind, icon: 'bell' }
  ];

  function resize() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    W = wrap.clientWidth;
    H = wrap.clientHeight;
    canvas.width = Math.floor(W * dpr);
    canvas.height = Math.floor(H * dpr);
    canvas.style.width = W + 'px';
    canvas.style.height = H + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    layoutNodes();
  }

  function layoutNodes() {
    var padX = Math.max(28, W * 0.06);
    var usable = W - padX * 2;
    var step = usable / (STAGES.length - 1);
    var cy = H * 0.46;
    nodes = STAGES.map(function (s, i) {
      return {
        x: padX + step * i,
        y: cy,
        r: Math.min(34, W * 0.055),
        stage: s,
        pulse: 0
      };
    });
  }

  function roundRect(x, y, w, h, r) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else { ctx.moveTo(x + r, y); ctx.arcTo(x + w, y, x + w, y + h, r); ctx.arcTo(x + w, y + h, x, y + h, r); ctx.arcTo(x, y + h, x, y, r); ctx.arcTo(x, y, x + w, y, r); }
    ctx.closePath();
  }

  function drawPhone(x, y, s, active) {
    var w = s * 0.9, h = s * 1.35;
    ctx.save();
    ctx.translate(x, y);
    roundRect(-w/2, -h/2, w, h, s * 0.18);
    ctx.fillStyle = active ? COLORS.phone : '#94a3b8';
    ctx.fill();
    ctx.lineWidth = 2;
    ctx.strokeStyle = COLORS.outline;
    ctx.stroke();
    ctx.fillStyle = '#e2e8f0';
    roundRect(-w*0.32, -h*0.22, w*0.64, h*0.38, 4);
    ctx.fill();
    if (active && frame % 40 < 20) {
      ctx.strokeStyle = 'rgba(255,255,255,0.7)';
      ctx.lineWidth = 2;
      for (var i = 0; i < 3; i++) {
        ctx.beginPath();
        ctx.arc(w * 0.55 + i * 7, -h * 0.05, 4 + i * 3, -0.8, 0.8);
        ctx.stroke();
      }
    }
    ctx.restore();
  }

  function drawCalendar(x, y, s, active) {
    ctx.save();
    ctx.translate(x, y);
    var w = s * 1.2, h = s * 1.1;
    roundRect(-w/2, -h/2, w, h, 6);
    ctx.fillStyle = active ? COLORS.slot : '#94a3b8';
    ctx.fill();
    ctx.strokeStyle = COLORS.outline;
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.fillStyle = '#f8fafc';
    ctx.fillRect(-w/2 + 4, -h/2 + 10, w - 8, h * 0.22);
    var cols = 3, rows = 2, cell = (w - 16) / cols;
    for (var r = 0; r < rows; r++) {
      for (var c = 0; c < cols; c++) {
        var cx = -w/2 + 8 + c * cell + cell * 0.15;
        var cy = -h/2 + 22 + r * (cell * 0.55);
        var filled = active && (r === 0 && c === 1);
        ctx.fillStyle = filled ? '#22c55e' : '#e2e8f0';
        roundRect(cx, cy, cell * 0.7, cell * 0.45, 3);
        ctx.fill();
      }
    }
    ctx.restore();
  }

  function drawCRM(x, y, s, active) {
    ctx.save();
    ctx.translate(x, y);
    var w = s * 1.35, h = s * 1.05;
    roundRect(-w/2, -h/2, w, h, 8);
    ctx.fillStyle = active ? COLORS.crm : '#94a3b8';
    ctx.fill();
    ctx.strokeStyle = COLORS.outline;
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.fillStyle = '#ecfdf5';
    roundRect(-w/2 + 8, -h/2 + 10, w - 16, h * 0.28, 4);
    ctx.fill();
    for (var i = 0; i < 3; i++) {
      ctx.fillStyle = i === 0 && active ? '#10b981' : '#cbd5e1';
      roundRect(-w/2 + 10, -h/2 + 22 + i * 12, w - 20, 8, 2);
      ctx.fill();
    }
    if (active) {
      ctx.fillStyle = '#ffffff';
      ctx.font = '600 9px Inter, sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('✓', w/2 - 12, -h/2 + 24);
    }
    ctx.restore();
  }

  function drawBell(x, y, s, active) {
    ctx.save();
    ctx.translate(x, y);
    ctx.fillStyle = active ? COLORS.remind : '#94a3b8';
    ctx.beginPath();
    ctx.moveTo(0, -s * 0.55);
    ctx.quadraticCurveTo(s * 0.55, -s * 0.2, s * 0.5, s * 0.35);
    ctx.lineTo(-s * 0.5, s * 0.35);
    ctx.quadraticCurveTo(-s * 0.55, -s * 0.2, 0, -s * 0.55);
    ctx.closePath();
    ctx.fill();
    ctx.strokeStyle = COLORS.outline;
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.fillStyle = '#fde68a';
    ctx.beginPath();
    ctx.ellipse(0, s * 0.42, s * 0.22, s * 0.08, 0, 0, Math.PI * 2);
    ctx.fill();
    if (active) {
      var swing = Math.sin(frame * 0.12) * 0.08;
      ctx.rotate(swing);
    }
    ctx.restore();
  }

  function drawIcon(node, active) {
    var s = node.r;
    switch (node.stage.icon) {
      case 'phone': drawPhone(node.x, node.y - 6, s, active); break;
      case 'calendar': drawCalendar(node.x, node.y - 6, s, active); break;
      case 'crm': drawCRM(node.x, node.y - 6, s, active); break;
      case 'bell': drawBell(node.x, node.y - 6, s, active); break;
    }
  }

  function drawConnector(a, b, progress, lit) {
    ctx.save();
    ctx.lineCap = 'round';
    ctx.strokeStyle = lit ? COLORS.lineActive : COLORS.line;
    ctx.lineWidth = lit ? 3 : 2;
    ctx.setLineDash(lit ? [] : [6, 6]);
    ctx.beginPath();
    ctx.moveTo(a.x + a.r + 8, a.y);
    ctx.lineTo(b.x - b.r - 8, b.y);
    ctx.stroke();
    if (lit && progress > 0) {
      var px = a.x + (b.x - a.x) * progress;
      var py = a.y + (b.y - a.y) * progress;
      ctx.fillStyle = COLORS.lineActive;
      ctx.beginPath();
      ctx.arc(px, py, 5, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = COLORS.glow;
      ctx.beginPath();
      ctx.arc(px, py, 12, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.restore();
  }

  function spawnPacket(fromIdx) {
    if (fromIdx >= nodes.length - 1) return;
    packets.push({ from: fromIdx, t: 0, speed: 0.012 + Math.random() * 0.006 });
  }

  function drawLabels(node, active) {
    ctx.save();
    ctx.textAlign = 'center';
    ctx.fillStyle = active ? COLORS.outline : COLORS.text;
    ctx.font = (active ? '700 ' : '600 ') + '12px Inter, system-ui, sans-serif';
    ctx.fillText(node.stage.label, node.x, node.y + node.r + 22);
    ctx.fillStyle = COLORS.text;
    ctx.font = '10px Inter, system-ui, sans-serif';
    ctx.fillText(node.stage.sub, node.x, node.y + node.r + 36);
    ctx.restore();
  }

  function drawBackground() {
    ctx.clearRect(0, 0, W, H);
    var grd = ctx.createLinearGradient(0, 0, W, H);
    grd.addColorStop(0, '#f8fafc');
    grd.addColorStop(1, '#eff6ff');
    ctx.fillStyle = grd;
    ctx.fillRect(0, 0, W, H);
    ctx.strokeStyle = 'rgba(148, 163, 184, 0.15)';
    ctx.lineWidth = 1;
    for (var gx = 0; gx < W; gx += 28) {
      ctx.beginPath();
      ctx.moveTo(gx, 0);
      ctx.lineTo(gx, H);
      ctx.stroke();
    }
    for (var gy = 0; gy < H; gy += 28) {
      ctx.beginPath();
      ctx.moveTo(0, gy);
      ctx.lineTo(W, gy);
      ctx.stroke();
    }
  }

  function tick() {
    frame++;
    phase = (frame * 0.004) % (STAGES.length);
    var activeIdx = Math.floor(phase);

    if (frame % 90 === 0) spawnPacket(activeIdx % (STAGES.length - 1));

    drawBackground();

    for (var i = 0; i < nodes.length - 1; i++) {
      var lit = i <= activeIdx;
      var localProg = i === activeIdx ? (phase - activeIdx) : (lit ? 1 : 0);
      drawConnector(nodes[i], nodes[i + 1], localProg, lit);
    }

    for (var n = 0; n < nodes.length; n++) {
      var isActive = n === activeIdx || n === activeIdx - 1;
      if (n === activeIdx) {
        var pulse = 1 + Math.sin(frame * 0.08) * 0.06;
        ctx.save();
        ctx.translate(nodes[n].x, nodes[n].y);
        ctx.scale(pulse, pulse);
        ctx.translate(-nodes[n].x, -nodes[n].y);
        ctx.fillStyle = COLORS.glow;
        ctx.beginPath();
        ctx.arc(nodes[n].x, nodes[n].y, nodes[n].r + 18, 0, Math.PI * 2);
        ctx.fill();
        ctx.restore();
      }
      drawIcon(nodes[n], n <= activeIdx);
      drawLabels(nodes[n], n === activeIdx);
    }

    packets = packets.filter(function (p) {
      p.t += p.speed;
      if (p.t >= 1) return false;
      var a = nodes[p.from];
      var b = nodes[p.from + 1];
      var px = a.x + (b.x - a.x) * p.t;
      var py = a.y + (b.y - a.y) * p.t - Math.sin(p.t * Math.PI) * 10;
      ctx.fillStyle = STAGES[p.from + 1].color;
      ctx.beginPath();
      ctx.arc(px, py, 4, 0, Math.PI * 2);
      ctx.fill();
      return true;
    });

    if (activeIdx === 0 && frame % 120 < 60) {
      ctx.save();
      ctx.fillStyle = COLORS.bubble;
      ctx.strokeStyle = COLORS.outline;
      ctx.lineWidth = 1.5;
      var bx = nodes[0].x - 50, by = nodes[0].y - nodes[0].r - 42;
      roundRect(bx, by, 100, 26, 10);
      ctx.fill();
      ctx.stroke();
      ctx.fillStyle = COLORS.text;
      ctx.font = '10px Inter, sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('«Запишите на пятницу»', nodes[0].x, by + 17);
      ctx.restore();
    }

    if (activeIdx === 3 && frame % 100 < 50) {
      ctx.save();
      ctx.fillStyle = '#fff7ed';
      ctx.strokeStyle = COLORS.remind;
      ctx.lineWidth = 1.5;
      var rx = nodes[3].x - 42, ry = nodes[3].y - nodes[3].r - 38;
      roundRect(rx, ry, 84, 22, 8);
      ctx.fill();
      ctx.stroke();
      ctx.fillStyle = COLORS.remind;
      ctx.font = '600 9px Inter, sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('SMS · завтра 14:00', nodes[3].x, ry + 14);
      ctx.restore();
    }

    requestAnimationFrame(tick);
  }

  window.addEventListener('resize', resize);
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () { resize(); tick(); });
  } else {
    resize();
    tick();
  }
})();
</script>
</section>
<aside class="nero-ai-inline-cta nero-ai-card nero-ai-reveal" aria-label="Получить сценарий AI-секретаря">
  <p class="nero-ai-eyebrow">Лид-магнит · сценарий записи</p>
  <h3>Получите сценарий AI-секретаря под вашу нишу</h3>
  <p>Дерево диалога (запись / перенос / отмена / FAQ), карта интеграций с CRM и телефонией, чеклист 152-ФЗ для голосового канала и KPI пилота — без абстрактного «аудита AI».</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside>
</div></div></section><section class="nero-ai-section" id="booking-scenario"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Как работает сценарий: подбор времени → запись → подтверждение</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Типовой путь клиента при внедрении AI-секретаря для бизнеса выглядит так:</p>
<ol>
<li><strong>Звонок.</strong> Клиент набирает номер салона или клиники. Облачная АТС (Mango, UIS, Sipuni, Zadarma) маршрутизирует вызов на AI-секретаря или ставит его параллельно с очередью к администратору.</li>
<li><strong>Комплаенс.</strong> В начале разговора — уведомление о записи и обработке персональных данных (требование 152-ФЗ с 01.09.2025: согласие на ПДн оформляется <strong>отдельным документом</strong>).</li>
<li><strong>Распознавание речи.</strong> STT (приоритет для РФ — Yandex SpeechKit: realtime-агенты с задержкой менее 1 секунды, реестр российского ПО) переводит речь в текст.</li>
<li><strong>Определение интента.</strong> Агент понимает: запись, перенос, отмена, вопрос о цене или адресе.</li>
<li><strong>Сбор данных.</strong> Уточняются услуга, специалист, желаемая дата и время, имя, телефон.</li>
<li><strong>Проверка слотов.</strong> Через API YClients, Medesk, Google Calendar или CRM запрашиваются свободные окна; клиенту предлагаются 2–3 варианта.</li>
<li><strong>Фиксация записи.</strong> После подтверждения создаётся визит в системе, администратор получает уведомление.</li>
<li><strong>Подтверждение записи AI.</strong> Клиенту уходит SMS, Telegram или WhatsApp с датой, временем, адресом и правилами подготовки.</li>
<li><strong>Напоминания.</strong> За 24 и 2 часа — повторное сообщение или голосовой звонок; при отказе — перенос или освобождение слота.</li>
<li><strong>Эскалация.</strong> Нестандартный запрос → warm transfer администратору с транскриптом в CRM.</li>
</ol>
<p>Автоматизация записи клиентов через такой сценарий сокращает путь «звонок → подтверждённая запись» с минут ожидания на линии до одного непрерывного диалога. AI-календарь записи синхронизирован с реальным расписанием: агент не предлагает занятые слоты, если интеграция настроена корректно.</p>
<p><strong>Коротко о стеке:</strong> SIP-транк → STT → LLM-агент с tools → API CRM/календаря → TTS → исходящие SMS/мессенджеры. Оркестрация часто собирается на Make или n8n — типичный подход интеграторов при кастомном внедрении.</p>
</div></div></section><section class="nero-ai-section nero-ai-section-alt" id="golos-vs-online"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Голосовой AI-секретарь vs онлайн-запись и чат-бот</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Онлайн-форма на сайте, виджет YClients и чат-бот в мессенджере решают часть задач, но не закрывают сегмент клиентов, которые <strong>привыкли звонить</strong> — особенно аудитория 35+ и пациенты медицинских клиник. Jivo предлагает AI-администратора для YClients в WhatsApp, Telegram и VK — удобно для молодой аудитории, но <strong>без голоса</strong> не перехватывает телефонный трафик.</p>
<h3>Когда голос выигрывает у формы на сайте</h3>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>Ситуация</th><th>Онлайн-запись</th><th>Голосовой AI-секретарь</th></tr>
<tr><td>Сложный прайс (несколько услуг, мастера)</td><td>Риск ошибки в форме</td><td>Уточнение в диалоге</td></tr>
<tr><td>Срочная запись «на сегодня»</td><td>Слоты могут не обновиться</td><td>Live-проверка API</td></tr>
<tr><td>Пожилой клиент</td><td>Барьер интерфейса</td><td>Привычный канал</td></tr>
<tr><td>Нужно перенести/отменить</td><td>Поиск письма, звонок позже</td><td>Один звонок, статус в CRM</td></tr>
</table></div>
<p>Голосовой AI-секретарь не отменяет онлайн-запись: оптимальная архитектура — <strong>единая логика слотов</strong> в CRM, разные каналы входа (сайт, мессенджеры, телефон).</p>
<h3>Качество распознавания речи в русскоязычных сценариях</h3>
<p>Критичны три фактора: акцент и темп речи клиента, отраслевой словарь (имена врачей, названия процедур), шум в салоне или на улице. В кейсе МЕДСИ (SL Soft AI) агент распознаёт <strong>неформальные названия врачей и клиник</strong> — эталон для медицинской терминологии. Для стоматологии и салонов на этапе пилота дообучают словарь: имена мастеров, сокращения услуг, синонимы из прайса.</p>
<p>Yandex AI Speech в 2026 году позиционируется как платформа для голосовых агентов с MCP-интеграциями и учётом 152-ФЗ — предпочтительный выбор при хранении данных в РФ. Зарубежный STT без юридически выверенного контура повышает риски при обработке голоса (в т.ч. как биометрии).</p>
<p><strong>Сравнительная таблица каналов:</strong></p>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>Критерий</th><th>Администратор</th><th>Онлайн-запись</th><th>Чат-бот</th><th>Голосовой AI-секретарь</th></tr>
<tr><td>Звонящие клиенты</td><td>✓</td><td>✗</td><td>✗</td><td>✓</td></tr>
<tr><td>Live-слоты в CRM</td><td>✓</td><td>✓*</td><td>✓*</td><td>✓</td></tr>
<tr><td>Подтверждение + напоминания</td><td>частично</td><td>частично</td><td>✓</td><td>✓</td></tr>
<tr><td>Исходящий anti-no-show</td><td>редко</td><td>✗</td><td>частично</td><td>✓</td></tr>
<tr><td>Масштаб в пик</td><td>узкое горлышко</td><td>высокий</td><td>высокий</td><td>высокий</td></tr>
</table></div>
<p>*При корректной интеграции.</p>
</div></div></section><section class="nero-ai-section" id="integraciya-crm"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Интеграция AI-секретаря с CRM, календарями и телефонией</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Без интеграции AI-секретарь с CRM остаётся «умной автоответчиком». Ценность — в <strong>двусторонней связке</strong>: агент читает расписание и пишет запись обратно.</p>
<h3>YClients, Medesk, Google Calendar</h3>
<p><strong>YClients</strong> — стандарт для салонов и студий красоты. API позволяет создавать записи, проверять слоты, привязывать услуги и мастеров. YClients поддерживает интеграцию с провайдерами IP-телефонии — звонок может автоматически подставлять карточку клиента. AI-администратор Jivo для YClients показывает, как текстовый канал пишет тестовую запись в журнал; голосовой контур использует тот же API.</p>
<p><strong>Medesk</strong> — типичный выбор частных клиник и стоматологий. Интеграция AI-регистратуры (например, «МедЖарвис» от Keremet IT) заявляет совместимость с Medesk, Mango, UIS, amoCRM, Битрикс24.</p>
<p><strong>Google Calendar</strong> — вариант для небольших студий и школ без отраслевой CRM: агент проверяет свободные окна и создаёт событие; подтверждение уходит в мессенджер.</p>
<p>Если прямой API закрыт или интеграция на этапе согласования, корректный fallback — <strong>фиксация заявки</strong> с передачей администратору без потери обращения (транскрипт + callback-задача в CRM).</p>
<h3>amoCRM и Битрикс24</h3>
<p>Для бизнеса, где запись = сделка в воронке, AI-секретарь создаёт лид или сделку, ставит задачу менеджеру, заполняет поля «услуга», «желаемое время», «источник — входящий звонок». Интеграция AI-секретаря с CRM через REST и webhooks — стандартный слой на n8n/Make. Битрикс24 и amoCRM имеют документированные API для телефонии и роботов; важно заранее согласовать, <strong>какой объект</strong> создаёт агент при записи на услугу vs при общем вопросе.</p>
<h3>Требования к телефонии и SIP</h3>
<p>Минимальный чеклист:</p>
<ul>
<li>Облачная АТС или SIP-транк (Mango Office, UIS, Sipuni, Zadarma, МТТ, Novofon).</li>
<li>Маршрутизация: AI-секретарь на отдельном внутреннем номере или как первый обработчик в IVR.</li>
<li>Запись разговоров с хранением по политике 152-ФЗ.</li>
<li>Caller ID для исходящих напоминаний (отдельный сценарий anti-no-show).</li>
<li>Резервный маршрут на живого администратора при сбое STT или недоступности API CRM.</li>
</ul>
<p>Поддержка YClients перечисляет провайдеров IP-телефонии — при внедрении сверяют совместимость до подписания ТЗ.</p>
</div></div></section><section class="nero-ai-section nero-ai-section-alt" id="vnedrenie-pod-klyuch"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Внедрение AI-секретаря под ключ: этапы от аудита до запуска</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Внедрение AI-секретаря, настройка AI-секретаря и разработка AI-секретаря под конкретную нишу — это проект с измеримым результатом, а не покупка «коробки». Типовой срок для салона или клиники на YClients или amoCRM: <strong>3–6 недель</strong> (согласуется с рынком: RoboVoice, Tomoru — 2–6 недель; интеграторы — 2–4 недели).</p>
<h3>Аудит текущей записи и узких мест</h3>
<p><strong>3–5 рабочих дней.</strong> Карта каналов: телефон, сайт, мессенджеры, соцсети. Считаются пропущенные звонки, среднее время ответа, доля no-show, список услуг/мастеров/ограничений (буферы между приёмами, перерывы). На выходе — ТЗ с приоритетными сценариями и KPI пилота.</p>
<h3>Проектирование сценария диалога</h3>
<p><strong>5–7 дней.</strong> Дерево диалогов: запись / перенос / отмена / цена / адрес / подготовка к процедуре / эскалация. Правила перевода на человека: дети, экстренные случаи в медицине, VIP, жалобы. Именно здесь формируется <strong>сценарий AI-секретаря</strong> — документ, который Nero Network отдаёт как лид-магнит до старта разработки.</p>
<h3>Тестирование, обучение персонала, запуск</h3>
<p><strong>2–4 недели</strong> интеграционного и голосового контура + <strong>2 недели пилота</strong> на одном филиале:</p>
<ul>
<li>API CRM/календаря, webhooks, Make/n8n для подтверждений.</li>
<li>SIP + STT/TTS + LLM-агент с function calling.</li>
<li>20–30% трафика на AI, прослушивание звонков, доработка словаря.</li>
<li>Обучение администраторов: когда подключаться, как читать транскрипты, как обновлять FAQ в базе знаний агента.</li>
<li>Полный запуск + дашборд KPI: конверсия звонок→запись, no-show, AHT, доля эскалаций.</li>
</ul>
<p>Как внедрить AI-секретарь без срыва операционки: параллельная работа AI и администратора на переходном периоде, а не «выключили людей в первый день».</p>
<aside class="nero-ai-secondary-cta nero-ai-card nero-ai-reveal nero-ai-delay-1" aria-label="Материалы по внедрению AI">
  <p class="nero-ai-eyebrow">Для команды до старта проекта</p>
  <p>Перед запуском AI-секретаря полезно разобраться в архитектуре агентов, интеграциях с CRM и телефонией — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>: практические материалы по <strong>внедрению ai агентов</strong> и автоматизации без лишней теории.</p>
</aside>
</div></div></section><section class="nero-ai-section" id="dlya-nish"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>AI-секретарь для салонов, клиник, стоматологий, студий и школ</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>AI-секретарь для бизнеса и AI-секретарь для малого бизнеса — один продукт с разными сценариями. Ниже — типовые отличия по вертикалям.</p>
<h3>Салоны и студии красоты</h3>
<p>AI-секретарь для салона красоты уточняет услугу (стрижка, окрашивание, маникюр), мастера, длительность слота и предоплату при необходимости. Кейс HeadLiners (Tomoru): голосовой робот для обзвона базы и доведения до записи; заявленная конверсия <strong>в 2 раза выше</strong> колл-центра и администратора, стоимость лида <strong>снизилась в 7 раз</strong> (данные вендора). Боль: администратор «весь день на звонках», неэффективный обзвон.</p>
<h3>Медицинские клиники и стоматологии</h3>
<p>AI-секретарь для клиники и AI-секретарь для стоматологии работают с жёстче регламентами: подготовка к анализам, ДМС, выбор врача по специализации. Кейс МЕДСИ: ><strong>3,5 млн звонков в год</strong> автоматизировано; <strong>95%</strong> клиентов положительно оценивают агента (SL Soft AI). Региональная сеть клиник (Fromtech): до <strong>70%</strong> входящих обработано роботом, <strong>>50 записей в день</strong> без оператора.</p>
<p>МедЖарвис.Регистратура (Keremet IT) — пример стека для стоматологии: Mango, UIS, YClients, amoCRM, Medesk.</p>
<h3>Образовательные студии и школы</h3>
<p>AI-запись на приём в школу танцев, языковую студию или детский кружок: выбор группы по возрасту, пробное занятие, напоминание родителям. Интеграция с Google Calendar или лёгкой CRM; акцент на исходящие напоминания — родители часто забывают о расписании ребёнка.</p>
</div></div></section><section class="nero-ai-section nero-ai-section-alt" id="stoimost"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Стоимость внедрения и окупаемость: от чего зависит чек</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Запрос «AI-секретарь цена» логичен на этапе выбора подрядчика. Ориентир чека на внедрение под ключ для типового салона или клиники: <strong>180–500 тыс. ₽</strong> (из коммерческой модели темы; без выдуманных гарантий окупаемости).</p>
<p><strong>От чего зависит стоимость:</strong></p>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>Фактор</th><th>Влияние на чек</th></tr>
<tr><td>CRM (YClients vs кастомная МИС)</td><td>+интеграция</td></tr>
<tr><td>Голос + исходящий anti-no-show</td><td>+модуль обзвона</td></tr>
<tr><td>Требования 152-ФЗ и хостинг в РФ</td><td>+комплаенс-контур</td></tr>
<tr><td>Кастомные сценарии (ДМС, сложный прайс)</td><td>+проектирование</td></tr>
</table></div>
<p>Для сравнения: обзор AiBotManager (2026) указывает базовый бот <strong>50–100 тыс. ₽</strong> + <strong>5–15 тыс. ₽/мес</strong>; продвинутый с 1С — <strong>150–300 тыс. ₽</strong>. Голосовой контур дороже текстового: на vc.ru встречается оценка <strong>~68 тыс. ₽/мес</strong> при разработке порядка 200 тыс. ₽ — ориентир TCO, не оферта.</p>
<p>Автоматизация через AI-секретарь окупается не «сама», а когда:</p>
<ul>
<li>снижается доля пропущенных записных звонков;</li>
<li>падает no-show за счёт напоминаний;</li>
<li>администратор перераспределяет время на очный сервис и допродажи;</li>
<li>не нужен второй сотрудник на первую линию в пик.</li>
</ul>
<p>IBM фиксирует тренд agentic AI в контакт-центрах: у части внедрений — до <strong>50% снижения cost per call</strong> при росте удовлетворённости (источник: IBM Think, contact center automation trends 2026). Для малого бизнеса считайте свою модель: ФОТ администратора vs проект + ежемесячное сопровождение + телефония.</p>
</div></div></section><section class="nero-ai-section" id="keisy"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Кейсы и примеры внедрения AI-секретаря для записи</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Пример внедрения AI-секретаря и AI-секретарь кейсы в России подтверждают: запись голосом — не эксперимент, а масштабируемая практика.</p>
<p><strong>МЕДСИ</strong> — enterprise-эталон: запись, перенос, отмена, проверка ДМС, расчёт стоимости приёма (<a href="https://slsoft.ru/cases/golosovoy-ii-agent-dlya-medsi/" target="_blank" rel="noopener noreferrer">slsoft.ru</a>). Цитата Павла Борченко (ROBIN, SL Soft AI): «ИИ-агенты для коммуникаций существенно повышают производительность контакт-центров… мгновенный ответ и гиперперсонализация общения сегодня становятся нормой».</p>
<p><strong>«Элегра»</strong> — исходящее подтверждение: до 1000 пациентов/день, обзвон в 6 раз быстрее операторов (<a href="https://www.retail.ru/rbc/pressreleases/set-klinik-elegra-zapustila-golosovogo-robota-na-platforme-robovoice/" target="_blank" rel="noopener noreferrer">Retail.ru</a>).</p>
<p><strong>«Гемотест»</strong> — входящий статус заказа + исходящее подтверждение выезда, REST API МИС (<a href="https://robo-voice.ru/case_bot_dlya_gemotest/" target="_blank" rel="noopener noreferrer">robo-voice.ru</a>).</p>
<p><strong>Региональная сеть клиник (Fromtech)</strong> — запись, перенос, отмена; 70% входящих на роботе (<a href="https://www.fromtech.ru/cases/golosovoj-pomoshhnik-dlya-medkliniki/" target="_blank" rel="noopener noreferrer">fromtech.ru</a>).</p>
<p><strong>HeadLiners / Tomoru</strong> — салоны: обзвон и запись (<a href="https://tomoru.ru/cold_calls" target="_blank" rel="noopener noreferrer">tomoru.ru</a>).</p>
<p><strong>Международные ориентиры:</strong> BrightSmile Dental (США) — no-show <strong>−45%</strong>, записи <strong>380 → 740/мес</strong> на 4 локациях с каскадом напоминаний (<a href="https://agentmelt.com/case-studies/ai-voice-agent-healthcare-scheduling/" target="_blank" rel="noopener noreferrer">agentmelt.com</a>). Young Skin Dermatology — <strong>1300+ звонков/мес</strong> на AI-ресепшн с записью в ModMed (<a href="https://talkie.ai/young-skin-dermatology-ai-receptionist-case-study/" target="_blank" rel="noopener noreferrer">talkie.ai</a>).</p>
<h3>Метрики: нагрузка на администратора, % потерянных записей, no-show</h3>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table">
<tr><th>Метрика</th><th>До AI</th><th>Ориентир после внедрения*</th></tr>
<tr><td>Доля типовых обращений на AI</td><td>0%</td><td>30–70% (кейсы РФ)</td></tr>
<tr><td>No-show</td><td>18–30% по вертикали</td><td>−30–60% с напоминаниями</td></tr>
<tr><td>Время обзвона подтверждений</td><td>часы операторов</td><td>до 6× быстрее (Элегра)</td></tr>
</table></div>
<p>*Конкретные цифры зависят от ниши, качества сценария и дисциплины напоминаний; не являются гарантией.</p>
<p>AI-кейсы внедрения показывают общий паттерн: <strong>двухконтурная модель</strong> — входящая запись + исходящее подтверждение — даёт больший эффект, чем только «робот на входящей».</p>
</div></div></section><section class="nero-ai-section nero-ai-section-alt" id="faq-sekretar"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Частые вопросы (FAQ)</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<details class="nero-ai-faq-item"><summary>Сколько времени занимает внедрение?</summary>
<p>Для типового салона или клиники на YClients/amoCRM — <strong>3–6 недель</strong> под ключ: аудит, сценарии, интеграция, пилот, запуск. Простой сценарий без сложной МИС может уложиться в <strong>2–4 недели</strong>; медсеть с ДМС и несколькими филиалами — дольше.</p>
</details>
<details class="nero-ai-faq-item"><summary>Нужна ли замена администратора полностью?</summary>
<p>Нет. AI-секретарь для малого бизнеса и сети снимает рутину первой линии; человек остаётся для сложных кейсов, очного сервиса и контроля качества. Гибридная модель «AI + администратор» — норма в кейсах МЕДСИ и международной практике.</p>
</details>
<details class="nero-ai-faq-item"><summary>Как AI обрабатывает перенос и отмену записи?</summary>
<p>Клиент звонит или отвечает на напоминание → агент идентифицирует запись по телефону/ФИО → предлагает новые слоты или отменяет визит в CRM → при отмене слот освобождается для waitlist. Сценарий реализован в МЕДСИ, Fromtech, Гемотест.</p>
</details>
<details class="nero-ai-faq-item"><summary>Безопасность персональных данных клиентов</summary>
<p>С 01.09.2025 согласие на обработку ПДн — <strong>отдельный документ</strong>; штрафы за нарушения — до <strong>700 тыс.–1,5 млн ₽</strong> (<a href="https://www.klerk.ru/blogs/fedresurs/692524/" target="_blank" rel="noopener noreferrer">klerk.ru</a>). Для голосового AI-секретаря: уведомление о записи разговора, хранение данных в РФ, политика удаления, при необходимости — Yandex SpeechKit вместо зарубежного STT. Голос может квалифицироваться как биометрия — юридический контур согласуется до запуска.</p>
</details>
<details class="nero-ai-faq-item"><summary>Что если робот ошибётся в записи?</summary>
<p>На пилоте прослушивают звонки и донастраивают словарь. Критичные ошибки снижаются правилом: <strong>подтверждение данных клиентом</strong> перед фиксацией в CRM + SMS с итогом записи. Нестандарт — эскалация на администратора.</p>
</details>
<details class="nero-ai-faq-item"><summary>Работает ли AI-секретарь с нашей CRM?</summary>
<p>YClients, Medesk, amoCRM, Битрикс24, Google Calendar, 1С — типовый список интеграций. Если API недоступен, проектируют промежуточный слой или заявку с callback.</p>
</details>
<details class="nero-ai-faq-item"><summary>Можно ли только напоминания без входящей записи?</summary>
<p>Да — кейс «Элегра» начинался с исходящего подтверждения. Но связка входящая запись + anti-no-show даёт максимальный эффект.</p>
</details>
<details class="nero-ai-faq-item"><summary>Подходит ли для автосервиса?</summary>
<p>Да: запись на ТО, напоминания, статус ремонта; интеграция с 1С:Автосервис и amoCRM (обзоры MAX Основа, AiBotManager, 2026).</p>
</details>
</div></div></section><section class="nero-ai-section" id="scenario-cta-section"><div class="nero-ai-container">
<div class="nero-ai-final-cta nero-ai-card nero-ai-reveal" id="scenario-cta">
  <h2>Получить сценарий AI-секретаря для вашей записи</h2>
  <p>Nero Network внедряет AI-секретарь под ключ: кастомный агент, оркестрация на Make/n8n, API вашей системы учёта, измеримый сценарий «подбор времени → запись → подтверждение». Ориентир проекта — 180–500 тыс. ₽ в зависимости от интеграций и филиалов.</p>
  <p><strong>Оффер:</strong> AI подбирает время, записывает клиента и отправляет подтверждение — вы видите заполненный календарь вместо пропущенных звонков и пустых окон.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
    <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>
  </div>
</div>
</div></section>

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
  "headline": "AI-секретарь для записи клиентов — внедрение под ключ",
  "description": "Голосовой AI-секретарь подбирает свободное время, записывает клиента на услугу и отправляет подтверждение. Внедрение для салонов, клиник и студий.",
  "author": {"@type": "Organization", "name": "Nero Network"},
  "mainEntityOfPage": {"@type": "WebPage"},
  "about": {"@type": "Service", "name": "Внедрение AI-секретаря для записи клиентов"}
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type": "Question", "name": "Сколько времени занимает внедрение?", "acceptedAnswer": {"@type": "Answer", "text": "Для типового салона или клиники на YClients/amoCRM — 3–6 недель под ключ."}},
    {"@type": "Question", "name": "Нужна ли замена администратора полностью?", "acceptedAnswer": {"@type": "Answer", "text": "Нет. AI снимает рутину первой линии; человек остаётся для сложных кейсов."}},
    {"@type": "Question", "name": "Как AI обрабатывает перенос и отмену записи?", "acceptedAnswer": {"@type": "Answer", "text": "Агент идентифицирует запись, предлагает новые слоты или отменяет визит в CRM."}},
    {"@type": "Question", "name": "Безопасность персональных данных клиентов", "acceptedAnswer": {"@type": "Answer", "text": "Уведомление о записи, хранение данных в РФ, политика удаления, Yandex SpeechKit при необходимости."}}
  ]
}
</script>

<?php get_footer(); ?>

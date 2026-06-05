<?php
/**
 * Template Name: AI-обработка заявок с сайта
 */
$page_seo_title = 'AI-обработка заявок с сайта — внедрение агента под ключ';
$page_seo_description = 'Внедрим AI-агента для обработки заявок с сайта: ответ за 5–15 секунд, квалификация лида и передача в CRM. Под ключ для МСБ, услуг, школ и клиник. Аудит потерь заявок.';
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить, сколько заявок вы теряете';
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
#ai-obrabotka-zayavok-s-sayta-primary, #primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}
.ai-obrabotka-zayavok-s-sayta-page { margin: 0; padding: 0; overflow: visible; }

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
.nero-ai-hero {
  padding-top: clamp(108px, 14vh, 148px);
}

/* Intro after hero */
.ai-obrabotka-zayavok-s-sayta-intro {
  padding: clamp(48px, 6vw, 72px) 0 clamp(28px, 4vw, 40px);
}
.ai-obrabotka-zayavok-s-sayta-intro__grid {
  display: grid;
  grid-template-columns: minmax(0, 1.15fr) minmax(280px, 0.85fr);
  gap: clamp(24px, 4vw, 40px);
  align-items: start;
}
.ai-obrabotka-zayavok-s-sayta-intro__text {
  text-align: left !important;
  border-left: 4px solid var(--nero-ai-primary);
  padding-left: clamp(18px, 3vw, 28px);
}
.ai-obrabotka-zayavok-s-sayta-intro__text p {
  text-align: left !important;
  margin: 0 0 16px;
  font-size: clamp(16px, 1.6vw, 18px);
  line-height: 1.65;
  color: var(--nero-ai-soft) !important;
}
.ai-obrabotka-zayavok-s-sayta-intro__text p:last-child { margin-bottom: 0; }
.ai-obrabotka-zayavok-s-sayta-intro__lead {
  font-size: clamp(17px, 1.8vw, 20px) !important;
  color: var(--nero-ai-heading) !important;
  font-weight: 650;
}
.ai-obrabotka-zayavok-s-sayta-intro__terminal {
  padding: 18px;
  border-radius: 20px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.10);
}
.ai-obrabotka-zayavok-s-sayta-intro__terminal-head {
  display: flex;
  gap: 6px;
  margin-bottom: 14px;
}
.ai-obrabotka-zayavok-s-sayta-intro__terminal-head span {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(255,255,255,.22);
}
.ai-obrabotka-zayavok-s-sayta-intro__terminal-head span:nth-child(1) { background: #fb7185; }
.ai-obrabotka-zayavok-s-sayta-intro__terminal-head span:nth-child(2) { background: #fbbf24; }
.ai-obrabotka-zayavok-s-sayta-intro__terminal-head span:nth-child(3) { background: #34d399; }
.ai-obrabotka-zayavok-s-sayta-intro__chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 14px;
  padding: 0;
  list-style: none;
}
.ai-obrabotka-zayavok-s-sayta-intro__chips li {
  padding: 7px 11px;
  border-radius: 999px;
  border: 1px solid rgba(121,242,255,.22);
  background: rgba(121,242,255,.08);
  color: var(--nero-ai-primary) !important;
  font-size: 12px;
  font-weight: 700;
}
.ai-obrabotka-zayavok-s-sayta-intro__metric {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}
.ai-obrabotka-zayavok-s-sayta-intro__metric div {
  padding: 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.08);
}
.ai-obrabotka-zayavok-s-sayta-intro__metric strong {
  display: block;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.ai-obrabotka-zayavok-s-sayta-intro__metric span {
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
  .ai-obrabotka-zayavok-s-sayta-intro__grid { grid-template-columns: 1fr; }
}


</style>

<main id="primary" class="site-main ai-obrabotka-zayavok-s-sayta-page nero-ai-home-page" role="main" tabindex="-1">
<?php
$nero_header_nav_links = [
    ['href' => '#pochemu-zayavki-ostyvayut', 'label' => 'Почему остывают'],
    ['href' => '#chto-takoe-ai-obrabotka', 'label' => 'AI-обработка'],
    ['href' => '#kak-rabotaet-ai-agent', 'label' => 'Сценарий'],
    ['href' => '#vnedrenie-ai-pod-klyuch', 'label' => 'Внедрение'],
    ['href' => '#stoimost-vnedreniya', 'label' => 'Стоимость'],
    ['href' => '#faq-ai-obrabotka', 'label' => 'FAQ'],
];
$nero_header_cta_label = $primary_cta_label;
$nero_header_cta_url = '#audit-cta';
$nero_header = get_stylesheet_directory() . '/partials/nero-ai-site-header.php';
if (is_readable($nero_header)) {
    require $nero_header;
}
?>

<section class="nero-ai-hero" aria-labelledby="ai-obrabotka-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow">AI-агент · обработка заявок с сайта</p>
      <h1 id="ai-obrabotka-hero-title">AI-обработка заявок с сайта: <span class="nero-ai-gradient-text">внедрение агента под ключ</span></h1>
      <p class="nero-ai-hero-lead">Отвечаем на заявки за 5–15 секунд, квалифицируем лид и передаём в CRM — без найма дополнительных менеджеров</p>
      <ul class="nero-ai-badges" aria-label="Этапы внедрения">
        <li class="nero-ai-badge">Заявка с сайта</li>
        <li class="nero-ai-badge">Ответ 5–15 сек</li>
        <li class="nero-ai-badge">Квалификация</li>
        <li class="nero-ai-badge">Карточка в CRM</li>
        <li class="nero-ai-badge">Задача менеджеру</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демонстрация AI-обработки заявок">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-агента · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Поток заявок · ночной режим</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric" data-nero-tooltip="AI фиксирует заявку с формы и отвечает за секунды, пока менеджеры офлайн.">
              <span>Заявок за ночь</span><strong>12</strong><small>пример</small>
            </div>
            <div class="nero-ai-metric" data-nero-tooltip="Цель — сократить ожидание: автоответ, квалификация и задача менеджеру запускаются сразу.">
              <span>Средний ответ</span><strong>0:08</strong><small>минуты</small>
            </div>
            <div class="nero-ai-metric" data-nero-tooltip="Горячие лиды попадают в CRM с полями и тегами без ручного копирования.">
              <span>Лидов в CRM</span><strong>3</strong><small>за смену</small>
            </div>
            <div class="nero-ai-metric" data-nero-tooltip="Демонстрационная метрика: эффект зависит от процесса и интеграций.">
              <span>Ручная первичка</span><strong>−42%</strong><small>потенциал пилота</small>
            </div>
          </div>
          <div class="nero-ai-task-stream" aria-label="Живой поток заявок">
            <div class="nero-ai-task"><span class="nero-ai-task-icon">↳</span><div><strong>Новая заявка с формы</strong><span>AI ответ за 8 сек</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">CRM</span><div><strong>Лид квалифицирован</strong><span>Карточка и теги в CRM</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Задача менеджеру</strong><span>Позвонить утром</span></div><span class="nero-ai-status">новое</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="nero-ai-section-tight ai-obrabotka-zayavok-s-sayta-intro" aria-label="Введение">
  <div class="nero-ai-container">
    <div class="ai-obrabotka-zayavok-s-sayta-intro__grid nero-ai-reveal">
      <div class="ai-obrabotka-zayavok-s-sayta-intro__text">
        <p class="ai-obrabotka-zayavok-s-sayta-intro__lead"><strong>Коротко:</strong> AI-агент для первичной обработки заявок — это слой автоматизации между формой, виджетом или мессенджером и CRM. Он отвечает за 5–15 секунд, уточняет детали, квалифицирует лид и передаёт горячую карточку менеджеру.</p>
        <p>Заявки с сайта не ждут рабочего дня. Ниже — как это работает, для кого подходит, сколько стоит и какие риски учесть до запуска.</p>
      </div>
      <div class="ai-obrabotka-zayavok-s-sayta-intro__terminal nero-ai-reveal nero-ai-delay-1" aria-hidden="true">
        <div class="ai-obrabotka-zayavok-s-sayta-intro__terminal-head"><span></span><span></span><span></span></div>
        <ul class="ai-obrabotka-zayavok-s-sayta-intro__chips">
          <li>5–15 сек ответ</li>
          <li>amoCRM / Битрикс24</li>
          <li>Telegram 24/7</li>
          <li>human_review</li>
        </ul>
        <div class="ai-obrabotka-zayavok-s-sayta-intro__metric">
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
    <li><a href="#chto-takoe-ai-obrabotka">Что такое AI-обработка</a></li>
    <li><a href="#kak-rabotaet-ai-agent">Сценарий за 5–15 секунд</a></li>
    <li><a href="#vnedrenie-ai-pod-klyuch">Внедрение под ключ</a></li>
    <li><a href="#integraciya-crm">Интеграция с CRM</a></li>
    <li><a href="#dlya-kogo-podhodit">Для кого подходит</a></li>
    <li><a href="#keisy-primery">Кейсы и примеры</a></li>
    <li><a href="#stoimost-vnedreniya">Стоимость</a></li>
    <li><a href="#riski-kontrol-kachestva">Риски и ПДн</a></li>
    <li><a href="#faq-ai-obrabotka">FAQ</a></li>
    <li><a href="#audit-cta">Аудит потерь заявок</a></li>
  </ul>
</nav>

<section class="nero-ai-section" id="pochemu-zayavki-ostyvayut"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Почему заявки с сайта остывают без быстрого ответа</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Заявка с сайта — это не просто строка в CRM. Это момент, когда клиент готов к диалогу. Если ответ приходит через часы или на следующий день, интерес падает: человек уже сравнил конкурентов, оставил заявку ещё где-то или отложил решение.</p>
<h3>Ночные и выходные заявки без ответа</h3>
<p>Типичная боль для малого и среднего бизнеса, услуг, онлайн-школ и клиник: заявки приходят ночью и в выходные, а менеджеры отвечают только в рабочее время. Клиент не видит реакции — и уходит. AI-менеджер заявок закрывает этот разрыв: первая линия работает круглосуточно, без найма дополнительного штата на смены.</p>
<h3>Скорость первого ответа и конверсия в сделку</h3>
<p>Классическое исследование MIT Lead Response Management Study, обобщённое в Harvard Business Review («The Short Life of Online Sales Leads», 2011), показывает: контакт с лидом в течение 5 минут даёт в 21 раз больше шансов квалифицировать обращение, чем контакт через 30 минут. Контакт в течение часа — почти в 7 раз эффективнее, чем даже на час позже.</p>
<p>Отдельный аудит HBR по тому же материалу фиксировал среднее время ответа около 42 часов среди компаний, которые вообще ответили; 23% обращений остались без ответа. Это данные 2011 года — не свежий бенчмарк 2026 года, но они объясняют, почему боль «медленный ответ» остаётся актуальной: рынок по-прежнему теряет лиды на этапе первичного контакта.</p>
<p><strong>Итог:</strong> AI-обработка заявок решает не «модную задачу», а измеримый разрыв между моментом обращения и реакцией бизнеса. Чем быстрее первый ответ — тем выше шанс, что лид дойдёт до менеджера тёплым.</p>
</div></div></section>
<section class="nero-ai-section nero-ai-section-alt" id="chto-takoe-ai-obrabotka"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Что такое AI-обработка заявок с сайта</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Определение:</strong> AI-обработка заявок с сайта — автоматизация первичного контакта с входящим обращением. Агент читает свободный текст заявки, отвечает за секунды, задаёт уточняющие вопросы, извлекает структурированные поля (контакт, потребность, срочность, бюджетный диапазон), присваивает статус лида и создаёт или обновляет карточку в CRM с резюме для менеджера.</p>
<p>Это не «чат-бот по кнопкам» с заготовленными ответами. И не замена отдела продаж. Это первая линия между посетителем и вашей воронкой.</p>
<h3>Ответ vs действие: чем агент отличается от простого чат-бота</h3>
<p>Скриптовый чат-бот ведёт по веткам: нажал кнопку — получил шаблон. AI-агент для сайта понимает свободную формулировку, обращается к базе знаний через RAG (retrieval-augmented generation) и <strong>выполняет действия</strong>: создаёт лид, ставит тег, меняет статус, уведомляет менеджера.</p>
<p>Тренд 2026 года — agentic AI: модель не только генерирует текст, но и работает с инструментами. OpenAI в апреле 2026 представила workspace agents — облачные агенты для команд, в том числе шаблон Lead Outreach Agent: исследует входящие лиды, скорит по рубрике квалификации, готовит follow-up, обновляет CRM. Для российского бизнеса аналогичную логику реализуют через оркестратор (n8n, Make, backend) + YandexGPT или GigaChat + amoCRM или Битрикс24 с хранением персональных данных в РФ.</p>
<p>Нативный AI-агент внутри CRM (например, встроенный AI-агент amoCRM) отвечает клиентам и выполняет действия в воронке: создаёт задачи, меняет ответственного, переводит сделки, управляет тегами. Но кастомное внедрение даёт гибкость: сценарий под нишу, мультиканал, собственная база знаний и режим human-in-the-loop.</p>
<h3>Квалификация лида и сбор контекста до CRM</h3>
<p>До попадания в CRM агент собирает минимально достаточный контекст:</p>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table"><tr><th>Поле</th><th>Зачем нужно</th></tr><tr><td>Имя и контакт</td><td>Связь с клиентом</td></tr><tr><td>Суть запроса</td><td>Маршрутизация к нужному менеджеру</td></tr><tr><td>Срочность</td><td>Приоритет задачи «перезвонить»</td></tr><tr><td>Бюджетный диапазон (если уместно)</td><td>Квалификация без лишней анкеты</td></tr><tr><td>Статус</td><td><code>new_lead</code> / <code>need_more_info</code> / <code>support</code> / <code>spam</code> / <code>human_review</code></td></tr></table></div>
<p>Один уточняющий вопрос за раз — не анкета из десяти полей. Такой подход совпадает с отраслевым трендом conversational qualification: по отчёту Perspective AI, доля B2B SaaS-воронок с диалоговой квалификацией выросла с 22% в 2024 до 78% в 2026 в их выборке. Модель «форма → MQL → BDR» сменяется одним AI-диалогом, который готовит лид к разговору с менеджером.</p>
</div></div></section>
<div class="nero-ai-container"><section class="boris-lead-split" id="ai-obrabotka-zayavok-boris-block" aria-label="Визуализация оркестрации AI-обработки заявок">
<style>
#ai-obrabotka-zayavok-boris-block.boris-lead-split {
  margin: 40px 0 48px;
  padding: 0;
}
#ai-obrabotka-zayavok-boris-block .boris-lead-card {
  display: grid;
  grid-template-columns: 1fr;
  gap: 28px;
  padding: clamp(24px, 4vw, 40px);
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 55%, #f1f5f9 100%);
  border: 1px solid #e2e8f0;
  border-radius: 22px;
  box-shadow: 0 18px 48px rgba(15, 23, 42, 0.06);
}
@media (min-width: 1024px) {
  #ai-obrabotka-zayavok-boris-block .boris-lead-card {
    grid-template-columns: 1.1fr 0.9fr;
    align-items: center;
    gap: 36px;
  }
}
#ai-obrabotka-zayavok-boris-block .boris-eyebrow {
  margin: 0 0 10px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #64748b;
}
#ai-obrabotka-zayavok-boris-block .boris-kicker {
  margin: 0 0 12px;
  font-size: clamp(22px, 2.6vw, 28px);
  line-height: 1.2;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -0.02em;
}
#ai-obrabotka-zayavok-boris-block .boris-bridge {
  margin: 0 0 20px;
  font-size: 15px;
  line-height: 1.55;
  color: #475569;
}
#ai-obrabotka-zayavok-boris-block .boris-points {
  display: grid;
  gap: 12px;
  margin: 0 0 18px;
  padding: 0;
  list-style: none;
}
#ai-obrabotka-zayavok-boris-block .boris-points li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 14px;
  line-height: 1.45;
  color: #334155;
}
#ai-obrabotka-zayavok-boris-block .boris-points li::before {
  content: "";
  flex: 0 0 8px;
  width: 8px;
  height: 8px;
  margin-top: 6px;
  border-radius: 50%;
  background: linear-gradient(135deg, #3b82f6, #10b981);
}
#ai-obrabotka-zayavok-boris-block .boris-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
#ai-obrabotka-zayavok-boris-block .boris-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 12px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 700;
  color: #0f172a;
  background: #fff;
  border: 1px solid #e2e8f0;
}
#ai-obrabotka-zayavok-boris-block .boris-pill strong {
  color: #059669;
}
#ai-obrabotka-zayavok-boris-block .boris-canvas-wrap {
  position: relative;
  min-height: 380px;
  border-radius: 18px;
  overflow: hidden;
  background:
    radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.08), transparent 45%),
    radial-gradient(circle at 80% 70%, rgba(16, 185, 129, 0.08), transparent 40%),
    #ffffff;
  border: 1px solid #e2e8f0;
}
#ai-obrabotka-zayavok-boris-block #lead-orchestra-canvas {
  display: block;
  width: 100%;
  height: 100%;
  min-height: 380px;
}
#ai-obrabotka-zayavok-boris-block .boris-caption {
  position: absolute;
  left: 14px;
  right: 14px;
  bottom: 12px;
  padding: 8px 12px;
  border-radius: 10px;
  font-size: 11px;
  line-height: 1.35;
  color: #475569;
  background: rgba(255, 255, 255, 0.92);
  border: 1px solid #e2e8f0;
  backdrop-filter: blur(6px);
  pointer-events: none;
}
</style>

<div class="boris-lead-card">
  <div class="boris-lead-copy">
    <p class="boris-eyebrow">Оркестрация · не просто чат</p>
    <h3 class="boris-kicker">Заявка превращается в карточку CRM за секунды</h3>
    <p class="boris-bridge">В hero — оффер и дашборд потока заявок; здесь — механика решения: один входящий пакет проходит webhook, AI-агент и попадает менеджеру уже с полями квалификации.</p>
    <ul class="boris-points">
      <li>Форма или виджет отправляет payload без ручного копирования</li>
      <li>Агент извлекает контакт, запрос и срочность — по одному уточнению</li>
      <li>Карточка в amoCRM / Битрикс24 с резюме диалога и задачей «перезвонить»</li>
    </ul>
    <div class="boris-pills" aria-hidden="true">
      <span class="boris-pill"><strong>5–15</strong> сек ответ</span>
      <span class="boris-pill">webhook → RAG</span>
      <span class="boris-pill">human_review</span>
    </div>
  </div>

  <div class="boris-canvas-wrap">
    <canvas id="lead-orchestra-canvas" role="img" aria-label="Анимация: заявка с сайта проходит AI-агента и попадает в CRM"></canvas>
    <p class="boris-caption">Схема потока: форма → webhook → AI-агент → CRM → менеджер. Дальше разберём пошаговый сценарий на сайте.</p>
  </div>
</div>

<script>
(function leadOrchestraEngine() {
  var canvas = document.getElementById('lead-orchestra-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var wrap = canvas.parentElement;
  var cw = 0, ch = 0, frame = 0, dpr = 1;

  var C = {
    ink: '#0f172a',
    muted: '#94a3b8',
    line: '#cbd5e1',
    blue: '#3b82f6',
    green: '#10b981',
    violet: '#8b5cf6',
    amber: '#f59e0b',
    card: '#ffffff',
    soft: '#f1f5f9'
  };

  var nodes = [];
  var packet = { t: 0, stage: 0, alpha: 1, fields: 0 };
  var bubbles = [];
  var timerSec = 0;

  function resize() {
    if (!wrap) return;
    dpr = Math.min(window.devicePixelRatio || 1, 2);
    cw = wrap.clientWidth || 480;
    ch = Math.max(380, Math.min(520, cw * 0.72));
    canvas.width = Math.floor(cw * dpr);
    canvas.height = Math.floor(ch * dpr);
    canvas.style.height = ch + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    layoutNodes();
  }

  function layoutNodes() {
    var pad = 28;
    var y = ch * 0.46;
    var span = cw - pad * 2;
    var xs = [0.08, 0.28, 0.5, 0.72, 0.92].map(function (f) { return pad + span * f; });
    nodes = [
      { id: 'form', x: xs[0], y: y, label: 'Форма', color: C.blue, icon: 'form' },
      { id: 'hook', x: xs[1], y: y, label: 'Webhook', color: C.violet, icon: 'hook' },
      { id: 'ai', x: xs[2], y: y, label: 'AI-агент', color: C.green, icon: 'ai' },
      { id: 'crm', x: xs[3], y: y, label: 'CRM', color: C.amber, icon: 'crm' },
      { id: 'mgr', x: xs[4], y: y, label: 'Менеджер', color: C.ink, icon: 'mgr' }
    ];
  }

  function rr(x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 2; ctx.stroke(); }
  }

  function drawGrid() {
    ctx.strokeStyle = 'rgba(148, 163, 184, 0.18)';
    ctx.lineWidth = 1;
    for (var gx = 0; gx < cw; gx += 24) {
      ctx.beginPath(); ctx.moveTo(gx, 0); ctx.lineTo(gx, ch); ctx.stroke();
    }
    for (var gy = 0; gy < ch; gy += 24) {
      ctx.beginPath(); ctx.moveTo(0, gy); ctx.lineTo(cw, gy); ctx.stroke();
    }
  }

  function drawPaths() {
    for (var i = 0; i < nodes.length - 1; i++) {
      var a = nodes[i], b = nodes[i + 1];
      var mx = (a.x + b.x) / 2;
      var my = a.y - 36 - i * 4;
      ctx.strokeStyle = C.line;
      ctx.lineWidth = 2;
      ctx.setLineDash([6, 6]);
      ctx.beginPath();
      ctx.moveTo(a.x + 34, a.y);
      ctx.quadraticCurveTo(mx, my, b.x - 34, b.y);
      ctx.stroke();
      ctx.setLineDash([]);
      var flow = (frame * 0.04 + i * 0.2) % 1;
      var px = a.x + 34 + (b.x - 34 - (a.x + 34)) * flow;
      var py = a.y + (my - a.y) * Math.sin(flow * Math.PI);
      ctx.fillStyle = nodes[i + 1].color;
      ctx.beginPath(); ctx.arc(px, py, 3, 0, Math.PI * 2); ctx.fill();
    }
  }

  function drawNode(n, pulse) {
    var s = 34;
    rr(n.x - s, n.y - s, s * 2, s * 2, 12, C.card, C.ink);
    if (pulse > 0) {
      ctx.strokeStyle = n.color;
      ctx.globalAlpha = 0.25 + pulse * 0.35;
      ctx.lineWidth = 3;
      ctx.beginPath(); ctx.arc(n.x, n.y, s + 8 + pulse * 10, 0, Math.PI * 2); ctx.stroke();
      ctx.globalAlpha = 1;
    }
    ctx.fillStyle = n.color;
    if (n.icon === 'form') {
      rr(n.x - 14, n.y - 10, 28, 20, 3, C.soft, C.ink);
      rr(n.x - 10, n.y - 4, 20, 2, 1, C.muted, null);
      rr(n.x - 10, n.y + 2, 14, 2, 1, C.muted, null);
    } else if (n.icon === 'hook') {
      ctx.beginPath(); ctx.arc(n.x, n.y, 10, 0.4 * Math.PI, 1.6 * Math.PI); ctx.strokeStyle = n.color; ctx.lineWidth = 3; ctx.stroke();
      ctx.beginPath(); ctx.moveTo(n.x + 8, n.y - 2); ctx.lineTo(n.x + 14, n.y + 8); ctx.stroke();
    } else if (n.icon === 'ai') {
      ctx.beginPath(); ctx.arc(n.x, n.y, 11, 0, Math.PI * 2); ctx.fill();
      for (var k = 0; k < 6; k++) {
        var ang = k / 6 * Math.PI * 2 + frame * 0.03;
        ctx.beginPath(); ctx.moveTo(n.x, n.y);
        ctx.lineTo(n.x + Math.cos(ang) * 16, n.y + Math.sin(ang) * 16);
        ctx.strokeStyle = 'rgba(16,185,129,0.45)'; ctx.lineWidth = 2; ctx.stroke();
      }
    } else if (n.icon === 'crm') {
      rr(n.x - 12, n.y - 14, 24, 28, 3, C.soft, C.ink);
      rr(n.x - 8, n.y - 8, 16, 3, 1, n.color, null);
      rr(n.x - 8, n.y - 2, 12, 2, 1, C.muted, null);
      rr(n.x - 8, n.y + 4, 14, 2, 1, C.muted, null);
    } else {
      ctx.beginPath(); ctx.arc(n.x, n.y - 6, 8, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.moveTo(n.x - 12, n.y + 14); ctx.quadraticCurveTo(n.x, n.y + 2, n.x + 12, n.y + 14);
      ctx.fill();
    }
    ctx.fillStyle = C.ink;
    ctx.font = '600 11px Inter, system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(n.label, n.x, n.y + s + 16);
  }

  function packetPos(t) {
    var idx = Math.min(Math.floor(t * 4), 3);
    var local = (t * 4) - idx;
    var a = nodes[idx], b = nodes[idx + 1];
    return {
      x: a.x + (b.x - a.x) * local,
      y: a.y - 18 + Math.sin(local * Math.PI) * -22
    };
  }

  function spawnBubble(x, y, text) {
    bubbles.push({ x: x, y: y, text: text, life: 0 });
  }

  function drawPacket() {
    var p = packetPos(packet.t);
    ctx.save();
    ctx.globalAlpha = packet.alpha;
    rr(p.x - 14, p.y - 10, 28, 20, 5, C.blue, C.ink);
    ctx.fillStyle = '#fff';
    ctx.font = '700 9px Inter, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('лид', p.x, p.y + 3);
    ctx.restore();
  }

  function drawBubbles() {
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life += 1;
      var a = Math.max(0, 1 - b.life / 90);
      ctx.globalAlpha = a;
      var tw = ctx.measureText(b.text).width + 16;
      rr(b.x - tw / 2, b.y - 22 - b.life * 0.4, tw, 20, 8, '#fff', C.ink);
      ctx.fillStyle = C.ink;
      ctx.font = '600 10px Inter, sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(b.text, b.x, b.y - 8 - b.life * 0.4);
      ctx.globalAlpha = 1;
      if (b.life > 90) bubbles.splice(i, 1);
    }
  }

  function drawTimer() {
    var boxW = 118, boxH = 36;
    rr(cw - boxW - 16, 16, boxW, boxH, 10, '#fff', C.ink);
    ctx.fillStyle = C.muted;
    ctx.font = '600 10px Inter, sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Первый ответ', cw - boxW - 4, 30);
    ctx.fillStyle = C.green;
    ctx.font = '800 14px Inter, sans-serif';
    ctx.fillText(timerSec.toFixed(0) + ' сек', cw - boxW + 72, 38);
  }

  function drawCrmFill() {
    if (packet.t < 0.62) return;
    var crm = nodes[3];
    var prog = Math.min(1, (packet.t - 0.62) / 0.2);
    rr(crm.x - 22, crm.y + 44, 44 * prog, 6, 3, C.green, null);
    if (prog > 0.35 && packet.fields < 3) {
      packet.fields++;
      var labels = ['Имя + телефон', 'Срочность: высокая', 'Статус: new_lead'];
      spawnBubble(crm.x, crm.y - 30, labels[packet.fields - 1]);
    }
  }

  function tickCycle() {
    packet.t += 0.0042;
    timerSec = Math.min(15, packet.t * 48);
    if (packet.t >= 1) {
      packet.t = 0;
      packet.fields = 0;
      timerSec = 0;
      bubbles.length = 0;
    }
    if (Math.abs(packet.t - 0.5) < 0.006) spawnBubble(nodes[2].x, nodes[2].y - 40, 'Уточняем запрос…');
  }

  function draw() {
    ctx.clearRect(0, 0, cw, ch);
    drawGrid();
    drawPaths();
    var aiPulse = packet.t > 0.35 && packet.t < 0.72 ? Math.sin(frame * 0.12) * 0.5 + 0.5 : 0;
    for (var i = 0; i < nodes.length; i++) {
      drawNode(nodes[i], nodes[i].icon === 'ai' ? aiPulse : 0);
    }
    drawCrmFill();
    drawPacket();
    drawBubbles();
    drawTimer();
    tickCycle();
    frame++;
    requestAnimationFrame(draw);
  }

  window.addEventListener('resize', resize);
  resize();
  draw();
})();
</script>
</section></div>
<section class="nero-ai-section" id="kak-rabotaet-ai-agent"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Как работает AI-агент на сайте: сценарий за 5–15 секунд</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p><strong>Коротко:</strong> посетитель оставляет заявку → webhook передаёт данные в оркестратор → клиент получает ответ за 5–15 секунд → агент уточняет детали → карточка попадает в CRM → менеджер подключается к подготовленному лиду.</p>
<h3>Виджет на сайте, мессенджеры и формы</h3>
<p>Типовой стек 2026 года для AI-обработки заявок для бизнеса:</p>
<ul>
<li><strong>Виджет чата</strong> на сайте (WordPress, Tilda, Bitrix-сайт)</li>
<li><strong>Webhook</strong> с формы обратной связи (Contact Form 7, WPForms, Tilda)</li>
<li><strong>Мессенджеры:</strong> Telegram, WhatsApp, VK</li>
<li><strong>Оркестратор:</strong> n8n, Make.com, Albato или Python backend на VPS в РФ</li>
<li><strong>LLM + RAG:</strong> YandexGPT, GigaChat (для ПДн) или зарубежная модель без персональных данных</li>
<li><strong>CRM:</strong> amoCRM, Битрикс24, RetailCRM, GetCourse (для школ)</li>
</ul>
<p>Схема потока: <strong>форма или виджет → webhook → AI-агент → CRM → менеджер</strong>.</p>
<h3>Уточняющие вопросы и эскалация на живого менеджера</h3>
<p>Логика работы системы (проектная модель Nero Network):</p>
<ol>
<li>Посетитель отправляет заявку — форма или первое сообщение в виджете.</li>
<li>Webhook мгновенно передаёт payload в оркестратор; параллельно клиенту уходит автоответ «приняли заявку, уточним детали» (5–15 сек).</li>
<li>LLM извлекает поля: имя, контакт, запрос, срочность; проверяет дубль в CRM.</li>
<li>Если данных не хватает — один уточняющий вопрос.</li>
<li>Агент присваивает статус и создаёт или обновляет сделку в CRM с резюме.</li>
<li>Менеджер подключается к «горячему» лиду с готовым контекстом.</li>
<li>Спорные кейсы — только после статуса <code>human_review</code>.</li>
</ol>
<p>Эскалация обязательна для: цен и скидок, претензий, медицинских и юридических вопросов, негатива. На старте рекомендуется режим <strong>ассистента → автоответ</strong>: сначала агент готовит карточку и черновик ответа для менеджера; после 1–2 недель стабильной выборки — автоответы на безопасные уточняющие вопросы.</p>
</div></div></section>
<section class="nero-ai-section nero-ai-section-alt" id="vnedrenie-ai-pod-klyuch"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Внедрение AI под ключ: этапы и сроки</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Внедрение AI-агентов в бизнес — не покупка «коробки за три дня», а поэтапный проект. Конкуренты обещают запуск от 3 до 7 дней (kamensky-lab.ru, v-ai-labs.ru) или 2–4 недели для простых сценариев (обзор lidzavod.ru). Реалистичный корпоративный проект — до 3–6 месяцев. Nero Network ориентируется на коммерческий сегмент МСБ с понятным чеком и поэтапным пилотом.</p>
<h3>Аудит потерь заявок и карта точек контакта</h3>
<p>Первый шаг — <strong>аудит потерь заявок за 30 минут</strong> (лид-магнит из проекта):</p>
<ul>
<li>замер текущего времени первого ответа по 10–20 тестовым заявкам;</li>
<li>карта каналов: форма, чат, мессенджеры;</li>
<li>проверка соответствия 152-ФЗ и настроек CRM.</li>
</ul>
<p>Это отличает подход «диагностика дыры в воронке» от продажи «просто бота». Вы получаете цифру: сколько минут и часов сейчас проходит до первого контакта.</p>
<h3>Настройка сценариев, базы знаний и тестирование</h3>
<p>На этапе настройки AI-обработки заявок формируются:</p>
<ul>
<li><strong>База знаний + RAG:</strong> FAQ, услуги, прайс-диапазоны, скрипты уточнений, запретные темы (цены без источника, юридические обещания).</li>
<li><strong>Регламент квалификации:</strong> какие поля обязательны.</li>
<li><strong>30–50 реальных (обезличенных) примеров заявок</strong> для обучения и тестов.</li>
<li><strong>Пилот на одном канале:</strong> только форма «получить консультацию» или только виджет — без смешивания поддержки, вакансий, партнёрств.</li>
</ul>
<p>Данные для запуска: доступ к CRM API, схема воронки, политика обработки ПДн, текст согласия, список запретных формулировок, контакты менеджеров для эскалации.</p>
<h3>Запуск и поддержка</h3>
<p>После тестирования — запуск в боевом режиме и ежемесячный разбор журнала ошибок с обновлением базы знаний. По данным РБК Компании (2026), для типовых операций первой линии в отрасли указывают ориентир точности 85–92% в зависимости от сценария — это оценка из публикации, не универсальная гарантия для каждого проекта.</p>
<p><strong>Как внедрить AI-обработку заявок без хаоса:</strong> один канал → режим ассистента → автоответ на безопасные сценарии → масштабирование на мессенджеры.</p>
<aside class="nero-ai-inline-cta nero-ai-card nero-ai-reveal" aria-label="Аудит потерь заявок">
  <p class="nero-ai-eyebrow">Лид-магнит · 30 минут</p>
  <h3>Проверьте, сколько заявок вы теряете из-за медленного ответа</h3>
  <p>Замерим реальное время первого контакта по тестовым обращениям, разберём каналы (форма, чат, мессенджеры) и оценим готовность CRM к пилоту AI-агента на одном канале.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside>
</div></div></section>
<section class="nero-ai-section" id="integraciya-crm"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Интеграция с CRM: amoCRM, Битрикс24 и вебхуки</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Интеграция AI-обработки заявок с CRM — ключевой блок. Без него агент остаётся «умным чатом», а менеджер по-прежнему вручную переносит данные.</p>
<h3>Передача горячего лида в воронку</h3>
<p>CRM-коннектор создаёт или обновляет сделку через API: amoCRM API v4, Битрикс24 REST, RetailCRM. Оркестрация через n8n или Make: webhook формы → AI Agent node → tools (<code>create_lead</code>, <code>update_lead</code>, <code>notify_manager</code>).</p>
<p>Встроенный AI-агент amoCRM подключается к каналам (сайт, мессенджеры через цифровую воронку) и выполняет действия по правилам. Кастомное внедрение Nero Network закрывает сценарии, которые SaaS не покрывает: RAG под нишу, мультиканал, аудит качества, поэтапный human_review.</p>
<h3>Поля, теги и история диалога в карточке</h3>
<p>В карточке CRM сохраняются:</p>
<ul>
<li>извлечённые поля квалификации;</li>
<li>теги источника («AI-агент», канал);</li>
<li>резюме диалога на русском для менеджера;</li>
<li>задача «перезвонить» с приоритетом по срочности;</li>
<li>полная история переписки для контекста.</li>
</ul>
<p>Аналитика: цели в Яндекс.Метрике, CRM-отчёты по источнику «AI-агент». Так вы видите не только количество диалогов, но и долю целевых заявок — как в кейсе Bquadro для промышленной компании, где за первый полноценный месяц работы ассистента зафиксирована доля целевых заявок с сайта, приведённых ИИ (5% в публичном кейсе на Workspace.ru).</p>
</div></div></section>
<section class="nero-ai-section nero-ai-section-alt" id="dlya-kogo-podhodit"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Для кого подходит: МСБ, услуги, онлайн-школы и клиники</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>AI-обработка заявок для малого бизнеса и среднего сегмента — это не enterprise-история на полгода. Целевая аудитория: услуги, онлайн-школы, клиники, B2B с регулярным потоком форм.</p>
<h3>Типовые сценарии по нишам</h3>
<p><strong>Услуги и B2B.</strong> Кейс Bquadro / НПК «Механобр-техника»: AI-ассистент в виджете онлайн-чата на сайте промышленной компании — первая линия по заявкам с форм. Бот отвечает на вопросы, разгружает менеджеров от низкокачественных обращений. Боль: регулярный поток заявок, на которые отдел продаж тратил время без гарантии покупки.</p>
<p><strong>Продажи недвижимости и сложные услуги.</strong> Кейс NaimiAI / строительная компания: ИИ-помощник с базой знаний по жилым комплексам, ипотеке и акциям; цель — назначить встречу. Обучение на PDF-презентациях, подключение раздела акций с сайта, интеграция с CRM, каналы WhatsApp и Telegram. Боль: медленные ответы, потеря обращений вне рабочего времени, устаревшая информация по акциям.</p>
<p><strong>Онлайн-школы.</strong> Кейс NextBot / ALIOT — образовательный центр (медицинские курсы): AI-консультант вместо формального онлайн-консультанта с ответом через 6–8 часов. По данным кейса: 289 диалогов, 19% оставили заявку на покупку курса, время ответа сократилось до ~15 секунд. Трафик ~241 000 посетителей в месяц при конверсии менее 0,1% из-за долгого ответа. Прямой аналог для AI-лидогенерации в EdTech: «заявка в диалоге, не в форме».</p>
<p><strong>Клиники.</strong> Кейс V-AI Labs / частная клиника: AI-ассистент для сайта и Telegram — запись на приём, ответы на частые вопросы, напоминания, внесение обращений в CRM. По заявлению интегратора: ответ ~3 секунды, 72% обращений без участия администраторов, снижение нагрузки на 50%, рост записей в 1,6 раза. <strong>Важно:</strong> цифры со страницы интегратора, не независимый аудит. Боль: очередь на операторов, потеря заявок, нежелание пациентов звонить, 80% типовых вопросов.</p>
</div></div></section>
<section class="nero-ai-section" id="keisy-primery"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Кейсы и примеры внедрения AI-агентов</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Публичные российские кейсы чаще описаны как «ИИ-чат на сайте» или «квалификация в мессенджерах», а не единой формулировкой «AI-агент первичной обработки заявок под ключ». Ниже — проверенные примеры с источниками.</p>
<div class="nero-ai-table-wrap nero-ai-reveal"><table class="nero-ai-table"><tr><th>Кейс</th><th>Ниша</th><th>Результат (из источника)</th></tr><tr><td>Bquadro / «Механобр-техника»</td><td>B2B, виджет на сайте</td><td>5% целевых заявок с сайта через ассистента за первый месяц (Workspace.ru)</td></tr><tr><td>NaimiAI / строительная компания</td><td>Недвижимость</td><td>CRM + мессенджеры, динамическая база знаний (naimiai.ru)</td></tr><tr><td>NextBot / онлайн-образование</td><td>EdTech</td><td>289 диалогов, 19% заявок, ответ ~15 сек (nextbot.ru)</td></tr><tr><td>V-AI Labs / клиника</td><td>Медицина</td><td>72% без администраторов, рост записей ×1,6 — данные интегратора</td></tr><tr><td>OpenAI Lead Outreach Agent</td><td>B2B, глобально</td><td>Квалификация, скоринг, обновление CRM (openai.com, 2026)</td></tr></table></div>
<p>Международные аналоги — Drift (Salesloft) для B2B-квалификации на сайте с интеграцией Salesforce/HubSpot; Intercom Fin для ответов по базе знаний и маршрутизации в sales. Их ценообразование ($1000+/мес по обзорам для Drift) — аргумент в пользу российского внедрения под ключ дешевле enterprise SaaS.</p>
<h3>Что измерять после запуска (без выдуманных цифр)</h3>
<p>Не обещайте ROI «+30%» без пилота на ваших данных. Измеряйте:</p>
<ul>
<li><strong>время первого ответа</strong> (до и после);</li>
<li><strong>долю заявок с полной квалификацией</strong> в CRM;</li>
<li><strong>долю эскалаций</strong> <code>human_review</code>;</li>
<li><strong>ночные и выходные обращения</strong> с ответом;</li>
<li><strong>долю целевых лидов</strong> vs спам и поддержка;</li>
<li><strong>нагрузку на менеджеров</strong> (время на первичку).</li>
</ul>
<p>Конкретный процент конверсии — только после пилота на данных клиента. Качественный эффект: меньше ручного переноса в CRM, прозрачная аналитика по каналу «AI-агент», подготовленные карточки вместо сырой формы.</p>
</div></div></section>
<section class="nero-ai-section nero-ai-section-alt" id="stoimost-vnedreniya"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Стоимость внедрения и что входит в пакет</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<h3>Ориентир чека 120–350 тыс. ₽ и поддержка</h3>
<p>По ТЗ проекта ориентир чека: <strong>120–350 тыс. ₽</strong> на старт + поддержка. На рынке SaaS-решения — от 15–30 тыс. ₽/мес; кастомные проекты — 150–500 тыс. ₽ (данные конкурентного обзора Артёма). Разработка AI-обработки заявок под ключ включает не лицензию, а работу: аудит, сценарии, RAG, интеграции, тестирование, запуск.</p>
<p><strong>Что входит в типовой пакет:</strong></p>
<ul>
<li>аудит потерь заявок;</li>
<li>виджет или интеграция с формой;</li>
<li>оркестратор и CRM-коннектор;</li>
<li>база знаний и RAG;</li>
<li>режим ассистента с переходом к автоответу;</li>
<li>журнал диалогов и эскалация;</li>
<li>согласие на обработку ПДн;</li>
<li>поддержка и доработка сценариев.</li>
</ul>
<p>Сравнение «дорого» vs «нанять менеджера 24/7» + потерянные заявки обычно смещает решение в пользу автоматизации первой линии, особенно при потоке от 20–50 заявок в месяц и выше.</p>
</div></div></section>
<section class="nero-ai-section" id="riski-kontrol-kachestva"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Риски: галлюцинации, ПДн и контроль качества</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Внедрение нейросетей в бизнес требует не только технической настройки, но и управления рисками. Нейросеть для обработки лидов без контроля может навредить репутации.</p>
<h3>Когда передавать диалог человеку</h3>
<p><strong>Галлюцинации.</strong> Агент не должен выдумывать цены и условия. RAG только по утверждённой базе знаний, запретные формулировки в промпте, статус <code>human_review</code> для спорных ответов. Режим ассистента на старте снижает страх «бот испортит продажи».</p>
<p><strong>Персональные данные (152-ФЗ).</strong> С 30.05.2025 ужесточены штрафы, запрещено хранение ПДн россиян за рубежом без правовой базы, ужесточены требования к согласиям. Для AI-агентов критичны: локализация на VPS в РФ, YandexGPT или GigaChat для данных с ПДн, явное согласие до сбора. Фразы «продолжая использование, вы соглашаетесь» — незаконны (LEGAS, 2026). OpenAI и Claude — только без ПДн или с обезличиванием.</p>
<p><strong>Контроль качества.</strong> Журнал диалогов, ежемесячный разбор ошибок, обновление FAQ. Эскалация на человека: коммерческие условия, медицинские и юридические рекомендации, жалобы, VIP-клиенты.</p>
<p><strong>Итог по рискам:</strong> честное внедрение AI в бизнес-процессы — это архитектура с tools, structured output и human-in-the-loop, а не «включили чат и забыли».</p>
</div></div></section>
<section class="nero-ai-section nero-ai-section-alt" id="faq-ai-obrabotka"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>FAQ по AI-обработке заявок</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<details class="nero-ai-faq-item"><summary>Сколько времени занимает внедрение?</summary><p>Зависит от сложности. Простой пилот на одном канале — от 2–4 недель (рыночный ориентир). Запуск виджета с CRM у интеграторов — 5–7 дней для типовых сценариев. Корпоративный проект с несколькими каналами — до 3–6 месяцев. Nero Network начинает с аудита и пилота на одном канале, чтобы сократить срок до первого измеримого результата.</p></details>
<details class="nero-ai-faq-item"><summary>Нужен ли отдельный разработчик?</summary><p>Для типового внедрения под ключ — нет. Нужны доступы к сайту, CRM и согласованные материалы (FAQ, регламент квалификации, примеры заявок). Техническую часть закрывает интегратор: webhook, оркестратор, RAG, API CRM.</p></details>
<aside class="nero-ai-secondary-cta nero-ai-card nero-ai-reveal nero-ai-delay-1" aria-label="Материалы по внедрению AI">
  <p class="nero-ai-eyebrow">Для команды до старта проекта</p>
  <p>Если вы хотите сначала разобраться в архитектуре агента, RAG и интеграциях с CRM — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>: практические материалы по внедрению AI-агентов и автоматизации без лишней теории.</p>
</aside>
<details class="nero-ai-faq-item"><summary>Можно ли подключить к существующей CRM?</summary><p>Да. Поддерживаются amoCRM, Битрикс24, RetailCRM, GetCourse. Если у вас уже есть встроенный AI-агент amoCRM — кастомное внедрение даёт кастомизацию сценария, RAG под нишу, мультиканал и аудит качества, которых не хватает «коробочному» решению.</p></details>
<details class="nero-ai-faq-item"><summary>Можно ли обойтись без передачи ПДн в зарубежное облако?</summary><p>Да. Российские LLM (YandexGPT, GigaChat), хранение эмбеддингов и логов на VPS в РФ, согласие в виджете до начала диалога. Автоматизация через AI-обработку заявок совместима с 152-ФЗ при правильной архитектуре.</p></details>
<details class="nero-ai-faq-item"><summary>Чем AI-консультант на сайт отличается от обычного онлайн-чата?</summary><p>Он не ждёт оператора: отвечает за 5–15 секунд, квалифицирует, пишет в CRM и передаёт менеджеру контекст. Обычный чат с живыми операторами в кейсе NextBot давал ответ 6–8 часов — и терял конверсию.</p></details>
</div></div></section>
<section class="nero-ai-section" id="audit-cta-section"><div class="nero-ai-container"><div class="nero-ai-section-head nero-ai-left nero-ai-reveal"><h2>Проверить, сколько заявок вы теряете</h2>
</div>
<div class="nero-ai-prose nero-ai-reveal nero-ai-delay-1">
<p>Если менеджеры отвечают часами, а ночные заявки остывают до утра — вы платите за трафик, но не забираете максимум из воронки. AI-обработка заявок под ключ начинается не с покупки бота, а с диагностики: <strong>аудит потерь заявок за 30 минут</strong>.</p>
<p>На аудите замеряем реальное время первого ответа, смотрим каналы (форма, чат, мессенджеры), оцениваем готовность CRM и 152-ФЗ. После — пилот: один канал, режим ассистента, затем автоответ за 5–15 секунд и передача горячего лида в воронку.</p>
</div></div></section>
<div class="nero-ai-final-cta nero-ai-card nero-ai-reveal" id="audit-cta">
  <h2>Проверить, сколько заявок вы теряете</h2>
  <p>AI-обработка заявок под ключ начинается с диагностики: аудит потерь за 30 минут, пилот на одном канале, режим ассистента и автоответ за 5–15 секунд с передачей горячего лида в CRM.</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
    <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>
  </div>
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
  "headline": "AI-обработка заявок с сайта: внедрение агента под ключ",
  "description": "Внедрим AI-агента для обработки заявок с сайта: ответ за 5–15 секунд, квалификация лида и передача в CRM.",
  "author": {"@type": "Organization", "name": "Nero Network"},
  "mainEntityOfPage": {"@type": "WebPage"},
  "about": {"@type": "Service", "name": "AI-обработка заявок с сайта под ключ"}
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type": "Question", "name": "Сколько времени занимает внедрение?", "acceptedAnswer": {"@type": "Answer", "text": "Простой пилот на одном канале — от 2–4 недель. Типовой запуск виджета с CRM — 5–7 дней."}},
    {"@type": "Question", "name": "Нужен ли отдельный разработчик?", "acceptedAnswer": {"@type": "Answer", "text": "Для типового внедрения под ключ — нет. Нужны доступы к сайту, CRM и согласованные материалы."}},
    {"@type": "Question", "name": "Можно ли подключить к существующей CRM?", "acceptedAnswer": {"@type": "Answer", "text": "Да. Поддерживаются amoCRM, Битрикс24, RetailCRM, GetCourse."}}
  ]
}
</script>

<?php get_footer(); ?>

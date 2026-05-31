<?php
/**
 * Template Name: AI-квалификация лидов
 * Description: AI-квалификация лидов — скоринг и статусы до передачи в CRM. Лонгрид Nero Network.
 */

$page_seo_title = 'AI-квалификация лидов: скоринг и статусы до передачи в CRM';
$page_seo_description = 'Внедрим AI-квалификацию лидов под ключ: скоринг, статусы «горячий / тёплый / холодный / нецелевой», интеграция с amoCRM и Bitrix24. Менеджеры получают только целевые заявки.';

$public_site = nero_env_or_default('PUBLIC_SITE_URL', nero_env_or_default('WP_SITE_URL', 'https://meta-journal.ru'));
$page_og_image = rtrim($public_site, '/') . '/wp-content/uploads/nero-ai-kvalifikaciya-lidov-og.jpg';
$primary_cta_label = nero_env_or_default('PRIMARY_CTA_LABEL', 'Получить карту квалификации');
$primary_cta_url = nero_env_or_default('PRIMARY_CTA_URL', 'https://t.me/neroteam');
$secondary_cta_label = nero_env_or_default('SECONDARY_CTA_LABEL', 'Блог Meta Journal');
$secondary_cta_url = nero_env_or_default('SECONDARY_CTA_URL', 'https://meta-journal.ru/');

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description, $page_og_image): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
    echo '<meta property="og:image" content="' . esc_url($page_og_image) . '" />' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($page_og_image) . '" />' . "\n";
}, 1);


function nero_env_or_default(string $key, string $default): string {
    $value = getenv($key);
    if ($value === false || $value === '' || $value === '[REDACTED]') {
        return $default;
    }
    return $value;
}


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
.ai-kvalifikaciya-intro-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.1fr) minmax(280px, 0.9fr);
  gap: clamp(20px, 4vw, 40px);
  align-items: start;
}
.ai-kvalifikaciya-intro-copy {
  text-align: left !important;
  border-left: 4px solid var(--nero-ai-primary);
  padding-left: clamp(16px, 2vw, 24px);
}
.ai-kvalifikaciya-intro-copy p { text-align: left !important; }
.ai-kvalifikaciya-intro-lead {
  font-size: clamp(17px, 1.8vw, 20px);
  line-height: 1.65;
  color: var(--nero-ai-soft) !important;
  margin: 0 0 12px;
}
.ai-kvalifikaciya-intro-sub {
  margin: 0;
  font-size: 15px;
  line-height: 1.6;
  color: var(--nero-ai-muted) !important;
}
.ai-kvalifikaciya-intro-terminal { padding: 18px; }
.ai-kvalifikaciya-terminal-top {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-bottom: 14px;
  font-size: 12px;
  font-weight: 700;
  color: var(--nero-ai-muted);
}
.ai-kvalifikaciya-terminal-top span {
  width: 8px; height: 8px; border-radius: 50%;
  background: rgba(121, 242, 255, 0.5);
}
.ai-kvalifikaciya-terminal-lines {
  list-style: none;
  margin: 0 0 14px;
  padding: 0;
  display: grid;
  gap: 8px;
  font-size: 13px;
  line-height: 1.45;
  color: var(--nero-ai-soft);
}
.ai-kvalifikaciya-terminal-lines code {
  color: var(--nero-ai-primary);
  font-weight: 700;
}
.ai-kvalifikaciya-intro-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.ai-kvalifikaciya-intro-chips span {
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
  .ai-kvalifikaciya-intro-grid { grid-template-columns: 1fr; }
  .ai-kvalifikaciya-intro-copy { border-left-width: 3px; }
}
#lead-qualify-hero.lq-hero.fullscreen-white-office {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}
.ai-kvalifikaciya-intro-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.1fr) minmax(280px, 0.9fr);
  gap: 28px;
  align-items: start;
}
.ai-kvalifikaciya-intro-copy {
  text-align: left !important;
  border-left: 4px solid var(--nero-ai-primary);
  padding-left: 20px;
}
.ai-kvalifikaciya-intro-copy p { text-align: left !important; }
.ai-kvalifikaciya-intro-lead { font-size: 18px; line-height: 1.65; margin: 0 0 14px; }
.ai-kvalifikaciya-intro-sub { margin: 0; color: var(--nero-ai-muted); line-height: 1.6; }
.ai-kvalifikaciya-intro-terminal { padding: 18px; }
.ai-kvalifikaciya-terminal-top {
  display: flex; gap: 6px; align-items: center; margin-bottom: 12px;
  font-size: 12px; color: var(--nero-ai-muted);
}
.ai-kvalifikaciya-terminal-top span {
  width: 8px; height: 8px; border-radius: 50%; background: var(--nero-ai-primary); opacity: .7;
}
.ai-kvalifikaciya-terminal-lines {
  list-style: none; margin: 0 0 14px; padding: 0; display: grid; gap: 8px; font-size: 14px;
}
.ai-kvalifikaciya-intro-chips { display: flex; flex-wrap: wrap; gap: 8px; }
.ai-kvalifikaciya-intro-chips span {
  padding: 6px 10px; border-radius: 999px; border: 1px solid var(--nero-ai-border);
  font-size: 12px; font-weight: 600;
}
@media (max-width: 900px) {
  .ai-kvalifikaciya-intro-grid { grid-template-columns: 1fr; }
}

</style>

<div id="primary" class="site-main nero-ai-home-page ai-kvalifikaciya-lidov-page" role="main" tabindex="-1"><span id="main" class="screen-reader-text" aria-hidden="true"></span>
<section id="lead-qualify-hero" class="lq-hero fullscreen-white-office" aria-label="AI-квалификация лидов">
<style>
.lq-hero.fullscreen-white-office {
  position: relative;
  overflow: hidden;
  min-height: 100vh;
  background: #f8fafc;
  background-image:
    linear-gradient(rgba(15, 23, 42, 0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(15, 23, 42, 0.04) 1px, transparent 1px);
  background-size: 48px 48px;
}
.lq-hero .lq-canvas-wrap {
  position: absolute;
  inset: 0;
  z-index: 1;
}
.lq-hero canvas#ai-kvalifikaciya-lidov-hero-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.lq-hero .lq-copy {
  position: absolute;
  left: clamp(16px, 4vw, 56px);
  top: 50%;
  transform: translateY(-52%);
  max-width: min(520px, 42vw);
  z-index: 4;
  pointer-events: none;
}
.lq-hero .lq-copy a.telegram-button { pointer-events: auto; margin-top: 28px; }
.lq-hero .giant-seo {
  font-size: clamp(32px, 4.2vw, 64px);
  font-weight: 900;
  line-height: 1.08;
  letter-spacing: -2px;
  color: #0f172a;
  margin: 0;
}
.lq-hero .giant-seo span {
  display: block;
  background: linear-gradient(90deg, #0ea5e9, #8b5cf6);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
}
.lq-hero .giant-seo-sub {
  font-size: clamp(15px, 1.8vw, 20px);
  line-height: 1.55;
  color: rgba(15, 23, 42, 0.72);
  margin-top: 18px;
  max-width: 480px;
}
.lq-hero .telegram-button {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 22px;
  background: #0f172a;
  color: #fff !important;
  border-radius: 999px;
  font-weight: 700;
  font-size: 14px;
  text-decoration: none;
  transition: transform 0.2s;
}
.lq-hero .telegram-button:hover { transform: translateY(-2px); }
.lq-hero .vl-ui-tasks {
  position: absolute;
  left: clamp(16px, 4vw, 56px);
  bottom: clamp(24px, 5vh, 56px);
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  max-width: min(640px, 90vw);
  z-index: 3;
}
.lq-hero .vl-ui-task {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  background: rgba(255,255,255,0.94);
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  font-size: 13px;
  font-weight: 600;
  color: #334155;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
}
.lq-hero .vl-ui-task span {
  width: 26px;
  height: 26px;
  background: linear-gradient(135deg, #0ea5e9, #6366f1);
  color: #fff;
  border-radius: 7px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 800;
  flex-shrink: 0;
}
.lq-hero .vl-ui-pill {
  position: absolute;
  right: clamp(16px, 4vw, 48px);
  top: clamp(20px, 4vh, 48px);
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-end;
  gap: 10px;
  z-index: 3;
}
.lq-hero .vl-ui-pill span {
  padding: 9px 16px;
  background: rgba(255,255,255,0.94);
  border: 1px solid #e2e8f0;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 700;
  color: #334155;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.lq-hero .vl-ui-pill span:nth-child(3) {
  border-color: #fecaca;
  color: #b91c1c;
  background: #fff5f5;
}
@media (max-width: 900px) {
  .lq-hero .lq-copy {
    top: auto;
    bottom: 42%;
    transform: none;
    max-width: 92vw;
  }
  .lq-hero .vl-ui-tasks { max-width: 96vw; }
}
</style>

  <div class="lq-canvas-wrap" aria-hidden="true">
    <canvas id="ai-kvalifikaciya-lidov-hero-canvas" role="img" aria-label="Анимация: лиды проходят скоринг и попадают в CRM"></canvas>
  </div>

  <div class="lq-copy">
    <h1 class="giant-seo">AI-квалификация лидов <span>без ручного разбора входящих</span></h1>
    <p class="giant-seo-sub">Нейросеть оценивает заявки по скорингу, тегам и воронке — в CRM уходит только то, что готово к звонку менеджеру.</p>
    <a class="telegram-button" href="<?php echo esc_url($primary_cta_url); ?>" target="_blank" rel="noopener noreferrer">Обсудить внедрение</a>
  </div>

  <div class="vl-ui-pill" aria-hidden="true">
    <span>MQL</span>
    <span>SQL</span>
    <span>HOT</span>
    <span>−40% шум</span>
  </div>

  <div class="vl-ui-tasks" aria-label="Этапы квалификации">
    <div class="vl-ui-task"><span>1</span> Сбор заявок</div>
    <div class="vl-ui-task"><span>2</span> Скоринг</div>
    <div class="vl-ui-task"><span>3</span> Теги</div>
    <div class="vl-ui-task"><span>4</span> Маршрут в CRM</div>
    <div class="vl-ui-task"><span>5</span> Задача менеджеру</div>
  </div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("ai-kvalifikaciya-lidov-hero-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");
  let cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    if (!canvas.parentElement) return;
    canvas.width = canvas.parentElement.clientWidth || window.innerWidth;
    canvas.height = canvas.parentElement.clientHeight || window.innerHeight;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw * 0.58;
    cy = ch * 0.52;
    scale = cw < 768 ? cw / 520 : Math.min(cw / 1100, ch / 820) * 1.35;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  const C = {
    outline: "#0f172a",
    cold: "#94a3b8",
    warm: "#fbbf24",
    hot: "#ef4444",
    hub: "#e0f2fe",
    hubStroke: "#0284c7",
    slot: "#ecfdf5",
    bubbleBg: "#ffffff",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  class LeadRiver {
    constructor() {
      this.paths = [
        { ox: 220, oy: -180, r: 140, start: Math.PI * 0.15, end: Math.PI * 0.95 },
        { ox: 40, oy: -120, r: 110, start: Math.PI * 0.05, end: Math.PI * 0.75 }
      ];
    }
    draw(ctx) {
      this.paths.forEach((p, idx) => {
        ctx.save();
        ctx.strokeStyle = "rgba(148, 163, 184, 0.35)";
        ctx.lineWidth = 3;
        ctx.setLineDash([8, 10]);
        ctx.beginPath();
        ctx.arc(p.ox, p.oy, p.r, p.start, p.end);
        ctx.stroke();
        ctx.setLineDash([]);
        const t = (frame * 0.022 + idx * 0.33) % 1;
        const ang = p.start + (p.end - p.start) * t;
        const lx = p.ox + Math.cos(ang) * p.r;
        const ly = p.oy + Math.sin(ang) * p.r;
        const col = idx === 0 ? C.cold : C.warm;
        drawRR(ctx, lx - 14, ly - 10, 28, 20, 4, col, C.outline);
        ctx.fillStyle = C.outline;
        ctx.font = "bold 7px Inter, sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(idx ? "FORM" : "CHAT", lx, ly + 2);
        ctx.restore();
      });
    }
  }

  class IntentRadar {
    draw(ctx) {
      const tags = ["бюджет", "срок", "ниша", "UTM"];
      tags.forEach((tag, i) => {
        const a = frame * 0.018 + (i / tags.length) * Math.PI * 2;
        const rx = 120 + Math.cos(a) * 55;
        const ry = -200 + Math.sin(a) * 28;
        drawRR(ctx, rx - 22, ry - 8, 44, 16, 8, "rgba(255,255,255,0.9)", "#cbd5e1");
        ctx.fillStyle = "#475569";
        ctx.font = "600 8px Inter, sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(tag, rx, ry + 3);
      });
    }
  }

  class CrmOutbox {
    constructor(x, y) {
      this.x = x;
      this.y = y;
      this.glow = 0;
    }
    draw(ctx) {
      this.glow = Math.max(0, this.glow - 0.02);
      if (this.glow > 0) {
        ctx.save();
        ctx.globalAlpha = this.glow * 0.35;
        drawRR(ctx, this.x - 8, this.y - 8, 96, 72, 12, C.hot, null);
        ctx.restore();
      }
      drawRR(ctx, this.x, this.y, 80, 56, 8, C.slot, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 9px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("CRM", this.x + 40, this.y + 22);
      ctx.fillStyle = "#059669";
      ctx.font = "bold 8px Inter, sans-serif";
      ctx.fillText("HOT →", this.x + 40, this.y + 38);
    }
    pulse() {
      this.glow = 1;
    }
  }

  class LeadScoringHub {
    constructor(x, y) {
      this.x = x;
      this.y = y;
      this.hotY = 0;
      this.hotVX = 0;
      this.hotActive = false;
    }
    draw(ctx) {
      const cycle = 240;
      const prg = (frame * 0.042) % cycle;

      ctx.lineJoin = "round";
      drawRR(ctx, this.x - 70, this.y - 30, 140, 200, 10, "#f1f5f9", C.outline);

      const stages = [
        { y: 0, h: 50, label: "IN", col: "#e2e8f0" },
        { y: 52, h: 45, label: "MQL", col: "#bae6fd" },
        { y: 100, h: 45, label: "SQL", col: "#a7f3d0" },
        { y: 148, h: 42, label: "HOT", col: "#fecaca" }
      ];
      stages.forEach((s, i) => {
        const fillH = prg > 30 + i * 45 ? s.h : Math.max(0, (prg - 20 - i * 40) * 0.8);
        drawRR(ctx, this.x - 50, this.y + s.y, 100, s.h, 6, "#fff", C.outline);
        if (fillH > 4) {
          drawRR(ctx, this.x - 46, this.y + s.y + s.h - fillH, 92, fillH, 4, s.col, null);
        }
        ctx.fillStyle = C.outline;
        ctx.font = "bold 9px Inter, sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(s.label, this.x, this.y + s.y + s.h / 2 + 3);
      });

      const score = Math.min(99, Math.floor((prg / cycle) * 99));
      drawRR(ctx, this.x + 58, this.y + 20, 36, 120, 6, "#fff", C.outline);
      const barH = (score / 99) * 100;
      drawRR(ctx, this.x + 62, this.y + 120 - barH, 28, barH, 4, score > 72 ? C.hot : score > 40 ? C.warm : C.cold, null);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 10px Inter, sans-serif";
      ctx.fillText(score + "", this.x + 76, this.y + 8);

      if (prg > 185 && prg < 220) {
        if (!this.hotActive) {
          this.hotActive = true;
          this.hotY = this.y + 170;
          this.hotVX = 0;
        }
        this.hotVX += 0.35;
        this.hotY -= this.hotVX * 0.4;
        const hx = this.x - 120 + (220 - prg) * 2.2;
        drawRR(ctx, hx - 18, this.hotY - 12, 36, 24, 6, C.hot, C.outline);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 9px Inter, sans-serif";
        ctx.fillText("HOT", hx, this.hotY + 2);
      } else if (prg >= 220) {
        this.hotActive = false;
        this.hotY = 0;
        if (prg < 221) crm.pulse();
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
      const cycle = 240;
      const prg = (frame * 0.042) % cycle;
      let isMoving = false;
      let carryType = null;
      let faceDir = 1;
      const targetX = 20;
      const targetY = 60 + this.stepTrig * 0.15;

      if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
        const local = prg - this.stepTrig;
        if (local < 11) {
          isMoving = true;
          faceDir = 1;
          carryType = this.color;
          this.x = this.baseX + (targetX - this.baseX) * (local / 11);
          this.y = this.baseY + (targetY - this.baseY) * (local / 11);
        } else if (local < 14) {
          this.x = targetX;
          this.y = targetY;
        } else {
          isMoving = true;
          faceDir = -1;
          const back = (local - 14) / 8;
          this.x = targetX - (targetX - this.baseX) * back;
          this.y = targetY - (targetY - this.baseY) * back;
        }
      } else {
        this.x = this.baseX;
        this.y = this.baseY;
        const chips = [-180, -60, 60];
        chips.forEach((cxo) => {
          const drift = ((frame * 0.025 + cxo) % 180) - 90;
          if (Math.abs(drift - (this.x - cxo)) < 18) this.hitAnimation = Math.sin(frame * 0.25) * 6;
        });
        if (frame % 220 === 0 && Math.random() < 0.12) {
          createBubble(this.x, this.y - 24, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 260);
        }
      }

      const bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.4);
      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.lineJoin = "round";
      let legL = 0, legR = 0;
      if (isMoving) {
        const w = this.timer * 6;
        legL = Math.sin(w) * 5;
        legR = Math.sin(w + Math.PI) * 5;
      }
      drawRR(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
      drawRR(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
      drawRR(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
      drawRR(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);
      drawRR(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);
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
        ctx.strokeRect(hx + 1, hy - 5, 6, 6);
        ctx.strokeRect(hx - 7, hy - 5, 6, 6);
      } else if (this.role === "2_seo") {
        drawRR(ctx, hx - 12, hy - 14, 24, 8, [6, 6, 0, 0], C.outline, null);
      } else if (this.role === "3_coder") {
        ctx.fillStyle = C.outline;
        ctx.fillRect(hx - 8, hy - 10, 16, 3);
        ctx.fillRect(hx - 6, hy - 6, 12, 3);
      } else if (this.role === "4_designer") {
        drawRR(ctx, hx - 14, hy - 12, 28, 6, 3, "#f43f5e", C.outline);
      } else if (this.role === "5_deployer") {
        ctx.strokeStyle = C.outline;
        ctx.beginPath();
        ctx.arc(hx, hy, 14, Math.PI, Math.PI * 2);
        ctx.stroke();
      }
      ctx.restore();
      if (carryType) drawRR(ctx, -18 * faceDir, -18 - bob, 16, 16, 2, carryType, C.outline);
      ctx.restore();
      if (!isMoving) this.hitAnimation *= 0.85;
    }
  }

  const entities = [];
  const bubbles = [];
  const river = new LeadRiver();
  const radar = new IntentRadar();
  const hub = new LeadScoringHub(40, -80);
  const crm = new CrmOutbox(-200, 40);

  entities.push(river);
  entities.push(radar);
  entities.push(crm);
  entities.push(hub);
  entities.push(new Agent(-280, 100, C.agentYellow, "1_architect", 18, ["Порог MQL: 62", "Правила скоринга", "Сегмент B2B"]));
  entities.push(new Agent(-160, 20, C.agentGreen, "2_seo", 58, ["UTM из рекламы", "Источник: Telegram", "Тег «срочно»"]));
  entities.push(new Agent(-40, 110, C.agentBlue, "3_coder", 98, ["Webhook в CRM", "Поле score OK", "Дубль отсечён"]));
  entities.push(new Agent(100, 30, C.agentPink, "4_designer", 138, ["HOT — красный", "Холодный — серый", "Карточка читаема"]));
  entities.push(new Agent(180, 100, C.agentPurple, "5_deployer", 178, ["Задача менеджеру", "Слот CRM занят", "Шум отфильтрован"]));

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

    const prg = (frame * 0.042) % 240;
    if (prg >= 16 && prg < 16.08) createBubble(-280, 60, "1. Правила скоринга");
    if (prg >= 56 && prg < 56.08) createBubble(-160, -10, "2. Источник и UTM");
    if (prg >= 96 && prg < 96.08) createBubble(-40, 70, "3. Интеграция CRM");
    if (prg >= 136 && prg < 136.08) createBubble(100, 0, "4. Приоритет в UI");
    if (prg >= 176 && prg < 176.08) createBubble(180, 70, "5. HOT в работу");
    if (prg >= 200 && prg < 200.08) createBubble(40, 120, "Score 87 → менеджеру");

    ctx.font = "bold 11px Inter, sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
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
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 6, C.bubbleBg, C.outline);
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

<section class="nero-ai-section nero-ai-section-tight ai-kvalifikaciya-intro" aria-label="Введение">
  <div class="nero-ai-container">
    <div class="ai-kvalifikaciya-intro-grid nero-ai-reveal">
      <div class="ai-kvalifikaciya-intro-copy">
        <p class="nero-ai-eyebrow">Лонгрид · квалификация лидов</p>
        <p class="ai-kvalifikaciya-intro-lead"><strong>Коротко:</strong> AI-квалификация лидов — автоматизированный слой между заявкой и менеджером: диалог, скоринг, статусы «горячий / тёплый / холодный / нецелевой» и передача в CRM только подготовленного контакта с контекстом.</p>
        <p class="ai-kvalifikaciya-intro-sub">Ниже — матрицы BANT/MEDDIC, интеграция amoCRM и Битрикс24, кейсы B2B и чеклист внедрения без «замены отдела продаж».</p>
      </div>
      <aside class="ai-kvalifikaciya-intro-terminal nero-ai-card" aria-label="Схема квалификации лида">
        <div class="ai-kvalifikaciya-terminal-top"><span></span><span></span><span></span> qualify@nero</div>
        <ul class="ai-kvalifikaciya-terminal-lines">
          <li><code>IN</code> заявка → <strong>сигналы</strong></li>
          <li><code>SCORE</code> веса → <strong>72+ HOT</strong></li>
          <li><code>TAG</code> hot/warm/cold → <strong>CRM</strong></li>
          <li><code>HANDOFF</code> summary + цитаты → <strong>ОП</strong></li>
        </ul>
        <div class="ai-kvalifikaciya-intro-chips">
          <span>MQL</span><span>SQL</span><span>HOT</span><span>−40% шум</span>
        </div>
      </aside>
    </div>
    <nav class="nero-ai-toc-wrap nero-ai-reveal" aria-label="Оглавление">
      <div class="nero-ai-toc">
        <a href="#akl-chto-takoe">Что такое AI-квалификация лидов и чем она отличается от ручной обработки заявок</a><a href="#akl-pochemu-netselevye">Почему менеджеры тратят время на нецелевых клиентов: типичные ошибки без скоринга</a><a href="#akl-statusy-lida">Статусы лида: горячий, тёплый, холодный и нецелевой — единые правила для CRM</a><a href="#akl-ai-lid-skoring">AI-скоринг лидов: как работает модель, правила и пороги передачи</a><a href="#akl-matrica-kvalifikacii">Матрица квалификации лидов: BANT, CHAMP, MEDDIC в правилах AI-агента</a><a href="#akl-ai-voronka">AI-воронка продаж: этапы от заявки до передачи менеджеру</a><a href="#akl-integraciya-crm">Интеграция AI-квалификации лидов с CRM: amoCRM, Bitrix24 и поля статуса</a><a href="#akl-vnedrenie-pod-klyuch">Внедрение AI-квалификации лидов под ключ: этапы, сроки и роли команды</a><a href="#akl-stoimost">Стоимость, срок окупаемости и чек 150–450 тыс. ₽: когда внедрение оправдано</a><a href="#akl-kejsy">Кейсы: B2B-услуги, агентства, девелоперы — примеры внедрения</a><a href="#akl-faq">FAQ по AI-квалификации лидов</a>
      </div>
    </nav>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-chto-takoe" aria-labelledby="akl-chto-takoe-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-chto-takoe-title">Что такое AI-квалификация лидов и чем она отличается от ручной обработки заявок</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Определение.</strong> AI-квалификация лидов — автоматизированная проверка входящего обращения (сайт, мессенджеры, реклама, формы) до передачи в отдел продаж: conversational AI или LLM-агент ведёт диалог, собирает поля по матрице (BANT, CHAMP, MEDDIC), отвечает на FAQ из базы знаний, присваивает приоритет и формирует <strong>пакет handoff</strong> — карточку CRM, транскрипт, цитаты клиента, рекомендуемый первый вопрос менеджеру.</p>
<p>В 2026 году индустрия смещается от MQL «по форме» к <strong>Conversationally Qualified Lead (CQL)</strong> — квалификации по транскрипту диалога, а не по чекбоксам (<a href="https://getperspective.ai/blog/mqls-are-dead-conversational-qualified-leads-2026" target="_blank" rel="noopener noreferrer">>Perspective AI, 2026</a>). По аудиту <strong>412</strong> B2B SaaS-воронок (Q4 2025 – Q1 2026) у <strong>78%</strong> уже есть conversational qualification layer (было <strong>22%</strong> в 2024); при том же трафике qualified pipeline растёт в <strong>3,4×</strong>, visitor→opportunity — <strong>+241%</strong>, show rate — <strong>+41%</strong> (<a href="https://getperspective.ai/blog/ai-sales-discovery-2026-pipeline-report-conversational-qualification" target="_blank" rel="noopener noreferrer">>Perspective AI Pipeline Report 2026</a>).</p>
<h3>Зачем бизнесу квалификация лидов до отдела продаж</h3>
<p>Квалификация лидов в продажах — это ответ на вопрос: <strong>стоит ли тратить время живого менеджера на этот контакт сейчас</strong>. Без формализованных критериев «квалификация» превращается в субъективное «похоже на клиента». AI фиксирует правила: бюджет, срок, полномочия, соответствие ICP — и не пропускает в воронку то, что вы заранее назвали нецелевым.</p>
<p>Для B2B-услуг, агентств и девелоперов типичная боль из практики: <strong>не нехватка лидов, а перегруз нецелевым потоком</strong>. В одном публичном кейсе агентства недвижимости в Москве (~400 заявок/мес, 3 менеджера) около <strong>55%</strong> трафика изначально нецелевой; после ИИ-фильтрации по четырём критериям нагрузка на менеджеров снизилась на <strong>40%</strong>, а сделки выросли за счёт фокуса на горячих (<a href="https://www.sostav.ru/blogs/281569/87715" target="_blank" rel="noopener noreferrer">>Sostav.ru / SaleAgent, 23.05.2026</a>).</p>
<h3>AI-бот vs менеджер на первом касании (квалификация лидов ai ботом)</h3>
<div class="nero-ai-table-wrap"><table class="nero-ai-table">
<thead>
<tr>
<th>Роль</th>
<th>Менеджер на первом касании</th>
<th>AI-квалификация</th>
</tr>
</thead>
<tbody>
<tr>
<td>Скорость ответа</td>
<td>Зависит от смены, очереди</td>
<td>24/7, цель — ответ <strong>&lt; 1 мин</strong></td>
</tr>
<tr>
<td>Одинаковость вопросов</td>
<td>Разный опыт, усталость</td>
<td>Один скрипт + RAG по FAQ</td>
</tr>
<tr>
<td>Стоимость контакта</td>
<td>Высокая ставка ОП</td>
<td>Масштабируется на сотни диалогов</td>
</tr>
<tr>
<td>Эмпатия, цена, исключения</td>
<td>Сильная сторона</td>
<td>Эскалация на человека</td>
</tr>
</tbody>
</table></div>
<p><strong>Квалификация лидов ai ботом</strong> — не синоним «замены продаж». По формулировке экспертов гибридной воронки: ИИ убирает рутину первых касаний, человек подключается, когда клиент «дозрел» или ситуация требует эмпатии (<a href="https://companies.rbc.ru/news/vb6i8T44zD/avtomatizatsiya-prodazh-voronki-ne-rabotayut-bez-cheloveka/" target="_blank" rel="noopener noreferrer">>РБК Компании / INFULL, 26.05.2026</a>). Perspective AI в 2026 резюмирует тренд иначе: <em>«Humans still close — but they no longer qualify in the first five touches»</em> (<a href="https://getperspective.ai/blog/ai-sales-discovery-2026-pipeline-report-conversational-qualification" target="_blank" rel="noopener noreferrer">>отчёт 2026</a>).</p>
<p><strong>Итог:</strong> AI-квалификация лидов — это не «ещё один чат на сайте», а <strong>слой скоринга и статусов до CRM</strong>, с измеримым handoff.</p>
<hr>

    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-pochemu-netselevye" aria-labelledby="akl-pochemu-netselevye-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-pochemu-netselevye-title">Почему менеджеры тратят время на нецелевых клиентов: типичные ошибки без скоринга</h2>
    </header>
    <div class="nero-ai-prose">
<p>Без <strong>ai лид скоринга</strong> и единых статусов отдел продаж становится дорогим фильтром: каждый менеджер вручную отсекает спам, студентов, «просто спросить цену» и конкурентов.</p>
<h3>Симптомы «грязной» воронки в CRM</h3>
<ul class="nero-ai-prose-list">
<li>Все новые заявки падают на одну стадию «Новый лид» без приоритета.</li>
<li>В карточке пусто: нет бюджета, срока, ЛПР — менеджер выясняет с нуля.</li>
<li><strong>Speed-to-lead</strong> плавает: в кейсе Екатеринбурга (Salesbot amoCRM + VK) время первого контакта менеджера было <strong>22 минуты</strong>; после квалификации в диалоге — <strong>4 минуты</strong> (<a href="https://biznesenok.ru/nastrojka-salesbot-v-amocrm-kak-sozdat-chat-bota-dlja-avtomaticheskih-otvetov-i-kvalifikacii-lidov/" target="_blank" rel="noopener noreferrer">>Бизнесёнок</a>).</li>
<li>Горячие лиды остывают в общей очереди. В материалах 2026 часто цитируют классический бенчмарк HBR: ответ <strong>≤5 мин</strong> vs <strong>30 мин</strong> — квалификация <strong>в ~100×</strong> вероятнее (повторяется в RU-обзорах; помечайте как широко цитируемый бенчмарк, не как свежий отчёт 2026) — <a href="https://www.sostav.ru/blogs/281569/87715" target="_blank" rel="noopener noreferrer">>Sostav.ru</a>. INFULL на РБК даёт связанную оценку: <strong>5-минутная</strong> задержка снижает вероятность квалификации <strong>в 4 раза</strong> (<a href="https://companies.rbc.ru/news/vb6i8T44zD/avtomatizatsiya-prodazh-voronki-ne-rabotayut-bez-cheloveka/" target="_blank" rel="noopener noreferrer">>РБК Компании</a>).</li>
</ul>
<h3>Скрытая стоимость нецелевых лидов для B2B</h3>
<p>Российские обзоры 2026 ссылаются на HubSpot Sales Trends: ИИ-скоринг отсекает <strong>40–60%</strong> нецелевых заявок; у команд с AI-скорингом конверсия выше на <strong>~27%</strong> (<a href="https://www.sostav.ru/blogs/281569/87715" target="_blank" rel="noopener noreferrer">>Sostav.ru</a>). Даже без точного ROI на старте понятна логика: менеджер × N часов на «мусор» = прямые затраты + упущенные горячие.</p>
<p><strong>AI для отдела продаж</strong> на этапе квалификации — это перераспределение: <strong>до 80%</strong> рутины первого касания на автоматизацию, не увольнение команды (<a href="https://metasapiens.ru/blog/ai-agenty-v-crm-kak-cifrovoj-sotrudnik-zakryvaet-sdelki" target="_blank" rel="noopener noreferrer">>позиционирование интеграторов 2026</a>).</p>
<hr>

    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-statusy-lida" aria-labelledby="akl-statusy-lida-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-statusy-lida-title">Статусы лида: горячий, тёплый, холодный и нецелевой — единые правила для CRM</h2>
    </header>
    <div class="nero-ai-prose">
<p>Коммерческий оффер AI-квалификации — <strong>присвоить лиду понятный статус до handoff</strong>:</p>
<div class="nero-ai-table-wrap"><table class="nero-ai-table">
<thead>
<tr>
<th>Статус</th>
<th>Смысл</th>
<th>Типичное действие</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Горячий</strong></td>
<td>ICP совпал, бюджет/срок подтверждены, готов к встрече</td>
<td>Задача менеджеру + слот в календаре, SLA минуты</td>
</tr>
<tr>
<td><strong>Тёплый</strong></td>
<td>Интерес есть, не все поля закрыты</td>
<td>Nurture, повторный контакт, дозревание</td>
</tr>
<tr>
<td><strong>Холодный</strong></td>
<td>Долгий горизонт, низкий приоритет</td>
<td>Цепочка писем/контента, не занимать старшего ОП</td>
</tr>
<tr>
<td><strong>Нецелевой</strong></td>
<td>Вне ICP, спам, не тот продукт</td>
<td>Вежливый отказ, тег, без передачи в активную воронку</td>
</tr>
</tbody>
</table></div>
<h3>Критерии присвоения статуса AI-агентом</h3>
<p>Критерии должны быть <strong>описаны математически</strong> — иначе автоматизация «плывёт». На практике: веса по полям матрицы (см. раздел BANT/MEDDIC), пороги score, жёсткие disqualified-правила («бюджет &lt; X», «регион не обслуживаем»). LLM дополняет правила: тон, возражения, нестандартные формулировки — но <strong>финальный маршрут</strong> задаётся вашей политикой, не «настроением модели».</p>
<p>Шаблон n8n (<a href="https://n8n.io/workflows/9310-automate-lead-qualification-and-routing-with-gpt-4o-mini-google-sheets-and-highlevel-crm/" target="_blank" rel="noopener noreferrer">>workflow 9310</a>): форма → AI scoring → Hot/Warm/Cold → CRM + уведомление — тот же паттерн переносится на amoCRM/Битрикс24 + YandexGPT/OpenRouter.</p>
<h3>Что передаётся менеджеру в карточке лида</h3>
<p>Уникальный угол Nero Network — <strong>handoff как продукт</strong>, не «бот ответил»:</p>
<ol class="nero-ai-prose-list">
<li>Статус hot/warm/cold/disqualified + числовой score  </li>
<li>Заполненные поля CRM (бюджет, срок, тип запроса)  </li>
<li><strong>Summary</strong> диалога (3–5 предложений)  </li>
<li><strong>2–3 прямые цитаты</strong> клиента  </li>
<li>Рекомендуемый <strong>первый вопрос</strong> менеджеру  </li>
<li>Теги возражений («дорого», «сравниваю с …») для подготовки</li>
</ol>
<p>Менеджер не начинает с «чем могу помочь?», а с «вижу, вам нужен объект в районе X к сроку Y — верно?».</p>
<hr>

    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-ai-lid-skoring" aria-labelledby="akl-ai-lid-skoring-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-ai-lid-skoring-title">AI-скоринг лидов: как работает модель, правила и пороги передачи</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Скоринг лидов</strong> — присвоение числового или категориального приоритета на основе сигналов. <strong>AI лид скоринг</strong> добавляет NLP: смысл ответов в чате, а не только «галочка в форме».</p>
<h3>Сигналы скоринга (форма, чат, звонок, поведение на сайте)</h3>
<ul class="nero-ai-prose-list">
<li><strong>Явные:</strong> бюджет, срок, роль (ЛПР / не ЛПР), тип услуги, гео.  </li>
<li><strong>Поведенческие:</strong> страницы прайса, повторные визиты, UTM high-intent.  </li>
<li><strong>Диалоговые:</strong> длина ответов, вопросы про внедрение vs «сколько стоит сайт».  </li>
<li><strong>Телефония:</strong> расшифровка → поля сделки (тренд BitrixGPT / обзоры <a href="https://metasapiens.ru/blog/ai-agenty-v-crm-kak-cifrovoj-sotrudnik-zakryvaet-sdelki" target="_blank" rel="noopener noreferrer">>METASAPIENS</a>).</li>
</ul>
<h3>Скоринг лидов ai vs классические балльные системы</h3>
<div class="nero-ai-table-wrap"><table class="nero-ai-table">
<thead>
<tr>
<th>Подход</th>
<th>Плюсы</th>
<th>Минусы</th>
</tr>
</thead>
<tbody>
<tr>
<td>Rule-based (баллы за поля)</td>
<td>Прозрачность, предсказуемость</td>
<td>Ломается на свободном тексте</td>
</tr>
<tr>
<td><strong>Скоринг лидов ai</strong> (LLM + правила)</td>
<td>Понимает формулировки, FAQ, отток</td>
<td>Нужны guardrails и shadow mode</td>
</tr>
<tr>
<td>Чистый ML на истории CRM</td>
<td>Точность при больших данных</td>
<td>Долгий старт, «чёрный ящик»</td>
</tr>
</tbody>
</table></div>
<p>Агрегаторы 2026 указывают: AI lead scoring даёт <strong>+40%</strong> точности vs rule-based в сравнениях вендоров; <strong>67%</strong> B2B-маркетологов уже используют AI в lead gen (<a href="https://adai.news/resources/statistics/ai-lead-generation-statistics-2026/" target="_blank" rel="noopener noreferrer">>AdAI statistics 2026</a>). CQL по диалогу конвертируется в SQL <strong>в 2–4×</strong> чаще, чем MQL по форме на ранних внедрениях (<a href="https://getperspective.ai/blog/mqls-are-dead-conversational-qualified-leads-2026" target="_blank" rel="noopener noreferrer">>Perspective AI, CQL</a>).</p>
<p><strong>Что такое скоринг лидов</strong> в одном предложении: ранжирование контактов по вероятности сделки и срочности. <strong>Чем отличается от квалификации:</strong> скоринг — приоритет; квалификация — бинарное/многоуровневое «пускаем в активную работу ОП или нет».</p>
<hr>

    </div>
  </div>
</section>

<section id="ai-kvalifikaciya-lidov-boris-block" class="boris-article-viz" aria-labelledby="boris-scoring-kicker">
<style>
  #ai-kvalifikaciya-lidov-boris-block {
    margin: 48px 0;
    padding: 0;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-scoring-wrap {
    max-width: 1120px;
    margin: 0 auto;
    padding: 0 20px;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-scoring-card {
    background: #ffffff;
    border: 1px solid rgba(15, 23, 42, 0.08);
    border-radius: 22px;
    box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
    padding: clamp(24px, 4vw, 40px);
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-scoring-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 28px;
    align-items: center;
  }
  @media (min-width: 1024px) {
    #ai-kvalifikaciya-lidov-boris-block .boris-scoring-grid {
      grid-template-columns: minmax(0, 0.58fr) minmax(0, 0.42fr);
      gap: 32px;
    }
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-eyebrow {
    margin: 0 0 10px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #2563eb;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-kicker {
    margin: 0 0 12px;
    font-size: clamp(20px, 2.4vw, 26px);
    line-height: 1.2;
    letter-spacing: -0.03em;
    color: #0f172a;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-lead {
    margin: 0 0 18px;
    color: #475569;
    font-size: 15px;
    line-height: 1.55;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-bridge {
    margin: 0 0 16px;
    font-size: 14px;
    color: #64748b;
    font-style: italic;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-points {
    margin: 0 0 18px;
    padding: 0;
    list-style: none;
    display: grid;
    gap: 10px;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-points li {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    font-size: 14px;
    line-height: 1.45;
    color: #334155;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-points li::before {
    content: "";
    flex: 0 0 8px;
    height: 8px;
    margin-top: 6px;
    border-radius: 50%;
    background: #3b82f6;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid rgba(15, 23, 42, 0.1);
    background: #f8fafc;
    color: #0f172a;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-pill-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
  }
  #ai-kvalifikaciya-lidov-boris-block .boris-pill--hot .boris-pill-dot { background: #ef4444; }
  #ai-kvalifikaciya-lidov-boris-block .boris-pill--warm .boris-pill-dot { background: #f59e0b; }
  #ai-kvalifikaciya-lidov-boris-block .boris-pill--cool .boris-pill-dot { background: #3b82f6; }
  #ai-kvalifikaciya-lidov-boris-block .boris-pill--junk .boris-pill-dot { background: #94a3b8; }
  #ai-kvalifikaciya-lidov-boris-block .boris-canvas-shell {
    position: relative;
    min-height: 420px;
    max-height: 70vh;
    border-radius: 18px;
    background: linear-gradient(145deg, #f8fafc 0%, #eef2ff 55%, #f1f5f9 100%);
    border: 1px solid rgba(15, 23, 42, 0.06);
    overflow: hidden;
  }
  #ai-kvalifikaciya-lidov-boris-block canvas {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 420px;
  }
  @media (max-width: 767px) {
    #ai-kvalifikaciya-lidov-boris-block .boris-canvas-shell {
      min-height: 360px;
    }
    #ai-kvalifikaciya-lidov-boris-block canvas {
      min-height: 360px;
    }
  }
</style>
<div class="boris-scoring-wrap ym-container">
  <div class="boris-scoring-card">
    <div class="boris-scoring-grid">
      <div class="boris-scoring-copy">
        <p class="boris-eyebrow">Схема скоринга</p>
        <h3 id="boris-scoring-kicker" class="boris-kicker">Как заявка получает балл и статус до CRM</h3>
        <p class="boris-lead">Сигналы с формы, чата и поведения на сайте проходят через веса правил — на выходе один из четырёх статусов и порог передачи менеджеру.</p>
        <ul class="boris-points">
          <li><strong>Слой 1 — сигналы:</strong> бюджет, срок, роль, источник, повторные касания.</li>
          <li><strong>Слой 2 — скоринг:</strong> сумма весов и пороги «горячий / тёплый / холодный».</li>
          <li><strong>Слой 3 — маршрут:</strong> задача в CRM, эскалация или отсев нецелевого.</li>
        </ul>
        <div class="boris-pills" aria-hidden="true">
          <span class="boris-pill boris-pill--hot"><span class="boris-pill-dot"></span>Горячий ≥ 72</span>
          <span class="boris-pill boris-pill--warm"><span class="boris-pill-dot"></span>Тёплый 48–71</span>
          <span class="boris-pill boris-pill--cool"><span class="boris-pill-dot"></span>Холодный 25–47</span>
          <span class="boris-pill boris-pill--junk"><span class="boris-pill-dot"></span>Нецелевой &lt; 25</span>
        </div>
        <p class="boris-bridge">Дальше разберём, как задать пороги под вашу матрицу BANT / MEDDIC.</p>
      </div>
      <div class="boris-canvas-shell" role="img" aria-label="Анимированная схема: сигналы лида проходят скоринг и распределяются по статусам">
        <canvas id="lead-scoring-matrix-canvas" width="640" height="480"></canvas>
      </div>
    </div>
  </div>
</div>
<script>
(function () {
  var canvas = document.getElementById("lead-scoring-matrix-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, frame = 0, scale = 1;

  var PAL = {
    ink: "#0f172a",
    muted: "#64748b",
    line: "#cbd5e1",
    panel: "#ffffff",
    hot: "#ef4444",
    warm: "#f59e0b",
    cool: "#3b82f6",
    junk: "#94a3b8",
    accent: "#2563eb",
    glow: "rgba(37, 99, 235, 0.12)"
  };

  var LANES = [
    { key: "hot", label: "Горячий", color: PAL.hot, y: 0 },
    { key: "warm", label: "Тёплый", color: PAL.warm, y: 0 },
    { key: "cool", label: "Холодный", color: PAL.cool, y: 0 },
    { key: "junk", label: "Нецелевой", color: PAL.junk, y: 0 }
  ];

  var packets = [];
  var gates = [{ label: "Сигналы", x: 0 }, { label: "Скоринг", x: 0 }, { label: "Статус", x: 0 }];

  function resize() {
    var shell = canvas.parentElement;
    if (!shell) return;
    var w = shell.clientWidth || 640;
    var h = Math.min(Math.max(shell.clientHeight || 420, 360), window.innerHeight * 0.7);
    canvas.width = w;
    canvas.height = h;
    cw = w;
    ch = h;
    scale = cw < 520 ? cw / 520 : 1;
    var laneTop = ch * 0.72;
    var laneH = (ch - laneTop - 24) / 4;
    LANES.forEach(function (lane, i) {
      lane.y = laneTop + i * laneH + laneH * 0.5;
      lane.h = laneH * 0.55;
    });
    gates[0].x = cw * 0.22;
    gates[1].x = cw * 0.5;
    gates[2].x = cw * 0.78;
    gates.forEach(function (g) { g.y = ch * 0.38; });
  }

  function roundRect(x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else { ctx.moveTo(x + r, y); ctx.arcTo(x + w, y, x + w, y + h, r); ctx.arcTo(x + w, y + h, x, y + h, r); ctx.arcTo(x, y + h, x, y, r); ctx.arcTo(x, y, x + w, y, r); }
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 2; ctx.stroke(); }
  }

  function spawnPacket() {
    var laneIdx = Math.floor(Math.random() * 4);
    var score = laneIdx === 0 ? 72 + Math.random() * 28 : laneIdx === 1 ? 48 + Math.random() * 23 : laneIdx === 2 ? 25 + Math.random() * 22 : Math.random() * 24;
    packets.push({
      x: -40 * scale,
      y: ch * 0.14 + Math.random() * 40 * scale,
      t: 0,
      score: Math.round(score),
      lane: laneIdx,
      label: ["Форма", "Чат", "Сайт", "Звонок"][Math.floor(Math.random() * 4)]
    });
  }

  function drawGate(g, active) {
    var r = 34 * scale;
    ctx.save();
    if (active) {
      ctx.shadowColor = PAL.accent;
      ctx.shadowBlur = 18;
    }
    roundRect(g.x - r, g.y - r * 0.65, r * 2, r * 1.3, 12, PAL.panel, PAL.ink);
    ctx.shadowBlur = 0;
    ctx.fillStyle = active ? PAL.accent : PAL.muted;
    ctx.font = (11 * scale) + "px Inter, system-ui, sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(g.label, g.x, g.y + 4 * scale);
    ctx.restore();
  }

  function drawLanes() {
    var left = 16 * scale;
    var w = cw - left * 2;
    LANES.forEach(function (lane) {
      roundRect(left, lane.y - lane.h * 0.5, w, lane.h, 10, "rgba(255,255,255,0.85)", lane.color);
      ctx.fillStyle = lane.color;
      ctx.font = "bold " + (11 * scale) + "px Inter, system-ui, sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(lane.label, left + 12 * scale, lane.y + 4 * scale);
    });
  }

  function drawFlowLines() {
    ctx.strokeStyle = PAL.line;
    ctx.lineWidth = 2;
    ctx.setLineDash([6, 6]);
    gates.forEach(function (g, i) {
      if (i < gates.length - 1) {
        ctx.beginPath();
        ctx.moveTo(g.x + 36 * scale, g.y);
        ctx.lineTo(gates[i + 1].x - 36 * scale, gates[i + 1].y);
        ctx.stroke();
      }
    });
    ctx.setLineDash([]);
    ctx.beginPath();
    ctx.moveTo(gates[2].x, gates[2].y + 40 * scale);
    ctx.lineTo(gates[2].x, ch * 0.62);
    ctx.strokeStyle = PAL.accent;
    ctx.stroke();
  }

  function drawPacket(p) {
    var w = 52 * scale;
    var h = 28 * scale;
    roundRect(p.x - w / 2, p.y - h / 2, w, h, 8, PAL.panel, PAL.ink);
    ctx.fillStyle = PAL.ink;
    ctx.font = (10 * scale) + "px Inter, system-ui, sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(p.label, p.x, p.y + 3 * scale);
    if (p.t > 0.55) {
      ctx.fillStyle = PAL.accent;
      ctx.font = "bold " + (10 * scale) + "px Inter, system-ui, sans-serif";
      ctx.fillText(String(p.score), p.x, p.y - 14 * scale);
    }
  }

  function tick() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.fillStyle = PAL.glow;
    ctx.fillRect(0, 0, cw, ch);

    drawLanes();
    drawFlowLines();

    var phase = (frame * 0.02) % 3;
    gates.forEach(function (g, i) {
      drawGate(g, phase >= i && phase < i + 1.1);
    });

    if (frame % 90 === 0 && packets.length < 6) spawnPacket();

    packets = packets.filter(function (p) {
      p.t += 0.008;
      if (p.t < 0.33) {
        p.x += (gates[0].x - p.x) * 0.04;
        p.y += (gates[0].y - p.y) * 0.04;
      } else if (p.t < 0.66) {
        p.x += (gates[1].x - p.x) * 0.04;
        p.y += (gates[1].y - p.y) * 0.04;
      } else if (p.t < 0.92) {
        p.x += (gates[2].x - p.x) * 0.04;
        p.y += (gates[2].y - p.y) * 0.04;
      } else {
        var targetY = LANES[p.lane].y;
        p.x += (cw * 0.55 - p.x) * 0.05;
        p.y += (targetY - p.y) * 0.06;
        if (p.t > 1.05) {
          p.x += 8 * scale;
        }
      }
      drawPacket(p);
      return p.t < 1.35;
    });

    ctx.fillStyle = PAL.muted;
    ctx.font = (10 * scale) + "px Inter, system-ui, sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Входящие заявки", cw * 0.12, ch * 0.1);
    ctx.fillText("→ CRM / менеджер", cw * 0.88, ch * 0.92);

    requestAnimationFrame(tick);
  }

  window.addEventListener("resize", resize);
  resize();
  for (var i = 0; i < 3; i++) spawnPacket();
  tick();
})();
</script>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-matrica-kvalifikacii" aria-labelledby="akl-matrica-kvalifikacii-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-matrica-kvalifikacii-title">Матрица квалификации лидов: BANT, CHAMP, MEDDIC в правилах AI-агента</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Матрица квалификации лидов</strong> — документ, который превращает методологию продаж в поля, веса и вопросы бота.</p>
<div class="nero-ai-table-wrap"><table class="nero-ai-table">
<thead>
<tr>
<th>Фреймворк</th>
<th>Фокус</th>
<th>Пример полей для AI</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>BANT</strong></td>
<td>Budget, Authority, Need, Timeline</td>
<td>Бюджет, ЛПР, потребность, срок</td>
</tr>
<tr>
<td><strong>CHAMP</strong></td>
<td>Challenges, Authority, Money, Prioritization</td>
<td>Боль, приоритет проекта</td>
</tr>
<tr>
<td><strong>MEDDIC</strong></td>
<td>Metrics, Economic buyer, Decision criteria…</td>
<td>Сложный B2B, комитет закупки</td>
</tr>
</tbody>
</table></div>
<h3>Как формализовать вопросы и веса критериев</h3>
<ol class="nero-ai-prose-list">
<li>Взять 20–30 реальных диалогов/звонков «хороших» и «плохих» лидов.  </li>
<li>Выписать, <strong>почему</strong> отказали (не тот бюджет, регион, «просто узнать»).  </li>
<li>Свести в 3–7 обязательных вопросов в диалоге (как в кейсе VK: тип, район, бюджет, срок — конверсия в показ у квалифицированных <strong>в 2,3 раза выше</strong> (<a href="https://biznesenok.ru/nastrojka-salesbot-v-amocrm-kak-sozdat-chat-bota-dlja-avtomaticheskih-otvetov-i-kvalifikacii-lidov/" target="_blank" rel="noopener noreferrer">>Бизнесёнок</a>)).  </li>
<li>Задать пороги: score ≥ N → hot, иначе warm/cold/disqualified.</li>
</ol>
<p>Gartner (цит. Perspective AI): покупатель проводит <strong>~17%</strong> journey во встречах с поставщиками — аргумент не тратить время менеджера на пустое «discovery», если AI уже собрал поля (<a href="https://getperspective.ai/blog/ai-sales-discovery-2026-pipeline-report-conversational-qualification" target="_blank" rel="noopener noreferrer">>отчёт 2026</a>).</p>
<h3>Лид-магнит «Матрица квалификации лидов» — что внутри</h3>
<p>CTA страницы — <strong>«Получить карту квалификации»</strong>: шаблон статусов, чеклист полей под вашу нишу (услуги / агентство / девелопмент), примеры disqualified и таблица «бот vs AI-агент vs n8n» — без обязательства покупки, с понятным следующим шагом (аудит потока).</p>
<hr>

<aside class="nero-ai-card nero-ai-reveal" aria-label="Призыв к действию: матрица квалификации лидов" style="margin: 2.5rem 0; padding: clamp(24px, 4vw, 36px);">
  <p class="nero-ai-eyebrow" style="margin-bottom: 12px;">Следующий шаг</p>
  <h3 style="margin: 0 0 12px; font-size: clamp(22px, 3vw, 28px);">Получите матрицу квалификации под вашу нишу</h3>
  <p style="margin: 0 0 20px; max-width: 62ch;">Шаблон статусов hot/warm/cold/disqualified, чеклист полей для CRM и примеры disqualified — без обязательства, с понятным следующим шагом (аудит потока).</p>
  <div class="nero-ai-btn-row">
    <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-ai-voronka" aria-labelledby="akl-ai-voronka-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-ai-voronka-title">AI-воронка продаж: этапы от заявки до передачи менеджеру</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>AI воронка продаж</strong> на inbound — цепочка автоматизации <strong>до</strong> человека:</p>
<p><code>mermaid
flowchart LR
  A[Заявка] --&gt; B[Первый ответ AI]
  B --&gt; C[3-7 вопросов + FAQ RAG]
  C --&gt; D{Скоринг}
  D --&gt;|Hot| E[CRM + задача + календарь]
  D --&gt;|Warm| F[Nurture]
  D --&gt;|Cold| G[Отложенный контакт]
  D --&gt;|Disqualified| H[Вежливый отказ + тег]
  E --&gt; I[Менеджер с handoff]</code></p>
<h3>Триггеры автоматизации на каждом этапе</h3>
<ul class="nero-ai-prose-list">
<li>Новое обращение → webhook (сайт, Telegram, VK, amo «Неразобранное»).  </li>
<li>Нет ответа клиента 24 ч → напоминание или смена статуса.  </li>
<li>Score пересёк порог → уведомление в Telegram менеджеру.  </li>
<li>Клиент написал «хочу человека» → <strong>мгновенная эскалация</strong> (снижает риск «&gt;40% ушли после 1-го ответа бота» — метрика из гибридных воронок <a href="https://companies.rbc.ru/news/vb6i8T44zD/avtomatizatsiya-prodazh-voronki-ne-rabotayut-bez-cheloveka/" target="_blank" rel="noopener noreferrer">>РБК</a>).</li>
</ul>
<h3>SLA и эскалация «горячих» лидов</h3>
<p>Для hot: SLA <strong>минуты</strong>, не часы. Позиционирование интеграторов: ответ в первые <strong>5 минут</strong> — до <strong>×10</strong> к конверсии vs час (<a href="https://metasapiens.ru/blog/ai-agenty-v-crm-kak-cifrovoj-sotrudnik-zakryvaet-sdelki" target="_blank" rel="noopener noreferrer">>METASAPIENS</a>) — используйте как ориентир пилота, не гарантию.</p>
<p><strong>Автоматизация квалификации клиентов</strong> на этом этапе — nurture для warm, а не «забыть в CRM».</p>
<hr>

    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-integraciya-crm" aria-labelledby="akl-integraciya-crm-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-integraciya-crm-title">Интеграция AI-квалификации лидов с CRM: amoCRM, Bitrix24 и поля статуса</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Интеграция ai квалификация лидов с crm</strong> — обязательный блок: без полей и задач менеджер снова копирует из чата.</p>
<h3>Теги, задачи менеджеру и сегменты</h3>
<ul class="nero-ai-prose-list">
<li><strong>amoCRM:</strong> Salesbot, Digital Pipeline, API — официальная ветка <a href="https://www.amocrm.ru/support/digitalpipeline/trigger_salesbot" target="_blank" rel="noopener noreferrer">>Salesbot</a>; различие «бот по скрипту» vs «агент с действиями в CRM» — <a href="https://gnzs.ru/blog/chat-boty-amocrm-avtomatizaciya-obshcheniya" target="_blank" rel="noopener noreferrer">>gnzs.ru</a>.  </li>
<li><strong>Битрикс24:</strong> открытые линии, роботы, BitrixGPT для расшифровок (<a href="https://metasapiens.ru/blog/ai-agenty-v-crm-kak-cifrovoj-sotrudnik-zakryvaet-sdelki" target="_blank" rel="noopener noreferrer">>METASAPIENS</a>).  </li>
<li>Поля: <code>ai_status</code>, <code>ai_score</code>, <code>qualification_summary</code>, <code>disqualify_reason</code>.  </li>
<li>Задача: «Перезвонить hot — срок до …» с приоритетом.</li>
</ul>
<h3>Синхронизация статусов без потери истории диалога</h3>
<p>Вся переписка — в таймлайне сделки или прикреплённый транскрипт. Менеджер видит <strong>контекст</strong>, а не «новый лид без имени». Для <strong>152-ФЗ</strong>: self-hosted <strong>n8n</strong>, выбор <strong>YandexGPT</strong> / GigaChat, Zero-retention у API — прозрачность стека (<a href="https://habr.com/ru/articles/1041270/" target="_blank" rel="noopener noreferrer">>Habr, AI-интегратор 2026</a>).</p>
<p><strong>AI для crm</strong> в 2026 — не виджет поверх, а «цифровой сотрудник», который <strong>закрывает поля</strong> до человека.</p>
<hr>

    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-vnedrenie-pod-klyuch" aria-labelledby="akl-vnedrenie-pod-klyuch-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-vnedrenie-pod-klyuch-title">Внедрение AI-квалификации лидов под ключ: этапы, сроки и роли команды</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>Внедрение ai квалификация лидов</strong> и <strong>настройка ai квалификация лидов</strong> в типовом проекте Nero Network:</p>
<div class="nero-ai-table-wrap"><table class="nero-ai-table">
<thead>
<tr>
<th>Этап</th>
<th>Содержание</th>
<th>Срок (ориентир)</th>
</tr>
</thead>
<tbody>
<tr>
<td>1. Аудит</td>
<td>Каналы, ICP, % нецелевых, карта CRM</td>
<td>3–5 дней</td>
</tr>
<tr>
<td>2. Пилот-канал</td>
<td>Telegram / форма с max трафиком</td>
<td>1 неделя</td>
</tr>
<tr>
<td>3. Скрипт + RAG</td>
<td>3–7 вопросов, FAQ, прайс, кейсы</td>
<td>3–7 дней</td>
</tr>
<tr>
<td>4. CRM + маршрутизация</td>
<td>Поля, статусы, задачи</td>
<td>2–5 дней</td>
</tr>
<tr>
<td>5. Shadow mode</td>
<td>AI пишет в CRM, менеджер сверяет</td>
<td>1–2 недели</td>
</tr>
<tr>
<td>6. A/B 20% → 100%</td>
<td>Дашборд метрик</td>
<td>2–4 недели</td>
</tr>
</tbody>
</table></div>
<p>Обзоры рынка обещают <strong>7–14 дней</strong> на запуск простого сценария (<a href="https://www.sostav.ru/blogs/281569/88008" target="_blank" rel="noopener noreferrer">>Sostav, план ОП 2026</a>); <strong>внедрение ai в бизнес процессы</strong> с LLM и несколькими каналами реалистичнее в <strong>3–6 недель</strong>.</p>
<h3>Аудит текущей воронки и источников лидов</h3>
<ul class="nero-ai-prose-list">
<li>Откуда лиды (Директ, Avito, Циан, VK, сайт).  </li>
<li>Сколько % disqualified по факту (не по ощущениям).  </li>
<li>Где теряется speed-to-lead.</li>
</ul>
<h3>Пилот, обучение отдела продаж, масштабирование</h3>
<p>Пилот <strong>одного канала</strong> снижает страх «бот испортит продажи». Обучение ОП: как читать handoff, когда забирать диалог у AI. Масштабирование — после метрик: % drop-off после 1-го ответа, контакты с ИИ до человека, конверсия hot → встреча.</p>
<p><strong>Внедрение ai агентов</strong> в связке Make/n8n + CRM — типовой цикл «событие → LLM → CRM → алерт» (<a href="https://habr.com/ru/articles/1041270/" target="_blank" rel="noopener noreferrer">>Habr</a>).</p>
<hr>

<p class="nero-ai-inline-cta nero-ai-reveal" style="margin: 2rem 0; padding: 18px 20px; border-left: 3px solid var(--nero-ai-primary); background: rgba(255,255,255,0.04); border-radius: 12px;">
  <strong>Больше по внедрению и обучению ОП:</strong>
  <a href="<?php echo esc_url($secondary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a> — кейсы, разборы автоматизации и практики для отдела продаж.
</p>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-stoimost" aria-labelledby="akl-stoimost-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-stoimost-title">Стоимость, срок окупаемости и чек 150–450 тыс. ₽: когда внедрение оправдано</h2>
    </header>
    <div class="nero-ai-prose">
<p><strong>AI квалификация лидов цена</strong> складывается из: аудит, разработка сценария и RAG, интеграции, shadow mode, обучение. Для узкой B2B-страницы ориентир чека из внутренней матрицы тем: <strong>150–450 тыс. ₽</strong> — вилка под ключ для среднего потока (не enterprise с сотнями интеграций).</p>
<p>Западные платформы категории Drift / Conversica — от <strong>~$2 500/мес</strong> (Drift) и custom (<a href="https://prospeo.io/s/conversica-vs-drift" target="_blank" rel="noopener noreferrer">>сравнение</a>); для РФ часто выгоднее <strong>кастом на amo/Битрикс + n8n</strong> под процесс, а не только подписка на коробку.</p>
<h3>ROI: меньше часов менеджеров на «мусорные» заявки</h3>
<p>Считайте: (число заявок × доля нецелевых × минуты менеджера × ставка часа). При <strong>40–60%</strong> отсеве (<a href="https://www.sostav.ru/blogs/281569/87715" target="_blank" rel="noopener noreferrer">>Sostav</a>) и фокусе на hot окупаемость — в горизонте месяцев, <strong>без обещания фиксированного %</strong> без вашего пилота.</p>
<p>Hybrid AI SDR (1 human + 2 AI seats): <strong>−54% cost per qualified opportunity</strong> vs human-only; чистый AI хуже на closed-won на старших лидах (<a href="https://www.digitalapplied.com/blog/ai-sdr-statistics-2026-outbound-sales-data-points" target="_blank" rel="noopener noreferrer">>Digital Applied, 2026</a>) — аргумент за квалификацию AI, закрытие человеком.</p>
<h3>AI-квалификация лидов для малого бизнеса и среднего B2B</h3>
<p><strong>AI квалификация лидов для малого бизнеса</strong> имеет смысл при <strong>стабильном потоке</strong> (условно от 50–100 обращений/мес) и дорогом часе менеджера. Ниже порога — достаточно Salesbot на 4 вопроса (~6 часов настройки в кейсе ЕКБ). <strong>AI квалификация лидов для бизнеса</strong> среднего сегмента — sweet spot: несколько менеджеров, CRM уже есть, боль «тонем в нецелевых» узнаваема.</p>
<hr>

    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" id="akl-kejsy" aria-labelledby="akl-kejsy-title">
  <div class="nero-ai-container nero-ai-prose-wrap">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-kejsy-title">Кейсы: B2B-услуги, агентства, девелоперы — примеры внедрения</h2>
    </header>
    <div class="nero-ai-prose">
<h3>Метрики до/после (конверсия в встречу, доля нецелевых)</h3>
<div class="nero-ai-table-wrap"><table class="nero-ai-table">
<thead>
<tr>
<th>Кейс</th>
<th>Регион / ниша</th>
<th>Результат</th>
<th>Источник</th>
</tr>
</thead>
<tbody>
<tr>
<td>ИИ-агент 4 критерия</td>
<td>Недвижимость, Москва</td>
<td>~55% нецелевых → −40% нагрузка на ОП</td>
<td><a href="https://www.sostav.ru/blogs/281569/87715" target="_blank" rel="noopener noreferrer">>Sostav</a></td>
</tr>
<tr>
<td>Salesbot 4 вопроса VK</td>
<td>Недвижимость, Екатеринбург</td>
<td>Показ ×2,3; 22→4 мин до контакта</td>
<td><a href="https://biznesenok.ru/nastrojka-salesbot-v-amocrm-kak-sozdat-chat-bota-dlja-avtomaticheskih-otvetov-i-kvalifikacii-lidov/" target="_blank" rel="noopener noreferrer">>Бизнесёнок</a></td>
</tr>
<tr>
<td>Гибридная воронка</td>
<td>B2B (обзор)</td>
<td>KPI: уход после 1-го ответа ИИ, касания до человека</td>
<td><a href="https://companies.rbc.ru/news/vb6i8T44zD/avtomatizatsiya-prodazh-voronki-ne-rabotayut-bez-cheloveka/" target="_blank" rel="noopener noreferrer">>РБК</a></td>
</tr>
<tr>
<td>412 SaaS-воронок</td>
<td>Международный B2B</td>
<td>78% с conversational layer; 3,4× pipeline</td>
<td><a href="https://getperspective.ai/blog/ai-sales-discovery-2026-pipeline-report-conversational-qualification" target="_blank" rel="noopener noreferrer">>Perspective AI</a></td>
</tr>
</tbody>
</table></div>
<p>Публичных enterprise-кейсов с независимым аудитом в РФ мало; в <strong>пример внедрения ai квалификация лидов</strong> на вашей странице честно разделяйте: проверенные цифры со ссылкой vs проектная модель пилота.</p>
<h3>Что показать на демо интеграции</h3>
<ol class="nero-ai-prose-list">
<li>Диалог: клиент «нецелевой» → вежливый отказ + тег.  </li>
<li>Диалог: «горячий» → карточка в amo/Битрикс + задача.  </li>
<li>Экран менеджера: summary + цитаты.  </li>
<li>Дашборд: speed-to-lead, % disqualified, drop-off после 1-го сообщения.</li>
</ol>
<p><strong>AI квалификация лидов кейсы</strong> для агентств и девелоперов — ближе всего к недвижимости; для B2B-услуг переносите логику полей (бюджет проекта, срок старта, тип услуги).</p>
<p><em>Отстройка от смежного кластера <code>ai-obrabotka-zayavok-s-sayta</code>: там фокус на </em><em>первичной обработке заявки</em><em>; здесь — </em><em>скоринг и статусы до передачи в продажи</em><em>.</em></p>
<hr>

    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-reveal" aria-label="Финальный призыв к действию">
  <div class="nero-ai-container">
    <div class="nero-ai-final-cta nero-ai-card nero-ai-reveal" role="region" aria-labelledby="akl-final-cta-title">
      <h2 id="akl-final-cta-title">Внедрим AI-квалификацию лидов под ключ</h2>
      <p>Скоринг, статусы hot/warm/cold/disqualified и handoff в amoCRM или Битрикс24 — пилот на одном канале, затем масштабирование.</p>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>
</section>

<section class="nero-ai-section nero-ai-section-alt nero-ai-reveal" id="akl-faq" aria-labelledby="akl-faq-title">
  <div class="nero-ai-container">
    <header class="nero-ai-section-head nero-ai-left">
      <h2 id="akl-faq-title">FAQ по AI-квалификации лидов</h2>
    </header>
    <div class="nero-ai-faq nero-ai-reveal">
      <details class="nero-ai-reveal"><summary>Сколько времени занимает внедрение под ключ?</summary><p>Простой сценарий на одном канале — <strong>7–14 дней</strong> по рыночным обзорам; LLM + RAG + несколько интеграций — <strong>3–6 недель</strong> с shadow mode.</p></details>
      <details class="nero-ai-reveal"><summary>Можно ли подключить без замены CRM?</summary><p>Да. <strong>AI для crm</strong> — надстройка: amoCRM, Битрикс24 остаются системой учёта; меняются поля, роботы и источник первого диалога.</p></details>
      <details class="nero-ai-reveal"><summary>Как обучить AI под нишу девелопера или агентства?</summary><p>RAG по FAQ/прайсу/кейсам + 20–30 реальных диалогов для тона + матрица disqualified (бюджет, район, тип объекта). Эскалация на человека при нестандартных условиях.</p></details>
      <details class="nero-ai-reveal"><summary>Чем отличается от «AI-обработки заявок с сайта»?</summary><p>Обработка заявки — приём и первый ответ; <strong>ai квалификация лидов</strong> — <strong>скоринг, статусы и handoff</strong> с критериями ICP до активной работы ОП.</p></details>
      <details class="nero-ai-reveal"><summary>Как внедрить ai квалификация лидов по шагам?</summary><p>Аудит → один канал → скрипт 3–7 вопросов → CRM → shadow mode → масштабирование (см. раздел «Внедрение»).</p></details>
      <details class="nero-ai-reveal"><summary>AI квалификация лидов под ключ — что входит?</summary><p>ICP, матрица, RAG, интеграция amo/Битрикс, маршрутизация hot/warm/cold, обучение ОП, дашборд метрик.</p></details>
      <details class="nero-ai-reveal"><summary>AI квалификация лидов цена и из чего складывается?</summary><p>Аудит, разработка, интеграции, пилот; ориентир <strong>150–450 тыс. ₽</strong> для типового B2B-проекта — уточняется после аудита потока.</p></details>
      <details class="nero-ai-reveal"><summary>Интеграция с amoCRM и Bitrix24</summary><p>Salesbot, API, открытые линии; поля статуса и транскрипт в карточке — см. <a href="https://www.amocrm.ru/support/digitalpipeline/trigger_salesbot" target="_blank" rel="noopener noreferrer">>документацию amo Salesbot</a>.</p></details>
      <details class="nero-ai-reveal"><summary>AI квалификация лидов для малого бизнеса — когда имеет смысл?</summary><p>При регулярном потоке и дорогом времени менеджера; иначе — лёгкий Salesbot.</p></details>
      <details class="nero-ai-reveal"><summary>Автоматизация через ai квалификация лидов без потери качества диалога</summary><p>Shadow mode, эскалация «хочу человека», метрика silent churn, живой тон из ваших диалогов — не шаблон «здравствуйте, выберите 1–5».</p></details>
      <details class="nero-ai-reveal"><summary>Что такое скоринг лидов и чем он отличается от квалификации?</summary><p>Скоринг — приоритет; квалификация — решение «передаём в ОП / nurture / отказ» по порогам.</p></details>
      <details class="nero-ai-reveal"><summary>Заменит ли AI менеджеров?</summary><p>Нет. <strong>~81%</strong> B2B sales orgs пилотируют AI, но закрытие и сложные переговоры остаются за людьми (<a href="https://getgangly.com/blog/state-of-ai-b2b-sales-2026" target="_blank" rel="noopener noreferrer">>Gangly / State of Sales</a>). Inbound-квалификация — зона AI; цена и комитет — человек.</p>
<hr></details>
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
      "name": "Сколько времени занимает внедрение под ключ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Простой сценарий на одном канале — 7–14 дней по рыночным обзорам; LLM + RAG + несколько интеграций — 3–6 недель с shadow mode."
      }
    },
    {
      "@type": "Question",
      "name": "Можно ли подключить без замены CRM?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Да. AI для crm — надстройка: amoCRM, Битрикс24 остаются системой учёта; меняются поля, роботы и источник первого диалога."
      }
    },
    {
      "@type": "Question",
      "name": "Как обучить AI под нишу девелопера или агентства?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "RAG по FAQ/прайсу/кейсам + 20–30 реальных диалогов для тона + матрица disqualified (бюджет, район, тип объекта). Эскалация на человека при нестандартных условиях."
      }
    },
    {
      "@type": "Question",
      "name": "Чем отличается от «AI-обработки заявок с сайта»?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Обработка заявки — приём и первый ответ; ai квалификация лидов — скоринг, статусы и handoff с критериями ICP до активной работы ОП."
      }
    },
    {
      "@type": "Question",
      "name": "Как внедрить ai квалификация лидов по шагам?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Аудит → один канал → скрипт 3–7 вопросов → CRM → shadow mode → масштабирование (см. раздел «Внедрение»)."
      }
    },
    {
      "@type": "Question",
      "name": "AI квалификация лидов под ключ — что входит?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "ICP, матрица, RAG, интеграция amo/Битрикс, маршрутизация hot/warm/cold, обучение ОП, дашборд метрик."
      }
    },
    {
      "@type": "Question",
      "name": "AI квалификация лидов цена и из чего складывается?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Аудит, разработка, интеграции, пилот; ориентир 150–450 тыс. ₽ для типового B2B-проекта — уточняется после аудита потока."
      }
    },
    {
      "@type": "Question",
      "name": "Интеграция с amoCRM и Bitrix24",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Salesbot, API, открытые линии; поля статуса и транскрипт в карточке — см. >документацию amo Salesbot ."
      }
    }
  ]
}
</script>

<?php
get_footer();

<?php
/**
 * Template Name: AI CRM Auto-Fill
 * Description: AI-заполнение CRM — внедрение под ключ (amoCRM, Битрикс24, retailCRM)
 */

declare(strict_types=1);

$page_seo_title = 'AI-заполнение CRM: внедрение под ключ | amoCRM, Битрикс24';
$page_seo_description = 'Менеджеры не заполняют CRM? Внедрим AI-автозаполнение карточек, задач и итогов звонков в amoCRM, Битрикс24 и retailCRM. Диагностика хаоса и проект под ключ.';

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

require_once get_stylesheet_directory() . '/partials/nero-ai-cta-helpers.php';

// deploy:cta-env
$primary_cta_label = nero_ai_resolve_env('PRIMARY_CTA_LABEL') ?: 'Бесплатный аудит';
$primary_cta_url = nero_ai_resolve_env('PRIMARY_CTA_URL') ?: '#';
$secondary_cta_label = nero_ai_resolve_env('SECONDARY_CTA_LABEL') ?: 'Что можно автоматизировать';
$secondary_cta_url = nero_ai_resolve_env('SECONDARY_CTA_URL');
if ($secondary_cta_url === '') {
    $secondary_cta_url = home_url('/#services');
}
// end:cta-env

require get_stylesheet_directory() . '/partials/nero-ai-longread-bootstrap.php';

$nero_header_nav_links = [
    ['href' => '#pochemu-ne-zapolnyayut', 'label' => 'Почему не заполняют'],
    ['href' => '#do-i-posle', 'label' => 'До и после'],
    ['href' => '#kak-ai-zapolnyaet', 'label' => 'Как AI заполняет'],
    ['href' => '#ai-amocrm', 'label' => 'amoCRM'],
    ['href' => '#ai-bitrix24', 'label' => 'Битрикс24'],
    ['href' => '#ai-retailcrm', 'label' => 'retailCRM'],
    ['href' => '#chto-avtomatizirovat', 'label' => 'Автоматизация'],
    ['href' => '#vnedrenie-pod-klyuch', 'label' => 'Внедрение'],
    ['href' => '#diagnostika-crm', 'label' => 'Диагностика'],
    ['href' => '#riski-152fz', 'label' => '152-ФЗ'],
    ['href' => '#faq', 'label' => 'FAQ'],
];
$nero_header_cta_label = $primary_cta_label;
$nero_header_cta_url = $primary_cta_url;

$hero_title = 'AI-заполнение CRM — внедрение под ключ';
$hero_title_id = 'vnedrenie-ai-zapolnenie-crm-hero-title';
$hero_eyebrow = (getenv('SITE_BRAND') ?: get_bloginfo('name') ?: '') . ' · AI-гигиена CRM';
$hero_lead = 'AI структурирует звонки, переписки и заявки в amoCRM, Битрикс24 и retailCRM — собственник видит реальную воронку, менеджеры не тратят вечер на CRM.';
$hero_badges = [
    'amoCRM',
    'Bitrix24',
    'retailCRM',
    'Post-call fill',
    'STT → LLM → CRM',
    'Human-in-the-loop',
    '152-ФЗ',
];
$hero_primary_label = 'Диагностика хаоса в CRM';
$hero_primary_url = '#diagnostika-crm';
$hero_secondary_label = $primary_cta_label;
$hero_secondary_url = $primary_cta_url;
$hero_dashboard_title = 'CRM hygiene hub · post-call fill';
$hero_dashboard_note = 'демо · звонок → поля CRM · live';
$hero_metrics = [
    ['label' => 'Fill rate полей', 'value' => '91%'],
    ['label' => 'Время на CRM', 'value' => '−72%'],
    ['label' => 'Lag обновления', 'value' => '4 мин'],
    ['label' => 'Post-call review', 'value' => '3:20'],
];
$hero_feed = [
    ['dot' => 'blue', 'text' => 'Звонок 12:04 · 8:32 — STT: расшифровка и саммари готовы'],
    ['dot' => 'blue', 'text' => 'Извлечены поля: бюджет 420 тыс. ₽ · срок Q3 · ЛПР да'],
    ['dot' => 'amber', 'text' => 'Черновик в amoCRM — этап «Переговоры» · задача follow-up'],
    ['dot' => 'green', 'text' => 'Менеджер подтвердил черновик — post-call fill · карточка актуальна'],
];

get_header();
?>

<style>
/* Critical: theme reset + hero shell (must stay at top of style block) */
.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs, .yoast-breadcrumb,
.entry-header, .page-title-section { display: none !important; }

#primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}

.nero-ai-home-page > .nero-ai-home .nero-ai-hero {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, 0.98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
/**
 * Homepage design tokens for AI/B2B longread pages (.nero-ai-home-page).
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



.ym-container {
  width: min(var(--nero-ai-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

/* Intro after hero */
.vnedrenie-ai-zapolnenie-crm-intro {
  padding: clamp(48px, 6vw, 72px) 0 clamp(28px, 4vw, 40px);
}
.vnedrenie-ai-zapolnenie-crm-intro__grid {
  display: grid;
  grid-template-columns: minmax(0, 1.15fr) minmax(280px, 0.85fr);
  gap: clamp(24px, 4vw, 40px);
  align-items: start;
}
.vnedrenie-ai-zapolnenie-crm-intro__text {
  text-align: left !important;
  border-left: 4px solid var(--nero-ai-primary);
  padding-left: clamp(18px, 3vw, 28px);
}
.vnedrenie-ai-zapolnenie-crm-intro__text p {
  text-align: left !important;
  margin: 0 0 16px;
  font-size: clamp(16px, 1.6vw, 18px);
  line-height: 1.65;
  color: var(--nero-ai-soft) !important;
}
.vnedrenie-ai-zapolnenie-crm-intro__text p:last-child { margin-bottom: 0; }
.vnedrenie-ai-zapolnenie-crm-intro__lead {
  font-size: clamp(17px, 1.8vw, 20px) !important;
  color: var(--nero-ai-heading) !important;
  font-weight: 650;
}
.vnedrenie-ai-zapolnenie-crm-intro__terminal {
  padding: 18px;
  border-radius: 20px;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.10);
}
.vnedrenie-ai-zapolnenie-crm-intro__terminal-head {
  display: flex;
  gap: 6px;
  margin-bottom: 14px;
}
.vnedrenie-ai-zapolnenie-crm-intro__terminal-head span {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(255,255,255,.22);
}
.vnedrenie-ai-zapolnenie-crm-intro__terminal-head span:nth-child(1) { background: #fb7185; }
.vnedrenie-ai-zapolnenie-crm-intro__terminal-head span:nth-child(2) { background: #fbbf24; }
.vnedrenie-ai-zapolnenie-crm-intro__terminal-head span:nth-child(3) { background: #34d399; }
.vnedrenie-ai-zapolnenie-crm-intro__chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 14px;
  padding: 0;
  list-style: none;
}
.vnedrenie-ai-zapolnenie-crm-intro__chips li {
  padding: 7px 11px;
  border-radius: 999px;
  border: 1px solid rgba(121,242,255,.22);
  background: rgba(121,242,255,.08);
  color: var(--nero-ai-primary) !important;
  font-size: 12px;
  font-weight: 700;
}
.vnedrenie-ai-zapolnenie-crm-intro__pipeline {
  font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
  font-size: 12px;
  line-height: 1.55;
  color: var(--nero-ai-muted);
  margin: 0;
  white-space: pre-line;
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
.nero-ai-prose pre {
  overflow-x: auto;
  padding: 16px 18px;
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.08);
  font-size: 13px;
  line-height: 1.55;
  color: var(--nero-ai-soft);
}

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

.nero-ai-final-cta h2 {
  margin: 0 0 12px;
  font-size: clamp(26px, 3vw, 36px);
}

.nero-ai-faq details {
  border: 1px solid rgba(255,255,255,.10);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
  margin-bottom: 10px;
  padding: 0 16px;
}
.nero-ai-faq summary {
  cursor: pointer;
  font-weight: 800;
  padding: 16px 0;
  color: var(--nero-ai-heading);
  list-style: none;
}
.nero-ai-faq summary::-webkit-details-marker { display: none; }
.nero-ai-faq details p { margin: 0 0 16px; }

.nero-ai-summary {
  margin-top: 24px;
  padding: 20px 22px;
  border-radius: 18px;
  border: 1px solid rgba(34,197,94,.22);
  background: rgba(34,197,94,.08);
}
.nero-ai-summary p { margin: 0; color: var(--nero-ai-soft) !important; }

#diagnostika-crm {
  scroll-margin-top: 96px;
}

/* Boris block (extracted from article visual) */
#boris-crm-hygiene-block.boris-crm-hygiene-section {
  --boris-bg: #f8fafc;
  --boris-surface: #ffffff;
  --boris-border: rgba(15, 23, 42, 0.08);
  --boris-text: #0f172a;
  --boris-muted: #64748b;
  --boris-accent: #2563eb;
  --boris-accent-soft: #dbeafe;
  --boris-danger: #ef4444;
  --boris-danger-soft: #fee2e2;
  --boris-success: #059669;
  --boris-success-soft: #d1fae5;
  --boris-violet: #7c3aed;
  --boris-radius: 22px;
  margin: 2.5rem 0 3rem;
  font-family: Inter, system-ui, -apple-system, sans-serif;
}
#boris-crm-hygiene-block .boris-crm-hygiene-card {
  background: var(--boris-bg);
  border: 1px solid var(--boris-border);
  border-radius: var(--boris-radius);
  box-shadow: 0 18px 48px rgba(15, 23, 42, 0.06);
  padding: clamp(1.25rem, 3vw, 2.25rem);
  overflow: hidden;
}
#boris-crm-hygiene-block .boris-crm-hygiene-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
  gap: clamp(1.25rem, 3vw, 2rem);
  align-items: center;
}
#boris-crm-hygiene-block .boris-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--boris-accent);
  margin-bottom: 0.65rem;
}
#boris-crm-hygiene-block .boris-eyebrow::before {
  content: "";
  width: 18px;
  height: 2px;
  background: var(--boris-accent);
  border-radius: 2px;
}
#boris-crm-hygiene-block .boris-kicker {
  font-size: clamp(1.15rem, 2.2vw, 1.45rem);
  font-weight: 700;
  line-height: 1.25;
  color: var(--boris-text);
  margin: 0 0 0.85rem;
}
#boris-crm-hygiene-block .boris-lead {
  font-size: 0.95rem;
  line-height: 1.55;
  color: var(--boris-muted);
  margin: 0 0 1.1rem;
}
#boris-crm-hygiene-block .boris-stat-row {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 1.15rem;
}
#boris-crm-hygiene-block .boris-pill {
  display: inline-flex;
  align-items: center;
  gap: 0.35rem;
  padding: 0.35rem 0.7rem;
  border-radius: 999px;
  font-size: 0.78rem;
  font-weight: 600;
  line-height: 1.2;
  border: 1px solid transparent;
}
#boris-crm-hygiene-block .boris-pill--danger {
  background: var(--boris-danger-soft);
  color: #b91c1c;
  border-color: rgba(239, 68, 68, 0.15);
}
#boris-crm-hygiene-block .boris-pill--success {
  background: var(--boris-success-soft);
  color: #047857;
  border-color: rgba(5, 150, 105, 0.15);
}
#boris-crm-hygiene-block .boris-pill--neutral {
  background: var(--boris-accent-soft);
  color: #1d4ed8;
  border-color: rgba(37, 99, 235, 0.12);
}
#boris-crm-hygiene-block .boris-points {
  list-style: none;
  margin: 0 0 1rem;
  padding: 0;
  display: grid;
  gap: 0.55rem;
}
#boris-crm-hygiene-block .boris-points li {
  position: relative;
  padding-left: 1.15rem;
  font-size: 0.88rem;
  line-height: 1.45;
  color: var(--boris-text);
}
#boris-crm-hygiene-block .boris-points li::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0.55em;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--boris-accent);
}
#boris-crm-hygiene-block .boris-bridge {
  font-size: 0.82rem;
  color: var(--boris-muted);
  margin: 0;
  padding-top: 0.5rem;
  border-top: 1px dashed var(--boris-border);
}
#boris-crm-hygiene-block .boris-canvas-wrap {
  position: relative;
  background: var(--boris-surface);
  border: 1px solid var(--boris-border);
  border-radius: 18px;
  min-height: 380px;
  height: clamp(380px, 52vw, 520px);
  overflow: hidden;
}
#boris-crm-hygiene-block #crm-hygiene-flow-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
#boris-crm-hygiene-block .boris-canvas-legend {
  position: absolute;
  bottom: 10px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 0.65rem;
  flex-wrap: wrap;
  justify-content: center;
  padding: 0.35rem 0.65rem;
  background: rgba(255, 255, 255, 0.92);
  border: 1px solid var(--boris-border);
  border-radius: 999px;
  font-size: 0.68rem;
  color: var(--boris-muted);
  pointer-events: none;
}
#boris-crm-hygiene-block .boris-legend-dot {
  display: inline-flex;
  align-items: center;
  gap: 0.3rem;
}
#boris-crm-hygiene-block .boris-legend-dot i {
  display: inline-block;
  width: 8px;
  height: 8px;
  border-radius: 50%;
}
@media (max-width: 1023px) {
  #boris-crm-hygiene-block .boris-crm-hygiene-grid {
    grid-template-columns: 1fr;
  }
  #boris-crm-hygiene-block .boris-canvas-wrap {
    min-height: 340px;
    height: 360px;
  }
}

@media (max-width: 900px) {
  .vnedrenie-ai-zapolnenie-crm-intro__grid { grid-template-columns: 1fr; }
  .nero-ai-hero-grid { grid-template-columns: 1fr; }
}

</style>

<main id="primary" class="site-main vnedrenie-ai-zapolnenie-crm-page nero-ai-home-page" role="main" tabindex="-1">
<?php require get_stylesheet_directory() . '/partials/nero-ai-site-header.php'; ?>
<?php require get_stylesheet_directory() . '/partials/nero-ai-longread-hero-shell.php'; ?>

  <section class="nero-ai-section-tight vnedrenie-ai-zapolnenie-crm-intro" aria-label="Введение">
    <div class="nero-ai-container">
      <div class="vnedrenie-ai-zapolnenie-crm-intro__grid nero-ai-reveal">
        <div class="vnedrenie-ai-zapolnenie-crm-intro__text">
          <p class="vnedrenie-ai-zapolnenie-crm-intro__lead"><strong>Коротко:</strong> AI-заполнение CRM — цепочка «звонок / чат / заявка → расшифровка → извлечение полей → запись в amoCRM, Битрикс24 или retailCRM» с подтверждением менеджером. Собственник видит актуальную воронку; менеджеры не тратят вечер на карточки.</p>
          <p>CRM есть у большинства компаний, но качество данных часто хуже, чем кажется на дашборде. AI-гигиена CRM структурирует звонки, переписки и заявки в поля CRM — менеджер проверяет черновик за 2–5 минут вместо 15–25 минут ручного ввода после каждого контакта.</p>
        </div>
        <div class="vnedrenie-ai-zapolnenie-crm-intro__terminal nero-ai-reveal nero-ai-delay-1" aria-hidden="true">
          <div class="vnedrenie-ai-zapolnenie-crm-intro__terminal-head"><span></span><span></span><span></span></div>
          <ul class="vnedrenie-ai-zapolnenie-crm-intro__chips">
            <li>76% записей неполные</li>
            <li>STT → LLM → CRM</li>
            <li>Human-in-the-loop</li>
            <li>amoCRM / Б24 / retailCRM</li>
          </ul>
          <p class="vnedrenie-ai-zapolnenie-crm-intro__pipeline">звонок завершён
  ↓ STT + LLM
  ↓ поля сделки
  ↓ confirm 3–5 мин
  ↓ API CRM · live</p>
        </div>
      </div>
    </div>
  </section>

  <nav class="nero-ai-toc-wrap" aria-label="Оглавление">
    <ul class="nero-ai-toc nero-ai-reveal">
      <li><a href="#pochemu-ne-zapolnyayut">Почему не заполняют CRM</a></li>
      <li><a href="#do-i-posle">До и после</a></li>
      <li><a href="#kak-ai-zapolnyaet">Как AI заполняет</a></li>
      <li><a href="#ai-amocrm">amoCRM</a></li>
      <li><a href="#ai-bitrix24">Битрикс24</a></li>
      <li><a href="#ai-retailcrm">retailCRM</a></li>
      <li><a href="#chto-avtomatizirovat">Что автоматизировать</a></li>
      <li><a href="#vnedrenie-pod-klyuch">Внедрение</a></li>
      <li><a href="#diagnostika-crm">Диагностика CRM</a></li>
      <li><a href="#riski-152fz">152-ФЗ и риски</a></li>
      <li><a href="#faq">FAQ</a></li>
    </ul>
  </nav>

  <section id="pochemu-ne-zapolnyayut" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>1. Почему менеджеры не заполняют CRM — и почему собственник не видит воронку</h2>
      <p>CRM есть у большинства компаний, но <strong>качество данных</strong> часто хуже, чем кажется на дашборде. Landbase (2025–2026): <strong>76%</strong> пользователей CRM отмечают — менее половины записей полные и точные. VantagePoint (SaleSso 2025): <strong>79%</strong> данных о сделках из разговоров <strong>никогда не попадает в CRM</strong>.</p>
      <p>В России картина схожа: vc.ru (2026) оценивает до <strong>90% данных в CRM как «мусор»</strong> — менеджеры не фиксируют возражения, сокращают записи. РБК Компании: <em>«Если менеджер тратит на заполнение системы больше времени, чем на работу с клиентом, он упростит процесс»</em>.</p>

      <h3 id="sabotazh-crm">Саботаж CRM: рутина, обязательные поля и «вечер на карточках»</h3>
      <p>Причины, почему менеджеры не заполняют CRM:</p>
      <ul>
        <li><strong>Двойная работа</strong> — разговор состоялся, CRM требует повторить факты в 15–30 полях.</li>
        <li><strong>Перегруженность полями</strong> — обязательных больше, чем нужно для прогноза.</li>
        <li><strong>Нет выгоды сегодня</strong> — карточка не закрывает сделку, зато отнимает 15–25 мин после звонка (международный бенчмарк, ориентир).</li>
        <li><strong>Post-call откладывают</strong> — «заполню вечером» = не заполнят.</li>
      </ul>
      <p>Salesforce State of Sales 2026 (n=4 050): <strong>60%</strong> недели reps — не продажи (admin, CRM, митинги); <strong>43%</strong> тратят 10–20 ч/нед на административку; <strong>68%</strong> называют data input самой тяжёлой задачей (Attention.com).</p>

      <h3 id="chto-teryaet-sobstvennik">Что теряет собственник: слепая воронка, ложные прогнозы, нет контроля сделок</h3>
      <ul>
        <li><strong>Слепая воронка</strong> — этапы меняют, контекст в голове менеджера.</li>
        <li><strong>Ложные прогнозы</strong> — pipeline на пустых «бюджет / срок / ЛПР».</li>
        <li><strong>Lag обновления</strong> — карточка актуальна раз в день, не после контакта.</li>
        <li><strong>Автоматизация на мусоре</strong> — триггеры и AI-аналитика работают хуже.</li>
      </ul>
      <p>CNews / J'son &amp; Partners (2026): <strong>69%</strong> CRM-пользователей работают ежедневно, но только <strong>20%</strong> компаний внедряют CRM из-за потерь лидов — проблема в <strong>качестве данных</strong>, не в отсутствии системы.</p>

      <h3 id="ai-gigiena-kak-otvet">AI-гигиена CRM как ответ: данные из звонков и переписок без ручного ввода</h3>
      <p><strong>AI-гигиена CRM</strong> — санитария данных: AI структурирует звонки, переписки и заявки в поля CRM, менеджер проверяет черновик за 2–5 мин. Тренд IBM/Gartner (2026): <strong>agentic AI + post-call automation</strong> — AI обновляет CRM-поля после контакта.</p>
      <p><strong>Определение:</strong> AI-заполнение CRM — цепочка «коммуникация → STT/LLM → поля CRM → задача на подтверждение».</p>

      <aside class="nero-ai-card nero-ai-reveal nero-ai-inline-cta" aria-label="Диагностика хаоса в CRM">
        <p class="nero-ai-eyebrow">Лид-магнит · бесплатно</p>
        <h3>Диагностика хаоса в CRM</h3>
        <p>За 30–50 минут разберём fill rate обязательных полей, lag обновления карточек, карту каналов и запись звонков — поймёте, где «слепая воронка» и что автоматизировать первым.</p>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo nero_ai_external_link_attrs($primary_cta_url); ?>>Диагностика хаоса в CRM</a>
        </div>
      </aside>
    </div>
  </section>

  <section id="do-i-posle" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>2. До и после: AI-гигиена CRM в цифрах</h2>
      <p>Цифры — <strong>ориентиры индустрии</strong>, если не указано иное.</p>

      <div class="ym-container">
<section id="boris-crm-hygiene-block" class="boris-crm-hygiene-section" aria-labelledby="boris-crm-hygiene-title">
<div class="boris-crm-hygiene-card">
  <div class="boris-crm-hygiene-grid">
    <div class="boris-crm-hygiene-copy">
      <p class="boris-eyebrow">До / после · карта потока</p>
      <h3 id="boris-crm-hygiene-title" class="boris-kicker">От хаоса карточек к прозрачной воронке</h3>
      <p class="boris-lead">Пока менеджеры откладывают CRM «на вечер», данные из звонков не попадают в поля. AI-гигиена пропускает переговоры через STT и LLM — и возвращает структурированную карточку за 3–5 минут review.</p>
      <div class="boris-stat-row">
        <span class="boris-pill boris-pill--danger"><strong>76%</strong> записей неполные</span>
        <span class="boris-pill boris-pill--danger"><strong>79%</strong> данных не в CRM</span>
        <span class="boris-pill boris-pill--success"><strong>−75%</strong> ручного ввода*</span>
      </div>
      <ul class="boris-points">
        <li><strong>До:</strong> пустые поля, lag «конец дня», слепые этапы воронки</li>
        <li><strong>Цепочка:</strong> звонок → STT → LLM → confirm → API CRM</li>
        <li><strong>После:</strong> fill rate 85–95%+, задачи и резюме сразу после контакта</li>
      </ul>
      <p class="boris-bridge">Дальше разберём пошаговую схему STT, webhook и human-in-the-loop ↓</p>
    </div>
    <div class="boris-canvas-wrap" aria-hidden="true">
      <canvas id="crm-hygiene-flow-canvas" role="img" aria-label="Анимация: хаос CRM-карточек, поток STT LLM CRM и чистая воронка"></canvas>
      <div class="boris-canvas-legend">
        <span class="boris-legend-dot"><i style="background:#ef4444"></i> хаос</span>
        <span class="boris-legend-dot"><i style="background:#2563eb"></i> STT→LLM</span>
        <span class="boris-legend-dot"><i style="background:#059669"></i> воронка</span>
      </div>
    </div>
  </div>
</div>
</section>
      </div>

      <h3 id="do-crm">«До»: пустые поля, lag обновления, % заполненных обязательных полей</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Метрика «до»</th><th>Типичное значение</th><th>Источник / оговорка</th></tr></thead>
          <tbody>
            <tr><td>Полнота записей</td><td><strong>&lt;50%</strong> обязательных полей</td><td>Baseline интеграторов; Landbase: 76% — неполные</td></tr>
            <tr><td>Данные из разговоров</td><td><strong>79%</strong> не попадает в CRM</td><td>VantagePoint 2025; международная выборка</td></tr>
            <tr><td>Post-call admin</td><td><strong>15–25 мин</strong> ручного ввода</td><td>Бенчмарк Gong/Rework; не аудит РФ</td></tr>
            <tr><td>Lag обновления</td><td><strong>конец дня / никогда</strong></td><td>Аудиты CRM</td></tr>
            <tr><td>«Мусорные» данные</td><td>до <strong>90%</strong> без контекста</td><td>vc.ru 2026; экспертная оценка</td></tr>
            <tr><td>Время на CRM entry</td><td><strong>5,5 ч/нед</strong> (~275 ч/год)</td><td>RecordContext 2026</td></tr>
          </tbody>
        </table>
      </div>

      <h3 id="posle-crm">«После»: автозаполнение после звонка, актуальные задачи и резюме сделки</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Метрика «после»</th><th>Целевой ориентир</th><th>Как достигается</th></tr></thead>
          <tbody>
            <tr><td>Fill rate обязательных полей</td><td><strong>85–95%+</strong></td><td>AI fill + human-in-the-loop</td></tr>
            <tr><td>Post-call admin</td><td><strong>3–5 мин</strong> review</td><td>STT → LLM → confirm</td></tr>
            <tr><td>Lag обновления</td><td><strong>сразу после звонка</strong></td><td>Webhook телефонии</td></tr>
            <tr><td>ACW</td><td><strong>−40–70%</strong></td><td>Aircall 2026; contact center</td></tr>
            <tr><td>Manual CRM updates</td><td><strong>−75%</strong></td><td>Salesforce Agentforce; не ваш кейс</td></tr>
          </tbody>
        </table>
      </div>
      <p><strong>ROI-модель (расчётная):</strong> 10 менеджеров × 5,5 ч/нед (RecordContext) = <strong>55 ч/нед</strong> на ручной ввод. Сокращение post-call с 20 до 5 мин на 20 звонках/нед ≈ <strong>5 ч/нед на менеджера</strong> — ориентир для бюджета, не SLA.</p>

      <h3 id="metriki-sobstvennika">Метрики для собственника: время на CRM, полнота карточки, скорость ответа</h3>
      <p>На пилоте (2–4 недели) замеряют: <strong>fill rate</strong>, <strong>lag</strong>, <strong>review time</strong>, <strong>reject rate</strong> AI-полей (BitrixGPT: <strong>10–20%</strong> правок — AutoBIT24), <strong>конверсию этапов</strong>.</p>
    </div>
  </section>

  <section id="kak-ai-zapolnyaet" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>3. Как AI заполняет CRM: схема «звонок / переписка / заявка → поля CRM»</h2>

      <h3 id="stt-llm">STT и LLM: расшифровка, саммари, извлечение сущностей</h3>
      <p><strong>Схема звонок → STT → LLM → CRM:</strong></p>
      <pre>Событие (звонок / чат / заявка)
    ↓
STT (Yandex SpeechKit / Whisper / BitrixGPT)
    ↓
Транскрипт + diarization
    ↓
LLM (YandexGPT / GPT-4o / Claude) → JSON полей
    ↓
Human-in-the-loop: Confirm / Edit
    ↓
API CRM → задача менеджеру + алерт РОПу</pre>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Шаг</th><th>Действие</th><th>Инструменты</th></tr></thead>
          <tbody>
            <tr><td>1</td><td>Webhook «звонок завершён»</td><td>Mango, Sipuni, Битрикс24</td></tr>
            <tr><td>2</td><td>Аудио → текст</td><td>STT</td></tr>
            <tr><td>3</td><td>Текст → структура</td><td>LLM + confidence score</td></tr>
            <tr><td>4</td><td>Review черновика</td><td>UI CRM / задача</td></tr>
            <tr><td>5</td><td>Запись</td><td>amoCRM PATCH, Б24 REST, retailCRM API</td></tr>
            <tr><td>6</td><td>Follow-up</td><td>Задачи, смена этапа</td></tr>
          </tbody>
        </table>
      </div>
      <p>IBM Think (2026): post-call automation транскрибирует звонки, генерирует summary и обновляет customer records в CRM.</p>

      <h3 id="webhook-api">Webhook и API: запись в custom fields, задачи, примечания, смена этапа</h3>
      <ul>
        <li><strong>amoCRM:</strong> <code>custom_fields_values</code> + webhooks; паттерн: звонок → JSON → PATCH сделки.</li>
        <li><strong>Битрикс24:</strong> BitrixGPT fill пустых полей; confirm для заполненных; звонки 10 сек – 1 ч.</li>
        <li><strong>retailCRM:</strong> транскрибация + AI-теги; fill заказов — маркетплейс «AI-Ассистент загрузки».</li>
        <li><strong>Оркестрация:</strong> Make.com, n8n, Python middleware.</li>
      </ul>

      <h3 id="human-in-the-loop">Human-in-the-loop: подтверждение менеджером перед записью в CRM</h3>
      <ul>
        <li>AI — <strong>черновик</strong> с иконкой «заполнено AI».</li>
        <li>Менеджер — <strong>2–5 мин</strong> Confirm (vs 15–25 мин ручного ввода).</li>
        <li>Phased rollout: <strong>manual suggest</strong> → <strong>auto</strong> для некритичных полей после пилота.</li>
        <li>РОП: дашборд % auto-fill / confirm / reject.</li>
      </ul>
      <p>Salesforce Agentforce: <strong>1,04 млн рекомендаций/мес</strong>, <strong>−75%</strong> manual updates (13 000 sellers) — модель для поэтапного внедрения.</p>
    </div>
  </section>

  <section id="ai-amocrm" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>4. AI-заполнение amoCRM: виджеты, API и сценарии под ключ</h2>
      <p>amoCRM сильна в воронке и AI-агентах (2025–2026), но <strong>post-call fill после телефонии — зона интеграторов</strong>.</p>

      <h3 id="amocrm-vidzhety-vs-kastom">Готовые виджеты (ChatAI и аналоги) vs кастом через API / MCP</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы</th></tr></thead>
          <tbody>
            <tr><td>AI-агент amoCRM</td><td>Поля в чатах, задачи, этапы</td><td>Нет natively post-call для звонков</td></tr>
            <tr><td>Виджеты ChatAI</td><td>Быстрый старт</td><td>Ограниченная кастомизация</td></tr>
            <tr><td>Кастом STT→API</td><td>Ваши 8–10 полей, webhook</td><td>2–4 недели, интегратор</td></tr>
          </tbody>
        </table>
      </div>
      <p><strong>Под ключ:</strong> достраиваем post-call fill под вашу воронку — то, чего нет в коробке.</p>

      <h3 id="amocrm-kanaly">Звонки и мессенджеры: что попадает в карточку</h3>
      <p>Звонок → бюджет, срок, ЛПР, возражения, next step. Чаты AmoChats/Telegram → задачи. Форма сайта → структурированные поля.</p>

      <h3 id="amocrm-ogranicheniya">Ограничения amoCRM: custom fields, лимиты API, типовые ошибки</h3>
      <p>Webhook pause при &gt;100 невалидных ответов/5 мин. Ошибки: маппинг без <code>field_id</code>; 40 обязательных полей; нет записи звонков — STT не запустится.</p>
    </div>
  </section>

  <section id="ai-bitrix24" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>5. AI в Битрикс24: BitrixGPT, CoPilot и кастомные интеграции</h2>

      <h3 id="bitrixgpt">Штатный BitrixGPT / CoPilot</h3>
      <p>Расшифровка, резюме, <strong>автозаполнение пустых полей</strong>; confirm для заполненных; анализ чатов. AutoBIT24: <strong>~15 мин/звонок → ~2 мин</strong> проверки — оценка партнёра.</p>

      <h3 id="bitrix-kastom">Когда нужен кастом: нестандартные поля, несколько воронок, 1С</h3>
      <p>Несколько воронок, 1С, правила РОПа («нет ЛПР» → эскалация) — за рамками коробки.</p>

      <h3 id="bitrix-telefoniya">Телефония Битрикс24 и post-call documentation</h3>
      <p>Встроенная телефония + BitrixGPT — быстрый путь без внешнего STT. Внешняя телефония — webhook + middleware.</p>

      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Решение</th><th>Фокус</th><th>РФ</th></tr></thead>
          <tbody>
            <tr><td>Gong AI Extractor</td><td>MEDDIC → Salesforce</td><td>SaaS</td></tr>
            <tr><td>Salesforce Agentforce</td><td>Pipeline agent</td><td>Enterprise</td></tr>
            <tr><td>BitrixGPT</td><td>Post-call «из коробки»</td><td>✅</td></tr>
            <tr><td>Nero Network</td><td>3 CRM, 152-ФЗ, HITL</td><td>✅ Под ключ</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section id="ai-retailcrm" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>6. AI для retailCRM: карточки клиентов, заявки и омниканал</h2>

      <h3 id="retailcrm-zayavki">Заявки с сайта и маркетплейсов → структурированные поля</h3>
      <p>«AI-Ассистент загрузки заказов»: текст чата/письма → поля заказа.</p>

      <h3 id="retailcrm-perepiski">Переписки и повторные касания в единой карточке</h3>
      <p>«Расшифровка и автотегирование»: звонки, AI-теги, оценка менеджеров.</p>

      <h3 id="retailcrm-kontur">retailCRM + AI: типовой контур</h3>
      <p>Звонок/чат → STT → LLM (товар, адрес, оплата) → fill клиента + заказа → confirm оператором → склад.</p>
    </div>
  </section>

  <section id="chto-avtomatizirovat" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>7. Задачи, резюме сделки и поля: что автоматизировать первым</h2>

      <h3 id="rezume-sdelki">Резюме переговоров и договорённости</h3>
      <p>AI резюме — рабочий блок: что обсудили, возражения, next step с датой. Gong community: reps перестали оставлять MEDDIC blank — community-отзыв, не аудит.</p>

      <h3 id="avtozadachi">Автозадачи менеджеру и РОПу</h3>
      <p>«Отправить КП до 12.06» — менеджеру. «Нет ЛПР» — РОПу. Дедлайн повышает adoption review.</p>

      <h3 id="prioritet-poley">Приоритет полей: 8–10 обязательных vs «мусорные»</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Категория</th><th>Поля</th><th>Кто</th></tr></thead>
          <tbody>
            <tr><td>Критичные</td><td>Бюджет, срок, ЛПР, next step</td><td>AI → confirm</td></tr>
            <tr><td>Важные</td><td>Возражения, конкурент</td><td>AI suggest</td></tr>
            <tr><td>Только человек</td><td>Скидка, юр. условия, PII</td><td>Менеджер</td></tr>
          </tbody>
        </table>
      </div>
      <p>RecordContext: <strong>91% CRM data decays/год</strong> — auto-fill не заменяет чистку.</p>

      <aside class="nero-ai-card nero-ai-reveal nero-ai-inline-cta" aria-label="Проверить качество CRM">
        <p class="nero-ai-eyebrow">Аудит 30–50 карточек</p>
        <h3>Проверить качество CRM — до пилота</h3>
        <p>Fill rate, lag, карта автоматизации, коробка vs кастом и ориентир сметы 180–500 тыс. ₽ — без обязательств. Начните с одной воронки и 8–10 полей.</p>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo nero_ai_external_link_attrs($primary_cta_url); ?>>Проверить качество CRM</a>
        </div>
      </aside>
    </div>
  </section>

  <section id="vnedrenie-pod-klyuch" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>8. Внедрение AI-заполнения CRM под ключ: этапы, сроки, бюджет</h2>

      <div id="diagnostika-crm" class="nero-ai-card nero-ai-reveal" style="margin-bottom:28px;padding:clamp(22px,3vw,32px);">
        <p class="nero-ai-eyebrow">Лид-магнит</p>
        <h3>Диагностика хаоса в CRM</h3>
        <p><strong>«Диагностика хаоса в CRM»:</strong> fill rate, lag, карта каналов, чек записи звонков и field_id. Аудит 30–50 карточек, fill rate, lag, карта автоматизации, коробка vs кастом, ориентир сметы.</p>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo nero_ai_external_link_attrs($primary_cta_url); ?>>Диагностика хаоса в CRM</a>
        </div>
      </div>

      <h3 id="pilot">Пилот: 2–4 недели</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Этап</th><th>Срок</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>Аудит</td><td>1–2 дня</td><td>Baseline</td></tr>
            <tr><td>Дизайн 8–10 полей</td><td>3–5 дней</td><td>AI vs человек</td></tr>
            <tr><td>Интеграция</td><td>2–4 нед</td><td>STT→LLM→API</td></tr>
            <tr><td>Пилот</td><td>2 нед</td><td>До/после</td></tr>
            <tr><td>Rollout</td><td>1 нед</td><td>Обучение</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-secondary-cta nero-ai-reveal">На этапе rollout менеджеры должны уверенно подтверждать AI-черновики за 2–5 минут — для этого полезно пройти <a class="nero-ai-text-link" href="<?php echo esc_url($secondary_cta_url); ?>"<?php echo nero_ai_external_link_attrs($secondary_cta_url); ?>><?php echo esc_html($secondary_cta_label); ?></a> по работе с CRM и human-in-the-loop до запуска пилота.</p>

      <h3 id="byudzhet">Бюджет: 180–500 тыс. ₽</h3>
      <p><strong>180–500 тыс. ₽</strong> — проект под ключ (AI + CRM + пилот), <strong>без лицензий</strong>. Зависит от воронок, каналов, 152-ФЗ (on-prem/YandexGPT).</p>

      <h3 id="cta-proverit-kachestvo">CTA «Проверить качество CRM»</h3>
      <p>Аудит 30–50 карточек, fill rate, lag, карта автоматизации, коробка vs кастом, ориентир сметы.</p>
    </div>
  </section>

  <section id="riski-152fz" class="nero-ai-section nero-ai-section-alt">
    <div class="nero-ai-container nero-ai-prose nero-ai-reveal">
      <h2>9. Риски, 152-ФЗ и качество данных</h2>
      <p>Gartner (2026): ROI AI в service <strong>не гарантирован</strong> — AI fill CRM требует дисциплины, не «включил и забыл».</p>

      <h3 id="pii-hranenie">PII, согласия, локальные модели</h3>
      <p><strong>152-ФЗ:</strong> согласие на запись; DPA с STT/LLM; каскадное удаление; <strong>YandexGPT/on-prem</strong> для PII; маскирование в промптах. AEPD Spain (2026): пассивная reliance на AI недостаточна — нужен регламент.</p>

      <h3 id="oshibki-stt-llm">Ошибки STT/LLM</h3>
      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Риск</th><th>Митигация</th></tr></thead>
          <tbody>
            <tr><td>STT: имена, цифры</td><td>Review в UI</td></tr>
            <tr><td>LLM галлюцинации</td><td>Confirm; confidence score</td></tr>
            <tr><td>BitrixGPT 10–20% правок</td><td>Аудит РОПом</td></tr>
            <tr><td>Data decay 91%/год</td><td>Периодическая чистка</td></tr>
          </tbody>
        </table>
      </div>

      <h3 id="reglament-robot-chelovek">Регламент: робот vs человек</h3>
      <p><strong>AI (с confirm):</strong> бюджет, срок, ЛПР, возражения, резюме, задачи. <strong>Только человек:</strong> цена, юр. условия, PII, крупные сделки на старте.</p>

      <div class="nero-ai-table-wrap">
        <table class="nero-ai-table">
          <thead><tr><th>Критерий</th><th>Коробка</th><th>DIY Make+GPT</th><th>Под ключ</th></tr></thead>
          <tbody>
            <tr><td>Post-call amoCRM</td><td>⚠️</td><td>⚠️</td><td>✅</td></tr>
            <tr><td>152-ФЗ</td><td>⚠️</td><td>❌</td><td>✅</td></tr>
            <tr><td>retailCRM</td><td>❌</td><td>⚠️</td><td>✅</td></tr>
            <tr><td>Диагностика «до»</td><td>❌</td><td>❌</td><td>✅</td></tr>
            <tr><td>Бюджет</td><td>Лицензии</td><td>Время</td><td><strong>180–500K ₽</strong></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section id="faq" class="nero-ai-section">
    <div class="nero-ai-container nero-ai-reveal">
      <div class="nero-ai-section-head">
        <p class="nero-ai-eyebrow">FAQ</p>
        <h2>10. FAQ: AI-заполнение CRM</h2>
      </div>
      <div class="nero-ai-faq nero-ai-prose">
        <details class="nero-ai-reveal" id="faq-pochemu"><summary>Почему менеджеры не заполняют CRM?</summary><p>Рутина, двойная работа, перегруженность полями. AI снимает ввод после контакта — менеджер проверяет черновик за минуты.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1" id="faq-posle-zvonka"><summary>Можно ли автоматически заполнять CRM после звонка?</summary><p>Да: телефония → STT → LLM → API. Human-in-the-loop на старте. BitrixGPT — из коробки; amoCRM/retailCRM — интеграция.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-2" id="faq-chto-takoe"><summary>Что такое AI-заполнение CRM?</summary><p>Структурирование звонков, чатов, заявок в поля CRM. AI извлекает бюджет, срок, ЛПР, next step; создаёт резюме и задачи.</p></details>
        <details class="nero-ai-reveal" id="faq-tri-crm"><summary>Работает ли AI с amoCRM, Битрикс24 и retailCRM?</summary><p>Да. Б24 — BitrixGPT. amoCRM — AI-агент + кастом post-call через REST. retailCRM — транскрибация, fill заказов.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1" id="faq-bitrixgpt-vs-kastom"><summary>Чем BitrixGPT отличается от кастомного AI?</summary><p>Коробка — быстро, только Б24. Кастом — amoCRM, retailCRM, 1С, 152-ФЗ, правила РОПа.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-2" id="faq-stoimost"><summary>Сколько стоит внедрение?</summary><p><strong>180–500 тыс. ₽</strong> проект под ключ, без лицензий CRM. Точная смета — после диагностики.</p></details>
        <details class="nero-ai-reveal" id="faq-metriki"><summary>Как измерить результат до и после?</summary><p>Fill rate, lag, время на CRM/нед, reject rate, конверсия этапов. Пилот 2–4 недели.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-1" id="faq-programmist"><summary>Нужен ли программист?</summary><p>BitrixGPT/amo AI-агент — без разработки. Кастом post-call, 152-ФЗ, retailCRM — с интегратором.</p></details>
        <details class="nero-ai-reveal nero-ai-delay-2" id="faq-152fz"><summary>Законно ли записывать звонки и отдавать в AI?</summary><p>При 152-ФЗ: согласие, регламент, DPA, маскирование PII. YandexGPT/on-prem для чувствительных данных.</p></details>
        <details class="nero-ai-reveal" id="faq-oshibka-ai"><summary>Что если AI ошибётся?</summary><p>Human-in-the-loop, иконки AI-полей, аудит РОПом. BitrixGPT: 10–20% правок. Старт — suggest-only.</p></details>
      </div>

      <section class="nero-ai-final-cta nero-ai-card nero-ai-reveal" aria-labelledby="final-cta-crm-title">
        <h2 id="final-cta-crm-title">AI-заполнение CRM под ключ — начните с диагностики</h2>
        <p>Nero Network внедряет post-call fill в amoCRM, Битрикс24 и retailCRM: STT → LLM → confirm → API, с учётом 152-ФЗ. Пилот на одной воронке — 2–4 недели; точная смета после «Диагностики хаоса в CRM».</p>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo nero_ai_external_link_attrs($primary_cta_url); ?>>Диагностика хаоса в CRM</a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>"<?php echo nero_ai_external_link_attrs($secondary_cta_url); ?>><?php echo esc_html($secondary_cta_label); ?></a>
        </div>
      </section>

      <div class="nero-ai-summary nero-ai-reveal">
        <p><strong>Итог:</strong> AI-заполнение CRM под ключ — <strong>гигиена данных</strong>: звонок → STT → LLM → confirm → amoCRM / Битрикс24 / retailCRM. Начните с <strong>«Диагностики хаоса в CRM»</strong> или <strong>«Проверить качество CRM»</strong> — пилот на одной воронке за 2–4 недели.</p>
      </div>
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

<script id="crm-hygiene-flow-engine">
(function () {
  "use strict";
  var canvas = document.getElementById("crm-hygiene-flow-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var dpr = Math.min(window.devicePixelRatio || 1, 2);
  var cw = 0, ch = 0, frame = 0;

  var C = {
    outline: "#0f172a",
    muted: "#94a3b8",
    danger: "#ef4444",
    dangerSoft: "#fecaca",
    warn: "#f59e0b",
    blue: "#2563eb",
    blueSoft: "#dbeafe",
    violet: "#7c3aed",
    green: "#059669",
    greenSoft: "#a7f3d0",
    white: "#ffffff",
    cardBg: "#f1f5f9",
    empty: "#e2e8f0"
  };

  function resize() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    cw = wrap.clientWidth;
    ch = wrap.clientHeight;
    canvas.width = Math.floor(cw * dpr);
    canvas.height = Math.floor(ch * dpr);
    canvas.style.width = cw + "px";
    canvas.style.height = ch + "px";
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }
  window.addEventListener("resize", resize);
  resize();

  function rr(x, y, w, h, r, fill, stroke, lw) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else { ctx.moveTo(x + r, y); ctx.arcTo(x + w, y, x + w, y + h, r); ctx.arcTo(x + w, y + h, x, y + h, r); ctx.arcTo(x, y + h, x, y, r); ctx.arcTo(x, y, x + w, y, r); ctx.closePath(); }
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.lineWidth = lw || 1.5; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  function text(str, x, y, size, color, align, weight) {
    ctx.font = (weight || 600) + " " + size + "px Inter, system-ui, sans-serif";
    ctx.fillStyle = color || C.outline;
    ctx.textAlign = align || "left";
    ctx.textBaseline = "middle";
    ctx.fillText(str, x, y);
  }

  /* Chaos CRM cards — scattered, empty fields */
  var chaosCards = [
    { x: 0.06, y: 0.18, rot: -0.12, fields: 2 },
    { x: 0.04, y: 0.52, rot: 0.08, fields: 1 },
    { x: 0.14, y: 0.72, rot: -0.05, fields: 0 },
    { x: 0.18, y: 0.35, rot: 0.15, fields: 1 }
  ];

  function drawChaosCard(card, t) {
    var px = card.x * cw + Math.sin(t * 0.02 + card.y * 10) * 4;
    var py = card.y * ch + Math.cos(t * 0.018 + card.x * 8) * 3;
    var w = Math.min(72, cw * 0.16);
    var h = w * 0.72;
    ctx.save();
    ctx.translate(px + w / 2, py + h / 2);
    ctx.rotate(card.rot + Math.sin(t * 0.015) * 0.04);
    rr(-w / 2, -h / 2, w, h, 6, C.white, C.danger, 1.2);
    rr(-w / 2 + 6, -h / 2 + 8, w - 12, 8, 3, C.dangerSoft, null);
    for (var i = 0; i < 3; i++) {
      var filled = i < card.fields;
      rr(-w / 2 + 8, -h / 2 + 22 + i * 12, w - 16, 7, 2, filled ? "#cbd5e1" : C.empty, null);
    }
    if (card.fields < 2) {
      text("?", px + w / 2 - card.x * cw, py + h / 2 - card.y * ch + 8, 11, C.danger, "center", 700);
    }
    ctx.restore();
  }

  /* Pipeline nodes STT → LLM → CRM */
  var pipelineNodes = [
    { id: "stt", label: "STT", sub: "расшифровка", color: C.blue },
    { id: "llm", label: "LLM", sub: "поля JSON", color: C.violet },
    { id: "crm", label: "CRM", sub: "API", color: C.green }
  ];

  function pipelineLayout() {
    var cx0 = cw * 0.42;
    var cy0 = ch * 0.5;
    var gap = Math.min(68, cw * 0.11);
    var startX = cx0 - gap;
    return pipelineNodes.map(function (n, i) {
      return { node: n, x: startX + i * gap, y: cy0, r: Math.min(26, cw * 0.055) };
    });
  }

  function drawPipeline(nodes, t) {
    for (var i = 0; i < nodes.length - 1; i++) {
      var a = nodes[i], b = nodes[i + 1];
      ctx.strokeStyle = C.muted;
      ctx.lineWidth = 1.5;
      ctx.setLineDash([4, 4]);
      ctx.beginPath();
      ctx.moveTo(a.x + a.r, a.y);
      ctx.lineTo(b.x - b.r, b.y);
      ctx.stroke();
      ctx.setLineDash([]);
      var prog = ((t * 0.025 + i * 0.33) % 1);
      var dotX = a.x + a.r + (b.x - b.r - a.x - a.r) * prog;
      ctx.fillStyle = C.blue;
      ctx.beginPath();
      ctx.arc(dotX, a.y, 3, 0, Math.PI * 2);
      ctx.fill();
    }
    nodes.forEach(function (p, idx) {
      var pulse = 1 + Math.sin(t * 0.06 + idx) * 0.06;
      ctx.fillStyle = p.node.color;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r * pulse, 0, Math.PI * 2);
      ctx.fill();
      rr(p.x - p.r - 2, p.y - p.r - 2, (p.r + 2) * 2, (p.r + 2) * 2, p.r + 2, null, "rgba(255,255,255,0.5)", 2);
      text(p.node.label, p.x, p.y - 4, Math.min(11, cw * 0.028), C.white, "center", 700);
      text(p.node.sub, p.x, p.y + 10, Math.min(8, cw * 0.022), "rgba(255,255,255,0.85)", "center", 500);
    });
  }

  /* Data packets: call icon → pipeline → funnel */
  var packets = [];
  function spawnPacket(t) {
    if (t % 90 !== 0) return;
    packets.push({ phase: 0, x: cw * 0.08, y: ch * 0.45, progress: 0, life: 0 });
  }

  function updatePackets(nodes, t) {
    spawnPacket(t);
    packets = packets.filter(function (p) { return p.life < 220; });
    packets.forEach(function (p) {
      p.life++;
      p.progress += 0.012;
      if (p.progress < 0.25) {
        p.phase = 0;
        p.x = cw * 0.08 + (nodes[0].x - nodes[0].r - cw * 0.08) * (p.progress / 0.25);
        p.y = ch * 0.45 + Math.sin(p.life * 0.1) * 3;
      } else if (p.progress < 0.65) {
        p.phase = 1;
        var seg = (p.progress - 0.25) / 0.4;
        var idx = Math.min(2, Math.floor(seg * 3));
        var local = (seg * 3) % 1;
        var from = nodes[Math.min(idx, 2)];
        var to = nodes[Math.min(idx + 1, 2)];
        if (to) {
          p.x = from.x + (to.x - from.x) * local;
          p.y = from.y + Math.sin(p.life * 0.12) * 4;
        } else {
          p.x = from.x;
          p.y = from.y;
        }
      } else {
        p.phase = 2;
        var seg2 = (p.progress - 0.65) / 0.35;
        p.x = nodes[2].x + nodes[2].r + (cw * 0.88 - nodes[2].x) * seg2;
        p.y = ch * 0.35 + seg2 * ch * 0.35 + Math.sin(p.life * 0.08) * 2;
      }
    });
  }

  function drawPackets() {
    packets.forEach(function (p) {
      var col = p.phase === 0 ? C.warn : (p.phase === 1 ? C.blue : C.green);
      rr(p.x - 7, p.y - 5, 14, 10, 3, col, C.outline, 1);
      if (p.phase === 0) {
        ctx.fillStyle = C.white;
        ctx.beginPath();
        ctx.arc(p.x, p.y, 2, 0, Math.PI * 2);
        ctx.fill();
      }
    });
  }

  /* Clean funnel — right side */
  var funnelStages = ["Лид", "Квалиф.", "КП", "Сделка"];

  function drawFunnel(t) {
    var fx = cw * 0.72;
    var fy = ch * 0.22;
    var fw = Math.min(100, cw * 0.22);
    text("Воронка", fx + fw / 2, fy - 14, Math.min(10, cw * 0.026), C.green, "center", 700);
    funnelStages.forEach(function (label, i) {
      var stageW = fw - i * (fw / funnelStages.length) * 0.55;
      var stageH = Math.min(28, ch * 0.07);
      var sy = fy + i * (stageH + 6);
      var sx = fx + (fw - stageW) / 2;
      var fillAmt = Math.min(1, ((t * 0.008 + i * 0.2) % 1.2));
      rr(sx, sy, stageW, stageH, 6, C.white, C.green, 1.2);
      rr(sx + 4, sy + 4, (stageW - 8) * fillAmt, stageH - 8, 4, C.greenSoft, null);
      text(label, sx + stageW / 2, sy + stageH / 2, Math.min(9, cw * 0.024), C.outline, "center", 600);
    });
    /* filled card */
    var cardX = fx + 4;
    var cardY = fy + funnelStages.length * 34 + 16;
    var cardW = fw - 8;
    var cardH = Math.min(56, ch * 0.14);
    rr(cardX, cardY, cardW, cardH, 8, C.white, C.green, 1.5);
    rr(cardX + 8, cardY + 10, cardW - 16, 8, 3, C.greenSoft, null);
    for (var j = 0; j < 3; j++) {
      rr(cardX + 8, cardY + 24 + j * 10, cardW - 16, 6, 2, "#86efac", null);
    }
    text("✓ AI fill", cardX + cardW / 2, cardY + cardH - 10, Math.min(8, cw * 0.022), C.green, "center", 700);
  }

  function drawZoneLabels() {
    text("Хаос", cw * 0.1, 18, Math.min(10, cw * 0.026), C.danger, "center", 700);
    text("STT → LLM → CRM", cw * 0.48, 18, Math.min(10, cw * 0.026), C.blue, "center", 700);
    text("Чистая воронка", cw * 0.82, 18, Math.min(10, cw * 0.026), C.green, "center", 700);
  }

  function drawCallSource(t) {
    var sx = cw * 0.06;
    var sy = ch * 0.38;
    rr(sx, sy, 36, 36, 10, C.blueSoft, C.blue, 1.2);
    ctx.strokeStyle = C.blue;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(sx + 18, sy + 16, 6, 0, Math.PI * 2);
    ctx.moveTo(sx + 18, sy + 22);
    ctx.lineTo(sx + 18, sy + 28);
    ctx.stroke();
    text("Звонок", sx + 18, sy + 48, Math.min(8, cw * 0.022), C.muted, "center", 500);
    var wave = Math.sin(t * 0.08) * 3;
    ctx.strokeStyle = "rgba(37,99,235,0.35)";
    ctx.lineWidth = 1;
    for (var w = 0; w < 3; w++) {
      ctx.beginPath();
      ctx.arc(sx + 18, sy + 16, 10 + w * 5 + wave, -0.4, 0.4);
      ctx.stroke();
    }
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    rr(0, 0, cw, ch, 0, "#fafbfc", null);

    /* zone dividers */
    ctx.strokeStyle = "rgba(148,163,184,0.2)";
    ctx.lineWidth = 1;
    ctx.setLineDash([6, 8]);
    ctx.beginPath();
    ctx.moveTo(cw * 0.28, 28);
    ctx.lineTo(cw * 0.28, ch - 20);
    ctx.moveTo(cw * 0.62, 28);
    ctx.lineTo(cw * 0.62, ch - 20);
    ctx.stroke();
    ctx.setLineDash([]);

    drawZoneLabels();
    drawCallSource(frame);
    chaosCards.forEach(function (c) { drawChaosCard(c, frame); });

    var nodes = pipelineLayout();
    drawPipeline(nodes, frame);
    updatePackets(nodes, frame);
    drawPackets();
    drawFunnel(frame);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Почему менеджеры не заполняют CRM?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Рутина, двойная работа, перегруженность полями. AI снимает ввод после контакта — менеджер проверяет черновик за минуты."
      }
    },
    {
      "@type": "Question",
      "name": "Можно ли автоматически заполнять CRM после звонка?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Да: телефония → STT → LLM → API. Human-in-the-loop на старте. BitrixGPT — из коробки; amoCRM/retailCRM — интеграция."
      }
    },
    {
      "@type": "Question",
      "name": "Что такое AI-заполнение CRM?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Структурирование звонков, чатов, заявок в поля CRM. AI извлекает бюджет, срок, ЛПР, next step; создаёт резюме и задачи."
      }
    },
    {
      "@type": "Question",
      "name": "Работает ли AI с amoCRM, Битрикс24 и retailCRM?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Да. Б24 — BitrixGPT. amoCRM — AI-агент + кастом post-call через REST. retailCRM — транскрибация, fill заказов."
      }
    },
    {
      "@type": "Question",
      "name": "Чем BitrixGPT отличается от кастомного AI?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Коробка — быстро, только Б24. Кастом — amoCRM, retailCRM, 1С, 152-ФЗ, правила РОПа."
      }
    },
    {
      "@type": "Question",
      "name": "Сколько стоит внедрение?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "180–500 тыс. ₽ проект под ключ, без лицензий CRM. Точная смета — после диагностики."
      }
    },
    {
      "@type": "Question",
      "name": "Как измерить результат до и после?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Fill rate, lag, время на CRM/нед, reject rate, конверсия этапов. Пилот 2–4 недели."
      }
    },
    {
      "@type": "Question",
      "name": "Нужен ли программист?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "BitrixGPT/amo AI-агент — без разработки. Кастом post-call, 152-ФЗ, retailCRM — с интегратором."
      }
    },
    {
      "@type": "Question",
      "name": "Законно ли записывать звонки и отдавать в AI?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "При 152-ФЗ: согласие, регламент, DPA, маскирование PII. YandexGPT/on-prem для чувствительных данных."
      }
    },
    {
      "@type": "Question",
      "name": "Что если AI ошибётся?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Human-in-the-loop, иконки AI-полей, аудит РОПом. BitrixGPT: 10–20% правок. Старт — suggest-only."
      }
    }
  ]
}
</script>

<?php
get_footer();

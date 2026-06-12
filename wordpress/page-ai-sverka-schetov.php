<?php
/**
 * Template Name: AI-сверка счетов, оплат и закрывающих: внедрение под ключ
 * Description: AI-сверка счетов и оплат под ключ — нейросеть находит расхождения до закрытия месяца. Интеграция с 1С, CRM, банком. Тестовая сверка 20 документов.
 */

$page_seo_title       = 'AI-сверка счетов, оплат и закрывающих: внедрение под ключ';
$page_seo_description = 'AI-сверка счетов и оплат под ключ: нейросеть находит расхождения до закрытия месяца. Интеграция с 1С, CRM, банком. Тестовая сверка 20 документов.';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
	$parts['title'] = $page_seo_title;
	return $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description ): void {
	echo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";
	echo '<meta property="og:type" content="article" />' . "\n";
}, 1 );

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Проблема',    'href' => '#problema'],
    ['label' => 'Сценарии',    'href' => '#kak-rabotaet'],
    ['label' => 'Интеграции',  'href' => '#integracii'],
    ['label' => 'ROI',         'href' => '#roi'],
    ['label' => 'Внедрение',   'href' => '#etapy'],
    ['label' => 'Стоимость',   'href' => '#ceny'],
    ['label' => 'FAQ',         'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить документы';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}

?>

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

<style>
/* Скрыть шапку Kadence */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-sverka-schetov-page" role="main" tabindex="-1">

<section class="nero-ai-hero svsc-hero-sverka" id="svsc-hero" aria-labelledby="svsc-hero-title">
<style>
/* ── Hero ai-sverka-schetov: самодостаточные стили (без CSS темы) ── */
.svsc-hero-sverka {
  --svsc-gold: #f5c518;
  --svsc-cyan: #79f2ff;
  --svsc-green: #22c55e;
  --svsc-amber: #f59e0b;
  --svsc-red: #ef4444;
  --svsc-text: #e6edf7;
  --svsc-muted: #9aa8bd;
  --svsc-soft: #c7d2e5;
  --svsc-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: linear-gradient(180deg, #050711 0%, #080b17 48%, #050711 100%);
}
.svsc-hero-sverka::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 32%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: 0;
}
.svsc-hero-sverka::after {
  content: "";
  position: absolute;
  left: 6%;
  top: 18%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .09), transparent 66%);
  filter: blur(10px);
  animation: svscHeroCyanGlow 11s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes svscHeroCyanGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.svsc-hero-sverka .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.svsc-hero-sverka .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.svsc-hero-sverka .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.svsc-hero-sverka .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--svsc-gold) 42%, #fde68a 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.svsc-hero-sverka .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 197, 24, 0.22);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--svsc-gold) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.svsc-hero-sverka .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--svsc-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.svsc-hero-sverka .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.svsc-hero-sverka .nero-ai-badge {
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
}
.svsc-hero-sverka .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.svsc-hero-sverka .nero-ai-btn {
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
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.svsc-hero-sverka .nero-ai-btn:hover { transform: translateY(-2px); }
.svsc-hero-sverka .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--svsc-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.svsc-hero-sverka .nero-ai-btn-secondary {
  color: var(--svsc-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.svsc-hero-sverka .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--svsc-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.svsc-hero-sverka .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.svsc-hero-sverka .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.svsc-hero-sverka .nero-ai-dots { display: flex; gap: 7px; }
.svsc-hero-sverka .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.svsc-hero-sverka .nero-ai-dot:nth-child(1) { background: #fb7185; }
.svsc-hero-sverka .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.svsc-hero-sverka .nero-ai-dot:nth-child(3) { background: #34d399; }
.svsc-hero-sverka .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.svsc-hero-sverka .nero-ai-window-body { padding: 16px; }
.svsc-hero-sverka .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.svsc-hero-sverka .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.svsc-hero-sverka .nero-ai-live-pill {
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
.svsc-hero-sverka .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: svscPulse 1.6s infinite;
}
@keyframes svscPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.svsc-hero-sverka .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.svsc-hero-sverka .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.svsc-hero-sverka .nero-ai-metric span {
  display: block;
  color: var(--svsc-muted);
  font-size: 11px;
  font-weight: 700;
}
.svsc-hero-sverka .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.svsc-hero-sverka .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.svsc-hero-sverka .svsc-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: radial-gradient(ellipse at 50% 42%, rgba(121,242,255,.08), rgba(6,10,24,.94) 74%);
}
.svsc-hero-sverka #ai-sverka-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.svsc-hero-sverka .nero-ai-task-stream { display: grid; gap: 8px; }
.svsc-hero-sverka .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.svsc-hero-sverka .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(245,197,24,.12);
  color: var(--svsc-gold);
  font-size: 11px;
  font-weight: 800;
}
.svsc-hero-sverka .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.svsc-hero-sverka .nero-ai-task span {
  color: var(--svsc-muted);
  font-size: 11px;
}
.svsc-hero-sverka .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.svsc-hero-sverka .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.svsc-hero-sverka .nero-ai-status--red {
  background: rgba(239,68,68,.14);
  color: #fecaca;
}
@media (max-width: 1100px) {
  .svsc-hero-sverka .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .svsc-hero-sverka .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .svsc-hero-sverka .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .svsc-hero-sverka .nero-ai-window-body { padding: 12px; }
  .svsc-hero-sverka .nero-ai-task { grid-template-columns: 28px 1fr; }
  .svsc-hero-sverka .nero-ai-status { grid-column: 2; width: fit-content; }
}

/* ── Intro + TOC (второй экран, префикс svsc-) ── */
.svsc-first-screen {
  --svsc-bg: #050711;
  --svsc-gold: #f5c518;
  --svsc-cyan: #79f2ff;
  --svsc-muted: #9aa8bd;
  --svsc-soft: #c7d2e5;
  --svsc-heading: #fff;
  background: linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
  color: var(--svsc-soft);
  font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}
.svsc-first-screen .svsc-cnt {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
}
.svsc-intro {
  padding: clamp(40px, 5vw, 72px) 0 clamp(40px, 5vw, 64px);
  background: linear-gradient(180deg, rgba(255,255,255,.03), transparent);
  border-bottom: 1px solid rgba(255,255,255,.06);
}
.svsc-intro-grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 56px;
  align-items: center;
}
.svsc-intro-text {
  position: relative;
  padding-left: 20px;
}
.svsc-intro-text::before {
  content: '';
  position: absolute;
  left: 0;
  top: 4px;
  bottom: 4px;
  width: 3px;
  border-radius: 2px;
  background: linear-gradient(180deg, var(--svsc-gold), #7c3aed);
}
.svsc-intro-text p {
  text-align: left;
  font-size: clamp(14.5px, 1.55vw, 16.5px);
  line-height: 1.8;
  color: var(--svsc-muted);
  margin: 0 0 1em;
}
.svsc-intro-text p:last-child {
  margin-bottom: 0;
  color: var(--svsc-soft);
}
.svsc-intro-text strong { color: var(--svsc-soft); }
.svsc-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  border-radius: 999px;
  background: rgba(245,197,24,.08);
  border: 1px solid rgba(245,197,24,.22);
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--svsc-gold);
  margin-bottom: 14px;
}
.svsc-intro-kpi {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}
.svsc-kpi-card {
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 14px;
  padding: 16px 14px;
  text-align: center;
  box-shadow: 0 8px 28px rgba(0,0,0,.25);
  backdrop-filter: blur(12px);
}
.svsc-kpi-card .kv {
  font-size: clamp(20px, 2.5vw, 26px);
  font-weight: 900;
  color: var(--svsc-heading);
  letter-spacing: -.04em;
  line-height: 1;
  margin-bottom: 5px;
}
.svsc-kpi-card .kl {
  font-size: 11px;
  font-weight: 600;
  color: var(--svsc-muted);
  line-height: 1.4;
}
.svsc-kpi-card .ks {
  font-size: 10px;
  color: #64748b;
  margin-top: 4px;
}
.svsc-toc-outer {
  padding: 0 0 clamp(36px, 4.5vw, 56px);
}
.svsc-toc {
  display: flex;
  flex-wrap: wrap;
  gap: 9px;
  justify-content: center;
}
.svsc-toc a {
  display: inline-block;
  padding: 9px 18px;
  background: rgba(255,255,255,.072);
  border: 1px solid rgba(255,255,255,.10);
  border-radius: 999px;
  font-size: 13px;
  font-weight: 600;
  color: var(--svsc-muted);
  text-decoration: none;
  transition: border-color .2s, color .2s, background .2s;
}
.svsc-toc a:hover {
  border-color: rgba(245,197,24,.42);
  color: var(--svsc-gold);
  background: rgba(245,197,24,.08);
}
@media (max-width: 900px) {
  .svsc-intro-grid { grid-template-columns: 1fr; gap: 36px; }
  .svsc-intro-kpi { grid-template-columns: repeat(4, 1fr); }
}
@media (max-width: 600px) {
  .svsc-intro-kpi { grid-template-columns: 1fr 1fr; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Финансы / бухгалтерия · ai сверка счетов</p>
      <h1 id="svsc-hero-title">AI-сверка счетов, оплат и закрывающих документов: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть сверяет счета, платежи и закрывающие документы — подсвечивает расхождения до закрытия месяца, без ручного перебора Excel</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы сверки">
        <li class="nero-ai-badge">Счёт ↔ оплата</li>
        <li class="nero-ai-badge">УПД и акты</li>
        <li class="nero-ai-badge">1С / CRM / банк</li>
        <li class="nero-ai-badge">До month-end</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#roi">Рассчитать ROI</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-сверки счетов, оплат и закрывающих">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-сверки · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Сверка до закрытия месяца</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Документов в очереди</span>
              <strong>47</strong>
              <small>счета, выписки, УПД</small>
            </div>
            <div class="nero-ai-metric">
              <span>Расхождений</span>
              <strong>6</strong>
              <small>до закрытия периода</small>
            </div>
            <div class="nero-ai-metric">
              <span>До закрытия</span>
              <strong>4 дня</strong>
              <small>month-end контроль</small>
            </div>
            <div class="nero-ai-metric">
              <span>Сверено</span>
              <strong>89%</strong>
              <small>связок без ручного Excel</small>
            </div>
          </div>

          <div class="svsc-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ai-sverka-hero-canvas" role="img" aria-label="Анимация: пакеты данных по дугам связывают счёт, оплату, УПД и статус CRM — хаб подсвечивает расхождения до закрытия месяца"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента задач сверки">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">СЧ</span>
              <div><strong>Счёт №412 — оплаты нет</strong><span>47 200 ₽ · просрочка 3 дня</span></div>
              <span class="nero-ai-status nero-ai-status--red">критично</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">₽</span>
              <div><strong>Оплата без УПД</strong><span>ИНН 7707… · назначение не сходится</span></div>
              <span class="nero-ai-status nero-ai-status--amber">расхождение</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>«Оплачено» ≠ банк</strong><span>Сделка #884 · amoCRM vs выписка</span></div>
              <span class="nero-ai-status nero-ai-status--amber">проверить</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Пакет 128 док.</strong><span>счёт ↔ оплата ↔ УПД сошлись</span></div>
              <span class="nero-ai-status">ok</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="svsc-first-screen" id="svsc-first-screen">
  <section class="svsc-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="svsc-cnt">
      <div class="svsc-intro-grid nero-ai-reveal">
        <div class="svsc-intro-text">
          <p class="svsc-eyebrow">Лонгрид · ai сверка счетов</p>
          <p><strong>Коротко:</strong> AI-сверка счетов — это сквозной контроль цепочки «счёт → оплата → УПД/акт → статус в 1С или CRM», а не разовое распознавание PDF. Нейросеть для бухгалтерии собирает данные из учёта, банка, ЭДО и почты, сопоставляет документы и подсвечивает расхождения до закрытия месяца — пока исправить дешевле, чем на проверке или при сдаче НДС.</p>
          <p>Nero Network внедряет <strong>ai сверка счетов под ключ</strong> для компаний, где сверка счетов и оплат ещё не автоматизирована: бухгалтерия тратит часы на Excel, ошибки всплывают в конце периода. С 1 января 2026 — переход на <strong>УПД 5.03</strong>: больше структурированной первички и выше цена рассинхрона учёта и ЭДО.</p>
        </div>
        <div class="svsc-intro-kpi" aria-label="Ключевые метрики сверки">
          <div class="svsc-kpi-card"><div class="kv">65%</div><div class="kl">CFO наращивают gen AI</div><div class="ks">McKinsey 2025</div></div>
          <div class="svsc-kpi-card"><div class="kv">5.03</div><div class="kl">УПД с 01.01.2026</div><div class="ks">формализованный ЭДО</div></div>
          <div class="svsc-kpi-card"><div class="kv">4</div><div class="kl">звена цепочки</div><div class="ks">счёт · оплата · УПД · CRM</div></div>
          <div class="svsc-kpi-card"><div class="kv">20</div><div class="kl">документов на тест</div><div class="ks">лид-магнит · ~48 ч</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="svsc-toc-outer">
    <div class="svsc-cnt">
      <nav class="svsc-toc" aria-label="Оглавление статьи">
        <a href="#problema">Проблема</a>
        <a href="#kak-rabotaet">Сценарии</a>
        <a href="#integracii">Интеграции</a>
        <a href="#roi">ROI</a>
        <a href="#etapy">Внедрение</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>
</div>

<div class="svsc-content">

<style>
/* === svsc-content: блок статьи (не hero), prefix svsc- === */
.svsc-content{
  --svsc-bg:#050711;--svsc-bg2:#080b17;--svsc-bg3:#0a0e1c;
  --svsc-surface:rgba(255,255,255,.072);--svsc-surface2:rgba(255,255,255,.108);
  --svsc-text:#e6edf7;--svsc-muted:#9aa8bd;--svsc-soft:#c7d2e5;--svsc-heading:#fff;
  --svsc-border:rgba(255,255,255,.10);--svsc-border-s:rgba(255,255,255,.18);
  --svsc-accent:#f5c518;--svsc-violet:#8b5cf6;--svsc-green:#22c55e;--svsc-cyan:#79f2ff;--svsc-amber:#f59e0b;
  --svsc-btn-from:#2563eb;--svsc-btn-to:#7c3aed;
  --svsc-r:18px;--svsc-r-lg:24px;--svsc-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--svsc-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.svsc-content *,.svsc-content *::before,.svsc-content *::after{box-sizing:border-box;}
.svsc-content a{color:inherit;text-decoration:none;}
.svsc-content p{color:var(--svsc-muted);line-height:1.72;margin:0 0 1em;}
.svsc-content p:last-child{margin-bottom:0;}
.svsc-content h2,.svsc-content h3,.svsc-content h4{color:var(--svsc-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.svsc-content strong{color:var(--svsc-soft);}
.svsc-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.svsc-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--svsc-muted);font-size:14.5px;line-height:1.65;}
.svsc-content ul li::before{content:'›';position:absolute;left:0;color:var(--svsc-accent);font-weight:700;}
.svsc-cnt{width:min(var(--svsc-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.svsc-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.svsc-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.svsc-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.svsc-sh.svsc-left{margin-left:0;text-align:left;}
.svsc-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.svsc-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.svsc-sh.svsc-left p{margin-left:0;}
.svsc-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--svsc-accent);margin-bottom:14px;}
.svsc-gt{background:linear-gradient(92deg,#fff 0%,var(--svsc-accent) 44%,var(--svsc-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.svsc-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.svsc-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.svsc-intro-text{position:relative;padding-left:20px;}
.svsc-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--svsc-accent),var(--svsc-violet));}
.svsc-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--svsc-muted);margin-bottom:1em;}
.svsc-intro-text p:last-child{margin-bottom:0;color:var(--svsc-soft);}
.svsc-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.svsc-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.svsc-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--svsc-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.svsc-kpi-card .kl{font-size:11px;font-weight:600;color:var(--svsc-muted);line-height:1.4;}
.svsc-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.svsc-intro-grid{grid-template-columns:1fr;gap:36px;}.svsc-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.svsc-intro-kpi{grid-template-columns:1fr 1fr;}}
.svsc-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.svsc-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.svsc-toc a{display:inline-block;padding:9px 18px;background:var(--svsc-surface);border:1px solid var(--svsc-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--svsc-muted);transition:border-color .2s,color .2s,background .2s;}
.svsc-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--svsc-accent);background:rgba(245,197,24,.08);}
.svsc-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--svsc-border);border-radius:var(--svsc-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.svsc-card:hover{border-color:rgba(245,197,24,.28);transform:translateY(-2px);}
.svsc-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.svsc-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.svsc-grid-2,.svsc-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.svsc-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.svsc-grid-3{grid-template-columns:1fr;}}
.svsc-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--svsc-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.svsc-scenario:last-child{margin-bottom:0;}
.svsc-scenario:hover{border-color:rgba(245,197,24,.3);}
.svsc-scenario h3{font-size:17px;margin-bottom:8px;}
.svsc-scenario p{font-size:14.5px;margin:0;}
.svsc-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.svsc-table{width:100%;border-collapse:collapse;font-size:14px;}
.svsc-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--svsc-accent);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);white-space:nowrap;}
.svsc-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--svsc-text);vertical-align:top;}
.svsc-table tr:last-child td{border-bottom:none;}
.svsc-table tr:hover td{background:rgba(255,255,255,.03);}
.svsc-crit-high{color:#f87171;font-weight:700;}
.svsc-crit-med{color:var(--svsc-amber);font-weight:600;}
.svsc-crit-low{color:var(--svsc-cyan);}
.svsc-timeline{position:relative;padding-left:40px;}
.svsc-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--svsc-accent),var(--svsc-violet));opacity:.35;border-radius:2px;}
.svsc-tl-item{position:relative;margin-bottom:32px;}
.svsc-tl-item:last-child{margin-bottom:0;}
.svsc-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--svsc-accent);box-shadow:0 0 0 4px rgba(245,197,24,.2);}
.svsc-tl-item h3{font-size:17px;margin-bottom:8px;}
.svsc-tl-item p{font-size:14.5px;margin:0;}
.svsc-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.svsc-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.svsc-case-grid{grid-template-columns:1fr;}}
.svsc-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.svsc-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.svsc-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--svsc-green);margin-bottom:10px;}
.svsc-case-card h3{font-size:16px;margin-bottom:14px;}
.svsc-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.svsc-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.svsc-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--svsc-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.svsc-faq-q::after{content:'▾';font-size:13px;color:var(--svsc-accent);flex-shrink:0;transition:transform .25s;}
.svsc-faq-item.open .svsc-faq-q::after{transform:rotate(180deg);}
.svsc-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--svsc-muted);line-height:1.72;}
.svsc-faq-item.open .svsc-faq-a{max-height:800px;padding:0 24px 20px;}
.svsc-test-magnet{border:2px solid rgba(34,197,94,.35);border-radius:var(--svsc-r-lg);padding:32px;background:linear-gradient(135deg,rgba(34,197,94,.06),rgba(245,197,24,.04));}
.svsc-test-magnet h2{margin-bottom:12px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--svsc-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--svsc-btn-from),var(--svsc-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--svsc-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--svsc-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
/* ROI calculator */
.svsc-roi-grid{display:grid;grid-template-columns:1fr 1fr;gap:28px;align-items:stretch;}
@media(max-width:900px){.svsc-roi-grid{grid-template-columns:1fr;}}
.svsc-roi-controls label{display:block;font-size:13px;font-weight:600;color:var(--svsc-soft);margin-bottom:6px;}
.svsc-roi-controls input[type=range]{width:100%;margin-bottom:4px;accent-color:var(--svsc-accent);}
.svsc-roi-val{font-size:12px;color:var(--svsc-muted);margin-bottom:18px;}
.svsc-roi-result{background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.25);border-radius:14px;padding:20px;margin-top:8px;}
.svsc-roi-result .big{font-size:clamp(24px,3vw,32px);font-weight:900;color:var(--svsc-green);letter-spacing:-.03em;}
#svsc-roi-calc-wrap{position:relative;min-height:280px;border-radius:16px;background:rgba(0,0,0,.2);border:1px solid rgba(255,255,255,.08);overflow:hidden;}
#svsc-roi-calc{display:block;width:100%;height:280px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

  <!-- PROBLEMA -->
  <section class="svsc-section" id="problema">
    <div class="svsc-cnt">
      <div class="svsc-sh svsc-left">
        <span class="svsc-eyebrow">Боль финотдела</span>
        <h2>Почему ручная сверка счетов съедает часы и прячет ошибки</h2>
        <p>Типовая картина: пять вкладок — 1С, банк, два ЛК ЭДО, почта — и дни ручного перебора. Ошибки откладываются до закрытия месяца.</p>
      </div>
      <div class="svsc-grid-2 nero-ai-reveal">
        <div class="svsc-card">
          <h3>Разрозненные источники</h3>
          <p>Счёт на почте, оплата в третьем банке, УПД в Диадоке другого юрлица, статус «оплачено» в amoCRM. Ни один коробочный модуль не видит всю цепочку.</p>
        </div>
        <div class="svsc-card nero-ai-delay-1">
          <h3>Excel как клей</h3>
          <p>Таблицы «счёт / оплата / акт» живут отдельно от учёта; при смене сотрудника ломается логика сопоставления.</p>
        </div>
        <div class="svsc-card nero-ai-delay-1">
          <h3>Позднее обнаружение</h3>
          <p>Расхождения счет–оплата–УПД всплывают при закрытии периода: сторно, переплата, штраф за НДС.</p>
        </div>
        <div class="svsc-card nero-ai-delay-2">
          <h3>Масштаб</h3>
          <p>50+ документов/мес. на юрлицо; при 16 кабинетах ЭДО ручной контроль физически не успевает. Кейс Epsilon Metrics: <strong>5–6 ч/день</strong> на ручной ввод.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;max-width:720px;margin-left:auto;margin-right:auto;color:var(--svsc-soft);">Боль не в отсутствии ЭДО или 1С, а в отсутствии <strong>сквозной сверки до закрытия периода</strong>.</p>
    </div>
  </section>

  <!-- CHTO TAKOE -->
  <section class="svsc-section svsc-section-alt" id="chto-takoe">
    <div class="svsc-cnt">
      <div class="svsc-sh">
        <span class="svsc-eyebrow">Определение</span>
        <h2>Что такое AI-сверка счетов, оплат и закрывающих документов</h2>
        <p><strong>AI-сверка</strong> — услуга внедрения системы, которая сопоставляет счёт, платёж, закрывающий (УПД, акт) и статус в CRM/ERP, подсвечивая расхождения по сумме, НДС, дате, контрагенту и назначению платежа.</p>
      </div>

      <div class="svsc-table-wrap nero-ai-reveal">
        <table class="svsc-table" aria-label="Сравнение подходов">
          <thead><tr><th>Подход</th><th>Что делает</th><th>Чего не делает</th></tr></thead>
          <tbody>
            <tr><td>OCR / 1С:РПД</td><td>Распознаёт поля, черновик в 1С</td><td>Не связывает оплату из банка со статусом сделки</td></tr>
            <tr><td>RPA</td><td>Копирует данные по жёстким правилам</td><td>Ломается на нестандартном назначении платежа</td></tr>
            <tr><td>1С:Сверка 2.0</td><td>Сверка между контрагентами на 1С</td><td>Нет CRM, почты, нескольких ЭДО, внутреннего цикла</td></tr>
            <tr><td><strong>AI-сверка Nero</strong></td><td>Сквозная цепочка + fuzzy matching + LLM</td><td>Юридические подписи и закрытие месяца — за человеком</td></tr>
          </tbody>
        </table>
      </div>

      <div class="svsc-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="svsc-card">
          <h3>Четыре звена одной ленты</h3>
          <ul>
            <li>Счёт на оплату — почта, ЭДО, 1С</li>
            <li>Платёж — выписка, API банка, заявка в 1С</li>
            <li>Закрывающий — УПД 5.03, акт, ТОРГ-12</li>
            <li>Статус в учёте/CRM — проведение, «оплачено» в сделке</li>
          </ul>
        </div>
        <div class="svsc-card">
          <h3>Расхождения до month-end</h3>
          <div class="svsc-table-wrap" style="margin:0;">
            <table class="svsc-table">
              <thead><tr><th>Тип</th><th>Примеры</th><th>Крит.</th></tr></thead>
              <tbody>
                <tr><td>Сумма/НДС</td><td>Переплата, частичная оплата</td><td class="svsc-crit-high">Высокая</td></tr>
                <tr><td>Документ</td><td>Счёт без оплаты; оплата без УПД</td><td class="svsc-crit-high">Высокая</td></tr>
                <tr><td>Дубли</td><td>Двойная оплата счёта</td><td class="svsc-crit-high">Крит.</td></tr>
                <tr><td>Статусы</td><td>CRM «оплачено» — нет УПД в 1С</td><td class="svsc-crit-med">Средняя</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- БОРИС: визуальный блок цепочки (НЕ hero) -->
  <section id="svsc-boris-viz" class="bsc-root" aria-label="Анимация: сквозная цепочка счёт — оплата — УПД — статус CRM">
<style>
#svsc-boris-viz.bsc-root{padding:56px 0 64px;background:#f8fafc;}
#svsc-boris-viz .bsc-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#svsc-boris-viz .bsc-card{display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:480px;}
@media(max-width:1023px){#svsc-boris-viz .bsc-card{grid-template-columns:1fr;min-height:auto;}}
#svsc-boris-viz .bsc-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#svsc-boris-viz .bsc-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#svsc-boris-viz .bsc-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#b45309;margin:0 0 14px;}
#svsc-boris-viz .bsc-ey::before{content:'';width:18px;height:2px;background:#f5c518;border-radius:1px;}
#svsc-boris-viz .bsc-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#svsc-boris-viz .bsc-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#svsc-boris-viz .bsc-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#svsc-boris-viz .bsc-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(245,197,24,.15);display:flex;align-items:center;justify-content:center;font-size:11px;color:#b45309;font-style:normal;}
#svsc-boris-viz .bsc-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#svsc-boris-viz .bsc-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;}
#svsc-boris-viz .bsc-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#svsc-boris-viz .bsc-pl-o{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22);}
#svsc-boris-viz .bsc-pl-c{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#svsc-boris-viz .bsc-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#svsc-boris-viz .bsc-rgt{position:relative;background:linear-gradient(135deg,#fffbeb 0%,#fef9c3 20%,#f0f9ff 60%,#f8fafc 100%);min-height:420px;overflow:hidden;}
#svsc-sverka-chain-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bsc-cnt">
  <div class="bsc-card">
    <div class="bsc-lft">
      <span class="bsc-ey">Сквозная сверка</span>
      <h3 class="bsc-h3">Четыре звена — одна лента контроля до закрытия месяца</h3>
      <ul class="bsc-ul">
        <li><span class="bsc-ic">1</span><strong>Счёт</strong> — из почты, ЭДО или 1С попадает в очередь сопоставления</li>
        <li><span class="bsc-ic">2</span><strong>Оплата</strong> — выписка банка сопоставляется по сумме и NLP назначения</li>
        <li><span class="bsc-ic">3</span><strong>УПД/акт</strong> — закрывающий сверяется с заказом и договором</li>
        <li><span class="bsc-ic">4</span><strong>CRM/1С</strong> — статус сделки и проводка должны совпасть с фактом</li>
      </ul>
      <div class="bsc-pills">
        <span class="bsc-pl bsc-pl-o">fuzzy match</span>
        <span class="bsc-pl bsc-pl-g">human-in-the-loop</span>
        <span class="bsc-pl bsc-pl-c">УПД 5.03 + PDF</span>
      </div>
      <p class="bsc-foot">Дальше — 5 типовых сценариев AI-сверки на вашем контуре ↓</p>
    </div>
    <div class="bsc-rgt">
      <canvas id="svsc-sverka-chain-canvas" aria-label="Анимация: документы проходят четыре звена сверки с подсветкой расхождений" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv=document.getElementById('svsc-sverka-chain-canvas');
  if(!cv)return;
  var ctx=cv.getContext('2d'),W=0,H=0,frame=0;
  function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||420;W=cv.width;H=cv.height;}
  window.addEventListener('resize',resize);resize();
  var C={ink:'#0f172a',muted:'#64748b',gold:'#f5c518',cyan:'#0ea5e9',green:'#22c55e',red:'#ef4444',amber:'#f59e0b',violet:'#8b5cf6',line:'rgba(14,165,233,.35)',paper:'#fff',paperB:'#cbd5e1'};
  var NODES=[
    {id:'schet',label:'Счёт',sub:'почта / ЭДО',color:C.amber,x:.12},
    {id:'oplata',label:'Оплата',sub:'банк',color:C.cyan,x:.36},
    {id:'upd',label:'УПД/акт',sub:'ЭДО 5.03',color:C.violet,x:.60},
    {id:'crm',label:'CRM/1С',sub:'статус',color:C.green,x:.84}
  ];
  var LOOP=520;
  function rr(x,y,w,h,r,f,s,lw){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(f){ctx.fillStyle=f;ctx.fill();}if(s){ctx.strokeStyle=s;ctx.lineWidth=lw||1.5;ctx.stroke();}}
  function drawNode(nx,ny,nw,nh,n,pulse,state){
    var glow=state==='ok'?C.green:state==='err'?C.red:C.gold;
    rr(nx-4,ny-4,nw+8,nh+8,14,'rgba(0,0,0,.03)',state==='idle'?C.paperB:glow,state==='idle'?1:2);
    rr(nx,ny,nw,nh,12,C.paper,C.paperB,1.5);
    ctx.fillStyle=n.color;rr(nx+10,ny+10,nw-20,8,4,n.color,null,0);
    ctx.fillStyle=C.ink;ctx.font='bold 12px Inter,sans-serif';ctx.textAlign='center';
    ctx.fillText(n.label,nx+nw/2,ny+36);
    ctx.fillStyle=C.muted;ctx.font='10px Inter,sans-serif';
    ctx.fillText(n.sub,nx+nw/2,ny+52);
    if(state==='ok'){ctx.fillStyle=C.green;ctx.font='bold 14px sans-serif';ctx.fillText('✓',nx+nw-14,ny+18);}
    if(state==='err'){ctx.fillStyle=C.red;ctx.font='bold 14px sans-serif';ctx.fillText('!',nx+nw-14,ny+18);}
    if(state==='scan'){var sy=ny+14+(pulse%30);ctx.strokeStyle=C.gold;ctx.lineWidth=2;ctx.beginPath();ctx.moveTo(nx+8,sy);ctx.lineTo(nx+nw-8,sy);ctx.stroke();}
  }
  function drawPacket(x,y,t,clr){rr(x,y,28,20,5,clr,'#fff',1);ctx.fillStyle='#fff';ctx.font='bold 8px sans-serif';ctx.textAlign='center';ctx.fillText('DOC',x+14,y+13);}
  function loop(){
    frame++;var t=frame%LOOP;
    ctx.clearRect(0,0,W,H);
    var cy=H*.42,nw=Math.min(108,W*.19),nh=68,gap=H*.08;
    NODES.forEach(function(n,i){
      var nx=n.x*W-nw/2;
      var state='idle';
      var segStart=i*110,segEnd=segStart+90;
      if(t>=segStart&&t<segEnd)state='scan';
      if(t>=segEnd&&t<segEnd+25)state=(i===2&&t%LOOP>340)?'err':'ok';
      drawNode(nx,cy,nw,nh,n,frame,state);
      if(i<NODES.length-1){
        var x1=nx+nw+4,x2=NODES[i+1].x*W-nw/2-4,midY=cy+nh/2;
        ctx.strokeStyle=C.line;ctx.lineWidth=2;ctx.setLineDash([5,4]);
        ctx.beginPath();ctx.moveTo(x1,midY);ctx.lineTo(x2,midY);ctx.stroke();ctx.setLineDash([]);
        var prog=Math.max(0,Math.min(1,(t-i*110-20)/80));
        if(prog>0&&prog<1)drawPacket(x1+(x2-x1)*prog-14,midY-10,prog,NODES[i].color);
      }
    });
    var dashY=H*.78;
    rr(16,dashY,W-32,56,12,'rgba(15,23,42,.04)','#e2e8f0',1);
    ctx.fillStyle=C.ink;ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='left';
    ctx.fillText('Дашборд расхождений · демо',28,dashY+18);
    var alerts=[
      {txt:'Счёт №1847 — нет оплаты',c:C.red,off:0},
      {txt:'Оплата 120 000 ₽ — нет УПД',c:C.amber,off:1},
      {txt:'Пакет 47 док. — сверено 89%',c:C.green,off:2}
    ];
    alerts.forEach(function(a,i){
      var ax=28+i*((W-56)/3);
      ctx.fillStyle=a.c;ctx.font='10px Inter,sans-serif';
      ctx.fillText(a.txt,ax,dashY+40);
    });
    ctx.fillStyle=C.muted;ctx.font='10px Inter,sans-serif';ctx.textAlign='center';
    ctx.fillText('продолжение сцены hero · сквозной контур',W/2,H-10);
    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
  </section>

  <!-- KAK RABOTAET -->
  <section class="svsc-section" id="kak-rabotaet">
    <div class="svsc-cnt">
      <div class="svsc-sh">
        <span class="svsc-eyebrow">Сценарии</span>
        <h2>Как работает AI-сверка: 5 типовых сценариев</h2>
        <p>Конкретные цепочки из практики <strong>ai сверка оплат</strong> и <strong>ai закрывающие документы</strong> — не абстрактная автоматизация.</p>
      </div>
      <div class="nero-ai-reveal">
        <div class="svsc-scenario"><h3>Счёт выставлен — оплаты нет или сумма не сходится</h3><p>AI помечает связку, считает дни просрочки, предлагает действие: напомнить казначейству, уточнить частичную оплату.</p></div>
        <div class="svsc-scenario"><h3>Оплата прошла — закрывающих нет или реквизиты расходятся</h3><p>Сопоставление назначения платежа со счетами за 90 дней; «оплата без закрывающего» — критично перед закрытием квартала.</p></div>
        <div class="svsc-scenario"><h3>УПД/акт не совпадает с заказом или договором</h3><p>IDP извлекает строки; matching engine сравнивает с заказом в 1С; расхождение — на утверждение с объяснением LLM.</p></div>
        <div class="svsc-scenario"><h3>Статус в CRM/ERP не соответствует факту оплаты</h3><p><strong>Интеграция ai сверка счетов с crm</strong> закрывает разрыв «оплачено в amoCRM — нет в банке». Смежный продажный контур amoCRM — в разделе «Интеграции» ниже.</p></div>
        <div class="svsc-scenario"><h3>Пакетная сверка десятков и сотен документов</h3><p>Агент забирает документы из ЭДО (кейс: 16 юрлиц каждые 2 ч), выписки, почту. Бухгалтер работает с <strong>исключениями</strong>, не с полным перебором.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;text-align:center;color:var(--svsc-soft);">Логика: сбор → нормализация → сопоставление → классификация → маршрутизация → повторная сверка с audit log.</p>
    </div>
  </section>

  <!-- KOMU NUZHNO -->
  <section class="svsc-section svsc-section-alt" id="komu-nuzhno">
    <div class="svsc-cnt">
      <div class="svsc-sh"><span class="svsc-eyebrow">Целевая аудитория</span><h2>Кому нужна AI-сверка счетов и оплат</h2></div>
      <div class="svsc-grid-3 nero-ai-reveal">
        <div class="svsc-card"><h3>Бухгалтерия и финансы</h3><p>Несколько юрлиц, банков, закрытие периода под давлением.</p></div>
        <div class="svsc-card nero-ai-delay-1"><h3>Опт и производство</h3><p>Сотни счетов поставщиков, частичные отгрузки, УПД на объёме.</p></div>
        <div class="svsc-card nero-ai-delay-2"><h3>Агентства и малый бизнес</h3><p>Закрывающие по проектам, размытые назначения платежей; облегчённый пакет после теста 20 док.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;text-align:center;">Ориентир: от <strong>50+ документов/мес.</strong> на юрлицо, 1С + банк + хотя бы один ЭДО.</p>
    </div>
  </section>

  <!-- INTERNAL-LINKS (internal-linker) -->
  <section class="svsc-section svsc-section-alt svsc-related-bridge" aria-label="Смежные материалы">
    <div class="svsc-cnt">
      <p class="nero-ai-reveal" style="text-align:center;max-width:820px;margin:0 auto;color:var(--svsc-soft);line-height:1.65;">
        Финансовые команды массово наращивают gen AI в учёт и контроль — на корпоративном масштабе это уже видно в разборе
        <a href="<?php echo esc_url( home_url( '/kpmg-claude-vnedrenie-ai-276-tysyach/' ) ); ?>">кейса KPMG и Claude для 276&nbsp;000 сотрудников</a>.
        Ниже — как связать сверку с 1С, CRM, банком и почтой в одном контуре.
      </p>
    </div>
  </section>
  <!-- INTEGRACII -->
  <section class="svsc-section" id="integracii">
    <div class="svsc-cnt">
      <div class="svsc-sh"><span class="svsc-eyebrow">Коннекторы</span><h2>Интеграции: 1С, банк-клиент, CRM и почта с закрывающими</h2></div>
      <div class="svsc-grid-2 nero-ai-reveal">
        <div class="svsc-card"><h3>1С и ERP</h3><p>Выгрузка контрагентов, заявок, проведённых документов. Смежная услуга — <a href="<?php echo esc_url( home_url( '/ai-1c-erp/' ) ); ?>">AI-агент для 1С и ERP</a>: там агент внутри ERP; <strong>здесь — финансовый контроль документов и оплат</strong>.</p></div>
        <div class="svsc-card nero-ai-delay-1"><h3>Банк и ЭДО</h3><p>Выписки, API банков; агрегация Диадок, СБИС, 1С-ЭДО в один контур вместо N личных кабинетов.</p></div>
        <div class="svsc-card"><h3>CRM</h3><p>Статусы сделок amoCRM, Битрикс24. <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-amocrm/' ) ); ?>">внедрение AI-агента в amoCRM под ключ</a> — продажный контур.</p></div>
        <div class="svsc-card nero-ai-delay-1"><h3>Почта</h3><p>Счета и акты из ящика. Пересечение с <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-obrabotka-email-crm/' ) ); ?>">AI-обработкой входящей почты в CRM</a>.</p></div>
      </div>
    </div>
  </section>

  <!-- ROI + CALCULATOR -->
  <section class="svsc-section svsc-section-alt" id="roi">
    <div class="svsc-cnt">
      <div class="svsc-sh">
        <span class="svsc-eyebrow">Экономика</span>
        <h2>ROI: сколько экономит автоматизация сверки</h2>
        <p>Формула: <strong>(часы × ставка × 12) + снижение риска инцидентов − стоимость внедрения</strong>. Пилот на 20 документах показывает процессный выигрыш на ваших данных.</p>
      </div>
      <div class="svsc-card nero-ai-reveal svsc-roi-grid">
        <div class="svsc-roi-controls">
          <label for="svsc-roi-docs">Документов на сверку в месяц</label>
          <input type="range" id="svsc-roi-docs" min="50" max="800" step="10" value="200">
          <div class="svsc-roi-val" id="svsc-roi-docs-val">200 док./мес.</div>
          <label for="svsc-roi-hours">Часов бухгалтерии на сверку в месяц</label>
          <input type="range" id="svsc-roi-hours" min="8" max="200" step="2" value="80">
          <div class="svsc-roi-val" id="svsc-roi-hours-val">80 ч/мес.</div>
          <label for="svsc-roi-rate">Ставка часа бухгалтера, ₽</label>
          <input type="range" id="svsc-roi-rate" min="400" max="2500" step="50" value="900">
          <div class="svsc-roi-val" id="svsc-roi-rate-val">900 ₽/час</div>
          <label for="svsc-roi-cost">Бюджет внедрения, ₽</label>
          <input type="range" id="svsc-roi-cost" min="250000" max="1000000" step="50000" value="500000">
          <div class="svsc-roi-val" id="svsc-roi-cost-val">500 000 ₽</div>
          <div class="svsc-roi-result">
            <div>Экономия в год (ориентир)</div>
            <div class="big" id="svsc-roi-save">—</div>
            <div style="font-size:13px;margin-top:8px;color:var(--svsc-muted);" id="svsc-roi-payback">Окупаемость: —</div>
          </div>
        </div>
        <div id="svsc-roi-calc-wrap" aria-hidden="true">
          <canvas id="svsc-roi-calc" role="img" aria-label="График: экономия на сверке vs стоимость внедрения"></canvas>
        </div>
      </div>
    </div>
  </section>

  <div class="svsc-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-roi">
      <div class="ym-cta-block__icon" aria-hidden="true">📄</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Тестовая сверка 20 документов — на ваших счетах и выписках</p>
        <p class="ym-cta-block__sub">Передайте до 20 документов (счета, фрагменты выписок, УПД/PDF) — через ~48 часов получите отчёт: какие связки сошлись, где расхождения критичны до закрытия месяца. Без обязательств по полному внедрению.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <!-- ETAPY -->
  <section class="svsc-section" id="etapy">
    <div class="svsc-cnt">
      <div class="svsc-sh svsc-left"><span class="svsc-eyebrow">Под ключ</span><h2>Внедрение AI-сверки под ключ: этапы и сроки</h2></div>
      <div class="svsc-card nero-ai-reveal">
        <div class="svsc-timeline">
          <div class="svsc-tl-item"><div class="svsc-tl-dot"></div><h3>Аудит сверки и источников (1–2 нед.)</h3><p>Карта «счёт–оплата–закрывающий», регламент отклонений, образцы за 3–6 мес.</p></div>
          <div class="svsc-tl-item"><div class="svsc-tl-dot"></div><h3>Пилот на 20 документах (2–3 нед.)</h3><p>Лид-магнит: эталонная разметка, правила matching, отчёт за ~48 ч.</p></div>
          <div class="svsc-tl-item"><div class="svsc-tl-dot"></div><h3>Интеграция и обучение (3–5 нед.)</h3><p>API 1С, банк, ЭДО, CRM; дашборд; LLM-объяснения; 152-ФЗ в согласованном контуре.</p></div>
          <div class="svsc-tl-item"><div class="svsc-tl-dot"></div><h3>Прод и контроль качества (2–4 нед.)</h3><p>Мониторинг ложных срабатываний, audit trail, обучение команды.</p></div>
        </div>
      </div>
      <div class="svsc-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="svsc-table" aria-label="Сравнение с рынком">
          <thead><tr><th>Решение</th><th>Сильная сторона</th><th>Ограничение</th></tr></thead>
          <tbody>
            <tr><td>1С:Сверка 2.0</td><td>Бесплатно в ИТС, сверка с контрагентом на 1С</td><td>Нет CRM/почты/нескольких ЭДО</td></tr>
            <tr><td>Saby / Диадок</td><td>Акты сверки в ЭДО</td><td>Нет связки банк → CRM → month-end</td></tr>
            <tr><td><strong>Nero Network</strong></td><td>Сквозная цепочка, пилот 20 док.</td><td>Проектное внедрение 250 тыс.–1 млн ₽</td></tr>
          </tbody>
        </table>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Финансовой команде нужен базовый контур AI до пилота?</p>
          <p class="ym-cta-block__sub">Перед согласованием правил сверки с бухгалтерией и IT полезно разобраться в n8n, human-in-the-loop и интеграции с 1С — это ускоряет пилот на 20 документах. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- CENY -->
  <section class="svsc-section svsc-section-alt" id="ceny">
    <div class="svsc-cnt">
      <div class="svsc-sh"><span class="svsc-eyebrow">Коммерция</span><h2>Стоимость внедрения AI-сверки счетов</h2></div>
      <div class="svsc-card nero-ai-reveal">
        <p><strong>Ai сверка счетов цена</strong> зависит от масштаба: ориентир <strong>от 250 000 до 1 000 000 ₽</strong> за проект под ключ. Факторы: число юрлиц и банков, операторы ЭДО, глубина CRM, RPA для легаси.</p>
        <p>Это другой уровень, чем тариф ЭДО «от 5 000 ₽/год»: вы платите за <strong>сквозной контур</strong> с дашбордом до закрытия месяца. Точную смету — после аудита; начните с <a href="#test-sverka">тестовой сверки 20 документов</a>.</p>
      </div>
    </div>
  </section>

  <!-- KEISY -->
  <section class="svsc-section" id="keisy">
    <div class="svsc-cnt">
      <div class="svsc-sh"><span class="svsc-eyebrow">Доказательства</span><h2>Кейсы и примеры внедрения</h2></div>
      <div class="svsc-case-grid nero-ai-reveal">
        <div class="svsc-case-card"><div class="svsc-case-tag">Производство</div><h3>Epsilon Metrics, 9 юрлиц</h3><p>5 подсистем ИИ: счета, 5 банков, закрывающие из ЭДО. Было 5–6 ч/день ручного ввода; на счёт — секунды на проверку.</p></div>
        <div class="svsc-case-card"><div class="svsc-case-tag">ЭДО</div><h3>16 личных кабинетов</h3><p>Агент мониторит Диадок и СБИС каждые 2 ч, передаёт УПД в 1С — один контур вместо ручного обхода.</p></div>
        <div class="svsc-case-card"><div class="svsc-case-tag">Международный</div><h3>BlackLine Verity AI</h3><p>AI matching и close для CFO; для РФ адаптируем под 1С, УПД 5.03 и российские ЭДО.</p></div>
      </div>
    </div>
  </section>

  <!-- TEST SVERKA -->
  <section class="svsc-section svsc-section-alt" id="test-sverka">
    <div class="svsc-cnt">
      <div class="svsc-test-magnet nero-ai-reveal">
        <span class="svsc-eyebrow">Лид-магнит</span>
        <h2>Тестовая сверка 20 документов — проверьте на своих данных</h2>
        <ol style="padding-left:20px;color:var(--svsc-muted);line-height:1.8;margin:0 0 1.5em;">
          <li>Передаёте до 20 документов и краткий регламент</li>
          <li>Настраиваем правила сопоставления на пилотном контуре</li>
          <li>Через ~48 часов — отчёт по связкам и критичным расхождениям</li>
          <li>По результату — смета полного внедрения и расчёт ROI</li>
        </ol>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="svsc-section" id="faq">
    <div class="svsc-cnt">
      <div class="svsc-sh"><span class="svsc-eyebrow">FAQ</span><h2>FAQ по AI-сверке счетов и оплат</h2></div>
      <div class="svsc-faq nero-ai-reveal">
        <div class="svsc-faq-item"><div class="svsc-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-сверка отличается от обычного OCR?</div><div class="svsc-faq-a"><p>OCR извлекает поля из счёта или УПД. <strong>AI-сверка</strong> связывает документ с платежом в банке, закрывающим в ЭДО и статусом в CRM/1С, классифицирует расхождения и объясняет их текстом.</p></div></div>
        <div class="svsc-faq-item"><div class="svsc-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли внедрить без замены 1С или CRM?</div><div class="svsc-faq-a"><p>Да. Слой сопоставления строится поверх существующих систем через API, обмены и при необходимости RPA. Замена учёта не требуется.</p></div></div>
        <div class="svsc-faq-item"><div class="svsc-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько времени занимает пилот?</div><div class="svsc-faq-a"><p>Тест 20 документов — ~48 часов на отчёт. Полный пилот с интеграциями — 2–3 недели; прод — 8–14 недель суммарно.</p></div></div>
        <div class="svsc-faq-item"><div class="svsc-faq-q" role="button" tabindex="0" aria-expanded="false">Какие документы нужны для тестовой сверки?</div><div class="svsc-faq-a"><p>Образцы счетов, выписок, УПД/актов, при возможности — выгрузка контрагентов из 1С. Достаточно 20 документов для первичной оценки.</p></div></div>
        <div class="svsc-faq-item"><div class="svsc-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли решение для малого бизнеса?</div><div class="svsc-faq-a"><p>Да, если ручная рутина измерима: 1–2 дня в месяц на сверку из-за почты и разных форматов. При 5 счетах/мес. может хватить 1С:Сверки; при нескольких каналах — облегчённый пакет после теста.</p></div></div>
        <div class="svsc-faq-item"><div class="svsc-faq-q" role="button" tabindex="0" aria-expanded="false">Безопасны ли данные? 152-ФЗ?</div><div class="svsc-faq-a"><p>Обработка в согласованном контуре (облако РФ / ваш сервер), без публикации в открытых LLM. Договор ПДн, audit log — стандарт проекта.</p></div></div>
        <div class="svsc-faq-item"><div class="svsc-faq-q" role="button" tabindex="0" aria-expanded="false">Чем это лучше бесплатной 1С:Сверки 2.0?</div><div class="svsc-faq-a"><p>1С:Сверка — с контрагентом на 1С для НДС. Nero закрывает <strong>внутренний контроль до month-end</strong>: банк, несколько ЭДО, CRM, почта.</p></div></div>
        <div class="svsc-faq-item"><div class="svsc-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли отдельный AI-агент в 1С?</div><div class="svsc-faq-a"><p>Не обязательно. Широкий агент в ERP — отдельная услуга «AI-агент для 1С и ERP» (см. раздел «Интеграции»). Узкая задача контроля счетов и оплат — контур на этой странице.</p></div></div>
      </div>
    </div>
  </section>

  <section class="svsc-section" id="cta-final" style="background:linear-gradient(135deg,rgba(245,197,24,.08),rgba(121,242,255,.08));">
    <div class="svsc-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-footer">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы убрать ручную сверку до закрытия месяца?</p>
          <p class="ym-cta-block__sub">Следующий шаг — тестовая сверка 20 документов и расчёт ROI на вашем потоке первички. Полное внедрение под ключ — от 250 тыс. ₽ после аудита контура.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#roi" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Рассчитать ROI →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.svsc-content -->


<?php
$svsc_page_url = trailingslashit( get_permalink() );
$svsc_site_url = trailingslashit( home_url( '/' ) );
$svsc_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$svsc_schema   = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $svsc_site_url . '#organization',
			'name'  => $svsc_brand,
			'url'   => $svsc_site_url,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $svsc_site_url . '#website',
			'url'       => $svsc_site_url,
			'name'      => $svsc_brand,
			'publisher' => [ '@id' => $svsc_site_url . '#organization' ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $svsc_page_url . '#webpage',
			'url'         => $svsc_page_url,
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $svsc_site_url . '#website' ],
			'about'       => [ '@id' => $svsc_site_url . '#organization' ],
		],
		[
			'@type' => 'BreadcrumbList',
			'@id'   => $svsc_page_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $svsc_site_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $svsc_page_url ],
			],
		],
		[
			'@type'       => 'Service',
			'@id'         => $svsc_page_url . '#service',
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'url'         => $svsc_page_url,
			'provider'    => [ '@id' => $svsc_site_url . '#organization' ],
		],
		[
			'@type' => 'FAQPage',
			'@id'   => $svsc_page_url . '#faq',
			'mainEntity' => [
				[ '@type' => 'Question', 'name' => 'Чем AI-сверка отличается от обычного OCR?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'OCR извлекает поля из счёта или УПД. AI-сверка связывает документ с платежом в банке, закрывающим в ЭДО и статусом в CRM/1С, классифицирует расхождения и объясняет их текстом.' ] ],
				[ '@type' => 'Question', 'name' => 'Можно ли внедрить без замены 1С или CRM?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Слой сопоставления строится поверх существующих систем через API, обмены и при необходимости RPA. Замена учёта не требуется.' ] ],
				[ '@type' => 'Question', 'name' => 'Сколько времени занимает пилот?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Тест 20 документов — ~48 часов на отчёт. Полный пилот с интеграциями — 2–3 недели; прод — 8–14 недель суммарно.' ] ],
				[ '@type' => 'Question', 'name' => 'Какие документы нужны для тестовой сверки?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Образцы счетов, выписок, УПД/актов, при возможности — выгрузка контрагентов из 1С. Достаточно 20 документов для первичной оценки.' ] ],
				[ '@type' => 'Question', 'name' => 'Подходит ли решение для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, если ручная рутина измерима: 1–2 дня в месяц на сверку из-за почты и разных форматов. При 5 счетах/мес. может хватить 1С:Сверки; при нескольких каналах — облегчённый пакет после теста.' ] ],
				[ '@type' => 'Question', 'name' => 'Безопасны ли данные? 152-ФЗ?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Обработка в согласованном контуре (облако РФ / ваш сервер), без публикации в открытых LLM. Договор ПДн, audit log — стандарт проекта.' ] ],
				[ '@type' => 'Question', 'name' => 'Чем это лучше бесплатной 1С:Сверки 2.0?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '1С:Сверка — с контрагентом на 1С для НДС. Nero закрывает внутренний контроль до month-end: банк, несколько ЭДО, CRM, почта.' ] ],
				[ '@type' => 'Question', 'name' => 'Нужен ли отдельный AI-агент в 1С?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Не обязательно. Широкий агент в ERP — AI-агент для 1С и ERP. Узкая задача контроля счетов и оплат — контур на этой странице.' ] ],
			],
		],
	],
];
echo '<script type="application/ld+json">' . wp_json_encode( $svsc_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
?>

</main>

<script>
/**
 * ai-sverka-hero-engine — «Казначейский мост сверки»
 * Мир: орбитальные пакеты между счётом, банком, УПД и CRM → хаб month-end
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ai-sverka-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2;
    scale = Math.min(cw / 420, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    gold: "#f5c518",
    cyan: "#79f2ff",
    green: "#22c55e",
    amber: "#f59e0b",
    red: "#ef4444",
    nodeBg: "rgba(15,23,42,0.92)",
    arc: "rgba(121,242,255,0.35)",
    packet: "#fde68a",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
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
      ctx.lineWidth = 1.2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Орбитальные дуги — вместо Conveyor */
  function PaymentPacketStream() {
    this.packets = [
      { arc: 0, t: 0.1, label: "СЧ" },
      { arc: 1, t: 0.45, label: "₽" },
      { arc: 2, t: 0.72, label: "УПД" },
      { arc: 3, t: 0.28, label: "CRM" }
    ];
    this.arcs = [
      { n0: 0, n1: 1, r: 58 },
      { n0: 1, n1: 2, r: 62 },
      { n0: 2, n1: 3, r: 58 },
      { n0: 3, n1: 0, r: 64 }
    ];
    this.nodePos = [
      { x: 0, y: -78 },
      { x: 78, y: 0 },
      { x: 0, y: 78 },
      { x: -78, y: 0 }
    ];
  }
  PaymentPacketStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 280;
    this.arcs.forEach(function (a, i) {
      var p0 = this.nodePos[a.n0];
      var p1 = this.nodePos[a.n1];
      var mx = (p0.x + p1.x) / 2;
      var my = (p0.y + p1.y) / 2;
      var active = prg > 20 + i * 35 && prg < 200;
      ctx.strokeStyle = active ? C.arc : "rgba(100,116,139,0.25)";
      ctx.lineWidth = active ? 2 : 1;
      ctx.setLineDash(active ? [] : [4, 5]);
      ctx.beginPath();
      ctx.moveTo(p0.x, p0.y);
      ctx.quadraticCurveTo(mx * 0.3, my * 0.3 - a.r * 0.15, p1.x, p1.y);
      ctx.stroke();
      ctx.setLineDash([]);
    }, this);

    this.packets.forEach(function (pk) {
      var a = this.arcs[pk.arc];
      var p0 = this.nodePos[a.n0];
      var p1 = this.nodePos[a.n1];
      var t = ((pk.t + frame * 0.004) % 1);
      var x = p0.x + (p1.x - p0.x) * t;
      var y = p0.y + (p1.y - p0.y) * t;
      var lift = Math.sin(t * Math.PI) * -18;
      drawRR(ctx, x - 9, y + lift - 9, 18, 18, 4, C.packet, C.gold);
      ctx.fillStyle = "#1a1200";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(pk.label, x, y + lift + 3);
    }, this);
  };

  /* Центральный хаб — вместо WebsiteTerminal */
  function MonthEndReconciliationHub() {
    this.phase = 0;
  }
  MonthEndReconciliationHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 280;
    var pulse = 0.85 + Math.sin(frame * 0.08) * 0.15;
    drawRR(ctx, -38, -38, 76, 76, 18, C.nodeBg, C.gold);
    ctx.strokeStyle = "rgba(245,197,24," + (0.25 + pulse * 0.2) + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, 0, 42 * pulse, 0, Math.PI * 2);
    ctx.stroke();

    ctx.fillStyle = C.gold;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("MONTH-END", 0, -6);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.fillText("HUB", 0, 6);

    if (prg >= 155 && prg < 230) {
      var seal = Math.min(1, (prg - 155) / 20);
      ctx.save();
      ctx.globalAlpha = seal;
      ctx.strokeStyle = C.green;
      ctx.lineWidth = 2.5;
      ctx.strokeRect(-32, 18, 64, 22);
      ctx.fillStyle = C.green;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("СХОДИТСЯ", 0, 33);
      ctx.restore();
    }
    if (prg >= 230) {
      var blink = 0.5 + Math.sin(frame * 0.2) * 0.5;
      ctx.fillStyle = "rgba(239,68,68," + blink + ")";
      ctx.beginPath();
      ctx.arc(0, 0, 8, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  function InvoiceLedgerShelf() {
    this.stack = 0;
  }
  InvoiceLedgerShelf.prototype.draw = function (ctx) {
    drawRR(ctx, -12, -98, 24, 32, 4, "rgba(245,197,24,0.15)", C.outline);
    for (var i = 0; i < 3; i++) {
      drawRR(ctx, -10, -94 + i * 4, 20, 14, 2, "#fef3c7", C.outline);
    }
    ctx.fillStyle = C.gold;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Счёт", 0, -102);
  };

  function BankStatementTicker() {
    this.offset = 0;
  }
  BankStatementTicker.prototype.draw = function (ctx) {
    this.offset = (frame * 0.6) % 40;
    drawRR(ctx, 62, -14, 36, 28, 5, C.nodeBg, C.cyan);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Банк", 80, -18);
    for (var r = 0; r < 3; r++) {
      ctx.fillStyle = "rgba(121,242,255,0.45)";
      ctx.fillRect(66, -8 + r * 7 - (this.offset % 7), 28, 3);
    }
  };

  function EdoSignatureGate() {
    this.gate = 0;
  }
  EdoSignatureGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 280;
    drawRR(ctx, -12, 66, 24, 30, 4, C.nodeBg, C.outline);
    ctx.fillStyle = "#a7f3d0";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("УПД", 0, 72);
    if (prg > 90 && prg < 150) {
      ctx.strokeStyle = C.green;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.moveTo(-4, 78);
      ctx.lineTo(0, 82);
      ctx.lineTo(8, 74);
      ctx.stroke();
    }
  };

  function CrmStatusOrb() {
    this.angle = 0;
  }
  CrmStatusOrb.prototype.draw = function (ctx) {
    this.angle += 0.018;
    var ox = -80 + Math.cos(this.angle) * 6;
    var oy = Math.sin(this.angle) * 6;
    drawRR(ctx, ox - 14, oy - 14, 28, 28, 14, "rgba(139,92,246,0.22)", "#a78bfa");
    ctx.fillStyle = "#ddd6fe";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM", ox, oy + 3);
  };

  function DiscrepancyBeacon() {
    this.flash = 0;
  }
  DiscrepancyBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 280;
    if (prg < 100 || prg > 248) return;
    this.flash = 0.4 + Math.sin(frame * 0.25) * 0.35;
    ctx.save();
    ctx.globalAlpha = this.flash;
    ctx.fillStyle = C.amber;
    ctx.beginPath();
    ctx.moveTo(52, -52);
    ctx.lineTo(60, -38);
    ctx.lineTo(44, -38);
    ctx.closePath();
    ctx.fill();
    ctx.fillStyle = "#1a1200";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("!", 52, -42);
    ctx.restore();
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var prg = (frame * 0.034) % 280;
    var isMoving = false;
    var hubTargets = {
      "1_architect": { x: -28, y: -12 },
      "2_seo": { x: 28, y: -12 },
      "3_coder": { x: 28, y: 14 },
      "4_designer": { x: -28, y: 14 },
      "5_deployer": { x: 0, y: 0 }
    };
    var tgt = hubTargets[this.role] || { x: 0, y: 0 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 16) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 16) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 16) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 195 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.4) * 1;
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 6;
      legL = Math.sin(wp) * 3.5;
      legR = Math.sin(wp + Math.PI) * 3.5;
    }
    drawRR(ctx, -7, -3 + Math.max(0, legL), 6, 10, 2, C.outline, null);
    drawRR(ctx, 1, -3 + Math.max(0, legR), 6, 10, 2, C.outline, null);
    drawRR(ctx, -10, -9 - bob, 20, 14, 4, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -18 - bob, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var stream = new PaymentPacketStream();
  var hub = new MonthEndReconciliationHub();

  entities.push(new InvoiceLedgerShelf());
  entities.push(stream);
  entities.push(new BankStatementTicker());
  entities.push(new EdoSignatureGate());
  entities.push(new CrmStatusOrb());
  entities.push(hub);
  entities.push(new DiscrepancyBeacon());
  entities.push(new Agent(-118, 62, C.agentYellow, "1_architect", 24, [
    "Правило ±3 дня по дате", "Карта источников 1С", "Регламент month-end"
  ]));
  entities.push(new Agent(-58, 78, C.agentGreen, "2_seo", 58, [
    "ИНН в справочнике", "Сумма ± копейки", "НДС 20% vs 22%"
  ]));
  entities.push(new Agent(0, 86, C.agentBlue, "3_coder", 102, [
    "NLP назначения платежа", "Fuzzy match УПД", "Webhook банка"
  ]));
  entities.push(new Agent(58, 78, C.agentPink, "4_designer", 148, [
    "Красный флаг до НДС", "UI бухгалтера", "Human-in-the-loop"
  ]));
  entities.push(new Agent(118, 62, C.agentPurple, "5_deployer", 198, [
    "Печать «СХОДИТСЯ»", "Алерт в Telegram", "Audit log 152-ФЗ"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 220, maxLife: life || 220 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.034) % 280;
    if (prg >= 12 && prg < 12.05) createBubble(0, -92, "1. Счёт в очередь");
    if (prg >= 48 && prg < 48.05) createBubble(78, 0, "2. Платёж в выписке");
    if (prg >= 98 && prg < 98.05) createBubble(0, 78, "3. УПД из ЭДО");
    if (prg >= 138 && prg < 138.05) createBubble(-78, 0, "4. Статус CRM");
    if (prg >= 168 && prg < 168.05) createBubble(0, -20, "5. Хаб сверяет суммы");
    if (prg >= 248 && prg < 248.05) createBubble(44, -48, "6. Расхождение → review");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 16, 4, C.bubbleBg, C.gold);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
      ctx.fillText(b.text, b.x, b.y - 10);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(engineloop);
  } else {
    engineloop();
  }
});
</script>

<script>
(function(){
  'use strict';
  /* ROI sliders + canvas svsc-roi-calc */
  var docs=document.getElementById('svsc-roi-docs'),hours=document.getElementById('svsc-roi-hours'),
      rate=document.getElementById('svsc-roi-rate'),cost=document.getElementById('svsc-roi-cost'),
      saveEl=document.getElementById('svsc-roi-save'),payEl=document.getElementById('svsc-roi-payback'),
      cv=document.getElementById('svsc-roi-calc');
  if(!docs||!cv)return;
  var ctx=cv.getContext('2d');
  function fmt(n){return n.toLocaleString('ru-RU');}
  function calc(){
    var d=+docs.value,h=+hours.value,r=+rate.value,c=+cost.value;
    document.getElementById('svsc-roi-docs-val').textContent=d+' док./мес.';
    document.getElementById('svsc-roi-hours-val').textContent=h+' ч/мес.';
    document.getElementById('svsc-roi-rate-val').textContent=r+' ₽/час';
    document.getElementById('svsc-roi-cost-val').textContent=fmt(c)+' ₽';
    var reduction=0.65;
    var savedMonth=h*r*reduction;
    var savedYear=savedMonth*12;
    saveEl.textContent=fmt(Math.round(savedYear))+' ₽/год';
    var months=c>0?Math.max(1,Math.round(c/savedMonth)):0;
    payEl.textContent='Окупаемость: ~'+months+' мес. (экономия '+Math.round(reduction*100)+'% часов на сверке; ориентир, не гарантия)';
    drawChart(savedYear,c,h*r*12);
  }
  function drawChart(savedYear,implCost,manualYear){
    var wrap=document.getElementById('svsc-roi-calc-wrap');
    cv.width=wrap.clientWidth||400;cv.height=280;
    var W=cv.width,H=cv.height,p=40;
    ctx.clearRect(0,0,W,H);
    var max=Math.max(savedYear,manualYear,implCost)*1.15;
    var bw=(W-p*2)/3-16;
    var bars=[
      {label:'Ручной труд/год',val:manualYear,color:'#64748b'},
      {label:'Экономия/год',val:savedYear,color:'#22c55e'},
      {label:'Внедрение',val:implCost,color:'#f5c518'}
    ];
    bars.forEach(function(b,i){
      var x=p+i*((W-p*2)/3)+8;
      var bh=(H-p*2)*(b.val/max);
      var y=H-p-bh;
      ctx.fillStyle=b.color;
      ctx.fillRect(x,y,bw,bh);
      ctx.fillStyle='#e6edf7';
      ctx.font='11px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(b.label,x+bw/2,H-p+16);
      ctx.fillText(fmt(Math.round(b.val)),x+bw/2,y-6);
    });
  }
  ['input','change'].forEach(function(ev){
    docs.addEventListener(ev,calc);hours.addEventListener(ev,calc);
    rate.addEventListener(ev,calc);cost.addEventListener(ev,calc);
  });
  window.addEventListener('resize',calc);
  calc();
  /* FAQ accordion */
  document.querySelectorAll('.svsc-faq-q').forEach(function(q){
    q.addEventListener('click',function(){
      var item=q.parentElement;
      var open=item.classList.contains('open');
      document.querySelectorAll('.svsc-faq-item.open').forEach(function(el){el.classList.remove('open');el.querySelector('.svsc-faq-q').setAttribute('aria-expanded','false');});
      if(!open){item.classList.add('open');q.setAttribute('aria-expanded','true');}
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-sverka-schetov-page') || document.querySelector('.svsc-content');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -6% 0px' });
    items.forEach(function(item){ observer.observe(item); });
  } else {
    items.forEach(function(item){ item.classList.add('nero-ai-active'); });
  }
})();
</script>


<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

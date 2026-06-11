<?php
/**
 * Template Name: AI-закупки под ключ: агент для сравнения поставщиков
 * Description: SEO-лендинг — внедрение AI-агента для закупок. Матрица сравнения поставщиков, кейсы, цены.
 */

$page_seo_title       = 'AI-закупки под ключ: агент для сравнения поставщиков';
$page_seo_description = 'Внедрим AI-агента для закупок: сбор КП из почты, CRM и таблиц, сравнение поставщиков по цене, срокам и условиям. Матрица закупок под ключ для производства, e-commerce и HoReCa.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Матрица', 'href' => '#matrica'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать матрицу закупок';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#kak-rabotaet';

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
/* ── vnedrenie-ai-zakupki: Kadence reset + breadcrumbs hide ── */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }
.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs, .yoast-breadcrumb,
.entry-header, .page-title-section { display: none !important; }
#primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}
.vnedrenie-ai-zakupki-page .vzak-hero-zakupki.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
}
.vnedrenie-ai-zakupki-page .ym-cta-block__icon { font-size: 36px; margin-bottom: 14px; }
.vnedrenie-ai-zakupki-page .ym-btn {
  display: inline-flex; align-items: center; justify-content: center;
  padding: 13px 28px; border-radius: 999px; font-size: 15px; font-weight: 700;
  text-decoration: none !important; transition: transform .2s, box-shadow .2s;
}
.vnedrenie-ai-zakupki-page .ym-btn--accent,
.vnedrenie-ai-zakupki-page .nero-ai-home-page .ym-btn--accent {
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  color: #fff !important;
  box-shadow: 0 8px 32px rgba(59, 130, 246, .35);
}
.vnedrenie-ai-zakupki-page .ym-btn--ghost {
  background: rgba(255, 255, 255, .07);
  border: 1px solid rgba(255, 255, 255, .14);
  color: #e6edf7 !important;
}
.vnedrenie-ai-zakupki-page .nero-ai-reveal {
  opacity: 0; transform: translateY(22px);
  transition: opacity .55s ease, transform .55s ease;
}
.vnedrenie-ai-zakupki-page .nero-ai-reveal.nero-ai-active {
  opacity: 1; transform: none;
}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-zakupki-page" role="main" tabindex="-1">

<section class="nero-ai-hero vzak-hero-zakupki" id="vzak-hero-zakupki" aria-labelledby="vzak-hero-title">
<style>
/* ── Hero AI-закупки: самодостаточные стили (Kadence / .nero-ai-home-page) ── */
.vzak-hero-zakupki {
  --vzak-amber: #fbbf24;
  --vzak-green: #22c55e;
  --vzak-emerald: #34d399;
  --vzak-violet: #8b5cf6;
  --vzak-text: #e6edf7;
  --vzak-muted: #9aa8bd;
  --vzak-soft: #c7d2e5;
  --vzak-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vzak-hero-zakupki.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vzak-hero-zakupki::before {
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
  z-index: -2;
}
.vzak-hero-zakupki::after {
  content: "";
  position: absolute;
  left: 58%;
  top: 14%;
  width: 760px;
  height: 760px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(251, 191, 36, .11), rgba(139, 92, 246, .06) 45%, transparent 66%);
  filter: blur(6px);
  animation: vzakHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vzakHeroGlow {
  from { opacity: .42; transform: translateX(-50%) scale(.95); }
  to { opacity: .82; transform: translateX(-50%) scale(1.05); }
}
.vzak-hero-zakupki .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vzak-hero-zakupki .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vzak-hero-zakupki .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.6vw, 70px);
  line-height: .96;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vzak-hero-zakupki .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vzak-amber) 38%, var(--vzak-emerald) 72%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vzak-hero-zakupki .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(251, 191, 36, 0.22);
  border-radius: 999px;
  background: rgba(251, 191, 36, 0.08);
  color: var(--vzak-amber) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vzak-hero-zakupki .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vzak-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vzak-hero-zakupki .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vzak-hero-zakupki .nero-ai-badge {
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
.vzak-hero-zakupki .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vzak-hero-zakupki .nero-ai-btn {
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
.vzak-hero-zakupki .nero-ai-btn:hover { transform: translateY(-2px); }
.vzak-hero-zakupki .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vzak-amber), var(--vzak-emerald));
  box-shadow: 0 18px 42px rgba(251, 191, 36, 0.22);
}
.vzak-hero-zakupki .nero-ai-btn-secondary {
  color: var(--vzak-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vzak-hero-zakupki .nero-ai-lead-magnet {
  margin: 16px 0 0;
  font-size: 13px;
  line-height: 1.5;
  color: var(--vzak-muted);
  max-width: 560px;
}
.vzak-hero-zakupki .nero-ai-lead-magnet strong {
  color: var(--vzak-emerald);
  font-weight: 700;
}
.vzak-hero-zakupki .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vzak-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vzak-hero-zakupki .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vzak-hero-zakupki .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vzak-hero-zakupki .nero-ai-dots { display: flex; gap: 7px; }
.vzak-hero-zakupki .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vzak-hero-zakupki .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vzak-hero-zakupki .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vzak-hero-zakupki .nero-ai-dot:nth-child(3) { background: #34d399; }
.vzak-hero-zakupki .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vzak-hero-zakupki .nero-ai-window-body { padding: 16px; }
.vzak-hero-zakupki .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vzak-hero-zakupki .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vzak-hero-zakupki .nero-ai-live-pill {
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
.vzak-hero-zakupki .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vzakPulse 1.6s infinite;
}
@keyframes vzakPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vzak-hero-zakupki .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vzak-hero-zakupki .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vzak-hero-zakupki .nero-ai-metric span {
  display: block;
  color: var(--vzak-muted);
  font-size: 11px;
  font-weight: 700;
}
.vzak-hero-zakupki .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vzak-hero-zakupki .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vzak-hero-zakupki .vzak-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(251, 191, 36, 0.16);
  background: radial-gradient(ellipse at 50% 42%, rgba(251,191,36,.07), rgba(6,10,24,.92) 72%);
}
.vzak-hero-zakupki #vzak-procurement-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vzak-hero-zakupki .nero-ai-task-stream { display: grid; gap: 8px; }
.vzak-hero-zakupki .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vzak-hero-zakupki .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(251,191,36,.12);
  color: var(--vzak-amber);
  font-size: 13px;
  font-weight: 800;
}
.vzak-hero-zakupki .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vzak-hero-zakupki .nero-ai-task span {
  color: var(--vzak-muted);
  font-size: 11px;
}
.vzak-hero-zakupki .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vzak-hero-zakupki .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vzak-hero-zakupki .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vzak-hero-zakupki .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vzak-hero-zakupki .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vzak-hero-zakupki .nero-ai-window-body { padding: 12px; }
  .vzak-hero-zakupki .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vzak-hero-zakupki .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Закупки / снабжение · внедрение под ключ</p>
      <h1 id="vzak-hero-title">AI-агент для подбора поставщиков и сравнения цен: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Соберём AI-агента, который сам собирает коммерческие предложения и сравнивает поставщиков по цене, срокам и условиям — без хаоса в переписках и Excel</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Сбор КП из почты</li>
        <li class="nero-ai-badge">Сравнение цен и MOQ</li>
        <li class="nero-ai-badge">Матрица поставщиков</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Собрать матрицу закупок</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
      <p class="nero-ai-lead-magnet">На выходе аудита — шаблон <strong>«Матрица сравнения поставщиков»</strong> под ваши категории</p>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-закупок и матрицы поставщиков">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Центр закупок · матрица поставщиков</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>КП в обработке</span>
              <strong>12</strong>
              <small>PDF · Excel · почта</small>
            </div>
            <div class="nero-ai-metric">
              <span>Поставщиков в сравнении</span>
              <strong>5</strong>
              <small>категория «упаковка»</small>
            </div>
            <div class="nero-ai-metric">
              <span>Автозаполнение матрицы</span>
              <strong>87%</strong>
              <small>без ручного переноса</small>
            </div>
            <div class="nero-ai-metric">
              <span>Время на тендер</span>
              <strong>4 ч</strong>
              <small>было 3 дня</small>
            </div>
          </div>

          <div class="vzak-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vzak-procurement-canvas" role="img" aria-label="Анимация: коммерческие предложения по орбитам сходятся к ядру сравнения и формируют матрицу поставщиков"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий закупок">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">PDF</span>
              <div><strong>Парсинг КП «ООО Снаб»</strong><span>Извлечено: цена/кг, MOQ 500</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↻</span>
              <div><strong>Нормализация MOQ</strong><span>₽/упаковка → ₽/кг для сравнения</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Флаг: нет срока поставки</strong><span>Поставщик «ТоргСнаб» · уточнение</span></div>
              <span class="nero-ai-status nero-ai-status--amber">риск</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Строка матрицы обновлена</strong><span>TCO лидер: Поставщик Б</span></div>
              <span class="nero-ai-status">матрица</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">👤</span>
              <div><strong>Human review</strong><span>confidence 0.72 · ячейка «отсрочка»</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vnec-content vzak-content">

<style>
/* ── Лонгрид vnedrenie-ai-zakupki: scoped в .vzak-content ── */
.vzak-content{
  --vnec-surface:rgba(255,255,255,.055);
  --vnec-text:#e6edf7;--vnec-muted:#9aa8bd;--vnec-soft:#c7d2e5;--vnec-heading:#fff;
  --vnec-border:rgba(255,255,255,.10);--vnec-accent:#79f2ff;--vnec-violet:#8b5cf6;--vnec-green:#22c55e;
  --vnec-btn-from:#2563eb;--vnec-btn-to:#7c3aed;--vnec-r:18px;--vnec-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnec-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vzak-content *,.vzak-content *::before,.vzak-content *::after{box-sizing:border-box}
.vzak-content a{color:inherit}
.vzak-content p{color:var(--vnec-muted);line-height:1.72;margin:0 0 1em}
.vzak-content p:last-child{margin-bottom:0}
.vzak-content h2,.vzak-content h3,.vzak-content h4{color:var(--vnec-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vzak-content strong{color:var(--vnec-soft)}
.vzak-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vzak-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vnec-muted);font-size:14.5px;line-height:1.65}
.vzak-content ul li::before{content:'›';position:absolute;left:0;color:var(--vnec-accent);font-weight:700}
.vzak-content .vnec-cnt{width:min(var(--vnec-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vzak-content .vnec-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vzak-content .vnec-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vzak-content .vnec-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vzak-content .vnec-sh.vnec-left{margin-left:0;text-align:left}
.vzak-content .vnec-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vzak-content .vnec-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vzak-content .vnec-sh.vnec-left p{margin-left:0}
.vzak-content .vnec-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnec-accent);margin-bottom:14px}
.vzak-content .vnec-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vzak-content .vnec-pain-row{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:28px}
.vzak-content .vnec-pain-card{padding:18px 16px;border-radius:16px;background:rgba(251,113,133,.08);border:1px solid rgba(251,113,133,.22);text-align:center}
.vzak-content .vnec-pain-card strong{display:block;font-size:clamp(22px,3vw,32px);color:#fda4af;margin-bottom:6px}
.vzak-content .vnec-pain-card span{font-size:13px;color:var(--vnec-muted)}
@media(max-width:700px){.vzak-content .vnec-pain-row{grid-template-columns:1fr}}
.vzak-content .vnec-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vzak-content .vnec-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vzak-content .vnec-toc a{display:inline-block;padding:9px 18px;background:var(--vnec-surface);border:1px solid var(--vnec-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vnec-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vzak-content .vnec-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vnec-accent);background:rgba(121,242,255,.08)}
.vzak-content .vnec-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vnec-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.vzak-content .vnec-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.vzak-content .vnec-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vzak-content .vnec-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.vzak-content .vnec-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
@media(max-width:768px){.vzak-content .vnec-grid-2,.vzak-content .vnec-grid-3,.vzak-content .vnec-grid-4{grid-template-columns:1fr}}
@media(max-width:960px){.vzak-content .vnec-grid-3,.vzak-content .vnec-grid-4{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vzak-content .vnec-grid-3,.vzak-content .vnec-grid-4{grid-template-columns:1fr}}
.vzak-content .vnec-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0;-webkit-overflow-scrolling:touch}
.vzak-content .vnec-table{width:100%;border-collapse:collapse;font-size:14px;min-width:640px}
.vzak-content .vnec-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vnec-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.vzak-content .vnec-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vnec-text);vertical-align:top}
.vzak-content .vnec-table tr:last-child td{border-bottom:none}
.vzak-content .vnec-table tr:hover td{background:rgba(255,255,255,.03)}
.vzak-content .vnec-table .hl-tco{background:rgba(34,197,94,.12);font-weight:700;color:var(--vnec-green)}
.vzak-content .vnec-table .hl-conf{background:rgba(139,92,246,.12);color:#c4b5fd}
.vzak-content .vnec-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vzak-content .vnec-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vnec-accent);border:1px solid rgba(121,242,255,.2)}
.vzak-content .vnec-flow .arr{color:var(--vnec-muted);font-size:16px;padding:0 4px;background:none;border:none}
.vzak-content .vnec-steps{display:grid;grid-template-columns:repeat(6,1fr);gap:10px;margin:28px 0}
.vzak-content .vnec-step{padding:14px 12px;border-radius:14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);text-align:center;font-size:12px;font-weight:600;color:var(--vnec-muted)}
.vzak-content .vnec-step strong{display:block;font-size:18px;color:var(--vnec-accent);margin-bottom:6px}
@media(max-width:900px){.vzak-content .vnec-steps{grid-template-columns:repeat(3,1fr)}}
@media(max-width:500px){.vzak-content .vnec-steps{grid-template-columns:1fr 1fr}}
.vzak-content .vnec-timeline{position:relative;padding-left:40px}
.vzak-content .vnec-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vnec-accent),var(--vnec-violet));opacity:.35;border-radius:2px}
.vzak-content .vnec-tl-item{position:relative;margin-bottom:32px}
.vzak-content .vnec-tl-item:last-child{margin-bottom:0}
.vzak-content .vnec-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vnec-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vzak-content .vnec-tl-item h3{font-size:17px;margin-bottom:8px}
.vzak-content .vnec-tl-item p{font-size:14.5px;margin:0}
.vzak-content .vnec-pullquote{margin:32px 0;padding:24px 28px;border-left:4px solid var(--vnec-violet);background:rgba(139,92,246,.08);border-radius:0 16px 16px 0;font-size:16px;font-style:italic;color:var(--vnec-soft)}
.vzak-content .vnec-pullquote cite{display:block;margin-top:10px;font-size:13px;font-style:normal;color:var(--vnec-muted)}
.vzak-content .vnec-chips{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin:24px 0}
.vzak-content .vnec-chip{padding:10px 16px;border-radius:999px;font-size:13px;font-weight:700;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:var(--vnec-soft)}
.vzak-content .vnec-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vzak-content .vnec-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vzak-content .vnec-case-grid{grid-template-columns:1fr}}
.vzak-content .vnec-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px}
.vzak-content .vnec-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnec-green);margin-bottom:10px}
.vzak-content .vnec-case-card h3{font-size:16px;margin-bottom:14px}
.vzak-content .vnec-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px}
.vzak-content .vnec-metric .num{font-size:20px;font-weight:900;color:var(--vnec-accent)}
.vzak-content .vnec-metric .lbl{font-size:13px;color:var(--vnec-muted)}
.vzak-content .vnec-price-tier{padding:28px;border-radius:22px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);text-align:center}
.vzak-content .vnec-price-tier.featured{border-color:rgba(121,242,255,.4);background:linear-gradient(180deg,rgba(121,242,255,.1),rgba(255,255,255,.04))}
.vzak-content .vnec-price-tier .price{font-size:clamp(24px,3vw,32px);font-weight:900;color:#fff;margin:12px 0}
.vzak-content .vnec-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vzak-content .vnec-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vzak-content .vnec-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnec-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.vzak-content .vnec-faq-q::after{content:'▾';font-size:13px;color:var(--vnec-accent);flex-shrink:0;transition:transform .25s}
.vzak-content .vnec-faq-item.open .vnec-faq-q::after{transform:rotate(180deg)}
.vzak-content .vnec-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vnec-muted);line-height:1.72}
.vzak-content .vnec-faq-item.open .vnec-faq-a{max-height:900px;padding:0 24px 20px}
.vzak-content .vnec-callout{margin-top:24px;padding:20px 24px;border-radius:16px;background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.25);text-align:center;font-size:15px;color:var(--vnec-soft)}
.vzak-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.vzak-content .ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.vzak-content .ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.vzak-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.vzak-content .ym-cta-block__sub{color:var(--vnec-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.vzak-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.vzak-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.vzak-content .ym-link--accent{color:var(--vnec-accent)!important;text-decoration:underline!important}
.vzak-content .vnec-industry-icon{font-size:28px;margin-bottom:12px}
</style>

  <!-- 1. INTRO -->
  <section class="vnec-intro" id="intro" aria-label="Введение">
    <div class="vnec-cnt">
      <p class="vnec-eyebrow">Лонгрид · AI-закупки под ключ</p>
      <p><strong>Коротко:</strong> AI-закупки — это не чат с нейросетью, а связка модулей, которая собирает коммерческие предложения из почты, CRM и таблиц, нормализует условия и строит матрицу сравнения поставщиков. Nero Network внедряет такого агента под ключ: от аудита процесса до рабочей матрицы закупок за 4–8 недель.</p>
      <p>Поставщиков сравнивают вручную. Условия теряются в переписках. Цена в одном КП указана за килограмм, в другом — за упаковку, третий прислал скан без срока поставки. По оценке Epsilon Metrics, до <strong>80% времени</strong> специалистов по снабжению уходит на механику — при этом около <strong>30% ошибок</strong> возникает на этапе консолидации в Excel.</p>
      <div class="vnec-pain-row" aria-label="Ключевые боли закупок">
        <div class="vnec-pain-card"><strong>80%</strong><span>времени на рутину сбора КП</span></div>
        <div class="vnec-pain-card"><strong>30%</strong><span>ошибок при ручном сведении</span></div>
        <div class="vnec-pain-card"><strong>∞</strong><span>условий теряется в переписках</span></div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <div class="vnec-toc-outer">
    <div class="vnec-cnt">
      <nav class="vnec-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#matrica">Матрица</a>
        <a href="#etapy">Этапы</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- 2. ОПРЕДЕЛЕНИЕ -->
  <section class="vnec-section" id="opredelenie">
    <div class="vnec-cnt">
      <div class="vnec-sh vnec-left">
        <span class="vnec-eyebrow">Термины</span>
        <h2>AI-закупки, автоматизация закупок и S2P-система</h2>
        <p>Три разных уровня решений — и почему для среднего бизнеса достаточно лёгкого AI-агента.</p>
      </div>
      <div class="vnec-grid-3">
        <div class="vnec-card">
          <h3>AI-закупки</h3>
          <p>LLM + OCR + оркестрация агентов: парсинг КП, нормализация номенклатуры, приведение цен к сопоставимому виду (цена за единицу, TCO), матрица сравнения поставщиков.</p>
        </div>
        <div class="vnec-card">
          <h3>Автоматизация закупок</h3>
          <p>Электронные заявки, согласования, интеграция с 1С — без обязательного AI-парсинга неструктурированных КП в PDF и сканах.</p>
        </div>
        <div class="vnec-card">
          <h3>S2P-система</h3>
          <p>Enterprise-платформы Coupa, GEP SMART, SAP Ariba: внедрение 12+ месяцев, бюджет от сотен тысяч долларов. Для «5 поставщиков в Excel» — избыточно.</p>
        </div>
      </div>
      <div class="vnec-callout">Угол Nero Network — <strong>лёгкий AI-агент под ваш регламент</strong> за 180–600 тыс. ₽, а не годовой enterprise-проект.</div>
    </div>
  </section>

  <!-- 3. КОМУ ВЫГОДНО -->
  <section class="vnec-section vnec-section-alt" id="komu-vygodno">
    <div class="vnec-cnt">
      <div class="vnec-sh">
        <span class="vnec-eyebrow">Целевая аудитория</span>
        <h2>Что такое AI-закупки и кому это выгодно</h2>
        <p>Агент берёт на себя механику сбора и сведения КП, человек принимает финальное решение. Окупается там, где регулярно сравнивают 3–15 поставщиков по десяткам параметров.</p>
      </div>
      <div class="vnec-grid-4">
        <div class="vnec-card">
          <div class="vnec-industry-icon" aria-hidden="true">🏭</div>
          <h3>Производство и опт</h3>
          <p>КП в PDF, Word, Excel и на сканах. Разные единицы, MOQ, сроки отгрузки — AI нормализует позиции и флаги рисков. Кейс Epsilon Metrics: −95% времени на рутину (заявлено интегратором).</p>
        </div>
        <div class="vnec-card">
          <div class="vnec-industry-icon" aria-hidden="true">🛒</div>
          <h3>E-commerce</h3>
          <p>Сотни SKU, сезонные прайсы, FBO/FBS. Агент сводит КП дистрибьюторов — видно, где маржа съедается неочевидными условиями.</p>
        </div>
        <div class="vnec-card">
          <div class="vnec-industry-icon" aria-hidden="true">🍽</div>
          <h3>HoReCa</h3>
          <p>Food cost: прайсы в разных форматах, отсрочка и срок годности. Сравнительная таблица по точкам сети, а не переписка шеф-повара.</p>
        </div>
        <div class="vnec-card">
          <div class="vnec-industry-icon" aria-hidden="true">📦</div>
          <h3>МСБ</h3>
          <p>Старт с одного канала — почта или Telegram-бот — и Google Sheets как «живой» матрицы. Один специалист обслуживает больше категорий.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. КАК РАБОТАЕТ (+ БОРИС) -->
  <section class="vnec-section" id="kak-rabotaet">
    <div class="vnec-cnt">
      <div class="vnec-sh">
        <span class="vnec-eyebrow">Пайплайн</span>
        <h2>Как AI-агент собирает и сравнивает предложения поставщиков</h2>
        <p>Цепочка модулей: ingest → document AI → normalization → comparison engine → supplier hub. Финальный выбор поставщика — <strong>только человек</strong>.</p>
      </div>
      <div class="vnec-steps" aria-label="6 шагов работы агента">
        <div class="vnec-step"><strong>1</strong>Заявка закупщика</div>
        <div class="vnec-step"><strong>2</strong>Рассылка RFP / мониторинг</div>
        <div class="vnec-step"><strong>3</strong>Парсинг КП</div>
        <div class="vnec-step"><strong>4</strong>Нормализация</div>
        <div class="vnec-step"><strong>5</strong>Матрица + флаги</div>
        <div class="vnec-step"><strong>6</strong>Human review</div>
      </div>
      <div class="vnec-flow" aria-label="Схема потока закупок">
        <span>КП из почты</span><span class="arr">→</span>
        <span>OCR + LLM</span><span class="arr">→</span>
        <span>Цена за ед. + MOQ</span><span class="arr">→</span>
        <span>TCO</span><span class="arr">→</span>
        <span>Матрица</span>
      </div>
    </div>

<!-- ═══ БОРИС: визуальный блок (НЕ hero) ═══ -->
<section id="vnedrenie-ai-zakupki-boris-block" class="bzak-root" aria-label="Анимация: документы КП превращаются в строки матрицы сравнения поставщиков">
<style>
#vnedrenie-ai-zakupki-boris-block.bzak-root{
  padding:clamp(40px,5vw,56px) 0 clamp(48px,6vw,64px);
  background:#f1f5f9;
  border-top:1px solid rgba(148,163,184,.25);
  border-bottom:1px solid rgba(148,163,184,.25);
}
#vnedrenie-ai-zakupki-boris-block .bzak-cnt{
  max-width:1160px;margin:0 auto;padding:0 clamp(16px,3vw,24px);
}
#vnedrenie-ai-zakupki-boris-block .bzak-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:min(520px,70vh);
}
@media(max-width:1023px){
  #vnedrenie-ai-zakupki-boris-block .bzak-card{grid-template-columns:1fr;min-height:auto;}
}
#vnedrenie-ai-zakupki-boris-block .bzak-lft{
  padding:clamp(24px,4vw,36px) clamp(20px,3vw,32px);
  display:flex;flex-direction:column;justify-content:center;
  background:linear-gradient(135deg,#fff 0%,#f8fafc 100%);
  border-right:1px solid rgba(226,232,240,.9);
}
@media(max-width:1023px){
  #vnedrenie-ai-zakupki-boris-block .bzak-lft{border-right:none;border-bottom:1px solid rgba(226,232,240,.9);}
}
#vnedrenie-ai-zakupki-boris-block .bzak-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;
  color:#0ea5e9;margin-bottom:12px;
}
#vnedrenie-ai-zakupki-boris-block .bzak-ey::before{
  content:'';width:8px;height:8px;border-radius:50%;
  background:#22c55e;box-shadow:0 0 0 3px rgba(34,197,94,.25);
  animation:bzakPulse 2s ease-in-out infinite;
}
@keyframes bzakPulse{0%,100%{opacity:1}50%{opacity:.5}}
#vnedrenie-ai-zakupki-boris-block .bzak-h3{
  margin:0 0 16px;font-size:clamp(20px,2.4vw,26px);line-height:1.2;
  letter-spacing:-.03em;color:#0f172a;font-weight:800;
}
#vnedrenie-ai-zakupki-boris-block .bzak-ul{
  list-style:none;margin:0 0 20px;padding:0;
}
#vnedrenie-ai-zakupki-boris-block .bzak-ul li{
  display:flex;align-items:flex-start;gap:10px;
  margin-bottom:10px;font-size:14px;line-height:1.55;color:#475569;
}
#vnedrenie-ai-zakupki-boris-block .bzak-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:6px;
  background:#e0f2fe;color:#0284c7;font-size:11px;font-weight:800;
  display:flex;align-items:center;justify-content:center;
}
#vnedrenie-ai-zakupki-boris-block .bzak-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px}
#vnedrenie-ai-zakupki-boris-block .bzak-pl{
  padding:6px 12px;border-radius:999px;font-size:11.5px;font-weight:700;
}
#vnedrenie-ai-zakupki-boris-block .bzak-pl-g{background:#dcfce7;color:#15803d}
#vnedrenie-ai-zakupki-boris-block .bzak-pl-b{background:#dbeafe;color:#1d4ed8}
#vnedrenie-ai-zakupki-boris-block .bzak-pl-a{background:#fef3c7;color:#b45309}
#vnedrenie-ai-zakupki-boris-block .bzak-foot{
  margin:0;font-size:13px;color:#64748b;font-style:italic;
}
#vnedrenie-ai-zakupki-boris-block .bzak-rgt{
  position:relative;min-height:400px;background:#f8fafc;
}
@media(max-width:1023px){#vnedrenie-ai-zakupki-boris-block .bzak-rgt{min-height:360px}}
#vnedrenie-ai-zakupki-boris-block canvas{
  display:block;width:100%;height:100%;min-height:400px;
}
</style>
<div class="bzak-cnt">
  <div class="bzak-card">
    <div class="bzak-lft">
      <span class="bzak-ey">Матрица в действии</span>
      <h3 class="bzak-h3">Из хаоса КП — в сопоставимые строки: цена, MOQ, TCO</h3>
      <ul class="bzak-ul">
        <li><span class="bzak-ic">PDF</span>Парсер извлекает поля из PDF, Word, Excel и сканов</li>
        <li><span class="bzak-ic">₽</span>Нормализация: 450 ₽/уп × 25 кг → 18 ₽/кг с учётом MOQ</li>
        <li><span class="bzak-ic">TCO</span>Движок считает полную стоимость: логистика, отсрочка, штрафы</li>
        <li><span class="bzak-ic">?</span>Низкий confidence — ячейка на ручную проверку закупщика</li>
      </ul>
      <div class="bzak-pills">
        <span class="bzak-pl bzak-pl-g">87% автозаполнение</span>
        <span class="bzak-pl bzak-pl-b">5 поставщиков</span>
        <span class="bzak-pl bzak-pl-a">флаг «нет срока»</span>
      </div>
      <p class="bzak-foot">Дальше разберём поля матрицы и единый формат КП →</p>
    </div>
    <div class="bzak-rgt">
      <canvas id="bzak-procurement-matrix-canvas" aria-label="Анимация: коммерческие предложения парсятся и заполняют строки матрицы сравнения поставщиков с TCO и confidence score" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bzak-procurement-matrix-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = Math.max(p.clientHeight || 0, 400);
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a', muted:'#64748b', line:'#e2e8f0',
    doc:'#fff', docBdr:'#cbd5e1', pdf:'#ef4444',
    hub:'#8b5cf6', hubGlow:'rgba(139,92,246,.2)',
    rowA:'#f0fdf4', rowB:'#eff6ff', rowHi:'#dcfce7',
    green:'#22c55e', blue:'#3b82f6', amber:'#f59e0b',
    bar:'#0ea5e9', conf:'#a78bfa'
  };

  var SUPPLIERS = [
    {name:'ООО «Снаб»', price:18.2, moq:500, tco:19.1, conf:0.94, best:false},
    {name:'Поставщик Б', price:17.5, moq:200, tco:18.8, conf:0.88, best:true},
    {name:'Дистри А', price:19.0, moq:100, tco:20.4, conf:0.72, best:false},
    {name:'ОптТорг', price:16.9, moq:800, tco:19.6, conf:0.91, best:false},
    {name:'Регион С', price:18.8, moq:300, tco:19.2, conf:0.85, best:false}
  ];

  var docs = [];
  var particles = [];

  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.2; ctx.stroke(); }
  }

  function drawDoc(x,y,s,alpha,label){
    ctx.globalAlpha = alpha || 1;
    rr(x,y,s*0.7,s*0.9,4,C.doc,C.docBdr);
    ctx.fillStyle = C.pdf;
    ctx.font = 'bold ' + Math.max(8,s*0.18) + 'px Inter,sans-serif';
    ctx.fillText(label||'PDF', x+6, y+s*0.35);
    ctx.fillStyle = C.muted;
    ctx.font = Math.max(7,s*0.14) + 'px Inter,sans-serif';
    ctx.fillText('КП', x+6, y+s*0.55);
    ctx.globalAlpha = 1;
  }

  function drawHub(cx,cy,r,pulse){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
    g.addColorStop(0, C.hubGlow);
    g.addColorStop(1,'rgba(139,92,246,0)');
    ctx.fillStyle = g;
    ctx.beginPath(); ctx.arc(cx,cy,r*1.8,0,Math.PI*2); ctx.fill();
    ctx.fillStyle = C.hub;
    ctx.beginPath(); ctx.arc(cx,cy,r*(1+pulse*0.08),0,Math.PI*2); ctx.fill();
    ctx.fillStyle = '#fff';
    ctx.font = 'bold ' + Math.max(10,r*0.35) + 'px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI', cx, cy+r*0.12);
    ctx.textAlign = 'left';
  }

  function drawMatrix(mx,my,mw,mh,t){
    rr(mx,my,mw,mh,10,'#fff',C.line);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.fillText('Матрица сравнения · демо', mx+12, my+18);

    var cols = ['Поставщик','₽/кг','MOQ','TCO','conf.'];
    var colW = [mw*0.32, mw*0.14, mw*0.14, mw*0.14, mw*0.14];
    var hx = mx+10, hy = my+28;
    ctx.fillStyle = '#f1f5f9';
    rr(hx,hy,mw-20,22,6,'#f1f5f9',C.line);
    var cx = hx+6;
    cols.forEach(function(col,i){
      ctx.fillStyle = C.muted;
      ctx.font = '9px Inter,sans-serif';
      ctx.fillText(col, cx, hy+14);
      cx += colW[i];
    });

    var rowH = (mh-60) / SUPPLIERS.length;
    SUPPLIERS.forEach(function(s,i){
      var ry = my + 54 + i*rowH;
      var fill = s.best ? C.rowHi : (i%2 ? C.rowB : C.rowA);
      var prog = Math.min(1, Math.max(0, (t - i*18) / 40));
      if(prog <= 0) return;
      ctx.globalAlpha = prog;
      rr(hx, ry, mw-20, rowH-4, 4, fill, s.best ? C.green : C.line);

      var tx = hx+8;
      ctx.fillStyle = C.ink;
      ctx.font = (s.best?'bold ':'') + '10px Inter,sans-serif';
      ctx.fillText(s.name, tx, ry+rowH*0.55);
      tx += colW[0];
      ctx.fillStyle = s.best ? C.green : C.ink;
      ctx.fillText(s.price.toFixed(1), tx, ry+rowH*0.55);
      tx += colW[1];
      ctx.fillStyle = C.ink;
      ctx.fillText(s.moq+' кг', tx, ry+rowH*0.55);
      tx += colW[2];
      ctx.fillStyle = s.best ? C.green : C.ink;
      ctx.fillText(s.tco.toFixed(1), tx, ry+rowH*0.55);
      tx += colW[3];
      var confCol = s.conf < 0.8 ? C.amber : C.conf;
      ctx.fillStyle = confCol;
      ctx.fillText((s.conf*100).toFixed(0)+'%', tx, ry+rowH*0.55);

      if(s.best){
        ctx.fillStyle = C.green;
        ctx.font = '8px Inter,sans-serif';
        ctx.fillText('★ лучший TCO', hx+mw-90, ry+rowH*0.55);
      }
      ctx.globalAlpha = 1;
    });
  }

  function spawnDoc(){
    docs.push({
      x: -30,
      y: H*0.15 + Math.random()*H*0.5,
      phase: 0,
      speed: 1.4 + Math.random()*0.8,
      label: ['PDF','XLS','DOC'][Math.floor(Math.random()*3)]
    });
  }

  if(docs.length === 0) spawnDoc();

  function loop(){
    frame++;
    ctx.clearRect(0,0,W,H);

    var hubX = W*0.38, hubY = H*0.5, hubR = Math.min(W,H)*0.08;
    var matX = W*0.52, matY = H*0.12, matW = W*0.44, matH = H*0.76;
    var pulse = Math.sin(frame*0.04)*0.5+0.5;

    if(frame % 90 === 0 && docs.length < 4) spawnDoc();

    docs.forEach(function(d){
      if(d.phase === 0){
        d.x += d.speed;
        if(d.x > hubX - hubR - 10) d.phase = 1;
        drawDoc(d.x, d.y, 36, 1, d.label);
      } else if(d.phase === 1){
        d.t = (d.t||0) + 1;
        var ang = d.t * 0.08;
        var orbitR = hubR + 20;
        d.x = hubX + Math.cos(ang)*orbitR;
        d.y = hubY + Math.sin(ang)*orbitR*0.6;
        drawDoc(d.x-14, d.y-18, 28, 1-Math.min(d.t/30,0.7), d.label);
        if(d.t > 35){
          particles.push({x:hubX,y:hubY,tx:matX+matW*0.3,ty:matY+40+Math.random()*matH*0.7,t:0});
          d.phase = 2;
        }
      }
    });
    docs = docs.filter(function(d){ return d.phase < 2; });

    drawHub(hubX, hubY, hubR, pulse);

    particles.forEach(function(p){
      p.t++;
      var prog = Math.min(p.t/50, 1);
      var ease = 1 - Math.pow(1-prog, 3);
      var px = p.x + (p.tx-p.x)*ease;
      var py = p.y + (p.ty-p.y)*ease;
      ctx.fillStyle = C.bar;
      ctx.globalAlpha = 1-prog*0.3;
      ctx.beginPath(); ctx.arc(px,py,4,0,Math.PI*2); ctx.fill();
      ctx.globalAlpha = 1;
    });
    particles = particles.filter(function(p){ return p.t < 55; });

    drawMatrix(matX, matY, matW, matH, frame);

    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText('пример логики · демонстрационные данные', matX, matY+matH+14);

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>
<!-- ═══ /БОРИС ═══ -->

    <div class="vnec-cnt" style="padding-top:48px">
      <div class="vnec-sh vnec-left">
        <h3 id="cena-moq">Цена за единицу и MOQ</h3>
        <p>AI анализ предложений начинается с приведения цен к одной базе. Поставщик А — 450 ₽ за упаковку 25 кг, поставщик Б — 18 ₽/кг при MOQ 500 кг. Агент пересчитывает цену за килограмм и показывает реальную стоимость под ваш объём.</p>
      </div>
      <div class="vnec-grid-2">
        <div class="vnec-card">
          <h3>Сроки поставки и логистика</h3>
          <p>Агент извлекает срок, Incoterms, стоимость доставки — включает в TCO. Флаг «нет срока в КП» сразу виден; черновик уточняющего письма готовит агент.</p>
        </div>
        <div class="vnec-card">
          <h3>Оплата, отсрочка и штрафы</h3>
          <p>Условия, которые теряются в переписке чаще всего, фиксируются в структурированном виде. Для РФ на первом этапе — сбор и сравнение, не автономные переговоры.</p>
        </div>
      </div>
      <div class="vnec-card" style="margin-top:20px">
        <h3>Качество, сертификаты и риски</h3>
        <p>Наличие сертификатов, срок оффера, рейтинг контрагента. Подсветка: «просрочен оффер», «нет MOQ», «низкий confidence» — снижает ошибку при выборе. Финальное решение — за закупщиком.</p>
      </div>
    </div>
  </section>

  <!-- 5. МАТРИЦА -->
  <section class="vnec-section vnec-section-alt" id="matrica">
    <div class="vnec-cnt">
      <div class="vnec-sh">
        <span class="vnec-eyebrow">Лид-магнит</span>
        <h2>Матрица сравнения поставщиков: что входит</h2>
        <p>Центральный артефакт AI-закупок — рабочая таблица для закупщика и руководителя, не абстрактный отчёт.</p>
      </div>
      <div class="vnec-table-wrap">
        <table class="vnec-table" aria-label="Поля матрицы сравнения поставщиков">
          <thead>
            <tr>
              <th>Поле</th><th>Зачем</th>
              <th>Поле</th><th>Зачем</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Поставщик / ИНН</td><td>Идентификация</td><td>Цена за единицу</td><td>Сопоставимое сравнение</td></tr>
            <tr><td>MOQ</td><td>Порог заказа</td><td>Сумма заказа</td><td>Под ваш объём</td></tr>
            <tr><td>Срок поставки</td><td>Планирование</td><td>Условия оплаты</td><td>Cash flow</td></tr>
            <tr><td>Доставка, Incoterms</td><td>TCO</td><td>Штрафы</td><td>Риски</td></tr>
            <tr><td>Сертификаты</td><td>Регламент</td><td>Срок оффера</td><td>Актуальность КП</td></tr>
            <tr><td class="hl-tco">TCO</td><td class="hl-tco">Итоговое сравнение</td><td class="hl-conf">Confidence</td><td class="hl-conf">Надёжность AI</td></tr>
          </tbody>
        </table>
      </div>
      <p>AI-агент привязывает каждое КП к заявке, версионирует матрицу, уведомляет о новых предложениях и хранит историю для следующего тендера.</p>
    </div>
    <div class="vnec-cnt">
      <aside class="ym-cta-block ym-cta-block--primary" id="cta-matrica">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Собрать матрицу закупок под ваши категории</p>
          <p class="ym-cta-block__sub">На аудите разберём 1–2 реальные закупки, покажем на 3–5 КП, как агент нормализует цены и условия. На выходе — рабочий шаблон «Матрица сравнения поставщиков», а не презентация. Без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Собрать матрицу закупок</a>
        </div>
      </aside>
    </div>
  </section>

  <!-- 6. ЭТАПЫ -->
  <section class="vnec-section" id="etapy">
    <div class="vnec-cnt">
      <div class="vnec-sh">
        <span class="vnec-eyebrow">Под ключ</span>
        <h2>Внедрение AI закупки под ключ: этапы и сроки</h2>
        <p>От первого контакта до рабочей матрицы — <strong>4–8 недель</strong> в зависимости от интеграций.</p>
      </div>
      <div class="vnec-timeline">
        <div class="vnec-tl-item">
          <div class="vnec-tl-dot"></div>
          <h3>Аудит (3–5 дней)</h3>
          <p>1–2 реальные закупки «как есть»: откуда КП, сколько поставщиков, какие поля сравнивают, где Excel/CRM/1С.</p>
        </div>
        <div class="vnec-tl-item">
          <div class="vnec-tl-dot"></div>
          <h3>MVP (2–3 недели)</h3>
          <p>Один канал входа + Google Sheets как матрица + ручная валидация. Пилот на топ-50 позициях.</p>
        </div>
        <div class="vnec-tl-item">
          <div class="vnec-tl-dot"></div>
          <h3>Пилот на категории</h3>
          <p>Метрики: время на тендер, % автозаполнения, ошибки vs ручной процесс. Кейс AiST: 30 → 9–12 дней (заявлено вендором).</p>
        </div>
        <div class="vnec-tl-item">
          <div class="vnec-tl-dot"></div>
          <h3>Production (4–8 недель)</h3>
          <p>CRM, справочник номенклатуры, 1С, дашборд SLA, роли и аудит. Обучение: «что агент извлекает / что утверждает человек».</p>
        </div>
      </div>
      <blockquote class="vnec-pullquote">
        «Нельзя внедрять ИИ, когда внутри бардак» — сначала порядок в данных и процессе.
        <cite>Гагик Аветисян, директор по закупкам НСПК (VPROC 2026)</cite>
      </blockquote>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта проекта?</p>
          <p class="ym-cta-block__sub">Если закупщики и ИТ хотят разобраться в n8n, промптах и human-in-the-loop до пилота — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer">обучение по внедрению AI в бизнес-процессы</a>. Это ускоряет согласование регламента сравнения на этапе аудита.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- 7. ИНТЕГРАЦИИ -->
  <section class="vnec-section vnec-section-alt" id="integracii">
    <div class="vnec-cnt">
      <div class="vnec-sh">
        <span class="vnec-eyebrow">Стек</span>
        <h2>Интеграция с CRM, 1С, почтой и таблицами</h2>
        <p>Агент впишется в ежедневную работу — не останется отдельным сервисом.</p>
      </div>
      <div class="vnec-chips" aria-label="Интеграции">
        <span class="vnec-chip">📧 Email / IMAP</span>
        <span class="vnec-chip">📊 Google Sheets</span>
        <span class="vnec-chip">amoCRM</span>
        <span class="vnec-chip">Битрикс24</span>
        <span class="vnec-chip">1С / ERP</span>
        <span class="vnec-chip">Telegram-бот</span>
        <span class="vnec-chip">Make / n8n</span>
      </div>
      <div class="vnec-grid-2">
        <div class="vnec-card">
          <h3>Входящие КП из email</h3>
          <p>Триггер «новое письмо → парсинг вложения». Классификация: КП, счёт, спам, уточнение. Коробочный Openii строится вокруг парсера email + CRM + таблицы.</p>
        </div>
        <div class="vnec-card">
          <h3>CRM и таблицы</h3>
          <p>Сделка = закупка, поля матрицы в карточке. Excel/Sheets остаётся интерфейсом — агент автоматически актуализирует строки; закупщик правит спорные ячейки.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 8. КЕЙСЫ -->
  <section class="vnec-section" id="keisy">
    <div class="vnec-cnt">
      <div class="vnec-sh">
        <span class="vnec-eyebrow">ROI</span>
        <h2>Кейсы и ROI: экономия времени и денег на закупках</h2>
      </div>
      <div class="vnec-case-grid">
        <div class="vnec-case-card">
          <div class="vnec-case-tag">Производство</div>
          <h3>Epsilon Metrics</h3>
          <p>4 AI-агента: поиск, RFP, парсинг КП, переписка. Заявлено: −95% рутины, &gt;9 млн ₽/год.</p>
          <div class="vnec-metric"><span class="num">10×</span><span class="lbl">быстрее цикл закупки</span></div>
        </div>
        <div class="vnec-case-card">
          <div class="vnec-case-tag">Россия</div>
          <h3>«Новация»</h3>
          <p>Автозапросы, сравнительная таблица, 1С и Битрикс24. Цикл быстрее в 2–3 раза.</p>
          <div class="vnec-metric"><span class="num">−30%</span><span class="lbl">экономия (обзор)</span></div>
        </div>
        <div class="vnec-case-card">
          <div class="vnec-case-tag">Смежный</div>
          <h3>«Акрон Холдинг»</h3>
          <p>ИИ для ТЗ на закупки: с нескольких дней до минут. Закупки начинаются не с КП, а с ТЗ.</p>
          <div class="vnec-metric"><span class="num">400+</span><span class="lbl">ТЗ за 4 месяца</span></div>
        </div>
        <div class="vnec-case-card">
          <div class="vnec-case-tag">HoReCa</div>
          <h3>Food cost</h3>
          <p>Сравнение поставщиков продуктов с учётом срока годности и логистики на точки сети.</p>
          <div class="vnec-metric"><span class="num">2–3×</span><span class="lbl">быстрее цикл</span></div>
        </div>
        <div class="vnec-case-card">
          <div class="vnec-case-tag">E-commerce</div>
          <h3>SKU и маржа</h3>
          <p>Пересчёт закупочных цен при смене прайсов дистрибьюторов, FBO/FBS условия.</p>
          <div class="vnec-metric"><span class="num">часы</span><span class="lbl">вместо дней на тендер</span></div>
        </div>
        <div class="vnec-case-card">
          <div class="vnec-case-tag">Международный</div>
          <h3>Walmart + Pactum</h3>
          <p>Автономные переговоры — enterprise-эталон. Для РФ SMB: сначала сравнение КП, потом переговоры с human approval.</p>
          <div class="vnec-metric"><span class="num">~3%</span><span class="lbl">экономия (Pactum)</span></div>
        </div>
      </div>
      <p style="margin-top:24px;text-align:center;font-size:14px">Точные проценты Nero Network не гарантирует без пилота на ваших КП — фиксируем baseline на аудите.</p>
    </div>
  </section>

  <!-- 9. СРАВНЕНИЕ -->
  <section class="vnec-section vnec-section-alt" id="sravnenie">
    <div class="vnec-cnt">
      <div class="vnec-sh vnec-left">
        <span class="vnec-eyebrow">Выбор подхода</span>
        <h2>AI закупки vs готовые SaaS и ручной процесс</h2>
      </div>
      <div class="vnec-table-wrap">
        <table class="vnec-table" aria-label="Сравнение подходов к закупкам">
          <thead>
            <tr><th>Подход</th><th>Плюсы</th><th>Минусы</th><th>Кому подходит</th></tr>
          </thead>
          <tbody>
            <tr><td>Excel + почта</td><td>Бесплатно, привычно</td><td>30% ошибок, дни на сведение</td><td>1–2 закупки/мес</td></tr>
            <tr><td>Коробка (Openii, AiST)</td><td>Быстрый старт</td><td>Ограниченная кастомизация</td><td>Стандартный процесс</td></tr>
            <tr><td><strong>Кастом Nero</strong></td><td>Ваш регламент и стек</td><td>Проект 4–8 недель</td><td>SMB, производство, HoReCa</td></tr>
            <tr><td>Enterprise S2P</td><td>Source-to-Pay сквозной</td><td>12+ мес., $500K+</td><td>Корпорации</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vnec-grid-2" style="margin-top:24px">
        <div class="vnec-card">
          <h3>Риски парсинга и 152-ФЗ</h3>
          <p>Confidence score, валидация полей, лог извлечения. Облако vs on-prem (GigaChat, YandexGPT). Матрица — внутренний аналитический документ; договор оформляется отдельно.</p>
        </div>
        <div class="vnec-card">
          <h3>Когда нужен кастом</h3>
          <p>Нестандартная номенклатура, несколько юрлиц, связка Make + CRM + 1С + Telegram, human-in-the-loop с аудитом каждого поля.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 10. СТОИМОСТЬ -->
  <section class="vnec-section" id="ceny">
    <div class="vnec-cnt">
      <div class="vnec-sh">
        <span class="vnec-eyebrow">Бюджет</span>
        <h2>Стоимость внедрения и что входит в проект</h2>
        <p>Ориентир <strong>180–600 тыс. ₽</strong>. Openii — от 320 тыс. ₽; enterprise S2P — от сотен тысяч долларов.</p>
      </div>
      <div class="vnec-grid-3">
        <div class="vnec-price-tier">
          <h3>MVP</h3>
          <div class="price">180–300 тыс. ₽</div>
          <p>Email + таблица + базовый парсер КП, один регламент сравнения.</p>
        </div>
        <div class="vnec-price-tier featured">
          <h3>Стандарт</h3>
          <div class="price">300–450 тыс. ₽</div>
          <p>CRM, справочник номенклатуры, несколько категорий, дашборд.</p>
        </div>
        <div class="vnec-price-tier">
          <h3>Расширенный</h3>
          <div class="price">450–600 тыс. ₽</div>
          <p>1С/ERP, on-prem LLM, несколько юрлиц, расширенный аудит.</p>
        </div>
      </div>
      <div class="vnec-card" style="margin-top:24px">
        <h3>Что входит в типовой проект</h3>
        <ul>
          <li>Аудит процесса закупок и шаблон матрицы (лид-магнит)</li>
          <li>Настройка AI-агента и правил сравнения</li>
          <li>Интеграция с почтой, CRM, таблицами</li>
          <li>Пилот на одной категории + масштабирование</li>
          <li>Обучение закупщиков и регламент human-in-the-loop</li>
        </ul>
      </div>
      <div class="ym-cta-block ym-cta-block--dual" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы убрать хаос в сравнении поставщиков?</p>
          <p class="ym-cta-block__sub">Ориентир 180–600 тыс. ₽ за внедрение под ключ. На аудите «Собрать матрицу закупок» оценим сроки, интеграции и ROI на ваших КП — бесплатно.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Собрать матрицу закупок</a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Частые вопросы</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 11. FAQ -->
  <section class="vnec-section vnec-section-alt" id="faq">
    <div class="vnec-cnt">
      <div class="vnec-sh">
        <span class="vnec-eyebrow">Вопрос — ответ</span>
        <h2>FAQ по AI-закупкам</h2>
      </div>
      <div class="vnec-faq">
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько длится внедрение?</div><div class="vnec-faq-a"><p>От 4 до 8 недель: 3–5 дней аудит, 2–3 недели MVP, 4–8 недель production с интеграциями. Пилот на одной категории — за 2–3 недели после аудита.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли начать без замены Excel?</div><div class="vnec-faq-a"><p>Да. Excel или Google Sheets часто остаются интерфейсом матрицы. Агент автоматически заполняет таблицу; закупщик правит спорные ячейки.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Безопасны ли данные контрагентов?</div><div class="vnec-faq-a"><p>На аудите фиксируем политику ИБ: облачные API или контур клиента (GigaChat, YandexGPT, локальная LLM). Обработка по 152-ФЗ, доступ по ролям.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли агент закупщика?</div><div class="vnec-faq-a"><p>Нет. Агент снимает механику: парсинг, нормализация, сведение. Закупщик утверждает shortlist, валидирует спорные поля, ведёт переговоры и подписывает договор.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI закупки с минимальным риском?</div><div class="vnec-faq-a"><p>Пилот на 3–5 реальных КП в разных форматах. Сравните матрицу агента с ручной. Оцените % автозаполнения — затем масштабируйте.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли для малого бизнеса?</div><div class="vnec-faq-a"><p>Да, при 3–5 поставщиках на категорию и регулярных закупках. Старт с почты и таблицы — бюджет в нижней части диапазона 180–600 тыс. ₽.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от автоматизации в CRM?</div><div class="vnec-faq-a"><p>CRM автоматизирует статусы. AI-агент понимает неструктурированные КП в PDF и сканах, нормализует условия и считает TCO. Идеальная связка — интеграция с amoCRM или Битрикс24.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Нужна ли интеграция с 1С?</div><div class="vnec-faq-a"><p>Не обязательна на MVP, но полезна для сверки номенклатуры и контрагентов на этапе production.</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Примеры внедрения в России?</div><div class="vnec-faq-a"><p>Epsilon Metrics, «Новация», AiST, Openii, EFSOL. Международный референс — Walmart + Pactum (enterprise-уровень переговоров).</p></div></div>
        <div class="vnec-faq-item"><div class="vnec-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит поддержка после запуска?</div><div class="vnec-faq-a"><p>Зависит от SLA и доработок парсера под новые форматы КП. На этапе сметы фиксируем гарантийный период и опцию абонентского сопровождения.</p></div></div>
      </div>
    </div>
  </section>

  <!-- 12. ИТОГ -->
  <section class="vnec-section" id="itog" style="background:linear-gradient(135deg,rgba(121,242,255,.06),rgba(139,92,246,.06));">
    <div class="vnec-cnt" style="text-align:center;max-width:760px">
      <span class="vnec-eyebrow">Итог</span>
      <h2 style="font-size:clamp(26px,4vw,42px)">От хаоса КП к прозрачной матрице поставщиков</h2>
      <p style="font-size:16px;margin-bottom:24px">Nero Network внедряет AI-агента под ваш регламент: сбор предложений, нормализация условий, сравнение по цене, срокам, MOQ, оплате и логистике — с human-in-the-loop на каждом критичном шаге. Для среднего бизнеса в России выигрывает <strong>кастомный агент + почта + CRM + таблица</strong> за 4–8 недель.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Собрать матрицу закупок</a>
    </div>
  </section>

</div><!-- /.vnec-content -->

  <!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * vzak-procurement-engine — Диспетчерская сравнения закупок
 * Мир: КП по орбитам → ядро матрицы → TCO + human-review
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vzak-procurement-canvas");
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
    cy = ch / 2 + 8;
    scale = Math.min(cw / 420, ch / 280) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    kpPdf: "#fef3c7",
    kpXls: "#d1fae5",
    kpScan: "#e0e7ff",
    orbit: "rgba(251,191,36,0.20)",
    orbitInner: "rgba(52,211,153,0.28)",
    matrixBase: "#1e293b",
    matrixAccent: "#fbbf24",
    matrixGreen: "#22c55e",
    matrixViolet: "#8b5cf6",
    flagAmber: "#f59e0b",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#fde68a"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Орбиты КП — транспорт (не Conveyor) */
  function QuotationOrbitRing() {
    this.phase = 0;
  }
  QuotationOrbitRing.prototype.draw = function (ctx) {
    this.phase = (frame * 0.022) % (Math.PI * 2);
    var orbits = [
      { rx: 125, ry: 52, offset: 0, speed: 1 },
      { rx: 98, ry: 38, offset: 1.8, speed: 1.25 },
      { rx: 72, ry: 26, offset: 3.6, speed: 0.9 }
    ];
    orbits.forEach(function (orb, idx) {
      ctx.save();
      ctx.strokeStyle = idx === 0 ? C.orbitInner : C.orbit;
      ctx.lineWidth = idx === 0 ? 2 : 1;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.ellipse(0, -18, orb.rx, orb.ry, 0, 0, Math.PI * 2);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();
    });

    var kpColors = [C.kpPdf, C.kpXls, C.kpScan, C.kpPdf, C.kpXls];
    for (var i = 0; i < 5; i++) {
      var orb = orbits[i % 3];
      var t = (this.phase * orb.speed + orb.offset + i * 1.15) % (Math.PI * 2);
      var ex = Math.cos(t) * orb.rx;
      var ey = -18 + Math.sin(t) * orb.ry;
      drawRfpDoc(ctx, ex, ey, 16, 12, kpColors[i], i % 2 === 0 ? "PDF" : "XLS");
    }
  };

  function drawRfpDoc(ctx, x, y, w, h, color, label) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -w / 2, -h / 2, w, h, 3, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    ctx.fillText(label, 0, 0);
    ctx.restore();
  }

  /* Ядро матрицы — вместо WebsiteTerminal */
  function SupplierMatrixCore() {
    this.rowHighlight = -1;
    this.tcoPulse = 0;
  }
  SupplierMatrixCore.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.tcoPulse = 0;

    /* Шестиугольное основание */
    ctx.fillStyle = C.matrixBase;
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    var hx = 0, hy = -55, r = 58;
    for (var i = 0; i < 6; i++) {
      var ang = (Math.PI / 3) * i - Math.PI / 2;
      var px = hx + Math.cos(ang) * r;
      var py = hy + Math.sin(ang) * r * 0.85;
      if (i === 0) ctx.moveTo(px, py);
      else ctx.lineTo(px, py);
    }
    ctx.closePath();
    ctx.fill();
    ctx.stroke();

    /* Таблица внутри ядра */
    var cols = ["Пост.", "₽/ед.", "MOQ", "TCO"];
    var rows = [
      ["А", "18.2", "200", "—"],
      ["Б", "17.1", "500", "—"],
      ["В", "19.0", "100", "—"]
    ];
    drawRR(ctx, -48, -42, 96, 78, 6, "rgba(255,255,255,0.06)", C.outline);
    cols.forEach(function (c, i) {
      ctx.fillStyle = C.matrixAccent;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(c, -36 + i * 24, -32);
    });

    /* Фаза PARSE: строки заполняются */
    var filledRows = prg < 80 ? 0 : prg < 140 ? 1 : prg < 190 ? 2 : 3;
    for (var ri = 0; ri < 3; ri++) {
      if (ri >= filledRows) continue;
      var ry = -22 + ri * 18;
      if (prg >= 190 && ri === 1) {
        this.rowHighlight = 1;
        drawRR(ctx, -46, ry - 8, 92, 16, 4, "rgba(34,197,94,0.22)", C.matrixGreen);
      }
      rows[ri].forEach(function (cell, ci) {
        var val = cell;
        if (prg >= 140 && ci === 3 && ri <= filledRows - 1) {
          val = ri === 1 && prg >= 190 ? "★" : "…";
        }
        ctx.fillStyle = ci === 3 && val === "★" ? C.matrixGreen : "rgba(255,255,255,0.75)";
        ctx.font = (ci === 3 && val === "★" ? "bold " : "") + "6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(val, -36 + ci * 24, ry);
      });
    }

    /* Фаза NORMALIZE: луч MOQ */
    if (prg >= 80 && prg < 140) {
      var beam = (prg - 80) / 60;
      ctx.strokeStyle = "rgba(251,191,36," + (0.4 + beam * 0.4) + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(-90, 25);
      ctx.lineTo(-48 + beam * 20, -10);
      ctx.stroke();
      ctx.setLineDash([]);
      drawRR(ctx, -98, 18, 28, 14, 4, "rgba(251,191,36,0.2)", C.matrixAccent);
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("MOQ→₽/кг", -84, 27);
    }

    /* Фаза APPROVE: TCO-пульс + печать */
    if (prg >= 200) {
      var ap = Math.min(1, (prg - 200) / 30);
      this.tcoPulse = ap;
      ctx.strokeStyle = "rgba(34,197,94," + (0.7 - ap * 0.5) + ")";
      ctx.lineWidth = 2.5;
      ctx.beginPath();
      ctx.arc(0, -4, 30 + ap * 35, 0, Math.PI * 2);
      ctx.stroke();

      if (prg > 215) {
        ctx.save();
        ctx.translate(52, 30);
        ctx.rotate(-0.35);
        ctx.globalAlpha = Math.min(1, (prg - 215) / 20);
        drawRR(ctx, -22, -12, 44, 24, 4, "rgba(34,197,94,0.18)", C.matrixGreen);
        ctx.fillStyle = C.matrixGreen;
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("HUMAN", 0, -2);
        ctx.fillText("OK", 0, 8);
        ctx.restore();
        ctx.globalAlpha = 1;
      }
    }
  };

  /* Столбцы сравнения цен — уникальный объект */
  function SupplierScoreBar() {
    this.heights = [0.55, 0.72, 0.48, 0.65, 0.58];
  }
  SupplierScoreBar.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 130) return;
    var reveal = Math.min(1, (prg - 130) / 40);
    drawRR(ctx, 88, -8, 54, 42, 5, "rgba(255,255,255,0.05)", C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("TCO", 115, 2);
    for (var i = 0; i < 5; i++) {
      var bh = this.heights[i] * 28 * reveal;
      var bx = 94 + i * 9;
      var col = i === 1 ? C.matrixGreen : C.matrixViolet;
      drawRR(ctx, bx, 30 - bh, 6, bh, 2, col, null);
    }
  };

  /* Флаг риска «нет срока» */
  function ConfidenceFlag() {
    this.show = false;
  }
  ConfidenceFlag.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.show = prg > 95 && prg < 175;
    if (!this.show) return;
    var blink = 0.6 + Math.sin(frame * 0.12) * 0.4;
    drawRR(ctx, -118, -48, 40, 18, 4, "rgba(245,158,11," + (0.12 * blink) + ")", C.flagAmber);
    ctx.fillStyle = C.flagAmber;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("нет срока", -98, -37);
  };

  /* Луч парсинга PDF */
  function MoqNormalizerBeam() {
    this.active = false;
  }
  MoqNormalizerBeam.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.active = prg >= 60 && prg < 110;
    if (!this.active) return;
    var sweep = ((prg - 60) / 50) * Math.PI;
    ctx.strokeStyle = "rgba(139,92,246,0.45)";
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.moveTo(-70, 40);
    ctx.lineTo(-70 + Math.cos(sweep) * 50, 40 - Math.sin(sweep) * 35);
    ctx.stroke();
  };

  class Agent {
    constructor(x, y, color, role, phaseTrig, phaseDur, targetX, targetY, dialogs) {
      this.x = x; this.y = y; this.baseX = x; this.baseY = y;
      this.color = color; this.role = role;
      this.timer = Math.random() * 100;
      this.phaseTrig = phaseTrig;
      this.phaseDur = phaseDur;
      this.targetX = targetX;
      this.targetY = targetY;
      this.dialogs = dialogs;
      this.hitAnimation = 0;
    }

    draw(ctx) {
      this.timer += 0.028;
      var isMoving = false;
      var carryType = null;
      var faceDir = 1;
      var prg = (frame * 0.038) % 260;

      if (prg >= this.phaseTrig && prg < this.phaseTrig + this.phaseDur) {
        var local = prg - this.phaseTrig;
        var half = this.phaseDur / 2;
        if (local < half) {
          isMoving = true;
          faceDir = this.targetX > this.baseX ? 1 : -1;
          carryType = this.color;
          var t = local / half;
          this.x = this.baseX + (this.targetX - this.baseX) * t;
          this.y = this.baseY + (this.targetY - this.baseY) * t;
        } else {
          isMoving = true;
          faceDir = this.baseX > this.targetX ? 1 : -1;
          var t2 = (local - half) / half;
          this.x = this.targetX + (this.baseX - this.targetX) * t2;
          this.y = this.targetY + (this.baseY - this.targetY) * t2;
        }
      } else {
        this.x = this.baseX;
        this.y = this.baseY;
        if (prg >= this.phaseTrig - 12 && prg < this.phaseTrig) carryType = this.color;
      }

      if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
      }

      var bob = isMoving ? Math.abs(Math.sin(this.timer * 4)) * 2 : Math.sin(this.timer * 1.4) * 1;
      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.lineJoin = "round";

      var legL = 0, legR = 0;
      if (isMoving) {
        var wp = this.timer * 5.5;
        legL = Math.sin(wp) * 4;
        legR = Math.sin(wp + Math.PI) * 4;
      }
      drawRR(ctx, -9, -4 + Math.max(0, legL), 7, 12, 2, C.outline, null);
      drawRR(ctx, 2, -4 + Math.max(0, legR), 7, 12, 2, C.outline, null);
      drawRR(ctx, -14, -10 - bob, 28, 18, 5, this.color, C.outline);

      var hx = 0, hy = -24 - bob;
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(hx, hy, 10, 0, Math.PI * 2);
      ctx.fill();
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = C.outline;
      ctx.stroke();

      ctx.save();
      ctx.scale(faceDir, 1);
      ctx.fillStyle = "#fff";
      ctx.beginPath(); ctx.arc(hx + 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
      ctx.fillStyle = C.outline;
      ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(hx - 2, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();

      if (this.role === "1_architect") {
        ctx.strokeStyle = C.outline; ctx.lineWidth = 1;
        ctx.strokeRect(hx + 1, hy - 4, 5, 5);
        ctx.strokeRect(hx - 6, hy - 4, 5, 5);
      } else if (this.role === "3_coder") {
        drawRR(ctx, hx - 8, hy - 12, 16, 6, 2, C.matrixAccent, null);
      } else if (this.role === "5_deployer") {
        ctx.strokeStyle = C.matrixGreen;
        ctx.lineWidth = 2;
        ctx.beginPath(); ctx.arc(hx, hy, 12, Math.PI, Math.PI * 2); ctx.stroke();
      }
      ctx.restore();

      if (carryType) {
        drawRR(ctx, -16 * faceDir, -16 - bob, 14, 14, 2, carryType, C.outline);
      }
      ctx.restore();
    }
  }

  var entities = [];
  var bubbles = [];
  var orbitRing = new QuotationOrbitRing();
  var matrixCore = new SupplierMatrixCore();
  var scoreBar = new SupplierScoreBar();
  var confFlag = new ConfidenceFlag();
  var moqBeam = new MoqNormalizerBeam();

  entities.push(orbitRing);
  entities.push(moqBeam);
  entities.push(confFlag);
  entities.push(matrixCore);
  entities.push(scoreBar);

  entities.push(new Agent(-130, 55, C.agentYellow, "1_architect", 25, 22, -35, -15, [
    "Шаблон RFP готов", "Критерии тендера", "Веса: цена 40%"
  ]));
  entities.push(new Agent(125, 48, C.agentGreen, "2_seo", 55, 22, 20, -20, [
    "5 поставщиков в пуле", "Тег: упаковка", "Контрагент проверен"
  ]));
  entities.push(new Agent(-115, -70, C.agentBlue, "3_coder", 85, 24, -10, -35, [
    "Парсинг PDF КП", "MOQ извлечён", "Цена за кг: 17.1 ₽"
  ]));
  entities.push(new Agent(110, -65, C.agentPink, "4_designer", 125, 24, 15, -38, [
    "Колонки выровнены", "TCO пересчитан", "Матрица v3"
  ]));
  entities.push(new Agent(0, 75, C.agentPurple, "5_deployer", 205, 26, 45, 25, [
    "Human review OK", "Утверждаю shortlist", "Протокол сравнения"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 260, maxLife: customLife || 260 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.038) % 260;
    if (prg >= 22 && prg < 22.06) createBubble(-125, 35, "1. Сбор КП");
    if (prg >= 72 && prg < 72.06) createBubble(-8, -50, "2. Нормализация MOQ");
    if (prg >= 122 && prg < 122.06) createBubble(0, -55, "3. Сравнение TCO");
    if (prg >= 172 && prg < 172.06) createBubble(15, -30, "4. Флаг риска");
    if (prg >= 218 && prg < 218.06) createBubble(40, 20, "5. Human review");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    ctx.lineJoin = "round";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bub.x - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.matrixAccent);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bub.x, by - th / 2);
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
(function () {
  'use strict';
  document.querySelectorAll('.vnec-faq-q').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var item = btn.closest('.vnec-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.vnec-faq-item.open').forEach(function (el) {
        el.classList.remove('open');
        var q = el.querySelector('.vnec-faq-q');
        if (q) q.setAttribute('aria-expanded', 'false');
      });
      if (!isOpen) {
        item.classList.add('open');
        btn.setAttribute('aria-expanded', 'true');
      }
    });
    btn.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
    });
  });

  var root = document.querySelector('.vnedrenie-ai-zakupki-page');
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
})();
</script>

<?php get_footer(); ?>
